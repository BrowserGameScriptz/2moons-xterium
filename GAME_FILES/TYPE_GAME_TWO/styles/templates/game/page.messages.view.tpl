{block name="content"}
<div id="messagestable">
    <div class="gray_stripe">
        {$LNG.Messages} {if $MessID == 2 && $isImportant == 0}- <a href="#" style="color:#7d7c7c;cursor:pointer;" onclick="Message.getMessages({$MessID}, {$page - 1}, 1);return false;">[View important]</a>{elseif $MessID == 2 && $isImportant == 1}- <a href="#" style="color:#7d7c7c;cursor:pointer;" onclick="Message.getMessages({$MessID}, {$page - 1}, 0);return false;">[View all]</a>{/if}    <a href="#" style="color:#7d7c7c;cursor:pointer;float:right" onclick="{foreach $MessageList as $Message}$('#messaggio_{$Message.id}').slideToggle();$('#messi_{$Message.id}').toggleClass('messaggi_active');{/foreach}">{$LNG.gl_show} {$LNG.mg_type.100}</a>
    </div>
    <div class="message_page_navigation">
        {$LNG.mg_page}: 
		
		{if $page != 1}<a href="#" onclick="Message.getMessages({$MessID}, {$page - 1}, {$isImportant});return false;">«</a>&nbsp;{/if}{for $site=1 to $maxPage}<a href="#" onclick="Message.getMessages({$MessID}, {$site}, {$isImportant});return false;">{if $site == $page}<span class="active_page">[{$site}]</span>{else}[{$site}]{/if}</a>{if $site != $maxPage}&nbsp;{/if}{/for}&nbsp;<a href="#" onclick="Message.getMessages({$MessID}, {$page + 1}, {$isImportant});return false;">»</a>
        
              


		</div>
<form action="game.php?page=messages" method="post">
<input type="hidden" name="mode" value="action">
<input type="hidden" name="ajax" value="1">
<input type="hidden" name="messcat" value="{$MessID}">
<input type="hidden" name="side" value="{$page}"><table class="tablesorter ally_ranks">
<tbody>
{foreach $MessageList as $Message}
<tr id="message_{$Message.id}" class="message_head"  >

		
		<td class="head_row_msg {if $MessID != 999 && $Message.unread == 1}messaggi_active{/if}"  id="messi_{$Message.id}" >
	       
		   {if $MessID != 999}<input name="delmes[{$Message.id}]" value="1" type="checkbox" class="messaggi_check">{/if}

         	<div class="messaggi_altosn"><span onclick="$('#messaggio_{$Message.id}').slideToggle();$('#messi_{$Message.id}').toggleClass('messaggi_active')" class="messaggi_soggetto">{$Message.subject}</span><br>
        	<span style="color:#5ca6aa;cursor:pointer">{$LNG.fl_from}</span> 
			<span class="message_recipient_name" onclick="$('#messaggio_{$Message.id}').slideToggle();$('#messi_{$Message.id}').toggleClass('messaggi_active')">{$Message.from}{if $Message.type == 1 && $MessID != 999}<img src="../styles/images/iconav/utentemessaggi.png" class="tooltip_sticky messaggi_imag " data-tooltip-content="<table class='tooltip_class_table'>
            	<tbody><tr><th>{$Message.from}</th></tr>
								  <tr><td><a class='tooltip_class_a_bigbtn' href='#' onclick='return Dialog.Buddy({$Message.sender})'>{$LNG.customm_19}</a></td></tr>
                             	<tr><td><a class='tooltip_class_a_bigbtn' href='?page=buddyList&amp;mode=addenemies&amp;id={$Message.sender}'>{$LNG.customm_20}</a></td></tr>    
								<tr><td><a class='tooltip_class_a_bigbtn' href='?page=BlockList&amp;mode=Add&amp;id={$Message.sender}'>Block Player</a></td></tr>  
           		            
								                            </tbody></table>"> {/if}  </span>
		    
		
		
		
		</div>
		
		
		<div class="messaggi_altods">
        <span onclick="$('#messaggio_{$Message.id}').slideToggle();$('#messi_{$Message.id}').toggleClass('messaggi_active')" style="cursor: pointer;{if $Message.unread == 1}color: #bbbbbb;{else}color: #7d7c7c;{/if}float:left">{$Message.time}</span>     
		
		
		{if $Message.type == 1 && $MessID != 999}
		<a href="#" onclick="return Dialog.PM({$Message.sender}, Message.CreateAnswer('{$Message.subject}'));" title="{$LNG.mg_answer_to} {strip_tags($Message.from)}"> <img src="../styles/images/iconav/mesages.png" border="0"></a>
		<a href="#" onclick="return Dialog.complPM({$Message.id})" title="{$LNG.customm_16}"><img src="../styles/images/iconav/complaint.png"  style=" height: 14px;"></a>		
		
		{/if}
		{if $MessID == 0 || $MessID == 3 || $MessID == 199 && $Message.oldType == 0 || $MessID == 199 && $Message.oldType == 3}
		<a href="#" onclick="return Dialog.SRTF({$Message.id})" title="{$LNG.customm_28}"><img src="../styles/images/iconav/forward.png" style="height:16px;margin-top:2px;"></a>
		{/if}
		
		{if $MessID == 2 && $alyID != 0}
		<a href="game.php?page=alliance&amp;mode=circular" onclick="return Dialog.open(this.href, 650, 300);" title="{$LNG.customm_28}"><img src="../styles/images/iconav/circmsg.png" style="height:16px;margin-top:2px;"></a>
		{/if}
				
		{if $MessID < 199}
		<a href="#" onclick="msgArchive({$Message.id}, {$MessID}); Message.getMessages({$MessID}); return false;" title="{$LNG.customm_17}"><img src="../styles/images/iconav/inarchive.png" style="height:15px;width: 16px;"></a> 
		{/if}
		{if $MessID != 999}
		<a href="#" onclick="msgDel({$Message.id}, {$MessID}); Message.getMessages({$MessID}); return false;" title="{$LNG.msg_remove}"><img src="../styles/images/iconav/delmsg.png" style=" height: 14px;"></a>
		{/if}
		
		
		</div>
		
		<div class="messages_body" id="messaggio_{$Message.id}"  style="{if $Message.unread == 0 or $MessID == 999}display:none;{/if}width:99%;padding:4px;overflow: auto;position: relative;background-color: #000813!important;text-align: left;">{$Message.text}</div>
