{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:500px;">
    <div class="gray_stripe">
        {$LNG.al_request_list}    <span style="float:right"><a href="?page=alliance">{$LNG.sys_back}</a></span>
    </div>
	
	{foreach $applyList as $applyRow}
		<div class="ally_contents sepor_conten development_row">
		<a href="game.php?page=alliance&amp;mode=admin&amp;action=detailApply&amp;id={$applyRow.id}">{$applyRow.username}</a>
		<a href="game.php?page=alliance&amp;mode=admin&amp;action=detailApply&amp;id={$applyRow.id}" class="right_flank">{$applyRow.time}</a>
		<a href="game.php?page=alliance&amp;mode=admin&amp;action=detailApply&amp;id={$applyRow.id}" ><img src="styles/images/iconav/over.png"></a>
		
	</div>
	{foreachelse}
	
		<td colspan="2">{$LNG.al_no_requests}</td>
	{/foreach}
	
	
	</div>

</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->

{/block}