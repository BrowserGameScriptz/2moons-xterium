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


class ShowFleetTablePage extends AbstractGamePage
{
	public static $requireModule = MODULE_FLEET_TABLE;

	function __construct() 
	{
		parent::__construct();
	}
	
	function saveExpeditionTemplate(){
		global $USER, $PLANET, $LNG, $reslist, $resource;
		
		$isActive			= HTTP::_GP('isActive', 0);
		$stayTime			= HTTP::_GP('stayTime', 0);
		$speed				= HTTP::_GP('speed', 0);
		$waveCount			= HTTP::_GP('waveCount', 0);
		$Fleet				= array();
		$fleetDit			= array();
		
		$techExpedition      = FleetFunctions::getExpeditionLimit($USER);
		$premium_expe_slots = 0;
		if($USER['prem_count_expiditeon'] > 0 && $USER['prem_count_expiditeon_days'] > TIMESTAMP){
			$premium_expe_slots = $USER['prem_count_expiditeon'];
		}

		$getGalaxySevenAccount = getGalaxySevenAccount($USER);
		$getGalaxySevenAccount = $getGalaxySevenAccount['simExpe'];

		if ($techExpedition >= 1)
		{
			$activeExpedition   = FleetFunctions::GetCurrentFleets($USER['id'], 15, true);
			$activeExpedition   = FleetFunctions::GetCurrentFleets($USER['id'], 18, true);
			$activeExpedition   += FleetFunctions::GetCurrentFleets($USER['id'], 17, true);
			$maxExpedition 		= $techExpedition + $premium_expe_slots + $getGalaxySevenAccount;
		}
		else
		{
			$activeExpedition 	= 0;
			$maxExpedition 		= 0 + $premium_expe_slots + $getGalaxySevenAccount;
		}
		
		$waveCount = max(1,min($waveCount, $maxExpedition));
		
		foreach($reslist['fleet'] as $id => $ShipID){
			$amount		 				= max(0, round(HTTP::_GP('ship'.$ShipID, 0.0, 0.0)));
			
			if ($amount < 1 || $ShipID == 212) continue;
			$fleetDit[]	= $ShipID.','.floatToString($amount);
			$Fleet[$ShipID]				= $amount;
		}
		
		$sql	= 'SELECT COUNT(*) as count FROM %%AUTOEXPE%% WHERE userId = :playerId AND templateType = 1;';
		$isExistent = database::get()->selectSingle($sql, array(
			':playerId'			=> $USER['id']
		));
		
		$sql	= 'SELECT * FROM %%AUTOEXPE%% WHERE userId = :playerId AND templateType = 2;';
		$isExistentHostile = database::get()->selectSingle($sql, array(
			':playerId'			=> $USER['id']
		));
		
		if(empty($isExistent['count']) && !empty($fleetDit)){
			$sql	= 'INSERT INTO %%AUTOEXPE%% SET userId  = :userId, planetId = :planetId, templateType = 1, isActive = :isActive, waveCount = :waveCount, waveSpeed = :waveSpeed, waveHours = :waveHours, waveArray = :waveArray;';
			database::get()->insert($sql, array(
				':userId'			=> $USER['id'],
				':planetId'			=> $PLANET['id'],
				':isActive'			=> $isActive,
				':waveCount'		=> $waveCount,
				':waveSpeed'		=> $speed,
				':waveHours'		=> $stayTime,
				':waveArray'		=> implode(';', $fleetDit)		
			));
			
			if(!empty($isExistentHostile) && $isExistentHostile['isActive'] != 0){
				$sql	= 'UPDATE %%AUTOEXPE%% SET isActive = 0 WHERE templateType = 2 AND userId = :userId;';
				database::get()->UPDATE($sql, array(
					':userId'			=> $USER['id']	
				));
			}
		}elseif(!empty($fleetDit)){
			$sql	= 'UPDATE %%AUTOEXPE%% SET userId  = :userId, planetId = :planetId, isActive = :isActive, waveCount = :waveCount, waveSpeed = :waveSpeed, waveHours = :waveHours, waveArray = :waveArray WHERE templateType = 1 AND userId = :userId;';
			database::get()->UPDATE($sql, array(
				':userId'			=> $USER['id'],
				':planetId'			=> $PLANET['id'],
				':isActive'			=> $isActive,
				':waveCount'		=> $waveCount,
				':waveSpeed'		=> $speed,
				':waveHours'		=> $stayTime,
				':waveArray'		=> implode(';', $fleetDit)		
			));
			
			if(!empty($isExistentHostile) && $isExistentHostile['isActive'] != 0){
				$sql	= 'UPDATE %%AUTOEXPE%% SET isActive = 0 WHERE templateType = 2 AND userId = :userId;';
				database::get()->UPDATE($sql, array(
					':userId'			=> $USER['id']	
				));
			}
		}
		
		$this->redirectTo('game.php?page=fleetTable&type=expo');
		
	}
	
