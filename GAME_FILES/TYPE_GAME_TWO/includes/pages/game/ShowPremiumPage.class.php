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

class ShowPremiumPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
		 
	}
	
	function KeyUpBuy($name,$count,$days)
	{	
		$db	= Database::get();

		$sql	= 'SELECT cost, factor, factorone, rangevalue, promotion FROM %%PREMIUMCALC%% WHERE name = :name;';
		$PremiumCalc = $db->selectSingle($sql, array(
		':name'	=> $name
		));

		$Cost		= $PremiumCalc['cost'] - ($PremiumCalc['cost'] / 100 * $PremiumCalc['promotion']);
		$Factor		= $PremiumCalc['factor'];
		$FactorOne	= $PremiumCalc['factorone'];
		$RangeValue	= $PremiumCalc['rangevalue'];

		if($FactorOne == 0){ 
				$this->printMessage("ERROR", true, array('game.php?page=premium', 2));
		}	
		
		$CostPerDay	= round($Cost * pow($Factor, (floor($count/$FactorOne))-$RangeValue) * $count);
		$Discount	= 1 - min(0.50, ($days * 0.5 / 100)) ;
		$FullCost	= round($days * $CostPerDay * $Discount);
		
		return $FullCost;
	}	

	function ext()
	{
		global $LNG, $resource, $USER, $PLANET, $USER;
	
		$item	     	= HTTP::_GP('item', '', UTF8_SUPPORT);
		$days	     	= HTTP::_GP('days', 0);
		$price 			= $this->KeyUpBuy($item,$USER[$item],$days);
		
		$account_before = array(
			$item					=> $USER[$item],
			$item.'_days'			=> $USER[$item.'_days'],
			'antimatter'			=> $USER['antimatter'],
			'antimatter_bought'		=> $USER['antimatter_bought'],
			'price'					=> $price,
		);
		
		if($item == "prem_batle_leveling" && $USER['prem_batle_leveling'] > 100 || $item == "prem_leveling" && $USER['prem_leveling'] > 100){
			$this->printMessage("You can unforthanly not extend this feature above the 100%", true, array('game.php?page=premium', 2));
		}
		
		if($item == "prem_prime_units"){
			$day			= ($days * 3600 + ($days * 3600 / 100 * Config::get()->special_donation_premium));	
		}else{
			$day			= ($days * 3600*24 + ($days * 3600*24 / 100 * Config::get()->special_donation_premium));
		}
		
		if($price <= 0 || $days <= 0){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}	
		
		switch($item){
			case ''.$item.'':
			if(($USER['antimatter'] + $USER['antimatter_bought']) < $price){
				$this->printMessage($LNG['premium_61'], true, array('game.php?page=premium', 2));
				die();
			}else{
				$this->widrawAm($price, $USER['id']);
				$db	= Database::get();
				$sql	= "UPDATE %%USERS%% SET ".$item."_days = ".$item."_days + :days WHERE id = :userId;";
				$db->update($sql, array(
					':days'			=> $day,
					':userId'       => $USER['id']
				));
				
				$sql	= 'SELECT '.$item.', '.$item.'_days, antimatter, antimatter_bought FROM %%USERS%% WHERE id = :userId;';
				$getUser = $db->selectSingle($sql, array(
					':userId'		=> $USER['id'],
				));
				$account_after = array(
					$item					=> $getUser[$item],
					$item.'_days'			=> $getUser[$item.'_days'],
					'antimatter'			=> $getUser['antimatter'],
					'antimatter_bought'		=> $getUser['antimatter_bought'],
					'price'					=> $price,
				);
				$LOG = new Logcheck(3);
				$LOG->username = $USER['username'];
				$LOG->pageLog = "page=premium [Extention]";
				$LOG->old = $account_before;
				$LOG->new = $account_after;
				$LOG->save();
			}
			break;
		}
	
		$this->printMessage($item." is succesfully activated for ".$days." more days", true, array('game.php?page=premium', 2));
		
	}
	
	
	function buy()
	{
		global $LNG, $resource, $USER, $PLANET, $USER;
				
		$item	     	= HTTP::_GP('item', '', UTF8_SUPPORT);
		$count	     	= HTTP::_GP('count', 0);
		$days	     	= HTTP::_GP('days', 0);
		$price 			= $this->KeyUpBuy($item,$count,$days);
		
		$account_before = array(
			$item					=> $USER[$item],
			$item.'_days'			=> $USER[$item.'_days'],
			'antimatter'			=> $USER['antimatter'],
			'antimatter_bought'		=> $USER['antimatter_bought'],
			'price'					=> $price,
		);
		
		if($item == "prem_res" && $count > 500){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_storage" && $count > 1000){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_s_build" && $count > 100){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_o_build" && $count > 100){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_button" && $count > 10){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_speed_button" && $count > 100){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_expedition" && $count > 500){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_count_expiditeon" && $count > 100){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_speed_expiditeon" && $count > 1000){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_moon_dextruct" && $count > 10){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_leveling" && $count > 100){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_batle_leveling" && $count > 100){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_bank_ally" && $count > 5){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_conveyors_l" && $count > 1000){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_conveyors_s" && $count > 1000){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_conveyors_t" && $count > 1000){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_prod_from_colly" && $count > 1000){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_moon_creat" && $count > 100){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif($item == "prem_fuel_consumption" && $count > 1000){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}

		if($item == "prem_prime_units"){
			$day			= TIMESTAMP + ($days * 3600 + ($days * 3600 / 100 * Config::get()->special_donation_premium));	
		}else{
			$day			= TIMESTAMP + ($days * 3600*24 + ($days * 3600*24 / 100 * Config::get()->special_donation_premium));
		}

		if($price <= 0 || $days <= 0 || $count < 0){
			PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page (values days: '.$days.' percent: '.$count.')', TIMESTAMP);
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}	
		
		switch($item){
			case ''.$item.'':
			if(($USER['antimatter'] + $USER['antimatter_bought']) < $price){
				$this->printMessage($LNG['premium_61'], true, array('game.php?page=premium', 2));
				die();
			}elseif($USER[$item.'_days'] > TIMESTAMP){
				$this->printMessage("You already have that bonus active", true, array('game.php?page=premium', 2));
				die();
			}else{
				$this->widrawAm($price, $USER['id']);
				$db	= Database::get();
				$sql	= "UPDATE %%USERS%% SET ".$item." = :count, ".$item."_days = :days WHERE id = :userId;";
				$db->update($sql, array(
					':count'	=> $count,
					':days'			=> $day,
					':userId'       => $USER['id']
				));
				
				$sql	= 'SELECT '.$item.', '.$item.'_days, antimatter, antimatter_bought FROM %%USERS%% WHERE id = :userId;';
				$getUser = $db->selectSingle($sql, array(
					':userId'		=> $USER['id'],
				));
				$account_after = array(
					$item					=> $getUser[$item],
					$item.'_days'			=> $getUser[$item.'_days'],
					'antimatter'			=> $getUser['antimatter'],
					'antimatter_bought'		=> $getUser['antimatter_bought'],
					'price'					=> $price,
				);
				$LOG = new Logcheck(3);
				$LOG->username = $USER['username'];
				$LOG->pageLog = "page=premium [New Purchase]";
				$LOG->old = $account_before;
				$LOG->new = $account_after;
				$LOG->save();
			}
			break;
		}		
		$this->printMessage($item."(".$count."%) is succesfully activated for ".$days." days", true, array('game.php?page=premium', 2));
	}
	
	
	function premReset(){
		global $LNG, $resource, $USER, $PLANET, $USER;
		$item	     	= HTTP::_GP('item', '', UTF8_SUPPORT);
	
		switch($item){
			case ''.$item.'':		
			$db	= Database::get();
			$sql	= "UPDATE %%USERS%% SET ".$item." = :count, ".$item."_days = :days WHERE id = :userId;";
			$db->update($sql, array(
				':count'	=> 0,
				':days'			=> 0,
				':userId'       => $USER['id']
			));
			break;
		}
		$this->sendJSON(array('msg' => $LNG['premium_63']));
	}
	
	
	function premResetInfo(){
		global $LNG, $resource, $USER, $PLANET, $USER;
		$item	     	= HTTP::_GP('item', '', UTF8_SUPPORT);
		$this->sendJSON(array('msg' => $LNG['premium_64'], 'done' => 1));
	}
	
	function getDbCost($Name){
		$sql	= "SELECT cost, promotion FROM %%PREMIUMCALC%% WHERE name = :name;";
		$costName = database::get()->selectSingle($sql, array(
			':name'	=> $Name
		));
		
		return $costName['cost'] - ($costName['cost'] / 100 * $costName['promotion']);
	}
	
	function show()
	{
		global $LNG, $resource, $USER, $PLANET, $USER;
		
		//if($USER['id'] != 1){
		//	$this->printMessage('This page is currently not accesible.', true, array('game.php?page=overview', 2));
		//}
		
		$this->tplObj->loadscript('premium.js'); 	
		$this->assign(array(
			'prem_res_cost' 			=> $this->getDbCost('prem_res'),
			'prem_storage_cost' 		=> $this->getDbCost('prem_storage'),
			'prem_s_build_cost' 		=> $this->getDbCost('prem_s_build'),
			'prem_o_build_cost' 		=> $this->getDbCost('prem_o_build'),
			'prem_button_cost' 			=> $this->getDbCost('prem_button'),
			'prem_speed_button_cost' 	=> $this->getDbCost('prem_speed_button'),
			'prem_expedition_cost'		=> $this->getDbCost('prem_expedition'),
			'prem_count_expiditeon_cost'=> $this->getDbCost('prem_count_expiditeon'),
			'prem_speed_expiditeon_cost'=> $this->getDbCost('prem_speed_expiditeon'),
			'prem_moon_dextruct_cost' 	=> $this->getDbCost('prem_moon_dextruct'),
			'prem_leveling_cost' 		=> $this->getDbCost('prem_leveling'),
			'prem_batle_leveling_cost' 	=> $this->getDbCost('prem_batle_leveling'),
			'prem_bank_ally_cost' 		=> $this->getDbCost('prem_bank_ally'),
			'prem_conveyors_l_cost' 	=> $this->getDbCost('prem_conveyors_l'),
			'prem_conveyors_s_cost' 	=> $this->getDbCost('prem_conveyors_s'),
			'prem_conveyors_t_cost' 	=> $this->getDbCost('prem_conveyors_t'),
			'prem_prod_from_colly_cost' => $this->getDbCost('prem_prod_from_colly'),
			'prem_moon_creat_cost' 		=> $this->getDbCost('prem_moon_creat'),
			'prem_fuel_consumption_cost'=> $this->getDbCost('prem_fuel_consumption'),
			'prem_prime_units_cost'		=> $this->getDbCost('prem_prime_units'), 
			'prem_transate_player_cost' => $this->getDbCost('prem_transate_player'),
			
			
			'prem_res_promo'			=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_res', array('promotion')),
			'prem_storage_promo'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_storage', array('promotion')),
			'prem_s_build_promo'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_s_build', array('promotion')),
			'prem_o_build_promo'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_o_build', array('promotion')),
			'prem_button_promo'			=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_button', array('promotion')),
			'prem_speed_button_promo'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_speed_button', array('promotion')),
			'prem_expedition_promo'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_expedition', array('promotion')),
			'prem_count_expiditeon_promo'=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_count_expiditeon', array('promotion')),
			'prem_speed_expiditeon_promo'=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_speed_expiditeon', array('promotion')),
			'prem_moon_dextruct_promo'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_moon_dextruct', array('promotion')),
			'prem_leveling_promo'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_leveling', array('promotion')),
			'prem_batle_leveling_promo'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_batle_leveling', array('promotion')),
			'prem_bank_ally_promo'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_bank_ally', array('promotion')),
			'prem_prod_from_colly_promo'=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_prod_from_colly', array('promotion')),
			'prem_moon_creat_promo'		=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_moon_creat', array('promotion')),
			'prem_conveyors_l_promo'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_conveyors_l', array('promotion')),
			'prem_conveyors_s_promo'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_conveyors_s', array('promotion')),
			'prem_conveyors_t_promo'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_conveyors_t', array('promotion')),
			'prem_fuel_consumption_promo'=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_fuel_consumption', array('promotion')),
			'prem_prime_units_promo'	=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_prime_units', array('promotion')),
			'prem_transate_player_promo'=> GetFromDatabase('PREMIUMCALC', 'name', 'prem_transate_player', array('promotion')),
			
			'stardust_cost' 			=> 100000 - (100000 / 100 * Config::get()->special_donation_stardust),
			'stardust' 					=> $USER['stardust'],
			'prem_res' 					=> $USER['prem_res'],
			'prem_res_days' 			=> ((!empty($USER['prem_res_days']) && $USER['prem_res_days'] > TIMESTAMP) ? ($USER['prem_res_days'] - TIMESTAMP) : 0),
			'prem_storage' 				=> $USER['prem_storage'],
			'prem_storage_days' 		=> ((!empty($USER['prem_storage_days']) && $USER['prem_storage_days'] > TIMESTAMP) ? ($USER['prem_storage_days'] - TIMESTAMP) : 0),
			'prem_s_build' 				=> $USER['prem_s_build'],
			'prem_s_build_days' 		=> ((!empty($USER['prem_s_build_days']) && $USER['prem_s_build_days'] > TIMESTAMP) ? ($USER['prem_s_build_days'] - TIMESTAMP) : 0),
			'prem_o_build' 				=> $USER['prem_o_build'],
			'prem_o_build_days' 		=> ((!empty($USER['prem_o_build_days']) && $USER['prem_o_build_days'] > TIMESTAMP) ? ($USER['prem_o_build_days'] - TIMESTAMP) : 0),
			'prem_button' 				=> $USER['prem_button'],
			'prem_button_days' 			=> ((!empty($USER['prem_button_days']) && $USER['prem_button_days'] > TIMESTAMP) ? ($USER['prem_button_days'] - TIMESTAMP) : 0),
			'prem_speed_button' 		=> $USER['prem_speed_button'],
			'prem_speed_button_days' 	=> ((!empty($USER['prem_speed_button_days']) && $USER['prem_speed_button_days'] > TIMESTAMP) ? ($USER['prem_speed_button_days'] - TIMESTAMP) : 0),
			'prem_expedition' 			=> $USER['prem_expedition'],
			'prem_expedition_days' 		=> ((!empty($USER['prem_expedition_days']) && $USER['prem_expedition_days'] > TIMESTAMP) ? ($USER['prem_expedition_days'] - TIMESTAMP) : 0),
			'prem_count_expiditeon' 	=> $USER['prem_count_expiditeon'],
			'prem_count_expiditeon_days'=> ((!empty($USER['prem_count_expiditeon_days']) && $USER['prem_count_expiditeon_days'] > TIMESTAMP) ? ($USER['prem_count_expiditeon_days'] - TIMESTAMP) : 0),
			'prem_speed_expiditeon' 	=> $USER['prem_speed_expiditeon'],
			'prem_speed_expiditeon_days' => ((!empty($USER['prem_speed_expiditeon_days']) && $USER['prem_speed_expiditeon_days'] > TIMESTAMP) ? ($USER['prem_speed_expiditeon_days'] - TIMESTAMP) : 0),
			'prem_moon_dextruct' 		=> $USER['prem_moon_dextruct'],
			'prem_moon_dextruct_days' 	=> ((!empty($USER['prem_moon_dextruct_days']) && $USER['prem_moon_dextruct_days'] > TIMESTAMP) ? ($USER['prem_moon_dextruct_days'] - TIMESTAMP) : 0),
			'prem_leveling' 			=> $USER['prem_leveling'],
			'prem_leveling_days' 		=> ((!empty($USER['prem_leveling_days']) && $USER['prem_leveling_days'] > TIMESTAMP) ? ($USER['prem_leveling_days'] - TIMESTAMP) : 0),
			'prem_batle_leveling' 		=> $USER['prem_batle_leveling'],
			'prem_batle_leveling_days' 	=> ((!empty($USER['prem_batle_leveling_days']) && $USER['prem_batle_leveling_days'] > TIMESTAMP) ? ($USER['prem_batle_leveling_days'] - TIMESTAMP) : 0),
			'prem_bank_ally' 			=> $USER['prem_bank_ally'],
			'prem_bank_ally_days' 		=> ((!empty($USER['prem_bank_ally_days']) && $USER['prem_bank_ally_days'] > TIMESTAMP) ? ($USER['prem_bank_ally_days'] - TIMESTAMP) : 0),
			'prem_conveyors_l' 			=> $USER['prem_conveyors_l'],
			'prem_conveyors_l_days' 	=> ((!empty($USER['prem_conveyors_l_days']) && $USER['prem_conveyors_l_days'] > TIMESTAMP) ? ($USER['prem_conveyors_l_days'] - TIMESTAMP) : 0),
			'prem_conveyors_s' 			=> $USER['prem_conveyors_s'],
			'prem_conveyors_s_days' 	=> ((!empty($USER['prem_conveyors_s_days']) && $USER['prem_conveyors_s_days'] > TIMESTAMP) ? ($USER['prem_conveyors_s_days'] - TIMESTAMP) : 0),
			'prem_conveyors_t' 			=> $USER['prem_conveyors_t'],
			'prem_conveyors_t_days' 	=> ((!empty($USER['prem_conveyors_t_days']) && $USER['prem_conveyors_t_days'] > TIMESTAMP) ? ($USER['prem_conveyors_t_days'] - TIMESTAMP) : 0),
			'prem_prod_from_colly' 		=> $USER['prem_prod_from_colly'],
			'prem_prod_from_colly_days' => ((!empty($USER['prem_prod_from_colly_days']) && $USER['prem_prod_from_colly_days'] > TIMESTAMP) ? ($USER['prem_prod_from_colly_days'] - TIMESTAMP) : 0),
			'prem_moon_creat' 			=> $USER['prem_moon_creat'],
			'prem_moon_creat_days' 		=> ((!empty($USER['prem_moon_creat_days']) && $USER['prem_moon_creat_days'] > TIMESTAMP) ? ($USER['prem_moon_creat_days'] - TIMESTAMP) : 0),
			'prem_fuel_consumption' 	=> $USER['prem_fuel_consumption'],
			'prem_fuel_consumption_days'=> ((!empty($USER['prem_fuel_consumption_days']) && $USER['prem_fuel_consumption_days'] > TIMESTAMP) ? ($USER['prem_fuel_consumption_days'] - TIMESTAMP) : 0),
			'prem_prime_units' 			=> $USER['prem_prime_units'],
			'prem_prime_units_days' 	=> ((!empty($USER['prem_prime_units_days']) && $USER['prem_prime_units_days'] > TIMESTAMP) ? ($USER['prem_prime_units_days'] - TIMESTAMP) : 0),
			'prem_transate_player' 			=> $USER['prem_transate_player'],
			'prem_transate_player_days' 	=> ((!empty($USER['prem_transate_player_days']) && $USER['prem_transate_player_days'] > TIMESTAMP) ? ($USER['prem_transate_player_days'] - TIMESTAMP) : 0),
		));
		 
		$this->display('page.premium.default.tpl');
	}
	
	function buystardust()
	{
		global $LNG, $resource, $USER, $PLANET;
	
		
		$stardust = HTTP::_GP('stardust', 0);
		$price = (100000 - (100000 / 100 * Config::get()->special_donation_stardust)) * $stardust;
		
		$account_before = array(
			'stardust'				=> $USER['stardust'],
			'antimatter'			=> $USER['antimatter'],
			'antimatter_bought'		=> $USER['antimatter_bought'],
			'price'					=> $price,
		);
		
		if ($price < 0) {
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif(($USER['antimatter'] + $USER['antimatter_bought']) < $price){
			$this->printMessage($LNG['premium_61'], true, array('game.php?page=premium', 2));
			die();
		}elseif($stardust < 0){
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
			die();
		}else{
			$this->widrawAm($price, $USER['id']);
			$db	= Database::get();
			$sql	= "UPDATE %%USERS%% SET stardust = stardust + :stardust WHERE id = :userId;";
			$db->update($sql, array(
				':stardust'		=> $stardust,
				':userId'       => $USER['id']
			));
			
			$sql	= 'SELECT stardust, antimatter, antimatter_bought FROM %%USERS%% WHERE id = :userId;';
			$getUser = $db->selectSingle($sql, array(
				':userId'		=> $USER['id'],
			));
			$account_after = array(
				'stardust'				=> $getUser['stardust'],
				'antimatter'			=> $getUser['antimatter'],
				'antimatter_bought'		=> $getUser['antimatter_bought'],
				'price'					=> $price,
			);
			$LOG = new Logcheck(3);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=premium [Stardust]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
		}
		$this->printMessage('Stardust has succesfully be bought', true, array('game.php?page=premium', 2));
		 
	}
	
	
	/* function buybox()
	{
		global $LNG, $resource, $USER, $PLANET;

		
		$darkcontainer 	= HTTP::_GP('box_count', 0);
		$price 			= 5000 * $darkcontainer;
		
		
		if ($price < 0) {
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
		}elseif(($USER['antimatter'] + $USER['antimatter_bought']) < $price){
			$this->printMessage($LNG['premium_61'], true, array('game.php?page=premium', 2));
			die();
		}elseif($darkcontainer < 0){
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=premium', 2));
			die();
		}else{
			
			$peace_experience  = 0;
			$combat_experience  = 0;
			$upgrades  = 0;
			$userdarkmatter  = 0;
			$academy  = 0;
			$stellar  = 0;
			$m7  = 0;
			$m19  = 0;
			$m32  = 0;
			$ampur  = 0;
			$stela  = 0;
			$resss  = 0;
			
			$account_before = array(
				//USER
				'peacefull_exp_current'	=> $USER['peacefull_exp_current'],
				'combat_exp_current'	=> $USER['combat_exp_current'],
				'academy_points'		=> $USER['academy_p'],
				'stellar_ore'			=> $USER['stellar_ore'],
				'darkmatter'			=> $USER['darkmatter'],
				'antimatter'			=> $USER['antimatter'],
				'antimatter_bought'		=> $USER['antimatter_bought'],
				'loyality_points'		=> $USER['loyality_points'],
				//PLANET
				'M7'					=> $PLANET['m7'],
				'M19'					=> $PLANET['m19'],
				'M32'					=> $PLANET['m32'],
				'metal'					=> $PLANET['metal'],
				'crystal'				=> $PLANET['crystal'],
				'deuterium'				=> $PLANET['deuterium'],
				//ARSENAL
				'arsenal_laser'			=> $USER['arsenal_laser'],
				'arsenal_ion'			=> $USER['arsenal_ion'],
				'arsenal_plasma'		=> $USER['arsenal_plasma'],
				'arsenal_gravity'		=> $USER['arsenal_gravity'],
				'arsenal_dlight'		=> $USER['arsenal_dlight'],
				'arsenal_dmedium'		=> $USER['arsenal_dmedium'],
				'arsenal_dheavy'		=> $USER['arsenal_dheavy'],
				'arsenal_slight'		=> $USER['arsenal_slight'],
				'arsenal_smedium'		=> $USER['arsenal_smedium'],
				'arsenal_sheavy'		=> $USER['arsenal_sheavy'],
				'arsenal_combustion'	=> $USER['arsenal_combustion'],
				'arsenal_impulse'		=> $USER['arsenal_impulse'],
				'arsenal_hyperspace'	=> $USER['arsenal_hyperspace'],
				'arsenal_res901'		=> $USER['arsenal_res901'],
				'arsenal_res902'		=> $USER['arsenal_res902'],
				'arsenal_res903'		=> $USER['arsenal_res903'],
				'arsenal_conveyor1'		=> $USER['arsenal_conveyor1'],
				'arsenal_conveyor2'		=> $USER['arsenal_conveyor2'],
				'arsenal_conveyor3'		=> $USER['arsenal_conveyor3'],
				//PRICE
				'price'					=> $price,
			);

			$msg = "";
			$metalsBB		= 0;
			$crystalBB		= 0;
			$deutBB			= 0;
			for($i = 1; $i <= $darkcontainer; $i++)
			{
				$allowedWin = array(801,802,803,804,805,806,807,808,809,810,811,812,813,814,815,816,817,818,819);	
				$selectWin = mt_rand(0,18);
				$allowedRes = array(901,902,903);
				$selectRes = mt_rand(0,2);
				$eventSize		= mt_rand(0, 100);
				$msg .="";
				if(0 == $eventSize)
				{
					$peace_experience	+= mt_rand(3500,8000);
				}elseif(0 < $eventSize && 10 >= $eventSize)
				{
					$peace_experience	+= mt_rand(2500,4000);
				}elseif(10 < $eventSize && 60 >= $eventSize)
				{
					$peace_experience	+= mt_rand(1200,1900);
				}elseif(60 > $eventSize)
				{
					$peace_experience	+= mt_rand(800,1500);
				}else
				{
					$peace_experience	+= mt_rand(400,750);
				}
				
				$combatSize		= mt_rand(0, 100);
				if(0 == $combatSize)
				{
					$combat_experience	+= mt_rand(3500,8000);
				}elseif(0 < $combatSize && 10 >= $combatSize)
				{
					$combat_experience	+= mt_rand(2500,4000);
				}elseif(10 < $combatSize && 60 >= $combatSize)
				{
					$combat_experience	+= mt_rand(1200,1900);
				}elseif(60 > $combatSize)
				{
					$combat_experience	+= mt_rand(800,1500);
				}else
				{
					$combat_experience	+= mt_rand(400,750);
				}
				
				$AcademySize		= mt_rand(0, 100);
				if(0 == $AcademySize)
				{
					$academy	+= 50;
				}elseif(0 < $AcademySize && 10 >= $AcademySize)
				{
					$academy	+= 25;
				}elseif(10 < $AcademySize && 40 >= $AcademySize)
				{
					$academy	+= 15;
				}elseif(40 > $AcademySize)
				{
					$academy	+= 5;
				}else
				{
					$academy	+= 0;
				}
				
				$DMSize		= mt_rand(0, 100);
				if(0 == $DMSize)
				{
					$userdarkmatter	+= 5000000;
				}elseif(0 < $DMSize && 10 >= $DMSize)
				{
					$userdarkmatter	+= 2000000;
				}elseif(10 < $DMSize && 30 >= $DMSize)
				{
					$userdarkmatter	+= 1000000;
				}elseif(30 > $DMSize)
				{
					$userdarkmatter	+= 500000;
				}else
				{
					$userdarkmatter	+= 0;
				}
				
				$UPGSize		= mt_rand(0, 100);
				if(0 == $UPGSize)
				{
					$upgrades	= 10;
					$msg .= '<li>'.$LNG['premium_8'].': '.pretty_number($upgrades).' '.$LNG['tech'][$allowedWin[$selectWin]].'</li>';	
					$db	= Database::get();
					$sql	= "UPDATE %%USERS%% SET ".$resource[$allowedWin[$selectWin]]." = ".$resource[$allowedWin[$selectWin]]." + :upgrade WHERE id = :userId;";
					$db->update($sql, array(
						':upgrade'	=> $upgrades,
						':userId'       => $USER['id']
					));
				}elseif(0 < $UPGSize && 10 >= $UPGSize)
				{
					$upgrades	= 5;
					$msg .= '<li>'.$LNG['premium_8'].': '.pretty_number($upgrades).' '.$LNG['tech'][$allowedWin[$selectWin]].'</li>';	
					$db	= Database::get();
					$sql	= "UPDATE %%USERS%% SET ".$resource[$allowedWin[$selectWin]]." = ".$resource[$allowedWin[$selectWin]]." + :upgrade WHERE id = :userId;";
					$db->update($sql, array(
						':upgrade'	=> $upgrades,
						':userId'       => $USER['id']
					));
				}elseif(10 < $UPGSize && 30 >= $UPGSize)
				{
					$upgrades	= 2;
					$msg .= '<li>'.$LNG['premium_8'].': '.pretty_number($upgrades).' '.$LNG['tech'][$allowedWin[$selectWin]].'</li>';	
					$db	= Database::get();
					$sql	= "UPDATE %%USERS%% SET ".$resource[$allowedWin[$selectWin]]." = ".$resource[$allowedWin[$selectWin]]." + :upgrade WHERE id = :userId;";
					$db->update($sql, array(
						':upgrade'	=> $upgrades,
						':userId'       => $USER['id']
					));
				}elseif(30 > $UPGSize)
				{
					$upgrades	= 1;
					$msg .= '<li>'.$LNG['premium_8'].': '.pretty_number($upgrades).' '.$LNG['tech'][$allowedWin[$selectWin]].'</li>';	
					$db	= Database::get();
					$sql	= "UPDATE %%USERS%% SET ".$resource[$allowedWin[$selectWin]]." = ".$resource[$allowedWin[$selectWin]]." + :upgrade WHERE id = :userId;";
					$db->update($sql, array(
						':upgrade'	=> $upgrades,
						':userId'       => $USER['id']
					)); 
				}else
				{
					$upgrades	= 0;
				}
				
				
				$resSize		= mt_rand(0, 100);
				
				
				if(0 == $resSize)
				{
					$resss	= 50000000000;
					$PLANET[$resource[$allowedRes[$selectRes]]] += $resss;
					if($selectRes == 0){
						$metalsBB += $resss;
					}elseif($selectRes == 1){
						$crystalBB += $resss;
					}else{
						$deutBB += $resss;
					}
					$msg .= '<li>'.$LNG['premium_7'].': '.pretty_number($resss).' '.$LNG['tech'][$allowedRes[$selectRes]].'</li>';	
				}elseif(0 < $resSize && 10 >= $resSize)
				{
					$resss	= 25000000000;
					$PLANET[$resource[$allowedRes[$selectRes]]] += $resss;
					if($selectRes == 0){
						$metalsBB += $resss;
					}elseif($selectRes == 1){
						$crystalBB += $resss;
					}else{
						$deutBB += $resss;
					}
					$msg .= '<li>'.$LNG['premium_7'].': '.pretty_number($resss).' '.$LNG['tech'][$allowedRes[$selectRes]].'</li>';	
				}elseif(10 < $resSize && 30 >= $resSize)
				{
					$resss	= 10000000000;
					if($selectRes == 0){
						$metalsBB += $resss;
					}elseif($selectRes == 1){
						$crystalBB += $resss;
					}else{
						$deutBB += $resss;
					}
					$PLANET[$resource[$allowedRes[$selectRes]]] += $resss;
					$msg .= '<li>'.$LNG['premium_7'].': '.pretty_number($resss).' '.$LNG['tech'][$allowedRes[$selectRes]].'</li>';	
				}elseif(30 > $resSize)
				{
					$resss	= 5000000000;
					if($selectRes == 0){
						$metalsBB += $resss;
					}elseif($selectRes == 1){
						$crystalBB += $resss;
					}else{
						$deutBB += $resss;
					}
					$PLANET[$resource[$allowedRes[$selectRes]]] += $resss;
					$msg .= '<li>'.$LNG['premium_7'].': '.pretty_number($resss).' '.$LNG['tech'][$allowedRes[$selectRes]].'</li>';	
				}else
				{
					$resss	= 0;
				}
				
				$AMBon		= mt_rand(0, 100);
				if(0 == $AMBon)
				{
					$ampur	+= 5;
				}elseif(0 < $AMBon && 3 >= $AMBon)
				{
					$ampur	+= 2;
				}elseif(3 < $AMBon && 5 >= $AMBon)
				{
					$ampur	+= 1;
				}else
				{
					$ampur	+= 0;
				}
				
				$STEBon		= mt_rand(0, 100);
				if(0 == $STEBon)
				{
					$stela	+= 5;
				}elseif(0 < $STEBon && 3 >= $STEBon)
				{
					$stela	+= 2;
				}elseif(3 < $STEBon && 5 >= $STEBon)
				{
					$stela	+= 1;
				}else
				{
					$stela	+= 0;
				}
				
				$M7Bon		= mt_rand(0, 100);
				if(0 == $M7Bon)
				{
					$m7	+= 10000000;
				}elseif(0 < $M7Bon && 5 >= $M7Bon)
				{
					$m7	+= 5000000;
				}elseif(5 < $M7Bon && 10 >= $M7Bon)
				{
					$m7	+= 2500000;
				}elseif(10 < $M7Bon && 15>= $M7Bon)
				{
					$m7	+= 1000000;
				}else
				{
					$m7	+= 0;
				}
				
				$M19Bon		= mt_rand(0, 100);
				if(0 == $M19Bon)
				{
					$m19	+= 5000000;
				}elseif(0 < $M19Bon && 5 >= $M19Bon)
				{
					$m19	+= 2500000;
				}elseif(5 < $M19Bon && 10 >= $M19Bon)
				{
					$m19	+= 1000000;
				}elseif(10 < $M19Bon && 15>= $M19Bon)
				{
					$m19	+= 500000;
				}else
				{
					$m19	+= 0;
				}
				
				$M32Bon		= mt_rand(0, 100);
				if(0 == $M32Bon)
				{
					$m32	+= 451000;
				}elseif(0 < $M32Bon && 5 >= $M32Bon)
				{
					$m32	+= 255000;
				}elseif(5 < $M32Bon && 10 >= $M32Bon)
				{
					$m32	+= 146000;
				}elseif(10 < $M32Bon && 15>= $M32Bon)
				{
					$m32	+= 75000;
				}else
				{
					$m32	+= 0;
				}
			}
				if($peace_experience > 0){
					$msg .= '<li>'.$LNG['premium_3'].': '.pretty_number($peace_experience).'</li>';	
				}
				if($combat_experience > 0){
					$msg .= '<li>'.$LNG['premium_4'].': '.pretty_number($combat_experience).'</li>';	
				}
				//$msg .= '<li>Metal: 1.087</li>';
				//$msg .= '<li>Upgrade imulse engine: 1.087</li>';
				if($userdarkmatter > 0){
					$msg .= '<li>'.$LNG['tech'][921].': '.pretty_number($userdarkmatter).'</li>';	
				}
				if($academy > 0){
					$msg .= '<li>'.$LNG['premium_5'].': '.pretty_number($academy).'</li>';	
				}
				if($m7 > 0){
					$msg .= '<li>'.$LNG['premium_9'].': '.pretty_number($m7).'</li>';	
				}
				if($m19 > 0){
					$msg .= '<li>'.$LNG['premium_10'].': '.pretty_number($m19).'</li>';	
				}
				if($m32 > 0){
					$msg .= '<li>'.$LNG['premium_11'].': '.pretty_number($m32).'</li>';	
				}
				if($ampur > 0){
					$msg .= '<li>'.$LNG['premium_12'].': '.pretty_number($ampur).'%</li>';	
				}
				if($stela > 0){
					$msg .= '<li>'.$LNG['premium_13'].': '.pretty_number($stela).'</li>';	
				}
				//$msg .= '<li>Stellar dust: 1.087</li>';	
				//$msg .= '<li>M-7: 1.087</li>';	
				//$msg .= '<li>M-19: 1.087</li>';	
				//$msg .= '<li>M-32: 1.087</li>';	
			
				$this->widrawAm($price, $USER['id']);
				$USER['darkmatter'] += $userdarkmatter;
				$db	= Database::get();
				$sql	= "UPDATE %%USERS%% SET darkmatter = darkmatter + :userdarkmatter, stellar_ore = stellar_ore + :stellar_ore, loyality_points = loyality_points + :loyality_points, combat_exp_current = combat_exp_current + :combat_exp_current, peacefull_exp_current = peacefull_exp_current + :peacefull_exp_current, academy_p = academy_p + :academy_p WHERE id = :userId;";
				$db->update($sql, array(
					':userdarkmatter'	=> $userdarkmatter,
					':stellar_ore'	=> $stela,
					':loyality_points'	=> $ampur,
					':combat_exp_current'	=> $combat_experience,
					':peacefull_exp_current'	=> $peace_experience,
					':academy_p'	=> $academy,
					':userId'       => $USER['id']
				)); 

				
				$sql	= "UPDATE %%PLANETS%% SET m7 = m7 + :m7, m19 = m19 + :m19, m32 = m32 + :m32, metal = metal + :metal, crystal = crystal + :crystal, deuterium = deuterium + :deuterium WHERE id = :planetId;";
				Database::get()->update($sql, array(
					':metal'	=> $metalsBB,
					':crystal'	=> $crystalBB,
					':deuterium'	=> $deutBB,
					':m7'	=> $m7,
					':m19'	=> $m19,
					':m32'	=> $m32,
					':planetId'	=> $PLANET['id']
				));
				$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
				$getUser = $db->selectSingle($sql, array(
					':userId'		=> $USER['id'],
				));
				$sql	= 'SELECT * FROM %%PLANETS%% WHERE id = :planetId;';
				$getPlanet = $db->selectSingle($sql, array(
					':planetId'		=> $PLANET['id'],
				));
				$account_after = array(
					//USER
					'peacefull_exp_current'	=> $getUser['peacefull_exp_current'],
					'combat_exp_current'	=> $getUser['combat_exp_current'],
					'academy_points'		=> $getUser['academy_p'],
					'stellar_ore'			=> $getUser['stellar_ore'],
					'darkmatter'			=> $getUser['darkmatter'],
					'antimatter'			=> $getUser['antimatter'],
					'antimatter_bought'		=> $getUser['antimatter_bought'],
					'loyality_points'		=> $getUser['loyality_points'],
					//PLANET
					'M7'					=> $getPlanet['m7'],
					'M19'					=> $getPlanet['m19'],
					'M32'					=> $getPlanet['m32'],
					'metal'					=> $getPlanet['metal'],
					'crystal'				=> $getPlanet['crystal'],
					'deuterium'				=> $getPlanet['deuterium'],
					//ARSENAL
					'arsenal_laser'			=> $getUser['arsenal_laser'],
					'arsenal_ion'			=> $getUser['arsenal_ion'],
					'arsenal_plasma'		=> $getUser['arsenal_plasma'],
					'arsenal_gravity'		=> $getUser['arsenal_gravity'],
					'arsenal_dlight'		=> $getUser['arsenal_dlight'],
					'arsenal_dmedium'		=> $getUser['arsenal_dmedium'],
					'arsenal_dheavy'		=> $getUser['arsenal_dheavy'],
					'arsenal_slight'		=> $getUser['arsenal_slight'],
					'arsenal_smedium'		=> $getUser['arsenal_smedium'],
					'arsenal_sheavy'		=> $getUser['arsenal_sheavy'],
					'arsenal_combustion'	=> $getUser['arsenal_combustion'],
					'arsenal_impulse'		=> $getUser['arsenal_impulse'],
					'arsenal_hyperspace'	=> $getUser['arsenal_hyperspace'],
					'arsenal_res901'		=> $getUser['arsenal_res901'],
					'arsenal_res902'		=> $getUser['arsenal_res902'],
					'arsenal_res903'		=> $getUser['arsenal_res903'],
					'arsenal_conveyor1'		=> $getUser['arsenal_conveyor1'],
					'arsenal_conveyor2'		=> $getUser['arsenal_conveyor2'],
					'arsenal_conveyor3'		=> $getUser['arsenal_conveyor3'],
					//PRICE
					'price'					=> $price,
				);
				
				$LOG = new Logcheck(3);
				$LOG->username = $USER['username'];
				$LOG->pageLog = "page=premium [Dark Container]";
				$LOG->old = $account_before;
				$LOG->new = $account_after;
				$LOG->save();
		}
		//$this->printMessage('Вы получили:<br><ul><li>Мирный опыт: 1.087</li><li>Боевой опыт: 150</li><li>Металл: 40.000.000.000</li><li>Апгрейд Импульсный двигатель: 1</li></ul>', true, array('game.php?page=premium', 3));
		$this->printMessage($LNG['bonus_receive'].':<br><ul>'.$msg.'</ul>', true, array('game.php?page=premium', 8));
		 
	} */



}
