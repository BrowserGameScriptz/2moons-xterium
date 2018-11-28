<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

function _transactionReward($userId, $currency, $mc_gross, $usedSaving, $defaultAmount, $payment_status, $txn_id, $mc_fee, $realDonator){  
	$db	= Database::get();	
	$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
	$INFO1 = $db->selectSingle($sql, array(
		':userId'	=> $userId
	));
	$config	= Config::get($INFO1['universe']);		
	$loyality_points = floor($mc_gross / 8)	;
		
	if($usedSaving == 1){
		$sql	= "UPDATE %%USERS%% SET loyality_points = :loyality_points WHERE id = :userId;";
		$db->update($sql, array(
			':loyality_points'	=> 0,
			':userId'			=> $userId
		));	
	}
	
	$bonus_first_pay 	= 0;
	if(config::get()->firstDonationEvent != 0 && $INFO1['eur_spend'] == 0){
		$bonus_first_pay = $defaultAmount * (config::get()->firstDonationEvent / 100);
		$Message = 'Paysafecard first donation. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($bonus_first_pay).'</span> anti matter have been credited to your account.';
		PlayerUtil::sendMessage($userId, '', 'System', 4, 'Anti Matter Order', $Message, TIMESTAMP);
	}

	$sql	= "UPDATE %%USERS%% SET antimatter_bought = antimatter_bought + :currency, loyality_points = loyality_points + :loyality_points, eur_spend = eur_spend + :eur_spend WHERE id = :userId;";
	$db->update($sql, array(
		':currency'			=> $currency + $bonus_first_pay,
		':loyality_points'	=> $loyality_points,
		':eur_spend'		=> $mc_gross,
		':userId'			=> $userId
	));	

	if($INFO1['ref_id'] != 0){
		$db	= Database::get();	
		$sql	= "UPDATE %%USERS%% SET antimatter_bought = antimatter_bought + :currency WHERE id = :userId;";
		$db->update($sql, array(
			':currency'		=> $currency / 100 * 5,
			':userId'		=> $INFO1['ref_id'] 
		));	
		PlayerUtil::sendMessage($INFO1['ref_id'], '', 'System', 4, 'Anti Matter Order', 'Referal payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($currency/100*5).'</span> Anti Matter Units have been credited to your account.', TIMESTAMP);
	}

	if($realDonator == $userId){
		$Message = 'Paysafecard payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($currency).'</span> anti matter have been credited to your account.';
		PlayerUtil::sendMessage($userId, '', 'System', 4, 'Anti Matter Order', $Message, TIMESTAMP);
	}else{
		$endUsername = empty($INFO1['customNick']) ? $INFO1['username'] : $INFO1['customNick'];
		$Message = 'Paysafecard donation was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($currency).'</span> anti matter have been credited to your account.';
		$MessageR = 'Paysafecard payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($currency).'</span> anti matter have been credited to '.$endUsername.' account.';
		PlayerUtil::sendMessage($userId, '', 'System', 4, 'Anti Matter Donation', $Message, TIMESTAMP);
		PlayerUtil::sendMessage($realDonator, '', 'System', 4, 'Anti Matter Order', $MessageR, TIMESTAMP);
	}
	
	$db	= Database::get();	
	$payId = $db->lastInsertId();
	$sql = "INSERT INTO %%PURCHASE%% SET userID = :userID, time = :time, pinCode = :pinCode, pinPrice = :pinPrice, pinCredits = :pinCredits, pinType = :pinType, pinAprouved = :pinAprouved, paystatus = :paystatus, payupdate = :payupdate, realDonator = :realDonator;";
	$db->insert($sql, array(
		':userID'			=> $userId,
		':time'				=> TIMESTAMP,
		':pinCode'			=> $txn_id,
		':pinPrice'			=> ($mc_gross-$mc_fee),
		':pinCredits'		=> $currency + $bonus_first_pay,
		':pinType'			=> 'paysafecard',
		':pinAprouved'		=> 1,
		':paystatus'		=> $payment_status,
		':payupdate'		=> TIMESTAMP,
		':realDonator'		=> $realDonator
	));
}

//-------------------------- Don't change anything below this! -----------------------------

$secret_key = "b24bd139-c1a8-11e7-ba3e-128b57940774";

if($secret_key != $_POST['key']){
	echo "Validation error"; 
	exit;
}else{
	$userId 			= isset($_POST['userId']) ? $_POST['userId'] : 0;
	$usedSaving 		= isset($_POST['usedSaving']) ? $_POST['usedSaving'] : 0;
	$defaultAmount 		= isset($_POST['defaultAmount']) ? $_POST['defaultAmount'] : 0;
	$realDonator 		= isset($_POST['realDonator']) ? $_POST['realDonator'] : 0;
	$currency 			= isset($_POST['currency']) ? $_POST['currency'] : 0;
	$transaction_id 	= isset($_POST['transaction_id']) ? $_POST['transaction_id'] : 0;
	$price 				= isset($_POST['price']) ? $_POST['price'] : 0;
	$payment_status		= "Completed";
	$mc_fee				= $price / 100 * 15;
	_transactionReward($userId, $currency, $price, $usedSaving, $defaultAmount, $payment_status, $transaction_id, $mc_fee, $realDonator);    
}
	
?> 