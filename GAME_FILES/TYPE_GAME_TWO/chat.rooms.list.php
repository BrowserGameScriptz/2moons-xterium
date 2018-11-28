<?php
define('MODE', 'JSON');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/chat/common_json.php';

$session    = Session::load();
if(!$session->isValidSession()){
$session->delete();
HTTP::redirectTo('index.php?code=3');
}
$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
$USER	= Database::get()->selectSingle($sql, array(
':userId'	=> $session->userId
));

$LNG = new Language($USER['lang']);
$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME'));

$name 		= HTTP::_GP('search_text', '', true);
$jsonData	= array();

$jsonData['RoomsList']	= "<table id='mytable' class='tablesorter ally_ranks lots'>";
$jsonData['RoomsList']	.= "<tr>";
$jsonData['RoomsList']	.= "<th class='gray_stripe' style='width:15px;'>ID</th>";
$jsonData['RoomsList']	.= "<th class='gray_stripe'>".$LNG['chat_room_name']."</th>";
$jsonData['RoomsList']	.= "<th class='gray_stripe'>".$LNG['chat_room_owner']."</th>";
$jsonData['RoomsList']	.= "<th class='gray_stripe' style='width:15px;'>".$LNG['chat_room_pwd']."</th>";
$jsonData['RoomsList']	.= "<th class='gray_stripe' style='width:30px;'>&nbsp;</th>";


		$db	= Database::get();

		$sql	= 'SELECT * FROM %%CHAT_ROOMS%% WHERE name LIKE :name ORDER BY `name` ASC LIMIT 30';
		$query = $db->select($sql, array(
			':name'	=> '%'.$name.'%'
		));

		
if(!empty($query)){ // если комнат больше нуля, то надо показать их во всей красе
	foreach ($query as $Rows) // В массив $jsonData['RoomsList'] вводим список комнат
	{
		if($Rows['pass'] != '') // Есть пароль? А если найду???
			$Rows['pass'] = "<span style='color:#cf0000'>".$LNG['chat_room_closed']."</span>";
		else // Точно нет?
			$Rows['pass'] = "<span style='color:#0c0'>".$LNG['chat_room_open']."</span>";
		
		$jsonData['RoomsList']	.= "<tr>";
		$jsonData['RoomsList']	.= "<td>".$Rows['id']."</td>";
		$jsonData['RoomsList']	.= "<td>".$Rows['name']."</td>";
		$jsonData['RoomsList']	.= "<td>".$Rows['name_owner']."</td>";
		$jsonData['RoomsList']	.= "<td>".$Rows['pass']."</td>";
		$jsonData['RoomsList']	.= "<td><form action='game.php?page=chat' method='POST'>";
		$jsonData['RoomsList']	.= "<input name='mode' value='roomsActions' type='hidden'>";
		$jsonData['RoomsList']	.= "<input name='action' value='login' type='hidden'>";
		$jsonData['RoomsList']	.= "<input name='room' value='".$Rows['id']."' type='hidden'>";
		$jsonData['RoomsList']	.= "<input class='cursor' value='".$LNG['chat_rooms_login']."' type='submit'>";
		$jsonData['RoomsList']	.= "</form></td>";
		$jsonData['RoomsList']	.= "</tr>";
	}
}else{
	$jsonData['RoomsList']	.= "<tr>";
	$jsonData['RoomsList']	.= "<td colspan=5>".$LNG['chat_no_rooms_result']."</td>";
	$jsonData['RoomsList']	.= "</tr>";
}
$jsonData['RoomsList']	.= "</table>";

echo json_encode($jsonData);