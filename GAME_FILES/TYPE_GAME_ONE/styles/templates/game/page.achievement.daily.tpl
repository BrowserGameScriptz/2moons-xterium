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
                                        <li class="active">
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
                               
                <div id="ach_wons_day" class="ach_content">
                	<div class="stars_2">{$achievement_daily_1_current_points}</div>
                                        <div class="ach_next_info tooltip_sticky" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;line-height: 17px;'> {$achievement_daily_1_missing}<a href='https://forum.warofgalaxyz.com/topic/6-tutorial-raider-achivement/' target='_blank'class='interrogation'>?</a></td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_1_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_1_next_points} </td> </tr><tr><th colspan='2'>{$LNG.achiev_27}</th></tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M7' src='styles/theme/gow/gebaeude/229.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M7 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_1_next_m7} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M19' src='styles/theme/gow/gebaeude/224.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M19 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_1_next_m19} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M32' src='styles/theme/gow/gebaeude/230.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M32 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_1_next_m32} </td> </tr><tr> <td colspan='2'> {$LNG.achiev_46} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_daily_1_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Рейдер" src="styles/images/achiev/ach_wons_day.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_daily_1} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_28}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_daily_1_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
                <div id="ach_expedition_day" class="ach_content">
                	<div class="stars_2">{$achievement_daily_2_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_daily_2_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_2_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_2_next_points} </td> </tr><tr><th colspan='2'>{$LNG.achiev_27}</th></tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M7' src='styles/theme/gow/gebaeude/229.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M7 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_2_next_m7} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M19' src='styles/theme/gow/gebaeude/224.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M19 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_2_next_m19} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M32' src='styles/theme/gow/gebaeude/230.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M32 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_2_next_m32} </td> </tr><tr> <td colspan='2'> {$LNG.achiev_49} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_daily_2_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Удачная экспедиция / сутки" src="styles/images/achiev/ach_expedition_day.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_daily_2} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_29}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_daily_2_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div> <!--/ach_content-->
        		               
               <!--   <div id="ach_wons_em_1_day" class="ach_content">
                	<div class="stars_2">{$achievement_daily_3_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_daily_3_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_3_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_3_next_points} </td> </tr><tr><th colspan='2'>{$LNG.achiev_27}</th></tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M7' src='styles/theme/gow/gebaeude/229.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M7 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_3_next_m7} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M19' src='styles/theme/gow/gebaeude/224.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M19 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_3_next_m19} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M32' src='styles/theme/gow/gebaeude/230.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M32 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_3_next_m32} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_daily_3_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Победы хостаил - Варвары / сутки" src="styles/images/achiev/ach_wons_em_1_day.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_daily_3} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_30}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_daily_3_next}</span><br>
                        </p>                                               
                        </div>
                                            </div>      
                    <div class="clear"></div>               
                </div> 
        		               
                <div id="ach_wons_em_2_day" class="ach_content">
                	<div class="stars_2">{$achievement_daily_4_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_daily_4_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_4_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_4_next_points} </td> </tr><tr><th colspan='2'>{$LNG.achiev_27}</th></tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M7' src='styles/theme/gow/gebaeude/229.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M7 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_4_next_m7} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M19' src='styles/theme/gow/gebaeude/224.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M19 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_4_next_m19} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M32' src='styles/theme/gow/gebaeude/230.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M32 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_4_next_m32} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_daily_4_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Победы хостаил - Пираты / сутки" src="styles/images/achiev/ach_wons_em_2_day.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_daily_4} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_31}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_daily_4_next}</span><br>
                        </p>                                               
                        </div>
                                            </div>
                    <div class="clear"></div>               
                </div> 
        		               
                <div id="ach_wons_em_3_day" class="ach_content">
                	<div class="stars_2">{$achievement_daily_5_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_daily_5_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_5_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_5_next_points} </td> </tr><tr><th colspan='2'>{$LNG.achiev_27}</th></tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M7' src='styles/theme/gow/gebaeude/229.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M7 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_5_next_m7} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M19' src='styles/theme/gow/gebaeude/224.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M19 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_5_next_m19} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M32' src='styles/theme/gow/gebaeude/230.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M32 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_5_next_m32} </td> </tr><tr> <td colspan='2'> {$LNG.achiev_57} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_daily_5_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Победы хостаил - Чужие / сутки" src="styles/images/achiev/ach_wons_em_3_day.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_daily_5} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_32}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_daily_5_next}</span><br>
                        </p>                                               
                        </div>
                                            </div>     
                    <div class="clear"></div>               
                </div>
        		               
                <div id="ach_wons_em_4_day" class="ach_content">
                	<div class="stars_2">{$achievement_daily_6_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}:</span> <br>{$achievement_daily_6_missing}<br><br><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}:</span> <br> • {$achievement_daily_6_next_am} {$LNG.tech.922} <br> • {$achievement_daily_6_next_points} {$LNG.achiev_13}<br />{$LNG.achiev_27}: <br /> {$achievement_daily_6_next_m7} М7 <br /> {$achievement_daily_6_next_m19} М19 <br /> {$achievement_daily_6_next_m32} М32">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_daily_6_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Победы хостаил - Руины / сутки" src="styles/images/achiev/ach_wons_em_4_day.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_daily_6} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_33}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_daily_6_next}</span><br>
                        </p>                                               
                        </div>
                                            </div>    
                    <div class="clear"></div>               
                </div>
        		               
                <div id="ach_wons_em_5_day" class="ach_content">
                	<div class="stars_2">{$achievement_daily_7_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_daily_7_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_7_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_7_next_points} </td> </tr><tr><th colspan='2'>{$LNG.achiev_27}</th></tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M7' src='styles/theme/gow/gebaeude/229.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M7 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_7_next_m7} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M19' src='styles/theme/gow/gebaeude/224.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M19 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_7_next_m19} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M32' src='styles/theme/gow/gebaeude/230.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M32 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_7_next_m32} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_daily_7_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Победы хостаил - Шахтеры / сутки" src="styles/images/achiev/ach_wons_em_5_day.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_daily_7} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_34}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_daily_7_next}</span><br>
                        </p>                                               
                        </div>
                                            </div>     
                    <div class="clear"></div>               
                </div> 
        		               
                <div id="ach_wons_em_6_day" class="ach_content">
                	<div class="stars_2">{$achievement_daily_8_current_points}</div>
                                        <div class="ach_next_info tooltip" data-tooltip-content="<table class='tooltip_class_table' style='max-width: 200px;'> <tbody><tr><th colspan='2'><span style='color:#3CF; font-weight:bold;'>{$LNG.achiev_10}</span></th></tr><tr><td colspan='2' style='padding: 3px;'> {$achievement_daily_8_missing} </td></tr><tr><th colspan='2'><span style='color:#F90; font-weight:bold;'>{$LNG.achiev_12}</span></th></tr> <tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.tech.922}' src='styles/images/atm.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.tech.922} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_8_next_am} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='{$LNG.achiev_13}' src='styles/images/stars.png' style='height: 14px;width: 14px;float: left;padding: 3px;'>{$LNG.achiev_13} </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_8_next_points} </td> </tr><tr><th colspan='2'>{$LNG.achiev_27}</th></tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M7' src='styles/theme/gow/gebaeude/229.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M7 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_8_next_m7} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M19' src='styles/theme/gow/gebaeude/224.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M19 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_8_next_m19} </td> </tr><tr> <td style='text-align: right;line-height: 19px;'><img alt='M32' src='styles/theme/gow/gebaeude/230.gif' style='height: 14px;width: 14px;float: left;padding: 3px;'>M32 </td> <td class='tooltip_class_table_text_left'>{$achievement_daily_8_next_m32} </td> </tr></tbody></table>">?</div>
                    <div class="ach_next_info_line" style="width:{$achievement_daily_8_percent}%;"></div>
                                        
                	<div class="ach_img">
                    	<img alt="Победы хостаил - Дроиды / сутки" src="styles/images/achiev/ach_wons_em_6_day.png">
                    </div>
                    <div class="ach_content_text">
                    
                        <div class="ach_text_head">
                            <span>{$achievement_daily_8} </span>                            
                        </div>
                
                        <div class="ach_text_boby">
                            <p>{$LNG.achiev_36}</p>   
                        </div>
                		                        <div class="ach_text_need">
                        <p>
                        	{$LNG.achiev_16}:<br>
                        	<span>{$achievement_daily_8_next}</span><br>
                        </p>                                               
                        </div>
                                            </div> 
                    <div class="clear"></div>               
                </div>-->
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