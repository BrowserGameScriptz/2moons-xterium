{block name="title" prepend}{if $mode == "defense"}{$LNG.lm_defenses}{else}{$LNG.lm_shipshard}{/if}{/block}
{block name="content"}
<div id="page">
	<div id="content">
	

<form action="game.php?page=dmshipyard&amp;mode={$mode}" method="post">
<div id="build_content" class="conteiner ship_build">
    <div id="fildes_band">
    	<span style="display:block; float:left; margin-left:20px;">{$insta_dm_left}</span>
	   	<a class="bd_dm_buy" href="game.php?page=shipyard&amp;mode={$mode}">{$LNG.customm_25}</a>
    </div> 
    <div id="build_elements">
	
	{if $mode == "fleet"}
        <div class="build_elements">
		
		{foreach $elementListDefault as $ID => $Element}
		
                        <div id="s_{$ID}" class="build_box {if !$Element.techacc}required{/if}">
    <div class="head">
        <a href="#" onclick="return Dialog.info({$ID})" class="interrogation">?</a>                
        <a href="#" onclick="return Dialog.info({$ID})" class="title">
            {$LNG.tech.{$ID}}
        </a> 
		{if $Element.available > 0}
		<span class="tooltip available" data-tooltip-content="{$LNG.customm_12}">(<span id="val_{$ID}">{$Element.available|number}</span>)</span> {/if}  
            </div>
        <div class="content_box">
        <div class="image">
           <a href="#" onclick="return Dialog.info({$ID})"><img src="./styles/theme/gow/gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}"></a>
        </div>
		
		 {if !$Element.techacc}<div class="prices"><div class="price"> {$LNG.Nece}
            </div>  

		{foreach $Element.AllTech as $elementID => $requireList}
		
		
			   {foreach $requireList as $requireID => $NeedLevel}
		
			   {if $NeedLevel.count > $NeedLevel.own}
			    <div class="required_block  required_smal_text">
           <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="Explore:<br />{$LNG.tech.{$requireID}} lvl.  {$NeedLevel.count} ">
                    <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.{$requireID}}">
                    <div class="text">{$NeedLevel.count}</div>
                </a>           
        </div>
		{/if}
		{/foreach}

		 {/foreach}
		</div>     {else}
				
        <div class="prices">
		{foreach $Element.costResources as $RessID => $RessAmount}
                            <div class="price res{$RessID} {if $Element.costOverflow[$RessID] == 0}{else}required{/if}">
                    <div class="ico"></div>
                    <div class="text {if $Element.costOverflow[$RessID] == 0}{else}tooltip{/if}" {if $Element.costOverflow[$RessID] == 0}{else}data-tooltip-content="Не хватает: Металл 0"{/if}>{$RessAmount|number}</div>                                        
                </div>
                    {/foreach}                                          
        </div>
		{/if}
        <div class="clear"></div>
        
        <div class="time_build">
				{if !$Element.techacc}{elseif $Element.elementTime == 0}{elseif $Element.UnitsSecond == 0}
                     {$LNG.fgf_time}: <span class="time_build_text"> {$Element.elementTime|time} </span> 
					 {else}
					 
					 {$LNG.customm_13}: <span class="time_build_text">{$Element.UnitsSecond} {$LNG.customm_14}</span>
            	                    <a href="game.php?page=conveyors&amp;class=l" class="conveyors_up_item tooltip" data-tooltip-content="{$LNG.customm_15}">⇑</a>
					 {/if}
             
        </div>
        
        <div class="clear"></div>
		
		{if !$Element.techacc}{else}
		{if $Element.buyable}
                <div class="btn_build_border btn_build_border_left">
				
        	<label title="{$LNG.bd_max_ships}" onclick="$('#input_{$ID}').val('{$Element.maxBuildable}'); counting('{$ID}');" class="max_btn_ship">{$LNG.bd_max_ships}</label>
        	<div class="div_text count_ships_dots">
            	<input onkeyup="counting('{$ID}');" name="fmenge[{$ID}]" id="input_{$ID}" size="{$maxlength}" maxlength="{$maxlength}" value="0" class="text" tabindex="{$smarty.foreach.FleetList.iteration}" type="text">	
            </div>
			
        </div>
		
		
		
        <div class="btn_build_border btn_build_border_right">
        	<input value="{$LNG.bd_build}" class="input_btn" type="submit">
        </div> 
		{else}<div class="btn_build_border">
		<span class="btn_build red">{$LNG.build_nores}</span>
		</div> {/if}
		{/if}
                <div class="clear"></div>
    </div>
	</div>
	
	{/foreach}
                    <div class="clear"></div>
					
					
        </div>
        {/if}
		
		
		
		
		
        <div class="build_band_conveyors" id="s_light">
            <span>{$LNG.ship_light}</span>
			{if $convLight > 0}<div class="gr_btn_top" style="float:right;margin-right: 10px;"><a class="batn_lincks" href="game.php?page=conveyors&amp;class=l">{$LNG.improve_lig}</a></div>{/if}
			
                    </div>
        <div class="build_elements light_ship">        	
                                            	                   {foreach $elementListLight as $ID => $Element}
		
                        <div id="s_{$ID}" class="build_box {if !$Element.techacc}required{/if}">
    <div class="head">
        <a href="#" onclick="return Dialog.info({$ID})" class="interrogation">?</a>                
        <a href="#" onclick="return Dialog.info({$ID})" class="title">
            {$LNG.tech.{$ID}}
        </a> 
		{if $Element.available > 0}
		<span class="tooltip available" data-tooltip-content="{$LNG.customm_12}">(<span id="val_{$ID}">{$Element.available|number}</span>)</span> {/if}  
            </div>
        <div class="content_box">
        <div class="image">
           <a href="#" onclick="return Dialog.info({$ID})"><img src="./styles/theme/gow/gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}"></a>
        </div>
		
		 {if !$Element.techacc}<div class="prices"><div class="price"> {$LNG.Nece}
            </div>  

		{foreach $Element.AllTech as $elementID => $requireList}
		
		
			   {foreach $requireList as $requireID => $NeedLevel}
		
			   {if $NeedLevel.count > $NeedLevel.own}
			    <div class="required_block  required_smal_text">
           <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="{$LNG.academy_39}:<br />{$LNG.tech.{$requireID}} lvl.  {$NeedLevel.count} ">
                    <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.{$requireID}}">
                    <div class="text">{$NeedLevel.count}</div>
                </a>           
        </div>
		{/if}
		{/foreach}

		 {/foreach}
		</div>     {else}
				
        <div class="prices">
		{foreach $Element.costResources as $RessID => $RessAmount}
                            <div class="price res{$RessID} {if $Element.costOverflow[$RessID] == 0}{else}required{/if}">
                    <div class="ico"></div>
                    <div class="text {if $Element.costOverflow[$RessID] == 0}{else}tooltip{/if}" {if $Element.costOverflow[$RessID] == 0}{else}data-tooltip-content="Не хватает: Металл 0"{/if}>{$RessAmount|number}</div>                                        
                </div>
                    {/foreach}                                          
        </div>
		{/if}
        <div class="clear"></div>
        
        <div class="time_build">
				{if !$Element.techacc}{elseif $Element.elementTime == 0}{elseif $Element.UnitsSecond == 0}
                     {$LNG.fgf_time}: <span class="time_build_text"> {$Element.elementTime|time} </span> 
					 {else}
					 
					 {$LNG.customm_13}: <span class="time_build_text">{$Element.UnitsSecond} {$LNG.customm_14}</span>
            	                    <a href="game.php?page=conveyors&amp;class=l" class="conveyors_up_item tooltip" data-tooltip-content="{$LNG.customm_15}">⇑</a>
					 {/if}
             
        </div>
        
        <div class="clear"></div>
		
		{if !$Element.techacc}{else}
		{if $Element.buyable}
                <div class="btn_build_border btn_build_border_left">
				
        	<label title="{$LNG.bd_max_ships}" onclick="$('#input_{$ID}').val('{$Element.maxBuildable}'); counting('{$ID}');" class="max_btn_ship">{$LNG.bd_max_ships}</label>
        	<div class="div_text count_ships_dots">
            	<input onkeyup="counting('{$ID}');" name="fmenge[{$ID}]" id="input_{$ID}" size="{$maxlength}" maxlength="{$maxlength}" value="0" class="text" tabindex="{$smarty.foreach.FleetList.iteration}" type="text">	
            </div>
			
        </div>
		
		
		
        <div class="btn_build_border btn_build_border_right">
        	<input value="{$LNG.bd_build}" class="input_btn" type="submit">
        </div> 
		{else}<div class="btn_build_border">
		<span class="btn_build red">{$LNG.build_nores}</span>
		</div> {/if}
		{/if}
                <div class="clear"></div>
    </div>
	</div>
	
	{/foreach}
                                                                                                                                                       
        <div class="clear"></div>
        </div>
                <div class="build_band_conveyors" id="s_middle">
            <span>{$LNG.ship_medium}</span>
			{if $convMedium > 0}<div class="gr_btn_top" style="float:right;margin-right: 10px;"><a class="batn_lincks" href="game.php?page=conveyors&amp;class=m">{$LNG.improve_mid}</a></div>{/if}
                    </div>
        <div class="build_elements medium_ship">
                           {foreach $elementListMedium as $ID => $Element}
		
                        <div id="s_{$ID}" class="build_box {if !$Element.techacc}required{/if}">
    <div class="head">
        <a href="#" onclick="return Dialog.info({$ID})" class="interrogation">?</a>                
        <a href="#" onclick="return Dialog.info({$ID})" class="title">
            {$LNG.tech.{$ID}}
        </a>
		{if $Element.available > 0}
		<span class="tooltip available" data-tooltip-content="{$LNG.customm_12}">(<span id="val_{$ID}">{$Element.available|number}</span>)</span> {/if}  
            </div>
        <div class="content_box">
        <div class="image">
           <a href="#" onclick="return Dialog.info({$ID})"><img src="./styles/theme/gow/gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}"></a>
        </div>
		
		 {if !$Element.techacc}<div class="prices"><div class="price"> {$LNG.Nece}
            </div>  

		{foreach $Element.AllTech as $elementID => $requireList}
		
		
			   {foreach $requireList as $requireID => $NeedLevel}
		
			   {if $NeedLevel.count > $NeedLevel.own}
			    <div class="required_block  required_smal_text">
           <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="{$LNG.academy_39}:<br />{$LNG.tech.{$requireID}} lvl.  {$NeedLevel.count} ">
                    <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.{$requireID}}">
                    <div class="text">{$NeedLevel.count}</div>
                </a>           
        </div>
		{/if}
		{/foreach}

		 {/foreach}
		</div>     {else}
				
        <div class="prices">
		{foreach $Element.costResources as $RessID => $RessAmount}
                            <div class="price res{$RessID} {if $Element.costOverflow[$RessID] == 0}{else}required{/if}">
                    <div class="ico"></div>
                    <div class="text {if $Element.costOverflow[$RessID] == 0}{else}tooltip{/if}" {if $Element.costOverflow[$RessID] == 0}{else}data-tooltip-content="Не хватает: Металл 0"{/if}>{$RessAmount|number}</div>                                        
                </div>
                    {/foreach}                                          
        </div>
		{/if}
        <div class="clear"></div>
        
        <div class="time_build">
				{if !$Element.techacc}{elseif $Element.elementTime == 0}{elseif $Element.UnitsSecond == 0}
                     {$LNG.fgf_time}: <span class="time_build_text"> {$Element.elementTime|time} </span> 
					 {else}
					 
					 {$LNG.customm_13}: <span class="time_build_text">{$Element.UnitsSecond} {$LNG.customm_14}</span>
            	                    <a href="game.php?page=conveyors&amp;class=l" class="conveyors_up_item tooltip" data-tooltip-content="{$LNG.customm_15}">⇑</a>
					 {/if}
             
        </div>
        
        <div class="clear"></div>
		
		{if !$Element.techacc}{else}
		{if $Element.buyable}
                <div class="btn_build_border btn_build_border_left">
				
        	<label title="{$LNG.bd_max_ships}" onclick="$('#input_{$ID}').val('{$Element.maxBuildable}'); counting('{$ID}');" class="max_btn_ship">{$LNG.bd_max_ships}</label>
        	<div class="div_text count_ships_dots">
            	<input onkeyup="counting('{$ID}');" name="fmenge[{$ID}]" id="input_{$ID}" size="{$maxlength}" maxlength="{$maxlength}" value="0" class="text" tabindex="{$smarty.foreach.FleetList.iteration}" type="text">	
            </div>
			
        </div>
		
		
		
        <div class="btn_build_border btn_build_border_right">
        	<input value="{$LNG.bd_build}" class="input_btn" type="submit">
        </div> 
		{else}<div class="btn_build_border">
		<span class="btn_build red">{$LNG.build_nores}</span>
		</div> {/if}
		{/if}
                <div class="clear"></div>
    </div>
	</div>
	
	{/foreach}
                                                                                                                                                                                                            <div class="clear"></div>
        </div>
                <div class="build_band_conveyors" id="s_heavy">
            <span>{$LNG.ship_heavy}</span>
			{if $convHeavy > 0}<div class="gr_btn_top" style="float:right;margin-right: 10px;"><a class="batn_lincks" href="game.php?page=conveyors&amp;class=h">{$LNG.improve_heav}</a></div>{/if}
                    </div>
        <div class="build_elements heavy_ship">
                                            	                    {foreach $elementListHeavy as $ID => $Element}
		
                        <div id="s_{$ID}" class="build_box {if !$Element.techacc}required{/if}">
    <div class="head">
        <a href="#" onclick="return Dialog.info({$ID})" class="interrogation">?</a>                
        <a href="#" onclick="return Dialog.info({$ID})" class="title">
            {$LNG.tech.{$ID}}
        </a>
		{if $Element.available > 0}
		<span class="tooltip available" data-tooltip-content="{$LNG.customm_12}">(<span id="val_{$ID}">{$Element.available|number}</span>)</span> {/if}  
            </div>
        <div class="content_box">
        <div class="image">
           <a href="#" onclick="return Dialog.info({$ID})"><img src="./styles/theme/gow/gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}"></a>
        </div>
		
		 {if !$Element.techacc}<div class="prices"><div class="price"> {$LNG.Nece}
            </div>  

		{foreach $Element.AllTech as $elementID => $requireList}
		
		
			   {foreach $requireList as $requireID => $NeedLevel}
		
			   {if $NeedLevel.count > $NeedLevel.own}
			    <div class="required_block  required_smal_text">
           <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="Explore:<br />{$LNG.tech.{$requireID}} lvl.  {$NeedLevel.count} ">
                    <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.{$requireID}}">
                    <div class="text">{$NeedLevel.count}</div>
                </a>           
        </div>
		{/if}
		{/foreach}

		 {/foreach}
		</div>     {else}
				
        <div class="prices">
		{foreach $Element.costResources as $RessID => $RessAmount}
                            <div class="price res{$RessID} {if $Element.costOverflow[$RessID] == 0}{else}required{/if}">
                    <div class="ico"></div>
                    <div class="text {if $Element.costOverflow[$RessID] == 0}{else}tooltip{/if}" {if $Element.costOverflow[$RessID] == 0}{else}data-tooltip-content="Не хватает: Металл 0"{/if}>{$RessAmount|number}</div>                                        
                </div>
                    {/foreach}                                          
        </div>
		{/if}
        <div class="clear"></div>
        
        <div class="time_build">
				{if !$Element.techacc}{elseif $Element.elementTime == 0}{elseif $Element.UnitsSecond == 0}
                     {$LNG.fgf_time}: <span class="time_build_text"> {$Element.elementTime|time} </span> 
					 {else}
					 
					 {$LNG.customm_13}: <span class="time_build_text">{$Element.UnitsSecond} {$LNG.customm_14}</span>
            	                    <a href="game.php?page=conveyors&amp;class=l" class="conveyors_up_item tooltip" data-tooltip-content="{$LNG.customm_15}">⇑</a>
					 {/if}
             
        </div>
        
        <div class="clear"></div>
		
		{if !$Element.techacc}{else}
		{if $Element.buyable}
                <div class="btn_build_border btn_build_border_left">
				
        	<label title="{$LNG.bd_max_ships}" onclick="$('#input_{$ID}').val('{$Element.maxBuildable}'); counting('{$ID}');" class="max_btn_ship">{$LNG.bd_max_ships}</label>
        	<div class="div_text count_ships_dots">
            	<input onkeyup="counting('{$ID}');" name="fmenge[{$ID}]" id="input_{$ID}" size="{$maxlength}" maxlength="{$maxlength}" value="0" class="text" tabindex="{$smarty.foreach.FleetList.iteration}" type="text">	
            </div>
			
        </div>
		
		
		
        <div class="btn_build_border btn_build_border_right">
        	<input value="{$LNG.bd_build}" class="input_btn" type="submit">
        </div> 
		{else}<div class="btn_build_border">
		<span class="btn_build red">{$LNG.build_nores}</span>
		</div> {/if}
		{/if}
                <div class="clear"></div>
    </div>
	</div>
	
	{/foreach}
                                                                                                                                                                                                                                                                    <div class="clear"></div>
        </div>
    </div> 
           
    <!--<div class="build_band">
        <input class="build_band_big_btn" type="submit" value="{$LNG.bd_build}">        
    </div>-->
    </div>
