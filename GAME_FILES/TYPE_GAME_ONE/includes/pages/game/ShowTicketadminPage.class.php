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

class ShowTicketadminPage extends AbstractGamePage
{

	private $ticketObj;
	
	function __construct() 
	{
		parent::__construct();
		require('includes/classes/class.SupportTickets.php');
		$this->ticketObj	= new SupportTickets;
	}
	
	public function show()
	{
		global $USER, $LNG;

		if($USER['chat_oper'] == 0 && $USER['gm'] == 0 && $USER['authlevel'] == 0){
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=overview', 3));
		}
			
		
		$db = Database::get();
		$pageInfo	= HTTP::_GP('page', 'ticket', UTF8_SUPPORT);

		$isGm = array(496);
		if(in_array($USER['id'], $isGm)){
			$sql = "SELECT t.*, u.username, COUNT(a.ticketID) as answer
			FROM %%TICKETS%% t
			INNER JOIN %%TICKETS_ANSWER%% a USING (ticketID)
			INNER JOIN %%USERS%% u ON u.id = t.ownerID
			WHERE t.adminanswered = 0 AND t.status != 2 AND t.categoryID = 1 GROUP BY a.ticketID ORDER BY t.ticketID DESC;";
		}else{
			$sql = "SELECT t.*, u.username, COUNT(a.ticketID) as answer
			FROM %%TICKETS%% t
			INNER JOIN %%TICKETS_ANSWER%% a USING (ticketID)
			INNER JOIN %%USERS%% u ON u.id = t.ownerID
			WHERE t.adminanswered = 0 AND t.status != 2 GROUP BY a.ticketID ORDER BY t.ticketID DESC;";
		}
		$ticketResult = $db->select($sql, array(
		));

		$ticketList		= array();
		
		foreach($ticketResult as $ticketRow) {
			$ticketRow['time']	= _date($LNG['php_tdformat'], $ticketRow['time'], $USER['timezone']);

			$ticketList[$ticketRow['ticketID']]	= $ticketRow;
		}
		
		$supportList = array();
		$ticketListPlayer = array();
		
		$sql = "SELECT id, username FROM %%USERS%% WHERE authlevel != 0 OR chat_oper != 0 OR gm != 0;";
		$playerSupport = $db->select($sql, array(
		));
		
		foreach($playerSupport as $Player) {
			
			$db = Database::get();	
			$isGm = array(496);
			if(in_array($USER['id'], $isGm)){
				$sql = "SELECT t.*, u.username FROM %%TICKETS%% t INNER JOIN %%TICKETS_ANSWER%% a USING (ticketID) INNER JOIN %%USERS%% u ON u.id = t.ownerID WHERE t.adminanswered = :adminanswered AND t.status != 2 AND t.categoryID = 1 ORDER BY t.ticketID DESC;";
			}else{
				$sql = "SELECT t.*, u.username FROM %%TICKETS%% t INNER JOIN %%TICKETS_ANSWER%% a USING (ticketID) INNER JOIN %%USERS%% u ON u.id = t.ownerID WHERE t.adminanswered = :adminanswered AND t.status != 2 ORDER BY t.ticketID DESC;";
			}
			$supportList[$Player['id']]	= $Player;
			
			$ticketResultPlayer = $db->select($sql, array(
			':adminanswered'	=> $Player['id']
			));
			
				
			foreach($ticketResultPlayer as $ticketRowPlayer) {
				
				$ticketRowPlayer['time']	= _date($LNG['php_tdformat'], $ticketRowPlayer['time'], $USER['timezone']);

				$ticketListPlayer[$ticketRowPlayer['ticketID']]	= $ticketRowPlayer;				
			}
			
		}
				
		$this->tplObj->loadscript('ticket.js');
		$this->assign(array(
			'supportList'	=> $supportList,
			'ticketList'	=> $ticketList,
			'ticketListPlayer'	=> $ticketListPlayer,
			'pageInfo'	=>	$pageInfo,
		));
			
		$this->display('page.ticketadmin.default.tpl');
	}
	
