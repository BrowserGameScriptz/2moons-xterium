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
 

class ShowShipyardMultiPage extends AbstractGamePage
{
	public static $requireModule = 0;
	
	function __construct() 
	{
		parent::__construct();
	}
	
	function getMaxConstructibleElementsMulti($USER, $Data, $Element, $elementPrice = NULL)
	{
		global $resource, $reslist;
		
		if(!isset($elementPrice)) {
			$elementPrice	= BuildFunctions::getElementPrice($USER, $Data, $Element);
		}
		$maxElement	= array();
		
		foreach($elementPrice as $resourceID => $price)
		{
			if(isset($Data[$resource[$resourceID]]))
			{
				$maxElement[]	= floor($Data[$resource[$resourceID]] / $price);
			}
			elseif(isset($USER[$resource[$resourceID]]))
			{
				$maxElement[]	= floor($USER[$resource[$resourceID]] / $price);
			}
			else
			{
				throw new Exception("Unknown Ressource ".$resourceID." at element ".$Element.".");
			}
		}
		
		if(in_array($Element, $reslist['one'])) {
			$maxElement[]	= 1;
		}
		
		return min($maxElement);
	}
	
	function send(){
		global $USER, $LNG, $pricelist, $resource, $PLANET;
		
		$shipID			= HTTP::_GP('shipID', 0);
		$CountDefault	= max(0, round(HTTP::_GP('count', 0.0)));
		$allowedShipIDs	= array(202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,225,226,227,228,229,224,230);
		//$this->printMessage($Count);
		$EndLog			= array();
		if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($shipID) && !empty($CountDefault) && in_array($shipID, $allowedShipIDs) && $CountDefault > 0)
		{
			
			$sql	= "SELECT * FROM %%PLANETS%% WHERE id_owner = :idOwner AND destruyed = 0 AND gal6mod = 0";
			if($USER['multibuild'] == 0)
				$sql	.= ' AND planet_type = 1';
			elseif($USER['multibuild'] == 1)
				$sql	.= ' AND planet_type != 1';
			elseif($USER['multibuild'] == 2)
				$sql	.= '';
			else
				$sql	.= ' AND planet_type = 1';
				
			$getPlayerPlanetsMoud = database::get()->select($sql, array(
				':idOwner'	=> $USER['id'] 
			));

			foreach($getPlayerPlanetsMoud as $Data){
				//CHECK IF REQUIREMENTS ARE MET
				$isPremiumActive = 0;
				if($USER['prem_prime_units_days'] > TIMESTAMP || Config::get()->primebuild == 1 || config::get(ROOT_UNI)->happyHourEvent == 11 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP){
					$isPremiumActive = 1;
				}
				if($Data['id'] != $PLANET['id']){
					$requirementsMet = BuildFunctions::isTechnologieAccessible($USER, $Data, $shipID);
					$ElementQueue 	= unserialize($Data['b_hangar_id']);
					if(empty($ElementQueue))
						$Count	= 0;
					else
						$Count	= count($ElementQueue);
				}else{
					$requirementsMet = BuildFunctions::isTechnologieAccessible($USER, $PLANET, $shipID);
					$ElementQueue 	= unserialize($PLANET['b_hangar_id']);
					if(empty($ElementQueue))
						$Count	= 0;
					else
						$Count	= count($ElementQueue);
				//END CHECK IF REQUIREMENTS ARE MET
				}
				$maxBuildQueue	= Config::get()->max_elements_ships;
				
				if(!$requirementsMet){
					$EndLog[] = "Planet ".$Data['name']." [".$Data['galaxy'].":".$Data['system'].":".$Data['planet']."] : The requiremets are not met on this planet";
					continue;
				}elseif($isPremiumActive == 0 && in_array($shipID, array(224,229,230))){
					$EndLog[] = "Planet ".$Data['name']." [".$Data['galaxy'].":".$Data['system'].":".$Data['planet']."] : The premium feature is not activated";
					continue;
				}elseif($maxBuildQueue != 0 && $Count >= $maxBuildQueue)
				{
					$EndLog[] = "Planet ".$Data['name']." [".$Data['galaxy'].":".$Data['system'].":".$Data['planet']."] : ".sprintf($LNG['bd_max_builds'], $maxBuildQueue);
				}else{
					if($Data['id'] != $PLANET['id']){
						$Missiles	= array(
							502	=> $Data[$resource[502]],
							503	=> $Data[$resource[503]],
						);
						$Domes	= array(
							407	=> $Data[$resource[407]],
							408	=> $Data[$resource[408]],
							409	=> $Data[$resource[409]],
						);
						$Orbits	= array(
							411	=> $Data[$resource[411]],
						);
				
						$MaxElements 	= self::getMaxConstructibleElementsMulti($USER, $Data, $shipID);
						$Count			= is_numeric($CountDefault) ? round($CountDefault) : 0;
						$Count 			= max(min($Count, Config::get()->max_fleet_per_build), 0);
						$Count 			= min($Count, $MaxElements);	
						
						if(empty($Count)){
							$EndLog[] = "Planet ".$Data['name']." [".$Data['galaxy'].":".$Data['system'].":".$Data['planet']."] : nothing could be build on this planet";
							continue;
						}else{				
							//$this->printMessage($MaxElements);
							if($shipID < 400)
								$BuildArray    	= !empty($Data['b_hangar_id']) ? unserialize($Data['b_hangar_id']) : array();
							else
								$BuildArray    	= !empty($Data['b_defense_id']) ? unserialize($Data['b_defense_id']) : array();
							$MissileArray	= array(502,503);
							if (in_array($shipID, $MissileArray))
							{
								$MaxMissiles		= BuildFunctions::getMaxConstructibleRockets($USER, $Data, $Missiles);
								$Count 				= min($Count, $MaxMissiles[$shipID]);

								$Missiles[$shipID] += $Count;
							}elseif ($shipID == 407 || $shipID == 408 || $shipID == 409)
							{
								$MaxDomes		= BuildFunctions::getMaxConstructibleDomes($USER, $Data, $Domes);
							
								$Count 				= min($Count, $MaxDomes[$shipID]);
								
								$Domes[$shipID] += $Count;
							}elseif ($shipID == 411)
							{
								$MaxOrbits		= BuildFunctions::getMaxConstructibleOrbits($USER, $Data, $Orbits);
							
								$Count 				= min($Count, $MaxOrbits[$shipID]);
								
								$Orbits[$shipID] += $Count;
							}
							
							$costResources	= BuildFunctions::getElementPrice($USER, $Data, $shipID, false, $Count);
					
						
							if(isset($costResources[901])) { $Data[$resource[901]]	-= $costResources[901]; }
							if(isset($costResources[902])) { $Data[$resource[902]]	-= $costResources[902]; }
							if(isset($costResources[903])) { $Data[$resource[903]]	-= $costResources[903]; }
							if(isset($costResources[921])) { $USER[$resource[921]]	-= $costResources[921]; }
							if(isset($costResources[922])) { $USER[$resource[922]]	-= $costResources[922]; }
							
							$BuildArray[]			= array($shipID, $Count);
							
							if($shipID < 400){
								$Data['b_hangar_id']	= serialize($BuildArray);
								$sql	= "UPDATE %%PLANETS%% SET metal = metal - :metal, crystal = crystal - :crystal, deuterium = deuterium - :deuterium, b_hangar_id = :b_hangar_id WHERE id = :planetId;";
								database::get()->update($sql, array(
									':metal'		=> isset($costResources[901]) ? $costResources[901] : 0,
									':crystal'		=> isset($costResources[902]) ? $costResources[902] : 0,
									':deuterium'	=> isset($costResources[903]) ? $costResources[903] : 0,
									':b_hangar_id'	=> serialize($BuildArray), 
									':planetId'		=> $Data['id'] 
								));
							}else{
								$Data['b_defense_id']	= serialize($BuildArray);
								$sql	= "UPDATE %%PLANETS%% SET metal = metal - :metal, crystal = crystal - :crystal, deuterium = deuterium - :deuterium, b_defense_id = :b_defense_id WHERE id = :planetId;";
								database::get()->update($sql, array(
									':metal'		=> isset($costResources[901]) ? $costResources[901] : 0,
									':crystal'		=> isset($costResources[902]) ? $costResources[902] : 0,
									':deuterium'	=> isset($costResources[903]) ? $costResources[903] : 0,
									':b_defense_id'	=> serialize($BuildArray), 
									':planetId'		=> $Data['id'] 
								));
							}
							$EndLog[] = "Planet ".$Data['name']." [".$Data['galaxy'].":".$Data['system'].":".$Data['planet']."] : ".$Count." ships have been added in the construction queue";
						}
					}elseif($Data['id'] == $PLANET['id']){
						$Missiles	= array(
							502	=> $PLANET[$resource[502]],
							503	=> $PLANET[$resource[503]],
						);
						$Domes	= array(
							407	=> $PLANET[$resource[407]],
							408	=> $PLANET[$resource[408]],
							409	=> $PLANET[$resource[409]],
						);
						$Orbits	= array(
							411	=> $PLANET[$resource[411]],
						);
						
						$MaxElements 	= self::getMaxConstructibleElementsMulti($USER, $PLANET, $shipID);
						$Count			= is_numeric($CountDefault) ? round($CountDefault) : 0;
						$Count 			= max(min($Count, Config::get()->max_fleet_per_build), 0);
						$Count 			= min($Count, $MaxElements);				
						//$this->printMessage($MaxElements);
						if(empty($Count)){
							$EndLog[] = "Planet ".$PLANET['name']." [".$PLANET['galaxy'].":".$PLANET['system'].":".$PLANET['planet']."] : nothing could be build on this planet";
							continue;
						}else{	
							if($shipID < 400)
								$BuildArray    	= !empty($PLANET['b_hangar_id']) ? unserialize($PLANET['b_hangar_id']) : array();
							else
								$BuildArray    	= !empty($PLANET['b_defense_id']) ? unserialize($PLANET['b_defense_id']) : array();
							$MissileArray	= array(502,503);
							if (in_array($shipID, $MissileArray))
							{
								$MaxMissiles		= BuildFunctions::getMaxConstructibleRockets($USER, $PLANET, $Missiles);
								$Count 				= min($Count, $MaxMissiles[$shipID]);

								$Missiles[$shipID] += $Count;
							}elseif ($shipID == 407 || $shipID == 408 || $shipID == 409)
							{
								$MaxDomes		= BuildFunctions::getMaxConstructibleDomes($USER, $PLANET, $Domes);
							
								$Count 				= min($Count, $MaxDomes[$shipID]);
								
								$Domes[$shipID] += $Count;
							}elseif ($shipID == 411)
							{
								$MaxOrbits		= BuildFunctions::getMaxConstructibleOrbits($USER, $PLANET, $Orbits);
							
								$Count 				= min($Count, $MaxOrbits[$shipID]);
								
								$Orbits[$shipID] += $Count;
							}
							
							$costResources	= BuildFunctions::getElementPrice($USER, $PLANET, $shipID, false, $Count);
							
							if(isset($costResources[901])) { $PLANET[$resource[901]]	-= $costResources[901]; }
							if(isset($costResources[902])) { $PLANET[$resource[902]]	-= $costResources[902]; }
							if(isset($costResources[903])) { $PLANET[$resource[903]]	-= $costResources[903]; }
							if(isset($costResources[921])) { $USER[$resource[921]]	-= $costResources[921]; }
							if(isset($costResources[922])) { $USER[$resource[922]]	-= $costResources[922]; }
							
							$BuildArray[]			= array($shipID, $Count);
							if($shipID < 400)
								$PLANET['b_hangar_id']	= serialize($BuildArray);
							else
								$PLANET['b_defense_id']	= serialize($BuildArray);
							$EndLog[] = "Planet ".$PLANET['name']." [".$PLANET['galaxy'].":".$PLANET['system'].":".$PLANET['planet']."] : ".$Count." ships have been added in the construction queue";
						}
					}
				}
			}
            $this->printMessage(implode("<br>\r\n", $EndLog), true, array('game.php?page=shipyardMulti', 15));

		}else{
			$this->printMessage("You are going to be redirected in 3 seconds", true, array('game.php?page=shipyardMulti', 3));
		}
	}
	
	function show()
	{
		global $PLANET, $LNG, $pricelist, $resource, $reslist, $USER;
		//if($USER['id'] != 1)
			//$this->printMessage('available very soon');
		$Cost		= array();
		
		$allowedShipIDs	= array(202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,225,226,227,228,229,224,230);
		
		foreach($allowedShipIDs as $shipID)
		{
			if(in_array($shipID, $reslist['fleet']) || in_array($shipID, $reslist['defense'])) {
				$costResources	= BuildFunctions::getElementPrice($USER, $PLANET, $shipID, false);
				$Cost[$shipID]	= array($PLANET[$resource[$shipID]], $LNG['tech'][$shipID], $costResources);
			}
		}
		
		if(empty($Cost))
		{
			$this->printMessage($LNG['ft_empty'], array(array(
				'label'	=> $LNG['sys_back'],
				'url'	=> 'game.php?page=fleetDealer'
			)));
		}

		$this->assign(array(
			'shipIDs'	=> $allowedShipIDs,
			'CostInfos'	=> $Cost,
			'Charge'	=> Config::get()->trade_charge,
		));
		
		$this->display('page.shipyard.multi.tpl');
	}
}