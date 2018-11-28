{block name="title" prepend}{$LNG.lm_arsenal}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="build_content" class="conteiner">
    <div class="gray_stripe">
    	{$LNG.tech.800}  
      <div class="gr_btn_top" style="margin-top: -27px;margin-left:40px">
        	<a href="game.php?page=market" style="border-left: 1px rgba(0,0,0,0.8) dashed;">{$LNG.academy_2}</a>        
        	<a href="#" style="border-left: 1px rgba(0,0,0,0.8) dashed;border-right: 1px rgba(0,0,0,0.8) dashed;"onclick="return Dialog.CreateLotUpgrade();">{$LNG.market_53}</a>
       		
        </div>
		
        <a href="#" onclick="return Dialog.manualinfo(10);" class="interrogation manual">?</a>
	</div>
    <div id="build_elements" class="upgrade_list">
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
			  
			  {foreach $ArsenalList as $ID => $Element}
		    	<div class="build_box">
            <div class="head">
            	{$LNG.tech.$ID} {if $Element.level > 0}[{$Element.level|number}/{$maxArsenal|number}]{/if} 
            </div>
       		<div class="content_box">
                <div class="image">
                   <img src="./styles/theme/gow/gebaeude/up/{$Element.CustomVar}.jpg" alt="{$LNG.tech.$ID}">
                </div>
                <div class="prices">
                	<div class="price">
                		{$LNG.lm_bonu}: <span style="color:#0C0;">+{$Element.bonusLevel}%</span> <sup>(+{$Element.arsenal_bonus}%)</sup>
                    </div>
                    <div class="price">
                    	{$LNG.top_avaibel}: <span style="color:#F90;">{$Element.avaible|number}</span>          
                    </div>  
					{if $Element.avaible > 0}
                     <input name="greid" value="{$Element.CustomVar}" type="hidden">                        
                     <div class="btn_build_border btn_build_border_right"> 
						<input class="ar_count" min="0" max="50" name="count_{$Element.CustomVar}" value="0" type="number">
                        <input id="submitArsenal_{$Element.CustomVar}" value="{$LNG.customm_31}" onclick="arsenalSend('{$Element.CustomVar}');return false;" class="input_btn ar_input_btn tooltip" data-tooltip-content="<span style='color:#3DC738'>{$LNG.customm_32}: {$Element.chance}%</span>" style="width: 100% !important;padding-left: 61px;" type="submit" name="submitArsenal">
                     </div>
					{/if}
					
               		                          
                </div>
          	</div>
        </div>
		{/foreach}
		
<script type="text/javascript">
var ctrlKeyDown = false;

$(document).ready(function(){    
    $(document).on("keydown", keydown);
    $(document).on("keyup", keyup);
});

function keydown(e) { 

    if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
        // Pressing F5 or Ctrl+R
        e.preventDefault();
    } else if ((e.which || e.keyCode) == 17) {
        // Pressing  only Ctrl
        ctrlKeyDown = true;
    }
};

function keyup(e){
    // Key up Ctrl
    if ((e.which || e.keyCode) == 17) 
        ctrlKeyDown = false;
};

</script>
		    	<div class="clear"></div>
    </div>
</div>
</div>
</div>
            <div class="clear"></div>   

            </div>         
        </div><!--/body-->

{/block}
