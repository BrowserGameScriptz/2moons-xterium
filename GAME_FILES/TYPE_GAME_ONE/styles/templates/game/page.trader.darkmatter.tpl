{block name="title" prepend}{$LNG.trader_title}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:500px;">
    <div class="gray_stripe">
       {$LNG.trader_dm}               
    </div> 
    <form id="trader" action="" method="post">
        <input name="mode" value="tmsend" type="hidden">
        <input name="resource" value="921" type="hidden">
        <table class="tablesorter ally_ranks tr_table">
        <tbody><tr>
            <td style="text-align:right;">{$LNG.tech.$tradeResourceID}</td>
            <td class="tr_table_td_img"><img alt="{$LNG.tech.$tradeResourceID}" title="{$LNG.tech.$tradeResourceID}" src="styles/images/921.gif"></td>
            <td colspan="2"><span style="color:#F63;" id="ress">0</span></td>
        </tr>
       {foreach $tradeResources as $tradeResource}
        <tr>
            <td style="text-align:right;"><label for="resource{$tradeResource}">{$LNG.tech[$tradeResource]}</label></td>
            <td class="tr_table_td_img">
            	<label for="resource{$tradeResource}"><img alt="{$LNG.tech[$tradeResource]}" title="{$LNG.tech[$tradeResource]}" src="styles/images/{$tradeResource}.gif"></label>
            </td>
			
            <td>+ <input name="trade[{$tradeResource}]" id="resource{$tradeResource}" class="trade_input" value="0" size="30" type="text"></td>
			
            <td>{$ChargeForDarkmatter[$tradeResource]}/1</td>
        </tr>
		{/foreach}
        </tbody></table>
        <div class="build_band ticket_bottom_band" style="padding-left:20px;">
       	{$needDm}<input class="bottom_band_submit" value="{$LNG.tr_exchange}" type="submit">
        </div>
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
var ress1charge = 2.5E-5;
var ress2charge = 5.0E-5;
var ress3charge = 0.0001;
</script>
{/block}
