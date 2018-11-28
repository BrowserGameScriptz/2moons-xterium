{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">   	
    	{$LNG.all_frac_2}  
        <span style="color:#FC6; float:right;" id="span_point">{$ally_fraction_credits} {$LNG.planet_dia_s_6}</span>
	</div>
        <div class="ally_contents" style="color:#CCC; padding:0px;">
    	 <img alt="" title="" style="float:left; height:64px; width:68px;" src="styles/images/alliance/fraction_2.png" />
         <p style="padding:6px;">
         	{$LNG.ally_fractions_22}
         </p>
         <div class="clear"></div>
         <p style="padding:6px; text-align:center; color:#F00;">
         	{$LNG.ally_fractions_3}
         </p>
    </div>
    <div class="gray_stripe">    	
    	{$LNG.peace_13}
	</div>
        <div class="ally_contents" style="color:#CCC; line-height:17px; position:relative;">    	
					{$LNG.ally_fractions_9}, {$LNG.ally_fractions_24}, {$LNG.ally_fractions_25}: 
        			<span style="color:#0F6">{$ally_fraction_armor}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(0.5%)</span><br />
					
					{$LNG.ally_fractions_39}: 
        			<span style="color:#0F6">{$ally_fraction_expe_speed}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(2%)</span><br />
										
					{$LNG.ally_fractions_30}: 
        			<span style="color:#0F6">{$ally_fraction_upgrade_acti}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(0.08%)</span><br />
					
					{$LNG.ally_fractions_31}: 
        			<span style="color:#0F6">{$ally_fraction_combat_exp_expe}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(2%)</span><br />
					
					{$LNG.ally_fractions_41}: 
        			<span style="color:#F33">{$ally_fraction_research_price}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(-0.5%)</span><br />
					
					{$LNG.ally_fractions_32}: 
        			<span style="color:#0F6">{$ally_fraction_ally_point}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(4%)</span><br />
                            	                	                	                	                	                	                	                	                
                
    </div> 
	{if $ally_fraction_levels < 100}
    <a class="fraction_up" {if $ally_fraction_credits_insu <= $ally_fraction_credits}href="?page=alliance&mode=fractionup&id=2"{/if} style="MARGIN-BOTTOM: 20px;width: 90%;">
    	{$ally_fractions_4} 
		{if $ally_fraction_credits_insu > $ally_fraction_credits}
        <span style="color:#F00;">
        	{$ally_fractions_5}
        </span>
		{/if}
    </a>
	{/if}
		<div class="ref_system" style="position: static">
    	 
        <a href="?page=alliance" style="float:right;">{$LNG.ally_fractions_6}</a>
    </div>
</div>

</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->

{/block}