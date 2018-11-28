var acstime = 0;

function simulateExpo()
{
	DotsToCount();
	$('input[name=sendButton]').prop('disabled', true);
	$('#sendButton').attr('value', 'Please wait !');
	var url  = "game.php?page=battleSimulator"; // the script where you handle the form input.
	var form = $('#form').serialize();
	
    $.ajax({
		type: "POST",
		url: url,
        data: {mode:'expeditionSend',form:form},
        success: function(data)
		{
			alert(data);
			$('input[name=sendButton]').prop('disabled', false);
			$('#sendButton').attr('value', 'Simulate Expedition');
			countDots();
		}
	});
}
function updateVars()
{
	document.getElementsByName("fleet_group")[0].value = 0;
	dataFlyDistance = GetDistance();
	dataFlyTime = GetDuration();
	dataFlyConsumption = GetConsumption();
	dataFlyCargoSpace = storage();
	dataFlyTime = dataFlyTime * data.fleetspeedfactor
	dataTime = dataFlyTime * data.fleetspeedfactor
	refreshFormData();
	$("#TIMING").val(dataTime);
	$('#listsector').hide();
}

function updateVarsMOD()
{
	dataFlyDistance = GetDistance();
	dataFlyTime = GetDuration();
	dataFlyConsumption = GetConsumption();
	dataFlyCargoSpace = storage();
	dataFlyTime = dataFlyTime * data.fleetspeedfactor
	dataTime = dataFlyTime * data.fleetspeedfactor
	refreshFormData();
	$("#TIMING").val(dataTime);
}

function GetDistance() {
	var thisGalaxy = data.planet.galaxy;
	var thisSystem = data.planet.system;
	var thisPlanet = data.planet.planet;
	var targetGalaxy = document.getElementsByName("galaxy")[0].value;
	var targetSystem = document.getElementsByName("system")[0].value;
	var targetPlanet = document.getElementsByName("planet")[0].value;
	
	var a2700 = 0;
	var a1000 = 0;
	if(targetSystem != thisSystem) a2700 = 2700;
	if(targetPlanet != thisPlanet) a1000 = 1000;
	if (targetGalaxy != thisGalaxy || targetPlanet != thisPlanet || targetSystem != thisSystem) {
		return (Math.abs(targetGalaxy - thisGalaxy) * 20000)+(Math.abs(targetSystem - thisSystem) * 95 + a2700) + (Math.abs(targetPlanet - thisPlanet) * 5 + a1000);
	} else {
		return 5;
	}
}

function GetDuration() {
	var sp = document.getElementsByName("speed")[0].value;	
	var rp = (3500 / (sp * 0.1));	
	rp    *= Math.pow(dataFlyDistance * 10 / data.maxspeed, 0.5);
	rp    += 10;
	rp    /= data.gamespeed;

	var gv = 0
	if(dm_fleettime > getActualDate){
		gv = Math.floor(0.1 * 100 + (0.01 * Math.floor(dm_fleettime_level / 1) * 100));
	}
	if(gv > 0)
	{
		rp	= rp * Math.max(0, 1 + gv/100*-1);
	}
	
	return Math.max(rp, 5);
}

function GetConsumption() {
	var dataFlyConsumption = 0;
	var dataFlyConsumption2 = 0;
	var basicConsumption = 0;
	var i;
	$.each(data.ships, function(shipid, ship){
		spd = 35000 / (dataFlyTime * data.gamespeed - 10) * Math.sqrt(dataFlyDistance * 10 / ship.speed);
		basicConsumption = ship.consumption * ship.amount;
		dataFlyConsumption2 += basicConsumption * dataFlyDistance / 35000 * (spd / 10 + 1) * (spd / 10 + 1);
	}); 
	return Math.round((0 + dataFlyConsumption2) * Math.pow(0.99, 0)) + 1;
}

function storage() {
	return data.fleetroom - dataFlyConsumption;
}

