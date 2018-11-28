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

class ResourceUpdate
{

	/**
	 * reference of the config object
	 * @var Config
	 */
	private $config			= NULL;

	private $isGlobalMode 	= NULL;
	private $TIME			= NULL;
	private $HASH			= NULL;
	private $ProductionTime	= NULL;

	private $PLANET			= array();
	private $USER			= array();
	private $Builded		= array();

	function __construct($Build = true, $Tech = true)
	{
		$this->Build	= $Build;
		$this->Tech		= $Tech;
	}

	public function setData($USER, $PLANET)
	{
		$this->USER		= $USER;
		$this->PLANET	= $PLANET;
	}

	public function getData()
	{
		return array($this->USER, $this->PLANET);
	}
	
	public function ReturnVars() {
		if($this->isGlobalMode)
		{
			$GLOBALS['USER']	= $this->USER;
			$GLOBALS['PLANET']	= $this->PLANET;
			return true;
		} else {
			return array($this->USER, $this->PLANET);
		}
	}
	
	public function CreateHash() {
		global $reslist, $resource;
		$Hash	= array();
		foreach($reslist['prod'] as $ID) {
			if($ID != 921){
			$Hash[]	= $this->PLANET[$resource[$ID]];
			$Hash[]	= $this->PLANET[$resource[$ID].'_porcent'];
			}else{
			$Hash[]	= $this->USER[$resource[$ID]];
			$Hash[]	= $this->PLANET[$resource[$ID].'_porcent'];
			}
		}
		
		$ressource	= array_merge(array(), $reslist['resstype'][1], $reslist['resstype'][2]);
		foreach($ressource as $ID) {
			$Hash[]	= $this->config->{$resource[$ID].'_basic_income'};
		}
		
		$db	= Database::get();
		$sql	= 'SELECT * FROM %%PLANETIMG%% WHERE imageId = :imageId;';
		$planetStructureBonuses = $db->selectSingle($sql, array(
		':imageId'	=> $this->PLANET['image']
		));
		
		$hashallyprod = 0;
		$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
		$allyInfores = $db->selectSingle($sql, array(
			':allianceId'	=> $this->USER['ally_id']
		));
		if($this->USER['ally_id'] != 0){
		$hashallyprod = $allyInfores['total_alliance_production'];	
		}
		$premium_storage = 1;
		if($this->USER['prem_storage'] > 0 && $this->USER['prem_storage_days'] > TIMESTAMP){
		$premium_storage = $this->USER['prem_storage'];
		}
		
		$premium_resource = 0;
		if($this->USER['prem_res'] > 0 && $this->USER['prem_res_days'] > TIMESTAMP){
		$premium_resource = $this->USER['prem_res'];
		}
		
		$getGalaxySevenAccount = getGalaxySevenAccount($this->USER);
		$getGalaxySevenProduct = $getGalaxySevenAccount['resourceProd'];
		$getGalaxySevenCollide = $getGalaxySevenAccount['colliderProd'];
		
		$premium_collider =  0;
		if($this->USER['prem_prod_from_colly'] > 0 && $this->USER['prem_prod_from_colly_days'] > TIMESTAMP){
		$premium_collider = $this->USER['prem_prod_from_colly'];
		}
		
		$itemMetal 		= 0;
		$itemCrystal 	= 0;
		$itemDeuterium	= 0;
		
		if($this->PLANET['auction_item_1_timer'] > TIMESTAMP){
		$itemMetal 		= 0.10;
		}elseif($this->PLANET['auction_item_2_timer'] > TIMESTAMP){
		$itemMetal 		= 0.30;
		}elseif($this->PLANET['auction_item_3_timer'] > TIMESTAMP){
		$itemMetal 		= 0.50;
		}
		
		if($this->PLANET['auction_item_4_timer'] > TIMESTAMP){
		$itemCrystal 		= 0.10;
		}elseif($this->PLANET['auction_item_5_timer'] > TIMESTAMP){
		$itemCrystal 		= 0.30;
		}elseif($this->PLANET['auction_item_6_timer'] > TIMESTAMP){
		$itemCrystal 		= 0.50;
		}
		
		if($this->PLANET['auction_item_7_timer'] > TIMESTAMP){
		$itemDeuterium 		= 0.10;
		}elseif($this->PLANET['auction_item_8_timer'] > TIMESTAMP){
		$itemDeuterium 		= 0.30;
		}elseif($this->PLANET['auction_item_9_timer'] > TIMESTAMP){
		$itemDeuterium 		= 0.50;
		}
		
		$Hash[]	= $this->config->resource_multiplier;
		$Hash[]	= $this->config->energySpeed;
		$Hash[]	= $this->PLANET[$resource[22]];
		$Hash[]	= $this->PLANET[$resource[23]];
		$Hash[]	= $this->PLANET[$resource[24]];
		$Hash[]	= $this->USER[$resource[113]];
		$Hash[]	= $this->USER[$resource[131]];
		$Hash[]	= $this->USER[$resource[132]];
		$Hash[]	= $this->USER[$resource[133]];
		$Hash[]	= $this->USER[$resource[922]];
		$Hash[]	= $this->USER['peacefull_exp_level'];
		$Hash[]	= $planetStructureBonuses['bonus_metal'];
		$Hash[]	= $planetStructureBonuses['bonus_crystal'];
		$Hash[]	= $planetStructureBonuses['bonus_deuterium'];
		$Hash[]	= $planetStructureBonuses['bonus_energy'];
		$Hash[]	= $premium_storage;
		$Hash[]	= $premium_resource;
		$Hash[]	= $getGalaxySevenProduct;
		$Hash[]	= $getGalaxySevenCollide;
		$Hash[]	= $premium_collider;
		$Hash[]	= $itemMetal;
		$Hash[]	= $itemCrystal;
		$Hash[]	= $itemDeuterium;
		$Hash[]	= $this->USER['academy_p_b_2_1201'];
		$Hash[]	= $this->USER['academy_p_b_2_1202'];
		$Hash[]	= $this->USER['academy_p_b_2_1204'];
		$Hash[]	= $this->USER['academy_p_b_2_1209'];
		$Hash[]	= $this->USER['academy_p_b_2_1210'];
		$Hash[]	= $this->USER['dm_resource_level'];
		$Hash[]	= $this->USER['dm_energie_level'];
		$Hash[]	= $hashallyprod;
		return md5(implode("::", $Hash));
	}
	
