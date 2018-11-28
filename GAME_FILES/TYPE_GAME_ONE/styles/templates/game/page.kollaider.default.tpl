{block name="title" prepend}{$LNG.lm_overview}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
    	<a href="#" onclick="return Dialog.info({$buildingId})">{$LNG.tech.$buildingId}</a> ({$LNG.bd_lvl}. {$level})
    </div>
   	<table class="ally_ranks gray_stripe_th">
        <tbody><tr>
            <td rowspan="2" style="width:120px; height:120px; padding:6px;">
                <a href="#" onclick="return Dialog.info({$buildingId})">
                    <img src="./styles/theme/gow/gebaeude/{$buildingId}.gif" alt="{$LNG.tech.$buildingId}" style="width:120px; height:120px;">
                </a>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:left;">
                {$LNG.shortDescription.$buildingId}
	
            </td>
        </tr>
        <tr>
        	<td colspan="2" style="text-align:left;  padding-left:6px;">
			{$nextlvldm}
            	
            </td>
        </tr>
    </tbody></table>
    <div class="build_band" style="padding-right:0;">
    	<span style="font-weight:bold;">
            {$LNG.customm_6}:
        </span>
		{foreach $costResources as $RessID => $RessAmount}
        <span style="font-weight:bold; margin-left:5px; {if $antimatter < $RessAmount}color:#F00;{else}color:green;{/if}">
          {$RessAmount|number}     
        </span>
        <span>
           {$LNG.tech.$RessID}
        </span>
		
    	            <span style="color:#090; font-weight:bold;">
					{if $antimatter < $RessAmount}
					
                <a class="bd_dm_buy" href="game.php?page=donation">{$LNG.lm_donation}</a>
				{else}
				<form action="game.php?page=kollaider" method="post" class="build_form">
								<input type="hidden" name="cmd" value="insert">
                                <button class="bd_dm_buy" type="submit" >{$LNG.bd_build_next_level}{$levelToBuild + 1}</button>                                
							</form>
							
				
            </span>{/if}
			{/foreach} 
            
    </div> 
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->

{/block}
