{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">   	
    	{$LNG.all_frac_3} 
        <span style="color:#FC6; float:right;" id="span_point">{$ally_fraction_credits} {$LNG.planet_dia_s_6}</span>
	</div>
        <div class="ally_contents" style="color:#CCC; padding:0px;">
    	 <img alt="" title="" style="float:left; height:64px; width:68px;" src="styles/images/alliance/fraction_3.png" />
         <p style="padding:6px;">
         	{$LNG.ally_fractions_33}
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
					
					{$LNG.ally_fractions_34}: 
        			<span style="color:#0F6">{$ally_fraction_resource_prod}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(4%)</span><br />
					
					{$LNG.ally_fractions_35}: 
        			<span style="color:#0F6">{$ally_fraction_energy_prod}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(2%)</span><br />
					
					{$LNG.ally_fractions_37}: 
        			<span style="color:#0F6">{$ally_fraction_resource_after_fight}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(0.6%)</span><br />
					
					{$LNG.ally_fractions_38}: 
        			<span style="color:#0F6">{$ally_fraction_peace_exp}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(3%)</span><br />
					
					{$LNG.ally_fractions_42}: 
        			<span style="color:#F33">{$ally_fraction_defe_price}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(0.3%)</span><br />
					
					{$LNG.ally_fractions_43}: 
        			<span style="color:#F33">{$ally_fraction_build_price}%</span>
        			<span style="color:#666;" class="tooltip" data-tooltip-content="{$LNG.ally_fractions_8}">(0.1%)</span><br />
                            	                	                	                	                
       	        
    </div>   	
	{if $ally_fraction_levels < 100}
    <a class="fraction_up" {if $ally_fraction_credits_insu <= $ally_fraction_credits}href="?page=alliance&mode=fractionup&id=3"{/if} style="MARGIN-BOTTOM: 20px;width: 90%;">
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