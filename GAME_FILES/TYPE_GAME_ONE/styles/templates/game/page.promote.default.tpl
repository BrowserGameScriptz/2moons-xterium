{block name="title" prepend}{$LNG.promo__1}{/block}{block name="content"}
<div id="page">
  <div id="content">
<div id="ally_content" class="conteiner">
  <div class="gray_stripe">{$LNG.promo__1}</div>
  <table class="tablesorter ally_ranks gray_stripe_th td_border_bottom">
    <tbody> 
	  <tr>
	    <td colspan="4">
		{$LNG.promo__3}
        </td>
      </tr>
	  <tr>
	    <th class="gray_stripe_th">{$LNG.promo__5}</th>
		<th class="gray_stripe_th">{$LNG.promo__6}</th>
		<th class="gray_stripe_th">{$LNG.promo__7}</th>
		<th class="gray_stripe_th"></th>
	  </tr>
	
	  
	  {foreach $voteSystem as $ID => $vote}
                <tr> 
				   <td style="width:20%;border-left: none;"><img src="{$vote.image}"></td>
                    <td style="width:20%;">1.000.000 DM AND 1.000 AM</td>
					<td style="width:25%;">{$LNG.promo__7} 12 {$LNG.fl_hours}</td>
					<td style="width:35%;">
		  {$vote.link}
		</td>
                 </tr>
                {/foreach}
				  {if $displayadsmd == 1}<tr> 
				   <td colspan="4">
		 
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- War Of Galaxyz #Game -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2369063859511778"
     data-ad-slot="3349807407"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
		</td>
                </tr>{/if}
				
				
    </tbody>
  </table>
    </div>
  </div>
</div>
<div class="clear">
</div>
</div>
{/block}