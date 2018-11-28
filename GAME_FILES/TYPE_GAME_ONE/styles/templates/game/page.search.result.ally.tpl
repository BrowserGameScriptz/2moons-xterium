{block name="content"}
<table style="width:760px;border-collapse: collapse;" id="resulttable">
	<tr>
		<th class="gray_stripe" style="line-height: 20px;height: 20px;">{$LNG.sh_tag}</th>
		<th class="gray_stripe" style="line-height: 20px;height: 20px;">{$LNG.sh_name}</th>
		<th class="gray_stripe" style="line-height: 20px;height: 20px;">{$LNG.sh_members}</th>
		<th class="gray_stripe" style="line-height: 20px;height: 20px;">{$LNG.sh_points}</th>
	</tr>
	{foreach $searchList as $searchRow}
	<tr>
		<td><a href="game.php?page=alliance&amp;mode=info&amp;tag={$searchRow.allytag}">{$searchRow.allytag}</a></td>
		<td>{$searchRow.allyname}</td>
		<td>{$searchRow.allymembers}</td>
		<td>{$searchRow.allypoints}</td>
	</tr>
	{/foreach}
</table>
{/block}