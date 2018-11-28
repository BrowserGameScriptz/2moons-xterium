{block name="title" prepend}{$LNG.planet_changing}{/block}
{block name="content"}

<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="margin-bottom:5px;">
		{$LNG.planet_changing}
    </div>
	<div id="build_elements" class="officier_elements prem_shop">
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
         <div class="build_box">
            <div class="head" onclick="OpenBox('fields');">
                {$LNG.planet_incre_foe}
                <span style="color:#FC0;">{$field_max} <sup>(+{$kolvo})</sup></span>
                <span id="open_btn_fields" class="prem_open_btn">+</span>

            </div>
            <div id="box_fields" class="content_box">   
             
				
				
				<div id="box_prem_expedition" class="content_box" style="display: block;">
            	<form action="game.php?page=planet&amp;mode=field" method="POST">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/planet_tele.jpg">
                	<input id="type" value="{$fieldes}" type="hidden">
                <input id="power" value="{$fieldrat}" type="hidden">
                <input id="kolvo" value="{$kolvo}" type="hidden">
					            	               		<div class="content_form">
                      
						                                              
                                                +
                        <input id="filds" name="filds" maxlength="2" size="3" onchange="Fild();" min="0" max="99" value="0" type="number">
                        &nbsp;&nbsp;{$LNG.peace_6}&nbsp;&nbsp;
                                                	
                        <span style="float:right;"><span style="color:#0F0; font-weight:bold;" style="color:#090;" id="cost_filds">0</span> <a href="game.php?page=trader&amp;mode=obmen">DМ</a></span>
                    </div>
                  <input class="pren_btn_buy" value="{$LNG.planet_incre_ok}" type="submit">
           		                	
            	</form>
            </div>
			
			
            </div>
        </div>   
    	    	<div class="build_box">
            <div class="head" onclick="OpenBox('teleport');">
                <span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="<span style='color:#F30;'>{$LNG.planet_tele_que}</span>">?</span>
                {$LNG.planet_tele_pal}
				{if $last_relocate > TIMESTAMP}<span style="color:#F33">({$LNG.planet_tel_next} {$last_relocate_next})</span>{/if}
                                <span id="open_btn_teleport" class="prem_open_btn">+</span>
            </div>
            <div id="box_teleport" class="content_box" style="height:auto;"> 
            	<div id="box_prem_expedition" class="content_box" style="display: block;">
            	 <form action="game.php?page=planet&amp;mode=coord" method="POST">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/planet_field.jpg">
                	<input id="galaxy1" name="galaxy1" value="{$tGalaxy}" type="hidden">
                    <input id="system1" name="system1" value="{$tSystem}" type="hidden">
                    <input id="planet1" name="planet1" value="{$tPlanet}" type="hidden">   
					            	               		<div class="content_form">
                      
						                                            
                                               {$LNG.planet_tele_gal}: <input style="width:30px;" id="galaxy" min="1" max="{if $tGalaxy == 7}7{else}6{/if}" name="galaxyt" onchange="TPort();" size="1" value="{$tGalaxy}" type="number">
                    {$LNG.planet_tele_sys}: <input style="width:60px;" id="system" min="1" max="200" name="systemt" onchange="TPort();" size="3" value="{$tSystem}" type="number">
                    {$LNG.planet_tele_pla}: <input style="width:35px;" id="planets" min="1" max="20" name="planetst" onchange="TPort();" size="1" value="{$tPlanet}" type="number">
                                                 	
                        <span style="float:right;"><span style="color:#0F0; font-weight:bold;" id="cost_tp">0</span> <a href="game.php?page=trader&amp;mode=obmen">DМ</a></span>
                    </div>
                  <input class="pren_btn_buy" value="{$LNG.planet_tele_sub}" type="submit">
           		                	
            	</form>
            </div>   	
    		</div>
        </div>
         {*<div class="build_box">
            <div class="head" onclick="OpenBox('diameter');">
                <span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.lm_bonus}:<br />
