{block name="title" prepend}{$LNG.moonsim_1}{/block}
{block name="content"}
{if $step == 1}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="padding-right:0;">
    	{$LNG.moonsim_2}
        <input class="right_flank input_blue" onclick="window.location = '?page=battleSimulator';" value="{$LNG.moonsim_1}" type="button">
        <input class="right_flank input_blue" onclick="#;" style="border-radius:0;margin-right:10px;" value="Expedition Simulator" type="button">
		<input class="right_flank input_blue" style="border-radius:0;margin-right:10px;" onclick="window.location = '?page=battleSimulator&amp;mode=missilesim';" value="{$LNG.tech.500} {$LNG.lm_battlesim}" type="button">
    </div>
        <form id="form" method="post" onsubmit="return CheckArg();">
		<input name="modeSim" value="1" type="hidden">
        <table id="memberList" class="tablesorter ally_ranks">
			<tbody><tr>
            	<td><span style="color:red;">*</span>{$LNG.moonsim_3}:</td>
	            <td>
                	<input id="diameter" name="diameter" value="8000" type="text">
                	<a style="float:none;left:initial;top:initial;right:initial;bottom:initial;margin:-20px 0px 0 230px;" class="interrogation manual tooltip" data-tooltip-content="{$LNG.moonsim_4}">?</a>
                </td>
            </tr>
			<tr>
          	  <td>{$LNG.moonsim_5}:</td>
	            <td><input id="mondbasis" name="mondbasis" value="0" type="text"></td>
            </tr>
			<tr>
	            <td><span style="color:red;">*</span>{$LNG.moonsim_6}:</td>
	            <td><input id="stars" name="stars" value="5000" type="text"></td>
            </tr>
			<tr>
	            <td>{$LNG.moonsim_7}:</td>
	            <td><input id="prem" name="prem" value="1" type="text">
				<a style="float:none;left:initial;top:initial;right:initial;bottom:initial;margin:-20px 0px 0 230px;" class="interrogation manual tooltip" data-tooltip-content="{$LNG.moonsim_9}">?</a>
				</td>
            </tr>
			<tr>
	            <td colspan="2" id="submit" ><br><input value="{$LNG.moonsim_8}" style="width:100%;" type="submit"></td>
            </tr>
		</tbody></table>
	</form>
    
</div>
    </div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{else}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="padding-right:0;">
    	{$LNG.moonsim_2}
        <input class="right_flank input_blue" onclick="window.location = '?page=battleSimulator';" value="{$LNG.moonsim_1}" type="button">
    </div>
        	<div class="ally_contents">
        	{$LNG.moonsim_3}: {$diameter}<br>{$LNG.moonsim_10}: {$mondbasis}<br>{$LNG.moonsim_11}: {$stars}<br>{$LNG.moonsim_12}: 1<br>{$LNG.moonsim_13} {$moonDestroyChance}%, {$LNG.moonsim_14} {$fleetDestroyChance}%<br><br>{$LNG.moonsim_9}<br><br>
{$LNG.moonsim_4}
        </div><br>
		<div class="ref_system">
    	
        <a style="float:right" href="game.php?page=battleSimulator&amp;mode=MoonSim">{$LNG.al_back}</a>
    </div>
</div>


    </div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/if}
{/block}