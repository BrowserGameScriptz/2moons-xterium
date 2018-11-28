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
 

class ShowShipyardPage extends AbstractGamePage
{
	public static $requireModule = 0;
	
	public static $defaultController = 'show';

	function __construct() 
	{
		parent::__construct();
	}
	
	private function CancelAuftr() 
	{
		global $USER, $PLANET, $resource, $LNG;
		$ElementQueue = unserialize($PLANET['b_hangar_id']);
		
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
				$PLANET['b_hangar']	= 0;
			}
			
			$Element		= $ElementQueue[$Auftr][0];
			$Count			= $ElementQueue[$Auftr][1];
			
			$account_before = array(
				'darkmatter'			=> $USER['darkmatter'],
				'antimatter'			=> $USER['antimatter'],
				'metal'					=> $PLANET['metal'],
				'crystal'				=> $PLANET['crystal'],
				'deuterium'				=> $PLANET['deuterium'],
				'ship'					=> $LNG['tech'][$Element],
			);
			
			$costResources	= BuildFunctions::getElementPrice($USER, $PLANET, $Element, false, $Count);
		
			if(isset($costResources[901])) { $PLANET[$resource[901]]	+= $costResources[901] * 0.5; }
			if(isset($costResources[902])) { $PLANET[$resource[902]]	+= $costResources[902] * 0.5; }
			if(isset($costResources[903])) { $PLANET[$resource[903]]	+= $costResources[903] * 0.5; }
			if(isset($costResources[921])) { $USER[$resource[921]]		+= $costResources[921] * 0.5; }
			if(isset($costResources[922])) { $USER[$resource[922]]		+= $costResources[922] * 0.5; }
			
			$account_after = array(
				'darkmatter'			=> isset($costResources[921]) ? $costResources[921] * 0.5 : 0,
				'antimatter'			=> isset($costResources[922]) ? $costResources[922] * 0.5 : 0,
				'metal'					=> isset($costResources[901]) ? $costResources[901] * 0.5 : 0,
				'crystal'				=> isset($costResources[902]) ? $costResources[902] * 0.5 : 0,
				'deuterium'				=> isset($costResources[903]) ? $costResources[903] * 0.5 : 0,
				'ship'					=> $LNG['tech'][$Element]." - ".$Count,
			);
			
			$LOG = new Logcheck(27);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=shipyard cancel [".$PLANET['galaxy'].":".$PLANET['system'].":".$PLANET['planet']."]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
			
