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

class CleanerCronjob implements CronjobTask
{
	function run()
	{
        $config	= Config::get(ROOT_UNI);

		$unis	= Universe::availableUniverses();
	
		
		
		foreach($unis as $uni)
		{
			$sql	= 'SELECT units FROM %%TOPKB%% WHERE universe = :universe ORDER BY units DESC LIMIT 99,1;';

			$battleHallLowest	= Database::get()->selectSingle($sql, array(
				':universe'	=> $uni
			),'units');

			if(!is_null($battleHallLowest))
			{
				$sql	= 'DELETE %%TOPKB%%, %%TOPKB_USERS%%
				FROM %%TOPKB%%
				INNER JOIN %%TOPKB_USERS%% USING (rid)
				WHERE universe = :universe AND units < :battleHallLowest;';

				Database::get()->delete($sql, array(
					':universe'			=> $uni,
					':battleHallLowest'	=> $battleHallLowest 
				));
			}
		}

	}
}