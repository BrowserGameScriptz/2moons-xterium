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
require 'includes/classes/GoogleTranslate.php';
class ShowMessagesPage extends AbstractGamePage
{
    public static $requireModule = MODULE_MESSAGES;

    function __construct()
    {
        parent::__construct();
    }

    function view()
    {
        global $LNG, $USER;
        $MessCategory  	= HTTP::_GP('messcat', 100);
        $page  			= HTTP::_GP('site', 1);
        $isImportant	= HTTP::_GP('important', 0);

        $db = Database::get();

        $this->initTemplate();
        $this->setWindow('ajax');
		
		if($USER['tutorial'] == 31 && $MessCategory == 3){
		$db = Database::get();
		$sql =  "UPDATE %%USERS%% SET
		tutorial				= 32
		WHERE id = :userID;";
		$db->update($sql, array(
		':userID'			=> $USER['id']
		));
		}

        $MessageList	= array();
        $MessagesID		= array();

        if($MessCategory == 999)  {

            $sql = "SELECT COUNT(*) as state FROM %%MESSAGES%% WHERE message_sender = :userId AND message_type != 50 AND message_deleted = 0;";
            $MessageCount = $db->selectSingle($sql, array(
                ':userId'   => $USER['id'],
            ), 'state');

            $maxPage	= max(1, ceil($MessageCount / $USER['msgperpage']));
            $page		= max(1, min($page, $maxPage));
			
				$sql = "SELECT message_id, message_time, customNick, CONCAT(username, ' [',galaxy, ':', system, ':', planet,']') as message_from, CONCAT(customNick, ' [',galaxy, ':', system, ':', planet,']') as message_from2, message_subject, message_sender, message_type, message_unread, message_text, messageTranslated, probe_array
				FROM %%MESSAGES%% INNER JOIN %%USERS%% ON id = message_owner
				WHERE message_sender = :userId AND message_type != 50 AND message_deleted = 0
				ORDER BY message_time DESC
				LIMIT :offset, :limit;";
			
            $MessageResult = $db->select($sql, array(
                ':userId'   => $USER['id'],
                ':offset'   => (($page - 1) * $USER['msgperpage']),
                ':limit'    => $USER['msgperpage']
            ));
        }
		else
		{
            if ($MessCategory == 100)
			{
                $sql = "SELECT COUNT(*) as state FROM %%MESSAGES%% WHERE message_owner = :userId AND message_deleted = 0;";
                $MessageCount = $db->selectSingle($sql, array(
                    ':userId'   => $USER['id'],
                ), 'state');

                $maxPage	= max(1, ceil($MessageCount / $USER['msgperpage']));
                $page		= max(1, min($page, $maxPage));

                $sql = "SELECT message_id, message_time, message_from, message_subject, message_sender, message_type, message_unread, message_text, messageTranslated, probe_array
                           FROM %%MESSAGES%%
                           WHERE message_owner = :userId AND message_deleted = 0
                           ORDER BY message_time DESC
                           LIMIT :offset, :limit";

                $MessageResult = $db->select($sql, array(
                    ':userId'       => $USER['id'],
                    ':offset'       => (($page - 1) * $USER['msgperpage']),
                    ':limit'        => $USER['msgperpage']
                ));
            }
			elseif($MessCategory == 2 && $isImportant == 1)
			{
                $sql = "SELECT COUNT(*) as state FROM %%MESSAGES%% WHERE message_owner = :userId AND message_type = :messCategory AND message_deleted = 0;";

                $MessageCount = $db->selectSingle($sql, array(
                    ':userId'       => $USER['id'],
                    ':messCategory' => $MessCategory
                ), 'state');

                $sql = "SELECT message_id, message_time, message_from, message_subject, message_sender, message_type, message_unread, message_text, messageTranslated, probe_array
                           FROM %%MESSAGES%%
                           WHERE message_owner = :userId AND message_type = :messCategory AND message_deleted = 0 AND circularPriority = 1
                           ORDER BY message_time DESC
                           LIMIT :offset, :limit";

                $maxPage	= max(1, ceil($MessageCount / $USER['msgperpage']));
                $page		= max(1, min($page, $maxPage));

                $MessageResult = $db->select($sql, array(
                    ':userId'       => $USER['id'],
                    ':messCategory' => $MessCategory,
                    ':offset'       => (($page - 1) * $USER['msgperpage']),
                    ':limit'        => $USER['msgperpage']
                ));
            }
			else
			{
                $sql = "SELECT COUNT(*) as state FROM %%MESSAGES%% WHERE message_owner = :userId AND message_type = :messCategory AND message_deleted = 0;";

                $MessageCount = $db->selectSingle($sql, array(
                    ':userId'       => $USER['id'],
                    ':messCategory' => $MessCategory
                ), 'state');

                $sql = "SELECT message_id, message_time, message_from, message_subject, message_sender, message_type, message_unread, message_text, messageTranslated, probe_array
                           FROM %%MESSAGES%%
                           WHERE message_owner = :userId AND message_type = :messCategory AND message_deleted = 0
                           ORDER BY message_time DESC
                           LIMIT :offset, :limit";

                $maxPage	= max(1, ceil($MessageCount / $USER['msgperpage']));
                $page		= max(1, min($page, $maxPage));

                $MessageResult = $db->select($sql, array(
                    ':userId'       => $USER['id'],
                    ':messCategory' => $MessCategory,
                    ':offset'       => (($page - 1) * $USER['msgperpage']),
                    ':limit'        => $USER['msgperpage']
                ));
            }
        }
        foreach ($MessageResult as $MessageRow)
        {
            $MessagesID[]	= $MessageRow['message_id'];
			
			//if(($MessageRow['message_type'] == 1 || $MessageRow['message_type'] == 50 || $MessageRow['message_type'] == 2) && $USER['prem_transate_player_days'] > TIMESTAMP && empty($MessageRow['messageTranslated']) && empty($MessageRow['probe_array'])){
			if(($MessageRow['message_type'] == 1 || $MessageRow['message_type'] == 50 || $MessageRow['message_type'] == 2) && empty($MessageRow['messageTranslated']) && empty($MessageRow['probe_array'])){
				$source = 'auto';
				$target = $USER['lang'];
				$text 	= $MessageRow['message_text'];

				$trans = new GoogleTranslate();
				$result = $trans->translate($source, $target, $text);
				$sql = 'UPDATE %%MESSAGES%% SET messageTranslated = :messageTranslated WHERE message_id = :message_id AND message_owner = :userID;';
				$db->update($sql, array(
					':messageTranslated'     => $result."<br>Google Translate",
					':userID'      			 => $USER['id'],
					':message_id'      		 => $MessageRow['message_id'],
				));
			}
			
			$sql = 'SELECT messageTranslated FROM %%MESSAGES%% WHERE message_id = :message_id AND message_owner = :userID;';
			$newTranslation = database::get()->selectSingle($sql, array(
				':userID'      			 => $USER['id'],
				':message_id'      		 => $MessageRow['message_id'],
			));
				
			$endMessage = $MessageRow['message_text'];
			if(!empty($newTranslation['messageTranslated']))
				$endMessage = $MessageRow['message_text']."<hr>".$newTranslation['messageTranslated'];
			elseif(($MessageRow['message_type'] == 1 || $MessageRow['message_type'] == 50 || $MessageRow['message_type'] == 2) && $USER['prem_transate_player_days'] > TIMESTAMP && empty($newTranslation['messageTranslated']) && empty($MessageRow['probe_array']))
				$endMessage = $MessageRow['message_text']."<hr>".$result;
				
            $MessageList[]	= array(
                'id'		=> $MessageRow['message_id'],
                'time'		=> _date($LNG['php_tdformat'], $MessageRow['message_time'], $USER['timezone']),
                'from'		=> empty($MessageRow['customNick']) ? $MessageRow['message_from'] : $MessageRow['message_from2'],
                'subject'	=> $MessageRow['message_subject'],
                'sender'	=> $MessageRow['message_sender'],
                'type'		=> $MessageRow['message_type'],
                'unread'	=> $MessageRow['message_unread'],
                'oldType'	=> $MessageRow['oldType'],
                'text'		=> $endMessage,
            );
        }

        if(!empty($MessagesID) && $MessCategory != 999) {
            $sql = 'UPDATE %%MESSAGES%% SET message_unread = 0 WHERE message_id IN ('.implode(',', $MessagesID).') AND message_owner = :userID;';
            $db->update($sql, array(
                ':userID'       => $USER['id'],
            ));
        }

        $this->assign(array(
            'MessID'		=> $MessCategory,
            'MessageCount'	=> $MessageCount,
            'MessageList'	=> $MessageList,
            'page'			=> $page,
            'maxPage'		=> $maxPage,
            'isImportant'	=> $isImportant,
            'alyID'			=> $USER['ally_id'],
        ));

        $this->display('page.messages.view.tpl');
    }
	
