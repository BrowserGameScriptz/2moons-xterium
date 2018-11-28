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

class ShowMarketPage extends AbstractGamePage
{
	public static $requireModule = MODULE_BANLIST;

	function __construct()
	{
	parent::__construct();
	}

	function show()
	{
		global $USER, $LNG;
		
		$this->assign(array(
				
		));
		$this->tplObj->loadscript('market.js'); 	
		
		$this->display('page.market.default.tpl');
	}

	function planetlotinfo()
	{
		global $LNG, $resource, $USER, $PLANET, $reslist;
		$this->setWindow('popup');
		$this->initTemplate();
		
		$lodId 	 	= HTTP::_GP('id', 0);
		$db	= Database::get();
		$sql = "SELECT * FROM %%PLANETS%% WHERE id = :lodId;";
		$PlanetsRAW = $db->selectSingle($sql, array(
		':lodId'  		  => $lodId
		));
		
		
			
		$planetList['image'][$PlanetsRAW['id']]					= $PlanetsRAW['image'];
		$planetList['coords'][$PlanetsRAW['id']]['planet']		= $PlanetsRAW['planet'];
			
		$planetList['field'][$PlanetsRAW['id']]['current']		= $PlanetsRAW['field_current'];
		$planetList['diameter'][$PlanetsRAW['id']]['diameter']		= $PlanetsRAW['diameter'];
		$planetList['field'][$PlanetsRAW['id']]['max']			= CalculateMaxPlanetFields($PlanetsRAW);
		$planetList['temperature'][$PlanetsRAW['id']]['minimum']			= $PlanetsRAW['temp_min'];;
		$planetList['temperature'][$PlanetsRAW['id']]['maximum']			= $PlanetsRAW['temp_max'];;
		$planetList['solar'][$PlanetsRAW['id']]['solar']			= $PlanetsRAW['solar_satelit'];;
			
		foreach($reslist['build'] as $elementID) {

				if($PlanetsRAW[$resource[$elementID]] == 0){
				$planetList['build'][$elementID][$PlanetsRAW['id']]	= NULL;
				}else{				
				$planetList['build'][$elementID][$PlanetsRAW['id']]	= $PlanetsRAW[$resource[$elementID]];
				}
		}
			
		foreach($reslist['defense'] as $elementID) {
				if($PlanetsRAW[$resource[$elementID]] == 0){
				$planetList['defense'][$elementID][$PlanetsRAW['id']]	= NULL;
				}else{				
				$planetList['defense'][$elementID][$PlanetsRAW['id']]	= $PlanetsRAW[$resource[$elementID]];
				}
		}

		
		$this->tplObj->assign_vars(array(
			'planetList'	=> $planetList,
		));
		
		$this->display('page.planetauction.info.tpl');
	}
	
	function yourlots()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		$db	= Database::get();
		$sql = "SELECT auctionID, planetID, price, time FROM %%PLANETAUCTION%% WHERE selledID= :selledID AND universe = :universe;";
		$soldPlanet = $db->select($sql, array(
		':selledID'  		  => $USER['id'],
		':universe' 	      => Universe::current()
		));

		$soldPlanetList	= array();

		foreach ($soldPlanet as $soldPlanetRow)
		{

			$sql = "SELECT * FROM %%PLANETS%% WHERE id = :lodId;";
			$PlanetsRAW = $db->selectSingle($sql, array(
			':lodId'  		  => $soldPlanetRow['planetID']
			));

			$soldPlanetList[$soldPlanetRow['auctionID']]	= array(
				'price'					=> pretty_number($soldPlanetRow['price']),
				'time'					=> _date("d. F y, H:i:s",$soldPlanetRow['time']),
				'timeLeft'				=> _date("d F y, H:i:s",($soldPlanetRow['time'] + 36*3600)),
				'planetID'				=> $soldPlanetRow['planetID'],
				'moonId'				=> $PlanetsRAW['id_luna'],
			);
		}


