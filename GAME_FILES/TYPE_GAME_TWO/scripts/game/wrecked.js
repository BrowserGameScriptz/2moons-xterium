function startWreck(wreckID)
{
	$.getJSON('game.php?page=dock&mode=startWreck&wreckID='+ wreckID, function(response){
		alert(response.message);
		if(response.ok){
			parent.location.reload();
		}
	});
}

function deleteWreck(wreckID)
{
	if(!confirm(lngWreckComfirm))
		return;
	
	$.getJSON('game.php?page=dock&mode=deleteWreck&wreckID='+ wreckID, function(response){
		alert(response.message);
		if(response.ok){
			parent.location.reload();
		}
	});
}

function repairWreck(wreckID)
{
	$.getJSON('game.php?page=dock&mode=repairWreck&wreckID='+ wreckID, function(response){
		alert(response.message);
		if(response.ok){
			parent.location.reload();
		}
	});
}

function instantWreck(wreckID)
{
	
	if(!confirm('Instant repair will cost '+ priceInstant +' dark matter. Only fleets in yellow are repaired'))
		return;
	
	$.getJSON('game.php?page=dock&mode=instantWreck&wreckID='+ wreckID, function(response){
		alert(response.message);
		if(response.ok){
			parent.location.reload();
		}
	});
}