	public function CalcResource($USER = NULL, $PLANET = NULL, $SAVE = false, $TIME = NULL, $HASH = true)
	{			
		$this->isGlobalMode	= !isset($USER, $PLANET) ? true : false;
		$this->USER			= $this->isGlobalMode ? $GLOBALS['USER'] : $USER;
		$this->PLANET		= $this->isGlobalMode ? $GLOBALS['PLANET'] : $PLANET;
		$this->TIME			= is_null($TIME) ? TIMESTAMP : $TIME;
		$this->config		= Config::get($this->USER['universe']);
		
		if($this->USER['urlaubs_modus'] == 1)
			return $this->ReturnVars();
			
		if($this->Build)
		{
			$this->ShipyardQueue();
			$this->DefenseQueue();
			$this->WreckQueue();
			if($this->Tech == true && $this->USER['b_tech'] != 0 && $this->USER['b_tech'] < $this->TIME)
				$this->ResearchQueue();
			if($this->PLANET['b_building'] != 0)
				$this->BuildingQueue();
		}
		
		$this->UpdateResource($this->TIME, $HASH);
			
		//if($SAVE === true)
		$this->SavePlanetToDB($this->USER, $this->PLANET);
			
		return $this->ReturnVars();
	}
	
	public function UpdateResource($TIME, $HASH = false)
	{
		$this->ProductionTime  			= ($TIME - $this->PLANET['last_update']);
		
		if($this->ProductionTime > 0 && $this->PLANET['urlaubs_allowprod'] < TIMESTAMP)
		{
			$this->PLANET['last_update']	= $TIME;
			if($HASH === false) {
				$this->ReBuildCache();
			} else {
				$this->HASH		= $this->CreateHash();

				if($this->PLANET['eco_hash'] !== $this->HASH) {
					$this->PLANET['eco_hash'] = $this->HASH;
					$this->ReBuildCache();
				}
			}
			$this->ExecCalc();
		}
	}
	 
	private function ExecCalc()
	{	

		$MaxMetalStorage		= $this->PLANET['metal_max']     * $this->config->max_overflow;
		$MaxCristalStorage		= $this->PLANET['crystal_max']   * $this->config->max_overflow;
		$MaxDeuteriumStorage	= $this->PLANET['deuterium_max'] * $this->config->max_overflow;
		$MaxDarkmatterStorage	= 999999999999999;
		
		if($this->USER['urlaubs_modus'] == 1)
		return;

		$getGalaxySevePlanet 	= getGalaxySevenPlanet($this->PLANET);
		$getGalaxySevenDm   	= $getGalaxySevePlanet['darkmatterProd'];

		
		$DarkmatterTheoretical	= $this->ProductionTime * (($this->config->darkmatter_basic_income * $this->config->resource_multiplier) + $getGalaxySevenDm + $this->PLANET['darkmatter_perhour']) / 3600;
		if ($DarkmatterTheoretical < 0)
		{
			$this->USER['darkmatter']    = max($this->USER['darkmatter'] + $DarkmatterTheoretical, 0);
		} 
		elseif($this->USER['darkmatter'] <= $MaxDarkmatterStorage) 
		{
			$this->USER['darkmatter']    = min($this->USER['darkmatter'] + $DarkmatterTheoretical, $MaxDarkmatterStorage);
		}
		
		$this->USER['darkmatter']	= max($this->USER['darkmatter'], 0);
		
		if($this->PLANET['planet_type'] == 3)
			return;
		
		$MetalTheoretical		= $this->ProductionTime * (($this->config->metal_basic_income * $this->config->resource_multiplier) + $this->PLANET['metal_perhour']) / 3600;
		
		if($MetalTheoretical < 0)
		{
			$this->PLANET['metal']      = max($this->PLANET['metal'] + $MetalTheoretical, 0);
		} 
		elseif ($this->PLANET['metal'] <= $MaxMetalStorage)
		{
			$this->PLANET['metal']      = min($this->PLANET['metal'] + $MetalTheoretical, $MaxMetalStorage);
		}
		
		$CristalTheoretical	= $this->ProductionTime * (($this->config->crystal_basic_income * $this->config->resource_multiplier) + $this->PLANET['crystal_perhour']) / 3600;
		if ($CristalTheoretical < 0)
		{
			$this->PLANET['crystal']      = max($this->PLANET['crystal'] + $CristalTheoretical, 0);
		} 
		elseif ($this->PLANET['crystal'] <= $MaxCristalStorage ) 
		{
			$this->PLANET['crystal']      = min($this->PLANET['crystal'] + $CristalTheoretical, $MaxCristalStorage);
		}
		
		$DeuteriumTheoretical	= $this->ProductionTime * (($this->config->deuterium_basic_income * $this->config->resource_multiplier) + $this->PLANET['deuterium_perhour']) / 3600;
		if ($DeuteriumTheoretical < 0)
		{
			$this->PLANET['deuterium']    = max($this->PLANET['deuterium'] + $DeuteriumTheoretical, 0);
		} 
		elseif($this->PLANET['deuterium'] <= $MaxDeuteriumStorage) 
		{
			$this->PLANET['deuterium']    = min($this->PLANET['deuterium'] + $DeuteriumTheoretical, $MaxDeuteriumStorage);
		}

		
		$this->PLANET['metal']		= max($this->PLANET['metal'], 0);
		$this->PLANET['crystal']	= max($this->PLANET['crystal'], 0);
		$this->PLANET['deuterium']	= max($this->PLANET['deuterium'], 0);
		
	}
	
	public static function getProd($Calculation)
	{
		return 'return '.$Calculation.';';
	}
	
