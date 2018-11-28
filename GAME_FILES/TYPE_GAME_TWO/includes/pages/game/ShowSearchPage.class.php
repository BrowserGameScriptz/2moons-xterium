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

class ShowSearchPage extends AbstractGamePage
{
	public static $requireModule = MODULE_SEARCH;
	
	function __construct() {
		parent::__construct();
	}

	static function _getSearchList($searchMode, $searchText, $maxResult)
	{
		global $USER;
		
		$db = Database::get();
				
		$limit		= $maxResult === -1 ? '' : 'LIMIT '.((int) 75);
		
		$searchList	= array();

		switch($searchMode) {
			case 'playername':
				$sql = "SELECT a.id, a.username, a.customNick, a.outlaw, a.banaday, a.onlinetime, a.ally_id, b.galaxy, b.system, b.planet, b.name, b.id as planetId, c.total_points, c.defs_points, c.fleet_points, c.total_rank, c.honor_rank, d.ally_name
				FROM %%USERS%% as a
				INNER JOIN %%PLANETS%% as b ON b.id_owner = a.id
				LEFT JOIN %%STATPOINTS%% as c ON c.id_owner = a.id AND c.stat_type = 1
				LEFT JOIN %%ALLIANCE%% as d ON d.id = a.ally_id
				WHERE (a.universe = :universe AND a.username LIKE :searchTextLike) OR (a.universe = :universe AND a.customNick LIKE :searchTextLike) 
				ORDER BY (
				  IF(a.username = :searchText, 1, 0)
				  + IF(a.username LIKE :searchTextLike, 1, 0)
				  + IF(a.customNick LIKE :searchTextLike, 1, 0)
				  + IF(a.customNick LIKE :searchTextLike, 1, 0)
				) DESC, a.username, a.customNick ASC
				".$limit.";";
				$searchResult = $db->select($sql, array(
					':universe'			=> Universe::current(),
					':searchText' 		=> $searchText,
					':searchTextLike'	=> '%'.$searchText.'%'
				));

				$sql	= "SELECT user.*, stat.total_points, stat.defs_points, stat.fleet_points, stat.total_rank, stat.honor_rank FROM %%USERS%% as user LEFT JOIN %%STATPOINTS%% as stat ON stat.id_owner = user.id WHERE user.id = :userId AND stat.stat_type = 1;";
				$USERDATALOL4	= database::get()->selectSingle($sql, array(
					':userId'	=> $USER['id']
				));
					
				foreach($searchResult as $searchRow)
				{
					$IsNoobProtec		= CheckNoobProtec($USERDATALOL4, $searchRow, $searchRow);
					$outlawSearch 			= 0;
					if($IsNoobProtec['StrongPlayer'] && $searchRow['id'] != 9999)
						$outlawSearch	 	= 1; 
			
					$searchList[]	= array(
						'planetname'	=> $searchRow['name'],
						'username' 		=> empty($searchRow['customNick']) ? $searchRow['username'] : $searchRow['customNick'],
						'userid' 		=> $searchRow['id'],
						'allyname'	 	=> $searchRow['ally_name'],
						'allyid'		=> $searchRow['ally_id'],
						'galaxy' 		=> $searchRow['galaxy'],
						'system'		=> $searchRow['system'],
						'planet'		=> $searchRow['planet'],
						'rank'			=> $searchRow['total_rank'],
						'outlawSearch'	=> $USER['outlaw'] > TIMESTAMP ? 0 : $outlawSearch,
						'planetId'		=> $searchRow['planetId'],
						'myuserId'		=> $searchRow['id'],
					);	
				}
			break;
			case 'planetname':

				$sql = "SELECT a.name, a.galaxy, a.planet, a.system,
				b.id, b.ally_id, b.username, b.customNick,
				c.total_rank,
				d.ally_name
				FROM %%PLANETS%% as a
				INNER JOIN %%USERS%% as b ON b.id = a.id_owner
				LEFT JOIN  %%STATPOINTS%% as c ON c.id_owner = b.id AND c.stat_type = 1
				LEFT JOIN %%ALLIANCE%% as d ON d.id = b.ally_id
				WHERE a.universe = :universe AND a.name LIKE :searchTextLike
				ORDER BY (
				  IF(a.name = :searchText, 1, 0)
				  + IF(a.name LIKE :searchTextLike, 1, 0)
				) DESC, a.name ASC
				".$limit.";";

				$searchResult = $db->select($sql, array(
					':universe'			=> Universe::current(),
					':searchText' 		=> $searchText,
					':searchTextLike'	=> '%'.$searchText.'%'
				));

				foreach($searchResult as $searchRow)
				{
					$searchList[]	= array(
						'planetname'	=> $searchRow['name'],
						'username' 		=> empty($searchRow['customNick']) ? $searchRow['username'] : $searchRow['customNick'],
						'userid' 		=> $searchRow['id'],
						'allyname'	 	=> $searchRow['ally_name'],
						'allyid'		=> $searchRow['ally_id'],
						'galaxy' 		=> $searchRow['galaxy'],
						'system'		=> $searchRow['system'],
						'planet'		=> $searchRow['planet'],
						'rank'			=> $searchRow['total_rank'],
					);	
				}
			break;
			case "allytag":
				$sql = "SELECT a.id, a.ally_name, a.ally_tag, a.ally_members,
				c.total_points FROM %%ALLIANCE%% as a
				LEFT JOIN %%STATPOINTS%% as c ON c.stat_type = 1 AND c.id_owner = a.id
				WHERE a.ally_universe = :universe AND a.ally_tag LIKE :searchTextLike
				ORDER BY (
				  IF(a.ally_tag = :searchText, 1, 0)
				  + IF(a.ally_tag LIKE :searchTextLike, 1, 0)
				) DESC, a.ally_tag ASC
				".$limit.";";

				$searchResult = $db->select($sql, array(
					':universe'			=> Universe::current(),
					':searchText' 		=> $searchText,
					':searchTextLike'	=> '%'.$searchText.'%'
				));

				foreach($searchResult as $searchRow)
				{
					$searchList[]	= array(
						'allypoints'	=> pretty_number($searchRow['total_points']),
						'allytag'		=> $searchRow['ally_tag'],
						'allymembers'	=> $searchRow['ally_members'],
						'allyname'		=> $searchRow['ally_name'],
					);
				}
			break;
			case "allyname":
				$sql = "SELECT a.ally_name, a.ally_tag, a.ally_members,
				b.total_points FROM %%ALLIANCE%% as a
				LEFT JOIN %%STATPOINTS%% as b ON b.stat_type = 1 AND b.id_owner = a.id
				WHERE a.ally_universe = :universe AND a.ally_name LIKE :searchTextLike
				ORDER BY (
				  IF(a.ally_name = :searchText, 1, 0)
				  + IF(a.ally_name LIKE :searchTextLike, 1, 0)
				) DESC,a.ally_name ASC
				".$limit.";";

				$searchResult = $db->select($sql, array(
					':universe'			=> Universe::current(),
					':searchText' 		=> $searchText,
					':searchTextLike'	=> '%'.$searchText.'%'
				));

				foreach($searchResult as $searchRow)
				{
					$searchList[]	= array(
						'allypoints'	=> pretty_number($searchRow['total_points']),
						'allytag'		=> $searchRow['ally_tag'],
						'allymembers'	=> $searchRow['ally_members'],
						'allyname'		=> $searchRow['ally_name'],
					);
				}
			break;
		}
		
		return $searchList;
	}
	
