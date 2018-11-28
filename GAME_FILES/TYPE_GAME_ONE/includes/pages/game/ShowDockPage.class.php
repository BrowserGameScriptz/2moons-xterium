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

class ShowDockPage extends AbstractGamePage
{
	public static $requireModule = 0;

	private $Builded		= array();
	
	function __construct() 
	{
		parent::__construct();
	}
	
	function startWreck(){
		
		global $LNG, $USER, $PLANET;
		
		$wreckID			= HTTP::_GP('wreckID', 0);
		$wreckData		   	= GetFromDatabase('WRECKS', 'wreckID', $wreckID, array('userID', 'planetID', 'inBuild'));
		
		if(!isset($wreckData) || $wreckData['planetID'] != $PLANET['id'] || $wreckData['userID'] != $USER['id'] || $wreckData['inBuild'] == 1){
			$message = $LNG['moon_hack'];
		}else{
			$sql = "UPDATE %%WRECKS%% SET inBuild = 1, startBuildTime = :startBuildTime, lastUpdate = :startBuildTime, lastRepaired = :lastRepaired WHERE wreckID = :wreckID;";
			database::get()->update($sql, array(
				':startBuildTime'		=> TIMESTAMP,
				':lastRepaired'		=> TIMESTAMP + 30*60,
				':wreckID'		=> $wreckID
			));
			$message = $LNG['docking_11'];
		}

		$this->sendJSON(array('message' => $message, 'ok' => true));	
	}
	
	function deleteWreck(){
		
		global $LNG, $USER, $PLANET;
		
		$wreckID			= HTTP::_GP('wreckID', 0);
		$wreckData		   	= GetFromDatabase('WRECKS', 'wreckID', $wreckID, array('userID', 'planetID', 'inBuild', 'possibleDeletion'));
		
		if(!isset($wreckData) || $wreckData['planetID'] != $PLANET['id'] || $wreckData['userID'] != $USER['id'] || $wreckData['inBuild'] == 1 && $wreckData['possibleDeletion'] == 0){
			$message = $LNG['moon_hack'];
		}else{
			$sql = "UPDATE %%WRECKS%% SET deleted = :deleted WHERE wreckID = :wreckID;";
			database::get()->update($sql, array(
				':deleted'		=> TIMESTAMP,
				':wreckID'		=> $wreckID
			));
			$message = $LNG['docking_12'];
		}

		$this->sendJSON(array('message' => $message, 'ok' => true));	
	}
	
	function repairWreck(){
		
		global $LNG, $USER, $PLANET, $resource;
		
		$wreckID			= HTTP::_GP('wreckID', 0);
		$wreckData		   	= GetFromDatabase('WRECKS', 'wreckID', $wreckID, array('userID', 'planetID', 'inBuild', 'wreck_array', 'lastRepaired'));
		
		if(!isset($wreckData) || $wreckData['planetID'] != $PLANET['id'] || $wreckData['userID'] != $USER['id'] || $wreckData['inBuild'] == 0 || $wreckData['lastRepaired'] > TIMESTAMP){
			$message = $LNG['moon_hack'];
		}else{
	
			$BuildQueue		= explode(';', $wreckData['wreck_array']);
			$BuildArray					= array();
			$fleetDit		= array();
			foreach($BuildQueue as $Item)
			{
				$temp = explode(',', $Item);
				$BuildArray[] 		= array($temp[0], $temp[1], $temp[2]);
			}
			
			$NewQueue	= array();
			$Done		= false;
			foreach($BuildArray as $Item)
			{
				$Element   = $Item[0];
				$Rebuild     = $Item[1];
				$Count     = $Item[2];
				if($Done == false) {
					$Element   = (int)$Element;	
					
					$PLANET[$resource[$Element]]	+= $Rebuild;
					$sql = "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :Rebuild WHERE id = :planetId;";
					database::get()->update($sql, array(
						':Rebuild'	=> $Rebuild,
						':planetId'		=> $PLANET['id']
					));
					$Count								-= $Rebuild;
					$Rebuild							= 0;
				}	
				if($Count > 0)
					$NewQueue[]	= $Element.','.$Rebuild.','.floatToString($Count);
			}
			
			$sql = "UPDATE %%WRECKS%% SET wreck_array = :wreck_array, isFinished = :isFinished, lastRepaired = :lastRepaired WHERE wreckID = :wreckID;";
			database::get()->update($sql, array(
				':wreck_array'	=> !empty($NewQueue) ? implode(';', $NewQueue) : '',
				':isFinished'	=> !empty($NewQueue) ? 0 : 1,
				':lastRepaired'	=> TIMESTAMP + 30*60,
				':wreckID'		=> $wreckID
			));
			
			
			$message = $LNG['docking_13'];
		}

		$this->sendJSON(array('message' => $message, 'ok' => true));	
	}
	
