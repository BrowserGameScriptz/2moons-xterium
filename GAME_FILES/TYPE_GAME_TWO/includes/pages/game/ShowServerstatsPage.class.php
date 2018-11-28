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

class ShowServerstatsPage extends AbstractGamePage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
	}

	function show()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		
		if($USER['authlevel'] == 0)
			$this->printMessage('You are not allowed to access this page.', true, array('game.php?page=overview', 3));
			
		$sql	= "SELECT * FROM %%FLEETSTATS%% WHERE universe = 1;";
		$serverStats = database::get()->selectSingle($sql, array());
		
		
		$sql	= "SELECT COUNT(*) as total FROM %%LOG_FLEETS%% WHERE expeEvent = 1;";
		$serverStats1 = database::get()->selectSingle($sql, array());
		$sql	= "SELECT COUNT(*) as total FROM %%LOG_FLEETS%% WHERE expeEvent = 2;";
		$serverStats2 = database::get()->selectSingle($sql, array());
		$sql	= "SELECT COUNT(*) as total FROM %%LOG_FLEETS%% WHERE expeEvent = 3;";
		$serverStats3 = database::get()->selectSingle($sql, array());
		$sql	= "SELECT COUNT(*) as total FROM %%LOG_FLEETS%% WHERE expeEvent = 4;";
		$serverStats4 = database::get()->selectSingle($sql, array());
		$sql	= "SELECT COUNT(*) as total FROM %%LOG_FLEETS%% WHERE expeEvent = 5;";
		$serverStats5 = database::get()->selectSingle($sql, array());
		$sql	= "SELECT COUNT(*) as total FROM %%LOG_FLEETS%% WHERE expeEvent = 6;";
		$serverStats6 = database::get()->selectSingle($sql, array());
		$sql	= "SELECT COUNT(*) as total FROM %%LOG_FLEETS%% WHERE expeEvent = 7;";
		$serverStats7 = database::get()->selectSingle($sql, array());
		$sql	= "SELECT COUNT(*) as total FROM %%LOG_FLEETS%% WHERE expeEvent = 8;";
		$serverStats8 = database::get()->selectSingle($sql, array());
		$sql	= "SELECT COUNT(*) as total FROM %%LOG_FLEETS%% WHERE expeEvent = 9;";
		$serverStats9 = database::get()->selectSingle($sql, array());
		
		$sql	= "SELECT COUNT(*) as total FROM %%LOG_FLEETS%% WHERE expeEvent = 0 AND fleet_mission = 18;";
		$serverStats10 = database::get()->selectSingle($sql, array());
		
		$this->assign(array(
			'serverStats'	=> $serverStats,
			'serverStats1'	=> ($serverStats1['total']),
			'serverStats2'	=> ($serverStats2['total']),
			'serverStats3'	=> ($serverStats3['total']),
			'serverStats4'	=> ($serverStats4['total']),
			'serverStats5'	=> ($serverStats5['total']),
			'serverStats6'	=> ($serverStats6['total']),
			'serverStats7'	=> ($serverStats7['total']),
			'serverStats8'	=> ($serverStats8['total']),
			'serverStats9'	=> ($serverStats9['total']),
			'serverStats10'	=> ($serverStats10['total']),
		));
		
		$this->display('page.serverstats.default.tpl');
	}
}
