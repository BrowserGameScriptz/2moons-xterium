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

class ShowBuddyListPage extends AbstractGamePage
{
	public static $requireModule = MODULE_BUDDYLIST;

	function __construct() 
	{
		parent::__construct();
	}
	
	function deleteennemies()
	{
		global $USER, $LNG;
		
		$id	= HTTP::_GP('id', 0);
		$db = Database::get();

        $sql = "SELECT COUNT(*) as count FROM %%BUDDY%% WHERE id = :id AND sender = :userID  AND buddyType = 2;";
        $isAllowed = $db->selectSingle($sql, array(
            ':id'  => $id,
            ':userID' => $USER['id']
        ), 'count');

		if($isAllowed)
		{
			$sql = "SELECT COUNT(*) as count FROM %%BUDDY_REQUEST%% WHERE id = :id;";
            $isRequest = $db->selectSingle($sql, array(
                ':id'  => $id
            ), 'count');
			
			if($isRequest)
			{
                $sql = "SELECT u.username, u.customNick, u.id FROM %%BUDDY%% b INNER JOIN %%USERS%% u ON u.id = IF(b.sender = :userID,b.owner,b.sender) WHERE b.id = :id AND b.buddyType = 2;";
                $requestData = $db->selectSingle($sql, array(
                    ':id'       => $id,
                    'userID'    => $USER['id']
                ));
				$useNickOw = empty($USER['customNick']) ? $USER['username'] : $USER['customNick'];
				$useNickRq = empty($requestData['customNick']) ? $requestData['username'] : $requestData['customNick'];
				PlayerUtil::sendMessage($requestData['id'], $USER['id'], $useNickOw, 4, $LNG['bu_rejected_request_title'], sprintf($LNG['bu_rejected_request_body'], $useNickRq, $useNickOw), TIMESTAMP);
			}

            $sql = "DELETE b.*, r.* FROM %%BUDDY%% b LEFT JOIN %%BUDDY_REQUEST%% r USING (id) WHERE b.id = :id AND b.buddyType = 2;";
            $db->delete($sql, array(
                ':id'       => $id
            ));
        }
		$this->redirectTo("game.php?page=buddyList&mode=enemies");
	}
	
	
	function request()
	{
		global $USER, $LNG;
		
		$this->initTemplate();
		$this->setWindow('popup');
		
		$id	= HTTP::_GP('id', 0);
		
		if($id == $USER['id'])
		{
			$this->printMessage($LNG['bu_cannot_request_yourself'], true, array('game.php?page=buddyList', 2));
		}
		
		$db = Database::get();

        $sql = "SELECT COUNT(*) as count FROM %%BUDDY%% WHERE (sender = :userID AND owner = :friendID AND buddyType = :buddyType) OR (owner = :userID AND sender = :friendID AND buddyType = :buddyType);";
        $exists = $db->selectSingle($sql, array(
            ':userID'	=> $USER['id'],
            ':friendID'  => $id,
            ':buddyType'  => 1
        ), 'count');

		if($exists != 0)
		{
			$this->printMessage($LNG['bu_request_exists'], true, array('game.php?page=buddyList', 2));
		}
		
		$sql = "SELECT username, customNick, galaxy, system, planet FROM %%USERS%% WHERE id = :friendID;";
        $userData = $db->selectSingle($sql, array(
            ':friendID'  => $id
        ));

		$this->assign(array(
			'username'	=> empty($userData['customNick']) ? $userData['username'] : $userData['customNick'],
			'galaxy'	=> $userData['galaxy'],
			'system'	=> $userData['system'],
			'planet'	=> $userData['planet'],
			'id'		=> $id,
		));
		
		$this->display('page.buddyList.request.tpl');
	}
	
