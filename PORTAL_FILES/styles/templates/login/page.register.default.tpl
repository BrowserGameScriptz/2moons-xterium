{block name="title" prepend}{$LNG.siteTitleRegister}{/block}
{block name="content"}
 <div class="body">
<h1 class="top_title">{$LNG.register_1}</h1>
<div class="confid">
    {$LNG.register_2}
</div>
<form name="form" id="form" method="POST" action="../index.php?page=register" data-action="../index.php?page=register">  
<input type="hidden" value="send" name="mode">
<input type="hidden" value="{$externalAuth.account}" name="externalAuth[account]">
<input type="hidden" value="{$externalAuth.method}" name="externalAuth[method]">

	<div class="blocks">
        <span class="lable">Email</span>
         <input name="email" value="" onchange="CheckEmail(this.value);" type="email">
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
	{*
            <div class="blocks">
        <span class="lable">{$LNG.register_8}</span>
        <select name="uni" class="sel_uni">
                	            
                       {html_options options=$universeSelect selected=$UNI}
                	        	       	</select>
        <div class="reg_caption" style="line-height:40px;">
           <span style="cursor:pointer; text-decoration:underline; color: #24325b; font-size:14px; font-weight:bold;" onclick="$('#title_uni').slideToggle();">{$LNG.register_9}</span>
        </div>
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
                        <br><b>{$LNG.register_21}:</b> 30-50% 
                    </p>
        		</td>
               
				
            </tr>
            
            
    	</tbody></table>
    </div>
	*}
    {*  
    <span class="lable" style="width:auto; clear:both;">{$LNG.register_10}</span>
    <div class="blocks">
        <span class="lable captcha_lable"><img class="captcha_img" src="data:image/jpeg;base64,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"></span>
        <input name="data[captcha]" value="" type="text">
        <div id="regcaptchacption" class="reg_caption">
            {$LNG.register_11}    
        </div>
	</div>
	*}
    <div class="clear"></div>
    <span class="lable"></span>
    <input class="button" value="{$LNG.register_12}" name="data[submit]" type="submit">
    <div id="regcaptchacption" class="reg_caption">
            {$LNG.register_13}  
        </div>
    <div class="clear"></div> 
</form>
                     
               	
             </div>  
            <div class="clear"></div>
		</div><!--/block_light-->
		
{/block}
