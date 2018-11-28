{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
    	{$LNG.al_ally_information}        
    </div>             

    <div class="ally_img">
	
	<div class="fractions_ico_big">
        {if $ally_fraction_id != 0}<img alt="" title="" class="tooltip" data-tooltip-content="{$ally_fraction_name} ({$ally_fraction_level}) {if $ally_fraction_id == 1}<div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div>
				{$LNG.ally_fractions_9}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_in_armement}%</span><br />
				{$LNG.ally_fractions_15}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_fleet_speed}%</span><br />
				{$LNG.ally_fractions_28}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_fleet_capa}%</span><br />
				{$LNG.ally_fractions_29}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_fuel}%</span><br />
				{$LNG.ally_fractions_16}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_thief_resource}%</span><br />
				{$LNG.ally_fractions_17}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_combat_exp_pla}%</span><br />
				{$LNG.ally_fractions_18}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_teleporter}%</span><br />
				{$LNG.ally_fractions_40}: 
        		<span style='color:#F33'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_fleet_price}%</span><br />
				{$LNG.ally_fractions_19}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_def_debris}%</span><br />
				{elseif $ally_fraction_id == 2}<div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div>
				{$LNG.ally_fractions_9}, {$LNG.ally_fractions_24}, {$LNG.ally_fractions_25}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_armor}%</span><br />
				{$LNG.ally_fractions_39}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_expe_speed}%</span><br />
				{$LNG.ally_fractions_30}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_upgrade_acti}%</span><br />
				{$LNG.ally_fractions_31}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_combat_exp_expe}%</span><br />
				{$LNG.ally_fractions_41}: 
        		<span style='color:#F33'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_research_price}%</span><br />
				{$LNG.ally_fractions_32}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_ally_point}%</span><br />
				{elseif $ally_fraction_id == 3}<div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div>
				{$LNG.ally_fractions_34}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_resource_prod}%</span><br />
				{$LNG.ally_fractions_35}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_energy_prod}%</span><br />
				{$LNG.ally_fractions_37}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_resource_after_fight}%</span><br />
				{$LNG.ally_fractions_38}: 
        		<span style='color:#0F6'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_peace_exp}%</span><br />
				{$LNG.ally_fractions_42}: 
        		<span style='color:#F33'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_defe_price}%</span><br />
				{$LNG.ally_fractions_43}: 
        		<span style='color:#F33'>{$ally_fraction_level * $ALLFRACTION.ally_fraction_build_price}%</span><br />
				{/if}" src="styles/images/alliance/fraction_{$ally_fraction_id}.png">{/if}
		</div>
		
                <table class="no_visible"><tbody><tr><td>
                <img src="{$ally_image}" alt="{$ally_tag}">            <span class="designation">
                <span>{$ally_name} [{$ally_tag}]</span><br>
                {$ally_member_scount} / {$ally_max_members}
            </span>
        </td></tr></tbody></table>                            
    </div>              
   
    <div class="gray_stripe">
	 {if $ally_request}
        {if $ally_request_min_points}
                        <a href="game.php?page=alliance&amp;mode=apply&amp;id={$ally_id}" class="batn_lincks mesages">{$LNG.al_click_to_send_request}</a>
						{else}
		{* {$ally_request_min_points_info} *}
	{/if}
	
	{/if}
                        </div>
        <div class="ach_content" style="padding:0;margin: 7px 7px 7px 7px;">
    <div class="ally_contents">
      

{if $allyIDS == $xteriumAllyId}{$alliance_xterium_overview}{elseif $ally_description}{$ally_description}{else}{$LNG.al_description_message} {/if}	   </div>         
      </div>
    <div>
	
        <div class="left_part">
		{if $diplomaticData}
		
            <div class="gray_stripe">
                  {$LNG.al_manage_diplo}
            </div>
            <div class="ally_contents">      
                    {if !empty($diplomaticData.0)}                                            {$LNG.al_diplo_level.0}<br>
                <ul>
                	{foreach item=PaktInfo from=$diplomaticData.0}<li><a href="?page=alliance&amp;mode=info&amp;id={$PaktInfo.1}">{$PaktInfo.0}</a></li>    {/foreach}            </ul>{/if}
					
					{if !empty($diplomaticData.1)}                                            {$LNG.al_diplo_level.0}<br>
                <ul>
                	{foreach item=PaktInfo from=$diplomaticData.1}<li><a href="?page=alliance&amp;mode=info&amp;id={$PaktInfo.1}">{$PaktInfo.0}</a></li>    {/foreach}            </ul>{/if}
					
					{if !empty($diplomaticData.2)}                                            {$LNG.al_diplo_level.0}<br>
                <ul>
                	{foreach item=PaktInfo from=$diplomaticData.2}<li><a href="?page=alliance&amp;mode=info&amp;id={$PaktInfo.1}">{$PaktInfo.0}</a></li>    {/foreach}            </ul>{/if}
					
					{if !empty($diplomaticData.3)}                                            {$LNG.al_diplo_level.0}<br>
                <ul>
                	{foreach item=PaktInfo from=$diplomaticData.3}<li><a href="?page=alliance&amp;mode=info&amp;id={$PaktInfo.1}">{$PaktInfo.0}</a></li>    {/foreach}            </ul>{/if}
					
					{if !empty($diplomaticData.4)}                                            {$LNG.al_diplo_level.0}<br>
                <ul>
                	{foreach item=PaktInfo from=$diplomaticData.4}<li><a href="?page=alliance&amp;mode=info&amp;id={$PaktInfo.1}">{$PaktInfo.0}</a></li>    {/foreach}            </ul>{/if}
					
					
					
            {/if}                                                                                </div>
        </div>
		

                <div class="right_part" >
				{if !empty($statisticData)}
            <div class="gray_stripe">
                {$LNG.all_al_sta}
            </div>
            <div class="ally_contents">
                <p>{$LNG.pl_totalfight}: <span>{$statisticData.totalfight|number}</span></p>
                <p>{$LNG.pl_fightwon}: <span>{$statisticData.fightwon|number}{if $statisticData.totalfight} ({round($statisticData.fightwon / $statisticData.totalfight * 100, 2)}%){/if}</span></p>
                <p>{$LNG.pl_fightlose}: <span>{$statisticData.fightlose|number}{if $statisticData.totalfight} ({round($statisticData.fightlose / $statisticData.totalfight * 100, 2)}%){/if}</span></p>
                <p>{$LNG.pl_fightdraw}: <span>{$statisticData.fightdraw|number}{if $statisticData.totalfight} ({round($statisticData.fightdraw / $statisticData.totalfight * 100, 2)}%){/if}</span></p>
            </div>
			{/if}   
        </div>
                                
    </div>
              
</div><!--/ally-->
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}