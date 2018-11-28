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


class ShowLostPasswordPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
		
		
		$detect = new Mobile_Detect;
if(MOBILEMODE && $detect->isMobile() && !$detect->isTablet()){
$this->setWindow('mlight');
}else{
$this->setWindow('light');
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
		
		$this->assign(array(
		));
		
		
		
		$detect = new Mobile_Detect;
if(MOBILEMODE && $detect->isMobile() && !$detect->isTablet()){
$this->display('page.mlostPassword.default.tpl');
}else{
$this->display('page.lostPassword.default.tpl');
}
	}
	
	function newPassword() 
	{
		global $LNG;
		$userID			= HTTP::_GP('u', 0);
		$validationKey	= HTTP::_GP('k', '');

		$db = Database::get();

		$sql = "SELECT COUNT(*) as state FROM %%LOSTPASSWORD%% WHERE userID = :userID AND `key` = :validationKey AND `time` > :time AND hasChanged = 0;";
		$isValid = $db->selectSingle($sql, array(
			':userID'			=> $userID,
			':validationKey'	=> $validationKey,
			':time'				=> (TIMESTAMP - 1800)
		), 'state');

		if(empty($isValid))
		{
			$this->printMessage($LNG['passwordValidInValid'], array(array(
				'label'	=> $LNG['passwordBack'],
				'url'	=> '../index.php',
			)));
		}
		
		$newPassword	= uniqid();

		$sql = "SELECT username, email_2 as mail, universe FROM %%USERS%% WHERE id = :userID;";
		$userData = $db->selectSingle($sql, array(
			':userID'	=> $userID,
		));

		$config			= Config::get($userData['universe']);

		$MailRAW		= $LNG->getTemplate('email_lost_password_changed');
		$MailContent	= str_replace(array(
			'{USERNAME}',
			'{EMAIL}',
			'{IP}',
			'{PASSWORD}',
		), array(
			$userData['username'],
			$userData['mail'],
			Session::getClientIp(),
			$newPassword,
		), $MailRAW);
		
		$sql = "UPDATE %%USERS%% SET password = :newPassword WHERE id = :userID;";
		$db->update($sql, array(
			':userID'		=> $userID,
			':newPassword'	=> PlayerUtil::cryptNewPassword('encrypt', $newPassword)
		));
		
		require 'includes/libs/Mailer/Mailin.php';
		$mailin = new Mailin('info@warofgalaxyz.com', 'nMQrhzIbZktmKfqJ');
		$mailin->
		addTo($userData['mail'], $userData['username'])->
		setFrom('support@warofgalaxyz.com', 'Support #WOG')->
		setReplyTo('support@warofgalaxyz.com','Support #WOG')->
		setSubject(sprintf($LNG['passwordChangedMailTitle'], $config->game_name))->
		setText($MailContent)->
		setHtml($MailContent);
		$res = $mailin->send();
					
		$sql = "UPDATE %%LOSTPASSWORD%% SET hasChanged = 1 WHERE userID = :userID AND `key` = :validationKey;";
		$db->update($sql, array(
			':userID'			=> $userID,
			':validationKey'	=> $validationKey
		));

		$this->printMessage($LNG['passwordChangedMailSend'], array(array(
			'label'	=> $LNG['passwordNext'],
			'url'	=> '../index.php',
		)));
	}
	
	function send()
	{
		global $LNG;
  	$mail		= HTTP::_GP('email', '', true);
		
		$errorMessages	= array();
		
		if(empty($mail))
		{
			$errorMessages[]	= $LNG['passwordErrorMailEmpty'];
		}

		$config	= Config::get();

		if(!empty($errorMessages))
		{
			$message	= implode("<br>\r\n", $errorMessages);
			$this->printMessage($message, array(array(
				'label'	=> $LNG['passwordBack'],
				'url'	=> '../index.php?page=lostPassword',
			)));
		}
		
		$db = Database::get();

		$sql = "SELECT id FROM %%USERS%% WHERE universe = :universe AND email_2 = :mail;";
		$userID = $db->selectSingle($sql, array(
			':universe'	=> Universe::current(),
			':mail'		=> $mail
		), 'id');
		
		$sql = "SELECT username FROM %%USERS%% WHERE universe = :universe AND email_2 = :mail;";
		$username = $db->selectSingle($sql, array(
			':universe'	=> Universe::current(),
			':mail'		=> $mail
		), 'username');
		
		if(empty($userID))
		{
			$this->printMessage($LNG['passwordErrorUnknown'], array(array(
				'label'	=> $LNG['passwordBack'],
				'url'	=> '../index.php?page=lostPassword',
			)));
		}

		$sql = "SELECT COUNT(*) as state FROM %%LOSTPASSWORD%% WHERE userID = :userID AND time > :time AND hasChanged = 0;";
		$hasChanged = $db->selectSingle($sql, array(
			':userID'	=> $userID,
			':time'		=> (TIMESTAMP - 86400)
		), 'state');

		if(!empty($hasChanged))
		{
			$this->printMessage($LNG['passwordErrorOnePerDay'], array(array(
				'label'	=> $LNG['passwordBack'],
				'url'	=> '../index.php?page=lostPassword',
			)));
		}

		$validationKey	= md5(uniqid());
						
		$MailRAW		= $LNG->getTemplate('email_lost_password_validation');
		
		$MailContent	= str_replace(array(
			'{USERNAME}',
			'{EMAIL}',
			'{IP}',
			'{VALIDURL}',
		), array(
			$username,
			$mail,
			Session::getClientIp(),
			HTTP_PATH.'index.php?page=lostPassword&mode=newPassword&u='.$userID.'&k='.$validationKey,
		), $MailRAW);
		

		require 'includes/classes/Mailin.php'; 
		$mailin = new Mailin('https://api.sendinblue.com/v2.0','yzZLKOT2Vx3J4ScG');
		$data = array( "to" => array($mail=>$username), "from" => array("support@warofgalaxyz.com","War Of Galaxyz: The Game"), "subject" => sprintf($LNG['passwordValidMailTitle'], $config->game_name), "text" => $MailContent, "html" => $MailContent, "attachment" => array(), "headers" => array("Content-Type"=> "text/html; charset=iso-8859-1"));
		$mailin->send_email($data);


		$sql = "INSERT INTO %%LOSTPASSWORD%% SET userID = :userID, `key` = :validationKey, `time` = :timestamp, fromIP = :remoteAddr;";
		$db->insert($sql, array(
			':userID'		=> $userID,
			':timestamp'	=> TIMESTAMP,
			':validationKey'=> $validationKey,
			':remoteAddr'	=> Session::getClientIp()
		));

		$this->printMessage($LNG['passwordValidMailSend'], array(array(
			'label'	=> $LNG['passwordNext'],
			'url'	=> '../index.php',
		)));
	}
}