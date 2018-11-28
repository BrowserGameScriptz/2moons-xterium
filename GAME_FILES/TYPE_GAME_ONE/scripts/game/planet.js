function OpenBox(Key){
	var btn = $('#open_btn_'+Key)
	if(btn.text() == '+')
	{
		$('#box_'+Key).stop(true,false).slideDown(300);
		btn.text('-')
	}
	else
	{
		$('#box_'+Key).stop(true,false).slideUp(300);
		btn.text('+')
	}
}

function Fild()
{
	var Count	= $('#filds').val();
	var type	= $('#type').val();
	var kolvo	= $('#kolvo').val();
	var power	= $('#power').val();
	
	if(isNaN(Count) || Count < 0 ) {
		$('#filds').val(0);
		Count = 0;
	}
	
	var cost_i 	= 0;
	var cost 	= 0;
	
	for(var i = 0; i < Count; i++ )
	{
		cost_i 	= Math.round(type * Math.pow(power,Number(kolvo) + Number(i)));
		cost 	= Number(cost) + Number(cost_i);
	}
	
	$('#cost_filds').text(NumberGetHumanReadable(cost));
	cost	= 0; step 	= 0;	cost_i	= 0;
}

function TPort()
{
	var galaxy	= $('#galaxy').val();
	var system	= $('#system').val();
	var planet	= $('#planets').val();
	var galaxy1 = $('#galaxy1').val();
	var system1 = $('#system1').val();
	var planet1 = $('#planet1').val();
	
	if(isNaN(galaxy) || galaxy < 0 ) {
		$('#galaxy').val(1);
		galaxy = 1;
	}
	if(isNaN(system) || system < 0 ) {
		$('#system').val(1);
		system = 1;
	}
	if(isNaN(planet) || planet < 0 ) {
		$('#planets').val(1);
		planet = 1;
	}
	
	
	
	$('#cost_tp').text(NumberGetHumanReadable(1000 * Math.abs(system1 - system) + 15000 * Math.abs(galaxy1 - galaxy) + 2500 * Math.abs(planet1 - planet)));
}

function planetChangeImage(newName)
{
	if(confirm(imageCost))
	{
		$.get('game.php?page=planet', {'mode': 'planetImageSet', 'ImageName': newName, 'ajax': 1}, function(data) {
			window.location='game.php?page=planet&mode=planetImageCode&code='+data.code+'&coins='+data.coins;
		}, 'json');
	}
}

function checkcancel()
{
	if(!confirm(lng))
		return;
	
	if($('#password').val() == '') {
		return false;
	} else {
		$.getJSON('game.php?page=planet&mode=delete&password='+encodeURIComponent($('#password').val()), function(response){
			if(response.ok){
				parent.location.reload();
			}
		});
	}
}