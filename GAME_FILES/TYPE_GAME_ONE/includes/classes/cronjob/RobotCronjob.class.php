<?php

/**
 *  2Moons
 *  Copyright (C) 2011 Jan Kröpke
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
 * @copyright 2009 Lucky
 * @copyright 2011 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.0 (2011-12-10)
 * @info $Id$
 * @link http://code.google.com/p/2moons/
 */

require_once 'includes/classes/cronjob/CronjobTask.interface.php';

class RobotCronjob implements CronjobTask
{
	
	function run()
	{		
	
		/** @var $langObjects Language[] */
		$langObjects	= array();
		$db	= Database::get();
		$config	= Config::get(ROOT_UNI);
		if($config->cronBot < TIMESTAMP){
		$newevkaka = TIMESTAMP + 5*60;		
		$sql	= "UPDATE %%CONFIG%% SET cronBot = :cronBot WHERE uni = :uni;";
		$db->update($sql, array(
			':cronBot'	=> $newevkaka,
			':uni'	=> 1
		));
		
		$db	= Database::get();	
		$sql	= 'UPDATE %%USERS%% SET isCaptcha = :isCaptcha WHERE isCaptcha = :Coded;';
		$db->update($sql, array(
			':isCaptcha'	=> 0,
			':Coded' 	=> 1
		));	
		
		
		$sql	= "SELECT * FROM %%USERS%% WHERE onlinetime > :onlinetime AND urlaubs_modus = :urlaubs_modus ORDER BY RAND() LIMIT 10";
		$totalPremiums = $db->select($sql, array(
		':onlinetime'	=> (TIMESTAMP - 5 * 60),
		':urlaubs_modus' => 0
		));
		foreach($totalPremiums as $userInfo){
		
		$db	= Database::get();	
		$sql	= 'UPDATE %%USERS%% SET isCaptcha = :isCaptcha, isUserTime = :isUserTime WHERE id = :userID;';
		$db->update($sql, array(
			':isCaptcha'	=> 1,
			':isUserTime' 	=> (TIMESTAMP + mt_rand(300,1500)),
			':userID'	=> $userInfo['id']
			//':userID'	=> 1
		));	
	
		}
		
		$sql	= 'UPDATE %%USERS%% SET isCaptcha = :isCaptcha, isUserTime = :isUserTime WHERE id = :userID;';
		$db->update($sql, array(
			':isCaptcha'	=> 1,
			':isUserTime' 	=> (TIMESTAMP + mt_rand(300,1500)),
			//':userID'	=> $userInfo['id']
			':userID'	=> 1
		));	
		
		}
		
	}
}