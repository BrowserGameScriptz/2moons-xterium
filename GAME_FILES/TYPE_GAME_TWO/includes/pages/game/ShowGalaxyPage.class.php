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

require_once('includes/classes/class.GalaxyRows.php');

class ShowGalaxyPage extends AbstractGamePage
{
    public static $requireModule = MODULE_RESEARCH;

	function __construct() 
	{
		parent::__construct();
	}
	
	function outlaw() 
	{
	global $LNG, $USER;

	$db = Database::get();
    $sql = "UPDATE %%USERS%% SET outlaw = :outlaw WHERE id = :userId;";
    $db->update($sql, array(
        ':outlaw'  => TIMESTAMP + (7*24*3600),
        ':userId' => $USER['id']
    ));

    $this->sendJSON(array('message' => 'Outlaw status active for 7 days', 'ok' => true));
			
	}
	
	function showsavec()
	{
		global $USER, $PLANET, $resource, $LNG, $reslist;
		
		$sql	= 'SELECT * FROM %%SAVEDGAL%% WHERE userId = :userId;';
		$savedData	= database::get()->select($sql, array(
			':userId'	=> $USER['id']
		));
		
		$savedArray = array();
		foreach($savedData as $Data){
			$sql	= 'SELECT * FROM %%PLANETS%% WHERE galaxy = :galaxy AND system = :system AND planet = :planet AND planet_type = 1;';
			$isExistentPlanet	= database::get()->selectSingle($sql, array(
				':galaxy'	=> $Data['galaxy'],
				':system'	=> $Data['system'],
				':planet'	=> $Data['planet'],
			));
			
			$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
			$isExistentPlayer	= database::get()->selectSingle($sql, array(
				':userId'	=> $isExistentPlanet['id_owner'],
			));
			
			if(empty($isExistentPlanet) || empty($isExistentPlayer)){
				$sql	= 'DELETE FROM %%SAVEDGAL%% WHERE galaxy = :galaxy AND system = :system AND planet = :planet AND userId = :userId;';
				database::get()->delete($sql, array(
					':galaxy'	=> $Data['galaxy'],
					':system'	=> $Data['system'],
					':planet'	=> $Data['planet'],
					':userId'	=> $USER['id'],
				));
				continue;
			}
			
			$savedArray[$Data['savedId']] = array(
				'name'		=> $isExistentPlanet['name'],
				'planetId'	=> $isExistentPlanet['id'],
				'image'		=> $isExistentPlanet['image'],
				'userid'	=> $isExistentPlanet['id_owner'],
				'username'	=> getUsername($isExistentPlanet['id_owner']),
				'allyname'	=> !empty($isExistentPlayer['ally_id']) ? $this->getAllianceTag($isExistentPlayer['ally_id']) : "",
				'galaxy'	=> $Data['galaxy'],
				'system'	=> $Data['system'],
				'planet'	=> $Data['planet'],
				'hasMoon'	=> $isExistentPlanet['id_luna'] != 0 ? 1 : 0,
				'debris'	=> $isExistentPlanet['der_metal'] + $isExistentPlanet['der_crystal'],
				'debrisM'	=> $isExistentPlanet['der_metal'],
				'debrisC'	=> $isExistentPlanet['der_crystal'],
			);
			
		}
		
		$this->tplObj->loadscript('galaxy.js');
        $this->assign(array(
			'savedData'			=> count($savedData),
			'savedArray'		=> $savedArray,
			'spyShips'			=> array(210 => $USER['spio_anz']),
			'maxfleetcount'		=> FleetFunctions::GetCurrentFleets($USER['id']),
			'fleetmax'			=> FleetFunctions::GetMaxFleetSlots($USER),
			'probesAval'		=> $PLANET[$resource[210]],
		));
		
		$this->display('page.galaxy.showsavec.tpl');
	}
	
