{block name="title" prepend}{$LNG.complain_1}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<table style="width:100%">
	<tbody><tr>
		<th colspan="2">
			{$LNG.complain_2}
		</th>
	</tr>
	<tr>
		<td>
			{$LNG.complain_3}
		</td>
		<td>
			{$LNG.complain_4}
		</td>
	</tr>
	<tr>
		<td style="width:75%">
			{$message_text}
		</td>
		<td>
			{$message_from}
		</td>
	</tr>
</tbody></table>
<form action="game.php?page=complaintMsg" method="post" onsubmit="return validateFormComplaint()" name="myForm">
<input name="mode" value="send" type="hidden">
<input name="id" value="{$MsgId}" type="hidden">
<table style="width:100%">
	<tbody><tr>
		<th colspan="2">
			{$LNG.complain_5}
		</th>
	</tr>
	<tr>
		<td>
			<input name="type_compl" value="1" type="radio" onclick="showmenu('messageBlock');" checked>{$LNG.complain_6}
		</td>
		<td>
			<input name="type_compl" value="2" type="radio" onclick="showmenu('spamBlock');">{$LNG.complain_7}
		</td>
	</tr>
	<tr>
		<td colspan="2" id="messageBlock">
			<textarea class="validate[required]" id="message" name="comment" rows="60" cols="8" style="height:100px;">{$LNG.complain_8}: message</textarea>
		</td>
		
		
	</tr>
	<tr>
		
		
		<td colspan="2" id="spamBlock" style="display:none;">
			Enter domain of the game*: <input type="text" class="validate[required]" name="domain" placeholder="Ex: google.com">
		</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<input title="{$LNG.complain_9}" value="{$LNG.complain_9}" type="submit"><br>
		</td>
	</tr>
</tbody></table>
</form>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        <!--/body-->
{/block}
{block name="script" append}
<script type="text/javascript">
	var ShowType = 0;
	function showmenu(menu){
		if(menu == 'spamBlock'){
			document.getElementById('messageBlock').style.display = "none";
			ShowType = 1;
		}else{
			document.getElementById('spamBlock').style.display = "none";
			ShowType = 0;
		}
		
			
		document.getElementById(menu).style.display = "table-cell";
		
	}	
</script>
{/block}
