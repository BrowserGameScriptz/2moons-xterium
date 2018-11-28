<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
$db	= Database::get();
$session	= Session::load();

$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
$USERD	= $db->selectSingle($sql, array(
	':userId'	=> $session->userId
));

$sql	= 'SELECT total_rank FROM %%STATPOINTS%% WHERE id_owner = :userId AND stat_type = 1;';
$statData	= Database::get()->selectSingle($sql, array(
	':userId'	=> $USERD['id']
));
//$PageOfPlayer = floor(1 / config::get()->users_amount * $statData['total_rank'] * round(config::get()->users_amount / 100));
$PageOfPlayer = 0;


$sql	= 'SELECT * FROM %%AUCTIONACTIVE%% WHERE auctionPage = :auctionPage ORDER BY endTime DESC LIMIT 1;';
$AUCTIONDETAILS = $db->selectSingle($sql, array(
	':auctionPage'	=> $PageOfPlayer,
));

$sql	= 'SELECT * FROM %%AUCTIONLOG%% WHERE auctionPage = :auctionPage ORDER BY total_bid DESC LIMIT 1;';
$AUCTIONLOGS = $db->selectSingle($sql, array(
	':auctionPage'	=> $PageOfPlayer,
));

$sql	= 'SELECT * FROM %%AUCTIONLOG%% WHERE auctionPage = :auctionPage;';
$AUCTIONLOGSCOUNT = $db->select($sql, array(
	':auctionPage'	=> $PageOfPlayer,
));

$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
$USERINFO = $db->selectSingle($sql, array(
':userId' => $AUCTIONLOGS['userId']
));

$sql	= 'SELECT * FROM %%AUCTIONLOG%% WHERE userId = :userId AND auctionPage = :auctionPage;';
$AUCTIONUSERLOG = $db->selectSingle($sql, array(
	':userId' => $session->userId,
	':auctionPage'	=> $PageOfPlayer
));



$isActive		= 	$AUCTIONDETAILS['endTime'] > TIMESTAMP ? 0 : 1;
$isActiveBid	= 	$AUCTIONLOGS['total_bid'] != '' ? $AUCTIONLOGS['total_bid'] : 0;
$isUserBid		= 	$AUCTIONLOGS['total_bid'] != '' ? $AUCTIONLOGS['total_bid'] : 0;
$isUsername		= 	$USERINFO['username'] != '' ? empty($USERINFO['customNick']) ? $USERINFO['username'] : $USERINFO['customNick'] : '-';
$isUserid		= 	$AUCTIONLOGS['userId'] != '' ? $AUCTIONLOGS['userId'] : 0;
$NewIdEnchere 	= 	$AUCTIONLOGS['auctionid'] != '' ? $AUCTIONLOGS['auctionid'] : 0;

$TIMELEFT = 0;
if ($AUCTIONDETAILS['endTime'] - TIMESTAMP < 5 * 60){
	$timeIncDec = mt_rand(1,2);
	if($AUCTIONDETAILS['isChanged'] == 0 && $AUCTIONDETAILS['endTime'] - TIMESTAMP < 60 && $timeIncDec == 1){
		$sql	= "UPDATE %%AUCTIONACTIVE%% SET isChanged = :isChanged, endTime = endTime + :newtime WHERE auctionId = :auctionId;";
		$db->update($sql, array(
		':isChanged'	=> 1, 
		':newtime'	=> mt_rand(30,150), 
		':auctionId'	=> $AUCTIONDETAILS['auctionId'] 
		));		 
	}elseif($AUCTIONDETAILS['isChanged'] == 0 && $AUCTIONDETAILS['endTime'] - TIMESTAMP < 5*60 && $timeIncDec == 2){
		$sql	= "UPDATE %%AUCTIONACTIVE%% SET isChanged = :isChanged, endTime = endTime - :newtime WHERE auctionId = :auctionId;";
		$db->update($sql, array(
		':isChanged'	=> 1, 
		':newtime'	=> mt_rand(30,120), 
		':auctionId'	=> $AUCTIONDETAILS['auctionId'] 
		));		 
	}
$TIMELEFT = 5;	
}elseif ($AUCTIONDETAILS['endTime'] - TIMESTAMP < 10 * 60){
$TIMELEFT = 10;	 
}elseif ($AUCTIONDETAILS['endTime'] - TIMESTAMP < 15 * 60){
$TIMELEFT = 15;	
}elseif ($AUCTIONDETAILS['endTime'] - TIMESTAMP < 20 * 60){
$TIMELEFT = 20;	
}elseif ($AUCTIONDETAILS['endTime'] - TIMESTAMP < 25 * 60){
$TIMELEFT = 25;	
}elseif ($AUCTIONDETAILS['endTime'] - TIMESTAMP < 30 * 60){
$TIMELEFT = 30;	
}elseif ($AUCTIONDETAILS['endTime'] - TIMESTAMP < 35 * 60){
$TIMELEFT = 35;	
}elseif ($AUCTIONDETAILS['endTime'] - TIMESTAMP < 40 * 60){
$TIMELEFT = 40;	
}elseif ($AUCTIONDETAILS['endTime'] - TIMESTAMP < 45 * 60){
$TIMELEFT = 45;	
}

if($isActive == 0){
$Info ='O|'.$isActiveBid.'|'.$isUsername.'|'.$AUCTIONDETAILS['bidCount'].'|'.$NewIdEnchere.'|'.$TIMELEFT.'|'.$isUserid.'|'.$AUCTIONUSERLOG['total_bid'];
// 1) oui/non 
// 2) highest bid
// 3) highest bidder
// 4) amout of bids
// 5) ???
// 6) timeleft
// 7) userid
}else{
	$Info ='F|0|-|0|0|0|0|0';
}
echo $Info;

?> 