	function saveHostileTemplate(){
		global $USER, $PLANET, $LNG, $reslist, $resource;
		
		$isActive			= HTTP::_GP('isActive', 0);
		$stayTime			= HTTP::_GP('stayTime', 0);
		$speed				= HTTP::_GP('speed', 0);
		$waveCount			= HTTP::_GP('waveCount', 0);
		$Fleet				= array();
		$fleetDit			= array();
		
		$techExpedition      = FleetFunctions::getExpeditionLimit($USER);
		$premium_expe_slots = 0;
		if($USER['prem_count_expiditeon'] > 0 && $USER['prem_count_expiditeon_days'] > TIMESTAMP){
			$premium_expe_slots = $USER['prem_count_expiditeon'];
		}

		$getGalaxySevenAccount = getGalaxySevenAccount($USER);
		$getGalaxySevenAccount = $getGalaxySevenAccount['simExpe'];

		if ($techExpedition >= 1)
		{
			$maxExpedition 		= $techExpedition + $premium_expe_slots + $getGalaxySevenAccount;
		}
		else
		{
			$maxExpedition 		= 0 + $premium_expe_slots + $getGalaxySevenAccount;
		}
		
		$waveCount = max(1,min($waveCount, $maxExpedition));
		
		foreach($reslist['fleet'] as $id => $ShipID){
			$amount		 				= max(0, round(HTTP::_GP('ship'.$ShipID, 0.0, 0.0)));
			
			if ($amount < 1 || $ShipID == 212) continue;
			$fleetDit[]	= $ShipID.','.floatToString($amount);
			$Fleet[$ShipID]				= $amount;
		}
		
		$sql	= 'SELECT COUNT(*) as count FROM %%AUTOEXPE%% WHERE userId = :playerId AND templateType = 2;';
		$isExistent = database::get()->selectSingle($sql, array(
			':playerId'			=> $USER['id']
		));
		
		$sql	= 'SELECT * FROM %%AUTOEXPE%% WHERE userId = :playerId AND templateType = 1;';
		$isExistentExpo = database::get()->selectSingle($sql, array(
			':playerId'			=> $USER['id']
		));
		
		if(empty($isExistent['count']) && !empty($fleetDit)){
			$sql	= 'INSERT INTO %%AUTOEXPE%% SET userId  = :userId, planetId = :planetId, templateType = 2, isActive = :isActive, waveCount = :waveCount, waveSpeed = :waveSpeed, waveHours = :waveHours, waveArray = :waveArray;';
			database::get()->insert($sql, array(
				':userId'			=> $USER['id'],
				':planetId'			=> $PLANET['id'],
				':isActive'			=> $isActive,
				':waveCount'		=> $waveCount,
				':waveSpeed'		=> $speed,
				':waveHours'		=> $stayTime,
				':waveArray'		=> implode(';', $fleetDit)		
			));
			
			if(!empty($isExistentExpo) && $isExistentExpo['isActive'] != 0){
				$sql	= 'UPDATE %%AUTOEXPE%% SET isActive = 0 WHERE templateType = 1 AND userId = :userId;';
				database::get()->UPDATE($sql, array(
					':userId'			=> $USER['id']	
				));
			}
		}elseif(!empty($fleetDit)){
			$sql	= 'UPDATE %%AUTOEXPE%% SET userId  = :userId, planetId = :planetId, isActive = :isActive, waveCount = :waveCount, waveSpeed = :waveSpeed, waveHours = :waveHours, waveArray = :waveArray WHERE templateType = 2 AND userId = :userId;';
			database::get()->UPDATE($sql, array(
				':userId'			=> $USER['id'],
				':planetId'			=> $PLANET['id'],
				':isActive'			=> $isActive,
				':waveCount'		=> $waveCount,
				':waveSpeed'		=> $speed,
				':waveHours'		=> $stayTime,
				':waveArray'		=> implode(';', $fleetDit)		
			));
			
			if(!empty($isExistentExpo) && $isExistentExpo['isActive'] != 0){
				$sql	= 'UPDATE %%AUTOEXPE%% SET isActive = 0 WHERE templateType = 1 AND userId = :userId;';
				database::get()->UPDATE($sql, array(
					':userId'			=> $USER['id']	
				));
			}
		}
		
		$this->redirectTo('game.php?page=fleetTable&type=hostile');
		
	}
	
	public function hideFleets(){
		global $USER;
		
		$groupId			= HTTP::_GP('fleetInfo', 0);
		
		$sql = "SELECT fleet_owner, isdisplayedtable FROM %%FLEETS%% WHERE fleet_id = :groupId;";
        $fleetRowInfo = database::get()->selectSingle($sql, array(
            ':groupId'	=> $groupId
        ));
		
		if(empty($fleetRowInfo)){
			$arr = array('msg'=>"the fleet has not been found");
		}elseif($fleetRowInfo['fleet_owner'] != $USER['id']){
			$arr = array('msg'=>"you are not the owner of this fleet");
		}elseif($fleetRowInfo['isdisplayedtable'] == 0){
			$sql = "UPDATE %%FLEETS%% SET isdisplayedtable = 1 WHERE fleet_id = :fleetID;";
			database::get()->update($sql, array(
				':fleetID'	=> $groupId
			));
			$arr = array('msg'=>"the fleet tab has been toggled");
		}elseif($fleetRowInfo['isdisplayedtable'] == 1){
			$sql = "UPDATE %%FLEETS%% SET isdisplayedtable = 0 WHERE fleet_id = :fleetID;";
			database::get()->update($sql, array(
				':fleetID'	=> $groupId
			));
			$arr = array('msg'=>"the fleet tab has been untoggled");
		}else{
			$arr = array('msg'=>"something went wrong");
		}
		
		echo json_encode($arr);
		
	}
	
	
	public function createACS($fleetID, $fleetData) {
		global $USER;
		
		$rand 			= mt_rand(100000, 999999999);
		$acsName	 	= 'AG'.$rand;
		$acsCreator		= $USER['id'];

        $db = Database::get();
        $sql = "INSERT INTO %%AKS%% SET name = :acsName, ankunft = :time, target = :target;";
        $db->insert($sql, array(
            ':acsName'	=> $acsName,
            ':time'		=> $fleetData['fleet_start_time'],
			':target'	=> $fleetData['fleet_end_id']
        ));

        $acsID	= $db->lastInsertId();

        $sql = "INSERT INTO %%USERS_ACS%% SET acsID = :acsID, userID = :userID;";
        $db->insert($sql, array(
            ':acsID'	=> $acsID,
            ':userID'	=> $acsCreator
        ));

        $sql = "UPDATE %%FLEETS%% SET fleet_group = :acsID WHERE fleet_id = :fleetID;";
        $db->update($sql, array(
            ':acsID'	=> $acsID,
            ':fleetID'	=> $fleetID
        ));

		return array(
			'name' 			=> $acsName,
			'id' 			=> $acsID,
		);
	}
	
