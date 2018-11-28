<?php

if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))) throw new Exception("Permission error!");

function ShowAddamPage()
{
	global $LNG, $USER;
	
  
  $payid         = HTTP::_GP('payid', 0);
  $action        = HTTP::_GP('action', '', true);
  $config        = Config::get(Universe::getEmulated());
  if (!empty($payid) && $action == "process")
	{
    $SearchInBase	= $GLOBALS['DATABASE']->GetFirstRow("SELECT * FROM ".PURCHASE." WHERE payID = ".$payid." AND paystatus = 'Pending';");
    if(!empty($SearchInBase)){
      $pointe_bonus	   = 0;
      $addam           = round($SearchInBase['pinPrice']/0.0001010,-4);
      
      $bonus_of_amount = 0;
	    if($config->special_donation_status == 1 && $addam >= $config->special_donation_amount)
		    $bonus_of_amount = $addam * ($config->special_donation_percent / 100);
      
      $addam           *= min(2.5, 1 + $addam / 500000);
      $bonus_amount1 = $addam * (($config->donation_bonus + $config->x_donation_inter) / 100);
      $count1 = round($bonus_of_amount + $pointe_bonus + $addam + $bonus_amount1);
      
      
      $loyality_points = floor($SearchInBase['pinPrice'] / 8)	;
      $SQL		= "UPDATE ".USERS." SET eur_spend = eur_spend + ".$SearchInBase['pinPrice'].", loyality_points = loyality_points + ".$loyality_points.", antimatter_bought = antimatter_bought + ".$count1."  WHERE id = ".$SearchInBase['userID'].";";
      $GLOBALS['DATABASE']->query($SQL);
      $SQL		= "UPDATE ".PURCHASE." SET paystatus = 'Completed', pinCredits = ".$count1.", pinAprouved = 1, payupdate = ".TIMESTAMP." WHERE payID = ".$SearchInBase['payID'].";";
      $GLOBALS['DATABASE']->query($SQL);
      $Message = 'paysafeCard payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($count1).'</span> anti matter have been credited to your account.';
      PlayerUtil::sendMessage($SearchInBase['userID'], $USER['id'], 'Billing', 4, 'Anti Matter Order', $Message, TIMESTAMP, NULL, 1, Universe::getEmulated());
    }
  }
  
  
	$template	= new template();	
	$template->loadscript('assets/js/plugins/tables/datatables/datatables.min.js');	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');	
	$template->loadscript('assets/js/core/app.js');		
	$template->loadscript('assets/js/pages/invoice_archive.js');	
	$Minimize			= "&amp;minimize=on";
	
	
	$PurchaseList	= array();
	$QuerySearch	= $GLOBALS['DATABASE']->query("SELECT * FROM ".PURCHASE." WHERE pinType = 'paysafecard' AND paystatus = 'Pending' ORDER BY time ASC;");
  
	while ($WhileResult	= $GLOBALS['DATABASE']->fetch_array($QuerySearch)){
		$userName	= $GLOBALS['DATABASE']->GetFirstRow("SELECT username, email FROM ".USERS." WHERE id = ".$WhileResult['userID'].";");
		$PurchaseList[$WhileResult['payID']]	= array(
			'username'		=> $userName['username'],
			'email'		=> $userName['email'],
			'pinType'		=> ucfirst($WhileResult['pinType']),
			'payimage'		=> ucfirst($WhileResult['payimage']),
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
	$template->show('addam.tpl');
}