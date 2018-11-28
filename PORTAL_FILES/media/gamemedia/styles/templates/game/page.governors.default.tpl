{block name="title" prepend}{$LNG.offi_2}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="padding-right:0;">
       {$LNG.offi_1}<a href="game.php?page=officier"><input class="right_flank input_blue" value="{$LNG.offi_2}" type="button"> </a>   
       <div class="ach_head_right">
            {$LNG.achiev_2}: <span>{$achievement_point_used|number} / {$achievement_points|number}</span>
       </div><!--/ach_head_right-->             
    </div> 
	<div id="build_elements" class="officier_elements" style="padding-top:10px; padding-bottom:5px;">    	
                {foreach $darkmatterList as $ID => $Element}
                <div id="ofic_{$ID}" class="build_box">
            <div class="head">
			    
                {$LNG.tech.{$ID}} <span style="color:#096;">[{$LNG.gouvernor_5} {$Element.level}/{$Element.maxLevel}] {if $Element.level> 0}<a href="game.php?page=gubernators&mode=resetgouvernor&id={$ID}" class="tooltip" data-tooltip-content="{$LNG.resetpointgov}">⇓</a>{/if} {if $Element.timeLeft > 0}<a href="game.php?page=gubernators&mode=resetgouvernortime&id={$ID}" class="tooltip academy_reset_tree" data-tooltip-content="{$LNG.bs_reset}">⇓</a></span>
				<span style="float:right; margin-right:15px; color:#CCC;">{$LNG.gouvernor_6}: <span id="time_{$ID}">-</span></span>
				{/if}
                            </div>
            <div class="content_box">
                <div class="image">
                       <img src="./styles/theme/gow/gebaeude/{$ID}.png" alt="{$LNG.tech.{$ID}}">
                    </div>
                    <div class="prices">
                        <br>
						{foreach $Element.elementBonus as $BonusName => $Bonus}
                                                <p>
                            <span style="color:#393;">
                                {if $Bonus[0] < 0}-{else}+{/if}<span id="{if $Bonus@iteration === 1}{$Element.gouvernorName}{$ID}{else}{$Element.gouvernorName2}{$ID}{/if}">{if $Bonus[1] == 0}{abs($Bonus[0] * 100)}{else}{$Bonus[0]}{/if}</span>%
                            </span> 
                             {$LNG.bonus.$BonusName}

                        </p>{/foreach}
                                            </div>
                    <div class="clear"></div>
                <div class="left_part">                    
                    <form action="game.php?page=gubernators" method="post" class="build_form">
                    <div class="time_build">
					
                        {$LNG.tech.921}: 
                        <b><span id="price{$ID}" style="color:{if {$Element.maxPrice} < $darkmatter}#6C6{else}#F33{/if}">{$Element.maxPrice|number}</span></b>
						
                    </div>
                    <div class="clear"></div>
                                
							{if $Element.maxPrice < $darkmatter}	
                        <input name="id" value="{$ID}" type="hidden">      
                        <div class="btn_build_border btn_build_border_left dm_btn_build_border_left">
                            <label class="max_btn_ship">{$LNG.gouvernor_1}:</label>
                            <div class="div_text count_ships_dots">
                                <input id="days{$ID}" class="text gubernators_form_days_" onchange="GubPrice('{$ID}', {$Element.maxPrice});" name="days" max="365" min="1" value="1" type="number">
                            </div>
                        </div>
						
						
									
						
                        <div class="btn_build_border btn_build_border_right dm_btn_build_border_right">
                            <button class="btn_build gubernators_form_submit" type="submit">{$LNG.gouvernor_2}</button>  
                        </div>            
                            {else}
						<div class="btn_build_border">
                        <span class="btn_build red">{$LNG.gouvernor_2}</span>
                    </div>							
                              {/if}         
                    </form>
                    <div class="clear"></div>
                </div>
                                <div class="right_part">
                    <form action="game.php?page=gubernators" method="post" class="build_form">
                    <div class="time_build">
                        {$LNG.achiev_2}: 
                        <b><span id="price_point{$ID}" style="color:#09C">{$Element.maxAP}</span></b>                         
                    </div>
                    <div class="clear"></div>
					
					{if $Element.maxLevel <= $Element.level}
						<div class="btn_build_border">
                	                        <span class="btn_build red">
                        	{$LNG.bd_maxlevel}
                        </span>
					                </div>
								{elseif $achievement_points < $Element.maxAP}	
									<div class="btn_build_border">
									<span class="btn_build red">{$LNG.gouvernor_7}</span>
									</div>
									{else}
                    <div class="btn_build_border">
                                    	
                        <input name="lvl_id" value="{$ID}" type="hidden">     
                        <input id="uplvl{$ID}" class="build_number" onchange="GubPriceAP('{$ID}', {$Element.level}, '{$Element.elementName}' );" name="lvl_count" max="{$Element.maxLevel}" min="{$Element.level + 1}" value="{$Element.level + 1}" type="number">              
                        <button class="btn_build gubernators_form_submit btn_build_part_left" type="submit">{$LNG.gouvernor_3} </button>               	 	
                                        </div>
										{/if}   
                    </form>
                    <div class="clear"></div>
                </div>
                                <div class="clear"></div>
            </div>
			
            <div class="clear"></div>
        </div>
		{/foreach}
            </div>
			
</div>

<script type="text/javascript">
	{literal}
		var GOVERNORS = {"dm_attack":{"MaxLevel":65,"priceAP":[50,1.07],"priceDM":[40000,1.1],"bonus":{"Attack":{"default":0.1,"bonuslevel":0.01,"divider":1,"factor":100}}},"dm_defensive":{"MaxLevel":65,"priceAP":[50,1.075],"priceDM":[40000,1.1],"bonus":{"Defensive":{"default":0.1,"bonuslevel":0.01,"divider":1,"factor":100},"Shield":{"default":0.1,"bonuslevel":0.01,"divider":1,"factor":100}}},"dm_buildtime":{"MaxLevel":50,"priceAP":[20,1.1],"priceDM":[7500,1.08],"bonus":{"BuildTimeFall":{"default":0.1,"bonuslevel":0.01,"divider":1,"factor":100},"GueueBuild":{"default":0,"bonuslevel":1,"divider":25,"factor":1}}},"dm_resource":{"MaxLevel":250,"priceAP":[100,1.01],"priceDM":[30000,1.022],"bonus":{"Resource":{"default":0.1,"bonuslevel":0.01,"divider":1,"factor":100},"ResourceGeneral":{"default":0,"bonuslevel":1,"divider":25,"factor":1}}},"dm_energie":{"MaxLevel":100,"priceAP":[50,1.022],"priceDM":[10000,1.055],"bonus":{"Energy":{"default":0.1,"bonuslevel":0.01,"divider":1,"factor":100},"EnergyGeneral":{"default":0,"bonuslevel":1,"divider":25,"factor":1}}},"dm_researchtime":{"MaxLevel":40,"priceAP":[100,1.12],"priceDM":[25000,1.14],"bonus":{"ResearchTimeFall":{"default":0.1,"bonuslevel":0.01,"divider":1,"factor":100},"GueueTech":{"default":0,"bonuslevel":1,"divider":20,"factor":1}}},"dm_fleettime":{"MaxLevel":40,"priceAP":[100,1.13],"priceDM":[50000,1.15],"bonus":{"FlyTime":{"default":0.1,"bonuslevel":0.01,"divider":1,"factor":100}}}};
	{/literal}
	var AllRep = {$achievement_points};
	var DMS = {$darkmatter};
</script>

</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script"}
<script src="scripts/game/gubernators.js"></script>
{/block}