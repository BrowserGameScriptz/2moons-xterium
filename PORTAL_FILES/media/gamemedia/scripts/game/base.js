function toggleStatistique() {
	console.log('test good');
	$('div#big_panet div[name="information_planete"]').toggle(),
	$('div#big_panet div[name="information_stats"]').toggle(),
	$('div#big_panet div[name="information_stat_1"]').toggle(),
	$('div#big_panet div[name="information_stat_2"]').toggle(),
	CookieMethode.inverserBoolean("salle_de_controle-detail_statistique")
}

var CookieMethode={initialiser:function(){$.each(CookieMethode.liste_initialisation,function(e,t){("undefined"==typeof $.cookie(e)||null==$.cookie(e))&&CookieMethode.creer(e,t)})},creer:function(e,t,n){$.cookie(e,t,"undefined"==typeof n?365:n)},lire:function(e){return"undefined"==typeof $.cookie(e)||null==$.cookie(e)?CookieMethode.liste_initialisation.nom:$.cookie(e)},lireBoolean:function(e){return"true"===CookieMethode.lire(e)},inverserBoolean:function(e){CookieMethode.creer(e,!CookieMethode.lireBoolean(e))},supprimer:function(e){$.removeCookie(e)}};CookieMethode.liste_initialisation={"salle_de_controle-detail_statistique":!1};

function validateFormComplaint() {
	var pattern = new RegExp('^(https?:\\//\\//)?'+ // protocol
	'((([a-z\\d]([a-z\\d-]*[a-z\d])*)\\.)+[a-z]{2,}|'+ // domain name
	'((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
	'(\\:\d+)?(\\//[-a-z\\d%_.~+]*)*'+ // port and path
	'(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
	'(\\#[-a-z\\d_]*)?$','i');
	
	var x = document.forms["myForm"]["domain"].value;
		
	if (x == "" && ShowType == 1) {
		alert("Domain must be filled in");
		return false;
	}
	else if(!pattern.test(x) && ShowType == 1) {
		alert("Please enter a valid URL.");
		return false;
	}
}

function msgChatDel(MessID)
{
	$('#loading').show();

	$.get('game.php?page=chat&mode=delonemsg&MsgID='+MessID+'&ajax=1', function(data) {
		$('#loading').hide();
		NotifyBox(delonemesg);
	});
}
function number_format (number, decimals) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = '.',
        dec = ',',
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');    }
    return s.join(dec);
}

function NumberGetHumanReadable(value, dec) {
	if(typeof dec === "undefined") {
		dec = 0;
	}
	if(dec == 0)
	{
		value	= removeE(Math.floor(value));
	}
	return number_format(value, dec);
}

function shortly_number(number)
{
	var unit = ["K", "M", "B", "T", "Q", "Q+", "S", "S+", "O", "N"];
	key	= 0;
	while(number >= 1000000)
    {
		++key;
        number = number / 1000000;
    };
	return NumberGetHumanReadable(number, ((number != 0 && number < 100) + 0))+'&nbsp;'+unit[key];
}

function removeE(Number) {
	Number = String(Number);
	if (Number.search(/e\+/) == -1) 
		return Number;
	var e = parseInt(Number.replace(/\S+.?e\+/g, ''));
	if (isNaN(e) || e == 0) 
		return Number;
	else if ($.browser.webkit || $.browser.msie) 
		return parseFloat(Number).toPrecision(Math.min(e + 1, 21));
	else 
		return parseFloat(Number).toPrecision(e + 1);
}

