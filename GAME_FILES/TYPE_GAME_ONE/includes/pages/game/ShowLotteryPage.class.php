<?php
class ShowLotteryPage extends AbstractGamePage
{	
	public static $requireModule = 0;
	
	function __construct() {
		parent::__construct();
	}
	
	function show()
	{
		global  $USER, $PLANET, $LNG, $LANG,$CONF,$UNI;
		
		if($USER['id'] != 1){
		$this->printMessage('This mod is removed from the game', true, array('game.php?page=overview', 2));
		}
		
		$max_users_tickets = 1;
		$ticket_price_metal = 25000000000;
		$ticket_price_crystal = 15000000000;
		$ticket_price_deuterium = 5000000000;
		$this->tplObj->loadscript('jquery.countdown.js');
	
	
		$ticket_prize_dm = Config::get()->lottery_prize;
	
	
	if($_POST){
		$tickets = HTTP::_GP('tickets', 0);
		if($tickets <=0 || $tickets > 1){
		PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your lottery dm page', TIMESTAMP);
		$this->printMessage($LNG['moon_hack'], true, array('game.php?page=lottery', 3));
		}
		
		$sql	= 'SELECT * FROM %%LOTTERIA%% WHERE id = :userId;';
		$cautare = Database::get()->select($sql, array(
			':userId'	=> $USER['id']
		));
	
		if(Database::get()->rowCount($cautare) > 0){

			$sql	= 'SELECT SUM(tickets) as total_tickets FROM %%LOTTERIA%% WHERE id = :userId;';
			$cautare2 = Database::get()->selectSingle($sql, array(
			':userId'	=> $USER['id']
			));
			
			if(($cautare2['total_tickets']+ $tickets) > $max_users_tickets){
				$this->printMessage($LNG['lottery_dm_11'], true, array('game.php?page=lottery', 3));
			}
		}
		$cost['metal'] = $tickets * $ticket_price_metal;
		$cost['crystal'] = $tickets * $ticket_price_crystal;
		$cost['deuterium'] = $tickets * $ticket_price_deuterium;
		if($PLANET['metal'] < $cost['metal'] || $PLANET['crystal'] < $cost['crystal'] || $PLANET['deuterium'] < $cost['deuterium']){
			$this->printMessage($LNG['lottery_dm_12'], true, array('game.php?page=lottery', 2));
			die();
		}else{
			
			$PLANET['metal'] -= $cost['metal'];
			$PLANET['crystal'] -= $cost['crystal'];
			$PLANET['deuterium'] -= $cost['deuterium'];
			$sql	= 'UPDATE %%PLANETS%% SET metal = metal - :costmetal, crystal = crystal - :costcrystal, deuterium = deuterium - :costdeuterium WHERE id = :planetId;';
			Database::get()->update($sql, array(
			':costmetal'	=> $cost['metal'],
			':costcrystal'	=> $cost['crystal'],
			':costdeuterium'	=> $cost['deuterium'],
			':planetId'	=> $PLANET['id']
			));
			
			$sql = "INSERT INTO %%LOTTERIA%% SET
                ID	= :userID,
                user		= :userName,
                tickets		= :Tickets,
                uni		= :universe;";

			Database::get()->insert($sql, array(
				':userID'			=> $USER['id'],
				':userName'			=> $USER['username'],
				':Tickets'			=> $tickets,
				':universe' => Universe::current()
			));
			$this->printMessage($LNG['lottery_dm_13'], true, array('game.php?page=lottery', 2));
			die();
		}
	}
	


			$sql	= 'SELECT DISTINCT id FROM %%LOTTERIA%% WHERE uni = :universe;';
			$total_users = Database::get()->select($sql, array(
			':universe' => Universe::current()
			));
		
			$total_users = Database::get()->rowCount($total_users);
			if(Config::get()->lottery_time < TIMESTAMP){
			if($total_users < Config::get()->lottery_min){
			$sql	= 'UPDATE %%CONFIG%% SET lottery_prize = lottery_prize + :lottery_prize, lottery_time = :lottery_time WHERE uni = :universe;';
			Database::get()->update($sql, array(
			':lottery_prize'	=> 50000,
			':lottery_time'	=> TIMESTAMP+24*60*60,
			':universe' => Universe::current()
			));
			
			$this->printMessage($LNG['lottery_dm_14'], true, array('game.php?page=lottery', 2));
			} 
			
			$sql	= 'SELECT * FROM %%LOTTERIA%%;';
			$get_tickets = Database::get()->select($sql, array(
			));
			if(Database::get()->rowCount($get_tickets) >0){


			$user_array = array();
			$sql	= 'SELECT DISTINCT id FROM %%LOTTERIA%% WHERE uni = :universe;';
			$diferent_users = Database::get()->select($sql, array(
			':universe' => Universe::current()
			));
			foreach($diferent_users as $s){
				$user_array[] = $s['id'];
			}
			$random = rand(0,Database::get()->rowCount($user_array)-1);
			do{
			$random1 = rand(0,Database::get()->rowCount($user_array)-1);
			}while($random1==$random);
			do{
			$random2 = rand(0,Database::get()->rowCount($user_array)-1);
			}while($random2==$random1 || $random2==$random);

			$sql	= 'SELECT SUM(tickets) as sum_tickets, user FROM %%LOTTERIA%% WHERE id = :userId;';
			$total_user = Database::get()->selectSingle($sql, array(
			':userId'	=> $user_array[$random]
			));
			$sql	= 'SELECT SUM(tickets) as sum_tickets, user FROM %%LOTTERIA%% WHERE id = :userId;';
			$total_user1 = Database::get()->selectSingle($sql, array(
			':userId'	=> $user_array[$random1]
			));
			$sql	= 'SELECT SUM(tickets) as sum_tickets, user FROM %%LOTTERIA%% WHERE id = :userId;';
			$total_user2 = Database::get()->selectSingle($sql, array(
			':userId'	=> $user_array[$random2]
			));
			
			$total_user_prize = $ticket_prize_dm * $total_user['sum_tickets'];
			$total_user_prize1 = $ticket_prize_dm/2 * $total_user1['sum_tickets'];
			$total_user_prize2 = $ticket_prize_dm/4 * $total_user2['sum_tickets'];
			
			if($USER['id'] == $user_array[$random]){
				$USER['darkmatter'] += $total_user_prize;
			}else{
				$sql	= 'UPDATE %%USERS%% SET darkmatter = darkmatter + :darkmatter WHERE id = :userID;';
				Database::get()->update($sql, array(
				':darkmatter'	=> $total_user_prize,
				':userID'	=> $user_array[$random]
				));
			}
			if($USER['id'] == $user_array[$random1]){
				$USER['darkmatter'] += $total_user_prize1;
			}else{
				$sql	= 'UPDATE %%USERS%% SET darkmatter = darkmatter + :darkmatter WHERE id = :userID;';
				Database::get()->update($sql, array(
				':darkmatter'	=> $total_user_prize1,
				':userID'	=> $user_array[$random1]
				));
			}
			if($USER['id'] == $user_array[$random2]){
				$USER['darkmatter'] += $total_user_prize2;
			}else{
				$sql	= 'UPDATE %%USERS%% SET darkmatter = darkmatter + :darkmatter WHERE id = :userID;';
				Database::get()->update($sql, array(
				':darkmatter'	=> $total_user_prize2,
				':userID'	=> $user_array[$random2]
				));
			}
			
			$sql	= 'DELETE FROM %%LOTTERIALOG%%;';
			Database::get()->delete($sql, array(
			));
			
			$sql = "INSERT INTO %%LOTTERIALOG%% SET
                username	= :username,
                time		= :time,
                prize		= :Tickets,
                uni		= :universe;";

			Database::get()->insert($sql, array(
				':username'			=> $total_user['user'],
				':time'			=> TIMESTAMP,
				':Tickets'			=> $total_user_prize,
				':universe' => Universe::current()
			));
			
			$sql = "INSERT INTO %%LOTTERIALOG%% SET
                username	= :username,
                time		= :time,
                prize		= :Tickets,
                uni		= :universe;";

			Database::get()->insert($sql, array(
				':username'			=> $total_user1['user'],
				':time'			=> TIMESTAMP,
				':Tickets'			=> $total_user_prize1,
				':universe' => Universe::current()
			));
			
			$sql = "INSERT INTO %%LOTTERIALOG%% SET
                username	= :username,
                time		= :time,
                prize		= :Tickets,
                uni		= :universe;";

			Database::get()->insert($sql, array(
				':username'			=> $total_user2['user'],
				':time'			=> TIMESTAMP,
				':Tickets'			=> $total_user_prize2,
				':universe' => Universe::current()
			));
			
			$sql	= 'DELETE FROM %%LOTTERIA%%;';
			Database::get()->delete($sql, array(
			));
			
			PlayerUtil::sendMessage($user_array[$random], $user_array[$random], 'Lotery', 4, 'You just won', 'You just won '.$total_user_prize.' DM in the lotery', TIMESTAMP);
			PlayerUtil::sendMessage($user_array[$random1], $user_array[$random1], 'Lotery', 4, 'You just won', 'You just won '.$total_user_prize1.' DM in the lotery', TIMESTAMP);
			PlayerUtil::sendMessage($user_array[$random1], $user_array[$random2], 'Lotery', 4, 'You just won', 'You just won '.$total_user_prize2.' DM in the lotery', TIMESTAMP);
		
			$time = TIMESTAMP+24*60*60;
			
			$sql	= 'UPDATE %%CONFIG%% SET lottery_prize = :lottery_prize, lottery_time = :lottery_time WHERE uni = :universe;';
			Database::get()->update($sql, array(
			':lottery_prize'	=> 500000,
			':lottery_time'	=> $time,
			':universe' => Universe::current()
			));

			$this->printMessage($LNG['lottery_dm_15'], true, array('game.php?page=lottery', 2));
		}else{

			$time = TIMESTAMP+24*60*60;
			$sql	= 'UPDATE %%CONFIG%% SET lottery_time = :lottery_time WHERE uni = :universe;';
			Database::get()->update($sql, array(
			':lottery_time'	=> $time,
			':universe' => Universe::current()
			));	
			$this->printMessage($LNG['lottery_dm_16'], true, array('game.php?page=lottery', 2));
		}
	}else{
		$secs = Config::get()->lottery_time - TIMESTAMP;

		

		$sql	= 'SELECT id FROM %%LOTTERIA%% WHERE uni = :universe;';
		$diferent_users = Database::get()->select($sql, array(
		':universe' => Universe::current()
		));
		if(Database::get()->rowCount($diferent_users) > 0){
			$lista = '<table style="width:100%"><tr><td>Username</td><td>Tickets Bought</td></tr>';
			foreach($diferent_users as $s){
			$sql	= 'SELECT user,SUM(tickets) as sum_tickets FROM %%LOTTERIA%% WHERE id = :userId;';
			$total_user = Database::get()->selectSingle($sql, array(
			':userId'	=> $s['id']
			));
			$lista .= '<tr><td>'.$total_user['user'].'</td><td>'.$total_user['sum_tickets'].'</td></tr>';
		}
		$lista .= '</table>';}
		else{
			$lista = "<p><font color='red'>There are no tickets bought</font></p>";
		}
		$sql	= 'SELECT * FROM %%LOTTERIALOG%% ORDER BY time DESC LIMIT 5;';
		$castigatori = Database::get()->select($sql, array(
		));
		if(Database::get()->rowCount($castigatori) >0){

			$lista_winners = "<table style='width:100%'><tr><td>Winner</td><td>Time</td><td>DM WON</td></tr>";
			foreach($castigatori as $x){
				$lista_winners .= "<tr><td>".$x['username']."</td><td>". gmdate("M d Y H:i:s",$x['time'] )."</td><td>".$x['prize']."</td></tr>";
			}
			$lista_winners .= "</table>";
		}else{

			$lista_winners = "<p>For now there are no winners in the lottery system </p>";
		}

		$this->tplObj->assign_vars(array(
			'metal_p' => pretty_number(floattostring($ticket_price_metal)),
			'crystal_p' => pretty_number(floattostring($ticket_price_crystal)),
			'deuterium_p' => pretty_number(floattostring($ticket_price_deuterium)),
			'dm_win'	=> $ticket_prize_dm,
			'secs'		=>$secs,
			'user_lists' => $lista,
			'max_tickets_per_player' => $max_users_tickets,
			'winners'	=> $lista_winners,
			'minimum_users'	=> $CONF['lottery_min'],
			'lottery_dm_3'	=> sprintf($LNG['lottery_dm_3'], pretty_number(Config::get()->lottery_prize)),
			'lottery_dm_4'	=> sprintf($LNG['lottery_dm_4'], Config::get()->lottery_min, Config::get()->lottery_min, pretty_number(250000)),
			'lottery_dm_7'	=> sprintf($LNG['lottery_dm_7'], 1),
			));
			$this->display('page.lottery.default.tpl');
	}
	}
}
?>