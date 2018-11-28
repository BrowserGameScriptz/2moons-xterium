{block name="title" prepend}{$LNG.lm_galaxy}{/block}
{block name="content"}
	<div id="page">
	<div id="content">

	
	{if $action == 'sendMissle'}
    <form action="?page=fleetMissile" method="post">
	<input type="hidden" name="galaxy" value="{$galaxy}">
	<input type="hidden" name="system" value="{$system}">
	<input type="hidden" name="planet" value="{$planet}">
	<input type="hidden" name="type" value="{$type}">
<div id="ally_content" style="width:550px; margin-bottom:20px;" class="conteiner">
    <div class="gray_stripe">
		{$LNG.gl_missil_launch} [{$galaxy}:{$system}:{$planet}]
    </div>
    <table class="tablesorter ally_ranks">
        <tbody><tr>
            <td>{$missile_count} <input name="SendMI" size="2" maxlength="7" type="text"></td>
            <td>{$LNG.gl_objective}: 
                {html_options name=Target options=$missileSelector}

            </td>
            <td><input value="{$LNG.gl_missil_launch_action}" type="submit"></td>
        </tr>
    </tbody></table>
</div>
</form>
    {/if}
	
	
<div id="galactic_block_1">

    <div id="galactic_header" style="position:relative;">    
		<input name="uniIds" value="3" type="hidden">
    	<a href="#" style="left:5px; right:auto;" onclick="return Dialog.manualinfo(5)" class="interrogation manual">?</a>
    	<form action="?page=galaxy" method="post" id="galaxy_form">
			<input id="auto" value="dr" type="hidden">
			<input name="apiKey" id="apiKey" value="{$apiKeys}" type="hidden">
        <div class="gal_nazv" style="margin-left:15px;">{$LNG.lm_galaxy}:</div>  
        <div id="nav_1">
            <input class="prev" name="galaxyeft" onclick="galaxy_submit('galaxyLeft')" type="button">
			<input class="gal_p3" name="galaxy" value="{$galaxy}" size="5" maxlength="4" tabindex="2" type="text">
            <input class="next" name="galaxyRight" onclick="galaxy_submit('galaxyRight')" type="button">
        </div><!--/nav_2-->           
        <div class="gal_p4">{$LNG.gl_solar_system}:</div>        
        <div id="nav_2">
            <input class="prev" name="systemLeft" onclick="galaxy_submit('systemLeft')" type="button">
			<input class="gal_p3" name="system" value="{$system}" size="5" maxlength="4" tabindex="2" type="text">
            <input class="next" name="systemRight" onclick="galaxy_submit('systemRight')" type="button">
        </div><!--/nav_2-->
    	<div class="gal_sep"></div>
    		<input value="{$LNG.gl_show}" id="galactic_show" type="submit">
   		</form>
		
    </div><!--/galactic_header-->
        
		

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
	
    <div id="galactic_status">
        <div class="gal_p5">{$LNG.gl_pos}</div>
        <div class="status_sep"></div>
        <div class="gal_p6">{$LNG.gal_act}</div>
        <div class="status_sep"></div>
        <div class="gal_p7">{$LNG.type_planet.3}</div>
        <div class="status_sep"></div>
        <div class="gal_p8">{$LNG.gal_debris}</div>
        <div class="status_sep"></div>
        <div class="gal_p9">{$LNG.gl_player_estate}</div>
        <div class="status_sep"></div>
        <div class="gal_p10">{$LNG.gl_alliance}</div>
        <div class="status_sep"></div>
        <div class="gal_p11">{$LNG.gl_actions}</div>
    </div><!--/galactic_status-->	
    
