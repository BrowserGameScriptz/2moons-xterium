{block name="title" prepend}{$LNG.lm_fleet}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
{if !empty($acsData)}
{include file="shared.fleetTable.acsTable.tpl"}
{/if}
<script type="text/javascript">	
	function hidethefleets(id){
		$.getJSON("game.php?page=fleetTable&ajax=1&mode=hideFleets&fleetInfo="+id,
			function(data){
				console.log(data.msg);
		});
	}
</script>



<script type="text/javascript">
	var lng = "{$LNG.delete_tooltips_lng} ";
</script>
    <div class="gray_stripe">
    	<a href="game.php?page=reduceresources" class="fleet_reduce ico_reduceresources tooltip pulsanteflottealto" data-tooltip-content="{$LNG.fleetta_res}"></a>
        <a href="game.php?page=reducefleet" class="fleet_reduce ico_reducefleet tooltip pulsanteflottealto" data-tooltip-content="{$LNG.fleetta_fle}"></a>
		<a href="game.php?page=deliveryres" class="fleet_reduce ico_deliveryres tooltip pulsanteflottealto" data-tooltip-content="{$LNG.fleetta_flealt}"></a>
        <span style="float:right;color:#6ccdce;"><span class="totalFleetPoints">0</span> {$LNG.fleetta_point_fle}</span>
    </div>
	
	<div id="empire_filtrs">
        <span onclick="filterPlanet();" id="filterPlanet" class="imper_btn_filtrs{if empty($getTypetoDisp)} fleettabme_btn_filtrs_activ{/if}" style="background-image:url('/styles/images/iconav/coloni.png');background-repeat:no-repeat;padding-left:40px;background-position:16px 10px;">{$LNG.autoexpedition_2}</span>
        <span onclick="filterExpedition();" id="filterExpedition" class="imper_btn_filtrs{if $getTypetoDisp == 'expo'} fleettabme_btn_filtrs_activ{/if}" style="background-image:url('/styles/images/iconav/g_expedition.png');background-repeat:no-repeat;padding-left:40px;background-position:16px 10px;">{$LNG.type_mission.18}</span>
        <span onclick="FilterHostile();" id="FilterHostile" class="imper_btn_filtrs{if $getTypetoDisp == 'hostile'} fleettabme_btn_filtrs_activ{/if}" style="background-image:url('/styles/images/iconav/g_hostile.png');background-repeat:no-repeat;padding-left:40px;background-position:16px 10px;">{$LNG.autoexpedition_3}</span>
    </div>
  	
	<div class="FleetTablePlanet" id="FleetTablePlanet" style="display:{if empty($getTypetoDisp)}block{else}none{/if}">
		{include file='page.formfleetstep1.tpl'}	
	</div>
	<div class="FleetTableExpedition" id="FleetTableExpedition" style="display:{if $getTypetoDisp == 'expo'}block{else}none{/if}">
		{include file='page.formfleetstep2.tpl'}	
	</div> 
	<div class="FleetTableHostile" id="FleetTableHostile" style="display:{if $getTypetoDisp == 'hostile'}block{else}none{/if}">
		{include file='page.formfleetstep3.tpl'}	
	</div>
	
	</div>
