{block name="title" prepend}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
	<div id="body">
		<div id="popup_conteirer">
			<div id="content">
				<style type="text/css">
				.ok_btn{
					display: block;
					padding: 0;
					margin: 0;
					width: 100%;
					height: 25px;
					line-height: 25px;
					color: #c9c9c9;
					text-align: center;
					font-size: 13px;
					cursor: pointer;
					border: 1px solid #081938;
					background: #006191;
					filter: progid:DXImageTransform.Microsoft.gradient(startColorstr = '#050f21', endColorstr = '#050e1e');
					-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr = '#050f21', endColorstr = '#050e1e')";
					background-image: -moz-linear-gradient(top, #050f21, #050e1e);
					background-image: -ms-linear-gradient(top, #050f21, #050e1e);
					background-image: -o-linear-gradient(top, #050f21, #050e1e);
					background-image: -webkit-gradient(linear, center top, center bottom, from(#050f21), to(#050e1e));
					background-image: -webkit-linear-gradient(top, #050f21, #050e1e);
					background-image: linear-gradient(top, #050f21, #050e1e);
					float: none;
				}
				</style>
				<div id="ally_content" class="conteiner" style="width:auto;">
					<div class="gray_stripe">
						{$LNG.msg_ms_1}
					</div>
					<div class="ally_contents" style="height:70px;background:#000813;">
						<select name="request_notallow" style="width:100%;" id="upgrade_name">
							{foreach $AllyFriends as $friend}
								<option value="{$friend.friendId}" class="upgrade_name_class option">{$friend.friendUsername}</option>
							{/foreach}
							{if $allyidf != 0}<option value="ally" class="upgrade_name_class option">{$LNG.msg_ms_2}</option>{/if} 
						</select>
						<button style="width:100%;margin-top:10px;" type="submit" onclick="SRTF({$RaportID});" class="ok_btn">OK</button>
					</div>        
				</div>
			</div>
		</div>
		<div class="clear"></div>   
	</div>         
</div><!--/body-->
{/block}