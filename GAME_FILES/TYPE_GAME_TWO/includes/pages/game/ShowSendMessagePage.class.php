<?php
class ShowSendMessagePage extends AbstractGamePage
{	
	public static $requireModule = 0;
	
	function __construct() 
	{
		parent::__construct();
	}
	
	function show()
	{
            
        global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist, $UNI;
            
		if($USER['authlevel'] < 3 ){
		$this->printMessage("your dont have enough permissions!", true, array('game.php?page=Overview', 2));
		die();
		}
			
			
		$db	= Database::get();
		$sql	= "SELECT email, username FROM %%USERS%%";
		$USERS = $db->select($sql, array(
			
		));
		
		foreach($USERS as $searchRow){
		$emailas = $searchRow['email'];
		$langlas = $searchRow['username'];
		
		$sql	= "SELECT * FROM emails WHERE email = :email";
		$cautare3 = $db->select($sql, array(
		':email'	=> $emailas	
		));
		
		if(count($cautare3)==0){
			$sql = "INSERT INTO emails SET
                email	= :email,
                username		= :lang;";

			$db->insert($sql, array(
				':email'	=> $emailas,
				':lang'			=> $langlas
			));
		}else{
			$sql = "UPDATE emails SET
                username		= :lang WHERE email = :email;";

			$db->update($sql, array(
				':email'	=> $emailas,
				':lang'			=> $langlas
			));
		}

		}
		
		
	
	
	
			
            if($_POST){
			$mode   = HTTP::_GP('textArea', '');
			$mode1   = HTTP::_GP('subject', '');
			$mode2   = HTTP::_GP('type', '');
		
                        switch($mode2){
			
			
		
		case '1':
		$pmMessage 	= $mode;
		
		$db	= Database::get();
		$sql	= "SELECT DISTINCT id, username FROM %%USERS%%";
		$USERS = $db->select($sql, array(
			
		));
		
		foreach($USERS as $searchRow){
		$sendMessage = str_replace('{USERNAME}', $searchRow['username'], $pmMessage);
		$sendMessage = '<span class="admin">'.$sendMessage.'</span>';
		PlayerUtil::sendMessage($searchRow['id'], $USER['id'], 'Game Info', 50, $mode1, $sendMessage, TIMESTAMP);

		}
		$this->printMessage("Message Send!", true, array('game.php?page=SendMessage', 2));
		break;
        case '2':
		require 'includes/classes/Mail.class.php';
		$pmMessage 	= $mode;
		
		$pmMessage = '<div style="margin:20px auto;width:60%;text-align:left;padding:0px;">
	<img style="margin:0px auto 10px auto;width:400px;height:40px;" src="https://wiki.warofgalaxyz.com/styles/images/xterium_logo.png" alt="logo_email.png">
	<div style="text-align:left;padding-bottom:10px;">Hello,</div>
	<div style="text-align:left;padding:10px;"><i>'.$pmMessage.'</i>
	</div>
	<div style="text-align:left;padding-top:10px;">If you want to delete all your personal data, please contact us at the following address : support@warofgalaxyz.com.<br><br>
	Website: www.warofgalaxyz.com<br>
	Facebook: https://www.facebook.com/warofgalaxyz/ <br><br>
	<i>This message was sent automatically from WOG Game.</i></div>
	</div>';
	
	
		$db	= Database::get();
		$sql	= "SELECT email FROM emails";
		$USERS = $db->select($sql, array(
			
		));
		
		foreach($USERS as $searchRow){
		
		
		// Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
		$to = $searchRow['email'];
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: support@warofgalaxyz.com' . "\r\n";
		$headers .= 'Reply-To: support@warofgalaxyz.com' . "\r\n";
		mail($to, $mode1, $pmMessage, $headers);
		} 
		
		$this->printMessage("Mail Send!", true, array('game.php?page=SendMessage', 2));
		 break;
		}
		}
		
		
 
		$this->tplObj->assign_vars(array(
			
			
		));
		$this->display('page.sendmes.default.tpl');
	}
}
		

?>