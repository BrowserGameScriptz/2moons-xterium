<?php

function getLanguageUser($language = NULL, $userID = NULL)
{
	if(is_null($language) && !is_null($userID))
	{
		$sql		= 'SELECT lang FROM %%USERS%% WHERE id = :userId;';
		$language	= Database::get()->selectSingle($sql, array(
			':userId' => $userID
		), 'lang');
	}
	
	$LNG		= new Language($language);
	$LNG->includeData(array('L18N', 'FLEET', 'TECH', 'CUSTOM'));
	return $LNG;
}

function achievementSuccesDaily($ownerUser, $startId){	
	$sql	= "UPDATE %%USERS%% SET achievement_daily_2_succes = achievement_daily_2_succes + 1 WHERE id = :userId;";
	Database::get()->update($sql, array(
		':userId'						=> $ownerUser['id']
	));
	
	$actualWins 			= $ownerUser['achievement_daily_2_succes'] + 1;
	$actualNeeded 			= round(5 * pow(2.40, $ownerUser['achievement_daily_2']));
	$fighter_lvl 			= $ownerUser['achievement_daily_2'] + 1;
	$fighter_reward_am 		= round(100 * pow(1.25, $ownerUser['achievement_daily_2']));
	$fighter_reward_points 	= round(50 * pow(1.30, $ownerUser['achievement_daily_2']));
	$fighter_reward_m7 		= round(382359 * pow(1.40, $ownerUser['achievement_daily_2']));
	$fighter_reward_m19 	= round(32353 * pow(1.40, $ownerUser['achievement_daily_2']));
	$fighter_reward_m32 	= round(47 * pow(1.40, $ownerUser['achievement_daily_2']));
	$fighter_reward_upgrade = round(1 * pow(1.10, $ownerUser['achievement_daily_2']));
	
	if($actualWins >= $actualNeeded){
		$sql	= "UPDATE %%USERS%% SET achievement_daily_2 = achievement_daily_2 + 1, achievement_daily_2_points = achievement_daily_2_points + :achievement_daily_2_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter, arsenal_res901 = arsenal_res901 + :arsenal_res901 WHERE id = :userId;";
		Database::get()->update($sql, array(
			':achievement_daily_2_points'	=> $fighter_reward_points,
			':achievement_point'			=> $fighter_reward_points,
			':antimatter'					=> $fighter_reward_am,
			':arsenal_res901'				=> $fighter_reward_upgrade,
			':userId'						=> $ownerUser['id']
		));
		$sql	= "UPDATE %%PLANETS%% SET m7 = m7 + :m7, m19 = m19 + :m19, m32 = m32 + :m32 WHERE id = :planetId;";
		Database::get()->update($sql, array(
			':m7'		=> $fighter_reward_m7,
			':m19'		=> $fighter_reward_m19,
			':m32'		=> $fighter_reward_m32,
			':planetId'	=> $startId
		));
		
		$LNG		= getLanguageUser(NULL, $ownerUser['id']);
		$msg = '<a href="game.php?page=achievement&amp;group=daily#ach_expedition_day"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_expedition_day.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_51'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a><br><br>'.$LNG['allian_29'].':<br>'.pretty_number($fighter_reward_m7).' М7<br>'.pretty_number($fighter_reward_m19).' М19<br>'.pretty_number($fighter_reward_m32).' М32<br>'.$LNG['achiev_49'].'.';
		PlayerUtil::sendMessage($ownerUser['id'], 0, 'System', 4, 'Achievements', $msg, TIMESTAMP);
	}
}

function achievementSuccesVaria($ownerUser){	
	$sql	= "UPDATE %%USERS%% SET achievement_varia_5_success = achievement_varia_5_success + 1 WHERE id = :userId;";
	Database::get()->update($sql, array(
		':userId'	=> $ownerUser['id']
	));
	$actualWins 			= $ownerUser['achievement_varia_5_success'] + 1;
	$actualNeeded 			= round(10 * pow(1.40, $ownerUser['achievement_varia_5']));
	$fighter_lvl 			= $ownerUser['achievement_varia_5'] + 1;
	$fighter_reward_am 		= round(150 * pow(1.08, $ownerUser['achievement_varia_5']));
	$fighter_reward_points 	= round(50 * pow(1.08, $ownerUser['achievement_varia_5']));
	
	if($actualWins >= $actualNeeded){
		$sql	= "UPDATE %%USERS%% SET achievement_varia_5 = achievement_varia_5 + 1, achievement_varia_5_points = achievement_varia_5_points + :achievement_varia_5_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
		Database::get()->update($sql, array(
			':achievement_varia_5_points'	=> $fighter_reward_points,
			':achievement_point'			=> $fighter_reward_points,
			':antimatter'					=> $fighter_reward_am,
			':userId'						=> $ownerUser['id']
		));
		
		$LNG		= getLanguageUser(NULL, $ownerUser['id']);
		$msg = '<a href="game.php?page=achievement&amp;group=varia#ach_expedition"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_expedition.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_149'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a>';
		PlayerUtil::sendMessage($ownerUser['id'], 0, 'System', 4, 'Achievements', $msg, TIMESTAMP);
	}
}

