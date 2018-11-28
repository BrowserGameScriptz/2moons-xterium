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

class ShowFleetStep3Page extends AbstractGamePage
{
	public static $requireModule = MODULE_FLEET_TABLE;

	function __construct() 
	{
		parent::__construct();
	}
	
	public function show()
	{
		global $USER, $PLANET, $resource, $LNG;
				
		$maxwave			= HTTP::_GP('maxwave', 1);
		$targetMission 		= HTTP::_GP('mission', 3);
		$misionOK 			= array(1,15,17,18);
		$missionOkPro		= array(3,4,7,8,11,16,17,18,25,26);
		
		if (IsVacationMode($USER) || $USER['protectionTimer'] >= TIMESTAMP && !in_array($targetMission, $missionOkPro)) {
			FleetFunctions::GotoFleetPage(0);
		}
		
		if(!in_array($targetMission, $misionOK)){
			$maxwave = 1;	
		}
		
		
		for($i = 1; $i <= $maxwave; $i++)
		{
			$targetMission 			= HTTP::_GP('mission', 3);
			$TransportMetal			= max(0, round(HTTP::_GP('metal', 0.0)));
			$TransportCrystal		= max(0, round(HTTP::_GP('crystal', 0.0)));
			$TransportDeuterium		= max(0, round(HTTP::_GP('deuterium', 0.0)));
			$stayTime 				= HTTP::_GP('staytime', 0);
			$token					= HTTP::_GP('token', '');
			$sector					= $targetMission == 17 ? HTTP::_GP('sectors', 1) : 0;
			$allowedSector			= array(1,2,3,5,6);
			
			if(!in_array($sector, $allowedSector))
				$sector	= 1;
			
			$config					= Config::get();

			if (!isset($_SESSION['fleet'][$token])) {
				FleetFunctions::GotoFleetPage(1);
			}
			
			if (!isset($_SESSION['fleet'][$token]['planetStart'])) {
				PlayerUtil::sendMessage(1, '', 'Russian video error', 4, 'Hack System', 'The player '.$USER['username'].' tryed to use the russian video bug', TIMESTAMP);
				unset($_SESSION['fleet'][$token]);
				FleetFunctions::GotoFleetPage(1);
			}
			
			if($_SESSION['fleet'][$token]['planetStart'] != $PLANET['id']){
				PlayerUtil::sendMessage(1, '', 'Russian video error', 4, 'Hack System', 'The player '.$USER['username'].' tryed to use the russian video bug', TIMESTAMP);
				unset($_SESSION['fleet'][$token]);
				FleetFunctions::GotoFleetPage(1);
			}
				
			if ($_SESSION['fleet'][$token]['time'] < TIMESTAMP - 600) {
				unset($_SESSION['fleet'][$token]);
				FleetFunctions::GotoFleetPage(0);
			}
			
			$formData		= $_SESSION['fleet'][$token];
			//unset($_SESSION['fleet'][$token]);
			
			$keys = array('distance','targetGalaxy','targetSystem','targetPlanet','targetType','fleetGroup','fleet','fleetRoom','fleetSpeed');
			foreach ($keys as $key) {
				if(!array_key_exists($key, $formData)){
					unset($_SESSION['fleet'][$token]);
					FleetFunctions::GotoFleetPage(0);
				}
			}

			$distance		= $formData['distance'];
			$targetGalaxy	= $formData['targetGalaxy'];
			$targetSystem	= $formData['targetSystem'];
			$targetPlanet	= $formData['targetPlanet'];
			$targetType		= $formData['targetType'];
			$fleetGroup		= $formData['fleetGroup'];
			$fleetArray  	= $formData['fleet'];
			$fleetStorage	= $formData['fleetRoom'];
			$fleetSpeed		= $formData['fleetSpeed'];
			
			if($targetMission != 2)
			{
				$fleetGroup	= 0;
			}
				
			if ($PLANET['galaxy'] == $targetGalaxy && $PLANET['system'] == $targetSystem && $PLANET['planet'] == $targetPlanet && $PLANET['planet_type'] == $targetType)
			{
				$this->printMessage($LNG['fl_error_same_planet'], true, array('game.php?page=fleetTable', 2));
			} 

			if ($targetMission == 25)
			{
				$sql = "SELECT id, id_owner, der_metal, der_crystal, isAlliancePlanet, destruyed, ally_deposit, gal6mod FROM %%PLANETS%% WHERE universe = :universe AND galaxy = :targetGalaxy AND system = :targetSystem AND planet = :targetPlanet AND planet_type = :targetType;";
				$targetPlanetData = database::get()->selectSingle($sql, array(
					':universe'     => Universe::current(),
					':targetGalaxy' => $targetGalaxy,
					':targetSystem' => $targetSystem,
					':targetPlanet' => $targetPlanet,
					':targetType' => 1,
				));
			}else{
				$sql = "SELECT id, id_owner, der_metal, der_crystal, isAlliancePlanet, destruyed, ally_deposit, gal6mod FROM %%PLANETS%% WHERE universe = :universe AND galaxy = :targetGalaxy AND system = :targetSystem AND planet = :targetPlanet AND planet_type = :targetType;";
				$targetPlanetData = database::get()->selectSingle($sql, array(
					':universe'     => Universe::current(),
					':targetGalaxy' => $targetGalaxy,
					':targetSystem' => $targetSystem,
					':targetPlanet' => $targetPlanet,
					':targetType' => ($targetType == 2 ? 1 : $targetType),
				));
			}
			
			if($targetPlanetData['gal6mod'] == 0){
				if ($targetGalaxy < 1 || $targetGalaxy > $config->max_galaxy || 
					$targetSystem < 1 || $targetSystem > $config->max_system || 
					$targetPlanet < 1 || $targetPlanet > ($config->max_planets + 2) ||
					($targetType !== 1 && $targetType !== 2 && $targetType !== 3)) {
					$this->printMessage($LNG['fl_invalid_target'], true, array('game.php?page=fleetTable', 2));
				}
			}elseif($targetPlanetData['gal6mod'] == 1){
				if ($targetGalaxy < 1 || $targetGalaxy > $config->max_galaxy || 
					$targetSystem < 1 || $targetSystem > 500 || 
					$targetPlanet < 1 || $targetPlanet > ($config->max_planets) ||
					($targetType !== 1 && $targetType !== 2 && $targetType !== 3)) {
					$this->printMessage($LNG['fl_invalid_target'], true, array('game.php?page=fleetTable', 2));
				}
			}
			
			if($targetPlanetData['isAlliancePlanet'] != $USER['ally_id'] && $targetMission == 5 && $USER['ally_id'] != 0 && $targetPlanetData['isAlliancePlanet'] != 0){
				$this->printMessage($LNG['sensorMsg3'], true, array('game.php?page=fleetTable', 2));
				exit();
			}

			if($targetPlanetData['isAlliancePlanet'] == $USER['ally_id'] && $targetMission != 5 && $USER['ally_id'] != 0){
				$this->printMessage($LNG['sensorMsg4'], true, array('game.php?page=fleetTable', 2));
				exit();
			}elseif ($targetMission == 3 && $TransportMetal + $TransportCrystal + $TransportDeuterium < 1)
			{
				$this->printMessage($LNG['fl_no_noresource'], true, array('game.php?page=fleetTable', 2));
			}elseif($targetMission == 5 && $TransportMetal + $TransportCrystal + $TransportDeuterium > 0 && $targetPlanetData['isAlliancePlanet'] != 0){
				$this->printMessage($LNG['sensorMsg5'], true, array('game.php?page=fleetTable', 2));
				exit();
			}
			
			$ActualFleets		= FleetFunctions::GetCurrentFleets($USER['id']);
			
			if (FleetFunctions::GetMaxFleetSlots($USER) <= $ActualFleets)
			{
				$this->printMessage($LNG['fl_no_slots'], true, array('game.php?page=fleetTable', 2));
			}
			
			$ACSTime = 0;

			$db = Database::get();

			if(!empty($fleetGroup))
			{
				$sql = "SELECT ankunft FROM %%USERS_ACS%% INNER JOIN %%AKS%% ON id = acsID
				WHERE acsID = :acsID AND :maxFleets > (SELECT COUNT(*) FROM %%FLEETS%% WHERE fleet_group = :acsID);";
				$ACSTime = $db->selectSingle($sql, array(
					':acsID'        => $fleetGroup,
					':maxFleets'    => $config->max_fleets_per_acs,
				), 'ankunft');

				if (empty($ACSTime)) {
					$fleetGroup	= 0;
					$targetMission	= 1;
				}
			}
			
			if ($targetMission == 25)
			{
				$sql = "SELECT id, id_owner, der_metal, der_crystal, destruyed, ally_deposit, gal6mod, isAlliancePlanet FROM %%PLANETS%% WHERE universe = :universe AND galaxy = :targetGalaxy AND system = :targetSystem AND planet = :targetPlanet AND planet_type = :targetType;";
				$targetPlanetData = $db->selectSingle($sql, array(
					':universe'     => Universe::current(),
					':targetGalaxy' => $targetGalaxy,
					':targetSystem' => $targetSystem,
					':targetPlanet' => $targetPlanet,
					':targetType' => 1,
				));
			}else{
				$sql = "SELECT id, id_owner, der_metal, der_crystal, destruyed, ally_deposit, gal6mod, isAlliancePlanet FROM %%PLANETS%% WHERE universe = :universe AND galaxy = :targetGalaxy AND system = :targetSystem AND planet = :targetPlanet AND planet_type = :targetType;";
				$targetPlanetData = $db->selectSingle($sql, array(
					':universe'     => Universe::current(),
					':targetGalaxy' => $targetGalaxy,
					':targetSystem' => $targetSystem,
					':targetPlanet' => $targetPlanet,
					':targetType' => ($targetType == 2 ? 1 : $targetType),
				));
			}

			$sql =  "SELECT sender, owner FROM %%BUDDY%% WHERE (sender = :userID AND owner = :targetId AND buddyType = 1 AND isAccepted = 1) OR (owner = :userID AND sender = :targetId AND buddyType = 1 AND isAccepted = 1);";
			$Friends = database::get()->selectSingle($sql, array(
				':userID'			=> $USER['id'],
				':targetId'			=> $targetPlanetData['id_owner']
			));
			
			if ($targetMission == 7)
			{
				if (!empty($targetPlanetData)) {
					$this->printMessage($LNG['fl_target_exists'], true, array('game.php?page=fleetTable', 2));
					
				}
				
				if ($targetType != 1 && $targetMission == 7) {
					$this->printMessage($LNG['fl_only_planets_colonizable'], true, array('game.php?page=fleetTable', 2));
				}
			}
			
			if ($targetMission == 7 || $targetMission == 15 || $targetMission == 18 || $targetMission == 16 || $targetMission == 17 || $targetMission == 26)
			{
				$targetPlanetData	= array('id' => 0, 'id_owner' => 0, 'planettype' => 1, 'der_metal' => 0, 'der_crystal' => 0, 'gal6mod' => 0);
			}
			elseif ($targetMission == 6 && $targetPlanetData['gal6mod'] == 1)
			{
				$targetPlanetData	= array('id' => $targetPlanetData['id'], 'id_owner' => 0, 'planettype' => 1, 'der_metal' => $targetPlanetData['der_metal'], 'der_crystal' => $targetPlanetData['der_crystal'], 'gal6mod' => $targetPlanetData['gal6mod']);
			}
			elseif ($targetMission == 25 && empty($targetPlanetData['id_owner']) && $targetPlanetData['gal6mod'] == 1)
			{
				$targetPlanetData	= array('id' => $targetPlanetData['id'], 'id_owner' => 0, 'planettype' => 1, 'der_metal' => $targetPlanetData['der_metal'], 'der_crystal' => $targetPlanetData['der_crystal'], 'gal6mod' => $targetPlanetData['gal6mod']);
			}
			else
			{
				if ($targetPlanetData["destruyed"] != 0) {
					$this->printMessage($LNG['fl_no_target'], true, array('game.php?page=fleetTable', 2));
				}
					
				if (empty($targetPlanetData)) {
					$this->printMessage($LNG['fl_no_target'], true, array('game.php?page=fleetTable', 2));
				}
			}
			
			$db = Database::get();
			$sql	= "SELECT * FROM %%PLANETS%% WHERE id = :planetId;";
			$PLANETING	= $db->selectSingle($sql, array(
				':planetId'	=> $PLANET['id'],
			));
			
			if ($targetMission == 11)
			{
				$activeExpedition	= FleetFunctions::GetCurrentFleets($USER['id'], 11, true);
				$maxExpedition		= FleetFunctions::getDMMissionLimit($USER);

				if ($activeExpedition >= $maxExpedition) {
					$this->printMessage($LNG['fl_no_expedition_slot'], true, array('game.php?page=fleetTable', 2));
				}
			}
			elseif ($targetMission == 15)
			{		
				$activeExpedition	= FleetFunctions::GetCurrentFleets($USER['id'], 15, true);
				$maxExpedition		= FleetFunctions::getExpeditionLimit($USER);
				$premium_expe_slots = 0;
				if($USER['prem_count_expiditeon'] > 0 && $USER['prem_count_expiditeon_days'] > TIMESTAMP){
				$premium_expe_slots = $USER['prem_count_expiditeon'];
				}

				$getGalaxySevenAccount = getGalaxySevenAccount($USER);
				$getGalaxySevenAccount = $getGalaxySevenAccount['simExpe'];
				
				if ($activeExpedition >= $maxExpedition + $premium_expe_slots + $getGalaxySevenAccount) {
					$this->printMessage($LNG['fl_no_expedition_slot'], true, array('game.php?page=fleetTable', 2));
				}
			}
			elseif ($targetMission == 18)
			{		
				$activeExpedition	= FleetFunctions::GetCurrentFleets($USER['id'], 17, true);
				$activeExpedition	+= FleetFunctions::GetCurrentFleets($USER['id'], 18, true);
				$maxExpedition		= FleetFunctions::getExpeditionLimit($USER);
				$premium_expe_slots = 0;
				if($USER['prem_count_expiditeon'] > 0 && $USER['prem_count_expiditeon_days'] > TIMESTAMP){
				$premium_expe_slots = $USER['prem_count_expiditeon'];
				}

				$getGalaxySevenAccount = getGalaxySevenAccount($USER);
				$getGalaxySevenAccount = $getGalaxySevenAccount['simExpe'];
				
				if ($activeExpedition >= $maxExpedition + $premium_expe_slots + $getGalaxySevenAccount) {
					$this->printMessage($LNG['fl_no_expedition_slot'], true, array('game.php?page=fleetTable', 2));
				}
			}
			elseif ($targetMission == 17)
			{		
				$activeExpedition	= FleetFunctions::GetCurrentFleets($USER['id'], 17, true);
				$activeExpedition	+= FleetFunctions::GetCurrentFleets($USER['id'], 18, true);
				$maxExpedition		= FleetFunctions::getExpeditionLimit($USER);
				$premium_expe_slots = 0;
				if($USER['prem_count_expiditeon'] > 0 && $USER['prem_count_expiditeon_days'] > TIMESTAMP){
				$premium_expe_slots = $USER['prem_count_expiditeon'];
				}

				$getGalaxySevenAccount = getGalaxySevenAccount($USER);
				$getGalaxySevenAccount = $getGalaxySevenAccount['simExpe'];
				
				if ($activeExpedition >= $maxExpedition + $premium_expe_slots + $getGalaxySevenAccount) {
					$this->printMessage($LNG['fl_no_expedition_slot'], true, array('game.php?page=fleetTable', 2));
				}
			}
			elseif ($targetMission == 16)
			{
			
				$activeAsteroids	= FleetFunctions::GetCurrentFleets($USER['id'], 16, true);
				$maxAsteroids		= floor(4 + floor($USER['asteroid_mine_tech'] / 5));

				if ($activeAsteroids >= $maxAsteroids) {
					$this->printMessage($LNG['fl_no_asteroid_slot'], true, array('game.php?page=fleetTable', 2));
				}
			}
			elseif ($targetMission == 25)
			{
			
				$activeAsteroids	= FleetFunctions::GetCurrentFleets($USER['id'], 25, true);
				$maxAsteroids		= 3;

				if ($activeAsteroids >= $maxAsteroids) {
					$this->printMessage('You are limitted to 3 slots to capture planets', true, array('game.php?page=fleetTable', 2));
				}
			}
			
			$recyclers = 0;
			$lightf = 0;
			$battsh = 0;
			$heavycar = 0;
			$heavyf = 0;
			$crui = 0;
			$bcrui = 0;
			$brecy = 0;
			
			foreach ($fleetArray as $Ship => $Count)
			{
			
				if ($Count > $PLANETING[$resource[$Ship]] && $targetMission == 18) {
					$this->printMessage('Waves send:'.($i - 1), true, array('game.php?page=fleetTable', 2));
				}elseif ($Count > $PLANETING[$resource[$Ship]] && $targetMission == 1) {
					$this->printMessage('Waves send:'.($i - 1), true, array('game.php?page=fleetTable', 2));
				}elseif ($Count > $PLANETING[$resource[$Ship]] && $targetMission == 17) {
					$this->printMessage('Waves send:'.($i - 1), true, array('game.php?page=fleetTable', 2));
				}elseif ($Count > $PLANETING[$resource[$Ship]]){
					$this->printMessage($LNG['fl_not_all_ship_avalible'], true, array('game.php?page=fleetTable', 2));
				}
				
				if($Ship == 204){$lightf = $lightf + $Count;}
				elseif($Ship == 203){$heavycar = $heavycar + $Count;}
				elseif($Ship == 207){$battsh = $battsh + $Count;}
				elseif($Ship == 205){$heavyf = $heavyf + $Count;}
				elseif($Ship == 209){$recyclers = $recyclers + $Count;}
				elseif($Ship == 206){$crui = $crui + $Count;}
				elseif($Ship == 215){$bcrui = $bcrui + $Count;}
				elseif($Ship == 219){$brecy = $brecy + $Count;}
			}
			
			if($USER['tutorial'] == 56 && $lightf >= 10000 && $battsh >= 1500 && $heavycar >= 1000 && $recyclers >= 10 && $targetMission >= 15){
				$db = Database::get();
				$sql =  "UPDATE %%USERS%% SET
				tutorial				= 57
				WHERE id = :userID;";
				$db->update($sql, array(
				':userID'			=> $USER['id']
				));
			}
			if($USER['tutorial'] == 60 && $lightf >= 150000 && $battsh >= 10000 && $heavyf >= 25000 && $crui >= 50000 && $bcrui >= 3500 && $brecy >= 25 && $targetMission >= 17){
				$db = Database::get();
				$sql =  "UPDATE %%USERS%% SET
				tutorial				= 61
				WHERE id = :userID;";
				$db->update($sql, array(
				':userID'			=> $USER['id']
				));
			}

			$usedPlanet	= isset($targetPlanetData['id_owner']);
			$myPlanet	= $usedPlanet && $targetPlanetData['id_owner'] == $USER['id'];
			$targetPlayerData	= array();

			if($targetMission == 7 || $targetMission == 15 || $targetMission == 18 || $targetMission == 16 || $targetMission == 17 || $targetMission == 26) {
				$targetPlayerData	= array(
					'id'				=> 0,
					'onlinetime'		=> TIMESTAMP,
					'ally_id'			=> 0,
					'urlaubs_modus'		=> 0,
					'authattack'		=> 0,
					'total_points'		=> 0,
					'defs_points'		=> 0,
					'fleet_points'		=> 0,
					'gal6mod'			=> 0,
				);
			} elseif($targetMission == 6 && $targetPlanetData['gal6mod'] == 1) {
				$targetPlayerData	= array(
					'id'				=> 0,
					'onlinetime'		=> TIMESTAMP,
					'ally_id'			=> 0,
					'urlaubs_modus'		=> 0,
					'authattack'		=> 0,
					'total_points'		=> 0,
					'defs_points'		=> 0,
					'fleet_points'		=> 0,
					'gal6mod'			=> $targetPlanetData['gal6mod'],
				);
			} elseif($targetMission == 25 && $targetPlanetData['gal6mod'] == 1 && empty($targetPlanetData['id_owner'])) {
				$targetPlayerData	= array(
					'id'				=> 0,
					'onlinetime'		=> TIMESTAMP,
					'ally_id'			=> 0,
					'urlaubs_modus'		=> 0,
					'authattack'		=> 0,
					'total_points'		=> 0,
					'defs_points'		=> 0,
					'fleet_points'		=> 0,
					'gal6mod'			=> $targetPlanetData['gal6mod'],
				);
			} elseif($myPlanet) {
				$targetPlayerData	= $USER;
			} elseif(!empty($targetPlanetData['id_owner'])) {
				$sql = "SELECT user.id, user.onlinetime, user.ally_id, user.outlaw, user.urlaubs_modus, user.banaday, user.authattack, user.lastAlly, user.lastAllyTime,
					stat.total_points, stat.defs_points, stat.fleet_points
					FROM %%USERS%% as user
					LEFT JOIN %%STATPOINTS%% as stat ON stat.id_owner = user.id AND stat.stat_type = '1'
					WHERE user.id = :ownerID;";

				$targetPlayerData = $db->selectSingle($sql, array(
					':ownerID'  => $targetPlanetData['id_owner']
				));
			}

			if(empty($targetPlayerData))
			{
				$this->printMessage($LNG['fl_empty_target'], true, array('game.php?page=fleetTable', 2));
			}
			
			$MisInfo		     	= array();		
			$MisInfo['galaxy']     	= $targetGalaxy;		
			$MisInfo['system'] 	  	= $targetSystem;	
			$MisInfo['planet'] 	  	= $targetPlanet;		
			$MisInfo['planettype'] 	= $targetType;	
			$MisInfo['IsAKS']		= $fleetGroup;
			$MisInfo['Ship'] 		= $fleetArray;		
			
			$availableMissions		= FleetFunctions::GetFleetMissions($USER, $MisInfo, $targetPlanetData, $PLANET);
			
			if (!in_array($targetMission, $availableMissions['MissionSelector'])) {
				$this->printMessage($LNG['fl_invalid_mission'], true, array('game.php?page=fleetTable', 2));
			}
			
			if ($targetMission != 8 && $targetMission != 25 && IsVacationMode($targetPlayerData)) {
				$this->printMessage($LNG['fl_target_exists'], true, array('game.php?page=fleetTable', 2));
			}
				
			if (($targetMission == 1 && $targetPlayerData['ally_id'] == $USER['lastAlly'] && $USER['lastAllyTime'] > TIMESTAMP && $USER['lastAlly'] != 1) || ($targetMission == 2 && $targetPlayerData['ally_id'] == $USER['lastAlly'] && $USER['lastAllyTime'] > TIMESTAMP && $USER['lastAlly'] != 1)) {
				$this->printMessage($LNG['fl_target_old_ally'], true, array('game.php?page=fleetTable', 2));
			}
			
			if (($targetMission == 1 && $targetPlayerData['ally_id'] == $USER['ally_id'] && $USER['ally_id'] > 1 && $targetPlayerData['onlinetime'] > (TIMESTAMP - 7*24*3600) ) || ($targetMission == 2 && $targetPlayerData['ally_id'] == $USER['ally_id'] && $USER['ally_id'] > 1 && $targetPlayerData['onlinetime'] > (TIMESTAMP - 7*24*3600))) {
				$this->printMessage('You can not attack your alliance members.', true, array('game.php?page=fleetTable', 2));
			}
			
			$BashActive = 1;
			$sql = "SELECT * FROM %%DIPLO%% WHERE (owner_1 = :owner_1 AND owner_2 = :owner_2 AND level = 5 && accept = 1) OR (owner_1 = :owner_2 AND owner_2 = :owner_1 AND level = 5 && accept = 1);";
			$isDiplo = $db->selectSingle($sql, array(
				':owner_1'     => $USER['ally_id'],
				':owner_2' => $targetPlayerData['ally_id'],
			));
			
			if($targetMission == 1 && !$isDiplo && $targetPlanetData['isAlliancePlanet'] != 0){
				$this->printMessage('Attack on the planet of the alliance is possible only at war', true, array('game.php?page=fleetTable', 2));
				exit();
			}
			
			if($targetMission == 1 && !$isDiplo && $targetPlayerData['onlinetime'] > (TIMESTAMP - 7*24*3600) || $targetMission == 2 && !$isDiplo && $targetPlayerData['onlinetime'] > (TIMESTAMP - 7*24*3600) || $targetMission == 9 && !$isDiplo && $targetPlayerData['onlinetime'] > (TIMESTAMP - 7*24*3600)) {
				//ATTACK PART
				$totalAttacksBASH = 0;
				$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%LOG_FLEETS%% WHERE fleet_owner = :fleetOwner AND fleet_end_id = :fleetEndId AND fleet_state != :fleetState AND fleet_start_time > :fleetStartTime 	AND fleet_mission = 1;';
				$totalAttacksBASH	= Database::get()->selectSingle($sql, array(
					':fleetOwner'		=> $USER['id'],
					':fleetEndId'		=> $targetPlanetData['id'],
					':fleetState'		=> 2,
					':fleetStartTime'	=> (TIMESTAMP - BASH_TIME)
				), 'fleet_id');
				if($totalAttacksBASH != 0){
					$totalAttacksBASH = $totalAttacksBASH;	
				}
				
				$totalAttacksBASHb = 0;
				$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%LOG_FLEETS%% WHERE fleet_owner = :fleetOwner AND fleet_end_id = :fleetEndId AND fleet_state != :fleetState AND fleet_start_time > :fleetStartTime 	AND fleet_mission = 2;';
				$totalAttacksBASHb	= Database::get()->selectSingle($sql, array(
					':fleetOwner'		=> $USER['id'],
					':fleetEndId'		=> $targetPlanetData['id'],
					':fleetState'		=> 2,
					':fleetStartTime'	=> (TIMESTAMP - BASH_TIME)
				), 'fleet_id');
				if($totalAttacksBASHb != 0){
					$totalAttacksBASHb = $totalAttacksBASHb;	
				}
				
				$totalAttacksBASHx = 0;
				$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%LOG_FLEETS%% WHERE fleet_owner = :fleetOwner AND fleet_end_id = :fleetEndId AND fleet_state != :fleetState AND fleet_start_time > :fleetStartTime 	AND fleet_mission = 9;';
				$totalAttacksBASHx	= Database::get()->selectSingle($sql, array(
					':fleetOwner'		=> $USER['id'],
					':fleetEndId'		=> $targetPlanetData['id'],
					':fleetState'		=> 2,
					':fleetStartTime'	=> (TIMESTAMP - BASH_TIME)
				), 'fleet_id');
				if($totalAttacksBASHx != 0){
					$totalAttacksBASHx = $totalAttacksBASHx;	
				}
				//END ATTACK PART
					
					
				if(($totalAttacksBASH + $totalAttacksBASHb + $totalAttacksBASHx) >= 6)
				{
					$this->printMessage($LNG['fl_bash_protection'], true, array('game.php?page=fleetTable', 2));
				}
			} 

			if($targetMission == 1 || $targetMission == 2 || $targetMission == 5 || $targetMission == 6 || $targetMission == 9)
			{
				if(Config::get()->adm_attack == 1 && $targetPlayerData['authattack'] > $USER['authlevel'])
				{
					$this->printMessage($LNG['fl_admin_attack'], true, array('game.php?page=fleetTable', 2));
				}

				$sql	= 'SELECT total_points, defs_points, fleet_points
				FROM %%STATPOINTS%%
				WHERE id_owner = :userId AND stat_type = :statType';

				$USER	+= Database::get()->selectSingle($sql, array(
					':userId'	=> $USER['id'],
					':statType'	=> 1
				));
			
			if($targetMission != 5 && $targetPlanetData['gal6mod'] == 0 && $targetPlanetData['isAlliancePlanet'] == 0)
			{
				$IsNoobProtec	= CheckNoobProtec($USER, $targetPlayerData, $targetPlayerData);
				
				if ($IsNoobProtec['NoobPlayer'] && $targetPlanetData['id_owner'] != 9999)
				{
					$this->printMessage($LNG['fl_player_is_noob'], true, array('game.php?page=fleetTable', 2));
				}
				
				if ($IsNoobProtec['StrongPlayer'] && $targetPlanetData['id_owner'] != 9999) {
					$this->printMessage($LNG['fl_player_is_strong'], true, array('game.php?page=fleetTable', 2));
				}
			}
			}

			if ($targetMission == 5)
			{	
				if($targetPlayerData['ally_id'] != $USER['ally_id'] &&  $targetPlanetData['gal6mod'] == 0 || $targetPlayerData['ally_id'] == $USER['ally_id'] && $USER['ally_id'] == 0 && $targetPlanetData['gal6mod'] == 0) {
					$sql = "SELECT COUNT(*) as state FROM %%BUDDY%%
					WHERE id NOT IN (SELECT id FROM %%BUDDY_REQUEST%% WHERE %%BUDDY_REQUEST%%.id = %%BUDDY%%.id) AND
					(owner = :ownerID AND sender = :userID AND buddyType = :buddyType) OR (owner = :userID AND sender = :ownerID AND buddyType = :buddyType);";
					$buddy = $db->selectSingle($sql, array(
						':ownerID'  => $targetPlayerData['id'],
						':userID'   => $USER['id'],
						':buddyType' => 1
					), 'state');

					if($buddy == 0) {
						$this->printMessage($LNG['fl_no_same_alliance'], true, array('game.php?page=fleetTable', 2));
					}
				}
			}

			$fleetMaxSpeed 	= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
			$SpeedFactor    = FleetFunctions::GetGameSpeedFactor();
			$duration      	= max(5,FleetFunctions::GetMissionDuration($fleetSpeed, $fleetMaxSpeed, $distance, $SpeedFactor, $USER));
			$consumption   	= FleetFunctions::GetFleetConsumption($fleetArray, $duration, $distance, $USER, $SpeedFactor);
		
			if ($PLANET[$resource[903]] < $consumption) {
				$this->printMessage($LNG['fl_not_enough_deuterium'], true, array('game.php?page=fleetTable', 2));
			}
			
			$StayDuration    = 0;
			
			if($targetMission == 5 || $targetMission == 11 || $targetMission == 15 || $targetMission == 18 || $targetMission == 17 || $targetMission == 26)
			{
				if(!isset($availableMissions['StayBlock'][$stayTime]))
				{
					$this->printMessage($LNG['fl_hold_time_not_exists'], true, array('game.php?page=fleetTable', 2));
				}
				
				$StayDuration    = round($availableMissions['StayBlock'][$stayTime] * 3600, 0);
			}elseif($targetMission == 25)
			{
				if(!isset($availableMissions['StayBlock'][$stayTime]))
				{
					$this->printMessage($LNG['fl_hold_time_not_exists'], true, array('game.php?page=fleetTable', 2));
				}

				$sql		= 'SELECT * FROM %%PLANETS%% WHERE id_owner = :userID AND destruyed = :destruyed AND planet_type = :planet_type AND gal6mod = 1;';
				$isMaxGal6		= database::get()->select($sql, array(
					':userID'	=> $USER['id'],
					':destruyed'	=> 0,
					':planet_type'	=> 1
				));
				
				$StayDuration    = round((count($isMaxGal6)+1) * 3600, 0);
			}
			
			$fleetStorage		-= $consumption;
			
			$fleetResource	= array(
				901	=> min($TransportMetal, floor($PLANET[$resource[901]])),
				902	=> min($TransportCrystal, floor($PLANET[$resource[902]])),
				903	=> min($TransportDeuterium, floor($PLANET[$resource[903]] - $consumption)),
			);
			
			$StorageNeeded		= array_sum($fleetResource);
			
			if ($StorageNeeded > $fleetStorage)
			{
				$this->printMessage($LNG['fl_not_enough_space'], true, array('game.php?page=fleetTable', 2));
			}
			
			$PLANET[$resource[901]]	-= $fleetResource[901];
			$PLANET[$resource[902]]	-= $fleetResource[902];
			$PLANET[$resource[903]]	-= $fleetResource[903] + $consumption;

			$fleetStartTime		= $duration + TIMESTAMP;
			if($maxwave > 1){
			$fleetStartTime		= $fleetStartTime + ($i * 5) - 5;
			}
			
			
			$timeDifference		= round(max(0, $fleetStartTime - $ACSTime));
			
			if($fleetGroup != 0)
			{
				$TIMELEFT30 = ($ACSTime - TIMESTAMP) + ($ACSTime - TIMESTAMP) / 100 * 30;
				if($duration > $TIMELEFT30){
				$this->printMessage('to late', true, array('game.php?page=fleetTable', 2));
				}elseif($timeDifference != 0)
				{
					FleetFunctions::setACSTime($timeDifference, $fleetGroup);
				}
				else
				{
					$fleetStartTime		= $ACSTime;
				}
			}
			
			$fleetStayTime		= $fleetStartTime + $StayDuration;
			if($maxwave > 1){
			$fleetStayTime		= $fleetStayTime + ($i * 5) - 5;
			}
			$fleetEndTime		= $fleetStayTime + $duration;
			if($maxwave > 1){
			$fleetEndTime		= $fleetEndTime + ($i * 5) - 5;
			}
			
			
			if($USER['tutorial'] == 52 && $targetMission == 7){
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 53
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			}
			
			FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'],
				$PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $targetPlanetData['id_owner'],
				$targetPlanetData['id'], $targetGalaxy, $targetSystem, $targetPlanet, $targetType, $fleetResource,
				$fleetStartTime, $fleetStayTime, $fleetEndTime, $USER['ally_id'], $sector, $fleetGroup);
				
			
			
			
			
			foreach ($fleetArray as $Ship => $Count)
			{
				$fleetList[$LNG['tech'][$Ship]]	= $Count;
			}
		
		}

		$this->tplObj->gotoside('game.php?page=fleetTable');
		$this->assign(array(
			'maxwave'		=> $maxwave,
			'targetMission'		=> $targetMission,
			'distance'			=> $distance,
			'consumption'		=> $consumption,
			'from'				=> $PLANET['galaxy'] .":". $PLANET['system']. ":". $PLANET['planet'],
			'destination'		=> $targetGalaxy .":". $targetSystem .":". $targetPlanet,
			'fleetStartTime'	=> _date($LNG['php_tdformat'], $fleetStartTime, $USER['timezone']),
			'fleetEndTime'		=> _date($LNG['php_tdformat'], $fleetEndTime, $USER['timezone']),
			'MaxFleetSpeed'		=> $fleetMaxSpeed,
			'FleetList'			=> $fleetArray,
		));
		
		$this->display('page.fleetStep3.default.tpl');
	}
}