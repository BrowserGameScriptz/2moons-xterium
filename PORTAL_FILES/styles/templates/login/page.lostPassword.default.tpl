{block name="title" prepend}{$LNG.siteTitleLostPassword}{/block}
{block name="content"}
<div class="body">
                
             		<h1 class="top_title"></h1>
	<form method="POST" action="../index.php?page=lostPassword" method="post" data-action="../index.php?page=lostPassword">
	<input type="hidden" value="send" name="mode">
            <div class="blocks">
            <span class="lable">{$LNG.lost_pass_1} :</span>
            <input name="email" value="" type="text">
              <div id="regemailcption" class="reg_caption">
         	  {$LNG.lost_pass_2}      		  </div>
      	    </div>
     	    <div class="clear"></div>
   			<span class="lable"></span>
    	    <input class="button" value="{$LNG.lost_pass_3}" name="submit1" type="submit"> 
     	    <div class="clear"></div> 
    </form>
                    
               	
             </div>  
            <div class="clear"></div>
		</div><!--/block_light-->
{/block}
