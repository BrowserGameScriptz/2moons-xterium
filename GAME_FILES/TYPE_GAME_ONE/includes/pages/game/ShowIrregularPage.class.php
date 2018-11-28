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

class ShowIrregularPage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
		 
	}
	
	function exchange()
	{
		global $LNG, $resource, $USER, $PLANET;
	
		$multiData = array();
	
		$db	= Database::get();
		$sql	= 'SELECT * FROM %%TRANSPORTLOGS%% WHERE (senderID = :senderID) OR (receiverID = :receiverID);';
		$GeTransport = $db->select($sql, array(
			':senderID'		=> $USER['id'],
			':receiverID'	=> $USER['id']
		));
		
		$GeTransportCount = $db->rowCount($GeTransport);
		foreach($GeTransport as $xb){
		$Statement = 0;
		if($xb['senderID'] == $USER['id']){
		$Statement = $xb['receiverID'];
		}else{
		$Statement = $xb['senderID'];	
		}
		
		$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
		$getuserAlly = $db->selectSingle($sql, array(
			':userId'		=> $Statement
		));
				
		$multiData[$xb['transportID']]	= array(
			'change_nick'		=> $xb['senderID'] == $USER['id'] ? $this->getUsername($xb['receiverID']) : $this->getUsername($xb['senderID']),
			'timeoftransport'		=> str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], ($xb['time'])), $USER['timezone']),
			'push'		=> pretty_number($xb['push']),
			'nickname_ally'		=> $getuserAlly['ally_id'] != 0 ? '['.$this->getAllianceTag($getuserAlly['ally_id']).']' : '',
			'status'		=> $xb['senderID'] == $USER['id'] ? 'expedition' : 'reception',
			'statusbis'		=> $xb['senderID'] == $USER['id'] ? $LNG['ls_answer_3'] : $LNG['ls_answer_4'],
			'strongest'		=> $xb['strongest'] == $USER['id'] ? 'vert' : 'rouge',
			'infouser'		=> $xb['senderID'] == $USER['id'] ? $xb['receiverID'] : $xb['senderID'],
			'metal'		=> pretty_number($xb['resource_metal']),
			'crystal'		=> pretty_number($xb['resource_crystal']),
			'deuterium'		=> pretty_number($xb['resource_deuterium']),
		);
		}
		$this->tplObj->loadscript('commerce.js');
		$this->tplObj->assign_vars(
		array(
        'multiData' => $multiData,                                
        'GeTransportCount' => pretty_number($GeTransportCount),                                
        ));
		$this->display("page.irregular.echange.tpl");
		
	}
	
 	function detail(){
	global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
	$id	= HTTP::_GP('id', 0);
	
	$db	= Database::get();
	$sql	= 'SELECT * FROM %%TRANSPORTLOGS%% WHERE transportID = :transportID;';
	$GeTransport = $db->selectSingle($sql, array(
		':transportID'		=> $id
	));
	
	$Statement = 0;
	if($GeTransport['senderID'] == $USER['id']){
	$Statement = $GeTransport['receiverID'];
	}else{
	$Statement = $GeTransport['senderID'];	
	}
	$times = str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], ($GeTransport['time'])), $USER['timezone']);
	$times2 = str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], ($GeTransport['time'] + 48*3600)), $USER['timezone']);
	$Statement = 0;
	$StatementBis = 0;
	if($GeTransport['senderID'] == $USER['id']){
	$Statement = $GeTransport['receiverID'];
	$StatementBis = $GeTransport['senderID'];
	}else{
	$Statement = $GeTransport['senderID'];	
	$StatementBis = $GeTransport['receiverID'];	
	}
	$timing		= $GeTransport['time'];
	$myUsername		= $this->getUsername($StatementBis);
    $otherUsername		= $this->getUsername($Statement);
	$strongest		= $GeTransport['strongest'] == $StatementBis ? 'rouge' : 'vert';
	$strongestbis		= $GeTransport['strongest'] == $StatementBis ? 'vert' : 'rouge';
	
	
	$sql	= 'SELECT SUM(resource_metal) as total_metal, SUM(resource_crystal) as total_crystal, SUM(resource_deuterium) as total_deuterium FROM %%TRANSPORTLOGS%% WHERE senderID = :senderID AND receiverID = :receiverID and time >= :time AND time <= :timy;';
	$GeTotalSend = $db->selectSingle($sql, array(
		':senderID'		=> $USER['id'],
		':receiverID'	=> $Statement,
		':time'			=> $timing,
		':timy'			=> ($timing + 48*3600)
	));
		
	$sql	= 'SELECT SUM(resource_metal) as total_metal, SUM(resource_crystal) as total_crystal, SUM(resource_deuterium) as total_deuterium FROM %%TRANSPORTLOGS%% WHERE senderID = :senderID AND receiverID = :receiverID and time >= :time AND time <= :timy;';
	$GeTotalSendNext = $db->selectSingle($sql, array(
		':senderID'		=> $Statement,
		':receiverID'	=> $USER['id'],
		':time'			=> $timing,
		':timy'			=> ($timing + 48*3600)
	));
	
	$total  = $GeTotalSend;
	$totalNext  = $GeTotalSendNext;
	$INFORS = $total['total_metal'] + $total['total_crystal']*2 + $total['total_deuterium']*4;
	$INFORST = $totalNext['total_metal'] + $totalNext['total_crystal']*2 + $totalNext['total_deuterium']*4;
	
	$strongestsend = $GeTransport['strongest'] == $USER['id'] ? $INFORS : $INFORST;
	$strongestsendB = $GeTransport['strongest'] == $USER['id'] ? $INFORST : $INFORS;
	$succes = 0;
	if($strongestsend >= $strongestsendB)
		$succes = 1;
		
		
	$this->tplObj->assign_vars(
	array(
	'totals'		=> $INFORS == 0 ? 1 : $INFORS ,                           
	'totalNexts'		=> $INFORST == 0 ? 1 : $INFORST,      
    'myUsername'		=> $myUsername,
    'otherUsername'		=> $otherUsername,
	'strongest'		=> $strongest,
	'strongestbis'		=> $strongestbis,
    'times'		=> $times,
    'succes'		=> $succes,
	'times2'		=> $times2,                           
	'total'		=> pretty_number($total['total_metal'] + $total['total_crystal']*2 + $total['total_deuterium']*4),                           
	'totalNext'		=> pretty_number($totalNext['total_metal'] + $totalNext['total_crystal']*2 + $totalNext['total_deuterium']*4),                           
    ));
	$this->display("page.irregular.detail.tpl");
	} 
	
	function show(){
		global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
		$multiData = array();
		
		$db	= Database::get();
		$sql	= 'SELECT * FROM %%TRANSPORTLOGS%% WHERE (senderID = :senderID AND legal = :legal) OR (receiverID = :receiverID AND legal = :legal);';
		$GeTransport = $db->select($sql, array(
			':senderID'		=> $USER['id'],
			':receiverID'	=> $USER['id'],
			':legal'		=> 1
		));
		
		foreach($GeTransport as $xb){
		$Statement = 0;
		if($xb['senderID'] == $USER['id']){
		$Statement = $xb['receiverID'];
		}else{
		$Statement = $xb['senderID'];	
		}
		$timing		= $xb['time'];
		$sql	= 'SELECT SUM(resource_metal) as total_metal, SUM(resource_crystal) as total_crystal, SUM(resource_deuterium) as total_deuterium FROM %%TRANSPORTLOGS%% WHERE senderID = :senderID AND receiverID = :receiverID and time >= :time AND time <= :timy;';
		$GeTotalSend = $db->selectSingle($sql, array(
			':senderID'		=> $USER['id'],
			':receiverID'	=> $Statement,
			':time'			=> $timing,
			':timy'			=> ($timing + 48*3600)
		));
		
		$sql	= 'SELECT SUM(resource_metal) as total_metal, SUM(resource_crystal) as total_crystal, SUM(resource_deuterium) as total_deuterium FROM %%TRANSPORTLOGS%% WHERE senderID = :senderID AND receiverID = :receiverID and time >= :time AND time <= :timy;';
		$GeTotalSendNext = $db->selectSingle($sql, array(
			':senderID'		=> $Statement,
			':receiverID'	=> $USER['id'],
			':time'			=> $timing,
			':timy'			=> ($timing + 48*3600)
		));
		
		$total  = $GeTotalSend;
		$totalNext  = $GeTotalSendNext;
		$totals		= $total['total_metal'] + $total['total_crystal']*2 + $total['total_deuterium']*4;                           
		$totalNexts		= $totalNext['total_metal'] + $totalNext['total_crystal']*2 + $totalNext['total_deuterium']*4;
		
		$totals = $totals;
		if($totals == 0){
		$totals = 1;
		}
		
		$strongestsend = $xb['strongest'] == $USER['id'] ? $totals : $totalNexts;
		$strongestsendB = $xb['strongest'] == $USER['id'] ? $totalNexts : $totals;
		
		$succes = 0;
		if (100-(100/$totals*$totalNexts) < 15 && 100-(100/$totals*$totalNexts) >=0 || $strongestsend >= $strongestsendB){
			$sql	= 'UPDATE %%TRANSPORTLOGS%% SET legal = :legal, reviewed = :reviewed WHERE transportID = :transportID;';
			$db->update($sql, array(
			':legal'		=> 1,
			':reviewed'		=> (TIMESTAMP + 24*3600),
			':transportID'	=> $xb['transportID']
			));
			$succes = 1;
		}elseif (100-(100/$totals*$totalNexts) > -15 && 100-(100/$totals*$totalNexts) <=0 || $strongestsend >= $strongestsendB){
			$sql	= 'UPDATE %%TRANSPORTLOGS%% SET legal = :legal, reviewed = :reviewed WHERE transportID = :transportID;';
			$db->update($sql, array(
			':legal'		=> 1,
			':reviewed'		=> (TIMESTAMP + 24*3600),
			':transportID'	=> $xb['transportID']
			));
			$succes = 1;
		}
		$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
		$getuserAlly = $db->selectSingle($sql, array(
			':userId'		=> $Statement
		));
		$multiData[$xb['transportID']]	= array(
		'change_nick'		=> $xb['senderID'] == $USER['id'] ? $this->getUsername($xb['receiverID']) : $this->getUsername($xb['senderID']),
		'nickname_ally'		=> $getuserAlly['ally_id'] != 0 ? '['.$this->getAllianceTag($getuserAlly['ally_id']).']' : '',
		'infouser'		=> $xb['senderID'] == $USER['id'] ? $xb['receiverID'] : $xb['senderID'],
		'strongest'		=> $xb['strongest'] == $USER['id'] ? 'vert' : 'rouge',
		'totals'		=> $totals == 0 ? 1 : $totals,
		'totalNexts'		=> $totalNexts == 0 ? 1 : $totalNexts,
		'succes'		=> $succes,
		);	
		}

		$this->tplObj->assign_vars(
		array(
            'multiData' => $multiData,                       
			));
		$this->display("page.irregular.push.tpl");
	} 
		
}