<div id="ally_content" class="conteiner" style="margin-top:20px">
{if $userGroupShips > 0 && count($FleetsOnPlanet) != 0}
 <div class="gray_stripe" style="margin-bottom:3px;">
    	{$LNG.grove_ship}
    </div>
    	{foreach name=groupFleets item=GroupFleetRow from=$userGroupShip}
    <div class="tooltip fl_groop_link_name" data-tooltip-content="
        <table class='reducefleet_table'>
		{foreach $GroupFleetRow.FleetList as $shipID => $shipCount}
                <tr>
            <td class='reducefleet_img_ship'><img src='./styles/theme/gow/gebaeude/{$shipID}.gif' alt='' /></td>
            <td class='reducefleet_name_ship'>{$LNG.tech.{$shipID}}: <span class='reducefleet_count_ship'>{$shipCount}</span></td>
        </tr>
		{/foreach}
                </table>" onclick="GroopShips({$GroupFleetRow.groupId});">{$GroupFleetRow.groupName}</div>
    <a class="fl_groop_link_del" title="{$LNG.delete_tooltips}" onclick="return DeleteGroopShips({$GroupFleetRow.groupIdDel}, '{$GroupFleetRow.groupName}')">×</a>
    	{/foreach}
    
        <div class="clear"></div>    
{/if}
{if count($FleetsOnPlanet) == 0}
		  <div class="ally_contents" style="padding-bottom:0px; text-align:center;">{$LNG.fl_no_ships}<br><br></div>
	{/if}	  
		  
		  
        </form>   
    
    <div class="gray_stripe piccolastriscia barraflottesotto">
        <div class="transparent" style="text-align:left; float:left;color:#7c8e9a">
        	{$LNG.fl_fleets} {$activeFleetSlots} / <span class="tooltip" style="color:#6ccdce" data-tooltip-content="<table class='reducefleet_table'>       
                           <tr><td class='reducefleet_name_ship'>Default {$LNG.fl_fleets}:</td><td class='reducefleet_name_ship'>1</span></td></tr>
				           <tr><td class='reducefleet_name_ship'>{$LNG.tech.108}:</td><td class='reducefleet_name_ship'>{$moduleFlotteTech}</span></td></tr>
				           <tr><td class='reducefleet_name_ship'>{$LNG.academy_21}</td><td class='reducefleet_name_ship'>{$moduleAcademyFleet}</span></td></tr>">{$maxFleetSlots}</span>
			<span>|</span> 
			{$LNG.fl_my_planets} {$currentPlanetCountTable} / <span class="tooltip" style="color:#6ccdce" data-tooltip-content="<table class='reducefleet_table'>       
                           <tr><td class='reducefleet_name_ship'>Default {$LNG.gl_planet}:</td><td class='reducefleet_name_ship'>{$moduleNormalPlanet}/9</span></td></tr>
				           <tr><td class='reducefleet_name_ship'>{$LNG.tech.124}:</td><td class='reducefleet_name_ship'>{$moduleResearchPlanet}/15</span></td></tr>
				           <tr><td class='reducefleet_name_ship'>{$LNG.academy_title.1206}</td><td class='reducefleet_name_ship'>{$moduleAcademyPlanet}/∞</span></td></tr>">{$maxPlanetCount}</span>
        </div>
         <div class="transparent" style="text-align:right; float:right;color:#7c8e9a">
            {$LNG.type_mission.15} {$activeExpedition} / <span class="tooltip" style="color:#6ccdce" data-tooltip-content="<table class='reducefleet_table'>       
                           <tr><td class='reducefleet_name_ship'>{$LNG.tech.124}:</td><td class='reducefleet_name_ship'>{$modulespedizione}</span></td></tr>
				           <tr><td class='reducefleet_name_ship'>{$LNG.lm_premium}:</td><td class='reducefleet_name_ship'>{$modulepremiuespee}</span></td></tr>">{$maxExpedition}</span>
            <span style="color:#000; font-size:15px">|</span> 
            {$activeCapture} / 3 {$LNG.type_mission.25}
			 <span>|</span> 
			{$LNG.type_mission.16} {$activeAsteroids} / <span class="tooltip" style="color:#6ccdce" data-tooltip-content="<table class='reducefleet_table'>       
                           <tr><td class='reducefleet_name_ship'>Default {$LNG.type_mission.16}:</td><td class='reducefleet_name_ship'>4</span></td></tr>
				           <tr><td class='reducefleet_name_ship'>{$LNG.tech.150}:</td><td class='reducefleet_name_ship'>{$moduleAsteroide}</span></td></tr></tr>">{$maxAsteroids}</span>
			 
			 
			 <a href="game.php?page=share">
                            <img src="styles/images/iconav/calculette.png" class="tooltip shareflottesotto" data-tooltip-content="{$LNG.rs_calculate} {$LNG.report_table_9}">
            </a>
        </div>
    </div>
    {if count($activeFleetSlots) != 0}
	{foreach name=FlyingFleets item=FlyingFleetRow from=$FlyingFleetList}
       <div id="id_{$smarty.foreach.FlyingFleets.iteration}" class="fleetDetails detailsOpened" style="display:{if $FlyingFleetRow.isdisplayedtable==0}block{else}none{/if}">
       {if $FlyingFleetRow.state == 0}<span class="timer" secs="{$FlyingFleetRow.fleetStartTime}" id="timer_{$FlyingFleetRow.id}"></span>{/if}
       <span class="absTime">{$FlyingFleetRow.startTime}</span>
       <span class="mission"><span class="{$FlyingFleetRow.FleetType}" style="font-weight:bold">{$LNG.type_mission.{$FlyingFleetRow.mission}}</span></span>
       <span class="originData">
       <span class="originCoords" title=""><a href="game.php?page=galaxy&amp;galaxy={$FlyingFleetRow.startGalaxy}&amp;system={$FlyingFleetRow.startSystem}"><span class="{$FlyingFleetRow.FleetType}">[{$FlyingFleetRow.startGalaxy}:{$FlyingFleetRow.startSystem}:{$FlyingFleetRow.startPlanet}]</span></a></span>
       <span class="originPlanet"><figure class="planetIcon planet" title="{$FlyingFleetRow.planetInfoSen}"></figure>{$FlyingFleetRow.planetInfoSen}</span>
       </span>

       <span class="reversal" style="left:300px;top:1px;width:120px;margin-left:-10px;">
     
	   
	   
							
			  {if !$isVacation && $FlyingFleetRow.state != 1}<a class="icon_link" href="game.php?page=fleetTable&amp;action=sendfleetback&amp;fleetID={$FlyingFleetRow.id}" title="{$LNG.fl_send_back}" {*class="tooltip" data-tooltip-content="SHOW HOW MANY TIME TO RETURN {pretty_time($FlyingFleetRow.fleetEndTime)}"*}>
       <input class="fl_btn_table_fleets_order" value="{$LNG.fl_send_back}" type="submit" style="border-color: #252f38;background: #182024!important;height: 15px;padding: 0px;"></a>
	   
	  {/if}
    <a href="#" class="tooltip basic2" style="left:49px;position: absolute;top:3px;background: url(/styles/images/iconav/flotta{if $FlyingFleetRow.state == 1}sinistra{else}destra{/if}.png) no-repeat;display: block;height: 13px;width: 13px;"data-tooltip-content="{$FlyingFleetRow.FRessource}<table class='reducefleet_table'>       
                           {foreach $FlyingFleetRow.FleetList as $shipID => $shipCount}
						   <tr>
                    <td class='reducefleet_img_ship'><img src='./styles/theme/gow/gebaeude/{$shipID}.gif' alt='' /></td>
                    <td class='reducefleet_name_ship'>{$LNG.tech.{$shipID}}: <span class='reducefleet_count_ship'>{$shipCount}</span></td>
                </tr>
                         {/foreach}
                            </table>" style="margin-left: {if $FlyingFleetRow.actualT >100}100{else} {$FlyingFleetRow.actualT}{/if}%;position:absolute"></a> 
				
	   {if $FlyingFleetRow.mission == 1 && !$isVacation && $FlyingFleetRow.state != 1}  <a href="game.php?page=fleetTable&amp;action=acs&amp;fleetID={$FlyingFleetRow.id}" style="margin-left:20px">
            	<input class="fl_btn_table_fleets_order" style="border-color: #252f38;background: #182024!important;height: 15px;padding: 0px;" value="{$LNG.fl_acs}" type="submit">
            </a>
            	

	{/if}&nbsp;
       </span>
       <span class="starStreak">
       <div style="height: 30px;left: 30px;top: 5px;width: 30px;position:absolute">
       <div class="origin fixed">
       <img height="30" width="30" src="./styles/theme/gow/planeten/small/s_{$FlyingFleetRow.planetInfoSenimg}.png" title="{$FlyingFleetRow.planetInfoSen}" alt="{$FlyingFleetRow.planetInfoSen}">
       </div>
       <div  style="height: 16px;left:35px;top:10px;width: 289px;position:absolute">
       <a id="fleetIcon_{$FlyingFleetRow.id}" href="#" class="tooltip basic2 {if $FlyingFleetRow.state == 1}fleet_icon_reverse{else}fleet_icon_forward{/if}" data-tooltip-content="{$FlyingFleetRow.FRessource}<table class='reducefleet_table'>       
                           {foreach $FlyingFleetRow.FleetList as $shipID => $shipCount}
						   <tr>
                    <td class='reducefleet_img_ship'><img src='./styles/theme/gow/gebaeude/{$shipID}.gif' alt='' /></td>
                    <td class='reducefleet_name_ship'>{$LNG.tech.{$shipID}}: <span class='reducefleet_count_ship'>{$shipCount}</span></td>
                </tr>
                         {/foreach}
                            </table>" style="margin-left:{if $FlyingFleetRow.state == 1}{100-$FlyingFleetRow.actualT}{else}{$FlyingFleetRow.actualT}{/if}%;position:absolute;z-index: 1;"></a>
       </div>
       <div style="height: 30px;top:0px;width: 30px;position:absolute;left: 320px;">
       <img height="30" width="30" src="./styles/theme/gow/planeten/small/s_{$FlyingFleetRow.planetInfoSen1Img}.png" title="{$FlyingFleetRow.planetInfoSen1}" alt="{$FlyingFleetRow.planetInfoSen1}">
       </div> 
       </div>
       </span><!-- Starstreak -->
       <span class="destinationData">
       <span class="destinationPlanet status_abbr_inactive">
       <span><figure class="planetIcon planet" title="{$FlyingFleetRow.planetInfoSen1}"></figure>{$FlyingFleetRow.planetInfoSen1}</span>
       </span>                 
       <span class="destinationCoords" title=""><a href="game.php?page=galaxy&amp;galaxy={$FlyingFleetRow.endGalaxy}&amp;system={$FlyingFleetRow.endSystem}"><span class="{$FlyingFleetRow.FleetType}">[{$FlyingFleetRow.endGalaxy}:{$FlyingFleetRow.endSystem}:{$FlyingFleetRow.endPlanet}]</span></a></span>                
       </span>
	   <span class="nextTimer" secs="{$FlyingFleetRow.resttime}" ></span>
       <span class="nextabsTime">{$FlyingFleetRow.endTime}</span>
       <span class="nextMission textBeefy" style="font-weight:bold">{if $FlyingFleetRow.state == 1}<a title="{$LNG.fl_returning}"><span class="{$FlyingFleetRow.FleetType}">{$LNG.fl_r}</span></a>{else}<a title="{$LNG.fl_onway}"><span class="{$FlyingFleetRow.FleetType}">{$LNG.fl_a}</span></a>{/if}</span>
	  
 {if $FlyingFleetRow.fleet_target_owner != 0}<a href="#" class="sendMail"  title="" onclick="return Dialog.PM({$FlyingFleetRow.fleet_target_owner});" title="{$LNG.write_message}" style="top:1px;right:-112px"></a>{/if} 	   
