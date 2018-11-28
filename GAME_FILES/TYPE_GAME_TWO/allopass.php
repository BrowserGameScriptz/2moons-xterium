<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';


function _rewardPurchase($userId, $virtual_amount, $paid, $transaction_id) {
	$config 			= Config::get();
	$bonus_of_amount 	= 0;
	$bonus_first_pay 	= 0;
	
	$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
	$INFO1 = database::get()->selectSingle($sql, array(
		':userId'	=> $userId
	));
	
	if($config->special_donation_status == 1 && $virtual_amount >= $config->special_donation_amount){
		$bonus_of_amount = $virtual_amount * ($config->special_donation_percent / 100);
	}
	
	if(config::get()->firstDonationEvent != 0 && $INFO1['eur_spend'] == 0){
		$bonus_first_pay = $virtual_amount * (config::get()->firstDonationEvent / 100);
		$Message = 'Allopass first donation. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($bonus_first_pay).'</span> anti matter have been credited to your account.';
		PlayerUtil::sendMessage($userId, '', 'System', 4, 'Anti Matter Order', $Message, TIMESTAMP);
	}
	$bonus_amount1 	= $virtual_amount * (($config->donation_bonus + $config->x_donation_inter) / 100);
	$virtual_amount *= min(2.5, 1 + $virtual_amount / 500000);
	$pointe_bonus	= 0;	
	$count1 		= round($bonus_of_amount + $pointe_bonus + $virtual_amount + $bonus_amount1 + $bonus_first_pay);
	$loyality_points= floor($paid / 8);
	
	if($INFO1['ref_id'] != 0){
		$sql	= "UPDATE %%USERS%% SET antimatter_bought	= antimatter_bought + :currency WHERE id = :userId;";
		database::get()->update($sql, array(
					':currency'	=> $count1 / 100 * 5,
					':userId'	=> $INFO1['ref_id']
		));	
		PlayerUtil::sendMessage($INFO1['ref_id'], '', 'System', 4, 'Anti Matter Order', 'Referal payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($count1/100*5).'</span> Anti Matter Units have been credited to your account.', TIMESTAMP);
	}
	
	$sql	= "UPDATE %%USERS%% SET antimatter_bought = antimatter_bought + :currency, loyality_points = loyality_points + :loyality_points, eur_spend = eur_spend + :eur_spend WHERE id = :userId;";
	database::get()->update($sql, array(
				':currency'			=> $count1,
				':loyality_points'	=> $loyality_points,
				':eur_spend'		=> $paid,
				':userId'			=> $userId
	));	
	
	$sql = "INSERT INTO %%PURCHASE%% SET userID = :userID, time = :time, pinCode = :pinCode, pinPrice = :pinPrice, pinCredits = :pinCredits, pinType = :pinType, pinAprouved = :pinAprouved, paystatus = :paystatus, payupdate = :payupdate;";
	database::get()->insert($sql, array(
		':userID'			=> $userId,
		':time'				=> TIMESTAMP,
		':pinCode'			=> $transaction_id,
		':pinPrice'			=> $paid,
		':pinCredits'		=> $count1,
		':pinType'			=> 'xsolla',
		':pinAprouved'		=> 1,
		':paystatus'		=> "Completed",
		':payupdate'		=> TIMESTAMP
	));

	$Message = 'Allopass payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($count1).'</span> anti matter have been credited to your account.';
	PlayerUtil::sendMessage($userId, '', 'System', 4, 'Anti Matter Order', $Message, TIMESTAMP);
}

//-------------------------- Don't change anything below this! ----------------------------- //

$userId 		= isset($_GET['user_id']) ? $_GET['user_id'] : null;
$virtual_amount = isset($_GET['virtual_amount']) ? $_GET['virtual_amount'] : null;
$action 		= isset($_GET['action']) ? $_GET['action'] : null;
$paid 			= isset($_GET['paid']) ? $_GET['paid'] : null;
$transaction_id	= isset($_GET['transaction_id']) ? $_GET['transaction_id'] : null;
$result 		= false;
if (isset($userId) && isset($virtual_amount) && isset($action) && $action == "payment-confirm") {
	$result = true;
    _rewardPurchase($userId, $virtual_amount, $paid, $transaction_id);
}

if ($result) {
    echo 'OK';
}
?>