function getFormatedDate(timestamp, format) {
	var currTime = new Date();
	currTime.setTime(timestamp + (ServerTimezoneOffset * 1000));
	str = format;
	str = str.replace('[d]', dezInt(currTime.getDate(), 2));
	str = str.replace('[D]', days[currTime.getDay()]);
	str = str.replace('[m]', dezInt(currTime.getMonth() + 1, 2));
	str = str.replace('[M]', months[currTime.getMonth()]);
	str = str.replace('[j]', parseInt(currTime.getDate()));
	str = str.replace('[Y]', currTime.getFullYear());
	str = str.replace('[y]', currTime.getFullYear().toString().substr(2, 4));
	str = str.replace('[G]', currTime.getHours());
	str = str.replace('[H]', dezInt(currTime.getHours(), 2));
	str = str.replace('[i]', dezInt(currTime.getMinutes(), 2));
	str = str.replace('[s]', dezInt(currTime.getSeconds(), 2));
	return str;
}
function dezInt(num, size, prefix) {
	prefix = (prefix) ? prefix : "0";
	var minus = (num < 0) ? "-" : "", 
	result = (prefix == "0") ? minus : "";
	num = Math.abs(parseInt(num, 10));
	size -= ("" + num).length;
	for (var i = 1; i <= size; i++) {
		result += "" + prefix;
	}
	result += ((prefix != "0") ? minus : "") + num;
	return result;
}

function getFormatedTime(time) {
	hours = Math.floor(time / 3600);
	timeleft = time % 3600;
	minutes = Math.floor(timeleft / 60);
	timeleft = timeleft % 60;
	seconds = timeleft;
	return dezInt(hours, 2) + ":" + dezInt(minutes, 2) + ":" + dezInt(seconds, 2);
}

function GetRestTimeFormat(Secs) {
	var s = Secs;
	var m = 0;
	var h = 0;
	if (s > 59) {
		m = Math.floor(s / 60);
		s = s - m * 60;
	}
	if (m > 59) {
		h = Math.floor(m / 60);
		m = m - h * 60;
	}
	return dezInt(h, 2) + ':' + dezInt(m, 2) + ":" + dezInt(s, 2);
}

function GetDayRestTimeFormat(Secs) {
	var s = Secs;
	var m = 0;
	var h = 0;
	var d = 0;
	if (s > 59) {
		m = Math.floor(s / 60);
		s = s - m * 60;
	}
	if (m > 59) {
		h = Math.floor(m / 60);
		m = m - h * 60;
	}
	if (h > 23) {
		d = Math.floor(h / 24);
		h = h - d * 24;
	}
	return dezInt(d, 2) + ':' + dezInt(h, 2) + ':' + dezInt(m, 2) + ":" + dezInt(s, 2);
}

function OpenPopup(target_url, win_name, width, height) {
	var new_win = window.open(target_url+'&ajax=1', win_name, 'scrollbars=yes,statusbar=no,toolbar=no,location=no,directories=no,resizable=no,menubar=no,width='+width+',height='+height+',screenX='+((screen.width-width) / 2)+",screenY="+((screen.height-height) / 2)+",top="+((screen.height-height) / 2)+",left="+((screen.width-width) / 2));
	new_win.focus();
}

function DestroyMissiles() {
	$.getJSON('?page=information&mode=destroyMissiles&'+$('.missile').serialize(), function(data) {
		$('#missile_502').text(NumberGetHumanReadable(data[0]));
		$('#missile_503').text(NumberGetHumanReadable(data[1]));
		$('.missile').val('');
	});
}

function handleErr(errMessage, url, line) 
{ 
	error = "There is an error at this page.\n";
	error += "Error: " + errMessage+ "\n";
	error += "URL: " + url + "\n";
	error += "Line: " + line + "\n\n";
	error += "Click OK to continue viewing this page,\n";
	alert(error);
	if(typeof console == "object")
		console.log(error);
 
	return true; 
}

function msgArchive(MessID, MessType)
{
	Message.MessID	= MessType;
	Message.MessageCount(MessType);

	$('#loading').show();

	$.get('game.php?page=messages&mode=inarchive&MsgID='+MessID+'&ajax=1', function(data) {
		$('#loading').hide();
		$('#messagestable').remove();
		$('#content table:eq(0)');
		if(data >= 10){
			return Dialog.errorarchive();
		}
	});
}
function msgDel(MessID, MessType)
{
	Message.MessID	= MessType;
	Message.MessageCount(MessType);

	$('#loading').show();

	$.get('game.php?page=messages&mode=delonemsg&MsgID='+MessID+'&ajax=1', function(data) {
		$('#loading').hide();
		NotifyBox(delonemesg);
	});
}

