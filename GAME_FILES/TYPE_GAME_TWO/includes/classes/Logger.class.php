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
 * @version 2.0 (2012-11-31)
 * @info $Id$
 * @link http://2moons.cc/
 */

class Logger {
 
	protected $fh;
 
	public function __construct() {
		$this->fh = fopen('includes/classes/missions/logs/log.txt', 'a+');
	}
 
	public function log($msg) {
		if(!$this->fh) {
			throw new Exception('Unable to open log file for writing');
		}
		if(fwrite($this->fh, $msg . "\n") === false) {
			throw new Exception('Unable to write to log file.');
		}
	}
 
	public function __destruct() {
		fclose($this->fh);
	}
}