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


class ShowInformationPage extends AbstractGamePage
{
	public static $requireModule = MODULE_INFORMATION;

	protected $disableEcoSystem = true;

	function __construct()
	{
		parent::__construct();
	}

	static function getNextJumpWaitTime($lastTime, $planetInfo)
	{
		global $PLANET,$resource;
		
		//$timeTOWait = $lastTime + Config::get()->gate_wait_time;
		$timeTOWait = max(6*60,Config::get()->gate_wait_time-($planetInfo-1)*360);
		return $lastTime+$timeTOWait;
	}

	public function sendFleet()
	{
		global $PLANET, $USER, $resource, $LNG, $reslist;

		$db = Database::get();

		$NextJumpTime = self::getNextJumpWaitTime($PLANET['last_jump_time'], $PLANET['sprungtor']);

		if (TIMESTAMP < $NextJumpTime)
		{
			$this->sendJSON(array(
				'message'	=> $LNG['in_jump_gate_already_used'].' '.pretty_time($NextJumpTime - TIMESTAMP),
				'error'		=> true
			));
		}

		$TargetPlanet = HTTP::_GP('jmpto', (int) $PLANET['id']);

		$sql = "SELECT id, last_jump_time, sprungtor FROM %%PLANETS%% WHERE id = :targetID AND id_owner = :userID AND sprungtor > 0;";
		$TargetGate = $db->selectSingle($sql, array(
			':targetID' => $TargetPlanet,
			':userID'   => $USER['id']
		));

		if (!isset($TargetGate) || $TargetPlanet == $PLANET['id'])
		{
			$this->sendJSON(array(
				'message' => $LNG['in_jump_gate_doesnt_have_one'],
				'error' => true
			));
		}

		$NextJumpTime   = self::getNextJumpWaitTime($TargetGate['last_jump_time'], $TargetGate['sprungtor']);

		if (TIMESTAMP < $NextJumpTime)
		{
			$this->sendJSON(array(
				'message' => $LNG['in_jump_gate_not_ready_target'].' '.pretty_time($NextJumpTime - TIMESTAMP),
				'error' => true
			));
		}

		$ShipArray		= array();
		$SubQueryOri	= "";
		$SubQueryDes	= "";
		$Ships			= HTTP::_GP('ship', array());
		$SubQueryParams = array();
		
		
		foreach($reslist['fleet'] as $Ship)
		{
			if(!isset($Ships[$Ship]) || $Ship == 212)
				continue;

			$ShipArray[$Ship]	= max(0, min($Ships[$Ship], $PLANET[$resource[$Ship]]));

			if(empty($ShipArray[$Ship]))
				continue;

			$SubQueryOri 		.= $resource[$Ship]." = ".$resource[$Ship]." - ".$ShipArray[$Ship].", ";
			$SubQueryDes 		.= $resource[$Ship]." = ".$resource[$Ship]." + ".$ShipArray[$Ship].", ";
			//$SubQueryParams[':'.$resource[$Ship].'']    = $ShipArray[$Ship];
			$PLANET[$resource[$Ship]] -= $ShipArray[$Ship];
		}

		if (empty($SubQueryOri))
		{
			$this->sendJSON(array(
				'message' => $LNG['in_jump_gate_error_data'],
				'error' => true
			));
		}

		$array_merge =  array(':planetID' => $PLANET['id'],':jumptime' => TIMESTAMP);
		$sql  = "UPDATE %%PLANETS%% SET ".$SubQueryOri." `last_jump_time` = :jumptime WHERE id = :planetID;";
		$db->update($sql,$array_merge);

		$sql  = "UPDATE %%PLANETS%% SET ".$SubQueryDes." `last_jump_time` = :jumptime WHERE id = :targetID;";
		$db->update($sql, array(
			':targetID' => $TargetPlanet,
			':jumptime' => TIMESTAMP,
		));

		$PLANET['last_jump_time'] 	= TIMESTAMP;
		$NextJumpTime	= self::getNextJumpWaitTime($PLANET['last_jump_time'], $PLANET['sprungtor']);
		$this->sendJSON(array(
			'message' => sprintf($LNG['in_jump_gate_done'], pretty_time($NextJumpTime - TIMESTAMP)),
			'error' => false
		));
	}