	function send()
	{
		global $USER, $LNG;
		
		$this->initTemplate();
		$this->setWindow('popup');
		$this->tplObj->execscript('window.setTimeout(parent.$.fancybox.close, 2000);');
		
		$id		= HTTP::_GP('id', 0);
		$text	= HTTP::_GP('text', '', UTF8_SUPPORT);

		if($id == $USER['id'])
		{
			$this->printMessage($LNG['bu_cannot_request_yourself'], true, array('game.php?page=buddyList', 2));
		}

        $db = Database::get();

        $sql = "SELECT COUNT(*) as count FROM %%BUDDY%% WHERE (sender = :userID AND owner = :friendID AND buddyType = :buddyType) OR (owner = :userID AND sender = :friendID AND buddyType = :buddyType);";
        $exists = $db->selectSingle($sql, array(
            ':userID'	=> $USER['id'],
            ':friendID'  => $id,
			':buddyType' => 1
        ), 'count');

        if($exists != 0)
		{
			$this->printMessage($LNG['bu_request_exists'], true, array('game.php?page=buddyList', 2));
		}

        $sql = "INSERT INTO %%BUDDY%% SET sender = :userID,	owner = :friendID, universe = :universe, buddyType = :buddyType;";
        $db->insert($sql, array(
            ':userID'	=> $USER['id'],
            ':friendID'  => $id,
            ':universe' => Universe::current(),
            ':buddyType' => 1
        ));

        $buddyID	= $db->lastInsertId();

		$sql = "INSERT INTO %%BUDDY_REQUEST%% SET id = :buddyID, text = :text;";
        $db->insert($sql, array(
            ':buddyID'  => $buddyID,
            ':text' => $text
        ));

       $sql = "SELECT username, customNick, lang FROM %%USERS%% WHERE id = :friendID;";
       $row = $db->selectSingle($sql, array(
           ':friendID'  => $id
       ));
	   
	   $Rq = empty($USER['customNick']) ? $USER['username'] : $USER['customNick'];
	   $Rp = empty($row['customNick']) ? $row['username'] : $row['customNick'];
	
        PlayerUtil::sendMessage($id, $USER['id'], $Rq, 4, $LNG['bu_new_request_title'], sprintf($LNG['bu_new_request_body'], $Rp, $Rq), TIMESTAMP);

		$this->printMessage($LNG['bu_request_send'], true, array('game.php?page=buddyList', 2));
	}
	
	function delete()
	{
		global $USER, $LNG;
		
		$id	= HTTP::_GP('id', 0);
		$db = Database::get();

        $sql = "SELECT COUNT(*) as count FROM %%BUDDY%% WHERE id = :id AND (sender = :userID  AND buddyType = :buddyType OR owner = :userID AND buddyType = :buddyType);";
        $isAllowed = $db->selectSingle($sql, array(
            ':id'  => $id,
            ':userID' => $USER['id'],
            ':buddyType' => 1
        ), 'count');

		if($isAllowed)
		{
			$sql = "SELECT COUNT(*) as count FROM %%BUDDY_REQUEST%% WHERE :id;";
            $isRequest = $db->selectSingle($sql, array(
                ':id'  => $id
            ), 'count');
			
			if($isRequest)
			{
                $sql = "SELECT u.username, u.customNick, u.id, u.lang FROM %%BUDDY%% b INNER JOIN %%USERS%% u ON u.id = IF(b.sender = :userID,b.owner,b.sender) WHERE b.id = :id AND b.buddyType = :buddyType;";
                $requestData = $db->selectSingle($sql, array(
                    ':id'       => $id,
                    'userID'    => $USER['id'],
					':buddyType' => 1
                ));
				
				$useNickOw = empty($USER['customNick']) ? $USER['username'] : $USER['customNick'];
				$useNickRq = empty($requestData['customNick']) ? $requestData['username'] : $requestData['customNick'];
				

				PlayerUtil::sendMessage($requestData['id'], $USER['id'], $useNickOw, 4, $LNG['bu_rejected_request_title'], sprintf($LNG['bu_rejected_request_body'], $useNickRq, $useNickOw), TIMESTAMP);
			}

            $sql = "DELETE b.*, r.* FROM %%BUDDY%% b LEFT JOIN %%BUDDY_REQUEST%% r USING (id) WHERE b.id = :id AND b.buddyType = :buddyType;";
            $db->delete($sql, array(
                ':id'       => $id,
				':buddyType' => 1
            ));
        }
		$this->redirectTo("game.php?page=buddyList");
	}
	
