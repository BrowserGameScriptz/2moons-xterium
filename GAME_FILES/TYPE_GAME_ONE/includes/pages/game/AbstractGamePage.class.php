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

abstract class AbstractGamePage
{
	/**
	 * reference of the template object
	 * @var template
	 */
	protected $tplObj;

	/**
	 * reference of the template object
	 * @var ResourceUpdate
	 */
	protected $ecoObj;
	protected $window;
	protected $disableEcoSystem = false;

	protected function __construct() {

		if(!AJAX_REQUEST)
		{
			$this->setWindow('full');
			if(!$this->disableEcoSystem)
			{
				$this->ecoObj	= new ResourceUpdate();
				$this->ecoObj->CalcResource();
			}
			$this->initTemplate();
		} else {
			$this->setWindow('ajax');

		}
	}

	protected function initTemplate() {
		if(isset($this->tplObj))
			return true;

		$this->tplObj	= new template;
		list($tplDir)	= $this->tplObj->getTemplateDir();
		$this->tplObj->setTemplateDir($tplDir.'game/');
		return true;
	}

	protected function setWindow($window) {
		$this->window	= $window;
	}

	protected function getWindow() {
		return $this->window;
	}

	protected function getQueryString() {
		$queryString	= array();
		$page			= HTTP::_GP('page', '');

		if(!empty($page)) {
			$queryString['page']	= $page;
		}

		$mode			= HTTP::_GP('mode', '');
		if(!empty($mode)) {
			$queryString['mode']	= $mode;
		}

		return http_build_query($queryString);
	}

	protected function getCronjobsTodo()
	{
		require_once 'includes/classes/Cronjob.class.php';

		$this->assign(array(
			'cronjobs'		=> Cronjob::getNeedTodoExecutedJobs()
		));
	}
		