</td>
</tr>

	
		{/foreach}
		
	    </tbody>
	    </table>
	<div class="message_page_navigation">
        {$LNG.mg_page}: 
        
           {if $page != 1}<a href="#" onclick="Message.getMessages({$MessID}, {$page - 1}, {$isImportant});return false;">«</a>&nbsp;{/if}{for $site=1 to $maxPage}<a href="#" onclick="Message.getMessages({$MessID}, {$site}, {$isImportant});return false;">{if $site == $page}<span class="active_page">[{$site}]</span>{else}[{$site}]{/if}</a>{if $site != $maxPage}&nbsp;{/if}{/for}&nbsp;<a href="#" onclick="Message.getMessages({$MessID}, {$page + 1}, {$isImportant});return false;">»</a>
        
	  </div>
	  
	  
{if $MessID != 999}
	   <div class="build_band" style="padding-right:0;">   

	
<a href="#" style="color:#7d7c7c;cursor:pointer" onclick="{foreach $MessageList as $Message}$('#messaggio_{$Message.id}').slideToggle();$('#messi_{$Message.id}').toggleClass('messaggi_active');{/foreach}">{$LNG.gl_show} {$LNG.mg_type.100}</a>
   
        <input class="bottom_band_submit" value="ОК" type="submit" name="submitBottom">
        <select class="bottom_band_select" name="actionBottom">
			<option value="deletemarked">{$LNG.mg_delete_marked}</option>
			<option value="deleteunmarked">{$LNG.mg_delete_unmarked}</option>
			<option value="deletetypeall">{$LNG.mg_delete_type_all}</option>
			<option value="deleteall">{$LNG.mg_delete_all}</option>
			<option value="readall">{$LNG.mg_read_all}</option>
        </select>
    </div>{/if}
		</form>
</div>
<script type="text/javascript">
delonemesg			= "{$LNG.delonemessages}";
</script>
{/block}