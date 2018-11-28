<div id="fool_conteiner"><div style="display: none;" id="scroller">
	<a class="scroller_mesages" title="{$LNG.lm_messages}" href="game.php?page=messages" onclick="document.location.href = 'game.php?page=messages'">
        <span class="mesages"></span>
        <span class="new_email">{if $new_message != 0}+{$new_message}{/if}</span>
        <span class="clear"></span>
    </a>
	<span class="go_top_bg">{$LNG.lm_totop}</span>
</div>
<!--il-->
<div id="left_side" >        
    <div id="left_menu"><div id="touchscreenleft_menu">        
        <div id="indicators"><div id="attack" class="indicator {if $totalAttacks > 0}active_indicator{/if} tooltip" data-tooltip-content="{$LNG.customm_1}"><div class="icoi"></div></div><div id="grab" class="indicator {if $totalCapture > 0}active_indicator{/if} tooltip" data-tooltip-content="{$LNG.customm_2}"><div class="icoi"></div></div><div id="destruction" class="indicator {if $unicAttacks > 0}active_indicator{/if} tooltip" data-tooltip-content="{$LNG.customm_3}"><div class="icoi"></div></div><div id="espionage" class="indicator {if $totalSpio > 0}active_indicator{/if} tooltip" data-tooltip-content="{$LNG.customm_4}" href="game.php?page=overview"><div class="icoi"></div></div><div id="rocket" class="indicator {if $totalRockets > 0}active_indicator{/if} tooltip" data-tooltip-content="{$LNG.customm_5}"><div class="icoi"></div></div></div>     
                
      
		
		<div class="olistabarrabasso"><div id="servertime" class="servertime oservertime">{$servertime}</div><span class="oservertime tooltip" data-tooltip-content="Server Time: {$servertime1}">&nbsp;(?)</span></div>
		{include file='page.mainnav.tutorial.tpl'}
                                  
        
        
                 
                        <a class="oamlink" href="game.php?page=donation" style="width: 40%;">{$LNG.lm_donation} {if $donation_b != 0}<span style="color:#FC0;float: right;margin-top: -12px;position: absolute;margin-left: -20px;">+{$donation_b}%</span>{/if}<!--<img src="styles/images/iconav/stars.png" class="oamlinkimg">--></a>
    	        
        <a href="game.php?page=premium" class="big_btn premium btn_menu btn_menu_big opremlink " style="width: 40%;">    
		<img class="left" src="./styles/theme/gow/images/ico-account-premium.png" alt="Premium Account" {if $special_donation_premium > 0}style="margin-left: -8px;"{else}style="margin-left: 0px;"{/if}>  
              <span style="color:#FC0;">{$LNG.lm_premium} {if $special_donation_premium > 0}<span style="color:#09C;">+{$special_donation_premium}%</span>{/if}</span> 
			  {if $special_donation_premium > 0}{else}<img class="right" src="./styles/theme/gow/images/ico-account-premium.png" alt="Premium Account" style="margin-right: 0px;"/>    {/if}       
        </a>
        
        <div class="separator"></div> 

		<!-- ricerche  tecnologie-->
        <a class="nuovomenusinistra" href="game.php?page=research" id="munu_research">{$LNG.lm_research}</a>
		<a class="nuovomenudestra" href="game.php?page=research"><img src="styles/images/iconav/tech.png" class="imgovernuovo"></a>
		
		<!-- costruzioni risorse-->
        <a class="nuovomenusinistra" href="game.php?page=buildings" id="munu_build">{$LNG.lm_buildings}</a>
		<a class="nuovomenudestra tooltip" href="game.php?page=resources" id="munu_resources" data-tooltip-content="{$LNG.lm_resources}"><img src="styles/images/iconav/simulator.png" class="oimgaltro"></a>
		
		<!-- flotta hangar -->
		<a class="nuovomenusinistra" href="game.php?page=shipyard" id="munu_shipyard_fleet">{$LNG.lm_shipshard}</a>
		<a class="nuovomenudestra tooltip" href="game.php?page=fleetTable" id="munu_fleetable" data-tooltip-content="{$LNG.lm_fleet}"><img src="styles/images/iconav/hangar.png" class="oimgaltro blink_me"></a>
		
		<!-- difese -->
		<a class="nuovomenusinistra" href="game.php?page=defense" id="munu_shipyard_defense">{$LNG.lm_defenses}</a>
		<a class="nuovomenudestra" href="game.php?page=defense"><img src="styles/images/iconav/shield.png" class="imgovernuovo"></a>
		
		<!-- ufficiali governatori -->
		<a class="nuovomenusinistra" href="game.php?page=officier" id="munu_senat">{$LNG.lm_officiers}</a>
		<a class="nuovomenudestra tooltip" href="game.php?page=gubernators" data-tooltip-content="{$LNG.offi_1}"><img src="styles/images/iconav/governatori.png" class="oimgaltro"></a>
		
		<!-- arsenale-->
		<a class="nuovomenusinistra" href="game.php?page=arsenal">{$LNG.lm_arsenal}</a>
		<a class="nuovomenudestra" href="game.php?page=arsenal"><img src="styles/images/iconav/arsenal.png" class="imgovernuovo"></a>
		
		
		<!-- mercato-->
		<a class="nuovomenusinistra" href="game.php?page=market">{$LNG.lm_market}</a>
		<a class="nuovomenudestra" href="game.php?page=market"><img src="styles/images/iconav/market.png" class="imgovernuovo"></a>
		
	
		<!-- accademia-->
		<a class="nuovomenusinistra" href="game.php?page=academy" id="munu_academy">{$LNG.lm_academy}</a>
		<a class="nuovomenudestra" href="game.php?page=academy"><img src="styles/images/iconav/accademy.png" class="imgovernuovo"></a>
		
		<!-- galassia note-->
		<a class="nuovomenusinistra" href="game.php?page=galaxy" id="munu_galaxy">{$LNG.lm_galaxy}</a>
		<a class="nuovomenudestra" href="game.php?page=galaxy"><img src="styles/images/iconav/galaxy.png" class="imgovernuovo"></a>
		
		<!-- alleanza-->
		<a class="nuovomenusinistra" href="game.php?page=alliance">{$LNG.lm_alliance}</a>
		<a class="nuovomenudestra" href="game.php?page=alliance"><img src="styles/images/iconav/alliance.png" class="imgovernuovo"></a>
		
		<!-- mercenary-->
		{*<a class="nuovomenusinistra" href="game.php?page=mercenary">Mercenary</a>
		<a class="nuovomenudestra" href="game.php?page=mercenary"><img src="styles/images/iconav/headhunter.png" class="imgovernuovo"></a>*}
		
		
		
		  {if $shozpltype == 3}
		<div class="clear"></div>        
        <div class="separator"></div>
		<a class="nuovomenusinistra" style="word-break: break-all;overflow: hidden;border-right:1px solid #000;width:40.5%;" href="game.php?page=kollaider">{$LNG.tech.69}</a>
        <a class="nuovomenusinistra" style="word-break: break-all;overflow: hidden;border-right:1px solid #000;width:40.5%;" href="#" onclick="return Dialog.info(43)">{$LNG.lm_sprungtor}</a>
		{/if}
         {if $showDock == 1}
		<div class="clear"></div>        
        <div class="separator"></div>
        <a class="nuovomenusinistra" href="game.php?page=dock" style="width:89%;border-right:1px solid #000;text-align:center;">{$LNG.tech.7}</a>
         {/if}
		 {if $showSensor == 1}
		<div class="clear"></div>        
        <div class="separator"></div>
        <a class="nuovomenusinistra" href='javascript:OpenPopup("?page=sensor", "", 640, 510);' style="width:89%;border-right:1px solid #000;text-align:center;">{$LNG.sensorMsg}</a>
         {/if}
		 
        <div class="clear"></div>        
        <div class="separator"></div>

		<div class='overviewbuttons'>
      <a href='game.php?page=auctioneer' class='tooltip {if $queryString == "page=auctioneer"}active{/if}' data-tooltip-content="{$LNG.auctioneer_19}">
        <img src="styles/images/iconav/auction.png"></img>
      </a>
      <a href='game.php?page=auctioneer&mode=inventory' class='tooltip {if $queryString == "page=auctioneer&mode=inventory"}active{/if}' data-tooltip-content='{$LNG.auctioneer_25}'>
        <img src="styles/images/iconav/items.png" style="height: 14px;"></img>
      </a>
      <a href='game.php?page=lotteryam' id="munu_lotteryam" class='tooltip {if $queryString == "page=lotteryam"}active{/if}' data-tooltip-content='{$LNG.lottery_dm_18}'>
        <img src="styles/images/iconav/lottery.png"></img>
      </a>
	   <a href='game.php?page=tourney' class='tooltip {if $queryString == "page=tourney"}active{/if}' data-tooltip-content='{$LNG.tourney_12} {if $tourneyEnd > 0}<sup style="color:green;" class="blink_me">ONLINE</sup>{else}<sup style="color:red;">OFFLINE</sup>{/if}'>
      <img src="styles/images/iconav/torneo.png"></img>
      </a>
      <a href='game.php?page=battleSimulator' class='tooltip {if $queryString == "page=battleSimulator"}active{/if}' data-tooltip-content='{$LNG.lm_battlesim}'>
       <img src="styles/images/iconav/risorse.png"></img>
      </a>
	   <a href='game.php?page=achievement' class='tooltip {if $queryString == "page=achievement"}active{/if}' data-tooltip-content='{$LNG.lm_achie}'>
         <img src="styles/images/iconav/achivements.png"></img>
      </a>
    </div>
	 <div class="clear"></div>  
	 <div class="separator"></div>
		<div class="esperienza">
                	<div class="esperienzapace" style="width:{$peacefull_exp_percent}%;">
                    	<div class="left_blick"></div>
                        <div class="right_blick"></div>
                    </div>
                	<div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="level_text tooltip" style="cursor:help !important" data-tooltip-content="
                    	<span style='color:#0C6'>{$LNG.peace_1} - {$LNG.peace_12} {$peacefull_exp_level} ({$peacefull_exp_percent})</span><br />   
                        {$LNG.peace_13}:<br />
                        &nbsp;<span style='color:#0C3'>+{$peacefull_exp_level}%</span> {$LNG.peace_2}<br />
                        &nbsp;<span style='color:#0C3'>+{$peacefull_exp_level}%</span> {$LNG.peace_3}<br />
                        &nbsp;<span style='color:#0C3'>+{$peacefull_exp_level}%</span> {$LNG.peace_4}<br />
                        &nbsp;<span style='color:#0C3'>+{$peacefull_exp_slots}</span> {$LNG.peace_5}<br />
                        &nbsp;<span style='color:#0C3'>+{$peacefull_exp_mission}</span> {$LNG.peace_6}<br />
                        &nbsp;<span style='color:#0C3'>+{$peacefull_exp_light}</span> {$LNG.peace_8}<br />
                        &nbsp;<span style='color:#0C3'>+{$peacefull_exp_medium}</span> {$LNG.peace_9}<br />
                        &nbsp;<span style='color:#0C3'>+{$peacefull_exp_heavy}</span> {$LNG.peace_10}<br />
                        <div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div>
                        <span style='color:#999'>{$LNG.peace_11} {$peacefull_exp_current|number} / {$peacefull_exp_max|number}</span>">
                		
                    </div>
                </div><!--/level-->
                
                <div class="esperienza">
                	<div class="esperienzaguerra" style="width:{$combat_exp_percent}%;">
                    	<div class="left_blick"></div>
                        <div class="right_blick"></div>
                    </div>
                	<div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="separo"></div>
                    <div class="level_text tooltip" style="cursor:help !important" data-tooltip-content="
                    	<span style='color:#F33'>{$LNG.peace_14} - {$LNG.peace_12} {$combat_exp_level} ({$combat_exp_percent}%)</span><br />                   
                        {$LNG.peace_13}:<br />                    
                        &nbsp;<span style='color:#0C3'>+{$combat_exp_level}%</span> {$LNG.peace_15}<br />
                        &nbsp;<span style='color:#0C3'>-{$combat_exp_deut}%</span> {$LNG.peace_16}<br />
                        &nbsp;<span style='color:#0C3'>+{$combat_exp_expedition}%</span> {$LNG.peace_17}<br />                       
                        &nbsp;<span style='color:#0C3'>+{$combat_exp_bonus}%</span> {$LNG.peace_18}<br />                                           
                        &nbsp;<span style='color:#0C3'>+{$combat_exp_collider}%</span> {$LNG.peace_19}<br />
                        &nbsp;<span style='color:#0C3'>+{$combat_exp_upgrade}%</span> {$LNG.peace_20}<br />
                        <div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div>
                        <span style='color:#999'>{$LNG.peace_11} {$combat_exp_current|number} / {$combat_exp_max|number}</span>">
                		
                    </div>
                </div><!--/Batlelevel-->
				
		
	
 
 	{if $supportLeft == 0}{else}
		<a class="btn_menu btn_menu_big {if $TotalTicket >= 20}red{elseif $TotalTicket >= 10}orange{elseif $TotalTicket > 0}green{elseif $TotalTicket == 0}blue{/if}" href="game.php?page=ticketadmin" id="munu_ticketadmin">Support Admin</a>
		{/if}
		
		{if $queryString != "page=bonus"} {if $bonus_timer < $TIME} <a title="{$LNG.lm_bonu}" class="big_btn red btn_menu btn_menu_big" href="game.php?page=bonus" {if $showVoteMenu == 1}style="width:40%"{/if}>
       {if $red_button > 0}{if $red_button > $red_button1}x{$red_button}{else}{/if}{/if}{if $red_button1 > 0}{if $red_button1 > $red_button}x{$red_button1}{else}{/if}{/if}<span> {if $red_button > 0 or $red_button1 > 0}|{/if} {$LNG.lm_bonus}
	   
	   
	   </span></a> {/if}{/if}
       {if $showVoteMenu == 1}<a title="{$LNG.promo__1}" class="big_btn red btn_menu btn_menu_big" href="game.php?page=promote" {if $bonus_timer < $TIME}style="width:40%"{/if}>{$LNG.promo__1}</a>  {/if}
	   
       
     
                <div class="clear"></div>
				
				
    </div></div><!--/left_menu-->
	{if $new_year_status == 1}
				<div id="bottom_new_year">
            	<div class="bottom_gift_bg">
            		<a class="gift_bloc gift_1 {if $newyear_gift_1 == 0}gift_opacity{/if} tooltip" data-tooltip-content="{$LNG.new_year_gift_t_1}" {if $newyear_gift_1 > 0}href="game.php?page=bonus&mode=gift&gift=1"{/if}>{$newyear_gift_1}</a>
                	<a class="gift_bloc gift_2 {if $newyear_gift_2 == 0}gift_opacity{/if} tooltip" data-tooltip-content="{$LNG.new_year_gift_t_2}" {if $newyear_gift_2 > 0}href="game.php?page=bonus&mode=gift&gift=2"{/if}>{$newyear_gift_2}</a>
                	<a class="gift_bloc gift_3 {if $newyear_gift_3 == 0}gift_opacity{/if} tooltip" data-tooltip-content="{$LNG.new_year_gift_t_3}" {if $newyear_gift_3 > 0}href="game.php?page=bonus&mode=gift&gift=3"{/if}>{$newyear_gift_3}</a>
					<a class="gift_bloc gift_4 {if $gift42 == 0}gift_opacity{/if} tooltip" data-tooltip-content="{$LNG.new_year_gift_t_4_1}<br>
{$LNG.new_year_gift_t_4_2}:
<br><span style=' margin-left: 9px; margin-right: 4px; cursor: default; float: left;'>•</span>{$LNG.new_year_gift_t_4_3} <b>1-17</b>
<br><span style=' margin-left: 9px; margin-right: 4px; cursor: default; float: left;'>•</span>{$LNG.new_year_gift_t_4_10} <b>1-17</b>
<br><span style=' margin-left: 9px; margin-right: 4px; cursor: default; float: left;'>•</span>{$LNG.new_year_gift_t_4_9} <b>217-2017</b>
<br><span style=' margin-left: 9px; margin-right: 4px; cursor: default; float: left;'>•</span>{$LNG.new_year_gift_t_4_4} <b>217-2017</b>
<br><span style=' margin-left: 9px; margin-right: 4px; cursor: default; float: left;'>•</span>{$LNG.new_year_gift_t_4_5} <b>217</b>" {if $cosmo_gift_6 > 0}href="game.php?page=bonus&mode=gift&gift=4"{/if}>{$cosmo_gift_6}</a>
					
					
                	
                </div>
            </div>
		{elseif $cosmonaute_status == 1 }
		<div id="bottom_cosmonautics">
            	<div class="bottom_gift_bg">
            		<a class="gift_bloc gift_1 {if $cosmo_gift_1 == 0}gift_opacity{/if} tooltip" data-tooltip-content="{$LNG.cosmaunaute_1}" {if $cosmo_gift_1 > 0}href="game.php?page=bonus&mode=gift&gift=1"{/if}>{$cosmo_gift_1}</a>
                	<a class="gift_bloc gift_2 {if $cosmo_gift_2 == 0}gift_opacity{/if} tooltip" data-tooltip-content="{$LNG.cosmaunaute_2}" {if $cosmo_gift_2 > 0}href="game.php?page=bonus&mode=gift&gift=2"{/if}>{$cosmo_gift_2}</a>
                	<a class="gift_bloc gift_3 {if $cosmo_gift_3 == 0}gift_opacity{/if} tooltip" data-tooltip-content="{$LNG.cosmaunaute_3}" {if $cosmo_gift_3 > 0}href="game.php?page=bonus&mode=gift&gift=3"{/if}>{$cosmo_gift_3}</a>
                	<a class="gift_bloc gift_4 {if $gift4_1 == 0}gift_opacity{/if} tooltip" data-tooltip-content="{$LNG.cosmaunaute_4}" {if $cosmo_gift_4 > 0}href="game.php?page=bonus&mode=gift&gift=4"{/if}>{$cosmo_gift_4}</a>
                </div>
            </div>
            
		{elseif $halloween_event == 1}
		<div id="bottom_halloween">
            	<div class="bottom_gift_bg">
            		<a class="gift_bloc gift_1 {if $halloween_gift_1 == 0}gift_opacity{/if} tooltip" data-tooltip-content="{$LNG.haloween_1}" {if $halloween_gift_1 > 0}href="game.php?page=bonus&mode=gift&gift=1"{/if}>{$halloween_gift_1}</a>
                	<a class="gift_bloc gift_2 {if $halloween_gift_2 == 0}gift_opacity{/if} tooltip" data-tooltip-content="{$LNG.haloween_2}" {if $halloween_gift_2 > 0}href="game.php?page=bonus&mode=gift&gift=2"{/if}>{$halloween_gift_2}</a>
                	<a class="gift_bloc gift_3 {if $halloween_gift_3 == 0}gift_opacity{/if} tooltip" data-tooltip-content="{$LNG.haloween_3}" {if $halloween_gift_3 > 0}href="game.php?page=bonus&mode=gift&gift=3"{/if}>{$halloween_gift_3}</a>
                	<a class="gift_bloc gift_4 {if $halloween4_1 == 0}gift_opacity{/if} tooltip" data-tooltip-content="{$LNG.haloween_4}" {if $halloween4 > 0}href="game.php?page=bonus&mode=gift&gift=4"{/if}>{$halloween4}</a>
                </div>
            </div>
            {/if}
	 <div style="height:0; overflow:hidden;" loop="false;" id="music">
        <audio id="beepataks" preload="auto">
            <source src="//play.warofgalaxyz.com/sound/sirena.mp3">
            <source src="//play.warofgalaxyz.com/sound/sirena.ogg"> 
        </audio>
        <script type="text/javascript">
            var ataks = "{$totalAttacks}";
			var grab = "0";
            var spio = "{$totalSpio}";
            var unic = "{$unicAttacks}";
            var rakets = "{$totalRockets}";
			document.getElementById('beepataks').volume={$sirena};
			var miniChat		= "{$MiniChat}";
			var chat_domen_name	= "play.warofgalaxyz.com/{$Website2}";
			
			
        </script>
    </div>
  
</div>
