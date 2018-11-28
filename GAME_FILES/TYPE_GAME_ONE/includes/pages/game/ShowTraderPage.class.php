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


class ShowTraderPage extends AbstractGamePage
{
	public static $requireModule = MODULE_TRADER;

	function __construct() 
	{
		parent::__construct();
	}
	
	public static $Charge = array(
		901	=> array(901 => 1, 902 => 2, 903 => 4),
		902	=> array(901 => 0.5, 902 => 1, 903 => 2),
		903	=> array(901 => 0.25, 902 => 0.5, 903 => 1),
	);
	
	public static $ChargeForAntimatter = array(
		922	=> array(921 => 0.00572),
	);
	
	public static $ChargeForHonor = array(
		'honor'	=> array(922 => 15000),
	);
	
	public static $ChargeForDarkmatter = array(
		921	=> array(901 => 0.000025, 902 => 0.00005, 903 => 0.0001),
	);
	
	public function show() 
	{
		global $LNG, $USER, $resource;

		$darkmatter_cost_trader	= Config::get()->darkmatter_cost_trader;
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=overview');
		$this->assign(array(
			'tr_cost_dm_trader'		=> sprintf($LNG['tr_cost_dm_trader'], pretty_number($darkmatter_cost_trader), $LNG['tech'][921]),
			'charge'				=> self::$Charge,
			'resource'				=> $resource,
			'requiredDarkMatter'	=> $USER['darkmatter'] < $darkmatter_cost_trader ? sprintf($LNG['tr_not_enought'], $LNG['tech'][921]) : false,
		));
		
		$this->display("page.trader.default.tpl");
	}
	
	public function obmen() 
	{
		global $USER, $LNG;

		$resourceID	= 922;
		
		if(!in_array($resourceID, array_keys(self::$ChargeForAntimatter))) {
			$this->printMessage($LNG['invalid_action'], true, array('game.php?page=overview', 2));
		}
		
		$tradeResources	= array_values(array_diff(array_keys(self::$ChargeForAntimatter[$resourceID]), array($resourceID)));
		$this->tplObj->loadscript("trader.js");
		$this->assign(array(
			'tradeResourceID'	=> $resourceID,
			'tradeResources'	=> $tradeResources,
			'am'				=> ($USER['antimatter'] + $USER['antimatter_bought']),
			'ChargeForAntimatter' 			=> self::$ChargeForAntimatter[$resourceID],
		));
		
		$this->display("page.trader.antimatter.tpl");
	}
	
	public function honor() 
	
	{
		global $USER, $LNG;

		$resourceID	= 'honor';
		
		if(!in_array($resourceID, array_keys(self::$ChargeForHonor))) {
			$this->printMessage($LNG['invalid_action'], true, array('game.php?page=overview', 2));
		}
		
		$tradeResources	= array_values(array_diff(array_keys(self::$ChargeForHonor['honor']), array('honor')));
		$this->tplObj->loadscript("trader.js");
		$this->assign(array(
			'tradeResourceID'	=> 'honor',
			'tradeResources'	=> $tradeResources,
			'am'				=> $USER['antimatter'],
			'ChargeForHonor' 	=> self::$ChargeForHonor['honor'],
			'honorAmount' 		=> $USER['honour_points'],
		));
		
		$this->display("page.trader.honor.tpl");
	}
	
	public function tradetm() 
	{
		global $USER, $LNG;

		$resourceID	= 921;
		
		if(!in_array($resourceID, array_keys(self::$ChargeForDarkmatter))) {
			$this->printMessage($LNG['invalid_action'], true, array('game.php?page=overview', 2));
		}
		$darkmatter_cost_trader	= Config::get()->darkmatter_cost_trader;
		$tradeResources	= array_values(array_diff(array_keys(self::$ChargeForDarkmatter[$resourceID]), array($resourceID)));
		$this->tplObj->loadscript("trader.js");
		$this->assign(array(
			'tradeResourceID'	=> $resourceID,
			'tradeResources'	=> $tradeResources,
			'dm'				=> $USER['darkmatter'],
			'needDm'				=> sprintf($LNG['trader_cost'],$darkmatter_cost_trader),
			'ChargeForDarkmatter' 			=> self::$ChargeForDarkmatter[$resourceID],
		));
		
		$this->display("page.trader.darkmatter.tpl");
	}
	