	function delcord()
	{
		global $USER, $PLANET, $resource, $LNG, $reslist;
		
		$logId	 		= HTTP::_GP('id', 0);
		
		$sql	= 'SELECT * FROM %%SAVEDGAL%% WHERE savedId = :savedId AND userId = :userId;';
		$savedData	= database::get()->selectSingle($sql, array(
			':savedId'	=> $logId,
			':userId'	=> $USER['id']
		));
		
		if(empty($savedData)){
			echo json_encode(array("message" => "You are not the owner of this shortcut or this shortcut does not exist anymore.", "error" => true));
			die();
		}else{
			$sql	= 'DELETE FROM %%SAVEDGAL%% WHERE savedId = :savedId AND userId = :userId;';
			database::get()->delete($sql, array(
				':savedId'	=> $logId,
				':userId'	=> $USER['id'],
			));
			echo json_encode(array("message" => "The shortcut has been successfully deleted.", "error" => false));
			die();
		}
		
	}
	
	function savecord()
	{
		global $USER, $PLANET, $resource, $LNG, $reslist;
		
		/* if($USER['id'] != 1){
			echo json_encode(array("message" => "The mod is under development", "error" => true));
			die();
		} */
		$sql	= 'SELECT * FROM %%SAVEDGAL%% WHERE userId = :userId;';
		$savedData	= database::get()->select($sql, array(
			':userId'	=> $USER['id']
		));
		
		$galaxy 		= HTTP::_GP('galaxy', 0);
		$system 		= HTTP::_GP('system', 0);
		$planet 		= HTTP::_GP('planet', 0);
		
		$sql	= 'SELECT * FROM %%SAVEDGAL%% WHERE userId = :userId AND galaxy = :galaxy AND system = :system AND planet = :planet;';
		$isExistent	= database::get()->selectSingle($sql, array(
			':userId'	=> $USER['id'],
			':galaxy'	=> $galaxy,
			':system'	=> $system,
			':planet'	=> $planet,
		));
		
		$sql	= 'SELECT * FROM %%PLANETS%% WHERE galaxy = :galaxy AND system = :system AND planet = :planet AND planet_type = 1;';
		$isExistentPlanet	= database::get()->selectSingle($sql, array(
			':galaxy'	=> $galaxy,
			':system'	=> $system,
			':planet'	=> $planet,
		));
		
		if(empty($isExistentPlanet)){
			echo json_encode(array("message" => "The planet has not been found. It has not been saved in the log book.", "error" => true));
		}elseif(count($savedData) == 20){
			echo json_encode(array("message" => "You can save at maximum 20 coordinates.", "error" => true));
		}elseif(!empty($isExistent)){
			echo json_encode(array("message" => "This coordinates are already saved in your log book.", "error" => true));
		}else{
			$sql	= 'INSERT INTO %%SAVEDGAL%% SET  userId = :userId, galaxy = :galaxy, system = :system, planet = :planet;';
			database::get()->insert($sql, array(
				':userId'	=> $USER['id'],
				':galaxy'	=> $galaxy,
				':system'	=> $system,
				':planet'	=> $planet,
			));
			echo json_encode(array("message" => "The coordinates have been successfully saved.", "error" => false));
		}
	}
	
