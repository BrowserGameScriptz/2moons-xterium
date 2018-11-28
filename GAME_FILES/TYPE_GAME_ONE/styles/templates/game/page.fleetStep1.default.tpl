{block name="title" prepend}{$LNG.lm_fleet}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
    	{$LNG.fl_send_fleet}
    </div>
	<form action="game.php?page=fleetStep2" method="post" onsubmit="return CheckTarget()" id="form">
	<input type="hidden" name="token" value="{$token}">
	<input type="hidden" name="fleet_group" value="0">
	<input type="hidden" name="target_mission" value="{$mission}">
	<input type="hidden" name="TIMING" id="TIMING" value="">
	<table class="tablesorter ally_ranks">
		<tbody><tr style="height:20px;">
			<td style="text-align:right;">{$LNG.fl_destiny}</td>
			<td>
				<input id="galaxy" name="galaxy" size="3" maxlength="2" onchange="updateVars()" onkeyup="updateVars()" value="{$galaxy}" type="text">
				<input id="system" name="system" size="3" maxlength="4" onchange="updateVars()" onkeyup="updateVars()" value="{$system}" type="text">
				<input id="planet" name="planet" size="3" maxlength="2" onchange="updateVars()" onkeyup="updateVars()" value="{$planet}" type="text">
				<select id="type" name="type" onchange="updateVars()">
					{html_options options=$typeSelect selected=$type}
				</select>
			</td>
		</tr>

		<tr style="height:20px;">
			<td style="text-align:right;">{$LNG.fl_fleet_speed}</td>
			<td>
				<select id="speed" name="speed" onchange="updateVarsMOD();ListBIS();">
					{html_options options=$speedSelect}
				</select> %
			</td>
		</tr>
		<tr style="height:20px;">
			<td style="text-align:right;">{$LNG.fl_distance}</td>
			<td id="distance">-</td>
		</tr>
		
		<tr style="height:20px;">
			<td style="text-align:right;">{$LNG.fl_flying_time}
			</td><td id="duration">-</td>
		</tr>
		<tr style="height:20px;">
			<td style="text-align:right;">{$LNG.fl_flying_arrival}
			</td><td id="arrival">-</td>
		</tr>
		<tr style="height:20px;">
			<td style="text-align:right;">{$LNG.fl_flying_return}
			</td><td id="return">-</td>
		</tr>
		<tr style="height:20px;">
			<td style="text-align:right;">{$LNG.fl_fuel_consumption}</td>
			<td id="consumption">-</td>
		</tr>
		<tr style="height:20px;">
			<td style="text-align:right;">{$LNG.fl_max_speed}</td>
			<td id="maxspeed">-</td>
		</tr>
		<tr style="height:20px;">
			<td style="text-align:right;">{$LNG.fl_cargo_capacity}</td>
			<td id="storage">-</td>
		</tr>
	</tbody></table>    
	
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
		
	  {if isModuleAvailable($smarty.const.MODULE_SHORTCUTS)}  
    <div class="tablesorter shortcut">
        <div class="gray_stripe build_band" style="height:22px;line-height:22px;color: #999;">
            {$LNG.fl_shortcuts} [{$shortcutAmounts} / 25]
            <a href="#" onclick="EditShortcuts();return false" class="shortcut-link-edit shortcut-link fl_shortcut_link_edition" style="text-decoration: underline;">{$LNG.fl_shortcut_edition}</a>
            <a href="#" onclick="SaveShortcuts();return false" class="shortcut-edit fl_shortcut_link_edition" style="text-decoration: underline;">{$LNG.fl_shortcut_save}</a>
        </div>
        <div id="shortcut-data" class="clear shortcut-row">
		
		{foreach $shortcutList as $shortcutID => $shortcutRow}
		<div class="shortcut-colum shortcut-isset shortcut_block">
                <div class="shortcut-link">
                    <a href="javascript:setTarget({$shortcutRow.galaxy},{$shortcutRow.system},{$shortcutRow.planet},{$shortcutRow.type});updateVars();">
                        <span class="shortcut_link_kord">
						{if $shortcutRow.type == 1}<img src="styles/images/iconav/short_planet.png" style="vertical-align: sub;height: 75%;">{elseif $shortcutRow.type == 2}<img src="styles/images/iconav/trash_small.png" style="vertical-align: sub;height: 65%;margin-left: -2px">{elseif $shortcutRow.type == 3}<img src="styles/images/iconav/short_moon.png" style="vertical-align: sub;height: 75%;">{/if}
                        	[{$shortcutRow.galaxy}:{$shortcutRow.system}:{$shortcutRow.planet}]
                        </span>
                        <span class="shortcut_link_name">&nbsp;{$shortcutRow.name} 
                        </span>                 
                     </a>
                </div>
                <div class="shortcut-edit">
                    <input class="shortcut-input shortcut-input-name" name="shortcut[{$shortcutID}][name]" maxlength="32" value="{$shortcutRow.name}" type="text">
                    <div class="shortcut-delete" title="{$LNG.fl_dlte_shortcut}"></div>
                </div>
                <div class="shortcut-edit">
                    <input class="shortcut-input" name="shortcut[{$shortcutID}][galaxy]" value="{$shortcutRow.galaxy}" size="3" maxlength="2" pattern="[0-9]*" type="text">:<input class="shortcut-input shortcut-input-system" name="shortcut[{$shortcutID}][system]" value="{$shortcutRow.system}" size="3" maxlength="4" pattern="[0-9]*" type="text">:<input class="shortcut-input" name="shortcut[{$shortcutID}][planet]" value="{$shortcutRow.planet}" size="3" maxlength="2" pattern="[0-9]*" type="text">
                </div>
                <div class="shortcut-edit">
                    <select class="shortcut-input shortcut-input-type" name="shortcut[{$shortcutID}][type]">
                        {html_options selected=$shortcutRow.type options=$typeSelect}
                    </select>
                </div>
            </div>
                   
		{foreachelse}
                        <div class="clear shortcut-none shortcut_block">
                {$LNG.fl_no_shortcuts}
            </div>
		{/foreach}
                    </div>
		<div class="shortcut-edit shortcut-new">
        	<div class="shortcut-colum shortcut_block">
                <div class="shortcut-link">
                    
                </div>
                <div class="shortcut-edit">
                    <input class="shortcut-input shortcut-input-name" maxlength="32" name="shortcut[][name]" placeholder="{$LNG.fl_shortcut_name}" type="text">
                    <div class="shortcut-delete" title="{$LNG.fl_dlte_shortcut}"></div>
                </div>
                <div class="shortcut-edit">
                    <input class="shortcut-input" name="shortcut[][galaxy]" value="" size="3" maxlength="2" placeholder="{$LNG.short_gals}" pattern="[0-9]*" type="text">:<input class="shortcut-input shortcut-input-system" name="shortcut[][system]" value="" size="3" maxlength="4" placeholder="{$LNG.short_syss}" pattern="[0-9]*" type="text">:<input class="shortcut-input" name="shortcut[][planet]" value="" size="3" maxlength="2" placeholder="{$LNG.short_pals}" pattern="[0-9]*" type="text">
                </div>
                <div class="shortcut-edit">
                    <select class="shortcut-input shortcut-input-type" name="shortcut[][type]">
                       {html_options options=$typeSelect}
                    </select>
                </div>
            </div>
		</div>
{/if}		
    </div>
    <div class="fleet_my_planet_kord shortcut-edit" style="line-height:25px; height:25px; text-align:center; width:226px;" onclick="AddShortcuts();return false">        	
        <span class="fleet_my_planet_kord_kord">{$LNG.fl_shortcut_add}</span>            
    </div>
    <div class="clear"></div>
	    
    <div class="gray_stripe build_band" style="height:22px;line-height:22px;color: #999;">
    	{$LNG.fl_my_planets}
    </div>
	{foreach $colonyList as $ColonyRow}
	<div class="fleet_my_planet_kord" onclick="setTarget({$ColonyRow.galaxy},{$ColonyRow.system},{$ColonyRow.planet},{$ColonyRow.type});updateVars();">
	{if $ColonyRow.type == 1}<img src="/styles/theme/gow/planeten/small/s_{$ColonyRow.image}.png" style="vertical-align: sub;height: 75%;">{/if}
            <span class="fleet_my_planet_kord_kord">[{$ColonyRow.galaxy}:{$ColonyRow.system}:{$ColonyRow.planet}]</span>
            <span class="fleet_my_planet_kord_name">{$ColonyRow.name} {if $ColonyRow.type == 3}{$LNG.fl_moon_shortcut}{/if}</span>
        </div>
	{/foreach}	
	
 <div class="clear"></div>
        <!--<div class="clear fleet_my_planet_kord_bigsepar"></div>-->
		
	{foreach $moonList as $ColonyRow}
	<div class="fleet_my_planet_kord" onclick="setTarget({$ColonyRow.galaxy},{$ColonyRow.system},{$ColonyRow.planet},{$ColonyRow.type});updateVars();">
	{if $ColonyRow.type == 3}<img src="/styles/theme/gow/planeten/small/moon.png" style="vertical-align: sub;height: 75%;">{/if}
            <span class="fleet_my_planet_kord_kord">[{$ColonyRow.galaxy}:{$ColonyRow.system}:{$ColonyRow.planet}]</span>
            <span class="fleet_my_planet_kord_name">&nbsp;{$ColonyRow.name}</span>
        </div>
	{/foreach}	
		
            <div class="clear"></div>
			
			
			{if $ACSList}
		 
	    <div class="gray_stripe build_band" style="height:22px;line-height:22px;color: #999;">
    	{$LNG.fl_acs_title}
    </div>
	
    <div id="fl_acs">
	{foreach $ACSList as $ACSRow}
	
				<div class="fleet_my_planet_kord" onclick="setACSTarget({$ACSRow.galaxy},{$ACSRow.system},{$ACSRow.planet},{$ACSRow.planet_type},{$ACSRow.id});">
				<img src="styles/images/iconav/frend.png" style="vertical-align: sub;height:65%;">
        	<span class="fleet_my_planet_kord_kord">[{$ACSRow.galaxy}:{$ACSRow.system}:{$ACSRow.planet}]</span>
            <span class="fleet_my_planet_kord_name">{$ACSRow.name}</span>
			{/foreach}
        </div>
		
		
            <div class="clear"></div></div>
			{/if}
			
	    <div class="gray_stripe build_band" style="padding:0; margin-top:10px;">
    	<input class="fl_bigbtn_go" value=" {$LNG.fl_continue} " type="submit">
    </div>
	</form>
