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

function getFactors($USER, $Type = 'basic', $TIME = NULL) {
	global $resource, $pricelist, $reslist;
	if(empty($TIME))
		$TIME	= TIMESTAMP;
	
	$bonusList	= BuildFunctions::getBonusList();
	$factor		= ArrayUtil::combineArrayWithSingleElement($bonusList, 0);
	
	foreach($reslist['bonus'] as $elementID) {
		$bonus = $pricelist[$elementID]['bonus'];
		
		if (isset($PLANET[$resource[$elementID]])) {
			$elementLevel = $PLANET[$resource[$elementID]];
		} elseif (isset($USER[$resource[$elementID]])) {
			$elementLevel = $USER[$resource[$elementID]];
		} else {
			continue;
		}
		
		if(in_array($elementID, $reslist['dmfunc'])) {
				continue;
		} else {
			foreach($bonusList as $bonusKey)
			{
				$factor[$bonusKey]	+= $elementLevel * $bonus[$bonusKey][0];
			}
		}
	}
	
	return $factor;
}

function getGalaxySevenAccount($USER){
	global $resource, $pricelist, $reslist;

	$sql	= 'SELECT * FROM %%PLANETS%% WHERE id_owner = :userId AND gal6mod = 1 AND expiredTime > :expiredTime;';
	$specialInfo = database::get()->select($sql, array(
		':userId'		=> $USER['id'],
		':expiredTime'	=> TIMESTAMP
	));

	$specialArray = array('fleetComsumption' => 0, 'flyTime' => 0, 'conveyorLevel' => 0, 'stealEnnemie' => 0, 'armor' => 0, 'attack' => 0, 'shield' => 0, 'findUpgrade' => 0, 'simExpe' => 0, 'bonusExpe' => 0, 'findStellar' => 0, 'resourceProd' => 0, 'colliderProd' => 0, 'stealingOwn' => 0);

	foreach($specialInfo as $Info){
		$sql	= 'SELECT * FROM %%GAL7ACC%% WHERE specialId = :gal6type;';
		$bonusInfo = database::get()->selectSingle($sql, array(
			':gal6type'		=> $Info['gal6type']
		));

		foreach($specialArray as $type => $Bonus){
			$Bonus					+= $bonusInfo[$type];
			$specialArray[$type]	= $Bonus;
		}
	}

	return $specialArray;
}

function getGalaxySevenPlanet($PLANET){
	global $resource, $pricelist, $reslist;

	$specialArray = array('conveyorBonus' => 0, 'darkmatterProd' => 0, 'buildM7' => 0, 'buildM19' => 0, 'buildM32' => 0);

	$sql	= 'SELECT * FROM %%GAL7PLA%% WHERE specialId = :gal6type;';
	$bonusInfo = database::get()->selectSingle($sql, array(
		':gal6type'		=> $PLANET['gal6type']
	));

	foreach($specialArray as $type => $Bonus){
		$Bonus					+= $bonusInfo[$type];
		$specialArray[$type]	= $Bonus;
	}

	return $specialArray;
}

function fightIsHonorableAttacker($ownerUser, $targetUser){
	$sql		= "SELECT wapeonry_points, fleet_points, honor_points, honor_rank FROM %%STATPOINTS%% WHERE `universe` = 1 AND id_owner = :id_owner;";
	$militaryAttacker	= database::get()->selectSingle($sql, array(
		':id_owner'	=> $ownerUser['id']
	));
		
	$sql		= "SELECT wapeonry_points, fleet_points, honor_points, honor_rank FROM %%STATPOINTS%% WHERE `universe` = 1 AND id_owner = :id_owner;";
	$militaryDefender	= database::get()->selectSingle($sql, array(
		':id_owner'	=> $targetUser['userid']
	));
	
	$sql =  "SELECT * FROM %%BUDDY%% WHERE (sender = :userID AND owner = :targetID AND buddyType = 1 AND isAccepted = 1) OR (sender = :targetID AND owner = :userID AND buddyType = 1 AND isAccepted = 1);";
	$isFriend = database::get()->select($sql, array(
		':userID'		=> $ownerUser['id'],
		':targetID'		=> $targetUser['id']
	));
		
	$AttackerWapeonryPoints = $militaryAttacker['wapeonry_points'];
	$DefenderWapeonryPoints = $militaryDefender['wapeonry_points'];
	$isAttackerHonorable	= 0;
	$isDefenderHonorable	= 0;
	$isAttackerBandit		= $militaryAttacker['honor_points'] <= -5000 && ($Lowestrank - 250) <= $militaryAttacker['honor_rank'] ? 1 : 0;
	$isDefenderBandit		= $militaryDefender['honor_points'] <= -5000 && ($Lowestrank - 250) <= $militaryDefender['honor_rank'] ? 1 : 0;
	
	if($targetUser['onlinetime'] < TIMESTAMP - 7*24*3600 || ($ownerUser['ally_id'] == $targetUser['ally_id'] && $ownerUser['ally_id'] != 0) || count($isFriend) > 0){
		$isAttackerHonorable = -1;
	}elseif($isDefenderBandit == 1 && $AttackerWapeonryPoints /100 * 1 <= $fleetPointsAttackerHonor || ($AttackerWapeonryPoints <= $DefenderWapeonryPoints) && $isDefenderBandit == 0 || ($militaryAttacker['wapeonry_points'] + 100) >= $militaryDefender['wapeonry_points']){
		$isAttackerHonorable = 1;
	}elseif(($AttackerWapeonryPoints > $DefenderWapeonryPoints) && $isDefenderBandit == 0){
		$isAttackerHonorable = 0;
	}
	
	return $isAttackerHonorable;
}

