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

require_once 'includes/classes/missions/functions/achievementFunction.php';
require_once 'includes/classes/missions/functions/calculateHonorPoints.php';
class MissionCaseAttack extends MissionFunctions implements Mission
{
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{	
		global $resource, $reslist, $pricelist;

		$db				= Database::get();
		$config			= Config::get($this->_fleet['fleet_universe']);

		
		$fleetAttack	= array();
		$fleetDefend	= array();
		
		$userAttack		= array();
		$userDefend		= array();

		$incomingFleets	= array();

		$stealResource	= array(
			901	=> 0,
			902	=> 0,
			903	=> 0,
		);
		
		$debris			= array();
		$planetDebris	= array();
		
		$debrisResource	= array(901, 902);
		
		$messageHTML	= <<<HTML
		<a href="CombatReport.php?raport=%s" class="a_batle_msg_more" target="_blank"><img alt="" src="./styles/images/iconav/search.png"> %s</a>
		<font color="%s">%s %s</font>
		<br><br>
		<font color="%s">%s: %s</font><br>
		<font color="%s">%s: %s</font><br>
		<br>%s %s: <font color="#a47d7a">%s</font> %s: <font color="#5ca6aa">%s</font> %s: <font color="#339966">%s</font>
		<br>%s %s: <font color="#a47d7a">%s</font> %s: <font color="#5ca6aa">%s</font>
		<br>
HTML;
		//Minize HTML
		$messageHTML	= str_replace(array("\n", "\t", "\r"), "", $messageHTML);

		$sql			= "SELECT * FROM %%PLANETS%% WHERE id = :planetId;";
		$targetPlanet 	= $db->selectSingle($sql, array(
			':planetId'	=> $this->_fleet['fleet_end_id']
		));
		
		
		if(empty($targetPlanet)){
			$this->setState(FLEET_RETURN);
			$this->SaveFleet();
			return false;
		}

		$sql			= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$targetUser		= $db->selectSingle($sql, array(
			':userId'	=> $targetPlanet['id_owner']
		));
		
		$sql			= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$ownerUser		= $db->selectSingle($sql, array(
			':userId'	=> $this->_fleet['fleet_owner']
		));
		
		$targetUser['factor']	= getFactors($targetUser, 'basic', $this->_fleet['fleet_start_time']);

		$planetUpdater	= new ResourceUpdate();
		
		list($targetUser, $targetPlanet)	= $planetUpdater->CalcResource($targetUser, $targetPlanet, true, $this->_fleet['fleet_start_time']);
		
		if($this->_fleet['fleet_group'] != 0)
		{
			$sql	= "DELETE FROM %%AKS%% WHERE id = :acsId;";
			$db->delete($sql, array(
				':acsId'	=> $this->_fleet['fleet_group'],
			));

			$sql	= "SELECT * FROM %%FLEETS%% WHERE fleet_group = :acsId;";

			$incomingFleetsResult = $db->select($sql, array(
				':acsId'	=> $this->_fleet['fleet_group'],
			));
		
			foreach($incomingFleetsResult as $incomingFleetRow)
			{
				$incomingFleets[$incomingFleetRow['fleet_id']] = $incomingFleetRow;
			}
			
			unset($incomingFleetsResult);
		}
		else
		{
			$incomingFleets = array($this->_fleet['fleet_id'] => $this->_fleet);
		}
		
		$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$playerInfo	= $db->selectSingle($sql, array(
			':userId'	=> $this->_fleet['fleet_owner']
		));
		
		$ally_fraction_def_debris_a = 0;
		
		if($playerInfo['ally_id'] != 0){
			$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
			$ALLIANCE = Database::get()->selectSingle($sql, array(
				':allyID'	=> $playerInfo['ally_id']
			));
			
			if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
				$FRACTIONS = Database::get()->selectSingle($sql, array(
				':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
				));
				$ally_fraction_def_debris_a = $FRACTIONS['ally_fraction_def_debris'] * $ALLIANCE['ally_fraction_level'];
			}
		}
		
