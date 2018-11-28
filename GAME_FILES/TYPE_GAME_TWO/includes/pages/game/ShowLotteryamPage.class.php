<?php
class ShowLotteryamPage extends AbstractGamePage
{	
	public static $requireModule = 0;
	
	function __construct() {
		parent::__construct();
	}
	
	function show()
	{
		global  $USER, $PLANET, $LNG, $LANG,$CONF,$UNI;

		
		//if($USER['id'] != 1)
			//$this->printMessage('under maintenance', true, array('game.php?page=overview', 3));
		
		$max_users_tickets = 1;
		$ticket_price_dm = 1000000;
		$ticket_prize_dm = Config::get()->lottery_prize_am;
		$this->tplObj->loadscript('jquery.countdown.js');
		
		if($_POST){
			$tickets = 1;
			if($tickets <=0 || $tickets > 1){
				PlayerUtil::sendMessage(1, '', 'Hack System', 4, 'Hack System', 'Hello admin, the player '.$USER['username'].' tryed to hack your lottery dm page', TIMESTAMP);
				$this->printMessage($LNG['moon_hack'], true, array('game.php?page=lotteryam', 3));
			}
			
			$sql	= 'SELECT * FROM %%LOTTERIAAM%% WHERE id = :userId;';
			$cautare = Database::get()->select($sql, array(
				':userId'	=> $USER['id']
			));
		
			if(Database::get()->rowCount($cautare) > 0){
				$sql	= 'SELECT SUM(tickets) as total_tickets FROM %%LOTTERIAAM%% WHERE id = :userId;';
				$cautare2 = Database::get()->selectSingle($sql, array(
					':userId'	=> $USER['id']
				));
				
				if(($cautare2['total_tickets']+ $tickets) > $max_users_tickets){
					$this->printMessage($LNG['lottery_dm_11'], true, array('game.php?page=lotteryam', 3));
				}
			}
			
			$cost['darkmatter'] = $tickets * $ticket_price_dm;
			
			if($USER['darkmatter'] < $cost['darkmatter']){
				$this->printMessage($LNG['lottery_dm_12'], true, array('game.php?page=lotteryam', 2));
				die();
			}else{
				$account_before = array(
					'tickets'				=> 0,
					'darkmatter'			=> $USER['darkmatter'],
					'price'					=> $cost['darkmatter'],
				);
				$USER['darkmatter'] -= $cost['darkmatter'];
				$sql =  "UPDATE %%USERS%% SET darkmatter = darkmatter - :darkmatter WHERE id = :userID;";
				Database::get()->update($sql, array(
					':darkmatter'			=> $cost['darkmatter'],
					':userID'			=> $USER['id']
				));
				
				$sql = "INSERT INTO %%LOTTERIAAM%% SET
					ID	= :userID,
					user		= :userName,
					tickets		= :Tickets,
					uni		= :universe;";

				Database::get()->insert($sql, array(
					':userID'			=> $USER['id'],
					':userName'			=> empty($USER['customNick']) ? $USER['username'] : $USER['customNick'],
					':Tickets'			=> $tickets,
					':universe' => Universe::current()
				));
				
				$sql	= 'SELECT darkmatter FROM %%USERS%% WHERE id = :userId;';
				$getUser = Database::get()->selectSingle($sql, array(
					':userId'		=> $USER['id'],
				));
				
				$account_after = array(
					'tickets'				=> 1,
					'darkmatter'			=> $getUser['darkmatter'],
					'price'					=> $cost['darkmatter'],
				);
				
				$LOG = new Logcheck(4);
				$LOG->username = empty($USER['customNick']) ? $USER['username'] : $USER['customNick'];
				$LOG->pageLog = "page=lotteryam [Buy Ticket]";
				$LOG->old = $account_before;
				$LOG->new = $account_after;
				$LOG->save();
			
				$this->printMessage($LNG['lottery_dm_13'], true, array('game.php?page=lotteryam', 2));
				die();
			}
		}
	
		$sql	= 'SELECT DISTINCT id FROM %%LOTTERIAAM%% WHERE uni = :universe;';
		$total_users = Database::get()->select($sql, array(
			':universe' => Universe::current()
		));
		
		$total_users = Database::get()->rowCount($total_users);
		if(Config::get()->lottery_time_am < TIMESTAMP){
			if($total_users < Config::get()->lottery_min_am){
				$sql	= 'UPDATE %%CONFIG%% SET lottery_time_am = :lottery_time_am WHERE uni = :universe;';
				Database::get()->update($sql, array(
					':lottery_time_am'	=>  TIMESTAMP+24*60*60,
					':universe' => Universe::current()
				)); 
				$this->printMessage($LNG['lottery_dm_14'], true, array('game.php?page=lotteryam', 2));
			} 
			
			$sql	= 'SELECT * FROM %%LOTTERIAAM%%;';
			$get_tickets = Database::get()->select($sql, array());
			if(Database::get()->rowCount($get_tickets) >0){
				$user_array = array();
				$sql	= 'SELECT DISTINCT id FROM %%LOTTERIAAM%% WHERE uni = :universe;';
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
				do{
				$random3 = rand(0,Database::get()->rowCount($user_array)-1);
				}while($random3==$random2 || $random3==$random1 || $random3==$random);
				do{
				$random4 = rand(0,Database::get()->rowCount($user_array)-1);
				}while($random4==$random3 || $random4==$random2 || $random4==$random1 || $random4==$random);

				$sql	= 'SELECT SUM(tickets) as sum_tickets, user FROM %%LOTTERIAAM%% WHERE id = :userId;';
				$total_user = Database::get()->selectSingle($sql, array(
				':userId'	=> $user_array[$random]
				));
				$sql	= 'SELECT SUM(tickets) as sum_tickets, user FROM %%LOTTERIAAM%% WHERE id = :userId;';
				$total_user1 = Database::get()->selectSingle($sql, array(
				':userId'	=> $user_array[$random1]
				));
				$sql	= 'SELECT SUM(tickets) as sum_tickets, user FROM %%LOTTERIAAM%% WHERE id = :userId;';
				$total_user2 = Database::get()->selectSingle($sql, array(
				':userId'	=> $user_array[$random2]
				));
				$sql	= 'SELECT SUM(tickets) as sum_tickets, user FROM %%LOTTERIAAM%% WHERE id = :userId;';
				$total_user3 = Database::get()->selectSingle($sql, array(
				':userId'	=> $user_array[$random3]
				));
				$sql	= 'SELECT SUM(tickets) as sum_tickets, user FROM %%LOTTERIAAM%% WHERE id = :userId;';
				$total_user4 = Database::get()->selectSingle($sql, array(
				':userId'	=> $user_array[$random4]
				));
				
				$total_user_prize  = 15000;
				$total_user_prize1 = 10000;
				$total_user_prize2 = 8000;
				$total_user_prize3 = 5000;
				$total_user_prize4 = 2500;
				
				if($USER['id'] == $user_array[$random]){
					$USER['antimatter'] += $total_user_prize;
				}else{
					$sql	= 'UPDATE %%USERS%% SET antimatter = antimatter + :antimatter WHERE id = :userID;';
					Database::get()->update($sql, array(
					':antimatter'	=> $total_user_prize,
					':userID'	=> $user_array[$random]
					));
				}
				if($USER['id'] == $user_array[$random1]){
					$USER['antimatter'] += $total_user_prize1;
				}else{
					$sql	= 'UPDATE %%USERS%% SET antimatter = antimatter + :antimatter WHERE id = :userID;';
					Database::get()->update($sql, array(
					':antimatter'	=> $total_user_prize1,
					':userID'	=> $user_array[$random1]
					));
				}
				if($USER['id'] == $user_array[$random2]){
					$USER['antimatter'] += $total_user_prize2;
				}else{
					$sql	= 'UPDATE %%USERS%% SET antimatter = antimatter + :antimatter WHERE id = :userID;';
					Database::get()->update($sql, array(
					':antimatter'	=> $total_user_prize2,
					':userID'	=> $user_array[$random2]
					));
				}
				if($USER['id'] == $user_array[$random3]){
					$USER['antimatter'] += $total_user_prize3;
				}else{
					$sql	= 'UPDATE %%USERS%% SET antimatter = antimatter + :antimatter WHERE id = :userID;';
					Database::get()->update($sql, array(
					':antimatter'	=> $total_user_prize3,
					':userID'	=> $user_array[$random3]
					));
				}
				if($USER['id'] == $user_array[$random4]){
					$USER['antimatter'] += $total_user_prize4;
				}else{
					$sql	= 'UPDATE %%USERS%% SET antimatter = antimatter + :antimatter WHERE id = :userID;';
					Database::get()->update($sql, array(
					':antimatter'	=> $total_user_prize4,
					':userID'	=> $user_array[$random4]
					));
				}
				
				$sql	= 'DELETE FROM %%LOTTERIALOGAM%%;';
				Database::get()->delete($sql, array(
				));
				
				$sql = "INSERT INTO %%LOTTERIALOGAM%% SET
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
				
				$sql = "INSERT INTO %%LOTTERIALOGAM%% SET
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
				
				$sql = "INSERT INTO %%LOTTERIALOGAM%% SET
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
				
				$sql = "INSERT INTO %%LOTTERIALOGAM%% SET
					username	= :username,
					time		= :time,
					prize		= :Tickets,
					uni		= :universe;";

				Database::get()->insert($sql, array(
					':username'			=> $total_user3['user'],
					':time'			=> TIMESTAMP,
					':Tickets'			=> $total_user_prize3,
					':universe' => Universe::current()
				));
				
				$sql = "INSERT INTO %%LOTTERIALOGAM%% SET
					username	= :username,
					time		= :time,
					prize		= :Tickets,
					uni		= :universe;";

				Database::get()->insert($sql, array(
					':username'			=> $total_user4['user'],
					':time'			=> TIMESTAMP,
					':Tickets'			=> $total_user_prize4,
					':universe' => Universe::current()
				));
				
				$sql	= 'DELETE FROM %%LOTTERIAAM%%;';
				Database::get()->delete($sql, array(
				));
				
				PlayerUtil::sendMessage($user_array[$random], $user_array[$random], 'Lotery', 4, 'You just won', 'You just won '.$total_user_prize.' AM in the lotery', TIMESTAMP);
				PlayerUtil::sendMessage($user_array[$random1], $user_array[$random1], 'Lotery', 4, 'You just won', 'You just won '.$total_user_prize1.' AM in the lotery', TIMESTAMP);
				PlayerUtil::sendMessage($user_array[$random2], $user_array[$random2], 'Lotery', 4, 'You just won', 'You just won '.$total_user_prize2.' AM in the lotery', TIMESTAMP);
				PlayerUtil::sendMessage($user_array[$random3], $user_array[$random3], 'Lotery', 4, 'You just won', 'You just won '.$total_user_prize3.' AM in the lotery', TIMESTAMP);
				PlayerUtil::sendMessage($user_array[$random4], $user_array[$random4], 'Lotery', 4, 'You just won', 'You just won '.$total_user_prize4.' AM in the lotery', TIMESTAMP);
			
				$time = TIMESTAMP+24*60*60;
				
				$sql	= 'UPDATE %%CONFIG%% SET lottery_time_am = :lottery_time_am WHERE uni = :universe;';
				Database::get()->update($sql, array(
				':lottery_time_am'	=> $time,
				':universe' => Universe::current()
				));

				$this->printMessage($LNG['lottery_dm_15'], true, array('game.php?page=lotteryam', 2));
			}else{

				$time = TIMESTAMP+24*60*60;
				$sql	= 'UPDATE %%CONFIG%% SET lottery_time_am = :lottery_time_am WHERE uni = :universe;';
				Database::get()->update($sql, array(
				':lottery_time_am'	=> $time,
				':universe' => Universe::current()
				));	
				$this->printMessage($LNG['lottery_dm_16'], true, array('game.php?page=lotteryam', 2));
			}
		}else{
			$secs = Config::get()->lottery_time_am - TIMESTAMP;

			$sql	= 'SELECT id FROM %%LOTTERIAAM%% WHERE uni = :universe;';
			$diferent_users = Database::get()->select($sql, array(
			':universe' => Universe::current()
			));
			if(Database::get()->rowCount($diferent_users) > 0){
				$lista = '<table style="width:100%"><tr><td>Username</td><td>Tickets Bought</td></tr>';
				foreach($diferent_users as $s){
				$sql	= 'SELECT user,SUM(tickets) as sum_tickets FROM %%LOTTERIAAM%% WHERE id = :userId;';
				$total_user = Database::get()->selectSingle($sql, array(
				':userId'	=> $s['id']
				));
				$lista .= '<tr><td>'.$total_user['user'].'</td><td>'.$total_user['sum_tickets'].'</td></tr>';
			}
			$lista .= '</table>';}
			else{
				$lista = "<p><font color='red'>There are no tickets bought</font></p>";
			}
			$sql	= 'SELECT * FROM %%LOTTERIALOGAM%% ORDER BY time DESC LIMIT 5;';
			$castigatori = Database::get()->select($sql, array(
			));
			if(Database::get()->rowCount($castigatori) >0){

				$lista_winners = "<table style='width:100%'><tr><td>Winner</td><td>Time</td><td>AM WON</td></tr>";
				foreach($castigatori as $x){
					$lista_winners .= "<tr><td>".$x['username']."</td><td>". gmdate("M d Y H:i:s",$x['time'] )."</td><td>".$x['prize']."</td></tr>";
				}
				$lista_winners .= "</table>";
			}else{

				$lista_winners = "<p>For now there are no winners in the lottery system </p>";
			}
			$percenta_lott = floor(Config::get()->lottery_time_am / 100 * TIMESTAMP);
			$this->tplObj->assign_vars(array(
				'metal_p' => pretty_number(floattostring($ticket_price_dm)),
				'dm_win'	=> $ticket_prize_dm,
				'secs'		=>$secs,
				'user_lists' => $lista,
				'max_tickets_per_player' => $max_users_tickets,
				'winners'	=> $lista_winners,
				'minimum_users'	=> $CONF['lottery_min_am'],
				'lottery_dm_3'	=> sprintf($LNG['lottery_dm_19'], pretty_number(Config::get()->lottery_prize_am)),
				'lottery_dm_4'	=> sprintf($LNG['lottery_dm_20'], Config::get()->lottery_min_am, Config::get()->lottery_min_am, pretty_number(5000)),
				'lottery_dm_7'	=> sprintf($LNG['lottery_dm_7'], 1),
				'lottery_dm_pircent'	=> $percenta_lott,
			));
			$this->display('page.lotteryam.default.tpl');
		}
	}
}
?>