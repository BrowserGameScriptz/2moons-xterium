{block name="title" prepend}{$LNG.lobby_1}{/block}
{block name="content"}
<div class="body">
                
             	<h1 class="top_title">{$LNG.lobby_1}</h1>
<div class="confid confid_personal">
    {$LNG.lobby_2}: <span>{$AccountInfo.username}</span> <br/>          
    {$LNG.lobby_3}: <span>{$AccountInfo.email}</span> <br/> 
    </div>
<div class="clear"></div>
<div id="personal">
	<div class="personal_box" style="margin-right:100px;">
    	<h3>{$LNG.lobby_4}</h3>
        <div class="personal_box_text">
        	{$LNG.lobby_5}
        </div>
        <a class="latest_articles_button" href="../index.php?page=changepass">{$LNG.lobby_6}</a>
    </div>
        <div class="personal_box">
    	<h3>{$LNG.lobby_7}</h3>
        <div class="personal_box_text">
        	{$LNG.lobby_8}
        </div>
        <a class="latest_articles_button" href="../index.php?page=changemail">{$LNG.lobby_9}</a>
    </div>
	{*
    <div class="personal_box" style="margin-right:100px;">
    	<h3>{$LNG.lobby_10}</h3>
        <div class="personal_box_text">
        	{$LNG.lobby_11}
        </div>
        <a class="latest_articles_button" href="/users/fixemail">{$LNG.lobby_12}</a>
    </div>
	*}
      <div class="clear"></div> 
</div>                    
               	
             </div>  
            <div class="clear"></div>
		</div><!--/block_light-->
{/block}
