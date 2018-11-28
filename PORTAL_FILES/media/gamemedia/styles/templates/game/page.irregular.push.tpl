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
	<th colspan="2" style="color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.ls_market_7}</th>
	<th style="color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.ls_market_38}</th>
	<th style="color: #5ca6aa;background: rgba(255,255,255,0.1);">Actions</th>
</tr>


					{foreach $multiData as $messageID => $xb}
					<tr>
					
                    <td class="pseudo" colspan="2">
                            <span class="joueur {$xb.strongest}">{$xb.change_nick}</span>
                            <a onclick="" title="{$LNG.ls_click_3}" class="couleur_alliance">{$xb.nickname_ally}</a>
                    </td>
					{if 100-(100/$xb.totals*$xb.totalNexts) > 15 && $xb.succes == 0}
					<td class="statut">
                        <b><span class="rouge">{$LNG.ls_market_50} :</span></b>
                                  <span class="gris">{$LNG.ls_market_51}.</span>
                    </td>
					{elseif 100-(100/$xb.totals*$xb.totalNexts) < -15 && $xb.succes == 0}
					<td class="statut">
                        <b><span class="rouge">{$LNG.ls_market_50} :</span></b>
                                  <span class="gris">{$LNG.ls_market_51}.</span>
                    </td>
					{else}
					<td class="statut">
                        <span class="vert">{$LNG.ls_market_54}</span>
                    </td>
					{/if}
					
					
                   
					
					
					<td class="actions">
					 <img src="styles/images/iconav/faq.png" onmouseover="montre('{$LNG.ls_market_52}.');" onmouseout="cache();" onclick="location.href='game.php?page=irregular&mode=detail&id={$messageID}';">
						<img src="styles/images/iconav/my_stats.png" onclick="return Dialog.Playercard({$xb.infouser});" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();"
							  />
						<img src="styles/images/iconav/mesages.png" onclick="return Dialog.PM({$xb.infouser});" onmouseover="montre('{$LNG.ls_click_2}');" onmouseout="cache();"
							  /> 
							 
					</td>
                    
					</tr>
{foreachelse}
					<tr><td colspan="3" style="text-align : center;" class="vert">{$LNG.ls_market_40}</td></tr>
					{/foreach}


					</table>
              <div class="listabarrabasso">
    {$LNG.ls_market_39}
 </div></div>
			  
                  <!-- Fin du corps -->
            <div class="espace"></div>
{/block}
