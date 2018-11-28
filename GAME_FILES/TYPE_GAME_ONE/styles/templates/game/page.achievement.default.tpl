{block name="title" prepend}Achievements{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="achivment">
    <div class="ach_main_block">
    
        <div class="ach_head">
            <div class="ach_head_p">{$LNG.achiev_1}</div><!--/ach_head_p-->
            <div class="ach_head_right">
                {$LNG.achiev_2}: <span>{$achievement_point|number}</span>
            </div><!--/ach_head_right-->
        </div><!--/ach_head-->

		<div class="ach_main_content">
                            
            <div class="ach_menu">
                <ul>
                	                    <li class="active">
                        <a href="game.php?page=achievement&amp;group=general">{$LNG.achiev_3}</a>
                    </li>
                                        <li>
                        <a href="game.php?page=achievement&amp;group=daily">{$LNG.achiev_4}</a>
                    </li>
                                        <li>
                        <a href="game.php?page=achievement&amp;group=build">{$LNG.achiev_5}</a>
                    </li>
                                        <li>
                        <a href="game.php?page=achievement&amp;group=tech">{$LNG.achiev_6}</a>
                    </li>
                                        {*    <li>
                        <a href="game.php?page=achievement&amp;group=fleet">{$LNG.achiev_7}</a>
                    </li>
                                        <li>
                        <a href="game.php?page=achievement&amp;group=def">{$LNG.achiev_8}</a>
                    </li>*}
                                        <li>
                        <a href="game.php?page=achievement&amp;group=varia">{$LNG.achiev_9}</a>
                    </li>
                                    </ul>  
            </div> 
            
            <div class="ach_content_box">
            	<div style="float:left; width:100%;">
                               
                <div id="ach_level" class="ach_content">
                	<div class="stars_2">{$achievement_common_1_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'>
            	<tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr>
				<tr><td colspan='2' style='padding: 3px;'>
                {$achievement_common_1_missing}
                </td></tr>
				<tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr>
                <tr>
                	<td style='text-align: right;line-height: 19px;'>
					<img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922}                           
                    </td>
                	<td class='tooltip_class_table_text_left'>
					{$achievement_common_1_next_am}                   
                    </td>
                </tr>
				<tr>
                	<td style='text-align: right;line-height: 19px;'>
					<img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13}                           
                    </td>
                	<td class='tooltip_class_table_text_left'>
					{$achievement_common_1_next_points}                        
                    </td>
                </tr>
				</tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_common_1_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="{$LNG.achiev_14}" src="styles/images/achiev/ach_level.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_common_1} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_15}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_common_1_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_batle_level" class="ach_content">
                	<div class="stars_2">{$achievement_common_2_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'>
            	<tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr>
				<tr><td colspan='2' style='padding: 3px;'>
                {$achievement_common_2_missing}
                </td></tr>
				<tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr>
                <tr>
                	<td style='text-align: right;line-height: 19px;'>
					<img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922}                           
                    </td>
                	<td class='tooltip_class_table_text_left'>
					{$achievement_common_2_next_am}                   
                    </td>
                </tr>
				<tr>
                	<td style='text-align: right;line-height: 19px;'>
					<img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13}                           
                    </td>
                	<td class='tooltip_class_table_text_left'>
					{$achievement_common_2_next_points}                        
                    </td>
                </tr>
				</tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_common_2_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="{$LNG.achiev_21}" src="styles/images/achiev/ach_batle_level.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_common_2} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_22}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_common_2_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		                </div>   
                <div style="padding-top:7px;"></div>
                <div class="clear"></div>   
                            
	 		</div> <!--/ach_content_box-->
            
        </div><!--/ach_main_content-->
        
    </div><!--/ach_main_block-->
</div><!--/achivment-->    
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}