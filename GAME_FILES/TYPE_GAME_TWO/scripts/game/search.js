function instant(event){
	if (event.keyCode == $.ui.keyCode.ENTER) {
		event.preventDefault();
	}
	
	if ($.inArray(event.keyCode, [
		91, // WINDOWS
		18, // ALT
		20, // CAPS_LOCK
		188, // COMMA
		91, // COMMAND
		91, // COMMAND_LEFT
		93, // COMMAND_RIGHT
		17, // CONTROL
		40, // DOWN
		35, // END
		13, // ENTER
		27, // ESCAPE
		36, // HOME
		45, // INSERT
		37, // LEFT
		93, // MENU
		107, // NUMPAD_ADD
		110, // NUMPAD_DECIMAL
		111, // NUMPAD_DIVIDE
		108, // NUMPAD_ENTER
		106, // NUMPAD_MULTIPLY
		109, // NUMPAD_SUBTRACT
		34, // PAGE_DOWN
		33, // PAGE_UP
		190, // PERIOD
		39, // RIGHT
		16, // SHIFT
		32, // SPACE
		9, // TAB
		38, // UP
		91 // WINDOWS
	]) !== -1) {
		return;
	}
		
	$.get('game.php?page=search&mode=result&type='+$('#type').val()+'&search='+$('#searchtext').val()+'&ajax=1', function(data) {
		$('#resulttable').remove();
		$('#content > table').after(data);	
	});
}

$(document).ready(function() {
	$('#searchtext').on('keyup', instant);
	$('#type').on('change', instant);
});

function checkOutlaw()
{
	if(!confirm(lngoutlaw))
		return;
	
	$.getJSON('game.php?page=galaxy&mode=outlaw', function(response){
		alert(response.message);
		if(response.ok){
			parent.location.reload();
		}
	});
	
}

function doit(missionID, planetID, planetP, planetS, shipData) {
 	
	var shipDetail	= decodeURIComponent($.param({"ship": shipData}));
	
	$.getJSON("game.php?page=fleetAjax&ajax=1&mission="+missionID+"&planetID="+planetID+"&planetS="+planetS+"&planetP="+planetP+"&"+shipDetail, function(data){
		
		$('#slots').text(data.slots);
		$('#probes').text(number_format(data.ship210));
		
		
		var statustable	= $('#fleetstatusrow');
		var messages	= statustable.find("~tr");
		if(messages.length == MaxFleetSetting) {
			console.log(messages.get(MaxFleetSetting - 1));
			messages.filter(':last').remove();
		}
		
		var element		= $('<td />').attr('colspan', 8).attr('class', data.code == 600 ? "success" : "error").text(data.mess).wrap('<tr />').parent();
		statustable.removeAttr('style').after(element);
	});

}