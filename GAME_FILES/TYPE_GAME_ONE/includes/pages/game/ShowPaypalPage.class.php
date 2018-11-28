<?php

class ShowPaypalPage extends AbstractGamePage
{
	function __construct()
	{
		parent::__construct();
	}
	
	function show(){
		global $USER, $CONF, $UNI;
	
		// PayPal settings
		$paypal_email 	= 'billing@warofgalaxyz.com';
		$return_url 	= 'https://'.$_SERVER['HTTP_HOST'].'/game.php?page=overview';
		$cancel_url 	= 'https://'.$_SERVER['HTTP_HOST'].'/game.php?page=overview';
		$notify_url 	= 'https://'.$_SERVER['HTTP_HOST'].'/paypal_paiement.php';

		$amount          = str_replace(".","",HTTP::_GP('ik_payment_amount',0));
		$inputAmount	 = str_replace(".","",HTTP::_GP('ik_payment_amount',0));
		$selectFriend	 = HTTP::_GP('ik_payment_id', 0);
		$fields          = HTTP::_GP('ik_baggage_fields',0);
		$cost   		 = round($amount * 0.0001010);
		
		if($amount < 10000){
			header('Location: https://'.$_SERVER['HTTP_HOST'].'/game.php?page=donation');
		}else{
			$bonus_of_amount = 0;
			if(config::get()->special_donation_status == 1 && $amount >= config::get()->special_donation_amount)
				$bonus_of_amount = $amount * (config::get()->special_donation_percent / 100);
		
			$up_bonus = config::get()->special_donation_up / 50;
			$amount *= min(2.5, 1 + $amount / 500000);
		
			if($fields == 1){	
				$pointe_bonus 	= $amount * $USER['loyality_points'] / 100;
			}
			else{
				$pointe_bonus	= 0;	
			}
			
			$bonus_amount1 = $amount * ((config::get()->donation_bonus + config::get()->x_donation_inter) / 100);
			$bonus_amount2 = $amount * ((config::get()->donation_bonus + config::get()->x_donation_xsolla) / 100);
		
			$count1 = round($bonus_of_amount + $pointe_bonus + $amount + $bonus_amount1);
			$count2 = round($bonus_of_amount + $pointe_bonus + $amount + $bonus_amount2);
			 
			if($selectFriend == 0)
				$a1 = array($USER['id'],$fields,$inputAmount,$USER['id'],$count1);
			else
				$a1 = array($selectFriend,$fields,$inputAmount,$USER['id'],$count1);
					
			$usernameToDisplay = empty($USER['customNick']) ? $USER['username'] : $USER['customNick'];
			if($selectFriend != 0){
				$userInfo = GetFromDatabase('USERS', 'id', $selectFriend, array('username', 'customNick'));
				$usernameToDisplay = empty($userInfo['customNick']) ? $userInfo['username'] : $userInfo['customNick'];
			}
			$querystring = '';
		
			// Firstly Append paypal account to querystring
			$querystring .= "?business=".urlencode($paypal_email)."&";
			
			// Append amount& currency (£) to quersytring so it cannot be edited in html
			
			//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
			$querystring .= "item_name=".urlencode($count1.' AM-User('.$usernameToDisplay.').')."&";
			$querystring .= "item_number=".urlencode($count1)."&";
			$querystring .= "amount=".urlencode($cost)."&";
			$querystring .= "currency_code=".urlencode('EUR')."&";
			$querystring .= "custom=".urlencode(implode(",", $a1))."&";
			$querystring .= "rm=".urlencode('2')."&";
			$querystring .= "cmd=".urlencode('_xclick')."&";
			
			
			/* //loop for posted values and append to querystring
			foreach($_POST as $key => $value){
				$value = urlencode(stripslashes($value));
				$querystring .= "$key=$value&";
			} */
			
			// Append paypal return addresses
			$querystring .= "return=".urlencode(stripslashes($return_url))."&";
			$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
			$querystring .= "notify_url=".urlencode($notify_url);
			
			// Redirect to paypal IPN
			header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
		}
	}
}
?>