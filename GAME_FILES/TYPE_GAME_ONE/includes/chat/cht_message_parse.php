<?php
function cht_message_parse($msg)
{
	global $LNG;

	$BBCodes = array (
		"^\[c=(\#)([0-9a-f]{6})\](.+)\[/c\]$" => "<font color=\"$1$2\">$3</font>",
		"^\[c=(.+)\](.+)\[/c\]$" => "<font color=\"#ffffff\">$2</font>",
		"\[b\](.+)\[/b\]" => "<b>$1</b>", "\[i\](.+)\[/i\]" => "<i>$1</i>", "\[u\](.+)\[/u\]" => "<u>$1</u>",
		//"\[img\=(ftps?://|https?://)(.+)\]" => "<img src=\"$1$2\" target=\"_blank\" style=\"max-height:100px\"/>",
		"^<font color=\"(.+)\">(https?://xterium.space/CombatReport.php?)(.+)([0-9a-fA-F]{32})(.+)(uni=)(.+)</font>$" => "<a href=\"$2$3$4$5$6$7$8$9\" target=\"_blank\"><span class=\"battle_report_link\"><u>".$LNG['chat_msg_53']." (№$9)</u></span></a>",
		"^<font color=\"(.+)\">(https?://forum.xterium.space/)(.+)(/)(.+)(/?)</font>$" => "<a href=\"$2$3$4$5\" target=\"_blank\"><span class=\"battle_report_link\"><u>".$LNG['chat_msg_52']." ($3: $5)</u></span></a>",
		"^<font color=\"(.+)\">(ftps?://|https?://)(.+)</font>$" => "<a href=\"$2$3\" target=\"_blank\"><span class=\"battle_report_link\"><u>".$LNG['chat_msg_53']."</u></span></a>",
	);

	$smiles = array (
		// Старые смайлы
		':hello:'			=> 'chat_smiley_hello',
		
		':smile'			=> 'chat_smiley_smile',
		':\)'				=> 'chat_smiley_smile',
		
		':sad'				=> 'chat_smiley_sad',
		'\:\('				=> 'chat_smiley_sad',
		
		';\)'				=> 'chat_smiley_wink', 
		':wink:'			=> 'chat_smiley_wink',
		
		':huh:'				=> 'chat_smiley_huh',
		':D:'				=> 'chat_smiley_lol',
		':good:'			=> 'chat_smiley_good',
		':blush:'			=> 'chat_smiley_blush',
		':blink:'			=> 'chat_smiley_blink',
		':unknw:'			=> 'chat_smiley_unknw',
		':yu'				=> 'chat_smiley_yu',
		':dance:'			=> 'chat_smiley_dance',
		':yahoo:'			=> 'chat_smiley_yahoo',
		':fool:'			=> 'chat_smiley_fool',
		':eye'				=> 'chat_smiley_blackeye',
		':cool:'			=> 'chat_smiley_cool',
		':c:'				=> 'chat_smiley_cray',
		':bad:'				=> 'chat_smiley_bad',
		':shok:'			=> 'chat_smiley_shok', 
		':crz:'				=> 'chat_smiley_crazy',
		':diablo:'			=> 'chat_smiley_diablo',
		':cowboy:'			=> 'chat_smiley_cowboy',
		':angel:'			=> 'chat_smiley_angel',
		':sm:'				=> 'chat_smiley_sm',
		':shooting:'		=> 'chat_smiley_shooting',
		':fr'				=> 'chat_smiley_friends',
		':dr'				=> 'chat_smiley_drinks',
		':ypunish:'			=> 'chat_smiley_punish',
		':1:'				=> 'chat_smiley_1',

		// Новые смайлы
		':aa:'				=> 'chat_smiley_aa',
		':angry:'			=> 'chat_smiley_angry',
		':benzo:'			=> 'chat_smiley_benzo',
		':bye:'				=> 'chat_smiley_bye',
		':crazy_pilot:'		=> 'chat_smiley_crazy_pilot',
		':dash:'			=> 'chat_smiley_dash',
		':gamer:'			=> 'chat_smiley_gamer',
		':girl_devil:'		=> 'chat_smiley_girl_devil',
		':girl_hospital:'	=> 'chat_smiley_girl_hospital',
		':give_rose:'		=> 'chat_smiley_give_rose',
		':gun_bandana:'		=> 'chat_smiley_gun_bandana',
		':locomotive:'		=> 'chat_smiley_locomotive',
		':mad:'				=> 'chat_smiley_mad',
		':mamba:'			=> 'chat_smiley_mamba',
		':music:'			=> 'chat_smiley_music',
		':nea:'				=> 'chat_smiley_nea',
		':nou:'				=> 'chat_smiley_nou',
		':ok:'				=> 'chat_smiley_ok',
		':on_the_quiet:'	=> 'chat_smiley_on_the_quiet',
		':pocel:'			=> 'chat_smiley_pocel',
		':polu:'			=> 'chat_smiley_polu',
		':prankster:'		=> 'chat_smiley_prankster',
		':sarcastic:'		=> 'chat_smiley_sarcastic',
		':scenic:'			=> 'chat_smiley_scenic',
		':us:'				=> 'chat_smiley_us',
		':wacko:'			=> 'chat_smiley_wacko',
		':zzz:'				=> 'chat_smiley_zzz',
		':tomato:'			=> 'chat_smiley_tomato',
		':shok2:'			=> 'chat_smiley_shok2',
	);

	$actionsA = array (
		// Старые смайлы
		'/red'			=> 'red',
	);

	
	foreach ($BBCodes as $key => $html)
		$msg = preg_replace("#".$key."#isU", $html, $msg);

	foreach ($smiles as $key => $imgName)
		$msg = preg_replace("#" . $key . "#isU","<img src=\"styles/images/smiles/".$imgName.".gif\" align=\"absmiddle\" title=\"".$LNG[$imgName]."\" alt=\"".$LNG[$imgName]."\">",$msg);

	$msg = str_replace("\r\n", '<br />', $msg);

	return $msg;
}

?>