	public function loadACS($fleetData) {
		global $USER;
		
		$db = Database::get();
        $sql = "SELECT id, name FROM %%USERS_ACS%% INNER JOIN %%AKS%% ON acsID = id WHERE userID = :userID AND acsID = :acsID;";
        $acsResult = $db->selectSingle($sql, array(
            ':userID'   => $USER['id'],
            ':acsID'    => $fleetData['fleet_group']
        ));

		return $acsResult;
	}
	
	public function getACSPageData($fleetID)
	{
		global $USER, $LNG;
		
		$db = Database::get();

        $sql = "SELECT fleet_start_time, fleet_end_id, fleet_group, fleet_mess FROM %%FLEETS%% WHERE fleet_id = :fleetID;";
        $fleetData = $db->selectSingle($sql, array(
            ':fleetID'  => $fleetID
        ));

        if ($db->rowCount() != 1)
			return array();

		if ($fleetData['fleet_mess'] == 1 || $fleetData['fleet_start_time'] <= TIMESTAMP)
			return array();
				
		if ($fleetData['fleet_group'] == 0)
			$acsData	= $this->createACS($fleetID, $fleetData);
		else
			$acsData	= $this->loadACS($fleetData);
	
		if (empty($acsData))
			return array();
			
		$acsName	= HTTP::_GP('acsName', '', UTF8_SUPPORT);
		if(!empty($acsName)) {
			if(PlayerUtil::isNameValid($acsName))
			{
				$this->sendJSON($LNG['fl_acs_newname_alphanum']);
			}
			
			$sql = "UPDATE %%AKS%% SET name = acsName WHERE id = :acsID;";
            $db->update($sql, array(
                ':acsName'  => $acsName,
                ':acsID'    => $acsData['id']
            ));
            $this->sendJSON(false);
		}
		
		$invitedUsers	= array();

        $sql = "SELECT id, username FROM %%USERS_ACS%% INNER JOIN %%USERS%% ON userID = id WHERE acsID = :acsID;";
        $userResult = $db->select($sql, array(
            ':acsID'    => $acsData['id']
        ));

        foreach($userResult as $userRow)
		{
			$invitedUsers[$userRow['id']]	= $userRow['username'];
		}

		$newUser		= HTTP::_GP('username', '', UTF8_SUPPORT);
		$statusMessage	= "";
		if(!empty($newUser))
		{
			$sql = "SELECT id FROM %%USERS%% WHERE universe = :universe AND username = :username;";
            $newUserID = $db->selectSingle($sql, array(
                ':universe' => Universe::current(),
                ':username' => $newUser
            ), 'id');

            if(empty($newUserID)) {
				$statusMessage			= $LNG['fl_player']." ".$newUser." ".$LNG['fl_dont_exist'];
			} elseif(isset($invitedUsers[$newUserID])) {
				$statusMessage			= $LNG['fl_player']." ".$newUser." ".$LNG['fl_already_invited'];
			} else {
				$statusMessage			= $LNG['fl_player']." ".$newUser." ".$LNG['fl_add_to_attack'];
				
				$sql = "INSERT INTO %%USERS_ACS%% SET acsID = :acsID, userID = :newUserID;";
                $db->insert($sql, array(
                    ':acsID'        => $acsData['id'],
                    ':newUserID'    => $newUserID
                ));

                $invitedUsers[$newUserID]	= $newUser;
				
				$inviteTitle			= $LNG['fl_acs_invitation_title'];
				$inviteMessage 			= $LNG['fl_player'] . $USER['username'] . $LNG['fl_acs_invitation_message'];
				PlayerUtil::sendMessage($newUserID, $USER['id'], $USER['username'], 1, $inviteTitle, $inviteMessage, TIMESTAMP);
			}
		}
		
		return array(
			'invitedUsers'	=> $invitedUsers,
			'acsName'		=> $acsData['name'],
			'mainFleetID'	=> $fleetID,
			'statusMessage'	=> $statusMessage,
		);
	}
	
	public function delgroop()
	{
		global $USER, $PLANET, $reslist, $resource, $LNG;
		
		$groupId			= HTTP::_GP('id', 0);
		$db = Database::get();
		$sql	= 'SELECT * FROM %%FLEETS_GROUP%% WHERE groupId = :groupId;';
		$userGroupShips = $db->selectSingle($sql, array(
			':groupId'	=> $groupId
		));
		
		if($USER['id'] == $userGroupShips['ownerId']){
			$sql = "DELETE FROM %%FLEETS_GROUP%% WHERE groupId = :groupId;";
			$db->delete($sql, array(
			':groupId'	=> $groupId
		));
		$this->printMessage(sprintf($LNG['delete_grove_ship'], $userGroupShips['groupName']), true, array('game.php?page=fleetTable', 2));
		}else{
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=fleetTable');	
		}
	}
	
