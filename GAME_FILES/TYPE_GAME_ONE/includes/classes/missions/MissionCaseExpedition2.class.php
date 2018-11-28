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
class MissionCaseExpedition2 extends MissionFunctions implements Mission
{
	function __construct($fleet)
	{
		$this->_fleet	= $fleet;
	}
	
	function TargetEvent()
	{
		$this->setState(FLEET_HOLD);
		$this->SaveFleet();
	}
	
	function EndStayEvent()
	{
		global $pricelist, $reslist, $resource;
		$LNG	= $this->getLanguage(NULL, $this->_fleet['fleet_owner']);
		
		$config	= Config::get($this->_fleet['fleet_universe']);

		$sql			= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$ownerUser		= Database::get()->selectSingle($sql, array(
			':userId'	=> $this->_fleet['fleet_owner']
		));

		$getGalaxySevenAccount = getGalaxySevenAccount($ownerUser);
		$getGalaxySevenUpgrade = $getGalaxySevenAccount['findUpgrade'];
		$getGalaxySevenBonus   = $getGalaxySevenAccount['bonusExpe'];
		//$getGalaxySevenStellar = $getGalaxySevenAccount['findStellar'];
			
		//Expedition Variables
		$FindResource		= $config->expe_chance_res; // trouver un certain nombre de ressources (métal, cristal ou deutérium).
		if(config::get(ROOT_UNI)->happyHourEvent == 7 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
			$FindResource 	= $FindResource * config::get()->happyHourBonus;
			
		$FindDarkmatter 	= $config->expe_chance_dark; // trouver un certain nombre de TM.
		if(config::get(ROOT_UNI)->happyHourEvent == 10 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
			$FindDarkmatter = $FindDarkmatter * config::get()->happyHourBonus;
		
		$FindFleets			= $config->expe_chance_fleets; // pour trouver la flotte.
		if(config::get(ROOT_UNI)->happyHourEvent == 8 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
			$FindFleets 	= $FindFleets * config::get()->happyHourBonus;
			
		$FindHostile		= $config->expe_chance_hostile; // trébuchent sur un Pirates ou étrangers.
		//$FindStellarOre		= 0.5 + $getGalaxySevenStellar; // trouver des stellar ore
		$FindBlackHole  	= $config->expe_chance_hole;  // de perdre sa flotte.
		$FindTimeChange 	= $config->expe_chance_change; // pour changer l'heure (plus ou moins) Vol de retour.
		$FindChangeRes  	= $config->expe_chance_converter; // change resource in another type if transported in function of game ratio with small loss, in case of none then invalid
		$FindArsenal    	= $config->expe_chance_arsenal + $getGalaxySevenUpgrade; // find arsenal items if > 75.000 points
		if(config::get(ROOT_UNI)->happyHourEvent == 9 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
			$FindArsenal 	= $FindArsenal * config::get()->happyHourBonus;
		
		$FindResource1		= 0;
		$FindDarkmatter1 	= 0;
		$FindFleets1		= 0;
		$FindHostile1		= 0;
		$FindBlackHole1  	= mt_rand(1,100);
		$FindTimeChange1 	= 0;
		$FindChangeRes1  	= 0;
		$FindArsenal1    	= 0;
		//$FindStellarOre1    = mt_rand(0,1000)/10;
		
		$Message        	= $LNG['sys_expe_nothing_'.mt_rand(1,8)];
		
		$fleetPoints 		= 0; // L'indicateur du joueur - la somme des points de la flotte  (quantité de ressources consacrées à la flotte / 1.000.000)
		$fleetCapacity		= 0; // capacité total de la flotte envoyer sur expedition
		$academy_p_b_2_1207	= 0; // bonus capacite pour la partie acacemy
		$FindableDarkmatter = 0;
		
		if($ownerUser['academy_p_b_2_1207'] > 0){
			$academy_p_b_2_1207 = $ownerUser['academy_p_b_2_1207'] * 5;
		}
		
		$premium_expe_bonus = 0;
		if($ownerUser['prem_expedition'] > 0 && $ownerUser['prem_expedition_days'] > TIMESTAMP){
			$premium_expe_bonus = $ownerUser['prem_expedition'];
		}
		
		$fleetArray		= FleetFunctions::unserialize($this->_fleet['fleet_array']); 
		foreach ($fleetArray as $shipId => $shipAmount)
		{
			$fleetCapacity 			   	+= $shipAmount * $pricelist[$shipId]['capacity'];
			$fleetPoints   			   	+= $shipAmount * $pricelist[$shipId]['fleetPointExpe'];
		}
			
		$fleetCapacity += $fleetCapacity / 100 * $academy_p_b_2_1207;
		$fleetCapacity -= $this->_fleet['fleet_resource_metal'] + $this->_fleet['fleet_resource_crystal'] + $this->_fleet['fleet_resource_deuterium'] + $this->_fleet['fleet_resource_darkmatter'];
		$totalResource = $this->_fleet['fleet_resource_metal'] + $this->_fleet['fleet_resource_crystal'] + $this->_fleet['fleet_resource_deuterium'] + $this->_fleet['fleet_resource_darkmatter'];
		
		
		$FindSize   	= mt_rand(0, 100);
		$varis 			= "";
		
		$eventCase		= array(1,2,3,4,5,6,7,8,9); // tout les evennement possible
		if($config->cosmonaute_status == 1 || $config->new_year_status == 1 || $config->halloween_event == 1)
			$eventCase		= array(1,2,3,4,5,6,7,8,9,10); // tout les evenement possible si cosmonaut activé on ajoute evennement 10
		
		$eventCaseRand	= array_rand($eventCase, 1); // on choisi aleatoirement un des numero dans la liste des evennement
		$eventCase		= $eventCase[$eventCaseRand]; // on valide ce numero en tant que evenement
		$chanceToFail 	= 30; // chance d'echec pour un ratio 1/3
		$chanceToSuccess= mt_rand(1,100); // chance de reusite un nombre aleatoire entre 1 et 100
		if($chanceToFail >= $chanceToSuccess) // si 30 >= au chiffre aleatoire
			$eventCase = 0; // alors on comfirme un event qui existe pas donc revient vide.
		
		/* if($this->_fleet['fleet_owner'] == 1)
			$eventCase 	= 9; */
		
		switch ($eventCase) { 
			case 1:
			if(50 > mt_rand(1,100)){
				//RESOURCE
				$sql		= "UPDATE %%LOG_FLEETS%% SET expeEvent = :expeEvent WHERE fleet_id = :fleet_id;";
				database::get()->update($sql, array(
					':expeEvent'	=> 1,
					':fleet_id'		=> $this->_fleet['fleet_id']
				)); 
				//INGREDIENT FORMULE
				$gameSpeed 			= 200; // Indicateur sur le serveur - Le taux d'extraction des ressources
				$FactorWeightPoint 	= 1 + $config->resource_multiplier / 1000;
				$FactorMaxRess		= 5 + $config->resource_multiplier / 50;
				$eventAction		= 0 + $getGalaxySevenBonus; // variable to add in admin panel to add automatic events for expeditions
				$randomValue		= mt_rand(0,100);
				$BonusRees 			= ($ownerUser['combat_exp_expedition'] + $premium_expe_bonus) + $eventAction + ((($this->_fleet['fleet_end_stay'] - $this->_fleet['fleet_start_time']) / 320) * 2);
			
				if(89 <= $randomValue){
					$FactorRessMetal 		= mt_rand(10,50) * $config->resource_multiplier * $FactorMaxRess;
					$FactorRessCristal 		= mt_rand(5,25) * $config->resource_multiplier * $FactorMaxRess;
					$FactorRessDeutérium 	= (mt_rand(33,167)/10) * $config->resource_multiplier * $FactorMaxRess;
					/* $FactorRessMetal 		= mt_rand(50,250) * $config->resource_multiplier * $FactorMaxRess;
					$FactorRessCristal 		= mt_rand(25,125) * $config->resource_multiplier * $FactorMaxRess;
					$FactorRessDeutérium 	= (mt_rand(166,833)/10) * $config->resource_multiplier * $FactorMaxRess; */
					$MaxFleetPoints			= 9000000 * $FactorWeightPoint;
					$Message				= $LNG['sys_expe_found_ress_1_'.mt_rand(1,4)];
				}elseif(1 < $randomValue && 89 > $randomValue){
					$FactorRessMetal 		= mt_rand(52,100) * $config->resource_multiplier * $FactorMaxRess;
					$FactorRessCristal 		= mt_rand(26,50) * $config->resource_multiplier * $FactorMaxRess;
					$FactorRessDeutérium 	= (mt_rand(173,333)/10) * $config->resource_multiplier * $FactorMaxRess;
					/* $FactorRessMetal 		= mt_rand(260,500) * $config->resource_multiplier * $FactorMaxRess;
					$FactorRessCristal 		= mt_rand(130,250) * $config->resource_multiplier * $FactorMaxRess;
					$FactorRessDeutérium 	= (mt_rand(866,1666)/10) * $config->resource_multiplier * $FactorMaxRess; */
					$MaxFleetPoints			= 10000000 * $FactorWeightPoint;
					$Message				= $LNG['sys_expe_found_ress_2_'.mt_rand(1,3)];
				}elseif(0 <= $randomValue && 2 > $randomValue){
					$FactorRessMetal 		= mt_rand(102,200) * $config->resource_multiplier * $FactorMaxRess;
					$FactorRessCristal 		= mt_rand(51,100) * $config->resource_multiplier * $FactorMaxRess;
				    $FactorRessDeutérium 	= (mt_rand(280,460)/10) * $config->resource_multiplier * $FactorMaxRess;
					/*$FactorRessDeutérium 	= (mt_rand(340,667)/10) * $config->resource_multiplier * $FactorMaxRess;
					 $FactorRessMetal 		= mt_rand(750,1500) * $config->resource_multiplier * $FactorMaxRess;
					$FactorRessCristal 		= mt_rand(375,750) * $config->resource_multiplier * $FactorMaxRess;
					$FactorRessDeutérium 	= mt_rand(250,500) * $config->resource_multiplier * $FactorMaxRess; */
					$MaxFleetPoints			= 12000000 * $FactorWeightPoint;	
					$Message				= $LNG['sys_expe_found_ress_3_'.mt_rand(1,2)];				
				}
			
				$FindableMetal 		= $FactorRessMetal * max(min($fleetPoints / (30 * $FactorWeightPoint ), $MaxFleetPoints ), 200);
				$FindableCristal 	= $FactorRessCristal * max(min($fleetPoints / (30 * $FactorWeightPoint ), $MaxFleetPoints ), 200);
				$FindableDeuterium 	= $FactorRessDeutérium * max(min($fleetPoints / (30 * $FactorWeightPoint ), $MaxFleetPoints ), 200);
				
				$FindableMetal 		+= $FindableMetal / 100 * $BonusRees;
				$FindableCristal 	+= $FindableCristal / 100 * $BonusRees;
				$FindableDeuterium 	+= $FindableDeuterium / 100 * $BonusRees;
				
				$fleetColMetal		= 'fleet_resource_'.$resource[901];
				$fleetColCristal	= 'fleet_resource_'.$resource[902];
				$fleetColDeuterium	= 'fleet_resource_'.$resource[903];
				
				/* $this->UpdateFleet($fleetColMetal, $this->_fleet[$fleetColMetal] + $FindableMetal);
				$this->UpdateFleet($fleetColCristal, $this->_fleet[$fleetColCristal] + $FindableCristal);
				$this->UpdateFleet($fleetColDeuterium, $this->_fleet[$fleetColDeuterium] + $FindableDeuterium); */
				
				$chanceToFound	= mt_rand(1, 7);
				if($chanceToFound > 3){
					$fleetColMetal		= 'fleet_resource_'.$resource[901];
					$this->UpdateFleet($fleetColMetal, $this->_fleet[$fleetColMetal] + min($FindableMetal, $fleetCapacity));
				}elseif($chanceToFound > 1){
					$fleetColCristal	= 'fleet_resource_'.$resource[902];
					$this->UpdateFleet($fleetColCristal, $this->_fleet[$fleetColCristal] + min($FindableCristal, $fleetCapacity));
				}else{
					$fleetColDeuterium	= 'fleet_resource_'.$resource[903];
					$this->UpdateFleet($fleetColDeuterium, $this->_fleet[$fleetColDeuterium] + min($FindableDeuterium, $fleetCapacity));
				}
				
				$Achievements = achievementSuccesDaily($ownerUser, $this->_fleet['fleet_start_id']);		
				$Achievements = achievementSuccesVaria($ownerUser);	
				tournement($this->_fleet['fleet_owner'], 5, 1);
				}
			break;
			case 2:
				$sql		= "UPDATE %%LOG_FLEETS%% SET expeEvent = :expeEvent WHERE fleet_id = :fleet_id;";
				database::get()->update($sql, array(
					':expeEvent'	=> 2,
					':fleet_id'		=> $this->_fleet['fleet_id']
				));	
				//FLEETS
				$Message		= "";	
				$FoundShipMess	= "";	
				$NewFleetArray 	= "";
				
				$eventSize		= mt_rand(0, 100);
				$Size       	= 0;
				
				if(10 < $eventSize) {
					$Size		= mt_rand(10000, 50000);
					$Size			= $Size + ($Size / 100 * $premium_expe_bonus);
					$Message	= $LNG['sys_expe_found_ships_1_'.mt_rand(1,4)];
				} elseif(0 < $eventSize && 10 >= $eventSize) {
					$Size		= mt_rand(32000, 75000);
					$Size			= $Size + ($Size / 100 * $premium_expe_bonus);
					$Message	= $LNG['sys_expe_found_ships_2_'.mt_rand(1,2)];
				} elseif(0 == $eventSize) {
					$Size	 	= mt_rand(55000, 110000);
					$Size			= $Size + ($Size / 100 * $premium_expe_bonus);
					$Message	= $LNG['sys_expe_found_ships_3_'.mt_rand(1,2)];
				}
				
				$sql		= "SELECT MAX(total_points) as total FROM %%STATPOINTS%% WHERE `stat_type` = :type AND `universe` = :universe;";
				$topPoints	= Database::get()->selectSingle($sql, array(
					':type'		=> 1,
					':universe'	=> $this->_fleet['fleet_universe']
				), 'total');

				$MaxPoints 		= ($topPoints < 5000000000) ? 300000 : 400000;
				$FoundShips		= max(round($Size * min($fleetPoints, $MaxPoints)), 1000000);
				$FoundShips		+= $FoundShips / 100 * config::get()->expeFleetBonus; 
				
				if($fleetPoints <= $config->expe_minPoint_fleet){
					$FoundShipMess .= '<br><br>'.$LNG['sys_expe_found_ships_nothing'];
				}else{
					$Found			= array();
					foreach($reslist['fleet'] as $ID) 
					{
						if(!isset($fleetArray[$ID]) || $ID == 208 || $ID == 209 || $ID == 214)
							continue;
						
						$MaxFound			= floor($FoundShips / ($pricelist[$ID]['cost'][901] + $pricelist[$ID]['cost'][902]));
						
						if($MaxFound <= 0) 
							continue;
						
						$Count				= mt_rand(0, $MaxFound);
						if($Count <= 0) 
							continue;
						
						$Found[$ID]			= $Count;
						$FoundShips	 		-= $Count * ($pricelist[$ID]['cost'][901] + $pricelist[$ID]['cost'][902]);
						$FoundShipMess   	.= '<br>'.$LNG['tech'][$ID].': '.pretty_number($Count);
						if($FoundShips <= 0)
							break;
					}
					
					if (empty($Found)) {
						$FoundShipMess .= '<br><br>'.$LNG['sys_expe_found_ships_nothing'];
					}
					
					foreach($fleetArray as $ID => $Count)
					{
						if(!empty($Found[$ID]))
						{
							$Count	+= $Found[$ID];
						}
						
						$NewFleetArray  	.= $ID.",".floattostring($Count).';';
					}
					
					$Message	.= $FoundShipMess;
									
					$this->UpdateFleet('fleet_array', $NewFleetArray);
					$this->UpdateFleet('fleet_amount', array_sum($fleetArray));
				}
				
				$Achievements = achievementSuccesDaily($ownerUser, $this->_fleet['fleet_start_id']);		
				$Achievements = achievementSuccesVaria($ownerUser);
				tournement($this->_fleet['fleet_owner'], 5, 1);
			
			break;
			case 3:
				//DARKMATTER
				if(70 > mt_rand(1,100)){
					$sql		= "UPDATE %%LOG_FLEETS%% SET expeEvent = :expeEvent WHERE fleet_id = :fleet_id;";
					database::get()->update($sql, array(
						':expeEvent'	=> 3,
						':fleet_id'		=> $this->_fleet['fleet_id']
					));
					
					$maxPossibleDarkmat			= 5000000 + 5000000 / 100 * config::get()->expeDmBonus;
					$FindableDarkmatter			= $fleetPoints * mt_rand(5,15)/10;
					$FindableDarkmatter 		= min($FindableDarkmatter, $maxPossibleDarkmat);
						
					$this->UpdateFleet('fleet_resource_darkmatter', $this->_fleet['fleet_resource_darkmatter'] + min($FindableDarkmatter, $fleetCapacity));
					
					$Message	= $LNG['sys_expe_found_dm_1_'.mt_rand(1,5)]; // low amount found
					//$Message	= $LNG['sys_expe_found_dm_2_'.mt_rand(1,3)]; // average amount found
					//$Message	= $LNG['sys_expe_found_dm_3_'.mt_rand(1,2)]; // high amount found
					tournement($this->_fleet['fleet_owner'], 7, $FindableDarkmatter);
					$Achievements = achievementSuccesDaily($ownerUser, $this->_fleet['fleet_start_id']);		
					$Achievements = achievementSuccesVaria($ownerUser);		
					if($ownerUser['achievement_varia_6'] < 200){
					$Achievements = achievementDarkmatter($ownerUser, min($FindableDarkmatter, $fleetCapacity));	}
					tournement($this->_fleet['fleet_owner'], 5, 1);
				}
			break;
			case 4:
				$sql		= "UPDATE %%LOG_FLEETS%% SET expeEvent = :expeEvent WHERE fleet_id = :fleet_id;";
				database::get()->update($sql, array(
					':expeEvent'	=> 4,
					':fleet_id'		=> $this->_fleet['fleet_id']
				));
				//ARSENAL
				$arsenalLight	= array('arsenal_combustion', 'arsenal_slight', 'arsenal_res901', 'arsenal_dlight', 'arsenal_conveyor1', 'arsenal_laser', 'arsenal_ion');
				$arsenalMediu	= array('arsenal_impulse', 'arsenal_smedium', 'arsenal_res902', 'arsenal_dmedium', 'arsenal_conveyor2', 'arsenal_plasma');
				$arsenalHeavy	= array('arsenal_hyperspace', 'arsenal_sheavy', 'arsenal_res903', 'arsenal_dheavy', 'arsenal_conveyor3', 'arsenal_gravity');
				$isSuccess		= 0;
				if($fleetPoints >= 500000){
					//all type of arsenal 3 %- 2% - 1%
					$selectTypeLight 	= mt_rand(0,6);
					$selectTypeMedium	= mt_rand(0,5);
					$selectTypeHeavy	= mt_rand(0,5);
					$chanceTypeLight 	= 50;
					$chanceTypeMedium 	= 40;
					$chanceTypeHeavy 	= 30;
					$chanceHaveLight 	= mt_rand(0,100);
					$chanceHaveMedium 	= mt_rand(0,100);
					$chanceHaveHeavy 	= mt_rand(0,100);
					$factor				= 0;
					if($chanceTypeLight >= $chanceHaveLight){
						$factor		= 1;
						$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
						$Message	= sprintf($LNG[$arsenalLight[$selectTypeLight]], $factor);
						$sql	= "UPDATE %%USERS%% SET ".$arsenalLight[$selectTypeLight]." = ".$arsenalLight[$selectTypeLight]." + :factor WHERE id = :userId;";
						Database::get()->update($sql, array(
							':factor'	=> $factor,
							':userId'	=> $this->_fleet['fleet_owner']
						));
						$isSuccess	= 1;
						expeEventPoints($this->_fleet['fleet_owner'], 1*$factor);
					}elseif($chanceTypeMedium >= $chanceHaveMedium){
						$factor		= 1;
						$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
						$Message	= sprintf($LNG[$arsenalMediu[$selectTypeMedium]], $factor);
						$sql	= "UPDATE %%USERS%% SET ".$arsenalMediu[$selectTypeMedium]." = ".$arsenalMediu[$selectTypeMedium]." + :factor WHERE id = :userId;";
						Database::get()->update($sql, array(
							':factor'	=> $factor,
							':userId'	=> $this->_fleet['fleet_owner']
						));
						$isSuccess	= 1;
						expeEventPoints($this->_fleet['fleet_owner'], 2*$factor);
					}elseif($chanceTypeHeavy >= $chanceHaveHeavy){
						$factor		= 1;
						$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
						$Message	= sprintf($LNG[$arsenalHeavy[$selectTypeHeavy]], $factor);
						$sql	= "UPDATE %%USERS%% SET ".$arsenalHeavy[$selectTypeHeavy]." = ".$arsenalHeavy[$selectTypeHeavy]." + :factor WHERE id = :userId;";
						Database::get()->update($sql, array(
							':factor'	=> $factor,
							':userId'	=> $this->_fleet['fleet_owner']
						));
						$isSuccess	= 1;
						expeEventPoints($this->_fleet['fleet_owner'], 3*$factor);
					}
				}elseif($fleetPoints >= 300000 && $fleetPoints < 500000){
					//low or mediun arsenal 3% 2%
					$selectTypeLight 	= mt_rand(0,6);
					$selectTypeMedium	= mt_rand(0,5);
					$chanceTypeLight 	= 50;
					$chanceTypeMedium 	= 40;
					$chanceHaveLight 	= mt_rand(0,100);
					$chanceHaveMedium 	= mt_rand(0,100);
					
					if($chanceTypeLight >= $chanceHaveLight){
						$factor		= 1;
						$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
						$Message	= sprintf($LNG[$arsenalLight[$selectTypeLight]], $factor);
						$sql	= "UPDATE %%USERS%% SET ".$arsenalLight[$selectTypeLight]." = ".$arsenalLight[$selectTypeLight]." + :factor WHERE id = :userId;";
						Database::get()->update($sql, array(
							':factor'	=> $factor,
							':userId'	=> $this->_fleet['fleet_owner']
						));
						$isSuccess	= 1;
						expeEventPoints($this->_fleet['fleet_owner'], 1*$factor);
					}elseif($chanceTypeMedium >= $chanceHaveMedium){
						$factor		= 1;
						$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
						$Message	= sprintf($LNG[$arsenalMediu[$selectTypeMedium]], $factor);
						$sql	= "UPDATE %%USERS%% SET ".$arsenalMediu[$selectTypeMedium]." = ".$arsenalMediu[$selectTypeMedium]." + :factor WHERE id = :userId;";
						Database::get()->update($sql, array(
							':factor'	=> $factor,
							':userId'	=> $this->_fleet['fleet_owner']
						));
						$isSuccess	= 1;
						expeEventPoints($this->_fleet['fleet_owner'], 2*$factor);
					}
				}elseif($fleetPoints > 100000 && $fleetPoints < 300000){
					//low arsenal 3%
					$selectTypeLight 	= mt_rand(0,6);
					$chanceType 		= 50;
					$chanceHave 		= mt_rand(0,100);
					if($chanceType >= $chanceHave){
						$factor		= 1;
						$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
						$Message	= sprintf($LNG[$arsenalLight[$selectTypeLight]], $factor);
						$sql	= "UPDATE %%USERS%% SET ".$arsenalLight[$selectTypeLight]." = ".$arsenalLight[$selectTypeLight]." + :factor WHERE id = :userId;";
						Database::get()->update($sql, array(
							':factor'	=> $factor,
							':userId'	=> $this->_fleet['fleet_owner']
						));
						$isSuccess	= 1;
						expeEventPoints($this->_fleet['fleet_owner'], 1*$factor);
					}
				}
				
				if($isSuccess == 1){
					$Achievements = achievementSuccesDaily($ownerUser, $this->_fleet['fleet_start_id']);		
					$Achievements = achievementSuccesVaria($ownerUser);		
					tournement($this->_fleet['fleet_owner'], 5, 1);
					tournement($this->_fleet['fleet_owner'], 8, $factor);
				}
			break;
			case 5:
				$sql		= "UPDATE %%LOG_FLEETS%% SET expeEvent = :expeEvent WHERE fleet_id = :fleet_id;";
				database::get()->update($sql, array(
					':expeEvent'	=> 5,
					':fleet_id'		=> $this->_fleet['fleet_id']
				));
				//HOSTILE
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
				// pirate or alien
				$attackType	= mt_rand(1,2);
				$eventSize	= mt_rand(0, 100);
				$fleetArray				= FleetFunctions::unserialize($this->_fleet['fleet_array']);
				if($attackType == 1){
					//PIRATE
					$techBonus		= 50;
					$targetName		= $LNG['sys_expe_attackname_1'];
					$roundFunction	= 'floor';
						if(40 < $eventSize){
						$Message    			= $LNG['sys_expe_attack_1_1_5'];
						$attackFactor			= (40 + mt_rand(-3, 3)) / 100;
						$targetFleetData[204]	= mt_rand(150000, 200000);
						$targetFleetData[205]	= mt_rand(75000, 100000);
						$targetFleetData[207]	= mt_rand(10000, 15000);
					}elseif(0 < $eventSize && 40 >= $eventSize){
						$Message    			= $LNG['sys_expe_attack_1_2_3'];
						$attackFactor			= (60 + mt_rand(-5, 5)) / 100;
						$targetFleetData[229]	= mt_rand(90000, 130000);
						$targetFleetData[206]	= mt_rand(2000, 4000);
						$targetFleetData[207]	= mt_rand(700, 1500);
					}else{
						$Message   				= $LNG['sys_expe_attack_1_3_2'];
						$attackFactor			= (80 + mt_rand(-8, 8)) / 100;
						$targetFleetData[205]	= mt_rand(100000, 135000);
						$targetFleetData[225]	= mt_rand(750, 1150);
					}
				}else{
					//ALIEN
					$techBonus		= 70;
					$targetName		= $LNG['sys_expe_attackname_2'];
					$roundFunction	= 'ceil';
					if(10 < $eventSize){
						$Message    			= $LNG['sys_expe_attack_1_1_5'];
						$attackFactor			= (80 + mt_rand(-4, 4)) / 100;
						$targetFleetData[205]	= mt_rand(800000, 1500000);
						$targetFleetData[206]	= mt_rand(1000000, 1250000);
						$targetFleetData[207]	= mt_rand(70000, 1100000);
					}elseif(0 < $eventSize && 10 >= $eventSize){
						$Message    			= $LNG['sys_expe_attack_1_3_2'];
						$attackFactor			= (100 + mt_rand(-6, 6)) / 100;
						$targetFleetData[204]	= mt_rand(2000000, 5000000);
						$targetFleetData[229]	= mt_rand(250000, 395000);
					}else{
						$Message    			= $LNG['sys_expe_attack_1_3_2'];
						$attackFactor			= (120 + mt_rand(-9, 9)) / 100;
						$targetFleetData[205]	= mt_rand(800000, 1000000);
						$targetFleetData[207]	= mt_rand(200000, 300000);
					}
				}
				
				$sql		= "SELECT MAX(total_points) as total FROM %%STATPOINTS%% WHERE `stat_type` = 1 AND `universe` = 1;";
				$topPointsHostalCheck	= Database::get()->selectSingle($sql, array(), 'total');
				
				$SizeHostal			= mt_rand(10000, 50000);
				$MaxPointsHostal 	= ($topPointsHostalCheck < 5000000000) ? 450000 : 550000;
				$FoundShipsHostal	= max(round($SizeHostal * min($fleetPoints, $MaxPointsHostal)), 1000000);
					
				foreach($fleetArray as $shipId => $shipAmount)
				{
					if(isset($targetFleetData[$shipId]))
					{
						$targetFleetData[$shipId]	= 0;
					}
					
					$MaxFoundHostal		= floor($FoundShipsHostal / ($pricelist[$shipId]['cost'][901] + $pricelist[$shipId]['cost'][902]));
						
					if($MaxFoundHostal <= 0) 
						continue;
					
					$CountHostal			= mt_rand(0, $MaxFoundHostal);
					if($CountHostal <= 0) 
						continue;
					
					$FoundShipsHostal	 		-= $CountHostal * ($pricelist[$shipId]['cost'][901] + $pricelist[$shipId]['cost'][902]);
					if($FoundShipsHostal <= 0)
						break;
					
					//$targetFleetData[$shipId]	= min($CountHostal,$roundFunction($shipAmount * $attackFactor));
					$targetFleetData[$shipId]	= max(1,$roundFunction($shipAmount * $attackFactor));
				}
				
				$targetFleetData	= array_filter($targetFleetData);
				$sql = 'SELECT * FROM %%USERS%% WHERE id = :userId;';
				$senderData	= Database::get()->selectSingle($sql, array(
					':userId'	=> $this->_fleet['fleet_owner']
				));
				
				$sql	= 'SELECT total_alliance_power FROM %%ALLIANCE%% WHERE id = :allyId;';
				$ExistAlliance = database::get()->selectSingle($sql, array(
					':allyId'	=> $senderData['ally_id']
				));
				
				$BonusAlliance = 0;
				if(!empty($ExistAlliance))
					$BonusAlliance = $ExistAlliance['total_alliance_power']/2;
				
				$targetData	= array(
					'id'			=> 0,
					'username'		=> $targetName,
					'military_tech'	=> max($senderData['military_tech'] /100* $techBonus, 0),
					'defence_tech'	=> max($senderData['defence_tech'] /100* $techBonus, 0),
					'shield_tech'	=> max($senderData['shield_tech'] /100* $techBonus, 0),
					'buster_tech'	=> max($senderData['buster_tech'] /100* $techBonus, 0),
					'ionic_tech'	=> max($senderData['ionic_tech'] /100* $techBonus, 0),
					'laser_tech'	=> max($senderData['laser_tech'] /100* $techBonus, 0),
					'graviton_tech'	=> max($senderData['graviton_tech'] /100* $techBonus, 0),
					'dm_attack' => max($senderData['dm_attack'] /100* $techBonus, 0),
					'dm_attack_level' => max($senderData['dm_attack_level'] /100* $techBonus, 0),
					'dm_defensive' => max($senderData['dm_defensive'] /100* $techBonus, 0),
					'dm_defensive_level' => max($senderData['dm_defensive_level'] /100* $techBonus, 0),
					'rpg_amiral' => max($senderData['rpg_amiral'] /100* $techBonus, 0),
					'combat_exp_level' => max($senderData['combat_exp_level'] /100* $techBonus, 0),
					'academy_p_b_1_1101' => max($senderData['academy_p_b_1_1101'] /100* $techBonus, 0),
					'academy_p_b_1_1102' => max($senderData['academy_p_b_1_1102'] /100*$techBonus, 0),
					'academy_p_b_1_1103' => max($senderData['academy_p_b_1_1103'] /100*$techBonus, 0),
					'academy_p_b_1_1108' => max($senderData['academy_p_b_1_1108'] /100*$techBonus, 0),
					'academy_p_b_1_1109' => max($senderData['academy_p_b_1_1109'] /100*$techBonus, 0),
					'academy_p_b_1_1110' => max($senderData['academy_p_b_1_1110'] /100*$techBonus, 0),
					'academy_p_b_1_1111' => max($senderData['academy_p_b_1_1111'] /100*$techBonus, 0),
					'academy_p_b_1_1113' => max($senderData['academy_p_b_1_1113'] /100*$techBonus, 0),
					'academy_p_b_3_1301' => max($senderData['academy_p_b_3_1301'] /100*$techBonus, 0),
					'academy_p_b_3_1302' => max($senderData['academy_p_b_3_1302'] /100*$techBonus, 0),
					'academy_p_b_3_1303' => max($senderData['academy_p_b_3_1303'] /100*$techBonus, 0),
					'academy_p_b_3_1304' => max($senderData['academy_p_b_3_1304'] /100*$techBonus, 0),
					'academy_p_b_3_1305' => max($senderData['academy_p_b_3_1305'] /100*$techBonus, 0),
					'academy_p_b_3_1306' => max($senderData['academy_p_b_3_1306'] /100*$techBonus, 0),
					'academy_p_b_3_1308' => max($senderData['academy_p_b_3_1308'] /100*$techBonus, 0),
					'academy_p_b_3_1311' => max($senderData['academy_p_b_3_1311'] /100*$techBonus, 0),
					'academy_p_b_3_1312' => max($senderData['academy_p_b_3_1312'] /100*$techBonus, 0),
					'academy_p_b_3_1313' => max($senderData['academy_p_b_3_1313'] /100*$techBonus, 0),
					'academy_p_b_3_1314' => max($senderData['academy_p_b_3_1314'] /100*$techBonus, 0),
					'arsenal_laser_level' 	 => max($senderData['arsenal_laser_level'] /100*$techBonus, 0),
					'arsenal_ion_level' 	 => max($senderData['arsenal_ion_level'] /100*$techBonus, 0),
					'arsenal_plasma_level' 	 => max($senderData['arsenal_plasma_level'] /100*$techBonus, 0),
					'arsenal_gravity_level'  => max($senderData['arsenal_gravity_level'] /100*$techBonus, 0),
					'arsenal_slight_level' 	 => max($senderData['arsenal_slight_level'] /100*$techBonus, 0),
					'arsenal_smedium_level' 	 => max($senderData['arsenal_smedium_level'] /100*$techBonus, 0),
					'arsenal_sheavy_level' 	 => max($senderData['arsenal_sheavy_level'] /100*$techBonus, 0),
					'arsenal_dlight_level' 	 => max($senderData['arsenal_dlight_level'] /100*$techBonus, 0),
					'arsenal_dmedium_level' 	 => max($senderData['arsenal_dmedium_level'] /100*$techBonus, 0),
					'arsenal_dheavy_level' 	 => max($senderData['arsenal_dheavy_level'] /100*$techBonus, 0),
					'ally_fraction_armor' => 0,
					'ally_fraction_shields' => 0,
					'ally_fraction_armement' => 0,
					'ally_fraction_in_armement' => 0,
					'ally_fraction_in_armor' => 0,
					'ally_fraction_in_shields' => 0,
					'ally_fraction_defense_restore' => 0,
					'BonusAlliance' => max($BonusAlliance /100* $techBonus, 0)
						//'hashallytech' => 0
				);
				
				$fleetID	= $this->_fleet['fleet_id'];
			
				$fleetAttack[$fleetID]['fleetDetail']		= $this->_fleet;
				$fleetAttack[$fleetID]['player']			= $senderData;
				$fleetAttack[$fleetID]['player']['factor']	= getFactors($fleetAttack[$this->_fleet['fleet_id']]['player'], 'attack', $this->_fleet['fleet_start_time']);
				$fleetAttack[$fleetID]['unit']				= $fleetArray;
				$fleetAttack[$fleetID]['player']['ally_fraction_armor']	= 0;
				$fleetAttack[$fleetID]['player']['ally_fraction_shields']	= 0;
				$fleetAttack[$fleetID]['player']['ally_fraction_armement']	= 0;
				$fleetAttack[$fleetID]['player']['ally_fraction_in_armement']	= 0;
				$fleetAttack[$fleetID]['player']['ally_fraction_in_armor']	= 0;
				$fleetAttack[$fleetID]['player']['ally_fraction_in_shields']	= 0;
				$fleetAttack[$fleetID]['player']['ally_fraction_defense_restore']	= 0;
				$fleetAttack[$fleetID]['player']['arsenal_laser_level']	= $senderData['arsenal_laser_level'];
				$fleetAttack[$fleetID]['player']['arsenal_ion_level']	= $senderData['arsenal_ion_level'];
				$fleetAttack[$fleetID]['player']['arsenal_plasma_level']	= $senderData['arsenal_plasma_level'];
				$fleetAttack[$fleetID]['player']['arsenal_gravity_level']	= $senderData['arsenal_gravity_level'];
				$fleetAttack[$fleetID]['player']['BonusAlliance']	= $BonusAlliance;
				
				$fleetDefend = array();
				$fleetDefend[0]['fleetDetail'] = array(
					'fleet_start_galaxy'		=> $this->_fleet['fleet_end_galaxy'],
					'fleet_start_system'		=> $this->_fleet['fleet_end_system'],
					'fleet_start_planet'		=> $this->_fleet['fleet_end_planet'],
					'fleet_start_type'			=> 1,
					'fleet_end_galaxy'			=> $this->_fleet['fleet_end_galaxy'],
					'fleet_end_system'			=> $this->_fleet['fleet_end_system'],
					'fleet_end_planet'			=> $this->_fleet['fleet_end_planet'],
					'fleet_end_type'			=> 1,
					'fleet_resource_metal'		=> 0,
					'fleet_resource_crystal'	=> 0,
					'fleet_resource_deuterium'	=> 0
				);

				$bonusList	= BuildFunctions::getBonusList();
					
				$fleetDefend[0]['player']	= $targetData;
				$fleetDefend[0]['player']['factor']	= ArrayUtil::combineArrayWithSingleElement($bonusList, 0);
				$fleetDefend[0]['player']['ally_fraction_armor']	= 0;
				$fleetDefend[0]['player']['ally_fraction_shields']	= 0;
				$fleetDefend[0]['player']['ally_fraction_armement']	= 0;
				$fleetDefend[0]['player']['ally_fraction_in_armement']	= 0;
				$fleetDefend[0]['player']['ally_fraction_in_armor']	= 0;
				$fleetDefend[0]['player']['ally_fraction_in_shields']	= 0;
				$fleetDefend[0]['player']['ally_fraction_defense_restore']	= 0;
				$fleetDefend[0]['player']['arsenal_laser_level']	= 0;
				$fleetDefend[0]['player']['arsenal_ion_level']	= 0;
				$fleetDefend[0]['player']['arsenal_plasma_level']	= 0;
				$fleetDefend[0]['player']['arsenal_gravity_level']	= 0;
				$fleetDefend[0]['unit']		= $targetFleetData;
				
				require_once 'includes/classes/missions/functions/calculateAttack.php';
				
				$FleetDebrisA 	= 0.5;
				$FleetDebrisD 	= 0;
				$DefDebrisA 	= 0;
				$DefDebrisD 	= 0; 
				$combatResult 	= calculateAttack($fleetAttack, $fleetDefend,$FleetDebrisA, $DefDebrisA, $FleetDebrisD, $DefDebrisD, 0);
		
				$fleetArray = '';
				$totalCount = 0;
				
				$fleetAttack[$fleetID]['unit']	= array_filter($fleetAttack[$fleetID]['unit']);
				foreach ($fleetAttack[$fleetID]['unit'] as $element => $amount)
				{
					$fleetArray .= $element.','.$amount.';';
					$totalCount += $amount;
				}
				
				if ($totalCount <= 0)
				{
					$this->KillFleet();
				}
				else
				{
					$this->UpdateFleet('fleet_array', substr($fleetArray, 0, -1));
					$this->UpdateFleet('fleet_amount', $totalCount);
				}
				
				require_once('includes/classes/missions/functions/GenerateReport.php');
			
				$debrisResource	= array(901, 902);
				$debris			= array();
				foreach($debrisResource as $elementID)
				{
					$debris[$elementID]			= $combatResult['debris']['attacker'][$elementID] + $combatResult['debris']['defender'][$elementID];
				}
				
				if($combatResult['won'] == 'a'){
					$SortFleets 	= array();
					$capacity  	= 0;
					
					
					$academy_p_b_2_1207 = 0;
					if($ownerUser['academy_p_b_2_1207'] > 0){
						$academy_p_b_2_1207 = $ownerUser['academy_p_b_2_1207'] * 5;
					}
					
					$ally_fraction_fleet_capa = 0;
					if($ownerUser['ally_id'] != 0){
						$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
						$ALLIANCE = Database::get()->selectSingle($sql, array(
							':allyID'	=> $ownerUser['ally_id']
						));
						if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
							$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
							$FRACTIONS = Database::get()->selectSingle($sql, array(
							':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
							));
							$ally_fraction_fleet_capa = $FRACTIONS['ally_fraction_fleet_capa'] * $ALLIANCE['ally_fraction_level'];
						}
					}
			
					foreach($fleetAttack as $FleetID => $Attacker){
						$SortFleets[$FleetID]		= 0;
						foreach ($fleetAttack[$fleetID]['unit'] as $Element => $amount)
						{
							if(!in_array($Element, array(209,219)))
								continue;
							$SortFleets[$FleetID]		+= $pricelist[$Element]['capacity'] * $amount;
						}
						$capacity				+= $SortFleets[$FleetID];
					}
					
					$capacity += $capacity / 100 * (25*$ownerUser['rpg_stockeur']);
					$capacity += $capacity / 100 * $academy_p_b_2_1207;
					
					$capacity -= $this->_fleet['fleet_resource_metal'] + $this->_fleet['fleet_resource_crystal'] + $this->_fleet['fleet_resource_deuterium'] + $this->_fleet['fleet_resource_darkmatter'];
					
					$minMetal = max(0,min($debris[901], $capacity));
					$capacity -= $debris[901];
					$minCryst = max(0,min($debris[902], $capacity));
					$sql	= 'UPDATE %%FLEETS%% SET fleet_resource_metal = fleet_resource_metal + :fleet_resource_metal, fleet_resource_crystal = fleet_resource_crystal + :fleet_resource_crystal WHERE fleet_id = :fleet_id;';
					database::get()->update($sql, array(
						':fleet_resource_metal'		=> $minMetal,
						':fleet_resource_crystal'	=> $minCryst,
						':fleet_id'					=> $this->_fleet['fleet_id']
					));
				}
				
				$debrisTotal		= array_sum($debris);
				
				$stealResource	= array(901 => $minMetal, 902 => $minCryst, 903 => 0);
				
				$stealResourceInformation4	= (ceil($debrisTotal / $pricelist[209]['capacity']));
				$stealResourceInformation5	= (ceil($debrisTotal / $pricelist[219]['capacity']));
			 
				$reportInfo	= array(
					'thisFleet'				=> $this->_fleet,
					'debris'				=> $debris,
					'debris901'				=> $debris[901],
					'debris902'				=> $debris[902],
					'stealResource'			=> $stealResource, 
					'additionalInfo1'		=> ($debris[901] + $debris[901]) / 5000,
					'additionalInfo2'		=> ($debris[901] + $debris[901]) / 25000,
					'additionalInfo3'		=> ($debris[901] + $debris[901]) / 400000000,
					'additionalInfo4'		=> $debris[901],
					'additionalInfo5'		=> $debris[902],
					'additionalInfo6'		=> 0,
					'additionalInfo10'		=> $stealResourceInformation4,
					'additionalInfo11'		=> $stealResourceInformation5,
					'moonChance'			=> 0,
					'moonDestroy'			=> false,
					'moonName'				=> NULL,
					'moonDestroyChance'		=> NULL,
					'moonDestroySuccess'	=> NULL,
					'fleetDestroyChance'	=> NULL,
					'fleetDestroySuccess'	=> NULL,
				);
				
				$reportData	= GenerateReport($combatResult, $reportInfo);
			
				$reportID	= md5(uniqid('', true).TIMESTAMP);
				$sql		= "INSERT INTO %%RW%% SET
				rid			= :reportId,
				raport		= :reportData,
				time		= :time,
				attacker	= :attacker;";
				Database::get()->insert($sql, array(
					':reportId'		=> $reportID,
					':reportData'	=> serialize($reportData),
					':time'			=> $this->_fleet['fleet_start_time'],
					':attacker'		=> $this->_fleet['fleet_owner'],
				));
			
				switch($combatResult['won'])
				{
					case "a":
						$attackClass	= 'raportWin';
						$defendClass	= 'raportLose';
					break;
					case "r":
						$attackClass	= 'raportLose';
						$defendClass	= 'raportWin';
					break;
					default:
						$attackClass	= 'raportDraw';
						$defendClass	= 'raportDraw';
					break;
				}
				
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
					
				if($combatResult['won'] == 'a'){
					$Achievements = achievementSuccesDaily($ownerUser, $this->_fleet['fleet_start_id']);		
					$Achievements = achievementSuccesVaria($ownerUser);	
					$Achievements = achievementSuccesArsenal($ownerUser, $premium_expe_bonus, $fleetPoints);	
					$Achievements = achievementSuccesCombat($ownerUser, $combatResult);	
					
					if($Achievements >= 1){
						$message .= '<br>'.$LNG['bonus_receive'].' '.pretty_number($Achievements).' '.$LNG['premium_4'];
					}
					tournement($this->_fleet['fleet_owner'], 5, 1);
				}
				
				PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 3, $LNG['sys_mess_attack_report'], $message, TIMESTAMP);
			break;
			case 6:
				if($FindBlackHole >= $FindBlackHole1){
					//BLACKHOLE
					$this->KillFleet();
					$Message	= $LNG['sys_expe_lost_fleet_'.mt_rand(1,4)];
					$sql		= "UPDATE %%LOG_FLEETS%% SET expeEvent = :expeEvent WHERE fleet_id = :fleet_id;";
					database::get()->update($sql, array(
						':expeEvent'	=> 6,
						':fleet_id'		=> $this->_fleet['fleet_id']
					));
					tournement($this->_fleet['fleet_owner'], 10, 1);
				}
			break;
			case 7:
				/* $sql		= "UPDATE %%LOG_FLEETS%% SET expeEvent = :expeEvent WHERE fleet_id = :fleet_id;";
				database::get()->update($sql, array(
					':expeEvent'	=> 7,
					':fleet_id'		=> $this->_fleet['fleet_id']
				));
				//TIMECHANGE
				$chance		= mt_rand(0, 100);
				$Wrapper	= array();
				$Wrapper[]	= 5;
				$Wrapper[]	= 5;
				$Wrapper[]	= 5;
				$Wrapper[]	= 5;
				$Wrapper[]	= 5;
				$Wrapper[]	= 5;
				$Wrapper[]	= 5;
				$Wrapper[]	= 8;
				$Wrapper[]	= 8;
				$Wrapper[]	= 12;
				
				if($chance < 75)
				{
					// More return time
					$normalBackTime	= $this->_fleet['fleet_end_time'] - $this->_fleet['fleet_end_stay'];
					$stayTime		= $this->_fleet['fleet_end_stay'] - $this->_fleet['fleet_start_time'];
					$factor			= $Wrapper[mt_rand(0, 9)];
					//$endTime		= $this->_fleet['fleet_end_stay'] + $normalBackTime + $stayTime + $factor;
					$endTime		= $this->_fleet['fleet_end_stay'] + $normalBackTime + $stayTime + $factor;
					$this->UpdateFleet('fleet_end_time', $endTime);
					$Message = $LNG['sys_expe_time_slow_'.mt_rand(1,6)];
				}
				else
				{
					$normalBackTime	= $this->_fleet['fleet_end_time'] - $this->_fleet['fleet_end_stay'];
					$stayTime		= $this->_fleet['fleet_end_stay'] - $this->_fleet['fleet_start_time'];
					$factor			= $Wrapper[mt_rand(0, 9)];
					$endTime		= max(1, $normalBackTime - $stayTime / 3 * $factor);
					$this->UpdateFleet('fleet_end_time', $endTime);
					$Message = $LNG['sys_expe_time_fast_'.mt_rand(1,3)];
				} */
			break;
			case 8:
				$sql		= "UPDATE %%LOG_FLEETS%% SET expeEvent = :expeEvent WHERE fleet_id = :fleet_id;";
				database::get()->update($sql, array(
					':expeEvent'	=> 8,
					':fleet_id'		=> $this->_fleet['fleet_id']
				));
				//CONVERT RES
				if($totalResource != 0){
					$chanceToFound	= mt_rand(1, 7);
					if($chanceToFound > 4){
						$fleetCol	= 'fleet_resource_'.$resource[901];
					}elseif($chanceToFound > 2){
						$fleetCol	= 'fleet_resource_'.$resource[902];
					}else{
						$fleetCol	= 'fleet_resource_'.$resource[903];
					}
					
					$Ratio 			= mt_rand(-5,5);
					$isSuccess		= 0;
					if($fleetCol == 'fleet_resource_'.$resource[901] && $this->_fleet[$fleetCol] > 0){
						$TypeChange 	= array('crystal', 'deuterium');
						$TypeChangeRatio= mt_rand(0,1);
						
						if($TypeChangeRatio == 0)
							$RatioGame = $this->_fleet[$fleetCol] / 3 * 2;
						else
							$RatioGame = $this->_fleet[$fleetCol] / 3;
						
						$RatioGame += $RatioGame / 100 * $Ratio;
						$this->UpdateFleet('fleet_resource_'.$TypeChange[$TypeChangeRatio], $this->_fleet['fleet_resource_'.$TypeChange[$TypeChangeRatio]] + $RatioGame);
						$this->UpdateFleet($fleetCol, 0);
						$isSuccess = 1;
					}elseif($fleetCol == 'fleet_resource_'.$resource[902] && $this->_fleet[$fleetCol] > 0){
						$TypeChange 	= array('metal', 'deuterium');
						$TypeChangeRatio= mt_rand(0,1);
						
						if($TypeChangeRatio == 0)
							$RatioGame = $this->_fleet[$fleetCol] * 2;
						else
							$RatioGame = $this->_fleet[$fleetCol] / 2;
						
						$RatioGame += $RatioGame / 100 * $Ratio;
						$this->UpdateFleet('fleet_resource_'.$TypeChange[$TypeChangeRatio], $this->_fleet['fleet_resource_'.$TypeChange[$TypeChangeRatio]] + $RatioGame);
						$this->UpdateFleet($fleetCol, 0);
						$isSuccess = 1;
					}elseif($fleetCol == 'fleet_resource_'.$resource[903] && $this->_fleet[$fleetCol] > 0){
						$TypeChange 	= array('metal', 'crystal');
						$TypeChangeRatio= mt_rand(0,1);
						
						if($TypeChangeRatio == 0)
							$RatioGame = $this->_fleet[$fleetCol] * 3;
						else
							$RatioGame = $this->_fleet[$fleetCol] * 2;
						
						$RatioGame += $RatioGame / 100 * $Ratio;
						$this->UpdateFleet('fleet_resource_'.$TypeChange[$TypeChangeRatio], $this->_fleet['fleet_resource_'.$TypeChange[$TypeChangeRatio]] + $RatioGame);
						$this->UpdateFleet($fleetCol, 0);
						$isSuccess = 1;
					}
					
					if($isSuccess == 1){
						$Achievements = achievementSuccesDaily($ownerUser, $this->_fleet['fleet_start_id']);		
						$Achievements = achievementSuccesVaria($ownerUser);
						$Message	  = 'Some of your transported resource have been converted in another type of resource with a small loss or win.';
						tournement($this->_fleet['fleet_owner'], 5, 1);
					}
				}
			break;
			case 9:
				$sql	= 'SELECT SUM(planetarium) as level FROM %%PLANETS%% WHERE isAlliancePlanet = :isAlliancePlanet AND destruyed = 0;';
				$getBonCount = database::get()->selectSingle($sql, array(
					':isAlliancePlanet'		=> $ownerUser['ally_id'],
				));
		
				$DefaultChance = 5 + (5 * $getBonCount['level']);				
				$maxChance 	   = mt_rand(0,1000);
				if($DefaultChance >= $maxChance){
					$sql	= "UPDATE %%USERS%% SET stardust = stardust + 1 WHERE id = :userId;";
					database::get()->update($sql, array(
						':userId'       => $this->_fleet['fleet_owner'],
					));
					$Message	= "<span style='color:red;'You found one Stardust !</span>";
				}
			break;
			case 10:
				if($config->cosmonaute_status == 1){
					$itemSelect = mt_rand(1,3);
					$sql		= "UPDATE %%LOG_FLEETS%% SET expeEvent = :expeEvent WHERE fleet_id = :fleet_id;";
					database::get()->update($sql, array(
						':expeEvent'	=> 9,
						':fleet_id'		=> $this->_fleet['fleet_id']
					));
					if($itemSelect == 1) {
						$Message	= 'You found one ufo for the cosmonaute event';
						$varis = 'cosmo_gift_1';
					} elseif($itemSelect == 2) {
						$Message	= 'You found one alien for the cosmonaute event';
						$varis = 'cosmo_gift_2';
					} elseif($itemSelect == 3) {
						$Message	= 'You found one rocket for the cosmonaute event';
						$varis = 'cosmo_gift_3';
					}
					if($varis != ""){
						$sql =  "UPDATE %%USERS%% SET ".$varis." = ".$varis." + :varis WHERE id = :userID;";
						Database::get()->update($sql, array(
							':varis'	=> 1,
							':userID'	=> $this->_fleet['fleet_owner']
						));	
						tournement($this->_fleet['fleet_owner'], 5, 1);
					}
					$Achievements = achievementSuccesDaily($ownerUser, $this->_fleet['fleet_start_id']);		
					$Achievements = achievementSuccesVaria($ownerUser);
				}elseif($config->new_year_status == 1){
					$itemSelect = mt_rand(1,3);
					$sql		= "UPDATE %%LOG_FLEETS%% SET expeEvent = :expeEvent WHERE fleet_id = :fleet_id;";
					database::get()->update($sql, array(
						':expeEvent'	=> 2,
						':fleet_id'		=> $this->_fleet['fleet_id']
					));
					if($itemSelect == 1) {
						$Message	= 'You found one new year toy for the new years event';
						$varis = 'newyear_gift_1';
					} elseif($itemSelect == 2) {
						$Message	= 'You found one snowflake for the new years event';
						$varis = 'newyear_gift_2';
					} elseif($itemSelect == 3) {
						$Message	= 'You found one bluebell for the new years event';
						$varis = 'newyear_gift_3';
					}
					if($varis != ""){
						$sql =  "UPDATE %%USERS%% SET ".$varis." = ".$varis." + :varis WHERE id = :userID;";
						Database::get()->update($sql, array(
							':varis'	=> 1,
							':userID'	=> $this->_fleet['fleet_owner']
						));	
						tournement($this->_fleet['fleet_owner'], 5, 1);
					}
					$Achievements = achievementSuccesDaily($ownerUser, $this->_fleet['fleet_start_id']);		
					$Achievements = achievementSuccesVaria($ownerUser);
				}elseif($config->halloween_event == 1){
					$itemSelect = mt_rand(1,3);
					$sql		= "UPDATE %%LOG_FLEETS%% SET expeEvent = :expeEvent WHERE fleet_id = :fleet_id;";
					database::get()->update($sql, array(
						':expeEvent'	=> 9,
						':fleet_id'		=> $this->_fleet['fleet_id']
					));
					if($itemSelect == 1) {
						$Message	= $LNG['haloween_5'];
						$varis = 'halloween_gift_1';
					} elseif($itemSelect == 2) {
						$Message	= $LNG['haloween_6'];
						$varis = 'halloween_gift_2';
					} elseif($itemSelect == 3) {
						$Message	= $LNG['haloween_7'];
						$varis = 'halloween_gift_3';
					}
					if($varis != ""){
						$sql =  "UPDATE %%USERS%% SET ".$varis." = ".$varis." + :varis WHERE id = :userID;";
						Database::get()->update($sql, array(
							':varis'	=> 1,
							':userID'	=> $this->_fleet['fleet_owner']
						));	
						tournement($this->_fleet['fleet_owner'], 5, 1);
					}
					$Achievements = achievementSuccesDaily($ownerUser, $this->_fleet['fleet_start_id']);		
					$Achievements = achievementSuccesVaria($ownerUser);
				}
			break;
		}
		
		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 15, $LNG['sys_expe_report'], $Message, TIMESTAMP);
		$this->setState(FLEET_RETURN);
		$this->SaveFleet();
	}
	
	function ReturnEvent()
	{
		$LNG		= $this->getLanguage(NULL, $this->_fleet['fleet_owner']);
		$Message 	= sprintf(
			$LNG['sys_expe_back_home'],
			$LNG['tech'][901], pretty_number($this->_fleet['fleet_resource_metal']),
			$LNG['tech'][902], pretty_number($this->_fleet['fleet_resource_crystal']),
			$LNG['tech'][903], pretty_number($this->_fleet['fleet_resource_deuterium']),
			$LNG['tech'][921], pretty_number($this->_fleet['fleet_resource_darkmatter'])
		);
		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 15, $LNG['sys_mess_fleetback'], $Message, TIMESTAMP);
		$this->RestoreFleet();
	}
}
