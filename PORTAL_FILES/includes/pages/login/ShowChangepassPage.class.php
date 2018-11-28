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


class ShowChangepassPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
		$this->setWindow('light');
	}
	
	function show() 
	{
		global $LNG;
		
		$session = session::load();
		if(!$session->isValidSession())
		{
			$session->delete();			
			$this->assign(array(
			));
			$this->display('page.lobby.notlogged.tpl');
		}else{
		
			$this->assign(array(
			));
		
			$this->display('page.lobby.changepass.tpl');
		}
	}
	
	function send() 
	{
		global $LNG;
		
		$session = session::load();
		if(!$session->isValidSession())
		{
			$session->delete();			
			$this->assign(array(
			));
			$this->display('page.lobby.notlogged.tpl');
		}else{
		
			$password			= HTTP::_GP('passw', '');
			$newpassword		= HTTP::_GP('passw2', '');
			$Positive 			= 0;
			$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
			$AccountInf	= database::get()->selectSingle($sql, array(
				':userId'	=> $session->userId
			)); 
				
			if (!empty($newpassword) && PlayerUtil::cryptNewPassword('encrypt', $password) == $AccountInf["password"])
			{
				$newpass 	 = PlayerUtil::cryptNewPassword('encrypt', $newpassword);
				$Positive	 = 1;
				$sql = "UPDATE %%USERS%% SET password = :newpass WHERE id = :userID;";
				database::get()->update($sql, array(
						':newpass'	=> $newpass,
						':userID'	=> $AccountInf['id']
				));
			} 
			
			$this->assign(array(
			'Positive'		=> $Positive == 0 ? $LNG['lobby_22'] : $LNG['lobby_21'],
			));
		
			$this->display('page.lobby.passchanged.tpl');
		}
	}
}