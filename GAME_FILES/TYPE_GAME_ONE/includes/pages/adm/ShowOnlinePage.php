<?php
if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))) throw new Exception("Permission error!");
function ShowOnlinePage()
{
	global $LNG, $USER;
	if ($_GET['delete'] == 'user') {
        PlayerUtil::deletePlayer((int) $_GET['user']);
        message($LNG['se_delete_succes_p'], '?page=usersonline', 2);
	} 
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
	$ArrayUsers		= array("users", "vacation", "admin", "inactives", "online");
	$Table			= "users";
	$NameLang		= $LNG['se_search_users'];
	$SpecifyItems	= "id,username,email_2,onlinetime,register_time,user_lastip,authlevel,bana,urlaubs_modus";
	$SName			= $LNG['se_input_userss'];
	$ArrayOSec		= array("id", "username", "email_2", "onlinetime", "register_time", "user_lastip", "authlevel", "bana", "urlaubs_modus");
	$Array0SecCount	= count($ArrayOSec);
	for ($OrderNum = 0; $OrderNum < $Array0SecCount; $OrderNum++)
		$OrderBYParse[$ArrayOSec[$OrderNum]]	= $LNG['se_search_users'][$OrderNum];
	$ArrayEx	= explode(",", str_replace("CONCAT(u.username, ' (ID:&nbsp;', p.id_owner, ')')", '', $SpecifyItems));
	if (!$Order || !in_array($Order, $ArrayOSec))
		$Order	= $ArrayEx[0];
	$CountArray	= count($ArrayEx);
	$OnlineList	= array();
	$QuerySearch	= $GLOBALS['DATABASE']->query("SELECT id,username,email_2,onlinetime,register_time,user_lastip,authlevel,bana,urlaubs_modus FROM ".USERS." 
		WHERE onlinetime >= '".(TIMESTAMP - 15 * 60)."' AND universe = ".Universe::getEmulated()." ORDER BY ".$Order." ".$OrderBY.";");
	while ($WhileResult	= $GLOBALS['DATABASE']->fetch_array($QuerySearch)){
		$lastVisit	= $GLOBALS['DATABASE']->GetFirstRow("SELECT pageVisited FROM ".TRACKING." 
		WHERE trackMode = 1 AND userId = ".$WhileResult['id']." ORDER BY time DESC LIMIT 1;");
		$OnlineList[$WhileResult['id']]	= array(
			'username'		=> $WhileResult['username'],
			'email_2'		=> $WhileResult['email_2'],
			'onlinetime'	=> pretty_time(TIMESTAMP - $WhileResult['onlinetime']),
			'register_time'	=> _date($LNG['php_tdformat'], $WhileResult['register_time'] , $USER['timezone']),
			'user_lastip'	=> $WhileResult['user_lastip'],
			'authlevel'		=> $LNG['rank'][$WhileResult['authlevel']],
			'bana'			=> $WhileResult['bana'],
			'urlaubs_modus'	=> $WhileResult['urlaubs_modus'],
			'lastVisit'		=> $lastVisit['pageVisited'],
		);	
	}
	$template->assign_vars(array(	
		'se_search'				=> $LNG['se_search'],
		'se_limit'				=> $LNG['se_limit'],
		'se_asc_desc'			=> $LNG['se_asc_desc'],
		'se_filter_title'		=> $LNG['se_filter_title'],
		'se_search_in'			=> $LNG['se_search_in'],
		'se_type_typee'			=> $LNG['se_type_typee'],
		'se_intro'				=> $LNG['se_intro'],
		'se_search_title'		=> $LNG['se_search_title'],
		'se_contrac'			=> $LNG['se_contrac'],
		'se_search_order'		=> $LNG['se_search_order'],
		'ac_minimize_maximize'	=> $LNG['ac_minimize_maximize'],
		'OnlineList'			=> $OnlineList,
		'pageactiveshow'	=> HTTP::_GP('page', "", true),
	));
	$template->show('ShowOnline.tpl');
}
