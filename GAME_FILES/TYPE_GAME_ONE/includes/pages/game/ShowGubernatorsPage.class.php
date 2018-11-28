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

class ShowGubernatorsPage extends AbstractGamePage
{

	function __construct()
	{
		parent::__construct();
	}
	
	public function GubPrice($Element, $Price, $Level, $Days)
	{
		global $PLANET, $USER, $resource, $pricelist;
		
		$db	= Database::get();
		$sql = "SELECT * FROM %%GOUVERNORS%% WHERE gouvernorId = :gouvernorId;";
		$GOUVERNORS	= $db->selectSingle($sql, array(
			':gouvernorId'	=> $Element
		));
		
		$UpLevel		= $Level;
	
		$PriceDM 	= $GOUVERNORS['gouvernorPriceDM'];
		$FpriceDM 	= $GOUVERNORS['gouvernorPriceDMOne'];
		
		$FullPriceDM = round($PriceDM * pow($FpriceDM, $UpLevel));
		$FullPriceDM *= $Days;
		
		return $FullPriceDM;
	}
	
	public function GubPriceAPRESET($Element, $Level)
	{
		global $PLANET, $USER, $resource, $pricelist;
		
		$db	= Database::get();
		$sql = "SELECT * FROM %%GOUVERNORS%% WHERE gouvernorId = :gouvernorId;";
		$GOUVERNORS	= $db->selectSingle($sql, array(
			':gouvernorId'	=> $Element
		));
		$UpLevel		= $Level;
		$costAP		= 0;	
		$PriceAP 	= $GOUVERNORS['gouvernorPriceAP'];
		$FpriceAP 	= $GOUVERNORS['gouvernorPriceAPone'];
		for($i = 1; $i <= $UpLevel; $i++)
		{
		$costAP += round($PriceAP * pow($FpriceAP, $i-1));
		}
		
		return $costAP;
	}
	
	public function GubPriceAP($Element, $Level)
	{
		global $PLANET, $USER, $resource, $pricelist;
		
		$db	= Database::get();
		$sql = "SELECT * FROM %%GOUVERNORS%% WHERE gouvernorId = :gouvernorId;";
		$GOUVERNORS	= $db->selectSingle($sql, array(
			':gouvernorId'	=> $Element
		));
		$UpLevel		= $Level;
		$costAP		= 0;	
		$PriceAP 	= $GOUVERNORS['gouvernorPriceAP'];
		$FpriceAP 	= $GOUVERNORS['gouvernorPriceAPone'];
		for($i = $USER[$resource[$Element].'_level'] + 1; $i <= $UpLevel; $i++)
		{
		$costAP += round($PriceAP * pow($FpriceAP, $i-1));
		}
		
		return $costAP;
	}
	
