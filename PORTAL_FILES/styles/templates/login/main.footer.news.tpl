
	<div class="right">
                    	<div id="latest_articles">
    <h3>{$LNG.main_nav_32}</h3>

	{foreach $AllNews as $NewsRow}  
	    <div class="latest_articles_item">
      	<a href="../index.php?page=news&id={$NewsRow.id}" class="img_latest_articles img_latest_articles_smal">
			                    <img src="img/news/{$NewsRow.catId}.jpg" alt="{$NewsRow.title}">
                    </a>
        <div class="left">
        	<a href="../index.php?page=news&id={$NewsRow.id}">{$NewsRow.title}</a>
            <span class="date">{$NewsRow.date}</span>                              
        </div>
        <div class="clear"></div>
    </div>  
{/foreach}
	
		<a href="../index.php?page=news" class="latest_articles_button">{$LNG.main_nav_28}</a>
    <div class="clear"></div>
</div><!--latest_articles-->
               	<div id="fresh_forum" class="right">
    
	
        <a title="" href="http://forum.{$my_game_url}/" class="latest_articles_button" target="_blank">{$LNG.main_nav_27}</a> 
    <div class="clear"></div>
    <br>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5&appId=1433738693595658";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <div id="fb-root">
<div class="fb-page" data-href="https://www.facebook.com/XteriumTheGame" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/XteriumTheGame"><a href="https://www.facebook.com/XteriumTheGame">War Of Galaxyz : The Game</a></blockquote></div></div>
     </div>
    <div class="clear"></div>
</div><!--fresh_forum-->

   			</div>			</div>			</div>
             </div>  
            <div class="clear"></div>
		</div><!--/block_light-->
        <div class="transformation_block"></div>
        <div class="bg_dark">
	<div id="footer">
			<div class="left_part">
			<div class="block">
				<span>{$LNG.main_nav_18}</span> 
				<a href="../index.php?page=register">{$LNG.main_nav_13}</a><br> 
				<a href="../index.php?page=rules">{$LNG.siteTitleRules}</a><br> 
				<a href="../index.php?page=news">{$LNG.main_nav_14}</a><br>
				<a href="../index.php?page=promo">{$LNG.main_nav_9}</a>
			</div>  
			<div class="block">
				<span>{$LNG.main_nav_19}</span> 
				<a href="../index.php?page=register">{$LNG.main_nav_15}</a><br> 
				<a href="../index.php?page=LostPassword">{$LNG.main_nav_7}</a><br> 
				<a href="../index.php?page=agreement">{$LNG.main_nav_16}</a>
			</div>
			<div class="block">
				<span>{$LNG.main_nav_20}</span> 
				<a href="//forum.{$my_game_url}">{$LNG.main_nav_10}</a><br> 
				<a href="../index.php?page=disclamer">{$LNG.siteTitleDisclamer}</a> <br>
				<a href="../sitemap.html">Sitemap</a> <br>
				
			</div> 
			<div class="clear"></div>
		</div>
		
		<div class="right_part">
			© 2016-2018 War Of Galaxyz {$LNG.main_nav_17}
			{*<br><br>
			<a class="imag" href="//www.sawen.net/" target="_blank">
				<img src="https://blog.infinite-rpg.fr/wp-content/uploads/2014/01/sawen.png" alt="http://www.sawen.net/" width="120px">
			</a>*}

        
<div class="share_footer">

</div>
		 </div>
		<div class="clear"></div>
			</div>
</div><!--/footer-->

        
        
         
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-44438409-12"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){ dataLayer.push(arguments); }
  gtag('js', new Date());

  gtag('config', 'UA-44438409-12');
</script>

</body></html>