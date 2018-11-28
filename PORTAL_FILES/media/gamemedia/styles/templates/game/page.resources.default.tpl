{block name="title" prepend}{$LNG.lm_resources}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:800px;">
    <div class="gray_stripe" style="border-bottom:0;">
    	 {$header}
    </div>
<form action="?page=resources" method="post">
<input name="mode" value="send" type="hidden">
    
<table class="tablesorter ally_ranks">
<tbody>
<tr style="height:22px" class="fl_fllets_rows">
	<td style="width:40%">&nbsp;</td>
	<td style="width:10%"><font style="color:#a47d7a;">{$LNG.tech.901}</font></td>
	<td style="width:10%"><font style="color:#5ca6aa;">{$LNG.tech.902}</font></td>
	<td style="width:10%"><font style="color:#339966">{$LNG.tech.903}</font></td>
	<td style="width:10%"><font style="color:#913399">{$LNG.tech.911}</font></td>
</tr>
<tr style="height:22px" class="fl_fllets_rows">
	<td  style="text-align: left;">{$LNG.rs_basic_income}</td>
	<td><font style="color:#a47d7a;">{$basicProduction.901|number}</font></td>
	<td><font style="color:#5ca6aa;">{$basicProduction.902|number}</font></td>
	<td><font style="color:#339966">{$basicProduction.903|number}</font></td>
	<td><font style="color:#913399">{$basicProduction.911|number}</font></td>
</tr>

