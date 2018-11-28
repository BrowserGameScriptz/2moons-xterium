<?php

class ShowImperiumPage extends AbstractGamePage
{
	public static $requireModule = MODULE_IMPERIUM;
	
	public static $elementAllTris 	= array(1,2,3,4,6,12,14,15,21,22,23,24,31,33,34,41,42,43,44,71,72,73,69,50,51,52);
	public static $elementALL		= array(210,212,202,203,204,205,229,209,206,207,208,217,215,213,211,220,224,219,223,225,226,214,216,230,227,228,222,218,221);
	public static $elementALLBis	= array(401,402,403,420,405,404,406,416,421,417,418,412,410,413,422,419,414,415,407,408,409,411,502,503);
	
	public static $buildingMapping = array(
		'metal_mine',
		'crystal_mine',
		'deuterium_sintetizer',
		'solar_plant',
		'university',
		'fusion_plant',
		'robot_factory',
		'nano_factory',
		'hangar',
		'metal_store',
		'crystal_store',
		'deuterium_store',
		'laboratory',
		'terraformer',
		'ally_deposit',
		'mondbasis',
		'phalanx',
		'sprungtor',
		'silo',
		'light_conveyor',
		'medium_conveyor',
		'heavy_conveyor',
		'collider',
		'planetarium',
		'touchmodule',
		'researchcenter',
	);
	public static $FleetMapping = array(
		'spy_sonde',
        'solar_satelit',
        'small_ship_cargo',
        'big_ship_cargo',
        'light_hunter',
        'heavy_hunter',
        'm7',
        'recycler',
        'crusher',
        'battle_ship',
        'colonizer',
        'ev_transporter',
        'battleship',
        'destructor',
        'bomber_ship',
        'dm_ship',
        'm19',
        'giga_recykler',
        'saver',
        'galleon',
        'destroyer',
        'dearth_star',
        'lune_noir',
        'm32',
        'frigate',
        'black_wanderer',
        'flying_death',
        'star_crasher',
        'bs_oneil',
	);
	public static $DefenseMapping = array(
		'misil_launcher',
        'small_laser',
        'big_laser',
        'megador_slim',
        'ionic_canyon',
        'gauss_canyon',
        'buster_canyon',
        'hydrogen_cannon',
        'iron_megador',
        'dora_cannon',
        'photon_cannon',
        'lepton_gun',
        'graviton_canyon',
        'proton_gun',
        'grand_megador',
        'particle_emitter',
        'canyon',
        'quantum_cannon',
        'small_protection_shield',
        'big_protection_shield',
        'planet_protector',
        'orbital_station',
        'interceptor_misil',
        'interplanetary_misil'
	);
	
	function __construct() 
	{
		parent::__construct();
	}

