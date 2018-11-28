{include file="overall_header.tpl"}
{nocache}{if isset($mode)}
<form method="POST" action="?page=news&amp;action=send&amp;mode={$mode}">
{if $news_id}<input name="id" type="hidden" value="{$news_id}">{/if}
<table>
<tr>
	<th colspan="2">{$nws_head}</th>
</tr>
<tr>
<tr>
	<td>Top news</td><td><input type="checkbox" name="topnews" value ="1"></td>
</tr>
<tr>
	<td>Catergory</td><td><select name="catId"><option value="1">General</option><option value="2">Contest</option><option value="3">Updates</option></select></td>
</tr>
<tr>
	<td width="25%">{$nws_title}</td><td><input type="text" name="title_en" value="{$news_title_en}"></td>
</tr>
<tr>
	<td width="25%">{$nws_title}</td><td><input type="text" name="title_de" value="{$news_title_de}"></td>
</tr>
<tr>
	<td width="25%">{$nws_title}</td><td><input type="text" name="title_ru" value="{$news_title_ru}"></td>
</tr>
<tr>
	<td>{$nws_content}</td><td><textarea cols="70" rows="10" name="text_en">{$news_text_en}</textarea></td>
</tr>
<tr>
	<td>{$nws_content}</td><td><textarea cols="70" rows="10" name="text_de">{$news_text_de}</textarea></td>
</tr>
<tr>
	<td>{$nws_content}</td><td><textarea cols="70" rows="10" name="text_ru">{$news_text_ru}</textarea></td>
</tr>
<tr>
	<td width="25%">Forum link</td><td><input type="text" name="forum" value="{$forum_link}"></td>
</tr>
<tr>
	<td colspan="2"><input type="submit" name="Submit" value="{$button_submit}"></td>
</tr>
</table>
</form>
{/if}{/nocache}
<table width="450">
<tr>
	<th colspan="7">{$nws_news}</thd>
</tr>
<tr>
	<td>Category Id</td>
	<td>{$nws_id}</td>
	<td>{$nws_title}</td>
	<td>{$nws_date}</td>
	<td>{$nws_from}</td>
	<td>Forum link</td>
	<td>{$nws_del}</td>
</tr>
{foreach name=NewsList item=NewsRow from=$NewsList}<tr>
<td><a href="?page=news&amp;action=edit&amp;id={$NewsRow.id}">{$NewsRow.catId}</a></td>
<td><a href="?page=news&amp;action=edit&amp;id={$NewsRow.id}">{$NewsRow.id}</a></td>
<td><a href="?page=news&amp;action=edit&amp;id={$NewsRow.id}">{$NewsRow.title}</a></td>
<td><a href="?page=news&amp;action=edit&amp;id={$NewsRow.id}">{$NewsRow.date}</a></td>
<td><a href="?page=news&amp;action=edit&amp;id={$NewsRow.id}">{$NewsRow.user}</a></td>
<td><a href="?page=news&amp;action=edit&amp;id={$NewsRow.id}">{$NewsRow.forum_link}</a></td>
<td><a href="?page=news&amp;action=delete&amp;id={$NewsRow.id}" onclick="return confirm('{$NewsRow.confirm}');"><img border="0" src="./styles/resource/images/alliance/CLOSE.png" width="16" height="16"></a></td>
</tr>
{/foreach}
<tr><td colspan="7"><a href="?page=news&amp;action=create">{$nws_create}</a></td></tr>
<tr><td colspan="7">{$nws_total}</td></tr>
</table>
{include file="overall_footer.tpl"}