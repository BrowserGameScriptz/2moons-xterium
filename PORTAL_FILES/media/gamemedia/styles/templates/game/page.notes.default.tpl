{block name="title" prepend}{$LNG.lm_notes}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:auto;">
    <div class="gray_stripe">
     	{$LNG.nt_notes}
    </div> 
	<form action="game.php?page=notes&amp;mode=delete" method="post">
	<table class="tablesorter ally_ranks">
		<tbody><tr>
			<td colspan="4"><a href="game.php?page=notes&amp;mode=detail"><input value="{$LNG.nt_create_new_note}" style="line-height:20px; width:200px; display:block; margin:0 auto;margin-top:10px;margin-bottom:10px" type="button"></a>
			
			
			
			
			</td>
		</tr>
		<tr>
			<th style="width:10%; color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.nt_dlte_note}</th>
			<th style="width:20%; color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.nt_date_note}</th>
			<th style="width:60%; color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.nt_subject_note}</th>
			<th style="width:10%; color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.nt_size_note}</th>
		</tr>
		
		{foreach $notesList as $notesID => $notesRow}
		<tr>
			<td style="width:20px;"><input name="delmes[{$notesID}]" type="checkbox"></td>
			<td style="width:150px;">{$notesRow.time}</td>
			<td><a href="game.php?page=notes&amp;mode=detail&amp;id={$notesID}">
			
			{if $notesRow.priority == 0}
			<span style="color:lime">{$notesRow.title}</span>
			{elseif $notesRow.priority == 2} 
			<span style="color:red">{$notesRow.title}</span>
			{else}
			<span style="color:yellow">{$notesRow.title}</span>
			{/if}
			
						</a></td>
			<td style="width:40px;">{$notesRow.size|number}</td>
		</tr>
		
		
		{if $notesRow@last}
		<tr>
		<td colspan="4" class="right"><input value="{$LNG.nt_dlte_note}" type="submit"></td>
		</tr>
		{/if}
		
		
				{foreachelse}
		<tr>
			<td colspan="4">{$LNG.nt_you_dont_have_notes}</td>
		</tr>
		{/foreach}
			</tbody></table>
	</form>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        <!--/body--> 
{/block}
