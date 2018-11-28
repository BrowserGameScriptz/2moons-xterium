/*
Copyright (c) 2015 Bylancer
Developed by Dev Katriya
Date : 10/1/2015
*/

var windowFocus = true;
var username;
var chatHeartbeatCount = 0;
var minChatHeartbeat = 1000;
var maxChatHeartbeat = 33000;
var chatHeartbeatTime = minChatHeartbeat;
var originalTitle;
var blinkOrder = 0;
var audioogg = new Audio('audio/chat.ogg');
var audiomp3 = new Audio('audio/chat.mp3');

var chatboxFocus = new Array();
var newMessages = new Array();
var newMessagesWin = new Array();
var chatBoxes = new Array();



$(document).ready(function(){
	originalTitle = document.title;
	startChatSession();

	$([window, document]).blur(function(){
		windowFocus = false;
	}).focus(function(){
		windowFocus = true;
		document.title = originalTitle;
	});
});

var emoji = " :a :b :c :( :d :O :e :f :D :g :L :l :m :^ :* :v :) :# :p := :o :; :r ";

var emoticons = {
    ':a'  :  '<img src="emotions-fb/angel.png" title="angel" alt=":a" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':b'  :  '<img src="emotions-fb/apple.png" title="apple" alt=":b" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':c'  :  '<img src="emotions-fb/confused.png" title="confused" alt=":c" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':('  :  '<img src="emotions-fb/cry.png" title="cry" alt=":(" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':d'  :  '<img src="emotions-fb/devil.png" title="devil" alt=":d" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)" />',
    ':O'  :  '<img src="emotions-fb/gasp.png" title="gasp" alt=":O" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':e'  :  '<img src="emotions-fb/frown.png" title="frown" alt=":e" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':f'  :  '<img src="emotions-fb/glasses.png" title="glasses" alt=":f" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':D'  :  '<img src="emotions-fb/grin.png" title="grin" alt=":D" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':g'  :  '<img src="emotions-fb/grumpy.png" title="grumpy" alt=":g" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':L'  :  '<img src="emotions-fb/heart-beat.gif" title="heart-beat" alt=":L" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':l'  :  '<img src="emotions-fb/heart.png" title="heart-beat" alt=":l" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':m'  :  '<img src="emotions-fb/broken-heart.png" title="heart-beat" alt=":m" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':^'  :  '<img src="emotions-fb/kiki.png" title="kiki" alt=":^" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':*'  :  '<img src="emotions-fb/kiss.png" title="kiss" alt=":*" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':v'  :  '<img src="emotions-fb/pacman.png" title="pacman" alt=":v" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':)'  :  '<img src="emotions-fb/smile.png" title="smile" alt=":)" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':#'  :  '<img src="emotions-fb/squint.png" title="squint" alt=":#" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':p'  :  '<img src="emotions-fb/tongue.png" title="tongue" alt=":p" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':='  :  '<img src="emotions-fb/unsure.png" title="unsure" alt=":/" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':o'  :  '<img src="emotions-fb/upset.png" title="upset" alt=":o" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':;'  :  '<img src="emotions-fb/wink.png" title="Wink" alt=":;" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>',
    ':r'  :  '<img src="emotions-fb/rose.png" title="Rose" alt=":r" class="embtn" onclick="enableTxt(this)" href="javascript:void(0)"/>'
}

