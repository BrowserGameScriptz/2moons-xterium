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
                                        <li class="active">
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
                               
                <div id="ach_spy_tech" class="ach_content">
                	<div class="stars_2">{$achievement_tech_1_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_tech_1_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_1_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_1_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_tech_1_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Шпион" src="styles/images/achiev/ach_spy_tech.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_tech_1} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_125}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_tech_1_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_computer_tech" class="ach_content">
                	<div class="stars_2">{$achievement_tech_2_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_tech_2_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_2_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_2_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_tech_2_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Хакер" src="styles/images/achiev/ach_computer_tech.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_tech_2} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_126}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_tech_2_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_war_tech" class="ach_content">
                	<div class="stars_2">{$achievement_tech_3_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_tech_3_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_3_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_3_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:0%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Непобедимые технологи" src="styles/images/achiev/ach_war_tech.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_tech_3} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_127}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	{$achievement_tech_3_next}<br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_expedition_tech" class="ach_content">
                	<div class="stars_2">{$achievement_tech_4_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_tech_4_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_4_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_4_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_tech_4_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Экспедиционер" src="styles/images/achiev/ach_expedition_tech.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_tech_4} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_128}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_tech_4_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div>
        		               
                <div id="ach_gravity_tech" class="ach_content">
                	<div class="stars_2">{$achievement_tech_5_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_tech_5_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_5_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_5_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_tech_5_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Гравитация" src="styles/images/achiev/ach_gravity_tech.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_tech_5} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_129}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_tech_5_next}</span><br>
                        </p>                                               
                        </div>
                                            </div>   
                    <div class="clear"></div>               
                </div>
        		               
                <div id="ach_gun_tech" class="ach_content">
                	<div class="stars_2">{$achievement_tech_6_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_tech_6_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_6_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_6_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:0%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Сила орудий" src="styles/images/achiev/ach_gun_tech.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_tech_6} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_130}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	{$achievement_tech_6_next}<br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_energy_tech" class="ach_content">
                	<div class="stars_2">{$achievement_tech_7_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_tech_7_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_7_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_7_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_tech_7_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Энергетик" src="styles/images/achiev/ach_energy_tech.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_tech_7} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_131}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_tech_7_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_bank_ally_tech" class="ach_content">
                	<div class="stars_2">{$achievement_tech_8_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_tech_8_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_8_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_8_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_tech_8_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Братство" src="styles/images/achiev/ach_bank_ally_tech.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_tech_8} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_132}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_tech_8_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_motor_tech" class="ach_content">
                	<div class="stars_2">{$achievement_tech_9_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_tech_9_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_9_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_9_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:0%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Повышение скорости" src="styles/images/achiev/ach_motor_tech.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_tech_9} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_133}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	{$achievement_tech_9_next}<br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_mining_tech" class="ach_content">
                	<div class="stars_2">{$achievement_tech_10_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_tech_10_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_10_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_tech_10_next_points} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:0%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Геолог" src="styles/images/achiev/ach_mining_tech.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_tech_10} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_134}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	{$achievement_tech_10_next}<br>
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