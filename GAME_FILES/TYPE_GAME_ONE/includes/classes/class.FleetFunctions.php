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

class FleetFunctions 
{
	static $allowedSpeed	= array(10 => 100, 9 => 90, 8 => 80, 7 => 70, 6 => 60, 5 => 50, 4 => 40, 3 => 30, 2 => 20, 1 => 10);
	
	private static function GetShipConsumption($Ship, $Player)
	{
		global $pricelist;
		
		$premium_fuel_comsuption = 0;
		if($Player['prem_fuel_consumption'] > 0 && $Player['prem_fuel_consumption_days'] > TIMESTAMP){
			$premium_fuel_comsuption = $Player['prem_fuel_consumption'];
		}
		
		$academy_fuel_comsuption = 0;
		if($Player['academy_p_b_1_1107'] > 0){
			$academy_fuel_comsuption = $Player['academy_p_b_1_1107'];
		}
		
		$ally_fraction_fuel = 0;
		if($Player['ally_id'] != 0){
			$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
			$ALLIANCE = Database::get()->selectSingle($sql, array(
			':allyID'	=> $Player['ally_id']
			));
			if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
			$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
			$FRACTIONS = Database::get()->selectSingle($sql, array(
			':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
			));
			$ally_fraction_fuel = $FRACTIONS['ally_fraction_fuel'] * $ALLIANCE['ally_fraction_level'];
			}
		}


		$getGalaxySevenAccount = getGalaxySevenAccount($Player);
		$getGalaxySevenConso   = $getGalaxySevenAccount['fleetComsumption'];

