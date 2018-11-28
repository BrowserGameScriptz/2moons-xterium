{block name="title" prepend}{$LNG.buddy_4}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="padding-right:0;margin-bottom:2px;">
    	{$LNG.buddy_4}
       
    </div>
	
	
	{foreach $myBuddyList as $myBuddyID => $myBuddyRow}
	<div class="fl_groop_link_name" style="width: 324px;">
		<img title="" src="media/files/{$myBuddyRow.avatar}" class="avatarlistaamici">
		{if {$myBuddyRow.ally_tag}}<a href="game.php?page=alliance&amp;mode=info&amp;id={$myBuddyRow.ally_id}" style="color:#4899de">[{$myBuddyRow.ally_tag}] </a>{else}{/if}
		<a href="#" onclick="return Dialog.PM({$myBuddyRow.id});" style="color:#5ca6aa">{$myBuddyRow.username}</a>
		<a href="game.php?page=galaxy&amp;galaxy={$myBuddyRow.galaxy}&amp;system={$myBuddyRow.system}" style="color:#7b7b7b">[{$myBuddyRow.galaxy}:{$myBuddyRow.system}:{$myBuddyRow.planet}]</a>

		
	</div>
<a href="game.php?page=buddyList&amp;mode=deleteennemies&amp;id={$myBuddyID}" class="tooltip fl_groop_link_del" data-tooltip-content="{$LNG.msg_remove}" >×</a>

	{foreachelse}
	
        <p class="noamici">{$LNG.customm_23}<p>
		{/foreach}
		

<div class="clear"></div>   
	
	
	
	<div class="listabarrabasso">
    	 
		 <a href="game.php?page=buddyList" class="linkbarrabasso">{$LNG.buddy_1}</a>
        <a href="game.php?page=banList" class="linkbarrabasso" style="float:right">{$LNG.lm_banned}</a>
    </div>
	
	
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}