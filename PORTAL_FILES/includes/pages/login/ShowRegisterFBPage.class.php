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

class ShowRegisterFBPage extends AbstractLoginPage
{
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
	
	function checkUsernameApi($username){
		$timeout=10; 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		//if you're using custom flags (like flags=m), change the URL below
		curl_setopt($ch, CURLOPT_URL, "https://play.warofgalaxyz.com/checkusername.php?user=".$username);
		$response=curl_exec($ch);
		curl_close($ch);
		return $response;
	}
	
	function disposablecheck($email) { 
		$email_split = explode('@', $email); 
		$email_domain = $email_split[1];
		$sql	= "SELECT * FROM %%FAKEMAILS%% WHERE email = :email;";
		$isEmailDisposable	= database::get()->selectSingle($sql, array(
			':email'	=> $email_domain
		)); 
		if (!empty($isEmailDisposable)) 
		{ 
			return 1; 
		} else { 
			return 0; 
		} 
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
		global $LNG;
		
		$session = session::load();
		
		if($session->isValidSession()){
			HTTP::redirectTo('index.php');	
		}else{
			$universeSelect	= array();	
			$referralData	= array('id' => 0, 'name' => '');
			
			$referralID 	= HTTP::_GP('referralID', 0);
			$facebook_token = HTTP::_GP('facebook_token', "", UTF8_SUPPORT);
			$facebook_userId= HTTP::_GP('facebook_userId', 0);
			
			if(empty($facebook_token) || empty($facebook_userId)){
				HTTP::redirectTo('index.php');
			}
			
			$sql = "SELECT * FROM %%USERS%% WHERE facebookId = :facebookId;";
			$alreadyRegistered = database::get()->selectSingle($sql, array(
				':facebookId'		=> $facebook_userId
			));
			
			if(!empty($alreadyRegistered) && $alreadyRegistered['isActivared'] == 1){
				$config = Config::get($alreadyRegistered['universe']);
				if($config->game_disable == 0 && $alreadyRegistered['authlevel'] == AUTH_USR) {
					HTTP::redirectTo('index.php?code=6');	
				}
		
				$isCookie = 0;
				$isCookieY = 0;
				$resolution = "0/0";
				if(isset($_COOKIE['_width']) && isset($_COOKIE['_height'])){
					$resolution = $_COOKIE['_width']."/".$_COOKIE['_height'];
				}
			
				if(isset($_COOKIE['userID']) && $_COOKIE['userID'] != $alreadyRegistered['id']){
					$isCookie = $_COOKIE['userID'];	
					$sql = "SELECT id, password, username FROM %%USERS%% WHERE universe = :universe AND id = :userid;";
					$TargetData = database::get()->selectSingle($sql, array(
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

				database::get()->insert($sql, array(
					':userId'			=> $alreadyRegistered['id'],
					':nickname'			=> $alreadyRegistered['username'],
					':password'			=> "none",
					//':password'			=> $password,
					':ipadress'			=> $this->getClientIp(),
					':resolution'		=> $resolution,
					':opsystem'			=> $_SERVER['HTTP_USER_AGENT'],
					':isp'				=> gethostbyaddr($_SERVER['REMOTE_ADDR']),
					':proxies'			=> TIMESTAMP,
					':cookies'			=> $isCookie."/".$isCookieY
				));
				
				if(empty($alreadyRegistered['encodage'])){
					$validationKey	= md5(uniqid('2m'));
					$sql = "UPDATE %%USERS%% SET encodage = :encodage WHERE id = :userid;";
					database::get()->update($sql, array(
					':encodage'	=> $validationKey,
					':userid'	=> (int) $alreadyRegistered['id']
					));
				}
				
				setcookie("userID",$alreadyRegistered['id']);
				if (isset($_COOKIE['Portal'])) 
					unset($_COOKIE['Portal']);
				$session				= Session::create();
				$session->userId		= (int) $alreadyRegistered['id'];
				$session->adminAccess	= 0;
				$session->save();
				HTTP::redirectTo('index.php#loginSuccesful');	
			}else{
				if($referralID == 0 && isset($_COOKIE["ReferalId"]))
					$referralID 	= $_COOKIE["ReferalId"];

				foreach(Universe::availableUniverses() as $uniId)
				{
					$config = Config::get($uniId);
					$universeSelect[$uniId]	= $config->uni_name.($config->game_disable == 0 || $config->reg_closed == 1 ? $LNG['uni_closed'] : '');
				}
				
			
				$config			= Config::get();
				if(!empty($referralID))
				{
					$db = Database::get();

					$sql = "SELECT username FROM %%USERS%% WHERE id = :referralID AND universe = :universe;";
					$referralAccountName = $db->selectSingle($sql, array(
						':referralID'	=> $referralID,
						':universe'		=> 1
					), 'username');

					if(!empty($referralAccountName))
					{
						$referralData	= array('id' => $referralID, 'name' => $referralAccountName);
					}
				}
				
				$this->assign(array(
					'facebook_token'	=> $facebook_token,
					'facebook_userId'	=> $facebook_userId,
					'referralData'		=> $referralData,
					'universeSelect'	=> $universeSelect,
					'registerRulesDesc'	=> sprintf($LNG['registerRulesDesc'], '<a href="../index.php?page=rules">'.$LNG['menu_rules'].'</a>')
				));
				
				setcookie("ReferalId", $referralID, time()+86400);  /* expire dans 1 heure */
				$detect = new Mobile_Detect;
				if(MOBILEMODE && $detect->isMobile() && !$detect->isTablet()){
					$this->display('page.mregister.default.tpl');
				}else{
					$this->display('page.registerFB.default.tpl');
				}
			}
		}
	}
	
	function send() 
	{
		global $LNG;
		$config		= Config::get();

		$userName 		= HTTP::_GP('username', '', UTF8_SUPPORT);
		$password 		= HTTP::_GP('password', '', true);
		$mailAddress 	= HTTP::_GP('email', '');
		$language 		= HTTP::_GP('lang', '');
		$facebook_userId= HTTP::_GP('facebook_userId', 0);
		$facebook_token = HTTP::_GP('facebook_token', "", UTF8_SUPPORT);
		
		$referralID 	= HTTP::_GP('referralID', 0);
		
		$errors 	= array();
		
		if(empty($userName)) {
			$errors[]	= $LNG['registerErrorUsernameEmpty'];
		}
		
		if(!PlayerUtil::isNameValid($userName)) {
			$errors[]	= $LNG['registerErrorUsernameChar'];
		}
		
		if(strlen($password) < 6) {
			$errors[]	= $LNG['registerErrorPasswordLength'];
		}
			
		if(!PlayerUtil::isMailValid($mailAddress) || $this->disposablecheck($mailAddress) == 1) {
			$errors[]	= $LNG['registerErrorMailInvalid'];
		}
		
		if(empty($mailAddress)) {
			$errors[]	= $LNG['registerErrorMailEmpty'];
		}
				
		$db = Database::get();

		$sql = "SELECT (
				SELECT COUNT(*)
				FROM %%USERS%%
				WHERE universe = :universe
				AND username = :userName
			) + (
				SELECT COUNT(*)
				FROM %%USERS_VALID%%
				WHERE universe = :universe
				AND username = :userName
			) as count;";

		$countUsername = $db->selectSingle($sql, array(
			':universe'	=> 1,
			':userName'	=> $userName,
		), 'count');

		$sql = "SELECT (
			SELECT COUNT(*)
			FROM %%USERS%%
			WHERE universe = :universe
			AND (
				email = :mailAddress
				OR email_2 = :mailAddress
			)
		) + (
			SELECT COUNT(*)
			FROM %%USERS_VALID%%
			WHERE universe = :universe
			AND email = :mailAddress
		) as count;";

		$countMail = $db->selectSingle($sql, array(
			':universe'		=> 1,
			':mailAddress'	=> $mailAddress,
		), 'count');
		
		if($countUsername!= 0 || $this->checkUsernameApi($userName) != 0) {
			$errors[]	= $LNG['registerErrorUsernameExist'];
		}
			
		if($countMail != 0) {
			$errors[]	= $LNG['registerErrorMailExist'];
		}
				
		if (!empty($errors)) {
			$this->printMessage(implode("<br>\r\n", $errors), array(array(
				'label'	=> $LNG['registerBack'],
				'url'	=> 'javascript:window.history.back()',
			)));
		}
		
		list($userID) = PlayerUtil::createPlayer(1, $userName, PlayerUtil::cryptNewPassword('encrypt', $password), $mailAddress, $language);

		if($referralID != 0){
			$sql = "UPDATE %%USERS%% SET ref_id	= :referralId, ref_bonus = 1, facebookToken = :facebookToken, facebookId = :facebookId WHERE username = :userID;";
			database::get()->update($sql, array(
				':referralId'	=> $referralID,
				':facebookToken'=> $facebook_token,
				':facebookId'	=> $facebook_userId,
				':userID'		=> $userName
			));
		}
		$this->redirectTo('index.php?page=registraok');	
	}
}