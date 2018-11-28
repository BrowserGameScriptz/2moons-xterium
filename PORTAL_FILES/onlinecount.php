<?php

define('MODE', 'LOGIN');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

$onlineUsers = HTTP::_GP('useramount', 0);
$universe 	 = HTTP::_GP('universe', "");

if($universe == "wog2"){
	$sql	= "UPDATE %%CONFIG%% SET usersOnline2 = :usersOnline;";
	database::get()->update($sql, array(
		':usersOnline'	=> $onlineUsers
	));	
}else{
	$sql	= "UPDATE %%CONFIG%% SET usersOnline = :usersOnline;";
	database::get()->update($sql, array(
		':usersOnline'	=> $onlineUsers
	));	
}