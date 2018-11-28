<?php

define('MODE', 'BANNER');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);
require 'includes/pages/game/AbstractGamePage.class.php';
require 'includes/pages/game/ShowErrorPage.class.php';
require 'includes/classes/class.Logcheck.php';
require 'includes/common.php';


function widrawAmMarket($widrawAmount, $userId) {
	global $USER;
	$sql	= 'SELECT antimatter, antimatter_bought FROM %%USERS%% WHERE id = :userId;';
	$getUser = database::get()->selectSingle($sql, array(
		':userId'		=> $userId,
	));
		
	if($getUser['antimatter'] >= $widrawAmount){
		$USER['antimatter'] -= $widrawAmount;
		$USER['antimatter_bought'] -= ($widrawAmount - $getUser['antimatter']);
		$sql	= 'UPDATE %%USERS%% SET antimatter = antimatter - :antimatter WHERE id = :userId;';
		database::get()->update($sql, array(
			':antimatter'	=> $widrawAmount,
			':userId'		=> $userId,
		));
	}elseif(($getUser['antimatter'] + $getUser['antimatter_bought']) >= $widrawAmount){
		$USER['antimatter'] = 0;
		$USER['antimatter_bought'] -= ($widrawAmount - $getUser['antimatter']);
		$sql	= 'UPDATE %%USERS%% SET antimatter = 0, antimatter_bought = antimatter_bought - :antimatter_bought WHERE id = :userId;';
		database::get()->update($sql, array(
			':antimatter_bought'	=> $widrawAmount - $getUser['antimatter'],
			':userId'				=> $userId,
		));
	}
}

$session	= Session::load();
$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
$USER	= Database::get()->selectSingle($sql, array(
':userId'	=> $session->userId
));

$LNG = new Language($USER['lang']);
$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME'));

$arr = array ();
$left_line 	 	= HTTP::_GP('left_line', '', UTF8_SUPPORT);
$content_line	= HTTP::_GP('content_line', '', UTF8_SUPPORT);
$purchase_line	= HTTP::_GP('purchase_line', '', UTF8_SUPPORT);

