{block name="title" prepend}{$LNG.customm_8}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="build_content" class="conteiner">
    <div id="fildes_band">
        <div class="fildes_band_text">
       		{$LNG.customm_8}
        </div>
    </div>   
    <div id="build_elements">
		    {foreach $elementLi as $ID => $Element}    
	        <div class="build_box {if !$Element.techacc}required{/if}" id="item_{$ID}">
            <div class="head">
                <a href="#" onclick="return Dialog.info({$ID})" class="interrogation">?</a>                
                <a href="#" onclick="return Dialog.info({$ID})" class="title">
                	{$LNG.tech.$ID} {if $Element.level > 0}+{$Element.level} {$LNG.customm_10}{/if}
                </a>
                            </div>
			<div class="content_box">
                <div class="image">
                   <a href="#" onclick="return Dialog.info({$ID})"><img src="./styles/theme/gow/gebaeude/{$ID}.gif" alt="{$LNG.tech.$ID}"></a>
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
					{foreach $Element.CostRessources as $RessID => $RessAmount}
                   	                        <div class="price res{$RessID} {if $Element.costOverflow[$RessID] == 0}{else}required{/if}">
                        	<div class="ico"></div>
        
							<div class="text">{$RessAmount|number}</div>    
							
                    	</div>
                                  {/foreach}      

                                    
                </div>
				{/if}
                <div class="clear"></div>                
                <div class="time_build"></div>
				{if !$Element.techacc}{else}
                        <form action="game.php?page=conveyors" method="post" class="build_form">
                        <input name="construct" value="{$ID}" type="hidden">
                        <input name="class" value="{$Class}" type="hidden">
                        <div class="btn_build_border btn_build_border_mini_left">
                        	<input class="number_count" max="100" min="1" name="count" value="1" onchange="counting('{$ID}');" type="number">
                        </div>
                        <div class="btn_build_border btn_build_border_mini_right">
                        	<button type="submit" class="btn_build">{$LNG.customm_9}</button>
                        </div>
                    </form>
					{/if}
                            </div>
       	</div>
		{/foreach}
		
		
		</div>
</div>
<script type="text/javascript">
	elementList	= { 
	{foreach $elementLi as $ID => $Element}
	"{$ID}":{ "id":{$ID},"available":"{$Element.available}","SCostRessources":{ {foreach $Element.SCostRessources as $RessID => $RessAmount}"{$RessID}":{$RessAmount}{if !$RessAmount@last},{/if}{/foreach} },"factorClass":{$Element.factorClass},"costRessources":{ {foreach $Element.CostRessources as $RessID => $RessAmount}"{$RessID}":{$RessAmount}{if !$RessAmount@last},{/if}{/foreach} },"costOverflow":{ {foreach $Element.costOverflow as $RessID => $RessAmount}"{$RessID}":{$RessAmount}{if !$RessAmount@last},{/if}{/foreach} },"level":{$Element.level} }{if !$Element@last},{/if} 
	{/foreach} 
};


	
	LNGning			= '{$LNG.bd_remaining}:';
	LNGtech901		= '{$LNG.tech.901}';
	LNGtech902		= '{$LNG.tech.902}';
	LNGtech903		= '{$LNG.tech.903}';
	LNGtech921		= '{$LNG.tech.921}';
</script>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}