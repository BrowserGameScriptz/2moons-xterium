{block name="title" prepend}{$LNG.market_55}{/block}
{block name="content"}


<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:auto">
    <div class="gray_stripe">
    	{$LNG.market_55}
    </div>
    <form name="message" id="message" action="">
        <table class="ally_ranks gray_stripe_th td_border_bottom">
        	            <tbody><tr>
                <td>{$LNG.market_56}: <input id="cost" min="{max(1000,round($TotalPointSell/2-500000))}" max="{$TotalPointSell}" value="{round($TotalPointSell/2)}" type="number"> {$LNG.tech.922} (max = {$TotalPointSell|number})</td>
            </tr>
            <tr>
                <td>
                	<input id="submit" style="padding-left:10px; padding-right:10px;" onclick="PlanetCheck();" name="button" value="{$LNG.market_57}" type="button">
            	</td>
            </tr>
            <tr>
                <td style="color:#F00; font-size:11px;">
                	{$LNG.market_58}
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