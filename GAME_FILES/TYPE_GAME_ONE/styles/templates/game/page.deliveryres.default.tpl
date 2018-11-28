{block name="title" prepend}{$LNG.fleetta_res}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
<div style="overflow:hidden; position:absolute; width:0; height:0;"><form action="game.php?page=deliveryres&amp;mode=reduce" method="post" id="form"><input name="tokens" value="tokens" type="hidden"><table class="tablesorter ally_ranks"><tbody><tr style="height:20px;"><td colspan="5"><input value="Дальше" type="submit"></td></tr></tbody></table></form></div>
	<form action="game.php?page=deliveryres&amp;mode=delivery" method="post" id="form">
    <div class="gray_stripe">
    	{$LNG.fleetta_flealts}
		<span class="battlesim_def_points"><span class="totalEvoTransporters" name="totalEvoTransporters" id="totalEvoTransporters">0</span> {$LNG.tech.217}</span>
    </div>
    <table class="tablesorter ally_ranks">
		<tbody><tr>
			<td>
				<label for="r901">{$LNG.tech.901}</label> <input name="r901" id="r901" value="0">
            </td>
            <td>
				<label for="r902">{$LNG.tech.902}</label> <input name="r902" id="r902" value="0">
            </td>
            <td>
				<label for="r903">{$LNG.tech.903}</label> <input name="r903" id="r903" value="0">
			</td>
		</tr>
        <tr>
			<td>
				<span style="color: rgb(164, 125, 122);" id="s901">0</span>
            </td>
            <td>
				<span style="color: rgb(92, 166, 170);" id="s902">0</span>
            </td>
            <td>
				<span style="color: rgb(51, 153, 102);" id="s903">0</span>
			</td>
		</tr>
	</tbody></table>
	
    <div class="gray_stripe">
    	{$LNG.fleetta_flealts}
        <span style="float:right;">
			<span class="all_planets" style="color:#8A2BE2; cursor:pointer;" onclick="planet_all_planets();">Only planets</span> |
        	<span class="all_moons" style="color:#DC143C; cursor:pointer;" onclick="planet_all_moons();">Only moons</span> |
        	<span class="all_true" style="color:#6C9; cursor:pointer;" onclick="planet_select_all();">{$LNG.reduce_res_3}</span> |
        	<span class="all_false" style="color:#F96; cursor:pointer;" onclick="planet_reset_all();">{$LNG.reduce_res_4}</span>
        </span>
    </div>
	       {if $displayadsmd == 1}
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- War Of Galaxyz #Game -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2369063859511778"
     data-ad-slot="3349807407"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>{/if}
			
			{foreach $PlanetListin as $ID => $Element}  
        <div id="prow_{$ID}" class="rd_planet_row td_planet_delivery {if $ev_transportersw > 0}rd_planet_row_select{if $Element.planet_type == 1}_planet{else}_moon{/if}{/if}" {if $ev_transportersw > 0}onclick="planet_select({$ID});"{/if}>    
        {if $ev_transportersw > 0}<input class="rd_checkbox{if $Element.planet_type == 1}_planet{else}_moon{/if}" id="p{$ID}" name="palanets[]" value="{$ID}" type="checkbox">{/if}
                
        <div class="rd_planet_img">
            <img title="{$Element.name} [{$Element.galaxy}:{$Element.system}:{$Element.planet}]" src="./styles/theme/gow/planeten/small/s_{$Element.image}.png" alt="">
        </div>
        
        <div class="rd_planet_data_name">
            <span style="color:#CC6;">{$Element.name}</span><br>            
            <span style="color:#CCC;">[{$Element.galaxy}:{$Element.system}:{$Element.planet}]</span><br>
							{if $ev_transportersw > 0}<span style="color:#09F;">{$LNG.reduce_res_8}: {$Element.duration} </span>{/if}
                    </div>
        
        <div class="rd_planet_resours">        
        	<div class="imper_block_td">
            	<div class="occupancy occupancy_901" style="width:{min(100,$Element.metal*100/$Element.metal_max)}%"></div>
            	<div class="text_res tooltip" data-tooltip-content="<span class='p_res'>{$LNG.tech.901}</span> <span style='color:#999'>({$Element.name} [{$Element.galaxy}:{$Element.system}:{$Element.planet}])</span> <div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div> <span style='color:#999'>{$Element.metal|number} / {$Element.metal_max|number}</span>"><span>{$LNG.tech.901}:</span> {$Element.metal|number}</div>
            </div>            
            <div class="imper_block_td">
            	<div class="occupancy occupancy_902" style="width:{min(100,$Element.crystal*100/$Element.crystal_max)}%"></div>
           		<div class="text_res tooltip" data-tooltip-content="<span class='p_res'>{$LNG.tech.902}</span> <span style='color:#999'>({$Element.name} [{$Element.galaxy}:{$Element.system}:{$Element.planet}])</span> <div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div> <span style='color:#999'>{$Element.crystal|number} / {$Element.crystal_max|number}</span>"> <span>{$LNG.tech.902}:</span> {$Element.crystal|number}</div>
            </div>         
            <div class="imper_block_td">
            	<div class="occupancy occupancy_903" style="width:{min(100,$Element.deuterium*100/$Element.deuterium_max)}%"></div>
            	<div class="text_res tooltip" data-tooltip-content="<span class='p_res'>{$LNG.tech.903}</span> <span style='color:#999'>({$Element.name} [{$Element.galaxy}:{$Element.system}:{$Element.planet}])</span> <div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div> <span style='color:#999'>{$Element.deuterium|number} / {$Element.deuterium_max|number}</span>"><span>{$LNG.tech.903}:</span> {$Element.deuterium|number}</div>
            </div>
        </div>       
        
    </div>
	
	{/foreach}
	
        
	<div class="clear"></div>
    <div class="build_band ticket_bottom_band" style="padding-left:20px;">    
    	<span style="font-weight:bold;">{$LNG.academy_41}:</span>
        <span id="cost" style="font-weight: bold; margin-left: 5px; color: rgb(118, 196, 0);">0</span>
        <span>{$LNG.tech.922}</span>
        <input class="bottom_band_submit" value="{$LNG.reduce_res_1}" onclick="delivery_send();" type="submit">    
    </div>
    
        
	</form>
</div>

<script type="text/javascript">
	var MaxPlanet 	= {$planetsResult};
	var MaxOmoons 	= {$moonsCount};
	var MaxOPlane 	= {$planetsCount};
	var CostOne 	= 10;
	var MaxEvos		= {$ev_transportersw};
	var MaxRoomDel	= {$FleetRoomDeliver};
</script>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}