{block name="title" prepend}{$LNG.lm_defenses}{/block}
{block name="content"}
<div id="page">
	<div id="content">
	{if !$NotBuilding}<table id="infobox" style="border: 2px solid red; text-align:center;background:transparent" width="70%"><tbody><tr><td>{$LNG.bd_building_shipyard}</td></tr></tbody></table><br><br>{/if}
	{if !empty($BuildList)}
	
	<div id="ship_build_list">
	<span id="timeleft"></span>
    <div id="bx" class="z"></div>    
    <form action="game.php?page=defense" method="post">
    <input name="action" value="delete" type="hidden">
    <div class="multiple_ship">
		<select name="auftr[]" id="auftr" size="7" multiple="">
    		
        <option>&nbsp;</option></select>
    </div>
    <input type="submit" class="btn_del" value="{$LNG.bd_cancel_send}">
    <span class="text_del">{$LNG.bd_cancel_warning}</span>
    </form>    
</div>

{/if}

<form action="game.php?page=defense" method="post">
<div id="build_content" class="conteiner ship_build">
    <div id="fildes_band">
    	<a href="#" id="arrow_question" style="left:5px; right:auto;" onclick="return Dialog.manualinfo(4)" class="interrogation manual">?</a>
		<a href="game.php?page=Resourcecalc&options=400" title="Calculator" class="palanetarium_linck calculette" style="left:30px;top: 5px;width: 17px;height: 16px;"></a>
	   	<a class="bd_dm_buy" href="game.php?page=dmshipyard&amp;mode=defense">{$LNG.ship_dm}</a> &nbsp;&nbsp;
		<span style=" float:left; margin-left:55px;color: #9e9e9e;">{$insta_dm_left}</span>
    </div> 
    <div id="build_elements">
        <div class="build_elements">
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
		{foreach $elementListDefault as $ID => $Element}
		
                        <div id="s_{$ID}" class="build_box {if !$Element.techacc}required{/if}">
    <div class="head">
        <a href="#" onclick="return Dialog.info({$ID})" class="interrogation">?</a>     
		<a href="#" onclick="return Dialog.fullControll({$ID});" class="interrogation" style="right:5px;background:url('media/img/controll.png');"></a>
        <a href="#" onclick="return Dialog.info({$ID})" class="title">
            {$LNG.tech.{$ID}}
        </a> 
		{if $Element.available > 0}
		<span class="tooltip available" data-tooltip-content="{$LNG.customm_12}">(<span id="val_{$ID}">{$Element.available|number}</span>)</span>{/if} <span class="available" style="    cursor: auto;">({$LNG.bd_max_ships} {$Element.maxBuildable})</span>
            </div>
        <div class="content_box">
        <div class="image">
           <a href="#" onclick="return Dialog.info({$ID})"><img src="./styles/theme/gow/gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}"></a>
        </div>
		
		 {if !$Element.techacc}<div class="prices"><div class="price"> {$LNG.Nece}
            </div>  

		{foreach $Element.AllTech as $elementID => $requireList}
		
		
			   {foreach $requireList as $requireID => $NeedLevel}
		
			   {if $NeedLevel.count > $NeedLevel.own}
			    <div class="required_block  required_smal_text">
           <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="{$LNG.academy_39}:<br />{$LNG.tech.{$requireID}} lvl.  {$NeedLevel.count} ">
                    <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.{$requireID}}">
                    <div class="text">{$NeedLevel.count}</div>
                </a>           
        </div>
		{/if}
		{/foreach}

		 {/foreach}
		</div>     {else}
				
        <div class="prices">
		{foreach $Element.costResources as $RessID => $RessAmount}
                            <div class="price res{$RessID} {if $Element.costOverflow[$RessID] == 0}{else}required{/if}">
                    <div class="ico"></div>
                    <div class="text {if $Element.costOverflow[$RessID] == 0}{else}tooltip{/if}" {if $Element.costOverflow[$RessID] == 0}{else}data-tooltip-content="Не хватает: Металл 0"{/if}>{$RessAmount|number}</div>                                        
                </div>
                    {/foreach}                                          
        </div>
		{/if}
        <div class="clear"></div>
        
        <div class="time_build">
				{if !$Element.techacc}{elseif $Element.elementTime == 0}{elseif $Element.UnitsSecond == 0}
                     {$LNG.fgf_time}: <span class="time_build_text"> {$Element.elementTime|time} </span> 
					 {else}
					 
					 {$LNG.customm_13}: <span class="time_build_text">{$Element.UnitsSecond} {$LNG.customm_14}</span>
            	                    <a href="game.php?page=conveyors&amp;class=l" class="conveyors_up_item tooltip" data-tooltip-content="{$LNG.customm_15}">⇑</a>
					 {/if}
             
        </div>
		    
		
		{if $Element.available > 0 && $Element.techacc && in_array($ID, [407,408,409,411])}
				<div class="break_build tooltip_sticky" data-tooltip-content="
                <table class='tooltip_class_table'>
            	<tr><th colspan='2' style='    text-align: left;'>{$LNG.tech.{$ID}} <span style='color:#ccc;float: right;font-size: 9px;'>{$LNG.ft_charge}: 40%</span> </th></tr>
				<tr>
				<td class='tooltip_class_td_img'><img src='./styles/theme/gow/gebaeude/{$ID}.gif' alt='{$LNG.tech.{$ID}}'></td><td class='tooltip_class_table_text_left'>
				<div>
				<div style='width:100%;'>        
        	<div class='imper_block_td'>
            	<div class='occupancy occupancy_901' style='width:100%'></div>
            	<div class='text_res ' style='text-align:left;left:5px'><span>{$LNG.tech.901}:</span><span id='total_metal_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>            
            <div class='imper_block_td'>
            	<div class='occupancy occupancy_902' style='width:100%'></div>
           		<div class='text_res ' style='text-align:left;left:5px'> <span>{$LNG.tech.902}:</span> <span id='total_crystal_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>         
            <div class='imper_block_td'>
            	<div class='occupancy occupancy_903' style='width:100%'></div>
            	<div class='text_res ' style='text-align:left;left:5px'><span>{$LNG.tech.903}:</span><span id='total_deuterium_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>
			 <div class='imper_block_td'>
            	<div class='occupancy occupancy_904' style='width:100%'></div>
            	<div class='text_res ' style='text-align:left;left:5px'><span>{$LNG.tech.921}:</span><span id='total_darkmatter_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>
        </div> </div>  </td>
		</tr><form id='formDestroy_{$ID}' method='post'>
		<tr><th colspan='2'>	{$LNG.ft_count}: <input type='text' value='0' id='{$ID}_input' name='{$ID}' onkeyup='Total({$ID});' style='background: #000;border: 1px solid #001a40;'>
		<button onclick='MaxShips({$ID});'>{$LNG.ft_max}</button>
		 <td id='{$ID}_value' style='display:none;'>{$Element.available|number}</td>
		 
		 </th></tr>
		 
				<tr>              
                <td colspan='2' class='tooltip_class_table_text_left'>
				<input type='submit' id='submit' onclick='SendForm({$ID});' value='{$LNG.bd_dismantle}' class='build_submit onlist tooltip_class_a_bigbtn' style='width:50%;float:left'>
				<input type='submit' id='submit2' onclick='SendForm2({$ID});' value='{$LNG.al_create} {$LNG.gl_debris}' class='build_submit onlist tooltip_class_a_bigbtn creadetriti' style='background: #1e112d;'>
				
                </td></tr>
			</form>
                </table>">&dArr;</div>
				{/if}
        
        <div class="clear"></div>
		
		{if !$Element.techacc}{else}
		{if $Element.AlreadyBuild}<div class="btn_build_border"><span class="btn_build red">{$bd_protection_shield_only_one}</span></div>{elseif $NotBuilding && $Element.buyable}
                <div class="btn_build_border btn_build_border_left">
				
        	<label title="{$LNG.bd_max_ships}" onclick="$('#input_{$ID}').val('{$Element.maxBuildable}'); counting('{$ID}');" class="max_btn_ship">{$LNG.bd_max_ships}</label>
        	<div class="div_text count_ships_dots">
            	<input onkeyup="counting('{$ID}');" name="fmenge[{$ID}]" id="input_{$ID}" size="{$maxlength}" maxlength="{$maxlength}" value="0" class="text" tabindex="{$smarty.foreach.FleetList.iteration}" type="text">	
            </div>
			
        </div>
		
		
		
        <div class="btn_build_border btn_build_border_right">
        	<input value="{$LNG.bd_build}" class="input_btn" type="submit">
        </div> 
		{elseif !$Element.buyable}<div class="btn_build_border">
		<span class="btn_build red">{$LNG.build_nores}</span>
		</div> {/if}
		{/if}
                <div class="clear"></div>
    </div>
	</div>
	
	{/foreach}
                    <div class="clear"></div>
					
					
        </div>
        
		
		
		
		
		
        <div class="build_band_conveyors" id="s_light">
            <span>{$LNG.ship_light}</span>
			
			{if $convLight > 0}<div class="gr_btn_top" style="float:right;margin-right: 10px;"><a class="batn_lincks" href="game.php?page=conveyors&amp;class=l">{$LNG.improve_lig}</a></div>{/if}
			
                    </div>
        <div class="build_elements light_ship">        	
                                            	                   {foreach $elementListLight as $ID => $Element}
		
                        <div id="s_{$ID}" class="build_box {if !$Element.techacc}required{/if}">
    <div class="head">
        <a href="#" onclick="return Dialog.info({$ID})" class="interrogation">?</a> 
		<a href="#" onclick="return Dialog.fullControll({$ID});" class="interrogation" style="right:5px;background:url('media/img/controll.png');"></a>
        <a href="#" onclick="return Dialog.info({$ID})" class="title">
            {$LNG.tech.{$ID}}
        </a> 
		{if $Element.available > 0}
		<span class="tooltip available" data-tooltip-content="{$LNG.customm_12}">(<span id="val_{$ID}">{$Element.available|number}</span>)</span> {/if}  
            </div>
        <div class="content_box">
        <div class="image">
           <a href="#" onclick="return Dialog.info({$ID})"><img src="./styles/theme/gow/gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}"></a>
        </div>
		
		 {if !$Element.techacc}<div class="prices"><div class="price"> {$LNG.Nece}
            </div>  

		{foreach $Element.AllTech as $elementID => $requireList}
		
		
			   {foreach $requireList as $requireID => $NeedLevel}
		
			   {if $NeedLevel.count > $NeedLevel.own}
			    <div class="required_block  required_smal_text">
           <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="{$LNG.academy_39}:<br />{$LNG.tech.{$requireID}} lvl.  {$NeedLevel.count} ">
                    <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.{$requireID}}">
                    <div class="text">{$NeedLevel.count}</div>
                </a>           
        </div>
		{/if}
		{/foreach}

		 {/foreach}
		</div>     {else}
				
        <div class="prices">
		{foreach $Element.costResources as $RessID => $RessAmount}
                            <div class="price res{$RessID} {if $Element.costOverflow[$RessID] == 0}{else}required{/if}">
                    <div class="ico"></div>
                    <div class="text {if $Element.costOverflow[$RessID] == 0}{else}tooltip{/if}" {if $Element.costOverflow[$RessID] == 0}{else}data-tooltip-content="Не хватает: Металл 0"{/if}>{$RessAmount|number}</div>                                        
                </div>
                    {/foreach}                                          
        </div>
		{/if}
        <div class="clear"></div>
        
        <div class="time_build">
				{if !$Element.techacc}{elseif $Element.elementTime == 0}{elseif $Element.UnitsSecond == 0}
                     {$LNG.fgf_time}: <span class="time_build_text"> {$Element.elementTime|time} </span> 
					 {else}
					 
					 {$LNG.customm_13}: <span class="time_build_text tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><font style='color:#a47d7a;'>{$LNG.tech.71}</font></th></tr> <tr> <td style='color: darkgray;'>Default</td><td >{$Element.valeurArray.Default|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_bonus} {$LNG.gl_galaxy} 7</td><td >{$Element.valeurArray.getGalaxySevenConv|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.peace_1}</td><td >{$Element.valeurArray.peacefull_exp_light|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.tech.71}</td><td >{$Element.valeurArray.SpecialShip|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.all_devlopment}</td><td >{$Element.valeurArray.hashallyconv1|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.premium_1}</td><td >{$Element.valeurArray.premium_conv_l|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.planet_tele_pla}</td><td >{$Element.valeurArray.planetStructureBonuses|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_arsenal}</td><td >{$Element.valeurArray.arsenal_1_conv|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.tech.604}</td><td >{$Element.valeurArray.rpg_technocrate|number}</td> </tr></tbody></table>">{$Element.UnitsSecond} {$LNG.customm_14}</span>
            	                    <a href="game.php?page=conveyors&amp;class=l" class="conveyors_up_item tooltip" data-tooltip-content="{$LNG.customm_15}">⇑</a>
					 {/if}
             
        </div>
				{if $Element.available > 0 && $Element.techacc}
				<div class="break_build tooltip_sticky" data-tooltip-content="
                <table class='tooltip_class_table'>
            	<tr><th colspan='2' style='    text-align: left;'>{$LNG.tech.{$ID}} <span style='color:#ccc;float: right;font-size: 9px;'>{$LNG.ft_charge}: 40%</span> </th></tr>
				<tr>
				<td class='tooltip_class_td_img'><img src='./styles/theme/gow/gebaeude/{$ID}.gif' alt='{$LNG.tech.{$ID}}'></td><td class='tooltip_class_table_text_left'>
				<div>
				<div style='width:100%;'>        
        	<div class='imper_block_td'>
            	<div class='occupancy occupancy_901' style='width:100%'></div>
            	<div class='text_res ' style='text-align:left;left:5px'><span>{$LNG.tech.901}:</span><span id='total_metal_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>            
            <div class='imper_block_td'>
            	<div class='occupancy occupancy_902' style='width:100%'></div>
           		<div class='text_res ' style='text-align:left;left:5px'> <span>{$LNG.tech.902}:</span> <span id='total_crystal_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>         
            <div class='imper_block_td'>
            	<div class='occupancy occupancy_903' style='width:100%'></div>
            	<div class='text_res ' style='text-align:left;left:5px'><span>{$LNG.tech.903}:</span><span id='total_deuterium_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>
			 <div class='imper_block_td'>
            	<div class='occupancy occupancy_904' style='width:100%'></div>
            	<div class='text_res ' style='text-align:left;left:5px'><span>{$LNG.tech.921}:</span><span id='total_darkmatter_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>
        </div> </div>  </td>
		</tr><form id='formDestroy_{$ID}' method='post'>
		<tr><th colspan='2'>	{$LNG.ft_count}: <input type='text' value='0' id='{$ID}_input' name='{$ID}' onkeyup='Total({$ID});' style='background: #000;border: 1px solid #001a40;'>
		<button onclick='MaxShips({$ID});'>{$LNG.ft_max}</button>
		 <td id='{$ID}_value' style='display:none;'>{$Element.available|number}</td>
		 
		 </th></tr>
		 
				<tr>              
                <td colspan='2' class='tooltip_class_table_text_left'>
				<input type='submit' id='submit' onclick='SendForm({$ID});' value='{$LNG.bd_dismantle}' class='build_submit onlist tooltip_class_a_bigbtn' style='width:50%;float:left'>
				<input type='submit' id='submit2' onclick='SendForm2({$ID});' value='{$LNG.al_create} {$LNG.gl_debris}' class='build_submit onlist tooltip_class_a_bigbtn creadetriti' style='background: #1e112d;'>
				
                </td></tr>
			</form>
                </table>">&dArr;</div>
				{/if}
        <div class="clear"></div>
	

		
		
		{if !$Element.techacc}{elseif $ShowSpecialShips == 0 && $ID == 420}<div class="btn_build_border"><span class="btn_build red">Premium Defense</span></div>{else}
		{if $Element.AlreadyBuild}<span style="color:red">{$bd_protection_shield_only_one}</span>{elseif $NotBuilding && $Element.buyable}
                <div class="btn_build_border btn_build_border_left">
				
        	<label title="{$LNG.bd_max_ships}" onclick="$('#input_{$ID}').val('{$Element.maxBuildable}'); counting('{$ID}');" class="max_btn_ship">{$LNG.bd_max_ships}</label>
        	<div class="div_text count_ships_dots">
            	<input onkeyup="counting('{$ID}');" name="fmenge[{$ID}]" id="input_{$ID}" size="{$maxlength}" maxlength="{$maxlength}" value="0" class="text" tabindex="{$smarty.foreach.FleetList.iteration}" type="text">	
            </div>
			
        </div>
		
		
		
        <div class="btn_build_border btn_build_border_right">
        	<input value="{$LNG.bd_build}" class="input_btn" type="submit">
        </div> 
		{elseif !$Element.buyable}<div class="btn_build_border">
		<span class="btn_build red">{$LNG.build_nores}</span>
		</div> {/if}
		{/if}
                <div class="clear"></div>
    </div>
	</div>
	
	{/foreach}
                                                                                                                                                       
        <div class="clear"></div>
        </div>
                <div class="build_band_conveyors" id="s_middle">
            <span>{$LNG.ship_medium}</span>
			{if $convMedium > 0}<div class="gr_btn_top" style="float:right;margin-right: 10px;"><a class="batn_lincks" href="game.php?page=conveyors&amp;class=m">{$LNG.improve_mid}</a></div>{/if}
                    </div>
        <div class="build_elements medium_ship">
                           {foreach $elementListMedium as $ID => $Element}
		
                        <div id="s_{$ID}" class="build_box {if !$Element.techacc}required{/if}">
    <div class="head">
        <a href="#" onclick="return Dialog.info({$ID})" class="interrogation">?</a>  
		<a href="#" onclick="return Dialog.fullControll({$ID});" class="interrogation" style="right:5px;background:url('media/img/controll.png');"></a>
        <a href="#" onclick="return Dialog.info({$ID})" class="title">
            {$LNG.tech.{$ID}}
        </a>
		{if $Element.available > 0}
		<span class="tooltip available" data-tooltip-content="{$LNG.customm_12}">(<span id="val_{$ID}">{$Element.available|number}</span>)</span> {/if}  
            </div>
        <div class="content_box">
        <div class="image">
           <a href="#" onclick="return Dialog.info({$ID})"><img src="./styles/theme/gow/gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}"></a>
        </div>
		
		 {if !$Element.techacc}<div class="prices"><div class="price"> {$LNG.Nece}
            </div>  

		{foreach $Element.AllTech as $elementID => $requireList}
		
		
			   {foreach $requireList as $requireID => $NeedLevel}
		
			   {if $NeedLevel.count > $NeedLevel.own}
			    <div class="required_block  required_smal_text">
           <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="{$LNG.academy_39}:<br />{$LNG.tech.{$requireID}} lvl.  {$NeedLevel.count} ">
                    <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.{$requireID}}">
                    <div class="text">{$NeedLevel.count}</div>
                </a>           
        </div>
		{/if}
		{/foreach}

		 {/foreach}
		</div>     {else}
				
        <div class="prices">
		{foreach $Element.costResources as $RessID => $RessAmount}
                            <div class="price res{$RessID} {if $Element.costOverflow[$RessID] == 0}{else}required{/if}">
                    <div class="ico"></div>
                    <div class="text {if $Element.costOverflow[$RessID] == 0}{else}tooltip{/if}" {if $Element.costOverflow[$RessID] == 0}{else}data-tooltip-content="Не хватает: Металл 0"{/if}>{$RessAmount|number}</div>                                        
                </div>
                    {/foreach}                                          
        </div>
		{/if}
        <div class="clear"></div>
        
        <div class="time_build">
				{if !$Element.techacc}{elseif $Element.elementTime == 0}{elseif $Element.UnitsSecond == 0}
                     {$LNG.fgf_time}: <span class="time_build_text"> {$Element.elementTime|time} </span> 
					 {else}
					 
					 {$LNG.customm_13}: <span class="time_build_text tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><font style='color:#a47d7a;'>{$LNG.tech.72}</font></th></tr> <tr> <td style='color: darkgray;'>Default</td><td >{$Element.valeurArray.Default|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_bonus} {$LNG.gl_galaxy} 7</td><td >{$Element.valeurArray.getGalaxySevenConv|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.peace_1}</td><td >{$Element.valeurArray.peacefull_exp_light|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.tech.72}</td><td >{$Element.valeurArray.SpecialShip|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.all_devlopment}</td><td >{$Element.valeurArray.hashallyconv1|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.premium_1}</td><td >{$Element.valeurArray.premium_conv_l|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.planet_tele_pla}</td><td >{$Element.valeurArray.planetStructureBonuses|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_arsenal}</td><td >{$Element.valeurArray.arsenal_1_conv|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.tech.604}</td><td >{$Element.valeurArray.rpg_technocrate|number}</td> </tr></tbody></table>">{$Element.UnitsSecond} {$LNG.customm_14}</span>
            	                    <a href="game.php?page=conveyors&amp;class=m" class="conveyors_up_item tooltip" data-tooltip-content="{$LNG.customm_15}">⇑</a>
					 {/if}
             
        </div>
              {if $Element.available > 0 && $Element.techacc}
				<div class="break_build tooltip_sticky" data-tooltip-content="
                <table class='tooltip_class_table'>
            	<tr><th colspan='2' style='    text-align: left;'>{$LNG.tech.{$ID}} <span style='color:#ccc;float: right;font-size: 9px;'>{$LNG.ft_charge}: 40%</span> </th></tr>
				<tr>
				<td class='tooltip_class_td_img'><img src='./styles/theme/gow/gebaeude/{$ID}.gif' alt='{$LNG.tech.{$ID}}'></td><td class='tooltip_class_table_text_left'>
				<div>
				<div style='width:100%;'>        
        	<div class='imper_block_td'>
            	<div class='occupancy occupancy_901' style='width:100%'></div>
            	<div class='text_res ' style='text-align:left;left:5px'><span>{$LNG.tech.901}:</span><span id='total_metal_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>            
            <div class='imper_block_td'>
            	<div class='occupancy occupancy_902' style='width:100%'></div>
           		<div class='text_res ' style='text-align:left;left:5px'> <span>{$LNG.tech.902}:</span> <span id='total_crystal_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>         
            <div class='imper_block_td'>
            	<div class='occupancy occupancy_903' style='width:100%'></div>
            	<div class='text_res ' style='text-align:left;left:5px'><span>{$LNG.tech.903}:</span><span id='total_deuterium_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>
			 <div class='imper_block_td'>
            	<div class='occupancy occupancy_904' style='width:100%'></div>
            	<div class='text_res ' style='text-align:left;left:5px'><span>{$LNG.tech.921}:</span><span id='total_darkmatter_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>
        </div> </div>  </td>
		</tr><form id='formDestroy_{$ID}' method='post'>
		<tr><th colspan='2'>	{$LNG.ft_count}: <input type='text' value='0' id='{$ID}_input' name='{$ID}' onkeyup='Total({$ID});' style='background: #000;border: 1px solid #001a40;'>
		<button onclick='MaxShips({$ID});'>{$LNG.ft_max}</button>
		 <td id='{$ID}_value' style='display:none;'>{$Element.available|number}</td>
		 
		 </th></tr>
		 
				<tr>              
                <td colspan='2' class='tooltip_class_table_text_left'>
				<input type='submit' id='submit' onclick='SendForm({$ID});' value='{$LNG.bd_dismantle}' class='build_submit onlist tooltip_class_a_bigbtn' style='width:50%;float:left'>
				<input type='submit' id='submit2' onclick='SendForm2({$ID});' value='{$LNG.al_create} {$LNG.gl_debris}' class='build_submit onlist tooltip_class_a_bigbtn creadetriti' style='background: #1e112d;'>
				
                </td></tr>
			</form>
                </table>">&dArr;</div>
		{/if}
        <div class="clear"></div>
		
		{if !$Element.techacc}{elseif $ShowSpecialShips == 0 && $ID == 421}<div class="btn_build_border"><span class="btn_build red">Premium Defense</span></div>{else}
		{if $Element.AlreadyBuild}<span style="color:red">{$bd_protection_shield_only_one}</span>{elseif $NotBuilding && $Element.buyable}
                <div class="btn_build_border btn_build_border_left">
				
        	<label title="{$LNG.bd_max_ships}" onclick="$('#input_{$ID}').val('{$Element.maxBuildable}'); counting('{$ID}');" class="max_btn_ship">{$LNG.bd_max_ships}</label>
        	<div class="div_text count_ships_dots">
            	<input onkeyup="counting('{$ID}');" name="fmenge[{$ID}]" id="input_{$ID}" size="{$maxlength}" maxlength="{$maxlength}" value="0" class="text" tabindex="{$smarty.foreach.FleetList.iteration}" type="text">	
            </div>
			
        </div>
		
		
		
        <div class="btn_build_border btn_build_border_right">
        	<input value="{$LNG.bd_build}" class="input_btn" type="submit">
        </div> 
		{elseif !$Element.buyable}<div class="btn_build_border">
		<span class="btn_build red">{$LNG.build_nores}</span>
		</div> {/if}
		{/if}
                <div class="clear"></div>
    </div>
	</div>
	
	{/foreach}
                                                                                                                                                                                                            <div class="clear"></div>
        </div>
                <div class="build_band_conveyors" id="s_heavy">
            <span>{$LNG.ship_heavy}</span>
			{if $convHeavy > 0}<div class="gr_btn_top" style="float:right;margin-right: 10px;"><a class="batn_lincks" href="game.php?page=conveyors&amp;class=h">{$LNG.improve_heav}</a></div>{/if}
                    </div>
        <div class="build_elements heavy_ship">
                                            	                    {foreach $elementListHeavy as $ID => $Element}
		
                        <div id="s_{$ID}" class="build_box {if !$Element.techacc}required{/if}">
    <div class="head">
        <a href="#" onclick="return Dialog.info({$ID})" class="interrogation">?</a>          
		<a href="#" onclick="return Dialog.fullControll({$ID});" class="interrogation" style="right:5px;background:url('media/img/controll.png');"></a>
        <a href="#" onclick="return Dialog.info({$ID})" class="title">
            {$LNG.tech.{$ID}}
        </a>
		{if $Element.available > 0}
		<span class="tooltip available" data-tooltip-content="{$LNG.customm_12}">(<span id="val_{$ID}">{$Element.available|number}</span>)</span> {/if}  
            </div>
        <div class="content_box">
        <div class="image">
           <a href="#" onclick="return Dialog.info({$ID})"><img src="./styles/theme/gow/gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}"></a>
        </div>
		
		 {if !$Element.techacc}<div class="prices"><div class="price"> {$LNG.Nece}
            </div>  

		{foreach $Element.AllTech as $elementID => $requireList}
		
		
			   {foreach $requireList as $requireID => $NeedLevel}
		
			   {if $NeedLevel.count > $NeedLevel.own}
			    <div class="required_block  required_smal_text">
           <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="{$LNG.academy_39}:<br />{$LNG.tech.{$requireID}} lvl.  {$NeedLevel.count} ">
                    <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}gif{/if}" alt="{$LNG.tech.{$requireID}}">
                    <div class="text">{$NeedLevel.count}</div>
                </a>           
        </div>
		{/if}
		{/foreach}

		 {/foreach}
		</div>     {else}
				
        <div class="prices">
		{foreach $Element.costResources as $RessID => $RessAmount}
                            <div class="price res{$RessID} {if $Element.costOverflow[$RessID] == 0}{else}required{/if}">
                    <div class="ico"></div>
                    <div class="text {if $Element.costOverflow[$RessID] == 0}{else}tooltip{/if}" {if $Element.costOverflow[$RessID] == 0}{else}data-tooltip-content="Не хватает: Металл 0"{/if}>{$RessAmount|number}</div>                                        
                </div>
                    {/foreach}                                          
        </div>
		{/if}
        <div class="clear"></div>
        
        <div class="time_build">
				{if !$Element.techacc}{elseif $Element.elementTime == 0}{elseif $Element.UnitsSecond == 0}
                     {$LNG.fgf_time}: <span class="time_build_text"> {$Element.elementTime|time} </span> 
					 {else}
					  
					 {$LNG.customm_13}: <span class="time_build_text tooltip" data-tooltip-content="<table class='tooltip_class_table'> <tbody><tr><th colspan='2'><font style='color:#a47d7a;'>{$LNG.tech.73}</font></th></tr> <tr> <td style='color: darkgray;'>Default</td><td >{$Element.valeurArray.Default|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_bonus} {$LNG.gl_galaxy} 7</td><td >{$Element.valeurArray.getGalaxySevenConv|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.peace_1}</td><td >{$Element.valeurArray.peacefull_exp_light|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.tech.73}</td><td >{$Element.valeurArray.SpecialShip|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.all_devlopment}</td><td >{$Element.valeurArray.hashallyconv1|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.premium_1}</td><td >{$Element.valeurArray.premium_conv_l|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.planet_tele_pla}</td><td >{$Element.valeurArray.planetStructureBonuses|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.lm_arsenal}</td><td >{$Element.valeurArray.arsenal_1_conv|number}</td> </tr><tr> <td style='color: darkgray;'>{$LNG.tech.604}</td><td >{$Element.valeurArray.rpg_technocrate|number}</td> </tr></tbody></table>">{$Element.UnitsSecond} {$LNG.customm_14}</span>
            	                    <a href="game.php?page=conveyors&amp;class=h" class="conveyors_up_item tooltip" data-tooltip-content="{$LNG.customm_15}">⇑</a>
					 {/if}
             
        </div>
                {if $Element.available > 0 && $Element.techacc}
				<div class="break_build tooltip_sticky" data-tooltip-content="
                <table class='tooltip_class_table'>
            	<tr><th colspan='2' style='    text-align: left;'>{$LNG.tech.{$ID}} <span style='color:#ccc;float: right;font-size: 9px;'>{$LNG.ft_charge}: 40%</span> </th></tr>
				<tr>
				<td class='tooltip_class_td_img'><img src='./styles/theme/gow/gebaeude/{$ID}.gif' alt='{$LNG.tech.{$ID}}'></td><td class='tooltip_class_table_text_left'>
				<div>
				<div style='width:100%;'>        
        	<div class='imper_block_td'>
            	<div class='occupancy occupancy_901' style='width:100%'></div>
            	<div class='text_res ' style='text-align:left;left:5px'><span>{$LNG.tech.901}:</span><span id='total_metal_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>            
            <div class='imper_block_td'>
            	<div class='occupancy occupancy_902' style='width:100%'></div>
           		<div class='text_res ' style='text-align:left;left:5px'> <span>{$LNG.tech.902}:</span> <span id='total_crystal_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>         
            <div class='imper_block_td'>
            	<div class='occupancy occupancy_903' style='width:100%'></div>
            	<div class='text_res ' style='text-align:left;left:5px'><span>{$LNG.tech.903}:</span><span id='total_deuterium_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>
			 <div class='imper_block_td'>
            	<div class='occupancy occupancy_904' style='width:100%'></div>
            	<div class='text_res ' style='text-align:left;left:5px'><span>{$LNG.tech.921}:</span><span id='total_darkmatter_{$ID}' style='font-weight:800;'> 0</span></div>
            </div>
        </div> </div>  </td>
		</tr><form id='formDestroy_{$ID}' method='post'>
		<tr><th colspan='2'>	{$LNG.ft_count}: <input type='text' value='0' id='{$ID}_input' name='{$ID}' onkeyup='Total({$ID});' style='background: #000;border: 1px solid #001a40;'>
		<button onclick='MaxShips({$ID});'>{$LNG.ft_max}</button>
		 <td id='{$ID}_value' style='display:none;'>{$Element.available|number}</td>
		 
		 </th></tr>
		 
				<tr>              
                <td colspan='2' class='tooltip_class_table_text_left'>
				<input type='submit' id='submit' onclick='SendForm({$ID});' value='{$LNG.bd_dismantle}' class='build_submit onlist tooltip_class_a_bigbtn' style='width:50%;float:left'>
				<input type='submit' id='submit2' onclick='SendForm2({$ID});' value='{$LNG.al_create} {$LNG.gl_debris}' class='build_submit onlist tooltip_class_a_bigbtn creadetriti' style='background: #1e112d;'>
				
                </td></tr>
			</form>
                </table>">&dArr;</div>
		{/if}
        <div class="clear"></div>
		
		{if !$Element.techacc}{elseif $ShowSpecialShips == 0 && $ID == 422}<div class="btn_build_border"><span class="btn_build red">Premium Defense</span></div>{else}
		{if $Element.AlreadyBuild}<span style="color:red">{$bd_protection_shield_only_one}</span>{elseif $NotBuilding && $Element.buyable}
                <div class="btn_build_border btn_build_border_left">
				
        	<label title="{$LNG.bd_max_ships}" onclick="$('#input_{$ID}').val('{$Element.maxBuildable}'); counting('{$ID}');" class="max_btn_ship">{$LNG.bd_max_ships}</label>
        	<div class="div_text count_ships_dots">
            	<input onkeyup="counting('{$ID}');" name="fmenge[{$ID}]" id="input_{$ID}" size="{$maxlength}" maxlength="{$maxlength}" value="0" class="text" tabindex="{$smarty.foreach.FleetList.iteration}" type="text">	
            </div>
			
        </div>
		
		
		
        <div class="btn_build_border btn_build_border_right">
        	<input value="{$LNG.bd_build}" class="input_btn" type="submit">
        </div> 
		{elseif !$Element.buyable}<div class="btn_build_border">
		<span class="btn_build red">{$LNG.build_nores}</span>
		</div> {/if}
		{/if}
                <div class="clear"></div>
    </div>
	</div>
	
	{/foreach}
                                                                                                                                                                                                                                                                    <div class="clear"></div>
        </div>
    </div> 
           

    </div>
