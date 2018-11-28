{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:99.5%;">
    <div class="gray_stripe">
    	{$LNG.al_circular_send_ciruclar} <span style="float:right; color:#8e9394;">(<span id="cntChars">0</span> / 5000 {$LNG.al_characters})</span>
    </div>
    <form name="message" id="message">
        <table class="ally_ranks gray_stripe_th td_border_bottom">
        <tbody><tr>
            <td>{html_options name=rankID options=$RangeList}</td>
            <td>
            	<input name="subject" id="subject" size="40" placeholder="{$LNG.mg_subject}" maxlength="40" type="text" value="{$LNG.mg_no_subject}">
            </td>
			<td><select name="priority"><option value="0">Normal</option><option value="1">Important</option></select></td>
        </tr>
        <tr>
            <td colspan="3">
            	<textarea placeholder="{$LNG.mg_message}" name="text" cols="60" rows="10" onkeyup="$('#cntChars').text($(this).val().length);"></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center; border-bottom:0;">
            <input value="{$LNG.al_circular_reset}" type="reset">
            <input onclick="return check();" name="button" value="{$LNG.al_circular_send_submit}" type="button">
            </td>
        </tr>
        </tbody></table>
    </form>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        <!--/body-->
        
{/block}
{block name="script" append}
<script type="text/javascript">
function check(){
	if(document.message.text.value == '') {
		alert('{$LNG.mg_empty_text}');
		return false;
	} else {
		$.post('game.php?page=alliance&mode=circular&action=send&ajax=1', $('#message').serialize(), function(data){
			data = $.parseJSON(data);
			alert(data.message);
			if(!data.error) {
				parent.$.fancybox.close();
			}
		});
		return true;
	}
}
</script>
{/block}