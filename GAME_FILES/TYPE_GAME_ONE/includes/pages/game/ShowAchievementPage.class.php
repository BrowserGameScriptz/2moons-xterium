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
 
class ShowAchievementPage extends AbstractGamePage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show(){	
		global $LNG, $USER, $PLANET;
		$groupdId = HTTP::_GP('group', '', UTF8_SUPPORT);
		
		//if($USER['id'] != 1){
		//$this->printMessage('under maintenance', true, array('game.php?page=overview', 2));
		//}

		switch($groupdId){
		case 'varia':
		$this->assign(array(
		'achievement_point' => $USER['achievement_point'] + $USER['achievement_point_used'],
		'achievement_varia_1' => sprintf($LNG['achiev_145'], pretty_number($USER['achievement_varia_1'])),
		'achievement_varia_2' => sprintf($LNG['achiev_146'], pretty_number($USER['achievement_varia_2'])),
		'achievement_varia_3' => sprintf($LNG['achiev_147'], pretty_number($USER['achievement_varia_3'])),
		'achievement_varia_4' => sprintf($LNG['achiev_148'], pretty_number($USER['achievement_varia_4'])),
		'achievement_varia_5' => sprintf($LNG['achiev_149'], pretty_number($USER['achievement_varia_5'])),
		'achievement_varia_6' => sprintf($LNG['achiev_150'], pretty_number($USER['achievement_varia_6'])),
		'achievement_varia_7' => sprintf($LNG['achiev_151'], pretty_number($USER['achievement_varia_7'])),
		'achievement_varia_8' => sprintf($LNG['achiev_152'], pretty_number($USER['achievement_varia_8'])),
		'achievement_varia_1_next' => sprintf($LNG['achiev_153'], pretty_number(round(50 * pow(1.905, $USER['achievement_varia_1'])))),
		'achievement_varia_2_next' => sprintf($LNG['achiev_154'], pretty_number(round(3 * pow(1.30, $USER['achievement_varia_2'])))),
		'achievement_varia_3_next' => sprintf($LNG['achiev_155'], pretty_number(round(3 * pow(1.30, $USER['achievement_varia_3'])))),
		'achievement_varia_4_next' => sprintf($LNG['achiev_156'], pretty_number(($USER['achievement_varia_4']*20) +20)),
		'achievement_varia_5_next' => sprintf($LNG['achiev_157'], pretty_number(round(10 * pow(1.40, $USER['achievement_varia_5'])))),
		'achievement_varia_6_next' => sprintf($LNG['achiev_158'], pretty_number(round(50000 * pow(1.11, $USER['achievement_varia_6'])))),
		'achievement_varia_7_next' => sprintf($LNG['achiev_159'], pretty_number(($USER['achievement_varia_7']*3) +3)),
		'achievement_varia_8_next' => sprintf($LNG['achiev_160'], pretty_number(($USER['achievement_varia_8']*10) +10)),
		'achievement_varia_1_next_am' => pretty_number(round(300 * pow(1.05, $USER['achievement_varia_1']))),
		'achievement_varia_1_next_points' => pretty_number(round(150 * pow(1.05, $USER['achievement_varia_1']))),
		'achievement_varia_1_current_points' => pretty_number($USER['achievement_varia_1_points']),
		'achievement_varia_2_next_am' => pretty_number(round(500 * pow(1.10, $USER['achievement_varia_2']))),
		'achievement_varia_2_next_points' => pretty_number(round(250 * pow(1.10, $USER['achievement_varia_2']))),
		'achievement_varia_2_current_points' => pretty_number($USER['achievement_varia_2_points']),
		'achievement_varia_3_next_am' => pretty_number(round(200 * pow(1.10, $USER['achievement_varia_3']))),
		'achievement_varia_3_next_points' => pretty_number(round(100 * pow(1.10, $USER['achievement_varia_3']))),
		'achievement_varia_3_current_points' => pretty_number($USER['achievement_varia_3_points']),
		'achievement_varia_4_next_am' => pretty_number(round(200 * pow(1.35, $USER['achievement_varia_4']))),
		'achievement_varia_4_next_points' => pretty_number(round(40 * pow(1.10, $USER['achievement_varia_4']))),
		'achievement_varia_4_current_points' => pretty_number($USER['achievement_varia_4_points']),
		'achievement_varia_5_next_am' => pretty_number(round(150 * pow(1.08, $USER['achievement_varia_5']))),
		'achievement_varia_5_next_points' => pretty_number(round(50 * pow(1.08, $USER['achievement_varia_5']))),
		'achievement_varia_5_current_points' => pretty_number($USER['achievement_varia_5_points']),
		'achievement_varia_6_next_am' => pretty_number(round(33 * pow(1.0373, $USER['achievement_varia_6']))),
		'achievement_varia_6_next_points' => pretty_number(round(20 * pow(1.030, $USER['achievement_varia_6']))),
		'achievement_varia_6_current_points' => pretty_number($USER['achievement_varia_6_points']),
		'achievement_varia_7_next_am' => pretty_number(round(200 * pow(1.35, $USER['achievement_varia_7']))),
		'achievement_varia_7_next_points' => pretty_number(round(25 * pow(1.10, $USER['achievement_varia_7']))),
		'achievement_varia_7_current_points' => pretty_number($USER['achievement_varia_7_points']),
		'achievement_varia_8_next_am' => pretty_number(round(200 * pow(1.35, $USER['achievement_varia_8']))),
		'achievement_varia_8_next_points' => pretty_number(round(100 * pow(1.10, $USER['achievement_varia_8']))),
		'achievement_varia_8_current_points' => pretty_number($USER['achievement_varia_8_points']),
		'achievement_varia_1_missing' => sprintf($LNG['achiev_169'], pretty_number(round(50 * pow(1.45, $USER['achievement_varia_1'])) - $USER['achievement_varia_1_success'])),
		'achievement_varia_2_missing' => sprintf($LNG['achiev_170'], pretty_number(round(3 * pow(1.40, $USER['achievement_varia_2'])) - $USER['achievement_varia_2_success'])),
		'achievement_varia_3_missing' => sprintf($LNG['achiev_171'], pretty_number(round(3 * pow(1.40, $USER['achievement_varia_3'])) - $USER['achievement_varia_3_success'])),
		'achievement_varia_4_missing' => sprintf($LNG['achiev_172'], pretty_number(($USER['achievement_varia_4']*20) +20 - $USER['achievement_varia_4_success'])),
		'achievement_varia_5_missing' => sprintf($LNG['achiev_173'], pretty_number(round(10 * pow(1.40, $USER['achievement_varia_5'])) - $USER['achievement_varia_5_success'])),
		'achievement_varia_6_missing' => $USER['achievement_varia_6'] == 200 ? "max level" : sprintf($LNG['achiev_174'], pretty_number(round(50000 * pow(1.07, $USER['achievement_varia_6'])) - $USER['achievement_varia_6_success'])),
		'achievement_varia_7_missing' => sprintf($LNG['achiev_175'], pretty_number(($USER['achievement_varia_7']*3) +3 - $USER['achievement_varia_7_success'])),
		'achievement_varia_8_missing' => sprintf($LNG['achiev_176'], pretty_number(($USER['achievement_varia_8']*10) +10 - $USER['achievement_varia_8_success'])),
		'achievement_varia_1_percent' => 100-(100/round(50 * pow(1.45, $USER['achievement_varia_1']))*(round(50 * pow(1.45, $USER['achievement_varia_1'])) - $USER['achievement_varia_1_success'])),
		'achievement_varia_2_percent' => 100-(100/round(3 * pow(1.40, $USER['achievement_varia_2']))*(round(3 * pow(1.40, $USER['achievement_varia_2'])) - $USER['achievement_varia_2_success'])),
		'achievement_varia_3_percent' => 100-(100/round(3 * pow(1.40, $USER['achievement_varia_3']))*(round(3 * pow(1.40, $USER['achievement_varia_3'])) - $USER['achievement_varia_3_success'])),
		'achievement_varia_4_percent' => 100-(100/20*((($USER['achievement_varia_4']*20) +20) - $USER['achievement_varia_4_success'])),
		'achievement_varia_5_percent' => 100-(100/round(10 * pow(1.40, $USER['achievement_varia_5']))*((round(10 * pow(1.40, $USER['achievement_varia_5']))) - $USER['achievement_varia_5_success'])),
		'achievement_varia_6_percent' => 100-(100/round(50000 * pow(1.07, $USER['achievement_varia_6']))*(round(50000 * pow(1.07, $USER['achievement_varia_6'])) - $USER['achievement_varia_6_success'])),
		'achievement_varia_7_percent' => 100-(100/3*((($USER['achievement_varia_7']*3) +3) - $USER['achievement_varia_7_success'])),
		'achievement_varia_8_percent' => 100-(100/10*((($USER['achievement_varia_8']*10) +10) - $USER['achievement_varia_8_success'])),
		));
		$this->display('page.achievement.varia.tpl');
		break;
		case 'def':
		$this->assign(array(
		'achievement_point' => $USER['achievement_point']  + $USER['achievement_point_used'],
		'achievement_common_1' => sprintf($LNG['achiev_18'], pretty_number($USER['achievement_common_1'])),
		'achievement_common_2' => sprintf($LNG['achiev_20'], pretty_number($USER['achievement_common_2'])),
		'achievement_common_1_next' => sprintf($LNG['achiev_17'], pretty_number(($USER['achievement_common_1']*5) +5)),
		'achievement_common_2_next' => sprintf($LNG['achiev_24'], pretty_number(($USER['achievement_common_2']*5) +5)),
		'achievement_common_1_next_am' => pretty_number(round(200 * pow(1.10, $USER['achievement_common_1']))),
		'achievement_common_1_next_points' => pretty_number(round(100 * pow(1.10, $USER['achievement_common_1']))),
		'achievement_common_1_current_points' => pretty_number($USER['achievement_common_1_points']),
		'achievement_common_2_next_am' => pretty_number(round(400 * pow(1.10, $USER['achievement_common_2']))),
		'achievement_common_2_next_points' => pretty_number(round(200 * pow(1.10, $USER['achievement_common_2']))),
		'achievement_common_2_current_points' => pretty_number($USER['achievement_common_2_points']),
		'achievement_common_1_missing' => sprintf($LNG['achiev_11'], pretty_number(($USER['achievement_common_1']*5) +5 - $USER['peacefull_exp_level'])),
		'achievement_common_2_missing' => sprintf($LNG['achiev_19'], pretty_number(($USER['achievement_common_2']*5) +5 - $USER['combat_exp_level'])),
		'achievement_common_1_percent' => 100-(100/5*((($USER['achievement_common_1']*5) +5) - $USER['peacefull_exp_level'])),
		'achievement_common_2_percent' => 100-(100/5*((($USER['achievement_common_2']*5) +5) - $USER['combat_exp_level'])),
		));
		$this->display('page.achievement.def.tpl');
		break;
		case 'fleet':
		$this->assign(array(
		'achievement_point' => $USER['achievement_point'],
		'achievement_fleet_1' => sprintf($LNG['achiev_177'], pretty_number($USER['achievement_fleet_1'])),
		'achievement_fleet_2' => sprintf($LNG['achiev_178'], pretty_number($USER['achievement_fleet_2'])),
		'achievement_fleet_3' => sprintf($LNG['achiev_179'], pretty_number($USER['achievement_fleet_3'])),
		'achievement_fleet_4' => sprintf($LNG['achiev_180'], pretty_number($USER['achievement_fleet_4'])),
		'achievement_fleet_5' => sprintf($LNG['achiev_181'], pretty_number($USER['achievement_fleet_5'])),
		'achievement_fleet_6' => sprintf($LNG['achiev_182'], pretty_number($USER['achievement_fleet_6'])),
		'achievement_fleet_7' => sprintf($LNG['achiev_183'], pretty_number($USER['achievement_fleet_7'])),
		'achievement_fleet_1_next' => sprintf($LNG['achiev_184'], pretty_number(round(200000 + 35000 * pow(1.25, $USER['achievement_fleet_1']))), pretty_number(round(200000 + 35000 * pow(1.25, $USER['achievement_fleet_1'])))),
		'achievement_fleet_2_next' => sprintf($LNG['achiev_185'], pretty_number(round(200000 + 20000 * pow(1.25, $USER['achievement_fleet_2']))), pretty_number(round(200000 + 20000 * pow(1.25, $USER['achievement_fleet_2'])))),
		'achievement_fleet_3_next' => sprintf($LNG['achiev_186'], pretty_number(round(200000 * pow(1.80, $USER['achievement_fleet_3']))), pretty_number(round(200000 * pow(1.80, $USER['achievement_fleet_3'])))),
		'achievement_fleet_4_next' => sprintf($LNG['achiev_187'], pretty_number(round(4000 * pow(1.75, $USER['achievement_fleet_4']))), pretty_number(round(20000 * pow(1.75, $USER['achievement_fleet_4'])))),
		'achievement_fleet_5_next' => sprintf($LNG['achiev_188'], pretty_number(round(100000 * pow(1.65, $USER['achievement_fleet_5']))), pretty_number(round(5000 * pow(1.65, $USER['achievement_fleet_5'])))),
		'achievement_fleet_6_next' => sprintf($LNG['achiev_189'], pretty_number(round(1750 + 5000 * pow(1.35, $USER['achievement_fleet_6']))), pretty_number(round(750 + 3500 * pow(1.25, $USER['achievement_fleet_6'])))),
		'achievement_fleet_7_next' => sprintf($LNG['achiev_190'], pretty_number(round(500 + 8000 * pow(1.40, $USER['achievement_fleet_7']))), pretty_number(round(500 + 7000 * pow(1.40, $USER['achievement_fleet_7']))), pretty_number(round(500 + 6000 * pow(1.40, $USER['achievement_fleet_7'])))),
		'achievement_fleet_1_next_am' => pretty_number(round(200 * pow(1.05, $USER['achievement_fleet_1']))),
		'achievement_fleet_1_next_points' => pretty_number(round(100 * pow(1.05, $USER['achievement_fleet_1']))),
		'achievement_fleet_1_current_points' => pretty_number($USER['achievement_fleet_1_points']),
		'achievement_fleet_2_next_am' => pretty_number(round(225 * pow(1.05, $USER['achievement_fleet_2']))),
		'achievement_fleet_2_next_points' => pretty_number(round(100 * pow(1.05, $USER['achievement_fleet_2']))),
		'achievement_fleet_2_current_points' => pretty_number($USER['achievement_fleet_2_points']),
		'achievement_fleet_3_next_am' => pretty_number(round(275 * pow(1.10, $USER['achievement_fleet_3']))),
		'achievement_fleet_3_next_points' => pretty_number(round(125 * pow(1.10, $USER['achievement_fleet_3']))),
		'achievement_fleet_3_current_points' => pretty_number($USER['achievement_fleet_3_points']),
		'achievement_fleet_4_next_am' => pretty_number(round(275 * pow(1.10, $USER['achievement_fleet_4']))),
		'achievement_fleet_4_next_points' => pretty_number(round(135 * pow(1.10, $USER['achievement_fleet_4']))),
		'achievement_fleet_4_current_points' => pretty_number($USER['achievement_fleet_4_points']),
		'achievement_fleet_5_next_am' => pretty_number(round(325 * pow(1.10, $USER['achievement_fleet_5']))),
		'achievement_fleet_5_next_points' => pretty_number(round(165 * pow(1.10, $USER['achievement_fleet_5']))),
		'achievement_fleet_5_current_points' => pretty_number($USER['achievement_fleet_5_points']),
		'achievement_fleet_6_next_am' => pretty_number(round(450 * pow(1.10, $USER['achievement_fleet_6']))),
		'achievement_fleet_6_next_points' => pretty_number(round(175 * pow(1.10, $USER['achievement_fleet_6']))),
		'achievement_fleet_6_current_points' => pretty_number($USER['achievement_fleet_6_points']),
		'achievement_fleet_7_next_am' => pretty_number(round(400 * pow(1.10, $USER['achievement_fleet_7']))),
		'achievement_fleet_7_next_points' => pretty_number(round(200 * pow(1.10, $USER['achievement_fleet_7']))),
		'achievement_fleet_7_current_points' => pretty_number($USER['achievement_fleet_7_points']),
		'achievement_fleet_1_missing' => sprintf($LNG['achiev_191'], pretty_number(round(200000 + 35000 * pow(1.25, $USER['achievement_fleet_1'])) - $PLANET['light_hunter']), pretty_number(round(200000 + 35000 * pow(1.25, $USER['achievement_fleet_1'])) - $PLANET['heavy_hunter'])),
		'achievement_fleet_2_missing' => sprintf($LNG['achiev_192'], pretty_number(round(200000 + 20000 * pow(1.25, $USER['achievement_fleet_2'])) - $PLANET['crusher']), pretty_number(round(200000 + 20000 * pow(1.25, $USER['achievement_fleet_2'])) - $PLANET['battle_ship'])),
		'achievement_fleet_3_missing' => sprintf($LNG['achiev_193'], pretty_number(round(200000 * pow(2.05, $USER['achievement_fleet_3'])) - $PLANET['dearth_star']), pretty_number(round(200000 * pow(2.05, $USER['achievement_fleet_3'])) - $PLANET['battleship'])),
		'achievement_fleet_4_missing' => sprintf($LNG['achiev_194'], pretty_number(round(4000 * pow(2.05, $USER['achievement_fleet_4'])) - $PLANET['lune_noir']), pretty_number(round(20000 * pow(2.05, $USER['achievement_fleet_4'])) - $PLANET['galleon'])),
		'achievement_fleet_5_missing' => sprintf($LNG['achiev_195'], pretty_number(round(100000 * pow(2.05, $USER['achievement_fleet_5'])) - $PLANET['bomber_ship']), pretty_number(round(5000 * pow(2.05, $USER['achievement_fleet_5'])) - $PLANET['destroyer'])),
		'achievement_fleet_6_missing' => sprintf($LNG['achiev_196'], pretty_number(round(1750 + 5000 * pow(1.35, $USER['achievement_fleet_6'])) - $PLANET['frigate']), pretty_number(round(750 + 3500 * pow(1.25, $USER['achievement_fleet_6'])) - $PLANET['black_wanderer'])),
		'achievement_fleet_7_missing' => sprintf($LNG['achiev_197'], pretty_number(round(500 + 8000 * pow(1.40, $USER['achievement_fleet_7'])) - $PLANET['star_crasher']), pretty_number(round(500 + 7000 * pow(1.40, $USER['achievement_fleet_7'])) - $PLANET['flying_death']), pretty_number(round(500 + 6000 * pow(1.40, $USER['achievement_fleet_7'])) - $PLANET['bs_oneil'])),
		

		));
		$this->display('page.achievement.fleet.tpl');
		break;
		case 'tech':
		$this->assign(array(
		'achievement_point' => $USER['achievement_point']  + $USER['achievement_point_used'],
		'achievement_tech_1' => sprintf($LNG['achiev_105'], pretty_number($USER['achievement_tech_1'])),
		'achievement_tech_1_lvl' => pretty_number($USER['achievement_tech_1']),
		'achievement_tech_2' => sprintf($LNG['achiev_106'], pretty_number($USER['achievement_tech_2'])),
		'achievement_tech_2_lvl' => pretty_number($USER['achievement_tech_2']),
		'achievement_tech_3' => sprintf($LNG['achiev_107'], pretty_number($USER['achievement_tech_3'])),
		'achievement_tech_3_lvl' => pretty_number($USER['achievement_tech_3']),
		'achievement_tech_4' => sprintf($LNG['achiev_108'], pretty_number($USER['achievement_tech_4'])),
		'achievement_tech_4_lvl' => pretty_number($USER['achievement_tech_4']),
		'achievement_tech_5' => sprintf($LNG['achiev_109'], pretty_number($USER['achievement_tech_5'])),
		'achievement_tech_5_lvl' => pretty_number($USER['achievement_tech_5']),
		'achievement_tech_6' => sprintf($LNG['achiev_110'], pretty_number($USER['achievement_tech_6'])),
		'achievement_tech_6_lvl' => pretty_number($USER['achievement_tech_6']),
		'achievement_tech_7' => sprintf($LNG['achiev_111'], pretty_number($USER['achievement_tech_7'])),
		'achievement_tech_7_lvl' => pretty_number($USER['achievement_tech_7']),
		'achievement_tech_8' => sprintf($LNG['achiev_112'], pretty_number($USER['achievement_tech_8'])),
		'achievement_tech_8_lvl' => pretty_number($USER['achievement_tech_8']),
		'achievement_tech_9' => sprintf($LNG['achiev_113'], pretty_number($USER['achievement_tech_9'])),
		'achievement_tech_9_lvl' => pretty_number($USER['achievement_tech_9']),
		'achievement_tech_10' => sprintf($LNG['achiev_114'], pretty_number($USER['achievement_tech_10'])),
		'achievement_tech_10_lvl' => pretty_number($USER['achievement_tech_10']),
		'achievement_tech_1_next' => sprintf($LNG['achiev_115'], pretty_number(($USER['achievement_tech_1']*3) +3)),
		'achievement_tech_2_next' => sprintf($LNG['achiev_116'], pretty_number(($USER['achievement_tech_2']*3) +3)),
		'achievement_tech_3_next' => sprintf($LNG['achiev_117'], pretty_number(($USER['achievement_tech_3']*2) +2), pretty_number(($USER['achievement_tech_3']*2) +2), pretty_number(($USER['achievement_tech_3']*2) +2)),
		'achievement_tech_4_next' => sprintf($LNG['achiev_118'], pretty_number(($USER['achievement_tech_4']*4) +4)),
		'achievement_tech_5_next' => sprintf($LNG['achiev_119'], pretty_number(($USER['achievement_tech_5']*4) +4)),
		'achievement_tech_6_next' => sprintf($LNG['achiev_120'], pretty_number(($USER['achievement_tech_6']*2) +2), pretty_number(($USER['achievement_tech_6']*2) +2), pretty_number(($USER['achievement_tech_6']*2) +2)),
		'achievement_tech_7_next' => sprintf($LNG['achiev_121'], pretty_number(($USER['achievement_tech_7']*3) +3)),
		'achievement_tech_8_next' => sprintf($LNG['achiev_122'], pretty_number(($USER['achievement_tech_8']*2) +2)),
		'achievement_tech_9_next' => sprintf($LNG['achiev_123'], pretty_number(($USER['achievement_tech_9']*2) +2), pretty_number(($USER['achievement_tech_9']*2) +2), pretty_number(($USER['achievement_tech_9']*2) +2)),
		'achievement_tech_10_next' => sprintf($LNG['achiev_124'], pretty_number(($USER['achievement_tech_10']*2) +2), pretty_number(($USER['achievement_tech_10']*2) +2), pretty_number(($USER['achievement_tech_10']*2) +2)),
		'achievement_tech_1_next_am' => pretty_number(min(100000,round(70 * pow(1.30, $USER['achievement_tech_1'])))),
		'achievement_tech_1_next_points' => pretty_number(min(100000,round(55 * pow(1.30, $USER['achievement_tech_1'])))),
		'achievement_tech_1_current_points' => pretty_number($USER['achievement_tech_1_points']),
		'achievement_tech_2_next_am' => pretty_number(min(100000,round(70 * pow(1.30, $USER['achievement_tech_2'])))),
		'achievement_tech_2_next_points' => pretty_number(min(100000,round(55 * pow(1.30, $USER['achievement_tech_2'])))),
		'achievement_tech_2_current_points' => pretty_number($USER['achievement_tech_2_points']),
		'achievement_tech_3_next_am' => pretty_number(min(100000,round(20 * pow(1.30, $USER['achievement_tech_3'])))),
		'achievement_tech_3_next_points' => pretty_number(min(100000,round(15 * pow(1.30, $USER['achievement_tech_3'])))),
		'achievement_tech_3_current_points' => pretty_number($USER['achievement_tech_3_points']),
		'achievement_tech_4_next_am' => pretty_number(min(100000,round(65 * pow(1.55, $USER['achievement_tech_4'])))),
		'achievement_tech_4_next_points' => pretty_number(min(100000,round(45 * pow(1.55, $USER['achievement_tech_4'])))),
		'achievement_tech_4_current_points' => pretty_number($USER['achievement_tech_4_points']),
		'achievement_tech_5_next_am' => pretty_number(min(100000,round(35 * pow(1.40, $USER['achievement_tech_5'])))),
		'achievement_tech_5_next_points' => pretty_number(min(100000,round(25 * pow(1.40, $USER['achievement_tech_5'])))),
		'achievement_tech_5_current_points' => pretty_number($USER['achievement_tech_5_points']),
		'achievement_tech_6_next_am' => pretty_number(min(100000,round(45 * pow(1.40, $USER['achievement_tech_6'])))),
		'achievement_tech_6_next_points' => pretty_number(min(100000,round(30 * pow(1.40, $USER['achievement_tech_6'])))),
		'achievement_tech_6_current_points' => pretty_number($USER['achievement_tech_6_points']),
		'achievement_tech_7_next_am' => pretty_number(min(100000,round(30 * pow(1.45, $USER['achievement_tech_7'])))),
		'achievement_tech_7_next_points' => pretty_number(min(100000,round(20 * pow(1.45, $USER['achievement_tech_7'])))),
		'achievement_tech_7_current_points' => pretty_number($USER['achievement_tech_7_points']),
		'achievement_tech_8_next_am' => pretty_number(min(100000,round(15 * pow(1.30, $USER['achievement_tech_8'])))),
		'achievement_tech_8_next_points' => pretty_number(min(100000,round(10 * pow(1.30, $USER['achievement_tech_8'])))),
		'achievement_tech_8_current_points' => pretty_number($USER['achievement_tech_8_points']),
		'achievement_tech_9_next_am' => pretty_number(min(100000,round(25 * pow(1.40, $USER['achievement_tech_9'])))),
		'achievement_tech_9_next_points' => pretty_number(min(100000,round(20 * pow(1.40, $USER['achievement_tech_9'])))),
		'achievement_tech_9_current_points' => pretty_number($USER['achievement_tech_9_points']),
		'achievement_tech_10_next_am' => pretty_number(min(100000,round(20 * pow(1.30, $USER['achievement_tech_10'])))),
		'achievement_tech_10_next_points' => pretty_number(min(100000,round(13 * pow(1.30, $USER['achievement_tech_10'])))),
		'achievement_tech_10_current_points' => pretty_number($USER['achievement_tech_10_points']),
		'achievement_tech_1_missing' => sprintf($LNG['achiev_135'], pretty_number(($USER['achievement_tech_1']*3) +3 - $USER['spy_tech'])),
		'achievement_tech_2_missing' => sprintf($LNG['achiev_136'], pretty_number(($USER['achievement_tech_2']*3) +3 - $USER['computer_tech'])),
		'achievement_tech_3_missing' => sprintf($LNG['achiev_137'], pretty_number(($USER['achievement_tech_3']*2) +2 - $USER['military_tech']), pretty_number(($USER['achievement_tech_3']*2) +2 - $USER['defence_tech']), pretty_number(($USER['achievement_tech_3']*2) +2 - $USER['shield_tech'])),
		'achievement_tech_4_missing' => sprintf($LNG['achiev_138'], pretty_number(($USER['achievement_tech_4']*4) +4 - $USER['expedition_tech'])),
		'achievement_tech_5_missing' => sprintf($LNG['achiev_139'], pretty_number(($USER['achievement_tech_5']*4) +4 - $USER['graviton_tech'])),
		'achievement_tech_6_missing' => sprintf($LNG['achiev_140'], pretty_number(($USER['achievement_tech_6']*2) +2 - $USER['laser_tech']), pretty_number(($USER['achievement_tech_6']*2) +2 - $USER['ionic_tech']), pretty_number(($USER['achievement_tech_6']*2) +2 - $USER['buster_tech'])),
		'achievement_tech_7_missing' => sprintf($LNG['achiev_141'], pretty_number(($USER['achievement_tech_7']*3) +3 - $USER['energy_tech'])),
		'achievement_tech_8_missing' => sprintf($LNG['achiev_142'], pretty_number(($USER['achievement_tech_8']*2) +2 - $USER['brotherhood'])),
		'achievement_tech_9_missing' => sprintf($LNG['achiev_143'], pretty_number(($USER['achievement_tech_9']*2) +2 - $USER['combustion_tech']), pretty_number(($USER['achievement_tech_9']*2) +2 - $USER['impulse_motor_tech']), pretty_number(($USER['achievement_tech_9']*2) +2 - $USER['hyperspace_motor_tech'])),
		'achievement_tech_10_missing' => sprintf($LNG['achiev_144'], pretty_number(($USER['achievement_tech_10']*2) +2 - $USER['metal_proc_tech']), pretty_number(($USER['achievement_tech_10']*2) +2 - $USER['crystal_proc_tech']), pretty_number(($USER['achievement_tech_10']*2) +2 - $USER['deuterium_proc_tech'])),
		'achievement_tech_1_percent' => 100-(100/3*((($USER['achievement_tech_1']*3) +3) - $USER['spy_tech'])),
		'achievement_tech_2_percent' => 100-(100/3*((($USER['achievement_tech_2']*3) +3) - $USER['computer_tech'])),
		//'achievement_tech_3_percent' => 100-(100/3*((($USER['achievement_tech_3']*3) +3) - $USER['deuterium_sintetizer'])),
		'achievement_tech_4_percent' => 100-(100/4*((($USER['achievement_tech_4']*4) +4) - $USER['expedition_tech'])),
		'achievement_tech_5_percent' => 100-(100/4*((($USER['achievement_tech_5']*4) +4) - $USER['graviton_tech'])),
		//'achievement_tech_6_percent' => 100-(100/1*((($USER['achievement_tech_6']*1) +1) - $USER['heavy_conveyor'])),
		'achievement_tech_7_percent' => 100-(100/2*((($USER['achievement_tech_7']*3) +3) - $USER['energy_tech'])),
		'achievement_tech_8_percent' => 100-(100/2*((($USER['achievement_tech_8']*2) +2) - $USER['brotherhood'])),
		//'achievement_tech_9_percent' => 100-(100/2*((($USER['achievement_tech_9']*2) +2) - $USER['phalanx'])),
		//'achievement_tech_10_percent' => 100-(100/2*((($USER['achievement_tech_10']*2) +2) - $USER['terraformer'])),
		));
		$this->display('page.achievement.tech.tpl');
		break;
		case 'build':
		$this->assign(array(
		'achievement_point' => $USER['achievement_point']  + $USER['achievement_point_used'],
		'achievement_build_1' => sprintf($LNG['achiev_75'], pretty_number($USER['achievement_build_1'])),
		'achievement_build_1_lvl' => pretty_number($USER['achievement_build_1']),
		'achievement_build_2' => sprintf($LNG['achiev_76'], pretty_number($USER['achievement_build_2'])),
		'achievement_build_2_lvl' => pretty_number($USER['achievement_build_2']),
		'achievement_build_3' => sprintf($LNG['achiev_77'], pretty_number($USER['achievement_build_3'])),
		'achievement_build_3_lvl' => pretty_number($USER['achievement_build_3']),
		'achievement_build_4' => sprintf($LNG['achiev_78'], pretty_number($USER['achievement_build_4'])),
		'achievement_build_4_lvl' => pretty_number($USER['achievement_build_4']),
		'achievement_build_5' => sprintf($LNG['achiev_79'], pretty_number($USER['achievement_build_5'])),
		'achievement_build_5_lvl' => pretty_number($USER['achievement_build_5']),
		'achievement_build_6' => sprintf($LNG['achiev_80'], pretty_number($USER['achievement_build_6'])),
		'achievement_build_6_lvl' => pretty_number($USER['achievement_build_6']),
		'achievement_build_7' => sprintf($LNG['achiev_81'], pretty_number($USER['achievement_build_7'])),
		'achievement_build_7_lvl' => pretty_number($USER['achievement_build_7']),
		'achievement_build_8' => sprintf($LNG['achiev_82'], pretty_number($USER['achievement_build_8'])),
		'achievement_build_8_lvl' => pretty_number($USER['achievement_build_8']),
		'achievement_build_9' => sprintf($LNG['achiev_83'], pretty_number($USER['achievement_build_9'])),
		'achievement_build_9_lvl' => pretty_number($USER['achievement_build_9']),
		'achievement_build_10' => sprintf($LNG['achiev_84'], pretty_number($USER['achievement_build_10'])),
		'achievement_build_10_lvl' => pretty_number($USER['achievement_build_10']),
		'achievement_build_1_next' => sprintf($LNG['achiev_85'], pretty_number(($USER['achievement_build_1']*3) +3)),
		'achievement_build_2_next' => sprintf($LNG['achiev_86'], pretty_number(($USER['achievement_build_2']*3) +3)),
		'achievement_build_3_next' => sprintf($LNG['achiev_87'], pretty_number(($USER['achievement_build_3']*3) +3)),
		'achievement_build_4_next' => sprintf($LNG['achiev_88'], pretty_number(($USER['achievement_build_4']*1) +1)),
		'achievement_build_5_next' => sprintf($LNG['achiev_89'], pretty_number(($USER['achievement_build_5']*1) +1)),
		'achievement_build_6_next' => sprintf($LNG['achiev_90'], pretty_number(($USER['achievement_build_6']*1) +1)),
		'achievement_build_7_next' => sprintf($LNG['achiev_91'], pretty_number(($USER['achievement_build_7']*2) +2)),
		'achievement_build_8_next' => sprintf($LNG['achiev_92'], pretty_number(($USER['achievement_build_8']*2) +2)),
		'achievement_build_9_next' => sprintf($LNG['achiev_93'], pretty_number(($USER['achievement_build_9']*2) +2)),
		'achievement_build_10_next' => sprintf($LNG['achiev_94'], pretty_number(($USER['achievement_build_10']*2) +2)),
		'achievement_build_1_next_am' => pretty_number(min(100000,round(7 * pow(1.35, $USER['achievement_build_1'])))),
		'achievement_build_1_next_points' => pretty_number(min(100000,round(1 * pow(1.35, $USER['achievement_build_1'])))),
		'achievement_build_1_current_points' => pretty_number($USER['achievement_build_1_points']),
		'achievement_build_2_next_am' => pretty_number(min(100000,round(7 * pow(1.36, $USER['achievement_build_2'])))),
		'achievement_build_2_next_points' => pretty_number(min(100000,round(1 * pow(1.385, $USER['achievement_build_2'])))),
		'achievement_build_2_current_points' => pretty_number($USER['achievement_build_2_points']),
		'achievement_build_3_next_am' => pretty_number(min(100000,round(7 * pow(1.40, $USER['achievement_build_3'])))),
		'achievement_build_3_next_points' => pretty_number(min(100000,round(2 * pow(1.3834, $USER['achievement_build_3'])))),
		'achievement_build_3_current_points' => pretty_number($USER['achievement_build_3_points']),
		'achievement_build_4_next_am' => pretty_number(min(100000,round(28 * pow(1.15, $USER['achievement_build_4'])))),
		'achievement_build_4_next_points' => pretty_number(min(100000,round(3 * pow(1.342, $USER['achievement_build_4'])))),
		'achievement_build_4_current_points' => pretty_number($USER['achievement_build_4_points']),
		'achievement_build_5_next_am' => pretty_number(min(100000,round(31 * pow(1.16, $USER['achievement_build_5'])))),
		'achievement_build_5_next_points' => pretty_number(min(100000,round(3 * pow(1.371, $USER['achievement_build_5'])))),
		'achievement_build_5_current_points' => pretty_number($USER['achievement_build_5_points']),
		'achievement_build_6_next_am' => pretty_number(min(100000,round(33 * pow(1.17, $USER['achievement_build_6'])))),
		'achievement_build_6_next_points' => pretty_number(min(100000,round(3 * pow(1.41, $USER['achievement_build_6'])))),
		'achievement_build_6_current_points' => pretty_number($USER['achievement_build_6_points']),
		'achievement_build_7_next_am' => pretty_number(min(100000,round(80 * pow(1.55, $USER['achievement_build_7'])))),
		'achievement_build_7_next_points' => pretty_number(min(100000,round(30 * pow(1.55, $USER['achievement_build_7'])))),
		'achievement_build_7_current_points' => pretty_number($USER['achievement_build_7_points']),
		'achievement_build_8_next_am' => pretty_number(min(100000,round(35 * pow(1.30, $USER['achievement_build_8'])))),
		'achievement_build_8_next_points' => pretty_number(min(100000,round(6 * pow(1.315, $USER['achievement_build_8'])))),
		'achievement_build_8_current_points' => pretty_number($USER['achievement_build_8_points']),
		'achievement_build_9_next_am' => pretty_number(min(100000,round(80 * pow(1.40, $USER['achievement_build_9'])))),
		'achievement_build_9_next_points' => pretty_number(min(100000,round(8 * pow(1.40, $USER['achievement_build_9'])))),
		'achievement_build_9_current_points' => pretty_number($USER['achievement_build_9_points']),
		'achievement_build_10_next_am' => pretty_number(min(100000,round(40 * pow(1.30, $USER['achievement_build_10'])))),
		'achievement_build_10_next_points' => pretty_number(min(100000,round(7 * pow(1.315, $USER['achievement_build_10'])))),
		'achievement_build_10_current_points' => pretty_number($USER['achievement_build_10_points']),
		'achievement_build_1_missing' => sprintf($LNG['achiev_95'], pretty_number(($USER['achievement_build_1']*3) +3 - $PLANET['metal_mine'])),
		'achievement_build_2_missing' => sprintf($LNG['achiev_96'], pretty_number(($USER['achievement_build_2']*3) +3 - $PLANET['crystal_mine'])),
		'achievement_build_3_missing' => sprintf($LNG['achiev_97'], pretty_number(($USER['achievement_build_3']*3) +3 - $PLANET['deuterium_sintetizer'])),
		'achievement_build_4_missing' => sprintf($LNG['achiev_98'], pretty_number(($USER['achievement_build_4']*1) +1 - $PLANET['light_conveyor'])),
		'achievement_build_5_missing' => sprintf($LNG['achiev_99'], pretty_number(($USER['achievement_build_5']*1) +1 - $PLANET['medium_conveyor'])),
		'achievement_build_6_missing' => sprintf($LNG['achiev_100'], pretty_number(($USER['achievement_build_6']*1) +1 - $PLANET['heavy_conveyor'])),
		'achievement_build_7_missing' => sprintf($LNG['achiev_101'], pretty_number(($USER['achievement_build_7']*2) +2 - $PLANET['university'])),
		'achievement_build_8_missing' => sprintf($LNG['achiev_102'], pretty_number(($USER['achievement_build_8']*2) +2 - $PLANET['mondbasis'])),
		'achievement_build_9_missing' => sprintf($LNG['achiev_103'], pretty_number(($USER['achievement_build_9']*2) +2 - $PLANET['phalanx'])),
		'achievement_build_10_missing' => sprintf($LNG['achiev_104'], pretty_number(($USER['achievement_build_10']*2) +2 - $PLANET['terraformer'])),
		'achievement_build_1_percent' => 100-(100/3*((($USER['achievement_build_1']*3) +3) - $PLANET['metal_mine'])),
		'achievement_build_2_percent' => 100-(100/3*((($USER['achievement_build_2']*3) +3) - $PLANET['crystal_mine'])),
		'achievement_build_3_percent' => 100-(100/3*((($USER['achievement_build_3']*3) +3) - $PLANET['deuterium_sintetizer'])),
		'achievement_build_4_percent' => 100-(100/1*((($USER['achievement_build_4']*1) +1) - $PLANET['light_conveyor'])),
		'achievement_build_5_percent' => 100-(100/1*((($USER['achievement_build_5']*1) +1) - $PLANET['medium_conveyor'])),
		'achievement_build_6_percent' => 100-(100/1*((($USER['achievement_build_6']*1) +1) - $PLANET['heavy_conveyor'])),
		'achievement_build_7_percent' => 100-(100/2*((($USER['achievement_build_7']*2) +2) - $PLANET['university'])),
		'achievement_build_8_percent' => 100-(100/2*((($USER['achievement_build_8']*2) +2) - $PLANET['mondbasis'])),
		'achievement_build_9_percent' => 100-(100/2*((($USER['achievement_build_9']*2) +2) - $PLANET['phalanx'])),
		'achievement_build_10_percent' => 100-(100/2*((($USER['achievement_build_10']*2) +2) - $PLANET['terraformer'])),
		));
		$this->display('page.achievement.build.tpl');
		break;
		case 'daily':
		$this->assign(array(
		'achievement_point' => $USER['achievement_point']  + $USER['achievement_point_used'],
		'achievement_daily_1' => sprintf($LNG['achiev_47'], pretty_number($USER['achievement_daily_1'])),
		'achievement_daily_2' => sprintf($LNG['achiev_51'], pretty_number($USER['achievement_daily_2'])),
		'achievement_daily_3' => sprintf($LNG['achiev_53'], pretty_number($USER['achievement_daily_3'])),
		'achievement_daily_4' => sprintf($LNG['achiev_55'], pretty_number($USER['achievement_daily_4'])),
		'achievement_daily_5' => sprintf($LNG['achiev_58'], pretty_number($USER['achievement_daily_5'])),
		'achievement_daily_6' => sprintf($LNG['achiev_60'], pretty_number($USER['achievement_daily_6'])),
		'achievement_daily_7' => sprintf($LNG['achiev_62'], pretty_number($USER['achievement_daily_7'])),
		'achievement_daily_8' => sprintf($LNG['achiev_64'], pretty_number($USER['achievement_daily_8'])),
		'achievement_daily_1_next' => sprintf($LNG['achiev_37'], pretty_number(round(5 * pow(2.40, $USER['achievement_daily_1'])))),
		'achievement_daily_2_next' => sprintf($LNG['achiev_38'], pretty_number(round(5 * pow(2.40, $USER['achievement_daily_2'])))), //29
		'achievement_daily_3_next' => sprintf($LNG['achiev_39'], pretty_number(round(10 * pow(1.80, $USER['achievement_daily_3'])))),
		'achievement_daily_4_next' => sprintf($LNG['achiev_40'], pretty_number(round(7 * pow(1.80, $USER['achievement_daily_4'])))),
		'achievement_daily_5_next' => sprintf($LNG['achiev_41'], pretty_number(round(5 * pow(1.80, $USER['achievement_daily_5'])))),
		'achievement_daily_6_next' => sprintf($LNG['achiev_42'], pretty_number(round(10 * pow(2.40, $USER['achievement_daily_6'])))),
		'achievement_daily_7_next' => sprintf($LNG['achiev_43'], pretty_number(round(10 * pow(1.80, $USER['achievement_daily_7'])))),
		'achievement_daily_8_next' => sprintf($LNG['achiev_44'], pretty_number(round(8 * pow(1.80, $USER['achievement_daily_8'])))),
		'achievement_daily_1_next_am' => pretty_number(round(150 * pow(1.20, $USER['achievement_daily_1']))),
		'achievement_daily_1_next_points' => pretty_number(round(75 * pow(1.25, $USER['achievement_daily_1']))),
		'achievement_daily_1_next_m7' => pretty_number(round(11393924 * pow(1.30, $USER['achievement_daily_1']))),
		'achievement_daily_1_next_m19' => pretty_number(round(569696 * pow(1.30, $USER['achievement_daily_1']))),
		'achievement_daily_1_next_m32' => pretty_number(round(1470 * pow(1.30, $USER['achievement_daily_1']))),
		'achievement_daily_1_current_points' => pretty_number($USER['achievement_daily_1_points']),
		
		'achievement_daily_2_next_am' => pretty_number(round(100 * pow(1.25, $USER['achievement_daily_2']))),
		'achievement_daily_2_next_points' => pretty_number(round(50 * pow(1.30, $USER['achievement_daily_2']))),
		'achievement_daily_2_next_m7' => pretty_number(round(382359 * pow(1.40, $USER['achievement_daily_2']))),
		'achievement_daily_2_next_m19' => pretty_number(round(32353 * pow(1.40, $USER['achievement_daily_2']))),
		'achievement_daily_2_next_m32' => pretty_number(round(47 * pow(1.40, $USER['achievement_daily_2']))),
		'achievement_daily_2_next_upgrade' => pretty_number(round(1 * pow(1.10, $USER['achievement_daily_2']))),
		'achievement_daily_2_current_points' => pretty_number($USER['achievement_daily_2_points']),
		
		'achievement_daily_3_next_am' => pretty_number(round(75 * pow(1.15, $USER['achievement_daily_3']))),
		'achievement_daily_3_next_points' => pretty_number(round(15 * pow(1.15, $USER['achievement_daily_3']))),
		'achievement_daily_3_next_m7' => pretty_number(round(266968 * pow(1.40, $USER['achievement_daily_3']))),
		'achievement_daily_3_next_m19' => pretty_number(round(17798 * pow(1.40, $USER['achievement_daily_3']))),
		'achievement_daily_3_next_m32' => pretty_number(round(22 * pow(1.40, $USER['achievement_daily_3']))),
		'achievement_daily_3_current_points' => pretty_number($USER['achievement_daily_3_points']),
		
		'achievement_daily_4_next_am' => pretty_number(round(100 * pow(1.25, $USER['achievement_daily_4']))),
		'achievement_daily_4_next_points' => pretty_number(round(25 * pow(1.20, $USER['achievement_daily_4']))),
		'achievement_daily_4_next_m7' => pretty_number(round(1310720 * pow(1.40, $USER['achievement_daily_4']))),
		'achievement_daily_4_next_m19' => pretty_number(round(78643 * pow(1.40, $USER['achievement_daily_4']))),
		'achievement_daily_4_next_m32' => pretty_number(round(79 * pow(1.40, $USER['achievement_daily_4']))),
		'achievement_daily_4_current_points' => pretty_number($USER['achievement_daily_4_points']),
		
		'achievement_daily_5_next_am' => pretty_number(round(125 * pow(1.35, $USER['achievement_daily_5']))),
		'achievement_daily_5_next_points' => pretty_number(round(35 * pow(1.25, $USER['achievement_daily_5']))),
		'achievement_daily_5_next_m7' => pretty_number(round(5314410 * pow(1.30, $USER['achievement_daily_5']))),
		'achievement_daily_5_next_m19' => pretty_number(round(398581 * pow(1.30, $USER['achievement_daily_5']))),
		'achievement_daily_5_next_m32' => pretty_number(round(399 * pow(1.30, $USER['achievement_daily_5']))),
		'achievement_daily_5_current_points' => pretty_number($USER['achievement_daily_5_points']),
		
		'achievement_daily_6_next_am' => pretty_number(round(50 * pow(1.15, $USER['achievement_daily_6']))),
		'achievement_daily_6_next_points' => pretty_number(round(10 * pow(1.10, $USER['achievement_daily_6']))),
		'achievement_daily_6_next_m7' => pretty_number(round(117649 * pow(1.10, $USER['achievement_daily_6']))),
		'achievement_daily_6_next_m19' => pretty_number(round(5882 * pow(1.10, $USER['achievement_daily_6']))),
		'achievement_daily_6_next_m32' => pretty_number(round(9 * pow(1.10, $USER['achievement_daily_6']))),
		'achievement_daily_6_current_points' => pretty_number($USER['achievement_daily_6_points']),
		
		'achievement_daily_7_next_am' => pretty_number(round(75 * pow(1.30, $USER['achievement_daily_7']))),
		'achievement_daily_7_next_points' => pretty_number(round(20 * pow(1.20, $USER['achievement_daily_7']))),
		'achievement_daily_7_next_m7' => pretty_number(round(222473 * pow(1.50, $USER['achievement_daily_7']))),
		'achievement_daily_7_next_m19' => pretty_number(round(13348 * pow(1.50, $USER['achievement_daily_7']))),
		'achievement_daily_7_next_m32' => pretty_number(round(18 * pow(1.50, $USER['achievement_daily_7']))),
		'achievement_daily_7_current_points' => pretty_number($USER['achievement_daily_7_points']),
		
		'achievement_daily_8_next_am' => pretty_number(round(85 * pow(1.30, $USER['achievement_daily_8']))),
		'achievement_daily_8_next_points' => pretty_number(round(20 * pow(1.20, $USER['achievement_daily_8']))),
		'achievement_daily_8_next_m7' => pretty_number(round(1310720 * pow(1.40, $USER['achievement_daily_8']))),
		'achievement_daily_8_next_m19' => pretty_number(round(78643 * pow(1.40, $USER['achievement_daily_8']))),
		'achievement_daily_8_next_m32' => pretty_number(round(79 * pow(1.40, $USER['achievement_daily_8']))),
		'achievement_daily_8_current_points' => pretty_number($USER['achievement_daily_8_points']),
		'achievement_daily_1_missing' => sprintf($LNG['achiev_45'], pretty_number(round(5 * pow(2.40, $USER['achievement_daily_1'])) - $USER['achievement_daily_1_succes'])),
		'achievement_daily_2_missing' => sprintf($LNG['achiev_48'], pretty_number(round(5 * pow(2.40, $USER['achievement_daily_2'])) - $USER['achievement_daily_2_succes'])),
		'achievement_daily_3_missing' => sprintf($LNG['achiev_52'], pretty_number(round(10 * pow(1.80, $USER['achievement_daily_3'])) - $USER['achievement_daily_3_succes'])),
		'achievement_daily_4_missing' => sprintf($LNG['achiev_54'], pretty_number(round(7 * pow(1.80, $USER['achievement_daily_4'])) - $USER['achievement_daily_4_succes'])),
		'achievement_daily_5_missing' => sprintf($LNG['achiev_56'], pretty_number(round(5 * pow(1.80, $USER['achievement_daily_5'])) - $USER['achievement_daily_5_succes'])),
		'achievement_daily_6_missing' => sprintf($LNG['achiev_59'], pretty_number(round(10 * pow(2.40, $USER['achievement_daily_6'])) - $USER['achievement_daily_6_succes'])),
		'achievement_daily_7_missing' => sprintf($LNG['achiev_61'], pretty_number(round(10 * pow(1.80, $USER['achievement_daily_7'])) - $USER['achievement_daily_7_succes'])),
		'achievement_daily_8_missing' => sprintf($LNG['achiev_63'], pretty_number(round(8 * pow(1.80, $USER['achievement_daily_8'])) - $USER['achievement_daily_8_succes'])),
		'achievement_daily_1_percent' => 100-(100/round(5 * pow(2.40, $USER['achievement_daily_4']))*((round(5 * pow(2.40, $USER['achievement_daily_1']))) - $USER['achievement_daily_2_succes'])),
		'achievement_daily_2_percent' => 100-(100/round(5 * pow(2.40, $USER['achievement_daily_2']))*((round(5 * pow(2.40, $USER['achievement_daily_2']))) - $USER['achievement_daily_2_succes'])),
		'achievement_daily_3_percent' => 100-(100/10*((($USER['achievement_common_1']*10) +10) - $USER['achievement_daily_3_succes'])),
		'achievement_daily_4_percent' => 100-(100/7*((($USER['achievement_common_1']*7) +7) - $USER['achievement_daily_4_succes'])),
		'achievement_daily_5_percent' => 100-(100/5*((($USER['achievement_common_1']*5) +5) - $USER['achievement_daily_5_succes'])),
		'achievement_daily_6_percent' => 100-(100/10*((($USER['achievement_common_1']*10) +10) - $USER['achievement_daily_6_succes'])),
		'achievement_daily_7_percent' => 100-(100/10*((($USER['achievement_common_1']*10) +10) - $USER['achievement_daily_7_succes'])),
		'achievement_daily_8_percent' => 100-(100/8*((($USER['achievement_common_1']*8) +8) - $USER['achievement_daily_8_succes'])),
		));
		$this->display('page.achievement.daily.tpl');
		break;
		case 'general':
		default:
		$this->assign(array(
		'achievement_point' => $USER['achievement_point']  + $USER['achievement_point_used'],
		'achievement_common_1' => sprintf($LNG['achiev_18'], pretty_number($USER['achievement_common_1'])),
		'achievement_common_2' => sprintf($LNG['achiev_20'], pretty_number($USER['achievement_common_2'])),
		'achievement_common_1_next' => sprintf($LNG['achiev_17'], pretty_number(($USER['achievement_common_1']*5) +5)),
		'achievement_common_2_next' => sprintf($LNG['achiev_24'], pretty_number(($USER['achievement_common_2']*5) +5)),
		'achievement_common_1_next_am' => pretty_number(round(200 * pow(1.08, $USER['achievement_common_1']))),
		'achievement_common_1_next_points' => pretty_number(round(100 * pow(1.08, $USER['achievement_common_1']))),
		'achievement_common_1_current_points' => pretty_number($USER['achievement_common_1_points']),
		'achievement_common_2_next_am' => pretty_number(round(400 * pow(1.09, $USER['achievement_common_2']))),
		'achievement_common_2_next_points' => pretty_number(round(200 * pow(1.09, $USER['achievement_common_2']))),
		'achievement_common_2_current_points' => pretty_number($USER['achievement_common_2_points']),
		'achievement_common_1_missing' => sprintf($LNG['achiev_11'], pretty_number(($USER['achievement_common_1']*5) +5 - $USER['peacefull_exp_level'])),
		'achievement_common_2_missing' => sprintf($LNG['achiev_19'], pretty_number(($USER['achievement_common_2']*5) +5 - $USER['combat_exp_level'])),
		'achievement_common_1_percent' => 100-(100/5*((($USER['achievement_common_1']*5) +5) - $USER['peacefull_exp_level'])),
		'achievement_common_2_percent' => 100-(100/5*((($USER['achievement_common_2']*5) +5) - $USER['combat_exp_level'])),
		));
		$this->display('page.achievement.default.tpl');
		break;
		}
		
	}
	
	
}