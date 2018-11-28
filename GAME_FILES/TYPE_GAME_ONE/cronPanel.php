<?php

define('MODE', 'JSON');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

$session	= Session::load();

// Output transparent gif
HTTP::sendHeader('Cache-Control', 'no-cache');
HTTP::sendHeader('Content-Type', 'image/gif');
HTTP::sendHeader('Expires', '0');


$cronjobID	= HTTP::_GP('cronjobID', 0);

if(empty($cronjobID))
{
	exit;
}

require 'includes/classes/Cronjob.class.php';

$cronjobsTodo	= Cronjob::getNeedTodoExecutedJobs();
if($cronjobID == '111'){
	foreach($cronjobsTodo as $value) {
		Cronjob::execute($value);
	}
	exit;
} 
if(!in_array($cronjobID, $cronjobsTodo))
{
	exit;
}

Cronjob::execute($cronjobID);
