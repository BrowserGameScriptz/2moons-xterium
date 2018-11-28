<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan
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
 * @author Jan <info@2moons.cc>
 * @copyright 2006 Perberos <ugamela@perberos.com.ar> (UGamela)
 * @copyright 2008 Chlorel (XNova)
 * @copyright 2012 Jan <info@2moons.cc> (2Moons)
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 2.0.$Revision: 2242 $ (2012-11-31)
 * @info $Id$
 * @link http://2moons.cc/
 */

class ShowIndexPage extends AbstractLoginPage
{
	function __construct() 
	{
		parent::__construct();

$detect = new Mobile_Detect;
if(MOBILEMODE && $detect->isMobile() && !$detect->isTablet()){
$this->setWindow('mnormal');
}else{
$this->setWindow('normal');
}		


	}
	
	function show() 
	{
		global $LNG;
		
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache"); // HTTP/1.0
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		

		$referralID		= HTTP::_GP('ref', 0);
		if(!empty($referralID))
		{
			$this->redirectTo('index.php?page=register&referralID='.$referralID);
		}
	
		$universeSelect	= array();
		
		foreach(Universe::availableUniverses() as $uniId)
		{
			$config = Config::get($uniId);
			$universeSelect[$uniId]	= $config->uni_name.($config->game_disable == 0 ? $LNG['uni_closed'] : '');
		}
		
		$Code	= HTTP::_GP('code', 0);
		$loginCode	= false;
		if(isset($LNG['login_error_'.$Code]))
		{
			$loginCode	= $LNG['login_error_'.$Code];
		}

		$config				= Config::get();
		
		$AllPlayers  = $config->users_amount;
		$AllMonth	 = 0;
		$AllDay		 = 0;
		$AllActive	 = $config->usersOnline + $config->usersOnline2;
		$AllTopics = array();
		$AllNews   = array();
		$AllTopNews   = array();
		$db	= Database::get();
		$sql	= 'SELECT * FROM %%USERS%% WHERE register_time > :register_time;';
		$AllMonth	= $db->select($sql, array(
		':register_time' 	=> TIMESTAMP - 31 * 3600 *24
		));
		$sql	= 'SELECT * FROM %%USERS%% WHERE register_time > :register_time;';
		$AllDay		= $db->select($sql, array(
		':register_time' 	=> TIMESTAMP - 3600 *24
		));
		
		$sql	= 'SELECT * FROM %%NEWS%% WHERE top_news = :top_news ORDER BY date DESC LIMIT :limit;';
		$News		= $db->select($sql, array(
		':top_news' 	=> 0,
		':limit' 	=> 5
		));
		
		foreach($News as $NewsRow){
		$AllNews[]	= array(
				'id' => $NewsRow['id'],
				'title' => $NewsRow['title_'.$LNG['choosen_lang'].''],
				'text' => $NewsRow['text_'.$LNG['choosen_lang'].''],
				'catId' => $NewsRow['catId'],
				'forum' => $NewsRow['forum_link'],
				'date' 	=> _date($LNG['php_tdformat'], $NewsRow['date'], 1),
			);		
		}
		$i = 1;
		$sql	= 'SELECT * FROM %%NEWS%% WHERE top_news = :top_news ORDER BY date DESC LIMIT :limit;';
		$TopNews		= $db->select($sql, array(
		':top_news' 	=> 1,
		':limit' 	=> 3
		));
		
		foreach($TopNews as $NewsRow){
		$AllTopNews[]	= array(
				'id' => $NewsRow['id'],
				'title' => $NewsRow['title_'.$LNG['choosen_lang'].''],
				'text' => $NewsRow['text_'.$LNG['choosen_lang'].''],
				'catId' => $NewsRow['catId'],
				'forum' => $NewsRow['forum_link'],
				'date' 	=> _date($LNG['php_tdformat'], $NewsRow['date'], 1),
				'ilvl' 	=> $i++,
			);		
		}
		$this->assign(array(
			'AllDay'		=> count($AllDay),
			'AllMonth'		=> count($AllMonth),
			'AllPlayers'	=> pretty_number($AllPlayers),
			'AllActive'		=> $AllActive,
			'News'			=> count($News),
			'AllTopics'		=> $AllTopics,
			'AllNews'		=> $AllNews,
			'AllTopNews'		=> $AllTopNews,
			'universeSelect'		=> $universeSelect,
			'code'					=> $loginCode,
			'descHeader'			=> sprintf($LNG['loginWelcome'], $config->game_name),
			'descText'				=> sprintf($LNG['loginServerDesc'], $config->game_name),
			'loginInfo'				=> sprintf($LNG['loginInfo'], '<a href="index.php?page=rules">'.$LNG['menu_rules'].'</a>')
		));
		
		
		



$detect = new Mobile_Detect;
if(MOBILEMODE && $detect->isMobile() && !$detect->isTablet()){
$this->display('page.mindex.default.tpl');
}else{
$this->display('page.index.default.tpl');
}

	}
}