function checkCoordinates()
{
	$.getJSON('game.php?page=mercenary&mode=checkcoordinates&galaxy='+$('#target_galaxy').val()+'&system='+$('#target_system').val()+'&planet='+$('#target_planet').val(), function(response){
		$('#textErrorCheck').html(response.message);
		if(!response.error) {
			$('#bigPicture').hide();
			$('#targetInfo').show();
		}else {
			$('#bigPicture').show();
			$('#targetInfo').hide();
		}
	});
}