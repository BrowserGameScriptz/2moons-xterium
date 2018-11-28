{block name="title" prepend}{$LNG.offi_2}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="padding-right:0;">
       {$LNG.offi_2}<a href="game.php?page=gubernators"><input class="right_flank input_blue" value="{$LNG.offi_1}" type="button"></a>                
    </div> 
	<div id="build_elements" class="officier_elements" style="padding-top:10px; padding-bottom:5px;">
	    
    	
		{foreach $officierList as $ID => $Element}
		<div id="ofic_{$ID}" class="build_box {if !$Element.techacc}required{/if}">
            <div class="head">
                <a href="#" onclick="return Dialog.info({$ID})" class="interrogation">?</a>                
                <a href="#" onclick="return Dialog.info({$ID})">{$LNG.tech.{$ID}}</a> 
                ({$LNG.of_lvl} {$Element.level}/{$Element.maxLevel})
            </div>
                        <div class="content_box">
                <div class="image">
                   <a href="#" onclick="return Dialog.info({$ID})"><img src="{$dpath}gebaeude/{$ID}.jpg" alt="{$LNG.tech.{$ID}}"></a>
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
                	<p>{$LNG.shortDescription.{$ID}}
  <br><br>

  {foreach $Element.elementBonus as $BonusName => $Bonus}<font color="#393">{if $Bonus[0] < 0}-{else}+{/if}{if $Bonus[1] == 0}{abs($Bonus[0] * 100)}%{else}{floatval($Bonus[0])}{/if}</font> {$LNG.bonus.$BonusName}<br>{/foreach}
  {if $ID == 604}{$LNG.ally_antimatte_11}<br>{/if}
  {if $ID == 608}{$LNG.ally_antimatte_12}<br>{/if}
  </p>
                </div>
				
                <div class="clear"></div>
                
                <div class="time_build">
                    
                </div>
				
                {if $Element.maxLevel <= $Element.level}
				<div class="btn_build_border">
                	                        <span class="btn_build red">
                        	{$LNG.bd_maxlevel}
                        </span>
					                </div>
									
						{elseif $Element.buyable}
							<div class="btn_build_border">
                	         <form action="game.php?page=officier" method="post" class="build_form">
                            <input name="id" value="{$ID}" type="hidden">
                            <button type="submit" class="btn_build">{$LNG.of_recruit}: {foreach $Element.costResources as $RessID => $RessAmount}{$LNG.tech.{$RessID}} <span style="color:lime">{$RessAmount|number}</span>{/foreach}</button>
                        </form>
					                </div>
						{else}
							<div class="btn_build_border">
                	                        <span class="btn_build red tooltip_sticky" data-tooltip-content="<a href='game.php?page=trader&amp;mode=obmen'>{$LNG.top_exchange}</a>">
                        	{$LNG.of_recruit}: {foreach $Element.costResources as $RessID => $RessAmount}{$LNG.tech.{$RessID}} <span style="color:red">{$RessAmount|number}</span>{/foreach}
                        </span>
					                </div>
						{/if}     

{/if}
						
                
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
                        <div class="clear"></div>
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
{block name="script"}
<script src="scripts/game/officier.js"></script>
{/block}