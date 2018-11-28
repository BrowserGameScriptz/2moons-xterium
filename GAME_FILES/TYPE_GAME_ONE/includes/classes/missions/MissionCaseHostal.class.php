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
require_once 'includes/classes/missions/functions/achievementFunction.php';
class MissionCaseHostal extends MissionFunctions implements Mission
{
	function __construct($fleet)
	{
		$this->_fleet	= $fleet;
	}
	
	function TargetEvent()
	{
		$this->setState(FLEET_HOLD);
		$this->SaveFleet();
	}
	
	function EndStayEvent()
	{
		global $pricelist, $reslist, $resource;
		$LNG	= $this->getLanguage(NULL, $this->_fleet['fleet_owner']);
		$config	= Config::get($this->_fleet['fleet_universe']);
		
		$expeditionPoints       = array();
		
		$sql			= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$ownerUser		= Database::get()->selectSingle($sql, array(
			':userId'	=> $this->_fleet['fleet_owner']
		));
		
		$premium_expe_bonus = 0;
		if($ownerUser['prem_expedition'] > 0 && $ownerUser['prem_expedition_days'] > TIMESTAMP){
			$premium_expe_bonus = $ownerUser['prem_expedition'];
		}
		
		$fleetArray		= FleetFunctions::unserialize($this->_fleet['fleet_array']);
		$fleetPoints 	= 0;
		$fleetCapacity	= 0;

		foreach ($fleetArray as $shipId => $shipAmount)
		{
			$fleetPoints   			   += $shipAmount * $pricelist[$shipId]['fleetPointExpe'];
			$fleetCapacity 			   += $shipAmount * $pricelist[$shipId]['capacity'];
		}

		$fleetCapacity  -= $this->_fleet['fleet_resource_metal'] + $this->_fleet['fleet_resource_crystal'] + $this->_fleet['fleet_resource_deuterium'] + $this->_fleet['fleet_resource_darkmatter'];
		if($fleetCapacity < 0)
			$fleetCapacity = 0;
		
		$Message        = $LNG['sys_expe_nothing_'.mt_rand(1,8)];
		
		$messageHTML	= <<<HTML
			<a href="CombatReport.php?raport=%s" class="a_batle_msg_more" target="_blank"><img alt="" src="./styles/images/iconav/search.png"> %s</a>
			<font color="%s">%s %s</font>
			<br><br>
			<font color="%s">%s: %s</font><br>
			<font color="%s">%s: %s</font><br>
			<br>%s %s: <font color="#a47d7a">%s</font> %s: <font color="#5ca6aa">%s</font> %s: <font color="#339966">%s</font>
			<br>%s %s: <font color="#a47d7a">%s</font> %s: <font color="#5ca6aa">%s</font>
			<br>
HTML;
		//Minize HTML
		$messageHTML	= str_replace(array("\n", "\t", "\r"), "", $messageHTML);
		$targetFleetData	= array();
		$sql = 'SELECT * FROM %%USERS%% WHERE id = :userId;';
		$senderData	= Database::get()->selectSingle($sql, array(
			':userId'	=> $this->_fleet['fleet_owner']
		));
		
		$ally_fraction_armor = 0;
		$ally_fraction_shields = 0;
		$ally_fraction_armement = 0;
		$ally_fraction_in_armement = 0;
		$ally_fraction_in_armor = 0;
		$ally_fraction_in_shields = 0;
		$ally_fraction_def_debris = 0;
		$ally_fraction_defense_restore = 0;
		if($senderData['ally_id'] != 0){
		$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
		$ALLIANCE = Database::get()->selectSingle($sql, array(
		':allyID'	=> $senderData['ally_id']
		));
		if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
		$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
		$FRACTIONS = Database::get()->selectSingle($sql, array(
		':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
		));
		$ally_fraction_armor = $FRACTIONS['ally_fraction_armor'] * $ALLIANCE['ally_fraction_level'];
		$ally_fraction_shields = $FRACTIONS['ally_fraction_shields'] * $ALLIANCE['ally_fraction_level'];
		$ally_fraction_armement = $FRACTIONS['ally_fraction_armement'] * $ALLIANCE['ally_fraction_level'];
		$ally_fraction_in_armement = $FRACTIONS['ally_fraction_in_armement'] * $ALLIANCE['ally_fraction_level'];
		$ally_fraction_in_armor = $FRACTIONS['ally_fraction_in_armor'] * $ALLIANCE['ally_fraction_level'];
		$ally_fraction_in_shields = $FRACTIONS['ally_fraction_in_shields'] * $ALLIANCE['ally_fraction_level'];
		$ally_fraction_def_debris = $FRACTIONS['ally_fraction_def_debris'] * $ALLIANCE['ally_fraction_level'];
		$ally_fraction_defense_restore = $FRACTIONS['ally_fraction_defense_restore'] * $ALLIANCE['ally_fraction_level'];
		}
		}
			