	public function show()
	{
		global $USER, $PLANET, $reslist, $resource, $LNG, $pricelist;
		
		if($PLANET['isAlliancePlanet'] != 0){
			$this->printMessage($LNG['autoexpedition_5'], true, array('game.php?page=overview', 2));
		}
		
		$acsData			= array();
		$userGroupShip			= array();
		$FleetID			= HTTP::_GP('fleetID', 0);
		$GetAction			= HTTP::_GP('action', "");
		$getTypetoDisp		= HTTP::_GP('type', "");

        $db = Database::get();

		$this->tplObj->loadscript('flotten.js');
		
		if($USER['tutorial'] == 51){
			$sql =  "UPDATE %%USERS%% SET tutorial = 52 WHERE id = :userID;";
			database::get()->update($sql, array(
				':userID'			=> $USER['id']
			));
		}
		
		if(!empty($FleetID) && !IsVacationMode($USER))
		{
			switch($GetAction){
				case "sendfleetback":
					FleetFunctions::SendFleetBack($USER, $FleetID);
				break;
				case "acs":
					$acsData	= $this->getACSPageData($FleetID);
				break;
			}
		}
		
		$techExpedition      = FleetFunctions::getExpeditionLimit($USER);
		$premium_expe_slots = 0;
		if($USER['prem_count_expiditeon'] > 0 && $USER['prem_count_expiditeon_days'] > TIMESTAMP){
			$premium_expe_slots = $USER['prem_count_expiditeon'];
		}

		$getGalaxySevenAccount = getGalaxySevenAccount($USER);
		$getGalaxySevenAccount = $getGalaxySevenAccount['simExpe'];

		if ($techExpedition >= 1)
		{
			$activeExpedition   = FleetFunctions::GetCurrentFleets($USER['id'], 15, true);
			$activeExpedition   = FleetFunctions::GetCurrentFleets($USER['id'], 18, true);
			$activeExpedition   += FleetFunctions::GetCurrentFleets($USER['id'], 17, true);
			$maxExpedition 		= $techExpedition + $premium_expe_slots + $getGalaxySevenAccount;
		}
		else
		{
			$activeExpedition 	= 0;
			$maxExpedition 		= 0 + $premium_expe_slots + $getGalaxySevenAccount;
		}

		$activeCapture   = FleetFunctions::GetCurrentFleets($USER['id'], 25, true);
		
		$maxFleetSlots	= FleetFunctions::GetMaxFleetSlots($USER);

		$targetGalaxy	= HTTP::_GP('galaxy', (int) $PLANET['galaxy']);
		$targetSystem	= HTTP::_GP('system', (int) $PLANET['system']);
		$targetPlanet	= HTTP::_GP('planet', (int) $PLANET['planet']);
		$targetType		= HTTP::_GP('planettype', (int) $PLANET['planet_type']);
		$targetMission	= HTTP::_GP('target_mission', 0);

        $sql = "SELECT * FROM %%FLEETS%% WHERE fleet_owner = :userID AND fleet_mission <> 10 ORDER BY fleet_end_time ASC;";
        $fleetResult = $db->select($sql, array(
            ':userID'   => $USER['id']
        ));

        $activeFleetSlots	= $db->rowCount();

		$FlyingFleetList	= array();
		
		foreach ($fleetResult as $fleetsRow)
		{
			$FleetList[$fleetsRow['fleet_id']] = FleetFunctions::unserialize($fleetsRow['fleet_array']);
			
			if($fleetsRow['fleet_mission'] == 4 && $fleetsRow['fleet_mess'] == FLEET_OUTWARD)
			{
				$returnTime	= $fleetsRow['fleet_start_time'];
			}
			else
			{
				$returnTime	= $fleetsRow['fleet_end_time'];
			}
			$fleetEndTime	= (TIMESTAMP - $fleetsRow['start_time']) + TIMESTAMP;
			
			$Owner			= $fleetsRow['fleet_owner'] == $USER['id'];
			$FleetStyle  = array (
				1 => 'attack',
				2 => 'federation',
				3 => 'transport',
				4 => 'deploy',
				5 => 'hold',
				6 => 'espionage',
				7 => 'colony',
				8 => 'harvest',
				9 => 'destroy',
				10 => 'missile',
				11 => 'transport',
				15 => 'expedit',
				16 => 'asteroid',
				17 => 'warexpedit',
				18 => 'expedit',
				25 => 'seizure',
				26 => 'surpriseme',
			);
		
			$GoodMissions	= array(3, 5);
			$MissionType    = $fleetsRow['fleet_mission'];

			$FleetPrefix    = ($Owner == true) ? 'own' : '';
			$FleetType		= $FleetPrefix.$FleetStyle[$MissionType];
		
			$FRessource   = '<table class=\'reducefleet_table\' style=\'width:100%\'>';
			$FRessource  .= '<tr><td <td class=\'reducefleet_img_res\' style=\'width:15px\'><img src=\'styles/images/metall.gif\' style=\'width:15px\'></td><td class=\'reducefleet_name_ship\'>'.$LNG['tech'][901].' <span class=\'reducefleet_count_ship\'>'. pretty_number($fleetsRow['fleet_resource_metal']).'</span></td></tr>';
			$FRessource  .= '<tr><td <td class=\'reducefleet_img_res\' style=\'width:15px\'><img src=\'styles/images/kristall.gif\' style=\'width:15px\'></td><td class=\'reducefleet_name_ship\'>'.$LNG['tech'][902].' <span class=\'reducefleet_count_ship\'>'. pretty_number($fleetsRow['fleet_resource_crystal']).'</span></td></tr>';
			$FRessource  .= '<tr><td <td class=\'reducefleet_img_res\' style=\'width:15px\'><img src=\'styles/images/deuterium.gif\' style=\'width:15px\'></td><td class=\'reducefleet_name_ship\'>'.$LNG['tech'][903].' <span class=\'reducefleet_count_ship\'>'. pretty_number($fleetsRow['fleet_resource_deuterium']).'</span></td></tr>';
			if($fleetsRow['fleet_resource_darkmatter'] > 0)
				$FRessource  .= '<tr><td <td class=\'reducefleet_img_res\'><img src=\'styles/images/darkmatter.gif\'></td><td class=\'reducefleet_name_ship\'>'.$LNG['tech'][921].' <span class=\'reducefleet_count_ship\'>'. pretty_number($fleetsRow['fleet_resource_darkmatter']).'</span></td></tr>';
			$FRessource  .= '</table>';
			
			$sql			= "SELECT name, image FROM %%PLANETS%% WHERE galaxy = :fleet_start_galaxy AND system = :fleet_start_system AND planet = :fleet_start_planet AND planet_type = :fleet_start_type;";
			$planetInfoSender		= Database::get()->selectSingle($sql, array(
				':fleet_start_galaxy'	=> $fleetsRow['fleet_start_galaxy'],
				':fleet_start_system'	=> $fleetsRow['fleet_start_system'],
				':fleet_start_planet'	=> $fleetsRow['fleet_start_planet'],
				':fleet_start_type'		=> $fleetsRow['fleet_start_type']
			));
			
			$sql			= "SELECT name, image FROM %%PLANETS%% WHERE galaxy = :fleet_start_galaxy AND system = :fleet_start_system AND planet = :fleet_start_planet AND planet_type = :fleet_start_type;";
			$planetInfoTarget		= Database::get()->selectSingle($sql, array(
				':fleet_start_galaxy'	=> $fleetsRow['fleet_end_galaxy'],
				':fleet_start_system'	=> $fleetsRow['fleet_end_system'],
				':fleet_start_planet'	=> $fleetsRow['fleet_end_planet'],
				':fleet_start_type'		=> $fleetsRow['fleet_end_type']
			));
			
			$fleetPercentage = 0;
			$actualT = 0;
			if($fleetsRow['fleet_mess'] == 0){
				$endTime 		= $fleetsRow['fleet_start_time']; // == 100%
				$elementTimeB 	= $fleetsRow['fleet_start_time'] - $fleetsRow['start_time']; // == 100%
				$actualT 		= (round(((TIMESTAMP - ($endTime-$elementTimeB)) * 100) / ($endTime - ($endTime-$elementTimeB)), 2).'');
			}elseif($fleetsRow['fleet_mess'] == 2){
				$endTime 		= $fleetsRow['fleet_end_stay']; // == 100%
				$elementTimeB 	= $fleetsRow['fleet_end_stay'] - $fleetsRow['start_time']; // == 100%
				$actualT 		= 100;
			}elseif($fleetsRow['fleet_mess'] == 1){
				$endTime 		= $fleetsRow['fleet_end_time']; // == 100%
				$elementTimeB 	= $fleetsRow['fleet_end_time'] - $fleetsRow['fleet_end_stay']; // == 100%
				$actualT 		= (round(((TIMESTAMP - ($endTime-$elementTimeB)) * 100) / ($endTime - ($endTime-$elementTimeB)), 2).'');
			}
			
			$FlyingFleetList[]	= array(
				'id'			=> $fleetsRow['fleet_id'],
				'mission'		=> $fleetsRow['fleet_mission'],
				'state'			=> $fleetsRow['fleet_mess'],
				'startGalaxy'	=> $fleetsRow['fleet_start_galaxy'], 
				'startSystem'	=> $fleetsRow['fleet_start_system'],
				'startPlanet'	=> $fleetsRow['fleet_start_planet'],
				'startTime'		=> _date($LNG['php_tdformat'], $fleetsRow['fleet_start_time'], $USER['timezone']),
				'endGalaxy'		=> $fleetsRow['fleet_end_galaxy'],
				'endSystem'		=> $fleetsRow['fleet_end_system'],
				'endPlanet'		=> $fleetsRow['fleet_end_planet'],
				'isdisplayedtable'=> $fleetsRow['isdisplayedtable'],
				'endTime'		=> _date($LNG['php_tdformat'], $fleetsRow['fleet_end_time'], $USER['timezone']),
				'amount'		=> pretty_number($fleetsRow['fleet_amount']),
				'fleetEndTime'	=> $fleetEndTime,
				'actualT'		=> $actualT,
				'fleetStartTime'=> $fleetsRow['fleet_start_time'] - TIMESTAMP,
				'returntime'	=> $returnTime,
				'resttime'		=> $returnTime - TIMESTAMP,
				'FleetList'		=> $FleetList[$fleetsRow['fleet_id']],
				'FRessource'	=> $FRessource,
				'FleetType'		=> $FleetType,
				'fleet_start_time'		=> $fleetsRow['fleet_start_time'],
				'start_time'		=> $fleetsRow['start_time'],
				'fleet_end_stay'		=> $fleetsRow['fleet_end_stay'],
				'fleet_end_time'		=> $fleetsRow['fleet_end_time'],
				'planetInfoSen'	=> $planetInfoSender['name'],
				'planetInfoSenimg'	=> $planetInfoSender['image'],
				'planetInfoSen1'=> empty($planetInfoTarget) ? "Unknown planet" : $planetInfoTarget['name'],
				'planetInfoSen1Img'=> empty($planetInfoTarget) ? "expedition" : $planetInfoTarget['image'],
				'fleet_target_owner'=> empty($fleetsRow['fleet_target_owner']) ? 0 : $fleetsRow['fleet_target_owner'],
			);
		}
		$FleetsOnPlanet	= array();
		$FleetsOnPlanetBattle	= array();
		$elementPlanetBattle	= array(204,205,229,206,207,215,213,211,224,225,226,214,216,227,230,228,222,218,221);
		$FleetsOnPlanetTransport	= array();
		$elementPlanetTransport	= array(202,203,217);
		$FleetsOnPlanetProcessorcs	= array();
		$elementPlanetProcessorcs	= array(209,219);
		$FleetsOnPlanetSpecial	= array();
		$elementPlanetSpecial	= array(208,210,220,223);
		if($targetMission == 11)
			$elementPlanetSpecial	= array(220);
		
		//AUTO EXPO QUERIES
		$sql	= 'SELECT * FROM %%AUTOEXPE%% WHERE userId = :playerId AND templateType = 1;';
		$hasAutoExpo = database::get()->selectSingle($sql, array(
			':playerId'			=> $USER['id']
		));
		$sql	= 'SELECT * FROM %%AUTOEXPE%% WHERE userId = :playerId AND templateType = 2;';
		$hasAutoHostile = database::get()->selectSingle($sql, array(
			':playerId'			=> $USER['id']
		));
		$fleetArrayExpo	= array();
		$fleetArrayHostile	= array();
		if(!empty($hasAutoExpo)){
			$waveArray		= explode(';', $hasAutoExpo['waveArray']);
			foreach($waveArray as $Item)
			{
				$temp = explode(',', $Item);
				$fleetArrayExpo[$temp[0]] 		= $temp[1];
			}
		}
		if(!empty($hasAutoHostile)){
			$waveArray		= explode(';', $hasAutoHostile['waveArray']);
			foreach($waveArray as $Item)
			{
				$temp = explode(',', $Item);
				$fleetArrayHostile[$temp[0]] 		= $temp[1];
			}
		}
		//AUTO EXPO QUERIES
		
		foreach($reslist['fleet'] as $FleetID)
		{
			if ($PLANET[$resource[$FleetID]] == 0)
				continue;
				
			$FleetsOnPlanet[]	= array(
				'id'	=> $FleetID,
				'speed'	=> FleetFunctions::GetFleetMaxSpeed($FleetID, $USER),
				'count'	=> $PLANET[$resource[$FleetID]],
				'count1'=> isset($fleetArrayExpo[$FleetID]) ? $fleetArrayExpo[$FleetID] : 0,
				'count2'=> isset($fleetArrayHostile[$FleetID]) ? $fleetArrayHostile[$FleetID] : 0,
			);
		}
		
		foreach($elementPlanetBattle as $FleetID)
		{
			if ($PLANET[$resource[$FleetID]] == 0)
				continue;
				
			$FleetsOnPlanetBattle[]	= array(
				'id'	=> $FleetID,
				'speed'	=> FleetFunctions::GetFleetMaxSpeed($FleetID, $USER),
				'count'	=> $PLANET[$resource[$FleetID]],
				'count1'=> isset($fleetArrayExpo[$FleetID]) ? $fleetArrayExpo[$FleetID] : 0,
				'count2'=> isset($fleetArrayHostile[$FleetID]) ? $fleetArrayHostile[$FleetID] : 0,
			);
		}
		
		foreach($elementPlanetTransport as $FleetID)
		{
			if ($PLANET[$resource[$FleetID]] == 0)
				continue;
				
			$FleetsOnPlanetTransport[]	= array(
				'id'	=> $FleetID,
				'speed'	=> FleetFunctions::GetFleetMaxSpeed($FleetID, $USER),
				'count'	=> $PLANET[$resource[$FleetID]],
				'count1'=> isset($fleetArrayExpo[$FleetID]) ? $fleetArrayExpo[$FleetID] : 0,
				'count2'=> isset($fleetArrayHostile[$FleetID]) ? $fleetArrayHostile[$FleetID] : 0,
			);
		}
		
		foreach($elementPlanetProcessorcs as $FleetID)
		{
			if ($PLANET[$resource[$FleetID]] == 0)
				continue;
				
			$FleetsOnPlanetProcessorcs[]	= array(
				'id'	=> $FleetID,
				'speed'	=> FleetFunctions::GetFleetMaxSpeed($FleetID, $USER),
				'count'	=> $PLANET[$resource[$FleetID]],
				'count1'=> isset($fleetArrayExpo[$FleetID]) ? $fleetArrayExpo[$FleetID] : 0,
				'count2'=> isset($fleetArrayHostile[$FleetID]) ? $fleetArrayHostile[$FleetID] : 0,
			);
		}
		
		foreach($elementPlanetSpecial as $FleetID)
		{
			if ($PLANET[$resource[$FleetID]] == 0)
				continue;
				
			$FleetsOnPlanetSpecial[]	= array(
				'id'	=> $FleetID,
				'speed'	=> FleetFunctions::GetFleetMaxSpeed($FleetID, $USER),
				'count'	=> $PLANET[$resource[$FleetID]],
				'count1'=> isset($fleetArrayExpo[$FleetID]) ? $fleetArrayExpo[$FleetID] : 0,
				'count2'=> isset($fleetArrayHostile[$FleetID]) ? $fleetArrayHostile[$FleetID] : 0,
			);
		}
		

		$sql	= 'SELECT * FROM %%FLEETS_GROUP%% WHERE ownerId = :userId;';
		$userGroupShips = $db->select($sql, array(
			':userId'	=> $USER['id']
		));
		
		$groupStartId = 0;
		foreach($userGroupShips as $userShip){
			
		$shipInfo[$userShip['groupId']] = FleetFunctions::unserialize($userShip['fleetData']);
		
		$userGroupShip[]	= array(
				'FleetList'		=> $shipInfo[$userShip['groupId']],
				'groupName'		=> $userShip['groupName'],
				'groupId'		=> $groupStartId,
				'groupIdDel'		=> $userShip['groupId'],
			);
		$groupStartId++;
		}
		
		$showproce = 0;
		if($targetMission == 15 || $targetMission == 1 || $targetMission == 18){
		$showproce = 1;	
		}
		
		$showattack = 0;
		if($targetMission == 11){
		$showattack = 1;	
		}
		
		$showtrans = 0;
		if($targetMission == 11){
		$showtrans = 1;	
		}
		
		$showrecyc = 0;
		if($targetMission == 11){
		$showrecyc = 1;	
		}
		
		
		
		$gouvernor_attack = 0;
		if($USER['dm_attack'] > TIMESTAMP){
		$gouvernor_attack = GubPriceAPSTRACT(701, $USER['dm_attack_level'], 'dm_attack');
		}
			
		$gouvernor_shield = 0;
		if($USER['dm_defensive'] > TIMESTAMP){
		$gouvernor_shield = GubPriceAPSTRACT(702, $USER['dm_defensive_level'], 'dm_defensive');
		}
		
		$arsenal_1  = $pricelist[811]['arsenal_bonus'] * $USER['arsenal_combustion_level'];
		$arsenal_2  = $pricelist[812]['arsenal_bonus'] * $USER['arsenal_impulse_level'];
		$arsenal_3  = $pricelist[813]['arsenal_bonus'] * $USER['arsenal_hyperspace_level'];
		$activeAsteroids	= FleetFunctions::GetCurrentFleets($USER['id'], 16, true);
		$maxAsteroids		= floor(4 + floor($USER['asteroid_mine_tech'] / 5));
		
		$sql	= 'SELECT total_alliance_power FROM %%ALLIANCE%% WHERE id = :allyId;';
		$ExistAlliance = database::get()->selectSingle($sql, array(
			':allyId'	=> $USER['ally_id']
		));
		
		$BonusAlliance = 0;
		if(!empty($ExistAlliance))
			$BonusAlliance = $ExistAlliance['total_alliance_power']/2;
		
		$sql	= 'SELECT COUNT(*) as state FROM %%PLANETS%% WHERE `id_owner` = :userId AND `planet_type` = 1 AND `destruyed` = 0 AND gal6mod = 0 AND isAlliancePlanet = 0;';
		$currentPlanetCountTable	= $db->selectSingle($sql, array(
			':userId'		=> $USER['id'],
		), 'state');
		
		$sql	= 'SELECT COUNT(*) as state FROM %%PLANETAUCTION%% WHERE `buyerID` = :buyerID OR selledID = :buyerID;';
		$currentPlanetCountBis	= database::get()->selectSingle($sql, array(
			':buyerID'		=> $USER['id'],
		), 'state');

		$maxPlanetCount		= PlayerUtil::maxPlanetCount($USER);
		
		$stayBlockExpo		= array();
		$stayBlockHostile	= array();
		
		$premium_speed_expeditions = 0;
		if($USER['prem_speed_expiditeon'] > 0 && $USER['prem_speed_expiditeon_days'] > TIMESTAMP){
			$premium_speed_expeditions = $USER['prem_speed_expiditeon'];
		}
		
		$ally_fraction_expe_speed = 0;
		if($USER['ally_id'] != 0){
			$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
			$ALLIANCE = Database::get()->selectSingle($sql, array(
			':allyID'	=> $USER['ally_id']
			));
			if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
				$FRACTIONS = Database::get()->selectSingle($sql, array(
				':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
				));
				$ally_fraction_expe_speed = $FRACTIONS['ally_fraction_expe_speed'] * $ALLIANCE['ally_fraction_level'];
			}
		}
		
