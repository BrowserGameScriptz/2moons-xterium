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

    emoji = Emotions (emoji);
    var emojiDiv = '<div class="emoji-panel-body target-emoji" style="display: none;"><div class="emoji-Recent">'+emoji+'</div></div>';

    $("#right").append(emojiDiv);
    scrollDown();
});

function scrollDown(){
	var wtf    = $('#resultchat');
    var height = wtf[0].scrollHeight;
    wtf.scrollTop(height);
}

var emoji = " :a :b :c :( :d :O :e :f :D :g :L :l :m :^ :* :v :) :# :p := :o :; :r ";
var emoticons = {
    ':a'  :  '<img src="emotions-fb/angel.png" title="angel" alt=":a" class="embtn"/>',
    ':b'  :  '<img src="emotions-fb/apple.png" title="apple" alt=":b" class="embtn"/>',
    ':c'  :  '<img src="emotions-fb/confused.png" title="confused" alt=":c" class="embtn"/>',
    ':('  :  '<img src="emotions-fb/cry.png" title="cry" alt=":(" class="embtn"/>',
    ':d'  :  '<img src="emotions-fb/devil.png" title="devil" alt=":d" class="embtn" />',
    ':O'  :  '<img src="emotions-fb/gasp.png" title="gasp" alt=":O" class="embtn"/>',
    ':e'  :  '<img src="emotions-fb/frown.png" title="frown" alt=":e" class="embtn"/>',
    ':f'  :  '<img src="emotions-fb/glasses.png" title="glasses" alt=":f" class="embtn"/>',
    ':D'  :  '<img src="emotions-fb/grin.png" title="grin" alt=":D" class="embtn"/>',
    ':g'  :  '<img src="emotions-fb/grumpy.png" title="grumpy" alt=":g" class="embtn"/>',
    ':L'  :  '<img src="emotions-fb/heart-beat.gif" title="heart-beat" alt=":L" class="embtn"/>',
    ':l'  :  '<img src="emotions-fb/heart.png" title="heart-beat" alt=":l" class="embtn"/>',
    ':m'  :  '<img src="emotions-fb/broken-heart.png" title="heart-beat" alt=":m" class="embtn"/>',
    ':^'  :  '<img src="emotions-fb/kiki.png" title="kiki" alt=":^" class="embtn"/>',
    ':*'  :  '<img src="emotions-fb/kiss.png" title="kiss" alt=":*" class="embtn"/>',
    ':v'  :  '<img src="emotions-fb/pacman.png" title="pacman" alt=":v" class="embtn"/>',
    ':)'  :  '<img src="emotions-fb/smile.png" title="smile" alt=":)" class="embtn"/>',
    ':#'  :  '<img src="emotions-fb/squint.png" title="squint" alt=":#" class="embtn"/>',
    ':p'  :  '<img src="emotions-fb/tongue.png" title="tongue" alt=":p" class="embtn"/>',
    ':='  :  '<img src="emotions-fb/unsure.png" title="unsure" alt=":=" class="embtn"/>',
    ':o'  :  '<img src="emotions-fb/upset.png" title="upset" alt=":o" class="embtn"/>',
    ':;'  :  '<img src="emotions-fb/wink.png" title="Wink" alt=":;" class="embtn"/>',
    ':r'  :  '<img src="emotions-fb/rose.png" title="Rose" alt=":r" class="embtn"/>'
}

