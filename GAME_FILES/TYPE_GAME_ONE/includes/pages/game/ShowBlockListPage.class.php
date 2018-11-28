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

class ShowBlockListPage extends AbstractGamePage
{
	public static $requireModule = MODULE_BUDDYLIST;

	function __construct() 
	{
		parent::__construct();
	}
	
	function show()
	{
		global $USER;
		
		$db = Database::get();
        $sql = "SELECT a.userID, a.blockID, a.time, a.reason, b.id, b.username, b.onlinetime,b.avatar, b.ally_id, c.ally_tag
		FROM (%%BLOCKLIST%% as a, %%USERS%% as b) LEFT JOIN %%ALLIANCE%% as c ON c.id = b.ally_id
		WHERE (a.userID = ".$USER['id']." AND a.blockedID = b.id) OR (a.blockedID = :userID AND a.userID = b.id);";
        $BuddyListResult = $db->select($sql, array(
            'userID'    => $USER['id']
        ));

        $myRequestList		= array();
		$otherRequestList	= array();
		$myBuddyList		= array();		
				
		foreach($BuddyListResult as $BuddyList)
		{
				$BuddyList['onlinetime']			= floor((TIMESTAMP - $BuddyList['onlinetime']) / 60);
				$BuddyList['time']			= date('Y-m-d H:i:s', $BuddyList['time']);
				$myBuddyList[$BuddyList['blockID']]	= $BuddyList;
		}
		
		$this->assign(array(
			'myBuddyList'		=> $myBuddyList,
			'myRequestList'			=> $myRequestList,
			'otherRequestList'	=> $otherRequestList,
		));
		
		$this->display('page.blocklist.default.tpl');
	}
	
	function delete()
	{
		global $USER, $LNG;
		
		$id	= HTTP::_GP('id', 0);
		$db = Database::get();

        $sql = "SELECT COUNT(*) as count FROM %%BLOCKLIST%% WHERE blockID = :id AND userID = :userID;";
        $isAllowed = $db->selectSingle($sql, array(
            ':id'  => $id,
            ':userID' => $USER['id']
        ), 'count');

		if($isAllowed)
		{
            $sql = "DELETE FROM %%BLOCKLIST%% WHERE blockID = :id;";
            $db->delete($sql, array(
                ':id'       => $id
            ));
        }
		$this->redirectTo("game.php?page=BlockList");
	}
	
	function Add()
	{
		global $USER, $LNG;
		
		$id	= HTTP::_GP('id', 0);
		$db = Database::get();

        $sql = "SELECT COUNT(*) as count FROM %%BLOCKLIST%% WHERE (blockedID = :id AND userID = :userID) OR (blockedID = :userID AND userID = :id);";
        $isExist = $db->selectSingle($sql, array(
            ':id'  => $id,
            ':userID' => $USER['id']
        ), 'count');

		if(!$isExist)
		{
            $sql = "INSERT INTO %%BLOCKLIST%% SET
                userID			= :userID,
                blockedID		= :blockedID,
                time			= :time;";

			$db->insert($sql, array(
				':userID'		=> $USER['id'],
				':blockedID'	=> $id,
				':time'			=> TIMESTAMP
			));
        }
		$this->redirectTo("game.php?page=BlockList");
	}
	
}