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

class ShowDeliveryresPage extends AbstractGamePage
{

	function __construct()
	{
		parent::__construct();
	}

	public function delivery()
	{
		global $USER, $PLANET, $resource, $LNG, $pricelist;
		
		if($PLANET['gal6mod'] == 1){
			$this->printMessage('Flights from the bonus planet are not possible', true, array('game.php?page=deliveryres', 2));
		}elseif (!isset($_POST['palanets'])){
			$this->redirectTo('game.php?page=deliveryres');
		}elseif ($USER['urlaubs_modus'] == 1){
			$this->redirectTo('game.php?page=deliveryres');
		}else{
			if (!isset($_POST['palanets']))
				$_POST['palanets'] = array();
		
			$sendMetal 		= HTTP::_GP('r901', 0);
			$sendCrystal 	= HTTP::_GP('r902', 0);
			$sendDeuterium 	= HTTP::_GP('r903', 0);
			$EndLog			= array();
			$TestCalcRoom   = array(217 => 1);
			$FleetRoom   	= FleetFunctions::GetFleetRoom($TestCalcRoom, $USER);	
			
			foreach($_POST['palanets'] as $ID => $Value) {
				
				$sql	= 'SELECT antimatter, antimatter_bought FROM %%USERS%% WHERE id = :userId;';
				$getUser = database::get()->selectSingle($sql, array(
					':userId'		=> $USER['id'],
				));
				
				$sql	= 'SELECT id, id_owner, ev_transporter, metal, crystal, deuterium, galaxy, system, planet, planet_type FROM %%PLANETS%% WHERE id = :planetId;';
				$getPlanet = database::get()->selectSingle($sql, array(
					':planetId'		=> $PLANET['id'],
				));
				
				if (($getUser['antimatter'] + $getUser['antimatter_bought']) < 10){
					$this->redirectTo('game.php?page=deliveryres');
				}else{
					$sql = 'SELECT id, id_owner, name, galaxy, system, planet, planet_type FROM %%PLANETS%% WHERE id = :Value;';
					$sur = database::get()->selectSingle($sql, array(
						':Value'	=> $Value
					));
					
					$sendMetal 		= min($getPlanet['metal'], $sendMetal);
					$sendCrystal 	= min($getPlanet['crystal'], $sendCrystal);
					$sendDeuterium 	= min($getPlanet['deuterium'], $sendDeuterium);
					
					$total_res 		= $sendMetal + $sendCrystal + $sendDeuterium;
					$needed_ships 	= max(1,($sendMetal + $sendCrystal + $sendDeuterium) / $FleetRoom);
					$needed_ships 	= min($needed_ships, $getPlanet['ev_transporter']);
					
					if(empty($needed_ships)){
						$EndLog[] = "Planet ".$sur['name']." [".$sur['galaxy'].":".$sur['system'].":".$sur['planet']."] : Not enough ships on departure planet.";
						continue;
					}
					
					$rawfleetarray	= array(217 => $needed_ships);
					$GameSpeedFactor= FleetFunctions::GetGameSpeedFactor();		
					$MaxFleetSpeed 	= FleetFunctions::GetFleetMaxSpeed($rawfleetarray, $USER);
					$distance		= FleetFunctions::GetTargetDistance(array($getPlanet['galaxy'], $getPlanet['system'], $getPlanet['planet']),array($sur['galaxy'], $sur['system'], $sur['planet']));
					$duration		= FleetFunctions::GetMissionDuration(10, $MaxFleetSpeed, $distance, $GameSpeedFactor, $USER);	
					$consumption   	= FleetFunctions::GetFleetConsumption($rawfleetarray, $duration, $distance, $USER, $GameSpeedFactor);
					
					$shipscapa 		= ($needed_ships * $FleetRoom) - $consumption;
					$ActualFleets	= FleetFunctions::GetCurrentFleets($USER['id']);
					
					if (FleetFunctions::GetMaxFleetSlots($USER) <= $ActualFleets){
						$EndLog[] = "Planet ".$sur['name']." [".$sur['galaxy'].":".$sur['system'].":".$sur['planet']."] : No fleetslots left anymore to order this mission.";
						continue;
					}
					
					if($getPlanet['deuterium'] < $consumption){
						$EndLog[] = "Planet ".$sur['name']." [".$sur['galaxy'].":".$sur['system'].":".$sur['planet']."] : Not enough deuterium on departure planet to launch this mission.";
						continue; 
					}
					if($shipscapa < 0){
						$EndLog[] = "Planet ".$sur['name']." [".$sur['galaxy'].":".$sur['system'].":".$sur['planet']."] : Not enough capacity to ship the deuterium consumption for this mission";
						continue; 
					}
					
					//$sendDeuterium -= $consumption;
					
					$RecycledGoods	= array('metal' => 0, 'crystal' => 0, 'deuterium' => 0);
					// Step 1
					$RecycledGoods['metal']		= min($shipscapa, $sendMetal);
					$shipscapa	-= $RecycledGoods['metal'];
					// Step 2
					$RecycledGoods['crystal'] 	= min($shipscapa, $sendCrystal);
					$shipscapa	-= $RecycledGoods['crystal'];
					// Step 3
					$RecycledGoods['deuterium'] 		= min($shipscapa, $sendDeuterium);
					$shipscapa	-= $RecycledGoods['deuterium'];
					
					
					$fleetResource	= array(
						901	=> max(0,$RecycledGoods['metal']),
						902	=> max(0,$RecycledGoods['crystal']),
						903	=> max(0,$RecycledGoods['deuterium']),
					);
					
					$PLANET['metal'] 	-= $fleetResource[901];
					$PLANET['crystal'] 	-= $fleetResource[902];
					$PLANET['deuterium'] -= $fleetResource[903];
					
					$sql	= "UPDATE %%PLANETS%% SET metal = metal - :metal, crystal = crystal - :crystal, deuterium = deuterium - :deuterium WHERE id = :id;";
					database::get()->update($sql, array(
						':metal'	=> $fleetResource[901],
						':crystal'	=> $fleetResource[902],
						':deuterium'=> $fleetResource[903],
						':id'		=> $getPlanet['id']
					));
					
					$fleetStartTime		= $duration + TIMESTAMP;
					$timeDifference		= round(max(0, $fleetStartTime - 0));
					$fleetStayTime		= $fleetStartTime;
					$fleetEndTime		= $fleetStayTime + $duration;
					$EndLog[] = "Planet ".$sur['name']." [".$sur['galaxy'].":".$sur['system'].":".$sur['planet']."] : The ships have received the mission and accepted it.";
					FleetFunctions::sendFleet($rawfleetarray, 3, $USER['id'], $getPlanet['id'], $getPlanet['galaxy'],
						$getPlanet['system'], $getPlanet['planet'], $getPlanet['planet_type'], $sur['id_owner'],
						$sur['id'], $sur['galaxy'], $sur['system'], $sur['planet'], $sur['planet_type'], $fleetResource,
						$fleetStartTime, $fleetStayTime, $fleetEndTime, $USER['ally_id']);
						
					$this->widrawAm(10, $USER['id']);
				}
			}
			PlayerUtil::sendMessage($USER['id'], $USER['id'], $USER['username'], 5, "Deliver Resource Module", implode("<br>\r\n", $EndLog), TIMESTAMP);
			$this->printMessage(implode("<br>\r\n", $EndLog), true, array('game.php?page=deliveryres', 15));
		}
	}
	
