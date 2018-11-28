{block name="title" prepend}{$LNG.market_48}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:auto">
    <div class="gray_stripe">
    	{$LNG.market_48}
    </div>
    <form name="message" id="message" action="">
        <table class="ally_ranks gray_stripe_th td_border_bottom">
            <tbody><tr> 
                <td colspan="2"><select name="request_notallow" class="upgrade_name_class" id="upgrade_name">
<option value="auction_item_1" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.1} [{$auction_item_1|number}]</option>
<option value="auction_item_2" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.2} [{$auction_item_2|number}]</option>
<option value="auction_item_3" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.3} [{$auction_item_3|number}]</option>
<option value="auction_item_4" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.4} [{$auction_item_4|number}]</option>
<option value="auction_item_5" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.5} [{$auction_item_5|number}]</option>
<option value="auction_item_6" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.6} [{$auction_item_6|number}]</option>
<option value="auction_item_7" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.7} [{$auction_item_7|number}]</option>
<option value="auction_item_8" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.8} [{$auction_item_8|number}]</option>
<option value="auction_item_9" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.9} [{$auction_item_9|number}]</option>
<option value="auction_item_10" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.10} [{$auction_item_10|number}]</option>
<option value="auction_item_11" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.11} [{$auction_item_11|number}]</option>
<option value="auction_item_12" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.12} [{$auction_item_12|number}]</option>
<option value="auction_item_13" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.13} [{$auction_item_13|number}]</option>
<option value="auction_item_14" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.14} [{$auction_item_14|number}]</option>
<option value="auction_item_15" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.15} [{$auction_item_15|number}]</option>
<option value="auction_item_16" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.16} [{$auction_item_16|number}]</option>
<option value="auction_item_17" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.17} [{$auction_item_17|number}]</option>
<option value="auction_item_18" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.18} [{$auction_item_18|number}]</option>
<option value="auction_item_19" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.19} [{$auction_item_19|number}]</option>
<option value="auction_item_20" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.20} [{$auction_item_20|number}]</option>
<option value="auction_item_21" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.auctioneer_booster.21} [{$auction_item_21|number}]</option>

</select>
</td>
            </tr>
            <tr>
                <td>{$LNG.market_59}: <input id="count" min="1" max="25" value="1" type="number" pattern="[0-9]*"></td>
                <td>{$LNG.market_56}: <input id="cost" min="500" max="1000000" value="500" type="number" pattern="[0-9]*"></td>
            </tr>
            <tr>
                <td colspan="2">
                	<input id="submit" style="padding-left:10px; padding-right:10px;" onclick="UpCheckitem();" name="button" value="{$LNG.market_57}" type="button">
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