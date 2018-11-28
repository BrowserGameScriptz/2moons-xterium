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

class ShowFleetStep1Page extends AbstractGamePage
{
	public static $requireModule = MODULE_FLEET_TABLE;

	function __construct() 
	{
		parent::__construct();
	}
	
	public function show()
	{
		global $USER, $PLANET, $pricelist, $reslist, $LNG;
		
		$targetGalaxy 			= HTTP::_GP('galaxy', (int) $PLANET['galaxy']);
		$targetSystem 			= HTTP::_GP('system', (int) $PLANET['system']);
		$targetPlanet			= HTTP::_GP('planet', (int) $PLANET['planet']);
		$targetType 			= HTTP::_GP('type', (int) $PLANET['planet_type']);
		
		$mission				= HTTP::_GP('target_mission', 0);
		$save_groop				= HTTP::_GP('save_groop', '', UTF8_SUPPORT);
				
		$Fleet					= array();
		$fleetDit				= array();
		$FleetRoom				= 0;
		$academy_p_b_2_1207 	= 0;
		if($USER['academy_p_b_2_1207'] > 0){
			$academy_p_b_2_1207 = $USER['academy_p_b_2_1207'] * 5;
		}
		
		$ally_fraction_fleet_capa = 0;
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
				$ally_fraction_fleet_capa = $FRACTIONS['ally_fraction_fleet_capa'] * $ALLIANCE['ally_fraction_level'];
			}
		}
		
		foreach($reslist['fleet'] as $id => $ShipID){
			$amount		 				= max(0, round(HTTP::_GP('ship'.$ShipID, 0.0, 0.0)));
			
			if ($amount < 1 || $ShipID == 212) continue;
			$fleetDit[]	= $ShipID.','.floatToString($amount);
			$Fleet[$ShipID]				= $amount;
			$FleetRoom			   	   += $pricelist[$ShipID]['capacity'] * $amount;
		}
		
		$FleetRoom	*= 1 + $USER['factor']['ShipStorage'];
		$FleetRoom 	+= $FleetRoom / 100 * $academy_p_b_2_1207 + ($FleetRoom / 100 * $ally_fraction_fleet_capa);
		
		if (empty($Fleet))
			FleetFunctions::GotoFleetPage();
		
		$gouvernor_fly = 0;
		if($USER['dm_fleettime'] > TIMESTAMP){
			$gouvernor_fly = GubPriceAPSTRACT(707, $USER['dm_fleettime_level'], 'dm_fleettime');
		}
		
		$FleetData	= array(
			'fleetroom'			=> floattostring($FleetRoom),
			'gamespeed'			=> FleetFunctions::GetGameSpeedFactor(),
			'fleetspeedfactor'	=> max(0, 1 + 0),
			'planet'			=> array('galaxy' => $PLANET['galaxy'], 'system' => $PLANET['system'], 'planet' => $PLANET['planet'], 'planet_type' => $PLANET['planet_type']),
			'maxspeed'			=> FleetFunctions::GetFleetMaxSpeed($Fleet, $USER),
			'ships'				=> FleetFunctions::GetFleetShipInfo($Fleet, $USER),
			'FuelConsumption'	=> 0,
		);
		
		if($save_groop != ""){
			$sql	= 'INSERT INTO %%FLEETS_GROUP%% SET groupName = :groupName, ownerId = :ownerId, fleetData = :fleetData;';
			Database::get()->insert($sql, array(
				':groupName'		=> $save_groop,
				':ownerId'			=> $USER['id'],
				':fleetData'		=> implode(';', $fleetDit),
				
			));
		}
		
		$token		= getRandomString();
		$_SESSION['fleet'][$token]	= array(
			'time'		=> TIMESTAMP,
			'fleet'		=> $Fleet,
			'fleetRoom'	=> $FleetRoom,
			'planetStart'	=> $PLANET['id'],
		);

		$shortcutList	= $this->GetUserShotcut();
		$shortcutAmounts= $this->GetUserShotcutAmount();
		$colonyList 	= $this->GetColonyList();
		$moonList 		= $this->GetMoonList();
		$ACSList 		= $this->GetAvalibleACS();
		
		if(!empty($shortcutList)) {
			$shortcutAmount	= max(array_keys($shortcutList));
		} else {
			$shortcutAmount	= 0;
		}
		
		
		$this->tplObj->loadscript('jquery.countup.js');
		$this->tplObj->loadscript('jquery.countdown2.js');
		$this->tplObj->loadscript('flotten.js');
		$this->tplObj->execscript('updateVars();FleetTime();window.setInterval("FleetTime()", 1000);');
		$this->assign(array(
			'token'				=> $token,
			'mission'			=> $mission,
			'shortcutList'		=> $shortcutList,
			'shortcutMax'		=> $shortcutAmount,
			'shortcutAmounts'	=> $shortcutAmounts,
			'colonyList' 		=> $colonyList,
			'moonList' 			=> $moonList,
			'ACSList' 			=> $ACSList,
			'galaxy' 			=> $targetGalaxy,
			'system' 			=> $targetSystem,
			'planet' 			=> $targetPlanet,
			'type'				=> $targetType,
			'speedSelect'		=> FleetFunctions::$allowedSpeed,
			'typeSelect'   		=> array(1 => $LNG['type_planet'][1], 2 => $LNG['type_planet'][2], 3 => $LNG['type_planet'][3]),
			'fleetdata'			=> $FleetData,
			'dm_fleettime'		=> $USER['dm_fleettime'],
			'dm_fleettime_level'=> $USER['dm_fleettime_level'],
			'getActualDate'		=> TIMESTAMP,
		));
		
		//if($USER['id'] == 1)
		//$this->display('page.fleetstep1bis.default.tpl');
		//else
		$this->display('page.fleetStep1.default.tpl');
	}
	
	public function saveShortcuts()
	{
		global $USER, $LNG;
		
		if(!isset($_REQUEST['shortcut'])) {
			$this->sendJSON($LNG['fl_shortcut_saved']);
		}

        $db = Database::get();

		$ShortcutData	= $_REQUEST['shortcut'];
		$ShortcutUser	= $this->GetUserShotcut();
		foreach($ShortcutData as $ID => $planetData) {
			if(!isset($ShortcutUser[$ID])) {
				if(empty($planetData['name']) || empty($planetData['galaxy']) || empty($planetData['system']) || empty($planetData['planet'])) {
					continue;
				}
				$sql = "SELECT * FROM %%SHORTCUTS%% WHERE ownerID = :userID AND galaxy = :galaxy AND system = :system AND planet = :planet AND type = :type;";
                $existAlready = $db->selectSingle($sql, array(
                    ':userID'   => $USER['id'],
                    ':galaxy'   => $planetData['galaxy'],
                    ':system'   => $planetData['system'],
                    ':planet'   => $planetData['planet'],
                    ':type'     => $planetData['type']
                ));
				
				if(empty($existAlready)){
					$sql = "INSERT INTO %%SHORTCUTS%% SET ownerID = :userID, name = :name, galaxy = :galaxy, system = :system, planet = :planet, type = :type;";
					$db->insert($sql, array(
						':userID'   => $USER['id'],
						':name'     => $planetData['name'],
						':galaxy'   => $planetData['galaxy'],
						':system'   => $planetData['system'],
						':planet'   => $planetData['planet'],
						':type'     => $planetData['type']
					));
				}
			} elseif(empty($planetData['name'])) {
				$sql = "DELETE FROM %%SHORTCUTS%% WHERE shortcutID = :shortcutID AND ownerID = :userID;";
                $db->delete($sql, array(
                    ':shortcutID'   => $ID,
                    ':userID'       => $USER['id']
                ));
            } else {
				$planetData['ownerID']		= $USER['id'];
				$planetData['shortcutID']		= $ID;
				if($planetData != $ShortcutUser[$ID]) {
                    $sql = "UPDATE %%SHORTCUTS%% SET name = :name, galaxy = :galaxy, system = :system, planet = :planet, type = :type WHERE shortcutID = :shortcutID AND ownerID = :userID;";
                    $db->update($sql, array(
                        ':userID'   => $USER['id'],
                        ':name'     => $planetData['name'],
                        ':galaxy'   => $planetData['galaxy'],
                        ':system'   => $planetData['system'],
                        ':planet'   => $planetData['planet'],
                        ':type'     => $planetData['type'],
                        ':shortcutID'   => $ID
                    ));
                }
			}
		}
		
		$this->sendJSON($LNG['fl_shortcut_saved']);
	}
	
	private function GetColonyList()
	{
		global $PLANET, $USER;
		
		$ColonyList	= array();
		
		$order = $USER['planet_sort_order'] == 1 ? "DESC" : "ASC" ;

		$sql = "SELECT * FROM %%PLANETS%% WHERE id_owner = :userId AND planet_type = :planet_type AND destruyed = :destruyed AND id != :planetId AND isAlliancePlanet = 0 ORDER BY ";

		switch($USER['planet_sort'])
		{
		case 0:
			$sql	.= 'id '.$order;
			break;
		case 1:
			$sql	.= 'galaxy, system, planet, planet_type '.$order;
			break;
		case 2:
			$sql	.= 'name '.$order;
			break;
		}

	$planetsResult = Database::get()->select($sql, array(
		':userId'		=> $USER['id'],
		':planet_type'	=> 1,
		':destruyed'	=> 0,
		':planetId'	=> $PLANET['id']
   	));
	
		
		foreach($planetsResult as $CurPlanetID => $CurPlanet)
		{
			if ($PLANET['id'] == $CurPlanet['id'])
				continue;
			
			$ColonyList[] = array(
				'name'		=> $CurPlanet['name'],
				'galaxy'	=> $CurPlanet['galaxy'],
				'system'	=> $CurPlanet['system'],
				'planet'	=> $CurPlanet['planet'],
				'image'	=> $CurPlanet['image'],
				'type'		=> $CurPlanet['planet_type'],
			);	
		}
			
		return $ColonyList;
	}
	
	private function GetMoonList()
	{
		global $PLANET, $USER;
		
		$ColonyList	= array();
		
		$order = $USER['planet_sort_order'] == 1 ? "DESC" : "ASC" ;

		$sql = "SELECT * FROM %%PLANETS%% WHERE id_owner = :userId AND planet_type = :planet_type AND destruyed = :destruyed AND id != :planetId ORDER BY ";

		switch($USER['planet_sort'])
		{
		case 0:
			$sql	.= 'id '.$order;
			break;
		case 1:
			$sql	.= 'galaxy, system, planet, planet_type '.$order;
			break;
		case 2:
			$sql	.= 'name '.$order;
			break;
		}

	$planetsResult = Database::get()->select($sql, array(
		':userId'		=> $USER['id'],
		':planet_type'	=> 3,
		':destruyed'	=> 0,
		':planetId'	=> $PLANET['id']
   	));
	
		
		foreach($planetsResult as $CurPlanetID => $CurPlanet)
		{
			if ($PLANET['id'] == $CurPlanet['id'])
				continue;
			
			$ColonyList[] = array(
				'name'		=> $CurPlanet['name'],
				'galaxy'	=> $CurPlanet['galaxy'],
				'system'	=> $CurPlanet['system'],
				'planet'	=> $CurPlanet['planet'],
				'type'		=> $CurPlanet['planet_type'],
			);	
		}
			
		return $ColonyList;
	}
	
	private function GetUserShotcut()
	{
		global $USER;
		
		if (!isModuleAvailable(MODULE_SHORTCUTS))
			return array();

        $db = Database::get();

        $sql = "SELECT * FROM %%SHORTCUTS%% WHERE ownerID = :userID;";
        $ShortcutResult = $db->select($sql, array(
            ':userID'   => $USER['id']
        ));

        $ShortcutList	= array();

		foreach($ShortcutResult as $ShortcutRow) {
			$ShortcutList[$ShortcutRow['shortcutID']] = $ShortcutRow;
		}
		
		return $ShortcutList;
	}
	
	private function GetUserShotcutAmount()
	{
		global $USER;
		
		if (!isModuleAvailable(MODULE_SHORTCUTS))
			return array();

        $db = Database::get();

        $sql = "SELECT * FROM %%SHORTCUTS%% WHERE ownerID = :userID;";
        $ShortcutResult = $db->select($sql, array(
            ':userID'   => $USER['id']
        ));

		return count($ShortcutResult);
	}
	
	private function GetAvalibleACS()
	{
		global $USER;
		
		$db = Database::get();

        $sql = "SELECT acs.id, acs.name, planet.galaxy, planet.system, planet.planet, planet.planet_type
		FROM %%USERS_ACS%%
		INNER JOIN %%AKS%% acs ON acsID = acs.id
		INNER JOIN %%PLANETS%% planet ON planet.id = acs.target
		WHERE userID = :userID AND :maxFleets > (SELECT COUNT(*) FROM %%FLEETS%% WHERE fleet_group = acsID);";
        $ACSResult = $db->select($sql, array(
            ':userID'       => $USER['id'],
            ':maxFleets'    => Config::get()->max_fleets_per_acs,
        ));

        $ACSList	= array();
		
		foreach ($ACSResult as $ACSRow) {
			$ACSList[]	= $ACSRow;
		}
		
		return $ACSList;
	}
	
	function t1($val, $min, $max) {
	  return ($val >= $min && $val <= $max);
	}

	function checkTarget()
	{
		global $PLANET, $LNG, $USER, $resource;

		$targetGalaxy 		= HTTP::_GP('galaxy', 0);
		$targetSystem 		= HTTP::_GP('system', 0);
		$targetPlanet		= HTTP::_GP('planet', 0);
		$targetPlanetType	= HTTP::_GP('planet_type', 1);
	
		if($targetGalaxy == $PLANET['galaxy'] && $targetSystem == $PLANET['system'] && $targetPlanet == $PLANET['planet'] && $targetPlanetType == $PLANET['planet_type'])
		{
			$this->sendJSON($LNG['fl_error_same_planet']);
		}


		// If target is expedition
		if ($targetPlanet != Config::get()->max_planets + 1)
		{
			$db = Database::get();
            $sql = "SELECT u.id, u.urlaubs_modus, u.protectionTimer, u.user_lastip, u.authattack,
            	p.destruyed, p.der_metal, p.der_crystal, p.destruyed, p.isAlliancePlanet
                FROM %%USERS%% as u, %%PLANETS%% as p WHERE
                p.universe = :universe AND
                p.galaxy = :targetGalaxy AND
                p.system = :targetSystem AND
                p.planet = :targetPlanet  AND
                p.planet_type = :targetType AND
                u.id = p.id_owner;";

			$planetData = $db->selectSingle($sql, array(
                ':universe'     => Universe::current(),
                ':targetGalaxy' => $targetGalaxy,
                ':targetSystem' => $targetSystem,
                ':targetPlanet' => $targetPlanet,
                ':targetType' => (($targetPlanetType == 2) ? 1 : $targetPlanetType),
            ));
			
			$sql	= 'SELECT total_rank FROM %%STATPOINTS%% WHERE id_owner = :userId AND stat_type = 1;';
			$statGalSeven	= database::get()->selectSingle($sql, array(
				':userId'	=> $USER['id']
			));
			
			$My_Level = 0;
			if($statGalSeven['total_rank'] > 250)
				$My_Level = 1;
			elseif($statGalSeven['total_rank'] < 251 && $statGalSeven['total_rank'] > 200)
				$My_Level = 2;
			elseif($statGalSeven['total_rank'] < 201 && $statGalSeven['total_rank'] > 150)
				$My_Level = 3;
			elseif($statGalSeven['total_rank'] < 151 && $statGalSeven['total_rank'] > 120)
				$My_Level = 4;
			elseif($statGalSeven['total_rank'] < 121 && $statGalSeven['total_rank'] > 91)
				$My_Level = 5;
			elseif($statGalSeven['total_rank'] < 91 && $statGalSeven['total_rank'] > 70)
				$My_Level = 6;
			elseif($statGalSeven['total_rank'] < 71 && $statGalSeven['total_rank'] > 40)
				$My_Level = 7;
			elseif($statGalSeven['total_rank'] < 41 && $statGalSeven['total_rank'] > 20)
				$My_Level = 8;
			elseif($statGalSeven['total_rank'] < 21 && $statGalSeven['total_rank'] > 10)
				$My_Level = 9;
			else
				$My_Level = 10;
			
			$GalaxyMin	= array(1,51,101,151,201,251,301,351,401,451);
			$GalaxyMax	= array(50,100,150,200,250,300,350,400,450,500);
			
            if ($targetPlanetType == 3 && !isset($planetData))
			{
				$this->sendJSON($LNG['fl_error_no_moon']);
			}
			
			if ($targetGalaxy == 7 && !$this->t1($targetSystem, $GalaxyMin[$My_Level-1], $GalaxyMax[$My_Level-1]) && $planetData['id'] != $USER['id'])
			{
				$this->sendJSON("You have not the rights to go into this system.");
			}
			
			if ($targetPlanetType != 2 && $planetData['urlaubs_modus'] && $targetGalaxy != 7 && $planetData['isAlliancePlanet'] == 0)
			{
				$this->sendJSON($LNG['fl_in_vacation_player']);
			}

			if ($planetData['id'] != $USER['id'] && Config::get()->adm_attack == 1 && $planetData['authattack'] > $USER['authlevel'])
			{
				$this->sendJSON($LNG['fl_admin_attack']);
			}

			if ($planetData['destruyed'] != 0)
			{
				$this->sendJSON($LNG['fl_error_not_avalible']);
			}
			
			if ($planetData['protectionTimer'] >= TIMESTAMP && $targetGalaxy != 7 && $planetData['isAlliancePlanet'] == 0 && $planetData['id'] != $USER['id'])
			{
				$this->sendJSON($LNG['protection_4']);
			}
			
			/*if($targetPlanetType == 2 && $planetData['der_metal'] == 0 && $planetData['der_crystal'] == 0)
			{
				$this->sendJSON($LNG['fl_error_empty_derbis']);
			} */

			$sql	= 'SELECT (
				(SELECT COUNT(*) FROM %%MULTI%% WHERE userID = :userID) +
				(SELECT COUNT(*) FROM %%MULTI%% WHERE userID = :dataID)
			) as count;';

			$multiCount	= $db->selectSingle($sql ,array(
				':userID' => $USER['id'],
				':dataID' => $planetData['id']
			), 'count');

			if(ENABLE_MULTIALERT && $USER['id'] != $planetData['id'] && $USER['authlevel'] != AUTH_ADM && $USER['user_lastip'] == $planetData['user_lastip'] && $multiCount != 2)
			{
				$this->sendJSON($LNG['fl_multi_alarm']);
			}
			
		}
		else
		{
			
			$premium_expe_slots = 0;
			if($USER['prem_count_expiditeon'] > 0 && $USER['prem_count_expiditeon_days'] > TIMESTAMP){
			$premium_expe_slots = $USER['prem_count_expiditeon'];
			}
			
			$getGalaxySevenAccount = getGalaxySevenAccount($USER);
			$getGalaxySevenAccount = $getGalaxySevenAccount['simExpe'];

			if (FleetFunctions::getExpeditionLimit($USER) + $premium_expe_slots + $getGalaxySevenAccount == 0)
			{
				$this->sendJSON($LNG['fl_target_not_exists']);
			}
			
			
			$activeExpedition	= FleetFunctions::GetCurrentFleets($USER['id'], 15, true);
			$activeExpedition	+= FleetFunctions::GetCurrentFleets($USER['id'], 17, true);
			$activeExpedition	+= FleetFunctions::GetCurrentFleets($USER['id'], 18, true);
			
			if ($activeExpedition >= (FleetFunctions::getExpeditionLimit($USER) + $premium_expe_slots + $getGalaxySevenAccount))
			{
				$this->sendJSON($LNG['fl_no_expedition_slot']);
			}
		}

		$this->sendJSON('OK');	
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