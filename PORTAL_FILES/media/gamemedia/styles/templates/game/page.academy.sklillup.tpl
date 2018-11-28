{block name="title" prepend}{$LNG.lm_academy}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner academy_info">
	<div class="gray_stripe">
    	<span class="academy_info_text_h">{$academyTitle}</span> ({$eLevel})
    </div>
    <p class="academy_info_text">
    	<img class="academy_info_img" title="" alt="" src="styles/theme/gow/gebaeude/{$academyId}.jpg">
        <span style="color:#{$plusvar1};">{$plusvar}<span id="ab1">{$ab1}</span>%</span> {$academyAb1} 
		
		{if $ab2 != 0}<br><span style="color:#F90;">-<span id="ab2">{$ab2}</span>%</span> {$academyAb2} {/if}
            </p>
    <div class="clear"></div>
    <div class="gray_stripe academy_info_form" style="padding-right:0;">
        <div class="academy_info_form_padding">
        	<form action="game.php?page=academy" target="_parent" method="post">
                <input type="hidden" name="skill" value="{$academyId}" />                               
                <input class="academy_info_btn" type="submit" name="button" value="{$LNG.academy_39}" />                
                <input class="academy_info_lvlup" onchange="calculation();" id="count" type="number" pattern="[0-9]*" size="3" name="count" min="{$eLevel+1}" value="{$eLevel+1}" onKeyDown="if(this.value.length==3) return false;" onKeyUp="if(this.value.length==3) return false;"/> 
                <label style="float:right;">{$LNG.academy_40}</label>
                <label class="academy_info_cost">{$LNG.academy_41} <span id="cost" style="color:#0C3;">{$ucost}</span> {$LNG.academy_42}</label>
        	</form>
        </div>
    </div>
</div>
<script type="text/javascript">
	var ELevel 	= {$eLevel};
	var ab1 	= {$ab1};
	var ab2 	= {$ab2};
	var Icost 	= {$icost};	
	var point 	= {$uPoints};
	var factor 	= {$ufactor};
</script>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        <!--/body-->
		{/block}