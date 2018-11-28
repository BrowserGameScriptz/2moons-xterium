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

class BuildFunctions
{
	
	static $bonusList	= array(
		'Attack',
		'Defensive',
		'Shield',
		'BuildTime',
		'ResearchTime',
		'ShipTime',
		'DefensiveTime',
		'Resource',
		'Energy',
		'ResourceStorage',
		'ShipStorage',
		'FlyTime',
		'FleetSlots',
		'Planets',
		'SpyPower',
		'Expedition',
		'GateCoolTime',
		'MoreFound',
	);

	public static function getBonusList()
	{
		return self::$bonusList;
	}
	public static function getRestPriceDM($USER, $PLANET, $Element, $elementPrice = NULL)
	{
		global $resource, $pricelist;
		
		if(!isset($elementPrice)) {
			$elementPrice	= self::getElementPriceDM($USER, $PLANET, $Element);
		}
		
			$overflow	= array();
			$ressourceAmount	= $pricelist[$Element]['cost921special'];
		
		foreach ($elementPrice as $resType => $resPrice) {
			$available			= isset($PLANET[$resource[921]]) ? $PLANET[$resource[921]] : $USER[$resource[921]];
			$overflow[921] = max($resPrice - floor($available), 0);
		}
		

		return $overflow;
	}
	public static function getRestPrice($USER, $PLANET, $Element, $elementPrice = NULL)
	{
		global $resource;
		
		if(!isset($elementPrice)) {
			$elementPrice	= self::getElementPrice($USER, $PLANET, $Element);
		}
		
		$overflow	= array();
		
		foreach ($elementPrice as $resType => $resPrice) {
			$available			= isset($PLANET[$resource[$resType]]) ? $PLANET[$resource[$resType]] : $USER[$resource[$resType]];
			
			if($resType == 922)
				$available += $USER['antimatter_bought'];
			
			$overflow[$resType] = max($resPrice - floor($available), 0);
			
		}

		return $overflow;
	}
	
