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

class StatHistoryCronjob implements CronjobTask
{
	function run()
	{
		require 'includes/classes/class.statbuilder.php';
		$stat			= new Statbuilder();
		$result			= $stat->MakeStats();
				
		$db	= Database::get();
		$sql	= "SELECT id_owner, universe, build_rank, tech_rank, fleet_rank, defs_rank, honor_rank, wapeonry_rank, ach_rank, vote_rank, total_rank, tech_points, build_points, defs_points, fleet_points, honor_points, wapeonry_points, ach_points, vote_points, total_points FROM %%STATPOINTS%% WHERE stat_type = :stat_type;";
		$Data = $db->select($sql, array(
		':stat_type'	=> 1
		));
		
		$sql	= "DELETE FROM %%STATHISTORY%%;";
		$db->delete($sql, array(
		));
		
		foreach($Data as $i)
		{
			$statIdOwner = $i['id_owner'];
			$statIdTime = TIMESTAMP;
			$statIdUni = $i['universe'];
			$statIdBuild = $i['build_rank'];
			$statIdTech = $i['tech_rank'];
			$statIdFleet = $i['fleet_rank'];
			$statIdDefs = $i['defs_rank'];
			$statIdHonor = $i['honor_rank'];
			$statIdWapeonry = $i['wapeonry_rank'];
			$statIdAch = $i['ach_rank'];
			$statIdVote = $i['vote_rank'];
			$statIdTotal = $i['total_rank'];
			
			$statIdBuildO = $i['build_points'];
			$statIdTechO = $i['tech_points'];
			$statIdFleetO = $i['fleet_points'];
			$statIdDefsO = $i['defs_points'];
			$statIdHonorO = $i['honor_points'];
			$statIdWapeonryO = $i['wapeonry_points'];
			$statIdAchO = $i['ach_points'];
			$statIdVoteO = $i['vote_points'];
			$statIdTotalO = $i['total_points'];
			
			$sql = "INSERT INTO %%STATHISTORY%% SET
                id_owner	= :id_owner,
                time		= :time,
                universe	= :universe,
                history_build_points	= :history_build_points,
                history_tech_points		= :history_tech_points,
                history_fleet_points		= :history_fleet_points,
                history_defs_points		= :history_defs_points,
                history_ach_points	= :history_ach_points,
                history_honor_points	= :history_honor_points,
                history_wapeonry_points	= :history_wapeonry_points,
                history_vote_points	= :history_vote_points,
                history_total_points	= :history_total_points,
				history_build_pointsO	= :history_build_pts,
                history_tech_pointsO		= :history_tech_pts,
                history_fleet_pointsO		= :history_fleet_pts,
                history_defs_pointsO		= :history_defs_pts,
                history_ach_pointsO	= :history_ach_pts,
                history_honor_pointsO	= :history_honor_pts,
                history_wapeonry_pointsO	= :history_wapeonry_pts,
                history_vote_pointsO	= :history_vote_pts,
                history_total_pointsO	= :history_total_pts;";

			$db->insert($sql, array(
				':id_owner'	=> $statIdOwner,
				':time'			=> $statIdTime,
				':universe'			=> $statIdUni,
				':history_build_points'			=> $statIdBuild,
				':history_tech_points'			=> $statIdTech,
				':history_fleet_points'			=> $statIdFleet,
				':history_defs_points'			=> $statIdDefs,
				':history_ach_points'			=> $statIdAch,
				':history_honor_points'			=> $statIdHonor,
				':history_wapeonry_points'			=> $statIdWapeonry,
				':history_vote_points'			=> $statIdVote,
				':history_total_points'			=> $statIdTotal,
				':history_build_pts'			=> $statIdBuildO,
				':history_tech_pts'			=> $statIdTechO,
				':history_fleet_pts'			=> $statIdFleetO,
				':history_defs_pts'			=> $statIdDefsO,
				':history_ach_pts'			=> $statIdAchO,
				':history_honor_pts'			=> $statIdHonorO,
				':history_wapeonry_pts'			=> $statIdWapeonryO,
				':history_vote_pts'			=> $statIdVoteO,
				':history_total_pts'			=> $statIdTotalO
			));
		}
		
	}
}