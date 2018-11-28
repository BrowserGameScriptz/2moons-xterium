				<form action="?page=fleetTable&mode=saveHostileTemplate" method="post">
				<table class="tablesorter ally_ranks">
    	        <tbody>
				{if $showattack == 0}
				{if count($FleetsOnPlanetBattle) != 0}
				<tr>
        	<th colspan="3" class="gray_stripe piccolastriscia">{$LNG.fleetta_typ_1}</th>     
            <th style="padding:0;" class="gray_stripe piccolastriscia">            	
             	{*<a href="javascript:noShipsBatle();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsBatle();" class="fl_max_ships">Max</a>
           	</th>*}
        </tr>{/if}
		
		{foreach $FleetsOnPlanetBattle as $FleetRow}
                        <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info({$FleetRow.id})"><img src="./styles/theme/gow/gebaeude/{$FleetRow.id}.gif" alt="{$LNG.tech.{$FleetRow.id}}"></a></td>
            <td> {if $FleetRow.speed != 0}<span class="tooltip" data-tooltip-content="{$LNG.fl_speed_title} {$FleetRow.speed}" style="cursor:help;">{$LNG.tech.{$FleetRow.id}}</span>{else}{$LNG.tech.{$FleetRow.id}}{/if}</td>
            <td id="ship{$FleetRow.id}_value">{$FleetRow.count|number}</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	{*<div onclick="minShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_max">Max</div>*}
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship{$FleetRow.id}" id="ship{$FleetRow.id}_input" value="{$FleetRow.count2}">
               	</div>
            </td>
        </tr>
               {/foreach}
			   {/if}
			   {if $showtrans == 0}
			    {if count($FleetsOnPlanetTransport) != 0}
                        <tr>
        	<th colspan="4" class="gray_stripe">{$LNG.fleetta_typ_2}</th>     
           {* <th style="padding:0;" class="gray_stripe">            	
             	<a href="javascript:noShipsTransports();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsTransports();" class="fl_max_ships">Max</a>
           	</th>*}
        </tr>{/if}
                       {foreach $FleetsOnPlanetTransport as $FleetRow}
                        <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info({$FleetRow.id})"><img src="./styles/theme/gow/gebaeude/{$FleetRow.id}.gif" alt="{$LNG.tech.{$FleetRow.id}}"></a></td>
            <td> {if $FleetRow.speed != 0}<span class="tooltip" data-tooltip-content="{$LNG.fl_speed_title} {$FleetRow.speed}" style="cursor:help;">{$LNG.tech.{$FleetRow.id}}</span>{else}{$LNG.tech.{$FleetRow.id}}{/if}</td>
            <td id="ship{$FleetRow.id}_value">{$FleetRow.count|number}</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	{*<div onclick="minShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_max">Max</div>*}
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship{$FleetRow.id}" id="ship{$FleetRow.id}_input" value="{$FleetRow.count2}">
               	</div>
            </td>
        </tr>
               {/foreach}
			   {/if}
			   {if $showrecyc == 0}
			   {if count($FleetsOnPlanetProcessorcs) != 0}
			    <tr>
        	<th colspan="4" class="gray_stripe piccolastriscia">{$LNG.fleetta_typ_4}</th>     
            {*<th style="padding:0;" class="gray_stripe piccolastriscia">            	
             	<a href="javascript:noShipsProcessors();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsProcessors();" class="fl_max_ships">Max</a>
           	</th>*}
        </tr>{/if}
                       {foreach $FleetsOnPlanetProcessorcs as $FleetRow}
                        <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info({$FleetRow.id})"><img src="./styles/theme/gow/gebaeude/{$FleetRow.id}.gif" alt="{$LNG.tech.{$FleetRow.id}}"></a></td>
            <td> {if $FleetRow.speed != 0}<span class="tooltip" data-tooltip-content="{$LNG.fl_speed_title} {$FleetRow.speed}" style="cursor:help;">{$LNG.tech.{$FleetRow.id}}</span>{else}{$LNG.tech.{$FleetRow.id}}{/if}</td>
            <td id="ship{$FleetRow.id}_value">{$FleetRow.count|number}</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	{*<div onclick="minShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship{$FleetRow.id}');" class="fl_fllets_rows_input_max">Max</div>*}
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship{$FleetRow.id}" id="ship{$FleetRow.id}_input" value="{$FleetRow.count2}">
               	</div>
            </td>
        </tr>
               {/foreach}
			   {/if}
                 
			   
			<tr>
        	<th class="gray_stripe">{$LNG.autoexpedition_1}</th>     
        	<th class="gray_stripe">{$LNG.rs_amount}</th>     
        	<th class="gray_stripe">{$LNG.fl_hours}</th>     
        	<th class="gray_stripe">{$LNG.fl_speed_title}</th>     
			</tr>
			<tr>
        	<td><select name="isActive" class="seting_text" style="width:95%"> 
            <option value="0"{if $hasAutoHostileActiv == 0} selected{/if}>off</option>
            <option value="1"{if $hasAutoHostileActiv == 1} selected{/if}>{$LNG.sect_hostile_2}</option>
            <option value="2"{if $hasAutoHostileActiv == 2} selected{/if}>{$LNG.sect_hostile_3}</option>
            <option value="3"{if $hasAutoHostileActiv == 3} selected{/if}>{$LNG.sect_hostile_4}</option>
            <option value="5"{if $hasAutoHostileActiv == 5} selected{/if}>{$LNG.sect_hostile_6}</option>
            <option value="6"{if $hasAutoHostileActiv == 6} selected{/if}>{$LNG.sect_hostile_7}</option>
			</select></td>     
        	<td><input type="number" name="waveCount" class="seting_text" style="width:95%" value="{$hasAutoHostileWave}" min="1" max="{$maxExpedition}"></td>     
        	<td>{html_options name=stayTime options=$stayBlockHostile selected=$hasAutoHostileHoures}</td>     
        	<td><select name="speed" class="seting_text" style="width:95%"> 
            <option value="10"{if $hasAutoHostileSpeed == 10} selected{/if}>100%</option>
            <option value="9"{if $hasAutoHostileSpeed == 9} selected{/if}>90%</option>
            <option value="8"{if $hasAutoHostileSpeed == 8} selected{/if}>80%</option>
            <option value="7"{if $hasAutoHostileSpeed == 7} selected{/if}>70%</option>
            <option value="6"{if $hasAutoHostileSpeed == 6} selected{/if}>60%</option>
            <option value="5"{if $hasAutoHostileSpeed == 5} selected{/if}>50%</option>
            <option value="4"{if $hasAutoHostileSpeed == 4} selected{/if}>40%</option>
            <option value="3"{if $hasAutoHostileSpeed == 3} selected{/if}>30%</option>
            <option value="2"{if $hasAutoHostileSpeed == 2} selected{/if}>20%</option>
            <option value="1"{if $hasAutoHostileSpeed == 1} selected{/if}>10%</option>
			</select></td>     
			</tr>
     
        	
		                {if count($FleetsOnPlanet) != 0}
        <tr>
            <td colspan="4" style="padding:0;">
                <input class="fl_bigbtn_go" value="{$LNG.playerc_7}" type="submit" onclick="saveHostileTemplate();" style="margin-bottom:0px">
            </td>
        </tr>
         {/if}       
    </tbody></table></form>   