{for $planet=1 to $max_planets}
 {if !isset($GalaxyRows[$planet])}
 <div class="gal_user {if $planet != 1 && $planet != 3 && $planet != 5 && $planet != 7 && $planet != 9 && $planet != 11 && $planet != 13 && $planet != 15 && $planet != 17 && $planet != 19}second{/if}">   
	 	<div class="gal_number">
        	<a href="game.php?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1" class="tooltip" data-tooltip-content="{$galaxy_desc_{$planet}}">
            <span class="galactic_number_{$planet}">{$planet}</span></a>
        </div>
		<div class="gal_planet_name"></div>
		<div class="gal_ico_moon"></div>
		<div class="gal_player_name"></div>
		<div class="gal_ally_name"></div>
		{if $colonyship >= 1 && $galaxy <= 6}
		 <div class="gal_player_cont" style="float:right">
           <a class="dali btn_galassia" href="game.php?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=7" title="{$LNG.type_mission.7}" style="padding: 0px;padding-left: 20px;background: url(/styles/images/iconav/coloni.png) left no-repeat;background-position: 5px 6px;width: 63%;height: 20px;line-height: 20px;text-align: center;margin-top: 4px;color: rgba(92, 166, 170, 0.7);">{$LNG.type_mission.7}</a>
   </div>  
		
		{/if}		
</div>
 {elseif $GalaxyRows[$planet] === false}
 <div class="gal_user {if $planet != 1 && $planet != 3 && $planet != 5 && $planet != 7 && $planet != 9 && $planet != 11 && $planet != 13 && $planet != 15 && $planet != 17 && $planet != 19}second{/if}">   
	 	<div class="gal_number">
        	<a href="game.php?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1" class="tooltip" data-tooltip-content="{$galaxy_desc_{$planet}}">
            <span class="galactic_number_{$planet}">{$planet}</span></a>
        </div>
		<div class="gal_planet_name">{$LNG.gl_planet_destroyed}</div>
		<div class="gal_ico_moon"></div>
		<div class="gal_player_name"></div>
		<div class="gal_ally_name"></div>
