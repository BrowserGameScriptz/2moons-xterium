<?php

define('MODE', 'JSON');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

$session    = Session::load();
if(!$session->isValidSession()){
	$session->delete();
	exit();
}

$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
$USER	= Database::get()->selectSingle($sql, array(
	':userId'	=> $session->userId
));

$LNG = new Language($USER['lang']);
$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME'));

$ataks 	 = HTTP::_GP('ataks', 0);
$grab	 = HTTP::_GP('grab', 0);
$spio	 = HTTP::_GP('spio', 0);
$unic	 = HTTP::_GP('unic', 0);
$rakets	 = HTTP::_GP('rakets', 0);
//MESSAGE PART
$totalUnread = "";
$sql	= 'SELECT COUNT(message_unread) as count FROM %%MESSAGES%% WHERE message_owner = :userId AND message_unread = 1 AND message_deleted = 0;';
$totalCount	= Database::get()->selectSingle($sql, array(
	':userId'	=> $session->userId,
));

if($totalCount['count'] != 0){
	$totalUnread = $totalCount['count'];	
}
//END MESSAGE PART

//SOUNDATAKS PART
$SOUNDATAKS = false;
$sql	= 'SELECT COUNT(*) as count FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = 1 AND fleet_mess = 0 AND sirena = 0';
$totalAttacks	= Database::get()->selectSingle($sql, array(
	':userId'	=> $session->userId
));
if(!empty($totalAttacks['count'])){
	$sql	= "UPDATE %%FLEETS%% SET sirena	= 1 WHERE sirena = 0 AND fleet_target_owner = :userId AND fleet_mission = 1;";
	Database::get()->update($sql, array(
		':userId'			=> $session->userId
	));
	$SOUNDATAKS = true;	
}
//END SOUNDATAKS PART

//ATTACK PART
$totalAttacks = 0;
$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID';
$totalAttacks	= Database::get()->selectSingle($sql, array(
':userId'	=> $session->userId,
':missionID'	=> 1,
':mesID'	=> 0
), 'fleet_id');
if($totalAttacks != 0){
	$totalAttacks = $totalAttacks;	
}
//END ATTACK PART

//unic PART
$unicAttacks = 0;
$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID';
$unicAttacks	= Database::get()->selectSingle($sql, array(
	':userId'	=> $session->userId,
	':missionID'	=> 9,
	':mesID'	=> 0
), 'fleet_id');
if($unicAttacks != 0){
	$unicAttacks = $unicAttacks;	
}
//END unic PART

//ROCKET PART
$totalRockets = 0;
$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID';
$totalRockets	= Database::get()->selectSingle($sql, array(
	':userId'	=> $session->userId,
	':missionID'	=> 10,
	':mesID'	=> 0
), 'fleet_id');
if($totalRockets != 0){
	$totalRockets = $totalRockets;	
}
//END ROCKET PART

//SPIO PART
$totalSpio = 0;
$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess = :mesID';
$totalSpio	= Database::get()->selectSingle($sql, array(
	':userId'	=> $session->userId,
	':missionID'	=> 6,
	':mesID'	=> 0
), 'fleet_id');
if($totalSpio != 0){
	$totalSpio = $totalSpio;	
}
//END SPIO PART

//CAPTURE PART
$totalCapture = 0;
$sql	= 'SELECT COUNT(fleet_id) as fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId AND fleet_mission = :missionID AND fleet_mess != :mesID';
$totalCapture	= Database::get()->selectSingle($sql, array(
	':userId'	=> $session->userId,
	':missionID'	=> 25,
	':mesID'	=> 1
), 'fleet_id');
if($totalCapture != 0){
	$totalCapture = $totalCapture;	
}
//END CAPTURE PART

//ICON 
$FleetList = array();
$sql	= 'SELECT * FROM %%FLEETS%% WHERE fleet_mess = :fleet_mess AND fleet_target_owner = :fleet_target_owner';
$totalIncoming	= Database::get()->select($sql, array(
	':fleet_target_owner'	=> $session->userId,
	':fleet_mess'	=> 0
));
foreach($totalIncoming as $Fleets){
	$FleetList[]	= array(
		'fleet_id'				=> $Fleets['fleet_id'],
		'fleet_owner'				=> $Fleets['fleet_owner'],
		'fleet_mission'				=> $Fleets['fleet_mission'],
		'fleet_amount'				=> $Fleets['fleet_amount'],
		'fleet_array'				=> $Fleets['fleet_array'],
		'fleet_universe'				=> $Fleets['fleet_universe'],
		'fleet_start_time'				=> $Fleets['fleet_start_time'],
		'fleet_start_id'				=> $Fleets['fleet_start_id'],
		'fleet_start_galaxy'				=> $Fleets['fleet_start_galaxy'],
		'fleet_start_system'				=> $Fleets['fleet_start_system'],
		'fleet_start_planet'				=> $Fleets['fleet_start_planet'],
		'fleet_start_type'				=> $Fleets['fleet_start_type'],
		'fleet_end_time'				=> $Fleets['fleet_end_time'],
		'fleet_end_stay'				=> $Fleets['fleet_end_stay'],
		'fleet_end_id'				=> $Fleets['fleet_end_id'],
		'fleet_end_galaxy'				=> $Fleets['fleet_end_galaxy'],
		'fleet_end_system'				=> $Fleets['fleet_end_system'],
		'fleet_end_planet'				=> $Fleets['fleet_end_planet'],
		'fleet_end_type'				=> $Fleets['fleet_end_type'],
		'fleet_target_obj'				=> $Fleets['fleet_target_obj'],
		'fleet_resource_metal'				=> $Fleets['fleet_resource_metal'],
		'fleet_resource_crystal'				=> $Fleets['fleet_resource_crystal'],
		'fleet_resource_deuterium'				=> $Fleets['fleet_resource_deuterium'],
		'fleet_resource_darkmatter'				=> $Fleets['fleet_resource_darkmatter'],
		'fleet_target_owner'				=> $Fleets['fleet_target_owner'],
		'fleet_group'				=> $Fleets['fleet_group'],
		'fleet_mess'				=> $Fleets['fleet_mess'],
		'start_time'				=> $Fleets['start_time'],
		'fleet_busy'				=> $Fleets['fleet_busy'],
		'ally_id'				=> $Fleets['ally_id'],
	);	
}