			unset($ElementQueue[$Auftr]);
		}
		
		if(empty($ElementQueue)) {
			$PLANET['b_hangar_id']	= '';
		} else {
			$PLANET['b_hangar_id']	= serialize(array_values($ElementQueue));
		}

		return true;
	}
	
	function BuildAuftrDM($fmenge)
	{
		global $USER, $PLANET, $reslist, $resource, $LNG;
		
		$Missiles	= array(
			502	=> $PLANET[$resource[502]],
			503	=> $PLANET[$resource[503]],
		);

		$Message = "";
		$Counting = 0;
		$Price = 0;
		$mode = 'fleet';
		foreach($fmenge as $Element => $Count)
		{
			if(empty($Count)
				|| !in_array($Element, array_merge($reslist['fleet'], $reslist['defense'], $reslist['missile']))
				|| !BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element)
			) {
				continue;
			}
			
			$MaxElements 	= BuildFunctions::getMaxConstructibleElementsDM($USER, $PLANET, $Element);
			$Count			= is_numeric($Count) ? round($Count) : 0;
			$Count 			= abs($Count);
			$Count 			= max(min($Count, 9999999), 0);
			$Count 			= min($Count, $MaxElements);
			
		
			$BuildArray    	= !empty($PLANET['b_hangar_id']) ? unserialize($PLANET['b_hangar_id']) : array();
			if (in_array($Element, $reslist['missile']))
			{
				$MaxMissiles		= BuildFunctions::getMaxConstructibleRockets($USER, $PLANET, $Missiles);
				$Count 				= min($Count, $MaxMissiles[$Element]);

				$Missiles[$Element] += $Count;
			} elseif(in_array($Element, $reslist['one'])) {
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
				
			$costResources	= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element, false, $Count);
			
			$sql	= 'SELECT insta_dm_navy, insta_dm_defense, darkmatter FROM %%USERS%% WHERE id = :id_owner';
			$userNewData	= Database::get()->selectSingle($sql, array(
				':id_owner'	=> $USER['id']
			));
			
			$account_before = array(
				$resource[$Element]		=> $PLANET[$resource[$Element]],
				'darkmatter'			=> $userNewData['darkmatter'],
				'insta_dm_navy'			=> $userNewData['insta_dm_navy'],
				'insta_dm_defense'		=> $userNewData['insta_dm_defense'],
				'price'					=> $costResources[921],
			);
		
			if($userNewData['insta_dm_navy'] + $costResources[921] > 100000000 && $Element < 400)
				continue;
			
			if($userNewData['insta_dm_defense'] + $costResources[921] > 100000000 && $Element > 400)
				continue;
		
			if(isset($costResources[921])) { $USER[$resource[921]]		-= $costResources[921]; }
			$db	= Database::get();
			if($Element < 400){
			$sql	= "UPDATE %%USERS%% SET insta_dm_navy = insta_dm_navy + :insta_dm_navy, darkmatter = darkmatter - :insta_dm_navy WHERE id = :userId;";
			$db->update($sql, array(
			':insta_dm_navy'	=> $costResources[921],
			':userId'	=> $USER['id']
			));
			}else{
			$sql	= "UPDATE %%USERS%% SET insta_dm_defense = insta_dm_defense + :insta_dm_defense, darkmatter = darkmatter - :darkmatter WHERE id = :userId;";
			$db->update($sql, array(
			':darkmatter'	=> $costResources[921],
			':insta_dm_defense'	=> $costResources[921],
			':userId'	=> $USER['id']
			));	
			}
			
			
			$PLANET[$resource[$Element]]		+= $Count;
			$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]."  = ".$resource[$Element]." + :count WHERE id = :planetId;";
			$db->update($sql, array(
			':count'	=> $Count,
			':planetId'	=> $PLANET['id']
			));
			
			if(TIMESTAMP < config::get()->dmRefundEvent){
				$sql	= 'INSERT INTO %%DMREFUND%% SET userId = :userId, darkAmount = :darkAmount, timestamp = :timestamp;';
				database::get()->insert($sql, array(
					':userId'		=> $USER['id'],
					':darkAmount'	=> $costResources[921],
					':timestamp'	=> TIMESTAMP
				));
			}
			
			$Message .= '<span style="color:#999;">'.$LNG['tech'][$Element].' ('.$Count.')</span><br />';
			$Counting = 0;
			$Price += $costResources[921];
			
			if($Element > 400)
				$mode = 'defense';
			
			$sql	= 'SELECT darkmatter, insta_dm_navy, insta_dm_defense FROM %%USERS%% WHERE id = :userId;';
			$getUser = database::get()->selectSingle($sql, array(
				':userId'		=> $USER['id'],
			));
			
			$sql	= 'SELECT '.$resource[$Element].' FROM %%PLANETS%% WHERE id = :userId;';
			$getPlanet = database::get()->selectSingle($sql, array(
				':userId'		=> $PLANET['id'],
			));
			
			$account_after = array(
				$resource[$Element]		=> $getPlanet[$resource[$Element]],
				'darkmatter'			=> $getUser['darkmatter'],
				'insta_dm_navy'			=> $getUser['insta_dm_navy'],
				'insta_dm_defense'		=> $getUser['insta_dm_defense'],
				'price'					=> $costResources[921],
			);
			
			$LOG = new Logcheck(9);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=dmshipyard [Buy ".$mode."]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
		}
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
			

			$recs = $PLANET[$resource[209]];
			
			if($Element == 209){
			$recs = $PLANET[$resource[209]] + $Count;
			}
			
			if($USER['tutorial'] == 38 && $recs >=5){
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 39
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			}
			
			$academy_p_b_2_1208 = 0;
			if($USER['academy_p_b_2_1208'] > 0){
			$academy_p_b_2_1208 = $USER['academy_p_b_2_1208'] * 25;
			}
			
			$BuildArray    	= !empty($PLANET['b_hangar_id']) ? unserialize($PLANET['b_hangar_id']) : array();
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
			$PLANET['b_hangar_id']	= serialize($BuildArray);
			
			$account_after = array(
				'darkmatter'			=> isset($costResources[921]) ? $costResources[921] : 0,
				'antimatter'			=> isset($costResources[922]) ? $costResources[922] : 0,
				'metal'					=> isset($costResources[901]) ? $costResources[901] : 0,
				'crystal'				=> isset($costResources[902]) ? $costResources[902] : 0,
				'deuterium'				=> isset($costResources[903]) ? $costResources[903] : 0,
				'ship'					=> $LNG['tech'][$Element]." - ".$Count,
			);
			
			$LOG = new Logcheck(27);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=shipyard [".$PLANET['galaxy'].":".$PLANET['system'].":".$PLANET['planet']."]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
		}
	}
	
	public function show()
	{
		global $USER, $PLANET, $LNG, $resource, $reslist, $requeriments, $pricelist;
		
		/* if($PLANET['isAlliancePlanet'] != 0){
			$this->printMessage($LNG['autoexpedition_5'], true, array('game.php?page=overview', 2));
		} */
	
		$recs = $PLANET['recycler'];
			
		if($USER['tutorial'] == 38 && $recs >=5){ 
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 39
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
			
		$buildTodo		= HTTP::_GP('fmenge', array());
		$ToDoDmBuild	= HTTP::_GP('dark_dm', array());
		$action			= HTTP::_GP('action', '');
		$buyId      	= HTTP::_GP('buyId', 0);
		$mode			= 'fleet';						 
		$NotBuilding 	= true;
		
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
		
		$ElementQueue 	= unserialize($PLANET['b_hangar_id']);
		if(empty($ElementQueue))
			$Count	= 0;
		else
			$Count	= count($ElementQueue);
		
		if($USER['urlaubs_modus'] == 0 && $NotBuilding == true)
		{
			$methodPurchase      	= HTTP::_GP('methodPurchase', "buy_resource");
			if (!empty($buildTodo) && $methodPurchase == "buy_resource")
			{
				$maxBuildQueue	= Config::get()->max_elements_ships;
				if ($maxBuildQueue != 0 && $Count >= $maxBuildQueue)
				{
					$this->printMessage(sprintf($LNG['bd_max_builds'], $maxBuildQueue), true, array('game.php?page=shipyard', 2));
				}
				$this->BuildAuftr($buildTodo);
				
			}elseif (!empty($ToDoDmBuild) && $methodPurchase == "buy_darkmatter")
			{
				
				$maxBuildQueue	= Config::get()->max_elements_ships;
				if ($maxBuildQueue != 0 && $Count >= $maxBuildQueue)
				{
					$this->printMessage(sprintf($LNG['bd_max_builds'], $maxBuildQueue), true, array('game.php?page=shipyard', 2));
				}
				$this->BuildAuftrDM($ToDoDmBuild);
				
			}
					
			if ($action == "delete") 
			{
				$this->CancelAuftr();
			}
		}
		
		$elementInQueue			= array();
		$ElementQueue 			= unserialize($PLANET['b_hangar_id']);
		$buildList				= array();
		$elementListDefault		= array();
		$elementListLight		= array();
		$elementListMedium		= array();
		$elementListHeavy		= array();
		$elementListall			= array();
		$db						= Database::get();
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
				'b_hangar_id_plus' 		=> $PLANET['b_hangar'],
				'pretty_time_b_hangar' 	=> pretty_time(max($QueueTime - $PLANET['b_hangar'],0)),
			);
		}
		
		
		
		$premium_build_prime = 0;
		if($USER['prem_prime_units_days'] > TIMESTAMP){
			$premium_build_prime = 1;
		}
			
		
		$ShowSpecialShips 	= 0;
		$elementAll			= $reslist['fleet'];
		$elementDefault		= array(208,210,220,223);
		$elementLight		= array(212,202,203,204,205,229);
		$elementMedium		= array(209,206,207,217,215,213,211,224,219);
		$elementHeavy		= array(225,226,214,216,230,227,228,222,218,221);		

		$getGalaxySevePlanet 	= getGalaxySevenPlanet($PLANET);
		$getGalaxySevenM7 		= $getGalaxySevePlanet['buildM7'];
		$getGalaxySevenM19 		= $getGalaxySevePlanet['buildM19'];
		$getGalaxySevenM32 		= $getGalaxySevePlanet['buildM32'];
		
		if($mode == 'fleet' && $premium_build_prime == 1 || $mode == 'fleet' && Config::get()->primebuild == 1 || $mode == 'fleet' && config::get(ROOT_UNI)->happyHourEvent == 11 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP) {
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
			$getElementPriceDM	= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
			$getRestPriceDM		= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $getElementPriceDM);
			$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costResources);
			$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
			$buyableDM			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $getElementPriceDM);
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
				'getElementPriceDM'	=> $getElementPriceDM[921],
				'costOverflow'		=> $costOverflow,
				'getRestPriceDM'	=> $getRestPriceDM[921],
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'buyableDM'			=> $buyableDM,
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
			$getElementPriceDM	= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
			$getRestPriceDM		= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $getElementPriceDM);
			$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costResources);
			$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
			$buyableDM			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $getElementPriceDM);
			$maxBuildable		= BuildFunctions::getMaxConstructibleElements($USER, $PLANET, $Element, $costResources);
			$maxBuildableDM		= 0;
			if($Element != 220)
				$maxBuildableDM		= BuildFunctions::getMaxConstructibleElementsDM($USER, $PLANET, $Element, $getElementPriceDM);
		
			
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
				'getElementPriceDM'	=> $getElementPriceDM[921],
				'costOverflow'		=> $costOverflow,
				'getRestPriceDM'	=> $getRestPriceDM[921],
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'buyableDM'			=> $buyableDM,
				'UnitsSecond'    	=> ($elementTime <1 ? floor(1/$elementTime) : 0),
				'maxBuildable'		=> floattostring($maxBuildable),
				'maxBuildableDM'	=> floattostring($maxBuildableDM),
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
			$getElementPriceDM	= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
			$getRestPriceDM		= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $getElementPriceDM);
			$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costResources);
			$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
			$buyableDM			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $getElementPriceDM);
			$maxBuildable		= BuildFunctions::getMaxConstructibleElements($USER, $PLANET, $Element, $costResources);
			$maxBuildableDM		= 0;
			if($Element != 229)
				$maxBuildableDM		= BuildFunctions::getMaxConstructibleElementsDM($USER, $PLANET, $Element, $getElementPriceDM);
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
					$Default = (($PLANET['light_conveyor'] + floor($PLANET['light_conveyor'] / 100 * $getGalaxySevenConLvl))*60);
					$valeurArray = array(
						'Default' 			  	=> (($PLANET['light_conveyor'] + floor($PLANET['light_conveyor'] / 100 * $getGalaxySevenConLvl))*60),
						'getGalaxySevenConv'   	=> $Default / 100 * $getGalaxySevenConv,
						'peacefull_exp_light'  	=> $USER['peacefull_exp_light'],
						'SpecialShip'  		  	=> $SpecialShip,
						'hashallyconv1'  	  	=> $hashallyconv1,
						'premium_conv_l' 		=> ($Default / 100 * $premium_conv_l),
						'planetStructureBonuses'=> ($Default / 100 * $planetStructureBonuses['bonus_conveyors']),
						'arsenal_1_conv' 		=> ($Default / 100 * $arsenal_1_conv),
						'rpg_technocrate' 		=> ($Default / 100 * ($USER['rpg_technocrate']*5)),
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
				'getElementPriceDM'	=> $getElementPriceDM[921],
				'getRestPriceDM'	=> $getRestPriceDM[921],
				'buyableDM'			=> $buyableDM,
				'maxBuildableDM'	=> floattostring($maxBuildableDM),
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
			$getElementPriceDM	= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element);
			$getRestPriceDM		= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $getElementPriceDM);
			$buyableDM			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $getElementPriceDM);
			$maxBuildableDM		= 0;
			if($Element != 224)
				$maxBuildableDM		= BuildFunctions::getMaxConstructibleElementsDM($USER, $PLANET, $Element, $getElementPriceDM);
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
					$Default = (($PLANET['medium_conveyor'] + floor($PLANET['medium_conveyor'] / 100 * $getGalaxySevenConLvl))*36);
					$valeurArray = array(
						'Default' 			  	=> (($PLANET['medium_conveyor'] + floor($PLANET['medium_conveyor'] / 100 * $getGalaxySevenConLvl))*36),
						'getGalaxySevenConv'   	=> $Default / 100 * $getGalaxySevenConv,
						'peacefull_exp_light'  	=> $USER['peacefull_exp_medium'],
						'SpecialShip'  		  	=> $SpecialShip,
						'hashallyconv1'  	  	=> $hashallyconv2,
						'premium_conv_l' 		=> ($Default / 100 * $premium_conv_s),
						'planetStructureBonuses'=> ($Default / 100 * $planetStructureBonuses['bonus_conveyors']),
						'arsenal_1_conv' 		=> ($Default / 100 * $arsenal_2_conv),
						'rpg_technocrate' 		=> ($Default / 100 * ($USER['rpg_technocrate']*5)),
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
				'getElementPriceDM'	=> $getElementPriceDM[921],
				'getRestPriceDM'	=> $getRestPriceDM[921],
				'buyableDM'			=> $buyableDM,
				'maxBuildableDM'	=> floattostring($maxBuildableDM),
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
			$getElementPriceDM	= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element);
			$getRestPriceDM		= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $getElementPriceDM);
			$buyableDM			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $getElementPriceDM);
			$maxBuildableDM		= 0;
			if($Element != 230)
				$maxBuildableDM		= BuildFunctions::getMaxConstructibleElementsDM($USER, $PLANET, $Element, $getElementPriceDM);
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
					$Default = (($PLANET['heavy_conveyor'] + floor($PLANET['heavy_conveyor'] / 100 * $getGalaxySevenConLvl))*10);
					$valeurArray = array(
						'Default' 			  	=> (($PLANET['heavy_conveyor'] + floor($PLANET['heavy_conveyor'] / 100 * $getGalaxySevenConLvl))*10),
						'getGalaxySevenConv'   	=> $Default / 100 * $getGalaxySevenConv,
						'peacefull_exp_light'  	=> $USER['peacefull_exp_heavy'],
						'SpecialShip'  		  	=> $SpecialShip,
						'hashallyconv1'  	  	=> $hashallyconv3,
						'premium_conv_l' 		=> ($Default / 100 * $premium_conv_t),
						'planetStructureBonuses'=> ($Default / 100 * $planetStructureBonuses['bonus_conveyors']),
						'arsenal_1_conv' 		=> ($Default / 100 * $arsenal_3_conv),
						'rpg_technocrate' 		=> ($Default / 100 * ($USER['rpg_technocrate']*5)),
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
				'valeurArray'			=> $valeurArray,
				'getElementPriceDM'	=> $getElementPriceDM[921],
				'getRestPriceDM'	=> $getRestPriceDM[921],
				'buyableDM'			=> $buyableDM,
				'maxBuildableDM'	=> floattostring($maxBuildableDM),
				'techacc'			=> BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element),
			);
		}
		
		$this->assign(array(
			'getGalaxySevenM7'				=> $getGalaxySevenM7,
			'getGalaxySevenM19'				=> $getGalaxySevenM19,
			'getGalaxySevenM32'				=> $getGalaxySevenM32,
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
			'showText'						=> 0,
			'buyId'							=> $buyId,
			'insta_dm_left'			=> ($mode == "fleet") ? sprintf($LNG['customm_24'],pretty_number(100000000 - $USER['insta_dm_navy'])) : sprintf($LNG['customm_24'],pretty_number(100000000 - $USER['insta_dm_defense'])),
		));

		$this->display('page.shipyard.default.tpl');
	}
}