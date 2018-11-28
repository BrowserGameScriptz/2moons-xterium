<?php

require_once 'includes/classes/cronjob/CronjobTask.interface.php';

class OnlinecountCronjob implements CronjobTask
{
	 
	function run()
	{		
	
		/** @var $langObjects Language[] */
		$sql	= 'SELECT * FROM %%USERS%% WHERE universe = :universe AND onlinetime > :onlineTime';
		$onlineData	= Database::get()->select($sql, array(
			':universe'	=> 1,
			':onlineTime'	=> TIMESTAMP - 30 * 60
		));
		
		$balken = count($onlineData);
		$config	= Config::get(ROOT_UNI);
		$useramount=$balken; 
		$url="https://www.warofgalaxyz.com/onlinecount.php";  
		
		$postdata = "useramount=".$useramount; 

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

		echo $result;  
		curl_close($ch);
		
	}
}