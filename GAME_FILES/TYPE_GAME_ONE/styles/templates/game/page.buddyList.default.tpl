{block name="title" prepend}{$LNG.lm_buddylist}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="padding-right:0;margin-bottom: 1px;">
    {$LNG.buddy_1}
    </div>

 
{foreach $myBuddyList as $myBuddyID => $myBuddyRow}
<div class="fl_groop_link_name" style="width: 324px;">
		<img title="" src="media/files/{$myBuddyRow.avatar}" class="avatarlistaamici">
		{if {$myBuddyRow.ally_tag}}<a href="game.php?page=alliance&amp;mode=info&amp;id={$myBuddyRow.ally_id}" style="color:#4899de">[{$myBuddyRow.ally_tag}] </a>{else}{/if}
		<a href="#" onclick="return Dialog.PM({$myBuddyRow.id});" style="color:#5ca6aa">{$myBuddyRow.username}</a>
		<a href="game.php?page=galaxy&amp;galaxy={$myBuddyRow.galaxy}&amp;system={$myBuddyRow.system}" style="color:#7b7b7b">[{$myBuddyRow.galaxy}:{$myBuddyRow.system}:{$myBuddyRow.planet}]</a>

		{if $myBuddyRow.onlinetime < 4}
	<div  class="tooltip listaon" data-tooltip-content="{$LNG.bu_connected}"></div>
	{elseif $myBuddyRow.onlinetime >= 4 && $myBuddyRow.onlinetime <= 15}
	<div  class="tooltip listaara" data-tooltip-content="{$myBuddyRow.onlinetime} {$LNG.bu_minutes}"></div>
	{else}
	<div class="tooltip listaoff" data-tooltip-content="{$LNG.bu_disconnected}"></div>
	{/if}
	</div>
<a href="game.php?page=buddyList&amp;mode=delete&amp;id={$myBuddyID}" class="tooltip fl_groop_link_del" data-tooltip-content="{$LNG.msg_remove}" >×</a>

	{foreachelse}
	
        <p class="noamici">{$LNG.bu_no_buddys}<p>
		{/foreach}
		

<div class="clear"></div>   

{if !empty($otherRequestList)}
 <div class="gray_stripe piccolastriscia">
    	{$LNG.al_diplo_accept}
    </div>
{foreach $otherRequestList as $otherRequestID => $otherRequestRow}
		<div class="fl_groop_link_name" style="width:657px;">
		<img title="" src="media/files/{$otherRequestRow.avatar}" class="avatarlistaamici">
		{if {$otherRequestRow.ally_tag}}<a href="game.php?page=alliance&amp;mode=info&amp;id={$otherRequestRow.ally_id}" style="color:#4899de">[{$otherRequestRow.ally_tag}] </a>{else}{/if}
		<a href="#" onclick="return Dialog.PM({$otherRequestRow.id});" style="color:#5ca6aa">{$otherRequestRow.username}</a>
		<a href="game.php?page=galaxy&amp;galaxy={$otherRequestRow.galaxy}&amp;system={$otherRequestRow.system}" style="color:#7b7b7b">[{$otherRequestRow.galaxy}:{$otherRequestRow.system}:{$otherRequestRow.planet}]</a>
       <font class="tooltip" style="color: #8e8c8c;float: right;max-width: 300px;text-align: right;overflow: hidden;" data-tooltip-content="{$otherRequestRow.text}">{$otherRequestRow.text}</font>
		</div>
<a href="game.php?page=buddyList&amp;mode=accept&amp;id={$otherRequestID}" class="tooltip fl_groop_link_del" data-tooltip-content="{$LNG.bu_accept}"  style="color: green;border-left: solid 1px #000;">v</a>
<a href="game.php?page=buddyList&amp;mode=delete&amp;id={$otherRequestID}" class="tooltip fl_groop_link_del" data-tooltip-content="{$LNG.bu_decline}" >x</a>
<div class="clear"></div>   
{foreachelse}
{$LNG.bu_no_request}
{/foreach}
{/if}


{if !empty($myRequestList)}
 <div class="gray_stripe piccolastriscia">
    	{$LNG.al_diplo_accept_send}
    </div>
{foreach $myRequestList as $myRequestID => $myRequestRow}
	<div class="fl_groop_link_name" style="width:681px;">
		<img title="" src="media/files/{$myRequestRow.avatar}" class="avatarlistaamici">
		{if {$myRequestRow.ally_tag}}<a href="game.php?page=alliance&amp;mode=info&amp;id={$myRequestRow.ally_id}" style="color:#4899de">[{$myRequestRow.ally_tag}] </a>{else}{/if}
		<a href="#" onclick="return Dialog.PM({$myRequestRow.id});" style="color:#5ca6aa">{$myRequestRow.username}</a>
		<a href="game.php?page=galaxy&amp;galaxy={$myRequestRow.galaxy}&amp;system={$myRequestRow.system}" style="color:#7b7b7b">[{$myRequestRow.galaxy}:{$myRequestRow.system}:{$myRequestRow.planet}]</a>
<font class="tooltip" style="color: #8e8c8c;float: right;margin-right: 24px;max-width: 300px;text-align: right;overflow: hidden;" data-tooltip-content="{$myRequestRow.text}">{$myRequestRow.text}</font>
		
</div>
<a href="game.php?page=buddyList&amp;mode=delete&amp;id={$myRequestID}" class="tooltip fl_groop_link_del" data-tooltip-content="{$LNG.msg_remove}" >×</a>
<div class="clear"></div>  
{foreachelse}
<p>{$LNG.bu_no_request}<p>
{/foreach}
{/if}



<div class="listabarrabasso">
    	 
		 <a href="game.php?page=buddyList&amp;mode=enemies" class="linkbarrabasso">{$LNG.buddy_2}</a>
        <a href="game.php?page=banList" class="linkbarrabasso" style="float:right">{$LNG.lm_banned}</a>
    </div>
	
	
	
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}