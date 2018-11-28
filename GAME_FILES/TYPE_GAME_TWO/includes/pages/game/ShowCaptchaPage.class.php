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

class ShowCaptchaPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
	}
	
	function send()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		$Number = HTTP::_GP('number', 1);
		$Page 	= HTTP::_GP('page', 'overview');
		$correctAnswer = $USER['isCaptchaCode'];
		
		if($Number == 1)
		$givenAnswer = $USER['isNuberOne'];
		elseif($Number == 2)
		$givenAnswer = $USER['isNuberTwo'];
		elseif($Number == 3)
		$givenAnswer = $USER['isNuberThree'];
		elseif($Number < 1 || $Number > 3)
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=captcha');
		
		if($givenAnswer == $correctAnswer){
		$db	= Database::get();	
		$sql	= 'UPDATE %%USERS%% SET isCaptcha = :isCaptcha, isCaptchaCode = :isCaptchaCode, isCaptchaClick = :isCaptchaClick WHERE id = :userID;';
		$db->update($sql, array(
			':isCaptcha'	=> 0,
			':isCaptchaCode'	=> 0,
			':isCaptchaClick'	=> 0,
			':userID'	=> $USER['id'],
		));	
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=overview');	
		}else{
		
		$db	= Database::get();	
		$sql	= 'UPDATE %%USERS%% SET isCaptchaClick = isCaptchaClick + :isCaptchaClick WHERE id = :userID;';
		$db->update($sql, array(
			':isCaptchaClick'	=> 1,
			':userID'	=> $USER['id'],
		));	
			
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=captcha');	
		}
		
	}

	function show()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		if($USER['isCaptcha'] == 0)
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=overview');
		
		$PageVisit = HTTP::_GP('page', 'Captcha', UTF8_SUPPORT);
		if($USER['isCaptchaClick'] >= 5){
		$message = '<span class="admin">The player '.$USER['username'].' clicked on the page '.$PageVisit.'</span>';			
		PlayerUtil::sendMessage(1, '', 'Robot System', 50, 'Robot Info', $message, TIMESTAMP);
		}
		
		$correctAnswer = mt_rand(1,3);
		$isCaptchaCode = mt_rand(2,17);
		$isNuberOne = mt_rand(2,17);
		if($correctAnswer == 1)
		$isNuberOne = $isCaptchaCode;
		$isNuberTwo = mt_rand(2,17);
		if($correctAnswer == 2)
		$isNuberTwo = $isCaptchaCode;
		$isNuberThree = mt_rand(2,17);
		if($correctAnswer == 3)
		$isNuberThree = $isCaptchaCode;
	
		$db	= Database::get();	
		$sql	= 'UPDATE %%USERS%% SET isCaptchaCode = :isCaptchaCode, isNuberOne = :isNuberOne, isNuberTwo = :isNuberTwo, isNuberThree = :isNuberThree, isCaptchaClick = isCaptchaClick + :isCaptchaClick WHERE id = :userID;';
		$db->update($sql, array(
		':isCaptchaClick'	=> 1,
		':isCaptchaCode'	=> $isCaptchaCode,
		':isNuberOne'	=> $isNuberOne,
		':isNuberTwo'	=> $isNuberTwo,
		':isNuberThree'	=> $isNuberThree,
		':userID'	=> $USER['id'],
		));
		
		if($USER['isCaptchaClick'] > 15){
		$sql = "INSERT INTO %%BANNED%% SET who	= :who, theme = :theme, time= :time, longer = :longer, author = :author, isChat = :isChat, universe = :universe, email = :email;";
		$db->insert($sql, array(
		':who'	=> $USER['username'],
		':theme'			=> 'Scripting',
		':time'				=> TIMESTAMP,
		':longer'			=> (TIMESTAMP + 7*24*3600),
		':author'			=> 'System',
		':isChat'			=> 0,
		':universe'			=> 1,
		':email'			=>'support@warofgalaxyz.com'
		));	
		
		$sql	= 'UPDATE %%USERS%% SET bana = :bana, banaday = :banaday, urlaubs_modus = :urlaubs_modus WHERE id = :userID;';
		$db->update($sql, array(
		':bana'	=> 1,
		':banaday'	=> (TIMESTAMP + 7*24*3600),
		':urlaubs_modus'	=> 1,
		':userID'	=> $USER['id']
		));
		}
		
		$this->assign(array(
		'isCaptchaCode' => $isCaptchaCode,
		'isNumberOne' => $isNuberOne,
		'isNumberTwo' => $isNuberTwo,
		'isNumberThree' => $isNuberThree,
		//'showImage' => mt_rand(1,2),
		'showImage' => 1,
		));
		
		$this->display('page.captcha.default.tpl');
	}
}
