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

class ShowRefsystemPage extends AbstractGamePage
{
	public static $requireModule = MODULE_BANLIST;

	function __construct()
	{
	parent::__construct();
	}

	function show()
	{
	global $LNG, $USER;
	
	/* if($USER['id'] != 1){
	$this->printMessage('under maintenance', true, array('game.php?page=overview', 2));
	} */
		
	$this->assign(array(
	'ref_active'		=> Config::get()->ref_active,
	'ref_descrip'   	=> sprintf($LNG['ref_descrip'], pretty_number(config::get(ROOT_UNI)->ref_minpoints), pretty_number(config::get(ROOT_UNI)->ref_bonus), pretty_number(config::get(ROOT_UNI)->ref_bonus1), '%'),
	));
	$this->display('page.refsystem.default.tpl');
	}
	
	function refs()
	{
	global $LNG, $USER;
	
	$RefLinks		= array();
	$db	= Database::get();
	$sql	= 'SELECT u.id, u.username, u.customNick, s.total_points FROM %%USERS%% as u LEFT JOIN %%STATPOINTS%% as s ON s.id_owner = u.id AND s.stat_type = 1 WHERE ref_id = :ref_id;';
	$RefLinksRAW = $db->select($sql, array(
	':ref_id'	=> $USER['id']
	));
	
		
	foreach($RefLinksRAW as $RefRow) {
		$RefLinks[$RefRow['id']]	= array(
			'username'	=> empty($RefRow['customNick']) ? $RefRow['username'] : $RefRow['customNick'],
			'points'	=> min($RefRow['total_points'], Config::get()->ref_minpoints)
		);
	}
		
	$this->assign(array(
	'ref_active'				=> Config::get()->ref_active,
	'ref_minpoints'				=> Config::get()->ref_minpoints,
	'RefLinks'					=> $RefLinks,
	'SELF_URL'   		       => PROTOCOL.HTTP_HOST.HTTP_ROOT,
	));
	$this->display('page.refsystem.referals.tpl');
	}
}