<?php
define('MODE', 'JSON');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/chat/common_json.php';

$db		= Database::get();
$session    = Session::load();
if(!$session->isValidSession()){
$session->delete();
HTTP::redirectTo('index.php?code=3');
}
$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
$USER	= $db->selectSingle($sql, array(
':userId'	=> $session->userId
));

if($USER['chat_room'] == 0)
	return;

$db		= Database::get();
$sql = "UPDATE %%USERS%% SET chat_room = :chat_room WHERE id = :id;";
    $db->update($sql, array(
    ':chat_room' => 0,
    ':id' => $USER['id']
	)); 
	
	
$sql	= "SELECT * FROM %%CHAT_ROOMS%% WHERE id_owner = :userId;";
$c_s_room	= $db->selectSingle($sql, array(
':userId'	=> $USER['id']
));

if(count($c_s_room) != 0)
{	$db		= Database::get();
	$sql	= "SELECT * FROM %%CHAT_ROOMS%% WHERE id_owner = :userId;";
	$room_info	= $db->selectSingle($sql, array(
	':userId'	=> $USER['id']
	));
	 $sql = "DELETE FROM %%CHAT_ROOMS_MSG%% WHERE room_id = :room_id;";
     $db->delete($sql, array(
     ':room_id' => $room_info['id']
     ));
	 $sql = "DELETE FROM %%CHAT_ROOMS%% WHERE id_owner = :id_owner;";
     $db->delete($sql, array(
     ':id_owner' => $USER['id']
     ));
	 $sql = "DELETE FROM %%CHAT_ON_ROOMS%% WHERE room_id = :room_id;";
     $db->delete($sql, array(
     ':room_id' => $room_info['id']
     ));
	 $sql = "UPDATE %%USERS%% SET chat_room = 0 WHERE chat_room = :chat_room;";
     $db->update($sql, array(
     ':chat_room' => $USER['chat_room'],
	 )); 
	return;
}
	$db		= Database::get();
	$sql = "DELETE FROM %%CHAT_ON_ROOMS%% WHERE id = :id;";
    $db->delete($sql, array(
    ':id' => $USER['id']
	)); 

	
	
	