	function send() 
	{
		global $USER, $LNG;
				
		$ticketID	= HTTP::_GP('id', 0);
		$message	= HTTP::_GP('message', '', true);
		$change		= HTTP::_GP('action', 0);
		
		if($USER['chat_oper'] == 0 && $USER['gm'] == 0 && $USER['authlevel'] == 0){
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=overview', 3));
		}
		
		$sql = "SELECT ownerID, subject, status FROM %%TICKETS%% WHERE ticketID = :ticketID;";
		$ticketDetail = database::get()->selectSingle($sql, array(
			':ticketID'	=> $ticketID
		));
		$sql = "SELECT lang FROM %%USERS%% WHERE id = :userID;";
		$ticketUser = database::get()->selectSingle($sql, array(
			':userID'	=> $ticketDetail['ownerID']
		));
		
		$status = $change;
		
		$Friend_LNG = new Language($ticketUser['lang']);
		$Friend_LNG->includeData(array('CUSTOM', 'ADMIN'));
		
		if($change == 0 && empty($message))
		{
			HTTP::redirectTo('game.php?page=ticketadmin&mode=view&id='.$ticketID);
		}elseif($change == 1 && empty($message))
		{
			$message = $Friend_LNG['fl_ticket_auto_1'];
		}elseif($change == 2 && empty($message))
		{
			$message = $Friend_LNG['fl_ticket_auto_2'];
		}elseif($change == 3 && empty($message))
		{
			$sql = "UPDATE %%FLEETS_EVENT%% SET `lock` = NULL WHERE `lock` IS NOT NULL;";
			database::get()->update($sql, array(
			));
			$message = "This is an automated message<br>All the fleets of the universe have been unlocked and should arrive back home as fast as possible<br>Sincerely,";
		}elseif($change == 4 && empty($message))
		{
			$sql = "UPDATE %%USERS%% SET isChat = 0, chat_silence = 0 WHERE id = :userId;";
			database::get()->update($sql, array(
				':userId'	=> $ticketDetail['ownerID']
			));
			$message = "This is an automated message<br>You have been unbanned from the chat system. This could happen due to a mistake of the antispamscript or you having send forbidden words<br>Sincerely,";
		}elseif($change == 5 && empty($message))
		{
			$r901	= HTTP::_GP('r901', 0);
			$r902	= HTTP::_GP('r902', 0);
			$r903	= HTTP::_GP('r903', 0);
			
			$sql = "INSERT INTO %%EASYRES%% SET userId = :userId, metal = :metal, crystal = :crystal, deuterium = :deuterium, ticketId = :ticketId, addedBy = :addedBy;";
			database::get()->insert($sql, array(
				':userId'			=> $ticketDetail['ownerID'],
				':metal'			=> $r901,
				':crystal'			=> $r902,
				':deuterium'		=> $r903,
				':ticketId'			=> $ticketID,
				':addedBy'			=> $USER['id'],
			));
			
			$message = "This is an automated message<br>The resource have been added again on your account. You can claim them at any moment on the overview page.<br>Sincerely,";
		}

		$subject		= "RE: ".$ticketDetail['subject'];

		
		if(!empty($message))
		{
			$userNameTicket = $USER['username'];
			$isGm = array(496);
			if(in_array($USER['id'], $isGm))
				$userNameTicket = "Game Moderator";
			
			$this->ticketObj->createAnswer($ticketID, $USER['id'], $userNameTicket, $subject, $message, $status, $USER['id'], 1);
		}

		$subject	= sprintf($Friend_LNG['backNotification_8'], $ticketDetail['subject']);
		$text		= sprintf($Friend_LNG['backNotification_9'], "<a href='game.php?page=ticket&mode=view&id=".$ticketID."'>".$ticketDetail['subject']."</a>");

		PlayerUtil::sendMessage($ticketDetail['ownerID'], $USER['id'], $userNameTicket, 4,
			$subject, $text, TIMESTAMP, NULL, 1, 1);
			
		$this->redirectTo('game.php?page=ticketadmin&mode=view&id='.$ticketID);
	}
	
	function view() 
	{
		global $USER, $LNG;
		
		require 'includes/classes/BBCode.class.php';

		if($USER['chat_oper'] == 0 && $USER['gm'] == 0 && $USER['authlevel'] == 0){
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=overview', 3));
		}
		
		$db = Database::get();

		$ticketID			= HTTP::_GP('id', 0);
		
		$sql = "SELECT a.*, t.categoryID, t.status, t.rated, t.adminanswered FROM %%TICKETS_ANSWER%% a INNER JOIN %%TICKETS%% t USING(ticketID) WHERE a.ticketID = :ticketID ORDER BY a.answerID;";
		$answerResult = $db->select($sql, array(
			':ticketID'	=> $ticketID
		));

		$answerList			= array();

		if(empty($answerResult)) {
			$this->printMessage(sprintf($LNG['ti_not_exist'], $ticketID), true, array('game.php?page=ticketadmin', 2));
		}
		
		$ticket_status = 0;
		$allowedToView = 0;
		
		
		$right = 0;			
		foreach($answerResult as $answerRow) {
			$answerRow['time']		= _date($LNG['php_tdformat'], $answerRow['time'], $USER['timezone']);
			$answerRow['message']	= BBCode::parse($answerRow['message']);
			$answerRow['ownerID']	= $answerRow['ownerID'];
			$answerList[$answerRow['answerID']]	= $answerRow;
			if (empty($ticket_status))
			{
				$ticket_status = $answerRow['status'];
			}
			
			if (empty($allowedToView))
			{
				$allowedToView = $answerRow['adminanswered'];
			}
			
			$isGm = array(1,496);
			if(in_array($answerRow['ownerID'], $isGm)){
				$right = 1;	
			}
			
			
		}
		
		//if($allowedToView != $USER['id'] && $allowedToView == 10283) {
			//$this->printMessage(sprintf($LNG['ti_not_exist'], $ticketID), true, array('game.php?page=ticketadmin', 2));
		//}

		$categoryList	= $this->ticketObj->getCategoryList();
		$this->tplObj->loadscript('ticket.js');
		$this->assign(array(
			'ticketID'		=> $ticketID,
			'categoryList'	=> $categoryList,
			'answerList'	=> $answerList,
			'status'		=> $ticket_status,
			'strated'		=> $answerRow['rated'],
		));
			
		$this->display('page.ticketadmin.view.tpl');		
	}
}