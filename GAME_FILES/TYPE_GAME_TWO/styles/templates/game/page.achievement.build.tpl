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
                	                    <li>
                        <a href="game.php?page=achievement&amp;group=general">{$LNG.achiev_3}</a>
                    </li>
                                        <li>
                        <a href="game.php?page=achievement&amp;group=daily">{$LNG.achiev_4}</a>
                    </li>
                                        <li class="active">
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
                               
                <div id="ach_mine_metal" class="ach_content">
                	<div class="stars_2">{$achievement_build_1_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_build_1_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_1_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_1_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_build_1_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Добытчик металла" src="styles/images/achiev/ach_mine_metal.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_build_1} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_65} </p>   
                        </div>
                		                        <div class="ach_text_need" >
                       <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_build_1_next}</span><br>
                        </p>                                    
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_crystal_mine" class="ach_content">
                	<div class="stars_2">{$achievement_build_2_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_build_2_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_2_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_2_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_build_2_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Добытчик кристалла" src="styles/images/achiev/ach_crystal_mine.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_build_2} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_66}</p>   
                        </div>
                		                        <div class="ach_text_need" >
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_build_2_next}</span><br>
                        </p>                                          
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_deuterium_sintetizer" class="ach_content">
                	<div class="stars_2">{$achievement_build_3_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_build_3_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_3_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_3_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_build_3_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Добытчик дейтерия" src="styles/images/achiev/ach_deuterium_sintetizer.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_build_3} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_67}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_build_3_next}</span><br>
                        </p>                                          
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_conveyor1" class="ach_content">
                	<div class="stars_2">{$achievement_build_4_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_build_4_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_4_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_4_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_build_4_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Легкий конвейер" src="styles/images/achiev/ach_conveyor1.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_build_4} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_68}</p>   
                        </div>
                		                        <div class="ach_text_need">
                       <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_build_4_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_conveyor2" class="ach_content">
                	<div class="stars_2">{$achievement_build_5_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_build_5_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_5_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_5_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_build_5_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Средний конвейер" src="styles/images/achiev/ach_conveyor2.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_build_5} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_69}</p>   
                        </div>
                		                        <div class="ach_text_need" >
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_build_5_next}</span><br>
                        </p>                                             
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_conveyor3" class="ach_content">
                	<div class="stars_2">{$achievement_build_6_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_build_6_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_6_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_6_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_build_6_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Тяжёлый конвейер" src="styles/images/achiev/ach_conveyor3.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_build_6} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_70}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_build_6_next}</span><br>
                        </p>                                         
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_university" class="ach_content">
                	<div class="stars_2">{$achievement_build_7_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_build_7_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_7_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_7_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_build_7_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Технополис" src="styles/images/achiev/ach_university.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_build_7} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_71}</p>   
                        </div>
                		                        <div class="ach_text_need" >
                       <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_build_7_next}</span><br>
                        </p>                                          
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_mondbasis" class="ach_content">
                	<div class="stars_2">{$achievement_build_8_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_build_8_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_8_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_8_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_build_8_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Лунная база" src="styles/images/achiev/ach_mondbasis.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head" >
                            <span>{$achievement_build_8} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_72}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_build_8_next}</span><br>
                        </p>                                       
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_phalanx" class="ach_content">
                	<div class="stars_2">{$achievement_build_9_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_build_9_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_9_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_9_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_build_9_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Сенсорная фаланга" src="styles/images/achiev/ach_phalanx.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_build_9} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_73}</p>   
                        </div>
                		                        <div class="ach_text_need" >
                       <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_build_9_next}</span><br>
                        </p>                                          
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_terraformer" class="ach_content">
                	<div class="stars_2">{$achievement_build_10_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_build_10_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_10_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_build_10_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_build_10_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Терраформер" src="styles/images/achiev/ach_terraformer.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_build_10} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_74}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_build_10_next}</span><br>
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