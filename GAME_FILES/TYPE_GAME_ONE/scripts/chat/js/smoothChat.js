$(function(){
	var path='';
	var a=navigator.userAgent.toLowerCase();
	$.browser.chrome=/chrome/.test(navigator.userAgent.toLowerCase());
	if($.browser.msie){
		$('body').addClass('browserIE');
		$('body').addClass('browserIE'+$.browser.version.substring(0,1))
	}
	if($.browser.chrome){
		$('body').addClass('browserChrome');
		a=a.substring(a.indexOf('chrome/')+7);
		a=a.substring(0,1);
		$('body').addClass('browserChrome'+a);
		$.browser.safari=false
	}
	if($.browser.safari){
		$('body').addClass('browserSafari');
		a=a.substring(a.indexOf('version/')+8);
		a=a.substring(0,1);
		$('body').addClass('browserSafari'+a)
	}
	if($.browser.mozilla){
		if(navigator.userAgent.toLowerCase().indexOf('firefox')!=-1){
			$('body').addClass('browserFirefox');
			a=a.substring(a.indexOf('firefox/')+8);
			a=a.substring(0,1);
			$('body').addClass('browserFirefox'+a)
		}else{
			$('body').addClass('browserMozilla')
		}
	}
	if($.browser.opera){
		$('body').addClass('browserOpera')
	};
	Chat.resetPos();
	Chat.getInfo(path);
	Chat.updateTime();
	$('#onlineUsers').slimScroll({
		height: '200px',
		//size: '8px',
		alwaysVisible: true
	})

	$('.onlineUsers').live('click',function(e){
		e.preventDefault();
		var elem=$(this);
		var w=$('#chatTab>ul').children('li').length;
		var max=Tab.getMaxTabShown();
		if(w>max){
			$('#scrollLeft').show();
			$('#nextT').show();
			Chat.prepareChatHtml(elem,path,'oneTabThroughClick');
		}else{
			Chat.prepareChatHtml(elem,path,'oneTabThroughClick');
		}
	})

	$('.onlineUsersCTR').live('click',function(){
		var elem=$(this).find('a');
		var w=$('#chatTab>ul').children('li').length;
		var max=Tab.getMaxTabShown();
		if(w>max){
			$('#scrollLeft').show();
			$('#nextT').show();
			Chat.prepareChatHtml(elem,path,'oneTabThroughClick');
		}else{
			Chat.prepareChatHtml(elem,path,'oneTabThroughClick');
		}
	});

	$('#nextT').live('click',function(){
		Tab.scrollTabs('r');
		if($(this).hasClass('blink')){
			TabHelper.removeBlink('next');
		}
		Tab.collapseTab();
	});
	$('#prevT').live('click',function(){
		Tab.scrollTabs('l');
		if($(this).hasClass('blink')){
			TabHelper.removeBlink('prev');
		}
		Tab.collapseTab();
	});
	$('#scrollRight').live('click',function(){
		Tab.calculateTabs();
		Tab.scrollToPos(Chat.marginRight,'prev');
		var right=$('#tabsLeftP').text();
		var left=$('#tabsLeftN').text();
		var nbr=parseInt(right)+parseInt(left);
		$('#tabsLeftP').text('0');
		$('#tabsLeftN').text(nbr);
	});
	$('#scrollLeft').live('click',function(){
		Tab.calculateTabs();
		var right=$('#tabsLeftP').text();
		var left=$('#tabsLeftN').text();
		left=parseInt(left);
		if(left==0){return false;}
		var pos=parseInt($('#chatTab').css('right').split('px')[0]);
		pos=pos-left*Chat.tabWidth;
		Tab.scrollToPos(pos,'next');
		var nbr=parseInt(right)+left;
		$('#tabsLeftP').text(nbr);
		$('#tabsLeftN').text('0');
	});

$('#stg').live('click',function(){
	var oldStat=Chat.getStatue(path);
	var chatStg=$("#chatStg");
	var friendsDiv=$("#frdDiv");
	if(!chatStg.hasClass("displayed")){
		if(friendsDiv.hasClass("displayed")){
			friendsDiv.hide();
			friendsDiv.toggleClass("displayed");
			$("#friends").toggleClass("active");
		}
		chatStg.show();
		chatStg.toggleClass("displayed");
		$("#stg").toggleClass("active");
	}else{
		chatStg.hide();
		chatStg.toggleClass("displayed");
		$("#stg").toggleClass("active");
	}
})

$('#friends').live('click',function(e){
	var friendsDiv=$("#frdDiv");
	var chatStg=$("#chatStg");
	if(!friendsDiv.hasClass("displayed")){
		if(chatStg.hasClass("displayed")){
			chatStg.hide();
			chatStg.toggleClass("displayed");
			$("#stg").toggleClass("active");
		}
		friendsDiv.show();
		friendsDiv.toggleClass("displayed");
		$("#friends").toggleClass("active");
	}else{
		if(!$(e.target).is('.friendsType')){
			friendsDiv.hide();
			friendsDiv.toggleClass("displayed");
			$("#friends").toggleClass("active");
		}
	}
})
$('.friendsType').live('click',function(){
	var elem=$(this);
	var id=elem.attr('id');
	var ctr=$('#onlineUsers');
	ctr.html('<img src="'+path+'img/loading_blue.gif" class="usersLoading" >');
	$.post(path+'chatProcess.php',{'frds':id},function(d){
		ctr.html(d);
		$('.friendsType').removeClass('activeStatus');
		$("#"+id).addClass('activeStatus');
	});
})

	$('#chatStg>ul li:last-child').live('click',function(){
		var id=$(this).attr('id');
		var newId,text;
		switch(id){
			case'soundMute':
				newId='sound';
				text='<span class="icon"></span>Enable sound';
			break;
			case'sound':
				newId='soundMute';
				text='<span class="icon"></span>Disable sound';
			break;
		}
		$(this).attr({'id':newId});
		$(this).html(text);
		var expire=Cookie.returnExpiration(7);
		Cookie.set('s',newId,expire);
	});

	$('.dld').live('click',function(){
		var id=$(this).parent().parent().attr('id').split('chat-')[1];
		if (id != null && id != undefined && id != ''){
	    	$('<form action="'+path+'include/export.php?r='+id +'" method="post"></form>').appendTo('body').submit().remove();
	    }
	    return false;  
	});


	$('#languages li').live('click',function(){
		var id=$(this).attr('id');
		$('#languages li').removeClass('nativeLanguage');
		$(this).addClass('nativeLanguage');
		var expire=Cookie.returnExpiration(15);
		Cookie.set('l',id,expire);  
	});

	$('.translateThis').live('click',function(){
		var messageContainer=$(this).parent('.toTrans');
		var img=$(this);
		var lang=Cookie.get('l');
		if(lang=='' || lang==undefined){
			lang='en';
		}
		messageContainer.css({color:"#bbb"});
		img.attr({'src':'img/snake.gif','title':"Translating..."});
		var text=messageContainer.text();
		//check if acceestoken is older than 10mins if so do request a new one
		$.post(path+'chatProcess.php',{'translate':1,t:lang,tx:text},function(d){
			if (d!="e") { //if no error
				messageContainer.text(d);
				messageContainer.css({color:"#4C4C4C"});
			}else{
				messageContainer.css({color:"#444"});
				img.attr({'src':'img/oups.png','title':"An error has occured while translating!, do you want to try again ?"});
			}
		});
	});

	$('.chatStatue').live('click',function(){
		var statue=$(this).attr('id');
		var oldStat=$('#chatStg .activeStatus').attr('id');
		$.post(path+'chatProcess.php',{'s':statue},function(d){
			switch(d){
				case's':
					switch(statue){
						case's0':
							Chat.setDisplay(0,path);Chat.makeOffline(path);
						break;
						case's1':
						// case's2':
						// case's3':
							statue=statue.split('s')[1];
							Chat.setDisplay(statue,path);
							if(oldStat=='s0'){
								Chat.makeOnline();
								$('.chat').each(function(){
									var id=$(this).attr('id');
									id=id.split('chat-');
									id=id[1];
									Chat.localCheck(id,'y','def',path);
								})
							}
						break;
					}
					break;
				case'f':
					alert('failed to change the chat statue');
				break;
			}
		})
	});

	$('#loginForm').live('submit',function(e){
		e.preventDefault();
		Auth.login(path);
		$('#login:focus').blur();
	});

	$('#lgt').live('click',function(){
		Auth.logout(path);
	});

});


