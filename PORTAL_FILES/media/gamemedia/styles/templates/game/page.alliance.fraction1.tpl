{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">   	
    	{$LNG.all_frac_1}
        <span style="color:#FC6; float:right;" id="span_point">{$ally_fraction_credits} {$LNG.planet_dia_s_6}</span>
	</div>
        <div class="ally_contents" style="color:#CCC; padding:0px;">
    	 <img alt="" title="" style="float:left; height:64px; width:68px;" src="styles/images/alliance/fraction_1.png" />
         <p style="padding:6px;">
         	{$LNG.ally_fractions_2}
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
    	                	        	
					{$LNG.ally_fractions_9}: 
        			<span style="color:#0F6">{$ally_fraction_in_armement}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(2%)</span><br />
					
					{$LNG.ally_fractions_15}: 
        			<span style="color:#0F6">{$ally_fraction_fleet_speed}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(2%)</span><br />
					
					{$LNG.ally_fractions_28}: 
        			<span style="color:#0F6">{$ally_fraction_fleet_capa}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(2%)</span><br />
					
					{$LNG.ally_fractions_29}: 
        			<span style="color:#0F6">{$ally_fraction_fuel}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(2%)</span><br />
					
					{$LNG.ally_fractions_16}: 
        			<span style="color:#0F6">{$ally_fraction_thief_resource}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(0.6%)</span><br />
					
					{$LNG.ally_fractions_17}: 
        			<span style="color:#0F6">{$ally_fraction_combat_exp_pla}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(2%)</span><br />
					
					{$LNG.ally_fractions_18}: 
        			<span style="color:#0F6">{$ally_fraction_teleporter}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(5%)</span><br />
					
					{$LNG.ally_fractions_40}: 
        			<span style="color:#F33">{$ally_fraction_fleet_price}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(-0.2%)</span><br />
					
					{$LNG.ally_fractions_19}: 
        			<span style="color:#0F6">{$ally_fraction_def_debris}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(0.15%)</span><br />
					
                
    </div>   	
	{if $ally_fraction_levels < 100}
    <a class="fraction_up" {if $ally_fraction_credits_insu <= $ally_fraction_credits}href="?page=alliance&mode=fractionup&id=1"{/if} style="MARGIN-BOTTOM: 20px;width: 90%;">
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