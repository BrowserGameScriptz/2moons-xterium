{block name="title" prepend}{$LNG.market_47}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner market">
    <div class="gray_stripe" style="padding:0;">
    	<a href="#" id="arrow_question" style="left:5px; right:auto;" onclick="return Dialog.manualinfo(12)" class="interrogation manual">?</a>
    	<span style="float:left; margin-left:30px;">{$LNG.market_47}</span>
        <a href="#" class="right_flank button tooltip_sticky" data-tooltip-content="
        	<div class='gr_btn_top_buy'>
        		         
        		<a href='#' onclick='return Dialog.CreateLotUpgrade();'>{$LNG.market_48}</a>           
        		{*<a href='#' onclick='return Dialog.CreateLotPlanet();'>{$LNG.market_49}</a> *}
				<a href='#' onclick='return Dialog.CreateLotItem();'>{$LNG.sell_item_mar}</a>
            </div>
        ">{$LNG.market_53}</a>
        <div class="gr_btn_top">
        	<a style="border-left: 1px rgba(0,0,0,0.8) dashed;" href="game.php?page=market">{$LNG.market_50}</a>         
        	<a style="border-left: 1px rgba(0,0,0,0.8) dashed;" href="game.php?page=market&amp;mode=yourlots">{$LNG.market_51}</a>
       		<a class="active" style="border-left: 1px rgba(0,0,0,0.8) dashed;border-right: 1px rgba(0,0,0,0.8) dashed;" href="game.php?page=market&amp;mode=yourrate">{$LNG.market_52}</a> 
        </div>
    </div>
    <div id="market_conteiner">
         	<h2 style="color:#C30">{$LNG.market_64}</h2>
         </div>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}