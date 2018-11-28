{block name="title" prepend}{$LNG.lm_topkb}{/block}
{block name="content"}
<div id="page">
    <div id="content">
<div id="ally_content" class="conteiner" style="padding-bottom: 4px;">
    <div class="gray_stripe">
       {$LNG.tkb_top} <span style="float:right;"><b>{$LNG.gl_legend}: </b><span style="color:#00FF00">{$LNG.tkb_gewinner} </span><span style="color:#FF0000"> {$LNG.tkb_verlierer}</span></span>      
    </div>
	{if $displayadsmd == 1}
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- War Of Galaxyz #Game -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2369063859511778"
     data-ad-slot="3349807407"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>{/if}
    <table class="tablesorter ally_ranks" style="margin-bottom: 3px;margin-top: 2px;">
    <tbody>
    <tr>
        <td style="width:49px;text-align: center;color: #5ca6aa;background: #091d2e;border-color: #091d2e;">{$LNG.tkb_platz}</td>
        <td style="width: 254px;text-align: center;color: #5ca6aa;background: #091d2e;border-color: #091d2e;"><span {if $order == "owner"} style="font-weight:bold;"{/if}>{$LNG.tkb_owners}</span></td>
		<td style="width:197px;text-align: center;color: #5ca6aa;background: #091d2e;border-color: #091d2e;"><a href="game.php?page=battleHall&order=date&sort={if $sort == 'ASC'}DESC{else}ASC{/if}" {if $order == "date"} style="font-weight:bold;"{/if}>{$LNG.tkb_datum}</a></td>
		<td style="width:183px;text-align: center;color: #5ca6aa;background: #091d2e;border-color: #091d2e;;"><a href="game.php?page=battleHall&order=units&sort={if $sort == 'ASC'}DESC{else}ASC{/if}" {if $order == "units"} style="font-weight:bold;"{/if}>{$LNG.tkb_units}</a></td>
		<td style="width:30px;text-align: center;color: #5ca6aa;background: #091d2e;border-color: #091d2e;">{$LNG.mg_message_title}</td>
		
    </tr>
	</tbody>
    </table>
    {foreach $TopKBList as $row}
             
	
	
	 <a target="_BLANK" href="game.php?page=raport&amp;mode=battlehall&amp;raport={$row.rid}&amp;uni=1" class="ticket_row_linck day{floor($row.date / 86400)} week{floor($row.date / 604800)}">
        <span class="ticket_row_linck_id" style="width:39px;text-align: center;border-right:none">{if $row@iteration == "1"}<img src="styles/images/iconav/1trof.png" style="height: 12px;">{elseif $row@iteration == "2"}<img src="styles/images/iconav/2trof.png" style="height: 12px;">{elseif $row@iteration == "3"}<img src="styles/images/iconav/3trof.png" style="height: 12px;" >{else}#{$row@iteration}{/if}</span>
		{if $row.result == "a"}
        <span class="ticket_row_linck_subject" style="width: 244px;text-align: center;white-space: nowrap;"> <font color="#00FF00">{$row.attacker}</font> VS <font color="FF0000">{$row.defender}</font> </span>
        {elseif $row.result == "r"}
        <span class="ticket_row_linck_subject" style="width: 244px;text-align: center;white-space: nowrap;"> <font color="#FF0000">{$row.attacker}</font> VS <font color="00FF00">{$row.defender}</font></span>
        {else}
        <span class="ticket_row_linck_subject" style="width: 244px;text-align: center;white-space: nowrap;"> <font color="orange">{$row.attacker}</font> VS <font color="orange">{$row.defender}</font></span>
        {/if}
        
        <span class="ticket_row_linck_time" style="width:187px;text-align: center;">{$row.date} {if $row.date1 == 1}<img src="styles/images/iconav/new-icon.png" style="position: absolute;margin-left:14px">{/if}</span>
		<span class="ticket_row_linck_status" style="color:darkgrey;width:20px;text-align:center;">{$row.AMOUNTCOMMENT}</span>
                <span class="ticket_row_linck_status" style="color:green;width:163px;">{$row.units|number}</span>
				
                        <span class="clear"></span>
    </a>  
	
	
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
