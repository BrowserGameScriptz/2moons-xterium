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
	
if(empty($USER) || $USER['chat_silence'] > TIMESTAMP || $USER['isChat'] == 1)
	exit();

$message = HTTP::_GP('message', '', UTF8_SUPPORT);
$messageCheck = HTTP::_GP('message', '', UTF8_SUPPORT);

$mystring = str_replace(" ", "", $messageCheck);
$mystring = preg_replace('/[^A-Za-z0-9\-]/', '', $mystring); // Removes special chars.
$mystring = strtolower($mystring);

$sql		= 'SELECT * FROM %%BLACKLIST%%;';
$blackList 	= Database::get()->select($sql, array());
$isFound 	= 0;
$blackWord 	= "";
foreach($blackList as $word){
	if(strpos($mystring, $word['blackText']) !== false){
		$isFound 	+= 1;
		$blackWord 	= $word['blackText'];
	}
}
	
if ($isFound != 0) {
    $sql = "UPDATE %%USERS%% SET isChat = :isChat, chat_silence = :chat_silence WHERE id = :userId;";
	Database::get()->update($sql, array(
		':isChat'	=> 1,
		':chat_silence'	=> TIMESTAMP + 500*3600*24,
		':userId'	=> $USER['id']
	));
	$valCusNick = empty($USER['customNick']) ? $USER['username'] : $USER['customNick'];
	PlayerUtil::sendMessage(1, $USER['id'], $valCusNick, 1, "Chat Message", $message."<hr>".$blackWord, TIMESTAMP);
}else{
	if($message == '')
		exit();
	
	$ally_id 	= HTTP::_GP('ally', 0) == $USER['ally_id'] ? $USER['ally_id'] : 0;
	$valCusNick = empty($USER['customNick']) ? $USER['username'] : $USER['customNick'];
	
	$username	= "<span>".$valCusNick."</span>";
	if($USER['chat_oper'] == 1)
		$username	= "<span style='color:#ffff00;'>".$valCusNick."</span>";
	if($USER['gm'] == 1)
		$username	= "<span style='color:#00cc00;'>".$valCusNick."</span>";
	if($USER['authlevel'] == 3)
		$username	= "<span class='admin'>".$valCusNick."</span>";

	$_SESSION['last_read'] = 0;

	if($ally_id == 0)
	{
		$username = "<span class='nick' onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\" >".$valCusNick."</span>";
		if($USER['chat_oper'] == 1)
			$username = "<span class='nick' style=\"color:#ffff00;\" onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\">".$valCusNick." [О]</span>";
		if($USER['gm'] == 1)
			$username = "<span class='nick' style=\"color:#00cc00;\" onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\">".$valCusNick." [ГМ]</span>";
		if($USER['authlevel'] == 3)
			$username = "<span onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\" class='admin nick'>".$valCusNick." [A]</span>";

		$sql = "INSERT INTO %%CHAT_ON%% SET id = :id, username = :username, last_time = :last_time ON duplicate KEY UPDATE last_time = :last_time;";
		$db->insert($sql, array(
			':id'	=> $USER['id'],
			':username'			=> ''.$username.'',
			':last_time'			=> TIMESTAMP
		));
	}else{
		$username = "<span class='nick' onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\" >".$valCusNick."</span>";
		if($USER['chat_oper'] == 1){
			$username = "<span class='nick' style=\"color:#ffff00;\" onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\">".$valCusNick." [О]</span>";
		}elseif($USER['gm'] == 1){
			$username = "<span class='nick' style=\"color:#00cc00;\" onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\">".$valCusNick." [ГМ]</span>";
		}elseif($USER['authlevel'] == 3){
			$username = "<span onclick=\"addSmiley('(".$valCusNick.")', 'nickname');\" class='admin nick'>".$valCusNick." [A]</span>";
		}
		$db	= Database::get();
		$sql = "INSERT INTO %%CHAT_ON%% SET id	= :id, username = :username, last_time = :last_time ON duplicate KEY UPDATE last_time = :last_time;";

		$db->insert($sql, array(
			':id'	=> $USER['id'],
			':username'			=> ''.$valCusNick.'',
			':last_time'			=> TIMESTAMP
		));
	}

	$db	= Database::get();
	$ally 	 	 = HTTP::_GP('ally', 0);
	$message 	 = HTTP::_GP('message', '', UTF8_SUPPORT);
	$msgId = $db->lastInsertId();
	$sql = "INSERT INTO %%CHAT%% SET
		messageid		= :messageid,
		user			= :user,
		iduser			= :iduser,
		message			= :message,
		timestamp		= :timestamp,
		ally_id			= :ally_id;";

	$db->insert($sql, array(
		':messageid'			=> $msgId,
		':user'			=> $valCusNick,
		':iduser'			=> $USER['id'],
		':message'			=> $USER['id'] == 1 ? $message : strtolower($message),
		':timestamp'			=> TIMESTAMP,
		':ally_id'			=> $ally_id
	));
}