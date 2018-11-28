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


class ShowStatisticsPage extends AbstractGamePage
{
    public static $requireModule = MODULE_STATISTICS;

	function __construct() 
	{
		parent::__construct();
	}

    function show()
    {
        global $USER, $LNG;

        $who   	= HTTP::_GP('who', 1);
        $type  	= HTTP::_GP('type', 1);
        $range 	= HTTP::_GP('range', 1);
		
        switch ($type)
        {
            case 2:
                $Order   = "fleet_rank";
                $Points  = "fleet_points";
                $CountPv = "fleet_count";
                $Rank    = "fleet_rank";
                $OldRank = "fleet_old_rank";
            break;
            case 3:
                $Order   = "tech_rank";
                $Points  = "tech_points";
				$CountPv = "tech_count";
                $Rank    = "tech_rank";
                $OldRank = "tech_old_rank";
            break;
            case 4:
                $Order   = "build_rank";
                $Points  = "build_points";
				$CountPv = "build_count";
                $Rank    = "build_rank";
                $OldRank = "build_old_rank";
            break;
            case 5:
                $Order   = "defs_rank";
                $Points  = "defs_points";
				$CountPv = "defs_count";
                $Rank    = "defs_rank";
                $OldRank = "defs_old_rank";
            break;
			case 6:
                $Order   = "ach_rank";
                $Points  = "ach_points";
				$CountPv = "ach_count";
                $Rank    = "ach_rank";
                $OldRank = "ach_old_rank";
            break;
			case 8:
                $Order   = "vote_rank";
                $Points  = "vote_points";
				$CountPv = "vote_count";
                $Rank    = "vote_rank";
                $OldRank = "vote_old_rank";
            break;
			case 9:
                $Order   = "wapeonry_rank";
                $Points  = "wapeonry_points";
				$CountPv = "wapeonry_count";
                $Rank    = "wapeonry_rank";
                $OldRank = "wapeonry_old_rank";
            break;
			case 10:
                $Order   = "honor_rank";
                $Points  = "honor_points";
				$CountPv = "honor_count";
                $Rank    = "honor_rank";
                $OldRank = "honor_old_rank";
            break;
            default:
                $Order   = "total_rank";
                $Points  = "total_points";
				$CountPv = "total_count";
                $Rank    = "total_rank";
                $OldRank = "total_old_rank";
            break;
        }

        $RangeList  = array();

		$db 	= Database::get();
		$config	= Config::get();
		
		$sql	= "SELECT user.*, stat.total_points, stat.defs_points, stat.fleet_points FROM %%USERS%% as user LEFT JOIN %%STATPOINTS%% as stat ON stat.id_owner = user.id WHERE user.id = :userId AND stat.stat_type = 1;";
		$CurrentUserPoints	= $db->selectSingle($sql, array(
			':userId'	=> $USER['id']
		));
		
		$sql =  "SELECT nextTime FROM %%CRONJOBS%% WHERE cronjobID = :cronId;";
		$nextTime = $db->selectSingle($sql, array(
			':cronId'			=> 2
		), 'nextTime');
		
		$sql =  "SELECT total_rank FROM %%STATPOINTS%% ORDER BY total_rank DESC LIMIT 1;";
		$Lowestrank = $db->selectSingle($sql, array(
		), 'total_rank');
					

        switch($who)
        {
            case 1:
                $MaxUsers 	= $config->users_amount;
                $range		= min($range, $MaxUsers);
                $LastPage 	= max(1, ceil($MaxUsers / 100));

                for ($Page = 0; $Page < $LastPage; $Page++)
                {
                    $PageValue      				= ($Page * 100) + 1;
                    $PageRange      				= $PageValue + 99;
                    $Selector['range'][$PageValue] 	= $PageValue."-".$PageRange;
                }

                $start = max(floor(($range - 1) / 100) * 100, 0);

				if ($config->stat == 2) {
					$sql = "SELECT DISTINCT s.*, h.*, u.id, u.username, u.protectionTimer, u.customNick, u.urlaubs_next_allowed, u.urlaubs_modus, u.outlaw, u.onlinetime, u.honour_points, u.playercard_country, u.bana, u.banaday, u.ally_id, a.ally_name, a.ally_tag, a.ally_fraction_id, a.ally_fraction_level, u.lang FROM %%STATPOINTS%% as s
					INNER JOIN %%USERS%% as u ON u.id = s.id_owner
					INNER JOIN %%STATHISTORY%% as h ON h.id_owner = u.id
					LEFT JOIN %%ALLIANCE%% as a ON a.id = s.id_ally
					WHERE s.universe = :universe AND s.stat_type = 1 AND u.authlevel < :authLevel 
					GROUP BY s.id_owner ORDER BY ".$Order." ASC LIMIT :offset, :limit;";
					$query = $db->select($sql, array(
						':universe'	=> Universe::current(),
						':authLevel'=> $config->stat_level,
						':offset'	=> $start,
						':limit'	=> 100,
					));
				} else {
					$sql = "SELECT DISTINCT s.*, h.*, u.id, u.username, u.protectionTimer, u.customNick, u.urlaubs_next_allowed, u.urlaubs_modus, u.onlinetime, u.outlaw, u.honour_points, u.playercard_country, u.banaday, u.ally_id, a.ally_name, a.ally_tag, a.ally_fraction_id, a.ally_fraction_level, u.lang FROM %%STATPOINTS%% as s
					INNER JOIN %%USERS%% as u ON u.id = s.id_owner
					INNER JOIN %%STATHISTORY%% as h ON h.id_owner = u.id
					LEFT JOIN %%ALLIANCE%% as a ON a.id = s.id_ally
					WHERE s.universe = :universe AND s.stat_type = 1
					GROUP BY s.id_owner ORDER BY ".$Order." ASC LIMIT :offset, :limit;";
					$query = $db->select($sql, array(
						':universe'	=> Universe::current(),
						':offset'	=> $start,
						':limit'	=> 100,
					));
				}

				$RangeList	= array();

                foreach ($query as $StatRow)
                {
					$sql =  "SELECT COUNT(*) as count FROM %%BUDDY%% WHERE (sender = :userID AND owner = :targetID AND buddyType = 1 AND isAccepted = 1) OR (sender = :targetID AND owner = :userID AND buddyType = 1 AND isAccepted = 1);";
					$isFriend = $db->selectSingle($sql, array(
					':userID'			=> $USER['id'],
					':targetID'			=> $StatRow['id']
					));
					
					$sqld =  "SELECT COUNT(*) as count FROM %%BUDDY%% WHERE sender = :userID AND owner = :targetID AND buddyType = :buddyType;";
					$isEnnemie = $db->selectSingle($sqld, array(
					':userID'			=> $USER['id'],
					':targetID'			=> $StatRow['id'],
					':buddyType'			=> 2
					));
					
					$IsNoobProtec		= CheckNoobProtec($CurrentUserPoints, $StatRow, $StatRow);
					$Class		 		= array();
					$ClassB		 		= array();
 
					if ($StatRow['protectionTimer'] >= TIMESTAMP)
					{
						$Class		 	= array('rose');
					}
					elseif ($StatRow['banaday'] > TIMESTAMP && $StatRow['bana'] == 1 && $StatRow['urlaubs_modus'] == 1)
					{
						$Class		 	= array('banni_serveur', 'violet');
					}
					elseif ($StatRow['banaday'] > TIMESTAMP && $StatRow['bana'] == 1)
					{
						$Class		 	= array('banni_serveur');
					}
					elseif ($StatRow['urlaubs_modus'] == 1)
					{
						$Class		 	= array('violet');
					}
					elseif($isEnnemie['count'] > 0)
					{
						$Class		 	= array('brown');
					} 
					elseif($isFriend['count'] > 0)
					{
						$Class		 	= array('jaune');
					}
					elseif ($StatRow['outlaw'] > TIMESTAMP)
					{
						$Class		 	= array('outlaw');
					}
					elseif ($IsNoobProtec['NoobPlayer'] && $StatRow['id'] != 9999)
					{
						$Class		 	= array('vert');
					}
					elseif ($IsNoobProtec['StrongPlayer'] && $StatRow['id'] != 9999)
					{
						$Class		 	= array('rouge');
					}
					elseif ($StatRow['onlinetime'] < TIMESTAMP - INACTIVE_LONG)
					{
						$Class		 	= array('longinactive');
					}
					elseif ($StatRow['onlinetime'] < TIMESTAMP - INACTIVE)
					{
						$Class		 	= array('inactive');
					}
					
					if ($IsNoobProtec['NoobPlayer'])
					{
						$ClassB		 	= array('vert');
					}
					elseif ($IsNoobProtec['StrongPlayer'])
					{
						$ClassB		 	= array('rouge');
					}
					
					$HonourStatus = "none";
					if($StatRow['honour_points'] >= 150000 && $StatRow['honor_rank'] <= 10){
						$HonourStatus = "rank_starlord3";
					}elseif($StatRow['honour_points'] >= 25000 && $StatRow['honor_rank'] <= 100){
						$HonourStatus = "rank_starlord2";
					}elseif($StatRow['honour_points'] >= 5000 && $StatRow['honor_rank'] <= 250){
						$HonourStatus = "rank_starlord1";
					}elseif($StatRow['honour_points'] <= -150000 && ($Lowestrank - 10) <= $StatRow['honor_rank']){
						$HonourStatus = "rank_bandit1";
					}elseif($StatRow['honour_points'] <= -25000 && ($Lowestrank - 100) <= $StatRow['honor_rank']){
						$HonourStatus = "rank_bandit2";
					}elseif($StatRow['honour_points'] <= -5000 && ($Lowestrank - 250) <= $StatRow['honor_rank']){
						$HonourStatus = "rank_bandit3";
					}
					
                    $RangeList[]	= array(
						'class'		=> $Class,
						'urlaubs_next_allowed'=> $StatRow['urlaubs_next_allowed'] > TIMESTAMP ? 1 : 0,
						'HonourStatus'		=> $HonourStatus,
						'honour_points'		=> pretty_number($StatRow['honour_points']),
						'honour_pots'		=> $StatRow['honour_points'],
						'classb'		=> $ClassB,
                        'id'		=> $StatRow['id'],
                        'name'		=> empty($StatRow['customNick']) ? $StatRow['username'] : $StatRow['customNick'], 
                        'points'	=> pretty_number($StatRow[$Points]),
                        'allyid'	=> $StatRow['ally_id'],
                        'rank'		=> $StatRow[$Rank],
                        'allyname'	=> $StatRow['ally_name'],
						'allytag'	=> $StatRow['ally_tag'],
                        'ally_fraction_id'	=> $StatRow['ally_fraction_id'],
                        'ally_fraction_level'	=> $StatRow['ally_fraction_level'],
                        'ally_fraction_name'	=> $LNG['all_frac_'.$StatRow['ally_fraction_id']],
                        'langused'	=> $StatRow['lang'],
                        'playercard_country'	=> $StatRow['playercard_country'],
						'dif'		=> $StatRow['history_'.$Points]- $StatRow[$Rank], 
						'pointsinday'	=> $StatRow[$Points] - $StatRow['history_'.$Points.'O'], 
                        'ranking'	=> $StatRow[$OldRank] - $StatRow[$Rank],
                        'totalCount'	=> $StatRow[$CountPv],
                    );
                }

            break;
            case 2:
                $sql = "SELECT COUNT(*) as state FROM %%ALLIANCE%% WHERE `ally_universe` = :universe;";
				$MaxAllys = $db->selectSingle($sql, array(
					':universe'	=> Universe::current(),
				), 'state');

				$range		= min($range, $MaxAllys);
                $LastPage 	= max(1, ceil($MaxAllys / 100));
				
                for ($Page = 0; $Page < $LastPage; $Page++)
                {
                    $PageValue      				= ($Page * 100) + 1;
                    $PageRange      				= $PageValue + 99;
                    $Selector['range'][$PageValue] 	= $PageValue."-".$PageRange;
                }

                $start = max(floor(($range - 1) / 100) * 100, 0);

                $sql = 'SELECT DISTINCT s.*, a.id, a.ally_members, a.ally_name, a.ally_tag, a.ally_fraction_id, a.ally_fraction_level FROM %%STATPOINTS%% as s
                INNER JOIN %%ALLIANCE%% as a ON a.id = s.id_owner
                WHERE universe = :universe AND stat_type = 2
                ORDER BY '.$Order.' ASC LIMIT :offset, :limit;';
				$query = $db->select($sql, array(
					':universe'	=> Universe::current(),
					':offset'	=> $start,
					':limit'	=> 100,
				));

				foreach ($query as $StatRow)
                {
					$sql =  "SELECT * FROM %%DIPLO%% WHERE (owner_1 = :owner_1 AND owner_2 = :owner_2) OR (owner_1 = :owner_2 AND owner_2 = :owner_1) AND accept = :accept AND level = :level;";
					$isWar = $db->select($sql, array(
					':owner_1'			=> $USER['ally_id'],
					':owner_2'			=> $StatRow['id'],
					':accept'			=> 1,
					':level'			=> 5
					));
                    
					$sql =  "SELECT * FROM %%DIPLO%% WHERE (owner_1 = :owner_1 AND owner_2 = :owner_2) OR (owner_1 = :owner_2 AND owner_2 = :owner_1) AND accept = :accept AND level = :level;";
					$isUnion = $db->select($sql, array(
					':owner_1'			=> $USER['ally_id'],
					':owner_2'			=> $StatRow['id'],
					':accept'			=> 1,
					':level'			=> 2
					));
					
                    $RangeList[]	= array(
                        'id'		=> $StatRow['id'],
                        'name'		=> $StatRow['ally_name'],
						'ally_fraction_id'	=> $StatRow['ally_fraction_id'],
                        'ally_fraction_level'	=> $StatRow['ally_fraction_level'],
                        'ally_fraction_name'	=> $LNG['all_frac_'.$StatRow['ally_fraction_id']],
                        'members'	=> $StatRow['ally_members'],
                        'rank'		=> $StatRow[$Rank],
                        'mppoints'	=> pretty_number(floor($StatRow[$Points] / max(1,$StatRow['ally_members']))),
                        'points'	=> pretty_number($StatRow[$Points]),
                        'ranking'	=> $StatRow[$OldRank] - $StatRow[$Rank],
                        'isWar'		=> count($isWar),
                        'isUnion'	=> count($isUnion),
                    );
                }

            break;
        }

        $Selector['who'] 	= array(1 => $LNG['st_player'], 2 => $LNG['st_alliance']);
        $Selector['type']	= array(1 => $LNG['st_points'], 2 => $LNG['st_fleets'], 3 => $LNG['st_researh'], 4 => $LNG['st_buildings'], 5 => $LNG['st_defenses'], 6 => $LNG['st_achievements'], 8 => $LNG['st_voted'], 9 => 'Wapeonry', 10 => 'Honor');


		require_once 'includes/classes/Cronjob.class.php';

        $this->assign(array(
            'Selectors'				=> $Selector,
            'who'					=> $who,
            'type'					=> $type,
            'range'					=> floor(($range - 1) / 100) * 100 + 1,
            'RangeList'				=> $RangeList,
            'CUser_ally'			=> $USER['ally_id'],
            'CUser_id'				=> $USER['id'],
            'nextStatUpdate' 		=> abs(TIMESTAMP - $nextTime),
            'stat_date'				=> _date($LNG['php_tdformat'], Cronjob::getLastExecutionTime('statistic'), $USER['timezone']),
        ));

        $this->display('page.statistics.default.tpl');
    }
}