<span class="openDetails">
<a href="#ido_{$smarty.foreach.FlyingFleets.iteration}" onclick="hidethefleets({$FlyingFleetRow.id});$('#id_{$smarty.foreach.FlyingFleets.iteration}').slideToggle(0);$('#ido_{$smarty.foreach.FlyingFleets.iteration}').slideToggle(00);" class="openCloseDetails"><img src="https://gf3.geo.gfsrv.net/cdnb6/577565fadab7780b0997a76d0dca9b.gif" height="16" width="16" ></a>
</span>
    </div>		

<div id="ido_{$smarty.foreach.FlyingFleets.iteration}" class="fleetDetails detailsOpened" style="display:{if $FlyingFleetRow.isdisplayedtable==0}none{else}block{/if};height: 20px;">
       {if $FlyingFleetRow.state == 0}<span class="timer" secs="{$FlyingFleetRow.fleetStartTime}" id="timer_{$FlyingFleetRow.id}" style="left:76px;width:60px"></span>{/if}
       <span class="mission tooltip" style="top:0px;width: 60px;" data-tooltip-content="{$LNG.type_mission.{$FlyingFleetRow.mission}}"><span class="{$FlyingFleetRow.FleetType}" style="font-weight:bold">{$LNG.type_mission.{$FlyingFleetRow.mission}}</span></span>
       <span class="originData" style="left:142px">
       <span class="originCoords" title=""><a href="game.php?page=galaxy&amp;galaxy={$FlyingFleetRow.startGalaxy}&amp;system={$FlyingFleetRow.startSystem}"><span class="{$FlyingFleetRow.FleetType}">[{$FlyingFleetRow.startGalaxy}:{$FlyingFleetRow.startSystem}:{$FlyingFleetRow.startPlanet}]</span></a></span>
       <span class="originPlanet"><figure class="planetIcon planet" title="{$FlyingFleetRow.planetInfoSen}"></figure>{$FlyingFleetRow.planetInfoSen}</span>
       </span>
 
    
    
       <span class="reversal" style="left:300px; margin-left:-20px;top:1px;width:120px">
       {if !$isVacation && $FlyingFleetRow.state != 1}<a class="icon_link" href="game.php?page=fleetTable&amp;action=sendfleetback&amp;fleetID={$FlyingFleetRow.id}" title="{$LNG.fl_send_back}" style="margin-left:10px"{*class="tooltip" data-tooltip-content="SHOW HOW MANY TIME TO RETURN {pretty_time($FlyingFleetRow.fleetEndTime)}"*}>
       <input class="fl_btn_table_fleets_order" value="{$LNG.fl_send_back}" type="submit" style="border-color: #252f38;background: #182024!important;height: 15px;padding: 0px;"></a>
	   
	{/if}
