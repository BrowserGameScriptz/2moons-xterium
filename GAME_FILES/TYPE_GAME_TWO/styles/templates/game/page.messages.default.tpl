{block name="title" prepend}{$LNG.lm_messages}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe" style="border-bottom:0;">
    	{$LNG.mg_message_title}<span id="loading" style="display:none;"> {$LNG.sh_loading}</span>
    </div>
    <table class="tablesorter ally_ranks">
                   
{foreach $CategoryList as $CategoryID => $CategoryRow}
{if ($CategoryRow@iteration % 6) === 1}<tr>{/if}
				<td style="word-wrap: break-word;color:{$CategoryRow.color};">
        	<a href="#" id="mes_{$CategoryID}" onclick="Message.getMessages({$CategoryID});return false;" style="color:{$CategoryRow.color};">
            	{$LNG.mg_type.{$CategoryID}}
        		<br><span id="unread_{$CategoryID}">{$CategoryRow.unread}</span>/<span id="total_{$CategoryID}">{$CategoryRow.total}</span>
            </a>
        </td>
{if $CategoryRow@last || ($CategoryRow@iteration % 6) === 0}</tr>{/if}
     {/foreach}
                </table>
</div>
</div>
</div>
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}
{block name="script" append}
{if !empty($category)}
<script>$(function() {
	Message.getMessages({$category}, {$side});
})</script>
{/if}
{/block}