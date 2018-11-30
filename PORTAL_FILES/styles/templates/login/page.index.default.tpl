{block name="title" prepend}{$LNG.siteTitleIndex}{/block}
{block name="content"}

   <div id="news_bock">
   
            {*		<div class="body">
				
		
    {foreach $AllTopNews as $NewsRow}      
    <div class="news">
        <a href="{$NewsRow.forum}" class="img_news">
                                <img src="//static.{$my_game_url}/media/gamemedia/media/img/news/{$NewsRow.catId}.jpg" style="width:100%;" alt="{$NewsRow.title} ">
                    </a>
        <a href="../index.php?page=news&id={$NewsRow.id}">{$NewsRow.title} </a>
        <div class="news_information"><p>{$NewsRow.text}</p></div>
        <span class="data_news">{$NewsRow.date}</span>
        <div class="clear"></div>
    </div>
    <div class="line{$NewsRow.ilvl}"></div>   
	{/foreach}
    <div class="clear"></div>
	

</div>*}


<div class="news_bottom_bg" style="text-align:center;color:red;">

</div>
            		<br>
					
   
             </div> <!--/news_bock-->  
               
             <div class="body">
                <div id="latest_articles" class="left">
                    <h3>{$LNG.main_nav_29}</h3>
      {foreach $AllNews as $NewsRow}                 
    <div class="latest_articles_item">        
      	<a href="../index.php?page=news&id={$NewsRow.id}" class="img_latest_articles">
			                    <img src="//static.{$my_game_url}/media/gamemedia/media/img/news/{$NewsRow.catId}.jpg" width="236px" height="135px" alt="{$NewsRow.title}  ">
                    </a>
        <div class="left">
        	<a href="../index.php?page=news&id={$NewsRow.id}">{$NewsRow.title}  </a>
            <div class="latest_articles_item_p"><p>{$NewsRow.text}</p></div>
            <span class="date">{$NewsRow.date}</span>                              
        </div> 
        <div class="clear"></div>
    </div>    
	{foreachelse}
	 <div class="latest_articles_item">        
      	
 
        <div class="clear"></div>
    </div>    
	{/foreach}
	
                   {if $News != 0} <a href="../index.php?page=news" id="latest_articles_button">{$LNG.main_nav_28}</a>{/if}
                    <div class="clear"></div>
                </div><!--latest_articles-->
{/block}
{block name="script" append}
<script>{if $code}alert({$code|json});{/if}</script>
{/block}