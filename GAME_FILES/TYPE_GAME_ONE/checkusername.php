<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

$userCheck 	= HTTP::_GP('user', '', true);
$result 	= 0;

if(!empty($userCheck)){
	$sql = "SELECT (SELECT COUNT(*) FROM %%USERS%% WHERE universe = :universe AND username = :customNick) + (SELECT COUNT(*) FROM %%USERS%% WHERE universe = :universe AND customNick = :customNick) as count;";
	$countUsername = database::get()->selectSingle($sql, array(
		':universe'		=> 1,
		':customNick'	=> $userCheck,
	), 'count');
	$result = $countUsername;
}

echo $result;