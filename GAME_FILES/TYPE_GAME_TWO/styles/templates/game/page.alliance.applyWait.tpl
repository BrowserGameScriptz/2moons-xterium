{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
    	{$LNG.al_your_request_title}
    </div>
    <form action="game.php?page=alliance&amp;mode=cancelApply" method="post">
    <div class="ally_contents">{$request_text}</div>
    <div class="build_band ticket_bottom_band">
        <input class="bottom_band_submit" type="submit" value="{$LNG.fl_dlte_shortcut}">
    </div>  
    </form>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->

		
{/block}