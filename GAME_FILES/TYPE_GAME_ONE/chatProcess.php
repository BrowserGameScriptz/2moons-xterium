<?php
session_start();
require_once('include/vars.php');
require_once('include/config.php');
require_once('include/db.class.php');
require_once('include/tabsControl.php');
require_once('include/chat.class.php');
if ($translateServ) {
	require_once('include/translate.class.php');
}

// $logged=$_SESSION['your_logged_in_user_session']; // the session of the logged in user
// $_SESSION[$sessionVar]=$logged;  // ( when default login systeme is off )
$dataType='name';  // the type of the data given in the session ('id' or 'name') # if mode A is used put 'name'
if((!empty($_SESSION[$sessionVar]))&&(empty($_SESSION['chatUserId']))){
	$dataVar=$_SESSION[$sessionVar];
	switch($dataType){
		case 'name':
		$query="SELECT `".$userIdColomn."`,`".$statueColomn."`,`".$emailColomn."` from `".$srcDB."`.`".$usersTable."` where ".$nameColomn."='{$dataVar}' LIMIT 1";
		$colomn=$userIdColomn;
		break;
		case 'id':
		$query="SELECT `".$nameColomn."`,`".$statueColomn."`,`".$emailColomn."` from `".$srcDB."`.`".$usersTable."` where ".$userIdColomn."='{$dataVar}' LIMIT 1";
		$colomn=$nameColomn;
		break;
	}
	$res=$db->query($query);
	if($res){
			$data=$db->retrieve_data($res);
			switch($colomn){
				case $userIdColomn:
					$id=$data[0][$colomn];
					$stat=$data[0][$statueColomn];
					$email=$data[0][$emailColomn];
					$me=$_SESSION[$sessionVar];
					$_SESSION[$sessionVar]='';
					$_SESSION['chatUserId']=$id;
					$_SESSION['chatUserName']=$me;
					$_SESSION['chatUserEmail']=md5( strtolower( trim( $email ) ) );
					$_SESSION['chatStat']=$stat;
				break;
				case $nameColomn:
					$me=$data[0][$colomn];
					$stat=$data[0][$statueColomn];
					$email=$data[0][$emailColomn];
					$id=$_SESSION[$sessionVar];
					$_SESSION[$sessionVar]='';
					$_SESSION['chatUserId']=$id;
					$_SESSION['chatUserName']=$me;
					$_SESSION['chatUserEmail']=md5( strtolower( trim( $email ) ) );
					$_SESSION['chatStat']=$stat;
				break;
			}
		}
	// update the user status to online if using mode b		
	if (!$useDefaultAuth) {
		$sessId= $_SESSION['chatUserId'];
		//update the user last_activity time
		$q="UPDATE `".$srcDB."`.`".$usersTable."` set `".$statueColomn."`='1' ,chat_last_activity=NOW() where ".$userIdColomn."='".$sessId."' ";
		$res=$db->query($q);
	}
}
if(!$useDefaultAuth){
	$usersTable=$usersTable4setup;
}

if (isset($_POST['cronix'])) {
	// delete all the chat messages that are older than $delMsgs hours
	$q="DELETE from `".$srcDB."`.`".$chatTable."` where ts < SUBTIME(NOW(),'$delMsgs:0:0') ";
	$res=$db->query($q);
	if (isset($_SESSION['chatUserId'])) {
		$sessId= $_SESSION['chatUserId'];
		//update the user last_activity time
		$q="UPDATE `".$srcDB."`.`".$usersTable."` set chat_last_activity=NOW() where ".$userIdColomn."='".$sessId."' ";
		$res=$db->query($q);
	}
	// make offline all the users that are not active within $delUsers secs
	$q="UPDATE `".$srcDB."`.`".$usersTable."` set `{$statueColomn}`='0' WHERE chat_last_activity < SUBTIME(NOW(),'0:0:$delUsers')";
	$res=$db->query($q);
	if($useDefaultAuth){
		// delete all the users that are not active within $delUsers secs
		$q="DELETE from `".$srcDB."`.`".$usersTable."` where chat_last_activity < SUBTIME(NOW(),'24:0:0') ";
		$res=$db->query($q);
	}
}

//when i click on the chat settings button
if(isset($_POST['stg'])){
	$statue=TabsControl::getStatue();
	if($statue){
		 $_SESSION['chatStat']=1;
		 echo'1';
	}else{ $_SESSION['chatStat']=0;echo'0';}
}

