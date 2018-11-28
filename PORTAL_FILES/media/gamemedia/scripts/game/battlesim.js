function add(){
	$("#form").attr('action', 'game.php?page=battleSimulator&action=moreslots');
	$("#form").attr('method', 'POST');
	$("#form").submit();
	return true;
}

$(function() {
	$("#tabs").tabs();

	var $tabs = $('#tabs').tabs({
		tabTemplate: '<li><a href="#{href}">#{label}</a></li>',
	});
});

function check(){
	$('#form input[type=text]').val(function(i, old) {
		return old.replace(/[^[0-9]|\.]/g, '');
	});
	var kb = window.open('about:blank', 'kb', 'scrollbars=yes,statusbar=no,toolbar=no,location=no,directories=no,resizable=no,menubar=no,width='+screen.width+',height='+screen.height+', screenX=0, screenY=0, top=0, left=0');
	$("#submit:visible").removeAttr('style').hide().fadeOut();
	$("#wait:hidden").removeAttr('style').hide().fadeIn();
	$.post('game.php?page=battleSimulator&mode=send', $('#form').serialize(), function(data){
		try{ 
			data	= $.parseJSON(data);
			kb.focus();
			kb.location.href = 'CombatReport.php?raport='+data;
		} catch(e) {
			kb.window.close();
			Dialog.alert(data);
		}
	});
	
	setTimeout(function(){$("#submit:hidden").removeAttr('style').hide().fadeIn();}, 10000);
	setTimeout(function(){$("#wait:visible").removeAttr('style').hide().fadeOut();}, 10000);
	return true;
}

$(function() {
	$("#tabs").tabs();

	var $tabs = $('#tabs').tabs({
		tabTemplate: '<li><a href="#{href}">#{label}</a></li>',
	});
	
	$('.reset').live('click', function(e) {
		e.preventDefault();
	
		var index = $(this).parent().index()+1;
		
		
		$(this).parent().parent().nextAll().each(function() {
			$(this).children('td:eq('+(index)+')').children().val(0);
		});
		fleetAttPoints();
		fleetDefPoints();
		return false;
	});
	
	$('#form input[type=text]').keyup(function() {
		$('#form input[type=text]').val(function(i, old) {
			return NumberGetHumanReadable(old.replace(/[^[0-9]|\.]/g, ''));
		});		
	});
	$('#form').submit(function() {
		$('#form input[type=text]').val(function(i, old) {
			return old.replace(/[^[0-9]|\.]/g, '');
		});
	});
	$('.fleetAttCountBS').keyup(function() {
		fleetAttPoints();
	});
	$('.fleetDefCountBS').keyup(function() {
		fleetDefPoints();
	});
});
jQuery(document).ready(function(){
	$('#form input[type=text]').val(function(i, old) {
		return NumberGetHumanReadable(old.replace(/[^[0-9]|\.]/g, ''));
	});
	fleetAttPoints();
	fleetDefPoints();
});
function fleetAttPoints() {
	var pointsCost = 0;
	$('.fleetAttCountBS').each(function() {
		el_count	= Number($(this).val().replace(/[^[0-9]|\.]/g, ''));
		el_name		= $(this).attr('name');
		pointsCost += (Number(pointsPrice[el_name]) * el_count);
	});
	$('.totalAttPoints').text(NumberGetHumanReadable(Number(pointsCost)));
}
function fleetDefPoints() {
	var pointsCost = 0;
	$('.fleetDefCountBS').each(function() {
		el_count	= Number($(this).val().replace(/[^[0-9]|\.]/g, ''));
		el_name		= $(this).attr('name');
		pointsCost += (Number(pointsPrice[el_name]) * el_count);
	});
	$('.totalDefPoints').text(NumberGetHumanReadable(Number(pointsCost)));
}
function acsLoadTool(){
	var e = document.getElementById("loadId");
	var strMsg = e.options[e.selectedIndex].value;
	$.getJSON('game.php?page=battleSimulator&mode=acsLoadTool&msgId='+strMsg, function(data) {
		if($.trim(data.error) == "OK") {
			var $tabs = $('#tabs').tabs();
			var selected = $tabs.tabs('option', 'active'); // => 0 
			test = data.msg;
			commas = test.split(';').length;
			commas1 = test.split(';');
			for (i = 0; i < commas; i++) {
				commas2 = commas1[i].split(',');
				$("#acsLoad"+selected+"-"+commas2[0]).val(commas2[1]);
				console.log("#acsLoad"+selected+"-"+commas2[0]+"-"+commas2[1]);
			} 
		} else {
			alert(data.msg);
		}
	});
	return false;
}

function NotifyBoxAcs(text) {
	tip = $('#tooltip')
	tip.html(text).css({
		top : 200,
		left : (($(window).width() - $('#leftmenu').width()) / 2 - tip.outerWidth() / 2) + $('#leftmenu').width(),
		padding: '20px'
	}).show();
	window.setTimeout(function(){tip.fadeOut(3000)}, 500);
}
function DotsToCount() {
	$('.countdots').val(function(i, old) {
		return old.replace(/[^[0-9]|\.]/g, '');
	});
}

function missileSend() {
	var form = $('form');
	var submit = $('submit');
	DotsToCount();
	$.ajax({
      url: 'game.php?page=battleSimulator&mode=missilesimSend',
      type: 'POST',
      cache: false,
      data: form.serialize(), //form serizlize data
      beforeSend: function(){
        // change submit button value text and disabled it
        submit.val('Submitting...').attr('disabled', 'disabled');
      },
      success: function(data){
        // Append with fadeIn see http://stackoverflow.com/a/978731
		data = JSON.parse(data);
		$.each(data, function(index, value) {
			
		  var NormalValue1 = NumberGetHumanReadable(value.destroy);
		  var NormalValue2 = NumberGetHumanReadable(value.lostMetal);
		  var NormalValue3 = NumberGetHumanReadable(value.lostCrystal);
		  var NormalValue4 = NumberGetHumanReadable(value.lostDeut);
		  if(value.destroy > 1000000000000)
			NormalValue1 = shortly_number(value.destroy);
		  if(value.lostMetal > 1000000000000)
			NormalValue2 = shortly_number(value.lostMetal);
		  if(value.lostCrystal > 1000000000000)
			NormalValue3 = shortly_number(value.lostCrystal);
		  if(value.lostDeut > 1000000000000)
			NormalValue4 = shortly_number(value.lostDeut);
		
		  document.getElementById('unitlost_'+index).innerHTML  = (NormalValue1);
		  document.getElementById('metalLost_'+index).innerHTML  = (NormalValue2);
		  document.getElementById('crystalLost_'+index).innerHTML  = (NormalValue3);
		  document.getElementById('deuteriumLost_'+index).innerHTML  = (NormalValue4);
		});

        // reset form and button
        //form.trigger('reset');
        submit.val('Calculate').removeAttr('disabled');
      },
      error: function(e){
       alert('error');
      }
    });
}