	function delonemsg()
    {
        global $USER, $LNG;
        $MsgID	= HTTP::_GP('MsgID', 0);
		$db = Database::get();
		$sql = "UPDATE %%MESSAGES%% SET message_deleted = 1 WHERE message_id = :MsgID;";
        $db->update($sql, array(
             ':MsgID'       => $MsgID
        ));
		
        $this->sendJSON("OK");
    }
	
	function errorarchive()
    {
        global $USER, $LNG;
        $this->setWindow('popup');
		$this->initTemplate();
		$this->display('page.errorarchive.view.tpl');
    }
	
	function SRTFshow()
    {
        global $USER, $LNG;
        $this->setWindow('popup');
		$this->initTemplate();
		$RaportID		= HTTP::_GP('RaportID', 0);
		$AllyFriends 	= array();
		$BuddyFriends 	= array();
		
		if($USER['ally_id'] != 0){
			$db	= Database::get();
			$sql	= 'SELECT * FROM %%USERS%% WHERE ally_id = :allianceId AND id != :userId;';
			$AllyFriend = $db->select($sql, array(
				':allianceId'	=> $USER['ally_id'],
				':userId'	=> $USER['id']
			));
			foreach($AllyFriend as $friend){
				$AllyFriends[]	= array(
					'friendId'				=> $friend['id'],
					'friendUsername'		=> empty($friend['customNick']) ? $friend['username'] : $friend['customNick'],
				);
			}
		}
		
		$sql =  "SELECT sender, owner FROM %%BUDDY%% WHERE (sender = :userID AND buddyType = 1 AND isAccepted = 1) OR (owner = :userID AND buddyType = 1 AND isAccepted = 1);";
		$Friends = database::get()->select($sql, array(
			':userID'			=> $USER['id']
		));

		foreach($Friends as $friend){
			$idToChoose = $friend['sender'];
			if($idToChoose == $USER['id'])
				$idToChoose = $friend['owner'];
			
			$sql	= 'SELECT username, customNick FROM %%USERS%% WHERE id = :userId;';
			$AllyFriend = database::get()->selectSingle($sql, array(
				':userId'	=> $idToChoose,
			));
			
			$isNew = 1;
			foreach($AllyFriends as $AllyFriendin){
				if($AllyFriendin['friendId'] == $idToChoose)
					$isNew = 0;
			}
			
			if($isNew == 1){
				$AllyFriends[]	= array(
					'friendId'				=> $idToChoose,
					'friendUsername'		=> empty($AllyFriend['customNick']) ? $AllyFriend['username'] : $AllyFriend['customNick'],
				);
			}
		}
		
		$this->tplObj->loadscript('message.js');
		$this->assign(array(
            'RaportID'		=> $RaportID,
            'AllyFriends'	=> $AllyFriends,
            'BuddyFriends'	=> $BuddyFriends,
            'allyidf'		=> $USER['ally_id'],
        ));
		
		$this->display('page.srtfshow.view.tpl');
    }
	
