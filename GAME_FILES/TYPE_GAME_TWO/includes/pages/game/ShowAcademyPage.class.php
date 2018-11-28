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
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @package 2Moons
 * @author Jan Kröpke <info@2moons.cc>
 * @copyright 2012 Jan Kröpke <info@2moons.cc>
 * @license https://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.2 (2013-03-18)
 * @info $Id$
 * @link https://2moons.cc/
 */

class ShowAcademyPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
	}

	function BackUpTree()
	{
		global $LNG, $resource, $USER, $PLANET;

		$Info   = HTTP::_GP('Info', 0);
		$Tree   = HTTP::_GP('Tree', 0);
		$ajax   = HTTP::_GP('ajax', 0);
		
		$branchOneQ		=	'';
		$branchTwoQ		=	'';
		$branchTreQ		=	'';
		
		$branchOne = array('academy_p_b_1_1101', 'academy_p_b_1_1102', 'academy_p_b_1_1103', 'academy_p_b_1_1105', 'academy_p_b_1_1106', 'academy_p_b_1_1107', 'academy_p_b_1_1108', 'academy_p_b_1_1109', 'academy_p_b_1_1110', 'academy_p_b_1_1111', 'academy_p_b_1_1112', 'academy_p_b_1_1113');
		$branchTwo = array('academy_p_b_2_1201', 'academy_p_b_2_1202', 'academy_p_b_2_1203', 'academy_p_b_2_1204', 'academy_p_b_2_1205', 'academy_p_b_2_1207', 'academy_p_b_2_1208', 'academy_p_b_2_1209', 'academy_p_b_2_1210');
		$branchTre = array('academy_p_b_3_1301', 'academy_p_b_3_1302', 'academy_p_b_3_1303', 'academy_p_b_3_1304', 'academy_p_b_3_1305', 'academy_p_b_3_1306', 'academy_p_b_3_1307', 'academy_p_b_3_1308', 'academy_p_b_3_1309', 'academy_p_b_3_1311', 'academy_p_b_3_1312', 'academy_p_b_3_1313', 'academy_p_b_3_1314');
		
		foreach($branchOne as $OneBranch){
			$branchOneQ	.= "".$OneBranch.",";
		}
		
		foreach($branchTwo as $TwoBranch){
			$branchTwoQ	.= "".$TwoBranch.",";
		}
		
		foreach($branchTre as $TreBranch){
			$branchTreQ	.= "".$TreBranch.",";
		}
		
		$R	= database::get()->selectSingle('SELECT '.$branchOneQ.$branchTwoQ.$branchTreQ.' id FROM %%USERS%% WHERE id = '.$USER['id'].';');
		
		if($Info == 1  && $ajax == 1){
			
			$TotalP = 0;
			if($Tree == 1){
				$TotalP = $USER['academy_p_b_1'] - calculation(1104, $USER);
			}elseif($Tree == 2){
				$TotalP = $USER['academy_p_b_2'] - $USER['academy_p_b_2_1206']*500 ;
			}elseif($Tree == 3){
				$TotalP = $USER['academy_p_b_3'] - calculation(1310, $USER);
			}
				
			if(($USER['antimatter'] + $USER['antimatter_bought']) < 5000){
				$sendEcho = array("msg"=>$LNG['resetBranch_1'],"done"=>0);
				echo json_encode($sendEcho);
			}elseif($Tree == 1 && ($R['academy_p_b_1_1101']+$R['academy_p_b_1_1102']+$R['academy_p_b_1_1103']+$R['academy_p_b_1_1105']+$R['academy_p_b_1_1106']+$R['academy_p_b_1_1107']+$R['academy_p_b_1_1108']+$R['academy_p_b_1_1109']+$R['academy_p_b_1_1110']+$R['academy_p_b_1_1111']+$R['academy_p_b_1_1112']+$R['academy_p_b_1_1113']) == 0){
				$sendEcho = array("msg"=>$LNG['resetBranch_1'],"done"=>0);
				echo json_encode($sendEcho);
			}elseif($Tree == 2 && ($R['academy_p_b_2_1201']+$R['academy_p_b_2_1202']+$R['academy_p_b_2_1203']+$R['academy_p_b_2_1204']+$R['academy_p_b_2_1205']+$R['academy_p_b_2_1207']+$R['academy_p_b_2_1208']+$R['academy_p_b_2_1209']+$R['academy_p_b_2_1210']) == 0){
				$sendEcho = array("msg"=>$LNG['resetBranch_1'],"done"=>0);
				echo json_encode($sendEcho);
			}elseif($Tree == 3 && ($R['academy_p_b_3_1301']+$R['academy_p_b_3_1302']+$R['academy_p_b_3_1303']+$R['academy_p_b_3_1304']+$R['academy_p_b_3_1305']+$R['academy_p_b_3_1306']+$R['academy_p_b_3_1307']+$R['academy_p_b_3_1308']+$R['academy_p_b_3_1309']+$R['academy_p_b_3_1311']+$R['academy_p_b_3_1312']+$R['academy_p_b_3_1313']+$R['academy_p_b_3_1314']) == 0){
				$sendEcho = array("msg"=>$LNG['resetBranch_1'],"done"=>0);
				echo json_encode($sendEcho);
			}elseif($Tree == 1 && ($R['academy_p_b_1_1101']+$R['academy_p_b_1_1102']+$R['academy_p_b_1_1103']+$R['academy_p_b_1_1105']+$R['academy_p_b_1_1106']+$R['academy_p_b_1_1107']+$R['academy_p_b_1_1108']+$R['academy_p_b_1_1109']+$R['academy_p_b_1_1110']+$R['academy_p_b_1_1111']+$R['academy_p_b_1_1112']+$R['academy_p_b_1_1113']) > 0){
				$sendEcho = array("msg"=>sprintf($LNG['resetBranch_2'], $Tree, $TotalP),"done"=>1);
				echo json_encode($sendEcho);
			}elseif($Tree == 2 && ($R['academy_p_b_2_1201']+$R['academy_p_b_2_1202']+$R['academy_p_b_2_1203']+$R['academy_p_b_2_1204']+$R['academy_p_b_2_1205']+$R['academy_p_b_2_1207']+$R['academy_p_b_2_1208']+$R['academy_p_b_2_1209']+$R['academy_p_b_2_1210']) > 0){
				$sendEcho = array("msg"=>sprintf($LNG['resetBranch_2'], $Tree, $TotalP),"done"=>1);
				echo json_encode($sendEcho);
			}elseif($Tree == 3 && ($R['academy_p_b_3_1301']+$R['academy_p_b_3_1302']+$R['academy_p_b_3_1303']+$R['academy_p_b_3_1304']+$R['academy_p_b_3_1305']+$R['academy_p_b_3_1306']+$R['academy_p_b_3_1307']+$R['academy_p_b_3_1308']+$R['academy_p_b_3_1309']+$R['academy_p_b_3_1311']+$R['academy_p_b_3_1312']+$R['academy_p_b_3_1313']+$R['academy_p_b_3_1314']) > 0){
				$sendEcho = array("msg"=>sprintf($LNG['resetBranch_2'], $Tree, $TotalP),"done"=>1);
				echo json_encode($sendEcho);
			}else{
				$sendEcho = array("msg"=>$LNG['resetBranch_1'],"done"=>0);
				echo json_encode($sendEcho);
			}
		}elseif($Info == 0 && $ajax == 1){
			if(($USER['antimatter'] + $USER['antimatter_bought']) < 5000){
				$sendEcho = array("msg"=>$LNG['resetBranch_1']);
				echo json_encode($sendEcho);
			}else{
				$TotalP = 0;
				if($Tree == 1){
					$TotalP = $USER['academy_p_b_1'] - calculation(1104, $USER);
					
					$sql	= "UPDATE %%USERS%% SET academy_p_reset = academy_p_reset + :academy_p, academy_p_b_1 = :academy_p_b_1, academy_p_b_1_1101 = :new_level,academy_p_b_1_1102 = :new_level, academy_p_b_1_1103 = :new_level, academy_p_b_1_1105 = :new_level, academy_p_b_1_1106 = :new_level,academy_p_b_1_1107 = :new_level,academy_p_b_1_1108 = :new_level,academy_p_b_1_1109 = :new_level,academy_p_b_1_1110 = :new_level,academy_p_b_1_1111 = :new_level,academy_p_b_1_1112 = :new_level,academy_p_b_1_1113 = :new_level WHERE id = :userId;";
					database::get()->update($sql, array(
						':academy_p'	=> $TotalP,
						':academy_p_b_1'	=> calculation(1104, $USER),
						':new_level'	=> 0,
						':userId'	=> $USER['id']
					));
				}elseif($Tree == 2){
					$TotalP = $USER['academy_p_b_2'] - $USER['academy_p_b_2_1206']*500;
					
					$sql	= "UPDATE %%USERS%% SET academy_p_reset = academy_p_reset + :academy_p, academy_p_b_2 = :new_lvl_bis, academy_p_b_2_1201 = :new_level,academy_p_b_2_1202 = :new_level,academy_p_b_2_1203 = :new_level,academy_p_b_2_1204 = :new_level,academy_p_b_2_1205 = :new_level,academy_p_b_2_1207 = :new_level,academy_p_b_2_1208 = :new_level,academy_p_b_2_1209 = :new_level,academy_p_b_2_1210 = :new_level WHERE id = :userId;";
					database::get()->update($sql, array(
						':academy_p'	=> $TotalP,
						':new_level'	=> 0,
						':new_lvl_bis'	=> $USER['academy_p_b_2_1206']*500,
						':userId'	=> $USER['id']
					));
		
				}elseif($Tree == 3){
					$TotalP = $USER['academy_p_b_3'] - calculation(1310, $USER);
					
					$sql	= "UPDATE %%USERS%% SET academy_p_reset = academy_p_reset + :academy_p, academy_p_b_3 = :academy_p_b_3, academy_p_b_3_1301 = :new_level,academy_p_b_3_1302 = :new_level,academy_p_b_3_1303 = :new_level,academy_p_b_3_1304 = :new_level,academy_p_b_3_1305 = :new_level,academy_p_b_3_1306 = :new_level,academy_p_b_3_1307 = :new_level,academy_p_b_3_1308 = :new_level,academy_p_b_3_1309 = :new_level,academy_p_b_3_1311 = :new_level,academy_p_b_3_1312 = :new_level,academy_p_b_3_1313 = :new_level,academy_p_b_3_1314 = :new_level WHERE id = :userId;";
					database::get()->update($sql, array(
						':academy_p'	=> $TotalP,
						':academy_p_b_3'	=> calculation(1310, $USER),
						':new_level'	=> 0,
						':userId'	=> $USER['id']
					));
				}
				
				$this->widrawAm(5000, $USER['id']);
				
				
				$sendEcho = array("msg"=>sprintf($LNG['resetBranch_3'], $Tree, $TotalP));
				echo json_encode($sendEcho);
			}
		}
			
	}
	
	function donation()
	{
		global $LNG, $resource, $USER, $PLANET;

		$pointes   		= HTTP::_GP('pointes', 0);
		$academy_cost 	= 50 - (50 / 100 * Config::get()->special_donation_academy);
		$academy_cost 	= $academy_cost * $pointes;
		if($pointes < 0 || $academy_cost < 0){
			$this->printMessage('An error occured. Please try again or open a ticket with error number #Err2507', true, array('game.php?page=academy', 2));
		}elseif(($USER['antimatter'] + $USER['antimatter_bought']) < $academy_cost){
			$this->printMessage($LNG['premium_61'], true, array('game.php?page=academy', 2));
		}else{
			$account_before = array(
				'academy_p'				=> $USER['academy_p'],
				'academy_p_reset'		=> $USER['academy_p_reset'],
				'antimatter'			=> $USER['antimatter'],
				'antimatter_bought'		=> $USER['antimatter_bought'],
				'price'					=> $academy_cost,
			);
			
			$sql	= "UPDATE %%USERS%% SET academy_p = academy_p + :academy_p WHERE id = :userId;";
			database::get()->update($sql, array(
				':academy_p'	=> $pointes,
				':userId'	=> $USER['id']
			));
			$this->widrawAm($academy_cost, $USER['id']);
			$sql	= 'SELECT darkmatter, antimatter_bought, academy_p, peacefull_exp_current, antimatter, bonus_timer FROM %%USERS%% WHERE id = :userId;';
			$getUser = database::get()->selectSingle($sql, array(
				':userId'		=> $USER['id'],
			));
			
			$account_after = array(
				'academy_p'				=> $getUser['academy_p'],
				'academy_p_reset'		=> $getUser['academy_p_reset'],
				'antimatter'			=> $getUser['antimatter'],
				'antimatter_bought'		=> $getUser['antimatter_bought'],
				'price'					=> $academy_cost,
			);
			
			$LOG = new Logcheck(2);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=academy [Buy Points]";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
			
			$this->printMessage($LNG['academy_5'], true, array('game.php?page=academy', 2));
		}	
	}
	
	function BackUp()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		$bac   = HTTP::_GP('bac', 50);
		$account_before = array(
			'academy_p'				=> $USER['academy_p'],
			'academy_p_reset'		=> $USER['academy_p_reset'],
			'darkmatter'			=> $USER['darkmatter'],
			'antimatter'			=> $USER['antimatter'],
			'antimatter_bought'		=> $USER['antimatter_bought'],	
			'academy_p_b_1'			=> $USER['academy_p_b_1'],
			'academy_p_b_2'			=> $USER['academy_p_b_2'],
			'academy_p_b_3'			=> $USER['academy_p_b_3'],
			'academy_p_b_1_1101'	=> $USER['academy_p_b_1_1101'],
			'academy_p_b_1_1102'	=> $USER['academy_p_b_1_1102'],
			'academy_p_b_1_1103'	=> $USER['academy_p_b_1_1103'],
			'academy_p_b_1_1104'	=> $USER['academy_p_b_1_1104'],
			'academy_p_b_1_1105'	=> $USER['academy_p_b_1_1105'],
			'academy_p_b_1_1106'	=> $USER['academy_p_b_1_1106'],
			'academy_p_b_1_1107'	=> $USER['academy_p_b_1_1107'],
			'academy_p_b_1_1108'	=> $USER['academy_p_b_1_1108'],
			'academy_p_b_1_1109'	=> $USER['academy_p_b_1_1109'],
			'academy_p_b_1_1110'	=> $USER['academy_p_b_1_1110'],
			'academy_p_b_1_1111'	=> $USER['academy_p_b_1_1111'],
			'academy_p_b_1_1112'	=> $USER['academy_p_b_1_1112'],
			'academy_p_b_1_1113'	=> $USER['academy_p_b_1_1113'],
			'academy_p_b_2_1201'	=> $USER['academy_p_b_2_1201'],
			'academy_p_b_2_1202'	=> $USER['academy_p_b_2_1202'],
			'academy_p_b_2_1203'	=> $USER['academy_p_b_2_1203'],
			'academy_p_b_2_1204'	=> $USER['academy_p_b_2_1204'],
			'academy_p_b_2_1205'	=> $USER['academy_p_b_2_1205'],
			'academy_p_b_2_1206'	=> $USER['academy_p_b_2_1206'],
			'academy_p_b_2_1207'	=> $USER['academy_p_b_2_1207'],
			'academy_p_b_2_1208'	=> $USER['academy_p_b_2_1208'],
			'academy_p_b_2_1209'	=> $USER['academy_p_b_2_1209'],
			'academy_p_b_2_1210'	=> $USER['academy_p_b_2_1210'],
			'academy_p_b_3_1301'	=> $USER['academy_p_b_3_1301'],
			'academy_p_b_3_1302'	=> $USER['academy_p_b_3_1302'],
			'academy_p_b_3_1303'	=> $USER['academy_p_b_3_1303'],
			'academy_p_b_3_1304'	=> $USER['academy_p_b_3_1304'],
			'academy_p_b_3_1305'	=> $USER['academy_p_b_3_1305'],
			'academy_p_b_3_1306'	=> $USER['academy_p_b_3_1306'],
			'academy_p_b_3_1307'	=> $USER['academy_p_b_3_1307'],
			'academy_p_b_3_1308'	=> $USER['academy_p_b_3_1308'],
			'academy_p_b_3_1309'	=> $USER['academy_p_b_3_1309'],
			'academy_p_b_3_1310'	=> $USER['academy_p_b_3_1310'],
			'academy_p_b_3_1311'	=> $USER['academy_p_b_3_1311'],
			'academy_p_b_3_1312'	=> $USER['academy_p_b_3_1312'],
			'academy_p_b_3_1313'	=> $USER['academy_p_b_3_1313'],
			'academy_p_b_3_1314'	=> $USER['academy_p_b_3_1314'],
		);
		$TotalP = $USER['academy_p_b_1'] + $USER['academy_p_b_2'] + $USER['academy_p_b_3'] - $USER['academy_p_b_2_1206']*500 - calculationCheck(1104, $USER) - calculationCheck(1310, $USER);
		if($bac == 50){
		$ReceivedP = $TotalP / 2;
		$db	= Database::get();
		$sql	= "UPDATE %%USERS%% SET academy_p_reset = academy_p_reset + :academy_p, academy_p_b_1 = :new_lvl_tris, academy_p_b_2 = :new_lvl_bis, academy_p_b_3 = :new_lvl_quatri, academy_p_b_1_1101 = :new_level,academy_p_b_1_1102 = :new_level, academy_p_b_1_1103 = :new_level, academy_p_b_1_1105 = :new_level, academy_p_b_1_1106 = :new_level,academy_p_b_1_1107 = :new_level,academy_p_b_1_1108 = :new_level,academy_p_b_1_1109 = :new_level,academy_p_b_1_1110 = :new_level,academy_p_b_1_1111 = :new_level,academy_p_b_1_1112 = :new_level,academy_p_b_1_1113 = :new_level,academy_p_b_2_1201 = :new_level,academy_p_b_2_1202 = :new_level,academy_p_b_2_1203 = :new_level,academy_p_b_2_1204 = :new_level,academy_p_b_2_1205 = :new_level,academy_p_b_2_1207 = :new_level,academy_p_b_2_1208 = :new_level,academy_p_b_2_1209 = :new_level,academy_p_b_2_1210 = :new_level,academy_p_b_3_1301 = :new_level,academy_p_b_3_1302 = :new_level,academy_p_b_3_1303 = :new_level,academy_p_b_3_1304 = :new_level,academy_p_b_3_1305 = :new_level,academy_p_b_3_1306 = :new_level,academy_p_b_3_1307 = :new_level,academy_p_b_3_1308 = :new_level,academy_p_b_3_1309 = :new_level,academy_p_b_3_1311 = :new_level,academy_p_b_3_1312 = :new_level,academy_p_b_3_1313 = :new_level,academy_p_b_3_1314 = :new_level WHERE id = :userId;";
		$db->update($sql, array(
			':academy_p'	=> $ReceivedP,
			':new_level'	=> 0,
			':new_lvl_bis'	=> $USER['academy_p_b_2_1206']*500,
			':new_lvl_tris'	=> calculationCheck(1104, $USER),
			':new_lvl_quatri'	=> calculationCheck(1310, $USER),
			':userId'	=> $USER['id']
		));
		$UserPlanet = array();
		$sql	= 'SELECT * FROM %%PLANETS%% WHERE id_owner = :userId;';
		$UserPlanets = $db->select($sql, array(
			':userId'	=> $USER['id']
		));
		
		foreach($UserPlanets as $PlanetInfo){
			if($PlanetInfo['small_protection_shield'] > 25 + ($USER['academy_p_b_2_1208'] * 25)){
				$sql	= "UPDATE %%PLANETS%% SET small_protection_shield = :small_protection_shield WHERE id = :planetId;";
				$db->update($sql, array(
				':small_protection_shield'	=> 25 + ($USER['academy_p_b_2_1208'] * 25),
				':planetId'	=> $PlanetInfo['id']
				));
			}
			if($PlanetInfo['planet_protector'] > 25 + ($USER['academy_p_b_2_1208'] * 25)){
				$sql	= "UPDATE %%PLANETS%% SET planet_protector = :planet_protector WHERE id = :planetId;";
				$db->update($sql, array(
				':planet_protector'	=> 25 + ($USER['academy_p_b_2_1208'] * 25),
				':planetId'	=> $PlanetInfo['id']
				));
			}
			if($PlanetInfo['big_protection_shield'] > 25 + ($USER['academy_p_b_2_1208'] * 25)){
				$sql	= "UPDATE %%PLANETS%% SET big_protection_shield = :big_protection_shield WHERE id = :planetId;";
				$db->update($sql, array(
				':big_protection_shield'	=> 25 + ($USER['academy_p_b_2_1208'] * 25),
				':planetId'	=> $PlanetInfo['id']
				));
			}
		}
		
		$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
		$getUser = $db->selectSingle($sql, array(
			':userId'		=> $USER['id'],
		));
		$account_after = array(
			'academy_p'				=> $getUser['academy_p'],
			'academy_p_reset'		=> $getUser['academy_p_reset'],
			'darkmatter'			=> $getUser['darkmatter'],
			'antimatter_bought'		=> $getUser['antimatter_bought'],	
			'antimatter'			=> $getUser['antimatter'],
			'academy_p_b_1'			=> $getUser['academy_p_b_1'],
			'academy_p_b_2'			=> $getUser['academy_p_b_2'],
			'academy_p_b_3'			=> $getUser['academy_p_b_3'],
			'academy_p_b_1_1101'	=> $getUser['academy_p_b_1_1101'],
			'academy_p_b_1_1102'	=> $getUser['academy_p_b_1_1102'],
			'academy_p_b_1_1103'	=> $getUser['academy_p_b_1_1103'],
			'academy_p_b_1_1104'	=> $getUser['academy_p_b_1_1104'],
			'academy_p_b_1_1105'	=> $getUser['academy_p_b_1_1105'],
			'academy_p_b_1_1106'	=> $getUser['academy_p_b_1_1106'],
			'academy_p_b_1_1107'	=> $getUser['academy_p_b_1_1107'],
			'academy_p_b_1_1108'	=> $getUser['academy_p_b_1_1108'],
			'academy_p_b_1_1109'	=> $getUser['academy_p_b_1_1109'],
			'academy_p_b_1_1110'	=> $getUser['academy_p_b_1_1110'],
			'academy_p_b_1_1111'	=> $getUser['academy_p_b_1_1111'],
			'academy_p_b_1_1112'	=> $getUser['academy_p_b_1_1112'],
			'academy_p_b_1_1113'	=> $getUser['academy_p_b_1_1113'],
			'academy_p_b_2_1201'	=> $getUser['academy_p_b_2_1201'],
			'academy_p_b_2_1202'	=> $getUser['academy_p_b_2_1202'],
			'academy_p_b_2_1203'	=> $getUser['academy_p_b_2_1203'],
			'academy_p_b_2_1204'	=> $getUser['academy_p_b_2_1204'],
			'academy_p_b_2_1205'	=> $getUser['academy_p_b_2_1205'],
			'academy_p_b_2_1206'	=> $getUser['academy_p_b_2_1206'],
			'academy_p_b_2_1207'	=> $getUser['academy_p_b_2_1207'],
			'academy_p_b_2_1208'	=> $getUser['academy_p_b_2_1208'],
			'academy_p_b_2_1209'	=> $getUser['academy_p_b_2_1209'],
			'academy_p_b_2_1210'	=> $getUser['academy_p_b_2_1210'],
			'academy_p_b_3_1301'	=> $getUser['academy_p_b_3_1301'],
			'academy_p_b_3_1302'	=> $getUser['academy_p_b_3_1302'],
			'academy_p_b_3_1303'	=> $getUser['academy_p_b_3_1303'],
			'academy_p_b_3_1304'	=> $getUser['academy_p_b_3_1304'],
			'academy_p_b_3_1305'	=> $getUser['academy_p_b_3_1305'],
			'academy_p_b_3_1306'	=> $getUser['academy_p_b_3_1306'],
			'academy_p_b_3_1307'	=> $getUser['academy_p_b_3_1307'],
			'academy_p_b_3_1308'	=> $getUser['academy_p_b_3_1308'],
			'academy_p_b_3_1309'	=> $getUser['academy_p_b_3_1309'],
			'academy_p_b_3_1310'	=> $getUser['academy_p_b_3_1310'],
			'academy_p_b_3_1311'	=> $getUser['academy_p_b_3_1311'],
			'academy_p_b_3_1312'	=> $getUser['academy_p_b_3_1312'],
			'academy_p_b_3_1313'	=> $getUser['academy_p_b_3_1313'],
			'academy_p_b_3_1314'	=> $getUser['academy_p_b_3_1314'],
		);
		
		$LOG = new Logcheck(7);
		$LOG->username = $USER['username'];
		$LOG->pageLog = "page=academy [Free Reset]";
		$LOG->old = $account_before;
		$LOG->new = $account_after;
		$LOG->save();
		$this->printMessage($LNG['academy_6'], true, array('game.php?page=academy', 2));
		}elseif($bac == 75){
		if($USER['darkmatter'] >= 200000){
		$ReceivedP = $TotalP / 100 * 75;
		$db	= Database::get();
		$sql	= "UPDATE %%USERS%% SET darkmatter = darkmatter - 200000, academy_p_reset = academy_p_reset + :academy_p, academy_p_b_1 = :new_lvl_tris, academy_p_b_2 = :new_lvl_bis, academy_p_b_3 = :new_lvl_quatri, academy_p_b_1_1101 = :new_level,academy_p_b_1_1102 = :new_level, academy_p_b_1_1103 = :new_level, academy_p_b_1_1105 = :new_level, academy_p_b_1_1106 = :new_level,academy_p_b_1_1107 = :new_level,academy_p_b_1_1108 = :new_level,academy_p_b_1_1109 = :new_level,academy_p_b_1_1110 = :new_level,academy_p_b_1_1111 = :new_level,academy_p_b_1_1112 = :new_level,academy_p_b_1_1113 = :new_level,academy_p_b_2_1201 = :new_level,academy_p_b_2_1202 = :new_level,academy_p_b_2_1203 = :new_level,academy_p_b_2_1204 = :new_level,academy_p_b_2_1205 = :new_level,academy_p_b_2_1207 = :new_level,academy_p_b_2_1208 = :new_level,academy_p_b_2_1209 = :new_level,academy_p_b_2_1210 = :new_level,academy_p_b_3_1301 = :new_level,academy_p_b_3_1302 = :new_level,academy_p_b_3_1303 = :new_level,academy_p_b_3_1304 = :new_level,academy_p_b_3_1305 = :new_level,academy_p_b_3_1306 = :new_level,academy_p_b_3_1307 = :new_level,academy_p_b_3_1308 = :new_level,academy_p_b_3_1309 = :new_level,academy_p_b_3_1311 = :new_level,academy_p_b_3_1312 = :new_level,academy_p_b_3_1313 = :new_level,academy_p_b_3_1314 = :new_level WHERE id = :userId;";
		$db->update($sql, array(
			':academy_p'	=> $ReceivedP,
			':new_level'	=> 0,
			':new_lvl_bis'	=> $USER['academy_p_b_2_1206']*500,
			':new_lvl_tris'	=> calculationCheck(1104, $USER),
			':new_lvl_quatri'	=> calculationCheck(1310, $USER),
			':userId'	=> $USER['id']
		));
		$USER['darkmatter'] -= 200000;
		$UserPlanet = array();
		$sql	= 'SELECT * FROM %%PLANETS%% WHERE id_owner = :userId;';
		$UserPlanets = $db->select($sql, array(
			':userId'	=> $USER['id']
		));
		
		foreach($UserPlanets as $PlanetInfo){
			if($PlanetInfo['small_protection_shield'] > 25 + ($USER['academy_p_b_2_1208'] * 25)){
				$sql	= "UPDATE %%PLANETS%% SET small_protection_shield = :small_protection_shield WHERE id = :planetId;";
				$db->update($sql, array(
				':small_protection_shield'	=> 25 + ($USER['academy_p_b_2_1208'] * 25),
				':planetId'	=> $PlanetInfo['id']
				));
			}
			if($PlanetInfo['planet_protector'] > 25 + ($USER['academy_p_b_2_1208'] * 25)){
				$sql	= "UPDATE %%PLANETS%% SET planet_protector = :planet_protector WHERE id = :planetId;";
				$db->update($sql, array(
				':planet_protector'	=> 25 + ($USER['academy_p_b_2_1208'] * 25),
				':planetId'	=> $PlanetInfo['id']
				));
			}
			if($PlanetInfo['big_protection_shield'] > 25 + ($USER['academy_p_b_2_1208'] * 25)){
				$sql	= "UPDATE %%PLANETS%% SET big_protection_shield = :big_protection_shield WHERE id = :planetId;";
				$db->update($sql, array(
				':big_protection_shield'	=> 25 + ($USER['academy_p_b_2_1208'] * 25),
				':planetId'	=> $PlanetInfo['id']
				));
			}
		}
		
		$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
		$getUser = $db->selectSingle($sql, array(
			':userId'		=> $USER['id'],
		));
		$account_after = array(
			'academy_p'				=> $getUser['academy_p'],
			'academy_p_reset'		=> $getUser['academy_p_reset'],
			'darkmatter'			=> $getUser['darkmatter'],
			'antimatter'			=> $getUser['antimatter'],
			'antimatter_bought'		=> $getUser['antimatter_bought'],	
			'academy_p_b_1'			=> $getUser['academy_p_b_1'],
			'academy_p_b_2'			=> $getUser['academy_p_b_2'],
			'academy_p_b_3'			=> $getUser['academy_p_b_3'],
			'academy_p_b_1_1101'	=> $getUser['academy_p_b_1_1101'],
			'academy_p_b_1_1102'	=> $getUser['academy_p_b_1_1102'],
			'academy_p_b_1_1103'	=> $getUser['academy_p_b_1_1103'],
			'academy_p_b_1_1104'	=> $getUser['academy_p_b_1_1104'],
			'academy_p_b_1_1105'	=> $getUser['academy_p_b_1_1105'],
			'academy_p_b_1_1106'	=> $getUser['academy_p_b_1_1106'],
			'academy_p_b_1_1107'	=> $getUser['academy_p_b_1_1107'],
			'academy_p_b_1_1108'	=> $getUser['academy_p_b_1_1108'],
			'academy_p_b_1_1109'	=> $getUser['academy_p_b_1_1109'],
			'academy_p_b_1_1110'	=> $getUser['academy_p_b_1_1110'],
			'academy_p_b_1_1111'	=> $getUser['academy_p_b_1_1111'],
			'academy_p_b_1_1112'	=> $getUser['academy_p_b_1_1112'],
			'academy_p_b_1_1113'	=> $getUser['academy_p_b_1_1113'],
			'academy_p_b_2_1201'	=> $getUser['academy_p_b_2_1201'],
			'academy_p_b_2_1202'	=> $getUser['academy_p_b_2_1202'],
			'academy_p_b_2_1203'	=> $getUser['academy_p_b_2_1203'],
			'academy_p_b_2_1204'	=> $getUser['academy_p_b_2_1204'],
			'academy_p_b_2_1205'	=> $getUser['academy_p_b_2_1205'],
			'academy_p_b_2_1206'	=> $getUser['academy_p_b_2_1206'],
			'academy_p_b_2_1207'	=> $getUser['academy_p_b_2_1207'],
			'academy_p_b_2_1208'	=> $getUser['academy_p_b_2_1208'],
			'academy_p_b_2_1209'	=> $getUser['academy_p_b_2_1209'],
			'academy_p_b_2_1210'	=> $getUser['academy_p_b_2_1210'],
			'academy_p_b_3_1301'	=> $getUser['academy_p_b_3_1301'],
			'academy_p_b_3_1302'	=> $getUser['academy_p_b_3_1302'],
			'academy_p_b_3_1303'	=> $getUser['academy_p_b_3_1303'],
			'academy_p_b_3_1304'	=> $getUser['academy_p_b_3_1304'],
			'academy_p_b_3_1305'	=> $getUser['academy_p_b_3_1305'],
			'academy_p_b_3_1306'	=> $getUser['academy_p_b_3_1306'],
			'academy_p_b_3_1307'	=> $getUser['academy_p_b_3_1307'],
			'academy_p_b_3_1308'	=> $getUser['academy_p_b_3_1308'],
			'academy_p_b_3_1309'	=> $getUser['academy_p_b_3_1309'],
			'academy_p_b_3_1310'	=> $getUser['academy_p_b_3_1310'],
			'academy_p_b_3_1311'	=> $getUser['academy_p_b_3_1311'],
			'academy_p_b_3_1312'	=> $getUser['academy_p_b_3_1312'],
			'academy_p_b_3_1313'	=> $getUser['academy_p_b_3_1313'],
			'academy_p_b_3_1314'	=> $getUser['academy_p_b_3_1314'],
		);
		
		$LOG = new Logcheck(7);
		$LOG->username = $USER['username'];
		$LOG->pageLog = "page=academy [Darkmatter Reset]";
		$LOG->old = $account_before;
		$LOG->new = $account_after;
		$LOG->save();
		
		$this->printMessage($LNG['academy_6'], true, array('game.php?page=academy', 2));
		}else{
		header('Location: https://'.$_SERVER['HTTP_HOST'].'/game.php?page=academy');
		}
		}elseif($bac == 100){
		if(($USER['antimatter'] + $USER['antimatter_bought']) >= 10000){
		$ReceivedP = $TotalP;
		$db	= Database::get();
		$sql	= "UPDATE %%USERS%% SET academy_p_reset = academy_p_reset + :academy_p, academy_p_b_1 = :new_lvl_tris, academy_p_b_2 = :new_lvl_bis, academy_p_b_3 = :new_lvl_quatri, academy_p_b_1_1101 = :new_level,academy_p_b_1_1102 = :new_level, academy_p_b_1_1103 = :new_level, academy_p_b_1_1105 = :new_level, academy_p_b_1_1106 = :new_level,academy_p_b_1_1107 = :new_level,academy_p_b_1_1108 = :new_level,academy_p_b_1_1109 = :new_level,academy_p_b_1_1110 = :new_level,academy_p_b_1_1111 = :new_level,academy_p_b_1_1112 = :new_level,academy_p_b_1_1113 = :new_level,academy_p_b_2_1201 = :new_level,academy_p_b_2_1202 = :new_level,academy_p_b_2_1203 = :new_level,academy_p_b_2_1204 = :new_level,academy_p_b_2_1205 = :new_level,academy_p_b_2_1207 = :new_level,academy_p_b_2_1208 = :new_level,academy_p_b_2_1209 = :new_level,academy_p_b_2_1210 = :new_level,academy_p_b_3_1301 = :new_level,academy_p_b_3_1302 = :new_level,academy_p_b_3_1303 = :new_level,academy_p_b_3_1304 = :new_level,academy_p_b_3_1305 = :new_level,academy_p_b_3_1306 = :new_level,academy_p_b_3_1307 = :new_level,academy_p_b_3_1308 = :new_level,academy_p_b_3_1309 = :new_level,academy_p_b_3_1311 = :new_level,academy_p_b_3_1312 = :new_level,academy_p_b_3_1313 = :new_level,academy_p_b_3_1314 = :new_level WHERE id = :userId;";
		$db->update($sql, array(
			':academy_p'	=> $ReceivedP,
			':new_level'	=> 0,
			':new_lvl_bis'	=> $USER['academy_p_b_2_1206']*500,
			':new_lvl_tris'	=> calculationCheck(1104, $USER),
			':new_lvl_quatri'	=> calculationCheck(1310, $USER),
			':userId'	=> $USER['id']
		));
		$this->widrawAm(10000, $USER['id']);
		$UserPlanet = array();
		$sql	= 'SELECT * FROM %%PLANETS%% WHERE id_owner = :userId;';
		$UserPlanets = $db->select($sql, array(
			':userId'	=> $USER['id']
		));
		
		foreach($UserPlanets as $PlanetInfo){
			if($PlanetInfo['small_protection_shield'] > 25 + ($USER['academy_p_b_2_1208'] * 25)){
				$sql	= "UPDATE %%PLANETS%% SET small_protection_shield = :small_protection_shield WHERE id = :planetId;";
				$db->update($sql, array(
				':small_protection_shield'	=> 25 + ($USER['academy_p_b_2_1208'] * 25),
				':planetId'	=> $PlanetInfo['id']
				));
			}
			if($PlanetInfo['planet_protector'] > 25 + ($USER['academy_p_b_2_1208'] * 25)){
				$sql	= "UPDATE %%PLANETS%% SET planet_protector = :planet_protector WHERE id = :planetId;";
				$db->update($sql, array(
				':planet_protector'	=> 25 + ($USER['academy_p_b_2_1208'] * 25),
				':planetId'	=> $PlanetInfo['id']
				));
			}
			if($PlanetInfo['big_protection_shield'] > 25 + ($USER['academy_p_b_2_1208'] * 25)){
				$sql	= "UPDATE %%PLANETS%% SET big_protection_shield = :big_protection_shield WHERE id = :planetId;";
				$db->update($sql, array(
				':big_protection_shield'	=> 25 + ($USER['academy_p_b_2_1208'] * 25),
				':planetId'	=> $PlanetInfo['id']
				));
			}
		}
		
		$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
		$getUser = $db->selectSingle($sql, array(
			':userId'		=> $USER['id'],
		));
		$account_after = array(
			'academy_p'				=> $getUser['academy_p'],
			'academy_p_reset'		=> $getUser['academy_p_reset'],
			'darkmatter'			=> $getUser['darkmatter'],
			'antimatter'			=> $getUser['antimatter'],
			'antimatter_bought'		=> $getUser['antimatter_bought'],			
			'academy_p_b_1'			=> $getUser['academy_p_b_1'],
			'academy_p_b_2'			=> $getUser['academy_p_b_2'],
			'academy_p_b_3'			=> $getUser['academy_p_b_3'],
			'academy_p_b_1_1101'	=> $getUser['academy_p_b_1_1101'],
			'academy_p_b_1_1102'	=> $getUser['academy_p_b_1_1102'],
			'academy_p_b_1_1103'	=> $getUser['academy_p_b_1_1103'],
			'academy_p_b_1_1104'	=> $getUser['academy_p_b_1_1104'],
			'academy_p_b_1_1105'	=> $getUser['academy_p_b_1_1105'],
			'academy_p_b_1_1106'	=> $getUser['academy_p_b_1_1106'],
			'academy_p_b_1_1107'	=> $getUser['academy_p_b_1_1107'],
			'academy_p_b_1_1108'	=> $getUser['academy_p_b_1_1108'],
			'academy_p_b_1_1109'	=> $getUser['academy_p_b_1_1109'],
			'academy_p_b_1_1110'	=> $getUser['academy_p_b_1_1110'],
			'academy_p_b_1_1111'	=> $getUser['academy_p_b_1_1111'],
			'academy_p_b_1_1112'	=> $getUser['academy_p_b_1_1112'],
			'academy_p_b_1_1113'	=> $getUser['academy_p_b_1_1113'],
			'academy_p_b_2_1201'	=> $getUser['academy_p_b_2_1201'],
			'academy_p_b_2_1202'	=> $getUser['academy_p_b_2_1202'],
			'academy_p_b_2_1203'	=> $getUser['academy_p_b_2_1203'],
			'academy_p_b_2_1204'	=> $getUser['academy_p_b_2_1204'],
			'academy_p_b_2_1205'	=> $getUser['academy_p_b_2_1205'],
			'academy_p_b_2_1206'	=> $getUser['academy_p_b_2_1206'],
			'academy_p_b_2_1207'	=> $getUser['academy_p_b_2_1207'],
			'academy_p_b_2_1208'	=> $getUser['academy_p_b_2_1208'],
			'academy_p_b_2_1209'	=> $getUser['academy_p_b_2_1209'],
			'academy_p_b_2_1210'	=> $getUser['academy_p_b_2_1210'],
			'academy_p_b_3_1301'	=> $getUser['academy_p_b_3_1301'],
			'academy_p_b_3_1302'	=> $getUser['academy_p_b_3_1302'],
			'academy_p_b_3_1303'	=> $getUser['academy_p_b_3_1303'],
			'academy_p_b_3_1304'	=> $getUser['academy_p_b_3_1304'],
			'academy_p_b_3_1305'	=> $getUser['academy_p_b_3_1305'],
			'academy_p_b_3_1306'	=> $getUser['academy_p_b_3_1306'],
			'academy_p_b_3_1307'	=> $getUser['academy_p_b_3_1307'],
			'academy_p_b_3_1308'	=> $getUser['academy_p_b_3_1308'],
			'academy_p_b_3_1309'	=> $getUser['academy_p_b_3_1309'],
			'academy_p_b_3_1310'	=> $getUser['academy_p_b_3_1310'],
			'academy_p_b_3_1311'	=> $getUser['academy_p_b_3_1311'],
			'academy_p_b_3_1312'	=> $getUser['academy_p_b_3_1312'],
			'academy_p_b_3_1313'	=> $getUser['academy_p_b_3_1313'],
			'academy_p_b_3_1314'	=> $getUser['academy_p_b_3_1314'],
		);
		
		$LOG = new Logcheck(7);
		$LOG->username = $USER['username'];
		$LOG->pageLog = "page=academy [Antimatter Reset]";
		$LOG->old = $account_before;
		$LOG->new = $account_after;
		$LOG->save();
		$this->printMessage($LNG['academy_6'], true, array('game.php?page=academy', 2));
		}else{
		header('Location: https://'.$_SERVER['HTTP_HOST'].'/game.php?page=academy');
		}
		}
		
	}

	function skillup()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		$this->setWindow('popup');
		$this->initTemplate();
		$academyId   = HTTP::_GP('id', 0);
		
		if(!isset($LNG['academy_title'][$academyId])){
			$this->printMessage('An error occured. Please try again or open a ticket with error number #Err2508', true, array('game.php?page=academy', 3));
		}		
		
		$userBranch  = 0;
		if($academyId > 1300){
			$userBranch  = 3;	
		}elseif($academyId > 1200){
			$userBranch  = 2;	
		}else{
			$userBranch  = 1;		
		}
		
		$sql	= 'SELECT * FROM %%ACADEMY%% WHERE skill_id = :academyId;';
		$academyDetail = database::get()->selectSingle($sql, array(
			':academyId'	=> $academyId
		));
		
		$NegativeArray = array(1104,1107,1112,1203,1310,1308);
		
		$academyAb2 = '';
		if($academyId == 1102)
			$academyAb2 = $LNG['academy_ab1'][1302];
		elseif($academyId == 1302)
			$academyAb2 = $LNG['academy_ab1'][1102];
			
		$this->tplObj->loadscript('pointes.js'); 
		$this->assign(array(
			'academyId'		=> $academyId,
			'academyTitle'	=> $LNG['academy_title'][$academyId],
			'academyAb1'	=> $LNG['academy_ab1'][$academyId],
			'academyAb2'	=> $academyAb2,
			'eLevel'		=> $USER["academy_p_b_".$userBranch."_".$academyId],
			'uPoints'		=> $USER['academy_p'] + $USER['academy_p_reset'],
			'ab1'			=> $academyDetail['ab1'],
			'ab2'			=> $academyDetail['ab2'],
			'plusvar'		=> in_array($academyId,$NegativeArray) ? '-' : '+',
			'plusvar1'		=> in_array($academyId,$NegativeArray) ? 'F90' : '0C0',
			'icost'			=> $academyDetail['icost'],
			'ufactor'		=> $academyDetail['factor'],
			'ucost'			=> calculation($academyId, $USER),
		));
		
		$this->display('page.academy.sklillup.tpl');
		
	}
	
	function show()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		/* if($USER['id'] != 1){
			$this->printMessage('under maintenance', true, array('game.php?page=overview', 2));
		} */
		
		if(!isset($_COOKIE['openV'])){
			$COKIE = 1;
			setcookie('openV','1');
		}else{
			$COKIE = $_COOKIE['openV']; 
		}
		
		if (isset($_POST['skill'])){
			$academyId   = HTTP::_GP('skill', 0);
			$count	     = HTTP::_GP('count', 0);
			$price		 = calculation($academyId, $USER, $count);
			
			$userBranch  = 0;
			if($academyId > 1300){
				$userBranch  = 3;	
			}elseif($academyId > 1200){
				$userBranch  = 2;	
			}else{
				$userBranch  = 1;		
			}
			
			if($USER['academy_p'] + $USER['academy_p_reset'] < $price || $price <= 0 || strlen($count) > 3 || !BuildFunctions::isTechnologieAcademy($USER, $PLANET, $academyId)){
				header('Location: https://'.$_SERVER['HTTP_HOST'].'/game.php?page=academy');	
			}else{
				$db	= Database::get();
				$Name = "academy_p_b_".$userBranch."_".$academyId;
				$Names = $USER[$Name];
				
				$account_before = array(
					$Name					=> $USER[$Name],
					'academy_p'				=> $USER['academy_p'],
					'academy_p_reset'		=> $USER['academy_p_reset'],
					'price'					=> $price,
				);
			
				if($USER['tutorial'] == 45 && $academyId == 1101 && ($count - $Names) >= 1){ 
					$db = Database::get();
					$sql =  "UPDATE %%USERS%% SET
					tutorial				= 46
					WHERE id = :userID;";
					$db->update($sql, array(
					':userID'			=> $USER['id']
					));
				}
				$sql	= "UPDATE %%USERS%% SET ".$Name." = ".$Name." + :userLevel, academy_p_b_".$userBranch." = academy_p_b_".$userBranch." + :academy_p_b_1 WHERE id = :userId;";
				$db->update($sql, array(
					':userLevel'		=> $count - $Names,
					':academy_p_b_1'	=> $price,
					':userId'			=> $USER['id']
				));
				widrawAP($price, $USER['id']);
				$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
				$getUser = $db->selectSingle($sql, array(
					':userId'		=> $USER['id'],
				));
			
				$account_after = array(
					$Name				=> $getUser[$Name],
					'academy_p'			=> $getUser['academy_p'],
					'academy_p_reset'	=> $getUser['academy_p_reset'],
					'price'				=> $price,
				);
				
				$LOG = new Logcheck(7);
				$LOG->username = $USER['username'];
				$LOG->pageLog = "page=academy [Academy Upgrade]";
				$LOG->old = $account_before;
				$LOG->new = $account_after;
				$LOG->save();
				header('Location: https://'.$_SERVER['HTTP_HOST'].'/game.php?page=academy');	
			}
		}
			
		$this->tplObj->loadscript('pointes.js'); 
		$this->assign(array(
			'aca_cost' => 50 - (50 / 100 * Config::get()->special_donation_academy),
			'showVid' => $COKIE,
			'AcPointsTotal' => $USER['academy_p'],
			'AcPoints' => $USER['academy_p'] + $USER['academy_p_reset'],
			'academy_p_b_1' => $USER['academy_p_b_1'],
			'academy_p_b_2' => $USER['academy_p_b_2'],
			'academy_p_b_3' => $USER['academy_p_b_3'],
			'academy_p_b_all' => $USER['academy_p_b_1'] + $USER['academy_p_b_2'] + $USER['academy_p_b_3'] - $USER['academy_p_b_2_1206']*500 - calculationCheck(1104, $USER) - calculationCheck(1310, $USER),
			'academy_p_b_all_bis' => $USER['academy_p_b_1'] + $USER['academy_p_b_2'] + $USER['academy_p_b_3'],
			'resetFree' => sprintf($LNG['academy_4'],'%', round(($USER['academy_p_b_1'] + $USER['academy_p_b_2'] + $USER['academy_p_b_3'] - $USER['academy_p_b_2_1206']*500 - calculationCheck(1104, $USER) - calculationCheck(1310, $USER)) / 2)),
			'reset75' => sprintf($LNG['academy_43'],'%', round(($USER['academy_p_b_1'] + $USER['academy_p_b_2'] + $USER['academy_p_b_3'] - $USER['academy_p_b_2_1206']*500 - calculationCheck(1104, $USER) - calculationCheck(1310, $USER)) / 100 * 25)),
			'reset100' => sprintf($LNG['academy_44'],'%', 0),
			'antimatter_bought'		=> $USER['antimatter_bought'],	
			'academy_p_b_1_1101' => $USER['academy_p_b_1_1101'],
			'academy_p_b_1_1102' => $USER['academy_p_b_1_1102'],
			'academy_p_b_1_1103' => $USER['academy_p_b_1_1103'],
			'academy_p_b_1_1104' => $USER['academy_p_b_1_1104'],
			'academy_p_b_1_1105' => $USER['academy_p_b_1_1105'],
			'academy_p_b_1_1106' => $USER['academy_p_b_1_1106'],
			'academy_p_b_1_1107' => $USER['academy_p_b_1_1107'],
			'academy_p_b_1_1108' => $USER['academy_p_b_1_1108'],
			'academy_p_b_1_1109' => $USER['academy_p_b_1_1109'],
			'academy_p_b_1_1110' => $USER['academy_p_b_1_1110'],
			'academy_p_b_1_1111' => $USER['academy_p_b_1_1111'],
			'academy_p_b_1_1112' => $USER['academy_p_b_1_1112'],
			'academy_p_b_1_1113' => $USER['academy_p_b_1_1113'],
			'academy_p_b_2_1201' => $USER['academy_p_b_2_1201'],
			'academy_p_b_2_1202' => $USER['academy_p_b_2_1202'],
			'academy_p_b_2_1203' => $USER['academy_p_b_2_1203'],
			'academy_p_b_2_1204' => $USER['academy_p_b_2_1204'],
			'academy_p_b_2_1205' => $USER['academy_p_b_2_1205'],
			'academy_p_b_2_1206' => $USER['academy_p_b_2_1206'],
			'academy_p_b_2_1207' => $USER['academy_p_b_2_1207'],
			'academy_p_b_2_1208' => $USER['academy_p_b_2_1208'],
			'academy_p_b_2_1209' => $USER['academy_p_b_2_1209'],
			'academy_p_b_2_1210' => $USER['academy_p_b_2_1210'],
			'academy_p_b_3_1301' => $USER['academy_p_b_3_1301'],
			'academy_p_b_3_1302' => $USER['academy_p_b_3_1302'],
			'academy_p_b_3_1303' => $USER['academy_p_b_3_1303'],
			'academy_p_b_3_1304' => $USER['academy_p_b_3_1304'],
			'academy_p_b_3_1305' => $USER['academy_p_b_3_1305'],
			'academy_p_b_3_1306' => $USER['academy_p_b_3_1306'],
			'academy_p_b_3_1307' => $USER['academy_p_b_3_1307'],
			'academy_p_b_3_1308' => $USER['academy_p_b_3_1308'],
			'academy_p_b_3_1309' => $USER['academy_p_b_3_1309'],
			'academy_p_b_3_1310' => $USER['academy_p_b_3_1310'],
			'academy_p_b_3_1311' => $USER['academy_p_b_3_1311'],
			'academy_p_b_3_1312' => $USER['academy_p_b_3_1312'],
			'academy_p_b_3_1313' => $USER['academy_p_b_3_1313'],
			'academy_p_b_3_1314' => $USER['academy_p_b_3_1314'],
			'academy_ab1_1101'   => academyBonus(1101, $USER),
			'academy_ab1_1102'   => academyBonus(1102, $USER),
			'academy_ab1_1103'   => academyBonus(1103, $USER),
			'academy_ab1_1104'   => academyBonus(1104, $USER),
			'academy_ab1_1105'   => academyBonus(1105, $USER),
			'academy_ab1_1106'   => academyBonus(1106, $USER),
			'academy_ab1_1107'   => academyBonus(1107, $USER),
			'academy_ab1_1108'   => academyBonus(1108, $USER),
			'academy_ab1_1109'   => academyBonus(1109, $USER),
			'academy_ab1_1110'   => academyBonus(1110, $USER),
			'academy_ab1_1111'   => academyBonus(1111, $USER),
			'academy_ab1_1112'   => academyBonus(1112, $USER),
			'academy_ab1_1113'   => academyBonus(1113, $USER),
			'academy_ab1_1201'   => academyBonus(1201, $USER),
			'academy_ab1_1202'   => academyBonus(1202, $USER),
			'academy_ab1_1203'   => academyBonus(1203, $USER),
			'academy_ab1_1204'   => academyBonus(1204, $USER),
			'academy_ab1_1205'   => academyBonus(1205, $USER),
			'academy_ab1_1206'   => academyBonus(1206, $USER),
			'academy_ab1_1207'   => academyBonus(1207, $USER),
			'academy_ab1_1208'   => academyBonus(1208, $USER),
			'academy_ab1_1209'   => academyBonus(1209, $USER),
			'academy_ab1_1210'   => academyBonus(1210, $USER),
			'academy_ab1_1301'   => academyBonus(1301, $USER),
			'academy_ab1_1302'   => academyBonus(1302, $USER),
			'academy_ab1_1303'   => academyBonus(1303, $USER),
			'academy_ab1_1304'   => academyBonus(1304, $USER),
			'academy_ab1_1305'   => academyBonus(1305, $USER),
			'academy_ab1_1306'   => academyBonus(1306, $USER),
			'academy_ab1_1307'   => academyBonus(1307, $USER),
			'academy_ab1_1308'   => academyBonus(1308, $USER),
			'academy_ab1_1309'   => academyBonus(1309, $USER),
			'academy_ab1_1310'   => academyBonus(1310, $USER),
			'academy_ab1_1311'   => academyBonus(1311, $USER),
			'academy_ab1_1312'   => academyBonus(1312, $USER),
			'academy_ab1_1313'   => academyBonus(1313, $USER),
			'academy_ab1_1314'   => academyBonus(1314, $USER),
			'academy_cost_1101'   => calculation(1101, $USER),
			'academy_cost_1102'   => calculation(1102, $USER),
			'academy_cost_1103'   => calculation(1103, $USER),
			'academy_cost_1104'   => calculation(1104, $USER),
			'academy_cost_1105'   => calculation(1105, $USER),
			'academy_cost_1106'   => calculation(1106, $USER),
			'academy_cost_1107'   => calculation(1107, $USER),
			'academy_cost_1108'   => calculation(1108, $USER),
			'academy_cost_1109'   => calculation(1109, $USER),
			'academy_cost_1110'   => calculation(1110, $USER),
			'academy_cost_1111'   => calculation(1111, $USER),
			'academy_cost_1112'   => calculation(1112, $USER),
			'academy_cost_1113'   => calculation(1113, $USER),
			'academy_cost_1201'   => calculation(1201, $USER),
			'academy_cost_1202'   => calculation(1202, $USER),
			'academy_cost_1203'   => calculation(1203, $USER),
			'academy_cost_1204'   => calculation(1204, $USER),
			'academy_cost_1205'   => calculation(1205, $USER),
			'academy_cost_1206'   => calculation(1206, $USER),
			'academy_cost_1207'   => calculation(1207, $USER),
			'academy_cost_1208'   => calculation(1208, $USER),
			'academy_cost_1209'   => calculation(1209, $USER),
			'academy_cost_1210'   => calculation(1210, $USER),
			'academy_cost_1301'   => calculation(1301, $USER),
			'academy_cost_1302'   => calculation(1302, $USER),
			'academy_cost_1303'   => calculation(1303, $USER),
			'academy_cost_1304'   => calculation(1304, $USER),
			'academy_cost_1305'   => calculation(1305, $USER),
			'academy_cost_1306'   => calculation(1306, $USER),
			'academy_cost_1307'   => calculation(1307, $USER),
			'academy_cost_1308'   => calculation(1308, $USER),
			'academy_cost_1309'   => calculation(1309, $USER),
			'academy_cost_1310'   => calculation(1310, $USER),
			'academy_cost_1311'   => calculation(1311, $USER),
			'academy_cost_1312'   => calculation(1312, $USER),
			'academy_cost_1313'   => calculation(1313, $USER),
			'academy_cost_1314'   => calculation(1314, $USER),
		));
		
		$this->display('page.academy.default.tpl');
	}
}
