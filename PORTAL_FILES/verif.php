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

function checkUsernameApi($username){
	$timeout=10; 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
	//if you're using custom flags (like flags=m), change the URL below
	curl_setopt($ch, CURLOPT_URL, "https://play.warofgalaxyz.com/checkusername.php?user=".$username);
	$response=curl_exec($ch);
	curl_close($ch);
	return $response;
}

function disposablecheck($email) { 
	$email_split = explode('@', $email); 
	if(!isset($email_split[1]))
	 return 0;
	 
	$email_domain = $email_split[1];
	$sql	= "SELECT * FROM %%FAKEMAILS%% WHERE email = :email;";
	$isEmailDisposable	= database::get()->selectSingle($sql, array(
		':email'	=> $email_domain
	)); 
	
	$torRelay = gethostbyname($email_split[1]);
	$torRelay = gethostbyaddr($torRelay);

	if (!empty($isEmailDisposable) || strpos($torRelay, 'wikimedia.org') !== false) 
	{ 
		return 1; 
	} else { 
		return 0; 
	} 
}

if ($action == "verifemail") {
	$MailValid = 0;
	if(!PlayerUtil::isMailValid($email)) {
		$MailValid = 1;
	}
	$MailDisposable = 0;
	if(disposablecheck($email)) {
		$MailDisposable = 1;
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
	}elseif($MailDisposable == 1){ 
		$chat = array('verif' => 0, 'message' => "You can not use disposable emails");
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
	}elseif(count($result) !=0 || count($result1) != 0 || checkUsernameApi($username) != 0){ 
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
