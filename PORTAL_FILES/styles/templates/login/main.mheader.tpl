<html lang="en"><head>
		{*<meta name="google-site-verification" content="p5NItO-NXktSViGM4SaQ8JdEYgewuVslc3LZ02yiJps">
		<meta name="google-site-verification" content="oCeBTydeiMxZi8cLFdEF7-IzZ3FhBcoklIQMXq__Bfk">*}
		<meta name="msvalidate.01" content="CB06DFA12CAEECB50608780CA7249728" />
        <meta property="og:image" content="images/social.jpg">
       
	<base href="//www.{$my_game_url}/media/">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>{block name="title"}{/block}</title>
	<meta name="description" content="{$LNG.main_nav_30}">
	<meta name="keywords" content="{$LNG.main_nav_31}">		
	<meta name="author" content="War Of Galaxyz Productions Inc" />
    <meta name="publisher" content="War Of Galaxyz Productions Inc" />
    <meta name="copyright" content="War Of Galaxyz Productions Inc" /> 
    <meta name="audience" content="all" />
    <meta name="Expires" content="never" />
    <meta name="robots" content="index,follow" />
    <meta name="Revisit" content="After 14 days" />
	<meta name="viewport" content="width=370, maximum-scale=1.0">
	<meta name="MobileOptimized" content="370">
	<meta name="HandheldFriendly" content="true">
	<link type="image/x-icon" href="images/favicon.ico" rel="shortcut icon">
	<link href="//static.{$my_game_url}/media/css/style.css" rel="stylesheet" type="text/css">      
	<link href="//static.{$my_game_url}/media/css/login.css" rel="stylesheet" type="text/css">      
    <link rel="image_src" href="//forum.{$my_game_url}/public/style_images/master/meta_image.png">
	
	<script type="text/javascript" src="//static.{$my_game_url}/media/js/jquery.js"></script> 
	<script type="text/javascript" src="//static.{$my_game_url}/media/js/jquery.cookie.js"></script> 
	<script src="//static.{$my_game_url}/media/js/ajax.js" type="text/javascript"></script> 
	<script src="//static.{$my_game_url}/media/js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="//static.{$my_game_url}/media/js/validate.min.js" type="text/javascript"></script>
	<script src="//static.{$my_game_url}/media/js/main.js" type="text/javascript"></script>            
	
	<script src="https://clientcdn.pushengage.com/core/8553.js"></script>
	<script>
		_pe.subscribe();
	</script>
		<script>{if isset($code)}var loginError = {$code|json};{/if}</script>
		{block name="script"}{/block}	

{if $ShowMode == 1}		
 <script type="text/javascript">
			$(function(){
				$(window).scroll(function() {
					var top = $(document).scrollTop();
					if (top < 540) 
							$("#menu").css({ top: '0', position: 'relative' });
					else 
						{
							$("#menu").css({ top: '0', position: 'fixed' });
							$(".play").css({ background:'#72279b' , display:'block' });
									  
						}
				});
			});
		</script>		
        {/if}
        <script type="text/javascript">
					$(document).ready(function(){
				$(window).scroll(function () { if ($(this).scrollTop() > 0) { $('#scroller').fadeIn(); } else { $('#scroller').fadeOut(); } });
				$('#scroller').click(function () { $('body,html').animate({ scrollTop: 0 }, 400); return false; });
			});
		</script>
       
    <meta charset="utf-8">
	</head>
	<body>	
