<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

function _VoteReward($userId, $userIp, $valid) {
	
	$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
	$getUser = database::get()->selectSingle($sql, array(
		':userId'		=> $userId,
	));
	
    if($valid == 1 && !empty($getUser) && $getUser['vote_sys_2'] < TIMESTAMP - 12 * 3600) { 
		$sql	= "UPDATE %%USERS%% SET votepoint = votepoint + :currency, darkmatter = darkmatter + :darkmatter, antimatter = antimatter + :antimatter, vote_sys_2 = :time WHERE id = :userId;";
		database::get()->update($sql, array(
			':currency'		=> 1,
			':darkmatter'	=> 1000000,
			':antimatter'	=> 1000,
			':time'			=> TIMESTAMP,
			':userId'		=> $userId
		));	
		tournement($userId, 1, 1);
		$sql = "INSERT INTO %%VOTE_LOG%% SET user_id = :user_id, time = :time, vote_system_id = :vote_system_id, user_ip = :user_ip, isSucces = :isSucces, universe = :universe;";
		database::get()->insert($sql, array(
			':user_id'			=> $userId,
			':time'				=> TIMESTAMP,
			':vote_system_id'	=> 3,
			':user_ip'			=> $userIp,
			':isSucces'			=> $valid,
			':universe'			=> 1
		));
		$text = 'Your vote on Private-Server was succesfull. <br><span style="color:#F30; font-weight:bold;">'.pretty_number(1000000).'</span> darkmatter and <span style="color:#F30; font-weight:bold;">'.pretty_number(1000).'</span> antimatter have been credited to your account.';
		PlayerUtil::sendMessage($userId, 0, 'Private-Server', 4, 'Successfull vote.', $text, TIMESTAMP);
    }
}

//-------------------------- Don't change anything below this! -----------------------------

$userId = isset($_POST['userid']) ? $_POST['userid'] : null;
$userIp = isset($_POST['userip']) ? $_POST['userip'] : null;
$valid 	= isset($_POST['voted']) ? $_POST['voted'] : 0;

$result = false;
if (!empty($userId)) {
	$result = true;
	_VoteReward($userId, $userIp, $valid);
}
	
?> 