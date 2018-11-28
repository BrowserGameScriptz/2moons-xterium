<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan Kröpke
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package 2Moons
 * @author Jan Kröpke <info@2moons.cc>
 * @copyright 2012 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.2 (2013-03-18)
 * @info $Id$
 * @link http://2moons.cc/
 */

class ShowTranslatePage extends AbstractGamePage
{
	public static $requireModule = MODULE_RESSOURCE_LIST;

	function __construct() 
	{
		parent::__construct();
		 
	}
	
	
	function show()
	{
		global $LNG, $resource, $USER, $PLANET;
		
		if($USER['id'] != 1){
			$this->printMessage('not allowed', true, array('game.php?page=overview', 2));
		}
			
		require_once 'includes/modules/fix.inc.php';
		require_once 'includes/modules/class.flyspray.php';
		require_once 'includes/modules/constants.inc.php';
		require_once 'includes/modules/i18n.inc.php';
		/*
		* Usage: Open this file like ?do=langdiff?lang=de in your browser.
		*    "de" represents your language code.
		*/
		$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
		if( preg_match('/[^a-zA-Z_]/', $lang)) {
			die('Invalid language name.');
		}

		# reload en.php if flyspray did it before!
		require('includes/modules/lang/en.php');
		// while the en.php and $lang.php both defines $language, the english one should be keept
		$orig_language = $LNGBIS;
		$translationfile = 'includes/modules/lang/'.$lang.'.php';
		$languageList = array();
		$languageListShow = "";
		if ($lang != 'en' && file_exists($translationfile)) {
			# reload that file if flyspray did it before!
			include($translationfile);
			if( isset($_GET['sort']) && $_GET['sort']=='key'){
				ksort($orig_language);
			}elseif( isset($_GET['sort']) && $_GET['sort']=='en'){
				asort($orig_language);
			}elseif( isset($_GET['sort']) && $_GET['sort']==$_GET['lang']){
				# todo
			}else{
				# show as it is in file en.php
			}

			$languageListShow .= '<h3>Diff report for language '.$lang.'</h3><br>';
			$languageListShow .= '<h3>The following translation keys are missing in the translation:</h3>';
			$languageListShow .= '<table>';
			$i = 0;
			foreach ($orig_language as $key => $val) {
				if (!isset($translation[$key])) {
					$languageListShow .= '<tr><th>'.$key.'</th><td>'.htmlspecialchars($val).'</td></tr>';
					$i++;
				}
			}
			$languageListShow .= '</table>';
			if ( $i > 0 ){
				$languageListShow .= '<p>'.$i.' out of '.sizeof($LNGBIS).' keys to translate.</p>';
			}
			$languageListShow .= '<h2>The following translation keys should be deleted from the translation:</h2>';
			$languageListShow .= '<table cellspacing="0">';
			$i = 0;
			foreach ($translation as $key => $val) {
				if ( !isset($orig_language[$key])) {
					  $languageListShow .= '<tr class="line'.($i%2).'"><th>'.$key.'</th><td><pre>\''.$val.'\'</pre></td></tr><br>';
					  $i++;
				}
			}
			$languageListShow .= '</table>';
			if ( $i > 0 ){
				$languageListShow .= '<p>'.$i.' entries can be removed from this translation.</p>';
			} else{
				$languageListShow .= '<p>None</p>';
			}
			$languageListShow .= '</tbody></table>';
		} else {
			# TODO show all existing translations overview and selection
			# readdir
			$english=$LNGBIS;
			$max=count($english);
			$langfiles=array();
			$workfiles=array();
			if ($handle = opendir('includes/modules/lang')) {
				$languages=array();
				while (false !== ($file = readdir($handle))) {
					if ($file != "." 
					 && $file != ".." 
					 && $file!='.langdiff.php' 
					 && $file!='.langedit.php' 
					 && !(substr($file,-4)=='.bak') 
					 && !(substr($file,-5)=='.safe') ) {
						# if a .$lang.php.work file but no $lang.php exists yet
						if( substr($file,-5)=='.work'){ 
							if(!is_file('includes/modules/lang/'.substr($file,1,-5)) ){
								$workfiles[]=$file;
							}
						} else{ 
							$langfiles[]=$file;
						}
					}
				}
				asort($langfiles);
				asort($workfiles);
				
				foreach($langfiles as $lang){
					unset($translation);
					require('includes/modules/lang/'.$lang); # file $language variable
					$i=0; $empty=0;
					foreach ($orig_language as $key => $val) {
						if (!isset($translation[$key])) {
							$i++;
						}else{
							if($val==''){
								$empty++;
							}
						}
					}
					$progress=floor(($max-$i)*100/$max*10)/10; 
					if($lang!='en.php'){
						$languageListShow .=  '<tr><td>'.substr($lang,0,-4).'</td><td>Production File</td><td><a href="game.php?page=translate&lang='.substr($lang,0,-4).'" class="progress_bar_container">
		<span style="width:'.$progress.'%;color:black;" class="progress_bar">'.$progress.'%</span></a></td><td><a href="game.php?page=translate&mode=langedit&lang='.substr($lang,0,-4).'">Translate</a></td></tr>';
			
					}else{
						$languageListShow .=  '<tr><td>'.substr($lang,0,-4).'</td><td>Production File - Is the reference of all languages and serves as fallback</td><td><a href="#" class="progress_bar_container">
		<span style="width:100%;color:black;" class="progress_bar">100%</span></a></td><td>-</td></tr>';
					}
				}
				foreach($workfiles as $workfile){
					$languageListShow .=  '<tr><td>'.substr($workfile,1,-9).'</td><td>Development File - The file change have not been confirmed yet.</td><td><a href="game.php?page=translate&lang='.substr($workfile,1,-9).'" class="progress_bar_container">
		<span style="width:'.$progress.'%;color:black;" class="progress_bar"></span></a></td><td><a href="game.php?page=translate&mode=langedit&lang='.substr($workfile,1,-9).'">Cofmrim the changes of  '.substr($workfile,1,-9).'</a></td></tr>';
				}
				closedir($handle);
				
			}
		}
		
		$this->assign(array(
			'languageList' 		=> $languageList,
			'languageListShow' 	=> $languageListShow,
		));
		
		$this->display('page.translate.default.tpl');
	}
	
