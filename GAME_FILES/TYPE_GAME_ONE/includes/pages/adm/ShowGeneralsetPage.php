<?php
if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))) throw new Exception("Permission error!");



function ShowGeneralsetPage()
{
	global $LNG, $USER;
	
	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$config_before = array(
			'admin_name'	=> $config->admin_name,
			'admin_email'	=> $config->admin_email,
			'site_logo'		=> $config->site_logo,
			'site_favicon'	=> $config->site_favicon,
		);
		
		$admin_name			= HTTP::_GP('admin_name', '', true);
		$admin_email		= HTTP::_GP('admin_email', '', true);
		$game_logo			= HTTP::_GP('game_logo', '', true);
		$game_fav			= HTTP::_GP('game_fav', '', true);
		
		$config_after = array(
			'admin_name'	=> $admin_name,
			'admin_email'	=> $admin_email,
			'site_logo'		=> $game_logo,
			'site_favicon'	=> $game_fav,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 15;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	
	$template	= new template();
	$template->assign_vars(array(	
		'admin_name'		=> $config->admin_name,
		'admin_email'		=> $config->admin_email,
		'site_logo'			=> $config->site_logo,
		'site_favicon'		=> $config->site_favicon,
		'myurl'				=> $_SERVER['HTTP_HOST'],
		'pageactiveshow'	=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->show('ShowGeneralSet.tpl');
}

function ShowAdsensePage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{		
		$AntiMatterCount	= HTTP::_GP('AntiMatterCount', 0);
		$getSpecificUser	= HTTP::_GP('getSpecificUser', 0);
		$moneyAmount		= HTTP::_GP('moneyAmount', 0);

		require 'includes/classes/BBCode.class.php';
		$class = '';
		$From    	= '<span class="'.$class.'">'.$LNG['user_level'][$USER['authlevel']].' '.$USER['username'].'</span>';
		$pmSubject 	= '<span class="'.$class.'">You have been credited with €'.$moneyAmount.' antimatter</span>';
		$Message	= "Dear player,<br><br>The team would thank you to play with us and to support the game. We just credited for this reason a €".$moneyAmount." antimatter voucher on your account.<br><br>Sincerely";
		$pmMessage 	= '<span class="'.$class.'">'.BBCode::parse($Message).'</span>';
		
		if($getSpecificUser == 0){
			$USERS		= $GLOBALS['DATABASE']->query("SELECT `id`, `username` FROM ".USERS." WHERE onlinetime >= ".(TIMESTAMP - 7 * 24 * 3600));
			foreach($USERS as $UserData)
			{
				//$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET antimatter = antimatter + ".$AntiMatterCount." WHERE id = ".$UserData['id']);
				PlayerUtil::sendMessage($UserData['id'], $USER['id'], $From, 50, $pmSubject, $pmMessage, TIMESTAMP, NULL, 1, Universe::getEmulated());
			}
		}else{
			$SQL		= "SELECT `id`, `username` FROM ".USERS." WHERE `id` = ".$getSpecificUser."";	
			$UserData = $GLOBALS['DATABASE']->getFirstRow($SQL);
			PlayerUtil::sendMessage($UserData['id'], $USER['id'], $From, 50, $pmSubject, $pmMessage, TIMESTAMP, NULL, 1, Universe::getEmulated());
		}
	}
	
	$template	= new template();
	$template->assign_vars(array(	
		'pageactiveshow'	=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->show('ShowAdsense.tpl');
}

function ShowMetaPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$config_before = array(
			'meta_title'	=> $config->meta_title,
			'meta_descrip'	=> $config->meta_descrip,
		);
		
		$meta_title			= HTTP::_GP('meta_title', '', true);
		$meta_descrip		= HTTP::_GP('meta_descrip', '', true);
		
		$config_after = array(
			'meta_title'	=> $meta_title,
			'meta_descrip'	 => $meta_descrip,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 14;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	$template	= new template();
	$template->assign_vars(array(	
		'meta_title'			=> $config->meta_title,
		'meta_descrip'			=> $config->meta_descrip,
		'pageactiveshow'	=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->show('ShowMetaSet.tpl');
}

function ShowPremiumsetPage()
{
	global $LNG, $USER;
	
	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$prem_res				= HTTP::_GP('prem_res', 0);
		$prem_storage			= HTTP::_GP('prem_storage', 0);
		$prem_s_build			= HTTP::_GP('prem_s_build', 0);
		$prem_o_build			= HTTP::_GP('prem_o_build', 0);
		$prem_button			= HTTP::_GP('prem_button', 0);
		$prem_speed_button		= HTTP::_GP('prem_speed_button', 0);
		$prem_expedition		= HTTP::_GP('prem_expedition', 0);
		$prem_count_expiditeon	= HTTP::_GP('prem_count_expiditeon', 0);
		$prem_speed_expiditeon	= HTTP::_GP('prem_speed_expiditeon', 0);
		$prem_moon_dextruct		= HTTP::_GP('prem_moon_dextruct', 0);
		$prem_leveling			= HTTP::_GP('prem_leveling', 0);
		$prem_batle_leveling	= HTTP::_GP('prem_batle_leveling', 0);
		$prem_bank_ally			= HTTP::_GP('prem_bank_ally', 0);
		$prem_prod_from_colly	= HTTP::_GP('prem_prod_from_colly', 0);
		$prem_moon_creat		= HTTP::_GP('prem_moon_creat', 0);
		$prem_conveyors_l		= HTTP::_GP('prem_conveyors_l', 0);
		$prem_conveyors_s		= HTTP::_GP('prem_conveyors_s', 0);
		$prem_conveyors_t		= HTTP::_GP('prem_conveyors_t', 0);
		$prem_fuel_consumption	= HTTP::_GP('prem_fuel_consumption', 0);
		$prem_prime_units		= HTTP::_GP('prem_prime_units', 0);
		
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_res', $prem_res);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_storage', $prem_storage);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_s_build', $prem_s_build);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_o_build', $prem_o_build);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_button', $prem_button);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_speed_button', $prem_speed_button);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_expedition', $prem_expedition);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_count_expiditeon', $prem_count_expiditeon);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_speed_expiditeon', $prem_speed_expiditeon);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_moon_dextruct', $prem_moon_dextruct);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_leveling', $prem_leveling);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_batle_leveling', $prem_batle_leveling);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_bank_ally', $prem_bank_ally);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_prod_from_colly', $prem_prod_from_colly);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_moon_creat', $prem_moon_creat);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_conveyors_l', $prem_conveyors_l);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_conveyors_s', $prem_conveyors_s);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_conveyors_t', $prem_conveyors_t);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_fuel_consumption', $prem_fuel_consumption);
		UpdatePremiumDatabase('PREMIUMCALC', 'name', 'prem_prime_units', $prem_prime_units);

	}
		
	$template	= new template();
	$template->assign_vars(array(	
		'pageactiveshow'		=> HTTP::_GP('page', "", true),
		'prem_res'				=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_res', array('promotion')),
		'prem_storage'			=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_storage', array('promotion')),
		'prem_s_build'			=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_s_build', array('promotion')),
		'prem_o_build'			=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_o_build', array('promotion')),
		'prem_button'			=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_button', array('promotion')),
		'prem_speed_button'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_speed_button', array('promotion')),
		'prem_expedition'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_expedition', array('promotion')),
		'prem_count_expiditeon'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_count_expiditeon', array('promotion')),
		'prem_speed_expiditeon'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_speed_expiditeon', array('promotion')),
		'prem_moon_dextruct'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_moon_dextruct', array('promotion')),
		'prem_leveling'			=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_leveling', array('promotion')),
		'prem_batle_leveling'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_batle_leveling', array('promotion')),
		'prem_bank_ally'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_bank_ally', array('promotion')),
		'prem_prod_from_colly'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_prod_from_colly', array('promotion')),
		'prem_moon_creat'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_moon_creat', array('promotion')),
		'prem_conveyors_l'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_conveyors_l', array('promotion')),
		'prem_conveyors_s'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_conveyors_s', array('promotion')),
		'prem_conveyors_t'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_conveyors_t', array('promotion')),
		'prem_fuel_consumption'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_fuel_consumption', array('promotion')),
		'prem_prime_units'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_prime_units', array('promotion')),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->show('ShowPremiumSet.tpl');
}

