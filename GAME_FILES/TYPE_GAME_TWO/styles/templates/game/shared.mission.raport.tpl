{block name="title" prepend}{$pageTitle}{/block}
{block name="content"}
<div style="display: none;" id="tooltip" class="tip"></span></div>

<div id="content">
{if isset($InfoLOG)}
<div id="batle_top_nav">
    <div style="float:left; width:378px;" class="batle_party">
        <table>
            <tbody><tr>
                <td style="text-align:right; padding-right:7px; height:67px">{$InfoLOG.0}</td>
                <td style="width:32px;"><img alt="" title="" src="styles/images/att.png"></td>
            </tr>
        </tbody></table>
    </div>
    <div style="float:right" class="batle_party">
        <table>
            <tbody><tr>                            	
                <td style="width:30px;"><img alt="" title="" src="styles/images/def.png"></td>
                <td style="text-align:left; height:67px">{$InfoLOG.1}</td>
            </tr>
        </tbody></table>
    </div>                    
    <div id="batle_vs">
        {$Raport.time}
    </div>
</div> 
{/if}
<div id="raports">
{foreach $Raport.rounds as $Round => $RoundInfo}
<div class="batle_round" id="round_{$Round}">
    <div class="batle_part_att">
    	{foreach $RoundInfo.attacker as $Player}
		{$PlayerInfo = $Raport.players[$Player.userID]}        		        
        <div class="batle_mem">
            <div class="batle_mem_header">
            	<span>{$PlayerInfo.name}</span> 
                {if isset($InfoLOG)}([XX:XX:XX]){else}([{$PlayerInfo.koords[0]}:{$PlayerInfo.koords[1]}:{$PlayerInfo.koords[2]}]{if isset($PlayerInfo.koords[3])} ({$LNG.type_planet_short[$PlayerInfo.koords[3]]}){/if}){/if}<br>
				                	{$LNG.fl_bonus_attack} <span>+{$PlayerInfo.tech[0]}%</span> •
                	{$LNG.fl_bonus_shield} <span>+{$PlayerInfo.tech[1]}%</span> • 
                	{$LNG.cr_armor} <span>+{$PlayerInfo.tech[2]}%</span> 
                    <div class="batle_scan {if $RoundInfo@last}batle_scan_active{/if}"></div>
                            </div>
                        <div class="batle_mem_content" {if $RoundInfo@last}style="display:block;"{/if}>
   		    	            {if !empty($Player.ships)}   
							{foreach $Player.ships as $ShipID => $ShipData}
               	                <div class="batle_unit">
                    <div class="img_unit tooltip" style="cursor:help !important" data-tooltip-content="
                    <table>
                    	<tr>
                            <td style='color:#FC0; text-align:right !important;'>{$LNG.sys_ship_weapon}:</td>
                            <td style='text-align:right !important;'>{if $ShipData[5] != 1}<span  style='color:#F06666;'>{/if}{$ShipData[1]|number}{if $ShipData[5] != 1}</span>{/if}</td>
                        </tr>
                        <tr>
                            <td style='color:#FC0; text-align:right !important;'>{$LNG.sys_ship_shield}:</td>
                           <td style='text-align:right !important;'>{if $ShipData[6] != 1}<span  style='color:#5BB4DA;'>{/if}{$ShipData[2]|number}{if $ShipData[5] != 1}</span>{/if}</td>
                        </tr>
                        <tr>
                            <td style='color:#FC0; text-align:right !important;'>{$LNG.sys_ship_armour}:</td>
                            <td style='text-align:right !important;'>{$ShipData[3]|number}</td>
                        </tr>
                    </table>
                    ">
                        <img alt="" title="" src="styles/theme/gow/gebaeude/{$ShipID}.gif">
						{if $ShipData[5] != 1}<div class="ico_ka"></div>{/if}
                        {if $ShipData[6] != 1}<div class="ico_kd"></div>{/if}
                    </div>
                    <span class="name_unit"><span {if $ShipID == 224 || $ShipID == 229 || $ShipID == 230}style="color:#32CD32"{/if}>{$LNG.shortNames.{$ShipID}}</span></span><br>
                    {if $RoundInfo@last && $ShipID > 400}<span style="color:#7ad96a;">{$ShipData[0]|number}</span>{else}{$ShipData[0]|number}{/if}<br>
                    <span class="destruct_unit">
                    	                        	{if !$RoundInfo@last} {if $ShipData[4] != 0}-{/if}{($ShipData[4])|number} {/if}                  	                   	</span>
                </div>
				{/foreach}
				{/if}
               	                <div class="clear"></div>
            </div>
              
        </div>
		{/foreach}
            </div>
    <div class="batle_part_def">
    	  {foreach $RoundInfo.defender as $Player}
		{$PlayerInfo = $Raport.players[$Player.userID]}      		        
               <div class="batle_mem">
            <div class="batle_mem_header">
            	<span>{$PlayerInfo.name}</span> 
                {if isset($InfoLOG)}([XX:XX:XX]){else}([{$PlayerInfo.koords[0]}:{$PlayerInfo.koords[1]}:{$PlayerInfo.koords[2]}]{if isset($PlayerInfo.koords[3])} ({$LNG.type_planet_short[$PlayerInfo.koords[3]]}){/if}){/if}<br>
				                	{$LNG.fl_bonus_attack}  <span>+{$PlayerInfo.tech[0]}%</span> •
                	{$LNG.fl_bonus_shield} <span>+{$PlayerInfo.tech[1]}%</span> • 
                	{$LNG.cr_armor} <span>+{$PlayerInfo.tech[2]}%</span> 
                    <div class="batle_scan {if $RoundInfo@last}batle_scan_active{/if}"></div>
                            </div>
                        <div class="batle_mem_content" {if $RoundInfo@last}style="display:block;"{/if}>
   		    	            {if !empty($Player.ships)}   
							{foreach $Player.ships as $ShipID => $ShipData}
               	                <div class="batle_unit">
                    <div class="img_unit tooltip" style="cursor:help !important" data-tooltip-content="
                    <table>
                    	<tr>
                            <td style='color:#FC0; text-align:right !important;'>{$LNG.sys_ship_weapon}:</td>
                            <td style='text-align:right !important;'>{if $ShipData[5] != 1}<span  style='color:#F06666;'>{/if}{$ShipData[1]|number}{if $ShipData[5] != 1}</span>{/if}</td>
                        </tr>
                        <tr>
                            <td style='color:#FC0; text-align:right !important;'>{$LNG.sys_ship_shield}:</td>
                            <td style='text-align:right !important;'>{if $ShipData[6] != 1}<span  style='color:#5BB4DA;'>{/if}{$ShipData[2]|number}{if $ShipData[5] != 1}</span>{/if}</td>
                        </tr>
                        <tr>
                            <td style='color:#FC0; text-align:right !important;'>{$LNG.sys_ship_armour}:</td>
                            <td style='text-align:right !important;'>{$ShipData[3]|number}</td>
                        </tr>
                    </table>
                    ">
                        <img alt="" title="" src="styles/theme/gow/gebaeude/{$ShipID}.gif">
						{if $ShipData[5] != 1}<div class="ico_ka"></div>{/if}
                        {if $ShipData[6] != 1}<div class="ico_kd"></div>{/if}
                    </div>
                    <span class="name_unit"><span {if $ShipID == 224 || $ShipID == 229 || $ShipID == 230}style="color:#32CD32"{/if}>{$LNG.shortNames.{$ShipID}}</span></span><br>
                    {if $RoundInfo@last && $ShipID > 400}<img title="" class="tooltip" data-tooltip-content="After reconstruction" src="styles/images/iconav/report_tool.png" style="height: 11px;vertical-align: middle;margin-right: 3px;"/><span style="color:#7ad96a;" class="tooltip" data-tooltip-content="After reconstruction">{$ShipData[0]|number}</span>{else}{$ShipData[0]|number}{/if}<br>
                    <span class="destruct_unit">
                    	                        	{if !$RoundInfo@last} {if $ShipData[4] != 0}-{/if}{($ShipData[4])|number}     {/if}               	                   	</span>
                </div>
				{/foreach}
				{/if}
               	                <div class="clear"></div>
            </div>
              
        </div>
		{/foreach}
            </div> 



			
	<div class="batle_part_sep">
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div><!--/round-->

