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

class ShowDmtechPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESEARCH;

	function __construct() 
	{
		parent::__construct();
	}
	
	private function CheckLabSettingsInQueue()
	{
		global $PLANET;
		if ($PLANET['b_building'] == 0)
			return true;
			
		$CurrentQueue		= unserialize($PLANET['b_building_id']);
		foreach($CurrentQueue as $ListIDArray) {
			if($ListIDArray[0] == 6 || $ListIDArray[0] == 31)
				return false;
		}

		return true;
	}
	
	private function AddBuildingToQueue($elementId, $AddMode = true)	{
		global $PLANET, $USER, $resource, $reslist, $pricelist, $LNG;

		if(!in_array($elementId, $reslist['tech'])
			|| !BuildFunctions::isTechnologieAccessible($USER, $PLANET, $elementId)
			|| !$this->CheckLabSettingsInQueue($PLANET)
		)
		{
			return false;
		}

		$CurrentQueue  		= unserialize($USER['b_tech_queue']);
		
		
			$CurrentQueue  	= array();
			$ActualCount   	= 0;
		
		$BuildLevel					= $USER[$resource[$elementId]] + 1;
		if($ActualCount == 0)
		{
			
			if($pricelist[$elementId]['max'] < $BuildLevel)
			{
				return false;
			}

			$costResources		= BuildFunctions::getElementPriceDM($USER, $PLANET, $elementId, !$AddMode);
			
			$account_before = array(
				$resource[$elementId]	=> $USER[$resource[$elementId]],
				'darkmatter'			=> $USER['darkmatter'],
				'price'					=> $costResources[921],
			);
			
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
			
			$sql	= "UPDATE %%USERS%% SET ".$resource[$elementId]." = ".$resource[$elementId]." + :userLevel, darkmatter = darkmatter - :darkmatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':userLevel'	=> 1,
				':darkmatter'	=> $costResources[921],
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
			
			$sql	= 'SELECT darkmatter, '.$resource[$elementId].' FROM %%USERS%% WHERE id = :userId;';
			$getUser = database::get()->selectSingle($sql, array(
				':userId'		=> $USER['id'],
			));
			
			
			$account_after = array(
				$resource[$elementId]	=> $getUser[$resource[$elementId]],
				'darkmatter'			=> $getUser['darkmatter'],
				'price'					=> $costResources[921],
			);
			
			$LOG = new Logcheck(9);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=dmtech [Buy Research]";
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
				
			$elementTime    			= 0;
			
			$BuildEndTime				= $CurrentQueue[$ActualCount - 1][3] + $elementTime;
			$CurrentQueue[]				= array($elementId, $BuildLevel, $elementTime, $BuildEndTime, $PLANET['id']);
			$USER['b_tech_queue']		= serialize($CurrentQueue);
		}
		
			
		}

	private function getQueueData()
	{
		global $LNG, $PLANET, $USER;

		$scriptData		= array();
		$quickinfo		= array();
		
		if ($USER['b_tech'] == 0)
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
		
		
		$this->redirectTo('game.php?page=research');	
		$TheCommand		= HTTP::_GP('cmd','');
		$elementId     	= HTTP::_GP('tech', 0);
		$ListID     	= HTTP::_GP('listid', 0);
		$lvlup      	= HTTP::_GP('lvlup', 0);
		$lvlup1      	= HTTP::_GP('lvlup1', 0);
		
		$PLANET[$resource[31].'_inter']	= ResourceUpdate::getNetworkLevel($USER, $PLANET);	

		if(!empty($TheCommand) && $_SERVER['REQUEST_METHOD'] === 'POST' && $USER['urlaubs_modus'] == 0)
		{
			switch($TheCommand)
			{
				
				case 'insert':
					$this->AddBuildingToQueue($elementId, true);
				break;
				
			}
			
			$this->redirectTo('game.php?page=dmtech');
		}
		
		$bContinue		= $this->CheckLabSettingsInQueue($PLANET);
		
		$queueData		= $this->getQueueData();
		$TechQueue		= $queueData['queue'];
		$QueueCount		= count($TechQueue);
		$ResearchList	= array();
		$list = array(106,108,109,110,111,113,114,115,117,118,120,121,122,123,124,131,132,133);
		foreach($list as $elementId)
		{
			
			if (!BuildFunctions::isBusyToSearch($USER, $PLANET, $elementId))
				continue;
			
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
			
			$costResources		= BuildFunctions::getElementPriceDM($USER, $PLANET, $elementId, false, $levelToBuild);
			$costOverflow		= BuildFunctions::getRestPriceDM($USER, $PLANET, $elementId, $costResources);
			$elementTime    	= 0;
			$buyable			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $elementId, $costResources);

			$ResearchList[$elementId]	= array(
				'id'				=> $elementId,
				'level'				=> $USER[$resource[$elementId]],
				'factor'			=> $pricelist[$elementId]['factor'],
				'maxLevel'			=> $pricelist[$elementId]['max'],
				'costResources'		=> $costResources,
				'costOverflow'		=> $costOverflow,
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'levelToBuild'		=> $levelToBuild,
				'AllTech'			=> $techTreeList,
				'techacc'			 => BuildFunctions::isTechnologieAccessible($USER, $PLANET, $elementId),
			);
		}
		$this->tplObj->loadscript('research.js'); 
		$this->assign(array(
			'ResearchList'	=> $ResearchList,
			'IsLabinBuild'	=> !$bContinue,
			'IsFullQueue'	=> Config::get()->max_elements_tech == 0 || Config::get()->max_elements_tech == 100,
			'Queue'			=> $TechQueue,
		));
		
		$this->display('page.dmtech.default.tpl');
	}
}