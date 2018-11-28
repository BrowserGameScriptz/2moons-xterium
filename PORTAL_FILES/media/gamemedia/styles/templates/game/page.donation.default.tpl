{block name="title" prepend}{$LNG.donation_head}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div id="fildes_band" style="padding-right:0;" class="gray_stripe">
      {$LNG.donation_head}
      {if !empty($friendCount)}<a class="bd_dm_buy" href="/game.php?page=donation{if !$DonateToFriend}&friend=true{/if}">{if !$DonateToFriend}{$LNG.gather_opt_5}{else}{$LNG.gather_opt_4}{/if}</a>{/if}  
                    
    </div> 
    <div id="interkassa" style="display:block;">
    <form id="pay" name="payment" action="?page=paypal" method="post">
	
	{if $DonateToFriend}<div class="gray_stripe">
    	{$LNG.gather_opt_6}:
        <select id="id_user_interkassa" onchange="setidfriend('interkassa', 'xsolla');" name="ik_payment_id" onchange="">
           {foreach $friendsArray as $ID => $Info} <option value="{$ID}">{if empty($Info.info.customNick)}{$Info.info.username}{else}{$Info.info.customNick}{/if}</option>{/foreach}
        </select>
    </div>{/if}
	
 	<table class="tablesorter ally_ranks gray_stripe_th" style="margin-bottom:10px;">
        <tbody><tr>
            <td>
                {$LNG.donation_amount}
            </td>
            <td>
                <input class="input" id="amount1" name="ik_payment_amount" onkeyup="calculation(1);" onchange="calculation(1);" value="0" type="text" required> {$LNG.donation_amountmin} <span style="color:#6CC">10.000</span>
            </td>
        </tr>
   	</tbody></table>
	{if $pointe > 0 && !$DonateToFriend}
        <div class="right_part">
        <div class="gray_stripe">
            <input style="margin-top:7px; margin-right:10px; display:block; float:left;" name="ik_baggage_fields" id="fields1" onclick="calculation(1);" value="1" type="checkbox">
            <label for="fields1" onclick="calculation(1);">{$LNG.donation_p1} <span style="color:#FC0"> [{$pointe}%]</span></label>
            <span style="cursor:help; margin-top:7px;" class="interrogation tooltip" data-tooltip-content="<span style='color:#F00'>{$LNG.donation_p2}</span>">?</span>
        </div>
		
        <table class="tablesorter ally_ranks gray_stripe_th td_border_bottom">
            <tbody><tr> 
                <td>
                    <span style="color:#F90;">+<span class="pointe_bonus">0</span></span>
                </td>
            </tr>
        </tbody></table>
    </div>
	{/if}
	{if $donation_bonus > 0}
                <div class="left_part" {if $pointe == 0}style="width:100%"{/if}>
        <div class="gray_stripe">
            <span style="float:left;display:block;">{$LNG.donation_p4} <span style="color:#FC0;">[{$donation_bonus}%]</span></span>
                        	<span style="float:left;display:block;margin-left:5px;"><span style="color:#f00;float:left;">[<span class="bonus_of_amount_per">0</span>%]</span>
                <a class="interrogation tooltip" data-tooltip-content="{$donation_p3}" style="cursor:pointer;float:left;margin:5px;">?</a></span>
                    </div>
        <table class="tablesorter ally_ranks gray_stripe_th td_border_bottom">
            <tbody><tr> 
                <td>
                    <span style="color:#F90;">+<span id="bonus1">0</span></span>
                </td>
                                <td>
                    <span style="color:#f00;">+<span class="bonus_of_amount">0</span></span>
                </td>
                            </tr>
        </tbody></table>
    </div>
	{/if}
        <table class="tablesorter ally_ranks gray_stripe_th td_border_bottom">    
        <tbody><tr> 
            <td>            
                {$LNG.donation_amountget} <span id="count1" style="color:#F00; font-weight:bold;">0</span> {$LNG.tech.922}                       
            </td>
        </tr>
	</tbody></table>
    <div class="gray_stripe gray_stripe_big"> 
    	<img alt="Paypal" src="styles/images/icons/lato_paypal.png" style="float:left;"> 
        <div class="img_donat_sys" style="margin-left: 70px;">
        	<img alt="" src="styles/images/icons/PayPal.png">            
            <img alt="" src="styles/images/icons/Mastercard.png">
            <img alt="" src="styles/images/icons/Visa.png">
            <img alt="" src="styles/images/icons/PostePay.png">
            <img alt="" src="styles/images/icons/Maestro.png">
            <img alt="" src="styles/images/icons/American-Express.png">           
            
        </div>
		<input name="process" class="btn_big_blue" value="{$LNG.donation_checkout}" type="submit" style="float: right;">
	
        	</div>
	</form>