	public static function getNetworkLevel($USER, $PLANET)
	{
		global $resource;

		$researchLevelList	= array($PLANET[$resource[31]]);
		if($USER[$resource[123]] > 0)
		{
			$sql = 'SELECT '.$resource[31].' FROM %%PLANETS%% WHERE id != :planetId AND id_owner = :userId AND destruyed = 0 ORDER BY '.$resource[31].' DESC LIMIT :limit;';
			$researchResult = Database::get()->select($sql, array(
				':limit'	=> (int) $USER[$resource[123]],
				':planetId'	=> $PLANET['id'],
				':userId'	=> $USER['id']
			));

			foreach($researchResult as $researchRow)
			{
				$researchLevelList[]	= $researchRow[$resource[31]];
			}
		}
		
		return $researchLevelList;
	}
	
	public function ReBuildCache()
	{
		global $ProdGrid, $resource, $reslist, $pricelist;
		
		if ($this->PLANET['planet_type'] == 3)
		{
			$this->config->metal_basic_income     	= 0;
			$this->config->crystal_basic_income   	= 0;
			$this->config->deuterium_basic_income 	= 0;
			$this->config->darkmatter_basic_income 	= 0;
		}
		
		$temp	= array(
			901	=> array(
				'max'	=> 0,
				'plus'	=> 0,
				'minus'	=> 0,
			),
			902	=> array(
				'max'	=> 0,
				'plus'	=> 0,
				'minus'	=> 0,
			),
			903	=> array(
				'max'	=> 0,
				'plus'	=> 0,
				'minus'	=> 0,
			),
			911	=> array(
				'plus'	=> 0,
				'minus'	=> 0,
			),
			921	=> array(
				'plus'	=> 0,
				'minus'	=> 0,
			)
		);
		
		$BuildTemp		= $this->PLANET['temp_max'];
		$BuildEnergy	= $this->USER[$resource[113]];
		
		foreach($reslist['storage'] as $ProdID)
		{
			foreach($reslist['resstype'][1] as $ID) 
			{
				if(!isset($ProdGrid[$ProdID]['storage'][$ID]))
					continue;
				
				$premium_storage = 0;
				if($this->USER['prem_storage'] > 0 && $this->USER['prem_storage_days'] > TIMESTAMP){
				$premium_storage = $this->USER['prem_storage'];
				}			
				
				$academy_p_b_2_1204 = 0;
				if($this->USER['academy_p_b_2_1204'] > 0){
				$academy_p_b_2_1204 = $this->USER['academy_p_b_2_1204'] * 5;
				}
				
				$BuildLevel 		= $this->PLANET[$resource[$ProdID]];
				$temp[$ID]['max']	+= round(eval(self::getProd($ProdGrid[$ProdID]['storage'][$ID])));
			}
		}
		
		$ressIDs	= array_merge(array(), $reslist['resstype'][1], $reslist['resstype'][2]);
		
		foreach($reslist['prod'] as $ProdID)
		{	
			$BuildLevelFactor	= $this->PLANET[$resource[$ProdID].'_porcent'];
			$BuildLevel 		= $this->PLANET[$resource[$ProdID]];
			
			$academy_p_b_2_1209 = 0;
			if($this->USER['academy_p_b_2_1209'] > 0){
			$academy_p_b_2_1209 = $this->USER['academy_p_b_2_1209'] * 3;
			}
			
			$academy_p_b_2_1210 = 0;
			if($this->USER['academy_p_b_2_1210'] > 0){
			$academy_p_b_2_1210 = $this->USER['academy_p_b_2_1210'] * 3;
			}
			
			$db	= Database::get();
			$sql	= 'SELECT * FROM %%PLANETIMG%% WHERE imageId = :imageId;';
			$planetStructureBonuses = $db->selectSingle($sql, array(
			':imageId'	=> $this->PLANET['image']
			));
			
			$planetStrucMetal = $planetStructureBonuses['bonus_metal'];
			$planetStrucCrystal = $planetStructureBonuses['bonus_crystal'];
			$planetStrucDeuterium = $planetStructureBonuses['bonus_deuterium'];
			$planetStrucEnergy = $planetStructureBonuses['bonus_energy'];
			$userPeaceExp = $this->USER['peacefull_exp_level'];
		
			$premium_resource = 0;
			if($this->USER['prem_res'] > 0 && $this->USER['prem_res_days'] > TIMESTAMP){
			$premium_resource = $this->USER['prem_res'];
			}
			
			$gouvernor_resource = 0;
			if($this->USER['dm_resource'] > TIMESTAMP){
			$gouvernor_resource = GubPriceAPSTRACT(704, $this->USER['dm_resource_level'], 'dm_resource');
			}
			
			$gouvernor_energy = 0;
			if($this->USER['dm_energie'] > TIMESTAMP){
			$gouvernor_energy = GubPriceAPSTRACT(705, $this->USER['dm_energie_level'], 'dm_energie');
			}
		
			$premium_collider =  0;
			if($this->USER['prem_prod_from_colly'] > 0 && $this->USER['prem_prod_from_colly_days'] > TIMESTAMP){
			$premium_collider = $this->USER['prem_prod_from_colly'];
			}
		
			$academy_p_b_2_1201 = 0;
			if($this->USER['academy_p_b_2_1201'] > 0){
			$academy_p_b_2_1201 = $this->USER['academy_p_b_2_1201'] * 5;
			}

			$getGalaxySevenAccount = getGalaxySevenAccount($this->USER);
			$getGalaxySevenProduct = $getGalaxySevenAccount['resourceProd'];
			$getGalaxySevenCollide = $getGalaxySevenAccount['colliderProd'];
		
			$academy_p_b_2_1202 = 0;
			if($this->USER['academy_p_b_2_1202'] > 0){
			$academy_p_b_2_1202 = $this->USER['academy_p_b_2_1202'] * 2;
			}
			
			$geologuebon = 2 * $this->USER['rpg_geologue'];
			
			$arsenal_1_eco = $pricelist[814]['arsenal_bonus'] * $this->USER['arsenal_res901_level'];
			$arsenal_2_eco = $pricelist[815]['arsenal_bonus'] * $this->USER['arsenal_res902_level'];
			$arsenal_3_eco = $pricelist[816]['arsenal_bonus'] * $this->USER['arsenal_res903_level'];	
			
			$hashallyprod = 0;
			$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
			$allyInfores = $db->selectSingle($sql, array(
			':allianceId'	=> $this->USER['ally_id']
			));
			if($this->USER['ally_id'] != 0){
			$hashallyprod = $allyInfores['total_alliance_production'];	
			}
			
			foreach($ressIDs as $ID) 
			{
				if(!isset($ProdGrid[$ProdID]['production'][$ID]))
					continue;
				if($ProdID == 212 && $this->PLANET['temp_max'] <= (-179))
					continue;
				
				$Production	= eval(self::getProd($ProdGrid[$ProdID]['production'][$ID]));
				
				if($Production > 0) {					
					$temp[$ID]['plus']	+= $Production;
				} else {
					
					if($ID != 921){
					if(in_array($ID, $reslist['resstype'][1]) && $this->PLANET[$resource[$ID]] == 0) {
						 continue;
					}
					}else{
					if(in_array($ID, $reslist['resstype'][1]) && $this->USER[$resource[$ID]] == 0) {
						 continue;
					}
					}
					
					
					$temp[$ID]['minus']	+= $Production;
				}
			}
		}
						
		$basic_store_metal_2moons			= $temp[901]['max'] * $this->config->resource_multiplier * STORAGE_FACTOR * (1 + $this->USER['factor']['ResourceStorage']);
		$basic_store_crystal_2moons			= $temp[902]['max'] * $this->config->resource_multiplier * STORAGE_FACTOR * (1 + $this->USER['factor']['ResourceStorage']);
		$basic_store_deuterium_2moons		= $temp[903]['max'] * $this->config->resource_multiplier * STORAGE_FACTOR * (1 + $this->USER['factor']['ResourceStorage']);
		
		
		
		$this->PLANET['metal_max']			= $basic_store_metal_2moons;
		$this->PLANET['crystal_max']		= $basic_store_crystal_2moons;
		$this->PLANET['deuterium_max']		= $basic_store_deuterium_2moons;

		$ally_fraction_energy_prod = 0;
		if($this->USER['ally_id'] != 0){
		$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
		$ALLIANCE = Database::get()->selectSingle($sql, array(
		':allyID'	=> $this->USER['ally_id']
		));
		if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
		$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
		$FRACTIONS = Database::get()->selectSingle($sql, array(
		':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
		));
		$ally_fraction_energy_prod = $FRACTIONS['ally_fraction_energy_prod'] * $ALLIANCE['ally_fraction_level'];
		}
		}
			
