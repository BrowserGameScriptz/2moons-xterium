{block name="title" prepend}{$LNG.lm_fleet}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <!--<div class="gray_stripe">
    	{$galaxy}:{$system}:{$planet} - {$LNG.type_planet.{$type}}
    </div>-->
    <div style="overflow:hidden; position:absolute; width:0; height:0;">
	<form action="game.php?page=fleetStep3" method="post">
	<input name="tokens" value="tokens" type="hidden">
	<table class="tablesorter ally_ranks">
	<tbody>
	<tr style="height:20px;">
	<td colspan="2">
	<input value="{$LNG.fl_continue}" type="submit">
	</td>
	</tr>
	</tbody>
	</table>
	</form>
	</div>
	
	
	<form action="game.php?page=fleetStep3" method="post">
	<input type="hidden" name="token" value="{$token}">
	<input name="groupAttackMOD" value="{$fleetGroupShow}" type="hidden">

	
   	<table class="tablesorter ally_ranks">
		<tbody><tr>
			<th class="gray_stripe">{$LNG.fl_mission}</th>
        	<th class="gray_stripe">{$LNG.fl_resources} <a style="float:right; color:#666;{foreach $MissionSelector as $MissionID}{if $MissionID == 18 or $MissionID == 8}display:none"{/if}{/foreach}" href="javascript:maxResources()">{$LNG.fl_all_resources}</a></th>
        </tr>
		<tr class="left top">
			<td style="padding:0;"> 
            	<div class="fl_mission_selector ">      		
                 {foreach $MissionSelector as $MissionID} 

                	<div class="fl_mission_selector_row">            
                		<input id="radio_{$MissionID}" {if $MissionID == 2}onclick="ListSector()"{/if} {if $MissionID == 17}onclick="listhostal()"{/if} name="mission" value="{$MissionID}" type="radio" {if $mission == $MissionID}checked="checked"{/if}>
                		<label for="radio_{$MissionID}" {if $MissionID == 2}onclick="ListSector()"{/if} {if $MissionID == 17}onclick="listhostal()"{/if}>{$LNG.type_mission.{$MissionID}}</label>
                    </div>
                      {/foreach}          
					{foreach $MissionSelector as $MissionID}
					{if $MissionID == 18}<div class="fl_mission_selector_caution">{$LNG.fl_expedition_alert_message}</div> {/if}
                	{if $MissionID == 11}<div class="fl_mission_selector_caution">{$fl_dm_alert_message}</div> {/if}
                	{/foreach}
					
					
                                                                                </div>
        	</td>
        	<td style="padding:0; width:300px;">
				<table class="tablesorter ally_ranks fl_res_table">
                    <tbody><tr>
        				<td style="padding:0;">                        
                            <div class="fl_res_rows_input_div" {foreach $MissionSelector as $MissionID}{if $MissionID == 18 or $MissionID == 8}style="display:none"{/if}{/foreach}>
                            	<img class="fl_res_rows_ico_img" alt="{$LNG.tech.901}" title="{$LNG.tech.901}" src="styles/images/metall.gif">
                                <div onclick="minResource('metal');" class="fl_res_rows_input_min">Min</div>
                                <div onclick="maxResource('metal');" class="fl_res_rows_input_max">Max</div>                                
                                <input class="countdots fl_res_rows_input_countdots" name="metal" onchange="calculateTransportCapacity();" type="text"  >
                            </div>
                        </td>
        			</tr>
                    <tr>
        				<td style="padding:0;">
                        	<div class="fl_res_rows_input_div" {foreach $MissionSelector as $MissionID}{if $MissionID == 18 or $MissionID == 8}style="display:none"{/if}{/foreach}>
                            	<img class="fl_res_rows_ico_img" alt="{$LNG.tech.902}" title="{$LNG.tech.902}" src="styles/images/kristall.gif">
                                <div onclick="minResource('crystal');" class="fl_res_rows_input_min">Min</div>
                                <div onclick="maxResource('crystal');" class="fl_res_rows_input_max">Max</div>                                
                                <input class="countdots fl_res_rows_input_countdots" name="crystal" onchange="calculateTransportCapacity();" type="text">
                            </div>
                        </td>
        			</tr>
                    <tr>
        				<td style="padding:0;">
                        	<div class="fl_res_rows_input_div" {foreach $MissionSelector as $MissionID}{if $MissionID == 18 or $MissionID == 8}style="display:none"{/if}{/foreach}>
                            	<img class="fl_res_rows_ico_img" alt="{$LNG.tech.903}" title="{$LNG.tech.903}" src="styles/images/deuterium.gif">
                                <div onclick="minResource('deuterium');" class="fl_res_rows_input_min">Min</div>
                                <div onclick="maxResource('deuterium');" class="fl_res_rows_input_max">Max</div>                                
                                <input class="countdots fl_res_rows_input_countdots" name="deuterium" onchange="calculateTransportCapacity();" type="text" >
                            </div>
                       	</td>
        			</tr>
                    <tr>
        				<td style="text-align:left">{$LNG.fl_resources_left}: <span id="remainingresources">-</span></td>
        				
        			</tr>
                    <tr>
        				<td style="text-align:left">
                        	{$LNG.fl_fuel_consumption}: <span style="color:#096;">{$consumption}</span>
                            <span id="consumption" class="consumption" style="display:none;">{$consumption}</span>
                       </td>
        			</tr>
					{if $StaySelector}
					<tr>
			<td style="text-align:left">{$LNG.fl_hold_time}: 
{html_options name=staytime options=$StaySelector} ({$LNG.fl_hours})

  </td>
		</tr>
		{/if}
				</tbody></table>
			</td>
		</tr>
			
		    
    </tbody></table>
	
	 <div style="display:{if $tutorial == 60 || $mission == 17}block{else}none{/if};" id="listhostal">
    	<span>{$LNG.sect_hostile_1}:</span> &nbsp;&nbsp;
         
            <input name="sectors" id="sector_1" value="1" class="tooltip" data-tooltip-content="