function refreshFormData() {
	var seconds = dataFlyTime;
	var hours = Math.floor(seconds / 3600);
	seconds -= hours * 3600;
	var minutes = Math.floor(seconds / 60);
	seconds -= minutes * 60;
	$("#duration").text(hours + (":" + dezInt(minutes, 2) + ":" + dezInt(seconds,2) + " h"));
	$("#distance").text(NumberGetHumanReadable(dataFlyDistance));
	$("#maxspeed").text(NumberGetHumanReadable(data.maxspeed));
	if (dataFlyCargoSpace >= 0) {
		$("#consumption").html("<font color=\"lime\">" + NumberGetHumanReadable(dataFlyConsumption) + "</font>");
		$("#storage").html("<font color=\"lime\">" + NumberGetHumanReadable(dataFlyCargoSpace) + "</font>");
	} else {
		$("#consumption").html("<font color=\"red\">" + NumberGetHumanReadable(dataFlyConsumption) + "</font>");
		$("#storage").html("<font color=\"red\">" + NumberGetHumanReadable(dataFlyCargoSpace) + "</font>");
	}
}

function setACSTarget(galaxy, solarsystem, planet, type, tacs) {
	setTarget(galaxy, solarsystem, planet, type);
	updateVars();
	document.getElementsByName("fleet_group")[0].value = tacs;
	ListSector();
}

function setTarget(galaxy, solarsystem, planet, type) {
	document.getElementsByName("galaxy")[0].value = galaxy;
	document.getElementsByName("system")[0].value = solarsystem;
	document.getElementsByName("planet")[0].value = planet;
	document.getElementsByName("type")[0].value = type;
}

function FleetTime(){ 
	if (typeof(dataFlyTime) != "undefined")
	{
		var sekunden = serverTime.getSeconds();
		var starttime = dataFlyTime;
		var endtime	= starttime + dataFlyTime;
		$("#arrival").html(getFormatedDate(serverTime.getTime()+1000*starttime, tdformat));
		$("#return").html(getFormatedDate(serverTime.getTime()+1000*endtime, tdformat));
	}
}

function setResource(id, val) {
	if (document.getElementsByName(id)[0]) {
		document.getElementsByName("resource" + id)[0].value = val;
	}
}

function maxResource(id) {
	var thisresource = Math.max(0, getRessource(id) - HoldResources[id]);
	var thisresourcechosen = parseInt(document.getElementsByName(id)[0].value);
	
	if (isNaN(thisresourcechosen)) {
		thisresourcechosen = 0;
	}
	if (isNaN(thisresource)) {
		thisresource = 0;
	}
	
	var storCap = data.fleetroom - data.consumption;
	
	if (id == 'deuterium') {
		thisresource -= data.consumption;
	}
	
	if (thisresource < 0) {
		thisresource = 0;
	}
	
	var metalToTransport = parseInt(document.getElementsByName("metal")[0].value);
	var crystalToTransport = parseInt(document.getElementsByName("crystal")[0].value);
	var deuteriumToTransport = parseInt(document.getElementsByName("deuterium")[0].value);
	
	if (isNaN(metalToTransport)) {
		metalToTransport = 0;
	}
	if (isNaN(crystalToTransport)) {
		crystalToTransport = 0;
	}
	if (isNaN(deuteriumToTransport)) {
		deuteriumToTransport = 0;
	}
	
	var freeCapacity = Math.max(storCap - metalToTransport - crystalToTransport - deuteriumToTransport, 0);
	document.getElementsByName(id)[0].value = Math.min(freeCapacity + thisresourcechosen, thisresource);
	calculateTransportCapacity();
	countDots();
}

function minResource(id) {
	document.getElementsByName(id)[0].value = 0;
	calculateTransportCapacity();
	countDots();
}

function maxResources() {
	maxResource('metal');
	maxResource('crystal');
	maxResource('deuterium');
	countDots();
}

