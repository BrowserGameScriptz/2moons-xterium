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


class ShowFleetDealerPage extends AbstractGamePage
{

	function __construct() 
	{
		parent::__construct();
	}
	
	public function send()
	{
		global $USER, $PLANET, $LNG, $pricelist, $resource;
		
		
		$shipID			= HTTP::_GP('shipID', 0);
		$ajax			= HTTP::_GP('ajax', 0);
		$Count			= max(0, round(HTTP::_GP('count', 0.0)));
		$createDebris	= HTTP::_GP('createDebris', 0);
		$allowedShipIDs	= explode(',', Config::get()->trade_allowed_ships);

		/* if($USER['id'] != 1){
			$return_arr = array("Msg"=>"Error - Mod Disabled","Error"=>1);
			echo json_encode($return_arr);
			exit;
		}
		 */
		if($_SERVER['REQUEST_METHOD'] === 'POST' && $ajax == 1 && !empty($shipID) && !empty($Count) && in_array($shipID, $allowedShipIDs) && $PLANET[$resource[$shipID]] >= $Count && $Count > 0 && $createDebris == 0)
		{
			$account_before = array(
				$resource[$shipID]		=> $PLANET[$resource[$shipID]],
				'metal'					=> $PLANET['metal'],
				'crystal'				=> $PLANET['crystal'],
				'deuterium'				=> $PLANET['deuterium'],
				'darkmatter'			=> $USER['darkmatter'],
			);
			
			$costResources	= BuildFunctions::getElementPrice($USER, $PLANET, $shipID, false, $Count);
		
			$tradeCharge								= 1 - (Config::get()->trade_charge / 100);
			
			if(isset($costResources[901])) { $PLANET[$resource[901]]			+= $costResources[901] * $tradeCharge; }
			if(isset($costResources[902])) { $PLANET[$resource[902]]			+= $costResources[902] * $tradeCharge; }
			if(isset($costResources[903])) { $PLANET[$resource[903]]			+= $costResources[903] * $tradeCharge; }
			if(isset($costResources[921])) { $USER[$resource[921]]				+= $costResources[921] * $tradeCharge; }
			
			$PLANET[$resource[$shipID]]		-= $Count;

            $sql = 'UPDATE %%PLANETS%% SET '.$resource[$shipID].' = '.$resource[$shipID].' - :count, metal = metal + :metal, crystal = crystal + :crystal, deuterium = deuterium + :deuterium WHERE id = :planetID;';
			Database::get()->update($sql, array(
                ':count'        => $Count,
                ':metal'        => isset($costResources[901]) ? $costResources[901] * $tradeCharge : 0,
                ':crystal'      => isset($costResources[902]) ? $costResources[902] * $tradeCharge : 0,
                ':deuterium'    => isset($costResources[903]) ? $costResources[903] * $tradeCharge : 0,
                ':planetID'     => $PLANET['id']
            ));
			
			$sql = 'UPDATE %%USERS%% SET darkmatter = darkmatter + :darkmatter WHERE id = :userID;';
			Database::get()->update($sql, array(
                ':darkmatter'   => isset($costResources[921]) ? $costResources[921] * $tradeCharge : 0,
                ':userID'	    => $USER['id']
            ));
			
			$sql	= 'SELECT darkmatter FROM %%USERS%% WHERE id = :userId;';
			$getUser = Database::get()->selectSingle($sql, array(
				':userId'		=> $USER['id'],
			));
			
			$sql	= 'SELECT metal, crystal, deuterium, '.$resource[$shipID].' FROM %%PLANETS%% WHERE id = :planetId;';
			$getPlanet = Database::get()->selectSingle($sql, array(
				':planetId'		=> $PLANET['id'],
			));
			
			$account_after = array(
				$resource[$shipID]		=> $getPlanet[$resource[$shipID]],
				'metal'					=> $getPlanet['metal'],
				'crystal'				=> $getPlanet['crystal'],
				'deuterium'				=> $getPlanet['deuterium'],
				'darkmatter'			=> $getUser['darkmatter'],
			);
				
			$LOG = new Logcheck(5);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=fleetDealer [Sold Fleets - Resource]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();

            //$this->printMessage($LNG['tr_exchange_done'], true, array('game.php?page=fleetDealer', 2));
			
			$return_arr = array("Msg"=>"Success - Demolish again","Error"=>0);
			echo json_encode($return_arr);
		}
		elseif($_SERVER['REQUEST_METHOD'] === 'POST' && $ajax == 1 && !empty($shipID) && !empty($Count) && in_array($shipID, $allowedShipIDs) && $PLANET[$resource[$shipID]] >= $Count && $Count > 0 && $createDebris == 1)
		{
			$account_before = array(
				$resource[$shipID]		=> $PLANET[$resource[$shipID]],
				'metal'					=> $PLANET['der_metal'],
				'crystal'				=> $PLANET['der_crystal'],
			);
			
			$costResources	= BuildFunctions::getElementPrice($USER, $PLANET, $shipID, false, $Count);
		
			$tradeCharge								= 1 - (Config::get()->trade_charge / 100);
			
			$PLANET[$resource[$shipID]]		-= $Count;

            $sql = 'UPDATE %%PLANETS%% SET der_metal = der_metal + :metal, der_crystal = der_crystal + :crystal WHERE galaxy = :galaxy AND system = :system AND planet = :planet AND planet_type = 1;';
			Database::get()->update($sql, array(
                ':metal'        => isset($costResources[901]) ? $costResources[901] * $tradeCharge : 0,
                ':crystal'      => isset($costResources[902]) ? $costResources[902] * $tradeCharge : 0,
                ':galaxy'     	=> $PLANET['galaxy'],
                ':system'     	=> $PLANET['system'],
                ':planet'     	=> $PLANET['planet']
            ));
			
			$sql = 'UPDATE %%PLANETS%% SET '.$resource[$shipID].' = '.$resource[$shipID].' - :count WHERE id = :planetId;';
			Database::get()->update($sql, array(
                ':count'        => $Count,
                ':planetId'     => $PLANET['id']
            ));
			
			$sql	= 'SELECT der_metal, der_crystal, '.$resource[$shipID].' FROM %%PLANETS%% WHERE id = :planetId;';
			$getPlanet = Database::get()->selectSingle($sql, array(
				':planetId'		=> $PLANET['id'],
			));
			
			$account_after = array(
				$resource[$shipID]		=> $getPlanet[$resource[$shipID]],
				'metal'					=> $getPlanet['der_metal'],
				'crystal'				=> $getPlanet['der_crystal'],
			);
				
			$LOG = new Logcheck(5);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=fleetDealer [Sold Fleets - Debris]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();

            //$this->printMessage($LNG['tr_exchange_done'], true, array('game.php?page=fleetDealer', 2));
			
			$return_arr = array("Msg"=>"Success - Demolish again","Error"=>0);
			echo json_encode($return_arr);
		}else
		{
			//$this->printMessage($LNG['tr_exchange_error'], true, array('game.php?page=fleetDealer', 2));
			$return_arr = array("Msg"=>"Error - Demolish again","Error"=>1);
			echo json_encode($return_arr);
				
		}
		
	}
	
	function show()
	{
		global $USER, $PLANET, $LNG, $pricelist, $resource, $reslist;
		
		if($USER['id'] != 1){
			$this->printMessage('You cannont access this page', true, array('game.php?page=overview', 2));
		}
		
		$Cost		= array();
		
		$allowedShipIDs	= explode(',', Config::get()->trade_allowed_ships);
		
		foreach($allowedShipIDs as $shipID)
		{
			if(in_array($shipID, $reslist['fleet']) || in_array($shipID, $reslist['defense'])) {
				$Cost[$shipID]	= array($PLANET[$resource[$shipID]], $LNG['tech'][$shipID], $pricelist[$shipID]['cost']);
			}
		}
		
		if(empty($Cost))
		{
			$this->printMessage($LNG['ft_empty'], true, array('game.php?page=fleetDealer', 2));
		}

		$this->assign(array(
			'shipIDs'	=> $allowedShipIDs,
			'CostInfos'	=> $Cost,
			'Charge'	=> Config::get()->trade_charge,
		));
		
		$this->display('page.fleetDealer.default.tpl');
	}
}