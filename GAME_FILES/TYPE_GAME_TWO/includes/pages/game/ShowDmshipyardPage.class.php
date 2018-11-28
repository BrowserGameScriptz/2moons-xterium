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
 

class ShowDmshipyardPage extends AbstractGamePage
{
	public static $requireModule = 0;
	
	public static $defaultController = 'show';

	function __construct() 
	{
		parent::__construct();
	}
	
	
	private function BuildAuftr($fmenge)
	{
		global $USER, $PLANET, $reslist, $resource, $LNG;
		
		$Missiles	= array(
			502	=> $PLANET[$resource[502]],
			503	=> $PLANET[$resource[503]],
		);

		$Message = "";
		$Counting = 0;
		$Price = 0;
		$mode = 'fleet';
		foreach($fmenge as $Element => $Count)
		{
			if(empty($Count)
				|| !in_array($Element, array_merge($reslist['fleet'], $reslist['defense'], $reslist['missile']))
				|| !BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element)
			) {
				continue;
			}
			
			$MaxElements 	= BuildFunctions::getMaxConstructibleElementsDM($USER, $PLANET, $Element);
			$Count			= is_numeric($Count) ? round($Count) : 0;
			$Count 			= abs($Count);
			$Count 			= max(min($Count, 9999999), 0);
			$Count 			= min($Count, $MaxElements);
			
		
			$BuildArray    	= !empty($PLANET['b_hangar_id']) ? unserialize($PLANET['b_hangar_id']) : array();
			if (in_array($Element, $reslist['missile']))
			{
				$MaxMissiles		= BuildFunctions::getMaxConstructibleRockets($USER, $PLANET, $Missiles);
				$Count 				= min($Count, $MaxMissiles[$Element]);

				$Missiles[$Element] += $Count;
			} elseif(in_array($Element, $reslist['one'])) {
				$InBuild	= false;
				foreach($BuildArray as $ElementArray) {
					if($ElementArray[0] == $Element) {
						$InBuild	= true;
						break;
					}
				}
				
				if ($InBuild)
					continue;

				if($Count != 0 && $PLANET[$resource[$Element]] == 0 && $InBuild === false)
					$Count =  1;
			}

			if(empty($Count))
				continue;
				
			$costResources	= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element, false, $Count);
			
			$sql	= 'SELECT insta_dm_navy, insta_dm_defense, darkmatter FROM %%USERS%% WHERE id = :id_owner';
			$userNewData	= Database::get()->selectSingle($sql, array(
				':id_owner'	=> $USER['id']
			));
			
			$account_before = array(
				$resource[$Element]		=> $PLANET[$resource[$Element]],
				'darkmatter'			=> $userNewData['darkmatter'],
				'insta_dm_navy'			=> $userNewData['insta_dm_navy'],
				'insta_dm_defense'		=> $userNewData['insta_dm_defense'],
				'price'					=> $costResources[921],
			);
		
			if($userNewData['insta_dm_navy'] + $costResources[921] > 100000000 && $Element < 400)
				continue;
			
			if($userNewData['insta_dm_defense'] + $costResources[921] > 100000000 && $Element > 400)
				continue;
		
