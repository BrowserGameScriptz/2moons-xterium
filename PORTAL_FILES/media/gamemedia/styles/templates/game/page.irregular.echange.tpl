{block name="title" prepend}{$LNG.ls_market_1}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
        Anti Push
		<span style="float:right">[<a href="game.php?page=auctioneer&amp;mode=inventory" title="{$LNG.auctioneer_26}">{$LNG.auctioneer_25}</a>]</span>    
    </div>    
	
	<table class="tablesorter ally_ranks">
            <tbody><tr>
	<th colspan="2" style="color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.ls_achivement_7}</th>
	<th style="color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.ls_market_7}</th>
	<th style="color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.lm_redeem_14}</th>
	<th style="color: #5ca6aa;background: rgba(255,255,255,0.1);">{$LNG.ls_market_33}</th>
</tr>


				<tr class="normal">
				{foreach $multiData as $messageID => $xb}
				<tr class="normal">
                      <td class="statut">
                          <span class="badge_commerce {$xb.status}">{$xb.statusbis}</span>
                      </td>
                      <td class="pseudo">
                            <span class="joueur {$xb.strongest}">{$xb.change_nick}</span>
                            <a onclick="" title="{$LNG.ls_click_3}" class="couleur_alliance">{$xb.nickname_ally}</a>
                      </td>
                      <td class="date_echange">
                          {$xb.timeoftransport}
                      </td>
                      <td class="valeur_echange">
                          <span class="couleur_theme">{$xb.push}</span> 
                          <span style="font-size : 0.9em;">{$LNG.lm_achat_units}</span>
                      </td>
                      <td class="actions">
                          <img src="styles/images/ico/aide.png" onmouseover="montre('Cliquez ici, pour afficher le détail de cet échange.');" onmouseout="cache();" onclick="javascript:Commerce.afficherDetailEchange('{$messageID}');">
                      </td>
                    </tr>
                    <tr id="detail_echange_{$messageID}" class="detail_echange no_display">
                      <td colspan="5"> <div class="item_echange">
                          <h3>{$LNG.lm_resources} :</h3>{if $xb.metal != 0}- {$LNG.tech.901} : <span class="couleur_theme">{$xb.metal}</span><br>{/if}{if $xb.crystal != 0}- {$LNG.tech.902} : <span class="couleur_theme">{$xb.crystal}</span><br>{/if}{if $xb.deuterium != 0}- {$LNG.tech.903} : <span class="couleur_theme">{$xb.deuterium}</span><br>{/if}
						  
						  {if $xb.metal == 0 && $xb.crystal == 0 && $xb.deuterium == 0 && $xb.elyrium == 0}
						  <i>Aucune resources</i>{/if}
						  </div> 
                       
                        </td>
                    </tr>
				{foreachelse}
				<td colspan="5" style="text-align : center;" class="vert">{$LNG.ls_market_34}</td>
				{/foreach}
				
				</tr>  </table></div>
          <div class="legende_commerce gris">
              <b>{$LNG.lm_title_6} :</b><br />
              - {$LNG.ls_market_35}<br /> 
              - {$LNG.ls_market_36}
          </div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}
