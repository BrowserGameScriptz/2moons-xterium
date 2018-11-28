{block name="title" prepend}{$LNG.lm_galaxy}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="galactic_block_1">
    <div id="galactic_header" style="position:relative;">
		<div class="gal_nazv1" style="margin-left:15px;">{$LNG.lv_coords} {$savedData}/20</div>
		<a href="?page=galaxy" class="right_flank input_blue">{$LNG.lm_galaxy}</a>
    </div><!--/galactic_header-->
	{if $displayadsmd == 1}
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- War Of Galaxyz #Game -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2369063859511778"
     data-ad-slot="3349807407"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>{/if}
   <div id="galactic_status">
        <div class="gal_p5">{$LNG.gl_pos}</div>
        <div class="status_sep"></div>
        <div class="gal_p6">{$LNG.gal_act}</div>
        <div class="status_sep"></div>
        <div class="gal_p7">{$LNG.type_planet.3}</div>
        <div class="status_sep"></div>
        <div class="gal_p8">{$LNG.gal_debris}</div>
        <div class="status_sep"></div>
        <div class="gal_p9">{$LNG.gl_player_estate}</div>
        <div class="status_sep"></div>
        <div class="gal_p10">{$LNG.gl_alliance}</div>
        <div class="status_sep"></div>
        <div class="gal_p11">{$LNG.gl_actions}</div>
    </div><!--/galactic_status-->	
    
    				    {foreach $savedArray as $ID => $Data}<div class="gal_user ">   
	 	<div class="gal_number">
        	<a href="game.php?page=fleetTable&amp;galaxy={$Data.galaxy}&amp;system={$Data.system}&amp;planet={$Data.planet}&amp;planettype=1">
			
            <span class="galactic_number_{$Data.planet}">{$Data@iteration}</span></a>
        </div>
		                   <span id="p_1" class="{*tooltip_sticky*} gal_img_planet" data-tooltip-content="{*
            <table class='tooltip_class_table' style='min-width:230px'>
            	<tr> 
                	<th colspan='2'>Planet {$Data.name} [{$Data.galaxy}:{$Data.system}:{$Data.planet}]</th>
                </tr><tr>
            	<td class='tooltip_class_td_img'><img src='./styles/theme/gow/planeten/small/s_{$Data.image}.png' /></td>
            	<td>
	
	
	
	
