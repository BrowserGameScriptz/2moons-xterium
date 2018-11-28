{block name="title" prepend}{$LNG.tech.7}{/block}
{block name="content"}
<div id="page">
	<div id="content">

   
<div id="ally_content" class="conteiner">
<div class="gray_stripe">
{$LNG.tech.7}
	<span id="repairTime" style="float: right;">{$TOTALBUILDTIM|time}</span>
	<label style="float: right;">{if $WRECKSTATUS == 0}{$LNG.docking_7}{else}{$LNG.docking_8}{/if}:&nbsp;&nbsp; </label>
				
	</div> 

	<div id="ach_level" class="ach_content xdock1"> 
                	    <div class="ach_next_info_line" style="width:2.2774900518497E+16%;"></div>
    <div class="ach_next_info tooltip xdock2" data-tooltip-content="{$LNG.over_referal_more}"><a href="https://forum.warofgalaxyz.com/topic/7-tutorial-wog-dock/" target="_blank">?</a></div>
								   
                	<div class="ach_img">
                    	<a href="#" onclick="return Dialog.info(7)"><img src="styles/theme/gow/gebaeude/7.gif"></a>
                    </div>
                    <div class="ach_content_text">

                
                        <div class="ach_text_boby xdock3">
                         <span>{$LNG.docking_1}<br><br>{$LNG.docking_2}</span>  
                        </div>
                		                    
                                            </div> <!--/ach_content_text-->     
                    <div class="clear"></div>               
                </div>
				
				
					<div id="build_elements">
					<div class="build_box" style="width:48% !important;height: 33px !important;">
       		<div class="content_box">
                <div class="prices" style="margin-left:10px;">
                	<div class="price">
                  <p>{$LNG.docking_3}: <span id="burnUpCountDownForRepairOverlay" data-duration="213843">{$EXPIREDTIME}</span>  <input class="xdock5" {if $ISALLOWEDTODESTROY == 1}{else}style="display:none"{/if} {if $ISALLOWEDTODESTROY == 1}onclick="deleteWreck({$WRECKID});"{/if} value="{$LNG.docking_4}" type="button">
               </p>
						
						     </div>  
										
               		                          
                </div>
          	</div>
        </div>
				    	<div class="build_box" style="width:48% !important;    height: 33px !important;">
       		<div class="content_box" style="    padding: 0px;">
                <div class="prices" style="margin-left:10px;">
                	<div class="price" style="padding:2px">
                 
                    {if $WRECKSTATUS == 0}<input class="xdock6 {if $ISACTIVE == 1}middlemark{else}disabled{/if}" {if $ISACTIVE == 1}{else}style="display:none"{/if}value="{$LNG.docking_9}" {if $WRECKSTATUS == 0 && $ISACTIVE == 1}onclick="startWreck({$WRECKID});"{/if}  type="button">{else}<input class="xdock6" style="width:95%"value="{$LNG.docking_10}" type="button" {if $DISABLED != 0}onclick="repairWreck({$WRECKID});"{/if}>{/if}
               
				{if $WRECKSTATUS == 0}
				
                    <input class="xdock6 {if $ISACTIVEBIS == 1}abovemark{else}disabled{/if} " {if $ISACTIVEBIS == 1}{else}style="display:none"{/if} value="Instant repair" {if $WRECKSTATUS == 0 && $ISACTIVE == 1}onclick="instantWreck({$WRECKID});"{/if} type="button">
                </div>
				{/if}
                   
                    
										
               		                          
                </div>
          	</div>
        </div></div>
	
	<div id="build_elements" class="officier_elements prem_shop">
    <div class="build_box">
        <div class="head" onclick="OpenBox('open_list');">
            <span>{if $WRECKSTATUS == 0}{$LNG.docking_5}{else}{$LNG.docking_6}{/if}:</span>
            <span id="open_btn_open_list" class="prem_open_btn">-</span>            
        </div>
        <div id="box_open_list" class="content_box" style="height: auto; display: block;">
			<div style="    padding: 10px;" >
           {foreach $WRECKSLIST as $shipID => $Element}
                        <div class="xdock8" style="background:#000 url('styles/theme/gow/wrecks/{$shipID}.jpg');"id="ship204" title="{$LNG.tech.{$shipID}}">
                        <span class="xdock9">
                            <span class="xdock11"{if $DIFFTIME < $Element.BuildTime}class="level xdock10" style="color:red;"{/if}>{if $WRECKSTATUS == 0}{shortly_number($Element.fleetAmount)}{else}{shortly_number($Element.RebuildList)}/{shortly_number($Element.fleetAmount)}{/if}</span>
                        </span>
                        {if $WRECKSTATUS == 0}<span class="xdock4">{$Element.BuildTime|time}</span>{/if}
                    </div>
				{/foreach}
                
                <div class="clearfix"></div></div>
        </div>
    </div>
</div>

   


		<div class="clear"></div>
	
</div>
	
            <div class="clear"></div>     
            </div>         
        </div>




{/block}
{block name="script" append}
<script type="text/javascript">
	lngWreckComfirm		= '{$LNG.docking_15}';
	priceInstant		= '{$PRICE}';
	
	
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