		$basic_prod_energy_2moons = round($temp[911]['plus'] * $this->config->energySpeed);
		$basic_prod_energy_2moons *= 1 + (0.10 * $this->USER[$resource[113]]);		
		
		$this->PLANET['energy']				= $basic_prod_energy_2moons;
		$this->PLANET['energy_used']		= $temp[911]['minus'] * $this->config->energySpeed;
		//$this->PLANET['energy_used']		= max(0, $this->PLANET['energy_used']);
		if($this->PLANET['energy_used'] == 0) {
			$this->PLANET['metal_perhour']		= 0;
			$this->PLANET['crystal_perhour']	= 0;
			$this->PLANET['deuterium_perhour']	= 0;
			$basic_prod_darkmatter_2moons = ($temp[921]['plus'] * 1 + $temp[921]['minus']) * $this->config->resource_multiplier;

			$this->PLANET['darkmatter_perhour']	= $basic_prod_darkmatter_2moons;
		} else {
			$prodLevel	= min(1, $this->PLANET['energy'] / abs($this->PLANET['energy_used']));
			
			$itemMetal 		= 0;
			$itemCrystal 	= 0;
			$itemDeuterium	= 0;
		
			if($this->PLANET['auction_item_1_timer'] > TIMESTAMP){
			$itemMetal 		= 0.10;
			}elseif($this->PLANET['auction_item_2_timer'] > TIMESTAMP){
			$itemMetal 		= 0.30;
			}elseif($this->PLANET['auction_item_3_timer'] > TIMESTAMP){
			$itemMetal 		= 0.50;
			}
		
			if($this->PLANET['auction_item_4_timer'] > TIMESTAMP){
			$itemCrystal 		= 0.10;
			}elseif($this->PLANET['auction_item_5_timer'] > TIMESTAMP){
			$itemCrystal 		= 0.30;
			}elseif($this->PLANET['auction_item_6_timer'] > TIMESTAMP){
			$itemCrystal 		= 0.50;
			}
		
			if($this->PLANET['auction_item_7_timer'] > TIMESTAMP){
			$itemDeuterium 		= 0.10;
			}elseif($this->PLANET['auction_item_8_timer'] > TIMESTAMP){
			$itemDeuterium 		= 0.30;
			}elseif($this->PLANET['auction_item_9_timer'] > TIMESTAMP){
			$itemDeuterium 		= 0.50;
			}
			
			$ally_fraction_resource_prod = 0;
			if($this->USER['ally_id'] != 0){
			$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
			$ALLIANCE = Database::get()->selectSingle($sql, array(
			':allyID'	=> $this->USER['ally_id']
			));
			if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
			$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
			$FRACTIONS = Database::get()->selectSingle($sql, array(
			':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
			));
			$ally_fraction_resource_prod = $FRACTIONS['ally_fraction_resource_prod'] * $ALLIANCE['ally_fraction_level'];
			}
			}
			
			$basic_prod_metal_2moons = ($temp[901]['plus'] * (1 + 0.05 * $this->USER[$resource[131]]) * $prodLevel + $temp[901]['minus']) * $this->config->resource_multiplier;
			$basic_prod_metal_2moons += (($temp[901]['plus'] * ($itemMetal)) * $this->config->resource_multiplier) + $basic_prod_metal_2moons / 100 * $ally_fraction_resource_prod;
			$basic_prod_crystal_2moons = ($temp[902]['plus'] * (1 + 0.05 * $this->USER[$resource[132]]) * $prodLevel + $temp[902]['minus']) * $this->config->resource_multiplier;
			$basic_prod_crystal_2moons += ($temp[902]['plus'] * ($itemCrystal)) * $this->config->resource_multiplier + $basic_prod_crystal_2moons / 100 * $ally_fraction_resource_prod;
			$basic_prod_deuterium_2moons = ($temp[903]['plus'] * (1 + 0.05 * $this->USER[$resource[133]]) * $prodLevel + $temp[903]['minus']) * $this->config->resource_multiplier;
			$basic_prod_deuterium_2moons += ($temp[903]['plus'] * ($itemDeuterium)) * $this->config->resource_multiplier + $basic_prod_deuterium_2moons / 100 * $ally_fraction_resource_prod;
			$basic_prod_darkmatter_2moons = ($temp[921]['plus'] * $prodLevel + $temp[921]['minus']) * $this->config->resource_multiplier;
			 
