<?php

define('MODE', 'JSON');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

$encoded_secret  = HTTP::_GP('encoded_secret', '', UTF8_SUPPORT);
$encoded_secret  = encrypt_decrypt('decrypt', $encoded_secret);
//$RID-USERID-USERNAME
$encoded_secret	 	= explode('-', $encoded_secret);
$RID				= 	$encoded_secret[0];
$userId				= 	$encoded_secret[1];
$name				= 	$encoded_secret[2];
$comments       	= HTTP::_GP('comment', '', UTF8_SUPPORT);
$AllyTag 			= "";
$avatarLink = "media/files/avatar_default.jpg";

$sql	= "SELECT isChat FROM %%USERS%% WHERE id = :userId;";
$commentUserData = Database::get()->selectSingle($sql, array(
	':userId'	=> $userId
));

if(empty($commentUserData) || $commentUserData['isChat'] == 1)
	exit();
		
if (!empty($comments) && !empty($RID) && !empty($userId)) {
	  // preventing sql injection
	$name    = stripslashes($name);
	$comments = stripslashes($comments);
	$rid     = stripslashes($RID);
	  
    $tmpBanned		= 0;
	$mystring = str_replace(" ", "", $comments);
	$mystring = preg_replace('/[^A-Za-z0-9\-]/', '', $mystring); // Removes special chars.
	$mystring = strtolower($mystring);
	  
	$sql	= 'SELECT * FROM %%BLACKLIST%%;';
	$blackList = Database::get()->select($sql, array());
		
	$isFound 	= 0;
	$blackWord 	= "";
	foreach($blackList as $word){
		if(strpos($mystring, $word['blackText']) !== false){
			$isFound 	+= 1;
			$blackWord 	= $word['blackText'];
		}
	}
			
	if($isFound != 0){
		$sql	= "UPDATE %%USERS%% SET isChat = :isChat WHERE id = :userId;";
		Database::get()->update($sql, array(
			':isChat'	=> 1,
			':userId'	=> $userId
		));
		$tmpBanned = 1;
		exit();
	}

	  // insert new comment into comment table  
	$sql = "INSERT INTO %%COMMENTSHOF%% SET Userid = :id, name = :username, rid = :rid, comment = :comment, replyToComment = :replyToComment, date = :last_time;";

	database::get()->insert($sql, array(
		':id'	        => $userId,
		':username'		=> $name,
		':rid'	      	=> $rid,
		':replyToComment'=> 0,
		':comment'	 	=> $comments,
		':last_time' 	=> TIMESTAMP
	));
	  
		$sql = "SELECT * FROM %%USERS%% WHERE id = :id;";
		$USERINFO	= database::get()->selectSingle($sql, array(
			':id'	=> $userId
		));
		
		$sql = "SELECT ally_id, avatar FROM %%USERS%% WHERE id = :id;";
		$POSERINFO	= database::get()->selectSingle($sql, array(
				':id'	=> $userId
		));
		
		$LNG = new Language($USERINFO['lang']);
		$LNG->includeData(array('L18N', 'INGAME', 'TECH', 'CUSTOM'));
		
		$DisplayTime = TIMESTAMP;
		
		if($POSERINFO['ally_id'] != 0){
			$sql = "SELECT ally_tag FROM %%ALLIANCE%% WHERE id = :id;";
			$POSERINFO	= database::get()->selectSingle($sql, array(
				':id'	=> $POSERINFO['ally_id']
			));
			$AllyTag = "<span class='alleanza'>".$POSERINFO['ally_tag']."</span>";
		}
		
		$avatarLink = "media/files/".$USERINFO['avatar'];
	}
?>

<!-- sending response with new comment and html markup-->


<div class="comments-container" style="margin: 35px auto 15px;">
 <ul id="comments-list" class="comments-list">

			
			
			 <li>
                <div class="comment-main-level">
                    <!-- Avatar -->
                    <div class="comment-avatar"><img src="<?php echo $avatarLink ?>" alt=""></div>
                    <!-- Contenedor del Comentario -->
                    <div class="comment-box">
                        <div class="comment-head">
                            <h6 class="comment-name"><a href="#"><?php echo $name ?></a><?php echo $AllyTag ?></h6> 
                            <span ><?php echo timeElapsedString($DisplayTime) ?></span>
                            <a href="#" class="immagine"><img src="styles/images/iconav/report-like.png"></a>
							<!--<a href="#" class="immagine"><img src="styles/images/iconav/report-reply.png"></a>-->
                        </div>
                        <div class="comment-content">
                             <?php echo $comments?>
                        </div>
                    </div>
                </div>
            </li>
			        </ul>
    </div>