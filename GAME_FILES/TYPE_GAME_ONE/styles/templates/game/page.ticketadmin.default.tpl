{block name="title" prepend}{$LNG.lm_support}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner" style="padding-bottom:2px;">
    <div class="gray_stripe" style="padding-right:0;">
       {$LNG.ti_header} 
    </div> 
	{foreach $ticketList as $TicketID => $TicketInfo}	
	 <a href="game.php?page=ticketadmin&amp;mode=view&amp;id={$TicketID}" class="ticket_row_linck">
        <span class="ticket_row_linck_id">#{$TicketID}</span>
        <span class="ticket_row_linck_subject">{$TicketInfo.subject}</span>
        <span class="ticket_row_linck_time">{$TicketInfo.time}</span>
		{if $TicketInfo.status == 0}<span class="ticket_row_linck_status" style="color:green">{$LNG.ti_status_open} | {$TicketInfo.username}</span>{elseif $TicketInfo.status == 1}<span class="ticket_row_linck_status" style="color:orange">{$LNG.ti_status_answer} | {$TicketInfo.username}</span>{else}<span class="ticket_row_linck_status" style="color:red">{$LNG.ti_status_closed}</span>{/if}
                        <span class="clear"></span>
    </a>    
	{/foreach}
	
	
	{foreach $supportList as $id => $Player}	
    <div class="gray_stripe" style="padding-right:0;">
       Related to {$Player.username}
    </div> 
	{foreach $ticketListPlayer as $TicketID => $TicketInfo}

	{if $TicketInfo.adminanswered == $Player.id}
	 <a href="game.php?page=ticketadmin&amp;mode=view&amp;id={$TicketID}" class="ticket_row_linck">
        <span class="ticket_row_linck_id">#{$TicketID}</span>
        <span class="ticket_row_linck_subject">{$TicketInfo.subject}</span>
        <span class="ticket_row_linck_time">{$TicketInfo.time}</span>
		{if $TicketInfo.status == 0}<span class="ticket_row_linck_status" style="color:green">{$LNG.ti_status_open} | {$TicketInfo.username}</span>{elseif $TicketInfo.status == 1}<span class="ticket_row_linck_status" style="color:orange">{$LNG.ti_status_answer} | {$TicketInfo.username}</span>{else}<span class="ticket_row_linck_status" style="color:red">{$LNG.ti_status_closed}</span>{/if}
                        <span class="clear"></span>
    </a>    
	{/if}
	{foreachelse}
	<center>No tickets avaible</center>
	{/foreach}
	{/foreach}
    </div>
	
	
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->

{/block}
