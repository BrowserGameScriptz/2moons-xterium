{block name="title" prepend}{$LNG.allian_1}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
    	<a href="game.php?page=alliance&amp;mode=storage" style="color:#8e9394;">{$LNG.allian_1}</a>
        <img src="styles/images/arrow_right.png" alt="">
    	{$LNG.allian_8}
		
			<span style="float:right"><a href="game.php?page=alliance&amp;mode=storage">{$LNG.al_back}</a></span>
	</div>
    <form id="trader" action="game.php?page=alliance" method="post">
        <input name="mode" value="vlyatsend" type="hidden">
       <div class="ally_contents sepor_conten res_901">
            <div class="res_ico"></div>
            <div class="res_text">{$LNG.tech.901}:</div>
            <div class="res_count"><input name="resource901" id="resource901" class="trade_input" value="0" size="30" type="text" style="width:90%;">
			<a href="#" id="arrow_question" style="left:5px; right:auto;" class="interrogation tooltip" data-tooltip-content="You can widraw at maximum {$metalDep|number} units of metal">?</a>
			</div>
			
            <div class="clear"></div>
        </div>
        <div class="ally_contents sepor_conten res_902">
            <div class="res_ico"></div>
            <div class="res_text">{$LNG.tech.902}:</div>
            <div class="res_count"><input name="resource902" id="resource902" class="trade_input" value="0" size="30" type="text" style="width:90%;">
			<a href="#" id="arrow_question" style="left:5px; right:auto;" class="interrogation tooltip" data-tooltip-content="You can widraw at maximum {$crystalDep|number} units of crystal">?</a>
			</div>
            <div class="clear"></div>
        </div>
        <div class="ally_contents sepor_conten res_903">
            <div class="res_ico"></div>
            <div class="res_text">{$LNG.tech.903}:</div>
            <div class="res_count"><input name="resource903" id="resource903" class="trade_input" value="0" size="30" type="text" style="width:90%;">
			<a href="#" id="arrow_question" style="left:5px; right:auto;" class="interrogation tooltip" data-tooltip-content="You can widraw at maximum {$deuteDep|number} units of deuterium">?</a>
			</div>
            <div class="clear"></div>
        </div>
        <div class="ally_contents" style="padding:10px;">
        	<div style="float:left; margin-left:22px; line-height:18px;">
        		<div class="res_text">{$LNG.allian_7}:</div>
        		<div class="res_count" style="width:auto;">{$cost|number}</div>
                <div class="clear"></div>
                <div class="res_text">{$LNG.allian_6}:</div>
        		<div class="res_count" style="width:auto;"><span id="ress">0</span></div>
            </div>       
            <div class="btn_border right_flank">
                <input value="ОК" type="submit">
            </div>
            <div class="clear"></div>
        </div>
    </form>
</div>

</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script" append}
<script type="text/javascript">
var ress1charge = 1;
var ress2charge = 1;
var ress3charge = 1;
</script>
{/block}