		$haltSpeed	= Config::get($USER['universe'])->halt_speed;
		$haltSpeed	+= ($haltSpeed / 100 * $premium_speed_expeditions) + ($haltSpeed / 100 * $ally_fraction_expe_speed);

		$premium_expe_slots = 0;
		if($USER['prem_count_expiditeon'] > 0 && $USER['prem_count_expiditeon_days'] > TIMESTAMP){
			$premium_expe_slots = $USER['prem_count_expiditeon'];
		}
		
		for($i = 1;$i <= $USER[$resource[124]] + $premium_expe_slots;$i++)
		{
			$stayBlockExpo[$i]	= round($i / $haltSpeed, 2);
		}
		
		for($i = 1;$i <= $USER[$resource[124]] + $premium_expe_slots;$i++)
		{
			$stayBlockHostile[$i]	= round($i / $haltSpeed, 2);
		}
		
		
		$this->assign(array(
			'currentPlanetCountTable'		=> $currentPlanetCountTable + $currentPlanetCountBis,
			'stayBlockExpo'					=> $stayBlockExpo,
			'stayBlockHostile'				=> $stayBlockHostile,
			'moduleNormalPlanet'			=> min(9, $currentPlanetCountTable),
			'moduleResearchPlanet'			=> $currentPlanetCountTable > 9 ? min(15, $currentPlanetCountTable - 9) : 0,
			'moduleAcademyPlanet'			=> $USER['academy_p_b_2_1206'],
			'moduleAcademyFleet'			=> $USER['academy_p_b_1_1106'],
			'moduleFlotteTech'			    => $USER['computer_tech'], 
			'moduleAsteroide'			    => ($USER['asteroid_mine_tech']/5),	
			'modulespedizione'			    => FleetFunctions::getExpeditionLimit($USER),	
			'modulepremiuespee'			    => $USER['prem_count_expiditeon_days'] >= TIMESTAMP ? $USER['prem_count_expiditeon'] : 0,
			'maxPlanetCount'				=> $maxPlanetCount,
			'userGroupShips'				=> count($userGroupShips),
			'userGroupShip'					=> $userGroupShip,
			'showproce'						=> $showproce,
			'showrecyc'						=> $showrecyc,
			'showtrans'						=> $showtrans, 
			'showattack'					=> $showattack,
			'FleetsOnPlanet'				=> $FleetsOnPlanet,
			'FleetsOnPlanetBattle'			=> $FleetsOnPlanetBattle,
			'FleetsOnPlanetTransport'		=> $FleetsOnPlanetTransport,
			'FleetsOnPlanetProcessorcs'		=> $FleetsOnPlanetProcessorcs,
			'FleetsOnPlanetSpecial'			=> $FleetsOnPlanetSpecial,
			'FlyingFleetList'				=> $FlyingFleetList,
			'activeExpedition'				=> $activeExpedition,
			'activeCapture'					=> $activeCapture,
			'maxExpedition'					=> $maxExpedition,
			'hasAutoExpoWave'				=> !empty($hasAutoExpo) ? $hasAutoExpo['waveCount'] : 0,
			'hasAutoExpoActiv'				=> !empty($hasAutoExpo) ? $hasAutoExpo['isActive'] : 0,
			'hasAutoExpoHoures'				=> !empty($hasAutoExpo) ? $hasAutoExpo['waveHours'] : 1,
			'hasAutoExpoSpeed'				=> !empty($hasAutoExpo) ? $hasAutoExpo['waveSpeed'] : 10,
			'hasAutoHostileWave'			=> !empty($hasAutoHostile) ? $hasAutoHostile['waveCount'] : 0,
			'hasAutoHostileActiv'			=> !empty($hasAutoHostile) ? $hasAutoHostile['isActive'] : 0,
			'hasAutoHostileHoures'			=> !empty($hasAutoHostile) ? $hasAutoHostile['waveHours'] : 0,
			'hasAutoHostileSpeed'			=> !empty($hasAutoHostile) ? $hasAutoHostile['waveSpeed'] : 0,
			'getGalaxySenAnt'				=> $getGalaxySevenAccount,
			'activeFleetSlots'				=> $activeFleetSlots,
			'activeAsteroids'				=> $activeAsteroids,
			'maxAsteroids'					=> $maxAsteroids,
			'maxFleetSlots'					=> $maxFleetSlots,
			'targetGalaxy'					=> $targetGalaxy,
			'getTypetoDisp'					=> $getTypetoDisp,
			'targetSystem'					=> $targetSystem,
			'targetPlanet'					=> $targetPlanet,
			'targetType'					=> $targetType,
			'targetMission'					=> $targetMission,
			'acsData'						=> $acsData,
			'isVacation'					=> IsVacationMode($USER),
			'bonusAttack'					=> $USER[$resource[109]] + $gouvernor_attack + $USER['rpg_amiral'] + $USER['combat_exp_level'] + $USER['academy_p_b_1_1101'] + ($USER['academy_p_b_1_1102']*2) + $BonusAlliance - $USER['academy_p_b_3_1302'],
			'bonusDefensive'				=> $USER[$resource[110]] + $gouvernor_shield + $USER['combat_exp_level'] + $USER['rpg_amiral'] + $USER['academy_p_b_3_1301'] + ($USER['academy_p_b_3_1302']*2) + $BonusAlliance - $USER['academy_p_b_1_1102'],
			'bonusShield'					=> $USER[$resource[111]] + $gouvernor_shield + $USER['combat_exp_level'] + $USER['rpg_amiral'] + $USER['academy_p_b_3_1301'] + ($USER['academy_p_b_3_1302']*2) + $BonusAlliance - $USER['academy_p_b_1_1102'],
			'bonusCombustion'				=> $USER[$resource[115]] * 10 + ($USER[$resource[115]] * 10 / 100 * $arsenal_1),
			'bonusImpulse'					=> $USER[$resource[117]] * 20 + ($USER[$resource[117]] * 20 / 100 * $arsenal_2),
			'bonusHyperspace'				=> $USER[$resource[118]] * 30 + ($USER[$resource[118]] * 30 / 100 * $arsenal_3),
		));
		
		$this->display('page.fleetTable.default.tpl');
	}
}