	function instantWreck(){
		
		global $LNG, $USER, $PLANET, $resource;
		
		$wreckID			= HTTP::_GP('wreckID', 0);
		$wreckData		   	= GetFromDatabase('WRECKS', 'wreckID', $wreckID, array('userID', 'planetID', 'inBuild', 'wreck_array', 'lastRepaired', 'expiredTime'));
		
		if(!isset($wreckData) || $wreckData['planetID'] != $PLANET['id'] || $wreckData['userID'] != $USER['id'] || $wreckData['inBuild'] == 1){
			$message = $LNG['moon_hack'];
		}else{
	
			$BuildQueue		= explode(';', $wreckData['wreck_array']);
			$BuildArray					= array();
			$thisTime = TIMESTAMP; // Current time
			$diffTime = ($wreckData['expiredTime']-$thisTime); // Difference in time
			foreach($BuildQueue as $Item)
			{
				$temp = explode(',', $Item);
				$BuildArray[] 		= array($temp[0], $temp[1], $temp[2]);
			}
			
			$NewQueue	= array();
			$Done		= false;
			$price		= 0;
			foreach($BuildArray as $Item)
			{
				$Element   = $Item[0];
				$Rebuild     = $Item[1];
				$Count     = $Item[2];
				
				$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $Element);
				$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $Element, $costResources);
				$elementTime    	/= 2;
				
				$totalBuildTimeTry = $elementTime*$Count;
				
			
				if($diffTime > $totalBuildTimeTry){
					
					$Element   = (int)$Element;	
					
					$costInstant		= BuildFunctions::getElementPriceDM($USER, $PLANET, $Element);
					$costInstant	= round($costInstant[921] / 100 * 30)*$Count;
					$price				+= $costInstant;
					
					$PLANET[$resource[$Element]]	+= $Count;
					$sql = "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :Rebuild WHERE id = :planetId;";
					database::get()->update($sql, array(
						':Rebuild'	=> $Count,
						':planetId'		=> $PLANET['id']
					));
					$Count								-= $Count;
					$Rebuild							= 0;
				}	
				if($Count > 0)
					$NewQueue[]	= $Element.','.$Rebuild.','.floatToString($Count);
			}
			
			$USER['darkmatter']	-= $price;
			
