{block name="title" prepend}{$LNG.lm_statistics}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:700px;">
    <div class="gray_stripe">
    	{$LNG.lm_statistics}  ({$LNG.st_updated}: {$stat_date}) <font style="float:right">{$LNG.stats_next_upd}: <span style="color:#FC0"><b id="brpstats"> <b><font></font></b></b></span></font>
    </div>
    <form name="stats" id="stats" method="post" action="">
	<table class="tablesorter ally_ranks">
		<tbody><tr>
			<td>
				<label for="who">{$LNG.st_show}</label> 
				<select name="who" id="who" onchange="$('#stats').submit();">{html_options options=$Selectors.who selected=$who}</select>
            </td>
            <td>
				<label for="type">{$LNG.st_per}</label> 
				<select name="type" id="type" onchange="$('#stats').submit();">{html_options options=$Selectors.type selected=$type}</select>
            </td>
            <td>
				<label for="range">{$LNG.st_in_the_positions}</label> 
				<select name="range" id="range" onchange="$('#stats').submit();">{html_options options=$Selectors.range selected=$range}</select>
			</td>
		</tr>
	</tbody></table>
	</form>


{if $who == 1}
	{include file="shared.statistics.playerTable.tpl"}
{elseif $who == 2}
	{include file="shared.statistics.allianceTable.tpl"}
{/if}
  </tbody></table>
    <div class="gray_stripe">
    	<span style="color:#FFDEAD" class="tooltip" data-tooltip-content="<table>
	<tr>
		<th colspan='2'><span style='color:F30'>{$LNG.stat_gamer}</span></th>
	</tr>
		<tr>
		<td style='text-align:left;'>{$LNG.gl_strong_player}</td>
		<td style='text-align:left;'><span style='color:rgba(255, 0, 0, 0.80);'><b>{$LNG.gl_player}</b></span></td>
	</tr>
		<tr>
		<td style='text-align:left;'>{$LNG.gl_week_player}</td>
		<td style='text-align:left;'><span style='color:#309020;'><b>{$LNG.gl_player}</b></span></td>
	</tr>
	<tr>
		<td style='text-align:left;'>{$LNG.stat_freund}</td>
		<td style='text-align:left;'><span style='color:yellow'><b>{$LNG.gl_player}</b></span></td>
	</tr>
	<tr>
		<td style='text-align:left;'>{$LNG.stat_ennemie}</td>
		<td style='text-align:left;'><span style='color:#b27a5f'><b>{$LNG.gl_player}</b></span></td>
	</tr>
	<tr>
		<td style='text-align:left;'>{$LNG.stat_vacation}</td>
		<td style='text-align:left;'><span style='color:rgba(165,81,200,0.80)'><b>{$LNG.gl_player}</b></span></td>
	</tr>
	<tr>
		<td style='text-align:left;'>{$LNG.stat_banned}</td>
		<td style='text-align:left;'><span style='text-decoration:line-through;color:#bbb;'><b>{$LNG.gl_player}</b></span></td>
	</tr>
		<tr>
		<td style='text-align:left;'>{$LNG.gl_inactive_seven}</td>
		<td style='text-align:left;'><span style='color:#ccc;'><b>{$LNG.gl_player}</b></span></td>
	</tr>
		<tr>
		<td style='text-align:left;'>{$LNG.gl_inactive_twentyeight}</td>
		<td style='text-align:left;'><span style='color:#999;'><b>{$LNG.gl_player}</b></span></td>
	</tr>
	<tr>
		<td style='text-align:left;'>Outlaw</td>
		<td style='text-align:left;'><span style='color:#e78912'><b>{$LNG.gl_player}</b> <span style='color:#e78912'>(O)</span></span></td>
	</tr>
	
	<tr>
		<td style='text-align:left; color:#999;' colspan='2'>{$LNG.stat_col_over}</td>
	</tr>
	
	<tr>
		<th colspan='2'>{$LNG.stat_ally}</th>
	</tr>
	<tr>
		<td style='text-align:left;'>{$LNG.stat_union}</td>
		<td style='text-align:left;'><span style='color:#32CD32'><b>{$LNG.lm_alliance}</b></span></td>
	</tr>
	<tr>
		<td style='text-align:left;'>{$LNG.stat_war}</td>
		<td style='text-align:left;'><span style='color:#FF0000'><b>{$LNG.lm_alliance}</b></span></td>
	</tr>
	<tr>
		<td style='text-align:left;'>{$LNG.stat_own_ally}</td>
		<td style='text-align:left;'><span style='color:#33CCFF'><b>{$LNG.lm_alliance}</b></span></td>
	</tr>
</table>">{$LNG.stat_col_dip}</span>
    </div>
</div>
<script type="text/javascript">
	v = new Date();
	var brpstats = document.getElementById('brpstats');
	function tstats(){
		n  = new Date();
		ss = {$nextStatUpdate};
		s  = ss - Math.floor( (n.getTime() - v.getTime()) / 1000);
		m  = 0;
		h  = 0;
		d  = 0;
		if ( s < 0 ) {
			   var zeit = new Date();
			var ende = zeit.getTime();
			ende = ende + 100;
		
			function countdown() {
		
				var zeit2 = new Date();
				var jetzt = zeit2.getTime();
		
				if(jetzt >= ende) {
				   brpstats.innerHTML = '<blink><b><font color=red>...</font></b></blink>';
				}
		
			}
		
			setInterval(countdown, 1000);
		} else 
		{
			   if ( s > 59 ) { m = Math.floor( s / 60 ); s = s - m * 60; }
			   if ( m > 59 ) { h = Math.floor( m / 60 ); m = m - h * 60; }
			   if ( h > 24 ) { d = Math.floor( h / 24 ); h = h - d * 24; }
			   if ( s < 10 ) { s = '0' + s }
			   if ( m < 10 ) { m = '0' + m }
			   if ( h < 10 ) { h = '' + h }
			   if ( s >= 0 ) { s = s + 's' }
			   if ( m > 0 ) { m = m + 'm' }  else m = '';
			   if ( m == 0 && h > 0 ) { m = '0' + m + 'm'}
			   if ( h > 0 ) { h = h + 'h' }  else h = '';
			   if ( d > 0 ) { d = d + 'd' }  else d = '';
		
			   brpstats.innerHTML = ' <b><font>' + d + ' ' + h + ' ' + m + ' ' + s + '</font></b>';
		}
		window.setTimeout('tstats();',999);
	}
	window.onload=tstats();
</script>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}