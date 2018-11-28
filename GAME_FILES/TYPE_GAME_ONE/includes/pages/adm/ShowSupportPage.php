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
		
class ShowSupportPage
{
	private $ticketObj;
	
	function __construct() 
	{
		require('includes/classes/class.SupportTickets.php');
		$this->ticketObj	= new SupportTickets;
		$this->tplObj		= new template();
		// 2Moons 1.7TO1.6 PageClass Wrapper
		$ACTION = HTTP::_GP('mode', 'show');
		if(is_callable(array($this, $ACTION))) {
			$this->{$ACTION}();
		} else {
			$this->show();
        }
	}
	
	public function show()
	{
		global $USER, $LNG;
				
		$ticketResult	= $GLOBALS['DATABASE']->query("SELECT t.*, u.username, COUNT(a.ticketID) as answer FROM ".TICKETS." t INNER JOIN ".TICKETS_ANSWER." a USING (ticketID) INNER JOIN ".USERS." u ON u.id = t.ownerID WHERE t.universe = ".Universe::getEmulated()." GROUP BY a.ticketID ORDER BY t.ticketID DESC;");
		$ticketList		= array();
		
		while($ticketRow = $GLOBALS['DATABASE']->fetch_array($ticketResult)) {
			$LastMessage = $GLOBALS['DATABASE']->getFirstRow("SELECT message FROM ".TICKETS_ANSWER." WHERE ticketID = ".$ticketRow['ticketID']." ORDER BY time DESC LIMIT 1;");
			$ticketRow['time']	= date('d/m/Y', $ticketRow['time']);
			$ticketRow['LastMessage']	= substr($LastMessage['message'], 0, 175).'...';

			$ticketList[$ticketRow['ticketID']]	= $ticketRow;
		}
		
		$activeCounts = $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(ticketID) as total FROM ".TICKETS." WHERE status < 2;");
		$ClosedCounts = $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(ticketID) as total FROM ".TICKETS." WHERE status = 2;");
		$ResolvedCounts = $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(ticketID) as total FROM ".TICKETS." WHERE status = 99;");
		$TotalCounts = $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(ticketID) as total FROM ".TICKETS.";");
		
		
		$GLOBALS['DATABASE']->free_result($ticketResult);
		
		$this->tplObj->assign_vars(array(	
			'ticketList'	=> $ticketList,
			'activeCount'	=> $activeCounts['total'],
			'ClosedCounts'	=> $ClosedCounts['total'],
			'ResolvedCounts'=> $ResolvedCounts['total'],
			'TotalCounts'	=> pretty_number($TotalCounts['total']),
			'pageactiveshow'	=> HTTP::_GP('page', "", true),
		));
		$this->tplObj->loadscript('assets/js/core/libraries/jquery_ui/datepicker.min.js');	
		$this->tplObj->loadscript('assets/js/plugins/tables/datatables/datatables.min.js');	
		$this->tplObj->loadscript('assets/js/plugins/tables/datatables/extensions/natural_sort.js');	
		$this->tplObj->loadscript('assets/js/plugins/forms/selects/select2.min.js');	
		$this->tplObj->loadscript('assets/js/core/app.js');	
		$this->tplObj->loadscript('assets/js/pages/tasks_list.js');	

		$this->tplObj->show('page.ticket.default.tpl');
	}
	
	function changestatus() 
	{
		global $USER, $LNG;
				
		$ticketID	= HTTP::_GP('ticketid', 0);
		$action		= HTTP::_GP('action', '');
		$ticketDetail	= $GLOBALS['DATABASE']->getFirstRow("SELECT ownerID, subject, status FROM ".TICKETS." WHERE ticketID = ".$ticketID.";");
		$ticketUser	= $GLOBALS['DATABASE']->getFirstRow("SELECT lang FROM ".USERS." WHERE id = ".$ticketDetail['ownerID'].";");
		$Friend_LNG = new Language($ticketUser['lang']);
		$Friend_LNG->includeData(array('ADMIN', 'CUSTOM'));
		$subject		= "RE: ".$ticketDetail['subject'];
		if($action == "close"){
			$message = $Friend_LNG['fl_ticket_auto_2'];
			$GLOBALS['DATABASE']->multi_query("INSERT INTO ".TICKETS_ANSWER." SET ticketID = ".$ticketID.", ownerID = ".$USER['id'].", ownerName = '".$USER['username']."', subject = '".$GLOBALS['DATABASE']->sql_escape($subject)."', message = '".$GLOBALS['DATABASE']->sql_escape($message)."', time = ".TIMESTAMP.";UPDATE ".TICKETS." SET status = 2 WHERE ticketID = ".$ticketID.";");
			HTTP::redirectTo('admin.php?page=support&mode=view&id='.$ticketID);
		}elseif($action == "open"){
			$GLOBALS['DATABASE']->query("UPDATE ".TICKETS." SET status = 1 WHERE ticketID = ".$ticketID.";");
			HTTP::redirectTo('admin.php?page=support&mode=view&id='.$ticketID);
		}else{
			HTTP::redirectTo('admin.php?page=support&mode=view&id='.$ticketID);
		}
	}
	
