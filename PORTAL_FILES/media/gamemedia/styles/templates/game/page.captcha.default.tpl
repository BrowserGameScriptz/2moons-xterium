{block name="title" prepend}Captcha{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
       Captcha
        <a href="game.php?page=captcha" class="batn_lincks" style="float:right;">{$LNG.fl_captcha_2}</a>
    </div>
        <table id="captcha" class="ally_ranks">
    <tbody>
        <tr>
            <td><a href="game.php?page=captcha"><img style="max-height:none !important;" src="styles/images/captcha/resolve{$isCaptchaCode}_{$showImage}.gif" /></a></td>
            <td><a href="game.php?page=captcha&amp;mode=send&amp;number=1"><img style="max-height:none !important;" src="styles/images/captcha/captcha{$isNumberOne}.gif" /></a></td>
            <td><a href="game.php?page=captcha&amp;mode=send&amp;number=2"><img style="max-height:none !important;" src="styles/images/captcha/captcha{$isNumberTwo}.gif" /></a></td>
            <td><a href="game.php?page=captcha&amp;mode=send&amp;number=3"><img style="max-height:none !important;" src="styles/images/captcha/captcha{$isNumberThree}.gif" /></a></td>
        </tr>
    </tbody>
    </table>
	<div class="ally_contents" style="padding-bottom:10px; font-size:11px; text-align:center">
    	<span style="color:#D1393C">
        	{$LNG.fl_captcha_1}
        </span>
    </div>
    </div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}