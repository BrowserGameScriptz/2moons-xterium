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

function getLanguage($language = NULL, $userID = NULL)
{
	if(is_null($language) && !is_null($userID))
	{
		$sql		= 'SELECT lang FROM %%USERS%% WHERE id = :userId;';
		$language	= Database::get()->selectSingle($sql, array(
			':userId' => $userID
		), 'lang');
	}
	
	$LNG		= new Language($language);
	$LNG->includeData(array('L18N', 'FLEET', 'TECH', 'CUSTOM'));
	return $LNG;
}

function dailyAchievement($fleetInfo, $targetUser, $ownerUser, $combatResult)
{	
	//Steal-Math by Slaver for 2Moons(http://www.2moons.cc) based on http://www.owiki.de/Beute
	global $pricelist, $resource;
	
	//DAILY ACHIEVEMENT
	if($combatResult['won'] == 'a'){

	$sql		= "SELECT MAX(total_points) as total FROM %%STATPOINTS%% WHERE `stat_type` = :type AND `universe` = :universe AND id_owner = :id_owner;";

	$topPoints	= Database::get()->selectSingle($sql, array(
		':type'		=> 1,
		':universe'	=> $fleetInfo['fleet_universe'],
		':id_owner'	=> $fleetInfo['fleet_owner']
	), 'total');

	if(500000000 < $topPoints)
	{
		$maxFactorDestroy		= 80000000000;
	}
	elseif(200000000 < $topPoints && 50000000 >= $topPoints)
	{
		$maxFactorDestroy		= 30000000000;
	}
	elseif(50000000 < $topPoints && 200000000 >= $topPoints)
	{
		$maxFactorDestroy		= 15000000000;
	}
	else
	{
		$maxFactorDestroy		= 1000000000;
	}
				
	if(($targetUser['onlinetime'] > TIMESTAMP - 7*24 * 3600 && $combatResult['unitLost']['defender'] >= $maxFactorDestroy && $ownerUser['ally_id'] != $targetUser['ally_id']) || ($targetUser['onlinetime'] > TIMESTAMP - 7*24 * 3600 && $combatResult['unitLost']['defender'] >= $maxFactorDestroy && $ownerUser['ally_id'] == 0 && $targetUser['ally_id'] == 0)){
	$sql	= "UPDATE %%USERS%% SET achievement_daily_1_succes = achievement_daily_1_succes + :achievement_daily_1_succes WHERE id = :userId;";
	Database::get()->update($sql, array(
		':achievement_daily_1_succes'	=> 1,
		':userId'	=> $fleetInfo['fleet_owner']
	));
	$actualWins =  $ownerUser['achievement_daily_1_succes'] + 1;
	$actualNeeded =  round(5 * pow(2.40, $ownerUser['achievement_daily_1']));
	$fighter_lvl =  $ownerUser['achievement_daily_1'] + 1;
	$fighter_reward_am = round(150 * pow(1.20, $ownerUser['achievement_daily_1']));
	$fighter_reward_points = round(75 * pow(1.25, $ownerUser['achievement_daily_1']));
	$fighter_reward_m7 = round(11393924 * pow(1.30, $ownerUser['achievement_daily_1']));
	$fighter_reward_m19 = round(569696 * pow(1.30, $ownerUser['achievement_daily_1']));
	$fighter_reward_m32 = round(1470 * pow(1.30, $ownerUser['achievement_daily_1']));
	$fighter_reward_upgrade = round(2 * pow(1.10, $ownerUser['achievement_daily_1']));
	if($actualWins == $actualNeeded){
		$sql	= "UPDATE %%USERS%% SET achievement_daily_1 = achievement_daily_1 + :achievement_daily_1, achievement_daily_1_points = achievement_daily_1_points + :achievement_daily_1_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter, arsenal_res901 = arsenal_res901 + :arsenal_res901 WHERE id = :userId;";
		Database::get()->update($sql, array(
			':achievement_daily_1'	=> 1,
			':achievement_daily_1_points'	=> $fighter_reward_points,
			':achievement_point'	=> $fighter_reward_points,
			':antimatter'	=> $fighter_reward_am,
			':arsenal_res901'	=> $fighter_reward_upgrade,
			':userId'				=> $fleetInfo['fleet_owner']
		));
		$sql	= "UPDATE %%PLANETS%% SET m7 = m7 + :m7, m19 = m19 + :m19, m32 = m32 + :m32 WHERE id = :planetId;";
		Database::get()->update($sql, array(
			':m7'	=> $fighter_reward_m7,
			':m19'	=> $fighter_reward_m19,
			':m32'	=> $fighter_reward_m32,
			':planetId'	=> $fleetInfo['fleet_start_id']
		));
		$LNG		= getLanguage(NULL, $fleetInfo['fleet_owner']);
		$msg = '<a href="game.php?page=achievement&amp;group=daily#ach_wons_day"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_wons_day.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_47'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a><br><br>'.$LNG['allian_29'].':<br>'.pretty_number($fighter_reward_m7).' М7<br>'.pretty_number($fighter_reward_m19).' М19<br>'.pretty_number($fighter_reward_m32).' М32<br>Апгрейд добычи металла 2 шт.';
		PlayerUtil::sendMessage($fleetInfo['fleet_owner'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
	}
}elseif($combatResult['won'] == 'r'){

	$sql		= "SELECT MAX(total_points) as total FROM %%STATPOINTS%% WHERE `stat_type` = :type AND `universe` = :universe AND id_owner = :id_owner;";

	$topPoints	= Database::get()->selectSingle($sql, array(
		':type'		=> 1,
		':universe'	=> $fleetInfo['fleet_universe'],
		':id_owner'	=> $fleetInfo['fleet_target_owner']
	), 'total');

	if(500000000 < $topPoints)
	{
		$maxFactorDestroy		= 80000000000;
	}
	elseif(200000000 < $topPoints && 50000000 >= $topPoints)
	{
		$maxFactorDestroy		= 30000000000;
	}
	elseif(50000000 < $topPoints && 200000000 >= $topPoints)
	{
		$maxFactorDestroy		= 15000000000;
	}
	else
	{
		$maxFactorDestroy		= 0;
	}

	if(($targetUser['onlinetime'] > TIMESTAMP - 7*24 * 3600 && $combatResult['unitLost']['attacker'] >= $maxFactorDestroy && $ownerUser['ally_id'] != $targetUser['ally_id']) || ($targetUser['onlinetime'] > TIMESTAMP - 7*24 * 3600 && $combatResult['unitLost']['attacker'] >= $maxFactorDestroy && $ownerUser['ally_id'] == 0 && $targetUser['ally_id'] == 0)){
	$sql	= "UPDATE %%USERS%% SET achievement_daily_1_succes = achievement_daily_1_succes + :achievement_daily_1_succes WHERE id = :userId;";
	Database::get()->update($sql, array(
		':achievement_daily_1_succes'	=> 1,
		':userId'	=> $fleetInfo['fleet_target_owner']
	));
	$actualWins =  $targetUser['achievement_daily_1_succes'] + 1;
	$actualNeeded =  round(5 * pow(2.40, $targetUser['achievement_daily_1']));
	$fighter_lvl =  $targetUser['achievement_daily_1'] + 1;
	$fighter_reward_am = round(150 * pow(1.20, $targetUser['achievement_daily_1']));
	$fighter_reward_points = round(75 * pow(1.25, $targetUser['achievement_daily_1']));
	$fighter_reward_m7 = round(11393924 * pow(1.30, $targetUser['achievement_daily_1']));
	$fighter_reward_m19 = round(569696 * pow(1.30, $targetUser['achievement_daily_1']));
	$fighter_reward_m32 = round(1470 * pow(1.30, $targetUser['achievement_daily_1']));
	$fighter_reward_upgrade = round(2 * pow(1.10, $targetUser['achievement_daily_1']));
	if($actualWins == $actualNeeded){
		$sql	= "UPDATE %%USERS%% SET achievement_daily_1 = achievement_daily_1 + :achievement_daily_1, achievement_daily_1_points = achievement_daily_1_points + :achievement_daily_1_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter, arsenal_res901 = arsenal_res901 + :arsenal_res901 WHERE id = :userId;";
		Database::get()->update($sql, array(
			':achievement_daily_1'	=> 1,
			':achievement_daily_1_points'	=> $fighter_reward_points,
			':achievement_point'	=> $fighter_reward_points,
			':antimatter'	=> $fighter_reward_am,
			':arsenal_res901'	=> $fighter_reward_upgrade,
			':userId'				=> $fleetInfo['fleet_target_owner']
		));
		$sql	= "UPDATE %%PLANETS%% SET m7 = m7 + :m7, m19 = m19 + :m19, m32 = m32 + :m32 WHERE id = :planetId;";
		Database::get()->update($sql, array(
			':m7'	=> $fighter_reward_m7,
			':m19'	=> $fighter_reward_m19,
			':m32'	=> $fighter_reward_m32,
			':planetId'	=> $fleetInfo['fleet_end_id']
		));
		$LNG		= getLanguage(NULL, $fleetInfo['fleet_target_owner']);
		$msg = '<a href="game.php?page=achievement&amp;group=daily#ach_wons_day"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_wons_day.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_47'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a><br><br>'.$LNG['allian_29'].':<br>'.pretty_number($fighter_reward_m7).' М7<br>'.pretty_number($fighter_reward_m19).' М19<br>'.pretty_number($fighter_reward_m32).' М32<br>Апгрейд добычи металла 2 шт.';
		PlayerUtil::sendMessage($fleetInfo['fleet_target_owner'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
	} 
}
//END DAILY ACHIEVEMENT

//FIGHTER ACHIEVEMENT
	if($combatResult['won'] == 'a' && $targetUser['onlinetime'] > TIMESTAMP - 7*24 * 3600 && $fleetInfo['fleet_group'] == 0 && $combatResult['lastRound'] >= 1){
	$sql	= "UPDATE %%USERS%% SET achievement_varia_1_success = achievement_varia_1_success + :achievement_varia_1_success WHERE id = :userId;";
	database::get()->update($sql, array(
		':achievement_varia_1_success'	=> 1,
		':userId'	=> $fleetInfo['fleet_owner']
	));
	$actualWins =  $ownerUser['achievement_varia_1_success'] + 1;
	$actualNeeded =  round(50 * pow(1.905, $ownerUser['achievement_varia_1']));
	$fighter_lvl =  $ownerUser['achievement_varia_1'] + 1;
	$fighter_reward_am = floor(300 * pow(1.05, $ownerUser['achievement_varia_1']));
	$fighter_reward_points = floor(150 * pow(1.05, $ownerUser['achievement_varia_1']));
	if($actualWins == $actualNeeded){
	$sql	= "UPDATE %%USERS%% SET achievement_varia_1 = achievement_varia_1 + :achievement_varia_1, achievement_varia_1_points = achievement_varia_1_points + :achievement_varia_1_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
	database::get()->update($sql, array(
		':achievement_varia_1'	=> 1,
		':achievement_varia_1_points'	=> $fighter_reward_points,
		':achievement_point'	=> $fighter_reward_points,
		':antimatter'	=> $fighter_reward_am,
		':userId'				=> $fleetInfo['fleet_owner']
	));
	$LNG		= getLanguage(NULL, $fleetInfo['fleet_owner']);
	$msg = '<a href="game.php?page=achievement&amp;group=varia#ach_wons"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_wons.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_145'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a>';
	PlayerUtil::sendMessage($fleetInfo['fleet_owner'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
	}
	}elseif($combatResult['won'] == 'r' && $targetUser['onlinetime'] > TIMESTAMP - 7*24 * 3600 && $fleetInfo['fleet_group'] == 0){
	$sql	= "UPDATE %%USERS%% SET achievement_varia_1_success = achievement_varia_1_success + :achievement_varia_1_success WHERE id = :userId;";
	database::get()->update($sql, array(
		':achievement_varia_1_success'	=> 1,
		':userId'	=> $fleetInfo['fleet_target_owner']
	));		
	$actualWins =  $targetUser['achievement_varia_1_success'] + 1;
	$actualNeeded =  round(50 * pow(1.905, $targetUser['achievement_varia_1']));
	$fighter_lvl =  $targetUser['achievement_varia_1'] + 1;
	$fighter_reward_am = floor(300 * pow(1.05, $targetUser['achievement_varia_1']));
	$fighter_reward_points = floor(150 * pow(1.05, $targetUser['achievement_varia_1']));
	if($actualWins == $actualNeeded){
	$sql	= "UPDATE %%USERS%% SET achievement_varia_1 = achievement_varia_1 + :achievement_varia_1, achievement_varia_1_points = achievement_varia_1_points + :achievement_varia_1_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
	database::get()->update($sql, array(
		':achievement_varia_1'	=> 1,
		':achievement_varia_1_points'	=> $fighter_reward_points,
		':achievement_point'	=> $fighter_reward_points,
		':antimatter'	=> $fighter_reward_am,
		':userId'				=> $fleetInfo['fleet_target_owner']
	));
	$LNG		= getLanguage(NULL, $fleetInfo['fleet_target_owner']);
	$msg = '<a href="game.php?page=achievement&amp;group=varia#ach_wons"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_wons.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_145'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a>';
	PlayerUtil::sendMessage($fleetInfo['fleet_target_owner'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
	}
}
//END FIGHTER ACHIEVEMENT	

return true;
}
	