{if !$RoundInfo@last}
<div class="batle_round_info" onclick="RoundScan('#round_{$Round}');">
    <h2>{$Round+1}</h2>
    <h3>{$LNG.raport_1}</h3>
</div>
{/if}
{if !$RoundInfo@last}
<div class="band_att tooltip" style="cursor:help !important" data-tooltip-content="
	{$LNG.fleet_attack_1} {$RoundInfo.info[0]|number} {$LNG.fleet_attack_2} {$RoundInfo.info[3]|number} {$LNG.damage}<br>
{$LNG.fleet_defs_1} {$RoundInfo.info[2]|number} {$LNG.fleet_defs_2} {$RoundInfo.info[1]|number} {$LNG.damage}
">
    <div class="ico_part">
        <img alt="" title="" src="styles/images/att.png" />
    </div>
    <div class="ico_part" style="left:auto; right:5px;">
        <img alt="" title="" src="styles/images/def.png" />
    </div>
    <div class="left_part_att" style="width:{if {({$RoundInfo.info[0]|number} +{$RoundInfo.info[2]|number})}>0}{(100*({$RoundInfo.info[0]|number}))/{({$RoundInfo.info[0]|number} +{$RoundInfo.info[2]|number})}}{else}nan{/if}%">
        <div class="bsorb" style="width:{if {({$RoundInfo.info[3]|number} +{$RoundInfo.info[1]|number})}>0}{(50*({$RoundInfo.info[3]|number}))/{({$RoundInfo.info[3]|number} +{$RoundInfo.info[1]|number})}}{else}nan{/if}%">
            <div class="bsorb_end"></div>
            <div class="bsorb_mid"></div>
        </div>    </div>
    <div class="left_part_def" style="width:{if {({$RoundInfo.info[0]|number} +{$RoundInfo.info[2]|number})}>0}{(100*({$RoundInfo.info[2]|number}))/{({$RoundInfo.info[0]|number} +{$RoundInfo.info[2]|number})}}{else}nan{/if}%">
	<div class="bsorb" style="width:{if {({$RoundInfo.info[3]|number} +{$RoundInfo.info[1]|number})}>0}{(50*({$RoundInfo.info[1]|number}))/{({$RoundInfo.info[3]|number} +{$RoundInfo.info[1]|number})}}{else}nan{/if}%">
            <div class="bsorb_end"></div>
            <div class="bsorb_mid"></div>
        </div> 
            </div>
