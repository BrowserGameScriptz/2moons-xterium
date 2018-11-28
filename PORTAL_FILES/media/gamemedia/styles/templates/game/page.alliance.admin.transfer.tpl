{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:450px;">
<form action="game.php?page=alliance&amp;mode=admin&amp;action=transfer" method="post">
	 <div class="gray_stripe">
        <div class="left_part">	
            {$LNG.al_transfer_alliance}
        </div>                  
    </div>
    <div class="ally_contents" style="padding-bottom:10px;">
	{$LNG.al_transfer_to}:
	{html_options name=newleader options=$transferUserList}
	<input type="submit" value="{$LNG.al_transfer_submit}" style="float: right;">
	</div>
</form>
<div class="gray_stripe">
	<a href="game.php?page=alliance&amp;mode=admin">{$LNG.al_back}</a>
                    </div>
</div>

</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}