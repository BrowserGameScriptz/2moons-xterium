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

class ShowDonationPage extends AbstractGamePage
{
	public static $requireModule = MODULE_BANLIST;

	function __construct()
	{
		parent::__construct();
	}

	function voucherCode()
	{
		global $USER, $LNG; 
		
		$voucherCode	= HTTP::_GP('voucherCode', '', UTF8_SUPPORT);
		$sql =  "SELECT * FROM %%VOUCHERCODES%% WHERE voucherCode = :voucherCode;";
		$existCode = database::get()->selectSingle($sql, array(
			':voucherCode'			=> $voucherCode,
		));
		
		if(empty($existCode)){
			$this->printMessage("This voucher code does not exist on this universe.", true, array('game.php?page=donation', 5));
		}elseif($existCode['usedBy'] != 0){
			$this->printMessage("This voucher code has already be used by ".getUsername($existCode['usedBy']), true, array('game.php?page=donation', 5));
		}else{
			$sql =  "UPDATE %%VOUCHERCODES%% SET usedBy = :usedBy, usedTime = :usedTime WHERE voucherCode = :voucherCode;";
			database::get()->update($sql, array(
				':usedBy'		=> $USER['id'],
				':usedTime'		=> TIMESTAMP,
				':voucherCode'	=> $voucherCode,
			));
			$USER['antimatter'] += 10000;
			$sql =  "UPDATE %%USERS%% SET antimatter = antimatter + :antimatter WHERE id = :userId;";
			database::get()->update($sql, array(
				':antimatter'	=> 10000,
				':userId'		=> $USER['id']
			));
			
			
			$this->printMessage($LNG['bonus_receive']."<br>15.000&nbsp;".$LNG['tech'][922], true, array('game.php?page=donation', 5));
			
		}
	}
	
	function show()
	{
		global $USER, $LNG;
		$config = Config::get();
		
		$friend			= HTTP::_GP('friend', '', false);			
		$friendsArray 	= array();
		$friendCount	= 0;
		
		$sql =  "SELECT * FROM %%BUDDY%% WHERE (sender = :userID AND buddyType = 1 AND isAccepted = 1) OR (owner = :userID AND buddyType = 1 AND isAccepted = 1);";
		$forFriend = database::get()->select($sql, array(
			':userID'			=> $USER['id'],
		));
		foreach($forFriend as $friends){
			$isUser	= $friends['sender'];
			if($friends['sender'] == $USER['id'])
				$isUser	= $friends['owner'];
				
			$friendsArray[$isUser] = array(
				'info'	=> GetFromDatabase('USERS', 'id', $isUser, array('username', 'customNick')),
			);
			$friendCount++;
		}
						
		$this->tplObj->loadscript('donation.js');
		$this->assign(array(
			'donation_p3' 				=> sprintf($LNG['donation_p3'], pretty_number($config->special_donation_amount), $config->special_donation_percent, '%'),	
			'friendCount' 				=> $friendCount,	
			'pointe' 					=> $USER['loyality_points'],	
			'donation_bonus' 			=> $config->donation_bonus,	
			'x_donation_inter' 			=> $config->x_donation_inter,	
			'x_donation_xsolla' 		=> $config->x_donation_xsolla,	
			'statutsss' 				=> $config->special_donation_status,	
			'special_amont' 			=> $config->special_donation_amount,	
			'special_donation_percent' 	=> $config->special_donation_percent,	
			'special_donation_up' 		=> $config->special_donation_up,	
			'DonateToFriend'			=> $friend,	
			'friendsArray'				=> $friendsArray,	
		));
			
		$this->display('page.donation.default.tpl');
	}
}