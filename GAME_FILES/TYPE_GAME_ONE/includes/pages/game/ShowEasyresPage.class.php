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

class ShowEasyresPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
		 
	}
	
	function show()
	{
		global $LNG, $resource, $USER, $PLANET;
	
		$db	= Database::get();
		
		$action   = HTTP::_GP('action', '', UTF8_SUPPORT); 
		if($_GET && $action == "claim"){
			$logToAdd   = HTTP::_GP('id', 0);
			
			$sql	= 'SELECT * FROM %%EASYRES%% WHERE userId = :userId AND claimed = 0 AND addId = :addId;';
			$GeToolInfo = $db->selectSingle($sql, array(
				':userId'		=> $USER['id'],
				':addId'		=> $logToAdd,
			));
			
			if(empty($GeToolInfo)){
				$this->printMessage("<span>There is no log found be the tool.<br><br>Possible reasons: <br> • The resource log is from another player <br> • This log has already been refunded.</span>", true, array('game.php?page=easyres', 3));
			}else{
				
				$sql	= 'UPDATE %%EASYRES%% SET claimed = :claimed WHERE addId = :addId;';
				$db->update($sql, array(
					':addId'		=> $logToAdd,
					':claimed'		=> TIMESTAMP,
				));
				
				$PLANET['metal'] 	+= $GeToolInfo['metal'];
				$PLANET['crystal'] 	+= $GeToolInfo['crystal'];
				$PLANET['deuterium']+= $GeToolInfo['deuterium'];
				
				$sql	= 'UPDATE %%PLANETS%% SET metal = metal + :metal, crystal = crystal + :crystal, deuterium = deuterium + :deuterium WHERE id = :planetId;';
				$db->update($sql, array(
					':planetId'		=> $PLANET['id'],
					':metal'		=> $GeToolInfo['metal'],
					':crystal'		=> $GeToolInfo['crystal'],
					':deuterium'	=> $GeToolInfo['deuterium'],
				));
								
				$this->printMessage("<span>The log has been found in the tool.<br><br>These resource have been added on your planet: <br> • ".pretty_number($GeToolInfo['metal'])." metal <br> • ".pretty_number($GeToolInfo['crystal'])." crystal <br> • ".pretty_number($GeToolInfo['deuterium'])." deuterium</span>", true, array('game.php?page=easyres', 3));
			}
			
		}
		
		
		$multiData = array();
		$sql	= 'SELECT * FROM %%EASYRES%% WHERE userId = :userId;';
		$GeTransport = $db->select($sql, array(
			':userId'		=> $USER['id'],
		));
		
		$GeTransportCount = $db->rowCount($GeTransport);
		foreach($GeTransport as $xb){		
			$multiData[$xb['addId']]	= array(
				'status'				=> $xb['claimed'] == 0 ? 'expeditionc' : 'reception',
				'statusbis'				=> $xb['claimed'] == 0 ? "Waiting" : "Refunded",
				'summary'				=> pretty_number($xb['metal']+$xb['crystal']+$xb['deuterium']),
				'metal'					=> pretty_number($xb['metal']),
				'crystal'				=> pretty_number($xb['crystal']),
				'deuterium'				=> pretty_number($xb['deuterium']),
				'ticketId'				=> $xb['ticketId'],
				'claimed'				=> $xb['claimed'],
			);
		}
		$this->tplObj->loadscript('commerce.js');
		$this->tplObj->assign_vars(array(
			'multiData' => $multiData,                                
			'GeTransportCount' => pretty_number($GeTransportCount),                                
        ));
		$this->display("page.easyres.default.tpl");
		
	}
		
}
