{block name="content"}
<table style="width:760px;    border-collapse: collapse;" id="resulttable">
	<tbody><tr>
		<th class="gray_stripe" style="line-height: 20px;height: 20px;">{$LNG.sh_name}</th>
		<th class="gray_stripe" style="line-height: 20px;height: 20px;">&nbsp;</th>
		<th class="gray_stripe" style="line-height: 20px;height: 20px;">{$LNG.sh_alliance}</th>
		<th class="gray_stripe" style="line-height: 20px;height: 20px;">{$LNG.sh_planet}</th>
		<th class="gray_stripe" style="line-height: 20px;height: 20px;">{$LNG.sh_coords}</th>
		<th class="gray_stripe" style="line-height: 20px;height: 20px;">{$LNG.sh_position}</th>
		<th class="gray_stripe" style="line-height: 20px;height: 20px;">{$LNG.gl_actions}</th>
	</tr>
	{foreach $searchList as $searchRow} 
		<tr>
		<td><a href="#" onclick="return Dialog.Playercard({$searchRow.userid});">{$searchRow.username}</a></td>
		<td style="width: 65px;"><a href="#" onclick="return Dialog.PM({$searchRow.userid});" title="{$LNG.sh_write_message}" class="ico_post" style="height:23px"></a>&nbsp;<a href="#" onclick="return Dialog.Buddy({$searchRow.userid});" class="ico_friend" style="height:23px" title="{$LNG.sh_buddy_request}"></a></td>
		<td>{if $searchRow.allyname}<a href="game.php?page=alliance&amp;mode=info&amp;id={$searchRow.allyid}">{$searchRow.allyname}</a>{else}-{/if}</td>
		<td>{$searchRow.planetname}</td>
		<td><a href="game.php?page=galaxy&amp;galaxy={$searchRow.galaxy}&amp;system={$searchRow.system}">[{$searchRow.galaxy}:{$searchRow.system}:{$searchRow.planet}]</a></td>
		<td>{$searchRow.rank}</td>
		<td>{if $searchRow.userid != $userID}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;'{if $searchRow.outlawSearch == 1}onclick='checkOutlaw();'{else}href='javascript:doit(6,{$searchRow.planetId});'{/if}><img src='styles/images/iconav/over.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.6}</a>{else}
		<a class='tooltip_class_a_btn red' style='height: 17px;line-height: 17px;'><img src='styles/images/iconav/over.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.6}</a>{/if}</td>
	</tr>
	{/foreach}
	</tbody></table>
	<div id="send_zond">
    <table>
	<tbody><tr style="display: none;" id="fleetstatusrow">
	</tr>
	</tbody></table>
</div><!--/send_zond-->
{/block}
