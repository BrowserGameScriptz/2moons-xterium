<?php

/**
 *  2Moons
 *  Copyright (C) 2011 Jan Kröpke
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
 * @copyright 2009 Lucky
 * @copyright 2011 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.0 (2011-12-10)
 * @info $Id$
 * @link http://code.google.com/p/2moons/
 */

require_once 'includes/classes/cronjob/CronjobTask.interface.php';

class InactiveMailCronjob
{
	function run()
	{
		global $LNG;

		$config	= Config::get(ROOT_UNI);
		
		if($config->mail_active == 1) {
			/** @var $langObjects Language[] */
			$langObjects	= array();
		
			require 'includes/classes/Mail.class.php';

			$sql	= 'SELECT `username`, `language`, `email`
			FROM %%EMAILS%% WHERE `isSend` = 0 LIMIT 25;';

			$inactiveUsers	= Database::get()->select($sql, array());

			foreach($inactiveUsers as $user)
			{
				if(!isset($langObjects[$user['language']]))
				{
					$langObjects[$user['language']]	= new Language($user['language']);
					$langObjects[$user['language']]->includeData(array('L18N', 'INGAME', 'PUBLIC', 'CUSTOM'));
				}

				$userConfig	= Config::get(ROOT_UNI);
				
				$LNG			= $langObjects[$user['language']];
				
				$MailSubject	= "Chrome Extention: Xterium Galaxy Tool";
				$MailRAW		= $LNG->getTemplate('email_inactive');
				
				$MailContent	= str_replace(array(
					'{USERNAME}',
					'{EMAIL}',
				), array(
					$user['username'],
					$user['email'],
				), $MailRAW);
						
				Mail::send($user['email'], $user['username'], $MailSubject, $MailContent);

				$sql	= 'UPDATE %%EMAILS%% SET `isSend` = 1 WHERE `email` = :email;';
				Database::get()->update($sql, array(
					':email'	=> $user['email']
				));
			}
		}
	}
}