</form>

<script type="text/javascript">
	data			= {$BuildList|json};
	DatatList		= {
	
	{foreach $elementListall as $ID => $Element}
	"{$ID}":{ "id":"{$ID}","available":"{$Element.available|number}","costRessources":{ {foreach $Element.costResources as $RessID => $RessAmount}"{$RessID}":{$RessAmount}{if !$RessAmount@last},{/if}{/foreach} },"costOverflow":{ {foreach $Element.costOverflow as $RessID => $RessAmount}"{$RessID}":{$RessAmount}{if !$RessAmount@last},{/if}{/foreach} },"buyable":true,"maxBuildable":"{$Element.maxBuildable}" }{if !$Element@last},{/if}
	{/foreach}
	
	};
	MaxCount		= 15000000000;
	bd_operating	= '{$LNG.bd_operating}';
	LNGning			= '{$LNG.bd_remaining}:';
	LNGtech901		= '{$LNG.tech.901}';
	LNGtech902		= '{$LNG.tech.902}';
	LNGtech903		= '{$LNG.tech.903}';
	LNGtech911		= '{$LNG.tech.911}';
	LNGtech921		= '{$LNG.tech.921}';
	short_day 		= '{$LNG.short_d}';
	short_hour 		= '{$LNG.short_h}';
	short_minute 	= '{$LNG.short_m}';
	short_second 	= '{$LNG.short_s}';
</script>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script" append}
<script src="scripts/game/shipyard.js"></script>

{/block}