		switch($this->_fleet['sector'])
		{		
			case 1:
				$targetName		= $LNG['sect_hostile_2'];
				$angryEnnemie	= 5;
				$angryEnnemieMax	= mt_rand(1,100);
				$Technologie	= mt_rand(50,70)/100;
				if($angryEnnemie >= $angryEnnemieMax)
					$Technologie	= mt_rand(90,140)/100;
				$darkmatterChance	= 5;
				$academyChance	= 5;
				$darkmatterPoints	= mt_rand(1,25000);
				$academyPoints	= mt_rand(1,5);
				$arsenalItems	= array(801,805,808,811);
				$achievementAm = round(75 * pow(1.15, $ownerUser['achievement_daily_3']));
				$acievementPoint = round(15 * pow(1.15, $ownerUser['achievement_daily_3']));
				$achievementM7 = round(266968 * pow(1.40, $ownerUser['achievement_daily_3']));
				$achievementM19 = round(17798 * pow(1.40, $ownerUser['achievement_daily_3']));
				$achievementM32 = round(22 * pow(1.40, $ownerUser['achievement_daily_3']));
				$actualWins =  $ownerUser['achievement_daily_3_succes'] + 1;
				$actualNeeded =  round(10 * pow(1.80, $ownerUser['achievement_daily_3']));
				$sectorSucces =  'achievement_daily_3_succes';
				$sectorLevel  =  'achievement_daily_3';
				$sectorPoints =  'achievement_daily_3_points';
				$sectorImage  =  'ach_wons_em_1_day';
				$sectorTitle  =  'achiev_53';
				$FleetDebrisD = 10/100;
				$selectCombo	= mt_rand(1,9);
				if($fleetPoints < 5250)
				$selectCombo	= mt_rand(1,5);
				$fleetPointsCombo = $fleetPoints / 1000000;
				$fleetPointsCombo = min($fleetPointsCombo, 50);
				if($selectCombo == 1){
				$targetFleetData[204]	= mt_rand(150000, 200000);
				$targetFleetData[205]	= mt_rand(75000, 100000);
				$targetFleetData[207]	= mt_rand(10000, 15000);
				$targetFleetData[215]	= mt_rand(5000, 8000);
				$targetFleetData[224]	= mt_rand(17500, 25000);
				$targetFleetData[225]	= mt_rand(67, 200);
				}elseif($selectCombo == 2){
				$targetFleetData[229]	= mt_rand(90000, 130000);
				$targetFleetData[206]	= mt_rand(2000, 4000);
				$targetFleetData[207]	= mt_rand(700, 1500);
				$targetFleetData[213]	= mt_rand(3000, 4700);
				$targetFleetData[211]	= mt_rand(3000, 5000);
				$targetFleetData[226]	= mt_rand(60, 150);
				$targetFleetData[216]	= mt_rand(39, 97);
				$targetFleetData[227]	= mt_rand(50, 80);
				$targetFleetData[221]	= mt_rand(1, 5);
				}elseif($selectCombo == 3){
				$targetFleetData[214]	= mt_rand(1000, 2000);
				$targetFleetData[216]	= mt_rand(1000, 1500);
				}elseif($selectCombo == 4){
				$targetFleetData[204]	= mt_rand(1750000, 2500000);
				$targetFleetData[206]	= mt_rand(50000, 80000);
				$targetFleetData[207]	= mt_rand(48000, 60000);
				$targetFleetData[213]	= mt_rand(30000, 60000);
				$targetFleetData[224]	= mt_rand(11500, 15000);
				}elseif($selectCombo == 5){
				$targetFleetData[205]	= mt_rand(100000, 135000);
				$targetFleetData[225]	= mt_rand(750, 1150);
				$targetFleetData[226]	= mt_rand(100, 217);
				$targetFleetData[227]	= mt_rand(50, 87);
				$targetFleetData[218]	= mt_rand(20, 32);
				}else{}
			break;
			case 2:
				$targetName		= $LNG['sect_hostile_3'];
				$angryEnnemie	= 4;
				$angryEnnemieMax	= mt_rand(1,100);
				$Technologie	= mt_rand(55,75)/100;
				if($angryEnnemie >= $angryEnnemieMax)
					$Technologie	= mt_rand(75,145)/100;
				$darkmatterChance	= 5;
				$academyChance	= 5;
				$darkmatterPoints	= mt_rand(1,250000);
				$academyPoints	= mt_rand(1,15);
				$arsenalItems	= array(802,806,809,812);
				$achievementAm = round(100 * pow(1.25, $ownerUser['achievement_daily_4']));
				$acievementPoint = round(25 * pow(1.20, $ownerUser['achievement_daily_4']));
				$achievementM7 = round(1310720 * pow(1.40, $ownerUser['achievement_daily_4']));
				$achievementM19 = round(78643 * pow(1.40, $ownerUser['achievement_daily_4']));
				$achievementM32 = round(79 * pow(1.40, $ownerUser['achievement_daily_4']));
				$actualWins =  $ownerUser['achievement_daily_4_succes'] + 1;
				$actualNeeded =  round(7 * pow(1.80, $ownerUser['achievement_daily_4']));
				$sectorSucces =  'achievement_daily_4_succes';
				$sectorLevel  =  'achievement_daily_4';
				$sectorPoints =  'achievement_daily_4_points';
				$sectorImage  =  'ach_wons_em_2_day';
				$sectorTitle  =  'achiev_55';
				$FleetDebrisD = 15/100;
				$fleetPointsCombo = $fleetPoints / 5000000;
				$fleetPointsCombo = min($fleetPointsCombo, 50);
				$selectCombo	= mt_rand(1,9);
				if($fleetPoints < 75000)
				$selectCombo	= mt_rand(1,5);
				if($selectCombo == 1){
				$targetFleetData[204]	= mt_rand(5000000, 8000000);
				$targetFleetData[206]	= mt_rand(80000, 125000);
				$targetFleetData[207]	= mt_rand(72500, 100000);
				$targetFleetData[215]	= mt_rand(150000, 230000);
				$targetFleetData[225]	= mt_rand(5000, 8000);
				$targetFleetData[226]	= mt_rand(5000, 7000);
				}elseif($selectCombo == 2){
				$targetFleetData[204]	= mt_rand(8000000, 15000000);
				$targetFleetData[207]	= mt_rand(250000, 400000);
				$targetFleetData[211]	= mt_rand(105000, 150000);
				$targetFleetData[225]	= mt_rand(9000, 15000);
				}elseif($selectCombo == 3){
				$targetFleetData[205]	= mt_rand(800000, 1500000);
				$targetFleetData[206]	= mt_rand(1000000, 1250000);
				$targetFleetData[207]	= mt_rand(70000, 1100000);
				$targetFleetData[213]	= mt_rand(10000, 17000);
				$targetFleetData[211]	= mt_rand(190000, 230000);
				}elseif($selectCombo == 4){
				$targetFleetData[204]	= mt_rand(6000000, 10000000);
				$targetFleetData[229]	= mt_rand(100000, 190000);
				$targetFleetData[215]	= mt_rand(500000, 750000);
				$targetFleetData[221]	= mt_rand(100, 140);
				}elseif($selectCombo == 5){
				$targetFleetData[204]	= mt_rand(800000, 2500000);
				$targetFleetData[211]	= mt_rand(250000, 370000);
				$targetFleetData[225]	= mt_rand(20000, 30000);
				$targetFleetData[227]	= mt_rand(500, 700);
				$targetFleetData[222]	= mt_rand(100, 170);
				}else{}
			break;
			case 3:
				$targetName		= $LNG['sect_hostile_4'];
				$angryEnnemie	= 3;
				$angryEnnemieMax	= mt_rand(1,100);
				$Technologie	= mt_rand(60,80)/100;
				if($angryEnnemie >= $angryEnnemieMax)
					$Technologie	= mt_rand(80,150)/100;
				$darkmatterChance	= 7;
				$academyChance	= 7;
				$darkmatterPoints	= mt_rand(1,500000);
				$academyPoints	= mt_rand(3,25);
				$arsenalItems	= array(803,807,810,813);
				$achievementAm = round(125 * pow(1.35, $ownerUser['achievement_daily_5']));
				$acievementPoint = round(35 * pow(1.25, $ownerUser['achievement_daily_5']));
				$achievementM7 = round(5314410 * pow(1.30, $ownerUser['achievement_daily_5']));
				$achievementM19 = round(398581 * pow(1.30, $ownerUser['achievement_daily_5']));
				$achievementM32 = round(399 * pow(1.30, $ownerUser['achievement_daily_5']));
				$actualWins =  $ownerUser['achievement_daily_5_succes'] + 1;
				$actualNeeded =  round(5 * pow(1.80, $ownerUser['achievement_daily_5']));
				$sectorSucces =  'achievement_daily_5_succes';
				$sectorLevel  =  'achievement_daily_5';
				$sectorPoints =  'achievement_daily_5_points';
				$sectorImage  =  'ach_wons_em_3_day';
				$sectorTitle  =  'achiev_58';
				$FleetDebrisD = 20/100;
				$fleetPointsCombo = $fleetPoints / 10000000;
				$fleetPointsCombo = min($fleetPointsCombo, 50);
				$selectCombo	= mt_rand(1,9);
				if($fleetPoints < 150000)
				$selectCombo	= mt_rand(1,5);
				if($selectCombo == 1){
				$targetFleetData[204]	= mt_rand(2000000, 5000000);
				$targetFleetData[229]	= mt_rand(250000, 395000);
				$targetFleetData[224]	= mt_rand(15000, 27500);
				$targetFleetData[230]	= mt_rand(5000, 7200);
				}elseif($selectCombo == 2){
				$targetFleetData[205]	= mt_rand(2500000, 3750000);
				$targetFleetData[215]	= mt_rand(800000, 1250000);
				$targetFleetData[227]	= mt_rand(1000, 1750);
				}elseif($selectCombo == 3){
				$targetFleetData[204]	= mt_rand(800000, 1500000);
				$targetFleetData[206]	= mt_rand(1000000, 1250000);
				$targetFleetData[207]	= mt_rand(70000, 1100000);
				$targetFleetData[213]	= mt_rand(10000, 17000);
				$targetFleetData[211]	= mt_rand(190000, 230000);
				}elseif($selectCombo == 4){
				$targetFleetData[204]	= mt_rand(25000000, 42000000);
				$targetFleetData[207]	= mt_rand(900000, 1400000);
				}elseif($selectCombo == 5){
				$targetFleetData[229]	= mt_rand(2000000, 3000000);
				$targetFleetData[226]	= mt_rand(25000, 33000);
				}else{}
			break;
			case 4:
				$targetName		= $LNG['sect_hostile_5'];
				$Technologie	= mt_rand(50,70)/100;
				$darkmatterChance	= 0;
				$academyChance	= 0;
				$darkmatterPoints	= 0;
				$academyPoints	= 0;
				$arsenalItems	= array();
				$targetFleetData[204]	= 1;
			break;
			case 5:
				$targetName		= $LNG['sect_hostile_6'];
				$angryEnnemie	= 5;
				$angryEnnemieMax	= mt_rand(1,100);
				$Technologie	= mt_rand(20,45)/100;
				if($angryEnnemie >= $angryEnnemieMax)
					$Technologie	= mt_rand(40,115)/100;
				$darkmatterChance	= 5;
				$academyChance	= 5;
				$darkmatterPoints	= mt_rand(1,25000);
				$academyPoints	= mt_rand(1,7);
				$arsenalItems	= array(814,815,816);
				$achievementAm = round(75 * pow(1.30, $ownerUser['achievement_daily_7']));
				$acievementPoint = round(20 * pow(1.20, $ownerUser['achievement_daily_7']));
				$achievementM7 = round(222473 * pow(1.50, $ownerUser['achievement_daily_7']));
				$achievementM19 = round(13348 * pow(1.50, $ownerUser['achievement_daily_7']));
				$achievementM32 = round(18 * pow(1.50, $ownerUser['achievement_daily_7']));
				$actualWins =  $ownerUser['achievement_daily_7_succes'] + 1;
				$actualNeeded =  round(10 * pow(1.80, $ownerUser['achievement_daily_7']));
				$sectorSucces =  'achievement_daily_7_succes';
				$sectorLevel  =  'achievement_daily_7';
				$sectorPoints =  'achievement_daily_7_points';
				$sectorImage  =  'ach_wons_em_5_day';
				$sectorTitle  =  'achiev_62';
				$FleetDebrisD = 7/100;
				$fleetPointsCombo = $fleetPoints / 3000000;
				$fleetPointsCombo = min($fleetPointsCombo, 50);
				$selectCombo	= mt_rand(1,9);
				if($fleetPoints < 25000)
				$selectCombo	= mt_rand(1,5);
				if($selectCombo == 1){
				$targetFleetData[205]	= mt_rand(800000, 1000000);
				$targetFleetData[207]	= mt_rand(200000, 300000);
				$targetFleetData[225]	= mt_rand(2500, 3000);
				}elseif($selectCombo == 2){
				$targetFleetData[204]	= mt_rand(1350000, 2100000);
				$targetFleetData[207]	= mt_rand(173000, 220000);
				$targetFleetData[214]	= mt_rand(1233, 2000);
				}elseif($selectCombo == 3){
				$targetFleetData[213]	= mt_rand(170000, 300000);
				$targetFleetData[224]	= mt_rand(40000, 85000);
				}elseif($selectCombo == 4){
				$targetFleetData[204]	= mt_rand(500000, 1500000);
				$targetFleetData[205]	= mt_rand(250000, 500000);
				$targetFleetData[211]	= mt_rand(180000, 250000);
				}elseif($selectCombo == 5){
				$targetFleetData[229]	= mt_rand(200000, 350000);
				$targetFleetData[226]	= mt_rand(4500, 9000);
				}else{}
			break;
			case 6:
				$targetName		= $LNG['sect_hostile_7'];
				$angryEnnemie	= 4;
				$angryEnnemieMax	= mt_rand(1,100);
				$Technologie	= mt_rand(110,150)/100;
				if($angryEnnemie >= $angryEnnemieMax)
					$Technologie	= mt_rand(130,220)/100;
				$darkmatterChance	= 5;
				$academyChance	= 5;
				$darkmatterPoints	= mt_rand(1,25000);
				$academyPoints	= mt_rand(1,5);
				$arsenalItems	= array(817,818,819);
				$achievementAm = round(85 * pow(1.30, $ownerUser['achievement_daily_8']));
				$acievementPoint = round(20 * pow(1.20, $ownerUser['achievement_daily_8']));
				$achievementM7 = round(1310720 * pow(1.40, $ownerUser['achievement_daily_8']));
				$achievementM19 = round(78643 * pow(1.40, $ownerUser['achievement_daily_8']));
				$achievementM32 = round(79 * pow(1.40, $ownerUser['achievement_daily_8']));
				$actualWins =  $ownerUser['achievement_daily_8_succes'] + 1;
				$actualNeeded =  round(8 * pow(1.80, $ownerUser['achievement_daily_8']));
				$sectorSucces =  'achievement_daily_8_succes';
				$sectorLevel  =  'achievement_daily_8';
				$sectorPoints =  'achievement_daily_8_points';
				$sectorImage  =  'ach_wons_em_6_day';
				$sectorTitle  =  'achiev_64';
				$FleetDebrisD = 12/100;
				$fleetPointsCombo = $fleetPoints / 7000000;
				$fleetPointsCombo = min($fleetPointsCombo, 50);
				$selectCombo	= mt_rand(1,9);
				if($fleetPoints < 25000)
				$selectCombo	= mt_rand(1,5);
				if($selectCombo == 1){
				$targetFleetData[229]	= mt_rand(100000, 500000);
				$targetFleetData[221]	= mt_rand(40, 80);
				}elseif($selectCombo == 2){
				$targetFleetData[227]	= mt_rand(444, 1000);
				$targetFleetData[221]	= mt_rand(10, 15);
				}elseif($selectCombo == 3){
				$targetFleetData[215]	= mt_rand(250000, 372000);
				}elseif($selectCombo == 4){
				$targetFleetData[205]	= mt_rand(300000, 550000);
				$targetFleetData[215]	= mt_rand(145000, 200000);
				$targetFleetData[221]	= mt_rand(10, 20);
				}elseif($selectCombo == 5){
				$targetFleetData[229]	= mt_rand(450000, 1000000);
				$targetFleetData[224]	= mt_rand(50000, 80000);
				$targetFleetData[230]	= mt_rand(333, 1000);
				}else{}
			break;
		}
		
