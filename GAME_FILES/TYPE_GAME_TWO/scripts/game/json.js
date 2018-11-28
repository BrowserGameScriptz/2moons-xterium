function AJAX()
{
  jQuery.post("./json.php", {'ataks': ataks, 'grab': grab, 'spio': spio, 'unic': unic, 'rakets': rakets, 'ajax': 1}, function(data)
    {
      var indicators = document.getElementById('indicators');
	  var beepataks = document.getElementById('beepataks');
      if(data !== null && data !== "undefined")
      {
        indicators.innerHTML = data.ICOFLEET;
		if(data.NEWMSG != "")
		{
			$('.new_email').show();
			$('#a_mesage .new_email').html(data.NEWMSG);
			$('#scroller .new_email').html('+' + data.NEWMSG);
		}
		else
		{
			$('.new_email').hide();
		}
		if(data.SOUNDATAKS){
			beepataks.play();
		}
		"undefined"!=typeof data.notification&&null!=data.notification&&$.each(data.notification,function(e,t){alertify.log(t.texte,t.type,1e3*parseInt(t.temps),t.image)});
		
		$('.fleet_indicators img').hide();
		//data.FLEET_NOT_OWNER.forEach(indicatorP);
		jQuery.each(data.FLEET_NOT_OWNER, function(i, val) {
			//$('.fleet_indicators img').show();	
			indicatorP(val);
			//$('#owerwiv').html($('#owerwiv').html() + '<br>' + print_r(val));
		});
		//$('#owerwiv').html(print_r(data.FLEET_NOT_OWNER));
		//$('.fleet_indicators img').show();
		
		ataks = data.ataks;
		grab = data.grab;
		spio = data.spio;
		unic = data.unic;
		rakets = data.rakets;
      }
    }, "json"
  );
}
function indicatorP(arrFleet) {
	$('#p' + arrFleet.fleet_end_id + 'm' + arrFleet.fleet_mission).show();
}
// Ð¿Ñ€Ð¾ÑÐ¼Ð¾Ñ‚Ñ€ ÑÐ¾Ð´ÐµÑ€Ð¶Ð°Ð½Ð¸Ñ Ð¼Ð°ÑÑÐ¸Ð²Ð°
function print_r(arr, level) {
    var print_red_text = "";
    if(!level) level = 0;
    var level_padding = "";
    for(var j=0; j<level+1; j++) level_padding += "    ";
    if(typeof(arr) == 'object') {
        for(var item in arr) {
            var value = arr[item];
            if(typeof(value) == 'object') {
                print_red_text += level_padding + "'" + item + "' :\n";
                print_red_text += print_r(value,level+1);
		} 
            else 
                print_red_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
        }
    } 

    else  print_red_text = "===>"+arr+"<===("+typeof(arr)+")";
    return print_red_text;
}

$(document).ready(function(){
	$(window).scroll(function () {if ($(this).scrollTop() > 100) {$('#scroller').fadeIn();} else {$('#scroller').fadeOut();}});
	$('#scroller').click(function () {$('body,html').animate({scrollTop: 0}, 400); return false;});
});