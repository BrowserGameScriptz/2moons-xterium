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

class AsteroidCronjob implements CronjobTask
{
	
	function randRange($min, $max, $count)
	{
		$range = array();
		$i=0;
		while($i++ < $count){
		while(in_array($num = mt_rand($min, $max), $range)){}
		$range[] = $num;
		}
		return $range;
	}
		
		
	function run()
	{		
		/** @var $langObjects Language[] */
		$langObjects	= array();
		$db	= Database::get();
		$config	= Config::get(ROOT_UNI);
		if($config->asteroid_event < TIMESTAMP){
			$newevkaka = TIMESTAMP + 5*60;		
			$sql	= "UPDATE %%CONFIG%% SET asteroid_event = :asteroid_event, asteroidRound = asteroidRound + 1 WHERE uni = :uni;";
			$db->update($sql, array(
				':asteroid_event'	=> $newevkaka,
				':uni'	=> 1
			));
			$sql	= "DELETE FROM %%PLANETS%% WHERE id_owner = :id_owner && gal6mod = 0;";
			$db->delete($sql, array(
				':id_owner'	=> NULL
			));
			
			$Example1 = 0;
			$Example2 = 0;
			$Example3 = 0;
			
			$galaxy = $this->randRange(1,6,6);
			foreach($galaxy as $Element){
				$system = $this->randRange(1,200,80);
				foreach($system as $System_Element){
					$planets = rand(1,20);
					
					$sql	= "SELECT * FROM %%PLANETS%% WHERE galaxy = :galaxy AND system = :system AND planet = :planet AND universe = :universe;";
					$cautare = $db->select($sql, array(
						':galaxy'	=> $Element,
						':system'	=> $System_Element,
						':planet'	=> $planets,
						':universe'	=> 1
					));
					if(count($cautare)==0){
						$metal_rand = $config->asteroid_metal + round($config->asteroid_metal / 100 * (1*$config->asteroidRound));
						$crystal_rand = $config->asteroid_crystal + round($config->asteroid_crystal / 100 * (1*$config->asteroidRound));
						$deuterium_rand= $config->asteroid_deuterium + round($config->asteroid_deuterium / 100 * (1*$config->asteroidRound));
						
						$sql = "INSERT INTO %%PLANETS%% SET
							name			= :name,
							id_owner		= :id_owner,
							universe		= :universe,
							galaxy			= :galaxy,
							system			= :system,
							planet			= :planet,
							planet_type		= :planet_type,
							image			= :image,
							diameter		= :diameter,
							metal			= :metal,
							crystal			= :crystal,
							deuterium		= :deuterium,
							last_update		= :last_update;";

						$db->insert($sql, array(
							':name'				=> 'Asteroid',
							':id_owner'			=> NULL,
							':universe'			=> 1,
							':galaxy'			=> $Element,
							':system'			=> $System_Element,
							':planet'			=> $planets,
							':planet_type'		=> 1,
							':image'			=> 'asteroid',
							':diameter'			=> 9800,
							':metal'			=> $metal_rand,
							':crystal'			=> $crystal_rand,
							':deuterium'		=> $deuterium_rand,
							':last_update'		=> TIMESTAMP
						));
						
						$Example1 = $Element;
						$Example2 = $System_Element;
						$Example3 = $planets;
					}
				}
			}
			
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
				
				$message = '<span class="admin">'.sprintf($LNG['custom_asteroid'], $Example1, $Example2, $Example3).'
				</span>';
				PlayerUtil::sendMessage($userInfo['id'], '', 'Event System', 50, 'Event Info', $message, TIMESTAMP);
			}
			
		}
		
	}
}