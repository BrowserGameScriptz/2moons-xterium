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


class ShowPlayerCardPage extends AbstractGamePage
{
    public static $requireModule = MODULE_PLAYERCARD;
	
	protected $disableEcoSystem = true;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show()
	{
		global $USER, $LNG;
		
		$this->setWindow('popup');
		$this->initTemplate();

		$db = Database::get();

		$PlayerID 	= HTTP::_GP('id', $USER['id']);
		
		if($_POST){
			$p_name 		= HTTP::_GP('p_name', '', UTF8_SUPPORT);
			$p_country 		= HTTP::_GP('p_country', '', UTF8_SUPPORT);
			$p_city 		= HTTP::_GP('p_city', '', UTF8_SUPPORT);
			$p_age 			= HTTP::_GP('p_age', 0);
			$p_style_game 	= HTTP::_GP('p_style_game', '', UTF8_SUPPORT);
			$p_communication= HTTP::_GP('p_communication', '', UTF8_SUPPORT);
			
			$sql	= "UPDATE %%USERS%% SET playercard_firstname = :playercard_firstname, playercard_age = :playercard_age, playercard_country = :playercard_country, playercard_playstyle = :playercard_playstyle, playercard_city = :playercard_city, playercard_skype = :playercard_skype WHERE id = :userID;";
			$db->update($sql, array(
				':playercard_firstname'	=> $p_name,
				':playercard_age'	=> $p_age,
				':playercard_country'	=> $p_country,
				':playercard_playstyle'	=> $p_style_game,
				':playercard_city'	=> $p_city,
				':playercard_skype'	=> $p_communication,
				':userID'	=> $USER['id']
			));
		}
		
		$sql = "SELECT 
				u.playercard_firstname, u.playercard_age, u.playercard_country, u.playercard_playstyle, u.playercard_city, u.playercard_skype, u.username, u.customNick, u.galaxy,u.avatar, u.system, u.planet, u.wons, u.loos, u.draws, u.kbmetal, u.kbcrystal, u.lostunits, u.desunits, u.ally_id, u.achievement_common_1, u.achievement_common_2, u.achievement_build_1, u.achievement_build_2, u.achievement_build_3, u.achievement_build_4, u.achievement_build_5, u.achievement_build_6, u.achievement_build_7, u.achievement_build_8, u.achievement_build_9, u.achievement_build_10, u.achievement_fleet_1, u.achievement_fleet_2, u.achievement_fleet_3, u.achievement_fleet_4, u.achievement_fleet_5, u.achievement_fleet_6, u.achievement_fleet_7, u.achievement_varia_1, u.achievement_varia_2, u.achievement_varia_3, u.achievement_varia_4, u.achievement_varia_5, u.achievement_varia_6, u.achievement_varia_7, u.achievement_varia_8, u.achievement_tech_1, u.achievement_tech_2, u.achievement_tech_3, u.achievement_tech_4, u.achievement_tech_5, u.achievement_tech_6, u.achievement_tech_7, u.achievement_tech_8, u.achievement_tech_9, u.achievement_tech_10,
				p.name,
				s.tech_rank, s.tech_points, s.build_rank, s.build_points, s.ach_rank, s.ach_points, s.defs_rank, s.defs_points, s.fleet_rank, s.fleet_points, s.total_rank, s.total_points, s.wapeonry_rank, s.wapeonry_points, s.honor_rank, s.honor_points,
				a.ally_name, a.ally_fraction_id
				FROM %%USERS%% u
				INNER JOIN %%PLANETS%% p ON p.id = u.id_planet
				LEFT JOIN %%STATPOINTS%% s ON s.id_owner = u.id AND s.stat_type = 1
				LEFT JOIN %%ALLIANCE%% a ON a.id = u.ally_id
				WHERE u.id = :playerID AND u.universe = :universe;";
		$query = $db->selectSingle($sql, array(
			':universe'	=> Universe::current(),
			':playerID'	=> $PlayerID
		));

		$totalfights = $query['wons'] + $query['loos'] + $query['draws'];
		
		if ($totalfights == 0) {
			$siegprozent                = 0;
			$loosprozent                = 0;
			$drawsprozent               = 0;
		} else {
			$siegprozent                = 100 / $totalfights * $query['wons'];
			$loosprozent                = 100 / $totalfights * $query['loos'];
			$drawsprozent               = 100 / $totalfights * $query['draws'];
		}
		
		
		$sql	= 'SELECT s.tech_rank, s.ach_rank, s.honor_rank, s.honor_points, s.wapeonry_rank, s.build_rank, s.defs_rank, s.fleet_rank, s.tech_old_rank, s.honor_old_rank, s.wapeonry_old_rank, s.ach_old_rank, s.build_old_rank, s.defs_old_rank, s.fleet_old_rank, s.total_old_rank, s.total_rank FROM %%USERS%% as u LEFT JOIN %%STATPOINTS%% as s ON s.id_owner = u.id AND s.stat_type = :stat_type WHERE id = :userID;';
		$statinfo = $db->selectSingle($sql, array(
			':stat_type'	=> 1,
			':userID'	=> $PlayerID
		));

		$ranking	= $statinfo['total_old_rank'] - $statinfo['total_rank'];
		$ranking1	= $statinfo['tech_old_rank'] - $statinfo['tech_rank'];
		$ranking2	= $statinfo['build_old_rank'] - $statinfo['build_rank'];
		$ranking3	= $statinfo['defs_old_rank'] - $statinfo['defs_rank'];
		$ranking4	= $statinfo['fleet_old_rank'] - $statinfo['fleet_rank'];
		$ranking5	= $statinfo['ach_old_rank'] - $statinfo['ach_rank'];
		$ranking6	= $statinfo['honor_old_rank'] - $statinfo['honor_rank'];
		$ranking7	= $statinfo['wapeonry_old_rank'] - $statinfo['wapeonry_rank'];
		
		if($ranking == 0){
			$position = "<span style='color:#87CEEB'>(*)</span>";
		}elseif($ranking < 0){
			$position = "<span style='color:red'>(".$ranking.")</span>";
		}elseif ($ranking > 0){
			$position = "<span style='color:green'>(+".$ranking.")</span>";
		}
		
		if($ranking1 == 0){
			$position1 = "<span style='color:#87CEEB'>(*)</span>";
		}elseif($ranking1 < 0){
			$position1 = "<span style='color:red'>(".$ranking1.")</span>";
		}elseif ($ranking1 > 0){
			$position1 = "<span style='color:green'>(+".$ranking1.")</span>";
		}
		
		if($ranking2 == 0){
			$position2 = "<span style='color:#87CEEB'>(*)</span>";
		}elseif($ranking2 < 0){
			$position2 = "<span style='color:red'>(".$ranking2.")</span>";
		}elseif ($ranking2){
			$position2 = "<span style='color:green'>(+".$ranking2.")</span>";
		}
		
		if($ranking3 == 0){
			$position3 = "<span style='color:#87CEEB'>(*)</span>";
		}elseif($ranking3 < 0){
			$position3 = "<span style='color:red'>(".$ranking3.")</span>";
		}elseif ($ranking3 > 0){
			$position3 = "<span style='color:green'>(+".$ranking3.")</span>";
		}
		
		if($ranking4 == 0){
			$position4 = "<span style='color:#87CEEB'>(*)</span>";
		}elseif($ranking4 < 0){
			$position4 = "<span style='color:red'>(".$ranking4.")</span>";
		}elseif ($ranking4 > 0){
			$position4 = "<span style='color:green'>(+".$ranking4.")</span>";
		}
		
		if($ranking5 == 0){
			$position5 = "<span style='color:#87CEEB'>(*)</span>";
		}elseif($ranking5 < 0){
			$position5 = "<span style='color:red'>(".$ranking5.")</span>";
		}elseif ($ranking5 > 0){
			$position5 = "<span style='color:green'>(+".$ranking5.")</span>";
		}
		
		if($ranking6 == 0){
			$position6 = "<span style='color:#87CEEB'>(*)</span>";
		}elseif($ranking6 < 0){
			$position6 = "<span style='color:red'>(".$ranking6.")</span>";
		}elseif ($ranking6 > 0){
			$position6 = "<span style='color:green'>(+".$ranking6.")</span>";
		}
		
		if($ranking7 == 0){
			$position7 = "<span style='color:#87CEEB'>(*)</span>";
		}elseif($ranking7 < 0){
			$position7 = "<span style='color:red'>(".$ranking7.")</span>";
		}elseif ($ranking7 > 0){
			$position7 = "<span style='color:green'>(+".$ranking7.")</span>";
		}
		
		$sql =  "SELECT total_rank FROM %%STATPOINTS%% ORDER BY total_rank DESC LIMIT 1;";
		$Lowestrank = $db->selectSingle($sql, array(
		), 'total_rank');
		
		$HonourStatus = "none";
		if($statinfo['honor_points'] >= 150000 && $statinfo['honor_rank'] <= 10){
			$HonourStatus = "rank_starlord3";
		}elseif($statinfo['honor_points'] >= 25000 && $statinfo['honor_rank'] <= 100){
			$HonourStatus = "rank_starlord2";
		}elseif($statinfo['honor_points'] >= 5000 && $statinfo['honor_rank'] <= 250){
			$HonourStatus = "rank_starlord1";
		}elseif($statinfo['honor_points'] <= -150000 && ($Lowestrank - 10) <= $statinfo['honor_rank']){
			$HonourStatus = "rank_bandit1";
		}elseif($statinfo['honor_points'] <= -25000 && ($Lowestrank - 100) <= $statinfo['honor_rank']){
			$HonourStatus = "rank_bandit2";
		}elseif($statinfo['honor_points'] <= -5000 && ($Lowestrank - 250) <= $statinfo['honor_rank']){
			$HonourStatus = "rank_bandit3";
		}
		
		$cusNickPlay = empty($query['customNick']) ? $query['username'] : $query['customNick'];
		$this->assign(array(
			'HonourStatus'				=> $HonourStatus,
			'ally_fraction_id'			=> $query['ally_fraction_id'],
			'rankInfo'					=> $position,
			'rankInfo1'					=> $position1,
			'rankInfo2'					=> $position2,
			'rankInfo3'					=> $position3,
			'rankInfo4'					=> $position4,
			'rankInfo5'					=> $position5,
			'rankInfo6'					=> $position6,
			'rankInfo7'					=> $position7,
			'id'						=> $PlayerID,
			'yourid'					=> $USER['id'],
			'name'						=> empty($query['customNick']) ? $query['username'] : $query['customNick'],
			'homeplanet'				=> $query['name'],
			'galaxy'					=> $query['galaxy'],
			'system'					=> $query['system'],
			'planet'					=> $query['planet'],
			'allyid'					=> $query['ally_id'],
			'firstname'					=> $query['playercard_firstname'],
			'age'						=> $query['playercard_age'],
			'country'					=> $query['playercard_country'],
			'playstyle'					=> $query['playercard_playstyle'],
			'city'						=> $query['playercard_city'],
			'skype'						=> $query['playercard_skype'],
			'tech_rank'     			=> pretty_number($query['tech_rank']),
			'tech_points'   			=> pretty_number($query['tech_points']),
			'ach_rank'     				=> pretty_number($query['ach_rank']),
			'ach_points'  				=> pretty_number($query['ach_points']),
			'build_rank'    			=> pretty_number($query['build_rank']),
			'build_points'  			=> pretty_number($query['build_points']),
			'defs_rank'     			=> pretty_number($query['defs_rank']),
			'defs_points'   			=> pretty_number($query['defs_points']),
			'fleet_rank'    			=> pretty_number($query['fleet_rank']),
			'fleet_points'  			=> pretty_number($query['fleet_points']),
			'total_rank'    			=> pretty_number($query['total_rank']),
			'total_points'  			=> pretty_number($query['total_points']),
			'wapeonry_rank'    			=> pretty_number($query['wapeonry_rank']),
			'wapeonry_points'  			=> pretty_number($query['wapeonry_points']),
			'honor_rank'       			=> pretty_number($query['honor_rank']),
			'honor_points'    		 	=> pretty_number($query['honor_points']),
			'allyname'					=> $query['ally_name'],
			'useravatar' 				=> "media/files/".$USER['avatar'],
			'useravatar1' 				=> "media/files/".$query['avatar'],
			'playerdestory'		 		=> sprintf($LNG['pl_destroy'], $cusNickPlay),
			'wons'          			=> pretty_number($query['wons']),
			'loos'          			=> pretty_number($query['loos']),
			'draws'         			=> pretty_number($query['draws']),
			'kbmetal'       			=> pretty_number($query['kbmetal']),
			'kbcrystal'     			=> pretty_number($query['kbcrystal']),
			'lostunits'     			=> pretty_number($query['lostunits']),
			'desunits'      			=> pretty_number($query['desunits']),
			'totalfights'   			=> pretty_number($totalfights),
			'achievement_common_1'  	=> pretty_number($query['achievement_common_1']),
			'achievement_common_2'   	=> pretty_number($query['achievement_common_2']),
			'achievement_build_1'   	=> pretty_number($query['achievement_build_1']),
			'achievement_build_2'   	=> pretty_number($query['achievement_build_2']),
			'achievement_build_3'   	=> pretty_number($query['achievement_build_3']),
			'achievement_build_4'   	=> pretty_number($query['achievement_build_4']),
			'achievement_build_5'   	=> pretty_number($query['achievement_build_5']),
			'achievement_build_6'   	=> pretty_number($query['achievement_build_6']),
			'achievement_build_7'   	=> pretty_number($query['achievement_build_7']),
			'achievement_build_8'   	=> pretty_number($query['achievement_build_8']),
			'achievement_build_9'   	=> pretty_number($query['achievement_build_9']),
			'achievement_build_10'  	=> pretty_number($query['achievement_build_10']),
			'achievement_tech_1'  		=> pretty_number($query['achievement_tech_1']),
			'achievement_tech_2'  		=> pretty_number($query['achievement_tech_2']),
			'achievement_tech_3'  		=> pretty_number($query['achievement_tech_3']),
			'achievement_tech_4'  		=> pretty_number($query['achievement_tech_4']),
			'achievement_tech_5'  		=> pretty_number($query['achievement_tech_5']),
			'achievement_tech_6'  		=> pretty_number($query['achievement_tech_6']),
			'achievement_tech_7'  		=> pretty_number($query['achievement_tech_7']),
			'achievement_tech_8'  		=> pretty_number($query['achievement_tech_8']),
			'achievement_tech_9'  		=> pretty_number($query['achievement_tech_9']),
			'achievement_tech_10'  		=> pretty_number($query['achievement_tech_10']),
			'achievement_fleet_1'   	=> pretty_number($query['achievement_fleet_1']),
			'achievement_fleet_2'   	=> pretty_number($query['achievement_fleet_2']),
			'achievement_fleet_3'   	=> pretty_number($query['achievement_fleet_3']),
			'achievement_fleet_4'   	=> pretty_number($query['achievement_fleet_4']),
			'achievement_fleet_5'   	=> pretty_number($query['achievement_fleet_5']),
			'achievement_fleet_6'   	=> pretty_number($query['achievement_fleet_6']),
			'achievement_fleet_7'   	=> pretty_number($query['achievement_fleet_7']),
			'achievement_varia_1'   	=> pretty_number($query['achievement_varia_1']),
			'achievement_varia_2'   	=> pretty_number($query['achievement_varia_2']),
			'achievement_varia_3'   	=> pretty_number($query['achievement_varia_3']),
			'achievement_varia_4'   	=> pretty_number($query['achievement_varia_4']),
			'achievement_varia_5'   	=> pretty_number($query['achievement_varia_5']),
			'achievement_varia_6'   	=> pretty_number($query['achievement_varia_6']),
			'achievement_varia_7'   	=> pretty_number($query['achievement_varia_7']),
			'achievement_varia_8'   	=> pretty_number($query['achievement_varia_8']),
			'achievement_common_1_title'=> sprintf($LNG['achiev_18'], $query['achievement_common_1']),
			'achievement_common_2_title'=> sprintf($LNG['achiev_20'], $query['achievement_common_2']),
			'achievement_build_1_title' => sprintf($LNG['achiev_75'], $query['achievement_build_1']),
			'achievement_build_2_title' => sprintf($LNG['achiev_76'], $query['achievement_build_2']),
			'achievement_build_3_title' => sprintf($LNG['achiev_77'], $query['achievement_build_3']),
			'achievement_build_4_title' => sprintf($LNG['achiev_78'], $query['achievement_build_4']),
			'achievement_build_5_title' => sprintf($LNG['achiev_79'], $query['achievement_build_5']),
			'achievement_build_6_title' => sprintf($LNG['achiev_80'], $query['achievement_build_6']),
			'achievement_build_7_title' => sprintf($LNG['achiev_81'], $query['achievement_build_7']),
			'achievement_build_8_title' => sprintf($LNG['achiev_82'], $query['achievement_build_8']),
			'achievement_build_9_title' => sprintf($LNG['achiev_83'], $query['achievement_build_9']),
			'achievement_build_10_title'=> sprintf($LNG['achiev_84'], $query['achievement_build_10']),
			'achievement_tech_1_title'	=> sprintf($LNG['achiev_105'], $query['achievement_tech_1']),
			'achievement_tech_2_title'	=> sprintf($LNG['achiev_106'], $query['achievement_tech_2']),
			'achievement_tech_3_title'	=> sprintf($LNG['achiev_107'], $query['achievement_tech_3']),
			'achievement_tech_4_title'	=> sprintf($LNG['achiev_108'], $query['achievement_tech_4']),
			'achievement_tech_5_title'	=> sprintf($LNG['achiev_109'], $query['achievement_tech_5']),
			'achievement_tech_6_title'	=> sprintf($LNG['achiev_110'], $query['achievement_tech_6']),
			'achievement_tech_7_title'	=> sprintf($LNG['achiev_111'], $query['achievement_tech_7']),
			'achievement_tech_8_title'	=> sprintf($LNG['achiev_112'], $query['achievement_tech_8']),
			'achievement_tech_9_title'	=> sprintf($LNG['achiev_113'], $query['achievement_tech_9']),
			'achievement_tech_10_title'	=> sprintf($LNG['achiev_114'], $query['achievement_tech_10']),
			'achievement_fleet_1_title' => sprintf($LNG['achiev_177'], $query['achievement_fleet_1']),
			'achievement_fleet_2_title' => sprintf($LNG['achiev_178'], $query['achievement_fleet_2']),
			'achievement_fleet_3_title' => sprintf($LNG['achiev_179'], $query['achievement_fleet_3']),
			'achievement_fleet_4_title' => sprintf($LNG['achiev_180'], $query['achievement_fleet_4']),
			'achievement_fleet_5_title' => sprintf($LNG['achiev_181'], $query['achievement_fleet_5']),
			'achievement_fleet_6_title' => sprintf($LNG['achiev_182'], $query['achievement_fleet_6']),
			'achievement_fleet_7_title' => sprintf($LNG['achiev_183'], $query['achievement_fleet_7']),
			'achievement_varia_1_title' => sprintf($LNG['achiev_145'], $query['achievement_varia_1']),
			'achievement_varia_2_title' => sprintf($LNG['achiev_146'], $query['achievement_varia_2']),
			'achievement_varia_3_title' => sprintf($LNG['achiev_147'], $query['achievement_varia_3']),
			'achievement_varia_4_title' => sprintf($LNG['achiev_148'], $query['achievement_varia_4']),
			'achievement_varia_5_title' => sprintf($LNG['achiev_149'], $query['achievement_varia_5']),
			'achievement_varia_6_title' => sprintf($LNG['achiev_150'], $query['achievement_varia_6']),
			'achievement_varia_7_title' => sprintf($LNG['achiev_151'], $query['achievement_varia_7']),
			'achievement_varia_8_title' => sprintf($LNG['achiev_152'], $query['achievement_varia_8']),
			'siegprozent'   => round($siegprozent, 2),
			'loosprozent'   => round($loosprozent, 2),
			'drawsprozent'  => round($drawsprozent, 2),
		));
		
		$this->display('page.playerCard.default.tpl');
	}
}