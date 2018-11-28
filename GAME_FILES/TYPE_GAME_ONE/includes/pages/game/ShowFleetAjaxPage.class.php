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


class ShowFleetAjaxPage extends AbstractGamePage
{
	public $returnData	= array();

	public static $requireModule = 0;

	function __construct()
	{
		parent::__construct();
		$this->setWindow('ajax');
	}

	private function sendData($Code, $Message)
	{
		$this->returnData['code']	= $Code;
		$this->returnData['mess']	= $Message;
		$this->sendJSON($this->returnData);
	}

	public function show()
	{
		global $USER, $PLANET, $resource, $LNG, $pricelist;
		
		if($PLANET['isAlliancePlanet'] != 0){
			$this->sendData(620, $LNG['autoexpedition_5']);
		}

		$UserDeuterium  = $PLANET['deuterium'];

		$planetID 		= HTTP::_GP('planetID', 0);
		$targetMission	= HTTP::_GP('mission', 0);

		$activeSlots	= FleetFunctions::GetCurrentFleets($USER['id']);
		$maxSlots		= FleetFunctions::GetMaxFleetSlots($USER);

		$this->returnData['slots']		= $activeSlots;
		$this->returnData['ship210']		= $PLANET[$resource[210]];
		$this->returnData['ship209']		= $PLANET[$resource[209]];
		$this->returnData['ship219']		= $PLANET[$resource[219]];
		
		$sql = "SELECT id_owner FROM %%PLANETS%% WHERE id = :id;";
		$userIdOwner = database::get()->selectSingle($sql, array(
			':id'	=> $planetID
		), 'id_owner');
		
		if($userIdOwner == 2) {
			$this->sendData(620, 'The planet is under sale in the market. No mission can be launched.');
		}
		
		$sql = "SELECT * FROM %%PLANETS%% WHERE id = :id;";
		$planetInfoTag = database::get()->selectSingle($sql, array(
			':id'	=> $planetID
		));
		
		if($planetInfoTag['isAlliancePlanet'] == $USER['ally_id'] && $USER['ally_id'] != 0) {
			$this->sendData(620, $LNG['sensorMsg4']);
		}
		
		$sql = "SELECT onlinetime FROM %%USERS%% WHERE id = :id;";
		$kickUserAllianceId = database::get()->selectSingle($sql, array(
			':id'	=> $userIdOwner
		), 'onlinetime');

		if (IsVacationMode($USER)) {
			$this->sendData(620, $LNG['fa_vacation_mode_current']);
		}
		
		if ($USER['protectionTimer'] >= TIMESTAMP) {
			$this->sendData(620, 'You can not spy another planet being under protections mode.');
		}

		if (empty($planetID)) {
			$this->sendData(601, $LNG['fa_planet_not_exist']);
		}

		if ($maxSlots <= $activeSlots) {
			$this->sendData(612, $LNG['fa_no_more_slots']);
		}

		$fleetArray = array();

		$db = Database::get();

		switch($targetMission)
		{ 
			case 6:
				if(!isModuleAvailable(MODULE_MISSION_SPY) && $kickUserAllianceId > TIMESTAMP - 7 * 24 * 3600) {
					$this->sendData(699, $LNG['sys_module_inactive']);
				}

				$ships	= min($USER['spio_anz'], $PLANET[$resource[210]]);

				if(empty($ships)) {
					$this->sendData(611, $LNG['fa_no_spios']);
				}

				$fleetArray = array(210 => $ships);
				$this->returnData['ships'][210]	= $PLANET[$resource[210]] - $ships;
				break;
			case 8:
				if(!isModuleAvailable(MODULE_MISSION_RECYCLE)) {
					$this->sendData(699, $LNG['sys_module_inactive']);
				}

				$sql = "SELECT (der_metal + der_crystal) as sum FROM %%PLANETS%% WHERE id = :planetID;";
				$totalDebris = $db->selectSingle($sql, array(
					':planetID' => $planetID
				), 'sum');

				$recElementIDs	= array(219, 209);

				$fleetArray		= array();

				foreach($recElementIDs as $elementID)
				{
					$shipsNeed 		= min(ceil($totalDebris / $pricelist[$elementID]['capacity']), $PLANET[$resource[$elementID]]);
					$totalDebris	-= ($shipsNeed * $pricelist[$elementID]['capacity']);

					$fleetArray[$elementID]	= $shipsNeed;
					$this->returnData['ships'][$elementID]	= $PLANET[$resource[$elementID]] - $shipsNeed;

					if($totalDebris <= 0)
					{
						break;
					}
				}

				if(empty($fleetArray))
				{
					$this->sendData(611, $LNG['fa_no_recyclers']);
				}
				break;
			default:
				$this->sendData(610, $LNG['fa_not_enough_probes']);
				break;
		}

		$fleetArray						= array_filter($fleetArray);

		if(empty($fleetArray)) {
			$this->sendData(610, $LNG['fa_not_enough_probes']);
		}
		
		
		if(empty($planetInfoTag['id_owner']) && $planetInfoTag['gal6mod'] == 1 && $targetMission == 6){
			$sql = "SELECT id_owner, galaxy, system, planet, planet_type, gal6mod FROM %%PLANETS%% WHERE id = :planetID;";
		}else{
			$sql = "SELECT planet.id_owner as id_owner,
			planet.galaxy as galaxy,
			planet.system as system,
			planet.planet as planet,
			planet.planet_type as planet_type,
			planet.gal6mod as gal6mod,
			total_points, defs_points, fleet_points, onlinetime, urlaubs_modus, outlaw, banaday, authattack, protectionTimer
			FROM %%PLANETS%% planet
			INNER JOIN %%USERS%% user ON planet.id_owner = user.id
			LEFT JOIN %%STATPOINTS%% as stat ON stat.id_owner = user.id AND stat.stat_type = '1'
			WHERE planet.id = :planetID;";
		}
		$targetData = $db->selectSingle($sql, array(
			':planetID' => $planetID
		));

		if (empty($targetData) && $targetData['gal6mod'] == 0) {
			$this->sendData(601, $LNG['fa_planet_not_exist']);
		}
		
		if($targetData['protectionTimer'] >= TIMESTAMP && $targetData['galaxy'] != 7) {
			$this->sendData(620, $LNG['protection_4']);
		}

		if($targetMission == 6 && $targetData['gal6mod'] == 0)
		{
			if(Config::get()->adm_attack == 1 && $targetData['authattack'] > $USER['authlevel']) {
				$this->sendData(619, $LNG['fa_action_not_allowed']);
			}

			if (IsVacationMode($targetData)) {
				$this->sendData(605, $LNG['fa_vacation_mode']);
			}
			
			$sql	= "SELECT user.*, stat.total_points, stat.defs_points, stat.fleet_points FROM %%USERS%% as user LEFT JOIN %%STATPOINTS%% as stat ON stat.id_owner = user.id WHERE user.id = :userId AND stat.stat_type = 1;";
			$USERDATAFIX	= database::get()->selectSingle($sql, array(
				':userId'	=> $USER['id']
			));

			$IsNoobProtec	= CheckNoobProtec($USERDATAFIX, $targetData, $targetData);

			if ($IsNoobProtec['NoobPlayer']) {
				$this->sendData(603, $LNG['fa_week_player']);
			}

			if ($IsNoobProtec['StrongPlayer']) {
				$this->sendData(604, $LNG['fa_strong_player']);
			}

			if ($USER['id'] == $targetData['id_owner']) {
				$this->sendData(618, $LNG['fa_not_spy_yourself']);
			}
		}elseif($targetMission == 6 && $targetData['gal6mod'] == 1 && empty($targetData['id_owner'])){
			$targetData['id_owner'] = 0;
		}

		$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
		$Distance    		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array($targetData['galaxy'], $targetData['system'], $targetData['planet']));
		$SpeedAllMin		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
		$Duration			= FleetFunctions::GetMissionDuration(10, $SpeedAllMin, $Distance, $SpeedFactor, $USER);
		$consumption		= FleetFunctions::GetFleetConsumption($fleetArray, $Duration, $Distance, $USER, $SpeedFactor);

		
		$UserDeuterium   	-= $consumption;
		if($UserDeuterium < 0) {
			$this->sendData(613, $LNG['fa_not_enough_fuel']);
		}

