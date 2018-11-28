<?php

require_once 'includes/classes/cronjob/CronjobTask.interface.php';
class GalaxySevenCheckCronjob implements CronjobTask
{	
	function run()
	{		
		$sql	= "UPDATE %%PLANETS%% SET destruyed = :destruyed WHERE expiredTime <= :expiredTime AND gal6mod = 1;";
		database::get()->update($sql, array(
			':expiredTime' 	=> TIMESTAMP,
			':destruyed' 	=> TIMESTAMP
		));		
	}
}