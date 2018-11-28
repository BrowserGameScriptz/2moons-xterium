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

class ShowSharePage extends AbstractGamePage
{
	public static $requireModule = MODULE_BUDDYLIST;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show()
	{
		global $USER, $resource, $LNG;
		
		$BattleArray			= array();
		$fleetId = array(202,203,204,205,229,209,206,207,217,215,213,211,224,219,225,226,214,216,230,227,228,222,218,221);
		
		$this->tplObj->loadscript('sharegain.js');
		$this->assign(array(
		'fleetList'		=> $fleetId,
		'battleinput'	=> $BattleArray,
		'RID'			=> "",
		'NSIDE'			=> 1,
		'i'				=> 2,
		't'				=> 2,
		'display'		=> 1,
		));
		
		$this->display('page.sharegain.default.tpl');
	}
	
	function automated()
	{
		global $USER, $resource, $LNG;
		
		$RID			= HTTP::_GP('nrid', '');
		$NSIDE			= HTTP::_GP('nside', 1);
		
		$allowedArray = array(1,2);
		if(!in_array($NSIDE,$allowedArray))
			$this->printMessage($LNG['moon_hack'], true, array('game.php?page=share', 3));
		
		$N_SIDE = 'attacker';
		if($NSIDE == 2)
			$N_SIDE = 'defender';
		
		if(empty($RID)){
		$this->printMessage('You have to enter the battle RID', true, array('game.php?page=share', 2));
		}
		
		$sql = "SELECT 
			raport, time,
			(
				SELECT
				GROUP_CONCAT(username SEPARATOR ' & ') as attacker
				FROM %%USERS%%
				WHERE id IN (SELECT uid FROM %%TOPKB_USERS%% WHERE %%TOPKB_USERS%%.rid = %%RW%%.rid AND role = 1)
			) as attacker,
			(
				SELECT
				GROUP_CONCAT(username SEPARATOR ' & ') as defender
				FROM %%USERS%%
				WHERE id IN (SELECT uid FROM %%TOPKB_USERS%% WHERE %%TOPKB_USERS%%.rid = %%RW%%.rid AND role = 2)
			) as defender
			FROM %%RW%%
			WHERE rid = :reportID;";
		$reportData = database::get()->selectSingle($sql, array(
			':reportID'	=> $RID
		));
		
		if(empty($reportData)){
		$this->printMessage('The battle report is not found !', true, array('game.php?page=share', 2));
		}
		$BattleArray			= array();
		$combatReport			= unserialize($reportData['raport']);
		$combatReport			= $this->BCWrapperPreRev2321($combatReport);
		$fleetId = array(202,203,204,205,229,209,206,207,217,215,213,211,224,219,225,226,214,216,230,227,228,222,218,221);
		$i = 1;
		$t = 0;
		
		foreach($combatReport['rounds'] as $Round => $RoundInfo){
			
			foreach($RoundInfo[$N_SIDE] as $Player){
				
				if($Round < 1){
					$PlayerInfo = $combatReport['players'][$Player['userID']];
					$BattleArray[$i]['name']	= $PlayerInfo['name'];
					$t++;
				}
				
				foreach($Player['ships'] as $ShipID => $ShipData){
					
					$BattleArray[$i][$ShipID] = 0;
			
					if(in_array($ShipID,$fleetId))
						$BattleArray[$i][$ShipID]	+= floor($ShipData[4]);					
				}	
				$i++;
			}
		
		}
		$this->tplObj->loadscript('sharegain.js');
		$this->tplObj->execscript('caculer_perte();calculer_gain_par_attaquant_apres_pillage();calculer_fin();');
		$this->assign(array(
			'battleinput'	=> $BattleArray,
			'fleetList'		=> $fleetId,
			'RID'			=> $RID,
			'NSIDE'			=> $NSIDE,
			'i'				=> $i,
			't'				=> $t,
			'display'		=> 2,
		));
		
		$this->display('page.sharegain.default.tpl');
	}
	
	function BCWrapperPreRev2321($combatReport)
	{
		if(isset($combatReport['moon']['desfail']))
		{
			$combatReport['moon']	= array(
				'moonName'				=> $combatReport['moon']['name'],
				'moonChance'			=> $combatReport['moon']['chance'],
				'moonDestroySuccess'	=> !$combatReport['moon']['desfail'],
				'fleetDestroyChance'	=> $combatReport['moon']['chance2'],
				'fleetDestroySuccess'	=> !$combatReport['moon']['fleetfail']
			);				
		}
		elseif(isset($combatReport['moon'][0]))
		{
			$combatReport['moon']	= array(
				'moonName'				=> $combatReport['moon'][1],
				'moonChance'			=> $combatReport['moon'][0],
				'moonDestroySuccess'	=> !$combatReport['moon'][2],
				'fleetDestroyChance'	=> $combatReport['moon'][3],
				'fleetDestroySuccess'	=> !$combatReport['moon'][4]
			);			
		}
	
		if(isset($combatReport['simu']))
		{
			$combatReport['additionalInfo'] = $combatReport['simu'];
		}
	
		if(isset($combatReport['debris'][0]))
		{
			$combatReport['debris'] = array(
				901	=> $combatReport['debris'][0],
				902	=> $combatReport['debris'][1]
			);
		}
		
		if (!empty($combatReport['steal']['metal']))
		{
			$combatReport['steal'] = array(
				901	=> $combatReport['steal']['metal'],
				902	=> $combatReport['steal']['crystal'],
				903	=> $combatReport['steal']['deuterium']
			);
		}
		
		return $combatReport;
	}
	
}