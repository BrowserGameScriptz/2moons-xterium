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

class DmrefundCronjob implements CronjobTask
{
	function run()
	{
		$this->rewardDm();
	}
	
	function rewardDm()
	{
		
		$sql	= "SELECT DISTINCT id, lang, username FROM %%USERS%%;";
		$totalUsers = database::get()->select($sql, array(
		));
		
		foreach($totalUsers as $userInfo){
			$sql = 'SELECT SUM(darkAmount) as total FROM uni1_darkmatter_logs WHERE userId = :userId;';
			$getDarkmatterUsed	= database::get()->selectSingle($sql, array(
				':userId'		=> $userInfo['id'],
			)); 
			
			if(floor($getDarkmatterUsed['total'] / 100 * 30) < 1)
				continue;
			
			$sql = 'UPDATE %%USERS%% SET darkmatter = darkmatter + :darkmatter WHERE id = :userId;';
			database::get()->update($sql, array(
				':darkmatter'	=> floor($getDarkmatterUsed['total'] / 100 * 30),
				':userId'		=> $userInfo['id'],
			)); 
			
			$sql = 'DELETE FROM uni1_darkmatter_logs WHERE userId = :userId;';
			database::get()->delete($sql, array(
				':userId'		=> $userInfo['id'],
			)); 
			
			$text = 'Darkmatter refund succesfull. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($getDarkmatterUsed['total'] / 100 * 30).'</span> darkmatter have been credited to your account.';
			PlayerUtil::sendMessage($userInfo['id'], 1, 'Game Developer', 4, 'Darkmatter Refund Event', $text, TIMESTAMP);
		}
	}
}
