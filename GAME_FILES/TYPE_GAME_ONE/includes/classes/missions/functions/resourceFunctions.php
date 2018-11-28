<?php

function StoreTheGoods($thisFleet, $planetId)
{
	
	$sql	= 'SELECT metal, crystal, deuterium FROM %%PLANETS%% WHERE id = :planetId;';
	$Default = Database::get()->selectSingle($sql, array(
		':planetId'		=> $planetId
	));	
	
	
	$sql  = 'UPDATE %%PLANETS%% as p, %%USERS%% as u SET
	p.`metal`		= p.`metal` + :metal,
	p.`crystal`		= p.`crystal` + :crystal,
	p.`deuterium` 	= p.`deuterium` + :deuterium,
	u.`darkmatter`	= u.`darkmatter` + :darkmatter
	WHERE p.`id` = :planetId AND u.id = p.id_owner;';
	Database::get()->update($sql, array(
		':metal'		=> $thisFleet['fleet_resource_metal'],
		':crystal'		=> $thisFleet['fleet_resource_crystal'],
		':deuterium'	=> $thisFleet['fleet_resource_deuterium'],
		':darkmatter'	=> $thisFleet['fleet_resource_darkmatter'],
	 	':planetId'		=> $planetId
	));
	
	
	$sql	= 'SELECT metal, crystal, deuterium FROM %%PLANETS%% WHERE id = :planetId;';
	$Updated = Database::get()->selectSingle($sql, array(
		':planetId'		=> $planetId
	));	
	
	if($thisFleet['fleet_resource_metal'] + $thisFleet['fleet_resource_crystal'] + $thisFleet['fleet_resource_deuterium'] + $thisFleet['fleet_resource_darkmatter'] > 0 && $thisFleet['fleet_target_owner'] != 0){
		$sql = "INSERT INTO %%RESLOGS%% SET metalStart = :metalStart, crystalStart = :crystalStart, deuteriumStart = :deuteriumStart, metalDrop = :metalDrop, crystalDrop = :crystalDrop, deuteriumDrop = :deuteriumDrop, metalEnd = :metalEnd, crystalEnd = :crystalEnd, deuteriumEnd = :deuteriumEnd, playerId = :playerId, playerDrop = :playerDrop, planetStart = :planetStart, planetEnd = :planetEnd, missionEnd = :missionEnd, dropTime = :dropTime;";
		database::get()->insert($sql, array(
			':metalStart'		=> $Default['metal'],
			':crystalStart'		=> $Default['crystal'],
			':deuteriumStart'	=> $Default['deuterium'],
			':metalDrop'		=> $thisFleet['fleet_resource_metal'],
			':crystalDrop'		=> $thisFleet['fleet_resource_crystal'],
			':deuteriumDrop'	=> $thisFleet['fleet_resource_deuterium'],
			':metalEnd'			=> $Updated['metal'],
			':crystalEnd'		=> $Updated['crystal'],
			':deuteriumEnd'		=> $Updated['deuterium'],
			':playerId'			=> $thisFleet['fleet_owner'],
			':playerDrop'		=> $thisFleet['fleet_target_owner'],
			':planetStart'		=> $thisFleet['fleet_start_id'],
			':planetEnd'		=> $thisFleet['fleet_end_id'],
			':missionEnd'		=> $planetId,
			':dropTime'			=> TIMESTAMP
		));
	}
	
	$sql  = 'UPDATE %%FLEETS%% SET
	`fleet_resource_metal`		= 0,
	`fleet_resource_crystal`	= 0,
	`fleet_resource_deuterium` 	= 0
	WHERE `fleet_id` = :fleet_id;';
	Database::get()->update($sql, array(
		':fleet_id'		=> $thisFleet['fleet_id']
	));
}
	
