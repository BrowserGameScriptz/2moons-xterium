{block name="title" prepend}{$LNG.lm_chat}{/block}
{block name="content"}
<script type="text/javascript">
  var lng = {$LNG.chat_js|json};
  
</script>
{*<script type="text/javascript" src="./scripts/chat/room.js?{$REV}"></script>*}
<script type="text/javascript" src="./scripts/chat/actions.js?{$REV}"></script>
<audio id="beepchat" preload="auto">
	<source src="./sound/beep.mp3"></source>
	<source src="./sound/beep.ogg"></source>
</audio>
{if $mini_chat == 1}<link rel="stylesheet" type="text/css" href="./styles/css/chat.mini.css?{$REV}">{else}
<link rel="stylesheet" type="text/css" href="./styles/css/chats.css?{$REV}">
<div id="page">
	<div id="content">{/if}
<div id="chat" class="conteiner" style="overflow:hidden;">

	<div class="gray_stripe" style="padding-left:0;">
		<div id="chat_tabs">
			<a href="game.php?page=chat{if $mini_chat == 1}&mini_chat=1{/if}"class="left_tab tab">{$LNG.chat_public_room} (<span id="chat_online">{$chat_online.general}</span>)</a>
			{if $user_ally != 0}
				<a href="game.php?page=chat&chat=ally{if $mini_chat == 1}&mini_chat=1{/if}" class="tab">{$LNG.chat_ally_room} (<span id="chat_ally_online">{$chat_online.ally}</span>)</a>
			{/if}
			<a href="game.php?page=chat&mode=rooms{if $mini_chat == 1}&mini_chat=1{/if}" class="tab active">{$LNG.chat_private_room} (<span id="chat_room1_online">{$chat_online.room1}</span>)</a>
		</div>
		<div style="float:right;">
			<div class="chat_rules" onClick="return Dialog.chatRules();">{$LNG.chat_rules}</div>
			<a class="help_txt cursor" href="game.php?page=chat&mode=roomsActions&action=create{if $mini_chat == 1}&mini_chat=1{/if}">{$LNG.chat_msg_8}</a>

		</div>
	</div>
	<div class="conteiner">
		<div id="search_menu">
			<input id="search_name" value="" type="text" onKeyDown="if(event.keyCode == 13){ searchRooms(); }">
			<div class='gr_btn_top_buy'>
				<a id="send" class="cursor" onClick='searchRooms();'>{$LNG.chat_msg_9}</a>     
			</div>
		</div>
		<div id="roomsList"></div>
	</div>
	</div>
</div>
</div>
            <div class="clear"></div>            
        </div><!--/body-->

{/block}