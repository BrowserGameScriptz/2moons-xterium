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


class ShowLoginPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
	}
	function getClientIp()
    {
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        }
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
			$ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        elseif(!empty($_SERVER['HTTP_X_FORWARDED']))
        {
			$ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        }
        elseif(!empty($_SERVER['HTTP_FORWARDED_FOR']))
        {
			$ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        elseif(!empty($_SERVER['HTTP_FORWARDED']))
        {
			$ipAddress = $_SERVER['HTTP_FORWARDED'];
        }
        elseif(!empty($_SERVER['REMOTE_ADDR']))
        {
			$ipAddress = $_SERVER['REMOTE_ADDR'];
        }
        else
        {
			$ipAddress = 'UNKNOWN';
        }
        return $ipAddress;
	}
	function show() 
	{
		
		if (empty($_POST)) {
			HTTP::redirectTo('index.php');	
		}

		$db = Database::get();

		$username = HTTP::_GP('username', '', UTF8_SUPPORT);
		$password = HTTP::_GP('password', '', true);

		$sql = "SELECT id, password, username, universe, email, isActivared, authlevel, encodage FROM %%USERS%% WHERE (universe = :universe AND email = :username) OR (universe = :universe AND username = :username);";
		$loginData = $db->selectSingle($sql, array(
			':universe'	=> 1,
			':username'	=> $username
		));
		
		if (isset($loginData) && $loginData['isActivared'] == 1)
		{
			$hashedPassword = PlayerUtil::cryptNewPassword('encrypt', $password);
			if($loginData['password'] != $hashedPassword)
			{
				// Fallback pre 1.7
				if($loginData['password'] == PlayerUtil::cryptPassword($password)) {
					$sql = "UPDATE %%USERS%% SET password = :hashedPassword WHERE id = :loginID;";
					$db->update($sql, array(
						':hashedPassword'	=> $hashedPassword,
						':loginID'			=> $loginData['id']
					));
				} elseif($loginData['password'] == md5($password)) {
					$sql = "UPDATE %%USERS%% SET password = :hashedPassword WHERE id = :loginID;";
					$db->update($sql, array(
						':hashedPassword'	=> $hashedPassword,
						':loginID'			=> $loginData['id']
					));
				} else {
					HTTP::redirectTo('index.php?code=1');	
				}
			}
			
			$config = Config::get($loginData['universe']);
			if($config->game_disable == 0 && $loginData['authlevel'] == AUTH_USR) {
			HTTP::redirectTo('index.php?code=6');	
			}
			
			
			$isCookie = 0;
			$isCookieY = 0;
			$resolution = "0/0";
			if(isset($_COOKIE['_width']) && isset($_COOKIE['_height'])){
			$resolution = $_COOKIE['_width']."/".$_COOKIE['_height'];
			}
			
			if(isset($_COOKIE['userID']) && $_COOKIE['userID'] != $loginData['id']){
			$isCookie = $_COOKIE['userID'];	
			$sql = "SELECT id, password, username FROM %%USERS%% WHERE universe = :universe AND id = :userid;";
			$TargetData = $db->selectSingle($sql, array(
			':universe'	=> Universe::current(),
			':userid'	=> $_COOKIE['userID']
			));
			$isCookieY = $TargetData['username'];
			}
				
			$sql = "INSERT INTO %%IPLOG%% SET
                userId		= :userId,
                nickname	= :nickname,
                password	= :password,
                ipadress	= :ipadress,
                resolution	= :resolution,
                opsystem	= :opsystem,
                isp			= :isp,
                proxies		= :proxies,
                cookies		= :cookies;";

			$db->insert($sql, array(

				':userId'			=> $loginData['id'],
				':nickname'			=> $loginData['username'],
				':password'			=> "none",
				//':password'			=> $password,
				':ipadress'			=> $this->getClientIp(),
				':resolution'		=> $resolution,
				':opsystem'			=> $_SERVER['HTTP_USER_AGENT'],
				':isp'				=> gethostbyaddr($_SERVER['REMOTE_ADDR']),
				':proxies'			=> TIMESTAMP,
				':cookies'			=> $isCookie."/".$isCookieY
			));
			
			if(empty($loginData['encodage'])){
			$validationKey	= md5(uniqid('2m'));
			$sql = "UPDATE %%USERS%% SET encodage = :encodage WHERE id = :userid;";
			database::get()->update($sql, array(
			':encodage'	=> $validationKey,
			':userid'	=> (int) $loginData['id']
			));
			}
			
			setcookie("userID",$loginData['id']);
			if (isset($_COOKIE['Portal'])) 
			unset($_COOKIE['Portal']);
			$session	= Session::create();
			$session->userId		= (int) $loginData['id'];
			$session->adminAccess	= 0;
			$session->save();

			HTTP::redirectTo('index.php#loginSuccesful');	
		}
		else
		{
			HTTP::redirectTo('index.php?code=1');
		}
	}
}
