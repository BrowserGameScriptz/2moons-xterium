function searchRooms(){
	search_text = document.getElementById('search_name').value;
	jQuery.post("../chat.rooms.list.php", {'name': search_text, 'ajax': 1}, function(data)
	{
		if(data.RoomsList !== "undefined")
		{
			$("#roomsList").html(data.RoomsList);
		}
	}, "json");
}
function exitRoom(){
	if(confirm(lng.confirm_exit)){
		jQuery.post("../chat.room.exit.php", function(data)
		{
			var miniChat = 0;
			
			if(bodyclass != "full")
			{
			var miniChat = 1;	
			}
			
			location.href = 'game.php?page=chat&mode=rooms&mini_chat='+miniChat;
		}, "json");
	}
}
function kickFromRoom(ID){
	if(confirm(lng.confirm_kick)){
		jQuery.post("../chat.room.kick.php", {'id': ID, 'ajax': 1});
	}
}
function pwdEdit(){
	newpass = prompt(lng.prompt_pass,'');
	if(newpass == null)
		return;
	if(newpass == '' || newpass == null){
		alert(lng.alert_pass);
		return;
	}
	re_pass = prompt(lng.prompt_pass2,'');
	if(re_pass == null)
		return;
	if(newpass != re_pass){
		alert(lng.alert_pass2);
		return;
	}
	jQuery.post("../chat.room.pwd.php", {'pass': newpass, 'ajax': 1});
	alert(lng.alert_done);
}