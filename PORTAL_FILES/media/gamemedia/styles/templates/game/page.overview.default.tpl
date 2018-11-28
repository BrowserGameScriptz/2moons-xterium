{block name="title" prepend}{$LNG.lm_overview}{/block}
{block name="script" append}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="owerwiv" class="conteiner">


	    
        <div class="ref_systemtop">
    	     <div id="online_user">
        {$LNG.over_online}: <span>{$online_users}</span> |
    </div>
    <div id="gm_linck">
        | <a title="" href="game.php?page=ticket" class="tooltip" data-tooltip-content="{$LNG.over_answer_ques}">{$LNG.over_ask_ques}</a>
    </div>
    
    <div id="online_adm">
		Info : Give your opinion on our next update: <a href="https://forum.warofgalaxyz.com/topic/13-coming-soon-full-empire-controll/" target="_blank" style="color:red;"> Full-Empire Controll</a> !
            </div> 
        
    </div>
	
   <div class="fleet_log"  style="margin-top: 30px;">
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
</script>
<div class="separator"></div>{/if}

                {foreach $fleets as $index => $fleet}
                <div class="fleet_time">
        	<div id="fleettime_{$index}" class="fleets" data-fleet-end-time="{$fleet.returntime}" data-fleet-time="{$fleet.resttime}">{pretty_fly_time({$fleet.resttime})}</div>
            <div class="tooltip fleet_static_time" data-tooltip-content="{$fleet.resttime1}">{$fleet.resttime1}</div>
        </div>
        <div class="fleet_text">
		{$fleet.text}
        	<div class="clear"></div>
        </div>     
        <div class="separator"></div>
		{/foreach}
		
		
                
    </div>
	
	{if $userID == 0}
	
                	 <!--<div id="top_cosmonautics">
                    		<div class="flov1 top_gift_left "></div>
                        	<div class="top_gift_mid"></div>
                        	<div class="flov2 top_gift_right "></div>
                        </div>-->
                
	<div id="ally_content" class="flov3 conteiner ">
	 <div class="flov4 gray_stripe piccolastriscia ">
        <div class="transparent flov5">{$LNG.fl_fleets} {$activeFleetSlotsModule} / {$maxFleetSlotsModule} <span>|</span> {$LNG.fl_my_planets} {$currentPlanetCountModule} / {$maxPlanetCountModule} 
        </div>
         <!--<div class="transparent" style="text-align:right; float:right;color:#7c8e9a">Expedición 7 / 7 <span style="color:#000;">|</span>0 / 3 Captura<span>|</span>Asteroids 0 / 4  
        </div>-->
		 <span class="flov6 openDetails ">
