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

class ShowChangenickPage extends AbstractGamePage
{

	function __construct() 
	{
		parent::__construct();
		 
	}

	function show()
	{
		global $LNG, $resource, $USER, $PLANET;
		$this->setWindow('popup');
		$this->initTemplate();
				
		$this->assign(array(
		
		));
		$this->display('page.createnick.default.tpl');
	}
	
	function create()
	{
		global $LNG, $resource, $USER, $PLANET;
				
		$Name = HTTP::_GP('name', "", true);
		$Ajax = HTTP::_GP('ajax', 0);
		
		$sql = "SELECT (SELECT COUNT(*) FROM %%USERS%% WHERE universe = :universe AND username = :customNick) + (SELECT COUNT(*) FROM %%USERS%% WHERE universe = :universe AND customNick = :customNick) as count;";
		$countUsername = database::get()->selectSingle($sql, array(
			':universe'		=> 1,
			':customNick'	=> $Name,
		), 'count');
		
		if($Ajax == 0){
			echo $LNG['changenick_7'];
		}elseif(empty($Name) || !PlayerUtil::isNameValid($Name)){
			echo $LNG['changenick_8'];
		}elseif(strlen($Name) > 15 || strlen($Name) < 3) {
			echo $LNG['changenick_14'];
		}elseif(!empty($countUsername)){
			echo $LNG['changenick_9'];
		}elseif(!empty($USER['customNick'])){
			echo $LNG['changenick_10'];
		}else{
			$sql	= 'UPDATE %%USERS%% SET customNick = :customNick, customNickChange = :customNickChange WHERE id = :userID;';
			database::get()->update($sql, array(
				':customNick'			=> $Name,
				':customNickChange'		=> TIMESTAMP + (7 * 24 * 3600),
				':userID'				=> $USER['id']
			));
			echo $LNG['changenick_12'];
		}
	}
	
	function change()
	{
		global $LNG, $resource, $USER, $PLANET;
		$this->setWindow('popup');
		$this->initTemplate();
				
		$this->assign(array(
		
		));
		$this->display('page.createnick.change.tpl');
	}
	
	function changesend()
	{
		global $LNG, $resource, $USER, $PLANET;
				
		$Name = HTTP::_GP('name', "", true);
		$Ajax = HTTP::_GP('ajax', 0);
		
		$sql = "SELECT (SELECT COUNT(*) FROM %%USERS%% WHERE universe = :universe AND username = :customNick) + (SELECT COUNT(*) FROM %%USERS%% WHERE universe = :universe AND customNick = :customNick) as count;";

		$countUsername = database::get()->selectSingle($sql, array(
			':universe'		=> 1,
			':customNick'	=> $Name,
		), 'count');
		
		if($Ajax == 0){
			echo $LNG['changenick_7'];
		}elseif(empty($Name) || !PlayerUtil::isNameValid($Name)){
			echo $LNG['changenick_8'];
		}elseif(strlen($Name) > 15 || strlen($Name) < 3) {
			echo $LNG['changenick_14'];
		}elseif(!empty($countUsername) && $USER['username'] != $Name){
			echo $LNG['changenick_9'];
		}elseif($USER['customNickChange'] > TIMESTAMP){
			echo $LNG['changenick_13'];
		}else{
			$sql	= 'UPDATE %%USERS%% SET customNick = :customNick, customNickChange = :customNickChange WHERE id = :userID;';
			database::get()->update($sql, array(
				':customNick'			=> $Name,
				':customNickChange'		=> TIMESTAMP + (7 * 24 * 3600),
				':userID'				=> $USER['id']
			));
			echo $LNG['changenick_11'];
		}
	}
}
