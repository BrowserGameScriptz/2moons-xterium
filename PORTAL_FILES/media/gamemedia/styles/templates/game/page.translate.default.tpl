{block name="title" prepend}Translate Module{/block}
{block name="content"}
<div id="page">
	<div id="content">
		<div id="ally_content" class="conteiner market">
			<div class="gray_stripe" style="padding:0;">
				<span style="float:left; margin-left:30px;">Language Module</span>
			</div>
			<div id="market_conteiner">
				<div id="market_left_side">
					<span onclick="location.href='game.php?page=translate';" class="market_left_btn">Home</span><span onclick="#" class="market_left_btn">New Language</span>
				</div>
				<div id="market_content">
					<table class="tablesorter ally_ranks lots">
						<tbody>
							<tr>
								<th class="gray_stripe" style="width:10px;">Language</th> 
								<th class="gray_stripe">Language Type</th> 
								<th class="gray_stripe">Language Status</th>  
								<th class="gray_stripe">Actions</th> 
							</tr>
							{$languageListShow}
						</tbody>
					</table>
				</div>
		   </div>
		</div>
	</div>
</div>
	<div class="clear"></div>   
	</div>         
	</div><!--/body-->
				
				
{/block}