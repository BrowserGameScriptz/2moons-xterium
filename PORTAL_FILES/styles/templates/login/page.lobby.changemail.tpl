{block name="title" prepend}{$LNG.lobby_1}{/block}
{block name="content"}
<div class="body">
                
        <form method="post" action="../index.php?page=changemail">    
		<input type="hidden" value="send" name="mode">
        <h1 class="top_title">{$LNG.lobby_7}</h1>
        <div class="confid">
            {$LNG.lobby_18}
        </div>
        
        <div class="clear"></div>
        <span class="lable">{$LNG.lobby_19}</span>
        <input type="text" required="required" style=""  maxlength="32" name="email_1" value="">
        <div id="regpasswcption" class="reg_caption">
                    </div>
        
        <div class="clear"></div>
        <span class="lable">{$LNG.lobby_20}</span>
        <input type="text" required="required"  maxlength="32" name="email_2" value="">
        <div id="regpasswcption" class="reg_caption">
               
        </div>
        
        <div class="clear"></div>
        <span class="lable"></span>
       <input class="button" type="submit" value="{$LNG.lobby_7}" name="submit">  
        <div class="clear"></div>
    </form>

                    
               	
             </div>  
            <div class="clear"></div>
		</div><!--/block_light-->
{/block}
