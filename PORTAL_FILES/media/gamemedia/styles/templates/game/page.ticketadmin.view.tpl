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
		<div class="ticket_message {if in_array($answerRow.ownerID,array(1,10283,10415))}ticket_message_owner{/if}">    
    	<div class="ticket_message_head">
        	<span class="ticket_message_head_name">{$answerRow.ownerName} - <font color="red">{$answerRow.ownerID}</font></span> 
            [{$answerRow.time}]
    	</div>	
    	<div class="ticket_message_text">
    		{$answerRow.message}
        </div>
	</div>
	    
    <div class="clear"></div>
    {/foreach}
	    
     {if $status < 2}   
    <form action="game.php?page=ticketadmin&amp;mode=send" method="post" id="form">
    <input name="id" value="{$ticketID}" type="hidden"> 
        <div class="build_band ticket_bottom_band">
            {$LNG.ti_answers}
			
			<select class="bottom_band_submit" name="action"><option value="0" selected disabled>- Select action -</option><option value="1">Send to admin</option><option value="2">Close</option></select>
			
        </div>   	
        <textarea placeholder="{$LNG.mg_message}" class="ticket_message_send_text" id="message" name="message" rows="60" cols="8" style="height:100px;"></textarea>
        <div class="build_band ticket_bottom_band">
       		<input class="bottom_band_submit" value="{$LNG.ti_submit}" type="submit">
        </div>        
    </form>
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