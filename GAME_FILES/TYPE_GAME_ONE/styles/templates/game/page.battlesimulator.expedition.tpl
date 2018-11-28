{block name="title" prepend}{$LNG.lm_battlesim}{/block}
{block name="content"}
<div id="page">
	<div id="content">
		<div id="ally_content" class="conteiner">
			<div class="gray_stripe">
				<span style="float:left;color:#6ccdce;">Expedition Simulator</span>
				<span style="float:right;color:#6ccdce;"><span class="totalFleetPoints">0</span> {$LNG.fleetta_point_fle}</span>
			</div>
			<form id="form">
			<div class="ally_contents" style="padding-bottom:5px;">
				<div class="content_box" style="display: flex;">
					<label class="left_label" style="width: 180px;">Type of Simulation</label>
					<select name="expeditionType" id="expeditionType" class="big_seting_text" style="width: 388px;"> 
						<option value="1">Resource Expedition</option>
						<option value="2">Fleed Expedition</option>
						<option value="3">Dark Matter Expedition</option>
						<option value="4">Arsenal Expedition</option>
						{*<option value="5">Combat Expedition</option>
						<option value="6">Black Hole Expedition</option>
						<option value="7">Time Change Expedition</option>
						<option value="8">Resource Change Expedition</option>
						<option value="9">Cosmonaute, Haloween, New Year Expedition</option>*}
					</select>
					<div class="clear"></div> 
				</div>
			</div>
			<div class="gray_stripe">
				<span style="float:left;color:#6ccdce;">Select Fleets</span>
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
</script>
	
        	{/if}
			<table class="tablesorter ally_ranks">
    	        <tbody>
												{if count($FleetsOnPlanetBattle) != 0}<tr>
        	<th colspan="3" class="gray_stripe piccolastriscia">{$LNG.fleetta_typ_1}</th>     
            <th style="padding:0;" class="gray_stripe piccolastriscia">            	
             	<a href="javascript:noShipsBatle();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsBatle();" class="fl_max_ships">Max</a>
           	</th>
        </tr>{/if}
		                        {foreach $FleetsOnPlanetBattle as $FleetRow}<tr class="fl_fllets_rows">
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
        </tr>{/foreach}
                                      
               			   			   			                            {if count($FleetsOnPlanetTransport) != 0}<tr>
        	<th colspan="3" class="gray_stripe">{$LNG.fleetta_typ_2}</th>     
            <th style="padding:0;" class="gray_stripe">            	
             	<a href="javascript:noShipsTransports();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsTransports();" class="fl_max_ships">Max</a>
           	</th>
        </tr>{/if}                                              {foreach $FleetsOnPlanetTransport as $FleetRow} <tr class="fl_fllets_rows">
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
        </tr{/foreach}
							{if count($FleetsOnPlanetProcessorcs) != 0}<tr>
        	<th colspan="3" class="gray_stripe piccolastriscia">{$LNG.fleetta_typ_4}</th>     
            <th style="padding:0;" class="gray_stripe piccolastriscia">            	
             	<a href="javascript:noShipsSpecial();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsSpecial();" class="fl_max_ships">Max</a>
           	</th>
        </tr>{/if}
                                                {foreach $FleetsOnPlanetProcessorcs as $FleetRow}<tr class="fl_fllets_rows">
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
        </tr>{/foreach}
        <tr>
            <td colspan="4" style="padding:0;">
                <input class="fl_bigbtn_go" value="Simulate Expedition" style="margin-bottom:0px" onclick="simulateExpo();return false;" name="sendButton" id="sendButton" type="submit">
			</td>
        </tr>
                
    </tbody></table>
		</div></form>
	</div>
</div>
{/block}
{block name="script" append}
<script type="text/javascript">
	var pointsPrice = { "ship202":0.004,"ship203":0.012,"ship204":0.004,"ship205":0.011,"ship206":0.0265,"ship207":0.058,"ship208":0.04,"ship209":0.018,"ship210":0.001,"ship211":0.12,"ship212":0.0025,"ship213":0.125,"ship214":10.5,"ship215":0.1,"ship216":12.5,"ship217":0.0565,"ship218":500,"ship219":1.8,"ship220":16,"ship221":580,"ship222":360,"ship223":5.625,"ship224":0.15,"ship225":1.8,"ship226":5.2,"ship227":42,"ship228":127,"ship229":0.0105,"ship230":27.75 };
</script>
{/block}