function Emotions (text,chatuser) {
    if (text == null || text == undefined || text == "") return;

    var pattern = /:-?[()*^#=;abcdDefghilLmoOprvz]/gi;
    return text.replace(pattern, function (match) {
        var rtr = typeof emoticons[match] != 'undefined' ? emoticons[match] : match;
        return emoticons[match].replace("embtn", 'embtn" cuser = "'+chatuser);
    });
}
function chatemoji(chatuser) {
    $(".target-emoji-"+chatuser).toggle( 'fast', function(){
    });
}
function enableTxt(event) {
    var client = $(event).attr("cuser");
    var prevMsg = $("#chatbox_"+client+" .chatboxtextarea").val();
    var emotiText = $(event).attr("alt");

    $("#chatbox_"+client+" .chatboxtextarea").val(prevMsg+' '+emotiText);
    $("#chatbox_"+client+" .chatboxtextarea").focus();
}



function restructureChatBoxes() {
	align = 0;
	for (x in chatBoxes) {
		chatboxtitle = chatBoxes[x];

		if ($("#chatbox_"+chatboxtitle).css('display') != 'none') {
			if (align == 0) {
				$("#chatbox_"+chatboxtitle).css('right', '230px');
			} else {
				width = (align)*(273+7)+230;
				$("#chatbox_"+chatboxtitle).css('right', width+'px');
			}
			align++;
		}
	}
}

function chatWith(chatuser,toid,img,status) {
	createChatBox(chatuser,toid,img,status);	
	$("#chatbox_"+chatuser+" .chatboxtextarea").focus();
}

function createChatBox(chatboxtitle,toid,img,status,minimizeChatBox) {
	if ($("#chatbox_"+chatboxtitle).length > 0) {
		if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
			$("#chatbox_"+chatboxtitle).css('display','block');
			restructureChatBoxes();
		}
		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
		return;
	}

    var emoji2 = Emotions (emoji,chatboxtitle);
/*<div class="emoji-panel-body target-emoji-'+chatboxtitle+'" style="display: none;"><div class="emoji-Recent">'+emoji2+'</div></div>*/

	$(" <div />" ).attr("id","chatbox_"+chatboxtitle)
	.addClass("chatbox active-chat")
	.attr("client",chatboxtitle)
	.html('<div class="box box-success direct-chat direct-chat-success chatboxhead" style="padding: 0px;"><div class="box-header with-border"><h3 class="box-title"><a href="profile.php?uname='+chatboxtitle+'"> '+chatboxtitle+'</a></h3>&nbsp;<span title="'+status+'" class="'+status+'"><i class="fa fa-circle" aria-hidden="true"></i></span><div class="box-tools pull-right"><a onclick="javascript:toggleChatBoxGrowth(\''+chatboxtitle+'\')" href="javascript:void(0)" data-widget="collapse" class="btn-box-tool"><i class="fa fa-minus-circle chtfw text-20" aria-hidden="true"></i></a><a onclick="javascript:closeChatBox(\''+chatboxtitle+'\')" href="javascript:void(0)" data-widget="remove" class="btn-box-tool"><i class="fa fa-times-circle chtfw text-20" aria-hidden="true"></i></a></div></div></div><div class="chatboxcontent direct-chat-success" id="resultchat_'+chatboxtitle+'"></div><div class="uiContextualLayerPositioner _53ii uiLayer"><div class="uiContextualLayer uiContextualLayerAboveLeft target-emoji-'+chatboxtitle+'" style="display: none; bottom: 0px;"><div class="_5v-0 _53ik"><div class="_53ij"><div class="_4pi8"><div class="_4pi9"><div class="dze"><div class="uiScrollableAreaWrap scrollable"><div class="uiScrollableAreaBody"><div class="uiScrollableAreaContent"><!--773 --><div class="emoji-panel-body"><div class="emoji-Recent">'+emoji2+'</div></div></div></div></div></div></div></div></div><i class="_53io"></i></div></div></div><div class="chatboxinput"><a onclick="javascript:chatemoji(\''+chatboxtitle+'\')" href="javascript:void(0)" class="write-smiley"></a><div class="write-link attach"><img class="loadmsg" id="loadmsg_'+chatboxtitle+'" src="img/chatloading.gif"><input id="imageInput" type="file" name="file" onChange="uploadimage(\''+chatboxtitle+'\');"/></div><textarea class="chatboxtextarea" id="textarea" onkeypress="javascript:return updateLastTypedTime();" onkeyup="javascript:return refreshTypingStatus('+chatboxtitle+'\',\''+toid+'\');" onkeydown="javascript:return checkChatBoxInputKey(event,this,\''+chatboxtitle+'\',\''+toid+'\',\''+img+'\');"></textarea><input id="to_id" name="to_id" value="'+toid+'" type="hidden"><input id="to_uname" name="to_uname" value="'+chatboxtitle+'" type="hidden"><input id="from_uname" name="from_uname" value="Beenny" type="hidden"></div>')
	.appendTo($( "body" ));
	
	//$("#resultchat_"+chatboxtitle).scrollTop($("#resultchat_"+chatboxtitle)[0].scrollHeight);
	
	var scrollcode = $("#resultchat_"+chatboxtitle).scroll(function(){
		if ($("#resultchat_"+chatboxtitle).scrollTop() == 0){
	
			var client = $("#chatbox_"+chatboxtitle).attr("client");
	
			if($("#chatbox_"+client+" .pagenum:first").val() != $("#chatbox_"+client+" .total-page").val()) {
	
				$("#loader").show();
				var pagenum = parseInt($("#chatbox_"+client+" .pagenum:first").val()) + 1;
	
				var URL = "chat.php?page="+pagenum+"&action=get_all_msg&client="+client;
	
				get_all_msg(URL);
	
				$("#loader").hide();									// Hide loader on success
	
				if(pagenum != $("#chatbox_"+client+" .total-page").val()) {
					setTimeout(function () {										//Simulate server delay;
	
						$("#resultchat_"+chatboxtitle).scrollTop(100);							// Reset scroll
					}, 458);
				}
			}
	
		}
	});
	   
	
	$('<script type="text/javascript">scrollcode</' + 'script>').appendTo(document.body);

	get_all_msg("chat.php?page=1&action=get_all_msg&client="+chatboxtitle);
	$("#chatbox_"+chatboxtitle).css('bottom', '0px');
	
	chatBoxeslength = 0;
	for (x in chatBoxes) {
		if ($("#chatbox_"+chatBoxes[x]).css('display') != 'none') {
			chatBoxeslength++;
		}
	}

	if (chatBoxeslength == 0) {
		$("#chatbox_"+chatboxtitle).css('right', '230px');
	} else {
		width = (chatBoxeslength)*(273+7)+230;
		$("#chatbox_"+chatboxtitle).css('right', width+'px');
	}
	
	chatBoxes.push(chatboxtitle);

	if (minimizeChatBox == 1) {
		minimizedChatBoxes = new Array();

		if ($.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
		}
		minimize = 0;
		for (j=0;j<minimizedChatBoxes.length;j++) {
			if (minimizedChatBoxes[j] == chatboxtitle) {
				minimize = 1;
			}
		}

		if (minimize == 1) {
			$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
			$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
		}
	}

	chatboxFocus[chatboxtitle] = false;

	$("#chatbox_"+chatboxtitle+" .chatboxtextarea").blur(function(){
		chatboxFocus[chatboxtitle] = false;
		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").removeClass('chatboxtextareaselected');
	}).focus(function(){
		chatboxFocus[chatboxtitle] = true;
		newMessages[chatboxtitle] = false;
		$('#chatbox_'+chatboxtitle+' .chatboxhead').removeClass('chatboxblink');
		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").addClass('chatboxtextareaselected');
	});

	/*$("#chatbox_"+chatboxtitle).click(function() {
		if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') != 'none') {
			$("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
		}
	});*/

	$("#chatbox_"+chatboxtitle).show();
	
}