</div>
 {else}

        <div class="gal_user {if $planet != 1 && $planet != 3 && $planet != 5 && $planet != 7 && $planet != 9 && $planet != 11 && $planet != 13 && $planet != 15 && $planet != 17 && $planet != 19}second{/if}">   
	 	<div class="gal_number">
        	<a href="game.php?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1" class="tooltip" data-tooltip-content="{$galaxy_desc_{$planet}}">
			
            <span class="galactic_number_{$planet}">{$planet}</span></a>
        </div>
		{$currentPlanet = $GalaxyRows[$planet]}
                   <span id="p_{$currentPlanet.planet.id}" class="tooltip_sticky gal_img_planet" data-tooltip-content="
            <table class='tooltip_class_table' style='min-width:230px'>
            	<tr> 
                	<th colspan='2'>{$LNG.ov_planet} {$currentPlanet.planet.name} [{$galaxy}:{$system}:{$planet}]</th>
                </tr><tr>
            	<td class='tooltip_class_td_img'><img src='./styles/theme/gow/planeten/small/s_{$currentPlanet.planet.image}.png' /></td>
            	<td>
{if $currentPlanet.missions.6}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;'{if $currentPlanet.action.outlaw == 1}onclick='checkOutlaw()'{else}href='javascript:doit(6,{$currentPlanet.planet.id});'{/if}><img src='styles/images/iconav/over.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.6}</a><br />	{/if}
{if $currentPlanet.user.isgal6mod == 1}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='javascript:OpenPopup(&quot;?page=phalanx&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&quot;, &quot;&quot;, 640, 510);'>Phalanx (10.000 DM)</a><br />{/if}	
{if $currentPlanet.planet.phalanx}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='javascript:OpenPopup(&quot;?page=phalanx&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&quot;, &quot;&quot;, 640, 510);'><img src='styles/images/iconav/radar.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.gl_phalanx}</a>{/if}
{if $currentPlanet.missions.1}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' {if $currentPlanet.action.outlaw == 1}onclick='checkOutlaw()'{else}href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=1'{/if}><img src='styles/images/iconav/target.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.1}</a>{/if}	
{if $currentPlanet.missions.25}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=25'><img src='styles/images/iconav/target.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.25}</a>{/if}
{if $currentPlanet.missions.5}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=5'><img src='styles/images/iconav/fleet.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.5}</a>{/if}	
{if $currentPlanet.missions.16}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=16'><img src='styles/images/iconav/asteroideg.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.16}</a>{/if}	
{if $currentPlanet.missions.3}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=3'><img src='styles/images/iconav/risorseg.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.3}</a>{/if}
{if $currentPlanet.missions.4}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=4'><img src='styles/images/iconav/stazionag.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.4}</a>{/if}
{if $currentPlanet.missions.10}<a class='tooltip_class_a_btn'  style='height: 17px;line-height: 17px;' {if $currentPlanet.action.outlaw == 1}onclick='checkOutlaw()'{else}href='?page=galaxy&amp;action=sendMissle&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}'{/if}><img src='styles/images/iconav/rocket.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.10}</a>{/if}		
			
							</td>
		</tr></table>">
		<img {if $currentPlanet.planet.isAlliancePlanet != 0}style="border:1px solid #990;" {/if}src="./styles/theme/gow/planeten/small/s_{$currentPlanet.planet.image}.png" alt="">
        		</span>
        <div class="gal_planet_name"{if $currentPlanet.planet.isAlliancePlanet != 0} style="color:#990; font-weight:bold;"{/if}>{$currentPlanet.planet.name} {$currentPlanet.lastActivity}</div>

        <div class="gal_ico_moon">
{if $currentPlanet.moon} 
        				<div class="ico_moon tooltip_sticky" data-tooltip-content="
            <table class='tooltip_class_table' style='min-width:240px'>
            	<tr>
                	<th colspan='2'>{$LNG.gl_moon} {$currentPlanet.moon.name} [{$galaxy}:{$system}:{$planet}]</th>
               	</tr><tr>                
                	<td rowspan='4' class='tooltip_class_td_img'><img src='./styles/theme/gow/planeten/moon.png' /></td>
                	<th>{$LNG.gl_features}</th>
                </tr><tr>
                	<td class='tooltip_class_table_text_left'><span>{$LNG.gl_diameter}</span>: {$currentPlanet.moon.diameter|number}<br />
                    <span>{$LNG.gl_temperature}</span>: {$currentPlanet.moon.temp_min}</td>
                </tr><tr>
                 	<td>
                                	{if $currentPlanet.missions.6}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' {if $currentPlanet.action.outlaw == 1}onclick='checkOutlaw()'{else}href='javascript:doit(6,{$currentPlanet.moon.id});'{/if}><img src='styles/images/iconav/over.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.6}</a><br />	{/if}	
									{if $currentPlanet.missions.1}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' {if $currentPlanet.action.outlaw == 1}onclick='checkOutlaw()'{else}href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=3&amp;target_mission=1'{/if}><img src='styles/images/iconav/target.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.1}</a>{/if}	
									{if $currentPlanet.missions.3}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=3&amp;target_mission=3'><img src='styles/images/iconav/risorseg.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.3}</a>{/if}  
									{if $currentPlanet.missions.4}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=3&amp;target_mission=4'><img src='styles/images/iconav/stazionag.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.4}</a>{/if}		
									{if $currentPlanet.missions.5}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=3&amp;target_mission=5'><img src='styles/images/iconav/fleet.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.5}</a>{/if}  
									{if $currentPlanet.missions.9}<a class='tooltip_class_a_btn'  style='height: 17px;line-height: 17px;' {if $currentPlanet.action.outlaw == 1}onclick='checkOutlaw()'{else}href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=3&amp;target_mission=9'{/if}><img src='styles/images/iconav/distruggi.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.9}</a>{/if}  
									{if $currentPlanet.missions.10}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' {if $currentPlanet.action.outlaw == 1}onclick='checkOutlaw()'{else}href='?page=galaxy&amp;action=sendMissle&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}'{/if}><img src='styles/images/iconav/rocket.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.10}</a>{/if}
									{if $currentPlanet.missions.11}<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=3&amp;target_mission=11'><img src='styles/images/iconav/dmmiss.png' style='float: left;margin-left: 5px;margin-top: 2px;'>{$LNG.type_mission.11}</a>{/if}</td>
                </tr>
                </td></tr></table>">
            </div>
{/if}


			
			
			        </div>

 
        <div class="gal_ico_trash">
{if $currentPlanet.debris}
<div class="ico_trash_{if $currentPlanet.debris.metal + $currentPlanet.debris.crystal > 225000000000 }big{elseif $currentPlanet.debris.metal + $currentPlanet.debris.crystal < 225000000000 && $currentPlanet.debris.metal + $currentPlanet.debris.crystal > 7500000000}medium{elseif $currentPlanet.debris.metal + $currentPlanet.debris.crystal < 7500000000}small{/if} tooltip_sticky" data-tooltip-content="
                <table class='tooltip_class_table'>
                    <tr>
                        <th>{$LNG.gl_debris_field} [{$galaxy}:{$system}:{$planet}]</th>
                    </tr>
                    <tr>
                        <td class='tooltip_class_table_text_left'>
                            <span>{$LNG.tech.901}</span>: <span class='tooltip_class_901'>{$currentPlanet.debris.metal|number}</span><br />
                            <span>{$LNG.tech.902}</span>: <span class='tooltip_class_902'>{$currentPlanet.debris.crystal|number}</span>
                        </td>
                    </tr>            
                    <tr>
                        <td><a class='tooltip_class_a_bigbtn' href='javascript:doit(8, {$currentPlanet.planet.id});'>{$LNG.type_mission.8}</a></td>
                    </tr>            
                </table>">
			</div>
 {/if}
        	        </div>
        
        <div class="gal_player_name">
		
		{if $currentPlanet.user.isgal6mod == 0 && $currentPlanet.planet.isAlliancePlanet == 0}
        	        	<a class="tooltip_sticky" data-tooltip-content="
            <table class='tooltip_class_table'>
            	<tr><th>{$currentPlanet.user.playerrank}</th></tr>
				{if !$currentPlanet.ownPlanet}
				  <tr><td><a class='tooltip_class_a_bigbtn' href='#' onclick='return Dialog.Playercard({$currentPlanet.user.id});'>{$LNG.gl_playercard}</a></td></tr>
				{/if}
				
               	                              
                           		<tr><td><a class='tooltip_class_a_bigbtn' href='?page=statistics&amp;who=1&amp;range={$currentPlanet.user.rank}'>{$LNG.gl_see_on_stats}</a></td></tr>    
{if !$currentPlanet.ownPlanet}								
           		            	<tr><td>{$LNG.ti_status} {foreach $currentPlanet.user.class as $class}<span class='galaxy-short-{$class} galaxy-short'>{$ShortStatus.$class}</span>{/foreach}</td></tr>
								{/if}
                            </table>" style="color:#5ca6aa" >
				<span class="{foreach $currentPlanet.user.classd as $color}{$color}{/foreach}">{if $currentPlanet.user.HonourStatus != 'none'}<span class="honorRank {$currentPlanet.user.HonourStatus}">&nbsp;</span>{else}<span class="honorRank" style="opacity: 0;">&nbsp;</span>{/if} {$currentPlanet.user.username}</span>
								{foreach $currentPlanet.user.class as $class}{if $class@first}<span class="galaxy-short-{$class} galaxy-short">(</span>{/if}<span class="galaxy-short-{$class} galaxy-short">{$ShortStatus.$class}</span>{if $class@last}<span class="galaxy-short-{$class} galaxy-short">)</span>{/if}{/foreach}
							</a>
							{elseif $currentPlanet.user.isgal6mod == 1}
								<span style="color:#{if $currentPlanet.user.gal6type == 201 || $currentPlanet.user.gal6type == 501 || $currentPlanet.user.gal6type == 601 || $currentPlanet.user.gal6type == 701 || $currentPlanet.user.gal6type == 801 || $currentPlanet.user.gal6type == 901 || $currentPlanet.user.gal6type == 301 || $currentPlanet.user.gal6type == 401 || $currentPlanet.user.gal6type == 101}00BFFF{elseif $currentPlanet.user.gal6type > 906}B22222{elseif $currentPlanet.user.gal6type > 904}00BFFF{elseif $currentPlanet.user.gal6type > 900}32CD32{elseif $currentPlanet.user.gal6type > 806}B22222{elseif $currentPlanet.user.gal6type > 804}00BFFF{elseif $currentPlanet.user.gal6type > 800}32CD32{elseif $currentPlanet.user.gal6type > 706}B22222{elseif $currentPlanet.user.gal6type > 704}00BFFF{elseif $currentPlanet.user.gal6type > 700}32CD32{elseif $currentPlanet.user.gal6type > 606}B22222{elseif $currentPlanet.user.gal6type > 604}00BFFF{elseif $currentPlanet.user.gal6type > 600}32CD32{elseif $currentPlanet.user.gal6type > 506}B22222{elseif $currentPlanet.user.gal6type > 504}00BFFF{elseif $currentPlanet.user.gal6type > 500}32CD32{elseif $currentPlanet.user.gal6type > 406}B22222{elseif $currentPlanet.user.gal6type > 404}00BFFF{elseif $currentPlanet.user.gal6type > 400}32CD32{elseif $currentPlanet.user.gal6type > 306}B22222{elseif $currentPlanet.user.gal6type > 304}00BFFF{elseif $currentPlanet.user.gal6type > 300}32CD32{elseif $currentPlanet.user.gal6type > 206}B22222{elseif $currentPlanet.user.gal6type > 204}00BFFF{elseif $currentPlanet.user.gal6type > 200}32CD32{elseif $currentPlanet.user.gal6type > 106}B22222{elseif $currentPlanet.user.gal6type > 104}00BFFF{elseif $currentPlanet.user.gal6type > 100}32CD32{elseif $currentPlanet.user.gal6type > 6}B22222{elseif $currentPlanet.user.gal6type > 4}00BFFF{elseif $currentPlanet.user.gal6type == 1}00BFFF{else}32CD32{/if};" class="tooltip" data-tooltip-content="{$currentPlanet.user.gal6desc1}{$currentPlanet.user.gal6desc}">[type {$currentPlanet.user.gal6type + 100}|{$currentPlanet.user.gal6lvl}]</span> 
							{/if}
                    </div>


        <div class="gal_ally_name">
{if $currentPlanet.alliance}
        				<a class="tooltip_sticky" data-tooltip-content="
            <table class='tooltip_class_table'>
            	<tr><th>{$LNG.gl_alliance} {$currentPlanet.alliance.name} {$currentPlanet.alliance.member}</th></tr>
                <tr><td><a class='tooltip_class_a_bigbtn' href='?page=alliance&amp;mode=info&amp;id={$currentPlanet.alliance.id}'>{$LNG.gl_alliance_page}</a></td></tr>
                <tr><td><a class='tooltip_class_a_bigbtn' href='?page=statistics&amp;range={$currentPlanet.alliance.rank}&amp;who=2'>{$LNG.gl_see_on_stats}</a></td></tr>
                                </table>" style="color:#5ca6aa" >
				<span class="{foreach $currentPlanet.alliance.class as $color}{$color}{/foreach}">{if $currentPlanet.alliance.ally_fraction_id != 0}<img alt="" title="" class="tooltip fraction_ico_mini_t" style=" height: 20px; width: 20px;float:none" src="styles/images/alliance/fraction_{$currentPlanet.alliance.ally_fraction_id}.png">{/if}{$currentPlanet.alliance.tag}</span>
			</a>
{else}{/if}
			        </div>
        <div class="gal_player_cont">
{if $currentPlanet.action}
        	{if $currentPlanet.action.esp}
