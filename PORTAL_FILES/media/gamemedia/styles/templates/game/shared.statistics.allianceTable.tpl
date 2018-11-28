
  <style>
  td:first-child{
    -moz-border-radius:4px 0 0 4px;
    -webkit-border-radius:4px 0 0 4px;
	border-radius:4px 0 0 4px;
}
td:last-child{
    -moz-border-radius:0 4px 4px 0;
    -webkit-border-radius:0 4px 4px 0;
	border-radius:0 4px 4px 0;
}
tr{
     background: #000813;border-color: #000000;
}
th{
     color: #5ca6aa;background: #091d2e;
}
tr:hover{
       background:#000c1e;
    -moz-transition: all 0.2s ease-in;
    -webkit-transition: all 0.2s ease-in;
    -o-transition: all 0.2s ease-in;
    transition: all 0.2s ease-in;
}
.fl_fllets_rows:hover {
    background: #000c1e;
	    -moz-transition: all 0.1s ease-in;
    -webkit-transition: all 0.1s ease-in;
    -o-transition: all 0.1s ease-in;
    transition: all 0.1s ease-in;
}
.mionome {
    border-color: #193320;
    background:rgba(55, 86, 22, 0.3)
}
  
.mionome:hover {
	    background:rgba(55, 86, 22, 0.4)
}

  
  </style>
  <table class="tablesorter ally_ranks" style="border-spacing: 0px 2px;    border-collapse: separate;">
     <tbody><tr>
	<th colspan="2" >{$LNG.st_position}</th>
	<th >[Fraction]{$LNG.st_alliance}</th>	
	<th style="text-align: center;">{$LNG.st_members}</th>
	<th style="text-align: center;">{$LNG.st_points}</th>
	<th style=" text-align: right;">{$LNG.st_per_member}</th>
</tr></tbody></table>

  <table class="tablesorter ally_ranks" style="border-spacing: 0px 2px;border-collapse: separate;padding:0px 2px 2px 2px">
            <tbody>
{foreach name=RangeList item=RangeInfo from=$RangeList}
<tr class="fl_fllets_rows {if $RangeInfo.id == $CUser_ally}mionome{/if}" style="line-height:20px">
	<td style="border-right:none;color:#a9a9a9;text-align:left;padding-left: 10px;border-color: #000000;">{if $RangeInfo.rank == "1"}<img src="styles/images/iconav/1trof.png" style="height: 12px;">{elseif $RangeInfo.rank == "2"}<img src="styles/images/iconav/2trof.png" style="height: 12px;">{elseif $RangeInfo.rank == "3"}<img src="styles/images/iconav/3trof.png" style="height: 12px;" >{else}#{$RangeInfo.rank}{/if}</td>
    <td style="border-right:none;border-left:none;border-color: #000000;">{if $RangeInfo.ranking == 0}<span style="color:#87CEEB">*</span>{elseif $RangeInfo.ranking < 0}<span style="color:#d43635"><img src="styles/images/frecciagiu.gif" title="" alt="">&nbsp;{{$RangeInfo.ranking}*(-1)}</span>{elseif $RangeInfo.ranking > 0}<span style="color:#9c0"><img src="styles/images/frecciasu.gif" title="" alt="">&nbsp;{$RangeInfo.ranking}</span>{/if}</td>
	<td style="text-align: left;padding-left: 10px;border-right:none;border-left:none;border-color: #000000;">
    	<a href="game.php?page=alliance&amp;mode=info&amp;id={$RangeInfo.id}" target="ally"{if $RangeInfo.id == $CUser_ally} style="color:#33CCFF;font-weight:bold"{elseif $RangeInfo.isWar > 0 }style="color:#FF0000;font-weight:bold"{elseif $RangeInfo.isUnion > 0 }style="color:#32CD32;font-weight:bold"{else}style="color:#5ca6aa;font-weight:bold"{/if}>
       {if $RangeInfo.ally_fraction_id != 0}<img alt="" title="" class="tooltip fraction_ico_mini_t" data-tooltip-content="{$RangeInfo.ally_fraction_name} ({$RangeInfo.ally_fraction_level})" src="styles/images/alliance/fraction_{$RangeInfo.ally_fraction_id}.png">{else}<img src="styles/images/alliance/fraction_1.png" class="fraction_ico_mini_t" style="opacity:0" >{/if}{$RangeInfo.name}
    	            	
            	</a>
    </td>
	<td style="border-right:none;border-left:none;border-color: #000000;">{$RangeInfo.members}</td>
	<td style="border-right:none;border-left:none;border-color: #000000;">{$RangeInfo.points}</td>
	<td style="text-align: right;padding-right: 10px;color: #a9a9a9;border-left:none;border-color: #000000;">{$RangeInfo.mppoints}</td>
</tr>
{/foreach}
