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

class ShowCreatelotPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
		 
	}

	private function GetUsersInfosFromDB($PLANETID)
	{
		global $resource, $reslist ;
		$select_defenses	=	'';
		$select_buildings	=	'';
				
		foreach($reslist['build'] as $Building){
			$select_buildings	.= $resource[$Building].",";
		}
		
		foreach(array_merge($reslist['defense'], $reslist['missile']) as $Defense){
			$select_defenses	.= " SUM(".$resource[$Defense].") as ".$resource[$Defense].",";
		}
		
		$database		= Database::get();
		
		$sql = "SELECT ".$select_buildings.$select_defenses." id FROM %%PLANETS%% WHERE id = :planetId";
		$userInfo = $database->select($sql, array(
		':planetId'  		  => $PLANETID
		));

		$Return	= $userInfo;
		
		return $Return;
	}
	
	function GetBuildPoints($TotalData, $PLANET) 
	{
		global $resource, $reslist, $pricelist;
		$BuildPoints = 0;
		
		foreach($reslist['build'] as $Build)
		{
			if($PLANET[$resource[$Build]] == 0) 
			continue;
			
			$Units			 = $pricelist[$Build]['cost'][901] + $pricelist[$Build]['cost'][902] + $pricelist[$Build]['cost'][903] + $pricelist[$Build]['cost'][922];
			for($Level = 1; $Level <= $PLANET[$resource[$Build]]; $Level++)
			{
				$BuildPoints	+= $Units * pow($pricelist[$Build]['factor'], $Level);
			}
						
		}
		return ($BuildPoints / Config::get()->stat_settings);
	}

	function GetDefensePoints($TotalData, $PLANET) 
	{
		global $resource, $reslist, $pricelist;
		$DefensePoints = 0;
				
		foreach(array_merge($reslist['defense'], $reslist['missile']) as $Defense) {
			if($PLANET[$resource[$Defense]] == 0) 
			continue;
			
			$Units			= $pricelist[$Defense]['cost'][901] + $pricelist[$Defense]['cost'][902] + $pricelist[$Defense]['cost'][903] + $pricelist[$Defense]['cost'][922];
			$DefensePoints += $Units * $PLANET[$resource[$Defense]];
		
		}
		
		return ($DefensePoints / Config::get()->stat_settings);
	}
	
	function planet()
	{
		global $LNG, $resource, $USER, $PLANET;
		$this->setWindow('popup');
		$this->initTemplate();
		
		if($PLANET['gal6mod'] == 1 || $PLANET['isAlliancePlanet'] != 0)
			$this->printMessage("You cannot sell special planets");
		elseif($PLANET['planet_type'] != 1)
			$this->printMessage("You have to sell the planet with the moon. You cannot sell the moon separatly.");
			
		$TotalData	= $this->GetUsersInfosFromDB($PLANET['id']);
		$points_b_p = $this->GetBuildPoints($TotalData, $PLANET);
		$points_d_p = $this->GetDefensePoints($TotalData, $PLANET);
		
		$TotalPoint = $points_b_p + $points_d_p;
		$TotalPoint /= 400;
		$TotalPoint /= 1.25;
		$TotalPoint += $PLANET['field_max']*25;
		
		$this->tplObj->loadscript('createlot.js'); 	
		$this->assign(array(
			'TotalPointSell'	=> round($TotalPoint),
		));
		
		$this->display('page.createlot.default.tpl');
	}
	
	function sendplanet()
	{
		global $LNG, $resource, $USER, $PLANET;
		$Cost 	 	= HTTP::_GP('cost', 0);
		$isCollider = 0;
		
		$db	= Database::get();
		$session	= Session::load();
		$sql		= 'SELECT * FROM %%PLANETAUCTION%% WHERE selledID = :userID AND universe = :universe;';
		$isMax		= $db->select($sql, array(
			':userID'	=> $USER['id'],
			':universe'	=> Universe::current()
		));
		
		$TotalData	= $this->GetUsersInfosFromDB($PLANET['id']);
		$points_b_p = $this->GetBuildPoints($TotalData, $PLANET);
		$points_d_p = $this->GetDefensePoints($TotalData, $PLANET);
		$points_b_l = 0;
		$points_d_l = 0;
		
		$TotalPoint = $points_b_p + $points_d_p;
		$TotalPoint /= 400;
		$TotalPoint /= 1.25;
		$TotalPoint += $PLANET['field_max']*25;

		if($PLANET['id_luna'] != 0){
			$sql		= 'SELECT collider FROM %%PLANETS%% WHERE id = :id_luna;';
			$isCollider		= $db->selectSingle($sql, array(
			':id_luna'	=> $PLANET['id_luna']
			), 'collider');
			
			$sql	= "SELECT * FROM %%PLANETS%% WHERE id = :planetId;";
			$PLANETMOON	= $db->selectSingle($sql, array(
			':planetId'	=> $PLANET['id_luna'],
			));

			$TotalData	= $this->GetUsersInfosFromDB($PLANET['id_luna']);
			$points_b_l = $this->GetBuildPoints($TotalData, $PLANETMOON);
			$points_d_l = $this->GetDefensePoints($TotalData, $PLANETMOON);
		}
		
		if($PLANET['id'] == $USER['id_planet']){
			$Message = $LNG['market_83'];	
		}elseif(count($isMax) >= 2){
			$Message = $LNG['market_84'];	
		}elseif($PLANET['field_max'] < 200){
			$Message =sprintf($LNG['market_85'], $PLANET['field_max']);	
		}elseif($Cost > $TotalPoint){
			$Message ="You exceeded the maximum price";;	
		}elseif($Cost < max(1000,round($TotalPoint/2-500000))){
			$Message ="The price is to low.";;	
		}else{
		$sql = "INSERT INTO %%PLANETAUCTION%% SET planetID = :planetID, price = :price, time = :timeLeft, buyerID = :buyerID, selledID = :selledID, max_fields = :max_fields, hasMoon = :hasMoon, collider = :isCollider, points_b_p = :points_b_p, points_d_p = :points_d_p, points_b_l = :points_b_l, points_d_l = :points_d_l, points_b = :points_b, points_d = :points_d, universe = :universe;";
		$db->insert($sql, array(
			':points_b_p'   => $points_b_p,
			':points_d_p'   => $points_d_p,
			':points_b_l'   => $points_b_l,
			':points_d_l'   => $points_d_l,
			':planetID'    => $PLANET['id'],
			':price'       => $Cost,
			':timeLeft'    => TIMESTAMP+36*3600,
			':buyerID'     => $USER['id'],
			':selledID'    => $USER['id'],
			':max_fields'    => $PLANET['field_max'],
			':hasMoon'    => $PLANET['id_luna'],
			':isCollider'    => $isCollider,
			':points_b'    => $points_b_p + $points_b_l,
			':points_d'    => $points_d_p + $points_d_l,
			':universe'    => Universe::current()
		));
		
		$sql	= "UPDATE %%PLANETS%% SET metal = :totalAmount, crystal = :totalAmount, deuterium = :totalAmount, small_ship_cargo = :totalAmount, big_ship_cargo = :totalAmount, light_hunter = :totalAmount, heavy_hunter = :totalAmount, crusher = :totalAmount, battle_ship = :totalAmount, colonizer = :totalAmount, recycler = :totalAmount, spy_sonde = :totalAmount, bomber_ship = :totalAmount, destructor = :totalAmount, dearth_star = :totalAmount, battleship = :totalAmount, lune_noir = :totalAmount, ev_transporter = :totalAmount, star_crasher = :totalAmount, giga_recykler = :totalAmount, dm_ship = :totalAmount, bs_oneil = :totalAmount, flying_death = :totalAmount, saver = :totalAmount, m19 = :totalAmount, galleon = :totalAmount, destroyer = :totalAmount, frigate = :totalAmount, black_wanderer = :totalAmount, m7 = :totalAmount, m32 = :totalAmount WHERE id = :planetId;";
		$db->update($sql, array(
			':totalAmount'	=> 0,
			':planetId'	=> $PLANET['id']
		));

		$sql	= "UPDATE %%PLANETS%% SET id_owner = :idOwner WHERE id = :planetId;";
		$db->update($sql, array(
			':idOwner'	=> 2,
			':planetId'	=> $PLANET['id']
		));
		
		if($PLANET['id_luna'] != 0){
		$sql	= "UPDATE %%PLANETS%% SET id_owner = :idOwner WHERE id = :planetId;";
		$db->update($sql, array(
			':idOwner'	=> 2,
			':planetId'	=> $PLANET['id_luna']
		));
		}
		$session->planetId     = $USER['id_planet']; 
		$Message =$LNG['market_86'];	
		}
		
		$this->sendJSON($Message);	

	}
	
	function sendupgrade()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		//if($USER['id'] != 1){
		//$this->printMessage('under maintenance', true, array('game.php?page=overview', 2));
		//}
		
		$count 	 	= HTTP::_GP('count', 0);
		$Cost 	 	= HTTP::_GP('cost', 0);
		$name 	 	= HTTP::_GP('name', '', UTF8_SUPPORT);
		
		
		$db	= Database::get();
		$sql		= 'SELECT * FROM %%PLANETUPGRADE%% WHERE upgradeOwner = :userID AND upgradeUni = :upgradeUni;';
		$isMax		= $db->select($sql, array(
			':userID'	=> $USER['id'],
			':upgradeUni'	=> Universe::current()
		));

		if($USER['arsenal_'.$name] == 0){
		$Message = $LNG['market_76'];
		}elseif(count($isMax) >= 15){
		$Message =$LNG['market_87'];	
		}elseif($count > 25  || $count < 1 || $Cost > 1000000 || $Cost < 500){
		$Message =$LNG['market_95'];	
		}else{
			if($USER['arsenal_'.$name] < $count){
			$count = $USER['arsenal_'.$name];
			}
			if($count > 25){
			$count = 25;
			}
			$db	= Database::get();
			$sql = "INSERT INTO %%PLANETUPGRADE%% SET upgradeName = :upgradeName, upgradeCount = :upgradeCount, upgradePrice = :upgradePrice, upgradeTime = :upgradeTime, upgradeOwner = :upgradeOwner, upgradeUni = :upgradeUni;";
			$db->insert($sql, array(
			':upgradeName'    => $name,
			':upgradeCount'       => $count,
			':upgradePrice'    => $Cost,
			':upgradeTime'     => TIMESTAMP,
			':upgradeOwner'    => $USER['id'],
			':upgradeUni'    => Universe::current()
			));
			$sql	= "UPDATE %%USERS%% SET arsenal_".$name." = arsenal_".$name." - :count WHERE id = :userid;";
			$db->update($sql, array(
			':count'	=> $count,
			':userid'	=> $USER['id']
			));
			$Message = $LNG['market_77'];
		}

		$this->sendJSON($Message);
		
	}
	
	function senditem()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		$count 	 	= HTTP::_GP('count', 0);
		$Cost 	 	= HTTP::_GP('cost', 0);
		$name 	 	= HTTP::_GP('name', '', UTF8_SUPPORT);
		$db	= Database::get();
		$sql		= 'SELECT * FROM %%PLANETITEMS%% WHERE upgradeOwner = :userID AND upgradeUni = :upgradeUni;';
		$isMax		= $db->select($sql, array(
			':userID'	=> $USER['id'],
			':upgradeUni'	=> Universe::current()
		));

		if($USER[$name] == 0){
		$Message = $LNG['market_76'];
		}elseif(count($isMax) >= 15){
		$Message =$LNG['market_87'];	
		}elseif($count > 25  || $count < 1 || $Cost > 1000000 || $Cost < 500){
		$Message =$LNG['market_95'];	
		}else{
			if($USER[$name] < $count){
			$count = $USER[$name];
			}
			if($count > 25){
			$count = 25;
			}
			$db	= Database::get();
			$upgradeID = $db->lastInsertId();
			$sql = "INSERT INTO %%PLANETITEMS%% SET upgradeName = :upgradeName, upgradeCount = :upgradeCount, upgradePrice = :upgradePrice, upgradeTime = :upgradeTime, upgradeOwner = :upgradeOwner, upgradeUni = :upgradeUni;";
			$db->insert($sql, array(
			':upgradeName'    => $name,
			':upgradeCount'       => $count,
			':upgradePrice'    => $Cost,
			':upgradeTime'     => TIMESTAMP,
			':upgradeOwner'    => $USER['id'],
			':upgradeUni'    => Universe::current()
			));
			$sql	= "UPDATE %%USERS%% SET ".$name." = ".$name." - :count WHERE id = :userid;";
			$db->update($sql, array(
			':count'	=> $count,
			':userid'	=> $USER['id']
			));
			$Message = $LNG['market_77'];
		}

		$this->sendJSON($Message);
		
	}
	
	function items()
	{
		global $LNG, $resource, $USER, $PLANET;
		$this->setWindow('popup');
		$this->initTemplate();
		
		$this->tplObj->loadscript('createlot.js'); 	
		$this->assign(array(
		'auction_item_1' 			=> $USER['auction_item_1'],
		'auction_item_2' 			=> $USER['auction_item_2'],
		'auction_item_3' 			=> $USER['auction_item_3'],
		'auction_item_4' 			=> $USER['auction_item_4'],
		'auction_item_5' 			=> $USER['auction_item_5'],
		'auction_item_6' 			=> $USER['auction_item_6'],
		'auction_item_7' 			=> $USER['auction_item_7'],
		'auction_item_8' 			=> $USER['auction_item_8'],
		'auction_item_9' 			=> $USER['auction_item_9'],
		'auction_item_10' 			=> $USER['auction_item_10'],
		'auction_item_11' 			=> $USER['auction_item_11'],
		'auction_item_12' 			=> $USER['auction_item_12'],
		'auction_item_13' 			=> $USER['auction_item_13'],
		'auction_item_14' 			=> $USER['auction_item_14'],
		'auction_item_15' 			=> $USER['auction_item_15'],
		'auction_item_16' 			=> $USER['auction_item_16'],
		'auction_item_17' 			=> $USER['auction_item_17'],
		'auction_item_18' 			=> $USER['auction_item_18'],
		'auction_item_19' 			=> $USER['auction_item_19'],
		'auction_item_20' 			=> $USER['auction_item_20'],
		'auction_item_21' 			=> $USER['auction_item_21'],
		
		));
		
		$this->display('page.createlot.items.tpl');
	}
	
	
	function upgrade()
	{
		global $LNG, $resource, $USER, $PLANET;
		$this->setWindow('popup');
		$this->initTemplate();
		
		$this->tplObj->loadscript('createlot.js'); 	
		$this->assign(array(
		'arsenal_laser' 			=> $USER['arsenal_laser'],
		'arsenal_ion' 				=> $USER['arsenal_ion'],
		'arsenal_plasma' 			=> $USER['arsenal_plasma'],
		'arsenal_gravity' 			=> $USER['arsenal_gravity'],
		'arsenal_d_light' 			=> $USER['arsenal_dlight'],
		'arsenal_d_medium' 			=> $USER['arsenal_dmedium'],
		'arsenal_d_heavy' 			=> $USER['arsenal_dheavy'],
		'arsenal_s_light' 			=> $USER['arsenal_slight'],
		'arsenal_s_medium' 			=> $USER['arsenal_smedium'],
		'arsenal_s_heavy' 			=> $USER['arsenal_sheavy'],
		'arsenal_combustion' 		=> $USER['arsenal_combustion'],
		'arsenal_impulse_motor' 	=> $USER['arsenal_impulse'],
		'arsenal_hyperspace_motor' 	=> $USER['arsenal_hyperspace'],
		'arsenal_res901' 			=> $USER['arsenal_res901'],
		'arsenal_res902' 			=> $USER['arsenal_res902'],
		'arsenal_res903' 			=> $USER['arsenal_res903'],
		'arsenal_conveyor1' 		=> $USER['arsenal_conveyor1'],
		'arsenal_conveyor2' 		=> $USER['arsenal_conveyor2'],
		'arsenal_conveyor3' 		=> $USER['arsenal_conveyor3'],
		));
		
		$this->display('page.createlot.upgrade.tpl');
	}
}
