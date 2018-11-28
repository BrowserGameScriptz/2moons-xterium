<?php

if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))) throw new Exception("Permission error!");

function ShowVarioussetPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$config_before = array(
			'min_build_time'		=> $config->min_build_time,
			'moon_chance'			=> $config->moon_chance,
			'factor_university'		=> $config->factor_university,
			'max_fleets_per_acs'	=> $config->max_fleets_per_acs,
			'xteriumPoints'			=> $config->xteriumPoints,
			'xteriumAllyId'			=> $config->xteriumAllyId,
		);
		$min_build_time			= HTTP::_GP('min_build_time', 0);
		$moon_chance			= HTTP::_GP('moon_chance', 0);
		$factor_university		= HTTP::_GP('factor_university', 0);
		$max_fleets_per_acs		= HTTP::_GP('max_fleets_per_acs', 0);
		$xteriumPoints			= HTTP::_GP('xteriumPoints', 0);
		$xteriumAllyId			= HTTP::_GP('xteriumAllyId', 0);
		
		$config_after = array(
			'min_build_time'		=> $min_build_time,
			'moon_chance'			=> $moon_chance,
			'factor_university'		=> $factor_university,
			'max_fleets_per_acs'	=> $max_fleets_per_acs,
			'xteriumPoints'			=> $xteriumPoints,
			'xteriumAllyId'			=> $xteriumAllyId,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 13;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	$template	= new template();
	$template->assign_vars(array(	
		'xteriumPoints'    	      		=> $config->xteriumPoints,
		'xteriumAllyId'					=> $config->xteriumAllyId,
		'min_build_time'    	        => $config->min_build_time,
		'moon_chance'					=> $config->moon_chance,
		'factor_university'				=> $config->factor_university,
		'max_fleets_per_acs'			=> $config->max_fleets_per_acs,
		'pageactiveshow'				=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->show('ShowVariousSet.tpl');
}

function ShowNoobsetPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$config_before = array(
			'noobprotectiontime'	=> $config->noobprotectiontime,
			'noobprotectionmulti'	=> $config->noobprotectionmulti,
			'noobprotection'		=> $config->noobprotection,
		);
		$noobprotection 		= isset($_POST['noobprotection']) && $_POST['noobprotection'] == 'on' ? 1 : 0;
		$noobprotectiontime		= HTTP::_GP('noobprotectiontime', 0);
		$noobprotectionmulti	= HTTP::_GP('noobprotectionmulti', 0);
		
		$config_after = array(
			'noobprotectiontime'	=> $noobprotectiontime,
			'noobprotectionmulti'	=> $noobprotectionmulti,
			'noobprotection'		=> $noobprotection,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 12;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	$template	= new template();
	$template->assign_vars(array(	
		'noobprot'						=> $config->noobprotection,
		'noobprot2'						=> $config->noobprotectiontime,
		'noobprot3'						=> $config->noobprotectionmulti,
		'pageactiveshow'				=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/switchery.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/switch.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->loadscript('assets/js/pages/form_checkboxes_radios.js');
	$template->show('ShowNoobset.tpl');
}

function ShowGalaxysetPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$config_before = array(
			'max_galaxy'			=> $config->max_galaxy,
			'max_system'			=> $config->max_system,
			'max_planets'			=> $config->max_planets,
		);
		
		$max_galaxy				= HTTP::_GP('max_galaxy', 0);
		$max_system				= HTTP::_GP('max_system', 0);
		$max_planets			= HTTP::_GP('max_planets', 0);
		
		$config_after = array(
			'max_galaxy'			=> $max_galaxy,
			'max_system'			=> $max_system,
			'max_planets'			=> $max_planets,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 11;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	$template	= new template();
	$template->assign_vars(array(	
		'max_galaxy'					=> $config->max_galaxy,
		'max_system'					=> $config->max_system,
		'max_planets'					=> $config->max_planets,
		'pageactiveshow'				=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->show('ShowGalaxySet.tpl');
}

function ShowDebrissetPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$config_before = array(
			'Defs_Cdr'				=> $config->Defs_Cdr,
			'Fleet_Cdr'				=> $config->Fleet_Cdr,
			'debris_moon'			=> $config->debris_moon,
		);
		$debris_moon			= isset($_POST['debris_moon']) && $_POST['debris_moon'] == 'on' ? 1 : 0;
		$Defs_Cdr				= HTTP::_GP('Defs_Cdr', 0);
		$Fleet_Cdr				= HTTP::_GP('Fleet_Cdr', 0);
		
		$config_after = array(
			'debris_moon'			=> $debris_moon,
			'Defs_Cdr'				=> $Defs_Cdr,
			'Fleet_Cdr'				=> $Fleet_Cdr,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 10;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	$template	= new template();
	$template->assign_vars(array(	
		'defenses'						=> $config->Defs_Cdr,
		'shiips'						=> $config->Fleet_Cdr,
		'debris_moon'			=> $config->debris_moon,
		'pageactiveshow'				=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/switchery.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/switch.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->loadscript('assets/js/pages/form_checkboxes_radios.js');
	$template->show('ShowDebrisSet.tpl');
}

function ShowPlanetsetPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$config_before = array(
			'metal_start'			=> $config->metal_start,
			'crystal_start'			=> $config->crystal_start,
			'deuterium_start'		=> $config->deuterium_start,
			'darkmatter_start'		=> $config->darkmatter_start,
			'initial_fields'		=> $config->initial_fields,
			'metal_basic_income'	=> $config->metal_basic_income,
			'crystal_basic_income'	=> $config->crystal_basic_income,
			'deuterium_basic_income'=> $config->deuterium_basic_income,
		);
		
		$initial_fields			= HTTP::_GP('initial_fields', 0);
		$metal_basic_income		= HTTP::_GP('metal_basic_income', 0);
		$crystal_basic_income	= HTTP::_GP('crystal_basic_income', 0);
		$deuterium_basic_income	= HTTP::_GP('deuterium_basic_income', 0);
		$metal_start			= HTTP::_GP('metal_start', 0);
		$crystal_start			= HTTP::_GP('crystal_start', 0);
		$deuterium_start		= HTTP::_GP('deuterium_start', 0);
		$darkmatter_start		= HTTP::_GP('darkmatter_start', 0);
		
		$config_after = array(
			'initial_fields'		=> $initial_fields,
			'metal_basic_income'	=> $metal_basic_income,
			'crystal_basic_income'	=> $crystal_basic_income,
			'deuterium_basic_income'=> $deuterium_basic_income,
			'metal_start'			=> $metal_start,
			'crystal_start'			=> $crystal_start,
			'deuterium_start'		=> $deuterium_start,
			'darkmatter_start'		=> $darkmatter_start,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 9;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	$template	= new template();
	$template->assign_vars(array(	
		'initial_fields'				=> $config->initial_fields,
		'metal_basic_income'			=> $config->metal_basic_income,
		'crystal_basic_income'			=> $config->crystal_basic_income,
		'deuterium_basic_income'		=> $config->deuterium_basic_income,
		'metal_start'					=> $config->metal_start,
		'crystal_start'					=> $config->crystal_start,
		'deuterium_start'				=> $config->deuterium_start,
		'darkmatter_start'				=> $config->darkmatter_start,
		'pageactiveshow'				=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->show('ShowPlanetSet.tpl');
}

function ShowColonysetPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$config_before = array(
			'min_player_planets'	=> $config->min_player_planets,
			'planets_tech'			=> $config->planets_tech,
			'planets_officier'		=> $config->planets_officier,
			'planets_per_tech'		=> $config->planets_per_tech,
		);
		
		$min_player_planets		= HTTP::_GP('min_player_planets', 0);
		$planets_tech			= HTTP::_GP('planets_tech', 0);
		$planets_officier		= HTTP::_GP('planets_officier', 0);
		$planets_per_tech		= HTTP::_GP('planets_per_tech', 0.0);
		
		$config_after = array(
			'min_player_planets'	=> $min_player_planets,
			'planets_tech'			=> $planets_tech,
			'planets_officier'		=> $planets_officier,
			'planets_per_tech'		=> $planets_per_tech,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 8;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	$template	= new template();
	$template->assign_vars(array(	
		'min_player_planets'			=> $config->min_player_planets,
		'planets_tech'					=> $config->planets_tech,
		'planets_officier'				=> $config->planets_officier,
		'planets_per_tech'				=> $config->planets_per_tech,
		'pageactiveshow'				=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->show('ShowColonieSet.tpl');
}

function ShowRefsetPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$config_before = array(
			'ref_active'			=> $config->ref_active,
			'ref_bonus'				=> $config->ref_bonus,
			'ref_bonus1'			=> $config->ref_bonus1,
			'ref_minpoints'			=> $config->ref_minpoints,
			'ref_max_referals'		=> $config->ref_max_referals,
		);
		$ref_active				= isset($_POST['ref_active']) && $_POST['ref_active'] == 'on' ? 1 : 0;
		$ref_bonus				= HTTP::_GP('ref_bonus', 0);
		$ref_bonus1				= HTTP::_GP('ref_bonus1', 0);
		$ref_minpoints			= HTTP::_GP('ref_minpoints', 0);
		$ref_max_referals		= HTTP::_GP('ref_max_referals', 0);
		
		$config_after = array(
			'ref_active'			=> $ref_active,
			'ref_bonus'				=> $ref_bonus,
			'ref_bonus1'			=> $ref_bonus1,
			'ref_minpoints'			=> $ref_minpoints,
			'ref_max_referals'		=> $ref_max_referals,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 7;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	$template	= new template();
	$template->assign_vars(array(	
		'ref_active'					=> $config->ref_active,
		'ref_bonus'						=> $config->ref_bonus,
		'ref_bonus1'					=> $config->ref_bonus1,
		'ref_minpoints'					=> $config->ref_minpoints,
		'ref_max_referals'				=> $config->ref_max_referals,
		'pageactiveshow'				=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/switchery.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/switch.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->loadscript('assets/js/pages/form_checkboxes_radios.js');
	$template->show('ShowRefSet.tpl');
}

function ShowQueusetPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$config_before = array(
			'max_elements_build'	=> $config->max_elements_build,
			'max_elements_tech'		=> $config->max_elements_tech,
			'max_elements_ships'	=> $config->max_elements_ships,
			'max_fleet_per_build'   => $config->max_fleet_per_build,
		);
		
		$max_elements_build		= HTTP::_GP('max_elements_build', 0);
		$max_elements_tech		= HTTP::_GP('max_elements_tech', 0);
		$max_elements_ships		= HTTP::_GP('max_elements_ships', 0);
		$max_fleet_per_build	= max(0, round(HTTP::_GP('max_fleet_per_build', 0.0)));
		
		$config_after = array(
			'max_elements_build'	=> $max_elements_build,
			'max_elements_tech'		=> $max_elements_tech,
			'max_elements_ships'	=> $max_elements_ships,
			'max_fleet_per_build'	=> $max_fleet_per_build,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 6;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	$template	= new template();
	$template->assign_vars(array(	
		'max_elements_build'			=> $config->max_elements_build,
		'max_elements_tech'				=> $config->max_elements_tech,
		'max_elements_ships'			=> $config->max_elements_ships,
		'max_fleet_per_build'			=> $config->max_fleet_per_build,
		'pageactiveshow'				=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->show('ShowQueueSet.tpl');
}

function ShowExpeditionsetPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$config_before = array(
			'expe_chance_res'		=> $config->expe_chance_res,
			'expe_chance_dark'		=> $config->expe_chance_dark,
			'expe_chance_fleets'	=> $config->expe_chance_fleets,
			'expe_chance_hostile'	=> $config->expe_chance_hostile,
			'expe_chance_hole'		=> $config->expe_chance_hole,
			'expe_chance_change'	=> $config->expe_chance_change,
			'expe_chance_converter'	=> $config->expe_chance_converter,
			'expe_chance_arsenal'	=> $config->expe_chance_arsenal,
			'expe_fleet_arsenal'	=> $config->expe_fleet_arsenal,
			'cosmonaute_status'		=> $config->cosmonaute_status,
			'new_year_status'		=> $config->new_year_status,
			'expe_minPoint_fleet'	=> $config->expe_minPoint_fleet,
		);
		
		$expe_chance_res			= HTTP::_GP('expe_chance_res', 0.00);
		$expe_chance_dark 			= HTTP::_GP('expe_chance_dark', 0.00);		
		$expe_chance_fleets 		= HTTP::_GP('expe_chance_fleets', 0.00);
		$expe_chance_hostile		= HTTP::_GP('expe_chance_hostile', 0.00);
		$expe_chance_hole			= HTTP::_GP('expe_chance_hole', 0.00);
		$expe_chance_change			= HTTP::_GP('expe_chance_change', 0.00);
		$expe_chance_converter 		= HTTP::_GP('expe_chance_converter', 0.00);
		$expe_chance_arsenal 		= HTTP::_GP('expe_chance_arsenal', 0.00);
		$expe_fleet_arsenal 		= HTTP::_GP('expe_fleet_arsenal', 0.00);
		//$cosmonaute_status 		= HTTP::_GP('cosmonaute_status', 0);
		$cosmonaute_status 			= $config->cosmonaute_status;
		//$new_year_status 			= HTTP::_GP('new_year_status', 0);
		$new_year_status 			= $config->new_year_status;
		$expe_minPoint_fleet 		= HTTP::_GP('expe_minPoint_fleet', 0);

		
		$config_after = array(
			'expe_chance_res'		=> $expe_chance_res,
			'expe_chance_dark'		=> $expe_chance_dark,
			'expe_chance_fleets'	=> $expe_chance_fleets,
			'expe_chance_hostile'	=> $expe_chance_hostile,
			'expe_chance_hole'		=> $expe_chance_hole,
			'expe_chance_change'	=> $expe_chance_change,
			'expe_chance_converter'	=> $expe_chance_converter,
			'expe_chance_arsenal'	=> $expe_chance_arsenal,
			'expe_fleet_arsenal'	=> $expe_fleet_arsenal,
			'cosmonaute_status'		=> $cosmonaute_status,
			'new_year_status'		=> $new_year_status,
			'expe_minPoint_fleet'	=> $expe_minPoint_fleet,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 1;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	$template	= new template();
	$template->assign_vars(array(	
		'expe_chance_res'		=> $config->expe_chance_res,
		'expe_chance_dark'		=> $config->expe_chance_dark,
		'expe_chance_fleets'	=> $config->expe_chance_fleets,
		'expe_chance_hostile'	=> $config->expe_chance_hostile,
		'expe_chance_hole'		=> $config->expe_chance_hole,
		'expe_chance_change'	=> $config->expe_chance_change,
		'expe_chance_converter'	=> $config->expe_chance_converter,
		'expe_chance_arsenal'	=> $config->expe_chance_arsenal,
		'expe_fleet_arsenal'	=> $config->expe_fleet_arsenal,
		'cosmonaute_status'		=> $config->cosmonaute_status,
		'new_year_status'		=> $config->new_year_status,
		'expe_minPoint_fleet'	=> $config->expe_minPoint_fleet,
		'pageactiveshow'		=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/switchery.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/switch.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->loadscript('assets/js/pages/form_checkboxes_radios.js');
	$template->show('expeditionset.tpl');
}

function ShowIngamesetPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if (!empty($_POST))
	{
		$config_before = array(
			'uni_name'				=> $config->uni_name,
			'game_speed'			=> $config->game_speed,
			'fleet_speed'			=> $config->fleet_speed,
			'resource_multiplier'	=> $config->resource_multiplier,
			'halt_speed'			=> $config->halt_speed,
			'energySpeed'			=> $config->energySpeed,
			'game_disable'			=> $config->game_disable,
			'close_reason'			=> $config->close_reason,
			'reg_closed'            => $config->reg_closed,
			'user_valid'           	=> $config->user_valid,
			'adm_attack'			=> $config->adm_attack,
		);
		
		$game_disable			= isset($_POST['closed']) && $_POST['closed'] == 'on' ? 1 : 0;
		$adm_attack 			= isset($_POST['adm_attack']) && $_POST['adm_attack'] == 'on' ? 1 : 0;		
		$reg_closed 			= isset($_POST['reg_closed']) && $_POST['reg_closed'] == 'on' ? 1 : 0;
		$user_valid				= isset($_POST['user_valid']) && $_POST['user_valid'] == 'on' ? 1 : 0;
		$close_reason			= HTTP::_GP('close_reason', '', true);
		$uni_name				= HTTP::_GP('uni_name', '', true);
		$game_speed 			= (2500 * HTTP::_GP('game_speed', 0.0));
		$fleet_speed 			= (2500 * HTTP::_GP('fleet_speed', 0.0));
		$resource_multiplier	= HTTP::_GP('resource_multiplier', 0.0);
		$halt_speed				= HTTP::_GP('halt_speed', 0.0);
		$energySpeed			= HTTP::_GP('energySpeed', 0.0);
		
		$config_after = array(
			'game_disable'			=> $game_disable,
			'close_reason'			=> $close_reason,
			'reg_closed'			=> $reg_closed,
			'uni_name'				=> $uni_name,
			'game_speed'			=> $game_speed,
			'fleet_speed'			=> $fleet_speed,
			'resource_multiplier'	=> $resource_multiplier,
			'halt_speed'			=> $halt_speed,
			'energySpeed'			=> $energySpeed,
			'adm_attack'			=> $adm_attack,
			'user_valid'			=> $user_valid,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 1;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	$template	= new template();
	$template->assign_vars(array(	
		'uni_name'				=> $config->uni_name,
		'game_speed'			=> $config->game_speed / 2500,
		'fleet_speed'			=> $config->fleet_speed / 2500,
		'resource_multiplier'	=> $config->resource_multiplier,
		'halt_speed'			=> $config->halt_speed,
		'energySpeed'			=> $config->energySpeed,
		'game_disable'			=> $config->game_disable,
		'close_reason'			=> $config->close_reason,
		'reg_closed'            => $config->reg_closed,
		'user_valid'           	=> $config->user_valid,
		'adm_attack'			=> $config->adm_attack,
		'pageactiveshow'				=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/switchery.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/switch.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->loadscript('assets/js/pages/form_checkboxes_radios.js');
	$template->show('ShowUniverseSet.tpl');
}

function ShowProxysetPage()
{
	global $LNG, $USER;

	$config = Config::get(ROOT_UNI);
	
	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$config_before = array(
			'proxyConfig'			=> $config->proxyConfig,
			'proxyAlert'			=> $config->proxyAlert,
			'proxyBlock'			=> $config->proxyBlock,
		);
		
		$proxyConfig			= isset($_POST['proxyConfig']) && $_POST['proxyConfig'] == 'on' ? 1 : 0;
		$proxyAlert 			= isset($_POST['proxyAlert']) && $_POST['proxyAlert'] == 'on' ? 1 : 0;		
		$proxyBlock 			= isset($_POST['proxyBlock']) && $_POST['proxyBlock'] == 'on' ? 1 : 0;
		
		$config_after = array(
			'proxyConfig'			=> $proxyConfig,
			'proxyAlert'			=> $proxyAlert,
			'proxyBlock'			=> $proxyBlock,
		);
		
		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();
		
		$LOG = new Log(3);
		$LOG->target = 1;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();
	}
	
	$ProxyList	= array();
	$QuerySearch	= $GLOBALS['DATABASE']->query("SELECT * FROM ".IPLOG." WHERE proxies = 1 ORDER BY timestamp DESC LIMIT 100;");
	while ($WhileResult	= $GLOBALS['DATABASE']->fetch_array($QuerySearch)){
		$ProxyList[$WhileResult['suspectId']]	= array(
			'userId'		=> $WhileResult['userId'],
			'nickname'		=> $WhileResult['nickname'],
			'ipadress'		=> $WhileResult['ipadress'],
			'opsystem'		=> $WhileResult['isp'],
			'timestamp'		=> _date('M, d Y', $WhileResult['timestamp'] , $USER['timezone']),
		);	
	}
	
	
	$template	= new template();
	$template->assign_vars(array(	
		'ProxyList'				=> $ProxyList,
		'proxyConfig'			=> $config->proxyConfig,
		'proxyAlert'			=> $config->proxyAlert,
		'proxyBlock'			=> $config->proxyBlock,
		'pageactiveshow'		=> HTTP::_GP('page', "", true),
	));
	
	$template->loadscript('assets/js/plugins/forms/selects/select2.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/uniform.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/switchery.min.js');
	$template->loadscript('assets/js/plugins/forms/styling/switch.min.js');
	$template->loadscript('assets/js/core/app.js');
	$template->loadscript('assets/js/pages/form_layouts.js');
	$template->loadscript('assets/js/pages/form_checkboxes_radios.js');
	$template->show('ShowProxySet.tpl');
}