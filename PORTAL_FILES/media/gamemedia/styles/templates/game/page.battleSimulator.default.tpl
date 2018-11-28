{block name="title" prepend}{$LNG.lm_battlesim}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">

<div class="overlay">
    <div id="loading-img"></div>
</div>


	<form id="form" name="battlesim">
		<input type="hidden" name="slots" id="slots" value="{$Slots + 1}">
        <input type="hidden" name="Pid" id="Pid" value="{$Pid}">
    <div class="gray_stripe" style="padding-right:0;">
    	{$LNG.moonsim_1}
		
        <input class="right_flank input_blue" onclick="window.location = '?page=battleSimulator&amp;mode=missilesim';" value="{$LNG.lm_battlesim} {$LNG.tech.500}" type="button">
		<input class="right_flank input_blue" onclick="window.location = '?page=battleSimulator&amp;mode=expeditionSim';" style="border-radius:0;margin-right:10px;" value="Expedition Simulator" type="button">
        <input class="right_flank input_blue" style="border-radius:0;margin-right:10px;" onclick="window.location = '?page=battleSimulator&amp;mode=MoonSim';" value="{$LNG.moonsim_2}" type="button">
				
		<!--<input class="right_flank input_blue" style="border-radius:0;margin-right:10px;" onclick="window.location = '?page=battleSimulator&amp;mode=switchside';" value="Switch side" type="button">-->		
		

</div>
    <div class="battlesim_ress">
		{$LNG.bs_steal}
        {$LNG.tech.901}: <input size="10" value="{if isset($battleinput.0.1.901)}{$battleinput.0.1.901}{else}0{/if}" name="battleinput[0][1][901]" type="text"> 
        {$LNG.tech.902}: <input size="10" value="{if isset($battleinput.0.1.902)}{$battleinput.0.1.902}{else}0{/if}" name="battleinput[0][1][902]" type="text"> 
        {$LNG.tech.903}: <input size="10" value="{if isset($battleinput.0.1.903)}{$battleinput.0.1.903}{else}0{/if}" name="battleinput[0][1][903]" type="text"> 
	</div>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs">
        <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
  {section name=tab start=0 loop=$Slots}<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="#tabs-{$smarty.section.tab.index}">{$LNG.bs_acs_slot} {$smarty.section.tab.index + 1}</a></li>{/section}