</div>
{else}
<div class="batle_round_info" onclick="RoundScan('#round_{$Round}');">
		{if $Raport.result == "a"}  
			<h2 style="color:#45a000">{$LNG.sys_attacker_won}</h2><br>
			{elseif $Raport.result == "r"}
			<h2>{$LNG.sys_defender_won}</h2>
			{else}
			<h2>{$LNG.sys_both_won}</h2>
			{/if}
	</div>	
{/if}

	
    {/foreach}

    <div class="band_itog tooltip" style="cursor:help !important" data-tooltip-content="
    	{$LNG.sys_attacker_lostunits} {$Raport['units'][0]|number} {$LNG.sys_units}  <br>
    	{$LNG.sys_defender_lostunits} {$Raport['units'][1]|number} {$LNG.sys_units} 
    ">
        <div class="ico_part">
            <img alt="" title="" src="styles/images/att.png">
        </div>
        <div class="ico_part" style="left:auto; right:5px;">
            <img alt="" title="" src="styles/images/def.png">
        </div>
        <div class="left_part_att" style="width:{if {({$Raport['units'][0]|number} +{$Raport['units'][1]|number})}>0}{100/($Raport['units'][0]+$Raport['units'][1])*$Raport['units'][0]}{else}50{/if}%">
        </div>
        <div class="left_part_def" style="width:{if {({$Raport['units'][0]|number} +{$Raport['units'][1]|number})}>0}{100/($Raport['units'][0]+$Raport['units'][1])*$Raport['units'][1]}{else}50{/if}%">
        </div>
		
	
    </div>
    
    <div class="batle_text">    
         
            {if $Raport.mode == 1}
	{* Destruction *}
	{if $Raport.moon.moonDestroySuccess == -1}
		{* Attack not win *}
		{$LNG.sys_destruc_stop}<br>
	{else}
		{* Attack win *}
		{sprintf($LNG.sys_destruc_lune, "{$Raport.moon.moonDestroyChance}")}<br>{$LNG.sys_destruc_mess1}
		{if $Raport.moon.moonDestroySuccess == 1}
			{* Destroy success *}
			{$LNG.sys_destruc_reussi}
		{elseif $Raport.moon.moonDestroySuccess == 0}
			{* Destroy failed *}
			{$LNG.sys_destruc_null}			
		{/if}
		<br>
		{sprintf($LNG.sys_destruc_rip, "{$Raport.moon.fleetDestroyChance}")}
		{if $Raport.moon.fleetDestroySuccess == 1}
			{* Fleet destroyed *}
			<br>{$LNG.sys_destruc_echec}
		{/if}			
	{/if}
{else}
	{* Normal Attack *}
	{if !empty($Raport.moon.moonName)}
		{if isset($Info)}
			{* Moon created (HoF Mode) *}
			{sprintf($LNG.sys_moonbuilt, "{$Raport.moon.moonName}", "XX", "XX", "XX")}
		{else}
			{* Moon created *}
			{sprintf($LNG.sys_moonbuilt, "{$Raport.moon.moonName}", "{$Raport.koords[0]}", "{$Raport.koords[1]}", "{$Raport.koords[2]}")}
		{/if}
	{/if}
{/if}
         
    </div>  
	