	function accept()
	{
		global $USER, $LNG;
		
		$id	= HTTP::_GP('id', 0);
		$db = Database::get();

        $sql = "DELETE FROM %%BUDDY_REQUEST%% WHERE id = :id;";
        $db->delete($sql, array(
            ':id'       => $id
        ));
		
		$sql = "UPDATE %%BUDDY%% SET isAccepted = 1 WHERE id = :id;";
        $db->update($sql, array(
            ':id'       => $id
        ));

        $sql = "SELECT sender, u.username, u.customNick, u.lang FROM %%BUDDY%% b INNER JOIN %%USERS%% u ON sender = u.id WHERE b.id = :id;";
        $sender = $db->selectSingle($sql, array(
            ':id'       => $id
        ));
		
		$useNickOw = empty($USER['customNick']) ? $USER['username'] : $USER['customNick'];
		$useNickRq = empty($sender['customNick']) ? $sender['username'] : $sender['customNick'];

		PlayerUtil::sendMessage($sender['sender'], $USER['id'], $useNickOw, 4, $LNG['bu_accepted_request_title'], sprintf($LNG['bu_accepted_request_body'], $useNickRq, $useNickOw), TIMESTAMP);

		$this->redirectTo("game.php?page=buddyList");
	}
	
	function addenemies()
	{
		global $USER, $LNG;
		
		$id	= HTTP::_GP('id', 0);
		$db = Database::get();

       $sql = "INSERT INTO %%BUDDY%% SET sender = :userID,	owner = :friendID, universe = :universe, buddyType = 2;";
       $db->insert($sql, array(
            ':userID'	=> $USER['id'],
            ':friendID'  => $id,
            ':universe' => Universe::current(),
        ));
	$this->printMessage($LNG['customm_22'], true, array('game.php?page=buddyList&mode=enemies', 3));
	}
	
	function show()
	{
		global $USER;
		
		$db = Database::get();
        $sql = "SELECT a.sender, a.id as buddyid, b.id, b.username, b.customNick, b.onlinetime, b.avatar, b.galaxy, b.system, b.planet, b.ally_id, c.ally_tag, d.text
		FROM (%%BUDDY%% as a, %%USERS%% as b) LEFT JOIN %%ALLIANCE%% as c ON c.id = b.ally_id LEFT JOIN %%BUDDY_REQUEST%% as d ON a.id = d.id
		WHERE (a.sender = ".$USER['id']." AND a.owner = b.id AND a.buddyType = :buddyType) OR (a.owner = :userID AND a.sender = b.id AND a.buddyType = :buddyType);";
        $BuddyListResult = $db->select($sql, array(
            'userID'    => $USER['id'],
			'buddyType'    => 1
        ));

        $myRequestList		= array();
		$otherRequestList	= array();
		$myBuddyList		= array();	

				
		foreach($BuddyListResult as $BuddyList)
		{
			if(isset($BuddyList['text']))
			{
				if($BuddyList['sender'] == $USER['id'])
					$myRequestList[$BuddyList['buddyid']]		= $BuddyList;
				else
					$otherRequestList[$BuddyList['buddyid']]	= $BuddyList;
			}
			else
			{
				$BuddyList['onlinetime']			= floor((TIMESTAMP - $BuddyList['onlinetime']) / 60);
				$myBuddyList[$BuddyList['buddyid']]	= $BuddyList;
			}
		}
		
		$this->assign(array(
			'myBuddyList'		=> $myBuddyList,
			'myRequestList'			=> $myRequestList,
			'otherRequestList'	=> $otherRequestList,
		));
		
		$this->display('page.buddyList.default.tpl');
	}
	
	function enemies()
	{
		global $USER;
		
		$db = Database::get();
        $sql = "SELECT a.sender, a.id as buddyid, b.id, b.username, b.customNick, b.avatar, b.onlinetime, b.galaxy, b.system, b.planet, b.ally_id, c.ally_tag, d.text
		FROM (%%BUDDY%% as a, %%USERS%% as b) LEFT JOIN %%ALLIANCE%% as c ON c.id = b.ally_id LEFT JOIN %%BUDDY_REQUEST%% as d ON a.id = d.id
		WHERE a.sender = ".$USER['id']." AND a.owner = b.id AND a.buddyType = 2;";
        $BuddyListResult = $db->select($sql, array(
            'userID'    => $USER['id'],
        ));

		$myBuddyList		= array();		
				
		foreach($BuddyListResult as $BuddyList)
		{
			
				$BuddyList['onlinetime']			= floor((TIMESTAMP - $BuddyList['onlinetime']) / 60);
				$myBuddyList[$BuddyList['buddyid']]	= $BuddyList;
			
		}
		
		$this->assign(array(
			'myBuddyList'		=> $myBuddyList,
		));
		
		$this->display('page.ennemieList.default.tpl');
	}
}