</div>
<script type="text/javascript">
dm_fleettime			= {$dm_fleettime};
dm_fleettime_level		= {$dm_fleettime_level};
getActualDate			= {$getActualDate};
data			= {$fleetdata|json};
shortCutRows	= {$themeSettings.SHORTCUT_ROWS_ON_FLEET1};
fl_no_shortcuts	= '{$LNG.fl_no_shortcuts}';
fl_max_shortcuts= '{$LNG.backNotification_5}';
$(document).ready(updateVars());
function ListSector()
{
	$.getJSON('game.php?page=fleetStep1&mode=checkTargetACSMOD&groupAttackMod='+document.getElementsByName("fleet_group")[0].value+'&token='+document.getElementsByName("token")[0].value+'&duration='+document.getElementsByName("TIMING")[0].value, function(data) {
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
function ListBIS()
{
	$.getJSON('game.php?page=fleetStep1&mode=checkTargetACSMOD&groupAttackMod='+document.getElementsByName("fleet_group")[0].value+'&token='+document.getElementsByName("token")[0].value+'&duration='+document.getElementsByName("TIMING")[0].value, function(data) {
		if(data.OK == true) {
			$('#acsMax').html(data.maxacstime);
			$('#acsmaxTime').html(data.finalTime);
			$('#acsName').html(data.acsName);
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