</div>
<div id="results" class="clearfix" style="display: block;">
			<div id="results-top-row" class="clearfix">
{*<div id="simulation-result" class="result-table"> 
					<table>
						<thead><tr><th colspan="3" style="-moz-border-radius: 4px 4px 0px 0px;-webkit-border-radius: 4px 4px 0px 0px;border-radius: 4px 4px 0px 0px;">{$LNG.report_table_1}</th></tr></thead>
						<tbody>	
							<tr>
								<td class="fixed">{$LNG.report_table_2}</td>
								<td id="result-wins-attackers">{if {({$Raport['units'][0]|number} +{$Raport['units'][1]|number})}>0}{(100*({$Raport['units'][0]|number}))/{({$Raport['units'][0]|number} +{$Raport['units'][1]|number})}}{else}50{/if}%</td>
							</tr>
							<tr>
								<td class="fixed">{$LNG.report_table_3}</td>
								<td id="result-wins-defenders">{if {({$Raport['units'][0]|number} +{$Raport['units'][1]|number})}>0}{(100*({$Raport['units'][1]|number}))/{({$Raport['units'][0]|number} +{$Raport['units'][1]|number})}}{else}50{/if}%</td>
							</tr>
							<tr>
								<td class="fixed">{$LNG.report_table_4}</td>
								<td id="result-wins-draw">0%</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th>{$LNG.report_table_5}</th>
								<td id="result-rounds">~ {$Raport.lastRound}</td>
							</tr>
							
							<tr>
								<th class="fixed">{$LNG.report_table_6}:</th>
								<td id="result-retreat"><span id="result-retreat-attacker">7.5</span> : <span id="result-retreat-defender">1</span></td>
							</tr>
							
						</tfoot>
					</table>
				</div>*}
				<div class="result-table" style="width:49%">
					
					<table class="resource-table">
						<thead><tr><th colspan="4" style="-moz-border-radius: 4px 4px 0px 0px;-webkit-border-radius: 4px 4px 0px 0px;border-radius: 4px 4px 0px 0px;">{$LNG.report_table_7}</th></tr><tr><th colspan="2">{$LNG.report_table_8}</th><th stt-id="stt-0" colspan="2" id="result-attackers-profit" class="tooltip-hover">{$LNG.report_table_9} *</th></tr></thead>
						<tbody>
							<tr>
								<td><div class="resource resource-metal"></div></td>
								<td id="result-attackers-losses-metal">{$Raport.totallost901|number}</td>
								<td><div class="resource resource-metal"></div></td>
								<td class="{if ($Raport.totallost901+$Raport.debris901) >= 0}profit{else}loss{/if}" id="result-attackers-profit-metal">{($Raport.totallost901+$Raport.debris901)|number}</td>
							</tr>
							<tr>
								<td><div class="resource resource-crystal"></div></td>
								<td id="result-attackers-losses-crystal">{$Raport.totallost902|number}</td>
								<td><div class="resource resource-crystal"></div></td>
								<td class="{if ($Raport.totallost902+$Raport.debris902) >= 0}profit{else}loss{/if}" id="result-attackers-profit-crystal">{($Raport.totallost902+$Raport.debris902)|number}</td>
							</tr>
							<tr>
								<td><div class="resource resource-deuterium"></div></td>
								<td id="result-attackers-losses-deuterium">{$Raport.totallost903|number}</td>
								<td><div class="resource resource-deuterium"></div></td>
								<td class="{if ($Raport.totallost903) >= 0}profit{else}loss{/if}" id="result-attackers-profit-deuterium">{$Raport.totallost903|number}</td>
							</tr>
						</tbody>
						<tfoot>
							<tr class="total">
								<td><div class="fixed resource-total">=</div></td>
								<td id="result-attackers-losses-total">{($Raport['units'][0]-($Raport.totallost903))|number}</td>
								<td><div class="fixed resource-total">=</div></td>
								<td class="{if (($Raport.totallost901+$Raport.debris901)+($Raport.totallost902+$Raport.debris902)+($Raport.totallost903)) > 0}profit{else}loss{/if}" id="result-attackers-profit-total">{(($Raport.totallost901+$Raport.debris901)+($Raport.totallost902+$Raport.debris902)+$Raport.totallost903)|number}</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="result-table" style="width:49%">
					
					<table class="resource-table">
						<thead><tr><th colspan="4" style="-moz-border-radius: 4px 4px 0px 0px;-webkit-border-radius: 4px 4px 0px 0px;border-radius: 4px 4px 0px 0px;">{$LNG.report_table_10}</th></tr><tr><th colspan="2">{$LNG.report_table_8}</th><th stt-id="stt-1" colspan="2" id="result-defenders-profit" class="tooltip-hover">{$LNG.report_table_9} *</th></tr></thead>
						<tbody>
							<tr>
								<td><div class="resource resource-metal"></div></td>
								<td id="result-defenders-losses-metal">{$Raport.totallost901d|number}</td>
								<td><div class="resource resource-metal"></div></td>
								<td class="{if ($Raport.totallost901d+$Raport.debris901) >= 0}profit{else}loss{/if}" id="result-defenders-profit-metal">{($Raport.totallost901d+$Raport.debris901)|number}</td>
							</tr>
							<tr>
								<td><div class="resource resource-crystal"></div></td>
								<td id="result-defenders-losses-crystal">{$Raport.totallost902d|number}</td>
								<td><div class="resource resource-crystal"></div></td>
								<td class="{if ($Raport.totallost902d+$Raport.debris902) >= 0}profit{else}loss{/if}" id="result-defenders-profit-crystal">{($Raport.totallost902d+$Raport.debris902)|number}</td>
							</tr>
							<tr>
								<td><div class="resource resource-deuterium"></div></td>
								<td id="result-defenders-losses-deuterium">{$Raport.totallost903d|number}</td>
								<td><div class="resource resource-deuterium"></div></td>
								<td class="{if ($Raport.totallost903d) >= 0}profit{else}loss{/if}" id="result-defenders-profit-deuterium">{$Raport.totallost903d|number}</td>
							</tr>
						</tbody>
						<tfoot>
							<tr class="total">
								<td><div class="fixed resource-total">=</div></td>
								<td id="result-defenders-losses-total">{($Raport['units'][1]-($Raport.totallost903d))|number}</td>
								<td><div class="fixed resource-total">=</div></td>
								<td class="{if (($Raport.totallost901d+$Raport.debris901)+($Raport.totallost902d+$Raport.debris902)+($Raport.totallost903d)) > 0}profit{else}loss{/if}" id="result-defenders-profit-total">{(($Raport.totallost901d+$Raport.debris901)+($Raport.totallost902d+$Raport.debris902)+$Raport.totallost903d)|number}</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			
			<div id="results-bottom-row" class="clearfix">
				<div class="result-table">
					<table>
						<thead><tr></tr><tr><th colspan="2" style="-moz-border-radius: 4px 0px 0px 0px;-webkit-border-radius: 4px 0px 0px 0px;border-radius: 4px 0px 0px 0px;">{$LNG.report_table_21}</th><th style="-moz-border-radius: 0px 4px 0px 0px;-webkit-border-radius: 0px 4px 0px 0px;border-radius: 0px 4px 0px 0px;">{$LNG.report_table_12}</th></tr></thead>
						<tbody>	
							<tr>
								<td><div class="resource resource-metal"></div></td>
								<td id="result-debris-metal">{$Raport.debris901|number}</td>
								<td rowspan="3" id="result-moonchance" class="{if !empty($Raport.moon.moonName)}profit{else}loss{/if}">{$Raport.moon.moonChance}%</td>
							</tr>
							<tr>
								<td><div class="resource resource-crystal"></div></td>
								<td id="result-debris-crystal">{$Raport.debris902|number}</td>
							</tr>
							<tr class="total">
								<td><div class="fixed resource-total">=</div></td>
								<td id="result-debris-total">{($Raport.debris901 + $Raport.debris902)|number}</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" id="result-recyclers">{$Raport.additionalInfo10|number}</td>
								<th class="fixed">{$LNG.report_table_13}</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<div id="result-table-plunder" class="result-table">
					<table class="resource-table">
						<thead><tr></tr><tr><th colspan="2" style="-moz-border-radius: 4px 0px 0px 0px;-webkit-border-radius: 4px 0px 0px 0px;border-radius: 4px 0px 0px 0px;">{$LNG.report_table_15}</th><th colspan="2">{$LNG.report_table_16}</th><th colspan="2" style="-moz-border-radius: 0px 4px 0px 0px;-webkit-border-radius: 0px 4px 0px 0px;border-radius: 0px 4px 0px 0px;">{$LNG.report_table_17}</th></tr></thead>
						<tbody>
							<tr>
								<td><div class="resource resource-metal"></div></td>
								{foreach $Raport.steal as $elementID => $amount}
								{if $elementID == 901}
								<td id="result-attackers-plunder-metal">{$amount|number}</td>
								{/if}
								{/foreach}
								<td><div class="resource resource-metal"></div></td>
								<td id="result-possible-plunder-metal">{$Raport.additionalInfo4|number}</td>
								<td id="result-cargos-small">{$Raport.additionalInfo1|number}</td>
								<td>{$LNG.tech.202}</td>
							</tr>
							<tr>
								<td><div class="resource resource-crystal"></div></td>
								{foreach $Raport.steal as $elementID => $amount}
								{if $elementID == 902}
								<td id="result-attackers-plunder-crystal">{$amount|number}</td>
								{/if}
								{/foreach}
								<td><div class="resource resource-crystal"></div></td>
								<td id="result-possible-plunder-crystal">{$Raport.additionalInfo5|number}</td>
								<td id="result-cargos-large">{$Raport.additionalInfo2|number}</td>
								<td>{$LNG.tech.203}</td>
							</tr>
							<tr>
								<td><div class="resource resource-deuterium"></div></td>
								{foreach $Raport.steal as $elementID => $amount}
								{if $elementID == 903}
								<td id="result-attackers-plunder-deuterium">{$amount|number}</td>
								{/if}
								{/foreach}
								<td><div class="resource resource-deuterium"></div></td>
								<td id="result-possible-plunder-deuterium">{$Raport.additionalInfo6|number}</td>
								<td id="result-cargos-battle">{$Raport.additionalInfo3|number}</td>
								<td>{$LNG.tech.217}</td>
							</tr>
						</tbody>
						<tfoot>
							<tr class="total">
								<td><div class="fixed resource-total">=</div></td>
								{foreach $Raport.steal as $elementID => $amount}
								{if $elementID == 903}
								<td id="result-attackers-plunder-total">0</td>
								{/if}
								{/foreach}
								<td><div class="fixed resource-total">=</div></td>
								<td id="result-possible-plunder-total">{($Raport.additionalInfo6 + $Raport.additionalInfo5 + $Raport.additionalInfo4)|number}</td>
								<td id="result-plunder-captured">0%</td>
								<td>{$LNG.report_table_15}</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		{*{if $userID == 1 or $userID == 10283}
		<h2 style="color:#45a000;float:left">combat attacker : 0</h2>
		<h2 style="color:#45a000;float:right">combat defender 0</h2>
		{/if}*}
{if $Raport.simulate == 0}


