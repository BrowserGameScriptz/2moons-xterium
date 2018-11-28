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

class ShowBonusPage extends AbstractGamePage
{
	public static $requireModule = 0;

	function __construct()
	{
		parent::__construct();
	}
	
	function entryreward(){
		
		global $USER, $LNG, $USETT, $PLANET, $resource;
		
		$this->setWindow('popup');
		$this->initTemplate();
		$this->assign(array(
			
		));
		
		$this->display('page.entryreward.default.tpl');
	}
	
	function gift()
	{
	global $USER, $LNG;
	
	$giftId = HTTP::_GP('gift', 1);
	$config	= Config::get($USER['universe']);
	if($config->new_year_status == 1){
	switch($giftId){
		case '1':
			if($USER['newyear_gift_1'] > 0){
				$USER['antimatter'] += 50;
				$db = Database::get();
				$sql =  "UPDATE %%USERS%% SET newyear_gift_1 = newyear_gift_1 - :newyear_gift_1 WHERE id = :userID;";
				$db->update($sql, array(
				':newyear_gift_1'			=> 1,
				':userID'			=> $USER['id']
				));	
				$this->printMessage($LNG['new_year_gift'], true, array('game.php?page=overview', 3));
			}else{
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
			}
		break;
		case '2':
			if($USER['newyear_gift_2'] > 0){
				$USER['antimatter'] += 50;
				$db = Database::get();
				$sql =  "UPDATE %%USERS%% SET newyear_gift_2 = newyear_gift_2 - :newyear_gift_2 WHERE id = :userID;";
				$db->update($sql, array(
				':newyear_gift_2'			=> 1,
				':userID'			=> $USER['id']
				));	
				$this->printMessage($LNG['new_year_gift'], true, array('game.php?page=overview', 3));
			}else{
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
			}
		break;
		case '3':
			if($USER['newyear_gift_3'] > 0){
				$USER['antimatter'] += 50;
				$db = Database::get();
				$sql =  "UPDATE %%USERS%% SET newyear_gift_3 = newyear_gift_3 - :newyear_gift_3 WHERE id = :userID;";
				$db->update($sql, array(
				':newyear_gift_3'			=> 1,
				':userID'			=> $USER['id']
				));	
				$this->printMessage($LNG['new_year_gift'], true, array('game.php?page=overview', 3));
			}else{
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
			}
		break;
		case '4':
				if($USER['newyear_gift_1'] > 0 && $USER['newyear_gift_2'] > 0 && $USER['newyear_gift_3'] > 0){
					$Message = $LNG['cosmo_giftbs'];
					$USER['antimatter'] += 217;
					$db = Database::get();
					$sql =  "UPDATE %%USERS%% SET newyear_gift_1 = newyear_gift_1 - :newyear_gift_1, newyear_gift_2 = newyear_gift_2 - :newyear_gift_2, newyear_gift_3 = newyear_gift_3 - :newyear_gift_3 WHERE id = :userID;";
					$db->update($sql, array(
					':newyear_gift_1'			=> 1,
					':newyear_gift_2'			=> 1,
					':newyear_gift_3'			=> 1,
					':userID'			=> $USER['id']
					));	
					
					$academy = 0;
					$academy_chance = mt_rand(1,40);
					$academy_chance_max = mt_rand(1,100);
					if($academy_chance > $academy_chance_max){
					$academy = mt_rand(1,17);	
					$Message .= "<br> ".$academy."&nbsp;".$LNG['premium_5'];
					}
					$peacefull = 0;
					$peacefu_chance = mt_rand(1,40);
					$peacefu_chance_max = mt_rand(1,100);
					if($peacefu_chance > $peacefu_chance_max){
					$peacefull = mt_rand(217,2017);	
					$Message .= "<br> ".$peacefull."&nbsp;".$LNG['premium_3'];
					}
					$bonusam = 0;
					$bonuant_chance = mt_rand(1,40);
					$bonuant_chance_max = mt_rand(1,100);
					if($bonuant_chance > $bonuant_chance_max){
					$bonusam = 217;	
					$Message .= "<br> 217 Antimatter bonus";
					$USER['antimatter'] += 217;
					}
					$comXP = 0;
					$combat_expe_chance = mt_rand(1,40);
					$combat_expe_chance_max = mt_rand(1,100);
					if($combat_expe_chance > $combat_expe_chance_max){
					$comXP = mt_rand(217,2017);	
					$Message .= "<br> ".$comXP."&nbsp;".$LNG['premium_4'];
					}
					$AchP = 0;
					$AchPoints_chance = mt_rand(1,40);
					$AchPoints_chance_max = mt_rand(1,100);
					if($AchPoints_chance > $AchPoints_chance_max){
					$AchP = mt_rand(1,17);	
					$Message .= "<br> ".$AchP."&nbsp;".$LNG['achiev_13'];
					}
					$sql =  "UPDATE %%USERS%% SET peacefull_exp_current = peacefull_exp_current + :peacefull_exp_current, academy_p = academy_p + :academy_p, combat_exp_current = combat_exp_current + :comXP, achievement_point = achievement_point + :AchP WHERE id = :userID;";
					$db->update($sql, array(
					':peacefull_exp_current'=> $peacefull,
					':academy_p'			=> $academy,
					':comXP'				=> $comXP,
					':AchP'				=> $AchP,
					':userID'			=> $USER['id']
					));	
					$this->printMessage($Message, true, array('game.php?page=overview', 3));
				}else{
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
				}
			break;
		}
	}elseif($config->cosmonaute_status == 1){
		switch($giftId){
			case '1':
				if($USER['cosmo_gift_1'] > 0){
					$USER['antimatter'] += 50;
					$db = Database::get();
					$sql =  "UPDATE %%USERS%% SET cosmo_gift_1 = cosmo_gift_1 - :cosmo_gift_1 WHERE id = :userID;";
					$db->update($sql, array(
					':cosmo_gift_1'			=> 1,
					':userID'			=> $USER['id']
					));	
					$this->printMessage($LNG['cosmo_gift'], true, array('game.php?page=overview', 3));
				}else{
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
				}
			break;
			case '2':
				if($USER['cosmo_gift_2'] > 0){
					$USER['antimatter'] += 50;
					$db = Database::get();
					$sql =  "UPDATE %%USERS%% SET cosmo_gift_2 = cosmo_gift_2 - :cosmo_gift_2 WHERE id = :userID;";
					$db->update($sql, array(
					':cosmo_gift_2'			=> 1,
					':userID'			=> $USER['id']
					));	
					$this->printMessage($LNG['cosmo_gift'], true, array('game.php?page=overview', 3));
				}else{
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
				}
			break;
			case '3':
				if($USER['cosmo_gift_3'] > 0){
					$USER['antimatter'] += 50;
					$db = Database::get();
					$sql =  "UPDATE %%USERS%% SET cosmo_gift_3 = cosmo_gift_3 - :cosmo_gift_3 WHERE id = :userID;";
					$db->update($sql, array(
					':cosmo_gift_3'			=> 1,
					':userID'			=> $USER['id']
					));	
					$this->printMessage($LNG['cosmo_gift'], true, array('game.php?page=overview', 3));
				}else{
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
				}
			break;
			case '4':
				if($USER['cosmo_gift_1'] > 0 && $USER['cosmo_gift_2'] > 0 && $USER['cosmo_gift_3'] > 0){
					$Message = $LNG['cosmo_giftbs'];
					$USER['antimatter'] += 215;
					$db = Database::get();
					$sql =  "UPDATE %%USERS%% SET cosmo_gift_1 = cosmo_gift_1 - :cosmo_gift_1, cosmo_gift_2 = cosmo_gift_2 - :cosmo_gift_2, cosmo_gift_3 = cosmo_gift_3 - :cosmo_gift_3 WHERE id = :userID;";
					$db->update($sql, array(
					':cosmo_gift_1'			=> 1,
					':cosmo_gift_2'			=> 1,
					':cosmo_gift_3'			=> 1,
					':userID'			=> $USER['id']
					));	
					$academy = 0;
					$academy_chance = mt_rand(1,40);
					$academy_chance_max = mt_rand(1,100);
					if($academy_chance > $academy_chance_max){
					$academy = mt_rand(50,100);	
					$Message .= "<br> ".$academy."&nbsp;".$LNG['premium_5'];
					}
					$peacefull = 0;
					$peacefu_chance = mt_rand(1,40);
					$peacefu_chance_max = mt_rand(1,100);
					if($peacefu_chance > $peacefu_chance_max){
					$peacefull = mt_rand(1000,3500);	
					$Message .= "<br> ".$peacefull."&nbsp;".$LNG['premium_3'];
					}
					$bonusam = 0;
					$bonuant_chance = mt_rand(1,40);
					$bonuant_chance_max = mt_rand(1,100);
					if($bonuant_chance > $bonuant_chance_max){
					$bonusam = 500;	
					$Message .= "<br> 500 Antimatter bonus";
					$USER['antimatter'] += 500;
					}
					$comXP = 0;
					$combat_expe_chance = mt_rand(1,40);
					$combat_expe_chance_max = mt_rand(1,100);
					if($combat_expe_chance > $combat_expe_chance_max){
					$comXP = mt_rand(1000,2000);	
					$Message .= "<br> ".$comXP."&nbsp;".$LNG['premium_4'];
					}
					$AchP = 0;
					$AchPoints_chance = mt_rand(1,40);
					$AchPoints_chance_max = mt_rand(1,100);
					if($AchPoints_chance > $AchPoints_chance_max){
					$AchP = mt_rand(250,500);	
					$Message .= "<br> ".$AchP."&nbsp;".$LNG['achiev_13'];
					}
					$sql =  "UPDATE %%USERS%% SET peacefull_exp_current = peacefull_exp_current + :peacefull_exp_current, academy_p = academy_p + :academy_p, combat_exp_current = combat_exp_current + :comXP, achievement_point = achievement_point + :AchP WHERE id = :userID;";
					$db->update($sql, array(
					':peacefull_exp_current'=> $peacefull,
					':academy_p'			=> $academy,
					':comXP'				=> $comXP,
					':AchP'				=> $AchP,
					':userID'			=> $USER['id']
					));	
					$this->printMessage($Message, true, array('game.php?page=overview', 3));
				}else{
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
				}
			break;
		}
	}elseif($config->halloween_event == 1){
		switch($giftId){
			case '1':
				if($USER['halloween_gift_1'] > 0){
					$USER['antimatter'] += 50;
					$db = Database::get();
					$sql =  "UPDATE %%USERS%% SET halloween_gift_1 = halloween_gift_1 - :halloween_gift_1 WHERE id = :userID;";
					$db->update($sql, array(
					':halloween_gift_1'			=> 1,
					':userID'			=> $USER['id']
					));	
					$this->printMessage($LNG['cosmo_gift'], true, array('game.php?page=overview', 3));
				}else{
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
				}
			break;
			case '2':
				if($USER['halloween_gift_2'] > 0){
					$USER['antimatter'] += 50;
					$db = Database::get();
					$sql =  "UPDATE %%USERS%% SET halloween_gift_2 = halloween_gift_2 - :halloween_gift_2 WHERE id = :userID;";
					$db->update($sql, array(
					':halloween_gift_2'			=> 1,
					':userID'			=> $USER['id']
					));	
					$this->printMessage($LNG['cosmo_gift'], true, array('game.php?page=overview', 3));
				}else{
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
				}
			break;
			case '3':
				if($USER['halloween_gift_3'] > 0){
					$USER['antimatter'] += 50;
					$db = Database::get();
					$sql =  "UPDATE %%USERS%% SET halloween_gift_3 = halloween_gift_3 - :halloween_gift_3 WHERE id = :userID;";
					$db->update($sql, array(
					':halloween_gift_3'			=> 1,
					':userID'			=> $USER['id']
					));	
					$this->printMessage($LNG['cosmo_gift'], true, array('game.php?page=overview', 3));
				}else{
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
				}
			break;
			case '4':
				if($USER['halloween_gift_1'] > 0 && $USER['halloween_gift_2'] > 0 && $USER['halloween_gift_3'] > 0){
					$Message = $LNG['cosmo_giftbs'];
					$USER['antimatter'] += 215;
					$db = Database::get();
					$sql =  "UPDATE %%USERS%% SET halloween_gift_1 = halloween_gift_1 - :halloween_gift_1, halloween_gift_2 = halloween_gift_2 - :halloween_gift_2, halloween_gift_3 = halloween_gift_3 - :halloween_gift_3 WHERE id = :userID;";
					$db->update($sql, array(
					':halloween_gift_1'			=> 1,
					':halloween_gift_2'			=> 1,
					':halloween_gift_3'			=> 1,
					':userID'			=> $USER['id']
					));	
					$academy = 0;
					$academy_chance = mt_rand(1,40);
					$academy_chance_max = mt_rand(1,100);
					if($academy_chance > $academy_chance_max){
					$academy = mt_rand(50,100);	
					$Message .= "<br> ".$academy."&nbsp;".$LNG['premium_5'];
					}
					$peacefull = 0;
					$peacefu_chance = mt_rand(1,40);
					$peacefu_chance_max = mt_rand(1,100);
					if($peacefu_chance > $peacefu_chance_max){
					$peacefull = mt_rand(1000,3500);	
					$Message .= "<br> ".$peacefull."&nbsp;".$LNG['premium_3'];
					}
					$bonusam = 0;
					$bonuant_chance = mt_rand(1,40);
					$bonuant_chance_max = mt_rand(1,100);
					if($bonuant_chance > $bonuant_chance_max){
					$bonusam = 500;	
					$Message .= "<br> 500 Antimatter bonus";
					$USER['antimatter'] += 500;
					}
					$comXP = 0;
					$combat_expe_chance = mt_rand(1,40);
					$combat_expe_chance_max = mt_rand(1,100);
					if($combat_expe_chance > $combat_expe_chance_max){
					$comXP = mt_rand(1000,2000);	
					$Message .= "<br> ".$comXP."&nbsp;".$LNG['premium_4'];
					}
					$AchP = 0;
					$AchPoints_chance = mt_rand(1,40);
					$AchPoints_chance_max = mt_rand(1,100);
					if($AchPoints_chance > $AchPoints_chance_max){
					$AchP = mt_rand(250,500);	
					$Message .= "<br> ".$AchP."&nbsp;".$LNG['achiev_13'];
					}
					$sql =  "UPDATE %%USERS%% SET peacefull_exp_current = peacefull_exp_current + :peacefull_exp_current, academy_p = academy_p + :academy_p, combat_exp_current = combat_exp_current + :comXP, achievement_point = achievement_point + :AchP WHERE id = :userID;";
					$db->update($sql, array(
					':peacefull_exp_current'=> $peacefull,
					':academy_p'			=> $academy,
					':comXP'				=> $comXP,
					':AchP'				=> $AchP,
					':userID'			=> $USER['id']
					));	
					$this->printMessage($Message, true, array('game.php?page=overview', 3));
				}else{
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
				}
			break;
		}
	}else{
		PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your gift bonus page', TIMESTAMP);
		$this->printMessage($LNG['moon_hack'], true, array('game.php?page=overview', 3));

	}
	}

