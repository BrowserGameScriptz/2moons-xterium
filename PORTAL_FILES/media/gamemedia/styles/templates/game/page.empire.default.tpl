{block name="title" prepend}{$LNG.empire_review}{/block}
{block name="content"}
<div id="page">
    <div id="content">
<div id="ally_content" style="width:auto;" class="conteiner">
    <div class="gray_stripe">
        {$LNG.empire_review}
                <a href="{if $userID != 1}game.php?page=userAtmLogs{else}#{/if}"{if $userID == 1} onclick="return Dialog.fullControll();" {/if}class="imper_gala_bonuses imper_atm_logs">{$LNG.empire_review_1}</a>
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
    {if $coultAll > 1}
            <div id="empire_filtrs">
        <span onclick="filtrsall();" id="filtrsall" class="imper_btn_filtrs imper_btn_filtrs_activ">{$LNG.market_4} <span>({$coultAll})</span></span>
        <span onclick="filtrsplanet();" id="filtrsplanet" class="imper_btn_filtrs">{$LNG.empire_review_4} <span>({$coultPlanet})</span></span>
        {if $coultMoon != 0}<span onclick="filtrsmoon();" id="filtrsmoon" class="imper_btn_filtrs">{$LNG.empire_review_5} <span>({$coultMoon})</span></span>{/if} 
		{if $isMaxGal6 != 0}<span onclick="filtrsbplanet();" id="filtrsbplanet" class="imper_btn_filtrs">{$LNG.placountmod6} <span>({$isMaxGal6})</span></span>{/if}
		{if $isMaxAPlanet != 0}<span onclick="filtrsaplanet();" id="filtrsaplanet" class="imper_btn_filtrs">{$LNG.all_aly_pal} <span>({$isMaxAPlanet})</span></span>{/if}
		<div class="clear"></div>
    </div>
    {/if}
        <div class="gray_stripe">
        <div class="imper_left_part">
            <a href="game.php?page=reduceresources" class="fleet_reduce ico_reduceresources tooltip" data-tooltip-content="{$LNG.fleetta_res}"></a>
            <a href="game.php?page=reducefleet" class="fleet_reduce ico_reducefleet tooltip" data-tooltip-content="{$LNG.fleetta_fle}"></a>
            <a href="game.php?page=deliveryres" class="fleet_reduce ico_deliveryres tooltip" data-tooltip-content="{$LNG.fleetta_flealt}"></a>
        </div>
        <div class="imper_right_part">          
            <div onclick="gorightMAX();" class="imper_goleft_2 imper_navigation"></div>
            <div onclick="goright();" class="imper_goleft imper_navigation"></div>
            <div onclick="goleftMAX();" class="imper_goright_2 imper_navigation"></div>
            <div onclick="goleft();" class="imper_goright imper_navigation"></div>  
            <div class="icovavigation">
                <span class="record_btn ico_star record_btn_active" title="{$LNG.tech_all}" onclick="allopen();"></span>
                <span class="record_btn ico_builds" title="{$LNG.st_buildings}" onclick="buildsopen();"></span>
                <span class="record_btn ico_fleet" title="{$LNG.pl_fleet}" onclick="fleetopen();"></span>
                <span class="record_btn ico_shield" title="{$LNG.pl_def}" onclick="defopen();"></span>
                <div class="clear"></div>
            </div>          
        </div>
    </div>
    <div class="imper_left_part">
        <div class="imper_block_image">
            <div class="imper_block_info_text">{$LNG.lv_name}</div>
            <div class="imper_block_info_text">{$LNG.lv_coords}</div>
            <div class="imper_block_info_text">{$LNG.lv_fields}</div>
            <div class="imper_block_info_text">{$LNG.empire_review_2}</div>            
        </div>
        <div class="imper_block_th">{$LNG.lv_resources}</div>
                <div class="imper_block_td">{$LNG.tech.901}</div>
                <div class="imper_block_td">{$LNG.tech.902}</div>
                <div class="imper_block_td">{$LNG.tech.903}</div>
                <div class="imper_block_td">{$LNG.tech.911}</div>
                <div class="imper_block_th">{$LNG.empire_review_3}</div>        
                <div class="imper_block_td">{$LNG.tech.901}</div>
                <div class="imper_block_td">{$LNG.tech.902}</div>
                <div class="imper_block_td">{$LNG.tech.903}</div>
                <div class="imper_block_td">{$LNG.tech.921}</div>
                <div class="imper_block_th">{$LNG.top_day}</div>        
                <div class="imper_block_td">{$LNG.tech.901}</div>
                <div class="imper_block_td">{$LNG.tech.902}</div>
                <div class="imper_block_td">{$LNG.tech.903}</div>
                <div class="imper_block_td">{$LNG.tech.921}</div>
        
              
                <div class="u000">
        <div class="imper_block_th">{$LNG.tech.0}</div> 
                {foreach $elementListallTris as $ID}
                        <div class="imper_block_td">{$LNG.tech.{$ID}}</div>
                        {/foreach}
                </div>
                 <div class="u200">
        <div class="imper_block_th">{$LNG.tech.200}</div> 
                {foreach $elementListall as $ID}
                        <div class="imper_block_td">{$LNG.tech.{$ID}}</div>
                        {/foreach}
                </div>
                 <div class="u400">
        <div class="imper_block_th">{$LNG.tech.400}</div> 
                {foreach $elementListallBis as $ID}
                        <div class="imper_block_td">{$LNG.tech.{$ID}}</div>
                        {/foreach}
                </div>
                
        
    </div>
    <div onclick="goright();" class="imper_goleft_big"></div>
    <div onclick="goleft();" class="imper_goright_big"></div> 
    <div class="imper_right_part" id="ipper_planets">
    <table class="imper_table"><tr>

        <td class="imper_f">
        <div class="imper_block_vertical" id="sigma">
            <div class="imper_block_image">
                <div class="gradient_block_image">Σ</div>
                <div class="imper_block_info_text">{$LNG.empi_sum}</div>
                <div class="imper_block_info_text"></div>
                <div class="imper_block_info_text"></div>
                <div class="imper_block_info_text"></div>
            </div>            
            <div class="imper_block_th"></div>        
            <div class="imper_block_td">{$metals}</div>
            <div class="imper_block_td">{$crystals}</div>
            <div class="imper_block_td">{$deuteriums}</div>
            <div class="imper_block_td">41.590</div>
            <div class="imper_block_th"></div>        
                        <div class="imper_block_td">{$metal_perhourss}</div>
                        <div class="imper_block_td">{$crystal_perhourss}</div>
                        <div class="imper_block_td">{$deuterium_perhourss}</div>
                        <div class="imper_block_td">{$darkmatter_perhourss}</div>
                        <div class="imper_block_th"></div>        
                        <div class="imper_block_td">{$metal_perhoursss}</div>
                        <div class="imper_block_td">{$crystal_perhoursss}</div>
                        <div class="imper_block_td">{$deuterium_perhoursss}</div>
                        <div class="imper_block_td">{$darkmatter_perhoursss}</div>
                        <div class="u000">
            <div class="imper_block_th"></div> 
                        <div class="imper_block_td">{$metal_minas}</div>
                        <div class="imper_block_td">{$crystal_mines}</div>
                        <div class="imper_block_td">{$deuterium_sintetizers}</div>
                        <div class="imper_block_td">{$solar_plants}</div>
                        <div class="imper_block_td">{$universitys}</div>
                        <div class="imper_block_td">{$fusion_plants}</div>
                        <div class="imper_block_td">{$robot_factorys}</div>
                        <div class="imper_block_td">{$nano_factorys}</div>
                        <div class="imper_block_td">{$hangars}</div>
                        <div class="imper_block_td">{$metal_stores}</div>
                        <div class="imper_block_td">{$crystal_stores}</div>
                        <div class="imper_block_td">{$deuterium_stores}</div>
                        <div class="imper_block_td">{$laboratorys}</div>
                        <div class="imper_block_td">{$terraformers}</div>
                        <div class="imper_block_td">{$ally_deposits}</div>
                        <div class="imper_block_td">{$mondbasiss}</div>
                        <div class="imper_block_td">{$phalanxs}</div>
                        <div class="imper_block_td">{$sprungtors}</div>
                                                <div class="imper_block_td">{$silos}</div>
                        <div class="imper_block_td">{$lightcs}</div>
                        <div class="imper_block_td">{$medcs}</div>
                        <div class="imper_block_td">{$heavycs}</div>
                        <div class="imper_block_td">{$colliders}</div>
                        <div class="imper_block_td">{$planetariums}</div>
                        <div class="imper_block_td">{$touchmodules}</div>
                        <div class="imper_block_td">{$researchcenters}</div>
                        </div>
            <div class="u200">
            <div class="imper_block_th"></div> 
                        <div class="imper_block_td">{$spy_sondes}</div>
                        <div class="imper_block_td">{$solar_satelits}</div>
                        <div class="imper_block_td">{$small_ship_cargos}</div>
                        <div class="imper_block_td">{$big_ship_cargos}</div>
                        <div class="imper_block_td">{$light_hunters}</div>
                        <div class="imper_block_td">{$heavy_hunters}</div>
                        <div class="imper_block_td">{$M7s}</div>
                        <div class="imper_block_td">{$recyclers}</div>
                        <div class="imper_block_td">{$crushers}</div>
                        <div class="imper_block_td">{$battle_ships}</div>
                        <div class="imper_block_td">{$colonizers}</div>
                        <div class="imper_block_td">{$ev_transporters}</div>
                        <div class="imper_block_td">{$battleships}</div>
                        <div class="imper_block_td">{$destructors}</div>
                        <div class="imper_block_td">{$bomber_ships}</div>
                        <div class="imper_block_td">{$dm_ships}</div>
                        <div class="imper_block_td">{$m19s}</div>
                        <div class="imper_block_td">{$giga_recyklers}</div>
                        <div class="imper_block_td">{$Scrappys}</div>
                        <div class="imper_block_td">{$galleons}</div>
                        <div class="imper_block_td">{$destroyers}</div>
                        <div class="imper_block_td">{$dearth_stars}</div>
                        <div class="imper_block_td">{$lune_noirs}</div>
                        <div class="imper_block_td">{$M32s}</div>
                        <div class="imper_block_td">{$frigates}</div>
                        <div class="imper_block_td">{$black_wanderers}</div>
                        <div class="imper_block_td">{$flying_deaths}</div>
                        <div class="imper_block_td">{$star_crashers}</div>
                        <div class="imper_block_td">{$bs_class_oneils}</div>
                        </div>
            <div class="u400">
            <div class="imper_block_th"></div> 
                        <div class="imper_block_td">{$misil_launchers}</div>
                        <div class="imper_block_td">{$small_lasers}</div>
                        <div class="imper_block_td">{$big_lasers}</div>
                        <div class="imper_block_td">{$slim_mehadors}</div>
                        <div class="imper_block_td">{$ionic_canyons}</div>
                        <div class="imper_block_td">{$gauss_canyons}</div>
                        <div class="imper_block_td">{$buster_canyons}</div>
                        <div class="imper_block_td">{$hydrogen_guns}</div>
                        <div class="imper_block_td">{$iron_mehadors}</div>
                        <div class="imper_block_td">{$dora_guns}</div>
                        <div class="imper_block_td">{$photon_cannons}</div>
                        <div class="imper_block_td">{$lepton_guns}</div>
                        <div class="imper_block_td">{$graviton_canyons}</div>
                        <div class="imper_block_td">{$proton_guns}</div>
                        <div class="imper_block_td">{$grand_mehadors}</div>
                        <div class="imper_block_td">{$particle_emitters}</div>
                        <div class="imper_block_td">{$canyons}</div>
                        <div class="imper_block_td">{$quantum_cannons}</div>
                        <div class="imper_block_td">{$small_protection_shields}</div>
                        <div class="imper_block_td">{$big_protection_shields}</div>
                        <div class="imper_block_td">{$planet_protectors}</div>
                        <div class="imper_block_td">{$orbital_stations}</div>
                        <div class="imper_block_td">{$interceptor_misils}</div>
                        <div class="imper_block_td">{$interplanetary_misils}</div>
             
            </div>           
        </div>
    </td>
   
    {foreach $planetList as $planetRow}
        <td class="imper_f 
             imper_{if $planetRow.isAlliancePlanet != 0}all_planet{elseif $planetRow.isgal6module == 1}pg2{elseif $planetRow.type == 1}planet{else}moon{/if}
                    ">
       <div class="imper_block_vertical">           
            <div class="imper_block_image" style="background-image:url(./styles/theme/gow/planeten/small/s_{$planetRow.image}.png);">
                <div class="gradient_block_image"></div>
                <div class="imper_block_info_text"><a href="game.php?page=overview&amp;cp={$planetRow.id}">{$planetRow.name}</a></div>
                <div class="imper_block_info_text">
                    <a href="game.php?page=galaxy&amp;galaxy={$planetRow.galaxy}&amp;system={$planetRow.system}">[{$planetRow.galaxy}:{$planetRow.system}:{$planetRow.planet}]</a>
                </div>
                <div class="imper_block_info_text">
                    {$planetRow.current} / {$planetRow.max}
                </div>
                <a class="ico_rows_planet imper_go_planet" href="game.php?page=overview&amp;cp={$planetRow.id}"></a>
            </div>            
            
            <div class="imper_block_th"></div>        
            <div class="imper_block_td"><div class="occupancy occupancy_901" style="width:{$planetRow.metal_percent}%"></div><div class="text_res">{$planetRow.resource901}</div></div>
            <div class="imper_block_td"><div class="occupancy occupancy_902" style="width:{$planetRow.cystal_percent}%"></div><div class="text_res">{$planetRow.resource902}</div></div>
            <div class="imper_block_td"><div class="occupancy occupancy_903" style="width:{$planetRow.deut_percent}%"></div><div class="text_res">{$planetRow.resource903}</div></div>
            <div class="imper_block_td">{if $planetRow.energy_used < 0}<span style="color:#ff2323">{$planetRow.resource911}</span>{else}{$planetRow.resource911}{/if}</div>
            <div class="imper_block_th"></div>        
                        <div class="imper_block_td">{pretty_number($planetRow.resource901s)}</div>
                        <div class="imper_block_td">{pretty_number($planetRow.resource902s)}</div>
                        <div class="imper_block_td">{pretty_number($planetRow.resource903s)}</div>
                        <div class="imper_block_td">{pretty_number($planetRow.resource921s)}</div>
                        <div class="imper_block_th"></div>        
                        <div class="imper_block_td">{pretty_number($planetRow.resource901s*24)}</div>
                        <div class="imper_block_td">{pretty_number($planetRow.resource902s*24)}</div>
                        <div class="imper_block_td">{pretty_number($planetRow.resource903s*24)}</div>
                        <div class="imper_block_td">{pretty_number($planetRow.resource921s*24)}</div>
            
            
                <div class="u000">
                    <div class="imper_block_th"></div> 
            
                    {foreach $buildingMapping as $map}
                    <div class="imper_block_td">{$planetRow[$map]}</div>
                    {/foreach}
                </div>
                <div class="u200">
                    <div class="imper_block_th"></div> 
            
                    {foreach $FleetMapping as $map}
                    <div class="imper_block_td">{pretty_number($planetRow[$map])}</div>
                    {/foreach}
                </div>
                <div class="u400">
                    <div class="imper_block_th"></div> 
            
                    {foreach $DefenseMapping as $map}
                    <div class="imper_block_td">{pretty_number($planetRow[$map])}</div>
                    {/foreach}
                </div>
                   
        </div>
        <div class="clear"></div>
    </td>
     
    {/foreach}
     
     
      
        </tr></table>
    <div class="clear"></div> 
    </div>
</div>
</div>
</div>
            <div class="clear"></div>            
        </div>

{/block}