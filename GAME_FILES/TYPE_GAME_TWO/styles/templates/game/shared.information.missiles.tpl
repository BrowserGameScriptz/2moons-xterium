


<div class="content_box">
<div class="right_part" style="width: 100%">
<div class="record_rows" style="padding: 0px">
<table class="tablesorter ally_ranks info_elements_ship_table">
	<tr>
		<th class="gray_stripe">{$LNG.in_missilestype}</th><th class="gray_stripe">{$LNG.in_missilesamount}</th><th class="gray_stripe">{$LNG.in_destroy}</th>
	</tr>
	<tr>
		<td>{$LNG.tech.502}</td><td><span id="missile_502">{$MissileList.502|number}</span></td><td><input class="missile" type="text" name="missile[502]" placeholder="0"></td>
	</tr>
	<tr>
		<td>{$LNG.tech.503}</td><td><span id="missile_503">{$MissileList.503|number}</span></td><td><input class="missile" type="text" name="missile[503]" placeholder="0"></td>
	</tr>
	<tr>
		<td colspan="3" id="submit"><input type="button" value="{$LNG.in_destroy}" onclick="DestroyMissiles();" style="width: 100%;margin-top: 5px;"></td>
	</tr>
</table>

</div> </div> </div>