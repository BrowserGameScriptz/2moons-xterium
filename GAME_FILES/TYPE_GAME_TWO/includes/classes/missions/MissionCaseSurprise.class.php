<?php

class MissionCaseSurprise extends MissionFunctions implements Mission
{
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{
		$this->setState(FLEET_HOLD);
		$this->SaveFleet();
	}
	
	function EndStayEvent()
	{
		
		global $pricelist, $resource;
		
		$LNG	= $this->getLanguage(NULL, $this->_fleet['fleet_owner']);
		
		$config	= Config::get($this->_fleet['fleet_universe']);

		$sql	= 'SELECT * FROM %%SUPRIMOEVENT%% WHERE galaxy = :galaxy AND system = :system AND createdTime > :createdTime;';
		$suprimoEvent	= database::get()->selectSingle($sql, array(
			':galaxy'		=> $this->_fleet['fleet_end_galaxy'],
			':system'		=> $this->_fleet['fleet_end_system'],
			':createdTime'	=> TIMESTAMP - 3600*24
		));
		
		$sql	= 'SELECT * FROM %%SUPRIMOLOGS%% WHERE galaxy = :galaxy AND system = :system AND playerId = :playerId;';
		$suprimoCheckLogs	= database::get()->selectSingle($sql, array(
			':galaxy'		=> $this->_fleet['fleet_end_galaxy'],
			':system'		=> $this->_fleet['fleet_end_system'],
			':playerId'		=> $this->_fleet['fleet_owner']
		));
		
		$sql			= "SELECT * FROM %%USERS%% WHERE id = :userId;";
		$ownerUser		= Database::get()->selectSingle($sql, array(
			':userId'	=> $this->_fleet['fleet_owner']
		));
		
		if(empty($suprimoEvent) || !empty($suprimoCheckLogs) && $suprimoCheckLogs['checkTime'] > TIMESTAMP - 12 * 3600){
			PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 5, "Special Star [".$this->_fleet['fleet_end_galaxy'].":".$this->_fleet['fleet_end_system']."]", "This special star does not exist anymore or you did already visit it recently.", TIMESTAMP, NULL, 1, $this->_fleet['fleet_universe']);
			$this->setState(FLEET_RETURN);
			$this->SaveFleet();
		}else{
			$sql	= 'INSERT INTO %%SUPRIMOLOGS%% SET galaxy = :galaxy, system = :system, playerId = :playerId, checkTime = :checkTime;';
			database::get()->insert($sql, array(
				':galaxy'		=> $this->_fleet['fleet_end_galaxy'],
				':system'		=> $this->_fleet['fleet_end_system'],
				':playerId'		=> $this->_fleet['fleet_owner'],
				':checkTime'	=> TIMESTAMP
			));
			
			$userdarkmatter  	= 0;
			$academyPoints  	= 0;
			$fleetCapacity	 	= 0;
			$fleetPoints	 	= 0;
			$academy_p_b_2_1207	= 0;
			$Message			= "";
			
			$fleetArray		= FleetFunctions::unserialize($this->_fleet['fleet_array']);
			foreach ($fleetArray as $shipId => $shipAmount)
			{
				$fleetCapacity 			   	+= $shipAmount * $pricelist[$shipId]['capacity'];
				$fleetPoints   			   	+= $shipAmount * $pricelist[$shipId]['fleetPointExpe'];
			}
			
			if($ownerUser['academy_p_b_2_1207'] > 0){
				$academy_p_b_2_1207 = $ownerUser['academy_p_b_2_1207'] * 5;
			}
				
			$fleetCapacity += $fleetCapacity / 100 * $academy_p_b_2_1207;
			$fleetCapacity -= $this->_fleet['fleet_resource_metal'] + $this->_fleet['fleet_resource_crystal'] + $this->_fleet['fleet_resource_deuterium'] + $this->_fleet['fleet_resource_darkmatter'];
			
			//Light auctioneer item
			if($suprimoEvent['gift_item_light'] == 1){
				$itemsLight			= array('auction_item_1', 'auction_item_4', 'auction_item_7', 'auction_item_10', 'auction_item_13', 'auction_item_16', 'auction_item_19');
				$selectTypeLight 	= mt_rand(0,6);
				$selectedEndVersion = explode('_', $itemsLight[$selectTypeLight]);
				$Message			.= '<li>x1 '.$LNG['auctioneer_booster'][$selectedEndVersion[2]].'</li>';
				$sql	= "UPDATE %%USERS%% SET ".$itemsLight[$selectTypeLight]." = ".$itemsLight[$selectTypeLight]." + 1 WHERE id = :userId;";
				database::get()->update($sql, array(
					':userId'	=> $this->_fleet['fleet_owner']
				));
			}
			
			//Medium auctioneer item
			if($suprimoEvent['gift_item_medium'] == 1){
				$itemsMedium		= array('auction_item_2', 'auction_item_5', 'auction_item_8', 'auction_item_11', 'auction_item_14', 'auction_item_17', 'auction_item_20');
				$selectTypeMedium 	= mt_rand(0,6);
				$selectedEndVersion = explode('_', $itemsMedium[$selectTypeMedium]);
				$Message			.= '<li>x1 '.$LNG['auctioneer_booster'][$selectedEndVersion[2]].'</li>';
				$sql	= "UPDATE %%USERS%% SET ".$itemsMedium[$selectTypeMedium]." = ".$itemsMedium[$selectTypeMedium]." + 1 WHERE id = :userId;";
				database::get()->update($sql, array(
					':userId'	=> $this->_fleet['fleet_owner']
				));
			}
			
			//Heavy auctioneer item
			if($suprimoEvent['gift_item_heavy'] == 1){
				$itemsHeavy			= array('auction_item_3', 'auction_item_6', 'auction_item_9', 'auction_item_12', 'auction_item_15', 'auction_item_18', 'auction_item_21');
				$selectTypeHeavy 	= mt_rand(0,6);
				$selectedEndVersion = explode('_', $itemsHeavy[$selectTypeHeavy]);
				$Message			.= '<li>x1 '.$LNG['auctioneer_booster'][$selectedEndVersion[2]].'</li>';
				$sql	= "UPDATE %%USERS%% SET ".$itemsHeavy[$selectTypeHeavy]." = ".$itemsHeavy[$selectTypeHeavy]." + 1 WHERE id = :userId;";
				database::get()->update($sql, array(
					':userId'	=> $this->_fleet['fleet_owner']
				));
			}
			
			//Light arsenal item
			if($suprimoEvent['gift_arsenal_light'] == 1){
				$arsenalLight		= array('arsenal_combustion', 'arsenal_slight', 'arsenal_res901', 'arsenal_dlight', 'arsenal_conveyor1', 'arsenal_laser', 'arsenal_ion');
				$selectTypeLight 	= mt_rand(0,6);	
				$Message			.= '<li>'.sprintf($LNG[$arsenalLight[$selectTypeLight]], 1).'</li>';
				$sql	= "UPDATE %%USERS%% SET ".$arsenalLight[$selectTypeLight]." = ".$arsenalLight[$selectTypeLight]." + 1 WHERE id = :userId;";
				database::get()->update($sql, array(
					':userId'	=> $this->_fleet['fleet_owner']
				));
			}
			
			//Medium arsenal item
			if($suprimoEvent['gift_arsenal_medium'] == 1){
				$arsenalMediu		= array('arsenal_impulse', 'arsenal_smedium', 'arsenal_res902', 'arsenal_dmedium', 'arsenal_conveyor2', 'arsenal_plasma');
				$selectTypeMedium	= mt_rand(0,5);			
				$Message			.= '<li>'.sprintf($LNG[$arsenalMediu[$selectTypeMedium]], 1).'</li>';
				$sql	= "UPDATE %%USERS%% SET ".$arsenalMediu[$selectTypeMedium]." = ".$arsenalMediu[$selectTypeMedium]." + 1 WHERE id = :userId;";
				database::get()->update($sql, array(
					':userId'	=> $this->_fleet['fleet_owner']
				));
			}
			
			//Heavy arsenal item
			if($suprimoEvent['gift_arsenal_heavy'] == 1){
				$arsenalHeavy		= array('arsenal_hyperspace', 'arsenal_sheavy', 'arsenal_res903', 'arsenal_dheavy', 'arsenal_conveyor3', 'arsenal_gravity');
				$selectTypeHeavy	= mt_rand(0,5);
				$Message			.= '<li>'.sprintf($LNG[$arsenalHeavy[$selectTypeHeavy]], 1).'</li>';
				$sql	= "UPDATE %%USERS%% SET ".$arsenalHeavy[$selectTypeHeavy]." = ".$arsenalHeavy[$selectTypeHeavy]." + 1 WHERE id = :userId;";
				database::get()->update($sql, array(
					':userId'	=> $this->_fleet['fleet_owner']
				));
			}
			
			//Darkmatter
			if($suprimoEvent['gift_darkmatter'] == 1){
				$DMSize		= mt_rand(0, 100);
				if(0 == $DMSize){
					$userdarkmatter	+= 5000000;
				}elseif(0 < $DMSize && 10 >= $DMSize){
					$userdarkmatter	+= 2000000;
				}elseif(10 < $DMSize && 30 >= $DMSize){
					$userdarkmatter	+= 1000000;
				}elseif(30 < $DMSize && 50 >= $DMSize){
					$userdarkmatter	+= 500000;
				}else{
					$userdarkmatter	+= 250000;
				}
				$this->UpdateFleet('fleet_resource_darkmatter', $this->_fleet['fleet_resource_darkmatter'] + min($userdarkmatter, $fleetCapacity));
				$Message .= '<li>'.$LNG['tech'][921].': '.pretty_number($userdarkmatter).'</li>';
			}
			
			//Academy Points
			if($suprimoEvent['gift_academy'] == 1){
				$AcademySize		= mt_rand(0, 100);
				if(0 == $AcademySize){
					$academyPoints	+= 50;
				}elseif(0 < $AcademySize && 10 >= $AcademySize){
					$academyPoints	+= 25;
				}elseif(10 < $AcademySize && 40 >= $AcademySize){
					$academyPoints	+= 15;
				}elseif(40 < $AcademySize && 60 >= $AcademySize){
					$academyPoints	+= 5;
				}elseif(60 < $AcademySize){
					$academyPoints	+= 1;
				}
				$sql	= "UPDATE %%USERS%% SET academy_p = academy_p + :academy_p WHERE id = :userId;";
				database::get()->update($sql, array(
					':academy_p'	=> $academyPoints,
					':userId'		=> $this->_fleet['fleet_owner']
				));
				$Message .= '<li>'.$LNG['premium_5'].': '.pretty_number($academyPoints).'</li>';	
			}
			
			//Resource - Metal
			if($suprimoEvent['gift_resource_metal'] == 1){
				//INGREDIENT FORMULE
				$gameSpeed 			= 200; // Indicateur sur le serveur - Le taux d'extraction des ressources
				$FactorWeightPoint 	= 1 + $config->resource_multiplier / 100;
				$FactorMaxRess		= 5 + $config->resource_multiplier / 50;
				$eventAction		= 0; // variable to add in admin panel to add automatic events for expeditions
				$randomValue		= mt_rand(0,100);
				$BonusRees 			= 0;
				if(89 <= $randomValue){
					$FactorRessMetal 		= mt_rand(10,50) * $config->resource_multiplier * $FactorMaxRess;
					$MaxFleetPoints			= 9000000 * $FactorWeightPoint;
				}elseif(1 < $randomValue && 89 > $randomValue){
					$FactorRessMetal 		= mt_rand(52,100) * $config->resource_multiplier * $FactorMaxRess;
					$MaxFleetPoints			= 10000000 * $FactorWeightPoint;
				}elseif(0 <= $randomValue && 2 > $randomValue){
					$FactorRessMetal 		= mt_rand(102,200) * $config->resource_multiplier * $FactorMaxRess;
					$MaxFleetPoints			= 12000000 * $FactorWeightPoint;	
				}
				
				$FindableMetal 		= $FactorRessMetal * max(min($fleetPoints / (30 * $FactorWeightPoint ), $MaxFleetPoints ), 200);
				$FindableMetal 		+= $FindableMetal / 100 * $BonusRees;
			
				$fleetColMetal		= 'fleet_resource_metal';
				$this->UpdateFleet($fleetColMetal, $this->_fleet[$fleetColMetal] + min($FindableMetal, $fleetCapacity));
				$Message .= '<li>'.$LNG['tech'][901].': '.pretty_number(min($FindableMetal, $fleetCapacity)).'</li>';
				$fleetCapacity -= min($FindableMetal, $fleetCapacity);
			}
			
			//Resource - Crystal
			if($suprimoEvent['gift_resource_crystal'] == 1){
				//INGREDIENT FORMULE
				$gameSpeed 			= 200; // Indicateur sur le serveur - Le taux d'extraction des ressources
				$FactorWeightPoint 	= 1 + $config->resource_multiplier / 100;
				$FactorMaxRess		= 5 + $config->resource_multiplier / 50;
				$eventAction		= 0; // variable to add in admin panel to add automatic events for expeditions
				$randomValue		= mt_rand(0,100);
				$BonusRees 			= 0;
				if(89 <= $randomValue){
					$FactorRessCristal 		= mt_rand(5,25) * $config->resource_multiplier * $FactorMaxRess;
					$MaxFleetPoints			= 9000000 * $FactorWeightPoint;
				}elseif(1 < $randomValue && 89 > $randomValue){
					$FactorRessCristal 		= mt_rand(26,50) * $config->resource_multiplier * $FactorMaxRess;
					$MaxFleetPoints			= 10000000 * $FactorWeightPoint;
				}elseif(0 <= $randomValue && 2 > $randomValue){
					$FactorRessCristal 		= mt_rand(51,100) * $config->resource_multiplier * $FactorMaxRess;
					$MaxFleetPoints			= 12000000 * $FactorWeightPoint;	
				}
				
				$FindableCristal 	= $FactorRessCristal * max(min($fleetPoints / (30 * $FactorWeightPoint ), $MaxFleetPoints ), 200);
				$FindableCristal 	+= $FindableCristal / 100 * $BonusRees;
				
				$fleetColCristal		= 'fleet_resource_crystal';
				$this->UpdateFleet($fleetColCristal, $this->_fleet[$fleetColCristal] + min($FindableCristal, $fleetCapacity));
				$Message .= '<li>'.$LNG['tech'][902].': '.pretty_number(min($FindableCristal, $fleetCapacity)).'</li>';	
				$fleetCapacity -= min($FindableCristal, $fleetCapacity);
			}
			
			//Resource - Deuterium
			if($suprimoEvent['gift_resource_deuterium'] == 1){
				//INGREDIENT FORMULE
				$gameSpeed 			= 200; // Indicateur sur le serveur - Le taux d'extraction des ressources
				$FactorWeightPoint 	= 1 + $config->resource_multiplier / 100;
				$FactorMaxRess		= 5 + $config->resource_multiplier / 50;
				$eventAction		= 0; // variable to add in admin panel to add automatic events for expeditions
				$randomValue		= mt_rand(0,100);
				$BonusRees 			= 0;
				if(89 <= $randomValue){
					$FactorRessDeutérium 	= (mt_rand(33,167)/10) * $config->resource_multiplier * $FactorMaxRess;
					$MaxFleetPoints			= 9000000 * $FactorWeightPoint;
				}elseif(1 < $randomValue && 89 > $randomValue){
					$FactorRessDeutérium 	= (mt_rand(173,333)/10) * $config->resource_multiplier * $FactorMaxRess;
					$MaxFleetPoints			= 10000000 * $FactorWeightPoint;
				}elseif(0 <= $randomValue && 2 > $randomValue){
					$FactorRessDeutérium 	= (mt_rand(340,667)/10) * $config->resource_multiplier * $FactorMaxRess;
					$MaxFleetPoints			= 12000000 * $FactorWeightPoint;	
				}
				
				$FindableDeuterium 	= $FactorRessDeutérium * max(min($fleetPoints / (30 * $FactorWeightPoint ), $MaxFleetPoints ), 200);
				$FindableDeuterium 	+= $FindableDeuterium / 100 * $BonusRees;
				
				$fleetColDeuterium		= 'fleet_resource_deuterium';
				$this->UpdateFleet($fleetColDeuterium, $this->_fleet[$fleetColDeuterium] + min($FindableDeuterium, $fleetCapacity));
				$Message .= '<li>'.$LNG['tech'][903].': '.pretty_number(min($FindableDeuterium, $fleetCapacity)).'</li>';	
				$fleetCapacity -= min($FindableDeuterium, $fleetCapacity);
			}
			
			PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 5, "Special Star [".$this->_fleet['fleet_end_galaxy'].":".$this->_fleet['fleet_end_system']."]", $LNG['bonus_receive'].':<br><ul>'.$Message.'</ul>', TIMESTAMP, NULL, 1, $this->_fleet['fleet_universe']);
			$this->setState(FLEET_RETURN);
			$this->SaveFleet();
		}
	}
	
	function ReturnEvent()
	{
		$LNG				= $this->getLanguage(NULL, $this->_fleet['fleet_owner']);

		$Message     		= sprintf($LNG['sys_expe_back_home'],
			$LNG['tech'][901], pretty_number($this->_fleet['fleet_resource_metal']),
			$LNG['tech'][902], pretty_number($this->_fleet['fleet_resource_crystal']),
			$LNG['tech'][903], pretty_number($this->_fleet['fleet_resource_deuterium']),
			$LNG['tech'][921], pretty_number($this->_fleet['fleet_resource_darkmatter'])
		);

		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 5, $LNG['sys_mess_fleetback'],
			$Message, TIMESTAMP, NULL, 1, $this->_fleet['fleet_universe']);
		$this->RestoreFleet();
	}
}