function achievementDarkmatter($ownerUser, $FindableDarkmatter){			
	$sql	= "UPDATE %%USERS%% SET achievement_varia_6_success = achievement_varia_6_success + :achievement_varia_6_success WHERE id = :userId;";
	Database::get()->update($sql, array(
		':achievement_varia_6_success'	=> $FindableDarkmatter,
		':userId'						=> $ownerUser['id']
	));
	$actualWins				= $ownerUser['achievement_varia_6_success'] + $FindableDarkmatter;
	$actualNeeded 			= round(50000 * pow(1.11, $ownerUser['achievement_varia_6']));
	$fighter_lvl 			= $ownerUser['achievement_varia_6'] + 1;
	$fighter_reward_am 		= round(33 * pow(1.0373, $ownerUser['achievement_varia_6']));
	$fighter_reward_points 	= round(20 * pow(1.030, $ownerUser['achievement_varia_6']));
	
	if($actualWins >= $actualNeeded){
		$sql	= "UPDATE %%USERS%% SET achievement_varia_6 = achievement_varia_6 + 1, achievement_varia_6_points = achievement_varia_6_points + :achievement_varia_6_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter, achievement_varia_6_success = 0 WHERE id = :userId;";
		Database::get()->update($sql, array(
			':achievement_varia_6_points'	=> $fighter_reward_points,
			':achievement_point'			=> $fighter_reward_points,
			':antimatter'					=> $fighter_reward_am,
			':userId'						=> $ownerUser['id']
		));
		
		$LNG		= getLanguageUser(NULL,$ownerUser['id']);
		
		$msg = '<a href="game.php?page=achievement&amp;group=varia#ach_found_tm"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_found_tm.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_150'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a>';
		
		PlayerUtil::sendMessage($ownerUser['id'], 0, 'System', 4, 'Achievements', $msg, TIMESTAMP);
	}
	
	$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
	$newUserInfoQuery = Database::get()->selectSingle($sql, array(
		':userId'	=> $ownerUser['id']
	));
	
	if($newUserInfoQuery['achievement_varia_6_success'] >= round(50000 * pow(1.11, $newUserInfoQuery['achievement_varia_6'])))
		$this->achievementDarkmatter($newUserInfoQuery, 0);
	
	
}

