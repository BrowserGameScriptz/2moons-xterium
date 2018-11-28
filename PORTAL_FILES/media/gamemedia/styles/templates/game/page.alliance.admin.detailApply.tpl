{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner">
    <div class="gray_stripe">
		 {$al_request_from} {$apply_time}
        <a href="#" title="{$applyDetail.username}" onclick="return Dialog.Playercard({$applyDetail.userID}, '{$applyDetail.username}');" class="palanetarium_linck my_stats"></a>
		<span style="font-weight:bold;float:right;margin-right: 15px;">{$applyDetail.username}</span>
    </div>
    
    <div class="ally_contents">
        {$LNG.pl_name}: <span>{$applyDetail.username}</span><br/>
        {$LNG.pl_homeplanet}: <span>{$applyDetail.name} <a href="#" onclick="parent.location = 'game.php?page=galaxy&galaxy={$applyDetail.galaxy}&system={$applyDetail.system}';return false;">[{$applyDetail.coordinates}]</a></span><br/>
        {$LNG.al_request_register_time}: <span>{$register_time}</span><br/>
        {$LNG.al_request_last_onlinetime}: <span>{$onlinetime}</span><br/>
    </div>
        
    <div class="left_part">
        <div class="gray_stripe">
            {$LNG.pl_fightstats}
        </div>
        <div class="ally_contents">
            {$LNG.pl_fightwon}: <span>{$applyDetail.wons} ({$applyDetail.wons_percentage}%)</span><br/>
            {$LNG.pl_fightdraw}: <span>{$applyDetail.draws} ({$applyDetail.draws_percentage}%)</span><br/>
            {$LNG.pl_fightlose}: <span>{$applyDetail.loos} ({$applyDetail.loos_percentage}%)</span><br/>
            {$LNG.pl_totalfight}: <span>{$applyDetail.total_fights}</span><br/>
        </div>
    </div>
    
    <div class="right_part">
    	<table class="tablesorter ally_ranks playercard_tables">
            <tr>
                <th class="gray_stripe" colspan="2">{$LNG.lm_statistics} </th>
                <th class="gray_stripe">{$LNG.ov_points}</th>
                <th class="gray_stripe">{$LNG.st_position}</th>
            </tr>
            <tr>
                <td colspan="2">{$LNG.pl_tech}</td>
                <td colspan="1">{$applyDetail.tech_points|number}</td>
                <td colspan="1">{$applyDetail.tech_rank|number}</td>
            </tr>
           <tr>
                <td colspan="2">{$LNG.pl_builds}</td>
                <td colspan="1">{$applyDetail.build_points|number}</td>
                <td colspan="1">{$applyDetail.build_rank|number}</td>
            </tr>
             <tr>
                <td colspan="2">{$LNG.pl_def}</td>
                <td colspan="1">{$applyDetail.defs_points|number}</td>
                <td colspan="1">{$applyDetail.defs_rank|number}</td>
            </tr>
            <tr>
				<td colspan="2">{$LNG.pl_fleet}</td>
				<td colspan="1">{$applyDetail.fleet_points|number}</td>
				<td colspan="1">{$applyDetail.fleet_rank|number}</td>
			</tr>
	
            <tr>
                <td colspan="2">Достижения</td>
                <td colspan="1">0</td>
                <td colspan="1">446</td>
            </tr>
            <tr>
                <td colspan="2">Вооружение</td>
                <td colspan="1">0</td>
                <td colspan="1">0</td>
            </tr>
			<tr>
				<td colspan="2">{$LNG.pl_total}</td>
				<td colspan="1">{$applyDetail.total_points|number|number}</td>
				<td colspan="1">{$applyDetail.total_rank|number}</td>
			</tr>
         
        </table>
    </div>
    <div class="clear"></div>
		<div class="gray_stripe">
    	{$LNG.al_message}
    </div>
	<div class="ally_contents">
    	{$applyDetail.text}
    </div>
		<div class="gray_stripe">
		{$LNG.al_reply_to_request}
    </div>
    <form action="game.php?page=alliance&amp;mode=admin&amp;action=sendAnswerToApply&amp;id={$applyDetail.applyID}" method="post">
      	<textarea name="text" cols="40" rows="10" class="tinymce"></textarea> 
    
    <div class="clear"></div>
    
    <div class="build_band ticket_bottom_band">    	      
        <button class="bottom_band_submit_answer" type="submit" name="answer" value="yes">{$LNG.al_acept_request}</button> 
        <button class="bottom_band_submit_answer bottom_band_submit_no" type="submit" name="answer" value="no">{$LNG.al_decline_request}</button>    	
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
<script type="text/javascript" src="scripts/base/tinymce/tiny_mce_gzip.js"></script>
<script type="text/javascript">
$(function() {
	tinyMCE_GZ.init({
		plugins : 'bbcode,fullscreen',
		themes : 'advanced',
		languages : '{$lang}',
		disk_cache : true,
		debug : false
	}, function() {
		tinyMCE.init({
			script_url : 'scripts/base/tinymce/tiny_mce.js',
			theme : "advanced",
			mode : "textareas",
			plugins : "bbcode,fullscreen",
			theme_advanced_buttons1 : "bold,italic,underline,undo,redo,link,unlink,image,forecolor,removeformat,cleanup,code,fullscreen",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "center",
			theme_advanced_styles : "Code=codeStyle;Quote=quoteStyle",
			content_css : "{$dpath}formate.css",
			entity_encoding : "raw",
			add_unload_trigger : false,
			remove_linebreaks : false,
			fullscreen_new_window : false,
			fullscreen_settings : {
				theme_advanced_path_location : "top"
			}
		});
	});
});
</script>
{/block}