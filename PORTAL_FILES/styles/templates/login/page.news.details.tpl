{block name="title" prepend}#WOG - {$newsSolo.title}{/block}
{block name="content"}
<div class="clear"></div>
                <div id="news_more">
                	<div id="latest_articles" class="left">       
                		<h4>{$newsSolo.title}</h4>
	<span class="data_news">{$newsSolo.date}</span>
    	<p>{$newsSolo.text}&nbsp;</p>   	<br>
		<a id="latest_articles_button" href="{$newsSolo.forum}">{$LNG.form_link}</a>    

                          
                    	<div class="clear"></div>
						
                	</div>
{/block}
{block name="script" append}
<script>{if $code}alert({$code|json});{/if}</script>
{/block}