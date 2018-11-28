<?php

class ShowReward2Page extends AbstractGamePage{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
	}
	
	/* function historique(){
	global $USER, $PLANET, $LNG, $UNI, $CONF,$resource,$pricelist;
	
	
	$messageList = '';
	$messageRaw	= $GLOBALS['DATABASE']->query("SELECT * 
		FROM uni1_reward_log WHERE rewardUserId = ".$USER['id']." AND rewardTime > ".(TIMESTAMP - 15 * 24 * 60 * 60)." 
		ORDER BY rewardTime DESC
		;");
	
	while($messageRow = $GLOBALS['DATABASE']->fetch_array($messageRaw))
	{
	
	
		$messageList[$messageRow['rewardIdLog']]	= array(
			'date'		=> str_replace(' ', '&nbsp;', _date($LNG['php_tdformat'], $messageRow['rewardTime']), $USER['timezone']),
			'rewardPrice'		=> $messageRow['message'],
			'rewardIdLog'		=> $messageRow['rewardIdLog'],
			'rewardCode'		=> $this->redeemCode($messageRow['rewardIdLog']),
		);
	}
	
	
	$this->tplObj->assign_vars(
	array(
    'messageList' => $messageList,                        
    ));
	$this->display("page.reward2.historique.tpl");
	} */
	function show(){
            
		global $USER,$PLANET, $UNI, $LNG;
                

		$id_player = HTTP::_GP('id',0);
    		
		if($_POST){

			//verificarile de rigoare
			$TheCode = HTTP::_GP('voucher','');
			//1. see if code exists
			$db	= Database::get();
			$sql	= 'SELECT * FROM %%FREEALLOPASS%% WHERE alloCode = :alloCode;';
			$CodeExist = $db->selectSingle($sql, array(
			':alloCode'	=> $TheCode
			));
	
			if($db->rowCount($CodeExist) != 0){

					if($CodeExist['usedBy'] != 0 && $CodeExist['usedTime'] != 0){
					$this->printMessage("Already Used this code", true, array('game.php?page=Reward2', 2));
					die();
					}elseif($CodeExist['usedBy'] != 0 && $CodeExist['usedTime'] == 0 && $USER['id'] != $CodeExist['usedBy']){
					$this->printMessage("This code is not yours", true, array('game.php?page=Reward2', 2));
					die();
					}else{
					$USER['antimatter'] += 25000;
					
					$MessageOk = $LNG['bonus_receive'];
					$MessageOk .= '<span style="color:#33FF00";> 25.000</span> '.$LNG['tech'][922].' ';
					
					$sql	= "UPDATE %%FREEALLOPASS%% SET usedBy = :usedBy, usedTime = :usedTime WHERE alloCode = :alloCode;";
					Database::get()->update($sql, array(
					':usedBy'	=> $USER['id'],
					':usedTime'	=> TIMESTAMP,
					':alloCode'	=> $TheCode
					));
					
					$this->printMessage($MessageOk, true, array('?page=Reward2', 3));
					die();
					}
					
			}else{
					$this->printMessage("The code is invalid", true, array('game.php?page=Reward2', 2));
					die();
			}
		}
		$this->display('page.reward2.default.tpl');
	}
}