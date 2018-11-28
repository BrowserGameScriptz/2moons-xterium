<?php

class ShowFullcontrollPage extends AbstractGamePage
{
	function __construct() 
	{
		parent::__construct();
		$this->setWindow('popup');
	}
	
	function show()
	{	
		global $LNG, $resource, $USER, $PLANET, $pricelist, $reslist;
		
		$productId   = HTTP::_GP('id', 0);
		
		//if(!in_array($USER['id'],array(1,85)))
		//if(!in_array($USER['id'],array(1)))
			//$this->printMessage('The Controll-Empire function is only available for the administrators at this moment !', NULL, NULL, false);
		
		if($PLANET['isAlliancePlanet'] != 0){
			$ElementsBuild		= array(14,15,21,22,23,24,33,34,44,71,72,73,50,51,52);
			$ElementsFleet		= $reslist['fleet'];
			$ElementsDefense	= array_merge($reslist['defense'], $reslist['missile']);
		}elseif($PLANET['planet_type'] == 1){
			$ElementsBuild		= array(1,2,3,4,6,12,14,15,21,22,23,24,31,33,34,44,71,72,73,7);
			$ElementsFleet		= $reslist['fleet'];
			$ElementsDefense	= array_merge($reslist['defense'], $reslist['missile']);
		}else{
			$ElementsBuild 		= array(14,15,21,34,41,42,43,71,72,73);
			$ElementsFleet		= $reslist['fleet'];
			$ElementsDefense	= array_merge($reslist['defense'], $reslist['missile']);
		}
		
		$completeArray = array_merge($ElementsBuild, $ElementsFleet, $ElementsDefense);
		
		if(!in_array($productId, $completeArray)){
			$this->printMessage('This element does not exist in the game or is not allowed on this type of planets !', NULL, NULL, false);
		}
		
		$this->tplObj->loadscript('fullcontroll.js'); 
		$this->assign(array(
			'productId'   => $productId,		
			'productDesc' => $LNG['longDescription'][$productId],		
		));
		
		$this->display('page.fullcontroll.default.tpl');
	}
	
