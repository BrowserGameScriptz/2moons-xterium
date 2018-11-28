{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
        	{$LNG.all_aly_pal} <span style="float:right; color:#f0bb62;">{$LNG.premium_13}: {$playerStarDust|number}</span>      
     </div>
	 {foreach $managePlanets as $planetId => $allyPlanet}
     <div class="ally_contents sepor_conten development_row">
		<span style="float:left;">{$allyPlanet.planetRanking}</span>   
                	<div class="ally_planet_text">
            	{$allyPlanet.planetName}
            	<a href="game.php?page=galaxy&amp;galaxy={$allyPlanet.planetGalaxy}&amp;system={$allyPlanet.planetSystem}">[{$allyPlanet.planetGalaxy}:{$allyPlanet.planetSystem}:{$allyPlanet.planetPlanet}]</a>
            </div>
                <div class="clear"></div>
		</div>
		{/foreach}
        <div class="ally_contents sepor_conten development_row">
		<span style="float:left;">{$planetRanking+1}</span>
       	       	{if $planetRanking < 3}<form action="game.php?page=alliance&amp;mode=admin&amp;action=planetsSend" method="post">
       		<input type="hidden" name="number" value="{$planetRanking}">{/if}
      		<div class="ally_planet_text">             
            	<input type="text" class="shortcut-input" name="shortcut_galaxy" value="" size="1" maxlength="1" placeholder="{$LNG.short_gals}" pattern="[0-9]*">:
            	<input type="text" class="shortcut-input" name="shortcut_system" value="" size="4" maxlength="4" placeholder="{$LNG.short_syss}" pattern="[0-9]*">:
            	<input type="text" class="shortcut-input" name="shortcut_planet" value="" size="2" maxlength="2" placeholder="{$LNG.short_pals}" pattern="[0-9]*">
			</div>
            
            {if $planetRanking < 3}<span style="cursor:help; margin:8px 0 0 6px; color:#0FF;" class="interrogation tooltip" data-tooltip-content="
                <span style='font-weight:bold; color:#0C0;'>{$LNG.moon_value}:</span><br>
                {$LNG.tech.901}: {$priceMetal|number}<br>
                {$LNG.tech.902}: {$priceCrystal|number}<br>
                {$LNG.tech.903}: {$priceDeuterium|number}<br>
				{$LNG.premium_13}: {$priceStellarDu|number}
            " >?</span>
             
            <div class="btn_border right_flank">
            	<input type="submit" value="{$LNG.fl_continue}">
            </div>{/if}
       </form>
              <div class="clear"></div>
	</div>
        
    
    </div>
<div class="ally_bottom" style="text-align:left;">
    <a href="game.php?page=alliance&amp;mode=admin">{$LNG.ally_fractions_6}</a>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
