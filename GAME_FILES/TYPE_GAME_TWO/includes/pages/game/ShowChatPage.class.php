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

class ShowChatPage extends AbstractGamePage
{
	public static $requireModule = MODULE_CHAT;

	function __construct() 
	{
		parent::__construct();
	}
	
	function delonemsg()
    {
        global $USER, $LNG;
        $MsgID	= HTTP::_GP('MsgID', 0);
		$db = Database::get();
		$sql = "DELETE FROM %%CHAT%% WHERE messageid = :MsgID;";
        $db->delete($sql, array(
             ':MsgID'       => $MsgID
        ));
		
        $this->sendJSON("OK");
    }
	
	function blockuser() 
	{
	global $LNG, $USER;
	
	$db = Database::get();
	$bannedPlayer	= HTTP::_GP('blockid', 0);
	
    $sql = "UPDATE %%USERS%% SET chat_silence = :chat_silence WHERE id = :userId;";
    $db->update($sql, array(
        ':chat_silence'  => TIMESTAMP + 3600 * 24,
        ':userId' => $bannedPlayer
    ));
    $this->sendJSON(array('message' => 'Player succesfully banned', 'ok' => true));
		
	}
	
	function rooms()
	{
	global $USER, $LNG;
	$mini_chat = HTTP::_GP('mini_chat', 0);
	
	if(isset($mini_chat) && $mini_chat == 1){
	$this->setWindow('popup');
	$this->initTemplate();
	}
	
	$action	= HTTP::_GP('action', '');
	
	if($action == "create"){
	$name	= HTTP::_GP('name', '');
	$pass	= HTTP::_GP('pass', '');
	$pass2	= HTTP::_GP('pass2', '');
	
	if($name == ""){
	$this->printMessage($LNG['chat_msg_21'], true, array('game.php?page=chat&mode=roomsActions&action=create', 2));
	}elseif(($pass != "" || $pass2 != "") && $pass != $pass2){
	$this->printMessage($LNG['chat_msg_22'], true, array('game.php?page=chat&mode=roomsActions&action=create', 2));
	}else{
		
	$db = Database::get();
	$sql = "INSERT INTO %%CHAT_ROOMS%% SET
                id_owner		= :id_owner,
                name_owner			= :name_owner,
                name		= :name,
                pass		= :pass;";

			$db->insert($sql, array(
				':id_owner'			=> $USER['id'],
				':name_owner'			=> $USER['username'],
				':name'			=> $name,
				':pass'		=> $pass
			));
	$db		= Database::get();
	$sql	= "SELECT * FROM %%CHAT_ROOMS%% WHERE id_owner = :userId;";
	$ROOM	= $db->selectSingle($sql, array(
	':userId'	=> $USER['id']
	));


	$db	= Database::get();	
	$sql = "UPDATE %%USERS%% SET chat_room = :chat_room WHERE id = :userId;";
	$db->update($sql, array(
			':chat_room'	=> $ROOM['id'],
			':userId'	=> $USER['id']
	));
	$this->printMessage($LNG['chat_msg_23'], true, array('game.php?page=chat&mode=rooms', 2));
	}
	}elseif($action == "login"){
	$room	= HTTP::_GP('room', 0);
	$pass	= HTTP::_GP('pass', '');
	$db	= Database::get();
	$sql	= 'SELECT * FROM %%CHAT_ROOMS%% WHERE id = :id';
	$UserRoom = $db->selectSingle($sql, array(
	':id' => $room
	));
	
	if($pass != "" && $pass != $UserRoom['pass']){
	$this->printMessage($LNG['chat_msg_58'], true, array('game.php?page=chat&mode=rooms', 2));
	}else{
	$sql	= "UPDATE %%USERS%% SET chat_room = :chat_room WHERE id = :userId;";
	$db->update($sql, array(
	':chat_room'	=> $room, 
	':userId'	=> $USER['id']
	));	
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=chat&mode=rooms');
	}
	}
	
	$ChatOnlineAll 	= 0;
	$ChatOnlineAlly	= 0;
	$ChatOnlineRoom	= 0;
	$UserRoom		= 0;
	$db	= Database::get();
	$sql	= 'SELECT * FROM %%CHAT_ROOMS%% WHERE id_owner = :userid';
	$UserRoom = $db->select($sql, array(
	':userid' => $USER['id']
	));
	
	
	$sql	= 'SELECT * FROM %%CHAT_ON%% WHERE last_time >= :last_time';
	$ChatOnlineAll = $db->select($sql, array(
	':last_time'	=> (TIMESTAMP - 60)
	));
	$db	= Database::get();
	$sql	= 'SELECT * FROM %%CHAT_ON_ALLY%% WHERE last_time >= :last_time';
	$ChatOnlineAlly = $db->select($sql, array(
	':last_time'	=> (TIMESTAMP - 60)
	));
	$db	= Database::get();
	$sql	= 'SELECT * FROM %%CHAT_ON_ROOMS%% WHERE last_time >= :last_time';
	$ChatOnlineRoom = $db->select($sql, array(
	':last_time'	=> (TIMESTAMP - 60)
	));
	
	$this->assign(array(
	'ally_id' => $USER['ally_id'],	
	'mini_chat' => $mini_chat,	
	'chat_online' => array('general' => count($ChatOnlineAll), 'ally' => count($ChatOnlineAlly), 'room1' => count($ChatOnlineRoom)),	
	'user_ally' => $USER['ally_id'],	
	'chat_silence' => ($USER['chat_silence'] > TIMESTAMP) ? $USER['chat_silence'] : "",
	'user_color' => $USER['user_color'],	
	));
	if(count($UserRoom) == 0 && $USER['chat_room'] == 0){
	$this->display('page.chat.room.tpl');
	}else{
	$this->display('page.chat.room.default.tpl');
	}
	
	}
	
