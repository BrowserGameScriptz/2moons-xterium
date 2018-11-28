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

class ShowBuildingsPage extends AbstractGamePage
{	
	public static $requireModule = MODULE_BUILDING;
	private $build_anz=0;
	private $bOnInsert=FALSE;
	function __construct() 
	{
		parent::__construct();
	}
	
	private function CancelBuildingFromQueue()
	{
		global $PLANET, $USER, $resource;
		$CurrentQueue  = unserialize($PLANET['b_building_id']);
		if (empty($CurrentQueue))
		{
			$PLANET['b_building_id']	= '';
			$PLANET['b_building']		= 0;
			return false;
		}
	
		$Element             	= $CurrentQueue[0][0];
		$BuildMode          	= $CurrentQueue[0][4];
		
		$costResources			= BuildFunctions::getElementPrice($USER, $PLANET, $Element, $BuildMode == 'destroy');
		
		if(isset($costResources[901])) { $PLANET[$resource[901]]	+= $costResources[901]; }
		if(isset($costResources[902])) { $PLANET[$resource[902]]	+= $costResources[902]; }
		if(isset($costResources[903])) { $PLANET[$resource[903]]	+= $costResources[903]; }
		if(isset($costResources[921])) { $USER[$resource[921]]		+= $costResources[921]; }
		if(isset($costResources[922])) { $USER[$resource[922]]		+= $costResources[922]; }
		array_shift($CurrentQueue);
		if (count($CurrentQueue) == 0) {
			$PLANET['b_building']    	= 0;
			$PLANET['b_building_id'] 	= '';
		} else {
			$BuildEndTime	= TIMESTAMP;
			$NewQueueArray	= array();
			foreach($CurrentQueue as $ListIDArray) {
				if($Element == $ListIDArray[0])
					continue;
					
				$BuildEndTime       += BuildFunctions::getBuildingTime($USER, $PLANET, $ListIDArray[0], NULL, $ListIDArray[4] == 'destroy');
				$ListIDArray[3]		= $BuildEndTime;
				$NewQueueArray[]	= $ListIDArray;					
			}
			
			if(!empty($NewQueueArray)) {
				$PLANET['b_building']    	= TIMESTAMP;
				$PLANET['b_building_id'] 	= serialize($NewQueueArray);
				$this->ecoObj->setData($USER, $PLANET);
				$this->ecoObj->SetNextQueueElementOnTop();
				list($USER, $PLANET)		= $this->ecoObj->getData();
			} else {
				$PLANET['b_building']    	= 0;
				$PLANET['b_building_id'] 	= '';
			}
		}
		return true;
	}

	private function RemoveBuildingFromQueue($QueueID)
	{
		global $USER, $PLANET;
		if ($QueueID <= 1 || empty($PLANET['b_building_id'])) {
            return false;
        }

		$CurrentQueue  = unserialize($PLANET['b_building_id']);
		$ActualCount   = count($CurrentQueue);
		if($ActualCount <= 1) {
			return $this->CancelBuildingFromQueue();
        }

		if ($QueueID - $ActualCount >= 2) {
    // Avoid race conditions
    return;
    }
 
		$Element		= $CurrentQueue[$QueueID - 2][0];
		$BuildEndTime	= $CurrentQueue[$QueueID - 2][3];
		unset($CurrentQueue[$QueueID - 1]);
		$NewQueueArray	= array();
		foreach($CurrentQueue as $ID => $ListIDArray)
		{				
			if ($ID < $QueueID - 1) {
				$NewQueueArray[]	= $ListIDArray;
			} else {
				if($Element == $ListIDArray[0] || empty($ListIDArray[0]))
					continue;

				$BuildEndTime       += BuildFunctions::getBuildingTime($USER, $PLANET, $ListIDArray[0]);
				$ListIDArray[3]		= $BuildEndTime;
				$NewQueueArray[]	= $ListIDArray;				
			}
		}

		if(!empty($NewQueueArray))
			$PLANET['b_building_id'] = serialize($NewQueueArray);
		else
			$PLANET['b_building_id'] = "";

        return true;
	}

