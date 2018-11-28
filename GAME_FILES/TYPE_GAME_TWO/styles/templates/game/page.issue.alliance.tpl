{block name="title" prepend}{$LNG.allian_1}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
    	<a href="game.php?page=alliance&amp;mode=storage" style="color:#8e9394;">{$LNG.allian_1}</a>
        <img src="styles/images/arrow_right.png" alt="">
    	{$LNG.allian_10}
		
			<span style="float:right"><a href="game.php?page=alliance&amp;mode=storage">{$LNG.al_back}</a></span>
	</div>
    <form id="trader" action="game.php?page=alliance" method="post">
        <input name="mode" value="admin" type="hidden">
        <input name="action" value="issue_send" type="hidden">
        <select name="id_u" size="20" style="width:100%; height:100px; clear:both;">
            {$Userlist}
        </select>            
        <script type="text/javascript">
            var UserList = new filterlist(document.getElementsByName('id_u')[0]);
        </script>
        <input name="regexp" style="width:550px;" onkeyup="UserList.set(this.value)">
        <input onclick="UserList.set(this.form.regexp.value)" value="{$LNG.allian_9}" type="button">
        <input onclick="UserList.reset();this.form.regexp.value=''" value="{$LNG.nt_reset}" type="button">
        <div class="clear" style="margin-bottom:5px;"></div>
        <table class="tablesorter ally_ranks gray_stripe_th td_border_bottom">
        <tbody><tr>
            <th style="border-left:0;"></th>
            <th><span id="ress">0</span></th>
            <th>{$LNG.top_avaibel}</th>
        </tr>
        <tr>
            <td style="text-align:left; padding-left:15px;"><label for="resource901" style="color:#a47d7a;">{$LNG.tech.901}</label></td>
            <td><input name="resource901" style="color:#a47d7a; width:98%;" id="resource901" class="trade_input" value="0" size="30" type="text"></td>
            <td><label for="resource901" style="color:#a47d7a;" class="tooltip" data-tooltip-content="{$alliance_storage_metal|number}">{$alliance_storage_metal|number}&nbsp;</label></td>
        </tr>
        <tr>
            <td style="text-align:left; padding-left:15px;"><label for="resource902" style="color:#5ca6aa;">{$LNG.tech.902}</label></td>
            <td><input name="resource902" style="color:#5ca6aa; width:98%;" id="resource902" class="trade_input" value="0" size="30" type="text"></td>
            <td><label for="resource901" style="color:#5ca6aa;" class="tooltip" data-tooltip-content="{$alliance_storage_crystal|number}">{$alliance_storage_crystal|number}&nbsp;</label></td>
        </tr>
        <tr>
            <td style="text-align:left; padding-left:15px;"><label for="resource903" style="color:#339966;">{$LNG.tech.903}</label></td>
            <td><input name="resource903" style="color:#339966; width:98%;" id="resource903" class="trade_input" value="0" size="30" type="text"></td>
            <td><label for="resource901" style="color:#339966;" class="tooltip" data-tooltip-content="{$alliance_storage_deuterium|number}">{$alliance_storage_deuterium|number}&nbsp;</label></td>
        </tr>
        </tbody></table>
        <div class="ally_contents" style="padding:10px;">
            <div class="btn_border right_flank">
                <input value="ОК" type="submit">
            </div>
            <div class="clear"></div>        
        </div>
    </form>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script" append}
<script type="text/javascript">
var ress1charge = 1;
var ress2charge = 1;
var ress3charge = 1;
</script>
{/block}
