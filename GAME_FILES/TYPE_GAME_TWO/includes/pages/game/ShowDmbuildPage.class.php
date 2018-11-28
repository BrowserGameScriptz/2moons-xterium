<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan Kr�pke
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
 * @author Jan Kr�pke <info@2moons.cc>
 * @copyright 2012 Jan Kr�pke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.2 (2013-03-18)
 * @info $Id$
 * @link http://2moons.cc/
 */

class ShowDmbuildPage extends AbstractGamePage
{	
	public static $requireModule = MODULE_BUILDING;
	
	function __construct() 
	{
		parent::__construct();
	}

	private function AddBuildingToQueue($Element, $AddMode = true)	
	{
		global $PLANET, $USER, $resource, $reslist, $pricelist;
		
		if(!in_array($Element, $reslist['allow'][$PLANET['planet_type']])
			|| !BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element) 
			|| ($Element == 31 && $USER["b_tech_planet"] != 0) 
			|| (($Element == 15 || $Element == 21) && !empty($PLANET['b_hangar_id']))
			|| (!$AddMode && $PLANET[$resource[$Element]] == 0)
		)
			return;
		
		$CurrentQueue  		= unserialize($PLANET['b_building_id']);

				
		
			$ActualCount	= 0;
		
		
		$CurrentMaxFields  	= CalculateMaxPlanetFields($PLANET);

		$config	= Config::get();

		if (($AddMode && $PLANET["field_current"] >= ($CurrentMaxFields - $ActualCount)))
		{
			return;
		}
	
		$BuildMode 			= $AddMode ? 'build' : 'destroy';
		$BuildLevel			= $PLANET[$resource[$Element]] + (int) $AddMode;
		
		if($ActualCount == 0)
		{
			if($pricelist[$Element]['max'] < $BuildLevel)
				return;

			$costResources		= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element, !$AddMode);
			
			$account_before = array(
				$resource[$Element]	=> $PLANET[$resource[$Element]],
				'darkmatter'			=> $USER['darkmatter'],
				'price'					=> $costResources[921],
			);
			