		$sql = "SELECT upgradeID, upgradeName, upgradeCount, upgradePrice, upgradeTime FROM %%PLANETUPGRADE%% WHERE upgradeOwner = :upgradeOwner AND upgradeUni = :universe;";
		$soldUpgrade = $db->select($sql, array(
		':upgradeOwner'  		  => $USER['id'],
		':universe' 	      => Universe::current()
		));

		$soldUpgradeList	= array();

		foreach ($soldUpgrade as $soldUpgradeRow)
		{	
			if($soldUpgradeRow['upgradeName'] == "laser"){
			$upgName = $LNG['market_5'];
			}elseif($soldUpgradeRow['upgradeName'] == "ion"){
			$upgName = $LNG['market_6'];
			}elseif($soldUpgradeRow['upgradeName'] == "plasma"){
			$upgName = $LNG['market_7'];
			}elseif($soldUpgradeRow['upgradeName'] == "gravity"){
			$upgName = $LNG['market_8'];
			}elseif($soldUpgradeRow['upgradeName'] == "dlight"){
			$upgName = $LNG['market_9'];
			}elseif($soldUpgradeRow['upgradeName'] == "dmedium"){
			$upgName = $LNG['market_10'];
			}elseif($soldUpgradeRow['upgradeName'] == "dheavy"){
			$upgName = $LNG['market_11'];
			}elseif($soldUpgradeRow['upgradeName'] == "slight"){
			$upgName = $LNG['market_12'];
			}elseif($soldUpgradeRow['upgradeName'] == "smedium"){
			$upgName = $LNG['market_13'];
			}elseif($soldUpgradeRow['upgradeName'] == "sheavy"){
			$upgName = $LNG['market_14'];
			}elseif($soldUpgradeRow['upgradeName'] == "combustion"){
			$upgName = $LNG['market_15'];
			}elseif($soldUpgradeRow['upgradeName'] == "impulse"){
			$upgName = $LNG['market_16'];
			}elseif($soldUpgradeRow['upgradeName'] == "hyperspace"){
			$upgName = $LNG['market_17'];
			}elseif($soldUpgradeRow['upgradeName'] == "res901"){
			$upgName = $LNG['market_18'];
			}elseif($soldUpgradeRow['upgradeName'] == "res902"){
			$upgName = $LNG['market_19'];
			}elseif($soldUpgradeRow['upgradeName'] == "res903"){
			$upgName = $LNG['market_20'];
			}elseif($soldUpgradeRow['upgradeName'] == "conveyor1"){
			$upgName = $LNG['market_73'];
			}elseif($soldUpgradeRow['upgradeName'] == "conveyor2"){
			$upgName = $LNG['market_74'];
			}elseif($soldUpgradeRow['upgradeName'] == "conveyor3"){
			$upgName = $LNG['market_75'];
			}

			$soldUpgradeList[$soldUpgradeRow['upgradeID']]	= array(
				'upgradeName'			=> $upgName,
				'upgradeCount'			=> pretty_number($soldUpgradeRow['upgradeCount']),
				'upgradePrice'			=> pretty_number($soldUpgradeRow['upgradePrice']),
				'upgradeTime'			=> _date("d. F y, H:i:s",$soldUpgradeRow['upgradeTime']),
				'upgradeMessage'			=> sprintf($LNG['market_72'], $soldUpgradeRow['upgradeID']),
			);
		}
		
		
		$sql = "SELECT itemID, upgradeName, upgradeCount, upgradePrice, upgradeTime FROM %%PLANETITEMS%% WHERE upgradeOwner = :upgradeOwner AND upgradeUni = :universe;";
		$soldItem = $db->select($sql, array(
		':upgradeOwner'  		  => $USER['id'],
		':universe' 	      => Universe::current()
		));

		$solditemList	= array();