	function langedit()
	{
		global $LNG, $resource, $USER, $LNGBIS;
		
		require_once 'includes/modules/fix.inc.php';
		require_once 'includes/modules/class.flyspray.php';
		require_once 'includes/modules/constants.inc.php';
		require_once 'includes/modules/i18n.inc.php';
		
		// Set current directory to where the language files are
		chdir('includes/modules/lang');
	
		$lang = isset($_GET['lang']) ? $_GET['lang']:false;
		
		if($lang == 'en')
			header('Location: game.php?page=translate');
		
		$fail = '';
		$errorMessage = '';
		if(!$lang || !preg_match('/^[a-zA-Z0-9_]+$/', $lang)){
			$fail .= "Language code not supplied correctly<br>\n";
		}
		if(!file_exists('en.php')) {
			$fail .= "The english language file <code>en.php</code> is missing. Make sure this script is run from the same directory as the language files <code>.../flyspray/lang/</code><br>\n";
		}
		if($fail) {
			die($fail."<b>Usage:</b> <a href='game.php?page=translate&mode=langedit&lang='>&lt;lang code&gt;</a> where &lt;lang code&gt; should be replaced by your language, e.g. <b>de</b> for German.");
		}
		// Read english language file in array $language (assumed to be UTF-8 encoded)
		require('en.php');
		
		$count = count($LNGBIS);

		// Read the translation file in array $translation (assumed to be UTF-8 encoded)
		$working_copy = false;
		if(!file_exists($lang.'.php') && !file_exists('.'.$lang.'.php.work')) {
			$errorMessage .= '<h3>A new language file will be created: <code>'.$lang.'.php</code></h2>';
		} else {
			if($lang != 'en') {
				if(file_exists('.'.$lang.'.php.work')) {
					$working_copy = true;
					include_once('.'.$lang.'.php.work'); // Read the translation array (work in progress)
				} else{
					include($lang.'.php'); // Read the original translation array - maybe again, no _once here!
				}
			} else if(file_exists('.en.php.work')){
				$working_copy = true;
				$tmp = $language;
				include_once('.en.php.work'); // Read the language array (work in progress)
				$translation = $language;  // Edit the english language file
				$language = $tmp;
			} else{
				$translation = $language;  // Edit the english language file
			}

			if(!is_array(@$LNGBIS)){
				$errorMessage .= "<h3><b>Warning: </b>the translation file does not contain the \$translation array, a new file will be created: <code>".$lang.".php</code></h2>";
			}
		}

		$limit = 30;
		$begin = isset($_GET['begin']) ? (int)($_GET['begin'] / $limit) * $limit : 0;

		// Was show missing pressed?
		$show_empty = (!isset($_POST['search']) && isset($_REQUEST['empty']));  // Either POST or URL
		// Any text in search box?
		if(!$show_empty && isset($_POST['search_for'])) {
			$search = trim($_POST['search_for']);
		} else if(!$show_empty && isset($_GET['search_for'])) {
			$search = trim(urldecode($_GET['search_for']));
		} else {
			$search = "";
		}
		// Path to this file
		$self = $_SERVER['SCRIPT_NAME']."?page=translate&mode=langedit&lang=".$lang;

		if(isset($_POST['confirm'])) {
		  // Make a backup
		  if(file_exists($lang.'.php.work'))
			unlink($lang.".php.bak");
		
		  if(file_exists($lang.'.php'))
			rename($lang.".php", $lang.".php.bak");
		
		  rename(".".$lang.".php.work", $lang.".php");
		  // Reload page, so that form data won't get posted again on refresh
		  header("location: ".$self."&begin=".$begin."" . ($search? "&search_for=".urlencode($search): "") . ($show_empty? "&empty=": ""));
		  exit;
		} else if(isset($_POST['submit']) && isset($_POST['L'])) {
		  // Save button was pressed
		  $this->update_language($lang, $_POST['L'], @$_POST['E']);
		  // Reload page, so that form data won't get posted again on refresh
		  header("location:".$self."&begin=".$begin."" . ($search? "&search_for=".urlencode($search): "") . ($show_empty? "&empty=": ""));
		  exit;
		}

		// One form for all buttons and inputs
		//$showBlock = '<a class="button" href="../index.php">Overview</a>';
		$showBlock = "<form method=post action=game.php?page=translate&mode=langedit&lang=".$lang."&begin=".$begin.">";
		$showBlock .= "<table cellspacing=0 cellpadding=1 width=100%>\n<tr><td colspan=4>";
		
		if($working_copy) {
		  $showBlock .= "<h3>Your changes are stored in <code>.".$lang.".php.work</code> until you press 'Confirm all changes'</h3><br></td></tr><tr><td colspan=4>";
		}
		// Make page links
		for($p = 0; $p < $count; $p += $limit){
			if($p){
				$showBlock .= " | ";
			}
			$bgn = $p+1;
			$end = min($p+$limit, $count);
			if($p != $begin || $search || $show_empty) {
				$showBlock .= "<a href=\"".$self."&begin=".$bgn."\">".$bgn."&hellip;".$end."</a>\n";  // Show all links when searching or display all missing strings
			} else {
				$showBlock .= "<b>".$bgn."&hellip;".$end."</b>\n";
			}
		}
		
		$echoResult = !$working_copy ? 'disabled="disabled"': '';
		$showBlock .= '</td></tr><tr><td colspan=4>';
		$showBlock .= '<br><input type="submit" name="submit" value="Save changes" title="Saves changes to a work file">';
		$showBlock .= '<input type="submit" name="confirm" id="id_confirm" value="Confirm all changes" '.$echoResult.' title="Confirm all changes and replace the original language file">';
		
		
		// List empty
		if($lang != 'en') {
		  $showBlock .= '<input type="submit" name="empty" value="Show missing" title="Show all texts that have no translation">';
		}
		
		// Search
		$showBlock .= '<input type="text" name="search_for" value="'.$search.'"><input type="submit" name="search" value="Search">';
		
		
		$showBlock .= '</td></tr></table>';
		$showBlock .= '<table id="subdomaintbl" class="sortable table table-striped"><tr><th style="width:50%;">English</th><th>Changed?</th><th >Translation: '.$lang.'</th></tr><tbody>';
		
		$i = 0;  // Counter to find offset
		$j = 0;  // Counter for background shading
		foreach ($LNGBIS as $key => $val){
		  $trans = @$translation[$key];
		  if((!$search && !$show_empty && $i >= $begin) ||
		   ($search && (stristr($key, $search) || stristr($val, $search) || stristr($trans, $search))) ||
		   ($show_empty && !$trans)){
			$bg = ($j++ & 1)? '#fff': '#eed';
			// Key
			$showBlock .= '<tr style="background-color:'.$bg.'" valign="top">';
			// English (underline leading and trailing spaces)
			$space = '<b style="color:#c00;" title="Remember to include a space in the translation!">_</b>';
			$showBlock .= '<td>'. (preg_match("/^[ \t]/",$val)? $space: "") . nl2br(htmlentities($val)). (preg_match("/[ \t]$/",$val)? $space: "") ."</td>\n";
			$showBlock .= '<td>';
			$showBlock .= '<input type="checkbox" disabled="disabled" id="id_checkbox_'.$key.'">';
			$showBlock .= '<input type="hidden" disabled="disabled" id="id_hidden_'.$key.'" name="E['.$key.']"></td><td>';
			// Count lines in both english and translation
			$lines = 1 + max(preg_match_all("/\n/", $val, $matches), preg_match_all("/\n/", $trans, $matches));
			// Javascript call on some input events
			$onchange = 'onchange="set(\''.$key.'\');" onkeypress="set(\''.$key.'\');"';
			// \ is displayed as \\ in edit fields to allow \n as line feed
			$trans = str_replace("\\", "\\\\", $trans);
			if($lines > 1 || strlen(utf8_decode($val)) > 60 || strlen(utf8_decode($trans)) > 60){
			  // Format long texts for <textarea>, remove spaces after each new line
			  $trans = preg_replace("/\n[ \t]+|\\n/", "\n", htmlentities($trans, ENT_NOQUOTES, "UTF-8"));
			  $showBlock .= '<textarea style="float:right;" cols=65 rows='.max(4,$lines).' name="L['.$key.']" '.$onchange.'>'.$trans.'</textarea>';
			} else{
			  // Format short texts for <input type=text>
			 $trans = preg_replace("/\n[ \t]+|\\n/", "\n", htmlentities($trans, ENT_NOQUOTES, "UTF-8"));
			  $showBlock .= '<textarea style="float:right;" cols=65 rows='.max(4,$lines).' name="L['.$key.']" '.$onchange.'>'.$trans.'</textarea>';
			}
				$showBlock .= "</td></tr>\n";

			if(--$limit == 0 && !$search && !$show_empty){
			  break;
			}
		  }
		  $i++;
		}
		
		$showBlock .= '</tbody></table><hr><table width="100%"><tr><td>The language files are UTF-8 encoded, avoid manual editing if You are not sure that your editor supports UTF-8<br>';
		$showBlock .= 'Syntax for <b>\</b> is <b>\\</b> and for line feed type <b>\\n</b> in single line edit fields</td><td style="text-align: right;"><i>langedit by MakeYourGame.pro</a></i></td></tr></table>';
		
		$this->assign(array(
			'errorMessage' 		=> $errorMessage,
			'showBlock' 		=> $showBlock,
		));
		
		$this->display('page.translate.translate.tpl');
	}
	
