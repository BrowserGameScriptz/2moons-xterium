<?php
define('MODE', 'JSON');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

$sql	= "SELECT id, username FROM %%USERS%% WHERE onlinetime < :onlinetime;";
$inactiveIds = database::get()->select($sql, array(
	':onlinetime'		=> TIMESTAMP - 7 * 24 * 3600,
));	

foreach($inactiveIds as $user){
	$sql	= "UPDATE %%PLANETS%% SET metal = metal + :metal, crystal = crystal + :crystal, deuterium = deuterium + :deuterium WHERE id_owner = :userId;";
	database::get()->update($sql, array(
		':metal'		=> config::get()->asteroid_metal*2,
		':crystal'		=> config::get()->asteroid_crystal*2,
		':deuterium'	=> config::get()->asteroid_deuterium*2, 
		':userId'		=> $user['id'],
	));	
}

$sql	= "SELECT id, username FROM %%USERS%% WHERE onlinetime > :onlinetime";
$activeIds = database::get()->select($sql, array(
	':onlinetime'	=> TIMESTAMP - 7 * 24 * 3600
));

foreach($activeIds as $user){
	$message = 'All inactive players planets are loaded with resources. Be the first to steal them. This event will run each hour !';
	PlayerUtil::sendMessage($user['id'], '', 'Event System', 50, 'Event Info', $message, TIMESTAMP);
}