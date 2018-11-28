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

 
function BCWrapperPreRev2321($combatReport)
{
	if(isset($combatReport['moon']['desfail']))
	{
		$combatReport['moon']	= array(
			'moonName'				=> $combatReport['moon']['name'],
			'moonChance'			=> $combatReport['moon']['chance'],
			'moonDestroySuccess'	=> !$combatReport['moon']['desfail'],
			'fleetDestroyChance'	=> $combatReport['moon']['chance2'],
			'fleetDestroySuccess'	=> !$combatReport['moon']['fleetfail']
		);			
	}
	elseif(isset($combatReport['moon'][0]))
	{
		$combatReport['moon']	= array(
			'moonName'				=> $combatReport['moon'][1],
			'moonChance'			=> $combatReport['moon'][0],
			'moonDestroySuccess'	=> !$combatReport['moon'][2],
			'fleetDestroyChance'	=> $combatReport['moon'][3],
			'fleetDestroySuccess'	=> !$combatReport['moon'][4]
		);			
	}
	
	if(isset($combatReport['simu']))
	{
		$combatReport['additionalInfo'] = $combatReport['simu'];
	}
	
	if(isset($combatReport['debris'][0]))
	{
           $combatReport['debris'] = array(
               901	=> $combatReport['debris'][0],
               902	=> $combatReport['debris'][1]
           );
	}
		
	if (!empty($combatReport['steal']['metal']))
	{
		$combatReport['steal'] = array(
			901	=> $combatReport['steal']['metal'],
			902	=> $combatReport['steal']['crystal'],
			903	=> $combatReport['steal']['deuterium']
		);
	}
		
	return $combatReport;
}

function calculateRepairArray($rid, $totalWreckefender, $targetUser, $fleetPointsDefender, $FleetDebrisA, $targetPlanet)
{	
	//150.000 fleet points and 5% of fleet
	//Only defender
	//Units that don't count towards a wreck field: Defense units, and default fleets units + solar sattelites.
	//No acs
	
	//$this->_fleet['fleet_group']
		
	global $pricelist, $resource, $reslist;
	
	$sql		= "SELECT fleet_points, honor_points, honor_rank FROM %%STATPOINTS%% WHERE `universe` = :universe AND id_owner = :id_owner;";
	$militaryDefender	= Database::get()->selectSingle($sql, array(
		':universe'	=> 1,
		':id_owner'	=> $targetUser['id']
	));
	
	if($targetPlanet['planet_type'] == 3){
		$sql		= "SELECT * FROM %%PLANETS%% WHERE galaxy = :galaxy AND system = :system AND planet = :planet AND planet_type = 1;";
		$targetPlanet	= Database::get()->selectSingle($sql, array(
			':galaxy'	=> $targetPlanet['galaxy'],
			':system'	=> $targetPlanet['system'],
			':planet'	=> $targetPlanet['planet']
		));
	}
	
	if($totalWreckefender == 0 && $fleetPointsDefender >= $militaryDefender['fleet_points'] /100 * 5 && $fleetPointsDefender >= 150000){
		
		$RID		= $rid;

		$sql = "SELECT 
			raport, time,
			(
				SELECT
				GROUP_CONCAT(username SEPARATOR ' & ') as attacker
				FROM %%USERS%%
				WHERE id IN (SELECT uid FROM %%TOPKB_USERS%% WHERE %%TOPKB_USERS%%.rid = %%RW%%.rid AND role = 1)
			) as attacker,
			(
				SELECT
				GROUP_CONCAT(username SEPARATOR ' & ') as defender
				FROM %%USERS%%
				WHERE id IN (SELECT uid FROM %%TOPKB_USERS%% WHERE %%TOPKB_USERS%%.rid = %%RW%%.rid AND role = 2)
			) as defender
			FROM %%RW%%
			WHERE rid = :reportID;";
		$reportData = database::get()->selectSingle($sql, array(
			':reportID'	=> $RID
		));
		
		$combatReport			= unserialize($reportData['raport']);
		$combatReport			= BCWrapperPreRev2321($combatReport);
		
		$NewQueue	= array();
		$totalDebris = 100 - ($FleetDebrisA * 100);
		$buildingAffect = $totalDebris / 100 * (45 + (0.2 * $targetPlanet['xterium_dock']));
		
		foreach($combatReport['rounds'] as $Round => $RoundInfo){
			
			foreach($RoundInfo['defender'] as $Player){
				
				foreach($Player['ships'] as $ShipID => $ShipData){
					
					$shipAmount = 0;
					$fleetRepairId = array(202,203,204,205,206,207,209,211,213,214,215,216,217,218,219,221,222,224,225,226,227,228,229,230);
			
					if(in_array($ShipID,$fleetRepairId)){
						
						$shipAmountBis = ($ShipData[4] - ($ShipData[4] * $FleetDebrisA));
						$shipAmountBis = $shipAmountBis / 100 * $buildingAffect;
						
						$shipAmount += floor($shipAmountBis);
					}
					
					$Rebuild = 0;
					
					if($shipAmount > 0)
						$NewQueue[]	= $ShipID.','.$Rebuild.','.floatToString($shipAmount);
					
				}				
			}			
		}
		
		if(!empty($NewQueue)){
			$sql = "INSERT INTO %%WRECKS%% SET userID = :userID, planetID = :planetID, wreck_array = :wreck_array, startTime = :startTime, expiredTime = :expiredTime;";
			database::get()->insert($sql, array(
				':userID'   => $targetUser['id'],
				':planetID'    => $targetPlanet['id'],
				':wreck_array'       => implode(';', $NewQueue),
				':startTime'    => TIMESTAMP,
				':expiredTime'     => (TIMESTAMP + 48*3600)
			));
		}
	}
	return true;
}
	