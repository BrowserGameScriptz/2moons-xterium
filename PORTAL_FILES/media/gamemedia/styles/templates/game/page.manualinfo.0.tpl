{block name="title" prepend}{$LNG.option_educ}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:auto;">
        <div class="ally_contents">
		
<div class="manual_text">
	<img style="margin:0 0 10px 0" src="styles/images/manual_start.jpg" alt="">
	{$LNG.tutorial_story}
	
	
	
	</div>
<div class="manual_btn_blokc">
	<a class="manual_btn_ok" href="game.php?page=overview" target="_parent">{$LNG.tutorial_go}</a>
	<a class="manual_btn_no" href="game.php?page=training&amp;mode=off" target="_parent">{$LNG.tutorial_stop}</a>
</div>

    </div>        
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        <!--/body-->
{/block}