		$sql		= "SELECT MAX(total_points) as total FROM %%STATPOINTS%% WHERE `stat_type` = 1 AND `universe` = 1;";
		$topPoints	= Database::get()->selectSingle($sql, array(), 'total');
				
		$Size			= mt_rand(10000, 300000);
		$MaxPoints 		= ($topPoints < 5000000000) ? 1000000 : 5000000;
		$FoundShips		= max(round($Size * min($fleetPoints, $MaxPoints)), 1000000);
		
		foreach($fleetArray as $shipId => $shipAmount){
			if(!isset($targetFleetData[$shipId]))
			{
				$targetFleetData[$shipId]	= 0;
			}else{
				$targetFleetData[$shipId] = $targetFleetData[$shipId];
			}
			
			switch($this->_fleet['sector'])
			{		
				case 1:
					$attackFactor	= mt_rand(65,90)/100;
				break;
				case 2:
					$attackFactor	= mt_rand(70,95)/100;
				break;
				case 3:
					$attackFactor	= mt_rand(75,100)/100;
				break;
				case 4:
					$attackFactor	= mt_rand(65,95)/100;
				break;
				case 5:
					$attackFactor	= mt_rand(90,145)/100;
				break;
				case 6:
					$attackFactor	= mt_rand(35,50)/100;
				break;
			}
			
			$MaxFound			= floor($FoundShips / ($pricelist[$shipId]['cost'][901] + $pricelist[$shipId]['cost'][902]));
						
			if($MaxFound <= 0) 
				continue;
			
			$Count				= mt_rand(0, $MaxFound);
			if($Count <= 0) 
				continue;
						
			$FoundShips	 		-= $Count * ($pricelist[$shipId]['cost'][901] + $pricelist[$shipId]['cost'][902]);
			if($FoundShips <= 0)
				break;
			
			$targetFleetData[$shipId]	+= min($Count,ceil($shipAmount * $attackFactor));
		}
		
		
		$targetFleetData	= array_filter($targetFleetData);
			
