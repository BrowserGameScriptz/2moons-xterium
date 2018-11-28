function SettingsSet()
{
	vacation = document.getElementById('vacationID').checked;
	protection = document.getElementById('protectionId').checked;
	protection2 = document.getElementById('protectionId').disabled;
	if(vacation == true && !confirm(lngsetting)) 
		return false;
	else if(protection == true && protection2 == false && !confirm(lngsetting2)) 
		return false;
	else
		document.getElementById('form').submit();
	return false;
}

function SoundTest(selected)
{
	document.getElementById('beepataks').volume = selected/10;
	beepataks.play();
}

function cancelProtection()
{
	if(!confirm(lngsettingcance)) 
		return false;
	else {
		$.getJSON('game.php?page=settings&mode=cancelProtection', function(response){
			if(response.ok){
				parent.location.reload();
			}
		});
	}
}