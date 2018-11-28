<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan
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
 * @author Jan <info@2moons.cc>
 * @copyright 2006 Perberos <ugamela@perberos.com.ar> (UGamela)
 * @copyright 2008 Chlorel (XNova)
 * @copyright 2012 Jan <info@2moons.cc> (2Moons)
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 2.0.$Revision: 2242 $ (2012-11-31)
 * @info $Id$
 * @link http://2moons.cc/
 */

class ShowNewsPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
		$this->setWindow('news');
	}
	
	function show() 
	{
		global $LNG;
		
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache"); // HTTP/1.0
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		$Code	= HTTP::_GP('code', 0);
		$loginCode	= false;
		if(isset($LNG['login_error_'.$Code]))
		{
			$loginCode	= $LNG['login_error_'.$Code];
		}

		$AllPlayers  = 0;
		$AllMonth	 = 0;
		$AllDay		 = 0;
		$AllActive  = 0;
		$AllTopics  = array();
		$AllNews    = array();
		$NewsList   = array();
		$AllTopNews = array();
		$page		= HTTP::_GP('side', 1);
		$newsId   	= HTTP::_GP('id', 0);
		$newsSolo	= "";
		$db	= Database::get();
		
		
		$sql	= 'SELECT * FROM %%NEWS%% WHERE top_news = :top_news ORDER BY date DESC LIMIT 5;';
		$NewsCount		= $db->select($sql, array(
			':top_news' 	=> 0
		));
		
		foreach($NewsCount as $NewsRow){
		$AllNews[]	= array(
				'id' => $NewsRow['id'],
				'title' => $NewsRow['title_'.$LNG['choosen_lang'].''],
				'text' => $NewsRow['text_'.$LNG['choosen_lang'].''],
				'catId' => $NewsRow['catId'],
				'from' 	=> sprintf($LNG['news_from'], _date($LNG['php_tdformat'], $NewsRow['date']), $NewsRow['user']),
				'date' 	=> _date($LNG['php_tdformat'], $NewsRow['date'], 1),
			);		
		}
		$maxPage	= max(1, ceil(count($NewsCount) / 7));
		$page		= max(1, min($page, $maxPage));
		$sqlLimit	= (($page - 1) * 7).", ".(7 - 1);
		//$sqlLimit	= 7;
		
		if($newsId == 0){
			$sql	= 'SELECT * FROM %%NEWS%% WHERE top_news = :top_news ORDER BY date DESC LIMIT :offset, :limit';
			$News		= $db->select($sql, array(
				':top_news' 	=> 0,
				':offset'       => (($page - 1) * 7),
				':limit'        => 7
			));
			foreach($News as $NewsRow){
			$NewsList[]	= array(
					'id' => $NewsRow['id'],
					'title' => $NewsRow['title_'.$LNG['choosen_lang'].''],
					'text' => $NewsRow['text_'.$LNG['choosen_lang'].''],
					'catId' => $NewsRow['catId'],
					'from' 	=> sprintf($LNG['news_from'], _date($LNG['php_tdformat'], $NewsRow['date']), $NewsRow['user']),
					'date' 	=> _date($LNG['php_tdformat'], $NewsRow['date'], 1),
				);		
			}
		}else{
			$sql	= 'SELECT * FROM %%NEWS%% WHERE id = :id;';
			$News		= $db->selectSingle($sql, array(
				':id' 	=> $newsId
			));		
			
			$newsSolo	= array(
				'id' 	=> $News['id'],
				'title' => $News['title_'.$LNG['choosen_lang'].''],
				'text'  => $News['text_'.$LNG['choosen_lang'].''],
				'catId' => $News['catId'],
				'forum' => $News['forum_link'],
				'from' 	=> sprintf($LNG['news_from'], _date($LNG['php_tdformat'], $News['date']), $News['user']),
				'date' 	=> _date($LNG['php_tdformat'], $News['date'], 1),
			);		
		}
		$i = 1;
		$sql	= 'SELECT * FROM %%NEWS%% WHERE top_news = :top_news ORDER BY date DESC LIMIT :limit;';
		$TopNews		= $db->select($sql, array(
			':top_news' => 1,
			':limit' 	=> 3
		));
		
		foreach($TopNews as $NewsRow){
		$AllTopNews[]	= array(
				'id' => $NewsRow['id'],
				'title' => $NewsRow['title_'.$LNG['choosen_lang'].''],
				'text' => $NewsRow['text_'.$LNG['choosen_lang'].''],
				'catId' => $NewsRow['catId'],
				'date' 	=> _date($LNG['php_tdformat'], $NewsRow['date'], 1),
				'ilvl' 	=> $i++,
			);		
		}
		$this->assign(array(
			'AllDay'		=> count($AllDay),
			'AllMonth'		=> count($AllMonth),
			'AllPlayers'	=> count($AllPlayers),
			'AllActive'		=> count($AllActive),
			'News'			=> count($News),
			'AllTopics'		=> $AllTopics,
			'AllNews'		=> $AllNews,
			'newsList'		=> $NewsList,
			'newsSolo'		=> $newsSolo,
			'AllTopNews'	=> $AllTopNews,
			'page'			=> $page,
			'site'			=> $page,
			'maxPage'		=> $maxPage,
			'code'			=> $loginCode,
		));
		if($newsId == 0){
			$this->display('page.news.default.tpl');
		}else{
			$this->display('page.news.details.tpl');	
		}
	}
}