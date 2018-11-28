<?php


function calculateHonorPoints($combatResult, $fleetInfo, $ownerUser, $targetUser, $fleetPointsAttackerHonor, $fleetPointsDefenderHonor, $totalDefenders)
{		
	$attackRecovered = 0;
	$defendRecovered = 0;
	
	if($fleetInfo['fleet_group'] == 0 && $totalDefenders == 1){
		$sql		= "SELECT wapeonry_points, fleet_points, honor_points, honor_rank FROM %%STATPOINTS%% WHERE `universe` = :universe AND id_owner = :id_owner;";
		$militaryAttacker	= database::get()->selectSingle($sql, array(
			':universe'	=> $fleetInfo['fleet_universe'],
			':id_owner'	=> $ownerUser['id']
		));
		
		$sql		= "SELECT wapeonry_points, fleet_points, honor_points, honor_rank FROM %%STATPOINTS%% WHERE `universe` = :universe AND id_owner = :id_owner;";
		$militaryDefender	= database::get()->selectSingle($sql, array(
			':universe'	=> $fleetInfo['fleet_universe'],
			':id_owner'	=> $targetUser['id']
		));
		
		$sql =  "SELECT honor_rank FROM %%STATPOINTS%% ORDER BY honor_rank DESC LIMIT 1;";
		$Lowestrank = database::get()->selectSingle($sql, array(
		), 'total_rank');
		
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
		}elseif($isDefenderBandit == 1 && $AttackerWapeonryPoints /100 * 1 <= $fleetPointsAttackerHonor || ($AttackerWapeonryPoints <= $DefenderWapeonryPoints) && $isDefenderBandit == 0 && $AttackerWapeonryPoints /100 * 1 <= $fleetPointsAttackerHonor || $AttackerWapeonryPoints /100 * 1 <= $fleetPointsAttackerHonor && ($militaryAttacker['wapeonry_points'] + 100) >= $militaryDefender['wapeonry_points']){
			$isAttackerHonorable = 1;
		}elseif(($AttackerWapeonryPoints > $DefenderWapeonryPoints) && $isDefenderBandit == 0 || $AttackerWapeonryPoints /100 * 1 <= $fleetPointsAttackerHonor && $isDefenderBandit == 0){
			$isAttackerHonorable = 0;
		}else{
			$isAttackerHonorable = -1;
		}
		
		if($ownerUser['onlinetime'] < TIMESTAMP - 7*24*3600 || ($targetUser['ally_id'] == $ownerUser['ally_id'] && $targetUser['ally_id'] != 0) || count($isFriend) > 0){
			$isDefenderHonorable = -1;
		}elseif($isAttackerBandit == 1 && $DefenderWapeonryPoints /100 * 1 <= $fleetPointsDefenderHonor || ($DefenderWapeonryPoints <= $AttackerWapeonryPoints) && $isAttackerBandit == 0 && $DefenderWapeonryPoints /100 * 1 <= $fleetPointsDefenderHonor || $DefenderWapeonryPoints /100 * 1 <= $fleetPointsDefenderHonor && ($militaryDefender['wapeonry_points'] + 100) >= $militaryAttacker['wapeonry_points']){
			$isDefenderHonorable = 1;
		}elseif(($DefenderWapeonryPoints > $AttackerWapeonryPoints) && $isAttackerBandit == 0 || $DefenderWapeonryPoints /100 * 1 <= $fleetPointsDefenderHonor && $isAttackerBandit == 0){
			$isDefenderHonorable = 0;
		}else{
			$isDefenderHonorable = -1;
		}
		
		$destroyedUnitsAttackersHonor = pow($combatResult['unitLost']['defender'],0.9) / 5000000;
		$destroyedUnitsDefendersHonor = pow($combatResult['unitLost']['attacker'],0.9) / 5000000;
		
		if($destroyedUnitsAttackersHonor >= 1 && $isAttackerHonorable == 1){
			$attackRecovered = $destroyedUnitsAttackersHonor;
		}elseif($destroyedUnitsAttackersHonor >= 1 && $isAttackerHonorable == 0){
			$attackRecovered = $destroyedUnitsAttackersHonor;
		}elseif($destroyedUnitsAttackersHonor >= 1 && $isAttackerHonorable == -1){
			$attackRecovered = 0;
		}
		
		if($destroyedUnitsDefendersHonor >= 1 && $isDefenderHonorable == 1){
			$defendRecovered = $destroyedUnitsDefendersHonor;
		}elseif($destroyedUnitsDefendersHonor >= 1 && $isDefenderHonorable == 0){
			$defendRecovered = $destroyedUnitsDefendersHonor;
		}elseif($destroyedUnitsDefendersHonor >= 1 && $isDefenderHonorable == -1){
			$defendRecovered = 0;
		}
		
		if(floor($attackRecovered) >= 1 && $isAttackerHonorable == 1){
			$attackRecovered = floor($attackRecovered);
			$sql	= "UPDATE %%USERS%% SET honour_points = honour_points + :honour_points WHERE id = :userId;";
			Database::get()->update($sql, array(
				':honour_points'	=> $attackRecovered,
				':userId'			=> $ownerUser['id']
			));
		}elseif(floor($attackRecovered) >= 1 && $fightIsHonorableAttacker == 0){
			$attackRecovered = floor($attackRecovered * -1);
			$sql	= "UPDATE %%USERS%% SET honour_points = honour_points +:honour_points WHERE id = :userId;";
			Database::get()->update($sql, array(
				':honour_points'	=> $attackRecovered,
				':userId'			=> $ownerUser['id']
			));
		}
		
		if(floor($defendRecovered) >= 1 && $isAttackerHonorable == 1){
			$defendRecovered = floor($defendRecovered);
			$sql	= "UPDATE %%USERS%% SET honour_points = honour_points + :honour_points WHERE id = :userId;";
			Database::get()->update($sql, array(
				':honour_points'	=> $defendRecovered,
				':userId'			=> $targetUser['id']
			));
		}elseif(floor($defendRecovered) >= 1 && $fightIsHonorableAttacker == 0){
			$defendRecovered = floor($defendRecovered * -1);
			$sql	= "UPDATE %%USERS%% SET honour_points = honour_points +:honour_points WHERE id = :userId;";
			Database::get()->update($sql, array(
				':honour_points'	=> $defendRecovered,
				':userId'			=> $targetUser['id']
			));
		}
	}
			
	return array('attackRecovered' => $attackRecovered, 'defendRecovered' => $defendRecovered);
}
	