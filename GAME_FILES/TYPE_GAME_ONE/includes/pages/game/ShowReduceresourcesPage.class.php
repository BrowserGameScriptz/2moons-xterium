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

class ShowReduceresourcesPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
		
	}
	
	public function reduce()
	{
		global $USER, $PLANET, $resource, $LNG, $pricelist;
		
		if (!isset($_POST['palanets'])){
			$this->redirectTo('game.php?page=reduceresources');
		}elseif ($USER['urlaubs_modus'] == 1){
			$this->redirectTo('game.php?page=reduceresources');
		}else{
			if (!isset($_POST['palanets']))
				$_POST['palanets'] = array();
			
			$EndLog			= array();
			$TestCalcRoom   = array(217 => 1);
			$FleetRoomDark 	= FleetFunctions::GetFleetRoom($TestCalcRoom, $USER);	
			foreach($_POST['palanets'] as $ID => $Value) {
				$sql	= 'SELECT id, id_owner, name, ev_transporter, galaxy, system, planet, planet_type, metal, crystal, deuterium FROM %%PLANETS%% WHERE id = :Value AND id_owner = :userId;';
				$sur	= database::get()->selectSingle($sql, array(
					':Value'	=> $Value,
					':userId'	=> $USER['id']
				));
				
				if(empty($sur)) continue;
				
				$total_res 					= $sur['metal'] + $sur['crystal'] + $sur['deuterium'];
				$needed_ships 				= max(1, $total_res / $FleetRoomDark);
				$needed_ships 				= min($needed_ships, $sur['ev_transporter']);
				$rawfleetarray				= array(217 => $needed_ships);
				
				if(empty($needed_ships)){
					$EndLog[] = "Planet ".$sur['name']." [".$sur['galaxy'].":".$sur['system'].":".$sur['planet']."] : There are no battle transporters present on this planet.";
					continue;
				}
				
				$FleetRoom   		 		= FleetFunctions::GetFleetRoom($rawfleetarray, $USER);		
				$GameSpeedFactor   		 	= FleetFunctions::GetGameSpeedFactor();		
				$MaxFleetSpeed 				= FleetFunctions::GetFleetMaxSpeed($rawfleetarray, $USER);
				$distance      				= FleetFunctions::GetTargetDistance(array($sur['galaxy'], $sur['system'], $sur['planet']),array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']));
				$duration      				= max(5,FleetFunctions::GetMissionDuration(10, $MaxFleetSpeed, $distance, $GameSpeedFactor, $USER));	
				$consumption   				= FleetFunctions::GetFleetConsumption($rawfleetarray, $duration, $distance, $USER, $GameSpeedFactor);
				
				$shipscapa 					= $FleetRoom - $consumption;
				$ActualFleets				= FleetFunctions::GetCurrentFleets($USER['id']);
				
				if (FleetFunctions::GetMaxFleetSlots($USER) <= $ActualFleets){
					$EndLog[] = "Planet ".$sur['name']." [".$sur['galaxy'].":".$sur['system'].":".$sur['planet']."] : No fleetslots left anymore to order this mission.";
					continue;
				}elseif($sur['deuterium'] < $consumption){
					$EndLog[] = "Planet ".$sur['name']." [".$sur['galaxy'].":".$sur['system'].":".$sur['planet']."] : Not enough deuterium on departure planet to launch this mission.";
					continue; 
				}elseif($shipscapa < 0){
					$EndLog[] = "Planet ".$sur['name']." [".$sur['galaxy'].":".$sur['system'].":".$sur['planet']."] : Not enough capacity to ship the deuterium consumption for this mission";
					continue; 
				}
				
				//$sur['deuterium'] =-$consumption;
				$RecycledGoods	= array('metal' => 0, 'crystal' => 0, 'deuterium' => 0);
				// Step 1
				$RecycledGoods['metal']		= min($shipscapa, $sur['metal']);
				$shipscapa	-= $RecycledGoods['metal'];
				// Step 2
				$RecycledGoods['crystal'] 	= min($shipscapa, $sur['crystal']);
				$shipscapa	-= $RecycledGoods['crystal'];
				// Step 3
				$RecycledGoods['deuterium'] 		= min($shipscapa, $sur['deuterium']);
				$shipscapa	-= $RecycledGoods['deuterium'];
					
				$fleetResource	= array(
					901	=> max(0,$RecycledGoods['metal']),
					902	=> max(0,$RecycledGoods['crystal']),
					903	=> max(0,$RecycledGoods['deuterium']),
				);
				
				
				$sql	= "UPDATE %%PLANETS%% SET metal = metal - :metal, crystal = crystal - :crystal, deuterium = deuterium - :deuterium WHERE id = :id;";
				database::get()->update($sql, array(
					':metal'	=> $fleetResource[901],
					':crystal'	=> $fleetResource[902],
					':deuterium'=> $fleetResource[903],
					':id'		=> $Value
				));
				
				$fleetStartTime		= $duration + TIMESTAMP;
				$timeDifference		= round(max(0, $fleetStartTime - 0));
				$fleetStayTime		= $fleetStartTime;
				$fleetEndTime		= $fleetStayTime + $duration;
				$EndLog[] = "Planet ".$sur['name']." [".$sur['galaxy'].":".$sur['system'].":".$sur['planet']."] : The ships have received the mission and accepted it.";
				FleetFunctions::sendFleet($rawfleetarray, 3, $USER['id'], $sur['id'], $sur['galaxy'],
					$sur['system'], $sur['planet'], $sur['planet_type'], $PLANET['id_owner'],
					$PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $fleetResource,
					$fleetStartTime, $fleetStayTime, $fleetEndTime, $USER['ally_id']);
			}
			$this->printMessage(implode("<br>\r\n", $EndLog), true, array('game.php?page=reduceresources', 15));
		}
	}
	
	public function show()
	{
		global $LNG, $resource, $USER, $PLANET, $pricelist;
		
		//if($USER['id'] != 1)
			//$this->printMessage("This page will be again available very soon", true, array('game.php?page=overview', 2));
		
		if($PLANET['isAlliancePlanet'] != 0){
			$this->printMessage($LNG['autoexpedition_5'], true, array('game.php?page=overview', 2));
		}
		
		$PlanetListin	= array();
		$order 			= $USER['planet_sort_order'] == 1 ? "DESC" : "ASC" ;

		$sql = "SELECT * FROM %%PLANETS%% WHERE id_owner = :userId AND id != :planetId AND isAlliancePlanet = 0 ";
		
		switch($USER['gatheroptions'])
		{
			case 0:
				$sql	.= 'AND planet_type = 1 AND destruyed = 0 AND isAlliancePlanet = 0 ORDER BY ';
				break;
			case 1:
				$sql	.= 'AND planet_type != 1 AND destruyed = 0 AND isAlliancePlanet = 0 ORDER BY ';
				break;
			case 2:
				$sql	.= 'AND destruyed = 0 AND isAlliancePlanet = 0 ORDER BY ';
				break;
		}
		
		switch($USER['planet_sort'])
		{
			case 0:
				$sql	.= 'id '.$order;
				break;
			case 1:
				$sql	.= 'galaxy, system, planet, planet_type '.$order;
				break;
			case 2:
				$sql	.= 'name '.$order;
				break;
		}
		
		$planetsResult = Database::get()->select($sql, array(
			':userId'		=> $USER['id'],
			':planetId'		=> $PLANET['id']
		));
	
		$planetsList = array();
		$planetUpdater	= new ResourceUpdate();
		
		$TestCalcRoom   = array(217 => 1);
		$FleetRoomDark 	= FleetFunctions::GetFleetRoom($TestCalcRoom, $USER);
			
		foreach($planetsResult as $planetRow) {				
			list($USER, $planetRow)		= $planetUpdater->CalcResource($USER, $planetRow, true, TIMESTAMP);
				
			$GameSpeedFactor   		 	= FleetFunctions::GetGameSpeedFactor();		
			$MaxFleetSpeed 				= FleetFunctions::GetFleetMaxSpeed(217, $USER);
			$distance      				= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array($planetRow['galaxy'], $planetRow['system'], $planetRow['planet']));
			$duration      				= FleetFunctions::GetMissionDuration(10, $MaxFleetSpeed, $distance, $GameSpeedFactor, $USER);		
			
			$PlanetListin[$planetRow['id']] = array(
				'name'					=> $planetRow['name'],
				'galaxy'				=> $planetRow['galaxy'],
				'system'				=> $planetRow['system'],
				'planet'				=> $planetRow['planet'],
				'luna'					=> $planetRow['id_luna'],
				'metal'					=> $planetRow['metal'],
				'crystal'				=> $planetRow['crystal'],
				'deuterium'				=> $planetRow['deuterium'],
				'metal_max'				=> $planetRow['metal_max'],
				'crystal_max'			=> $planetRow['crystal_max'],
				'deuterium_max'			=> $planetRow['deuterium_max'],
				'ev_transporter'		=> $planetRow['ev_transporter'],
				'ev_necesary'			=> ($planetRow['metal'] + $planetRow['crystal'] + $planetRow['deuterium']) / $FleetRoomDark,
				'image'					=> $planetRow['image'],
				'duration'				=> gmdate("H:i:s", $duration),
			);
		}
		
		$this->tplObj->loadscript('reduce.js');
		$this->assign(array(
			'PlanetListin'		=> $PlanetListin,
			'planetsResult'		=> count($planetsResult),
		));

		$this->display('page.reduceresources.default.tpl');

	}
}
