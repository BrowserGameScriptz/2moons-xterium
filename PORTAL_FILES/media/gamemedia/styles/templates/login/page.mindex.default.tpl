{block name="title" prepend}{$LNG.siteTitleIndex}{/block}
{block name="content"}
  <div class="login_body">
        	<div class="clear"></div>
            <div class="login_mobail_fix">  
                <div id="login_mobail">
                    <div class="login_mobail_head">
                        <div class="head_title">Xterium Space</div>
                                                    {if $ShowUser == 0}<a class="head_link" href="../index.php?page=register">{$LNG.main_nav_3}</a>  
													{else}<a class="head_link" href="../index.php?page=logout">{$LNG.lobby_26}</a>{/if}
                         
                        <div class="clear"></div>
                    </div>
                    <div class="login_mobail_body">        
                                       
                      {foreach $languages as $langKey => $langName}
            <a href="javascript:setLNG('{$langKey}')" hreflang="{$langKey}" title="{$langName}" style="float:right;margin-top:15px;"><img src="images/{$langKey}.png" alt="{$langKey}" width="16px" height="16px"></a>
			{/foreach}

					{if $ShowUser == 0}
                            <form method="POST" action="../index.php?page=login">
                            <label>{$LNG.main_nav_4}</label>
                            <input placeholder="{$LNG.main_nav_4}" required  style="width:100%" name="username" value="" type="text">
                            <label>{$LNG.main_nav_5}</label>
                           <input placeholder="{$LNG.main_nav_5}" required  style="width:100%" name="password" value="" type="password">  
                            <label>&nbsp;</label>          
                            <input name="submit" class="button" value="{$LNG.main_nav_6}" type="submit">                      
                        </form>
                        <a class="login_mobail_link" href="../index.php?page=LostPassword" style="float:right;">{$LNG.main_nav_7}</a>
                        {else}
						<form method="POST" id="formId" action="../index.php?page=ingame">
						<input type="hidden" value="{$encodage}" name="encoding">
                            <label>{$LNG.register_8}</label>
							<select name="universe" class="sel_uni_top"><option value="world1">WORLD1</option><option value="world2">WORLD2 (Prize Pool)</option>{*<option value="mobile">WORLD3 (Mobile)</option>*}</select>
                            <label>&nbsp;</label>          
                            <input name="submit" class="button" value="{$LNG.lobby_27}" type="submit">                      
                        </form>
						{/if}
                         
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            
    	</div>
{/block}
{block name="script" append}
<script>{if $code}alert({$code|json});{/if}</script>
{/block}