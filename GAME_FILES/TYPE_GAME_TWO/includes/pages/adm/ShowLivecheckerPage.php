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

if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))) throw new Exception("Permission error!");

function ShowLivecheckerPage()
{
	global $LNG;
	
	if(empty(config::get()->meta_title)){
		$errorsTitleMessage  = "You have not defined a meta title for your game. [you can do this by clicking here.] ";
		$errorsTitleColor	 = "danger";
	}
	if(empty(config::get()->meta_descrip)){
		$errorsDescripMessage	 = "You have not defined a meta description for your game. [you can do this by clicking here.] ";
		$errorsDescripColor 	 = "danger";
	}
	
	$template	= new template();
	$template->loadscript('assets/js/core/app.js');
	$template->assign_vars(array(	
		'errorsTitleMessage'			=> $errorsTitleMessage,
		'errorsTitleColor'				=> $errorsTitleColor,
		'errorsDescripMessage'			=> $errorsDescripMessage,
		'errorsDescripColor'			=> $errorsDescripColor,
		'pageactiveshow'				=> HTTP::_GP('page', "", true),
		
	));
	$template->show('livechecker.tpl');
}