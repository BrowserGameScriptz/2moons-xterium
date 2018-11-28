{block name="title" prepend}{$LNG.lm_search}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<table style="width:760px;border-collapse: collapse;">
	<tbody><tr>
		<th class="gray_stripe" style="-moz-border-radius: 4px 4px 0px 0px;-webkit-border-radius: 4px 4px 0px 0px;border-radius: 4px 4px 0px 0px;">{$LNG.lm_search}</th>
	</tr>
	<tr>
		<td> 
	{html_options options=$modeSelector name="type" id="type"}

			<input name="searchtext" id="searchtext" type="text">
			<input value="{$LNG.sh_search}" type="button">
		</td>
	</tr>
</tbody></table>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script" append}
<script type="text/javascript">
	var lngoutlaw  = '{$LNG.fl_ticket_auto_3}';
	var status_ok		= '{$LNG.gl_ajax_status_ok}';
	var status_fail		= '{$LNG.gl_ajax_status_fail}';
	var MaxFleetSetting = {$settings_fleetactions};
</script>
{/block}