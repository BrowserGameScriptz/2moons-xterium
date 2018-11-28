{block name="title" prepend}Auctioneer{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
        {$LNG.auctioneer_2}
		   
		<div class="gr_btn_top" style="float:right;margin-right: 10px;">
        	<a href="game.php?page=auctioneer&amp;mode=inventory"  title="{$LNG.auctioneer_26}">{$LNG.auctioneer_25}</a>
       		
        </div>
    </div>   

	
	<div id="Centre">
        <div id="DivMessage" style="display:none;">
            <table style="margin:0 auto 4px;border:2px solid red ;width:650px" >
                <tr id="TrMessageJoueur">
	<td style="text-align:center;font-weight:bold;padding:10px;">
                        <span id="LblMessage" style="color:Red;"></span>
                    </td>
</tr>

            </table>
        </div>

	<table class="tablesorter ally_ranks" style="text-align:center;margin:0 auto;width:100%;" cellspacing="0px" cellpadding="0px">
            <tbody>
          
            
            <tr>                
                <td class="O3" style="width:200px;height:110px;background-image:url('styles/images/support.png');vertical-align:top;background-repeat:no-repeat;">
                    
					{if $isActive == 0}
					<div id="ItemVente" style="padding-top:15px;"><div style="position:relative;width:85px;margin:0 auto;text-align:center;"><div style="position:absolute;top:0px;width:100%;"><img src="styles/images/BackItem.png"></div>
					
					<div style="position:absolute;top:5px;width:100%;"><img src="styles/images/auction/{$isitem}.gif#" class="tooltip" style="width:60px;" data-tooltip-content="{$LNG.auctioneer_bonus.{$isitem}}"></div><div style="position:absolute;top:63px;width:100%;"><span style="font-size:10px;"><b>{$BonusItem}</b></span></div>
					
					<div style="position:absolute;top 0px;width:100%;cursor:pointer;z-index:99"><div style="position:absolute;top:0px;width:100%;"><img class="jbcaqkujbqrzmrzaxnzx" src="styles/images/transparent1x1.png" style="width:78px;height:78px;" onmousedown="return false"></div></div></div>
                </div>
				{else}
				   <div id="ItemVente" style="padding-top:15px;"><div style="position:relative;height:80px;width:90px;margin:0 auto;text-align:center;"><div style="position:absolute;top:0px;width:100%;"><img src="styles/images/BackItem.png" style="width:80px;"></div><div style="position:absolute;top:15px;width:100%;"><span style="font-size:40px;"><b>?</b></span></div><div style="position:absolute;top 0px;width:100%;height:100%;cursor:pointer;z-index:99"><div style="position:absolute;top:0px;width:100%;"><img src="styles/images/transparent1x1.png" style="width:100%;height:100%" onmousedown="return false"</div></div></div>
				{/if}
				
				</td>
                <td class="O3" style="vertical-align:middle;padding-left:10px;">
					{if $isActive == 0}
                    <span id="LblDetailVente">{$LNG.auctioneer_1} {$LNG.auctioneer_11}</span>
					{else}
					<span id="LblDetailVente">{$LNG.auctioneer_1} {$LNG.auctioneer_12}</span>
					{/if}
					
                </td>
            </tr>            
                    
            <tr style="height:100%;">                
                <td colspan="4">
                    <table class="tablesorter ally_ranks" style="width: 100%; height: 100%; background-color:rgb(9, 29, 46)" id="TblEnchere">
                        <tr>
                            <td >
                                <div class="O3" style="border-radius:8px;width:90%;text-align:center;margin:0 auto;padding:3px;">   
									{if $isActive == 0}
                                    <span id="LblTempsRestant"></span>
									{else}
									<span id="LblTempsRestant">{$LNG.auctioneer_10} :<br/><span id="CR0" style="color:lime;"/></span>
									{/if}
                                </div>                        
                            </td>
                        
                            <td >
                                <div class="O3" style="border-radius:8px;width:90%;text-align:center;margin:0 auto;padding:3px;">
                                    <span id="LblIntitule">{$LNG.auctioneer_3} :</span>
                                    <div style="border-radius:8px;width:90%;text-align:center;margin:0 auto;padding:3px;">
                                        <span id="LblEnchereActuelle">{$total_bid|number}</span>
                                    </div>
                                </div>                        
                            </td>
                       
                            <td>
                                <div class="O3" style="border-radius:8px;width:90%;text-align:center;margin:0 auto;padding:3px;">
                                    {$LNG.auctioneer_4} :
                                    <div style="border-radius:8px;width:90%;text-align:center;margin:0 auto;padding:3px;">
                                        <span id="LblNbEncheres">{$total_count|number}</span>
                                    </div>
                                </div>                        
                            </td>
                      
                            <td >
                            <div class="O3" style="border-radius:8px;width:90%;text-align:center;margin:0 auto;padding:3px;">
                                {$LNG.auctioneer_5} :
                                <div style="border-radius:8px;width:90%;text-align:center;margin:0 auto;padding:3px;">
                                    <span id="LblAcquereur">{$bid_username}</span>
                                </div>
                            </div>                        
                        </td>
                        </tr>
                      
                    </table>
                </td>
				</tr>
				<tr>
                <td style="vertical-align:top;" colspan="4">
                        {if $isActive == 1}
						<div id="NoVente" style="position:absolute;z-index:99;background-image:url('styles/images/b.png');width:98%;height:245px;background-repeat:repeat;margin-top:3px;margin-left:3px;">                           
                        </div>
						{/if}
                            <table style="width:100%;height:200px;" class="tablesorter ally_ranks">
                                <tr style="background: rgba(94,66,64,0.5);height:30px;">
                                    <td>
                                       
                                                    <img src="styles/images/901.gif" alt="Métal" style="width:30px;">
                                                </td>
                                                <td style="width:40px;text-align:center;">
                                                    <span style="color:rgb(167, 129, 126)">x 1</span>
                                                </td>
                                                <td style="width:60px;text-align:center;">
                                                  
												   <input value="max" type="submit" onclick="SetMax('TxtMetal');">
                                                </td>
                                                <td colspan="3" style="text-align:center;width:30px;">
                                                    
													 <input name="TxtMetal" maxlength="15" id="TxtMetal" onkeydown="return CheckNb(event);" onkeyup="Augmentation();" onblur="Augmentation();" style="width:95%;text-align:right;" value="0">
                                                </td>
                                            </tr>
                                            <tr style="background: rgba(88,146,231,0.3);height:30px;">
                                                <td>
                                                    <img src="styles/images/902.gif" alt="Cristal" style="width:30px;">
                                                </td>
                                                <td style="width:40px;text-align:center;">
                                                    <span style="color:rgba(88,146,231,1)">x <span id="LblCTICristal">2</span></span>
                                                </td>
                                                <td>
												 
												 <input value="max" type="submit" onclick="SetMax('TxtCristal');">

                                                </td>
                                                <td colspan="3" style="text-align:center;width:30px;">
												<input name="TxtCristal" maxlength="15" id="TxtCristal" onkeydown="return CheckNb(event);" onkeyup="Augmentation();" onblur="Augmentation();" style="width:95%;text-align:right;" value="0">

                                                </td>
                                            </tr>
                                            <tr style="background: rgba(51,172,93,0.3);height:30px;">
                                                <td>
                                                    <img src="styles/images/903.gif" alt="Deutérim" style="width:30px;">
                                                </td>
                                                <td style="width:40px;text-align:center;">
                                                    <span style="color:rgba(51,172,93,1);">x <span id="LblCTIDeuterium">3</span></span>
                                                </td>
                                                <td>
												
												<input value="max" type="submit" onclick="SetMax('TxtDeuterium');">

                                                </td>
                                                <td style="text-align:center;width:30px;" colspan="3">
											 <input name="TxtDeuterium" maxlength="15" id="TxtDeuterium" onkeydown="return CheckNb(event);" onkeyup="Augmentation();" onblur="Augmentation();" value="0" style="width:95%;text-align:right;">

                                                </td>
                                            </tr>
                                                   
                               
                                            <tr style="height:30px;">
                                                <td style="text-align:right;width:16.6%">
                                                    {$LNG.auctioneer_6} :
                                                </td>
                                                <td style="text-align:right;width:16.6%;padding-right:20px;">
                                                    <span id="LblAjoutEnchere">0</span>
                                                </td>
                                         
                                                <td  style="text-align:right;width:16.6%">
                                                    {$LNG.auctioneer_7} :
                                                </td>
                                                <td style="text-align:right;width:16.6%;padding-right:20px;">
                                                    <span id="LblMontantEnchere">0</span>
                                                </td>
                                           
                                                <td  style="text-align:right;width:16.6%">
                                                    {$LNG.auctioneer_8} :
                                                </td>
                                                <td style="text-align:right;width:16.6%;padding-right:20px;">
                                                    {if $isActive == 0}
													<span id="LblEnchereMini">1.000.000.000</span>
													{else}
                                                    <span id="LblEnchereMini">0</span>
													{/if}
                                                </td>
                                            </tr>
											  
                                           
                                        
                            </tbody></table>
							</tr></table>
							
							<input class="fl_bigbtn_go" value="{$LNG.auctioneer_17}" onclick="Encherir();" type="submit" style="width: 100%;margin-top: 10px;margin-bottom: 0px;">
            
{/block}
{block name="script" append}
{if $isActive == 0}
<script type="text/javascript">
var CTICri=2;
var CTIDeut=3;
var IdJ={$userID};
var lng1="{$LNG.auctioneer_13}";
var lng2="{$LNG.auctioneer_14}";
var lng3="{$LNG.auctioneer_15}";
var lng4="{$LNG.auctioneer_16}";
var lng5="{$LNG.auctioneer_18}";

SuiviEncheres(true);</script>
{else}
<script language = "javascript">var delta = 0;var TabCR=new Array('{$dating} {$daters}:00:00');CompteRebourg();var StrPage='Auctioneer';
dtsrv = new Date(document.getElementById('servertime').innerHTML);
d = new Date();
delta = Math.round((d.valueOf() - dtsrv.valueOf()) / 1000);  
</script>
{/if}

{/block}