<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy={$Data.galaxy}&amp;system={$Data.system}&amp;planet={$Data.planet}&amp;planettype=1&amp;target_mission=3'><img src='styles/images/iconav/risorseg.png' style='float: left;margin-left: 5px;margin-top: 2px;'>Transport</a><a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy={$Data.galaxy}&amp;system={$Data.system}&amp;planet={$Data.planet}&amp;planettype=1&amp;target_mission=4'><img src='styles/images/iconav/stazionag.png' style='float: left;margin-left: 5px;margin-top: 2px;'>Deploy</a>		
			
							</td>
		</tr></table>*}">
		<img src="./styles/theme/gow/planeten/small/s_{$Data.image}.png" alt="">
        		</span>
        <div class="gal_planet_name">{$Data.name}</div>

        <div class="gal_ico_moon">
 
        				{if $Data.hasMoon}<div class="ico_moon {*tooltip_sticky*}" data-tooltip-content="{*
            <table class='tooltip_class_table' style='min-width:240px'>
            	<tr>
                	<th colspan='2'>Moon Moon [6:26:5]</th>
               	</tr><tr>                
                	<td rowspan='4' class='tooltip_class_td_img'><img src='./styles/theme/gow/planeten/moon.png' /></td>
                	<th>Properties</th>
                </tr><tr>
                	<td class='tooltip_class_table_text_left'><span>Diameter</span>: 9.380<br />
                    <span>Temperatura</span>: 94</td>
                </tr><tr>
                 	<td>
                                		
										
									<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy=6&amp;system=26&amp;planet=5&amp;planettype=3&amp;target_mission=3'><img src='styles/images/iconav/risorseg.png' style='float: left;margin-left: 5px;margin-top: 2px;'>Transport</a>  
									<a class='tooltip_class_a_btn' style='height: 17px;line-height: 17px;' href='?page=fleetTable&amp;galaxy=6&amp;system=26&amp;planet=5&amp;planettype=3&amp;target_mission=4'><img src='styles/images/iconav/stazionag.png' style='float: left;margin-left: 5px;margin-top: 2px;'>Deploy</a>		
									  
									  
																		</td>
                </tr>
                </td></tr></table>*}">
            </div>{/if}


			
			
			        </div>

 
        <div class="gal_ico_trash">
		{if $Data.debris}<div class="ico_trash_{if $Data.debris > 225000000000 }big{elseif $Data.debris < 225000000000 && $Data.debris > 7500000000}medium{elseif $Data.debris < 7500000000}small{/if} tooltip_sticky" data-tooltip-content="
                <table class='tooltip_class_table'>
                    <tr>
                        <th>{$LNG.gl_debris_field} [{$Data.galaxy}:{$Data.system}:{$Data.planet}]</th>
                    </tr>
                    <tr>
                        <td class='tooltip_class_table_text_left'>
                            <span>{$LNG.tech.901}</span>: <span class='tooltip_class_901'>{$Data.debrisM|number}</span><br />
                            <span>{$LNG.tech.902}</span>: <span class='tooltip_class_902'>{$Data.debrisC|number}</span>
                        </td>
                    </tr>
                </table>">
			</div>{/if}
			
			
			
        	        </div>
        
        <div class="gal_player_name">
		
		        	        	<a class="{*tooltip_sticky*}" data-tooltip-content="
            {*<table class='tooltip_class_table'>
            	<tr><th>Player {$Data.username} in pos. 412</th></tr>
								
               	                              
                           		<tr><td><a class='tooltip_class_a_bigbtn' href='?page=statistics&amp;who=1&amp;range=412'>Stats</a></td></tr>    
                            </table>*}" style="color:#5ca6aa">
				<span class=""><span class="honorRank" style="opacity: 0;">&nbsp;</span> {$Data.username}</span>
															</a>
							                    </div>


        <div class="gal_ally_name">
        				<a class="{*tooltip_sticky*}" data-tooltip-content="{*
            <table class='tooltip_class_table'>
            	<tr><th>Alliance Administrators 2 Members</th></tr>
                <tr><td><a class='tooltip_class_a_bigbtn' href='?page=alliance&amp;mode=info&amp;id=5'>Page of the Alliance</a></td></tr>
                <tr><td><a class='tooltip_class_a_bigbtn' href='?page=statistics&amp;range=28&amp;who=2'>Stats</a></td></tr>
                                </table>*}" style="color:#5ca6aa">
				<span class="blue">{$Data.allyname}</span>
			</a>
			        </div>
        <div class="gal_player_cont">
        	<a class="ico_watch" title="Spying" href="javascript:doit(6,{$Data.planetId},{$Data.planet},{$Data.system},{$spyShips|json|escape:'html'})"></a>
			<a href="#" class="ico_post" onclick="return Dialog.PM({$Data.userid})" title="Write message"></a>	
			<a href="#" class="ico_friend" onclick="return Dialog.Buddy({$Data.userid})" title="Friend request"></a>			
			<a class="ico_del shover" href="#" title="Save coords" data-gal="{$Data.galaxy}" data-sys="{$Data.system}" data-pl="{$Data.planet}" data-id="{$ID}"></a>	
		</div>
            </div>   {/foreach}
	</div><!--/galactic_block_1-->
<div id="send_zond">
    <table>
	<tr style="display: none;" id="fleetstatusrow">
	</tr>
	</table>
</div><!--/send_zond-->
<div id="galactic_block_2">
    <div id="block_status" style="height: 27px;padding-top: 0;line-height:9px;">
        <div class="gal_stat_4">
            <div class="gal_text_1" ><span id="slots">{$maxfleetcount}</span>/{$fleetmax}</div>
            <div class="gal_text_2">{$LNG.gl_fleets}</div>
        </div>
    
        <div class="gal_stat_5">
            <div class="gal_text_1"><span id="probes">{$probesAval|number}</span></div>
            <div class="gal_text_2">{$LNG.tech.210}</div>
        </div>
    </div><!--/block_status-->   
</div><!--/galactic_block_2-->
<div class="clear"></div>  
<script type="text/javascript">
	status_ok		= 'Done';
	status_fail		= 'Error';
	MaxFleetSetting = 3;
</script>   		
</div>
</div>
            <div class="clear"></div>            
        </div><!--/body-->
	
{/block}