		$fleetPointsAttacker 		= 0;
		$fleetPointsAttackerHonor 	= 0;
		foreach($incomingFleets as $fleetID => $fleetDetail)
		{
			$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
			$fleetAttack[$fleetID]['player']	= $db->selectSingle($sql, array(
				':userId'	=> $fleetDetail['fleet_owner']
			));
			
			$sql	= 'SELECT total_alliance_power FROM %%ALLIANCE%% WHERE id = :allyId;';
			$ExistAlliance = database::get()->selectSingle($sql, array(
				':allyId'	=> $fleetAttack[$fleetID]['player']['ally_id']
			));
			
			$BonusAlliance = 0;
			if(!empty($ExistAlliance))
				$BonusAlliance = $ExistAlliance['total_alliance_power']/2;
			
			$ally_fraction_armor 			= 0;
			$ally_fraction_shields 			= 0;
			$ally_fraction_armement 		= 0;
			$ally_fraction_in_armement 		= 0;
			$ally_fraction_in_armor 		= 0;
			$ally_fraction_in_shields 		= 0;
			$ally_fraction_defense_restore 	= 0;
			
			if($fleetAttack[$fleetID]['player']['ally_id'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
				$ALLIANCE = Database::get()->selectSingle($sql, array(
					':allyID'	=> $fleetAttack[$fleetID]['player']['ally_id']
				));
				
				if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
					$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
					$FRACTIONS = Database::get()->selectSingle($sql, array(
						':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
					));
					
					$ally_fraction_armor 			= $FRACTIONS['ally_fraction_armor'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_shields			= $FRACTIONS['ally_fraction_shields'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_armement 		= $FRACTIONS['ally_fraction_armement'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_in_armement 		= $FRACTIONS['ally_fraction_in_armement'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_in_armor 		= $FRACTIONS['ally_fraction_in_armor'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_in_shields 		= $FRACTIONS['ally_fraction_in_shields'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_defense_restore 	= $FRACTIONS['ally_fraction_defense_restore'] * $ALLIANCE['ally_fraction_level'];
				}
			}
			
			
			$fleetAttack[$fleetID]['player']									= $fleetAttack[$fleetID]['player'];
			$fleetAttack[$fleetID]['player']['ally_fraction_armor']				= $ally_fraction_armor;
			$fleetAttack[$fleetID]['player']['ally_fraction_shields']			= $ally_fraction_shields;
			$fleetAttack[$fleetID]['player']['ally_fraction_armement']			= $ally_fraction_armement;
			$fleetAttack[$fleetID]['player']['ally_fraction_in_armement']		= $ally_fraction_in_armement;
			$fleetAttack[$fleetID]['player']['ally_fraction_in_armor']			= $ally_fraction_in_armor;
			$fleetAttack[$fleetID]['player']['ally_fraction_in_shields']		= $ally_fraction_in_shields;
			$fleetAttack[$fleetID]['player']['ally_fraction_defense_restore']	= $ally_fraction_defense_restore;
			$fleetAttack[$fleetID]['player']['factor']							= getFactors($fleetAttack[$fleetID]['player'], 'attack', $this->_fleet['fleet_start_time']);
			$fleetAttack[$fleetID]['fleetDetail']								= $fleetDetail;
			$fleetAttack[$fleetID]['unit']										= FleetFunctions::unserialize($fleetDetail['fleet_array']);
			$fleetAttack[$fleetID]['player']['BonusAlliance']					= $BonusAlliance;
			$fleetPointArray['unit']											= array_filter($fleetAttack[$fleetID]['unit']);
			
			$elementPlanetBattle	= array(204,205,229,206,207,215,213,211,224,225,226,214,216,227,230,228,222,218,221);
			
			foreach ($fleetPointArray['unit'] as $elementID => $amount)
			{				
				$fleetPointsAttacker   += ($amount * ($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902])) / 1000000;
				
				if(in_array($elementID, $elementPlanetBattle))
					$fleetPointsAttackerHonor   += ($amount * ($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902])) / 1000000;
			}
			
			$userAttack[$fleetAttack[$fleetID]['player']['id']]	= $fleetAttack[$fleetID]['player']['username'];
		}
 
		$sql	= "SELECT * FROM %%FLEETS%%
		WHERE fleet_mission		= :mission
		AND fleet_end_id		= :fleetEndId
		AND fleet_start_time 	<= :timeStamp
		AND fleet_end_stay 		>= :timeStamp;";

		$targetFleetsResult = $db->select($sql, array(
			':mission'		=> 5,
			':fleetEndId'	=> $this->_fleet['fleet_end_id'],
			':timeStamp'	=> TIMESTAMP
		));
		
		$fleetPointsDefender = 0;
		$fleetPointsDefenderHonor = 0;
		$totalWreckefender = 0;
		foreach($targetFleetsResult as $fleetDetail)
		{
			$fleetID	= $fleetDetail['fleet_id'];
			$totalWreckefender += 1;
			
			$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
			$fleetDefend[$fleetID]['player']			= $db->selectSingle($sql, array(
				':userId'	=> $fleetDetail['fleet_owner']
			));
			
			$sql	= 'SELECT total_alliance_power FROM %%ALLIANCE%% WHERE id = :allyId;';
			$ExistAlliance = database::get()->selectSingle($sql, array(
				':allyId'	=> $fleetDefend[$fleetID]['player']['ally_id']
			));
			
			$BonusAlliance = 0;
			if(!empty($ExistAlliance))
				$BonusAlliance = $ExistAlliance['total_alliance_power']/2;
			
			$ally_fraction_armor 				= 0;
			$ally_fraction_shields 				= 0;
			$ally_fraction_armement 			= 0;
			$ally_fraction_in_armement 			= 0;
			$ally_fraction_in_armor 			= 0;
			$ally_fraction_in_shields		 	= 0;
			$ally_fraction_defense_restore 		= 0;
			if($fleetDefend[$fleetID]['player']['ally_id'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
				$ALLIANCE = Database::get()->selectSingle($sql, array(
					':allyID'	=> $fleetDefend[$fleetID]['player']['ally_id']
				));
				
				if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
					$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
					$FRACTIONS = Database::get()->selectSingle($sql, array(
						':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
					));
					
					$ally_fraction_armor 			= $FRACTIONS['ally_fraction_armor'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_shields 			= $FRACTIONS['ally_fraction_shields'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_armement 		= $FRACTIONS['ally_fraction_armement'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_in_armement 		= $FRACTIONS['ally_fraction_in_armement'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_in_armor 		= $FRACTIONS['ally_fraction_in_armor'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_in_shields 		= $FRACTIONS['ally_fraction_in_shields'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_defense_restore 	= $FRACTIONS['ally_fraction_defense_restore'] * $ALLIANCE['ally_fraction_level'];
				}
			}

			$fleetDefend[$fleetID]['player']									= $fleetDefend[$fleetID]['player'];
			$fleetDefend[$fleetID]['player']['ally_fraction_armor']				= $ally_fraction_armor;
			$fleetDefend[$fleetID]['player']['ally_fraction_shields']			= $ally_fraction_shields;
			$fleetDefend[$fleetID]['player']['ally_fraction_armement']			= $ally_fraction_armement;
			$fleetDefend[$fleetID]['player']['ally_fraction_in_armement']		= $ally_fraction_in_armement;
			$fleetDefend[$fleetID]['player']['ally_fraction_in_armor']			= $ally_fraction_in_armor;
			$fleetDefend[$fleetID]['player']['ally_fraction_in_shields']		= $ally_fraction_in_shields;
			$fleetDefend[$fleetID]['player']['ally_fraction_defense_restore']	= $ally_fraction_defense_restore;
			$fleetDefend[$fleetID]['player']['factor']							= getFactors($fleetDefend[$fleetID]['player'], 'attack', $this->_fleet['fleet_start_time']);
			$fleetDefend[$fleetID]['fleetDetail']								= $fleetDetail;
			$fleetDefend[$fleetID]['unit']										= FleetFunctions::unserialize($fleetDetail['fleet_array']);
			$fleetDefend[$fleetID]['player']['BonusAlliance']					= $BonusAlliance;
			$fleetPointArray['unit']											= array_filter($fleetDefend[$fleetID]['unit']);
			$elementPlanetBattle	= array(204,205,229,206,207,215,213,211,224,225,226,214,216,227,230,228,222,218,221);	
			foreach ($fleetPointArray['unit'] as $elementID => $amount)
			{				
				$fleetPointsDefender   += ($amount * ($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902])) / 1000000;
				
				if(in_array($elementID, $elementPlanetBattle))
					$fleetPointsDefenderHonor   += ($amount * ($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902])) / 1000000;
			}
			
			$userDefend[$fleetDefend[$fleetID]['player']['id']]	= $fleetDefend[$fleetID]['player']['username'];
		}
			
		unset($targetFleetsResult);
		
		
		$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$playerInfo	= $db->selectSingle($sql, array(
			':userId'	=> $this->_fleet['fleet_target_owner']
		));
		$ally_fraction_def_debris_d = 0;
		$BonusAlliance 				= 0;
		if($playerInfo['ally_id'] != 0){
			$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
			$ALLIANCE = Database::get()->selectSingle($sql, array(
				':allyID'	=> $playerInfo['ally_id']
			));
			
			if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
				$FRACTIONS = Database::get()->selectSingle($sql, array(
					':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
				));
				$ally_fraction_def_debris_d = $FRACTIONS['ally_fraction_def_debris'] * $ALLIANCE['ally_fraction_level'];
			}
			
			$BonusAlliance = $ALLIANCE['total_alliance_power']/2;
		}
		
			
		$fleetDefend[0]['player']									= $targetUser;
		$fleetDefend[0]['player']['factor']							= getFactors($fleetDefend[0]['player'], 'attack', $this->_fleet['fleet_start_time']);
		$fleetDefend[0]['player']['ally_fraction_armor']			= $ally_fraction_armor;
		$fleetDefend[0]['player']['ally_fraction_shields']			= $ally_fraction_shields;
		$fleetDefend[0]['player']['ally_fraction_armement']			= $ally_fraction_armement;
		$fleetDefend[0]['player']['ally_fraction_in_armement']		= $ally_fraction_in_armement;
		$fleetDefend[0]['player']['ally_fraction_in_armor']			= $ally_fraction_in_armor;
		$fleetDefend[0]['player']['ally_fraction_in_shields']		= $ally_fraction_in_shields;
		$fleetDefend[0]['player']['ally_fraction_defense_restore']	= $ally_fraction_defense_restore;
		$fleetDefend[0]['player']['BonusAlliance']					= $BonusAlliance;
		$fleetDefend[0]['fleetDetail']								= array(
			'fleet_start_galaxy'	=> $targetPlanet['galaxy'], 
			'fleet_start_system'	=> $targetPlanet['system'], 
			'fleet_start_planet'	=> $targetPlanet['planet'], 
			'fleet_start_type'		=> $targetPlanet['planet_type'], 
		);
		
		$fleetDefend[0]['unit']				= array();
		$elementPlanetBattle	= array(204,205,229,206,207,215,213,211,224,225,226,214,216,227,230,228,222,218,221);	
		foreach(array_merge($reslist['fleet'], $reslist['defense']) as $elementID)
		{
			if (empty($targetPlanet[$resource[$elementID]])) continue;
			
			$fleetRepairId = array(202,203,204,205,206,207,209,211,213,214,215,216,217,218,219,221,222,224,225,226,227,228,229,230);
			
			if(in_array($elementID,$fleetRepairId))
				$fleetPointsDefender   += ($targetPlanet[$resource[$elementID]] * ($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902])) / 1000000;
				
			if(in_array($elementID, $elementPlanetBattle))
				$fleetPointsDefenderHonor   += ($amount * ($pricelist[$elementID]['cost'][901] + $pricelist[$elementID]['cost'][902])) / 1000000;
			
			if($elementID == 208 || $elementID == 210 || $elementID == 220 || $elementID == 223) continue;			
			$fleetDefend[0]['unit'][$elementID] = $targetPlanet[$resource[$elementID]];
		}
			
		$userDefend[$fleetDefend[0]['player']['id']]	= $fleetDefend[0]['player']['username'];
		
		require_once 'includes/classes/missions/functions/calculateAttack.php';

		$FleetDebrisA 	= 0.5;
		$FleetDebrisD 	= 0;
		$DefDebrisA 	= 0;
		$DefDebrisD 	= 0;
		$combatResult 	= calculateAttack($fleetAttack, $fleetDefend,$FleetDebrisA, $DefDebrisA, $FleetDebrisD, $DefDebrisD, 0);
					
		$totalAttackers = 0;
		foreach ($fleetAttack as $fleetID => $fleetDetail)
		{
			$fleetArray = '';
			$totalCount = 0;
			
			$fleetDetail['unit']	= array_filter($fleetDetail['unit']);
			foreach ($fleetDetail['unit'] as $elementID => $amount)
			{				
				$fleetArray .= $elementID.','.floattostring($amount).';';
				$totalCount += $amount;
			}
			
			if($totalCount == 0)
			{
				if($this->_fleet['fleet_id'] == $fleetID)
				{
					$this->KillFleet();
				}
				else
				{
					$sql	= 'DELETE %%FLEETS%%, %%FLEETS_EVENT%%
					FROM %%FLEETS%%
					INNER JOIN %%FLEETS_EVENT%% ON fleetID = fleet_id
					WHERE fleet_id = :fleetId;';

					$db->delete($sql, array(
						':fleetId'	=> $fleetID
					));
				}
				
				$sql	= 'UPDATE %%LOG_FLEETS%% SET fleet_state = :fleetState WHERE fleet_id = :fleetId;';
				$db->update($sql, array(
					':fleetId'		=> $fleetID,
					':fleetState'	=> FLEET_HOLD,
				));

				unset($fleetAttack[$fleetID]);
			}
			elseif($totalCount > 0)
			{
				$sql = "UPDATE %%FLEETS%% fleet, %%LOG_FLEETS%% log SET
				fleet.fleet_array	= :fleetData,
				fleet.fleet_amount	= :fleetCount,
				log.fleet_array		= :fleetData,
				log.fleet_amount	= :fleetCount
				WHERE fleet.fleet_id = :fleetId AND log.fleet_id = :fleetId;";

				$db->update($sql, array(
					':fleetData'	=> substr($fleetArray, 0, -1),
					':fleetCount'	=> $totalCount,
					':fleetId'		=> $fleetID
			  	));
			}
			else
			{
				throw new OutOfRangeException("Negative Fleet amount ....");
			}
			$totalAttackers++;
		}
		$totalDefenders = 0;
		foreach ($fleetDefend as $fleetID => $fleetDetail)
		{
			if($fleetID != 0)
			{
				// Stay fleet
				$fleetArray = '';
				$totalCount = 0;
				
				$fleetDetail['unit']	= array_filter($fleetDetail['unit']);
				
				foreach ($fleetDetail['unit'] as $elementID => $amount)
				{				
					$fleetArray .= $elementID.','.floattostring($amount).';';
					$totalCount += $amount;
				}
				
				if($totalCount == 0)
				{
					$sql	= 'DELETE %%FLEETS%%, %%FLEETS_EVENT%%
					FROM %%FLEETS%%
					INNER JOIN %%FLEETS_EVENT%% ON fleetID = fleet_id
					WHERE fleet_id = :fleetId;';

					$db->delete($sql, array(
						':fleetId'	=> $fleetID
					));

					$sql	= 'UPDATE %%LOG_FLEETS%% SET fleet_state = :fleetState WHERE fleet_id = :fleetId;';
					$db->update($sql, array(
						':fleetId'		=> $fleetID,
						':fleetState'	=> FLEET_HOLD,
					));

					unset($fleetAttack[$fleetID]);
				}
				elseif($totalCount > 0)
				{
					$sql = "UPDATE %%FLEETS%% fleet, %%LOG_FLEETS%% log SET
					fleet.fleet_array	= :fleetData,
					fleet.fleet_amount	= :fleetCount,
					log.fleet_array		= :fleetData,
					log.fleet_amount	= :fleetCount
					WHERE fleet.fleet_id = :fleetId AND log.fleet_id = :fleetId;";

					$db->update($sql, array(
	   					':fleetData'	=> substr($fleetArray, 0, -1),
						':fleetCount'	=> $totalCount,
						':fleetId'		=> $fleetID
					));
				}
				else
				{
					throw new OutOfRangeException("Negative Fleet amount ....");
				}
			}
			else
			{
				$params	= array(':planetId' => $this->_fleet['fleet_end_id']);

				// Planet fleet
				$fleetArray = array();
				foreach ($fleetDetail['unit'] as $elementID => $amount)
				{				
					$fleetArray[] = '`'.$resource[$elementID].'` = :'.$resource[$elementID];
					$params[':'.$resource[$elementID]]	= $amount;
				}
				
				if(!empty($fleetArray))
				{
					$sql = 'UPDATE %%PLANETS%% SET '.implode(', ', $fleetArray).' WHERE id = :planetId;';
					$db->update($sql, $params);
				}
			}
			$totalDefenders++;
		}
		
		if ($combatResult['won'] == "a")
		{
			require_once 'includes/classes/missions/functions/calculateSteal.php';
			$stealResource = calculateSteal($fleetAttack, $targetPlanet);
		}
		
		if($this->_fleet['fleet_end_type'] == 3)
		{
			// Use planet debris, if attack on moons
			$sql			= "SELECT der_metal, der_crystal FROM %%PLANETS%% WHERE id_luna = :moonId;";
			$targetDebris	= $db->selectSingle($sql, array(
				':moonId'	=> $this->_fleet['fleet_end_id']
			));
			
			foreach($debrisResource as $elementID)
			{
				$debris[$elementID]			= $combatResult['debris']['attacker'][$elementID] + $combatResult['debris']['defender'][$elementID];
				$planetDebris[$elementID]	= $targetDebris['der_'.$resource[$elementID]] + $debris[$elementID];
			}
		}else{
			foreach($debrisResource as $elementID)
			{
				$debris[$elementID]			= $combatResult['debris']['attacker'][$elementID] + $combatResult['debris']['defender'][$elementID];
				$planetDebris[$elementID]	= $targetPlanet['der_'.$resource[$elementID]] + $debris[$elementID];
			}
		}
		
		
		$debrisTotal		= array_sum($debris);
		
		$moonFactor			= $config->moon_factor;
		$maxMoonChance		= $config->moon_chance;
		
		if($targetPlanet['id_luna'] == 0 && $targetPlanet['planet_type'] == 1 && $targetPlanet['gal6mod'] == 0)
		{
			$chanceCreateMoon	= round($debrisTotal / 100000000 * $moonFactor);
			$chanceCreateMoon	= min($chanceCreateMoon, $maxMoonChance);
		}
		else
		{
			$chanceCreateMoon	= 0;
		}
		
		$db	= Database::get();
		$sql	= 'SELECT * FROM %%USERS%% WHERE id = :fleetOwnId;';
		$search_b = $db->selectSingle($sql, array(
			':fleetOwnId'	=> $this->_fleet['fleet_target_owner']
		));
		
		$premium_moon_crea = 0;		
		if($search_b['prem_moon_creat'] > 0 && $search_b['prem_moon_creat_days'] > TIMESTAMP){		
			$premium_moon_crea = $search_b['prem_moon_creat'];		
		} 
		
		$stealResourceInformation4	= (ceil($debrisTotal / $pricelist[209]['capacity']));
		$stealResourceInformation5	= (ceil($debrisTotal / $pricelist[219]['capacity']));
		
		if($this->_fleet['fleet_end_type'] == 3)
		{
			$debrisType	= 'id_luna';
		}
		else
		{
			$debrisType	= 'id';
		}
		
		$sql = 'UPDATE %%PLANETS%% SET
		der_metal	= der_metal + :metal,
		der_crystal	= der_crystal + :crystal
		WHERE '.$debrisType.' = :planetId;';

		$db->update($sql, array(
			':metal'	=> $debris[901],
			':crystal'	=> $debris[902],
			':planetId'	=> $this->_fleet['fleet_end_id']
		));
		
		$reportInfo	= array(
			'thisFleet'				=> $this->_fleet,
			'debris'				=> $debris,
			'debris901'				=> $debris[901],
			'debris902'				=> $debris[902],
			'stealResource'			=> $stealResource,
			'moonChance'			=> $chanceCreateMoon + round($chanceCreateMoon / 100 * $premium_moon_crea),
			'additionalInfo1'		=> ($targetPlanet['metal'] + $targetPlanet['crystal'] + $targetPlanet['deuterium'])/2 / 5000,
			'additionalInfo2'		=> ($targetPlanet['metal'] + $targetPlanet['crystal'] + $targetPlanet['deuterium'])/2 / 25000,
			'additionalInfo3'		=> ($targetPlanet['metal'] + $targetPlanet['crystal'] + $targetPlanet['deuterium'])/2 / 400000000,
			'additionalInfo4'		=> $targetPlanet['metal']/2,
			'additionalInfo5'		=> $targetPlanet['crystal']/2,
			'additionalInfo6'		=> $targetPlanet['deuterium']/2,
			'additionalInfo10'		=> $stealResourceInformation4,
			'additionalInfo11'		=> $stealResourceInformation5,
			'moonDestroy'			=> false,
			'moonName'				=> NULL,
			'moonDestroyChance'		=> NULL,
			'moonDestroySuccess'	=> NULL,
			'fleetDestroyChance'	=> NULL,
			'fleetDestroySuccess'	=> NULL,
		);
		
		$randChance	= mt_rand(1, 100);
		if ($randChance <= $chanceCreateMoon + round($chanceCreateMoon/ 100 * $premium_moon_crea))
		{
			$LNG					= $this->getLanguage($targetUser['lang']);
			$reportInfo['moonName']	= $LNG['type_planet'][3];
			PlayerUtil::createMoon(
				$this->_fleet['fleet_universe'],
				$this->_fleet['fleet_end_galaxy'],
				$this->_fleet['fleet_end_system'],
				$this->_fleet['fleet_end_planet'],
				$targetUser['id'],
				$chanceCreateMoon
			);
			
			if(Config::get($this->_fleet['fleet_universe'])->debris_moon == 1)
			{
				foreach($debrisResource as $elementID)
				{
					$planetDebris[$elementID]	= 0;
				}
			}
			//Achievement Create Moon
			$Achievements = achievementMoonCreate($ownerUser);
		}
		
		//Alliance Development Points
		if($ownerUser['ally_id'] != 0 && $targetUser['ally_id'] != 0 && $ownerUser['ally_id'] != $targetUser['ally_id'])
			$succesAlliancePoints = succesAlliancePoints($ownerUser, $targetUser, $combatResult);
		
		require_once 'includes/classes/missions/functions/GenerateReport.php';
		$reportData	= GenerateReport($combatResult, $reportInfo);
		
		switch($combatResult['won'])
		{
			case "a":
				// Win
				$attackStatus		= 'wons';
				$defendStatus		= 'loos';
				$class				= array('raportWin', 'raportLose');
				$attackClass		= 'green';
				$defendClass		= 'red';
				break;
			case "r":
				// Lose
				$attackStatus		= 'loos';
				$defendStatus		= 'wons';
				$class				= array('raportLose', 'raportWin');
				$attackClass		= 'red';
				$defendClass		= 'green';
				break;
			case "w":
			default:
				// Draw
				$attackStatus	= 'draws';
				$defendStatus	= 'draws';
				$class			= array('raportDraw', 'raportDraw');
				$attackClass	= 'orange';
				$defendClass	= 'orange';
				break;
		}
		
		$reportID	= md5(uniqid('', true).TIMESTAMP);
		
		$sql	= 'INSERT INTO %%RW%% SET
		rid 		= :reportId,
		raport 		= :reportData,
		time 		= :time,
		attacker	= :attackers,
		defender	= :defenders;';

		$db->insert($sql, array(
			':reportId'		=> $reportID,
			':reportData'	=> serialize($reportData),
			':time'			=> $this->_fleet['fleet_start_time'],
			':attackers'	=> implode(',', array_keys($userAttack)),
			':defenders'	=> implode(',', array_keys($userDefend))
		));
		
		$WOGDOCK = $targetPlanet['xterium_dock'];
		if($this->_fleet['fleet_end_type'] == 3){
			$sql	= 'SELECT xterium_dock FROM %%PLANETS%% WHERE galaxy = :galaxy AND system = :system AND planet = :planet AND planet_type = 1;';
			$wogInfo	= database::get()->selectSingle($sql, array(
				':galaxy'	=> $this->_fleet['fleet_end_galaxy'],
				':system'	=> $this->_fleet['fleet_end_system'],
				':planet'	=> $this->_fleet['fleet_end_planet'],
			));
			$WOGDOCK = $wogInfo['xterium_dock'];
		}
		if($WOGDOCK >= 1 && $totalWreckefender == 0){
			require_once 'includes/classes/missions/functions/calculateRepairArray.php';
			$dockArray = calculateRepairArray($reportID, $totalWreckefender, $targetUser, $fleetPointsDefender, $FleetDebrisA, $targetPlanet);
		}
		
		$i = 0;
		foreach(array($userAttack, $userDefend) as $data)
		{
			$thisClass	= $class[$i];
			foreach($data as $userID => $userName)
			{
				$LNG		= $this->getLanguage(NULL, $userID);
				
				$message	= sprintf($messageHTML,
					$reportID,
					$LNG['view_combat_report'],
					$attackClass,
					$LNG['sys_mess_attack_report'],
					sprintf(
						$LNG['sys_adress_planet'],
						$this->_fleet['fleet_end_galaxy'],
						$this->_fleet['fleet_end_system'],
						$this->_fleet['fleet_end_planet']
					),
					$attackClass,
					$LNG['sys_lost_attacker'],
					pretty_number($combatResult['unitLost']['attacker']),
					$defendClass,
					$LNG['sys_lost_defender'],
					pretty_number($combatResult['unitLost']['defender']),
					$LNG['sys_gain'],
					$LNG['tech'][901],
					pretty_number($stealResource[901]),
					$LNG['tech'][902],
					pretty_number($stealResource[902]), 
					$LNG['tech'][903],
					pretty_number($stealResource[903]),
					$LNG['sys_debris'],
					$LNG['tech'][901],
					pretty_number($debris[901]), 
					$LNG['tech'][902],
					pretty_number($debris[902])
				);
									
				$RaiderAchiev 		= succesDailyAchievement($userID, $ownerUser, $targetUser, $combatResult, $i+1);
				$FigherAchiev 		= succesFighterAchievement($userID, $ownerUser, $targetUser, $combatResult, $i+1, $attackClass);
				$Achievements 		= calculateCombatExp($userID, $totalAttackers, $totalDefenders, $combatResult, $ownerUser, $targetUser, $i+1);
				$honorPoints 		= calculateHonorPoints($combatResult, $this->_fleet, $ownerUser, $targetUser, $fleetPointsAttackerHonor, $fleetPointsDefenderHonor, $totalDefenders);
				
				if($i == 0)
					tournement($userID, 2, round($combatResult['unitLost']['defender'] / $totalAttackers));
				elseif($i == 1)
					tournement($userID, 2, round($combatResult['unitLost']['attacker'] / $totalDefenders));
					
				if($Achievements >= 1){
					$message .= '<br>Obtained '.pretty_number($Achievements).' combat experience';
				}
				
				if($RaiderAchiev){
					$message .= '<br>Obtained 1 raider success';
				}
				
				if($FigherAchiev){
					$message .= '<br>Obtained 1 fighter success';
				}
				
				if($i == 0 && $honorPoints['attackRecovered'] != 0){
					if($honorPoints['attackRecovered'] < 0)
						$message .= '<br>you lost '.pretty_number(abs($honorPoints['attackRecovered'])).' honor points';
					elseif($honorPoints['attackRecovered'] > 0)
						$message .= '<br>you won '.pretty_number($honorPoints['attackRecovered']).' honor points';
				}elseif($i == 1 && $honorPoints['defendRecovered'] != 0){
					if($honorPoints['defendRecovered'] < 0)
						$message .= '<br>you lost '.pretty_number(abs($honorPoints['defendRecovered'])).' honor points';
					elseif($honorPoints['defendRecovered'] > 0)
						$message .= '<br>you won '.pretty_number($honorPoints['defendRecovered']).' honor points';
				}
				
				
				PlayerUtil::sendMessage($userID, 0, $LNG['sys_mess_tower'], 3, $LNG['sys_mess_attack_report'].' - '.sprintf($LNG['sys_adress_planet'],$this->_fleet['fleet_end_galaxy'],$this->_fleet['fleet_end_system'],$this->_fleet['fleet_end_planet']).' - ['.pretty_number($combatResult['unitLost']['attacker']-$combatResult['unitLost']['defender']).']', $message, $this->_fleet['fleet_start_time'], NULL, 1, $this->_fleet['fleet_universe']);
			
				$AllyTags = "";
				if($search_b['ally_id'] != 0){
					$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
					$ALLIANCE = Database::get()->selectSingle($sql, array(
						':allyID'	=> $search_b['ally_id']
					));
					$AllyTags = $ALLIANCE['ally_tag'];
				}
				
				$sql	= "SELECT username, customNick FROM %%USERS%% WHERE id = :userID;";
				$userNameCombat = $db->selectSingle($sql, array(
						':userID'	=> $userID
				));
			
				$sql	= "INSERT INTO %%TOPKB_USERS%% SET
					rid			= :reportId,
					role		= :userRole,
					username	= :username,
					allyId		= :allyId,
					uid			= :userId;";

				$db->insert($sql, array(
					':reportId'	=> $reportID,
					':userRole'	=> $i + 1,
					':username'	=> empty($userNameCombat['customNick']) ? $userNameCombat['username'] : $userNameCombat['customNick'],
					':allyId'	=> $AllyTags,
					':userId'	=> $userID
				));
			}
			$i++;
		}
		
		$sql = 'UPDATE %%PLANETS%% SET
			metal		= metal - :metal,
			crystal		= crystal - :crystal,
			deuterium	= deuterium - :deuterium
			WHERE id = :planetId;';

		$db->update($sql, array(
			':metal'		=> $stealResource[901],
			':crystal'		=> $stealResource[902],
			':deuterium'	=> $stealResource[903],
			':planetId'		=> $this->_fleet['fleet_end_id']
		));

		$sql = 'INSERT INTO %%TOPKB%% SET
			units 		= :units,
			rid			= :reportId,
			time		= :time,
			universe	= :universe,
			result		= :result;';

		$db->insert($sql, array(
			':units'	=> $combatResult['unitLost']['attacker'] + $combatResult['unitLost']['defender'],
			':reportId'	=> $reportID,
			':time'		=> $this->_fleet['fleet_start_time'],
			':universe'	=> $this->_fleet['fleet_universe'],
			':result'	=> $combatResult['won']
		));

		$sql = 'UPDATE %%USERS%% SET
			`'.$attackStatus.'` = `'.$attackStatus.'` + 1,
			kbmetal		= kbmetal + :debrisMetal,
			kbcrystal	= kbcrystal + :debrisCrystal,
			lostunits	= lostunits + :lostUnits,
			desunits	= desunits + :destroyedUnits
			WHERE id IN ('.implode(',', array_keys($userAttack)).');';

		$db->update($sql, array(
			':debrisMetal'		=> $debris[901],
			':debrisCrystal'	=> $debris[902],
			':lostUnits'		=> $combatResult['unitLost']['attacker'],
			':destroyedUnits'	=> $combatResult['unitLost']['defender']
	  	));
		
		$sql = 'UPDATE %%USERS%% SET
			`'.$defendStatus.'` = `'.$defendStatus.'` + 1,
			kbmetal		= kbmetal + :debrisMetal,
			kbcrystal	= kbcrystal + :debrisCrystal,
			lostunits	= lostunits + :lostUnits,
			desunits	= desunits + :destroyedUnits
			WHERE id IN ('.implode(',', array_keys($userDefend)).');';

		$db->update($sql, array(
			':debrisMetal'		=> $debris[901],
			':debrisCrystal'	=> $debris[902],
			':lostUnits'		=> $combatResult['unitLost']['defender'],
			':destroyedUnits'	=> $combatResult['unitLost']['attacker']
		));

		$this->setState(FLEET_RETURN);
		$this->SaveFleet();
	}
	
	function EndStayEvent()
	{
		return;
	}
	
	function ReturnEvent()
	{
		$LNG		= $this->getLanguage(NULL, $this->_fleet['fleet_owner']);

		$sql		= 'SELECT name FROM %%PLANETS%% WHERE id = :planetId;';
		$planetName	= Database::get()->selectSingle($sql, array(
			':planetId'	=> $this->_fleet['fleet_start_id'],
		), 'name');

		$Message	= sprintf(
			$LNG['sys_fleet_won'],
			$planetName,
			GetTargetAddressLink($this->_fleet, ''),
			pretty_number($this->_fleet['fleet_resource_metal']),
			$LNG['tech'][901],
			pretty_number($this->_fleet['fleet_resource_crystal']),
			$LNG['tech'][902],
			pretty_number($this->_fleet['fleet_resource_deuterium']),
			$LNG['tech'][903]
		);

		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 3, $LNG['sys_mess_fleetback'], $Message, $this->_fleet['fleet_end_time'], NULL, 1, $this->_fleet['fleet_universe']);

		$this->RestoreFleet();
	}
}