<a class="ico_watch" title="{$LNG.gl_spy}" {if $currentPlanet.action.outlaw == 0} href="javascript:doit(6,{$currentPlanet.planet.id},{$currentPlanet.planet.planet},{$currentPlanet.planet.system},{$spyShips|json|escape:'html'})"{else}onclick="checkOutlaw()"{/if}></a>{else}	<span class="ico_watch" style="opacity:0;"> </span>	{/if}
{if $currentPlanet.action.message}
<a href="#" class="ico_post" onclick="return Dialog.PM({$currentPlanet.user.id})" title="{$LNG.write_message}"></a>{else}	<span class="ico_post" style="opacity:0;"> </span>			{/if}	
{if $currentPlanet.action.buddy}
<a href="#" class="ico_friend" onclick="return Dialog.Buddy({$currentPlanet.user.id})" title="{$LNG.gl_buddy_request}">
				</a>{else}	<span class="ico_friend" style="opacity:0;"> </span>
              {/if}
			{if $currentPlanet.action.savecoords}<a class="ico_save{$currentPlanet.action.showShover}" href="#" title="Save coords" data-gal="{$galaxy}" data-sys="{$system}" data-pl="{$planet}"></a>{/if}	
{if $currentPlanet.action.missle}
				<a class="ico_write" {if $currentPlanet.action.outlaw == 1}onclick="checkOutlaw()"{else}href="?page=galaxy&amp;action=sendMissle&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;type=1"{/if} title="{$LNG.gl_missile_attack}">					
				</a>
				{else}	<span class="ico_write" style="opacity:0;"> </span>
				{/if}	
			
				
															      

