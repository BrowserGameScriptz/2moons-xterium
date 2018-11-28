{block name="title" prepend}Anti Push{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
        Anti Push
    </div>    
	
	<table class="tablesorter ally_ranks">
            <tbody><tr>
	<th colspan="2" style="color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.ls_market_42}</th>
	<th style="color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.ls_market_43}</th>
	<th style="color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.ls_market_44}</th>
</tr>
<tr>
                              <td colspan="2" class="date_transaction">
                                  <b>{$LNG.ls_market_45}</b> {$times}<br>
                                  <b>{$LNG.ls_market_46}</b> {$times2} 
			
                                  
                              </td>
                              <td class="information_transaction">
                                  <span class="{$strongest}">{$myUsername}</span> 
                                  {$LNG.ls_market_47} <span class="orange">{$total}</span> {$LNG.lm_achat_units}.<br>
                                  <span class="{$strongestbis} ">{$otherUsername}</span> 
                                  {$LNG.ls_market_47} <span class="orange">{$totalNext}</span> {$LNG.lm_achat_units}.
                              </td>
                              <td class="taux_transaction">
                                  <span class="gris">{$LNG.ls_market_44} : {pretty_number(100-(100/$totals*$totalNexts))} %</span><br>
                                  <span class="{if 100-(100/$totals*$totalNexts) > 15 && $succes == 0}rouge{elseif 100-(100/$totals*$totalNexts) < -15 && $succes == 0}rouge{else}vert{/if}">{if 100-(100/$totals*$totalNexts) > 15 && $succes == 0}{$LNG.ls_market_48}{elseif 100-(100/$totals*$totalNexts) < -15 && $succes == 0}{$LNG.ls_market_48}{else}{$LNG.ls_market_53}{/if}.</span>
                              </td>
                            </tr></tbody></table>
             <div class="listabarrabasso">
    {$LNG.ls_market_39}
 </div> </div> 
			  	
</div></div>      
{/block}

