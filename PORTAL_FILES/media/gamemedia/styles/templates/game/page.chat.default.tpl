{block name="title" prepend}{$LNG.lm_chat}{/block}
{block name="content"}
<script type="text/javascript">
  var ally_id = "{$ally_id}";
</script>
<script type="text/javascript" src="./scripts/chat/global.js?{$REV}"></script>
<audio id="beepchat" preload="auto">
	<source src="./sound/beep.mp3"></source>
	<source src="./sound/beep.ogg"></source>
</audio>
{if $mini_chat == 1}<link rel="stylesheet" type="text/css" href="./styles/css/chat.mini.css?{$REV}">{else}
<link rel="stylesheet" type="text/css" href="./styles/css/chats.css?{$REV}"><div id="page">
	<div id="content" onunload="miniChatAction('open')">{/if}


<div id="chat" class="conteiner" style="overflow:hidden;">
<form name="chat_form">
	<div class="gray_stripe" style="padding-left:0;">
		<div id="chat_tabs">
			<a {if $ally_id != 0}href="game.php?page=chat{if $mini_chat == 1}&mini_chat=1{/if}" {/if}class="left_tab tab{if $ally_id==0} active{/if}">{$LNG.chat_public_room} (<span id="chat_online">{$chat_online.general}</span>)</a>
			{if $user_ally != 0}
				<a {if $ally_id==0}href="game.php?page=chat&chat=ally{if $mini_chat == 1}&mini_chat=1{/if}" {/if}class="tab{if $ally_id != 0} active{/if}">{$LNG.chat_ally_room} (<span id="chat_ally_online">{$chat_online.ally}</span>)</a>
			{/if}
			<a href="game.php?page=chat&mode=rooms{if $mini_chat == 1}&mini_chat=1{/if}" class="tab">{$LNG.chat_private_room} (<span id="chat_room1_online">{$chat_online.room1}</span>)</a>
			{if $userID == 1}<a href="game.php?page=chat&mode=logs{if $mini_chat == 1}&mini_chat=1{/if}" class="tab">Logs</a>{/if}
		</div>
		<div style="float:right;">
			<div class="chat_rules" onClick="return Dialog.chatRules();">{$LNG.chat_rules}</div>
			<div class="help_txt tooltip" data-tooltip-content="{include file='page.chat.about.tpl'}">{$LNG.gl_legend}</div>
		</div>
	</div>
	<div class="chat_content" onClick="closeAllMenu();">
		<div id="online_chat"></div>
		<div id="shoutbox"></div>                    
	</div>
	{if $chat_silence == ''}
	<div class="bottom_chat_panel">
    	<div class="input_msg_block">
			<textarea class="input_msg" name="msg" id="msg" maxlength="520" onClick="closeAllMenu();" onKeyPress="if(event.keyCode == 13){ document.chat_form.send.click(); }" onKeyUP="if(event.keyCode != 27){ keyUp(); }"></textarea>
        </div>
    	<div class="input_msg_block_right">
            <input class="button_send cursor" type="button" name="send" value="{$LNG.mg_send}" id="send" onClick="closeAllMenu();addMessage();event.returnValue = false;return false;">
            <span style="line-height:25px;float:left;position:relative;display:block;margin-left:5px;color:#808080;"><span id="lost_symbols">0</span>/520</span>
            <div class="right_bottom_buttons">
                <div id="last_smiles"></div>
                <div class="button_smiles chat_btn" onClick="showSmilesMenu();">
                    <div id="chat_smiles" name="chat_smiles" class="conteiner">
                        {include file="page.chat.smiles.tpl"}
                    </div>
                    <img src="/styles/images/smile.png">
                </div>
                <div class="color_button chat_btn">
                    <div id="chat_msg_color_short" style="background:{$user_color};" onClick="showMsgColorMenu();"></div>
                    {include file="page.chat.msg_color.tpl"}
                </div>
				{*
                <div class="img_add_button chat_btn">
                    {include file="page.chat.img_add.tpl"}
                    <img src="/styles/images/chat/add_img.png" onClick="showImgAddMenu();">
                </div>
				*}
                <div class="sound_button chat_btn" onClick="chatSoundMute();">
                    <img id="sound_mute" style="display:none;" src="/styles/images/chat/mute.png">
                    <img id="sound_unmute" style="display:block;" src="/styles/images/chat/unmute.png">
                </div>
            </div>
            <div class="clear"></div>
        </div>        
        <div class="clear"></div>
	</div>
	{else}
		<div style="line-height:25px; color:#C00; margin:0 5px;"><center>{$LNG.backNotification_6}</center></div>
	{/if}
</form>
</div>
<script type="text/javascript">
delonemesg			= "{$LNG.delonemessages}";
</script>
{/block}