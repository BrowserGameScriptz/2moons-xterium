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

class ShowFleetStep2Page extends AbstractGamePage
{
	public static $requireModule = MODULE_FLEET_TABLE;

	function __construct() 
	{
		parent::__construct();
	}
	
	public function show()
	{
		global $USER, $PLANET, $LNG, $resource;
	
		$this->tplObj->loadscript('flotten.js');
		
		$targetGalaxy  				= HTTP::_GP('galaxy', 0);
		$targetSystem   			= HTTP::_GP('system', 0);
		$targetPlanet   			= HTTP::_GP('planet', 0);
		$targetType 				= HTTP::_GP('type', 0);
		$targetMission 				= HTTP::_GP('target_mission', 0);
		$fleetSpeed  				= HTTP::_GP('speed', 0);		
		$fleetGroup 				= HTTP::_GP('fleet_group', 0);
		$token						= HTTP::_GP('token', '');

		if (!isset($_SESSION['fleet'][$token]))
		{
			FleetFunctions::GotoFleetPage();
		}

		$fleetArray    				= $_SESSION['fleet'][$token]['fleet'];
		
		if($_SESSION['fleet'][$token]['planetStart'] != $PLANET['id']){
			FleetFunctions::GotoFleetPage();
		}
			
        $db = Database::get();
        $sql = "SELECT id, id_owner, der_metal, der_crystal, gal6mod, isAlliancePlanet FROM %%PLANETS%% WHERE universe = :universe AND galaxy = :targetGalaxy AND system = :targetSystem AND planet = :targetPlanet AND planet_type = '1';";
        $targetPlanetData = $db->selectSingle($sql, array(
            ':universe' => Universe::current(),
            ':targetGalaxy' => $targetGalaxy,
            ':targetSystem' => $targetSystem,
            ':targetPlanet' => $targetPlanet
        ));

       /* if($targetType == 2 && $targetPlanetData['der_metal'] == 0 && $targetPlanetData['der_crystal'] == 0){
			$this->printMessage($LNG['fl_error_empty_derbis'], true, array('game.php?page=fleetTable', 2));
		} */
			
		$MisInfo		     		= array();		
		$MisInfo['galaxy']     		= $targetGalaxy;		
		$MisInfo['system'] 	  		= $targetSystem;	
		$MisInfo['planet'] 	  		= $targetPlanet;		
		$MisInfo['planettype'] 		= $targetType;	
		$MisInfo['IsAKS']			= $fleetGroup;
		$MisInfo['Ship'] 			= $fleetArray;		
		
		$MissionOutput	 			= FleetFunctions::GetFleetMissions($USER, $MisInfo, $targetPlanetData, $PLANET);
		
		if(empty($MissionOutput['MissionSelector'])){
			$this->printMessage($LNG['fl_empty_target'], true, array('game.php?page=fleetTable', 2));
		}
		
		$GameSpeedFactor   		 	= FleetFunctions::GetGameSpeedFactor();		
		$MaxFleetSpeed 				= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
		$distance      				= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array($targetGalaxy, $targetSystem, $targetPlanet));
		$duration      				= max(MIN_FLEET_TIME,FleetFunctions::GetMissionDuration($fleetSpeed, $MaxFleetSpeed, $distance, $GameSpeedFactor, $USER));
		$consumption				= FleetFunctions::GetFleetConsumption($fleetArray, $duration, $distance, $USER, $GameSpeedFactor);
		
		if($consumption > $PLANET['deuterium']){
			$this->printMessage($LNG['fl_not_enough_deuterium'], true, array('game.php?page=fleetTable', 2));
		}
		
		if(!FleetFunctions::CheckUserSpeed($fleetSpeed)){
			FleetFunctions::GotoFleetPage(0);
		}
		
		$_SESSION['fleet'][$token]['speed']			= $MaxFleetSpeed;
		$_SESSION['fleet'][$token]['distance']		= $distance;
		$_SESSION['fleet'][$token]['targetGalaxy']	= $targetGalaxy;
		$_SESSION['fleet'][$token]['targetSystem']	= $targetSystem;
		$_SESSION['fleet'][$token]['targetPlanet']	= $targetPlanet;
		$_SESSION['fleet'][$token]['targetType']	= $targetType;
		$_SESSION['fleet'][$token]['fleetGroup']	= $fleetGroup;
		$_SESSION['fleet'][$token]['fleetSpeed']	= $fleetSpeed;
		
		if(!empty($fleet_group))
			$targetMission	= 2;

		$fleetData	= array(
			'fleetroom'			=> floattostring($_SESSION['fleet'][$token]['fleetRoom']),
			'consumption'		=> floattostring($consumption),
		);
		
		$techExpedition      	= FleetFunctions::getExpeditionLimit($USER);
		$premium_expe_slots 	= 0;
		if($USER['prem_count_expiditeon'] > 0 && $USER['prem_count_expiditeon_days'] > TIMESTAMP){
			$premium_expe_slots = $USER['prem_count_expiditeon'];
		}
		