function Emotions (text) {

    if (text == null || text == undefined || text == "") return;
    var pattern = /:-?[()*^#=;abcdDefghilLmoOprvz]/gi;
    return text.replace(pattern, function (match) {
        return typeof emoticons[match] != 'undefined' ?
            emoticons[match] :
            match;
    });
}

function chatWith(chatuser,toid,img,status) {

    scrollDown();

	createChatBox(chatuser,toid,img,status);

}

function restructureChatBoxes() {
    align = 0;
    
    for (x in chatBoxes) {
        chatboxtitle = chatBoxes[x];

        if ($("#chatbox_"+chatboxtitle).css('display') != 'none') {
            if (align == 0) {
                //$("#chatbox_"+chatboxtitle).css('right', '300px');
            } else {
                width = (align)*(273+7)+300;
                //$("#chatbox_"+chatboxtitle).css('right', width+'px');
            }
            align++;
        }
    }
}

function createChatBox(chatboxtitle,toid,img,status,minimizeChatBox) {

    if ($("#chatbox_"+chatboxtitle).length > 0) {


		if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {

            $("#chatbox_"+chatboxtitle).css('display','block');

            restructureChatBoxes();
			
        }
		
		$(".chatboxtextarea").focus();
        return;
    }


    $(" <div />" ).attr("id","chatbox_"+chatboxtitle)
        .addClass("chat chatboxcontent active-chat")
        .attr("data-chat","person_"+toid)
        .attr("client",chatboxtitle)
        .html('<form id="f" action="post.php"><div class="write"><a onclick="javascript:chatemoji()" href="javascript:void(0)" class="write-smiley" id="toggle-emoji"></a><textarea name="chattxt" class="chatboxtextarea" onkeydown="javascript:return checkChatBoxInputKey(event,this,\''+chatboxtitle+'\',\''+toid+'\',\''+img+'\');"/></textarea><a href="javascript:;"><div class="write-link attach"><input id="imageInput" type="file" name="file" onChange="uploadimage(\''+chatboxtitle+'\');"/></div></a><span class="hidecontent"></span></div></form>')
        .appendTo($( "#resultchat" ));


    get_all_msg("chat.php?page=1&action=get_all_msg&client="+chatboxtitle);

	chatBoxeslength = 0;

	for (x in chatBoxes) {
		if ($("#chatbox_"+chatBoxes[x]).css('display') != 'none') {
			chatBoxeslength++;
		}
	}

	if (chatBoxeslength == 0) {

	} else {
		width = (chatBoxeslength)*(273+7)+300;

	}
	
	chatBoxes.push(chatboxtitle);

	chatboxFocus[chatboxtitle] = false;

	$("#chatbox_"+chatboxtitle+" .chatboxtextarea").blur(function(){
		chatboxFocus[chatboxtitle] = false;
		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").removeClass('chatboxtextareaselected');
	}).focus(function(){
		chatboxFocus[chatboxtitle] = true;
		newMessages[chatboxtitle] = false;
        //alert("Remove Blink");
        $('#chatbox_'+chatboxtitle+' .chatboxhead').removeClass('chatboxblink');
		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").addClass('chatboxtextareaselected');
	});

    $("#chatbox_"+chatboxtitle).show();

}

function get_all_msg(url){

	$.ajax({
	    url: url,
	    cache: false,
	    dataType: "json",
	    success: function(data) {

        //username = data.username;

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
                message_content = item.m;
                //alert(message_content);

				if (item.page != "" && i == 0) {
					$("#chatbox_"+chatboxtitle).prepend('<input type="hidden" class="pagenum" value="'+item.page+'" /><input type="hidden" class="total-page" value="'+pages+'" />');
                }
				
				if (item.s == 1) {

				}

				if (item.s == 2) {
					$("#chatbox_"+chatboxtitle).prepend('<div class="conversation-start"><span>'+item.m+'</span></div>');
				} else {

                    var message_content = item.m;
                    if (msgtype=="text")
                        message_content = item.m;
                    else if (msgtype=="file") {

                        var str = item.m;
                        str = str.replace(/&quot;/g, '"');
                        var file_content = JSON.parse(str);
                        var message_content="";

                        if (file_content.file_type == "image")
                             message_content = "<a url='"+file_content.file_path+"' onclick='trigq(this)'><img src='http://www.byweb.online/zechat/storage/user_files/small"+file_content.file_name+"'  style='max-width:250px;min-height:100px;max-height: 150px;cursor: pointer;'/></a>";
                        else
                            message_content = "<a href='"+file_content.file_path+"'>Download : "+file_content.file_name+"</a>";

                    }
                    message_content = Emotions(message_content);

                    if (item.u == 2) {
                        $("#chatbox_"+chatboxtitle).prepend('<div class="bubble you">'+message_content+'</div>');
					} else {
                        $("#chatbox_"+chatboxtitle).prepend('<div class="bubble me">'+message_content+'</div>');
					}
				}

			}
			
		});

          if (page == 1) {
              scrollDown();
          }
		
	}});

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
                    img = item.p2;
                    status = item.st;

                    if ($("#chatbox_"+chatboxtitle).length <= 0) {

                        //createChatBox(chatboxtitle,toid,img,status,1);
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


        }});

    setTimeout('chatHeartbeat();',chatHeartbeatTime);
    scrollDown();
}

function checkChatBoxInputKey(event,chatboxtextarea,chatboxtitle,toid,img,send) {

    if((event.keyCode == 13 && event.shiftKey == 0) || (send == 1))  {
        //alert(send);
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
                $("#chatbox_"+chatboxtitle).append('<div class="bubble me">'+message+'</div>');

                scrollDown();
            });
        }
        chatHeartbeatTime = minChatHeartbeat;
        chatHeartbeatCount = 1;

        return false;
    }

	var adjustedHeight = chatboxtextarea.clientHeight;
	var maxHeight = 40;

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
                //alert("blink"+x);
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
					//createChatBox(chatboxtitle,toid,img,status);
					//get_all_msg(chatboxtitle);
					audiomp3.play();
					audioogg.play();
				}
				if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
					//$("#chatbox_"+chatboxtitle).css('display','block');
					//restructureChatBoxes();
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
                        message_content = "<a url='"+file_content.file_path+"' onclick='trigq(this)'><img src='http://www.byweb.online/zechat/storage/user_files/small"+file_content.file_name+"' style='max-width:250px;min-height:100px;max-height: 150px;cursor: pointer;'/></a>";
                    else
                        message_content = "<a href='"+file_content.file_path+"'>Download : "+file_content.file_name+"</a>";

                }

				if (item.s == 2) {
					$("#chatbox_"+chatboxtitle).append('<div class="conversation-start"><span>'+item.m+'</span></div>');
				} else {
                    message = Emotions (message);   // Set imotions
					newMessages[chatboxtitle] = true;
					newMessagesWin[chatboxtitle] = true;
					$("#chatbox_"+chatboxtitle).append('<div class="bubble you">'+message_content+'</div>');
					audiomp3.play();
					audioogg.play();
				}

				$("#chatbox_"+chatboxtitle).scrollTop($("#chatbox_"+chatboxtitle)[0].scrollHeight);
				var wtf    = $('#resultchat');
				var height = wtf[0].scrollHeight;
				wtf.scrollTop(height);
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
		
		setTimeout('chatHeartbeat();',chatHeartbeatTime);
	}});
}

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