		$targetData	= array(
			'id'				 => 0,
			'username'			 => $targetName,
			'military_tech'		 => max(round($senderData['military_tech']*$Technologie), 0),
			'defence_tech'		 => max(round($senderData['defence_tech']*$Technologie), 0),
			'shield_tech'		 => max(round($senderData['shield_tech']*$Technologie), 0),
			'dm_attack' 		 => max($senderData['dm_attack'], 0),
			'dm_attack_level' 	 => max($senderData['dm_attack_level'], 0),
			'dm_defensive' 		 => max($senderData['dm_defensive'], 0),
			'dm_defensive_level' => max($senderData['dm_defensive_level'], 0),
			'rpg_amiral' 		 => max($senderData['rpg_amiral'], 0),
			'combat_exp_level'	 => max($senderData['combat_exp_level'], 0),
			'academy_p_b_1_1101' => max(round($senderData['academy_p_b_1_1101']*$Technologie), 0),
			'academy_p_b_1_1102' => max(round($senderData['academy_p_b_1_1102']*$Technologie), 0),
			'academy_p_b_1_1103' => max(round($senderData['academy_p_b_1_1103']*$Technologie), 0),
			'academy_p_b_1_1108' => max($senderData['academy_p_b_1_1108'], 0),
			'academy_p_b_1_1109' => max($senderData['academy_p_b_1_1109'], 0),
			'academy_p_b_1_1110' => max($senderData['academy_p_b_1_1110'], 0),
			'academy_p_b_1_1111' => max($senderData['academy_p_b_1_1111'], 0),
			'academy_p_b_1_1113' => max($senderData['academy_p_b_1_1113'], 0),
			'academy_p_b_3_1301' => max(round($senderData['academy_p_b_3_1301']*$Technologie), 0),
			'academy_p_b_3_1302' => max(round($senderData['academy_p_b_3_1302']*$Technologie), 0),
			'academy_p_b_3_1303' => max(round($senderData['academy_p_b_3_1303']*$Technologie), 0),
			'academy_p_b_3_1304' => max($senderData['academy_p_b_3_1304'], 0),
			'academy_p_b_3_1305' => max($senderData['academy_p_b_3_1305'], 0),
			'academy_p_b_3_1306' => max($senderData['academy_p_b_3_1306'], 0),
			'academy_p_b_3_1308' => max($senderData['academy_p_b_3_1308'], 0),
			'academy_p_b_3_1311' => max($senderData['academy_p_b_3_1311'], 0),
			'academy_p_b_3_1312' => max($senderData['academy_p_b_3_1312'], 0),
			'academy_p_b_3_1313' => max($senderData['academy_p_b_3_1313'], 0),
			'academy_p_b_3_1314' => max($senderData['academy_p_b_3_1314'], 0),
			'arsenal_slight_level' 	 => max($senderData['arsenal_slight_level'] * $Technologie, 0),
			'arsenal_smedium_level' 	 => max($senderData['arsenal_smedium_level'] * $Technologie, 0),
			'arsenal_sheavy_level' 	 => max($senderData['arsenal_sheavy_level'] * $Technologie, 0),
			'arsenal_dlight_level' 	 => max($senderData['arsenal_dlight_level'] * $Technologie, 0),
			'arsenal_dmedium_level' 	 => max($senderData['arsenal_dmedium_level'] * $Technologie, 0),
			'arsenal_dheavy_level' 	 => max($senderData['arsenal_dheavy_level'] * $Technologie, 0),
			'ally_fraction_armor' => max(round($ally_fraction_armor*$Technologie), 0),
			'ally_fraction_shields' => max(round($ally_fraction_shields*$Technologie), 0),
			'ally_fraction_armement' => max(round($ally_fraction_armement*$Technologie), 0),
			'ally_fraction_in_armement' =>  max($ally_fraction_in_armement, 0),
			'ally_fraction_in_armor' => max($ally_fraction_in_armor, 0),
			'ally_fraction_in_shields' => max($ally_fraction_in_shields, 0),
			'ally_fraction_def_debris' => max($ally_fraction_def_debris, 0),
			'ally_fraction_defense_restore' => max($ally_fraction_defense_restore, 0)
		);
				