			$this->PLANET['metal_perhour']		= $basic_prod_metal_2moons;
			$this->PLANET['crystal_perhour']	= $basic_prod_crystal_2moons;
			$this->PLANET['deuterium_perhour']	= $basic_prod_deuterium_2moons;
			$this->PLANET['darkmatter_perhour']	= $basic_prod_darkmatter_2moons;
		}
	}
	
	private function DefenseQueue()
	{
		global $resource;
		$BuildQueue 	= unserialize($this->PLANET['b_defense_id']);
		if (!$BuildQueue) {
			$this->PLANET['b_defense'] = 0;
			$this->PLANET['b_defense_id'] = '';
			return false;
		}
		
		$this->PLANET['b_defense'] 	+= ($this->TIME - $this->PLANET['last_update']);
		$BuildArray					= array();
		foreach($BuildQueue as $Item)
		{
			if($Item[1] == 0){
				$this->PLANET['b_defense'] = 0;
				$this->PLANET['b_defense_id'] = '';
				return false;
			}
			$AcumTime			= BuildFunctions::getBuildingTime($this->USER, $this->PLANET, $Item[0]);
			$BuildArray[] 		= array($Item[0], $Item[1], $AcumTime);
		}
		$NewQueue	= array();
		$Done		= false;
		foreach($BuildArray as $Item)
		{
			$Element   = $Item[0];
			$Count     = $Item[1];
			if($Done == false) {
				$BuildTime = $Item[2];
				$Element   = (int)$Element;
				if($BuildTime == 0) {			
					if(!isset($this->Builded[$Element]))
						$this->Builded[$Element] = 0;
						
					$this->Builded[$Element]			+= $Count;
					$this->PLANET[$resource[$Element]]	+= $Count;
					continue;					
				}
				
				$Build			= max(min(floor($this->PLANET['b_defense'] / $BuildTime), $Count), 0);
				if($Build == 0) {
					$NewQueue[]	= array($Element, $Count);
					$Done		= true;
					continue;
				}
				
				if(!isset($this->Builded[$Element]))
					$this->Builded[$Element] = 0;
				
				$this->Builded[$Element]			+= $Build;
				$this->PLANET['b_defense']			-= $Build * $BuildTime;
				$this->PLANET[$resource[$Element]]	+= $Build;
				$Count								-= $Build;
				
				if ($Count == 0)
					continue;
				else
					$Done	= true;
			}	
			$NewQueue[]	= array($Element, $Count);
		}
		$this->PLANET['b_defense_id']	= !empty($NewQueue) ? serialize($NewQueue) : '';
		return true;
	}

	private function ShipyardQueue()
	{
		global $resource;
		$BuildQueue 	= unserialize($this->PLANET['b_hangar_id']);
		if (!$BuildQueue) {
			$this->PLANET['b_hangar'] = 0;
			$this->PLANET['b_hangar_id'] = '';
			return false;
		}
		$this->PLANET['b_hangar'] 	+= ($this->TIME - $this->PLANET['last_update']);
		$BuildArray					= array();
		foreach($BuildQueue as $Item)
		{
			if($Item[1] == 0){
				$this->PLANET['b_hangar'] = 0;
				$this->PLANET['b_hangar_id'] = '';
				return false;
			}
			$AcumTime			= BuildFunctions::getBuildingTime($this->USER, $this->PLANET, $Item[0]);
			$BuildArray[] 		= array($Item[0], $Item[1], $AcumTime);
		}
		$NewQueue	= array();
		$Done		= false;
		foreach($BuildArray as $Item)
		{
			$Element   = $Item[0];
			$Count     = $Item[1];
			if($Done == false) {
				$BuildTime = $Item[2];
				$Element   = (int)$Element;
				if($BuildTime == 0) {			
					if(!isset($this->Builded[$Element]))
						$this->Builded[$Element] = 0;
						
					$this->Builded[$Element]			+= $Count;
					$this->PLANET[$resource[$Element]]	+= $Count;
					continue;					
				}
				
				$Build			= max(min(floor($this->PLANET['b_hangar'] / $BuildTime), $Count), 0);
				if($Build == 0) {
					$NewQueue[]	= array($Element, $Count);
					$Done		= true;
					continue;
				}
				
				if(!isset($this->Builded[$Element]))
					$this->Builded[$Element] = 0;
				
				$this->Builded[$Element]			+= $Build;
				$this->PLANET['b_hangar']			-= $Build * $BuildTime;
				$this->PLANET[$resource[$Element]]	+= $Build;
				$Count								-= $Build;
				
				if ($Count == 0)
					continue;
				else
					$Done	= true;
			}	
			$NewQueue[]	= array($Element, $Count);
		}
		$this->PLANET['b_hangar_id']	= !empty($NewQueue) ? serialize($NewQueue) : '';
		return true;
	}	
	
	
	private function WreckQueue()
	{
		global $resource;
		
		$WRECKSSTATUS = 0;
		$sql = "SELECT * FROM %%WRECKS%% WHERE planetID = :planetID AND expiredTime > :expiredTime AND deleted = 0 AND isFinished = 0 ORDER BY startTime ASC LIMIT 1;";
		$WRECKS	= database::get()->selectSingle($sql, array(
			':planetID'		=> $this->PLANET['id'],
			':expiredTime'	=> TIMESTAMP
		));
		
		if(!empty($WRECKS['wreck_array'])){
		
		$allowedProd = 0;
		$StatRebuild = 0;
		$StatCount = 0;
		
		if($WRECKS['inBuild'] == 1){
			$WRECKSSTATUS = 1;
		}
		
		if($WRECKSSTATUS == 1){
			$BuildQueue		= explode(';', $WRECKS['wreck_array']);
			$BuildArray					= array();
			foreach($BuildQueue as $Item)
			{
				$temp = explode(',', $Item);
				$BuildArray[] 		= array($temp[0], $temp[1], $temp[2]);
			}
			
			$NewQueue	= array();
			$Done		= false;
			foreach($BuildArray as $Item)
			{
				$Element   = $Item[0];
				$Rebuild     = $Item[1];
				$Count     = $Item[2];				
				
				if($Rebuild > $Count || $allowedProd == 1)
					$Done = true;
				
				if($Done == false && $allowedProd == 0) {
					
					$StatRebuild += $Item[1];
					$StatCount += $Item[2];
					
					if($StatRebuild < $StatCount)
						//$allowedProd++;
					
					
					$Element   = (int)$Element;	
					$Count	   = $Count;
					
					$BuildTime			= BuildFunctions::getBuildingTime($this->USER, $this->PLANET, $Element);
					$BuildTime			/= 2;
					$Canbuildin = floor((TIMESTAMP - $WRECKS['lastUpdate'])/ $BuildTime);
					
					if($BuildTime*$Item[2] <= 48*3600) 
						$Rebuild   += ($Canbuildin);
					
					if($Rebuild > $Count)
						$Rebuild = $Count;
				}

				$NewQueue[]	= $Element.','.$Rebuild.','.floatToString($Count);
			}
			
			$sql = "UPDATE %%WRECKS%% SET wreck_array = :wreck_array, lastUpdate = :lastUpdate WHERE wreckID = :wreckID;";
			database::get()->update($sql, array(
				':wreck_array'	=> !empty($NewQueue) ? implode(';', $NewQueue) : '',
				':lastUpdate'	=> TIMESTAMP,
				':wreckID'		=> $WRECKS['wreckID']
			));
		}
		
		}
		return true;
	}
	
	private function BuildingQueue() 
	{
		while($this->CheckPlanetBuildingQueue())
			$this->SetNextQueueElementOnTop();
	}
	
	private function CheckPlanetBuildingQueue()
	{
		global $resource, $reslist;
		
		if (empty($this->PLANET['b_building_id']) || $this->PLANET['b_building'] > $this->TIME)
			return false;
		
		$CurrentQueue	= unserialize($this->PLANET['b_building_id']);

		$Element      	= $CurrentQueue[0][0];
		$BuildEndTime 	= $CurrentQueue[0][3];
		$BuildMode    	= $CurrentQueue[0][4];
		
		if(!isset($this->Builded[$Element]))
			$this->Builded[$Element] = 0;
		
		if ($BuildMode == 'build')
		{
			$this->PLANET['field_current']		+= 1;
			$this->PLANET[$resource[$Element]]	+= 1;
			$this->Builded[$Element]			+= 1;
		}
		else
		{
			$this->PLANET['field_current'] 		-= 1;
			$this->PLANET[$resource[$Element]] 	-= 1;
			$this->Builded[$Element]			-= 1;
		}
	

		array_shift($CurrentQueue);
		$OnHash	= in_array($Element, $reslist['prod']);
		$this->UpdateResource($BuildEndTime, !$OnHash);			
			
		if (count($CurrentQueue) == 0) {
			$this->PLANET['b_building']    	= 0;
			$this->PLANET['b_building_id'] 	= '';

			return false;
		} else {
			$this->PLANET['b_building_id'] 	= serialize($CurrentQueue);
			return true;
		}
	}	

	public function SetNextQueueElementOnTop()
	{
		global $resource, $LNG;

		if (empty($this->PLANET['b_building_id'])) {
			$this->PLANET['b_building']    = 0;
			$this->PLANET['b_building_id'] = '';
			return false;
		}

		$CurrentQueue 	= unserialize($this->PLANET['b_building_id']);
		$Loop       	= true;

		$BuildEndTime	= 0;
		$NewQueue		= '';

		while ($Loop === true)
		{
			$ListIDArray		= $CurrentQueue[0];
			$Element			= $ListIDArray[0];
			$Level				= $ListIDArray[1];
			$BuildMode			= $ListIDArray[4];
			$ForDestroy			= ($BuildMode == 'destroy') ? true : false;
			$costResources		= BuildFunctions::getElementPrice($this->USER, $this->PLANET, $Element, $ForDestroy);
			$BuildTime			= BuildFunctions::getBuildingTime($this->USER, $this->PLANET, $Element, $costResources);
			$HaveResources		= BuildFunctions::isElementBuyable($this->USER, $this->PLANET, $Element, $costResources);
			$BuildEndTime		= $this->PLANET['b_building'] + $BuildTime;
			$CurrentQueue[0]	= array($Element, $Level, $BuildTime, $BuildEndTime, $BuildMode);
			$HaveNoMoreLevel	= false;
				
			if($ForDestroy && $this->PLANET[$resource[$Element]] == 0) {
				$HaveResources  = false;
				$HaveNoMoreLevel = true;
			}

			if($HaveResources === true) {
				if(isset($costResources[901])) { $this->PLANET[$resource[901]]	-= $costResources[901]; }
				if(isset($costResources[902])) { $this->PLANET[$resource[902]]	-= $costResources[902]; }
				if(isset($costResources[903])) { $this->PLANET[$resource[903]]	-= $costResources[903]; }
				if(isset($costResources[921])) { $this->USER[$resource[921]]	-= $costResources[921]; }
				if(isset($costResources[922])) { $this->USER[$resource[922]]	-= $costResources[922]; }
				$NewQueue               	= serialize($CurrentQueue);
				$Loop                  		= false;
			} else {
				if($this->USER['hof'] == 1){
					if ($HaveNoMoreLevel) {
						$Message     = sprintf($LNG['sys_nomore_level'], $LNG['tech'][$Element]);
					} else {
						if(!isset($costResources[901])) { $costResources[901] = 0; }
						if(!isset($costResources[902])) { $costResources[902] = 0; }
						if(!isset($costResources[903])) { $costResources[903] = 0; }
						
						$Message     = sprintf($LNG['sys_notenough_money'], $this->PLANET['name'], $this->PLANET['id'], $this->PLANET['galaxy'], $this->PLANET['system'], $this->PLANET['planet'], $LNG['tech'][$Element], pretty_number ($this->PLANET['metal']), $LNG['tech'][901], pretty_number($this->PLANET['crystal']), $LNG['tech'][902], pretty_number ($this->PLANET['deuterium']), $LNG['tech'][903], pretty_number($costResources[901]), $LNG['tech'][901], pretty_number ($costResources[902]), $LNG['tech'][902], pretty_number ($costResources[903]), $LNG['tech'][903]);
					}

					PlayerUtil::sendMessage($this->USER['id'], 0,$LNG['sys_buildlist'], 99,
						$LNG['sys_buildlist_fail'], $Message, $this->TIME);
				}

				array_shift($CurrentQueue);
					
				if (count($CurrentQueue) == 0) {
					$BuildEndTime  = 0;
					$NewQueue      = '';
					$Loop          = false;
				} else {
					$BaseTime			= $BuildEndTime - $BuildTime;
					$NewQueue			= array();
					foreach($CurrentQueue as $ListIDArray)
					{
						$ListIDArray[2]		= BuildFunctions::getBuildingTime($this->USER, $this->PLANET, $ListIDArray[0], NULL, $ListIDArray[4] == 'destroy');
						$BaseTime			+= $ListIDArray[2];
						$ListIDArray[3]		= $BaseTime;
						$NewQueue[]			= $ListIDArray;
					}
					$CurrentQueue	= $NewQueue;
				}
			}
		}
			
		$this->PLANET['b_building']    = $BuildEndTime;
		$this->PLANET['b_building_id'] = $NewQueue;

		return true;
	}
		
	private function ResearchQueue()
	{
		while($this->CheckUserTechQueue())
			$this->SetNextQueueTechOnTop();
	}
	
	private function CheckUserTechQueue()
	{
		global $resource;
		
		if (empty($this->USER['b_tech_id']) || $this->USER['b_tech'] > $this->TIME)
			return false;
		
		if(!isset($this->Builded[$this->USER['b_tech_id']]))
			$this->Builded[$this->USER['b_tech_id']]	= 0;
			
		$this->Builded[$this->USER['b_tech_id']]			+= 1;
		$this->USER[$resource[$this->USER['b_tech_id']]]	+= 1;
	

		$CurrentQueue	= unserialize($this->USER['b_tech_queue']);
		array_shift($CurrentQueue);		
			
		$this->USER['b_tech_id']		= 0;
		if (count($CurrentQueue) == 0) {
			$this->USER['b_tech'] 			= 0;
			$this->USER['b_tech_id']		= 0;
			$this->USER['b_tech_planet']	= 0;
			$this->USER['b_tech_queue']		= '';
			return false;
		} else {
			$this->USER['b_tech_queue'] 	= serialize(array_values($CurrentQueue));
			return true;
		}
	}	
	
	public function SetNextQueueTechOnTop()
	{
		global $resource, $LNG;

		if (empty($this->USER['b_tech_queue'])) {
			$this->USER['b_tech'] 			= 0;
			$this->USER['b_tech_id']		= 0;
			$this->USER['b_tech_planet']	= 0;
			$this->USER['b_tech_queue']		= '';
			return false;
		}

		$CurrentQueue 	= unserialize($this->USER['b_tech_queue']);
		$Loop       	= true;
		while ($Loop == true)
		{
			$ListIDArray        = $CurrentQueue[0];
			$isAnotherPlanet	= $ListIDArray[4] != $this->PLANET['id'];
			if($isAnotherPlanet)
			{
				$sql	= 'SELECT * FROM %%PLANETS%% WHERE id = :planetId;';
				$PLANET	= Database::get()->selectSingle($sql, array(
					':planetId'	=> $ListIDArray[4],
				));

				$RPLANET 		= new ResourceUpdate(true, false);
				list(, $PLANET)	= $RPLANET->CalcResource($this->USER, $PLANET, false, $this->USER['b_tech']);
			}
			else
			{
				$PLANET	= $this->PLANET;
			}

			$PLANET[$resource[31].'_inter']	= self::getNetworkLevel($this->USER, $PLANET);
			
			$Element            = $ListIDArray[0];
			$Level              = $ListIDArray[1];
			$costResources		= BuildFunctions::getElementPrice($this->USER, $PLANET, $Element);
			$BuildTime			= BuildFunctions::getBuildingTime($this->USER, $PLANET, $Element, $costResources);
			$HaveResources		= BuildFunctions::isElementBuyable($this->USER, $PLANET, $Element, $costResources);
			$BuildEndTime       = $this->USER['b_tech'] + $BuildTime;
			$CurrentQueue[0]	= array($Element, $Level, $BuildTime, $BuildEndTime, $PLANET['id']);
			
			if($HaveResources == true) {
				if(isset($costResources[901])) { $PLANET[$resource[901]]		-= $costResources[901]; }
				if(isset($costResources[902])) { $PLANET[$resource[902]]		-= $costResources[902]; }
				if(isset($costResources[903])) { $PLANET[$resource[903]]		-= $costResources[903]; }
				if(isset($costResources[921])) { $this->USER[$resource[921]]	-= $costResources[921]; }
				if(isset($costResources[922])) { $this->USER[$resource[922]]	-= $costResources[922]; }
				$this->USER['b_tech_id']		= $Element;
				$this->USER['b_tech']      		= $BuildEndTime;
				$this->USER['b_tech_planet']	= $PLANET['id'];
				$this->USER['b_tech_queue'] 	= serialize($CurrentQueue);

				$Loop                  			= false;
			} else {
				if($this->USER['hof'] == 1){
					if(!isset($costResources[901])) { $costResources[901] = 0; }
					if(!isset($costResources[902])) { $costResources[902] = 0; }
					if(!isset($costResources[903])) { $costResources[903] = 0; }
					
					$Message     = sprintf($LNG['sys_notenough_money'], $PLANET['name'], $PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $LNG['tech'][$Element], pretty_number ($PLANET['metal']), $LNG['tech'][901], pretty_number($PLANET['crystal']), $LNG['tech'][902], pretty_number ($PLANET['deuterium']), $LNG['tech'][903], pretty_number($costResources[901]), $LNG['tech'][901], pretty_number ($costResources[902]), $LNG['tech'][902], pretty_number ($costResources[903]), $LNG['tech'][903]);
					
					PlayerUtil::sendMessage($this->USER['id'], 0,$LNG['sys_techlist'], 99, $LNG['sys_buildlist_fail'], $Message, $this->TIME);
				}

				array_shift($CurrentQueue);
					
				if (count($CurrentQueue) == 0) {
					$this->USER['b_tech'] 			= 0;
					$this->USER['b_tech_id']		= 0;
					$this->USER['b_tech_planet']	= 0;
					$this->USER['b_tech_queue']		= '';
					
					$Loop                  			= false;
				} else {
					$BaseTime						= $BuildEndTime - $BuildTime;
					$NewQueue						= array();
					foreach($CurrentQueue as $ListIDArray)
					{
						$ListIDArray[2]				= BuildFunctions::getBuildingTime($this->USER, $PLANET, $ListIDArray[0]);
						$BaseTime					+= $ListIDArray[2];
						$ListIDArray[3]				= $BaseTime;
						$NewQueue[]					= $ListIDArray;
					}
					$CurrentQueue					= $NewQueue;
				}
			}
				
			if($isAnotherPlanet)
			{
				$RPLANET->SavePlanetToDB($this->USER, $PLANET);
				$RPLANET		= NULL;
				unset($RPLANET);
			}
			else
			{
				$this->PLANET	= $PLANET;
			}
		}

		return true;
	}
	
	public function SavePlanetToDB($USER = NULL, $PLANET = NULL)
	{
		global $resource, $reslist;
		
		if(is_null($USER))
			global $USER;
			
		if(is_null($PLANET))
			global $PLANET;

		$buildQueries	= array();

		$params	= array(
			':userId'				=> $USER['id'],
			':planetId'				=> $PLANET['id'],
			':metal'				=> max(0,$PLANET['metal']),
			':crystal'				=> max(0,$PLANET['crystal']),
			':deuterium'			=> max(0,$PLANET['deuterium']),
			':ecoHash'				=> $PLANET['eco_hash'],
			':lastUpdateTime'		=> $PLANET['last_update'],
			':b_building'			=> $PLANET['b_building'],
			':b_building_id' 		=> $PLANET['b_building_id'],
			':field_current' 		=> $PLANET['field_current'],
			':b_hangar_id'			=> $PLANET['b_hangar_id'],
			':b_defense_id'			=> $PLANET['b_defense_id'],
			':metal_perhour'		=> $PLANET['metal_perhour'],
			':crystal_perhour'		=> $PLANET['crystal_perhour'],
			':deuterium_perhour'	=> $PLANET['deuterium_perhour'],
			':metal_max'			=> $PLANET['metal_max'],
			':crystal_max'			=> $PLANET['crystal_max'],
			':deuterium_max'		=> $PLANET['deuterium_max'],
			':energy_used'			=> $PLANET['energy_used'],
			':energy'				=> $PLANET['energy'],
			':b_hangar'				=> $PLANET['b_hangar'],
			':b_defense'			=> $PLANET['b_defense'],
			':darkmatter'			=> $USER['darkmatter'],
			':darkmatter_perhour'	=> $PLANET['darkmatter_perhour'],
			':antimatter'			=> $USER['antimatter'],
			':b_tech'				=> $USER['b_tech'],
			':b_tech_id'			=> $USER['b_tech_id'],
			':b_tech_planet'		=> $USER['b_tech_planet'],
			':b_tech_queue'			=> $USER['b_tech_queue']
		);

		if (!empty($this->Builded))
		{
			foreach($this->Builded as $Element => $Count)
			{
				$Element	= (int) $Element;
				
				if(empty($resource[$Element]) || empty($Count)) {
					continue;
				}
				
				if(in_array($Element, $reslist['one']))
				{
					$buildQueries[]						= ', p.'.$resource[$Element].' = :'.$resource[$Element];
					$params[':'.$resource[$Element]]	= '1';
				}
				elseif(isset($PLANET[$resource[$Element]]))
				{
					$buildQueries[]						= ', p.'.$resource[$Element].' = p.'.$resource[$Element].' + :'.$resource[$Element];
					$params[':'.$resource[$Element]]	= floattostring($Count);
				}
				elseif(isset($USER[$resource[$Element]]))
				{
					$buildQueries[]						= ', u.'.$resource[$Element].' = u.'.$resource[$Element].' + :'.$resource[$Element];
					$params[':'.$resource[$Element]]	= floattostring($Count);
				}
			}
		}

		$sql = 'UPDATE %%PLANETS%% as p,%%USERS%% as u SET
		p.metal				= :metal,
		p.crystal			= :crystal,
		p.deuterium			= :deuterium,
		p.eco_hash			= :ecoHash,
		p.last_update		= :lastUpdateTime,
		p.b_building		= :b_building,
		p.b_building_id 	= :b_building_id,
		p.field_current 	= :field_current,
		p.b_hangar_id		= :b_hangar_id,
		p.b_defense_id		= :b_defense_id,
		p.metal_perhour		= :metal_perhour,
		p.crystal_perhour	= :crystal_perhour,
		p.deuterium_perhour	= :deuterium_perhour,
		p.metal_max			= :metal_max,
		p.crystal_max		= :crystal_max,
		p.deuterium_max		= :deuterium_max,
		p.energy_used		= :energy_used,
		p.energy			= :energy,
		p.b_hangar			= :b_hangar,
		p.b_defense			= :b_defense,
		u.darkmatter		= :darkmatter,
		p.darkmatter_perhour		= :darkmatter_perhour,
		u.antimatter		= :antimatter,
		u.b_tech			= :b_tech,
		u.b_tech_id			= :b_tech_id,
		u.b_tech_planet		= :b_tech_planet,
		u.b_tech_queue		= :b_tech_queue
		'.implode("\n", $buildQueries).'
		WHERE p.id = :planetId AND u.id = :userId;';

		Database::get()->update($sql, $params);

		$this->Builded	= array();

		return array($USER, $PLANET);
	}
}