 </div>
<br>
<div class="content_box">

    	                      <div class="right_part" style="width: 100%">
							   <div class="head" style="background: #091d2e;position: relative;z-index: 2;height: 24px;    line-height: 24px;Margin-bottom: 5px;width: 95%;padding-right: 10px;padding-left: 10px;border: 1px #000 solid;">
				
           {$LNG.bonus_head}
		   
		   {if $FleetInfo.type_gun > 0}       
              <img alt="{if $FleetInfo.type_gun == 1} {$LNG.tech.71} {elseif $FleetInfo.type_gun == 2} {$LNG.tech.72} {elseif $FleetInfo.type_gun == 3} {$LNG.tech.73} {else} niente{/if}" style="height: 15px;width: 15px;float:right;padding: 4px;margin-left: 2px;" src="./styles/theme/gow/gebaeude/7{$FleetInfo.type_gun}.gif">
           
            <span style="float:right;color: #6d6d6d;">{if $FleetInfo.type_gun == 1} {$LNG.tech.71} {elseif $FleetInfo.type_gun == 2} {$LNG.tech.72} {elseif $FleetInfo.type_gun == 3} {$LNG.tech.73} {else} niente{/if}</span>
           	{/if}	
            </div>
			
			
			{if $elementID ==214 && $UserID ==10283}
			<div class="record_rows" style="padding: 0px;width:33%;">
               <div class="record_img_utits" style="padding: 5px; height: 15px;width: 15px;">        
              <img alt="" src="./styles/images/iconav/trash_big.png">
            </div>
             <div class="record_name_utits" style="line-height: 25px;    width: 70%;    height: 10px;">
          50% {$LNG.gl_debris}
            </div>
                        
                    </div>
					<div class="record_rows" style="padding: 0px;width:33%;float: left;">
               <div class="record_img_utits" style="padding: 5px; height: 15px;width: 15px;">        
              <img alt="" src="./styles/images/iconav/fleet.png">
            </div>
             <div class="record_name_utits" style="line-height: 25px;    width: 70%;     height: 10px;">
          {$LNG.fl_bonus_attack}
            </div>
                        
                    </div>
					<div class="record_rows" style="padding: 0px;width:33%;float: right;">
               <div class="record_img_utits" style="padding: 5px; height: 15px;width: 15px;">        
              <img alt="" src="./styles/images/iconav/distruggi.png">
            </div>
             <div class="record_name_utits" style="line-height: 25px;    width: 70%;   height: 10px;">
          {$LNG.type_mission.9} {$LNG.fcm_moon}
            </div>
                        
                    </div>
			
			{/if}
			{if $FleetInfo.fleetDits != 0}
			{foreach $FleetInfo.fleetDit as $wapID => $Element}
                 <div class="record_rows" style="padding: 0px">
               <div class="record_img_utits" style="padding: 5px; height: 15px;width: 15px;">        
              <img alt="" src="./styles/theme/gow/gebaeude/{$wapID}.gif">
            </div>
             <div class="record_name_utits" style="line-height: 25px;width: 80%;     height: 10px;">
            {$Element.lngid}
               {if $Element.amoutn3 > 0} <span class="tooltip" data-tooltip-content="<b>{$LNG.lm_arsenal}</b>: {$Element.lngid2}" style="color:green; cursor:help;"> +{$Element.amoutn3}</span>{/if}
               {if $Element.amoutn2 > 0} <span class="tooltip" data-tooltip-content="<b>{$LNG.bd_tech}</b>: {$Element.lngid}" style="color:#F90; cursor:help;"> +{$Element.amoutn2}</span>{/if}
            </div>
                        
                    </div>{/foreach}  

				{/if}	 </div>
					
						 			
    	        </div>
					
		<div class="content_box">
		{if !empty($FleetInfo.speed1) && !empty($FleetInfo.consumption1)}
                                <div class="left_part" style="width:33.3%">
                 <div class="record_rows" style="padding: 0px">
				 <div class="head" style="background: #091d2e;position: relative;z-index: 2;height: 24px;line-height: 24px; padding: 0 7px 0 9px;">
				 <a href="#" class="tooltip interrogation" style="margin-top: 4px;"data-tooltip-content="{if $FleetInfo.techSpeed == 1}{$LNG.tech.115}{elseif $FleetInfo.techSpeed == 2}{$LNG.tech.117}{elseif $FleetInfo.techSpeed == 3}{$LNG.tech.118}{/if}">?</a>
           {$LNG.in_engine}
            </div>
               <div class="record_img_utits" style="padding: 5px;">        
                	<img alt="" src="./styles/theme/gow/gebaeude/{if $FleetInfo.techSpeed == 1}115{elseif $FleetInfo.techSpeed == 2}117{elseif $FleetInfo.techSpeed == 3}118{/if}.gif">
            </div>
             <div class="record_name_utits" style="line-height: 40px;width: 127px;;">
              <span>{$FleetInfo.speed1|number} <sup style="color:green; cursor:help;"  class="tooltip" data-tooltip-content="{$LNG.in_bonus}">(+{$FleetInfo.speedBon|number})</sup></span> {*{if $FleetInfo.speed1 != $FleetInfo.speed2} <span style="color:yellow">({$FleetInfo.speed2|number})</span>{/if}*}
						<!--{if $FleetInfo.speedTech > 0} <span class="tooltip" data-tooltip-content="<b>{$LNG.lm_arsenal}</b>:  {if $FleetInfo.techSpeed == 1}{$LNG.tech.115}{elseif $FleetInfo.techSpeed == 2}{$LNG.tech.117}{elseif $FleetInfo.techSpeed == 3}{$LNG.tech.118}{/if}" style="color:green; cursor:help;"> +{$FleetInfo.speedTech}</span>{/if}-->
            </div>
                        <div class="required_blocks">
						
						                                
                            </div>
                    </div>    </div>{/if}
    	         
				 {if !empty($FleetInfo.consumption1)}
                                <div class="left_part" style="width:33.3%">
                 <div class="record_rows" style="padding: 0px">
				 <div class="head" style="background: #091d2e;position: relative;z-index: 2;height: 24px;line-height: 24px; padding: 0 7px 0 9px;">
           {$LNG.ally_fractions_29}
            </div>
               <div class="record_img_utits" style="padding: 5px;">        
                	<img alt="" src="./styles/images/iconav/shipdesc3.png">
            </div>
            <div class="record_name_utits" style="line-height: 40px;width: 50%;">
             {$FleetInfo.consumption1|number}{if $FleetInfo.consumption1 != $FleetInfo.consumption2} <span style="color:yellow">({$FleetInfo.consumption2|number})</span>{/if}
            </div>
                        <div class="required_blocks">
						
						                                
                            </div>
                    </div>    </div>{/if}
					
					 
					
					
					    {if !empty($FleetInfo.capacity)}
                <div class="left_part" style="width: 33.3%">                    
                 <div class="record_rows" style="padding: 0px">
				 <div class="head" style="background: #091d2e;position: relative;z-index: 2;height: 24px;line-height: 24px; padding: 0 7px 0 9px;">
                    
       
            {$LNG.in_capacity}
        
		  
            </div>
            <div class="record_img_utits" style="padding: 5px;">
                	<img alt="" src="./styles/images/iconav/shipdesc1.png">
            </div>
            <div class="record_name_utits" style="line-height: 40px;width: 50%;">
                {$FleetInfo.capacity|number}
            </div>
                        <div class="required_blocks">
						
						                                
                            </div>
                    </div> </div>{/if}
				 
				 
				  </div>
				 
				 
                <div class="content_box">
                    
                  {if !empty($FleetInfo.attack)}
                                <div class="left_part" style="width:33.3%">
                 <div class="record_rows" style="padding: 0px">
				 <div class="head" style="background: #091d2e;position: relative;z-index: 2;height: 24px;line-height: 24px; padding: 0 7px 0 9px;">
           {$LNG.fl_bonus_attack} standard
            </div>
               <div class="record_img_utits" style="padding: 5px;">        
                	<img alt="" src="./styles/images/iconav/shipdesc5.png">
            </div>
            <div class="record_name_utits" style="line-height: 40px;width: 50%;">
            {$FleetInfo.attack|number}
            </div>
                        <div class="required_blocks">
						
						                                
                            </div>
                    </div>    </div>{else}
					<div class="left_part" style="width:33.3%">
                 <div class="record_rows" style="padding: 0px">
				 <div class="head" style="background: #091d2e;position: relative;z-index: 2;height: 24px;line-height: 24px; padding: 0 7px 0 9px;">
           {$LNG.fl_bonus_attack} standard
            </div>
               <div class="record_img_utits" style="padding: 5px;">        
                	<img alt="" src="./styles/images/iconav/shipdesc5.png">
            </div>
            <div class="record_name_utits" style="line-height: 40px;width: 50%;">
            {$LNG.gl_no} {$LNG.fl_bonus_attack}
            </div>
                        <div class="required_blocks">
						
						                                
                            </div>
                    </div>    </div>{/if}
					
				<div class="left_part" style="width: 33.3%">                    
                 <div class="record_rows" style="padding: 0px">
				 <div class="head" style="background: #091d2e;position: relative;z-index: 2;height: 24px;line-height: 24px; padding: 0 7px 0 9px;">  
            {$LNG.fl_bonus_shield}
            </div>
          <div class="record_img_utits" style="padding: 5px;">
                	<img alt="" src="./styles/images/iconav/shipdesc4.png">
                
            </div>
            <div class="record_name_utits" style="line-height: 40px;width: 69%;">
                {$FleetInfo.shield|number}
			{if $FleetInfo.arsShield > 0} <sup class="tooltip" style="color:green; cursor:help;" data-tooltip-content="<b>{$LNG.lm_arsenal}</b>: {if $elementID ==212 or $elementID == 202 or $elementID == 203 or $elementID == 204 or $elementID == 205}{$LNG.market_12}{elseif $elementID ==219 or $elementID == 211 or $elementID == 213 or $elementID == 215 or $elementID == 217 or $elementID == 207 or $elementID == 209 or $elementID == 206}{$LNG.market_13}{else}{$LNG.market_14}{/if}"> +{$FleetInfo.arsShield}</sup>{/if}
            </div>
                        <div class="required_blocks">
						
						                                
                            </div>
                    </div>    </div>	
                <div class="left_part" style="width: 33.3%">                    
                 <div class="record_rows" style="padding: 0px">
				 <div class="head" style="background: #091d2e;position: relative;z-index: 2;height: 24px;line-height: 24px; padding: 0 7px 0 9px;">
                    
       
            {$LNG.cr_armor}
        
		  
            </div>
            <div class="record_img_utits" style="padding: 5px;">
                	<img alt="" src="./styles/images/iconav/shipdesc2.png">
            </div>
            <div class="record_name_utits" style="line-height: 40px;width: 69%;">
               {$FleetInfo.structure|number} {if $FleetInfo.arsArmor > 0} <sup class="tooltip"  data-tooltip-content="<b>{$LNG.lm_arsenal}</b>: {if $elementID ==212 or $elementID == 202 or $elementID == 203 or $elementID == 204 or $elementID == 205}{$LNG.market_9}{elseif $elementID ==219 or $elementID == 211 or $elementID == 213 or $elementID == 215 or $elementID == 217 or $elementID == 207 or $elementID == 209 or $elementID == 206}{$LNG.market_10}{else}{$LNG.market_11}{/if}"style="color:green; cursor:help;"> +{$FleetInfo.arsArmor}</sup>{/if}
            </div>
                        <div class="required_blocks">
						
						                                
                            </div>
                    </div> </div>
					
                               
					
					</div>
					 <div class="content_box">
                                
          	{if !empty($FleetInfo.rapidfire.to)}
                                <div class="right_part" style="width: 100%">
                 <div class="record_rows" style="padding: 0px">
				 <div class="head" style="background: #091d2e;position: relative;z-index: 2;height: 24px;line-height: 24px; padding: 0 7px 0 9px;">
           {$LNG.in_rf_again}
            </div>
            <div style="float:left; padding: 5px;">
            	{foreach $FleetInfo.rapidfire.to as $rapidfireID => $shoots}	
	   

			<div class="required_block  required_smal_text">
           <a href="#" class="tooltip" data-tooltip-content="<table class='reducefleet_table' style='width:100%'><th>{$LNG.tech.$rapidfireID}</th></table>">
                    <img src="./styles/theme/gow/gebaeude/{$rapidfireID}.gif" alt="{$LNG.tech.$rapidfireID}">
                    {if $academy_p_b_1_1110 == 0}<div class="text" style="color:green">{$shoots|number}</div>{else}<div class="text"><span style="color:orange">{$shoots+($shoots/100*($academy_p_b_1_1110*8))|number}</span></div>{/if}
                </a>           
        </div>
	   {/foreach} 
            </div>
                        <div class="required_blocks">
						
						                                
                            </div>
                    </div>    </div>{/if}
			</div>
			
			
     <div class="content_box">
   		{if !empty($FleetInfo.rapidfire.from)}
                                <div class="right_part" style="width: 100%">
                 <div class="record_rows" style="padding: 0px">
				 <div class="head" style="background: #091d2e;position: relative;z-index: 2;height: 24px;line-height: 24px; padding: 0 7px 0 9px;">
           {$LNG.in_rf_from}
            </div>
            <div style="float:left;padding: 5px;">
            	{foreach $FleetInfo.rapidfire.from as $rapidfireID => $shoots}	
	   

			<div class="required_block  required_smal_text">
           <a href="#" class="tooltip" data-tooltip-content="<table class='reducefleet_table' style='width:100%'><tr><th>{$LNG.tech.$rapidfireID}</th></tr></table>">
                    <img src="./styles/theme/gow/gebaeude/{$rapidfireID}.gif" alt="{$LNG.tech.$rapidfireID}">
                    <div class="text" style="color:red">{$shoots|number}</div>
                </a>              
        </div>
		
        
	   {/foreach} 
            </div>
                        <div class="required_blocks">
						
						                                
                            </div>
                    </div>    </div>{/if}

    	         </div>
    	
    	         
    	        