			$sql = "UPDATE %%WRECKS%% SET wreck_array = :wreck_array, isFinished = :isFinished, possibleDeletion = :possibleDeletion WHERE wreckID = :wreckID;";
			database::get()->update($sql, array(
				':wreck_array'	=> !empty($NewQueue) ? implode(';', $NewQueue) : '',
				':isFinished'	=> !empty($NewQueue) ? 0 : 1,
				':possibleDeletion'	=> 1,
				':wreckID'		=> $wreckID
			));
			
			
			$message = 'The instant reparation is successfully finished';
		}

		$this->sendJSON(array('message' => $message, 'ok' => true));	
	}
	
	function show()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		if($PLANET['planet_type'] != 1){
			$this->printMessage('You can only visit this page on a planet', true, array('game.php?page=overview', 2));
		}
			
		$db	= Database::get();
		$WRECKSSTATUS = 0;
		$sql = "SELECT * FROM %%WRECKS%% WHERE planetID = :planetID AND expiredTime > :expiredTime AND deleted = 0 AND isFinished = 0 ORDER BY startTime ASC LIMIT 1;";
		$WRECKS	= $db->selectSingle($sql, array(
			':planetID'		=> $PLANET['id'],
			':expiredTime'	=> TIMESTAMP
		));
		
		if($WRECKS['inBuild'] == 1 && !empty($WRECKS['wreck_array'])){
			$WRECKSSTATUS = 1;
		}
		
		$WRECKSLIST			= array();	
		$totalBuildTime = 0;
		$buttonDisabled = 0;
		$totalInBuildAllowed = 0;
		$price = 0;
		if(!empty($WRECKS['wreck_array'])){
		
		$fleetTyps		= explode(';', $WRECKS['wreck_array']);

		$fleetAmount	= array();
		$wreckAmount	= array();
		
		$thisTime = time(); // Current time
		$diffTime = ($WRECKS['expiredTime']-$thisTime); // Difference in time
		foreach ($fleetTyps as $fleetTyp)
		{
			$temp = explode(',', $fleetTyp);
			
			if (empty($temp[0])) continue;

			if (!isset($fleetAmount[$temp[0]]))
			{
				$fleetAmount[$temp[0]] = 0;
				$wreckAmount[$temp[0]] = 0;
			}

			$fleetAmount[$temp[0]] += $temp[2];
			$wreckAmount[$temp[0]] += $temp[1];
			
			$costResources		= BuildFunctions::getElementPrice($USER, $PLANET, $temp[0]);
			$elementTime    	= BuildFunctions::getBuildingTime($USER, $PLANET, $temp[0], $costResources);
			$elementTime    	/= 2;
			$totalBuildTimeTry = $elementTime*($fleetAmount[$temp[0]]-$wreckAmount[$temp[0]]);
			
			$costInstant		= BuildFunctions::getElementPriceDM($USER, $PLANET, $temp[0]);
			$costInstant	= round($costInstant[921] / 100 * 30)*$fleetAmount[$temp[0]];
			
			if($diffTime > $totalBuildTimeTry)
				$price				+= $costInstant;
			
			if($totalBuildTime < $totalBuildTimeTry && $diffTime > $elementTime*$fleetAmount[$temp[0]])
				$totalBuildTime = $totalBuildTimeTry;
			
			if($diffTime > $totalBuildTimeTry || $temp[1] == $temp[2])
				$totalInBuildAllowed++;
				
			
			
			$WRECKSLIST[$temp[0]]	= array(
				'fleetAmount'		=> $fleetAmount[$temp[0]],
				'RebuildList'		=> $wreckAmount[$temp[0]],
				'BuildTime'			=> $elementTime*$fleetAmount[$temp[0]],
			);
			$buttonDisabled += $temp[1];
		}
	
		}
		
		if($WRECKS['lastRepaired'] > TIMESTAMP)
			$buttonDisabled = 0;

		if(!isset($diffTime))
			$diffTime = 0;
		
		$i_restantes = $diffTime / 60; // Minutes restantes
		$H_restantes = $i_restantes / 60; // Heures restantes
		$d_restants = $H_restantes / 24; // Jours restants
		
		$s_restantes = floor($diffTime % 60); // Secondes restantes
		$i_restantes = floor($i_restantes % 60); // Minutes restantes
		$H_restantes = floor($H_restantes % 24); // Heures restantes
		$d_restants = floor($d_restants); // Jours restants
		
		$ISALLOWEDTODESTROY = 0;
		$ISACTIVE = !empty($WRECKS['wreck_array']) ? 1 : 0;
		if($WRECKS['inBuild'] == 0 && !empty($WRECKS['wreck_array']) || $totalInBuildAllowed == 0 && $WRECKS['inBuild'] == 1 && !empty($WRECKS['wreck_array'])){
			$ISALLOWEDTODESTROY = 1;
			$sql = "UPDATE %%WRECKS%% SET possibleDeletion = :possibleDeletion WHERE wreckID = :wreckID;";
			database::get()->update($sql, array(
				':possibleDeletion'	=> 1,
				':wreckID'		=> $WRECKS['wreckID']
			));
		}elseif($totalInBuildAllowed != 0 && $WRECKS['inBuild'] == 1 && $WRECKS['possibleDeletion'] == 1){
			$ISALLOWEDTODESTROY = 0;
			$sql = "UPDATE %%WRECKS%% SET possibleDeletion = :possibleDeletion WHERE wreckID = :wreckID;";
			database::get()->update($sql, array(
				':possibleDeletion'	=> 0,
				':wreckID'		=> $WRECKS['wreckID']
			));			
		}
		
		$this->tplObj->loadscript('wrecked.js'); 	
		$this->assign(array(
			'totalInBuildAllowed'		=> $totalInBuildAllowed,
			'DIFFTIME'		=> $diffTime,
			'PRICE'			=> $price,
			'WRECKSLIST'	=> $WRECKSLIST,
			'WRECKSTATUS'	=> $WRECKSSTATUS,
			'TOTALBUILDTIM'	=> $totalBuildTime,
			'DISABLED'		=> $buttonDisabled,
			'EXPIREDTIME'	=> !empty($WRECKS['wreck_array']) ? $d_restants.'d '.$H_restantes.'h '.$i_restantes.'m' : $LNG['docking_14'],
			'WRECKID'		=> $WRECKS['wreckID'],
			'ISACTIVE'		=> !empty($WRECKS['wreck_array']) && $totalInBuildAllowed > 0 ? 1 : 0,
			'ISACTIVEBIS'		=> !empty($WRECKS['wreck_array']) && $totalInBuildAllowed > 0 && $USER['darkmatter'] >= $price? 1 : 0,
			'ISALLOWEDTODESTROY'		=> $ISALLOWEDTODESTROY,
		));
		
		$this->display('page.dock.default.tpl');
	}
}
