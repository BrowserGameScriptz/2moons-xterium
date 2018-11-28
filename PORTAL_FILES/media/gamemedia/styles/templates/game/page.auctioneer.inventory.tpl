{block name="title" prepend}Auctioneer{/block}
{block name="content"}

<div id="page">
	<div id="content"> 

<div id="achivment">
    <div class="ach_main_block academy_main_block">
    
        <div id="academy_head" class="gray_stripe">
            {$LNG.auctioneer_25}
            <div class="gr_btn_top"  style="float:right;margin-right: 10px;">
        	<a href="game.php?page=auctioneer">{$LNG.auctioneer_2}</a>
       		
        </div>
        </div>

		<div id="academy" class="ach_main_content">
                            
            <div class="ach_menu">
                <ul>
                    
                    <li class="skils3 active">
                        <a><img src="styles/images/iconav/planets.png" style="margin-right: 15px;"></a>
                    </li>
					
					<li class="skils3 active" style="margin-top:160px;">
                        <a><img src="styles/images/iconav/build.png" style="margin-right: 15px;"></a>
                    </li>
					
					<li class="skils3 active" style="margin-top:160px;">
                        <a><img src="styles/images/iconav/fleet.png" style="margin-right: 15px;"></a>
                    </li>
                  
                </ul>  
            </div> 
			
			
            
         
            <div id="skils3" class="ach_content_box">
            	<div style="float:left; width:100%;">                             
                <div class="ach_content" style="padding-top:7px;">