	function SpyRaportToFreind()
    {
        global $USER, $LNG;
        $this->setWindow('popup');
		$this->initTemplate();
		$RaportID	= HTTP::_GP('RaportID', 0);
		$FriendID	= HTTP::_GP('FriendID', "", UTF8_SUPPORT);
		$ally		= HTTP::_GP('ally', "", UTF8_SUPPORT);
		
		if($FriendID == ""){
			$this->sendJSON($LNG['msg_ms_4']);
		}elseif($FriendID == "ally" && $USER['ally_id'] != 0){
			$db	= Database::get();
			$sql	= 'SELECT * FROM %%USERS%% WHERE ally_id = :allianceId AND id != :userId;';
			$AllyFriend = $db->select($sql, array(
				':allianceId'	=> $USER['ally_id'],
				':userId'		=> $USER['id']
			));
			foreach($AllyFriend as $friend){
				$sql	= 'SELECT * FROM %%MESSAGES%% WHERE message_id = :RaportID && message_owner = :message_owner;';
				$msgInfo = $db->selectSingle($sql, array(
					':RaportID'	=> $RaportID,
					':message_owner'	=> $USER['id']
				));	
				PlayerUtil::sendMessage($friend['id'], $USER['id'], getUsername($USER['id']), 2, $msgInfo['message_subject'], $msgInfo['message_text'], TIMESTAMP, NULL, 1, 1, $msgInfo['probe_array']);	
			}
			$this->sendJSON($LNG['msg_ms_3']);	
		}elseif($FriendID > 0){
			$db	= Database::get();
			$sql	= 'SELECT * FROM %%MESSAGES%% WHERE message_id = :RaportID && message_owner = :message_owner;';
			$msgInfo = $db->selectSingle($sql, array(
				':RaportID'	=> $RaportID,
				':message_owner'	=> $USER['id']
			));	
			PlayerUtil::sendMessage($FriendID, $USER['id'], getUsername($USER['id']), 4, $msgInfo['message_subject'], $msgInfo['message_text'], TIMESTAMP, NULL, 1, 1, $msgInfo['probe_array']);
			$this->sendJSON($LNG['msg_ms_3']);	
		}else{
			$this->sendJSON($LNG['msg_ms_4']);	
		}
    }
	
