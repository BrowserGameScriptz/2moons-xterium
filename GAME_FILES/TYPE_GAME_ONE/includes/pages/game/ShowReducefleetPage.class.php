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

 
$path	= 'includes/classes/Logger.class.php';
require($path);
class ShowReducefleetPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
		
	}
	
	public function reduce()
	{
		global $USER, $PLANET, $resource, $LNG, $pricelist, $reslist;
		
		
		if($PLANET['gal6mod'] == 1){
			$this->printMessage('Flights from the bonus planet are not possible', true, array('game.php?page=reducefleet', 2));
		}elseif (!isset($_POST['palanets'])){
			$this->redirectTo('game.php?page=reducefleet');
		}elseif ($USER['urlaubs_modus'] == 1){
			$this->redirectTo('game.php?page=reducefleet');
		}else{
			if (!isset($_POST['palanets']))
				$_POST['palanets'] = array();
			
			$speed  		= HTTP::_GP('speed', 10);
			$battleTypeId 	= HTTP::_GP('battleTypeId', -1);
			$transportTypeId= HTTP::_GP('transportTypeId', -1);
			$specialTypeId 	= HTTP::_GP('specialTypeId', -1);
			$proccesorTypeId= HTTP::_GP('proccesorTypeId', -1);
			
			$FleetStatCount  = 0;
			$FleetsTotalSend = 0;
			$FleetErrorSlots = 0;
			$FleetErrorConso = 0;
			$FleetErrorDeute = 0;
			
			$select_items	=	'';
			
			foreach(array_merge($reslist['defense'], $reslist['fleet'], $reslist['missile']) as $Item){
				$select_items		.= $resource[$Item].",";
			}	
			
			foreach($_POST['palanets'] as $ID => $Value) {
				$FleetStatCount++;
				$db	= Database::get();
				$sql	= 'SELECT '.$select_items.' id, id_owner, metal, crystal, deuterium, name, image, galaxy, system, planet, planet_type FROM %%PLANETS%% WHERE id = :Value;';
				$sur	= $db->selectSingle($sql, array(
					':Value'	=> $Value
				));
				
				$elementPlanetBattle		= array();
				$elementPlanetTransport		= array();
				$elementPlanetProcessorcs	= array();
				$elementPlanetSpecial		= array();
				if($battleTypeId == 0)
					$elementPlanetBattle		= array(204,205,229,206,207,215,213,211,224,225,226,214,216,227,230,228,222,218,221);
				if($transportTypeId == 0)
					$elementPlanetTransport		= array(202,203,217);
				if($proccesorTypeId == 0)
					$elementPlanetProcessorcs	= array(209,219);
				if($specialTypeId == 0)
					$elementPlanetSpecial		= array(208,210,220,223);
				$elementPlanet				= array_merge($elementPlanetBattle, $elementPlanetTransport, $elementPlanetProcessorcs, $elementPlanetSpecial);
				
				if(empty($elementPlanet)){
					$this->printMessage('No fleet types have been selected.', true, array('game.php?page=reducefleet', 2));
					exit;
				}
				
				$Fleet		= array();
				foreach ($elementPlanet as $id => $ShipID)
				{
					$amount		 				= max(0, round($sur[$resource[$ShipID]]));
					if ($amount < 1) continue;
						$Fleet[$ShipID]				= $amount;
				}
				
				
				$rawfleetarray				= $Fleet;
				if(empty($rawfleetarray))
					$this->redirectTo('game.php?page=reducefleet');
				
				$FleetRoom   		 		= FleetFunctions::GetFleetRoom($rawfleetarray, $USER);		
				$GameSpeedFactor   		 	= FleetFunctions::GetGameSpeedFactor();		
				$MaxFleetSpeed 				= FleetFunctions::GetFleetMaxSpeed($rawfleetarray, $USER);
				$distance      				= FleetFunctions::GetTargetDistance(array($sur['galaxy'], $sur['system'], $sur['planet']),array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']));
				$duration      				= max(5,FleetFunctions::GetMissionDuration($speed, $MaxFleetSpeed, $distance, $GameSpeedFactor, $USER));	
				$consumption   				= FleetFunctions::GetFleetConsumption($rawfleetarray, $duration, $distance, $USER, $GameSpeedFactor);
				
				$ActualFleets		= FleetFunctions::GetCurrentFleets($USER['id']);
				if (FleetFunctions::GetMaxFleetSlots($USER) <= $ActualFleets){
					$logger = new Logger();
					$logger->log(date('m-d-Y H:i:s') . ' ' . $_SERVER['REMOTE_ADDR']);
					$logger->log('RESULT: No free fleetslots');
					$FleetErrorSlots++;
					continue; 
				}
				
				if($sur['deuterium'] < $consumption){
					$logger = new Logger();
					$logger->log(date('m-d-Y H:i:s') . ' ' . $_SERVER['REMOTE_ADDR']);
					$logger->log('RESULT: Not enough deut on planet '.$sur['deuterium'].'-'.$consumption);
					$FleetErrorDeute++;
					continue; 
				}
				
				if($FleetRoom < $consumption){
					$logger = new Logger();
					$logger->log(date('m-d-Y H:i:s') . ' ' . $_SERVER['REMOTE_ADDR']);
					$logger->log('RESULT: capacity inferiour then comsumption '.$FleetRoom.'-'.$consumption);
					$FleetErrorConso++;
					continue; 
				}
			
				$fleetResource	= array(
					901	=> min(0, floor($sur['metal'])),
					902	=> min(0, floor($sur['crystal'])),
					903	=> min(0, floor($sur['deuterium'] - $consumption)),
				);
				
				$sql	= "UPDATE %%PLANETS%% SET deuterium = deuterium - :deuterium WHERE id = :id;";
				$db->update($sql, array(
					':deuterium'	=> $consumption,
					':id'	=> $Value
				));
				
				$fleetStartTime		= $duration + TIMESTAMP;
				$timeDifference		= round(max(0, $fleetStartTime - 0));
				$fleetStayTime		= $fleetStartTime;
				$fleetEndTime		= $fleetStayTime + $duration;
				
				FleetFunctions::sendFleet($rawfleetarray, 4, $USER['id'], $sur['id'], $sur['galaxy'],
					$sur['system'], $sur['planet'], $sur['planet_type'], $PLANET['id_owner'],
					$PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $fleetResource,
					$fleetStartTime, $fleetStayTime, $fleetEndTime, $USER['ally_id']);
				$FleetsTotalSend++;
			}
			$this->printMessage($LNG['reduce_res_7']." ".$FleetsTotalSend."/".$FleetStatCount, true, array('game.php?page=reducefleet', 2));
		}
	}
	
	public function show()
	{
		global $LNG, $resource, $USER, $PLANET, $pricelist, $reslist;
		
		//if($USER['id'] != 1)
			//$this->printMessage("This page will be again available very soon", true, array('game.php?page=overview', 2));
		
		if($PLANET['isAlliancePlanet'] != 0){
			$this->printMessage($LNG['autoexpedition_5'], true, array('game.php?page=overview', 2));
		}
	
		$Selected 	 	= HTTP::_GP('speed', 10);
		$battleTypeId 	= HTTP::_GP('battleTypeId', 0);
		$transportTypeId= HTTP::_GP('transportTypeId', 0);
		$specialTypeId 	= HTTP::_GP('specialTypeId', 0);
		$proccesorTypeId= HTTP::_GP('proccesorTypeId', 0);
		
		$PlanetListin	= array();
		$order 			= $USER['planet_sort_order'] == 1 ? "DESC" : "ASC" ;
		
		$select_items	=	'';
			
		foreach(array_merge($reslist['defense'], $reslist['fleet'], $reslist['missile'], $reslist['build']) as $Item){
			$select_items		.= $resource[$Item].",";
		}	

		$sql = "SELECT * FROM %%PLANETS%% WHERE id_owner = :userId AND id != :planetId ";
		
		
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
			':userId'	=> $USER['id'],
			':planetId'	=> $PLANET['id'],
		));
		
		$PlanetListin	= array();
		$TotalCount 	= 0;
		
		$PLANETS	= array($PLANET);
		
		$PlanetRess	= new ResourceUpdate();
		
		foreach ($planetsResult as $CPLANET)
		{
            list($USER, $CPLANET)	= $PlanetRess->CalcResource($USER, $CPLANET, true);
			
			$PLANETS[]	= $CPLANET;
			unset($CPLANET);
		}
		
		
		foreach($planetsResult as $planetRow) {		
			$FleetsOnPlanet = array();
			$elementPlanetBattle		= array();
			$elementPlanetTransport		= array();
			$elementPlanetProcessorcs	= array();
			$elementPlanetSpecial		= array();
			if($battleTypeId == 1)
				$elementPlanetBattle		= array(204,205,229,206,207,215,213,211,224,225,226,214,216,227,230,228,222,218,221);
			if($transportTypeId == 1)
				$elementPlanetTransport		= array(202,203,217);
			if($proccesorTypeId == 1)
				$elementPlanetProcessorcs	= array(209,219);
			if($specialTypeId == 1)
				$elementPlanetSpecial		= array(208,210,220,223);
			$elementPlanet				= array_merge($elementPlanetBattle, $elementPlanetTransport, $elementPlanetProcessorcs, $elementPlanetSpecial);
				
			//if(empty($elementPlanet)){
				//$this->printMessage('No fleet types have been selected, please go to the setting page ingame to select the fleet type u want to gather.', true, array('game.php?page=settings', 2));
				//exit;
			//}
		
			$Count = 0;
			foreach($elementPlanet as $FleetID)
			{
				if ($planetRow[$resource[$FleetID]] == 0)
					continue;
					
				$FleetsOnPlanet[]	= array(
					'id'	=> $FleetID,
					'count'	=> $planetRow[$resource[$FleetID]],
				);
			$Count += $planetRow[$resource[$FleetID]];
			$TotalCount += $planetRow[$resource[$FleetID]];
			}
			
			if($Count > 0){
				$rawfleetarray				= array();
				
				foreach($elementPlanet as $fleet){
					if($planetRow[$resource[$fleet]] > 0)
						$rawfleetarray[$fleet] = $planetRow[$resource[$fleet]];
				}
				$GameSpeedFactor   		 	= FleetFunctions::GetGameSpeedFactor();		
				$MaxFleetSpeed 				= FleetFunctions::GetFleetMaxSpeed($rawfleetarray, $USER);
				$distance      				= FleetFunctions::GetTargetDistance(array($planetRow['galaxy'], $planetRow['system'], $planetRow['planet']),array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']));
				$duration      				= FleetFunctions::GetMissionDuration($Selected, $MaxFleetSpeed, $distance, $GameSpeedFactor, $USER);	
				$consumption   				= FleetFunctions::GetFleetConsumption($rawfleetarray, $duration, $distance, $USER, $GameSpeedFactor);
			
					
				$PlanetListin[$planetRow['id']] = array(
					'name'					=> $planetRow['name'],
					'galaxy'				=> $planetRow['galaxy'],
					'system'				=> $planetRow['system'],
					'planet'				=> $planetRow['planet'],
					'ev_transporter'		=> $planetRow['ev_transporter'],
					'deuterium'				=> $planetRow['deuterium'],
					'image'					=> $planetRow['image'],
					'Count'					=> $Count,
					'FleetsOnPlanet'		=> $FleetsOnPlanet,
					'consumption'			=> $consumption,
					'duration'				=> gmdate("H:i:s", $duration),
					
				);

			}
		}
		
		$this->tplObj->loadscript('reduce.js');
		$this->assign(array(
			'TotalCount'		=> $TotalCount,
			'PlanetListin'		=> $PlanetListin,
			'Selected'			=> $Selected,
			'planetsResult'		=> count($planetsResult),
			'Selectors'			=> array(10 => 100, 9 => 90, 8 => 80, 7 => 70, 6 => 60, 5 => 50, 4 => 40, 3 => 30, 2 => 20, 1 => 10),
			'battleTypeId'		=> $battleTypeId,
			'transportTypeId'	=> $transportTypeId,
			'specialTypeId'		=> $specialTypeId,
			'proccesorTypeId'	=> $proccesorTypeId,
		));
		
		$this->display('page.reducefleet.default.tpl');

	}
}