{foreach $productionList as $productionID => $productionRow}
<tr style="height:22px" class="fl_fllets_rows"{if $productionID == 212} id="solarsatsTemp"{/if}>
	<td style="text-align: left;line-height: 20px;"><img src="./styles/theme/gow/gebaeude/{$productionID}.gif" alt="" style="height: 20px;width: 20px;float: left;margin-right: 4px;">{$LNG.tech.$productionID } ({if $productionID  > 200}{$LNG.rs_amount}{else}{$LNG.rs_lvl}{/if} {$productionRow.elementLevel})</td>
	<td><span class="tooltip_sticky" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><font style='color:#a47d7a;'>{$LNG.tech.901}</font></th></tr> <tr> <td style='color: darkgray;'>Default</td><td >{$METALDEFAULT|number}</td> </tr><tr> <td style='color: darkgray;'><a href='/game.php?page=planet' target='_blank' title='{$LNG.planetimage_1}'>{$LNG.planet_tele_pla}</a></td><td >{$METALDSTRUCT|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.premium_1}</td><td >{$METALPREMIUM|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.peace_1}</td><td >{$METALPEACEXP|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_academy}</td><td >{$METALCADAEMY|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.offi_1}</td><td >{$METALGOUVERN|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_arsenal}</td><td >{$METALARSENAL|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.offi_2}</td><td >{$METALOFFICER|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.all_devlopment}</td><td >{$METALALLIANC|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.planet_tele_gal}7</td><td >{$METALGALA7|number}</td> </tr></tbody></table>" style="color:{if $productionRow.production.901 > 0}#a47d7a{elseif $productionRow.production.901 < 0}brown{else}#a47d7a{/if}">{$productionRow.production.901|number}{if $productionRow.production.901|number >0}<img src="./styles/images/mark.png" style="margin-left: 2px;width: 12px;height: 12px; margin-bottom:3px" value="{$productionRow.production.901|number}">{/if}</span></td>
	
	
	
	<td><span class="tooltip_sticky" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><font style='color:#5ca6aa;'>{$LNG.tech.902}</font></th></tr> <tr> <td style='color: darkgray;'>Default</td><td >{$CRYSADEFAULT|number}</td> </tr><tr> <td style='color: darkgray;'><a href='/game.php?page=planet' target='_blank' title='{$LNG.planetimage_1}'>{$LNG.planet_tele_pla}</a></td><td>{$CRYSADSTRUCT|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.premium_1}</td><td>{$CRYSAPREMIUM|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.peace_1}</td><td>{$CRYSAPEACEXP|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_academy}</td><td>{$CRYSACADAEMY|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.offi_1}</td><td>{$CRYSAGOUVERN|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_arsenal}</td><td>{$CRYSAARSENAL|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.offi_2}</td><td>{$CRYSAOFFICER|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.all_devlopment}</td><td>{$CRYSAALLIANC|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.planet_tele_gal}7</td><td >{$CRYSAGAL7|number}</td> </tr></tbody></table>" style="color:{if $productionRow.production.902 > 0}#5ca6aa{elseif $productionRow.production.902 < 0}brown{else}#5ca6aa{/if}">{$productionRow.production.902|number}{if $productionRow.production.902|number >0}<img src="./styles/images/mark.png" style="margin-left: 2px;width: 12px;height: 12px; margin-bottom:3px" value="{$productionRow.production.902|number}">{/if}</span></td>
	
	
	
	<td><span class="tooltip_sticky" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><font style='color:#339966;'>{$LNG.tech.903}</font></th></tr> <tr> <td style='color: darkgray;'>Default</td><td >{$DEUTDDEFAULT|number}</td> </tr><tr> <td style='color: darkgray;'><a href='/game.php?page=planet' target='_blank' title='{$LNG.planetimage_1}'>{$LNG.planet_tele_pla}</a></td><td>{$DEUTDDSTRUCT|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.premium_1}</td><td>{$DEUTDPREMIUM|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.peace_1}</td><td>{$DEUTDPEACEXP|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_academy}</td><td>{$DEUTDCADAEMY|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.offi_1}</td><td>{$DEUTDGOUVERN|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_arsenal}</td><td>{$DEUTDARSENAL|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.offi_2}</td><td>{$DEUTDOFFICER|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.all_devlopment}</td><td>{$DEUTDALLIANC|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.planet_tele_gal}7</td><td >{$DEUTDGAL7|number}</td> </tr></tbody></table>" style="color:{if $productionRow.production.903 > 0}#339966{elseif $productionRow.production.903 < 0}brown{else}#339966{/if}">{$productionRow.production.903|number}{if $productionRow.production.903|number >0}<img src="./styles/images/mark.png" style="margin-left: 2px;width: 12px;height: 12px; margin-bottom:3px" value="{$productionRow.production.903|number}">{/if}</span></td>
	
	
	
	<td{if $productionID == 212} id="solarsatsTemp2"{/if}><span class="tooltip_sticky" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><font style='color:#339966;'>{$LNG.tech.911}</font></th></tr> <tr> <td style='color: darkgray;'>Default</td><td >{$ENERDDEFAULT|number}</td> </tr><tr> <td style='color: darkgray;'><a href='/game.php?page=planet' target='_blank' title='{$LNG.planetimage_1}'>{$LNG.planet_tele_pla}</a></td><td>{$ENERDDSTRUCT|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.premium_1}</td><td>{$ENERDPREMIUM|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.peace_1}</td><td>{$ENERDPEACEXP|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_academy}</td><td>{$ENERDCADAEMY|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.offi_1}</td><td>{$ENERDGOUVERN|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.offi_2}</td><td>{$ENERDOFFICER|number}</td> </tr></tbody></table>" style="color:{if $productionRow.production.911 > 0}#913399{elseif $productionRow.production.911 < 0}brown{else}#913399{/if}">{$productionRow.production.911|number}{if $productionRow.production.911|number >0}<img src="./styles/images/mark.png" style="margin-left: 2px;width: 12px;height: 12px; margin-bottom:3px" value="{$productionRow.production.911|number}">{/if}</span></td>
	
	
	
	<td style="width:10%">
		{html_options name="prod[{$productionID}]" options=$prodSelector selected=$productionRow.prodLevel}
	</td>
