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
        		<a href='#' onclick='return Dialog.CreateLotPlanet();'>{$LNG.market_49}</a>
				<a href='#' onclick='return Dialog.CreateLotItem();'>{$LNG.sell_item_mar}</a> 
            </div>
        ">{$LNG.market_53}</a>
        <div class="gr_btn_top">
        	<a style="border-left: 1px rgba(0,0,0,0.8) dashed;" href="game.php?page=market">{$LNG.market_50}</a>         
        	<a class="active" style="border-left: 1px rgba(0,0,0,0.8) dashed;" href="game.php?page=market&amp;mode=yourlots">{$LNG.market_51}</a>
       		<a style="border-left: 1px rgba(0,0,0,0.8) dashed;border-right: 1px rgba(0,0,0,0.8) dashed;" href="game.php?page=market&amp;mode=yourrate">{$LNG.market_52}</a> 
        </div>
    </div>
    <div id="market_conteiner">
        	{if $upgradeCount > 0}   
 <br>     
     	<h2>{$LNG.market_80}:</h2>
		<table class="tablesorter ally_ranks lots">
        <tbody><tr>
        	<th class="gray_stripe" style="width:10px;">&nbsp;</th> 
            <th class="gray_stripe">&nbsp;</th> 
            <th class="gray_stripe">{$LNG.manual_5_33}</th>  
            <th class="gray_stripe">{$LNG.market_25}</th> 
            <th class="gray_stripe">{$LNG.market_61}</th> 
            <th class="gray_stripe" style="width:10px;">&nbsp;</th>
        </tr>
			{foreach $soldUpgradeList as $ID => $Element}
                <tr>
        	<td>{$ID}</td> 
            <td>{$Element.upgradeName}</td> 
            <td>{$Element.upgradeCount}</td>  
            <td>{$Element.upgradePrice}</td>  
            <td>{$Element.upgradeTime}</td> 
            <td>
            	<a href="game.php?page=market&amp;mode=delupgradelots&amp;id={$ID}" onclick="return confirm('{$Element.upgradeMessage}');">
                	<img src="styles/images/false.png" alt="" height="16" width="16">
                </a>
            </td>  
        </tr>
			{/foreach}
                </tbody></table>             
                {/if}
				{if $itemCount > 0}   
 <br>     
     	<h2>{$LNG.market_80}:</h2>
		<table class="tablesorter ally_ranks lots">
        <tbody><tr>
        	<th class="gray_stripe" style="width:10px;">&nbsp;</th> 
            <th class="gray_stripe">&nbsp;</th> 
            <th class="gray_stripe">{$LNG.manual_5_33}</th>  
            <th class="gray_stripe">{$LNG.market_25}</th> 
            <th class="gray_stripe">{$LNG.market_61}</th> 
            <th class="gray_stripe" style="width:10px;">&nbsp;</th>
        </tr>
			{foreach $solditemList as $ID => $Element}
                <tr>
        	<td>{$ID}</td> 
            <td>{$Element.upgradeName}</td> 
            <td>{$Element.upgradeCount}</td>  
            <td>{$Element.upgradePrice}</td>  
            <td>{$Element.upgradeTime}</td> 
            <td>
            	<a href="game.php?page=market&amp;mode=delitemlots&amp;id={$ID}" onclick="return confirm('{$Element.upgradeMessage}');">
                	<img src="styles/images/false.png" alt="" height="16" width="16">
                </a>
            </td>  
        </tr>
			{/foreach}
                </tbody></table>             
                {/if}
			
         {if $planetCount > 0}
        <br>
     	<h2>{$LNG.market_60}:</h2>
		<table class="tablesorter ally_ranks lots">
        <tbody><tr>
        	<th class="gray_stripe">&nbsp;</th> 
            <th class="gray_stripe">&nbsp;</th> 
            <th class="gray_stripe">&nbsp;</th>              
            <th class="gray_stripe">{$LNG.market_61}</th> 
            <th class="gray_stripe">{$LNG.market_62}</th>
            <th class="gray_stripe">{$LNG.market_63}</th> 
        </tr>
		{foreach $soldPlanetList as $ID => $Element}
                <tr>
        	<td>№ {$ID}</td> 
            <td><a href="#" onclick="return Dialog.PlanetLotInfo('{$Element.planetID}');"><img src="styles/images/iconav/over.png" alt="{$LNG.market_66}"></a></td> 
            <td>{if $Element.moonId != 0}<a href="#" onclick="return Dialog.PlanetLotInfo({$Element.moonId});" title="{$LNG.market_68}"><img src="styles/images/iconav/moon.png" alt="{$LNG.market_68}"></a>{/if}</td>              
            <td>{$Element.time}</td> 
            <td>{$Element.timeLeft} </td>
            <td>{$Element.price}</td> 
        </tr>					   
               {/foreach}
                </tbody></table>
				{else}
				<h2 style="color:#C30">{$LNG.market_65}.</h2>
				{/if}
				
                 </div>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}