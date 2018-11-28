<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';
require 'includes/classes/class.Logcheck.php';

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
//$PageOfPlayer = floor(1 / config::get()->users_amount * $statData['total_rank'] * floor(config::get()->users_amount / 100));
$PageOfPlayer = 0;

$sql	= "SELECT * FROM %%PLANETS%% WHERE id = :planetid;";
$PLANETD	= $db->selectSingle($sql, array(
':planetid'	=> $session->planetId
));

$sql	= 'SELECT * FROM %%AUCTIONLOG%% WHERE auctionPage = :auctionPage ORDER BY total_bid DESC LIMIT 1;';
$AUCTIONLOGS = $db->selectSingle($sql, array(
	':auctionPage'	=> $PageOfPlayer,
));

$sql	= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
$USERINFO = $db->selectSingle($sql, array(
':userId' => $AUCTIONLOGS['userId']
));
	
$sql	= 'SELECT * FROM %%AUCTIONACTIVE%% WHERE auctionPage = :auctionPage ORDER BY endTime DESC LIMIT 1;';
$AUCTIONDETAILS = $db->selectSingle($sql, array(
	':auctionPage'	=> $PageOfPlayer,
));
	
if(empty($USERD) || empty($PLANETD))
exit();

$metals 		= HTTP::_GP('m', 0);
$crystals 		= HTTP::_GP('c', 0);
$deuterium 		= HTTP::_GP('d', 0);
$total			= $metals + $crystals * 2 + $deuterium * 3;
$Date	 		= HTTP::_GP('Date', 0);

if($PLANETD['metal'] < $metals || $PLANETD['crystal'] < $crystals || $PLANETD['deuterium'] < $deuterium){
	$Info ='KO|0';
}elseif($metals < 0 || $crystals < 0 || $deuterium < 0 || $total == 0){
	$Info ='KO|0';
}elseif($USERINFO['id'] == $USERD['id'] || $USERD['urlaubs_modus'] == 1){
	$Info ='KO|0';
}elseif($AUCTIONLOGS['total_bid'] + 1000000000 < $total){
	$Info ='KO|0';
}elseif($AUCTIONDETAILS['endTime'] <= TIMESTAMP){
	$lolCus = empty($USERD['customNick']) ? $USERD['username'] : $USERD['customNick'];
	PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$lolCus.' tryed to hack your auctioneer page', TIMESTAMP);
	$Info ='KO|0';
}else{
	$account_before = array(
		'metal'					=> $PLANETD['metal'],
		'crystal'				=> $PLANETD['crystal'],
		'deuterium'				=> $PLANETD['deuterium'],
		'Date'					=> $AUCTIONDETAILS['endTime'],
	);
	
	if($AUCTIONDETAILS['timesIncreased'] < 10 && $AUCTIONDETAILS['endTime'] - TIMESTAMP < 180){
		$sql	= "UPDATE %%AUCTIONACTIVE%% SET endTime = endTime + :newtime WHERE auctionId = :auctionId;";
		database::get()->update($sql, array(
			':newtime'		=> mt_rand(1,5), 
			':auctionId'	=> $AUCTIONDETAILS['auctionId'] 
		));		 
	}
	
	
	$sql	= "UPDATE %%AUCTIONACTIVE%% SET bidCount = bidCount + :bidCount WHERE cronjobEnd = :cronjobEnd AND auctionPage = :auctionPage;";
	$db->update($sql, array(
		':bidCount'		=> 1,
		':auctionPage'	=> $PageOfPlayer,
		':cronjobEnd'	=> 0
	));
	
	$PLANETD['metal'] -= $metals;
	$PLANETD['crystal'] -= $crystals;
	$PLANETD['deuterium'] -= $deuterium;
	$sql	= "UPDATE %%PLANETS%% SET metal = metal - :metal, crystal = crystal - :crystal, deuterium = deuterium - :deuterium WHERE id = :planetId;";
	$db->update($sql, array(
		':metal'		=> $metals,
		':crystal'		=> $crystals,
		':deuterium'	=> $deuterium,
		':planetId'		=> $PLANETD['id']
	));
	$sql = "INSERT INTO %%AUCTIONLOG%% SET
		   auctionid		= :auctionid,
		   userId			= :userId,
		   metal_bid		= :metal_bid,
		   crystal_bid		= :crystal_bid,
		   deuterium_bid	= :deuterium_bid,
		   timestamp		= :timestamp,
		   auctionPage		= :auctionPage,
		   total_bid		= :total_bid ON duplicate KEY UPDATE metal_bid = metal_bid + :metal_bid, crystal_bid = crystal_bid + :crystal_bid, deuterium_bid = deuterium_bid + :deuterium_bid, total_bid = total_bid + :total_bid, timestamp = :timestamp, auctionPage = :auctionPage;";

	$db->insert($sql, array(
		':auctionid'			=> $AUCTIONDETAILS['auctionId'],
		':userId'				=> $USERD['id'],
		':metal_bid'			=> $metals,
		':crystal_bid'			=> $crystals,
		':deuterium_bid'		=> $deuterium,
		':timestamp'		=> TIMESTAMP,
		':auctionPage'		=> $PageOfPlayer,
		':total_bid'			=> $metals + $crystals * 2 + $deuterium * 3
	));

	$sql	= "SELECT * FROM %%PLANETS%% WHERE id = :planetid;";
	$PLANETDD	= $db->selectSingle($sql, array(
	':planetid'	=> $session->planetId
	));

	$account_after = array(
		'metal'					=> $PLANETDD['metal'],
		'crystal'				=> $PLANETDD['crystal'],
		'deuterium'				=> $PLANETDD['deuterium'],
		'Date'					=> $AUCTIONDETAILS['endTime'],
	);

	$LOG = new Logcheck(6);
	$LOG->username = empty($USERD['customNick']) ? $USERD['username'] : $USERD['customNick'];
	$LOG->pageLog = "page=auctioneer [Make Bid]";
	$LOG->old = $account_before;
	$LOG->new = $account_after;
	$LOG->save();
				
	if($USERINFO['auctionMessage'] == 1){
		$LNG = new Language($USERINFO['lang']);
		$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
		$sql	= 'SELECT * FROM %%AUCTIONLOG%% WHERE auctionPage = :auctionPage ORDER BY total_bid DESC LIMIT 1;';
		$AUCTIONLOGSD = $db->selectSingle($sql, array(
			':auctionPage'		=> $PageOfPlayer,
		));

		$totalx = $AUCTIONLOGSD['total_bid'];
		$TIMELEFT = 0;
		if ($AUCTIONDETAILS['endTime'] - TIMESTAMP < 5 * 60){
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
		$valCus = empty($USERD['customNick']) ? $USERD['username'] : $USERD['customNick'];
		$Msg = sprintf($LNG['auctioneer_21'], $valCus, $LNG['auctioneer_booster'][$AUCTIONDETAILS['itemId']], pretty_number($totalx), $TIMELEFT, $LNG['auctioneer_23']);
		PlayerUtil::sendMessage($AUCTIONLOGS['userId'], '', $LNG['auctioneer_2'], 4, $LNG['auctioneer_22'], $Msg, TIMESTAMP);
	} 
	$Info ='OK|'.$total;	
}

echo $Info;


?> 