	private function getAvailableFleets()
	{
		global $reslist, $resource, $PLANET;

		$fleetList  = array();

		foreach($reslist['fleet'] as $Ship)
		{
			if ($Ship == 212 || $PLANET[$resource[$Ship]] <= 0)
				continue;

			$fleetList[$Ship]	= $PLANET[$resource[$Ship]];
		}

		return $fleetList;
	}

	public function destroyMissiles()
	{
		global $resource, $PLANET;

		$db = Database::get();

		$Missle	= HTTP::_GP('missile', array());
		$PLANET[$resource[502]]	-= max(0, min($Missle[502], $PLANET[$resource[502]]));
		$PLANET[$resource[503]]	-= max(0, min($Missle[503], $PLANET[$resource[503]]));

		$sql = "UPDATE %%PLANETS%% SET interceptor_misil = :resource502Val, interplanetary_misil = :resource503Val WHERE id = :planetID;";
		$db->update($sql, array(
			':resource502Val'   => $PLANET[$resource[502]],
			':resource503Val'   => $PLANET[$resource[503]],
			':planetID'         => $PLANET['id']
		));

		$this->sendJSON(array($PLANET[$resource[502]], $PLANET[$resource[503]]));
	}

	private function getTargetGates()
	{
		global $resource, $USER, $PLANET;

		$db = Database::get();

				

		$sql = "SELECT id, name, galaxy, system, planet, last_jump_time, sprungtor FROM %%PLANETS%% WHERE id != :planetID AND id_owner = :userID AND planet_type = '3' AND sprungtor > 0 ORDER BY galaxy, system, planet ASC;";
		$moonResult = $db->select($sql, array(
			':planetID'         => $PLANET['id'],
			':userID'           => $USER['id']
		));

		$moonList	= array();

		foreach($moonResult as $moonRow) {
			$NextJumpTime				= self::getNextJumpWaitTime($moonRow['last_jump_time'], $moonRow['sprungtor']);
			$moonList[$moonRow['id']]	= '['.$moonRow['galaxy'].':'.$moonRow['system'].':'.$moonRow['planet'].'] '.$moonRow['name'].(TIMESTAMP < $NextJumpTime ? ' ('.pretty_time($NextJumpTime - TIMESTAMP).')':'');
		}

		return $moonList;
	}

