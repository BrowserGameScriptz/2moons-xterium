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

class notificationPremiumCronjob implements CronjobTask
{
	
	function run()
	{		
		$sql	= 'SELECT `id`, `lang`, `prem_res_days`, `prem_storage_days`, `prem_s_build_days`, `prem_o_build_days`, `prem_button_days`, `prem_speed_button_days`, `prem_expedition_days`, `prem_count_expiditeon_days`, `prem_speed_expiditeon_days`, `prem_moon_dextruct_days`, `prem_leveling_days`, `prem_batle_leveling_days`, `prem_bank_ally_days`, `prem_conveyors_l_days`, `prem_conveyors_s_days`, `prem_conveyors_t_days`, `prem_prod_from_colly_days`, `prem_moon_creat_days`, `prem_fuel_consumption_days` FROM %%USERS%% WHERE `onlinetime` > :time;';
		$activeUsers	= Database::get()->select($sql, array(
			':time'	=> TIMESTAMP - 7 * 24 * 60 * 60
		));
		
		$premiumArray	= array('prem_res_days', 'prem_storage_days', 'prem_s_build_days', 'prem_o_build_days', 'prem_button_days', 'prem_speed_button_days', 'prem_expedition_days', 'prem_count_expiditeon_days', 'prem_speed_expiditeon_days', 'prem_moon_dextruct_days', 'prem_leveling_days', 'prem_batle_leveling_days', 'prem_bank_ally_days', 'prem_conveyors_l_days', 'prem_conveyors_s_days', 'prem_conveyors_t_days', 'prem_prod_from_colly_days', 'prem_moon_creat_days', 'prem_fuel_consumption_days', );
		
		foreach($activeUsers as $user){
			$langObjects	= new Language($user['lang']);
			$langObjects->includeData(array('L18N', 'INGAME', 'PUBLIC', 'CUSTOM'));
			
			foreach($premiumArray as $skill){
				$premiumType = "";
				if($skill == "prem_res_days") 
					$premiumType = $langObjects['premium_18'];
				elseif($skill == "prem_storage_days") 
					$premiumType = $langObjects['premium_21'];
				elseif($skill == "prem_s_build_days") 
					$premiumType = $langObjects['premium_23'];
				elseif($skill == "prem_o_build_days") 
					$premiumType = $langObjects['premium_25'];
				elseif($skill == "prem_button_days") 
					$premiumType = $langObjects['premium_27'];
				elseif($skill == "prem_speed_button_days") 
					$premiumType = $langObjects['premium_29'];
				elseif($skill == "prem_expedition_days") 
					$premiumType = $langObjects['premium_31'];
				elseif($skill == "prem_count_expiditeon_days") 
					$premiumType = $langObjects['premium_33'];
				elseif($skill == "prem_speed_expiditeon_days") 
					$premiumType = $langObjects['premium_35'];
				elseif($skill == "prem_moon_dextruct_days") 
					$premiumType = $langObjects['premium_37'];
				elseif($skill == "prem_leveling_days") 
					$premiumType = $langObjects['premium_39'];
				elseif($skill == "prem_batle_leveling_days") 
					$premiumType = $langObjects['premium_41'];
				elseif($skill == "prem_bank_ally_days") 
					$premiumType = $langObjects['premium_43'];
				elseif($skill == "prem_conveyors_l_days") 
					$premiumType = $langObjects['premium_45'];
				elseif($skill == "prem_conveyors_s_days") 
					$premiumType = $langObjects['premium_47'];
				elseif($skill == "prem_conveyors_t_days") 
					$premiumType = $langObjects['premium_49'];
				elseif($skill == "prem_prod_from_colly_days") 
					$premiumType = $langObjects['premium_51'];
				elseif($skill == "prem_moon_creat_days") 
					$premiumType = $langObjects['premium_53'];
				elseif($skill == "prem_fuel_consumption_days") 
					$premiumType = $langObjects['premium_55'];
				
				if($user[$skill] > TIMESTAMP && $user[$skill] < TIMESTAMP + 3600){
					$sql = "INSERT INTO %%NOTIF%% SET userId = :userId, timestamp = :timestamp, noText = :noText, noImage = :noImage, isType = :isType;";
					database::get()->insert($sql, array(
						':userId'		=> $user['id'],
						':timestamp'	=> TIMESTAMP,
						':noText'		=> sprintf($langObjects['backNotification_3'], $premiumType),
						':noImage'		=> "styles/images/premium/".str_replace("_days", "", $skill).".jpg",
						':isType'		=> 2
					));
				}
			}
		}
		
	}
}