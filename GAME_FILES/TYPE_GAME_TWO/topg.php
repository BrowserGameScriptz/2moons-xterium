<?php
define('MODE', 'BANNER');
define("TOPG_IP", gethostbyname("monitor.topg.org")); //This is TopG IP address
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';
$ip_request = $_SERVER['REMOTE_ADDR']; //for Cloudflare $ip_request = $_SERVER["HTTP_CF_CONNECTING_IP"];


if($ip_request == TOPG_IP) //check if response is coming from TopG
{	
	//get the parameters response from us and clean them
	$p = preg_replace('/[^A-Za-z0-9\_]+/','',$_GET['p_resp']); //can be only numbers letters and _
	$user_ip = preg_replace('/[^0-9\.]+/','',$_GET['ip']); //can be only numbers and dots
	
	$sql	= "SELECT vote_sys_4 FROM %%USERS%% WHERE id = :userId;";
	$checkDataVote = database::get()->selectSingle($sql, array(
		':userId'		=> $p,
	));	
	
	if(!empty($checkDataVote) && $checkDataVote['vote_sys_4'] + 12 * 3600 < TIMESTAMP){
		$sql	= "UPDATE %%USERS%% SET votepoint = votepoint + :currency, darkmatter = darkmatter + :darkmatter, antimatter = antimatter + :antimatter, vote_sys_4 = :time WHERE id = :userId;";
		database::get()->update($sql, array(
			':currency'		=> 1,
			':darkmatter'	=> 1000000,
			':antimatter'	=> 1000,
			':time'			=> TIMESTAMP,
			':userId'		=> $p
		));	
		tournement($p, 1, 1);
		$sql = "INSERT INTO %%VOTE_LOG%% SET
			user_id				= :user_id,
			time				= :time,
			vote_system_id		= :vote_system_id,
			user_ip				= :user_ip,
			isSucces			= :isSucces,
			universe			= :universe;";

		database::get()->insert($sql, array(
			':user_id'			=> $p,
			':time'				=> TIMESTAMP,
			':vote_system_id'	=> 4,
			':user_ip'			=> $user_ip,
			':isSucces'			=> 1,
			':universe'			=> 1
		));
		$text = 'Your vote on TopG was succesfull. <br><span style="color:#F30; font-weight:bold;">'.pretty_number(1000000).'</span> darkmatter and <span style="color:#F30; font-weight:bold;">'.pretty_number(1000).'</span> antimatter have been credited to your account.';
		PlayerUtil::sendMessage($p, 0, 'TopG', 4, 'Successfull vote.', $text, TIMESTAMP);
	}
}

	
?> 