</div>	
<div id="xsolla2" style="display:none;">
     <form id="pay2" name="payment" action="?page=xsolla" method="post">
	{if $DonateToFriend}<div class="gray_stripe">
    	{$LNG.gather_opt_6}:
        <select id="id_user_xsolla" onchange="setidfriend('xsolla', 'interkassa');" name="v1" onchange="">
            {foreach $friendsArray as $ID => $Info} <option value="{$ID}">{if empty($Info.info.customNick)}{$Info.info.username}{else}{$Info.info.customNick}{/if}</option>{/foreach}
        </select>

    </div>{/if}
 	<table class="tablesorter ally_ranks gray_stripe_th" style="margin-bottom:10px;">
        <tbody><tr>
            <td>
			{$LNG.donation_amount}
            </td>
            <td>
                <input class="input" id="amount2" name="out" onkeyup="calculation(2);" onchange="calculation(2);" value="0" type="text" required> {$LNG.donation_amountmin} <span style="color:#6CC">10.000</span>
            </td>
        </tr>
   	</tbody></table>
	{if $pointe > 0 && !$DonateToFriend}
        <div class="right_part">
        <div class="gray_stripe">
            <input style="margin-top:7px; margin-right:10px; display:block; float:left;" name="ik_baggage_fields" id="fields2" onclick="calculation(2);" value="1" type="checkbox">
            <label for="fields2" onclick="calculation(2);">{$LNG.donation_p1} <span style="color:#FC0"> [{$pointe}%]</span></label>
            <span style="cursor:help; margin-top:7px;" class="interrogation tooltip" data-tooltip-content="<span style='color:#F00'>{$LNG.donation_p2}</span>">?</span>
        </div>
		
        <table class="tablesorter ally_ranks gray_stripe_th td_border_bottom">
            <tbody><tr> 
                <td>
                    <span style="color:#F90;">+<span class="pointe_bonus">0</span></span>
                </td>
            </tr>
        </tbody></table>
    </div>
	{/if}
	{if $donation_bonus > 0}
                <div class="left_part" {if $pointe == 0}style="width:100%"{/if}>
        <div class="gray_stripe">
            <span style="float:left;display:block;">{$LNG.donation_p4} <span style="color:#FC0;">[{$donation_bonus}%]</span></span>
                        	<span style="float:left;display:block;margin-left:5px;"><span style="color:#f00;float:left;">[<span class="bonus_of_amount_per">0</span>%]</span>
                <a class="interrogation tooltip" data-tooltip-content="{$donation_p3}" style="cursor:pointer;float:left;margin:5px;">?</a></span>
                    </div>
        <table class="tablesorter ally_ranks gray_stripe_th td_border_bottom">
            <tbody><tr> 
                <td>
                    <span style="color:#F90;">+<span id="bonus2">0</span></span>
                </td>
                                <td>
                    <span style="color:#f00;">+<span class="bonus_of_amount">0</span></span>
                </td>
                            </tr>
        </tbody></table>
    </div>
	{/if}
        <table class="tablesorter ally_ranks gray_stripe_th td_border_bottom">    
        <tbody><tr> 
            <td>            
                {$LNG.donation_amountget} <span id="count2" style="color:#F00; font-weight:bold;">0</span> {$LNG.tech.922}                      
            </td>
        </tr>
	</tbody></table>
    <div class="gray_stripe gray_stripe_big"> 
    <img alt="Xsolla" src="styles/images/icons/lato_xsolla.png" style="float:left;"> 
        <div class="img_donat_sys" style="margin-left: 70px;">
		    <img alt="" src="styles/images/icons/sms.png">
        	<img alt="" src="styles/images/icons/Amazon.png">            
            <img alt="" src="styles/images/icons/skrill.png">
            <img alt="" src="styles/images/icons/WebMoney.png">
            <img alt="" src="styles/images/icons/Payza.png">
            <img alt="" src="styles/images/icons/Bitcoin.png">

        </div>
