{block name="title" prepend}{$LNG.lm_options}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<script type="text/javascript">
	var lng = "";
	
	function unoopen(){
	if(!$('.skils1').hasClass('active'))
	{
        $('.deactive').removeClass('active');	
        $('.skils1').addClass('active');
		$('#u0').show();
		$('#u100').hide();
		$('#u200').hide();
		$('#u300').hide();
	}
};
function dueopen(){
	if(!$('.skils2').hasClass('active'))
	{
        $('.deactive').removeClass('active');	
        $('.skils2').addClass('active');
		$('#u0').hide();
		$('#u100').show();
		$('#u200').hide();
		$('#u300').hide();
	}
};

function treopen(){
	if(!$('.skils3').hasClass('active'))
	{
        $('.deactive').removeClass('active');	
        $('.skils3').addClass('active');
		$('#u0').hide();
		$('#u100').hide();
		$('#u200').show();
		$('#u300').hide();
	}
};
function quattroopen(){
	if(!$('.skils4').hasClass('active'))
	{
        $('.deactive').removeClass('active');	
        $('.skils4').addClass('active');
		$('#u0').hide();
		$('#u100').hide();
		$('#u200').hide();
		$('#u300').show();
	}
};

</script>

	
	
	<div id="achivment">
    <div class="ach_main_block academy_main_block">
    <form id="form" action="?page=settings&amp;mode=send" method="post" onsubmit="return SettingsSet()" enctype="multipart/form-data">
        <div id="academy_head" class="gray_stripe">
            {$LNG.option_head}
    </div>
     
	 <div id="academy" class="ach_main_content">
                            
            <div class="ach_menu">
                <ul>
                    <li class="skils1 deactive active">
                        <a href="#" onclick="unoopen();"><img src="styles/images/iconav/frend.png" alt=""></a>
                    </li>
                    <li class="skils2 deactive">
                        <a href="#" onclick="dueopen();"><img src="styles/images/iconav/coloni.png" alt=""></a>
                    </li>
                    <li class="skils3 deactive">
                        <a href="#" onclick="treopen();"><img src="styles/images/iconav/seting2.png" alt=""></a>
                    </li>
					 <li class="skils4 deactive">
                        <a href="#" onclick="quattroopen();"><img src="styles/images/iconav/reducefleetsetting.png" alt=""></a>
                    </li>
                </ul>  
            </div> 
			
			      
			<div id="u0" class="ach_content_box" >
            	<div style="float:left; width:100%;">                             
                <div class="ach_content" style="padding-top:7px;">
    <div class="ally_contents" style="padding-bottom: 15px;padding-top: 25px;">



	
	<img title="" src="media/files/{$avatarssd}" style="float:right;height:85px;width:85px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin-top: -15px;">
        <p>{$LNG.option_login}: <span>{$username}</span> {if empty($customNick)}<a href="#" onclick="return Dialog.CreateNickname();" style="color: darkgray;" >({$LNG.changenick_1})</a>{/if}</p>
       {if !empty($customNick)}<p>{$LNG.changenick_2}: <span>{$customNick}</span>{if $customNickChange < $TIME} <a href="#" onclick="return Dialog.ChangeNickname();" style="color: darkgray;" >({$LNG.changenick_3})</a>{/if}</p>{/if}
        <p>{$LNG.option_email}: <span>{$permaEmail}</span></p>     
		<p>Ad Blocker: <span>{if $adblockerSet == 0}{$LNG.chat_room_open}{else}{$LNG.chat_room_closed}{/if}</span></p>	
        <p>{$LNG.ov_password}:	<a href="//warofgalaxyz.com/index.php?page=lobby" target="_blank" style="color: darkgray;" >({$LNG.chat_room_pwd_edit})</a></p>	
		
<label for="fichier">
      <input type="file" name="fichier" style="display:none;" id="fichier"/>
			<img alt="" name="" src="styles/images/iconav/avatar_c.png" style="float: right;-webkit-border-radius: 0px 4px 0px 4px;-moz-border-radius: 0px 4px 0px 4px;border-radius: 0px 4px 0px 4px;margin-top:-{if !empty($customNick)}50{else}25{/if}px;right: 79px;position: absolute;padding: 5px;background-color: rgba(9, 29, 46, 0.54);" class="tooltip" data-tooltip-content="{$LNG.hofComment_7}">
	</label>

		
    </div>
	
    <div class="gray_stripe">
    	{$LNG.option_general}  <a href="?page=BlockList" style="float:right;color: darkgray;">{$LNG.op_block_pm}</a>
    </div>
    <div class="ally_contents" style="padding-bottom:5px;">
		<label class="left_label" style="width: 160px;">{$LNG.op_timezone}</label>
		{html_options name=timezone class="big_seting_text" options=$Selectors.timezones class="big_seting_text option" selected=$timezone}

		<div class="clear"></div>

			<label class="left_label" style="width: 160px;">{$LNG.op_lang}</label>
		{html_options name=language class="big_seting_text" options=$Selectors.lang class="big_seting_text" selected=$userLang}

		<div class="clear"></div>  
		<label class="left_label" style="width: 160px;">{$LNG.op_sort_planets_by}</label>
       {html_options name=planetSort class="big_seting_text" options=$Selectors.Sort class="big_seting_text option" selected=$planetSort}

		<div class="clear"></div> 
		<label class="left_label" style="width: 160px;">{$LNG.op_sort_kind}</label>
        {html_options name=planetOrder class="big_seting_text" options=$Selectors.SortUpDown class="big_seting_text option" selected=$planetOrder}
		
        <div class="clear"></div> 

