<?php
define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);
require 'includes/common.php';
require 'includes/libs/xsolla/xsolla-autoloader.php';

use Xsolla\SDK\Webhook\WebhookServer;
use Symfony\Component\HttpFoundation\Request;
use Xsolla\SDK\Webhook\Message\Message;
use Xsolla\SDK\Exception\Webhook\XsollaWebhookException;
use Xsolla\SDK\Exception\Webhook\InvalidUserException;

$request = Request::createFromGlobals();
$request->setTrustedProxies(array('159.255.220.240/28, 185.30.20.16/29, 185.30.21.0/24, 185.30.21.16/29', '2a02:a03f:3c1b:cd00:1482:89a1:5424:8f28', '54.36.61.29', '109.134.53.117'));
 
$callback = function (Message $message) {
    switch ($message->getNotificationType()) {
        case Message::USER_VALIDATION:
            /** @var Xsolla\SDK\Webhook\Message\UserValidationMessage $message */
            // TODO if user not found, you should throw Xsolla\SDK\Exception\Webhook\InvalidUserException
			$userArray = $message->getUser();
			$userId = $message->getUserId();
			$messageArray = $message->toArray();
			
			$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
	
			$USER	= database::get()->selectSingle($sql, array(
				':userId'	=> $userId
			));
			
			if(empty($USER))
			{
				throw new InvalidUserException('USER NOT FOUND');
			}
		
            break;
        case Message::PAYMENT:
            /** @var Xsolla\SDK\Webhook\Message\PaymentMessage $message */
            // TODO if the payment delivery fails for some reason, you should throw Xsolla\SDK\Exception\Webhook\XsollaWebhookException
			$userArray 				= $message->getUser();
			$userId 				= $message->getUserId();
            $paymentDetailsArray 	= $message->getPurchase(); 
            $isDryRun 				= $message->isDryRun();
			$customParametersArray 	= $message->getCustomParameters();
			$getTranId 				= $message->getPaymentId();
            $messageArray 			= $message->toArray();
			$usedSaving 			= $customParametersArray['key1'];
			$realDonator 			= $customParametersArray['key2'];
			$bonus_of_amount 		= 0;
			$bonus_first_pay 		= 0;
			$realAm 				= $paymentDetailsArray['virtual_currency']['quantity'];
			$realAmBis 				= $paymentDetailsArray['virtual_currency']['quantity'];
			
			$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
			$INFO1 = database::get()->selectSingle($sql, array(
				':userId'	=> $userId
			));
			
			$config	= Config::get($INFO1['universe']);		
			
			if($config->special_donation_status == 1 && $paymentDetailsArray['virtual_currency']['quantity'] >= $config->special_donation_amount){
				$bonus_of_amount = $paymentDetailsArray['virtual_currency']['quantity'] * ($config->special_donation_percent / 100);
			}
			
			if(config::get()->firstDonationEvent != 0 && $INFO1['eur_spend'] == 0){
				$bonus_first_pay = $paymentDetailsArray['virtual_currency']['quantity'] * (config::get()->firstDonationEvent / 100);
				$Message = 'Xsolla first donation. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($bonus_first_pay).'</span> anti matter have been credited to your account.';
				PlayerUtil::sendMessage($userId, '', 'System', 4, 'Anti Matter Order', $Message, TIMESTAMP);
			}
			
			$realAm *= min(2.5, 1 + $paymentDetailsArray['virtual_currency']['quantity'] / 500000);
			
			if($usedSaving == 1)
			{	
				$pointe_bonus 	= $realAm * $INFO1['loyality_points'] / 100;
				$sql	= "UPDATE %%USERS%% SET loyality_points = :loyality_points WHERE id = :userId;";
				database::get()->update($sql, array(
					':loyality_points'	=> 0,
					':userId'			=> $userId
				));	
			}
			else
			{
				$pointe_bonus	= 0;	
			}
			
			$bonus_amount1 		= $realAm * (($config->donation_bonus + $config->x_donation_inter) / 100);
			$count1 			= round($bonus_of_amount + $pointe_bonus + $realAm + $bonus_amount1 + $bonus_first_pay);
			$loyality_points 	= floor($paymentDetailsArray['virtual_currency']['amount'] / 8);
			
			if($INFO1['ref_id'] != 0){
				$db	= Database::get();	
				$sql	= "UPDATE %%USERS%% SET antimatter_bought = antimatter_bought + :currency WHERE id = :userId;";
				$db->update($sql, array(
					':currency'	=> $count1 / 100 * 5,
					':userId'			=> $INFO1['ref_id']
				));	
				PlayerUtil::sendMessage($INFO1['ref_id'], '', 'System', 4, 'Anti Matter Order', 'Referal payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($paymentDetailsArray['virtual_currency']['quantity']/100*5).'</span> Anti Matter Units have been credited to your account.', TIMESTAMP);
			}
				
			if($realDonator == $userId){
				$Message = 'Xsolla payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($count1).'</span> anti matter have been credited to your account.';
				PlayerUtil::sendMessage($userId, '', 'System', 4, 'Anti Matter Order', $Message, TIMESTAMP);
			}else{
				$endUsername = empty($INFO1['customNick']) ? $INFO1['username'] : $INFO1['customNick'];
				$Message = 'Xsolla donation was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($count1).'</span> anti matter have been credited to your account.';
				$MessageR = 'Xsolla payment was successful. <br><span style="color:#F30; font-weight:bold;">'.pretty_number($count1).'</span> anti matter have been credited to '.$endUsername.' account.';
				PlayerUtil::sendMessage($userId, '', 'System', 4, 'Anti Matter Donation', $Message, TIMESTAMP);
				PlayerUtil::sendMessage($realDonator, '', 'System', 4, 'Anti Matter Order', $MessageR, TIMESTAMP);
			}
			
			$sql	= "UPDATE %%USERS%% SET antimatter_bought = antimatter_bought + :antimatter, loyality_points = loyality_points + :loyality_points, eur_spend = eur_spend + :eur_spend WHERE id = :userId;";
			database::get()->update($sql, array(
				':antimatter'	=> $count1,
				':loyality_points'	=> $loyality_points,
				':eur_spend'	=> floor($paymentDetailsArray['virtual_currency']['amount']),
				':userId'	=> $userId
			));
			
			$db	= Database::get();	
			$payId = $db->lastInsertId();
			$sql = "INSERT INTO %%PURCHASE%% SET userID = :userID, time = :time, pinCode = :pinCode, pinPrice = :pinPrice, pinCredits = :pinCredits, pinType = :pinType, pinAprouved = :pinAprouved, paystatus = :paystatus, payupdate = :payupdate, realDonator = :realDonator;";
			$db->insert($sql, array(
				':userID'			=> $userId,
				':time'				=> TIMESTAMP,
				':pinCode'			=> $getTranId,
				':pinPrice'			=> $paymentDetailsArray['virtual_currency']['amount'],
				':pinCredits'		=> $count1,
				':pinType'			=> 'xsolla',
				':pinAprouved'		=> 1,
				':paystatus'		=> "Completed",
				':payupdate'		=> TIMESTAMP,
				':realDonator'		=> $realDonator
			));
						
        break;
        case Message::USER_BALANCE:
            /** @var Xsolla\SDK\Webhook\Message\RefundMessage $message */
            // TODO if you cannot handle the refund, you should throw Xsolla\SDK\Exception\Webhook\XsollaWebhookException
            break;
        default:
            throw new XsollaWebhookException('Notification type not implemented');
    }
};

$webhookServer = WebhookServer::create($callback, 'w6EwaVQdzW26wDAi');
$webhookServer->start();