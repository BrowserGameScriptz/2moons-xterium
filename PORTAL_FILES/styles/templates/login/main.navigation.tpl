{if $ShowMode == 0}<div id="top_main">

    <div id="top_main_bg">
        <a class="a_home" href="/"></a>
        <div class="top_main_separator"></div>                
        <div style="display: none;" id="scroller"><div class="top_main_separator"></div></div>   
		
		{if $ShowUser == 0}
		        <div id="top_main_body">
            <a class="top_main_big_link" href="//forum.{$my_game_url}/" target="_blank">{$LNG.main_nav_1}</a>

			
			<select onChange="window.location.href=this.value" class="sel_uni_top" style="width:80px;float: right;margin-top: 8px;">
			{foreach $languages as $langKey => $langName}
    <option value="javascript:setLNG('{$langKey}')" {if $langKey == $choosen_lang}selected="selected"{/if} >{$langName}</option>
  {/foreach}
</select>


            <div id="top_main_body_form">
            <a class="top_main_mini_link" style="width:90px;line-height: 27px; " href="../index.php?page=register" style="line-height:27px;">{$LNG.main_nav_3}</a>                    
            <form method="POST" action="../index.php?page=login">
                <input placeholder="{$LNG.main_nav_4}/{$LNG.lobby_2}" required="" class="top_main_itext" name="username" value="" type="text">
                <input placeholder="{$LNG.main_nav_5}" class="top_main_itext" required="" name="password" value="" type="password">             
                <input name="submit" class="top_main_button_mini" value="{$LNG.main_nav_6}" type="submit">                    
            </form>
			<input name="buttonFb" class="top_main_button_mini" value="Facebook Login" type="button" onclick="fb_connect();"> 
            </div>

        </div>
            {else}
			<div id="top_main_body">
            <a class="top_main_big_link" href="//forum.{$my_game_url}/" target="_blank">{$LNG.main_nav_1}</a>
            <div class="top_main_separator"></div> 
			<a class="top_main_mini_link" href="../index.php?page=lobby" style="padding-top:5px;">{$LNG.lobby_25}</a>  
            <div class="top_main_separator"></div>   
            <div id="top_main_body_form" style="float:left; margin:0;">
            <form method="POST" id="formId" action="../index.php?page=ingame">
			<input type="hidden" value="{$encodage}" name="encoding">
                <label class="top_main_label">{$userName}</label>
				<select id="universe" class="sel_uni_top" name="universe">
				<option  value="wog">#WOG 1</option>
				<option  value="wog2">#WOG 2</option>
				
				</select>                       
                <input type="submit" name="submit" class="top_main_button_mini" value="{$LNG.lobby_27}">                    
            </form>      
            </div> 
<div class="top_main_separator" style="margin-left:30px;"></div>  			
            <a class="top_main_mini_link" href="../index.php?page=logout" style="float:right; line-height:40px;">{$LNG.lobby_26}</a>
            <div class="top_main_separator" style="float:right;"></div>  
            <select onChange="window.location.href=this.value" class="sel_uni_top" style="width:80px;margin-top: 8px; margin-left:20px;;">
			{foreach $languages as $langKey => $langName}
				<option value="javascript:setLNG('{$langKey}')" {if $langKey == $choosen_lang}selected="selected"{/if} >{$langName}</option>
			{/foreach}
			</select>

        </div>           
			{/if}
        </div>
    </div>

          
		<div id="header2">
        	<div class="body">
            	<a href="/" class="logo"><img class="logo" src="//static.{$my_game_url}/media/images/xterium_logo.png" width="570" height="222" title="War Of Galaxyz" alt="War Of Galaxyz Logo"></a>
            	<div class="clear"></div>
            </div>
        	<div class="clear"></div>
        </div><!--/header-->
		{else}
		<div id="header">
        	<div class="body">
            	<a href="/" class="logo"><img class="logo" src="//static.{$my_game_url}/media/images/xterium_logo.png" title="War Of Galaxyz" alt="War Of Galaxyz Logo"></a>
                <h1>{$LNG.promo_17}</h1>
                <a href="../index.php?page=register" class="button">{$LNG.promo_18}</a>
            	<div class="clear"></div>
            </div>
        	<div class="clear"></div>
        </div><!--/header-->     
		{/if}
        
        <div class="transformation_block_top"></div>
        <div class="block_light">
        	<div class="body">
            	<div id="menu">
    <ul>        
        			<li class="active"><a href="/">{$LNG.main_nav_8}</a></li> 
					<li class=""><a href="../index.php?page=promo">{$LNG.main_nav_9}</a></li> 
					<li class=""><a href="//forum.{$my_game_url}/">{$LNG.main_nav_10}</a></li> 
					<li class=""><a href="../index.php?page=LostPassword">{$LNG.main_nav_7}</a></li> 
		        <li class="play"><a {if $ShowUser == 0}href="../index.php?page=register"{else}href="../index.php?page=ingame"{/if}>{$registerLink}</a></li>
    </ul>
</div><!--/menu-->
<div class="clear">


            
			
			