{block name="title" prepend}{$LNG.ref_system}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
       {$LNG.ref_ref} <a style="float:right;" href="game.php?page=refsystem">{$LNG.al_back}</a>                 
    </div> 
    <table class="tablesorter ally_ranks">
                <tbody>
				
				
				{foreach $RefLinks as $RefID => $RefLink}<tr><td colspan="2"><a href="#" onclick="return Dialog.Playercard({$RefID}, '{$RefLink.username}');">{$RefLink.username}</a></td><td>{{$RefLink.points|number}}/{$ref_minpoints|number}</td></tr>{foreachelse}
				<tr>
            <td colspan="2">{$LNG.ov_noreflink}</td>
        </tr>
		{/foreach}
            </tbody></table>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->

{/block}