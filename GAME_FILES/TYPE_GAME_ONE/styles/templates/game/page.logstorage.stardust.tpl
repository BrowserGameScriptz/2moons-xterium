{block name="title" prepend}{$LNG.allian_1}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe"  style="margin-bottom:5px;">
        <a href="game.php?page=alliance&mode=storage" style="color:#8e9394;">{$LNG.acs_stardust_1}</a>
        <img src="styles/images/arrow_right.png" alt="" /> <a href="game.php?page=alliance&mode=storage" style="float:right;">{$LNG.ally_fractions_6}</a>
        {$LNG.allian_2} 
	</div>
	{*
    <div class="ally_contents">
    	<span>{$LNG.acs_stardust_3}:</span> 0<br />
    	<span>{$LNG.acs_stardust_4}:</span> 0
    </div>
	*}
    <table id="memberList" class="tablesorter ally_ranks gray_stripe_th td_border_bottom">
	<thead>
		<tr>
			<th style="border-left:0; padding-left:5px; text-align:left;">{$LNG.allian_17}</th>            
			<th>{$LNG.allian_18}</th>
			<th>{$LNG.allian_19}</th>
            <th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{foreach $Userlist as $ID => $Player}
		<tr>
		<td style="text-align:left; padding-left:5px;">
        	<a href="#" onclick="return Dialog.Playercard({$ID}, '{$Player.nameP}');">{$Player.nameP}</a>
        </td>
        <td style="text-align:left;" class="count_res_auto">
        	<div class="res_stardust">
                <div class="res_ico"></div>
                <div class="res_count">{$Player.deposit}</div>
                <div class="clear"></div>
            </div>
		</td>
        <td style="text-align:left;" class="count_res_auto">
        	<div class="res_stardust">
                <div class="res_ico"></div>
                <div class="res_count">{$Player.widraw}</div>
                <div class="clear"></div>
            </div>
		</td>
        <td><a href="#" onclick="return Dialog.PM({$ID});" class="batn_lincks mesages" style="height:15px; float:none; padding-left:18px;"></a></td>
	</tr>
	{/foreach}
		</tbody>
</table>
</div>

</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}