{/if}  </div>
            </div><!--/gal_user-->    
{/if} 
	   {/for}
	    



{if $galaxy != 7}
    <div id="gal_block_1_footer" style="padding-top: 13px;padding-bottom: 10px;">
        
        <a id="dali" class="dali btn_galassia" href="?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$max_planets + 1}&amp;planettype={$shozpltype}&amp;target_mission=15" style="padding-left: 40px;height: 25px;line-height: 25px;width: 39%;">{$LNG.gl_out_space}</a>
        <a id="expedition" class="expedition btn_galassia1" href="?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$max_planets + 1}&amp;planettype=1&amp;target_mission=17" style="padding-left: 40px;height: 25px;line-height: 25px;width: 39%;">{$LNG.tutorial_metal_151}</a>
    </div>

{/if}
   
 

   {if !empty($suprimoEventCount)}
   <div id="gal_block_1_footer" style="padding-top: 2px;padding-bottom: 10px;">
        <a id="dali" class="dali btn_galassia2 tooltip" style="padding-left: 40px;height: 25px;line-height: 25px;width: 84%;" href="?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$max_planets + 2}&amp;planettype=1&amp;target_mission=26" data-tooltip-content="
						<table class='tooltip_class_table' style='max-width: 200px;'> <tbody>
						<tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>SURPRISE ME EVENT</span></th></tr> 
						<tr><td colspan='2'><span style='font-weight:bold;'>Special Star [{$galaxy}:{$system}:{$planet+1}]</span></td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>Bonus</span></th></tr> 
							
						{if $suprimoEventData.gift_item_light == 1}<tr> <td style='text-align: right;line-height: 19px;'><img src='styles/images/auction/1.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'></td> <td class='tooltip_class_table_text_left'>Light Item</td> </tr>{/if}				
						{if $suprimoEventData.gift_item_medium == 1}<tr> <td style='text-align: right;line-height: 19px;'><img src='styles/images/auction/2.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'></td> <td class='tooltip_class_table_text_left'>Medium Item</td> </tr>	{/if}		
						{if $suprimoEventData.gift_item_heavy == 1}<tr> <td style='text-align: right;line-height: 19px;'><img src='styles/images/auction/3.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'></td> <td class='tooltip_class_table_text_left'>Heavy Item</td> </tr>	{/if}				
						{if $suprimoEventData.gift_arsenal_light == 1}<tr> <td style='text-align: right;line-height: 19px;'><img src='styles/theme/gow/gebaeude/up/slight.jpg' style='height: 14px;width: 14px;float: left;padding: 3px;'></td> <td class='tooltip_class_table_text_left'>Light Arsenal</td> </tr>	{/if}		
						{if $suprimoEventData.gift_arsenal_medium == 1}<tr> <td style='text-align: right;line-height: 19px;'><img src='styles/theme/gow/gebaeude/up/smedium.jpg' style='height: 14px;width: 14px;float: left;padding: 3px;'></td> <td class='tooltip_class_table_text_left'>Medium Arsenal</td> </tr>{/if}
						{if $suprimoEventData.gift_arsenal_heavy == 1}<tr> <td style='text-align: right;line-height: 19px;'><img src='styles/theme/gow/gebaeude/up/sheavy.jpg' style='height: 14px;width: 14px;float: left;padding: 3px;'></td> <td class='tooltip_class_table_text_left'>Heavy Arsenal</td> </tr>{/if}
						{if $suprimoEventData.gift_academy == 1}<tr> <td style='text-align: right;line-height: 19px;'><img src='styles/theme/gow/gebaeude/1101.jpg' style='height: 14px;width: 14px;float: left;padding: 3px;'></td> <td class='tooltip_class_table_text_left'>{$LNG.academy_11}</td> </tr>{/if}
						{if $suprimoEventData.gift_resource_metal == 1}<tr> <td style='text-align: right;line-height: 19px;'><img src='styles/theme/gow/gebaeude/up/res901.jpg' style='height: 14px;width: 14px;float: left;padding: 3px;'></td> <td class='tooltip_class_table_text_left'>{$LNG.tech.901}</td> </tr>{/if}
						{if $suprimoEventData.gift_resource_crystal == 1}<tr> <td style='text-align: right;line-height: 19px;'><img src='styles/theme/gow/gebaeude/up/res902.jpg' style='height: 14px;width: 14px;float: left;padding: 3px;'></td> <td class='tooltip_class_table_text_left'>{$LNG.tech.902}</td> </tr>{/if}
						{if $suprimoEventData.gift_resource_deuterium == 1}<tr> <td style='text-align: right;line-height: 19px;'><img src='styles/theme/gow/gebaeude/up/res903.jpg' style='height: 14px;width: 14px;float: left;padding: 3px;'></td> <td class='tooltip_class_table_text_left'>{$LNG.tech.903}</td> </tr>{/if}
						{if $suprimoEventData.gift_darkmatter == 1}<tr> <td style='text-align: right;line-height: 19px;'><img src='styles/theme/gow/gebaeude/69.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'></td> <td class='tooltip_class_table_text_left'>{$LNG.tech.921}</td> </tr>{/if}
						
                </td></tr></table>">Special Star [{$galaxy}:{$system}:{$planet+1}]</a>
	   
	  
	   
    </div>

