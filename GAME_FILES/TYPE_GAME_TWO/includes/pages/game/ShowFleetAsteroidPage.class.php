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


class ShowFleetAsteroidPage extends AbstractGamePage
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
		
		/* if($USER['id'] != 1){
			$this->sendData(620, 'This extention is soon available.');
			exit();
		} */
		
		$UserRecycTech  = $USER[$resource[150]];
		$UserDeuterium  = $PLANET['deuterium'];

		$planetID 		= HTTP::_GP('planetID', 0);
		$targetMission	= HTTP::_GP('mission', 0);

		$activeSlots	= FleetFunctions::GetCurrentFleets($USER['id']);
		$maxSlots		= FleetFunctions::GetMaxFleetSlots($USER);

		$this->returnData['slots']		= $activeSlots;
		$this->returnData['ship209']	= $PLANET[$resource[209]];
		$this->returnData['ship219']	= $PLANET[$resource[219]];
		
		if (IsVacationMode($USER)) {
			$this->sendData(620, $LNG['fa_vacation_mode_current']);
		}

		if ($maxSlots <= $activeSlots) {
			$this->sendData(612, $LNG['fa_no_more_slots']);
		}

		$fleetArray = array();

		$db = Database::get();

		switch($targetMission)
		{ 
			default:
				$metal_rand = config::get()->asteroid_metal + (config::get()->asteroid_metal / 100 * $USER[$resource[150]]);
				$crystal_rand = config::get()->asteroid_crystal + (config::get()->asteroid_crystal / 100 * $USER[$resource[150]]);
				$deuterium_rand= config::get()->asteroid_deuterium + (config::get()->asteroid_deuterium / 100 * $USER[$resource[150]]);
				
				$totalAsteroid = $metal_rand + $crystal_rand + $deuterium_rand;
				
				$recElementIDs	= array(219, 209);

				$fleetArray		= array();
				
				$FleetRoom				= 0;
				$academy_p_b_2_1207 	= 0;
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
		
				foreach($recElementIDs as $elementID)
				{
					
					$NewCapacity = $pricelist[$elementID]['capacity'];
					$NewCapacity *= 1 + $USER['factor']['ShipStorage'];
					$NewCapacity += $NewCapacity / 100 * $academy_p_b_2_1207 + ($NewCapacity / 100 * $ally_fraction_fleet_capa);
					
					$shipsNeed 		= min(ceil($totalAsteroid / $NewCapacity), $PLANET[$resource[$elementID]]);
					$totalAsteroid	-= ($shipsNeed * $NewCapacity);

					$fleetArray[$elementID]	= $shipsNeed;
					$this->returnData['ships'][$elementID]	= $PLANET[$resource[$elementID]] - $shipsNeed;

					if($totalAsteroid <= 0)
					{
						break;
					}
				}
				if(empty($fleetArray))
				{
					$this->sendData(611, $LNG['fa_no_recyclers']);
				}
			break;
		}

		$fleetArray						= array_filter($fleetArray);

		if(empty($fleetArray)) {
			$this->sendData(610, $LNG['fa_no_recyclers']);
		}

		$sql = "SELECT id_owner,
		galaxy,
		system,
		planet,
		planet_type
		FROM %%PLANETS%%
		WHERE id = :planetID;";

		$targetData = $db->selectSingle($sql, array(
			':planetID' => $planetID
		));

		if (empty($targetData)) {
			$this->sendData(601, $LNG['fa_planet_not_exist']);
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
			$PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], 0, 0,
			$targetData['galaxy'], $targetData['system'], $targetData['planet'], 1,
			$fleetResource, $fleetStartTime, $fleetStayTime, $fleetEndTime, $USER['ally_id']);

		$this->sendData(600, $LNG['fa_sending']." ".array_sum($fleetArray)." ". $LNG['tech'][$shipID[0]] ." ".$LNG['gl_to']." ".$targetData['galaxy'].":".$targetData['system'].":".$targetData['planet']." ...");
	}
}