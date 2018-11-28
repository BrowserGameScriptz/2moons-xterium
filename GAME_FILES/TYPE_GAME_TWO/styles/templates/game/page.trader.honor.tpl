{block name="title" prepend}{$LNG.trader_title}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:500px;">
    <div class="gray_stripe">
     Exchange <span style="color:#09F;">Honor points</span> for antimatter 
    </div> 
    <form id="trader" action="" method="post">
    <input name="mode" value="honorsend" type="hidden">        
    <table class="tablesorter ally_ranks tr_table">
        <tbody>
		<tr>
            <td style="text-align:right;">Honor Points [{shortly_number($honorAmount)}]</td>
            <td class="tr_table_td_img"><img alt="Honor Points" title="Honor Points" src="styles/images/honor.gif"></td>
            <td colspan="2"><span style="color:#F63;" id="ress">0</span></td>
        </tr>
		{foreach $tradeResources as $tradeResource}
        <tr>
            <td style="text-align:right;"><label for="tm">{$LNG.tech[$tradeResource]}</label></td>
            <td class="tr_table_td_img">
            	<label for="tm"><img alt="{$LNG.tech[$tradeResource]}" title="{$LNG.tech[$tradeResource]}" src="styles/images/922.gif"></label>
            </td>
			{if $honorAmount > 0}
            <td>+ <input name="tm" id="tm" class="trade_input" value="0" size="30" type="text"></td>
			{else}
			<td>You need honor points to be able to make a trade !</td>
			{/if}
            <td>{$ChargeForHonor[$tradeResource]}/1</td>
        </tr>
		{/foreach}
		
        <tr style="display:none;">
            <td><label for="hz">hz</label></td>
            <td><input name="hz" id="hz" class="trade_input" value="0" size="30" type="text"></td>
            <td></td>
        </tr>
        <tr style="display:none;">
            <td><label for="hz">hz</label></td>
            <td><input name="hz" id="hz" class="trade_input" value="0" size="30" type="text"></td>
            <td></td>
        </tr>        
    </tbody></table>
	{if $honorAmount > 0}
        <div class="build_band ticket_bottom_band" style="padding-left:20px;">
    	<input class="bottom_band_submit" value="{$LNG.tr_exchange}" type="submit">
    </div>
	{/if}
        </form>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->	
{/block}
{block name="script" append}
<script type="text/javascript">
var ress1charge = 15000;
var ress2charge = 0;
var ress3charge = 0;
</script>
{/block}
