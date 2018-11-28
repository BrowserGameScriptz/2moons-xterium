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


if(empty($USER) || $USER['chat_silence'] > TIMESTAMP)
	exit();

$message = HTTP::_GP('message', '', UTF8_SUPPORT);

if($message == '')
	exit();

$sql	= "SELECT * FROM %%CHAT_ROOMS%% WHERE id = :userId;";
$room_info	= $db->selectSingle($sql, array(
':userId'	=> $USER['chat_room']
));

if(empty($room_info))
	exit();

$valCusNick = empty($USER['customNick']) ? $USER['username'] : $USER['customNick'];

$username	= "<span>".$valCusNick."</span>";
if($USER['authlevel'] == 3){
$username	= "<span class='admin'>".$valCusNick."</span>";
}elseif($USER['id'] == $room_info['id_owner']){
$username	= "<span style='color:#b13cdc;'>".$valCusNick."</span>";
}
/*  Проверка на спам 
$Spam = 0;

if(!isset($_SESSION['ANTI_SPAM_COUNT']))
	$_SESSION['ANTI_SPAM_COUNT'] = 0;
	
if((int)$USER['id'] != 1)
{
	Подключаем ассив спам слов 
	include(ROOT_PATH . 'includes/libs/spamArray.php');
	
	foreach ($_SPAM as $NameSPAM)
		if (stristr ($message, $NameSPAM) == true)
		{
			$Spam = 1;		
			$_SESSION['ANTI_SPAM_COUNT'] ++;
			break;
		}	
}

if($Spam == 1)
	$message = $LNG['chat_ban_ready'];

if($_SESSION['ANTI_SPAM_COUNT'] >= ANTI_SPAM_NID)
{
	//$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET message_silence = ".(TIMESTAMP + 3600 * ANTI_SPAM_TIME_SILENCE)." WHERE id = ".$USER['id'].";");
	$GLOBALS['DATABASE']->query("UPDATE ".USETING." SET chat_silence = ".(TIMESTAMP + 3600 * ANTI_SPAM_TIME_SILENCE)." WHERE id = ".$USER['id'].";");
	
	//сохранение платежа в базе
	$GLOBALS['DATABASE']->query("
		INSERT INTO uni1_silence SET 
		id_gm = 0,
		gm_username = 'Schataev',
		id_user = ".$USER['id'].",
		locked_username = '".$GLOBALS['DATABASE']->sql_escape($USER['username'])."',
		reason = 'SPAM',
		bana_time = ".(3600 * ANTI_SPAM_TIME_SILENCE).",
		type = 'CHAT_PM',
		time = ".TIMESTAMP."
		;"
	);
		
	$_SESSION['ANTI_SPAM_COUNT'] = 0;
	
	$message = $LNG['chat_ban_done'];
} */

/* Отправка $Message. Если спам не найден - отправится сообщение, если найден - пасхалка */

$db	= Database::get();
	$msgId = $db->lastInsertId();
	$sql = "INSERT INTO %%CHAT_ROOMS_MSG%% SET
                messageid		= :messageid,
                user			= :user,
                iduser			= :iduser,
                message			= :message,
                timestamp		= :timestamp,
                room_id			= :room_id;";

	$db->insert($sql, array(
				':messageid'			=> $msgId,
				':user'			=> $valCusNick,
				':iduser'			=> $USER['id'],
				':message'			=> $message,
				':timestamp'			=> TIMESTAMP,
				':room_id'			=> $USER['chat_room']
	));
	
$session->last_read = 0;