function chatHeartbeat(){
	
	var itemsfound = 0;
	if (windowFocus == false) {
 
		var blinkNumber = 0;
		var titleChanged = 0;
		for (x in newMessagesWin) {
			if (newMessagesWin[x] == true) {
				++blinkNumber;
				if (blinkNumber >= blinkOrder) {
					document.title = x+' says...';
					titleChanged = 1;
					break;	
				}
			}
		}
		
		if (titleChanged == 0) {
			document.title = originalTitle;
			blinkOrder = 0;
		} else {
			++blinkOrder;
		}

	} else {
		for (x in newMessagesWin) {
			newMessagesWin[x] = false;
		}
	}

	for (x in newMessages) {
		if (newMessages[x] == true) {
			if (chatboxFocus[x] == false) {
				//FIXME: add toggle all or none policy, otherwise it looks funny
				$('#chatbox_'+x+' .chatboxhead').toggleClass('chatboxblink');
            }
		}
	}
	
	$.ajax({
	  url: "chat.php?action=chatheartbeat",
	  cache: false,
	  dataType: "json",
	  success: function(data) {

		$.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug

				chatboxtitle = item.f;
				toid = item.x;
				img = item.p2;
				status = item.st;
                msgtype = item.mtype;

				if ($("#chatbox_"+chatboxtitle).length <= 0) {
					createChatBox(chatboxtitle,toid,img,status);
					//get_all_msg(chatboxtitle);
					audiomp3.play();
					audioogg.play();
				}
				if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
					$("#chatbox_"+chatboxtitle).css('display','block');
					restructureChatBoxes();
				}

				if (item.s == 1) {
					item.f = username;
				}

                var message_content = item.m;
                if (msgtype=="text")
                    message_content = item.m;
                else if (msgtype=="file") {

                    var str = item.m;
                    str = str.replace(/&quot;/g, '"');
                    var file_content = JSON.parse(str);
                    var message_content="";

                    if (file_content.file_type == "image")
                        message_content = "<a url='"+file_content.file_path+"' onclick='trigq(this)'><img src='http://www.byweb.online/zechat/storage/user_files/small"+file_content.file_name+"' style='max-width:156px;padding: 4px 0 4px 0; border-radius: 7px;cursor: pointer;'/></a>";
                    else
                        message_content = "<a href='"+file_content.file_path+"'>Download : "+file_content.file_name+"</a>";

                }

				if (item.s == 2) {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><div class="_5w-5"><div class="_5w-6"><abbr class="livetimestamp">'+item.m+'</abbr></div></div></div>');
				} else {
                    message_content = Emotions (message_content,chatboxtitle);   // Set imotions
					newMessages[chatboxtitle] = true;
					newMessagesWin[chatboxtitle] = true;
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+item.f+'</span></div><img class="direct-chat-img" src="storage/user_image/'+item.p+'" alt="message user image"><span class="direct-chat-text">'+message_content+'</span></div>');
					audiomp3.play();
					audioogg.play();
				}


				itemsfound += 1;
			}
		});

		chatHeartbeatCount++;

		if (itemsfound > 0) {
			chatHeartbeatTime = minChatHeartbeat;
			chatHeartbeatCount = 1;
		} else if (chatHeartbeatCount >= 10) {
			chatHeartbeatTime *= 2;
			chatHeartbeatCount = 1;
			if (chatHeartbeatTime > maxChatHeartbeat) {
				chatHeartbeatTime = maxChatHeartbeat;
			}
		}
          if (itemsfound > 0) {
              $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
          }
	}});
    setTimeout('chatHeartbeat();',chatHeartbeatTime);

}