function GubPriceAPSTRACT($Element, $Level, $ElementName){
	$UpLevel		= $Level;
	$db	= Database::get();
	$sql	= 'SELECT * FROM %%GOUVERNORS%% WHERE gouvernorId = :gouvernorId;';
	$GOUVERNORS = $db->selectSingle($sql, array(
	':gouvernorId'	=> $Element
	));
			
	$MathBonus = floor($GOUVERNORS['gouvernorDefault'] * $GOUVERNORS['gouvernorFactor'] + ($GOUVERNORS['gouvernorBonuslevel'] * floor($UpLevel / $GOUVERNORS['gouvernorDivider']) * $GOUVERNORS['gouvernorFactor']));
  	
	return $MathBonus;
}

function tournement($playerId, $tourneyEvent, $addUnits){
	$sql = "SELECT * FROM %%TOURNEY%% WHERE tourneyEvent = :tourneyId;";
	$tourneyInfo = database::get()->selectSingle($sql, array(
		':tourneyId'	=> $tourneyEvent,
	));
	$sql = "SELECT * FROM %%TOURNEYPARTICI%% WHERE tourneyJoin = :tourneyId AND playerId = :playerId;";
	$tourneyCheck = database::get()->selectSingle($sql, array(
		':tourneyId'	=> $tourneyInfo['tourneyId'],
		':playerId'		=> $playerId
	));
	if(!empty($tourneyCheck) && config::get()->tourneyEnd >= TIMESTAMP){	
		$sql	= 'UPDATE %%TOURNEYPARTICI%% SET tourneyUnits = tourneyUnits + :tourneyUnits WHERE tourneyJoin = :tourneyJoin AND playerId = :playerId;';
		database::get()->update($sql, array(
			':tourneyUnits'	=> $addUnits,
			':tourneyJoin'	=> $tourneyInfo['tourneyId'],
			':playerId'		=> $playerId,
		));
	}
}

function expeEventPoints($playerId, $addUnits){
	if(TIMESTAMP >= 1510182000 && TIMESTAMP < 1511132400){
		$sql	= 'UPDATE %%USERS%% SET expeEventPoints = expeEventPoints + :expeEventPoints WHERE id = :playerId;';
		database::get()->update($sql, array(
			':expeEventPoints'	=> $addUnits,
			':playerId'			=> $playerId,
		));
	}
}

function widrawAP($widrawAmount, $userId) {
	global $USER, $LNG;
	if($USER['academy_p'] >= $widrawAmount){
		$USER['academy_p'] -= $widrawAmount;
		$sql	= 'UPDATE %%USERS%% SET academy_p = academy_p - :academy_p WHERE id = :userId;';
		database::get()->update($sql, array(
			':academy_p'	=> $widrawAmount,
			':userId'		=> $userId,
		));
		tournement($userId, 4, $widrawAmount);
	}elseif(($USER['academy_p'] + $USER['academy_p_reset']) >= $widrawAmount){
		$USER['academy_p_reset'] 	-= $widrawAmount - $USER['academy_p'];
		tournement($userId, 4, $USER['academy_p']);
		$sql	= 'UPDATE %%USERS%% SET academy_p = 0, academy_p_reset = academy_p_reset - :academy_p_reset WHERE id = :userId;';
		database::get()->update($sql, array(
			':academy_p_reset'		=> $widrawAmount - $USER['academy_p'],
			':userId'				=> $userId,
		));
		$USER['academy_p'] 		= 0;
		
	}
}
	