	function send() 
	{
		global $USER, $LNG;
				
		$ticketID	= HTTP::_GP('id', 0);
		$message	= HTTP::_GP('enter-message', '', true);
		$change		= HTTP::_GP('change_status', 0);
		
		$ticketDetail	= $GLOBALS['DATABASE']->getFirstRow("SELECT ownerID, subject, status FROM ".TICKETS." WHERE ticketID = ".$ticketID.";");
		$ticketUser	= $GLOBALS['DATABASE']->getFirstRow("SELECT lang FROM ".USERS." WHERE id = ".$ticketDetail['ownerID'].";");
		$status = ($change ? ($ticketDetail['status'] <= 1 ? 2 : 1) : 1);
		
		
		if(!$change && empty($message))
		{
			HTTP::redirectTo('admin.php?page=support&mode=view&id='.$ticketID);
		}

		$subject		= "RE: ".$ticketDetail['subject'];

/* 		if($change && $status == 1) {
			$this->ticketObj->createAnswer($ticketID, $USER['id'], $USER['username'], $subject, $LNG['ti_admin_open'], $status);
		} */
		
		if(!empty($message))
		{
			$this->ticketObj->createAnswer($ticketID, $USER['id'], $USER['username'], $subject, $message, $status);
		}
		
		/* if($change && $status == 2) {
			$this->ticketObj->createAnswer($ticketID, $USER['id'], $USER['username'], $subject, $LNG['ti_admin_close'], $status);
		} */

		$Friend_LNG = new Language($ticketUser['lang']);
		$Friend_LNG->includeData(array('ADMIN'));
		$subject	= sprintf($Friend_LNG['sp_answer_message_title'], $ticketID);
		$text		= sprintf($Friend_LNG['sp_answer_message'], $ticketID);

		PlayerUtil::sendMessage($ticketDetail['ownerID'], $USER['id'], $USER['username'], 4,
			$subject, $text, TIMESTAMP, NULL, 1, Universe::getEmulated());

		HTTP::redirectTo('admin.php?page=support&mode=view&id='.$ticketID);
	}
	
	function view() 
	{
		global $USER, $LNG;
				
		$ticketID			= HTTP::_GP('id', 0);
		$answerResult		= $GLOBALS['DATABASE']->query("SELECT a.*, t.categoryID, t.status, t.subject as subj, t.ownerID as owner FROM ".TICKETS_ANSWER." a INNER JOIN ".TICKETS." t USING(ticketID) WHERE a.ticketID = ".$ticketID." ORDER BY a.answerID;");
		$answerList			= array();

		$ticket_status		= 0;
		$ticket_subject		= 0;
		$ticket_owner		= 0;
		$ticket_awner		= 0;

		require 'includes/classes/BBCode.class.php';

		while($answerRow = $GLOBALS['DATABASE']->fetch_array($answerResult)) {
			if (empty($ticket_status))
				$ticket_status = $answerRow['status'];

			$isAdmin	= $GLOBALS['DATABASE']->getFirstRow("SELECT authlevel FROM ".USERS." WHERE id = ".$answerRow['ownerID'].";");
			$answerRow['time']	= pretty_time(TIMESTAMP - $answerRow['time']);
			$answerRow['isAdmin'] = $isAdmin['authlevel'];
			$answerRow['message']	= BBCode::parse($answerRow['message']);
			$answerRow['ticket_awner']	= $answerRow['ownerID'];
			$answerList[$answerRow['answerID']]	= $answerRow;
			$ticket_subject			= BBCode::parse($answerRow['subj']);
			$ticket_owner			= $answerRow['owner'];
		}
		
		$GLOBALS['DATABASE']->free_result($answerResult);
			
		$categoryList	= $this->ticketObj->getCategoryList();
		$activeCounts = $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(ticketID) as total FROM ".TICKETS." WHERE status < 2;");
		$TotalCounts = $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(ticketID) as total FROM ".TICKETS.";");
		
		$this->tplObj->assign_vars(array(
			'activeCounts'		=> $activeCounts['total'],
			'TotalCounts'		=> $TotalCounts['total'],
			'ticketID'		=> $ticketID,
			'ticket_subject'=> $ticket_subject,
			'ticket_owner'	=> $ticket_owner,
			'ticket_status' => $ticket_status,
			'categoryList'	=> $categoryList,
			'answerList'	=> $answerList,
			'adminID'		=> $USER['id'],
		));
		
		$this->tplObj->loadscript('assets/js/core/app.js');	
		$this->tplObj->loadscript('assets/js/pages/support_chat_layouts.js');	
		$this->tplObj->show('page.ticket.view.tpl');		
	}
}	