<br>
<div class="content_box" style="display: flex;">
                    
                <div class="left_part" style="width: 33.3%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px;margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="queueMessagesID" name="queueMessages" type="checkbox" value="1" {if $queueMessages == 1}checked="checked"{/if}>
             
			  </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
<label for="queueMessagesID" class="left_label" >{$LNG.op_active_build_messages}</label>	                </div>
                </div> </div>		
				 <div class="left_part" style="width: 33.3%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px;margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="auctionMessageID" name="auctionMessage" type="checkbox" value="1" {if $auctionMessage == 1}checked="checked"{/if}>
                </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
		<label for="auctionMessageID" class="left_label" >{$LNG.auctioneer_20}</label>	
                </div>
                </div> </div>	
				 <div class="left_part" style="width: 33.3%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px;margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="recordHiddenID" name="recordHidden" type="checkbox" value="1" {if $recordHidden == 1}checked="checked"{/if}>
                </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
		<label for="recordHiddenID" class="left_label">{$LNG.delete_tooltips} {$LNG.ti_from} {$LNG.lm_records}</label>	
                </div>
                </div> </div>	
					
				
				</div>
				
				
				<div class="content_box" style="display: flex;">
				
				 <div class="left_part" style="width: 33.3%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px;margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="showAllyFleet" name="showAllyFleet" type="checkbox" value="1" {if $showAllyFleet == 1}checked="checked"{/if}>
             
			  </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