	function show()
	{	
		global $LNG, $resource, $USER, $PLANET, $pricelist;
			
			
		//if($USER['id'] != 1)
			//$this->printMessage("This function will be again available in a few minutes !", true, array('game.php?page=overview', 2));
		
		if($PLANET['isAlliancePlanet'] != 0){
			$this->printMessage($LNG['autoexpedition_5'], true, array('game.php?page=overview', 2));
		}
			
		$PlanetListin	= array();
		$order = $USER['planet_sort_order'] == 1 ? "DESC" : "ASC" ;

		$sql = "SELECT id, id_owner, name, universe, galaxy, system, planet, planet_type, metal, crystal, deuterium, metal_max, crystal_max, deuterium_max, image, id_luna, ev_transporter, b_building, eco_hash, last_update, b_building_id, field_current, b_hangar_id, b_defense_id, metal_perhour, crystal_perhour, deuterium_perhour, energy, energy_used, b_hangar, b_defense, darkmatter_perhour FROM %%PLANETS%% WHERE id_owner = :userId AND id != :planetId AND destruyed = 0 AND isAlliancePlanet = 0 ORDER BY ";

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

		foreach($planetsResult as $planetRow) {
		
			$planetUpdater	= new ResourceUpdate();
				
			list($USER, $planetRow)	= $planetUpdater->CalcResource($USER, $planetRow, true, TIMESTAMP);
			
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
				'planet_type'			=> $planetRow['planet_type'],
				'image'					=> $planetRow['image'],
				'duration'		=> gmdate("H:i:s", $duration),	
			);
				
		}
		
		$sql	= "SELECT COUNT(*) as total FROM %%PLANETS%% WHERE id_owner = :userId AND id != :planetId AND destruyed = 0 AND planet_type = 1;";
		$planetsCount = Database::get()->selectSingle($sql, array(
			':userId'		=> $USER['id'],
			':planetId'		=> $PLANET['id']
		));
		
		$sql	= "SELECT COUNT(*) as total FROM %%PLANETS%% WHERE id_owner = :userId AND id != :planetId AND destruyed = 0 AND planet_type != 1;";
		$moonsCount = Database::get()->selectSingle($sql, array(
			':userId'		=> $USER['id'],
			':planetId'		=> $PLANET['id']
		));
			
		$rawfleetarray				= array(217 => 1);
		$FleetRoom   		 		= FleetFunctions::GetFleetRoom($rawfleetarray, $USER);	
		
		$this->tplObj->loadscript('deliveryres.js');
		$this->assign(array(
			'ev_transportersw'		=> $PLANET['ev_transporter'],
			'FleetRoomDeliver'		=> $FleetRoom,
			'planetsCount'			=> $planetsCount['total'],
			'moonsCount'			=> $moonsCount['total'],
			'PlanetListin'			=> $PlanetListin,
			'planetsResult'			=> count($planetsResult),
		));
			
		$this->display('page.deliveryres.default.tpl');
	}
}