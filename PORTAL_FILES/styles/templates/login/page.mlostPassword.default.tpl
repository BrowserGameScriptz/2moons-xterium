{block name="title" prepend}{$LNG.siteTitleLostPassword}{/block}
{block name="content"}

		
		  <div class="login_body">
        	<div class="clear"></div>
            <div class="login_mobail_fix">  
                <div id="login_mobail">
                    <div class="login_mobail_head">
                        <div class="head_title">War Of Galaxyz</div>
                                                    <a class="head_link" href="../index.php?page=register">{$LNG.main_nav_3}</a>  
                         
                        <div class="clear"></div>
                    </div>
                    <div class="login_mobail_body">        
                                       
                      {foreach $languages as $langKey => $langName}
            <a href="javascript:setLNG('{$langKey}')" hreflang="{$langKey}" title="{$langName}" style="float:right;margin-top:15px;"><img src="images/{$langKey}.png" alt="{$langKey}" width="16px" height="16px"></a>
			{/foreach}

			
                           <form method="POST" action="../index.php?page=lostPassword" method="post" data-action="../index.php?page=lostPassword">
						   <input type="hidden" value="send" name="mode">
                            <label>{$LNG.lost_pass_1}</label>
                            <input name="email" value="" type="text" style="width:100%">
                          <label></label>
                            <input name="submit" class="button" value="{$LNG.lost_pass_3}" type="submit">                      
                        </form>
                        <a class="login_mobail_link" href="../index.php?page=LostPassword" style="float:right;">{$LNG.main_nav_7}</a>
                        
                         
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            
    	</div>
{/block}
