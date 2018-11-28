{block name="title" prepend}{$LNG.lm_technology}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
      	<div style="float:left">{$LNG.lm_technology}:</div>
        <span class="record_btn ico_star record_btn_active" title="{$LNG.tech_all}" onclick="allopen();"></span>
        <span class="record_btn ico_builds" title="{$LNG.st_buildings}" onclick="buildsopen();"></span>
        <span class="record_btn ico_tech" title="{$LNG.pl_tech}" onclick="techopen();"></span>
        <span class="record_btn ico_fleet" title="{$LNG.pl_fleet}" onclick="fleetopen();"></span>
        <span class="record_btn ico_shield" title="{$LNG.pl_def}" onclick="defopen();"></span>    
        <span class="record_btn ico_oficer" title="{$LNG.of_offi}" onclick="oficopen();"></span>  
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
			
   	<div id="u0">
	
	{foreach $techTreeListBuild as $elementID => $requireList}
	{if !is_array($requireList)}
        <div class="record_header">
            {$LNG.st_buildings}
             <div class="record_header_top_line"></div>
            <div class="record_header_bottom_line"></div>
            <div style="color:#999; font-weight:lighter; float:right; width:53%;">{$LNG.fgp_require}</div>
        </div>       
    {else}	        
    	            <div class="record_rows">
            <div class="record_img_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">
                	<img alt="" src="./styles/theme/gow/gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}">
                </a>
            </div>
            <div class="record_name_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">{$LNG.tech.$elementID}</a></td>
            </div>
                        <div class="required_blocks">
						
						{if $requireList}
		{foreach $requireList as $requireID => $NeedLevel}
                                <div class="required_block required_smal_text">
                    <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="<span style='color:{if $NeedLevel.own < $NeedLevel.count}red{else}lime{/if};'>{$LNG.tech_build}:<br /> {$LNG.tech.$requireID} {$LNG.tt_lvl}  {$NeedLevel.count} ({$NeedLevel.own} / {$NeedLevel.count})</span>">
                        <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.$requireID}" />
                        <div class="text" style="color:{if $NeedLevel.own < $NeedLevel.count}red{else}lime{/if};">{$NeedLevel.count}</div>
                    </a>            
                </div>
				{/foreach}
	{/if}
                                
                            </div>
                    </div>
    	          {/if} 
    	           {/foreach}
    	         
    	        </div>
				

   	<div id="u100">
	{foreach $techTreeListTech as $elementID => $requireList}
	{if !is_array($requireList)}
        <div class="record_header">
            {$LNG.pl_tech}
             <div class="record_header_top_line"></div>
            <div class="record_header_bottom_line"></div>
            <div style="color:#999; font-weight:lighter; float:right; width:53%;">{$LNG.fgp_require}</div>
        </div>       
    	         
    	           
    	          {else}	        
    	            <div class="record_rows">
            <div class="record_img_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">
                	<img alt="" src="./styles/theme/gow/gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}">
                </a>
            </div>
            <div class="record_name_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">{$LNG.tech.$elementID}</a></td>
            </div>
                        <div class="required_blocks">
						
						{if $requireList}
		{foreach $requireList as $requireID => $NeedLevel}
                                <div class="required_block required_smal_text">
                    <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="<span style='color:{if $NeedLevel.own < $NeedLevel.count}red{else}lime{/if};'>{$LNG.tech_build}:<br /> {$LNG.tech.$requireID} {$LNG.tt_lvl}  {$NeedLevel.count} ({$NeedLevel.own} / {$NeedLevel.count})</span>">
                        <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.$requireID}" />
                        <div class="text" style="color:{if $NeedLevel.own < $NeedLevel.count}red{else}lime{/if};">{$NeedLevel.count}</div>
                    </a>            
                </div>
				{/foreach}
	{/if}
                                
                            </div>
                    </div>
    	          {/if} 
    	           {/foreach}
    	         
    	        </div>
   	<div id="u200">
	{foreach $techTreeListFleet as $elementID => $requireList}
	{if !is_array($requireList)}
        <div class="record_header">
            {$LNG.pl_fleet}
             <div class="record_header_top_line"></div>
            <div class="record_header_bottom_line"></div>
            <div style="color:#999; font-weight:lighter; float:right; width:53%;">{$LNG.fgp_require}</div>
        </div>       
    	          
    	            {else}	        
    	            <div class="record_rows">
            <div class="record_img_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">
                	<img alt="" src="./styles/theme/gow/gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}">
                </a>
            </div>
            <div class="record_name_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">{$LNG.tech.$elementID}</a></td>
            </div>
                        <div class="required_blocks">
						
						{if $requireList}
		{foreach $requireList as $requireID => $NeedLevel}
                                <div class="required_block required_smal_text">
                    <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="<span style='color:{if $NeedLevel.own < $NeedLevel.count}red{else}lime{/if};'>{$LNG.tech_build}:<br /> {$LNG.tech.$requireID} {$LNG.tt_lvl}  {$NeedLevel.count} ({$NeedLevel.own} / {$NeedLevel.count})</span>">
                        <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.$requireID}" />
                        <div class="text" style="color:{if $NeedLevel.own < $NeedLevel.count}red{else}lime{/if};">{$NeedLevel.count}</div>
                    </a>            
                </div>
				{/foreach}
	{/if}
                                
                            </div>
                    </div>
    	          {/if} 
    	           {/foreach}
    	         
    	        </div>
   	<div id="u400">
	{foreach $techTreeListDefense as $elementID => $requireList}
	{if !is_array($requireList)}
        <div class="record_header">
            {$LNG.pl_def}
             <div class="record_header_top_line"></div>
            <div class="record_header_bottom_line"></div>
            <div style="color:#999; font-weight:lighter; float:right; width:53%;">{$LNG.fgp_require}</div>
        </div>       
    	            
    	            {else}	        
    	            <div class="record_rows">
            <div class="record_img_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">
                	<img alt="" src="./styles/theme/gow/gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}">
                </a>
            </div>
            <div class="record_name_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">{$LNG.tech.$elementID}</a></td>
            </div>
                        <div class="required_blocks">
						
						{if $requireList}
		{foreach $requireList as $requireID => $NeedLevel}
                                <div class="required_block required_smal_text">
                    <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="<span style='color:{if $NeedLevel.own < $NeedLevel.count}red{else}lime{/if};'>{$LNG.tech_build}:<br /> {$LNG.tech.$requireID} {$LNG.tt_lvl}  {$NeedLevel.count} ({$NeedLevel.own} / {$NeedLevel.count})</span>">
                        <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.$requireID}" />
                        <div class="text" style="color:{if $NeedLevel.own < $NeedLevel.count}red{else}lime{/if};">{$NeedLevel.count}</div>
                    </a>            
                </div>
				{/foreach}
	{/if}
                                
                            </div>
                    </div>
    	          {/if} 
    	           {/foreach}
    	         
    	        </div>
   	<div id="u600">
	{foreach $techTreeListOfficer as $elementID => $requireList}
	{if !is_array($requireList)}
        <div class="record_header">
            {$LNG.of_offi}
             <div class="record_header_top_line"></div>
            <div class="record_header_bottom_line"></div>
            <div style="color:#999; font-weight:lighter; float:right; width:53%;">{$LNG.fgp_require}</div>
        </div>       
    	      
    	     {else}	        
    	            <div class="record_rows">
            <div class="record_img_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">
                	<img alt="" src="./styles/theme/gow/gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}">
                </a>
            </div>
            <div class="record_name_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">{$LNG.tech.$elementID}</a></td>
            </div>
                        <div class="required_blocks">
						
						{if $requireList}
		{foreach $requireList as $requireID => $NeedLevel}
                                <div class="required_block required_smal_text">
                    <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="<span style='color:{if $NeedLevel.own < $NeedLevel.count}red{else}lime{/if};'>{$LNG.tech_build}:<br /> {$LNG.tech.$requireID} {$LNG.tt_lvl}  {$NeedLevel.count} ({$NeedLevel.own} / {$NeedLevel.count})</span>">
                        <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.$requireID}" />
                        <div class="text" style="color:{if $NeedLevel.own < $NeedLevel.count}red{else}lime{/if};">{$NeedLevel.count}</div>
                    </a>            
                </div>
				{/foreach}
	{/if}
                                
                            </div>
                    </div>
    	          {/if} 
    	           {/foreach}
    	         
    	        </div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->

{/block}