	function honorsend()
	{
		global $USER, $PLANET, $LNG, $resource;
		
		
		$resourceID	= 'honor';
		
		
		if(!in_array($resourceID, array_keys(self::$ChargeForHonor))) {
			$this->printMessage($LNG['invalid_action'], true, array('game.php?page=overview', 2));
		}

		$getTradeResources	= HTTP::_GP('tm', 0);
		
		$account_before = array(
			'antimatter'			=> $USER['antimatter'],
			'honour_points'			=> $USER['honour_points'],
			'Input'					=> $getTradeResources,
		);
		
		$getTradeResources = round($getTradeResources);
		$tradeAmount	= max(0, round((float) $getTradeResources));
		$usedResources	= round($tradeAmount * 15000);
		
		if($usedResources < 1){
			$this->printMessage($LNG['invalid_action'], true, array('game.php?page=overview', 2));
		}elseif($USER['honour_points'] < 1){
			$this->printMessage($LNG['invalid_action'], true, array('game.php?page=overview', 2));
		}else{
		
			if($usedResources > $USER['honour_points']){
			$tradeAmount	= max(0, round((float) 1/15000*$USER['honour_points']));
			$usedResources	= $USER['honour_points'];
			}
			
			$USER[$resource[922]]		+= $tradeAmount;
			$db	= Database::get();
			$sql	= "UPDATE %%USERS%% SET honour_points = honour_points - :honour_points, antimatter = antimatter + :tradeAmount WHERE id = :userId;";
			$db->update($sql, array(
				':tradeAmount'		=> $tradeAmount,
				':honour_points'	=> $usedResources,
				':userId'       => $USER['id']
			)); 
			
			$sql	= 'SELECT antimatter, honour_points FROM %%USERS%% WHERE id = :userId;';
			$getUser = $db->selectSingle($sql, array(
				':userId'		=> $USER['id'],
			));
			
			$account_after = array(
				'antimatter'			=> $getUser['antimatter'],
				'honour_points'			=> $getUser['honour_points'],
				'Input'					=> $getTradeResources,
			);
			
			$LOG = new Logcheck(11);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=trader [Trade Honor Points]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
			
			
			$this->printMessage($LNG['tr_exchange_done'], true, array('game.php?page=trader&mode=honor', 2));
		}
	}
	
	
	function obmenatm()
	{
		global $USER, $PLANET, $LNG, $resource;
		
		
		$resourceID	= 922;
		
		if(!in_array($resourceID, array_keys(self::$ChargeForAntimatter))) {
			$this->printMessage($LNG['invalid_action'], true, array('game.php?page=overview', 2));
		}
		
		$getTradeResources	= HTTP::_GP('tm', 0);
		$getTradeResources = round($getTradeResources);
		$tradeAmount	= max(0, round((float) $getTradeResources));
		$usedResources	= round($tradeAmount * 0.00572);
		
		$account_before = array(
			'antimatter'			=> $USER['antimatter'],
			'antimatter_bought'		=> $USER['antimatter_bought'],
			'darkmatter'			=> $USER['darkmatter'],
			'Input'					=> $getTradeResources,
		);
		
		if($usedResources < 1){
			$this->printMessage($LNG['invalid_action'], true, array('game.php?page=overview', 2));
		}
		
		if($usedResources > ($USER[$resource[922]] + $USER['antimatter_bought'])){
		$tradeAmount	= max(0, round((float) 1/0.00572*($USER[$resource[922]] + $USER['antimatter_bought'])));
		$usedResources	= ($USER[$resource[922]] + $USER['antimatter_bought']);
		}
		
		$USER[$resource[921]]		+= $tradeAmount;
		$sql	= 'UPDATE %%USERS%% SET darkmatter = darkmatter + :darkmatter WHERE id = :userId;';
		Database::get()->update($sql, array(
			':darkmatter'	=> $tradeAmount,
			':userId'		=> $USER['id'],
		));
		
		$this->widrawAm($usedResources, $USER['id']);
		
		$sql	= 'SELECT darkmatter, antimatter, antimatter_bought FROM %%USERS%% WHERE id = :userId;';
		$getUser = Database::get()->selectSingle($sql, array(
			':userId'		=> $USER['id'],
		));
				
		$account_after = array(
			'antimatter'			=> $getUser['antimatter'],
			'antimatter_bought'		=> $getUser['antimatter_bought'],
			'darkmatter'			=> $getUser['darkmatter'],
			'Input'					=> $getTradeResources,
		);
		
		$LOG = new Logcheck(16);
		$LOG->username = $USER['username'];
		$LOG->pageLog = "page=trader [Traded Antimater => Darkmatter]";
		$LOG->old = $account_before;
		$LOG->new = $account_after;
		$LOG->save();
			
		$this->printMessage($LNG['tr_exchange_done'], true, array('game.php?page=overview', 2));
	}
	
