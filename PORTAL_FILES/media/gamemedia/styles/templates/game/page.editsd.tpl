{block name="title" prepend}Bullet-proof editor{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
	<form action="?page=editsd&mode=ClearCache" method="post">	
    Add rate of fire
	<input type="submit" value="Clear cache" style="display:block;float:right;">
	</form>	
    </div>
	<th>
<font color=red > Information for reading!<br>
1. If you need to edit the rate of fire, then first delete the old one! but only then add the same with the new numbers!<br>
2. The main thing was that there were no two identical speed springs with different numbers! light-light: 2 and light-light: 5. There will be a conflict in the system! KILL!<br>
3. Ships are sorted by the ID of the shooter!
</font>
</th>	
<table class="tablesorter ally_ranks">	
<tr>
<th>Ship / defense</th>
<th>Beats on:</th>
<th>Rate of fire</th>
<th>Save</th>
</tr>
<form action="?page=editsd&mode=add" method="post">	
<tr>	
<td>
{html_options name=elemID options=$short}
</td>	
<td>
{html_options name=rapID options=$short}
</td>	
<td>
<input style="width:50px; color:#FC6;" name="shoots" type="number" min="1" onchange="KeyUpBuy('');" onkeyup="KeyUpBuy('');" value="1">
</td>
<td>
<input type="submit" value="Save" style="display:block; margin:0 auto; padding:3px 15px;">
</td>
</tr>
</form>	
</table> 	
	<table class="tablesorter ally_ranks">
	<div class="gray_stripe">
   The skorostrel which is already in the database:
    </div>
	<tr>
	<th>Attacks</th>
	<th>Accepts</th>
	<th>Quantity</th>
	<th>Remove</th>
	</tr>
{foreach $fleet_i as $row}
<form action="?page=editsd&mode=del&elementID={$row.elementID}&rapidfireID={$row.rapidfireID}" method="post">
<tr>
<td><span style="color:#6C6;padding-left: 15px;"><a href="#" onclick="return Dialog.info({$row.elementID})">{$LNG.tech.{$row.elementID}}</a></span></td>
<td><span style="color:#ff0000;">{$LNG.tech.{$row.rapidfireID}}</span></td>
<td><span style="color:#FC6;">{$row.shoots}</span></td>	
<td>
<input type="submit" value="Delete" style="display:block; margin:0 auto; padding:3px 15px;">
</td>	
</tr>
</form> 
{/foreach}	
</table>
</div>
</div>
</div>
{/block}