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

class ShowMercenaryPage extends AbstractGamePage
{
	public static $requireModule = 0;

	function __construct() 
	{	
		parent::__construct();
	}
	
	function checkcoordinates()
	{
		global $USER, $PLANET, $LNG, $resource;
		
		$MercenaryGalaxy   = HTTP::_GP('galaxy', 0);
		$MercenarySystem   = HTTP::_GP('system', 0);
		$MercenaryPlanet   = HTTP::_GP('planet', 0);
		
		$sql = "SELECT id_owner FROM %%PLANETS%% WHERE galaxy = :galaxy AND system = :system AND planet = :planet AND planet_type = 1;";
        $CheckCoords = database::get()->selectSingle($sql, array(
            ':galaxy' => $MercenaryGalaxy,
            ':system' => $MercenarySystem,
            ':planet' => $MercenaryPlanet
        ));
		
		if(empty($CheckCoords)){
			$arrayToSend = array('message' => "[<span style='color:red;'>There is no planet on the coordinates.</span>]", 'error' => true);
		}elseif(empty($CheckCoords['id_owner'])){
			$arrayToSend = array('message' => "[<span style='color:red;'>The planet is not owner by somene.</span>]", 'error' => true);
		}/*elseif($CheckCoords['id_owner'] == $USER['id']){
			$arrayToSend = array('message' => "[<span style='color:red;'>You cannot add a contract on your own account.</span>]", 'error' => true);
		}*/else{
			$sql = "SELECT urlaubs_modus, bana, ally_id FROM %%USERS%% WHERE id = :userId;";
			$targetInfo = database::get()->selectSingle($sql, array(
				':userId' => $CheckCoords['id_owner']
			));
			
			if(empty($targetInfo)){
				$arrayToSend = array('message' => "[<span style='color:red;'>The player does not exist in our database. Please warn the administration.</span>]", 'error' => true);
			}elseif($targetInfo['urlaubs_modus'] == 1){
				$arrayToSend = array('message' => "[<span style='color:red;'>The player is currently in vacation mode.</span>]", 'error' => true);
			}elseif($targetInfo['bana'] == 1){
				$arrayToSend = array('message' => "[<span style='color:red;'>The player is currently banned from the game.</span>]", 'error' => true);
			}elseif($targetInfo['ally_id'] == $USER['ally_id'] && $USER['ally_id'] > 1){
				$arrayToSend = array('message' => "[<span style='color:red;'>The player is in the same alliance as yours.</span>]", 'error' => true);
			}
			
			$arrayToSend = array('message' => "[<span style='color:green;'>You can go to step 2</span>]", 'error' => false);
			
		}
		
		$this->sendJSON($arrayToSend);
	}
	
	function show() 
	{
		global $USER, $PLANET, $LNG, $resource;
		
		
		$this->tplObj->loadscript('mercenary.js'); 
		$this->assign(array(
		
		));
		
		$this->display('page.mercenary.default.tpl');
	}
}