• {$LNG.ov_diameter}<span style='color:#0C0; font-weight:bold;'>{$isPlanetDiameter}</span><br />                  
• {$LNG.ov_fields} <span style='color:#0C0; font-weight:bold;'>{$isPlanetFields}</span>">?</span>{$LNG.planet_dia_s_2}<span id="open_btn_diameter" class="prem_open_btn">-</span> 
            </div>
            <div id="box_diameter" class="content_box" style="height: auto;"> 
			<img class="pren_img" alt="" title="" src="/styles/images/premium/planet_dia.jpg">
			<div class="content_form">
{$LNG.customm_6}: {$LNG.tech.922} <span style="color:#{if $isPlanetAMK < 60000}F30{else}0F0{/if}; font-weight:bold;" class="tooltip" data-tooltip-content="{$LNG.planet_dia_s_3}: {$isPlanetAM|number}"> 60.000
            </div>
			<form action="game.php?page=planet&amp;mode=dimeter" method="POST">
            <input class="pren_btn_buy" value="{$LNG.planet_incre_ok}" type="submit"> </form>          
			</div>
    	</div>  *}
		
      
	{if $shozpltype == 1}
        <div class="build_box">
        <div class="head" onclick="OpenBox('planet_image');">
            <span>{$LNG.planetimage_1}</span>
            <span id="open_btn_planet_image" class="prem_open_btn">+</span>            
        </div>
        <div id="box_planet_image" class="content_box" style="height:auto;">
        	<div style="padding:10px; color:#CCC; line-height:20px;">
            	                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/dschjungelplanet01.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.dschjungelplanet01}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('dschjungelplanet01');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/dschjungelplanet02.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.dschjungelplanet02}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('dschjungelplanet02');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/dschjungelplanet03.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.dschjungelplanet03}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('dschjungelplanet03');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/dschjungelplanet04.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.dschjungelplanet04}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('dschjungelplanet04');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/dschjungelplanet05.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.dschjungelplanet05}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('dschjungelplanet05');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/dschjungelplanet06.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.dschjungelplanet06}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('dschjungelplanet06');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/dschjungelplanet07.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.dschjungelplanet07}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('dschjungelplanet07');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/dschjungelplanet08.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.dschjungelplanet08}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('dschjungelplanet08');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/dschjungelplanet09.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.dschjungelplanet09}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('dschjungelplanet09');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/dschjungelplanet10.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.dschjungelplanet10}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('dschjungelplanet10');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/eisplanet01.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.eisplanet01}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('eisplanet01');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/eisplanet02.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.eisplanet02}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('eisplanet02');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/eisplanet03.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.eisplanet03}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('eisplanet03');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/eisplanet04.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.eisplanet04}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('eisplanet04');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/eisplanet05.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.eisplanet05}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('eisplanet05');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/eisplanet06.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.eisplanet06}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('eisplanet06');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/eisplanet07.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.eisplanet07}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('eisplanet07');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/eisplanet08.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.eisplanet08}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('eisplanet08');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/eisplanet09.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.eisplanet09}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('eisplanet09');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/eisplanet10.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.eisplanet10}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('eisplanet10');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/gasplanet01.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.gasplanet01}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('gasplanet01');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/gasplanet02.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.gasplanet02}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('gasplanet02');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/gasplanet03.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.gasplanet03}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('gasplanet03');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/gasplanet04.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.gasplanet04}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('gasplanet04');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/gasplanet05.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.gasplanet05}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('gasplanet05');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/gasplanet06.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.gasplanet06}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('gasplanet06');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/gasplanet07.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.gasplanet07}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('gasplanet07');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/gasplanet08.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.gasplanet08}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('gasplanet08');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/normaltempplanet01.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.normaltempplanet01}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('normaltempplanet01');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/normaltempplanet02.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.normaltempplanet02}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('normaltempplanet02');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/normaltempplanet03.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.normaltempplanet03}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('normaltempplanet03');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/normaltempplanet04.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.normaltempplanet04}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('normaltempplanet04');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/normaltempplanet05.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.normaltempplanet05}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('normaltempplanet05');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/normaltempplanet06.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.normaltempplanet06}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('normaltempplanet06');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/normaltempplanet07.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.normaltempplanet07}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('normaltempplanet07');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/trockenplanet01.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.trockenplanet01}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('trockenplanet01');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/trockenplanet02.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.trockenplanet02}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('trockenplanet02');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/trockenplanet03.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.trockenplanet03}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('trockenplanet03');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/trockenplanet04.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.trockenplanet04}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('trockenplanet04');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/trockenplanet05.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.trockenplanet05}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('trockenplanet05');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/trockenplanet06.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.trockenplanet06}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('trockenplanet06');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/trockenplanet07.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.trockenplanet07}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('trockenplanet07');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/trockenplanet08.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.trockenplanet08}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('trockenplanet08');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/trockenplanet09.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.trockenplanet09}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('trockenplanet09');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/trockenplanet10.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.trockenplanet10}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('trockenplanet10');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wasserplanet01.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wasserplanet01}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wasserplanet01');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wasserplanet02.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wasserplanet02}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wasserplanet02');">{$LNG.planetimage_58}</button>
                </div>
								                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wasserplanet03.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wasserplanet03}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wasserplanet03');">{$LNG.planetimage_58}</button>
                </div>
				
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wasserplanet04.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wasserplanet04}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wasserplanet04');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wasserplanet05.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wasserplanet05}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wasserplanet05');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wasserplanet06.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wasserplanet06}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wasserplanet06');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wasserplanet07.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wasserplanet07}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wasserplanet07');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wasserplanet08.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wasserplanet08}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wasserplanet08');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wasserplanet09.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wasserplanet09}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wasserplanet09');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wuestenplanet01.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wuestenplanet01}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wuestenplanet01');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wuestenplanet02.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wuestenplanet02}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wuestenplanet02');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wuestenplanet03.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wuestenplanet03}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wuestenplanet03');">{$LNG.planetimage_58}</button>
                </div>
                                <div class="planetarium_img_block">
                	<div class="planetarium_img_preview" style="background-image:url(./styles/theme/gow/planeten/wuestenplanet04.jpg);">
                    	<span class="planetarium_img_desc tooltip" data-tooltip-content="{$LNG.planet_structure.wuestenplanet04}">?</span>
                    </div>
                    <button class="bottom_band_submit planetarium_img_button" onclick="planetChangeImage('wuestenplanet04');">{$LNG.planetimage_58}</button>
                </div>
                            </div>
        </div>
    </div>
		{/if}
        <div class="build_box">
        <div class="head" onclick="OpenBox('planet_rename');">
            {$LNG.planet_rename}
            <span id="open_btn_planet_rename" class="prem_open_btn">+</span>
        </div>
        <div id="box_planet_rename" class="content_box" style="height:auto;">
			<div id="box_prem_expedition" class="content_box" style="display: block;">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/planet_nome.jpg">
					            	               		<div class="content_form">   
 <label for="password">{$LNG.ov_rename_label}: </label>														
                                              <input class="left" name="name" id="name" size="12" maxlength="10" autocomplete="off" type="text" value="{$pName}">                  	
                        <span style="float:right;"><label onclick="GenerateName()" style="color:#999; margin-left:3px;">{$LNG.planet_rename_gen}</label>
                    </div>
                  <input class="pren_btn_buy" onclick="checkrename()" value="{$LNG.mg_send}" type="button">
           		                	
            	
        </div>
    </div></div>
   <!-- <div class="build_box">
        <div class="head" onclick="OpenBox('delete_planet');">
            <span style="color:#F33">{$LNG.planet_delete}</span>
            <span id="open_btn_delete_planet" class="prem_open_btn">+</span>            
        </div>
        <div id="box_delete_planet" class="content_box" style="height:auto;">
		<div id="box_prem_expedition" class="content_box" style="display: block;">
		<img class="pren_img" alt="" title="" src="/styles/images/premium/planet_canc.jpg">
        	<div class="content_form">
            <span style="color:#999;font-size: 10px;float: right;">{$ov_security_confirm}</span>
            <input class="left" name="password" id="password" size="25" maxlength="25"  placeholder="{$LNG.ov_password}"autocomplete="off" type="password">
                      
            
			</div>
			  <input class="pren_btn_buy" onclick="checkcancel()" value="{$LNG.mg_send}" type="button">
		</div>
        </div>
    </div>-->
	
	<div class="build_box">
        <div class="head" onclick="OpenBox('delete_planet');">
            <span style="color:#F33">{$LNG.planet_delete}</span>
            <span id="open_btn_delete_planet" class="prem_open_btn">+</span>            
        </div>
        <div id="box_delete_planet" class="content_box" style="height:auto;">
        	<div style="padding:10px; color:#CCC; line-height:20px;">
            <span style="color:#999;">{$ov_security_confirm}</span><br>
                        <label for="password">{$LNG.ov_password}: </label>
            <input class="left" name="password" id="password" size="25" maxlength="25" autocomplete="off" type="password">
                        <input onclick="checkcancel()" value="{$LNG.mg_send}" type="button">
            </div>
        </div>
    </div>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
        
{/block}
{block name="script" append}
<script type="text/javascript">
	var lng = "{$LNG.planet_del}";
	var imageCost = "{$LNG.planet_image1}.\n{$LNG.planet_image2}.\n{$LNG.planet_image3}: {$price} {$LNG.planet_image4}";
</script>
{/block}