		$fleetID	= $this->_fleet['fleet_id'];
				
		$fleetAttack[$fleetID]['fleetDetail']		= $this->_fleet;
		$fleetAttack[$fleetID]['player']			= $senderData;
		$fleetAttack[$fleetID]['player']['factor']	= getFactors($fleetAttack[$this->_fleet['fleet_id']]['player'], 'attack', $this->_fleet['fleet_start_time']);
		$fleetAttack[$fleetID]['unit']				= $fleetArray;
		$fleetAttack[$fleetID]['player']['ally_fraction_armor']	= $ally_fraction_armor;
		$fleetAttack[$fleetID]['player']['ally_fraction_shields']	= $ally_fraction_shields;
		$fleetAttack[$fleetID]['player']['ally_fraction_armement']	= $ally_fraction_armement;
		$fleetAttack[$fleetID]['player']['ally_fraction_in_armement']	= $ally_fraction_in_armement;
		$fleetAttack[$fleetID]['player']['ally_fraction_in_armor']	= $ally_fraction_in_armor;
		$fleetAttack[$fleetID]['player']['ally_fraction_in_shields']	= $ally_fraction_in_shields;
		$fleetAttack[$fleetID]['player']['ally_fraction_def_debris']	= $ally_fraction_def_debris;
		$fleetAttack[$fleetID]['player']['ally_fraction_defense_restore']	= $ally_fraction_defense_restore;
				
