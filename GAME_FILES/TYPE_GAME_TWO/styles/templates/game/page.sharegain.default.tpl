{block name="title" prepend}{$LNG.acs_share_1}{/block}
{block name="content"}


<div id="page">
	<div id="content">
	<style type="text/css">
        table {
            border-collapse: collapse;
            /* Les bordures du tableau seront colles (plus joli) */
            text-align: center;
            border-color: #7F00FF";

        }
        
        td {
            border: 1px solid #000813;
        }
        
        h1 {
            Color: #CC00FF;
        }
        
        .ttableau {
            Color: #FF0033;
            font-weight: bold;
            font-size: x-large;
            vertical-align: 50%;
        }
        
        .nbra,
        .noma {
            color: #EA5D5D;
            font-weight: bold;
        }
        
        .nbrab {
            color: #BD9D1B;
            font-weight: bold;
        }
        
        .vsx {
            color: #DCC97B;
            font-style: italic;
        }
        
        .nbrab1 {
            color: #BD9D1B;
            font-weight: bold;
        }
        
        .btm,
        .btmt,
        btmm {
            color: #F03FEA;
            font-weight: bold;
        }
        
        .metal {
            color: #a47d7a;
        }
        
        .cristal {
            color: #5ca6aa;
        }
        
        .deut {
            color: #339966;
        }
    </style>
	
	
	
	<div id="ally_content" style="width:920px;" class="conteiner">
	<div class="gray_stripe">
	<form id="form" name="acsForm" action="?page=share&mode=automated" method="post">
        {$LNG.acs_share_1}
				
                <span class="imper_gala_bonuses imper_atm_logs" id="rid">RID: <INPUT type="text" name="nrid" id="nb_rid" placeholder="{$LNG.acs_share_2}" value="{if $RID != ""}{$RID}{/if}" /> <input style=" border:0; background:0; padding:0;" src="./styles/images/true.png" alt="" border="0" type="image"></span>
				<span class="imper_gala_bonuses imper_atm_logs" id="nbside">{$LNG.acs_share_3}: <select name="nside" id="nb_side"><option value="1" {if $NSIDE == 1}selected{/if}>{$LNG.acs_share_5}</option><option value="2" {if $NSIDE == 2}selected{/if}>{$LNG.acs_share_6}</option></select> 
				</span>
                <span class="imper_gala_bonuses imper_atm_logs" id="nba">{$LNG.acs_share_4}: <select name="nbatt" id="nb_attaquant"><option value="1" {if $t == 1}selected{/if}>1</option><option value="2" {if $t == 2}selected{/if}>2</option><option value="3" {if $t == 3}selected{/if}>3</option><option value="4" {if $t == 4}selected{/if}>4</option><option value="5" {if $t == 5}selected{/if}>5</option></select> 
				</span></form>
    </div>
	
	
	
	<br><br>
        <table onMouseOut="javascript:caculer_perte()">
           <div class="gray_stripe">
    	{$LNG.acs_share_7}
		
		<a onclick="javascript:caculer_perte()" class="tooltip" data-tooltip-content="{$LNG.acs_share_8}"><img src="./styles/images/frecciesim.png" style="float:right;margin-top:8px;width: 12px;height: 12px;" value="{$LNG.acs_share_8}"></a>
		<a onclick="javascript:klikfleets()" id="fleets_btn"><img style="float:right;background-image:url(./styles//images/block_show.png);width:14px;height:14px;margin-right:-30px;margin-top:8px;cursor:pointer;"></a>
   

   </div>
	
	<table onMouseOut="javascript:caculer_perte()" id="show_fleet_content" style="display: none;">
	<center>
            <tr>
                <td colspan="2"></td>
                <td>
                    <INPUT type="text" name="att1" class="att1i" value="{if isset($battleinput.1.name)}{$battleinput.1.name}{else}{$LNG.acs_share_9} 1{/if}" disabled /> </td>
                <td>
                    <INPUT type="text" name="att2" class="att2i" value="{if isset($battleinput.2.name)}{$battleinput.2.name}{else}{$LNG.acs_share_9} 2{/if}" disabled /> </td>
                <td>
                    <INPUT type="text" name="att3" class="att3i" value="{if isset($battleinput.3.name)}{$battleinput.3.name}{else}{$LNG.acs_share_9} 3{/if}" disabled /> </td>
                <td>
                    <INPUT type="text" name="att4" class="att4i" value="{if isset($battleinput.4.name)}{$battleinput.4.name}{else}{$LNG.acs_share_9} 4{/if}" disabled /> </td>
                <td>
                    <INPUT type="text" name="att5" class="att5i" value="{if isset($battleinput.5.name)}{$battleinput.5.name}{else}{$LNG.acs_share_9} 5{/if}" disabled /> </td>
					
            </tr>
			{foreach $fleetList as $id}
            <tr>
                <td class="battlesim_img_ship"><img src="./styles/theme/gow/gebaeude/{$id}.gif" alt="{$LNG.tech.$id}" title="{$LNG.tech.$id}"></td>
				<td class="battlesim_name_ship">{if $id == 224 || $id == 229 || $id == 230}<span style="color:#32CD32">{$LNG.tech.$id}</span>{else}{$LNG.tech.$id}{/if}</td>
                <td>
                    <INPUT type="text" name="a1s{$id}" class="s{$id}" value="{if isset($battleinput.1.$id)}{$battleinput.1.$id}{else}0{/if}" /> </td>
                <td>
                    <INPUT type="text" name="a2s{$id}" class="s{$id}" value="{if isset($battleinput.2.$id)}{$battleinput.2.$id}{else}0{/if}" /> </td>
                <td>
                    <INPUT type="text" name="a3s{$id}" class="s{$id}" value="{if isset($battleinput.3.$id)}{$battleinput.3.$id}{else}0{/if}" /> </td>
                <td>
                    <INPUT type="text" name="a4s{$id}" class="s{$id}" value="{if isset($battleinput.4.$id)}{$battleinput.4.$id}{else}0{/if}" /> </td>
                <td>
                    <INPUT type="text" name="a5s{$id}" class="s{$id}" value="{if isset($battleinput.5.$id)}{$battleinput.5.$id}{else}0{/if}" /> </td>
            </tr>
			{/foreach}
           
        </table>
        </table>
        <br/>
        <table>
            <div class="gray_stripe" id="pertetd">
    	{$LNG.acs_share_10}
		<a onclick="javascript:caculer_perte()" class="tooltip" data-tooltip-content="{$LNG.acs_share_8}"><img src="./styles/images/frecciesim.png" style="float:right;margin-top:8px;width: 12px;height: 12px;" value="{$LNG.acs_share_8}"></a>
		<a onclick="javascript:kliklost()"><img style="float:right;background-image:url(./styles//images/block_show.png);width:14px;height:14px;margin-right:-30px;margin-top:8px;cursor:pointer;"></a>
    </div>
	
	<table onMouseOut="javascript:caculer_perte()" id="show_lost_content" style="display: none;">
            <tr>
                <td colspan="2"></td>
                <td><span class="att1">  {$LNG.acs_share_9} 1  </span></td>
                <td><span class="att2">  {$LNG.acs_share_9} 2  </span></td>
                <td><span class="att3">  {$LNG.acs_share_9} 3  </span></td>
                <td><span class="att4">  {$LNG.acs_share_9} 4  </span></td>
                <td><span class="att5">  {$LNG.acs_share_9} 5  </span></td>
            </tr>
			
			<tr>
				<td class="battlesim_img_ship"><img src="styles/images/901.gif" alt="{$LNG.tech.901}"></td>
                <td class="battlesim_name_ship" style="min-width: 120px;"><span class="metal">  {$LNG.tech.901} </span> </td>
				<td class="perte_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_m" style="width:147px;height:24px;"><span>0</span></td>
            </tr>
			
			<tr>
				<td class="battlesim_img_ship"><img src="styles/images/902.gif" alt="{$LNG.tech.902}"></td>
                <td class="battlesim_name_ship" style="min-width: 120px;"><span class="cristal" style="min-width:120px;">   {$LNG.tech.902} </span> </td>
				<td class="perte_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_c" style="width:147px;height:24px;"><span>0</span></td>
            </tr>
			
			<tr>
				<td class="battlesim_img_ship"><img src="styles/images/903.gif" alt="{$LNG.tech.903}"></td>
                <td class="battlesim_name_ship" style="min-width: 120px;"><span class="deut" style="min-width:120px;">   {$LNG.tech.903} </span> </td>
				<td class="perte_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_d" style="width:147px;height:24px;"><span>0</span></td>
            </tr>
        </table>
        </table>
        <br/>
        <table onMouseOut="javascript:calculer_gain_par_attaquant_apres_pillage()">
             <div class="gray_stripe" id="pillage">
    	{$LNG.acs_share_11}
		<a onclick="javascript:calculer_gain_par_attaquant_apres_pillage()" class="tooltip" data-tooltip-content="{$LNG.acs_share_8}"><img src="./styles/images/frecciesim.png" style="float:right;margin-top:8px;width: 12px;height: 12px;" value="{$LNG.acs_share_8}"></a>
		<a onclick="javascript:kliklostaftersteal()"><img style="float:right;background-image:url(./styles//images/block_show.png);width:14px;height:14px;margin-right:-30px;margin-top:8px;cursor:pointer;"></a>
    </div>
	<table onMouseOut="javascript:calculer_gain_par_attaquant_apres_pillage()" id="show_lostaftersteal_content" style="display: none;">
           <tr>
                <td colspan="2"></td>
                <td><span class="att1">  {$LNG.acs_share_9} 1  </span></td>
                <td><span class="att2">  {$LNG.acs_share_9} 2  </span></td>
                <td><span class="att3">  {$LNG.acs_share_9} 3  </span></td>
                <td><span class="att4">  {$LNG.acs_share_9} 4  </span></td>
                <td><span class="att5">  {$LNG.acs_share_9} 5  </span></td>
            </tr>
			<tr>
				<td class="battlesim_img_ship"><img src="styles/images/901.gif" alt="{$LNG.tech.901}"></td>
                <td class="battlesim_name_ship" style="width:120px;"><span class="metal">  {$LNG.tech.901} </span> </td>
                <td><INPUT type="text" name="a1pm" class="pillage_m" value="0" /> </td>
                <td><INPUT type="text" name="a2pm" class="pillage_m" value="0" /> </td>
                <td><INPUT type="text" name="a3pm" class="pillage_m" value="0" /> </td>
                <td><INPUT type="text" name="a4pm" class="pillage_m" value="0" /> </td>
                <td><INPUT type="text" name="a5pm" class="pillage_m" value="0" /> </td>
            </tr>
            <tr>
               <td class="battlesim_img_ship"><img src="styles/images/902.gif" alt="{$LNG.tech.902}"></td>
                <td class="battlesim_name_ship" style="width:120px;"><span class="cristal">  {$LNG.tech.902} </span> </td>
                <td><INPUT type="text" name="a1pc" class="pillage_c" value="0" /> </td>
                <td><INPUT type="text" name="a2pc" class="pillage_c" value="0" /> </td>
                <td><INPUT type="text" name="a3pc" class="pillage_c" value="0" /> </td>
                <td><INPUT type="text" name="a4pc" class="pillage_c" value="0" /> </td>
                <td><INPUT type="text" name="a5pc" class="pillage_c" value="0" /> </td>
				
            </tr>
            <tr>
                <td class="battlesim_img_ship"><img src="styles/images/903.gif" alt="{$LNG.tech.903}"></td>
                <td class="battlesim_name_ship" style="width:120px;"><span class="deut">  {$LNG.tech.903} </span> </td>
                <td><INPUT type="text" name="a1pd" class="pillage_d" value="0" /> </td>
                <td><INPUT type="text" name="a2pd" class="pillage_d" value="0" /> </td>
                <td><INPUT type="text" name="a3pd" class="pillage_d" value="0" /> </td>
                <td><INPUT type="text" name="a4pd" class="pillage_d" value="0" /> </td>
                <td><INPUT type="text" name="a5pd" class="pillage_d" value="0" /> </td>
				
            </tr>
			<tr>
                <td colspan="7"></td>
            </tr>
			<tr>
                <td class="battlesim_img_ship"></td>
				<td class="battlesim_name_ship"><span class="btm">  {$LNG.acs_share_13} </span> </td>
                <td class="b_pillage_m"><span>0</span></td>
				<td class="b_pillage_c"><span>0</span></td>
				<td class="b_pillage_d"><span>0</span></td>
				
            </tr>
        </table>
        </table>
        <br/>
        <table>
		<div class="gray_stripe" id="perteapil">{$LNG.acs_share_12}
		<a onclick="javascript:calculer_gain_par_attaquant_apres_pillage()" class="tooltip" data-tooltip-content="{$LNG.acs_share_8}"><img src="./styles/images/frecciesim.png" style="float:right;margin-top:8px;width: 12px;height: 12px;" value="{$LNG.acs_share_8}"></a>
		<a onclick="javascript:kliklostaftersteal3()"><img style="float:right;background-image:url(./styles//images/block_show.png);width:14px;height:14px;margin-right:-30px;margin-top:8px;cursor:pointer;"></a>
    </div>
		<table onMouseOut="javascript:calculer_gain_par_attaquant_apres_pillage()" id="show_lostaftersteal3_content" style="display: none;"> 
            <tr>
                <td colspan="2"></td>
                <td><span class="att1">  {$LNG.acs_share_9} 1  </span></td>
                <td><span class="att2">  {$LNG.acs_share_9} 2  </span></td>
                <td><span class="att3">  {$LNG.acs_share_9} 3  </span></td>
                <td><span class="att4">  {$LNG.acs_share_9} 4  </span></td>
                <td><span class="att5">  {$LNG.acs_share_9} 5  </span></td>
            </tr>
			
			<tr>
				<td class="battlesim_img_ship"><img src="styles/images/901.gif" alt="{$LNG.tech.901}"></td>
                <td class="battlesim_name_ship" style="width:120px;"><span class="metal">  {$LNG.tech.901} </span> </td>
				<td class="perte_a_pil_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_a_pil_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_a_pil_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_a_pil_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_a_pil_m" style="width:147px;height:24px;"><span>0</span></td>
            </tr>
			
			<tr>
				<td class="battlesim_img_ship"><img src="styles/images/902.gif" alt="{$LNG.tech.902}"></td>
                <td class="battlesim_name_ship" style="min-width: 120px;"><span class="cristal">  {$LNG.tech.902} </span> </td>
				<td class="perte_a_pil_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_a_pil_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_a_pil_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_a_pil_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_a_pil_c" style="width:147px;height:24px;"><span>0</span></td>
            </tr>
			
			<tr>
				<td class="battlesim_img_ship"><img src="styles/images/903.gif" alt="{$LNG.tech.903}"></td>
                <td class="battlesim_name_ship" style="min-width: 120px;"><span class="deut">  {$LNG.tech.903} </span> </td>
				<td class="perte_a_pil_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_a_pil_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_a_pil_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_a_pil_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="perte_a_pil_d" style="width:147px;height:24px;"><span>0</span></td>
            </tr>
        </table>
        </table>
        <br/>
        <table onMouseOut="javascript:calculer_fin()">
		<div class="gray_stripe" id="recy">{$LNG.acs_share_14}
		<a onclick="javascript:calculer_fin()" class="tooltip" data-tooltip-content="{$LNG.acs_share_8}"><img src="./styles/images/frecciesim.png" style="float:right;margin-top:8px;width: 12px;height: 12px;" value="{$LNG.acs_share_8}"></a>
		<a onclick="javascript:klikrecycle()"><img style="float:right;background-image:url(./styles//images/block_show.png);width:14px;height:14px;margin-right:-30px;margin-top:8px;cursor:pointer;"></a>
    </div>
           <table onMouseOut="javascript:calculer_fin()" id="show_recycle_content" style="display: {if $display == 1}none{else}block{/if};"> 
            <tr>
                <td colspan="2"></td>
                <td> <span class="att1"> {$LNG.acs_share_9} 1 </span> </td>
                <td> <span class="att2"> {$LNG.acs_share_9} 2 </span> </td>
                <td> <span class="att3"> {$LNG.acs_share_9} 3 </span> </td>
                <td> <span class="att4"> {$LNG.acs_share_9} 4 </span> </td>
                <td> <span class="att5"> {$LNG.acs_share_9} 5  </span></td>
            </tr>
            <tr>
                <td class="battlesim_img_ship"><img src="styles/images/901.gif" alt="{$LNG.tech.901}"></td>
                <td class="battlesim_name_ship" style="min-width: 120px;"><span class="metal">  {$LNG.tech.901} </span> </td>
                <td><INPUT type="text" name="a1rem" class="rc_m" value="0" /> </td>
                <td><INPUT type="text" name="a2rem" class="rc_m" value="0" /> </td>
                <td><INPUT type="text" name="a3rem" class="rc_m" value="0" /> </td>
                <td><INPUT type="text" name="a4rem" class="rc_m" value="0" /> </td>
                <td><INPUT type="text" name="a5rem" class="rc_m" value="0" /> </td>
            </tr>
            <tr>
                <td class="battlesim_img_ship"><img src="styles/images/902.gif" alt="{$LNG.tech.902}"></td>
                <td class="battlesim_name_ship" style="min-width: 120px;"><span class="cristal">  {$LNG.tech.902} </span> </td>
                <td><INPUT type="text" name="a1rec" class="rc_c" value="0" /> </td>
                <td><INPUT type="text" name="a2rec" class="rc_c" value="0" /> </td>
                <td><INPUT type="text" name="a3rec" class="rc_c" value="0" /> </td>
                <td><INPUT type="text" name="a4rec" class="rc_c" value="0" /> </td>
                <td><INPUT type="text" name="a5rec" class="rc_c" value="0" /> </td>
               
            </tr>
			<tr>
                <td colspan="7"></td>
            </tr>
			 <tr>
				<td class="battlesim_img_ship"></td>
                <td class="battlesim_name_ship"><span class="btm">  {$LNG.acs_share_13} </span> </td>
                <td class="b_rc_m"><span>0</span></td>
                <td class="b_rc_c"><span>0</span></td>
            </tr>
        </table>
        </table>
        <br/>
        <table onMouseOut="javascript:calculer_fin()">
		<div class="gray_stripe" id="deut_dep">{$LNG.acs_share_15}
		<a onclick="javascript:calculer_fin()" class="tooltip" data-tooltip-content="{$LNG.acs_share_8}"><img src="./styles/images/frecciesim.png" style="float:right;margin-top:8px;width: 12px;height: 12px;" value="{$LNG.acs_share_8}"></a>
		<a onclick="javascript:klikdeutused()"><img style="float:right;background-image:url(./styles//images/block_show.png);width:14px;height:14px;margin-right:-30px;margin-top:8px;cursor:pointer;"></a>
    </div>
             <table onMouseOut="javascript:calculer_fin()" id="show_deutused_content" style="display: none;"> 
            <tr>
                <td colspan="2"></td>
                <td><span class="att1">  {$LNG.acs_share_9} 1 </span> </td>
                <td><span class="att2">  {$LNG.acs_share_9} 2 </span> </td>
                <td><span class="att3">  {$LNG.acs_share_9} 3 </span> </td>
                <td><span class="att4">  {$LNG.acs_share_9} 4 </span> </td>
                <td><span class="att5">  {$LNG.acs_share_9} 5 </span> </td>
            </tr>
            <tr>
                <td class="battlesim_img_ship"><img src="styles/images/903.gif" alt="{$LNG.tech.903}"></td>
                <td class="battlesim_name_ship" style="min-width: 120px;"><span class="deut">   {$LNG.tech.903} </span> </td>
                <td><INPUT type="text" name="deut_d0" class="deut_d" value="0" /> </td>
                <td><INPUT type="text" name="deut_d1" class="deut_d" value="0" /> </td>
                <td><INPUT type="text" name="deut_d2" class="deut_d" value="0" /> </td>
                <td><INPUT type="text" name="deut_d3" class="deut_d" value="0" /> </td>
                <td><INPUT type="text" name="deut_d4" class="deut_d" value="0" /> </td>
                
            </tr>
			<tr>
                <td colspan="7"></td>
            </tr>
			 <tr>
				<td class="battlesim_img_ship"></td>
                <td class="battlesim_name_ship" style="min-width: 120px;"><span class="btm">  {$LNG.acs_share_13} </span> </td>
                <td class="b_deut_d"><span>0</span></td>
            </tr>
        </table>
        </table>
        <br/>
        <table>
		<div class="gray_stripe" id="rentadp_pus_a">{$LNG.acs_share_16}
		<a onclick="javascript:calculer_fin()" class="tooltip" data-tooltip-content="{$LNG.acs_share_8}"><img src="./styles/images/frecciesim.png" style="float:right;margin-top:8px;width: 12px;height: 12px;" value="{$LNG.acs_share_8}"></a>
		<a onclick="javascript:kliklostaftersteal2()"><img style="float:right;background-image:url(./styles//images/block_show.png);width:14px;height:14px;margin-right:-30px;margin-top:8px;cursor:pointer;"></a>
    </div>
	
           <table onMouseOut="javascript:calculer_fin()" id="show_lostaftersteal2_content" style="display: {if $display == 1}none{else}block{/if};"> 
            <tr>
                <td colspan="2"></td>
                <td> <span class="att1"> {$LNG.acs_share_9} 1 </span> </td>
                <td> <span class="att2"> {$LNG.acs_share_9} 2 </span> </td>
                <td> <span class="att3"> {$LNG.acs_share_9} 3 </span> </td>
                <td> <span class="att4"> {$LNG.acs_share_9} 4 </span> </td>
                <td> <span class="att5"> {$LNG.acs_share_9} 5 </span> </td>
            </tr>
            <tr>
                <td class="battlesim_img_ship"><img src="styles/images/901.gif" alt="{$LNG.tech.901}"></td>
                <td style="min-width: 120px;"><span class="metal">  {$LNG.tech.901} </span> </td>
                <td class="renta_a_pil_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="renta_a_pil_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="renta_a_pil_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="renta_a_pil_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="renta_a_pil_m" style="width:147px;height:24px;"><span>0</span></td>
                
            </tr>
            <tr>
                <td class="battlesim_img_ship"><img src="styles/images/902.gif" alt="{$LNG.tech.902}"></td>
                <td style="min-width: 120px;"><span class="cristal">  {$LNG.tech.902} </span> </td>
                <td class="renta_a_pil_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="renta_a_pil_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="renta_a_pil_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="renta_a_pil_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="renta_a_pil_c" style="width:147px;height:24px;"><span>0</span></td>
                
            </tr>
            <tr>
                <td class="battlesim_img_ship"><img src="styles/images/903.gif" alt="{$LNG.tech.903}"></td>
                <td style="min-width: 120px;"><span class="deut">  {$LNG.tech.903} </span> </td>
                <td class="renta_a_pil_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="renta_a_pil_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="renta_a_pil_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="renta_a_pil_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="renta_a_pil_d" style="width:147px;height:24px;"><span>0</span></td>
                
            </tr>
			<tr>
                <td colspan="7"></td>
            </tr>
			 <tr>
                <td class="battlesim_img_ship"></td>
                <td class="battlesim_name_ship" style="min-width: 120px;"><span class="btmt">  {$LNG.acs_share_17} </span> </td>
                <td class="renta_total_m"><span>0</span></td>
				<td class="renta_total_c"><span>0</span></td>
                <td class="renta_total_d"><span>0</span></td>
            </tr>
			 <tr>
                <td class="battlesim_img_ship"></td>
                <td class="battlesim_name_ship" style="min-width: 120px;"><span class="btmm">  {$LNG.acs_share_18} </span> </td>
				<td class="renta_moyenne_m"><span>0</span></td>
				<td class="renta_moyenne_c"><span>0</span></td>
                <td class="renta_moyenne_d"><span>0</span></td>
            </tr>
        </table>
        </table>
        <br/>
        <table>
		<div class="gray_stripe" id="fin">{$LNG.acs_share_19}
		<a onclick="javascript:calculer_fin()" class="tooltip" data-tooltip-content="{$LNG.acs_share_8}"><img src="./styles/images/frecciesim.png" style="float:right;margin-top:8px;width: 12px;height: 12px;" value="{$LNG.acs_share_8}"></a>
		<a onclick="javascript:klikdiff()"><img style="float:right;background-image:url(./styles//images/block_show.png);width:14px;height:14px;margin-right:-30px;margin-top:8px;cursor:pointer;"></a>
    </div>
	<table onMouseOut="javascript:calculer_fin()" id="show_diff_content" style="display: none;">
            
			<tr>
                <td colspan="2"></td>
                <td><span class="att1">  {$LNG.acs_share_9} 1  </span></td>
                <td><span class="att2">  {$LNG.acs_share_9} 2  </span></td>
                <td><span class="att3">  {$LNG.acs_share_9} 3  </span></td>
                <td><span class="att4">  {$LNG.acs_share_9} 4  </span></td>
                <td><span class="att5">  {$LNG.acs_share_9} 5  </span></td>
            </tr>
			
			<tr>
				<td class="battlesim_img_ship"><img src="styles/images/901.gif" alt="{$LNG.tech.901}"></td>
                <td style="min-width: 120px;"><span class="metal">  {$LNG.tech.901} </span> </td>
				<td class="donne_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="donne_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="donne_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="donne_m" style="width:147px;height:24px;"><span>0</span></td>
                <td class="donne_m" style="width:147px;height:24px;"><span>0</span></td>
            </tr>
			
			<tr>
				<td class="battlesim_img_ship"><img src="styles/images/902.gif" alt="{$LNG.tech.902}"></td>
                <td style="min-width: 120px;"><span class="cristal">  {$LNG.tech.902} </span> </td>
				<td class="donne_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="donne_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="donne_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="donne_c" style="width:147px;height:24px;"><span>0</span></td>
                <td class="donne_c" style="width:147px;height:24px;"><span>0</span></td>
            </tr>
			
			<tr>
				<td class="battlesim_img_ship"><img src="styles/images/903.gif" alt="{$LNG.tech.903}"></td>
                <td style="min-width: 120px;"><span class="deut">  {$LNG.tech.903} </span> </td>
				<td class="donne_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="donne_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="donne_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="donne_d" style="width:147px;height:24px;"><span>0</span></td>
                <td class="donne_d" style="width:147px;height:24px;"><span>0</span></td>
            </tr>

        </table>
        </table>
    </center>
	
   
	</form>

            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
		
{/block}