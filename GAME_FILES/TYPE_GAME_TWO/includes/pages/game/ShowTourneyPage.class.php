<?php

/**
 *  2Moons 
 *   by Jan-Otto Kröpke 2009-2016
 *
 * For the full copyright and license information, please view the LICENSE
 *
 * @package 2Moons
 * @author Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2009 Lucky
 * @copyright 2016 Jan-Otto Kröpke <slaver7@gmail.com>
 * @licence MIT
 * @version 1.8.0
 * @link https://github.com/jkroepke/2Moons
 */


class ShowTourneyPage extends AbstractGamePage 
{
	public static $requireModule = 0;
	
	function __construct() 
	{
		parent::__construct();
	}
	
	function expedition()
	{
		global $USER, $USETT, $LNG;
		//Tournement Expe Points
		$sql = "SELECT * FROM %%USERS%% ORDER BY expeEventPoints DESC LIMIT 25;";
		$userThree = database::get()->select($sql, array());
		$userArbre = array();
		
		foreach($userThree as $Player){
			$userArbre[$Player['id']] = array(
				'playerName'	=> getUsername($Player['id']),
				'expePoints'	=> pretty_number($Player['expeEventPoints']),
			);
		}
		//end expepoints tournement
		
		$this->assign(array(
			'userArbre'	=> $userArbre,
		));
		
		$this->display('page.tourney.expedition.tpl');
	}
	function show() 
	{
		global $USER, $USETT, $LNG;
		
		$touneyGroup = HTTP::_GP('group', 1);
		$touneyGroupOK = array(1,2,3,4,5);
		if(!in_array($touneyGroup, $touneyGroupOK))
			$touneyGroup = 1;
		
		$sql = "SELECT * FROM %%TOURNEYPARTICI%% WHERE tourneyJoin = :tourneyId AND playerId = :playerId;";
		$tourneyCheck = database::get()->selectSingle($sql, array(
			':tourneyId'	=> $touneyGroup,
			':playerId'		=> $USER['id']
		));
			
		if($_SERVER['REQUEST_METHOD'] === 'POST'){			
			if(!empty($tourneyCheck)){
				$this->printMessage("you are already registered in this tourney", true, array('game.php?page=tourney', 3));
			}else{
				$sql = "INSERT INTO %%TOURNEYPARTICI%% SET playerId = :playerId, joinTime = :joinTime, tourneyJoin = :tourneyJoin;";
				database::get()->insert($sql, array(
					':tourneyJoin'	=> $touneyGroup,
					':playerId'		=> $USER['id'],
					':joinTime'		=> TIMESTAMP
				));
				$this->printMessage("you successfully registered in the tourney", true, array('game.php?page=tourney', 3));
			}
		}
		
		$sql = "SELECT * FROM %%TOURNEYPARTICI%% WHERE tourneyJoin = :tourneyId ORDER BY tourneyUnits DESC LIMIT 25;";
		$tourneyPlayers = database::get()->select($sql, array(
			':tourneyId'	=> $touneyGroup,
		));
		$playerList = array();
		
		foreach($tourneyPlayers as $Player){
			$playerList[$Player['playerId']] = array(
				'tourneyUnits'	=> $Player['tourneyUnits'],
				'playerName'	=> getUsername($Player['playerId']),
			);
		}
		
		$sql = "SELECT * FROM %%TOURNEY%% WHERE tourneyId = :tourneyId;";
		$tourneyDetail = database::get()->selectSingle($sql, array(
			':tourneyId'	=> $touneyGroup
		));
		
		//case 1: MOST VOTES SINCE THE MOMENT HE REGISTERED THE TOURNEMENT
		//case 2: MOST DESTRUCTION SINCE THE MOMENT HE REGISTERED THE TOURNEMENT
		//case 3: MOST MOON DESTROYED ON ACTIVE SINCE THE MOMENT HE REGISTERED THE TOURNEMENT
		//case 4: MOST ACADEMENY POINTS USED SINCE HE REGISTERED THE TOURNEMENT
		//case 5: MOST EXPEDITIONS DONE SINCE THE MOMENT HE REGISTERED THE TOURNEMENT
		//case 6: MOST HOSTILE EXPEDITIONS DONE SINCE THE MOMENT HE REGISTERED THE TOURNEMENT
		//case 7: FIND MOST DARKMATTER ON EXPEDITIONS
		//case 8: FIND MOST ARSENAL ON EXPEDITIONS/HOSTAL
		//case 9: FIND MOST ACADEMY ON HOSTAL
		//case 10: MOST FLEET LOST IN BLACK HOLE
		//case 11: MOST COMBAT EXPERIENCE RECEIVED
		
		$this->assign(array(
			'tourneyCheck'	=> empty($tourneyCheck) && config::get()->tourneyEnd > TIMESTAMP ? 0 : 1,
			'playerList'	=> $playerList,
			'touneyGroup'	=> $touneyGroup,
			'tourneyEnd'	=> config::get()->tourneyEnd - TIMESTAMP,
			'tourneyDetail'	=> $tourneyDetail,
			'tourneyDescrip'=> $LNG['tourney_'.$tourneyDetail['tourneyEvent']],
		));
		
		$this->display('page.tourney.default.tpl');
	} 
}
