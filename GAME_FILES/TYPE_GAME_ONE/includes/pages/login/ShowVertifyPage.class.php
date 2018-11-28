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

class ShowVertifyPage extends AbstractLoginPage
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

		$validationID	= HTTP::_GP('i', 0);
		$validationKey	= HTTP::_GP('k', '');

		$db = Database::get();

		$sql = "SELECT * FROM %%USERS_VALID%%
		WHERE validationID	= :validationID
		AND validationKey	= :validationKey
		AND universe		= :universe;";

		$userData = $db->selectSingle($sql, array(
			':validationKey'	=> $validationKey,
			':validationID'		=> $validationID,
			':universe'			=> 1
		));

		if(empty($userData))
		{
			$this->printMessage($LNG['vertifyNoUserFound']);
		}

		$config	= Config::get();

		$sql = "DELETE FROM %%USERS_VALID%% WHERE validationID = :validationID;";
		$db->delete($sql, array(
			':validationID'	=> $validationID
		));

		list($userID, $planetID) = PlayerUtil::createPlayer($userData['universe'], $userData['userName'], $userData['password'], $userData['email'], $userData['language'], $validationID, $userData['encodage'], $userData['deviceId']);

		if(!empty($userData['referralID']))
		{
			$sql = "UPDATE %%USERS%% SET
			`ref_id`	= :referralId,
			`ref_bonus`	= 1
			WHERE
			`id`		= :userID;";

			$db->update($sql, array(
				':referralId'	=> $userData['referralID'],
				':userID'		=> $userID
			));
		}

		if(!empty($userData['externalAuthUID']))
		{
			$sql ="INSERT INTO %%USERS_AUTH%% SET
			`id`		= :userID,
			`account`	= :externalAuthUID,
			`mode`		= :externalAuthMethod;";
			$db->insert($sql, array(
				':userID'				=> $userID,
				':externalAuthUID'		=> $userData['externalAuthUID'],
				':externalAuthMethod'	=> $userData['externalAuthMethod']
			));
		}

		$senderName = $LNG['registerWelcomePMSenderName'];
		$subject 	= $LNG['registerWelcomePMSubject'];
		$message 	= sprintf($LNG['registerWelcomePMText'], $config->game_name, $userData['universe']);

		PlayerUtil::sendMessage($userID, 1, $senderName, 1, $subject, $message, TIMESTAMP);
		
		
		$session	= Session::create();
		$session->userId		= $validationID;
		$session->adminAccess	= 0;
		$session->save();

		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
	}
	
	function _activeUser()
	{
		global $LNG;

		$validationID	= HTTP::_GP('i', 0);
		$validationKey	= HTTP::_GP('k', '');

		$db = Database::get();

		$sql = "SELECT * FROM %%USERS_VALID%%
		WHERE validationID	= :validationID
		AND validationKey	= :validationKey
		AND universe		= :universe;";

		$userData = $db->selectSingle($sql, array(
			':validationKey'	=> $validationKey,
			':validationID'		=> $validationID,
			':universe'			=> 1
		));

		if(empty($userData))
		{
			$this->printMessage($LNG['vertifyNoUserFound']);
		}

		$config	= Config::get();

		$sql = "DELETE FROM %%USERS_VALID%% WHERE validationID = :validationID;";
		$db->delete($sql, array(
			':validationID'	=> $validationID
		));

		list($userID, $planetID) = PlayerUtil::createPlayer($userData['universe'], $userData['userName'], $userData['password'], $userData['email'], $userData['language'], $validationID);

		if(!empty($userData['referralID']))
		{
			$sql = "UPDATE %%USERS%% SET
			`ref_id`	= :referralId,
			`ref_bonus`	= 1
			WHERE
			`id`		= :userID;";

			$db->update($sql, array(
				':referralId'	=> $userData['referralID'],
				':userID'		=> $userID
			));
		}

		if(!empty($userData['externalAuthUID']))
		{
			$sql ="INSERT INTO %%USERS_AUTH%% SET
			`id`		= :userID,
			`account`	= :externalAuthUID,
			`mode`		= :externalAuthMethod;";
			$db->insert($sql, array(
				':userID'				=> $userID,
				':externalAuthUID'		=> $userData['externalAuthUID'],
				':externalAuthMethod'	=> $userData['externalAuthMethod']
			));
		}

		$senderName = $LNG['registerWelcomePMSenderName'];
		$subject 	= $LNG['registerWelcomePMSubject'];
		$message 	= sprintf($LNG['registerWelcomePMText'], $config->game_name, $userData['universe']);

		PlayerUtil::sendMessage($userID, 1, $senderName, 1, $subject, $message, TIMESTAMP);
		
		
		$session	= Session::create();
		$session->userId		= $validationID;
		$session->adminAccess	= 0;
		$session->save();

		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
	}

	function json()
	{
		global $LNG;
		$userData	= $this->_activeUser();
		$this->sendJSON(sprintf($LNG['vertifyAdminMessage'], $userData['userName']));
	}
}