<?php

/**
 *  2Moons 
 *   by Jan-Otto Kröpke 2009-2016
 *
 * For the full copyright and license information, please view the LICENSE
 *
 * @package 2Moons
 * @author Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2009 Lucky
 * @copyright 2016 Jan-Otto Kröpke <slaver7@gmail.com>
 * @licence MIT
 * @version 1.8.0
 * @link https://github.com/jkroepke/2Moons
 */

class ShowContractsPage extends AbstractGamePage
{
	public static $requireModule = 0;

	function __construct() 
	{	
		parent::__construct();
		$this->setWindow('popup');
	}
	
	function show() 
	{
		global $USER, $PLANET, $LNG, $USETT, $resource;
		
		$this->printMessage("This page is under development.", true, array('game.php?page=settings', 2));
		$this->assign(array(
		));
		
		$this->display('page.contracts.default.tpl');
	}
}
