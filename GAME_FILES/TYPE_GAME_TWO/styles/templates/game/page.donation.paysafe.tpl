{block name="title" prepend}{$LNG.lm_academy}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner academy_info_paysafe">
	<div class="gray_stripe">
    	<span class="academy_info_text_h">{$LNG.customm_34}</span>
    </div>
	<p class="academy_info_text">
    	
        <center>{$LNG.customm_35}
		<br><br>
		<form name="paysafe" action="game.php?page=donation" method="post" enctype="multipart/form-data">		
			<input name="c1" maxlength="4" size="4" placeholder="1234" type="text">- 
			<input name="c2" maxlength="4" size="4" placeholder="1234" type="text">- 
			<input name="c3" maxlength="4" size="4" placeholder="1234" type="text">- 
			<input name="c4" maxlength="4" size="4" placeholder="1234" type="text">
			€: <input name="eur" maxlength="4" size="4" placeholder="EURO" type="text">
			<br><br>
			{*<label for="fichier">Load the screen of your ticket: <input type="file" name="fichier" id="fichier"/></label>*}
	<br><br>
			<input name="submit" class="button" value="{$LNG.customm_36}" onclick="javascript:Dialog.close();" type="submit">
		</form>
</center>

            </p>
    <div class="clear"></div>
  
</div>

</div>
</div>
            <div class="clear"></div>   
            </div>         
        <!--/body-->
		{/block}