function calculateTransportCapacity() {
	DotsToCount();
	var metal = Math.abs(document.getElementsByName("metal")[0].value);
	var crystal = Math.abs(document.getElementsByName("crystal")[0].value);
	var deuterium = Math.abs(document.getElementsByName("deuterium")[0].value);
	transportCapacity = data.fleetroom - data.consumption - metal - crystal - deuterium;
	if (transportCapacity < 0) {
		document.getElementById("remainingresources").innerHTML = "<font color=red>" + NumberGetHumanReadable(transportCapacity) + "</font>";
	} else {
		document.getElementById("remainingresources").innerHTML = "<font color=lime>" + NumberGetHumanReadable(transportCapacity) + "</font>";
	}
	countDots();
	return transportCapacity;
}

function maxShip(id) {
	if (document.getElementsByName(id)[0]) {
		var amount = document.getElementById(id + "_value").innerHTML;
		document.getElementsByName(id)[0].value = amount.replace(/\./g, "");
	}
	countDots();
	colorSet();
	fleetPoints();
}

function minShip(id) {
	if (document.getElementsByName(id)[0]) {
		document.getElementsByName(id)[0].value = 0;
	}
	countDots();
	colorSet();
	fleetPoints();
}

function setShip(id, count) {
	if (document.getElementsByName(id)[0]) {
		document.getElementsByName(id)[0].value = count;
	}
	countDots();
	colorSet();
	fleetPoints();
}

function maxShips() {
	var id;
	for (i = 200; i < 250; i++) {
		id = "ship" + i;
		maxShip(id);
	}
	countDots();
	colorSet();
	fleetPoints();
}

function maxShipsBatle() {
	var id;
	for (i = 200; i < 250; i++) {
		id = "ship" + i;
		if(i != 202 && i != 203 && i != 217 && i != 209 && i != 219 && i != 208 && i != 210 && i != 220 && i != 223)	
		maxShip(id);
	}
	countDots();
	colorSet();
	fleetPoints();
}

function maxShipsTransports() {
	maxShip("ship" + 202);
	maxShip("ship" + 203);
	maxShip("ship" + 217);
	countDots();
	colorSet();
	fleetPoints();
}

function maxShipsProcessors() {
	maxShip("ship" + 209);
	maxShip("ship" + 219);
	countDots();
	colorSet();
	fleetPoints();
}

function maxShipsSpecial() {
	maxShip("ship" + 208);
	maxShip("ship" + 210);
	maxShip("ship" + 220);
	maxShip("ship" + 223);
	countDots();
	colorSet();
	fleetPoints();
}

function GroopShips(idGroop) {
	var id;
	for (i = 200; i < 250; i++) {
		id = "ship" + i;
		count = 0;
		
 		if(typeof fleetGroopShip[idGroop][i] !== "undefined")
			count = fleetGroopShip[idGroop][i];
			
		setShip(id, count);
	}
	countDots();
	colorSet();
	fleetPoints();
}

function onSave() {
	$('#save').show();
}


function noShip(id) {
	if (document.getElementsByName(id)[0]) {
		document.getElementsByName(id)[0].value = 0;
	}
	countDots();
	colorSet();
	fleetPoints();
}


function noShips() {
	var id;
	for (i = 200; i < 250; i++) {
		id = "ship" + i;
		noShip(id);
	}
	colorSet();
	fleetPoints();
}

function noShipsBatle() {
	var id;
	for (i = 200; i < 250; i++) {		
		id = "ship" + i;
		if(i != 202 && i != 203 && i != 217 && i != 209 && i != 219 && i != 208 && i != 210 && i != 220 && i != 223)	
		noShip(id);
	}
	colorSet();
	fleetPoints();
}

function noShipsTransports() {
	noShip("ship" + 202);
	noShip("ship" + 203);
	noShip("ship" + 217);
	colorSet();
	fleetPoints();
}

function noShipsProcessors() {
	noShip("ship" + 209);
	noShip("ship" + 219);
	colorSet();
	fleetPoints();
}

function noShipsSpecial() {
	noShip("ship" + 208);
	noShip("ship" + 210);
	noShip("ship" + 220);
	noShip("ship" + 223);
	colorSet();
	fleetPoints();
}

function setNumber(name, number) {
	if (typeof document.getElementsByName("ship" + name)[0] != "undefined") {
		document.getElementsByName("ship" + name)[0].value = number;
	}
}

