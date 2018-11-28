<?php
define('MODE', 'JSON');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';
	
function getClientIp()
{
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ipAddress = $_SERVER['HTTP_CLIENT_IP'];
	}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}elseif(!empty($_SERVER['HTTP_X_FORWARDED'])){
			$ipAddress = $_SERVER['HTTP_X_FORWARDED'];
    }elseif(!empty($_SERVER['HTTP_FORWARDED_FOR'])){
		$ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
    }elseif(!empty($_SERVER['HTTP_FORWARDED'])){
		$ipAddress = $_SERVER['HTTP_FORWARDED'];
    }elseif(!empty($_SERVER['REMOTE_ADDR'])){
		$ipAddress = $_SERVER['REMOTE_ADDR'];
    }else{
		$ipAddress = 'UNKNOWN';
    }
    return $ipAddress;
}
	
	$db = Database::get();

	$userId 			= HTTP::_GP('userId', '');
	$userName 			= HTTP::_GP('username', '', UTF8_SUPPORT);
	$password 			= HTTP::_GP('password', 'notneeded', true);
	$mailAddress 		= HTTP::_GP('email', '');
	$language 			= HTTP::_GP('lang', '');
	$referralID 		= HTTP::_GP('referralID', 0); 
	$encodage 			= HTTP::_GP('encodingplayer', '');
	$deviceId 			= HTTP::_GP('deviceId', '');
	$externalAuthUID	= 0;
	$externalAuthMethod	= '';
		
	if(empty($encodage)){
		HTTP::redirectTo('index.php?code=6');	
	}elseif(empty($userId)){
		HTTP::redirectTo('index.php?code=4');	
	}
		

	$sql = "SELECT id, password, username, bana, banaday, universe, email, authlevel, encodage, isUserOk, avatar FROM %%USERS%% WHERE id = :id;";
	$loginData = $db->selectSingle($sql, array(
		':id'	=> $userId
	));

	if (!empty($loginData)){
		$sql	= "UPDATE %%USERS%% SET peacefull_last_update = :peacefull_last_update, password = :password, email = :mailAddress WHERE id = :userId;";
		$db->update($sql, array(
			':peacefull_last_update'	=> TIMESTAMP,
			':password'					=> $password,
			':mailAddress'				=> $mailAddress,
			':userId'					=> $loginData['id']
		));
		
		$sql = "SELECT * FROM %%EMAILS%% WHERE email = :email;";
		$emailData = $db->selectSingle($sql, array(
			':email'	=> $loginData['email']
		));
		
		if(!empty($emailData) && $emailData['loggedSince'] == 0){
			$sql	= "UPDATE %%EMAILS%% SET loggedSince = :loggedSince WHERE email = :email;";
			$db->update($sql, array(
				':loggedSince'	=> TIMESTAMP,
				':email'		=> $loginData['email']
			));
		}
	
	
			
		$config = Config::get($loginData['universe']);
		if($config->game_disable == 0 && $loginData['authlevel'] == AUTH_USR) {
			HTTP::redirectTo('index.php?code=6');	
		}
			
		if($userName != $loginData['username'] || $loginData['encodage'] != $encodage && $loginData['isUserOk'] == 1) {
			HTTP::redirectTo('index.php?code=6');	
		}
			
		if(empty($loginData['encodage'])){
			$sql = "UPDATE %%USERS%% SET encodage = :encodage, isUserOk = :isUserOk WHERE id = :userid;";
			database::get()->update($sql, array(
				':encodage'	=> $encodage,
				':isUserOk'	=> 1,
				':userid'	=> (int) $loginData['id']
			));
		}
		
		if(!empty($deviceId)){
			$sql = "UPDATE %%USERS%% SET deviceId = :deviceId WHERE id = :userid;";
			database::get()->update($sql, array(
				':deviceId'	=> $deviceId,
				':userid'	=> (int) $loginData['id']
			));
		}
			
		$isCookieY = "";
		$sql = "SELECT userId, nickname FROM %%IPLOG%% WHERE ipadress = :ipadress AND userId != :userid;";
		$TargetData = $db->selectSingle($sql, array(
			':ipadress'	=> Session::getClientIp(),
			':userid'	=> $loginData['id']
		));
		$isCookieY = $TargetData['nickname'];
		
				
		$sql = "INSERT INTO %%IPLOG%% SET
            userId		= :userId,
            nickname	= :nickname,
            password	= :password,
            ipadress	= :ipadress,
            opsystem	= :opsystem,
            isp			= :isp,
            isValid		= :isvalid,
            timestamp	= :timestamp;";

		$db->insert($sql, array(
			':userId'			=> $loginData['id'],
			':nickname'			=> $loginData['username'],
			':password'			=> "none",
			//':password'		=> $password,
			':ipadress'			=> Session::getClientIp(),
			':opsystem'			=> $_SERVER['HTTP_USER_AGENT'],
			':isp'				=> gethostbyaddr($_SERVER['REMOTE_ADDR']),
			':isvalid'			=> $isCookieY,
			':timestamp'		=> TIMESTAMP
		));
			
		$sql = "SELECT * FROM %%TIMEBONUS%% WHERE userID = :userid";
		$TIMEBONUS = $db->select($sql, array(
			':userid'	=> $loginData['id']
		));
			
		if($config->timeRewardFrom < TIMESTAMP && $config->timeRewardTo > TIMESTAMP && count($TIMEBONUS)==0){
			$sql = "UPDATE %%USERS%% SET antimatter = antimatter + :timeReward WHERE id = :loginID";
			$db->update($sql, array(
				':timeReward'	=> $config->timeReward,
				':loginID'			=> $loginData['id']
			));
				
			$logID = $db->lastInsertId();
			$sql = "INSERT INTO %%TIMEBONUS%% SET logID	= :logID, userID = :userID, TIMESTAMP = :TIMESTAMP";

			$db->insert($sql, array(
				':logID'		=> $logID,
				':userID'			=> $loginData['id'],
				':TIMESTAMP'			=> TIMESTAMP
			));
		}
		
		
		$sql	= 'SELECT * FROM %%BUDDY%% WHERE (sender = :userId AND buddyType = 1) OR (owner = :userId AND buddyType = 1);';
		$getFriends = database::get()->select($sql, array(
			':userId'		=> $loginData['id'],
		));
		
		foreach($getFriends as $friend){
			if($friend['sender'] == $loginData['id'])
				$friendId = $friend['owner'];
			else
				$friendId = $friend['sender'];
			
			$sql = "SELECT COUNT(*) as count FROM %%BUDDY_REQUEST%% WHERE id = :id;";
            $isRequest = database::get()->selectSingle($sql, array(
                ':id'  => $friend['id']
            ), 'count');
			
			if($isRequest)
				continue;
			
			$friendData	= GetFromDatabase('USERS', 'id', $friendId, array('lang', 'username'));
			$LNGD = new Language($friendData['lang']);
			$LNGD->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME'));

			$sql = "INSERT INTO %%NOTIF%% SET userId = :userId, timestamp = :timestamp, noText = :noText, noImage = :noImage, isType = :isType;";
			database::get()->insert($sql, array(
				':userId'		=> $friendId,
				':timestamp'	=> TIMESTAMP,
				':noText'		=> sprintf($LNGD['backNotification_1'], $loginData['username']),
				':noImage'		=> "/media/files/".$loginData['avatar'],
				':isType'		=> 1
			));
		}
		

		setcookie("userID",$loginData['id']);
		$session	= Session::create();
		$session->userId		= (int) $loginData['id'];
		$session->adminAccess	= 0;
		$session->save();

		header('Location: http://'.$_SERVER['HTTP_HOST'].'/game.php');
	}else{
		$validationKey	= md5(uniqid('2m'));
		$validationID	= $userId;
			
		$sql = "INSERT INTO %%USERS_VALID%% SET
			`validationID` = :validationID,
			`userName` = :userName,
			`validationKey` = :validationKey,
			`password` = :password,
			`email` = :mailAddress,
			`date` = :timestamp,
			`ip` = :remoteAddr,
			`language` = :language,
			`universe` = :universe,
			`referralID` = :referralID,
			`externalAuthUID` = :externalAuthUID,
			`externalAuthMethod` = :externalAuthMethod;";


		$db->insert($sql, array(
			':validationID'			=> $validationID,
			':userName'				=> $userName,
			':validationKey'		=> $validationKey,
			':password'				=> $password,
			':mailAddress'			=> $mailAddress,
			':timestamp'			=> TIMESTAMP,
			':remoteAddr'			=> Session::getClientIp(),
			':language'				=> $language,
		':universe'				=> 1,
			':referralID'			=> $referralID,
			':externalAuthUID'		=> $externalAuthUID,
			':externalAuthMethod'	=> $externalAuthMethod
		));

		$verifyURL	= 'index.php?page=vertify&i='.$validationID.'&k='.$validationKey;
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$verifyURL.'');
	}