function achievementSuccesArsenal($ownerUser, $premium_expe_bonus, $fleetPoints){			
	$arsenalLight	= array('arsenal_combustion', 'arsenal_slight', 'arsenal_res901', 'arsenal_dlight', 'arsenal_conveyor1', 'arsenal_laser', 'arsenal_ion');
	$arsenalMediu	= array('arsenal_impulse', 'arsenal_smedium', 'arsenal_res902', 'arsenal_dmedium', 'arsenal_conveyor2', 'arsenal_plasma');
	$arsenalHeavy	= array('arsenal_hyperspace', 'arsenal_sheavy', 'arsenal_res903', 'arsenal_dheavy', 'arsenal_conveyor3', 'arsenal_gravity');
	$LNG			= getLanguageUser(NULL,$ownerUser['id']);		
	if($fleetPoints >= 235000){
		//all type of arsenal 3 %- 2% - 1%
		$selectTypeLight 	= mt_rand(0,6);
		$selectTypeMedium	= mt_rand(0,5);
		$selectTypeHeavy	= mt_rand(0,5);
		$chanceTypeLight 	= 24;
		$chanceTypeMedium 	= 16;
		$chanceTypeHeavy 	= 8;
		$chanceHaveLight 	= mt_rand(0,100);
		$chanceHaveMedium 	= mt_rand(0,100);
		$chanceHaveHeavy 	= mt_rand(0,100);
		$Message			= "";
		$factor				= 0;
		if($chanceTypeLight >= $chanceHaveLight){
			$factor		= 1;
			$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
			$Message	= sprintf($LNG[$arsenalLight[$selectTypeLight]], $factor);
			$sql	= "UPDATE %%USERS%% SET ".$arsenalLight[$selectTypeLight]." = ".$arsenalLight[$selectTypeLight]." + :factor WHERE id = :userId;";
			Database::get()->update($sql, array(
				':factor'	=> $factor,
				':userId'	=> $ownerUser['id']
			));
			expeEventPoints($ownerUser['fleet_owner'], 1*$factor);
		}elseif($chanceTypeMedium >= $chanceHaveMedium){
			$factor		= 1;
			$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
			$Message	= sprintf($LNG[$arsenalMediu[$selectTypeMedium]], $factor);
			$sql	= "UPDATE %%USERS%% SET ".$arsenalMediu[$selectTypeMedium]." = ".$arsenalMediu[$selectTypeMedium]." + :factor WHERE id = :userId;";
			Database::get()->update($sql, array(
				':factor'	=> $factor,
				':userId'	=> $ownerUser['id']
			));
			expeEventPoints($ownerUser['fleet_owner'], 2*$factor);
		}elseif($chanceTypeHeavy >= $chanceHaveHeavy){
			$factor		= 1;
			$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
			$Message	= sprintf($LNG[$arsenalHeavy[$selectTypeHeavy]], $factor);
			$sql	= "UPDATE %%USERS%% SET ".$arsenalHeavy[$selectTypeHeavy]." = ".$arsenalHeavy[$selectTypeHeavy]." + :factor WHERE id = :userId;";
			Database::get()->update($sql, array(
				':factor'	=> $factor,
				':userId'	=> $ownerUser['id']
			));
			expeEventPoints($ownerUser['fleet_owner'], 3*$factor);
		}
	}elseif($fleetPoints >= 165000 && $fleetPoints < 235000){
		//low or mediun arsenal 3% 2%
		$selectTypeLight 	= mt_rand(0,6);
		$selectTypeMedium	= mt_rand(0,5);
		$chanceTypeLight 	= 24;
		$chanceTypeMedium 	= 16;
		$chanceHaveLight 	= mt_rand(0,100);
		$chanceHaveMedium 	= mt_rand(0,100);
		
		if($chanceTypeLight >= $chanceHaveLight){
			$factor		= 1;
			$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
			$Message	= sprintf($LNG[$arsenalLight[$selectTypeLight]], $factor);
			$sql	= "UPDATE %%USERS%% SET ".$arsenalLight[$selectTypeLight]." = ".$arsenalLight[$selectTypeLight]." + :factor WHERE id = :userId;";
			Database::get()->update($sql, array(
				':factor'	=> $factor,
				':userId'	=> $ownerUser['id']
			));
			expeEventPoints($ownerUser['fleet_owner'], 1*$factor);
		}elseif($chanceTypeMedium >= $chanceHaveMedium){
			$factor		= 1;
			$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
			$Message	= sprintf($LNG[$arsenalMediu[$selectTypeMedium]], $factor);
			$sql	= "UPDATE %%USERS%% SET ".$arsenalMediu[$selectTypeMedium]." = ".$arsenalMediu[$selectTypeMedium]." + :factor WHERE id = :userId;";
			Database::get()->update($sql, array(
				':factor'	=> $factor,
				':userId'	=> $ownerUser['id']
			));
			expeEventPoints($ownerUser['fleet_owner'], 2*$factor);
		}
	}elseif($fleetPoints > 100000 && $fleetPoints < 165000){
		//low arsenal 3%
		$selectTypeLight 	= mt_rand(0,6);
		$chanceType 		= 24;
		$chanceHave 		= mt_rand(0,100);
		if($chanceType >= $chanceHave){
			$factor		= 1;
			$factor		= floor($factor + ($factor / 100 * $premium_expe_bonus));
			$Message	= sprintf($LNG[$arsenalLight[$selectTypeLight]], $factor);
			$sql	= "UPDATE %%USERS%% SET ".$arsenalLight[$selectTypeLight]." = ".$arsenalLight[$selectTypeLight]." + :factor WHERE id = :userId;";
			Database::get()->update($sql, array(
				':factor'	=> $factor,
				':userId'	=> $ownerUser['id']
			));
			expeEventPoints($ownerUser['fleet_owner'], 1*$factor);
		}
	}
	
	if(!empty($Message)){
		PlayerUtil::sendMessage($ownerUser['id'], 0, $LNG['sys_mess_tower'], 15, $LNG['sys_expe_report'], $Message, TIMESTAMP);
		tournement($ownerUser['id'], 8, $factor);
	}
}

function achievementMoonCreate($ownerUser){
	$sql	= "UPDATE %%USERS%% SET achievement_varia_3_success = achievement_varia_3_success + 1 WHERE id = :userId;";
	database::get()->update($sql, array(
		':userId'	=> $ownerUser['id']
	));
			
	$actualWins 		=  $ownerUser['achievement_varia_3_success'] + 1;
	$actualNeeded 		=  round(3 * pow(1.30, $ownerUser['achievement_varia_3']));
	$fighter_lvl 		=  $ownerUser['achievement_varia_3'] + 1;
	$fighter_reward_am 	= floor(200 * pow(1.10, $ownerUser['achievement_varia_3']));
	$fighter_reward_points = floor(100 * pow(1.10, $ownerUser['achievement_varia_3']));
	if($actualWins == $actualNeeded){
		$sql	= "UPDATE %%USERS%% SET achievement_varia_3 = achievement_varia_3 + 1, achievement_varia_3_success = 0, achievement_varia_3_points = achievement_varia_3_points + :achievement_varia_3_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
		database::get()->update($sql, array(
			':achievement_varia_3_points'	=> $fighter_reward_points,
			':achievement_point'			=> $fighter_reward_points,
			':antimatter'					=> $fighter_reward_am,
			':userId'						=> $ownerUser['id']
		));
		$LNG			= getLanguageUser(NULL,$ownerUser['id']);
		$msg = '<a href="game.php?page=achievement&amp;group=varia#ach_creation_moons"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_creation_moons.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_147'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a>';
		PlayerUtil::sendMessage($ownerUser['id'], 0, 'System', 4, 'Achievements', $msg, TIMESTAMP);
	}
}