function CheckTarget()
{
	kolo	= (typeof data.ships[208] == "object") ? 1 : 0;
		
	$.getJSON('game.php?page=fleetStep1&mode=checkTarget&galaxy='+document.getElementsByName("galaxy")[0].value+'&system='+document.getElementsByName("system")[0].value+'&planet='+document.getElementsByName("planet")[0].value+'&planet_type='+document.getElementsByName("type")[0].value+'&lang='+Lang+'&kolo='+kolo, function(data) {
		if($.trim(data) == "OK") {
			document.getElementById('form').submit();
		} else {
			NotifyBox(data);
		}
	});
	return false;
}

function EditShortcuts(autoadd) {
	$(".shortcut-link").hide();
	$(".shortcut-edit:not(.shortcut-new)").show();
	if($('.shortcut-isset').length === 0)
		AddShortcuts();
}

function AddShortcuts() {
	var HTML	= $('.shortcut-new').clone().children();
	HTML.find('input, select').attr('name', function(i, old) {
		return old.replace("shortcut[]", "shortcut["+($('.shortcut-link').length)+"-new]");
	});
	HTML.addClass('shortcut-isset');
	
	if($('.shortcut-link').length >= 25)
		alert(fl_max_shortcuts);
	else
		$('#shortcut-data').append(HTML);
}

function SaveShortcuts(reedit) {		
	$.getJSON('game.php?page=fleetStep1&mode=saveShortcuts&ajax=1&'+$('.shortcut-row').find("input, select").serialize(), function(res) {
		$(".shortcut-link").show();
		$(".shortcut-edit").hide();		
		
		var deadElements = $(".shortcut-isset").filter(function() {
			return $('input[name*=name]', this).val() == "" ||
			$('input[name*=galaxy]', this).val() == "" || $('input[name*=galaxy]', this).val() == 0 ||
			$('input[name*=system]', this).val() == "" || $('input[name*=system]', this).val() == 0 ||
			$('input[name*=planet]', this).val() == "" || $('input[name*=planet]', this).val() == 0;
		});
		
		/*
		if(deadElements.length % 2 === 1) {
			deadElements.remove();
			$(".shortcut-colum:last").after('<td class="shortcut-colum" style="width:'+(shortCutRows*0.001)+'%">&nbsp;</td>');
		}
		*/
		
		//$(".shortcut-isset").unwrap();
		/*
		var activeElements	= Math.ceil($(".shortcut-isset").length / shortCutRows);
		
		if(activeElements === 0) {
			$('<tr style="height:20px;" class="shortcut-none"><td colspan="'+shortCutRows+'">'+fl_no_shortcuts+'</td></tr>').insertAfter('.shortcut tr:first');
		} else {
			for (var i = 1; i <= activeElements; i++) {
				$('<tr />').addClass('shortcut-row').insertAfter('.shortcut tr:first');
			}
			
			$(".shortcut-colum").each(function(i, val) {
				$(this).appendTo('tr.shortcut-row:eq('+Math.floor(i / 3)+')');
			});
			
			$('.shortcut-colum').filter(function() {
				return $(this).parent().is(':not(tr)')
			}).remove();
			
			$('.shortcut-row').filter(function() {
				return !$(this).children('.shortcut-isset').length;
			}).remove();
		*/
			$(".shortcut-isset > .shortcut-link").html(function() {
				if($(this).nextAll().find('input[name*=name]').val() === "") {
					$(this).parent().remove();//.html("&nbsp;");
					return false;
				}
				var Data	= $(this).nextAll();
				return '<a href="javascript:setTarget('+Data.find('input[name*=galaxy]').val()+','+Data.find('input[name*=system]').val()+','+Data.find('input[name*=planet]').val()+','+Data.find('select[name*=type]').val()+');updateVars();"> <span class="shortcut_link_kord">['+Data.find('input[name*=galaxy]').val()+':'+Data.find('input[name*=system]').val()+':'+Data.find('input[name*=planet]').val()+
				']</span> <span class="shortcut_link_name">('+Data.nextAll().find('select[name*=type] option:selected').text()[0]+') ' + Data.find('input[name*=name]').val() + '</a>';
			});
		//}
		
		//$('.shortcut-row:has(td:not(.shortcut-isset) + td)').remove();
		$('.shortcut-none').remove();
			
		if(typeof reedit === "undefinded" || reedit !== true) {
			NotifyBox(res);
		} else {
			if($(".shortcut-isset").length) {
				EditShortcuts();
			}
		}
	});
}