	public static function getRestPriceConvLight($USER, $PLANET, $Element, $elementPrice = NULL)
	{
		global $resource;
		
		
		$elementPrice	= self::getConveyorPriceLight($USER, $PLANET, $Element);
		
		
		$overflow	= array();
		
		foreach ($elementPrice as $resType => $resPrice) {
			$available			= isset($PLANET[$resource[$resType]]) ? $PLANET[$resource[$resType]] : $USER[$resource[$resType]];
			$overflow[$resType] = max($resPrice - floor($available), 0);
			
		}

		return $overflow;
	}
	public static function getRestPriceConvMedium($USER, $PLANET, $Element, $elementPrice = NULL)
	{
		global $resource;
		
		
		$elementPrice	= self::getConveyorPriceMedium($USER, $PLANET, $Element);
		
		
		$overflow	= array();
		
		foreach ($elementPrice as $resType => $resPrice) {
			$available			= isset($PLANET[$resource[$resType]]) ? $PLANET[$resource[$resType]] : $USER[$resource[$resType]];
			$overflow[$resType] = max($resPrice - floor($available), 0);
			
		}

		return $overflow;
	}
	public static function getRestPriceConvHeavy($USER, $PLANET, $Element, $elementPrice = NULL)
	{
		global $resource;
		
		
		$elementPrice	= self::getConveyorPriceHeavy($USER, $PLANET, $Element);
		
		
		$overflow	= array();
		
		foreach ($elementPrice as $resType => $resPrice) {
			$available			= isset($PLANET[$resource[$resType]]) ? $PLANET[$resource[$resType]] : $USER[$resource[$resType]];
			$overflow[$resType] = max($resPrice - floor($available), 0);
			
		}

		return $overflow;
	}
	public static function getElementPriceDMAlliance($USER, $PLANET, $Element, $forDestroy = false, $forLevel = NULL) {
		global $pricelist, $resource, $reslist;

       	if (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet']))) {
			$elementLevel = $forLevel;
		} elseif (isset($forLevel)) {
			$elementLevel = $forLevel;
		} elseif (isset($PLANET[$resource[$Element]])) {
			$elementLevel = $PLANET[$resource[$Element]];
		} elseif (isset($USER[$resource[$Element]])) {
			$elementLevel = $USER[$resource[$Element]];
		} else {
			return array();
		}
		
		$price	= array();
		
			
			$ressourceAmount	= $pricelist[$Element]['cost921special'];
			
			$config	= Config::get();
			
			$price[921]	= $ressourceAmount;
						
			if(isset($pricelist[$Element]['factor']) && $pricelist[$Element]['factor'] != 0 && $pricelist[$Element]['factor'] != 1) {
				if($Element < 100){
				$Fac = 4800;
				}else{
				$Fac = 1800;
				}
				$price[921]	= round(max($pricelist[$Element]['cost921special'],($pricelist[$Element]['alliance']['901'] + $pricelist[$Element]['alliance']['902'] + $pricelist[$Element]['alliance']['903']) *pow($pricelist[$Element]['factor'], $elementLevel) / $Fac));					
				
				$extrareduction = 0;
				if(config::get(ROOT_UNI)->happyHourEvent == 12 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
					$extrareduction = config::get()->happyHourBonus;
				$price[921]	= $price[921] - ($price[921] / 100 * $config->darkmatter_reduc) - ($price[921] / 100 * $extrareduction);
			}
			if($forLevel && (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet'])))) {
				$price[921]	*= $elementLevel;
				$extrareduction = 0;
				if(config::get(ROOT_UNI)->happyHourEvent == 12 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
					$extrareduction = config::get()->happyHourBonus;
				$price[921]	= $price[921] - ($price[921] / 100 * $config->darkmatter_reduc) - ($price[921] / 100 * $extrareduction);
			}
		
		return $price; 
	}
	
	public static function getElementPriceDM($USER, $PLANET, $Element, $forDestroy = false, $forLevel = NULL) {
		global $pricelist, $resource, $reslist;

       	if (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet']))) {
			$elementLevel = $forLevel;
		} elseif (isset($forLevel)) {
			$elementLevel = $forLevel;
		} elseif (isset($PLANET[$resource[$Element]])) {
			$elementLevel = $PLANET[$resource[$Element]];
		} elseif (isset($USER[$resource[$Element]])) {
			$elementLevel = $USER[$resource[$Element]];
		} else {
			return array();
		}
		
		$price	= array();
		
			
			$ressourceAmount	= $pricelist[$Element]['cost921special'];
			if($Element == 125)
				$ressourceAmount += $pricelist[$Element]['cost']['921'];
			
			$config	= Config::get();
			
			$price[921]	= $ressourceAmount;
						
			if(isset($pricelist[$Element]['factor']) && $pricelist[$Element]['factor'] != 0 && $pricelist[$Element]['factor'] != 1) {
				if($Element < 100){
				$Fac = 4800;
				}else{
				$Fac = 1800;
				}
				$price[921]	= round(max($pricelist[$Element]['cost921special'],($pricelist[$Element]['cost']['901'] + $pricelist[$Element]['cost']['902'] + $pricelist[$Element]['cost']['903']) *pow($pricelist[$Element]['factor'], $elementLevel) / $Fac));
				if($Element == 125){
					$price[921]	+= $pricelist[$Element]['cost']['921'] *pow($pricelist[$Element]['factor'], $elementLevel);
				}
					
				
				$extrareduction = 0;
				if(config::get(ROOT_UNI)->happyHourEvent == 12 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
					$extrareduction = config::get()->happyHourBonus;
				$price[921]	= $price[921] - ($price[921] / 100 * $config->darkmatter_reduc) - ($price[921] / 100 * $extrareduction);
			}
			if($forLevel && (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet'])))) {
				$price[921]	*= $elementLevel;
				$extrareduction = 0;
				if(config::get(ROOT_UNI)->happyHourEvent == 12 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
					$extrareduction = config::get()->happyHourBonus;
				$price[921]	= $price[921] - ($price[921] / 100 * $config->darkmatter_reduc) - ($price[921] / 100 * $extrareduction);
			}
		
		return $price; 
	}
	
	public static function getElementPrice($USER, $PLANET, $Element, $forDestroy = false, $forLevel = NULL) { 
		global $pricelist, $resource, $reslist;

       	if (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet']))) {
			$elementLevel = $forLevel;
		} elseif (isset($forLevel)) {
			$elementLevel = $forLevel;
		} elseif (isset($PLANET[$resource[$Element]])) {
			$elementLevel = $PLANET[$resource[$Element]];
		} elseif (isset($USER[$resource[$Element]])) {
			$elementLevel = $USER[$resource[$Element]];
		} else {
			return array();
		}
		
		$price	= array();
		foreach ($reslist['ressources'] as $resType)
		{
			if (!isset($pricelist[$Element]['cost'][$resType])) {
				continue;
			}
			$ressourceAmount	= $pricelist[$Element]['cost'][$resType];
			
			$ally_fraction_fleet_price = 0;
			$ally_fraction_research_price = 0;
			$ally_fraction_defe_price = 0;
			$ally_fraction_build_price = 0;
			if($USER['ally_id'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
				$ALLIANCE = Database::get()->selectSingle($sql, array(
				':allyID'	=> $USER['ally_id']
				));
				if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
					$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
					$FRACTIONS = Database::get()->selectSingle($sql, array(
					':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
					));
					$ally_fraction_fleet_price = $FRACTIONS['ally_fraction_fleet_price'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_research_price = $FRACTIONS['ally_fraction_research_price'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_defe_price = $FRACTIONS['ally_fraction_defe_price'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_build_price = $FRACTIONS['ally_fraction_build_price'] * $ALLIANCE['ally_fraction_level'];
				}
			}
			
			if(in_array($Element, $reslist['fleet'])) {
				$ressourceAmount	= $ressourceAmount - ($ressourceAmount / 100 * $USER['academy_p_b_1_1104']) - ($ressourceAmount / 100 * abs($ally_fraction_fleet_price));
			}elseif(in_array($Element, $reslist['defense']) || in_array($Element, $reslist['missile'])) {
				$ressourceAmount	= $ressourceAmount - ($ressourceAmount / 100 * $USER['academy_p_b_3_1310'])  - ($ressourceAmount / 100 * abs($ally_fraction_defe_price));
			}elseif(in_array($Element, $reslist['tech'])) {
				$ressourceAmount	= $ressourceAmount - ($ressourceAmount / 100 * abs($ally_fraction_research_price));
			}elseif(in_array($Element, $reslist['build'])) {
				$ressourceAmount	= $ressourceAmount - ($ressourceAmount / 100 * abs($ally_fraction_build_price));
			}
			
			if ($ressourceAmount == 0) {
				continue;
			}
			
			$price[$resType]	= $ressourceAmount;
			$config	= Config::get($USER['universe']);
			if(isset($pricelist[$Element]['factor']) && $pricelist[$Element]['factor'] != 0 && $pricelist[$Element]['factor'] != 1) {
				$price[$resType]	*= pow($pricelist[$Element]['factor'], $elementLevel);
				if($config->collider_promo > 0 && $Element == 69){
					$price[$resType] = $price[$resType] - ($price[$resType] / 100 * $config->collider_promo);
				}
				
			}
			
			if($forLevel && (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet'])))) {
				$price[$resType]	*= $elementLevel;
			}
			
			if($forDestroy === true) {
				$price[$resType]	/= 2;
			}
		}
		
		return $price; 
	}
	
	public static function getElementPriceAlliance($USER, $PLANET, $Element, $forDestroy = false, $forLevel = NULL) { 
		global $pricelist, $resource, $reslist;

       	if (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet']))) {
			$elementLevel = $forLevel;
		} elseif (isset($forLevel)) {
			$elementLevel = $forLevel;
		} elseif (isset($PLANET[$resource[$Element]])) {
			$elementLevel = $PLANET[$resource[$Element]];
		} elseif (isset($USER[$resource[$Element]])) {
			$elementLevel = $USER[$resource[$Element]];
		} else {
			return array();
		}
		
		$price	= array();
		foreach ($reslist['ressources'] as $resType)
		{
			if (!isset($pricelist[$Element]['alliance'][$resType])) {
				continue;
			}
			$ressourceAmount	= $pricelist[$Element]['alliance'][$resType];
			
			$ally_fraction_fleet_price = 0;
			$ally_fraction_research_price = 0;
			$ally_fraction_defe_price = 0;
			$ally_fraction_build_price = 0;
			if($USER['ally_id'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
				$ALLIANCE = Database::get()->selectSingle($sql, array(
				':allyID'	=> $USER['ally_id']
				));
				if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
					$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
					$FRACTIONS = Database::get()->selectSingle($sql, array(
					':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
					));
					$ally_fraction_fleet_price = $FRACTIONS['ally_fraction_fleet_price'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_research_price = $FRACTIONS['ally_fraction_research_price'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_defe_price = $FRACTIONS['ally_fraction_defe_price'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_build_price = $FRACTIONS['ally_fraction_build_price'] * $ALLIANCE['ally_fraction_level'];
				}
			}
			
			if(in_array($Element, $reslist['fleet'])) {
				$ressourceAmount	= $ressourceAmount - ($ressourceAmount / 100 * $USER['academy_p_b_1_1104']) - ($ressourceAmount / 100 * abs($ally_fraction_fleet_price));
			}elseif(in_array($Element, $reslist['defense']) || in_array($Element, $reslist['missile'])) {
				$ressourceAmount	= $ressourceAmount - ($ressourceAmount / 100 * $USER['academy_p_b_3_1310'])  - ($ressourceAmount / 100 * abs($ally_fraction_defe_price));
			}elseif(in_array($Element, $reslist['tech'])) {
				$ressourceAmount	= $ressourceAmount - ($ressourceAmount / 100 * abs($ally_fraction_research_price));
			}elseif(in_array($Element, $reslist['build'])) {
				$ressourceAmount	= $ressourceAmount - ($ressourceAmount / 100 * abs($ally_fraction_build_price));
			}
			
			if ($ressourceAmount == 0) {
				continue;
			}
			
			$price[$resType]	= $ressourceAmount;
			$config	= Config::get($USER['universe']);
			if(isset($pricelist[$Element]['factor']) && $pricelist[$Element]['factor'] != 0 && $pricelist[$Element]['factor'] != 1) {
				$price[$resType]	*= pow($pricelist[$Element]['factor'], $elementLevel);
				if($config->collider_promo > 0 && $Element == 69){
					$price[$resType] = $price[$resType] - ($price[$resType] / 100 * $config->collider_promo);
				}
				
			}
			
			if($forLevel && (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet'])))) {
				$price[$resType]	*= $elementLevel;
			}
			
			if($forDestroy === true) {
				$price[$resType]	/= 2;
			}
		}
		
		return $price; 
	}
	
	
	public static function getElementPriceCalcu($USER, $PLANET, $Element, $forDestroy = false, $forLevel = NULL) { 
		global $pricelist, $resource, $reslist;

       	if (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet']))) {
			$elementLevel = $forLevel;
		} elseif (isset($forLevel)) {
			$elementLevel = $forLevel;
		} elseif (isset($PLANET[$resource[$Element]])) {
			$elementLevel = $PLANET[$resource[$Element]];
		} elseif (isset($USER[$resource[$Element]])) {
			$elementLevel = $USER[$resource[$Element]];
		} else {
			return array();
		}
		
		$price	= array();
		foreach ($reslist['ressources'] as $resType)
		{
			
			$ressourceAmount	= $pricelist[$Element]['cost'][$resType];
			
			if(in_array($Element, $reslist['fleet'])) {
				$ressourceAmount	= $ressourceAmount - ($ressourceAmount / 100 * $USER['academy_p_b_1_1104']);
			}elseif(in_array($Element, $reslist['defense']) || in_array($Element, $reslist['missile'])) {
				$ressourceAmount	= $ressourceAmount - ($ressourceAmount / 100 * $USER['academy_p_b_3_1310']);
			}

			$price[$resType]	= $ressourceAmount;
			$config	= Config::get($USER['universe']);
		}
		
		return $price; 
	}
	
	
	public static function getConveyorPriceLight($USER, $PLANET, $Element, $forDestroy = false, $forLevel = NULL) { 
		global $pricelist, $resource, $reslist;

       	if (in_array($Element, array_merge($reslist['defense'], $reslist['missile'], $reslist['fleet']))) {
			$elementLevel = $forLevel;
		} elseif (isset($forLevel)) {
			$elementLevel = $forLevel;
		} elseif (isset($PLANET[$resource[$Element]])) {
			$elementLevel = $PLANET[$resource[$Element]];
		} elseif (isset($USER[$resource[$Element]])) {
			$elementLevel = $USER[$resource[$Element]];
		} else {
			return array();
		}
		
		$price	= array(); 
		
		$ResUsed = array(901,902,903,921);
		foreach ($ResUsed as $resType)
		{
		$it 				= 1;
		$res 			= 0;
		$factor_class	= 1.1;
		$level_item		= $PLANET[$resource[$Element].'_conv'];
		$count 			= max( 1, min( 100, 1));
		
			if (!isset($pricelist[$Element]['cost'][$resType])) {
				continue;
			}
			$ressourceAmount	= $pricelist[$Element]['cost'][$resType];
			
			if($Element == 502 || $Element == 503)
				$ressourceAmount *= 1500;
			
			if ($ressourceAmount == 0) {
				continue;
			}
			
			
			
			$price[$resType]	= round($ressourceAmount * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
			
			
			if($forLevel && (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet'])))) {
			$countd 			= max( 1, min( 100, $elementLevel));
			$price[$resType]	= 0;
			
			$ally_fraction_fleet_price = 0;
			$ally_fraction_defe_price = 0;
			if($USER['ally_id'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
				$ALLIANCE = Database::get()->selectSingle($sql, array(
				':allyID'	=> $USER['ally_id']
				));
				if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
					$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
					$FRACTIONS = Database::get()->selectSingle($sql, array(
					':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
					));
					$ally_fraction_fleet_price = $FRACTIONS['ally_fraction_fleet_price'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_defe_price = $FRACTIONS['ally_fraction_defe_price'] * $ALLIANCE['ally_fraction_level'];
				}
			}
			
			
			for ($it; $it <= $countd; $it++) 
			{
			$res = $pricelist[$Element]['cost'][$resType];
			if($Element == 502 || $Element == 503)
				$res *= 1500;
			
			if(in_array($Element, $reslist['fleet'])) {
				$res	= $res - ($res / 100 * $USER['academy_p_b_1_1104']) - ($res / 100 * abs($ally_fraction_fleet_price));
			}elseif(in_array($Element, array_merge($reslist['defense'], $reslist['missile']))) {
				$res	= $res - ($res / 100 * $USER['academy_p_b_3_1310']) - ($res / 100 * abs($ally_fraction_defe_price));
			}
			$price[$resType] += round($res * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
			}	
}
		}
		
		return $price; 
	}
	
	public static function getConveyorPriceMedium($USER, $PLANET, $Element, $forDestroy = false, $forLevel = NULL) { 
		global $pricelist, $resource, $reslist;

       	if (in_array($Element, array_merge($reslist['defense'], $reslist['missile'], $reslist['fleet']))) {
			$elementLevel = $forLevel;
		} elseif (isset($forLevel)) {
			$elementLevel = $forLevel;
		} elseif (isset($PLANET[$resource[$Element]])) {
			$elementLevel = $PLANET[$resource[$Element]];
		} elseif (isset($USER[$resource[$Element]])) {
			$elementLevel = $USER[$resource[$Element]];
		} else {
			return array();
		}
		
		$price	= array();
		
		$ResUsed = array(901,902,903,921);
		foreach ($ResUsed as $resType)
		{
		$it 				= 1;
		$res 			= 0;
		$factor_class	= 1.2;
		$level_item		= $PLANET[$resource[$Element].'_conv'];
		$count 			= max( 1, min( 100, 1));
		
			if (!isset($pricelist[$Element]['cost'][$resType])) {
				continue;
			}
			$ressourceAmount	= $pricelist[$Element]['cost'][$resType];
			if($Element == 502 || $Element == 503)
				$ressourceAmount *= 1500;
			
			if ($ressourceAmount == 0) {
				continue;
			}
			
		
			$price[$resType]	= round($ressourceAmount * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
			
			
			if($forLevel && (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet'])))) {
			$countd 			= max( 1, min( 100, $elementLevel));
			$price[$resType]	= 0;
			
			$ally_fraction_fleet_price = 0;
			$ally_fraction_defe_price = 0;
			if($USER['ally_id'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
				$ALLIANCE = Database::get()->selectSingle($sql, array(
				':allyID'	=> $USER['ally_id']
				));
				if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
					$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
					$FRACTIONS = Database::get()->selectSingle($sql, array(
					':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
					));
					$ally_fraction_fleet_price = $FRACTIONS['ally_fraction_fleet_price'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_defe_price = $FRACTIONS['ally_fraction_defe_price'] * $ALLIANCE['ally_fraction_level'];
				}
			}
			
			for ($it; $it <= $countd; $it++) 
			{
			$res = $pricelist[$Element]['cost'][$resType];
			if($Element == 502 || $Element == 503)
				$res *= 1500;
			if(in_array($Element, $reslist['fleet'])) {
				$res	= $res - ($res / 100 * $USER['academy_p_b_1_1104']) - ($res / 100 * abs($ally_fraction_fleet_price));
			}elseif(in_array($Element, array_merge($reslist['defense'], $reslist['missile']))) {
				$res	= $res - ($res / 100 * $USER['academy_p_b_3_1310']) - ($res / 100 * abs($ally_fraction_defe_price));
			}
			$price[$resType] += round($res * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
			}	
}
		}
		
		return $price; 
	}
	
	public static function getConveyorPriceHeavy($USER, $PLANET, $Element, $forDestroy = false, $forLevel = NULL) { 
		global $pricelist, $resource, $reslist;

       	if (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet']))) {
			$elementLevel = $forLevel;
		} elseif (isset($forLevel)) {
			$elementLevel = $forLevel;
		} elseif (isset($PLANET[$resource[$Element]])) {
			$elementLevel = $PLANET[$resource[$Element]];
		} elseif (isset($USER[$resource[$Element]])) {
			$elementLevel = $USER[$resource[$Element]];
		} else {
			return array();
		}
		
		$price	= array();
		
		$ResUsed = array(901,902,903,921);
		foreach ($ResUsed as $resType)
		{
		$it 				= 1;
		$res 			= 0;
		$factor_class	= 2;
		$level_item		= $PLANET[$resource[$Element].'_conv'];
		$count 			= max( 1, min( 100, 1));
		
			if (!isset($pricelist[$Element]['cost'][$resType])) {
				continue;
			}
			$ressourceAmount	= $pricelist[$Element]['cost'][$resType];
			
			if ($ressourceAmount == 0) {
				continue;
			}
			
			
			$price[$resType]	= round($ressourceAmount * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
			
			
			if($forLevel && (in_array($Element, array_merge($reslist['defense'], $reslist['missile'],$reslist['fleet'])))) {
			$countd 			= max( 1, min( 100, $elementLevel));
			$price[$resType]	= 0;
			
			$ally_fraction_fleet_price = 0;
			$ally_fraction_defe_price = 0;
			if($USER['ally_id'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
				$ALLIANCE = Database::get()->selectSingle($sql, array(
				':allyID'	=> $USER['ally_id']
				));
				if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
					$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
					$FRACTIONS = Database::get()->selectSingle($sql, array(
					':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
					));
					$ally_fraction_fleet_price = $FRACTIONS['ally_fraction_fleet_price'] * $ALLIANCE['ally_fraction_level'];
					$ally_fraction_defe_price = $FRACTIONS['ally_fraction_defe_price'] * $ALLIANCE['ally_fraction_level'];
				}
			}
			
			for ($it; $it <= $countd; $it++) 
			{
			$res = $pricelist[$Element]['cost'][$resType];
			if(in_array($Element, $reslist['fleet'])) {
				$res	= $res - ($res / 100 * $USER['academy_p_b_1_1104']) - ($res / 100 * abs($ally_fraction_fleet_price));
			}elseif(in_array($Element, array_merge($reslist['defense'], $reslist['missile']))) {
				$res	= $res - ($res / 100 * $USER['academy_p_b_3_1310']) - ($res / 100 * abs($ally_fraction_defe_price));
			}
			$price[$resType] += round($res * (1 + $level_item + ($it - 1)) * pow($factor_class, $level_item + ($it - 1)));
			}	
}
		}
		
		return $price; 
	}
	
	public static function isTechnologieAccessible($USER, $PLANET, $Element)
	{
		global $requeriments, $resource;
		
		if(!isset($requeriments[$Element]))
			return true;		

		foreach($requeriments[$Element] as $ReqElement => $EleLevel)
		{
			if (
				(isset($USER[$resource[$ReqElement]]) && $USER[$resource[$ReqElement]] < $EleLevel) || 
				(isset($PLANET[$resource[$ReqElement]]) && $PLANET[$resource[$ReqElement]] < $EleLevel)
			) {
				return false;
			}
		}
		return true;
	}
	
	public static function isTechnologieAcademy($USER, $PLANET, $Element)
	{
		global $requeriments, $resource;
		
		if(!isset($requeriments[$Element]))
			return true;		

		foreach($requeriments[$Element] as $ReqElement => $EleLevel)
		{
			$userBranch  = 0;
			if($ReqElement > 1300){
			$userBranch  = 3;	
			}elseif($ReqElement > 1200){
			$userBranch  = 2;	
			}else{
			$userBranch  = 1;		
			}
			$Name = "academy_p_b_".$userBranch."_".$ReqElement;
			$Names = $USER[$Name];
			if (
				(isset($Names) && $Names < $EleLevel) 
			) {
				return false;
			}
		}
		return true;
	}
	
	public static function getBuildingTime($USER, $PLANET, $Element, $elementPrice = NULL, $forDestroy = false, $forLevel = NULL)
	{
		global $resource, $reslist, $requeriments, $pricelist;
		
		$config	= Config::get($USER['universe']);

        $time   = 0;

        if(!isset($elementPrice)) {
			$elementPrice	= self::getElementPrice($USER, $PLANET, $Element, $forDestroy, $forLevel);
		}
		
		$elementCost	= 0;
		
		if(isset($elementPrice[901])) {
			$elementCost	+= $elementPrice[901];
		}
		
		if(isset($elementPrice[902])) {
			$elementCost	+= $elementPrice[902];
		}
		
			$premium_build_time = 0;
			if($USER['prem_s_build'] > 0 && $USER['prem_s_build_days'] > TIMESTAMP){
			$premium_build_time = $USER['prem_s_build'];
			}
			
			$academy_p_b_2_1203 = 0;
			if($USER['academy_p_b_2_1203'] > 0){
			$academy_p_b_2_1203 = $USER['academy_p_b_2_1203'] * 2;
			}
			
			$academy_p_b_2_1205 = 0;
			if($USER['academy_p_b_2_1205'] > 0){
			$academy_p_b_2_1205 = $USER['academy_p_b_2_1205'];
			}
			
			$gouvernors_build_time = 0;
			if($USER['dm_buildtime'] > TIMESTAMP){
			$gouvernors_build_time = GubPriceAPSTRACT(703, $USER['dm_buildtime_level'], 'dm_buildtime');
			}
			
			$gouvernors_research_time = 0;
			if($USER['dm_researchtime'] > TIMESTAMP){
			$gouvernors_research_time = GubPriceAPSTRACT(706, $USER['dm_researchtime_level'], 'dm_researchtime');
			}
			
			$hashallybuild = 0;
			$hashallyresea = 0;
			$db	= Database::get();
			$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
			$allyInforconv = $db->selectSingle($sql, array(
			':allianceId'	=> $USER['ally_id']
			));
			if($USER['ally_id'] != 0){
			$hashallybuild = $allyInforconv['total_alliance_buildings'];	
			$hashallyresea = $allyInforconv['total_alliance_research'];	
			} 
		
			
			
		if(in_array($Element, $reslist['build'])) {
			$basic_build_time_2moons = $elementCost / ($config->game_speed * (1 + $PLANET[$resource[14]])) * pow(0.5, $PLANET[$resource[15]]) * (1 + $USER['factor']['BuildTime']);
			$basic_build_time_2moons -= $basic_build_time_2moons / 100 * $premium_build_time;
			$basic_build_time_2moons -= $basic_build_time_2moons / 100 * $gouvernors_build_time;
			$basic_build_time_2moons -= $basic_build_time_2moons / 100 * 0.5 * $hashallybuild;
			$time	= $basic_build_time_2moons;

			} elseif (in_array($Element, $reslist['fleet'])) {
		
			$time	= $elementCost / ($config->game_speed * (1 + $PLANET[$resource[21]])) * pow(0.5, $PLANET[$resource[15]]) * (1 + $USER['factor']['ShipTime']);
			$times = $time;
			if($pricelist[$Element]['type_gun'] > 0)
				$times = max($time, 1);

			

			if($times == 1){
			

			$SpecialShip = 0;	

			if(isset($PLANET[$resource[$Element].'_conv'])){
				$SpecialShip = $PLANET[$resource[$Element].'_conv'];	 		
			}	

			$premium_conv_l = 0;
			if($USER['prem_conveyors_l'] > 0 && $USER['prem_conveyors_l_days'] > TIMESTAMP){
			$premium_conv_l = $USER['prem_conveyors_l'];
			}
			
			$premium_conv_s = 0;
			if($USER['prem_conveyors_s'] > 0 && $USER['prem_conveyors_s_days'] > TIMESTAMP){
			$premium_conv_s = $USER['prem_conveyors_s'];
			}
		
			$premium_conv_t = 0;
			if($USER['prem_conveyors_t'] > 0 && $USER['prem_conveyors_t_days'] > TIMESTAMP){
			$premium_conv_t = $USER['prem_conveyors_t'];
			}
		
			$arsenal_1_conv = $pricelist[817]['arsenal_bonus'] * $USER['arsenal_conveyor1_level'];
			$arsenal_2_conv = $pricelist[818]['arsenal_bonus'] * $USER['arsenal_conveyor2_level'];
			$arsenal_3_conv = $pricelist[819]['arsenal_bonus'] * $USER['arsenal_conveyor3_level'];

			$sql	= 'SELECT * FROM %%PLANETIMG%% WHERE imageId = :imageId;';
			$planetStructureBonuses = $db->selectSingle($sql, array(
			':imageId'	=> $PLANET['image']
			));
				
			$hashallyconv = 0;
			$hashallyconvd = 0;
			$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
			$allyInforconv = $db->selectSingle($sql, array(
			':allianceId'	=> $USER['ally_id']
			));
			if($USER['ally_id'] != 0){
			$hashallyconv = $allyInforconv['total_alliance_conv_fleet'];	
			$hashallyconvd = $allyInforconv['total_alliance_conv_def'];	
			} 
		
			$hashallyconv1 = floor($hashallyconv/2);
			$hashallyconv2 = floor($hashallyconv/4);
			$hashallyconv3 = floor($hashallyconv/8);
		
			$hashallyconvd1 = floor($hashallyconvd/2);
			$hashallyconvd2 = floor($hashallyconvd/4);
			$hashallyconvd3 = floor($hashallyconvd/8);	

			$getGalaxySevenAccount = getGalaxySevenAccount($USER);
			$getGalaxySevenConLvl  = $getGalaxySevenAccount['conveyorLevel'];

			$getGalaxySevePlanet 	= getGalaxySevenPlanet($PLANET);
			$getGalaxySevenConv 	= $getGalaxySevePlanet['conveyorBonus'];
			
			if($pricelist[$Element]['type_gun'] == 1){
				$Total = (($PLANET['light_conveyor'] + floor($PLANET['light_conveyor'] / 100 * $getGalaxySevenConLvl))*60);
				$Total += $Total / 100 * $getGalaxySevenConv;
				$TotalBonus = $USER['peacefull_exp_light'] + $SpecialShip + $hashallyconv1;
				$TotalBonus1 = ($Total / 100 * $premium_conv_l);
				$TotalBonus2 = ($Total / 100 * $planetStructureBonuses['bonus_conveyors']);
				$TotalBonus3 = ($Total / 100 * $arsenal_1_conv);
				$TotalBonus4 = ($Total / 100 * ($USER['rpg_technocrate']*5));
				$Total = $Total + $TotalBonus + $TotalBonus1 + $TotalBonus2 + $TotalBonus3 + $TotalBonus4;
				if($Total == 0)
					$Total = 1;
				$time = 1/$Total/3600;
			}elseif($pricelist[$Element]['type_gun'] == 2){
				$Total = (($PLANET['medium_conveyor'] + floor($PLANET['medium_conveyor'] / 100 * $getGalaxySevenConLvl))*36);
				$Total += $Total / 100 * $getGalaxySevenConv;
				$TotalBonus = $USER['peacefull_exp_medium'] + $SpecialShip + $hashallyconv2;
				$TotalBonus1 = ($Total / 100 * $premium_conv_s);
				$TotalBonus2 = ($Total / 100 * $planetStructureBonuses['bonus_conveyors']);
				$TotalBonus3 = ($Total / 100 * $arsenal_2_conv);
				$TotalBonus4 = ($Total / 100 * ($USER['rpg_technocrate']*5));
				$Total = $Total + $TotalBonus + $TotalBonus1 + $TotalBonus2 + $TotalBonus3 + $TotalBonus4;
				if($Total == 0)
					$Total = 1;
				$time = 1/$Total/3600;
			}elseif($pricelist[$Element]['type_gun'] == 3){
				$Total = (($PLANET['heavy_conveyor'] + floor($PLANET['heavy_conveyor'] / 100 * $getGalaxySevenConLvl))*10);
				$Total += $Total / 100 * $getGalaxySevenConv;
				$TotalBonus = $USER['peacefull_exp_heavy'] + $SpecialShip + $hashallyconv3;
				$TotalBonus1 = ($Total / 100 * $premium_conv_t);
				$TotalBonus2 = ($Total / 100 * $planetStructureBonuses['bonus_conveyors']);
				$TotalBonus3 = ($Total / 100 * $arsenal_3_conv);
				$TotalBonus4 = ($Total / 100 * ($USER['rpg_technocrate']*5));
				if($Total == 0)
					$Total = 1;
				$Total = $Total + $TotalBonus + $TotalBonus1 + $TotalBonus2 + $TotalBonus3 + $TotalBonus4;
				$time = 1/$Total/3600;
			}else{
				$time	= $elementCost / ($config->game_speed * (1 + $PLANET[$resource[21]])) * pow(0.5, $PLANET[$resource[15]]) * (1 + $USER['factor']['ShipTime']);
			}
			
			}
		} elseif (in_array($Element, array_merge($reslist['defense'], $reslist['missile']))) {
			$time	= $elementCost / ($config->game_speed * (1 + $PLANET[$resource[21]])) * pow(0.5, $PLANET[$resource[15]]) * (1 + $USER['factor']['DefensiveTime']);
			$times = $time;
			if($pricelist[$Element]['type_gun'] > 0)
				$times = max($time, 1);

			

			if($times == 1){
			

			$SpecialShip = 0;	

			if(isset($PLANET[$resource[$Element].'_conv'])){
				$SpecialShip = $PLANET[$resource[$Element].'_conv'];	 		
			}	

			$premium_conv_l = 0;
			if($USER['prem_conveyors_l'] > 0 && $USER['prem_conveyors_l_days'] > TIMESTAMP){
			$premium_conv_l = $USER['prem_conveyors_l'];
			}
			
			$premium_conv_s = 0;
			if($USER['prem_conveyors_s'] > 0 && $USER['prem_conveyors_s_days'] > TIMESTAMP){
			$premium_conv_s = $USER['prem_conveyors_s'];
			}
		
			$premium_conv_t = 0;
			if($USER['prem_conveyors_t'] > 0 && $USER['prem_conveyors_t_days'] > TIMESTAMP){
			$premium_conv_t = $USER['prem_conveyors_t'];
			}
		
			$arsenal_1_conv = $pricelist[817]['arsenal_bonus'] * $USER['arsenal_conveyor1_level'];
			$arsenal_2_conv = $pricelist[818]['arsenal_bonus'] * $USER['arsenal_conveyor2_level'];
			$arsenal_3_conv = $pricelist[819]['arsenal_bonus'] * $USER['arsenal_conveyor3_level'];
			
			$sql	= 'SELECT * FROM %%PLANETIMG%% WHERE imageId = :imageId;';
			$planetStructureBonuses = $db->selectSingle($sql, array(
			':imageId'	=> $PLANET['image']
			));

			$hashallyconv = 0;
			$hashallyconvd = 0;
			$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
			$allyInforconv = $db->selectSingle($sql, array(
			':allianceId'	=> $USER['ally_id']
			));
			if($USER['ally_id'] != 0){
			$hashallyconv = $allyInforconv['total_alliance_conv_fleet'];	
			$hashallyconvd = $allyInforconv['total_alliance_conv_def'];	
			} 
		
			$hashallyconv1 = floor($hashallyconv/2);
			$hashallyconv2 = floor($hashallyconv/4);
			$hashallyconv3 = floor($hashallyconv/8);
		
			$hashallyconvd1 = floor($hashallyconvd/2);
			$hashallyconvd2 = floor($hashallyconvd/4);
			$hashallyconvd3 = floor($hashallyconvd/8);	

			$getGalaxySevenAccount = getGalaxySevenAccount($USER);
			$getGalaxySevenConLvl  = $getGalaxySevenAccount['conveyorLevel'];

			$getGalaxySevePlanet 	= getGalaxySevenPlanet($PLANET);
			$getGalaxySevenConv 	= $getGalaxySevePlanet['conveyorBonus'];
			
			if($pricelist[$Element]['type_gun'] == 1){
				$Total = (($PLANET['light_conveyor'] + floor($PLANET['light_conveyor'] / 100 * $getGalaxySevenConLvl))*120);
				$Total += $Total / 100 * $getGalaxySevenConv;
				$TotalBonus = $USER['peacefull_exp_light'] + $SpecialShip + $hashallyconvd1;
				$TotalBonus1 = floor($Total / 100 * $premium_conv_l);
				$TotalBonus2 = floor($Total / 100 * $planetStructureBonuses['bonus_conveyors']);
				$TotalBonus3 = floor($Total / 100 * $arsenal_1_conv);
				$TotalBonus4 = floor($Total / 100 * ($USER['rpg_defenseur']*25));
				$Total = $Total + $TotalBonus + $TotalBonus1 + $TotalBonus2 + $TotalBonus3 + $TotalBonus4;
				if($Total == 0)
					$Total = 1;
				$time = 1/$Total/3600;
			}elseif($pricelist[$Element]['type_gun'] == 2){
				$Total = (($PLANET['medium_conveyor'] + floor($PLANET['medium_conveyor'] / 100 * $getGalaxySevenConLvl))*72);
				$Total += $Total / 100 * $getGalaxySevenConv;
				$TotalBonus = $USER['peacefull_exp_medium'] + $SpecialShip + $hashallyconvd2;
				$TotalBonus1 = floor($Total / 100 * $premium_conv_s); 
				$TotalBonus2 = floor($Total / 100 * $planetStructureBonuses['bonus_conveyors']);
				$TotalBonus3 = floor($Total / 100 * $arsenal_2_conv);
				$TotalBonus4 = floor($Total / 100 * ($USER['rpg_defenseur']*25));
				$Total = $Total + $TotalBonus + $TotalBonus1 + $TotalBonus2 + $TotalBonus3 + $TotalBonus4;
				if($Total == 0)
					$Total = 1;
				$time = 1/$Total/3600;
			}elseif($pricelist[$Element]['type_gun'] == 3){
				$Total = (($PLANET['heavy_conveyor'] + floor($PLANET['heavy_conveyor'] / 100 * $getGalaxySevenConLvl))*20);
				$Total += $Total / 100 * $getGalaxySevenConv;
				$TotalBonus = $USER['peacefull_exp_heavy'] + $SpecialShip + $hashallyconvd3;
				$TotalBonus1 = floor($Total / 100 * $premium_conv_t);
				$TotalBonus2 = floor($Total / 100 * $planetStructureBonuses['bonus_conveyors']);
				$TotalBonus3 = floor($Total / 100 * $arsenal_3_conv); 
				$TotalBonus4 = floor($Total / 100 * ($USER['rpg_defenseur']*25));
				$Total = $Total + $TotalBonus + $TotalBonus1 + $TotalBonus2 + $TotalBonus3 + $TotalBonus4;
				if($Total == 0)
					$Total = 1;
				$time = 1/$Total/3600;
			}else{
				$time	= $elementCost / ($config->game_speed * (1 + $PLANET[$resource[21]])) * pow(0.5, $PLANET[$resource[15]]) * (1 + $USER['factor']['DefensiveTime']);
			}
			
			}
		} elseif (in_array($Element, $reslist['tech'])) {
			if(is_numeric($PLANET[$resource[31].'_inter']))
			{
				$Level	= $PLANET[$resource[31]] + $academy_p_b_2_1205;
			} else {
				$Level = 0;
				foreach($PLANET[$resource[31].'_inter'] as $Levels)
				{
					if(!isset($requeriments[$Element][31]) || $Levels >= $requeriments[$Element][31])
						$Level += $Levels;
				}
				
				$Level += $academy_p_b_2_1205;
			}
			
			
			$sql	= 'SELECT * FROM %%PLANETIMG%% WHERE imageId = :imageId;';
			$planetStructureBonuses = $db->selectSingle($sql, array(
			':imageId'	=> $PLANET['image']
			));
			$basic_research_time_2moons = $elementCost / (1000 * (1 + $Level)) / ($config->game_speed / 2500) * pow(1 - $config->factor_university / 100, $PLANET[$resource[6]]) * (1 + $USER['factor']['ResearchTime']);
			$basic_research_time_2moons += $basic_research_time_2moons / 100 * $planetStructureBonuses['bonus_research'];
			$basic_research_time_2moons -= $basic_research_time_2moons / 100 * $premium_build_time;
			$basic_research_time_2moons -= $basic_research_time_2moons / 100 * $USER['peacefull_exp_level'];
			$basic_research_time_2moons -= $basic_research_time_2moons / 100 * $academy_p_b_2_1203;
			$basic_research_time_2moons -= $basic_research_time_2moons / 100 * $gouvernors_research_time;
			$basic_research_time_2moons -= $basic_research_time_2moons / 100 * 0.5 * $hashallyresea;
			
			$time	= $basic_research_time_2moons;
		}
		
		if($forDestroy) {
			$time	= floor($time * 1300);
		} else {
			if($Element != "" && $pricelist[$Element]['type_gun'] > 0){
				$time = ($time * 3600);
			}else{
				$time = floor($time * 3600);
			}
				
		}
		
		if($Element < 200){
		return max($time, $config->min_build_time);
		}else{
			$times = max($time, 1);
			if($Element != ""){
			if($pricelist[$Element]['type_gun'] > 0)
				$times = $time;
			}
		return $times;
		}
	}
	
	public static function isElementBuyable($USER, $PLANET, $Element, $elementPrice = NULL, $forDestroy = false, $forLevel = NULL)
	{
		$rest	= self::getRestPrice($USER, $PLANET, $Element, $elementPrice, $forDestroy, $forLevel);
		return count(array_filter($rest)) === 0;
	}
	public static function isElementBuyableDM($USER, $PLANET, $Element, $elementPrice = NULL, $forDestroy = false, $forLevel = NULL)
	{
		$rest	= self::getRestPriceDM($USER, $PLANET, $Element, $elementPrice, $forDestroy, $forLevel);
		return count(array_filter($rest)) === 0;
	}
	
	public static function isElementBuyableLight($USER, $PLANET, $Element, $elementPrice = NULL, $forDestroy = false, $forLevel = NULL)
	{
		$rest	= self::getRestPriceConvLight($USER, $PLANET, $Element, $elementPrice, $forDestroy, $forLevel);
		return count(array_filter($rest)) === 0;
	}
	public static function isElementBuyableMedium($USER, $PLANET, $Element, $elementPrice = NULL, $forDestroy = false, $forLevel = NULL)
	{
		$rest	= self::getRestPriceConvMedium($USER, $PLANET, $Element, $elementPrice, $forDestroy, $forLevel);
		return count(array_filter($rest)) === 0;
	}
	public static function isElementBuyableHeavy($USER, $PLANET, $Element, $elementPrice = NULL, $forDestroy = false, $forLevel = NULL)
	{
		$rest	= self::getRestPriceConvHeavy($USER, $PLANET, $Element, $elementPrice, $forDestroy, $forLevel);
		return count(array_filter($rest)) === 0;
	}
	public static function getMaxConstructibleElementsDM($USER, $PLANET, $Element, $elementPrice = NULL)
	{
		global $resource, $reslist, $pricelist;
		
		if(!isset($elementPrice)) {
			$elementPrice	= self::getElementPriceDM($USER, $PLANET, $Element);
		}

		$maxElement	= array();
		
		
			if(isset($USER[$resource[921]]))
			{
				$maxElement[]	= floor($USER[$resource[921]] / $pricelist[$Element]['cost921special']);
			}
			else
			{
				throw new Exception("Unknown Ressource ".$resourceID." at element ".$Element.".");
			}

			if($Element >= 200 && $Element <= 500){
			if(isset($USER[$resource[921]]) && $Element < 400)
			{
				$totalDarkmatter = $USER[$resource[921]];
				if($totalDarkmatter > 100000000 - $USER['insta_dm_navy'])
					$totalDarkmatter = 100000000 - $USER['insta_dm_navy'];
				$maxElement[]	= floor($totalDarkmatter / $pricelist[$Element]['cost921special']);
			}
			elseif(isset($USER[$resource[921]]) && $Element > 400)
			{
				$totalDarkmatter = $USER[$resource[921]];
				if($totalDarkmatter > 100000000 - $USER['insta_dm_defense'])
					$totalDarkmatter = 100000000 - $USER['insta_dm_defense'];
				$maxElement[]	= floor($totalDarkmatter / $pricelist[$Element]['cost921special']);
			}
			else
			{
				throw new Exception("Unknown Ressource ".$resourceID." at element ".$Element.".");
			}
			}
		
		
		if(in_array($Element, $reslist['one'])) {
			$maxElement[]	= 1;
		}
		
		return min($maxElement);
	}
	
	
	public static function getMaxConstructibleElements($USER, $PLANET, $Element, $elementPrice = NULL)
	{
		global $resource, $reslist;
		
		if(!isset($elementPrice)) {
			$elementPrice	= self::getElementPrice($USER, $PLANET, $Element);
		}
		$maxElement	= array();
		
		foreach($elementPrice as $resourceID => $price)
		{
			if(isset($PLANET[$resource[$resourceID]]))
			{
				$maxElement[]	= floor($PLANET[$resource[$resourceID]] / $price);
			}
			elseif(isset($USER[$resource[$resourceID]]))
			{
				$maxElement[]	= floor($USER[$resource[$resourceID]] / $price);
			}
			else
			{
				throw new Exception("Unknown Ressource ".$resourceID." at element ".$Element.".");
			}
		}
		
		if(in_array($Element, $reslist['one'])) {
			$maxElement[]	= 1;
		}
		
		return min($maxElement);
	}
	
	public static function getMaxConstructibleRockets($USER, $PLANET, $Missiles = NULL)
	{
		global $resource, $reslist;

		if(!isset($Missiles))
		{		
			$Missiles	= array();
			
			foreach($reslist['missile'] as $elementID)
			{
				$Missiles[$elementID]	= $PLANET[$resource[$elementID]];
			}
		}
		
		$BuildArray  	  	= !empty($PLANET['b_defense_id']) ? unserialize($PLANET['b_defense_id']) : array();
		$MaxMissiles   		= $PLANET[$resource[44]] * 200000 * max(Config::get()->silo_factor, 1);

		foreach($BuildArray as $ElementArray) {
			if(isset($Missiles[$ElementArray[0]]))
				$Missiles[$ElementArray[0]] += $ElementArray[1];
		}
		
		$ActuMissiles  = $Missiles[502] + (2 * $Missiles[503]);
		$MissilesSpace = max(0, $MaxMissiles - $ActuMissiles);
		
		return array(
			502	=> $MissilesSpace,
			503	=> floor($MissilesSpace / 2),
		);
	}
	
	public static function getMaxConstructibleDomes($USER, $PLANET, $Domes = NULL)
	{
		global $resource, $reslist;
		
		if(!isset($Domes))
		{		
			$Domes	= array();
		
			foreach($Domes as $elementID)
			{
				$Domes[$elementID]	= $PLANET[$resource[$elementID]];
			}
		}
		
		$BuildArray  	  	= !empty($PLANET['b_defense_id']) ? unserialize($PLANET['b_defense_id']) : array();
		$MaxDomes   		= 25 + 25 * $USER['academy_p_b_2_1208'];
		
		foreach($BuildArray as $ElementArray) {
			if(isset($Domes[$ElementArray[0]]))
				$Domes[$ElementArray[0]] += $ElementArray[1];
		}
		$ActuDomes  = max(0, $MaxDomes - $Domes[407]);
		$DomesSpace = max(0, $MaxDomes - $Domes[408]);
		$DomesPlanet = max(0, $MaxDomes - $Domes[409]);
		return array(
			407	=> $ActuDomes,
			408	=> $DomesSpace,
			409	=> $DomesPlanet,
		);
	}
	
	 public static function getMaxConstructibleOrbits($USER, $PLANET, $Orbits = NULL)
	{
		global $resource, $reslist;
		if(!isset($Orbits))
		{		
		$Orbits	= array();
		foreach($Orbits as $elementID)
		{
		$Orbits[$elementID]	= $PLANET[$resource[$elementID]];
		}
		}
		$BuildArray  	  	= !empty($PLANET['b_defense_id']) ? unserialize($PLANET['b_defense_id']) : array();
		$MaxOrbits   		= 250 + 250 * $USER['academy_p_b_3_1309'];
		foreach($BuildArray as $ElementArray) {
			if(isset($Orbits[$ElementArray[0]]))
				$Orbits[$ElementArray[0]] += $ElementArray[1];
		}
		$ActuOrbits  = max(0, $MaxOrbits - $Orbits[411]);
		return array(
			411	=> $ActuOrbits,
		);
	} 
	
		public static function isBusyToBuild($USER, $PLANET, $Element)
	{
		global $requeriments, $resource;
		
		$CurrentQueue  		= unserialize($PLANET['b_building_id']);
		if (empty($CurrentQueue)) {
		$CurrentQueue	= array();
		}
		foreach($CurrentQueue as $QueueSubArray)
		{
			if($QueueSubArray[0] == $Element){
			return false;
		}
		}
		return true;
	}
	
	public static function isBusyToSearch($USER, $PLANET, $Element)
	{
		global $requeriments, $resource;
		
		$CurrentQueue  		= unserialize($USER['b_tech_queue']);
		if (empty($CurrentQueue)) {
		$CurrentQueue	= array();
		}
		foreach($CurrentQueue as $QueueSubArray)
		{
			if($QueueSubArray[0] == $Element){
			return false;
		}
		}
		return true;
	}
	
	
	public static function getAvalibleBonus($Element)
	{
		global $pricelist;
			
		$elementBonus	= array();
		
		foreach(self::$bonusList as $bonus)
		{
			$temp	= (float) $pricelist[$Element]['bonus'][$bonus][0];
			if(empty($temp))
			{
				continue;
			}
			
			$elementBonus[$bonus]	= $pricelist[$Element]['bonus'][$bonus];
		}
		
		return $elementBonus;
	}
}