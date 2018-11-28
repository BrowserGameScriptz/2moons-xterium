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

$planetData	= array(
	1	=> array('temp' => mt_rand(220, 265),'temp2' => mt_rand(260, 305),	'fields' => mt_rand(173, 190),	'image' => array('trocken' => mt_rand(1, 10), 'wuesten' => mt_rand(1, 4))),
	2	=> array('temp' => mt_rand(180, 225),'temp2' => mt_rand(220, 265),	'fields' => mt_rand(176, 193),	'image' => array('trocken' => mt_rand(1, 10), 'wuesten' => mt_rand(1, 4))),
	3	=> array('temp' => mt_rand(140, 180),'temp2' => mt_rand(180, 220),	'fields' => mt_rand(177, 228),	'image' => array('trocken' => mt_rand(1, 10), 'wuesten' => mt_rand(1, 4))),
	4	=> array('temp' => mt_rand(80, 120),'temp2' => mt_rand(120, 160),	'fields' => mt_rand(180, 245),	'image' => array('dschjungel' => mt_rand(1, 10))),
	5	=> array('temp' => mt_rand(65, 105),'temp2' => mt_rand(105, 145),	'fields' => mt_rand(186, 261),	'image' => array('dschjungel' => mt_rand(1, 10))),
	6	=> array('temp' => mt_rand(40, 80),'temp2' => mt_rand(80, 120),		'fields' => mt_rand(209, 313),	'image' => array('dschjungel' => mt_rand(1, 10))),
	7	=> array('temp' => mt_rand(30, 100),'temp2' => mt_rand(70, 100),		'fields' => mt_rand(242, 323),	'image' => array('normaltemp' => mt_rand(1, 7))),
	8	=> array('temp' => mt_rand(30, 60),	'temp2' => mt_rand(55, 95),	'fields' => mt_rand(232, 343),	'image' => array('normaltemp' => mt_rand(1, 7))),
	9	=> array('temp' => mt_rand(15, 55),'temp2' => mt_rand(40, 80),		'fields' => mt_rand(243, 404),	'image' => array('normaltemp' => mt_rand(1, 7), 'wasser' => mt_rand(1, 9))),
	10	=> array('temp' => mt_rand(-20, 20),'temp2' => mt_rand(20, 60),		'fields' => mt_rand(269, 379),	'image' => array('normaltemp' => mt_rand(1, 7), 'wasser' => mt_rand(1, 9))),
	11	=> array('temp' => mt_rand(-40, 3),'temp2' => mt_rand(0, 43),		'fields' => mt_rand(263, 362),	'image' => array('normaltemp' => mt_rand(1, 7), 'wasser' => mt_rand(1, 9))),
	12	=> array('temp' => mt_rand(-45, 20),'temp2' => mt_rand(-5, 20),	'fields' => mt_rand(259, 359),	'image' => array('normaltemp' => mt_rand(1, 7), 'wasser' => mt_rand(1, 9))),
	13	=> array('temp' => mt_rand(-50, 20),'temp2' => mt_rand(-10, 20),	'fields' => mt_rand(250, 341),	'image' => array('wuesten' => mt_rand(1, 4))),
	14	=> array('temp' => mt_rand(-70, 30),'temp2' => mt_rand(-30, 10),	'fields' => mt_rand(242, 315),	'image' => array('wuesten' => mt_rand(1, 4))),
	15	=> array('temp' => mt_rand(-100, -60),'temp2' => mt_rand(-60, -20),	'fields' => mt_rand(226, 272),	'image' => array('wasser' => mt_rand(1, 9))),
	16	=> array('temp' => mt_rand(-130, -50),'temp2' => mt_rand(-90, -50),	'fields' => mt_rand(191, 207),	'image' => array('wasser' => mt_rand(1, 9))),
	17	=> array('temp' => mt_rand(-130, -90),'temp2' => mt_rand(-190, -130),	'fields' => mt_rand(155, 170),	'image' => array('eis' => mt_rand(1, 10))),
	18	=> array('temp' => mt_rand(-190, -160),'temp2' => mt_rand(-150, -120),	'fields' => mt_rand(134, 146),	'image' => array('eis' => mt_rand(1, 10))),
	19	=> array('temp' => mt_rand(-220, -180),'temp2' => mt_rand(-180, -140),	'fields' => mt_rand(134, 146),	'image' => array('eis' => mt_rand(1, 10))),
	20	=> array('temp' => mt_rand(-290, -240),'temp2' => mt_rand(-250, -200),	'fields' => mt_rand(134, 146),	'image' => array('eis' => mt_rand(1, 10)))
);