<input class="btn_big_blue" value="{$LNG.donation_checkout}" type="submit" style="float:right;">
	</div>
	</form>
</div>

<div id="voucherBox" style="display:none;">
     <form id="pay4" name="payment" action="?page=donation" method="post">
	 <input type="hidden" name="mode" value="voucherCode">
 	<table class="tablesorter ally_ranks gray_stripe_th" style="margin-bottom:10px;">
        <tbody><tr>
            <td>
			Enter your voucher code:
            </td>
            <td>
                <input class="" id="voucherCode" name="voucherCode" value="" type="text" required>
            </td>
        </tr>
   	</tbody></table>
	
	
        
    <div class="gray_stripe gray_stripe_big"> 
    <img alt="Xsolla" src="https://www.givta.com/assets/images/icons/voucher_icon.png" style="float:left;"> 
        <div class="img_donat_sys" style="margin-left: 70px;">
		    <img alt="" src="styles/images/icons/sms.png">
        	<img alt="" src="styles/images/icons/Amazon.png">            
            <img alt="" src="styles/images/icons/skrill.png">
            <img alt="" src="styles/images/icons/WebMoney.png">
            <img alt="" src="styles/images/icons/Payza.png">
            <img alt="" src="styles/images/icons/Bitcoin.png">

        </div>
<input class="btn_big_blue" value="Validate the code" type="submit" style="float:right;">
	</div>
	</form>
</div>

<div id="paysafecardBox" style="display:none;">
     <form id="pay3" name="payment" action="?page=paysafecard" method="post">
	{if $DonateToFriend}<div class="gray_stripe">
    	{$LNG.gather_opt_6}:
        <select id="id_user_paysafecard" onchange="setidfriend('xsolla', 'interkassa');" name="p1" onchange="">
            {foreach $friendsArray as $ID => $Info} <option value="{$ID}">{if empty($Info.info.customNick)}{$Info.info.username}{else}{$Info.info.customNick}{/if}</option>{/foreach}
        </select>

    </div>{/if}
 	<table class="tablesorter ally_ranks gray_stripe_th" style="margin-bottom:10px;">
        <tbody><tr>
            <td>
			{$LNG.donation_amount}
            </td>
            <td>
                <input class="input" id="amount3" name="paysafe" onkeyup="calculation(3);" onchange="calculation(3);" value="0" type="text" required> {$LNG.donation_amountmin} <span style="color:#6CC">10.000</span>
            </td>
        </tr>
   	</tbody></table>
	{if $pointe > 0 && !$DonateToFriend}
        <div class="right_part">
        <div class="gray_stripe">
            <input style="margin-top:7px; margin-right:10px; display:block; float:left;" name="ik_baggage_fields" id="fields3" onclick="calculation(3);" value="1" type="checkbox">
            <label for="fields2" onclick="calculation(3);">{$LNG.donation_p1} <span style="color:#FC0"> [{$pointe}%]</span></label>
            <span style="cursor:help; margin-top:7px;" class="interrogation tooltip" data-tooltip-content="<span style='color:#F00'>{$LNG.donation_p2}</span>">?</span>
        </div>
		
        <table class="tablesorter ally_ranks gray_stripe_th td_border_bottom">
            <tbody><tr> 
                <td>
                    <span style="color:#F90;">+<span class="pointe_bonus">0</span></span>
                </td>
            </tr>
        </tbody></table>
    </div>
	{/if}
	{if $donation_bonus > 0}
                <div class="left_part" {if $pointe == 0}style="width:100%"{/if}>
        <div class="gray_stripe">
            <span style="float:left;display:block;">{$LNG.donation_p4} <span style="color:#FC0;">[{$donation_bonus}%]</span></span>
                        	<span style="float:left;display:block;margin-left:5px;"><span style="color:#f00;float:left;">[<span class="bonus_of_amount_per">0</span>%]</span>
                <a class="interrogation tooltip" data-tooltip-content="{$donation_p3}" style="cursor:pointer;float:left;margin:5px;">?</a></span>
                    </div>
        <table class="tablesorter ally_ranks gray_stripe_th td_border_bottom">
            <tbody><tr> 
                <td>
                    <span style="color:#F90;">+<span id="bonus2">0</span></span>
                </td>
                                <td>
                    <span style="color:#f00;">+<span class="bonus_of_amount">0</span></span>
                </td>
                            </tr>
        </tbody></table>
    </div>
	{/if}
        <table class="tablesorter ally_ranks gray_stripe_th td_border_bottom">    
        <tbody><tr> 
            <td>            
                {$LNG.donation_amountget} <span id="count3" style="color:#F00; font-weight:bold;">0</span> {$LNG.tech.922}                      
            </td>
        </tr>
	</tbody></table>
    <div class="gray_stripe gray_stripe_big"> 
    <img alt="Xsolla" src="styles/images/icons/paysafecard-logo.png" style="float:left;"> 
        <div class="img_donat_sys" style="margin-left: 70px;">
		    <img alt="" src="styles/images/icons/sms.png">
        	<img alt="" src="styles/images/icons/Amazon.png">            
            <img alt="" src="styles/images/icons/skrill.png">
            <img alt="" src="styles/images/icons/WebMoney.png">
            <img alt="" src="styles/images/icons/Payza.png">
            <img alt="" src="styles/images/icons/Bitcoin.png">

        </div>
