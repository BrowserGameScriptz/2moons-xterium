{block name="title" prepend}Resource Refund{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
        Resource Refund Tool
    </div>    
	
	<table class="tablesorter ally_ranks">
            <tbody><tr>
	<th style="color: #5ca6aa;background: rgba(255,255,255,0.1);">Ticket ID</th>
	<th colspan="2" style="color: #5ca6aa;background: rgba(255,255,255,0.1);">Status</th>
	<th style="color: #5ca6aa;background: rgba(255,255,255,0.1);">Summary</th>
	<th style="color: #5ca6aa;background: rgba(255,255,255,0.1);">Action</th>
</tr>


				<tr class="normal">
				{foreach $multiData as $messageID => $xb}
				<tr class="normal">
					  <td class="date_echange">
                          <a href="game.php?page=ticket&mode=view&id={$xb.ticketId}">#{$xb.ticketId}</a>
                      </td>
                      <td class="statut" colspan="2">
                          <span class="badge_commerce {$xb.status}" style="padding-top:0;">{$xb.statusbis}</span>
                      </td>
                      <td class="valeur_echange">
                          <span class="couleur_theme">{$xb.summary}</span> 
                          <span style="font-size : 0.9em;">{$LNG.lm_achat_units}</span>
                      </td>
                      <td class="actions">
						  {if $xb.claimed == 0}<a href="game.php?page=easyres&action=claim&id={$messageID}" class="tooltip fl_groop_link_del" data-tooltip-content="Click to claim back your resource." style="color: green;border-left: solid 1px #000;">v</a>{/if}
						  <a onclick="javascript:Commerce.afficherDetailEchange('{$messageID}');" class="tooltip fl_groop_link_del" data-tooltip-content="Click here to see the details of the resource lost." style="color: green;border-left: solid 1px #000;"><img src="styles/images/ico/aide.png"></a>
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
				<td colspan="5" style="text-align : center;" class="vert">You don't have actually any lost resource ticket approuved be the administrators</td>
				{/foreach}
				
				</tr>  </table></div>
          </div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}
