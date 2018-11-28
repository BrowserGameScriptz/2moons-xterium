{block name="title" prepend}Full-Empire Controll{/block}
{block name="content"}
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
		Full-Empire Controll: {$LNG.tech.$productId}
	</div>
	<table class="ally_ranks gray_stripe_th">
        <tbody><tr>
            <td rowspan="2" style="width:120px; height:120px; padding:6px;">
                <a href="#">
                    <img src="./styles/theme/gow/gebaeude/{$productId}.gif" alt="Collider" style="width:120px; height:120px;">
                </a>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:left;">{$productDesc}</td>
        </tr>

    </tbody></table>
			

	
        
	<div class="clear"></div>
	<input class="build_number" size="5" maxlength="5" min="0" value="0" type="number" name="levelUpgrade">
	<button class="btn_build_part_left" name="sendButton" id="sendButton" type="submit" onclick="updateSend();return false;">Update your planets</button>
  </div>

<!--/body-->

{/block}
{block name="script" append}
<script type="text/javascript">
	var productId 	= {$productId};
</script>
{/block}