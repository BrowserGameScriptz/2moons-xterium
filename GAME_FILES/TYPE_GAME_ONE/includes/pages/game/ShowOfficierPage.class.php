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


class ShowOfficierPage extends AbstractGamePage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
	}
	
	public function UpdateExtra($Element)
	{
		global $PLANET, $USER, $resource, $pricelist;
		
		$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
			
		if (!BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources)) {
			return;
		}
			
		$USER[$resource[$Element]]	= max($USER[$resource[$Element]], TIMESTAMP) + $pricelist[$Element]['time'];
			
		if(isset($costResources[901])) { $PLANET[$resource[901]]	-= $costResources[901]; }
		if(isset($costResources[902])) { $PLANET[$resource[902]]	-= $costResources[902]; }
		if(isset($costResources[903])) { $PLANET[$resource[903]]	-= $costResources[903]; }
		if(isset($costResources[921])) { $USER[$resource[921]]		-= $costResources[921]; }

		$sql	= 'UPDATE %%USERS%% SET
				'.$resource[$Element].' = :newTime
				WHERE
				id = :userId;';

		Database::get()->update($sql, array(
			':newTime'	=> $USER[$resource[$Element]],
			':userId'	=> $USER['id']
		));
		
		if(TIMESTAMP < config::get()->dmRefundEvent){
			$sql	= 'INSERT INTO %%DMREFUND%% SET userId = :userId, darkAmount = :darkAmount, timestamp = :timestamp;';
			database::get()->insert($sql, array(
				':userId'		=> $USER['id'],
				':darkAmount'	=> $costResources[921],
				':timestamp'	=> TIMESTAMP
			));
		}
	}

	public function UpdateOfficier($Element)
	{
		global $USER, $PLANET, $resource, $pricelist;
		
		$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
			
		if (!BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element) 
			|| !BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources) 
			|| $pricelist[$Element]['max'] <= $USER[$resource[$Element]]) {
			return;
		}
		
		$USER[$resource[$Element]]	+= 1;
		
			if($USER['tutorial'] == 42 && $Element == 601){
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 43
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			}
			if($USER['tutorial'] == 43 && $Element == 602){
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 44
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			}
		if(isset($costResources[901])) { $PLANET[$resource[901]]	-= $costResources[901]; }
		if(isset($costResources[902])) { $PLANET[$resource[902]]	-= $costResources[902]; }
		if(isset($costResources[903])) { $PLANET[$resource[903]]	-= $costResources[903]; }
		if(isset($costResources[921])) { $USER[$resource[921]]		-= $costResources[921]; }

		$sql	= 'UPDATE %%USERS%% SET
		'.$resource[$Element].' = :newTime
		WHERE
		id = :userId;';

		Database::get()->update($sql, array(
			':newTime'	=> $USER[$resource[$Element]],
			':userId'	=> $USER['id']
		));
		
		if(TIMESTAMP < config::get()->dmRefundEvent){
			$sql	= 'INSERT INTO %%DMREFUND%% SET userId = :userId, darkAmount = :darkAmount, timestamp = :timestamp;';
			database::get()->insert($sql, array(
				':userId'		=> $USER['id'],
				':darkAmount'	=> $costResources[921],
				':timestamp'	=> TIMESTAMP
			));
		}
	}
	
	public function show()
	{
		global $USER, $PLANET, $resource, $reslist, $LNG, $pricelist, $requeriments;
		
		$updateID	  = HTTP::_GP('id', 0);
				
		if (!empty($updateID) && $_SERVER['REQUEST_METHOD'] === 'POST' && $USER['urlaubs_modus'] == 0)
		{
			if(isModuleAvailable(MODULE_OFFICIER) && in_array($updateID, $reslist['officier'])) {
				$this->UpdateOfficier($updateID);
			} elseif(isModuleAvailable(MODULE_DMEXTRAS) && in_array($updateID, $reslist['dmfunc'])) {
				$this->UpdateExtra($updateID);
			}
		}
		
		$darkmatterList	= array();
		$officierList	= array();
		
		if(isModuleAvailable(MODULE_DMEXTRAS)) 
		{
			foreach($reslist['dmfunc'] as $Element)
			{
				if($USER[$resource[$Element]] > TIMESTAMP) {
					$this->tplObj->execscript("GetOfficerTime(".$Element.", ".($USER[$resource[$Element]] - TIMESTAMP).");");
				}
			
				$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
				$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
				$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
				$elementBonus		= BuildFunctions::getAvalibleBonus($Element);

				$darkmatterList[$Element]	= array(
					'timeLeft'			=> max($USER[$resource[$Element]] - TIMESTAMP, 0),
					'costResources'		=> $costResources,
					'buyable'			=> $buyable,
					'time'				=> $pricelist[$Element]['time'],
					'costOverflow'		=> $costOverflow,
					'elementBonus'		=> $elementBonus,
				);
			}
		}
		
		if(isModuleAvailable(MODULE_OFFICIER))
		{
			foreach($reslist['officier'] as $Element)
			{
				
			if($USER['tutorial'] == 42 && $USER[$resource[601]] >= 1){
				$db = Database::get();
				$sql =  "UPDATE %%USERS%% SET
				tutorial				= 43
				WHERE id = :userID;";
				$db->update($sql, array(
				':userID'			=> $USER['id']
				));
			}
			if($USER['tutorial'] == 43 && $USER[$resource[602]] >= 1){
				$db = Database::get();
				$sql =  "UPDATE %%USERS%% SET
				tutorial				= 44
				WHERE id = :userID;";
				$db->update($sql, array(
				':userID'			=> $USER['id']
				));
			}
				
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
				
				$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
				$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
				$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
				$elementBonus		= BuildFunctions::getAvalibleBonus($Element);
				
				$officierList[$Element]	= array(
					'level'				=> $USER[$resource[$Element]],
					'maxLevel'			=> $pricelist[$Element]['max'],
					'costResources'		=> $costResources,
					'buyable'			=> $buyable,
					'costOverflow'		=> $costOverflow,
					'elementBonus'		=> $elementBonus,
					'AllTech'			=> $techTreeList,
					'techacc'			 => BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element),
				);
				
			if($USER['tutorial'] == 40 && $USER[$resource[601]] > 0){
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 41
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			}
			if($USER['tutorial'] == 41 && $USER[$resource[602]] > 0){
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 42
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			}
			}
		}
		
		$this->assign(array(
			'officierList'		=> $officierList,
			'darkmatterList'	=> $darkmatterList,
			'of_dm_trade'		=> sprintf($LNG['of_dm_trade'], $LNG['tech'][921]),
		));
		
		$this->display('page.officier.default.tpl');
	}
}