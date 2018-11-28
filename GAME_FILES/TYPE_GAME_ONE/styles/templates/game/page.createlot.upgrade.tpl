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
<option value="laser" class="upgrade_name_class option" id="upgrade_name-0">{$LNG.market_5} [{$arsenal_laser|number}]</option>
<option value="ion" class="upgrade_name_class option" id="upgrade_name-1">{$LNG.market_6} [{$arsenal_ion|number}]</option>
<option value="plasma" class="upgrade_name_class option" id="upgrade_name-2">{$LNG.market_7} [{$arsenal_plasma|number}]</option>
<option value="gravity" class="upgrade_name_class option" id="upgrade_name-3">{$LNG.market_8} [{$arsenal_gravity|number}]</option>
<option value="dlight" class="upgrade_name_class option" id="upgrade_name-4">{$LNG.market_9} [{$arsenal_d_light|number}]</option>
<option value="dmedium" class="upgrade_name_class option" id="upgrade_name-5">{$LNG.market_10} [{$arsenal_d_medium|number}]</option>
<option value="dheavy" class="upgrade_name_class option" id="upgrade_name-6">{$LNG.market_11} [{$arsenal_d_heavy|number}]</option>
<option value="slight" class="upgrade_name_class option" id="upgrade_name-7">{$LNG.market_12} [{$arsenal_s_light|number}]</option>
<option value="smedium" class="upgrade_name_class option" id="upgrade_name-8">{$LNG.market_13} [{$arsenal_s_medium|number}]</option>
<option value="sheavy" class="upgrade_name_class option" id="upgrade_name-9">{$LNG.market_14} [{$arsenal_s_heavy|number}]</option>
<option value="combustion" class="upgrade_name_class option" id="upgrade_name-10">{$LNG.market_15} [{$arsenal_combustion|number}]</option>
<option value="impulse" class="upgrade_name_class option" id="upgrade_name-11">{$LNG.market_16} [{$arsenal_impulse_motor|number}]</option>
<option value="hyperspace" class="upgrade_name_class option" id="upgrade_name-12">{$LNG.market_17} [{$arsenal_hyperspace_motor|number}]</option>
<option value="res901" class="upgrade_name_class option" id="upgrade_name-13">{$LNG.market_18} [{$arsenal_res901|number}]</option>
<option value="res902" class="upgrade_name_class option" id="upgrade_name-14">{$LNG.market_19} [{$arsenal_res902|number}]</option>
<option value="res903" class="upgrade_name_class option" id="upgrade_name-15">{$LNG.market_20} [{$arsenal_res903|number}]</option>
<option value="conveyor1" class="upgrade_name_class option" id="upgrade_name-16">{$LNG.market_73} [{$arsenal_conveyor1|number}]</option>
<option value="conveyor2" class="upgrade_name_class option" id="upgrade_name-17">{$LNG.market_74} [{$arsenal_conveyor2|number}]</option>
<option value="conveyor3" class="upgrade_name_class option" id="upgrade_name-18">{$LNG.market_75} [{$arsenal_conveyor3|number}]</option>
</select>
</td>
            </tr>
            <tr>
                <td>{$LNG.market_59}: <input id="count" min="1" max="25" value="1" type="number" pattern="[0-9]*"></td>
                <td>{$LNG.market_56}: <input id="cost" min="500" max="1000000" value="500" type="number" pattern="[0-9]*"></td>
            </tr>
            <tr>
                <td colspan="2">
                	<input id="submit" style="padding-left:10px; padding-right:10px;" onclick="UpCheck();" name="button" value="{$LNG.market_57}" type="button">
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