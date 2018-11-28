      <div id="body">
		  <div id="header">
              <div id="top_nav" class="otopnav">
                 
				 <a title="{$LNG.lm_overview}" href="game.php?page=overview"><img src="styles/images/logoxterium.png" class="logoxterium"></a>
				 <div style="display:none;">					
				  <select id="lstPlaneta" name="lstPlaneta" onchange="document.location = $(this).val();">
				 {html_options options=$PlanetSelect selected=$current_pids}
				 </select>
					</div>
					
                	<div class="mini_planet_navigation" style="margin: auto;left: 0;right: 0;width: 235px;background: none;top: 46px;position: absolute;">
                    <span class="link_back" title="" onclick="eval('location=\''+document.getElementById('lstPlaneta').options[document.getElementById('lstPlaneta').selectedIndex-1].value+'\'');"></span>
                   <span class="link_next" title="" onclick="eval('location=\''+document.getElementById('lstPlaneta').options[document.getElementById('lstPlaneta').selectedIndex+1].value+'\'');"></span>
                   </div>
                    
                    <div id="planet_select" style="margin: auto;left: 0;right: 0;top:46px;">
					<div class="active_panet">
				    <div class="name_palnet" style="padding-left: 1px;width: 96px;"><img src='./styles/theme/gow/planeten/small/s_{$planetImage}.png' style="float:left;height: 22px;padding-top:3px;margin-right: 5px;">{$planetName}</div> 
					<span class="ico_build"></span>                            
					<div class="coordinates_palnet">[{$planetGalaxy}:{$planetSystem}:{$planetPlanet}]</div>
					<div class="clear"></div>
					</div>
                        <div id="list_palnet">
					   {foreach $PlanetListing as $ID => $Element}        
					   <div class="separator_h"></div>              
                     
                            <div class="palnet_row {if $current_pid == $ID}active_palnet_row{/if}">
							<div class="fleet_indicators">
                                	<img id="{$ID}m1" {if $Element.totalAttacks == 0}style="display:none;"{/if} src="styles/images/iconav/p_select_attack.png" alt="" class="tooltip" data-tooltip-content="{$LNG.pla_attack_1}" />                                    
                                    <img id="{$ID}m12" style="display:none;" src="styles/images/iconav/p_select_grab.png" alt="" class="tooltip" data-tooltip-content="Планету захватывают" />
                                    <img id="{$ID}m6" {if $Element.totalSpio == 0}style="display:none;"{/if} src="styles/images/iconav/p_select_spio.png" alt="" class="tooltip" data-tooltip-content="{$LNG.pla_attack_2}" />
                                    <img id="{$ID}m10" {if $Element.totalRockets == 0}style="display:none;"{/if} src="styles/images/iconav/p_select_rocket.png" alt="" class="tooltip" data-tooltip-content="{$LNG.pla_attack_3}" />
                                     {if $Element.luna !=0}  
                                    <img id="{$Element.luna}m1" {if $Element.totalAttackLuna == 0}style="display:none;"{/if} src="styles/images/iconav/p_select_moon_attack.png" alt="" class="tooltip" data-tooltip-content="{$LNG.pla_attack_4}" />
                                    <img id="{$Element.luna}m6" {if $Element.totalRocketsLuna == 0}style="display:none;"{/if} src="styles/images/iconav/p_select_moon_spio.png" alt="" class="tooltip" data-tooltip-content="{$LNG.pla_attack_5}" />       
                                    <img id="{$Element.luna}m9" style="display:none;" src="styles/images/iconav/p_select_destrued.png" alt="" class="tooltip" data-tooltip-content="{$LNG.pla_attack_6}" />
                                    <img id="{$Element.luna}m10" {if $Element.totalSpioLuna == 0}style="display:none;"{/if} src="styles/images/iconav/p_select_moon_rocket.png" alt="" class="tooltip" data-tooltip-content="{$LNG.pla_attack_7}" />                         
									{/if}
                                    <div class="clear"></div>
						   </div>
						   
                            	<span class="{if $current_pid == $ID}active_urlpalnet{else}urlpalnet{/if}" url="cp={$ID}">
								<img src='./styles/theme/gow/planeten/small/s_{$Element.image}.png' style="float:left;height: 22px;padding-top: 5px;">
                                <span class="name_palnet"  style="padding-top: 5px;padding-left: 5px;width: 70px; {if $Element.last_relocate == 0}color:#ff5252 !important;"{elseif $Element.isGal6Mod == 1}color:#f7fe2e !important;"{/if}">{$Element.name}</span>
                                  

								  <span class="ico_build">
								  {if $Element.buildInfo.buildings}
                                                                        	<img src="styles/images/iconav/p_select_build.png" alt="" class="tooltip" data-tooltip-content="
                                        <table class='reducefleet_table'>
                                            <tr>
                                            <td rowspan='2'><img alt='' src='./styles/theme/gow/gebaeude/{$Element.buildInfo.buildings['id']}.gif' width='35' height='35'></td>
                                            <td>{$LNG.tech[$Element.buildInfo.buildings['id']]} ({$Element.buildInfo.buildings['level']|number})</td>
                                            </tr>
                                            <tr><td>{pretty_time($Element.buildInfo.buildings['timeleft'])} </td></tr>
                                    	</table>
                                        " />
										{/if}
										{if $Element.buildInfo.fleet}
                                             <img src="styles/images/iconav/p_select_ship.png" alt="" class="tooltip" data-tooltip-content="
                                        <table class='reducefleet_table'>
                                            <tr>
                                            <td rowspan='2'><img alt='' src='./styles/theme/gow/gebaeude/{$Element.buildInfo.fleet['id']}.gif' width='35' height='35'></td>
                                            <td>{$LNG.tech[$Element.buildInfo.fleet['id']]}</td>
                                            </tr>
                                            <tr><td>{$Element.buildInfo.fleet['level']|number}</td></tr>
                                    	</table>
                                        " /> 
										{/if}
										{if $Element.buildInfo.tech}
																			<img src="styles/images/iconav/p_select_tech.png" alt="" class="tooltip" data-tooltip-content="
                                        <table class='reducefleet_table'>
                                            <tr>
                                            <td rowspan='2'><img alt='' src='./styles/theme/gow/gebaeude/{$Element.buildInfo.tech['id']}.gif' width='35' height='35'></td>
                                            <td>{$LNG.tech[$Element.buildInfo.tech['id']]} ({$Element.buildInfo.tech['level']|number})</td>
                                            </tr>
                                            <tr><td>{pretty_time($Element.buildInfo.tech['timeleft'])} </td></tr>
                                    	</table> " />
										{/if}
										</span>  
											


										
                            		<span class="coordinates_palnet" style="width: 60px;">[{$Element.galaxy}:{$Element.system}:{$Element.planet}]</span>
                                </span>
                                  {if $Element.luna !=0}                             
                                <div class="separator_v"></div>
                                <span class="{if $current_pid == $Element.luna}active_urlpalnet{else}urlpalnet{/if}" url="cp={$Element.luna}">
                                    <span class="moon_select {if $current_pid == $Element.luna}moon_active{/if}"></span>
                                    <span class="ico_build">
                                    	<br />                                                                              </span>
                                </span>
								{/if}
                                                            </div> 
                                               {/foreach}
                                                   
                      		                        
                                      
                        </div>
                    </div><!--/planet_select-->
                    
					
					 <img title="" src="{$useravatar}" class="settingxterium" onclick="return Dialog.Playercard({$userID}, '{$metausername}');">
					<span class="usernameow" onclick="return Dialog.Playercard({$userID}, '{$metausername}');">{$metausername}</span>        
                  <div id="res_nav" style="width:55%;margin: auto;margin-top: -2px;border: none;background: none;position: absolute;left: 0;right: 0;">
				  {foreach $resourceTable as $resourceID => $resourceData}
					{if $resourceID < 904}
                	<div id="res_block_{$resourceData.name}" class="bloc_res tooltip" style="margin-left: 1%; width: 23%;" data-tooltip-content="<span class='p_res'>{if $resourceData.name == "metal"}{$LNG.tech.901}{elseif $resourceData.name == "crystal"}{$LNG.tech.902}{elseif $resourceData.name == "deuterium"}{$LNG.tech.903}{/if}</span><div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div>{$LNG.in_prod_p_hour}: {$resourceData.informationh|number}<br />{$LNG.top_day}: {$resourceData.informationd|number}<br />{$LNG.top_month}: {$resourceData.informationm|number} <div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div> <span style='color:#999'>{$resourceData.current|number} / {$resourceData.max|number}</span>">
                		<div class="ico_res"></div>
                        <a href="game.php?page=trader&amp;mode=trade&amp;resource={$resourceID}" class="exchange_res tooltip" data-tooltip-content="{$LNG.tr_exchange} <span class='p_res'>{if $resourceData.name == "metal"}{$LNG.tech.901}{elseif $resourceData.name == "crystal"}{$LNG.tech.902}{elseif $resourceData.name == "deuterium"}{$LNG.tech.903}{/if}</span>"></a>                        
                        <div class="stock_res" {if $resourceData.name == "metal"}style="background-color:#3a2d21;"{elseif $resourceData.name == "crystal"}style="background-color:#3a4552;"{elseif $resourceData.name == "deuterium"}style="background-color: #303e2b;"{/if}>
                        	<div class="stock_percentage" style="width:{$resourceData.percent}%;"></div>
                            <div class="stock_text"><span id="current_{$resourceData.name}">{$resourceData.current|number}</span> (<span class="pricent">{$resourceData.percent}</span>%)</div>
                        </div>
                    </div>
					{elseif $resourceID == 911}
					 <div id="res_block_{$resourceData.name}" class="bloc_res tooltip" style="margin-left: 1%;width: 23%;" data-tooltip-content="<span class='p_res'>{$LNG.top_energ}</span><div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div>{$LNG.gl_free}: {$resourceData.percent|number}%">
                		<div class="ico_res"></div>
                        <div class="stock_res">
                        	<div class="stock_percentage stock_percentage_left" style="width:{abs($resourceData.percent/2)}%;{if $resourceData.percent > 0}display:none;{/if}"></div>
                            <div class="stock_percentage stock_percentage_right" style="width:{$resourceData.percent/2}%;{if $resourceData.percent < 0}display:none;{/if}"></div>
                            <div class="separator_energie"></div>
                            <div class="stock_text"><span id="current_energy">{$resourceData.used|number}</span>&nbsp;/&nbsp;{$resourceData.max|number}</div>
                        </div>
                    </div>
					{/if}
				
					{/foreach}
           
                     <div style="display:none;">
						{foreach $resourceTable as $resourceID => $resourceData}
						{if !isset($resourceData.current) || !isset($resourceData.max)}
						{else}
						{if $resourceID != 921}
                    	<span class="res_max" id="max_{$resourceData.name}">{$resourceData.max|number}</span>
						{/if}
						{/if}
						{/foreach}
                	</div>           
					{if $bodyclass != "popup" && $tutorial == 1}<span class="flashing_bg"></span>{/if}          </div>											
                </div>
				<!--/top_nav-->
				<div id="barrasottoover">
               <div id="top_nav_parte_left">
              <a title="{$LNG.lm_empire}" href="game.php?page=imperium"><span class="imperia"></span></a>
              <div class="separator_nav"></div>
              <a title="{$LNG.lm_statistics}" href="game.php?page=statistics"><span class="stats"></span></a>
			  <div class="separator_nav"></div>
              <a title="{$LNG.lm_topkb}" href="game.php?page=battleHall"><span class="topbk"></span></a>
		     <div class="separator_nav"></div><a title="{$LNG.lm_records}" href="game.php?page=records"><span class="record"></span></a>
              <div class="separator_nav"></div>
              <a title="{$LNG.lm_messages}" href="game.php?page=messages" id="a_mesage"><span class="mesages"></span><span class="new_email" {if $new_message == 0}style="display:none;"{/if}>{$new_message}</span></a>                                   
             <div class="separator_nav"></div>                 
              </div>
			
			 <div class="antimateria" id="res_block_antimatter"> <span class="tooltip_sticky" data-tooltip-content="
                    	<span class='p_res'>{$LNG.tech.922}</span><div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div>
                    	<a class='nuovomenusinistra' href='game.php?page=trader&amp;mode=obmen' style='width: 65px;float: left;'><img src='styles/images/amvsdm.png' style='margin-top:-3px;'></a>
                    	<a class='nuovomenusinistra' href='game.php?page=trader&amp;mode=honor' style='width: 65px;float: left;'><img src='styles/images/amvshonor.png' style='margin-top:-3px;'></a>
                        <a class='oamlink' href='game.php?page=donation' style='width: 65px;float: left;'>{$LNG.top_purchase}</a>
                        <div style='border-bottom:1px dashed #666; margin:35px 0 4px 0;'></div> <span style='color:#999'>{$LNG.top_avaibel}: {$antimatter|number}</span>" id="current_antimatter">{$antimatter|number}<span class="antimg"></span>
                    </span></div>
					  
           <div class="materiaoscura" id="res_block_darkmatter">  <span class="tooltip_sticky" data-tooltip-content="
                    	<span class='p_res'>{$LNG.tech.921}</span><div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div>
                    	<a class='tooltip_class_a_bigbtn' href='game.php?page=trader&mode=tradetm'><img src='styles/images/dmvsresources.png' style='margin-top:-2px;'></a>
                        <div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div> <span style='color:#999'>{$LNG.top_avaibel}: {$darkmatter|number}</span>" id="current_darkmatter" name="">{$darkmatter|number}
                    </span><span class="darkimg"></span></div>
			


				<div id="top_nav_parte_right">
				 <div class="separator_nav"></div>		
				 <a title="{$LNG.lm_buddylist}" href="game.php?page=buddyList"><span class="frend"></span></a>
				 <div class="separator_nav"></div>
				 <a title="{$LNG.lm_forums}" href="game.php?page=board" target="_blank"><span class="forum"></span></a>
				 <div class="separator_nav"></div>
				 <a title="{$LNG.lm_technology}" href="game.php?page=techtree">
				 <span class="techtree"></span></a>
				 <div class="separator_nav"></div>
				 <a title="{$LNG.lm_options}" href="#" onclick="klicsetting();"><span class="seting"></span></a>  
                    
				<div id="settinghided" class="settmehid">
				<a title="{$LNG.lm_options}" href="game.php?page=settings"> <span class="seting"></span></a>
				 <a title="{$LNG.lm_rules}" href="//warofgalaxyz.com/index.php?page=rules" target="_blank"><span class="rules"></span> </a> 
				<a title="{$LNG.lm_notes}" href="javascript:OpenPopup('?page=notes', 'notes', 900, 250);"> <span class="notes"></span></a>
				<a title="{$LNG.lm_support}" href="game.php?page=ticket"><span class="soopart"></span></a>
				<a title="{$LNG.lm_search}" href="game.php?page=search"> <span class="search"></span></a>	
				</div>
			 <div class="separator_nav"></div> <a title="{$LNG.lm_logout}" href="game.php?page=logout"> <span class="exit"></span></a>
							   </div>
			</div>
											
											
											
			
				 {if $userID == 0} <div id="res_nav">
				 {if $new_year_status == 1}
                	<div id="top_new_year">
                    		<div class="top_gift_left"></div>
                        	<div class="top_gift_mid"></div>
                        	<div class="top_gift_right"></div>
                        </div> 
					 
					  {elseif $cosmonaute_status == 1}
					 <div id="top_cosmonautics">
                    		<div class="top_gift_left"></div>
                        	<div class="top_gift_mid"></div>
                        	<div class="top_gift_right"></div>
                        </div>
						
					{elseif $halloween_event == 1}
					 <div id="top_halloween">
                    		<div class="top_gift_left"></div>
                        	<div class="top_gift_mid"></div>
                        	<div class="top_gift_right"></div>
                        </div>
						{/if}
					   	 </div><!--/res_nav-->  {/if}               

		{if !$vmode}
		
		<script type="text/javascript">
		{foreach $resourceTable as $resourceID => $resourceData}
		{if isset($resourceData.production)}
		var resourceTicker{if $resourceID == 901}Metal{elseif $resourceID == 902}Crystal{elseif $resourceID == 903}Deuterium{elseif $resourceID == 921}Darkmatter{/if} = {
			available: {$resourceData.current|json},
			limit: [0, {$resourceData.max|json}],
			production: {$resourceData.production|json},
			valueElem: "current_{$resourceData.name}",
			valueName: "{$resourceData.name}"
		};
		{/if}
		{/foreach}	
		var shortlyNumber	= false
		var vacation = {$vmode};
		if (!vacation) {
			resourceTicker(resourceTickerMetal, true);
			resourceTicker(resourceTickerCrystal, true);
			resourceTicker(resourceTickerDeuterium, true);
			resourceTicker(resourceTickerDarkmatter, true);
		}
		</script>
		
		
        {if $hasGate}<script src="scripts/game/gate.js"></script>{/if}
		{/if}
		
	</div>
	
	
	{if $closed}
	<div class="infobox">{$LNG.ov_closed}</div>
	{elseif $delete}
	<div class="infobox">{$delete}</div>
	{elseif $vacation}
	<div class="infobox">{$LNG.tn_vacation_mode} {$vacation}</div>
	{/if}
	{if $resourceLogInfoLost != 0}
	<div class="infobox">You recently opened a ticket about resource you have lost. You can click <a href="game.php?page=easyres">here</a> to proceed to the tool to claim them back.</div>
	{/if}





	
