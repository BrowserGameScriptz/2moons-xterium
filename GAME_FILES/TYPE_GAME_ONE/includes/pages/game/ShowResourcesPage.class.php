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

class ShowResourcesPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
	}
	
	function AllPlanets()
	{
		global $resource, $USER, $PLANET, $LNG;
		$db = Database::get();
		$action = HTTP::_GP('action','');
		$account_before = array(
			'metal'							=> $PLANET['metal'],
			'crystal'						=> $PLANET['crystal'],
			'deuterium'						=> $PLANET['deuterium'],
			'metal_mine_porcent'			=> $PLANET['metal_mine_porcent'],
			'crystal_mine_porcent'			=> $PLANET['crystal_mine_porcent'],
			'deuterium_sintetizer_porcent'	=> $PLANET['deuterium_sintetizer_porcent'],
			'solar_plant_porcent'			=> $PLANET['solar_plant_porcent'],
			'fusion_plant_porcent'			=> $PLANET['fusion_plant_porcent'],
			'solar_satelit_porcent'			=> $PLANET['solar_satelit_porcent'],
		);
			
		if ($action == 'on'){
			$sql = "UPDATE %%PLANETS%% SET
							metal_mine_porcent = '11',
							crystal_mine_porcent = '11',
							deuterium_sintetizer_porcent = '11',
							solar_plant_porcent = '11',
							fusion_plant_porcent = '11',
							solar_satelit_porcent = '11',
							last_update 		= :last_update
							WHERE id_owner = :userID;";
			$db->update($sql, array(
							':last_update'	=> TIMESTAMP,
							':userID'		=> $USER['id']
			));	
			$PLANET['last_update']	= TIMESTAMP;
			$this->ecoObj->setData($USER, $PLANET);
			$this->ecoObj->ReBuildCache();
			list($USER, $PLANET)	= $this->ecoObj->getData();
			$PLANET['eco_hash'] = $this->ecoObj->CreateHash();
			$this->save();
			
			$sql	= 'SELECT * FROM %%PLANETS%% WHERE id = :planetId;';
			$getPlanet = Database::get()->selectSingle($sql, array(
				':planetId'		=> $PLANET['id'],
			));
			
			$account_after = array(
				'metal'							=> $getPlanet['metal'],
				'crystal'						=> $getPlanet['crystal'],
				'deuterium'						=> $getPlanet['deuterium'],
				'metal_mine_porcent'			=> $getPlanet['metal_mine_porcent'],
				'crystal_mine_porcent'			=> $getPlanet['crystal_mine_porcent'],
				'deuterium_sintetizer_porcent'	=> $getPlanet['deuterium_sintetizer_porcent'],
				'solar_plant_porcent'			=> $getPlanet['solar_plant_porcent'],
				'fusion_plant_porcent'			=> $getPlanet['fusion_plant_porcent'],
				'solar_satelit_porcent'			=> $getPlanet['solar_satelit_porcent'],
			);
			
			$LOG = new Logcheck(8);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=resources [Enable all]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
			
			$this->printMessage($LNG['res_cl_activate'], true, array('game.php?page=resources', 2));
		}elseif ($action == 'off'){
			$sql = "UPDATE %%PLANETS%% SET
							metal_mine_porcent = '0',
							crystal_mine_porcent = '0',
							deuterium_sintetizer_porcent = '0',
							solar_plant_porcent = '0',
							fusion_plant_porcent = '0',
							solar_satelit_porcent = '0'
							WHERE id_owner = :userID;";
			$db->update($sql, array(
							':userID'	=> $USER['id']
			));
			$this->ecoObj->setData($USER, $PLANET);
			$this->ecoObj->ReBuildCache();
			list($USER, $PLANET)	= $this->ecoObj->getData();
			$PLANET['eco_hash'] = $this->ecoObj->CreateHash();
			$this->save();
			
			$sql	= 'SELECT * FROM %%PLANETS%% WHERE id = :planetId;';
			$getPlanet = Database::get()->selectSingle($sql, array(
				':planetId'		=> $PLANET['id'],
			));
			
			$account_after = array(
				'metal'							=> $getPlanet['metal'],
				'crystal'						=> $getPlanet['crystal'],
				'deuterium'						=> $getPlanet['deuterium'],
				'metal_mine_porcent'			=> $getPlanet['metal_mine_porcent'],
				'crystal_mine_porcent'			=> $getPlanet['crystal_mine_porcent'],
				'deuterium_sintetizer_porcent'	=> $getPlanet['deuterium_sintetizer_porcent'],
				'solar_plant_porcent'			=> $getPlanet['solar_plant_porcent'],
				'fusion_plant_porcent'			=> $getPlanet['fusion_plant_porcent'],
				'solar_satelit_porcent'			=> $getPlanet['solar_satelit_porcent'],
			);
			
			$LOG = new Logcheck(8);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=resources [Disable all]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
			$this->printMessage($LNG['res_cl_dactivate'], true, array('game.php?page=resources', 2));
		}
		
	}
	
	
	function send()
	{
		global $resource, $USER, $PLANET;
		if ($USER['urlaubs_modus'] == 0)
		{
			$updateSQL	= array();
			if(!isset($_POST['prod']))
				$_POST['prod'] = array();


			$param	= array(':planetId' => $PLANET['id']);
			
			foreach($_POST['prod'] as $resourceId => $Value)
			{
				$FieldName = $resource[$resourceId].'_porcent';
				if (!isset($PLANET[$FieldName]) || !in_array($Value, range(0, 10)))
					continue;
				
				$updateSQL[]	= $FieldName." = :".$FieldName;
				$param[':'.$FieldName]		= (int) $Value;
				$PLANET[$FieldName]			= $Value;
			}

			if(!empty($updateSQL))
			{
				$sql	= 'UPDATE %%PLANETS%% SET '.implode(', ', $updateSQL).' WHERE id = :planetId;';

				Database::get()->update($sql, $param);
				$PLANET['last_update']	= TIMESTAMP;
				$this->ecoObj->setData($USER, $PLANET);
				$this->ecoObj->ReBuildCache();
				list($USER, $PLANET)	= $this->ecoObj->getData();
				$PLANET['eco_hash'] = $this->ecoObj->CreateHash();
			}
		}

		$this->save();
		$this->redirectTo('game.php?page=resources');
	}
	function show()
	{
		global $LNG, $ProdGrid, $resource, $reslist, $USER, $PLANET, $pricelist;

		$config	= Config::get();

		if($USER['urlaubs_modus'] == 1 || $PLANET['planet_type'] != 1)
		{
			$basicIncome[901]	= 0;
			$basicIncome[902]	= 0;
			$basicIncome[903]	= 0;
			$basicIncome[911]	= 0;
			$basicIncome[921]	= $config->{$resource[921].'_basic_income'};
		}
		else
		{		
			$basicIncome[901]	= $config->{$resource[901].'_basic_income'};
			$basicIncome[902]	= $config->{$resource[902].'_basic_income'};
			$basicIncome[903]	= $config->{$resource[903].'_basic_income'};
			$basicIncome[911]	= $config->{$resource[911].'_basic_income'};
			$basicIncome[921]	= 0;
		}
		
		$temp	= array(
			901	=> array(
				'plus'	=> 0,
				'minus'	=> 0,
			),
			902	=> array(
				'plus'	=> 0,
				'minus'	=> 0,
			),
			903	=> array(
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
		
		$ressIDs		= array_merge(array(), $reslist['resstype'][1], $reslist['resstype'][2]);

		$productionList	= array();

		if($PLANET['energy_used'] != 0) {
			$prodLevel	= min(1, $PLANET['energy'] / abs($PLANET['energy_used']));
		} else {
			$prodLevel	= 0;
		}

		/* Data for eval */
		$BuildEnergy		= $USER[$resource[113]];
		$BuildTemp          = $PLANET['temp_max'];
		
		$showProd = array(1,2,3,4,12,212);
		foreach($showProd as $ProdID)
		{
			

			if(isset($USER[$resource[$ProdID]]) && $USER[$resource[$ProdID]] == 0)
				continue;

			$productionList[$ProdID]	= array(
				'production'	=> array(901 => 0, 902 => 0, 903 => 0, 911 => 0),
				'elementLevel'	=> $PLANET[$resource[$ProdID]],
				'prodLevel'		=> $PLANET[$resource[$ProdID].'_porcent'],
			);

			/* Data for eval */
			$BuildLevel			= $PLANET[$resource[$ProdID]];
			$BuildLevelFactor	= $PLANET[$resource[$ProdID].'_porcent'];
			$produceEnergy		= 1;
			foreach($ressIDs as $ID) 
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
				
				$gouvernor_resource = 0;
				if($USER['dm_resource'] > TIMESTAMP){
				$gouvernor_resource = GubPriceAPSTRACT(704, $USER['dm_resource_level'], 'dm_resource');
				}
			
				$gouvernor_energy = 0;
				if($USER['dm_energie'] > TIMESTAMP){
				$gouvernor_energy = GubPriceAPSTRACT(705, $USER['dm_energie_level'], 'dm_energie');
				}
		
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
				
				$hashallyprod = 0;
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
				$allyInfores = $db->selectSingle($sql, array(
				':allianceId'	=> $USER['ally_id']
				));
				if($USER['ally_id'] != 0){
				$hashallyprod = $allyInfores['total_alliance_production'];	
				}
		
				$academy_p_b_2_1202 = 0;
				if($USER['academy_p_b_2_1202'] > 0){
				$academy_p_b_2_1202 = $USER['academy_p_b_2_1202'] * 2;
				}
				
				$geologuebon = 2 * $USER['rpg_geologue'];
				$engineerbon = 5 * $USER['rpg_ingenieur'];
				
				$arsenal_1_eco = $pricelist[814]['arsenal_bonus'] * $USER['arsenal_res901_level'];
				$arsenal_2_eco = $pricelist[815]['arsenal_bonus'] * $USER['arsenal_res902_level'];
				$arsenal_3_eco = $pricelist[816]['arsenal_bonus'] * $USER['arsenal_res903_level'];	
				
				if(!isset($ProdGrid[$ProdID]['production'][$ID]))
					continue;

				$Production	= eval(ResourceUpdate::getProd($ProdGrid[$ProdID]['production'][$ID]));
				
				if($ProdID == 212 && $PLANET['temp_max'] <= (-179)){
					$Production	= 0;
					$produceEnergy		= 0;
				}
				
				if(in_array($ID, $reslist['resstype'][2]))
				{
					$Production	*= $config->energySpeed;
					//$Production	*= 1 + (0.10 * $USER[$resource[113]]);
				}
				else
				{
					$Production	*= $prodLevel * $config->resource_multiplier;
				}
				
				$productionList[$ProdID]['production'][$ID]	= $Production;
				
				if($Production > 0) {
					if($PLANET[$resource[$ID]] == 0) continue;
					
					$temp[$ID]['plus']	+= $Production;
				} else {
					$temp[$ID]['minus']	+= $Production;
				}
			}
			
		}

		$storage	= array(
			901 => shortly_number($PLANET[$resource[901].'_max']),
			902 => shortly_number($PLANET[$resource[902].'_max']),
			903 => shortly_number($PLANET[$resource[903].'_max']),
		);
		
		$basicProduction	= array(
			901 => $basicIncome[901] * $config->resource_multiplier,
			902 => $basicIncome[902] * $config->resource_multiplier,
			903	=> $basicIncome[903] * $config->resource_multiplier,
			911	=> $basicIncome[911] * $config->energySpeed,
		);
		
		$totalProduction	= array(
			901 => $PLANET[$resource[901].'_perhour'] + $basicProduction[901],
			902 => $PLANET[$resource[902].'_perhour'] + $basicProduction[902],
			903	=> $PLANET[$resource[903].'_perhour'] + $basicProduction[903],
			911	=> $PLANET[$resource[911]] + $PLANET['energy_used'],
		);
		$bonusProduction	= array(
			901 => $temp[901]['plus'] * (0.05 * $USER[$resource[131]]),
			902 => $temp[902]['plus'] * (0.05 * $USER[$resource[132]]),
			903	=> $temp[903]['plus'] * (0.05 * $USER[$resource[133]]),
			911	=> 0,
		);
		
		$itemMetal 		= 0;
		$itemCrystal 	= 0;
		$itemDeuterium	= 0;
		
		$ItemTiMe = $PLANET['auction_item_1_timer'];
		if($PLANET['auction_item_2_timer'] > TIMESTAMP){
		$ItemTiMe = $PLANET['auction_item_2_timer'];	
		}elseif($PLANET['auction_item_3_timer'] > TIMESTAMP){
		$ItemTiMe = $PLANET['auction_item_3_timer'];	
		}
		
		$ItemTiCr = $PLANET['auction_item_4_timer'];
		if($PLANET['auction_item_5_timer'] > TIMESTAMP){
		$ItemTiCr = $PLANET['auction_item_5_timer'];	
		}elseif($PLANET['auction_item_6_timer'] > TIMESTAMP){
		$ItemTiCr = $PLANET['auction_item_6_timer'];	
		}
		
		$ItemTiDe = $PLANET['auction_item_7_timer'];
		if($PLANET['auction_item_8_timer'] > TIMESTAMP){
		$ItemTiDe = $PLANET['auction_item_8_timer'];	
		}elseif($PLANET['auction_item_9_timer'] > TIMESTAMP){
		$ItemTiDe = $PLANET['auction_item_9_timer'];	
		}
		
		if($PLANET['auction_item_1_timer'] > TIMESTAMP){
			$itemMetal 		= 0.10;
		}elseif($PLANET['auction_item_2_timer'] > TIMESTAMP){
			$itemMetal 		= 0.30;
		}elseif($PLANET['auction_item_3_timer'] > TIMESTAMP){
			$itemMetal 		= 0.50;
		}
		
		if($PLANET['auction_item_4_timer'] > TIMESTAMP){
			$itemCrystal 		= 0.10;
		}elseif($PLANET['auction_item_5_timer'] > TIMESTAMP){
			$itemCrystal 		= 0.30;
		}elseif($PLANET['auction_item_6_timer'] > TIMESTAMP){
			$itemCrystal 		= 0.50;
		}
		
		if($PLANET['auction_item_7_timer'] > TIMESTAMP){
			$itemDeuterium 		= 0.10;
		}elseif($PLANET['auction_item_8_timer'] > TIMESTAMP){
			$itemDeuterium 		= 0.30;
		}elseif($PLANET['auction_item_9_timer'] > TIMESTAMP){
			$itemDeuterium 		= 0.50;
		}
		
		$itemProduction	= array(
			901 => $temp[901]['plus'] * $itemMetal,
			902 => $temp[902]['plus'] * $itemCrystal,
			903	=> $temp[903]['plus'] * $itemDeuterium,
			911	=> $temp[911]['plus'] * 0,
		);
		
		$dailyProduction	= array(
			901 => $totalProduction[901] * 24,
			902 => $totalProduction[902] * 24,
			903	=> $totalProduction[903] * 24,
			911	=> $totalProduction[911],
		);
		
		$weeklyProduction	= array(
			901 => $totalProduction[901] * 168,
			902 => $totalProduction[902] * 168,
			903	=> $totalProduction[903] * 168,
			911	=> $totalProduction[911],
		);
			
		$prodSelector	= array();
		
		foreach(range(10, 0) as $percent) {
			$prodSelector[$percent]	= ($percent * 10).'%';
		}
		
		$BuildLevel			= $PLANET[$resource[1]];
		$BuildLevelFactor	= $PLANET[$resource[1].'_porcent'];
		$METALDEFAULT = (30*25 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) * $config->resource_multiplier;
		$METALDSTRUCT = ((30*25 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $planetStrucMetal) * $config->resource_multiplier;
		$METALPREMIUM = ((30*25 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $premium_resource) * $config->resource_multiplier;
		$METALPEACEXP = ((30*25 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $userPeaceExp) * $config->resource_multiplier; 
		$METALCADAEMY = ((30*25 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $academy_p_b_2_1201) * $config->resource_multiplier; 
		$METALGOUVERN = ((30*25 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $gouvernor_resource) * $config->resource_multiplier; 
		$METALARSENAL = ((30*25 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $arsenal_1_eco) * $config->resource_multiplier; 
		$METALOFFICER = ((30*25 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $geologuebon) * $config->resource_multiplier; 
		$METALALLIANC = ((30*25 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $hashallyprod) * $config->resource_multiplier; 
		$METALGALA7   = ((30*25 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $getGalaxySevenProduct) * $config->resource_multiplier; 
		
		$BuildLevelC			= $PLANET[$resource[2]];
		$BuildLevelCFactor	= $PLANET[$resource[2].'_porcent'];
		$CRYSADEFAULT = (20*25 * $BuildLevelC * pow((1.1), $BuildLevelC)) * (0.1 * $BuildLevelCFactor) * $config->resource_multiplier;
		$CRYSADSTRUCT = ((20*25 * $BuildLevelC * pow((1.1), $BuildLevelC)) * (0.1 * $BuildLevelCFactor) / 100 * $planetStrucCrystal) * $config->resource_multiplier;
		$CRYSAPREMIUM = ((20*25 * $BuildLevelC * pow((1.1), $BuildLevelC)) * (0.1 * $BuildLevelCFactor) / 100 * $premium_resource) * $config->resource_multiplier;
		$CRYSAPEACEXP = ((20*25 * $BuildLevelC * pow((1.1), $BuildLevelC)) * (0.1 * $BuildLevelCFactor) / 100 * $userPeaceExp) * $config->resource_multiplier; 
		$CRYSACADAEMY = ((20*25 * $BuildLevelC * pow((1.1), $BuildLevelC)) * (0.1 * $BuildLevelCFactor) / 100 * $academy_p_b_2_120*251) * $config->resource_multiplier; 
		$CRYSAGOUVERN = ((20*25 * $BuildLevelC * pow((1.1), $BuildLevelC)) * (0.1 * $BuildLevelCFactor) / 100 * $gouvernor_resource) * $config->resource_multiplier; 
		$CRYSAARSENAL = ((20*25 * $BuildLevelC * pow((1.1), $BuildLevelC)) * (0.1 * $BuildLevelCFactor) / 100 * $arsenal_2_eco) * $config->resource_multiplier; 
		$CRYSAOFFICER = ((20*25 * $BuildLevelC * pow((1.1), $BuildLevelC)) * (0.1 * $BuildLevelCFactor) / 100 * $geologuebon) * $config->resource_multiplier; 
		$CRYSAALLIANC = ((20*25 * $BuildLevelC * pow((1.1), $BuildLevelC)) * (0.1 * $BuildLevelCFactor) / 100 * $hashallyprod) * $config->resource_multiplier; 
		$CRYSAGAL7    = ((20*25 * $BuildLevelC * pow((1.1), $BuildLevelC)) * (0.1 * $BuildLevelCFactor) / 100 * $getGalaxySevenProduct) * $config->resource_multiplier; 
		
		$BuildLevelD			= $PLANET[$resource[3]];
		$BuildLevelDFactor	= $PLANET[$resource[3].'_porcent'];
		$BuildTemp          = $PLANET['temp_max'];
		$DEUTDDEFAULT = (10*25 * $BuildLevelD * pow((1.1), $BuildLevelD) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelDFactor)) * $config->resource_multiplier;
		$DEUTDDSTRUCT = ((10*25 * $BuildLevelD * pow((1.1), $BuildLevelD) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelDFactor)) / 100 * $planetStrucDeuterium) * $config->resource_multiplier;
		$DEUTDPREMIUM = ((10*25 * $BuildLevelD * pow((1.1), $BuildLevelD) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelDFactor)) / 100 * $premium_resource) * $config->resource_multiplier;
		$DEUTDPEACEXP = ((10*25 * $BuildLevelD * pow((1.1), $BuildLevelD) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelDFactor)) / 100 * $userPeaceExp) * $config->resource_multiplier; 
		$DEUTDCADAEMY = ((10*25 * $BuildLevelD * pow((1.1), $BuildLevelD) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelDFactor)) / 100 * $academy_p_b_2_1201) * $config->resource_multiplier; 
		$DEUTDGOUVERN = ((10*25 * $BuildLevelD * pow((1.1), $BuildLevelD) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelDFactor)) / 100 * $gouvernor_resource) * $config->resource_multiplier; 
		$DEUTDARSENAL = ((10*25 * $BuildLevelD * pow((1.1), $BuildLevelD) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelDFactor)) / 100 * $arsenal_3_eco) * $config->resource_multiplier; 
		$DEUTDOFFICER = ((10*25 * $BuildLevelD * pow((1.1), $BuildLevelD) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelDFactor)) / 100 * $geologuebon) * $config->resource_multiplier; 
		$DEUTDALLIANC = ((10*25 * $BuildLevelD * pow((1.1), $BuildLevelD) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelDFactor)) / 100 * $hashallyprod) * $config->resource_multiplier; 
		$DEUTDGAL7    = ((10*25 * $BuildLevelD * pow((1.1), $BuildLevelD) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelDFactor)) / 100 * $getGalaxySevenProduct) * $config->resource_multiplier; 
	
		$BuildLevelE			= $PLANET[$resource[4]];
		$BuildLevelDFactor	= $PLANET[$resource[4].'_porcent'];
		$BuildTemp          = $PLANET['temp_max'];
		$ENERDDEFAULT = (20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) * $config->energySpeed;
		$ENERDDSTRUCT = $ENERDDEFAULT / 100 * $planetStrucEnergy;
		$ENERDPREMIUM = $ENERDDEFAULT / 100 * $premium_resource;
		$ENERDPEACEXP = $ENERDDEFAULT / 100 * $userPeaceExp; 
		$ENERDCADAEMY = $ENERDDEFAULT / 100 * $academy_p_b_2_1202; 
		$ENERDGOUVERN = $ENERDDEFAULT / 100 * $gouvernor_resource; 
		$ENERDARSENAL = 0; 
		$ENERDOFFICER = $ENERDDEFAULT / 100 * $engineerbon; 
		$ENERDALLIANC = 0; 
		
        $ally_fraction_resource_prod = 0;
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
			$ally_fraction_resource_prod = $FRACTIONS['ally_fraction_resource_prod'] * $ALLIANCE['ally_fraction_level'];
			}
			}
			
			
			$ally_fraction_energy_prod = 0;
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
		$ally_fraction_energy_prod = $FRACTIONS['ally_fraction_energy_prod'] * $ALLIANCE['ally_fraction_level'];
		}
		}

		$this->assign(array(
			'header'			=> sprintf($LNG['rs_production_on_planet'], $PLANET['name']),
			'METALGALA7'		=> $METALGALA7,
			'CRYSAGAL7'			=> $CRYSAGAL7,
			'DEUTDGAL7'			=> $DEUTDGAL7,
			'produceEnergy'		=> $produceEnergy,
			'ENERDDEFAULT'		=> $ENERDDEFAULT,
			'ENERDDSTRUCT'		=> $ENERDDSTRUCT,
			'ENERDPREMIUM'		=> $ENERDPREMIUM,
			'ENERDPEACEXP'		=> $ENERDPEACEXP,
			'ENERDCADAEMY'		=> $ENERDCADAEMY,
			'ENERDGOUVERN'		=> $ENERDGOUVERN,
			'ENERDARSENAL'		=> $ENERDARSENAL,
			'ENERDOFFICER'		=> $ENERDOFFICER,
			'ENERDALLIANC'		=> $ENERDALLIANC,
			'prodSelector'		=> $prodSelector,
			'productionList'	=> $productionList,
			'basicProduction'	=> $basicProduction,
			'totalProduction'	=> $totalProduction,
			'bonusProduction'	=> $bonusProduction,
			'itemProduction'	=> $itemProduction,
			'planet_temp_min' 			=> $PLANET['temp_min'],
			'ally_fraction_resource_prod'	=> $ally_fraction_resource_prod,
			'ally_fraction_energy_prod'	=> $ally_fraction_energy_prod,
			'dailyProduction'	=> $dailyProduction,
			'weeklyProduction'	=> $weeklyProduction,
			'storage'			=> $storage,
			'METALDEFAULT'		=> $METALDEFAULT,
			'METALDSTRUCT'		=> $METALDSTRUCT,
			'METALPREMIUM'		=> $METALPREMIUM,
			'METALPEACEXP'		=> $METALPEACEXP,
			'METALCADAEMY'		=> $METALCADAEMY,
			'METALGOUVERN'		=> $METALGOUVERN,
			'METALARSENAL'		=> $METALARSENAL,
			'METALOFFICER'		=> $METALOFFICER,
			'METALALLIANC'		=> $METALALLIANC,
			'CRYSADEFAULT'		=> $CRYSADEFAULT,
			'CRYSADSTRUCT'		=> $CRYSADSTRUCT,
			'CRYSAPREMIUM'		=> $CRYSAPREMIUM,
			'CRYSAPEACEXP'		=> $CRYSAPEACEXP,
			'CRYSACADAEMY'		=> $CRYSACADAEMY,
			'CRYSAGOUVERN'		=> $CRYSAGOUVERN,
			'CRYSAARSENAL'		=> $CRYSAARSENAL,
			'CRYSAOFFICER'		=> $CRYSAOFFICER,
			'CRYSAALLIANC'		=> $CRYSAALLIANC,
			'DEUTDDEFAULT'		=> $DEUTDDEFAULT,
			'DEUTDDSTRUCT'		=> $DEUTDDSTRUCT,
			'DEUTDPREMIUM'		=> $DEUTDPREMIUM,
			'DEUTDPEACEXP'		=> $DEUTDPEACEXP,
			'DEUTDCADAEMY'		=> $DEUTDCADAEMY,
			'DEUTDGOUVERN'		=> $DEUTDGOUVERN,
			'DEUTDARSENAL'		=> $DEUTDARSENAL,
			'DEUTDOFFICER'		=> $DEUTDOFFICER,
			'DEUTDALLIANC'		=> $DEUTDALLIANC,
			'ItemTiMe'		=> pretty_time($ItemTiMe-TIMESTAMP),
			'ItemTiCr'		=> pretty_time($ItemTiCr-TIMESTAMP),
			'ItemTiDe'		=> pretty_time($ItemTiDe-TIMESTAMP),
			'ItemTiMeb'		=> $ItemTiMe-TIMESTAMP,
			'ItemTiCrb'		=> $ItemTiCr-TIMESTAMP,
			'ItemTiDeb'		=> $ItemTiDe-TIMESTAMP,
		));
		
		$this->display('page.resources.default.tpl');
	}
}
