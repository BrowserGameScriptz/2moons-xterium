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


class ShowIngamePage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
		$this->setWindow('light');
		
	}
	
	function show() 
	{

		$session = session::load();
		$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$AccountInf	= database::get()->selectSingle($sql, array(
			':userId'	=> $session->userId
		));  
		
		if(!$session->isValidSession())
		{
			$session->delete();			
			$this->assign(array(
			));
			$this->display('page.lobby.notlogged.tpl');
		}elseif(config::get()->game_disable == 0 && $AccountInf['authlevel'] < 3){
			HTTP::redirectTo('index.php?code=6');
		}else{
			$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
			$AccountInf	= database::get()->selectSingle($sql, array(
				':userId'	=> $session->userId
			));  
			
			$torRelay = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			if (strpos($torRelay, 'tor') !== false || strpos($torRelay, 'rev.cloud.scaleway') !== false)
				HTTP::redirectTo('index.php?page=torRelay');	
			
			if($AccountInf['isMailVerified'] == 0)
				HTTP::redirectTo('index.php?page=verifyemail');	
			
			$universe = HTTP::_GP('universe', 'wog', UTF8_SUPPORT);
			$authorisedArray = array('wog', 'wog2');
			if(!in_array($universe, $authorisedArray)) 
				HTTP::redirectTo('index.php');

			if($universe == "wog")
				$universe = "play";
			
			header('Location: https://'.$universe.'.'.$config->domain_name.'/check.php?referralID='.$AccountInf['ref_id'].'&email='.$AccountInf['email'].'&username='.$AccountInf['username'].'&lang='.$AccountInf['lang'].'&userId='.$AccountInf['id'].'&encodingplayer='.$AccountInf['encodage'].'&password='.$AccountInf['password'].''); 
			
		}
	}
}