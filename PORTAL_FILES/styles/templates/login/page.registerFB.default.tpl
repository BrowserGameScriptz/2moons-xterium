{block name="title" prepend}{$LNG.siteTitleRegister}{/block}
{block name="content"}
 <div class="body">
<h1 class="top_title">{$LNG.register_1}</h1>
<div class="confid">
    {$LNG.register_2}
</div>
<form name="form" id="form" method="POST" action="../index.php?page=registerFB" data-action="../index.php?page=registerFB">  
<input type="hidden" value="send" name="mode">
<input type="hidden" value="{$facebook_token}" name="facebook_token">
<input type="hidden" value="{$facebook_userId}" name="facebook_userId">

	<div class="blocks">
        <span class="lable">Email</span>
         <input name="email" value="" onkeyup="CheckEmail(this.value);" onchange="CheckEmail(this.value);" type="email">
        <div id="regemailcption" class="reg_caption">
            {$LNG.register_3}        </div>
    </div>
        <div class="blocks">
        <span class="lable">{$LNG.register_4}</span>
       <input maxlength="15" name="username" value="" onkeyup="CheckUsername(this.value);" onchange="CheckUsername(this.value);" type="text">
        <div id="regnamecption" class="reg_caption">
           {$LNG.register_5}    
        </div>
    </div>   
      
    <div class="blocks">
        <span class="lable">{$LNG.registerPassword}</span>
        <input required="required" maxlength="32" name="password" value="" onkeyup="CheckPwd(this.value);" onchange="CheckPwd(this.value);" type="text">
        <div id="regpasswcption" class="reg_caption">
            {$LNG.register_7}    
        </div>
    </div>
	{if !empty($referralData.id)}
	<div class="blocks">
        <span class="lable">{$LNG.registerReferral}</span>
        <input value="{$referralData.name}" name="Refer" readonly="readonly"><input type="hidden" value="{$referralData.id}" name="referralID">
    </div>{else}<input type="hidden" value="{$referralData.id}" name="referralID">{/if}
	<div class="blocks">
        <span class="lable">{$LNG.registerLanguage}</span>
       <select name="lang" class="sel_uni">
                	            
                      {html_options options=$languages selected=$lang}
                	        	       	</select>
      
    </div>

    <div class="clear"></div>
    <span class="lable"></span>
    <input class="button1" value="REGISTER WITH FACEBOOK" name="data[submit]" type="submit">
    <div id="regcaptchacption" class="reg_caption">
            {$LNG.register_13}  
        </div>
    <div class="clear"></div> 
</form>
                     
               	
             </div>  
            <div class="clear"></div>
		</div><!--/block_light-->
		
{/block}
