{block name="title" prepend}{$LNG.lottery_dm_21}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
    	{$LNG.lottery_dm_1}  

<span Style="float:right">{$LNG.lottery_dm_22} <font color="red"><span class="countdown2" secs="{$secs}"></span></font></span>		
	</div> 

	<div id="ach_level" class="ach_content" style="margin: 10px 7px 7px 7px;"> 
                	    <div class="ach_next_info_line" style="width:100%;"></div>
                                   <div class="ach_next_info tooltip" style="bottom: 4px;" data-tooltip-content="<span style='color:#3CF; font-weight:bold;'>{$LNG.lottery_dm_10}:</span> <br>{$lottery_dm_7}">?</div>
								   
                	<div class="ach_img">
                    	<img alt="Pacífico" src="http://icons.iconarchive.com/icons/designcontest/casino/72/Slots-icon.png">
                    </div>
                    <div class="ach_content_text">

                
                        <div class="ach_text_boby" style="margin-top: 10px;">
                         <span>{$LNG.lottery_dm_2}:
{$metal_p} {$LNG.tech.901},
{$crystal_p} {$LNG.tech.902},
{$deuterium_p} {$LNG.tech.903}</span>  
                        </div>
                		                        <div class="ach_text_need">
             
			
			<font color="lime">{$lottery_dm_4}</font>                                            
                        </div>
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div>
				
				
					<div id="build_elements" class="upgrade_list">
					<div class="build_box" style="width:48% !important;     height: 33px !important;">
       		<div class="content_box">
                <div class="prices" style="margin-left:10px;">
                	<div class="price">
                	<font color="lime">{$lottery_dm_3}<p></font>     
                    </div>  
										
               		                          
                </div>
          	</div>
        </div>
				    	<div class="build_box" style="width:48% !important;    height: 33px !important;">
       		<div class="content_box">
                <div class="prices" style="margin-left:10px;">
                	<div class="price">
                	
   <form method="POST">
   {$LNG.lottery_dm_5}
   <select size="1" name="tickets" style="margin-left:20px">
   <option value="1">1</option>
   </select>
   <input type="submit" value="{$LNG.lottery_dm_6}" name="Buy">
</form>
                    </div>
                    
										
               		                          
                </div>
          	</div>
        </div></div>
	
	<div id="build_elements" class="officier_elements prem_shop">
    <div class="build_box">
        <div class="head" onclick="OpenBox('open_list');">
            <span>{$LNG.lottery_dm_23}</span>
            <span id="open_btn_open_list" class="prem_open_btn">+</span>            
        </div>
        <div id="box_open_list" class="content_box" style="height: auto;">
           {$user_lists}
        </div>
    </div>
</div>

<div id="build_elements" class="officier_elements prem_shop">
    <div class="build_box">
        <div class="head" onclick="OpenBox('list_win');">
            <span>{$LNG.lottery_dm_8}</span>
            <span id="open_btn_list_win" class="prem_open_btn">-</span>            
        </div>
        <div id="box_list_win" class="content_box" style="height: auto; display: block;">
        	
           {$winners}
            
        </div>
    </div>
</div>
    <div style="display:none">
</div>
{/block}

{block name="script" append}
<script type="text/javascript">
	function OpenBox(Key){
	var btn = $('#open_btn_'+Key)
	if(btn.text() == '+')
	{
		$('#box_'+Key).stop(true,false).slideDown(300);
		btn.text('-')
	}
	else
	{
		$('#box_'+Key).stop(true,false).slideUp(300);
		btn.text('+')
	}
}
</script>
{/block}