function achievementMoonDestroy($ownerUser){
	$sql	= "UPDATE %%USERS%% SET achievement_varia_2_success = achievement_varia_2_success + 1 WHERE id = :userId;";
	database::get()->update($sql, array(
		':userId'	=> $ownerUser['id']
	));
						
	$actualWins 		=  $ownerUser['achievement_varia_2_success'] + 1;
	$actualNeeded 		=  round(3 * pow(1.30, $ownerUser['achievement_varia_2']));
	$fighter_lvl 		=  $ownerUser['achievement_varia_2'] + 1;
	$fighter_reward_am 	= floor(500 * pow(1.10, $ownerUser['achievement_varia_2']));
	$fighter_reward_points = floor(250 * pow(1.10, $ownerUser['achievement_varia_2']));
	if($actualWins == $actualNeeded){
		$sql	= "UPDATE %%USERS%% SET achievement_varia_2 = achievement_varia_2 + 1, achievement_varia_2_success = 0, achievement_varia_2_points = achievement_varia_2_points + :achievement_varia_2_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
		database::get()->update($sql, array(
			':achievement_varia_2_points'	=> $fighter_reward_points,
			':achievement_point'			=> $fighter_reward_points,
			':antimatter'					=> $fighter_reward_am,
			':userId'						=> $ownerUser['id']
		));
		$LNG			= getLanguageUser(NULL,$ownerUser['id']);
		$msg = '<a href="game.php?page=achievement&amp;group=varia#ach_destroyer_moons"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_destroyer_moons.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_146'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a>';
		PlayerUtil::sendMessage($ownerUser['id'], '', 'System', 4, 'Achievements', $msg, TIMESTAMP);
	}
}

