{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
    	<span style="float:left; display:block; width:140px;">{$LNG.lm_alliance}</span>
        <div class="search_aly">
            <form action="game.php?page=alliance&amp;mode=search" method="post">
                <input placeholder="{$LNG.al_find_submit}" name="searchtext" value="" type="text"> 
                <input value="{$LNG.al_alliance_search}" type="submit"> 
            </form>        
        </div>
        <a href="game.php?page=alliance&amp;mode=create" class="batn_lincks right_flank plus">{$LNG.all_crea_2}</a>   
    </div>             
	         {foreach $Userlist as $ID => $Alliance}      
	    <div class="ally_img">
    	        <div class="fractions_ico_big">
        {if $Alliance.ally_fraction_id != 0}<img alt="" title="" class="tooltip fraction_ico_mini_t" data-tooltip-content="{$Alliance.ally_fraction_name} ({$Alliance.ally_fraction_level})" src="styles/images/alliance/fraction_{$Alliance.ally_fraction_id}.png">{/if}
		
        </div>
                <table class="no_visible"><tr><td>
        	<a href="game.php?page=alliance&mode=info&id={$ID}">
                <img src="{$Alliance.image}" />            <span class="designation">
                <span>{$Alliance.name} [{$Alliance.tag}]</span><br/>
                {$Alliance.ally_members} {$LNG.all_partici} {$LNG.ov_of} {$Alliance.ally_max_members}
            </span>
            </a>
        </td></tr></table>                            
    </div> 
{/foreach}	
	</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}