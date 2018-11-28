<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan
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
 * @author Jan <info@2moons.cc>
 * @copyright 2006 Perberos <ugamela@perberos.com.ar> (UGamela)
 * @copyright 2008 Chlorel (XNova)
 * @copyright 2012 Jan <info@2moons.cc> (2Moons)
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 2.0.$Revision: 2242 $ (2012-11-31)
 * @info $Id$
 * @link http://2moons.cc/
 */


class ShowUpdateemailPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
		$this->setWindow('light');
	}
	
	
	
	function show() 
	{
		global $LNG;

		$db	= Database::get();
		$sql	= "SELECT id, email, username, lang FROM %%USERS%% WHERE mailListed = 0";
		$USERS = $db->select($sql, array(
			
		));
		
		foreach($USERS as $searchRow){
		$emailas = $searchRow['email'];
		$langlas = $searchRow['username'];
		$language = $searchRow['lang'];
		
		$sql = "UPDATE uni1_users SET mailListed = 1 WHERE id = :id;";

		$db->update($sql, array(
			':id'			=> $searchRow['id']
		));
			
			
		
		$sql	= "SELECT * FROM emails WHERE email = :email";
		$cautare3 = $db->select($sql, array(
		':email'	=> $emailas	
		));
		
		if(count($cautare3)==0){
			$sql = "INSERT INTO emails SET
                email	= :email,
                language	= :language,
                username		= :lang;";

			$db->insert($sql, array(
				':email'	=> $emailas,
				':language'	=> $language,
				':lang'			=> $langlas
			));
		}else{
			$sql = "UPDATE emails SET
                username		= :lang, language = :language WHERE email = :email;";

			$db->update($sql, array(
				':email'	=> $emailas,
				':language'	=> $language,
				':lang'			=> $langlas
			));
		}

		}
		
		echo true;

	}
	
	
}