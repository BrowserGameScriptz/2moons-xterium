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
class MissionCaseTransport extends MissionFunctions implements Mission
{		
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{
		global $resource;
		
		$sql = 'SELECT name FROM %%PLANETS%% WHERE `id` = :planetId;';

		$startPlanetName	= Database::get()->selectSingle($sql, array(
			':planetId'	=> $this->_fleet['fleet_start_id']
		), 'name');

		$targetPlanetName	= Database::get()->selectSingle($sql, array(
			':planetId'	=> $this->_fleet['fleet_end_id']
		), 'name');
		
		$LNG			= $this->getLanguage(NULL, $this->_fleet['fleet_owner']);
		
		$StartOwner	= $this->_fleet['fleet_owner'];
		$TargetOwner	= $this->_fleet['fleet_target_owner'];
		
		$sql = 'SELECT * FROM %%STATPOINTS%% WHERE id_owner = :StartOwner;';
		$userRank	= Database::get()->selectSingle($sql, array(
			':StartOwner'	=> $StartOwner
		));
		$sql = 'SELECT * FROM %%STATPOINTS%% WHERE id_owner = :TargetOwner;';
		$targetRank	= Database::get()->selectSingle($sql, array(
			':TargetOwner'	=> $TargetOwner
		));
		
		$sql = 'SELECT * FROM %%TRANSPORTLOGS%% WHERE senderID = :senderID AND receiverID = :receiverID AND legal = :legal AND reviewed = :reviewed;';
		$Counting	= Database::get()->select($sql, array(
			':senderID'	=> $TargetOwner,
			':receiverID'	=> $StartOwner,
			':legal'	=> 1,
			':reviewed'	=> 0
		)); 
		
		$Strongest = $StartOwner;
		if($userRank['total_rank'] > $targetRank['total_rank']){
		$Strongest = $TargetOwner;	
		} 
		
		$Push = $this->_fleet['fleet_resource_metal'] + $this->_fleet['fleet_resource_crystal']*2 + $this->_fleet['fleet_resource_deuterium']*3;
		
		$legal = 1;
		if($Strongest == $StartOwner){
		$legal = 0;
		}elseif(count($Counting) != 0){
		$legal = 0;
		}elseif($Push < 2){
		$legal = 0;
		}
		
		
		$Message		= sprintf($LNG['sys_tran_mess_owner'],
			$targetPlanetName, GetTargetAddressLink($this->_fleet, ''),
			pretty_number($this->_fleet['fleet_resource_metal']), $LNG['tech'][901],
			pretty_number($this->_fleet['fleet_resource_crystal']), $LNG['tech'][902],
			pretty_number($this->_fleet['fleet_resource_deuterium']), $LNG['tech'][903]
		);

		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 5,
			$LNG['sys_mess_transport'], $Message, $this->_fleet['fleet_start_time'], NULL, 1, $this->_fleet['fleet_universe']);

		if ($this->_fleet['fleet_target_owner'] != $this->_fleet['fleet_owner']) 
		{
			$LNG			= $this->getLanguage(NULL, $this->_fleet['fleet_target_owner']);
			$Message        = sprintf($LNG['sys_tran_mess_user'],
				$startPlanetName, GetStartAddressLink($this->_fleet, ''),
				$targetPlanetName, GetTargetAddressLink($this->_fleet, ''),
				pretty_number($this->_fleet['fleet_resource_metal']), $LNG['tech'][901],
				pretty_number($this->_fleet['fleet_resource_crystal']), $LNG['tech'][902],
				pretty_number($this->_fleet['fleet_resource_deuterium']), $LNG['tech'][903]
			);

			PlayerUtil::sendMessage($this->_fleet['fleet_target_owner'], 0, $LNG['sys_mess_tower'], 5,
				$LNG['sys_mess_transport'], $Message, $this->_fleet['fleet_start_time'], NULL, 1, $this->_fleet['fleet_universe']);
				
			$sql = "INSERT INTO %%TRANSPORTLOGS%% SET
				senderID			= :senderID,
                receiverID			= :receiverID,
                time				= :time,
                push				= :push,
                strongest			= :strongest,
                resource_metal		= :resource_metal,
                resource_crystal	= :resource_crystal,
                resource_deuterium	= :resource_deuterium,
                legal				= :legal,
                reviewed			= :reviewed;";

			Database::get()->insert($sql, array(
				':senderID'				=> $StartOwner,
				':receiverID'			=> $TargetOwner,
				':time'					=> TIMESTAMP,
				':push'					=> $Push,
				':strongest'			=> $Strongest,
				':resource_metal'		=> $this->_fleet['fleet_resource_metal'],
				':resource_crystal'		=> $this->_fleet['fleet_resource_crystal'],
				':resource_deuterium'	=> $this->_fleet['fleet_resource_deuterium'],
				':legal'				=> $legal,
				':reviewed'				=> 0
			));	
		}
		
		$this->StoreGoodsToPlanet();
		$this->setState(FLEET_RETURN);
		$this->SaveFleet();
	}
	
	function EndStayEvent()
	{
		return;
	}
	
	function ReturnEvent()
	{
		$LNG		= $this->getLanguage(NULL, $this->_fleet['fleet_owner']);
		$sql		= 'SELECT name FROM %%PLANETS%% WHERE id = :planetId;';
		$planetName	= Database::get()->selectSingle($sql, array(
			':planetId'	=> $this->_fleet['fleet_start_id'],
		), 'name');

		$Message	= sprintf($LNG['sys_tran_mess_back'], $planetName, GetStartAddressLink($this->_fleet, ''));

		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 5, $LNG['sys_mess_fleetback'],
			$Message, $this->_fleet['fleet_end_time'], NULL, 1, $this->_fleet['fleet_universe']);

		$this->RestoreFleet();
	}
}