function succesAlliancePoints($ownerUser, $targetUser, $combatResult){
	$alliance_points_attacker 	= round(($combatResult['debris']['defender'][901] + $combatResult['debris']['defender'][902]) / 100000000);
	$alliance_points_defender 	= round(($combatResult['debris']['attacker'][901] + $combatResult['debris']['attacker'][902]) / 100000000);
	$maximum_points_attacker 	= 0;
	$maximum_points_defender 	= 0;
			
	$MaxAlliancePoints = 500 + (500 / 100 * config::get(ROOT_UNI)->allianceDevelopBOnus);
	if(config::get(ROOT_UNI)->happyHourEvent == 3 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
		$MaximumCombat = $MaxAlliancePoints * config::get()->happyHourBonus;
		
	if($alliance_points_attacker >= $MaxAlliancePoints){
		$maximum_points_attacker = round($MaxAlliancePoints);
	}else{
		$maximum_points_attacker = round($alliance_points_attacker);
	}
			
	if($alliance_points_defender >= $MaxAlliancePoints){
		$maximum_points_defender = round($MaxAlliancePoints);
	}else{
		$maximum_points_defender = round($alliance_points_defender);
	}
	
	if($maximum_points_attacker > 0){
		$sql	= "UPDATE %%ALLIANCE%% SET total_alliance_points = total_alliance_points + :total_alliance_points, allianceEvent = allianceEvent + :total_alliance_points WHERE id = :allianceId;";
		database::get()->update($sql, array(
			':total_alliance_points'	=> $maximum_points_attacker,
			':allianceId'				=> $ownerUser['ally_id']
		));
		$msg = 'You won alliance points. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($maximum_points_attacker).'</span> alliance points have been credited to your alliance.';
		PlayerUtil::sendMessage($ownerUser['id'], 0, 'Alliance development points', 4, 'You won alliance points', $msg, TIMESTAMP);
	}		
	
	if($maximum_points_defender > 0){
		$sql	= "UPDATE %%ALLIANCE%% SET total_alliance_points = total_alliance_points + :total_alliance_points, allianceEvent = allianceEvent + :total_alliance_points WHERE id = :allianceId;";
		database::get()->update($sql, array(
			':total_alliance_points'	=> $maximum_points_defender,
			':allianceId'				=> $targetUser['ally_id']
		));
		$msg = 'You won alliance points. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($maximum_points_defender).'</span> alliance points have been credited to your alliance.';
		PlayerUtil::sendMessage($targetUser['id'], 0, 'Alliance development points', 4, 'You won alliance points', $msg, TIMESTAMP);
	}
}

function succesDailyAchievement($userID, $ownerUser, $targetUser, $combatResult, $i){
	$sql		= "SELECT MAX(total_points) as total FROM %%STATPOINTS%% WHERE `stat_type` = 1 AND `universe` = 1 AND id_owner = :id_owner;";
	$topPoints	= database::get()->selectSingle($sql, array(
		':id_owner'	=> $userID
	), 'total');

	if(500000000 < $topPoints)
		$maxFactorDestroy		= 120000000000;
	elseif(200000000 < $topPoints && 50000000 >= $topPoints)
		$maxFactorDestroy		= 60000000000;
	elseif(50000000 < $topPoints && 200000000 >= $topPoints)
		$maxFactorDestroy		= 30000000000;
	else
		$maxFactorDestroy		= 15000000000;
	
	$result = false;
	if($i == 1 && $combatResult['won'] == 'a'){			
		if(($combatResult['unitLost']['defender'] >= $maxFactorDestroy && $ownerUser['ally_id'] != $targetUser['ally_id']) || ($combatResult['unitLost']['defender'] >= $maxFactorDestroy && $ownerUser['ally_id'] == 0 && $targetUser['ally_id'] == 0)){
			$sql	= "UPDATE %%USERS%% SET achievement_daily_1_succes = achievement_daily_1_succes + 1 WHERE id = :userId;";
			database::get()->update($sql, array(
				':userId'	=> $userID
			));
			
			$actualWins 			= $ownerUser['achievement_daily_1_succes'] + 1;
			$actualNeeded 			= round(5 * pow(2.40, $ownerUser['achievement_daily_1']));
			$fighter_lvl 			= $ownerUser['achievement_daily_1'] + 1;
			$fighter_reward_am 		= round(150 * pow(1.20, $ownerUser['achievement_daily_1']));
			$fighter_reward_points 	= round(75 * pow(1.25, $ownerUser['achievement_daily_1']));
			$fighter_reward_m7 		= round(11393924 * pow(1.30, $ownerUser['achievement_daily_1']));
			$fighter_reward_m19 	= round(569696 * pow(1.30, $ownerUser['achievement_daily_1']));
			$fighter_reward_m32 	= round(1470 * pow(1.30, $ownerUser['achievement_daily_1']));
			$fighter_reward_upgrade = round(2 * pow(1.10, $ownerUser['achievement_daily_1']));
			if($actualWins >= $actualNeeded){ 
				$sql	= "UPDATE %%USERS%% SET achievement_daily_1 = achievement_daily_1 + :achievement_daily_1, achievement_daily_1_points = achievement_daily_1_points + :achievement_daily_1_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter, arsenal_res901 = arsenal_res901 + :arsenal_res901 WHERE id = :userId;";
				database::get()->update($sql, array(
					':achievement_daily_1'			=> 1,
					':achievement_daily_1_points'	=> $fighter_reward_points,
					':achievement_point'			=> $fighter_reward_points,
					':antimatter'					=> $fighter_reward_am,
					':arsenal_res901'				=> $fighter_reward_upgrade,
					':userId'						=> $userID
				));
				$sql	= "UPDATE %%PLANETS%% SET m7 = m7 + :m7, m19 = m19 + :m19, m32 = m32 + :m32 WHERE id = :planetId;";
				database::get()->update($sql, array(
					':m7'		=> $fighter_reward_m7,
					':m19'		=> $fighter_reward_m19,
					':m32'		=> $fighter_reward_m32,
					':planetId'	=> $ownerUser['id_planet']
				));
				$LNG		= getLanguageUser(NULL, $userID);
				$msg = '<a href="game.php?page=achievement&amp;group=daily#ach_wons_day"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_wons_day.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_47'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a><br><br>'.$LNG['allian_29'].':<br>'.pretty_number($fighter_reward_m7).' M7<br>'.pretty_number($fighter_reward_m19).' M19<br>'.pretty_number($fighter_reward_m32).' M32.';;
				PlayerUtil::sendMessage($userID, 0, 'System', 4, 'Achievements', $msg, TIMESTAMP);
			}
			$result = true;
		}
	}elseif($i == 2 && $combatResult['won'] == 'r'){			
		if(($combatResult['unitLost']['attacker'] >= $maxFactorDestroy && $ownerUser['ally_id'] != $targetUser['ally_id']) || ($combatResult['unitLost']['attacker'] >= $maxFactorDestroy && $ownerUser['ally_id'] == 0 && $targetUser['ally_id'] == 0)){
			$sql	= "UPDATE %%USERS%% SET achievement_daily_1_succes = achievement_daily_1_succes + 1 WHERE id = :userId;";
			database::get()->update($sql, array(
				':userId'	=> $userID
			));
			
			$actualWins 			= $targetUser['achievement_daily_1_succes'] + 1;
			$actualNeeded 			= round(5 * pow(2.40, $targetUser['achievement_daily_1']));
			$fighter_lvl 			= $targetUser['achievement_daily_1'] + 1;
			$fighter_reward_am 		= round(150 * pow(1.20, $targetUser['achievement_daily_1']));
			$fighter_reward_points 	= round(75 * pow(1.25, $targetUser['achievement_daily_1']));
			$fighter_reward_m7 		= round(11393924 * pow(1.30, $targetUser['achievement_daily_1']));
			$fighter_reward_m19 	= round(569696 * pow(1.30, $targetUser['achievement_daily_1']));
			$fighter_reward_m32 	= round(1470 * pow(1.30, $targetUser['achievement_daily_1']));
			$fighter_reward_upgrade = round(2 * pow(1.10, $targetUser['achievement_daily_1']));
			if($actualWins >= $actualNeeded){
				$sql	= "UPDATE %%USERS%% SET achievement_daily_1 = achievement_daily_1 + :achievement_daily_1, achievement_daily_1_points = achievement_daily_1_points + :achievement_daily_1_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter, arsenal_res901 = arsenal_res901 + :arsenal_res901 WHERE id = :userId;";
				database::get()->update($sql, array(
					':achievement_daily_1'			=> 1,
					':achievement_daily_1_points'	=> $fighter_reward_points,
					':achievement_point'			=> $fighter_reward_points,
					':antimatter'					=> $fighter_reward_am,
					':arsenal_res901'				=> $fighter_reward_upgrade,
					':userId'						=> $userID
				));
				$sql	= "UPDATE %%PLANETS%% SET m7 = m7 + :m7, m19 = m19 + :m19, m32 = m32 + :m32 WHERE id = :planetId;";
				database::get()->update($sql, array(
					':m7'		=> $fighter_reward_m7,
					':m19'		=> $fighter_reward_m19,
					':m32'		=> $fighter_reward_m32,
					':planetId'	=> $targetUser['id_planet']
				));
				$LNG		= getLanguageUser(NULL, $userID);
				$msg = '<a href="game.php?page=achievement&amp;group=daily#ach_wons_day"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_wons_day.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_47'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a><br><br>'.$LNG['allian_29'].':<br>'.pretty_number($fighter_reward_m7).' M7<br>'.pretty_number($fighter_reward_m19).' M19<br>'.pretty_number($fighter_reward_m32).' M32.';
				PlayerUtil::sendMessage($userID, 0, 'System', 4, 'Achievements', $msg, TIMESTAMP);
			}
		}
		$result = true;
	}
	return $result;
}

function succesFighterAchievement($userID, $ownerUser, $targetUser, $combatResult, $i, $attackClass){
	$result = false;
	if($attackClass == 'green' && $targetUser['onlinetime'] > TIMESTAMP - 7 * 24 * 3600 && $combatResult['lastRound'] >= 1 && $i == 1){
		$sql	= "UPDATE %%USERS%% SET achievement_varia_1_success = achievement_varia_1_success + 1 WHERE id = :userId;";
		database::get()->update($sql, array(
			':userId'	=> $userID
		));
		
		$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$userUpdated = database::get()->selectSingle($sql, array(
			':userId'	=> $userID
		));
		
		$actualWins 			= $userUpdated['achievement_varia_1_success'];
		$actualNeeded 			= round(50 * pow(1.905, $userUpdated['achievement_varia_1']));
		$fighter_lvl 			= $userUpdated['achievement_varia_1'];
		$fighter_reward_am 		= floor(300 * pow(1.05, $userUpdated['achievement_varia_1']));
		$fighter_reward_points 	= floor(150 * pow(1.05, $userUpdated['achievement_varia_1']));
		if($actualWins >= $actualNeeded){
			$sql	= "UPDATE %%USERS%% SET achievement_varia_1 = achievement_varia_1 + 1, achievement_varia_1_points = achievement_varia_1_points + :achievement_varia_1_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_varia_1_points'	=> $fighter_reward_points,
				':achievement_point'			=> $fighter_reward_points,
				':antimatter'					=> $fighter_reward_am, 
				':userId'						=> $userID
			));
			$LNG		= getLanguageUser(NULL, $userID);
			
			$msg = '<a href="game.php?page=achievement&amp;group=varia#ach_wons"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_wons.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_145'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($userID, 0, 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		$result = true;
	}elseif($attackClass == 'red' && $combatResult['lastRound'] >= 1 && $i == 2){
		$sql	= "UPDATE %%USERS%% SET achievement_varia_1_success = achievement_varia_1_success + 1 WHERE id = :userId;";
		database::get()->update($sql, array(
			':userId'	=> $userID
		));
		
		$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$userUpdated = database::get()->selectSingle($sql, array(
			':userId'	=> $userID
		));
		
		$actualWins 			= $userUpdated['achievement_varia_1_success'] + 1;
		$actualNeeded 			= round(50 * pow(1.905, $userUpdated['achievement_varia_1']));
		$fighter_lvl 			= $userUpdated['achievement_varia_1'] + 1;
		$fighter_reward_am 		= floor(300 * pow(1.05, $userUpdated['achievement_varia_1']));
		$fighter_reward_points 	= floor(150 * pow(1.05, $userUpdated['achievement_varia_1']));
		if($actualWins >= $actualNeeded){
			$sql	= "UPDATE %%USERS%% SET achievement_varia_1 = achievement_varia_1 + 1, achievement_varia_1_points = achievement_varia_1_points + :achievement_varia_1_points, achievement_point = achievement_point + :achievement_point, antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':achievement_varia_1_points'	=> $fighter_reward_points,
				':achievement_point'			=> $fighter_reward_points,
				':antimatter'					=> $fighter_reward_am,
				':userId'						=> $userID
			));
			$LNG		= getLanguageUser(NULL, $userID);
			
			$msg = '<a href="game.php?page=achievement&amp;group=varia#ach_wons"><img alt="" style="float:left; width:60px; margin-right:6px;" src="styles/images/achiev/ach_wons.png">'.$LNG['achiev_25'].': <span class="achiev_mes_head">'.sprintf($LNG['achiev_145'], pretty_number($fighter_lvl)).'</span><br> '.$LNG['achiev_26'].':<br> '.pretty_number($fighter_reward_am).' '.$LNG['tech'][922].' <br> '.pretty_number($fighter_reward_points).' '.$LNG['achiev_13'].'</a>';
			PlayerUtil::sendMessage($userID, 0, 'System', 4, 'Achievements', $msg, TIMESTAMP);
		}
		$result = true;
	}
	return $result;
}

