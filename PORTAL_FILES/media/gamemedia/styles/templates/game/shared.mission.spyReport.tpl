<div class="spyRaport"> <div class="spyRaportHead"> 

<a href="game.php?page=galaxy&amp;galaxy={$targetPlanet.galaxy}&amp;system={$targetPlanet.system}">{if $isAlliancePlanet != 0}<span style="color:lime; font-weight:700;">{/if}{$title}{if $isAlliancePlanet != 0}</span>{/if}</a> </div> 

{foreach $spyData as $Class => $elementIDs}
	{if $Class == 900}
<div class="spyRaportContainerHead"><span onclick="$('#c900_{$msId}').slideToggle();">{$LNG.tech.$Class} ⇓</span></div> <div id="c900_{$msId}" class="spyRaportContainerCell" style=" width:100%; height:auto; float:none; clear:both; padding:0; line-height:13px !important; border:0;"> <table class="tablesorter ally_ranks"> <tbody>
{foreach $elementIDs as $elementID => $amount}
{if ($amount@iteration % 2) === 1}<tr>{/if} <td style="text-align:left;"> <img class="ico_res_spio" alt="{$LNG.tech.$elementID}" title="{$LNG.tech.$elementID}" src="styles/images/{$elementID}.gif"> <span class="text_res_spio_{if $elementID == 901}m{elseif $elementID == 902}k{elseif $elementID == 903}d{elseif $elementID == 911}e{/if}">
                    {$amount|number}
                                    </span> </td> 
{/foreach}									{if ($amount@iteration % 2) === 1}</tr>{/if}

									</tbody></table> </div>
									{/if}
				{/foreach}
{foreach $spyData as $Class => $elementIDs}
	{if $Class < 900}
				<div class="spyRaportContainerHead"><span onclick="$('#c_{$Class}_{$msId}').slideToggle();">{$LNG.tech.$Class} ⇓</span></div> <div id="c_{$Class}_{$msId}"> 
					{foreach $elementIDs as $elementID => $amount}
					<div class="spyRaportContainerBlock"> <div class="spyRaportContainerCellImg"> <a href="#" onclick="return Dialog.info({$elementID})" title="{$LNG.tech.$elementID}"> <img alt="{$LNG.tech.$elementID}" title="{$LNG.tech.$elementID}" src="styles/theme/gow/gebaeude/{$elementID}.gif"> </a> </div> <div class="spyRaportContainerCellName">
                    	{$LNG.tech.$elementID}
                    </div> <div class="spyRaportContainerCellCount">
                        {$amount|number}
                    </div> </div> 
					{/foreach}
					 
					</div> <div class="clear"></div> 
					{/if}
					{/foreach}
					
					<div class="spyRaportFooter">
					
					{if $targetChance >= $spyChance}{$LNG.sys_mess_spy_destroyed}{else}{sprintf($LNG.sys_mess_spy_lostproba, $targetChance)}{/if}
					<br><br>
					
					{if $isBattleSim}
                    <a style=" display: block;text-decoration: none;text-shadow: 0px 1px 0px rgba(0,0,0,0.3);background: #091527;-moz-box-shadow: inset 1px 1px #142c52,inset -1px -1px #142c52;-webkit-box-shadow: inset 1px 1px #142c52,inset -1px -1px #142c52;box-shadow: inset 1px 1px #142c52,inset -1px -1px #142c52;filter: progid:DXImageTransform.Microsoft.gradient(startColorstr= '#0a1629',endColorstr = '#091324');-ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr = '#0a1629', endColorstr = '#091324')'; background-image: -moz-linear-gradient(top,#0a1629,#091324); background-image: -ms-linear-gradient(top,#0a1629,#091324);background-image: -o-linear-gradient(top,#0a1629,#091324);background-image: -webkit-gradient(linear,center top,center bottom,from(#0a1629),to(#091324));background-image: -webkit-linear-gradient(top,#0a1629,#091324);background-image: linear-gradient(top,#0a1629,#091324);text-align: center;width:47.5%;float: left;padding: 5px;" href="game.php?page=battleSimulator{foreach $spyData as $Class => $elementIDs}{foreach $elementIDs as $elementID => $amount}&amp;im[{$elementID}]={$amount}{/foreach}{/foreach}&pid={$targetPlanet.id_owner}">{$LNG.fl_simulate}</a> 
					{/if}
					<a style="color: #fff;
    background: #a51010;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr= '#b51111',endColorstr = '#910e0e');
    -ms-filter: 'progid:DXImageTransform.Microsoft.gradient(startColorstr = '#b51111', endColorstr = '#910e0e')';
    background-image: -moz-linear-gradient(top,#b51111,#910e0e);
    background-image: -ms-linear-gradient(top,#b51111,#910e0e);
    background-image: -o-linear-gradient(top,#b51111,#910e0e);
    background-image: -webkit-gradient(linear,center top,center bottom,from(#b51111),to(#910e0e));
    background-image: -webkit-linear-gradient(top,#b51111,#910e0e);
    background-image: linear-gradient(top,#b51111,#910e0e);
    -moz-box-shadow: inset 1px 1px #e91616,inset -1px -1px #e91616;
    -webkit-box-shadow: inset 1px 1px #e91616,inset -1px -1px #e91616;
    box-shadow: inset 1px 1px rgba #e91616,inset -1px -1px #e91616;
    text-shadow: 0px 1px 0px rgba(0,0,0,0.9);
	text-align: center;width: {if $isBattleSim}47.5%{else}100%{/if};float: right;padding: 5px;" href="game.php?page=fleetTable&amp;galaxy={$targetPlanet.galaxy}&amp;system={$targetPlanet.system}&amp;planet={$targetPlanet.planet}&amp;planettype={$targetPlanet.planet_type}&amp;target_mission=1">{$LNG.type_mission.1}</a><br>
					<br></div> </div>