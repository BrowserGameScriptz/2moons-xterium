<?php

if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))) throw new Exception("Permission error!");

function ShowMailPage()
{
	global $LNG, $USER;
	
	$template	= new template();	
	$template->loadscript('assets/js/plugins/tables/datatables/datatables.min.js');	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');	
	$template->loadscript('assets/js/core/app.js');		
	$template->loadscript('assets/js/pages/datatables_advanced.js');	
	$Minimize			= "&amp;minimize=on";
	$template->assign_vars(array(	
		'minimize'	=> 'checked = "checked"',
		'diisplaay'	=> 'style="display:none;"',
	));
	$OnlineList	= array();
	$QuerySearch	= $GLOBALS['DATABASE']->query("SELECT * FROM ".EMAILS." WHERE loggedSince != 0 ORDER BY language ASC;");
	while ($WhileResult	= $GLOBALS['DATABASE']->fetch_array($QuerySearch)){
		$OnlineList[$WhileResult['email']]	= array(
			'username'		=> $WhileResult['username'],
			'language'		=> $WhileResult['language'],
			'isSend'		=> $WhileResult['isSend'] == 0 ? "No" : "Yes",
			'loggedSince'	=> $WhileResult['loggedSince'] == 0 ? "No" : "Yes - "._date($LNG['php_tdformat'], $WhileResult['loggedSince'] , $USER['timezone']),
			//'register_time'	=> _date($LNG['php_tdformat'], $WhileResult['register_time'] , $USER['timezone']),
		);	
	}
	$template->assign_vars(array(	
		
		'OnlineList'			=> $OnlineList,
		'pageactiveshow'	=> HTTP::_GP('page', "", true),
	));
	$template->show('allmaillist.tpl');
}