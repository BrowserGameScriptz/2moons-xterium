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

abstract class AbstractLoginPage
{

	/**
	 * reference of the template object
	 * @var template
	 */
	protected $tplObj = null;
	protected $window;
	public $defaultWindow = 'normal';
	
	protected function __construct() {
		
		if(!AJAX_REQUEST)
		{
			$this->setWindow($this->defaultWindow);
			$this->initTemplate();
		} else {
			$this->setWindow('ajax');
		}
	}

	protected function getUniverseSelector()
	{
		$universeSelect	= array();
		foreach(Universe::availableUniverses() as $uniId)
		{
			$universeSelect[$uniId]	= Config::get($uniId)->uni_name;
		}

		return $universeSelect;
	}

	protected function initTemplate()
	{
		if(isset($this->tplObj))
			return true;
			
		$this->tplObj	= new template;
		list($tplDir)	= $this->tplObj->getTemplateDir();
		$this->tplObj->setTemplateDir($tplDir.'login/');
		return true;
	}
	
	protected function setWindow($window) {
		$this->window	= $window;
	}
		
	protected function getWindow() {
		return $this->window;
	}
	
	protected function getQueryString() {
		$queryString	= array();
		$page			= HTTP::_GP('page', '');
		
		if(!empty($page)) {
			$queryString['page']	= $page;
		}
		
		$mode			= HTTP::_GP('mode', '');
		if(!empty($mode)) {
			$queryString['mode']	= $mode;
		}
		
		return http_build_query($queryString);
	}
	
	protected function getPageData() 
    {		
		global $LNG;
		$page			= HTTP::_GP('page', '');
		$ShowMode = 0;
		if ($page == "promo"){
		$ShowMode = 1;
		}
		$config	= Config::get();
		
		$session = session::load();
		$ShowUser = 0;
		$accessBeta = 0;
		$userName = "";
		$encodage = "";
		$AccountInfo = array();
		$registerLink = $LNG['main_nav_12'];
		if($session->isValidSession())
		{
			$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
			$AccountInfo	= database::get()->selectSingle($sql, array(
				':userId'	=> $session->userId
			)); 
			$ShowUser = 1;
			$registerLink = $LNG['lobby_27'];
			$userName = $AccountInfo['username'];
			$encodage = $AccountInfo['encodage'];
			$accessBeta = $AccountInfo['accessBeta'];
		}

        $this->tplObj->assign_vars(array(
			'registerLink'			=> $registerLink,
			'AccountInfo'			=> $AccountInfo,
			'userName'				=> $userName,
			'encodage'				=> $encodage,
			'accessBeta'				=> $accessBeta,
			'ShowUser'				=> $ShowUser,
			'gameName' 				=> $config->game_name,
			'mailEnable'			=> $config->mail_active,
			'reg_close'				=> $config->reg_closed,
			'lang'					=> $LNG->getLanguage(),
			'UNI'					=> Universe::current(),
			'VERSION'				=> $config->VERSION,
			'REV'					=> substr($config->VERSION, -4),
			'languages'				=> Language::getAllowedLangs(false),
			'ShowMode'				=> $ShowMode,
			'choosen_lang'			=> $LNG['choosen_lang'],
			'my_game_url'			=> $config->domain_name, //without https or www
		));
	}
	
	protected function printMessage($message, $redirectButtons = null, $redirect = null, $fullSide = true)
	{
		$this->assign(array(
			'message'			=> $message,
			'redirectButtons'	=> $redirectButtons,
		));
		
		if(isset($redirect)) {
			$this->tplObj->gotoside($redirect[0], $redirect[1]);
		}
		
		if(!$fullSide) {
			$this->setWindow('popup');
		}
		
		$this->display('error.default.tpl');
	}
	
	protected function save() {
		
	}

	protected function assign($array, $nocache = true) {
		$this->tplObj->assign_vars($array, $nocache);
	}
	
	protected function display($file) {
		global $LNG;
		
		$this->save();
		
		if($this->getWindow() !== 'ajax') {
			$this->getPageData();
		}
		
				if (UNIS_WILDCAST) {
     		$hostParts = explode('.', HTTP_HOST);
			if (preg_match('/uni[0-9]+/', $hostParts[0])) {
				array_shift($hostParts);
			}
			$host = implode('.', $hostParts);
			$basePath = PROTOCOL.$host.HTTP_BASE;
		} else {
			$basePath = PROTOCOL.HTTP_HOST.HTTP_BASE;
		}
		
		$this->assign(array(
            'lang'    			=> $LNG->getLanguage(),
			'bodyclass'			=> $this->getWindow(),
			'basepath'			=> $basePath,
			'isMultiUniverse'	=> count(Universe::availableUniverses()) > 1,
			'unisWildcast'		=> UNIS_WILDCAST,
		));

		$this->assign(array(
			'LNG'			=> $LNG,
		), false);
		
		$this->tplObj->display('extends:layout.'.$this->getWindow().'.tpl|'.$file);
		exit;
	}
	
	protected function sendJSON($data) {
		$this->save();
		echo json_encode($data);
		exit;
	}
	
	protected function redirectTo($url) {
		$this->save();
		HTTP::redirectTo($url);
		exit;
	}
	
	protected function redirectPost($url, $postFields) {
		$this->save();
		$this->assign(array(
            'url'    		=> $url,
			'postFields'	=> $postFields,
		));
		
		$this->display('info.redirectPost.tpl');
	}
}