<div class="clear"></div>
<!-------------------------------VETKAA 3---------------------------------------------------->
<table class="skils">
    <tbody>
    <tr><!--4 lvl-->
        <td class="skils_bg" style="opacity:0.3;{if $itemMetal == 1}{if $ItemTiMeb > 0}opacity:1{/if}{/if}"><a id="skil_1314" {if $auction_item_1 > 0}href="?page=auctioneer&mode=up&itemid=1"{/if} class="skils tooltip" data-tooltip-content=" <table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.1}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.1}</td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.fgf_time}: 1 {$LNG.allian_14}</span></th></tr> </tbody></table>" style="background:url(styles/images/auction/1.gif);"><span class="lvl">{$auction_item_1}</span>{if $itemMetal == 1}{if $ItemTiMeb > 0}<span class="lvlb">{$ItemTiMe}</span>{else}{/if}{else}{/if}</a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg"style="opacity:0.3;{if $itemMetal == 2}{if $ItemTiMeb > 0}opacity:1{/if}{/if}"><a id="skil_1314"{if $auction_item_2 > 0}href="?page=auctioneer&mode=up&itemid=2"{/if} class="skils tooltip" data-tooltip-content=" <table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.2}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.2} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.fgf_time}: 1 {$LNG.allian_14}</span></th></tr> </tbody></table>" style="background:url(styles/images/auction/2.gif);"><span class="lvl">{$auction_item_2}</span>{if $itemMetal == 2}{if $ItemTiMeb > 0}<span class="lvlb">{$ItemTiMe}</span>{else}{/if}{else}{/if}</a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg" style="opacity:0.3;{if $itemMetal == 3}{if $ItemTiMeb > 0}opacity:1{/if}{/if}"><a id="skil_1314"{if $auction_item_3 > 0}href="?page=auctioneer&mode=up&itemid=3"{/if} class="skils tooltip" data-tooltip-content=" <table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.3}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.3} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.fgf_time}: 1 {$LNG.allian_14}</span></th></tr> </tbody></table>" style="background:url(styles/images/auction/3.gif);"><span class="lvl">{$auction_item_3}</span>{if $itemMetal == 3}{if $ItemTiMeb > 0}<span class="lvlb">{$ItemTiMe}</span>{else}{/if}{else}{/if}</a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg" style="opacity:0.3;{if $itemCrystal == 1}{if $ItemTiCrb > 0}opacity:1{/if}{/if}"><a id="skil_1314"{if $auction_item_4 > 0}href="?page=auctioneer&mode=up&itemid=4"{/if} class="skils tooltip" data-tooltip-content=" <table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.4}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.4} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.fgf_time}: 1 {$LNG.allian_14}</span></th></tr> </tbody></table>" style="background:url(styles/images/auction/4.gif);"><span class="lvl">{$auction_item_4}</span>{if $itemCrystal == 1}{if $ItemTiCrb > 0}<span class="lvlb">{$ItemTiCr}</span>{else}{/if}{else}{/if}</a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg" style="opacity:0.3;{if $itemCrystal == 2}{if $ItemTiCrb > 0}opacity:1{/if}{/if}"><a id="skil_1314"{if $auction_item_5 > 0}href="?page=auctioneer&mode=up&itemid=5"{/if} class="skils tooltip" data-tooltip-content=" <table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.5}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.5} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.fgf_time}: 1 {$LNG.allian_14}</span></th></tr> </tbody></table>" style="background:url(styles/images/auction/5.gif);"><span class="lvl">{$auction_item_5}</span>{if $itemCrystal == 2}{if $ItemTiCrb > 0}<span class="lvlb">{$ItemTiCr}</span>{else}{/if}{else}{/if}</a></td>
        <td class="skils_p">&nbsp;</td>              
    </tr>
	<tr><!--perehod 3-4 -->
        <td class="skils_p"></"></td>
        <td class="skils_p">&nbsp;</td>
        <td class="skils_p"></"></td>
        <td class="skils_p">&nbsp;</td>                    
        <td class="skils_p"></"></td>
        <td class="skils_p">&nbsp;</td>
        <td class="skils_p"></"></td>
    </tr>
	 <tr><!--4 lvl-->
        <td class="skils_bg" style="opacity:0.3;{if $itemCrystal == 3}{if $ItemTiCrb > 0}opacity:1{/if}{/if}"><a id="skil_1314"{if $auction_item_6 > 0}href="?page=auctioneer&mode=up&itemid=6"{/if} class="skils tooltip" data-tooltip-content=" <table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.6}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.6} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.fgf_time}: 1 {$LNG.allian_14}</span></th></tr> </tbody></table>" style="background:url(styles/images/auction/6.gif);"><span class="lvl">{$auction_item_6}</span>{if $itemCrystal == 3}{if $ItemTiCrb > 0}<span class="lvlb">{$ItemTiCr}</span>{else}{/if}{else}{/if}</a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg" style="opacity:0.3;{if $itemDeuterium == 1}{if $ItemTiDeb > 0}opacity:1{/if}{/if}"><a id="skil_1314"{if $auction_item_7 > 0}href="?page=auctioneer&mode=up&itemid=7"{/if} class="skils tooltip" data-tooltip-content=" <table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.7}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.7} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.fgf_time}: 1 {$LNG.allian_14}</span></th></tr> </tbody></table>" style="background:url(styles/images/auction/7.gif);"><span class="lvl">{$auction_item_7}</span>{if $itemDeuterium == 1}{if $ItemTiDeb > 0}<span class="lvlb">{$ItemTiDe}</span>{else}{/if}{else}{/if}</a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg" style="opacity:0.3;{if $itemDeuterium == 2}{if $ItemTiDeb > 0}opacity:1{/if}{/if}"><a id="skil_1314"{if $auction_item_8 > 0}href="?page=auctioneer&mode=up&itemid=8"{/if} class="skils tooltip" data-tooltip-content=" <table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.8}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.8} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.fgf_time}: 1 {$LNG.allian_14}</span></th></tr> </tbody></table>" style="background:url(styles/images/auction/8.gif);"><span class="lvl">{$auction_item_8}</span>{if $itemDeuterium == 2}{if $ItemTiDeb > 0}<span class="lvlb">{$ItemTiDe}</span>{else}{/if}{else}{/if}</a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg" style="opacity:0.3;{if $itemDeuterium == 3}{if $ItemTiDeb > 0}opacity:1{/if}{/if}"><a id="skil_1314"{if $auction_item_9 > 0}href="?page=auctioneer&mode=up&itemid=9"{/if} class="skils tooltip" data-tooltip-content=" <table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.9}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.9} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.fgf_time}: 1 {$LNG.allian_14}</span></th></tr> </tbody></table>" style="background:url(styles/images/auction/9.gif);"><span class="lvl">{$auction_item_9}</span>{if $itemDeuterium == 3}{if $ItemTiDeb > 0}<span class="lvlb">{$ItemTiDe}</span>{else}{/if}{else}{/if}</a></td>
        <td class="skils_p">&nbsp;</td>
		 
    </tr>
</tbody></table>                    <div class="clear"></div>               
                </div> <!--/ach_content-->
				
				{*new start here*}
				<div class="ach_content" style="padding-top:7px;">