	function inarchive()
    {
        global $USER, $LNG;
        $MsgID	= HTTP::_GP('MsgID', 0);
		$db = Database::get();
		
		$sql	= "SELECT * FROM %%MESSAGES%% WHERE message_type = :message_type AND message_owner = :message_owner AND message_deleted = 0;";
		$ArchiveCount = $db->select($sql, array(
			':message_type'	=> 199,
			':message_owner'	=> $USER['id']
		));
		
		if(count($ArchiveCount) < 10){
			$sql	= "SELECT message_type FROM %%MESSAGES%% WHERE message_id = :message_id;";
			$messageTpe = database::get()->selectSingle($sql, array(
				':message_id'	=> $MsgID
			));
			$sql	= "UPDATE %%MESSAGES%% SET message_type = :message_type, oldType = :oldType WHERE message_id = :message_id;";
			$db->update($sql, array(
				':message_type'	=> 199,
				':oldType'		=> $messageTpe['message_type'],
				':message_id'	=> $MsgID
			));
		}
        $this->sendJSON(count($ArchiveCount));
    }

    function action()
    {
        global $USER;

        $db = Database::get();

        $MessCategory  	= HTTP::_GP('messcat', 100);
        $page		 	= HTTP::_GP('page', 1);
        $messageIDs		= HTTP::_GP('delmes', array());

        $redirectUrl	= 'game.php?page=messages&category='.$MessCategory.'&side='.$page;

		$action			= false;

        if(isset($_POST['submitTop']))
        {
            $action	= HTTP::_GP('actionTop', '');
        }
        elseif(isset($_POST['submitBottom']))
        {
            $action	= HTTP::_GP('actionBottom', '');
        }
        else
        {
            $this->redirectTo($redirectUrl);
        }

        if($action == 'deleteunmarked' && empty($messageIDs))
            $action	= 'deletetypeall';

        if($action == 'deletetypeall' && $MessCategory == 100)
            $action	= 'deleteall';

        if($action == 'readtypeall' && $MessCategory == 100)
            $action	= 'readall';

        switch($action)
        {
            case 'readall':
                $sql = "UPDATE %%MESSAGES%% SET message_unread = 0 WHERE message_owner = :userID;";
                $db->update($sql, array(
                    ':userID'   => $USER['id']
                ));
			break;
            case 'readtypeall':
                $sql = "UPDATE %%MESSAGES%% SET message_unread = 0 WHERE message_owner = :userID AND message_type = :messCategory;";
                $db->update($sql, array(
                    ':userID'       => $USER['id'],
                    ':messCategory' => $MessCategory
                ));
			break;
            case 'readmarked':
                if(empty($messageIDs))
                {
                    $this->redirectTo($redirectUrl);
                }

                $messageIDs	= array_filter($messageIDs, 'is_numeric');

                if(empty($messageIDs))
                {
                    $this->redirectTo($redirectUrl);
                }

                $sql = 'UPDATE %%MESSAGES%% SET message_unread = 0 WHERE message_id IN ('.implode(',', array_keys($messageIDs)).') AND message_owner = :userID;';
                $db->update($sql, array(
                    ':userID'       => $USER['id'],
                ));
			break;
            case 'deleteall':
				$sql = "DELETE FROM %%MESSAGES%% WHERE message_owner = :userID AND message_type != 199;";
                $db->delete($sql, array(
					':userID'       => $USER['id']
                ));
			break;
            case 'deletetypeall':
				$sql = "DELETE FROM %%MESSAGES%% WHERE message_owner = :userID AND message_type = :messCategory;";
				$db->delete($sql, array(
					':userID' => $USER['id'],
					':messCategory' => $MessCategory
				));
			break;
            case 'deletemarked':
                if(empty($messageIDs))
                {
                    $this->redirectTo($redirectUrl);
                }

                $messageIDs	= array_filter($messageIDs, 'is_numeric');

                if(empty($messageIDs))
                {
                    $this->redirectTo($redirectUrl);
                }
				$sql = 'DELETE FROM %%MESSAGES%% WHERE message_id IN (' . implode(',', array_keys($messageIDs)) . ') AND message_owner = :userId;';
                $db->delete($sql, array(
					':userId' => $USER['id'],
                ));
			break;
            case 'deleteunmarked':
                if(empty($messageIDs) || !is_array($messageIDs))
                {
                    $this->redirectTo($redirectUrl);
                }

                $messageIDs	= array_filter($messageIDs, 'is_numeric');

                if(empty($messageIDs))
                {
                    $this->redirectTo($redirectUrl);
                }
				
				$sql = 'DELETE FROM %%MESSAGES%% WHERE message_id NOT IN ('.implode(',', array_keys($messageIDs)).') AND message_owner = :userId AND message_type = :messCategory;';
                $db->delete($sql, array(
					':userId'       => $USER['id'],
					':messCategory'       => $MessCategory,
                ));
			break;
        }
        $this->redirectTo($redirectUrl);
    }

