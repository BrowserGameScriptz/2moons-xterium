<?php

/**
 *  2Moons
 *  Copyright (C) 2011 Jan Kröpke
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
 * @copyright 2009 Lucky
 * @copyright 2011 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.0 (2011-12-10)
 * @info $Id$
 * @link http://code.google.com/p/2moons/
 */

require_once 'includes/classes/cronjob/CronjobTask.interface.php';

class AutoExpoCronjob implements CronjobTask
{		
	function run()
	{	 
		global $resource;
		
		$sql	= 'SELECT * FROM %%AUTOEXPE%% WHERE isActive != 0 ORDER BY lastSend ASC LIMIT 25;';
		$AutoExpeditionMod = database::get()->select($sql, array());
		
		foreach($AutoExpeditionMod as $AutoExpoCron){
			$sql	= 'UPDATE %%AUTOEXPE%% SET lastSend = :lastSend WHERE autoId = :autoId;';
			database::get()->update($sql, array(
				':lastSend' => TIMESTAMP,
				':autoId'   => $AutoExpoCron['autoId']
			));
			
			$waveArray	= explode(';', $AutoExpoCron['waveArray']);
								
			$sql	= 'SELECT id, urlaubs_modus, bana, banaday, onlinetime, ally_id, universe, protectionTimer, prem_count_expiditeon, prem_count_expiditeon_days, prem_speed_expiditeon, prem_speed_expiditeon_days, '.$resource[124].', '.$resource[108].', peacefull_exp_slots, academy_p_b_1_1105, academy_p_b_1_1106, academy_p_b_2_1207, arsenal_combustion_level, arsenal_impulse_level, arsenal_hyperspace_level, combustion_tech, impulse_motor_tech, hyperspace_motor_tech FROM %%USERS%% WHERE id = :userId;';
			$userExpoCron = database::get()->selectSingle($sql, array(
				':userId' => $AutoExpoCron['userId']
			));	
			
			if($userExpoCron['urlaubs_modus'] == 1 || $userExpoCron['bana'] == 1 || $userExpoCron['onlinetime'] < TIMESTAMP - 7 * 24 * 3600 || $userExpoCron['banaday'] > TIMESTAMP){
				$sql	= 'UPDATE %%AUTOEXPE%% SET isActive = 0 WHERE autoId = :autoId;';
				database::get()->update($sql, array(
					':autoId'   => $AutoExpoCron['autoId']
				));
				continue;
			}
			
			for($i = 1; $i <= $AutoExpoCron['waveCount']; $i++)
			{	
				$Fleet		= array();
				
				$sql	= 'SELECT * FROM %%PLANETS%% WHERE id = :planetId;';
				$fleetCheckCron = database::get()->selectSingle($sql, array(
					':planetId' => $AutoExpoCron['planetId']
				));
				
				$premium_expe_slotsCron = 0;
				if($userExpoCron['prem_count_expiditeon'] > 0 && $userExpoCron['prem_count_expiditeon_days'] > TIMESTAMP){
					$premium_expe_slotsCron = $userExpoCron['prem_count_expiditeon'];
				}
				
				$activeExpedition	= FleetFunctions::GetCurrentFleets($userExpoCron['id'], 17, true);
				$activeExpedition	+= FleetFunctions::GetCurrentFleets($userExpoCron['id'], 18, true);
				
				$getGalaxySevenAccount = getGalaxySevenAccount($userExpoCron);
				$getGalaxySevenAccount = $getGalaxySevenAccount['simExpe'];

				
				if(empty($userExpoCron) || empty($fleetCheckCron) || $activeExpedition >= (FleetFunctions::getExpeditionLimit($userExpoCron) + $premium_expe_slotsCron + $getGalaxySevenAccount)){
					break;
				}
				foreach ($waveArray as $Item)
				{
					$tempCron 		= explode(',', $Item);
					if($tempCron[1] < 1 || $fleetCheckCron[$resource[$tempCron[0]]] < $tempCron[1]){
						continue;
					}
					$Fleet[$tempCron[0]]	= min($tempCron[1], $fleetCheckCron[$resource[$tempCron[0]]]);
				}
					
				$rawfleetarray		= $Fleet;
				if(empty($rawfleetarray)){
					break;
				}
				
				$FleetRoom   		 		= FleetFunctions::GetFleetRoom($rawfleetarray, $userExpoCron);		
				$GameSpeedFactor   		 	= FleetFunctions::GetGameSpeedFactor();		
				$MaxFleetSpeed 				= FleetFunctions::GetFleetMaxSpeed($rawfleetarray, $userExpoCron);
				$distance      				= FleetFunctions::GetTargetDistance(array($fleetCheckCron['galaxy'], $fleetCheckCron['system'], $fleetCheckCron['planet']),array($fleetCheckCron['galaxy'], $fleetCheckCron['system'], 21));
				$duration      				= max(5,FleetFunctions::GetMissionDuration($AutoExpoCron['waveSpeed'], $MaxFleetSpeed, $distance, $GameSpeedFactor, $userExpoCron));	
				$consumption   				= FleetFunctions::GetFleetConsumption($rawfleetarray, $duration, $distance, $userExpoCron, $GameSpeedFactor);
								
				$premium_speed_expeditionsCron = 0;
				if($userExpoCron['prem_speed_expiditeon'] > 0 && $userExpoCron['prem_speed_expiditeon_days'] > TIMESTAMP){
					$premium_speed_expeditionsCron = $userExpoCron['prem_speed_expiditeon'];
				}
				
				$haltSpeed	= Config::get($userExpoCron['universe'])->halt_speed;
				$haltSpeed	+= ($haltSpeed / 100 * $premium_speed_expeditionsCron);
				
				for($k = 1;$k <= $userExpoCron[$resource[124]] + $premium_expe_slotsCron + $getGalaxySevenAccount;$k++)
				{
					$stayBlock[$k]	= round($k / $haltSpeed, 2);
				}
			
				$stayTime 					= $AutoExpoCron['waveHours'];
				if(!isset($stayBlock[$stayTime])){
					break;
				}
				$StayDuration   			= round($stayBlock[$stayTime] * 3600, 0);
					
				$ActualFleets		= FleetFunctions::GetCurrentFleets($userExpoCron['id']);				
				if(FleetFunctions::GetMaxFleetSlots($userExpoCron) <= $ActualFleets || $fleetCheckCron['deuterium'] < $consumption || $FleetRoom < $consumption){
					break;
				}
					
				$fleetResource	= array(
					901	=> 0,
					902	=> 0,
					903	=> 0,
				);
					
				$sql	= "UPDATE %%PLANETS%% SET deuterium = deuterium - :deuterium WHERE id = :id;";
				database::get()->update($sql, array(
					':deuterium'	=> $consumption,
					':id'			=> $AutoExpoCron['planetId']
				));
				
				$fleetStartTime		= $duration + TIMESTAMP;
				if($AutoExpoCron['waveCount'] > 1){
					$fleetStartTime		= $fleetStartTime + ($i * 5) - 5;				
				}
				$timeDifference		= round(max(0, $fleetStartTime - 0));
				$fleetStayTime		= $fleetStartTime + $StayDuration;
				if($AutoExpoCron['waveCount'] > 1){
					$fleetStayTime		= $fleetStayTime + ($i * 5) - 5;				
				}
				$fleetEndTime		= $fleetStayTime + $duration;
				if($AutoExpoCron['waveCount'] > 1){
					$fleetEndTime		= $fleetEndTime + ($i * 5) - 5;				
				}
								
				if($AutoExpoCron['templateType'] == 1){			
					FleetFunctions::sendFleet($rawfleetarray, 18, $userExpoCron['id'], $fleetCheckCron['id'], $fleetCheckCron['galaxy'], $fleetCheckCron['system'], $fleetCheckCron['planet'], $fleetCheckCron['planet_type'], 0, 0, $fleetCheckCron['galaxy'], $fleetCheckCron['system'], 21, 1, $fleetResource, $fleetStartTime, $fleetStayTime, $fleetEndTime, $userExpoCron['ally_id']);
				}elseif($AutoExpoCron['templateType'] == 2){
					FleetFunctions::sendFleet($rawfleetarray, 17, $userExpoCron['id'], $fleetCheckCron['id'], $fleetCheckCron['galaxy'], $fleetCheckCron['system'], $fleetCheckCron['planet'], $fleetCheckCron['planet_type'], 0, 0, $fleetCheckCron['galaxy'], $fleetCheckCron['system'], 21, 1, $fleetResource, $fleetStartTime, $fleetStayTime, $fleetEndTime, $userExpoCron['ally_id'], $AutoExpoCron['isActive']);
				}
			}
		}
	}
}