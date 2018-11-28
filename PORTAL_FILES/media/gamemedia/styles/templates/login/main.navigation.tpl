{if $ShowMode == 0}<div id="top_main">

    <div id="top_main_bg">
        <a class="a_home" href="/"></a>
        <div class="top_main_separator"></div>                
        <div style="display: none;" id="scroller"><div class="top_main_separator"></div></div>   
		
		        <div id="top_main_body">
            <a class="top_main_big_link" href="//forum.xterium.space/" target="_blank">{$LNG.main_nav_1}</a>
			{foreach $languages as $langKey => $langName}
            <a href="javascript:setLNG('{$langKey}')" hreflang="{$langKey}" title="{$langName}" style="float:right;margin-top:15px;"><img src="images/{$langKey}.png" alt="{$langKey}" width="16px" height="16px"></a>
			{/foreach}
            <div id="top_main_body_form">
            <a class="top_main_mini_link" href="../index.php?page=register" style="line-height:27px;">{$LNG.main_nav_3}</a>                    
            <form method="POST" action="../index.php?page=login">
                <input placeholder="{$LNG.main_nav_4}" required="" class="top_main_itext" name="username" value="" type="text">
                <input placeholder="{$LNG.main_nav_5}" class="top_main_itext" required="" name="password" value="" type="password">             
                <input name="submit" class="top_main_button_mini" value="{$LNG.main_nav_6}" type="submit">                    
            </form>
            <a class="top_main_mini_link" href="../index.php?page=LostPassword" style="float:right;">{$LNG.main_nav_7}</a>
            </div>
        </div>
                           
        </div>
    </div>

          
		<div id="header2">
        	<div class="body">
            	<a href="/" class="logo"><img class="logo" src="images/xterium_logo.png" title="Xterium"></a>
            	<div class="clear"></div>
            </div>
        	<div class="clear"></div>
        </div><!--/header-->
		{else}
		<div id="header">
        	<div class="body">
            	<a href="/" class="logo"><img class="logo" src="images/xterium_logo.png" alt="Logo" title="Xterium"></a>
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
					<li class=""><a href="//forum.xterium.space/">{$LNG.main_nav_10}</a></li> 
					<li class=""><a href="//wiki.xterium.space/">{$LNG.main_nav_11}</a></li> 
		        <li class="play"><a href="../index.php?page=register">{$LNG.main_nav_12}</a></li>
    </ul>
</div><!--/menu-->
<div class="clear">


            
			
			