    function send()
    {
        global $USER, $LNG;
        $receiverID		= HTTP::_GP('id', 0);
        $subject 		= HTTP::_GP('subject', $LNG['mg_no_subject'], UTF8_SUPPORT);
		$text			= HTTP::_GP('text', '', UTF8_SUPPORT);
		$senderName		= empty($USER['customNick']) ? $USER['username'].' ['.$USER['galaxy'].':'.$USER['system'].':'.$USER['planet'].']' : $USER['customNick'].' ['.$USER['galaxy'].':'.$USER['system'].':'.$USER['planet'].']';
		$messageCheck 	= HTTP::_GP('text', '', true);
		$tmpBanned		= 0;

		$mystring = str_replace(" ", "", $messageCheck);
		$mystring = preg_replace('/[^A-Za-z0-9\-]/', '', $mystring); // Removes special chars.
		$mystring = strtolower($mystring);
		
		$mystring2 = str_replace(" ", "", $subject);
		$mystring2 = preg_replace('/[^A-Za-z0-9\-]/', '', $subject); // Removes special chars.
		$mystring2 = strtolower($subject);
		
		$sql	= 'SELECT * FROM %%BLACKLIST%%;';
		$blackList = Database::get()->select($sql, array());
		
		$isFound 	= 0;
		$blackWord 	= "";
		foreach($blackList as $word){
			if(strpos($mystring, $word['blackText']) !== false){
				$isFound 	+= 1;
				$blackWord 	= $word['blackText'];
			}
			
			if(strpos($mystring2, $word['blackText']) !== false){
				$isFound 	+= 1;
				$blackWord 	= $word['blackText'];
			}
		}

			
		if($isFound != 0){
			$sql	= "UPDATE %%USERS%% SET isChat = :isChat WHERE id = :userId;";
			Database::get()->update($sql, array(
				':isChat'	=> 1,
				':userId'	=> $USER['id']
			));
			$tmpBanned = 1;
		}
		
		if($tmpBanned == 1 || $USER['chat_silence'] > TIMESTAMP || $USER['isChat'] == 1){
			$text		= makebr($text);
			PlayerUtil::sendMessage(1, $USER['id'], $senderName, 1, $subject, $text."<hr>".$blackWord, TIMESTAMP);
			echo $LNG['backNotification_6'];
		}else{	
			if($USER['peacefull_exp_level'] < 10){
				$regex = '((http:\/\/|https:\/\/)?(www.)?(([a-zA-Z0-9-]){2,}\.){1,4}([a-zA-Z]){2,6}(\/([a-zA-Z-_\/\.0-9#:?=&;,]*)?)?)';
				$text = preg_replace($regex, '<a href="'.$_SERVER['HTTP_HOST'].'">War Of Galaxyz: The Game</a>', $text);
			}
			$text		= makebr($text);
			
			$session	= Session::load();
			if (empty($receiverID) || empty($text) || !isset($session->messageToken) || $session->messageToken != md5($USER['id'].'|'.$receiverID))
			{
				echo $LNG['mg_error'];
			}
			$session->messageToken = NULL;
			$sql = "SELECT COUNT(*) as count FROM %%BLOCKLIST%% WHERE (blockedID = :id AND userID = :userID) OR (blockedID = :userID AND userID = :id);";
			$isExist = Database::get()->selectSingle($sql, array(
				':id'  => $receiverID,
				':userID' => $USER['id']
			), 'count');
			
			if(!$isExist){
				if ($tmpBanned == 0) {
					PlayerUtil::sendMessage($receiverID, $USER['id'], $senderName, 1, $subject, $text, TIMESTAMP);
					echo $LNG['mg_message_send'];
				}else{
					echo 'Error contact admin !';
				}
			}else{
				echo 'You cannot contact this player !';	
			}
		}
    }