<div class="clear"></div>
<!-------------------------------VETKAA 3---------------------------------------------------->
<table class="skils">
    <tbody>
    <tr><!--4 lvl-->
        <td class="skils_bg"><a id="skil_1314"{if $auction_item_10 > 0}href="?page=auctioneer&mode=up&itemid=10"{/if} class="skils tooltip" data-tooltip-content=" <table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.10} </td></tr></tbody></table>" style="background:url(styles/images/auction/10.gif);"><span class="lvl">{$auction_item_10}</span></a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg"><a id="skil_1314"{if $auction_item_11 > 0}href="?page=auctioneer&mode=up&itemid=11"{/if} class="skils tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.11}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.11} </td></tr></tbody></table>" style="background:url(styles/images/auction/11.gif);"><span class="lvl">{$auction_item_11}</span></a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg"><a id="skil_1314"{if $auction_item_12 > 0}href="?page=auctioneer&mode=up&itemid=12"{/if} class="skils tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.12}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.12} </td></tr></tbody></table>" style="background:url(styles/images/auction/12.gif);"><span class="lvl">{$auction_item_12}</span></a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg"><a id="skil_1314"{if $auction_item_13 > 0}href="?page=auctioneer&mode=up&itemid=13"{/if} class="skils tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.13}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.13} </td></tr></tbody></table>" style="background:url(styles/images/auction/13.gif);"><span class="lvl">{$auction_item_13}</span></a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg"><a id="skil_1314"{if $auction_item_14 > 0}href="?page=auctioneer&mode=up&itemid=14"{/if} class="skils tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.14}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.14} </td></tr></tbody></table>" style="background:url(styles/images/auction/14.gif);"><span class="lvl">{$auction_item_14}</span></a></td>
        <td class="skils_p">&nbsp;</td>              
    </tr>
	<tr><!--perehod 3-4 -->
        <td class="skils_p"></"></td>
        <td class="skils_p">&nbsp;</td>
        <td class="skils_p"></"></td>
        <td class="skils_p">&nbsp;</td>                    
        <td class="skils_p"></"></td>
        <td class="skils_p">&nbsp;</td>
        <td class="skils_p"></"></td>
    </tr>
	 <tr><!--4 lvl-->
        <td class="skils_bg"><a id="skil_1314"{if $auction_item_15 > 0}href="?page=auctioneer&mode=up&itemid=15"{/if} class="skils tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.15}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.15} </td></tr></tbody></table>" style="background:url(styles/images/auction/15.gif);"><span class="lvl">{$auction_item_15}</span></a></td>
        <td class="skils_p">&nbsp;</td>

    </tr>
</tbody></table>                    <div class="clear"></div>               
                </div> <!--/ach_content-->
				
				
				
				{*new start here*}
				<div class="ach_content" style="padding-top:7px;">
<div class="clear"></div>
<!-------------------------------VETKAA 3---------------------------------------------------->
<table class="skils">
    <tbody>
    <tr><!--4 lvl-->
        <td class="skils_bg"><a id="skil_1314"{if $auction_item_16 > 0}href="?page=auctioneer&mode=up&itemid=16"{/if} class="skils tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.16}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.16} </td></tr></tbody></table>" style="background:url(styles/images/auction/16.gif);"><span class="lvl">{$auction_item_16}</span></a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg"><a id="skil_1314"{if $auction_item_17 > 0}href="?page=auctioneer&mode=up&itemid=17"{/if} class="skils tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.17}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.17} </td></tr></tbody></table>" style="background:url(styles/images/auction/17.gif);"><span class="lvl">{$auction_item_17}</span></a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg"><a id="skil_1314"{if $auction_item_18 > 0}href="?page=auctioneer&mode=up&itemid=18"{/if} class="skils tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.18}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.18} </td></tr></tbody></table>" style="background:url(styles/images/auction/18.gif);"><span class="lvl">{$auction_item_18}</span></a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg"><a id="skil_1314"{if $auction_item_19 > 0}href="?page=auctioneer&mode=up&itemid=19"{/if} class="skils tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.19}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.19} </td></tr></tbody></table>" style="background:url(styles/images/auction/19.gif);"><span class="lvl">{$auction_item_19}</span></a></td>
        <td class="skils_p">&nbsp;</td>
		<td class="skils_bg"><a id="skil_1314"{if $auction_item_20 > 0}href="?page=auctioneer&mode=up&itemid=20"{/if} class="skils tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.20}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.20} </td></tr></tbody></table>" style="background:url(styles/images/auction/20.gif);"><span class="lvl">{$auction_item_20}</span></a></td>
        <td class="skils_p">&nbsp;</td>              
    </tr>
	<tr><!--perehod 3-4 -->
        <td class="skils_p"></"></td>
        <td class="skils_p">&nbsp;</td>
        <td class="skils_p"></"></td>
        <td class="skils_p">&nbsp;</td>                    
        <td class="skils_p"></"></td>
        <td class="skils_p">&nbsp;</td>
        <td class="skils_p"></"></td>
    </tr>
	 <tr><!--4 lvl-->
        <td class="skils_bg"><a id="skil_1314"{if $auction_item_21 > 0}href="?page=auctioneer&mode=up&itemid=21"{/if} class="skils tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 250px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.auctioneer_booster.21}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$LNG.auctioneer_bonus.21} </td></tr></tbody></table>" style="background:url(styles/images/auction/21.gif);"><span class="lvl">{$auction_item_21}</span></a></td>
        <td class="skils_p">&nbsp;</td>
		
    </tr>
</tbody></table>                    <div class="clear"></div>               
                </div> <!--/ach_content-->
				
				
				
                </div>   
                <div style="padding-top:7px;"></div>
                <div class="clear"></div>                               
	 		</div><!--/ach_content_box-->
            
         
            
      
            
        </div><!--/ach_main_content-->
        
    </div><!--/ach_main_block-->
</div><!--/achivment-->  

</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}



