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

class ShowArsenalPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
	}
	
	
	function send()
	{
		global $LNG, $resource, $USER, $PLANET, $reslist, $pricelist;
		
		$greid 			= HTTP::_GP('greid', '', UTF8_SUPPORT);
		$count 			= max(0,min(50,HTTP::_GP('count', 0)));
		$ajax 			= HTTP::_GP('ajax', 0);
		$arsenalSuccess	= 0;
		
		
		$msg = $LNG['customm_37'];
		if($_SERVER['REQUEST_METHOD'] === 'POST' && $ajax == 1){	
			for($i = 1; $i <= $count; $i++)
			{		
				$sql	= "SELECT arsenal_".$greid."_level, arsenal_".$greid."_chance, arsenal_".$greid." FROM %%USERS%% WHERE id = :userId;";
				$USERT	= Database::get()->selectSingle($sql, array(
				':userId'	=> $USER['id']
				));
			
				$start 			= 1;
				$userLevel 		= $USERT['arsenal_'.$greid.'_level'];
				$userChance 	= $USERT['arsenal_'.$greid.'_chance'];
				$userRow	 	= 'arsenal_'.$greid.'_level';
				$userRowA	 	= 'arsenal_'.$greid;
				$userRowC	 	= 'arsenal_'.$greid.'_chance';
				$userRowB	 	= $USERT['arsenal_'.$greid];
				$userMaxChance 	= mt_rand(0,100);
				
				if($userRowB  == 0){
					$msg = sprintf($LNG['customm_33'], $arsenalSuccess);
				}elseif(($userLevel + 1 > config::get()->arsenalUpdate)){
					$msg = sprintf("Max level reached !\n".$LNG['customm_33'], $arsenalSuccess);
					break;
				}elseif($userLevel < 10){
					$arsenalSuccess++;
					$sql	= "UPDATE %%USERS%% SET ".$userRow." = :userLevel + 1, ".$userRowA." = :userRowB - 1 WHERE id = :userId;";
					database::get()->update($sql, array(
						':userLevel'	=> $userLevel,
						':userRowB'		=> $userRowB,
						':userId'		=> $USER['id'],
					));
					$msg = sprintf($LNG['customm_33'], $arsenalSuccess);
				}elseif($userMaxChance < $userChance){
					$arsenalSuccess++;
					$sql	= "UPDATE %%USERS%% SET ".$userRow." = :userLevel + 1, ".$userRowA." = :userRowB - 1, ".$userRowC." = :userChance WHERE id = :userId;";
					Database::get()->update($sql, array(
						':userLevel'	=> $userLevel,
						':userRowB'		=> $userRowB,
						':userChance'	=> max(65,$userChance - 0.3),
						':userId'		=> $USER['id']
					));
					$msg = sprintf($LNG['customm_33'], $arsenalSuccess);
				}else{
					$sql	= "UPDATE %%USERS%% SET ".$userRowA." = :userRowB - 1, ".$userRowC." = :failchance WHERE id = :userId;";
					Database::get()->update($sql, array(
						':userRowB'		=> $userRowB,
						':failchance'	=> min(100,$userChance + 0.3),
						':userId'		=> $USER['id'],
						
					));
					
					$msg = sprintf($LNG['customm_33'], $arsenalSuccess);
					//$i = $count;
					//$arsenal_level = 0;
				}
			}
		
			$PlanetRess	= new ResourceUpdate();
			list($USER, $PLANET)	= $PlanetRess->CalcResource($USER, $PLANET, true);
		
			echo $msg;
		}else{
			echo "An error occured. Please try again ...";
		}
	}
	
	
	function show()
	{
		global $LNG, $resource, $USER, $PLANET, $reslist, $pricelist;
		
		//if($USER['id'] != 1)
			//$this->printMessage('This page is currently closed', true, array('game.php?page=overview', 3));
		
		$ArsenalList	= array();
		$ArsenalId	= array(801,805,802,806,804,807,803,808,811,809,812,810,813,814,815,816,817,818,819);
		foreach($ArsenalId as $Element)
		{
			$CustomVar = explode("_", $resource[$Element]);
			$ArsenalList[$Element]	= array(
				'id'				=> $Element,
				'CustomVar'			=> $CustomVar[1],
				'avaible'			=> $USER[$resource[$Element]],
				'level'				=> $USER[$resource[$Element].'_level'],
				'chance'			=> round($USER[$resource[$Element].'_chance'],2),
				'bonusLevel'		=> $pricelist[$Element]['arsenal_bonus'] * $USER[$resource[$Element].'_level'],
				'arsenal_bonus'		=> $pricelist[$Element]['arsenal_bonus'],
				
			);
		}
		
		$this->tplObj->loadscript('arsenal.js'); 
		$this->assign(array(
			'ArsenalList'		=> $ArsenalList,
			'maxArsenal'		=> config::get()->arsenalUpdate,
		));
		
		$this->display('page.arsenal.default.tpl');
	}
}
