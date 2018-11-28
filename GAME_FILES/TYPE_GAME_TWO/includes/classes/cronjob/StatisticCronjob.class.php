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

class StatisticCronjob implements CronjobTask
{
	function run()
	{
		
		if(Config::get()->stat_last_update < TIMESTAMP){
		require 'includes/classes/class.statbuilder.php';
		$stat	= new Statbuilder();
		$stat->MakeStats();
		
		$sql	= 'UPDATE %%CONFIG%% SET `stat_last_update` = :times;';
		Database::get()->update($sql, array(
		':times'	=> TIMESTAMP + 2 * 60
		));
		
		$sql	= "SELECT * FROM %%STATPOINTS%% WHERE id_ally = :id_ally AND total_points >= :points";
		$totalPremiums = Database::get()->select($sql, array(
			':points' 	=> config::get()->xteriumPoints,
			':id_ally' 	=> config::get()->xteriumAllyId
		));
		foreach($totalPremiums as $userInfo){
			$sql	= 'UPDATE %%USERS%% SET ally_id = 0, ally_register_time = 0, ally_register_time = 5 WHERE id = :UserID;';
			Database::get()->update($sql, array(
			':UserID'			=> $userInfo['id_owner']
			));
			
			$sql	= "UPDATE %%STATPOINTS%% SET id_ally = 0 WHERE id_owner = :UserID AND stat_type = 1;";
			Database::get()->update($sql, array(
			':UserID'			=> $userInfo['id_owner']
			));

			$sql	= "UPDATE %%ALLIANCE%% SET ally_members = (SELECT COUNT(*) FROM %%USERS%% WHERE ally_id = :AllianceID) WHERE id = :AllianceID;";
			Database::get()->update($sql, array(
			':AllianceID'			=> $userInfo['id_ally']
			));
			
		}	
		}
	}
}