<input class="btn_big_blue" value="{$LNG.donation_checkout}" type="submit" style="float:right;">
	</div>
	</form>
</div>
    <table class="donation_table">
        <tbody><tr>
            <td>[RUB]</td>
            <td>[BYR]</td>
            <td>[UAH]</td>
            <td>[USD]</td>
            <td>[EUR]</td>            
        </tr>
        <tr>                    
            <td><span style="color:#09C;"><span id="cosr_rur">0</span> p.</span></td>
            <td><span style="color:#FC0;"><span id="cosr_byr">0</span> Br</span></td>
            <td><span style="color:#FC0;"><span id="cosr_uah">0</span> ₴</span></td>
            <td><span style="color:#3C0;"><span id="cosr_usd">0</span> $</span></td>
            <td><span style="color:#66C;"><span id="cosr_eur">0</span> €</span></td>
        </tr>               
    </tbody></table>

	
	
	
	
	 	<table class="tablesorter ally_ranks gray_stripe_th" style="margin-top:5px;margin-bottom:5px;">
        <tbody><tr>
            <td>
                {$LNG.donation_other}:
            </td>
            <td>
                <a class="btn_big_gray" onclick="displaypaysafecard();calculation(3);" href="#" style="HEIGHT: 20PX;LINE-HEIGHT: 20PX;FLOAT: RIGHT;width: 120px;">Paysafecard</a>
                {if $userID == 0}<a class='btn_big_gray' href="?page=donation#videos" style="HEIGHT: 20PX;LINE-HEIGHT: 20PX;FLOAT: RIGHT;width: 120px;">Watch Vids - 200 AM</a>{/if}
				<a class='btn_big_gray' onclick="displayinterkassa();$('#b_xsolla').slideToggle(0);$('#b_paypall').slideToggle(0);calculation(1);" href='#' style="HEIGHT: 20PX;LINE-HEIGHT: 20PX;FLOAT: RIGHT;width: 120px;display:none" id="b_paypall">Paypal</a>
				<a class='btn_big_gray' onclick="displayxsolla();$('#b_paypall').slideToggle(0);$('#b_xsolla').slideToggle(0);calculation(2);" href='#' style="HEIGHT: 20PX;LINE-HEIGHT: 20PX;FLOAT: RIGHT;width: 120px;" id="b_xsolla">Other (500+)</a>
				
				<a class='btn_big_gray' onclick="displayVoucher();" href="#" style="HEIGHT: 20PX;LINE-HEIGHT: 20PX;FLOAT: RIGHT;width: 120px;">Voucher</a>
	
	</td>
        </tr>
   	</tbody></table>
	
	{if $displayadsmd == 1}<div class="gray_stripe gray_stripe_big"> 
    	
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- War Of Galaxyz #Game -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2369063859511778"
     data-ad-slot="3349807407"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
	
        	</div>{/if}
	
	

</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script" append}
<script type="text/javascript">
	var pointe 	= {$pointe};
	var bonus 	= {$donation_bonus};
	var x_donation_inter 	= {$x_donation_inter};
	var x_donation_xsolla 	= {$x_donation_xsolla};
	var don_bonus 			= { "status":{$statutsss},"amoun":{$special_amont},"percent":{$special_donation_percent},"up_bonus":{$special_donation_up} };
</script>
{/block}