<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan Kr�pke
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
 * @author Jan Kr�pke <info@2moons.cc>
 * @copyright 2012 Jan Kr�pke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.2 (2013-03-18)
 * @info $Id$
 * @link http://2moons.cc/
 */
 
class ShowPromotePage extends AbstractGamePage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
	}
	function getClientIp()
    {
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        }
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
			$ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        elseif(!empty($_SERVER['HTTP_X_FORWARDED']))
        {
			$ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        }
        elseif(!empty($_SERVER['HTTP_FORWARDED_FOR']))
        {
			$ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        elseif(!empty($_SERVER['HTTP_FORWARDED']))
        {
			$ipAddress = $_SERVER['HTTP_FORWARDED'];
        }
        elseif(!empty($_SERVER['REMOTE_ADDR']))
        {
			$ipAddress = $_SERVER['REMOTE_ADDR'];
        }
        else
        {
			$ipAddress = 'UNKNOWN';
        }
        return $ipAddress;
	}
	
	
	function updatetimer()
	{
		global $LNG, $USER;
				
		/*if($USER['vote_sys_4'] < TIMESTAMP - 2*3600){
			$sql	= 'UPDATE %%USERS%% SET `vote_sys_4` = :vote_sys_4, darkmatter = darkmatter + :darkmatter, antimatter = antimatter + :antimatter, votepoint = votepoint + :currency WHERE `id` = :userId;';
			Database::get()->update($sql, array(
				':currency'		=> 1,
				':vote_sys_4'	=> TIMESTAMP,
				':darkmatter'	=> 2000,
				':antimatter'	=> 200,
				':userId'		=> $USER['id']
			));
			
			$sql = "INSERT INTO %%VOTE_LOG%% SET user_id = :user_id, time = :time, vote_system_id = :vote_system_id, user_ip = :user_ip, isSucces = :isSucces, universe = :universe;";

			Database::get()->insert($sql, array(
				':user_id'			=> $USER['id'],
				':time'				=> TIMESTAMP,
				':vote_system_id'	=> 4,
				':user_ip'			=> $this->getClientIp(),
				':isSucces'			=> 1,
				':universe'			=> Universe::current()
			));
			tournement($USER['id'], 1, 1);	
			$text = 'Your vote on RootTop was succesfull. <br><span style="color:#F30; font-weight:bold;">'.pretty_number(2000).'</span> darkmatter and <span style="color:#F30; font-weight:bold;">'.pretty_number(200).'</span> antimatter have been credited to your account.';
			PlayerUtil::sendMessage($USER['id'], 0, 'RootTop', 4, 'Successfull vote.', $text, TIMESTAMP);
			header('location: http://www.root-top.com/topsite/ogame0serveurs/in.php?ID=3174&mark='.$USER['id']);
		}*/
	}
	
	
	function show()
	{
		global $LNG, $USER;
		
		/*if($USER['id'] != 10283){
			$this->printMessage('under maintenance', true, array('game.php?page=overview', 2));
		}*/
		
		$this->tplObj->loadscript('jquery.countdown.js');
		$voteSystem = array();
		$db	= Database::get();
		$sql	= 'SELECT * FROM %%VOTE%% ';
		$voteSystems = $db->select($sql, array(
		));
		 
		foreach($voteSystems as $vote){
				
		if($vote['id'] == 1){
		$ivn = "/".$USER['id'];
		}elseif($vote['id'] == 2){
		$ivn = "&id=".$USER['id'];
		}elseif($vote['id'] == 3){
		$ivn = "&id=".$USER['id'];
		}elseif($vote['id'] == 4){
		$ivn = "-".$USER['id'];
		}elseif($vote['id'] == 5){
		$ivn = "&custom=".$USER['id'];
		}
		
		$secunde                    = $USER['vote_sys_'.$vote['id'].''] + $vote['time'] * 3600 - TIMESTAMP;	
		$voteSystem[$vote['id']]	= array(
				'link'				=> $USER['vote_sys_'.$vote['id'].''] > TIMESTAMP - $vote['time'] * 3600 ? "<font color=\'red\'><span class=countdown2 secs=".$secunde."></span></font>" : "<a href=".$vote['link'].$ivn."><input style='line-height:20px; width:200px; display:block; margin:0 auto;margin-top:10px;margin-bottom:10px' type='button' value='" .$LNG['promo__4']."'></input></a>",
				'image'				=> $vote['image'],
				'price'				=> $vote['prize'],
				
			);
		}
		
		$this->assign(array(
		'voteSystem' => $voteSystem,
		));
		$this->display('page.promote.default.tpl');
	}
	
	
}