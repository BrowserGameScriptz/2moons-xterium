</div>
            </div>
			<div id="game_stat" class="right">
    <h3>{$LNG.main_nav_21}</h3>
    {$LNG.main_nav_22}: <span>{$AllPlayers}</span><br>
    {$LNG.main_nav_23}: <span>{$AllMonth}</span><br>
	{$LNG.main_nav_24}: <span>{$AllDay}</span><br>
   	{$LNG.main_nav_22} online: <span>{$AllActive}</span>   
</div> 
               	<div id="fresh_forum" class="right">
    <h3>{$LNG.main_nav_26}</h3>
    	{foreach $AllTopics as $topicsRow}
	<a title="" href="http://forum.{$my_game_url}/topic/{$topicsRow.id}-{$topicsRow.title_seo}/" target="_blank">
		{$topicsRow.title}<br>
    	<span>{$topicsRow.date}</span>
   	</a>   
    	{/foreach}
	
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
<div class="fb-page" data-href="https://www.facebook.com/warofgalaxyz/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/warofgalaxyz/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/warofgalaxyz/">War Of Galaxyz</a></blockquote></div></div>
     </div>
    <div class="clear"></div>
</div><!--fresh_forum-->

   
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