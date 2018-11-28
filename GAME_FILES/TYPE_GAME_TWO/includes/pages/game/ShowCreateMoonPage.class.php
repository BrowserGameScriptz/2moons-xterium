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

class ShowCreateMoonPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
	}
	
	
	function BuyMoon()
	{
		global $LNG, $resource, $USER, $PLANET;

		
		if($PLANET['gal6mod'] == 1)
			header('Location: game.php');
		
		$cost_type	= HTTP::_GP('cost_type', 0);
		
		switch($cost_type){
        case '921':
		if($USER['darkmatter'] < 4000000){
		PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page', TIMESTAMP);
		$this->printMessage($LNG['moon_hack'], true, array('game.php?page=createMoon', 3));
		}else{
		if($PLANET['planet_type'] == 1 && $PLANET['id_luna'] == 0){
		PlayerUtil::createMoon(
				Universe::current(),
				$PLANET['galaxy'],
				$PLANET['system'],
				$PLANET['planet'],
				$USER['id'],
				mt_rand(15,20)
		);
		$USER['darkmatter'] -= 4000000;
		$this->printMessage($LNG['moon_ok'], true, array('game.php?page=overview', 3));	
		}else{
		$this->printMessage($LNG['moon_already_have'], true, array('game.php?page=overview', 3));	
		}
		}
        break;
		
		case '922':
		if(($USER['antimatter'] + $USER['antimatter_bought']) < 20000){
		PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your premium page', TIMESTAMP);
		$this->printMessage($LNG['moon_hack'], true, array('game.php?page=createMoon', 3));
		}else{
		if($PLANET['planet_type'] == 1 && $PLANET['id_luna'] == 0){
		PlayerUtil::createMoon(
				Universe::current(),
				$PLANET['galaxy'],
				$PLANET['system'],
				$PLANET['planet'],
				$USER['id'],
				mt_rand(15,20)
		);
		$this->widrawAm(20000, $USER['id']);
		$this->printMessage($LNG['moon_ok'], true, array('game.php?page=overview', 3));	
		}else{
		$this->printMessage($LNG['moon_already_have'], true, array('game.php?page=overview', 3));	
		}
		}
        break;
		}
	}
	

	function show()
	{
		global $LNG, $resource, $USER, $PLANET;
	
		if($PLANET['gal6mod'] == 1 || $PLANET['isAlliancePlanet'] != 0)
			header('Location: game.php');
		
		$this->assign(array(
			'userAm' 			=> ($USER['antimatter']+ $USER['antimatter_bought']),
			'userDm'	 		=> $USER['darkmatter'],
		));
		
		$this->display('page.createmoon.default.tpl');
	}
}
