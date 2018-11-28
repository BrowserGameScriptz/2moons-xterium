{block name="title" prepend}{$LNG.write_message}{/block}
{block name="content"}
<div id="ally_content" class="conteiner" style="width:auto; height:227px;">
    <div class="gray_stripe">
    	{$LNG.mg_send_new}: 
        <span class="message_recipient_name">{$nameDispl} [{$OwnerRecord.galaxy}:{$OwnerRecord.system}:{$OwnerRecord.planet}]</span>
        <span style="float:right; color:#8e9394;">(<span id="cntChars">0</span>&nbsp;/&nbsp;5.000&nbsp;{$LNG.mg_characters})</span>
    </div>
    <form name="message" id="message" action="">
        <input class="message_subject" name="subject" id="subject" size="40" maxlength="40" placeholder="{$LNG.ti_subject}" value="{if !empty($subject)}{$subject}{else}{$LNG.mg_no_subject}{/if}" type="text">
        <div class="clear" style="border-bottom:1px solid #000;"></div>
		<textarea class="message_text_message" placeholder="{$LNG.mg_message}" name="text" id="text" cols="40" rows="10" onkeyup="$('#cntChars').text($(this).val().length); keyUp(event);" onkeydown="keyDown(event)"></textarea>        
        <div class="build_band" style="padding-right:0;">       		
        	<input class="bottom_band_submit message_check_message" id="submit" onclick="check();" name="button" value="{$LNG.mg_send}" type="button"> 
            <span style="color:#999; float:right; margin-right:10px;">[ctrl + enter]</span>
    	</div>         
    </form>
</div>
</div>
</div>
            <div class="clear"></div>   
            
{/block}
{block name="script" append}
<script type="text/javascript">
function check(){
	if($('#text').val().length == 0) {
		alert('{$LNG.mg_empty_text}');
		return false;
	} else {
		$('submit').attr('disabled','disabled');
		$.post('game.php?page=messages&mode=send&id={$id}&ajax=1', $('#message').serialize(), function(data) {
			alert(data);
			parent.$.fancybox.close();
			return true;
		});
	}
}
function keyUp(e){
	if(e.keyCode == 17)
		ctrl = false;
}
function keyDown(e){ 
	if(e.keyCode == 17)
		ctrl = true;
	else if(e.keyCode == 13 && ctrl)
		check();
}
</script>
{/block}