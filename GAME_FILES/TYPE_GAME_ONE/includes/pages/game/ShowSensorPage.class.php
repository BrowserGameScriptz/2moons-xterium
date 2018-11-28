<?php

class ShowSensorPage extends AbstractGamePage
{
	public static $requireModule = MODULE_PHALANX;
	
	static function allowSensor()
	{
		global $PLANET, $resource;

		if ($PLANET['isAlliancePlanet'] == 0 || $PLANET[$resource[51]] == 0 || !isModuleAvailable(MODULE_PHALANX) || $USER['ally_id'] < 2) {
			return false;
		}
		
		return true;
	}

	static function GetSensorRange($SensorLevel)
	{
		return ($SensorLevel == 1) ? 2 : ($SensorLevel * 3) - 1;
	}
	
	function __construct() {
		
	}
	
	function show()
	{
		global $PLANET, $LNG, $resource, $USER;

		$this->initTemplate();
		$this->setWindow('popup');
		$this->tplObj->loadscript('phalanx.js');
						
		$sql = "SELECT * FROM %%DIPLO%% WHERE (owner_1 = :owner_1 AND level = 5 && accept = 1) OR (owner_2 = :owner_1 AND level = 5 && accept = 1);";
		$isDiplo = database::get()->select($sql, array(
			':owner_1'  => $USER['ally_id'],
		));
		
		if(empty($isDiplo))
		{
			$this->printMessage($LNG['sensorMsg1'], NULL, NULL, false);
			exit();
		}elseif(!$this->allowSensor())
		{
			$this->printMessage($LNG['sensorMsg2'], NULL, NULL, false);
		}
		
		$targetAlliance = array();
		foreach($isDiplo as $War){
			$targetAlliance[] = $War['owner_1'];
			if($War['owner_1'] == $USER['ally_id'])
				$targetAlliance[] = $War['owner_2'];
		}
		
		require 'includes/classes/class.FlyingFleetsTable.php';

		$fleetTableObj = new FlyingFleetsTable;
		$fleetTableObj->setSensorMode();
		$fleetTableObj->allyCheck(implode(',', $targetAlliance));
		$fleetTableObj->SetAllyTarget(self::GetSensorRange($PLANET[$resource[51]]));
		$fleetTable	=  $fleetTableObj->renderTable();
		
		$this->assign(array(
			'galaxy'  		=> $Galaxy,
			'system'  		=> $System,
			'planet'   		=> $Planet,
			'name'    		=> $TargetInfo['name'],
			'fleetTable'	=> $fleetTable,
			'isYours'		=> $isYours,
		));
		
		$this->display('page.sensor.default.tpl');			
	}
}