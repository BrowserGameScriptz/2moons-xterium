<div class="gray_stripe">
	{$LNG.fl_acs}: <span style="color:#CCC"> {$acsData.acsName} <a href="javascript:Rename();" style="float:right; color:#666;">{$LNG.planet_rename} {$LNG.fl_acs}</a>
</span></div>
<form action="?page=fleetTable&amp;action=acs" method="post">
<input name="fleetID" value="{$acsData.mainFleetID}" type="hidden">
	<table class="tablesorter ally_ranks">
		<tbody><tr>
			<th style="width:50%;" class="gray_stripe">{$LNG.fl_members_invited}</th>
            <th style="width:50%;" class="gray_stripe">{$LNG.fl_invite_members}</th>
		</tr>
				<tr>
			<td>
				<select size="5" style="width:100%;">
					{html_options options=$acsData.invitedUsers}

                </select>
			</td>
			<td>
				<input name="username" type="text">
				<input value="{$LNG.fl_continue}" type="submit">
			</td>
		</tr>
	</tbody></table>
</form>
<script type="text/javascript">
function Rename(){
	var Name = prompt("{$LNG.fl_acs_change_name}", "{$acsData.acsName}");
	$.get('?page=fleetTable&action=acs&fleetID={$acsData.mainFleetID}&acsName='+Name, function(data) {
		if(data != "") {
			alert(data);
			return;
		}
		$('#acsName').text(Name);
	});
}
</script>
