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

class ShowRegisterPage extends AbstractLoginPage
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
		$torRelay = gethostbyname($email_split[1]);
		$torRelay = gethostbyaddr($torRelay);
		if (!empty($isEmailDisposable) || strpos($torRelay, 'wikimedia.org') !== false) 
		{ 
			return 1; 
		} else { 
			return 0; 
		} 
	}

	function show()
	{
		global $LNG;
		
		$session = session::load();
		
		if($session->isValidSession())
		{
			HTTP::redirectTo('index.php');	
		}else{
			$universeSelect	= array();	
			$referralData	= array('id' => 0, 'name' => '');
			$accountName	= "";
			
			$externalAuth	= HTTP::_GP('externalAuth', array());
			$referralID 	= HTTP::_GP('referralID', 0);
			if($referralID == 0 && isset($_COOKIE["ReferalId"]))
			$referralID 	= $_COOKIE["ReferalId"];

			foreach(Universe::availableUniverses() as $uniId)
			{
				$config = Config::get($uniId);
				$universeSelect[$uniId]	= $config->uni_name.($config->game_disable == 0 || $config->reg_closed == 1 ? $LNG['uni_closed'] : '');
			}
			
			if(!isset($externalAuth['account'], $externalAuth['method']))
			{
				$externalAuth['account']	= 0;
				$externalAuth['method']		= '';
			}
			else
			{
				$externalAuth['method']		= strtolower(str_replace(array('_', '\\', '/', '.', "\0"), '', $externalAuth['method']));
			}
			
			if(!empty($externalAuth['account']) && file_exists('includes/extauth/'.$externalAuth['method'].'.class.php'))
			{
				$path	= 'includes/extauth/'.$externalAuth['method'].'.class.php';
				require($path);
				$methodClass	= ucwords($externalAuth['method']).'Auth';
				/** @var $authObj externalAuth */
				$authObj		= new $methodClass;
				
				if(!$authObj->isActiveMode())
				{
					$this->redirectTo('../index.php?code=5');
				}
				
				if(!$authObj->isValid())
				{
					$this->redirectTo('../index.php?code=4');
				}
				
				$accountData	= $authObj->getAccountData();
				$accountName	= $accountData['name'];
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
				'referralData'		=> $referralData,
				'accountName'		=> $accountName,
				'externalAuth'		=> $externalAuth,
				'universeSelect'	=> $universeSelect,
				'registerRulesDesc'	=> sprintf($LNG['registerRulesDesc'], '<a href="../index.php?page=rules">'.$LNG['menu_rules'].'</a>')
			));
			
			setcookie("ReferalId", $referralID, time()+86400);  /* expire dans 1 heure */
			$detect = new Mobile_Detect;
			if(MOBILEMODE && $detect->isMobile() && !$detect->isTablet()){
				$this->display('page.mregister.default.tpl');
			}else{
				$this->display('page.register.default.tpl');
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
			
		if(!PlayerUtil::isMailValid($mailAddress)) {
			$errors[]	= $LNG['registerErrorMailInvalid'];
		}
		if ($this->disposablecheck($mailAddress) == 1) { 
			$errors[]	= "You can not use disposable emails";
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
			$sql = "UPDATE %%USERS%% SET ref_id	= :referralId, ref_bonus = 1 WHERE username = :userID;";
			database::get()->update($sql, array(
				':referralId'	=> $referralID,
				':userID'		=> $userName
			));
		}
		
		$this->redirectTo('index.php?page=registraok');	
	}
}