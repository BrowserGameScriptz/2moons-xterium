<?php

require_once 'includes/classes/cronjob/CronjobTask.interface.php';

class marketItemsCronjob implements CronjobTask
{
	function run()
	{				

		$planetUpgradeArray = array('laser', 'ion', 'plasma', 'gravity', 'dlight', 'dmedium', 'dheavy', 'slight', 'smedium', 'sheavy', 'combustion', 'impulse', 'hyperspace', 'res901', 'res902', 'res903', 'conveyor1', 'conveyor2', 'conveyor3');
		$planetItemsArray 	= array('auction_item_1', 'auction_item_2', 'auction_item_3', 'auction_item_4', 'auction_item_5', 'auction_item_6', 'auction_item_7', 'auction_item_8', 'auction_item_9', 'auction_item_10', 'auction_item_11', 'auction_item_12', 'auction_item_13', 'auction_item_14', 'auction_item_15', 'auction_item_16', 'auction_item_17','auction_item_18', 'auction_item_19', 'auction_item_20', 'auction_item_21',);
		
		for( $i= 1 ; $i <= 5 ; $i++){
			
			$randCountUpgrade = mt_rand(1,10);
			$randCountItem	  = mt_rand(1,10);
			
			$sql = "INSERT INTO %%PLANETUPGRADE%% SET
				upgradeName			= :upgradeName,
				upgradeCount		= :upgradeCount,
				upgradePrice		= :upgradePrice,
				upgradeTime			= :upgradeTime,
				upgradeOwner		= 1,
				upgradeUni			= 1;";

			database::get()->insert($sql, array(
				':upgradeName'		=> $planetUpgradeArray[mt_rand(0,18)],
				':upgradeCount'		=> $randCountUpgrade,
				':upgradePrice'		=> $randCountUpgrade < 4 ? mt_rand(7500,25000) : ($randCountUpgrade < 7 ? mt_rand(15000,35000) : mt_rand(25000,50000)),
				':upgradeTime'		=> TIMESTAMP
			));
			
			$sql = "INSERT INTO %%PLANETITEMS%% SET
				upgradeName			= :upgradeName,
				upgradeCount		= :upgradeCount,
				upgradePrice		= :upgradePrice,
				upgradeTime			= :upgradeTime,
				upgradeOwner		= 1,
				upgradeUni			= 1;";

			database::get()->insert($sql, array(
				':upgradeName'		=> $planetItemsArray[mt_rand(0,20)],
				':upgradeCount'		=> $randCountItem,
				':upgradePrice'		=> $randCountItem < 4 ? mt_rand(7500,25000) : ($randCountItem < 7 ? mt_rand(15000,35000) : mt_rand(25000,50000)),
				':upgradeTime'		=> TIMESTAMP
			));
			
		}
	}
}