<a class="tooltip basic2" style="left:59px;position: absolute;top: 3px;background: url(/styles/images/iconav/flotta{if $FlyingFleetRow.state == 1}sinistra{else}destra{/if}.png) no-repeat;display: block;height: 13px;width: 13px;"data-tooltip-content="{$FlyingFleetRow.FRessource}<table class='reducefleet_table'>       
                           {foreach $FlyingFleetRow.FleetList as $shipID => $shipCount}
						   <tr>
                    <td class='reducefleet_img_ship'><img src='./styles/theme/gow/gebaeude/{$shipID}.gif' alt='' /></td>
                    <td class='reducefleet_name_ship'>{$LNG.tech.{$shipID}}: <span class='reducefleet_count_ship'>{$shipCount}</span></td>
                </tr>
                         {/foreach}
                            </table>" style="margin-left: {$FlyingFleetRow.actualT}%;"></a>   
	    {if $FlyingFleetRow.mission == 1 && !$isVacation && $FlyingFleetRow.state != 1}  <a href="game.php?page=fleetTable&amp;action=acs&amp;fleetID={$FlyingFleetRow.id}" style="margin-left:20px">
            	<input class="fl_btn_table_fleets_order" style="border-color: #252f38;background: #182024!important;height: 15px;padding: 0px;" value="{$LNG.fl_acs}" type="submit">
            </a>{/if}
			
			&nbsp;
			
       </span>

       <span class="destinationData">
       <span class="destinationPlanet status_abbr_inactive">
       <span><figure class="planetIcon planet" title="{$FlyingFleetRow.planetInfoSen1}"></figure>{$FlyingFleetRow.planetInfoSen1}</span>
       </span>                 
       <span class="destinationCoords" title=""><a href="game.php?page=galaxy&amp;galaxy={$FlyingFleetRow.endGalaxy}&amp;system={$FlyingFleetRow.endSystem}"><span class="{$FlyingFleetRow.FleetType}">[{$FlyingFleetRow.endGalaxy}:{$FlyingFleetRow.endSystem}:{$FlyingFleetRow.endPlanet}]</span></a></span>                
       </span>
	   <span class="nextTimer" secs="{$FlyingFleetRow.resttime}" ></span>
       <span class="nextMission textBeefy" style="font-weight:bold;left:650px">{if $FlyingFleetRow.state == 1}<a title="{$LNG.fl_returning}"><span class="{$FlyingFleetRow.FleetType}">{$LNG.fl_r}</span></a>{else}<a title="{$LNG.fl_onway}"><span class="{$FlyingFleetRow.FleetType}">{$LNG.fl_a}</span></a>{/if}</span>
	  	   {if $FlyingFleetRow.fleet_target_owner != 0}<a href="#" class="sendMail"  title="" onclick="return Dialog.PM({$FlyingFleetRow.fleet_target_owner});" title="{$LNG.write_message}" style="top:1px;right:-112px"></a>{/if}        
