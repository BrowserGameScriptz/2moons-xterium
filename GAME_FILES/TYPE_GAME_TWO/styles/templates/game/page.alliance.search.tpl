{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
    	<span style="float:left; display:block; width:140px;">{$LNG.al_find_alliances}</span>
        <div class="search_aly">
            <form action="game.php?page=alliance&amp;mode=search" method="post">
                <input placeholder="{$LNG.al_find_submit}" name="searchtext" value="{$searchText}" type="text"> 
                <input value="{$LNG.al_alliance_search}" type="submit"> 
            </form>     
        </div>
        <a href="game.php?page=alliance&amp;mode=create" class="batn_lincks right_flank plus">{$LNG.all_crea_2}</a>   
    </div>             
	  
	 
	  {foreach $searchList as $seachRow}
	    <div class="ally_img">
		{if $userID == 1}
		<div class="fractions_ico_big">
        	<img alt="" title="" class="tooltip" data-tooltip-content="
            Сентери Уровень 19
            <div style='border-bottom:1px dashed #666; margin:7px 0 4px 0;'></div>
                    	       		        	        		Броня: 
        		<span style='color:#0F6'>47.5%</span><br />
                   		        	        		Щиты: 
        		<span style='color:#0F6'>47.5%</span><br />
                   		        	        		Вооружение [<span style='color:#F93;'>при атаке</span>]: 
        		<span style='color:#F33'>-47.5%</span><br />
                   		        	       		        	       		        	       		        	        		Броня [<span style='color:#09F;'>при обороне</span>]: 
        		<span style='color:#0F6'>47.5%</span><br />
                   		        	        		Щиты [<span style='color:#09F;'>при обороне</span>]: 
        		<span style='color:#0F6'>47.5%</span><br />
                   		        	       		        	       		        	        		Грузоподъёмность флота: 
        		<span style='color:#F33'>-28.5%</span><br />
                   		        	        		Потребление топлива: 
        		<span style='color:#0F6'>19%</span><br />
                   		        	       		        	        		Минимальный шанс активации апгрейда: 
        		<span style='color:#0F6'>2.85%</span><br />
                   		        	       		        	       		        	       		        	       		        	       		        	        		Получаемый боевой опыт в экспедиции: 
        		<span style='color:#0F6'>47.5%</span><br />
                   		        	        		Получаемые очки альянса: 
        		<span style='color:#0F6'>95%</span><br />
                   		        	       		        	       		        	       		        	       		        	       		        	       		        	       		        	       		            " src="styles/images/alliance/fraction_2.png">
        </div>
		{/if}
        <table class="no_visible"><tbody><tr><td>
        	<a href="game.php?page=alliance&amp;mode=apply&amp;id={$seachRow.id}">
			<img src="{$seachRow.ally_image}">
                            <span class="designation">
                <span>{$seachRow.name} [{$seachRow.tag}]</span><br>
                {$seachRow.members}
            </span>
            </a>
        </td></tr></tbody></table>                            
    </div>  
{foreachelse}
{/foreach}
	
	</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}