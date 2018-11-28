Message	= {
	MessID : 0,

	MessageCount: function() {
		if(Message.MessID == 100) {
			$('#unread_0').text('0');
			$('#unread_1').text('0');
			$('#unread_2').text('0');
			$('#unread_3').text('0');
			$('#unread_4').text('0');
			$('#unread_5').text('0');
			$('#unread_15').text('0');
			$('#unread_99').text('0');
			$('#unread_100').text('0');
			$('#newmes').text('');
		} else {
			var count = parseInt($('#unread_'+Message.MessID).text());
			var lmnew = parseInt($('#newmesnum').text());
				
			$('#unread_'+Message.MessID).text('0');
			if(Message.MessID != 999) {
				$('#unread_100').text($('#unread_100').text() - count);
			}
			
			if(lmnew - count <= 0)
				$('#newmes').text('');
			else
				$('#newmesnum').text(lmnew - count);
		}
	},

	getMessages: function (MessID, page, Important) {
		if (typeof page === "undefined") {
			page = 1;
		}
		if (typeof Important === "undefined") {
			Important = 0;
		}
		Message.MessID	= MessID;
		Message.MessageCount(MessID);
		
		$('#loading').show();
		
		$.get('game.php?page=messages&mode=view&messcat='+MessID+'&site='+page+'&important='+Important+'&ajax=1', function(data) {
			$('#loading').hide();
			$('#messagestable').remove();
			$('#content table:eq(0)').after(data);
		});
	},

	stripHTML: function (string) { 
		return string.replace(/<(.|\n)*?>/g, ''); 
	},

	CreateAnswer: function (Answer) {
		var Answer	= Message.stripHTML(Answer);
		if(Answer.substr(0, 3) == "Re:") {
			return 'Re[2]:'+Answer.substr(3);
		} else if(Answer.substr(0, 3) == "Re[") {
			var re = Answer.replace(/Re\[(\d+)\]:.*/, '$1');
			return 'Re['+(parseInt(re)+1)+']:'+Answer.substr(5+parseInt(re.length))
		} else {
			return 'Re:'+Answer
		}
	},
	
	getMessagesIDs: function(Infos) {
		var IDs = [];
		$.each(Infos, function(index, mess) {
			if(mess.value == 'on')
				IDs.push(mess.name.replace(/delmes\[(\d+)\]/, '$1'));
		});	
		return IDs;
	}
}

function SRTF(RaportID)
{
	var Name	= $('#upgrade_name').val();
	
	ally = '';
	if(Name == 'ally')
		ally = 'ally';
	
	$.post("game.php?page=messages", {'mode': 'SpyRaportToFreind', 'RaportID': RaportID, 'FriendID': Name, 'ally': ally, 'ajax': 1}, function(data)
	{
		$('.ally_contents').text(data);
		setTimeout(function(){ parent.$.fancybox.close();}, 2000);
	}, "json");
}
$(function () {

    $('.box li').click(function (e) {
        e.preventDefault();
        $(this).closest('li').addClass('active').siblings().removeClass('active');

    });

});
//$('submit').attr('disabled','disabled');
//parent.$.fancybox.close();