	public function UpdateExtra($Element, $Days)
	{
		global $PLANET, $USER, $resource, $pricelist, $LNG;
		
		$Price = $pricelist[$Element]['cost'][921];
		$Level = $USER[$resource[$Element].'_level'];
		$costResources		= $this->GubPrice($Element, $Price, $Level, $Days);

		if ($USER['darkmatter'] < $costResources) {
			return;
		}
		
		if($USER[$resource[$Element]] > TIMESTAMP){
			$NewLevel	= $Days * 3600 * 24;
			if($costResources < 0){
				PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your gubernators page', TIMESTAMP);
				$this->printMessage($LNG['moon_hack'], true, array('game.php?page=gubernators', 2));
			}
			$var = "".$Days."";
			if(!ctype_digit($var)){
				PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your gubernators page', TIMESTAMP);
				$this->printMessage($LNG['moon_hack'], true, array('game.php?page=gubernators', 2));
			}else{	
				$sql	= 'UPDATE %%USERS%% SET
						'.$resource[$Element].' = '.$resource[$Element].' + :newTime
						WHERE
						id = :userId;';
				Database::get()->update($sql, array(
					':newTime'	=> $NewLevel,
					':userId'	=> $USER['id']
				));
				$USER['darkmatter'] -= $costResources;
				
				if(TIMESTAMP < config::get()->dmRefundEvent){
					$sql	= 'INSERT INTO %%DMREFUND%% SET userId = :userId, darkAmount = :darkAmount, timestamp = :timestamp;';
					database::get()->insert($sql, array(
						':userId'		=> $USER['id'],
						':darkAmount'	=> $costResources,
						':timestamp'	=> TIMESTAMP
					));
				}
			}
		}else{
			$NewLevel	= TIMESTAMP + $Days * 3600 * 24;
			if($costResources < 0){
				PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your gubernators page', TIMESTAMP);
				$this->printMessage($LNG['moon_hack'], true, array('game.php?page=gubernators', 2));
			}
			$var = "".$Days."";
			if(!ctype_digit($var)){
				PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your gubernators page', TIMESTAMP);
				$this->printMessage($LNG['moon_hack'], true, array('game.php?page=gubernators', 2));
			}else{	
				$sql	= 'UPDATE %%USERS%% SET
						'.$resource[$Element].' = :newTime
						WHERE
						id = :userId;';
				Database::get()->update($sql, array(
					':newTime'	=> $NewLevel,
					':userId'	=> $USER['id']
				));
				$USER['darkmatter'] -= $costResources;
				
				if(TIMESTAMP < config::get()->dmRefundEvent){
					$sql	= 'INSERT INTO %%DMREFUND%% SET userId = :userId, darkAmount = :darkAmount, timestamp = :timestamp;';
					database::get()->insert($sql, array(
						':userId'		=> $USER['id'],
						':darkAmount'	=> $costResources,
						':timestamp'	=> TIMESTAMP
					));
				}
			}
		}
		
		$orderBy .= ' '.($USER['planet_sort_order'] == 1) ? 'DESC' : 'ASC';

		$sql = "SELECT * FROM %%PLANETS%% WHERE id_owner = :userID AND destruyed = '0' AND isAlliancePlanet = 0 ORDER BY :order;";
		$PlanetsRAW = database::get()->select($sql, array(
			':userID'   => $USER['id'],
			':order'    => $orderBy,
		));
				
		foreach ($PlanetsRAW as $CPLANET)
		{
			$CPLANET['last_update']	= TIMESTAMP;
			$this->ecoObj->setData($USER, $CPLANET);
			$this->ecoObj->ReBuildCache();
			list($USER, $CPLANET)= $this->ecoObj->getData();
			$CPLANET['eco_hash'] = $this->ecoObj->CreateHash();
		}
	}
	
	public function resetgouvernor()
	{
		global $PLANET, $USER, $resource, $pricelist, $LNG;
		
		$gouvID  = HTTP::_GP('id', 0);
			
		
		if(!isset($resource[$gouvID])){
		PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your gubernators reset page', TIMESTAMP);
		$this->printMessage($LNG['moon_hack'], true, array('game.php?page=gubernators', 2));
		}else{
			$costResources		= $this->GubPriceAPRESET($gouvID, $USER[$resource[$gouvID].'_level']);	
			$sql	= "UPDATE %%USERS%% SET ".$resource[$gouvID]."_level = 0, achievement_point = achievement_point + :achievement_point WHERE id = :userId;";
			Database::get()->update($sql, array(
			':achievement_point'	=> $costResources / 100 * 70,
			':userId'	=> $USER['id']
			));
		$this->printMessage($LNG['gouvernor_reset'], true, array('game.php?page=gubernators', 2));
		}
	}
	
	public function resetgouvernortime()
	{
		global $PLANET, $USER, $resource, $pricelist, $LNG;
		
		$gouvID  = HTTP::_GP('id', 0);
			
		
		if(!isset($resource[$gouvID])){
		PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your gubernators reset page', TIMESTAMP);
		$this->printMessage($LNG['moon_hack'], true, array('game.php?page=gubernators', 2));
		}else{
			
			$sql	= "UPDATE %%USERS%% SET ".$resource[$gouvID]." = 0 WHERE id = :userId;";
			Database::get()->update($sql, array(
			':userId'	=> $USER['id']
			));
		$this->printMessage('OK', true, array('game.php?page=gubernators', 2));
		}
	}
	
	public function UpdateExtraLevel($Element, $Level)
	{
		global $PLANET, $USER, $resource, $pricelist, $LNG;
		
		$costResources		= $this->GubPriceAP($Element, $Level);		
		$NewLevel	= $Level - $USER[$resource[$Element].'_level'];
		
		if ($USER['achievement_point'] < $costResources || $pricelist[$Element]['max'] < $USER[$resource[$Element].'_level'] + $NewLevel || $USER[$resource[$Element]] > TIMESTAMP){
			return;
		}
		
		if($costResources < 0){
		PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your gubernators page', TIMESTAMP);
		$this->printMessage($LNG['moon_hack'], true, array('game.php?page=gubernators', 2));
		}else{
		
		
		$sql	= 'UPDATE %%USERS%% SET
				'.$resource[$Element].'_level = '.$resource[$Element].'_level + :newTime,
				achievement_point = achievement_point - :achievement_point,
				achievement_point_used = achievement_point_used + :achievement_point_used
				WHERE
				id = :userId;';
		Database::get()->update($sql, array(
			':newTime'	=> $NewLevel,
			':achievement_point'	=> $costResources,
			':achievement_point_used'	=> $costResources,
			':userId'	=> $USER['id']
		));
		}
	}
	

