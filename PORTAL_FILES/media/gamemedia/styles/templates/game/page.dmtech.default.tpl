{block name="title" prepend}{$LNG.lm_research}{/block}
{block name="content"}
<div id="page">
	<div id="content">

<div id="build_content" class="conteiner">
    <div id="fildes_band">
    	<a href="#" id="arrow_question" style="left:5px; right:auto;" onclick="return Dialog.manualinfo(2)" class="interrogation manual">?</a>
		<a href="game.php?page=Resourcecalc" title="Calculator" class="palanetarium_linck calculette" style="left:30px;top: 5px;width: 17px;height: 16px;"></a>
       	<a class="bd_dm_buy" href="game.php?page=research">{$LNG.customm_25}</a>
    </div>   
	
	
	
	
	
    <div id="build_elements">
	
	{foreach $ResearchList as $ID => $Element}
    			<div id="research_{$ID}" class="build_box {if !$Element.techacc}required{/if}">
            <div class="head">
                <a href="#" onclick="return Dialog.info({$ID})" class="interrogation">?</a>                
                <a href="#" onclick="return Dialog.info({$ID})" class="title">
                	{$LNG.tech.{$ID}} {if $Element.level > 0} ({$LNG.bd_lvl} {$Element.level}{if $Element.maxLevel != 255}/{$Element.maxLevel}{/if}){/if}                </a>
            </div>
                        <div class="content_box">
                <div class="image">
                   <a href="#" onclick="return Dialog.info({$ID})"><img src="./styles/theme/gow/gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}" /></a>
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
        
							<div class="text">{$RessAmount|number}</div>    
							
                    	</div>
                                  {/foreach}      
								  
				
                                                                                                 <div class="price">
                      {if !empty($Element.infoEnergy)}
							
							{$Element.infoEnergy}<br>
						{/if}                           
                    </div>
                                    
                </div>
				
				{/if}
                <div class="clear"></div>
                
                <div class="time_build">
                     {if !$Element.techacc}{elseif $Element.elementTime == 0}{else}
                     {$LNG.fgf_time}: <span class="time_build_text"> {$Element.elementTime|time} </span> 
					 {/if}
                </div>
                
                
						
				
				
				
                               
            {if !$Element.techacc}{elseif $Element.maxLevel == $Element.levelToBuild}
			<div class="btn_build_border">	  
						<span class="btn_build red">{$LNG.bd_maxlevel}</span>
						</div>
					{elseif $IsLabinBuild || $IsFullQueue}
					<div class="btn_build_border">	  
						<span class="btn_build red">{if $Element.level == 0}{$LNG.bd_tech}{else}{$LNG.bd_tech_next_level}{$Element.levelToBuild + 1}{/if}</span>
						</div>
					{elseif !$Element.buyable}
					<div class="btn_build_border">	  
						<span class="btn_build red">{$LNG.build_nores}</span>
						</div>
					{else} 
  					
							
<div class="btn_build_border">	  
		<form action="game.php?page=dmtech" method="post" class="build_form">
								<input type="hidden" name="cmd" value="insert">
								<input type="hidden" name="tech" value="{$ID}">       
								<input type="hidden" value="{$Element.level}" name="lvlup1"></input>								

                                <button class="btn_build_part_left" type="submit" style="padding:0;text-align:center">{$LNG.bd_build_next_level} {$Element.levelToBuild + 1}</button>                                
							</form>
							</div>
							
						
							
																	{/if}   <div class="clear"></div>        
            </div>
                    </div>
			{/foreach}
			
	    <div class="clear"></div>
    </div>
              
   
           
</div><!--/build-->

<script type="text/javascript">
	DatatList		= {
	{foreach $ResearchList as $ID => $Element}
	"{$ID}":{ "id":"{$ID}","level":"{$Element.level}","maxLevel":"{$Element.maxLevel}","factor":"{$Element.factor}","costRessources":{ {foreach $Element.costResources as $RessID => $RessAmount}"{$RessID}":{$RessAmount}{if !$RessAmount@last},{/if}{/foreach} },"costOverflow":{ {foreach $Element.costOverflow as $RessID => $RessAmount}"{$RessID}":{$RessAmount}{if !$RessAmount@last},{/if}{/foreach} },"elementTime":{$Element.elementTime},"buyable":{$Element.buyable} }{if !$Element@last},{/if}
	{/foreach}
	
	};
	
	
	
	bd_operating	= '({$LNG.bd_working})';
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