<li class="ui-state-default ui-corner-top ui-tabs-selected" ><a class="ui-tabs-anchor tooltip" onclick="return add();" data-tooltip-content="{$LNG.bs_add_acs_slot}" style="cursor:pointer" value="{$LNG.bs_add_acs_slot}">+</a></li>                    </ul>
        <div class="clear"></div>
		{section name=content start=0 loop=$Slots}
                <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="tabs-{$smarty.section.content.index}">
            <table class="battlesim_table battlesim_table_left">
                <tbody><tr>
                    <th colspan="2">{$LNG.bs_techno}</th>
                    <th>{$LNG.bs_atter}<!--<a onclick="window.location = '?page=battleSimulator{if $Mode == 'switchside'}{else}&amp;mode=switchside{/if}';" class="tooltip" data-tooltip-content="{$LNG.pla_attack_8}"><img src="./styles/images/frecciesim.png" style="margin-left: 5px;width: 12px;height: 12px; " value="{$LNG.pla_attack_8}"></a>--></th>
                    <th>{$LNG.bs_deffer}</th>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><span class="reset">{$LNG.bs_reset}</span></td>
                    <td><span class="reset">{$LNG.bs_reset}</span></td>
                </tr>
                <tr>
                    <td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/109.gif" alt="{$LNG.tech.109}"></td>
                    <td class="battlesim_name_ship">{$LNG.tech.109}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.109)}{$battleinput.{$smarty.section.content.index}.0.109}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][109]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.109)}{$battleinput.{$smarty.section.content.index}.1.109}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][109]" type="text"></td>
                </tr> 
                <tr>
                    <td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/110.gif" alt="{$LNG.tech.110}"></td>
                    <td class="battlesim_name_ship">{$LNG.tech.110}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.110)}{$battleinput.{$smarty.section.content.index}.0.110}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][110]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.110)}{$battleinput.{$smarty.section.content.index}.1.110}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][110]" type="text"></td>
                </tr>
                <tr>
                    <td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/111.gif" alt="{$LNG.tech.111}"></td>
                    <td class="battlesim_name_ship">{$LNG.tech.111}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.111)}{$battleinput.{$smarty.section.content.index}.0.111}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][111]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.111)}{$battleinput.{$smarty.section.content.index}.1.111}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][111]" type="text"></td>
                </tr>
                <tr>
                    <td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/120.gif" alt="{$LNG.tech.120}"></td>
                    <td class="battlesim_name_ship">{$LNG.tech.120}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.120)}{$battleinput.{$smarty.section.content.index}.0.120}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][120]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.120)}{$battleinput.{$smarty.section.content.index}.1.120}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][120]" type="text"></td>
                </tr>
                <tr>
                    <td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/121.gif" alt="{$LNG.tech.121}"></td>
                    <td class="battlesim_name_ship">{$LNG.tech.121}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.121)}{$battleinput.{$smarty.section.content.index}.0.121}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][121]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.121)}{$battleinput.{$smarty.section.content.index}.1.121}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][121]" type="text"></td>
                </tr>
                <tr>
                    <td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/122.gif" alt="{$LNG.tech.122}"></td>
                    <td class="battlesim_name_ship">{$LNG.tech.122}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.122)}{$battleinput.{$smarty.section.content.index}.0.122}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][122]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.122)}{$battleinput.{$smarty.section.content.index}.1.122}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][122]" type="text"></td>
                </tr>
                <tr>
                    <td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/199.gif" alt="{$LNG.tech.199}"></td>
                    <td class="battlesim_name_ship">{$LNG.tech.199}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.199)}{$battleinput.{$smarty.section.content.index}.0.199}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][199]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.199)}{$battleinput.{$smarty.section.content.index}.1.199}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][199]" type="text"></td>
                </tr>
            </tbody></table>                        
            <table class="battlesim_table battlesim_table_right">
                <tbody><tr>
                    <th colspan="2">
                    	{$LNG.lm_academy} 
                        <span style="color:#666; float:right; cursor:pointer;" onclick="$('.battlesim_skils_hiden').toggle();">[{$LNG.raport_2}]</span>
                    </th>
                   <th>{$LNG.bs_atter}<!--<a onclick="window.location = '?page=battleSimulator{if $Mode == 'switchside'}{else}&amp;mode=switchside{/if}';" class="tooltip" data-tooltip-content="{$LNG.pla_attack_8}"><img src="./styles/images/frecciesim.png" style="margin-left: 5px;width: 12px;height: 12px; " value="{$LNG.pla_attack_8}"></a>--></th>
                    <th>{$LNG.bs_deffer}</th>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><span class="reset">{$LNG.bs_reset}</span></td>
                    <td><span class="reset">{$LNG.bs_reset}</span></td>
                </tr>
					<tr>
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1101.jpg" alt="{$LNG.academy_title.1101}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1101}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1101)}{$battleinput.{$smarty.section.content.index}.0.1101}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1101]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1101)}{$battleinput.{$smarty.section.content.index}.1.1101}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1101]" type="text"></td>
                </tr>
					<tr>
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1102.jpg" alt="{$LNG.academy_title.1102}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1102}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1102)}{$battleinput.{$smarty.section.content.index}.0.1102}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1102]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1102)}{$battleinput.{$smarty.section.content.index}.1.1102}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1102]" type="text"></td>
                </tr>
                <tr>
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1103.jpg" alt="{$LNG.academy_19}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_19}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1103)}{$battleinput.{$smarty.section.content.index}.0.1103}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1103]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1103)}{$battleinput.{$smarty.section.content.index}.1.1103}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1103]" type="text"></td>
                </tr>
					<tr>
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1112.jpg" alt="{$LNG.academy_title.1112}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1112}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1112)}{$battleinput.{$smarty.section.content.index}.0.1112}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1112]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1112)}{$battleinput.{$smarty.section.content.index}.1.1112}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1112]" type="text"></td>
                </tr>
					<tr>
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1301.jpg" alt="{$LNG.academy_title.1301}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1301}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1301)}{$battleinput.{$smarty.section.content.index}.0.1301}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1301]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1301)}{$battleinput.{$smarty.section.content.index}.1.1301}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1301]" type="text"></td>
                </tr><tr>
					<td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1302.jpg" alt="{$LNG.academy_title.1302}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1302}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1302)}{$battleinput.{$smarty.section.content.index}.0.1302}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1302]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1302)}{$battleinput.{$smarty.section.content.index}.1.1302}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1302]" type="text"></td>
                </tr> 
					<tr>
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1303.jpg" alt="{$LNG.academy_title.1303}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1303}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1303)}{$battleinput.{$smarty.section.content.index}.0.1303}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1303]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1303)}{$battleinput.{$smarty.section.content.index}.1.1303}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1303]" type="text"></td>
                </tr>
					 <tr class="battlesim_skils_hiden">
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1304.jpg" alt="{$LNG.academy_title.1304}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1304}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1304)}{$battleinput.{$smarty.section.content.index}.0.1304}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1304]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1304)}{$battleinput.{$smarty.section.content.index}.1.1304}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1304]" type="text"></td>
                </tr>
					<tr class="battlesim_skils_hiden">
					<td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1305.jpg" alt="{$LNG.academy_title.1305}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1305}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1305)}{$battleinput.{$smarty.section.content.index}.0.1305}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1305]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1305)}{$battleinput.{$smarty.section.content.index}.1.1305}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1305]" type="text"></td>
                </tr>
					<tr class="battlesim_skils_hiden">
					<td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1306.jpg" alt="{$LNG.academy_title.1306}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1306}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1306)}{$battleinput.{$smarty.section.content.index}.0.1306}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1306]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1306)}{$battleinput.{$smarty.section.content.index}.1.1306}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1306]" type="text"></td>
                </tr>
                <!--<tr>
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1108.jpg" alt="{$LNG.academy_26}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_26}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1108)}{$battleinput.{$smarty.section.content.index}.0.1108}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1108]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1108)}{$battleinput.{$smarty.section.content.index}.1.1108}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1108]" type="text"></td>
                </tr>
                <tr>
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1109.jpg" alt="{$LNG.academy_28}" class="tooltip" data-tooltip-content="Шанс уничтожения дополнительной боевой единицы того же типа без потери урона. Убитых цепной реакцией за раунд не может быть больше чем убитых без неё.">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_28}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1109)}{$battleinput.{$smarty.section.content.index}.0.1109}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1109]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1109)}{$battleinput.{$smarty.section.content.index}.1.1109}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1109]" type="text"></td>
                </tr>
                <tr>
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1110.jpg" alt="{$LNG.academy_30}" class="tooltip" data-tooltip-content="Увеличивает количество уничтоженных единиц при срабатывании цепной реакции. Убитых цепной реакцией не может быть больше чем убитых без неё за раунд. ">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_30}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1110)}{$battleinput.{$smarty.section.content.index}.0.1110}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1110]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1110)}{$battleinput.{$smarty.section.content.index}.1.1110}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1110]" type="text"></td>
                </tr>
                <tr>
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1111.jpg" alt="{$LNG.academy_35}" class="tooltip" data-tooltip-content="Позволяет сфокусироваться на уже поврежденных целях для их полного уничтожения, а не тратить урон на другие целей. По умолчанию рассеивается 30% урона.">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_35}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1111)}{$battleinput.{$smarty.section.content.index}.0.1111}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1111]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1111)}{$battleinput.{$smarty.section.content.index}.1.1111}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1111]" type="text"></td>
                </tr>
               
                <tr>
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1308.jpg" alt="{$LNG.academy_title.1308}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1308}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1308)}{$battleinput.{$smarty.section.content.index}.0.1308}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1308]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1308)}{$battleinput.{$smarty.section.content.index}.1.1308}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1308]" type="text"></td>
                </tr>
                <tr class="battlesim_skils_hiden">
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1311.jpg" alt="{$LNG.academy_title.1311}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1311}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1311)}{$battleinput.{$smarty.section.content.index}.0.1311}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1311]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1311)}{$battleinput.{$smarty.section.content.index}.1.1311}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1311]" type="text"></td>
                </tr>
                
                <tr class="battlesim_skils_hiden">
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1113.jpg" alt="{$LNG.academy_37}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_37}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1113)}{$battleinput.{$smarty.section.content.index}.0.1113}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1113]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1113)}{$battleinput.{$smarty.section.content.index}.1.1113}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1113]" type="text"></td>
                </tr>
               
               <tr class="battlesim_skils_hiden">
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1312.jpg" alt="{$LNG.academy_title.1312}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1312}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1312)}{$battleinput.{$smarty.section.content.index}.0.1312}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1312]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1312)}{$battleinput.{$smarty.section.content.index}.1.1312}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1312]" type="text"></td>
                </tr>
                <tr class="battlesim_skils_hiden">
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1313.jpg" alt="{$LNG.academy_title.1313}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1313}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1313)}{$battleinput.{$smarty.section.content.index}.0.1313}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1313]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1313)}{$battleinput.{$smarty.section.content.index}.1.1313}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1313]" type="text"></td>
                </tr>
                <tr class="battlesim_skils_hiden">
                    <td class="battlesim_img_ship">
                    	<img src="./styles/theme/gow/gebaeude/1314.jpg" alt="{$LNG.academy_title.1314}">
                    </td>
                    <td class="battlesim_name_ship">{$LNG.academy_title.1314}</td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.1314)}{$battleinput.{$smarty.section.content.index}.0.1314}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][1314]" type="text"></td>
                    <td><input size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.1314)}{$battleinput.{$smarty.section.content.index}.1.1314}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][1314]" type="text"></td>
                </tr>-->
            </tbody></table>
            <div class="clear"></div>
            <table class="battlesim_table battlesim_table_left">
                <tbody><tr>
                    <th colspan="2">{$LNG.bs_names}</th>
					<th>{$LNG.bs_atter}<!--<a onclick="window.location = '?page=battleSimulator{if $Mode == 'switchside'}{else}&amp;mode=switchside{/if}';" class="tooltip" data-tooltip-content="{$LNG.pla_attack_8}"><img src="./styles/images/frecciesim.png" style="margin-left: 5px;width: 12px;height: 12px; " value="{$LNG.pla_attack_8}">--></a></th>
					<th>{$LNG.bs_deffer}</th>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><span class="reset">{$LNG.bs_reset}</span></td>
                    <td><span class="reset">{$LNG.bs_reset}</span></td>
                </tr>
                               {foreach $fleetList as $id}     
									<tr>
                	<td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/{$id}.gif" alt="{$LNG.tech.$id}"></td>
                    <td class="battlesim_name_ship">{if $id == 224 || $id == 229 || $id == 230}<span style="color:#32CD32">{$LNG.tech.$id}</span>{else}{$LNG.tech.$id}{/if}</td>
                    <td>
					{if $id != 212}
					<input class="fleetAttCountBS" size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.$id)}{$battleinput.{$smarty.section.content.index}.0.$id}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][{$id}]" id="acsLoad{$smarty.section.content.index}-{$id}" type="text">
					{else}-{/if}
					</td>
                    <td><input class="fleetDefCountBS" size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.$id)}{$battleinput.{$smarty.section.content.index}.1.$id}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][{$id}]" type="text"></td>
                </tr>
                         {/foreach}                        
                                            </tbody></table>  
							{if $smarty.section.content.index == 0}				
                        <table class="battlesim_table battlesim_table_right">
                <tbody><tr>
                    <th colspan="2">{$LNG.achiev_8}</th>
                    <th>{$LNG.bs_deffer}</th>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><span class="reset">{$LNG.bs_reset}</span></td>
                </tr>
				{foreach $defensiveList as $id}
                                                <tr>
                	<td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/{$id}.gif" alt="{$LNG.tech.$id}"></td>
                    <td class="battlesim_name_ship">{if $id == 420 || $id == 421 || $id == 422}<span style="color:#32CD32">{$LNG.tech.$id}</span>{else}{$LNG.tech.$id}{/if}</td>
                    <td><input class="fleetDefCountBS" size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.$id)}{$battleinput.{$smarty.section.content.index}.1.$id}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][{$id}]" type="text"></td>
                </tr>{/foreach}
                                             
                                        </tbody></table>
							{elseif $smarty.section.content.index > 0}				
                        <table class="battlesim_table battlesim_table_right">
                <tbody><tr>
                    <th colspan="3">ACS LOAD TOOL</th>
                </tr>
                <tr>
                    <td colspan="3"><select name="loadId" id="loadId">
					
					{foreach $SpyListing as $ID => $Message}
						<option value="{$ID}">{$Message.title}</option>
					{/foreach}
					</select><input type="button" onclick="acsLoadTool();" value="Load"></td>
                </tr>
                                             
                                        </tbody></table>{/if}
                        <div class="clear"></div>
        </div>
		{/section}
        </div>
    <div class="gray_stripe">
    	<span class="battlesim_att_points"><span class="totalAttPoints">0</span> {$LNG.raport_3}</span>
        <span class="battlesim_def_points"><span class="totalDefPoints">0</span> {$LNG.raport_4}</span>
    </div>
    <div id="submit">
            <input onclick="return check();" value="{$LNG.bs_send}" type="button">            
    </div>
    <div id="wait" style="display:none;">
        {$LNG.bs_wait}
    </div>
