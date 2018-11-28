{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<style>
input:invalid {
    background-color: rgba(255, 0, 0, 0.27);
    border: 1px solid #6f0000;}
</style>
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
<form action="game.php?page=alliance&amp;mode=admin&amp;action=permissionsSend" method="post">
<input value="1" name="send" type="hidden">
    <div class="gray_stripe" style="padding-right:0;">
    	{$LNG.al_configura_ranks}
        {*<button id="create_new_alliance_rank" class="right_flank">+ {$LNG.all_crea_rank}</button>*}
		
		 <span Style="float:right; margin-right:10px"><a href="game.php?page=alliance&amp;mode=admin">{$LNG.bu_back}</a></span>
    </div>

	<table class="ally_ranks">
	<tbody><tr>
		<td>{$LNG.al_rank_name}</td>
				{foreach $availableRanks as $rankName}<td><img src="styles/images/alliance/{$rankName}.png" alt="" style="cursor:help;" class="tooltip" data-tooltip-content="{$LNG.al_rank_desc[$rankName]}" height="16" width="16"></td>{/foreach}
				
			</tr>
			
			{foreach $rankList as $rowId => $rankRow}
			
			<tr>
		<td>
        	<a href="game.php?page=alliance&amp;mode=admin&amp;action=permissionsSend&amp;deleteRank={$rowId}" style="margin-right:3px; margin-left:3px; font-size:15px;" class="tooltip" data-tooltip-content="{$LNG.fl_dlte_shortcut}">
            ×</a>
            <input style="width:86%" name="rank[{$rowId}][rankName]" value="{$rankRow.rankName}" type="text"></td>
				{foreach $availableRanks as $rankId => $rankName}
				<td><input name="rank[{$rowId}][{$rankId}]" value="1" {if $rankRow[$rankName]}checked{/if} type="checkbox" {if !$ownRights[$rankName]} disabled{/if}></td>
				{/foreach}
				
			</tr>
			
			
			{foreachelse}
		<tr>
		<td colspan="16">{$LNG.al_no_ranks_defined}</td>
	</tr>
	{/foreach}
		<tr>
		<td colspan="16"><input value="{$LNG.al_save}" type="submit" style="width: 100%;margin-bottom:15px;margin-top: 5px;"></td>
	</tr>
	</tbody></table>
</form>


<div id="new_alliance_rank" title="{$LNG.al_create_new_rank}" style="display:block;">
<div class="conteiner" style="border:none;padding:0px">
	<form action="game.php?page=alliance&amp;mode=admin&amp;action=permissionsSend" method="post">
		<div class="gray_stripe">
	 
	{$LNG.al_rank_name}  <input style="width: 65%;float: right;margin-top: 3px;" name="newrank[rankName]" size="20" maxlength="32" required="" type="text">
	 
                    </div> 
		{foreach $availableRanks as $rankId => $rankName}  
				<a href="#" class="ticket_row_linck">
        <span class="ticket_row_linck_id" style="width:49px;text-align: center;border-right:none"><img src="styles/images/alliance/{$rankName}.png" height="16" width="16"></span>
		        <span class="ticket_row_linck_subject" style="width: 284px;text-align:left;">{$LNG.al_rank_desc[$rankName]}</span>
                
        <span class="ticket_row_linck_time" style="width:197px;text-align:center;"></span>
                <span class="ticket_row_linck_status" style="color:green"><input name="newrank[{$rankId}]" value="1" id="rank_{$rankId}" title="{$LNG.al_rank_desc[$rankName]}" type="checkbox"></span>
                        <span class="clear"></span>
    </a>
{/foreach}
<table class="ally_ranks">
            <tbody>
           <tr>
                        <td colspan="3" ><input value="{$LNG.al_create}" type="submit" style="width:100%;margin-bottom: 5px;margin-top: 5px;"></td>
            </tr>
       </tbody></table>
                   
                  
                        
	</form>
	</div>
</div>
</div>



</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}