		if($consumption > FleetFunctions::GetFleetRoom($fleetArray, $USER)) {
			$this->sendData(613, $LNG['fa_no_fleetroom']);
		}
		
		/* $sql	= 'UPDATE %%PLANETS%% SET deuterium = deuterium - :deuterium WHERE id = :planetId';
		Database::get()->update($sql, array(
			':planetId'		=> $PLANET['id'],
			':deuterium'	=> $consumption
		)); */

		
		//if($USER['id'] == 1)
			//$this->sendData(613, $consumption)

		if(connection_aborted())
			exit;

		$this->returnData['slots']++;


		$fleetResource	= array(
			901	=> 0,
			902	=> 0,
			903	=> 0,
		);

		$fleetStartTime		= $Duration + TIMESTAMP;
		$fleetStayTime		= $fleetStartTime;
		$fleetEndTime		= $fleetStayTime + $Duration;

		$shipID				= array_keys($fleetArray);

		FleetFunctions::sendFleet($fleetArray, $targetMission, $USER['id'], $PLANET['id'], $PLANET['galaxy'],
			$PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $targetData['id_owner'], $planetID,
			$targetData['galaxy'], $targetData['system'], $targetData['planet'], $targetData['planet_type'],
			$fleetResource, $fleetStartTime, $fleetStayTime, $fleetEndTime, $USER['ally_id']);

		$this->sendData(600, $LNG['fa_sending']." ".array_sum($fleetArray)." ". $LNG['tech'][$shipID[0]] ." ".$LNG['gl_to']." ".$targetData['galaxy'].":".$targetData['system'].":".$targetData['planet']." ...");
	}
}