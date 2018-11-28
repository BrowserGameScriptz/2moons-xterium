{block name="title" prepend}{$LNG.lm_buddylist}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:auto">
    <div class="gray_stripe">
    	{$LNG.bu_request_text} <span style="float:right; color:#8e9394;">(<span id="cntChars">0</span> / 5000 {$LNG.bu_characters})</span>
    </div>
    <form name="buddy" id="buddy" action="game.php?page=buddyList&amp;mode=send&amp;ajax=1" method="post">
    <input type="hidden" name="id" value="{$id}">
        <table class="ally_ranks gray_stripe_th td_border_bottom">
        <tr>
            <td style="text-align:left;">{$LNG.mg_send_to}: <input type="text" value="{$username} [{$galaxy}:{$system}:{$planet}]" size="40" readonly></td>
        </tr>
        <tr>
            <td><textarea  placeholder="{$LNG.complain_3}" name="text" id="text" cols="40" rows="11" size="100" onkeyup="$('#cntChars').text($(this).val().length);"></textarea></td>
        </tr>
        <tr>
            <td><input type="submit" value="{$LNG.bu_send}"></td>
        </tr>
    </table>
    </form>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}