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

class ShowPlanetPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
	}
	
	
	function coord() 
	{
		global $LNG, $PLANET, $USER, $CONF;

		$galaxyr        = HTTP::_GP('galaxyt', $PLANET['galaxy']);
		$systemr        = HTTP::_GP('systemt', $PLANET['system']);
		$planetsr       = HTTP::_GP('planetst', $PLANET['planet']);
		$galaxy1        = $PLANET['galaxy'];
		$system1        = $PLANET['system'];
		$planet1        = $PLANET['planet'];
		$fleetPlanet    = 0;
		$fleetMoon      = 0;

		$planetData	= array();
		require 'includes/PlanetData.php';

		$config		= Config::get(Universe::current());

		$dataIndex		= (int) ceil($planetsr / ($config->max_planets / count($planetData)));
		$maxTemperature	= $planetData[$dataIndex]['temp2'];
		$minTemperature	= $planetData[$dataIndex]['temp'];
		
		$cost_tp 		= 1000 * abs($system1 - $systemr) + 15000 * abs($galaxy1 - $galaxyr) + 2500 * abs($planet1 - $planetsr);
		$checkPosition	= PlayerUtil::checkPosition(Universe::current(), $galaxyr,$systemr, $planetsr);
		$isPositionFree	= PlayerUtil::isPositionFree(Universe::current(), $galaxyr,$systemr, $planetsr);	
		
		$sql	= 'SELECT COUNT(*) as count
		FROM %%FLEETS%%
		WHERE (fleet_start_id = :planetId AND fleet_universe = :fleetUni AND fleet_mission != :fleet_mission) OR (`fleet_end_id` = :planetId AND fleet_universe = :fleetUni AND fleet_mission != :fleet_mission) OR (`fleet_start_id` = :planetId AND fleet_universe = :fleetUni AND fleet_mission = :fleet_mission AND fleet_owner = :fleet_owner)' ;

		$fleetPlanet	= Database::get()->selectSingle($sql, array(
			':planetId'			=> $PLANET['id'],
			':fleetUni'			=> Universe::current(),
			':fleet_mission'	=> 8,
			':fleet_owner'		=> $USER['id']
		), 'count' );
		
		if($PLANET['id_luna'] != 0){
			$sql	= 'SELECT COUNT(*) as count
			FROM %%FLEETS%%
			WHERE (fleet_start_id = :planetId AND fleet_universe = :fleetUni) OR (`fleet_end_id` = :planetId AND fleet_universe = :fleetUni)' ;

			$fleetMoon	= Database::get()->selectSingle($sql, array(
				':planetId'	=> $PLANET['id_luna'],
				':fleetUni'	=> Universe::current()
			), 'count' );
		}
		
		$ally_fraction_teleporter = 0;
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
				$ally_fraction_teleporter = $FRACTIONS['ally_fraction_teleporter'] * $ALLIANCE['ally_fraction_level'];
			}	
		}
		
		if($USER['darkmatter'] < $cost_tp){
			$this->printMessage($LNG['planet_notenogu'], true, array('game.php?page=planet', 2));
		}elseif($PLANET['gal6mod'] == 1){
			$this->printMessage('You cannnot relocate special planets to a new position.', true, array('game.php?page=planet', 2));
		}elseif($fleetPlanet > 0 || $fleetMoon > 0){
			$this->printMessage($LNG['planet_tel_flee'], true, array('game.php?page=planet', 2));
		}elseif($PLANET['planet_type'] == 3){
			$this->printMessage('You have to teleport from the planet', true, array('game.php?page=planet', 2));
		}elseif(empty($galaxyr) || empty($systemr) || empty($planetsr)){
			$this->printMessage($LNG['planet_tel_busy'],true, array('game.php?page=planet', 2));
		}elseif($galaxyr < 0 || $systemr < 0 || $planetsr < 0){
			$this->printMessage('Those fields are busy', true, array('game.php?page=planet', 2));
		}elseif($galaxyr > (Config::get()->max_galaxy - 1) && $galaxy1 < 7 || $systemr > Config::get()->max_system || $planetsr > Config::get()->max_planets){
			$this->printMessage('The coords are out of range', true, array('game.php?page=planet', 2));
		}elseif($galaxy1 == 7 && $PLANET['system'] != $systemr){
			$this->printMessage('You can only relocate galaxy seven planets in the same system.', true, array('game.php?page=planet', 2));
		}elseif(!$isPositionFree || !$checkPosition){
			$this->printMessage($LNG['planet_tel_busy'], true, array('game.php?page=planet', 2));
		}elseif($PLANET['last_relocate'] + 259200 > TIMESTAMP && $systemr != $PLANET['system'] || $PLANET['last_relocate'] + 259200 > TIMESTAMP && $galaxyr != $PLANET['galaxy'] ){
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=planet');
		}else{
			$sql	= "UPDATE %%PLANETS%% SET last_relocate = :timeStamp WHERE id = :planetId AND universe = :Universe;";
			Database::get()->update($sql, array(
				':timeStamp'		=> TIMESTAMP,
				':planetId'       	=> $PLANET['id'],
				':Universe'       	=> Universe::current()
			));
			$sql	= "UPDATE %%PLANETS%% SET galaxy = :galaxy, system = :system, planet = :planet, temp_min = :temp_min, temp_max = :temp_max WHERE id = :planetId AND universe = :Universe;";
			Database::get()->update($sql, array(
				':galaxy'			=> $galaxyr,
				':system'			=> $systemr,
				':planet'       	=> $planetsr,
				':planetId'       	=> $PLANET['id'],
				':temp_min'       	=> $minTemperature,
				':temp_max'       	=> $maxTemperature,
				':Universe'       	=> Universe::current()
			));
			
			if(!empty($PLANET['id_luna'])){
				$sql	= 'SELECT *
				FROM %%PLANETS%%
				WHERE id = :lunaId AND planet_type = :planetType AND universe = :fleetUni' ;
				$moonData	= Database::get()->selectSingle($sql, array(
					':lunaId'		=> $PLANET['id_luna'],
					':planetType'	=> 3,
					':fleetUni'		=> Universe::current()
				));

				$sql	= "UPDATE %%PLANETS%% SET last_relocate = :timeStamp, galaxy = :galaxy, system = :system, planet = :planet, temp_min = :minTemperature, temp_max = :maxTemperature WHERE id = :lunaId AND universe = :Universe;";
				Database::get()->update($sql, array(
					':timeStamp'		=> TIMESTAMP,
					':galaxy'			=> $galaxyr,
					':system'			=> $systemr,
					':planet'       	=> $planetsr,
					':minTemperature'	=> $minTemperature,
					':maxTemperature'	=> $maxTemperature,
					':lunaId'       	=> $moonData['id'],
					
					':Universe'       	=> Universe::current()
				));
				$sql	= "UPDATE %%PLANETS%% SET last_relocate = :timeStamp WHERE id = :lunaId AND universe = :Universe;";
				Database::get()->update($sql, array(
					':timeStamp'		=> TIMESTAMP,
					':lunaId'       	=> $PLANET['id_luna'],
					':Universe'       	=> Universe::current()
				));
			}
			if($USER['id_planet'] == $PLANET['id']){
				$sql	= "UPDATE %%USERS%% SET galaxy = :galaxy, system = :system, planet = :planet WHERE id = :userId AND universe = :Universe;";
				Database::get()->update($sql, array(
					':galaxy'			=> $galaxyr,
					':system'			=> $systemr,
					':planet'       	=> $planetsr,
					':userId'       	=> $USER['id'],
					':Universe'       	=> Universe::current()
				));
			}
			$USER['darkmatter'] -= $cost_tp;
			
			if(TIMESTAMP < config::get()->dmRefundEvent){
				$sql	= 'INSERT INTO %%DMREFUND%% SET userId = :userId, darkAmount = :darkAmount, timestamp = :timestamp;';
				database::get()->insert($sql, array(
					':userId'		=> $USER['id'],
					':darkAmount'	=> $cost_tp,
					':timestamp'	=> TIMESTAMP
				));
			}
				
			$this->printMessage($LNG['planet_tel_ok'], true, array('game.php?page=planet', 2));
		}	
	}      
		
	function field() 
	{
		global $LNG, $PLANET, $USER;
			
		$totalFields    = HTTP::_GP('filds', 0);
		$cost_i 		= 0;
		$cost 			= 0;
		
		
		if($PLANET['isAlliancePlanet'] != 0){
			for($i = 0; $i < $totalFields; $i++){
				$cost_i 	= round(25000 * pow(1.25,$PLANET['kolvo'] + $i));
				$cost 		= $cost + $cost_i;
			}
		}elseif($PLANET['planet_type'] == 1){
			for($i = 0; $i < $totalFields; $i++){
				$cost_i 	= round(200 * pow(1.1,$PLANET['kolvo'] + $i));
				$cost 		= $cost + $cost_i;
			}
		}elseif($PLANET['planet_type'] == 3){
			for($i = 0; $i < $totalFields; $i++){
				$cost_i 	= round(15000 * pow(1.15,$PLANET['kolvo'] + $i));
				$cost 		= $cost + $cost_i;
			}	
		}
		
		if($totalFields < 0){
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=planet', 3));
		}elseif($USER['darkmatter'] < $cost){
			$this->printMessage($LNG['planet_notenogu'], true, array('game.php?page=planet', 2));
		}else{
			$db = Database::get();
			$sql = "UPDATE %%PLANETS%% SET field_max = field_max + :field_max WHERE id = :planetID;";
			$db->update($sql, array(
				':field_max'  	=> $totalFields,
				':planetID' 	=> $PLANET['id']
			));
			$sql = "UPDATE %%PLANETS%% SET kolvo = kolvo + :kolvo WHERE id = :planetOwner;";
			$db->update($sql, array(
				':kolvo'  		=> $totalFields,
				':planetOwner' 	=> $PLANET['id']
			));
			$USER['darkmatter'] -= $cost;
			if(TIMESTAMP < config::get()->dmRefundEvent){
				$sql	= 'INSERT INTO %%DMREFUND%% SET userId = :userId, darkAmount = :darkAmount, timestamp = :timestamp;';
				database::get()->insert($sql, array(
					':userId'		=> $USER['id'],
					':darkAmount'	=> $cost,
					':timestamp'	=> TIMESTAMP
				));
			}
			$this->printMessage($LNG['planet_fie_added'], true, array('game.php?page=planet', 2));
		}
	}
	
	function planetImageSet() 
	{
		global $LNG, $PLANET, $USER;

		$ImageName        = HTTP::_GP('ImageName', '', UTF8_SUPPORT);
		$code = 0;
		$coins = 0;
		
		if($PLANET['imageChange'] == 0){
		$code = 1;
		$coins = 0;
		$db	= Database::get();
		$sql	= "UPDATE %%PLANETS%% SET image = :image, imageChange = imageChange + :imageChange WHERE id = :planetId;";
		$db->update($sql, array(
			':image'	=> $ImageName,
			':imageChange'	=> 1,
			':planetId'	=> $PLANET['id']
		));
		}elseif($PLANET['imageChange'] > 0){
		$code = 1;
		$coins = 0;	
		if(($USER['antimatter'] + $USER['antimatter_bought']) >= 5000){  
		$db	= Database::get();
		$sql	= "UPDATE %%PLANETS%% SET image = :image, imageChange = imageChange + :imageChange WHERE id = :planetId;";
		$db->update($sql, array(
			':image'	=> $ImageName,
			':imageChange'	=> 1,
			':planetId'	=> $PLANET['id']
		));
		$this->widrawAm(5000, $USER['id']);
		}else{
		$code = 2;
		$coins = 5000 - ($USER['antimatter'] + $USER['antimatter_bought']);
		}
		
		}
		
		$this->sendJSON(array('code' => $code, 'coins' => $coins));
		
	}
	
	function planetImageCode() 
	{
		global $LNG, $PLANET;

		$code        = HTTP::_GP('code', 0);
		$coins        = HTTP::_GP('coins', 0);
		
		if($code == 1){
		$this->printMessage($LNG['planetimage_60'], true, array('game.php?page=planet', 2)); 	
		}else{	
		$this->printMessage(sprintf($LNG['planetimage_61'], $coins), true, array('game.php?page=planet', 2)); 
		}
		
		
	}
	
	function dimeter() 
	{
		global $LNG, $PLANET, $USER;
	
		$account_before = array(
			'diameter'				=> $PLANET['diameter'],
			'field_max'				=> $PLANET['field_max'],
		);
		
		if($USER['antimatter'] + $USER['antimatter_bought'] >= 60000 && $PLANET['planet_type'] == 1){
				$posDiamter = mt_rand(276,414);
				$posFields  = mt_rand(12,18);
				$db	= Database::get();
				$sql	= "UPDATE %%PLANETS%% SET diameter = diameter + :diameter, field_max = field_max + :field_max WHERE id = :planetId;";
				$db->update($sql, array(
					':diameter'		=> $posDiamter,
					':field_max'	=> $posFields,
					':planetId'		=> $PLANET['id']
				));
				
				$account_after = array(
					'diameter'				=> $getPlanet['diameter'],
					'field_max'				=> $getPlanet['field_max'],
				);
					
				$LOG = new Logcheck(33);
				$LOG->username = $USER['username'];
				$LOG->pageLog = "page=planet diameter [".$PLANET['galaxy'].":".$PLANET['system'].":".$PLANET['planet']."] - ".$PLANET['planet_type'];
				$LOG->old = $account_before;
				$LOG->new = $account_after;
				$LOG->save();
				$this->widrawAm(60000, $USER['id']);
				$this->printMessage('Planet fields succesfully increased', true, array('game.php?page=planet', 2));
		}elseif($USER['antimatter'] + $USER['antimatter_bought'] >= 60000 && $PLANET['planet_type'] == 3){

				$posDiamter = mt_rand(46,184);
				$posFields  = mt_rand(2,8);
				
				if($PLANET['diameter'] + $posDiamter > 10000)
					$posDiamter = 10000 - $PLANET['diameter'];
				
				$db	= Database::get();
				$sql	= "UPDATE %%PLANETS%% SET diameter = diameter + :diameter, field_max = field_max + :field_max WHERE id = :planetId;";
				$db->update($sql, array(
					':diameter'		=> $posDiamter,
					':field_max'	=> $posFields,
					':planetId'		=> $PLANET['id']
				));
				
				$account_after = array(
					'diameter'				=> $getPlanet['diameter'],
					'field_max'				=> $getPlanet['field_max'],
				);
					
				$LOG = new Logcheck(33);
				$LOG->username = $USER['username'];
				$LOG->pageLog = "page=planet diameter [".$PLANET['galaxy'].":".$PLANET['system'].":".$PLANET['planet']."] - ".$PLANET['planet_type'];
				$LOG->old = $account_before;
				$LOG->new = $account_after;
				$LOG->save();
				$this->widrawAm(60000, $USER['id']);
				$this->printMessage('Planet fields succesfully increased', true, array('game.php?page=planet', 2));
						
		}else{
			$this->printMessage('The requirement are not met', true, array('game.php?page=planet', 2)); 	
		}
	}
	
	function GenerateName() 
	{
		global $LNG, $PLANET;

		$Names		= file('botnames.txt');
		$NamesCount	= count($Names);
		$Rand		= mt_rand(0, $NamesCount);
		$UserName 	= trim($Names[$Rand]);
		
		$this->sendJSON(array('message' => $UserName));
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
		$password	= HTTP::_GP('password', '', UTF8_SUPPORT);
		
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
			$hashedPass = PlayerUtil::cryptNewPassword('encrypt', $password);
			if (empty($password)) {
				$this->sendJSON(array('message' => 'Enter your password'));
			} elseif ($hashedPass != $USER['password']) {
				$this->sendJSON(array('message' => $LNG['ov_wrong_pass']));
			} elseif ($IfFleets > 0) {
				$this->sendJSON(array('message' => $LNG['ov_abandon_planet_not_possible']));
			} elseif ($PLANET['gal6mod'] == 1) {
				$this->sendJSON(array('message' => "You can not delete those special planets"));
			} elseif ($USER['id_planet'] == $PLANET['id']) {
				$this->sendJSON(array('message' => $LNG['ov_principal_planet_cant_abanone']));
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
				$session	= Session::load();
                $session->planetId     = $USER['id_planet'];
				$this->sendJSON(array('ok' => true, 'message' => $LNG['ov_planet_abandoned']));
			}
		}
	}
	 
	
	function show()
	{
		global $LNG, $resource, $USER, $PLANET;
	
		/* if($USER['id'] != 1){
			$this->printMessage('under maintenance', true, array('game.php?page=overview', 2));
		} */
		
		$der_metal 		= $PLANET['der_metal'];
		$der_crystal 	= $PLANET['der_metal'];
		
		$sql	= 'SELECT * FROM %%PLANETS%% WHERE id = :pId;';
		$planetMod = Database::get()->selectSingle($sql, array(
			':pId'	=> $PLANET['id']
		));
		
		if($planetMod['planet_type'] == 3){
			$sql	= 'SELECT * FROM %%PLANETS%% WHERE galaxy = :galaxy AND system = :system AND planet = :planet AND planet_type = :planet_type;';
			$planetModBis = Database::get()->selectSingle($sql, array(
				':galaxy'		=> $PLANET['galaxy'],
				':system'		=> $PLANET['system'],
				':planet'		=> $PLANET['planet'],
				':planet_type'	=> 1
			));
			$der_metal = $planetModBis['der_metal'];
			$der_crystal = $planetModBis['der_metal'];
		}
		
		if($PLANET['isAlliancePlanet'] != 0){
			$fieldesPrice = 25000;
			$fieldesratio = 1.25;
		}elseif($PLANET['planet_type'] == 1){
			$fieldesPrice = 200;
			$fieldesratio = 1.1;
		}elseif($PLANET['planet_type'] == 3){
			$fieldesPrice = 15000;
			$fieldesratio = 1.15;
		}
		
		
		$this->tplObj->loadscript('planet.js'); 
		$this->tplObj->loadscript('overview.actions.js'); 
		$this->assign(array(
			'isPlanetMetal' 		=> ($planetMod['planet_type'] == 1) ? 100000000000 : 50000000000,
			'isPlanetCrystal' 		=> ($planetMod['planet_type'] == 1) ? 50000000000 : 25000000000,
			'isPlanetDiameter' 		=> ($planetMod['planet_type'] == 1) ? '+276 — +414' : '+46 — +184',
			'isPlanetFields' 		=> ($planetMod['planet_type'] == 1) ? '+12 — +18' : '+2 — +8',
			'typeOfPlanet'	 		=> $PLANET['planet_type'],
			'field_max' 			=> CalculateMaxPlanetFields($PLANET),
			'kolvo' 				=> $PLANET['kolvo'],
			'stardustx' 			=> $USER['stellar_ore'],
			'price' 				=> ($PLANET['imageChange'] == 0) ? 0 : 5000,
			'tGalaxy' 				=> $PLANET['galaxy'],
			'tSystem' 				=> $PLANET['system'],
			'tPlanet' 				=> $PLANET['planet'],
			'pName' 				=> $PLANET['name'],
			'fieldes' 				=> $fieldesPrice,
			'fieldrat' 				=> $fieldesratio,
			'pder_metal' 			=> $der_metal,
			'pder_crystal' 			=> $der_crystal,
			'isPlanetAM'	 		=> max(0,60000-($USER['antimatter'] + $USER['antimatter_bought'])),
			'isPlanetAMK'	 		=> $USER['antimatter'] + $USER['antimatter_bought'],
			'last_relocate' 		=> $PLANET['last_relocate'] + 259200,
			'last_relocate_next' 	=> date('d.m.Y H:i:s', $PLANET['last_relocate'] + 259200),
			'ov_security_confirm'	=> sprintf($LNG['ov_security_confirm'], $PLANET['name'].' ['.$PLANET['galaxy'].':'.$PLANET['system'].':'.$PLANET['planet'].']'),
		));
		
		$this->display('page.planet.default.tpl');
	}
}
