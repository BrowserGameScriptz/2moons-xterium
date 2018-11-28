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
class MissionCaseDestruction extends MissionFunctions implements Mission
{
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}

	function TargetEvent()
	{
		global $resource, $reslist, $pricelist;

		$db				= Database::get();
		$config	= Config::get($this->_fleet['fleet_universe']);
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

		if(!empty($targetPlanet)){
		
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
			$ally_fraction_in_armement		= 0;
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
					$ally_fraction_shields 			= $FRACTIONS['ally_fraction_shields'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_armement 		= $FRACTIONS['ally_fraction_armement'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_in_armement 		= $FRACTIONS['ally_fraction_in_armement'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_in_armor 		= $FRACTIONS['ally_fraction_in_armor'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_in_shields 		= $FRACTIONS['ally_fraction_in_shields'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_defense_restore 	= $FRACTIONS['ally_fraction_defense_restore'] * $ALLIANCE['ally_fraction_level'];
				}
			}
			
			$fleetAttack[$fleetID]['player']['dm_attack']						= $fleetAttack[$fleetID]['player']['dm_attack'];
			$fleetAttack[$fleetID]['player']['dm_attack_level']					= $fleetAttack[$fleetID]['player']['dm_attack_level'];
			$fleetAttack[$fleetID]['player']['dm_defensive']					= $fleetAttack[$fleetID]['player']['dm_defensive'];
			$fleetAttack[$fleetID]['player']['dm_defensive_level']				= $fleetAttack[$fleetID]['player']['dm_defensive_level'];
			$fleetAttack[$fleetID]['player']['rpg_amiral']						= $fleetAttack[$fleetID]['player']['rpg_amiral'];
			$fleetAttack[$fleetID]['player']['combat_exp_level']				= $fleetAttack[$fleetID]['player']['combat_exp_level'];
			$fleetAttack[$fleetID]['player']['academy_p_b_1_1101']				= $fleetAttack[$fleetID]['player']['academy_p_b_1_1101'];
			$fleetAttack[$fleetID]['player']['academy_p_b_1_1102']				= $fleetAttack[$fleetID]['player']['academy_p_b_1_1102'];
			$fleetAttack[$fleetID]['player']['academy_p_b_1_1103']				= $fleetAttack[$fleetID]['player']['academy_p_b_1_1103'];
			$fleetAttack[$fleetID]['player']['academy_p_b_1_1108']				= $fleetAttack[$fleetID]['player']['academy_p_b_1_1108'];
			$fleetAttack[$fleetID]['player']['academy_p_b_1_1109']				= $fleetAttack[$fleetID]['player']['academy_p_b_1_1109'];
			$fleetAttack[$fleetID]['player']['academy_p_b_1_1110']				= $fleetAttack[$fleetID]['player']['academy_p_b_1_1110'];
			$fleetAttack[$fleetID]['player']['academy_p_b_1_1111']				= $fleetAttack[$fleetID]['player']['academy_p_b_1_1111'];
			$fleetAttack[$fleetID]['player']['academy_p_b_1_1113']				= $fleetAttack[$fleetID]['player']['academy_p_b_1_1113'];
			$fleetAttack[$fleetID]['player']['academy_p_b_3_1301']				= $fleetAttack[$fleetID]['player']['academy_p_b_3_1301'];
			$fleetAttack[$fleetID]['player']['academy_p_b_3_1302']				= $fleetAttack[$fleetID]['player']['academy_p_b_3_1302'];
			$fleetAttack[$fleetID]['player']['academy_p_b_3_1303']				= $fleetAttack[$fleetID]['player']['academy_p_b_3_1303'];
			$fleetAttack[$fleetID]['player']['academy_p_b_3_1304']				= $fleetAttack[$fleetID]['player']['academy_p_b_3_1304'];
			$fleetAttack[$fleetID]['player']['academy_p_b_3_1305']				= $fleetAttack[$fleetID]['player']['academy_p_b_3_1305'];
			$fleetAttack[$fleetID]['player']['academy_p_b_3_1306']				= $fleetAttack[$fleetID]['player']['academy_p_b_3_1306'];
			$fleetAttack[$fleetID]['player']['academy_p_b_3_1308']				= $fleetAttack[$fleetID]['player']['academy_p_b_3_1308'];
			$fleetAttack[$fleetID]['player']['academy_p_b_3_1311']				= $fleetAttack[$fleetID]['player']['academy_p_b_3_1311'];
			$fleetAttack[$fleetID]['player']['academy_p_b_3_1312']				= $fleetAttack[$fleetID]['player']['academy_p_b_3_1312'];
			$fleetAttack[$fleetID]['player']['academy_p_b_3_1313']				= $fleetAttack[$fleetID]['player']['academy_p_b_3_1313'];
			$fleetAttack[$fleetID]['player']['academy_p_b_3_1314']				= $fleetAttack[$fleetID]['player']['academy_p_b_3_1314'];
			$fleetAttack[$fleetID]['player']['ally_fraction_armor']				= $ally_fraction_armor;
			$fleetAttack[$fleetID]['player']['ally_fraction_shields']			= $ally_fraction_shields;
			$fleetAttack[$fleetID]['player']['ally_fraction_armement']			= $ally_fraction_armement;
			$fleetAttack[$fleetID]['player']['ally_fraction_in_armement']		= $ally_fraction_in_armement;
			$fleetAttack[$fleetID]['player']['ally_fraction_in_armor']			= $ally_fraction_in_armor;
			$fleetAttack[$fleetID]['player']['ally_fraction_in_shields']		= $ally_fraction_in_shields;
			$fleetAttack[$fleetID]['player']['ally_fraction_defense_restore']	= $ally_fraction_defense_restore;
			$fleetAttack[$fleetID]['player']['BonusAlliance']					= $BonusAlliance;
			//$fleetAttack[$fleetID]['player']['hashallytech']					= $hashallytech;
			$fleetAttack[$fleetID]['player']['factor']							= getFactors($fleetAttack[$fleetID]['player'], 'attack', $this->_fleet['fleet_start_time']);
			$fleetAttack[$fleetID]['fleetDetail']								= $fleetDetail;
			$fleetAttack[$fleetID]['unit']										= FleetFunctions::unserialize($fleetDetail['fleet_array']);
			$userAttack[$fleetAttack[$fleetID]['player']['id']]					= $fleetAttack[$fleetID]['player']['username'];
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
		
		$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$playerInfo	= $db->selectSingle($sql, array(
			':userId'	=> $this->_fleet['fleet_target_owner']
		));
		$ally_fraction_def_debris_d = 0;
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
		}

		foreach($targetFleetsResult as $fleetDetail)
		{
			$fleetID	= $fleetDetail['fleet_id'];

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
			
			$ally_fraction_armor 			= 0;
			$ally_fraction_shields 			= 0;
			$ally_fraction_armement 		= 0;
			$ally_fraction_in_armement 		= 0;
			$ally_fraction_in_armor 		= 0;
			$ally_fraction_in_shields 		= 0;
			$ally_fraction_defense_restore 	= 0;
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
			
			$fleetDefend[$fleetID]['player']['dm_attack']						= $fleetDefend[$fleetID]['player']['dm_attack'];
			$fleetDefend[$fleetID]['player']['dm_attack_level']					= $fleetDefend[$fleetID]['player']['dm_attack_level'];
			$fleetDefend[$fleetID]['player']['dm_defensive']					= $fleetDefend[$fleetID]['player']['dm_defensive'];
			$fleetDefend[$fleetID]['player']['dm_defensive_level']				= $fleetDefend[$fleetID]['player']['dm_defensive_level'];
			$fleetDefend[$fleetID]['player']['rpg_amiral']						= $fleetDefend[$fleetID]['player']['rpg_amiral'];
			$fleetDefend[$fleetID]['player']['combat_exp_level']				= $fleetDefend[$fleetID]['player']['combat_exp_level'];
			$fleetDefend[$fleetID]['player']['academy_p_b_1_1101']				= $fleetDefend[$fleetID]['player']['academy_p_b_1_1101'];
			$fleetDefend[$fleetID]['player']['academy_p_b_1_1102']				= $fleetDefend[$fleetID]['player']['academy_p_b_1_1102'];
			$fleetDefend[$fleetID]['player']['academy_p_b_1_1103']				= $fleetDefend[$fleetID]['player']['academy_p_b_1_1103'];
			$fleetDefend[$fleetID]['player']['academy_p_b_1_1108']				= $fleetDefend[$fleetID]['player']['academy_p_b_1_1108'];
			$fleetDefend[$fleetID]['player']['academy_p_b_1_1109']				= $fleetDefend[$fleetID]['player']['academy_p_b_1_1109'];
			$fleetDefend[$fleetID]['player']['academy_p_b_1_1110']				= $fleetDefend[$fleetID]['player']['academy_p_b_1_1110'];
			$fleetDefend[$fleetID]['player']['academy_p_b_1_1111']				= $fleetDefend[$fleetID]['player']['academy_p_b_1_1111'];
			$fleetDefend[$fleetID]['player']['academy_p_b_1_1113']				= $fleetDefend[$fleetID]['player']['academy_p_b_1_1113'];
			$fleetDefend[$fleetID]['player']['academy_p_b_3_1301']				= $fleetDefend[$fleetID]['player']['academy_p_b_3_1301'];
			$fleetDefend[$fleetID]['player']['academy_p_b_3_1302']				= $fleetDefend[$fleetID]['player']['academy_p_b_3_1302'];
			$fleetDefend[$fleetID]['player']['academy_p_b_3_1303']				= $fleetDefend[$fleetID]['player']['academy_p_b_3_1303'];
			$fleetDefend[$fleetID]['player']['academy_p_b_3_1304']				= $fleetDefend[$fleetID]['player']['academy_p_b_3_1304'];
			$fleetDefend[$fleetID]['player']['academy_p_b_3_1305']				= $fleetDefend[$fleetID]['player']['academy_p_b_3_1305'];
			$fleetDefend[$fleetID]['player']['academy_p_b_3_1306']				= $fleetDefend[$fleetID]['player']['academy_p_b_3_1306'];
			$fleetDefend[$fleetID]['player']['academy_p_b_3_1308']				= $fleetDefend[$fleetID]['player']['academy_p_b_3_1308'];
			$fleetDefend[$fleetID]['player']['academy_p_b_3_1311']				= $fleetDefend[$fleetID]['player']['academy_p_b_3_1311'];
			$fleetDefend[$fleetID]['player']['academy_p_b_3_1312']				= $fleetDefend[$fleetID]['player']['academy_p_b_3_1312'];
			$fleetDefend[$fleetID]['player']['academy_p_b_3_1313']				= $fleetDefend[$fleetID]['player']['academy_p_b_3_1313'];
			$fleetDefend[$fleetID]['player']['academy_p_b_3_1314']				= $fleetDefend[$fleetID]['player']['academy_p_b_3_1314'];
			$fleetDefend[$fleetID]['player']['ally_fraction_armor']				= $ally_fraction_armor;
			$fleetDefend[$fleetID]['player']['ally_fraction_shields']			= $ally_fraction_shields;
			$fleetDefend[$fleetID]['player']['ally_fraction_armement']			= $ally_fraction_armement;
			$fleetDefend[$fleetID]['player']['ally_fraction_in_armement']		= $ally_fraction_in_armement;
			$fleetDefend[$fleetID]['player']['ally_fraction_in_armor']			= $ally_fraction_in_armor;
			$fleetDefend[$fleetID]['player']['ally_fraction_in_shields']		= $ally_fraction_in_shields;
			$fleetDefend[$fleetID]['player']['ally_fraction_defense_restore']	= $ally_fraction_defense_restore;
			$fleetDefend[$fleetID]['player']['BonusAlliance']					= $BonusAlliance;
			//$fleetDefend[$fleetID]['player']['hashallytech']					= $hashallytech;
			$fleetDefend[$fleetID]['player']['factor']							= getFactors($fleetDefend[$fleetID]['player'], 'attack', $this->_fleet['fleet_start_time']);
			$fleetDefend[$fleetID]['fleetDetail']								= $fleetDetail;
			$fleetDefend[$fleetID]['unit']										= FleetFunctions::unserialize($fleetDetail['fleet_array']);
			$userDefend[$fleetDefend[$fleetID]['player']['id']]					= $fleetDefend[$fleetID]['player']['username'];
		}

		unset($targetFleetsResult);

		$BonusAlliance = 0;
		if(!empty($targetUser['ally_id']))
			$BonusAlliance = $ExistAlliance['total_alliance_power']/2;
		
		$fleetDefend[0]['player']									= $targetUser;
		$fleetDefend[0]['player']['factor']							= getFactors($fleetDefend[0]['player'], 'attack', $this->_fleet['fleet_start_time']);
		$fleetDefend[0]['player']['ally_fraction_armor']			= 0;
		$fleetDefend[0]['player']['ally_fraction_shields']			= 0;
		$fleetDefend[0]['player']['ally_fraction_armement']			= 0;
		$fleetDefend[0]['player']['ally_fraction_in_armement']		= 0;
		$fleetDefend[0]['player']['ally_fraction_in_armor']			= 0;
		$fleetDefend[0]['player']['ally_fraction_in_shields']		= 0;
		$fleetDefend[0]['player']['ally_fraction_defense_restore']	= 0;
		$fleetDefend[0]['player']['BonusAlliance']					= $BonusAlliance;
		$fleetDefend[0]['fleetDetail']								= array(
			'fleet_start_galaxy'	=> $targetPlanet['galaxy'],
			'fleet_start_system'	=> $targetPlanet['system'],
			'fleet_start_planet'	=> $targetPlanet['planet'],
			'fleet_start_type'		=> $targetPlanet['planet_type'],
		);

		$fleetDefend[0]['unit']				= array();

		foreach(array_merge($reslist['fleet'], $reslist['defense']) as $elementID)
		{
			if (empty($targetPlanet[$resource[$elementID]])) continue;

			$fleetDefend[0]['unit'][$elementID] = $targetPlanet[$resource[$elementID]];
		}

		$userDefend[$fleetDefend[0]['player']['id']]	= $fleetDefend[0]['player']['username'];

		require_once 'includes/classes/missions/functions/calculateAttack.php';

		$FleetDebrisA 		= mt_rand(30,50)/100;
		$FleetDebrisD 		= mt_rand(30,50)/100;
		$DefDebrisA 		= 0;
		$DefDebrisD 		= 0;
		$combatResult 		= calculateAttack($fleetAttack, $fleetDefend,$FleetDebrisA, $DefDebrisA, $FleetDebrisD, $DefDebrisD);
		
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
			$targetPlanet 	+= $targetDebris;
		}

		foreach($debrisResource as $elementID)
		{
			$debris[$elementID]			= $combatResult['debris']['attacker'][$elementID] + $combatResult['debris']['defender'][$elementID];
			$planetDebris[$elementID]	= $targetPlanet['der_'.$resource[$elementID]] + $debris[$elementID];
		}
		
		$debrisTotal		= array_sum($debris);
		
		$stealResourceInformation4	= (ceil($debrisTotal / $pricelist[209]['capacity']));
		$stealResourceInformation5	= (ceil($debrisTotal / $pricelist[219]['capacity']));
		
		$reportInfo	= array(
			'thisFleet'				=> $this->_fleet,
			'debris'				=> $debris,
			'debris901'				=> $debris[901],
			'debris902'				=> $debris[902],
			'stealResource'			=> $stealResource,
			'additionalInfo1'		=> ($targetPlanet['metal'] + $targetPlanet['crystal'] + $targetPlanet['deuterium']) / 5000,
			'additionalInfo2'		=> ($targetPlanet['metal'] + $targetPlanet['crystal'] + $targetPlanet['deuterium']) / 25000,
			'additionalInfo3'		=> ($targetPlanet['metal'] + $targetPlanet['crystal'] + $targetPlanet['deuterium']) / 400000000,
			'additionalInfo4'		=> $targetPlanet['metal'],
			'additionalInfo5'		=> $targetPlanet['crystal'],
			'additionalInfo6'		=> $targetPlanet['deuterium'],
			'additionalInfo10'		=> $stealResourceInformation4,
			'additionalInfo11'		=> $stealResourceInformation5,
			'moonChance'			=> NULL,
			'moonDestroy'			=> true,
			'moonName'				=> NULL,
			'moonDestroyChance'		=> NULL,
			'moonDestroySuccess'	=> NULL,
			'fleetDestroyChance'	=> NULL,
			'fleetDestroySuccess'	=> false,
		);

		switch($combatResult['won'])
		{
			case "a":
			
				$prem = 1;		
				if($targetUser['prem_moon_dextruct'] > 0 && $targetUser['prem_moon_dextruct_days'] > TIMESTAMP){		
					$prem = $targetUser['prem_moon_dextruct'];		
				}
				$moonDestroyChance	= round((100 - sqrt($targetPlanet['diameter'])) * ($fleetAttack[$this->_fleet['fleet_id']]['unit'][214]/2), 1)*0.002;
				$moonDestroyChance	= $moonDestroyChance / $prem;

				// Max 100% | Min 0%
				$moonDestroyChance	= min($moonDestroyChance, 100);
				//$moonDestroyChance	= max($moonDestroyChance, 0);
				$moonDestroyChance	= max(0, min($moonDestroyChance, 50));

				$randChance	= mt_rand(1, 100);
				if ($randChance <= $moonDestroyChance)
				{
					$sql		= 'SELECT id FROM %%PLANETS%% WHERE id_luna = :moonId;';
					$planetID	= $db->selectSingle($sql, array(
						':moonId'	=> $targetPlanet['id']
					), 'id');


					$sql		= 'UPDATE %%FLEETS%% SET
					fleet_start_type		= 1,
					fleet_start_id			= :planetId
					WHERE fleet_start_id	= :moonId;';

					$db->update($sql, array(
						':planetId'	=> $planetID,
						':moonId'	=> $targetPlanet['id']
					));

					$sql		= 'UPDATE %%FLEETS%% SET
					fleet_end_type	= 1,
					fleet_end_id	= :moonId,
					fleet_mission	= IF(fleet_mission = 9, 1, fleet_mission)
					WHERE fleet_end_id = :planetId
					AND fleet_id != :fleetId;';

					$db->update($sql, array(
						':planetId'	=> $planetID,
						':moonId'	=> $targetPlanet['id'],
						':fleetId'	=> $this->_fleet['fleet_id']
					));

					$sql = "UPDATE %%AKS%% SET target = :planetId WHERE target = :moonId;";
					$db->update($sql, array(
						':planetId'	=> $planetID,
						':moonId'	=> $targetPlanet['id']
					));

					PlayerUtil::deletePlanet($targetPlanet['id']);
				
					if($targetUser['onlinetime'] > TIMESTAMP - 24 * 3600 * 7){
						$Achievements = achievementMoonDestroy($ownerUser);
						tournement($this->_fleet['fleet_owner'], 3, 1);
					}

					$reportInfo['moonDestroySuccess'] = 1;
				} else {
					$reportInfo['moonDestroySuccess'] = 0;
				}

				$fleetDestroyChance	= round(sqrt($targetPlanet['diameter']) / 2);

				$randChance	= mt_rand(1, 100);
				if ($randChance <= $fleetDestroyChance)
				{
					$this->KillFleet();
					$reportInfo['fleetDestroySuccess'] = true;
				}
				else
				{
					$reportInfo['fleetDestroySuccess'] = false;
				}


				$reportInfo['moonDestroyChance']	= $moonDestroyChance;
				$reportInfo['fleetDestroyChance']	= $fleetDestroyChance;

				// Win
				$attackStatus	= 'wons';
				$defendStatus	= 'loos';
				$class			= array('raportWin', 'raportLose');
				$attackClass	= 'green';
				$defendClass	= 'red';
				break;
			case "r":
				// Lose
				$attackStatus	= 'loos';
				$defendStatus	= 'wons';
				$class			= array('raportLose', 'raportWin');
				$attackClass	= 'red';
				$defendClass	= 'green';
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
	
		require_once 'includes/classes/missions/functions/GenerateReport.php';
		$reportData	= GenerateReport($combatResult, $reportInfo);

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
				
				$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
				$ownerUser = Database::get()->selectSingle($sql, array(
					':userId'	=> $userID
				));
									
				$RaiderAchiev 		= succesDailyAchievement($userID, $ownerUser, $targetUser, $combatResult, $i+1);
				$FigherAchiev 		= succesFighterAchievement($userID, $ownerUser, $targetUser, $combatResult, $i+1, $attackClass);
				$Achievements 		= calculateCombatExp($userID, $totalAttackers, $totalDefenders, $combatResult, $ownerUser, $targetUser, $i+1);
				
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
				
				PlayerUtil::sendMessage($userID, 0, $LNG['sys_mess_tower'], 3, $LNG['sys_mess_attack_report'].' - '.sprintf($LNG['sys_adress_planet'],$this->_fleet['fleet_end_galaxy'],$this->_fleet['fleet_end_system'],$this->_fleet['fleet_end_planet']).' - ['.pretty_number($combatResult['unitLost']['attacker']-$combatResult['unitLost']['defender']).']', $message, $this->_fleet['fleet_start_time'], NULL, 1, $this->_fleet['fleet_universe']);

				$AllyTags = "";
				if($ownerUser['ally_id'] != 0){
					$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
					$ALLIANCE = Database::get()->selectSingle($sql, array(
						':allyID'	=> $ownerUser['ally_id']
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

		if($this->_fleet['fleet_end_type'] == 3)
		{
			$debrisType	= 'id_luna';
		}
		else
		{
			$debrisType	= 'id';
		}

		$sql = 'UPDATE %%PLANETS%% SET
		der_metal	= :metal,
		der_crystal	= :crystal
		WHERE '.$debrisType.' = :planetId;';

		$db->update($sql, array(
			':metal'	=> $planetDebris[901],
			':crystal'	=> $planetDebris[902],
			':planetId'	=> $this->_fleet['fleet_end_id']
		));

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
		'.$attackStatus.' = '.$attackStatus.' + 1,
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
		'.$defendStatus.' = '.$defendStatus.' + 1,
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
	}
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
			pretty_number($this->_fleet['fleet_resource_metal']), $LNG['tech'][901],
			pretty_number($this->_fleet['fleet_resource_crystal']), $LNG['tech'][902],
			pretty_number($this->_fleet['fleet_resource_deuterium']), $LNG['tech'][903]
		);

		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 4, $LNG['sys_mess_fleetback'],
			$Message, $this->_fleet['fleet_end_time'], NULL, 1, $this->_fleet['fleet_universe']);

		$this->RestoreFleet();
	}
}