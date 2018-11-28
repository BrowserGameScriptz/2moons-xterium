function doit(missionID, planetID, planetP, planetS, shipData) {
 	
	var shipDetail	= decodeURIComponent($.param({"ship": shipData}));
	
	$.getJSON("game.php?page=fleetAjax&ajax=1&mission="+missionID+"&planetID="+planetID+"&planetS="+planetS+"&planetP="+planetP+"&"+shipDetail, function(data){
		
		$('#slots').text(data.slots);
		$('#probes').text(number_format(data.ship210));
		$('#recyclers').text(number_format(data.ship209));
		$('#grecyclers').text(number_format(data.ship219));
		
		
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

function Asteroid(missionID, planetID, planetP, planetS, shipData) {
	var shipDetail	= decodeURIComponent($.param({"ship": shipData}));
	$.getJSON("game.php?page=fleetAsteroid&ajax=1&mission="+missionID+"&planetID="+planetID+"&planetS="+planetS+"&planetP="+planetP+"&"+shipDetail, function(data){
		$('#slots').text(data.slots);
		$('#recyclers').text(number_format(data.ship209));
		$('#grecyclers').text(number_format(data.ship219));
		
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

function galaxy_submit(value) {
	$('#auto').attr('name', value);
	$('#galaxy_form').submit();
}

function MovimentoGalassia(mo_galasia){
	mo_galasia = (mo_galasia) ? mo_galasia : ((evento) ? evento : null);
	if(mo_galasia.keyCode == 37) {
		galaxy_submit('systemLeft');
	}
	if(mo_galasia.keyCode == 39) {
		galaxy_submit('systemRight');
	}
	/*
	if(mo_galasia.keyCode == 38) {
		galaxy_submit('galaxyRight');
	}	
	if(mo_galasia.keyCode == 40) {
		galaxy_submit('galaxyLeft');
	}*/
}
document.onkeydown = MovimentoGalassia;
function klicdiplo(){
        $('#diplom_btn').toggleClass('gl_click_hide');	
        $('#diplom_content').stop(false,true).slideToggle(300);	
};
function kliclegend(){
        $('#faq_btn').toggleClass('gl_click_hide');	
        $('#faq_content').stop(false,true).slideToggle(300);	
};

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

$(document).ready(function(){
	var doc_K=$(document);
	
	var statustable	= $('#fleetstatusrow');
	
	doc_K.on('click','.ico_save',function(){
		asd = $(this);
		if(asd.hasClass('shover')) {
			
			return false;
			
		}
			
		$(this).hide();
		galaxy = $(this).data('gal');
		system = $(this).data('sys');
		planet = $(this).data('pl');
		
		$.getJSON('game.php?page=galaxy&mode=savecord&galaxy='+galaxy+'&system='+system+'&planet='+planet, function(data) {
			if((data.message != null))
				if(data.error == true){
					asd.show();
					var mess		= $('<td />').attr('colspan', 8).attr('class', "error").text(data.message).wrap('<tr />').parent();
					statustable.removeAttr('style').after(mess);
				}
				else{
					asd.addClass('shover');
					asd.show();
					
					var mess		= $('<td />').attr('colspan', 8).attr('class', "success").text(data.message).wrap('<tr />').parent();
					statustable.removeAttr('style').after(mess);
				}
			
		});
		return false;
	});
	
	doc_K.on('click','.ico_del',function(){
		asd = $(this);
		$(this).hide();

		id = $(this).data('id');
		$.getJSON('game.php?page=galaxy&mode=delcord&id='+id, function(data) {
			if((data.message != null))
				if(data.error == true){
					asd.show();
					
					var mess		= $('<td />').attr('colspan', 8).attr('class', "error").text(data.message).wrap('<tr />').parent();
					statustable.removeAttr('style').after(mess);
				}
				else{
					$('.sgal'+id).remove();
					
					var mess		= $('<td />').attr('colspan', 8).attr('class', "success").text(data.message).wrap('<tr />').parent();
					statustable.removeAttr('style').after(mess);
				}
			
		});
		return false;
	});
});	