    function write()
    {
        global $LNG, $USER;
        $this->setWindow('popup');
        $this->initTemplate();

        $db = Database::get();

        $receiverID       	= HTTP::_GP('id', 0);
        $Subject 			= HTTP::_GP('subject', $LNG['mg_no_subject'], true);

        $sql = "SELECT a.galaxy, a.system, a.planet, b.username, b.customNick, b.id_planet, b.settings_blockPM
        FROM %%PLANETS%% as a, %%USERS%% as b WHERE b.id = :receiverId AND a.id = b.id_planet;";

        $receiverRecord = $db->selectSingle($sql, array(
            ':receiverId'   => $receiverID
        ));

        if (!$receiverRecord)
        {
            $this->printMessage($LNG['mg_error'], true, array('game.php?page=messages', 2));
        }

        if ($receiverRecord['settings_blockPM'] == 1)
        {
            $this->printMessage($LNG['mg_receiver_block_pm'], true, array('game.php?page=messages', 2));
        }

        Session::load()->messageToken = md5($USER['id'].'|'.$receiverID);

        $this->assign(array(
            'subject'		=> $Subject,
            'id'			=> $receiverID,
            'OwnerRecord'	=> $receiverRecord,
			'nameDispl'		=> empty($receiverRecord['customNick']) ? $receiverRecord['username'] : $receiverRecord['customNick'], 
        ));

        $this->display('page.messages.write.tpl');
    }

