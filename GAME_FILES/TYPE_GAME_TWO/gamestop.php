<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';



$ip 			= HTTP::_GP('votingip', '');
$custom 		= HTTP::_GP('custom', 0);
		 
$sql	= "SELECT vote_sys_5 FROM %%USERS%% WHERE id = :userId;";
$checkDataVote = database::get()->selectSingle($sql, array(
	':userId'		=> $custom,
));	
	
if(!empty($checkDataVote) && $checkDataVote['vote_sys_5'] + 12 * 3600 < TIMESTAMP){
	$sql	= "UPDATE %%USERS%% SET votepoint = votepoint + 1, darkmatter = darkmatter + :darkmatter, antimatter = antimatter + :antimatter, vote_sys_5 = :time WHERE id = :userId;";
	database::get()->update($sql, array(
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
		':vote_system_id'	=> 5,
		':user_ip'			=> $ip,
		':isSucces'			=> 1,
		':universe'			=> 1
	));
	$text = 'Your vote on GamesTop100 was succesfull. <br><span style="color:#F30; font-weight:bold;">'.pretty_number(1000000).'</span> darkmatter and <span style="color:#F30; font-weight:bold;">'.pretty_number(1000).'</span> antimatter have been credited to your account.';
	PlayerUtil::sendMessage($custom, 0, 'GamesTop100', 4, 'Successfull vote.', $text, TIMESTAMP);
}
?> 