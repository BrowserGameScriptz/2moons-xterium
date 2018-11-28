{block name="title" prepend}{$LNG.fleetta_fle}{/block}
{block name="content"}
<!--/left_side-->
<!--ol--><div id="page">
	<div id="content">
<script type="text/javascript">
$(document).ready(function(){ var e=$("#speed").val();void 0===e&&(e=10);var p=0;0==$("#battleTypeId").val()&&(p=1);var t=0;0==$("#transportTypeId").val()&&(t=1);var o=0;0==$("#specialTypeId").val()&&(o=1);var a=0;0==$("#proccesorTypeId").val()&&(a=1),$("#speed").on("change",function(){ document.location="?"+queryString+"&speed="+$(this).val()+"&battleTypeId="+p+"&transportTypeId="+t+"&specialTypeId="+o+"&proccesorTypeId="+a }),$("#battleTypeId").on("change",function(){ document.location="?"+queryString+"&battleTypeId="+$(this).val()+"&transportTypeId="+t+"&specialTypeId="+o+"&proccesorTypeId="+a+"&speed="+e }),$("#transportTypeId").on("change",function(){ document.location="?"+queryString+"&transportTypeId="+$(this).val()+"&battleTypeId="+p+"&specialTypeId="+o+"&proccesorTypeId="+a+"&speed="+e }),$("#specialTypeId").on("change",function(){ document.location="?"+queryString+"&specialTypeId="+$(this).val()+"&battleTypeId="+p+"&transportTypeId="+t+"&proccesorTypeId="+a+"&speed="+e }),$("#proccesorTypeId").on("change",function(){ document.location="?"+queryString+"&proccesorTypeId="+$(this).val()+"&battleTypeId="+p+"&transportTypeId="+t+"&specialTypeId="+o+"&speed="+e }) });
</script>
<div id="ally_content" class="conteiner">
<div style="overflow:hidden; position:absolute; width:0; height:0;"><form action="game.php?page=reducefleet&amp;mode=reduce" method="post" id="form"><input name="tokens" value="tokens" type="hidden"><table class="tablesorter ally_ranks"><tbody><tr style="height:20px;"><td colspan="5"><input value="{$LNG.reduce_res_1}" type="submit"></td></tr></tbody></table></form></div>
	<form action="game.php?page=reducefleet&amp;mode=reduce" method="post" id="form">
	<div class="gray_stripe">
    	Gather option      
    </div>
	<div class="content_box" style="display: flex;">
                    
                <div class="left_part" style="width: 25%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px;margin-left: 6px;">
				<input style="float:left; margin:5px 6px 0 0;" id="battleTypeId" name="battleTypeId" value="{if $battleTypeId == 1}0{else}1{/if}" type="checkbox"{if $battleTypeId == 1} checked="checed"{/if}>
				</div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
				<label for="battleTypeId" class="left_label">{$LNG.fleetta_typ_1}</label></div>
                </div> </div>	
				
				 <div class="left_part" style="width: 25%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px;margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="transportTypeId" name="transportTypeId" value="{if $transportTypeId == 1}0{else}1{/if}" type="checkbox"{if $transportTypeId == 1} checked="checed"{/if}>
                </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
		<label for="transportTypeId" class="left_label">{$LNG.fleetta_typ_2}</label>	
                </div>
                </div> </div>	
				
				 <div class="left_part" style="width: 25%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px;margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="specialTypeId" name="specialTypeId" value="{if $specialTypeId == 1}0{else}1{/if}" type="checkbox"{if $specialTypeId == 1} checked="checed"{/if}>
                </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
		<label for="specialTypeId" class="left_label">{$LNG.fleetta_typ_3}</label>	
                </div>
                </div> </div>	
				
				 <div class="left_part" style="width: 25%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px;margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="proccesorTypeId" name="proccesorTypeId" value="{if $proccesorTypeId == 1}0{else}1{/if}" type="checkbox"{if $proccesorTypeId == 1} checked="checed"{/if}>
                </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
		<label for="proccesorTypeId" class="left_label">{$LNG.fleetta_typ_4}</label>	
                </div>
                </div> </div>	
					
				
	</div>
	{if $planetsResult == 0 || $TotalCount == 0}
	<div class="ally_contents" style="text-align:center;">{$LNG.reduce_res_6}</div>
	{else}
	<div class="gray_stripe">
    	{$LNG.reduce_res_9}
        <span style="float:right;">
        	<span class="all_true" style="color:#6C9; cursor:pointer;" onclick="planet_select_all();">{$LNG.reduce_res_3}</span> |
        	<span class="all_false" style="color:#F96; cursor:pointer;" onclick="planet_reset_all();">{$LNG.reduce_res_4}</span>
        </span>       
    </div>
	{foreach $PlanetListin as $ID => $Element}  				
	 <div id="prow_{$ID}" class="rd_planet_row rd_planet_row_select" onclick="planet_select({$ID});">
		{if $Element.deuterium >= $Element.consumption}<input class="rd_checkbox" id="p{$ID}" name="palanets[]" value="{$ID}" type="checkbox">{/if}
                <div class="rd_planet_img">
            <img title="{$Element.name} [{$Element.galaxy}:{$Element.system}:{$Element.planet}]" src="./styles/theme/gow/planeten/small/s_{$Element.image}.png" alt="">
        </div>
        <div class="rd_planet_data_name">
            <span style="color:#CC6;">{$Element.name}</span><br>            
            <span style="color:#CCC;">[{$Element.galaxy}:{$Element.system}:{$Element.planet}]</span><br>
            <span style="color:#09F;">{$LNG.reduce_res_8}: {$Element.duration} </span>
                    </div>
        <div class="rd_planet_fleets tooltip" data-tooltip-content="
       		<table class='reducefleet_table'>       
                               {foreach $Element.FleetsOnPlanet as $FleetRow}                                                 <tr>
                    <td class='reducefleet_img_ship'><img src='./styles/theme/gow/gebaeude/{$FleetRow.id}.gif' alt='{$LNG.tech.{$FleetRow.id}}' /></td>
                    <td class='reducefleet_name_ship'>{$LNG.tech.{$FleetRow.id}}: <span class='reducefleet_count_ship'>{$FleetRow.count|number}</span></td>
                </tr>{/foreach}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </table>"> 
      		<span style="color:#0CC;">{$LNG.reduce_res_10}:</span> {$Element.Count|number}           
        </div>
        <div class="rd_planet_status">
                <span style="color:{if $Element.deuterium >= $Element.consumption}#0C3{else}#FF0000{/if};">{$LNG.reduce_res_11}:</span> {$Element.consumption|number}<br>
				<span style="color:{if $Element.deuterium >= $Element.consumption}#0C3{else}#FF0000{/if};">{$LNG.tech.903} {$LNG.in_jump_gate_available}:</span> {$Element.deuterium|number}
                    </div>
        <div class="clear"></div>
    </div>
        {/foreach}
    <div class="build_band ticket_bottom_band" style="padding-left:20px;">
        {$LNG.fl_speed_title}        
		{html_options id="speed" name=speed options=$Selectors selected=$Selected} %
       	<input class="bottom_band_submit" value="{$LNG.reduce_res_1}" type="submit">
    </div>
  {/if}  
        
	</form>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}