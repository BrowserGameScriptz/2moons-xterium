<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan Kröpke
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package 2Moons
 * @author Jan Kröpke <info@2moons.cc>
 * @copyright 2012 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.2 (2013-03-18)
 * @info $Id$
 * @link http://2moons.cc/
 */

define('MODE', 'INGAME');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/pages/game/AbstractGamePage.class.php';
require 'includes/pages/game/ShowErrorPage.class.php';
require 'includes/common.php';
require_once(ROOT_PATH.'includes/Mobile_Detect.php');
/** @var $LNG Language */

$page 		= HTTP::_GP('page', 'overview');
$mode 		= HTTP::_GP('mode', 'show');
$page		= str_replace(array('_', '\\', '/', '.', "\0"), '', $page);
$pageClass	= 'Show'.ucwords($page).'Page';

	
$path		= 'includes/pages/game/'.$pageClass.'.class.php';

if(!file_exists($path)) {
	ShowErrorPage::printError($LNG['page_doesnt_exist'], true, array('game.php?page=overview', 2));
}

$goodPage = 0;
if($page == 'board' || $page == 'logout'){
$goodPage = 1;
}
if($USER['bana'] == 1 && $USER['banaday'] > TIMESTAMP && $goodPage == 0) {
	$page 		= 'BanList';
	$pageClass	= 'Show'.ucwords($page).'Page';
	$path		= 'includes/pages/game/'.$pageClass.'.class.php';
}

if($USER['isCaptcha'] == 1 && $USER['bana'] == 0 && $USER['isUserTime'] < TIMESTAMP) {
	$page 		= 'Captcha';
	$pageClass	= 'Show'.ucwords($page).'Page';
	$path		= 'includes/pages/game/'.$pageClass.'.class.php';
}


$detect = new Mobile_Detect;

// Added Autoload in feature Versions
require $path;

$pageObj	= new $pageClass;
// PHP 5.2 FIX
// can't use $pageObj::$requireModule
$pageProps	= get_class_vars(get_class($pageObj));

if(isset($pageProps['requireModule']) && $pageProps['requireModule'] !== 0 && !isModuleAvailable($pageProps['requireModule'])) {
	ShowErrorPage::printError($LNG['sys_module_inactive'], true, array('game.php?page=overview', 2));
}

if(!is_callable(array($pageObj, $mode))) {	
	if(!isset($pageProps['defaultController']) || !is_callable(array($pageObj, $pageProps['defaultController']))) {
		ShowErrorPage::printError($LNG['page_doesnt_exist'], true, array('game.php?page=overview', 2));
	}
	$mode	= $pageProps['defaultController'];
}

$pageObj->{$mode}();