	function send()
	{	
		global $LNG, $resource, $USER, $PLANET, $pricelist, $reslist;
			
		$productId   = HTTP::_GP('productId', 0);
		$productCount= HTTP::_GP('count', 0);
		$productAjax = HTTP::_GP('ajaxReq', 0);
		
		if($PLANET['isAlliancePlanet'] != 0){
			$ElementsBuild		= array(14,15,21,22,23,24,33,34,44,71,72,73,50,51,52);
			$ElementsFleet		= $reslist['fleet'];
			$ElementsDefense	= array_merge($reslist['defense'], $reslist['missile']);
		}elseif($PLANET['planet_type'] == 1){
			$ElementsBuild		= array(1,2,3,4,6,12,14,15,21,22,23,24,31,33,34,44,71,72,73,7);
			$ElementsFleet		= $reslist['fleet'];
			$ElementsDefense	= array_merge($reslist['defense'], $reslist['missile']);
		}else{
			$ElementsBuild 		= array(14,15,21,34,41,42,43,71,72,73);
			$ElementsFleet		= $reslist['fleet'];
			$ElementsDefense	= array_merge($reslist['defense'], $reslist['missile']);
		}
		
		if($productAjax == 0){
			echo 'An error occured ! Please try again ...';
			exit();
		}elseif(!is_numeric($productCount)){
			echo 'You can only input an numeric value.';
			exit();
		}elseif(empty($productCount)){
			echo 'You need to select how many levels you want to upgrade your planets.';
			exit();
		}elseif(!in_array($productId, array_merge($ElementsBuild, $ElementsFleet, $ElementsDefense))){
			echo 'This element does not exist in the game or is not allowed on this type of planets !';
			exit();
		}else{
			$select_buildings	=	'';
			$selected_tech		=	'';
			$select_fleets		=	'';
			$select_defenses	=	'';
			$select_conveyors	=	'';
		
			foreach($reslist['tech'] as $Techno){
				$selected_tech		.= $resource[$Techno].",";
			}	
			
			foreach($reslist['build'] as $Building){
				$select_buildings	.= $resource[$Building].",";
			}
			
			foreach($reslist['fleet'] as $Fleet){
				$select_fleets		.= $resource[$Fleet].",";
			}	
			
			foreach($reslist['defense'] as $Defense){
				$select_defenses	.= $resource[$Defense].",";
			}

			foreach(array_merge($reslist['defense'], $reslist['fleet'], $reslist['missile']) as $Item){
				if(isset($PLANET[$resource[$Item].'_conv'])){
					$select_conveyors	.= $resource[$Item].'_conv,';
				}
			}
		
			$sql	= 'SELECT '.$selected_tech.' id, username, universe, ally_id, prem_o_build, prem_o_build_days, academy_p_b_2_1208, b_tech_planet, darkmatter, antimatter, academy_p_b_1_1104, academy_p_b_3_1310, antimatter_bought, prem_s_build, prem_s_build_days, academy_p_b_2_1203, academy_p_b_2_1205, dm_buildtime, dm_buildtime_level, dm_researchtime, dm_researchtime_level, prem_conveyors_l, prem_conveyors_l_days, prem_conveyors_s, prem_conveyors_s_days, prem_conveyors_t, prem_conveyors_t_days, arsenal_conveyor1_level, arsenal_conveyor2_level, arsenal_conveyor3_level, peacefull_exp_light, rpg_technocrate, peacefull_exp_medium, peacefull_exp_heavy, rpg_defenseur, peacefull_exp_level FROM %%USERS%% WHERE id = :userId;';
			$getUserControll = database::get()->selectSingle($sql, array(
				':userId'		=> $USER['id'],
			));
				
			$sql	= 'SELECT '.$select_buildings.$select_fleets.$select_defenses.$select_conveyors.' b_hangar_id, b_defense_id, b_building, b_building_id, id, id_owner, field_current, field_max, isAlliancePlanet, metal, crystal, deuterium, galaxy, system, planet, planet_type, image FROM %%PLANETS%% WHERE ';
			if($PLANET['isAlliancePlanet'] != 0){
				$sql	.= 'planet_type = 1 AND isAlliancePlanet = :isAlliancePlanet AND destruyed = 0;';
				$getPlanetControll = database::get()->select($sql, array(
					':isAlliancePlanet'	=> $getUserControll['ally_id'],
				));
			}elseif($PLANET['planet_type'] == 1){
				$sql	.= 'id_owner = :id_owner AND planet_type = 1 AND isAlliancePlanet = 0 AND destruyed = 0;';
				$getPlanetControll = database::get()->select($sql, array(
					':id_owner'			=> $getUserControll['id'],
				));
			}else{
				$sql 	.= 'id_owner = :id_owner AND planet_type != 1 AND isAlliancePlanet = 0 AND destruyed = 0;';
				$getPlanetControll = database::get()->select($sql, array(
					':id_owner'			=> $getUserControll['id'],
				));
			}
			
			$premium_build_queu = 0;
			if($getUserControll['prem_o_build'] > 0 && $getUserControll['prem_o_build_days'] > TIMESTAMP){
				$premium_build_queu = $getUserControll['prem_o_build'];
			}
			
			$academy_p_b_2_1208 = 0;
			if($getUserControll['academy_p_b_2_1208'] > 0){
				$academy_p_b_2_1208 = $getUserControll['academy_p_b_2_1208'] * 25;
			}
				
			if($productCount >= 1 && in_array($productId, $ElementsBuild)){
				foreach($getPlanetControll as $UniqueControll){
					$productCount = min($productCount, config::get()->max_elements_build + $premium_build_queu);
					for ($i = 0; $i < $productCount; $i++){
						$AddMode = true;
						
						if(!BuildFunctions::isTechnologieAccessible($getUserControll, $UniqueControll, $productId) 
							|| ($productId == 31 && $getUserControll["b_tech_planet"] != 0) 
							|| (($productId == 15 || $productId == 21) && !empty($UniqueControll['b_hangar_id']) && !empty($UniqueControll['b_defense_id']))
							|| (!$AddMode && $UniqueControll[$resource[$productId]] == 0)
						) continue;
						
						$CurrentQueue  		= unserialize($UniqueControll['b_building_id']);

						if (!empty($CurrentQueue)) {
							$ActualCount	= count($CurrentQueue);
						} else {
							$CurrentQueue	= array();
							$ActualCount	= 0;
						}
						
						$CurrentMaxFields  	= CalculateMaxPlanetFields($UniqueControll);
							
						if ((config::get()->max_elements_build + $premium_build_queu != 0 && $ActualCount == config::get()->max_elements_build + $premium_build_queu)
							|| ($AddMode && $UniqueControll["field_current"] >= ($CurrentMaxFields - $ActualCount)))
						{
							continue;
						}
						
						$BuildMode 			= 'build';
						$BuildLevel			= $UniqueControll[$resource[$productId]] + (int) $AddMode;
						
						if($ActualCount == 0)
						{
							if($pricelist[$productId]['max'] < $BuildLevel) continue;
							
							if($UniqueControll['isAlliancePlanet'] != 0){
								$costResources		= BuildFunctions::getElementPriceAlliance($getUserControll, $UniqueControll, $productId, !$AddMode);
							}else{
								$costResources		= BuildFunctions::getElementPrice($getUserControll, $UniqueControll, $productId, !$AddMode);
							}
							
							if(!BuildFunctions::isElementBuyable($getUserControll, $UniqueControll, $productId, $costResources)) continue;
							
							$account_before = array(
								'darkmatter'			=> $getUserControll['darkmatter'],
								'antimatter'			=> $getUserControll['antimatter'],
								'metal'					=> $UniqueControll['metal'],
								'crystal'				=> $UniqueControll['crystal'],
								'deuterium'				=> $UniqueControll['deuterium'],
								'building'				=> $LNG['tech'][$productId],
							);
							
							if(isset($costResources[901])) { $UniqueControll[$resource[901]]	-= $costResources[901]; }
							if(isset($costResources[902])) { $UniqueControll[$resource[902]]	-= $costResources[902]; }
							if(isset($costResources[903])) { $UniqueControll[$resource[903]]	-= $costResources[903]; }
							if(isset($costResources[921])) { $getUserControll[$resource[921]]	-= $costResources[921]; }
							if(isset($costResources[922])) { $getUserControll[$resource[922]]	-= $costResources[922]; }
							
							$elementTime    			= BuildFunctions::getBuildingTime($getUserControll, $UniqueControll, $productId, $costResources);
							$BuildEndTime				= TIMESTAMP + $elementTime;
							
							$UniqueControll['b_building_id']	= serialize(array(array($productId, $BuildLevel, $elementTime, $BuildEndTime, $BuildMode)));
							$UniqueControll['b_building']		= $BuildEndTime;
							
							$sql	= 'UPDATE %%USERS%% SET darkmatter = darkmatter - :darkmatter WHERE id = :userId;';
							database::get()->update($sql, array(
								':darkmatter'	=> isset($costResources[921]) ? $costResources[921] : 0,
								':userId'		=> $getUserControll['id'],
							));
							
							$sql	= 'UPDATE %%PLANETS%% SET metal = metal - :metal, crystal = crystal - :crystal, deuterium = deuterium - :deuterium, b_building_id = :b_building_id, b_building = :b_building WHERE id = :planetId;';
							database::get()->update($sql, array(
								':metal'		=> isset($costResources[901]) ? $costResources[901] : 0,
								':crystal'		=> isset($costResources[902]) ? $costResources[902] : 0,
								':deuterium'	=> isset($costResources[903]) ? $costResources[903] : 0,
								':b_building_id'=> serialize(array(array($productId, $BuildLevel, $elementTime, $BuildEndTime, $BuildMode))),
								':b_building'	=> $BuildEndTime,
								':planetId'		=> $UniqueControll['id'],
							));
							
							$account_after = array(
								'darkmatter'			=> isset($costResources[921]) ? $costResources[921] : 0,
								'antimatter'			=> isset($costResources[922]) ? $costResources[922] : 0,
								'metal'					=> isset($costResources[901]) ? $costResources[901] : 0,
								'crystal'				=> isset($costResources[902]) ? $costResources[902] : 0,
								'deuterium'				=> isset($costResources[903]) ? $costResources[903] : 0,
								'building'				=> $LNG['tech'][$productId],
							);
							
							$LOG = new Logcheck(25);
							$LOG->username = $getUserControll['username'];
							$LOG->pageLog = "page=buildings [".$UniqueControll['galaxy'].":".$UniqueControll['system'].":".$UniqueControll['planet']."]";
							$LOG->old = $account_before;
							$LOG->new = $account_after;
							$LOG->save();
						} else {
							$addLevel = 0;
							foreach($CurrentQueue as $QueueSubArray)
							{
								if($QueueSubArray[0] != $productId)
									continue;
									
								if($QueueSubArray[4] == 'build')
									$addLevel++;
								else
									$addLevel--;
							}
							
							$BuildLevel					+= $addLevel;
							
							if(!$AddMode && $BuildLevel == 0)
								continue;
								
							if($pricelist[$productId]['max'] < $BuildLevel)
								continue;
								
							$elementTime    			= BuildFunctions::getBuildingTime($getUserControll, $UniqueControll, $productId, NULL, !$AddMode, $BuildLevel);
														
							$BuildEndTime				= $CurrentQueue[$ActualCount - 1][3] + $elementTime;
							$CurrentQueue[]				= array($productId, $BuildLevel, $elementTime, $BuildEndTime, $BuildMode);
							$UniqueControll['b_building_id']	= serialize($CurrentQueue);		
							
							$sql	= 'UPDATE %%PLANETS%% SET b_building_id = :b_building_id WHERE id = :planetId;';
							database::get()->update($sql, array(
								':b_building_id'=> serialize($CurrentQueue),
								':planetId'		=> $UniqueControll['id'],
							));
						}
					}
				}
			}elseif($productCount >= 1 && in_array($productId, $ElementsFleet)){
				foreach($getPlanetControll as $UniqueControll){
					$Missiles	= array(
						502	=> $UniqueControll[$resource[502]],
						503	=> $UniqueControll[$resource[503]],
					);
					
					
					$Domes	= array(
						407	=> $UniqueControll[$resource[407]],
						408	=> $UniqueControll[$resource[408]],
						409	=> $UniqueControll[$resource[409]],
					);
					
					$Orbits	= array(
						411	=> $UniqueControll[$resource[411]],
					);
					
					if(empty($productCount)
						|| !in_array($productId, $reslist['fleet'])
						|| !BuildFunctions::isTechnologieAccessible($getUserControll, $UniqueControll, $productId)
					) {
						continue;
					}
					
					$ElementQueue 	= unserialize($UniqueControll['b_hangar_id']);
					if(empty($ElementQueue))
						$CountList	= 0;
					else
						$CountList	= count($ElementQueue);
					
					$maxBuildQueue	= Config::get()->max_elements_ships;
					if ($maxBuildQueue != 0 && $CountList >= $maxBuildQueue)
					{
						continue;
					}
						
					$MaxElements 	= BuildFunctions::getMaxConstructibleElements($getUserControll, $UniqueControll, $productId);
					$Count			= is_numeric($productCount) ? round($productCount) : 0;
					$Count 			= max(min($Count, Config::get()->max_fleet_per_build), 0);
					$Count 			= min($Count, $MaxElements);
						
					$BuildArray    	= !empty($UniqueControll['b_hangar_id']) ? unserialize($UniqueControll['b_hangar_id']) : array();
						
					if(empty($Count))
						continue;
							
					$costResources	= BuildFunctions::getElementPrice($getUserControll, $UniqueControll, $productId, false, $Count);
						
					$account_before = array(
						'darkmatter'			=> $getUserControll['darkmatter'],
						'antimatter'			=> $getUserControll['antimatter'],
						'metal'					=> $UniqueControll['metal'],
						'crystal'				=> $UniqueControll['crystal'],
						'deuterium'				=> $UniqueControll['deuterium'],
						'ship'					=> $LNG['tech'][$productId],
					);
					
					if(isset($costResources[901])) { $UniqueControll[$resource[901]]	-= $costResources[901]; }
					if(isset($costResources[902])) { $UniqueControll[$resource[902]]	-= $costResources[902]; }
					if(isset($costResources[903])) { $UniqueControll[$resource[903]]	-= $costResources[903]; }
					if(isset($costResources[921])) { $getUserControll[$resource[921]]	-= $costResources[921]; }
					if(isset($costResources[922])) { $getUserControll[$resource[922]]	-= $costResources[922]; }
					
					$BuildArray[]			= array($productId, $Count);
					$UniqueControll['b_hangar_id']	= serialize($BuildArray);
						
					$sql	= 'UPDATE %%USERS%% SET darkmatter = darkmatter - :darkmatter WHERE id = :userId;';
					database::get()->update($sql, array(
						':darkmatter'	=> isset($costResources[921]) ? $costResources[921] : 0,
						':userId'		=> $getUserControll['id'],
					));
							
					$sql	= 'UPDATE %%PLANETS%% SET metal = metal - :metal, crystal = crystal - :crystal, deuterium = deuterium - :deuterium, b_hangar_id = :b_hangar_id WHERE id = :planetId;';
					database::get()->update($sql, array(
						':metal'		=> isset($costResources[901]) ? $costResources[901] : 0,
						':crystal'		=> isset($costResources[902]) ? $costResources[902] : 0,
						':deuterium'	=> isset($costResources[903]) ? $costResources[903] : 0,
						':b_hangar_id'	=> serialize($BuildArray),
						':planetId'		=> $UniqueControll['id'],
					));
						
					$account_after = array(
						'darkmatter'			=> isset($costResources[921]) ? $costResources[921] : 0,
						'antimatter'			=> isset($costResources[922]) ? $costResources[922] : 0,
						'metal'					=> isset($costResources[901]) ? $costResources[901] : 0,
						'crystal'				=> isset($costResources[902]) ? $costResources[902] : 0,
						'deuterium'				=> isset($costResources[903]) ? $costResources[903] : 0,
						'ship'					=> $LNG['tech'][$productId]." - ".$Count,
					);
						
					$LOG = new Logcheck(27);
					$LOG->username = $getUserControll['username'];
					$LOG->pageLog = "page=shipyard [".$UniqueControll['galaxy'].":".$UniqueControll['system'].":".$UniqueControll['planet']."]";
					$LOG->old = $account_before;
					$LOG->new = $account_after;
					$LOG->save();
				}
			}elseif($productCount >= 1 && in_array($productId, $ElementsDefense)){
				foreach($getPlanetControll as $UniqueControll){
					$Missiles	= array(
						502	=> $UniqueControll[$resource[502]],
						503	=> $UniqueControll[$resource[503]],
					);
					
					$Domes	= array(
						407	=> $UniqueControll[$resource[407]],
						408	=> $UniqueControll[$resource[408]],
						409	=> $UniqueControll[$resource[409]],
					);
					
					$Orbits	= array(
						411	=> $UniqueControll[$resource[411]],
					);
					
					if(empty($productCount)
						|| !in_array($productId, $ElementsDefense)
						|| !BuildFunctions::isTechnologieAccessible($getUserControll, $UniqueControll, $productId)
					) {
						continue;
					}
					
					$ElementQueue 	= unserialize($UniqueControll['b_defense_id']);
					if(empty($ElementQueue))
						$CountList	= 0;
					else
						$CountList	= count($ElementQueue);
					
					$maxBuildQueue	= Config::get()->max_elements_ships;
					if ($maxBuildQueue != 0 && $CountList >= $maxBuildQueue)
					{
						continue;
					}
					
					$MaxElements 	= BuildFunctions::getMaxConstructibleElements($getUserControll, $UniqueControll, $productId);
					$Count			= is_numeric($productCount) ? round($productCount) : 0;
					$Count 			= max(min($Count, Config::get()->max_fleet_per_build), 0);
					$Count 			= min($Count, $MaxElements);
					
					$BuildArray    	= !empty($UniqueControll['b_defense_id']) ? unserialize($UniqueControll['b_defense_id']) : array();
					if (in_array($productId, $reslist['missile']))
					{
						$MaxMissiles		= BuildFunctions::getMaxConstructibleRockets($getUserControll, $UniqueControll, $Missiles);
						$Count 				= min($Count, $MaxMissiles[$productId]);

						$Missiles[$productId] += $Count;
					}elseif ($productId == 407 || $productId == 408 || $productId == 409)
					{
						$MaxDomes		= BuildFunctions::getMaxConstructibleDomes($getUserControll, $UniqueControll, $Domes);
						$Count 				= min($Count, $MaxDomes[$productId]);
						$Domes[$productId] += $Count;
					}elseif ($productId == 411)
					{
						$MaxOrbits		= BuildFunctions::getMaxConstructibleOrbits($getUserControll, $UniqueControll, $Orbits);
						$Count 				= min($Count, $MaxOrbits[$productId]);
						$Orbits[$productId] += $Count;
					}elseif(in_array($productId, $reslist['one'])) {
						$InBuild	= false;
						foreach($BuildArray as $ElementArray) {
							if($ElementArray[0] == $productId) {
								$InBuild	= true;
								break;
							}
						}
						
						if ($InBuild)
							continue;

						if($Count != 0 && $UniqueControll[$resource[$productId]] == 0 && $InBuild === false)
							$Count =  1;
					}

					if(empty($Count))
						continue;
					
					$costResources	= BuildFunctions::getElementPrice($getUserControll, $UniqueControll, $productId, false, $Count);
			
					$account_before = array(
						'darkmatter'			=> $getUserControll['darkmatter'],
						'antimatter'			=> $getUserControll['antimatter'],
						'metal'					=> $UniqueControll['metal'],
						'crystal'				=> $UniqueControll['crystal'],
						'deuterium'				=> $UniqueControll['deuterium'],
						'ship'					=> $LNG['tech'][$productId],
					);
					
					if(isset($costResources[901])) { $UniqueControll[$resource[901]]	-= $costResources[901]; }
					if(isset($costResources[902])) { $UniqueControll[$resource[902]]	-= $costResources[902]; }
					if(isset($costResources[903])) { $UniqueControll[$resource[903]]	-= $costResources[903]; }
					if(isset($costResources[921])) { $getUserControll[$resource[921]]	-= $costResources[921]; }
					if(isset($costResources[922])) { $getUserControll[$resource[922]]	-= $costResources[922]; }
					
					$BuildArray[]			= array($productId, $Count);
					$UniqueControll['b_defense_id']	= serialize($BuildArray);
					
					$sql	= 'UPDATE %%USERS%% SET darkmatter = darkmatter - :darkmatter WHERE id = :userId;';
					database::get()->update($sql, array(
						':darkmatter'	=> isset($costResources[921]) ? $costResources[921] : 0,
						':userId'		=> $getUserControll['id'],
					));
							
					$sql	= 'UPDATE %%PLANETS%% SET metal = metal - :metal, crystal = crystal - :crystal, deuterium = deuterium - :deuterium, b_defense_id = :b_defense_id WHERE id = :planetId;';
					database::get()->update($sql, array(
						':metal'		=> isset($costResources[901]) ? $costResources[901] : 0,
						':crystal'		=> isset($costResources[902]) ? $costResources[902] : 0,
						':deuterium'	=> isset($costResources[903]) ? $costResources[903] : 0,
						':b_defense_id'	=> serialize($BuildArray),
						':planetId'		=> $UniqueControll['id'],
					));
					
					$account_after = array(
						'darkmatter'			=> isset($costResources[921]) ? $costResources[921] : 0,
						'antimatter'			=> isset($costResources[922]) ? $costResources[922] : 0,
						'metal'					=> isset($costResources[901]) ? $costResources[901] : 0,
						'crystal'				=> isset($costResources[902]) ? $costResources[902] : 0,
						'deuterium'				=> isset($costResources[903]) ? $costResources[903] : 0,
						'ship'					=> $LNG['tech'][$Element]." - ".$Count,
					);
					
					$LOG = new Logcheck(28);
					$LOG->username = $getUserControll['username'];
					$LOG->pageLog = "page=defense [".$UniqueControll['galaxy'].":".$UniqueControll['system'].":".$UniqueControll['planet']."]";
					$LOG->old = $account_before;
					$LOG->new = $account_after;
					$LOG->save();
				}
			}
		}
		echo 'ok';
	}
}