function get_all_msg(url){

	$.ajax({
	  //url: "chat.php?action=get_all_msg&client="+client,
	  url: url,
	  cache: false,
	  dataType: "json",
	  success: function(data) {

		$.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug

				chatboxtitle = item.f;
				toid = item.x;
				img = item.p;
				status = item.st;
				sender = item.sender;
				page = item.page;
                pages = item.pages;
                msgtype = item.mtype;

				/*if ($("#chatbox_"+chatboxtitle).length <= 0) {
					createChatBox(chatboxtitle,toid,img,status,1);
				}*/

                if (item.page != "" && i == 0) {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").prepend('<input type="hidden" class="pagenum" value="'+item.page+'" /><input type="hidden" class="total-page" value="'+pages+'" />');
				}

				if (item.s == 1) {
					//item.f = username;
				}

                var message_content = item.m;
                if (msgtype=="text")
                    message_content = item.m;
                else if (msgtype=="file") {

                    var str = item.m;
                    str = str.replace(/&quot;/g, '"');
                    var file_content = JSON.parse(str);
                    var message_content="";
                    /*onclick='lightpopup(event,this);'*/
                    if (file_content.file_type == "image")
                        message_content = "<a url='"+file_content.file_path+"' onclick='trigq(this)'><img src='http://www.byweb.online/zechat/storage/user_files/small"+file_content.file_name+"' style='max-width:156px;padding: 4px 0 4px 0; border-radius: 7px;cursor: pointer;'/></a>";
                    else
                        message_content = "<a href='"+file_content.file_path+"'>Download : "+file_content.file_name+"</a>";

                }

				if (item.s == 2) {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").prepend('<div class="chatboxmessage"><div class="_5w-5"><div class="_5w-6"><abbr class="livetimestamp">'+item.m+'</abbr></div></div></div>');
				} else {

                    message_content = Emotions (message_content,chatboxtitle);   // Set imotions
					if (item.u == 2) {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").prepend('<div class="chatboxmessage direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+item.sender+'</span></div><img class="direct-chat-img" src="storage/user_image/'+img+'" alt="message user image"><span class="direct-chat-text">'+message_content+'</span></div>');
					} else {
						$("#chatbox_"+chatboxtitle+" .chatboxcontent").prepend('<div class="chatboxmessage direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+item.sender+'</span></div><img class="direct-chat-img" src="storage/user_image/'+img+'" alt="message user image"><span class="direct-chat-text">'+message_content+'</span></div>');
					}
				}
			}
		});

          if (page == 1) {
              $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
          }

          /*for (i=0;i<chatBoxes.length;i++) {
			chatboxtitle = chatBoxes[i];
			$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
			setTimeout('$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug
          }*/

	}});
	
	
}

function closeChatBox(chatboxtitle) {
    $('#chatbox_'+chatboxtitle).css('display','none');
    restructureChatBoxes();

    $.post("chat.php?action=closechat", { chatbox: chatboxtitle} , function(data){
    });

}

function toggleChatBoxGrowth(chatboxtitle) {
	
    if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') == 'none') {
		var minimizedChatBoxes = new Array();

        if ($.cookie('chatbox_minimized')) {
            minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
        }

        var newCookie = '';

        for (i=0;i<minimizedChatBoxes.length;i++) {
            if (minimizedChatBoxes[i] != chatboxtitle) {
                newCookie += chatboxtitle+'|';
            }
        }

        newCookie = newCookie.slice(0, -1)


        $.cookie('chatbox_minimized', newCookie);
        $('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','block');
        $('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','block');
        $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
    } else {
		var newCookie = chatboxtitle;

		if ($.cookie('chatbox_minimized')) {
			newCookie += '|'+$.cookie('chatbox_minimized');
		}


		$.cookie('chatbox_minimized',newCookie);
		$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
		$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
    }

}

