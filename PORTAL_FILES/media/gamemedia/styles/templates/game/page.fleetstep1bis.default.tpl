{block name="title" prepend}{$LNG.lm_fleet}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
    	{$LNG.fl_send_fleet}
    </div>
	<table class="tablesorter ally_ranks">
		<tbody>
		
		<tr style="height:20px;">
			<td style="text-align:right;">Start Coordinates</td>
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
			<td style="text-align:right;">End Coordinates</td>
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
	<table class="tablesorter ally_ranks">
    	        <tbody>
				
								<tr>
        	<th colspan="3" class="gray_stripe piccolastriscia">Battle fleet</th>     
            <th style="padding:0;" class="gray_stripe piccolastriscia">            	
             	<a href="javascript:noShipsBatle();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsBatle();" class="fl_max_ships">Max</a>
           	</th>
        </tr>		
		                        <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(204)"><img src="./styles/theme/gow/gebaeude/204.gif" alt="Light Fighter"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  23000" style="cursor:help;">Light Fighter</span></td>
            <td id="ship204_value">669.024</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship204');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship204');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship204" id="ship204_input" value="0">
               	</div>
            </td>
        </tr>
                                       <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(205)"><img src="./styles/theme/gow/gebaeude/205.gif" alt="Heavy Fighter"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  18400" style="cursor:help;">Heavy Fighter</span></td>
            <td id="ship205_value">519.245</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship205');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship205');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship205" id="ship205_input" value="0">
               	</div>
            </td>
        </tr>
                                       <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(206)"><img src="./styles/theme/gow/gebaeude/206.gif" alt="Cruiser"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  27600" style="cursor:help;">Cruiser</span></td>
            <td id="ship206_value">426.922</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship206');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship206');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship206" id="ship206_input" value="0">
               	</div>
            </td>
        </tr>
                                       <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(207)"><img src="./styles/theme/gow/gebaeude/207.gif" alt="Battleship"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  11500" style="cursor:help;">Battleship</span></td>
            <td id="ship207_value">76.303</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship207');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship207');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship207" id="ship207_input" value="0">
               	</div>
            </td>
        </tr>
                                       <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(215)"><img src="./styles/theme/gow/gebaeude/215.gif" alt="Battle Cruiser"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  11500" style="cursor:help;">Battle Cruiser</span></td>
            <td id="ship215_value">741.714</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship215');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship215');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship215" id="ship215_input" value="0">
               	</div>
            </td>
        </tr>
                                       <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(224)"><img src="./styles/theme/gow/gebaeude/224.gif" alt="M-19"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  8050" style="cursor:help;">M-19</span></td>
            <td id="ship224_value">1.537.590</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship224');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship224');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship224" id="ship224_input" value="0">
               	</div>
            </td>
        </tr>
               			   
			                            <tr>
        	<th colspan="3" class="gray_stripe">Transport</th>     
            <th style="padding:0;" class="gray_stripe">            	
             	<a href="javascript:noShipsTransports();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsTransports();" class="fl_max_ships">Max</a>
           	</th>
        </tr>                                               <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(202)"><img src="./styles/theme/gow/gebaeude/202.gif" alt="Light Cargo"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  9200" style="cursor:help;">Light Cargo</span></td>
            <td id="ship202_value">5</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship202');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship202');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship202" id="ship202_input" value="0">
               	</div>
            </td>
        </tr>
                                       <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(217)"><img src="./styles/theme/gow/gebaeude/217.gif" alt="Battle Transporter"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  11500" style="cursor:help;">Battle Transporter</span></td>
            <td id="ship217_value">1.000</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship217');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship217');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship217" id="ship217_input" value="0">
               	</div>
            </td>
        </tr>
               			   
			   			    <tr>
        	<th colspan="3" class="gray_stripe piccolastriscia">Proccesors</th>     
            <th style="padding:0;" class="gray_stripe piccolastriscia">            	
             	<a href="javascript:noShipsProcessors();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsProcessors();" class="fl_max_ships">Max</a>
           	</th>
        </tr>                                               <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(209)"><img src="./styles/theme/gow/gebaeude/209.gif" alt="Recycler"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  3680" style="cursor:help;">Recycler</span></td>
            <td id="ship209_value">5</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship209');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship209');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship209" id="ship209_input" value="0">
               	</div>
            </td>
        </tr>
                                       <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(219)"><img src="./styles/theme/gow/gebaeude/219.gif" alt="Battle Recycler"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  8625" style="cursor:help;">Battle Recycler</span></td>
            <td id="ship219_value">499.232</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship219');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship219');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship219" id="ship219_input" value="0">
               	</div>
            </td>
        </tr>
               			   
			                                                          <tr>
        	<th colspan="3" class="gray_stripe piccolastriscia">Special</th>     
            <th style="padding:0;" class="gray_stripe piccolastriscia">            	
             	<a href="javascript:noShipsSpecial();" class="fl_min_ships">Min</a>
                <a href="javascript:maxShipsSpecial();" class="fl_max_ships">Max</a>
           	</th>
        </tr>
                                               <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(208)"><img src="./styles/theme/gow/gebaeude/208.gif" alt="Colony Ship"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  4600" style="cursor:help;">Colony Ship</span></td>
            <td id="ship208_value">1</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship208');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship208');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship208" id="ship208_input" value="0">
               	</div>
            </td>
        </tr>
		
                                       <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(210)"><img src="./styles/theme/gow/gebaeude/210.gif" alt="Spy Probe"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  184000000" style="cursor:help;">Spy Probe</span></td>
            <td id="ship210_value">5</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship210');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship210');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship210" id="ship210_input" value="0">
               	</div>
            </td>
        </tr>
		
                                       <tr class="fl_fllets_rows">
            <td class="fl_fllets_rows_img_td"><a href="#" onclick="return Dialog.info(220)"><img src="./styles/theme/gow/gebaeude/220.gif" alt="Dark Matter Collector"></a></td>
            <td> <span class="tooltip" data-tooltip-content="Speed:  115" style="cursor:help;">Dark Matter Collector</span></td>
            <td id="ship220_value">5</td>
            <td class="fl_fllets_rows_input_td">
            	<div class="fl_fllets_rows_input_div">
                	<div onclick="minShip('ship220');" class="fl_fllets_rows_input_min">Min</div>
                    <div onclick="maxShip('ship220');" class="fl_fllets_rows_input_max">Max</div>
                	<input class="countdots fl_fllets_rows_input_countdots" name="ship220" id="ship220_input" value="0">
               	</div>
            </td>
        </tr>
		
               			                                           <tr>     
        	<th colspan="2" style="text-align:center;" class="gray_stripe"></th>            	      
        	<th colspan="1" style="text-align:center;" class="gray_stripe"><a href="javascript:maxShips();" style="color:#666;">All ships</a></th>        	  
            <th colspan="1" style="text-align:center;" class="gray_stripe"><a href="javascript:noShips();" style="color:#666;">No ship</a></th>           
        </tr>
      
                
    </tbody></table>
		
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->

{/block}