var Chat={
	localCheckPerOpenTab:new Array(),
	scrollable:'y',
	oldChatStatue:'notDefined',
	marginRight:158,
	tabWidth:122,
	initMarginRight:82,
	marginLeft:100,
	checkTyping:false,
	typingFuncRunning:false,
	typingUID:0,
	uTyping:false,
	tempo:1,
	resetPos:function(){
		$('#chatTab').css({'right':Chat.initMarginRight+'px'});
		setTimeout(function(){$('#prevT').removeClass('blink');},5000);
	},
	prepareChatHtml:function(elem,path,tabNbr){
		var u_id=$(elem).attr('data-uid');
		var u_nick=$(elem).attr('data-unk');
		var tabs=$('#chat-'+u_id).length;
		if(tabs!=0){
			$('.chat:not(#chat-'+u_id+')').hide();
			$('.chat:not(#chat-'+u_id+')').parent().addClass('hiddenTab');
			$('#chat-'+u_id).toggle();
			$('#subTab-'+u_id).toggleClass('hiddenTab');
			$('#subTab-'+u_id).toggleClass('active');
			return false;
		}
		jQuery.fn.isChildOf=function(b){return(elem.parents(b).length>0);};
		Chat.createChatHtml(u_id,u_nick,path,tabNbr);
	},
	// check if m typing & store that
	isTyping:function (path) {
		if (Chat.checkTyping && Chat.typingFuncRunning && Chat.uTyping) { // save my status as writing if only im online and typing
			$.post(path+'chatProcess.php',{'uid':Chat.typingUID});
		}
		setTimeout(function(){Chat.isTyping(path);},3000);
	},
	createChatHtml:function(u_id,u_nick,path,tabNbr){
		var disabled='';
		var statue=Chat.getStatue(path);
		var shortNick=u_nick.substring(0,8);
		if($.trim(shortNick)==u_nick){
			shortNick=u_nick;
		}else{
			shortNick=shortNick+'...';
		}
		if(statue==0){
			disabled='disabled="disabled"';
		}
		// refresh case ! ( for live case see chat.class.php "show_tabs()" )
		var chat='<div id="chat-'+u_id+'" class="chat"><div class="chatHeader"><b>'+u_nick+'</b><img src="'+path+'img/save.png" class="dld" alt="download" title="Download the conversation to your desktop" /></div><div style="clear:both;"></div><div id="chatBox-'+u_id+'" class="chatBox"><div id="displayBox-'+u_id+'" class="displayBox"><div id="temporary-'+u_id+'"></div><div id="spy-'+u_id+'" class="chatSpy"></div></div><div id="errorBox-'+u_id+'" class="errorBox"></div><div id="sayBox-'+u_id+'" class="sayBox"><textarea '+disabled+' id="say-'+u_id+'" class="say" type="text" /></textarea><div id="smilies-'+u_id+'" class="smilies"><ul><li class="Sconfused" alt=":s"></li><li class="Scry" alt=";("></li><li class="Sevil" alt="3:("></li><li class="Slaugh" alt="xD"></li><li class="Slol" alt=":D"></li><li class="Smad" alt=":@"></li><li class="Sneutral" alt=":|"></li><li class="Srazz" alt=":p"></li><li class="Sredface" alt="^//^"></li><li class="Srolleyes" alt="D_D"></li><li class="Ssad" alt=":("></li><li class="Sshocked" alt="o_o"></li><li class="Ssmile" alt=":)"></li><li class="Ssurprised" alt=":o"></li><li class="Stwisted" alt="3x)"></li><li class="Swink" alt=";)"></li><li class="Scool" alt="8)"></li></ul></div><div id="openSmilies-'+u_id+'" class="smileyFolder"></div></div></div></div>';
		$('<li id="subTab-'+u_id+'" class="hiddenTab" >'+shortNick+' <span id="close-'+u_id+'" class="icon close"></span></li>').appendTo("#chatTab>ul");
		var max=Tab.getMaxTabShown();
		Chat.typingUID=u_id;
		if (!Chat.typingFuncRunning) {
			Chat.typingFuncRunning=true;
			Chat.isTyping(path);
		}
		$(chat).appendTo('#subTab-'+u_id).each(function(){
			if(tabNbr!='oneTabThroughClick'){
				var openTab=Cookie.get('oT');
				if(openTab===undefined){
					openTab=0;
				}
				if(openTab==u_id){
					var elem=$('#chat-'+openTab);
					elem.show();
					elem.parent().addClass('active').removeClass('hiddenTab');
				}
			}else if(tabNbr=='oneTabThroughClick'){
				var elem=$('#chat-'+u_id);
				var gElem=$('.chat');
				gElem.hide();
				gElem.parent().addClass('hiddenTab').removeClass('active');
				elem.show();
				elem.parent().addClass('active').removeClass('hiddenTab');
				Cookie.set('oT',u_id);
			}
			var chat_id=$(this).attr('id');
			if(statue==0){
				$('#say-'+u_id).hide(400);
				$('#errorBox-'+u_id).text('You are offline, go online to chat !').show(400);
				$('#errorBox-'+u_id).append('<img id="go_online-'+u_id+'" src="'+path+'img/left.png" alt=">" title="Go online" />');
			}
			Chat.initChat(chat_id,u_id,path);
			var childs=$('#chatTab>ul').children('li').length;
			if(childs>max){
				TabHelper.showScrollers();
				var nbr=$('#tabsLeftN').text();
				nbr=parseInt(nbr)+1;
				$('#tabsLeftN').text(nbr);
				Tab.collapseTab();
			}
		});
	},
	updateTime:function(tzo){
		$('abbr.chatTime').updateChatTime(tzo);
		setTimeout(function(){Chat.updateTime(tzo);},Vars.updateTimeFreq)
	},
	makeOffline:function(path){
		$('.say').each(function(){
			$(this).hide();
		});
		$('.errorBox').each(function(){
			$(this).text('You are offline, go online to chat !').show();

		});
		$('.sayBox').hide();
		$('.errorBox').each(function(){
			var id=$(this).attr('id');
			id=id.split('-');
			id=id[1];
			$(this).append('<img id="go_online-'+id+'" src="'+path+'img/left.png" alt=">" title="Go online" />');
		});
		$('.loading').each(function(){
			$(this).hide()});
	},
	makeOnline:function(){
		$('.errorBox').each(function(){
			$(this).hide()
		});
		$('.sayBox').show();
		$('.say').each(function(){
			$(this).show().removeAttr('disabled');
		});
		$('.loading').each(function(){
			$(this).show()});
	},
	getStatue:function(path){
		var toReturn;
		var chat=$.find('#chatTab');
		if(chat!=''){
			$('.chatStatue').each(function(){
				var id=$(this).attr('id');
				var isIt=$(this).hasClass('activeStatus');
				if(isIt){toReturn=id;}
				
			})
		if(toReturn!==undefined){
			toReturn=toReturn.split('s');
			toReturn=toReturn[1];
			return toReturn;
		}else{
			$.post(path+'chatProcess.php',{'stg':1},function(d){
				Chat.setDisplay(d,path);
			});
		}}
	},


	setDisplay:function(stat,path){
		$('#stg .activeStatus').each(function(){
			$(this).removeClass('activeStatus');
		});
		if (stat=="0") {
			Chat.checkTyping=false;
			Chat.typingFuncRunning=false;
		}else{
			Chat.checkTyping=true;
		};
		$('#s'+stat).addClass('activeStatus');
	},


	getInfo:function(path){	
		var chat=$.find('#chatTab');
		if(chat!=''){
			$.post('chatProcess.php',{'stg':1},function(d){
				switch(d){
					case'0':
					case'f':
					Chat.setDisplay(0,path);
					//Chat.controle(0,path);
					Tab.getOpenTabs(0,path);
					Chat.cronix(path);
					break;
					default:
					Chat.setDisplay(d,path);
					//Chat.controle(d,path);
					Tab.getOpenTabs(d,path);
					Chat.cronix(path);
					break;	
				}
			});
		
		}	
	},
			
	localCheck:function(ref,old,flush,path){
		var chatBox=$.find('#chatBox-'+ref);
		if(chatBox!=''){
			var chatStatue=Chat.getStatue(path);
			var nick=$('#chat-'+ref).children('div .chatHeader').text();
			var infoBox=$('#errorBox-'+ref);
			var lastChatter=$('#displayBox-'+ref).children('.chatMsg:last-child').children('.msgHeader').children('.chatName').children('a').attr('title');
			if(lastChatter==undefined){lastChatter='';}
			var dispBox=$('#displayBox-'+ref);
			if(chatStatue==0){
				--Chat.localCheckPerOpenTab[ref];
				var checkedB4;
				if(lastChatter==''){
					Chat.makeOffline(path);
					checkedB4='n';
				}else{checkedB4='y';}
				switch(flush){
					case'def':
						return false;
					break;
					case'alt':
					default:
						setTimeout(function(){Chat.localCheck(ref,checkedB4,'alt',path);++Chat.localCheckPerOpenTab[ref];},Vars.delay);
					break;
				}
				return false;
			}
			if(Chat.localCheckPerOpenTab[ref]>=1){
				--Chat.localCheckPerOpenTab[ref];
				return false;
			};
			if(lastChatter==''&&old=='n'){
				$('#temporary-'+ref).append('<span class="loading"> History is loading <img src="'+path+'img/loading_blue.gif" />  <br /><br /></span>');
			}
			$.post(path+'chatProcess.php',{'check':1,'old':old,'lc':lastChatter,'r':ref,'t':Chat.uTyping},function(d){
				if(lastChatter==''){
					infoBox.css('background','#f6c4c4').hide();
					$('#say-'+ref).removeAttr('disabled').show();
					$('#displayBox-'+ref+' .loading').remove();
				}
				switch(d){
					case'f':
						$('#say-'+ref).attr('disabled','disabled').hide();
						infoBox.text('Unable to connect to the chat server, please try again later !').show();
					break;
					case'net':
						$('#say-'+ref).attr('disabled','disabled').hide();
						infoBox.text('Your internet connection seems to be down !').show();
					break;
					case'offline':
						$('#say-'+ref).attr('disabled','disabled').hide();
						infoBox.text(nick+' is offline !').show();
						$('#sayBox-'+ref).hide();
					break;
					case'meoff':
						$('#say-'+ref).attr('disabled','disabled').hide();
						infoBox.text('You are offline !').show();
						Chat.oldChatStatue='';
					break;
					case'away':
						// d=$.evalJSON(d);
						// var length=d.length;
						// var index=length-1;
						// if(Chat.oldChatStatue!=d[index]){
						// 	$('#say-'+ref).attr('disabled','disabled').hide();
						// 	infoBox.html(nick+' is Away ! <img src="'+path+'/img/ok.png" id="okButt" />').show();
						// }
					break;
					case'busy':
						// d=$.evalJSON(d);
						// var length=d.length;
						// var index=length-1;
						// if(Chat.oldChatStatue!=d[index]){
						// 	$('#say-'+ref).attr('disabled','disabled').hide();
						// 	infoBox.html(nick+' is Busy  <img src="'+path+'/img/ok.png" id="okButt" />').show();
						// }
					break;
					case'mess':
						$('#say-'+ref).attr('disabled','disabled').hide();
						infoBox.text('This user isn\'t valid,if you see this please report this issue !').show();
					break;
					default:
						var spyDiv=$('#spy-'+ref);
						if(d=="t"){
							spyDiv.text(nick+' is Typing...').show();
							$('#chat-'+ref).addClass("typing");
							setTimeout(function(){Chat.localCheck(ref,'y','def',path);},Vars.delay);
							return false;
						}
						spyDiv.hide();
						$('#chat-'+ref).removeClass("typing");

						if(d!="" && d!=null){
							d=$.evalJSON(d);
						}
						var infoBoxTxt=infoBox.text();
						if(infoBoxTxt==nick+' is offline !'){
							infoBox.css('background','#dbf6c4').text(nick+' is back online !');
							setTimeout(function(){infoBox.hide();$('#say-'+ref).removeAttr('disabled').show();infoBox.css('background','#f6c4c4');$('.sayBox').show();},2000);
						}else if(infoBoxTxt=='Your internet connection seems to be down !'){
							infoBox.hide();
							$('#say-'+ref).removeAttr('disabled').show();
						}
						var length=d.length;
						if(Chat.tempo){
							$('#temporary-'+ref).remove();Chat.tempo=0;
						}
						if(d!=''&&d!=null){
							$('#displayBox-'+ref).hide();
							for(var i=1;i<length;i++){
								var lastMsg=$('#displayBox-'+ref).children('.chatMsg:last-child').children('.msgBody');
								if(i%2==1){
									j=i+1;
									if(d[j].indexOf("<img class=\"smiley\"")>=0){
										d[j]=d[j].replace(/<img class="smiley" src="/g,'<img class="smiley" src="'+path+'');
									}
									if(d[i]=='p'){
										lastMsg.append(d[j]);
									}else if(d[i]=='pn'){
										$('#displayBox-'+ref).append(d[j]);
									}
								}
								var lastSender=$('#displayBox-'+ref+' .chatMsg:last-child').children('.msgHeader').children('.chatName').children('a').attr('title');
								var headerTitle=$('#chat-'+ref+' .chatHeader').text();
								if(i==length-1 && (lastSender===headerTitle)){
									var blinkExpire=1;
									var ts=$('#displayBox-'+ref+' .chatMsg:last-child').children('.msgHeader').children('.msgTime').children('abbr').attr('data-ts');
									var D=new Date;
									var gmt=D.toGMTString();
									var now=Date.parse(gmt)/1000;
									var dd=(now-ts)/60;
									if($('#subTab-'+ref).hasClass('hiddenTab') && dd<blinkExpire){
										TabHelper.blinkIt(ref,0);
										TabHelper.shouldItBlink(ref,0);
									}
								}
							}
							$('#displayBox-'+ref).show();
							$('#displayBox-'+ref).scrollTop(99999);
						}else{
							if(old=='n'){
								$('#displayBox-'+ref).prepend('<span class="loading">No history was found !</span>');
								setTimeout(function(){$('#displayBox-'+ref+' .loading').remove();},3000);
							}
						}
					break;
				}
				$('#okButt').live('click',function(){
 					$('#say-'+ref).removeAttr('disabled').show();
 					infoBox.hide();
				});
					// related to away n busy
				setTimeout(function(){Chat.localCheck(ref,'y','def',path);},Vars.delay);
			});
		}else{return false;}
	},
	globalCheck:function(chatStatue,path){
		var elements='';
		var tabStr='';
		var subTab='.appendTo("#chatTab>ul");';
		$('.chat').each(function(){
			tabStr+=$(this).attr('id');
		})
		tabArr=tabStr.split('chat-');
		chatStatue=Chat.getStatue(path);
		if(chatStatue==1){
			$.post(path+'chatProcess.php',{'gCheck':1,'t':tabArr},function(d){
				if(d!=""){
					d=$.evalJSON(d);
				}
				if(d.length>0){
					var sdrs=d[0];
					var tabs=d[1];
					var chat=d[2];
					for(var i=0;i<tabs.length;i++){
						var u_id=sdrs[i];
						eval(tabs[i]+subTab);
						$(chat[i]).appendTo('#subTab-'+sdrs[i]).show().each(function(){
							var chat_id=$(this).attr('id');
							Chat.initChat(chat_id,u_id,path); 
							TabHelper.playSound(path);
							$('#displayBox-'+u_id).scrollTop(99999);
							(i==tabs.length-1)?($('.chat:not(#chat-'+u_id+')').hide()):null;
						});
					}
					Chat.notifyMe(tabs.length);
				}
				setTimeout(function(){Chat.globalCheck(1,path);},Vars.gDelay);
			});
		}else{
				setTimeout(function(){Chat.globalCheck(0,path);},Vars.gDelay);
			}
	},
	say:function(ref,path,sVal,oldMsg){
		var lastChatter=$('#displayBox-'+ref).children('.chatMsg:last-child').find('.chatName').children('a').attr('title');
		var lastMsg=$('#displayBox-'+ref).children('.chatMsg:last-child').children('.msgBody');
		var infoBox=$('#errorBox-'+ref);
		var sayBox=$('#say-'+ref);
		var tempoContainer=$('#displayBox-'+ref);
		if(Chat.tempo){
			lastMsg=$('#temporary-'+ref).children('.chatMsg:last-child').children('.msgBody');
			lastChatter=$('#temporary-'+ref).children('.chatMsg:last-child').find('.chatName').children('a').attr('title');
			tempoContainer=$('#temporary-'+ref);
		}
		if(!$.browser.msie){
			Chat.tempoSay(sVal,ref,lastChatter,lastMsg,tempoContainer,path);
		}else{
			sayBox.hide();
			infoBox.css({'background':'#e9e9e9'}).html(' <img class="sendinIE" src="'+path+'img/sendin.gif"/> Sending... ').show();
		}
		$.post(path+'chatProcess.php',{'say':sVal,'o':oldMsg,'lc':lastChatter,'r':ref},function(d){
			switch(d){
				case'f':
					infoBox.text('Your message couldn\'t be sent !').show();
					sayBox.hide();
					setTimeout(function(){infoBox.hide();sayBox.show();},2000);
				break;
				case'repeat':
				var sayDiv=$('#sayBox-'+ref);
					sayDiv.hide();
					infoBox.text('You said that already !').show();
					setTimeout(function(){infoBox.hide();sayDiv.show();},2000);
				break;
				default:
				d=$.evalJSON(d);
					d[1]=d[1].replace(/<img class="smiley" src="/,'<img class="smiley" src="'+path+'');
					if(d[1]!='' && d[1]!=null){
						if(!$.browser.msie){
							sVal=Chat.escRegExpChars(sVal);
							sVal=Chat.encodeHtmlSpecialChars(sVal);
							if(d[0]=='m'){
								var pattern=new RegExp('<img class="sendin" src="'+path+'img/sendin.gif">'+sVal);
								$('.beingSent').each(function(){
									$(this).html($(this).html().replace(pattern,d[1]));
									if(!$(this).children('img').hasClass('sendin')){
										$(this).removeAttr('class').next().remove();
									}
								});
								oldMsg=d[1];
							}else if(d[0]=='n'){
								var msgData=d[1].split('<div class="msgBody">');
								var hdr=msgData[0];
								var body=msgData[1].split('</div></div>')[0];
								var pat=new RegExp('<span class="beingSent"><img class="sendin" src="'+path+'img/sendin.gif">'+sVal+'</span><br>');
								tempoContainer.html(tempoContainer.html().replace(/<div class="me chatMsg"><div class="msgHeader"><span class="chatName"><a href="#" title="me">Me<\/a><\/span><span class="msgTime">few seconds ago<\/span><\/div>/,hdr));
								tempoContainer.html(tempoContainer.html().replace(pat,body));
							}
						}else{
							sayBox.show();
							infoBox.hide().css({'background':'#f6c4c4'});
							if(d[0]=='m'){
								lastMsg.append(d[1]);
								oldMsg=d[1];
							}else if(d[0]=='n'){
								tempoContainer.append(d[1]);
							}
							$('#displayBox-'+ref).scrollTop(99999);
							sayBox.attr('value','').focus();
						}
						Chat.uTyping=false; // im done typing
					}
				break;
			}
		})
	},
	tempoSay:function(sVal,ref,lastChatter,lastMsg,tempoContainer,path){
		var tempoMsg=sVal;
		tempoMsg='<img class="sendin" src="'+path+'img/sendin.gif"/>'+tempoMsg.replace(/</g,'&lt;');
		var reciever=$.trim($('#chat-'+ref+' .chatHeader').text());
		var msgStructure;
		switch(lastChatter){
			case reciever:
			case undefined:
			case '':
				msgStructure='<div class="me chatMsg"><div class="msgHeader"><span class="chatName"><a href="#" title="me">Me</a></span><span class="msgTime">few seconds ago</span></div><div class="msgBody"><span class="beingSent">'+tempoMsg+'</span><br /></div></div>';
				tempoContainer.append(msgStructure);
			break;
			default:
				msgStructure='<span class="beingSent">'+tempoMsg+'</span><br />';
				lastMsg.append(msgStructure);
			break;
		}
		$('#displayBox-'+ref).scrollTop(99999);
		$('#say-'+ref).attr('value','');
		Chat.uTyping=false; // im done typing
	},
	escRegExpChars:function(sVal){
		sVal=sVal.replace(/(\\)/g,"@#x\\$1_@");
		var chars=['^','$','.','*','+','?','=','!',':','|','/','(',')','[',']','{','}'];
		for(var i=0;i<chars.length;i++){
			pat=new RegExp("(\\"+chars[i]+")","g");
			sVal=sVal.replace(pat,"\\$1");
		}
		sVal=sVal.replace(/(@#x\\\\_@)/g,"\\\\");
		return sVal;
	},
	encodeHtmlSpecialChars:function(sVal){
		sVal=sVal.replace(/&/g,"&amp;");
		sVal=sVal.replace(/</g,"&lt;");
		sVal=sVal.replace(/>/g,"&gt;");
		return sVal;
	},

	initChat:function(chat_id,u_id,path){
		jQuery.fn.isChildOf=function(b){return(this.parents(b).length>0);};
		var infoBox=$('#errorBox-'+u_id);
		var oldMsg='';
		$('#say-'+u_id).live('click',function(){
			Chat.typingUID=u_id;
			if (!Chat.typingFuncRunning) {
				Chat.typingFuncRunning=true;
				Chat.isTyping(path);
			};
		})
		Chat.localCheckPerOpenTab[u_id]=0;
		Chat.localCheck(u_id,'n','def',path);
		$('#chat-'+u_id+' .chatHeader').click(function(){
			$('#'+chat_id).hide();
			$('#subTab-'+u_id).addClass('hiddenTab');
			$('#subTab-'+u_id).toggleClass('active');
			Chat.typingUID=u_id;
			Chat.typingFuncRunning=false;
		})
		$('#close-'+u_id).click(function(){
			$('#'+chat_id).remove();
			$('#subTab-'+u_id).remove();
			var left=$('#tabsLeftN').text();
			var nbr=parseInt(left)-1;
			var max=Tab.getMaxTabShown();
			var childs=$('#chatTab>ul').children('li').length;
			nbr<0?nbr=0:null;
			$('#tabsLeftN').text(nbr);
			Tab.autoScroll(max,childs);
			if(childs<=max){
				TabHelper.hideScrollers();
			}
			$.post(path+'chatProcess.php',{'removeRef':u_id});
			if (Chat.typingUID==u_id) {
				Chat.typingFuncRunning=false;
			};
		})
		$('#subTab-'+u_id).each(function(){
			$(this).click(function(e){
				if(!$(e.target).isChildOf('#subTab-'+u_id)){
					$('.chat:not(#chat-'+u_id+')').hide();
					$('.chat:not(#chat-'+u_id+')').parent().addClass('hiddenTab').removeClass('active');
					$('#'+chat_id).toggle();
					var tab=$('#subTab-'+u_id);
					tab.toggleClass('hiddenTab');
					tab.toggleClass('active');
					if(tab.hasClass('active')){
						Cookie.set('oT',u_id);
					}else{
						Cookie.set('oT',0);
					}
				}
				if($(this).hasClass('blink')){
					$(this).removeClass('blink');
				}
			})
		})
		$('#say-'+u_id).bind('keydown',function(e){
			var key=e.keyCode;
			if(key==13){
				e.preventDefault();
				var sVal=$('#say-'+u_id).attr('value');
				if(sVal!='' && sVal!=null){
					Chat.say(u_id,path,sVal);
				}
			}
		})
		$('#go_online-'+u_id).live('click',function(){
			$.post(path+'chatProcess.php',{'s':'1'},function(d){
				switch(d){
					case's':
						Chat.setDisplay(1,path);
						Chat.makeOnline();
						if (!Chat.typingFuncRunning) {
							Chat.typingFuncRunning=true;
							Chat.isTyping(path);
						};
						var checkedB4;
						$('.chat').each(function(){
							var id=$(this).attr('id');
							id=id.split('chat-');
							id=id[1];
							var lastChatter=$('#displayBox-'+id).children('.chatMsg:last-child').children('.msgHeader').children('.chatName').text();
							if(lastChatter==''){
								checkedB4='n';
							}else{
								checkedB4='y';
							}
							Chat.localCheckPerOpenTab[id]++;
							Chat.localCheck(id,checkedB4,'alt',path);
						})
					break;
					case'f':
						$('#errorBox-'+u_id).text('Failed to go online !').show(400);
					break;
				}
			})
		})

		var chatDiv=$('#chat-'+u_id);
		var sayDiv= chatDiv.find('#say-'+u_id);
		var smileyFolder=chatDiv.find('#openSmilies-'+u_id);
		var smiliesDiv=chatDiv.find('#smilies-'+u_id);
		
		sayDiv.live('focus',function(){
			if (smileyFolder.hasClass('opened')) {
				smileyFolder.toggleClass('opened');
			};
		})

		// open/close the smilley folder depending on the class it has
		smileyFolder.live('click',function(e){
			if(!$(this).hasClass('opened') && $(e.target).is("#openSmilies-"+u_id)) {
				smiliesDiv.fadeIn(100);
				$($(this).parents(".chatBox").find(".slimScrollDiv").get(0)).addClass("clickable");
				$(this).addClass('opened');
			}else{
				smiliesDiv.fadeOut(100);
				sayDiv.focus();
				$($(this).parents(".chatBox").find(".slimScrollDiv").get(0)).removeClass("clickable");
				$(this).removeClass('opened');
			}
		});

		// Close the smiley folder when clicking the chatBox
		$(".chatBox .slimScrollDiv").live("click",function(e){
			if($(".smilies:visible").length){
				smiliesDiv.fadeOut(100);
				sayDiv.focus();
				smileyFolder.removeClass("opened");
				$(this).removeClass("clickable");
			}
		});

		// when clickin on a smiley write the equivalent text value in the say box
		smiliesDiv.find('li').each(function(){
			$(this).click(function(){
				var smileyCode=$(this).attr('alt');
				var txt=sayDiv.attr("value");
				var newTxt=txt+" "+smileyCode;
				smileyFolder.removeClass('opened');
				$($(this).parents(".chatBox").find(".slimScrollDiv")).removeClass('clickable');
				smiliesDiv.hide();
				sayDiv.attr('value',newTxt);
				sayDiv.focus();
			})
		})

		// typing variables set
		var timeout;
		var spyDiv=$('#spy-'+u_id);
		sayDiv.bind('keydown', function () { //textchange
		  clearTimeout(timeout);
		  Chat.uTyping=true;
		    timeout = setTimeout(function () {
		    Chat.uTyping=false;
		  }, 1000);
		});

		$('#displayBox-'+u_id).slimScroll({
			height: '241px',
			size: '8px'
			//alwaysVisible: true
		})
	},
	controle:function(oldStatue,path){
		var statue=this.getStatue(path);
		if(statue==oldStatue && statue==0){
			setTimeout(function(){Chat.controle(statue,path);},Vars.controleFreq);
		}else{
			var chat=$.find('#chatTab');
			if(chat!=''){
				$.post(path+'chatProcess.php',{'stg':1},function(d){
					switch(d){
						case'0':
						case'f':
							Chat.setDisplay(0,path);statue=0;
						break;
						default:
							Chat.setDisplay(d,path);statue=d;
						break;
					}
				setTimeout(function(){Chat.controle(statue,path);},Vars.controleFreq);
				});
			}
		}
	},
	animateTitle:function(index,oTitle,title,notif){
		var replay=Vars.replay;
		var newMsg=Vars.newMessage;
		index++;
		if(title==newMsg){
			title=oTitle;
		}else{title=newMsg;}
		document.title=title;
		if(index<replay*2){
			setTimeout(function(){Chat.animateTitle(index,oTitle,title,notif);},500);
		}else{
			var oTitle2=document.title;
			var patt=/\( [0-99] \)/;
			if(patt.test(oTitle2)){
				var nNbr=oTitle2.replace(/.+ \( /,' ');
				var nNbr=nNbr.replace(/\)/,' ');
				newNotif=$.trim(nNbr);
			}else{newNotif=0;}
			notif=parseInt(notif)+parseInt(newNotif);
			oTitle2=oTitle2.replace(/\(.{3,4}\)/,' ');
			oTitle=oTitle2+' ( '+notif+' )';
			document.title=oTitle;
		}
	},
	notifyMe:function(notif){
		var oTitle=document.title;
		oTitle2=oTitle.replace(/\(.{3,4}\)/,' ');
		var index=0;
		var title='';
		Chat.animateTitle(index,oTitle,title,notif);
		$('#chatTab').click(function(){
			document.title=$.trim(oTitle2);
		})
	},
	cronix:function(path){
		var chat=$.find("#chatTab");
		if(chat!=''){
			$.post(path+'chatProcess.php',{'cronix':'1'},function(){
				setTimeout(function(){Chat.cronix(path);},Vars.userRefresh);
			})
		}
	}
};

var Tab={
	collapseTab:function(){
		var elem=$('#chatTab>ul').children('li:not(.hiddenTab)');
		var index=elem.index();
		var tabPos=index*Chat.tabWidth;
		var pos=parseInt($('#chatTab').css('right').split('px')[0]);
		var x=pos+tabPos;
		var w=$(window).width();
		var y=w-Chat.marginLeft;
		if(x-Chat.tabWidth<Chat.marginRight){
			$('.chat').hide();
			elem.addClass('hiddenTab');
			elem.removeClass('active');
		}else if(x+2*Chat.tabWidth>y){
			$('.chat').hide();
			elem.addClass('hiddenTab');
			elem.removeClass('active');
		}
	},
	// in case of refresh get the open tabs
	getOpenTabs:function(chatStatue,path){
		$.post(path+'chatProcess.php',{'getOpenTabs':1},function(d){
			if(d!='e'){ //e => empty
				d=$.evalJSON(d);
				var ids=d[0];
				var nicks=d[1];
				var lnth=$(ids).length;
				for(var i=0;i<lnth;i++){
					var u_id=ids[i];
					var u_nick=nicks[i];
					Chat.createChatHtml(u_id,u_nick,path,lnth);
				}
				Tab.calculateTabs();
			}
			setTimeout(function(){Chat.globalCheck(chatStatue,path);},5000); 
		})
	},
	calculateTabs:function(){
		var tabPos=$('#chatTab').css('right');
		var initPos=parseInt(tabPos.split('px')[0]);
		var childs=$('#chatTab>ul').children('li').length;
		var right=Math.floor(Math.abs(initPos-Chat.marginRight)/Chat.tabWidth);
		var max=Tab.getMaxTabShown();
		var left=childs-right-max;
		left<0?left=0:null;
		$('#tabsLeftP').text(right);
		$('#tabsLeftN').text(left);
	},
	getMaxTabShown:function(){
		var w=$(window).width();
		var leftInitW=$('#nextT').css('width');
		var leftInitNbr=Math.floor(parseInt(leftInitW.split('px')[0]));
		var maxTabsShown=Math.floor((w-leftInitNbr-Chat.marginRight)/Chat.tabWidth);
		return maxTabsShown;
	},
	scrollToPos:function(pos,type){
		var elem=$('#chatTab>ul').children('li:not(.hiddenTab)');
		$('.chat').hide();
		elem.addClass('hiddenTab');
		elem.removeClass('active');
		$('#chatTab').animate({'right':pos+'px'},500,function(){
			TabHelper.removeBlink(type);
		});
	},
	scrollTabs:function(destination){
		Tab.calculateTabs();
		var nbr='';
		destination=='r'?nbr=$('#tabsLeftN').text():nbr=$('#tabsLeftP').text();
		if(Chat.scrollable=='y'&&nbr!='0'){
			Chat.scrollable='n';
			var tabPos=$('#chatTab').css('right');
			var initPos=parseInt(tabPos.split('px')[0]);
			var pos="";
			var right=$('#tabsLeftP').text();
			var left=$('#tabsLeftN').text();
			switch(destination){
				case'r':
					pos=initPos-Chat.tabWidth;
					right=parseInt(right)+1;
					left=parseInt(left)-1;
				break;
				case'l':
					pos=initPos+Chat.tabWidth;
					left=parseInt(left)+1;
					right=parseInt(right)-1;
				break;
			}
			if(left<0||right<0){return false;}
			$('#chatTab').animate({'right':pos+'px'},500);
			$('#tabsLeftP').text(right);
			$('#tabsLeftN').text(left);
			setTimeout(function(){Chat.scrollable='y'},500);
		}
	},
	autoScroll:function(max,childs){
		var right=$('#tabsLeftP').text();
		var divPos=$('#chatTab').css('right').split('px')[0];
		var seenTabsWidth=(childs*Chat.tabWidth)-Math.abs(parseInt(divPos))-Chat.marginRight;
		if(seenTabsWidth<(max*Chat.tabWidth)){
			if(parseInt(right)>0){
				var pos=parseInt(divPos)+Chat.tabWidth;
				$('#chatTab').animate({'right':pos+'px'},500);
				$('#tabsLeftP').text(parseInt(right)-1);
			}
		}
	}
};

var TabHelper={
	playSound:function(path){
		var is_playSound=$('#chatStg .chatSoundCtrl').attr('id');
		if(is_playSound=='soundMute'){
			document.getElementById('chatSoundElem').play();
		}
	},
	showScrollers:function(){
		var pos=parseInt($('#chatTab').css('right').split('px')[0]);
		if(pos==Chat.initMarginRight){
			$('#chatTab').animate({'right':Chat.marginRight+'px'},500);
			$('#scrollLeft').show();$('#nextT').show();
			$('#scrollRight').show();$('#prevT').show();
		}
	},
	hideScrollers:function(){
		$('#chatTab').animate({'right':Chat.initMarginRight+'px'},500);
		$('#scrollLeft').hide();
		$('#nextT').hide();
		$('#scrollRight').hide();
		$('#prevT').hide();
	},
	blinkIt:function(ref,i){
		var replay=Vars.blinkTimes;
		if(i%2){
			$('#subTab-'+ref).toggleClass('blink');
		}else{
			$('#subTab-'+ref).toggleClass('blink');
		}
		i++;
		if(replay*2>i){
			setTimeout(function(){TabHelper.blinkIt(ref,i)},400);
		}else if(!$('#subTab-'+ref).hasClass('blink')){
			$('#subTab-'+ref).addClass('blink');
		}
	},
	shouldItBlink:function(ref,j){
		var pos=$('#chatTab').css('right').split('px')[0];
		pos=parseInt(pos);
		$('#chatTab>ul').children('li').each(function(i){
			var id=$(this).attr('id');
			if(id=='subTab-'+ref){
				var tabPos=i*Chat.tabWidth;
				var x=pos+tabPos;
				var w=$(window).width();
				var leftInitW=$('#nextT').css('width');
				var leftInitNbr=Math.floor(parseInt(leftInitW.split('px')[0]));
				var y=w-leftInitNbr;
				if(x<Chat.marginRight){TabHelper.blinkScrollButton('prevT',j,ref);
			}else if(x>y){
				TabHelper.blinkScrollButton('nextT',j,ref);
			}}
		})
	},
	blinkScrollButton:function(id,j,ref){
		var replay=Vars.blinkTimes;
		if(j%2){
			$('#'+id).toggleClass('blink');
		}else{
			$('#'+id).toggleClass('blink');
		}
		j++;
		if(replay*2>j){
			setTimeout(function(){TabHelper.blinkScrollButton(id,j,ref)},400);
		}else if(!$('#'+id).hasClass('blink')){
			$('#'+id).addClass('blink');
		}
	},
	removeBlink:function(type){
		var elems=new Array();
		var elem;
		var elemPos;
		$('#chatTab>ul').children('li.blink').each(function(i){
			elems[i]=$(this);
		});
		if(elems.length==0){return false;}
		switch(type){
			case'next':
				elem=elems[elems.length-1];
			break;
			case'prev':
				elem=elems[0];
			break;
		}
		elemPos=(elem.index())*Chat.tabWidth;
		var pos=$('#chatTab').css('right').split('px')[0];
		pos=parseInt(pos);
		var x=pos+elemPos;
		var w=$(window).width();
		var leftInitW=$('#nextT').css('width');
		var leftInitNbr=Math.floor(parseInt(leftInitW.split('px')[0]));
		var y=w-leftInitNbr;
		switch(type){
			case'prev':
				if(x+Chat.tabWidth>=Chat.marginRight){
					$('#prevT').removeClass('blink');
				}
			break;
			case'next':
				if(x<y){
					$('#nextT').removeClass('blink');
				}
			break;
		}
	}
};

var Auth={
	lock:function(){
		$('#cMsg').hide();
		$('#userNm').attr('disabled','disabled');
		$('#userEm').attr('disabled','disabled');
		$('#subCtr').animate({"opacity":"0.08"});
		$('#loader').show();
	},
	unlock:function(){
		$('#loader').hide();
		$('#userNm').removeAttr('disabled');
		$('#userEm').removeAttr('disabled');
		$('#subCtr').animate({"opacity":"1"});
	},
	login:function(path){
		var un=$('#userNm').attr('value');
		var ue=$('#userEm').attr('value');
		if(un==''||ue==''){
			$('#cMsg').html('User or/and email are empty !').show();
			return false;
		}else{
			var pattUser=/^[a-zA-Z0-9_\.-]{4,16}$/;
			var pattEmail=/^[a-zA-Z0-9_\.-]{2,}\@[a-zA-Z0-9_\.-]{2,}\.[a-zA-Z0-9_\.-]{2,4}$/;
			if(!pattUser.test(un)){
				$('#cMsg').html('Invalid User Name !<br /><ul><li>Must be longer than 3 characters </li><li>Must be shorter than 16 characters </li><li>Only alphaNumeric and "_-." characters are allowed </li></ul>').show();
				return false;
			}
			if(!pattEmail.test(ue)){
				$('#cMsg').html('Invalid Email !').show();
				return false;
			}
		}
		Auth.lock();
		$.post(path+'authProcess.php',{'act':'lgn','un':un,'ue':ue},function(d){
			switch(d){
				case's':
					$('#container').remove();
					var transLayout=''
					if (Vars.tr=='1') {
						transLayout='<li id="translate">Translation <div id="languages"> <ul><li id="ar">Arabic</li><li id="bg">Bulgarian</li><li id="ca">Catalan</li><li id="zh-CHS">Chinese (Simplified)</li><li id="zh-CHT">Chinese (Traditional)</li><li id="cs">Czech</li><li id="da">Danish</li><li id="nl">Dutch</li><li id="en" class="nativeLanguage">English</li><li id="et">Estonian</li><li id="fi">Finnish</li><li id="fr">French</li><li id="de">German</li><li id="el">Greek</li><li id="ht">Haitian Creole</li><li id="he">Hebrew</li><li id="hi">Hindi</li><li id="hu">Hungarian</li><li id="id">Indonesian</li><li id="it">Italian</li><li id="ja">Japanese</li><li id="ko">Korean</li><li id="lv">Latvian</li><li id="lt">Lithuanian</li><li id="mww">Hmong Daw</li><li id="no">Norwegian</li><li id="fa">Persian</li><li id="pl">Polish</li><li id="pt">Portuguese</li><li id="ro">Romanian</li><li id="ru">Russian</li><li id="sk">Slovak</li><li id="sl">Slovenian</li><li id="es">Spanish</li><li id="sv">Swedish</li><li id="th">Thai</li><li id="tr">Turkish</li><li id="uk">Ukrainian</li><li id="vi">Vietnamese</li></ul></div></li><hr>';
					};
					$(document.body).append('<div id="chatCtr"><ul><li id="prevT" style="display:none;"><span id="tabsLeftP"> 0 </span><span class="icon next"></span></li><li id="scrollRight" style="display:none;"> <span class="icon snext"></span> </li> <li id="friends"> <div id="frdDiv"> <div id="frdHeader"><b>Who\'s online ?</b></div> <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; max-height: 200px;"><div style="overflow: hidden; width: auto; max-height: 200px;" id="onlineUsers"> Do you want to see online friends or everyone ? </div><div style="border-radius: 7px 7px 7px 7px; background: none repeat scroll 0% 0% rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; z-index: 99; right: 1px;" class="slimScrollBar  ui-draggable"></div><div style="width: 15px; height: 100%; position: absolute; top: 0px; right: 1px;"></div></div> <ul> <hr> <li class="friendsType" id="f1">Everyone</li> <li class="friendsType " id="f2">Friends</li> </ul> </div> <span class="icon friends"></span> </li> <li id="stg"> <div id="chatStg"> <div id="stgHeader"><b>Settings</b></div> <ul> '+transLayout+' <li class="chatStatue activeStatus" id="s1"><span class="icon online"></span>Online</li> <li class="chatStatue" id="s0"><span class="icon offline"></span> Offline</li> <hr> <li id="soundMute" class="chatSoundCtrl"><span class="icon"></span>Disable sound</li> </ul> </div> <span class="icon stg"></span> </li> </ul> <span id="nextT"><span class="icon prev"></span><span id="tabsLeftN"> 0 </span> </span> <span id="scrollLeft"><span class="icon sprev"></span></span> </div> <div style="right: 82px;" id="chatTab"> <ul></ul> </div> <button id="lgt">Logout</button> <audio id="chatSoundElem" src="message.wav"></audio>');
					$('#chatTab').css({'right':Chat.initMarginRight+'px'});
					Chat.getInfo(path);
				break;
				case'f':
					Auth.unlock();
					$('#cMsg').html('Error !').show();
				break;
				default:
					Auth.unlock();
					$('#cMsg').html('This username is already in use please use another one !').show();
					break;
			}
		})
	},
	logout:function(path){
		$.post(path+'authProcess.php',{'act':'lgt'},function(d){
			switch(d){
				case's':
					// $('#container').remove();
					$('#chatCtr').remove();
					$('#chatTab').remove();
					$('#lgt').remove();
					$(document.body).append('You have successufully logged out !, you can log back <a href="index.php">here</a> ');
					break;
				case'f':
					alert('failed to logout');
				break;
			}
		})
	}
};

var Cookie={
	caution:false,
	set:function(name, value, expires, path, domain, secure){
		var curCookie = name + "=" + escape(value) +
		((expires) ? "; expires=" + expires.toGMTString() : "") +
		((path) ? "; path=" + path : "") +
		((domain) ? "; domain=" + domain : "") +
		((secure) ? "; secure" : "")
		if (!Cookie.caution || (name + "=" + escape(value)).length <= 4000)
		document.cookie = curCookie
		else
		if (confirm("Cookie exceeds 4KB and will be cut!"))
		document.cookie = curCookie
	},
	get:function(name){
	var prefix = name + "=";
	var cookieStartIndex = document.cookie.indexOf(prefix);
	if (cookieStartIndex == -1){
		return null;
	}
	var cookieEndIndex = document.cookie.indexOf(";", cookieStartIndex + prefix.length);
	if (cookieEndIndex == -1){
		cookieEndIndex = document.cookie.length;
	}
	return unescape(document.cookie.substring(cookieStartIndex+prefix.length, cookieEndIndex));
	},
	returnExpiration:function(day){
		var now = new Date();
		now.setTime(now.getTime() + day * 24 * 60 * 60 * 1000);
		return now;
	}
	
}