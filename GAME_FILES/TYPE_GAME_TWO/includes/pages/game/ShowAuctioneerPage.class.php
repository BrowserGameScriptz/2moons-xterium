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

class ShowAuctioneerPage extends AbstractGamePage 
{

	function __construct()
	{
		parent::__construct();
	}
	
		
	function up()
	{
	
	global $LNG, $resource, $USER, $PLANET, $pricelist, $reslist;
	
	$itemId 	= HTTP::_GP('itemid', 1);
	$UName = "auction_item_".$itemId;
	$UNames = $USER[$UName];
	$db	= Database::get();
	
	//if($USER['id'] != 1){
	//$this->printMessage('under maintenance', true, array('game.php?page=overview', 2));
	//}
		
	if($UNames < 1){
		$this->printMessage($LNG['backNotification_7'], true, array('game.php?page=auctioneer&mode=inventory', 3));
	}elseif(($PLANET['auction_item_1_timer'] > TIMESTAMP || $PLANET['auction_item_2_timer'] > TIMESTAMP) && $itemId == 3){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=auctioneer&mode=inventory');
	}elseif(($PLANET['auction_item_1_timer'] > TIMESTAMP || $PLANET['auction_item_3_timer'] > TIMESTAMP) && $itemId == 2){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=auctioneer&mode=inventory');
	}elseif(($PLANET['auction_item_2_timer'] > TIMESTAMP || $PLANET['auction_item_3_timer'] > TIMESTAMP) && $itemId == 1){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=auctioneer&mode=inventory');
	}elseif(($PLANET['auction_item_4_timer'] > TIMESTAMP || $PLANET['auction_item_5_timer'] > TIMESTAMP) && $itemId == 6){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=auctioneer&mode=inventory');
	}elseif(($PLANET['auction_item_4_timer'] > TIMESTAMP || $PLANET['auction_item_6_timer'] > TIMESTAMP) && $itemId == 5){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=auctioneer&mode=inventory');
	}elseif(($PLANET['auction_item_5_timer'] > TIMESTAMP || $PLANET['auction_item_6_timer'] > TIMESTAMP) && $itemId == 4){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=auctioneer&mode=inventory');
	}elseif(($PLANET['auction_item_7_timer'] > TIMESTAMP || $PLANET['auction_item_8_timer'] > TIMESTAMP) && $itemId == 9){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=auctioneer&mode=inventory');
	}elseif(($PLANET['auction_item_7_timer'] > TIMESTAMP || $PLANET['auction_item_9_timer'] > TIMESTAMP) && $itemId == 8){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=auctioneer&mode=inventory');
	}elseif(($PLANET['auction_item_8_timer'] > TIMESTAMP || $PLANET['auction_item_9_timer'] > TIMESTAMP) && $itemId == 7){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=auctioneer&mode=inventory');
	}elseif($itemId  < 10 && $PLANET['planet_type'] == 3){
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=auctioneer&mode=inventory');
	}elseif($itemId == 10 || $itemId == 11 || $itemId == 12){
		$itemIdBT  = 30*60;
		$itemIdBE  = 60*60;
		$itemIdBTW = 120*60;
		$CurrentQueue	= unserialize($PLANET['b_building_id']);
		if (empty($CurrentQueue))
		{
			$this->printMessage('nok', true, array('game.php?page=auctioneer&mode=inventory', 3));
		}
		$Element      	= $CurrentQueue[0][0];
		$BuildEndTime 	= $CurrentQueue[0][3];
		$BuildMode    	= $CurrentQueue[0][4];
		
		if($itemId == 10){
			if($BuildEndTime - $itemIdBT <= TIMESTAMP){
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][3] = TIMESTAMP;
				$finalEndTime = TIMESTAMP;
				$CurrentQueue[0][4] = $BuildMode;
				$PLANET['b_building'] 	= TIMESTAMP;
				$PLANET['b_building_id'] 	= serialize($CurrentQueue);

				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> $BuildEndTime,
				      ':endTime'		=> $finalEndTime,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
							));
			}else{
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][3] = $BuildEndTime - $itemIdBT;
				$CurrentQueue[0][4] = $BuildMode;
				$PLANET['b_building']    	= $PLANET['b_building'] - $itemIdBT;
				$PLANET['b_building_id'] 	= serialize($CurrentQueue);
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> $BuildEndTime,
				      ':endTime'		=> $BuildEndTime - $itemIdBT,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
							));
			}
		}elseif($itemId == 11){
			if($BuildEndTime - $itemIdBE < TIMESTAMP){
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][3] = TIMESTAMP;
				$finalEndTime = TIMESTAMP;
				$CurrentQueue[0][4] = $BuildMode;
				$PLANET['b_building'] 	= TIMESTAMP;
				$PLANET['b_building_id'] 	= serialize($CurrentQueue);

				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> $BuildEndTime,
				      ':endTime'		=> $finalEndTime,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
							));
			}else{
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][3] = $BuildEndTime - $itemIdBE;
				$CurrentQueue[0][4] = $BuildMode;
				$PLANET['b_building']    	= $PLANET['b_building'] - $itemIdBE;
				$PLANET['b_building_id'] 	= serialize($CurrentQueue);
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> $BuildEndTime,
				      ':endTime'		=> $BuildEndTime - $itemIdBE,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
							));
				
			}
		}elseif($itemId == 12){
			if($BuildEndTime - $itemIdBTW < TIMESTAMP){
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][3] = TIMESTAMP;
				$finalEndTime = TIMESTAMP;
				$CurrentQueue[0][4] = $BuildMode;
				$PLANET['b_building'] 	= TIMESTAMP;
				$PLANET['b_building_id'] 	= serialize($CurrentQueue);

				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> $BuildEndTime,
				      ':endTime'		=> $finalEndTime,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
							));
			}else{
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][3] = $BuildEndTime - $itemIdBTW;
				$CurrentQueue[0][4] = $BuildMode;
				$PLANET['b_building']    	= $PLANET['b_building'] - $itemIdBTW;
				$PLANET['b_building_id'] 	= serialize($CurrentQueue);
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> $BuildEndTime,
				      ':endTime'		=> $BuildEndTime - $itemIdBTW,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
							));
			}
		}
		$sql	= "UPDATE %%USERS%% SET ".$UName." = ".$UName." - :UName WHERE id = :userId;";
		$db->update($sql, array(
			':UName'	=> 1, 
			':userId'	=> $USER['id'] 
		));		 
	}elseif($itemId == 13 || $itemId == 14 || $itemId == 15){
		$itemIdBT  = 30*60;
		$itemIdBE  = 60*60;
		$itemIdBTW = 120*60;
		$CurrentQueue	= unserialize($USER['b_tech_queue']);
		if (empty($CurrentQueue))
		{
			$this->printMessage('nok', true, array('game.php?page=auctioneer&mode=inventory', 3));
		}
		$Element      	= $CurrentQueue[0][0];
		$BuildEndTime 	= $CurrentQueue[0][3];
		if($itemId == 13){
			if($USER['b_tech'] - $itemIdBT < TIMESTAMP){
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][3] = TIMESTAMP;
				$finalEndTime = TIMESTAMP;
				$USER['b_tech'] 	= TIMESTAMP;
				$USER['b_tech_queue'] 	= serialize($CurrentQueue);
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> $BuildEndTime,
				      ':endTime'		=> $finalEndTime,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
							));
			}else{
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][3] = $BuildEndTime - $itemIdBT;
				$USER['b_tech']    	= $USER['b_tech'] - $itemIdBT;
				$USER['b_tech_queue'] 	= serialize($CurrentQueue);
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> $BuildEndTime,
				      ':endTime'		=> $BuildEndTime - $itemIdBT,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
					));
			}
		}elseif($itemId == 14){
			if($USER['b_tech'] - $itemIdBE < TIMESTAMP){
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][3] = TIMESTAMP;
				$finalEndTime = TIMESTAMP;
				$USER['b_tech'] 	= TIMESTAMP;
				$USER['b_tech_queue'] 	= serialize($CurrentQueue);
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> $BuildEndTime,
				      ':endTime'		=> $finalEndTime,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
				
			}else{
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][3] = $BuildEndTime - $itemIdBE;
				$USER['b_tech']    	= $USER['b_tech'] - $itemIdBE;
				$USER['b_tech_queue'] 	= serialize($CurrentQueue);
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> $BuildEndTime,
				      ':endTime'		=> $BuildEndTime - $itemIdBE,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
					));
				
			}
		}elseif($itemId == 15){
			if($USER['b_tech'] - $itemIdBTW <= TIMESTAMP){
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][3] = TIMESTAMP;
				$finalEndTime = TIMESTAMP;
				$USER['b_tech'] 	= TIMESTAMP;
				$USER['b_tech_queue'] 	= serialize($CurrentQueue);
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> $BuildEndTime,
				      ':endTime'		=> $finalEndTime,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
				
			}else{
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][3] = $BuildEndTime - $itemIdBTW;
				$USER['b_tech']    	= $USER['b_tech'] - $itemIdBTW;
				$USER['b_tech_queue'] 	= serialize($CurrentQueue);
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> $BuildEndTime,
				      ':endTime'		=> $BuildEndTime - $itemIdBTW,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
					));
				
			}
		}
		$sql	= "UPDATE %%USERS%% SET ".$UName." = ".$UName." - :UName WHERE id = :userId;";
		$db->update($sql, array(
			':UName'	=> 1, 
			':userId'	=> $USER['id'] 
		));		 
	}elseif($itemId == 16 || $itemId == 17 || $itemId == 18){
		$itemIdBT  = 30*60;
		$itemIdBE  = 60*60;
		$itemIdBTW = 120*60;
		$CurrentQueue	= unserialize($PLANET['b_hangar_id']);
		if (empty($CurrentQueue))
		{
			$this->printMessage('nok', true, array('game.php?page=auctioneer&mode=inventory', 3));
		}
		$Element      	= $CurrentQueue[0][0];
		$Count 	= $CurrentQueue[0][1];
		$BuildTime			= BuildFunctions::getBuildingTime($USER, $PLANET, $Element);
		$TotalTime			= $BuildTime * $Count;
		if($itemId == 16){
			if(TIMESTAMP + $TotalTime - $itemIdBT < TIMESTAMP){
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][1] = 1;
				if (count($CurrentQueue) == 0) {
				$PLANET['b_hangar'] = 0;
				$PLANET['b_hangar_id'] = '';
				}else{
				$PLANET['b_hangar_id'] 	= serialize($CurrentQueue);	
				}
				$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :UName WHERE id = :planetId;";
				$db->update($sql, array(
					':UName'	=> $Count, 
					':planetId'	=> $PLANET['id'] 
				));		 
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> TIMESTAMP + $TotalTime,
				      ':endTime'		=> TIMESTAMP,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
			}else{
				$Canbuildin = floor((30*60) / $BuildTime);
				$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :UName WHERE id = :planetId;";
				$db->update($sql, array(
					':UName'	=> $Canbuildin, 
					':planetId'	=> $PLANET['id'] 
				));		 
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][1] = $Count - $Canbuildin;
				$PLANET['b_hangar_id'] 	= serialize(array_values($CurrentQueue));
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> TIMESTAMP + $TotalTime,
				      ':endTime'		=> TIMESTAMP + $TotalTime - $itemIdBT,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
			}
		}elseif($itemId == 17){
			if(TIMESTAMP + $TotalTime - $itemIdBE < TIMESTAMP){
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][1] = 1;
				if (count($CurrentQueue) == 0) {
				$PLANET['b_hangar'] = 0;
				$PLANET['b_hangar_id'] = '';
				}else{
				$PLANET['b_hangar_id'] 	= serialize($CurrentQueue);	
				}
				$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :UName WHERE id = :planetId;";
				$db->update($sql, array(
					':UName'	=> $Count, 
					':planetId'	=> $PLANET['id'] 
				));		
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> TIMESTAMP + $TotalTime,
				      ':endTime'		=> TIMESTAMP,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
				
			}else{
				$Canbuildin = floor((60*60) / $BuildTime);
				$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :UName WHERE id = :planetId;";
				$db->update($sql, array(
					':UName'	=> $Canbuildin, 
					':planetId'	=> $PLANET['id'] 
				));		 
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][1] = $Count - $Canbuildin;
				$PLANET['b_hangar_id'] 	= serialize(array_values($CurrentQueue));
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> TIMESTAMP + $TotalTime,
				      ':endTime'		=> TIMESTAMP + $TotalTime - $itemIdBE,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
				
			}
		}elseif($itemId == 18){
			if(TIMESTAMP + $TotalTime - $itemIdBTW < TIMESTAMP){
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][1] = 1;
				if (count($CurrentQueue) == 0) {
				$PLANET['b_hangar'] = 0;
				$PLANET['b_hangar_id'] = '';
				}else{
				$PLANET['b_hangar_id'] 	= serialize($CurrentQueue);	
				}
				$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :UName WHERE id = :planetId;";
				$db->update($sql, array(
					':UName'	=> $Count, 
					':planetId'	=> $PLANET['id'] 
				));		 
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> TIMESTAMP + $TotalTime,
				      ':endTime'		=> TIMESTAMP,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
			}else{
				$Canbuildin = floor((120*60) / $BuildTime);
				$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :UName WHERE id = :planetId;";
				$db->update($sql, array(
					':UName'	=> $Canbuildin, 
					':planetId'	=> $PLANET['id'] 
				));		 
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][1] = $Count - $Canbuildin;
				$PLANET['b_hangar_id'] 	= serialize(array_values($CurrentQueue));
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> TIMESTAMP + $TotalTime,
				      ':endTime'		=> TIMESTAMP + $TotalTime - $itemIdBTW,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
			}
		}
		$sql	= "UPDATE %%USERS%% SET ".$UName." = ".$UName." - :UName WHERE id = :userId;";
		$db->update($sql, array(
			':UName'	=> 1, 
			':userId'	=> $USER['id'] 
		));		 
	}elseif($itemId == 19 || $itemId == 20 || $itemId == 21){
		$itemIdBT  = 30*60;
		$itemIdBE  = 60*60;
		$itemIdBTW = 120*60;
		$CurrentQueue	= unserialize($PLANET['b_defense_id']);
		if (empty($CurrentQueue))
		{
			$this->printMessage('nok', true, array('game.php?page=auctioneer&mode=inventory', 3));
		}
		$Element      	= $CurrentQueue[0][0];
		$Count 			= $CurrentQueue[0][1];
		$BuildTime		= BuildFunctions::getBuildingTime($USER, $PLANET, $Element);
		$TotalTime		= $BuildTime * $Count;
		if($itemId == 19){
			if(TIMESTAMP + $TotalTime - $itemIdBT < TIMESTAMP){
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][1] = 1;
				if (count($CurrentQueue) == 0) {
					$PLANET['b_defense'] = 0;
					$PLANET['b_defense_id'] = '';
				}else{
					$PLANET['b_defense_id'] 	= serialize($CurrentQueue);	
				}
				$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :UName WHERE id = :planetId;";
				$db->update($sql, array(
					':UName'	=> $Count, 
					':planetId'	=> $PLANET['id'] 
				));		 
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
				   playerID	= :playerID,
				   timestamp	= :timestamp,
				   beginTime	= :beginTime,
				   endTime	= :endTime,
				   itemID	= :itemID,
					elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'		=> $USER['id'],
			      	':timestamp'	=> TIMESTAMP,
				    ':beginTime'	=> TIMESTAMP + $TotalTime,
				    ':endTime'		=> TIMESTAMP,
				    ':itemID'		=> $itemId,
					':elementID'	=> $Element
				));
			}else{
				$Canbuildin = floor((30*60) / $BuildTime);
				$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :UName WHERE id = :planetId;";
				$db->update($sql, array(
					':UName'	=> $Canbuildin, 
					':planetId'	=> $PLANET['id'] 
				));		 
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][1] = $Count - $Canbuildin;
				$PLANET['b_defense_id'] 	= serialize(array_values($CurrentQueue));
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> TIMESTAMP + $TotalTime,
				      ':endTime'		=> TIMESTAMP + $TotalTime - $itemIdBT,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
			}
		}elseif($itemId == 20){
			if(TIMESTAMP + $TotalTime - $itemIdBE < TIMESTAMP){
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][1] = 1;
				if (count($CurrentQueue) == 0) {
				$PLANET['b_defense'] = 0;
				$PLANET['b_defense_id'] = '';
				}else{
				$PLANET['b_defense_id'] 	= serialize($CurrentQueue);	
				}
				$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :UName WHERE id = :planetId;";
				$db->update($sql, array(
					':UName'	=> $Count, 
					':planetId'	=> $PLANET['id'] 
				));		
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> TIMESTAMP + $TotalTime,
				      ':endTime'		=> TIMESTAMP,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
				
			}else{
				$Canbuildin = floor((60*60) / $BuildTime);
				$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :UName WHERE id = :planetId;";
				$db->update($sql, array(
					':UName'	=> $Canbuildin, 
					':planetId'	=> $PLANET['id'] 
				));		 
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][1] = $Count - $Canbuildin;
				$PLANET['b_defense_id'] 	= serialize(array_values($CurrentQueue));
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> TIMESTAMP + $TotalTime,
				      ':endTime'		=> TIMESTAMP + $TotalTime - $itemIdBE,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
				
			}
		}elseif($itemId == 21){
			if(TIMESTAMP + $TotalTime - $itemIdBTW < TIMESTAMP){
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][1] = 1;
				if (count($CurrentQueue) == 0) {
				$PLANET['b_defense'] = 0;
				$PLANET['b_defense_id'] = '';
				}else{
				$PLANET['b_defense_id'] 	= serialize($CurrentQueue);	
				}
				$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :UName WHERE id = :planetId;";
				$db->update($sql, array(
					':UName'	=> $Count, 
					':planetId'	=> $PLANET['id'] 
				));		 
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> TIMESTAMP + $TotalTime,
				      ':endTime'		=> TIMESTAMP,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
			}else{
				$Canbuildin = floor((120*60) / $BuildTime);
				$sql	= "UPDATE %%PLANETS%% SET ".$resource[$Element]." = ".$resource[$Element]." + :UName WHERE id = :planetId;";
				$db->update($sql, array(
					':UName'	=> $Canbuildin, 
					':planetId'	=> $PLANET['id'] 
				));		 
				$CurrentQueue[0][0] = $Element;
				$CurrentQueue[0][1] = $Count - $Canbuildin;
				$PLANET['b_defense_id'] 	= serialize(array_values($CurrentQueue));
				$sql = "INSERT INTO %%AUCTIONPLAYER%% SET
               playerID	= :playerID,
               timestamp	= :timestamp,
               beginTime	= :beginTime,
               endTime	= :endTime,
               itemID	= :itemID,
							 elementID = :elementID;";

				$db->insert($sql, array(
			      	':playerID'			=> $USER['id'],
			      	':timestamp'			=> TIMESTAMP,
				      ':beginTime'			=> TIMESTAMP + $TotalTime,
				      ':endTime'		=> TIMESTAMP + $TotalTime - $itemIdBTW,
				      ':itemID'			=> $itemId,
					    ':elementID'	=> $Element
				));
			}
		}
		$sql	= "UPDATE %%USERS%% SET ".$UName." = ".$UName." - :UName WHERE id = :userId;";
		$db->update($sql, array(
			':UName'	=> 1, 
			':userId'	=> $USER['id'] 
		));		 
	}else{
		$PName = "auction_item_".$itemId."_timer";
		$PNames = $PLANET[$PName];
		if($PNames >= TIMESTAMP){
			$NewLevel	= 7 * 3600 * 24;
			$sql	= "UPDATE %%PLANETS%% SET ".$PName." = ".$PName." + :PName WHERE id = :planetId;";
			$db->update($sql, array(
			':PName'	=> $NewLevel, 
			':planetId'	=> $PLANET['id'] 
			));
		}else{
			$NewLevel	= TIMESTAMP + 7 * 3600 * 24;
			$sql	= "UPDATE %%PLANETS%% SET ".$PName." = :PName WHERE id = :planetId;";
			$db->update($sql, array(
			':PName'	=> $NewLevel, 
			':planetId'	=> $PLANET['id'] 
			));
		}
		
		$sql	= "UPDATE %%USERS%% SET ".$UName." = ".$UName." - :UName WHERE id = :userId;";
		$db->update($sql, array(
			':UName'	=> 1, 
			':userId'	=> $USER['id'] 
		));
	}

	$this->printMessage('ok', true, array('game.php?page=auctioneer&mode=inventory', 3));
	
	}
	
	function inventory()
	{
		global $LNG, $resource, $USER, $PLANET, $pricelist;
		//if($USER['id'] != 1){
		//$this->printMessage('You are currently not allowed to view this page', true, array('game.php?page=overview', 2));
		//}
	
	
		$ItemTiMe = 0;
		$ItemTiCr = 0;
        $ItemTiDe =	0;	
		
		$ItemTiMe = $PLANET['auction_item_1_timer'];
		if($PLANET['auction_item_2_timer'] > TIMESTAMP){
		$ItemTiMe = $PLANET['auction_item_2_timer'];	
		}elseif($PLANET['auction_item_3_timer'] > TIMESTAMP){
		$ItemTiMe = $PLANET['auction_item_3_timer'];	
		}
		
		$ItemTiCr = $PLANET['auction_item_4_timer'];
		if($PLANET['auction_item_5_timer'] > TIMESTAMP){
		$ItemTiCr = $PLANET['auction_item_5_timer'];	
		}elseif($PLANET['auction_item_6_timer'] > TIMESTAMP){
		$ItemTiCr = $PLANET['auction_item_6_timer'];	
		}
		
		$ItemTiDe = $PLANET['auction_item_7_timer'];
		if($PLANET['auction_item_8_timer'] > TIMESTAMP){
		$ItemTiDe = $PLANET['auction_item_8_timer'];	
		}elseif($PLANET['auction_item_9_timer'] > TIMESTAMP){
		$ItemTiDe = $PLANET['auction_item_9_timer'];	
		}
		
		$itemMetal=0;
		$itemCrystal=0;
		$itemDeuterium=0;
		
		if($PLANET['auction_item_1_timer'] > TIMESTAMP){
			$itemMetal 		= 1;
		}elseif($PLANET['auction_item_2_timer'] > TIMESTAMP){
			$itemMetal 		= 2;
		}elseif($PLANET['auction_item_3_timer'] > TIMESTAMP){
			$itemMetal 		= 3;
		}
		
		if($PLANET['auction_item_4_timer'] > TIMESTAMP){
			$itemCrystal 		= 1;
		}elseif($PLANET['auction_item_5_timer'] > TIMESTAMP){
			$itemCrystal 		= 2;
		}elseif($PLANET['auction_item_6_timer'] > TIMESTAMP){
			$itemCrystal 		= 3;
		}
		
		if($PLANET['auction_item_7_timer'] > TIMESTAMP){
			$itemDeuterium 		= 1;
		}elseif($PLANET['auction_item_8_timer'] > TIMESTAMP){
			$itemDeuterium 		= 2;
		}elseif($PLANET['auction_item_9_timer'] > TIMESTAMP){
			$itemDeuterium 		= 3;
		}
		
		
		$this->assign(array(
			'auction_item_1'		=> $USER['auction_item_1'],
			'auction_item_2'		=> $USER['auction_item_2'],
			'auction_item_3'		=> $USER['auction_item_3'],
			'auction_item_4'		=> $USER['auction_item_4'],
			'auction_item_5'		=> $USER['auction_item_5'],
			'auction_item_6'		=> $USER['auction_item_6'],
			'auction_item_7'		=> $USER['auction_item_7'],
			'auction_item_8'		=> $USER['auction_item_8'],
			'auction_item_9'		=> $USER['auction_item_9'],
			'auction_item_10'		=> $USER['auction_item_10'],
			'auction_item_11'		=> $USER['auction_item_11'],
			'auction_item_12'		=> $USER['auction_item_12'],
			'auction_item_13'		=> $USER['auction_item_13'],
			'auction_item_14'		=> $USER['auction_item_14'],
			'auction_item_15'		=> $USER['auction_item_15'],
			'auction_item_16'		=> $USER['auction_item_16'],
			'auction_item_17'		=> $USER['auction_item_17'],
			'auction_item_18'		=> $USER['auction_item_18'],
			'auction_item_19'		=> $USER['auction_item_19'],
			'auction_item_20'		=> $USER['auction_item_20'],
			'auction_item_21'		=> $USER['auction_item_21'],
			'ItemTiMe'		=> pretty_time($ItemTiMe-TIMESTAMP),
			'ItemTiCr'		=> pretty_time($ItemTiCr-TIMESTAMP),
			'ItemTiDe'		=> pretty_time($ItemTiDe-TIMESTAMP),
			'ItemTiMeb'		=> $ItemTiMe-TIMESTAMP,
			'ItemTiCrb'		=> $ItemTiCr-TIMESTAMP,
			'ItemTiDeb'		=> $ItemTiDe-TIMESTAMP,
			'itemMetal'		=> $itemMetal,
			'itemCrystal'		=> $itemCrystal,
			'itemDeuterium'		=> $itemDeuterium,
		));
		
		$this->display('page.auctioneer.inventory.tpl'); 
	}
	
	function show()
	{
	
		global $LNG, $resource, $USER, $PLANET, $pricelist;
		
		//if($USER['id'] != 1){
		//	$this->printMessage('This page is currently not accesible.', true, array('game.php?page=overview', 2));
		//}
			
		$db	= Database::get();
		
		$sql	= 'SELECT total_rank FROM %%STATPOINTS%% WHERE id_owner = :userId AND stat_type = 1;';
		$statData	= Database::get()->selectSingle($sql, array(
			':userId'	=> $USER['id']
		));
		//$PageOfPlayer = floor(1 / config::get()->users_amount * $statData['total_rank'] * round(config::get()->users_amount / 100));
		$PageOfPlayer = 0;

		$sql	= 'SELECT * FROM %%AUCTIONACTIVE%% WHERE auctionPage = :auctionPage ORDER BY endTime DESC LIMIT 1;';
		$AUCTIONDETAILS = $db->selectSingle($sql, array(
			':auctionPage'	=> $PageOfPlayer,
		));
		
		$sql	= 'SELECT * FROM %%AUCTIONLOG%% WHERE auctionPage = :auctionPage ORDER BY total_bid DESC LIMIT 1;';
		$AUCTIONLOGS = $db->selectSingle($sql, array(
			':auctionPage'	=> $PageOfPlayer,
		));
		
		$sql	= 'SELECT * FROM %%AUCTIONLOG%% WHERE auctionPage = :auctionPage;';
		$AUCTIONCOUNT = $db->select($sql, array(
			':auctionPage'	=> $PageOfPlayer,
		));
		
		$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
		$USERINFO = $db->selectSingle($sql, array(
		':userId' => $AUCTIONLOGS['userId']
		));
		
		if(empty($AUCTIONDETAILS))
			$this->printMessage('The auctioneer will open at 06:00.', true, array('game.php?page=overview', 2));
		
		$BonusItem = 0;
		if($AUCTIONDETAILS['itemId'] == 1 || $AUCTIONDETAILS['itemId'] == 4 || $AUCTIONDETAILS['itemId'] == 7){
			$BonusItem = '+10%';
		}elseif($AUCTIONDETAILS['itemId'] == 2 || $AUCTIONDETAILS['itemId'] == 5 || $AUCTIONDETAILS['itemId'] == 8){
			$BonusItem = '+30%';
		}elseif($AUCTIONDETAILS['itemId'] == 3 || $AUCTIONDETAILS['itemId'] == 6 || $AUCTIONDETAILS['itemId'] == 9){
			$BonusItem = '+50%';
		}elseif($AUCTIONDETAILS['itemId'] == 10 || $AUCTIONDETAILS['itemId'] == 13 || $AUCTIONDETAILS['itemId'] == 16 || $AUCTIONDETAILS['itemId'] == 19){
			$BonusItem = '-30 min.';
		}elseif($AUCTIONDETAILS['itemId'] == 11 || $AUCTIONDETAILS['itemId'] == 14 || $AUCTIONDETAILS['itemId'] == 17 || $AUCTIONDETAILS['itemId'] == 20){
			$BonusItem = '-1 h.';
		}elseif($AUCTIONDETAILS['itemId'] == 12 || $AUCTIONDETAILS['itemId'] == 15 || $AUCTIONDETAILS['itemId'] == 18 || $AUCTIONDETAILS['itemId'] == 21){
			$BonusItem = '-2 h.';
		}

		$dating = date("m/d/Y", TIMESTAMP);
		
		$daters = strtotime('now');
		$datersxx =  date('H', $daters);
		$datersss =  date('i', $daters);
		$daters =  date('H', $daters);
		
		
		if(Config::get()->auctioneer_closure == 0){
			if($daters < 23 && $daters > 06){ 
				$daters += 1;
			}elseif($daters == 23 && $datersss < 30){ 
				$daters += 1;
			}else{
				$daters = '06';
				if($datersxx == 23){ 
					$dating = strtotime('tomorrow');
					$dating = date("m/d/Y", $dating);
				}
			}
		}else{
			if($daters == 23 && $datersss > 30){ 
			$dating = strtotime('tomorrow');
			$dating = date("m/d/Y", $dating);
			$daters = '00';
			}else{
			$daters += 1;
			}
		}
		$sendGift = $AUCTIONDETAILS['endTime'] > TIMESTAMP ? 0 : 1;
		if($sendGift == 1 && $AUCTIONDETAILS['giftSend'] == 0 && !empty($AUCTIONLOGS)){
			$Name = "auction_item_".$AUCTIONDETAILS['itemId'];
			$sql	= "UPDATE %%USERS%% SET ".$Name." = ".$Name." + :level WHERE id = :userId;";
			$db->update($sql, array(
				':level'	=> config::get()->auctionerItems,
				':userId'	=> $USERINFO['id']
				
			));	
			$sql	= "UPDATE %%AUCTIONACTIVE%% SET giftSend =  :giftSend, amountBid = :amountBid, highestBidder = :highestBidder WHERE auctionId = :auctionId;";
			$db->update($sql, array(
				':giftSend'			=> 1,
				':amountBid'		=> $AUCTIONLOGS['total_bid'],
				':auctionId'		=> $AUCTIONDETAILS['auctionId'],
				':highestBidder'	=> $USERINFO['id']
			));	
		}
			
		$this->tplObj->loadscript('auctioneer.js');	 
		$this->assign(array(
			'isActive'		=> 	$AUCTIONDETAILS['endTime'] > TIMESTAMP ? 0 : 1,
			'isitem'		=> 	$AUCTIONDETAILS['itemId'],
			'total_bid'		=> 	$AUCTIONLOGS['total_bid'] != '' ? $AUCTIONLOGS['total_bid'] : 0,
			'total_count'	=> 	$AUCTIONDETAILS['bidCount'],
			'bid_username'	=> 	$USERINFO['username'],
			'BonusItem'		=> 	$BonusItem,
			'dating'		=> 	$dating,
			'daters'		=> 	$daters,
		));
			
		$this->display('page.auctioneer.default.tpl'); 
	}
}