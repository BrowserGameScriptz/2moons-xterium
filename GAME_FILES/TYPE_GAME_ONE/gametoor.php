<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';


if ($_POST["key"] == "5xoRdPx57")
{
	$already_voted 	= $_POST["already_voted"];
	$ip 			= $_POST["ip"];
	$custom 		= $_POST["custom"];
		 
	if($already_voted == 0 && !empty($custom)){
		$sql	= "UPDATE %%USERS%% SET votepoint = votepoint + :currency, darkmatter = darkmatter + :darkmatter, antimatter = antimatter + :antimatter, vote_sys_1 = :time WHERE id = :userId;";
		database::get()->update($sql, array(
			':currency'		=> 1,
			':darkmatter'	=> 1000000,
			':antimatter'	=> 1000,
			':time'			=> TIMESTAMP,
			':userId'		=> $custom
		));	
		tournement($custom, 1, 1);
		$sql = "INSERT INTO %%VOTE_LOG%% SET
			user_id				= :user_id,
			time				= :time,
			vote_system_id		= :vote_system_id,
			user_ip				= :user_ip,
			isSucces			= :isSucces,
			universe			= :universe;";

		database::get()->insert($sql, array(
			':user_id'			=> $custom,
			':time'				=> TIMESTAMP,
			':vote_system_id'	=> 1,
			':user_ip'			=> $ip,
			':isSucces'			=> $already_voted,
			':universe'			=> 1
		));
		$text = 'Your vote on Gametoor was succesfull. <br><span style="color:#F30; font-weight:bold;">'.pretty_number(1000000).'</span> darkmatter and <span style="color:#F30; font-weight:bold;">'.pretty_number(1000).'</span> antimatter have been credited to your account.';
		PlayerUtil::sendMessage($custom, 0, 'Gametoor', 4, 'Successfull vote.', $text, TIMESTAMP);
	}
}	
?> 