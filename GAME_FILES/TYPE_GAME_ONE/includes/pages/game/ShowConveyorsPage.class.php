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

class ShowConveyorsPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
		 
	}
	
	private function up($Count, $Element, $Class)
	{
		global $LNG, $resource, $USER, $PLANET, $pricelist, $reslist;
		
		if(!empty($Count)) {
			if($Class == "l"){
				$ScostResources	= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
			}elseif($Class == "m"){
				$ScostResources	= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
			}elseif($Class == "h"){
				$ScostResources	= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
			}
			
			$costResources		   = Array();
			$costResourcesPre	   = Array();
			$costResources[901]	   = 0;
			$costResources[902]    = 0;
			$costResources[903]    = 0;
			$costResources[921]    = 0;
			$costResourcesPre[901] = 0;
			$costResourcesPre[902] = 0;
			$costResourcesPre[903] = 0;
			$costResourcesPre[921] = 0;
			
			$it 			= 1;
			$res 			= 0;
			
			$factor_class	= 1.1;
			if($Class == "m")
				$factor_class	= 1.2;
			elseif($Class == "h")
				$factor_class	= 1.3;
			
			$level_item		= $PLANET[$resource[$Element].'_conv'];
			
			$Maxed = array();
				
			for ($it; $it <= $Count; $it++) 
			{
				if(isset($ScostResources[901])) {
					$res = $ScostResources[901];
					$costResources[901] += round($res * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
					
					if($PLANET[$resource[901]] < $costResources[901]) {
						$Maxed[] = $it;
						$costResources[901] = $costResourcesPre[901];
						break;
					}
					
					$costResourcesPre[901] += round($res * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
				}
				
				if(isset($ScostResources[902])) {
					$res = $ScostResources[902];
					$costResources[902] += round($res * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
					
					if($PLANET[$resource[902]] < $costResources[902]) {
						$Maxed[] = $it;
						$costResources[902] = $costResourcesPre[902];
						break;
					}
					
					$costResourcesPre[902] += round($res * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
				}
				
				if(isset($ScostResources[903])) {
					$res = $ScostResources[903];
					$costResources[903] += round($res * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
					
					if($PLANET[$resource[903]] < $costResources[903]) {
						$Maxed[] = $it;
						$costResources[903] = $costResourcesPre[903];
						break;
					}
					
					$costResourcesPre[903] += round($res * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
				}
				
				if(isset($ScostResources[921])) {
					$res = $ScostResources[921];
					$costResources[921] += round($res * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
					
					if($PLANET[$resource[921]] < $costResources[921]) {
						$Maxed[] = $it;
						$costResources[921] = $costResourcesPre[921];
						break;
					}
					
					$costResourcesPre[921] += round($res * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
				}
			}
			
			if($Element == 502 || $Element == 503){
				if(isset($costResources[901])){ $costResources[901] *= 1500; }
				if(isset($costResources[902])){ $costResources[902] *= 1500; }
				if(isset($costResources[903])){ $costResources[903] *= 1500; }
				if(isset($costResources[921])){ $costResources[921] *= 1500; }
			}
					
					
			$Maxed = empty($Maxed) ? $Count : min($Maxed);
			//$this->printMessage($Maxed, true, array('game.php?page=conveyors&class=l', 3));
			
			if($Maxed == 0)
				$costResources = array();
			
			$account_before = array(
				'darkmatter'			=> $USER['darkmatter'],
				'antimatter'			=> $USER['antimatter'],
				'metal'					=> $PLANET['metal'],
				'crystal'				=> $PLANET['crystal'],
				'deuterium'				=> $PLANET['deuterium'],
				'ship'					=> $LNG['tech'][$Element],
			);
				
			
			if(isset($costResources[901])) { $PLANET[$resource[901]]	-= $costResources[901]; }
			if(isset($costResources[902])) { $PLANET[$resource[902]]	-= $costResources[902]; }
			if(isset($costResources[903])) { $PLANET[$resource[903]]	-= $costResources[903]; }
			if(isset($costResources[921])) { $USER[$resource[921]]		-= $costResources[921]; }
			if(isset($costResources[922])) { $USER[$resource[922]]		-= $costResources[922]; }
			
			$db	= Database::get();	
			$Name = $resource[$Element];
			$Names = $Name.'_conv';
			$sql	= "UPDATE %%PLANETS%% SET ".$Names." = :nextlevel WHERE id = :planetId;";
			$db->update($sql, array(
				':nextlevel'	=> $PLANET[$resource[$Element].'_conv'] + $Maxed,
				':planetId'	=> $PLANET['id']
			));
			
			$account_after = array(
				'darkmatter'			=> isset($costResources[921]) ? $costResources[921] : 0,
				'antimatter'			=> isset($costResources[922]) ? $costResources[922] : 0,
				'metal'					=> isset($costResources[901]) ? $costResources[901] : 0,
				'crystal'				=> isset($costResources[902]) ? $costResources[902] : 0,
				'deuterium'				=> isset($costResources[903]) ? $costResources[903] : 0,
				'ship'					=> $LNG['tech'][$Element]." - ".$Maxed,
			);
				
			$LOG = new Logcheck(27);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=conveyors upgrade [".$PLANET['galaxy'].":".$PLANET['system'].":".$PLANET['planet']."]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
		}

	}	
	
	public function show()
	{
		global $USER, $PLANET, $LNG, $resource, $reslist, $requeriments, $pricelist;
		
		//if($USER['id'] != 1)
			//$this->printMessage('This page is currently unavailable. Please try again later...', true, array('game.php', 3));
		
		$Class		= HTTP::_GP('class', 'l');
		$Count		= HTTP::_GP('count', 0);
		if($_SERVER['REQUEST_METHOD'] === 'POST' && $USER['urlaubs_modus'] == 0)
		{
			$Element	= HTTP::_GP('construct', 0);
		
			if (!empty($Count))
			{
				$this->up($Count, $Element, $Class);
			}
				
			if($Class == "l"){	
				$this->redirectTo('game.php?page=conveyors&class=l');
			}elseif($Class == "m"){	
				$this->redirectTo('game.php?page=conveyors&class=m');
			}elseif($Class == "h"){	
				$this->redirectTo('game.php?page=conveyors&class=h');
			}
		}
		
		$elementDefault			= array();
		$elementLi				= array();
		$premium_build_prime 	= 0;
		if($USER['prem_prime_units_days'] > TIMESTAMP){
			$premium_build_prime = 1;
		}
		
		if($Class == "l"){
			if($PLANET[$resource[71]] == 0){
				$this->printMessage($LNG['customm_11'], true, array('game.php', 3));
			}
			
			$elementDefault	= array(212,202,203,204,205,229,401,402,403,420,502);
			
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
				$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
				$costResourcesConv	= BuildFunctions::getConveyorPriceLight($USER, $PLANET, $Element);
				$costOverflow		= BuildFunctions::getRestPriceConvLight($USER, $PLANET, $Element, $costResources);
				if (BuildFunctions::getBuildingTime($USER, $PLANET, $Element) > 1)
					continue;
				
				$elementLi[$Element]	= array(
					'id'				=> $Element,
					'available'			=> $PLANET[$resource[$Element]],
					'SCostRessources'		=> $costResources,
					'CostRessources'		=> $costResourcesConv,
					'factorClass'    	=> 1.1,
					'costOverflow'		=> $costOverflow,
					'level'			=> $PLANET[$resource[$Element].'_conv'],
					'AllTech'			=> $techTreeListDefault,
					'techacc'			=> BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element), 

				);
			}
		}elseif($Class == "m"){
			if($PLANET[$resource[72]] == 0){
				$this->printMessage($LNG['customm_26'], true, array('game.php', 3));
			}

			$elementDefault	= array(209,206,207,217,215,213,211,224,219,405,404,406,416,421,417,503);
			
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
				$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
				$costResourcesConv	= BuildFunctions::getConveyorPriceMedium($USER, $PLANET, $Element);
				$costOverflow		= BuildFunctions::getRestPriceConvMedium($USER, $PLANET, $Element, $costResources);
				if (BuildFunctions::getBuildingTime($USER, $PLANET, $Element) > 1)
					continue;
				$elementLi[$Element]	= array(
					'id'				=> $Element,
					'available'			=> $PLANET[$resource[$Element]],
					'SCostRessources'		=> $costResources,
					'CostRessources'		=> $costResourcesConv,
					'factorClass'    	=> 1.2,
					'costOverflow'		=> $costOverflow,
					'level'			=> $PLANET[$resource[$Element].'_conv'],
					'AllTech'			=> $techTreeListDefault,
					'techacc'			=> BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element), 

				);
			}
		}elseif($Class == "h"){
			if($PLANET[$resource[73]] == 0){
				$this->printMessage($LNG['customm_27'], true, array('game.php', 3));
			}
			
			$elementDefault	= array(225,226,227,221,228,222,218,214,230,216,418,412,410,413,419,414,422,415);
			
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
					
				$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
				$costResourcesConv	= BuildFunctions::getConveyorPriceHeavy($USER, $PLANET, $Element);
				$costOverflow		= BuildFunctions::getRestPriceConvHeavy($USER, $PLANET, $Element, $costResources);
				if (BuildFunctions::getBuildingTime($USER, $PLANET, $Element) > 1)
					continue;
				$elementLi[$Element]	= array(
					'id'				=> $Element,
					'available'			=> $PLANET[$resource[$Element]],
					'SCostRessources'	=> $costResources,
					'CostRessources'	=> $costResourcesConv,
					'factorClass'    	=> 2,
					'costOverflow'		=> $costOverflow,
					'level'				=> $PLANET[$resource[$Element].'_conv'],
					'AllTech'			=> $techTreeListDefault,
					'techacc'			=> BuildFunctions::isTechnologieAccessible($USER, $PLANET, $Element), 
				);
			}
		}
		$this->tplObj->loadscript('conveyors.js'); 
		$this->assign(array(
			'elementLi'		=> $elementLi,
			'Class'			=> $Class,
		));
		
		$this->display('page.conveyors.default.tpl');

	}
}