			if(!BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $costResources))
				return;
			
			if(isset($costResources[901])) { $PLANET[$resource[901]]	-= $costResources[901]; }
			if(isset($costResources[902])) { $PLANET[$resource[902]]	-= $costResources[902]; }
			if(isset($costResources[903])) { $PLANET[$resource[903]]	-= $costResources[903]; }
			if(isset($costResources[921])) { $USER[$resource[921]]		-= $costResources[921]; }
			if(isset($costResources[922])) { $USER[$resource[922]]		-= $costResources[922]; }
			
			$elementTime    			= 0;
			$BuildEndTime				= TIMESTAMP + $elementTime;
			
			$PLANET['field_current'] += 1;
			$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :userLevel, field_current = field_current + 1 WHERE id = :planetId;";
			database::get()->update($sql, array(
				':userLevel'	=> 1,
				':planetId'		=> $PLANET['id']
			));
			
			if(TIMESTAMP < config::get()->dmRefundEvent){
				$sql	= 'INSERT INTO %%DMREFUND%% SET userId = :userId, darkAmount = :darkAmount, timestamp = :timestamp;';
				database::get()->insert($sql, array(
					':userId'		=> $USER['id'],
					':darkAmount'	=> $costResources[921],
					':timestamp'	=> TIMESTAMP
				));
			}
			
			$sql	= 'SELECT darkmatter FROM %%USERS%% WHERE id = :userId;';
			$getUser = database::get()->selectSingle($sql, array(
				':userId'		=> $USER['id'],
			));
			
			$sql	= 'SELECT '.$resource[$Element].' FROM %%PLANETS%% WHERE id = :userId;';
			$getPlanet = database::get()->selectSingle($sql, array(
				':userId'		=> $PLANET['id'],
			));
			
			$account_after = array(
				$resource[$Element]	=> $getPlanet[$resource[$Element]],
				'darkmatter'			=> $getUser['darkmatter'],
				'price'					=> $costResources[921],
			);
			
			$LOG = new Logcheck(9);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=dmbuild [Buy Buildings]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
			
		} else {
			$addLevel = 0;
			foreach($CurrentQueue as $QueueSubArray)
			{
				if($QueueSubArray[0] != $Element)
					continue;
					
				if($QueueSubArray[4] == 'build')
					$addLevel++;
				else
					$addLevel--;
			}
			
			$BuildLevel					+= $addLevel;
			
			if(!$AddMode && $BuildLevel == 0)
				return;
				
			if($pricelist[$Element]['max'] < $BuildLevel)
				return;
				
			$elementTime    			= 0;
			$BuildEndTime				= $CurrentQueue[$ActualCount - 1][3] + $elementTime;
			$CurrentQueue[]				= array($Element, $BuildLevel, $elementTime, $BuildEndTime, $BuildMode);
			$PLANET['b_building_id']	= serialize($CurrentQueue);		
		}
		
			

	}

	private function getQueueData()
	{
		global $LNG, $PLANET, $USER;
		
		$scriptData		= array();
		$quickinfo		= array();
		
		if ($PLANET['b_building'] == 0 || $PLANET['b_building_id'] == "")
			return array('queue' => $scriptData, 'quickinfo' => $quickinfo);
		
		$buildQueue		= unserialize($PLANET['b_building_id']);
		
		foreach($buildQueue as $BuildArray) {
			if ($BuildArray[3] < TIMESTAMP)
				continue;
			
			$quickinfo[$BuildArray[0]]	= $BuildArray[1];
			
			$scriptData[] = array(
				'element'	=> $BuildArray[0], 
				'level' 	=> $BuildArray[1], 
				'time' 		=> $BuildArray[2], 
				'resttime' 	=> ($BuildArray[3] - TIMESTAMP), 
				'destroy' 	=> ($BuildArray[4] == 'destroy'), 
				'endtime' 	=> _date('U', $BuildArray[3], $USER['timezone']),
				'display' 	=> _date($LNG['php_tdformat'], $BuildArray[3], $USER['timezone']),
			);
		}
		
		return array('queue' => $scriptData, 'quickinfo' => $quickinfo);
	}

	public function show()
	{
		global $ProdGrid, $LNG, $resource, $reslist, $PLANET, $USER, $pricelist, $requeriments;
		
		$TheCommand		= HTTP::_GP('cmd', '');
		$this->redirectTo('game.php?page=buildings');
		// wellformed buildURLs
		if(!empty($TheCommand) && $_SERVER['REQUEST_METHOD'] === 'POST' && $USER['urlaubs_modus'] == 0)
		{
			$Element     	= HTTP::_GP('building', 0);
			$ListID      	= HTTP::_GP('listid', 0);
			$lvlup      	= HTTP::_GP('lvlup', 0);
			$lvlup1      	= HTTP::_GP('lvlup1', 0);
			switch($TheCommand)
			{
				
				case 'insert':
					$this->AddBuildingToQueue($Element, true);
				break;
				
			}
			
			$this->redirectTo('game.php?page=dmbuild');
		}

		$config				= Config::get();

		$queueData	 		= $this->getQueueData();
		$Queue	 			= $queueData['queue'];
		$QueueCount			= count($Queue);
		$CanBuildElement 	= isVacationMode($USER);
		$CurrentMaxFields   = CalculateMaxPlanetFields($PLANET);
		
		$RoomIsOk 			= $PLANET['field_current'] < ($CurrentMaxFields - $QueueCount);
				
		$BuildEnergy		= $USER[$resource[113]];
		$BuildLevelFactor   = 10;
		$BuildTemp          = $PLANET['temp_max'];

        $BuildInfoList      = array();
		
		
		if($PLANET['planet_type'] == 1){
		$Elements			= array(1,2,3,4,6,12,14,15,21,22,23,24,31,34,44,71,72,73);
		}else{
		$Elements 			= array(14,15,21,34,41,42,43,71,72,73);
		}
		foreach($Elements as $Element)
		{

				
				if (!BuildFunctions::isBusyToBuild($USER, $PLANET, $Element))
				continue;
			
				$techTreeList		 = array();
                $requirementsList	= array();
                if(isset($requeriments[$Element]))
                {
                    foreach($requeriments[$Element] as $requireID => $RedCount)
                    {
                        $requirementsList[$requireID]	= array(
                            'count' => $RedCount,
                            'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
                        );
                    }
                }

                $techTreeList[$Element]	= $requirementsList;
            
        
		
			$infoEnergy	= "";
			
			if(isset($queueData['quickinfo'][$Element]))
			{
				$levelToBuild	= $queueData['quickinfo'][$Element];
			}
			else
			{
				$levelToBuild	= $PLANET[$resource[$Element]];
			}
			
			if(in_array($Element, $reslist['prod']))
			{
				
				$academy_p_b_2_1209 = 0;
				if($USER['academy_p_b_2_1209'] > 0){
				$academy_p_b_2_1209 = $USER['academy_p_b_2_1209'] * 3;
				}
			
				$academy_p_b_2_1210 = 0;
				if($USER['academy_p_b_2_1210'] > 0){
				$academy_p_b_2_1210 = $USER['academy_p_b_2_1210'] * 3;
				}
				
				$db	= Database::get();
				$sql	= 'SELECT * FROM %%PLANETIMG%% WHERE imageId = :imageId;';
				$planetStructureBonuses = $db->selectSingle($sql, array(
				':imageId'	=> $PLANET['image']
				));
			
				$planetStrucMetal = $planetStructureBonuses['bonus_metal'];
				$planetStrucCrystal = $planetStructureBonuses['bonus_crystal'];
				$planetStrucDeuterium = $planetStructureBonuses['bonus_deuterium'];
				$planetStrucEnergy = $planetStructureBonuses['bonus_energy'];
				$userPeaceExp = $USER['peacefull_exp_level'];
		
				$premium_resource = 0;
				if($USER['prem_res'] > 0 && $USER['prem_res_days'] > TIMESTAMP){
				$premium_resource = $USER['prem_res'];
				}
		
				$premium_collider =  0;
				if($USER['prem_prod_from_colly'] > 0 && $USER['prem_prod_from_colly_days'] > TIMESTAMP){
				$premium_collider = $USER['prem_prod_from_colly'];
				}
				
				$gouvernor_resource = 0;
				if($USER['dm_resource'] > TIMESTAMP){
				$gouvernor_resource = GubPriceAPSTRACT(704, $USER['dm_resource_level'], 'dm_resource');
				}
			
				$gouvernor_energy = 0;
				if($USER['dm_energie'] > TIMESTAMP){
				$gouvernor_energy = GubPriceAPSTRACT(705, $USER['dm_energie_level'], 'dm_energie');
				}
		
				$academy_p_b_2_1201 = 0;
				if($USER['academy_p_b_2_1201'] > 0){
				$academy_p_b_2_1201 = $USER['academy_p_b_2_1201'] * 5;
				}
		
				$academy_p_b_2_1202 = 0;
				if($USER['academy_p_b_2_1202'] > 0){
				$academy_p_b_2_1202 = $USER['academy_p_b_2_1202'] * 2;
				}
				
				$geologuebon = 2 * $USER['rpg_geologue'];
			
				$arsenal_1_eco = $pricelist[814]['arsenal_bonus'] * $USER['arsenal_res901_level'];
				$arsenal_2_eco = $pricelist[815]['arsenal_bonus'] * $USER['arsenal_res902_level'];
				$arsenal_3_eco = $pricelist[816]['arsenal_bonus'] * $USER['arsenal_res903_level'];	
				
				$hashallyprod = 0;
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
				$allyInfores = $db->selectSingle($sql, array(
				':allianceId'	=> $USER['ally_id']
				));
				if($USER['ally_id'] != 0){
				$hashallyprod = $allyInfores['total_alliance_production'];	
				} 
				
				$BuildLevel	= $PLANET[$resource[$Element]];
				$Need		= eval(ResourceUpdate::getProd($ProdGrid[$Element]['production'][911]));
									
				$BuildLevel	= $levelToBuild + 1;
				$Prod		= eval(ResourceUpdate::getProd($ProdGrid[$Element]['production'][911]));
					
				$requireEnergy	= $Prod - $Need;
				$requireEnergy	= round($requireEnergy * $config->energySpeed);

				if($requireEnergy < 0) {
					$infoEnergy	= sprintf($LNG['bd_need_engine'], pretty_number(abs($requireEnergy)), $LNG['tech'][911]);
				} else {
					$infoEnergy	= sprintf($LNG['bd_more_engine'], pretty_number(abs($requireEnergy)), $LNG['tech'][911]);
				}
			}

			$costResources		= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element, false, $levelToBuild);
			$costOverflow		= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $costResources);
			$elementTime    	= 0;
			$buyable			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $costResources);

			$BuildInfoList[$Element]	= array(
				'level'				=> $PLANET[$resource[$Element]],
				'maxLevel'			=> $pricelist[$Element]['max'],
				'factor'			=> $pricelist[$Element]['factor'],
				'infoEnergy'		=> $infoEnergy,
				'costResources'		=> $costResources,
				'costOverflow'		=> $costOverflow,
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'levelToBuild'		=> $levelToBuild,
				'AllTech'			=> $techTreeList,
				'techacc'			 => BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element),
			);
		}

		
		
		$this->tplObj->loadscript('buildlist.js'); 
		
		
		$this->assign(array(
			'BuildInfoList'		=> $BuildInfoList,
			'field_current'		=> $PLANET['field_current'],
			'field_max'			=> CalculateMaxPlanetFields($PLANET),
			'field_free'		=> CalculateMaxPlanetFields($PLANET) - $PLANET['field_current'],
			'field_pircent'		=> 100 / CalculateMaxPlanetFields($PLANET) * $PLANET['field_current'],
			'CanBuildElement'	=> $CanBuildElement,
			'RoomIsOk'			=> $RoomIsOk,
			'Queue'				=> $Queue,
			'isBusy'			=> array('shipyard' => !empty($PLANET['b_hangar_id']), 'research' => $USER['b_tech_planet'] != 0),
			'HaveMissiles'		=> (bool) $PLANET[$resource[503]] + $PLANET[$resource[502]],
		));
			
		$this->display('page.dmbuild.default.tpl');
	}
}