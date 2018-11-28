
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

if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))) throw new Exception("Permission error!");


function ShowSendMessagesPage() {
	global $USER, $LNG;
	
	$ACTION	= HTTP::_GP('action', '');
	if ($ACTION == 'send')
	{
		switch($USER['authlevel'])
		{
			case AUTH_MOD:
				$class = 'mod';
			break;
			case AUTH_OPS:
				$class = 'ops';
			break;
			case AUTH_ADM:
				$class = 'admin';
			break;
			default:
				$class = '';
			break;
		}

		$Subject	= HTTP::_GP('subject', '', true);
		$Message 	= HTTP::_GP('text', '', true);
		$Mode	 	= HTTP::_GP('mode', 0);
		$Lang	 	= HTTP::_GP('lang', '');
		$typemsg	= HTTP::_GP('typemsg', 0);
		
		if($typemsg == 0){
			if (!empty($Message) && !empty($Subject))
			{
				require 'includes/classes/BBCode.class.php';
				$From    	= '<span class="'.$class.'">'.$LNG['user_level'][$USER['authlevel']].' '.$USER['username'].'</span>';
				$pmSubject 	= '<span class="'.$class.'">'.$Subject.'</span>';
				$pmMessage 	= '<span class="'.$class.'">'.BBCode::parse($Message).'</span>';
				$USERS		= $GLOBALS['DATABASE']->query("SELECT `id`, `username` FROM ".USERS." WHERE `universe` = 1;");
				foreach($USERS as $UserData)
				{
					PlayerUtil::sendMessage($UserData['id'], $USER['id'], $From, 50, $pmSubject, $pmMessage, TIMESTAMP, NULL, 1, Universe::getEmulated());
				}
			} else {
				//exit($LNG['ma_subject_needed']);
			}
		}elseif($typemsg == 1){
			require 'includes/classes/BBCode.class.php';
			$USERS		= $GLOBALS['DATABASE']->query("SELECT `id`, `username`, `avatar` FROM ".USERS." WHERE `universe` = 1 AND onlinetime > ".(TIMESTAMP > 7 * 24 * 60 * 60).";");
			foreach($USERS as $UserData)
			{				
				$SQL      = "INSERT INTO ".NOTIF." SET ";
				$SQL     .= "`userId` = '". $UserData['id'] ."', ";
				$SQL     .= "`timestamp` = '".TIMESTAMP."', ";
				$SQL     .= "`noText` = '« ".$USER['username']." » said: ".BBCode::parse($Message)."', ";
				$SQL     .= "`noImage` = '/media/files/".$USER['avatar']."', ";
				$SQL     .= "`isType` = 99;";
				$GLOBALS['DATABASE']->query($SQL);
			}
		}elseif($typemsg == 2){
			require 'includes/classes/BBCode.class.php';
			require 'includes/libs/pusher/Pusher.php';
			$deviceId = "";
			$USERS		= $GLOBALS['DATABASE']->query("SELECT deviceId FROM ".USERS." WHERE `universe` = 1 AND deviceId != '';");
			$apiKey = "AIzaSyAvUy2hrRH5C75AWwsfr_tfwx76tFThNZQ";
			$pusher = new Pusher($apiKey);
			
			foreach($USERS as $UserData)
			{	
				$regId = $UserData['deviceId'];
				$pusher->notify($regId, BBCode::parse($Message));
				//print_r($pusher->getOutputAsArray());
			}
		}
	}
	
	$template	= new template();
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->assign_vars(array(
		'langSelector' => array_merge(array('' => $LNG['ma_all']), $LNG->getAllowedLangs(false)),
		'modes' => $sendModes,
		'pageactiveshow'	=> HTTP::_GP('page', "", true),
	));
	$template->show('SendMessagesPage.tpl');
}