{/if}



   
   <!--/block_1_footer-->
    
</div><!--/galactic_block_1-->

<div id="send_zond">
    <table>
	<tbody><tr style="display: none;" id="fleetstatusrow">
	</tr>
	</tbody></table>
</div><!--/send_zond-->

<div id="galactic_block_2">

<div class="listabarraalto">
	<a href="?page=galaxy&amp;mode=showsavec" class="linkbarraalto">Saved coordinates</a>
</div>
   <div id="block_status">
        <div class="gal_stat_1">
            <div class="gal_text_1">{$GalaxyAmounts}</div>
            <div class="gal_text_2">{$LNG.gl_populed_planets}</div>
        </div>
    
        <div class="gal_stat_2">
            <div class="gal_text_1">{$currentmip|number}</div>
            <div class="gal_text_2">{$LNG.gl_avaible_missiles}</div>
        </div>
        <div class="gal_stat_3">
            <div class="gal_text_1"><span id="grecyclers">{$grecyclers|number}</span></div>
            <div class="gal_text_2">{$LNG.gl_avaible_grecyclers}</div>
        </div>
    
        <div class="gal_stat_4">
            <div class="gal_text_1"><span id="slots">{$maxfleetcount}</span>/{$fleetmax}</div>
            <div class="gal_text_2">{$LNG.gl_fleets}</div>
        </div>
    
        <div class="gal_stat_5">
            <div class="gal_text_1"><span id="probes">{$spyprobes|number}</span></div>
            <div class="gal_text_2">{$LNG.gl_avaible_spyprobes}</div>
        </div>
    
        <div class="gal_stat_6">
            <div class="gal_text_1"><span id="recyclers">{$recyclers|number}</span> </div>
            <div class="gal_text_2">{$LNG.gl_avaible_recyclers}</div>
        </div>
    </div><!--/block_status-->   
    
    <div id="block_diplom">
        <div id="diplom_shapka">
            <div class="diplom_color">{$LNG.stat_col_dip}</div>
            <div class="gal_show_content">
                <div id="diplom_btn" class="gal_show_block" onclick="klicdiplo();"></div><!--/show_block-->
            </div>
        </div>
        
        <div id="diplom_content">
            <div class="block_1">
                <div class="gal_text_1">{$LNG.gal_players}:</div>
                <div class="gal_text_2">{$LNG.gal_alliance}:</div>
            </div>
            
            <div class="block_2">
                <div class="dipl_color first">
                    <div class="yellow"></div>
                    <div class="color_text">{$LNG.bu_partners}</div>
                </div>
                
                <div class="dipl_color second">
                    <div class="red"></div>
                    <div class="color_text">{$LNG.stat_ennemie}</div>
                </div>
                
                <div id="attention">{$LNG.stat_col_over}</div>
                
                <div class="dipl_color ally first">
                    <div class="green"></div>
                    <div class="color_text">{$LNG.stat_union}</div>
                </div>
                
                <div class="dipl_color ally second">
                    <div class="white"></div>
                    <div class="color_text">{$LNG.al_diplo_level.1}</div>
                </div>
                
                <div class="dipl_color ally third">
                    <div class="grey_yellow"></div>
                    <div class="color_text">{$LNG.al_diplo_level.3}</div>
                </div>
                
                <div class="dipl_color ally thour">
                    <div class="brown"></div>
                    <div class="color_text">{$LNG.al_diplo_level.4}</div>
                </div>
                
                <div class="dipl_color ally_2 first">
                    <div class="red"></div>
                    <div class="color_text ">{$LNG.al_diplo_level.5}</div>
                </div>
                
                <div class="dipl_color ally_2 second">
                    <div class="green"></div>
                    <div class="color_text">{$LNG.al_diplo_level.6}</div>
                </div>
                
                <div class="dipl_color ally_2 third">
                    <div class="blue"></div>
                    <div class="color_text">{$LNG.stat_own_ally}</div>
                </div>
           </div><!--/block_2-->
        </div><!--/diplom_content-->
    </div><!--/block_diplom-->    
    
    <div id="diplom_faq">    
        <div id="diplom_shapka">
            <div class="spravka">{$LNG.gal_legend}</div>
            <div class="gal_show_content">
                <div id="faq_btn" class="gal_show_block" onclick="kliclegend();"></div><!--/show_block-->
            </div>
        </div>
         <div id="faq_content">
        <div class="nad1">{$LNG.gl_strong_player}</div>
        <div class="nad2"><span class="galaxy-short-strong">({$LNG.gl_short_strong})</span></div>
        <div class="nad3">{$LNG.gl_vacation}</div>
        <div class="nad4"><span class="galaxy-short-vacation">({$LNG.gl_short_vacation})</span></div>
		<div class="nad5">{$LNG.gl_inactive_seven}</div>
        <div class="nad6"><span class="galaxy-short-inactive">({$LNG.gl_short_inactive})</span></div>	 
		<div class="nad7">{$LNG.gl_week_player}</div>
        <div class="nad8"><span class="galaxy-short-noob">({$LNG.gl_short_newbie})</span></div>	 	 
        <div class="nad9">{$LNG.gl_banned}</div>
        <div class="nad10"><span class="galaxy-short-banned">({$LNG.gl_short_ban})</span></div>	 
		 <div class="nad11">{$LNG.gl_inactive_twentyeight}</div>	
		<div class="nad12"><span class="galaxy-short-longinactive">(iI)</span></div>		 
     
    </div><!--/block_status-->  
    </div><!--/diplom_faq-->    
</div><!--/galactic_block_2-->

<div class="clear"></div>     	
	
<script type="text/javascript">
		lngoutlaw		= '{$LNG.fl_ticket_auto_3}';
		status_ok		= '{$LNG.gl_ajax_status_ok}';
		status_fail		= '{$LNG.gl_ajax_status_fail}';
		MaxFleetSetting = {$settings_fleetactions};
	</script>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        <!--/body-->
	
{/block}