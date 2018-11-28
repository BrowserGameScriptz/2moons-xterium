{block name="title" prepend}{$LNG.lm_buildings}{/block}
{block name="content"}
<div id="page">
	<div id="content">
	
{if !empty($Queue)}
<div id="buildlist" class="buildlist">

	<div id="build_process">
{foreach $Queue as $List}
		{$ID = $List.element}
	{if $List@first}
	
				
						 <div class="element_row active_row">
             <div class="right_hand">
            	
				<form action="game.php?page=buildings" method="post" class="build_form">
					<input type="hidden" name="cmd" value="cancel">
					<button type="submit" class="del"></button>
				</form>
				<div id="time" data-time="{$List.time}"></div>
				
            </div>
            <div class="band_process"  id="progressbar" data-time="{$List.resttime}">          
                <div class="left_part">
                    <span>{$List@iteration}. </span>
                   <span class="onlist"> {$LNG.tech.{$ID}} {$List.level}{if $List.destroy} {$LNG.bd_dismantle}{/if}     </span>         </div>
                 <div class="right_part timer" data-time="{$List.endtime}">
                    {$List.display}
                </div>
            </div>
        </div>
		
		
		{else}
		

		
 <div class="element_row ">
            <div class="right_hand">
            	
				<form action="game.php?page=buildings" method="post" class="build_form">
					<input type="hidden" name="cmd" value="remove">
					<input type="hidden" name="listid" value="{$List@iteration}">
					<button type="submit" class="del"></button>
				</form>
								<div id="time" data-time="{$List.resttime}"></div>
            </div>
            <div class="band_process" >          
                <div class="left_part">
                    <span>{$List@iteration}. </span>
                  <span class="onlist"> {$LNG.tech.{$ID}} {$List.level}{if $List.destroy} {$LNG.bd_dismantle}{/if}        </span>        </div>
                
				
				 <div class="right_part timer" data-time="{$List.endtime}">
                    {$List.display}
                </div>
				</div>
       </div>
	

	
	{/if}{/foreach}</div>{/if}	
	
	<div id="build_content" class="conteiner">
	
    <div id="fildes_band" style="margin-right: 0px;">
    	        <a href="game.php?page=planet" title="{$LNG.over_changeworld}" class="palanetarium_linck seting2" style="left:45px"></a>
		    	<a href="game.php?page=Resourcecalc" title="Calculator" class="palanetarium_linck calculette" style="left:26px;top: 5px;width: 17px;height: 16px;"></a>
    	<a href="#" id="arrow_question" style="left:5px; right:auto;" onclick="return Dialog.manualinfo(1)" class="interrogation manual">?</a>
        <div id="fildes_band_proc" style="width:{$field_pircent}%;"></div>
        <div class="fildes_band_text" style="margin-left: 70px;">
        	{$LNG.build_fieldbusy}: <span>{$field_current}</span> / <span>{$field_max} <span style="color:#FC0;"><sup>(+{$kolvosz})</sup></span></span>&emsp;&emsp;
        	{$LNG.build_fieldfree}: <span>{$field_free}</span>
        </div>   
{*<a class="bd_dm_buy" style="margin-top:-27px; margin-right: -189px;width: 189px;text-align: center;" href="game.php?page=dmbuild">{$LNG.build_dm}</a>   *}     
    </div>   
    <div id="build_elements">
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
	{foreach $BuildInfoList as $ID => $Element}
    			<div id="build_{$ID}" class="build_box {if !$Element.techacc}required{/if}">
            <div class="head">
                <a href="#" onclick="return Dialog.info({$ID})" class="interrogation">?</a>                
                <a href="#" onclick="return Dialog.fullControll({$ID});" class="interrogation" style="right:5px;background:url('media/img/controll.png');"></a>            
                <a href="#" onclick="return Dialog.info({$ID})" class="title">
                	{$LNG.tech.{$ID}} {if $Element.level > 0} ({$LNG.bd_lvl} {$Element.level}{if $Element.maxLevel != 255}/{$Element.maxLevel}{/if}){/if}                </a>
            </div>
                        <div class="content_box">
                <div class="image">

                   <a href="#" onclick="return Dialog.info({$ID})"><img src="./styles/theme/gow/gebaeude/{$ID}.{if $userID != 10283}gif{else}png{/if}" alt="{$LNG.tech.{$ID}}" /></a>
                </div>
      {if !$Element.techacc}<div class="prices"><div class="price"> {$LNG.Nece}
            </div>  

		{foreach $Element.AllTech as $elementID => $requireList}
		
		
			   {foreach $requireList as $requireID => $NeedLevel}
		
			   {if $NeedLevel.count > $NeedLevel.own}
			    <div class="required_block  required_smal_text">
           <a href="#" onclick="return Dialog.info({$requireID})" class="tooltip" data-tooltip-content="{$LNG.academy_39}:<br />{$LNG.tech.{$requireID}} lvl.  {$NeedLevel.count} ">
                    <img src="./styles/theme/gow/gebaeude/{$requireID}.{if $requireID >=600 && $requireID <= 699}jpg{else}{if $userID != 10283}gif{else}png{/if}{/if}" alt="{$LNG.tech.{$requireID}}">
                    <div class="text">{$NeedLevel.count}</div>
                </a>           
        </div>
		{/if}
		{/foreach}
		
		
		 {/foreach}
		
		
              


				</div>     {else}	
                <div id="resp_{$ID}" class="prices" style="display:{if $buyId == $ID}none{else}block{/if}">
					{foreach $Element.costResources as $RessID => $RessAmount}
                   	                        <div class="price res{$RessID} {if $Element.costOverflow[$RessID] == 0}{else}required{/if}">
                        	<div class="ico"></div>
        
							<div class="text">{$RessAmount|number}</div>    
							
                    	</div>
                                  {/foreach}      
								  
				
                                                                                                 <div class="price">
                      {if !empty($Element.infoEnergy)}
							
							{$Element.infoEnergy}<br>
						{/if}                           
                    </div>
                                    
                </div>
				
				<div id="darkp_{$ID}" class="prices" style="display:{if $buyId == $ID}block{else}none{/if}">
					
                   	                        <div class="price res921 {if $Element.costOverflowdDM == 0}{else}required{/if}">
                        	<div class="ico"></div>
        
							<div class="text">{$Element.costResourcesDM|number}</div>    
							
                    	</div>
                                 
								  
				
                                                                                                 <div class="price">
                      {if !empty($Element.infoEnergy)}
							
							{$Element.infoEnergy}<br>
						{/if}                           
                    </div>
                                    
                </div>
				
				{/if}
                <div class="clear"></div>
                
                <div class="time_build" id="resp_time_{$ID}" style="display:{if $buyId == $ID}none{else}block{/if}">
                     {if !$Element.techacc}{elseif $Element.elementTime == 0}{else}
						{$LNG.fgf_time}: <span class="time_build_text"> {$Element.elementTime|time} </span> 
						

					 {/if}
					 {if $Element.techacc && $notAllowedDm == 1}<div style="cursor: pointer;float: right;font-size: 83%;color: gray;" id="change_{$ID}" onclick="ChangeBuyMethod('{$ID}');">{if $buyId == $ID}{$LNG.customm_25}{else}{$LNG.build_dm}{/if}</div>{/if}
                </div>
                <div class="time_build" id="dm_time_{$ID}" style="display:{if $buyId == $ID}block{else}none{/if}">
                     {if !$Element.techacc}{elseif $Element.elementTime == 0}{else}
						{$LNG.fgf_time}: <span class="time_build_text"> Instant. </span> 
						

					 {/if}
					 {if $Element.techacc && $notAllowedDm == 1}<div style="cursor: pointer;float: right;font-size: 83%;color: gray;" id="change_{$ID}" onclick="ChangeBuyMethod('{$ID}');">{if $buyId == $ID}{$LNG.build_dm}{else}{$LNG.customm_25}{/if}</div>{/if}
                </div>
             
				
                        {if $Element.level > 0}
						
						{if ($ID == 44 && !$HaveMissiles) ||  $ID != 44}
						<div class="break_build tooltip_sticky" data-tooltip-content="
                <table class='tooltip_class_table'>
            	<tr><th colspan='2'><span style='color:#00FF00'>{$LNG.build_destroy}</span><br> {$LNG.tech.{$ID}} {$Element.level}</th></tr>
                <tr>
                	<td class='tooltip_class_td_img'><img src='./styles/theme/gow/gebaeude/{$ID}.{if $userID != 10283}gif{else}png{/if}' alt='{$LNG.tech.{$ID}}' /></td>
                	<td class='tooltip_class_table_text_left'>
					{foreach $Element.destroyResources as $ResType => $ResCount}
                    	                    	<span>{$LNG.tech.{$ResType}}:</span> <span class='tooltip_class_{$ResType}'>{$ResCount|number}</span><br />
{/foreach}                                                
                    </td>
                </tr><tr>
                                
                <td colspan='2' class='tooltip_class_table_text_left'>
                	<form action='game.php?page=buildings' method='post' class='build_form'>
                    <input type='hidden' name='cmd' value='destroy'>
                    <input type='hidden' name='building' value='{$ID}'>
                    <button type='submit' class='build_submit onlist tooltip_class_a_bigbtn'>{$LNG.bd_dismantle}</button>
                   	</form>
                </td></tr></table>">&dArr;</div>{/if}
				{else}
							
						{/if}
				
				
				 
                               
            {if !$Element.techacc}{elseif $Element.maxLevel == $Element.levelToBuild}
				<div class="btn_build_border">	  
					<span class="btn_build red">{$LNG.bd_maxlevel}</span>
				</div>
			{elseif ($isBusy.research && ($ID == 6 || $ID == 31)) || ($isBusy.shipyard && ($ID == 15 || $ID == 21))}
				<div class="btn_build_border">	  
					<span class="btn_build red">{$LNG.bd_working}</span>
				</div>
			{else} 
				{if $RoomIsOk}
					{if $CanBuildElement && $Element.buyable}
						<div class="btn_build_border" id="res_{$ID}" style="display: {if $buyId == $ID}none{else}block{/if};">	  
							<form action="game.php?page=buildings" method="post" class="build_form">
								<input type="hidden" name="cmd" value="insert">
								<input type="hidden" name="methodPurchase" value="buy_resource">
								<input type="hidden" name="building" value="{$ID}">       
								<input type="hidden" value="{$Element.levelToBuild}" name="levelToBuildInFo"></input>								
								<input type="hidden" value="{$Element.level}" name="lvlup1"></input>								
								<input class="build_number" onchange="counting('{$ID}');" type="number" name="lvlup" id="b_input_{$ID}" size="3" maxlength="3" min="{$Element.levelToBuild + 1}" value="{$Element.levelToBuild + 1}" />
								<button class="btn_build_part_left" type="submit" >{$LNG.bd_build_next_level} </button>                                
							</form>
						</div>
					{else}
						<div class="btn_build_border" id="res_{$ID}" style="display: {if $buyId == $ID}none{else}block{/if};">	  
							<span class="btn_build red">{$LNG.build_nores} </span>
						</div>							
					{/if}
					
					{if $CanBuildElement && $Element.buyableDM}
						<div class="btn_build_border" id="dm_{$ID}" style="display: {if $buyId == $ID}block{else}none{/if};">	  
							<form action="game.php?page=buildings" method="post" class="build_form">
								<input type="hidden" name="cmd" value="insert">
								<input type="hidden" name="methodPurchase" value="buy_darkmatter">
								<input type="hidden" name="building" value="{$ID}">       
								<input type="hidden" value="{$Element.levelToBuild}" name="levelToBuildInFo"></input>								
								<input type="hidden" value="{$Element.level}" name="lvlup1"></input>								
								<button class="btn_build_part_leftdm" type="submit" >{$LNG.bd_build_next_level} </button>                                
							</form>
						</div>
					{else}
						<div class="btn_build_border" id="dm_{$ID}" style="display: {if $buyId == $ID}block{else}none{/if};">	  
							<span class="btn_build red">{$LNG.build_nores} </span>
						</div>							
					{/if}
				{else}
					<div class="btn_build_border">	  
						<span class="btn_build red">{$LNG.bd_build_next_level}{$Element.levelToBuild + 1}</span>
					</div>
				{/if} 
			{/if}  <div class="clear"></div>        
			</div>
           </div>
		{/foreach}
			
	    <div class="clearITO"></div>
    </div>
              
 
  
           
