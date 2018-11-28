{block name="title" prepend}{$LNG.siteTitleIndex}{/block}
{block name="content"}
<div class="clear"></div>
                <div id="news_more">
                	<div id="latest_articles" class="left">       
                		<h4>{$LNG.main_nav_29}</h4>   
    {foreach $newsList as $NewsRow}                 
    <div class="latest_articles_item">        
      	<a href="../index.php?page=news&id={$NewsRow.id}" class="img_latest_articles">
			                    <img src="img/news/{$NewsRow.catId}.jpg" alt="{$NewsRow.title}  ">
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
<form action="../index.php?page=news" method="post" id="form">
<input type="hidden" name="side" value="{$page}" id="side">
                        <div class="navigation">
    <div class="page-navigator">
        {if $page != 1}<span class="prev"><a href="../index.php?page=news&side={$site - 1}"></a></span>{/if}
		{for $site=1 to $maxPage}
		{if $page == $site}<span class="active">{/if}<a href="../index.php?page=news&side={$site}">{$site}</a>{if $page == $site}</span>{/if}
		{/for}
		
		        {if $page != $maxPage}<span class="next"><a href="../index.php?page=news&side={$site + 1}"></a></span>{/if}
    </div>
    <div class="clear"></div>
</div>  </form>
                    	<div class="clear"></div>
                	</div>
{/block}
{block name="script" append}
<script>{if $code}alert({$code|json});{/if}</script>
{/block}