function timeElapsedString($ptime){
    $diff = time() - $ptime;
    $calc_times = array();
    $timeleft   = array();

    // Prepare array, depending on the output we want to get.
    $calc_times[] = array('Year',   'Years',   31557600);
    $calc_times[] = array('Month',  'Months',  2592000);
    $calc_times[] = array('Day',    'Days',    86400);
    $calc_times[] = array('Hour',   'Hours',   3600);
    $calc_times[] = array('Minute', 'Minutes', 60);
    $calc_times[] = array('Second', 'Seconds', 1);

    foreach ($calc_times AS $timedata){
        list($time_sing, $time_plur, $offset) = $timedata;

        if ($diff >= $offset){
            $left = floor($diff / $offset);
            $diff -= ($left * $offset);
            $timeleft[] = "{$left} " . ($left == 1 ? $time_sing : $time_plur);
        }
    }

    return $timeleft ? (time() > $ptime ? null : '-') . implode(' ', $timeleft)." ago" : "Just Now";
}

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'commentforhofs';
    $secret_iv = 'xterium';

    // hash
    $key = hash('sha256', $secret_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function calculation($academyId, $USER, $Count = NULL){
	global $LNG, $resource, $PLANET;	
	
	$userBranch  = 0;
	
	if($academyId > 1300){
		$userBranch  = 3;	
	}elseif($academyId > 1200){
		$userBranch  = 2;	
	}else{
		$userBranch  = 1;		
	}
	
	$sql	= 'SELECT * FROM %%ACADEMY%% WHERE skill_id = :academyId;';
	$academyDetail = database::get()->selectSingle($sql, array(
		':academyId'	=> $academyId
	));
	
	if(empty($academyDetail)){
		return 0;
	}else{
		if(!isset($Count)) {
			$Count = pretty_number(max($USER["academy_p_b_".$userBranch."_".$academyId]+1, $USER["academy_p_b_".$userBranch."_".$academyId]));
		}else{
			$Count = pretty_number(max($Count, $USER["academy_p_b_".$userBranch."_".$academyId]));
		}
				
		$FulCost = 0;
		$i = $USER["academy_p_b_".$userBranch."_".$academyId];
		for ($i; $i < $Count; $i++) 
		{        	
			$FulCost += floor($academyDetail['icost'] * pow($academyDetail['factor'], $i));
		}
		return $FulCost;
	}
}

function calculationCheck($academyId, $USER, $Count = NULL){
	global $LNG, $resource, $PLANET;	
	
	$userBranch  = 0;
	
	if($academyId > 1300){
		$userBranch  = 3;	
	}elseif($academyId > 1200){
		$userBranch  = 2;	
	}else{
		$userBranch  = 1;		
	}
	
	$sql	= 'SELECT * FROM %%ACADEMY%% WHERE skill_id = :academyId;';
	$academyDetail = database::get()->selectSingle($sql, array(
		':academyId'	=> $academyId
	));
	
	if(empty($academyDetail)){
		return 0;
	}else{
		if(!isset($Count)) {
			$Count = pretty_number(max($USER["academy_p_b_".$userBranch."_".$academyId], $USER["academy_p_b_".$userBranch."_".$academyId]));
		}else{
			$Count = pretty_number(max($Count, $USER["academy_p_b_".$userBranch."_".$academyId]));
		}
				
		$FulCost = 0;
		$i = $USER["academy_p_b_".$userBranch."_".$academyId];
		for ($i; $i < $Count; $i++) 
		{        	
			$FulCost += floor($academyDetail['icost'] * pow($academyDetail['factor'], $i));
		}
		return $FulCost;
	}
}

function academyBonus($academyId, $USER){
	global $LNG, $resource, $PLANET;	
	
	$userBranch  = 0;
	
	if($academyId > 1300){
		$userBranch  = 3;	
	}elseif($academyId > 1200){
		$userBranch  = 2;	
	}else{
		$userBranch  = 1;		
	}
	
	$sql	= 'SELECT * FROM %%ACADEMY%% WHERE skill_id = :academyId;';
	$academyDetail = database::get()->selectSingle($sql, array(
		':academyId'	=> $academyId
	));
	$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
	$userDetail = database::get()->selectSingle($sql, array(
		':userId'	=> $USER['id']
	));
		
	$ElementLevel = $userDetail['academy_p_b_'.$userBranch.'_'.$academyId];	
	$ab1 = $academyDetail['ab1'] * $ElementLevel;
	
	return $ab1;
}
	
function getPlanets($USER)
{
	if(isset($USER['PLANETS']))
		return $USER['PLANETS'];

	$order = $USER['planet_sort_order'] == 1 ? "DESC" : "ASC" ;

	$sql = "SELECT id, name, galaxy, system, id_luna, last_relocate, gal6mod, gal6mod, gal6type, hangar, nano_factory, planet, light_conveyor, medium_conveyor, heavy_conveyor, planet_type, image, b_building, b_building_id, b_hangar_id, b_hangar, metal, crystal, deuterium, metal_max, crystal_max, deuterium_max, ev_transporter
			FROM %%PLANETS%% WHERE id_owner = :userId AND planet_type = :planet_type AND destruyed = :destruyed ORDER BY ";

	switch($USER['planet_sort'])
	{
		case 0:
			$sql	.= 'id '.$order;
			break;
		case 1:
			$sql	.= 'galaxy, system, planet, planet_type '.$order;
			break;
		case 2:
			$sql	.= 'name '.$order;
			break;
	}

	$planetsResult = Database::get()->select($sql, array(
		':userId'		=> $USER['id'],
		':planet_type'		=> 1,
		':destruyed'	=> 0
   	));
	
	$planetsList = array();

	foreach($planetsResult as $planetRow) {
		$planetsList[$planetRow['id']]	= $planetRow;
	}

	return $planetsList;
}

function getPlanetsHIDDEN($USER)
{
	

	$order = $USER['planet_sort_order'] == 1 ? "DESC" : "ASC" ;

	$sql = "SELECT id, name, galaxy, system, id_luna, hangar, nano_factory, gal6mod, gal6type, light_conveyor, medium_conveyor, heavy_conveyor, planet, planet_type, image, b_building, b_building_id, b_hangar_id, b_hangar, metal, crystal, deuterium, metal_max, crystal_max, deuterium_max, ev_transporter
			FROM %%PLANETS%% WHERE id_owner = :userId AND destruyed = :destruyed ORDER BY ";

	switch($USER['planet_sort'])
	{
		case 0:
			$sql	.= 'id '.$order;
			break;
		case 1:
			$sql	.= 'galaxy, system, planet, planet_type '.$order;
			break;
		case 2:
			$sql	.= 'name '.$order;
			break;
	}

	$planetsResult = Database::get()->select($sql, array(
		':userId'		=> $USER['id'],
		':destruyed'	=> 0
   	));
	
	$planetsList = array();

	foreach($planetsResult as $planetRow) {
		$planetsList[$planetRow['id']]	= $planetRow;
	}

	return $planetsList;
}

function get_timezone_selector() {
	// New Timezone Selector, better support for changes in tzdata (new russian timezones, e.g.)
	// http://www.php.net/manual/en/datetimezone.listidentifiers.php
	
	$timezones = array();
	$timezone_identifiers = DateTimeZone::listIdentifiers();

	foreach($timezone_identifiers as $value )
	{
		if ( preg_match( '/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $value ) )
		{
			$ex		= explode('/',$value); //obtain continent,city
			$city	= isset($ex[2])? $ex[1].' - '.$ex[2]:$ex[1]; //in case a timezone has more than one
			$timezones[$ex[0]][$value] = str_replace('_', ' ', $city);
		}
	}
	return $timezones; 
}

function locale_date_format($format, $time, $LNG = NULL)
{
	// Workaround for locale Names.

	if(!isset($LNG)) {
		global $LNG;
	}
	
	$weekDay	= date('w', $time);
	$months		= date('n', $time) - 1;
	
	$format     = str_replace(array('D', 'M'), array('$D$', '$M$'), $format);
	$format		= str_replace('$D$', addcslashes($LNG['week_day'][$weekDay], 'A..z'), $format);
	$format		= str_replace('$M$', addcslashes($LNG['months'][$months], 'A..z'), $format);
	
	return $format;
}

function _date($format, $time = null, $toTimeZone = null, $LNG = NULL)
{
	if(!isset($time))
	{
		$time	= TIMESTAMP;
	}

	if(isset($toTimeZone))
	{
		$date = new DateTime();
		if(method_exists($date, 'setTimestamp'))
		{	// PHP > 5.3			
			$date->setTimestamp($time);
		} else {
			// PHP < 5.3
			$tempDate = getdate((int) $time);
			$date->setDate($tempDate['year'], $tempDate['mon'], $tempDate['mday']);
			$date->setTime($tempDate['hours'], $tempDate['minutes'], $tempDate['seconds']);
		}
		
		$time	-= $date->getOffset();
		try {
			$date->setTimezone(new DateTimeZone($toTimeZone));
		} catch (Exception $e) {
			
		}
		$time	+= $date->getOffset();
	}
	
	$format	= locale_date_format($format, $time, $LNG);
	return date($format, $time);
}

function ValidateAddress($address) {
	
	if(function_exists('filter_var')) {
		return filter_var($address, FILTER_VALIDATE_EMAIL) !== FALSE;
	} else {
		/*
			Regex expression from swift mailer (http://swiftmailer.org)
			RFC 2822
		*/
		return preg_match('/^(?:(?:(?:(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))*(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))|(?:(?:[ \t]*(?:\r\n))?[ \t])))?(?:[a-zA-Z0-9!#\$%&\'\*\+\-\/=\?\^_\{\}\|~]+(\.[a-zA-Z0-9!#\$%&\'\*\+\-\/=\?\^_\{\}\|~]+)*)+(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))*(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))|(?:(?:[ \t]*(?:\r\n))?[ \t])))?)|(?:(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))*(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))|(?:(?:[ \t]*(?:\r\n))?[ \t])))?"((?:(?:[ \t]*(?:\r\n))?[ \t])?(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21\x23-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])))*(?:(?:[ \t]*(?:\r\n))?[ \t])?"(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))*(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))|(?:(?:[ \t]*(?:\r\n))?[ \t])))?))@(?:(?:(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))*(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))|(?:(?:[ \t]*(?:\r\n))?[ \t])))?(?:[a-zA-Z0-9!#\$%&\'\*\+\-\/=\?\^_\{\}\|~]+(\.[a-zA-Z0-9!#\$%&\'\*\+\-\/=\?\^_\{\}\|~]+)*)+(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))*(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))|(?:(?:[ \t]*(?:\r\n))?[ \t])))?)|(?:(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))*(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))|(?:(?:[ \t]*(?:\r\n))?[ \t])))?\[((?:(?:[ \t]*(?:\r\n))?[ \t])?(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x5A\x5E-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])))*?(?:(?:[ \t]*(?:\r\n))?[ \t])?\](?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))*(?:(?:(?:(?:[ \t]*(?:\r\n))?[ \t])?(\((?:(?:(?:[ \t]*(?:\r\n))?[ \t])|(?:(?:[\x01-\x08\x0B\x0C\x0E-\x19\x7F]|[\x21-\x27\x2A-\x5B\x5D-\x7E])|(?:\\[\x00-\x08\x0B\x0C\x0E-\x7F])|(?1)))*(?:(?:[ \t]*(?:\r\n))?[ \t])?\)))|(?:(?:[ \t]*(?:\r\n))?[ \t])))?)))$/D', $address);
	}
}

function message($mes, $dest = "", $time = "3", $topnav = false)
{
	require_once('includes/classes/class.template.php');
	$template = new template();
	$template->message($mes, $dest, $time, !$topnav);
	exit;
}

function CalculateMaxPlanetFields($planet)
{
	global $resource;
	
	$sql = 'SELECT * FROM %%USERS%% WHERE id = :planet';

	$User = Database::get()->selectSingle($sql, array(
		':planet'	=> $planet['id_owner']
	));
	
	
	return $planet['field_max'] + ($planet[$resource[33]] * FIELDS_BY_TERRAFORMER) + ($planet[$resource[41]] * FIELDS_BY_MOONBASIS_LEVEL) + $User['peacefull_exp_mission'];
}

function pretty_time($seconds)
{
	global $LNG;
	
	$day	= floor($seconds / 86400);
	$hour	= floor($seconds / 3600 % 24);
	$minute	= floor($seconds / 60 % 60);
	$second	= floor($seconds % 60);
	
	$time  = '';
	
	if($day >= 10) {
		$time .= $day.$LNG['short_day'].' ';
	} elseif($day > 0) {
		$time .= '0'.$day.$LNG['short_day'].' ';
	}
	
	if($hour >= 10) {
		$time .= $hour.$LNG['short_hour'].' ';
	} else {
		$time .= '0'.$hour.$LNG['short_hour'].' ';
	}
	
	if($minute >= 10) {
		$time .= $minute.$LNG['short_minute'].' ';
	} else {
		$time .= '0'.$minute.$LNG['short_minute'].' ';
	}
	
	if($second >= 10) {
		$time .= $second.$LNG['short_second'];
	} else {
		$time .= '0'.$second.$LNG['short_second'];
	}

	return $time;
}

function pretty_fly_time($seconds)
{
	$hour	= floor($seconds / 3600);
	$minute	= floor($seconds / 60 % 60);
	$second	= floor($seconds % 60);
	
	$time  = '';
	
	if($hour >= 10) {
		$time .= $hour;
	} else {
		$time .= '0'.$hour;
	}
	
	$time .= ':';
	
	if($minute >= 10) {
		$time .= $minute;
	} else {
		$time .= '0'.$minute;
	}
	
	$time .= ':';
	
	if($second >= 10) {
		$time .= $second;
	} else {
		$time .= '0'.$second;
	}

	return $time;
}

function GetStartAddressLink($FleetRow, $FleetType = '')
{
	return '<a href="game.php?page=galaxy&amp;galaxy='.$FleetRow['fleet_start_galaxy'].'&amp;system='.$FleetRow['fleet_start_system'].'" class="'. $FleetType .'">['.$FleetRow['fleet_start_galaxy'].':'.$FleetRow['fleet_start_system'].':'.$FleetRow['fleet_start_planet'].']</a>';
}

function GetTargetAddressLink($FleetRow, $FleetType = '')
{
	return '<a href="game.php?page=galaxy&amp;galaxy='.$FleetRow['fleet_end_galaxy'].'&amp;system='.$FleetRow['fleet_end_system'].'" class="'. $FleetType .'">['.$FleetRow['fleet_end_galaxy'].':'.$FleetRow['fleet_end_system'].':'.$FleetRow['fleet_end_planet'].']</a>';
}

function BuildPlanetAddressLink($CurrentPlanet)
{
	return '<a href="game.php?page=galaxy&amp;galaxy='.$CurrentPlanet['galaxy'].'&amp;system='.$CurrentPlanet['system'].'">['.$CurrentPlanet['galaxy'].':'.$CurrentPlanet['system'].':'.$CurrentPlanet['planet'].']</a>';
}

function pretty_number($n, $dec = 0)
{
	return number_format(floatToString($n, $dec), $dec, ',', '.');
}

function GetUserByID($userId, $GetInfo = "*")
{
	if(is_array($GetInfo))
	{
		$GetOnSelect = implode(', ', $GetInfo);
	}
	else
	{
		$GetOnSelect = $GetInfo;
	}

	$sql = 'SELECT '.$GetOnSelect.' FROM %%USERS%% WHERE id = :userId';

	$User = Database::get()->selectSingle($sql, array(
		':userId'	=> $userId
	));

	return $User;
}

function GetFromDatabase($table, $tableIndex, $tableId, $GetInfo = "*")
{
	if(is_array($GetInfo))
	{
		$GetOnSelect = implode(', ', $GetInfo);
	}
	else
	{
		$GetOnSelect = $GetInfo;
	}

	$sql = 'SELECT '.$GetOnSelect.' FROM %%'.$table.'%% WHERE '.$tableIndex.' = :tableId';

	$Data = Database::get()->selectSingle($sql, array(
		':tableId'	=> $tableId
	));

	return $Data;
}

function UpdatePremiumDatabase($table, $tableIndex, $tableId, $promotion = 0)
{
	$sql = 'UPDATE %%'.$table.'%% SET promotion = :promotion WHERE '.$tableIndex.' = :tableId';
	database::get()->update($sql, array(
		':promotion'=> $promotion,
		':tableId'	=> $tableId
	));
}

function makebr($text)
{
    // XHTML FIX for PHP 5.3.0
	// Danke an Meikel
	
    $BR = "<br>\n";
    return (version_compare(PHP_VERSION, "5.3.0", ">=")) ? nl2br($text, false) : strtr($text, array("\r\n" => $BR, "\r" => $BR, "\n" => $BR)); 
}

function CheckNoobProtec($OwnerPlayer, $TargetPlayer, $Player)
{
	$config	= Config::get();
	if(
		$config->noobprotection == 0 
		|| $config->noobprotectiontime == 0 
		|| $config->noobprotectionmulti == 0 
		|| $Player['banaday'] > TIMESTAMP
		|| $Player['onlinetime'] < TIMESTAMP - INACTIVE
	) {
		return array('NoobPlayer' => false, 'StrongPlayer' => false);
	}
	
	/*$newNoobValue = $config->noobprotectionmulti;
	if($OwnerPlayer['total_points'] >= 500000000 && $TargetPlayer['total_points'] >= 500000000)
		$newNoobValue = 10;
	elseif($OwnerPlayer['total_points'] > 500000000 && $TargetPlayer['total_points'] >= 100000000 && $OwnerPlayer['total_points'] / 10 < $TargetPlayer['total_points'] / 5 && $TargetPlayer['total_points'] < 500000000)
		$newNoobValue = 10;*/
		
		$newNoobValue = $config->noobprotectionmulti;
	if($OwnerPlayer['total_points'] >= 25000000000 && $TargetPlayer['total_points'] >= 25000000000)
		$newNoobValue = 10;
	elseif($OwnerPlayer['total_points'] > 25000000000 && $TargetPlayer['total_points'] >= 5000000000 && $OwnerPlayer['total_points'] / 10 < $TargetPlayer['total_points'] / 5 && $TargetPlayer['total_points'] < 25000000000)
		$newNoobValue = 10;
		
	
	return array(
		'NoobPlayer' => (
			/* WAHR: 
				Wenn Spieler mehr als 25000 Punkte hat UND
				Wenn ZielSpieler weniger als 80% der Punkte des Spieler hat.
				ODER weniger als 5.000 hat.
			*/
			// Addional Comment: Letzteres ist eigentlich sinnfrei, bitte testen.a
			($TargetPlayer['total_points'] <= $config->noobprotectiontime) && ($Player['outlaw'] < TIMESTAMP) && // Default: 25.000
			($OwnerPlayer['total_points'] > $TargetPlayer['total_points'] * $newNoobValue)
		), 
		'StrongPlayer' => (
			/* WAHR: 
				Wenn Spieler weniger als 5000 Punkte hat UND
				Mehr als das funfache der eigende Punkte hat
			*/
			($OwnerPlayer['total_points'] < $config->noobprotectiontime) && ($OwnerPlayer['outlaw'] < TIMESTAMP) && // Default: 5.000
			($OwnerPlayer['total_points'] * $newNoobValue < $TargetPlayer['total_points'])
		),
	);
}	

function shortly_number($number, $decial = NULL)
{
	$negate	= $number < 0 ? -1 : 1;
	$number	= abs($number);
    $unit	= array("", "K", "M", "B", "T", "Q", "Q+", "S", "S+", "O", "N");
	$key	= 0;
	
	if($number >= 1000000) {
		++$key;
		while($number >= 1000000)
		{
			++$key;
			$number = $number / 1000000;
		}
	} elseif($number >= 1000) {
		++$key;
		$number = $number / 1000;
	}
	
	$decial	= !is_numeric($decial) ? ((int) (((int)$number != $number) && $key != 0 && $number != 0 && $number < 100)) : $decial;
	return pretty_number($negate * $number, $decial).$unit[$key];
}

function floatToString($Numeric, $Pro = 0, $Output = false){
	return ($Output) ? str_replace(",",".", sprintf("%.".$Pro."f", $Numeric)) : sprintf("%.".$Pro."f", $Numeric);
}

function isModuleAvailable($ID)
{
	global $USER;
	$modules	= explode(';', Config::get()->moduls);

	if(!isset($modules[$ID]))
	{
		$modules[$ID] = 1;
	}

	return $modules[$ID] == 1 || (isset($USER['authlevel']) && $USER['authlevel'] > AUTH_USR);
}

function ClearCache()
{
	$DIRS	= array('cache/', 'cache/templates/');
	foreach($DIRS as $DIR) {
		$FILES = array_diff(scandir($DIR), array('..', '.', '.htaccess'));
		foreach($FILES as $FILE) {
			if(is_dir(ROOT_PATH.$DIR.$FILE))
				continue;
				
			unlink(ROOT_PATH.$DIR.$FILE);
		}
	}
	
	$template = new template();
	$template->clearAllCache();
	
	require_once 'includes/classes/Cronjob.class.php';
	Cronjob::reCalculateCronjobs();

	$sql	= 'UPDATE %%PLANETS%% SET eco_hash = :ecoHash;';
	Database::get()->update($sql, array(
		':ecoHash'	=> ''
	));
	clearstatcache();
	// Find currently Revision
	
	/* does no work on git.
	$REV = 0;

	$iterator = new RecursiveDirectoryIterator(ROOT_PATH);
	foreach(new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST) as $file) {
		if (false == $file->isDir()) {
			$CONTENT	= file_get_contents($file->getPathname());
			
			preg_match('!\$'.'Id: [^ ]+ ([0-9]+)!', $CONTENT, $match);
			
			if(isset($match[1]) && is_numeric($match[1]))
			{
				$REV	= max($REV, $match[1]);
			}
		}
	}
	
	$config->VERSION	= $version[0].'.'.$version[1].'.'.$REV;
	*/
	$config		= Config::get();
	$version	= explode('.', $config->VERSION);
	$config->VERSION	= $version[0].'.'.$version[1].'.'.'git';
	$config->save();
	
}

function allowedTo($side)
{
	global $USER;
	return ($USER['authlevel'] == AUTH_ADM || (isset($USER['rights']) && $USER['rights'][$side] == 1));
}

function isactiveDMExtra($Extra, $Time) {
	return $Time - $Extra <= 0;
}

function DMExtra($Extra, $Time, $true, $false) {
	return isactiveDMExtra($Extra, $Time) ? $true : $false;
}

function getRandomString() {
	return md5(uniqid());
}

function isVacationMode($USER)
{
	return ($USER['urlaubs_modus'] == 1) ? true : false;
}

function clearGIF() {
	header('Cache-Control: no-cache');
	header('Content-type: image/gif');
	header('Content-length: 43');
	header('Expires: 0');
	echo("\x47\x49\x46\x38\x39\x61\x01\x00\x01\x00\x80\x00\x00\x00\x00\x00\x00\x00\x00\x21\xF9\x04\x01\x00\x00\x00\x00\x2C\x00\x00\x00\x00\x01\x00\x01\x00\x00\x02\x02\x44\x01\x00\x3B");
	exit;
}

function getUsername($ID) {
	$username = '';
	
	$db	= Database::get();
	$sql	= "SELECT username, customNick FROM %%USERS%% WHERE id = :userID;";
	$userNameResult = $db->selectSingle($sql, array(
			':userID'	=> $ID
	));
	
	return empty($userNameResult['customNick']) ? $userNameResult['username'] : $userNameResult['customNick'];
	}
	
/*
 * Handler for exceptions
 *
 * @param object
 * @return Exception
 */
function exceptionHandler($exception)
{
	/** @var $exception ErrorException|Exception */
	global $USER;
	if(!headers_sent()) {
		if (!class_exists('HTTP', false)) {
			require_once('includes/classes/HTTP.class.php');
		}
		
		HTTP::sendHeader('HTTP/1.1 503 Service Unavailable');
	}

	if(method_exists($exception, 'getSeverity')) {
		$errno	= $exception->getSeverity();
	} else {
		$errno	= E_USER_ERROR;
	}
	
	$errorType = array(
		E_ERROR				=> 'ERROR',
		E_WARNING			=> 'WARNING',
		E_PARSE				=> 'PARSING ERROR',
		E_NOTICE			=> 'NOTICE',
		E_CORE_ERROR		=> 'CORE ERROR',
		E_CORE_WARNING   	=> 'CORE WARNING',
		E_COMPILE_ERROR		=> 'COMPILE ERROR',
		E_COMPILE_WARNING	=> 'COMPILE WARNING',
		E_DEPRECATED		=> 'DEPRECATED FUNCTION',
		E_USER_ERROR		=> 'USER ERROR',
		E_USER_WARNING		=> 'USER WARNING',
		E_USER_NOTICE		=> 'USER NOTICE',
		E_STRICT			=> 'STRICT NOTICE',
		E_RECOVERABLE_ERROR	=> 'RECOVERABLE ERROR'
	);
	
	if(file_exists(ROOT_PATH.'install/VERSION'))
	{
		$VERSION	= file_get_contents(ROOT_PATH.'install/VERSION').' (FILE)';
	}
	else
	{
		$VERSION	= 'UNKNOWN';
	}
	$gameName	= '-';
	
	if(MODE !== 'INSTALL')
	{
		try
		{
			$config		= Config::get();
			$gameName	= $config->game_name;
			$VERSION	= $config->VERSION;
		} catch(ErrorException $e) {
		}
	}
	
	$urlRow = array_key_exists('REQUEST_URI', $_SERVER) ? '<b>URL: </b>'.PROTOCOL.HTTP_HOST.$_SERVER['REQUEST_URI'].'<br>' : '';

	$DIR		= MODE == 'INSTALL' ? '..' : '.';
	ob_start();
	echo '<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="de" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="de" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="de" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="de" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="de" class="no-js"> <!--<![endif]-->
<head>
	<title>'.$gameName.' - '.$errorType[$errno].'</title>
	<meta name="generator" content="2Moons '.$VERSION.'">
	<!-- 
		This website is powered by 2Moons '.$VERSION.'
		2Moons is a free Space Browsergame initially created by Jan Kröpke and licensed under GNU/GPL.
		2Moons is copyright 2009-2013 of Jan Kröpke. Extensions are copyright of their respective owners.
		Information and contribution at http://2moons.cc/
	-->
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="'.$DIR.'/styles/resource/css/base/boilerplate.css?v='.$VERSION.'">
	<link rel="stylesheet" type="text/css" href="'.$DIR.'/styles/resource/css/ingame/main.css?v='.$VERSION.'">
	<link rel="stylesheet" type="text/css" href="'.$DIR.'/styles/resource/css/base/jquery.css?v='.$VERSION.'">
	<link rel="stylesheet" type="text/css" href="'.$DIR.'/styles/theme/gow/formate.css?v='.$VERSION.'">
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
	<script type="text/javascript">
	var ServerTimezoneOffset = -3600;
	var serverTime 	= new Date(2012, 2, 12, 14, 43, 36);
	var startTime	= serverTime.getTime();
	var localTime 	= serverTime;
	var localTS 	= startTime;
	var Gamename	= document.title;
	var Ready		= "Fertig";
	var Skin		= "'.$DIR.'/styles/theme/gow/";
	var Lang		= "de";
	var head_info	= "Information";
	var auth		= 3;
	var days 		= ["So","Mo","Di","Mi","Do","Fr","Sa"] 
	var months 		= ["Jan","Feb","Mar","Apr","Mai","Jun","Jul","Aug","Sep","Okt","Nov","Dez"] ;
	var tdformat	= "[M] [D] [d] [H]:[i]:[s]";
	var queryString	= "";

	setInterval(function() {
		serverTime.setSeconds(serverTime.getSeconds()+1);
	}, 1000);
	</script>
	<script type="text/javascript" src="'.$DIR.'/scripts/base/jquery.js?v=2123"></script>
	<script type="text/javascript" src="'.$DIR.'/scripts/base/jquery.ui.js?v=2123"></script>
	<script type="text/javascript" src="'.$DIR.'/scripts/base/jquery.cookie.js?v=2123"></script>
	<script type="text/javascript" src="'.$DIR.'/scripts/base/jquery.fancybox.js?v=2123"></script>
	<script type="text/javascript" src="'.$DIR.'/scripts/base/jquery.validationEngine.js?v=2123"></script>
	<script type="text/javascript" src="'.$DIR.'/scripts/base/tooltip.js?v=2123"></script>
	<script type="text/javascript" src="'.$DIR.'/scripts/game/base.js?v=2123"></script>
</head>
<body id="overview" class="full">
<table width="960">
	<tr>
		<th>'.$errorType[$errno].'</th>
	</tr>
	<tr>
		<td class="left">
			<b>Message: </b>'.$exception->getMessage().'<br>
			<b>File: </b>'.$exception->getFile().'<br>
			<b>Line: </b>'.$exception->getLine().'<br>
			'.$urlRow.'
			<b>PHP-Version: </b>'.PHP_VERSION.'<br>
			<b>PHP-API: </b>'.php_sapi_name().'<br>
			<b>MySQL-Cleint-Version: </b>'.mysqli_get_client_info().'<br>
			<b>2Moons Version: </b>'.$VERSION.'<br>
			<b>Debug Backtrace:</b><br>'.makebr(htmlspecialchars($exception->getTraceAsString())).'
		</td>
	</tr>
</table>
</body>
</html>';

	echo str_replace(array('\\', ROOT_PATH, substr(ROOT_PATH, 0, 15)), array('/', '/', 'FILEPATH '), ob_get_clean());
	
	$errorText	= date("[d-M-Y H:i:s]", TIMESTAMP).' '.$errorType[$errno].': "'.strip_tags($exception->getMessage())."\"\r\n";
	$errorText	.= 'File: '.$exception->getFile().' | Line: '.$exception->getLine()."\r\n";
	$errorText	.= 'URL: '.PROTOCOL.HTTP_HOST.$_SERVER['REQUEST_URI'].' | Version: '.$VERSION."\r\n";
	$errorText	.= 'USERID: '.$USER['username']."\r\n";
	$errorText	.= "Stack trace:\r\n";
	$errorText	.= str_replace(ROOT_PATH, '/', htmlspecialchars(str_replace('\\', '/',$exception->getTraceAsString())))."\r\n";
	
	
	$Information0	= $errorType[$errno].' '.strip_tags($exception->getMessage());
	$Information1	= $exception->getFile().' ('.$exception->getLine().')';
	$Information2	= PROTOCOL.HTTP_HOST.$_SERVER['REQUEST_URI'];
	$Information3	= $_SERVER['HTTP_USER_AGENT'];
	$Information4	= str_replace(ROOT_PATH, '/', htmlspecialchars(str_replace('\\', '/',$exception->getTraceAsString())));
	$Information5	= $errorText;
	$data 			=  $Information0.'[/]'.$Information1.'[/]'.$Information2.'[/]'.$Information3.'[/]'.$Information4.'[/]'.$Information5;
	
	$sql = "INSERT INTO %%ALOGS%% SET userId = :userId, userName = :userName, data = :data, time = :time, logMode = :logMode;";
	database::get()->insert($sql, array(
		':userId'	=> $USER['id'],
		':userName'	=> $USER['username'],
		':data'		=> $data,
		':time'		=> TIMESTAMP,
		':logMode'	=> 1
	));
	
	if(is_writable('includes/error.log'))
	{
		file_put_contents('includes/error.log', $errorText, FILE_APPEND);
	}
}
/*
 *
 * @throws ErrorException
 *
 * @return bool If its an hidden error.
 *
 */
function errorHandler($errno, $errstr, $errfile, $errline)
{
    if (!($errno & error_reporting())) {
        return false;
    }
	
	throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

// "workaround" for PHP version pre 5.3.0
if (!function_exists('array_replace_recursive'))
{
    function array_replace_recursive()
    {
        if (!function_exists('recurse')) {
            function recurse($array, $array1)
            {
                foreach ($array1 as $key => $value)
                {
                    // create new key in $array, if it is empty or not an array
                    if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key])))
                    {
                        $array[$key] = array();
                    }

                    // overwrite the value in the base array
                    if (is_array($value))
                    {
                        $value = recurse($array[$key], $value);
                    }
                    $array[$key] = $value;
                }
                return $array;
            }
        }

        // handle the arguments, merge one by one
        $args = func_get_args();
        $array = $args[0];
        if (!is_array($array))
        {
            return $array;
        }
        $count = count($args);
        for ($i = 1; $i < $count; ++$i)
        {
            if (is_array($args[$i]))
            {
                $array = recurse($array, $args[$i]);
            }
        }
        return $array;
    }
}


/**
 * Determines if a command exists on the current environment
 *
 * @param string $command The command to check
 * @return bool True if the command has been found ; otherwise, false.
 */
function command_exists($command) {
  $whereIsCommand = (PHP_OS == 'WINNT') ? 'where' : 'which';

  $process = proc_open(
    "$whereIsCommand $command",
    array(
      0 => array("pipe", "r"), //STDIN
      1 => array("pipe", "w"), //STDOUT
      2 => array("pipe", "w"), //STDERR
    ),
    $pipes
  );
  if ($process !== false) {
    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    proc_close($process);

    return $stdout != '';
  }

  return false;
} 