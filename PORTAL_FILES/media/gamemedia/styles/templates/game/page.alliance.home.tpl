{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
        <a href="#" style="left:5px; right:auto;" onclick="return Dialog.manualinfo(11)" class="interrogation manual">?</a>
        {if $rights.ADMIN}<a href="?page=alliance&amp;mode=admin" class="batn_lincks right_flank office">{$LNG.al_manage_alliance}</a> {/if}       <div class="position">
            {$LNG.al_rank}: {$rankName}
        </div>                         
    </div>             

    <div class="ally_img">
	
    	<div class="fractions_ico_big">
		
		{*{if $ally_fraction_id == 0}
        	<a href="game.php?page=alliance&amp;mode=fraction&amp;fraction=1"><img alt="" title="" class="tooltip" data-tooltip-content="{$LNG.all_frac_1}" src="styles/images/alliance/fraction_1.png"></a>
        	<a href="game.php?page=alliance&amp;mode=fraction&amp;fraction=2"><img alt="" title="" class="tooltip" data-tooltip-content="{$LNG.all_frac_2}" src="styles/images/alliance/fraction_2.png"></a>
            <a href="game.php?page=alliance&amp;mode=fraction&amp;fraction=3"><img alt="" title="" class="tooltip" data-tooltip-content="{$LNG.all_frac_3}" src="styles/images/alliance/fraction_3.png"></a>
		{else}
			<a href="game.php?page=alliance&amp;mode=fraction&amp;fraction={$ally_fraction_id}"><img alt="" title="" class="tooltip" data-tooltip-content="{$ally_fraction_name} ({$ally_fraction_level}) {if $ally_fraction_id == 1}<div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div>
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
				{/if}" src="styles/images/alliance/fraction_{$ally_fraction_id}.png"></a>
		{/if}*}
		
			
                    </div>

        <table class="no_visible"><tbody><tr><td>
		{if $ally_image}<img src="{$ally_image}" alt="{$ally_name} [{$ally_tag}]">{/if}
                            <span class="designation">
                <span>{$ally_name} [{$ally_tag}]</span><br>
                {if $rights.MEMBERLIST}<a href="?page=alliance&amp;mode=memberList">{$ally_members} {$LNG.all_partici}</a>{else}{$ally_members} {$LNG.all_partici}{/if}                {$LNG.ov_of} {$ally_max_members}
                       {if $rights.SEEAPPLY && $applyCount > 0}	  (<a href="?page=alliance&amp;mode=admin&amp;action=mangeApply">{$LNG.al_requests}: {$requests}</a>){/if}

						 </span>
        </td></tr></tbody></table>                            
    </div>              
    
	<div class="gray_stripe">
        <div class="left_part">	
            <a href="game.php?page=alliance&amp;mode=storage" class="batn_lincks storage">{$LNG.all_storage}</a>
            {if $rights.ROUNDMAIL}<a href="game.php?page=alliance&amp;mode=circular" onclick="return Dialog.open(this.href, 650, 300);" class="batn_lincks right_flank mesages">{$LNG.al_send_circular_message}</a>{/if}
                    </div>
        <div class="right_part">
        	<a href="game.php?page=alliance&amp;mode=development" class="batn_lincks development">{$LNG.all_devlopment} (<span>{$alliance_points|number}&nbsp;</span>)</a>	
             {if isModuleAvailable($smarty.const.MODULE_CHAT)}<a href="game.php?page=chat&amp;chat=ally" class="batn_lincks right_flank chat">{$LNG.al_goto_chat}</a>{/if}
        </div>
    </div>
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
</script>{/if}
	<div class="separator"></div>
     <div id="build_elements" class="officier_elements prem_shop">
    <div class="build_box" style="-moz-border-radius: 0px;-webkit-border-radius: 0px;border-radius: 0px;border: none;margin-left: 0px !important;width: 100% !important;margin-bottom:7px !important;">
        <div class="head" onclick="OpenBox('open_list');">
            <span style="padding:0;margin: 7px 7px 7px 7px;">{$LNG.al_events}</span>
            <span id="open_btn_open_list" class="prem_open_btn">+</span>            
        </div>
		
        <div id="box_open_list" class="content_box" style="height: auto;display:none">
           					{if $rights.EVENTS}
					{if $ally_events}
			{foreach $ally_events as $member => $events}
	⇒{$member}
	
        <div class="fleet_log">
            {foreach $events as $index => $fleet}
            <div class="separator"></div>
                        <div class="fleet_time">
                <div id="fleettime_{$index}" class="fleets" data-fleet-end-time="{$fleet.returntime}" data-fleet-time="{$fleet.resttime}">-</div>
                <div class="tooltip fleet_static_time" data-tooltip-content="{$fleet.resttime1}">{$fleet.resttime1}</div>
            </div>
            <div class="fleet_text">
                {$fleet.text}
                <div class="clear"></div>
            </div>     
            <div class="separator"></div>
           {/foreach}      
        </div>
		
			{/foreach}
		{else}
			<div class="ally_contents"><span>{$LNG.al_no_events}</span></div>		
		{/if}
	{/if}
        </div>
    </div>
	
</div>      
     <div class="gray_stripe">Description</div>      	    	
    <div class="ach_content" style="padding:0;margin: 7px 7px 7px 7px;">
    <div class="ally_contents">
        {if $allyIDS == $xteriumAllyId}{$alliance_xterium_overview}{elseif $ally_description}{$ally_description}{else}{$LNG.al_description_message} {/if}   </div>
     </div>
    <div class="gray_stripe">
       {$LNG.al_inside_section}
    </div>          
	<div class="ach_content" style="padding:0;margin: 7px 7px 7px 7px;">
    <div class="ally_contents">
      {if $allyIDS == $xteriumAllyId}{$LNG.alliance_xterium_description}{else}{$ally_text}{/if}
            </div>
	</div>
	{if !empty($managePlanets) && $PLANETRIGHT == 1}<div class="gray_stripe">
        {$LNG.all_aly_pal}
    </div>
	<div class="ally_contents" style="padding-bottom:15px;">
        <table class="no_visible"><tbody><tr>
            {foreach $managePlanets as $planetId => $allyPlanet}<td><a href="game.php?cp={$planetId}">{$allyPlanet.planetName} [{$allyPlanet.planetGalaxy}:{$allyPlanet.planetSystem}:{$allyPlanet.planetPlanet}]</a></td>{/foreach}   
			</tr></tbody></table>
    </div>{/if}
    {*<div class="gray_stripe">{$LNG.ally_antimatte_1} <a href="#" style="right:5px; left:auto;" class="interrogation manual tooltip" data-tooltip-content="{$LNG.ally_antimatte_2}">?</a></div>          
	<div class="ach_content" style="padding:0;margin: 7px 7px 7px 7px;">
    <div class="ally_contents">
	<form method="post" onsubmit="return antimatterSet()" id="form">
	<input type="hidden" name="action" value="proceedAmTrade">
    <label class="left_label">{$LNG.ally_antimatte_3}</label>
	<select style="width:401px;display:block;float:left;" name="member">{foreach $AllyFriends as $Friend}<option value="{$Friend.friendId}">{$Friend.friendUsername}</option>{/foreach}</select> 
	<div class="clear"></div>   
    <label class="left_label">{$LNG.ally_antimatte_4}</label>
	<input type="text" style="width:393px;display:block;float:left;" name="amount" value="0"></select>
	<div class="clear"></div>    
	<label class="left_label">{$LNG.ally_antimatte_5}</label>
	<center><input type="radio" value="0" name="type"> Free antimatter ({$antimatterAllyFree|number})<input type="radio" value="1" name="type" style="margin-left:5px;" checked> {$LNG.ally_antimatte_6} ({$antimatterAllyBought|number})</center>
	<input value="{$LNG.ally_antimatte_7}" style="line-height:18px; width:100%; display:block; margin:0 auto; margin-top:20px;" type="submit">
	</form>
	</div>
	</div>    *}
		
    <div>
        <div class="left_part">
            <div class="gray_stripe">
                {$LNG.al_manage_diplo}
                				{if $rights.DIPLOMATIC}	<a href="game.php?page=alliance&amp;mode=admin&amp;action=diplomacy" class="batn_lincks right_flank diplomacy">{$LNG.all_eta_diplo}</a>{/if}
                            </div>
            <div class="ally_contents">   
{if array_filter($diploList.1)}
		{foreach $diploList.1 as $diploMode => $diploAlliances}	
		{if !empty($diploAlliances)}
		
  {$LNG.al_diplo_level.$diploMode}<br>
                <ul>
				{foreach $diploAlliances as $diploID => $diploName}
                	<li><a href="?page=alliance&amp;mode=info&amp;id={$diploID}">{$diploName}</a></li>       {/foreach}         </ul>
{/if}
		{/foreach}
	{else}
					
                                    <span></span>{/if}
                            </div>
        </div>
        
        <div class="right_part">
            <div class="gray_stripe">
                {$LNG.all_al_sta}
            </div>
            <div class="ally_contents">
                <p>{$LNG.pl_totalfight}: <span>{$totalfight|number}</span></p>
                <p>{$LNG.pl_fightwon}: <span>{$fightwon|number} {if $totalfight}({round($fightwon / $totalfight * 100, 2)}%){/if} </span></p>
                <p>{$LNG.pl_fightlose}: <span>{$fightlose|number} {if $totalfight}({round($fightlose / $totalfight * 100, 2)}%){/if} </span></p>
                <p>{$LNG.pl_fightdraw}: <span>{$fightdraw|number} {if $totalfight}({round($fightdraw / $totalfight * 100, 2)}%){/if} </span></p>
            </div>
        </div>                           
    </div><div class="clear"></div> 
	
       {if !$isOwner}<div class="gray_stripe">
	 
	 <a href="game.php?page=alliance&amp;mode=close" onclick="return confirm('{$LNG.al_leave_ally}');">{$LNG.al_leave_alliance}</a>
	 
                    </div>   {/if}      
</div><!--/ally-->




            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}

{block name="script" append}
<script type="text/javascript">
	function OpenBox(Key){
		var btn = $('#open_btn_'+Key)
		if(btn.text() == '+')
		{
			$('#box_'+Key).stop(true,false).slideDown(300);
			btn.text('-')
		}
		else
		{
			$('#box_'+Key).stop(true,false).slideUp(300);
			btn.text('+')
		}
	}
	
	
	lngsetting		= '{$LNG.ally_antimatte_10}';
	function antimatterSet()
	{
		if(!confirm(lngsetting)) 
			return false;
		else
			document.getElementById('form').submit();
		return false;
	}
</script>

{/block}