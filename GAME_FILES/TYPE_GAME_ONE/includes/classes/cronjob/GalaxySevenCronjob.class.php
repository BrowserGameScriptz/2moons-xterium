<?php

require_once 'includes/classes/cronjob/CronjobTask.interface.php';
class GalaxySevenCronjob implements CronjobTask
{	
	
	function randRange($min, $max, $count)
	{
		$range 	= array();
		$i			= 0;
		while($i++ < $count){
			while(in_array($num = mt_rand($min, $max), $range)){}
			$range[] = $num;
		}
		return $range;
	}
	
	function run()
	{		
		$sql	= "DELETE FROM %%PLANETS%% WHERE expiredTime <= :expiredTime AND gal6mod = 1;";
		database::get()->delete($sql, array(
			':expiredTime' => TIMESTAMP
		));
		
		$SystemMin	= array(1,51,101,151,201,251,301,351,401,451);
		$SystemMax	= array(50,100,150,200,250,300,350,400,450,500);
		
		for ($x = 0; $x <= 9; $x++) {
    	$sql = "SELECT COUNT(*) as count FROM %%PLANETS%% WHERE gal6mod = 1 AND expiredTime > :expiredTime AND system <= :MaxSystem AND system >= :systemMin;";
			$countPlanets = database::get()->selectSingle($sql, array(
				':expiredTime'  => TIMESTAMP,
				':MaxSystem'  	=> $SystemMax[$x],
				':systemMin'  	=> $SystemMin[$x],
			), 'count');
			
			if($countPlanets < 45){
				$galaxy = config::get()->max_galaxy;
				$MaxAdd = 45 - $countPlanets;
				$system = $this->randRange($SystemMin[$x],$SystemMax[$x],$MaxAdd);
				
				foreach($system as $System_Element){
					$planets = rand(1,20);
					$sql	= "SELECT * FROM %%PLANETS%% WHERE galaxy = :galaxy AND system = :system AND planet = :planet AND universe = 1;";
					$cautare = database::get()->select($sql, array(
						':galaxy'		=> $galaxy,
						':system'		=> $System_Element,
						':planet'		=> $planets,
					));
					if(count($cautare)==0){
						
						$planetData			= array();
						require 'includes/PlanetData.php';
						
						$config				= Config::get(1);
						$dataIndex			= (int) ceil($planets / ($config->max_planets / count($planetData)));
						$maxTemperature		= $planetData[$dataIndex]['temp2'];
						$minTemperature		= $planetData[$dataIndex]['temp'];
						$maxFields			= (int) floor($planetData[$dataIndex]['fields'] * $config->planet_factor);
						
						$diameter			= (int) floor(1000 * sqrt($maxFields));

						$imageNames			= array_keys($planetData[$dataIndex]['image']);
						$imageNameType		= $imageNames[array_rand($imageNames)];
						$imageName			= $imageNameType;
						$imageName			.= 'planet';
						$imageName			.= $planetData[$dataIndex]['image'][$imageNameType] < 10 ? '0' : '';
						$imageName			.= $planetData[$dataIndex]['image'][$imageNameType];

						$Names				= file('botnames.txt');
						$NamesCount			= count($Names);
						$Rand				= mt_rand(0, $NamesCount);
						//$PlanetName			= trim($Names[$Rand]);
						$PlanetName			= "Galaxy7";
						
						$sql = "INSERT INTO %%PLANETS%% SET name = :name, id_owner = :id_owner, universe = 1, galaxy = :galaxy, system = :system, planet = :planet, planet_type = 1, image = :image, diameter = :diameter, last_update = :last_update, gal6mod = 1, gal6type = :gal6type, field_max	= :maxFields, temp_min = :minTemp, temp_max = :maxTemp, expiredTime = :expiredTime, metal = :metal_start, crystal = :crystal_start, deuterium = :deuter_start;";

						database::get()->insert($sql, array(
							':name'				=> $PlanetName,
							':id_owner'			=> NULL,
							':galaxy'			=> $galaxy,
							':system'			=> $System_Element,
							':planet'			=> $planets,
							':image'			=> $imageName,
							':diameter'			=> $diameter,
							':last_update'		=> TIMESTAMP,
							':metal_start'		=> config::get()->metal_start,
							':crystal_start'	=> config::get()->crystal_start,
							':deuter_start'		=> config::get()->deuterium_start,
							':gal6type'			=> ($x * 100) + mt_rand(1,9),
							':maxFields'		=> $maxFields,
							':minTemp'			=> $minTemperature,
							':maxTemp'			=> $maxTemperature,
							':expiredTime'		=> TIMESTAMP + 5 * 24 * 3600,
						));
					}
				}
			}
		} 
	}
}