	function show()
	{
	global $USER, $PLANET, $resource, $reslist, $LNG, $pricelist, $requeriments;
		
		$updateID	  = HTTP::_GP('id', 0);
		$updateLvl	  = HTTP::_GP('lvl_id', 0);
		
		//if($USER['id'] != 1){
		//$this->printMessage('under maintenance', true, array('game.php?page=overview', 2));
		//}
				
		if (!empty($updateID) && $_SERVER['REQUEST_METHOD'] === 'POST' && $USER['urlaubs_modus'] == 0)
		{
			$days  = HTTP::_GP('days', 0);
			if(isModuleAvailable(MODULE_DMEXTRAS) && in_array($updateID, $reslist['dmfunc'])) {
				$this->UpdateExtra($updateID, $days);
			}
			$this->redirectTo('game.php?page=gubernators');
		}elseif (!empty($updateLvl) && $_SERVER['REQUEST_METHOD'] === 'POST' && $USER['urlaubs_modus'] == 0)
		{
			$updateLvl_A  = HTTP::_GP('lvl_count', 0);
			if(isModuleAvailable(MODULE_DMEXTRAS) && in_array($updateLvl, $reslist['dmfunc'])) {
				$this->UpdateExtraLevel($updateLvl, $updateLvl_A);
			}
			$this->redirectTo('game.php?page=gubernators');
		}
		
		$darkmatterList	= array();
		
		if(isModuleAvailable(MODULE_DMEXTRAS)) 
		{
			foreach($reslist['dmfunc'] as $Element)
			{
				if($USER[$resource[$Element]] > TIMESTAMP) {
					$this->tplObj->execscript("GetGubernatorTime(".$Element.", ".($USER[$resource[$Element]] - TIMESTAMP).");");
				}
				
				$db	= Database::get();

				$sql	= 'SELECT * FROM %%GOUVERNORS%% WHERE gouvernorId = :gouvernorId;';
				$GOUVERNORS = $db->selectSingle($sql, array(
				':gouvernorId'	=> $Element
				));
			
				$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
				$buyable			= BuildFunctions::isElementBuyable($USER, $PLANET, $Element, $costResources);
				$costOverflow		= BuildFunctions::getRestPrice($USER, $PLANET, $Element, $costResources);
				$elementBonus		= BuildFunctions::getAvalibleBonus($Element);
				$maxAP				= $this->GubPriceAP($Element, $USER[$resource[$Element].'_level'] + 1);
				$maxPrice			= $this->GubPrice($Element, $pricelist[$Element]['cost'][921], $USER[$resource[$Element].'_level'], 1);
				
				$this->tplObj->execscript("GubPriceAPBIS('".$Element."', ".($USER[$resource[$Element].'_level']).", '".$GOUVERNORS['gouvernorName']."');");
				$darkmatterList[$Element]	= array(
					'timeLeft'			=> max($USER[$resource[$Element]] - TIMESTAMP, 0),
					'level'				=> $USER[$resource[$Element].'_level'],
					'maxPrice'			=> $maxPrice,
					'maxAP'				=> $maxAP,
					'costResources'		=> $costResources,
					'buyable'			=> $buyable,
					'gouvernorName'		=> $GOUVERNORS['gouvernorBonusName'],
					'gouvernorName2'	=> $GOUVERNORS['gouvernorBonusNameTwo'],
					'maxLevel'			=> $pricelist[$Element]['max'],
					'time'				=> $pricelist[$Element]['time'],
					'costOverflow'		=> $costOverflow,
					'elementBonus'		=> $elementBonus,
					'elementName'		=> $resource[$Element],
				);
			}
		}
	

	
	$this->assign(array(
	'achievement_points'		=> $USER['achievement_point'],
	'achievement_point_used'	=> $USER['achievement_point_used'],
	'darkmatterList'			=> $darkmatterList,
	));
		
	$this->display('page.governors.default.tpl');
	}
}