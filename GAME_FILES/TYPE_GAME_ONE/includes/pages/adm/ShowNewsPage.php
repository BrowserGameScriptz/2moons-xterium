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

if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))) throw new Exception("Permission error!");

function ShowNewsPage(){
	global $LNG, $USER;

	if($_GET['action'] == 'send') {
		$edit_id 	= HTTP::_GP('id', 0);
		$forum 	= HTTP::_GP('forum', '');
		$cat_id 	= HTTP::_GP('catId', 0);
		$topnews 	= HTTP::_GP('topnews', 0);
		$title_en 		= $GLOBALS['DATABASE']->sql_escape(HTTP::_GP('title_en', '', true));
		$title_de 		= $GLOBALS['DATABASE']->sql_escape(HTTP::_GP('title_de', '', true));
		$title_ru 		= $GLOBALS['DATABASE']->sql_escape(HTTP::_GP('title_ru', '', true));
		$text_en 		= $GLOBALS['DATABASE']->sql_escape(HTTP::_GP('text_en', '', true));
		$text_de 		= $GLOBALS['DATABASE']->sql_escape(HTTP::_GP('text_de', '', true));
		$text_ru 		= $GLOBALS['DATABASE']->sql_escape(HTTP::_GP('text_ru', '', true));
		$query		= ($_GET['mode'] == 2) ? "INSERT INTO ".NEWS." (`id` ,`user` ,`date` ,`title_en` ,`title_de` ,`title_ru` ,`text_en`,`text_de`,`text_ru`,`catId`,`forum_link`,`top_news`) VALUES ( NULL , '".$USER['username']."', '".TIMESTAMP."', '".$title_en."', '".$title_de."','".$title_ru."','".$text_en."', '".$text_de."','".$text_ru."','".$cat_id."', '".$forum."', '".$topnews."');" : "UPDATE ".NEWS." SET `title_en` = '".$title_en."', `title_de` = '".$title_de."', `title_ru` = '".$title_ru."',`text_en` = '".$text_en."',`text_de` = '".$text_de."',`text_ru` = '".$text_ru."', `date` = '".TIMESTAMP."', `catId` = '".$cat_id."', `top_news` = '".$topnews."', `forum_link` = '".$forum."' WHERE `id` = '".$edit_id."' LIMIT 1;";
		
		$GLOBALS['DATABASE']->query($query);
	} elseif($_GET['action'] == 'delete' && isset($_GET['id'])) {
		$GLOBALS['DATABASE']->query("DELETE FROM ".NEWS." WHERE `id` = '".HTTP::_GP('id', 0)."';");
	}

	$query = $GLOBALS['DATABASE']->query("SELECT * FROM ".NEWS." ORDER BY id ASC");

	while ($u = $GLOBALS['DATABASE']->fetch_array($query)) {
		$NewsList[]	= array(
			'id'		=> $u['id'],
			'catId'		=> $u['catId'],
			'top_news'		=> $u['top_news'],
			'title'		=> $u['title'],
			'date'		=> _date($LNG['php_tdformat'], $u['date'], $USER['timezone']),
			'user'		=> $u['user'],
			'forum_link'		=> $u['forum_link'],
			'confirm'	=> sprintf($LNG['nws_confirm'], $u['title']),
		);
	}
	
	$template	= new template();


	if($_GET['action'] == 'edit' && isset($_GET['id'])) {
		$News = $GLOBALS['DATABASE']->getFirstRow("SELECT id, title, top_news, text, catId, forum_link FROM ".NEWS." WHERE id = '".$GLOBALS['DATABASE']->sql_escape($_GET['id'])."';");
		$template->assign_vars(array(	
			'mode'			=> 1,
			'nws_head'		=> sprintf($LNG['nws_head_edit'], $News['title']),
			'news_id'		=> $News['id'],
			'news_title_en'	=> $News['title_en'],
			'news_title_de'	=> $News['title_de'],
			'news_title_ru'	=> $News['title_ru'],
			'top_news'	=> $News['top_news'],
			'news_text_en'		=> $News['text_en'],
			'news_text_de'		=> $News['text_de'],
			'news_text_ru'		=> $News['text_ru'],
			'catId'			=> $News['catId'],
			'forum_link'	=> $News['forum_link'],
		));
	} elseif($_GET['action'] == 'create') {
		$template->assign_vars(array(	
			'mode'			=> 2,
			'nws_head'		=> $LNG['nws_head_create'],
		));
	}
	
	$template->assign_vars(array(	
		'NewsList'		=> $NewsList,
		'button_submit'	=> $LNG['button_submit'],
		'nws_total'		=> sprintf($LNG['nws_total'], count($NewsList)),
		'nws_news'		=> $LNG['nws_news'],
		'nws_id'		=> $LNG['nws_id'],
		'nws_title'		=> $LNG['nws_title'],
		'nws_date'		=> $LNG['nws_date'],
		'nws_from'		=> $LNG['nws_from'],
		'nws_del'		=> $LNG['nws_del'],
		'nws_create'	=> $LNG['nws_create'],
		'nws_content'	=> $LNG['nws_content'],
	));
	
	$template->show('NewsPage.tpl');
}