function flagComment(commentId)
{
	$.ajax({
	  url: '?page=raport',
	  type: 'post',
	  data: {mode:"flagcomment",MsgID:commentId},
	  dataType: 'json',
	  success: function(data){
		var flagAmount = data.flagAmount;
		//var typeO = data.type;

		if(flagAmount >= 3){
			$("#content_"+commentId).text(hofComment_5);
			$("#content_"+commentId).css("color","red");
		}
		$("#immagines_"+commentId).css("opacity","1");
		$("#youFlagged_"+commentId).text(hofComment_6);
	 },
	 error: function(data){
	   alert("error : " + JSON.stringify(data));
	 }
	});
}

var Dialog	= {	
	info: function(ID){
		return Dialog.open('game.php?page=information&id='+ID, 590, (ID > 600) ? 210 : ((ID > 100 && ID < 200) ? 300 : 620));
	},
	EntryReward: function(){ // Бонус за вход
		return Dialog.open('game.php?page=bonus&mode=entryreward', 700, 350);
	},
	errorarchive: function(){
		return Dialog.open('game.php?page=messages&mode=errorarchive', 300, 100);
	},
	
	manualinfo: function(ID){
		return Dialog.open('game.php?page=manualinfo&id='+ID, 650, 550);
	},
	
	SkillUp: function(ID){
		return Dialog.open('game.php?page=academy&mode=skillup&id='+ID, 550, 150);
	},
	
	fullControll: function(ID){
		return Dialog.open('game.php?page=fullcontroll&id='+ID, 716, 200);
	},
	
	PaySafe: function(ID){
		return Dialog.open('game.php?page=donation&mode=paysafecard&id='+ID, 550, 230);
	},
	
	minimanualinfo: function(ID){
		return Dialog.open('game.php?page=manualinfo&id='+ID, 650, 275);
	},
		
	complPM: function(ID){
		return Dialog.open('game.php?page=complaintMsg&id='+ID, 550, 500);
	},
	
	alert: function(msg, callback){
		alert(msg);
		if(typeof callback === "function") {
			callback();
		}
	},
	
	PM: function(ID, Subject, Message) {
		if(typeof Subject !== 'string')
			Subject	= '';

		return Dialog.open('game.php?page=messages&mode=write&id='+ID+'&subject='+encodeURIComponent(Subject)+'&message='+encodeURIComponent(Subject), 650, 229);
	},
	
	SRTF: function(ID) {
		return Dialog.open('game.php?page=messages&mode=SRTFshow&RaportID='+ID, 400, 130);
	},
	
	chatBana: function(ID){
		return Dialog.open('game.php?page=chatBana&user_id='+ID, 685, 600);
	},
	
	chatRules: function(ID){
		return Dialog.open('game.php?page=chat&mode=rules', 650, 550);
	},
	
	Playercard: function(ID) {
		return isPlayerCardActive && Dialog.open('game.php?page=playerCard&id='+ID, 650, 600);
	},
	
	Buddy: function(ID) {
		return Dialog.open('game.php?page=buddyList&mode=request&id='+ID, 650, 300);
	},
	
	PlanetAction: function() {
		return Dialog.open('game.php?page=overview&mode=actions', 400, 180);
	},
	
	CreateLotDeuterium: function() {
		return Dialog.open('game.php?page=createlot&mode=deuterium', 400, 196);
	},
	
	CreateLotPlanet: function() {
		return Dialog.open('game.php?page=createlot&mode=planet', 400, 200);
	},
	
	CreateLotUpgrade: function(upgrade) {
		var upline = upgrade || '';
		return Dialog.open('game.php?page=createlot&mode=upgrade&upgrade='+upline, 400, 154);
	},
	
	CreateNickname: function() {
		return Dialog.open('game.php?page=changenick', 400, 154);
	},
	
	ChangeNickname: function() {
		return Dialog.open('game.php?page=changenick&mode=change', 400, 154);
	},
	
	CreateLotItem: function(item) {
		var upline = item || '';
		return Dialog.open('game.php?page=createlot&mode=items&item='+upline, 400, 154);
	},
	
	PlanetLotInfo: function(ID){
		return Dialog.open('game.php?page=market&mode=planetlotinfo&id='+ID, 502, 500);
	},
	
	PlanetLotRate: function(ID){
		return Dialog.open('game.php?page=market&mode=planetlotrate&id='+ID, 502, 122);
	},
	
	AllianceChat: function() {
	    return OpenPopup('game.php?page=chat&action=alliance', "alliance_chat", 960, 900);
	},
	
	open: function(url, width, height) {
		$.fancybox({
			width: width,
			height: height,
			padding: 0,
			type: 'iframe',
			href: url
		});
		
		return false;
	}
}