		$fleetDefend = array();

		$fleetDefend[0]['fleetDetail'] = array(
			'fleet_start_galaxy'		=> $this->_fleet['fleet_end_galaxy'],
			'fleet_start_system'		=> $this->_fleet['fleet_end_system'],
			'fleet_start_planet'		=> $this->_fleet['fleet_end_planet'],
			'fleet_start_type'			=> 1,
			'fleet_end_galaxy'			=> $this->_fleet['fleet_end_galaxy'],
			'fleet_end_system'			=> $this->_fleet['fleet_end_system'],
			'fleet_end_planet'			=> $this->_fleet['fleet_end_planet'],
			'fleet_end_type'			=> 1,
			'fleet_resource_metal'		=> 0,
			'fleet_resource_crystal'	=> 0,
			'fleet_resource_deuterium'	=> 0
		);

		$bonusList	= BuildFunctions::getBonusList();
				
		$fleetDefend[0]['player']	= $targetData;
		$fleetDefend[0]['player']['factor']	= ArrayUtil::combineArrayWithSingleElement($bonusList, 0);
		$fleetDefend[0]['unit']		= $targetFleetData;
			
		require_once 'includes/classes/missions/functions/calculateAttack.php';
			
		$FleetDebrisA = 1;
		$FleetDebrisD = $FleetDebrisD; 
		$DefDebrisA = 0;
		$DefDebrisD = 0;
		$combatResult 		= calculateAttack($fleetAttack, $fleetDefend,$FleetDebrisA, $DefDebrisA, $FleetDebrisD, $DefDebrisD, 1);

		$fleetArray = '';
		$totalCount = 0;
				
		$fleetAttack[$fleetID]['unit']	= array_filter($fleetAttack[$fleetID]['unit']);
		foreach ($fleetAttack[$fleetID]['unit'] as $element => $amount)
		{
			$fleetArray .= $element.','.$amount.';';
			$totalCount += $amount;
		}

		if ($totalCount <= 0)
		{
			$this->KillFleet();
		}
		else
		{
			$this->UpdateFleet('fleet_array', substr($fleetArray, 0, -1));
			$this->UpdateFleet('fleet_amount', $totalCount);
		}

		require_once('includes/classes/missions/functions/GenerateReport.php');
			
		$debrisResource	= array(901, 902);
		$debris			= array();

		foreach($debrisResource as $elementID)
		{
			$debris[$elementID]			= $combatResult['debris']['attacker'][$elementID] + $combatResult['debris']['defender'][$elementID];
		}
		