	function roomsActions()
	{
	global $USER, $LNG;
	$action	= HTTP::_GP('action', '');
	$mini_chat = HTTP::_GP('mini_chat', 0);
	$room	= HTTP::_GP('room', 0);
	if(isset($mini_chat) && $mini_chat == 1){
	$this->setWindow('popup');
	$this->initTemplate();
	}
	
	if($action == 'login'){
	
	$db	= Database::get();
	$sql	= 'SELECT * FROM %%CHAT_ROOMS%% WHERE id = :id';
	$UserRoom = $db->selectSingle($sql, array(
	':id' => $room
	));
	
	if($UserRoom['pass'] == ""){
	$sql	= "UPDATE %%USERS%% SET chat_room = :chat_room WHERE id = :userId;";
	$db->update($sql, array(
	':chat_room'	=> $room, 
	':userId'	=> $USER['id']
	));	
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=chat&mode=rooms');
	}else{
		
		
		
	$this->assign(array(
	'mini_chat' => $mini_chat,	
	'room' => $room,	
	));	
	$this->display('page.chat.action.join.tpl');
	}		
	}else{
	
	
	$this->assign(array(
	'mini_chat' => $mini_chat,	
	));
	$this->display('page.chat.action.create.tpl');
	}
	}
	
	function colorselect()
	{
	global $USER, $LNG;
	$new_user_color = HTTP::_GP('color', '');
	$db	= Database::get();
	$sql	= "UPDATE %%USERS%% SET user_color = :user_color WHERE id = :userId;";
	$db->update($sql, array(
			':user_color'	=> $new_user_color,
			':userId'	=> $USER['id']
	));
	
	}
	
	function rules()
	{
	global $USER, $LNG;
	
	$this->setWindow('popup');
	$this->initTemplate();
	
	$this->assign(array(
	
	
	));
		
	$this->display('page.chat.rules.tpl');
	}
	
	
	function show()
	{
	global $USER, $LNG;
	
	
	if(!isset($_COOKIE['miniChatStatus'])){
	setcookie('miniChatStatus','0');	
	}
	$ally_id = 0;
	$action	= HTTP::_GP('chat', '');
	if($action == 'ally') {
	$ally_id = $USER['ally_id'];
	}
	
	$mini_chat = HTTP::_GP('mini_chat', 0);
	$chatsss = HTTP::_GP('chat', "");
		
	$ChatOnlineAll 	= 0;
	$ChatOnlineAlly	= 0;
	$ChatOnlineRoom	= 0;
	$db	= Database::get();
	$sql	= 'SELECT * FROM %%CHAT_ON%% WHERE last_time >= :last_time';
	$ChatOnlineAll = $db->select($sql, array(
	':last_time'	=> (TIMESTAMP - 60)
	));
	$db	= Database::get();
	$sql	= 'SELECT * FROM %%CHAT_ON_ALLY%% WHERE last_time >= :last_time';
	$ChatOnlineAlly = $db->select($sql, array(
	':last_time'	=> (TIMESTAMP - 60)
	));
	$db	= Database::get();
	$sql	= 'SELECT * FROM %%CHAT_ON_ROOMS%% WHERE last_time >= :last_time';
	$ChatOnlineRoom = $db->select($sql, array(
	':last_time'	=> (TIMESTAMP - 60)
	));
	
	if(isset($mini_chat) && $mini_chat == 1){
	$this->setWindow('popup');
	$this->initTemplate();
	}
	
	if($chatsss == "ally")
		setcookie('allyVersion','1', TIMESTAMP+3600*24*365);
	else
		setcookie('allyVersion','0', TIMESTAMP+3600*24*365);
	
	$this->assign(array(
	'ally_id' => $ally_id,	
	'mini_chat' => $mini_chat,	
	'user_ally' => $USER['ally_id'],	
	'chat_online' => array('general' => count($ChatOnlineAll), 'ally' => count($ChatOnlineAlly), 'room1' => count($ChatOnlineRoom)),	
	'chat_silence' => ($USER['chat_silence'] > TIMESTAMP) ? $USER['chat_silence'] : "",	
	'user_color' => $USER['user_color'],	
	
	
	));
		
	$this->display('page.chat.default.tpl');
	}
	
	

}


