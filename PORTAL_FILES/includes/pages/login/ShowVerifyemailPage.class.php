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


class ShowVerifyemailPage extends AbstractLoginPage
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
		//$allowedIds = array(1, 10283, 19222);
		if(!$session->isValidSession())
		{
			$session->delete();			
			$this->assign(array(
			));
			$this->display('page.lobby.notlogged.tpl');
		}else{
			$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
			$AccountInf	= database::get()->selectSingle($sql, array(
				':userId'	=> $session->userId
			));
			
			$isMailSendOk = 0;
			if($_SERVER['REQUEST_METHOD'] === 'POST'){
				$block_code_to_email   	= HTTP::_GP('block_code_to_email', 0);
				$email_block_code   	= HTTP::_GP('email_block_code', "");
				
				if(!empty($block_code_to_email) && $block_code_to_email == 1 && $AccountInf['isVerifySend'] < TIMESTAMP){
					$theKey = md5(uniqid('2m'));
					$ValidKey = '<div style="margin:0;padding:0 0 50px 0;background:#d8d8d8 no-repeat 0;"><table style="width:400px;" width="400" align="center" cellspacing="0" cellpadding="0"><tbody><tr><td style="padding-bottom:20px;" valign="top"></td></tr><tr><td style="height:82px;" valign="bottom"><img src="https://warofgalaxyz.com/media/images/xterium_logo.png" style="vertical-align:bottom;" alt="warofgalaxyz.png" height="157"></td></tr><tr><td style="padding-bottom:5px;" valign="top"></td></tr><tr><td><div style="width:320px;padding:40px;text-align:left;font-size:13px;font-family:Arial, \'sans-serif\';background:#ffffff;"><span style="font-size:15px;">Secret code:<br><strong>'.$theKey.'</strong></span></div></td></tr><tr><td style="padding-top:5px;line-height:17px;font-size:12px;font-family:Arial, \'sans-serif\';" align="center">&copy; warofgalaxyz.com</td></tr></tbody></table></div>';
					$ValidKey2 = "Secret code: ".$theKey."<br><br>&copy; warofgalaxyz.com";
				
				$sql	= "UPDATE %%USERS%% SET validationMailAdress = :validationMailAdress, isVerifySend = :isVerifySend WHERE id = :userId;";
					database::get()->update($sql, array(
						':validationMailAdress'	=> $theKey,
						':isVerifySend'			=> TIMESTAMP + 24 * 3600,
						':userId'				=> $session->userId,
					));
					require 'includes/libs/Mailer/Mailin.php';
					$mailin = new Mailin('info@warofgalaxyz.com', 'nMQrhzIbZktmKfqJ');
					$mailin->
					addTo($AccountInf['email'], $AccountInf['username'])->
					setFrom('support@warofgalaxyz.com', 'Support #WOG')->
					setReplyTo('support@warofgalaxyz.com','Support #WOG')->
					setSubject('Confirm E-mail on #WOG')->
					setText($ValidKey2)->
					setHtml($ValidKey);
					$res = $mailin->send();
					$isMailSendOk = 1;
				}elseif(!empty($email_block_code) && $email_block_code == $AccountInf['validationMailAdress']){
					$sql	= "UPDATE %%USERS%% SET isMailVerified = 1 WHERE id = :userId;";
					database::get()->update($sql, array(
						':userId'				=> $session->userId,
					));
					HTTP::redirectTo('index.php');
				}
			}
			
			$this->assign(array(
				'isMailSendOk' => $isMailSendOk,
			));
			
			$this->display('page.verify.email.tpl');
		}
	}
}