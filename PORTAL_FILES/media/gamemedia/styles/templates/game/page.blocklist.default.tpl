{block name="title" prepend}Block List{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="padding-right:0;margin-bottom:2px;">
    	Block List
    </div>
	{foreach $myBuddyList as $myBuddyID => $myBuddyRow}
	
		<div class="fl_groop_link_name" style="width:681px;">
		<img title="" src="media/files/{$myBuddyRow.avatar}" class="avatarlistaamici">
		{if {$myBuddyRow.ally_tag}}<a href="game.php?page=alliance&amp;mode=info&amp;id={$myBuddyRow.ally_id}" style="color:#4899de">[{$myBuddyRow.ally_tag}] </a>{else}{/if}
		<a href="#" onclick="return Dialog.PM({$myBuddyRow.id});" style="color:#5ca6aa">{$myBuddyRow.username}</a>
<font class="tooltip" style="color: #8e8c8c;float: right;margin-right: 24px;max-width: 300px;text-align: right;overflow: hidden;" data-tooltip-content="{$LNG.tkb_datum} block">{$myBuddyRow.time}</font>
		
</div>
<a href="game.php?page=BlockList&amp;mode=delete&amp;id={$myBuddyID}" class="tooltip fl_groop_link_del" data-tooltip-content="{$LNG.msg_remove}" >×</a>
<div class="clear"></div>  
{foreachelse}
<p class="noamici">No players blocked<p>
{/foreach}


<div class="listabarrabasso">
    	 
	 <a href="game.php?page=buddyList" class="linkbarrabasso">{$LNG.buddy_1}</a>
        <a href="game.php?page=buddyList&amp;mode=enemies" class="linkbarrabasso" style="float:right">{$LNG.buddy_2}</a>
    </div>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}