function checkChatBoxInputKey(event,chatboxtextarea,chatboxtitle,toid,img) {

    if(event.keyCode == 13 && event.shiftKey == 0)  {
        message = $(chatboxtextarea).val();
        message = message.replace(/^\s+|\s+$/g,"");


        $(chatboxtextarea).val('');
        $(chatboxtextarea).focus();
        $(chatboxtextarea).css('height','24px');
        if (message != '') {
            $.post("chat.php?action=sendchat", {to: chatboxtitle, toid: toid, message: message} , function(data){
                message = message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");

                var $con = message;
                var $words = $con.split(' ');
                for (i in $words) {
                    if ($words[i].indexOf('http://') == 0 || $words[i].indexOf('https://') == 0) {
                        $words[i] = '<a href="' + $words[i] + '">' + $words[i] + '</a>';
                    }
                    else if ($words[i].indexOf('www') == 0 ) {
                        $words[i] = '<a href="' + $words[i] + '">' + $words[i] + '</a>';
                    }
                }
                message = $words.join(' ');
                message = Emotions (message);   // Set imotions
                $("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+username+'</span></div><img class="direct-chat-img" src="storage/user_image/'+img+'" alt="message user image"><span class="direct-chat-text">'+message+'</span></div>');
                $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
            });
        }
        chatHeartbeatTime = minChatHeartbeat;
        chatHeartbeatCount = 1;

        return false;
    }

    var adjustedHeight = chatboxtextarea.clientHeight;
    var maxHeight = 94;

    if (maxHeight > adjustedHeight) {
        adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
        if (maxHeight)
            adjustedHeight = Math.min(maxHeight, adjustedHeight);
        if (adjustedHeight > chatboxtextarea.clientHeight)
            $(chatboxtextarea).css('height',adjustedHeight+8 +'px');
    } else {
        $(chatboxtextarea).css('overflow','auto');
    }

}

function startChatSession(){
    $.ajax({
        url: "chat.php?action=startchatsession",
        cache: false,
        dataType: "json",
        success: function(data) {

            username = data.username;

            $.each(data.items, function(i,item){
                if (item)	{ // fix strange ie bug

                    chatboxtitle = item.f;
                    toid = item.x;
                    //img = item.spic;
                    img = item.p2;
                    status = item.st;

                    if ($("#chatbox_"+chatboxtitle).length <= 0) {
                        createChatBox(chatboxtitle,toid,img,status,1);
                    }

                    if (item.s == 1) {
                        item.f = username;
                    }

                    if (item.s == 2) {
                        //$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><div class="_5w-5"><div class="_5w-6"><abbr class="livetimestamp">'+item.m+'</abbr></div></div></div>');
                    } else {

                        if (item.u == 2) {
                            //$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">'+item.f+'</span></div><img class="direct-chat-img" src="storage/user_image/'+item.p+'" alt="message user image"><span class="direct-chat-text">'+item.m+'</span></div>');
                        } else {
                            //$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+item.f+'</span></div><img class="direct-chat-img" src="storage/user_image/'+img+'" alt="message user image"><span class="direct-chat-text">'+item.m+'</span></div>');
                        }
                    }
                }
            });

            for (i=0;i<chatBoxes.length;i++) {
                chatboxtitle = chatBoxes[i];
                $("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
                setTimeout('$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug

            }

            setTimeout('chatHeartbeat();',chatHeartbeatTime);
    }});
}

/**
 * Cookie plugin
 *
 * Copyright (c) 2015 Dev Katariya (Bylancer.com)

 *
 */

jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

var lastTypedTime = new Date(0); // it's 01/01/1970, actually some time in the past
var typingDelayMillis = 5000; // how long user can "think about his spelling" before we show "No one is typing -blank space." message

function refreshTypingStatus(chatboxtitle,toid){
	if (!$('#textarea').is(':focus') || $('#textarea').val() == '' || new Date().getTime() - lastTypedTime.getTime() > typingDelayMillis) {
        $("#typing_on").html('');
    } else {
        //$("#typing_on").html('User is typing...');
		$.post("chat.php?action=typingstatus", {to: chatboxtitle, toid: toid, typing: 1} , function(data){
			
		});	
    }
}
function updateLastTypedTime() {
    lastTypedTime = new Date();
}
//setInterval(refreshTypingStatus, 100);