	private function AddBuildingToQueue($Element, $lvlup, $lvlup1, $levelToBuildInFo, $AddMode = true)
	{
		if($this->bOnInsert==FALSE){
			$this->build_anz=(int)$lvlup - $levelToBuildInFo;
			if($this->build_anz>=1){
				$this->bOnInsert=TRUE;
				while($this->build_anz>0){
					$this->DoAddBuildingToQueue($Element, $AddMode);
					$this->build_anz=$this->build_anz-1;
				}
				$this->bOnInsert=FALSE;
			}
		}
	}
	
	private function AddBuildingToQueueDM($Element, $lvlup, $lvlup1, $levelToBuildInFo, $AddMode = true)
	{
		if($this->bOnInsert==FALSE){
			$this->build_anz=(int)$lvlup - $levelToBuildInFo;
			if($this->build_anz>=1){
				$this->bOnInsert=TRUE;
				while($this->build_anz>0){
					$this->DoAddBuildingToQueueDM($Element, $AddMode);
					$this->build_anz=$this->build_anz-1;
				}
				$this->DoAddBuildingToQueueDM($Element, $AddMode);
				$this->bOnInsert=FALSE;
			}
		}
	}
	
	private function DoAddBuildingToQueueDM($Element, $AddMode = true)	
	{
		global $PLANET, $USER, $resource, $reslist, $pricelist, $LNG;
		
		if($PLANET['isAlliancePlanet'] != 0){
			$Elements			= array();
		}elseif($PLANET['planet_type'] == 1){
			$Elements			= array(1,2,3,4,6,12,14,15,21,22,23,24,31,33,34,44,71,72,73,7);
		}else{
			$Elements 			= array(14,15,21,34,41,42,43,71,72,73);
		}
		
		if(!in_array($Element, $Elements)
			|| !BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element) 
			|| ($Element == 31 && $USER["b_tech_planet"] != 0) 
			|| (($Element == 15 || $Element == 21) && !empty($PLANET['b_hangar_id']) && !empty($PLANET['b_defense_id']))
			|| (!$AddMode && $PLANET[$resource[$Element]] == 0)
		)
			return;
		
		$CurrentQueue  		= unserialize($PLANET['b_building_id']);

				
		if (!empty($CurrentQueue)) {
			$ActualCount	= count($CurrentQueue);
		} else {
			$CurrentQueue	= array();
			$ActualCount	= 0;
		}
		
		$CurrentMaxFields  	= CalculateMaxPlanetFields($PLANET);

		$config	= Config::get();
		$premium_build_queu = 0;
		if($USER['prem_o_build'] > 0 && $USER['prem_o_build_days'] > TIMESTAMP){
		$premium_build_queu = $USER['prem_o_build'];
		}
			
			
		if (($config->max_elements_build + $premium_build_queu != 0 && $ActualCount == $config->max_elements_build + $premium_build_queu)
			|| ($AddMode && $PLANET["field_current"] >= ($CurrentMaxFields - $ActualCount)))
		{
			return;
		}
	
		$BuildMode 			= 'build';
		$BuildLevel			= $PLANET[$resource[$Element]] + 1;
		
		if($ActualCount == 0)
		{
			if($pricelist[$Element]['max'] < $BuildLevel)
				return;
			
			if($PLANET['isAlliancePlanet'] != 0){
				$costResources		= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element, !$AddMode);
			}else{
				$costResources		= BuildFunctions::getElementPriceDMAlliance($USER, $PLANET, $Element, !$AddMode);
			}
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
				
