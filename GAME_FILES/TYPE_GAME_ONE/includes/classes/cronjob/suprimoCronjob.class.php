<?php
require_once 'includes/classes/cronjob/CronjobTask.interface.php';

class suprimoCronjob implements CronjobTask
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
		/** @var $langObjects Language[] */
		$langObjects	= array();
		if(config::get()->suprimoEvent < TIMESTAMP){
			$newevkaka 	= TIMESTAMP + 5*60;		
			$sql		= "UPDATE %%CONFIG%% SET suprimoEvent = :suprimoEvent WHERE uni = :uni;";
			database::get()->update($sql, array(
				':suprimoEvent'	=> $newevkaka,
				':uni'			=> 1
			));
			$sql	= "DELETE FROM %%SUPRIMOEVENT%%;";
			database::get()->delete($sql, array());
			
			$Example1 		= 0;
			$Example2 		= 0;
			$possibleGift 	= array("0" => "gift_item_light", "1" => "gift_item_medium", "2" => "gift_item_heavy", "3" => "gift_arsenal_light", "4" => "gift_arsenal_medium", "5" => "gift_arsenal_heavy", "6" => "gift_darkmatter", "7" => "gift_academy", "8" => "gift_resource_metal", "9" => "gift_resource_crystal", "10" => "gift_resource_deuterium");
			
			$galaxy = $this->randRange(1,6,6);
			foreach($galaxy as $Element){
				$system = $this->randRange(1,200,6);
				foreach($system as $System_Element){					
					$sql	= 'SELECT * FROM %%SUPRIMOEVENT%% WHERE galaxy = :galaxy AND system = :system;';
					$suprimoEvent	= database::get()->selectSingle($sql, array(
						':galaxy'	=> $Element,
						':system'	=> $System_Element
					));
					if(empty($suprimoEvent)){						
						$EventNames = array("Suprimo", "Suprimus", "Suprima");
						$EventChoice= array_rand($EventNames,1);
						$rand_keys 	= array_rand($possibleGift, 3);
						$sql = "INSERT INTO %%SUPRIMOEVENT%% SET name = :name, galaxy = :galaxy, system = :system, createdTime = :createdTime, ".$possibleGift[$rand_keys[0]]." = 1, ".$possibleGift[$rand_keys[1]]." = 1, ".$possibleGift[$rand_keys[2]]." = 1;";
						database::get()->insert($sql, array(
							':name'				=> $EventNames[$EventChoice],
							':galaxy'			=> $Element,
							':system'			=> $System_Element,
							':createdTime'		=> TIMESTAMP
						));
						$Example1 = $Element;
						$Example2 = $System_Element;
					}
				}
			}
			
			$sql	= "SELECT DISTINCT id, lang FROM %%USERS%% WHERE onlinetime > :onlinetime";
			$totalPremiums = database::get()->select($sql, array(
				':onlinetime'	=> TIMESTAMP - 7 * 24 * 3600
			));
			foreach($totalPremiums as $userInfo){
				
				if(!isset($langObjects[$userInfo['lang']]))
				{
					$langObjects[$userInfo['lang']]	= new Language($userInfo['lang']);
					$langObjects[$userInfo['lang']]->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
				}
				
				$LNG	= $langObjects[$userInfo['lang']];
				
				$message = '<span class="admin">'.sprintf($LNG['custom_suprimo'], $Example1, $Example2).'
				</span>';
				PlayerUtil::sendMessage($userInfo['id'], '', 'Event System', 50, 'Event Info', $message, TIMESTAMP);
			}
			
		}
		
	}
}