function achievementSuccesCombat($ownerUser, $combatResult){
	$premium_combate 				= 0;		
	$maximum_points 				= 0;
	$admin_battle_exp 				= 1;
	$MaximumCombat 					= 25000;
	
	$ally_fraction_combat_exp_expe = 0;
	if($ownerUser['ally_id'] != 0){
		$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
		$ALLIANCE = Database::get()->selectSingle($sql, array(
			':allyID'	=> $ownerUser['ally_id']
		));
		if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
			$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
			$FRACTIONS = Database::get()->selectSingle($sql, array(
				':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
			));
			$ally_fraction_combat_exp_expe = $FRACTIONS['ally_fraction_combat_exp_expe'] * $ALLIANCE['ally_fraction_level'];
		}
	}
	
	if($ownerUser['prem_batle_leveling'] > 0 && $ownerUser['prem_batle_leveling_days'] > TIMESTAMP){		
		$premium_combate = $ownerUser['prem_batle_leveling'];		
	}
	
	if(config::get(ROOT_UNI)->happyHourEvent == 2 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
		$MaximumCombat += 25000 / 100 * config::get()->happyHourBonus;
	
	$MaximumCombat += 25000 / 100 * $ally_fraction_combat_exp_expe;
	$MaximumCombat += 25000 / 100 * $premium_combate;
	$MaximumCombat += 25000 / 100 * config::get(ROOT_UNI)->combatExp;
			
	$combat_points = ($combatResult['debris']['defender'][901] + $combatResult['debris']['defender'][902]) / ((1000000 * $ownerUser['combat_exp_level']) + (1000000 * max(1,($ownerUser['combat_exp_level']-1))));
	
	if($combat_points >= $MaximumCombat){
		$maximum_points = $MaximumCombat;
	}else{
		$maximum_points = $combat_points;
	}
	
	if($maximum_points >= 1){
		$sql	= "UPDATE %%USERS%% SET combat_exp_current = combat_exp_current + :combat_exp_current WHERE id = :userId;";
		database::get()->update($sql, array(
			':combat_exp_current'	=> round($maximum_points),
			':userId'				=> $ownerUser['id']
		));
		tournement($userID, 11, round($maximum_points));
	}
	return round($maximum_points);
}

