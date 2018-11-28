var chat_refreshing = false;
var chat_last_message = 0;

if(!status_smiles_menu){
	var status_smiles_menu = false;
}
if(!status_msg_color_menu){
	var status_msg_color_menu = false;
}
if(!status_img_add_menu){
	var status_img_add_menu = false;
}
if(!status_chat_sound){
	var status_chat_sound = true;
}

function msgEnterClean(message)
{
	var reg = new RegExp("\\n+", "i");
	message = message.replace(reg,"");
	return message;
}

function blockChat(userID)
{
	if(!confirm('Are you sure you want to clock this player for 24h'))
		return;
	
	$.getJSON('game.php?page=chat&mode=blockuser&blockid='+ userID, function(response){
		alert(response.message);
	});
	
}

function addSmiley(smiley,smileyName)
{
	if(smileyName != 'nickname')
		smiley = ' '+smiley+' ';
	document.chat_form.msg.value += smiley;
	//document.chat_form.msg.focus();
	setCursorPosition(document.chat_form.msg);
	if(smileyName != 'nickname'){
		coockRefresh(smileyName);
		coockView();
	}
}

// Ð²Ð¾Ð·Ð²Ñ€Ð°Ñ‰Ð°ÐµÑ‚ cookie Ñ Ð¸Ð¼ÐµÐ½ÐµÐ¼ name, ÐµÑÐ»Ð¸ ÐµÑÑ‚ÑŒ, ÐµÑÐ»Ð¸ Ð½ÐµÑ‚, Ñ‚Ð¾ undefined
function getCookie(name)
{
	var matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1')  + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}

// Ð’Ñ‹Ð²Ð¾Ð´ Ð¿Ð¾ÑÐ»ÐµÐ´Ð½Ð¸Ñ… ÑÐ¼Ð°Ð¹Ð»Ð¾Ð² Ð¸Ð· ÐºÑƒÐºÐ¸ÑÐ¾Ð²
function coockView()
{
	// Ñ€Ð°Ð·Ð±Ð¸Ð²Ð°ÐµÐ¼ Ð¿Ð¾Ð»ÑƒÑ‡Ð°ÐµÐ¼ÑƒÑŽ ÑÑ‚Ñ€Ð¾ÐºÑƒ Ð¸Ð· ÐºÑƒÐºÐ¸ Ð½Ð° Ð¼Ð°ÑÑÐ¸Ð²
	cook = getCookie("SmilesXterium").split(',');
	
	// Ð¾Ð±Ð½ÑƒÐ»ÑÐµÐ¼ Ð±Ð»Ð¾Ðº ÑÐ¾ Ð¿Ð¾ÑÐ»ÐµÐ´Ð½Ð¸Ð¼Ð¸ ÑÐ¼Ð°Ð¹Ð»Ð°Ð¼Ð¸
	$('#last_smiles').text('');

	// ÑƒÑÑ‚Ð°Ð½Ð°Ð²Ð»Ð¸Ð²Ð°ÐµÐ¼ ÑÑ‡Ñ‘Ñ‚Ñ‡Ð¸Ðº Ñ†Ð¸ÐºÐ»Ð° Ð² Ð½ÑƒÐ»ÐµÐ²ÑƒÑŽ Ð¿Ð¾Ð·Ð¸Ñ†Ð¸ÑŽ
	i = 0;
	// Ð²Ñ‹Ð²Ð¾Ð´Ð¸Ð¼ ÐºÐ°Ð¶Ð´Ð¾Ðµ Ð·Ð½Ð°Ñ‡ÐµÐ½Ð¸Ðµ Ð¼Ð°ÑÑÐ¸Ð²Ð° Ð² Ð²Ð¸Ð´Ðµ html-ÑÐ»ÐµÐ¼ÐµÐ½Ñ‚Ð°
	while(i < cook.length){
		// Ð¿Ñ€Ð¸ÑÐ²Ð°Ð¸Ð²Ð°ÐµÐ¼ Ð¿ÐµÑ€ÐµÐ¼ÐµÐ½Ð½Ð¾ ÑÐ¼Ð°Ð¹Ð», ÑÐ¾Ñ…Ñ€Ð°Ð½Ñ‘Ð½Ð½Ñ‹Ð¹ Ð² ÐºÑƒÐºÐ°Ñ…
		smile = document.getElementById(cook[i]);
		
		// ÑÐ¾Ð·Ð´Ð°Ñ‘Ð¼ ÑÐ»ÐµÐ¼ÐµÐ½Ñ‚ IMG
		var newImg = document.createElement('img');
		newImg.setAttribute('src', smile.getAttribute('src'));
		newImg.setAttribute('style', smile.getAttribute('style'));
		newImg.setAttribute('title', smile.getAttribute('title'));
		newImg.setAttribute('alt', smile.getAttribute('alt'));
		newImg.setAttribute('onClick', smile.getAttribute('onClick'));
		
		// ÑÐ»ÐµÐ¼ÐµÐ½Ñ‚ DIV Ñ Ð¿Ð¾ÑÐ»ÐµÐ´Ð½Ð¸Ð¼Ð¸ ÑÐ¼Ð°Ð¹Ð»Ð°Ð¼Ð¸
		var smilesDiv = document.getElementById('last_smiles');
	
		smilesDiv.appendChild(newImg);
		i++;
	}
}

// ÐžÐ±Ð½Ð¾Ð²Ð»ÐµÐ½Ð¸Ðµ ÐºÑƒÐºÐ¸ Ñ Ð¿Ð¾ÑÐ»ÐµÐ´Ð½Ð¸Ð¼Ð¸ ÑÐ¼Ð°Ð¹Ð»Ð°Ð¼Ð¸
function coockRefresh(val)
{
	// ÑƒÑÑ‚Ð°Ð½Ð¾Ð²ÐºÐ° Ð´Ð°Ñ‚Ñ‹ Ð² +30 Ð´Ð½ÐµÐ¹
	date = new Date;
	date.setDate( date.getDate() + 30 );
	
	// Ð•ÑÐ»Ð¸ Ñ‚Ð°ÐºÐ¾Ð¹ ÐºÑƒÐºÐ¸ Ð½ÐµÑ‚, Ñ‚Ð¾ Ð¿Ñ€Ð¾ÑÑ‚Ð¾ ÑÐ¾Ð·Ð´Ð°Ñ‘Ð¼ Ð½Ð¾Ð²ÑƒÑŽ Ñ Ð¾Ð´Ð½Ð¸Ð¼ Ð·Ð½Ð°Ñ‡ÐµÐ½Ð¸ÐµÐ¼
	if(getCookie("SmilesXterium") == undefined){
		document.cookie = "SmilesXterium="+val+"; expires="+date.toUTCString();;
		return;
	}
	
	// Ð•ÑÐ»Ð¸ ÐºÑƒÐºÐ° ÐµÑÑ‚ÑŒ, Ñ‚Ð¾ Ñ€Ð°Ð·Ð±Ð¸Ñ€Ð°ÐµÐ¼ ÐµÑ‘ Ð½Ð° Ð¼Ð°ÑÑÐ¸Ð²
	cook = getCookie("SmilesXterium").split(',');
	
	// Ð•ÑÐ»Ð¸ Ð´Ð»Ð¸Ð½Ð° Ð¼Ð°ÑÑÐ¸Ð²Ð° Ð¼ÐµÐ½ÑŒÑˆÐµ ÑˆÐµÑÑ‚Ð¸,
	// Ñ‚Ð¾ Ð¿Ñ€Ð¾Ð²ÐµÑ€ÑÐµÐ¼ Ð½Ð¾Ð²Ð¾Ðµ Ð·Ð½Ð°Ñ‡ÐµÐ½Ð¸Ðµ Ð½Ð° Ð½Ð°Ð»Ð¸Ñ‡Ð¸Ð¸Ðµ, Ð¸ ÐµÑÐ»Ð¸ ÐµÐ³Ð¾ Ð½ÐµÑ‚
	// Ð¿Ñ€Ð¾ÑÑ‚Ð¾ Ð´Ð¾Ð±Ð°Ð²Ð»ÑÐµÐ¼ ÐµÐ³Ð¾ Ð² ÐºÐ¾Ð½ÐµÑ†. Ð¡Ð¾Ñ…Ñ€Ð°Ð½ÑÐµÐ¼ ÐºÑƒÐºÑƒ
	if(cook.length != 6){
		i = cook.length;
		while(i > 0){
			if(cook[i-1] == val)
				return;
			i--;
		}
		cook[cook.length] = val;
		document.cookie = "SmilesXterium="+cook+"; expires="+date.toUTCString();;
	}
	// Ð•ÑÐ»Ð¸ Ð·Ð½Ð°Ñ‡ÐµÐ½Ð¸Ð¹ ÑˆÐµÑÑ‚ÑŒ, Ñ‚Ð¾ Ð¿Ñ€Ð¾Ð²ÐµÑ€ÑÐµÐ¼ Ð½Ð¾Ð²Ð¾Ðµ Ð·Ð½Ð°Ñ‡ÐµÐ½Ð¸Ðµ Ð½Ð° Ð½Ð°Ð»Ð¸Ñ‡Ð¸Ð¸Ðµ, Ð¸ ÐµÑÐ»Ð¸ ÐµÐ³Ð¾ Ð½ÐµÑ‚
	// Ð´Ð¾Ð±Ð°Ð²Ð»ÑÐµÐ¼ ÐµÐ³Ð¾ Ð¿Ð¾ Ð¿Ñ€Ð¸Ð½Ñ†Ð¸Ð¿Ñƒ ÑÑ‚ÐµÐºÐ°. Ð¡Ð¾Ñ…Ñ€Ð°Ð½ÑÐµÐ¼ ÐºÑƒÐºÑƒ
	else{
		i = cook.length;
		while(i > 0){
			if(cook[i-1] == val)
				return;
			i--;
		}
		i = 0;
		while(i < cook.length){
			if(i != 5){
				cook[i] = cook[i+1]
			}else{
				cook[i] = val;
			}
			i++;
		}
		document.cookie = "SmilesXterium="+cook+"; expires="+date.toUTCString();;
	}
}

function msgColorSelect(color, authlevel, userID)
{
	if(color == 'my'){
		color = document.chat_form.chat_msg_color_my.value;
	}

	if(userID == 17){
		color = color;
	}
	else if(authlevel != 3 && color == '#ff0000'){
		color = '#ffffff';
	}
	
	$.get("game.php?page=chat&mode=colorselect", {'color': color, 'ajax': 1}, function(data) {});
	document.chat_form.msg_color.value = color;
	document.getElementById('chat_msg_color_short').style.background = color;

	showMsgColorMenu('close');
}

function addImage()
{
	url = document.chat_form.chat_img.value;
	document.chat_form.chat_img.value = '';

	img = NUUL; //"[img="+url+"]";

	jQuery.post("../chat_add.php", {'ally': ally_id, 'message': img, 'ajax': 1}, function(data)
	{
		showMessage();
	});

	//document.chat_form.msg.focus();
	setCursorPosition(document.chat_form.msg);
	closeAllMenu();
}

function closeAllMenu(){
	showMsgColorMenu('close');
	showSmilesMenu('close');
	showImgAddMenu("close");
}

function showSmilesMenu(act)
{
	if(act != 'close'){
		showMsgColorMenu("close");
		showImgAddMenu("close");
	}
	if(act == 'close'){
		status_smiles_menu = true;
	}
	if(act == 'open'){
		status_smiles_menu = false;
	}

	if(status_smiles_menu == false){
		$('#chat_smiles').stop(true,false).slideDown(300);
		status_smiles_menu = true;
		act ='';
	} else if(status_smiles_menu == true){
		$('#chat_smiles').stop(true,false).slideUp(300);
		status_smiles_menu = false;
		//document.chat_form.msg.focus();
		//setCursorPosition(document.chat_form.msg);
		act ='';
	}
}

function showMsgColorMenu(act)
{
	if(act != 'close'){
		showSmilesMenu("close");
		showImgAddMenu("close");
	}
	if(act == 'close'){
		status_msg_color_menu = true;
	}
	if(act == 'open'){
		status_msg_color_menu = false;
	}

	if(status_msg_color_menu == false){
		$('#msg_color_menu').stop(true,false).slideDown(300);
		status_msg_color_menu = true;
		act ='';
	} else if(status_msg_color_menu == true){
		$('#msg_color_menu').stop(true,false).slideUp(300);
		status_msg_color_menu = false;
		//document.chat_form.msg.focus();
		//setCursorPosition(document.chat_form.msg);
		act ='';
	}
}

function showImgAddMenu(act)
{
	if(act != 'close'){
		showMsgColorMenu("close");
		showSmilesMenu("close");
	}
	if(act == 'close'){
		status_img_add_menu = true;
	}
	if(act == 'open'){
		status_img_add_menu = false;
	}

	if(status_img_add_menu == false){
		$('#chat_img_add').stop(true,false).slideDown(300);
		status_img_add_menu = true;
		act ='';
	} else if(status_img_add_menu == true){
		$('#chat_img_add').stop(true,false).slideUp(300);
		status_img_add_menu = false;
		//document.chat_form.msg.focus();
		//setCursorPosition(document.chat_form.msg);
		act ='';
	}
}

function chatSoundMute(act)
{
	if(status_chat_sound == false || act == 'unmute'){
		status_chat_sound = true;
		chatSoundMuteCookie('unmute');
		$('#sound_mute').hide();
		$('#sound_unmute').show();
	} else if(status_chat_sound == true || act == 'mute'){
		status_chat_sound = false;
		chatSoundMuteCookie('mute');
		$('#sound_unmute').hide();
		$('#sound_mute').show();
	}
	document.chat_form.msg.focus();
	setCursorPosition(document.chat_form.msg);
}

function chatSoundMuteCookie(val)
{
	// ÑƒÑÑ‚Ð°Ð½Ð¾Ð²ÐºÐ° Ð´Ð°Ñ‚Ñ‹ Ð² +30 Ð´Ð½ÐµÐ¹
	date = new Date;
	date.setDate( date.getDate() + 30 );
	
	// Ð—Ð°Ð¿Ð¸ÑÑ‹Ð²Ð°ÐµÐ¼ ÐºÑƒÐºÑƒ
	document.cookie = "ChatSound="+val+"; expires="+date.toUTCString();;
}

function addMessage()
{
	var message = document.chat_form.msg.value;
	
	message = msgEnterClean(message);
	
	if(!message){
		document.chat_form.msg.value = '';
		$('#lost_symbols').text('0');
		return;
	}

	document.chat_form.msg.value = '';
	var color = document.chat_form.msg_color.value;
	if(color == ''){
		color = 'white';
	}
	$('#lost_symbols').text('0');
  
	message = "[c="+color+"]" + message + "[/c]";

	jQuery.post("../chat_add.php", {'ally': ally_id, 'message': message, 'ajax': 1}, function(data){
		showMessage();
		$('#lost_symbols').text('0');
	});
}

function showMessage(norefresh)
{
  if(chat_refreshing)
  {
    return;
  }
  
  chat_refreshing = true;

  jQuery.post("../chat_msg.php", {'ally': ally_id, 'last_message': chat_last_message, 'online': 1, 'ajax': 1}, function(data)
  {

		if(data != undefined)
	  {
		  var shoutbox = document.getElementById('shoutbox');
		  var onlinecat = document.getElementById('online_chat');
		  var beepchat = document.getElementById('beepchat');
		  if(data.html)
		  {
			chat_last_message = data.last_message;
			shoutbox.innerHTML += data.html;
			jQuery('#shoutbox').animate({scrollTop: jQuery('#shoutbox').prop('scrollHeight')}, 1);
			if(data.sound && status_chat_sound == true)
			{
				beepchat.play();
			}
			}
			if(data.online)
			  {
				onlinecat.innerHTML = data.online;
			  }
		  /*}*/
	  }
	  chat_refreshing = false;
      window.setTimeout(showMessage, 5000);
    }, "json"
  );
}

function setCursorPosition(inputObject)
{
	if (inputObject.selectionStart){
		var end = inputObject.value.length;
		inputObject.setSelectionRange(end,end);
		inputObject.focus();
	}
}

function ChatSoundGetCookie()
{
	status = getCookie("ChatSound");
	if(status == 'unmute')
		chatSoundMute('unmute');
	if(status == 'mute')
		chatSoundMute('mute');
}

jQuery(document).ready(function(){
    showMessage();
	coockView();
	ChatSoundGetCookie();
	$('#msg').keyup(function(e) {
		if(e.which == 27) {
			document.chat_form.msg.value = '';
			$('#lost_symbols').text('0');
			e.preventDefault();
			return false;
		}
	});
});
function keyUp()
{
	message = document.chat_form.msg.value;
	$('#lost_symbols').text(message.length);
	document.chat_form.msg.value = msgEnterClean(message);
}