function RestoreTheFleet($thisFleet, $planetId)
{
	global $resource;
		
	$PlanetDestination 	= $planetId;
	$fleetData			= FleetFunctions::unserialize($thisFleet['fleet_array']);
	
	
	$sql	= 'SELECT metal, crystal, deuterium FROM %%PLANETS%% WHERE id = :planetId;';
	$Default = Database::get()->selectSingle($sql, array(
		':planetId'		=> $PlanetDestination
	));	
		
	$updateQuery	= array();
	$param	= array(
		':metal'		=> $thisFleet['fleet_resource_metal'],
		':crystal'		=> $thisFleet['fleet_resource_crystal'],
		':deuterium'	=> $thisFleet['fleet_resource_deuterium'],
		':darkmatter'	=> $thisFleet['fleet_resource_darkmatter'],
		':planetId'		=> $PlanetDestination
	);

	foreach ($fleetData as $shipId => $shipAmount)
	{
		$updateQuery[]	= "p.`".$resource[$shipId]."` = p.`".$resource[$shipId]."` + :".$resource[$shipId];
		$param[':'.$resource[$shipId]]	= $shipAmount;
	}

	$sql	= 'UPDATE %%PLANETS%% as p, %%USERS%% as u SET
	'.implode(', ', $updateQuery).',
	p.`metal` = p.`metal` + :metal,
	p.`crystal` = p.`crystal` + :crystal,
	p.`deuterium` = p.`deuterium` + :deuterium,
	u.`darkmatter` = u.`darkmatter` + :darkmatter
	WHERE p.`id` = :planetId AND u.id = p.id_owner;';

	Database::get()->update($sql, $param);
	
	$sql	= 'SELECT metal, crystal, deuterium FROM %%PLANETS%% WHERE id = :planetId;';
	$Updated = Database::get()->selectSingle($sql, array(
		':planetId'		=> $PlanetDestination
	));	
	
	if($thisFleet['fleet_resource_metal'] + $thisFleet['fleet_resource_crystal'] + $thisFleet['fleet_resource_deuterium'] + $thisFleet['fleet_resource_darkmatter'] > 0 && $thisFleet['fleet_target_owner'] != 0 && $thisFleet['fleet_start_planet'] != 21){
		$sql = "INSERT INTO %%RESLOGS%% SET metalStart = :metalStart, crystalStart = :crystalStart, deuteriumStart = :deuteriumStart, metalDrop = :metalDrop, crystalDrop = :crystalDrop, deuteriumDrop = :deuteriumDrop, metalEnd = :metalEnd, crystalEnd = :crystalEnd, deuteriumEnd = :deuteriumEnd, playerId = :playerId, playerDrop = :playerDrop, planetStart = :planetStart, planetEnd = :planetEnd, missionEnd = :missionEnd, dropTime = :dropTime;";
		database::get()->insert($sql, array(
			':metalStart'		=> $Default['metal'],
			':crystalStart'		=> $Default['crystal'],
			':deuteriumStart'	=> $Default['deuterium'],
			':metalDrop'		=> $thisFleet['fleet_resource_metal'],
			':crystalDrop'		=> $thisFleet['fleet_resource_crystal'],
			':deuteriumDrop'	=> $thisFleet['fleet_resource_deuterium'],
			':metalEnd'			=> $Updated['metal'],
			':crystalEnd'		=> $Updated['crystal'],
			':deuteriumEnd'		=> $Updated['deuterium'],
			':playerId'			=> $thisFleet['fleet_owner'],
			':playerDrop'		=> $thisFleet['fleet_target_owner'],
			':planetStart'		=> $thisFleet['fleet_start_id'],
			':planetEnd'		=> $thisFleet['fleet_end_id'],
			':missionEnd'		=> $PlanetDestination,
			':dropTime'			=> TIMESTAMP
		));
	}
		
	KillTheFleet($thisFleet);
	
	return true;
}

function KillTheFleet($thisFleet)
{
	$sql	= 'DELETE %%FLEETS%%, %%FLEETS_EVENT%%
	FROM %%FLEETS%% LEFT JOIN %%FLEETS_EVENT%% on fleet_id = fleetId
	WHERE `fleet_id` = :fleetId';

	Database::get()->delete($sql, array(
		':fleetId'	=> $thisFleet['fleet_id']
	));
}