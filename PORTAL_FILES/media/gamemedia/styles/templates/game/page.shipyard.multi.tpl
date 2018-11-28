{block name="title" prepend}{$LNG.lm_fleettrader}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" style="width:600px;" class="conteiner">
<form method="post">
	<input type="hidden" name="mode" value="send">
    <div class="gray_stripe" style="padding:0;">
    
    	<span style="float:left;"><select name="shipID" id="shipID" onchange="updateVars()" style="max-width:155px">
						{foreach $shipIDs as $shipID}
						<option  value="{$shipID}">{$LNG.tech.$shipID}</option>
						{/foreach}
					</select> </span>
		
		
      
    </div>
    <div id="market_conteiner">
        <div id="market_left_side" style="padding-bottom: 10px">
           <img id="img" alt="" data-src="{$dpath}gebaeude/">  </div>
        <div id="market_lost_msg">           
        </div>
        <div id="market_content">  <br><p style="text-align:center">{$LNG.tech.901}: <span id="metal" style="font-weight:800;"></span> &bull; {$LNG.tech.902}: <span id="crystal" style="font-weight:800;"></span> &bull; {$LNG.tech.903}: <span id="deuterium" style="font-weight:800;"></span> &bull; {$LNG.tech.921}: <span id="darkmatter" style="font-weight:800;"></span></p>
<div class="rd_planet_resours" style="width: 432px; position: absolute;bottom: 50px;">        
        	<div class="imper_block_td">
            	<div class="occupancy occupancy_901" style="width:100%"></div>
            	<div class="text_res "><span>{$LNG.tech.901}:</span><span id="total_metal" style="font-weight:800;"></span></div>
            </div>            
            <div class="imper_block_td">
            	<div class="occupancy occupancy_902" style="width:100%"></div>
           		<div class="text_res "> <span>{$LNG.tech.902}:</span> <span id="total_crystal" style="font-weight:800;"></span></div>
            </div>         
            <div class="imper_block_td">
            	<div class="occupancy occupancy_903" style="width:100%"></div>
            	<div class="text_res " ><span>{$LNG.tech.903}:</span><span id="total_deuterium" style="font-weight:800;"></span></div>
            </div>
			 <div class="imper_block_td">
            	<div class="occupancy occupancy_904" style="width:100%"></div>
            	<div class="text_res "><span>{$LNG.tech.921}:</span><span id="total_darkmatter" style="font-weight:800;"></span></div>
            </div>
        </div>   
<div class="build_band" style="padding-right:0; position:absolute;bottom:0;width:72%;">
		{$LNG.ft_count}: <input type="text" id="count" name="count" onkeyup="Total();" style="background: #000;border: 1px solid #001a40;">
		{*<button onclick="MaxShips();return false;">{$LNG.ft_max}</button>*}
       	 <input type="submit" class="bd_dm_buy" value="{$LNG.bd_build_ships}">
    </div>
        </div>
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
<script src="scripts/game/fleettrader.js"></script>
<script>
var CostInfo = {$CostInfos|json};
var Charge = 0;
$(function(){
    updateVars();
});
</script>
{/block}