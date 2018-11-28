				<form action="?page=fleetStep1" method="post">
				<input type="hidden" name="galaxy" value="{$targetGalaxy}">
				<input type="hidden" name="system" value="{$targetSystem}">
				<input type="hidden" name="planet" value="{$targetPlanet}">
				<input type="hidden" name="type" value="{$targetType}">
				<input type="hidden" name="target_mission" value="{$targetMission}">
				<table class="tablesorter ally_ranks">
    	        <tbody>
				{if $showattack == 0}
				{if count($FleetsOnPlanetBattle) != 0}
				<tr>
        	<th colspan="3" class="gray_stripe piccolastriscia">{$LNG.fleetta_typ_1}</th>     
            <th style="padding:0;" class="gray_stripe piccolastriscia">            	
             	<a href="javascript:noShipsBatle();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsBatle();" class="fl_max_ships">Max</a>
           	</th>
        </tr>{/if}
		
		{foreach $FleetsOnPlanetBattle as $FleetRow}
                        <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info({$FleetRow.id})"><img src="./styles/theme/gow/gebaeude/{$FleetRow.id}.gif" alt="{$LNG.tech.{$FleetRow.id}}"></a></td>
            <td> {if $FleetRow.speed != 0}<span class="tooltip" data-tooltip-content="{$LNG.fl_speed_title} {$FleetRow.speed}" style="cursor:help;">{$LNG.tech.{$FleetRow.id}}</span>{else}{$LNG.tech.{$FleetRow.id}}{/if}</td>
            <td id="ship{$FleetRow.id}_value">{$FleetRow.count|number}</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship{$FleetRow.id}" id="ship{$FleetRow.id}_input" value="0">
               	</div>
            </td>
        </tr>
               {/foreach}
			   {/if}
			   {if $showtrans == 0}
			    {if count($FleetsOnPlanetTransport) != 0}
                        <tr>
        	<th colspan="3" class="gray_stripe">{$LNG.fleetta_typ_2}</th>     
            <th style="padding:0;" class="gray_stripe">            	
             	<a href="javascript:noShipsTransports();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsTransports();" class="fl_max_ships">Max</a>
           	</th>
        </tr>{/if}
                       {foreach $FleetsOnPlanetTransport as $FleetRow}
                        <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info({$FleetRow.id})"><img src="./styles/theme/gow/gebaeude/{$FleetRow.id}.gif" alt="{$LNG.tech.{$FleetRow.id}}"></a></td>
            <td> {if $FleetRow.speed != 0}<span class="tooltip" data-tooltip-content="{$LNG.fl_speed_title} {$FleetRow.speed}" style="cursor:help;">{$LNG.tech.{$FleetRow.id}}</span>{else}{$LNG.tech.{$FleetRow.id}}{/if}</td>
            <td id="ship{$FleetRow.id}_value">{$FleetRow.count|number}</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship{$FleetRow.id}" id="ship{$FleetRow.id}_input" value="0">
               	</div>
            </td>
        </tr>
               {/foreach}
			   {/if}
			   {if $showrecyc == 0}
			   {if count($FleetsOnPlanetProcessorcs) != 0}
			    <tr>
        	<th colspan="3" class="gray_stripe piccolastriscia">{$LNG.fleetta_typ_4}</th>     
            <th style="padding:0;" class="gray_stripe piccolastriscia">            	
             	<a href="javascript:noShipsProcessors();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsProcessors();" class="fl_max_ships">Max</a>
           	</th>
        </tr>{/if}
                       {foreach $FleetsOnPlanetProcessorcs as $FleetRow}
                        <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info({$FleetRow.id})"><img src="./styles/theme/gow/gebaeude/{$FleetRow.id}.gif" alt="{$LNG.tech.{$FleetRow.id}}"></a></td>
            <td> {if $FleetRow.speed != 0}<span class="tooltip" data-tooltip-content="{$LNG.fl_speed_title} {$FleetRow.speed}" style="cursor:help;">{$LNG.tech.{$FleetRow.id}}</span>{else}{$LNG.tech.{$FleetRow.id}}{/if}</td>
            <td id="ship{$FleetRow.id}_value">{$FleetRow.count|number}</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship{$FleetRow.id}" id="ship{$FleetRow.id}_input" value="0">
               	</div>
            </td>
        </tr>
               {/foreach}
			   {/if}
			   {if $showproce == 0}
               {if count($FleetsOnPlanetSpecial) != 0}
                                        <tr>
        	<th colspan="3" class="gray_stripe piccolastriscia">{$LNG.fleetta_typ_3}</th>     
            <th style="padding:0;" class="gray_stripe piccolastriscia">            	
             	<a href="javascript:noShipsSpecial();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsSpecial();" class="fl_max_ships">Max</a>
           	</th>
        </tr>
               {/if}        {foreach $FleetsOnPlanetSpecial as $FleetRow}
                        <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info({$FleetRow.id})"><img src="./styles/theme/gow/gebaeude/{$FleetRow.id}.gif" alt="{$LNG.tech.{$FleetRow.id}}"></a></td>
            <td> {if $FleetRow.speed != 0}<span class="tooltip" data-tooltip-content="{$LNG.fl_speed_title} {$FleetRow.speed}" style="cursor:help;">{$LNG.tech.{$FleetRow.id}}</span>{else}{$LNG.tech.{$FleetRow.id}}{/if}</td>
            <td id="ship{$FleetRow.id}_value">{$FleetRow.count|number}</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship{$FleetRow.id}" id="ship{$FleetRow.id}_input" value="0">
               	</div>
            </td>
        </tr>
		
               {/foreach}
			   {/if}
                {if count($FleetsOnPlanet) != 0}
                        <tr>     
        	<th colspan="2" style="text-align:center;" class="gray_stripe"><a href="javascript:onSave();" style="color:#666;">{$LNG.fl_register_shorcut} {$LNG.grove_ship}</a></th>            	      
        	<th colspan="1" style="text-align:center;" class="gray_stripe"><a href="javascript:maxShips();" style="color:#666;">{$LNG.fl_select_all_ships}</a></th>        	  
            <th colspan="1" style="text-align:center;" class="gray_stripe"><a href="javascript:noShips();" style="color:#666;">{$LNG.fl_remove_all_ships}</a></th>           
        </tr>
        <tr style="display:none;" id="save">
        	<td colspan="3" style="text-align:right; color:#CCC;">{$LNG.fleetta_sho_name}</td>
            <td colspan="1"><input name="save_groop" size="15" maxlength="13" style="width:96%;"></td>
        </tr>    
		
        <tr>
            <td colspan="4" style="padding:0;">
                <input class="fl_bigbtn_go" value="{$LNG.fl_continue}" type="submit" style="margin-bottom:0px">
            </td>
        </tr>
         {/if}       
    </tbody></table></form>   