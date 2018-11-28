{block name="title" prepend}Verify Email{/block}
{block name="content"}
<div class="body">
                
             	    <h1 class="top_title">Confirm E-mail</h1>
    <div class="confid">
       {if $isMailSendOk == 0}To enter the game you must confirm the E-mail. We guarantee the confidentiality of the data you enter.  
	   {elseif $isMailSendOk == 1}<h3 style="color:#00aaff !important;">The secret code has been sent to you by E-mail. The message could get into "SPAM".</h3>{/if}
	</div>
    
    <div class="clear"></div>
    <span class="lable" style="width:auto; clear:both;">Send the secret code to E-mail</span>
    
    <div class="clear"></div>
	<span class="lable"></span>
    
    <form method="POST" action=""> 
        <input type="hidden"  name="block_code_to_email" value="1">
        <input class="button" type="submit" value="Send code" name="submit_3">  
    </form>
    <div id="regpasswcption" class="reg_caption">
    </div>
    
    <form method="POST" action=""> 
        <div class="clear"></div>
			<span class="lable">Secret code</span>
			<input type="text" required="required"  maxlength="32" name="email_block_code" value="">
			<div id="regpasswcption" class="reg_caption">
        </div>     
        
        <div class="clear"></div>
        <span class="lable"></span>
        <input class="button" type="submit" value="Confirm E-mail" onclick="return confirm('Are you sure you want to confirm your E-mail?') ? true : false;" name="submit_4">  
        <div class="clear"></div>
	</form>
	
	<div class="clear"></div>
	<div class="confid">
       <a href="/index.php?page=changemail" title="">{$LNG.lobby_7}</a>
    </div>
                    
               	
             </div>  
            <div class="clear"></div>
		</div>
{/block}