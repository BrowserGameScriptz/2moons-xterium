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

class ShowKollaiderPage extends AbstractGamePage
{
	public static $requireModule = MODULE_BUILDING;

	function __construct() 
	{
		parent::__construct();
	}
	
	
	function send($AddMode = true)
	{
		global $ProdGrid, $LNG, $resource, $reslist, $PLANET, $USER, $pricelist;
		
		$Element = 69;
			
		if(!in_array($Element, $reslist['allow'][$PLANET['planet_type']])
			|| !BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element) 
			|| ($Element == 31 && $USER["b_tech_planet"] != 0) 
			|| (($Element == 15 || $Element == 21) && !empty($PLANET['b_hangar_id']))
			|| (isVacationMode($USER))
			|| (!$AddMode && $PLANET[$resource[$Element]] == 0)
		)
			return;
		
			$BuildMode 			= $AddMode ? 'build' : 'destroy';
			$BuildLevel			= $PLANET[$resource[$Element]] + (int) $AddMode;
		
			if($pricelist[$Element]['max'] < $BuildLevel)
				return;

			$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element, !$AddMode);
			
			$account_before = array(
				'antimatter'			=> $USER['antimatter'],
				'antimatter_bought'		=> $USER['antimatter_bought'],
				'collider'				=> $PLANET['collider'],
				'price'					=> $costResources[922],
			);
			
			if(!BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources))
				return;
			
			if(isset($costResources[901])) { $PLANET[$resource[901]]	-= $costResources[901]; }
			if(isset($costResources[902])) { $PLANET[$resource[902]]	-= $costResources[902]; }
			if(isset($costResources[903])) { $PLANET[$resource[903]]	-= $costResources[903]; }
			if(isset($costResources[921])) { $USER[$resource[921]]		-= $costResources[921]; }
			if(isset($costResources[922])) { $this->widrawAm($costResources[922], $USER['id']); }
			$db	= Database::get();			
			$sql	= "UPDATE %%PLANETS%% SET collider = collider + :collider WHERE id = :planetId;";
			$db->update($sql, array(
			':collider'	=> 1,
			':planetId'	=> $PLANET['id']
			));
			
			
			$sql	= 'SELECT antimatter, antimatter_bought FROM %%USERS%% WHERE id = :userId;';
			$getUser = $db->selectSingle($sql, array(
				':userId'		=> $USER['id'],
			));
			
			$sql	= 'SELECT collider FROM %%PLANETS%% WHERE id = :userId;';
			$getPlanet = $db->selectSingle($sql, array(
				':userId'		=> $PLANET['id'],
			));
			
			$account_after = array(
				'antimatter'			=> $getUser['antimatter'],
				'antimatter_bought'		=> $getUser['antimatter_bought'],
				'collider'				=> $getPlanet['collider'],
				'price'					=> $costResources[922],
			);
			
			$LOG = new Logcheck(10);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=kollaider [Upgrade Collider]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
			
			$Element			= 69;
			$levelToBuild	= $PLANET[$resource[$Element]]+1;
			$ProdDm			= pretty_number((2.5 * ($PLANET[$resource[$Element]]+2) * pow((1.1), ($PLANET[$resource[$Element]]+2))) * 1000);
			$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element, false, $levelToBuild);
			$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
			$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);

		
		

	}
	
	public function show(){
	global $ProdGrid, $LNG, $resource, $reslist, $PLANET, $USER, $pricelist;
	
			$TheCommand		= HTTP::_GP('cmd', '');

		// wellformed buildURLs
		if(!empty($TheCommand) && $_SERVER['REQUEST_METHOD'] === 'POST' && $USER['urlaubs_modus'] == 0)
		{
			
			switch($TheCommand)
			{
				case 'insert':
					$this->send(true);
				break;
				
			}
			
			$this->redirectTo('game.php?page=kollaider');
		}
								
			if($PLANET['planet_type'] != 3){
			$this->printMessage('You can only visit this page on a moon', true, array('game.php?page=overview', 2));
			}
			$Element			= 69;
			$levelToBuild	= $PLANET[$resource[$Element]];
			$ProdDm			= pretty_number((2.5 * ($PLANET[$resource[$Element]]+1) * pow((1.1), ($PLANET[$resource[$Element]]+1))) * 1000);
			$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element, false, $levelToBuild);
			$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
			$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);

		
		
		$this->assign(array(
			'buildingId'				=> $Element,
			'level'				=> $PLANET[$resource[$Element]],
			'costResources'		=> $costResources,
			'costOverflow'		=> $costOverflow,
			'buyable'			=> $buyable,
			'levelToBuild'		=> $levelToBuild,
			'nextlvldm'	=> sprintf($LNG['customm_7'], $ProdDm),
		));
		
		$this->display('page.kollaider.default.tpl');
	}
}
