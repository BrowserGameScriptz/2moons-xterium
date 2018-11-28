{block name="title" prepend}Headhunter module{/block}
{block name="content"}
<div id="page">

<div id="content">
<div id="ally_content" class="conteiner">

    <div class="gray_stripe" style="border-bottom:0;">
    	Hiring a Mercenary
		<a href="#" id="arrow_question" style="left:95%;" class="interrogation manual tooltip" data-tooltip-content="You can ask a player to help you destroy a target, For a Payment. Once  a target is chosen and a player accepts contract, he/she will become a mercenary at your service. To finish this transaction  you have the proof that the target is destroyed (message with RC).">?</a>
    </div>
	</th>
</tr>
<div style="display:block;" id="bigPicture">
<td><img src="styles/theme/gow/img/scout.gif" width="800px" height="200px"></td>
</div>


<div class="ally_contents" style="padding-bottom: 15px;padding-top: 10px;display:none;" id="targetInfo">

	<img title="" src="media/files/avatar_defaut.jpg" style="float:left;height:85px;width:85px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin-top: 1px;">
        <p>
		<span style="margin-left:15px;color:white;">Player:</span> <span>Thisishowwedoit</span> 
		<span style="margin-left:15px;color:white;">Total Points: <span>1.000.000</span></span>
		</p>
		<p>
		<span style="margin-left:15px;color:white;">Alliance:</span> <span>[WarOfGalaxyz]</span>
		<span style="margin-left:15px;color:white;">Building Points: <span>0</span></span>
		</p>
		<p>
		<span style="margin-left:15px;color:white;">Planet Count:</span> <span>1</span>
		<span style="margin-left:15px;color:white;">Research Points: <span>0</span></span>
		</p>
		<p>
		<span style="margin-left:15px;color:white;">Moon Count:</span> <span>0</span>
		<span style="margin-left:15px;color:white;">Military Points: <span>0</span></span>
		</p>
	
		
    </div>
    <div class="gray_stripe" style="border-bottom:0;">
    	Headhunter information <span id="textErrorCheck" style="float:right;"></span>
    </div>
	<form action="?page=mercenaire&mode=setContrat" method="POST">
	<div class="ally_contents" style="padding-bottom:5px;">
		<label class="left_label" style="width: 160px;">Choose your target</label>
		<input type="number" min="1" max="6" class="seting_text" name="target_galaxy" value="1" id="target_galaxy" onChange="checkCoordinates();" onKeyPress="checkCoordinates();" onKeyUp="checkCoordinates();" onKeyDown="checkCoordinates();">
		<input type="number" min="1" max="200" class="seting_text" name="target_system" value="1" id="target_system" onChange="checkCoordinates();" onKeyPress="checkCoordinates();" onKeyUp="checkCoordinates();" onKeyDown="checkCoordinates();">
		<input type="number" min="1" max="20" class="seting_text" name="target_planet" value="1" id="target_planet" onChange="checkCoordinates();" onKeyPress="checkCoordinates();" onKeyUp="checkCoordinates();" onKeyDown="checkCoordinates();">

		<div class="clear"></div>
	</div>


	<div id="build_elements" class="officier_elements prem_shop">
    <div class="build_box" style="-moz-border-radius: 0px;-webkit-border-radius: 0px;border-radius: 0px;border: none;margin-left: 0px !important;width: 100% !important;margin-bottom:7px !important;">
        <div class="head" onclick="OpenBox('open_list');">
            <span style="padding:0;margin: 7px 7px 7px 7px;">Rewards information</span>
            <span id="open_btn_open_list" class="prem_open_btn">-</span>            
        </div>
		
        <div id="box_open_list" class="content_box" style="height: auto;display:block">
			<div class="ally_contents" style="padding-bottom:5px;">
				<label class="left_label" style="width: 160px;">{$LNG.tech.901}</label>
				<input type="text" class="big_seting_text" name="res_901" placeholder="{$LNG.tech.901}">
				<div class="clear"></div>
				<label class="left_label" style="width: 160px;">{$LNG.tech.902}</label>
				<input type="text" class="big_seting_text" name="res_902" placeholder="{$LNG.tech.902}">
				<div class="clear"></div>
				<label class="left_label" style="width: 160px;">{$LNG.tech.903}</label>
				<input type="text" class="big_seting_text" name="res_903" placeholder="{$LNG.tech.903}">
				<div class="clear"></div>
				<label class="left_label" style="width: 160px;">Military Destruction</label>
				<input type="text" class="big_seting_text" name="mil_des" placeholder="How much % do you want the target to lose to fullfill the contract ?"> %
				<div class="clear"></div>
			</div>
		</div>
    </div>
	</div>
	</form>
	
	<div id="build_elements" class="officier_elements prem_shop">
	<div class="build_box" style="-moz-border-radius: 0px;-webkit-border-radius: 0px;border-radius: 0px;border: none;margin-left: 0px !important;width: 100% !important;margin-bottom:7px !important;">
    	<div class="head" onclick="OpenBox('open_list1');">
            <span style="padding:0;margin: 7px 7px 7px 7px;">List your contracts</span>
            <span id="open_btn_open_list1" class="prem_open_btn">+</span>            
        </div>
	<div id="box_open_list1" class="content_box" style="height: auto;display:none">
	<table id="memberList" class="tablesorter ally_ranks gray_stripe_th">
        <thead>
            <tr>
                <th>Contract ID</th>
				<th>Player Nickname</th>
				<th>Player target</th>
				<th>Resources</th>
				<th>Start date</th>
				<th>Status</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
			<tr>
				<td colspan="7">You do not have a contract</td>
			</tr>
        </tbody>
    </table>
	</div>
	</div>
	</div>
	
	<div id="build_elements" class="officier_elements prem_shop">
	<div class="build_box" style="-moz-border-radius: 0px;-webkit-border-radius: 0px;border-radius: 0px;border: none;margin-left: 0px !important;width: 100% !important;margin-bottom:7px !important;">
    	<div class="head" onclick="OpenBox('open_list2');">
            <span style="padding:0;margin: 7px 7px 7px 7px;">Other players' contract</span>
            <span id="open_btn_open_list2" class="prem_open_btn">+</span>            
        </div>
	<div id="box_open_list2" class="content_box" style="height: auto;display:none">
	<table id="memberList" class="tablesorter ally_ranks gray_stripe_th">
        <thead>
            <tr>
                <th>Contract ID</th>
				<th>Player Nickname</th>
				<th>Player target</th>
				<th>Resources</th>
				<th>Request made on</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
			<tr>
				<td colspan="6">You have not received a contract request</td>
			</tr>
        </tbody>
    </table>
	</div>
	</div>
	</div>
	
	<div id="build_elements" class="officier_elements prem_shop">
	<div class="build_box" style="-moz-border-radius: 0px;-webkit-border-radius: 0px;border-radius: 0px;border: none;margin-left: 0px !important;width: 100% !important;margin-bottom:7px !important;">
    	<div class="head" onclick="OpenBox('open_list3');">
            <span style="padding:0;margin: 7px 7px 7px 7px;">Your contract request</span>
            <span id="open_btn_open_list3" class="prem_open_btn">+</span>            
        </div>
	<div id="box_open_list3" class="content_box" style="height: auto;display:none">
	<table id="memberList" class="tablesorter ally_ranks gray_stripe_th">
        <thead>
            <tr>
				<th>Contract ID</th>
				<th>Player Nickname</th>
				<th>Player target</th>
				<th>Resources</th>
				<th>Request made on</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
			<tr>
				<td colspan="6">You do not have a contract request in progress</td>
			</tr>
        </tbody>
    </table>
	</div>
	</div>
	</div>

 
    
</div>
</div>
</div>
<div class="clear"></div>            
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