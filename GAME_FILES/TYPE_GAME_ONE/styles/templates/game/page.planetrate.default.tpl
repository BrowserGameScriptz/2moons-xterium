{block name="title" prepend}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:auto">
    <div class="gray_stripe">
    	{$lotNumber}
            </div>
    <table class="ally_ranks td_border_bottom">
    <tbody><tr>
        <td>
			{$LNG.market_91} = {$minprice|number} {$LNG.tech.922}
        </td>
    </tr>
    <tr>
        <td>{$LNG.market_92}: <span style="color:#FC0;">{($maxTime|time)} </span></td>
    </tr>
    <tr> 
       	<td>
        <form action="game.php?page=market" method="post">
        	<input name="mode" value="planetlotrate" type="hidden">
        	<input name="id" value="{$plotId}" type="hidden">
        	<label>{$LNG.market_94}:</label>
            <input name="rate" min="{round($minprice)}" value="{round($minprice)}" type="number">
            <input style="padding-left:10px; padding-right:10px;" title="" value="{$LNG.market_93}" type="submit">
        </form>
        </td>
    </tr>
    </tbody></table>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        <!--/body-->
		{/block}