		return (($Player['impulse_motor_tech'] >= 5 && $Ship == 202) || ($Player['hyperspace_motor_tech'] >= 8 && $Ship == 211)) ? $pricelist[$Ship]['consumption2'] - ($pricelist[$Ship]['consumption2'] / 100 * $premium_fuel_comsuption/2) - ($pricelist[$Ship]['consumption2'] / 100 * $academy_fuel_comsuption) - ($pricelist[$Ship]['consumption2'] / 100 * $ally_fraction_fuel) - ($pricelist[$Ship]['consumption2'] / 100 * $getGalaxySevenConso) : $pricelist[$Ship]['consumption'] - ($pricelist[$Ship]['consumption'] / 100 * $premium_fuel_comsuption/2) - ($pricelist[$Ship]['consumption'] / 100 * $academy_fuel_comsuption) - ($pricelist[$Ship]['consumption'] / 100 * $ally_fraction_fuel) - ($pricelist[$Ship]['consumption'] / 100 * $getGalaxySevenConso);
	}

	private static function OnlyShipByID($Ships, $ShipID)
	{
		return isset($Ships[$ShipID]) && count($Ships) === 1;
	}
    public static function CheckExpeDay($ID)
{
	$sql	= 'SELECT COUNT(*) as state
	FROM %%LOG_FLEETS%%
	WHERE fleet_owner = :fleetOwner
	AND fleet_start_time > :fleetStartTime
		AND expeEvent != 0
	AND fleet_mission = 18;';
	$Count	= Database::get()->selectSingle($sql, array(
		':fleetOwner'		=> $ID,
		':fleetStartTime'	=> (TIMESTAMP - 24*3600),
	));
	return $Count['state'] >= MAX_EXPEDITIONS_PER_DAY;
} 
	private static function GetShipSpeed($Ship, $Player)
	{
		global $pricelist, $resource;
		
		$techSpeed	= $pricelist[$Ship]['tech'];
		$arsenal_1  = $pricelist[811]['arsenal_bonus'] * $Player['arsenal_combustion_level'];
		$arsenal_2  = $pricelist[812]['arsenal_bonus'] * $Player['arsenal_impulse_level'];
		$arsenal_3  = $pricelist[813]['arsenal_bonus'] * $Player['arsenal_hyperspace_level'];
		
		$hashallyspeed = 0;
		$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
		$allyInfospeedfleet = Database::get()->selectSingle($sql, array(
			':allianceId'	=> $Player['ally_id']
		));
		if($Player['ally_id'] != 0){
			$hashallyspeed = $allyInfospeedfleet['total_alliance_speed'];	
		}
		
		if($techSpeed == 4) {
			$techSpeed = $Player['impulse_motor_tech'] >= 5 ? 2 : 1;
		}
		if($techSpeed == 5) {
			$techSpeed = $Player['hyperspace_motor_tech'] >= 8 ? 3 : 2;
		}
		
		$ally_fraction_fleet_speed = 0;
		if($Player['ally_id'] != 0){
			$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
			$ALLIANCE = Database::get()->selectSingle($sql, array(
				':allyID'	=> $Player['ally_id']
			));
			if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
				$FRACTIONS = Database::get()->selectSingle($sql, array(
					':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
				));
				$ally_fraction_fleet_speed = $FRACTIONS['ally_fraction_fleet_speed'] * $ALLIANCE['ally_fraction_level'];
			}
		}
	
		switch($techSpeed)
		{
			
			case 1:
				$speed	= $pricelist[$Ship]['speed'] * (1 + (0.1 * ($Player['combustion_tech'] + (0.1 * $arsenal_1) + (0.1 * $hashallyspeed) + (0.1 * ($ally_fraction_fleet_speed/2)))));
			break;
			case 2:
				$speed	= $pricelist[$Ship]['speed'] * (1 + (0.2 * ($Player['impulse_motor_tech'] + (0.2 * $arsenal_2) + (0.2 * $hashallyspeed) + (0.2 * ($ally_fraction_fleet_speed/2)))));
			break;
			case 3:
				$speed	= $pricelist[$Ship]['speed'] * (1 + (0.3 * ($Player['hyperspace_motor_tech'] + (0.3 * $arsenal_3) + (0.3 * $hashallyspeed) + (0.3 * ($ally_fraction_fleet_speed/2)))));
			break;
			default:
				$speed	= 0;
			break;
		}
		
		if($Player['academy_p_b_1_1105'] > 0){
			$speed	*= max(0, 1 + (3*$Player['academy_p_b_1_1105'])/100);
		}

		$getGalaxySevenAccount = getGalaxySevenAccount($Player);
		$getGalaxySevenSpeed   = $getGalaxySevenAccount['flyTime'];

		if($getGalaxySevenSpeed > 0){
			$speed	*= max(0, 1 + $getGalaxySevenSpeed/100);
		}
		
		
		return $speed;
	}
	
	public static function getExpeditionLimit($USER)
	{
	
		return floor(sqrt($USER[$GLOBALS['resource'][124]]));
	}
	
	public static function getDMMissionLimit($USER)
	{
		return Config::get($USER['universe'])->max_dm_missions;
	}
	
	public static function getMissileRange($Level)
	{
		return max(($Level * 5) - 1, 0);
	}
	
	public static function CheckUserSpeed($speed)
	{
		return isset(self::$allowedSpeed[$speed]);
	}

	public static function GetTargetDistance($start, $target)
	{
		$a2700 = 0;
		$a1000 = 0;
		if($target[1] != $start[1]) $a2700 = 2700;
		if($target[2] != $start[2]) $a1000 = 1000;
		if ($target[0] != $start[0] || $target[2] != $start[2] || $target[1] != $start[1]) {
			return (abs($target[0] - $start[0] ) * 20000)+(abs($target[1] - $start[1]) * 95 + $a2700) + (abs($target[2] - $start[2]) * 5 + $a1000);
		} else {
			return 5;
		}
	}

	public static function GetMissionDuration($SpeedFactor, $MaxFleetSpeed, $Distance, $GameSpeed, $USER)
	{
		$SpeedFactor	= (3500 / ($SpeedFactor * 0.1));
		$SpeedFactor	*= pow($Distance * 10 / $MaxFleetSpeed, 0.5);
		$SpeedFactor	+= 10;
		$SpeedFactor	/= $GameSpeed;
		
		$gouvernor_fly = 0;
		if($USER['dm_fleettime'] > TIMESTAMP){
			$gouvernor_fly = GubPriceAPSTRACT(707, $USER['dm_fleettime_level'], 'dm_fleettime');
		}
			
		if($gouvernor_fly > 0)
		{
			$SpeedFactor	*= max(0, 1 + $gouvernor_fly/100*-1);
		}
		
		return max($SpeedFactor, MIN_FLEET_TIME); 
	}
 
	public static function GetMIPDuration($startSystem, $targetSystem)
	{
		$Distance = abs($startSystem - $targetSystem);
		$Duration = max(round((30 + 60 * $Distance) / self::GetGameSpeedFactor()), MIN_FLEET_TIME);
		
		return $Duration;
	}

	public static function GetGameSpeedFactor()
	{
		return Config::get()->fleet_speed / 2500;
	}
	
	public static function GetMaxFleetSlots($USER)
	{
		global $resource;
		return 1 + $USER[$resource[108]] + $USER['factor']['FleetSlots'] + $USER['peacefull_exp_slots'] + $USER['academy_p_b_1_1106'];
	}

	public static function GetFleetRoom($Fleet, $USER)
	{
		global $pricelist;
		$FleetRoom 			= 0;
		$academy_p_b_2_1207 = 0;
		if($USER['academy_p_b_2_1207'] > 0){
			$academy_p_b_2_1207 = $USER['academy_p_b_2_1207'] * 5;
		}
		
		$ally_fraction_fleet_capa = 0;
		if($USER['ally_id'] != 0){
			$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
			$ALLIANCE = Database::get()->selectSingle($sql, array(
			':allyID'	=> $USER['ally_id']
			));
			if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
				$FRACTIONS = Database::get()->selectSingle($sql, array(
				':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
				));
				$ally_fraction_fleet_capa = $FRACTIONS['ally_fraction_fleet_capa'] * $ALLIANCE['ally_fraction_level'];
			}
		}
			
		foreach ($Fleet as $ShipID => $amount)
		{
			$FleetRoom		   += $pricelist[$ShipID]['capacity'] * $amount;
		}
		
		$FleetRoom	*= 1 + $USER['factor']['ShipStorage'];
		$FleetRoom  += ($FleetRoom / 100 * $academy_p_b_2_1207);
		return $FleetRoom;
	}
	
	public static function GetFleetMaxSpeed ($Fleets, $Player)
	{
		$FleetArray = (!is_array($Fleets)) ? array($Fleets => 1) : $Fleets;
		$speedalls 	= array();
		
		foreach ($FleetArray as $Ship => $Count) {
			if($Count != 0){
				$speedalls[$Ship] = self::GetShipSpeed($Ship, $Player);
			}
		}
		
		return min($speedalls);
	}

	public static function GetFleetConsumption($FleetArray, $MissionDuration, $MissionDistance, $Player, $GameSpeed)
	{
		$consumption = 0;

		foreach ($FleetArray as $Ship => $Count)
		{
			$ShipSpeed          = self::GetShipSpeed($Ship, $Player);
			$ShipConsumption    = self::GetShipConsumption($Ship, $Player);
			
			$spd                = 35000 / (round($MissionDuration, 0) * $GameSpeed - 10) * sqrt($MissionDistance * 10 / $ShipSpeed);
			$basicConsumption   = $ShipConsumption * $Count;
			$consumption        += $basicConsumption * $MissionDistance / 35000 * (($spd / 10) + 1) * (($spd / 10) + 1);
		}
		
		return round((0 + $consumption) * pow(0.99, 0)) + 1;
		
		//return (round($consumption) + 1);
	}

	public static function GetFleetMissions($USER, $MisInfo, $Planet, $USERPLANET)
	{
		global $resource;
		$Missions	= self::GetAvailableMissions($USER, $MisInfo, $Planet, $USERPLANET);
		$stayBlock	= array();
		
		$premium_speed_expeditions = 0;
		if($USER['prem_speed_expiditeon'] > 0 && $USER['prem_speed_expiditeon_days'] > TIMESTAMP){
			$premium_speed_expeditions = $USER['prem_speed_expiditeon'];
		}
		
		$haltSpeed	= Config::get($USER['universe'])->halt_speed;
		$haltSpeed	+= ($haltSpeed / 100 * $premium_speed_expeditions);

		$premium_expe_slots = 0;
		if($USER['prem_count_expiditeon'] > 0 && $USER['prem_count_expiditeon_days'] > TIMESTAMP){
			$premium_expe_slots = $USER['prem_count_expiditeon'];
		}
		
		if (in_array(15, $Missions)) {
			for($i = 1;$i <= $USER[$resource[124]] + $premium_expe_slots;$i++)
			{
				$stayBlock[$i]	= round($i / $haltSpeed, 2);
			}
		}
		elseif (in_array(17, $Missions)) {
			for($i = 1;$i <= $USER[$resource[124]] + $premium_expe_slots;$i++)
			{
				$stayBlock[$i]	= round($i / $haltSpeed, 2);
			}
		}
		elseif (in_array(18, $Missions)) {
			for($i = 1;$i <= $USER[$resource[124]] + $premium_expe_slots;$i++)
			{
				$stayBlock[$i]	= round($i / $haltSpeed, 2);
			}
		}
		elseif(in_array(11, $Missions)) 
		{
			for($i = 1;$i <= 4;$i++)
			{
				$stayBlock[$i]	= round($i / 5, 2);
			}
		}
		elseif(in_array(5, $Missions)) 
		{
			$stayBlock = array(1 => 1, 2 => 2, 3 => 3, 8 => 6, 12 => 8, 16 => 12);
		}
		elseif(in_array(25, $Missions)) 
		{
			
			$sql		= 'SELECT * FROM %%PLANETS%% WHERE id_owner = :userID AND destruyed = :destruyed AND planet_type = :planet_type AND gal6mod = 1;';
			$isMaxGal6		= database::get()->select($sql, array(
				':userID'	=> $USER['id'],
				':destruyed'	=> 0,
				':planet_type'	=> 1
			));
			$activeCapture   = count($isMaxGal6) + FleetFunctions::GetCurrentFleets($USER['id'], 25, true);
			for($i = 0;$i <= $activeCapture;$i++)
			{
				$stayBlock[$i]	= 1 + $i;
			}
		}elseif(in_array(26, $Missions)) 
		{
			$stayBlock = array(1 => 1);
		}
		
		return array('MissionSelector' => $Missions, 'StayBlock' => $stayBlock);
	}

	/*
	 *
	 * Unserialize an Fleetstring to an array
	 *
	 * @param string
	 *
	 * @return array
	 *
	 */

	public static function unserialize($fleetAmount)
	{
		$fleetTyps		= explode(';', $fleetAmount);

		$fleetAmount	= array();

		foreach ($fleetTyps as $fleetTyp)
		{
			$temp = explode(',', $fleetTyp);

			if (empty($temp[0])) continue;

			if (!isset($fleetAmount[$temp[0]]))
			{
				$fleetAmount[$temp[0]] = 0;
			}

			$fleetAmount[$temp[0]] += $temp[1];
		}

		return $fleetAmount;
	}
	
	public static function unserializeWreck($fleetAmount)
	{
		$fleetTyps		= explode(';', $fleetAmount);

		$fleetAmount	= array();
		$wreckAmount	= array();

		foreach ($fleetTyps as $fleetTyp)
		{
			$temp = explode(',', $fleetTyp);
			$temp2 = explode(':', $temp[1]);

			if (empty($temp[0])) continue;

			if (!isset($fleetAmount[$temp[0]]))
			{
				$fleetAmount[$temp[0]] = 0;
				$wreckAmount[$temp[0]] = 0;
			}

			$fleetAmount[$temp[0]] += $temp2[1];
			$wreckAmount[$temp[0]] += $temp2[0];
		}

		return array($fleetAmount, $wreckAmount);
	}

	public static function GetACSDuration($acsId)
	{
		if(empty($acsId))
		{
			return 0;
		}

		$sql			= 'SELECT ankunft FROM %%AKS%% WHERE id = :acsId;';
		$acsEndTime 	= Database::get()->selectSingle($sql, array(
			':acsId'	=> $acsId
		), 'ankunft');
		
		return empty($acsEndTime) ? $acsEndTime - TIMESTAMP : 0;
	}
	
	public static function setACSTime($timeDifference, $acsId)
	{
		if(empty($acsId))
		{
			throw new InvalidArgumentException('Missing acsId on '.__CLASS__.'::'.__METHOD__);
		}

		$db		= Database::get();

		$sql	= 'UPDATE %%AKS%% SET ankunft = ankunft + :time WHERE id = :acsId;';
		$db->update($sql, array(
			':time'		=> $timeDifference,
			':acsId'	=> $acsId,
		));

		$sql	= 'UPDATE %%FLEETS%%, %%FLEETS_EVENT%% SET
		fleet_start_time = fleet_start_time + :time,
		fleet_end_stay   = fleet_end_stay + :time,
		fleet_end_time   = fleet_end_time + :time,
		time             = time + :time
		WHERE fleet_group = :acsId AND fleet_id = fleetID;';

		$db->update($sql, array(
			':time'		=> $timeDifference,
			':acsId'	=> $acsId,
		));

        return true;
	}

	public static function GetCurrentFleets($userId, $fleetMission = 10, $thisMission = false)
	{
		if($thisMission)
		{
			$sql = 'SELECT COUNT(*) as state
			FROM %%FLEETS%%
			WHERE fleet_owner = :userId
			AND fleet_mission = :fleetMission;';
		}
		else
		{
			$sql = 'SELECT COUNT(*) as state
			FROM %%FLEETS%%
			WHERE fleet_owner = :userId
			AND fleet_mission != :fleetMission;';
		}

		$ActualFleets = Database::get()->selectSingle($sql, array(
			':userId'		=> $userId,
			':fleetMission'	=> $fleetMission,
		));
		return $ActualFleets['state'];
	}	
	
	public static function SendFleetBack($USER, $FleetID)
	{
		$db				= Database::get();

		$sql			= 'SELECT start_time, fleet_start_time, fleet_mission, fleet_group, fleet_owner, fleet_mess FROM %%FLEETS%% WHERE fleet_id = :fleetId;';
		$fleetResult	= $db->selectSingle($sql, array(
			':fleetId'	=> $FleetID,
		));

		if ($fleetResult['fleet_owner'] != $USER['id'] || $fleetResult['fleet_mess'] == 1)
		{
			return false;
		}

		$sqlWhere	= 'fleet_id';

		if($fleetResult['fleet_mission'] == 1 && $fleetResult['fleet_group'] != 0)
		{
			$sql		= 'SELECT COUNT(*) as state FROM %%USERS_ACS%% WHERE acsID = :acsId;';
			$isInGroup	= $db->selectSingle($sql, array(
				':acsId'	=> $fleetResult['fleet_group'],
			), 'state');

			if($isInGroup)
			{
				$sql = 'DELETE %%AKS%%, %%USERS_ACS%%
				FROM %%AKS%%
				LEFT JOIN %%USERS_ACS%% ON acsID = %%AKS%%.id
				WHERE %%AKS%%.id = :acsId;';

				$db->delete($sql, array(
					':acsId'	=> $fleetResult['fleet_group']
			  	));
				
				$FleetID	= $fleetResult['fleet_group'];
				$sqlWhere	= 'fleet_group';
			}
		}
		
		$fleetEndTime	= (TIMESTAMP - $fleetResult['start_time']) + TIMESTAMP;
		if($fleetResult['fleet_mission'] == 5 && $fleetResult['fleet_mess'] == 2)
			$fleetEndTime	= TIMESTAMP + ($fleetResult['fleet_start_time'] -$fleetResult['start_time']);
		
		$sql	= 'UPDATE %%FLEETS%%, %%FLEETS_EVENT%% SET
		fleet_group			= :fleetGroup,
		fleet_end_stay		= :endStayTime,
		fleet_end_time		= :endTime,
		fleet_mess			= :fleetState,
		hasCanceled			= :hasCanceled,
		time				= :endTime
		WHERE '.$sqlWhere.' = :id AND fleet_id = fleetID;';

		$db->update($sql, array(
			':id'			=> $FleetID,
			':endStayTime'	=> TIMESTAMP,
			':endTime'		=> $fleetEndTime,
			':fleetGroup'	=> 0,
			':hasCanceled'	=> 1,
			':fleetState'	=> FLEET_RETURN
		));

		$sql	= 'UPDATE %%LOG_FLEETS%% SET
		fleet_end_stay	= :endStayTime,
		fleet_end_time	= :endTime,
		fleet_mess		= :fleetState,
		fleet_state		= 2
		WHERE '.$sqlWhere.' = :id;';

		$db->update($sql, array(
			':id'			=> $FleetID,
			':endStayTime'	=> TIMESTAMP,
			':endTime'		=> $fleetEndTime,
			':fleetState'	=> FLEET_RETURN
		));

		return true;
	}
	
	public static function GetFleetShipInfo($FleetArray, $Player)
	{
		$FleetInfo	= array();
		foreach ($FleetArray as $ShipID => $Amount) {
			$FleetInfo[$ShipID]	= array('consumption' => self::GetShipConsumption($ShipID, $Player), 'speed' => self::GetFleetMaxSpeed($ShipID, $Player), 'amount' => floatToString($Amount));
		}
		return $FleetInfo;
	}
	
	public static function GotoFleetPage($Code = 0)
	{	
		global $LNG;
		if(Config::get()->debug == 1)
		{
			$temp = debug_backtrace();
			echo str_replace($_SERVER["DOCUMENT_ROOT"],'.',$temp[0]['file'])." on ".$temp[0]['line']. " | Code: ".$Code." | Error: ".(isset($LNG['fl_send_error'][$Code]) ? $LNG['fl_send_error'][$Code] : '');
			exit;
		}
		
		HTTP::redirectTo('game.php?page=fleetTable&code='.$Code);
	}
	
	public static function GetAvailableMissions($USER, $MissionInfo, $GetInfoPlanet, $USERPLANET)
	{	
		$YourPlanet				= (!empty($GetInfoPlanet['id_owner']) && $GetInfoPlanet['id_owner'] == $USER['id']) ? true : false;
		$UsedPlanet				= (!empty($GetInfoPlanet['id_owner'])) ? true : false;
		$availableMissions		= array();
		
		$sql = "SELECT onlinetime FROM %%USERS%% WHERE id = :id;";
		$kickUserAllianceId = database::get()->selectSingle($sql, array(
			':id'	=> $GetInfoPlanet['id_owner']
		), 'onlinetime');
		
		$sql	= 'SELECT * FROM %%SUPRIMOEVENT%% WHERE galaxy = :galaxy AND system = :system AND createdTime > :createdTime;';
		$suprimoEvent	= database::get()->selectSingle($sql, array(
			':galaxy'		=> $MissionInfo['galaxy'],
			':system'		=> $MissionInfo['system'],
			':createdTime'	=> TIMESTAMP - 3600*24
		));
		
		if ($MissionInfo['planet'] == (Config::get($USER['universe'])->max_planets + 1) && isModuleAvailable(MODULE_MISSION_EXPEDITION) && !isset($MissionInfo['Ship'][210]) && !isset($MissionInfo['Ship'][208]) && !isset($MissionInfo['Ship'][220]) && !isset($MissionInfo['Ship'][223]) && $USERPLANET['gal6mod'] == 0)
			$availableMissions[]	= 18;	
		
		if ($MissionInfo['planet'] == (Config::get($USER['universe'])->max_planets + 2) && !isset($MissionInfo['Ship'][210]) && !isset($MissionInfo['Ship'][208]) && !isset($MissionInfo['Ship'][220]) && !isset($MissionInfo['Ship'][223]) && !empty($suprimoEvent) && $USERPLANET['isAlliancePlanet'] == 0 && $GetInfoPlanet['isAlliancePlanet'] == 0)
			$availableMissions[]	= 26;
		
		 if ($MissionInfo['planet'] == (Config::get($USER['universe'])->max_planets + 1) && !isset($MissionInfo['Ship'][210]) && !isset($MissionInfo['Ship'][208]) && !isset($MissionInfo['Ship'][220]) && !isset($MissionInfo['Ship'][223]) && $USERPLANET['gal6mod'] == 0)
			$availableMissions[]	= 17;	
		elseif ($MissionInfo['planettype'] == 2) {
			if ((isset($MissionInfo['Ship'][209]) || isset($MissionInfo['Ship'][219])) && isModuleAvailable(MODULE_MISSION_RECYCLE) && $USERPLANET['isAlliancePlanet'] == 0)
				$availableMissions[]	= 8;
		} else {
			if (!$UsedPlanet) {
				if (isset($MissionInfo['Ship'][208]) && $MissionInfo['planettype'] == 1 && isModuleAvailable(MODULE_MISSION_COLONY) && $MissionInfo['planet'] <= 20 && $MissionInfo['galaxy'] <= (Config::get($USER['universe'])->max_galaxy - 1) && $USERPLANET['isAlliancePlanet'] == 0)
					$availableMissions[]	= 7;
				if((isset($MissionInfo['Ship'][209]) || isset($MissionInfo['Ship'][219])) && $MissionInfo['planettype'] == 1 && $MissionInfo['planet'] <= 20 && $GetInfoPlanet['gal6mod'] == 0 && $USERPLANET['isAlliancePlanet'] == 0 && $GetInfoPlanet['isAlliancePlanet'] == 0)
					$availableMissions[]	= 16;	
				if($GetInfoPlanet['gal6mod'] == 1 && $USERPLANET['gal6mod'] == 0 && !isset($MissionInfo['Ship'][208]) && !isset($MissionInfo['Ship'][210]) && !isset($MissionInfo['Ship'][220]) && !isset($MissionInfo['Ship'][223]) && $USERPLANET['isAlliancePlanet'] == 0 && $GetInfoPlanet['isAlliancePlanet'] == 0)
					$availableMissions[]	= 25;
				
				if(self::OnlyShipByID($MissionInfo['Ship'], 210) && $GetInfoPlanet['gal6mod'] == 1)
					$availableMissions[]	= 6;
				
			} else {
				if(isModuleAvailable(MODULE_MISSION_TRANSPORT) && $kickUserAllianceId > TIMESTAMP - 7 * 24 * 3600 && $USERPLANET['gal6mod'] == 0 && $GetInfoPlanet['gal6mod'] == 0 && $USERPLANET['isAlliancePlanet'] == 0 && $GetInfoPlanet['isAlliancePlanet'] == 0 && $YourPlanet || isModuleAvailable(MODULE_MISSION_TRANSPORT) && $kickUserAllianceId > TIMESTAMP - 7 * 24 * 3600 && $USERPLANET['gal6mod'] == 0 && $GetInfoPlanet['gal6mod'] == 1 && $GetInfoPlanet['id_owner'] == $USER['id'] && $USERPLANET['isAlliancePlanet'] == 0 && $GetInfoPlanet['isAlliancePlanet'] == 0 && $YourPlanet)
					$availableMissions[]	= 3;
				
				if ((!$YourPlanet && self::OnlyShipByID($MissionInfo['Ship'], 210) && isModuleAvailable(MODULE_MISSION_SPY) && $USERPLANET['gal6mod'] == 0) || (!$YourPlanet && self::OnlyShipByID($MissionInfo['Ship'], 210) && $kickUserAllianceId < TIMESTAMP - 7 * 24 * 3600) && $USERPLANET['gal6mod'] == 0 && $USERPLANET['isAlliancePlanet'] == 0)
					$availableMissions[]	= 6;
				
				if(isModuleAvailable(MODULE_MISSION_HOLD) && isModuleAvailable(MODULE_MISSION_ACS) && !isset($MissionInfo['Ship'][208]) && !isset($MissionInfo['Ship'][210]) && !isset($MissionInfo['Ship'][220]) && !isset($MissionInfo['Ship'][223]) && $USERPLANET['gal6mod'] == 0 && $GetInfoPlanet['gal6mod'] == 1 && $GetInfoPlanet['id_owner'] == $USER['id'] && $USERPLANET['isAlliancePlanet'] == 0 || isModuleAvailable(MODULE_MISSION_HOLD) && isModuleAvailable(MODULE_MISSION_ACS) && !isset($MissionInfo['Ship'][208]) && !isset($MissionInfo['Ship'][210]) && !isset($MissionInfo['Ship'][220]) && !isset($MissionInfo['Ship'][223]) && $USERPLANET['gal6mod'] == 0 && $GetInfoPlanet['gal6mod'] == 0 && $GetInfoPlanet['id_owner'] == $USER['id'] && $USERPLANET['isAlliancePlanet'] == 0)
					$availableMissions[]	= 5;

				if (!$YourPlanet) {
					if((!isset($MissionInfo['Ship'][208]) && !isset($MissionInfo['Ship'][210]) && !isset($MissionInfo['Ship'][220]) && !isset($MissionInfo['Ship'][223]) && $USERPLANET['last_relocate'] < TIMESTAMP - 15*60 && $kickUserAllianceId < TIMESTAMP - 7 * 24 * 3600 && $USER['nextPossibleAttack'] < TIMESTAMP && $USERPLANET['gal6mod'] == 0) || (isModuleAvailable(MODULE_MISSION_ATTACK) && !isset($MissionInfo['Ship'][208]) && !isset($MissionInfo['Ship'][210]) && !isset($MissionInfo['Ship'][220]) && !isset($MissionInfo['Ship'][223]) && $USERPLANET['last_relocate'] < TIMESTAMP - 15*60 && $USER['nextPossibleAttack'] < TIMESTAMP && $USERPLANET['gal6mod'] == 0))
						$availableMissions[]	= 1;
					
					if($GetInfoPlanet['gal6mod'] == 1 && $USERPLANET['gal6mod'] == 0 && !isset($MissionInfo['Ship'][208]) && !isset($MissionInfo['Ship'][210]) && !isset($MissionInfo['Ship'][220]) && !isset($MissionInfo['Ship'][223]))
						$availableMissions[]	= 25;
					
					if(isModuleAvailable(MODULE_MISSION_HOLD) && isModuleAvailable(MODULE_MISSION_ACS) && !isset($MissionInfo['Ship'][208]) && !isset($MissionInfo['Ship'][210]) && !isset($MissionInfo['Ship'][220]) && !isset($MissionInfo['Ship'][223]) && $USERPLANET['gal6mod'] == 0 && $GetInfoPlanet['gal6mod'] == 0 && $USERPLANET['isAlliancePlanet'] == 0)
						$availableMissions[]	= 5;
				}elseif(isModuleAvailable(MODULE_MISSION_STATION) && $GetInfoPlanet['gal6mod'] == 0 && $USERPLANET['isAlliancePlanet'] == 0 && $GetInfoPlanet['isAlliancePlanet'] == 0) {
					$availableMissions[]	= 4;
				}
					
				if (!empty($MissionInfo['IsAKS']) && !$YourPlanet && isModuleAvailable(MODULE_MISSION_ATTACK) && isModuleAvailable(MODULE_MISSION_ACS) && !isset($MissionInfo['Ship'][208]) && !isset($MissionInfo['Ship'][210]) && !isset($MissionInfo['Ship'][220]) && !isset($MissionInfo['Ship'][223]) && $USERPLANET['last_relocate'] < TIMESTAMP - 15*60 && $USER['nextPossibleAttack'] < TIMESTAMP)
					$availableMissions[]	= 2;

				if (!$YourPlanet && $MissionInfo['planettype'] == 3 && $USER['rpg_destructeur'] == 1 && isset($MissionInfo['Ship'][214]) && isModuleAvailable(MODULE_MISSION_DESTROY) && $USERPLANET['last_relocate'] < TIMESTAMP - 15*60 && $USER['nextPossibleAttack'] < TIMESTAMP && $USERPLANET['isAlliancePlanet'] == 0)
					$availableMissions[]	= 9;

				if ($YourPlanet && $MissionInfo['planettype'] == 3 && self::OnlyShipByID($MissionInfo['Ship'], 220) && isModuleAvailable(MODULE_MISSION_DARKMATTER) && $USERPLANET['isAlliancePlanet'] == 0)
					$availableMissions[]	= 11;
			}
		}
		
		return $availableMissions;
	}
	
	public static function CheckBash($Target)
	{
		global $USER;

		if(!BASH_ON)
		{
			return false;
		}

		$sql	= 'SELECT *
		FROM %%LOG_FLEETS%%
		WHERE fleet_owner = :fleetOwner
		AND fleet_end_id = :fleetEndId
		AND fleet_state != :fleetState
		AND fleet_start_time > :fleetStartTime
		AND fleet_mission IN (1,2,9);';

		$Count	= Database::get()->rowCount($sql, array(
			':fleetOwner'		=> $USER['id'],
			':fleetEndId'		=> $Target,
			':fleetState'		=> 2,
			':fleetStartTime'	=> (TIMESTAMP - BASH_TIME),
		));

		return $Count >= BASH_COUNT;
	}
	
	public static function sendFleet($fleetArray, $fleetMission, $fleetStartOwner, $fleetStartPlanetID,
		$fleetStartPlanetGalaxy, $fleetStartPlanetSystem, $fleetStartPlanetPlanet, $fleetStartPlanetType,
		$fleetTargetOwner, $fleetTargetPlanetID, $fleetTargetPlanetGalaxy, $fleetTargetPlanetSystem,
		$fleetTargetPlanetPlanet, $fleetTargetPlanetType, $fleetResource, $fleetStartTime, $fleetStayTime,
		$fleetEndTime, $allyid, $sector = 0, $fleetGroup = 0, $missileTarget = 0)
	{
		global $resource;
		$fleetShipCount	= array_sum($fleetArray);
		$fleetData		= array();

		$db				= Database::get();

		$params			= array(':planetId'	=> $fleetStartPlanetID);

		$planetQuery	= array();
		foreach($fleetArray as $ShipID => $ShipCount) {
			$fleetData[]	= $ShipID.','.floatToString($ShipCount);
			$planetQuery[]	= $resource[$ShipID]." = ".$resource[$ShipID]." - :".$resource[$ShipID];

			$params[':'.$resource[$ShipID]]	= floatToString($ShipCount);
		}

		$sql	= 'UPDATE %%PLANETS%% SET '.implode(', ', $planetQuery).' WHERE id = :planetId;';

		$db->update($sql, $params);

		$sql	= 'INSERT INTO %%FLEETS%% SET
		fleet_owner					= :fleetStartOwner,
		fleet_target_owner			= :fleetTargetOwner,
		fleet_mission				= :fleetMission,
		fleet_amount				= :fleetShipCount,
		fleet_array					= :fleetData,
		fleet_universe				= :universe,
		fleet_start_time			= :fleetStartTime,
		fleet_end_stay				= :fleetStayTime,
		fleet_end_time				= :fleetEndTime,
		fleet_start_id				= :fleetStartPlanetID,
		fleet_start_galaxy			= :fleetStartPlanetGalaxy,
		fleet_start_system			= :fleetStartPlanetSystem,
		fleet_start_planet			= :fleetStartPlanetPlanet,
		fleet_start_type			= :fleetStartPlanetType,
		fleet_end_id				= :fleetTargetPlanetID,
		fleet_end_galaxy			= :fleetTargetPlanetGalaxy,
		fleet_end_system			= :fleetTargetPlanetSystem,
		fleet_end_planet			= :fleetTargetPlanetPlanet,
		fleet_end_type				= :fleetTargetPlanetType,
		fleet_resource_metal		= :fleetResource901,
		fleet_resource_crystal		= :fleetResource902,
		fleet_resource_deuterium	= :fleetResource903,
		fleet_group					= :fleetGroup,
		fleet_target_obj			= :missileTarget,
		ally_id						= :allyid,
		sector						= :sector,
		start_time					= :timestamp;';

		$db->insert($sql, array(
			':fleetStartOwner'			=> $fleetStartOwner,
			':fleetTargetOwner'			=> $fleetTargetOwner,
			':fleetMission'				=> $fleetMission,
			':fleetShipCount'			=> $fleetShipCount,
			':fleetData'				=> implode(';', $fleetData),
			':fleetStartTime'			=> $fleetStartTime,
			':fleetStayTime'			=> $fleetStayTime,
			':fleetEndTime'				=> $fleetEndTime,
			':fleetStartPlanetID'		=> $fleetStartPlanetID,
			':fleetStartPlanetGalaxy'	=> $fleetStartPlanetGalaxy,
			':fleetStartPlanetSystem'	=> $fleetStartPlanetSystem,
			':fleetStartPlanetPlanet'	=> $fleetStartPlanetPlanet,
			':fleetStartPlanetType'		=> $fleetStartPlanetType,
			':fleetTargetPlanetID'		=> $fleetTargetPlanetID,
			':fleetTargetPlanetGalaxy'	=> $fleetTargetPlanetGalaxy,
			':fleetTargetPlanetSystem'	=> $fleetTargetPlanetSystem,
			':fleetTargetPlanetPlanet'	=> $fleetTargetPlanetPlanet,
			':fleetTargetPlanetType'	=> $fleetTargetPlanetType,
			':fleetResource901'			=> $fleetResource[901],
			':fleetResource902'			=> $fleetResource[902],
			':fleetResource903'			=> $fleetResource[903],
			':fleetGroup'				=> $fleetGroup,
			':missileTarget'			=> $missileTarget,
			':allyid'					=> $allyid,
			':sector'					=> $sector,
			':timestamp'				=> TIMESTAMP,
			':universe'	   				=> Universe::current(),
		));

		$fleetId	= $db->lastInsertId();

		$sql	= 'INSERT INTO %%FLEETS_EVENT%% SET fleetID	= :fleetId, `time` = :endTime;';
		$db->insert($sql, array(
			':fleetId'	=> $fleetId,
			':endTime'	=> $fleetStartTime
		));

		$sql	= 'INSERT INTO %%LOG_FLEETS%% SET
		fleet_id					= :fleetId,
		fleet_owner					= :fleetStartOwner,
		fleet_target_owner			= :fleetTargetOwner,
		fleet_mission				= :fleetMission,
		fleet_amount				= :fleetShipCount,
		fleet_array					= :fleetData,
		fleet_universe				= :universe,
		fleet_start_time			= :fleetStartTime,
		fleet_end_stay				= :fleetStayTime,
		fleet_end_time				= :fleetEndTime,
		fleet_start_id				= :fleetStartPlanetID,
		fleet_start_galaxy			= :fleetStartPlanetGalaxy,
		fleet_start_system			= :fleetStartPlanetSystem,
		fleet_start_planet			= :fleetStartPlanetPlanet,
		fleet_start_type			= :fleetStartPlanetType,
		fleet_end_id				= :fleetTargetPlanetID,
		fleet_end_galaxy			= :fleetTargetPlanetGalaxy,
		fleet_end_system			= :fleetTargetPlanetSystem,
		fleet_end_planet			= :fleetTargetPlanetPlanet,
		fleet_end_type				= :fleetTargetPlanetType,
		fleet_resource_metal		= :fleetResource901,
		fleet_resource_crystal		= :fleetResource902,
		fleet_resource_deuterium	= :fleetResource903,
		fleet_group					= :fleetGroup,
		fleet_target_obj			= :missileTarget,
		ally_id						= :allyid,
		sector						= :sector,
		start_time					= :timestamp;';

		$db->insert($sql, array(
			':fleetId'					=> $fleetId,
			':fleetStartOwner'			=> $fleetStartOwner,
			':fleetTargetOwner'			=> $fleetTargetOwner,
			':fleetMission'				=> $fleetMission,
			':fleetShipCount'			=> $fleetShipCount,
			':fleetData'				=> implode(';', $fleetData),
			':fleetStartTime'			=> $fleetStartTime,
			':fleetStayTime'			=> $fleetStayTime,
			':fleetEndTime'				=> $fleetEndTime,
			':fleetStartPlanetID'		=> $fleetStartPlanetID,
			':fleetStartPlanetGalaxy'	=> $fleetStartPlanetGalaxy,
			':fleetStartPlanetSystem'	=> $fleetStartPlanetSystem,
			':fleetStartPlanetPlanet'	=> $fleetStartPlanetPlanet,
			':fleetStartPlanetType'		=> $fleetStartPlanetType,
			':fleetTargetPlanetID'		=> $fleetTargetPlanetID,
			':fleetTargetPlanetGalaxy'	=> $fleetTargetPlanetGalaxy,
			':fleetTargetPlanetSystem'	=> $fleetTargetPlanetSystem,
			':fleetTargetPlanetPlanet'	=> $fleetTargetPlanetPlanet,
			':fleetTargetPlanetType'	=> $fleetTargetPlanetType,
			':fleetResource901'			=> $fleetResource[901],
			':fleetResource902'			=> $fleetResource[902],
			':fleetResource903'			=> $fleetResource[903],
			':fleetGroup'				=> $fleetGroup,
			':missileTarget'			=> $missileTarget,
			':allyid'					=> $allyid,
			':sector'					=> $sector,
			':timestamp'				=> TIMESTAMP,
			':universe'	   				=> Universe::current(),
		));
		
		if($fleetMission == 1){
			$missionType = "attack";
		}elseif($fleetMission == 2){
			$missionType = "attackAcs";
		}elseif($fleetMission == 3){
			$missionType = "transport";
		}elseif($fleetMission == 4){
			$missionType = "deployement";
		}elseif($fleetMission == 5){
			$missionType = "defendAcs";
		}elseif($fleetMission == 6){
			$missionType = "spy";
		}elseif($fleetMission == 7){
			$missionType = "colonisation";
		}elseif($fleetMission == 8){
			$missionType = "recycle";
		}elseif($fleetMission == 9){
			$missionType = "destroy";
		}elseif($fleetMission == 10){
			$missionType = "missile";
		}elseif($fleetMission == 11){
			$missionType = "expeditionDm";
		}elseif($fleetMission == 15){
			$missionType = "expedition";
		}elseif($fleetMission == 16){
			$missionType = "asteroids";
		}elseif($fleetMission == 17){
			$missionType = "hostile";
		}elseif($fleetMission == 18){
			$missionType = "expedition";
		}elseif($fleetMission == 25){
			$missionType = "capture";
		}elseif($fleetMission == 26){
			$missionType = "surpriseme";
		}
		
		
		$sql	= "UPDATE %%FLEETSTATS%% SET ".$missionType." = ".$missionType." + 1 WHERE universe = 1;";
		$db->update($sql, array());
	}
}