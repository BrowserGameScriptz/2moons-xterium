<?php

/**
 *  2Moons
 *  Copyright (C) 2011 Jan Kröpke
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
 * @copyright 2009 Lucky
 * @copyright 2011 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.0 (2011-12-10)
 * @info $Id$
 * @link http://code.google.com/p/2moons/
 */

require_once 'includes/classes/cronjob/CronjobTask.interface.php';

class AuctioneerCronjob implements CronjobTask
{
	function run()
	{		
		$config	= Config::get(ROOT_UNI);
		$db	= Database::get();
		if($config->auctioneer_next < TIMESTAMP){
			$newevkaka = TIMESTAMP + 5*60;		
			$sql	= "UPDATE %%CONFIG%% SET auctioneer_next = :auctioneer_next WHERE uni = :uni;";
			$db->update($sql, array(
				':auctioneer_next'	=> $newevkaka,
				':uni'	=> 1
			));


			$endTime 		= 60 * mt_rand(35,45);
			$EndSecond 		= mt_rand(0,60);
			$EndSecond 		+= mt_rand(0,60);
			$startTimer 	= TIMESTAMP;
			$items 			= mt_rand(1,21);
			$PageOfPlayer 	= round(config::get()->users_amount / 100);
			
			$sql	= "UPDATE %%AUCTIONACTIVE%% SET cronjobEnd = 1;";
			$db->update($sql, array());
			
			$sql	= "DELETE FROM %%AUCTIONLOG%% WHERE auctionid > 0;";
			$db->delete($sql, array());
			
			//for( $i= 0 ; $i <= $PageOfPlayer ; $i++){
				$sql = "INSERT INTO %%AUCTIONACTIVE%% SET
					itemId			= :itemId,
					startTime		= :startTime,
					endTime			= :endTime,
					actualBid		= :actualBid,
					amountBid		= :amountBid,
					highestBidder	= :highestBidder,
					giftSend		= :giftSend,
					isChanged		= :isChanged,
					auctionPage		= :auctionPage,
					cronjobEnd		= :cronjobEnd;";

				$db->insert($sql, array(
					':itemId'			=> $items,
					':startTime'		=> $startTimer,
					':endTime'			=> $startTimer + $endTime + $EndSecond,
					':actualBid'		=> 0,
					':amountBid'		=> 0,
					':highestBidder'	=> 0,
					':giftSend'			=> 0,
					':isChanged'		=> 0,
					//':auctionPage'		=> $i,
					':auctionPage'		=> 0,
					':cronjobEnd'		=> 0
				));
			//}
			
			$sql	= "SELECT DISTINCT id, lang FROM %%USERS%% WHERE onlinetime > :onlinetime AND auctionMessage = 1;";
			$activeUsers = database::get()->select($sql, array(
				':onlinetime'	=> TIMESTAMP - (20*60),
			));
			
			$langObjects	= array();
			foreach($activeUsers as $userInfo){
				
				if(!isset($langObjects[$userInfo['lang']]))
				{
					$langObjects[$userInfo['lang']]	= new Language($userInfo['lang']);
					$langObjects[$userInfo['lang']]->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
				}
					
				$LNG		= $langObjects[$userInfo['lang']];
				
				$sql = "INSERT INTO %%NOTIF%% SET userId = :userId, timestamp = :timestamp, noText = :noText, noImage = :noImage, isType = :isType;";
				database::get()->insert($sql, array(
					':userId'		=> $userInfo['id'],
					':timestamp'	=> TIMESTAMP,
					':noText'		=> 'The auctioneer started a new auction',
					':noImage'		=> "/media/images/auction.jpg",
					':isType'		=> 1
				));
			}
		}
	}
}