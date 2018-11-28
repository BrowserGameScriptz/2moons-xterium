{block name="title" prepend}{$LNG.allian_21}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
        	{$LNG.allian_21} (<span style="font-weight:bold;">{$alliance_points|number} {$LNG.allian_33}</span>)   
			
			<span style="float:right"> <a href="?page=alliance">{$LNG.sys_back}</a></span>
     </div>
     <div class="ally_contents sepor_conten development_row">
        <div class="development_text">{$LNG.allian_22}</div>
        <div class="development_count">+{$points1001B}%</div>
               
        	{if $rights.ADMIN}
			{if $points1001 > $alliance_points && $allyidchecl != 1}
			<span style="color:#95a3b0; float:right;">{$LNG.allian_23} <span style="color:#fff; font-weight:bold;">{$points1001|number}</span></span>     
			{elseif $allyidchecl != 1}
			<div class="btn_border right_flank">
                <a href="?page=alliance&amp;mode=up&amp;id=1001">
                    <input value="{$LNG.allian_34}" class="tooltip" data-tooltip-content="
                    {$points1001L}" type="submit">
                </a>
            </div>
			{/if}
			{/if}           
             
        <div class="clear"></div>
    </div>
    <div class="ally_contents sepor_conten development_row">
        <div class="development_text">{$LNG.allian_24}</div>
        <div class="development_count">+{$points1002B}%</div>
               
        	{if $rights.ADMIN}
			{if $points1002 > $alliance_points && $allyidchecl != 1}
			<span style="color:#95a3b0; float:right;">{$LNG.allian_23} <span style="color:#fff; font-weight:bold;">{$points1002|number}</span></span>     
			{elseif $allyidchecl != 1}
			<div class="btn_border right_flank">
                <a href="?page=alliance&amp;mode=up&amp;id=1002">
                    <input value="{$LNG.allian_34}" class="tooltip" data-tooltip-content="
                    {$points1002L}" type="submit">
                </a>
            </div>
			{/if}
			{/if}        
             
        <div class="clear"></div>
    </div>
   
    <div class="ally_contents sepor_conten development_row">
        <div class="development_text">{$LNG.allian_26}</div>
        <div class="development_count">+{$points1004B}%</div>
               
        	{if $rights.ADMIN}
			{if $points1004 > $alliance_points && $allyidchecl != 1}
			<span style="color:#95a3b0; float:right;">{$LNG.allian_23} <span style="color:#fff; font-weight:bold;">{$points1004|number}</span></span>     
			{elseif $allyidchecl != 1}
			<div class="btn_border right_flank">
                <a href="?page=alliance&amp;mode=up&amp;id=1004">
                    <input value="{$LNG.allian_34}" class="tooltip" data-tooltip-content="
                    {$points1004L}" type="submit">
                </a>
            </div>
			{/if}
			{/if}   
             
        <div class="clear"></div>
    </div>
    <div class="ally_contents sepor_conten development_row">
        <div class="development_text">{$LNG.allian_27}</div>
        <div class="development_count">+{$points1005B}%</div>
               
        	{if $rights.ADMIN}
			{if $points1005 > $alliance_points && $allyidchecl != 1}
			<span style="color:#95a3b0; float:right;">{$LNG.allian_23} <span style="color:#fff; font-weight:bold;">{$points1005|number}</span></span>     
			{elseif $allyidchecl != 1}
			<div class="btn_border right_flank">
                <a href="?page=alliance&amp;mode=up&amp;id=1005">
                    <input value="{$LNG.allian_34}" class="tooltip" data-tooltip-content="
                    {$points1005L}" type="submit">
                </a>
            </div>
			{/if}
			{/if}   
             
        <div class="clear"></div>
    </div>
    <div class="ally_contents sepor_conten development_row">
        <div class="development_text">
        	{$LNG.allian_28}
        	<span class="interrogation tooltip" data-tooltip-content="<b>{$LNG.allian_29}:</b><br /> {$LNG.allian_30}">!</span>
        </div>
        <div class="development_count">+{$points1006B}%</div>
               
        	{if $rights.ADMIN}
			{if $points1006 > $alliance_points && $allyidchecl != 1}
			<span style="color:#95a3b0; float:right;">{$LNG.allian_23} <span style="color:#fff; font-weight:bold;">{$points1006|number}</span></span>     
			{elseif $allyidchecl != 1}
			<div class="btn_border right_flank">
                <a href="?page=alliance&amp;mode=up&amp;id=1006">
                    <input value="{$LNG.allian_34}" class="tooltip" data-tooltip-content="
                    {$points1006L}" type="submit">
                </a>
            </div>
			{/if}
			{/if}   
             
        <div class="clear"></div>
    </div>
    <div class="ally_contents sepor_conten development_row">
        <div class="development_text">
        	{$LNG.allian_31}
            <span class="interrogation tooltip" data-tooltip-content="<b>{$LNG.allian_29}:</b><br /> {$LNG.allian_32}">!</span>
        </div>
        <div class="development_count">+{$points1007B}%</div>
               
			{if $rights.ADMIN}
			{if $points1007 > $alliance_points && $allyidchecl != 1}
			<span style="color:#95a3b0; float:right;">{$LNG.allian_23} <span style="color:#fff; font-weight:bold;">{$points1007|number}</span></span>     
			{elseif $allyidchecl != 1}
			<div class="btn_border right_flank">
                <a href="?page=alliance&amp;mode=up&amp;id=1007">
                    <input value="{$LNG.allian_34}" class="tooltip" data-tooltip-content="
                    {$points1007L}" type="submit">
                </a>
            </div>
			{/if}
			{/if}   
			
        <div class="clear"></div>
    </div>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