	public function show()
	{
		global $USER, $PLANET, $LNG, $resource, $pricelist, $reslist, $CombatCaps, $ProdGrid;

		$elementID 	= HTTP::_GP('id', 0);
		

		$this->setWindow('popup');
		$this->initTemplate();
		
		if(!isset($resource[$elementID])){
		PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page', TIMESTAMP);
		$this->printMessage($LNG['moon_hack'], true, array('game.php?page=createMoon', 3));
		}			
		
		$productionTable	= array();
		$FleetInfo			= array();
		$MissileList		= array();
		$gateData			= array();

		$CurrentLevel		= 0;

		$ressIDs			= array_merge(array(), $reslist['resstype'][1], $reslist['resstype'][2], $reslist['resstype'][3]);

		if(in_array($elementID, $reslist['prod']) && in_array($elementID, $reslist['build']))
		{

			/* Data for eval */
			$BuildEnergy		= $USER[$resource[113]];
			$BuildTemp          = $PLANET['temp_max'];
			$BuildLevelFactor	= $PLANET[$resource[$elementID].'_porcent'];
			
			$academy_p_b_2_1209 = 0;
				if($USER['academy_p_b_2_1209'] > 0){
				$academy_p_b_2_1209 = $USER['academy_p_b_2_1209'] * 3;
				}
			
				$academy_p_b_2_1210 = 0;
				if($USER['academy_p_b_2_1210'] > 0){
				$academy_p_b_2_1210 = $USER['academy_p_b_2_1210'] * 3;
				}
				
				$db	= Database::get();
				$sql	= 'SELECT * FROM %%PLANETIMG%% WHERE imageId = :imageId;';
				$planetStructureBonuses = $db->selectSingle($sql, array(
				':imageId'	=> $PLANET['image']
				));
			
				$planetStrucMetal = $planetStructureBonuses['bonus_metal'];
				$planetStrucCrystal = $planetStructureBonuses['bonus_crystal'];
				$planetStrucDeuterium = $planetStructureBonuses['bonus_deuterium'];
				$planetStrucEnergy = $planetStructureBonuses['bonus_energy'];
				$userPeaceExp = $USER['peacefull_exp_level'];
		
				$premium_resource = 0;
				if($USER['prem_res'] > 0 && $USER['prem_res_days'] > TIMESTAMP){
				$premium_resource = $USER['prem_res'];
				}
				
				$getGalaxySevenAccount = getGalaxySevenAccount($USER);
				$getGalaxySevenProduct = $getGalaxySevenAccount['resourceProd'];
				$getGalaxySevenCollide = $getGalaxySevenAccount['colliderProd'];

				$gouvernor_resource = 0;
				if($USER['dm_resource'] > TIMESTAMP){
				$gouvernor_resource = GubPriceAPSTRACT(704, $USER['dm_resource_level'], 'dm_resource');
				}
			
				$gouvernor_energy = 0;
				if($USER['dm_energie'] > TIMESTAMP){
				$gouvernor_energy = GubPriceAPSTRACT(705, $USER['dm_energie_level'], 'dm_energie');
				}
		
				$premium_collider =  0;
				if($USER['prem_prod_from_colly'] > 0 && $USER['prem_prod_from_colly_days'] > TIMESTAMP){
				$premium_collider = $USER['prem_prod_from_colly'];
				}
		
				$academy_p_b_2_1201 = 0;
				if($USER['academy_p_b_2_1201'] > 0){
				$academy_p_b_2_1201 = $USER['academy_p_b_2_1201'] * 5;
				}
				
				$geologuebon = 2 * $USER['rpg_geologue'];
				
				$arsenal_1_eco = $pricelist[814]['arsenal_bonus'] * $USER['arsenal_res901_level'];
				$arsenal_2_eco = $pricelist[815]['arsenal_bonus'] * $USER['arsenal_res902_level'];
				$arsenal_3_eco = $pricelist[816]['arsenal_bonus'] * $USER['arsenal_res903_level'];	
			
				$hashallyprod = 0;
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
				$allyInfores = $db->selectSingle($sql, array(
				':allianceId'	=> $USER['ally_id']
				));
				if($USER['ally_id'] != 0){
				$hashallyprod = $allyInfores['total_alliance_production'];	
				}
			
				$academy_p_b_2_1202 = 0;
				if($USER['academy_p_b_2_1202'] > 0){
				$academy_p_b_2_1202 = $USER['academy_p_b_2_1202'] * 2;
				}

			$CurrentLevel		= $PLANET[$resource[$elementID]];
			$BuildStartLvl   	= max($CurrentLevel - 2, 0);
			for($BuildLevel = $BuildStartLvl; $BuildLevel < $BuildStartLvl + 15; $BuildLevel++)
			{
				foreach($ressIDs as $ID)
				{

					if(!isset($ProdGrid[$elementID]['production'][$ID]))
						continue;

					$Production	= eval(ResourceUpdate::getProd($ProdGrid[$elementID]['production'][$ID]));

					if(in_array($ID, $reslist['resstype'][2]))
					{
						$Production	*= Config::get()->energySpeed;
					}
					else
					{
						$Production	*= Config::get()->resource_multiplier;
					}

					$productionTable['production'][$BuildLevel][$ID]	= $Production;
				}
			}

			$productionTable['usedResource']	= array_keys($productionTable['production'][$BuildStartLvl]);
		}
		elseif(in_array($elementID, $reslist['storage']))
		{
			$CurrentLevel		= $PLANET[$resource[$elementID]];
			$BuildStartLvl   	= max($CurrentLevel - 2, 0);

			$premium_storage = 0;
			if($USER['prem_storage'] > 0 && $USER['prem_storage_days'] > TIMESTAMP){
			$premium_storage = $USER['prem_storage'];
			}			
				
			$academy_p_b_2_1204 = 0;
			if($USER['academy_p_b_2_1204'] > 0){
			$academy_p_b_2_1204 = $USER['academy_p_b_2_1204'] * 5;
			}
				
			for($BuildLevel = $BuildStartLvl; $BuildLevel < $BuildStartLvl + 15; $BuildLevel++)
			{
				foreach($ressIDs as $ID)
				{
					if(!isset($ProdGrid[$elementID]['storage'][$ID]))
						continue;

					$production = round(eval(ResourceUpdate::getProd($ProdGrid[$elementID]['storage'][$ID])));
					$production *= Config::get()->resource_multiplier;
					$production *= STORAGE_FACTOR;

					$productionTable['storage'][$BuildLevel][$ID]	= $production;
				}
			}

			$productionTable['usedResource']	= array_keys($productionTable['storage'][$BuildStartLvl]);
		}
		elseif(in_array($elementID, $reslist['fleet']))
		{
			$academy_p_b_2_1207 	= 0;
		if($USER['academy_p_b_2_1207'] > 0){
			$academy_p_b_2_1207 = $USER['academy_p_b_2_1207'] * 5;
		}	
			$premium_fuel_comsuption = 0;
			if($USER['prem_fuel_consumption'] > 0 && $USER['prem_fuel_consumption_days'] > TIMESTAMP){
			$premium_fuel_comsuption = $USER['prem_fuel_consumption'];
			}
			
			$academy_fuel_comsuption = 0;
			if($USER['academy_p_b_1_1107'] > 0){
			$academy_fuel_comsuption = $USER['academy_p_b_1_1107'];
			}
			
			$techSpeed = $pricelist[$elementID]['tech'];
			if($techSpeed == 1) {
			$techSpeed = 1;
			}
			if($techSpeed == 2) {
			$techSpeed = 2;
			}
			if($techSpeed == 3) {
			$techSpeed = 3;
			}
			if($techSpeed == 4) {
			$techSpeed = $USER['impulse_motor_tech'] >= 5 ? 2 : 1;
			}
			if($techSpeed == 5) {
			$techSpeed = $USER['hyperspace_motor_tech'] >= 8 ? 3 : 2;
			}
			
			
			$fleetTyps		= explode(';', $pricelist[$elementID]['wapeon_gun']);

			$WRECKSLIST	= array();
			$fleetAmount	= array();
			$wreckAmount	= array();
			foreach ($fleetTyps as $fleetTyp)
			{			
				if ($pricelist[$elementID]['wapeon_gun'] == 0) continue;
				$temp = explode(':', $fleetTyp);
				if (!isset($fleetAmount[$temp[0]]))
				{
					$wreckAmount[$temp[0]] = "";
				}

				$wreckAmount[$temp[0]] = $temp[0];
				$wreckAmount[$temp[1]] = $temp[1];
				
				$factorBonus = $wreckAmount[$temp[0]] == 199 ? 4 * $USER[$resource[$wreckAmount[$temp[0]]]] : 2 * $USER[$resource[$wreckAmount[$temp[0]]]];
				$thirdValue	 = 0;
				$thirdValues = 0;
				
				if($temp[0] == 120){
					$thirdValue	 = 801;	//laser
					$thirdValues  = $pricelist[$thirdValue]['arsenal_bonus'] * $USER[$resource[$thirdValue].'_level'];
				}elseif($temp[0] == 121){
					$thirdValue	 = 802; //ion
					$thirdValues  = $pricelist[$thirdValue]['arsenal_bonus'] * $USER[$resource[$thirdValue].'_level'];
				}elseif($temp[0] == 122){
					$thirdValue	 = 803; //plasma
					$thirdValues  = $pricelist[$thirdValue]['arsenal_bonus'] * $USER[$resource[$thirdValue].'_level'];
				}elseif($temp[0] == 199){
					$thirdValue	 = 804; //graviton
					$thirdValues  = $pricelist[$thirdValue]['arsenal_bonus'] * $USER[$resource[$thirdValue].'_level'];
				}
				
				
				
				$WRECKSLIST[$temp[0]]	= array(
					'lngid'			=> $pricelist[$elementID]['wapeon_gun'] == 101 ? 'Standard' : $LNG['tech'][$temp[0]],
					'amoutn'		=> pretty_number($wreckAmount[$temp[1]]),
					//MISSING LVL OF TECH TO BE TAKEN IN COUNT LOL
					'amoutn2'		=> $pricelist[$elementID]['wapeon_gun'] == 101 ? "" : pretty_number($wreckAmount[$temp[1]] / 100 * $factorBonus),
					'amoutn3'		=> pretty_number($wreckAmount[$temp[1]] / 100 * $thirdValues),
					'lngid2'		=> $thirdValue == 0 ? '' : $LNG['tech'][$thirdValue],
				);
			}
			$speedTech = 0;
			$speedTech1 = 0;
			if($techSpeed == 1){
				$speedTech1 = 811;
				$speedTech  = $pricelist[$speedTech1]['arsenal_bonus'] * $USER[$resource[$speedTech1].'_level'];
			}elseif($techSpeed == 2){
				$speedTech1 = 812;
				$speedTech  = $pricelist[$speedTech1]['arsenal_bonus'] * $USER[$resource[$speedTech1].'_level'];
			}elseif($techSpeed == 3){
				$speedTech1 = 813;
				$speedTech  = $pricelist[$speedTech1]['arsenal_bonus'] * $USER[$resource[$speedTech1].'_level'];
			}
			
			$arsShield = 0;
			$arsShield1 = 0;
			if($pricelist[$elementID]['type_gun'] == 1){
				$arsShield = 808;
				$arsShield1  = $pricelist[$arsShield]['arsenal_bonus'] * $USER[$resource[$arsShield].'_level'];
			}elseif($pricelist[$elementID]['type_gun'] == 2){
				$arsShield = 809;
				$arsShield1  = $pricelist[$arsShield]['arsenal_bonus'] * $USER[$resource[$arsShield].'_level'];
			}elseif($pricelist[$elementID]['type_gun'] == 3){
				$arsShield = 810;
				$arsShield1  = $pricelist[$arsShield]['arsenal_bonus'] * $USER[$resource[$arsShield].'_level'];
			}
			
			$arsArmor = 0;
			$arsArmor1 = 0;
			if($pricelist[$elementID]['type_gun'] == 1){
				$arsArmor = 805;
				$arsArmor1  = $pricelist[$arsArmor]['arsenal_bonus'] * $USER[$resource[$arsArmor].'_level'];
			}elseif($pricelist[$elementID]['type_gun'] == 2){
				$arsArmor = 806;
				$arsArmor1  = $pricelist[$arsArmor]['arsenal_bonus'] * $USER[$resource[$arsArmor].'_level'];
			}elseif($pricelist[$elementID]['type_gun'] == 3){
				$arsArmor = 807;
				$arsArmor1  = $pricelist[$arsArmor]['arsenal_bonus'] * $USER[$resource[$arsArmor].'_level'];
			}
			$FleetInfo	= array(
				'structure'		=> ($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902])/10,
				'tech'			=> $pricelist[$elementID]['tech'],
				'techSpeed'		=> $techSpeed,
				'arsArmor'		=> pretty_number((($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902])/10) / 100 * $arsArmor1),
				'arsShield'		=> pretty_number($CombatCaps[$elementID]['shield'] / 100 * $arsShield1),
				'speedTech'		=> pretty_number($pricelist[$elementID]['speed'] / 100 * $speedTech),
				'speedTech1'	=> $speedTech1,
				'fleetDit'		=> $WRECKSLIST,
				'fleetDits'		=> $pricelist[$elementID]['wapeon_gun'],
				'attack'		=> $CombatCaps[$elementID]['attack'],
				'shield'		=> $CombatCaps[$elementID]['shield'],
				'capacity'		=> $pricelist[$elementID]['capacity'],
				'type_gun'		=> $pricelist[$elementID]['type_gun'],
				'speed1'		=> $pricelist[$elementID]['speed'],
				'speedBon'		=> (FleetFunctions::GetFleetMaxSpeed($elementID, $USER)) - $pricelist[$elementID]['speed'],
				'speed2'		=> $pricelist[$elementID]['speed2'],
				'consumption1'	=> $pricelist[$elementID]['consumption'] - ($pricelist[$elementID]['consumption'] / 100 * $premium_fuel_comsuption/2) - ($pricelist[$elementID]['consumption'] / 100 * $academy_fuel_comsuption),
				'consumption2'	=> $pricelist[$elementID]['consumption2'] - ($pricelist[$elementID]['consumption2'] / 100 * $premium_fuel_comsuption/2) - ($pricelist[$elementID]['consumption2'] / 100 * $academy_fuel_comsuption),
				'rapidfire'		=> array(
					'from'	=> array(),
					'to'	=> array(),
				),
			);