<span onclick="$('#guaglione').slideToggle(0);" class="openCloseDetails"><img src="https://gf3.geo.gfsrv.net/cdnb6/577565fadab7780b0997a76d0dca9b.gif" height="16" width="16" class="flov7"></span>
</span>
    </div></div>
	<div id="guaglione" class="flov8 conteiner" style="display:none">
	{foreach name=FlyingFleets item=FlyingFleetRow from=$FlyingFleetList}
	<div id="ido_{$FlyingFleetRow.id}" class=" fleetDetails detailsOpened " style="height: 20px;margin: 0;margin-left: -1px;border: none;border-bottom: 1px solid #000;">
       <span class="timer" secs="431" id="timer_{$FlyingFleetRow.id}" style="left:80px;width: 75px;">{$FlyingFleetRow.startTime}</span>      
	   <span class="mission" style="top: 0px; width: 100px;">{$FlyingFleetRow.missionName}</span>
       <span class="originData" class="flov13" style="left: 160px;">
		<span class="originCoords" title="">{$FlyingFleetRow.planetStart}</span>
		<span class="originPlanet"><figure class="planetIcon planet" title="{$FlyingFleetRow.PlanetSendNam}"></figure>{$FlyingFleetRow.PlanetSendNam}</span>
       </span>
       <span class="reversal " style="left: 320px; margin-left: -20px;top: 1px; width: 160px;">
       <a class="icon_link" href="game.php?page=fleetTable&amp;action=sendfleetback&amp;fleetID={$FlyingFleetRow.id}" title="Back" style="margin-left:10px">
       <input class="fl_btn_table_fleets_order" value="Back" type="submit" style="border-color: #252f38;background: #182024!important;height: 15px;padding: 0px;"></a>
	  
		<a class="tooltip basic2" style="left:70px;position: absolute;top: 3px;background: url(/styles/images/iconav/flottadestra.png) no-repeat;display: block;height: 13px;width: 13px;" data-tooltip-content="<table class='reducefleet_table' style='width:100%'><tr><td <td class='reducefleet_img_res' style='width:15px'><img src='styles/images/metall.gif' style='width:15px'></td><td class='reducefleet_name_ship'>{$LNG.tech.901} <span class='reducefleet_count_ship'>{$FlyingFleetRow.fleet_metal|number}</span></td></tr><tr><td <td class='reducefleet_img_res' style='width:15px'><img src='styles/images/kristall.gif' style='width:15px'></td><td class='reducefleet_name_ship'>{$LNG.tech.902} <span class='reducefleet_count_ship'>{$FlyingFleetRow.fleet_crystal|number}</span></td></tr><tr><td <td class='reducefleet_img_res' style='width:15px'><img src='styles/images/deuterium.gif' style='width:15px'></td><td class='reducefleet_name_ship'>{$LNG.tech.903} <span class='reducefleet_count_ship'>{$FlyingFleetRow.fleet_deuter|number}</span></td></tr><tr><td <td class='reducefleet_img_res' style='width:15px'><img src='styles/images/darkmatter.gif' style='width:15px'></td><td class='reducefleet_name_ship'>{$LNG.tech.921} <span class='reducefleet_count_ship'>{$FlyingFleetRow.fleet_darkm|number}</span></td></tr></table>
		<table class='reducefleet_table'>       
                           						   {foreach $FlyingFleetRow.FleetList as $shipID => $shipCount}<tr>
                    <td class='reducefleet_img_ship'><img src='./styles/theme/gow/gebaeude/{$shipID}.gif' alt='' /></td>
                    <td class='reducefleet_name_ship'>{$LNG.tech.{$shipID}}: <span class='reducefleet_count_ship'>{$shipCount}</span></td>
                </tr>{/foreach}
                                                     </table>"></a>  
		 
		     {if $FlyingFleetRow.mission == 1 && !$isVacation && $FlyingFleetRow.state != 1}<a class="icon_link" href="game.php?page=fleetTable&amp;action=acs&amp;fleetID={$FlyingFleetRow.id}" title="ACS" style="margin-left: 45px;">
       <input class="fl_btn_table_fleets_order" value="ACS" type="submit" style="border-color: #252f38;background: #182024!important;height: 15px;padding: 0px;"></a>{/if}
	    			
			&nbsp;
			
       </span>

       <span class="destinationData" style="left: 445px;">
       <span class="destinationPlanet status_abbr_inactive">
       <span><figure class="planetIcon planet" title="{$FlyingFleetRow.PlanetTargNam}"></figure>{$FlyingFleetRow.PlanetTargNam}</span>
       </span>                 
       <span class="destinationCoords" title="">{$FlyingFleetRow.planetEnd}</span>                
       </span>
	   <span class="nextTimer" secs="822" style="width: 65px;left: auto;right:5px;">{$FlyingFleetRow.endTime}</span>
       <span class="nextMission textBeefy" style="font-weight:bold;left:650px"><a title="En camino"><span class="ownexpedit">(A)</span></a></span>
    </div>
	{/foreach}
	 </div>
	
	
	


	
		
	{/if}
	
    <div id="big_panet" style="background: url(./styles/theme/gow/planeten/control_room_world2.png) no-repeat, url(./styles/theme/gow/planeten/{$planetimage}.jpg) no-repeat ; background-size:cover;margin-top: 10px;">
                                	 


 <div class="palnet_pianeta_titoloa palnet_pianeta_titolo" {if $gal6modOver == 1}style="top:50px;"{/if}>

           	 {if $gal6modOver == 0}<a href="game.php?page=planet"><span class="planetname tooltip" data-tooltip-content="{$planetStructure}">{$planetname} </span>  </a>{/if}  {if $gal6modOver == 1}<span style="color:#{if $gal6type == 201 || $gal6type == 501 || $gal6type == 601 || $gal6type == 701 || $gal6type == 801 || $gal6type == 901 || $gal6type == 301 || $gal6type == 401 || $gal6type == 101}00BFFF{elseif $gal6type > 906}B22222{elseif $gal6type > 904}00BFFF{elseif $gal6type > 900}32CD32{elseif $gal6type > 806}B22222{elseif $gal6type > 804}00BFFF{elseif $gal6type > 800}32CD32{elseif $gal6type > 706}B22222{elseif $gal6type > 704}00BFFF{elseif $gal6type > 700}32CD32{elseif $gal6type > 606}B22222{elseif $gal6type > 604}00BFFF{elseif $gal6type > 600}32CD32{elseif $gal6type > 506}B22222{elseif $gal6type > 504}00BFFF{elseif $gal6type > 500}32CD32{elseif $gal6type > 406}B22222{elseif $gal6type > 404}00BFFF{elseif $gal6type > 400}32CD32{elseif $gal6type > 306}B22222{elseif $gal6type > 304}00BFFF{elseif $gal6type > 300}32CD32{elseif $gal6type > 206}B22222{elseif $gal6type > 204}00BFFF{elseif $gal6type > 200}32CD32{elseif $gal6type > 106}B22222{elseif $gal6type > 104}00BFFF{elseif $gal6type > 100}32CD32{elseif $gal6type > 6}B22222{elseif $gal6type > 4}00BFFF{elseif $gal6type == 1}00BFFF{else}32CD32{/if};" class="tooltip" data-tooltip-content="{$gal6descOver}"><small>[type {$gal6type}|{$gal6lvl}]</small></span>{/if}
			<a href="#" onclick="return Dialog.Playercard({$userID}, '{$username}');" class="palanetarium_linck my_stats tooltip" style="right:55px;top: 5px;" data-tooltip-content="{$username} - {$LNG.over_per_stats}"></a>
            <a href="game.php?page=planet" class="palanetarium_linck seting2 tooltip" style="top: 5px;right:30px"data-tooltip-content="{$LNG.over_changeworld}"></a>
	       <a href="#" class="palanetarium_linck infouniov tooltip" style="top: 5px;"data-tooltip-content="<table class='reducefleet_table' style='width:100%'><tr><td <td class='reducefleet_img_res' style='width:15px'><img src='./styles/images/iconav/o-datestart.png' style='width:15px'></td><td class='reducefleet_name_ship'>Date of start: <B>17/02/2018</B></td></tr><tr><td <td class='reducefleet_img_res' style='width:15px'><img src='./styles/images/iconav/o-gamespeed.png' style='width:15px'></td><td class='reducefleet_name_ship'>{$LNG.in_base_speed}: <B>x15.000</B></td></tr><tr><td <td class='reducefleet_img_res' style='width:15px'><img src='./styles/images/iconav/o-resources.png' style='width:15px'></td><td class='reducefleet_name_ship'>{$LNG.ally_fractions_34}: <B>x10.000</B></td></tr><tr><td <td class='reducefleet_img_res' style='width:15px'><img src='./styles/images/iconav/o-expedition.png' style='width:15px'></td><td class='reducefleet_name_ship'>{$LNG.ally_fractions_39}: <B>X5</B></td></tr><tr><td <td class='reducefleet_img_res' style='width:15px'><img src='./styles/images/iconav/o-rocket.png' style='width:15px'></td><td class='reducefleet_name_ship'>{$LNG.ally_fractions_15}: <B>x12</B></td></tr><tr><td <td class='reducefleet_img_res' style='width:15px'><img src='./styles/images/iconav/o-energy.png' style='width:15px'></td><td class='reducefleet_name_ship'>{$LNG.ally_fractions_35}: <B>X1</B></td></tr></table><table class='reducefleet_table"></a>
	 

	 
	 
        </div>
		{if $GeTransportCount > 0}