			$elementTime    			= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, NULL, !$AddMode, $BuildLevel);
			
			if($USER['tutorial'] == 18 && $Element == 31 && $BuildLevel <= 3 || $USER['tutorial'] == 33 && $Element == 21 && $BuildLevel <= 4 || $USER['tutorial'] == 34 && $Element == 31 && $BuildLevel <= 6)
				$elementTime = 0;
			
			$BuildEndTime				= $CurrentQueue[$ActualCount - 1][3] + $elementTime;
			$CurrentQueue[]				= array($Element, $BuildLevel, $elementTime, $BuildEndTime, $BuildMode);
			$PLANET['b_building_id']	= serialize($CurrentQueue);		
		}
		$db = Database::get();
		if($USER['tutorial'] == 4 && $Element == 4){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 5
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 6 && $Element == 1 && $BuildLevel >= 3){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 7
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 7 && $Element == 2 && $BuildLevel >= 2){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 8
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 8 && $Element == 3 && $BuildLevel >= 1){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 9
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 10 && $Element == 4 && $BuildLevel >= 5){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 11,
			peacefull_exp_current	= peacefull_exp_current + :peacefull_exp_current
			WHERE id = :userID;";
			$db->update($sql, array(
			':peacefull_exp_current'			=> 650,
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 18 && $Element == 31 && $BuildLevel >= 3){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 19,
			peacefull_exp_current	= peacefull_exp_current + :peacefull_exp_current
			WHERE id = :userID;";
			$db->update($sql, array(
			':peacefull_exp_current'			=> 650,
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 23 && $Element == 14 && $BuildLevel >= 2){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 24
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 24 && $Element == 21 && $BuildLevel >= 2){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 25
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 33 && $Element == 21 && $BuildLevel >= 4){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 34
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 34 && $Element == 31 && $BuildLevel >= 6){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 35
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		} 

	}
	
	private function DoAddBuildingToQueue($Element, $AddMode = true)	
	{
		global $PLANET, $USER, $resource, $reslist, $pricelist, $LNG;
		
		if($PLANET['isAlliancePlanet'] != 0){
			$Elements			= array(14,15,21,22,23,24,33,34,44,71,72,73, 50, 51, 52);
		}elseif($PLANET['planet_type'] == 1){
			$Elements			= array(1,2,3,4,6,12,14,15,21,22,23,24,31,33,34,44,71,72,73,7);
		}else{
			$Elements 			= array(14,15,21,34,41,42,43,71,72,73);
		}
		
		if(!in_array($Element, $Elements)
			|| !BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element) 
			|| ($Element == 31 && $USER["b_tech_planet"] != 0) 
			|| (($Element == 15 || $Element == 21) && !empty($PLANET['b_hangar_id']) && !empty($PLANET['b_defense_id']))
			|| (!$AddMode && $PLANET[$resource[$Element]] == 0)
		)
			return;
		
		$CurrentQueue  		= unserialize($PLANET['b_building_id']);

				
		if (!empty($CurrentQueue)) {
			$ActualCount	= count($CurrentQueue);
		} else {
			$CurrentQueue	= array();
			$ActualCount	= 0;
		}
		
		$CurrentMaxFields  	= CalculateMaxPlanetFields($PLANET);

		$config	= Config::get();
		$premium_build_queu = 0;
		if($USER['prem_o_build'] > 0 && $USER['prem_o_build_days'] > TIMESTAMP){
			$premium_build_queu = $USER['prem_o_build'];
		}
			
		if (($config->max_elements_build + $premium_build_queu != 0 && $ActualCount == $config->max_elements_build + $premium_build_queu)
			|| ($AddMode && $PLANET["field_current"] >= ($CurrentMaxFields - $ActualCount)))
		{
			return;
		}
	
		$BuildMode 			= $AddMode ? 'build' : 'destroy';
		$BuildLevel			= $PLANET[$resource[$Element]] + (int) $AddMode;
		
		if($ActualCount == 0)
		{
			if($pricelist[$Element]['max'] < $BuildLevel)
				return;
			
			
			if($PLANET['isAlliancePlanet'] != 0){
				$costResources		= BuildFunctions::getElementPriceAlliance($USER, $PLANET, $Element, !$AddMode);
			}else{
				$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element, !$AddMode);
			}
			
			if(!BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources))
				return;
			
			$account_before = array(
				'darkmatter'			=> $USER['darkmatter'],
				'antimatter'			=> $USER['antimatter'],
				'metal'					=> $PLANET['metal'],
				'crystal'				=> $PLANET['crystal'],
				'deuterium'				=> $PLANET['deuterium'],
				'building'				=> $LNG['tech'][$Element],
			);
			
			if(isset($costResources[901])) { $PLANET[$resource[901]]	-= $costResources[901]; }
			if(isset($costResources[902])) { $PLANET[$resource[902]]	-= $costResources[902]; }
			if(isset($costResources[903])) { $PLANET[$resource[903]]	-= $costResources[903]; }
			if(isset($costResources[921])) { $USER[$resource[921]]		-= $costResources[921]; }
			if(isset($costResources[922])) { $USER[$resource[922]]		-= $costResources[922]; }
			
			$elementTime    			= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costResources);
			if($USER['tutorial'] == 18 && $Element == 31 && $BuildLevel <= 3 || $USER['tutorial'] == 33 && $Element == 21 && $BuildLevel <= 4 || $USER['tutorial'] == 34 && $Element == 31 && $BuildLevel <= 6)
				$elementTime = 0;
			$BuildEndTime				= TIMESTAMP + $elementTime;
			
			$PLANET['b_building_id']	= serialize(array(array($Element, $BuildLevel, $elementTime, $BuildEndTime, $BuildMode)));
			$PLANET['b_building']		= $BuildEndTime;
			
			$account_after = array(
				'darkmatter'			=> isset($costResources[921]) ? $costResources[921] : 0,
				'antimatter'			=> isset($costResources[922]) ? $costResources[922] : 0,
				'metal'					=> isset($costResources[901]) ? $costResources[901] : 0,
				'crystal'				=> isset($costResources[902]) ? $costResources[902] : 0,
				'deuterium'				=> isset($costResources[903]) ? $costResources[903] : 0,
				'building'				=> $LNG['tech'][$Element],
			);
			
			$LOG = new Logcheck(25);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=buildings [".$PLANET['galaxy'].":".$PLANET['system'].":".$PLANET['planet']."]";
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
				
			$elementTime    			= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, NULL, !$AddMode, $BuildLevel);
			
			if($USER['tutorial'] == 18 && $Element == 31 && $BuildLevel <= 3 || $USER['tutorial'] == 33 && $Element == 21 && $BuildLevel <= 4 || $USER['tutorial'] == 34 && $Element == 31 && $BuildLevel <= 6)
				$elementTime = 0;
			
			$BuildEndTime				= $CurrentQueue[$ActualCount - 1][3] + $elementTime;
			$CurrentQueue[]				= array($Element, $BuildLevel, $elementTime, $BuildEndTime, $BuildMode);
			$PLANET['b_building_id']	= serialize($CurrentQueue);		
			
		}
		$db = Database::get();
		if($USER['tutorial'] == 4 && $Element == 4){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 5
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 6 && $Element == 1 && $BuildLevel >= 3){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 7
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 7 && $Element == 2 && $BuildLevel >= 2){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 8
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 8 && $Element == 3 && $BuildLevel >= 1){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 9
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 10 && $Element == 4 && $BuildLevel >= 5){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 11,
			peacefull_exp_current	= peacefull_exp_current + :peacefull_exp_current
			WHERE id = :userID;";
			$db->update($sql, array(
			':peacefull_exp_current'			=> 650,
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 18 && $Element == 31 && $BuildLevel >= 3){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 19,
			peacefull_exp_current	= peacefull_exp_current + :peacefull_exp_current
			WHERE id = :userID;";
			$db->update($sql, array(
			':peacefull_exp_current'			=> 650,
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 23 && $Element == 14 && $BuildLevel >= 2){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 24
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 24 && $Element == 21 && $BuildLevel >= 2){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 25
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 33 && $Element == 21 && $BuildLevel >= 4){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 34
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 34 && $Element == 31 && $BuildLevel >= 6){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 35
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
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
		$buyId      	= HTTP::_GP('buyId', 0);
		// wellformed buildURLs
		if(!empty($TheCommand) && $_SERVER['REQUEST_METHOD'] === 'POST' && $USER['urlaubs_modus'] == 0)
		{
			$Element     			= HTTP::_GP('building', 0);
			$ListID      			= HTTP::_GP('listid', 0);
			$lvlup      			= HTTP::_GP('lvlup', 0);
			$lvlup1      			= HTTP::_GP('lvlup1', 0);
			$levelToBuildInFo      	= HTTP::_GP('levelToBuildInFo', 0);
			$methodPurchase      	= HTTP::_GP('methodPurchase', "buy_resource");
			switch($TheCommand)
			{
				case 'cancel':
					$this->CancelBuildingFromQueue();
				break;
				case 'remove':
					$this->RemoveBuildingFromQueue($ListID);
				break;
				case 'insert':
					if($methodPurchase == "buy_darkmatter")
						$this->DoAddBuildingToQueueDM($Element, 'build');
					else
						$this->AddBuildingToQueue($Element, $lvlup, $lvlup1, $levelToBuildInFo, true);
				break;
				case 'destroy':
					$this->DoAddBuildingToQueue($Element, false);
				break;
			}
			
			if($methodPurchase == "buy_darkmatter")
				$this->redirectTo('game.php?page=buildings&buyId='.$Element);
			else
				$this->redirectTo('game.php?page=buildings');
		}

		$config				= Config::get();
		$premium_build_queu = 0;
		if($USER['prem_o_build'] > 0 && $USER['prem_o_build_days'] > TIMESTAMP){
			$premium_build_queu = $USER['prem_o_build'];
		}
		
		$queueData	 		= $this->getQueueData();
		$Queue	 			= $queueData['queue'];
		$QueueCount			= count($Queue);
		$CanBuildElement 	= isVacationMode($USER) || $config->max_elements_build == 0 || $QueueCount < $config->max_elements_build + $premium_build_queu;
		$CurrentMaxFields   = CalculateMaxPlanetFields($PLANET);
		
		$RoomIsOk 			= $PLANET['field_current'] < ($CurrentMaxFields - $QueueCount);
				
		$BuildEnergy		= $USER[$resource[113]];
		$BuildLevelFactor   = 10;
		$BuildTemp          = $PLANET['temp_max'];

        $BuildInfoList      = array();
		
		
		if($PLANET['isAlliancePlanet'] != 0){
			$Elements			= array(14,15,21,22,23,24,33,34,44,71,72,73, 50, 51, 52);
		}elseif($PLANET['planet_type'] == 1){
			$Elements			= array(1,2,3,4,6,12,14,15,21,22,23,24,31,33,34,44,71,72,73,7);
		}else{
			$Elements 			= array(14,15,21,34,41,42,43,71,72,73);
		}
		foreach($Elements as $Element)
		{
			$techTreeList		= array();
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
		
				$getGalaxySevenAccount = getGalaxySevenAccount($USER);
				$getGalaxySevenProduct = $getGalaxySevenAccount['resourceProd'];
				$getGalaxySevenCollide = $getGalaxySevenAccount['colliderProd'];

				$premium_collider =  0;
				if($USER['prem_prod_from_colly'] > 0 && $USER['prem_prod_from_colly_days'] > TIMESTAMP){
				$premium_collider = $USER['prem_prod_from_colly'];
				}
		
				$academy_p_b_2_1201 = 0;
				if($USER['academy_p_b_2_1201'] > 0){
				$academy_p_b_2_1201 = $USER['academy_p_b_2_1201'] * 5;
				}
		
				$academy_p_b_2_1202 = 0;
				if($USER['academy_p_b_2_1202'] > 0){
				$academy_p_b_2_1202 = $USER['academy_p_b_2_1202'] * 2;
				}
				
				$gouvernor_resource = 0;
				if($USER['dm_resource'] > TIMESTAMP){
				$gouvernor_resource = GubPriceAPSTRACT(704, $USER['dm_resource_level'], 'dm_resource');
				}
			
				$gouvernor_energy = 0;
				if($USER['dm_energie'] > TIMESTAMP){
				$gouvernor_energy = GubPriceAPSTRACT(705, $USER['dm_energie_level'], 'dm_energie');
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
			
			if($PLANET['isAlliancePlanet'] != 0){
				$costResources		= BuildFunctions::getElementPriceAlliance($USER, $PLANET, $Element, false, $levelToBuild);
				$costResourcesDM	= BuildFunctions::getElementPriceDMAlliance($USER, $PLANET, $Element, false, $levelToBuild);
				$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
				$costOverflowdDM	= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $costResourcesDM);
				$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costResources);
				$destroyResources	= BuildFunctions::getElementPrice($USER, $PLANET, $Element, true);
				$destroyTime		= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $destroyResources);
				$destroyOverflow	= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $destroyResources);
				$buyable			= $QueueCount != 0 || BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
				$buyableDM			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $costResourcesDM);
			}else{
				$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element, false, $levelToBuild);
				$costResourcesDM	= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element, false, $levelToBuild);
				$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
				$costOverflowdDM	= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $costResourcesDM);
				$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costResources);
				$destroyResources	= BuildFunctions::getElementPrice($USER, $PLANET, $Element, true);
				$destroyTime		= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $destroyResources);
				$destroyOverflow	= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $destroyResources);
				$buyable			= $QueueCount != 0 || BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
				$buyableDM			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $costResourcesDM);
			}
			
			
			if($USER['tutorial'] == 18 && $Element == 31 && $levelToBuild <= 3 || $USER['tutorial'] == 33 && $Element == 21 && $levelToBuild <= 4 || $USER['tutorial'] == 34 && $Element == 31 && $levelToBuild <= 6)
				$elementTime = 0;

			$BuildInfoList[$Element]	= array(
				'level'				=> $PLANET[$resource[$Element]],
				'maxLevel'			=> $pricelist[$Element]['max'],
				'factor'			=> $pricelist[$Element]['factor'],
				'infoEnergy'		=> $infoEnergy,
				'costResources'		=> $costResources,
				'costResourcesDM'	=> $costResourcesDM[921],
				'costOverflow'		=> $costOverflow,
				'costOverflowdDM'	=> $costOverflowdDM[921],
				'elementTime'    	=> $elementTime,
				'destroyResources'	=> $destroyResources,
				'destroyTime'		=> $destroyTime,
				'destroyOverflow'	=> $destroyOverflow,
				'buyable'			=> $buyable,
				'buyableDM'			=> $buyableDM,
				'levelToBuild'		=> $levelToBuild,
				'AllTech'			=> $techTreeList,
				'techacc'			 => BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element),
			);
		}

		
		
		$this->tplObj->loadscript('buildlist.js'); 
		
		$this->assign(array(
			'buyId'				=> $buyId,
			'notAllowedDm'		=> $PLANET['isAlliancePlanet'] == 0 ? 1 : 0,
			'BuildInfoList'		=> $BuildInfoList,
			'field_current'		=> $PLANET['field_current'],
			'field_max'			=> CalculateMaxPlanetFields($PLANET),
			'field_free'		=> CalculateMaxPlanetFields($PLANET) - $PLANET['field_current'],
			'field_pircent'		=> 100 / CalculateMaxPlanetFields($PLANET) * $PLANET['field_current'],
			'CanBuildElement'	=> $CanBuildElement,
			'RoomIsOk'			=> $RoomIsOk,
			'Queue'				=> $Queue,
			'isBusy'			=> array('shipyard' => !empty($PLANET['b_hangar_id']), 'research' => $USER['b_tech_planet'] != 0, 'defense' => !empty($PLANET['b_defense_id'])),
			'HaveMissiles'		=> (bool) $PLANET[$resource[503]] + $PLANET[$resource[502]],
		));
			
		$this->display('page.buildings.default.tpl');
	}
}