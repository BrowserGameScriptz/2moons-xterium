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
                                        <li class="active">
                        <a href="game.php?page=achievement&amp;group=varia">{$LNG.achiev_9}</a>
                    </li>
                                    </ul>  
            </div> 
            
            <div class="ach_content_box">
            	<div style="float:left; width:100%;">
                               
                <div id="ach_wons" class="ach_content">
                	<div class="stars_2">{$achievement_varia_1_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_varia_1_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_varia_1_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_varia_1_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_varia_1_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Боец" src="styles/images/achiev/ach_wons.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_varia_1} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_161}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_varia_1_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_destroyer_moons" class="ach_content">
                	<div class="stars_2">{$achievement_varia_2_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_varia_2_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_varia_2_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_varia_2_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_varia_2_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Уничтожитель лун" src="styles/images/achiev/ach_destroyer_moons.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_varia_2} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_162}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_varia_2_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_creation_moons" class="ach_content">
                	<div class="stars_2">{$achievement_varia_3_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_varia_3_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_varia_3_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_varia_3_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_varia_3_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Лунодел" src="styles/images/achiev/ach_creation_moons.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_varia_3} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_163}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_varia_3_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		 {*              
                <div id="ach_wons_em" class="ach_content">
                	<div class="stars_2">{$achievement_varia_4_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}:</span> <br>{$achievement_varia_4_missing}<br><br><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}:</span> <br> • {$achievement_varia_4_next_am} {$LNG.tech.922} <br> • {$achievement_varia_4_next_points} {$LNG.achiev_13}">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_varia_4_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Победы хостаил" src="styles/images/achiev/ach_wons_em.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_varia_4} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_164}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_varia_4_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		       *}        
                <div id="ach_expedition" class="ach_content">
                	<div class="stars_2">{$achievement_varia_5_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_varia_5_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_varia_5_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_varia_5_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_varia_5_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Удачная экспедиция" src="styles/images/achiev/ach_expedition.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_varia_5} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_165}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_varia_5_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_found_tm" class="ach_content">
                	<div class="stars_2">{$achievement_varia_6_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_varia_6_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_varia_6_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_varia_6_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_varia_6_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Искатель материи" src="styles/images/achiev/ach_found_tm.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_varia_6} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_166}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_varia_6_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		   {*            
                <div id="ach_found_up" class="ach_content">
                	<div class="stars_2">{$achievement_varia_7_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}:</span> <br>{$achievement_varia_7_missing}<br><br><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}:</span> <br> • {$achievement_varia_7_next_am} {$LNG.tech.922} <br> • {$achievement_varia_7_next_points} {$LNG.achiev_13}">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_varia_7_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Искатель апгрейдов" src="styles/images/achiev/ach_found_up.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_varia_7} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_167}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_varia_7_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_action_up" class="ach_content">
                	<div class="stars_2">{$achievement_varia_8_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}:</span> <br>{$achievement_varia_8_missing}<br><br><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}:</span> <br> • {$achievement_varia_8_next_am} {$LNG.tech.922} <br> • {$achievement_varia_8_next_points} {$LNG.achiev_13}">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_varia_8_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Интегратор апгрейдов" src="styles/images/achiev/ach_action_up.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_varia_8} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_168}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_varia_8_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->   *}  
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