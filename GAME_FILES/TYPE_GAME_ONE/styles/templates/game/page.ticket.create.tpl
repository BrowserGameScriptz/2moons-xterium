{block name="title" prepend}{$LNG.ti_create_head} - {$LNG.lm_support}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
      {$LNG.ti_create_head}<span style="float:right"><a href="game.php?page=ticket">{$LNG.ti_overview}</a><span>
    </div> 
    <div class="ticket_create_info">
    	{$LNG.ti_create_info}
    </div>
    <form action="game.php?page=ticket&amp;mode=send" method="post" id="form">
    <input name="id" value="0" type="hidden">
        <div class="gray_stripe">
            <label for="category">{$LNG.ti_category}:</label><select id="category" name="category">{html_options options=$categoryList}
			<option onclick="location.href='https://forum.warofgalaxyz.com/forum/21-suggestions/';">Suggestion ?</option></select>
            <label for="subject" style="margin-left:20px;">{$LNG.ti_subject}:</label> <input id="subject" name="subject" size="40" maxlength="255" type="text">
        </div>
        <textarea placeholder="{$LNG.mg_message}" class="ticket_message_send_text" id="message" name="message" row="60" cols="8" style="height:100px;"></textarea>
        <div class="build_band ticket_bottom_band">
       		<input class="bottom_band_submit" value="{$LNG.mg_send}" type="submit">
        </div>
    </form>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
