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
                                        <li>
                        <a href="game.php?page=achievement&amp;group=varia">{$LNG.achiev_9}</a>
                    </li>
                                    </ul>  
            </div> 
            
            <div class="ach_content_box">
            	<div style="float:left; width:100%;">
                               
                <div id="ach_hunter_fleet" class="ach_content">
                	<div class="stars_2">{$achievement_fleet_1_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}:</span> <br>{$achievement_fleet_1_missing}<br><br><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}:</span> <br> • {$achievement_fleet_1_next_am} {$LNG.tech.922} <br> • {$achievement_fleet_1_next_points} {$LNG.achiev_13}">?</div>
                    <div class="ach_next_info_line" style="width:0%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Флот Истребителей" src="styles/images/achiev/ach_hunter_fleet.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_fleet_1} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p></p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	{$achievement_fleet_1_next}<br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_support_fleet" class="ach_content">
                	<div class="stars_2">{$achievement_fleet_2_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}:</span> <br>{$achievement_fleet_2_missing}<br><br><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}:</span> <br> • {$achievement_fleet_2_next_am} {$LNG.tech.922} <br> • {$achievement_fleet_2_next_points} {$LNG.achiev_13}">?</div>
                    <div class="ach_next_info_line" style="width:0%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Флот Поддержки" src="styles/images/achiev/ach_support_fleet.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_fleet_2} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p></p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	{$achievement_fleet_2_next}<br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_battle_fleet" class="ach_content">
                	<div class="stars_2">{$achievement_fleet_3_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}:</span> <br>{$achievement_fleet_3_missing}<br><br><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}:</span> <br> • {$achievement_fleet_3_next_am} {$LNG.tech.922} <br> • {$achievement_fleet_3_next_points} {$LNG.achiev_13}">?</div>
                    <div class="ach_next_info_line" style="width:0%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Боевой флот" src="styles/images/achiev/ach_battle_fleet.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_fleet_3} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p></p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	{$achievement_fleet_3_next}<br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_destruction_fleet" class="ach_content">
                	<div class="stars_2">{$achievement_fleet_4_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}:</span> <br>{$achievement_fleet_4_missing}<br><br><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}:</span> <br> • {$achievement_fleet_4_next_am} {$LNG.tech.922} <br> • {$achievement_fleet_4_next_points} {$LNG.achiev_13}">?</div>
                    <div class="ach_next_info_line" style="width:0%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Флот Разрушения" src="styles/images/achiev/ach_destruction_fleet.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_fleet_4} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p></p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	{$achievement_fleet_4_next}<br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_siege_fleet" class="ach_content">
                	<div class="stars_2">{$achievement_fleet_5_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}:</span> <br>{$achievement_fleet_5_missing}<br><br><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}:</span> <br> • {$achievement_fleet_5_next_am} {$LNG.tech.922} <br> • {$achievement_fleet_5_next_points} {$LNG.achiev_13}">?</div>
                    <div class="ach_next_info_line" style="width:0%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Флот Осады" src="styles/images/achiev/ach_siege_fleet.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_fleet_5} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p></p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	{$achievement_fleet_5_next}<br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_heavy_fleet" class="ach_content">
                	<div class="stars_2">{$achievement_fleet_6_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}:</span> <br>{$achievement_fleet_6_missing}<br><br><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}:</span> <br> • {$achievement_fleet_6_next_am} {$LNG.tech.922} <br> • {$achievement_fleet_6_next_points} {$LNG.achiev_13}">?</div>
                    <div class="ach_next_info_line" style="width:0%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Тяжелый флот" src="styles/images/achiev/ach_heavy_fleet.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_fleet_6} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p></p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	{$achievement_fleet_6_next}<br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_emperor_fleet" class="ach_content">
                	<div class="stars_2">{$achievement_fleet_7_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}:</span> <br>{$achievement_fleet_7_missing}<br><br><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}:</span> <br> • {$achievement_fleet_7_next_am} {$LNG.tech.922} <br> • {$achievement_fleet_7_next_points} {$LNG.achiev_13}">?</div>
                    <div class="ach_next_info_line" style="width:0%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Имперский флот" src="styles/images/achiev/ach_emperor_fleet.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_fleet_7} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p></p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	{$achievement_fleet_7_next}<br>
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