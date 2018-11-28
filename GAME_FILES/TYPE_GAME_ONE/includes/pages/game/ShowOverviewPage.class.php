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

class ShowOverviewPage extends AbstractGamePage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
	}

	private function GetFleets() {
		global $USER, $PLANET;
		require 'includes/classes/class.FlyingFleetsTable.php';
		$fleetTableObj = new FlyingFleetsTable;
		$fleetTableObj->setUser($USER['id']);
		$fleetTableObj->setPlanet($PLANET['id']);
		return $fleetTableObj->renderTable();
	}
	
	function cronLost(){
		global $USER;
		
		$showCronLocked = 0;
		$sql = "SELECT * FROM %%CRONJOBS%% WHERE cronjobID = 30;";
		$cronjobDataLock = database::get()->selectSingle($sql, array());
		if(!empty($cronjobDataLock['lock']) && $cronjobDataLock['nextTime'] < TIMESTAMP - 5 * 60) $showCronLocked = 1;
		
		if($showCronLocked == 1){
			$USER['antimatter'] += 5000;
			$sql = "UPDATE %%USERS%% SET antimatter = antimatter + 5000 WHERE id = :userId;";
			database::get()->update($sql, array(
				':userId'	=> $USER['id']
			));
			$sql = "UPDATE %%CRONJOBS%% SET `lock` = 0 WHERE cronjobID = 30;";
			database::get()->update($sql, array());
			ClearCache();
			$this->printMessage("You successfully restarted the automated expedition cronjob", true, array('game.php?page=overview', 2));
		}else{
			$this->printMessage("The automated expedition cronjob is not locked !", true, array('game.php?page=overview', 2));
		}
	}
	
	function savePlanetAction()
	{
		global $USER, $PLANET, $LNG;
		$password =	HTTP::_GP('password', '', true);
		if (!empty($password))
		{
			$db = Database::get();
            $sql = "SELECT COUNT(*) as state FROM %%FLEETS%% WHERE
                      (fleet_owner = :userID AND (fleet_start_id = :planetID OR fleet_start_id = :lunaID)) OR
                      (fleet_target_owner = :userID AND (fleet_end_id = :planetID OR fleet_end_id = :lunaID));";
            $IfFleets = $db->selectSingle($sql, array(
                ':userID'   => $USER['id'],
                ':planetID' => $PLANET['id'],
                ':lunaID'   => $PLANET['id_luna']
            ), 'state');

            if ($IfFleets > 0)
				exit(json_encode(array('message' => $LNG['ov_abandon_planet_not_possible'])));
			elseif ($USER['id_planet'] == $PLANET['id'])
				exit(json_encode(array('message' => $LNG['ov_principal_planet_cant_abanone'])));
			elseif (PlayerUtil::cryptPassword($password) != $USER['password'])
				exit(json_encode(array('message' => $LNG['ov_wrong_pass'])));
			else
			{
				if($PLANET['planet_type'] == 1) {
					$sql = "UPDATE %%PLANETS%% SET destruyed = :time WHERE id = :planetID;";
                    $db->update($sql, array(
                        ':time'   => TIMESTAMP + 86400,
                        ':planetID' => $PLANET['id'],
                    ));
                    $sql = "DELETE FROM %%PLANETS%% WHERE id = :lunaID;";
                    $db->delete($sql, array(
                        ':lunaID' => $PLANET['id_luna']
                    ));
                } else {
                    $sql = "UPDATE %%PLANETS%% SET id_luna = 0 WHERE id_luna = :planetID;";
                    $db->update($sql, array(
                        ':planetID' => $PLANET['id'],
                    ));
                    $sql = "DELETE FROM %%PLANETS%% WHERE id = :planetID;";
                    $db->delete($sql, array(
                        ':planetID' => $PLANET['id'],
                    ));
                }
				
				$PLANET['id']	= $USER['id_planet'];
				exit(json_encode(array('ok' => true, 'message' => $LNG['ov_planet_abandoned'])));
			}
		}
	}
		
	function show()
	{
		global $LNG, $PLANET, $USER, $CONF;
		
		$AdminsOnline 	= array();
		$Moon 			= array();

        $db = Database::get();
		
		$Moon = 0;
		if ($PLANET['id_luna'] != 0) {
			$sql = "SELECT id, name FROM %%PLANETS%% WHERE id = :lunaID;";
            $Moon = $db->selectSingle($sql, array(
                ':lunaID'   => $PLANET['id_luna']
            ));
        }
			
		if ($PLANET['b_building'] - TIMESTAMP > 0) {
			$Queue			= unserialize($PLANET['b_building_id']);
			$buildBusy['buildings']	= array(
				'id'		=> $Queue[0][0],
				'level'		=> $Queue[0][1],
				'timeleft'	=> $PLANET['b_building'] - TIMESTAMP,
				'time'		=> $PLANET['b_building'],
				'starttime'	=> pretty_time($PLANET['b_building'] - TIMESTAMP),
			);
		}
		else {
			$buildBusy['buildings']	= false;
		}
		
		/* As FR#206 (http://tracker.2moons.cc/view.php?id=206), i added the shipyard and research status here, but i add not them the template. */
		
		if (!empty($PLANET['b_hangar_id'])) {
			$Queue	= unserialize($PLANET['b_hangar_id']);
			$time	= BuildFunctions::getBuildingTime($USER, $PLANET, $Queue[0][0]) * $Queue[0][1];
			$buildBusy['fleet']	= array(
				'id'		=> $Queue[0][0],
				'level'		=> $Queue[0][1],
				'timeleft'	=> $time - $PLANET['b_hangar'],
				'time'		=> $time,
				'starttime'	=> pretty_time($time - $PLANET['b_hangar']),
			);
		}
		else {
			$buildBusy['fleet']	= false;
		}
		
		if (!empty($PLANET['b_defense_id'])) {
			$Queue	= unserialize($PLANET['b_defense_id']);
			$time	= BuildFunctions::getBuildingTime($USER, $PLANET, $Queue[0][0]) * $Queue[0][1];
			$buildBusy['defense']	= array(
				'id'		=> $Queue[0][0],
				'level'		=> $Queue[0][1],
				'timeleft'	=> $time - $PLANET['b_defense'],
				'time'		=> $time,
				'starttime'	=> pretty_time($time - $PLANET['b_defense']),
			);
		}
		else {
			$buildBusy['defense']	= false;
		}
		
		if ($USER['b_tech'] - TIMESTAMP > 0) {
			$Queue			= unserialize($USER['b_tech_queue']);
			$buildBusy['tech']	= array(
				'id'		=> $Queue[0][0],
				'level'		=> $Queue[0][1],
				'timeleft'	=> $USER['b_tech'] - TIMESTAMP,
				'time'		=> $USER['b_tech'],
				'starttime'	=> pretty_time($USER['b_tech'] - TIMESTAMP),
			);
		}
		else {
			$buildBusy['tech']	= false;
		}
		
		$sql = "SELECT id,username,customNick FROM %%USERS%% WHERE universe = :universe AND onlinetime >= :onlinetime AND authlevel > :authlevel;";
		//$sql = "SELECT id,username,customNick FROM %%USERS%% WHERE universe = :universe AND onlinetime >= :onlinetime AND authlevel > :authlevel;";
        $onlineAdmins = $db->select($sql, array(
            ':universe'     => Universe::current(),
            ':onlinetime'   => TIMESTAMP-10*60,
            ':authlevel'    => 2
        ));

        foreach ($onlineAdmins as $AdminRow) {
			$AdminsOnline[$AdminRow['id']]	= empty($AdminRow['customNick']) ? $AdminRow['username'] : $AdminRow['customNick'];
		}

		$Messages		= $USER['messages'];
		
		$config	= Config::get();
		
		$sql	= 'SELECT *
		FROM %%STATPOINTS%%
		WHERE id_owner = :userId AND stat_type = :statType';

		$statData	= Database::get()->selectSingle($sql, array(
			':userId'	=> $USER['id'],
			':statType'	=> 1
		));
		
		$ranking	= $statData['total_old_rank'] - $statData['total_rank'];
		if($ranking == 0){
		$position = "<span style='color:#87CEEB'>(*)</span>";
		}elseif($ranking < 0){
		$position = "<span style='color:red'>(".$ranking.")</span>";
		}elseif ($ranking > 0){
		$position = "<span style='color:green'>(+".$ranking.")</span>";
		}

		if($statData['total_rank'] == 0) {
			$rankInfo	= "-";
		} else {
			$rankInfo	= sprintf($LNG['ov_userrank_info'], pretty_number($statData['total_points']), $LNG['ov_place'],
				$statData['total_rank'], $statData['total_rank'], $position, $LNG['ov_of'], $config->users_amount);
		}
		
		if($statData['tech_rank'] == 0) {
			$rankInfo1Mod	= "-";
		} else {
			$rankInfo1Mod	= sprintf($LNG['ov_userrank_info'], pretty_number($statData['tech_points']), $LNG['ov_place'],
				$statData['tech_rank'], $statData['tech_rank'], $position, $LNG['ov_of'], $config->users_amount);
		}
		
		if($statData['build_rank'] == 0) {
			$rankInfo2Mod	= "-";
		} else {
			$rankInfo2Mod	= sprintf($LNG['ov_userrank_info'], pretty_number($statData['build_points']), $LNG['ov_place'],
				$statData['build_rank'], $statData['build_rank'], $position, $LNG['ov_of'], $config->users_amount);
		}
		
		if($statData['fleet_rank'] == 0) {
			$rankInfo3Mod	= "-";
		} else {
			$rankInfo3Mod	= sprintf($LNG['ov_userrank_info'], pretty_number($statData['fleet_points']), $LNG['ov_place'],
				$statData['fleet_rank'], $statData['fleet_rank'], $position, $LNG['ov_of'], $config->users_amount);
		}
		
		if($statData['defs_rank'] == 0) {
			$rankInfo4Mod	= "-";
		} else {
			$rankInfo4Mod	= sprintf($LNG['ov_userrank_info'], pretty_number($statData['defs_points']), $LNG['ov_place'],
				$statData['defs_rank'], $statData['defs_rank'], $position, $LNG['ov_of'], $config->users_amount);
		}
		
		$sql	= 'SELECT COUNT(*) as count FROM %%USERS%% WHERE universe = :universe AND onlinetime > :onlineTime';
		$onlineData	= Database::get()->selectSingle($sql, array(
			':universe'	=> Universe::current(),
			':onlineTime'	=> TIMESTAMP - 30 * 60
		));
		
		$balken = $onlineData['count'];
		
		$sql = 'SELECT COUNT(*) as count FROM %%TRANSPORTLOGS%% WHERE (senderID = :senderID AND legal = :legal AND reviewed = 0) OR (receiverID = :receiverID AND legal = :legal AND reviewed = 0);';
		$GeTransportCount	= Database::get()->selectSingle($sql, array(
			':senderID'	=> $USER['id'],
			':receiverID'	=> $USER['id'],
			':legal'	=> 1 
		)); 
		 
		$string = $PLANET['gal6type'] + 100;
		
		//NEW FLEET MODULE
		$sql = "SELECT * FROM %%FLEETS%% WHERE fleet_owner = :userID AND fleet_mission <> 10 ORDER BY fleet_end_time ASC;";
        $fleetResultModule = database::get()->select($sql, array(
            ':userID'   => $USER['id']
        ));
        $activeFleetSlotsModule	= database::get()->rowCount();
		$maxFleetSlotsModule	= FleetFunctions::GetMaxFleetSlots($USER);
		$sql	= 'SELECT COUNT(*) as state FROM %%PLANETS%% WHERE `id_owner` = :userId AND `planet_type` = 1 AND `destruyed` = 0 AND gal6mod = 0;';
		$currentPlanetCountModule	= database::get()->selectSingle($sql, array(
			':userId'		=> $USER['id'],
		), 'state');
		
		$sql	= 'SELECT COUNT(*) as state FROM %%PLANETAUCTION%% WHERE `buyerID` = :buyerID OR selledID = :buyerID;';
		$currentPlanetCountBisModule	= database::get()->selectSingle($sql, array(
			':buyerID'		=> $USER['id'],
		), 'state');

		$maxPlanetCountModule		= PlayerUtil::maxPlanetCount($USER);
		///END NEW FLEET MODULE
		
		
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
			
			$PlanetSendData		   	= GetFromDatabase('PLANETS', 'id', $fleetsRow['fleet_start_id'], array('name', 'image'));
			$PlanetTargData		   	= GetFromDatabase('PLANETS', 'id', $fleetsRow['fleet_end_id'], array('name', 'image'));
			$PlayerTargData			= GetFromDatabase('USERS', 'id', $fleetsRow['fleet_target_owner'], array('username'));
			$Owner					= $fleetsRow['fleet_owner'] == $USER['id'];
			$MissionType    		= $fleetsRow['fleet_mission'];
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
			$FleetPrefix   			= ($Owner == true) ? 'own' : '';
			$FleetType				= $FleetPrefix.$FleetStyle[$MissionType];
			$FleetStatus    		= array(0 => 'flight', 1 => 'return' , 2 => 'holding');
			$StatusSS    				= $fleetsRow['fleet_mess'];
			$FlyingFleetList[]	= array(
				'planetStart'	=> GetStartAddressLink($fleetsRow, $FleetType),
				'planetEnd'		=> GetTargetAddressLink($fleetsRow, $FleetType),
				'PlayerTargData'=> $PlayerTargData['username'],
				'PlanetSendImg'	=> $PlanetSendData['image'],
				'PlanetSendNam'	=> $PlanetSendData['name'],
				'PlanetTargImg'	=> $fleetsRow['fleet_end_id'] == 0 ? "ex".rand(1,4) : $PlanetTargData['image'],
				'PlanetTargNam'	=> $MissionType == 18 ? "Endless Galaxy" : $PlanetTargData['name'],
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
				'endTime'		=> _date($LNG['php_tdformat'], $fleetsRow['fleet_end_time'], $USER['timezone']),
				'amount'		=> pretty_number($fleetsRow['fleet_amount']),
				'returntime'	=> $returnTime,
				'resttime'		=> $returnTime - TIMESTAMP,
				'FleetList'		=> $FleetList[$fleetsRow['fleet_id']],
				'fleet_metal'	=> $fleetsRow['fleet_resource_metal'],
				'fleet_crystal'	=> $fleetsRow['fleet_resource_crystal'],
				'fleet_deuter'	=> $fleetsRow['fleet_resource_deuterium'],
				'fleet_darkm'	=> $fleetsRow['fleet_resource_darkmatter'],
				'missionName'	=> $LNG['type_mission'][$fleetsRow['fleet_mission']],
				'missionName'	=> "<span class='".$FleetStatus[$StatusSS]." ".$FleetType."'>".$LNG['type_mission'][$fleetsRow['fleet_mission']]."</span>",
				'DisplayStart'	=> $fleetsRow['fleet_start_time'] - TIMESTAMP,
				'DisplayStayTime'=> $fleetsRow['fleet_mess'] != 2 ? ($fleetsRow['fleet_end_stay'] - $fleetsRow['fleet_start_time']) : $fleetsRow['fleet_end_stay'] - TIMESTAMP,
			);
		}	
		$this->assign(array(
			'currentPlanetCountModule'	=> $currentPlanetCountModule + $currentPlanetCountBisModule,
			'FlyingFleetList'			=> $FlyingFleetList,
			'maxPlanetCountModule'		=> $maxPlanetCountModule,
			'activeFleetSlotsModule'	=> $activeFleetSlotsModule,
			'maxFleetSlotsModule'		=> $maxFleetSlotsModule,
			'getBuildPointMod'			=> $rankInfo2Mod,
			'getTechPointMod'			=> $rankInfo1Mod,
			'isVacation'				=> IsVacationMode($USER),
			'getFleetPointMod'			=> $rankInfo3Mod,
			'getDefensePointMod'		=> $rankInfo4Mod,
			'cookiesStatDisplay'		=> isset($_COOKIE['salle_de_controle-detail_statistique']) ? $_COOKIE['salle_de_controle-detail_statistique'] : 'false', 
			'GeTransportCount'			=> $GeTransportCount['count'],
			'rankInfo'					=> $rankInfo,
			'ExpireTIme'				=> ((!empty($PLANET['gal6mod']) && $PLANET['expiredTime'] > TIMESTAMP) ? ($PLANET['expiredTime'] - TIMESTAMP) : 0),
			'is_news'					=> $config->OverviewNewsFrame,
			'news'						=> makebr($config->OverviewNewsText),
			'planetname'				=> $PLANET['name'],
			'planetimage'				=> $PLANET['image'],
			'gal6modOver'				=> $PLANET['gal6mod'],
			'gal6descOver'				=> $PLANET['gal6mod'] == 1 ? $LNG['galaxy6mod'][$PLANET['gal6type']] : "",
			'gal6type'					=> $PLANET['gal6type'] + 100,
			'gal6lvl'					=> max(1,floor($string / 100)),
			'galaxy'					=> $PLANET['galaxy'],
			'system'					=> $PLANET['system'],
			'planet'					=> $PLANET['planet'],
			'planet_type'				=> $PLANET['planet_type'],
			'username'					=> empty($USER['customNick']) ? $USER['username'] : $USER['customNick'],
			'userid'					=> $USER['id'],
			'Moon'						=> $Moon,
			'buildBusy'						=> $buildBusy,
			'fleets'					=> $this->GetFleets(),
			'AdminsOnline'				=> $AdminsOnline,
			//'AdminsOnline'				=> array(),
			'messages'					=> ($Messages > 0) ? (($Messages == 1) ? $LNG['ov_have_new_message'] : sprintf($LNG['ov_have_new_messages'], pretty_number($Messages))): false,
			'planet_diameter'			=> pretty_number($PLANET['diameter']),
			'planet_field_current' 		=> $PLANET['field_current'],
			'planet_field_max' 			=> CalculateMaxPlanetFields($PLANET),
			'planet_temp_min' 			=> $PLANET['temp_min'],
			'planet_temp_max' 			=> $PLANET['temp_max'],
			'path'						=> HTTP_PATH,
			'planetStructure'              => $PLANET['planet_type'] == 1 ? $LNG['planet_structure'][$PLANET['image']] : "",
			'online_users'              => $balken,		'balken',
		));
		
		$this->display('page.overview.default.tpl');
	}
	
	function actions() 
	{
		global $LNG, $PLANET;

		$this->initTemplate();
		$this->setWindow('popup');

		$this->assign(array(
			'ov_security_confirm'		=> sprintf($LNG['ov_security_confirm'], $PLANET['name'].' ['.$PLANET['galaxy'].':'.$PLANET['system'].':'.$PLANET['planet'].']'),
		));
		$this->display('page.overview.actions.tpl');
	}
	
	function rename() 
	{
		global $LNG, $PLANET;

		$newname        = HTTP::_GP('name', '', UTF8_SUPPORT);
		if (!empty($newname))
		{
			if (!PlayerUtil::isNameValid($newname)) {
				$this->sendJSON(array('message' => $LNG['ov_newname_specialchar'], 'error' => true));
			} else {
				$db = Database::get();
                $sql = "UPDATE %%PLANETS%% SET name = :newName WHERE id = :planetID;";
                $db->update($sql, array(
                    ':newName'  => $newname,
                    ':planetID' => $PLANET['id']
                ));

                $this->sendJSON(array('message' => $LNG['ov_newname_done'], 'error' => false));
			}
		}
	}
	
	function delete() 
	{
		global $LNG, $PLANET, $USER;
		$password	= HTTP::_GP('password', '', true);
		
		if (!empty($password))
		{
            $db = Database::get();
            $sql = "SELECT COUNT(*) as state FROM %%FLEETS%% WHERE
                      (fleet_owner = :userID AND (fleet_start_id = :planetID OR fleet_start_id = :lunaID)) OR
                      (fleet_target_owner = :userID AND (fleet_end_id = :planetID OR fleet_end_id = :lunaID));";
            $IfFleets = $db->selectSingle($sql, array(
                ':userID'   => $USER['id'],
                ':planetID' => $PLANET['id'],
                ':lunaID'   => $PLANET['id_luna']
            ), 'state');

			if ($IfFleets > 0) {
				$this->sendJSON(array('message' => $LNG['ov_abandon_planet_not_possible']));
			} elseif ($USER['id_planet'] == $PLANET['id']) {
				$this->sendJSON(array('message' => $LNG['ov_principal_planet_cant_abanone']));
			} elseif (PlayerUtil::cryptPassword($password) != $USER['password']) {
				$this->sendJSON(array('message' => $LNG['ov_wrong_pass']));
			} else {
                if($PLANET['planet_type'] == 1) {
                    $sql = "UPDATE %%PLANETS%% SET destruyed = :time WHERE id = :planetID;";
                    $db->update($sql, array(
                        ':time'   => TIMESTAMP+ 86400,
                        ':planetID' => $PLANET['id'],
                    ));
                    $sql = "DELETE FROM %%PLANETS%% WHERE id = :lunaID;";
                    $db->delete($sql, array(
                        ':lunaID' => $PLANET['id_luna']
                    ));
                } else {
                    $sql = "UPDATE %%PLANETS%% SET id_luna = 0 WHERE id_luna = :planetID;";
                    $db->update($sql, array(
                        ':planetID' => $PLANET['id'],
                    ));
                    $sql = "DELETE FROM %%PLANETS%% WHERE id = :planetID;";
                    $db->delete($sql, array(
                        ':planetID' => $PLANET['id'],
                    ));
                }

                $_SESSION['planet']     = $USER['id_planet'];
				$this->sendJSON(array('ok' => true, 'message' => $LNG['ov_planet_abandoned']));
			}
		}
	}
	
	function allianceSwitch() 
	{
		global $LNG, $PLANET, $USER;
		
		$sql = 'SELECT total_points FROM %%STATPOINTS%% WHERE id_owner = :StartOwner;';
		$userRank	= Database::get()->selectSingle($sql, array(
			':StartOwner'	=> $USER['id']
		));
		
		$sql = 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyId;';
		$allyInfo	= Database::get()->selectSingle($sql, array(
			':allyId'	=> $USER['ally_id']
		));
		
		if ($userRank['total_points'] >= 50000000){
			$this->redirectTo('game.php?page=overview');
		}elseif(!empty($allyInfo)){
			
			if($allyInfo['ally_owner'] != $USER['id']){
				$sql	= "UPDATE %%USERS%% SET ally_id = 1, ally_register_time = :timestamp, lastAlly = :lastAlly, lastAllyTime = :lastAllyTime WHERE id = :UserID;";
				database::get()->update($sql, array(
					':UserID'			=> $USER['id'],
					':lastAlly'			=> $USER['ally_id'],
					':timestamp'		=> TIMESTAMP,
					':lastAllyTime'		=> (TIMESTAMP + 24 * 3600)
				));

				$sql	= "UPDATE %%STATPOINTS%% SET id_ally = 1 WHERE id_owner = :UserID AND stat_type = 1;";
				database::get()->update($sql, array(
					':UserID'			=> $USER['id']
				));

				$sql	= "UPDATE %%ALLIANCE%% SET ally_members = (SELECT COUNT(*) FROM %%USERS%% WHERE ally_id = :AllianceID) WHERE id = :AllianceID;";
				database::get()->update($sql, array(
					':AllianceID'			=> $USER['ally_id']
				));
				
				$sql	= "UPDATE %%ALLIANCE%% SET ally_members = (SELECT COUNT(*) FROM %%USERS%% WHERE ally_id = :AllianceID) WHERE id = :AllianceID;";
				database::get()->update($sql, array(
					':AllianceID'			=> 1
				));
			}else{
				$sql = "UPDATE %%USERS%% SET ally_id = '0' WHERE ally_id = :AllianceID;";
				database::get()->update($sql, array(
					':AllianceID'	=> $USER['ally_id']
				));
				
				$sql = "UPDATE %%STATPOINTS%% SET id_ally = '0' WHERE id_ally = :AllianceID;";
				database::get()->update($sql, array(
					':AllianceID'	=> $USER['ally_id']
				));

				$sql = "DELETE FROM %%STATPOINTS%% WHERE id_owner = :AllianceID AND stat_type = 2;";
				database::get()->delete($sql, array(
					':AllianceID'	=> $USER['ally_id']
				));
				
				$sql = "DELETE FROM %%ALLIANCE%% WHERE id = :AllianceID;";
				database::get()->delete($sql, array(
					':AllianceID'	=> $USER['ally_id']
				));

				$sql = "DELETE FROM %%ALLIANCE_REQUEST%% WHERE allianceId = :AllianceID;";
				database::get()->delete($sql, array(
					':AllianceID'	=> $USER['ally_id']
				));

				$sql = "DELETE FROM %%DIPLO%% WHERE owner_1 = :AllianceID OR owner_2 = :AllianceID;";
				database::get()->delete($sql, array(
					':AllianceID'	=> $USER['ally_id']
				));
				
				$sql	= "UPDATE %%USERS%% SET ally_id = 1, ally_register_time = :timestamp, lastAlly = :lastAlly, lastAllyTime = :lastAllyTime WHERE id = :UserID;";
				database::get()->update($sql, array(
					':UserID'			=> $USER['id'],
					':lastAlly'			=> $USER['ally_id'],
					':timestamp'		=> TIMESTAMP,
					':lastAllyTime'		=> (TIMESTAMP + 24 * 3600)
				));

				$sql	= "UPDATE %%STATPOINTS%% SET id_ally = 1 WHERE id_owner = :UserID AND stat_type = 1;";
				database::get()->update($sql, array(
					':UserID'			=> $USER['id']
				));

				$sql	= "UPDATE %%ALLIANCE%% SET ally_members = (SELECT COUNT(*) FROM %%USERS%% WHERE ally_id = :AllianceID) WHERE id = :AllianceID;";
				database::get()->update($sql, array(
					':AllianceID'			=> 1
				));
			}
			$this->redirectTo('game.php?page=alliance');
		}elseif(empty($allyInfo)){
			$sql	= "UPDATE %%USERS%% SET ally_id = 1, ally_register_time = :timestamp, lastAlly = :lastAlly, lastAllyTime = :lastAllyTime WHERE id = :UserID;";
			database::get()->update($sql, array(
				':UserID'			=> $USER['id'],
				':lastAlly'			=> $USER['ally_id'],
				':timestamp'		=> TIMESTAMP,
				':lastAllyTime'		=> 0
			));

			$sql	= "UPDATE %%STATPOINTS%% SET id_ally = 1 WHERE id_owner = :UserID AND stat_type = 1;";
			database::get()->update($sql, array(
				':UserID'			=> $USER['id']
			));

			$sql	= "UPDATE %%ALLIANCE%% SET ally_members = (SELECT COUNT(*) FROM %%USERS%% WHERE ally_id = :AllianceID) WHERE id = :AllianceID;";
			database::get()->update($sql, array(
				':AllianceID'			=> 1
			));
			$this->redirectTo('game.php?page=alliance');
		}
	}
	
}