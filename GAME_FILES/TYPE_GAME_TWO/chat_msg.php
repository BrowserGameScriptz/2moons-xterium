<?php
define('MODE', 'JSON');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/chat/common_json.php';
require'includes/chat/cht_message_parse.php';

//if((TIMESTAMP - $_SESSION['last_read']) < 4)
//exit();

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
	
	if($USER['id'] == "")
	exit();

$LNG = new Language($USER['lang']);
$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME'));	
	
$ally 		= HTTP::_GP('ally', 0);
$valCusNick = empty($USER['customNick']) ? $USER['username'] : $USER['customNick'];
if($ally != 0){
	$username = "<span class='nick' onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\" >".$valCusNick."</span>";
	if($USER['chat_oper'] == 1){
	$username = "<span class='nick' style=\"color:#ffff00;\" onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\">".$valCusNick." [О]</span>";
	}elseif($USER['gm'] == 1){
	$username = "<span class='nick' style=\"color:#00cc00;\" onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\">".$valCusNick." [GM]</span>";
	}elseif($USER['authlevel'] == 3){
	$username = "<span onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\" class='admin nick'>".$valCusNick." [A]</span>";
	}
	$db	= Database::get();
	$sql = "INSERT INTO %%CHAT_ON_ALLY%% SET
                id	= :id,
                username		= :username,
                last_time		= :last_time,
                ally_id	= :ally_id ON duplicate KEY UPDATE last_time = :last_time, ally_id = :ally_id, username = :username;";

	$db->insert($sql, array(
				':id'	=> $USER['id'],
				':username'			=> $username,
				':last_time'			=> TIMESTAMP,
				':ally_id'			=> $ally
			));
			
}else{
	$username = "<span class='nick' onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\" >".$valCusNick."</span>";
	if($USER['chat_oper'] == 1){
	$username = "<span class='nick' style=\"color:#ffff00;\" onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\">".$valCusNick." [О]</span>";
	}elseif($USER['gm'] == 1){
	$username = "<span class='nick' style=\"color:#00cc00;\" onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\">".$valCusNick." [GM]</span>";
	}elseif($USER['authlevel'] == 3){
	$username = "<span onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\" class='admin nick'>".$valCusNick." [A]</span>";
	}
	$db	= Database::get();
	$sql = "INSERT INTO %%CHAT_ON%% SET
                id	= :id,
                username		= :username,
                last_time		= :last_time ON duplicate KEY UPDATE last_time = :last_time, username = :username;";

	$db->insert($sql, array(
				':id'	=> $USER['id'],
				':username'			=> $username,
				':last_time'			=> TIMESTAMP
			));
}
	

if(HTTP::_GP('online',0) == 1)
{
	$chatonline = '';
	if($ally == 0){
	$db	= Database::get();
	$sql	= "SELECT * FROM %%CHAT_ON%% WHERE last_time >= :last_time;";
	$query	= $db->select($sql, array(
		':last_time'	=> (TIMESTAMP - 60)
		));
	}else{
	$db	= Database::get();
	$sql	= "SELECT * FROM %%CHAT_ON_ALLY%% WHERE ally_id = :ally_id AND last_time >= :last_time;";
	$query	= $db->select($sql, array(
		':ally_id'		=> $ally,
		':last_time'	=> (TIMESTAMP - 60)
	));
	}
		
	foreach($query as $chat_row)
	{
		if(($USER['chat_oper'] == 1 || $USER['gm'] == 1 || $USER['authlevel'] == 3) && $USER['id'] != $chat_row['id']){
			$btn_bana = "<span class='ban tooltip' data-tooltip-content='".$LNG['gm_block']."' onclick='blockChat(".$chat_row['id'].")'></span>";
		}else{
			$btn_bana = '';
		}
		$nick_stripped = htmlentities(strip_tags($chat_row['username']), ENT_QUOTES, 'utf-8');
		$nick = str_replace(strip_tags($chat_row['username']), $nick_stripped, $chat_row['username']);	
		
		$chatonline .= $btn_bana."<span style='float:left;'>&nbsp;</span>".$nick.'<br>';
		
	}
}

$page_limit = ($USER['chat_oper'] == 0 && $USER['gm'] == 0) ? 40 : 1000; // Chat rows Limit
$where_add = '';

$last_message = HTTP::_GP('last_message', 0);
$where_add = $last_message != 0 ? "AND messageid > ".$last_message : '';

$chat_line = array();
$db	= Database::get();
	$sql	= "SELECT * FROM %%CHAT%% WHERE ally_id = :ally_id AND messageid > :messageid ORDER BY messageid DESC LIMIT :limit;";
	$query	= $db->select($sql, array(
		':ally_id'		=> $ally,
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
		'MSGID' => cht_message_parse($chat_row['messageid']),
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
$adminoptie = "";
foreach($chat_line as $ID => $row)
{	
	if(($USER['chat_oper'] == 1 || $USER['authlevel'] == 3 || $USER['gm'] == 1)){
	$adminoptie = "<img src=\"styles/images/false.png\" onclick=\"msgChatDel('".$row['MSGID']."'); return false;\" alt=\"Effacer\" title=\"Effacer\">";
	}
	$chat['html'] .='
			<div class="chat_row">
			<span style="" class="tooltip" data-tooltip-content="'.$row['DATE'].'">['.$row['TIME'].']</span>&nbsp;'.$row['NICK'].'&rArr;&nbsp;'.$row['TEXT'].'&nbsp;'.$adminoptie.'
			<br></div>';
}
$chat['last_message'] = $last_message;

$session->last_read = TIMESTAMP;

echo json_encode($chat);