		foreach ($soldItem as $upgradeResults)
		{	
			if($upgradeResults['upgradeName'] == "auction_item_1"){
			$upgName = $LNG['auctioneer_booster'][1];
			}elseif($upgradeResults['upgradeName'] == "auction_item_2"){
			$upgName = $LNG['auctioneer_booster'][2];
			}elseif($upgradeResults['upgradeName'] == "auction_item_3"){
			$upgName = $LNG['auctioneer_booster'][3];
			}elseif($upgradeResults['upgradeName'] == "auction_item_4"){
			$upgName = $LNG['auctioneer_booster'][4];
			}elseif($upgradeResults['upgradeName'] == "auction_item_5"){
			$upgName = $LNG['auctioneer_booster'][5];
			}elseif($upgradeResults['upgradeName'] == "auction_item_6"){
			$upgName = $LNG['auctioneer_booster'][6];
			}elseif($upgradeResults['upgradeName'] == "auction_item_7"){
			$upgName = $LNG['auctioneer_booster'][7];
			}elseif($upgradeResults['upgradeName'] == "auction_item_8"){
			$upgName = $LNG['auctioneer_booster'][8];
			}elseif($upgradeResults['upgradeName'] == "auction_item_9"){
			$upgName = $LNG['auctioneer_booster'][9];
			}elseif($upgradeResults['upgradeName'] == "auction_item_10"){
			$upgName = $LNG['auctioneer_booster'][10];
			}elseif($upgradeResults['upgradeName'] == "auction_item_11"){
			$upgName = $LNG['auctioneer_booster'][11];
			}elseif($upgradeResults['upgradeName'] == "auction_item_12"){
			$upgName = $LNG['auctioneer_booster'][12];
			}elseif($upgradeResults['upgradeName'] == "auction_item_13"){
			$upgName = $LNG['auctioneer_booster'][13];
			}elseif($upgradeResults['upgradeName'] == "auction_item_14"){
			$upgName = $LNG['auctioneer_booster'][14];
			}elseif($upgradeResults['upgradeName'] == "auction_item_15"){
			$upgName = $LNG['auctioneer_booster'][15];
			}elseif($upgradeResults['upgradeName'] == "auction_item_16"){
			$upgName = $LNG['auctioneer_booster'][16];
			}elseif($upgradeResults['upgradeName'] == "auction_item_17"){
			$upgName = $LNG['auctioneer_booster'][17];
			}elseif($upgradeResults['upgradeName'] == "auction_item_18"){
			$upgName = $LNG['auctioneer_booster'][18];
			}elseif($upgradeResults['upgradeName'] == "auction_item_19"){
			$upgName = $LNG['auctioneer_booster'][19];
			}elseif($upgradeResults['upgradeName'] == "auction_item_20"){
			$upgName = $LNG['auctioneer_booster'][20];
			}elseif($upgradeResults['upgradeName'] == "auction_item_21"){
			$upgName = $LNG['auctioneer_booster'][21];
			}

			$solditemList[$upgradeResults['itemID']]	= array(
				'upgradeName'			=> $upgName,
				'upgradeCount'			=> pretty_number($upgradeResults['upgradeCount']),
				'upgradePrice'			=> pretty_number($upgradeResults['upgradePrice']),
				'upgradeTime'			=> _date("d. F y, H:i:s",$upgradeResults['upgradeTime']),
				'upgradeMessage'			=> sprintf($LNG['market_72'], $upgradeResults['itemID']),
			);
		}
		
		
		$this->assign(array(
		'soldPlanetList' => $soldPlanetList,
		'soldUpgradeList' => $soldUpgradeList,
		'solditemList' => $solditemList,
		'planetCount' => count($soldPlanet),
		'upgradeCount' => count($soldUpgrade),
		'itemCount' => count($soldItem),
		));
		