		$getGalaxySevenAccount = getGalaxySevenAccount($USER);
		$getGalaxySevenAccount = $getGalaxySevenAccount['simExpe'];
		
		if ($techExpedition >= 1){
			$activeExpedition   = FleetFunctions::GetCurrentFleets($USER['id'], 17, true);
			$activeExpedition   += FleetFunctions::GetCurrentFleets($USER['id'], 18, true);
			$maxExpedition 		= $techExpedition + $premium_expe_slots + $getGalaxySevenAccount;
		}else{
			$activeExpedition 	= 0;
			$maxExpedition 		= 0 + $premium_expe_slots + $getGalaxySevenAccount;
		}
		
		$maxFleetSlots	= FleetFunctions::GetMaxFleetSlots($USER);
		
		$sql = "SELECT * FROM %%FLEETS%% WHERE fleet_owner = :userID AND fleet_mission <> 10 ORDER BY fleet_end_time ASC;";
        $fleetResult = $db->select($sql, array(
            ':userID'   => $USER['id']
        ));

        $activeFleetSlots	= $db->rowCount();
		
		$totalLeft = min($maxExpedition-$activeExpedition, $maxFleetSlots - $activeFleetSlots);
		$this->tplObj->loadscript('jquery.countup.js');
		$this->tplObj->loadscript('jquery.countdown2.js');
		$this->tplObj->execscript('calculateTransportCapacity();');
		$this->assign(array(
			'totalLeft'						=> $targetPlanet != 21 ? 6 : $totalLeft,
			'AttackText'					=> $targetPlanet != 21 ? 'Attack' : '',
			'fleetdata'						=> $fleetData,
			'consumption'					=> floattostring($consumption),
			'mission'						=> $targetMission,
			'combatbono'			 		=> max(0,floor($USER['combat_exp_level'] / 30)),
			'galaxy'			 			=> $PLANET['galaxy'],
			'system'			 			=> $PLANET['system'],
			'planet'			 			=> $PLANET['planet'],
			'type'			 				=> $PLANET['planet_type'],
			'MissionSelector' 				=> $MissionOutput['MissionSelector'],
			'StaySelector' 					=> $MissionOutput['StayBlock'],
			'fl_dm_alert_message'			=> sprintf($LNG['fl_dm_alert_message'], $LNG['type_mission'][11], $LNG['tech'][921]),
			'fl_continue'					=> $LNG['fl_continue'],
			'token' 						=> $token,
			'duration' 						=> $duration,
			'fleetGroupShow' 				=> $fleetGroup,
		));
		
		$this->display('page.fleetStep2.default.tpl');
	}
	
	function checkTargetACSMOD()
	{
		$GroupAttack 		= HTTP::_GP('groupAttackMod', 0);
		$tokenMOD 		= HTTP::_GP('token', '');
		$durationMOD 		= HTTP::_GP('duration', 0);
		
	
		$db = Database::get();

        $sql = "SELECT * FROM %%FLEETS%% WHERE fleet_group = :fleet_group ORDER BY fleet_start_time DESC LIMIT 1;";
        $AttackResult = $db->selectSingle($sql, array(
            ':fleet_group'   => $GroupAttack
        ));
		
		$sql = "SELECT * FROM %%AKS%% WHERE id = :fleet_group;";
		$acsName = $db->selectSingle($sql, array(
            ':fleet_group'   => $GroupAttack
        ));
		
		$DEFAULTTIME = $AttackResult['fleet_start_time'];
		$TIMELEFT0 = ($AttackResult['fleet_start_time'] - TIMESTAMP);
		$TIMELEFT30 = ($AttackResult['fleet_start_time'] - TIMESTAMP) + ($AttackResult['fleet_start_time'] - TIMESTAMP) / 100 * 30;
		$MAXBEFOREEND = $TIMELEFT30 - $durationMOD;
		$SHOWACSPLUS = $TIMELEFT0 - $durationMOD;
		$colorSHOW = "lime";
		if($durationMOD > $TIMELEFT30){
		$colorSHOW = "red";
		}elseif($TIMELEFT0 - $durationMOD < 0){
		$colorSHOW = "orange";
		}
		$VARSHOW = $TIMELEFT0 - $durationMOD > 0 ? "<font style='color:".$colorSHOW.";'>00:00:00</font>" : "<font style='color:".$colorSHOW.";' class='countdown3' secs=".abs($SHOWACSPLUS)."></font>";
		
		$this->sendJSON(array('OK' => true, 'maxacstime' => pretty_time($TIMELEFT30), 'finalTime' => "<font style='color:".$colorSHOW.";' class='countdown2' secs=".$MAXBEFOREEND."></font> / ".$VARSHOW, 'acsName' => $acsName['name']." (ACS maximum)"));
	}
}