{block name="title" prepend}{$LNG.allian_1}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="margin-bottom:5px;">
        <a href="game.php?page=alliance&amp;mode=storage" style="color:#8e9394;">{$LNG.allian_1}</a>
        <img src="styles/images/arrow_right.png" alt="">
        {$LNG.st_statistics} 
        (<a href="game.php?page=alliance&amp;mode=logStorageFull">{$LNG.allian_12}</a> | 
         <a href="game.php?page=alliance&amp;mode=logstorage&amp;time=1">{$LNG.allian_13}</a> | 
         <a href="game.php?page=alliance&amp;mode=logstorage&amp;time=2">{$LNG.allian_14}</a> | 
         <a href="game.php?page=alliance&amp;mode=logstorage&amp;time=3">{$LNG.allian_15}</a>)
        <a href="game.php?page=alliance&amp;mode=logstoragereset" style="color:#009999; float:right">{$LNG.allian_16}</a>	</div>
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
        	<div class="res_901">
                <div class="res_ico"></div>
                <div class="res_count">{$Player.metal|number}</div>
                <div class="clear"></div>
            </div>
            <div class="res_902">
                <div class="res_ico"></div>
                <div class="res_count">{$Player.crystal|number}</div>
                <div class="clear"></div>
            </div>
            <div class="res_903">
                <div class="res_ico"></div>
                <div class="res_count">{$Player.deuterium|number}</div>
                <div class="clear"></div>
            </div>
		</td>
        <td style="text-align:left;" class="count_res_auto">
        	<div class="res_901">
                <div class="res_ico"></div>
                <div class="res_count">{$Player.metalBis|number}</div>
                <div class="clear"></div>
            </div>
            <div class="res_902">
                <div class="res_ico"></div>
                <div class="res_count">{$Player.crystalBis|number}</div>
                <div class="clear"></div>
            </div>
            <div class="res_903">
                <div class="res_ico"></div>
                <div class="res_count">{$Player.deuteriumBis|number}</div>
                <div class="clear"></div>
            </div>
		</td>
        <td><a href="#" onclick="return Dialog.PM({$ID});"" class="batn_lincks mesages" style="height:15px; float:none; padding-left:18px;"></a></td>
	</tr>
	{/foreach}
		</tbody>

</table>

<div class="build_band">
<a href="game.php?page=alliance&amp;mode=storage">{$LNG.al_back}</a>
</div>
</div>

</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}

