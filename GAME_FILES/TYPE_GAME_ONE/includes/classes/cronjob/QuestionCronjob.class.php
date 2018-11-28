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

class QuestionCronjob implements CronjobTask
{
	
	function run()
	{		
	
		/** @var $langObjects Language[] */
		$langObjects	= array();
		$db	= Database::get();
		$config	= Config::get(ROOT_UNI);
		if($config->question_event < TIMESTAMP){
		$newevkaka = TIMESTAMP + 5*60;		
		$sql	= "UPDATE %%CONFIG%% SET question_event = :question_event WHERE uni = :uni;";
		$db->update($sql, array(
			':question_event'	=> $newevkaka,
			':uni'	=> 1
		));
		$sql	= "SELECT DISTINCT id, lang FROM %%USERS%%";
		$totalPremiums = $db->select($sql, array(
		));
		foreach($totalPremiums as $userInfo){
			
			if(!isset($langObjects[$userInfo['lang']]))
			{
				$langObjects[$userInfo['lang']]	= new Language($userInfo['lang']);
				$langObjects[$userInfo['lang']]->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
			}
			
			$LNG	= $langObjects[$userInfo['lang']];
			
			$message = '<span class="admin">'.$LNG['custom_question'].'
			</span>';			
			PlayerUtil::sendMessage($userInfo['id'], '', 'Event System', 50, 'Event Info', $message, TIMESTAMP);
		}
		
		}
		
	}
}