<span class="openDetails" style="cursor:pointer">
<span onclick="hidethefleets({$FlyingFleetRow.id});$('#id_{$smarty.foreach.FlyingFleets.iteration}').slideToggle(0);$('#ido_{$smarty.foreach.FlyingFleets.iteration}').slideToggle(0);" class="openCloseDetails"><img src="https://gf3.geo.gfsrv.net/cdnb6/577565fadab7780b0997a76d0dca9b.gif" height="16" width="16" style="-moz-transform: scaleY(-1); -o-transform: scaleY(-1);-webkit-transform: scaleY(-1);transform: scaleY(-1);filter: FlipV; -ms-filter: 'FlipV';"></span>
</span>
    </div>			
		{/foreach}	{/if}  
		

					
					
        <div class="gray_stripe" style="border-bottom:0;margin-top: 5px;">
        <span style="cursor:help; color:#6ccdce" class="tooltip" data-tooltip-content="
        <table>
            <tr>
                <th style='text-align:right; padding-right:12px;'>{$LNG.fl_bonus_attack}</th> 
             	<td>+{$bonusAttack} %</td>
            </tr>
            <tr>
                <th style='text-align:right; padding-right:12px;'>{$LNG.fl_bonus_shield}</th>
                <td>+{$bonusDefensive} %</td>
            </tr>
            <tr>
                <th style='text-align:right; padding-right:12px;'>{$LNG.cr_armor}</th>
                <td>+{$bonusShield} %</td>
            </tr>
            <tr>
                <th style='text-align:right; padding-right:12px;'>{$LNG.tech.115}</th>
                <td>+{$bonusCombustion} %</td>
            </tr>
            <tr>
                <th style='text-align:right; padding-right:12px;'>{$LNG.tech.117}</th>
                <td>+{$bonusImpulse} %</td>
            </tr>
            <tr>
                <th style='text-align:right; padding-right:12px;'>{$LNG.tech.118}</th>
                <td>+{$bonusHyperspace} %</td>
            </tr>
        </table>
        ">{$LNG.fleetta_tech_bonus}</span>

        <span style="float:right;color:#6ccdce;"><span class="totalFleetPoints">0</span> {$LNG.fleetta_point_fle}</span>
    </div>
