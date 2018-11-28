{block name="title" prepend}{$LNG.ref_system}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
       {$LNG.ref_link} 

<div class="gr_btn_top" style="float:right;margin-right: 10px;">
        	<a href="game.php?page=refsystem&amp;mode=refs" title="Your inventory">{$LNG.ref_yours}</a>
       		
        </div>	   
    </div> 
    <table class="tablesorter ally_ranks">
        <tbody><tr>
            <td style="text-align:center" colspan="2">
            	{$ref_descrip}
            </td>
        </tr> 
        <tr>
        	<td class="transparent">URL:</td>
            <td class="transparent">
            	<input value="https://warofgalaxyz.com/index.php?page=register&referralID={$userID}" readonly="readonly" style="width:550px;" type="text">
        	</td>
        </tr>      
        <tr>
        	<td colspan="2">
            	<div>
                    <img src="userpic.php?id={$userID}" alt="" id="userpic" height="95" width="590">
                    <br><br>
                    <table style="width:100%;"><tbody><tr><td class="transparent">HTML:</td><td class="transparent">
                        <input value="<a href=&quot;https://warofgalaxyz.com/{if $ref_active}index.php?page=register&referralID={$userID}{/if}&quot;><img src=&quot;https://play.warofgalaxyz.com/userpic.php?id={$userID}&quot;></a>" readonly="readonly" style="width:550px;" type="text">
                    </td></tr>
                    <tr><td class="transparent">BBCode:</td><td class="transparent">
                        <input value="[url=https://warofgalaxyz.com/{if $ref_active}index.php?page=register&referralID={$userID}{/if}][img]https://play.warofgalaxyz.com/userpic.php?id={$userID}[/img][/url]"" readonly="readonly" style="width:550px;" type="text">
                    </td></tr>                
                </tbody></table>
                </div>
            </td>
        </tr>
    </tbody></table>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->

{/block}