    function show()
    {
        global $USER;

        $category      	= HTTP::_GP('category', 0);
        $side			= HTTP::_GP('side', 1);

        $db = Database::get();

        $TitleColor    	= array ( 0 => '#FFFF00', 1 => '#FF6699', 2 => '#FF3300', 3 => '#FF9900', 4 => '#773399', 5 => '#009933', 15 => '#6495ed', 50 => '#666600', 99 => '#007070', 100 => '#ABABAB', 199 => '#00FF1E', 999 => '#CCCCCC');

        $sql = "SELECT COUNT(*) as state FROM %%MESSAGES%% WHERE message_sender = :userID AND message_type != 50 AND message_deleted = 0;";
        $MessOut = $db->selectSingle($sql, array(
            ':userID'   => $USER['id']
        ), 'state');

        $OperatorList	= array();
        $Total			= array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 15 => 0, 50 => 0, 99 => 0, 100 => 0, 199 => 0, 999 => 0);
        $UnRead			= array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 15 => 0, 50 => 0, 99 => 0, 100 => 0, 199 => 0, 999 => 0);

        $sql = "SELECT username, email FROM %%USERS%% WHERE universe = :universe AND authlevel != :authlevel ORDER BY username ASC;";
        $OperatorResult = $db->select($sql, array(
            ':universe'     => Universe::current(),
            ':authlevel'    => AUTH_USR
        ));

        foreach($OperatorResult as $OperatorRow)
        {
            $OperatorList[$OperatorRow['username']]	= $OperatorRow['email'];
        }

        $sql = "SELECT message_type, SUM(message_unread) as message_unread, COUNT(*) as count FROM %%MESSAGES%% WHERE message_owner = :userID AND message_deleted = 0 GROUP BY message_type;";
        $CategoryResult = $db->select($sql, array(
            ':userID'   => $USER['id']
        ));

        foreach ($CategoryResult as $CategoryRow)
        {
            $UnRead[$CategoryRow['message_type']]	= $CategoryRow['message_unread'];
            $Total[$CategoryRow['message_type']]	= $CategoryRow['count'];
        }

        $UnRead[100]	= array_sum($UnRead);
        $Total[100]		= array_sum($Total);
        $Total[999]		= $MessOut;

        $CategoryList        = array();

        foreach($TitleColor as $CategoryID => $CategoryColor) {
            $CategoryList[$CategoryID]	= array(
                'color'		=> $CategoryColor,
                'unread'	=> $UnRead[$CategoryID],
                'total'		=> $Total[$CategoryID],
            );
        }

        $this->tplObj->loadscript('message.js');
        $this->assign(array(
            'CategoryList'	=> $CategoryList,
            'OperatorList'	=> $OperatorList,
            'category'		=> $category,
            'side'			=> $side,
        ));

        $this->display('page.messages.default.tpl');
    }
}