<label for="showAllyFleet" class="left_label" >Allow display fleets on ally</label>	                </div>
                </div> </div>
				

		</div>

		
        <div class="clear"></div> 
    </div></div><div class=" build_band ticket_bottom_band">    	
          <input class="bottom_band_submit" value="{$LNG.op_save_changes}" type="submit">
    </div></div></div>
	
	 	<div id="u100" class="ach_content_box" style="display:none">
            	<div style="float:left; width:100%;">                             
                <div class="ach_content">
    <div class="gray_stripe">
    	{$LNG.option_interface}
    </div>
    <div class="ally_contents" style="padding-bottom:5px;">
	
	<div class="content_box" style="display: flex;">
                    
                <div class="left_part" style="width: 33.3%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px;margin-left: 6px;">
    	<input style="float:left; margin:5px 6px 0 0;" id="ajaxID" name="op_ajax" type="checkbox" value="1" {if $op_ajax == 1}checked="checked"{/if}>
             
			  </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
		<label for="ajaxID" class="left_label" style="width:auto;">{$LNG.option_ajax}</label>		
                </div> </div>
				
				</div>
        <div class="left_part" style="width: 33.3%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px;margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="settings_gift" name="settings_gift" type="checkbox" value="1" {if $settings_gift == 1}checked="checked"{/if}>
             
			  </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
		<label for="settings_gift" class="left_label" style="width:auto;">{$LNG.option_promo_design}</label>
                </div> </div>
				
				</div>
        <div class="left_part" style="width: 33.3%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px;margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="settings_spy" name="settings_spy" type="checkbox" value="1" {if $settings_spy == 1}checked="checked"{/if}>
             
			  </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
		<label for="settings_spy" class="left_label" style="width: 160px;">{$LNG.option_ext_spio}</label>		
                </div> </div>
				
				</div></div>
     <br>
        <label class="left_label" style="width: 180px;">{$LNG.option_alarm}</label>
        <select name="sirena" class="big_seting_text" onChange="SoundTest(this.options[this.selectedIndex].value)" style="width: 388px;"> 
            <option {if $sirenas == 0}selected{/if} value="0">off</option>
            <option {if $sirenas == 1}selected{/if} value="1">1</option>
            <option {if $sirenas == 2}selected{/if} value="2">2</option>
            <option {if $sirenas == 3}selected{/if} value="3">3</option>
            <option {if $sirenas == 4}selected{/if} value="4">4</option>
            <option {if $sirenas == 5}selected{/if} value="5">5</option>
            <option {if $sirenas == 6}selected{/if} value="6">6</option>
            <option {if $sirenas == 7}selected{/if} value="7">7</option>
            <option {if $sirenas == 8}selected{/if} value="8">8</option>
            <option {if $sirenas == 9}selected{/if} value="9">9</option>
            <option {if $sirenas == 10}selected{/if} value="10">10</option>
        </select>
		<div class="clear"></div>   
       <label class="left_label" style="width: 180px;">{$LNG.resetBranch_4}</label>
        <select name="msgperpage" class="big_seting_text" style="width: 388px;"> 
            <option {if $msgperpage == 10}selected{/if} value="10">10</option>
            <option {if $msgperpage == 20}selected{/if} value="20">20</option>
            <option {if $msgperpage == 30}selected{/if} value="30">30</option>
            <option {if $msgperpage == 40}selected{/if} value="40">40</option>
            <option {if $msgperpage == 50}selected{/if} value="50">50</option>
        </select>
		<div class="clear"></div>   
       <label class="left_label" style="width: 180px;">Multi Build Option</label>
        <select name="multibuild" class="big_seting_text" style="width: 388px;"> 
            <option {if $multibuild == 0}selected{/if} value="0">Only Planets</option>
            <option {if $multibuild == 1}selected{/if} value="1">Only Moons</option>
            <option {if $multibuild == 2}selected{/if} value="2">Planets & Moons</option>
        </select>
		<div class="clear"></div>   
       {*<label class="left_label" style="width: 180px;">Main menu</label>
        <select name="mainmenu" class="big_seting_text" style="width: 388px;"> 
            <option {if $mainmenu == 0}selected{/if} value="0">Menu V1</option>
            <option {if $mainmenu == 1}selected{/if} value="1">Menu V2</option>
        </select>
		<div class="clear"></div>   *}      
    </div>
    <div class="gray_stripe">
    	{$LNG.option_gal_op}
    </div>
    <div class="ally_contents" style="padding-bottom:5px;">
    	<label class="left_label" style="width: 180px;" title="{$LNG.option_spio_num}.">{$LNG.op_spy_probes_number}</label>	
		<input type="number" class="big_seting_text" min="1" max="99999" name="spycount" value="{$spycount}"   style="width: 388px;">
        <div class="clear"></div>  
        <label class="left_label" style="width: 180px;">{$LNG.option_fleet_mes}</label>	
		<input type="number" class="big_seting_text" min="1" max="10" name="fleetactions" value="{$fleetActions}" style="width: 388px;">
        <div class="clear"></div>  
    </div>
    <div class="gray_stripe">
    	{$LNG.op_shortcut}
    </div>
    <div class="ally_contents" style="padding-bottom:5px;">
    
        
		<div class="content_box" style="display: flex;">
                    
                <div class="left_part" style="width: 50%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px; margin-left: 6px;">
				<input style="float:left; margin:5px 6px 0 0;" id="galaxySpyID" name="galaxySpy" type="checkbox" value="1" {if $galaxySpy == 1}checked="checked"{/if}>
                </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
                <label for="galaxySpyID" class="left_label" ><img src="styles/images/iconav/over.png" alt=""> {$LNG.type_mission.6}</label>	
                </div>
                </div> </div>	

				
                 <div class="left_part" style="width: 50%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px; margin-left: 6px;">
                <input style="float:left; margin:5px 6px 0 0;" id="galaxyMessageID" name="galaxyMessage" type="checkbox" value="1" {if $galaxyMessage == 1}checked="checked"{/if}>
	            </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
                <label for="galaxyMessageID" class="left_label" ><img src="styles/images/iconav/mesages.png" alt=""> {$LNG.op_write_message}</label>
                </div>
                </div> </div>	
				
				</div>
				<div class="content_box" style="display: flex;">
				<div class="left_part" style="width: 50%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px; margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="galaxyBuddyListID" name="galaxyBuddyList" type="checkbox" value="1" {if $galaxyBuddyList == 1}checked="checked"{/if}>
	            </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
		<label for="galaxyBuddyListID" class="left_label" ><img src="styles/images/iconav/friend.png" alt=""> {$LNG.op_add_to_buddy_list}</label>
                </div>
                </div> </div>
					
                <div class="left_part" style="width: 50%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px; margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="galaxyMissleID" name="galaxyMissle" type="checkbox" value="1" {if $galaxyMissle == 1}checked="checked"{/if}>
	            </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
		<label for="galaxyMissleID" class="left_label" ><img src="styles/images/iconav/write.png" alt=""> {$LNG.op_missile_attack}</label>
                </div>
                </div> </div>
					
					</div>
		
		
		<div class="clear"></div>         
    </div>

	
	</div><div class=" build_band ticket_bottom_band">    	
       <input class="bottom_band_submit" value="{$LNG.op_save_changes}" type="submit">
    </div></div></div>
			<div id="u200" class="ach_content_box" style="display:none">
            	<div style="float:left; width:100%;">                             
                <div class="ach_content" style="min-height: 130px;">
    <div class="gray_stripe">
    	{$LNG.option_acc_op}
    </div>
    <div class="ally_contents" style="padding-bottom:20px;">

		
			<div class="content_box" style="display: flex;">
                   
                <div class="left_part" style="width: 50%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px; margin-left: 6px;">
    	<input style="float:left; margin:5px 6px 0 0;" id="vacationID" name="vacation" type="checkbox" value="1">	
                </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
               		<label for="vacationID" class="left_label" >{$LNG.op_activate_vacation_mode}<a href="#" class="tooltip interrogation" style="margin-top: 4px;margin-right: 5px;" data-tooltip-content="{$LNG.op_activate_vacation_mode_descrip}">?</a></label>	

			   </div>
                </div> </div>		
				 <div class="left_part" style="width: 50%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px; margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="deleteID" name="delete" type="checkbox" value="1">
                </div>
                <div class="record_name_utits" style="line-height: 40px;width: 65%;">
		<label for="deleteID" class="left_label" >{$LNG.op_dlte_account} <a href="#" class="tooltip interrogation" style="margin-top: 4px;margin-right: 5px;" data-tooltip-content="{$LNG.op_dlte_account_descrip}">?</a></label>

			   </div>
                </div> </div>	
		
		 </div>
		<div class="content_box" style="display: flex;">
		
		 <div class="left_part" style="width:100%">                    
                <div class="opzioni" style="padding: 0px;height: 25px;">
                <div style="float: left;margin-right: -5px; margin-left: 6px;">
        <input style="float:left; margin:5px 6px 0 0;" id="protectionId" name="protectionTimer" type="checkbox" value="1"{if $protectionTimer == 1} checked disabled{elseif $cooldowner == 1}disabled{/if}>
                </div>
                <div class="record_name_utits" style="line-height: 40px; width: 482px;">
		<label for="protectionId" class="left_label" style="width: 530px;">{$LNG.protection_1} {if $protectionTimer2 > 0} ({$protectionTimer2|time}){/if} <a href="#" class="tooltip interrogation" style="margin-top: 4px;" data-tooltip-content='{$LNG.protection_2}'>?</a> {if $allowCancel == 1}<a href="#" class="interrogationCancel" style="margin-top: 4px;margin-right:5px;" onclick="cancelProtection();">X</a>{/if}</label>

			   </div>
                </div> </div>	</div>
    </div>
    <div class="clear"></div> </div> 
    <div class=" build_band ticket_bottom_band">    	
       <input class="bottom_band_submit" value="{$LNG.op_save_changes}" type="submit">
    </div> </div> </div>
					<div id="u300" class="ach_content_box" style="display:none">
            	<div style="float:left; width:100%;">                             
                <div class="ach_content" style="min-height: 130px;">
    <div class="gray_stripe">
    	{$LNG.lm_options} {$LNG.fl_fleet}
    </div>
    <div class="ally_contents" style="padding-bottom:20px;">

		
			<div class="content_box" >
                   
                <div class="clear"></div> 
		<label class="left_label" style="width: 160px;">Fleet overview design</label>
				<select name="fleetdesign" class="big_seting_text"> 
            <option {if $fleetdesign == 1}selected{/if} value="1">New</option>
            <option {if $fleetdesign == 2}selected{/if} value="2">Old</option>
        </select>
		<div class="clear"></div> 
		<label class="left_label" style="width: 160px;">Gather option</label>
        {html_options name=gatherOptions class="big_seting_text" options=$Selectors.planetOption class="big_seting_text option" selected=$gatheroptions}
        <div class="clear"></div> 
        
		
		 </div>
    </div>
    <div class="clear"></div> </div> 
    <div class=" build_band ticket_bottom_band">    	
       <input class="bottom_band_submit" value="{$LNG.op_save_changes}" type="submit">
    </div> </div> </div>
	</form>
	  
                <div style="padding-top:7px;"></div>
                <div class="clear"></div>                               
	 		</div><!--/ach_content_box-->
</div>


   </div>   
                <div style="padding-top:7px;"></div>
                <div class="clear"></div>                               
	 		</div><!--/ach_content_box-->
</div>
		
		
		
		
		
		
		
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->

{/block}
{block name="script" append}
<script type="text/javascript">
	    lngsetting		= '{$LNG.op_activate_vacation_mode_descrip2} ??\n\n {$LNG.op_activate_vacation_mode_descrip}'; 
		lngsetting2		= '{$LNG.protection_3}';
		lngsettingcance = '{$LNG.autoexpedition_4}';
</script>

{/block}