// when i send a chat msg
if(isset($_POST['say'])) {
	$chat->gravatar=$gravatar;
	$chat->meImg=$meImg;
	$chat->ref=$_POST['r'];
	$chat->msg=$_POST['say'];
	$chat->tzOffset=$tzOffset;
	if(!empty($chat->msg) || $chat->msg=='0'){ 
		$chat->prepareToSay();
		$chat->say();
	}
}
// check if i have recieved new chat message(s) from an open chat tab
if(isset($_POST['check'])){ 
	$chat->ref=$_POST['r'];
	$chat->typing=$_POST['t'];
	$chat->is_oldCheck=trim($_POST['old']); // if we r checking for the 1st time then we look for the history 
							  // else we check for new messages
	$chat->lastChatter=trim($_POST['lc']); //who was the last one who send a msg (me or (s)he ?)
	$chat->tzOffset=$tzOffset;
	$chat->gravatar=$gravatar;
	$chat->check();
}

// check if i have recieved new chat message(s)
// if mode B , it will check users and conversation too
if(isset($_POST['gCheck'])) { 
	$chat->tzOffset=$tzOffset;
	$chat->gCheck();
}
	
//when we change the chat statue (online/offline)
if(isset($_POST['s'])){
	$statue=$_POST['s'];
	if(strlen($statue)!=1){
		$sArr=explode('s',$statue);
		$statue=$sArr[1];
	}
	TabsControl::changeStatue($statue);
}
//get the open chat tabs (refresh case)
if(isset($_POST['getOpenTabs'])){
	TabsControl::getOpenTabs();
}
//when a user remove a chat tab
if(isset($_POST['removeRef'])){
	 $ref=$_POST['removeRef'];
	 TabsControl::removeTab($ref);
}

if (isset($_POST['translate'])) {
	if ($translateServ) {
		$now=time();
		if(empty($_SESSION['translateAuthTS'])){
			$_SESSION['translateAuthTS']=0;
		}
		if ($now >= $_SESSION['translateAuthTS']) { //the token has expired
			//Create the AccessTokenAuthentication object.
		    $authObj      = new AccessTokenAuthentication();
		    //Get the Access token.
		    if (is_object($authObj) && $authObj!="e") {
			    $accessToken  = $authObj->getTokens();
			    $_SESSION['translateAuthToken']=$accessToken;
		    }else{
		    	die("e");
		    }
		}else{
			$accessToken= $_SESSION['translateAuthToken'];
		}
		$accessToken=urlencode($accessToken);
		$to=urlencode($_POST['t']);
		$text=urlencode($_POST['tx']);
		$url="http://api.microsofttranslator.com/V2/Ajax.svc/Translate?appId=Bearer+".$accessToken."&to=".$to."&text=".$text;
		if(function_exists("file_get_contents($url)")){
			$trans=file_get_contents($url);
			$trans=str_replace('"', '', $trans);
			echo $trans;
		}else{
			die("e");
		}
	}else{
		die("e");
	}
}


if (isset($_POST['uid'])) {
	if ($typingServ) { // if typing service is enabled
		$chat->isTyping($_POST['uid']); // save in the DB that i'm writing
	}
}

if (isset($_POST['frds'])) { //get friends
	$sessId= $_SESSION['chatUserId'];
	$po=$_POST['frds'];
	switch ($po) {
		case 'f2': // friends
			die('Friends aren\'t supported in mode "A"');
		break;
		case 'f1': // anyone
			$q="SELECT `".$userIdColomn."`,`".$nameColomn."`,`".$emailColomn."` from `".$srcDB."`.`".$usersTable."` where ".$statueColomn."='1' and ".$userIdColomn."!= '".$sessId."' ";
			break;
		default:
			$q="";
			break;
	}
	if(!empty($q) && $po!="f2"){
		$res=$db->query($q);
		if($res){
			$data=$db->retrieve_data($res);
			$nbr=count($data);
			if($nbr==0){
				echo 'No one is online !';
			}else{
				foreach($data as $d){
					$id=$d[$userIdColomn];
					$email=md5(strtolower(trim($d[$emailColomn])));
					$avatarSrc = "http://www.gravatar.com/avatar/$email?s=20&d=identicon&r=g";
					$name=$d[$nameColomn];
					echo '<a href="#" class="onlineUsers" data-uid='.$id.' data-unk='.$name.'><img src='.$avatarSrc.' />'.$name.'</a>';
				}
			}
		}
	}
}

$db->close();exit;
?>