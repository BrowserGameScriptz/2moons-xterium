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

class InstantCronjob implements CronjobTask
{
	function run()
	{		
		$config	= Config::get(ROOT_UNI);
		$db	= Database::get();
		$del_before 	= TIMESTAMP - ($config->del_oldstuff * 86400);
		$del_inactive 	= TIMESTAMP - ($config->del_user_automatic * 86400);
		$del_deleted 	= TIMESTAMP - ($config->del_user_manually * 86400);

		if($del_inactive === TIMESTAMP)
		{
			$del_inactive = 2147483647;
		}
		
		if($config->cronInstant < TIMESTAMP){

			if($config->cronInstantStep == 1){
				$sql	= 'DELETE FROM %%MESSAGES%% WHERE message_time < :time AND message_type != :message_type;';
				$db->delete($sql, array(
					':time'	=> $del_before,
					':message_type' => 199
				));
				$sql	= 'DELETE FROM %%TRACKING%% WHERE time < :time;';
				$db->delete($sql, array(
					':time'	=> $del_before
				));
				$sql	= 'DELETE FROM %%NOTIF%% WHERE timestamp < :timestamp;';
				$db->delete($sql, array(
					':timestamp'	=> TIMESTAMP - 60*60*24
				));
				
				$sql	= 'UPDATE %%CONFIG%% SET `cronInstantStep` = :cronInstantStep;';
				$db->update($sql, array(
					':cronInstantStep'	=> 2
				));
			}
			elseif($config->cronInstantStep == 2){
				$sql	= "UPDATE %%USERS%% SET insta_dm_defense = 0, insta_dm_navy = 0, achievement_daily_2 = 0, achievement_daily_2_succes = 0, achievement_daily_1 = 0, achievement_daily_1_succes = 0, achievement_daily_3 = 0, achievement_daily_3_succes = 0, achievement_daily_4 = 0, achievement_daily_4_succes = 0, achievement_daily_5 = 0, achievement_daily_5_succes = 0, achievement_daily_6 = 0, achievement_daily_6_succes = 0, achievement_daily_7 = 0, achievement_daily_7_succes = 0, achievement_daily_8 = 0, achievement_daily_8_succes = 0;";
				$db->update($sql, array());
				PlayerUtil::sendMessage(1, 1, 'Game Developer', 4, 'Reset achievements & dm purchase', "The daily achievements and daily darkmatter purchase have been resetted.", TIMESTAMP);
				$sql	= 'UPDATE %%CONFIG%% SET `cronInstantStep` = :cronInstantStep;';
				$db->update($sql, array(
					':cronInstantStep'	=> 3
				));
			}
			elseif($config->cronInstantStep == 3){
				$sql	= 'DELETE FROM %%SESSION%% WHERE userID > 0;';
				$db->delete($sql, array());
				
				$sql	= 'UPDATE %%CONFIG%% SET `cronInstantStep` = :cronInstantStep;';
				$db->update($sql, array(
					':cronInstantStep'	=> 4
				));
			}
			elseif($config->cronInstantStep == 4){
				$sql	= 'DELETE FROM %%ALLIANCE%% WHERE ally_members = 0;';
				$db->delete($sql);
				$sql	= 'UPDATE %%CONFIG%% SET `cronInstantStep` = :cronInstantStep;';
				$db->update($sql, array(
					':cronInstantStep'	=> 5
				));
			}
			elseif($config->cronInstantStep == 5){
				$sql	= 'DELETE FROM %%PLANETS%% WHERE destruyed < :time AND destruyed != 0;';
				$db->delete($sql, array(
					':time'	=> TIMESTAMP
				));
				/* $sql	= 'SELECT id FROM %%USERS%% WHERE authlevel = 0 AND ((db_deaktjava != 0 AND db_deaktjava < :timeDeleted) OR onlinetime < :timeInactive AND eur_spend = 0 AND urlaubs_modus = 0);';
				$deleteUserIds = Database::get()->select($sql, array(
					':timeDeleted'	=> $del_deleted,
					':timeInactive'	=> TIMESTAMP - (7*24*3600),
				));
				
				if(!empty($deleteUserIds))
				{
					foreach($deleteUserIds as $dataRow)
					{
						PlayerUtil::deletePlayer($dataRow['id']);
					}	
				} */
		
				$sql	= 'UPDATE %%CONFIG%% SET `cronInstantStep` = :cronInstantStep;';
				$db->update($sql, array(
					':cronInstantStep'	=> 6
				));
			}
			elseif($config->cronInstantStep == 6){
				$sql	= 'DELETE FROM %%FLEETS_EVENT%% WHERE fleetID NOT IN (SELECT fleet_id FROM %%FLEETS%%);';
				$db->delete($sql);
				$sql	= 'UPDATE %%CONFIG%% SET `cronInstantStep` = :cronInstantStep;';
				$db->update($sql, array(
					':cronInstantStep'	=> 7
				));
			}
			elseif($config->cronInstantStep == 7){
				$sql	= 'UPDATE %%USERS%% SET email_2 = email WHERE setmail < :time;';
				$db->update($sql, array(
					':time'	=> TIMESTAMP
				));
				$sql	= 'UPDATE %%CONFIG%% SET `cronInstantStep` = :cronInstantStep;';
				$db->update($sql, array(
					':cronInstantStep'	=> 8
				));
			}
			elseif($config->cronInstantStep == 8){
				$sql	= 'SELECT units FROM %%TOPKB%% WHERE universe = :universe ORDER BY units DESC LIMIT 99,1;';

				$battleHallLowest	= $db->selectSingle($sql, array(
					':universe'	=> 1
				),'units');

				if(!is_null($battleHallLowest))
				{
					$sql	= 'DELETE %%TOPKB%%, %%TOPKB_USERS%%
					FROM %%TOPKB%%
					INNER JOIN %%TOPKB_USERS%% USING (rid)
					WHERE universe = :universe AND units < :battleHallLowest;';

					$db->delete($sql, array(
						':universe'			=> 1,
						':battleHallLowest'	=> $battleHallLowest 
					));
				}
				$sql	= 'UPDATE %%CONFIG%% SET `cronInstantStep` = :cronInstantStep;';
				$db->update($sql, array(
					':cronInstantStep'	=> 9
				));
			}
			elseif($config->cronInstantStep == 9){
				$sql	= 'DELETE FROM %%RW%% WHERE time < :time AND rid NOT IN (SELECT rid FROM %%TOPKB%%);';
				$db->delete($sql, array(
					':time'	=> $del_before
				));
				$sql	= 'UPDATE %%CONFIG%% SET `cronInstantStep` = :cronInstantStep;';
				$db->update($sql, array(
					':cronInstantStep'	=> 10
				));
			}
			elseif($config->cronInstantStep == 10){
				$checkIf17 = _date('j', TIMESTAMP, 'Europe/Brussels');
				if($checkIf17 == 17){
					$sql	= 'UPDATE %%CONFIG%% SET `arsenalUpdate` = arsenalUpdate + 500;';
					$db->update($sql, array());
				}
				
				$sql	= 'UPDATE %%CONFIG%% SET `cronInstant` = :cronInstant, `cronInstantStep` = :cronInstantStep;';
				$db->update($sql, array(
					':cronInstantStep'	=> 1,
					':cronInstant'		=> TIMESTAMP + 2 * 60,
				));
			}
		}
	}
}