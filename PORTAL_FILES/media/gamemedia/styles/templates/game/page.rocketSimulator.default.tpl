{block name="title" prepend}{$LNG.lm_battlesim}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
	<form id="form" name="battlesim" method="post">
    <div class="gray_stripe" style="padding-right:0;">
    	{$LNG.moonsim_1}
		<input class="right_flank input_blue"  onclick="window.location = '?page=battleSimulator';" value="{$LNG.moonsim_1}" type="button">
		<input class="right_flank input_blue" onclick="#;" style="border-radius:0;margin-right:10px;" value="Expedition Simulator" type="button">
        <input class="right_flank input_blue" style="border-radius:0;margin-right:10px;" onclick="window.location = '?page=battleSimulator&amp;mode=MoonSim';" value="{$LNG.moonsim_2}" type="button">
</div>
<table class="battlesim_table" style="width:100%;max-width:100%">
                <tbody><tr>
                    <th colspan="2"></th>
                    <th colspan="3"></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/503.gif" alt="{$LNG.tech.503}"></td>
                    <td class="battlesim_name_ship">{$LNG.tech.503}</td>
                    <td><input class="countdots fl_fllets_rows_input_countdots" size="10" value="{$totalMissiles|number}" name="missile503" type="text"></td>
					<td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/502.gif" alt="{$LNG.tech.502}"></td>
					<td class="battlesim_name_ship">{$LNG.tech.502}</td>
                    <td><input class="countdots fl_fllets_rows_input_countdots" size="10" value="0" name="missile502" type="text"></td>
                </tr>
				
               
               
            </tbody></table>
			<table class="battlesim_table" style="width:100%;max-width:100%">
                <tbody>
				<tr>
                    <th colspan="2">{$LNG.bs_techno}</th>
                    <th>{$LNG.bs_atter}</th>
					<th colspan="2">{$LNG.bs_techno}</th>
                    <th>{$LNG.bs_deffer}</th>
                    
                </tr>
                <tr>
                    <td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/109.gif" alt="{$LNG.tech.109}"></td>
                    <td class="battlesim_name_ship">{$LNG.tech.109}</td>
                    <td><input class="countdots fl_fllets_rows_input_countdots" size="10" value="{$attackerTech}" name="research109" type="text"></td>
					<td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/110.gif" alt="{$LNG.tech.109}"></td>
                    <td class="battlesim_name_ship">{$LNG.tech.110}</td>
                    <td><input class="countdots fl_fllets_rows_input_countdots" size="10" value="0" name="research110" type="text"></td>
                    
                </tr>
			  </tbody></table>
		
                        <table class="battlesim_table" style="width:100%;max-width:100%">
                <tbody><tr>
                    <th colspan="3">{$LNG.achiev_8}</th>
                    <th>{$LNG.rs_amount}</th>
                    <th>{$LNG.al_unitsloos}</th>
                    <th>{$LNG.tech.901}</th>
                    <th>{$LNG.tech.902}</th>
                    <th>{$LNG.tech.903}</th>                    
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
				{foreach $defensiveList as $id}
                                                <tr>
                    <td></td>                            
                	<td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/{$id}.gif" alt="{$LNG.tech.$id}"></td>
                    <td class="battlesim_name_ship">{if $id == 420 || $id == 421 || $id == 422}<span style="color:#32CD32">{$LNG.tech.$id}</span>{else}{$LNG.tech.$id}{/if}</td>
                    <td><input class="countdots fl_fllets_rows_input_countdots" size="10" value="0" name="defense_{$id}" type="text"></td>
                    <td id="unitlost_{$id}">-</td>
                    <td id="metalLost_{$id}">-</td>
                    <td id="crystalLost_{$id}">-</td>
                    <td id="deuteriumLost_{$id}">-</td> 
                </tr>
                  
                    {/foreach}
                                   
                                        </tbody></table>
                        <div class="clear"></div>
	<div class="gray_stripe">
		<span class="battlesim_att_points">{html_options name=Target options=$missileSelectorE}</span>
    	<span class="battlesim_def_points">{html_options name=Players options=$userSelector}</span>
    </div>
    <div id="submit">
            <input value="{$LNG.bs_send}" type="button" id="submit" onclick="missileSend();">            
    </div>
    <div id="wait" style="display:none;">
        {$LNG.bs_wait}
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
<script type="text/javascript">
	var pointsPrice = { "battleinput[0][0][202]":0.004,"battleinput[0][1][202]":0.004,"battleinput[0][0][203]":0.012,"battleinput[0][1][203]":0.012,"battleinput[0][0][204]":0.004,"battleinput[0][1][204]":0.004,"battleinput[0][0][205]":0.011,"battleinput[0][1][205]":0.011,"battleinput[0][0][206]":0.0265,"battleinput[0][1][206]":0.0265,"battleinput[0][0][207]":0.058,"battleinput[0][1][207]":0.058,"battleinput[0][0][208]":0.04,"battleinput[0][1][208]":0.04,"battleinput[0][0][209]":0.018,"battleinput[0][1][209]":0.018,"battleinput[0][0][210]":0.001,"battleinput[0][1][210]":0.001,"battleinput[0][0][211]":0.12,"battleinput[0][1][211]":0.12,"battleinput[0][0][212]":0.0025,"battleinput[0][1][212]":0.0025,"battleinput[0][0][213]":0.125,"battleinput[0][1][213]":0.125,"battleinput[0][0][214]":10.5,"battleinput[0][1][214]":10.5,"battleinput[0][0][215]":0.1,"battleinput[0][1][215]":0.1,"battleinput[0][0][216]":12.5,"battleinput[0][1][216]":12.5,"battleinput[0][0][217]":0.0565,"battleinput[0][1][217]":0.0565,"battleinput[0][0][218]":500,"battleinput[0][1][218]":500,"battleinput[0][0][219]":1.8,"battleinput[0][1][219]":1.8,"battleinput[0][0][220]":16,"battleinput[0][1][220]":16,"battleinput[0][0][221]":580,"battleinput[0][1][221]":580,"battleinput[0][0][222]":360,"battleinput[0][1][222]":360,"battleinput[0][0][223]":5.625,"battleinput[0][1][223]":5.625,"battleinput[0][0][224]":0.15,"battleinput[0][1][224]":0.15,"battleinput[0][0][225]":1.8,"battleinput[0][1][225]":1.8,"battleinput[0][0][226]":5.2,"battleinput[0][1][226]":5.2,"battleinput[0][0][227]":42,"battleinput[0][1][227]":42,"battleinput[0][0][228]":127,"battleinput[0][1][228]":127,"battleinput[0][0][229]":0.0105,"battleinput[0][1][229]":0.0105,"battleinput[0][0][230]":27.75,"battleinput[0][1][230]":27.75,"battleinput[0][1][401]":0.002,"battleinput[0][1][402]":0.002,"battleinput[0][1][403]":0.008,"battleinput[0][1][404]":0.037,"battleinput[0][1][405]":0.008,"battleinput[0][1][406]":0.13,"battleinput[0][1][407]":2,"battleinput[0][1][408]":10,"battleinput[0][1][409]":1000,"battleinput[0][1][410]":30,"battleinput[0][1][411]":7500,"battleinput[0][1][502]":0.01,"battleinput[0][1][503]":0.025,"battleinput[0][1][412]":16.5,"battleinput[0][1][413]":46,"battleinput[0][1][414]":160,"battleinput[0][1][415]":470,"battleinput[0][1][416]":0.4,"battleinput[0][1][417]":0.575,"battleinput[0][1][418]":4.1,"battleinput[0][1][419]":83.5,"battleinput[0][1][420]":0.0085,"battleinput[0][1][421]":0.38,"battleinput[0][1][422]":25.75 };
</script>
{/block}