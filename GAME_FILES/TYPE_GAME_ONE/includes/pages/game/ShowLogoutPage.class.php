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


class ShowLogoutPage extends AbstractGamePage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
		
	}
	
	function show() 
	{
		global $USER;
		
		$sql	= 'SELECT * FROM %%BUDDY%% WHERE (sender = :userId AND buddyType = 1) OR (owner = :userId AND buddyType = 1);';
		$getFriends = database::get()->select($sql, array(
			':userId'		=> $USER['id'],
		));
		
		foreach($getFriends as $friend){
			if($friend['sender'] == $USER['id'])
				$friendId = $friend['owner'];
			else
				$friendId = $friend['sender'];
			
			$sql = "SELECT COUNT(*) as count FROM %%BUDDY_REQUEST%% WHERE id = :id;";
            $isRequest = database::get()->selectSingle($sql, array(
                ':id'  => $friend['id']
            ), 'count');
			
			if($isRequest)
				continue;
			
			$friendData	= GetFromDatabase('USERS', 'id', $friendId, array('lang', 'username'));
			$LNGD = new Language($friendData['lang']);
			$LNGD->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME'));

			$sql = "INSERT INTO %%NOTIF%% SET userId = :userId, timestamp = :timestamp, noText = :noText, noImage = :noImage, isType = :isType;";
			database::get()->insert($sql, array(
				':userId'		=> $friendId,
				':timestamp'	=> TIMESTAMP,
				':noText'		=> sprintf($LNGD['backNotification_2'], $USER['username']),
				':noImage'		=> "/media/files/".$USER['avatar'],
				':isType'		=> 2
			));
		}
		
		
		
		Session::load()->delete();
		$this->display('page.logout.default.tpl');
	}
}