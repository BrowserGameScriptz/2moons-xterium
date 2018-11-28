<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="{$userLangs}" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="{$userLangs}" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="{$userLangs}" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="{$userLangs}" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="{$userLangs}" class="no-js"> <!--<![endif]-->
<head>
	<title>{block name="title"} - {$game_name}{/block}</title>
	<meta name="viewport" content="width=1000, user-scalable=yes" />
    <meta name="MobileOptimized" content="1000"/>
	<meta name="HandheldFriendly" content="true"/>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	{if $queryString != "page=chat"}
		<meta http-equiv="Language" content="{$userLangs}"/>
		<meta name="WOG-version" content="4.0.13"/>
		<meta name="WOG-timestamp" content="{$TIME}"/>
		<meta name="WOG-universe" content="{$uni_name}"/>
		<meta name="WOG-universe-name" content="{$uni_name}"/>
		<meta name="WOG-universe-speed" content="{$game_speeds}"/>
		<meta name="WOG-universe-speed-fleet" content="{$fleet_speeds}"/>
		<meta name="WOG-language" content="{$userLangs}"/>
		<meta name="WOG-player-id" content="{$userID}"/>
		<meta name="WOG-player-name" content="{$metausername}"/>
		<meta name="WOG-alliance-id" content="{$meta_allyId}"/>
		<meta name="WOG-alliance-name" content="{$meta_allyName}"/>
		<meta name="WOG-alliance-tag" content="{$meta_allyTag}"/>
		<meta name="WOG-planet-id" content="{$current_pid}"/>
		<meta name="WOG-planet-name" content="{$planetName}"/>
		<meta name="WOG-planet-coordinates" content="{$planetGalaxy}:{$planetSystem}:{$planetPlanet}"/>
		<meta name="WOG-planet-type" content="{$metal_planetty}"/>
	{/if}
	<link rel="stylesheet" type="text/css" href="//static.warofgalayxz.com/gamemedia/styles/css/boilerplate.css?{$REV}">
	<link rel="stylesheet" type="text/css" href="//static.warofgalayxz.com/gamemedia/styles/css/jquery.css?{$REV}">
  	<link rel="stylesheet" type="text/css" href="//static.warofgalayxz.com/gamemedia/styles/css/jquery.fancybox.css?{$REV}">
	<link rel="stylesheet" type="text/css" href="//static.warofgalayxz.com/gamemedia/styles/theme/gow/formate.css?{$REV}">
    <link rel="stylesheet" type="text/css" href="//static.warofgalayxz.com/gamemedia/styles/css/ingame.css?{$REV}">
    <link rel="stylesheet" type="text/css" href="//static.warofgalayxz.com/gamemedia/styles/css/style.css?{$REV}">
	<link rel="stylesheet" type="text/css" href="//static.warofgalayxz.com/gamemedia/styles/css/chat.css?{$REV}">
    <link rel="stylesheet" type="text/css" href="//static.warofgalayxz.com/gamemedia/styles/css/responsive.css?{$REV}">
	<link rel="shortcut icon" href="./favicon.png" type="image/x-icon">
    <!--ij-->

	<script type="text/javascript">
		var ServerTimezoneOffset = {$Offset};
		var serverTime 	= new Date({$date.0}, {$date.1 - 1}, {$date.2}, {$date.3}, {$date.4}, {$date.5});
		var startTime	= serverTime.getTime();
		var localTime 	= serverTime;
		var localTS 	= startTime;
		var Gamename	= document.title;
		var Ready		= "{$LNG.ready}";
		var Skin		= "{$dpath}";
		var Lang		= "{$lang}";
		var head_info	= "{$LNG.fcm_info}";
		var auth		= {$authlevel|default:'0'};
		var days 		= {$LNG.week_day|json|default:'[]'} 
		var months 		= {$LNG.months|json|default:'[]'} ;
		var tdformat	= "{$LNG.js_tdformat}";
		var queryString	= "{$queryString|escape:'javascript'}";
		var isPlayerCardActive	= "{$isPlayerCardActive|json}";
		var miniChat	= 2;
		var bodyclass	= "{$bodyclass}";
	
		setInterval(function() {
			serverTime.setSeconds(serverTime.getSeconds()+1);
		}, 1000);
	</script>
	<script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/base/jquery.js?{$REV}"></script>
	<script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/base/jquery.ui.js?{$REV}"></script>
	<script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/base/jquery.cookie.js?{$REV}"></script>
    <script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/base/jquery.fancybox.js?{$REV}"></script>
	<script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/base/tooltip.js?{$REV}"></script>
	<script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/framework/keypress-2.1.4.min.js?{$REV}"></script>
	<script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/game/base.js?{$REV}"></script>
	<script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/game/humanize.min.js?{$REV}"></script>
    <script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/game/overview.js?{$REV}"></script>
	{*<script type="text/javascript">
    var adblock = true;
	</script>
    <script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/game/ads.js?{$REV}"></script>
	<script type="text/javascript">
		if(adblock) {
			 adBlockDetected();
		} else {
			adBlockNotDetected();
		}
	</script>*}
	<script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/game/qtip.js?{$REV}"></script>
	<script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/game/topnav.js?{$REV}"></script>
	<script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/game/json.js?{$REV}"></script>
	<script charset="UTF-8" type="text/javascript" src="//static.warofgalayxz.com/gamemediamedia/js/alertify.min.js?{$REV}"></script>

	{foreach item=scriptname from=$scripts}
	<script type="text/javascript" src="//static.warofgalayxz.com/gamemedia/scripts/game/{$scriptname}.js?v={$REV}"></script>
	{/foreach}
	{block name="script"}{/block}
		
	{include file='main.topnav.addition.tpl'}
	
    <!--oj-->
    <script type="text/javascript">
		$(document).ready(function(){
			var flag_planet_menu = false;
			$('#planet_select').click(function(){ 
				$(this).toggleClass('active');
				$('#list_palnet').stop(false,false).slideToggle(300);
				flag_planet_menu = true;
			});		
			if(flag_planet_menu)
			{					
				document.body.onclick = function (e) {
					e = e || event;
					target = e.target || e.srcElement;
					if (target.id == "planet_select") {
						return;
					} else {
						$('#list_palnet').hide();
						$('#planet_select').removeClass('active');
						flag_planet_menu = false;
					}
				}
			}
			$('.urlpalnet').click( function(){
				document.location = '?'+queryString+'&'+$(this).attr("url");
			});		
			
			var listener = new window.keypress.Listener();
			listener.simple_combo("shift left", function() {
				eval('location=\''+document.getElementById('lstPlaneta').options[document.getElementById('lstPlaneta').selectedIndex-1].value+'\'');
				console.log("You pressed shift and left");
			});
			listener.simple_combo("shift right", function() {
				eval('location=\''+document.getElementById('lstPlaneta').options[document.getElementById('lstPlaneta').selectedIndex+1].value+'\'');
				console.log("You pressed shift and right");
			});
		});
	</script>
		{if $userID == 458} 
			<script type="text/javascript"> 
				window.smartlook||(function(d) {
				var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
				var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
				c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
				})(document);
				smartlook('init', '5ce34ba240911a3717b00770a1a61e02aef7750d');
				smartlook('tag', 'name', '{$metausername}');
			</script>
		{/if}
    </head>
<body id="{$smarty.get.page|htmlspecialchars|default:'overview'}" class="{$bodyclass}">
<div id="tooltip" class="tip"></div>