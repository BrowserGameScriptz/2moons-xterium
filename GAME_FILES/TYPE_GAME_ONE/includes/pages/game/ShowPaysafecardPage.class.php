<?php

class ShowPaysafecardPage extends AbstractGamePage
{
	
	function __construct() {
        parent::__construct();
	}
	
	function show()
	{
		global $USER;
		
		$amount          = str_replace(".","",HTTP::_GP('paysafe',0));
		$inputAmount	 = str_replace(".","",HTTP::_GP('paysafe',0));
		$selectFriend	 = HTTP::_GP('ik_payment_id', 0);
		$fields          = HTTP::_GP('ik_baggage_fields',0);
		$cost   		 = round($amount * 0.0001010);
		
		if($amount < 10000 || $cost >= 1000){
			header('Location: https://'.$_SERVER['HTTP_HOST'].'/game.php?page=donation');
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
			$details = json_decode(file_get_contents("http://ipinfo.io/".$ip));
		
			$pg_serviceid 	= 468509;
			$pg_currency 	= "EUR";
			$pg_price 		= $cost;
			$pg_mode 		= "advanced";
			$pg_method 		= "paysafecard";
			$pg_email  		= "billing@warofgalaxyz.com";
			$pg_country  	= $details->country;
			$pg_return_url 	= 'https://'.$_SERVER['HTTP_HOST'].'/game.php?page=overview';
			$pg_cancel_url 	= 'https://'.$_SERVER['HTTP_HOST'].'/game.php?page=overview';
			
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
			
			$bonus_amount3 	= $amount * ((config::get()->donation_bonus + config::get()->x_donation_xsolla) / 100);
			$count3			= round($bonus_of_amount + $pointe_bonus + $amount + $bonus_amount3);
			
			if($selectFriend == 0)
				$a1 = array($USER['id'],$fields,$inputAmount,$USER['id'],$count3, "play");
			else
				$a1 = array($selectFriend,$fields,$inputAmount,$USER['id'],$count3, "play");
					
			$usernameToDisplay = empty($USER['customNick']) ? $USER['username'] : $USER['customNick'];
			if($selectFriend != 0){
				$userInfo = GetFromDatabase('USERS', 'id', $selectFriend, array('username', 'customNick'));
				$usernameToDisplay = empty($userInfo['customNick']) ? $userInfo['username'] : $userInfo['customNick'];
			}
			
			$querystring = '';
			$querystring .= "?pg_serviceid=".urlencode($pg_serviceid)."&"; // Service ID of your account.
			$querystring .= "pg_currency=".urlencode($pg_currency)."&"; // Type of currency specified in alphabetic code ISO 4217 you want to use (eg: EUR, USD, GBP, MXN, etc.). See the full list of the currency codes.
			$querystring .= "pg_price=".urlencode($pg_price)."&"; // The price of your product, you can simply change it. If your customers select other country, currency will be automatically converted.
			$querystring .= "pg_name=".urlencode($count3.' AM-User('.$usernameToDisplay.').')."&"; // (Optional) Description of your product/service, which will be shown on the payment screen.
			$querystring .= "pg_custom=".urlencode(implode(",", $a1))."&"; // (Optional) Custom field, can be used to identify customer, inventory, etc.
			$querystring .= "pg_mode=".urlencode($pg_mode)."&"; // (Optional) Custom field, can be used to identify customer, inventory, etc.
			$querystring .= "pg_method=".urlencode($pg_method)."&"; // (Optional) Custom field, can be used to identify customer, inventory, etc.
			$querystring .= "pg_email=".urlencode($pg_email)."&"; // (Optional) Custom field, can be used to identify customer, inventory, etc.
			$querystring .= "pg_country=".urlencode($pg_country)."&"; // (Optional) Custom field, can be used to identify customer, inventory, etc.
			$querystring .= "pg_return_url=".urlencode($pg_return_url)."&"; // (Optional) After the payment process your customers will be redirected here (e.g. https://www.mysite.com/thanks).
			$querystring .= "pg_cancel_url=".urlencode($pg_cancel_url); // (Optional) Your customer will be redirected to after a cancelled or failed payment process (e.g. https://www.mysite.com/failed).
			header('location:https://www.paygol.com/pay'.$querystring);
		}
	}
}
?>