{block name="title" prepend}{$LNG.lm_records}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
      	<div style="float:left">{$LNG.lm_records}:</div>
        <span class="record_btn ico_star record_btn_active" title="{$LNG.tech_all}" onclick="allopen();"></span>
        <span class="record_btn ico_builds" title="{$LNG.st_buildings}" onclick="buildsopen();"></span>
        <span class="record_btn ico_tech" title="{$LNG.pl_tech}" onclick="techopen();"></span>
        <span class="record_btn ico_fleet" title="{$LNG.pl_fleet}" onclick="fleetopen();"></span>
        <span class="record_btn ico_shield" title="{$LNG.pl_def}" onclick="defopen();"></span>    
        <span style="color:#777; float:right;">{$LNG.rec_last_update_on}: {$update}</span>    
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
    <div id="u000">
        <div class="record_header">
            {$LNG.st_buildings}
            <div class="record_header_top_line"></div>
            <div class="record_header_bottom_line"></div>
        </div>
		{foreach $buildList as $elementID => $elementRow}
                <div class="record_rows ">
            <div class="bottom_line_progres" style=""></div>
            <div class="record_img_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">
                    <img alt="" src="./styles/theme/gow/gebaeude/{$elementID}.gif">
                </a>
            </div>
            <div class="record_name_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">{$LNG.tech.{$elementID}}</a>
            </div>
			{if !empty($elementRow)}
                        <div class="record_made ico_record_made tooltip_sticky" data-tooltip-content="
                <span style='line-height:20px; font-size:14px; color:#6c6;'>{$LNG.record_etabl}</span><br />
				
				 {foreach $elementRow as $user} &bull; {if $user.recordshidden == 0}<a href='#' style='line-height:20px;' onclick='return Dialog.Playercard({$user.userID});'>{if empty($user.customNick)}{$user.username}{else}{$user.customNick}{/if}</a>{else}Hidden{/if}{if !$user@last}<br>{/if}{/foreach}<br /> ">
		     	
            </div>
			{/if}
			
            <div class="record_count">
			{if !empty($elementRow)}
                <div class="record_text record_server"><span>{$LNG.record_rec}</span> <div>{$elementRow[0].level|number}</div></div>
                <div class="record_text"><span>{$LNG.record_you}</span> <div>{$myBuildList[$elementID]}</div></div>
			{else}
				<div class="record_text record_server"><span>{$LNG.record_rec}:</span> <div>-</div></div>
				<div class="record_text"><span>{$LNG.record_you}:</span> <div>0</div></div>
			{/if}
            </div>
                    </div>
               {/foreach} 
                
          
            </div>
    <div id="u100">
        <div class="record_header">
            {$LNG.pl_tech}
            <div class="record_header_bottom_line"></div>
            <div class="record_header_top_line"></div>
        </div>
		{foreach $researchList as $elementID => $elementRow}
                <div class="record_rows ">
            <div class="bottom_line_progres" style=""></div>
            <div class="record_img_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">
                    <img alt="" src="./styles/theme/gow/gebaeude/{$elementID}.gif">
                </a>
            </div>
            <div class="record_name_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">{$LNG.tech.{$elementID}}</a>
            </div>
			{if !empty($elementRow)}
                        <div class="record_made ico_record_made tooltip_sticky" data-tooltip-content="
                <span style='line-height:20px; font-size:14px; color:#6c6;'>{$LNG.record_etabl}</span><br />
				
				 {foreach $elementRow as $user} &bull; {if $user.recordshidden == 0}<a href='#' style='line-height:20px;' onclick='return Dialog.Playercard({$user.userID});'>{if empty($user.customNick)}{$user.username}{else}{$user.customNick}{/if}</a>{else}Hidden{/if}{if !$user@last}<br>{/if}{/foreach}<br /> ">
		     	
            </div>
			{/if}
			
            <div class="record_count">
			{if !empty($elementRow)}
                <div class="record_text record_server"><span>{$LNG.record_rec}</span> <div>{$elementRow[0].level|number}</div></div>
                <div class="record_text"><span>{$LNG.record_you}</span> <div>{$myBuildList[$elementID]}</div></div>
			{else}
				<div class="record_text record_server"><span>{$LNG.record_rec}:</span> <div>-</div></div>
				<div class="record_text"><span>{$LNG.record_you}:</span> <div>0</div></div>
			{/if}
            </div>
                    </div>
               {/foreach} 
            </div>
    <div id="u200">
        <div class="record_header">
            {$LNG.pl_fleet}
            <div class="record_header_bottom_line"></div>
            <div class="record_header_top_line"></div>
        </div>
		{foreach $fleetList as $elementID => $elementRow}
                <div class="record_rows ">
            <div class="bottom_line_progres" style=""></div>
            <div class="record_img_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">
                    <img alt="" src="./styles/theme/gow/gebaeude/{$elementID}.gif">
                </a>
            </div>
            <div class="record_name_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">{$LNG.tech.{$elementID}}</a>
            </div>
			{if !empty($elementRow)}
                        <div class="record_made ico_record_made tooltip_sticky" data-tooltip-content="
                <span style='line-height:20px; font-size:14px; color:#6c6;'>{$LNG.record_etabl}</span><br />
				
				 {foreach $elementRow as $user} &bull; {if $user.recordshidden == 0}<a href='#' style='line-height:20px;' onclick='return Dialog.Playercard({$user.userID});'>{if empty($user.customNick)}{$user.username}{else}{$user.customNick}{/if}</a>{else}Hidden{/if}{if !$user@last}<br>{/if}{/foreach}<br /> ">
		     	
            </div>
			{/if}
			
            <div class="record_count">
			{if !empty($elementRow)}
                <div class="record_text record_server"><span>{$LNG.record_rec}</span> <div>{$elementRow[0].level|number}</div></div>
                <div class="record_text"><span>{$LNG.record_you}</span> <div>{$myBuildList[$elementID]|number}</div></div>
			{else}
				<div class="record_text record_server"><span>{$LNG.record_rec}:</span> <div>-</div></div>
				<div class="record_text"><span>{$LNG.record_you}:</span> <div>0</div></div>
			{/if}
            </div>
                    </div>
               {/foreach} 
                
            </div>
    <div id="u400">
        <div class="record_header">
            {$LNG.pl_def}
            <div class="record_header_bottom_line"></div>
            <div class="record_header_top_line"></div>
        </div>
		{foreach $defenseList as $elementID => $elementRow}
                <div class="record_rows ">
            <div class="bottom_line_progres" style=""></div>
            <div class="record_img_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">
                    <img alt="" src="./styles/theme/gow/gebaeude/{$elementID}.gif">
                </a>
            </div>
            <div class="record_name_utits">
                <a href="#" onclick="return Dialog.info({$elementID})">{$LNG.tech.{$elementID}}</a>
            </div>
			{if !empty($elementRow)}
                        <div class="record_made ico_record_made tooltip_sticky" data-tooltip-content="
                <span style='line-height:20px; font-size:14px; color:#6c6;'>{$LNG.record_etabl}</span><br />
				
				{foreach $elementRow as $user} &bull; {if $user.recordshidden == 0}<a href='#' style='line-height:20px;' onclick='return Dialog.Playercard({$user.userID});'>{if empty($user.customNick)}{$user.username}{else}{$user.customNick}{/if}</a>{else}Hidden{/if}{if !$user@last}<br>{/if}{/foreach}<br /> ">
		     	
            </div>
			{/if}
			
            <div class="record_count">
			{if !empty($elementRow)}
                <div class="record_text record_server"><span>{$LNG.record_rec}</span> <div>{$elementRow[0].level|number}</div></div>
                <div class="record_text"><span>{$LNG.record_you}</span> <div>{$myBuildList[$elementID]|number}</div></div>
			{else}
				<div class="record_text record_server"><span>{$LNG.record_rec}:</span> <div>-</div></div>
				<div class="record_text"><span>{$LNG.record_you}:</span> <div>0</div></div>
			{/if}
            </div>
                    </div>
               {/foreach} 
               
            </div>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}