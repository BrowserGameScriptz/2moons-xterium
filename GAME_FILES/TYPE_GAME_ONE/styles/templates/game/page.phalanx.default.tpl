{block name="title" prepend}{$LNG.gl_phalanx}{/block}
{block name="content"}
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:auto;">
    <div class="gray_stripe">
    	{$LNG.px_scan_position} [{$galaxy}:{$system}:{$planet}] ({$name})
    </div>
    <div class="fleet_log">
		{foreach $fleetTable as $index => $fleet}
    	<div class="separator"></div>
                <div class="fleet_time">
        	<div id="v" class="fleets" data-fleet-end-time="{$fleet.returntime}" data-fleet-time="{$fleet.resttime}">-</div>
            <div class="tooltip fleet_static_time" data-tooltip-content="Full Date Here">-</div>
        </div>
        <div class="fleet_text">
        	{$fleet.text}
        	<div class="clear"></div>
        </div>     
		
			{foreachelse}
				{if $isYours == 1}
				<div class="ally_contents">This is your planet</div>
				{else}
        		<div class="ally_contents">{$LNG.px_no_fleet}</div>
				{/if}
		      {/foreach}
    </div>	
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}