<?php

class ShowGestionPage extends AbstractGamePage
{
            
	function __construct() 
	{
		parent::__construct();
	}
	
	function show(){
	
	global $LNG, $resource, $USER, $PLANET, $pricelist;
		
	$PlanetListin	= array();
	$order = $USER['planet_sort_order'] == 1 ? "ASC" : "ASC" ;

	if (!empty($_POST)){
	$message = '';
	foreach ($_POST as $var => $val){

    if (strpos($var, 'classement_') !== false)
    {
        // Là tu sais que c'est un de tes nombreux select et $val égal l'ordre que ton user a défini pour cet élement
        $id = str_replace('classement_', '', $var);
        $ordre = $val;
		$message .= $ordre;
		$sql = "UPDATE  %%PLANETS%% SET plaPosition = :plaPosition WHERE id = :id;";
		Database::get()->update($sql, array(
		':plaPosition'		=> $ordre,
		':id'	=> $id
		));
    }
	}
	}
	
	$sql = "SELECT * FROM %%PLANETS%% WHERE id_owner = :userId AND destruyed = :destruyed ORDER BY ";

	switch($USER['planet_sort'])
	{
		case 0:
			$sql	.= 'plaPosition '.$order;
			break;
		case 1:
			$sql	.= 'plaPosition '.$order;
			break;
		case 2:
			$sql	.= 'plaPosition '.$order;
			break;
	}
	
	$planetsResult = Database::get()->select($sql, array(
		':userId'		=> $USER['id'],
		':destruyed'	=> 0
   	));

    $planetsList = array();
	$number = 0;
	foreach($planetsResult as $planetRow) {
	
		$PlanetListin[$planetRow['id']] = array(
				'name'					=> $planetRow['name'],
				'galaxy'				=> $planetRow['galaxy'],
				'system'				=> $planetRow['system'],
				'planet'				=> $planetRow['planet'],
				'luna'					=> $planetRow['id_luna'],
				'image'					=> $planetRow['image'],
				'plaPosition'			=> $planetRow['plaPosition'],
			);	
	$number++;
	}
		
	$this->tplObj->loadscript('deliveryres.js');
	$this->assign(array(
	'PlanetListin'		=> $PlanetListin,
	'planetsResult'		=> count($planetsResult),
	'number'			=> $number,
	));
		
	$this->display('page.planetorder.default.tpl');
	}
}