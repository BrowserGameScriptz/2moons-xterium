<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

function _rewardPurchase($userId, $currency) {


$db	= Database::get();	

$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
			$INFO1 = $db->selectSingle($sql, array(
			':userId'	=> $userId
		));
		
$sql	= "UPDATE %%USERS%% SET antimatter	= antimatter + :currency WHERE id = :userId;";
$db->update($sql, array(
			':currency'	=> $currency,
			':userId'			=> $userId
));	

PlayerUtil::sendMessage($userId, '', 'System', 4, 'Anti Matter Order', 'Offerwall payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($currency).'</span> anti matter have been credited to your account.', TIMESTAMP);


PlayerUtil::sendMessage(1, '', 'System', 4, 'Anti Matter Order', 'Offerwall payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($currency).'</span> Anti Matter Units have been credited to '.$INFO1['username'].' account.', TIMESTAMP);
PlayerUtil::sendMessage(10283, '', 'System', 4, 'Anti Matter Order', 'Offerwall payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($currency).'</span> Anti Matter Units have been credited to '.$INFO1['username'].' account.', TIMESTAMP);
       
    
}

//-------------------------- Don't change anything below this! ----------------------------- //


$your_postback_password = "N20MTmDRU7";
$userId = isset($_REQUEST['subid']) ? $_REQUEST['subid'] : null;
$currency = isset($_REQUEST['virtual_currency']) ? $_REQUEST['virtual_currency'] : null;
$mc_gross = isset($_REQUEST['payout']) ? $_REQUEST['payout'] : null;
$campaign_name = isset($_REQUEST['campaign_name']) ? $_REQUEST['campaign_name'] : null;
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
$result = false;
if (isset($userId) && ($your_postback_password == $password)) {
$result = true;
_rewardPurchase($userId, $currency);    
}
if ($result) {
    echo 'OK';
}


?>