</tr>
{/foreach}
<tr style="height:22px " class="fl_fllets_rows">
	<td style="text-align: left;text-align: left;line-height: 20px;"><img src="./styles/theme/gow/gebaeude/131.gif" style="height: 20px;width: 20px;float: left;margin-right: 4px;"><a href="#" onclick="return Dialog.info(131)" title="({$LNG.tech.131},{$LNG.tech.132},{$LNG.tech.133})">{$LNG.lv_technology} {$LNG.peace_2}</a></td>
	<td><span style="color:{if $bonusProduction.901 > 0}#a47d7a;{elseif $bonusProduction.901 < 0}brown{else}#a47d7a;{/if}">{$bonusProduction.901|number}</span></td>
	<td><span style="color:{if $bonusProduction.902 > 0}#5ca6aa{elseif $bonusProduction.902 < 0}brown{else}#5ca6aa{/if}">{$bonusProduction.902|number}</span></td>
	<td><span style="color:{if $bonusProduction.903 > 0}#339966{elseif $bonusProduction.903 < 0}brown{else}#339966{/if}">{$bonusProduction.903|number}</span></td>
	<td><span style="color:{if $bonusProduction.911 > 0}#913399{elseif $bonusProduction.911 < 0}brown{else}#913399{/if}">{$bonusProduction.911|number}</span></td>
		
</tr>
<tr style="height:22px" class="fl_fllets_rows">
	<td style="text-align: left;text-align: left;line-height: 20px;"><img src="./styles/images/auction/1.gif" style="height: 20px;width: 20px;float: left;margin-right: 4px;"><a href="/game.php?page=auctioneer&mode=inventory" target="_blank" title="{$LNG.auctioneer_26}">{$LNG.auctioneer_24}</a></td>
	<td><span style="color:{if $itemProduction.901 > 0}#a47d7a{elseif $itemProduction.901 < 0}brown{else}#a47d7a;{/if}">{$itemProduction.901|number}{if $ItemTiMeb > 0}<img src="./styles/images/mark.png" class="tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'>{$LNG.auctioneer_24}</th></tr> <tr><td><img src='./styles/images/auction/1.gif' style='height: 20px;width: 20px;float: left;margin-right: 4px;'title='{$LNG.auctioneer_booster.1}'></td><td>{$ItemTiMe}</td> </tr></tbody></table>" style="margin-left: 2px;width: 12px;height: 12px; margin-bottom:3px" value="{$itemProduction.901|number}">{/if} </span></td>
	<td><span style="color:{if $itemProduction.902 > 0}#5ca6aa{elseif $itemProduction.902 < 0}brown{else}#5ca6aa{/if}">{$itemProduction.902|number}{if $ItemTiCrb > 0}<img src="./styles/images/mark.png" class="tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'>{$LNG.auctioneer_24}</th></tr> <tr><td><img src='./styles/images/auction/1.gif' style='height: 20px;width: 20px;float: left;margin-right: 4px;' title='{$LNG.auctioneer_booster.4}'></td><td>{$ItemTiCr}</td> </tr></tbody></table>" style="margin-left: 2px;width: 12px;height: 12px; margin-bottom:3px" value="{$itemProduction.902|number}">{/if}</span></td>
	<td><span style="color:{if $itemProduction.903 > 0}#339966{elseif $itemProduction.903 < 0}brown{else}#339966{/if}">{$itemProduction.903|number} {if $ItemTiDeb > 0}<img src="./styles/images/mark.png"class="tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'>{$LNG.auctioneer_24}</th></tr> <tr><td><img src='./styles/images/auction/1.gif' style='height: 20px;width: 20px;float: left;margin-right: 4px;' title='{$LNG.auctioneer_booster.7}'></td><td>{$ItemTiDe}</td> </tr></tbody></table>" style="margin-left: 2px;width: 12px;height: 12px; margin-bottom:3px" value="{$itemProduction.903|number}">{/if}</span></td>
	<td><span style="color:{if $itemProduction.911 > 0}#913399{elseif $itemProduction.911 < 0}brown{else}#913399{/if}">{$itemProduction.911|number}</span></td>
    <td><input value="{$LNG.rs_calculate}" type="submit" style="width:62px"></td>
</tr>

<tr style="height:22px" class="fl_fllets_rows">
	<td style="text-align: left;text-align: left;line-height: 20px;"><img src="./styles/theme/gow/gebaeude/22.gif" style="height: 20px;width: 20px;float: left;margin-right: 4px;">{$LNG.rs_storage_capacity}</td>
	<td><span style="color:#a47d7a;">{$storage.901}</span></td>
	<td><span style="color:#5ca6aa;">{$storage.902}</span></td>
	<td><span style="color:#339966">{$storage.903}</span></td>
	<td><span style="color:#913399">-</span></td>
