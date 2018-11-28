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

class ShowComplaintMsgPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
		require('includes/classes/class.SupportTickets.php');
		$this->ticketObj	= new SupportTickets;
		$this->setWindow('popup');
		$this->initTemplate(); 
	}
	
	public function send()
	{
		global $LNG, $resource, $USER, $PLANET, $pricelist;
		$MsgId 		= HTTP::_GP('id', 0);
		$type_compl = HTTP::_GP('type_compl', 1);
		$comment	= HTTP::_GP('comment', '', UTF8_SUPPORT);
		
		$Subject = "";
		$domain  = "";
		
		if($type_compl == 1){
			$Subject = $LNG['complain_6'];	
		}else{
			$Subject = $LNG['complain_7'];	
			$domain	 = HTTP::_GP('domain', '', true);
			$domain = preg_replace("(^https?://)", "", $domain);
			$domain  = str_replace(" ", "", $domain);
			$domain	 = explode('.', $domain);
			$domain	= $domain[0];
			$domain  = preg_replace('/[^A-Za-z0-9\-]/', '', $domain); // Removes special chars.
			$domain  = strtolower($domain);
		}
		
		$db	= Database::get();
		$sql = "SELECT message_id, message_time, message_sender, CONCAT(username, ' [',galaxy, ':', system, ':', planet,']') as message_from, message_text
			FROM %%MESSAGES%% INNER JOIN %%USERS%% ON id = message_sender
			WHERE message_id = :message_id;";
		$msg_info = $db->selectSingle($sql, array(
			':message_id'	=> $MsgId
		));
		
		$myString  = str_replace(" ", "", $msg_info['message_text']);
		$myString  = preg_replace('/[^A-Za-z0-9\-]/', '', $myString); // Removes special chars.
		$myString  = strtolower($myString);
		
		if(stripos($myString, $domain) === false && $type_compl == 2){
			$this->printMessage("The game url is not found in the received message ".$myString, true, array('game.php?page=messages', 2));
		}else{
			$sql	= 'SELECT * FROM %%BLACKLIST%% WHERE blackText = :blackText;';
			$blackList = Database::get()->select($sql, array(
				':blackText'		=> $domain,
			));
			
			if($type_compl == 2){
				if(empty($blackList)){
					$sql = "INSERT INTO %%BLACKLIST%% SET
						blackText			= :blackText,
						blackTime			= :blackTime,
						blackBy				= :blackBy;";

					$db->insert($sql, array(
						':blackText'		=> $domain,
						':blackTime'		=> TIMESTAMP,
						':blackBy'			=> $USER['id']
					));
				}
				$domain = $this->getUsername($msg_info['message_sender'])." send: ".$msg_info['message_text']."<hr> The following domain name has been blacklisted: ".$domain;
				$ticketID	= $this->ticketObj->createTicket($USER['id'], 5, $Subject);
				$this->ticketObj->createAnswer($ticketID, $USER['id'], $USER['username'], $Subject, $domain, 0);
				$this->printMessage($LNG['customm_21'], true, array('game.php?page=ticket', 2));
			}else{
				$comment = $this->getUsername($msg_info['message_sender'])." send: ".$msg_info['message_text']."<hr>".$comment;
				$ticketID	= $this->ticketObj->createTicket($USER['id'], 5, $Subject);
				$this->ticketObj->createAnswer($ticketID, $USER['id'], $USER['username'], $Subject, $comment, 0);
				$this->printMessage($LNG['customm_21'], true, array('game.php?page=ticket', 2));
			}
		}
	}
	
	
	public function show()
	{
		global $LNG, $resource, $USER, $PLANET, $pricelist;
		$MsgId = HTTP::_GP('id', 0);
		
		$db	= Database::get();
		$sql = "SELECT message_id, message_time, CONCAT(username, ' [',galaxy, ':', system, ':', planet,']') as message_from, message_text
			FROM %%MESSAGES%% INNER JOIN %%USERS%% ON id = message_sender
			WHERE message_id = :message_id;";
		$msg_info = $db->selectSingle($sql, array(
			':message_id'	=> $MsgId
		));
		
		$this->assign(array(
		'message_from'	=> $msg_info['message_from'],
		'message_text'	=> $msg_info['message_text'],
		'MsgId'	=> $MsgId,
		));
		
		$this->display('page.complaint.default.tpl');

	}
}
