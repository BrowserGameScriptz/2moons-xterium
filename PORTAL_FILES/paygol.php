<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

$secret_key = "b24bd139-c1a8-11e7-ba3e-128b57940774";

if($secret_key != $_GET['key']){
	echo "Validation error"; 
	exit;
}else{
	$custom 			= explode(",", $_GET['custom']);
	$userId 			= isset($custom[0]) ? $custom[0] : 0;
	$usedSaving 		= isset($custom[1]) ? $custom[1] : 0;
	$defaultAmount 		= isset($custom[2]) ? $custom[2] : 0;
	$realDonator 		= isset($custom[3]) ? $custom[3] : 0;
	$currency 			= isset($custom[4]) ? $custom[4] : 0;
	$universe 			= isset($custom[5]) ? $custom[5] : 0;
	$transaction_id 	= isset($_GET['transaction_id']) ? $_GET['transaction_id'] : null;
	$price 				= isset($_GET['price']) ? $_GET['price'] : 0;
	$payment_status		= "Completed";
	$mc_fee				= $price / 100 * 15;
	
	$url="https://".$universe.".warofgalaxyz.com/paygol.php";  
	$postdata = "userId=".$userId."&usedSaving=".$usedSaving."&defaultAmount=".$defaultAmount."&realDonator=".$realDonator."&currency=".$currency."&transaction_id=".$transaction_id."&price=".$price."&mc_fee=".$mc_fee."&key=".$_GET['key']; 

	$ch = curl_init(); 
	curl_setopt ($ch, CURLOPT_URL, $url); 
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); 
	curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0); 
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt ($ch, CURLOPT_REFERER, $url); 
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata); 
	curl_setopt ($ch, CURLOPT_POST, 1); 
	$result = curl_exec ($ch);  
	curl_close($ch);
}
	
?> 