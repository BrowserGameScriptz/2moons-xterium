<?php
define('MODE', 'JSON');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/chat/common_json.php';
require'includes/chat/cht_message_parse.php';


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

if(HTTP::_GP('pass', '', true) != '')
$pass = crypt(HTTP::_GP('pass', '', true), ''); // шифруем пасс

$db	= Database::get();
$sql	= "UPDATE %%CHAT_ROOMS%% SET pass = :pass WHERE id_owner = :userId;";
$db->update($sql, array(
			':pass'	=> $pass,
			':userId'	=> $USER['id']
));
	