	function tmsend()
	{
		global $USER, $PLANET, $LNG, $resource;
		
		if ($USER['darkmatter'] < Config::get()->darkmatter_cost_trader) {
			$this->redirectTo('game.php?page=overview');
		}
		
		$resourceID	= HTTP::_GP('resource', 0);
		
		if(!in_array($resourceID, array_keys(self::$ChargeForDarkmatter))) {
			$this->printMessage($LNG['invalid_action'], true, array('game.php?page=overview', 2));
		}

		$getTradeResources	= HTTP::_GP('trade', array());
		
		$tradeResources		= array_values(array_diff(array_keys(self::$ChargeForDarkmatter[$resourceID]), array($resourceID)));
		$tradeSum 			= 0;
		
		foreach($tradeResources as $tradeRessID)
		{
			if(!isset($getTradeResources[$tradeRessID]))
			{
				continue;
			}
			$tradeAmount	= max(0, round((float) $getTradeResources[$tradeRessID]));
			
			if(empty($tradeAmount) || !isset(self::$ChargeForDarkmatter[$resourceID][$tradeRessID]))
			{
				continue;  
			}
			
			if(isset($PLANET[$resource[$resourceID]]))
			{
				$usedResources	= $tradeAmount * self::$ChargeForDarkmatter[$resourceID][$tradeRessID];
				
				if($usedResources > $PLANET[$resource[$resourceID]])
				{
					$this->printMessage(sprintf($LNG['tr_not_enought'], $LNG['tech'][$resourceID]), true, array('game.php?page=overview', 2));
				}
				
				$tradeSum	  						+= $tradeAmount;
				$PLANET[$resource[$resourceID]]		-= $usedResources;
			}
			elseif(isset($USER[$resource[$resourceID]]))
			{
				if($resourceID == 921)
				{
					$USER[$resource[$resourceID]]	-= Config::get()->darkmatter_cost_trader;
				}
				
				$usedResources	= $tradeAmount * self::$ChargeForDarkmatter[$resourceID][$tradeRessID];
				
				if($usedResources > $USER[$resource[$resourceID]])
				{
					$this->printMessage(sprintf($LNG['tr_not_enought'], $LNG['tech'][$resourceID]), true, array('game.php?page=overview', 2));
				}
				
				$tradeSum	  						+= $tradeAmount;
				$USER[$resource[$resourceID]]		-= $usedResources;
				
				if($resourceID == 921)
				{
					$USER[$resource[$resourceID]]	+= Config::get()->darkmatter_cost_trader;
				}
			}
			else
			{
				throw new Exception('Unknown resource ID #'.$resourceID);
			}
			
			if(isset($PLANET[$resource[$tradeRessID]]))
			{
				$PLANET[$resource[$tradeRessID]]	+= $tradeAmount;
			}
			elseif(isset($USER[$resource[$tradeRessID]]))
			{
				$USER[$resource[$tradeRessID]]		+= $tradeAmount;
			}
			else
			{
				throw new Exception('Unknown resource ID #'.$tradeRessID);
			}
		}
		
		if ($tradeSum > 0)
		{
			$USER[$resource[921]]	-= Config::get()->darkmatter_cost_trader;
		}
		
		$this->printMessage($LNG['tr_exchange_done'], true, array('game.php?page=overview', 2));
	}
		