</form>

<script type="text/javascript">
	data			= {$BuildList|json};
	DatatList		= {
	
	{foreach $elementListall as $ID => $Element}
	"{$ID}":{ "id":"{$ID}","available":"{$Element.available|number}","costRessources":{ {foreach $Element.costResources as $RessID => $RessAmount}"{$RessID}":{$RessAmount}{if !$RessAmount@last},{/if}{/foreach} },"costOverflow":{ {foreach $Element.costOverflow as $RessID => $RessAmount}"{$RessID}":{$RessAmount}{if !$RessAmount@last},{/if}{/foreach} },"elementTime":{$Element.elementTime},"buyable":true,"maxBuildable":"{$Element.maxBuildable}","AlreadyBuild":false,"AlreadyBuildOne":false,"actionUnit":true }{if !$Element@last},{/if}
	{/foreach}
	
	};
	MaxCount		= 50000000;
	bd_operating	= '{$LNG.bd_operating}';
	LNGning			= '{$LNG.bd_remaining}:';
	LNGtech901		= '{$LNG.tech.901}';
	LNGtech902		= '{$LNG.tech.902}';
	LNGtech903		= '{$LNG.tech.903}';
	LNGtech911		= '{$LNG.tech.911}';
	LNGtech921		= '{$LNG.tech.921}';
	short_day 		= '{$LNG.short_d}';
	short_hour 		= '{$LNG.short_h}';
	short_minute 	= '{$LNG.short_m}';
	short_second 	= '{$LNG.short_s}';
