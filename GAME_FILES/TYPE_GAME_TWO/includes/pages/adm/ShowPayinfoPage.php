<?php

if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))) throw new Exception("Permission error!");

function ShowPayarchivePage()
{
	global $LNG, $USER;
	
	$template	= new template();	
	$template->loadscript('assets/js/plugins/tables/datatables/datatables.min.js');	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');	
	$template->loadscript('assets/js/core/app.js');		
	$template->loadscript('assets/js/pages/invoice_archive.js');	
	$Minimize			= "&amp;minimize=on";
	$config = Config::get(Universe::getEmulated());
	
	$PurchaseList	= array();
	$QuerySearch	= $GLOBALS['DATABASE']->query("SELECT * FROM ".PURCHASE." ORDER BY time ASC;");
	while ($WhileResult	= $GLOBALS['DATABASE']->fetch_array($QuerySearch)){
		$userName	= $GLOBALS['DATABASE']->GetFirstRow("SELECT username, email FROM ".USERS." WHERE id = ".$WhileResult['userID'].";");
		$PurchaseList[$WhileResult['payID']]	= array(
			'username'		=> $userName['username'],
			'email'		=> $userName['email'],
			'pinType'		=> ucfirst($WhileResult['pinType']),
			'paystatus'		=> strtolower($WhileResult['paystatus']),
			'time'			=> _date('M, d Y', $WhileResult['time'] , $USER['timezone']),
			'period'			=> _date('F Y', $WhileResult['time'] , $USER['timezone']),
			'invoiceda'			=> _date('F, d Y', $WhileResult['time'] , $USER['timezone']),
			'payupdate'	=> _date('M, d Y', $WhileResult['payupdate'] , $USER['timezone']),
			'pinPrice'		=> pretty_number($WhileResult['pinPrice']),
			'pinCredits'		=> pretty_number($WhileResult['pinCredits']),
			'game_name'		=> $config->game_name,
		);	
	} 
	
	$template->assign_vars(array(	
		'PurchaseList'		=> $PurchaseList,
		'pageactiveshow'	=> HTTP::_GP('page', "", true),
	));
	$template->show('payarchive.tpl');
}