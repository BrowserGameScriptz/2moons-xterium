{block name="title" prepend}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:auto">
    <div class="gray_stripe">
    	{$LNG.market_70}
    </div>
    <table class="ally_ranks">
		{foreach $planetList.image as $planetID=> $image}
        <tr>
            <td rowspan="5" style="width:80px;"><img style="width:80px; height:80px;" src="./styles/theme/gow/planeten/small/s_{$image}.jpg"></td>
        </tr>
		{/foreach}
		{foreach $planetList.diameter as $diameter}
        <tr>
            <td style="text-align:right;">{$LNG.ov_diameter}</td>
            <td>{$diameter.diameter} км</td>
        </tr>
		{/foreach}
		{foreach $planetList.field as $field}
        <tr>
            <td style="text-align:right;">{$LNG.ov_fields}</td>
            <td>{$field.max}</td>
        </tr>
	   {/foreach}
		{foreach $planetList.temperature as $temperature}
        <tr>
            <td style="text-align:right;">{$LNG.gl_temperature}</td>
            <td>{$temperature.minimum}{$LNG.ov_temp_unit} {$LNG.ov_to} {$temperature.maximum}{$LNG.ov_temp_unit}</td>
        </tr>
		 {/foreach}
		{foreach $planetList.coords as $coords}
        <tr>
            <td style="text-align:right;">{$LNG.lv_coords}</td>
            <td>[*:*:{$coords.planet}]</td>
        </tr>
		{/foreach}
    </table>
    <br />
    <table class="ally_ranks">
		{foreach $planetList.solar as $solar}
        <tr>
            <td style="text-align:right;">{$LNG.tech.212}:</td><td>{$solar.solar}</td>
        </tr>
		{/foreach}
        <tr>
            <th colspan="2" class="gray_stripe">{$LNG.lv_buildings}</th>
        </tr>
		{foreach $planetList.build as $elementID=> $buildArray}<tr><td>{$LNG.tech.$elementID}:</td>{foreach $buildArray as $planetID=> $build}<td>{$build|number}</td>{/foreach}</tr>{/foreach}
                        <tr>
            <th colspan="2" class="gray_stripe">{$LNG.lv_defenses}</th>
        </tr>
		{foreach $planetList.defense as $elementID=> $fleetArray}<tr><td>{$LNG.tech.$elementID}:</td>{foreach $fleetArray as $planetID=> $fleet}<td>{$fleet|number}</td>{/foreach}</tr>{/foreach}
            </table>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
