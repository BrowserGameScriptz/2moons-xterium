function arsenalSend(name)
{
	$('input[name=submitArsenal]').prop('disabled', true);
	$('#submitArsenal_'+name).attr('value', 'Please wait !');
	var count = $('input[name=count_'+name+']').val();
	var url = "game.php?page=arsenal"; // the script where you handle the form input.
	
	
    $.ajax({
		type: "POST",
		url: url,
        data: {mode:'send',greid:name,count:count,ajax:1},
        success: function(data)
		{
			alert(data);
			location.reload()
		}
	});
}