function DeleteGroopShips(GroopID, GroopName) {
	url = "?page=fleetTable&mode=delgroop&id="+GroopID;
	if(confirm(lng+'\"'+GroopName+'\"?'))
		window.location = url;
}

$(function() {
	$('.shortcut-delete').live('click', function() {
		$(this).prev().val('');
		$(this).parent().find('input');
		SaveShortcuts(true);
	});
});

$(function() {
	$('.countdots').keyup(function() {
		countDots();
		colorSet();
		fleetPoints();
	});
	$('form').submit(function() {
		DotsToCount();
	});
});
jQuery(document).ready(function(){
	countDots();
	fleetPoints();
});
function DotsToCount() {
	$('.countdots:visible').val(function(i, old) {
		return old.replace(/[^[0-9]|\.]/g, '');
	});
}
function countDots() {
	$('.countdots:visible').val(function(i, old) {
		return NumberGetHumanReadable(old.replace(/[^[0-9]|\.]/g, ''));
	});	
}
function colorSet() {
	$('.countdots:visible').each(function() {
		el_value	= $(this).val().replace(/[^[0-9]|\.]/g, '');
		el_name		= $(this).attr('name');
		el_amount	= document.getElementById(el_name+'_value').innerHTML.replace(/[^[0-9]|\.]/g, '');
		
		if(Number(el_value) > Number(el_amount)) {
			$(this).css({'background' : '#c34121'});
			$(this).css({'border-color' : '#f00'});
		}
		else {
			$(this).css({'background' : '#000'});
			$(this).css({'border-color' : '#001a40'});
		}
	});
}
function fleetPoints() {
	var pointsCost = 0;
	$('.countdots:visible').each(function() {
		el_count	= Number($(this).val().replace(/[^[0-9]|\.]/g, ''));
		el_name		= $(this).attr('name');
		pointsCost += (Number(pointsPrice[el_name]) * el_count);
	});
	$('.totalFleetPoints').text(NumberGetHumanReadable(Number(pointsCost)));
}

/*Filtrs*/
function filterPlanet(){
	if(!$('#filterPlanet').hasClass('fleettabme_btn_filtrs_activ'))
	{
        $('.imper_btn_filtrs').removeClass('fleettabme_btn_filtrs_activ');	
        $('#filterPlanet').addClass('fleettabme_btn_filtrs_activ');
		$('.FleetTableExpedition').hide();
		$('.FleetTableHostile').hide();
		$('.totalFleetPoints').text(0);
		$('.FleetTablePlanet').show();
	}
};
function filterExpedition(){
	if(!$('#filterExpedition').hasClass('fleettabme_btn_filtrs_activ'))
	{
        $('.imper_btn_filtrs').removeClass('fleettabme_btn_filtrs_activ');	
        $('#filterExpedition').addClass('fleettabme_btn_filtrs_activ');
		$('.FleetTablePlanet').hide();
		$('.FleetTableHostile').hide();
		$('.totalFleetPoints').text(0);
		$('.FleetTableExpedition').show();
	}
};
function FilterHostile(){
	if(!$('#FilterHostile').hasClass('fleettabme_btn_filtrs_activ'))
	{
        $('.imper_btn_filtrs').removeClass('fleettabme_btn_filtrs_activ');	
        $('#FilterHostile').addClass('fleettabme_btn_filtrs_activ');
		$('.FleetTablePlanet').hide();
		$('.FleetTableExpedition').hide();
		$('.totalFleetPoints').text(0);
		$('.FleetTableHostile').show();
	}
};