//END ICON PART
$attackActive = "";
if ($totalAttacks > 0){
	$attackActive = "active_indicator";
}
$spioActive = "";
if ($totalSpio > 0){
	$spioActive = "active_indicator";
}
$unicActive = "";
if ($unicAttacks > 0){
	$unicActive = "active_indicator";
}
$rocketActive = "";
if ($totalRockets > 0){
	$rocketActive = "active_indicator";
}
$captureActive = "";
if ($totalCapture > 0){
	$captureActive = "active_indicator";
}

$varAttack = $totalAttacks > 0 ? $LNG['customm_1_1'] : $LNG['customm_1'];
$varSpied  = $totalSpio > 0 ? $LNG['customm_4_1'] : $LNG['customm_4'];
$varCaptu  = $unicAttacks > 0 ? $LNG['customm_2_1'] : $LNG['customm_2'];
$varRocke  = $totalRockets > 0 ? $LNG['customm_5_1'] : $LNG['customm_5'];
$varCaptu  = $totalCapture > 0 ? $LNG['customm_2_1'] : $LNG['customm_2'];

$Notifications	= array();

$sql	= 'SELECT * FROM %%NOTIF%% WHERE userId = :userId AND isDisplayed = 0';
$notifArray	= Database::get()->select($sql, array(
	':userId'	=> $session->userId
));

foreach($notifArray as $notif){
	if($notif['isType'] == 1)
		$noType = "success";
	elseif($notif['isType'] == 2)
		$noType = "error";
	else
		$noType = "chuchotement";
	
	if($notif['isType'] != 99 && $notif['timestamp'] < TIMESTAMP - 60){
		$sql	= "UPDATE %%NOTIF%% SET isDisplayed	= 1 WHERE notifId = :notifId;";
		Database::get()->update($sql, array(
			':notifId'			=> $notif['notifId']
		));
		continue;
	}
	
	$temps = 12;
	if($notif['isType'] == 99)
		$temps = 25;
	
	$Notifications[]	= array("time"=>$notif['timestamp'],"texte"=>$notif['noText'],"temps"=>$temps,"type"=>$noType,"image"=>$notif['noImage']);
	
	$sql	= "UPDATE %%NOTIF%% SET isDisplayed	= 1 WHERE notifId = :notifId;";
	Database::get()->update($sql, array(
		':notifId'			=> $notif['notifId']
	));
}

$arr = array('ataks'=>"".$totalAttacks."",'grab'=>"".$totalCapture."",'spio'=>"".$totalSpio."",'unic'=>"".$unicAttacks."",'rakets'=>"".$totalRockets."",'ajax'=>"1",'ICOFLEET'=>"<div id='attack' class='indicator ".$attackActive." tooltip' data-tooltip-content='".$varAttack."'><div class='icoi'></div></div><div id='grab' class='indicator ".$captureActive." tooltip' data-tooltip-content='".$varCaptu."'><div class='icoi'></div></div><div id='destruction' class='indicator ".$unicActive." tooltip' data-tooltip-content='".$LNG['customm_3']."'><div class='icoi'></div></div><div id='espionage' class='indicator ".$spioActive." tooltip' data-tooltip-content='".$varSpied."' href='game.php?page=overview'><div class='icoi'></div></div><div id='rocket' class='indicator ".$rocketActive." tooltip' data-tooltip-content='".$varRocke."'><div class='icoi'></div></div>",'SOUNDATAKS'=>$SOUNDATAKS,'NEWMSG'=>"".$totalUnread."",'FLEET_NOT_OWNER'=>$FleetList,"notification"=>$Notifications);
echo json_encode($arr);

//[array("time"=>1484421640,"texte"=>"« test »","temps"=>12,"type"=>"chuchotement","image"=>"/media/files/avatar_defaut.jpg")]
?>