if($left_line == "default"){
$arr = array ('LEFT' => array('HTML'=>'<span onclick="LEFTSIDE(\'upgrade\');" class="market_left_btn">'.$LNG['market_1'].'</span><span onclick="LEFTSIDE(\'planet\');" class="market_left_btn">'.$LNG['market_2'].'</span><span onclick="LEFTSIDE(\'auction\');" class="market_left_btn">'.$LNG['auctioneer_24'].'</span>'));	

//$arr = array ('LEFT' => array('HTML'=>'<span onclick="LEFTSIDE(\'upgrade\');" class="market_left_btn">'.$LNG['market_1'].'</span><span onclick="LEFTSIDE(\'auction\');" class="market_left_btn">'.$LNG['auctioneer_24'].'</span>'));	

}elseif($left_line == "upgrade"){
$arr = array ('LEFT' => array('HTML'=>'<span onclick="LEFTSIDE(\'default\');" class="market_left_btn market_left_btn_mini">←</span>
	<span class="market_left_title">'.$LNG['market_1'].'</span>
	<div class="clear"></div>
	<label>'.$LNG['market_3'].':</label>
	<select id="upgrade_name">
		<option value="">'.$LNG['market_4'].'</option><option value="laser">'.$LNG['market_5'].'</option><option value="ion">'.$LNG['market_6'].'</option><option value="plasma">'.$LNG['market_7'].'</option><option value="gravity">'.$LNG['market_8'].'</option><option value="dlight">'.$LNG['market_9'].'</option><option value="dmedium">'.$LNG['market_10'].'</option><option value="dheavy">'.$LNG['market_11'].'</option><option value="slight">'.$LNG['market_12'].'</option><option value="smedium">'.$LNG['market_13'].'</option><option value="sheavy">'.$LNG['market_14'].'</option><option value="combustion">'.$LNG['market_15'].'</option><option value="impulse">'.$LNG['market_16'].'</option><option value="hyperspace">'.$LNG['market_17'].'</option><option value="res901">'.$LNG['market_18'].'</option><option value="res902">'.$LNG['market_19'].'</option><option value="res903">'.$LNG['market_20'].'</option><option value="conveyor1">'.$LNG['market_73'].'</option><option value="conveyor2">'.$LNG['market_74'].'</option><option value="conveyor3">'.$LNG['market_75'].'</option>
	</select>
	<label>'.$LNG['market_21'].':</label>
	<input id="max_cost" min="0" value="0" type="number"><br>
	<label>'.$LNG['market_22'].':</label>
	<input id="min_count" min="0" value="0" type="number"><br>
	<div class="clear" style="margin:10px 0;"></div>
	<input id="gr_search" onclick="SEARCHUPGRADE();" value="'.$LNG['market_23'].'" type="button">'));	
}elseif($left_line == "planet"){
$arr = array ('LEFT' => array('HTML'=>'<span onclick="LEFTSIDE(\'default\');" class="market_left_btn market_left_btn_mini">←</span>
	<span class="market_left_title">'.$LNG['market_24'].'</span>
	<div class="clear"></div>

	<label>'.$LNG['market_54'].':</label>
	<select id="ssort"> 
		<option value="cost" selected="selected">'.$LNG['market_25'].'</option>
		<option value="fildes">'.$LNG['market_26'].'</option>
		<option value="collider">'.$LNG['market_27'].'</option>	
		<option value="points">'.$LNG['market_28'].'</option>
		<option value="points_b">'.$LNG['market_29'].'</option>
		<option value="points_d">'.$LNG['market_30'].'</option>
		<option value="points_b_p">'.$LNG['market_31'].'</option>
		<option value="points_d_p">'.$LNG['market_32'].'</option>
		<option value="points_b_l">'.$LNG['market_33'].'</option>
		<option value="points_d_l">'.$LNG['market_34'].'</option>	
	</select><br><br>
	<input id="sort" value="1" type="checkbox">
	<label style="display:inline;" for="sort"> '.$LNG['market_35'].'</label>
	<div class="clear" style="margin-top:10px;"></div>

	<span class="market_left_title">'.$LNG['market_36'].'</span>
	<div class="clear" style="margin-bottom:10px;"></div>
	<label>'.$LNG['market_37'].':</label>
	<input id="max_cost" value="0" min="0" type="number"><br>
	<label>'.$LNG['market_38'].':</label>
	<input id="fildes" value="0" min="0" type="number"><br>
	<label>'.$LNG['market_39'].':</label>
	<input id="points_b_p" value="0" min="0" type="number"><br>
	<label>'.$LNG['market_40'].':</label>
	<input id="points_d_p" value="0" min="0" type="number"><br>
	<div class="clear" style="margin-top:10px;"></div>

	<span class="market_left_title">'.$LNG['market_41'].'</span>
	<div class="clear" style="margin-bottom:10px;"></div>
	<input id="luna" value="1" type="checkbox">
	<label style="display:inline;" for="luna"> '.$LNG['market_42'].'</label>
	<label>'.$LNG['market_43'].':</label>
	<input id="points_b_l" value="0" min="0" type="number"><br>
	<label>'.$LNG['market_44'].':</label>
	<input id="points_d_l" value="0" min="0" type="number"><br>
	<label>'.$LNG['market_45'].':</label>
	<input id="collider" value="0" min="0" type="number"><br>
<div class="clear" style="margin:10px 0;"></div>
	<input id="gr_search" onclick="SEARCHPLANET();" value="'.$LNG['market_46'].'" type="button">'));	
}elseif($left_line == "auction"){
$arr = array ('LEFT' => array('HTML'=>'<span onclick="LEFTSIDE(\'default\');" class="market_left_btn market_left_btn_mini">←</span>
	<span class="market_left_title">'.$LNG['auctioneer_24'].'</span>
	<div class="clear"></div>
	<label>'.$LNG['market_3'].':</label>
	<select id="item_name">
		<option value="">'.$LNG['market_4'].'</option><option value="auction_item_1">'.$LNG['auctioneer_booster'][1].'</option><option value="auction_item_2">'.$LNG['auctioneer_booster'][2].'</option><option value="auction_item_3">'.$LNG['auctioneer_booster'][3].'</option><option value="auction_item_4">'.$LNG['auctioneer_booster'][4].'</option><option value="auction_item_5">'.$LNG['auctioneer_booster'][5].'</option><option value="auction_item_6">'.$LNG['auctioneer_booster'][6].'</option><option value="auction_item_7">'.$LNG['auctioneer_booster'][7].'</option><option value="auction_item_8">'.$LNG['auctioneer_booster'][8].'</option><option value="auction_item_9">'.$LNG['auctioneer_booster'][9].'</option><option value="auction_item_10">'.$LNG['auctioneer_booster'][10].'</option><option value="auction_item_11">'.$LNG['auctioneer_booster'][11].'</option><option value="auction_item_12">'.$LNG['auctioneer_booster'][12].'</option><option value="auction_item_13">'.$LNG['auctioneer_booster'][13].'</option><option value="auction_item_14">'.$LNG['auctioneer_booster'][14].'</option><option value="auction_item_15">'.$LNG['auctioneer_booster'][15].'</option><option value="auction_item_16">'.$LNG['auctioneer_booster'][16].'</option><option value="auction_item_17">'.$LNG['auctioneer_booster'][17].'</option><option value="auction_item_18">'.$LNG['auctioneer_booster'][18].'</option><option value="auction_item_19">'.$LNG['auctioneer_booster'][19].'</option><option value="auction_item_20">'.$LNG['auctioneer_booster'][20].'</option><option value="auction_item_21">'.$LNG['auctioneer_booster'][21].'</option>
		
	</select>
	<label>'.$LNG['market_21'].':</label>
	<input id="max_cost" min="0" value="0" type="number"><br>
	<label>'.$LNG['market_22'].':</label>
	<input id="min_count" min="0" value="0" type="number"><br>
	<div class="clear" style="margin:10px 0;"></div>
	<input id="gr_search" onclick="SEARCHAUCTION();" value="'.$LNG['market_23'].'" type="button">'));	
}elseif($content_line == "upgrade"){

$upgradeResult  = array();
$max_cost		= HTTP::_GP('max_cost', 0);
$name			= HTTP::_GP('name', '', UTF8_SUPPORT);
$min_count		= HTTP::_GP('min_count', 0);

if($min_count < 0)
	$min_count = 0;
if($max_cost < 0)
	$max_cost = 0;
$isAll  = $name != "" ? "AND upgradeName = '".$name."' ORDER BY RAND() LIMIT 500" : "ORDER BY RAND() LIMIT 500" ;

$sql = "SELECT * FROM %%PLANETUPGRADE%% WHERE upgradeOwner != :upgradeOwner AND upgradePrice >= :upgradePrice AND upgradeCount >= :upgradeCount ".$isAll."";
$upgradeResults = Database::get()->select($sql, array(
		':upgradeOwner'		=> $USER['id'],
		':upgradePrice'		=> $max_cost,
		':upgradeCount'		=> $min_count
));

if(count($upgradeResults) == 0){
$completeTable = '<p style="padding:10px;">'.$LNG['market_71'].'</p>';
}else{
$completeTable = '<table class="tablesorter ally_ranks lots">
        <tbody><tr>
        	<th class="gray_stripe" style="width:10px;">&nbsp;</th> 
            <th class="gray_stripe">&nbsp;</th> 
            <th class="gray_stripe">'.$LNG['manual_5_33'].'</th>  
            <th class="gray_stripe">'.$LNG['market_25'].'</th> 
            <th class="gray_stripe" style="width:10px;">&nbsp;</th>
        </tr>';
	$completeTable .= '</tbody></table>';
foreach($upgradeResults as $query){

if($query['upgradeName'] == "laser"){
$upgName = $LNG['market_5'];
}elseif($query['upgradeName'] == "ion"){
$upgName = $LNG['market_6'];
}elseif($query['upgradeName'] == "plasma"){
$upgName = $LNG['market_7'];
}elseif($query['upgradeName'] == "gravity"){
$upgName = $LNG['market_8'];
}elseif($query['upgradeName'] == "dlight"){
$upgName = $LNG['market_9'];
}elseif($query['upgradeName'] == "dmedium"){
$upgName = $LNG['market_10'];
}elseif($query['upgradeName'] == "dheavy"){
$upgName = $LNG['market_11'];
}elseif($query['upgradeName'] == "slight"){
$upgName = $LNG['market_12'];
}elseif($query['upgradeName'] == "smedium"){
$upgName = $LNG['market_13'];
}elseif($query['upgradeName'] == "sheavy"){
$upgName = $LNG['market_14'];
}elseif($query['upgradeName'] == "combustion"){
$upgName = $LNG['market_15'];
}elseif($query['upgradeName'] == "impulse"){
$upgName = $LNG['market_16'];
}elseif($query['upgradeName'] == "hyperspace"){
$upgName = $LNG['market_17'];
}elseif($query['upgradeName'] == "res901"){
$upgName = $LNG['market_18'];
}elseif($query['upgradeName'] == "res902"){
$upgName = $LNG['market_19'];
}elseif($query['upgradeName'] == "res903"){
$upgName = $LNG['market_20'];
}elseif($query['upgradeName'] == "conveyor1"){
$upgName = $LNG['market_73'];
}elseif($query['upgradeName'] == "conveyor2"){
$upgName = $LNG['market_74'];
}elseif($query['upgradeName'] == "conveyor3"){
$upgName = $LNG['market_75'];
}
	
$textOne = sprintf($LNG['market_78'], $query['upgradeID']);
$completeTable .= '<div id="'.$query['upgradeID'].'" class="rd_planet_row td_planet_delivery marketto1">    
                        
        <div class="rd_planet_img">
        <img title="'.$upgName.'" src="//static.warofgalaxyz.com/media/gamemedia/styles/theme/gow/gebaeude/up/'.$query['upgradeName'].'.jpg" alt="'.$upgName.'">
        </div>
        
        <div class="rd_planet_data_name" style="width:55%;">
            <span style="color:#54989d;position:absolute;">'.$upgName.'</span><br>            
            <span style="color:#CCC;">'.$LNG['market_59'].': </span><span style="color:#CCC;">'.$query['upgradeCount'].'</span><br>
            <span style="color:#CCC;">'.$LNG['market_56'].': </span><span class="marketto2">'.pretty_number($query['upgradePrice']).'<img src="https://static.warofgalaxyz.com/media/gamemedia/styles/images/atm.gif" class="marketto3">
</span>
							                    </div>
        
        <div class="rd_planet_resours marketto4" style="width:20%">        
        	            
               <input class="pren_btn_buy" value="'.$LNG['market_50'].'" type="submit" style="height: 51px;padding-left: 5px; width: 90px;" onclick="BUYUPGRADE('.$query['upgradeID'].', \''.$textOne.'\', \''.$LNG['market_79'].'\', '.$query['upgradePrice'].');">      
            
        </div>       
        
    </div>';
}

}
$arr = array ('CONTENT' => array('HTML'=>$completeTable));	
}elseif($content_line == "auction"){

$auctionResult  = array();
$max_cost		= HTTP::_GP('max_cost', 0);
$name			= HTTP::_GP('name', '', UTF8_SUPPORT);
$min_count		= HTTP::_GP('min_count', 0);
if($min_count < 0)
	$min_count = 0;
if($max_cost < 0)
	$max_cost = 0;
$isAll  = $name != "" ? "AND upgradeName = '".$name."' ORDER BY RAND() LIMIT 500" : "ORDER BY RAND() LIMIT 500" ;

$sql = "SELECT * FROM %%PLANETITEMS%% WHERE upgradeOwner != :upgradeOwner AND upgradePrice >= :upgradePrice AND upgradeCount >= :upgradeCount ".$isAll."";
$auctionResult = Database::get()->select($sql, array(
		':upgradeOwner'		=> $USER['id'],
		':upgradePrice'		=> $max_cost,
		':upgradeCount'		=> $min_count
));

if(count($auctionResult) == 0){
$completeTable = '<p style="padding:10px;">'.$LNG['market_71'].'</p>';
}else{
$completeTable = '<table class="tablesorter ally_ranks lots">
        <tbody><tr>
        	<th class="gray_stripe" style="width:10px;">&nbsp;</th> 
            <th class="gray_stripe">&nbsp;</th> 
            <th class="gray_stripe">'.$LNG['manual_5_33'].'</th>  
            <th class="gray_stripe">'.$LNG['market_25'].'</th> 
            <th class="gray_stripe" style="width:10px;">&nbsp;</th>
        </tr>';
	$completeTable .= '</tbody></table>';
foreach($auctionResult as $query){

if($query['upgradeName'] == "auction_item_1"){
$upgName = $LNG['auctioneer_booster'][1];
}elseif($query['upgradeName'] == "auction_item_2"){
$upgName = $LNG['auctioneer_booster'][2];
}elseif($query['upgradeName'] == "auction_item_3"){
$upgName = $LNG['auctioneer_booster'][3];
}elseif($query['upgradeName'] == "auction_item_4"){
$upgName = $LNG['auctioneer_booster'][4];
}elseif($query['upgradeName'] == "auction_item_5"){
$upgName = $LNG['auctioneer_booster'][5];
}elseif($query['upgradeName'] == "auction_item_6"){
$upgName = $LNG['auctioneer_booster'][6];
}elseif($query['upgradeName'] == "auction_item_7"){
$upgName = $LNG['auctioneer_booster'][7];
}elseif($query['upgradeName'] == "auction_item_8"){
$upgName = $LNG['auctioneer_booster'][8];
}elseif($query['upgradeName'] == "auction_item_9"){
$upgName = $LNG['auctioneer_booster'][9];
}elseif($query['upgradeName'] == "auction_item_10"){
$upgName = $LNG['auctioneer_booster'][10];
}elseif($query['upgradeName'] == "auction_item_11"){
$upgName = $LNG['auctioneer_booster'][11];
}elseif($query['upgradeName'] == "auction_item_12"){
$upgName = $LNG['auctioneer_booster'][12];
}elseif($query['upgradeName'] == "auction_item_13"){
$upgName = $LNG['auctioneer_booster'][13];
}elseif($query['upgradeName'] == "auction_item_14"){
$upgName = $LNG['auctioneer_booster'][14];
}elseif($query['upgradeName'] == "auction_item_15"){
$upgName = $LNG['auctioneer_booster'][15];
}elseif($query['upgradeName'] == "auction_item_16"){
$upgName = $LNG['auctioneer_booster'][16];
}elseif($query['upgradeName'] == "auction_item_17"){
$upgName = $LNG['auctioneer_booster'][17];
}elseif($query['upgradeName'] == "auction_item_18"){
$upgName = $LNG['auctioneer_booster'][18];
}elseif($query['upgradeName'] == "auction_item_19"){
$upgName = $LNG['auctioneer_booster'][19];
}elseif($query['upgradeName'] == "auction_item_20"){
$upgName = $LNG['auctioneer_booster'][20];
}elseif($query['upgradeName'] == "auction_item_21"){
$upgName = $LNG['auctioneer_booster'][21];
}
$textOne = sprintf($LNG['market_78'], $query['itemID']);
$completeTable .= '<div id="'.$query['itemID'].'" class="rd_planet_row td_planet_delivery marketto1">    
                        
        <div class="rd_planet_img">
        <img title="'.$upgName.'" src="//static.warofgalaxyz.com/media/gamemedia/styles/images/auction/'.$query['upgradeName'].'.gif" alt="'.$upgName.'">
        </div>
        
        <div class="rd_planet_data_name" style="width:55%;">
            <span style="color:#54989d;position:absolute;">'.$upgName.'</span><br>            
            <span style="color:#CCC;">'.$LNG['market_59'].': </span><span style="color:#CCC;">'.$query['upgradeCount'].'</span><br>
            <span style="color:#CCC;">'.$LNG['market_56'].': </span><span class="marketto2">'.pretty_number($query['upgradePrice']).'<img src="//static.warofgalaxyz.com/media/gamemedia/styles/images/atm.gif" class="marketto3">
</span>
							                    </div>
        
        <div class="rd_planet_resours marketto4" style="width:20%;">        
        	            
               <input class="pren_btn_buy" value="'.$LNG['market_50'].'" type="submit" style="height: 51px;padding-left: 5px; width: 90px;" onclick="BUYAUCTION('.$query['itemID'].', \''.$textOne.'\', \''.$LNG['market_79'].'\', '.$query['upgradePrice'].');">      
            
        </div>       
        
    </div>';
}

}
$arr = array ('CONTENT' => array('HTML'=>$completeTable));	
}elseif($content_line == "planet"){

$planetsResult  = array();
$max_cost		= HTTP::_GP('max_cost', 0);
$ssort			= HTTP::_GP('ssort', 0);
$sort			= HTTP::_GP('sort', 0);
$fildes			= HTTP::_GP('fildes', 0);
$points_b_p		= HTTP::_GP('points_b_p', 0);
$points_d_p		= HTTP::_GP('points_d_p', 0);
$luna			= HTTP::_GP('luna', 0);
$points_b_l		= HTTP::_GP('points_b_l', 0);
$points_d_l		= HTTP::_GP('points_d_l', 0);
$collider		= HTTP::_GP('collider', 0);

$order = $sort == 1 ? "DESC" : "ASC" ;
$hasLuna  = $luna == 1 ? "AND hasMoon > 0 AND points_b_l >= ".$points_b_l." AND points_b_l >= ".$points_d_l." AND collider >= ".$collider : "" ;

if(!is_int($max_cost) || !is_int($fildes) || !is_int($points_b_p) || !is_int($points_d_p) || !is_int($points_b_l) || !is_int($points_d_l) || !is_int($collider)){
$completeTable = '<p style="padding:10px;">'.$LNG['market_71'].'</p>';
}else{

$sql = "SELECT * FROM %%PLANETAUCTION%% WHERE selledID != :selledID AND price >= :max_cost AND max_fields >= :fildes AND points_b_p >= :points_b_p AND points_d_p >= :points_d_p ".$hasLuna." ORDER BY ";

	switch($ssort)
	{
		case 'cost':
			$sql	.= 'price '.$order.' LIMIT 50';
			break;
		case 'fildes':
			$sql	.= 'max_fields '.$order.' LIMIT 50';
			break;
		case 'collider':
			$sql	.= 'collider '.$order.' LIMIT 50';
			break;
		case 'points':
			$sql	.= 'points '.$order.' LIMIT 50';
			break;
		case 'points_b':
			$sql	.= 'points_b '.$order.' LIMIT 50';
			break;
		case 'points_d':
			$sql	.= 'points_d '.$order.' LIMIT 50';
			break;
		case 'points_b_p':
			$sql	.= 'points_b_p '.$order.' LIMIT 50';
			break;
		case 'points_d_p':
			$sql	.= 'points_d_p '.$order.' LIMIT 50';
			break;
		case 'points_b_l':
			$sql	.= 'points_b_l '.$order.' LIMIT 50';
			break;
		case 'points_d_l':
			$sql	.= 'points_d_l '.$order.' LIMIT 50';
			break;
	}

	$planetsResults = Database::get()->select($sql, array(
		':selledID'		=> $USER['id'],
		':max_cost'		=> $max_cost,
		':fildes'		=> $fildes,
		':points_b_p'		=> $points_b_p,
		':points_d_p'		=> $points_d_p
   	));

if(count($planetsResults) == 0){
$completeTable = '<p style="padding:10px;">'.$LNG['market_71'].'</p>';
}else{
$completeTable = '<table class="tablesorter ally_ranks lots">
        <tbody><tr>
        	<th class="gray_stripe" style="width:10px;">№</th> 
            <th class="gray_stripe">&nbsp;</th> 
			<th class="gray_stripe">&nbsp;</th> 
			<th class="gray_stripe">'.$LNG['market_26'].'</th> 
            <th class="gray_stripe">'.$LNG['market_28'].'</th>  
            <th class="gray_stripe">'.$LNG['market_25'].'</th> 
			<th class="gray_stripe">'.$LNG['market_67'].'</th> 
            <th class="gray_stripe" style="width:10px;">&nbsp;</th>
        </tr>';

foreach($planetsResults as $query){

$timeLeft				= _date("d F y, H:i:s",($query['time']));
$hasMoonAvailible		= $query['hasMoon'] != 0 ? '<a href="#" onclick="return Dialog.PlanetLotInfo('.$query['hasMoon'].');" title="'.$LNG['market_68'].'"><img src="//static.warofgalaxyz.com/media/gamemedia/styles/images/iconav/moon.png" alt="'.$LNG['market_68'].'"></a>' : "";

$totalPoints = shortly_number($query['points_b_p'] + $query['points_d_p'] + $query['points_b_l'] + $query['points_d_l']);
$defensePointP = pretty_number($query['points_d_p']);
$defensePointM = pretty_number($query['points_d_l']);
$buildingPointM = pretty_number($query['points_b_l']);
$buildingPointP = pretty_number($query['points_b_p']);

$miomone = "";
if($query['buyerID'] == $USER['id'])
	$miomone = "mionome";
$completeTable .=		'<tr class="'.$miomone.'"><td>'.$query['auctionID'].'</td><td><a href="#" onclick="return Dialog.PlanetLotInfo('.$query['planetID'].');">
		<img src="//static.warofgalaxyz.com/media/gamemedia/styles/images/iconav/over.png" alt="'.$LNG['market_66'].'"></a></td><td>'.$hasMoonAvailible.'</td><td>'.$query['max_fields'].'</td><td><span class="tooltip" style="cursor:help !important" data-tooltip-content="
		<b>'.$LNG['planet_tele_pla'].'</b><br />
		• '.$LNG['pl_builds'].': '.$buildingPointP.'<br />
		• '.$LNG['pl_def'].': '.$defensePointP.'<br /><br />
		<b>'.$LNG['market_69'].'</b><br />
		• '.$LNG['pl_builds'].': '.$buildingPointM.'<br />
		• '.$LNG['pl_def'].': '.$defensePointM.'<br />
		">
		'.$totalPoints.'</span></td><td>'.pretty_number($query['price']).'</td><td>'.$timeLeft.'</td><td>
			<span style="cursor:pointer" onclick="return Dialog.PlanetLotRate('.$query['auctionID'].');">
                	<img src="//static.warofgalaxyz.com/media/gamemedia/styles/images/iconav/buy.png" alt="" height="16" width="16"></span></td></tr>';
}

$completeTable .= '</tbody></table>';
}
}
$arr = array ('CONTENT' => array('HTML'=>$completeTable));	
}elseif($purchase_line == "upgrade"){

$upgradeID		= HTTP::_GP('id', 0);

$sql = "SELECT * FROM %%PLANETUPGRADE%% WHERE upgradeID = :upgradeID";
$upgradeResults = Database::get()->selectSingle($sql, array(
		':upgradeID'		=> $upgradeID
));

if(Database::get()->rowCount($upgradeResults) == 0)
	return false;

if(($USER['antimatter'] + $USER['antimatter_bought']) < $upgradeResults['upgradePrice'])
	return false;

$name = $upgradeResults['upgradeName'];

$account_before = array(
	'arsenal_'.$name		=> $USER['arsenal_'.$name],
	'antimatter'			=> $USER['antimatter'],
	'antimatter_bought'		=> $USER['antimatter_bought'],
	'price'					=> $upgradeResults['upgradePrice'],
);
		
widrawAmMarket($upgradeResults['upgradePrice'], $USER['id']);
$sql = "UPDATE %%USERS%% SET arsenal_".$name." = arsenal_".$name." + :count WHERE id = :userid;";
Database::get()->update($sql, array(
//':antimatter' => $upgradeResults['upgradePrice'],
':count' => $upgradeResults['upgradeCount'],
':userid' => $USER['id']
));

$sql	= 'SELECT arsenal_'.$name.', antimatter, antimatter_bought FROM %%USERS%% WHERE id = :userId;';
$getUser = database::get()->selectSingle($sql, array(
	':userId'		=> $USER['id'],
));
			
$account_after = array(
	'arsenal_'.$name		=> $getUser['arsenal_'.$name],
	'antimatter'			=> $getUser['antimatter'],
	'antimatter_bought'		=> $getUser['antimatter_bought'],
	'price'					=> $upgradeResults['upgradePrice'],
);

$LOG = new Logcheck(15);
$LOG->username = $USER['username'];
$LOG->pageLog = "page=market [Buy Upgrade]";
$LOG->old = $account_before;
$LOG->new = $account_after;
$LOG->save();

$rewardPrice = $upgradeResults['upgradePrice'] - round($upgradeResults['upgradePrice'] / 100 * 5);
$sql = "UPDATE %%USERS%% SET antimatter = antimatter + :antimatter WHERE id = :userid;";
Database::get()->update($sql, array(
':antimatter' => $rewardPrice,
':userid' => $upgradeResults['upgradeOwner']
));

$sql = "DELETE FROM %%PLANETUPGRADE%% WHERE upgradeID = :upgradeID;";
Database::get()->delete($sql, array(
':upgradeID' => $upgradeID
));

if($upgradeResults['upgradeName'] == "laser"){
$upgName = $LNG['market_5'];
}elseif($upgradeResults['upgradeName'] == "ion"){
$upgName = $LNG['market_6'];
}elseif($upgradeResults['upgradeName'] == "plasma"){
$upgName = $LNG['market_7'];
}elseif($upgradeResults['upgradeName'] == "gravity"){
$upgName = $LNG['market_8'];
}elseif($upgradeResults['upgradeName'] == "dlight"){
$upgName = $LNG['market_9'];
}elseif($upgradeResults['upgradeName'] == "dmedium"){
$upgName = $LNG['market_10'];
}elseif($upgradeResults['upgradeName'] == "dheavy"){
$upgName = $LNG['market_11'];
}elseif($upgradeResults['upgradeName'] == "slight"){
$upgName = $LNG['market_12'];
}elseif($upgradeResults['upgradeName'] == "smedium"){
$upgName = $LNG['market_13'];
}elseif($upgradeResults['upgradeName'] == "sheavy"){
$upgName = $LNG['market_14'];
}elseif($upgradeResults['upgradeName'] == "combustion"){
$upgName = $LNG['market_15'];
}elseif($upgradeResults['upgradeName'] == "impulse"){
$upgName = $LNG['market_16'];
}elseif($upgradeResults['upgradeName'] == "hyperspace"){
$upgName = $LNG['market_17'];
}elseif($upgradeResults['upgradeName'] == "res901"){
$upgName = $LNG['market_18'];
}elseif($upgradeResults['upgradeName'] == "res902"){
$upgName = $LNG['market_19'];
}elseif($upgradeResults['upgradeName'] == "res903"){
$upgName = $LNG['market_20'];
}elseif($upgradeResults['upgradeName'] == "conveyor1"){
$upgName = $LNG['market_73'];
}elseif($upgradeResults['upgradeName'] == "conveyor2"){
$upgName = $LNG['market_74'];
}elseif($upgradeResults['upgradeName'] == "conveyor3"){
$upgName = $LNG['market_75'];
}
$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
$USERGQAT	= Database::get()->selectSingle($sql, array(
':userId'	=> $upgradeResults['upgradeOwner']
));
	
$LNG = new Language($USER['lang']);
$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME'));	
$Message = sprintf($LNG['market_81'], $upgName, $upgradeResults['upgradeCount'], pretty_number($upgradeResults['upgradePrice']));
	
$LNG = new Language($USERGQAT['lang']);
$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME'));	
$privateMessage = sprintf($LNG['market_88'], $upgName, $upgradeResults['upgradeCount'], pretty_number($rewardPrice));
PlayerUtil::sendMessage($upgradeResults['upgradeOwner'], '', $LNG['market_89'], 4, $LNG['lm_market'], $privateMessage, TIMESTAMP);

$arr = array ('MSG' => $Message);	
}elseif($purchase_line == "auction"){

$upgradeID		= HTTP::_GP('id', 0);

$sql = "SELECT * FROM %%PLANETITEMS%% WHERE itemID = :itemID";
$upgradeResults = Database::get()->selectSingle($sql, array(
		':itemID'		=> $upgradeID
));

if(Database::get()->rowCount($upgradeResults) == 0)
	return false;

if(($USER['antimatter'] + $USER['antimatter_bought']) < $upgradeResults['upgradePrice'])
	return false;

$name = $upgradeResults['upgradeName'];

$account_before = array(
	'arsenal_'.$name		=> $USER[$name],
	'antimatter'			=> $USER['antimatter'],
	'antimatter_bought'		=> $USER['antimatter_bought'],
	'price'					=> $upgradeResults['upgradePrice'],
);

widrawAmMarket($upgradeResults['upgradePrice'], $USER['id']);
$sql = "UPDATE %%USERS%% SET ".$name." = ".$name." + :count WHERE id = :userid;";
Database::get()->update($sql, array(
':count' => $upgradeResults['upgradeCount'],
':userid' => $USER['id']
));

$sql	= 'SELECT '.$name.', antimatter, antimatter_bought FROM %%USERS%% WHERE id = :userId;';
$getUser = database::get()->selectSingle($sql, array(
	':userId'		=> $USER['id'],
));
			
$account_after = array(
	'arsenal_'.$name		=> $getUser[$name],
	'antimatter'			=> $getUser['antimatter'],
	'antimatter_bought'		=> $getUser['antimatter_bought'],
	'price'					=> $upgradeResults['upgradePrice'],
);

$LOG = new Logcheck(15);
$LOG->username = $USER['username'];
$LOG->pageLog = "page=market [Buy Item]";
$LOG->old = $account_before;
$LOG->new = $account_after;
$LOG->save();

$rewardPrice = $upgradeResults['upgradePrice'] - round($upgradeResults['upgradePrice'] / 100 * 5);
$sql = "UPDATE %%USERS%% SET antimatter = antimatter + :antimatter WHERE id = :userid;";
Database::get()->update($sql, array(
':antimatter' => $rewardPrice,
':userid' => $upgradeResults['upgradeOwner']
));

$sql = "DELETE FROM %%PLANETITEMS%% WHERE itemID = :itemID;";
Database::get()->delete($sql, array(
':itemID' => $upgradeID
));
if($upgradeResults['upgradeName'] == "auction_item_1"){
$upgName = $LNG['auctioneer_booster'][1];
}elseif($upgradeResults['upgradeName'] == "auction_item_2"){
$upgName = $LNG['auctioneer_booster'][2];
}elseif($upgradeResults['upgradeName'] == "auction_item_3"){
$upgName = $LNG['auctioneer_booster'][3];
}elseif($upgradeResults['upgradeName'] == "auction_item_4"){
$upgName = $LNG['auctioneer_booster'][4];
}elseif($upgradeResults['upgradeName'] == "auction_item_5"){
$upgName = $LNG['auctioneer_booster'][5];
}elseif($upgradeResults['upgradeName'] == "auction_item_6"){
$upgName = $LNG['auctioneer_booster'][6];
}elseif($upgradeResults['upgradeName'] == "auction_item_7"){
$upgName = $LNG['auctioneer_booster'][7];
}elseif($upgradeResults['upgradeName'] == "auction_item_8"){
$upgName = $LNG['auctioneer_booster'][8];
}elseif($upgradeResults['upgradeName'] == "auction_item_9"){
$upgName = $LNG['auctioneer_booster'][9];
}elseif($upgradeResults['upgradeName'] == "auction_item_10"){
$upgName = $LNG['auctioneer_booster'][10];
}elseif($upgradeResults['upgradeName'] == "auction_item_11"){
$upgName = $LNG['auctioneer_booster'][11];
}elseif($upgradeResults['upgradeName'] == "auction_item_12"){
$upgName = $LNG['auctioneer_booster'][12];
}elseif($upgradeResults['upgradeName'] == "auction_item_13"){
$upgName = $LNG['auctioneer_booster'][13];
}elseif($upgradeResults['upgradeName'] == "auction_item_14"){
$upgName = $LNG['auctioneer_booster'][14];
}elseif($upgradeResults['upgradeName'] == "auction_item_15"){
$upgName = $LNG['auctioneer_booster'][15];
}elseif($upgradeResults['upgradeName'] == "auction_item_16"){
$upgName = $LNG['auctioneer_booster'][16];
}elseif($upgradeResults['upgradeName'] == "auction_item_17"){
$upgName = $LNG['auctioneer_booster'][17];
}elseif($upgradeResults['upgradeName'] == "auction_item_18"){
$upgName = $LNG['auctioneer_booster'][18];
}elseif($upgradeResults['upgradeName'] == "auction_item_19"){
$upgName = $LNG['auctioneer_booster'][19];
}elseif($upgradeResults['upgradeName'] == "auction_item_20"){
$upgName = $LNG['auctioneer_booster'][20];
}elseif($upgradeResults['upgradeName'] == "auction_item_21"){
$upgName = $LNG['auctioneer_booster'][21];
}

$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
$USERGQAT	= Database::get()->selectSingle($sql, array(
':userId'	=> $upgradeResults['upgradeOwner']
));
	
$LNG = new Language($USER['lang']);
$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME'));	
$Message = sprintf($LNG['market_81'], $upgName, $upgradeResults['upgradeCount'], pretty_number($upgradeResults['upgradePrice']));
	
$LNG = new Language($USERGQAT['lang']);
$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME'));	
$privateMessage = sprintf($LNG['market_88'], $upgName, $upgradeResults['upgradeCount'], pretty_number($rewardPrice));
PlayerUtil::sendMessage($upgradeResults['upgradeOwner'], '', $LNG['market_89'], 4, $LNG['lm_market'], $privateMessage, TIMESTAMP);

$arr = array ('MSG' => $Message);	
}


echo json_encode($arr);
  
?>