	function show()
	{
		global $USER, $PLANET, $resource, $reslist;
		
		/*if($USER['id'] != 1)
			$this->printMessage("This page is currently under maintenance. Please try again later.", true, array('game.php?page=overview', 2));*/
		
        $db = Database::get();

		switch($USER['planet_sort'])
		{
			case 2:
				$orderBy = 'name';
				break;
			case 1:
				$orderBy = 'galaxy, system, planet, planet_type';
				break;
			default:
				$orderBy = 'id';
				break;
		}
		
		$orderBy .= ' '.($USER['planet_sort_order'] == 1) ? 'DESC' : 'ASC';

        $sql = "SELECT * FROM %%PLANETS%% WHERE id != :planetID AND (id_owner = :userID OR isAlliancePlanet = :isAlliancePlanet AND isAlliancePlanet != 0) AND destruyed = '0' ORDER BY :order;";
        $PlanetsRAW = $db->select($sql, array(
            ':planetID' 		=> $PLANET['id'],
            ':isAlliancePlanet' => $USER['ally_id'],
            ':userID'   		=> $USER['id'],
            ':order'    		=> $orderBy,
        ));

        $PLANETS	= array($PLANET);
		
		$PlanetRess	= new ResourceUpdate();
		
		foreach ($PlanetsRAW as $CPLANET)
		{
            list($USER, $CPLANET)	= $PlanetRess->CalcResource($USER, $CPLANET, true);
			
			$PLANETS[]	= $CPLANET;
			unset($CPLANET);
		}

        $planetList	= array();
		$sql = "SELECT PLANETS FROM %%ALLIANCE_RANK%% WHERE rankID = :allyId;";
        $allianceInfo = $db->selectSingle($sql, array(
            ':allyId' => $USER['ally_rank_id'],
        ));
		$sql = "SELECT ally_owner FROM %%ALLIANCE%% WHERE id = :allyId;";
        $allianceInfo2 = $db->selectSingle($sql, array(
            ':allyId' => $USER['ally_id'],
        ));
		
		$okAllowed = 1;
		if(empty($allianceInfo['PLANETS']) && $allianceInfo2['ally_owner'] != $USER['id'])
			$okAllowed = 0;
		
		foreach($PLANETS as $Planet)
		{
			if($Planet['isAlliancePlanet'] != 0 && $okAllowed == 0) continue;
			
			$incomestart1 = $Planet['planet_type'] == 1 ? Config::get()->{$resource[901].'_basic_income'} : 0;
			$incomestart2 = $Planet['planet_type'] == 1 ? Config::get()->{$resource[902].'_basic_income'} : 0;
			$incomestart3 = $Planet['planet_type'] == 1 ? Config::get()->{$resource[903].'_basic_income'} : 0;
			$currentPlanet = array(
				'isAlliancePlanet'=> $okAllowed == 1 ? $Planet['isAlliancePlanet'] : 0,
				'image'		=> $Planet['image'],
				'id'		=> $Planet['id'],
				'type'		=> $Planet['planet_type'],
				'name'		=> $Planet['name'],
				'galaxy'	=> $Planet['galaxy'],
				'system'	=> $Planet['system'],
				'planet'	=> $Planet['planet'],
				'current'	=> $Planet['field_current'],
				'max'		=> CalculateMaxPlanetFields($Planet),
				'metal_percent' => round($Planet['metal'] * 100 / $Planet['metal_max']),
				'cystal_percent' => round($Planet['crystal'] * 100 / $Planet['crystal_max']),
				'deut_percent' => round($Planet['deuterium'] * 100 / $Planet['deuterium_max']),
				'resource901' => pretty_number($Planet['metal']),
				'resource902' => pretty_number($Planet['crystal']),
				'resource903' => pretty_number($Planet['deuterium']),
				'resource911' => pretty_number($Planet['energy']),
				'meta' => pretty_number($Planet['metal_perhour']),
				'cry' => pretty_number($Planet['crystal_perhour']),
				'deut' => pretty_number($Planet['deuterium_perhour']),
				'meta1' => pretty_number($Planet['metal_perhour'] * 24),
				'cry1' => pretty_number($Planet['crystal_perhour'] * 24),
				'deut1' => pretty_number($Planet['deuterium_perhour'] * 24),
				'meta2' => pretty_number($Planet['metal_perhour'] * 24 * 30),
				'cry2' => pretty_number($Planet['crystal_perhour'] * 24 * 30),
				'deut2' => pretty_number($Planet['deuterium_perhour']* 24*30),
				'current' 			=> $Planet['field_current'],
				'max' => CalculateMaxPlanetFields($Planet),
				'energy_used' => $Planet['energy'] + $Planet['energy_used'],
				'metaMax' => pretty_number($Planet['metal_max']),
				'cryMax' => pretty_number($Planet['crystal_max']),
				'deutMax' => pretty_number($Planet['deuterium_max']),
				'resource901' => pretty_number($Planet['metal']),
				'resource902' => pretty_number($Planet['crystal']),
				'resource903' => pretty_number($Planet['deuterium']),
				'resource911' => pretty_number($Planet['energy']),
				'resource901s' => ($Planet['metal_perhour'] + $incomestart1 * Config::get()->resource_multiplier),
				'resource902s' => ($Planet['crystal_perhour'] + $incomestart2 * Config::get()->resource_multiplier),
				'resource903s' => ($Planet['deuterium_perhour'] + $incomestart3 * Config::get()->resource_multiplier),
				'resource921s' => ($Planet['darkmatter_perhour']),
				'isgal6module' => $Planet['gal6mod'],
			);
			
			foreach(self::$buildingMapping as $map){
				$currentPlanet[$map] = $Planet[$map];
			}
			foreach(self::$DefenseMapping as $map){
				$currentPlanet[$map] = $Planet[$map];
			}
			foreach(self::$FleetMapping as $map){
				$currentPlanet[$map] = $Planet[$map];
			}
			
			$planetList[] = $currentPlanet;
		}

		$sql		= 'SELECT COUNT(*) as count FROM %%PLANETS%% WHERE id_owner = :userID AND destruyed = 0;';
		$isMax		= $db->selectSingle($sql, array(
			':userID'	=> $USER['id'],
		));
		
		$sql		= 'SELECT COUNT(*) as count FROM %%PLANETS%% WHERE id_owner = :userID AND destruyed = 0 AND planet_type = 3;';
		$isMaxMoons		= $db->selectSingle($sql, array(
			':userID'	=> $USER['id'],
		));
		
		$sql		= 'SELECT COUNT(*) as count FROM %%PLANETS%% WHERE id_owner = :userID AND destruyed = 0 AND planet_type = 1 AND gal6mod = 1;';
		$isMaxGal6		= $db->selectSingle($sql, array(
			':userID'	=> $USER['id'],
		));
		
		$sql		= 'SELECT COUNT(*) as count FROM %%PLANETS%% WHERE isAlliancePlanet = :isAlliancePlanet AND destruyed = 0;';
		$isMaxAPlanet		= $db->selectSingle($sql, array(
			':isAlliancePlanet'	=> $USER['ally_id'],
		));
		
		$sql		= 'SELECT COUNT(*) as count FROM %%PLANETS%% WHERE id_owner = :userID AND destruyed = 0 AND planet_type = 1 AND gal6mod = 0 AND isAlliancePlanet = 0;';
		$MaxPlanets		= $db->selectSingle($sql, array(
			':userID'	=> $USER['id'],
		));

		$select_defenses	= '';
		$select_buildings	= '';
		$select_fleets		= '';
		$select_resource    = '';
		$fleetId			= array(210,212,202,203,204,205,229,209,206,207,208,217,215,213,211,220,224,219,223,225,226,214,216,230,227,228,222,218,221);
		$defenceId 			= array(401,402,403,420,405,404,406,416,421,417,418,412,410,413,422,419,414,415,407,408,409,411,502,503);

		foreach($reslist['build'] as $Building){
			$select_buildings	.= " SUM(".$resource[$Building].") as ".$resource[$Building].",";
		}
		
		foreach($fleetId as $Fleet){
			$select_fleets		.= " SUM(".$resource[$Fleet].") as ".$resource[$Fleet].",";
		}	
		
		foreach($defenceId as $Defense){
			$select_defenses	.= " SUM(".$resource[$Defense].") as ".$resource[$Defense].",";
		}
		
		foreach($reslist['resstype'][1] as $resourceIDs)
		{
			if($resourceIDs != 921){
			$select_resource	.= " SUM(".$resource[$resourceIDs].") as ".$resource[$resourceIDs].",";
			}
		}
		
		$sql = "SELECT ".$select_buildings.$select_resource.$select_fleets.$select_defenses." id, SUM(metal_perhour) as metal_perhour, SUM(crystal_perhour) as crystal_perhour, SUM(deuterium_perhour) as deuterium_perhour, SUM(darkmatter_perhour) as darkmatter_perhour FROM %%PLANETS%% WHERE id_owner = :userID AND destruyed = '0' ORDER BY :order;";
		$PlanetsRAWss = $db->selectSingle($sql, array(
		':userID'   => $USER['id'],
		':order'    => $orderBy,
		));

		$this->tplObj->loadscript("empire.js");
		$this->assign(array(
			'planetList'	=> $planetList,
			'colspan'		=> count($PLANETS) + 2,
			'planetListawr'	=> $planetList,
			'coultAll'	=> $isMax['count'],
			'coultPlanet'	=> $MaxPlanets['count'],
			'coultMoon'	=> $isMaxMoons['count'],
			'isMaxGal6'	=> $isMaxGal6['count'],
			'isMaxAPlanet'	=> $okAllowed == 1 ? $isMaxAPlanet['count'] : 0,
			'elementListall'	=> self::$elementALL,
			'elementListallBis'	=> self::$elementALLBis,
			'elementListallTris'	=> self::$elementAllTris,
			'buildingMapping' => self::$buildingMapping,
			'FleetMapping' => self::$FleetMapping,
			'DefenseMapping' => self::$DefenseMapping,
			'metal_minas' => $PlanetsRAWss['metal_mine'],
			'crystal_mines' => $PlanetsRAWss['crystal_mine'],
			'deuterium_sintetizers' => $PlanetsRAWss['deuterium_sintetizer'],
			'solar_plants' => $PlanetsRAWss['solar_plant'],
			'fusion_plants' => $PlanetsRAWss['fusion_plant'],
			'robot_factorys' => $PlanetsRAWss['robot_factory'],
			'nano_factorys' => $PlanetsRAWss['nano_factory'],
			'hangars' => $PlanetsRAWss['hangar'],
			'metal_stores' => $PlanetsRAWss['metal_store'],
			'crystal_stores' => $PlanetsRAWss['crystal_store'],
			'deuterium_stores' => $PlanetsRAWss['deuterium_store'],
			'laboratorys' => $PlanetsRAWss['laboratory'],
			'terraformers' => $PlanetsRAWss['terraformer'],
			'universitys' => $PlanetsRAWss['university'],
			'ally_deposits' => $PlanetsRAWss['ally_deposit'],
			'silos' => $PlanetsRAWss['silo'],
			'mondbasiss' => $PlanetsRAWss['mondbasis'],
			'phalanxs' => $PlanetsRAWss['phalanx'],
			'sprungtors' => $PlanetsRAWss['sprungtor'],
			'colliders' => $PlanetsRAWss['collider'],
			'planetariums' => $PlanetsRAWss['planetarium'],
			'touchmodules' => $PlanetsRAWss['touchmodule'],
			'researchcenters' => $PlanetsRAWss['researchcenter'],
			'lightcs' => $PlanetsRAWss['light_conveyor'],
			'medcs' => $PlanetsRAWss['medium_conveyor'],
			'heavycs' => $PlanetsRAWss['heavy_conveyor'],
			'metal_perhourss' => pretty_number($PlanetsRAWss['metal_perhour'] + ($incomestart1*$MaxPlanets['count']) * Config::get()->resource_multiplier),
			'crystal_perhourss' => pretty_number($PlanetsRAWss['crystal_perhour'] + ($incomestart2*$MaxPlanets['count']) * Config::get()->resource_multiplier),
			'deuterium_perhourss' => pretty_number($PlanetsRAWss['deuterium_perhour'] + ($incomestart3*$MaxPlanets['count']) * Config::get()->resource_multiplier),
			'darkmatter_perhourss' => pretty_number($PlanetsRAWss['darkmatter_perhour']),
			'metal_perhoursss' => pretty_number(($PlanetsRAWss['metal_perhour'] + ($incomestart1*$MaxPlanets['count']) * Config::get()->resource_multiplier)*24),
			'crystal_perhoursss' => pretty_number(($PlanetsRAWss['crystal_perhour'] + ($incomestart2*$MaxPlanets['count']) * Config::get()->resource_multiplier)*24),
			'deuterium_perhoursss' => pretty_number(($PlanetsRAWss['deuterium_perhour'] + ($incomestart3*$MaxPlanets['count']) * Config::get()->resource_multiplier)*24),
			'darkmatter_perhoursss' => pretty_number(($PlanetsRAWss['darkmatter_perhour'] * 24)),			
			'metals' => pretty_number($PlanetsRAWss['metal']),
			'crystals' => pretty_number($PlanetsRAWss['crystal']),
			'deuteriums' => pretty_number($PlanetsRAWss['deuterium']),
			'solar_satelits' => pretty_number($PlanetsRAWss['solar_satelit']),
			'small_ship_cargos' => pretty_number($PlanetsRAWss['small_ship_cargo']),
			'big_ship_cargos' => pretty_number($PlanetsRAWss['big_ship_cargo']),
			'light_hunters' => pretty_number($PlanetsRAWss['light_hunter']),
			'heavy_hunters' => pretty_number($PlanetsRAWss['heavy_hunter']),
			'M7s' => pretty_number($PlanetsRAWss['m7']),
			'recyclers' => pretty_number($PlanetsRAWss['recycler']),
			'crushers' => pretty_number($PlanetsRAWss['crusher']),
			'battle_ships' => pretty_number($PlanetsRAWss['battle_ship']),
			'ev_transporters' => pretty_number($PlanetsRAWss['ev_transporter']),
			'battleships' => pretty_number($PlanetsRAWss['battleship']),
			'destructors' => pretty_number($PlanetsRAWss['destructor']),
			'bomber_ships' => pretty_number($PlanetsRAWss['bomber_ship']),
			'm19s' => pretty_number($PlanetsRAWss['m19']),
			'giga_recyklers' => pretty_number($PlanetsRAWss['giga_recykler']),
			'galleons' => pretty_number($PlanetsRAWss['galleon']),
			'destroyers' => pretty_number($PlanetsRAWss['destroyer']),
			'dearth_stars' => pretty_number($PlanetsRAWss['dearth_star']),
			'lune_noirs' => pretty_number($PlanetsRAWss['lune_noir']),
			'M32s' => pretty_number($PlanetsRAWss['m32']),
			'frigates' => pretty_number($PlanetsRAWss['frigate']),
			'black_wanderers' => pretty_number($PlanetsRAWss['black_wanderer']),
			'flying_deaths' => pretty_number($PlanetsRAWss['flying_death']),
			'star_crashers' => pretty_number($PlanetsRAWss['star_crasher']),
			'bs_class_oneils' => pretty_number($PlanetsRAWss['bs_oneil']),
			'colonizers' => pretty_number($PlanetsRAWss['colonizer']),
			'spy_sondes' => pretty_number($PlanetsRAWss['spy_sonde']),
			'dm_ships' => pretty_number($PlanetsRAWss['dm_ship']),
			'Scrappys' => pretty_number($PlanetsRAWss['saver']),
			'misil_launchers' => pretty_number($PlanetsRAWss['misil_launcher']),
			'small_lasers' => pretty_number($PlanetsRAWss['small_laser']),
			'big_lasers' => pretty_number($PlanetsRAWss['big_laser']),
			'gauss_canyons' => pretty_number($PlanetsRAWss['gauss_canyon']),
			'ionic_canyons' => pretty_number($PlanetsRAWss['ionic_canyon']),
			'buster_canyons' => pretty_number($PlanetsRAWss['buster_canyon']),
			'small_protection_shields' => pretty_number($PlanetsRAWss['small_protection_shield']),
			'big_protection_shields' => pretty_number($PlanetsRAWss['big_protection_shield']),
			'planet_protectors' => pretty_number($PlanetsRAWss['planet_protector']),
			'graviton_canyons' => pretty_number($PlanetsRAWss['graviton_canyon']),
			'orbital_stations' => pretty_number($PlanetsRAWss['orbital_station']),
			'lepton_guns' => pretty_number($PlanetsRAWss['lepton_gun']),
			'proton_guns' => pretty_number($PlanetsRAWss['proton_gun']),
			'canyons' => pretty_number($PlanetsRAWss['canyon']),
			'hydrogen_guns' => pretty_number($PlanetsRAWss['hydrogen_cannon']),
			'dora_guns' => pretty_number($PlanetsRAWss['dora_cannon']),
			'photon_cannons' => pretty_number($PlanetsRAWss['photon_cannon']),
			'particle_emitters' => pretty_number($PlanetsRAWss['particle_emitter']),
			'quantum_cannons' => pretty_number($PlanetsRAWss['quantum_cannon']),
			'slim_mehadors' => pretty_number($PlanetsRAWss['megador_slim']),
			'iron_mehadors' => pretty_number($PlanetsRAWss['iron_megador']),
			'grand_mehadors' => pretty_number($PlanetsRAWss['grand_megador']),
			'interceptor_misils' => pretty_number($PlanetsRAWss['interceptor_misil']),
			'interplanetary_misils' => pretty_number($PlanetsRAWss['interplanetary_misil'])
		));

		$this->display('page.empire.default.tpl');
	}
}