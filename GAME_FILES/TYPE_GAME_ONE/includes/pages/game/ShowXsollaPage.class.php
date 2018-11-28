<?php

require 'includes/libs/xsolla/xsolla-autoloader.php';

use Xsolla\SDK\API\XsollaClient;
use Xsolla\SDK\API\PaymentUI\TokenRequest;

class ShowXsollaPage extends AbstractGamePage
{
	const MAIL        = 'ncn71008@toiea.com';
	public $cost      = '0';
	public $amount    = '0';

	function __construct() {
        parent::__construct();
				
		$action = HTTP::_GP('action', '');
       
		switch ($action){
			case 'success':
				$this->IPN();
			break;
			case 'cancel':
				$this->Cancel();
			break;
			case 'ipn':
				$this->IPN();
			break;
			default:
				$this->CallOrder();
			break;
		}				
	}

	function Success(){
		message(pretty_number(HTTP::_GP('amount', 0)).' Anti matter where is on your account. <br><br><a href="?page=overview">Continue</a>');
	}

	function Cancel(){
		message('Your Order where Cancelled.</h3><br><a href="?page=overview">Continue</a><br>');
	}

        function CallOrder()
        {
			global $USER;
				
			$config = Config::get();
		
            $this->amount           = str_replace(".","",HTTP::_GP('out',0));
            $this->realreq          = str_replace(".","",HTTP::_GP('out',0));
            $this->fields           = HTTP::_GP('ik_baggage_fields',0);
			$this->cost  			= round($this->amount * 0.0001010);
			$realRequest 			= round($this->amount);
			$this->selectFriend		= HTTP::_GP('v1', 0);
				
			if($realRequest < 10000){
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php?page=donation');
			}else{
				$bonus_of_amount = 0;
				if($config->special_donation_status == 1 && $this->amount >= $config->special_donation_amount)
					$bonus_of_amount = $this->amount * ($config->special_donation_percent / 100);
		
				$up_bonus 		= $config->special_donation_up / 50;
				$this->amount 	*= min(2.5, 1 + $this->amount / 500000);
		
				if($this->fields == 1){	
					$pointe_bonus 	= $this->amount * $USER['loyality_points'] / 100;
				}else{
					$pointe_bonus	= 0;	
				}
			
				$bonus_amount1 = $this->amount * (($config->donation_bonus + $config->x_donation_inter) / 100);
				$bonus_amount2 = $this->amount * (($config->donation_bonus + $config->x_donation_xsolla) / 100);
		
				$count1 = round($bonus_of_amount + $pointe_bonus + $this->amount + $bonus_amount1);
				$count2 = round($bonus_of_amount + $pointe_bonus + $this->amount + $bonus_amount2);
				$count3 = round($this->realreq);
					
				$endPrice = $this->cost;
				
				$usernameToDisplay = empty($USER['customNick']) ? $USER['username'] : $USER['customNick']; 
				$useridToDisplay   = $USER['id'];
				$emailToDisplay    = $USER['email'];
				if($this->selectFriend != 0){
					$userInfo = GetFromDatabase('USERS', 'id', $this->selectFriend, array('id', 'username', 'customNick', 'email'));
					$usernameToDisplay = empty($userInfo['customNick']) ? $userInfo['username'] : $userInfo['customNick'];
					$useridToDisplay   = $userInfo['id'];
					$emailToDisplay    = $userInfo['email'];
				}

				$tokenRequest = new TokenRequest(18368, $useridToDisplay);
				$tokenRequest->setUserEmail($emailToDisplay)
				->setSandboxMode(false)
				->setUserName($usernameToDisplay)
				->setDesignMethod('dark')
				->setAmountAm($count3)
				->setReturnUrl('https://'.$_SERVER['HTTP_HOST'].'/game.php?page=overview')
				->setCustomParameters(array('key1' => $this->fields, 'key2' => $USER['id']));

				$xsollaClient = XsollaClient::factory(array(
					'merchant_id' => '27660',
					'api_key' => 'SEPvBkLhjz1lX9y1'
				));
				$token = $xsollaClient->createPaymentUITokenFromRequest($tokenRequest);
					header('Location: https://secure.xsolla.com/paystation2/?access_token='.$token);
			}
        }
}
?>