</div><!--/build-->

<script type="text/javascript">
	function ChangeBuyMethod(id) {
		var c1    = $('#dm_'+id);
		var c2    = $('#res_'+id);
		var change= $('#change_'+id);
		var p1    = $('#darkp_'+id);
		var p2    = $('#resp_'+id);
		var t1    = $('#time_'+id);
		var k1    = $('#resp_time_'+id);
		var k2    = $('#dm_time_'+id);

		if(c1.css('display') == 'block')
		{
			p1.css('display','none');
			p2.css('display','block');
			c2.css('display','block');
			c1.css('display','none');
			t1.css('display','none');
			k1.css('display','block');
			k2.css('display','none');
			change.innerHTML('{$LNG.build_dm}')
		}
		else
		{
			p1.css('display','block');
			p2.css('display','none');
			c1.css('display','block');
			c2.css('display','none');
			t1.css('display','block');
			k1.css('display','none');
			k2.css('display','block');
			change.innerHTML('{$LNG.customm_25}')
		}
	}
	DatatList		= {
	{foreach $BuildInfoList as $ID => $Element}
	"{$ID}":{ "level":"{$Element.level}","maxLevel":"{$Element.maxLevel}","factor":"{$Element.factor}","infoEnergy":" <span style=\"color:#FF0000\">19<\/span> ","costRessources":{ {foreach $Element.costResources as $RessID => $RessAmount}"{$RessID}":{$RessAmount}{if !$RessAmount@last},{/if}{/foreach},"921" : {$Element.costResourcesDM} },"costOverflow":{ {foreach $Element.costOverflow as $RessID => $RessAmount}"{$RessID}":{$RessAmount}{if !$RessAmount@last},{/if}{/foreach} },"elementTime":{$Element.elementTime},"destroyFlag":true,"destroyRessources":{ "901":67.5,"902":16.875 },"destroyTime":{$Element.destroyTime},"buyable":true,"no_reduce":false }{if !$Element@last},{/if}
	{/foreach}
	};
	bd_operating	= '({$LNG.bd_working})';
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