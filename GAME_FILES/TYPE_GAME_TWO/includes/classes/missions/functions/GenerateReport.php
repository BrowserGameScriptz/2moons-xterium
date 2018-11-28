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

function GenerateReport($combatResult, $reportInfo)
{
	
	global $pricelist;
	
	$Destroy	= array('att' => 0, 'def' => 0);
	$DATA		= array();
	$DATA['mode']	= (int) $reportInfo['moonDestroy'];
	$DATA['time']	= $reportInfo['thisFleet']['fleet_start_time'];
	$DATA['start']	= array($reportInfo['thisFleet']['fleet_start_galaxy'], $reportInfo['thisFleet']['fleet_start_system'], $reportInfo['thisFleet']['fleet_start_planet'], $reportInfo['thisFleet']['fleet_start_type']);
	$DATA['koords']	= array($reportInfo['thisFleet']['fleet_end_galaxy'], $reportInfo['thisFleet']['fleet_end_system'], $reportInfo['thisFleet']['fleet_end_planet'], $reportInfo['thisFleet']['fleet_end_type']);
	$DATA['units']	= array($combatResult['unitLost']['attacker'], $combatResult['unitLost']['defender']);
	$DATA['debris901']	= $reportInfo['debris901'];
	$DATA['debris902']	= $reportInfo['debris902'];
	$DATA['steal']	= $reportInfo['stealResource'];
	$DATA['result']	= $combatResult['won'];
	$DATA['moon']	= array(
		'moonName'				=> $reportInfo['moonName'],
		'moonChance'			=> (int) $reportInfo['moonChance'],
		'moonDestroyChance'		=> (int) $reportInfo['moonDestroyChance'],
		'moonDestroySuccess'	=> (int) $reportInfo['moonDestroySuccess'],
		'fleetDestroyChance'	=> (int) $reportInfo['fleetDestroyChance'],
		'fleetDestroySuccess'	=> (int) $reportInfo['fleetDestroySuccess']
	);
	$round_no       = 0;
	if(isset($reportInfo['additionalInfo1']) && isset($reportInfo['additionalInfo2']) && isset($reportInfo['additionalInfo3']))
	{
		$DATA['additionalInfo1'] = $reportInfo['additionalInfo1'];
		$DATA['additionalInfo2'] = $reportInfo['additionalInfo2'];
		$DATA['additionalInfo3'] = $reportInfo['additionalInfo3'];
	}
	else
	{
		$DATA['additionalInfo1'] = 0;
		$DATA['additionalInfo2'] = 0;
		$DATA['additionalInfo3'] = 0;

	}
	
	$DATA['additionalInfo4'] = $reportInfo['additionalInfo4'];
	$DATA['additionalInfo5'] = $reportInfo['additionalInfo5'];
	$DATA['additionalInfo6'] = $reportInfo['additionalInfo6'];
	$DATA['additionalInfo10'] = $reportInfo['additionalInfo10'];
	$DATA['additionalInfo11'] = $reportInfo['additionalInfo11'];

	
	foreach($combatResult['rw'][0]['attackers'] as $player)
	{
		$sql	= "SELECT username, customNick FROM %%USERS%% WHERE id = :userID;";
		$userNameCmb = database::get()->selectSingle($sql, array(
				':userID'	=> $player['player']['id']
		));
		
		$DATA['players'][$player['player']['id']]	= array(
			'name'		=> empty($userNameCmb['customNick']) ? $userNameCmb['username'] : $userNameCmb['customNick'],
			'koords'	=> array($player['fleetDetail']['fleet_start_galaxy'], $player['fleetDetail']['fleet_start_system'], $player['fleetDetail']['fleet_start_planet'], $player['fleetDetail']['fleet_start_type']),
			'tech'		=> array($player['techs'][0], $player['techs'][1], $player['techs'][2]),
		);
	}
	foreach($combatResult['rw'][0]['defenders'] as $player)
	{
		$sql	= "SELECT username, customNick FROM %%USERS%% WHERE id = :userID;";
		$userNameCmb = database::get()->selectSingle($sql, array(
				':userID'	=> $player['player']['id']
		));
		
		$DATA['players'][$player['player']['id']]	= array(
			'name'		=> empty($userNameCmb['customNick']) ? $userNameCmb['username'] : $userNameCmb['customNick'],
			'koords'	=> array($player['fleetDetail']['fleet_start_galaxy'], $player['fleetDetail']['fleet_start_system'], $player['fleetDetail']['fleet_start_planet'], $player['fleetDetail']['fleet_start_type']),
			'tech'		=> array($player['techs'][0], $player['techs'][1], $player['techs'][2]),
		);
	}
	$totalLost901 = 0;
	$totalLost902 = 0;
	$totalLost903 = 0;
	$totalLost901d = 0;
	$totalLost902d = 0;
	$totalLost903d = 0;	
	
	foreach($combatResult['rw'] as $Round => $RoundInfo)
	{
		foreach($RoundInfo['attackers'] as $FleetID => $player)
		{	
			$playerData	= array('userID' => $player['player']['id'], 'ships' => array());
			
			if(array_sum($player['unit']) == 0) {
				$DATA['rounds'][$Round]['attacker'][] = $playerData;
				$Destroy['att']++;
				continue;
			}
			
			foreach($player['unit'] as $ShipID => $Amount)
			{
				if ($Amount <= 0){
					$Destroy['att']++;
					continue;
				}
				$round_nos = min(count($combatResult['rw'])-1,$round_no + 1);
				$farkA	= 0; // уничтожено за раунд
				$shieldKrit = 1; // крит щитов
				$attKrit = 1; // крит атаки
				
				$farkA   	  =   abs($Amount-$combatResult['rw'][$round_nos]['attackers'][$FleetID]['unit'][$ShipID]);
				$shieldKrit   =   $combatResult['rw'][$round_no]['attackers'][$FleetID]['unit_defKrit'][$ShipID];
				$attKrit  	  =   $combatResult['rw'][$round_no]['attackers'][$FleetID]['unit_attKrit'][$ShipID];
				$totalLost901 -= $farkA * $pricelist[$ShipID]['cost'][901];
				$totalLost902 -= $farkA * $pricelist[$ShipID]['cost'][902];
				$totalLost903 -= $farkA * $pricelist[$ShipID]['cost'][903];		
				
				$ShipInfo	= $RoundInfo['infoA'][$FleetID][$ShipID];
				$playerData['ships'][$ShipID]	= array( 
					$Amount, $ShipInfo['att'], $ShipInfo['def'], $ShipInfo['shield'], $farkA, $attKrit, $shieldKrit
				);
			}
			
			$DATA['rounds'][$Round]['attacker'][] = $playerData;
		}

		foreach($RoundInfo['defenders'] as $FleetID => $player)
		{	
			$playerData	= array('userID' => $player['player']['id'], 'ships' => array());
			if(array_sum($player['unit']) == 0) {
				$DATA['rounds'][$Round]['defender'][] = $playerData;
				$Destroy['def']++;
				continue;
			}
			foreach($player['unit'] as $ShipID => $Amount)
			{
				if ($Amount <= 0) {
					$farkD -= $Amount;
					$Destroy['def']++;
					continue;
				}
				$round_nos = min(count($combatResult['rw'])-1,$round_no + 1);
				$farkD	= 0; // уничтожено за раунд 
				$shieldKrit = 1; // крит щитов
				$attKrit = 1; // крит атаки
				
				$farkD   =   abs($Amount-$combatResult['rw'][$round_nos]['defenders'][$FleetID]['unit'][$ShipID]);
				$shieldKrit   =   $combatResult['rw'][$round_no]['defenders'][$FleetID]['unit_defKrit'][$ShipID];
				$attKrit  	  =   $combatResult['rw'][$round_no]['defenders'][$FleetID]['unit_attKrit'][$ShipID];
				$totalLost901d -= $farkD * $pricelist[$ShipID]['cost'][901];
				$totalLost902d -= $farkD * $pricelist[$ShipID]['cost'][902];
				$totalLost903d -= $farkD * $pricelist[$ShipID]['cost'][903];	
				
				$ShipInfo	= $RoundInfo['infoD'][$FleetID][$ShipID];
				$playerData['ships'][$ShipID]	= array(
					$Amount, $ShipInfo['att'], $ShipInfo['def'], $ShipInfo['shield'], $farkD, $attKrit, $shieldKrit
				);
			}
			$DATA['rounds'][$Round]['defender'][] = $playerData;
		}
		
		$DATA['totallost901'] = $totalLost901;
		$DATA['totallost902'] = $totalLost902;
		$DATA['totallost903'] = $totalLost903;
		$DATA['totallost901d'] = $totalLost901d;
		$DATA['totallost902d'] = $totalLost902d;
		$DATA['totallost903d'] = $totalLost903d;
		$DATA['lastRound'] = $RoundInfo['lastRound'];
		
		$round_no++;
		if ($Round >= 10 || $Destroy['att'] == count($RoundInfo['attackers']) || $Destroy['def'] == count($RoundInfo['defenders']))
			break;
		
		if(isset($RoundInfo['attack'], $RoundInfo['attackShield'], $RoundInfo['defense'], $RoundInfo['defShield']))
			$DATA['rounds'][$Round]['info']	= array($RoundInfo['attack'], $RoundInfo['attackShield'], $RoundInfo['defense'], $RoundInfo['defShield']);
		else
			$DATA['rounds'][$Round]['info']	= array(NULL, NULL, NULL, NULL);
	}
	return $DATA;
}
	