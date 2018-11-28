{block name="title" prepend}{$LNG.trader_title}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:500px;">
    <div class="gray_stripe">
       {$othertrade}    

{*<span style="float:right"> &nbsp; &nbsp; &nbsp; &nbsp;<img src="styles/images/iconav/allres.png" onclick="inputAll();"></span>*}	   
    </div> 
    <form id="trader" action="" method="post">
	<input type="hidden" name="mode" value="send">
	<input type="hidden" name="resource" value="{$tradeResourceID}">
        <table class="tablesorter ally_ranks tr_table">
        <tbody><tr>
            <td style="text-align:right;">{$LNG.tech.$tradeResourceID}</td>
            <td class="tr_table_td_img"><img alt="{$LNG.tech.$tradeResourceID}" title="{$LNG.tech.$tradeResourceID}" src="styles/images/{$tradeResourceID}.gif"></td>
            <td colspan="2"><span style="color:#F63;" id="ress">0</span></td>
        </tr>
       {foreach $tradeResources as $tradeResource}
        <tr>
            <td style="text-align:right;"><label for="resource{$tradeResource}">{$LNG.tech[$tradeResource]}</label></td>
            <td class="tr_table_td_img">
            	<label for="resource{$tradeResource}"><img alt="{$LNG.tech[$tradeResource]}" title="{$LNG.tech[$tradeResource]}" src="styles/images/{$tradeResource}.gif"></label>
            </td>
			
            <td>+ <input name="trade[{$tradeResource}]" id="resource{$tradeResource}" class="trade_input" value="0" size="30" type="text"></td>

            <td>{$charge[$tradeResource]}/1</td>
        </tr>
		{/foreach}
		<tr style="display:none;">
            <td style="text-align:right;"><label for="resource921">Тёмная материя</label></td>
            <td class="tr_table_td_img">
            	<label for="resource921"><img alt="Тёмная материя" title="Тёмная материя" src="styles/images/921.gif"></label>
            </td>
            <td>+ <input name="resource921" id="resource921" class="trade_input" value="0" size="30" type="text"></td>
            <td>0/1</td>
        </tr>
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
{if $tradeResourceID == 901}
var ress1charge = 2;
var ress2charge = 4;
var ress3charge = 0;
var amountResourcen = {$amountResourcen};
{elseif $tradeResourceID == 902}
var ress1charge = 0.5;
var ress2charge = 2;
var ress3charge = 0;
var amountResourcen = {$amountResourcen};
{elseif $tradeResourceID == 903}
var ress1charge = 0.25;
var ress2charge = 0.5;
var ress3charge = 0;
var amountResourcen = {$amountResourcen};
{/if}
</script>
{/block}
