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

function ShowOverviewPage()
{
	global $LNG, $USER;
	
	$Message	= array();
	$config = Config::get(Universe::getEmulated());
	if ($USER['authlevel'] >= AUTH_ADM)
	{
		if(file_exists(ROOT_PATH.'update.php'))
			$Message[]	= sprintf($LNG['ow_file_detected'], 'update.php');
			
		if(file_exists(ROOT_PATH.'webinstall.php'))
			$Message[]	= sprintf($LNG['ow_file_detected'], 'webinstall.php');
			
		if(file_exists('includes/ENABLE_INSTALL_TOOL'))
			$Message[]	= sprintf($LNG['ow_file_detected'], 'includes/ENABLE_INSTALL_TOOL');
					
		if(!is_writable(ROOT_PATH.'cache'))
			$Message[]	= sprintf($LNG['ow_dir_not_writable'], 'cache');
			
		if(!is_writable('includes'))
			$Message[]	= sprintf($LNG['ow_dir_not_writable'], 'includes');
	}
	
	$hour = 00;

	$today              = strtotime("today ".$hour.":00");
	$yesterday          = strtotime("yesterday ".$hour.":00");
	$dayBeforeYesterday = strtotime("yesterday -1 day ".$hour.":00");
	
	$ticketResult	= $GLOBALS['DATABASE']->query("SELECT t.*, u.username, COUNT(a.ticketID) as answer FROM ".TICKETS." t INNER JOIN ".TICKETS_ANSWER." a USING (ticketID) INNER JOIN ".USERS." u ON u.id = t.ownerID WHERE t.universe = ".Universe::getEmulated()." AND t.status < 2 GROUP BY a.ticketID ORDER BY t.ticketID DESC LIMIT 7;");
	$ticketResult2	= $GLOBALS['DATABASE']->query("SELECT t.*, u.username, COUNT(a.ticketID) as answer FROM ".TICKETS." t INNER JOIN ".TICKETS_ANSWER." a USING (ticketID) INNER JOIN ".USERS." u ON u.id = t.ownerID WHERE t.universe = ".Universe::getEmulated()." AND t.status = 2 GROUP BY a.ticketID ORDER BY t.ticketID DESC LIMIT 7;");
	$ticketResult3	= $GLOBALS['DATABASE']->query("SELECT t.*, u.username, COUNT(a.ticketID) as answer FROM ".TICKETS." t INNER JOIN ".TICKETS_ANSWER." a USING (ticketID) INNER JOIN ".USERS." u ON u.id = t.ownerID WHERE t.universe = ".Universe::getEmulated()." AND t.status = 99 GROUP BY a.ticketID ORDER BY t.ticketID DESC LIMIT 7;");
	$purchaseResult	= $GLOBALS['DATABASE']->query("SELECT * FROM ".PURCHASE." WHERE time >= '".$today."' ORDER BY TIME DESC LIMIT 5;");
	$loggedResult	= $GLOBALS['DATABASE']->query("SELECT * FROM `uni1_admin_logins` ORDER BY TIME DESC LIMIT 5;");
	$ticketList		= array();
	$ticketList2	= array();
	$ticketList3	= array();
	$purchaseList	= array();
	$loggedList	= array();

	$totalToday		= $GLOBALS['DATABASE']->getFirstRow("SELECT SUM(pinPrice) as total FROM ".PURCHASE." WHERE time >= '".$today."';");
	$totalPaypal	= $GLOBALS['DATABASE']->getFirstRow("SELECT SUM(pinPrice) as total FROM ".PURCHASE." WHERE pinType = 'paypal' AND time >= '".$today."';");
	$totalXsolla	= $GLOBALS['DATABASE']->getFirstRow("SELECT SUM(pinPrice) as total FROM ".PURCHASE." WHERE pinType = 'xsolla' AND time >= '".$today."';");
	$totalPaysafe	= $GLOBALS['DATABASE']->getFirstRow("SELECT SUM(pinPrice) as total FROM ".PURCHASE." WHERE pinType = 'paysafecard' AND time >= '".$today."';");
	
	$totalPaypalO	= $GLOBALS['DATABASE']->getFirstRow("SELECT SUM(pinPrice) as total FROM ".PURCHASE." WHERE pinType = 'paypal' AND time >= '".$yesterday."' AND time < '".$today."';");
	$totalXsollaO	= $GLOBALS['DATABASE']->getFirstRow("SELECT SUM(pinPrice) as total FROM ".PURCHASE." WHERE pinType = 'xsolla' AND time >= '".$yesterday."' AND time < '".$today."';");
	$totalPaysafeO	= $GLOBALS['DATABASE']->getFirstRow("SELECT SUM(pinPrice) as total FROM ".PURCHASE." WHERE pinType = 'paysafecard' AND time >= '".$yesterday."' AND time < '".$today."';");
	
	$totalPaypalOd	= $GLOBALS['DATABASE']->getFirstRow("SELECT SUM(pinPrice) as total FROM ".PURCHASE." WHERE pinType = 'paypal' AND time >= '".$dayBeforeYesterday."' AND time < '".$yesterday."';");
	$totalXsollaOd	= $GLOBALS['DATABASE']->getFirstRow("SELECT SUM(pinPrice) as total FROM ".PURCHASE." WHERE pinType = 'xsolla' AND time >= '".$dayBeforeYesterday."' AND time < '".$yesterday."';");
	$totalPaysafeOd	= $GLOBALS['DATABASE']->getFirstRow("SELECT SUM(pinPrice) as total FROM ".PURCHASE." WHERE pinType = 'paysafecard' AND time >= '".$dayBeforeYesterday."' AND time < '".$yesterday."';");
		
	while($ticketRow = $GLOBALS['DATABASE']->fetch_array($ticketResult)) {
		$LastMessage = $GLOBALS['DATABASE']->getFirstRow("SELECT message FROM ".TICKETS_ANSWER." WHERE ticketID = ".$ticketRow['ticketID']." ORDER BY time DESC LIMIT 1;");
		$ticketRow['time']	= round(((TIMESTAMP) - ($ticketRow['time']))/3600, 0);
		$ticketRow['LastMessage']	= substr($LastMessage['message'], 0, 80).'...';
		$ticketList[$ticketRow['ticketID']]	= $ticketRow;
	}
	
	while($ticketRow = $GLOBALS['DATABASE']->fetch_array($ticketResult2)) {
		$LastMessage = $GLOBALS['DATABASE']->getFirstRow("SELECT message FROM ".TICKETS_ANSWER." WHERE ticketID = ".$ticketRow['ticketID']." ORDER BY time DESC LIMIT 1;");
		$ticketRow['time']	= round(((TIMESTAMP) - ($ticketRow['time']))/3600, 0);
		$ticketRow['LastMessage']	= substr($LastMessage['message'], 0, 80).'...';
		$ticketList2[$ticketRow['ticketID']]	= $ticketRow;
	}
	
	while($ticketRow = $GLOBALS['DATABASE']->fetch_array($ticketResult3)) {
		$LastMessage = $GLOBALS['DATABASE']->getFirstRow("SELECT message FROM ".TICKETS_ANSWER." WHERE ticketID = ".$ticketRow['ticketID']." ORDER BY time DESC LIMIT 1;");
		$ticketRow['time']	= round(((TIMESTAMP) - ($ticketRow['time']))/3600, 0);
		$ticketRow['LastMessage']	= substr($LastMessage['message'], 0, 80).'...';
		$ticketList3[$ticketRow['ticketID']]	= $ticketRow;
	}
	
	while($purchaseRow = $GLOBALS['DATABASE']->fetch_array($purchaseResult)) {
		$payerName = $GLOBALS['DATABASE']->getFirstRow("SELECT username FROM ".USERS." WHERE id = ".$purchaseRow['userID'].";");
		
		$payerRealName = "";
		if($purchaseRow['realDonator'] != $purchaseRow['userID']){
			$payerRealInfo = $GLOBALS['DATABASE']->getFirstRow("SELECT username FROM ".USERS." WHERE id = ".$purchaseRow['realDonator'].";");
			$payerRealName = $payerRealInfo['username'];
		}
		
		$purchaseRow['time']		= str_replace(' ', '&nbsp;', _date('H:i:s', $purchaseRow['time']), $USER['timezone']);
		$purchaseRow['userID']		= $payerName['username'];
		$purchaseRow['realDonator']	= $payerRealName;
		$purchaseList[$purchaseRow['payID']]	= $purchaseRow;
	}
	
	while($loggedRow = $GLOBALS['DATABASE']->fetch_array($loggedResult)) {
		$loggedRow['time']	= str_replace(' ', '&nbsp;', _date('m/d/y H:i:s', $loggedRow['time']), $USER['timezone']);
		$loggedList[$loggedRow['adminLog']]	= $loggedRow;
	}
		
	$activeCounts = $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(ticketID) as total FROM ".TICKETS." WHERE status < 2;");
	$ClosedCounts = $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(ticketID) as total FROM ".TICKETS." WHERE status = 2;");
	$ResolvedCounts = $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(ticketID) as total FROM ".TICKETS." WHERE status = 99;");
	$TotalCounts = $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(ticketID) as total FROM ".TICKETS.";");
	$TotalPaysafe = $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(payID) as total FROM ".PURCHASE." WHERE pinType = 'paysafecard' AND paystatus = 'Pending';");
		
	$GLOBALS['DATABASE']->free_result($ticketResult);
	$GLOBALS['DATABASE']->free_result($ticketResult2);
	
	$QueryCSearch	 = "SELECT COUNT(id) AS total FROM ".USERS." ";
	$QueryCSearch	.= "WHERE onlinetime >= '".(TIMESTAMP - 15 * 60)."';";
	$CountQuery		= $GLOBALS['DATABASE']->getFirstRow($QueryCSearch);
	
	if(!empty($totalPaypalO['total'])){
		$pPaypal		= ($totalPaypal['total'] - $totalPaypalO['total']);
		$pPaypal		= ($pPaypal / $totalPaypalO['total']);
		$pPaypal		= ($pPaypal * 100);
	}else{
		$pPaypal		= 100;
	}
	if(!empty($totalXsollaO['total'])){
		$pXsolla		= ($totalXsolla['total'] - $totalXsollaO['total']);
		$pXsolla		= ($pXsolla / $totalXsollaO['total']);
		$pXsolla		= ($pXsolla * 100);
	}else{
		$pXsolla		= 100;
	}
	
	
	if(!empty($totalPaysafeO['total'])){
		$pPaysafe		= ($totalPaysafe['total'] - $totalPaysafeO['total']);
		$pPaysafe		= ($pPaysafe / $totalPaysafeO['total']);
		$pPaysafe		= ($pPaysafe * 100);
	}else{
		$pPaysafe		= 100;
	}
	
	if(!empty($totalPaypalOd['total'])){
		$pPaypalB		= ($totalPaypalO['total'] - $totalPaypalOd['total']);
		$pPaypalB		= ($pPaypalB / $totalPaypalOd['total']);
		$pPaypalB		= ($pPaypalB * 100);
	}else{
		$pPaypalB		= 100;
	}
	if(!empty($totalXsollaOd['total'])){
		$pXsollaB		= ($totalXsollaO['total'] - $totalXsollaOd['total']);
		$pXsollaB		= ($pXsollaB / $totalXsollaOd['total']);
		$pXsollaB		= ($pXsollaB * 100);
	}else{
		$pXsollaB		= 100;
	}
	if(!empty($totalPaysafeOd['total']) or ($totalPaysafeOd['total']) != 0){
		$pPaysafeB		= ($totalPaysafeO['total'] - $totalPaysafeOd['total']);
		$pPaysafeB		= ($pPaysafeB / 1);
		$pPaysafeB		= ($pPaysafeB * 100);
	}else{
		$pPaysafeB		= 100;
	}
	$template	= new template();
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/plugins/forms/selects/bootstrap_multiselect.js');
	$template->loadscript('assets/js/plugins/ui/moment/moment.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/dashboard.js');
	
	$NewValue = floor((TIMESTAMP - $config->openingDate)/24/3600) == 0 ? 1 : floor((TIMESTAMP - $config->openingDate)/24/3600);
	
	$showCommentAlert = 0;
	
	$QuerySearcher	= $GLOBALS['DATABASE']->getFirstRow("SELECT * FROM ".COMMENTSHOF." WHERE flagAmount >= 5 AND isApprouved = 0;");
	if(!empty($QuerySearcher)){
		$showCommentAlert = 1;
	}
	
	$totalRevenue	= $GLOBALS['DATABASE']->getFirstRow("SELECT SUM(pinPrice) as total FROM ".PURCHASE." WHERE payupdate > 1483225200;");
	$totalRevenue1	= $GLOBALS['DATABASE']->getFirstRow("SELECT SUM(pinCredits) as total FROM ".PURCHASE." WHERE payupdate > 1483225200;");
	
	$free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem);
    $mem = array_merge($mem);
    $memory_usage = $mem[2]/$mem[1]*100;
	
	$totalBlocked		= $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(*) as total FROM ".FLEETS_EVENT." WHERE `lock` IS NOT NULL;");
	$totalBlockedCron	= $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(*) as total FROM ".CRONJOBS." WHERE `lock` IS NOT NULL AND `cronjobID` NOT IN (16,17,18,20,24);");
	$totalEmailsProc	= $GLOBALS['DATABASE']->getFirstRow("SELECT COUNT(*) as total FROM ".EMAILS." WHERE `isSend` = 0;");
	
	$template->assign_vars(array(	
		'totalPaypal'		=> empty($totalPaypal['total']) ? 0 : $totalPaypal['total'],
		'totalXsolla'		=> empty($totalXsolla['total']) ? 0 : $totalXsolla['total'],
		'totalPaysafe'		=> empty($totalPaysafe['total']) ? 0 : $totalPaysafe['total'],
		'totalPaypalO'		=> empty($totalPaypalO['total']) ? 0 : $totalPaypalO['total'],
		'totalXsollaO'		=> empty($totalXsollaO['total']) ? 0 : $totalXsollaO['total'],
		'totalPaysafeO'		=> empty($totalPaysafeO['total']) ? 0 : $totalPaysafeO['total'],
		'totalPaypalP'		=> round($pPaypal,2),
		'totalXsollaP'		=> round($pXsolla,2),
		'totalPaysafeP'		=> round($pPaysafe,2),
		'TotalPaysafe'		=> $TotalPaysafe['total'],
		'totalRevenue'		=> pretty_number($totalRevenue['total']),
		'totalRevenue1'		=> pretty_number($totalRevenue1['total']),
		'totalEmailsProc'	=> pretty_number($totalEmailsProc['total']),
		'memory_usage'		=> round($memory_usage,2),
		'totalBlocked'		=> $totalBlocked['total'],
		'totalBlockedCron'	=> $totalBlockedCron['total'],
		'totalPaypalPo'		=> $pPaypalB,
		'totalXsollaPo'		=> $pXsollaB,
		'totalPaysafePo'	=> $pPaysafeB,
		'loggedList'		=> $loggedList,
		'showCommentAlert'	=> $showCommentAlert,
		'totalToday'		=> pretty_number($totalToday['total']),
		'ow_none'			=> $LNG['ow_none'],
		'ow_overview'		=> $LNG['ow_overview'],
		'ow_welcome_text'	=> $LNG['ow_welcome_text'],
		'ow_credits'		=> $LNG['ow_credits'],
		'ow_special_thanks'	=> $LNG['ow_special_thanks'],
		'ow_translator'		=> $LNG['ow_translator'],
		'ow_proyect_leader'	=> $LNG['ow_proyect_leader'],
		'ow_support'		=> $LNG['ow_support'],
		'ow_title'			=> $LNG['ow_title'],
		'ow_forum'			=> $LNG['ow_forum'],
		'ow_donate'			=> $LNG['ow_donate'],
		'Messages'			=> $Message,
		'date'				=> date('m\_Y', TIMESTAMP),
		'pageactiveshow'	=> HTTP::_GP('page', "", true),
		'purchaseList'	=> $purchaseList,
		'ticketList'	=> $ticketList,
		'ticketList2'	=> $ticketList2,
		'ticketList3'	=> $ticketList3,
		'activeCount'	=> $activeCounts['total'],
		'ClosedCounts'	=> $ClosedCounts['total'],
		'ResolvedCounts'=> $ResolvedCounts['total'],
		'TotalCounts'	=> pretty_number($TotalCounts['total']),
		'amountonline'	=> pretty_number($CountQuery['total']),
		'totalRevenuesall'	=> pretty_number($config->totalRevenue),
		'totalRevenuesavg'	=> pretty_number($config->totalRevenue / $NewValue),
		'todayDate'		=> date("Y/m/d"),
		'yesterdayDate'		=> date("Y/m/d", $yesterday),
	));
	
	$template->show('OverviewBody.tpl');
}
