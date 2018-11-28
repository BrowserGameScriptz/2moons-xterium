{block name="title" prepend}{$LNG.lobby_1}{/block}
{block name="content"}
<div class="body">
                
        <form method="post" action="../index.php?page=changepass">    
		<input type="hidden" value="send" name="mode">
        <h1 class="top_title">{$LNG.lobby_14}</h1>
        <div class="confid">
            {$LNG.lobby_15}
        </div>
                <div class="clear"></div>
        <span class="lable">{$LNG.lobby_16}</span>
        <input type="text" required="required" style=""  maxlength="32" name="passw" value="">
        <div id="regpasswcption" class="reg_caption">
                
        </div>
                <div class="clear"></div>
        <span class="lable">{$LNG.lobby_17}</span>
        <input type="text" required="required"  maxlength="32" name="passw2" value="">
        <div id="regpasswcption" class="reg_caption">
            {$LNG.register_7}
        </div>
        <div class="clear"></div>
        <span class="lable"></span>
        <input class="button" type="submit" value="{$LNG.lobby_6}" name="submit"> 
        <div class="clear"></div>
    </form>    
                    
               	
             </div>  
            <div class="clear"></div>
		</div><!--/block_light-->
{/block}
