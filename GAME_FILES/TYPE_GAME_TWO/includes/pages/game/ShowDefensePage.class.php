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
 

class ShowDefensePage extends AbstractGamePage
{
	public static $requireModule = 0;
	
	public static $defaultController = 'show';

	function __construct() 
	{
		parent::__construct();
	}
	
	private function CancelAuftr() 
	{
		global $USER, $PLANET, $resource;
		$ElementQueue = unserialize($PLANET['b_defense_id']);
		
		$CancelArray	= HTTP::_GP('auftr', array());
		
		if(!is_array($CancelArray))
		{
			return false;
		}	
		
		foreach ($CancelArray as $Auftr)
		{
			if(!isset($ElementQueue[$Auftr])) {
				continue;
			}
			
			if($Auftr == 0) {
				$PLANET['b_defense']	= 0;
			}
			
			$Element		= $ElementQueue[$Auftr][0];
			$Count			= $ElementQueue[$Auftr][1];
			
			$costResources	= BuildFunctions::getElementPrice($USER, $PLANET, $Element, false, $Count);
		
			if(isset($costResources[901])) { $PLANET[$resource[901]]	+= $costResources[901] * FACTOR_CANCEL_SHIPYARD; }
			if(isset($costResources[902])) { $PLANET[$resource[902]]	+= $costResources[902] * FACTOR_CANCEL_SHIPYARD; }
			if(isset($costResources[903])) { $PLANET[$resource[903]]	+= $costResources[903] * FACTOR_CANCEL_SHIPYARD; }
			if(isset($costResources[921])) { $USER[$resource[921]]		+= $costResources[921] * FACTOR_CANCEL_SHIPYARD; }
			if(isset($costResources[922])) { $USER[$resource[922]]		+= $costResources[922] * FACTOR_CANCEL_SHIPYARD; }
			
			unset($ElementQueue[$Auftr]);
		}
		
		if(empty($ElementQueue)) {
			$PLANET['b_defense_id']	= '';
		} else {
			$PLANET['b_defense_id']	= serialize(array_values($ElementQueue));
		}

		return true;
	}
	