	protected function Achievements()
	{
		global $USER, $THEME, $LNG;
		
		//ACHIEVEMENT COMMON PEACE
		if ($USER['peacefull_exp_level'] >= (5 * $USER['achievement_common_1']) + 5){
			$peace_reward_am = 200;
			$peace_reward_points = 100;
			$next_am_peace = min(100000,round($peace_reward_am * pow(1.08, $USER['achievement_common_1'])));
			$next_points_peace = min(100000,round($peace_reward_points * pow(1.08, $USER['achievement_common_1'])));
			$next_level = $USER['achievement_common_1'] + 1;
			$sql	= "UPDATE %%USERS%% SET achievement_common_1 = achievement_common_1 + :achievement_common_1, achievement_common_1_points = achievement_common_1_points + :achievement_common_1_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_common_1'	=> 1,
				':achievement_common_1_points'	=> $next_points_peace,
				':achievement_point'	=> $next_points_peace,
				':antimatter'	=> $next_am_peace,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=general#ach_level"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_level.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_18'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($next_am_peace).' '.$LNG['tech'][922].' <br> '.pretty_number($next_points_peace).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT COMMON COMBAT
		if ($USER['combat_exp_level'] >= (5 * $USER['achievement_common_2']) + 5){
			$combat_reward_am = 400;
			$combat_reward_points = 200;
			$next_am_combat = min(100000,round($combat_reward_am * pow(1.09, $USER['achievement_common_2'])));
			$next_points_combat = min(100000,round($combat_reward_points * pow(1.09, $USER['achievement_common_2'])));
			$next_level = $USER['achievement_common_2'] + 1;
			$sql	= "UPDATE %%USERS%% SET achievement_common_2 = achievement_common_2 + :achievement_common_2, achievement_common_2_points = achievement_common_2_points + :achievement_common_2_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_common_2'	=> 1,
				':achievement_common_2_points'	=> $next_points_combat,
				':achievement_point'	=> $next_points_combat,
				':antimatter'	=> $next_am_combat,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=general#ach_batle_level"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_batle_level.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_20'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($next_am_combat).' '.$LNG['tech'][922].' <br> '.pretty_number($next_points_combat).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT BUILD METAL
		$sql	= 'SELECT metal_mine FROM %%PLANETS%% WHERE id_owner = :id_owner ORDER BY metal_mine DESC LIMIT :limit';
		$onlineDatas	= Database::get()->selectSingle($sql, array(
			':id_owner'	=> $USER['id'],
			':limit'	=> 1
		));
		if ($onlineDatas['metal_mine'] >= (3 * $USER['achievement_build_1']) + 3){
			$metal_reward_am = 7;
			$metal_reward_points = 1;
			$next_level = $USER['achievement_build_1'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.35, $USER['achievement_build_1'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.35, $USER['achievement_build_1'])));
			$sql	= "UPDATE %%USERS%% SET achievement_build_1 = achievement_build_1 + :achievement_build_1, achievement_build_1_points = achievement_build_1_points + :achievement_build_1_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_build_1'	=> 1,
				':achievement_build_1_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=build#ach_mine_metal"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_mine_metal.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_75'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT BUILD CRYSTAL
		$sql	= 'SELECT crystal_mine FROM %%PLANETS%% WHERE id_owner = :id_owner ORDER BY crystal_mine DESC LIMIT :limit';
		$onlineDatas	= Database::get()->selectSingle($sql, array(
			':id_owner'	=> $USER['id'],
			':limit'	=> 1
		));
		if ($onlineDatas['crystal_mine'] >= (3 * $USER['achievement_build_2']) + 3){
			$metal_reward_am = 7;
			$metal_reward_points = 1;
			$next_level = $USER['achievement_build_2'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.36, $USER['achievement_build_2'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.385, $USER['achievement_build_2'])));
			$sql	= "UPDATE %%USERS%% SET achievement_build_2 = achievement_build_2 + :achievement_build_2, achievement_build_2_points = achievement_build_2_points + :achievement_build_2_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_build_2'	=> 1,
				':achievement_build_2_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=build#ach_crystal_mine"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_crystal_mine.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_76'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT BUILD DEUTERIUM
		$sql	= 'SELECT deuterium_sintetizer FROM %%PLANETS%% WHERE id_owner = :id_owner ORDER BY deuterium_sintetizer DESC LIMIT :limit';
		$onlineDatas	= Database::get()->selectSingle($sql, array(
			':id_owner'	=> $USER['id'],
			':limit'	=> 1
		));
		if ($onlineDatas['deuterium_sintetizer'] >= (3 * $USER['achievement_build_3']) + 3){
			$metal_reward_am = 7;
			$metal_reward_points = 2;
			$next_level = $USER['achievement_build_3'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.40, $USER['achievement_build_3'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.3834, $USER['achievement_build_3'])));
			$sql	= "UPDATE %%USERS%% SET achievement_build_3 = achievement_build_3 + :achievement_build_3, achievement_build_3_points = achievement_build_3_points + :achievement_build_3_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_build_3'	=> 1,
				':achievement_build_3_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=build#ach_deuterium_sintetizer"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_deuterium_sintetizer.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_77'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT BUILD LIGHT CONV
		$sql	= 'SELECT light_conveyor FROM %%PLANETS%% WHERE id_owner = :id_owner ORDER BY light_conveyor DESC LIMIT :limit';
		$onlineDatas	= Database::get()->selectSingle($sql, array(
			':id_owner'	=> $USER['id'],
			':limit'	=> 1
		));
		if ($onlineDatas['light_conveyor'] >= (1 * $USER['achievement_build_4']) + 1){
			$metal_reward_am = 28;
			$metal_reward_points = 3;
			$next_level = $USER['achievement_build_4'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.15, $USER['achievement_build_4'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.342, $USER['achievement_build_4'])));
			$sql	= "UPDATE %%USERS%% SET achievement_build_4 = achievement_build_4 + :achievement_build_4, achievement_build_4_points = achievement_build_4_points + :achievement_build_4_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_build_4'	=> 1,
				':achievement_build_4_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=build#ach_conveyor1"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_conveyor1.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_78'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT BUILD MEDIUM CONV
		$sql	= 'SELECT medium_conveyor FROM %%PLANETS%% WHERE id_owner = :id_owner ORDER BY medium_conveyor DESC LIMIT :limit';
		$onlineDatas	= Database::get()->selectSingle($sql, array(
			':id_owner'	=> $USER['id'],
			':limit'	=> 1
		));
		if ($onlineDatas['medium_conveyor'] >= (1 * $USER['achievement_build_5']) + 1){
			$metal_reward_am = 31;
			$metal_reward_points = 3;
			$next_level = $USER['achievement_build_5'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.16, $USER['achievement_build_5'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.371, $USER['achievement_build_5'])));
			$sql	= "UPDATE %%USERS%% SET achievement_build_5 = achievement_build_5 + :achievement_build_5, achievement_build_5_points = achievement_build_5_points + :achievement_build_5_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_build_5'	=> 1,
				':achievement_build_5_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=build#ach_conveyor2"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_conveyor2.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_79'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT BUILD HEAVY CONV
		$sql	= 'SELECT heavy_conveyor FROM %%PLANETS%% WHERE id_owner = :id_owner ORDER BY heavy_conveyor DESC LIMIT :limit';
		$onlineDatas	= Database::get()->selectSingle($sql, array(
			':id_owner'	=> $USER['id'],
			':limit'	=> 1
		));
		if ($onlineDatas['heavy_conveyor'] >= (1 * $USER['achievement_build_6']) + 1){
			$metal_reward_am = 33;
			$metal_reward_points = 3;
			$next_level = $USER['achievement_build_6'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.17, $USER['achievement_build_6'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.41, $USER['achievement_build_6'])));
			$sql	= "UPDATE %%USERS%% SET achievement_build_6 = achievement_build_6 + :achievement_build_6, achievement_build_6_points = achievement_build_6_points + :achievement_build_6_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_build_6'	=> 1,
				':achievement_build_6_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=build#ach_conveyor3"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_conveyor3.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_80'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT BUILD UNIVERSITY
		$sql	= 'SELECT university FROM %%PLANETS%% WHERE id_owner = :id_owner ORDER BY university DESC LIMIT :limit';
		$onlineDatas	= Database::get()->selectSingle($sql, array(
			':id_owner'	=> $USER['id'],
			':limit'	=> 1
		));
		if ($onlineDatas['university'] >= (2 * $USER['achievement_build_7']) + 2){
			$metal_reward_am = 80;
			$metal_reward_points = 30;
			$next_level = $USER['achievement_build_7'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.55, $USER['achievement_build_7'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.55, $USER['achievement_build_7'])));
			$sql	= "UPDATE %%USERS%% SET achievement_build_7 = achievement_build_7 + :achievement_build_7, achievement_build_7_points = achievement_build_7_points + :achievement_build_7_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_build_7'	=> 1,
				':achievement_build_7_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=build#ach_university"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_university.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_81'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT BUILD LUNAR
		$sql	= 'SELECT mondbasis FROM %%PLANETS%% WHERE id_owner = :id_owner ORDER BY mondbasis DESC LIMIT :limit';
		$onlineDatas	= Database::get()->selectSingle($sql, array(
			':id_owner'	=> $USER['id'],
			':limit'	=> 1
		));
		if ($onlineDatas['mondbasis'] >= (2 * $USER['achievement_build_8']) + 2){
			$metal_reward_am = 35;
			$metal_reward_points = 6;
			$next_level = $USER['achievement_build_8'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.30, $USER['achievement_build_8'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.315, $USER['achievement_build_8'])));
			$sql	= "UPDATE %%USERS%% SET achievement_build_8 = achievement_build_8 + :achievement_build_8, achievement_build_8_points = achievement_build_8_points + :achievement_build_8_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_build_8'	=> 1,
				':achievement_build_8_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=build#ach_mondbasis"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_mondbasis.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_82'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT BUILD PHAKANX
		$sql	= 'SELECT phalanx FROM %%PLANETS%% WHERE id_owner = :id_owner ORDER BY phalanx DESC LIMIT :limit';
		$onlineDatas	= Database::get()->selectSingle($sql, array(
			':id_owner'	=> $USER['id'],
			':limit'	=> 1
		));
		if ($onlineDatas['phalanx'] >= (2 * $USER['achievement_build_9']) + 2){
			$metal_reward_am = 80;
			$metal_reward_points = 8;
			$next_level = $USER['achievement_build_9'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.40, $USER['achievement_build_9'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.40, $USER['achievement_build_9'])));
			$sql	= "UPDATE %%USERS%% SET achievement_build_9 = achievement_build_9 + :achievement_build_9, achievement_build_9_points = achievement_build_9_points + :achievement_build_9_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_build_9'	=> 1,
				':achievement_build_9_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=build#ach_phalanx"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_phalanx.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_83'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT BUILD TERRAFORMER
		$sql	= 'SELECT terraformer FROM %%PLANETS%% WHERE id_owner = :id_owner ORDER BY terraformer DESC LIMIT :limit';
		$onlineDatas	= Database::get()->selectSingle($sql, array(
			':id_owner'	=> $USER['id'],
			':limit'	=> 1
		));
		if ($onlineDatas['terraformer'] >= (2 * $USER['achievement_build_10']) + 2){
			$metal_reward_am = 40;
			$metal_reward_points = 7;
			$next_level = $USER['achievement_build_10'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.30, $USER['achievement_build_10'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.315, $USER['achievement_build_10'])));
			$sql	= "UPDATE %%USERS%% SET achievement_build_10 = achievement_build_10 + :achievement_build_10, achievement_build_10_points = achievement_build_10_points + :achievement_build_10_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_build_10'	=> 1,
				':achievement_build_10_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=build#ach_terraformer"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_terraformer.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_84'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		
		//ACHIEVEMENT TECH SPY
		if ($USER['spy_tech'] >= (3 * $USER['achievement_tech_1']) + 3){
			$metal_reward_am = 70;
			$metal_reward_points = 55;
			$next_level = $USER['achievement_tech_1'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.30, $USER['achievement_tech_1'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.30, $USER['achievement_tech_1'])));
			$sql	= "UPDATE %%USERS%% SET achievement_tech_1 = achievement_tech_1 + :achievement_tech_1, achievement_tech_1_points = achievement_tech_1_points + :achievement_tech_1_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_tech_1'	=> 1,
				':achievement_tech_1_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=tech#ach_spy_tech"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_spy_tech.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_105'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT TECH COMPUTER
		if ($USER['computer_tech'] >= (3 * $USER['achievement_tech_2']) + 3){
			$metal_reward_am = 70;
			$metal_reward_points = 55;
			$next_level = $USER['achievement_tech_2'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.30, $USER['achievement_tech_2'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.30, $USER['achievement_tech_2'])));
			$sql	= "UPDATE %%USERS%% SET achievement_tech_2 = achievement_tech_2 + :achievement_tech_2, achievement_tech_2_points = achievement_tech_2_points + :achievement_tech_2_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_tech_2'	=> 1,
				':achievement_tech_2_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=tech#ach_computer_tech"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_computer_tech.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_106'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT TECH COMBAT TECH
		if ($USER['military_tech'] >= (2 * $USER['achievement_tech_3']) + 2 && $USER['defence_tech'] >= (2 * $USER['achievement_tech_3']) + 2 && $USER['shield_tech'] >= (2 * $USER['achievement_tech_3']) + 2){
			$metal_reward_am = 20;
			$metal_reward_points = 15;
			$next_level = $USER['achievement_tech_3'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.30, $USER['achievement_tech_3'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.30, $USER['achievement_tech_3'])));
			$sql	= "UPDATE %%USERS%% SET achievement_tech_3 = achievement_tech_3 + :achievement_tech_3, achievement_tech_3_points = achievement_tech_3_points + :achievement_tech_3_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_tech_3'	=> 1,
				':achievement_tech_3_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=tech#ach_war_tech"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_war_tech.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_107'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT TECH EXPEDITION
		if ($USER['expedition_tech'] >= (4 * $USER['achievement_tech_4']) + 4){
			$metal_reward_am = 65;
			$metal_reward_points = 45;
			$next_level = $USER['achievement_tech_4'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.55, $USER['achievement_tech_4'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.55, $USER['achievement_tech_4'])));
			$sql	= "UPDATE %%USERS%% SET achievement_tech_4 = achievement_tech_4 + :achievement_tech_4, achievement_tech_4_points = achievement_tech_4_points + :achievement_tech_4_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_tech_4'	=> 1,
				':achievement_tech_4_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']

			));
			$msg = '<a href="game.php?page=achievement&amp;group=tech#ach_expedition_tech"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_expedition_tech.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_108'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT TECH GRAVITON
		if ($USER['graviton_tech'] >= (4 * $USER['achievement_tech_5']) + 4 && $USER['achievement_tech_5'] < 20){
			$metal_reward_am = 35;
			$metal_reward_points = 25;
			$next_level = $USER['achievement_tech_5'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.40, $USER['achievement_tech_5'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.40, $USER['achievement_tech_5'])));
			$sql	= "UPDATE %%USERS%% SET achievement_tech_5 = achievement_tech_5 + :achievement_tech_5, achievement_tech_5_points = achievement_tech_5_points + :achievement_tech_5_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_tech_5'	=> 1,
				':achievement_tech_5_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']
			));
			$msg = '<a href="game.php?page=achievement&amp;group=tech#ach_gravity_tech"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_gravity_tech.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_109'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT TECH GUNS
		if ($USER['laser_tech'] >= (2 * $USER['achievement_tech_6']) + 2 && $USER['ionic_tech'] >= (2 * $USER['achievement_tech_6']) + 2 && $USER['buster_tech'] >= (2 * $USER['achievement_tech_6']) + 2){
			$metal_reward_am = 45;
			$metal_reward_points = 30;
			$next_level = $USER['achievement_tech_6'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.40, $USER['achievement_tech_6'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.40, $USER['achievement_tech_6'])));
			$sql	= "UPDATE %%USERS%% SET achievement_tech_6 = achievement_tech_6 + :achievement_tech_6, achievement_tech_6_points = achievement_tech_6_points + :achievement_tech_6_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_tech_6'	=> 1,
				':achievement_tech_6_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']
			));
			$msg = '<a href="game.php?page=achievement&amp;group=tech#ach_gun_tech"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_gun_tech.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_110'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT TECH ENERGY
		if ($USER['energy_tech'] >= (3 * $USER['achievement_tech_7']) + 3){
			$metal_reward_am = 30;
			$metal_reward_points = 20;
			$next_level = $USER['achievement_tech_7'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.45, $USER['achievement_tech_7'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.45, $USER['achievement_tech_7'])));
			$sql	= "UPDATE %%USERS%% SET achievement_tech_7 = achievement_tech_7 + :achievement_tech_7, achievement_tech_7_points = achievement_tech_7_points + :achievement_tech_7_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_tech_7'	=> 1,
				':achievement_tech_7_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']
			));
			$msg = '<a href="game.php?page=achievement&amp;group=tech#ach_energy_tech"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_energy_tech.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_111'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT TECH BROTHERHOOD
		if ($USER['brotherhood'] >= (2 * $USER['achievement_tech_8']) + 2){
			$metal_reward_am = 15;
			$metal_reward_points = 10;
			$next_level = $USER['achievement_tech_8'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.30, $USER['achievement_tech_8'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.30, $USER['achievement_tech_8'])));
			$sql	= "UPDATE %%USERS%% SET achievement_tech_8 = achievement_tech_8 + :achievement_tech_8, achievement_tech_8_points = achievement_tech_8_points + :achievement_tech_8_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_tech_8'	=> 1,
				':achievement_tech_8_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']
			));
			$msg = '<a href="game.php?page=achievement&amp;group=tech#ach_bank_ally_tech"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_bank_ally_tech.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_112'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT TECH SPEED
		if ($USER['combustion_tech'] >= (2 * $USER['achievement_tech_9']) + 2 && $USER['impulse_motor_tech'] >= (2 * $USER['achievement_tech_9']) + 2 && $USER['hyperspace_motor_tech'] >= (2 * $USER['achievement_tech_9']) + 2){
			$metal_reward_am = 25;
			$metal_reward_points = 20;
			$next_level = $USER['achievement_tech_9'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.40, $USER['achievement_tech_9'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.40, $USER['achievement_tech_9'])));
			$sql	= "UPDATE %%USERS%% SET achievement_tech_9 = achievement_tech_9 + :achievement_tech_9, achievement_tech_9_points = achievement_tech_9_points + :achievement_tech_9_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_tech_9'	=> 1,
				':achievement_tech_9_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']
			));
			$msg = '<a href="game.php?page=achievement&amp;group=tech#ach_motor_tech"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_motor_tech.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_113'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		//ACHIEVEMENT TECH PROD
		if ($USER['metal_proc_tech'] >= (2 * $USER['achievement_tech_10']) + 2 && $USER['crystal_proc_tech'] >= (2 * $USER['achievement_tech_10']) + 2 && $USER['deuterium_proc_tech'] >= (2 * $USER['achievement_tech_10']) + 2){
			$metal_reward_am = 20;
			$metal_reward_points = 13;
			$next_level = $USER['achievement_tech_10'] + 1;
			$metal_reward_am = min(100000,round($metal_reward_am * pow(1.30, $USER['achievement_tech_10'])));
			$metal_reward_points = min(100000,round($metal_reward_points * pow(1.30, $USER['achievement_tech_10'])));
			$sql	= "UPDATE %%USERS%% SET achievement_tech_10 = achievement_tech_10 + :achievement_tech_10, achievement_tech_10_points = achievement_tech_10_points + :achievement_tech_10_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_tech_10'	=> 1,
				':achievement_tech_10_points'	=> $metal_reward_points,
				':achievement_point'	=> $metal_reward_points,
				':antimatter'	=> $metal_reward_am,
				':userId'				=> $USER['id']
			));
			$msg = '<a href="game.php?page=achievement&amp;group=tech#ach_mining_tech"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_mining_tech.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_114'], pretty_number($next_level)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($metal_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($metal_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($USER['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		//END
		
	}
	protected function Experience()
	{
		global $USER, $THEME;
		
		$config			= Config::get();
		$db = Database::get();
		//PEACEFULL EXPERIECE AND BONUS
		if ($USER['peacefull_exp_current'] >= $USER['peacefull_exp_max']){
			$new_peace_experience =  $USER['peacefull_exp_current'] - $USER['peacefull_exp_max'];
			$new_peace_experience_max =  $USER['peacefull_exp_max'] + 1450/2 ;
			$sql	= "UPDATE %%USERS%% SET peacefull_exp_current = :new_peace_experience, peacefull_exp_max = :new_peace_experience_max, peacefull_exp_level = peacefull_exp_level + 1, academy_p = academy_p + :academy_p WHERE id = :userId;";
			$db->update($sql, array(
				':new_peace_experience'			=> $new_peace_experience,
				':new_peace_experience_max'	=> $new_peace_experience_max,
				':academy_p'					=> $USER['peacefull_exp_level'],
				':userId'						=> $USER['id']
			));
			if (($USER['peacefull_exp_level'] + 1) == ($USER['peacefull_exp_slots'] * 10) + 10  ){
				$sql	= "UPDATE %%USERS%% SET peacefull_exp_slots = peacefull_exp_slots + :peacefull_exp_slots WHERE id = :userId;";
				$db->update($sql, array(
					':peacefull_exp_slots'				=> 1,
					':userId'						=> $USER['id']
				));
			}
			if (($USER['peacefull_exp_level'] + 1) == ($USER['peacefull_exp_mission'] * 20) + 20  ){
				$sql	= "UPDATE %%USERS%% SET peacefull_exp_mission = peacefull_exp_mission + :peacefull_exp_mission WHERE id = :userId;";
				$db->update($sql, array(
					':peacefull_exp_mission'				=> 5,
					':userId'						=> $USER['id']
				));
			}
			if (($USER['peacefull_exp_level'] + 1) == ($USER['peacefull_exp_moonshot'] * 15) + 20  ){
				$sql	= "UPDATE %%USERS%% SET peacefull_exp_moonshot = peacefull_exp_moonshot + :peacefull_exp_moonshot WHERE id = :userId;";
				$db->update($sql, array(
					':peacefull_exp_moonshot'				=> 2,
					':userId'						=> $USER['id']
				));
			}
			if (($USER['peacefull_exp_level'] + 1) == ($USER['peacefull_exp_light'] * 10) + 20  ){
				$sql	= "UPDATE %%USERS%% SET peacefull_exp_light = peacefull_exp_light + :peacefull_exp_light WHERE id = :userId;";
				$db->update($sql, array(
					':peacefull_exp_light'				=> 1,
					':userId'						=> $USER['id']
				));
			}
			if (($USER['peacefull_exp_level'] + 1) == ($USER['peacefull_exp_medium'] * 10) + 30  ){
				$sql	= "UPDATE %%USERS%% SET peacefull_exp_medium = peacefull_exp_medium + :peacefull_exp_medium WHERE id = :userId;";
				$db->update($sql, array(
					':peacefull_exp_medium'				=> 1,
					':userId'						=> $USER['id']
				));
			}
			if (($USER['peacefull_exp_level'] + 1) == ($USER['peacefull_exp_heavy'] * 10) + 40  ){
				$sql	= "UPDATE %%USERS%% SET peacefull_exp_heavy = peacefull_exp_heavy + :peacefull_exp_heavy WHERE id = :userId;";
				$db->update($sql, array(
					':peacefull_exp_heavy'				=> 1,
					':userId'						=> $USER['id']
				));
			}
		}
		if($USER['urlaubs_modus'] == 0 && $USER['onlinetime'] > TIMESTAMP - 3 * 60 || $USER['peacefull_last_update'] == 0){
			$premium_leveling = 0;
			if($USER['prem_leveling'] > 0 && $USER['prem_leveling_days'] > TIMESTAMP){
				$premium_leveling = $USER['prem_leveling'];
			}
			
			$premium_admin = 1;
			if($config->peacefullExp > 0){
				$premium_admin = $config->peacefullExp;
			}
			
			$ally_fraction_peace_exp = 0;
			if($USER['ally_id'] != 0){
				$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
				$ALLIANCE = Database::get()->selectSingle($sql, array(
					':allyID'	=> $USER['ally_id']
				));
				if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
					$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
					$FRACTIONS = Database::get()->selectSingle($sql, array(
						':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
					));
					$ally_fraction_peace_exp = $FRACTIONS['ally_fraction_peace_exp'] * $ALLIANCE['ally_fraction_level'];
				}
			}
			
			$ProductionTime  			= (TIMESTAMP - $USER['peacefull_last_update']);
			$expProd = $ProductionTime * 3600 / (3600 + 210 * $USER['peacefull_exp_level']);	
			//$expProd += ($expProd / 100 * $premium_leveling) + ($expProd * $premium_admin);		
			$expProd += ($expProd / 100 * $premium_leveling) + ($expProd * $premium_admin) + ($expProd / 100 * $ally_fraction_peace_exp);	

			if(config::get(ROOT_UNI)->happyHourEvent == 1 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
				$expProd = $expProd * config::get()->happyHourBonus;
			
			if($expProd > 0 && $USER['onlinetime'] > TIMESTAMP - 3 * 60){
				$sql	= "UPDATE %%USERS%% SET peacefull_exp_current = peacefull_exp_current + :peacefull_exp_current, peacefull_last_update = :peacefull_last_update WHERE id = :userId;";
				$db->update($sql, array(
					':peacefull_exp_current'				=> $expProd,
					':peacefull_last_update'				=> TIMESTAMP,
					':userId'						=> $USER['id']
				));
			}
		}else{
			$sql	= "UPDATE %%USERS%% SET peacefull_last_update = :peacefull_last_update WHERE id = :userId;";
			$db->update($sql, array(
				':peacefull_last_update'				=> TIMESTAMP,
				':userId'						=> $USER['id']
			));	
		}
		//END PEACEFULL EXPERIENCE AND BONUS
		
		//COMBAT EXPERIENCE AND BONUS
		if ($USER['combat_exp_current'] >= $USER['combat_exp_max']){
			$new_combat_experience =  $USER['combat_exp_current'] - $USER['combat_exp_max'];
			$new_combat_experience_max =  floor(10700 * pow(1.15,$USER['combat_exp_level']+1)); 
			$sql	= "UPDATE %%USERS%% SET combat_exp_current = :new_combat_experience, combat_exp_max = :new_combat_experience_max, combat_exp_level = combat_exp_level + 1, academy_p = academy_p + :academy_p WHERE id = :userId;"; 
			$db->update($sql, array(
				':new_combat_experience'		=> $new_combat_experience,
				':new_combat_experience_max'	=> $new_combat_experience_max,
				':academy_p'					=> $USER['combat_exp_level'],
				':userId'						=> $USER['id']
			));
			if ($USER['combat_exp_level'] + 1  >= ($USER['combat_exp_deut'] * 3) + 3){
				$sql	= "UPDATE %%USERS%% SET combat_exp_deut = combat_exp_deut + 1 WHERE id = :userId;";
				$db->update($sql, array(
					':userId'						=> $USER['id']
				));
			}
			if ($USER['combat_exp_level'] + 1  >= ($USER['combat_exp_expedition'] * 5) + 5){
				$sql	= "UPDATE %%USERS%% SET combat_exp_expedition = combat_exp_expedition + 1 WHERE id = :userId;";
				$db->update($sql, array(
					':userId'						=> $USER['id']
				));
			}
			if ($USER['combat_exp_level'] + 1  >= ($USER['combat_exp_bonus'] * 8) + 8){
				$sql	= "UPDATE %%USERS%% SET combat_exp_bonus = combat_exp_bonus + 1 WHERE id = :userId;";
				$db->update($sql, array(
					':userId'						=> $USER['id']
				));
			}
			if ($USER['combat_exp_level'] + 1  >= ($USER['combat_exp_collider'] * 15) + 15){
				$sql	= "UPDATE %%USERS%% SET combat_exp_collider = combat_exp_collider + 1 WHERE id = :userId;";
				$db->update($sql, array(
					':userId'						=> $USER['id']
				));
			}
			if ($USER['combat_exp_level'] + 1  >= ($USER['combat_exp_upgrade'] * 25) + 25){
				$sql	= "UPDATE %%USERS%% SET combat_exp_upgrade = combat_exp_upgrade + 1 WHERE id = :userId;";
				$db->update($sql, array(
					':userId'						=> $USER['id']
				));
			}
		}
		//END COMBAT EXPERIENCE AND BONUS
	}

	protected function getNavigationData()
	{
		global $PLANET, $LNG, $USER, $THEME, $resource, $reslist;

		$config			= Config::get();

		$PlanetSelect	= array();
		
		
		$USER['PLANETSHIDDEN']	= getPlanetsHIDDEN($USER);
		
		foreach($USER['PLANETSHIDDEN'] as $PlanetQuery)
		{
			$PlanetSelect['?'.$this->getQueryString().'&cp='.$PlanetQuery['id']]	= $PlanetQuery['name'].(($PlanetQuery['planet_type'] == 3) ? " (" . $LNG['fcm_moon'] . ")":"")." [".$PlanetQuery['galaxy'].":".$PlanetQuery['system'].":".$PlanetQuery['planet']."]";
		}
		
		
		$PlanetListing	= array();
		$buildInfo	= array();
		

		if(isset($USER['PLANETS'])) {
			$USER['PLANETS']	= getPlanets($USER);
		}
		foreach($USER['PLANETS'] as $PlanetQuery)
		{
			
		if ($PlanetQuery['b_building'] - TIMESTAMP > 0) {
			$Queue			= unserialize($PlanetQuery['b_building_id']);
			$buildInfo['buildings']	= array(
				'id'		=> $Queue[0][0],
				'level'		=> $Queue[0][1],
				'timeleft'	=> $PlanetQuery['b_building'] - TIMESTAMP,
				'time'		=> $PlanetQuery['b_building'],
				'starttime'	=> pretty_time($PlanetQuery['b_building'] - TIMESTAMP),
			);
		}
		else {
			$buildInfo['buildings']	= false;
		}
		
		/* As FR#206 (http://tracker.2moons.cc/view.php?id=206), i added the shipyard and research status here, but i add not them the template. */
		
		if (!empty($PlanetQuery['b_hangar_id'])) {
			$Queue	= unserialize($PlanetQuery['b_hangar_id']);
			$time	= BuildFunctions::getBuildingTime($USER, $PlanetQuery, $Queue[0][0]) * $Queue[0][1];
			$buildInfo['fleet']	= array(
				'id'		=> $Queue[0][0],
				'level'		=> $Queue[0][1],
				'timeleft'	=> $time - $PlanetQuery['b_hangar'],
				'time'		=> $time,
				'starttime'	=> pretty_time($time - $PlanetQuery['b_hangar']),
			);
		}
		else {
			$buildInfo['fleet']	= false;
		}
		
		if ($USER['b_tech'] - TIMESTAMP > 0) {
			$Queue			= unserialize($USER['b_tech_queue']);
			$buildInfo['tech']	= array(
				'id'		=> $Queue[0][0],
				'level'		=> $Queue[0][1],
				'timeleft'	=> $USER['b_tech'] - TIMESTAMP,
				'time'		=> $USER['b_tech'],
				'starttime'	=> pretty_time($USER['b_tech'] - TIMESTAMP),
			);
		}
		else {
			$buildInfo['tech']	= false;
		}
		
		//ATTACK PART
		$totalAttacks = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID AND fleet_end_id = :fleet_end_id;';
		$totalAttacks	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 1,
		':mesID'	=> 0,
		':fleet_end_id'	=> $PlanetQuery['id']
		), 'fleet_id');
		if($totalAttacks != 0){
		$totalAttacks = $totalAttacks;	
		}
		//END ATTACK PART
		
		//CAPTURE PART
		$totalCapture = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess != :mesID AND fleet_end_id = :fleet_end_id;';
		$totalCapture	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 25,
		':mesID'	=> 1,
		':fleet_end_id'	=> $PlanetQuery['id']
		), 'fleet_id');
		if($totalCapture != 0){
		$totalCapture = $totalCapture;	
		}
		//END CAPTURE PART
		
		//ROCKET PART
		$totalRockets = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID AND fleet_end_id = :fleet_end_id;';
		$totalRockets	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 10,
		':mesID'	=> 0,
		':fleet_end_id'	=> $PlanetQuery['id']
		), 'fleet_id');
		if($totalRockets != 0){
		$totalRockets = $totalRockets;	
		}
		//END ROCKET PART
		
		//SPIO PART
		$totalSpio = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID AND fleet_end_id = :fleet_end_id;';
		$totalSpio	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 6,
		':mesID'	=> 0,
		':fleet_end_id'	=> $PlanetQuery['id']
		), 'fleet_id');
		if($totalSpio != 0){
		$totalSpio = $totalSpio;	
		}
		//END SPIO PART
		
		
		$totalAttackLuna = 0;
		$totalRocketsLuna = 0;
		$totalSpioLuna = 0;
		
		if($PlanetQuery['id_luna'] != 0){
			//ATTACK PART
		$totalAttackLuna = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID AND fleet_end_id = :fleet_end_id;';
		$totalAttackLuna	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 1,
		':mesID'	=> 0,
		':fleet_end_id'	=> $PlanetQuery['id_luna']
		), 'fleet_id');
		if($totalAttackLuna != 0){
		$totalAttackLuna = $totalAttackLuna;	
		}
		//END ATTACK PART
		
		//ROCKET PART
		$totalRocketsLuna = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID AND fleet_end_id = :fleet_end_id;';
		$totalRocketsLuna	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 10,
		':mesID'	=> 0,
		':fleet_end_id'	=> $PlanetQuery['id_luna']
		), 'fleet_id');
		if($totalRocketsLuna != 0){
		$totalRocketsLuna = $totalRocketsLuna;	
		}
		//END ROCKET PART
		
		//SPIO PART
		$totalSpioLuna = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID AND fleet_end_id = :fleet_end_id;';
		$totalSpioLuna	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 6,
		':mesID'	=> 0,
		':fleet_end_id'	=> $PlanetQuery['id_luna']
		), 'fleet_id');
		if($totalSpioLuna != 0){
		$totalSpioLuna = $totalSpioLuna;	
		}
		//END SPIO PART
			
		}
		
		
		
		$PlanetListing[$PlanetQuery['id']] = array(
				'name'					=> $PlanetQuery['name'],
				'galaxy'				=> $PlanetQuery['galaxy'],
				'image'				    => $PlanetQuery['image'],
				'system'				=> $PlanetQuery['system'],
				'planet'				=> $PlanetQuery['planet'],
				'luna'					=> $PlanetQuery['id_luna'],
				'last_relocate'			=> $PlanetQuery['last_relocate'] + 259200 < TIMESTAMP ? 1 : 0,
				'buildInfo'				=> $buildInfo,
				'totalAttacks'			=> $totalAttacks,
				'totalRockets'			=> $totalRockets,
				'totalSpio'				=> $totalSpio,
				'totalAttackLuna'		=> $totalAttackLuna,
				'totalRocketsLuna'		=> $totalRocketsLuna,
				'totalSpioLuna'			=> $totalSpioLuna,
				'isGal6Mod'				=> $PlanetQuery['gal6mod'],
				
			);
			
		}
		
		
		
		$resourceTable	= array();
		$resourceSpeed	= $config->resource_multiplier;
		foreach($reslist['resstype'][1] as $resourceID)
		{
			if($resourceID != 921){
				$resourceTable[$resourceID]['name']			= $resource[$resourceID];
				$resourceTable[$resourceID]['current']		= round($PLANET[$resource[$resourceID]],1);
				$resourceTable[$resourceID]['max']			= $PLANET[$resource[$resourceID].'_max'];
				$resourceTable[$resourceID]['percent']		= round($PLANET[$resource[$resourceID]] * 100 / $PLANET[$resource[$resourceID].'_max']);
				$resourceTable[$resourceID]['informationh']	= $PLANET[$resource[$resourceID].'_perhour']+ $config->{$resource[$resourceID].'_basic_income'} * $resourceSpeed;
				$resourceTable[$resourceID]['informationd']	= ($PLANET[$resource[$resourceID].'_perhour']+ $config->{$resource[$resourceID].'_basic_income'} * $resourceSpeed) * 24;
				$resourceTable[$resourceID]['informationm']	= ($PLANET[$resource[$resourceID].'_perhour']+ $config->{$resource[$resourceID].'_basic_income'} * $resourceSpeed) * 24 * 31;


				if($USER['urlaubs_modus'] == 1 || $PLANET['planet_type'] != 1)
				{
					$resourceTable[$resourceID]['production']	= round($PLANET[$resource[$resourceID].'_perhour'],3);
				}
				else
				{
					$resourceTable[$resourceID]['production']	= round($PLANET[$resource[$resourceID].'_perhour'] + $config->{$resource[$resourceID].'_basic_income'} * $resourceSpeed,3);
				}
			}else{
				$resourceTable[$resourceID]['name']			= $resource[$resourceID];
				$resourceTable[$resourceID]['current']		= $USER[$resource[$resourceID]];
				$resourceTable[$resourceID]['max']			= 999999999999999;
				
				$getGalaxySevePlanet 	= getGalaxySevenPlanet($PLANET);
				$getGalaxySevenDm   	= $getGalaxySevePlanet['darkmatterProd'];

				if($USER['urlaubs_modus'] == 1)
				{
					$resourceTable[$resourceID]['production']	= $PLANET[$resource[$resourceID].'_perhour'];	
				}elseif($PLANET['planet_type'] == 1){
					if($PLANET['id_luna'] != 0){
						$sql	= 'SELECT * FROM %%PLANETS%% WHERE id = :id_luna;';
						$MOONSINFOR	= Database::get()->selectSingle($sql, array(
						':id_luna'	=> $PLANET['id_luna']
						));
						$resourceTable[$resourceID]['production']	= $MOONSINFOR[$resource[$resourceID].'_perhour'] + $getGalaxySevenDm + $config->{$resource[$resourceID].'_basic_income'} * 1000;
					}else{
						$resourceTable[$resourceID]['production']	= $PLANET[$resource[$resourceID].'_perhour'] + $getGalaxySevenDm;	
					}
				}else{
					$resourceTable[$resourceID]['production']	= $PLANET[$resource[$resourceID].'_perhour'] + $getGalaxySevenDm + $config->{$resource[$resourceID].'_basic_income'} * 1000;
				}
			}
			
		}

		 foreach($reslist['resstype'][2] as $resourceID)
		{
			$resourceTable[$resourceID]['name']			= $resource[$resourceID];
			$resourceTable[$resourceID]['used']			= $PLANET[$resource[$resourceID]] + $PLANET[$resource[$resourceID].'_used'];
			$resourceTable[$resourceID]['max']			= $PLANET[$resource[$resourceID]];
			$resourceTable[$resourceID]['percent']		= round(($PLANET[$resource[$resourceID]] + $PLANET[$resource[$resourceID].'_used']) * 100 / max(1,$PLANET[$resource[$resourceID]]));
		}

		foreach($reslist['resstype'][3] as $resourceID)
		{
			$resourceTable[$resourceID]['name']			= $resource[$resourceID];
			$resourceTable[$resourceID]['current']		= $USER[$resource[$resourceID]];
		} 

		$themeSettings	= $THEME->getStyleSettings();
		
	if($USER['tutorial'] != -1){
		$db = Database::get();
		if($USER['tutorial'] == 0){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 1
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 1){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 2
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 2 && $this->getQueryString() == "page=buildings"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 4
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 5){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 6
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 9){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 10
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 11){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 12
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 12){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 13
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			$rawfleetarray 		= array(210 => 1);
			$fleetStartTime		= 80 + TIMESTAMP;
			$timeDifference		= round(max(0, $fleetStartTime - 0));
			$fleetStayTime		= $fleetStartTime;
			$fleetEndTime		= $fleetStayTime + 80;
			$fleetResource		= array(
				901	=> 0,
				902	=> 0,
				903	=> 0,
			);
			FleetFunctions::sendFleet($rawfleetarray, 6, 0, 0, $PLANET['galaxy'],
				$PLANET['system'], 21, 1, $PLANET['id_owner'],
				$PLANET['id'], $PLANET['galaxy'], $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $fleetResource,
				$fleetStartTime, $fleetStayTime, $fleetEndTime, 0);
		}
		if($USER['tutorial'] == 13 && $this->getQueryString() == "page=overview"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 14
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 14 && $this->getQueryString() != "page=nono"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 15
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 14 && $this->getQueryString() == "page=research"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 17
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 15 && $this->getQueryString() != "page=research"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 16
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 16){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 17
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 15 && $this->getQueryString() != "page=research"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 16
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 17){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 18
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		} 
		if($USER['tutorial'] == 20){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 21,
			peacefull_exp_current	= peacefull_exp_current + :peacefull_exp_current
			WHERE id = :userID;";
			$db->update($sql, array(
			':peacefull_exp_current'			=> 650,
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 22){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 23
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 21 && $this->getQueryString() == "page=defense"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 22
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 28 && $this->getQueryString() == "page=overview"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 29
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		
		//ATTACK PART
		$totalAttacks = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID';
		$totalAttacks	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 1,
		':mesID'	=> 0
		), 'fleet_id');
		if($totalAttacks != 0){
			$totalAttacks = $totalAttacks;	
		}
		//END ATTACK PART
		
		if($USER['tutorial'] == 29 && $totalAttacks == 0){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 30
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 30 && $this->getQueryString() == "page=messages"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 31
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 32){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 33
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 39 && $this->getQueryString() == "page=galaxy"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 40
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id'] 
			));
		}
		if($USER['tutorial'] == 41){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 42
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 40 && $this->getQueryString() == "page=overview"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 41
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 44){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 45
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 46){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 47
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		
		if($USER['tutorial'] == 49){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= -1
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 48){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 49
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 47 && $this->getQueryString() == "page=achievement"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 48
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 51 && HTTP::_GP('page', '') == "fleetTable"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= -1
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		/*if($USER['tutorial'] > 52){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= -1
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] = 52){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= -1
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 54 && $USER['expedition_tech'] >= 1 && $PLANET['big_ship_cargo'] >= 1000 && $PLANET['light_hunter'] >= 10000 && $PLANET['battle_ship'] >= 1500 && $PLANET['recycler'] >= 10){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 55
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 55 && HTTP::_GP('page', '') == "fleetTable"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 56
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 57){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 58
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
			$sql =  "UPDATE %%PLANETS%% SET
			light_hunter = light_hunter + :light_hunter,
			heavy_hunter = heavy_hunter + :heavy_hunter,
			crusher		 = crusher + :crusher,
			battle_ship	 = battle_ship + :battle_ship,
			battleship	 = battleship + :battleship,
			giga_recykler	 = giga_recykler + :giga_recykler
			WHERE id = :planetId;";
			$db->update($sql, array(
			':light_hunter'			=> 150000,
			':heavy_hunter'			=> 24000,
			':crusher'				=> 49000,
			':battle_ship'			=> 9850,
			':battleship'			=> 3500,
			':giga_recykler'		=> 25,
			':planetId'				=> $PLANET['id']
			));
		}
		if($USER['tutorial'] == 58 && $PLANET['crusher'] >= 1000 && $PLANET['heavy_hunter'] >= 25000){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 59
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 59 && HTTP::_GP('page', '') == "fleetTable"){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 60
			WHERE id = :userID;";
			$db->update($sql, array(
			':userID'			=> $USER['id']
			));
		}
		if($USER['tutorial'] == 61){
			$sql =  "UPDATE %%USERS%% SET
			tutorial				= 62,
			combat_exp_current	= combat_exp_current + :combat_exp_current
			WHERE id = :userID;";
			$db->update($sql, array(
			':combat_exp_current'			=> 1000,
			':userID'			=> $USER['id']
			));
		}*/
	}else{
		//ATTACK PART
		$totalAttacks = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID';
		$totalAttacks	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 1,
		':mesID'	=> 0
		), 'fleet_id');
		if($totalAttacks != 0){
		$totalAttacks = $totalAttacks;	
		}
		//END ATTACK PART
	}

		//ROCKET PART
		$totalRockets = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID';
		$totalRockets	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 10,
		':mesID'	=> 0
		), 'fleet_id');
		if($totalRockets != 0){
		$totalRockets = $totalRockets;	
		}
		//END ROCKET PART

		//SPIO PART
		$totalSpio = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID';
		$totalSpio	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 6,
		':mesID'	=> 0
		), 'fleet_id');
		if($totalSpio != 0){
		$totalSpio = $totalSpio;	
		}
		//END SPIO PART
		
		//CAPTURE PART
		$totalCapture = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess != :mesID';
		$totalCapture	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 25,
		':mesID'	=> 1
		), 'fleet_id');
		if($totalCapture != 0){
		$totalCapture = $totalCapture;	
		}
		//END CAPTURE PART
		
		//unic PART
		$unicAttacks = 0;
		$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID';
		$unicAttacks	= Database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id'],
		':missionID'	=> 9,
		':mesID'	=> 0
		), 'fleet_id');
		if($unicAttacks != 0){
		$unicAttacks = $unicAttacks;	
		}
		//END unic PART
		$MiniChat = 1;
		if($this->getQueryString() == "page=chat" || $this->getQueryString() == "page=chat&mode=rooms" || $this->getQueryString() == "page=chat&chat=ally" || $this->getQueryString() == "page=chat&mode=roomsActions"){
		$MiniChat = 2;
		}
		
		$db	= Database::get();
		if($USER['planet_sort'] == 0){
		$sql	= 'SELECT id FROM %%PLANETS%% WHERE id > :planetId AND id_owner = :userID ORDER BY `id` LIMIT 1;';
		$miniNavNext = $db->selectSingle($sql, array(
			':planetId'	=> $PLANET['id'],
			':userID'	=> $USER['id']
		), 'id');
		
		$sql	= 'SELECT id FROM %%PLANETS%% WHERE id < :planetId AND id_owner = :userID ORDER BY `id` DESC LIMIT 1;';
		$miniNavPrev = $db->selectSingle($sql, array(
			':planetId'	=> $PLANET['id'],
			':userID'	=> $USER['id']
		), 'id');
		}elseif($USER['planet_sort'] == 2){
		$sql	= 'SELECT id FROM %%PLANETS%% WHERE name >= :planetName AND id != :planetId AND id_owner = :userID ORDER BY `name` LIMIT 1;';
		$miniNavNext = $db->selectSingle($sql, array(
			':planetName'	=> $PLANET['name'],
			':planetId'	=> $PLANET['id'],
			':userID'	=> $USER['id']
		), 'id');
		
		$sql	= 'SELECT id FROM %%PLANETS%% WHERE name <= :planetName AND id != :planetId AND id_owner = :userID ORDER BY `name` DESC LIMIT 1;';
		$miniNavPrev = $db->selectSingle($sql, array(
			':planetName'	=> $PLANET['name'],
			':planetId'	=> $PLANET['id'],
			':userID'	=> $USER['id']
		), 'id');
		}else{
		$sql	= 'SELECT id FROM %%PLANETS%% WHERE id_owner = :userID ORDER BY galaxy, system, planet, planet_type LIMIT 1;';
		$miniNavNext = $db->selectSingle($sql, array(
			':userID'	=> $USER['id']
		), 'id');
		
		$sql	= 'SELECT id FROM %%PLANETS%% WHERE id_owner = :userID ORDER BY galaxy, system, planet, planet_type DESC LIMIT 1;';
		$miniNavPrev = $db->selectSingle($sql, array(
			':userID'	=> $USER['id']
		), 'id');
		}
			 
		$supportLeft = 0;
		if($USER['authlevel'] != 0 || $USER['chat_oper'] != 0 || $USER['gm'] != 0)
			$supportLeft = 1;
		
		$TotalTicket = 0;
		$sql	= 'SELECT * FROM %%TICKETS%% WHERE status != 2;';
		$totalTick	= Database::get()->select($sql, array(
		));
		if(count($totalTick) != 0){
		$TotalTicket = $totalTick;	
		}
		
		if (!isset($_COOKIE['allyVersion'])) 
			$Website = "game.php?page=chat";
		elseif($_COOKIE['allyVersion'] == 1)
			$Website = "game.php?page=chat&chat=ally";	
		else
			$Website = "game.php?page=chat";		
		
		if (!isset($_COOKIE['allyVersion'])) 
			$Website2 = "game.php?page=chat&mini_chat=1&default_chat=1";
		elseif($_COOKIE['allyVersion'] == 1)
			$Website2 = "game.php?page=chat&chat=ally&mini_chat=1&default_chat=1";	
		else
			$Website2 = "game.php?page=chat&mini_chat=1&default_chat=1";	
		
		
		$sql	= 'SELECT * FROM %%BUDDY%% WHERE (sender = :userId AND buddyType = 1) OR (owner = :userId AND buddyType = 1);';
		$getFriendsForFbChat = database::get()->select($sql, array(
			':userId'		=> $USER['id'],
		));
		
		$friendList      = array();
		
		
		foreach($getFriendsForFbChat as $fbfriend){
			if($fbfriend['sender'] == $USER['id'])
				$friendId = $fbfriend['owner'];
			else
				$friendId = $fbfriend['sender'];
			
			$sql = "SELECT COUNT(*) as count FROM %%BUDDY_REQUEST%% WHERE id = :id;";
			$isRequest = database::get()->selectSingle($sql, array(
				':id'  => $fbfriend['id']
			), 'count');
			
			if($isRequest)
				continue;
			
			$friendData	= GetFromDatabase('USERS', 'id', $friendId, array('lang', 'username', 'customNick', 'id'));
			
			$friendList[$friendId]	= array(
				'name'				=> empty($friendData['customNick']) ? $friendData['username'] : $friendData['customNick'],
			);
		}
		
		$showDialogXteriumAlly = 0;
		$sql = 'SELECT total_points FROM %%STATPOINTS%% WHERE id_owner = :StartOwner;';
		$userRankAllyMod	= Database::get()->selectSingle($sql, array(
			':StartOwner'	=> $USER['id']
		));
		
		if($userRankAllyMod['total_points'] < config::get()->xteriumPoints && $USER['xteriumallydialog'] == 0){
			$showDialogXteriumAlly = 1;
			$sql = 'UPDATE %%USERS%% SET xteriumallydialog = 1 WHERE id = :StartOwner;';
			Database::get()->update($sql, array(
				':StartOwner'	=> $USER['id']
			));
		}
		
		$sql = 'SELECT COUNT(*) as count FROM %%EASYRES%% WHERE userId = :userId AND claimed = 0;';
		$resourceLogInfoLost	=	Database::get()->selectSingle($sql, array(
			':userId'	=> $USER['id']
		));
		
		$gift4_1 = 0;
		$gift4 	 = 0;
		if($USER['cosmo_gift_1'] >= 1 && $USER['cosmo_gift_2'] >= 1 && $USER['cosmo_gift_3'] >= 1){
			if($USER['cosmo_gift_1'] <= $USER['cosmo_gift_2'] && $USER['cosmo_gift_1'] <= $USER['cosmo_gift_3']){
				$gift4 = $USER['cosmo_gift_1'];
			}elseif($USER['cosmo_gift_2'] <= $USER['cosmo_gift_1'] && $USER['cosmo_gift_2'] <= $USER['cosmo_gift_3']){
				$gift4 = $USER['cosmo_gift_2'];
			}elseif($USER['cosmo_gift_3'] <= $USER['cosmo_gift_1'] && $USER['cosmo_gift_3'] <= $USER['cosmo_gift_2']){
				$gift4 = $USER['cosmo_gift_3'];
			}
			$gift4_1 = 1;
		}
		
		$gift4_2 	= 0;
		$gift5 		= 0;
		if($USER['newyear_gift_1'] >= 1 && $USER['newyear_gift_2'] >= 1 && $USER['newyear_gift_3'] >= 1){
			if($USER['newyear_gift_1'] <= $USER['newyear_gift_2'] && $USER['newyear_gift_1'] <= $USER['newyear_gift_3']){
				$gift5 = $USER['newyear_gift_1'];
			}elseif($USER['newyear_gift_2'] <= $USER['newyear_gift_1'] && $USER['newyear_gift_2'] <= $USER['newyear_gift_3']){
				$gift5 = $USER['newyear_gift_2'];
			}elseif($USER['newyear_gift_3'] <= $USER['newyear_gift_1'] && $USER['newyear_gift_3'] <= $USER['newyear_gift_2']){
				$gift5 = $USER['newyear_gift_3'];
			}
			$gift4_2 = 1;
		} 
		
		$halloween4_1 	= 0;
		$halloween4 	= 0;
		if($USER['halloween_gift_1'] >= 1 && $USER['halloween_gift_2'] >= 1 && $USER['halloween_gift_3'] >= 1){
			if($USER['halloween_gift_1'] <= $USER['halloween_gift_2'] && $USER['halloween_gift_1'] <= $USER['halloween_gift_3']){
				$halloween4 = $USER['halloween_gift_1'];
			}elseif($USER['halloween_gift_2'] <= $USER['halloween_gift_1'] && $USER['halloween_gift_2'] <= $USER['halloween_gift_3']){
				$halloween4 = $USER['halloween_gift_2'];
			}elseif($USER['halloween_gift_3'] <= $USER['halloween_gift_1'] && $USER['halloween_gift_3'] <= $USER['halloween_gift_2']){
				$halloween4 = $USER['halloween_gift_3'];
			}
			$halloween4_1 = 1;
		}
		
		$this->assign(array(
			'resourceLogInfoLost'	=> $resourceLogInfoLost['count'],
			'showDialogXteriumAlly'	=> $showDialogXteriumAlly,
			'friendList'			=> $friendList,
			'Website'				=> $Website,
			'Website2'				=> $Website2,
			'supportLeft'			=> $supportLeft,
			'TotalTicket'			=> $TotalTicket,
			'sirena'				=> $USER['sirena'] / 10,
			'offi601'				=> $USER[$resource[601]],
			'offi602'				=> $USER[$resource[602]],
			'customNick'			=> $USER['customNick'],
			'customNickChange'		=> $USER['customNickChange'],
			'combat_exp_level'		=> $USER['combat_exp_level'],
			'combat_exp_current'	=> $USER['combat_exp_current'],
			'combat_exp_max'		=> $USER['combat_exp_max'],
			'combat_exp_deut'		=> $USER['combat_exp_deut'],
			'combat_exp_expedition'	=> $USER['combat_exp_expedition'],
			'combat_exp_bonus'		=> $USER['combat_exp_bonus'],
			'combat_exp_collider'	=> $USER['combat_exp_collider'],
			'combat_exp_upgrade'	=> $USER['combat_exp_upgrade'],
			'combat_exp_percent'	=> number_format($USER['combat_exp_current'] * 100 / $USER['combat_exp_max'], 2, '.', ''),
			'peacefull_exp_level'	=> $USER['peacefull_exp_level'],
			'peacefull_exp_current'	=> $USER['peacefull_exp_current'],
			'peacefull_exp_max'		=> $USER['peacefull_exp_max'],
			'peacefull_exp_slots'	=> $USER['peacefull_exp_slots'],
			'peacefull_exp_mission'	=> $USER['peacefull_exp_mission'],
			'peacefull_exp_moonshot'=> $USER['peacefull_exp_moonshot'],
			'peacefull_exp_light'	=> $USER['peacefull_exp_light'],
			'peacefull_exp_medium'	=> $USER['peacefull_exp_medium'],
			'peacefull_exp_heavy'	=> $USER['peacefull_exp_heavy'],
			'peacefull_exp_percent'	=> number_format($USER['peacefull_exp_current'] * 100 / $USER['peacefull_exp_max'], 2, '.', ''),
			'buildInfo'				=> $buildInfo,
			'MiniChat'				=> $MiniChat,
			'miniNavNext'			=> $miniNavNext,
			'miniNavPrev'			=> $miniNavPrev,
			'totalAttacks'			=> $totalAttacks,
			'totalCapture'			=> $totalCapture,
			'totalRockets'			=> $totalRockets,
			'totalSpio'				=> $totalSpio,
			'unicAttacks'			=> $unicAttacks,
			'PlanetSelect'			=> $PlanetSelect,
			'PlanetListing'			=> $PlanetListing,
			'newyear_gift_1' 		=> $USER['newyear_gift_1'],
			'newyear_gift_2' 		=> $USER['newyear_gift_2'],
			'newyear_gift_3' 		=> $USER['newyear_gift_3'],
			'newyear_gift_4' 		=> $gift4_2,
			'cosmo_gift_6' 			=> $gift5, 
			'gift42'				=> $gift4_2,
			'is_news'					=> $config->OverviewNewsFrame,
			'news'						=> makebr($config->OverviewNewsText),
			'cosmo_gift_1' 			=> $USER['cosmo_gift_1'],
			'cosmo_gift_2' 			=> $USER['cosmo_gift_2'],
			'cosmo_gift_3' 			=> $USER['cosmo_gift_3'],
			'halloween_gift_1' 		=> $USER['halloween_gift_1'],
			'halloween_gift_2' 		=> $USER['halloween_gift_2'],
			'halloween_gift_3' 		=> $USER['halloween_gift_3'],
			'halloween_gift_4' 		=> $USER['halloween_gift_3'],
			'halloween4' 			=> $halloween4,
			'halloween4_1' 			=> $halloween4_1,
			'useravatar' 			=> "media/files/".$USER['avatar'],
			'cosmo_gift_4' 			=> $gift4,
			'gift4_1'				=> $gift4_1,
			'rpg_geologue' 			=> $USER['rpg_geologue'],
			'displayadsmd' 			=> $USER['displayads'],
			'stardustx' 			=> $USER['stellar_ore'],
			'rpg_amiral' 			=> $USER['rpg_amiral'],
			'new_message' 			=> $USER['messages'],
			'red_button1'			=> $USER['prem_button_days'] > TIMESTAMP ? $USER['prem_button'] : 0,
			'vacation'				=> $USER['urlaubs_modus'] ? _date($LNG['php_tdformat'], $USER['urlaubs_until'], $USER['timezone']) : false,
			'delete'				=> $USER['db_deaktjava'] ? sprintf($LNG['tn_delete_mode'], _date($LNG['php_tdformat'], $USER['db_deaktjava'] + ($config->del_user_manually * 86400)), $USER['timezone']) : false,
			'darkmatter'			=> $USER['darkmatter'],
			'antimatter'			=> ($USER['antimatter'] + $USER['antimatter_bought']),
			'servertime'			=> _date("M D d H:i:s", TIMESTAMP, $USER['timezone']),
			'servertime1'			=> _date("M D d H:i:s", TIMESTAMP, "Europe/Brussels"),
			'metal_m'				=> $PLANET[$resource[1]],
			'colshiptuto'			=> $PLANET[$resource[208]],
			'image'					=> $PLANET['image'],
			'resourceTable'			=> $resourceTable,
			'shortlyNumber'			=> $themeSettings['TOPNAV_SHORTLY_NUMBER'],
			'closed'				=> !$config->game_disable,
			'special_donation_premium'=> $config->special_donation_premium,
			'red_button'			=> $config->red_button,
			'donation_b'			=> $config->donation_bonus,
			'new_year_status'		=> $config->new_year_status,
			'cosmonaute_status'		=> $config->cosmonaute_status,
			'halloween_event'		=> $config->halloween_event,
			'xteriumAllyIdAbstra'	=> $config->xteriumAllyId,
			'hasBoard'				=> filter_var($config->forum_url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED),
			'hasAdminAccess'		=> !empty(Session::load()->adminAccess),
			'hasGate'				=> $PLANET[$resource[43]] > 0,
			'bonus_timer'			=> $USER['bonus_timer'],
			'arsenal_event'			=> $USER['expeEventPoints'],
			
			
		));
	}
	protected function tmpAntimatter()
	{
		global $USER, $LNG;
		
		$db	= Database::get();	
		if(($USER['antimatter'] + $USER['antimatter_bought']) > $USER['antimatterTmp']){
			$sql	= 'UPDATE %%USERS%% SET antimatterTmp = :antimatterTmp WHERE id = :userID;';
			$db->update($sql, array(
				':antimatterTmp'	=> ($USER['antimatter'] + $USER['antimatter_bought']),
				':userID'			=> $USER['id']
			));
			//ADD INSERT QUERY TO WARN ADMINS HERE
			$sql = "INSERT INTO %%AMTRACKER%% SET userId = :userId, tmpAntimatter = :tmpAntimatter, newAntimatter = :newAntimatter, trackDifference = :trackDifference, trackTime = :trackTime";
			database::get()->insert($sql, array(
				':userId'			=> $USER['id'],
				':tmpAntimatter'	=> $USER['antimatterTmp'],
				':newAntimatter'	=> ($USER['antimatter'] + $USER['antimatter_bought']),
				':trackDifference'	=> ($USER['antimatter'] + $USER['antimatter_bought']) - $USER['antimatterTmp'],
				':trackTime'		=> TIMESTAMP
			));
		}else{
			$sql	= 'UPDATE %%USERS%% SET antimatterTmp = :antimatterTmp WHERE id = :userID;';
			$db->update($sql, array(
				':antimatterTmp'	=> ($USER['antimatter'] + $USER['antimatter_bought']),
				':userID'			=> $USER['id']
			));
		}
	}
	
	protected function getPageData()
	{
		global $USER, $THEME, $PLANET, $LNG;
		

		if($this->getWindow() === 'full') {
			$this->getNavigationData();
			$this->getCronjobsTodo();
			$this->Experience();
			$this->Achievements();
		}
		$this->tmpAntimatter();
		
		$dateTimeServer		= new DateTime("now");
		if(isset($USER['timezone'])) {
			try {
				$dateTimeUser	= new DateTime("now", new DateTimeZone($USER['timezone']));
			} catch (Exception $e) {
				$dateTimeUser	= $dateTimeServer;
			}
		} else {
			$dateTimeUser	= $dateTimeServer;
		}

		$config	= Config::get();
		
		$showVoteMenu = 0;
		//if($USER['vote_sys_1'] < TIMESTAMP - 12*3600  || $USER['vote_sys_2'] < TIMESTAMP - 12*3600 || $USER['vote_sys_4'] < TIMESTAMP - 2*3600){
		if($USER['vote_sys_1'] < TIMESTAMP - 12*3600 || $USER['vote_sys_2'] < TIMESTAMP - 12*3600 || $USER['vote_sys_4'] < TIMESTAMP - 12*3600 || $USER['vote_sys_5'] < TIMESTAMP - 12*3600){
			$showVoteMenu = 1;	
		}
		
		$userallyname = "";
		$userallytag = "";
		if($USER['ally_id'] != 0){
			$db	= Database::get();	
			$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceId;';
			$userAllyInfo = $db->selectSingle($sql, array(
				':allianceId'	=> $USER['ally_id'] 
			));
			$userallyname = $userAllyInfo['ally_name'];
			$userallytag = $userAllyInfo['ally_tag'];
		}
		if($USER['sawfb'] == 0 && $USER['tutorial'] == -1){
			$db	= Database::get();	
			$sql	= 'UPDATE %%USERS%% SET sawfb = :sawfb WHERE id = :userID;';
			$db->update($sql, array(
				':sawfb'	=> 1,
				':userID'	=> $USER['id']
			));
		}
		
		$sql = 'SELECT * FROM %%STATPOINTS%% WHERE id_owner = :StartOwner;';
		$userRank	= Database::get()->selectSingle($sql, array(
			':StartOwner'	=> $USER['id']
		));
		
		
		if($USER['sawminially'] == 0 && $userRank['total_points'] > 100000){
			$db	= Database::get();	
			$sql	= 'UPDATE %%USERS%% SET sawminially = :sawminially WHERE id = :userID;';
			$db->update($sql, array(
				':sawminially'	=> 1,
				':userID'	=> $USER['id']
			));
		} 
		
		$showJumpgate = 0;
		if($PLANET['planet_type'] == 3 && $PLANET['sprungtor'] > 0){
			$showJumpgate = 1;
		}
		
		$showDock = 0;
		if($PLANET['planet_type'] == 1 && $PLANET['xterium_dock'] > 0){
			$showDock = 1;
		}
		
		$showSensor = 0;
		if($PLANET['touchmodule'] > 0 && $PLANET['isAlliancePlanet'] != 0 && $PLANET['destruyed'] == 0){
			$showSensor = 1;
		}
		
		$db	= Database::get();	
		$sql = "SELECT * FROM %%TIMEBONUS%% WHERE userID = :userid";
		$TIMEBONUS = $db->select($sql, array( 
		':userid'	=> $USER['id']
		));
			
		if($config->timeRewardFrom < TIMESTAMP && $config->timeRewardTo > TIMESTAMP && count($TIMEBONUS)==0){
			$db	= Database::get();	
			$sql = "UPDATE %%USERS%% SET antimatter = antimatter + :timeReward WHERE id = :loginID";
			$db->update($sql, array(
					':timeReward'	=> $config->timeReward,
					':loginID'			=> $USER['id']
			));
					
			$logID = $db->lastInsertId(); 
			$sql = "INSERT INTO %%TIMEBONUS%% SET
			logID	= :logID,
			userID		= :userID,
			TIMESTAMP	= :TIMESTAMP";

			$db->insert($sql, array(
			':logID'		=> $logID,
			':userID'			=> $USER['id'],
			':TIMESTAMP'			=> TIMESTAMP
			));
		}
		
		$logID = $db->lastInsertId(); 
		$sql = "INSERT INTO %%TRACKING%% SET userId = :userId, userName = :userName, pageVisited = :pageVisited, time = :time, trackMode = 1;";
		$db->insert($sql, array(
			':userId'		=> $USER['id'],
			':userName'		=> empty($USER['customNick']) ? $USER['username'] : $USER['customNick'],
			':pageVisited'	=> empty($this->getQueryString()) ? 'game.php' : $this->getQueryString(),
			':time'			=> TIMESTAMP
		));
		
		$showDialogXteriumAlly = 0;
		$logoutMob = 0;
		
		$detect = new Mobile_Detect;
		if(MOBILEMODE && $detect->isMobile() && !$detect->isTablet()){
			$logoutMob = 1;
		}else{
			$logoutMob = 0;
		}
		
		$showCronLocked = 0;
		$sql = "SELECT * FROM %%CRONJOBS%% WHERE cronjobID = 30;";
		$cronjobDataLock = database::get()->selectSingle($sql, array());
		if(!empty($cronjobDataLock['lock']) && $cronjobDataLock['nextTime'] < TIMESTAMP - 5 * 60){
			//$showCronLocked = 1;
			$sql = "UPDATE %%CRONJOBS%% SET `lock` = NULL WHERE cronjobID = 30;";
			database::get()->update($sql, array());
			ClearCache();
			PlayerUtil::sendMessage(1, '', 'Automatic Expeditions', 4, 'Automatic Expeditions', 'The cronjob is succesfully restarted with the new failure check !', TIMESTAMP);
		}
		$this->assign(array(
			'showCronLocked'	=> $showCronLocked,
			'logoutMob'	=> $logoutMob,
			'total_pointsUse'	=> $userRank['total_points'],
			'showDialogXteriumAlly'	=> $showDialogXteriumAlly,
			'showVoteMenu'		=> $showVoteMenu,
			'shozpltype'		=> $PLANET['planet_type'],
			'kolvosz'			=> $PLANET['kolvo'],
			'showJumpgate'		=> $showJumpgate,
			'showDock'			=> $showDock,
			'showSensor'		=> $showSensor,
			'sawfb'				=> $USER['sawfb'],
			'sawminially'		=> $USER['sawminially'],
			'vmode'				=> $USER['urlaubs_modus'],
			'authlevel'			=> $USER['authlevel'],
			'userID'			=> $USER['id'],
			'encodage'			=> $USER['encodage'],
			'tutorial'			=> $USER['tutorial'], 
			'bodyclass'			=> $this->getWindow(),
			'game_name'			=> $config->game_name,
			'uni_name'			=> $config->uni_name,
			'ga_active'			=> $config->ga_active,
			'ga_key'			=> $config->ga_key,
			'debug'				=> $config->debug,
			'VERSION'			=> $config->VERSION,
			'date'				=> explode("|", date('Y\|n\|j\|G\|i\|s\|Z', TIMESTAMP)),
			'isPlayerCardActive'=> isModuleAvailable(MODULE_PLAYERCARD),
			'REV'				=> '4.0.9',
			'Offset'			=> $dateTimeUser->getOffset() - $dateTimeServer->getOffset(),
			'queryString'		=> $this->getQueryString(),
			'themeSettings'		=> $THEME->getStyleSettings(),
			'path'				=> HTTP_PATH,
			'game_speeds'		=> $config->game_speed,
			'fleet_speeds'		=> $config->fleet_speed,
			'meta_allyId'		=> ($USER['ally_id'] == 0) ? "" : $USER['ally_id'],
			'meta_allyTag'		=> ($USER['ally_id'] == 0) ? "" : $userallytag,
			'meta_allyName'		=> ($USER['ally_id'] == 0) ? "" : $userallyname,
			'metal_planetty'	=> ($PLANET['planet_type'] == 1) ? $LNG['type_planet'][1] : $LNG['type_planet'][3],
			'userLangs'			=> $USER['lang'],
			'metausername'		=> empty($USER['customNick']) ? $USER['username'] : $USER['customNick'],
			'TIME'				=>	TIMESTAMP,
			'current_pid'		=> $PLANET['id'],
			'current_pids'		=> '?'.$this->getQueryString().'&cp='.$PLANET['id'],
			'tourneyEnd'		=> config::get()->tourneyEnd - TIMESTAMP,
			'planetName'		=> $PLANET['name'],
			'planetImage'		=> $PLANET['image'],
			'planetGalaxy'		=> $PLANET['galaxy'],
			'planetSystem'		=> $PLANET['system'],
			'planetPlanet'		=> $PLANET['planet'],
			'my_game_url'		=> $config->domain_name //without https or www
		));
		
		$MemoryUsage = round((memory_get_usage()/1048576));
		if($MemoryUsage >= 8){
			$sql = "INSERT INTO %%MEMORYLOGS%% SET userId = :userId, queryString = :queryString, memoryUsed = :memoryUsed;";
			database::get()->insert($sql, array(
				':userId'			=> $USER['id'],
				':queryString'		=> $this->getQueryString(),
				':memoryUsed'		=> $MemoryUsage
			));
		}

	}

	protected function printMessage($message, $redirectButtons = NULL, $redirect = NULL, $fullSide = true)
	{
		$this->assign(array(
			'message'			=> $message,
			'redirectButtons'	=> $redirectButtons,
			'fullSide'			=> $fullSide,
		));

		if(isset($redirect)) {
			$this->tplObj->gotoside($redirect[0], $redirect[1]);
		}

		if(!$fullSide) {
			$this->setWindow('popup');
		}

		$this->display('error.default.tpl');
	}

	protected function save() {
		if(isset($this->ecoObj)) {
			$this->ecoObj->SavePlanetToDB();
		}
	}

	protected function assign($array, $nocache = true) {
		$this->tplObj->assign_vars($array, $nocache);
	}

	protected function display($file) {
		global $THEME, $LNG;

		$this->save();

		if($this->getWindow() !== 'ajax') {
			$this->getPageData();
		}

		$this->assign(array(
			'lang'    		=> $LNG->getLanguage(),
			'dpath'			=> $THEME->getTheme(),
			'scripts'		=> $this->tplObj->jsscript,
			'execscript'	=> implode("\n", $this->tplObj->script),
			'basepath'		=> PROTOCOL.HTTP_HOST.HTTP_BASE,
		));

		$this->assign(array(
			'LNG'			=> $LNG,
		), false);

		$this->tplObj->display('extends:layout.'.$this->getWindow().'.tpl|'.$file);
		exit;
	}

	protected function sendJSON($data) {
		$this->save();
		echo json_encode($data);
		exit;
	}

	protected function redirectTo($url) {
		$this->save();
		HTTP::redirectTo($url);
		exit;
	}
	
	public function widrawAm($widrawAmount, $userId) {
		global $USER, $LNG;
		if($USER['antimatter'] >= $widrawAmount){
			$USER['antimatter'] -= $widrawAmount;
			$sql	= 'UPDATE %%USERS%% SET antimatter = antimatter - :antimatter WHERE id = :userId;';
			database::get()->update($sql, array(
				':antimatter'	=> $widrawAmount,
				':userId'		=> $userId,
			));
		}elseif(($USER['antimatter'] + $USER['antimatter_bought']) >= $widrawAmount){
			$USER['antimatter_bought'] 	-= $widrawAmount - $USER['antimatter'];
			$sql	= 'UPDATE %%USERS%% SET antimatter = 0, antimatter_bought = antimatter_bought - :antimatter_bought WHERE id = :userId;';
			database::get()->update($sql, array(
				':antimatter_bought'	=> $widrawAmount - $USER['antimatter'],
				':userId'				=> $userId,
			));
			$USER['antimatter'] 		= 0;
		}
	}
	
	public function getUsername($ID) {
		$username = '';
		$db	= Database::get();
		$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
		$getUser = $db->selectSingle($sql, array(
			':userId'		=> $ID,
		));
		
		$useName = empty($getUser['customNick']) ? $getUser['username'] : $getUser['customNick'];
		return $useName;
	}
	public function getAllianceTag($allianceID){
		$db	= Database::get();
		$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allianceID;';
		$diploRow = $db->selectSingle($sql, array(
			':allianceID'		=> $allianceID,
		));
		return $diploRow['ally_tag'];
	}
}