		$darkmatterMaxChance	= mt_rand(1,100);
		$academyMaxChance		= mt_rand(1,100);
		$darkmatterPointsWon 	= 0;
		$academyPointsWon 	 	= 0;
		$firstResource			= 901;
		$secondResource			= 902;
		$thirdResource			= 903;
		$stealResource			= array(
			$firstResource => 0,
			$secondResource => 0,
			$thirdResource => 0
		);	
		if($combatResult['won'] == 'a'){
			$SortFleets 	= array();
			$capacity  		= 0;
			$firstResource	= 901;
			$secondResource	= 902;
			$thirdResource	= 903;
				
			$stealResource	= array(
				$firstResource => 0,
				$secondResource => 0,
				$thirdResource => 0
			);
			foreach($fleetAttack as $FleetID => $Attacker){
				$SortFleets[$FleetID]		= 0;
				foreach ($fleetAttack[$fleetID]['unit'] as $Element => $amount)
				{
					if($Element == 209 || $Element == 219)
					$SortFleets[$FleetID]		+= $pricelist[$Element]['capacity'] * $amount;
				}
				$capacity				+= $SortFleets[$FleetID];
			}
			$AllCapacity		= $capacity;
			if($AllCapacity <= 0)
			{
				
			}else{
				// Step 1
				$stealResource[$firstResource]		= min($capacity, $debris[901]);
				$capacity	-= $stealResource[$firstResource];
				// Step 2
				$stealResource[$secondResource] 	= min($capacity, $debris[902]);
				$capacity	-= $stealResource[$secondResource];
		 
				$db	= Database::get();
				foreach($SortFleets as $FleetID => $Capacity)
				{
				$slotFactor	= $Capacity / $AllCapacity;
			
				$sql	= "UPDATE %%FLEETS%% SET
				`fleet_resource_metal` = `fleet_resource_metal` + '".($stealResource[$firstResource] * $slotFactor)."',
				`fleet_resource_crystal` = `fleet_resource_crystal` + '".($stealResource[$secondResource] * $slotFactor)."'
				WHERE fleet_id = :fleetId;";

				$db->update($sql, array(
				':fleetId'	=> $FleetID,
				));
				}
			}
			
			if($darkmatterChance >= $darkmatterMaxChance){
				$darkmatterPointsWon	= $darkmatterPoints + $darkmatterPoints / 100 * $premium_expe_bonus;
			}
			if($academyChance >= $academyMaxChance){
				$academyPointsWon	= $academyPoints + $academyPoints / 100 * $premium_expe_bonus;
			}
			
			$sql	= "UPDATE %%USERS%% SET darkmatter = darkmatter + :darkmatterBonus, academy_p = academy_p + :academyBonus WHERE id = :id;";
			Database::get()->update($sql, array(
				':darkmatterBonus'	=> $darkmatterPointsWon,
				':academyBonus'		=> $academyPointsWon,
				':id'				=> $this->_fleet['fleet_owner']
			));
				
		}
		$debrisTotal		= array_sum($debris);
				
		$stealResource	= array(901 => $stealResource[$firstResource], 902 => $stealResource[$secondResource], 903 => 0);
				
		$stealResourceInformation4	= (ceil($debrisTotal / $pricelist[209]['capacity']));
		$stealResourceInformation5	= (ceil($debrisTotal / $pricelist[219]['capacity']));
			 
		$reportInfo	= array(
			'thisFleet'				=> $this->_fleet,
			'debris'				=> $debris,
			'debris901'				=> $debris[901],
			'debris902'				=> $debris[902],
			'stealResource'			=> $stealResource,
			'additionalInfo1'		=> ($debris[901] + $debris[901]) / 5000,
			'additionalInfo2'		=> ($debris[901] + $debris[901]) / 25000,
			'additionalInfo3'		=> ($debris[901] + $debris[901]) / 400000000,
			'additionalInfo4'		=> $debris[901],
			'additionalInfo5'		=> $debris[902],
			'additionalInfo6'		=> 0,
			'additionalInfo10'		=> $stealResourceInformation4,
			'additionalInfo11'		=> $stealResourceInformation5,
			'moonChance'			=> 0,
			'moonDestroy'			=> false,
			'moonName'				=> NULL,
			'moonDestroyChance'		=> NULL,
			'moonDestroySuccess'	=> NULL,
			'fleetDestroyChance'	=> NULL,
			'fleetDestroySuccess'	=> NULL,
		);
				
		$reportData	= GenerateReport($combatResult, $reportInfo);
		$reportID	= md5(uniqid('', true).TIMESTAMP);

		$sql		= "INSERT INTO %%RW%% SET
		rid			= :reportId,
		raport		= :reportData,
		time		= :time,
		attacker	= :attacker;";

		Database::get()->insert($sql, array(
			':reportId'		=> $reportID,
			':reportData'	=> serialize($reportData),
			':time'			=> $this->_fleet['fleet_start_time'],
			':attacker'		=> $this->_fleet['fleet_owner'],
		));
		
		switch($combatResult['won'])
		{
			case "a":
				$attackClass	= 'raportWin';
				$defendClass	= 'raportLose';
			break;
			case "r":
				$attackClass	= 'raportLose';
				$defendClass	= 'raportWin';
			break;
			default:
			$attackClass	= 'raportDraw';
				$defendClass	= 'raportDraw';
			break;
		}
				