			if(isset($costResources[921])) { $USER[$resource[921]]		-= $costResources[921]; }
			$db	= Database::get();
			if($Element < 400){
			$sql	= "UPDATE %%USERS%% SET insta_dm_navy = insta_dm_navy + :insta_dm_navy, darkmatter = darkmatter - :insta_dm_navy WHERE id = :userId;";
			$db->update($sql, array(
			':insta_dm_navy'	=> $costResources[921],
			':userId'	=> $USER['id']
			));
			}else{
			$sql	= "UPDATE %%USERS%% SET insta_dm_defense = insta_dm_defense + :insta_dm_defense, darkmatter = darkmatter - :darkmatter WHERE id = :userId;";
			$db->update($sql, array(
			':darkmatter'	=> $costResources[921],
			':insta_dm_defense'	=> $costResources[921],
			':userId'	=> $USER['id']
			));	
			}
			
			
			$PLANET[$resource[$Element]]		+= $Count;
			$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]."  = ".$resource[$Element]." + :count WHERE id = :planetId;";
			$db->update($sql, array(
			':count'	=> $Count,
			':planetId'	=> $PLANET['id']
			));
			
			if(TIMESTAMP < config::get()->dmRefundEvent){
				$sql	= 'INSERT INTO %%DMREFUND%% SET userId = :userId, darkAmount = :darkAmount, timestamp = :timestamp;';
				database::get()->insert($sql, array(
					':userId'		=> $USER['id'],
					':darkAmount'	=> $costResources[921],
					':timestamp'	=> TIMESTAMP
				));
			}
			
			$Message .= '<span style="color:#999;">'.$LNG['tech'][$Element].' ('.$Count.')</span><br />';
			$Counting = 0;
			$Price += $costResources[921];
			
			if($Element > 400)
				$mode = 'defense';
			
			$sql	= 'SELECT darkmatter, insta_dm_navy, insta_dm_defense FROM %%USERS%% WHERE id = :userId;';
			$getUser = database::get()->selectSingle($sql, array(
				':userId'		=> $USER['id'],
			));
			
			$sql	= 'SELECT '.$resource[$Element].' FROM %%PLANETS%% WHERE id = :userId;';
			$getPlanet = database::get()->selectSingle($sql, array(
				':userId'		=> $PLANET['id'],
			));
			
			$account_after = array(
				$resource[$Element]		=> $getPlanet[$resource[$Element]],
				'darkmatter'			=> $getUser['darkmatter'],
				'insta_dm_navy'			=> $getUser['insta_dm_navy'],
				'insta_dm_defense'		=> $getUser['insta_dm_defense'],
				'price'					=> $costResources[921],
			);
			
			$LOG = new Logcheck(9);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=dmshipyard [Buy ".$mode."]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
		}
		
		$this->printMessage($LNG['tutorial_metal_149'].':<br /><br />'.$Message.'<hr />'.$LNG['tutorial_metal_150'].' <span style="color:#ABD3F8"> '.$Price.' </span> '.$LNG['tech'][921].'', true, array('game.php?page=dmshipyard&mode='.$mode.'', 3));
	}
	
	public function show()
	{
		global $USER, $PLANET, $LNG, $resource, $reslist, $requeriments;
		
		//if($USER['id'] != 1){
		//	$this->printMessage('under maintenance', true, array('game.php?page=overview', 2));
		//}
		
		$buildTodo	= HTTP::_GP('fmenge', array());
		$action		= HTTP::_GP('action', '');
		$mode		= HTTP::_GP('mode', 'fleet');
		
		if($mode == "fleet")
			$this->redirectTo('game.php?page=shipyard');

		
		$NotBuilding = true;
		if (!empty($PLANET['b_building_id']))
		{
			$CurrentQueue 	= unserialize($PLANET['b_building_id']);
			foreach($CurrentQueue as $ElementArray)
			{
				if($ElementArray[0] == 21 || $ElementArray[0] == 15) {
					$NotBuilding = false;
					break;
				}
			}
		}
		
		$ElementQueue 	= unserialize($PLANET['b_hangar_id']);
		if(empty($ElementQueue))
			$Count	= 0;
		else
			$Count	= count($ElementQueue);
			
		if($USER['urlaubs_modus'] == 0 && $NotBuilding == true)
		{
			if (!empty($buildTodo))
			{
				$maxBuildQueue	= Config::get()->max_elements_ships;
				if ($maxBuildQueue != 0 && $Count >= $maxBuildQueue)
				{
					$this->printMessage(sprintf($LNG['bd_max_builds'], $maxBuildQueue), true, array('game.php?page=dmshipyard&mode='.$mode, 2));
				}

				$this->BuildAuftr($buildTodo);
				$ElementQueue 	= unserialize($PLANET['b_hangar_id']);
				$this->redirectTo('game.php?page=dmshipyard&mode='.$mode.'');
			}
					
			if ($action == "delete")
			{
				$this->CancelAuftr();
			}
		}
		
		$elementInQueue	= array();
		$buildList		= array();
		$elementListDefault	= array();
		$elementListLight	= array();
		$elementListMedium	= array();
		$elementListHeavy	= array();
		$elementListall	= array();
		

		if(!empty($ElementQueue))
		{
			$Shipyard		= array();
			$QueueTime		= 0;
			foreach($ElementQueue as $Element)
			{
				if (empty($Element))
					continue;
					
				$elementInQueue[$Element[0]]	= true;
				$ElementTime  	= 0;
				$QueueTime   	+= $ElementTime * $Element[1];
				$Shipyard[]		= array($LNG['tech'][$Element[0]], $Element[1], $ElementTime, $Element[0]);		
			}

			$buildList	= array(
				'Queue' 				=> $Shipyard,
				'b_hangar_id_plus' 		=> $PLANET['b_hangar'],
				'pretty_time_b_hangar' 	=> pretty_time(max($QueueTime - $PLANET['b_hangar'],0)),
			);
		}
		
		
		if($mode == 'defense') {
			$elementAll	= array(401,402,403,404,405,406,416,417,418,412,410,413,419,414,415);
			$elementDefault	= array();
			$elementLight	= array(401,402,403);
			$elementMedium	= array(405,404,406,416,417);
			$elementHeavy	= array(418,412,410,413,419,414,415);
		}else{
			$elementAll	= array(202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,221,222,223,225,226,227,228);
			$elementDefault	= array(208,210,223);
			$elementLight	= array(212,202,203,204,205);
			$elementMedium	= array(209,206,207,217,215,213,211,219);
			$elementHeavy	= array(225,226,214,216,227,228,222,218,221);
		} 
		
		
		$Missiles	= array();
		
		foreach($reslist['missile'] as $elementID)
		{
			$Missiles[$elementID]	= $PLANET[$resource[$elementID]];
		}
		
		$MaxMissiles	= BuildFunctions::getMaxConstructibleRockets($USER, $PLANET, $Missiles);
		
		foreach($elementAll as $Element)
		{
			
			$costResources		= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $costResources);
			$elementTime    	= 0;
			$buyable			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $costResources);
			$maxBuildable		= BuildFunctions::getMaxConstructibleElementsDM($USER, $PLANET, $Element, $costResources);
			
			$maxBuildable	= min($maxBuildable, 9999999);

			if(isset($MaxMissiles[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxMissiles[$Element]);
			}
			
			$AlreadyBuild		= in_array($Element, $reslist['one']) && (isset($elementInQueue[$Element]) || $PLANET[$resource[$Element]] != 0);
			
			$elementListall[$Element]	= array(
				'id'				=> $Element,
				'available'			=> $PLANET[$resource[$Element]],
				'costResources'		=> $costResources,
				'costOverflow'		=> $costOverflow,
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'maxBuildable'		=> floattostring($maxBuildable),
				'AlreadyBuild'		=> $AlreadyBuild,
			);
		}
		
		foreach($elementDefault as $Element)
		{
			$techTreeListDefault		 = array();
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

                $techTreeListDefault[$Element]	= $requirementsList;
			
			$costResources		= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $costResources);
			$elementTime    	= 0;
			$buyable			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $costResources);
			$maxBuildable		= BuildFunctions::getMaxConstructibleElementsDM($USER, $PLANET, $Element, $costResources);
			
			$maxBuildable	= min($maxBuildable, 9999999);
			if(isset($MaxMissiles[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxMissiles[$Element]);
			}
			
			$AlreadyBuild		= in_array($Element, $reslist['one']) && (isset($elementInQueue[$Element]) || $PLANET[$resource[$Element]] != 0);
			
			$elementListDefault[$Element]	= array(
				'id'				=> $Element,
				'available'			=> $PLANET[$resource[$Element]],
				'costResources'		=> $costResources,
				'costOverflow'		=> $costOverflow,
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'maxBuildable'		=> floattostring($maxBuildable),
				'AlreadyBuild'		=> $AlreadyBuild,
				'AllTech'			=> $techTreeListDefault,
				'techacc'			=> BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element),
			);
		}
		
		foreach($elementLight as $Element)
		{
		
			$techTreeListLight		 = array();
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

            $techTreeListLight[$Element]	= $requirementsList;
			
			$costResources		= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $costResources);
			$elementTime    	= 0;
			$buyable			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $costResources);
			$maxBuildable		= BuildFunctions::getMaxConstructibleElementsDM($USER, $PLANET, $Element, $costResources);
			
			$maxBuildable	= min($maxBuildable, 9999999);

			if(isset($MaxMissiles[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxMissiles[$Element]);
			}
			
			$AlreadyBuild		= in_array($Element, $reslist['one']) && (isset($elementInQueue[$Element]) || $PLANET[$resource[$Element]] != 0);
			
			$elementListLight[$Element]	= array(
				'id'				=> $Element,
				'available'			=> $PLANET[$resource[$Element]],
				'costResources'		=> $costResources,
				'costOverflow'		=> $costOverflow,
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'maxBuildable'		=> floattostring($maxBuildable),
				'AlreadyBuild'		=> $AlreadyBuild,
				'AllTech'			=> $techTreeListLight,
				'techacc'			=> BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element),
			);
		}
		
		foreach($elementMedium as $Element)
		{
			
			$techTreeListMedium		 = array();
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

                $techTreeListMedium[$Element]	= $requirementsList;
			
			$costResources		= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $costResources);
			$elementTime    	= 0;
			$buyable			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $costResources);
			$maxBuildable		= BuildFunctions::getMaxConstructibleElementsDM($USER, $PLANET, $Element, $costResources);
			$maxBuildable	= min($maxBuildable, 9999999);
			
			if(isset($MaxMissiles[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxMissiles[$Element]);
			}
			
			$AlreadyBuild		= in_array($Element, $reslist['one']) && (isset($elementInQueue[$Element]) || $PLANET[$resource[$Element]] != 0);
			
			$elementListMedium[$Element]	= array(
				'id'				=> $Element,
				'available'			=> $PLANET[$resource[$Element]],
				'costResources'		=> $costResources,
				'costOverflow'		=> $costOverflow,
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'maxBuildable'		=> floattostring($maxBuildable),
				'AlreadyBuild'		=> $AlreadyBuild,
				'AllTech'			=> $techTreeListMedium,
				'techacc'			=> BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element),
			);
		}
		
		foreach($elementHeavy as $Element)
		{
			
			$techTreeListHeavy		 = array();
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

                $techTreeListHeavy[$Element]	= $requirementsList;
			
			$costResources		= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element);
			$costOverflow		= BuildFunctions::getRestPriceDM($USER, $PLANET, $Element, $costResources);
			$elementTime    	= 0;
			$buyable			= BuildFunctions::isElementBuyableDM($USER, $PLANET, $Element, $costResources);
			$maxBuildable		= BuildFunctions::getMaxConstructibleElementsDM($USER, $PLANET, $Element, $costResources);
			$maxBuildable	= min($maxBuildable, 9999999);

			if(isset($MaxMissiles[$Element])) {
				$maxBuildable	= min($maxBuildable, $MaxMissiles[$Element]);
			}
			
			$AlreadyBuild		= in_array($Element, $reslist['one']) && (isset($elementInQueue[$Element]) || $PLANET[$resource[$Element]] != 0);
			
			$elementListHeavy[$Element]	= array(
				'id'				=> $Element,
				'available'			=> $PLANET[$resource[$Element]],
				'costResources'		=> $costResources,
				'costOverflow'		=> $costOverflow,
				'elementTime'    	=> $elementTime,
				'buyable'			=> $buyable,
				'maxBuildable'		=> floattostring($maxBuildable),
				'AlreadyBuild'		=> $AlreadyBuild,
				'AllTech'			=> $techTreeListHeavy,
				'techacc'			=> BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element),
			);
		}
		
		$this->assign(array(
			'elementListall'		=> $elementListall,
			'elementListDefault'	=> $elementListDefault,
			'elementListLight'		=> $elementListLight,
			'elementListHeavy'		=> $elementListHeavy,
			'elementListMedium'		=> $elementListMedium,
			'NotBuilding'	=> $NotBuilding,
			'convLight'	=> $PLANET[$resource[71]],
			'convMedium'	=> $PLANET[$resource[72]],
			'convHeavy'	=> $PLANET[$resource[73]],
			'Rocket'	=> $PLANET[$resource[401]],
			'LightL'	=> $PLANET[$resource[402]],
			'BuildList'		=> $buildList,
			'maxlength'		=> strlen(Config::get()->max_fleet_per_build),
			'mode'			=> $mode,
			'insta_dm_left'			=> ($mode == "fleet") ? sprintf($LNG['customm_24'],pretty_number(100000000 - $USER['insta_dm_navy'])) : sprintf($LNG['customm_24'],pretty_number(100000000 - $USER['insta_dm_defense'])),
		));

		$this->display('page.dmshipyard.default.tpl');
	}
}