<div name="situation_irreguliere" class="palnet_block_push palnet_luna_push blink_me1" {if $gal6modOver == 1}style="top:50px;"{/if}>
            <a href="?page=irregular"><span class="tooltip" data-tooltip-content="{$LNG.ls_push_1}" style="cursor :pointer;">{$LNG.ls_push_2}</span></a>
        </div>
		
		{/if}
		

					
					{if $buildBusy.tech || $buildBusy.buildings || $buildBusy.fleet ||$buildBusy.defense}
					<div class="palnet_block_info palnet_build_info" style="bottom:75px">
  <div style="width: 163.5px;max-width: 163.5px;float: left; height: 20px; overflow: hidden;">{if $buildBusy.tech}<img src="styles/images/iconav/tech.png"><span> {$LNG.tech[$buildBusy.tech['id']]} ({$buildBusy.tech['level']|number})</span>{/if}</div>
   <div style="width: 163.5px;max-width: 163.5px;margin-left:10px;float: left;height: 20px; overflow: hidden;">{if $buildBusy.buildings} <img src="styles/images/iconav/build.png"><span> {$LNG.tech[$buildBusy.buildings['id']]} ({$buildBusy.buildings['level']|number})</span>{/if}</div>
    <div style="width: 163.5px;max-width: 163.5px;margin-left:10px;float: left;height: 20px; overflow: hidden;">{if $buildBusy.fleet} <img src="styles/images/iconav/fleet.png"><span> {$LNG.tech[$buildBusy.fleet['id']]} ({$buildBusy.fleet['level']|number})</span>{/if}</div>
   <div style="width: 148px;height: 80%;margin-left:10px;float: left;height: 20px; overflow: hidden;">{if $buildBusy.defense} <img src="styles/images/iconav/shield.png"><span> {$LNG.tech[$buildBusy.defense['id']]} ({$buildBusy.defense['level']|number})</span>{/if}</div>
                    </div>
					{/if}
									
					<div class="palnet_pianeta_universo">
 </div>
					{if $gal6modOver == 1} 
					<div class="palnet_block_info palnet_luna_info palnet_extension_info">
			Before Destruction: {pretty_time($ExpireTIme)}  {*<a onclick="return confirm('Недостаточно Антиматерии: 4.645');" class="tooltip" data-tooltip-content="Insufficient Antimatter: 4.645">Extend</a>*}
		</div>
		
					{elseif $Moon == 0 && $planet_type != 3}
					<div class="palnet_block_info palnet_luna_info">
			<a href="game.php?page=createMoon" style="color: #5ca6aa;text-decoration: blink;font-weight: bold;font-size: 13px;"><img src="../styles/images/iconav/crealuna.png" style="height: 14px;width: 14px;"> {$LNG.over_creamoon}</a>
		</div>
		{elseif $planet_type == 1}
		<a href="game.php?page=overview&amp;cp={$Moon.id}&amp;re=0" class="palnet_block_info palnet_luna_info" title="">
            <img src="./styles/theme/gow/planeten/moon.png" alt=" ({$LNG.planet_type.3})" height="60" width="60">
        </a>
		{else}
		<div class="palnet_block_info palnet_luna_info">
                <a href="game.php?page=kollaider" style="color: #5ca6aa;text-decoration: blink;font-weight: bold;font-size: 13px;"><img src="../styles/images/iconav/miniera.png" style="height: 14px;width: 14px;"> {$LNG.over_collider}</a>
            </div>
		{/if}
		
		
		
		
        		        <div class="palnet_block_info palnet_big_info" name="information_planete"{if $cookiesStatDisplay == 'false'} style="display: block;"{else} style="display: none;"{/if}>
            <div class="left_part" id="field_l"><a href="javascript:toggleStatistique();">{$LNG.ov_diameter}</a></div>
            <div class="right_part">{$planet_diameter} {$LNG.ov_distance_unit} (<span title="{$LNG.ov_developed_fields}">{$planet_field_current}</span> / <span title="{$LNG.ov_max_developed_fields}">{$planet_field_max}</span> {$LNG.ov_fields})</div>
			
            <div class="left_part"><a href="javascript:toggleStatistique();">{$LNG.ov_temperature}</a></div>
            <div class="right_part">{$LNG.ov_aprox} {$planet_temp_min}{$LNG.ov_temp_unit} {$LNG.ov_to} {$planet_temp_max}{$LNG.ov_temp_unit}</div>
        </div>
		
		<div class="palnet_block_info palnet_big_info1" name="information_stats"{if $cookiesStatDisplay == 'false'} style="display: block;"{else} style="display: none;"{/if}>
            <div class="left_part"><a href="javascript:toggleStatistique();">{$LNG.ov_position}</a></div>
            <div class="right_part"><a href="game.php?page=galaxy&amp;galaxy={$galaxy}&amp;system={$system}">[{$galaxy}:{$system}:{$planet}]</a></div>
            <div class="left_part"><a href="javascript:toggleStatistique();">{$LNG.ov_points}</a></div>
            <div class="right_part ">{$rankInfo}</div>
        </div>
		
		
		
		<div class="palnet_block_info palnet_big_info" name="information_stat_1"{if $cookiesStatDisplay == 'true'} style="display: block;"{else} style="display: none;"{/if}>
            <div class="left_part"><a href="javascript:toggleStatistique();">{$LNG.st_buildings}</a></div>
            <div class="right_part">{$getBuildPointMod}</div>
			
            <div class="left_part"><a href="javascript:toggleStatistique();">{$LNG.st_researh}</a></div>
            <div class="right_part">{$getTechPointMod}</div>
        </div>
		
		<div class="palnet_block_info palnet_big_info1" name="information_stat_2"{if $cookiesStatDisplay == 'true'} style="display: block;"{else} style="display: none;"{/if}>
            <div class="left_part" ><a href="javascript:toggleStatistique();">{$LNG.st_fleets}</a></div>
            <div class="right_part">{$getFleetPointMod}</div>
            <div class="left_part"><a href="javascript:toggleStatistique();">{$LNG.st_defenses}</a></div>
            <div class="right_part">{$getDefensePointMod}</div>
        </div>
	
    </div>
	
		
    {if $is_news || $userID == 1}
    
    

	<div id="ach_level" class="ach_content" style="margin: 0 10px 7px 10px;">
    <div id="news_ower"><br>

{$news}
</div></div> 
{/if}


    
        <div class="ref_system">
    	 {$LNG.over_referal}
        <a href="game.php?page=refsystem" style="float:right;">{$LNG.over_referal_more}...</a>
		 
    </div>


    </div>
</div>
</div>

            <div class="clear"></div>   
            </div>         
        </div>
{/block}
