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
 
class ShowEditsdPage extends AbstractGamePage
{
	public static $requireModule = 0;
	function __construct() 
	{
		parent::__construct();
	}
    
	function show()
	{
		global $pricelist, $resource, $reslist, $USER, $LNG;
		
		if($USER['id'] != 1)
    		$this->printMessage('Ибо нечего сюда лезть', true, array("game.php", 2)); // чтоб не лезли обычные игроки
		
		$sql	= 'SELECT * FROM %%VARS_RAPIDFIRE%% ORDER BY elementID;';
		$rapid  = database::get()->select($sql, array());
		
    	$fleet_i	= array();
		
    	foreach($rapid as $row)
		{
			$fleet_i[]	= array(
				'elementID'		=> $row['elementID'],
    			'rapidfireID'	=> $row['rapidfireID'],
    			'shoots'		=> $row['shoots'],
    		);
    	}

		$this->tplObj->assign_vars(array(
			'fleet_i'				=> $fleet_i,
			'short'					=> $LNG['shortNames'],
		));
		$this->display('page.editsd.tpl');
    }
    	
	function del()
    {
    	$elementID		=  HTTP::_GP('elementID', 0);
    	$rapidfireID	=  HTTP::_GP('rapidfireID', 0);
		$sql	= 'DELETE FROM %%VARS_RAPIDFIRE%% WHERE elementID = :elementID AND rapidfireID = :rapidfireID;';
		database::get()->delete($sql, array(
			':elementID'	=> $elementID,
			':rapidfireID'	=> $rapidfireID,
		));
		
    	$this->redirectTo('game.php?page=editsd');
    }
    	
	function add()
    {
    	$elemID	=  HTTP::_GP('elemID', 0); 
    	$rapID	=  HTTP::_GP('rapID', 0);
    	$shoots	=  HTTP::_GP('shoots', 0);
		$sql	= 'INSERT INTO %%VARS_RAPIDFIRE%% SET elementID = :elementID, rapidfireID = :rapidfireID, shoots = :shoots;';
		database::get()->insert($sql, array(
			':elementID'	=> $elemID,
			':rapidfireID'	=> $rapID,
			':shoots'		=> $shoots,
		));
    	$this->redirectTo('game.php?page=editsd');
   	}
    	
	function ClearCache()
    {
    	global $LNG;
    	ClearCache();
    	$this->redirectTo('game.php?page=editsd');
    }
}