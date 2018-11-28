{$count = count($productionTable.usedResource)}
<div class="content_box">
<div class="right_part" style="width: 100%">
<div class="record_rows" style="padding: 0px">
<table class="tablesorter ally_ranks">
    <tr>
        <th class="gray_stripe">&nbsp;</th>
		{foreach $productionTable.usedResource as $resourceID}
                <th class="gray_stripe" colspan="2">{$LNG.tech.$resourceID} </th>
               {/foreach}
            </tr>
    <tr>
        <th class="gray_stripe">{$LNG.information_lvl}</th>
                <th class="gray_stripe">{$LNG.bd_actual_production}/{$LNG.information_lvl_h}</th>
        <th class="gray_stripe">{$LNG.information_lvl_diff}</th>
                <th class="gray_stripe">{$LNG.bd_actual_production}/{$LNG.information_lvl_h}</th>
        <th class="gray_stripe">{$LNG.information_lvl_diff}</th>
            </tr>
			
			{foreach $productionTable.production as $elementLevel => $productionData}
        <tr>
        <td><span{if $CurrentLevel == $elementLevel} style="color:#ff0000"{/if}>{$elementLevel}</span></td>
		
		{foreach $productionData as $resourceID => $production}
		{$productionDiff = $production - $productionTable.production.$CurrentLevel.$resourceID}
                        <td><span style="color:{if $production > 0}lime{elseif $production < 0}red{else}white{/if}">{$production|number}</span></td>
                        <td><span style="color:{if $productionDiff > 0}lime{elseif $productionDiff < 0}red{else}white{/if}">{$productionDiff|number}</span></td>
		{/foreach}
            </tr>
       {/foreach}
    </table>
	</div> </div> </div>