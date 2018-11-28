<?php

require_once 'includes/classes/cronjob/CronjobTask.interface.php';
class happyHourCronjob implements CronjobTask
{
	
	function randRange($min, $max, $count)
	{
		$range = array();
		$i=0;
		while($i++ < $count){
			while(in_array($num = mt_rand($min, $max), $range)){}
			$range[] = $num;
		}
		return $range;
	}
	
	function run()
	{		
	
		if(config::get(ROOT_UNI)->happyHourTime < TIMESTAMP - 23 * 3600){
			$langObjects	= array();
			$timeToUpdate	= TIMESTAMP;
			$sql	= "SELECT DISTINCT id, lang FROM %%USERS%% WHERE onlinetime > :onlinetime;";
			$totalPremiums = database::get()->select($sql, array(
				':onlinetime'	=> $timeToUpdate - (7 * 24 * 3600),
			));
				
			$selectEvent 	= mt_rand(1,12);
			$message2 		= "";
			$Example1 		= 0;
			$Example2 		= 0;
			$Example3 		= 0;
			switch ($selectEvent) {
				case 1: // peacefull mt rand 2-4
					$bonusChance 	= mt_rand(2,4);
					$messageBonus 	= 'happyhour_3';
					break;
				case 2: // combat mt rand 2-4
					$bonusChance 	= mt_rand(2,4);
					$messageBonus 	= 'happyhour_4';
					break;
				case 3: // ally points mt rand 2-4
					$bonusChance 	= mt_rand(2,4);
					$messageBonus 	= 'happyhour_5';
					break;
				case 4: // find auction items case darkmatter
					$bonusChance 	= 0;
					$messageBonus 	= 'happyhour_6';
					break;
				case 5: // more darkmatter on case darmater 2-5
					$bonusChance 	= mt_rand(2,5);
					$messageBonus 	= 'happyhour_7';
					break;
				case 6: // find arsenal items on asteroids
					$bonusChance 	= 0;
					$messageBonus 	= 'happyhour_8';
					//begin asteroid event
					$galaxy = $this->randRange(1,6,6);
					foreach($galaxy as $Element){
						$system = $this->randRange(1,200,80);
							foreach($system as $System_Element){
								$planets = rand(1,20);
								
								$sql	= "SELECT * FROM %%PLANETS%% WHERE galaxy = :galaxy AND system = :system AND planet = :planet AND universe = :universe;";
								$cautare = database::get()->select($sql, array(
									':galaxy'	=> $Element,
									':system'	=> $System_Element,
									':planet'	=> $planets,
									':universe'	=> 1
								));
								
								if(count($cautare)==0){
									$config	= Config::get(ROOT_UNI);
									$metal_rand = $config->asteroid_metal + round($config->asteroid_metal / 100 * (5*$config->asteroidRound));
									$crystal_rand = $config->asteroid_crystal + round($config->asteroid_crystal / 100 * (5*$config->asteroidRound));
									$deuterium_rand= $config->asteroid_deuterium + round($config->asteroid_deuterium / 100 * (5*$config->asteroidRound));
									
								$sql = "INSERT INTO %%PLANETS%% SET
									name			= :name,
									id_owner		= :id_owner,
									universe		= :universe,
									galaxy			= :galaxy,
									system			= :system,
									planet			= :planet,
									planet_type		= :planet_type,
									image			= :image,
									diameter		= :diameter,
									metal			= :metal,
									crystal			= :crystal,
									deuterium		= :deuterium,
									last_update		= :last_update;";

								database::get()->insert($sql, array(
									':name'				=> 'Asteroid',
									':id_owner'			=> NULL,
									':universe'			=> 1,
									':galaxy'			=> $Element,
									':system'			=> $System_Element,
									':planet'			=> $planets,
									':planet_type'		=> 1,
									':image'			=> 'asteroid',
									':diameter'			=> 9800,
									':metal'			=> $metal_rand,
									':crystal'			=> $crystal_rand,
									':deuterium'		=> $deuterium_rand,
									':last_update'		=> $timeToUpdate
								));
							
								$Example1 = $Element;
								$Example2 = $System_Element;
								$Example3 = $planets;
							}
						}
					}
					$message2 = "ok";
					break;
				case 7: // 2x more chance resource on expe
					$bonusChance 	= 2;
					$messageBonus 	= 'happyhour_9';
					break;
				case 8: // 2x more chance fleets on expe
					$bonusChance 	= 2;
					$messageBonus 	= 'happyhour_10';
					break;
				case 9: // 2x more chance arsenal on expe
					$bonusChance 	= 2;
					$messageBonus 	= 'happyhour_11';
					break;
				case 10: // 2x more chance darkmatter on expe
					$bonusChance 	= 2;
					$messageBonus 	= 'happyhour_12';
					break;
				case 11: // build prime ships
					$bonusChance 	= 0;
					$messageBonus 	= 'happyhour_13';
					break;
				case 12: // 10-30% reduction darkmatter
					$bonusChance 	= mt_rand(10,30);
					$messageBonus 	= 'happyhour_14';
					break;
			}	
			
			foreach($totalPremiums as $userInfo){
				
				if(!isset($langObjects[$userInfo['lang']]))
				{
					$langObjects[$userInfo['lang']]	= new Language($userInfo['lang']);
					$langObjects[$userInfo['lang']]->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
				}
					
				$LNG		= $langObjects[$userInfo['lang']];
				
				$message 	= '<span class="admin">'.sprintf($LNG['happyhour_2'], str_replace(' ', '&nbsp;', _date('H:i:s', $timeToUpdate), $USER['timezone']), str_replace(' ', '&nbsp;', _date('H:i:s', ($timeToUpdate+3600)), $USER['timezone']));
				
				if($selectEvent == 12)
					$message 	.= sprintf($LNG[$messageBonus], $bonusChance, '%').'</span>';	
				else
					$message 	.= sprintf($LNG[$messageBonus], $bonusChance).'</span>';
				
				PlayerUtil::sendMessage($userInfo['id'], '', $LNG['happyhour_1'], 50, $LNG['happyhour_1'], $message, $timeToUpdate);
				if(!empty($message2)){
					$message2 = '<span class="admin">'.sprintf($LNG['custom_asteroid'], $Example1, $Example2, $Example3).'</span>';
					PlayerUtil::sendMessage($userInfo['id'], '', 'Event System', 50, 'Event Info', $message2, $timeToUpdate);
				}
			}
			
			config::get(ROOT_UNI)->happyHourEvent	= $selectEvent;
			config::get(ROOT_UNI)->happyHourTime	= $timeToUpdate;
			config::get(ROOT_UNI)->happyHourBonus	= $bonusChance;
			$sql	= 'UPDATE %%CONFIG%% SET `happyHourEvent` = :happyHourEvent, `happyHourTime` = :happyHourTime, happyHourBonus = :happyHourBonus WHERE `uni` = 1;';
			database::get()->update($sql, array(
				':happyHourEvent'	=> $selectEvent,
				':happyHourBonus'	=> $bonusChance,
				':happyHourTime'	=> $timeToUpdate
			));	
			
			$sql	= 'SELECT hours, nextTime FROM %%CRONJOBS%% WHERE cronjobID = 23;';
			$cronjobInfo = database::get()->selectSingle($sql, array());	
			
			$sql	= 'UPDATE %%CRONJOBS%% SET `hours` = :hours, `nextTime` = :nextTime WHERE `cronjobID` = 23;';
			database::get()->update($sql, array(
				':hours'	=> $cronjobInfo['hours'] == 23 ? 0 : ($cronjobInfo['hours'] + 1),
				':nextTime'	=> $cronjobInfo['nextTime'] + 25*3600,
			));	
		}
		ClearCache();
	}
}