	function show()
	{
		global $USER, $LNG; 

		if(!empty($USER['urlaubs_modus'])){
			$this->printMessage($LNG['not_acces_vmode'], true, array('game.php?page=overview', 3));
			die();
		}elseif($USER['bonus_timer'] > TIMESTAMP){
			$this->printMessage($LNG['bonus_time_res'], true, array('game.php?page=overview', 3));
			die();
		}else{
			
			$account_before = array(
				'darkmatter'			=> $USER['darkmatter'],
				'academy_p'				=> $USER['academy_p'],
				'peacefull_exp_current'	=> $USER['peacefull_exp_current'],
				'antimatter'			=> $USER['antimatter'],
				'bonus_timer'			=> $USER['bonus_timer'],
			);
		
			$premium_bonus_button = 1;
			if($USER['prem_button'] > 0 && $USER['prem_button_days'] > TIMESTAMP){
				$premium_bonus_button = $USER['prem_button'];
			}
			
			$red_button_bonus = 1;
			$max_chance_red = 2;
			$your_chance_red = mt_rand(1,5);
			if(Config::get()->red_button > 0 && $max_chance_red == $your_chance_red ){
				$red_button_bonus = Config::get()->red_button;
			}
				
			$dm = mt_rand(2500,10000);
			$dm *= $premium_bonus_button;
			$dm *= $red_button_bonus;
			
			$ap = mt_rand(1,5);
			$ap *= $premium_bonus_button;
			$ap *= $red_button_bonus;
			
			$experience = mt_rand(79,439);
			$experience *= $premium_bonus_button;
			$experience *= $red_button_bonus;
			
			$am = mt_rand(1,50);
			$am *= $premium_bonus_button;
			$am *= $red_button_bonus;
			
			$prem_speed_button = $USER['prem_speed_button']/2;
			
			$time = 3600*2;
			$time -=  $time /  100 * $prem_speed_button;
			$time = TIMESTAMP + $time;
			$USER['darkmatter'] += $dm;
			$USER['antimatter'] += $am;
			$db = Database::get();
			$sql =  "UPDATE %%USERS%% SET academy_p = academy_p + :ap, bonus_timer = :time, peacefull_exp_current = peacefull_exp_current + :experience, darkmatter = darkmatter + :darkmatter, antimatter = antimatter + :antimatter WHERE id = :userID;";
			$db->update($sql, array(
				':ap'			=> $ap,
				':time'			=> $time,
				':experience'			=> $experience,
				':darkmatter'			=> $dm,
				':antimatter'			=> $am,
				':userID'			=> $USER['id']
			));
			
			$sql	= 'SELECT darkmatter, academy_p, peacefull_exp_current, antimatter, bonus_timer FROM %%USERS%% WHERE id = :userId;';
			$getUser = $db->selectSingle($sql, array(
				':userId'		=> $USER['id'],
			));
			
			$account_after = array(
				'darkmatter'			=> $getUser['darkmatter'],
				'academy_p'				=> $getUser['academy_p'],
				'peacefull_exp_current'	=> $getUser['peacefull_exp_current'],
				'antimatter'			=> $getUser['antimatter'],
				'bonus_timer'			=> $getUser['bonus_timer'],
			);
			
			$LOG = new Logcheck(2);
			$LOG->username = $USER['username'];
			$LOG->pageLog = "page=bonus";
			$LOG->old = $account_before;
			$LOG->new = $account_after;
			$LOG->save();
		
			if(Config::get()->red_button > 0 && $max_chance_red == $your_chance_red ){
				$this->printMessage("".$LNG['bonus_receive']." [x".$red_button_bonus."]:<br>".$LNG['tech']['921'].": ".pretty_number($dm)."<br>".$LNG['tech']['922'].": ".pretty_number($am)." <br>".$LNG['bonus_experience'].": ".pretty_number($experience)."<br>".$LNG['bonus_aca_p'].": ".$ap."", true, array('game.php?page=overview', 3));
			}else{
				$this->printMessage("".$LNG['bonus_receive'].":<br>".$LNG['tech']['921'].": ".pretty_number($dm)."<br>".$LNG['tech']['922'].": ".pretty_number($am)." <br>".$LNG['bonus_experience'].": ".pretty_number($experience)."<br>".$LNG['bonus_aca_p'].": ".$ap."", true, array('game.php?page=overview', 3));	
			}
		}
	}
}