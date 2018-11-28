function updateSend(name)
{
	$('button[name=sendButton]').prop('disabled', true);
	$('#sendButton').text('Please wait !');
	var count = $('input[name=levelUpgrade]').val();
	var url = "game.php?page=Fullcontroll"; // the script where you handle the form input.
	
	
   $.ajax({
		type: "POST",
		url: url,
        data: {mode:'send',count:count,productId:productId,ajaxReq:1},
        success: function(data)
		{
			alert(data);
			location.reload()
		}
	});
}