			$fleetIDs	= array_merge($reslist['fleet'], $reslist['defense']);

			foreach($fleetIDs as $fleetID)
			{
				if (isset($CombatCaps[$elementID]['sd']) && !empty($CombatCaps[$elementID]['sd'][$fleetID])) {
					$FleetInfo['rapidfire']['to'][$fleetID] = $CombatCaps[$elementID]['sd'][$fleetID];
				}

				if (isset($CombatCaps[$fleetID]['sd']) && !empty($CombatCaps[$fleetID]['sd'][$elementID])) {
					$FleetInfo['rapidfire']['from'][$fleetID] = $CombatCaps[$fleetID]['sd'][$elementID];
				}
			}
		}
		elseif (in_array($elementID, $reslist['defense']))
		{
				
			$fleetTyps		= explode(';', $pricelist[$elementID]['wapeon_gun']);

			$WRECKSLIST	= array();
			$fleetAmount	= array();
			$wreckAmount	= array();
			foreach ($fleetTyps as $fleetTyp)
			{			
				if ($pricelist[$elementID]['wapeon_gun'] == 0) continue;
				$temp = explode(':', $fleetTyp);
				if (!isset($fleetAmount[$temp[0]]))
				{
					$wreckAmount[$temp[0]] = "";
				}

				$wreckAmount[$temp[0]] = $temp[0];
				$wreckAmount[$temp[1]] = $temp[1];
				
				$factorBonus = $wreckAmount[$temp[0]] == 199 ? 4 * $USER[$resource[$wreckAmount[$temp[0]]]] : 2 * $USER[$resource[$wreckAmount[$temp[0]]]];
				$thirdValue	 = 0;
				$thirdValues = 0;
				
				if($temp[0] == 120){
					$thirdValue	 = 801;	//laser
					$thirdValues  = $pricelist[$thirdValue]['arsenal_bonus'] * $USER[$resource[$thirdValue].'_level'];
				}elseif($temp[0] == 121){
					$thirdValue	 = 802; //ion
					$thirdValues  = $pricelist[$thirdValue]['arsenal_bonus'] * $USER[$resource[$thirdValue].'_level'];
				}elseif($temp[0] == 122){
					$thirdValue	 = 803; //plasma
					$thirdValues  = $pricelist[$thirdValue]['arsenal_bonus'] * $USER[$resource[$thirdValue].'_level'];
				}elseif($temp[0] == 199){
					$thirdValue	 = 804; //graviton
					$thirdValues  = $pricelist[$thirdValue]['arsenal_bonus'] * $USER[$resource[$thirdValue].'_level'];
				}
				
				
				
				$WRECKSLIST[$temp[0]]	= array(
					'lngid'			=> $pricelist[$elementID]['wapeon_gun'] == 101 ? 'Standard' : $LNG['tech'][$temp[0]],
					'amoutn'		=> pretty_number($wreckAmount[$temp[1]]),
					//MISSING LVL OF TECH TO BE TAKEN IN COUNT LOL
					'amoutn2'		=> $pricelist[$elementID]['wapeon_gun'] == 101 ? "" : pretty_number($wreckAmount[$temp[1]] / 100 * $factorBonus),
					'amoutn3'		=> pretty_number($wreckAmount[$temp[1]] / 100 * $thirdValues),
					'lngid2'		=> $thirdValue == 0 ? '' : $LNG['tech'][$thirdValue],
				);
			}
			
			$arsArmor = 0;
			$arsArmor1 = 0;
			if($pricelist[$elementID]['type_gun'] == 1){
				$arsArmor = 805;
				$arsArmor1  = $pricelist[$arsArmor]['arsenal_bonus'] * $USER[$resource[$arsArmor].'_level'];
			}elseif($pricelist[$elementID]['type_gun'] == 2){
				$arsArmor = 806;
				$arsArmor1  = $pricelist[$arsArmor]['arsenal_bonus'] * $USER[$resource[$arsArmor].'_level'];
			}elseif($pricelist[$elementID]['type_gun'] == 3){
				$arsArmor = 807;
				$arsArmor1  = $pricelist[$arsArmor]['arsenal_bonus'] * $USER[$resource[$arsArmor].'_level'];
			}
			
			$arsShield = 0;
			$arsShield1 = 0;
			if($pricelist[$elementID]['type_gun'] == 1){
				$arsShield = 808;
				$arsShield1  = $pricelist[$arsShield]['arsenal_bonus'] * $USER[$resource[$arsShield].'_level'];
			}elseif($pricelist[$elementID]['type_gun'] == 2){
				$arsShield = 809;
				$arsShield1  = $pricelist[$arsShield]['arsenal_bonus'] * $USER[$resource[$arsShield].'_level'];
			}elseif($pricelist[$elementID]['type_gun'] == 3){
				$arsShield = 810;
				$arsShield1  = $pricelist[$arsShield]['arsenal_bonus'] * $USER[$resource[$arsShield].'_level'];
			}
			
			$FleetInfo	= array(
				'structure'		=> ($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902])/10,
				'attack'		=> $CombatCaps[$elementID]['attack'],
				'arsArmor'		=> pretty_number((($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902])/10) / 100 * $arsArmor1),
				'arsShield'		=> pretty_number($CombatCaps[$elementID]['shield'] / 100 * $arsShield1),
				'shield'		=> $CombatCaps[$elementID]['shield'],
				'fleetDits'		=> $pricelist[$elementID]['wapeon_gun'],
				'type_gun'		=> $pricelist[$elementID]['type_gun'],
				'fleetDit'		=> $WRECKSLIST,
				'rapidfire'		=> array(
					'from'	=> array(),
					'to'	=> array(),
				),
			);

			$fleetIDs	= array_merge($reslist['fleet'], $reslist['defense']);

			foreach($fleetIDs as $fleetID)
			{
				if (isset($CombatCaps[$elementID]['sd']) && !empty($CombatCaps[$elementID]['sd'][$fleetID])) {
					$FleetInfo['rapidfire']['to'][$fleetID] = $CombatCaps[$elementID]['sd'][$fleetID];
				}

				if (isset($CombatCaps[$fleetID]['sd']) && !empty($CombatCaps[$fleetID]['sd'][$elementID])) {
					$FleetInfo['rapidfire']['from'][$fleetID] = $CombatCaps[$fleetID]['sd'][$elementID];
				}
			}
		}

		if($elementID == 43 && $PLANET[$resource[43]] > 0)
		{
			$this->tplObj->loadscript('gate.js');
			$nextTime	= self::getNextJumpWaitTime($PLANET['last_jump_time'], $PLANET['sprungtor']);
			$gateData	= array(
				'nextTime'	=> _date($LNG['php_tdformat'], $nextTime, $USER['timezone']),
				'restTime'	=> max(0, $nextTime - TIMESTAMP),
				'startLink'	=> $PLANET['name'].' '.strip_tags(BuildPlanetAddressLink($PLANET)),
				'gateList' 	=> $this->getTargetGates(),
				'fleetList'	=> $this->getAvailableFleets(),
			);
		}
		elseif($elementID == 44 && $PLANET[$resource[44]] > 0)
		{
			$MissileList	= array(
				502	=> $PLANET[$resource[502]],
				503	=> $PLANET[$resource[503]]
			);
		}

		$this->assign(array(
			'elementID'			=> $elementID,
			'productionTable'	=> $productionTable,
			'CurrentLevel'		=> $CurrentLevel,
			'MissileList'		=> $MissileList,
			'Bonus'				=> BuildFunctions::getAvalibleBonus($elementID),
			'FleetInfo'			=> $FleetInfo,
			'gateData'			=> $gateData,
			'academy_p_b_1_1110'=> $USER['academy_p_b_1_1110'],
		));

		$this->display('page.information.default.tpl');
	}
}