	function autocomplete()
	{
		global $LNG;
		
		$this->setWindow('ajax');
		
		$seachMode 	= HTTP::_GP('type', 'playername');
		$searchText	= HTTP::_GP('term', '', UTF8_SUPPORT);
		
		$searchList	= array();
		
		$seachModes	= explode('|', $seachMode);
		
		if(empty($searchText)) {
			$this->sendJSON(array());
		}
		
		foreach($seachModes as $search)
		{
			$searchData	= self::_getSearchList($search, $searchText, 5);
			foreach($searchData as $data) {
				switch($search) {
					case 'playername':
						$searchList[]	= array('label' => str_replace($searchText, '<b>'.$searchText.'</b>', $data['username']), 'category' => $LNG['sh_player_name'], 'type' => 'playername');
					break;
					case 'planetname':
						$searchList[]	= array('label' => str_replace($searchText, '<b>'.$searchText.'</b>', $data['username']), 'category' => $LNG['sh_planet_name'], 'type' => 'planetname');
					break;
					case "allytag":
						$searchList[]	= array('label' => str_replace($searchText, '<b>'.$searchText.'</b>', $data['allytag']), 'category' => $LNG['sh_alliance_tag'], 'type' => 'allytag');
					break;
					case "allyname":
						$searchList[]	= array('label' => str_replace($searchText, '<b>'.$searchText.'</b>', $data['allyname']), 'category' => $LNG['sh_alliance_name'], 'type' => 'allyname');
					break;
				}
			}
		}
		
		$this->sendJSON($searchList);
	}
	
	function result()
	{
		global $THEME;
		
		$this->initTemplate();
		$this->setWindow('ajax');
		
		$seachMode 	= HTTP::_GP('type', 'playername');
		$searchText	= HTTP::_GP('search', '', UTF8_SUPPORT);
		
		$searchList	= array();
		
		if(!empty($searchText))
		{
			$searchList	= self::_getSearchList($seachMode, $searchText, SEARCH_LIMIT);
		}
		
		$this->assign(array(
			'searchList'	=> $searchList,
            'dpath'			=> $THEME->getTheme(),
		));
		
		$templateSuffix	= ($seachMode === "allyname" || $seachMode === "allytag") ? "ally" : "default";
		
		$this->display('page.search.result.'.$templateSuffix.'.tpl');
	}
	
	function show()
	{
		global $LNG, $THEME, $USER;
		
		$seachMode 		= HTTP::_GP('type', 'playername');
		
		$modeSelector	= array('playername' => $LNG['sh_player_name'], 'planetname' => $LNG['sh_planet_name'], 'allytag' => $LNG['sh_alliance_tag'], 'allyname' => $LNG['sh_alliance_name']);
		$this->tplObj->loadscript('search.js');
		$this->assign(array(
			'modeSelector'	=> $modeSelector,
			'seachMode'		=> $seachMode,
			'settings_fleetactions'		=> $USER['settings_fleetactions'],
		));
		
		$this->display('page.search.default.tpl');
	}
}