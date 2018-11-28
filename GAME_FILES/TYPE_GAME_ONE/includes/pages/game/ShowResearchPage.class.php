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

require_once('AbstractGamePage.class.php');

class ShowResearchPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESEARCH;
	private $build_anz=0;
	private $bOnInsert=FALSE;

	function __construct() 
	{
		parent::__construct();
	}
	
	private function CheckLabSettingsInQueue()
	{
		global $PLANET, $USER;
		
		$sql	= "SELECT * FROM %%PLANETS%% WHERE id_owner = :idOwner AND destruyed = 0 AND gal6mod = 0 AND planet_type = 1";
		$getPlayerPlanetsMold = database::get()->select($sql, array(
			':idOwner'	=> $USER['id'] 
		));
		foreach($getPlayerPlanetsMold as $Data){
			if($Data['id'] != $PLANET['id']){
				if ($Data['b_building'] == 0)
					return true;
					
				$CurrentQueue		= unserialize($Data['b_building_id']);
				foreach($CurrentQueue as $ListIDArray) {
					if($ListIDArray[0] == 6 || $ListIDArray[0] == 31)
						return false;
				}

				return true;
			}else{
				if ($PLANET['b_building'] == 0)
					return true;
					
				$CurrentQueue		= unserialize($PLANET['b_building_id']);
				foreach($CurrentQueue as $ListIDArray) {
					if($ListIDArray[0] == 6 || $ListIDArray[0] == 31)
						return false;
				}

				return true;
			}
		}
	}
	
	private function CancelBuildingFromQueue()
	{
		global $PLANET, $USER, $resource;
		$CurrentQueue  = unserialize($USER['b_tech_queue']);
		if (empty($CurrentQueue) || empty($USER['b_tech']))
		{
			$USER['b_tech_queue']	= '';
			$USER['b_tech_planet']	= 0;
			$USER['b_tech_id']		= 0;
			$USER['b_tech']			= 0;

			return false;
		}

		$db = Database::get();

		$elementId		= $USER['b_tech_id'];
		$costResources	= BuildFunctions::getElementPrice($USER, $PLANET, $elementId);
		
		if($PLANET['id'] == $USER['b_tech_planet'])
		{
			if(isset($costResources[901])) { $PLANET[$resource[901]]	+= $costResources[901]; }
			if(isset($costResources[902])) { $PLANET[$resource[902]]	+= $costResources[902]; }
			if(isset($costResources[903])) { $PLANET[$resource[903]]	+= $costResources[903]; }
		}
		else
		{
			$params = array('techPlanet' => $USER['b_tech_planet']);
			$sql = "UPDATE %%PLANETS%% SET ";
			if(isset($costResources[901])) {
				$sql	.= $resource[901]." = ".$resource[901]." + :".$resource[901].", ";
				$params[':'.$resource[901]] = $costResources[901];
			}
			if(isset($costResources[902])) {
				$sql	.= $resource[902]." = ".$resource[902]." + :".$resource[902].", ";
				$params[':'.$resource[902]] = $costResources[902];
			}
			if(isset($costResources[903])) {
				$sql	.= $resource[903]." = ".$resource[903]." + :".$resource[903].", ";
				$params[':'.$resource[903]] = $costResources[903];
			}

			$sql = substr($sql, 0, -2);
			$sql .= " WHERE id = :techPlanet;";

			$db->update($sql, $params);
		}
		
		if(isset($costResources[921])) { $USER[$resource[921]]		+= $costResources[921]; }
		if(isset($costResources[922])) { $USER[$resource[922]]		+= $costResources[922]; }
		
		$USER['b_tech_id']			= 0;
		$USER['b_tech']      		= 0;
		$USER['b_tech_planet']		= 0;

		array_shift($CurrentQueue);

		if (count($CurrentQueue) == 0) {
			$USER['b_tech_queue']	= '';
			$USER['b_tech_planet']	= 0;
			$USER['b_tech_id']		= 0;
			$USER['b_tech']			= 0;
		} else {
			$BuildEndTime		= TIMESTAMP;
			$NewCurrentQueue	= array();
			foreach($CurrentQueue as $ListIDArray)
			{
				if($elementId == $ListIDArray[0] || empty($ListIDArray[0]))
					continue;
					
				if($ListIDArray[4] != $PLANET['id']) {
					$sql = "SELECT :resource6, :resource31, id FROM %%PLANETS%% WHERE id = :id;";
					$CPLANET = $db->selectSingle($sql, array(
						':resource6'	=> $resource[6],
						':resource31'	=> $resource[31],
						':id'			=> $ListIDArray[4]
					));
				} else 
					$CPLANET		= $PLANET;
				
				$CPLANET[$resource[31].'_inter']	= $this->ecoObj->getNetworkLevel($USER, $CPLANET);
				$BuildEndTime       				+= BuildFunctions::getBuildingTime($USER, $CPLANET, NULL, $ListIDArray[0]);
				$ListIDArray[3]						= $BuildEndTime;
				$NewCurrentQueue[]					= $ListIDArray;				
			}
			
			if(!empty($NewCurrentQueue)) {
				$USER['b_tech']    			= TIMESTAMP;
				$USER['b_tech_queue'] 		= serialize($NewCurrentQueue);
				$this->ecoObj->setData($USER, $PLANET);
				$this->ecoObj->SetNextQueueTechOnTop();
				list($USER, $PLANET)		= $this->ecoObj->getData();
			} else {
				$USER['b_tech']    			= 0;
				$USER['b_tech_queue'] 		= '';
			}
		}

		return true;
	}

	private function RemoveBuildingFromQueue($QueueID)
	{
		global $USER, $PLANET, $resource;
		
		$CurrentQueue  = unserialize($USER['b_tech_queue']);
		if ($QueueID <= 1 || empty($CurrentQueue))
		{
			return false;
		}

		$ActualCount   = count($CurrentQueue);
		if ($ActualCount <= 1)
		{
			return $this->CancelBuildingFromQueue();
		}

		if(!isset($CurrentQueue[$QueueID - 2]))
		{
			return false;
		}
			
		$elementId 		= $CurrentQueue[$QueueID - 2][0];
		$BuildEndTime	= $CurrentQueue[$QueueID - 2][3];
		unset($CurrentQueue[$QueueID - 1]);
		$NewCurrentQueue	= array();
		foreach($CurrentQueue as $ID => $ListIDArray)
		{				
			if ($ID < $QueueID - 1) {
				$NewCurrentQueue[]	= $ListIDArray;
			} else {
				if($elementId == $ListIDArray[0])
					continue;

				if($ListIDArray[4] != $PLANET['id']) {
					$db = Database::get();

					$sql = "SELECT :resource6, :resource31, id FROM %%PLANETS%% WHERE id = :id;";
					$CPLANET = $db->selectSingle($sql, array(
						':resource6'	=> $resource[6],
						':resource31'	=> $resource[31],
						':id'			=> $ListIDArray[4]
					));
				} else
					$CPLANET				= $PLANET;
				
				$CPLANET[$resource[31].'_inter']	= $this->ecoObj->getNetworkLevel($USER, $CPLANET);
				
				$BuildEndTime       += BuildFunctions::getBuildingTime($USER, $CPLANET, NULL, $ListIDArray[0]);
				$ListIDArray[3]		= $BuildEndTime;
				$NewCurrentQueue[]	= $ListIDArray;				
			}
		}
		
		if(!empty($NewCurrentQueue))
			$USER['b_tech_queue'] = serialize($NewCurrentQueue);
		else
			$USER['b_tech_queue'] = "";

		return true;
	}

	private function AddBuildingToQueue($elementId, $lvlup, $lvlup1, $levelToBuildInFo, $AddMode = true)
	{
		if($this->bOnInsert==FALSE)
		{
			$this->build_anz=$lvlup - $levelToBuildInFo;
			if($this->build_anz>=1 )
			{
				$this->bOnInsert=TRUE;
				while($this->build_anz>0)
				{
					$this->DoAddBuildingToQueue($elementId, $AddMode);
					$this->build_anz=$this->build_anz-1;
				}
				$this->bOnInsert=FALSE;
		   }
		}
	}
 
	private function DoAddBuildingToQueueDM($elementId, $AddMode = true)	{
		global $PLANET, $USER, $resource, $reslist, $pricelist, $LNG;

		if(!in_array($elementId, $reslist['tech'])
			|| !BuildFunctions::isTechnologieAccessible($USER, $PLANET, $elementId)
			|| !$this->CheckLabSettingsInQueue($PLANET)
		){
			return false;
		}

		$CurrentQueue  		= unserialize($USER['b_tech_queue']);
		
		if (!empty($CurrentQueue)) {
			$ActualCount   	= count($CurrentQueue);
		} else {
			$CurrentQueue  	= array();
			$ActualCount   	= 0;
		}
		
		$premium_build_queu = 0;
		if($USER['prem_o_build'] > 0 && $USER['prem_o_build_days'] > TIMESTAMP){
			$premium_build_queu = $USER['prem_o_build'];
		}
		
		if(Config::get()->max_elements_tech + $premium_build_queu != 0 && Config::get()->max_elements_tech + $premium_build_queu <= $ActualCount)
		{
			return false;
		}

		$BuildLevel					= $USER[$resource[$elementId]] + 1;
		if($ActualCount == 0)
		{
			if($pricelist[$elementId]['max'] < $BuildLevel)
			{
				return false;
			}

			$costResources		= BuildFunctions::getElementPriceDM($USER, $PLANET, $elementId, !$AddMode);
			
			if(!BuildFunctions::isElementBuyableDM($USER, $PLANET, $elementId, $costResources))
			{
				return false;
			}
			
			if(isset($costResources[901])) { $PLANET[$resource[901]]	-= $costResources[901]; }
			if(isset($costResources[902])) { $PLANET[$resource[902]]	-= $costResources[902]; }
			if(isset($costResources[903])) { $PLANET[$resource[903]]	-= $costResources[903]; }
			if(isset($costResources[921])) { $USER[$resource[921]]		-= $costResources[921]; }
			if(isset($costResources[922])) { $USER[$resource[922]]		-= $costResources[922]; }
			
			$elementTime    			= 0;
			$BuildEndTime				= TIMESTAMP + $elementTime;
			
			$sql	= "UPDATE %%USERS%% SET ".$resource[$elementId]." = ".$resource[$elementId]." + :userLevel WHERE id = :userId;";
			database::get()->update($sql, array(
				':userLevel'	=> 1,
				':userId'		=> $USER['id']
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
				if($QueueSubArray[0] != $elementId)
					continue;
					
				$addLevel++;
			}
				
			$BuildLevel					+= $addLevel;
				
			if($pricelist[$elementId]['max'] < $BuildLevel)
			{
				return false;
			}
				
			$elementTime    			= BuildFunctions::getBuildingTime($USER, $PLANET, $elementId, NULL, !$AddMode, $BuildLevel-1);
			if($USER['tutorial'] == 19 && $elementId == 106 && $BuildLevel <= 3 || $USER['tutorial'] == 25 && $elementId == 113 && $BuildLevel <= 2 || $USER['tutorial'] == 26 && $elementId == 120 && $BuildLevel <= 3 || $USER['tutorial'] == 35 && $elementId == 113 && $BuildLevel <= 3 || $USER['tutorial'] == 37 && $elementId == 115 && $BuildLevel <= 6)
				$elementTime = 0;
			
			$BuildEndTime				= $CurrentQueue[$ActualCount - 1][3] + $elementTime;
			$CurrentQueue[]				= array($elementId, $BuildLevel, $elementTime, $BuildEndTime, $PLANET['id']);
			$USER['b_tech_queue']		= serialize($CurrentQueue);
		}
		$db = Database::get();
		if($USER['tutorial'] == 19 && $elementId == 106 && $BuildLevel >= 3){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 20
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 25 && $elementId == 113 && $BuildLevel >= 2){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 26
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 26 && $elementId == 120 && $BuildLevel >= 3){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 27
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 35 && $elementId == 113 && $BuildLevel >= 3){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 36
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 36 && $elementId == 110 && $BuildLevel >= 2){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 37
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 37 && $elementId == 115 && $BuildLevel >= 6){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 38
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
			
		
	}
	
	private function DoAddBuildingToQueue($elementId, $AddMode = true)	{
		global $PLANET, $USER, $resource, $reslist, $pricelist, $LNG;

		if(!in_array($elementId, $reslist['tech'])
			|| !BuildFunctions::isTechnologieAccessible($USER, $PLANET, $elementId)
			|| !$this->CheckLabSettingsInQueue($PLANET)
		)
		{
			return false;
		}

		$CurrentQueue  		= unserialize($USER['b_tech_queue']);
		
		if (!empty($CurrentQueue)) {
			$ActualCount   	= count($CurrentQueue);
		} else {
			$CurrentQueue  	= array();
			$ActualCount   	= 0;
		}
		
		$premium_build_queu = 0;
		if($USER['prem_o_build'] > 0 && $USER['prem_o_build_days'] > TIMESTAMP){
		$premium_build_queu = $USER['prem_o_build'];
		}
		
		if(Config::get()->max_elements_tech + $premium_build_queu != 0 && Config::get()->max_elements_tech + $premium_build_queu <= $ActualCount)
		{
			return false;
		}

		$BuildLevel					= $USER[$resource[$elementId]] + 1;
		if($ActualCount == 0)
		{
			if($pricelist[$elementId]['max'] < $BuildLevel)
			{
				return false;
			}

			$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $elementId, !$AddMode);
			
			if(!BuildFunctions::isElementBuyable($USER, $PLANET, $elementId, $costResources))
			{
				return false;
			}
			
			$account_before = array(
				'darkmatter'			=> $USER['darkmatter'],
				'antimatter'			=> $USER['antimatter'],
				'metal'					=> $PLANET['metal'],
				'crystal'				=> $PLANET['crystal'],
				'deuterium'				=> $PLANET['deuterium'],
				'research'				=> $LNG['tech'][$elementId],
			);
			
			if(isset($costResources[901])) { $PLANET[$resource[901]]	-= $costResources[901]; }
			if(isset($costResources[902])) { $PLANET[$resource[902]]	-= $costResources[902]; }
			if(isset($costResources[903])) { $PLANET[$resource[903]]	-= $costResources[903]; }
			if(isset($costResources[921])) { $USER[$resource[921]]		-= $costResources[921]; }
			if(isset($costResources[922])) { $USER[$resource[922]]		-= $costResources[922]; }
			
			$elementTime    			= BuildFunctions::getBuildingTime($USER, $PLANET, $elementId, $costResources);
			if($USER['tutorial'] == 19 && $elementId == 106 && $BuildLevel <= 3 || $USER['tutorial'] == 25 && $elementId == 113 && $BuildLevel <= 2 || $USER['tutorial'] == 26 && $elementId == 120 && $BuildLevel <= 3 || $USER['tutorial'] == 35 && $elementId == 113 && $BuildLevel <= 3 || $USER['tutorial'] == 37 && $elementId == 115 && $BuildLevel <= 6)
				$elementTime = 0;
			$BuildEndTime				= TIMESTAMP + $elementTime;
			
			//$this->printMessage($elementTime, true, array('game.php?page=research', 2));
			
			$USER['b_tech_queue']		= serialize(array(array($elementId, $BuildLevel, $elementTime, $BuildEndTime, $PLANET['id'])));
			$USER['b_tech']				= $BuildEndTime;
			$USER['b_tech_id']			= $elementId;
			$USER['b_tech_planet']		= $PLANET['id'];
			
			$account_after = array(
				'darkmatter'			=> isset($costResources[921]) ? $costResources[921] : 0,
				'antimatter'			=> isset($costResources[922]) ? $costResources[922] : 0,
				'metal'					=> isset($costResources[901]) ? $costResources[901] : 0,
				'crystal'				=> isset($costResources[902]) ? $costResources[902] : 0,
				'deuterium'				=> isset($costResources[903]) ? $costResources[903] : 0,
				'research'				=> $LNG['tech'][$elementId],
			);
			
			$LOG = new Logcheck(26);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=research [".$PLANET['galaxy'].":".$PLANET['system'].":".$PLANET['planet']."]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
			
		} else {
			$addLevel = 0;
			foreach($CurrentQueue as $QueueSubArray)
			{
				if($QueueSubArray[0] != $elementId)
					continue;
					
				$addLevel++;
			}
				
			$BuildLevel					+= $addLevel;
				
			if($pricelist[$elementId]['max'] < $BuildLevel)
			{
				return false;
			}
				
			$elementTime    			= BuildFunctions::getBuildingTime($USER, $PLANET, $elementId, NULL, !$AddMode, $BuildLevel-1);
			if($USER['tutorial'] == 19 && $elementId == 106 && $BuildLevel <= 3 || $USER['tutorial'] == 25 && $elementId == 113 && $BuildLevel <= 2 || $USER['tutorial'] == 26 && $elementId == 120 && $BuildLevel <= 3 || $USER['tutorial'] == 35 && $elementId == 113 && $BuildLevel <= 3 || $USER['tutorial'] == 37 && $elementId == 115 && $BuildLevel <= 6)
				$elementTime = 0;
			
			$BuildEndTime				= $CurrentQueue[$ActualCount - 1][3] + $elementTime;
			$CurrentQueue[]				= array($elementId, $BuildLevel, $elementTime, $BuildEndTime, $PLANET['id']);
			$USER['b_tech_queue']		= serialize($CurrentQueue);
			
		}
		$db = Database::get();
		if($USER['tutorial'] == 19 && $elementId == 106 && $BuildLevel >= 3){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 20
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 25 && $elementId == 113 && $BuildLevel >= 2){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 26
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 26 && $elementId == 120 && $BuildLevel >= 3){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 27
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 35 && $elementId == 113 && $BuildLevel >= 3){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 36
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 36 && $elementId == 110 && $BuildLevel >= 2){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 37
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 37 && $elementId == 115 && $BuildLevel >= 6){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 38
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
		
		if ($USER['b_tech'] == 0 || $USER['b_tech_queue'] == "")
		return array('queue' => $scriptData, 'quickinfo' => $quickinfo);
		
		$CurrentQueue   = unserialize($USER['b_tech_queue']);
		
		foreach($CurrentQueue as $BuildArray) {
			if ($BuildArray[3] < TIMESTAMP)
				continue;
			
			$PlanetName	= '';
		
			$quickinfo[$BuildArray[0]]	= $BuildArray[1];
			
			if($BuildArray[4] != $PLANET['id'])
				$PlanetName		= $USER['PLANETS'][$BuildArray[4]]['name'];
				
			$scriptData[] = array(
				'element'	=> $BuildArray[0], 
				'level' 	=> $BuildArray[1], 
				'time' 		=> $BuildArray[2], 
				'resttime' 	=> ($BuildArray[3] - TIMESTAMP), 
				'destroy' 	=> ($BuildArray[4] == 'destroy'), 
				'endtime' 	=> _date('U', $BuildArray[3], $USER['timezone']),
				'display' 	=> _date($LNG['php_tdformat'], $BuildArray[3], $USER['timezone']),
				'planet'	=> $PlanetName,
			);
		}
		
		return array('queue' => $scriptData, 'quickinfo' => $quickinfo);
	}

	public function show()
	{
		global $PLANET, $USER, $LNG, $resource, $reslist, $pricelist, $requeriments;
		
		
			
		$TheCommand		= HTTP::_GP('cmd','');
		$elementId     	= HTTP::_GP('tech', 0);
		$ListID     	= HTTP::_GP('listid', 0);
		$lvlup      	= HTTP::_GP('lvlup', 0);
		$lvlup1      	= HTTP::_GP('lvlup1', 0);
		$levelToBuildInFo      	= HTTP::_GP('levelToBuildInFo', 0);
		$buyId      	= HTTP::_GP('buyId', 0);
		$methodPurchase      	= HTTP::_GP('methodPurchase', "buy_resource");
		$PLANET[$resource[31].'_inter']	= ResourceUpdate::getNetworkLevel($USER, $PLANET);	

		if(!empty($TheCommand) && $_SERVER['REQUEST_METHOD'] === 'POST' && $USER['urlaubs_modus'] == 0)
		{
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
						$this->DoAddBuildingToQueueDM($elementId, 'build');
					else
						$this->AddBuildingToQueue($elementId, $lvlup, $lvlup1, $levelToBuildInFo, true);
				break;
				case 'destroy':
					$this->DoAddBuildingToQueue($elementId, false);
				break;
			}
			if($methodPurchase == "buy_darkmatter")
				$this->redirectTo('game.php?page=research&buyId='.$elementId);
			else
				$this->redirectTo('game.php?page=research');
		}
		
		$bContinue		= $this->CheckLabSettingsInQueue($PLANET);
		
		$queueData		= $this->getQueueData();
		$TechQueue		= $queueData['queue'];
		$QueueCount		= count($TechQueue);
		$ResearchList	= array();

		foreach($reslist['tech'] as $elementId)
		{
					
			$techTreeList		 = array();
                $requirementsList	= array();
                if(isset($requeriments[$elementId]))
                {
                    foreach($requeriments[$elementId] as $requireID => $RedCount)
                    {
                        $requirementsList[$requireID]	= array(
                            'count' => $RedCount,
                            'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
                        );
                    }
                }

                $techTreeList[$elementId]	= $requirementsList;
			
			if(isset($queueData['quickinfo'][$elementId]))
			{
				$levelToBuild	= $queueData['quickinfo'][$elementId];
			}
			else
			{
				$levelToBuild	= $USER[$resource[$elementId]];
			}
			
			$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $elementId, false, $levelToBuild);
			$costResourcesDM	= BuildFunctions::getElementPriceDM($USER, $PLANET, $elementId, false, $levelToBuild);
			$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $elementId, $costResources);
			$costOverflowDM		= BuildFunctions::getRestPriceDM($USER, $PLANET, $elementId, $costResourcesDM);
			$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $elementId, $costResources);
			$buyable			= $QueueCount != 0 || BuildFunctions::isElementBuyable($USER, $PLANET, $elementId, $costResources);
			$buyableDM			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $elementId, $costResourcesDM);
			
			
			if($USER['tutorial'] == 19 && $elementId == 106 && $levelToBuild <= 3 || $USER['tutorial'] == 25 && $elementId == 113 && $levelToBuild <= 2 || $USER['tutorial'] == 26 && $elementId == 120 && $levelToBuild <= 3 || $USER['tutorial'] == 35 && $elementId == 113 && $levelToBuild <= 3 || $USER['tutorial'] == 37 && $elementId == 115 && $levelToBuild <= 6)
				$elementTime = 0;
			
			if($USER['tutorial'] == 19 && $elementId == 106 && $levelToBuild >= 3){
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 20
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			}
			if($USER['tutorial'] == 25 && $elementId == 113 && $levelToBuild >= 2){
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 26
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			}
			if($USER['tutorial'] == 26 && $elementId == 120 && $levelToBuild >= 3){
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 27
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			}
			if($USER['tutorial'] == 35 && $elementId == 113 && $levelToBuild >= 3){
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 36
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			}
			if($USER['tutorial'] == 36 && $elementId == 110 && $levelToBuild >= 2){
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 37
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			}
			if($USER['tutorial'] == 37 && $elementId == 115 && $levelToBuild >= 6){
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 38
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id'] 
			));
			}

			$ResearchList[$elementId]	= array(
				'id'				=> $elementId,
				'level'				=> $USER[$resource[$elementId]],
				'factor'			=> $pricelist[$elementId]['factor'],
				'maxLevel'			=> $pricelist[$elementId]['max'],
				'costResources'		=> $costResources,
				'costResourcesDM'	=> $costResourcesDM[921],
				'costOverflow'		=> $costOverflow,
				'costOverflowDM'	=> $costOverflowDM[921],
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'buyableDM'			=> $buyableDM,
				'levelToBuild'		=> $levelToBuild,
				'AllTech'			=> $techTreeList,
				'techacc'			 => BuildFunctions::isTechnologieAccessible($USER, $PLANET, $elementId),
			);
		}
		$premium_build_queu = 0;
		if($USER['prem_o_build'] > 0 && $USER['prem_o_build_days'] > TIMESTAMP){
		$premium_build_queu = $USER['prem_o_build'];
		}
		$this->tplObj->loadscript('research.js'); 
		$this->assign(array(
			'buyId'			=> $buyId,
			'ResearchList'	=> $ResearchList,
			'IsLabinBuild'	=> !$bContinue,
			'IsFullQueue'	=> Config::get()->max_elements_tech + $premium_build_queu == 0 || Config::get()->max_elements_tech + $premium_build_queu == count($TechQueue),
			'Queue'			=> $TechQueue,
		));
		
		$this->display('page.research.default.tpl');
	}
}