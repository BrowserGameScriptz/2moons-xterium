{block name="title" prepend}{$LNG.ti_read} - {$LNG.lm_support}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">

 {foreach $answerList as $answerID => $answerRow}
 {if $answerRow@first}
    <div class="gray_stripe">
       {$LNG.ti_header} <span style="color:#999; float:right;">{$answerRow.subject} ({$categoryList[$answerRow.categoryID]})</span>
    </div> 
   	{/if}
		<div class="ticket_message {if $answerRow.ownerID == $userID}ticket_message_owner{/if}">    
    	<div class="ticket_message_head">
        	<span class="ticket_message_head_name">{$answerRow.ownerName}</span> 
            [{$answerRow.time}]
    	</div>	
    	<div class="ticket_message_text">
    		{$answerRow.message}
        </div>
	</div>
	    
    <div class="clear"></div>
    {/foreach}
	    
     {if $status < 2}   
    <form action="game.php?page=ticket&amp;mode=send" method="post" id="form">
    <input name="id" value="{$ticketID}" type="hidden"> 
        <div class="gray_stripe">
            {$LNG.ti_answers}
        </div>   	
        <textarea placeholder="{$LNG.mg_message}" class="ticket_message_send_text" id="message" name="message" rows="60" cols="8" style="height:100px;"></textarea>
        <div class="build_band ticket_bottom_band">
       		<input class="bottom_band_submit" value="{$LNG.ti_submit}" type="submit">
        </div>        
    </form>
        {/if}
		
    {if $status == 2 && $strated == 0}   
	    	<div class="build_band">
        			<span class="gmRateText">{$LNG.ticket_s_1}:</span>
            <span class="gmRateStars">
            	<span id="star_1" class="gmRateStar"></span>
            	<span id="star_2" class="gmRateStar"></span>
            	<span id="star_3" class="gmRateStar"></span>
            	<span id="star_4" class="gmRateStar"></span>
            	<span id="star_5" class="gmRateStar"></span>
            </span>
			
			<span style="float:right"><a href="game.php?page=ticket">{$LNG.ti_overview}</a></span>
                </div> 
				{elseif $status == 2 && $strated == 1}
				<div class="build_band">
        			{$LNG.ticket_s_2}
					<span style="float:right"><a href="game.php?page=ticket">{$LNG.ti_overview}</a></span>
                </div>
         {/if}
        
</div>
</div>



</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script" append}
<script type="text/javascript">
	var ticketID = {$ticketID};
</script>
{/block}