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


function approuve()
{
	global $LNG;
	
	$MsgID			= HTTP::_GP('MsgID', 0);
	
	$QuerySearch	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".COMMENTSHOF." WHERE id = ".$MsgID.";");
	if(!empty($QuerySearch)){
		$SQL      = "UPDATE ".COMMENTSHOF." SET ";
		$SQL     .= "`isApprouved` = 1 ";
		$SQL     .= "WHERE `id` = ".$MsgID.";";
		$GLOBALS['DATABASE']->query($SQL);
	}
}

function ShowCommentsPage()
{
	global $LNG;
	
	$MsgID			= HTTP::_GP('MsgID', 0);
	
	$QuerySearch	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".COMMENTSHOF." WHERE id = ".$MsgID.";");
	if(!empty($QuerySearch) && !empty($MsgID)){
		$SQL      = "UPDATE ".COMMENTSHOF." SET ";
		$SQL     .= "`isApprouved` = 1 ";
		$SQL     .= "WHERE `id` = ".$MsgID.";";
		$GLOBALS['DATABASE']->query($SQL);
	}
	
	$messageRaw	= $GLOBALS['DATABASE']->query("SELECT * FROM ".COMMENTSHOF." ORDER BY date DESC, id DESC;");
	
	
	while($messageRow = $GLOBALS['DATABASE']->fetch_array($messageRaw))
	{
		$messageList[$messageRow['id']]	= array(
			'sender'	=> empty($messageRow['name']) ? $messageRow['name'] : $messageRow['name'].' (ID:&nbsp;'.$messageRow['Userid'].')',
			'text'		=> $messageRow['comment'],
			'type'		=> "Hof Comment",
			'rid'		=> $messageRow['rid'], 
			'flagged'	=> $messageRow['flagAmount'] >= 3 ? "<span style='color:red;'>Yes</span>" : "No", 
			'flaggeds'	=> $messageRow['flagAmount'] >= 3 ? 1 : 0, 
			'isApprouved'=> $messageRow['isApprouved'] == 1 ? " - <span style='color:red;'>Approuved</span>" : "", 
			'time'		=> str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $messageRow['date']), $USER['timezone']),
		);
	}	
	
	$template 	= new template();
	$template->loadscript('assets/js/plugins/tables/datatables/datatables.min.js');
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/datatables_api.js');
	$template->loadscript('assets/js/pages/components_modals.js');

	$template->assign_vars(array(
		'messageList'	=> $messageList,
	));
				
	$template->show('CommentList.tpl');
}