</tr>
<tr style="height:22px"  class="fl_fllets_rows">
	<td style="text-align: left;text-align: left;line-height: 20px;">{$LNG.rs_sum}</td>
	<td><span style="color:{if $totalProduction.901 > 0}#a47d7a;{elseif $totalProduction.901 < 0}brown{else}#a47d7a;{/if}">{$totalProduction.901|number}</span></td>
	<td><span style="color:{if $totalProduction.902 > 0}#5ca6aa{elseif $totalProduction.902 < 0}brown{else}#5ca6aa{/if}">{$totalProduction.902|number}</span></td>
	<td><span style="color:{if $totalProduction.903 > 0}#339966{elseif $totalProduction.903 < 0}brown{else}#339966{/if}">{$totalProduction.903|number}</span></td>
	<td><span style="color:{if $totalProduction.911 > 0}#913399{elseif $totalProduction.911 < 0}brown{else}#913399{/if}">{$totalProduction.911|number}</span></td>
</tr>
<tr style="height:22pxtext-align: left;line-height: 20px;" class="fl_fllets_rows">
	<td style="text-align: left;">{$LNG.rs_daily}</td>
	<td><span style="color:{if $dailyProduction.901 > 0}#a47d7a{elseif $dailyProduction.901 < 0}brown{else}#a47d7a;{/if}">{$dailyProduction.901|number}</span></td>
	<td><span style="color:{if $dailyProduction.902 > 0}#5ca6aa{elseif $dailyProduction.902 < 0}brown{else}#5ca6aa{/if}">{$dailyProduction.902|number}</span></td>
	<td><span style="color:{if $dailyProduction.903 > 0}#339966{elseif $dailyProduction.903 < 0}brown{else}#339966{/if}">{$dailyProduction.903|number}</span></td>
	<td><span style="color:{if $dailyProduction.911 > 0}#913399{elseif $dailyProduction.911 < 0}brown{else}#913399{/if}">{$dailyProduction.911|number}</span></td>
</tr>
<tr style="height:22px" class="fl_fllets_rows">
	<td style="text-align: left;">{$LNG.rs_weekly}</td>
	<td><span style="color:{if $weeklyProduction.901 > 0}#a47d7a{elseif $weeklyProduction.901 < 0}brown{else}#a47d7a;{/if}">{$weeklyProduction.901|number}</span></td>
	<td><span style="color:{if $weeklyProduction.902 > 0}#5ca6aa{elseif $weeklyProduction.902 < 0}brown{else}#5ca6aa{/if}">{$weeklyProduction.902|number}</span></td>
	<td><span style="color:{if $weeklyProduction.903 > 0}#339966{elseif $weeklyProduction.903 < 0}brown{else}#339966{/if}">{$weeklyProduction.903|number}</span></td>
	<td><span style="color:{if $weeklyProduction.911 > 0}#913399{elseif $weeklyProduction.911 < 0}brown{else}#913399{/if}">{$weeklyProduction.911|number}</span></td>
</tr>
</tbody>
</table>
</form>
<table class="tablesorter ally_ranks" style="margin-top: 5px;">
	<tbody><tr>
    	<td>
        	<form action="?page=resources" method="post">
            	<input name="mode" value="AllPlanets" type="hidden">
                <input name="action" value="off" type="hidden">
            	<button type="submit" style="height:100%;width:100%; background: rgba(255, 19, 0, 0.28); border: 1px rgb(251, 19, 0);">{$LNG.res_disable}</button>
            </form>
        </td>
        <td>
        	<form action="?page=resources" method="post">
            	<input name="mode" value="AllPlanets" type="hidden">
                <input name="action" value="on" type="hidden">
            	<button type="submit" style="height:100%;width:100%;background: rgba(0,149,21,0.28);border: 1px rgba(0, 255, 0, 1);">{$LNG.res_activate}</button>
            </form>
        </td>
    </tr>
</tbody></table>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script" append}
{if $produceEnergy == 0}
<script type="text/javascript">
	$(function() {
	qtips_info('#solarsatsTemp2', '<a href="#" onclick="return Dialog.info(212)">{$LNG.over_referal_more}</a>', 'bottomMiddle', 'topMiddle', 975);
	});
</script>{/if}
{/block}
