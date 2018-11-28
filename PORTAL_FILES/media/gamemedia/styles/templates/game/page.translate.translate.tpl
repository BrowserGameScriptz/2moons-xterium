{block name="title" prepend}Translate Module{/block}
{block name="content"}
<script language="javascript">
// Indicate which texts are changed, called from input and textarea onchange
function set(id){
  var checkbox = document.getElementById('id_checkbox_' + id);
  if(checkbox)
    checkbox.checked = true;
  var hidden = document.getElementById('id_hidden_' + id);
  if(hidden)
    hidden.disabled = false;
  var conf = document.getElementById('id_confirm');
  if(conf)
    conf.disabled = true;
}
</script>

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
							{$errorMessage}
							{$showBlock}
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