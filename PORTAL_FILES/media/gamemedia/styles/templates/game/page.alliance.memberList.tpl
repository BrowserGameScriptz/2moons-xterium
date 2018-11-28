{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="margin-bottom:5px;">
    	{$al_users_list}
		<span style="float:right"><a href="game.php?page=alliance">{$LNG.al_back}</a></span>
    </div>
    <table id="memberList" class="tablesorter ally_ranks gray_stripe_th">
        <thead>
            <tr>
                <th style="border-left:0; padding-left:15px; text-align:left;">
                	<a href="game.php?page=alliance&amp;mode=memberList&amp;sort=name">{$LNG.al_member}</a>
                </th>
                <th></th>
                <th>
                	<a href="game.php?page=alliance&amp;mode=memberList&amp;sort=rank">{$LNG.al_position}</a>
                </th>
                <th>
                	<a href="game.php?page=alliance&amp;mode=memberList&amp;sort=points">{$LNG.al_points}</a>
                </th>
                <th>
					{$LNG.al_coords}
                </th>
                <th>
                	<a href="game.php?page=alliance&amp;mode=memberList&amp;sort=reg_time">{$LNG.al_member_since}</a>
                </th>
                <th>
                	<a href="game.php?page=alliance&amp;mode=memberList&amp;sort=online">{$LNG.al_estate}</a>
                </th>
            </tr>
        </thead>
        <tbody>
               
{foreach $memberList as $userID => $memberListRow}
			   <tr>
            <td style="text-align:left; padding-left:15px;"><a href="#" onclick="return Dialog.Playercard({$userID}, '{$memberListRow.username}');">{$memberListRow.username}</a></td>
            <td style="text-align:center;"><a href="#" onclick="return Dialog.PM({$userID});" class="batn_lincks mesages" style="height:15px; float:none; padding-left:15px; margin-left:5px;"></a></td>
            <td>{$memberListRow.rankName}</td>
            <td>{$memberListRow.points|number}</td>		
            <td><a href="game.php?page=galaxy&amp;galaxy={$memberListRow.galaxy}&amp;system={$memberListRow.system}" data-postion="{$memberListRow.galaxy}:{$memberListRow.system}:{$memberListRow.planet}">[{$memberListRow.galaxy}:{$memberListRow.system}:{$memberListRow.planet}]</a></td>
            <td>{$memberListRow.register_time}</td>
            <td>
                   {if $rights.ONLINESTATE}{if $memberListRow.onlinetime < 4}<span style="color:#009e4a">{$LNG.al_memberlist_on}</span>{elseif $memberListRow.onlinetime <= 15}<span style="color:#9e9100">{$memberListRow.onlinetime} {$LNG.al_memberlist_min}</span>{else}<span style="color:red">{$LNG.al_memberlist_off}</span>{/if}{else}-{/if}
	                                    </td>
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