</form>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script" append}
<script type="text/javascript">
	var pointsPrice = { "battleinput[0][0][202]":0.004,"battleinput[0][1][202]":0.004,"battleinput[0][0][203]":0.012,"battleinput[0][1][203]":0.012,"battleinput[0][0][204]":0.004,"battleinput[0][1][204]":0.004,"battleinput[0][0][205]":0.011,"battleinput[0][1][205]":0.011,"battleinput[0][0][206]":0.0265,"battleinput[0][1][206]":0.0265,"battleinput[0][0][207]":0.058,"battleinput[0][1][207]":0.058,"battleinput[0][0][208]":0.04,"battleinput[0][1][208]":0.04,"battleinput[0][0][209]":0.018,"battleinput[0][1][209]":0.018,"battleinput[0][0][210]":0.001,"battleinput[0][1][210]":0.001,"battleinput[0][0][211]":0.12,"battleinput[0][1][211]":0.12,"battleinput[0][0][212]":0.0025,"battleinput[0][1][212]":0.0025,"battleinput[0][0][213]":0.125,"battleinput[0][1][213]":0.125,"battleinput[0][0][214]":10.5,"battleinput[0][1][214]":10.5,"battleinput[0][0][215]":0.1,"battleinput[0][1][215]":0.1,"battleinput[0][0][216]":12.5,"battleinput[0][1][216]":12.5,"battleinput[0][0][217]":0.0565,"battleinput[0][1][217]":0.0565,"battleinput[0][0][218]":500,"battleinput[0][1][218]":500,"battleinput[0][0][219]":1.8,"battleinput[0][1][219]":1.8,"battleinput[0][0][220]":16,"battleinput[0][1][220]":16,"battleinput[0][0][221]":580,"battleinput[0][1][221]":580,"battleinput[0][0][222]":360,"battleinput[0][1][222]":360,"battleinput[0][0][223]":5.625,"battleinput[0][1][223]":5.625,"battleinput[0][0][224]":0.15,"battleinput[0][1][224]":0.15,"battleinput[0][0][225]":1.8,"battleinput[0][1][225]":1.8,"battleinput[0][0][226]":5.2,"battleinput[0][1][226]":5.2,"battleinput[0][0][227]":42,"battleinput[0][1][227]":42,"battleinput[0][0][228]":127,"battleinput[0][1][228]":127,"battleinput[0][0][229]":0.0105,"battleinput[0][1][229]":0.0105,"battleinput[0][0][230]":27.75,"battleinput[0][1][230]":27.75,"battleinput[0][1][401]":0.002,"battleinput[0][1][402]":0.002,"battleinput[0][1][403]":0.008,"battleinput[0][1][404]":0.037,"battleinput[0][1][405]":0.008,"battleinput[0][1][406]":0.13,"battleinput[0][1][407]":2,"battleinput[0][1][408]":10,"battleinput[0][1][409]":1000,"battleinput[0][1][410]":30,"battleinput[0][1][411]":7500,"battleinput[0][1][502]":0.01,"battleinput[0][1][503]":0.025,"battleinput[0][1][412]":16.5,"battleinput[0][1][413]":46,"battleinput[0][1][414]":160,"battleinput[0][1][415]":470,"battleinput[0][1][416]":0.4,"battleinput[0][1][417]":0.575,"battleinput[0][1][418]":4.1,"battleinput[0][1][419]":83.5,"battleinput[0][1][420]":0.0085,"battleinput[0][1][421]":0.38,"battleinput[0][1][422]":25.75 };
	
	var Slotting = {$Slots};
</script>
{/block}