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

class ShowBattleHallPage extends AbstractGamePage
{
	public static $requireModule = MODULE_BATTLEHALL;

	function __construct()
    {
		parent::__construct();
	}

	function show()
	{
		global $USER, $LNG;
		$order  = HTTP::_GP('order', 'units');
		$sort   = HTTP::_GP('sort', 'desc');
		$sort   = strtoupper($sort) === "DESC" ? "DESC" : "ASC";


		switch($order)
		{
			case 'date':
				$key = '%%TOPKB%%.time '.$sort;
				break;
			
			case 'units':
			default:
				$key = '%%TOPKB%%.units '.$sort;
				break;
		}

		/* $db = Database::get();
		$sql = "SELECT *, (
			SELECT DISTINCT
			IF(%%TOPKB_USERS%%.username = '', GROUP_CONCAT(%%USERS%%.username,' ',%%USERS%%.ally_id SEPARATOR ' & '), GROUP_CONCAT(%%TOPKB_USERS%%.username,' <span style=\"color:orange\">[',%%TOPKB_USERS%%.allyId SEPARATOR']</span> & '))
			FROM %%TOPKB_USERS%%
			LEFT JOIN %%USERS%% ON uid = %%USERS%%.id
			WHERE %%TOPKB_USERS%%.rid = %%TOPKB%%.rid AND role = 1
		) as attacker,
		(
			SELECT DISTINCT
			IF(%%TOPKB_USERS%%.username = '', GROUP_CONCAT(%%USERS%%.username,' ',%%USERS%%.ally_id SEPARATOR ' & '), GROUP_CONCAT(%%TOPKB_USERS%%.username,' <span style=\"color:orange\">[',%%TOPKB_USERS%%.allyId SEPARATOR ']</span> & '))
			FROM %%TOPKB_USERS%% INNER JOIN %%USERS%% ON uid = id
			WHERE %%TOPKB_USERS%%.rid = %%TOPKB%%.`rid` AND `role` = 2
		) as defender
		
		FROM %%TOPKB%% WHERE universe = :universe ORDER BY ".$key." LIMIT 100;"; */
		
		
		$db = Database::get();
		$sql = "SELECT *, (
			SELECT DISTINCT
			IF(%%TOPKB_USERS%%.username = '', GROUP_CONCAT(%%USERS%%.username SEPARATOR ' & '), GROUP_CONCAT(%%TOPKB_USERS%%.username SEPARATOR ' & '))
			FROM %%TOPKB_USERS%%
			LEFT JOIN %%USERS%% ON uid = %%USERS%%.id
			WHERE %%TOPKB_USERS%%.rid = %%TOPKB%%.rid AND role = 1
		) as attacker,
		(
			SELECT DISTINCT
			IF(%%TOPKB_USERS%%.username = '', GROUP_CONCAT(%%USERS%%.username SEPARATOR ' & '), GROUP_CONCAT(%%TOPKB_USERS%%.username SEPARATOR ' & '))
			FROM %%TOPKB_USERS%% INNER JOIN %%USERS%% ON uid = id
			WHERE %%TOPKB_USERS%%.rid = %%TOPKB%%.`rid` AND `role` = 2
		) as defender
		FROM %%TOPKB%% WHERE universe = :universe ORDER BY ".$key." LIMIT 100;";
		$top = $db->select($sql, array(
			':universe' => Universe::current()
		));


		$TopKBList	= array();
		foreach($top as $data)
		{
			
			$sql = "SELECT * FROM %%COMMENTSHOF%% WHERE rid = :rid;";
		  $COMMENTS	= database::get()->select($sql, array(
				':rid'	=> $data['rid']
			));
			
			$AMOUNTCOMMENT = count($COMMENTS);
			
			$TopKBList[]	= array(
				'result'	=> $data['result'],
				'date'		=> _date($LNG['php_tdformat'], $data['time'], $USER['timezone']),
				'time'		=> TIMESTAMP - $data['time'],
				'units'		=> $data['units'],
				'rid'		=> $data['rid'],
				'attacker'	=> $data['attacker'],
				'defender'	=> $data['defender'],
				'AMOUNTCOMMENT'	=> $AMOUNTCOMMENT,
				'date1'		=> $data['time'] > TIMESTAMP - 48*3600 ? 1 : 0,
			);
		}

		

		$this->assign(array(
			'TopKBList'		=> $TopKBList,
			'sort'			=> $sort,
			'order'			=> $order,
		));

		$this->display('page.battleHall.default.tpl');
	}
}