function calculateCombatExp($userID, $totalAttackers, $totalDefenders, $combatResult, $ownerUser, $targetUser, $i){
	$sql	= 'SELECT * FROM %%USERS%% WHERE id = :fleetOwnId;';
	$search_b = database::get()->selectSingle($sql, array(
		':fleetOwnId'	=> $userID
	));
	$premium_combate 				= 0;	
	$maximum_points 				= 0;
	$totalDevider 					= 0;
	$admin_battle_exp 				= 1;
		
	if($search_b['prem_batle_leveling'] > 0 && $search_b['prem_batle_leveling_days'] > TIMESTAMP){		
		$premium_combate = $search_b['prem_batle_leveling'];		
	} 

	if(config::get(ROOT_UNI)->combatExp > 0){
		$admin_battle_exp = config::get(ROOT_UNI)->combatExp;	
	}
		
	if($i == 1){
		$totalDevider	= $totalAttackers;	
		$combat_points  = ($combatResult['debris']['defender'][901] + $combatResult['debris']['defender'][902]) / ((1000000 * $search_b['combat_exp_level']) + (1000000 * max(1,($search_b['combat_exp_level']-1))));
	}elseif($i == 2){
		$totalDevider   = $totalDefenders;
		$combat_points  = ($combatResult['debris']['attacker'][901] + $combatResult['debris']['attacker'][902]) / ((1000000 * $search_b['combat_exp_level']) + (1000000 * max(1,($search_b['combat_exp_level']-1))));
	}
		
	$MaximumCombat = 50000;
	
	$ally_fraction_combat_exp_pla = 0;
	if($ownerUser['ally_id'] != 0){
		$sql	= 'SELECT * FROM %%ALLIANCE%% WHERE id = :allyID;';
		$ALLIANCE = Database::get()->selectSingle($sql, array(
			':allyID'	=> $ownerUser['ally_id']
		));
		if($ALLIANCE['ally_fraction_id'] != 0 && $ALLIANCE['ally_fraction_level'] != 0){
			$sql	= 'SELECT * FROM %%ALLIANCEFRACTIONS%% WHERE ally_fraction_id = :ally_fraction_id;';
			$FRACTIONS = Database::get()->selectSingle($sql, array(
				':ally_fraction_id'	=> $ALLIANCE['ally_fraction_id']
			));
			$ally_fraction_combat_exp_pla = $FRACTIONS['ally_fraction_combat_exp_pla'] * $ALLIANCE['ally_fraction_level'];
		}
	}
	
	if($ownerUser['prem_batle_leveling'] > 0 && $ownerUser['prem_batle_leveling_days'] > TIMESTAMP){		
		$premium_combate = $ownerUser['prem_batle_leveling'];		
	}
	
	if(config::get(ROOT_UNI)->happyHourEvent == 2 && config::get(ROOT_UNI)->happyHourTime < TIMESTAMP && (config::get(ROOT_UNI)->happyHourTime + 3600) > TIMESTAMP)
		$MaximumCombat += 50000 / 100 * config::get()->happyHourBonus;
	
	$MaximumCombat += 50000 / 100 * $ally_fraction_combat_exp_expe;
	$MaximumCombat += 50000 / 100 * $premium_combate;
	$MaximumCombat += 50000 / 100 * config::get(ROOT_UNI)->combatExp;
	
		
	if(($combat_points >= $MaximumCombat && $ownerUser['ally_id'] != $targetUser['ally_id']) || $combat_points >= $MaximumCombat && $ownerUser['ally_id'] == 0 && $targetUser['ally_id'] == 0 || $combat_points >= $MaximumCombat && $ownerUser['ally_id'] == $targetUser['ally_id'] && $ownerUser['ally_id'] == 1){
		$maximum_points = $MaximumCombat;
		$maximum_points /= $totalDevider;		
	}elseif(($combat_points < $MaximumCombat && $ownerUser['ally_id'] != $targetUser['ally_id']) || $combat_points < $MaximumCombat && $ownerUser['ally_id'] == 0 && $targetUser['ally_id'] == 0 || $combat_points < $MaximumCombat && $ownerUser['ally_id'] == $targetUser['ally_id'] && $ownerUser['ally_id'] == 1){
		$maximum_points = $combat_points;
		$maximum_points /= $totalDevider;
	}
		
	if(round($maximum_points) >= 1){
		$sql	= "UPDATE %%USERS%% SET combat_exp_current = combat_exp_current + :combat_exp_current WHERE id = :userId;";
		database::get()->update($sql, array(
			':combat_exp_current'	=> round($maximum_points),
			':userId'				=> $userID
		));
		tournement($userID, 11, round($maximum_points));	
		$sql	= 'SELECT * FROM %%USERS%% WHERE id = :fleetOwnId;';
		$search_b = database::get()->selectSingle($sql, array(
			':fleetOwnId'	=> $userID
		));
		$new_combat_experience 		=  $search_b['combat_exp_current'] - $search_b['combat_exp_max']; // 10700-10700 = 0
		$new_combat_experience_max 	=  floor(10700 * pow(1.15,$search_b['combat_exp_level']+1));
			
		if ($search_b['combat_exp_current'] >= $search_b['combat_exp_max']){
			$sql	= "UPDATE %%USERS%% SET combat_exp_level = combat_exp_level + 1, combat_exp_current = :combat_exp_current, combat_exp_max = :combat_exp_max WHERE id = :userId;";
			database::get()->update($sql, array(
				':combat_exp_current'	=> $new_combat_experience,
				':combat_exp_max'		=> $new_combat_experience_max,
				':userId'				=> $userID
			));	
		}
	}
	return round($maximum_points);
}