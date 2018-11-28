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
th{
     color: #5ca6aa;
	 background: #091d2e;
}
tr{
     background: #000813;
	 border-color: #000000;
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

  <table class="tablesorter ally_ranks" style="border-spacing: 0px 2px;border-collapse: separate;">
            <tbody><tr>
	<th style="width: 76px;">{$LNG.st_position}</th>
	<th ><span class="honorRank" style="background-position: 25px 0;width: 24px;">&nbsp;</span>[{$LNG.st_alliance}] {$LNG.st_player}</th>
	<th >&nbsp;</th>
	<th >&nbsp;</th>
	<th>&nbsp;</th>
	<th style=";text-align: right;padding-right: 10px;font-weight: bold; ">{$LNG.st_points}</th>
</tr></tbody></table>

  <table class="tablesorter ally_ranks" style="border-spacing: 0px 2px;border-collapse: separate;padding:0px 2px 2px 2px">
            <tbody>
{foreach name=RangeList item=RangeInfo from=$RangeList}
<tr class="fl_fllets_rows {if $RangeInfo.id == $CUser_id}mionome{/if}">
	<td id="{$RangeInfo.rank}" style="border-right:none;color:#a9a9a9;text-align:left;padding-left: 10px;border-color: #000000;{if $RangeInfo.urlaubs_next_allowed == 1}background-color:rgba(165,81,200,0.80);{/if}">{if $RangeInfo.rank == "1"}<img src="styles/images/iconav/1trof.png" style="height: 12px;">{elseif $RangeInfo.rank == "2"}<img src="styles/images/iconav/2trof.png" style="height: 12px;">{elseif $RangeInfo.rank == "3"}<img src="styles/images/iconav/3trof.png" style="height: 12px;" >{else}#{$RangeInfo.rank}{/if}</td>
    <td style="border-right:none;border-left:none;border-color: #000000;">{if $RangeInfo.dif == 0}<span style="color:#87CEEB">*</span>{elseif $RangeInfo.dif < 0}<span style="color:#d43635"><img src="styles/images/frecciagiu.gif" title="" alt="">&nbsp;{{$RangeInfo.dif|number}*(-1)}</span>{elseif $RangeInfo.dif > 0}<span style="color:#9c0"><img src="styles/images/frecciasu.gif" title="" alt="">&nbsp;{$RangeInfo.dif|number}</span>{/if}</td>
	<td style="text-align: left;padding-left: 10px;border-right:none;border-left:none;border-color: #000000;">
	
    	{if $RangeInfo.HonourStatus != 'none'}<span class="honorRank {$RangeInfo.HonourStatus}">&nbsp;</span>{else}<span class="honorRank" style="background-position: 15px 0;">&nbsp;</span>{/if} {if $RangeInfo.allyid != 0}<a href="game.php?page=alliance&amp;mode=info&amp;id={$RangeInfo.allyid}"><span {if $RangeInfo.allyid == $CUser_ally}style="color:#33CCFF"{else}style="color:#4899de"{/if} class="tooltip" data-tooltip-content="{$RangeInfo.allyname} {if $RangeInfo.ally_fraction_id != 0}<img alt='' class='fraction_ico_mini_t' src='styles/images/alliance/fraction_{$RangeInfo.ally_fraction_id}.png'><div style='border-bottom:1px dashed #666; margin:0px 0 4px 0;'></div>{$RangeInfo.ally_fraction_name} ({$RangeInfo.ally_fraction_level}){else}{/if}">[{$RangeInfo.allytag}]&nbsp;</span></a>{else}{/if}<a href="#" onclick="return Dialog.Playercard({$RangeInfo.id}, '{$RangeInfo.name}');"{if $RangeInfo.id == $CUser_id}style="color:lime"{else}style="color:#5ca6aa"{/if}><span class="{foreach $RangeInfo.class as $color}{$color}{/foreach}"><b>{$RangeInfo.name}</b>&nbsp;<span style="color:{if $RangeInfo.honour_pots >= 0}#9c0!important{else}#d43635!important{/if}">({$RangeInfo.honour_points})</span></span></a> 
       {* {foreach $RangeInfo.classb as $color}(<span class="{$color}">{if $color == "vert"}n{else}с{/if}</span>){/foreach} *}
            </td>
	<td style="border-right:none;border-left:none;border-color: #000000;">{if $RangeInfo.id != $CUser_id}<a href="#" onclick="return Dialog.PM({$RangeInfo.id});"><img src="styles/images/iconav/mesages.png" title="{$LNG.st_write_message}" alt="{$LNG.st_write_message}"></a>{/if}</td>
	<td style="border-right:none;border-left:none;border-color: #000000;">{if $RangeInfo.playercard_country != ""}<img src="styles/images/flags/{$RangeInfo.playercard_country}.png" alt="{$RangeInfo.playercard_country}" height="16px" width="16px">{else}<img src="media/images/{$RangeInfo.langused}.png" alt="{$RangeInfo.langused}" height="16px" width="16px">{/if}</td>
		<td style="border-right:none;border-left:none;border-color: #000000;">{if $RangeInfo.pointsinday == 0}<span style="color:#87CEEB">*</span>{elseif $RangeInfo.pointsinday < 0}<span style="color:red">{$RangeInfo.pointsinday|number}</span>{elseif $RangeInfo.pointsinday > 0}<span style="color:green">+{$RangeInfo.pointsinday|number}</span>{/if}</td>
		
	<td style="text-align: right;padding-right: 10px;color: #a9a9a9;border-left:none;border-color: #000000;"{if $type == 2 || $type == 5} class="tooltip" data-tooltip-content="{$RangeInfo.totalCount|number}"{/if}>{$RangeInfo.points}</td>
</tr>
{/foreach}


      