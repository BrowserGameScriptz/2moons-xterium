<?php
define('MODE', 'JSON');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/chat/common_json.php';
require'includes/chat/cht_message_parse.php';

//if((TIMESTAMP - $_SESSION['last_read']) < 4)
//exit();

//$USER['chat_room'] 		= HTTP::_GP('ally', 0);

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
$LNG = new Language($USER['lang']);
$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME'));

$sql	= "SELECT * FROM %%CHAT_ROOMS%% WHERE id = :userId;";
$room_info	= $db->selectSingle($sql, array(
':userId'	=> $USER['chat_room']
));
$valCusNick = empty($USER['customNick']) ? $USER['username'] : $USER['customNick'];
	
$username = "<span class='nick' onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\" >".$valCusNick."</span>";
if($USER['id'] == $room_info['id_owner']){
$username = "<span class='nick' style=\"color:#b13cdc;\" onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\">".$valCusNick."</span>";
}elseif($USER['authlevel'] == 3){
$username = "<span onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\" class='admin nick'>".$valCusNick." [A]</span>";
}

$db	= Database::get();
$sql = "INSERT INTO %%CHAT_ON_ROOMS%% SET
                id	= :id,
                username		= :username,
                last_time		= :last_time,
                room_id	= :room_id ON duplicate KEY UPDATE last_time = :last_time, room_id = :room_id;";

$db->insert($sql, array(
				':id'	=> $USER['id'],
				':username'			=> $valCusNick,
				':last_time'			=> TIMESTAMP,
				':room_id'			=> $USER['chat_room']
			));	

if(HTTP::_GP('online',0) == 1)
{
	$chatonline = '';
	$chatonline .= "<span class='room_name'><span style='float:left;'>".$room_info['name']."</span>";
	if($USER['id'] == $room_info['id_owner']){
	$chatonline .= "<span style='float:left;'>&nbsp;</span><span class='pwd tooltip' data-tooltip-content='".$LNG['chat_room_pwd_edit']."' onclick='pwdEdit();'></span>";
	}
	$chatonline .= "</span><br>";
	
	$db	= Database::get();
	$sql	= "SELECT * FROM %%CHAT_ON_ROOMS%% WHERE room_id = :room_id AND last_time >= :last_time;";
	$query	= $db->select($sql, array(
		':room_id'	=> $USER['chat_room'],
		':last_time'	=> (TIMESTAMP - 15)
	));
	
	foreach($query as $chat_row)
	{
		$btn_bana = '';
		$valCusNick = empty($chat_row['customNick']) ? $chat_row['username'] : $chat_row['customNick'];
		if($USER['id'] == $room_info['id_owner'] && $USER['id'] != $chat_row['id']){
		$btn_bana .= "<span class='kick tooltip' data-tooltip-content='".$LNG['chat_room_kick']."' onclick='kickFromRoom(".$chat_row['id'].");'></span>";
		}elseif($USER['authlevel'] == 3 && $USER['id'] != $chat_row['id']){
		$btn_bana .= "<span class='ban tooltip' data-tooltip-content='".$LNG['gm_block']."' onclick='return Dialog.chatBana(".$chat_row['id'].")'></span>";
		}
		
		$nick_stripped = htmlentities(strip_tags($valCusNick), ENT_QUOTES, 'utf-8');
		$nick = str_replace(strip_tags($valCusNick), $nick_stripped, $valCusNick);	
		
		$chatonline .= "<div style='width:100%;float:left;'>".$btn_bana."<span style='float:left;'>&nbsp;</span>".$nick."</div>";
	}
}	

$page_limit = 20; // Chat rows Limit
$where_add = '';

$last_message = HTTP::_GP('last_message', 0);
$where_add = $last_message != 0 ? "AND messageid > ".$last_message : '';

$chat_line = array();

$db	= Database::get();
$sql	= "SELECT * FROM %%CHAT_ROOMS_MSG%% WHERE room_id = :room_id AND messageid > :messageid ORDER BY messageid DESC LIMIT :limit;";
$query	= $db->select($sql, array(
		':room_id'		=> $USER['chat_room'],
		':messageid'	=> $last_message,
		':limit'		=> $page_limit
	));
	
foreach($query as $chat_row)
{
	$nick_stripped = htmlentities(strip_tags($chat_row['user']), ENT_QUOTES, 'utf-8');
	$nick = str_replace(strip_tags($chat_row['user']), $nick_stripped, $chat_row['user']);

	$nick = "<span style=\"cursor: pointer;\" onclick=\"addSmiley('(".$nick_stripped.")', 'nickname');\">".$nick."</span>";
	
	$chat_line[] = array(
	  'TIME' => _date('H:i:s', $chat_row['timestamp'], $USER['timezone']),
	  'DATE' => _date('d. M Y', $chat_row['timestamp'], $USER['timezone']),
	  'NICK' => $nick,
	  //'TEXT' => cht_message_parse(htmlentities($chat_row['message'], ENT_QUOTES, 'utf-8')),
	  'TEXT' => cht_message_parse($chat_row['message']),
	);
	$last_message = max($last_message, $chat_row['messageid']);
}
$chat['sound'] = false;

if(HTTP::_GP('last_message', 0) != 0 && HTTP::_GP('last_message', 0) < $last_message)
	$chat['sound'] = true;

if(!empty($chatonline))
	$chat['online'] = $chatonline;

$chat_line = array_reverse($chat_line);
$chat['html'] = "";
foreach($chat_line as $ID => $row)
{		
	$chat['html'] .='
			<div class="chat_row">
			<span style="" class="tooltip" data-tooltip-content="'.$row['DATE'].'">['.$row['TIME'].']</span>&nbsp;'.$row['NICK'].'&rArr;&nbsp;'.$row['TEXT'].'
			<br></div>';
}
$chat['last_message'] = $last_message;

$_SESSION['last_read'] = TIMESTAMP;

echo json_encode($chat);