<div class="comments-container">
 <ul id="comments-list" class="comments-list">
 
 

  
  
  
  <li>
                <div class="comment-main-level">
                    <!-- Avatar -->
                    <div class="comment-avatar"><img src="media/files/{$uAvatar}" alt=""></div>
                    <!-- Contenedor del Comentario -->
                    <div class="comment-box">
					<div class="comment-content">
                              <form id="form" method="post">
    <!-- need to supply post id with hidden fild -->
    <input type="hidden" name="encoded_secret" value="{$encrypted_txt}">
    <label>
      <textarea name="comment" id="comment" cols="30" rows="5" placeholder="{$LNG.mg_empty_text}..." required style="background-color: #000111;"></textarea>
    </label>
</div>
                        <div class="comment-head barracorta">
						    <input type="submit" id="submit" value="{$LNG.mg_send}" class="pulsante">
                        </div>
                          </form>
                    </div>
                </div>
            </li>
			
			
			
          </ul>
    </div>
<div class="post">
</div>
  
  
<div class="comment-block">
</div>



<div class="comments-container">

 <ul id="comments-list" class="comments-list">
 		{foreach $COMMENTDATA as $COMMENT}
            <li>
                <div class="comment-main-level">
                    <!-- Avatar -->
                    <div class="comment-avatar"><img src="media/files/{$COMMENT.avatar}" alt=""></div>
                    <!-- Contenedor del Comentario -->
                    <div class="comment-box">
                        <div class="comment-head">
                            <h6 class="comment-name"><a href="#">{$COMMENT.name}</a> {if !empty($COMMENT.alliance)}<span class="alleanza">{$COMMENT.alliance}</span>{/if} {if $COMMENT.replyToComment != 0}replied to Odiabile{/if}</h6> 
                            <span >{$COMMENT.commentDate}</span> <span id="youFlagged_{$COMMENT.commendId}">{if !empty($COMMENT.alreadyFlagged)}  {$LNG.hofComment_6}{/if}</span>
                            <span id="immagine_{$COMMENT.commendId}" class="immagine" {if !empty($COMMENT.alreadyLiked)} style="opacity:1;"{/if}><img src="styles/images/iconav/report-like.png"  id="like_{$COMMENT.commendId}" class="like tooltip" data-tooltip-content="{$LNG.hofComment_4}"><span id="likes_{$COMMENT.commendId}" style="color: #5ca6aa;font-size: 13px;font-weight: bold;float: right;margin-left: 3px;">{$COMMENT.likeCount}</span></span>
							{*<span class="immagine"><img src="styles/images/iconav/report-reply.png" onclick="toggle_visibility('quick_reply');"></span>*}
							<span class="immagine" {if !empty($COMMENT.alreadyFlagged)}style="opacity:1;"{/if} id="immagines_{$COMMENT.commendId}"><img src="styles/images/iconav/complaint.png" onclick="flagComment({$COMMENT.commendId});" class="tooltip" data-tooltip-content="{$LNG.hofComment_2}" ></span>
							{if $authlevel > 1}<span class="immagine"><img src="styles/images/iconav/delmsg.png" class="tooltip" data-tooltip-content="{$LNG.hofComment_3}"></span>{/if}
                        </div>
                        <div class="comment-content" id="content_{$COMMENT.commendId}">
                            {$COMMENT.comment} 
                        </div>
						
						{*<div id="quick_reply_{$COMMENT.commendId}" style="display: none;">
							<div class="comment-box">
							<div class="comment-content">
									  <form id="form" method="post">
									<!-- need to supply post id with hidden fild -->
									<input type="hidden" name="encoded_secret" value="{$encrypted_txt}">
									<label>
									  <textarea name="comment" id="comment" cols="30" rows="5" placeholder="{$LNG.hofComment_1}..." required style="background-color: #000111;"></textarea>
									</label>
								</div>
								<div class="comment-head barracorta">
									<input type="submit" id="submit" value="{$LNG.hofComment_1}" class="pulsante">
								</div>
								  </form>
							</div>
						</div>*}
                    </div>
                </div>
            </li>
{/foreach}
          
        </ul>
		{if $MessageCount > 0}<div class="message_page_navigation">
        {$LNG.mg_page}: 
		{if $page != 1}<a href="?page=raport&mode=battleHall&raport={$RID}&site={$page - 1}">«</a>&nbsp;{/if}{for $site=1 to $maxPage}<a href="?page=raport&mode=battleHall&raport={$RID}&site={$site}" >{if $site == $page}<span class="active_page">[{$site}]</span>{else}[{$site}]{/if}</a>{if $site != $maxPage}&nbsp;{/if}{/for}&nbsp;<a href="?page=raport&mode=battleHall&raport={$RID}&site={$page + 1}">»</a>
		</div>{/if}
    </div>
{/if}	
</div>
</div>

            <div class="clear"></div>  
	
            </div>         
        <!--/body-->
{/block} 
{block name="script" append}
<script charset="UTF-8" type="text/javascript" src="./scripts/game/comments.js?5.9"></script>
<link rel="stylesheet" type="text/css" href="styles/css/batle.css?{$REV}">
<script type="text/javascript">
	var hofComment_5	= "{$LNG.hofComment_5}";
	var hofComment_6	= "{$LNG.hofComment_6}";
	$(document).ready(function(){		
		$('.batle_scan').click(function(){ 
			$(this).toggleClass('batle_scan_active');
			$(this).parent().parent().find(".batle_mem_content").stop(true, false).slideToggle(300);
		});		
	});
	function RoundScan(idSelect)
	{
		$(String(idSelect)).find(".batle_scan").stop(true, false).toggleClass('batle_scan_active');
		$(String(idSelect)).find(".batle_mem_content").stop(true, false).slideToggle(300);
	};
	function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
</script>
{/block}