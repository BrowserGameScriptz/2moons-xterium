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


class ShowLobbyPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
		$this->setWindow('light');
	}
	
	function activateUser() 
	{
		
		global $LNG;
		$uid 	= HTTP::_GP('i', 0);
		$validationKey 	= HTTP::_GP('k', '');
		
		
		$sql = "SELECT * FROM %%USERS%% WHERE id = :id AND validationKey = :validationKey;";
		$loginData = database::get()->selectSingle($sql, array(
			':id'	=> $uid,
			':validationKey'	=> $validationKey
		));
		
		if(isset($loginData) && $loginData['isActivared'] == 0){
			$sql = "UPDATE %%USERS%% SET isActivared = 1 WHERE id = :id;";
			database::get()->update($sql, array(
				':id'	=> $uid
			));
		}
		
		$this->redirectTo('index.php?page=registraok');
		

	}
	
	function notactive() 
	{
		
		global $LNG;
		$uid 	= HTTP::_GP('uid', 0);
		$email 	= HTTP::_GP('email', '', UTF8_SUPPORT);
		$username 	= HTTP::_GP('username', '', UTF8_SUPPORT);
		
		$sql = "SELECT * FROM %%USERS%% WHERE id = :id AND username = :username AND email = :email;";
		$loginData = database::get()->selectSingle($sql, array(
			':id'	=> $uid,
			':username'	=> $username,
			':email'	=> $email
		));
		
		if(isset($loginData) && $loginData['isActivared'] == 0 && $loginData['isMailSend'] < TIMESTAMP){
		
		$validationKey	= md5(uniqid('2m'));
		$verifyURL	= 'index.php?page=lobby&mode=activateUser&i='.$uid.'&k='.$validationKey;
		$sql = "UPDATE %%USERS%% SET isMailSend = :ismailsend, validationKey = :validationKey WHERE id = :id;";
		database::get()->update($sql, array(
			':id'	=> $uid,
			':ismailsend'	=> TIMESTAMP + 24*3600,
			':validationKey'	=> $validationKey
		));
		
		require 'includes/classes/Mail.class.php';
			$MailRAW		= $LNG->getTemplate('email_vaild_reg');
			$MailContent	= str_replace(array(
				'{USERNAME}',
				'{EMAIL}',
				'{GAMENAME}',
				'{VERTIFYURL}',
				'{GAMEMAIL}',
			), array(
				$username,
				$email,
				config::get()->game_name.' - '.config::get()->uni_name,
				HTTP_PATH.$verifyURL,
				config::get()->smtp_sendmail,
			), $MailRAW);
			$subject	= sprintf($LNG['registerMailVertifyTitle'], config::get()->game_name);
			Mail::send($email, $username, $subject, $MailContent);
		
		}
		$this->assign(array(
		));
		
		$this->display('page.lobby.notactive.tpl');
		

	}
	
	function show() 
	{
		
		global $LNG;
		
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache"); // HTTP/1.0
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
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
		
			$this->display('page.lobby.default.tpl');
		}

	}
}