	public function show()
	{
		global $USER, $PLANET, $resource, $LNG, $reslist;

		$config			= Config::get();

		$action 		= HTTP::_GP('action', '');
		$galaxyLeft		= HTTP::_GP('galaxyLeft', '');
		$galaxyRight	= HTTP::_GP('galaxyRight', '');
		$systemLeft		= HTTP::_GP('systemLeft', '');
		$systemRight	= HTTP::_GP('systemRight', '');
		$galaxy			= min(max(HTTP::_GP('galaxy', (int) $PLANET['galaxy']), 1), $config->max_galaxy);
		
		
		$sql	= 'SELECT total_rank FROM %%STATPOINTS%% WHERE id_owner = :userId AND stat_type = 1;';
		$statData	= database::get()->selectSingle($sql, array(
			':userId'	=> $USER['id']
		));
		
		
		$My_Level = 0;
		if($statData['total_rank'] > 250)
			$My_Level = 1;
		elseif($statData['total_rank'] < 251 && $statData['total_rank'] > 200)
			$My_Level = 2;
		elseif($statData['total_rank'] < 201 && $statData['total_rank'] > 150)
			$My_Level = 3;
		elseif($statData['total_rank'] < 151 && $statData['total_rank'] > 120)
			$My_Level = 4;
		elseif($statData['total_rank'] < 121 && $statData['total_rank'] > 91)
			$My_Level = 5;
		elseif($statData['total_rank'] < 91 && $statData['total_rank'] > 70)
			$My_Level = 6;
		elseif($statData['total_rank'] < 71 && $statData['total_rank'] > 40)
			$My_Level = 7;
		elseif($statData['total_rank'] < 41 && $statData['total_rank'] > 20)
			$My_Level = 8;
		elseif($statData['total_rank'] < 21 && $statData['total_rank'] > 10)
			$My_Level = 9;
		else
			$My_Level = 10;
		
		$GalaxyMin	= array(1,51,101,151,201,251,301,351,401,451);
		$GalaxyMax	= array(50,100,150,200,250,300,350,400,450,500);
		
		if($galaxy == $config->max_galaxy && empty($galaxyLeft))
			$system			= min(max(HTTP::_GP('system', (int) $PLANET['system']), $GalaxyMin[$My_Level-1]), $GalaxyMax[$My_Level-1]);
		else
			$system			= min(max(HTTP::_GP('system', (int) $PLANET['system']), 1), $config->max_system);
		
		$planet			= min(max(HTTP::_GP('planet', (int) $PLANET['planet']), 1), $config->max_planets);
		$type			= HTTP::_GP('type', 1);
		$current		= HTTP::_GP('current', 0);
		
        if (!empty($galaxyLeft))
            $galaxy	= max($galaxy - 1, 1);
        elseif (!empty($galaxyRight))
            $galaxy	= min($galaxy + 1, $config->max_galaxy);

		if (!empty($systemLeft) && $galaxy == $config->max_galaxy)
            $system	= max($system - 1, $GalaxyMin[$My_Level-1]);
        elseif (!empty($systemLeft))
            $system	= max($system - 1, 1);
        elseif (!empty($systemRight) && $galaxy == $config->max_galaxy)
            $system	= min($system + 1, 500);
		elseif (!empty($systemRight))
            $system	= min($system + 1, $config->max_system);
			
		if($system < $GalaxyMin[$My_Level-1] && $galaxy == $config->max_galaxy)
			$system = $GalaxyMin[$My_Level-1];
		
		if($system > $GalaxyMax[$My_Level-1] && $galaxy == $config->max_galaxy)
			$system = $GalaxyMax[$My_Level-1];

		$targetDefensive    = $reslist['defense'];
		$targetDefensive[]	= 502;
		$missileSelector[0]	= $LNG['gl_all_defenses'];
		
		foreach($targetDefensive as $Element)
		{	
			$missileSelector[$Element] = $LNG['tech'][$Element];
		}

		$galaxyRows	= new GalaxyRows;
		$galaxyRows->setGalaxy($galaxy);
		$galaxyRows->setSystem($system);
		$Result	= $galaxyRows->getGalaxyData();
		
		
		$BuildTemp          = $PLANET['temp_max'];
		$BuildLevelFactor	= 10;
		$BuildLevel			= 1;
		$academy_p_b_2_1210 = 0;
		if($USER['academy_p_b_2_1210'] > 0){
			$academy_p_b_2_1210 = $USER['academy_p_b_2_1210'] * 3;
		}
		$gouvernor_energy = 0;
		if($USER['dm_energie'] > TIMESTAMP){
			$gouvernor_energy = GubPriceAPSTRACT(705, $USER['dm_energie_level'], 'dm_energie');
		}
				
		$Energy_Min_1 = (((220 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((220 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((220 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_1 = (((305 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((305 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((305 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_2 = (((180 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((180 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((180 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_2 = (((265 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((265 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((265 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_3 = (((140 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((140 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((140 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_3 = (((220 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((220 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((220 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_4 = (((80 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((80 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((80 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_4 = (((160 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((160 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((160 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_5 = (((65 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((65 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((65 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_5 = (((145 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((145 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((145 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_6 = (((40 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((40 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((40 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_6 = (((120 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((120 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((120 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_7 = (((30 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((30 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((30 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_7 = (((100 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((100 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((100 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_8 = (((15 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((15 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((15 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_8 = (((95 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((95 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((95 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_9 = (((0 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((0 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((0 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_9 = (((80 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((80 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((80 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_10 = (((-20 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-20 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-20 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_10 = (((60 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((60 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((60 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		
		$Energy_Min_11 = (((-40 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-40 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-40 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_11 = (((43 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((43 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((43 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_12 = (((-45 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-45 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-45 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_12 = (((20 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((20 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((20 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_13 = (((-50 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-50 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-50 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_13 = (((20 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((20 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((20 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_14 = (((-70 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-70 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-70 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_14 = (((10 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((10 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((10 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_15 = (((-100 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-100 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-100 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_15 = (((-20 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-20 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-20 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_16 = (((-130 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-130 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-130 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_16 = (((-50 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-50 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-50 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_17 = (((-170 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-170 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-170 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_17 = (((-90 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-90 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-90 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
	
		$Energy_Min_18 = (((-190 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-190 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-190 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_18 = (((-120 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-120 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-120 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_19 = (((-220 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-220 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-220 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_19 = (((-140 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-140 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-140 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Energy_Min_20 = (((-290 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((-290 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((-290 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		$Energy_Max_20 = (((-200 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + ((((200 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + ((((200 + 160) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy);
		
		$Field_Min_1 = 173;
		$Field_Max_1 = 190;
		$Field_Min_2 = 176;
		$Field_Max_2 = 193;
		$Field_Min_3 = 177;
		$Field_Max_3 = 228;
		$Field_Min_4 = 180;
		$Field_Max_4 = 245;
		$Field_Min_5 = 186;
		$Field_Max_5 = 261;
		$Field_Min_6 = 209;
		$Field_Max_6 = 313;
		$Field_Min_7 = 242;
		$Field_Max_7 = 323;
		$Field_Min_8 = 232;
		$Field_Max_8 = 343;
		$Field_Min_9 = 243;
		$Field_Max_9 = 404;
		$Field_Min_10 = 269;
		$Field_Max_10 = 379;
		$Field_Min_11 = 263;
		$Field_Max_11 = 362;
		$Field_Min_12 = 259;
		$Field_Max_12 = 359;
		$Field_Min_13 = 250;
		$Field_Max_13 = 341;
		$Field_Min_14 = 242;
		$Field_Max_14 = 315;
		$Field_Min_15 = 226;
		$Field_Max_15 = 272;
		$Field_Min_16 = 191;
		$Field_Max_16 = 207;
		$Field_Min_17 = 155;
		$Field_Max_17 = 170;
		$Field_Min_18 = 134;
		$Field_Max_18 = 146;
		$Field_Min_19 = 134;
		$Field_Max_19 = 146;
		$Field_Min_20 = 134;
		$Field_Max_20 = 146;
		
		
		
		$galaxy_desc_1  = sprintf($LNG['galaxy_temp'][1], round($Energy_Min_1), round($Energy_Max_1), round($Field_Min_1), round($Field_Max_1));
		$galaxy_desc_2  = sprintf($LNG['galaxy_temp'][2], round($Energy_Min_2), round($Energy_Max_2), round($Field_Min_2), round($Field_Max_2));
		$galaxy_desc_3  = sprintf($LNG['galaxy_temp'][3], round($Energy_Min_3), round($Energy_Max_3), round($Field_Min_3), round($Field_Max_3));
		$galaxy_desc_4  = sprintf($LNG['galaxy_temp'][4], round($Energy_Min_4), round($Energy_Max_4), round($Field_Min_4), round($Field_Max_4));
		$galaxy_desc_5  = sprintf($LNG['galaxy_temp'][5], round($Energy_Min_5), round($Energy_Max_5), round($Field_Min_5), round($Field_Max_5));
		$galaxy_desc_6  = sprintf($LNG['galaxy_temp'][6], round($Energy_Min_6), round($Energy_Max_6), round($Field_Min_6), round($Field_Max_6));
		$galaxy_desc_7  = sprintf($LNG['galaxy_temp'][7], round($Energy_Min_7), round($Energy_Max_7), round($Field_Min_7), round($Field_Max_7));
		$galaxy_desc_8  = sprintf($LNG['galaxy_temp'][8], round($Energy_Min_8), round($Energy_Max_8), round($Field_Min_8), round($Field_Max_8));
		$galaxy_desc_9  = sprintf($LNG['galaxy_temp'][9], round($Energy_Min_9), round($Energy_Max_9), round($Field_Min_9), round($Field_Max_9));
		$galaxy_desc_10  = sprintf($LNG['galaxy_temp'][10], round($Energy_Min_10), round($Energy_Max_10), round($Field_Min_10), round($Field_Max_10));
		$galaxy_desc_11  = sprintf($LNG['galaxy_temp'][11], round($Energy_Min_11), round($Energy_Max_11), round($Field_Min_11), round($Field_Max_11));
		$galaxy_desc_12  = sprintf($LNG['galaxy_temp'][12], round($Energy_Min_12), round($Energy_Max_12), round($Field_Min_12), round($Field_Max_12));
		$galaxy_desc_13  = sprintf($LNG['galaxy_temp'][13], round($Energy_Min_13), round($Energy_Max_13), round($Field_Min_13), round($Field_Max_13));
		$galaxy_desc_14  = sprintf($LNG['galaxy_temp'][14], round($Energy_Min_14), round($Energy_Max_14), round($Field_Min_14), round($Field_Max_14));
		$galaxy_desc_15  = sprintf($LNG['galaxy_temp'][15], round($Energy_Min_15), round($Energy_Max_15), round($Field_Min_15), round($Field_Max_15));
		$galaxy_desc_16  = sprintf($LNG['galaxy_temp'][16], round($Energy_Min_16), round($Energy_Max_16), round($Field_Min_16), round($Field_Max_16));
		$galaxy_desc_17  = sprintf($LNG['galaxy_temp'][17], round($Energy_Min_17), round($Energy_Max_17), round($Field_Min_17), round($Field_Max_17));
		$galaxy_desc_18  = sprintf($LNG['galaxy_temp'][18], round($Energy_Min_18), round($Energy_Max_18), round($Field_Min_18), round($Field_Max_18));
		$galaxy_desc_19  = sprintf($LNG['galaxy_temp'][19], round($Energy_Min_19), round($Energy_Max_19), round($Field_Min_19), round($Field_Max_19));
		$galaxy_desc_20  = sprintf($LNG['galaxy_temp'][20], round($Energy_Min_20), round($Energy_Max_20), round($Field_Min_20), round($Field_Max_20));
		
		$sql	= 'SELECT * FROM %%SUPRIMOEVENT%% WHERE galaxy = :galaxy AND system = :system AND createdTime > :createdTime;';
		$suprimoEvent	= database::get()->selectSingle($sql, array(
			':galaxy'		=> $galaxy,
			':system'		=> $system,
			':createdTime'	=> TIMESTAMP - 3600*24
		));
		
        $this->tplObj->loadscript('galaxy.js');
        $this->assign(array(
			'suprimoEventCount'			=> empty($suprimoEvent) ? 0 : 1,
			'suprimoEventData'			=> empty($suprimoEvent) ? "" : $suprimoEvent,
			'galaxy_desc_1'				=> $galaxy_desc_1,
			'galaxy_desc_2'				=> $galaxy_desc_2,
			'galaxy_desc_3'				=> $galaxy_desc_3,
			'galaxy_desc_4'				=> $galaxy_desc_4,
			'galaxy_desc_5'				=> $galaxy_desc_5,
			'galaxy_desc_6'				=> $galaxy_desc_6,
			'galaxy_desc_7'				=> $galaxy_desc_7,
			'galaxy_desc_8'				=> $galaxy_desc_8,
			'galaxy_desc_9'				=> $galaxy_desc_9,
			'galaxy_desc_10'			=> $galaxy_desc_10,
			'galaxy_desc_11'			=> $galaxy_desc_11,
			'galaxy_desc_12'			=> $galaxy_desc_12,
			'galaxy_desc_13'			=> $galaxy_desc_13,
			'galaxy_desc_14'			=> $galaxy_desc_14,
			'galaxy_desc_15'			=> $galaxy_desc_15,
			'galaxy_desc_16'			=> $galaxy_desc_16,
			'galaxy_desc_17'			=> $galaxy_desc_17,
			'galaxy_desc_18'			=> $galaxy_desc_18,
			'galaxy_desc_19'			=> $galaxy_desc_19,
			'galaxy_desc_20'			=> $galaxy_desc_20,
			'GalaxyRows'				=> $Result,
			'GalaxyAmounts'				=> count($Result),
			'planetcount'				=> sprintf($LNG['gl_populed_planets'], count($Result)),
			'action'					=> $action,
			'galaxy'					=> $galaxy,
			'system'					=> $system,
			'planet'					=> $planet,
			'type'						=> $type,
			'current'					=> $current,
			'maxfleetcount'				=> FleetFunctions::GetCurrentFleets($USER['id']),
			'fleetmax'					=> FleetFunctions::GetMaxFleetSlots($USER),
			'currentmip'				=> $PLANET[$resource[503]],
			'apiKeys'					=> $USER['apiKey'],
			'grecyclers'   				=> $PLANET[$resource[219]],
			'recyclers'   				=> $PLANET[$resource[209]],
			'spyprobes'   				=> $PLANET[$resource[210]],
			'colonyship'   				=> $PLANET[$resource[208]],
			'missile_count'				=> sprintf($LNG['gl_missil_to_launch'], $PLANET[$resource[503]]),
			'spyShips'					=> array(210 => $USER['spio_anz']),
			'settings_fleetactions'		=> $USER['settings_fleetactions'],
			'current_galaxy'			=> $PLANET['galaxy'],
			'current_system'			=> $PLANET['system'],
			'current_planet'			=> $PLANET['planet'],
			'planet_type' 				=> $PLANET['planet_type'],
      'max_planets'               => $config->max_planets,
			'missileSelector'			=> $missileSelector,
			'ShortStatus'				=> array(
				'vacation'					=> $LNG['gl_short_vacation'],
				'banned'					=> $LNG['gl_short_ban'],
				'inactive'					=> $LNG['gl_short_inactive'],
				'longinactive'				=> $LNG['gl_short_long_inactive'],
				'noob'						=> $LNG['gl_short_newbie'],
				'strong'					=> $LNG['gl_short_strong'],
				'enemy'						=> $LNG['gl_short_enemy'],
				'friend'					=> $LNG['gl_short_friend'],
				'member'					=> $LNG['gl_short_member'],
			),
		));
		
		$this->display('page.galaxy.default.tpl');
	}
}