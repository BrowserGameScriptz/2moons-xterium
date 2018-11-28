<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

$langCho = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'en';
if(!isset($_COOKIE['lang'])) $langCho = 'en';
$LNG = new Language($langCho);
$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME'));
$action = HTTP::_GP('action', '', UTF8_SUPPORT);
$email = HTTP::_GP('email', '', UTF8_SUPPORT);
$username = HTTP::_GP('username', '', UTF8_SUPPORT);
if ($action == "verifemail") {
$MailValid = 0;
if(!PlayerUtil::isMailValid($email)) {
$MailValid = 1;
}
		
		
$db	= Database::get();
$sql	= 'SELECT * FROM %%USERS%% WHERE email = :email AND universe = :universe;';
$result = $db->select($sql, array(
':email'	=> $email,
':universe'	=> 1
));	
$sql	= 'SELECT * FROM %%USERS_VALID%% WHERE email = :email AND universe = :universe;';
$result1 = $db->select($sql, array(
':email'	=> $email,
':universe'	=> 1
));		
	
if($MailValid == 1){ 
$chat = array('verif' => 0, 'message' => $LNG['checker_1']);
}elseif(count($result) !=0 || count($result1) != 0){ 
$chat = array('verif' => 0, 'message' => $LNG['checker_2']);
}else{
$chat = array('verif' => 1, 'message' => 'OK');	
}
echo json_encode($chat);  

}elseif ($action == "verifpsuedo") {
$MailValid = 0;
if(!PlayerUtil::isNameValid($username)) {
$MailValid = 1;
}

		
		
$db	= Database::get();
$sql	= 'SELECT * FROM %%USERS%% WHERE username = :email AND universe = :universe;';
$result = $db->select($sql, array(
':email'	=> $username,
':universe'	=> 1
));	
$sql	= 'SELECT * FROM %%USERS_VALID%% WHERE username = :email AND universe = :universe;';
$result1 = $db->select($sql, array(
':email'	=> $username,
':universe'	=> 1
));		
	
if($username == ""){ 
$chat = array('verif' => 0, 'message' => $LNG['checker_3']);
}elseif(strlen($username) < 3 || strlen($username) > 15){ 
$chat = array('verif' => 0, 'message' => $LNG['checker_4']);
}elseif($MailValid == 1){ 
$chat = array('verif' => 0, 'message' => $LNG['checker_5']);
}elseif(count($result) !=0 || count($result1) != 0){ 
$chat = array('verif' => 0, 'message' => $LNG['checker_6']);
}else{
$chat = array('verif' => 1, 'message' => 'OK');	
}
echo json_encode($chat);  

}elseif ($action == "verifpwd") {
	
if($username == ""){ 
$chat = array('verif' => 0, 'message' => $LNG['checker_7']);
}elseif(strlen($username) < 6 || strlen($username) > 15){ 
$chat = array('verif' => 0, 'message' => $LNG['checker_8']);
}else{
$chat = array('verif' => 1, 'message' => 'OK');	
}
echo json_encode($chat);  

}
?>
