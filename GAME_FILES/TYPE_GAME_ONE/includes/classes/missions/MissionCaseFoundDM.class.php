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
require_once 'includes/classes/missions/functions/achievementFunction.php';
class MissionCaseFoundDM extends MissionFunctions implements Mission
{
	const CHANCE = 15; 
	const CHANCE_SHIP = 0.25; 
	const MIN_FOUND = 372890; 
	const MAX_FOUND = 1221480; 
	const MAX_CHANCE = 30; 
		
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function generateRandomString($length = 8) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return "WOG_".$randomString;
	}
		
	function TargetEvent()
	{
		$this->setState(FLEET_HOLD);
		$this->SaveFleet();
	}
	
	function EndStayEvent()
	{
		global $pricelist, $reslist, $resource;
		
		$LNG	= $this->getLanguage(NULL, $this->_fleet['fleet_owner']);
		$chance	= mt_rand(0, 100);
		$db				= Database::get();
		$sql			= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$ownerUser		= Database::get()->selectSingle($sql, array(
			':userId'	=> $this->_fleet['fleet_owner']
		));
		
		$fleetCapacity		= 0; // capacité total de la flotte envoyer sur expedition
		
		$fleetArray		= FleetFunctions::unserialize($this->_fleet['fleet_array']);
		foreach ($fleetArray as $shipId => $shipAmount)
		{
			$fleetCapacity 			   	+= $shipAmount * $pricelist[$shipId]['capacity'];
		}
		
		if($chance <= min(self::MAX_CHANCE, (self::CHANCE + $this->_fleet['fleet_amount'] * self::CHANCE_SHIP))) {
			$FoundDark 	= mt_rand(self::MIN_FOUND, self::MAX_FOUND);
			
			if(config::get(ROOT_UNI)->happyHourEvent == 5 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
				$FoundDark = $FoundDark * config::get()->happyHourBonus;
			
			$this->UpdateFleet('fleet_resource_darkmatter', $FoundDark);
			$Message 	= $LNG['sys_expe_found_dm_'.mt_rand(1, 3).'_'.mt_rand(1, 2).''];
				
			if((config::get(ROOT_UNI)->auctionExpe == 1 && mt_rand(0,40) > mt_rand(0,100)) || (config::get(ROOT_UNI)->happyHourEvent == 4 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)){	
				$findItem = mt_rand(1,21);
				$UName = "auction_item_".$findItem;
				$db	= Database::get();
				$sql	= "UPDATE %%USERS%% SET ".$UName." = ".$UName." + :UName WHERE id = :userId;";
				$db->update($sql, array(
					':UName'	=> 1, 
					':userId'	=> $this->_fleet['fleet_owner']
				));
				$Message .= '<br>You found an auction item.<br>You can use the items <span style="color:#F30; font-weight:bold;">'.$LNG['auctioneer_booster'][$findItem].'</span> in your inventory';	
			}
			
			$Achievements = achievementSuccesDaily($ownerUser, $this->_fleet['fleet_start_id']);		
			$Achievements = achievementSuccesVaria($ownerUser);		
			$Achievements = achievementDarkmatter($ownerUser, min($FoundDark, $fleetCapacity));		
			
		} else {
			$Message 	= $LNG['sys_expe_nothing_'.mt_rand(1, 9)];
		}
		$this->setState(FLEET_RETURN);
		$this->SaveFleet();

		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 15,
			$LNG['sys_expe_report'], $Message, $this->_fleet['fleet_end_stay'], NULL, 1, $this->_fleet['fleet_universe']);
		
		//if(config::get()->voucherCount > 0 && 0 == mt_rand(0,100)){
		if(config::get()->voucherCount > 0 && 0 == mt_rand(0,100)){
			$VoucerCode = $this->generateRandomString();
			$sql	= "INSERT INTO %%VOUCHERCODES%% SET voucherCode = :voucherCode, foundBy = :foundBy;";
			database::get()->insert($sql, array(
				':voucherCode'	=> $VoucerCode, 
				':foundBy'		=> $this->_fleet['fleet_owner']
			));
			$sql	= "UPDATE %%CONFIG%% SET voucherCount = voucherCount - 1;";
			database::get()->update($sql, array());
			$Message = 'You found a voucher. <br><span style="color:#F30; font-weight:bold;">'.$VoucerCode.'</span>. You can use it on the <a href="https://play.warofgalaxyz.com/game.php?page=donation">purchase antimatter</a> page.';
			PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 1,
			'You found a voucher', $Message, TIMESTAMP, NULL, 1, $this->_fleet['fleet_universe']);
		}
	}
	
	function ReturnEvent()
	{
		$LNG	= $this->getLanguage(NULL, $this->_fleet['fleet_owner']);
		if($this->_fleet['fleet_resource_darkmatter'] > 0)
		{
			$message	= sprintf($LNG['sys_expe_back_home_with_dm'],
				$LNG['tech'][921],
				pretty_number($this->_fleet['fleet_resource_darkmatter']),
				$LNG['tech'][921]
			);

			$this->UpdateFleet('fleet_array', '220,0;');
		}
		else
		{
			$message	= $LNG['sys_expe_back_home_without_dm'];
		}

		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 15, $LNG['sys_mess_fleetback'],
			$message, $this->_fleet['fleet_end_time'], NULL, 1, $this->_fleet['fleet_universe']);

		$this->RestoreFleet();
	}
}