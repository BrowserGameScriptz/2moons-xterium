<!DOCTYPE html>
<html lang="{$choosen_lang}"><head>
		
    <meta property="og:image" content="//static.{$my_game_url}/media/images/social.jpg">
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
	<link type="image/x-icon" href="//static.{$my_game_url}/media/images/favicon.ico" rel="shortcut icon">
	<link href="//static.{$my_game_url}/media/css/style.css" rel="stylesheet" type="text/css">      
	<!-- Include Print CSS -->
	<link rel="stylesheet" href="//static.{$my_game_url}/media/css/print.css" type="text/css" media="print" />

    <link rel="image_src" href="//forum.{$my_game_url}/public/style_images/master/meta_image.png">
        
                
		<script charset="UTF-8" type="text/javascript" src="//static.{$my_game_url}/media/js/jquery.js"></script> 
		<script charset="UTF-8" type="text/javascript" src="//static.{$my_game_url}/media/js/jquery.cookie.js"></script> 
        {*<script charset="UTF-8" src="//static.{$my_game_url}/media/js/ajax.js" type="text/javascript"></script>*}
        <script charset="UTF-8" src="//static.{$my_game_url}/media/js/jquery-1.7.1.min.js" type="text/javascript"></script>
		<script charset="UTF-8" src="//static.{$my_game_url}/media/js/validate.min.js" type="text/javascript"></script>
        <script charset="UTF-8" src="//static.{$my_game_url}/media/js/main.js" type="text/javascript"></script>       
		
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
	<script>
	  window.fbAsyncInit = function() {
		FB.init({
		  appId      : '571438136572048',
		  cookie     : true,
		  xfbml      : true,
		  version    : 'v2.12'
		});
		  
		FB.AppEvents.logPageView();   
		  
	  };

	  (function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) { return; }
		 js = d.createElement(s); js.id = id;
		 js.src = "https://connect.facebook.net/en_US/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>
	<input type="hidden" id="facebook_token" name="facebook_token" value="">
	<input type="hidden" id="facebook_userId" name="facebook_userId" value="">
