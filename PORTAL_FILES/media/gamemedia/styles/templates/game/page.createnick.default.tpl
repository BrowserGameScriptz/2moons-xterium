{block name="title" prepend}{$LNG.market_48}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
	<div id="body"><div id="popup_conteirer">
		<div id="content">
			<div id="ally_content" class="conteiner" style="width:auto">
				<div class="gray_stripe">
					{$LNG.changenick_1}
				</div>
				<table class="ally_ranks gray_stripe_th td_border_bottom">
					<tbody>
						<tr>
							<td colspan="2">
								{$LNG.changenick_4}: <input type="text" name="createName" id="createName"><br>
								<small>* You can create your nickname for free. You can edit your nickname once a week.</small>
							</td>
							
						</tr>
						<tr>
							<td colspan="2">
								<input id="submit" style="padding-left:10px; padding-right:10px;" onclick="checkUsername();" name="button" value="{$LNG.changenick_5}" type="button">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="clear"></div>   
</div>         
<!--/body-->
{/block}
{block name="script" append}
<script type="text/javascript">
	function checkUsername()
	{
		var Name	= $('#createName').val();
		$('submit').attr('disabled','disabled');
		$.post('game.php?page=changenick&mode=create&name='+Name+'&ajax=1', function(data) {
			alert(data);
			parent.$.fancybox.close();
			parent.location = "game.php?page=settings";
			return true;
		});
	}
</script>

{/block}