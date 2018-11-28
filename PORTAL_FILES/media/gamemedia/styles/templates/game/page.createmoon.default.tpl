{block name="title" prepend}{$LNG.moon_title}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
	<div class="gray_stripe">
		{$LNG.moon_title}
	</div>
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
	<div class="left_part">
		<div class="gray_stripe">
			{$LNG.moon_value}
		</div>
		
		<div class="ally_contents">
			<ul>
									<li {if $userAm < 20000}class="tooltip" data-tooltip-content="{$LNG.moon_notenough} {(20000-$antimatter)|number}"{/if}>{$LNG.tech.922}: <span style="color:{if $userAm >= 20000}lime{else}red{/if}">20.000</span> АМ</li>
							</ul>
		</div>
	</div>
	
	<div class="right_part">
		<div class="gray_stripe">
			{$LNG.moon_value}:
		</div>
		<div class="ally_contents">
			
			<ul>
									<li {if $userDm < 4000000}class="tooltip" data-tooltip-content="{$LNG.moon_notenough} {(4000000-$darkmatter)|number}"{/if}>{$LNG.tech.921}: <span style="color:{if $userDm >= 4000000}lime{else}red{/if}">4.000.000</span> {$LNG.moon_dm_short}</li>
							</ul>
		</div>
	</div>

	<div class="ally_contents sepor_conten development_row"> 
		<div class="clear"></div>
	</div>
	<div class="ally_contents sepor_conten development_row">
		<div class="clear"></div>
		<div class="development_text">{$LNG.moon_am}</div>
		{if $userAm >= 20000}
		<div class="btn_border right_flank">
			<form action="game.php?page=createMoon" method="POST">
				<input name="mode" value="BuyMoon" type="hidden">
				<input name="cost_type" value="922" type="hidden">
				<input value="{$LNG.moon_crea}" class="tooltip" data-tooltip-content="{$LNG.moon_value}: 20.000 AM" type="submit">
			</form>
		</div>
		{else}
		<div class="right_flank" style="color:red">{$LNG.moon_nofirst}</div>	
{/if}			
		<div class="clear"></div>
	</div>
	
	<div class="ally_contents sepor_conten development_row">
		<div class="development_text">{$LNG.moon_dm}</div>
		
		{if $userDm >= 4000000}
		<div class="btn_border right_flank">
			<form action="game.php?page=createMoon" method="POST">
				<input name="mode" value="BuyMoon" type="hidden">
				<input name="cost_type" value="921" type="hidden">
				<input value="{$LNG.moon_crea}" class="tooltip" data-tooltip-content="{$LNG.moon_value}: 4.000.000 {$LNG.moon_dm_short}" type="submit">
			</form>
		</div>
		{else}
		
				<div class="right_flank" style="color:red">{$LNG.moon_nosecond}</div>
			{/if}	
		<div class="clear"></div>
	</div>

</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}