	function trade()
	{
		global $USER, $LNG, $resource, $PLANET;
		
		if ($USER['darkmatter'] < Config::get()->darkmatter_cost_trader) {
			$this->redirectTo('game.php?page=overview');
		}
		
		$resourceID	= HTTP::_GP('resource', 0);
		$darkmatter_cost_trader	= Config::get()->darkmatter_cost_trader;
		if(!in_array($resourceID, array_keys(self::$Charge))) {
			$this->printMessage($LNG['invalid_action'], true, array('game.php?page=overview', 2));
		}
		
		$tradeResources	= array_values(array_diff(array_keys(self::$Charge[$resourceID]), array($resourceID)));
		$this->tplObj->loadscript("trader.js");
		$this->assign(array(
			'amountResourcen'	=> $PLANET[$resource[$resourceID]],
			'tradeResourceID'	=> $resourceID,
			'tradeResources'	=> $tradeResources,
			'charge' 			=> self::$Charge[$resourceID],
			'othertrade'				=> sprintf($LNG['trader_other'],$LNG['tech'][$resourceID]),
			'needDm'				=> sprintf($LNG['trader_cost'],$darkmatter_cost_trader),
		));

		$this->display('page.trader.trade.tpl');
	}
	
	function send()
	{
		global $USER, $PLANET, $LNG, $resource;
		
		//if($USER['id'] != 1){
		//$this->printMessage('under maintenance', true, array('game.php?page=overview', 2));
		//}
		
		if ($USER['darkmatter'] < Config::get()->darkmatter_cost_trader) {
			$this->redirectTo('game.php?page=overview');
		}
		
		$resourceID	= HTTP::_GP('resource', 0);
		
		if(!in_array($resourceID, array_keys(self::$Charge))) {
			$this->printMessage($LNG['invalid_action'], true, array('game.php?page=overview', 2));
		}

		$getTradeResources	= HTTP::_GP('trade', array());
		
		$tradeResources		= array_values(array_diff(array_keys(self::$Charge[$resourceID]), array($resourceID)));
		$tradeSum 			= 0;
		
		foreach($tradeResources as $tradeRessID)
		{
			if(!isset($getTradeResources[$tradeRessID]))
			{
				continue;
			}
			$tradeAmount	= max(0, round((float) $getTradeResources[$tradeRessID]));
			
			if(empty($tradeAmount) || !isset(self::$Charge[$resourceID][$tradeRessID]))
			{
				continue;  
			}
			
			if(isset($PLANET[$resource[$resourceID]]))
			{
				$usedResources	= min($PLANET[$resource[$resourceID]],($tradeAmount * self::$Charge[$resourceID][$tradeRessID]));
				$tradeAmount 	= min($PLANET[$resource[$resourceID]] * self::$Charge[$tradeRessID][$resourceID],$tradeAmount);
				
								
				if($usedResources > $PLANET[$resource[$resourceID]])
				{
					$this->printMessage(sprintf($LNG['tr_not_enought'], $LNG['tech'][$resourceID]), true, array('game.php?page=overview', 2));
				}
				
				$tradeSum	  						+= $tradeAmount;
				$PLANET[$resource[$resourceID]]		-= $usedResources;
			}
			elseif(isset($USER[$resource[$resourceID]]))
			{
				if($resourceID == 921)
				{
					$USER[$resource[$resourceID]]	-= Config::get()->darkmatter_cost_trader;
				}
				
				$usedResources	= $tradeAmount * self::$Charge[$resourceID][$tradeRessID];
				
				if($usedResources > $USER[$resource[$resourceID]])
				{
					$this->printMessage(sprintf($LNG['tr_not_enought'], $LNG['tech'][$resourceID]), true, array('game.php?page=overview', 2));
				}
				
				$tradeSum	  						+= $tradeAmount;
				$USER[$resource[$resourceID]]		-= $usedResources;
				
				if($resourceID == 921)
				{
					$USER[$resource[$resourceID]]	+= Config::get()->darkmatter_cost_trader;
				}
			}
			else
			{
				throw new Exception('Unknown resource ID #'.$resourceID);
			}
			
			if(isset($PLANET[$resource[$tradeRessID]]))
			{
				$PLANET[$resource[$tradeRessID]]	+= $tradeAmount;
			}
			elseif(isset($USER[$resource[$tradeRessID]]))
			{
				$USER[$resource[$tradeRessID]]		+= $tradeAmount;
			}
			else
			{
				throw new Exception('Unknown resource ID #'.$tradeRessID);
			}
		}
		
		if ($tradeSum > 0)
		{
			$USER[$resource[921]]	-= Config::get()->darkmatter_cost_trader;
		}
		
		$this->printMessage($LNG['tr_exchange_done'], true, array('game.php?page=overview', 2));
	}
}