{if $bodyclass != "popup" && $tutorial == 0}
	<script type="text/javascript">
	$(function() {
	Dialog.manualinfo(0);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 1}
	<script type="text/javascript">
	$(function() {
	$('#res_nav').append('<span class=\'flashing_bg\'></span> ');
	qtips_wide('#res_nav', '<span class="trn_title">{$LNG.tutorial_step_1}</span><ul class="trn_ul">	<li><span class="trn_text_bold_vinous">{$LNG.tech.901}</span>, <span class="trn_text_bold_vinous">{$LNG.tech.902}</span> {$LNG.tutorial_step_and} <span class="trn_text_bold_vinous">{$LNG.tech.903}</span> {$LNG.tutorial_res_normal}</li>	<li><span class="trn_text_bold_vinous">{$LNG.tech.911}</span> – {$LNG.tutorial_res_energy}</li>	<li>		<span class="trn_text_bold_vinous">{$LNG.tech.921}</span> – {$LNG.tutorial_res_darkmatter}	</li>	<li><span class="trn_text_bold_vinous">{$LNG.tech.922}</span> – {$LNG.tutorial_res_antimatter}</li></ul>', 'bottomMiddle', 'topMiddle', 975);
	setTimeout(function() { $('#munu_build').append('<span class=\'flashing_bg\'></span>') }, 8000);
	setTimeout(function() { qtips('#munu_build', '{$LNG.tutorial_build}', 'bottomMiddle', 'topRight') }, 8000);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 2 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 3 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 4 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 5 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 6 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 7 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 8 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 9 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 10 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 22 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 23 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 32 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 33 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 34 && $queryString != "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$('#munu_build').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_build ', '{$LNG.tutorial_build}', 'bottomMiddle', 'topRight');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 2 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_1" ).show();
	$( "#build_2" ).show();
	$( "#build_3" ).show();
	$( "#build_4" ).show();
	qtips('#build_4 .btn_build_part_left ', '{$LNG.tutorial_improve_solar}', 'bottomMiddle', 'topMiddle');
	$('#build_4').append('<span class=\'flashing_bg\'></span> ');
	qtip_modal('{$LNG.tutorial_require_solar}', '{$LNG.tutorial_lack_solar}<br /> <br /> <br /> <ul class="trn_ul">	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/4.gif" alt="{$LNG.tech.4}">{$LNG.tutorial_up_solar}</li></ul>', '{$LNG.tutorial_close_info}', 450);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 3 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_1" ).show();
	$( "#build_2" ).show();
	$( "#build_3" ).show();
	$( "#build_4" ).show();
	qtips('#build_4 .btn_build_part_left ', '{$LNG.tutorial_improve_solar}', 'bottomMiddle', 'topMiddle');
	$('#build_4').append('<span class=\'flashing_bg\'></span> ');
	qtip_modal('{$LNG.tutorial_require_solar}', '{$LNG.tutorial_lack_solar}<br /> <br /> <br /> <ul class="trn_ul">	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/4.gif" alt="{$LNG.tech.4}">{$LNG.tutorial_up_solar}</li></ul>', '{$LNG.tutorial_close_info}', 450);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 4 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_1" ).show();
	$( "#build_2" ).show();
	$( "#build_3" ).show();
	$( "#build_4" ).show();
	qtips('#build_4 .btn_build_part_left ', '{$LNG.tutorial_metal_9}', 'bottomMiddle', 'topMiddle');
	$('#build_4').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 5 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_1" ).show();
	$( "#build_2" ).show();
	$( "#build_3" ).show();
	$( "#build_4" ).show();
	qtip_modal('{$LNG.tutorial_metal}', '<p>{$LNG.tutorial_metal_1}</p><p>{$LNG.tutorial_metal_2}</p> <br /><br /> <ul class="trn_ul">	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/1.gif" alt="{$LNG.tech.1}">{$LNG.tutorial_metal_3}: &laquo;{$LNG.tech.1}&raquo; {$LNG.tutorial_metal_7}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/2.gif" alt="{$LNG.tech.2}">{$LNG.tutorial_metal_3}: &laquo;{$LNG.tech.2}&raquo; {$LNG.tutorial_metal_8}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/3.gif" alt="{$LNG.tech.3}">{$LNG.tutorial_metal_3}: &laquo;{$LNG.tech.3}&raquo; {$LNG.tutorial_metal_9}.</li></ul>', '{$LNG.tutorial_close_info}', 550);
	qtips('#build_1 .btn_build_part_left ', '{$LNG.tutorial_metal_7}', 'bottomMiddle', 'topMiddle');
	$('#build_1').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 6 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_1" ).show();
	$( "#build_2" ).show();
	$( "#build_3" ).show();
	$( "#build_4" ).show();
	qtips('#build_1 .btn_build_part_left ', '{$LNG.tutorial_metal_7}', 'bottomMiddle', 'topMiddle');
	$('#build_1').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 7 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_1" ).show();
	$( "#build_2" ).show();
	$( "#build_3" ).show();
	$( "#build_4" ).show();
	qtips('#build_2 .btn_build_part_left ', '{$LNG.tutorial_metal_8}', 'bottomMiddle', 'topMiddle');
	$('#build_2').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 8 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_1" ).show();
	$( "#build_2" ).show();
	$( "#build_3" ).show();
	$( "#build_4" ).show();
	qtips('#build_3 .btn_build_part_left ', '{$LNG.tutorial_metal_9}', 'bottomMiddle', 'topMiddle');
	$('#build_3').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 9 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_1" ).show();
	$( "#build_2" ).show();
	$( "#build_3" ).show();
	$( "#build_4" ).show();
	qtips('#build_4 .btn_build_part_left ', '{$LNG.tutorial_metal_10}', 'bottomMiddle', 'topMiddle');
	$('#build_4').append('<span class=\'flashing_bg\'></span> ');
	qtips('#res_block_energy .stock_text ', '{$LNG.tutorial_metal_11}', 'bottomMiddle', 'topLeft');
	qtip_modal('{$LNG.tutorial_metal_63}', '<p>{$LNG.tutorial_metal_13}</p><p>{$LNG.tutorial_metal_65}</p><p>{$LNG.tutorial_metal_66}</p> <br /><br /><ul class="trn_ul">	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/4.gif" alt="{$LNG.tech.4}">{$LNG.tutorial_metal_3}: &laquo;{$LNG.tech.4}&raquo; {$LNG.tutorial_metal_14}.</li></ul>', '{$LNG.tutorial_close_info}', 550);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 10 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_1" ).show();
	$( "#build_2" ).show();
	$( "#build_3" ).show();
	$( "#build_4" ).show();
	qtips('#build_4 .btn_build_part_left ', '{$LNG.tutorial_metal_10}', 'bottomMiddle', 'topMiddle');
	$('#build_4').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 11 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_1" ).show();
	$( "#build_2" ).show();
	$( "#build_3" ).show();
	$( "#build_4" ).show();
	if($("div").is("#fool_conteiner"))setTimeout(function() { location.reload(); }, 10000);
	qtip_modal('{$LNG.tutorial_metal_15}!', '{$LNG.tutorial_metal_16}</span></p>', '{$LNG.tutorial_close_info}', 450);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 12 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	qtips('#espionage ', '{$LNG.tutorial_metal_18}','bottomMiddle', 'topRight');
	setTimeout(function() { $('.logoxterium').append('<span class=\'flashing_bg\'></span>') }, 4000);
	setTimeout(function() { qtips('.logoxterium ', '{$LNG.tutorial_metal_19}', 'bottomMiddle', 'topLeft') }, 4000);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 13 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	qtips('#espionage ', '{$LNG.tutorial_metal_18}','bottomMiddle', 'topRight');
	setTimeout(function() { $('.logoxterium').append('<span class=\'flashing_bg\'></span>') }, 4000);
	setTimeout(function() { qtips('.logoxterium ', '{$LNG.tutorial_metal_19}', 'bottomMiddle', 'topLeft') }, 4000);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 13 && $queryString != "page=overview"}
	<script type="text/javascript">
	$(function() {
	$('.logoxterium').append('<span class=\'flashing_bg\'></span>');
	qtips('.logoxterium ', '{$LNG.tutorial_metal_19}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 13 && $queryString == "page=overview"}
	<script type="text/javascript">
	$(function() {
	$('.fleet_log').append('<span class=\'flashing_bg\'></span> ');
	qtips('.fleet_log ', '{$LNG.tutorial_metal_20}', 'bottomMiddle', 'topMiddle');
	setTimeout(function() { $('#munu_research').append('<span class=\'flashing_bg\'></span>') }, 4000);
	setTimeout(function() { qtips('#munu_research', '{$LNG.tutorial_metal_17}', 'bottomMiddle', 'topLeft') }, 4000);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	
	
	{/if}{if  $bodyclass != "popup" && $tutorial == 14 && $queryString != "page=research"}
	<script type="text/javascript">
	$(function() {
	$('#munu_research').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_research ', '{$LNG.tutorial_metal_17}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 14 && $queryString == "page=research"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#research_106" ).show();
	$('#research_106').append('<span class=\'flashing_bg\'></span> ');
	qtip_modal('{$LNG.tutorial_metal_59}', '<p>{$LNG.tutorial_metal_60}</p><br /><br /> <ul class="trn_ul">	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/31.gif" alt="{$LNG.tech.31}">{$LNG.tutorial_metal_3}: &laquo;{$LNG.tech.31}&raquo; {$LNG.tutorial_metal_4}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/106.gif" alt="{$LNG.tech.106}">{$LNG.tutorial_metal_17}: &laquo;{$LNG.tech.106} {$LNG.tutorial_metal_5}.</li></ul>', '{$LNG.tutorial_close_info}', 550);
	setTimeout(function() { $('#munu_build').append('<span class=\'flashing_bg\'></span>') }, 6500);
	setTimeout(function() { qtips('#munu_build', '{$LNG.tutorial_build}', 'bottomMiddle', 'topRight') }, 6500);
	setTimeout(function() { qtips('#research_106 .price', '{$LNG.tutorial_metal_61} &laquo;{$LNG.tech.106}&raquo;, {$LNG.tutorial_metal_62}', 'topMiddle', 'bottomLeft') }, 3000);
	$('#research_106').append('<span class=\'flashing_bg\'></span>');
	qtips('#research_106 .btn_build_part_left ', '{$LNG.tutorial_metal_21}', 'bottomMiddle', 'topMiddle');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 15 && $queryString != "page=research"}
	<script type="text/javascript">
	$(function() {
	$('#munu_research').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_research ', '{$LNG.tutorial_metal_17}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 16 && $queryString != "page=research"}
	<script type="text/javascript">
	$(function() {
	$('#munu_research').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_research ', '{$LNG.tutorial_metal_17}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 16 && $queryString == "page=research"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#research_106" ).show();
	$('#research_106').append('<span class=\'flashing_bg\'></span> ');
	qtip_modal('{$LNG.tutorial_metal_59}', '<p>{$LNG.tutorial_metal_60}</p><br /><br /> <ul class="trn_ul">	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/31.gif" alt="{$LNG.tech.31}">{$LNG.tutorial_metal_3}: &laquo;{$LNG.tech.31}&raquo; {$LNG.tutorial_metal_4}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/106.gif" alt="{$LNG.tech.106}">{$LNG.tutorial_metal_17}: &laquo;{$LNG.tech.106}&raquo; {$LNG.tutorial_metal_5}.</li></ul>', '{$LNG.tutorial_close_info}', 550);
	setTimeout(function() { $('#munu_build').append('<span class=\'flashing_bg\'></span>') }, 6500);
	setTimeout(function() { qtips('#munu_build', '{$LNG.tutorial_build}', 'bottomMiddle', 'topRight') }, 6500);
	setTimeout(function() { qtips('#research_106 .price', '{$LNG.tutorial_metal_61} &laquo;{$LNG.tech.106}&raquo;, {$LNG.tutorial_metal_62}', 'topMiddle', 'bottomLeft') }, 3000);
	$('#research_106').append('<span class=\'flashing_bg\'></span>');
	qtips('#research_106 .btn_build_part_left ', '{$LNG.tutorial_metal_21}', 'bottomMiddle', 'topMiddle');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 17 && $queryString == "page=research"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#research_106" ).show();
	$('#research_106').append('<span class=\'flashing_bg\'></span> ');
	qtip_modal('{$LNG.tutorial_metal_59}', '<p>{$LNG.tutorial_metal_60}</p><br /><br /> <ul class="trn_ul">	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/31.gif" alt="{$LNG.tech.31}">{$LNG.tutorial_metal_3}: &laquo;{$LNG.tech.31}&raquo; {$LNG.tutorial_metal_4}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/106.gif" alt="{$LNG.tech.106}">{$LNG.tutorial_metal_17}: &laquo;{$LNG.tech.106} {$LNG.tutorial_metal_5}.</li></ul>', '{$LNG.tutorial_close_info}', 550);
	setTimeout(function() { $('#munu_build').append('<span class=\'flashing_bg\'></span>') }, 6500);
	setTimeout(function() { qtips('#munu_build', '{$LNG.tutorial_build}', 'bottomMiddle', 'topRight') }, 6500);
	setTimeout(function() { qtips('#research_106 .price', '{$LNG.tutorial_metal_61} &laquo;{$LNG.tech.106}&raquo;, {$LNG.tutorial_metal_62}', 'topMiddle', 'bottomLeft') }, 3000);
	$('#research_106').append('<span class=\'flashing_bg\'></span>');
	qtips('#research_106 .btn_build_part_left ', '{$LNG.tutorial_metal_21}', 'bottomMiddle', 'topMiddle');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 17 && $queryString != "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$('#munu_build').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_build ', '{$LNG.tutorial_build}', 'bottomMiddle', 'topRight');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 17 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_1" ).show();
	$( "#build_2" ).show();
	$( "#build_3" ).show();
	$( "#build_4" ).show();
	$( "#build_31" ).show();
	qtips('#build_31 .btn_build_part_left ', '{$LNG.tutorial_metal_21}', 'bottomMiddle', 'topMiddle');
	$('#build_31').append('<span class=\'flashing_bg\'></span>');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 18 && $queryString == "page=research"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#research_106" ).show();
	$('#research_106').append('<span class=\'flashing_bg\'></span> ');
	setTimeout(function() { $('#munu_build').append('<span class=\'flashing_bg\'></span>') }, 6500);
	setTimeout(function() { qtips('#munu_build', '{$LNG.tutorial_build}', 'bottomMiddle', 'topRight') }, 6500);
	setTimeout(function() { qtips('#research_106 .price', '{$LNG.tutorial_metal_58}', 'topMiddle', 'bottomLeft') }, 3000);
	$('#research_106').append('<span class=\'flashing_bg\'></span>');
	qtips('#research_106 .btn_build_part_left ', '{$LNG.tutorial_metal_21}', 'bottomMiddle', 'topMiddle');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 18 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_1" ).show();
	$( "#build_2" ).show();
	$( "#build_3" ).show();
	$( "#build_4" ).show();
	$( "#build_31" ).show();
	qtips('#build_31 .btn_build_part_left ', '{$LNG.tutorial_metal_21}', 'bottomMiddle', 'topMiddle');
	$('#build_31').append('<span class=\'flashing_bg\'></span>');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 18 && $queryString != "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$('#munu_build').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_build ', '{$LNG.tutorial_build}', 'bottomMiddle', 'topRight');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 19 && $queryString != "page=research"}
	<script type="text/javascript">
	$(function() {
	$('#munu_research').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_research ', '{$LNG.tutorial_metal_17}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 19 && $queryString == "page=research"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#research_106" ).show();
	$('#research_106').append('<span class=\'flashing_bg\'></span> ');
	$('#research_106').append('<span class=\'flashing_bg\'></span>');
	qtips('#research_106 .btn_build_part_left ', '{$LNG.tutorial_metal_70}', 'bottomMiddle', 'topMiddle');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 20 && $queryString == "page=research"}
	<script type="text/javascript">
	$(function() {
	if($("div").is("#fool_conteiner"))setTimeout(function() { location.reload(); }, 10000);
	qtip_modal('{$LNG.tutorial_metal_15}!', '{$LNG.tutorial_metal_56}<br /><br /><p><span class="trn_span_bonus">{$LNG.tutorial_metal_57}.</span></p>', '{$LNG.tutorial_close_info}', 450);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 21 && $queryString != "page=defense"}
	<script type="text/javascript">
	$(function() {
	$('#munu_shipyard_defense').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_shipyard_defense ', '{$LNG.tutorial_metal_22}', 'bottomMiddle', 'topRight');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 21 && $queryString == "page=defense"}
	<script type="text/javascript">
	$(function() {
	qtip_modal('{$LNG.option_train_5}', '<p>{$LNG.tutorial_metal_52}</p><p>{$LNG.tutorial_metal_53}</p><br /><br /> <ul class="trn_ul">	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/14.gif" alt="{$LNG.tech.14}">{$LNG.tutorial_metal_3}: &laquo;{$LNG.tech.14}&raquo; {$LNG.tutorial_metal_5}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/21.gif" alt="{$LNG.tech.21}">{$LNG.tutorial_metal_3}: &laquo;{$LNG.tech.21}&raquo; {$LNG.tutorial_metal_5}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/113.gif" alt="{$LNG.tech.113}">{$LNG.tutorial_metal_17}: &laquo;{$LNG.tech.113}&raquo; {$LNG.tutorial_metal_5}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/120.gif" alt="{$LNG.tech.120}">{$LNG.tutorial_metal_17}: &laquo;{$LNG.tech.120}&raquo; {$LNG.tutorial_metal_48}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/401.gif" alt="{$LNG.tech.401} установок">{$LNG.tutorial_build}: &laquo;{$LNG.tech.401}&raquo; {$LNG.tutorial_metal_54}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/402.gif" alt="{$LNG.tech.402}">{$LNG.tutorial_build}: &laquo;{$LNG.tech.402}&raquo; {$LNG.tutorial_metal_55}.</li></ul>', '{$LNG.tutorial_close_info}', 550);
	$( ".build_box" ).hide();
	$( ".build_band_conveyors" ).hide();
	$( "#s_401" ).show();
	$( "#s_402" ).show();
	$( "#s_light" ).show();
	$('#munu_build').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_build ', '{$LNG.tutorial_build}', 'bottomMiddle', 'topRight');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 22 && $queryString == "page=defense"}
	<script type="text/javascript">
	$(function() {
	qtip_modal('{$LNG.option_train_5}', '<p>{$LNG.tutorial_metal_52}</p><p>{$LNG.tutorial_metal_53}</p><br /><br /> <ul class="trn_ul">	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/14.gif" alt="{$LNG.tech.14}">{$LNG.tutorial_metal_3}: &laquo;{$LNG.tech.14}&raquo; {$LNG.tutorial_metal_5}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/21.gif" alt="{$LNG.tech.21}">{$LNG.tutorial_metal_3}: &laquo;{$LNG.tech.21}&raquo; {$LNG.tutorial_metal_5}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/113.gif" alt="{$LNG.tech.113}">{$LNG.tutorial_metal_17}: &laquo;{$LNG.tech.113}&raquo; {$LNG.tutorial_metal_5}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/120.gif" alt="{$LNG.tech.120}">{$LNG.tutorial_metal_17}: &laquo;{$LNG.tech.120}&raquo; {$LNG.tutorial_metal_48}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/401.gif" alt="{$LNG.tech.401} установок">{$LNG.tutorial_build}: &laquo;{$LNG.tech.401}&raquo; {$LNG.tutorial_metal_54}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/402.gif" alt="{$LNG.tech.402}">{$LNG.tutorial_build}: &laquo;{$LNG.tech.402}&raquo; {$LNG.tutorial_metal_55}.</li></ul>', '{$LNG.tutorial_close_info}', 550);
	$( ".build_box" ).hide();
	$( ".build_band_conveyors" ).hide();
	$( "#s_401" ).show();
	$( "#s_402" ).show();
	$( "#s_light" ).show();
	$('#munu_build').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_build ', '{$LNG.tutorial_build}', 'bottomMiddle', 'topRight');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 23 && $queryString == "page=defense"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( ".build_band_conveyors" ).hide();
	$( "#s_401" ).show();
	$( "#s_402" ).show();
	$( "#s_light" ).show();
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 22 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_14" ).show();
	$( "#build_21" ).show();
	qtips('#build_14 .btn_build_part_left ', '{$LNG.tutorial_metal_8}', 'bottomMiddle', 'topMiddle');
	$('#build_14').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 23 && $queryString != "page=buildings" || $bodyclass != "popup" && $tutorial == 24 && $queryString != "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$('#munu_build').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_build ', '{$LNG.tutorial_build}', 'bottomMiddle', 'topRight');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 23 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_14" ).show();
	$( "#build_21" ).show();
	qtips('#build_14 .btn_build_part_left ', '{$LNG.tutorial_metal_8}', 'bottomMiddle', 'topMiddle');
	$('#build_14').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 24 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_14" ).show();
	$( "#build_21" ).show();
	qtips('#build_21 .btn_build_part_left ', '{$LNG.tutorial_metal_8}', 'bottomMiddle', 'topMiddle');
	$('#build_21').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 26 && $queryString == "page=defense"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( ".build_band_conveyors" ).hide();
	$( "#s_401" ).show();
	$( "#s_402" ).show();
	$( "#s_light" ).show();
	$('#munu_research').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_research ', '{$LNG.tutorial_metal_17}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}
	{if  $bodyclass != "popup" && $tutorial == 25 && $queryString != "page=research" || $bodyclass != "popup" && $tutorial == 26 && $queryString != "page=research" || $bodyclass != "popup" && $tutorial == 35 && $queryString != "page=research" || $bodyclass != "popup" && $tutorial == 36 && $queryString != "page=research" || $bodyclass != "popup" && $tutorial == 37 && $queryString != "page=research"}
	<script type="text/javascript">
	$(function() {
	$('#munu_research').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_research ', '{$LNG.tutorial_metal_17}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}	
	{if  $bodyclass != "popup" && $tutorial == 25 && $queryString == "page=research"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#research_113" ).show();
	$( "#research_120" ).show();
	qtips('#research_113 .btn_build_part_left ', '{$LNG.tutorial_metal_23}', 'bottomMiddle', 'topMiddle');
	$('#research_113').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 26 && $queryString == "page=research"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#research_113" ).show();
	$( "#research_120" ).show();
	qtips('#research_120 .btn_build_part_left ', '{$LNG.tutorial_metal_70}', 'bottomMiddle', 'topMiddle');
	$('#research_120').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 26 && $queryString == "page=defense"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( ".build_band_conveyors" ).hide();
	$( "#s_401" ).show();
	$( "#s_402" ).show();
	$( "#s_light" ).show();
	{if $Rocket < 25}
	qtips('#s_401', '{$LNG.tutorial_metal_24}', 'bottomMiddle', 'topMiddle');
	$('#s_401').append('<span class=\'flashing_bg\'></span> ');
	{/if}
	{if $LightL < 10}
	qtips('#s_402', '{$LNG.tutorial_metal_25}', 'bottomMiddle', 'topMiddle');
	$('#s_402').append('<span class=\'flashing_bg\'></span> ');
	{/if}
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 27 && $queryString != "page=defense"}
	<script type="text/javascript">
	$(function() {
	$('#munu_shipyard_defense').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_shipyard_defense ', '{$LNG.tutorial_metal_22}', 'bottomMiddle', 'topRight');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}{if  $bodyclass != "popup" && $tutorial == 27 && $queryString == "page=defense"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( ".build_band_conveyors" ).hide();
	$( "#s_401" ).show();
	$( "#s_402" ).show();
	$( "#s_light" ).show();
	{if $Rocket < 25}
	qtips('#s_401', '{$LNG.tutorial_metal_24}', 'bottomMiddle', 'topMiddle');
	$('#s_401').append('<span class=\'flashing_bg\'></span> ');
	{/if}
	{if $LightL < 10}
	qtips('#s_402', '{$LNG.tutorial_metal_25}', 'bottomMiddle', 'topMiddle');
	$('#s_402').append('<span class=\'flashing_bg\'></span> ');
	{/if}
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}
	{if  $bodyclass != "popup" && $tutorial == 27 && $queryString == "page=defense" && $Rocket >= 25 && $LightL >= 10}
	<script type="text/javascript">
	$(function() {
	if($("div").is("#fool_conteiner"))setTimeout(function() { location.reload(); }, 10000);
	qtip_modal('{$LNG.tutorial_metal_15}!', '{$LNG.tutorial_metal_26}', '{$LNG.tutorial_close_info}', 450);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}
	
	{if $bodyclass != "popup" && $tutorial == 28 && $queryString == "page=defense"}
	<script type="text/javascript">
	$(function() {
	qtips('#attack ', '{$LNG.tutorial_metal_71}', 'bottomMiddle', 'topLeft');
	setTimeout(function() { $('.logoxterium').append('<span class=\'flashing_bg\'></span>') }, 2500);
	setTimeout(function() { qtips('.logoxterium ', '{$LNG.tutorial_metal_72}', 'bottomMiddle', 'topLeft') }, 2500);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 28 && $queryString != "page=overview"}
	<script type="text/javascript">
	$(function() {
	$('.logoxterium').append('<span class=\'flashing_bg\'></span> ');
	qtips('.logoxterium ', '{$LNG.tutorial_metal_75}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 28 && $queryString == "page=overview" || $bodyclass != "popup" && $tutorial == 29 && $queryString == "page=overview" && $totalAttacks >=1}
	<script type="text/javascript">
	$(function() {
	$('.fleet_log').append('<span class=\'flashing_bg\'></span> ');
	qtips('a.attack:first ', '{$LNG.tutorial_metal_73}', 'topMiddle', 'bottomMiddle');
	qtips('#big_panet', '{$LNG.tutorial_metal_74}', 'topMiddle', 'topMiddle');
	if($("div").is("#fool_conteiner"))setTimeout(function() { location.reload(); }, 50000);
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}
	{if  $bodyclass != "popup" && $tutorial == 30 && $queryString != "page=messages" || $bodyclass != "popup" && $tutorial == 31 && $queryString != "page=messages" || $bodyclass != "popup" && $tutorial == 29 && $queryString != "page=messages" && $totalAttacks == 0}
	<script type="text/javascript">
	$(function() {
	qtips('#a_mesage', '{$LNG.tutorial_metal_76}', 'bottomMiddle', 'topMiddle');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	
	{if $bodyclass != "popup" && $tutorial == 30 && $queryString == "page=messages" || $bodyclass != "popup" && $tutorial == 31 && $queryString == "page=messages"}
	<script type="text/javascript">
	$(function() {
	$('#mes_3').append('<span class=\'flashing_bg\'></span> ');
	qtips('#mes_3 ', '{$LNG.tutorial_metal_77}', 'topMiddle', 'bottomMiddle');
	if($("div").is("#fool_conteiner"))setTimeout(function() { location.reload(); }, 10000);
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 32}
	<script type="text/javascript">
	$(function() {
		$('#munu_build').append('<span class=\'flashing_bg\'></span> ');
		qtips('#munu_build ', '{$LNG.tutorial_build}', 'bottomMiddle', 'topRight');
		qtip_modal('{$LNG.tutorial_metal_42}', '<p>{$LNG.tutorial_metal_43}</p><p>{$LNG.tutorial_metal_44}</p><p>{$LNG.tutorial_metal_45}</p><br /><br /> <ul class="trn_ul">	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/15.gif" alt="{$LNG.tech.15}">{$LNG.tutorial_metal_3}: &laquo;{$LNG.tech.15}&raquo; {$LNG.tutorial_metal_47}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/113.gif" alt="{$LNG.tech.113}">{$LNG.tutorial_metal_17}: &laquo;{$LNG.tech.113}&raquo; {$LNG.tutorial_metal_48}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/110.gif" alt="{$LNG.tech.110}">{$LNG.tutorial_metal_17}: &laquo;{$LNG.tech.110}&raquo; {$LNG.tutorial_metal_49}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/115.gif" alt="{$LNG.tech.115}">{$LNG.tutorial_metal_17}: &laquo;{$LNG.tech.115}&raquo; {$LNG.tutorial_metal_50}.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/209.gif" alt="{$LNG.tech.209}">{$LNG.tutorial_build}: &laquo;{$LNG.tech.209}&raquo; {$LNG.tutorial_metal_51}.</li>	<li class="trn_li_demands">{$LNG.tutorial_metal_46}</li></ul>', '{$LNG.tutorial_close_info}', 550);
		setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 33 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_31" ).show();
	$( "#build_21" ).show();
	qtips('#build_21 .btn_build_part_left ', '{$LNG.tutorial_metal_78}', 'bottomMiddle', 'topMiddle');
	$('#build_21').append('<span class=\'flashing_bg\'></span>');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 34 && $queryString == "page=buildings"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#build_31" ).show();
	$( "#build_21" ).show();
	qtips('#build_31 .btn_build_part_left ', '{$LNG.tutorial_metal_79}', 'bottomMiddle', 'topMiddle');
	$('#build_31').append('<span class=\'flashing_bg\'></span>');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	
	{if $bodyclass != "popup" && $tutorial == 35 && $queryString == "page=research"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#research_113" ).show();
	$( "#research_110" ).show();
	$( "#research_115" ).show();
	$('#research_113').append('<span class=\'flashing_bg\'></span>');
	qtips('#research_113 .btn_build_part_left ', '{$LNG.tutorial_metal_80}', 'bottomMiddle', 'topMiddle');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	
	{if $bodyclass != "popup" && $tutorial == 36 && $queryString == "page=research"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#research_113" ).show();
	$( "#research_110" ).show();
	$( "#research_115" ).show();
	$('#research_110').append('<span class=\'flashing_bg\'></span>');
	qtips('#research_110 .btn_build_part_left ', '{$LNG.tutorial_metal_81}', 'bottomMiddle', 'topMiddle');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	
	{if $bodyclass != "popup" && $tutorial == 37 && $queryString == "page=research"}
	<script type="text/javascript">
	$(function() {
	$( ".build_box" ).hide();
	$( "#research_113" ).show();
	$( "#research_110" ).show();
	$( "#research_115" ).show();
	$('#research_115').append('<span class=\'flashing_bg\'></span>');
	qtips('#research_115 .btn_build_part_left ', '{$LNG.tutorial_metal_82}', 'bottomMiddle', 'topMiddle');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	
	{if  $bodyclass != "popup" && $tutorial == 38 && $queryString != "page=shipyard"}
	<script type="text/javascript">
	$(function() {
	$('#munu_shipyard_fleet').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_shipyard_fleet ', '{$LNG.tutorial_metal_83}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	
	{if  $bodyclass != "popup" && $tutorial == 38 && $queryString == "page=shipyard"}
	<script type="text/javascript">
	$(function() {
		$( ".build_box" ).hide();
	$( ".build_band_conveyors" ).hide();
	$( "#s_209" ).show();
	$( "#s_middle" ).show();
	qtips('#s_209', '{$LNG.tutorial_metal_84}', 'bottomMiddle', 'topMiddle');
	$('#s_209').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	
	{if  $bodyclass != "popup" && $tutorial == 39 && $queryString != "page=galaxy"}
	<script type="text/javascript">
	$(function() {
	$('#munu_galaxy').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_galaxy ', '{$LNG.tutorial_metal_85}.', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	
	{if  $bodyclass != "popup" && $tutorial == 39 && $queryString == "page=galaxy"}
	<script type="text/javascript">
	$(function() {
	if($("div").is("#fool_conteiner"))setTimeout(function() { location.reload(); }, 7000);
	qtips_galaxy_der('{$current_pid}', '{$LNG.tutorial_metal_86}');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	
	{if  $bodyclass != "popup" && $tutorial == 40 && $queryString != "page=overview"}
	<script type="text/javascript">
	$(function() {
	$('.logoxterium').append('<span class=\'flashing_bg\'></span> ');
	qtips('.logoxterium ', '{$LNG.tutorial_metal_87}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if  $bodyclass != "popup" && $tutorial == 40 && $queryString == "page=overview"}
	<script type="text/javascript">
	$(function() {
	if($("div").is("#fool_conteiner"))setTimeout(function() { location.reload(); }, 10000);
	$('.fleet_log').append('<span class=\'flashing_bg\'></span> ');
	qtip_modal('{$LNG.tutorial_metal_15}', '{$LNG.tutorial_metal_88}', '{$LNG.tutorial_close_info}', 450);
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if  $bodyclass != "popup" && $tutorial == 41 && $queryString == "page=overview"}
	<script type="text/javascript">
	$(function() {
	$('#munu_senat').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_senat ', '{$LNG.tutorial_metal_89}', 'bottomMiddle', 'topLeft');
	qtip_modal('{$LNG.tutorial_metal_90}', '<p>{$LNG.tutorial_metal_91}</p><br /><br /> <ul class="trn_ul">	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/601.jpg" alt="{$LNG.tech.601}">{$LNG.tutorial_metal_69}: &laquo;{$LNG.tech.601}&raquo;.</li>	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/602.jpg" alt="{$LNG.tech.602}">{$LNG.tutorial_metal_69}: &laquo;{$LNG.tech.602}&raquo;.</li></ul>', '{$LNG.tutorial_close_info}', 550);
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 42 && $queryString != "page=officier" || $bodyclass != "popup" && $tutorial == 43 && $queryString != "page=officier"}
	<script type="text/javascript">
	$(function() {
	$('#munu_senat').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_senat ', '{$LNG.tutorial_metal_92}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if  $bodyclass != "popup" && $tutorial == 42 && $queryString == "page=officier" && $offi601 < 1}
	<script type="text/javascript">
	$(function() {
	qtips('#ofic_601 .btn_build_border ', '{$LNG.tutorial_metal_93}', 'bottomMiddle', 'topMiddle');
	$('#ofic_601').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if  $bodyclass != "popup" && $tutorial == 42 && $queryString == "page=officier" && $offi601 >= 1}
	<script type="text/javascript">
	$(function() {
	qtips('#ofic_602 .btn_build_border ', '{$LNG.tutorial_metal_93}', 'bottomMiddle', 'topMiddle');
	$('#ofic_602').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if  $bodyclass != "popup" && $tutorial == 43 && $queryString == "page=officier" && $offi602 < 1}
	<script type="text/javascript">
	$(function() {
	qtips('#ofic_602 .btn_build_border ', '{$LNG.tutorial_metal_93}', 'bottomMiddle', 'topMiddle');
	$('#ofic_602').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if  $bodyclass != "popup" && $tutorial == 43 && $offi601 >= 1 && $offi602 >= 1}
	<script type="text/javascript">
	$(function() {
	if($("div").is("#fool_conteiner"))setTimeout(function() { location.reload(); }, 10000);
	qtip_modal('{$LNG.tutorial_metal_94}!', '{$LNG.tutorial_metal_95}', '{$LNG.tutorial_close_info}', 450);
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 44}
	<script type="text/javascript">
	$(function() {
	$('#munu_academy').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_academy ', '{$LNG.tutorial_metal_96}', 'bottomMiddle', 'topLeft');
	qtip_modal('{$LNG.lm_academy}', '{$LNG.tutorial_metal_97}<br /><br /> <ul class="trn_ul">	<li class="trn_li_demands"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/1101.jpg" alt="{$LNG.ally_fractions_9}">{$LNG.tutorial_metal_112}: &laquo;{$LNG.ally_fractions_9}&raquo;.</li></ul>', '{$LNG.tutorial_close_info}', 550);
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 45 && $queryString != "page=academy"}
	<script type="text/javascript">
	$(function() {
	$('#munu_academy').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_academy ', '{$LNG.tutorial_metal_96}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 45 && $queryString == "page=academy"}
	<script type="text/javascript">
	$(function() {
	qtips('#span_point', '{$LNG.tutorial_metal_98}', 'topMiddle', 'bottomRight');
	qtips('#skil_1101', '{$LNG.tutorial_metal_99}', 'bottomMiddle', 'topMiddle');
	$('#skil_1101').append('<span class=\'flashing_bg\'></span> ');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 46}
	<script type="text/javascript">
	$(function() {
	if($("div").is("#fool_conteiner"))setTimeout(function() { location.reload(); }, 10000);
	qtip_modal('{$LNG.tutorial_metal_100}!', '<p>{$LNG.tutorial_metal_101}</p>', '{$LNG.tutorial_close_info}', 450);
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 47 && $queryString != "page=achievement"}
	<script type="text/javascript">
	$(function() {
	$('#achievements_name').append('<span class=\'flashing_bg\'></span> ');
	qtips('#achievements_name ', '{$LNG.tutorial_metal_102}', 'topMiddle', 'bottomRight');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 47 && $queryString == "page=achievement"}
	<script type="text/javascript">
	$(function() {
	Dialog.manualinfo(13);
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 48 && $queryString == "page=achievement"}
	<script type="text/javascript">
	$(function() {
	qtips('.ach_next_info:first', '{$LNG.tutorial_metal_113}', 'topMiddle', 'bottomRight');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 49 || $bodyclass != "popup" && $tutorial == 50}
	<script type="text/javascript">
	$(function() {
	Dialog.manualinfo(255);
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 51 && $colshiptuto >= 1 && $queryString != "page=galaxy" && $queryString != "page=fleetTable"}
	<script type="text/javascript">
	$(function() {
	$('#munu_galaxy').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_galaxy ', '{$LNG.tutorial_metal_127}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 51 && $colshiptuto >= 1 && $queryString == "page=galaxy"}
	<script type="text/javascript">
	$(function() {
	$('.ico_coloni').append('<span class=\'flashing_bg\'></span> ');
	qtips('.ico_coloni ', '{$LNG.tutorial_metal_127}', 'leftMiddle', 'rightMiddle');
	setTimeout(function() { qtips('#nav_2 ', '{$LNG.tutorial_metal_132}', 'topMiddle', 'bottomMiddle') }, 4000);
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 52 && $colshiptuto >= 1 && $queryString != "page=fleetTable" && $queryString != "page=fleetStep1" && $queryString != "page=fleetStep2" && $queryString != "page=fleetStep3"}
	<script type="text/javascript">
	$(function() {
	$('#munu_fleetable').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_fleetable ', '{$LNG.tutorial_metal_133}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 52 && $colshiptuto >= 1 && $queryString == "page=fleetTable" || $bodyclass != "popup" && $tutorial == 51 && $colshiptuto >= 1 && $queryString == "page=fleetTable" }
	<script type="text/javascript">
	$(function() {
	qtips('#ship208_input ', '{$LNG.tutorial_metal_134}', 'topMiddle', 'bottomRight');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 52 && $colshiptuto >= 1 && $queryString == "page=fleetStep1"}
	<script type="text/javascript">
	$(function() {
	qtips('.fl_bigbtn_go ', '{$LNG.tutorial_metal_135}', 'topMiddle', 'bottomMiddle');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 52 && $colshiptuto >= 1 && $queryString == "page=fleetStep2"}
	<script type="text/javascript">
	$(function() {
	qtips('.bottom_band_submit ', '{$LNG.tutorial_metal_135}', 'topMiddle', 'bottomRight');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 53}
	<script type="text/javascript">
	$(function() {
	if($("div").is("#fool_conteiner"))setTimeout(function() { location.reload(); }, 10000);
	qtip_modal('{$LNG.tutorial_metal_15}', '{$LNG.tutorial_metal_136}</p>', '{$LNG.tutorial_close_info}', 450);
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 55 && $queryString != "page=galaxy"}
	<script type="text/javascript">
	$(function() {
	$('#munu_galaxy').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_galaxy ', '{$LNG.tutorial_metal_137}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 55 && $queryString == "page=galaxy"}
	<script type="text/javascript">
	$(function() {
	$('#dali').append('<span class=\'flashing_bg\'></span> ');
	qtips('#dali ', '{$LNG.tutorial_metal_138}', 'topMiddle', 'bottomMiddle');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 56 && $queryString != "page=fleetTable" && $queryString != "page=fleetStep1" && $queryString != "page=fleetStep2" && $queryString != "page=fleetStep3"}
	<script type="text/javascript">
	$(function() {
	$('#munu_fleetable').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_fleetable ', '{$LNG.tutorial_metal_133}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 56 && $queryString == "page=fleetTable"}
	<script type="text/javascript">
	$(function() {
	qtips('.tablesorter:first ', '{$LNG.tutorial_metal_139}:<br /> <table class=\'reducefleet_table\'><tr>	<td class=\'reducefleet_img_ship\'><img src=\'./styles/theme/gow/gebaeude/204.gif\' alt=\'{$LNG.tech.204}\' /></td>	<td class=\'reducefleet_name_ship\'>{$LNG.tech.204}: <span class=\'reducefleet_count_ship\'>10.000</span></td></tr><tr>	<td class=\'reducefleet_img_ship\'><img src=\'./styles/theme/gow/gebaeude/207.gif\' alt=\'{$LNG.tech.207}\' /></td>	<td class=\'reducefleet_name_ship\'>{$LNG.tech.207}: <span class=\'reducefleet_count_ship\'>1.500</span></td></tr><tr>	<td class=\'reducefleet_img_ship\'><img src=\'./styles/theme/gow/gebaeude/203.gif\' alt=\'{$LNG.tech.203}\' /></td>	<td class=\'reducefleet_name_ship\'>{$LNG.tech.203}: <span class=\'reducefleet_count_ship\'>1.000</span></td></tr><tr>	<td class=\'reducefleet_img_ship\'><img src=\'./styles/theme/gow/gebaeude/209.gif\' alt=\'{$LNG.tech.209}\' /></td>	<td class=\'reducefleet_name_ship\'>{$LNG.tech.209}: <span class=\'reducefleet_count_ship\'>10</span></td></tr></table>{$LNG.tutorial_metal_140}', 'topMiddle', 'bottomMiddle');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 56 && $queryString == "page=fleetStep1"}
	<script type="text/javascript">
	$(function() {
	qtips('.fl_bigbtn_go ', '{$LNG.tutorial_metal_141}', 'topMiddle', 'bottomMiddle');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 56 && $queryString == "page=fleetStep2"}
	<script type="text/javascript">
	$(function() {
	qtips('.bottom_band_submit ', '{$LNG.tutorial_metal_142}', 'topMiddle', 'bottomRight');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 57}
	<script type="text/javascript">
	$(function() {
	if($("div").is("#fool_conteiner"))setTimeout(function() { location.reload(); }, 10000);
	qtip_modal('{$LNG.tutorial_metal_15}', '{$LNG.tutorial_metal_144}.<br /><br /><p><span class="trn_span_bonus">{$LNG.achiev_26}:</span></p><ul class="trn_ul">	<li class="trn_li_bonus"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/204.gif" alt="{$LNG.tech.204}">&laquo;{$LNG.tech.204}&raquo; 150.000 {$LNG.tutorial_metal_128}.</li>	<li class="trn_li_bonus"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/205.gif" alt="{$LNG.tech.205}">&laquo;{$LNG.tech.205}&raquo; 24.000 {$LNG.tutorial_metal_128}.</li>	<li class="trn_li_bonus"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/206.gif" alt="{$LNG.tech.206}">&laquo;{$LNG.tech.206}&raquo; 49.000 {$LNG.tutorial_metal_128}.</li>	<li class="trn_li_bonus"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/207.gif" alt="{$LNG.tech.207}">&laquo;{$LNG.tech.207}&raquo; 9.850 {$LNG.tutorial_metal_128}.</li>	<li class="trn_li_bonus"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/215.gif" alt="{$LNG.tech.215}">&laquo;{$LNG.tech.215}&raquo; 3.500 {$LNG.tutorial_metal_128}.</li>	<li class="trn_li_bonus"><img class="trn_ul_li_img" src="./styles/theme/gow/gebaeude/219.gif" alt="{$LNG.tech.219}">&laquo;{$LNG.tech.219}&raquo; 25 {$LNG.tutorial_metal_128}.</li></ul>', '{$LNG.tutorial_close_info}', 450);
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 59 && $queryString != "page=galaxy"}
	<script type="text/javascript">
	$(function() {
	$('#munu_galaxy').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_galaxy ', '{$LNG.tutorial_metal_143}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 59 && $queryString == "page=galaxy"}
	<script type="text/javascript">
	$(function() {
	$('#expedition').append('<span class=\'flashing_bg\'></span> ');
	qtips('#expedition ', '{$LNG.tutorial_metal_145}', 'topMiddle', 'bottomMiddle');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 60 && $queryString != "page=fleetTable" && $queryString != "page=fleetStep1" && $queryString != "page=fleetStep2" && $queryString != "page=fleetStep3"}
	<script type="text/javascript">
	$(function() {
	$('#munu_fleetable').append('<span class=\'flashing_bg\'></span> ');
	qtips('#munu_fleetable ', '{$LNG.tutorial_metal_133}', 'bottomMiddle', 'topLeft');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 60 && $queryString == "page=fleetTable"}
	<script type="text/javascript">
	$(function() {
	qtips('.tablesorter:first ', '{$LNG.tutorial_metal_146}:<br /> <table class=\'reducefleet_table\'><tr>	<td class=\'reducefleet_img_ship\'><img src=\'./styles/theme/gow/gebaeude/204.gif\' alt=\'{$LNG.tech.204}\' /></td>	<td class=\'reducefleet_name_ship\'>{$LNG.tech.204}: <span class=\'reducefleet_count_ship\'>150.000</span></td></tr><tr>	<td class=\'reducefleet_img_ship\'><img src=\'./styles/theme/gow/gebaeude/205.gif\' alt=\'{$LNG.tech.205}\' /></td>	<td class=\'reducefleet_name_ship\'>{$LNG.tech.205}: <span class=\'reducefleet_count_ship\'>25.000</span></td></tr><tr>	<td class=\'reducefleet_img_ship\'><img src=\'./styles/theme/gow/gebaeude/206.gif\' alt=\'{$LNG.tech.206}\' /></td>	<td class=\'reducefleet_name_ship\'>{$LNG.tech.206}: <span class=\'reducefleet_count_ship\'>50.000</span></td></tr><tr>	<td class=\'reducefleet_img_ship\'><img src=\'./styles/theme/gow/gebaeude/207.gif\' alt=\'{$LNG.tech.207}\' /></td>	<td class=\'reducefleet_name_ship\'>{$LNG.tech.207}: <span class=\'reducefleet_count_ship\'>10.000</span></td></tr><tr>	<td class=\'reducefleet_img_ship\'><img src=\'./styles/theme/gow/gebaeude/215.gif\' alt=\'{$LNG.tech.215}\' /></td>	<td class=\'reducefleet_name_ship\'>{$LNG.tech.215}: <span class=\'reducefleet_count_ship\'>3.500</span></td></tr><tr>	<td class=\'reducefleet_img_ship\'><img src=\'./styles/theme/gow/gebaeude/219.gif\' alt=\'{$LNG.tech.219}\' /></td>	<td class=\'reducefleet_name_ship\'>{$LNG.tech.219}: <span class=\'reducefleet_count_ship\'>25</span></td></tr></table>{$LNG.tutorial_metal_140}', 'topMiddle', 'bottomMiddle');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 60 && $queryString == "page=fleetStep1"}
	<script type="text/javascript">
	$(function() {
	qtips('.fl_bigbtn_go ', '{$LNG.tutorial_metal_135}', 'topMiddle', 'bottomMiddle');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 60 && $queryString == "page=fleetStep2"}
	<script type="text/javascript">
	$(function() {
	qtips('#sector_1', '{$LNG.tutorial_metal_147}', 'topMidle', 'bottomMiddle');
	qtips('.bottom_band_submit ', '{$LNG.tutorial_metal_135}', 'topMiddle', 'bottomRight');
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == 61}
	<script type="text/javascript">
	$(function() {
	if($("div").is("#fool_conteiner"))setTimeout(function() { location.reload(); }, 10000);
	qtip_modal('{$LNG.tutorial_metal_15}', '{$LNG.tutorial_metal_148}', '{$LNG.tutorial_close_info}', 450);
	setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	{if $bodyclass != "popup" && $tutorial == -1} 
	{if $sawfb == 0}
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.12&appId=1765396350383118&autoLogAppEvents=1';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<script type="text/javascript">
	$(function() {
		qtip_modal('{$LNG.facebook_l_1}', '<div class="fb-page" data-href="https://www.facebook.com/warofgalaxyz" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/warofgalaxyz" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/warofgalaxyz">War Of Galaxyz</a></blockquote></div><p align="center"><font color=#4682B4 size="3">{$LNG.facebook_l_2}</p></font> <br><a href="https://www.facebook.com/warofgalaxyz/" target="_blank"><b><p align="center"><font color=#B22222 size="2">>>>{$LNG.facebook_l_3}<<<</p></font></a></b>', '{$LNG.facebook_l_4}', 450);
	});
	</script>
	{/if}
	
	{if $sawminially == 0 && $total_pointsUse >= 100000} 
	<script type="text/javascript">
	$(function() {
		qtip_modal('{$LNG.alliance_xterium_ivite3}', '<img src="//www.rcicd.org/pub/entity/RC_SubSection/108/img/2.gif" style="width:100%;float:left;" alt="Альянс развития"><p align="center"><font color=#4682B4 size="3">{$LNG.alliance_xterium_ivite2}</p></font> <br><a href="//play.warofgalaxyz.com/game.php?page=alliance&mode=info&id={$xteriumAllyIdAbstra}"><b><p align="center"><font color=#B22222 size="2">>>>{$LNG.alliance_xterium_ivite1}<<<</p></font></a></b>', '{$LNG.facebook_l_4}', 450);
setInterval(function() { AJAX() }, 3000);
	});
	</script>
	{/if}
	
	<script type="text/javascript">
	$(function() {
	setInterval(function() { AJAX() }, 3000);
	{$execscript}
	});
	</script>
	{/if}