		$this->display('page.yourlots.default.tpl');
	}
	function delitemlots()
	{
		global $LNG, $resource, $USER, $PLANET;
		$lodId 	 	= HTTP::_GP('id', 0);
		
		$db	= Database::get();
		$sql = "SELECT * FROM %%PLANETITEMS%% WHERE itemID = :lodId;";
		$upgradeResults = $db->selectSingle($sql, array(
		':lodId'  		  => $lodId
		));
		
		if(!$upgradeResults){
		PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your market page', TIMESTAMP);
		$this->printMessage($LNG['moon_hack'], true, array('game.php?page=market', 3));
		}

		if($upgradeResults['upgradeName'] == "auction_item_1"){
		$upgName = $LNG['auctioneer_booster'][1];
		}elseif($upgradeResults['upgradeName'] == "auction_item_2"){
		$upgName = $LNG['auctioneer_booster'][2];
		}elseif($upgradeResults['upgradeName'] == "auction_item_3"){
		$upgName = $LNG['auctioneer_booster'][3];
		}elseif($upgradeResults['upgradeName'] == "auction_item_4"){
		$upgName = $LNG['auctioneer_booster'][4];
		}elseif($upgradeResults['upgradeName'] == "auction_item_5"){
		$upgName = $LNG['auctioneer_booster'][5];
		}elseif($upgradeResults['upgradeName'] == "auction_item_6"){
		$upgName = $LNG['auctioneer_booster'][6];
		}elseif($upgradeResults['upgradeName'] == "auction_item_7"){
		$upgName = $LNG['auctioneer_booster'][7];
		}elseif($upgradeResults['upgradeName'] == "auction_item_8"){
		$upgName = $LNG['auctioneer_booster'][8];
		}elseif($upgradeResults['upgradeName'] == "auction_item_9"){
		$upgName = $LNG['auctioneer_booster'][9];
		}elseif($upgradeResults['upgradeName'] == "auction_item_10"){
		$upgName = $LNG['auctioneer_booster'][10];
		}elseif($upgradeResults['upgradeName'] == "auction_item_11"){
		$upgName = $LNG['auctioneer_booster'][11];
		}elseif($upgradeResults['upgradeName'] == "auction_item_12"){
		$upgName = $LNG['auctioneer_booster'][12];
		}elseif($upgradeResults['upgradeName'] == "auction_item_13"){
		$upgName = $LNG['auctioneer_booster'][13];
		}elseif($upgradeResults['upgradeName'] == "auction_item_14"){
		$upgName = $LNG['auctioneer_booster'][14];
		}elseif($upgradeResults['upgradeName'] == "auction_item_15"){
		$upgName = $LNG['auctioneer_booster'][15];
		}elseif($upgradeResults['upgradeName'] == "auction_item_16"){
		$upgName = $LNG['auctioneer_booster'][16];
		}elseif($upgradeResults['upgradeName'] == "auction_item_17"){
		$upgName = $LNG['auctioneer_booster'][17];
		}elseif($upgradeResults['upgradeName'] == "auction_item_18"){
		$upgName = $LNG['auctioneer_booster'][18];
		}elseif($upgradeResults['upgradeName'] == "auction_item_19"){
		$upgName = $LNG['auctioneer_booster'][19];
		}elseif($upgradeResults['upgradeName'] == "auction_item_20"){
		$upgName = $LNG['auctioneer_booster'][20];
		}elseif($upgradeResults['upgradeName'] == "auction_item_21"){
		$upgName = $LNG['auctioneer_booster'][21];
		}

		
		$NameUPG = $upgradeResults['upgradeName'];
		$sql	= "UPDATE %%USERS%% SET ".$NameUPG." = ".$NameUPG." + :upgradeCount WHERE id = :userId;";
		$db->update($sql, array(
			':upgradeCount'	=> $upgradeResults['upgradeCount'],
			':userId'	=> $upgradeResults['upgradeOwner']
		)); 
		
		$sql = "DELETE FROM %%PLANETITEMS%% WHERE itemID = :lodId;";
        $db->delete($sql, array(
        ':lodId' => $lodId,
        ));
		
		$this->printMessage(sprintf($LNG['market_82'], $upgName, $upgradeResults['upgradeCount']), true, array('game.php?page=market&mode=yourlots', 3));
		
	}
	
	function delupgradelots()
	{
		global $LNG, $resource, $USER, $PLANET;
		$lodId 	 	= HTTP::_GP('id', 0);
		
		$db	= Database::get();
		$sql = "SELECT * FROM %%PLANETUPGRADE%% WHERE upgradeID = :lodId;";
		$upgradeBackup = $db->selectSingle($sql, array(
		':lodId'  		  => $lodId
		));
		
		if(!$upgradeBackup || $upgradeBackup['upgradeOwner'] != $USER['id']){
		PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your market page', TIMESTAMP);
		$this->printMessage($LNG['moon_hack'], true, array('game.php?page=market', 3));
		}

		if($upgradeBackup['upgradeName'] == "laser"){
		$upgName = $LNG['market_5'];
		}elseif($upgradeBackup['upgradeName'] == "ion"){
		$upgName = $LNG['market_6'];
		}elseif($upgradeBackup['upgradeName'] == "plasma"){
		$upgName = $LNG['market_7'];
		}elseif($upgradeBackup['upgradeName'] == "gravity"){
		$upgName = $LNG['market_8'];
		}elseif($upgradeBackup['upgradeName'] == "dlight"){
		$upgName = $LNG['market_9'];
		}elseif($upgradeBackup['upgradeName'] == "dmedium"){
		$upgName = $LNG['market_10'];
		}elseif($upgradeBackup['upgradeName'] == "dheavy"){
		$upgName = $LNG['market_11'];
		}elseif($upgradeBackup['upgradeName'] == "slight"){
		$upgName = $LNG['market_12'];
		}elseif($upgradeBackup['upgradeName'] == "smedium"){
		$upgName = $LNG['market_13'];
		}elseif($upgradeBackup['upgradeName'] == "sheavy"){
		$upgName = $LNG['market_14'];
		}elseif($upgradeBackup['upgradeName'] == "combustion"){
		$upgName = $LNG['market_15'];
		}elseif($upgradeBackup['upgradeName'] == "impulse"){
		$upgName = $LNG['market_16'];
		}elseif($upgradeBackup['upgradeName'] == "hyperspace"){
		$upgName = $LNG['market_17'];
		}elseif($upgradeBackup['upgradeName'] == "res901"){
		$upgName = $LNG['market_18'];
		}elseif($upgradeBackup['upgradeName'] == "res902"){
		$upgName = $LNG['market_19'];
		}elseif($upgradeBackup['upgradeName'] == "res903"){
		$upgName = $LNG['market_20'];
		}elseif($upgradeBackup['upgradeName'] == "conveyor1"){
		$upgName = $LNG['market_73'];
		}elseif($upgradeBackup['upgradeName'] == "conveyor2"){
		$upgName = $LNG['market_74'];
		}elseif($upgradeBackup['upgradeName'] == "conveyor3"){
		$upgName = $LNG['market_75'];
		}

		
		$NameUPG = "arsenal_".$upgradeBackup['upgradeName'];
		$sql	= "UPDATE %%USERS%% SET ".$NameUPG." = ".$NameUPG." + :upgradeCount WHERE id = :userId;";
		$db->update($sql, array(
			':upgradeCount'	=> $upgradeBackup['upgradeCount'],
			':userId'	=> $upgradeBackup['upgradeOwner']
		)); 
		
		$sql = "DELETE FROM %%PLANETUPGRADE%% WHERE upgradeID = :lodId;";
        $db->delete($sql, array(
        ':lodId' => $lodId,
        ));
		
		$this->printMessage(sprintf($LNG['market_82'], $upgName, $upgradeBackup['upgradeCount']), true, array('game.php?page=market&mode=yourlots', 3));
		
	}

	function planetlotrate()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		$this->setWindow('popup');
		$this->initTemplate();
		
		$planetSoldId 	 = HTTP::_GP('id', 0);
		$rateSoldNEw 	 = HTTP::_GP('rate', 0);
		
		$sql 	= "SELECT * FROM %%PLANETAUCTION%% WHERE auctionID = :auctionID;";
		$pLotId = database::get()->selectSingle($sql, array(
			':auctionID'    => $planetSoldId
		));
		
		$sql	= 'SELECT COUNT(*) as state FROM %%PLANETS%% WHERE `id_owner` = :userId AND `planet_type` = :type AND `destruyed` = :destroyed AND `gal6mod` = 0;';
		$currentPlanetCount	= database::get()->selectSingle($sql, array(
			':userId'		=> $USER['id'],
			':type'			=> 1,
			':destroyed'	=> 0
		), 'state');
		
		$sql	= 'SELECT COUNT(*) as state FROM %%PLANETAUCTION%% WHERE `buyerID` = :buyerID OR selledID = :buyerID;';
		$currentPlanetCountBis	= database::get()->selectSingle($sql, array(
			':buyerID'		=> $USER['id'],
		), 'state');

		$maxPlanetCount		= PlayerUtil::maxPlanetCount($USER);
		
		if($currentPlanetCount + $currentPlanetCountBis >= $maxPlanetCount){
			$this->printMessage("You have already the maximum amount of planets allowed on your account.");
		}
		
		if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($rateSoldNEw)){
			$minPrice = round($pLotId['price'] + ($pLotId['price']/100*1));
			
			if(empty($pLotId)){
				$this->printMessage("This lot does not exist");
			}elseif($rateSoldNEw < $minPrice){
				$this->printMessage("You have not bid enough to buy on the auction");
			}elseif($USER['antimatter'] + $USER['antimatter_bought'] < $rateSoldNEw){
				$this->printMessage("You have not enough antimatter on your account.");
			}elseif($pLotId['selledID'] == $USER['id']){
				$this->printMessage("You cannot bid on your own planet.");
			}elseif($pLotId['time'] <= TIMESTAMP){
				$this->printMessage("You cannot bid on this lot anymore.");
			}elseif($pLotId['buyerID'] == $USER['id']){
				$this->printMessage("You cannot overbid yourself.");
			}else{
				$sql 	= "UPDATE %%PLANETAUCTION%% SET buyerID = :buyerID, price = :price WHERE auctionID = :auctionID;";
				database::get()->update($sql, array(
					':buyerID'    	=> $USER['id'],
					':price'    	=> $rateSoldNEw,
					':auctionID'    => $planetSoldId,
				));
				
				$this->widrawAm($rateSoldNEw, $USER['id']);
				$sql 	= "INSERT INTO %%PLANETOFFERS%% SET playerId = :playerId, lotId = :lotId, bidPrice = :bidPrice, bidTime = :bidTime;";
				database::get()->insert($sql, array(
					':playerId'   	 => $USER['id'],
					':lotId'   		 => $planetSoldId,
					':bidPrice'   	 => $rateSoldNEw,
					':bidTime'   	 => TIMESTAMP,
				));
				
				PlayerUtil::sendMessage($pLotId['selledID'], $USER['id'], getUsername($USER['id']), 1, "Market offer", "A new offer is bidded on your lot.", TIMESTAMP);
				$this->printMessage("Your bid has been accepted. You will be notified if you win the planet.");
			}
		}

		$sql 	= "SELECT * FROM %%PLANETAUCTION%% WHERE auctionID = :auctionID;";
		$pLotId = database::get()->selectSingle($sql, array(
			':auctionID'  		  => $planetSoldId
		));
		
		if(empty($pLotId)){
			$this->printMessage("This lot does not exist");
		}
		
		$maxTimeSell = $pLotId['time'];
		
		$this->assign(array(
			'lotNumber'	=> sprintf($LNG['market_90'], $pLotId['auctionID']),
			'plotId'	=> $pLotId['auctionID'],
			'minprice'	=> $pLotId['price'] + ($pLotId['price']/100*1),
			'maxTime'	=> $maxTimeSell - TIMESTAMP, 
		));
		
		$this->display('page.planetrate.default.tpl');
	}

	function yourrate()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		$this->assign(array());
		
		$this->display('page.yourrate.default.tpl');
	}
}