</div>
<script type="text/javascript">
	fleetGroopShip	= [{foreach name=groupFleets item=GroupFleetRow from=$userGroupShip}{ {foreach $GroupFleetRow.FleetList as $shipID => $shipCount}"{$shipID}":{$shipCount}{if !$shipCount@last},{/if}{/foreach} },{/foreach}];
	var pointsPrice = { "ship202":0.004,"ship203":0.012,"ship204":0.004,"ship205":0.011,"ship206":0.0265,"ship207":0.058,"ship208":0.04,"ship209":0.018,"ship210":0.001,"ship211":0.12,"ship212":0.0025,"ship213":0.125,"ship214":10.5,"ship215":0.1,"ship216":12.5,"ship217":0.0565,"ship218":500,"ship219":1.8,"ship220":16,"ship221":580,"ship222":360,"ship223":5.625,"ship224":0.15,"ship225":1.8,"ship226":5.2,"ship227":42,"ship228":127,"ship229":0.0105,"ship230":27.75 };
</script>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->

{/block}
{block name="script" append}

<script type="text/javascript">
	(function(e){
	var t=0;var n=1;var r=1e3;jQuery.autocountdown=function(){
	e(".nextTimer").countdown2();t=setInterval("$('.nextTimer').countdown2();",r)
	};jQuery.fn.countdown2=function(r){
	var s={
	refresh:1,interval:1e3,cdClass:"nextTimer",granularity:4,label:["w ","d ","h","m:",""],units:[604800,86400,3600,60,1]
	};if(r&&r.label){
	e.extend(s.label,r.label);delete r.label}if(r&&r.units){
	e.extend(s.units,r.units);delete r.units
	}e.extend(s,r);var o=function(e,t){
	e=String(e);t=parseInt(t)||2;while(e.length<t)e="0"+e;if(e<1)e="00";return e
	};var u=function(e){
	var t=s.label;var n=s.units;var r=s.granularity;output="";for(i=1;i<=n.length;i++){
	value=n[i];if(e>=value){
	var u=o(Math.floor(e/value),2);u=u>0?u:"00";output+=u+t[i];e%=value;r--
	}else if(value==1)output+="00";if(r==0)break}if(output.length<3)output="00:"+output;return output?output:"00:00:00"
	};return this.each(function(){
	secs=e(this).attr("secs");e(this).html(u(secs));secs--;if(secs<1){
	e(this).attr("secs","...");clearInterval(t);if(n)window.location.href=window.location.href
	}else e(this).attr("secs",secs)
	})
	};e.autocountdown()
	})(jQuery);
	
	(function(qr){
	var t=0;var n=1;var r=1e3;jQuery.autocountdown=function(){
	qr(".timer").countdown2();t=setInterval("$('.timer').countdown2();",r)
	};jQuery.fn.countdown2=function(r){
	var s={
	refresh:1,interval:1e3,cdClass:"timer",granularity:4,label:["w ","d ","h","m:",""],units:[604800,86400,3600,60,1]
	};if(r&&r.label){
	qr.extend(s.label,r.label);delete r.label}if(r&&r.units){
	qr.extend(s.units,r.units);delete r.units
	}qr.extend(s,r);var o=function(qr,t){
	qr=String(qr);t=parseInt(t)||2;while(qr.length<t)qr="0"+qr;if(qr<1)qr="00";return qr
	};var u=function(qr){
	var t=s.label;var n=s.units;var r=s.granularity;output="";for(i=1;i<=n.length;i++){
	value=n[i];if(qr>=value){
	var u=o(Math.floor(qr/value),2);u=u>0?u:"00";output+=u+t[i];qr%=value;r--
	}else if(value==1)output+="00";if(r==0)break}if(output.length<3)output="00:"+output;return output?output:"00:00:00"
	};return this.each(function(){
	secs=qr(this).attr("secs");qr(this).html(u(secs));secs--;qr(this).attr("secs",secs)
	})
	};qr.autocountdown()
	})(jQuery);
	
	function fleetAnimation()
	{
		var datenow = Date.now();
		datenow = Math.round(datenow/1000);
		
		{foreach name=FlyingFleets item=FlyingFleetRow from=$FlyingFleetList}
			var fleetPercentage = 0;
			var actualT = 0;
			
			if ({$FlyingFleetRow.state} == 0){
				var endTime 		= {$FlyingFleetRow.fleet_start_time};
				var elementTimeB 	= {$FlyingFleetRow.fleet_start_time-$FlyingFleetRow.start_time}
				var actualT 		= ((datenow - (endTime-elementTimeB)) * 100) / (endTime - (endTime-elementTimeB));
				actualT 			= Math.min(100,actualT);
			}else if ({$FlyingFleetRow.state} == 1){
				var endTime 		= {$FlyingFleetRow.fleet_end_time};
				var elementTimeB 	= {$FlyingFleetRow.fleet_end_time-$FlyingFleetRow.fleet_end_stay}
				var actualT 		= 100 - (((datenow - (endTime-elementTimeB)) * 100) / (endTime - (endTime-elementTimeB)));
				actualT 			= Math.max(0,actualT);
			}else if ({$FlyingFleetRow.state} == 2){
				var endTime 		= {$FlyingFleetRow.fleet_end_stay};
				var elementTimeB 	= {$FlyingFleetRow.fleet_end_stay} - {$FlyingFleetRow.fleet_start_time};
				var actualT 		= 100;
			}
			
			
			$("#fleetIcon_"+{$FlyingFleetRow.id}).css("margin-left",""+actualT+"%");
		{/foreach}
	}
	setInterval(function() { fleetAnimation() }, 1000);
</script>

{/block}
