<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

function _completedPurchase($userId, $currency, $mc_gross, $usedSaving, $defaultAmount, $payment_status, $txn_id, $mc_fee, $realDonator) {
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
		$Message = 'Paypal first donation. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($bonus_first_pay).'</span> anti matter have been credited to your account.';
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
		$Message = 'PayPal payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($currency).'</span> anti matter have been credited to your account.';
		PlayerUtil::sendMessage($userId, '', 'System', 4, 'Anti Matter Order', $Message, TIMESTAMP);
	}else{
		$endUsername = empty($INFO1['customNick']) ? $INFO1['username'] : $INFO1['customNick'];
		$Message = 'PayPal donation was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($currency).'</span> anti matter have been credited to your account.';
		$MessageR = 'PayPal payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($currency).'</span> anti matter have been credited to '.$endUsername.' account.';
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
		':pinType'			=> 'paypal',
		':pinAprouved'		=> 1,
		':paystatus'		=> $payment_status,
		':payupdate'		=> TIMESTAMP,
		':realDonator'		=> $realDonator
	));
}
//-------------------------- Don't change anything below this! ----------------------------- //
define("DEBUG", 1);
// Set to 0 once you're ready to go live
define("USE_SANDBOX", 0);
define("LOG_FILE", "./ipn.log");
// Read POST data
// reading posted data directly from $_POST causes serialization
// issues with array data in POST. Reading raw POST data from input stream instead.
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
$keyval = explode ('=', $keyval);
if (count($keyval) == 2)
$myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
$get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
$value = urlencode(stripslashes($value));
} else {
$value = urlencode($value);
}
$req .= "&$key=$value";
}
// Post IPN data back to PayPal to validate the IPN data is genuine
// Without this step anyone can fake IPN data
if(USE_SANDBOX == true) {
$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
} else {
$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}
$ch = curl_init($paypal_url);
if ($ch == FALSE) {
return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
if(DEBUG == true) {
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}
// CONFIG: Optional proxy configuration
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.
//$cert = __DIR__ . "./cacert.pem";
//curl_setopt($ch, CURLOPT_CAINFO, $cert);
$res = curl_exec($ch);
if (curl_errno($ch) != 0) // cURL error
{
if(DEBUG == true) {	
error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
}
curl_close($ch);
exit;
} else {
// Log the entire HTTP response if debug is switched on.
if(DEBUG == true) {
error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
// Split response headers and payload
list($headers, $res) = explode("\r\n\r\n", $res, 2);
}
curl_close($ch);
}
// Inspect IPN validation result and act accordingly
// check whether the payment_status is Completed
// check that txn_id has not been previously processed
// check that receiver_email is your PayPal email
// check that payment_amount/payment_currency are correct
// process payment and mark item as paid.
// assign posted variables to local variables
//$item_name = $_POST['item_name'];
//$item_number = $_POST['item_number'];
//$payment_status = $_POST['payment_status'];
//$payment_amount = $_POST['mc_gross'];
//$payment_currency = $_POST['mc_currency'];
//$txn_id = $_POST['txn_id'];
//$receiver_email = $_POST['receiver_email'];
//$payer_email = $_POST['payer_email'];
$result = false;
if (strpos($res, 'INVALID') !== false) {
	echo 'Not Possible to do that !';
}elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
	$CustomVar 		= explode(",", $_POST['custom']);
	$userId 		= isset($CustomVar[0]) ? $CustomVar[0] : null;
	$usedSaving 	= isset($CustomVar[1]) ? $CustomVar[1] : null;
	$defaultAmount 	= isset($CustomVar[2]) ? $CustomVar[2] : null;
	$currency 		= isset($_POST['item_number']) ? $_POST['item_number'] : $CustomVar[4];
	$mc_gross 		= isset($_POST['mc_gross']) ? $_POST['mc_gross'] : null;
	$payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : null;
	$txn_id 		= isset($_POST['txn_id']) ? $_POST['txn_id'] : null;
	$mc_fee 		= isset($_POST['mc_fee']) ? $_POST['mc_fee'] : null;
	$realDonator 	= isset($CustomVar[3]) ? $CustomVar[3] : null;

	if (strpos($res, 'INVALID') !== false) {
		echo 'Not Possible to do that !';
	}elseif ($payment_status == 'Completed') {
		$result = true;
		_completedPurchase($userId, $currency, $mc_gross, $usedSaving, $defaultAmount, $payment_status, $txn_id, $mc_fee, $realDonator);    
	}
}else{
	echo 'Banned !';
}
if ($result) {
    echo 'OK';
}

?>