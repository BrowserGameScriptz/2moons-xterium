<?php
define('MODE', 'JSON');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/chat/common_json.php';

$db		= Database::get();

$user_id	= HTTP::_GP('id',0);

$sql	= "SELECT * FROM %%CHAT_ROOMS%% WHERE id_owner = :userId;";
$room_info	= $db->selectSingle($sql, array(
	':userId'	=> $user_id
));

$sql = "UPDATE %%USERS%% SET chat_room = :chat_room WHERE id = :id;";
$db->update($sql, array(
    ':chat_room' => 0,
    ':id' => $user_id
)); 
	
	
if(!empty($room_info))
{
	$sql = "DELETE FROM %%CHAT_ON_ROOMS%% WHERE id = :id;";
    $db->delete($sql, array(
    ':id' => $user_id
	)); 
}