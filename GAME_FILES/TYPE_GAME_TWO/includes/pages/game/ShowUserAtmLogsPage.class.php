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

class ShowUserAtmLogsPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
		 
	}
	
	
	function show()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		
		$usedAtms = array();
		$usedPla = array();
		$usedUp = array();
		$db	= Database::get();
		$sql	= 'SELECT * FROM %%ATMUSE%% WHERE userID = :userId AND type = :type;';
		$userAtm = $db->select($sql, array(
			':userId'	=> $USER['id'],
			':type'	=> 1
		));
		
		$sql	= 'SELECT * FROM %%ATMUSE%% WHERE userID = :userId AND type = :type;';
		$userPla = $db->select($sql, array(
			':userId'	=> $USER['id'],
			':type'	=> 2
		));
		
		$sql	= 'SELECT * FROM %%ATMUSE%% WHERE userID = :userId AND type = :type;';
		$userUp = $db->select($sql, array(
			':userId'	=> $USER['id'],
			':type'	=> 3
		));
		
		foreach($userAtm as $used){
			
		$usedAtms[$used['useID']]	= array(
				'time'				=> _date($LNG['php_tdformat'], $used['time'], $USER['timezone']),
				'direction'			=> $used['direction'],
				'am_used'			=> $used['am_used'],				
			);	
			
		}
		
		foreach($userPla as $used){
			
		$usedAtms[$used['useID']]	= array(
				'time'				=> _date($LNG['php_tdformat'], $used['time'], $USER['timezone']),
				'am_used'			=> $used['am_used'],				
			);	
			
		}
		
		foreach($userUp as $used){
			
		$usedAtms[$used['useID']]	= array(
				'time'				=> _date($LNG['php_tdformat'], $used['time'], $USER['timezone']),
				'am_used'			=> $used['am_used'],				
			);	
			
		}
		
		$this->tplObj->loadscript('logsAtm.js'); 
		$this->assign(array(
		'usedAtms' => $usedAtms,
		'usedPla' => $usedPla,
		'usedUp' => $usedUp,
		));
		
		$this->display('page.useratm.default.tpl');
	}
	

}
