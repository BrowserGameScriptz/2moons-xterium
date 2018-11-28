{block name="title" prepend}{$LNG.siteTitleIndex}{/block}
{block name="content"}
  <div class="login_body">
        	<div class="clear"></div>
            <div class="login_mobail_fix">  
                <div id="login_mobail">
                    <div class="login_mobail_head">
                        <div class="head_title">War Of Galaxyz</div>
                                                    <a class="head_link" href="../index.php?page=index">{$LNG.main_nav_6}</a>  
                         
                        <div class="clear"></div>
                    </div>
                    <div class="login_mobail_body">        
                                       
                      {foreach $languages as $langKey => $langName}
            <a href="javascript:setLNG('{$langKey}')" hreflang="{$langKey}" title="{$langName}" style="float:right;margin-top:15px;"><img src="images/{$langKey}.png" alt="{$langKey}" width="16px" height="16px"></a>
			{/foreach}

			
                           <form name="form" id="form" method="POST" action="../index.php?page=register" data-action="../index.php?page=register">  
<input type="hidden" value="send" name="mode">
<input type="hidden" value="{$externalAuth.account}" name="externalAuth[account]">
<input type="hidden" value="{$externalAuth.method}" name="externalAuth[method]">
<input type="hidden" value="{$referralData.id}" name="referralID">

       <label>{$LNG.main_nav_4}</label>
         <input name="email" value="" placeholder="{$LNG.main_nav_4}" required  style="width:100%" type="email">		 
	   <label>{$LNG.register_4}</label>
       <input maxlength="15" name="username" value="" placeholder="{$LNG.register_4}" required  style="width:100%" type="text"> 
       <label>{$LNG.register_6}</label>
        <input required="required" maxlength="32" name="password" value="" placeholder="{$LNG.register_6}" required  style="width:100%" type="text">
		<label>{$LNG.registerLanguage}</label>
       <select name="lang" class="sel_uni_top">{html_options options=$languages selected=$lang}</select>
		
										
										   <div class="reg_caption" style="line-height:40px;">
           <span style="cursor:pointer; text-decoration:underline; color: #24325b; font-size:14px; font-weight:bold;" onclick="$('#title_uni').slideToggle();">{$LNG.register_9}</span>
        </div>
    
    <div id="title_uni" class="blocks" style="display:none;">
    	<table style="width:100%;">
        	<tbody><tr>
            	<td style="width:50%;"> 
                    <h4 style="font-size:16px;">WORLD1 - {$LNG.register_14}</h4>
                    <p style="font-size:14px; margin-bottom:10px;">
                        <b>{$LNG.register_15}:</b> {$LNG.register_23} (1000)
                        <br><b>{$LNG.register_16}:</b> {$LNG.register_23} (х1000)
                        <br><b>{$LNG.register_17}:</b> {$LNG.register_24} (х1000)
                        <br><b>{$LNG.register_18}:</b> {$LNG.register_24} (x35)
                        <br><b>{$LNG.register_19}:</b> {$LNG.register_23} (х10)
                        <br><b>{$LNG.register_20}:</b> х5
                        <br><b>{$LNG.register_21}:</b> 40%
                        <br><b>{$LNG.register_22}:</b> 10%
                    </p>
        		</td>
               
				
            </tr>
            
            
    	</tbody></table>
    </div>
                          <input class="button" value="{$LNG.register_12}" name="data[submit]" type="submit">               
                        </form>
                        <a class="login_mobail_link" href="../index.php?page=LostPassword" style="float:right;">{$LNG.main_nav_7}</a>
                        
                         
                        <div class="clear"></div>
						</div>
                    </div>
                </div>
            </div>
            
    	</div>
{/block}
