{block name="title" prepend}{$LNG.premium_1}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="margin-bottom:5px;">
		{$LNG.premium_1}
    </div>
		<div id="build_elements" class="officier_elements prem_shop">
  {*
         <div class="build_box">
            <div class="head" onclick="OpenBox('box');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_2}:<br /><br />                <span  style='color:#cccccc;'>Always:</span>                <ul style='margin:0 10px 3px 0;'>                	<li>{$LNG.premium_3}</li>                    <li>{$LNG.premium_4}</li>                </ul>                              <span style='color:#61bef0;'>Often:</span>                <ul style='margin:0 10px 3px 0;'>                    <li>{$LNG.premium_5}</li>                    <li>{$LNG.premium_6}</li>                    <li>{$LNG.premium_7}</li>                    <li>{$LNG.premium_8}</li>                </ul>                              <span style='color:#78aa3b;'>Rarely:</span>                <ul style='margin:0 10px 3px 0;'>                    <li>М-7</li>                    <li>М-19</li>                    <li>М-32</li>                </ul>                              <span style='color:#c77b44;'>Rarely:</span>                <ul style='margin:0 10px 3px 0;'>                    <li>{$LNG.premium_12}</li>                    <li>{$LNG.premium_13}</li>                </ul>
                ">?</span>
            	{$LNG.premium_14} <span style='color:#F00'>Beta!</span>
                <span id="open_btn_box" class="prem_open_btn">+</span>
            </div>
         	<div id="box_box" class="content_box">   
            	<img class="pren_img" alt="{$LNG.premium_14}" title="" src="/styles/images/premium/prem_box.jpg">
                <form action="game.php?page=premium" method="post">
                <input name="mode" value="buybox" type="hidden">
            	<div class="content_form">	                	
                    <input style="width:50px;" min="1" max="100" value="1" id="box" name="box_count" onkeyup="Totalbox();" onchange="Totalbox();" type="number" pattern="[0-9]*">
					<span style="float:right;">{$LNG.premium_15}</span>            		
             	</div>
                <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
                </form> 
        	</div>
    	</div>*}

                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_res');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_17}</span>">?</span>
				{$LNG.premium_18} {if !empty($prem_res_promo.promotion)}<span style="color:yellow;">[-{$prem_res_promo.promotion}%]</span>{/if}
				{if !empty($prem_res_days)}
				<span style="color:#6C6;">+{$prem_res}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_res_days}"></span>
				{/if}
                                <span id="open_btn_prem_res" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_res" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_res.jpg">
                	<input name="item" value="prem_res" type="hidden">
					{if !empty($prem_res_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_res')" data-tooltip-content="{$LNG.premium_62}">⇓</span>{/if}  
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_res_days)}ext{else}buy{/if}" type="hidden">
                        {if empty($prem_res_days)}
						<span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_res" style="width:50px; color:#6C6;" name="count" min="0" max="500" onchange="KeyUpBuy('prem_res');" onkeyup="KeyUpBuy('prem_res');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_res_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}: 
                        	<input id="days_prem_res" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_res_days)}onchange="KeyUpExt('prem_res', '{$prem_res}');"{else}onchange="KeyUpBuy('prem_res');"{/if} {if !empty($prem_res_days)}onkeyup="KeyUpExt('prem_res', '{$prem_res}');"{else}onkeyup="KeyUpBuy('prem_res');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_res_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_res" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_storage');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_20}</span>">?</span>
				{$LNG.premium_21} {if !empty($prem_storage_promo.promotion)}<span style="color:yellow;">[-{$prem_storage_promo.promotion}%]</span>{/if}
				{if !empty($prem_storage_days)}
				<span style="color:#6C6;">+{$prem_storage}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_storage_days}"></span>
				{/if}
                                <span id="open_btn_prem_storage" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_storage" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_storage.jpg">
                	<input name="item" value="prem_storage" type="hidden">
					{if !empty($prem_storage_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_storage')" data-tooltip-content="{$LNG.premium_62}">⇓</span>  {/if}
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_storage_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_storage_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_storage" style="width:50px; color:#6C6;" name="count" min="0" max="1000" onchange="KeyUpBuy('prem_storage');" onkeyup="KeyUpBuy('prem_storage');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_storage_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_storage" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_storage_days)}onchange="KeyUpExt('prem_storage', '{$prem_storage}');"{else}onchange="KeyUpBuy('prem_storage');"{/if} {if !empty($prem_storage_days)}onkeyup="KeyUpExt('prem_storage', '{$prem_storage}');"{else}onkeyup="KeyUpBuy('prem_storage');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_storage_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_storage" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_s_build');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_22}">?</span>
				{$LNG.premium_23} {if !empty($prem_s_build_promo.promotion)}<span style="color:yellow;">[-{$prem_s_build_promo.promotion}%]</span>{/if}
				{if !empty($prem_s_build_days)}
				<span style="color:#6C6;">+{$prem_s_build}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_s_build_days}"></span>
				{/if}
                                <span id="open_btn_prem_s_build" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_s_build" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_s_build.jpg">
                	<input name="item" value="prem_s_build" type="hidden">
					{if !empty($prem_s_build_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_s_build')" data-tooltip-content="{$LNG.premium_62}">⇓</span> {/if} 
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_s_build_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_s_build_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_s_build" style="width:50px; color:#6C6;" name="count" min="0" max="100" onchange="KeyUpBuy('prem_s_build');" onkeyup="KeyUpBuy('prem_s_build');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_s_build_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_s_build" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_s_build_days)}onchange="KeyUpExt('prem_s_build', '{$prem_s_build}');"{else}onchange="KeyUpBuy('prem_s_build');"{/if} {if !empty($prem_s_build_days)}onkeyup="KeyUpExt('prem_s_build', '{$prem_s_build}');"{else}onkeyup="KeyUpBuy('prem_s_build');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_s_build_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_s_build" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_o_build');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_24}.">?</span>
				{$LNG.premium_25} {if !empty($prem_o_build_promo.promotion)}<span style="color:yellow;">[-{$prem_o_build_promo.promotion}%]</span>{/if}
				{if !empty($prem_o_build_days)}
				<span style="color:#6C6;">+{$prem_o_build}</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_o_build_days}"></span>
				{/if}
                                <span id="open_btn_prem_o_build" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_o_build" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_o_build.jpg">
                	<input name="item" value="prem_o_build" type="hidden">
					{if !empty($prem_o_build_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_o_build')" data-tooltip-content="{$LNG.premium_62}">⇓</span> {/if} 
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_o_build_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_o_build_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_o_build" style="width:50px; color:#6C6;" name="count" min="0" max="100" onchange="KeyUpBuy('prem_o_build');" onkeyup="KeyUpBuy('prem_o_build');" value="0" type="number" pattern="[0-9]*">&nbsp;&nbsp;&nbsp;</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_o_build_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_o_build" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_o_build_days)}onchange="KeyUpExt('prem_o_build', '{$prem_o_build}');"{else}onchange="KeyUpBuy('prem_o_build');"{/if} {if !empty($prem_o_build_days)}onkeyup="KeyUpExt('prem_o_build', '{$prem_o_build}');"{else}onkeyup="KeyUpBuy('prem_o_build');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_o_build_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_o_build" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>   
			     <div class="build_box">
            <div class="head" onclick="OpenBox('prem_fuel_consumption');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_54}">?</span>
				{$LNG.premium_55} {if !empty($prem_fuel_consumption_promo.promotion)}<span style="color:yellow;">[-{$prem_fuel_consumption_promo.promotion}%]</span>{/if}
				{if !empty($prem_fuel_consumption_days)}
				<span style="color:#6C6;">+{$prem_fuel_consumption}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_fuel_consumption_days}"></span>
				{/if}
                                <span id="open_btn_prem_fuel_consumption" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_fuel_consumption" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_fuel_consumption.jpg">
                	<input name="item" value="prem_fuel_consumption" type="hidden">
					{if !empty($prem_fuel_consumption_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_fuel_consumption')" data-tooltip-content="{$LNG.premium_62}">⇓</span>  {/if}
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_fuel_consumption_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_fuel_consumption_days)}
                        <span style="color:#6C6;">                       
                                                -
                        <input id="count_prem_fuel_consumption" style="width:50px; color:#6C6;" name="count" min="0" max="1000" onchange="KeyUpBuy('prem_fuel_consumption');" onkeyup="KeyUpBuy('prem_fuel_consumption');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_fuel_consumption_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_fuel_consumption" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_fuel_consumption_days)}onchange="KeyUpExt('prem_fuel_consumption', '{$prem_fuel_consumption}');"{else}onchange="KeyUpBuy('prem_fuel_consumption');"{/if} {if !empty($prem_fuel_consumption_days)}onkeyup="KeyUpExt('prem_fuel_consumption', '{$prem_fuel_consumption}');"{else}onkeyup="KeyUpBuy('prem_fuel_consumption');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_fuel_consumption_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_fuel_consumption" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
			
		
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_prime_units');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_56}">?</span>
				{$LNG.premium_57} {if !empty($prem_prime_units_promo.promotion)}<span style="color:yellow;">[-{$prem_prime_units_promo.promotion}%]</span>{/if}
				{if !empty($prem_prime_units_days)}
				<span style="color:#FC6;" class="countdown2" secs="{$prem_prime_units_days}"></span>
				{/if}
                                <span id="open_btn_prem_prime_units" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_prime_units" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_prime_units.jpg">
                	<input name="item" value="prem_prime_units" type="hidden">
					{if !empty($prem_prime_units_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_prime_units')" data-tooltip-content="{$LNG.premium_62}">⇓</span> {/if} 
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_prime_units_days)}ext{else}buy{/if}" type="hidden">
                        <span style="color:#6C6;">                       
                        <input id="count_prem_prime_units" name="count" value="1" type="hidden"> 
                       	<span style="color:#FC6;">
							{if !empty($prem_prime_units_days)}{$LNG.premium_65}{else}{$LNG.premium_60}{/if}:
                        	<input id="days_prem_prime_units" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_prime_units_days)}onchange="KeyUpExt('prem_prime_units', '{$prem_prime_units}');"{else}onchange="KeyUpBuy('prem_prime_units');"{/if} {if !empty($prem_prime_units_days)}onkeyup="KeyUpExt('prem_prime_units', '{$prem_prime_units}');"{else}onkeyup="KeyUpBuy('prem_prime_units');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_prime_units_days)}&nbsp;{$LNG.premium_60}{/if}
                        </span>
                        <span style="float:right;color: #ccc;"><span id="cost_prem_prime_units" style="color:#090;">0</span> АМ</span>
                    </span></div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_button');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_26}">?</span>
				{$LNG.premium_27} {if !empty($prem_button_promo.promotion)}<span style="color:yellow;">[-{$prem_button_promo.promotion}%]</span>{/if}
				{if !empty($prem_button_days)}
				<span style="color:#6C6;">x{$prem_button}</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_button_days}"></span>
				{/if}
                                <span id="open_btn_prem_button" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_button" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_button.jpg">
                	<input name="item" value="prem_button" type="hidden">
					{if !empty($prem_button_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_button')" data-tooltip-content="{$LNG.premium_62}">⇓</span>  {/if}
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_button_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_button_days)}
                        <span style="color:#6C6;">                       
                                                x
                        <input id="count_prem_button" style="width:50px; color:#6C6;" name="count" min="2" max="10" onchange="KeyUpBuy('prem_button');" onkeyup="KeyUpBuy('prem_button');" value="2" type="number" pattern="[0-9]*">&nbsp;&nbsp;&nbsp;</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_button_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_button" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_button_days)}onchange="KeyUpExt('prem_button', '{$prem_button}');"{else}onchange="KeyUpBuy('prem_button');"{/if} {if !empty($prem_button_days)}onkeyup="KeyUpExt('prem_button', '{$prem_button}');"{else}onkeyup="KeyUpBuy('prem_button');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_button_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_button" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_speed_button');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_28}">?</span>
				{$LNG.premium_29} {if !empty($prem_speed_button_promo.promotion)}<span style="color:yellow;">[-{$prem_speed_button_promo.promotion}%]</span>{/if}
				{if !empty($prem_speed_button_days)}
				<span style="color:#6C6;">+{$prem_speed_button}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_speed_button_days}"></span>
				{/if}
                                <span id="open_btn_prem_speed_button" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_speed_button" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_speed_button.jpg">
                	<input name="item" value="prem_speed_button" type="hidden">
					{if !empty($prem_speed_button_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_speed_button')" data-tooltip-content="{$LNG.premium_62}">⇓</span> {/if}
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_speed_button_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_speed_button_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_speed_button" style="width:50px; color:#6C6;" name="count" min="0" max="100" onchange="KeyUpBuy('prem_speed_button');" onkeyup="KeyUpBuy('prem_speed_button');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_speed_button_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_speed_button" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_speed_button_days)}onchange="KeyUpExt('prem_speed_button', '{$prem_speed_button}');"{else}onchange="KeyUpBuy('prem_speed_button');"{/if} {if !empty($prem_speed_button_days)}onkeyup="KeyUpExt('prem_speed_button', '{$prem_speed_button}');"{else}onkeyup="KeyUpBuy('prem_speed_button');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_speed_button_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_speed_button" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_expedition');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_30}</span>">?</span>
				{$LNG.premium_31} {if !empty($prem_expedition_promo.promotion)}<span style="color:yellow;">[-{$prem_expedition_promo.promotion}%]</span>{/if}
				{if !empty($prem_expedition_days)}
				<span style="color:#6C6;">+{$prem_expedition}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_expedition_days}"></span>
				{/if}
                                <span id="open_btn_prem_expedition" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_expedition" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_expedition.jpg">
                	<input name="item" value="prem_expedition" type="hidden">
					{if !empty($prem_expedition_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_expedition')" data-tooltip-content="{$LNG.premium_62}">⇓</span>  {/if}
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_expedition_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_expedition_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_expedition" style="width:50px; color:#6C6;" name="count" min="0" max="500" onchange="KeyUpBuy('prem_expedition');" onkeyup="KeyUpBuy('prem_expedition');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_expedition_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_expedition" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_expedition_days)}onchange="KeyUpExt('prem_expedition', '{$prem_expedition}');"{else}onchange="KeyUpBuy('prem_expedition');"{/if} {if !empty($prem_expedition_days)}onkeyup="KeyUpExt('prem_expedition', '{$prem_expedition}');"{else}onkeyup="KeyUpBuy('prem_expedition');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_expedition_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_expedition" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_count_expiditeon');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_32}">?</span>
				{$LNG.premium_33} {if !empty($prem_count_expiditeon_promo.promotion)}<span style="color:yellow;">[-{$prem_count_expiditeon_promo.promotion}%]</span>{/if}
				{if !empty($prem_count_expiditeon_days)}
				<span style="color:#6C6;">+{$prem_count_expiditeon}</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_count_expiditeon_days}"></span>
				{/if}
                                <span id="open_btn_prem_count_expiditeon" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_count_expiditeon" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_count_expiditeon.jpg">
                	<input name="item" value="prem_count_expiditeon" type="hidden">
					{if !empty($prem_count_expiditeon_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_count_expiditeon')" data-tooltip-content="{$LNG.premium_62}">⇓</span>{/if} 
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_count_expiditeon_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_count_expiditeon_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_count_expiditeon" style="width:50px; color:#6C6;" name="count" min="0" max="100" onchange="KeyUpBuy('prem_count_expiditeon');" onkeyup="KeyUpBuy('prem_count_expiditeon');" value="0" type="number" pattern="[0-9]*">&nbsp;&nbsp;&nbsp;</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_count_expiditeon_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_count_expiditeon" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_count_expiditeon_days)}onchange="KeyUpExt('prem_count_expiditeon', '{$prem_count_expiditeon}');"{else}onchange="KeyUpBuy('prem_count_expiditeon');"{/if} {if !empty($prem_count_expiditeon_days)}onkeyup="KeyUpExt('prem_count_expiditeon', '{$prem_count_expiditeon}');"{else}onkeyup="KeyUpBuy('prem_count_expiditeon');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_count_expiditeon_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_count_expiditeon" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_speed_expiditeon');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_34}">?</span>
				{$LNG.premium_35} {if !empty($prem_speed_expiditeon_promo.promotion)}<span style="color:yellow;">[-{$prem_speed_expiditeon_promo.promotion}%]</span>{/if}
				{if !empty($prem_speed_expiditeon_days)}
				<span style="color:#6C6;">+{$prem_speed_expiditeon}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_speed_expiditeon_days}"></span>
				{/if}
                                <span id="open_btn_prem_speed_expiditeon" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_speed_expiditeon" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_speed_expiditeon.jpg">
                	<input name="item" value="prem_speed_expiditeon" type="hidden">
					{if !empty($prem_speed_expiditeon_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_speed_expiditeon')" data-tooltip-content="{$LNG.premium_62}">⇓</span>  {/if}
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_speed_expiditeon_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_speed_expiditeon_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_speed_expiditeon" style="width:50px; color:#6C6;" name="count" min="0" max="1000" onchange="KeyUpBuy('prem_speed_expiditeon');" onkeyup="KeyUpBuy('prem_speed_expiditeon');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_speed_expiditeon_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_speed_expiditeon" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_speed_expiditeon_days)}onchange="KeyUpExt('prem_speed_expiditeon', '{$prem_speed_expiditeon}');"{else}onchange="KeyUpBuy('prem_speed_expiditeon');"{/if} {if !empty($prem_speed_expiditeon_days)}onkeyup="KeyUpExt('prem_speed_expiditeon', '{$prem_speed_expiditeon}');"{else}onkeyup="KeyUpBuy('prem_speed_expiditeon');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_speed_expiditeon_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_speed_expiditeon" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_moon_dextruct');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_36}">?</span>
				{$LNG.premium_37} {if !empty($prem_moon_dextruct_promo.promotion)}<span style="color:yellow;">[-{$prem_moon_dextruct_promo.promotion}%]</span>{/if}
				{if !empty($prem_moon_dextruct_days)}
				<span style="color:#6C6;">+{$prem_moon_dextruct}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_moon_dextruct_days}"></span>
				{/if}
                                <span id="open_btn_prem_moon_dextruct" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_moon_dextruct" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_moon_dextruct.jpg">
                	<input name="item" value="prem_moon_dextruct" type="hidden">
					{if !empty($prem_moon_dextruct_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_moon_dextruct')" data-tooltip-content="{$LNG.premium_62}">⇓</span> {/if} 
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_moon_dextruct_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_moon_dextruct_days)}
                        <span style="color:#6C6;">                       
                                                x
                        <input id="count_prem_moon_dextruct" style="width:50px; color:#6C6;" name="count" min="2" max="10" onchange="KeyUpBuy('prem_moon_dextruct');" onkeyup="KeyUpBuy('prem_moon_dextruct');" value="2" type="number" pattern="[0-9]*">&nbsp;&nbsp;&nbsp;</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_moon_dextruct_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_moon_dextruct" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_moon_dextruct_days)}onchange="KeyUpExt('prem_moon_dextruct', '{$prem_moon_dextruct}');"{else}onchange="KeyUpBuy('prem_moon_dextruct');"{/if} {if !empty($prem_moon_dextruct_days)}onkeyup="KeyUpExt('prem_moon_dextruct', '{$prem_moon_dextruct}');"{else}onkeyup="KeyUpBuy('prem_moon_dextruct');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_moon_dextruct_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_moon_dextruct" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_leveling');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_38}">?</span>
				{$LNG.premium_39} {if !empty($prem_leveling_promo.promotion)}<span style="color:yellow;">[-{$prem_leveling_promo.promotion}%]</span>{/if}
				{if !empty($prem_leveling_days)}
				<span style="color:#6C6;">+{$prem_leveling}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_leveling_days}"></span>
				{/if}
                                <span id="open_btn_prem_leveling" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_leveling" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_leveling.jpg">
                	<input name="item" value="prem_leveling" type="hidden">
					{if !empty($prem_leveling_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_leveling')" data-tooltip-content="{$LNG.premium_62}">⇓</span>  {/if}
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_leveling_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_leveling_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_leveling" style="width:50px; color:#6C6;" name="count" min="0" max="100" onchange="KeyUpBuy('prem_leveling');" onkeyup="KeyUpBuy('prem_leveling');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_leveling_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_leveling" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_leveling_days)}onchange="KeyUpExt('prem_leveling', '{$prem_leveling}');"{else}onchange="KeyUpBuy('prem_leveling');"{/if} {if !empty($prem_leveling_days)}onkeyup="KeyUpExt('prem_leveling', '{$prem_leveling}');"{else}onkeyup="KeyUpBuy('prem_leveling');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_leveling_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_leveling" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_batle_leveling');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_40}">?</span>
				{$LNG.premium_41} {if !empty($prem_batle_leveling_promo.promotion)}<span style="color:yellow;">[-{$prem_batle_leveling_promo.promotion}%]</span>{/if}
				{if !empty($prem_batle_leveling_days)}
				<span style="color:#6C6;">+{$prem_batle_leveling}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_batle_leveling_days}"></span>
				{/if}
                                <span id="open_btn_prem_batle_leveling" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_batle_leveling" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_batle_leveling.jpg">
                	<input name="item" value="prem_batle_leveling" type="hidden">
					{if !empty($prem_batle_leveling_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_batle_leveling')" data-tooltip-content="{$LNG.premium_62}">⇓</span>{/if}  
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_batle_leveling_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_batle_leveling_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_batle_leveling" style="width:50px; color:#6C6;" name="count" min="0" max="100" onchange="KeyUpBuy('prem_batle_leveling');" onkeyup="KeyUpBuy('prem_batle_leveling');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_batle_leveling_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_batle_leveling" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_batle_leveling_days)}onchange="KeyUpExt('prem_batle_leveling', '{$prem_batle_leveling}');"{else}onchange="KeyUpBuy('prem_batle_leveling');"{/if} {if !empty($prem_batle_leveling_days)}onkeyup="KeyUpExt('prem_batle_leveling', '{$prem_batle_leveling}');"{else}onkeyup="KeyUpBuy('prem_batle_leveling');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_batle_leveling_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_batle_leveling" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_bank_ally');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_42}">?</span>
				{$LNG.premium_43} {if !empty($prem_bank_ally_promo.promotion)}<span style="color:yellow;">[-{$prem_bank_ally_promo.promotion}%]</span>{/if}
				{if !empty($prem_bank_ally_days)}
				<span style="color:#6C6;">+{$prem_bank_ally}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_bank_ally_days}"></span>
				{/if}
                                <span id="open_btn_prem_bank_ally" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_bank_ally" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_bank_ally.jpg">
                	<input name="item" value="prem_bank_ally" type="hidden">
					{if !empty($prem_bank_ally_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_bank_ally')" data-tooltip-content="{$LNG.premium_62}">⇓</span>  {/if}
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_bank_ally_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_bank_ally_days)}
                        <span style="color:#6C6;">                       
                                                x
                        <input id="count_prem_bank_ally" style="width:50px; color:#6C6;" name="count" min="2" max="5" onchange="KeyUpBuy('prem_bank_ally');" onkeyup="KeyUpBuy('prem_bank_ally');" value="2" type="number" pattern="[0-9]*">&nbsp;&nbsp;&nbsp;</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_bank_ally_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_bank_ally" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_bank_ally_days)}onchange="KeyUpExt('prem_bank_ally', '{$prem_bank_ally}');"{else}onchange="KeyUpBuy('prem_bank_ally');"{/if} {if !empty($prem_bank_ally_days)}onkeyup="KeyUpExt('prem_bank_ally', '{$prem_bank_ally}');"{else}onkeyup="KeyUpBuy('prem_bank_ally');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_bank_ally_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_bank_ally" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_conveyors_l');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_44}">?</span>
				{$LNG.premium_45} {if !empty($prem_conveyors_l_promo.promotion)}<span style="color:yellow;">[-{$prem_conveyors_l_promo.promotion}%]</span>{/if}
				{if !empty($prem_conveyors_l_days)}
				<span style="color:#6C6;">+{$prem_conveyors_l}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_conveyors_l_days}"></span>
				{/if}
                                <span id="open_btn_prem_conveyors_l" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_conveyors_l" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_conveyors_l.jpg">
                	<input name="item" value="prem_conveyors_l" type="hidden">
					{if !empty($prem_conveyors_l_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_conveyors_l')" data-tooltip-content="{$LNG.premium_62}">⇓</span> {/if} 
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_conveyors_l_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_conveyors_l_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_conveyors_l" style="width:50px; color:#6C6;" name="count" min="0" max="1000" onchange="KeyUpBuy('prem_conveyors_l');" onkeyup="KeyUpBuy('prem_conveyors_l');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_conveyors_l_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_conveyors_l" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_conveyors_l_days)}onchange="KeyUpExt('prem_conveyors_l', '{$prem_conveyors_l}');"{else}onchange="KeyUpBuy('prem_conveyors_l');"{/if} {if !empty($prem_conveyors_l_days)}onkeyup="KeyUpExt('prem_conveyors_l', '{$prem_conveyors_l}');"{else}onkeyup="KeyUpBuy('prem_conveyors_l');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_conveyors_l_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_conveyors_l" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_conveyors_s');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_46}">?</span>
				{$LNG.premium_47} {if !empty($prem_conveyors_s_promo.promotion)}<span style="color:yellow;">[-{$prem_conveyors_s_promo.promotion}%]</span>{/if}
				{if !empty($prem_conveyors_s_days)}
				<span style="color:#6C6;">+{$prem_conveyors_s}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_conveyors_s_days}"></span>
				{/if}
                                <span id="open_btn_prem_conveyors_s" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_conveyors_s" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_conveyors_s.jpg">
                	<input name="item" value="prem_conveyors_s" type="hidden">
					{if !empty($prem_conveyors_s_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_conveyors_s')" data-tooltip-content="{$LNG.premium_62}">⇓</span> {/if}
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_conveyors_s_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_conveyors_s_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_conveyors_s" style="width:50px; color:#6C6;" name="count" min="0" max="1000" onchange="KeyUpBuy('prem_conveyors_s');" onkeyup="KeyUpBuy('prem_conveyors_s');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_conveyors_s_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_conveyors_s" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_conveyors_s_days)}onchange="KeyUpExt('prem_conveyors_s', '{$prem_conveyors_s}');"{else}onchange="KeyUpBuy('prem_conveyors_s');"{/if} {if !empty($prem_conveyors_s_days)}onkeyup="KeyUpExt('prem_conveyors_s', '{$prem_conveyors_s}');"{else}onkeyup="KeyUpBuy('prem_conveyors_s');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_conveyors_s_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_conveyors_s" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_conveyors_t');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_48}">?</span>
				{$LNG.premium_49} {if !empty($prem_conveyors_t_promo.promotion)}<span style="color:yellow;">[-{$prem_conveyors_t_promo.promotion}%]</span>{/if}
				{if !empty($prem_conveyors_t_days)}
				<span style="color:#6C6;">+{$prem_conveyors_t}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_conveyors_t_days}"></span>
				{/if}
                                <span id="open_btn_prem_conveyors_t" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_conveyors_t" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_conveyors_t.jpg">
                	<input name="item" value="prem_conveyors_t" type="hidden">
					{if !empty($prem_conveyors_t_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_conveyors_t')" data-tooltip-content="{$LNG.premium_62}">⇓</span>  {/if}
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_conveyors_t_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_conveyors_t_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_conveyors_t" style="width:50px; color:#6C6;" name="count" min="0" max="1000" onchange="KeyUpBuy('prem_conveyors_t');" onkeyup="KeyUpBuy('prem_conveyors_t');" value="0" type="number" pattern="[0-9]*">%</span>
						
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_conveyors_t_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_conveyors_t" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_conveyors_t_days)}onchange="KeyUpExt('prem_conveyors_t', '{$prem_conveyors_t}');"{else}onchange="KeyUpBuy('prem_conveyors_t');"{/if} {if !empty($prem_conveyors_t_days)}onkeyup="KeyUpExt('prem_conveyors_t', '{$prem_conveyors_t}');"{else}onkeyup="KeyUpBuy('prem_conveyors_t');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_conveyors_t_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_conveyors_t" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_prod_from_colly');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_50}">?</span>
				{$LNG.premium_51} {if !empty($prem_prod_from_colly_promo.promotion)}<span style="color:yellow;">[-{$prem_prod_from_colly_promo.promotion}%]</span>{/if}
				{if !empty($prem_prod_from_colly_days)}
				<span style="color:#6C6;">+{$prem_prod_from_colly}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_prod_from_colly_days}"></span>
				{/if}
                                <span id="open_btn_prem_prod_from_colly" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_prod_from_colly" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_prod_from_colly.jpg">
                	<input name="item" value="prem_prod_from_colly" type="hidden">
					{if !empty($prem_prod_from_colly_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_prod_from_colly')" data-tooltip-content="{$LNG.premium_62}">⇓</span>  {/if}
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_prod_from_colly_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_prod_from_colly_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_prod_from_colly" style="width:50px; color:#6C6;" name="count" min="0" max="1000" onchange="KeyUpBuy('prem_prod_from_colly');" onkeyup="KeyUpBuy('prem_prod_from_colly');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_prod_from_colly_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_prod_from_colly" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_prod_from_colly_days)}onchange="KeyUpExt('prem_prod_from_colly', '{$prem_prod_from_colly}');"{else}onchange="KeyUpBuy('prem_prod_from_colly');"{/if} {if !empty($prem_prod_from_colly_days)}onkeyup="KeyUpExt('prem_prod_from_colly', '{$prem_prod_from_colly}');"{else}onkeyup="KeyUpBuy('prem_prod_from_colly');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_prod_from_colly_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_prod_from_colly" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
                <div class="build_box">
            <div class="head" onclick="OpenBox('prem_moon_creat');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="{$LNG.premium_52}">?</span>
				{$LNG.premium_53} {if !empty($prem_moon_creat_promo.promotion)}<span style="color:yellow;">[-{$prem_moon_creat_promo.promotion}%]</span>{/if}
				{if !empty($prem_moon_creat_days)}
				<span style="color:#6C6;">+{$prem_moon_creat}%</span>
				<span style="color:#FC6;" class="countdown2" secs="{$prem_moon_creat_days}"></span>
				{/if}
                                <span id="open_btn_prem_moon_creat" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_moon_creat" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_moon_creat.jpg">
                	<input name="item" value="prem_moon_creat" type="hidden">
					{if !empty($prem_moon_creat_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_moon_creat')" data-tooltip-content="{$LNG.premium_62}">⇓</span>  {/if}
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_moon_creat_days)}ext{else}buy{/if}" type="hidden">
						{if empty($prem_moon_creat_days)}
                        <span style="color:#6C6;">                       
                                                +
                        <input id="count_prem_moon_creat" style="width:50px; color:#6C6;" name="count" min="0" max="100" onchange="KeyUpBuy('prem_moon_creat');" onkeyup="KeyUpBuy('prem_moon_creat');" value="0" type="number" pattern="[0-9]*">%</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                         {/if}
                       	<span style="color:#FC6;">
                        	{if !empty($prem_moon_creat_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:  
                        	<input id="days_prem_moon_creat" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_moon_creat_days)}onchange="KeyUpExt('prem_moon_creat', '{$prem_moon_creat}');"{else}onchange="KeyUpBuy('prem_moon_creat');"{/if} {if !empty($prem_moon_creat_days)}onkeyup="KeyUpExt('prem_moon_creat', '{$prem_moon_creat}');"{else}onkeyup="KeyUpBuy('prem_moon_creat');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_moon_creat_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;"><span id="cost_prem_moon_creat" style="color:#090;">0</span> АМ</span>
                    </div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>
               
		
		{*<div class="build_box">
            <div class="head" onclick="OpenBox('prem_transate_player');">
            	<span style="cursor:help; float:left; margin-right:8px;" class="interrogation tooltip" data-tooltip-content="This will automaticly translate private message and game messages into your languages">?</span>
				Auto Translate {if !empty($prem_transate_player_promo.promotion)}<span style="color:yellow;">[-{$prem_transate_player_promo.promotion}%]</span>{/if}
				{if !empty($prem_transate_player_days)}
				<span style="color:#FC6;" class="countdown2" secs="{$prem_transate_player_days}"></span>
				{/if}
                                <span id="open_btn_prem_transate_player" class="prem_open_btn">+</span>
			</div>	
           	<div id="box_prem_transate_player" class="content_box">
            	<form action="game.php?page=premium" method="post">
                	<img class="pren_img" alt="" title="" src="/styles/images/premium/prem_transate_player.jpg">
                	<input name="item" value="prem_transate_player" type="hidden">
					{if !empty($prem_transate_player_days)}<span class="tooltip prem_reset" onclick="resetBonus('prem_transate_player')" data-tooltip-content="{$LNG.premium_62}">⇓</span> {/if} 
            	               		<div class="content_form">
                        <input name="mode" value="{if !empty($prem_transate_player_days)}ext{else}buy{/if}" type="hidden">
                        <span style="color:#6C6;">                       
                        <input id="count_prem_transate_player" name="count" value="1" type="hidden"> 
                       	<span style="color:#FC6;">
							{if !empty($prem_transate_player_days)}{$LNG.premium_65}{else}{$LNG.premium_19}{/if}:
                        	<input id="days_prem_transate_player" style="color:#FC6; width:50px;" name="days" min="0" {if !empty($prem_transate_player_days)}onchange="KeyUpExt('prem_transate_player', '{$prem_transate_player}');"{else}onchange="KeyUpBuy('prem_transate_player');"{/if} {if !empty($prem_transate_player_days)}onkeyup="KeyUpExt('prem_transate_player', '{$prem_transate_player}');"{else}onkeyup="KeyUpBuy('prem_transate_player');"{/if} value="0" type="number" pattern="[0-9]*">
							{if !empty($prem_transate_player_days)}&nbsp;{$LNG.premium_19}{/if}
                        </span>
                        <span style="float:right;color: #ccc;"><span id="cost_prem_transate_player" style="color:#090;">0</span> АМ</span>
                    </span></div>
                    <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
           		                	
            	</form>
            </div>
        </div>*}
	
				<div class="build_box">
            <div class="head" onclick="OpenBox('stardust');">
            	{$LNG.premium_13}
                <span style="color:#FC0;">{$stardust|number}</span>

                <span id="open_btn_stardust" class="prem_open_btn">+</span>
            </div>
         	<div id="box_stardust" class="content_box" style="display: none;">   
            	<img class="pren_img" alt="" title="" src="/styles/images/premium/stardust.jpg">
                <form action="game.php?page=premium" method="post">
                <input name="mode" value="buystardust" type="hidden">
            	<div class="content_form">	                	
                    +<input style="width:50px;" min="1" value="1" id="stardust" name="stardust" onkeyup="Totalstardust();" onchange="Totalstardust();" type="number">
					<span style="float:right;">{$LNG.premium_59} <span style="color:#090;" id="cost_stardust">{$stardust_cost|number}</span> {$LNG.tech.922}</span>            		
             	</div>
                <input class="pren_btn_buy" value="{$LNG.premium_16}" type="submit">
                </form> 
        	</div>
    	</div>   
                 
	</div>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script" append}
<script type="text/javascript">
	var pblist			= { 
		"Cost":{ "prem_res":{$prem_res_cost},"prem_storage":{$prem_storage_cost},"prem_s_build":{$prem_s_build_cost},"prem_o_build":{$prem_o_build_cost},"prem_button":{$prem_button_cost},"prem_speed_button":{$prem_speed_button_cost},"prem_expedition":{$prem_expedition_cost},"prem_count_expiditeon":{$prem_count_expiditeon_cost},"prem_speed_expiditeon":{$prem_speed_expiditeon_cost},"prem_moon_dextruct":{$prem_moon_dextruct_cost},"prem_leveling":{$prem_leveling_cost},"prem_batle_leveling":{$prem_batle_leveling_cost},"prem_bank_ally":{$prem_bank_ally_cost},"prem_conveyors_l":{$prem_conveyors_l_cost},"prem_conveyors_s":{$prem_conveyors_s_cost},"prem_conveyors_t":{$prem_conveyors_t_cost},"prem_prod_from_colly":{$prem_prod_from_colly_cost},"prem_moon_creat":{$prem_moon_creat_cost},"prem_fuel_consumption":{$prem_fuel_consumption_cost},"prem_prime_units":{$prem_prime_units_cost},"prem_transate_player":{$prem_transate_player_cost} },
		"Factor":{ "prem_res":[1.07,90],"prem_storage":[1.05,4],"prem_s_build":[1.5,40],"prem_o_build":[1.3,1],"prem_button":[1.45,1],"prem_speed_button":[1.35,10],"prem_expedition":[1.02,4],"prem_count_expiditeon":[1.35,1],"prem_speed_expiditeon":[1.03,8],"prem_moon_dextruct":[2,2],"prem_leveling":[1.1,25],"prem_batle_leveling":[1.08,25],"prem_bank_ally":[1.5,1],"prem_conveyors_l":[1.029,10],"prem_conveyors_s":[1.032,10],"prem_conveyors_t":[1.033,10],"prem_prod_from_colly":[1.13,15],"prem_moon_creat":[1.04,2],"prem_fuel_consumption":[1.12,3],"prem_prime_units":[1,10],"prem_transate_player":[1,10] },
		"RangeValue":{ "prem_res":[0,100000],"prem_storage":[0,1000],"prem_s_build":[0,100],"prem_o_build":[0,100],"prem_button":[2,10],"prem_speed_button":[0,100],"prem_expedition":[0,500],"prem_count_expiditeon":[0,100],"prem_speed_expiditeon":[0,1000],"prem_moon_dextruct":[2,10],"prem_leveling":[0,1000],"prem_batle_leveling":[0,1000],"prem_bank_ally":[2,5],"prem_conveyors_l":[0,1000],"prem_conveyors_s":[0,1000],"prem_conveyors_t":[0,1000],"prem_prod_from_colly":[0,1000],"prem_moon_creat":[0,100],"prem_fuel_consumption":[0,1000],"prem_prime_units":[1,1],"prem_transate_player":[1,1] },
		"SetTime":{ "prem_res":"days","prem_storage":"days","prem_s_build":"days","prem_o_build":"days","prem_button":"days","prem_speed_button":"days","prem_expedition":"days","prem_count_expiditeon":"days","prem_speed_expiditeon":"days","prem_moon_dextruct":"days","prem_leveling":"days","prem_batle_leveling":"days","prem_bank_ally":"days","prem_conveyors_l":"days","prem_conveyors_s":"days","prem_conveyors_t":"days","prem_prod_from_colly":"days","prem_moon_creat":"days","prem_fuel_consumption":"days","prem_prime_units":"hour","prem_transate_player":"days" },
		"Reset":{ "prem_res":true,"prem_storage":true,"prem_s_build":true,"prem_o_build":true,"prem_button":true,"prem_speed_button":true,"prem_expedition":true,"prem_count_expiditeon":true,"prem_speed_expiditeon":true,"prem_moon_dextruct":true,"prem_leveling":true,"prem_batle_leveling":true,"prem_bank_ally":true,"prem_conveyors_l":true,"prem_conveyors_s":true,"prem_conveyors_t":true,"prem_prod_from_colly":true,"prem_moon_creat":true,"prem_fuel_consumption":true,"prem_prime_units":false,"prem_transate_player":true } 
	};
	var cost_stardust	= {$stardust_cost};
	var cost_box		= 5000;
	var atm				= {$antimatter};
</script>
{/block}