	private function BuildAuftr($fmenge)
	{
		global $USER, $PLANET, $reslist, $resource, $LNG;
		
		$Missiles	= array(
			502	=> $PLANET[$resource[502]],
			503	=> $PLANET[$resource[503]],
		);
		
		
		$Domes	= array(
			407	=> $PLANET[$resource[407]],
			408	=> $PLANET[$resource[408]],
			409	=> $PLANET[$resource[409]],
		);
		
		$Orbits	= array(
			411	=> $PLANET[$resource[411]],
			
		);

		foreach($fmenge as $Element => $Count)
		{
			if(empty($Count)
				|| !in_array($Element, array_merge($reslist['fleet'], $reslist['defense'], $reslist['missile']))
				|| !BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element)
			) {
				continue;
			}
			
			$MaxElements 	= BuildFunctions::getMaxConstructibleElements($USER, $PLANET, $Element);
			$Count			= is_numeric($Count) ? round($Count) : 0;
			$Count 			= max(min($Count, Config::get()->max_fleet_per_build), 0);
			$Count 			= min($Count, $MaxElements);
			
			
			$missi = $PLANET['misil_launcher'];
			$ll = $PLANET['small_laser'];
			$recs = $PLANET[$resource[209]];
			if($Element == 401){
				$missi = $PLANET['misil_launcher'] + $Count;
			}elseif($Element == 402){
				$ll = $PLANET['small_laser'] + $Count;
			}
			
			if($Element == 209){
				$recs = $PLANET[$resource[209]] + $Count;
			}
			
			if($USER['tutorial'] == 27 && $missi >=25 && $ll >=10){ 
				$db = Database::get();
				$sql =  "UPDATE %%USERS%% SET
				tutorial				= 28
				WHERE id = :userID;";
				$db->update($sql, array(
				':userID'			=> $USER['id']
				));
			}
			if($USER['tutorial'] == 35 && $recs >=5){
				$db = Database::get();
				$sql =  "UPDATE %%USERS%% SET
				tutorial				= 36
				WHERE id = :userID;";
				$db->update($sql, array(
				':userID'			=> $USER['id']
				));
			}
			
			$academy_p_b_2_1208 = 0;
			if($USER['academy_p_b_2_1208'] > 0){
			$academy_p_b_2_1208 = $USER['academy_p_b_2_1208'] * 25;
			}
			
			$BuildArray    	= !empty($PLANET['b_defense_id']) ? unserialize($PLANET['b_defense_id']) : array();
			if (in_array($Element, $reslist['missile']))
			{
				$MaxMissiles		= BuildFunctions::getMaxConstructibleRockets($USER, $PLANET, $Missiles);
				$Count 				= min($Count, $MaxMissiles[$Element]);

				$Missiles[$Element] += $Count;
			}elseif ($Element == 407 || $Element == 408 || $Element == 409)
			{
				$MaxDomes		= BuildFunctions::getMaxConstructibleDomes($USER, $PLANET, $Domes);
				$Count 				= min($Count, $MaxDomes[$Element]);
				$Domes[$Element] += $Count;
			}elseif ($Element == 411)
			{
				$MaxOrbits		= BuildFunctions::getMaxConstructibleOrbits($USER, $PLANET, $Orbits);
				$Count 				= min($Count, $MaxOrbits[$Element]);
				$Orbits[$Element] += $Count;
			}elseif(in_array($Element, $reslist['one'])) {
				$InBuild	= false;
				foreach($BuildArray as $ElementArray) {
					if($ElementArray[0] == $Element) {
						$InBuild	= true;
						break;
					}
				}
				
				if ($InBuild)
					continue;

				if($Count != 0 && $PLANET[$resource[$Element]] == 0 && $InBuild === false)
					$Count =  1;
			}

			if(empty($Count))
				continue;
				
			$costResources	= BuildFunctions::getElementPrice($USER, $PLANET, $Element, false, $Count);
			
			$account_before = array(
				'darkmatter'			=> $USER['darkmatter'],
				'antimatter'			=> $USER['antimatter'],
				'metal'					=> $PLANET['metal'],
				'crystal'				=> $PLANET['crystal'],
				'deuterium'				=> $PLANET['deuterium'],
				'ship'					=> $LNG['tech'][$Element],
			);
			
			if(isset($costResources[901])) { $PLANET[$resource[901]]	-= $costResources[901]; }
			if(isset($costResources[902])) { $PLANET[$resource[902]]	-= $costResources[902]; }
			if(isset($costResources[903])) { $PLANET[$resource[903]]	-= $costResources[903]; }
			if(isset($costResources[921])) { $USER[$resource[921]]		-= $costResources[921]; }
			if(isset($costResources[922])) { $USER[$resource[922]]		-= $costResources[922]; }
			
			$BuildArray[]			= array($Element, $Count);
			$PLANET['b_defense_id']	= serialize($BuildArray);
			
			$account_after = array(
				'darkmatter'			=> isset($costResources[921]) ? $costResources[921] : 0,
				'antimatter'			=> isset($costResources[922]) ? $costResources[922] : 0,
				'metal'					=> isset($costResources[901]) ? $costResources[901] : 0,
				'crystal'				=> isset($costResources[902]) ? $costResources[902] : 0,
				'deuterium'				=> isset($costResources[903]) ? $costResources[903] : 0,
				'ship'					=> $LNG['tech'][$Element]." - ".$Count,
			);
			
			$LOG = new Logcheck(28);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=defense [".$PLANET['galaxy'].":".$PLANET['system'].":".$PLANET['planet']."]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
		}
	}
	
	public function show()
	{
		global $USER, $PLANET, $LNG, $resource, $reslist, $requeriments, $pricelist;
		 
		
		/* if($USER['id'] != 1){
			$this->printMessage('This page is currently not accesible.', true, array('game.php?page=overview', 2));
		} */
		
		$missi = $PLANET['misil_launcher'];
		$ll = $PLANET['small_laser'];
			
		if($USER['tutorial'] == 27 && $missi >=25 && $ll >=10){ 
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 28
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			
			$rawfleetarray = array(204 => 10, 205 => 6, 206 => 2);
			$fleetStartTime		= 60 + TIMESTAMP;
			$timeDifference		= round(max(0, $fleetStartTime - 0));
			$fleetStayTime		= $fleetStartTime;
			$fleetEndTime		= $fleetStayTime + 60;
			$fleetResource	= array(
				901	=> 0,
				902	=> 0,
				903	=> 0,
			);
			FleetFunctions::sendFleet($rawfleetarray, 1, 1, 0, $PLANET['galaxy'],
			$PLANET['system'], 21, 1, $PLANET['id_owner'],
			$PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $fleetResource,
			$fleetStartTime, $fleetStayTime, $fleetEndTime, 0);
		}
			
			
		$buildTodo	= HTTP::_GP('fmenge', array());
		$action		= HTTP::_GP('action', '');
		$mode		= HTTP::_GP('mode', 'defense');						
		$NotBuilding = true;
		if (!empty($PLANET['b_building_id']))
		{
			$CurrentQueue 	= unserialize($PLANET['b_building_id']);
			foreach($CurrentQueue as $ElementArray)
			{
				if($ElementArray[0] == 21 || $ElementArray[0] == 15) {
					$NotBuilding = false;
					break;
				}
			}
		}
		
		$ElementQueue 	= unserialize($PLANET['b_defense_id']);
		if(empty($ElementQueue))
			$Count	= 0;
		else
			$Count	= count($ElementQueue);
			
		if($USER['urlaubs_modus'] == 0 && $NotBuilding == true)
		{
			if (!empty($buildTodo))
			{
				$maxBuildQueue	= Config::get()->max_elements_ships;
				if ($maxBuildQueue != 0 && $Count >= $maxBuildQueue)
				{
					$this->printMessage(sprintf($LNG['bd_max_builds'], $maxBuildQueue), true, array('game.php?page=defense', 2));
				}

				$this->BuildAuftr($buildTodo);
				
			}
					
			if ($action == "delete")
			{
				$this->CancelAuftr();
			}
		}
		
		$elementInQueue	= array();
		$ElementQueue 	= unserialize($PLANET['b_defense_id']);
		$buildList		= array();
		$elementListDefault	= array();
		$elementListLight	= array();
		$elementListMedium	= array();
		$elementListHeavy	= array();
		$elementListall	= array();
		$db	= Database::get();
		$sql	= 'SELECT * FROM %%PLANETIMG%% WHERE imageId = :imageId;';
		$planetStructureBonuses = $db->selectSingle($sql, array(
		':imageId'	=> $PLANET['image']
		));

		if(!empty($ElementQueue))
		{
			$Shipyard		= array();
			$QueueTime		= 0;
			foreach($ElementQueue as $Element)
			{
				if (empty($Element))
					continue;
					
				$elementInQueue[$Element[0]]	= true;
				$ElementTime  	= BuildFunctions::getBuildingTime($USER, $PLANET, $Element[0]);
				$QueueTime   	+= $ElementTime * $Element[1];
				$Shipyard[]		= array($LNG['tech'][$Element[0]], $Element[1], $ElementTime, $Element[0]);		
			}
			
			$buildList	= array(
				'Queue' 				=> $Shipyard,
				'b_defense_id_plus' 		=> $PLANET['b_defense'],
				'pretty_time_b_defense' 	=> pretty_time(max($QueueTime - $PLANET['b_defense'],0)),
			);
		}
		
		
		
		$premium_build_prime = 0;
		if($USER['prem_prime_units_days'] > TIMESTAMP){
		$premium_build_prime = 1;
		}
			
		
		$ShowSpecialShips 	= 0;
		$elementAll	= array_merge($reslist['defense'], $reslist['missile']);
		$elementDefault	= array(407,408,409,411,502,503);
		$elementLight	= array(401,402,403,420);
		$elementMedium	= array(405,404,406,416,421,417);
		$elementHeavy	= array(418,412,410,413,422,419,414,415);
		
		if($premium_build_prime == 1 || Config::get()->primebuild == 1 || config::get(ROOT_UNI)->happyHourEvent == 11 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP) {
			$ShowSpecialShips = 1;
		}
		
		$Missiles	= array();
		$Domes	= array();
		$Orbits	= array();
		
		foreach($reslist['missile'] as $elementID)
		{
			$Missiles[$elementID]	= $PLANET[$resource[$elementID]];
		}

		$defenids = array(407,408,409);
		foreach($defenids as $elementID)
		{
			$Domes[$elementID]	= $PLANET[$resource[$elementID]];
		}
		$defenidsr = array(411);
		foreach($defenidsr as $elementID)
		{
			$Orbits[$elementID]	= $PLANET[$resource[$elementID]];
		}
		
		$MaxMissiles	= BuildFunctions::getMaxConstructibleRockets($USER, $PLANET, $Missiles);
		$MaxDomes	= BuildFunctions::getMaxConstructibleDomes($USER, $PLANET, $Domes);
		$MaxOrbits	= BuildFunctions::getMaxConstructibleOrbits($USER, $PLANET, $Orbits);
		
		$academy_p_b_2_1208 = 0;
		if($USER['academy_p_b_2_1208'] > 0){
		$academy_p_b_2_1208 = $USER['academy_p_b_2_1208'] * 25;
		}
		
		
		foreach($elementAll as $Element)
		{
			
			$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
			$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costResources);
			$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
			$maxBuildable		= BuildFunctions::getMaxConstructibleElements($USER, $PLANET, $Element, $costResources);
			
			
			if(isset($MaxMissiles[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxMissiles[$Element]);
			}
			
			if(isset($MaxDomes[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxDomes[$Element]);
			}
			
			if(isset($MaxOrbits[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxOrbits[$Element]);
			}
			
			$AlreadyBuild		= in_array($Element, $reslist['one']) && (isset($elementInQueue[$Element]));
			
			$elementListall[$Element]	= array(
				'id'				=> $Element,
				'available'			=> $PLANET[$resource[$Element]],
				'costResources'		=> $costResources,
				'costOverflow'		=> $costOverflow,
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'maxBuildable'		=> floattostring($maxBuildable),
				'AlreadyBuild'		=> $AlreadyBuild,
			);
		}
		
		foreach($elementDefault as $Element)
		{
			$techTreeListDefault		 = array();
			$requirementsList	= array();
            if(isset($requeriments[$Element]))
            {
            foreach($requeriments[$Element] as $requireID => $RedCount)
            {
            $requirementsList[$requireID]	= array(
            'count' => $RedCount,
            'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
            );
            }
            }

                $techTreeListDefault[$Element]	= $requirementsList;
			
			$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
			$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costResources);
			$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
			$maxBuildable		= BuildFunctions::getMaxConstructibleElements($USER, $PLANET, $Element, $costResources);
		
		
			
			if(isset($MaxMissiles[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxMissiles[$Element]);
			}
			
			if(isset($MaxDomes[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxDomes[$Element]);
			}
			
			if(isset($MaxOrbits[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxOrbits[$Element]);
			}
			
			$AlreadyBuild		= in_array($Element, $reslist['one']) && (isset($elementInQueue[$Element]));
			
			$elementListDefault[$Element]	= array(
				'id'				=> $Element,
				'available'			=> $PLANET[$resource[$Element]],
				'costResources'		=> $costResources,
				'costOverflow'		=> $costOverflow,
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'UnitsSecond'    	=> ($elementTime <1 ? floor(1/$elementTime) : 0),
				'maxBuildable'		=> floattostring($maxBuildable),
				'AlreadyBuild'		=> $AlreadyBuild,
				'AllTech'			=> $techTreeListDefault,
				'techacc'			=> BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element),
			);
		}
		
		foreach($elementLight as $Element)
		{
		
			$techTreeListLight		 = array();
			$requirementsList	= array();
            if(isset($requeriments[$Element]))
            {
            foreach($requeriments[$Element] as $requireID => $RedCount)
            {
            $requirementsList[$requireID]	= array(
            'count' => $RedCount,
            'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
            );
            }
            }

            $techTreeListLight[$Element]	= $requirementsList;
			
			$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
			$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costResources);
			$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
			$maxBuildable		= BuildFunctions::getMaxConstructibleElements($USER, $PLANET, $Element, $costResources);
			$valeurArray		= array();
			//DISPLAY CONVEYORS LIGHTS BONUSES
			$elementCost	= 0;
		
			if(isset($costResources[901])) {
				$elementCost	+= $costResources[901];
			}
			
			if(isset($costResources[902])) {
				$elementCost	+= $costResources[902];
			}	
			$time	= $elementCost / (config::get()->game_speed * (1 + $PLANET[$resource[21]])) * pow(0.5, $PLANET[$resource[15]]) * (1 + $USER['factor']['ShipTime']);
			$times  = $time;
			if($pricelist[$Element]['type_gun'] > 0)
				$times = max($time, 1);
			
			if($times == 1){
				$SpecialShip = 0;	

				if(isset($PLANET[$resource[$Element].'_conv'])){
					$SpecialShip = $PLANET[$resource[$Element].'_conv'];	 		
				}	

				$premium_conv_l = 0;
				if($USER['prem_conveyors_l'] > 0 && $USER['prem_conveyors_l_days'] > TIMESTAMP){
					$premium_conv_l = $USER['prem_conveyors_l'];
				}
						
				$premium_conv_s = 0;
				if($USER['prem_conveyors_s'] > 0 && $USER['prem_conveyors_s_days'] > TIMESTAMP){
					$premium_conv_s = $USER['prem_conveyors_s'];
				}
					
				$premium_conv_t = 0;
				if($USER['prem_conveyors_t'] > 0 && $USER['prem_conveyors_t_days'] > TIMESTAMP){
					$premium_conv_t = $USER['prem_conveyors_t'];
				}
					
				$arsenal_1_conv = $pricelist[817]['arsenal_bonus'] * $USER['arsenal_conveyor1_level'];
				$arsenal_2_conv = $pricelist[818]['arsenal_bonus'] * $USER['arsenal_conveyor2_level'];
				$arsenal_3_conv = $pricelist[819]['arsenal_bonus'] * $USER['arsenal_conveyor3_level'];

				$sql	= 'SELECT * FROM %%PLANETIMG%% WHERE imageId = :imageId;';
				$planetStructureBonuses = $db->selectSingle($sql, array(
					':imageId'	=> $PLANET['image']
				));
							
				$hashallyconv 	= 0;
				$hashallyconvd 	= 0;
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
				$allyInforconv = $db->selectSingle($sql, array(
					':allianceId'	=> $USER['ally_id']
				));
				if($USER['ally_id'] != 0){
					$hashallyconv = $allyInforconv['total_alliance_conv_fleet'];	
					$hashallyconvd = $allyInforconv['total_alliance_conv_def'];	
				} 
					
				$hashallyconv1 = floor($hashallyconv/2);
				$hashallyconv2 = floor($hashallyconv/4);
				$hashallyconv3 = floor($hashallyconv/8);
					
				$hashallyconvd1 = floor($hashallyconvd/2);
				$hashallyconvd2 = floor($hashallyconvd/4);
				$hashallyconvd3 = floor($hashallyconvd/8);	

				$getGalaxySevenAccount = getGalaxySevenAccount($USER);
				$getGalaxySevenConLvl  = $getGalaxySevenAccount['conveyorLevel'];

				$getGalaxySevePlanet 	= getGalaxySevenPlanet($PLANET);
				$getGalaxySevenConv 	= $getGalaxySevePlanet['conveyorBonus'];
				if($pricelist[$Element]['type_gun'] == 1){
					$Default = (($PLANET['light_conveyor'] + floor($PLANET['light_conveyor'] / 100 * $getGalaxySevenConLvl))*120);
					$valeurArray = array(
						'Default' 			  	=> (($PLANET['light_conveyor'] + floor($PLANET['light_conveyor'] / 100 * $getGalaxySevenConLvl))*120),
						'getGalaxySevenConv'   	=> $Default / 100 * $getGalaxySevenConv,
						'peacefull_exp_light'  	=> $USER['peacefull_exp_light'],
						'SpecialShip'  		  	=> $SpecialShip,
						'hashallyconv1'  	  	=> $hashallyconvd1,
						'premium_conv_l' 		=> ($Default / 100 * $premium_conv_l),
						'planetStructureBonuses'=> ($Default / 100 * $planetStructureBonuses['bonus_conveyors']),
						'arsenal_1_conv' 		=> ($Default / 100 * $arsenal_1_conv),
						'rpg_technocrate' 		=> ($Default / 100 * ($USER['rpg_defenseur']*25)),
					);
				}	
			}
			//END DISPLAY CONVEYORS LIGHTS BONUSES

			if(isset($MaxMissiles[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxMissiles[$Element]);
			}
			
			if(isset($MaxDomes[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxDomes[$Element]);
			}
			
			if(isset($MaxOrbits[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxOrbits[$Element]);
			}
			
			$AlreadyBuild		= in_array($Element, $reslist['one']) && (isset($elementInQueue[$Element]));
			
			$elementListLight[$Element]	= array(
				'id'				=> $Element,
				'available'			=> $PLANET[$resource[$Element]],
				'costResources'		=> $costResources,
				'costOverflow'		=> $costOverflow,
				'elementTime'    	=> $elementTime,
				'UnitsSecond'    	=> ($elementTime <1 ? floor(1/$elementTime) : 0),
				'buyable'			=> $buyable,
				'maxBuildable'		=> floattostring($maxBuildable),
				'AlreadyBuild'		=> $AlreadyBuild,
				'AllTech'			=> $techTreeListLight,
				'valeurArray'		=> $valeurArray,
				'techacc'			=> BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element),
			);
		}
		
		foreach($elementMedium as $Element)
		{
			
			$techTreeListMedium		 = array();
			$requirementsList	= array();
            if(isset($requeriments[$Element]))
            {
            foreach($requeriments[$Element] as $requireID => $RedCount)
            {
            $requirementsList[$requireID]	= array(
            'count' => $RedCount,
            'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
            );
            }
            }

                $techTreeListMedium[$Element]	= $requirementsList;
			
			$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
			$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costResources);
			$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
			$maxBuildable		= BuildFunctions::getMaxConstructibleElements($USER, $PLANET, $Element, $costResources);
			$valeurArray		= array();
			//DISPLAY CONVEYORS LIGHTS BONUSES
			$elementCost	= 0;
		
			if(isset($costResources[901])) {
				$elementCost	+= $costResources[901];
			}
			
			if(isset($costResources[902])) {
				$elementCost	+= $costResources[902];
			}	
			$time	= $elementCost / (config::get()->game_speed * (1 + $PLANET[$resource[21]])) * pow(0.5, $PLANET[$resource[15]]) * (1 + $USER['factor']['ShipTime']);
			$times  = $time;
			if($pricelist[$Element]['type_gun'] > 0)
				$times = max($time, 1);
			
			if($times == 1){
				$SpecialShip = 0;	

				if(isset($PLANET[$resource[$Element].'_conv'])){
					$SpecialShip = $PLANET[$resource[$Element].'_conv'];	 		
				}	

				$premium_conv_l = 0;
				if($USER['prem_conveyors_l'] > 0 && $USER['prem_conveyors_l_days'] > TIMESTAMP){
					$premium_conv_l = $USER['prem_conveyors_l'];
				}
						
				$premium_conv_s = 0;
				if($USER['prem_conveyors_s'] > 0 && $USER['prem_conveyors_s_days'] > TIMESTAMP){
					$premium_conv_s = $USER['prem_conveyors_s'];
				}
					
				$premium_conv_t = 0;
				if($USER['prem_conveyors_t'] > 0 && $USER['prem_conveyors_t_days'] > TIMESTAMP){
					$premium_conv_t = $USER['prem_conveyors_t'];
				}
					
				$arsenal_1_conv = $pricelist[817]['arsenal_bonus'] * $USER['arsenal_conveyor1_level'];
				$arsenal_2_conv = $pricelist[818]['arsenal_bonus'] * $USER['arsenal_conveyor2_level'];
				$arsenal_3_conv = $pricelist[819]['arsenal_bonus'] * $USER['arsenal_conveyor3_level'];

				$sql	= 'SELECT * FROM %%PLANETIMG%% WHERE imageId = :imageId;';
				$planetStructureBonuses = $db->selectSingle($sql, array(
					':imageId'	=> $PLANET['image']
				));
							
				$hashallyconv 	= 0;
				$hashallyconvd 	= 0;
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
				$allyInforconv = $db->selectSingle($sql, array(
					':allianceId'	=> $USER['ally_id']
				));
				if($USER['ally_id'] != 0){
					$hashallyconv = $allyInforconv['total_alliance_conv_fleet'];	
					$hashallyconvd = $allyInforconv['total_alliance_conv_def'];	
				} 
					
				$hashallyconv1 = floor($hashallyconv/2);
				$hashallyconv2 = floor($hashallyconv/4);
				$hashallyconv3 = floor($hashallyconv/8);
					
				$hashallyconvd1 = floor($hashallyconvd/2);
				$hashallyconvd2 = floor($hashallyconvd/4);
				$hashallyconvd3 = floor($hashallyconvd/8);	

				$getGalaxySevenAccount = getGalaxySevenAccount($USER);
				$getGalaxySevenConLvl  = $getGalaxySevenAccount['conveyorLevel'];

				$getGalaxySevePlanet 	= getGalaxySevenPlanet($PLANET);
				$getGalaxySevenConv 	= $getGalaxySevePlanet['conveyorBonus'];
				
				if($pricelist[$Element]['type_gun'] == 2){
					$Default = (($PLANET['medium_conveyor'] + floor($PLANET['medium_conveyor'] / 100 * $getGalaxySevenConLvl))*72);
					$valeurArray = array(
						'Default' 			  	=> (($PLANET['medium_conveyor'] + floor($PLANET['medium_conveyor'] / 100 * $getGalaxySevenConLvl))*72),
						'getGalaxySevenConv'   	=> $Default / 100 * $getGalaxySevenConv,
						'peacefull_exp_light'  	=> $USER['peacefull_exp_medium'],
						'SpecialShip'  		  	=> $SpecialShip,
						'hashallyconv1'  	  	=> $hashallyconvd2,
						'premium_conv_l' 		=> ($Default / 100 * $premium_conv_s),
						'planetStructureBonuses'=> ($Default / 100 * $planetStructureBonuses['bonus_conveyors']),
						'arsenal_1_conv' 		=> ($Default / 100 * $arsenal_2_conv),
						'rpg_technocrate' 		=> ($Default / 100 * ($USER['rpg_defenseur']*25)),
					);
				}			
			} 
			//END DISPLAY CONVEYORS LIGHTS BONUSES

			if(isset($MaxMissiles[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxMissiles[$Element]);
			}
			
			if(isset($MaxDomes[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxDomes[$Element]);
			}
			
			if(isset($MaxOrbits[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxOrbits[$Element]);
			}
			
			$AlreadyBuild		= in_array($Element, $reslist['one']) && (isset($elementInQueue[$Element]));
			
			$elementListMedium[$Element]	= array(
				'id'				=> $Element,
				'available'			=> $PLANET[$resource[$Element]],
				'costResources'		=> $costResources,
				'costOverflow'		=> $costOverflow,
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'UnitsSecond'    	=> ($elementTime <1 ? floor(1/$elementTime) : 0),
				'maxBuildable'		=> floattostring($maxBuildable),
				'AlreadyBuild'		=> $AlreadyBuild,
				'AllTech'			=> $techTreeListMedium,
				'valeurArray'		=> $valeurArray,
				'techacc'			=> BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element),
			);
		}
		
		foreach($elementHeavy as $Element)
		{
			
			$techTreeListHeavy		 = array();
			$requirementsList	= array();
            if(isset($requeriments[$Element]))
            {
            foreach($requeriments[$Element] as $requireID => $RedCount)
            {
            $requirementsList[$requireID]	= array(
            'count' => $RedCount,
            'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
            );
            }
            }

                $techTreeListHeavy[$Element]	= $requirementsList;
			
			$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
			$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costResources);
			$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
			$maxBuildable		= BuildFunctions::getMaxConstructibleElements($USER, $PLANET, $Element, $costResources);
			
			$valeurArray		= array();
			//DISPLAY CONVEYORS LIGHTS BONUSES
			$elementCost	= 0;
		
			if(isset($costResources[901])) {
				$elementCost	+= $costResources[901];
			}
			
			if(isset($costResources[902])) {
				$elementCost	+= $costResources[902];
			}	
			$time	= $elementCost / (config::get()->game_speed * (1 + $PLANET[$resource[21]])) * pow(0.5, $PLANET[$resource[15]]) * (1 + $USER['factor']['ShipTime']);
			$times  = $time;
			if($pricelist[$Element]['type_gun'] > 0)
				$times = max($time, 1);
			
			if($times == 1){
				$SpecialShip = 0;	

				if(isset($PLANET[$resource[$Element].'_conv'])){
					$SpecialShip = $PLANET[$resource[$Element].'_conv'];	 		
				}	

				$premium_conv_l = 0;
				if($USER['prem_conveyors_l'] > 0 && $USER['prem_conveyors_l_days'] > TIMESTAMP){
					$premium_conv_l = $USER['prem_conveyors_l'];
				}
						
				$premium_conv_s = 0;
				if($USER['prem_conveyors_s'] > 0 && $USER['prem_conveyors_s_days'] > TIMESTAMP){
					$premium_conv_s = $USER['prem_conveyors_s'];
				}
					
				$premium_conv_t = 0;
				if($USER['prem_conveyors_t'] > 0 && $USER['prem_conveyors_t_days'] > TIMESTAMP){
					$premium_conv_t = $USER['prem_conveyors_t'];
				}
					
				$arsenal_1_conv = $pricelist[817]['arsenal_bonus'] * $USER['arsenal_conveyor1_level'];
				$arsenal_2_conv = $pricelist[818]['arsenal_bonus'] * $USER['arsenal_conveyor2_level'];
				$arsenal_3_conv = $pricelist[819]['arsenal_bonus'] * $USER['arsenal_conveyor3_level'];

				$sql	= 'SELECT * FROM %%PLANETIMG%% WHERE imageId = :imageId;';
				$planetStructureBonuses = $db->selectSingle($sql, array(
					':imageId'	=> $PLANET['image']
				));
							
				$hashallyconv 	= 0;
				$hashallyconvd 	= 0;
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
				$allyInforconv = $db->selectSingle($sql, array(
					':allianceId'	=> $USER['ally_id']
				));
				if($USER['ally_id'] != 0){
					$hashallyconv = $allyInforconv['total_alliance_conv_fleet'];	
					$hashallyconvd = $allyInforconv['total_alliance_conv_def'];	
				} 
					
				$hashallyconv1 = floor($hashallyconv/2);
				$hashallyconv2 = floor($hashallyconv/4);
				$hashallyconv3 = floor($hashallyconv/8);
					
				$hashallyconvd1 = floor($hashallyconvd/2);
				$hashallyconvd2 = floor($hashallyconvd/4);
				$hashallyconvd3 = floor($hashallyconvd/8);	

				$getGalaxySevenAccount = getGalaxySevenAccount($USER);
				$getGalaxySevenConLvl  = $getGalaxySevenAccount['conveyorLevel'];

				$getGalaxySevePlanet 	= getGalaxySevenPlanet($PLANET);
				$getGalaxySevenConv 	= $getGalaxySevePlanet['conveyorBonus'];
				
				if($pricelist[$Element]['type_gun'] == 3){
					$Default = (($PLANET['heavy_conveyor'] + floor($PLANET['heavy_conveyor'] / 100 * $getGalaxySevenConLvl))*20);
					$valeurArray = array(
						'Default' 			  	=> (($PLANET['heavy_conveyor'] + floor($PLANET['heavy_conveyor'] / 100 * $getGalaxySevenConLvl))*20),
						'getGalaxySevenConv'   	=> $Default / 100 * $getGalaxySevenConv,
						'peacefull_exp_light'  	=> $USER['peacefull_exp_heavy'],
						'SpecialShip'  		  	=> $SpecialShip,
						'hashallyconv1'  	  	=> $hashallyconvd3,
						'premium_conv_l' 		=> ($Default / 100 * $premium_conv_t),
						'planetStructureBonuses'=> ($Default / 100 * $planetStructureBonuses['bonus_conveyors']),
						'arsenal_1_conv' 		=> ($Default / 100 * $arsenal_3_conv),
						'rpg_technocrate' 		=> ($Default / 100 * ($USER['rpg_defenseur']*25)),
					);
				}
			} 
			//END DISPLAY CONVEYORS LIGHTS BONUSES

			if(isset($MaxMissiles[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxMissiles[$Element]);
			}
			
			if(isset($MaxDomes[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxDomes[$Element]);
			}
			
			if(isset($MaxOrbits[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxOrbits[$Element]);
			}
			
			$AlreadyBuild		= in_array($Element, $reslist['one']) && (isset($elementInQueue[$Element]));
			
			$elementListHeavy[$Element]	= array(
				'id'				=> $Element,
				'available'			=> $PLANET[$resource[$Element]],
				'costResources'		=> $costResources,
				'costOverflow'		=> $costOverflow,
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'UnitsSecond'    	=> ($elementTime <1 ? floor(1/$elementTime) : 0),
				'maxBuildable'		=> floattostring($maxBuildable),
				'AlreadyBuild'		=> $AlreadyBuild,
				'AllTech'			=> $techTreeListHeavy,
				'valeurArray'		=> $valeurArray,
				'techacc'			=> BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element),
			);
		}
		
		$this->assign(array(
			'elementListall'				=> $elementListall,
			'bd_protection_shield_only_one'	=> sprintf($LNG['bd_protection_shield_only_one'], 25 + $academy_p_b_2_1208),
			'elementListDefault'			=> $elementListDefault,
			'elementListLight'				=> $elementListLight,
			'elementListHeavy'				=> $elementListHeavy,
			'elementListMedium'				=> $elementListMedium,
			'NotBuilding'					=> $NotBuilding,
			'convLight'						=> $PLANET[$resource[71]],
			'convMedium'					=> $PLANET[$resource[72]],
			'convHeavy'						=> $PLANET[$resource[73]],
			'Rocket'						=> $PLANET[$resource[401]],
			'LightL'						=> $PLANET[$resource[402]],
			'BuildList'						=> $buildList,
			'ShowSpecialShips'				=> $ShowSpecialShips,
			'maxlength'						=> strlen(Config::get()->max_fleet_per_build)+3,
			'mode'							=> $mode,
			'insta_dm_left'					=> ($mode == "fleet") ? sprintf($LNG['customm_24'],pretty_number(100000000 - $USER['insta_dm_navy'])) : sprintf($LNG['customm_24'],pretty_number(100000000 - $USER['insta_dm_defense'])),
		));

		$this->display('page.defense.default.tpl');
	}
}