		$message	= sprintf($messageHTML,
			$reportID,
			$LNG['view_combat_report'],
			$attackClass,
			$LNG['sys_mess_attack_report'],
			sprintf(
				$LNG['sys_adress_planet'],
				$this->_fleet['fleet_end_galaxy'],
				$this->_fleet['fleet_end_system'],
				$this->_fleet['fleet_end_planet']
			),
			$attackClass,
			$LNG['sys_lost_attacker'],
			pretty_number($combatResult['unitLost']['attacker']),
			$defendClass,
			$LNG['sys_lost_defender'],
			pretty_number($combatResult['unitLost']['defender']),
			$LNG['sys_gain'],
			$LNG['tech'][901],
			pretty_number($stealResource[901]),
			$LNG['tech'][902],
			pretty_number($stealResource[902]),
			$LNG['tech'][903],
			pretty_number($stealResource[903]),
			$LNG['sys_debris'],
			$LNG['tech'][901],
			pretty_number($debris[901]), 
			$LNG['tech'][902],
			pretty_number($debris[902])
		);
		
		if($darkmatterPointsWon >= 1){
			$message .= '<br>'.$LNG['bonus_receive'].' '.pretty_number($darkmatterPointsWon).' '.$LNG['premium_6'];
		}
		if($academyPointsWon >= 1){
			$message .= '<br>'.$LNG['bonus_receive'].' '.pretty_number($academyPointsWon).' '.$LNG['premium_5'];
			tournement($this->_fleet['fleet_owner'], 9, $academyPointsWon);
		}
		if($combatResult['won'] == 'a'){
			$Achievements = achievementSuccesCombat($ownerUser, $combatResult);	
			if($Achievements >= 1){
				$message .= '<br>'.$LNG['bonus_receive'].' '.pretty_number($Achievements).' '.$LNG['premium_4'];
			}
			tournement($this->_fleet['fleet_owner'], 5, 1);
		}
				
		if($combatResult['won'] == 'a'){
			foreach($arsenalItems as $Items){
				$itemChance = 3;
				$itemMaxChance = mt_rand(1,100);
				if($Items == 801){
				$upgName = $LNG['market_5'];
				}elseif($Items == 802){
				$upgName = $LNG['market_6'];
				}elseif($Items == 803){
				$upgName = $LNG['market_7'];
				}elseif($Items == 804){
				$upgName = $LNG['market_8'];
				}elseif($Items == 805){
				$upgName = $LNG['market_9'];
				}elseif($Items == 806){
				$upgName = $LNG['market_10'];
				}elseif($Items == 807){
				$upgName = $LNG['market_11'];
				}elseif($Items == 808){
				$upgName = $LNG['market_12'];
				}elseif($Items == 809){
				$upgName = $LNG['market_13'];
				}elseif($Items == 810){
				$upgName = $LNG['market_14'];
				}elseif($Items == 811){
				$upgName = $LNG['market_15'];
				}elseif($Items == 812){
				$upgName = $LNG['market_16'];
				}elseif($Items == 813){
				$upgName = $LNG['market_17'];
				}elseif($Items == 814){
				$upgName = $LNG['market_18'];
				}elseif($Items == 815){
				$upgName = $LNG['market_19'];
				}elseif($Items == 816){
				$upgName = $LNG['market_20'];
				}elseif($Items == 817){
				$upgName = $LNG['market_73'];
				}elseif($Items == 818){
				$upgName = $LNG['market_74'];
				}elseif($Items == 819){
				$upgName = $LNG['market_75'];
				}

				if($itemChance >= $itemMaxChance){
					$NewValue = 1 + 1 / 100 * $premium_expe_bonus;
					$NewValue += $NewValue / 100 * config::get()->arsenalHostil;
					$sql	= "UPDATE %%USERS%% SET ".$resource[$Items]." = ".$ownerUser[$resource[$Items]]." + :itemWon WHERE id = :userId;";
					Database::get()->update($sql, array(
						':itemWon'	=> $NewValue,
						':userId'	=> $this->_fleet['fleet_owner']
					));
					tournement($this->_fleet['fleet_owner'], 8, 1);
					$message .= '<br>Obtained '.$NewValue.' '. $upgName;
				}
			}
		}
		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], '', $LNG['sys_mess_tower'], 3, $LNG['sys_mess_attack_report'], $message, TIMESTAMP);
		tournement($this->_fleet['fleet_owner'], 6, 1);
		$this->setState(FLEET_RETURN);
		$this->SaveFleet();
	}
	
	function ReturnEvent()
	{
		$LNG		= $this->getLanguage(NULL, $this->_fleet['fleet_owner']);
		$Message 	= sprintf(
			$LNG['sys_expe_back_home'],
			$LNG['tech'][901], pretty_number($this->_fleet['fleet_resource_metal']),
			$LNG['tech'][902], pretty_number($this->_fleet['fleet_resource_crystal']),
			$LNG['tech'][903], pretty_number($this->_fleet['fleet_resource_deuterium']),
			$LNG['tech'][921], pretty_number($this->_fleet['fleet_resource_darkmatter'])
		);

		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 15, $LNG['sys_mess_fleetback'],
			$Message, $this->_fleet['fleet_end_time'], NULL, 1, $this->_fleet['fleet_universe']);

		$this->RestoreFleet();
	}
}