</script>

</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script" append}
<script src="scripts/game/defense.js"></script>

{if !empty($BuildList)}
<script src="scripts/base/bcmath.js"></script>
<script type="text/javascript">
$(function() {
    ShipyardInit();
});		
</script>
{/if}
<script type="text/javascript">
function MaxShips(id){
	if(document.getElementsByName(id)[0]){
		var amount=document.getElementById(id+"_value").innerHTML;document.getElementsByName(id)[0].value=amount.replace(/\./g,"");
		Total(id);
	}
}

function SendForm(id){
  var form = $('formDestroy_'+id);
  var submit = $('#submit');


		// prevent default action
		// send ajax request
		$.ajax({
		  url: '?page=fleetDealer',
		  type: 'POST',
		  data: { mode:'send',shipID:id,count:document.getElementById(id+"_input").value.replace(/\./g,""),ajax:1,createDebris:0 },
		  dataType: 'json',
		  beforeSend: function(){
			// change submit button value text and disabled it
			submit.val('In process').attr('disabled', 'disabled');
		  },
		  success: function(data){
			// reset form and button
			form.trigger('reset');
			submit.val(data.Msg).removeAttr('disabled');
			if(data.Error == 0){
				var amountToWidraw=document.getElementById("val_"+id).innerHTML;
				amountToWidraw=amountToWidraw.replace(/\./g,"");
				$("#val_"+id).text(NumberGetHumanReadable(amountToWidraw-document.getElementById(id+"_input").value.replace(/\./g,"")));
			}
			document.getElementsByName(id)[0].value=0;
		  },
		  
		});
};

