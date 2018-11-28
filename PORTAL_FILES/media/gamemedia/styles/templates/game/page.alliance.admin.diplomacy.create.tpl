{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:99.5%">
    <div class="gray_stripe">
    	{$LNG.al_diplo_create} <span style="float:right; color:#8e9394;">(<span id="cntChars">0</span> / 5000 {$LNG.al_characters})</span>
    </div>
    <form name="message" id="message">
        <table class="ally_ranks gray_stripe_th td_border_bottom">
        <tbody><tr>
            <td>{$LNG.al_diplo_ally} {html_options name="ally_id" values=$IdList output=$AllyList}
</td>
            <td>{$LNG.al_diplo_level_des} {html_options name="level" values=range(1,6) output=$LNG.al_diplo_level selected=$diploMode}
</td>
        </tr>
        <tr>
            <td colspan="2">
                <textarea placeholder="{$LNG.al_diplo_text}" name="text" cols="60" rows="10" onkeyup="$('#cntChars').text($(this).val().length);"></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
            <input value="{$LNG.al_circular_reset}" type="reset">
            <input onclick="return check();" value="{$LNG.al_circular_send_submit}" type="button">
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
		$.getJSON('game.php?page=alliance&mode=admin&action=diplomacyCreateProcessor&ajax=1&'+$('#message').serialize(), function(data) {
			alert(data.message);
			if(!data.error) {
				parent.location.reload();
			}
		});
		return true;
	}
}

$(function() {	
	$('#name').autocomplete({
		source: "game.php?page=search&mode=autocomplete&type=allyname",
		minLength: 0,
		select: function(event, ui) {
			$(event.target).val(ui.item.label.replace(/<\/?b>/gim, ''));
			return false;
		}
	});
});
</script>
{/block}