function NotifyBox(text) {
	tip = $('#tooltip')
	tip.html(text).css({
		top : 200,
		left : (($(window).width() - $('#leftmenu').width()) / 2 - tip.outerWidth() / 2) + $('#leftmenu').width(),
		padding: '20px'
	}).show();
	window.setTimeout(function(){tip.fadeOut(1000)}, 500);
}

$.widget("custom.catcomplete", $.ui.autocomplete, {
	_renderMenu: function( ul, items ) {
		var self = this,
			currentCategory = "";
		$.each( items, function( index, item ) {
			if ( item.category != currentCategory ) {
				ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
				currentCategory = item.category;
			}
			self._renderItem( ul, item );
		});
	}
});

function getCookie(name)
{
	var matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1')  + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}

function miniChatAction(action)
{
	// установка даты в +30 дней
	date = new Date;
	date.setDate( date.getDate() + 30 );
	
	miniChatBtn = document.getElementById('miniChatBtn');
	
	if(action == 'close')
	{
		elem = document.getElementById('miniChatFrame');
		elem.parentNode.removeChild(elem);
		document.cookie = "miniChatStatus=0; expires="+date.toUTCString();
		miniChatBtn.classList.remove('miniChatBtnOpen');
		document.body.classList.remove('body_chat_active');
	}
	else if(action == 'open')
	{
		var el = document.createElement("iframe");
		document.body.appendChild(el);
		el.id		= 'miniChatFrame';
		el.src		= '//'+chat_domen_name;
		document.cookie = "miniChatStatus=1; expires="+date.toUTCString();
		miniChatBtn.classList.add('miniChatBtnOpen');
		document.body.classList.add('body_chat_active');
	}
}

jQuery(document).ready(function(){ 
	if(miniChat == 1)
	{
		var el = document.createElement("div");
		document.body.appendChild(el);
		el.id			= 'miniChatBtn';
		el.classList.add('miniChatBtn');
		
		cook = getCookie("miniChatStatus");
		if(cook == 1)
			miniChatAction('open');
	}
});

$(function() {
	$('#drop-admin').on('click', function() {
		$.get('admin.php?page=logout', function() {
			$('.globalWarning').animate({
				'height' :0,
				'padding' :0,
				'opacity' :0
			}, function() {
				$(this).hide();
			});
		});
	});	
	
	$("button#create_new_alliance_rank").click(function() {
		$("div#new_alliance_rank").dialog(		{
			draggable: false,
			resizable: false,
			modal: true,
			width: 760
		});

		return false;
	});
	
	$('#miniChatBtn').click(function() {
		miniChatStatus = document.getElementById('miniChatFrame');
		if(miniChatStatus)
		{
			miniChatAction('close');
			return false;
		}
		else if(!miniChatStatus)
		{
			miniChatAction('open');
			return false;
		}
		else
		{
			return false;
		}
	});
});


function klicsetting(){
        $('#diplom_btn').toggleClass('gl_click_hide');	
        $('#settinghided').stop(false,true).slideToggle(300);	
};

