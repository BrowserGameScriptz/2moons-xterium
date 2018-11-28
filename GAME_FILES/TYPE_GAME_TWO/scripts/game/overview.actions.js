$(function() {
	$('#tabs').tabs();
});

function checkrename()
{
	if($.trim($('#name').val()) == '') {
		return false;
	} else {
		$.getJSON('game.php?page=planet&mode=rename&name='+$('#name').val(), function(response){
			alert(response.message);
			if(!response.error) {
				parent.location.reload();
			}
		});
	}
}

function GenerateName()
{		
	$.getJSON('game.php?page=planet&mode=GenerateName', function(response){
		$('#name').val(response.message);
	});
}
