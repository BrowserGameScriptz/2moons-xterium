<?php

if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))) throw new Exception("Permission error!");

function ShowCreatecampaignPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	$showMsg	= array();
	if (!empty($_POST))
	{
		$config_before = array(
			'CampaingStart'				=> $config->CampaingStart,
			'CampaingEnd' 				=> $config->CampaingEnd,
			'donation_bonus' 			=> $config->donation_bonus,
			'special_donation_status' 	=> $config->special_donation_status,
			'special_donation_amount' 	=> $config->special_donation_amount,
			'special_donation_percent' 	=> $config->special_donation_percent,
			'red_button' 				=> $config->red_button,
			'peacefullExp' 				=> $config->peacefullExp,
			'combatExp' 				=> $config->combatExp,
			'special_donation_premium' 	=> $config->special_donation_premium,
			'ap_don' 					=> $config->ap_don,
			'special_donation_stardust' => $config->special_donation_stardust,
			'darkmatter_reduc' 			=> $config->darkmatter_reduc,
			'collider_promo' 			=> $config->collider_promo,
			'primebuild' 				=> $config->primebuild,
			'auctionExpe' 				=> $config->auctionExpe,
			'OverviewNewsText' 			=> $config->OverviewNewsText,
		);
		
		$donation_bonus				= HTTP::_GP('donation_bonus', 0);
		$special_donation_status	= HTTP::_GP('special_donation_status', 0);
		$special_donation_valid		= array(0,1);
		$special_donation_premium	= HTTP::_GP('special_donation_premium', 0);
		$special_donation_amount 	= HTTP::_GP('special_donation_amount', 0);
		$red_button 				= HTTP::_GP('red_button', 0);
		$special_donation_percent	= HTTP::_GP('special_donation_percent', 0);
		$special_donation_academy	= HTTP::_GP('special_donation_academy', 0);
		$special_donation_stardust	= HTTP::_GP('special_donation_stardust', 0);
		$darkmatter_reduc	 		= HTTP::_GP('darkmatter_reduc', 0);
		$collider_promo		 		= HTTP::_GP('collider_promo', 0);
		$primebuild				 	= HTTP::_GP('primebuild', 0);
		$primebuild_valid			= array(0,1);
		$auctionExpe				= HTTP::_GP('auctionExpe', 0);
		$auctionExpe_valid			= array(0,1);
		$peacefullExp				= HTTP::_GP('peacefullExp', 0);
		$combatExp	 				= HTTP::_GP('combatExp', 0);
		$start_day	 				= HTTP::_GP('start-day', 0);
		$start_month 				= HTTP::_GP('start-month', 0);
		$start_year	 				= HTTP::_GP('start-year', 0);
		$end_day	 				= HTTP::_GP('end-day', 0);
		$end_month	 				= HTTP::_GP('end-month', 0);
		$end_year				 	= HTTP::_GP('end-year', 0);
		$NewsText	 				= HTTP::_GP('NewsText', "", UTF8_SUPPORT);
		$starDate					= strtotime($start_day.'-'.$start_day.'-'.$start_day);
		$endDate					= strtotime($end_day.'-'.$end_month.'-'.$end_year);
		
		$config_after = array(
			'CampaingStart' 			=> $starDate,
			'CampaingEnd' 				=> $endDate,
			'donation_bonus' 			=> $donation_bonus,
			'special_donation_status' 	=> $special_donation_status,
			'special_donation_amount' 	=> $special_donation_amount,
			'special_donation_percent' 	=> $special_donation_percent,
			'red_button' 				=> $red_button,
			'peacefullExp' 				=> $peacefullExp,
			'combatExp' 				=> $combatExp,
			'special_donation_premium' 	=> $special_donation_premium,
			'ap_don'				 	=> $special_donation_academy,
			'special_donation_stardust' => $special_donation_stardust,
			'darkmatter_reduc' 			=> $darkmatter_reduc,
			'collider_promo' 			=> $collider_promo,
			'primebuild' 				=> $primebuild,
			'auctionExpe' 				=> $auctionExpe,
			'OverviewNewsText' 			=> $NewsText,
		);
		
		if(!in_array($special_donation_status, $special_donation_valid)){
			$showMsg[]	= "There are only 2 options for the extra purchase bonus: Activated & Disabled";
		}elseif($special_donation_academy > 100){
			$showMsg[]	= "The maximum allowed value for the acadedmy points reduction is 100%";
		}elseif($special_donation_stardust > 100){
			$showMsg[]	= "The maximum allowed value for the stellar ore reduction is 100%";
		}elseif($darkmatter_reduc > 100){
			$showMsg[]	= "The maximum allowed value for the darkmatter cost reduction is 100%";
		}elseif($collider_promo > 100){
			$showMsg[]	= "The maximum allowed value for the collider price reduction is 100%";
		}elseif(!in_array($primebuild, $primebuild_valid)){
			$showMsg[]	= "There are only 2 options for the prime building option: Activated & Disabled";
		}elseif(!in_array($auctionExpe, $auctionExpe_valid)){
			$showMsg[]	= "There are only 2 options for the suprema event: Yes & No";
		}elseif($starDate > $endDate || $starDate == $endDate){
			$showMsg[]	= "The start date must be earlier than the end date for the campaign";
		}elseif(empty($showMsg)){
			foreach($config_after as $key => $value)
			{
				$config->$key	= $value;
			}
			$config->save();
		}
		
		if(empty($showMsg)){
			$LOG = new Log(4);
			$LOG->target = 0;
			$LOG->old = $config_before;
			$LOG->new = $config_after;
			$LOG->save();
			HTTP::redirectTo('admin.php');
		}else{
			$LOG = new Log(4);
			$LOG->target = 1;
			$LOG->old = $config_before;
			$LOG->new = $config_after;
			$LOG->save();
		}
	}
	$template	= new template();
	$template->assign_vars(array(	
		'pageactiveshow'				=> HTTP::_GP('page', "", true),
		'showMsg'						=> implode("<br>\r\n", $showMsg),
	));
	$template->loadscript('assets/js/core/libraries/jquery_ui/core.min.js');
	$template->loadscript('assets/js/plugins/forms/wizards/form_wizard/form.min.js');
	$template->loadscript('assets/js/plugins/forms/wizards/form_wizard/form_wizard.min.js');
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/core/libraries/jasny_bootstrap.min.js');
	$template->loadscript('assets/js/plugins/forms/validation/validate.min.js');
	$template->loadscript('assets/js/plugins/notifications/sweet_alert.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/wizard_form.js');
	$template->show('showCampaignSet.tpl');
}