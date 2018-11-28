{block name="title" prepend}{$LNG.user_atm_1}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:600px;">
	<div class="gray_stripe" style="margin-bottom:5px;">
    	{$LNG.user_atm_1}
        (<span list="general" class="spending_span spending_active">{$LNG.user_atm_2}</span> | 
        <span list="planets" class="spending_span">{$LNG.user_atm_3}</span> | 
        <span list="upgrades" class="spending_span">{$LNG.user_atm_4}</span>)
	</div>
    <table style="display: block;" id="general" class="tablesorter ally_ranks gray_stripe_th td_border_bottom spending_table">
    <thead>
		<tr>
			<th style="border-left:0;width:200px;">{$LNG.user_atm_5}</th>
			<th style="width:170px;">{$LNG.user_atm_6}</th>
			<th style="width:192px;">{$LNG.user_atm_7}</th>
		</tr>
	</thead>
    <tbody>
	{foreach $usedAtms as $ID => $used}
    	       <tr>
        	<td>{$used.time}</td>
            <td>{$used.direction}</td>
            <td>{$used.am_used|number}</td>
        </tr>
		{foreachelse}
    	        <tr>
        	<td colspan="3" style="text-align:center;">{$LNG.user_atm_8}</td>
        </tr>
		{/foreach}
            </tbody>
    </table>
    <table id="planets" class="tablesorter ally_ranks gray_stripe_th td_border_bottom spending_table" style="display: none;">
    <thead>
		<tr>
			<th style="border-left:0;width:288px;">{$LNG.user_atm_5}</th>
			<th style="width:287px;">{$LNG.user_atm_7}</th>
		</tr>
	</thead>
    <tbody>
{foreach $usedPla as $ID => $used}
    	       <tr>
        	<td>{$used.time}</td>
            <td>{$used.am_used|number}</td>
        </tr>
		{foreachelse}
    	        <tr>
        	<td colspan="3" style="text-align:center;">{$LNG.user_atm_8}</td>
        </tr>
		{/foreach}
            </tbody>
    </table>
    <table id="upgrades" class="tablesorter ally_ranks gray_stripe_th td_border_bottom spending_table" style="display: none;">
    <thead>
		<tr>
			<th style="border-left:0;width:288px;">{$LNG.user_atm_5}</th>
			<th style="width:287px;">{$LNG.user_atm_7}</th>
		</tr>
	</thead>
    <tbody>
    	       {foreach $usedUp as $ID => $used}
    	       <tr>
        	<td>{$used.time}</td>
            <td>{$used.am_used|number}</td>
        </tr>
		{foreachelse}
    	        <tr>
        	<td colspan="3" style="text-align:center;">{$LNG.user_atm_8}</td>
        </tr>
		{/foreach}
            </tbody>
    </table>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script" append}

{/block}