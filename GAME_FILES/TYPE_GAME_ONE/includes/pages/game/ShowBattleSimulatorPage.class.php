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

class ShowBattleSimulatorPage extends AbstractGamePage
{
	public static $requireModule = MODULE_SIMULATOR;

	function __construct() 
	{
		parent::__construct();
	}

	function send()
	{
		global $reslist, $pricelist, $LNG, $USER;
		
		if(!isset($_REQUEST['battleinput'])) {
			$this->sendJSON(0);
		}
		
		$Pid			= HTTP::_GP('Pid', 0);

		$sql			= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$targetUser		= Database::get()->selectSingle($sql, array(
			':userId'	=> $Pid
		));
		
		$sql	= 'SELECT total_alliance_power FROM %%ALLIANCE%% WHERE id = :allyId;';
		$ExistAlliance = database::get()->selectSingle($sql, array(
			':allyId'	=> $USER['ally_id']
		));
		
		$BonusAlliance = 0;
		if(!empty($ExistAlliance))
			$BonusAlliance = $ExistAlliance['total_alliance_power']/2;
		
		

		$BattleArray	= $_REQUEST['battleinput'];
		$elements	= array(0, 0);
		foreach($BattleArray as $BattleSlotID => $BattleSlot)
		{
			if(isset($BattleSlot[0]) && (array_sum($BattleSlot[0]) > 0 || $BattleSlotID == 0))
			{
				$attacker	= array();
				$attacker['fleetDetail'] 		= array(
					'fleet_start_galaxy' => 1,
					'fleet_start_system' => 33,
					'fleet_start_planet' => 7, 
					'fleet_start_type' => 1, 
					'fleet_end_galaxy' => 1, 
					'fleet_end_system' => 33, 
					'fleet_end_planet' => 7, 
					'fleet_end_type' => 1, 
					'fleet_resource_metal' => 0,
					'fleet_resource_crystal' => 0,
					'fleet_resource_deuterium' => 0
				);
				
				$attacker['player']				= array(
					'id' 					=> (1000 + $BattleSlotID + 1),
					'username'				=> $LNG['bs_atter'].' Nr.'.($BattleSlotID + 1),
					'military_tech' 		=> $BattleSlot[0][109],
					'defence_tech' 			=> $BattleSlot[0][110],
					'shield_tech' 			=> $BattleSlot[0][111],
					'laser_tech' 			=> $BattleSlot[0][120],
					'ionic_tech' 			=> $BattleSlot[0][121],
					'buster_tech' 			=> $BattleSlot[0][122],
					'graviton_tech' 		=> $BattleSlot[0][199],
					'dm_attack' 			=> $USER['dm_attack'],
					'dm_attack_level' 		=> $USER['dm_attack_level'],
					'dm_defensive' 			=> $USER['dm_defensive'],
					'dm_defensive_level' 	=> $USER['dm_defensive_level'],
					'rpg_amiral' 			=> $USER['rpg_amiral'],
					'combat_exp_level' 		=> $USER['combat_exp_level'],
					'academy_p_b_1_1101' 	=> $USER['academy_p_b_1_1101'],
					'academy_p_b_1_1102' 	=> $USER['academy_p_b_1_1102'],
					'academy_p_b_1_1103' 	=> $BattleSlot[0][1103],
					'academy_p_b_1_1108' 	=> $BattleSlot[0][1108],
					'academy_p_b_1_1109' 	=> $BattleSlot[0][1109],
					'academy_p_b_1_1110' 	=> $BattleSlot[0][1110],
					'academy_p_b_1_1111' 	=> $BattleSlot[0][1111],
					'academy_p_b_1_1113' 	=> $BattleSlot[0][1113],
					'academy_p_b_2_1207' 	=> $USER['academy_p_b_2_1207'],
					'academy_p_b_3_1301' 	=> $USER['academy_p_b_3_1301'],
					'academy_p_b_3_1302' 	=> $USER['academy_p_b_3_1302'],
					'academy_p_b_3_1303' 	=> $BattleSlot[0][1303],
					'academy_p_b_3_1304' 	=> $BattleSlot[0][1304],
					'academy_p_b_3_1305' 	=> $USER['academy_p_b_1_1101'],
					'academy_p_b_3_1306' 	=> $USER['academy_p_b_1_1101'],
					'arsenal_slight_level' 	=> $USER['arsenal_slight_level'],
					'arsenal_smedium_level' => $USER['arsenal_smedium_level'],
					'arsenal_sheavy_level' 	=> $USER['arsenal_sheavy_level'],
					'arsenal_dlight_level' 	=> $USER['arsenal_dlight_level'],
					'arsenal_dmedium_level' => $USER['arsenal_dmedium_level'],
					'arsenal_dheavy_level' 	=> $USER['arsenal_dheavy_level'],
					'arsenal_laser_level' 	=> $USER['arsenal_laser_level'],
					'arsenal_ion_level' 	=> $USER['arsenal_ion_level'],
					'arsenal_plasma_level' 	=> $USER['arsenal_plasma_level'],
					'arsenal_gravity_level' => $USER['arsenal_gravity_level'],
					'academy_p_b_3_1308' 	=> $BattleSlot[0][1308],
					'academy_p_b_3_1311' 	=> $BattleSlot[0][1311],
					'academy_p_b_3_1312' 	=> $BattleSlot[0][1312],
					'academy_p_b_3_1313' 	=> $BattleSlot[0][1313],
					'academy_p_b_3_1314' 	=> $BattleSlot[0][1314],
					'BonusAlliance' 	 	=> $BonusAlliance,
					'hashallytech' 			=> 0
				); 
				
				$ally_fraction_armor 			= 0;
				$ally_fraction_shields 			= 0;
				$ally_fraction_armement 		= 0;
				$ally_fraction_in_armement 		= 0;
				$ally_fraction_in_armor 		= 0;
				$ally_fraction_in_shields 		= 0;
				$ally_fraction_def_debris 		= 0;
				$ally_fraction_defense_restore 	= 0;
			
				if($USER['ally_id'] != 0){
					$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
					$ALLIANCE = Database::get()->selectSingle($sql, array(
						':allyID'	=> $USER['ally_id']
					));
					if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
						$sql		= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
						$FRACTIONS 	= Database::get()->selectSingle($sql, array(
							':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
						));
						$ally_fraction_armor 			= $FRACTIONS['ally_fraction_armor'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_shields 			= $FRACTIONS['ally_fraction_shields'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_armement 		= $FRACTIONS['ally_fraction_armement'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_in_armement 		= $FRACTIONS['ally_fraction_in_armement'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_in_armor 		= $FRACTIONS['ally_fraction_in_armor'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_in_shields 		= $FRACTIONS['ally_fraction_in_shields'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_def_debris 		= $FRACTIONS['ally_fraction_def_debris'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_defense_restore 	= $FRACTIONS['ally_fraction_defense_restore'] * $ALLIANCE['ally_fraction_level'];
					}
				}
			
				$attacker['player']['factor']							= getFactors($attacker['player'], 'attack');
				$attacker['player']['ally_fraction_armor']				= $ally_fraction_armor;
				$attacker['player']['ally_fraction_shields']			= $ally_fraction_shields;
				$attacker['player']['ally_fraction_armement']			= $ally_fraction_armement;
				$attacker['player']['ally_fraction_in_armement']		= $ally_fraction_in_armement;
				$attacker['player']['ally_fraction_in_armor']			= $ally_fraction_in_armor;
				$attacker['player']['ally_fraction_in_shields']			= $ally_fraction_in_shields;
				$ally_fraction_def_debris_a								= $ally_fraction_def_debris;
				$attacker['player']['ally_fraction_defense_restore']	= $ally_fraction_defense_restore;
				
				foreach($BattleSlot[0] as $ID => $Count)
				{
					if(!in_array($ID, $reslist['fleet']) || $BattleSlot[0][$ID] <= 0)
					{
						unset($BattleSlot[0][$ID]);
					}
				}
				
				$attacker['unit'] 	= $BattleSlot[0];
				$attackers[]		= $attacker;
			}
				
			if(isset($BattleSlot[1]) && (array_sum($BattleSlot[1]) > 0 || $BattleSlotID == 0))
			{
				$defender	= array();
				$defender['fleetDetail'] 		= array(
					'fleet_start_galaxy' 		=> 1,
					'fleet_start_system' 		=> 33,
					'fleet_start_planet' 		=> 7, 
					'fleet_start_type' 			=> 1, 
					'fleet_end_galaxy' 			=> 1, 
					'fleet_end_system' 			=> 33, 
					'fleet_end_planet' 			=> 7, 
					'fleet_end_type' 			=> 1, 
					'fleet_resource_metal' 		=> 0,
					'fleet_resource_crystal' 	=> 0,
					'fleet_resource_deuterium' 	=> 0
				);
				
				
				$sql	= 'SELECT total_alliance_power FROM %%ALLIANCE%% WHERE id = :allyId;';
				$ExistAlliance 	= database::get()->selectSingle($sql, array(
					':allyId'	=> $targetUser['ally_id']
				));
				
				$BonusAlliance = 0;
				if(!empty($ExistAlliance))
					$BonusAlliance = $ExistAlliance['total_alliance_power']/2;
		
				$defender['player']				= array(
					'id' 					=> (2000 + $BattleSlotID + 1),
					'username'				=> $LNG['bs_deffer'].' Nr.'.($BattleSlotID + 1),
					'military_tech'		 	=> $BattleSlot[1][109],
					'defence_tech' 			=> $BattleSlot[1][110],
					'shield_tech'			=> $BattleSlot[1][111],
					'laser_tech' 			=> $BattleSlot[1][120],
					'ionic_tech' 			=> $BattleSlot[1][121],
					'buster_tech' 			=> $BattleSlot[1][122],
					'graviton_tech'		    => $BattleSlot[1][199],
					'dm_attack' 			=> $targetUser['dm_attack'], 
					'dm_attack_level' 		=> $targetUser['dm_attack_level'],
					'dm_defensive' 			=> $targetUser['dm_defensive'],
					'dm_defensive_level' 	=> $targetUser['dm_defensive_level'],
					'rpg_amiral'			=> $targetUser['rpg_amiral'],
					'combat_exp_level' 		=> $targetUser['combat_exp_level'],
					'academy_p_b_1_1101' 	=> $targetUser['academy_p_b_1_1101'],
					'academy_p_b_1_1102' 	=> $targetUser['academy_p_b_1_1101'],
					'academy_p_b_1_1103' 	=> $BattleSlot[1][1103],
					'academy_p_b_1_1108' 	=> $BattleSlot[1][1108],
					'academy_p_b_1_1109' 	=> $BattleSlot[1][1109],
					'academy_p_b_1_1110' 	=> $BattleSlot[1][1110],
					'academy_p_b_1_1111' 	=> $BattleSlot[1][1111],
					'academy_p_b_1_1113' 	=> $BattleSlot[1][1113],
					'academy_p_b_2_1207' 	=> $targetUser['academy_p_b_1_1101'],
					'academy_p_b_3_1301' 	=> $targetUser['academy_p_b_1_1101'],
					'academy_p_b_3_1302' 	=> $targetUser['academy_p_b_1_1101'],
					'academy_p_b_3_1303' 	=> $BattleSlot[1][1303],
					'academy_p_b_3_1304' 	=> $BattleSlot[1][1304],
					'academy_p_b_3_1305' 	=> $targetUser['academy_p_b_1_1101'],
					'academy_p_b_3_1306' 	=> $targetUser['academy_p_b_1_1101'],
					'arsenal_slight_level' 	=> $targetUser['arsenal_slight_level'],
					'arsenal_laser_level' 	=> $targetUser['arsenal_laser_level'],
					'arsenal_ion_level' 	=> $targetUser['arsenal_ion_level'],
					'arsenal_plasma_level' 	=> $targetUser['arsenal_plasma_level'],
					'arsenal_gravity_level' => $targetUser['arsenal_gravity_level'],
					'arsenal_smedium_level' => $targetUser['arsenal_smedium_level'],
					'arsenal_sheavy_level' 	=> $targetUser['arsenal_sheavy_level'],
					'arsenal_dlight_level' 	=> $targetUser['arsenal_dlight_level'],
					'arsenal_dmedium_level'	=> $targetUser['arsenal_dmedium_level'],
					'arsenal_dheavy_level' 	=> $targetUser['arsenal_dheavy_level'],
					'academy_p_b_3_1308' 	=> $BattleSlot[1][1308],
					'academy_p_b_3_1311' 	=> $BattleSlot[1][1311],
					'academy_p_b_3_1312' 	=> $BattleSlot[1][1312],
					'academy_p_b_3_1313' 	=> $BattleSlot[1][1313],
					'academy_p_b_3_1314' 	=> $BattleSlot[1][1314],
					'BonusAlliance' 		=> $BonusAlliance,
					'hashallytech' 			=> 0,
				); 

				$ally_fraction_armor 			= 0;
				$ally_fraction_shields 			= 0;
				$ally_fraction_armement 		= 0;
				$ally_fraction_in_armement		= 0;
				$ally_fraction_in_armor 		= 0;
				$ally_fraction_in_shields 		= 0;
				$ally_fraction_def_debris 		= 10;
				$ally_fraction_defense_restore 	= 0;
			
				if($targetUser['ally_id'] != 0){
					$sql		= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
					$ALLIANCE 	= Database::get()->selectSingle($sql, array(
						':allyID'	=> $targetUser['ally_id']
					));
					if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
						$sql		= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
						$FRACTIONS 	= Database::get()->selectSingle($sql, array(
							':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
						));
						$ally_fraction_armor 			= $FRACTIONS['ally_fraction_armor'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_shields 			= $FRACTIONS['ally_fraction_shields'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_armement 		= $FRACTIONS['ally_fraction_armement'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_in_armement 		= $FRACTIONS['ally_fraction_in_armement'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_in_armor 		= $FRACTIONS['ally_fraction_in_armor'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_in_shields 		= $FRACTIONS['ally_fraction_in_shields'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_def_debris 		= $FRACTIONS['ally_fraction_def_debris'] * $ALLIANCE['ally_fraction_level'];
						$ally_fraction_defense_restore 	= $FRACTIONS['ally_fraction_defense_restore'] * $ALLIANCE['ally_fraction_level'];
					}
				}
			
				$defender['player']['factor']						= getFactors($defender['player'], 'attack');
				$defender['player']['ally_fraction_armor']			= $ally_fraction_armor;
				$defender['player']['ally_fraction_shields']		= $ally_fraction_shields;
				$defender['player']['ally_fraction_armement']		= $ally_fraction_armement;
				$defender['player']['ally_fraction_in_armement']	= $ally_fraction_in_armement;
				$defender['player']['ally_fraction_in_armor']		= $ally_fraction_in_armor;
				$defender['player']['ally_fraction_in_shields']		= $ally_fraction_in_shields;
				$ally_fraction_def_debris_d							= $ally_fraction_def_debris;
				$defender['player']['ally_fraction_defense_restore']= $ally_fraction_defense_restore;
				
				foreach($BattleSlot[1] as $ID => $Count)
				{
					if((!in_array($ID, $reslist['fleet']) && !in_array($ID, $reslist['defense'])) || $BattleSlot[1][$ID] <= 0)
					{
						unset($BattleSlot[1][$ID]);
					}
				}
				
				$defender['unit'] 	= $BattleSlot[1];
				$defenders[]	= $defender;
			}
		}
		
		$LNG->includeData(array('FLEET'));
		
		require_once 'includes/classes/missions/functions/calculateAttack.php';
		require_once 'includes/classes/missions/functions/calculateSteal.php';
		require_once 'includes/classes/missions/functions/GenerateReport.php';
		
		$combatResult	= calculateAttack($attackers, $defenders, config::get()->Fleet_Cdr/100, 0, 0, 0);
		
		if($combatResult['won'] == "a")
		{
			$stealResource = calculateSteal($attackers, array(
				'metal' => $BattleArray[0][1][901],
				'crystal' => $BattleArray[0][1][902],
				'deuterium' => $BattleArray[0][1][903]
			), true);
		}
		else
		{
			$stealResource = array(
				901 => 0,
				902 => 0,
				903 => 0
			);
		}
		
		$debris	= array();
		
		foreach(array(901, 902) as $elementID)
		{
			$debris[$elementID]			= $combatResult['debris']['attacker'][$elementID] + $combatResult['debris']['defender'][$elementID];
		}
		
		$debrisTotal		= array_sum($debris);
		
		$moonFactor			= Config::get()->moon_factor;
		$maxMoonChance		= Config::get()->moon_chance;
		
		$chanceCreateMoon	= round($debrisTotal / 1000000000 * $moonFactor);
		$chanceCreateMoon	= min($chanceCreateMoon, $maxMoonChance);
		
		$sumSteal	= array_sum($stealResource);
		

		$stealResourceInformation1	= (ceil($sumSteal / $pricelist[202]['capacity'])); 
		$stealResourceInformation2	= (ceil($sumSteal / $pricelist[203]['capacity'])); 
		$stealResourceInformation3	= (ceil($sumSteal / $pricelist[217]['capacity'])); 
		
		$stealResourceInformation4	= (ceil($debrisTotal / $pricelist[209]['capacity']));
		$stealResourceInformation5	= (ceil($debrisTotal / $pricelist[219]['capacity']));


		$reportInfo	= array(
			'thisFleet'				=> array(
				'fleet_start_galaxy'	=> 1,
				'fleet_start_system'	=> 33,
				'fleet_start_planet'	=> 7,
				'fleet_start_type'		=> 1,
				'fleet_end_galaxy'		=> 1,
				'fleet_end_system'		=> 33,
				'fleet_end_planet'		=> 7,
				'fleet_end_type'		=> 1,
				'fleet_start_time'		=> TIMESTAMP,
			),
			'debris'				=> $debris,
			'debris901'				=> $debris[901],
			'debris902'				=> $debris[902],
			'additionalInfo1'		=> ($BattleArray[0][1][901] + $BattleArray[0][1][902] + $BattleArray[0][1][903])/2 / 5000,
			'additionalInfo2'		=> ($BattleArray[0][1][901] + $BattleArray[0][1][902] + $BattleArray[0][1][903])/2 / 250000,
			'additionalInfo3'		=> ($BattleArray[0][1][901] + $BattleArray[0][1][902] + $BattleArray[0][1][903])/2 / 400000000,
			'additionalInfo4'		=> $BattleArray[0][1][901]/2,
			'additionalInfo5'		=> $BattleArray[0][1][902]/2,
			'additionalInfo6'		=> $BattleArray[0][1][903]/2,
			'additionalInfo10'		=> $stealResourceInformation4,
			'additionalInfo11'		=> $stealResourceInformation5,
			'stealResource'			=> $stealResource,
			'moonChance'			=> $chanceCreateMoon,
			'moonDestroy'			=> false,
			'moonName'				=> NULL,
			'moonDestroyChance'		=> NULL,
			'moonDestroySuccess'	=> NULL,
			'fleetDestroyChance'	=> NULL,
			'fleetDestroySuccess'	=> NULL,
		);
		
		$reportData	= GenerateReport($combatResult, $reportInfo);
		$reportID	= md5(uniqid('', true).TIMESTAMP);

        $db = Database::get();

        $sql = "INSERT INTO %%RW%% SET rid = :reportID, raport = :reportData, time = :time, simulate = :simulate;";
        $db->insert($sql,array(
            ':reportID'     => $reportID,
            ':reportData'   => serialize($reportData),
            ':time'         => TIMESTAMP,
            ':simulate'     => 1
        ));

        $this->sendJSON($reportID);
	}
	
	function MoonSim()
	{
		global $USER, $PLANET, $reslist, $resource;
		
		$step 				= 1;
		$fleetDestroyChance = '';
		$moonDestroyChance	= '';
		$mondbasis 			= '';
		$diameter 			= '';
		$stars 				= '';
		
		if (!empty($_POST))
		{
			$stars	= HTTP::_GP('stars', 0);
			$mondbasis	= HTTP::_GP('mondbasis', 0);
			$diameter	= HTTP::_GP('diameter', 0);
			$prem	= HTTP::_GP('prem', 1);
			if($prem < 1)
				$prem = 1;
			$fleetDestroyChance	= round(sqrt($diameter) / 2);
			$moonDestroyChance	= round((100 - sqrt($diameter)) * ($stars/2), 1)*0.002;
			$moonDestroyChance	= $moonDestroyChance / $prem;
			$moonDestroyChance	= min($moonDestroyChance, 100);
			$moonDestroyChance	= max(0, min($moonDestroyChance, 50));
			
			$step = 2;
		}
		
		$this->tplObj->loadscript('moonsim.js');
		
		$this->assign(array(
			'step' 					=> $step,
			'fleetDestroyChance' 	=> $fleetDestroyChance,
			'moonDestroyChance' 	=> $moonDestroyChance,
			'mondbasis' 			=> $mondbasis,
			'stars' 				=> pretty_number($stars),
			'diameter' 				=> pretty_number($diameter),	
		));
		
		$this->display('page.moonsim.default.tpl');   
	}
	
	function show()
	{
		global $USER, $PLANET, $reslist, $resource;

		$Slots			= HTTP::_GP('slots', 1);
		$Mode			= HTTP::_GP('mode', '', UTF8_SUPPORT);
		$Pid			= HTTP::_GP('pid', 0);
		$SpyListing 	= array();
		
		$sql			= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$targetUser		= Database::get()->selectSingle($sql, array(
			':userId'	=> $Pid
		));
		
		$sql = "SELECT * FROM %%MESSAGES%% WHERE message_owner = :userId AND message_type = 0 AND message_deleted = 0 ORDER BY message_time DESC LIMIT 20;";
		$MessageList = database::get()->select($sql, array(
			':userId'   => $USER['id'],
		));
		
		foreach($MessageList as $Message){
			$SpyListing[$Message['message_id']] = array(
				'title'		=> $Message['message_subject'],
			);
		}
		
		$BattleArray[0][0][109]		= $USER[$resource[109]];
		$BattleArray[0][0][110]		= $USER[$resource[110]];
		$BattleArray[0][0][111]		= $USER[$resource[111]];
		$BattleArray[0][0][120]		= $USER[$resource[120]];
		$BattleArray[0][0][121]		= $USER[$resource[121]];
		$BattleArray[0][0][122]		= $USER[$resource[122]];
		$BattleArray[0][0][199]		= $USER[$resource[199]];
		$BattleArray[0][0][1103]	= $USER['academy_p_b_1_1103'];
		$BattleArray[0][0][1108]	= $USER['academy_p_b_1_1108'];
		$BattleArray[0][0][1109]	= $USER['academy_p_b_1_1109'];
		$BattleArray[0][0][1110]	= $USER['academy_p_b_1_1110'];
		$BattleArray[0][0][1111]	= $USER['academy_p_b_1_1111'];
		$BattleArray[0][0][1303]	= $USER['academy_p_b_3_1303'];
		$BattleArray[0][0][1308]	= $USER['academy_p_b_3_1308'];
		if($Pid != ''){
			$BattleArray[0][1][1103]	= $targetUser['academy_p_b_1_1103'];
			$BattleArray[0][1][1108]	= $targetUser['academy_p_b_1_1108'];
			$BattleArray[0][1][1109]	= $targetUser['academy_p_b_1_1109'];
			$BattleArray[0][1][1110]	= $targetUser['academy_p_b_1_1110'];
			$BattleArray[0][1][1111]	= $targetUser['academy_p_b_1_1111'];
			$BattleArray[0][1][1303]	= $targetUser['academy_p_b_3_1303'];
			$BattleArray[0][1][1308]	= $targetUser['academy_p_b_3_1308'];
		}
		
		if(empty($_REQUEST['battleinput']))
		{
			foreach($reslist['fleet'] as $ID)
			{
				if(FleetFunctions::GetFleetMaxSpeed($ID, $USER) > 0)
				{
					// Add just flyable elements
					$BattleArray[0][0][$ID]	= $PLANET[$resource[$ID]];
				}
			}
		}
		else
		{
			$BattleArray	= HTTP::_GP('battleinput', array());
		}
		
		if(isset($_REQUEST['im']))
		{
			foreach($_REQUEST['im'] as $ID => $Count)
			{
				$BattleArray[0][1][$ID]	= floattostring($Count);
			}
		}
		
		$this->tplObj->loadscript('battlesim.js');
		$fleetId 	= array(212,202,203,204,205,229,209,206,207,217,215,213,211,224,219,225,226,214,216,230,227,228,222,218,221);
		$defenceId 	= array(401,402,403,420,405,404,406,416,421,417,418,412,410,413,422,419,414,415,407,408,409,411);
		$this->assign(array(
			'Slots'			=> $Slots,
			'Mode'			=> $Mode,
			'battleinput'	=> $BattleArray,
			'fleetList'		=> $fleetId,
			'defensiveList'	=> $defenceId,
			'SpyListing'	=> $SpyListing,
			'Pid'			=> $Pid,
			'IndexAcs'		=> 0,
		));
		
		$this->display('page.battleSimulator.default.tpl');   
	}
	
	function switchside()
	{
		global $USER, $PLANET, $reslist, $resource;

		$Slots			= HTTP::_GP('slots', 1);
		$Mode			= HTTP::_GP('mode', '', UTF8_SUPPORT);
		$Pid			= HTTP::_GP('pid', 0);
		
		if($USER['id'] != 1){
			$this->printMessage('under maintenance', true, array('game.php?page=overview', 2));
		}

		$BattleArray[0][1][109]		= $USER[$resource[109]];
		$BattleArray[0][1][110]		= $USER[$resource[110]];
		$BattleArray[0][1][111]		= $USER[$resource[111]];
		$BattleArray[0][1][120]		= $USER[$resource[120]];
		$BattleArray[0][1][121]		= $USER[$resource[121]];
		$BattleArray[0][1][122]		= $USER[$resource[122]];
		$BattleArray[0][1][199]		= $USER[$resource[199]];
		$BattleArray[0][1][1103]	= $USER['academy_p_b_1_1103'];
		$BattleArray[0][1][1108]	= $USER['academy_p_b_1_1108'];
		$BattleArray[0][1][1109]	= $USER['academy_p_b_1_1109'];
		$BattleArray[0][1][1110]	= $USER['academy_p_b_1_1110'];
		$BattleArray[0][1][1111]	= $USER['academy_p_b_1_1111'];
		$BattleArray[0][1][1303]	= $USER['academy_p_b_3_1303'];
		$BattleArray[0][1][1308]	= $USER['academy_p_b_3_1308'];
		
		if(empty($_REQUEST['battleinput']))
		{
			foreach($reslist['fleet'] as $ID)
			{
				if(FleetFunctions::GetFleetMaxSpeed($ID, $USER) > 0)
				{
					// Add just flyable elements
					$BattleArray[0][1][$ID]	= $PLANET[$resource[$ID]];
				}
			}
			
			foreach($reslist['defense'] as $ID)
			{
					// Add just flyable elements
					$BattleArray[0][1][$ID]	= $PLANET[$resource[$ID]];
			
			}
		}
		else
		{
			$BattleArray	= HTTP::_GP('battleinput', array());
		}
		
		
		$this->tplObj->loadscript('battlesim.js');
		$fleetId 	= array(212,202,203,204,205,229,209,206,207,217,215,213,211,224,219,225,226,214,216,230,227,228,222,218,221);
		$defenceId 	= array(401,402,403,420,405,404,406,416,421,417,418,412,410,413,422,419,414,415,407,408,409,411);
		$this->assign(array(
			'Slots'			=> $Slots,
			'Mode'			=> $Mode,
			'battleinput'	=> $BattleArray,
			'fleetList'		=> $fleetId,
			'defensiveList'	=> $defenceId,
			'Pid'			=> $Pid,
		));
		
		$this->display('page.battleSimulator.default.tpl');   
	}
	
	function acsLoadTool(){
		global $USER, $PLANET, $reslist, $resource, $LNG;
		
		/* if($USER['id'] != 1){
			$this->printMessage('under maintenance', true, array('game.php?page=battleSimulator', 2));
		} */
		
		$msgId	= HTTP::_GP('msgId', 0);
		$sql = "SELECT * FROM %%MESSAGES%% WHERE message_owner = :userId AND message_type = 0 AND message_deleted = 0 AND message_id = :msgId;";
		$Message = database::get()->selectSingle($sql, array(
			':userId'   => $USER['id'],
			':msgId'    => $msgId,
		));
		
		if(empty($Message)){
			$this->sendJSON(array('msg' => 'The message you try to load is not a valid spy report.', 'error' => 'NOK'));
		}elseif(empty($Message['probe_array'])){
			$this->sendJSON(array('msg' => 'No fleets have been found in this spy report.', 'error' => 'NOK'));
		}else{
			$this->sendJSON(array('msg' => $Message['probe_array'], 'error' => 'OK'));
		}
	}
	
	//Misille Simulator
	function missilesim()
	{
		global $USER, $PLANET, $reslist, $resource, $LNG;
		
		$this->tplObj->loadscript('battlesim.js');
		$defenceId = array(401,402,403,420,405,404,406,416,421,417,418,412,410,413,422,419,414,415,407,408,409,411);
		
		$missileSelectorE[0]	= $LNG['gl_all_defenses'];
		$userSelector[0]		= "Select Player";
		
		foreach($defenceId as $Element)
		{	
			$missileSelectorE[$Element] = $LNG['tech'][$Element];
		}
		
		$sql = "SELECT id FROM %%USERS%% WHERE onlinetime > :onlinetime AND urlaubs_modus = 0;";
		$AllUsers = database::get()->select($sql, array(
			':onlinetime' => TIMESTAMP - 7 * 3600 * 24
		));
		
		foreach($AllUsers as $UserDatas)
		{	
			$userSelector[$UserDatas['id']] = getUsername($UserDatas['id']);
		}
		
		$this->assign(array(
			'defensiveList'		=> $defenceId,
			'userSelector' 		=> $userSelector,
			'missileSelectorE' 	=> $missileSelectorE,
			'attackerTech'	 	=> $USER['military_tech'],
			'totalMissiles'	 	=> $PLANET[$resource[503]],
		));
		
		$this->display('page.rocketSimulator.default.tpl');   
	}
	
	function missilesimSend()
	{
		global $USER, $PLANET, $reslist, $resource, $LNG, $pricelist;
		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$Target			= HTTP::_GP('Target', 0);
			$missile502		= HTTP::_GP('missile502', 0);
			$missile503		= HTTP::_GP('missile503', 0);
			$research109	= HTTP::_GP('research109', 0);
			$research110	= HTTP::_GP('research110', 0);
			$Players		= HTTP::_GP('Players', 0);

			if(!in_array($Target, array_merge($reslist['defense'], $reslist['missile'])) || $Target == 502 || $Target == 0)
			{
				$primaryTarget	= 401;
			}
			else
			{
				$primaryTarget	= $Target;
			}
			
			$targetDefensive    = array();
			$elementIDs			= $reslist['defense'];
			foreach($elementIDs as $elementID)	
			{
				$TargetAmount	= HTTP::_GP('defense_'.$elementID, 0);
				$getId			= explode('_', 'defense_'.$elementID);
				if(!in_array($getId[1], $reslist['defense']))
					continue;
				
				$targetDefensive[$elementID]	= $TargetAmount;
			}
			//if ($targetData[$resource[502]] >= $this->_fleet['fleet_amount'])
				
			$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
			$defenderData = database::get()->selectSingle($sql, array(
				':userId'	=> $Players
			));
			
			if(!empty($defenderData)){
				$academyProtect 	   = $defenderData['academy_p_b_3_1307'];
				$missile503			  -= $missile503 / 100 * academyBonus(1307, $USER);
			}			
						
			if ($missile502 >= $missile503)
			{
				$targetDefensive = array_filter($targetDefensive);
				
				if(!empty($targetDefensive))
				{
					$endArray = array();
					foreach ($targetDefensive as $Element => $destroy)
					{
						// THERE ARE DEFENSE TO ADD IN ARRAY
						$endArray[$Element] = array(
							'elementId' 	=> $Element,
							'destroy' 		=> 0,
							'lostMetal' 	=> 0,
							'lostCrystal' 	=> 0,
							'lostDeut' 		=> 0,
						);
					}
					echo json_encode($endArray);
				}
			}else
			{
				$targetDefensive = array_filter($targetDefensive);
				
				if(!empty($targetDefensive))
				{
					require_once 'includes/classes/missions/functions/calculateMIPAJAX.php';
					
					$gouvernor_attack = 0;
					if($USER['dm_attack'] > TIMESTAMP){
						$gouvernor_attack = GubPriceAPSTRACT(701, $USER['dm_attack_level'], 'dm_attack');
					}

					$getGalaxySevenAccount = getGalaxySevenAccount($USER);
					$getGalaxySevenAttack  = $getGalaxySevenAccount['attack'];
					$getGalaxySevenArmor   = $getGalaxySevenAccount['armor'];
					$getGalaxySevenShield  = $getGalaxySevenAccount['shield'];
							
					$gouvernor_shield = 0;
					if($USER['dm_defensive'] > TIMESTAMP){
						$gouvernor_shield = GubPriceAPSTRACT(702, $USER['dm_defensive_level'], 'dm_defensive');
					}
					
					$sql	= 'SELECT total_alliance_power FROM %%ALLIANCE%% WHERE id = :allyId;';
					$ExistAlliance = database::get()->selectSingle($sql, array(
						':allyId'	=> $USER['ally_id']
					));
					
					$BonusAlliance = 0;
					if(!empty($ExistAlliance))
						$BonusAlliance = $ExistAlliance['total_alliance_power']/2;
	
					$attTech = $USER['military_tech'] * 75 + $gouvernor_attack + $USER['rpg_amiral'] + $USER['combat_exp_level'] + $USER['academy_p_b_1_1101'] + (2*$USER['academy_p_b_1_1102']) + $BonusAlliance - $USER['academy_p_b_3_1302'] + $getGalaxySevenAttack;
					
					//DEFENSE CHECK CODE
					if(!empty($defenderData)){
						$gouvernor_attack = 0;
						if($USER['dm_attack'] > TIMESTAMP){
							$gouvernor_attack = GubPriceAPSTRACT(701, $defenderData['dm_attack_level'], 'dm_attack');
						}

						$getGalaxySevenAccount = getGalaxySevenAccount($defenderData);
						$getGalaxySevenAttack  = $getGalaxySevenAccount['attack'];
						$getGalaxySevenArmor   = $getGalaxySevenAccount['armor'];
						$getGalaxySevenShield  = $getGalaxySevenAccount['shield'];
								
						$gouvernor_shield = 0;
						if($defenderData['dm_defensive'] > TIMESTAMP){
							$gouvernor_shield = GubPriceAPSTRACT(702, $defenderData['dm_defensive_level'], 'dm_defensive');
						}
						
						$sql	= 'SELECT total_alliance_power FROM %%ALLIANCE%% WHERE id = :allyId;';
						$ExistAlliance = database::get()->selectSingle($sql, array(
							':allyId'	=> $defenderData['ally_id']
						));
						
						$BonusAlliance = 0;
						if(!empty($ExistAlliance))
							$BonusAlliance = $ExistAlliance['total_alliance_power']/2;
						
						$shieldTech = $defenderData['shield_tech'] * 60 + $gouvernor_shield + $defenderData['rpg_amiral'] + $defenderData['combat_exp_level'] + $defenderData['academy_p_b_3_1301'] + (2*$defenderData['academy_p_b_3_1302']) + $BonusAlliance - $defenderData['academy_p_b_1_1102'] + $getGalaxySevenArmor;
					}else{
						$shieldTech = $research110;
					}
					$result   	= calculateMIPAJAX($shieldTech, $attTech,
					$missile503, $targetDefensive, $primaryTarget, $missile502);
					
					
					ksort($result, SORT_NUMERIC);
					$endArray = array();
					foreach ($result as $Element => $destroy)
					{
						// THERE ARE DEFENSE TO ADD IN ARRAY
						$endArray[$Element] = array(
							'elementId' 	=> $Element,
							'destroy' 		=> $destroy,
							'lostMetal' 	=> $pricelist[$Element]['cost']['901'] * $destroy,
							'lostCrystal' 	=> $pricelist[$Element]['cost']['902'] * $destroy,
							'lostDeut' 		=> $pricelist[$Element]['cost']['903'] * $destroy,
						);
					}
					echo json_encode($endArray);
				}
				else
				{
					$endArray = array();
					foreach ($reslist['defense'] as $Element)
					{
						// THERE ARE DEFENSE TO ADD IN ARRAY
						$endArray[$Element] = array(
							'elementId' 	=> $Element,
							'destroy' 		=> 0,
							'lostMetal' 	=> 0,
							'lostCrystal' 	=> 0,
							'lostDeut' 		=> 0,
						);
					}
					echo json_encode($endArray);
				}
			}
		}
	}
	
	function expeditionSend()
	{
		global $USER, $PLANET, $resource, $LNG, $pricelist, $reslist;
		
		$Value 			= array();
		parse_str($_POST['form'], $value);
		$ExpeditionType = $value['expeditionType'];
		$fleetArray		= array();
		$FleetIdAllowed = array(204,205,229,206,207,215,213,211,224,225,226,214,216,227,230,228,222,218,221,202,203,217,209,2019);
		
		foreach($FleetIdAllowed as $FleetID)
		{
			if ($value['ship'.$FleetID] == 0)
				continue;
			$fleetArray[$FleetID]				= $value['ship'.$FleetID];
		}
		
		if(empty($fleetArray)){
			echo "You need to select at mimimum 1 fleet.";
			exit();
		}
		$config = config::get();
				
		$fleetPoints 		= 0; // L'indicateur du joueur - la somme des points de la flotte  (quantité de ressources consacrées à la flotte / 1.000.000)
		$fleetCapacity		= 0; // capacité total de la flotte envoyer sur expedition
		$academy_p_b_2_1207	= 0; // bonus capacite pour la partie acacemy
		$FindableDarkmatter = 0;
		
		if($USER['academy_p_b_2_1207'] > 0){
			$academy_p_b_2_1207 = $USER['academy_p_b_2_1207'] * 5;
		}
		
		$premium_expe_bonus = 0;
		if($USER['prem_expedition'] > 0 && $USER['prem_expedition_days'] > TIMESTAMP){
			$premium_expe_bonus = $USER['prem_expedition'];
		}
		
		$getGalaxySevenAccount = getGalaxySevenAccount($USER);
		$getGalaxySevenUpgrade = $getGalaxySevenAccount['findUpgrade'];
		$getGalaxySevenBonus   = $getGalaxySevenAccount['bonusExpe'];
		
		foreach ($fleetArray as $shipId => $shipAmount)
		{
			$fleetCapacity 			   	+= $shipAmount * $pricelist[$shipId]['capacity'];
			$fleetPoints   			   	+= $shipAmount * $pricelist[$shipId]['fleetPointExpe'];
		}
			 
		$fleetCapacity += $fleetCapacity / 100 * $academy_p_b_2_1207;
		//$fleetCapacity -= $this->_fleet['fleet_resource_metal'] + $this->_fleet['fleet_resource_crystal'] + $this->_fleet['fleet_resource_deuterium'] + $this->_fleet['fleet_resource_darkmatter'];
		//$totalResource = $this->_fleet['fleet_resource_metal'] + $this->_fleet['fleet_resource_crystal'] + $this->_fleet['fleet_resource_deuterium'] + $this->_fleet['fleet_resource_darkmatter'];
		
		if($ExpeditionType == 1){
			$gameSpeed 			= 200; // Indicateur sur le serveur - Le taux d'extraction des ressources
			$FactorWeightPoint 	= 1 + $config->resource_multiplier / 1000;
			$FactorMaxRess		= 5 + $config->resource_multiplier / 50;
			$eventAction		= 0 + $getGalaxySevenBonus; // variable to add in admin panel to add automatic events for expeditions
			$randomValue		= mt_rand(0,100);
			
			$premium_speed_expeditions = 0;
			if($USER['prem_speed_expiditeon'] > 0 && $USER['prem_speed_expiditeon_days'] > TIMESTAMP){
				$premium_speed_expeditions = $USER['prem_speed_expiditeon'];
			}
			
			$haltSpeed	= Config::get($USER['universe'])->halt_speed;
			$haltSpeed	+= ($haltSpeed / 100 * $premium_speed_expeditions);
			
			$stayBlockExpo	= round(1 / $haltSpeed, 2);
			
			$distance      		= FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array($PLANET['galaxy'], $PLANET['system'], 21));
			$fleetMaxSpeed 		= FleetFunctions::GetFleetMaxSpeed($fleetArray, $USER);
			$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
			$duration      		= max(5,FleetFunctions::GetMissionDuration(10, $fleetMaxSpeed, $distance, $SpeedFactor, $USER));
			
			$fleetStartTime		= $duration + TIMESTAMP;
			$StayDuration   	= round($stayBlockExpo * 3600, 0);
			$fleetStayTime		= $fleetStartTime + $StayDuration;
			$BonusRees 			= ($USER['combat_exp_expedition'] + $premium_expe_bonus) + $eventAction + ((($fleetStayTime - $fleetStartTime) / 320) * 2);
			
			if(89 <= $randomValue){
				$FactorRessMetal 		= mt_rand(10,50) * $config->resource_multiplier * $FactorMaxRess;
				$FactorRessCristal 		= mt_rand(5,25) * $config->resource_multiplier * $FactorMaxRess;
				$FactorRessDeutérium 	= (mt_rand(33,167)/10) * $config->resource_multiplier * $FactorMaxRess;
				$MaxFleetPoints			= 9000000 * $FactorWeightPoint;
			}elseif(1 < $randomValue && 89 > $randomValue){
				$FactorRessMetal 		= mt_rand(52,100) * $config->resource_multiplier * $FactorMaxRess;
				$FactorRessCristal 		= mt_rand(26,50) * $config->resource_multiplier * $FactorMaxRess;
				$FactorRessDeutérium 	= (mt_rand(173,333)/10) * $config->resource_multiplier * $FactorMaxRess;
				$MaxFleetPoints			= 10000000 * $FactorWeightPoint;
			}elseif(0 <= $randomValue && 2 > $randomValue){
				$FactorRessMetal 		= mt_rand(102,200) * $config->resource_multiplier * $FactorMaxRess;
				$FactorRessCristal 		= mt_rand(51,100) * $config->resource_multiplier * $FactorMaxRess;
			    $FactorRessDeutérium 	= (mt_rand(280,460)/10) * $config->resource_multiplier * $FactorMaxRess;
				$MaxFleetPoints			= 12000000 * $FactorWeightPoint;	
			}
			
			$FindableMetal 		= $FactorRessMetal * max(min($fleetPoints / (30 * $FactorWeightPoint ), $MaxFleetPoints ), 200);
			$FindableCristal 	= $FactorRessCristal * max(min($fleetPoints / (30 * $FactorWeightPoint ), $MaxFleetPoints ), 200);
			$FindableDeuterium 	= $FactorRessDeutérium * max(min($fleetPoints / (30 * $FactorWeightPoint ), $MaxFleetPoints ), 200);
				
			$FindableMetal 		+= $FindableMetal / 100 * $BonusRees;
			$FindableCristal 	+= $FindableCristal / 100 * $BonusRees;
			$FindableDeuterium 	+= $FindableDeuterium / 100 * $BonusRees;
			
			$chanceToFound	= mt_rand(1, 7);
			$MsgResource	= "You have a chance to find with this fleet composition\n";
			$MsgResource 	.= "Metal:". pretty_number(min($FindableMetal, $fleetCapacity))."\n";
			$MsgResource 	.= "OR Crystal:". pretty_number(min($FindableCristal, $fleetCapacity))."\n";
			$MsgResource 	.= "OR Deuterium:". pretty_number(min($FindableDeuterium, $fleetCapacity));
			
			echo $MsgResource;
			exit();
		}elseif($ExpeditionType == 2){
			$eventSize		= mt_rand(0, 100);
			$Size       	= 0;
			$Message		= "";	
			$FoundShipMess	= "";	
				
			if(10 < $eventSize) {
				$Size		= mt_rand(10000, 50000);
				$Size		= $Size + ($Size / 100 * $premium_expe_bonus);
			} elseif(0 < $eventSize && 10 >= $eventSize) {
				$Size		= mt_rand(32000, 75000);
				$Size		= $Size + ($Size / 100 * $premium_expe_bonus);
			} elseif(0 == $eventSize) {
				$Size	 	= mt_rand(55000, 110000);
				$Size		= $Size + ($Size / 100 * $premium_expe_bonus);
			}
			
			$sql		= "SELECT MAX(total_points) as total FROM %%STATPOINTS%% WHERE `stat_type` = 1 AND `universe` = 1;";
			$topPoints	= Database::get()->selectSingle($sql, array(
			), 'total');

			$MaxPoints 		= ($topPoints < 5000000000) ? 300000 : 400000;
			$FoundShips		= max(round($Size * min($fleetPoints, $MaxPoints)), 1000000);
				
			if($fleetPoints <= $config->expe_minPoint_fleet){
				$FoundShipMess .= '<br><br>'.$LNG['sys_expe_found_ships_nothing'];
			}else{
				$Found			= array();
				foreach($reslist['fleet'] as $ID) 
				{
					if(!isset($fleetArray[$ID]) || $ID == 208 || $ID == 209 || $ID == 214) continue;
						
					$MaxFound			= floor($FoundShips / ($pricelist[$ID]['cost'][901] + $pricelist[$ID]['cost'][902]));
						
					if($MaxFound <= 0) continue;
						
					$Count				= mt_rand(0, $MaxFound);
					if($Count <= 0) continue;
						
					$Found[$ID]			= $Count;
					$FoundShips	 		-= $Count * ($pricelist[$ID]['cost'][901] + $pricelist[$ID]['cost'][902]);
					$FoundShipMess   	.= $LNG['tech'][$ID].': '.pretty_number($Count)."\r\n";
					if($FoundShips <= 0) break;
				}
					
				if (empty($Found)) {
					$FoundShipMess .= '<br><br>'.$LNG['sys_expe_found_ships_nothing'];
				}
				$Message	.= "You have a chance to find with this fleet composition\n". $FoundShipMess;
			}
			echo $Message;
		}elseif($ExpeditionType == 3){
			$FindableDarkmatter		= $fleetPoints * mt_rand(5,15)/10;
			$FindableDarkmatter 	= min($FindableDarkmatter, 5000000);
			$MsgResource			= "You have a chance to find with this fleet composition\n";
			$MsgResource 			.= "Metal:". pretty_number(min($FindableDarkmatter, $fleetCapacity))."\n";
					
			echo $MsgResource;
		}elseif($ExpeditionType == 4){
			$arsenalLight	= array('arsenal_combustion', 'arsenal_slight', 'arsenal_res901', 'arsenal_dlight', 'arsenal_conveyor1', 'arsenal_laser', 'arsenal_ion');
			$arsenalMediu	= array('arsenal_impulse', 'arsenal_smedium', 'arsenal_res902', 'arsenal_dmedium', 'arsenal_conveyor2', 'arsenal_plasma');
			$arsenalHeavy	= array('arsenal_hyperspace', 'arsenal_sheavy', 'arsenal_res903', 'arsenal_dheavy', 'arsenal_conveyor3', 'arsenal_gravity');
			if($fleetPoints >= 500000){
				//all type of arsenal 3 %- 2% - 1%
				$selectTypeLight 	= mt_rand(0,6);
				$selectTypeMedium	= mt_rand(0,5);
				$selectTypeHeavy	= mt_rand(0,5);
				$chanceTypeLight 	= 50;
				$chanceTypeMedium 	= 40;
				$chanceTypeHeavy 	= 30;
				$chanceHaveLight 	= mt_rand(0,100);
				$chanceHaveMedium 	= mt_rand(0,100);
				$chanceHaveHeavy 	= mt_rand(0,100);
				$factor				= 0;
				if($chanceTypeLight >= $chanceHaveLight){
					$factor		= 1;
					$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
					$Message	= sprintf($LNG[$arsenalLight[$selectTypeLight]], $factor);
				}elseif($chanceTypeMedium >= $chanceHaveMedium){
					$factor		= 1;
					$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
					$Message	= sprintf($LNG[$arsenalMediu[$selectTypeMedium]], $factor);
				}elseif($chanceTypeHeavy >= $chanceHaveHeavy){
					$factor		= 1;
					$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
					$Message	= sprintf($LNG[$arsenalHeavy[$selectTypeHeavy]], $factor);
				}else{
					$Message	= "You didn't find anything on this expedition. The possibile cause for this are:\n";
					$Message	.= "You have send insufficient fleet points on the simulation\n";
					$Message	.= "You have only a chance to find an item, even if you send enough fleet points, in this case the chance failed.\n";
				}
			}elseif($fleetPoints >= 300000 && $fleetPoints < 500000){
				//low or mediun arsenal 3% 2%
				$selectTypeLight 	= mt_rand(0,6);
				$selectTypeMedium	= mt_rand(0,5);
				$chanceTypeLight 	= 50;
				$chanceTypeMedium 	= 40;
				$chanceHaveLight 	= mt_rand(0,100);
				$chanceHaveMedium 	= mt_rand(0,100);
				
				if($chanceTypeLight >= $chanceHaveLight){
					$factor		= 1;
					$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
					$Message	= sprintf($LNG[$arsenalLight[$selectTypeLight]], $factor);
				}elseif($chanceTypeMedium >= $chanceHaveMedium){
					$factor		= 1;
					$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
					$Message	= sprintf($LNG[$arsenalMediu[$selectTypeMedium]], $factor);
				}else{
					$Message	= "You didn't find anything on this expedition. The possibile cause for this are:\n";
					$Message	.= "You have send insufficient fleet points on the simulation\n";
					$Message	.= "You have only a chance to find an item, even if you send enough fleet points, in this case the chance failed.\n";
				}
			}elseif($fleetPoints > 100000 && $fleetPoints < 300000){
				//low arsenal 3%
				$selectTypeLight 	= mt_rand(0,6);
				$chanceType 		= 50;
				$chanceHave 		= mt_rand(0,100);
				if($chanceType >= $chanceHave){
					$factor		= 1;
					$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
					$Message	= sprintf($LNG[$arsenalLight[$selectTypeLight]], $factor);
				}else{
					$Message	= "You didn't find anything on this expedition. The possibile cause for this are:\n";
					$Message	.= "You have send insufficient fleet points on the simulation\n";
					$Message	.= "You have only a chance to find an item, even if you send enough fleet points, in this case the chance failed.\n";
				}
			}else{
				$Message	= "You didn't find anything on this expedition. The possibile cause for this are:\n";
				$Message	.= "You have send insufficient fleet points on the simulation\n";
				$Message	.= "You have only a chance to find an item, even if you send enough fleet points, in this case the chance failed.\n";
			}
			echo $Message;
		}elseif($ExpeditionType == 5){
			echo "Combat Expedition";
		}elseif($ExpeditionType == 6){
			echo "Black Hole Expedition";
		}elseif($ExpeditionType == 7){
			echo "Time Change Expedition";
		}elseif($ExpeditionType == 8){
			echo "Resource Change Expedition";
		}elseif($ExpeditionType == 9){
			echo "Cosmonaute, Haloween, New Year Expedition";
		}
	}
	
	function expeditionSim()
	{
		global $USER, $PLANET, $reslist, $resource, $LNG;
		
		$FleetsOnPlanet				= array();
		$FleetsOnPlanetBattle		= array();
		$elementPlanetBattle		= array(204,205,229,206,207,215,213,211,224,225,226,214,216,227,230,228,222,218,221);
		$FleetsOnPlanetTransport	= array();
		$elementPlanetTransport		= array(202,203,217);
		$FleetsOnPlanetProcessorcs	= array();
		$elementPlanetProcessorcs	= array(209,219);
		
		foreach($reslist['fleet'] as $FleetID)
		{
			if ($PLANET[$resource[$FleetID]] == 0)
				continue;
				
			$FleetsOnPlanet[]	= array(
				'id'	=> $FleetID,
				'speed'	=> FleetFunctions::GetFleetMaxSpeed($FleetID, $USER),
				'count'	=> $PLANET[$resource[$FleetID]],
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
			);
		}
		
		$this->tplObj->loadscript('flotten.js');
		$this->assign(array(
			'FleetsOnPlanet'				=> $FleetsOnPlanet,
			'FleetsOnPlanetBattle'			=> $FleetsOnPlanetBattle,
			'FleetsOnPlanetTransport'		=> $FleetsOnPlanetTransport,
			'FleetsOnPlanetProcessorcs'		=> $FleetsOnPlanetProcessorcs,
		));
		
		$this->display('page.battlesimulator.expedition.tpl');   
	}
}