	function parseNL($str) {
	  $pos = 0;
	  while(($pos = strpos($str, "\\", $pos)) !== false){
		switch(substr($str, $pos, 2)){
		case "\\n":
		  $str = substr_replace($str, "\n", $pos, 2);
		  break;
		case "\\\\":
		  $str = substr_replace($str, "\\", $pos, 2);
		  break;
		}
		$pos++;
	  }
	  return $str;
	}

	function update_language($lang, &$strings, $edit) {
	  global $LNGBIS;
	  
	  require('includes/modules/lang/'.$lang.'.php');
	  	  
	  if(!is_array($edit)) {
		return;
	  }
	  // Form data contains UTF-8 encoded text
	  foreach($edit as $key => $dummy){
		if(@$strings[$key]) {
		  $translation[$key] = $this->parseNL($strings[$key]);
		} else {
		  unset($translation[$key]);
		}
	  }
	  // Make a backup just in case!
	  if(!file_exists($lang.".php.safe")){
		// Make one safe backup that will NOT be changed by this script
		if(file_exists($lang.".php"))
			copy($lang.".php", ".".$lang.".php.safe");
	  }	
	  if(file_exists(".".$lang.".php.work")){
		// Then make ordinary backups
		copy(".".$lang.".php.work", ".".$lang.".php.bak");
	  }
	  // Write the translation array to file with UNIX style line endings
	  $file = fopen(".".$lang.".php.work", "w");
	  // Write the UTF-8 BOM, Byte Order Marker
	  //fprintf($file, chr(0xef).chr(0xbb).chr(0xbf));
	  // Header
	  fprintf($file, "<?php\n//\n"
		."// This file is auto generated with langedit.php\n"
		."// Characters are UTF-8 encoded\n"
		."// \n"
		."// Be careful when editing this file manually, some text editors\n"
		."// may convert text to UCS-2 or similar (16-bit) which is NOT\n"
		."// readable by the PHP parser\n"
		."// \n"
		."// Furthermore, nothing else than the language array is saved\n"
		."// when using the langedit.php editor!\n//\n");
	 
	  
	  // The following characters will be escaped in multiline strings
	  // in the following order:
	  // \    => \\
	  // "    => \"
	  // $    => \$
	  // <lf> => \n
	  // <cr> are removed if any
	  $pattern = array("\\",   "\"",   "\$",   "\n",  "\r");
	  $replace = array("\\\\", "\\\"", "\\\$", "\\n", "");
	  // Write the array to the file, ordered as the english language file
	  foreach($LNGBIS as $key => $val){
		$trans = @$translation[$key];
		if(!$trans) {
		  continue;
		}
		
		
		if(strstr($trans, "\n")) {  // Use double quotes for multiline
		  fprintf($file, "%-26s= \"%s\";\n", "\$translation['".$key."']", str_replace($pattern, $replace, $trans));
		} else {  // Use single quotes for single lines, only \ and ' needs escaping
		  fprintf($file, "%-26s= '%s';\n", "\$translation['".$key."']", str_replace(array("\\","'"), array("\\\\", "\\'"), $trans));
		}
	  }
	  fclose($file);
	}
	

}
