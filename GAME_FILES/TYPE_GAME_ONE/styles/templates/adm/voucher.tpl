{include file="overall_header.tpl"}
<form method="post">
<input type="hidden" name="action" value="send">
<!-- Zielplaneten definieren -->
<table width="760px" style="color:#FFFFFF"><tr>
        <th colspan="3">Free allopass Code</th>
</tr>

<tr style="height:26px;"><td width="50%">Amount of codes:</td><td width="50%"><input type="text" name="element_amount" value="0" pattern="[0-9]*"></td></tr>
</table>


<!-- Rohstoffe -->
<table width="760px" style="color:#FFFFFF">
<tr>
        <th colspan="2">{$LNG.tech.900}</th>
</tr>
{foreach item=Element from=$reslist.resstype.1}
<tr><td width="50%">{$LNG.tech.{$Element}}:</td><td width="50%"><input type="text" name="element_{$Element}" value="0" pattern="[0-9]*"></td></tr>
{/foreach}
{foreach item=Element from=$reslist.resstype.3}
<tr><td width="50%">{$LNG.tech.{$Element}}:</td><td width="50%"><input type="text" name="element_{$Element}" value="0" pattern="[0-9]*"></td></tr>
{/foreach}
</table>


<table width="760px" style="color:#FFFFFF">
<tr>
        <td><input type="submit" value="{$LNG.qe_send}"></td>
</tr>
</table>
</form>
{include file="overall_footer.tpl"}