<b>{$LNG.sect_hostile_2}:</b><br>
{$LNG.sect_hostile_10}<br>
<br>
<span style='color:#28B306'>{$LNG.sect_hostile_8}</span><br>" type="radio">
            <label id="label_sector_1" for="sector_1" class="tooltip" data-tooltip-content="
<b>{$LNG.sect_hostile_2}:</b><br>
{$LNG.sect_hostile_10}<br>
<br>
<span style='color:#28B306'>{$LNG.sect_hostile_8}</span><br>">{$LNG.sect_hostile_2}</label> 
         
            <input name="sectors" id="sector_2" value="2" class="tooltip" data-tooltip-content="
<b>{$LNG.sect_hostile_3}:</b><br>
{$LNG.sect_hostile_11}<br>
<br>
<span style='color:#28B306'>{$LNG.sect_hostile_8}</span><br>" type="radio">
            <label id="label_sector_2" for="sector_2" class="tooltip" data-tooltip-content="
<b>{$LNG.sect_hostile_3}:</b><br>
{$LNG.sect_hostile_11}<br>
<br>
<span style='color:#28B306'>{$LNG.sect_hostile_8}</span><br>">{$LNG.sect_hostile_3}</label> 
         
            <input name="sectors" id="sector_3" value="3" class="tooltip" data-tooltip-content="
<b>{$LNG.sect_hostile_4}:</b><br>
{$LNG.sect_hostile_12}<br>
<br>
<span style='color:#28B306'>{$LNG.sect_hostile_8}</span><br>" type="radio">
            <label id="label_sector_3" for="sector_3" class="tooltip" data-tooltip-content="
