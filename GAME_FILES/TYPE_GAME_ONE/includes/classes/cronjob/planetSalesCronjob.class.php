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

class planetSalesCronJob implements CronjobTask
{
	function run()
	{		
		$sql 	= "SELECT * FROM %%PLANETAUCTION%% WHERE time < :time;";
		$LotExpired = database::get()->select($sql, array(
			':time'    => TIMESTAMP
		));
		
		$count = 0;
		foreach($LotExpired as $Expired){
			
			if($Expired['selledID'] == $Expired['buyerID']){
				$sql 	= "UPDATE %%PLANETS%% SET id_owner = :id_owner WHERE id = :planetId;";
				database::get()->update($sql, array(
					':id_owner'	 => $Expired['selledID'],
					':planetId'  => $Expired['planetID'],
				));
				
				if($Expired['hasMoon'] != 0){
					$sql 	= "UPDATE %%PLANETS%% SET id_owner = :id_owner WHERE id = :planetId;";
					database::get()->update($sql, array(
						':id_owner'	 => $Expired['selledID'],
						':planetId'  => $Expired['hasMoon'],
					));
				}
				
				$sql 	= "DELETE FROM %%PLANETAUCTION%% WHERE auctionID = :auctionID;";
				database::get()->delete($sql, array(
					':auctionID'  => $Expired['auctionID'],
				));
			
				PlayerUtil::sendMessage($Expired['selledID'], $Expired['selledID'], getUsername($Expired['selledID']), 4, "Market planet failed", "No bids has been made on your planet on time. The  planet has been returned on your account.", TIMESTAMP);
			}else{
				$count++;
				$sql 	= "SELECT SUM(bidPrice) as bidPrice, playerId FROM %%PLANETOFFERS%% WHERE lotId = :lotId AND playerId != :buyerID GROUP BY playerId;";
				$BiddersInfo = database::get()->select($sql, array(
					':lotId'   	 => $Expired['auctionID'],
					':buyerID'   => $Expired['buyerID'],
				));
				
				foreach($BiddersInfo as $Bidder){
					$sql 	= "UPDATE %%USERS%% SET antimatter = antimatter + :antimatter WHERE id = :userId;";
					database::get()->update($sql, array(
						':antimatter'=> $Bidder['bidPrice'],
						':userId'  	 => $Bidder['playerId'],
					));
					PlayerUtil::sendMessage($Bidder['playerId'], $Bidder['playerId'], getUsername($Bidder['playerId']), 4, "Market planet failed", "You failed to purchase the planet. ".pretty_number($Bidder['bidPrice'])." antimatter has been refunded", TIMESTAMP);
				}
				
				$sql 	= "SELECT * FROM %%USERS%% WHERE id = :buyerID;";
				$winnerInfo = database::get()->selectSingle($sql, array(
					':buyerID'   => $Expired['buyerID'],
				));
				
				$sql 	= "UPDATE %%PLANETS%% SET id_owner = :id_owner WHERE id = :planetId;";
				database::get()->update($sql, array(
					':id_owner'	 => $Expired['buyerID'],
					':planetId'  => $Expired['planetID'],
				));
				
				if($Expired['hasMoon'] != 0){
					$sql 	= "UPDATE %%PLANETS%% SET id_owner = :id_owner WHERE id = :planetId;";
					database::get()->update($sql, array(
						':id_owner'	 => $Expired['buyerID'],
						':planetId'  => $Expired['hasMoon'],
					));
				}
				
				$sql 	= "DELETE FROM %%PLANETOFFERS%% WHERE lotId = :lotId;";
				database::get()->delete($sql, array(
					':lotId'   	 => $Expired['auctionID'],
				));
				
				$sql 	= "DELETE FROM %%PLANETAUCTION%% WHERE auctionID = :auctionID;";
				database::get()->delete($sql, array(
					':auctionID'  => $Expired['auctionID'],
				));
				
				$endSalePrice = $Expired['price'];
				$endSalePrice = round($endSalePrice - ($endSalePrice / 100 * 5));
				
				$sql 	= "UPDATE %%USERS%% SET antimatter = antimatter + :antimatter WHERE id = :idOwner;";
				database::get()->update($sql, array(
					':antimatter'	=> $endSalePrice,
					':idOwner'  	=> $Expired['selledID'],
				));
				
				PlayerUtil::sendMessage($Expired['selledID'], $Expired['selledID'], getUsername($Expired['selledID']), 4, "Market planet success", "You successfully sold your planet for <span style='color:#F30; font-weight:bold;'>".pretty_number($endSalePrice)."</span> antimatter.", TIMESTAMP);
				PlayerUtil::sendMessage($Expired['buyerID'], $Expired['buyerID'], getUsername($Expired['buyerID']), 4, "Market planet success", "You successfully purchased the planet for <span style='color:#F30; font-weight:bold;'>".pretty_number($endSalePrice)."</span> antimatter.", TIMESTAMP);
			}
		}
		
		//PlayerUtil::sendMessage(1, 1, getUsername(1), 4, "Market planet log", "There are in total  ".pretty_number($count)." planets sold.", TIMESTAMP);
	}
}