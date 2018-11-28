{$count = $productionTable.usedResource}

 <table class="tablesorter ally_ranks">
    <tr>
        <th class="gray_stripe">{$LNG.in_level}</th>
		{foreach $productionTable.usedResource as $resourceID}
        <th class="gray_stripe">{$LNG.in_storage}</th>
        <th class="gray_stripe">{$LNG.information_lvl_diff}</th>
		{/foreach}
            </tr>
			
		{foreach $productionTable.storage as $elementLevel => $productionData}	
        <tr>
        <td><span{if $CurrentLevel == $elementLevel} style="color:#ff0000"{/if}>{$elementLevel}</span></td>
		{foreach $productionData as $resourceID => $storage}
		{$storageDiff = $storage - $productionTable.storage.$CurrentLevel.$resourceID}
        <td><span style="color:{if $storage > 0}lime{elseif $storage < 0}red{else}white{/if}">{$storage|number}</span></td>
        <td><span style="color:{if $storageDiff > 0}lime{elseif $storageDiff < 0}red{else}white{/if}">{$storageDiff|number}</span></td>
		{/foreach}
            </tr>
		{/foreach}
    </table>