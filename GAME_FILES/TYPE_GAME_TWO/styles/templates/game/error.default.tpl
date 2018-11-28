{block name="title" prepend}{$LNG.fcm_info}{/block}
{block name="content"}
{if $fullSide}<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:500px;">
    <div class="gray_stripe">
       {$LNG.fcm_info}                    
    </div> 
	<div class="ally_contents">
		{$message}
	</div>
</div>
</div>
</div>
{else}
<div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:500px;">
    <div class="gray_stripe">
       {$LNG.fcm_info}                        
    </div> 
	<div class="ally_contents">
		{$message}
	</div>
</div>
</div>
</div>
{/if}
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
		
{/block}
{block name="script" append}
<meta http-equiv="refresh" content="{$gotoinsec}; URL={$goto}">
{/block}