function SendForm2(id){
	var form = $('formDestroy_'+id);
	var submit = $('#submit2');
	// prevent default action
	// send ajax request
	$.ajax({
		url: '?page=fleetDealer',
		type: 'POST',
		data: { mode:'send',shipID:id,count:document.getElementById(id+"_input").value.replace(/\./g,""),ajax:1,createDebris:1 },
		dataType: 'json',
		beforeSend: function(){
			// change submit button value text and disabled it
			submit.val('In process').attr('disabled', 'disabled');
		},
		success: function(data){
			// reset form and button
			form.trigger('reset');
			submit.val(data.Msg).removeAttr('disabled');
			if(data.Error == 0){
				var amountToWidraw=document.getElementById("val_"+id).innerHTML;
				amountToWidraw=amountToWidraw.replace(/\./g,"");
				$("#val_"+id).text(NumberGetHumanReadable(amountToWidraw-document.getElementById(id+"_input").value.replace(/\./g,"")));
			}
			document.getElementsByName(id)[0].value=0;
		}, 
	});
};

function updateVars(){
	var shipID=$('#shipID').val();$('#metal').text(NumberGetHumanReadable(CostInfo[shipID][2][901]*(1- Charge/100)));$('#crystal').text(NumberGetHumanReadable(CostInfo[shipID][2][902]*(1- Charge/100)));$('#deuterium').text(NumberGetHumanReadable(CostInfo[shipID][2][903]*(1- Charge/100)));$('#darkmatter').text(NumberGetHumanReadable(CostInfo[shipID][2][921]*(1- Charge/100)));$('#traderHead').text(CostInfo[shipID][1]);
}

function Total(id){
	var Count=document.getElementById(id+"_input").value.replace(/\./g,"");if(isNaN(Count)||Count<0){
		$('#count').val(0);Count=0;
	}
	var shipID=id;$('#total_metal_'+id).text(NumberGetHumanReadable(CostInfo[shipID][2][901]*Count*(1- Charge/100)));$('#total_crystal_'+id).text(NumberGetHumanReadable(CostInfo[shipID][2][902]*Count*(1- Charge/100)));$('#total_deuterium_'+id).text(NumberGetHumanReadable(CostInfo[shipID][2][903]*Count*(1- Charge/100)));$('#total_darkmatter_'+id).text(NumberGetHumanReadable(CostInfo[shipID][2][921]*Count*(1- Charge/100)));
}

var CostInfo = {
{foreach $elementListall as $ID => $Element}
"{$ID}{literal}":["0","{/literal}{$LNG.tech.$ID}{literal}",{{/literal} {foreach $Element.costResources as $RessID => $RessAmount}{literal}"{/literal}{$RessID}{literal}":"{/literal}{$RessAmount}"{if !$RessAmount@last},{/if}{/foreach} {literal}}]{/literal} {if !$Element@last},{/if}
{/foreach}
};

var Charge = 40;
</script>
{/block}