<b>{$LNG.sect_hostile_4}:</b><br>
{$LNG.sect_hostile_12}<br>
<br>
<span style='color:#28B306'>{$LNG.sect_hostile_8}</span><br>">{$LNG.sect_hostile_4}</label> 
         
     {*       <input name="sectors" id="sector_4" value="4" class="tooltip" data-tooltip-content="
<b>{$LNG.sect_hostile_5}:</b><br>
{$LNG.sect_hostile_9}<br>
<br>
<span style='color:#28B306'>{$LNG.sect_hostile_8}</span><br>" type="radio">
            <label id="label_sector_4" for="sector_4" class="tooltip" data-tooltip-content="
<b>{$LNG.sect_hostile_5}:</b><br>
{$LNG.sect_hostile_9}<br>
<br>
<span style='color:#28B306'>{$LNG.sect_hostile_8}</span><br>" style="color:#69C300;">{$LNG.sect_hostile_5}</label> *}
         
            <input name="sectors" id="sector_5" value="5" class="tooltip" data-tooltip-content="
<b>{$LNG.sect_hostile_6}:</b><br>
{$LNG.sect_hostile_13}<br>
<br>
<span style='color:#28B306'>{$LNG.sect_hostile_8}</span><br>" type="radio">
            <label id="label_sector_5" for="sector_5" class="tooltip" data-tooltip-content="
<b>{$LNG.sect_hostile_6}:</b><br>
{$LNG.sect_hostile_13}<br>
<br>
<span style='color:#28B306'>{$LNG.sect_hostile_8}</span><br>">{$LNG.sect_hostile_6}</label> 
         
            <input name="sectors" id="sector_6" value="6" class="tooltip" data-tooltip-content="
<b>{$LNG.sect_hostile_7}:</b><br>
{$LNG.sect_hostile_14}<br>
<br>
<span style='color:#28B306'>{$LNG.sect_hostile_8}</span><br>" type="radio">
            <label id="label_sector_6" for="sector_6" class="tooltip" data-tooltip-content="
<b>{$LNG.sect_hostile_7}:</b><br>
{$LNG.sect_hostile_14}<br>
<br>
<span style='color:#28B306'>{$LNG.sect_hostile_8}</span><br>">{$LNG.sect_hostile_7}</label> 
                <div class="clear"></div>
    </div>
    
	
		<table style="display:none;" id="listsector" class="tablesorter ally_ranks">
		<tr style="height:15px;">
			<td style="text-align:right;" id="acsName">-
			</td><td id="acsMax">-</td>
		</tr>
		<tr style="height:15px;">
			<td style="text-align:right;">Duree decalage/Duree Max</td>
			<td id="acsmaxTime">-</td>
		</tr>
		 <div class="clear"></div>
    </table>
		
	
	
    <div class="gray_stripe build_band" style="padding-right:0;">
    	        <input class="bottom_band_submit" value="{$LNG.fl_continue}" type="submit" {*onclick="this.disabled=true;this.value='Please wait !';this.form.submit();"*}>
				{foreach $MissionSelector as $MissionID} 
				{if $MissionID == 18 || $MissionID == 1}
            <div class="fl_wave">    
			
			
            <select name="maxwave">
			{for $wavemaxi=1 to $totalLeft}
                            <option value="{$wavemaxi}">{$wavemaxi}</option>
                      {/for}     
                        </select>
						
						     
            <label>{$LNG.expe_wave}:</label>
            <div class="clear"></div>
        </div>
		{/if}
			{/foreach}
            </div>
			
			
	</form>
</div>
<script type="text/javascript">
durationMOD			= {$duration|json};
data			= {$fleetdata|json};
HoldResources	= { "metal":0,"crystal":0,"deuterium":0 };
function listhostal()
{
	$('#listhostal').show();
}
function ListSector()
{
	$.getJSON('game.php?page=fleetStep2&mode=checkTargetACSMOD&groupAttackMod='+document.getElementsByName("groupAttackMOD")[0].value+'&token='+document.getElementsByName("token")[0].value+'&duration='+durationMOD, function(data) {
		if(data.OK == true) {
			$('#acsMax').html(data.maxacstime);
			$('#acsmaxTime').html(data.finalTime);
			$('#acsName').html(data.acsName);
			$('#listsector').show();
		} else {
			NotifyBox(data);
		}
	});
	return false;
}
</script>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->

{/block}