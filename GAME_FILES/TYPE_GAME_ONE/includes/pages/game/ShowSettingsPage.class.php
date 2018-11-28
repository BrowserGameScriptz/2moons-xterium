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

class ShowSettingsPage extends AbstractGamePage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
	}
	
	function randomPassword($amount) {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < $amount; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
	public function show()
	{
		global $USER, $LNG;
		$this->tplObj->loadscript('settings.js');
		
		if(empty($USER['apiKey'])){
			$appId	= $this->randomPassword(8);
			$sql = "UPDATE %%USERS%% SET apiKey = :apiKey WHERE id = :userID;";
			database::get()->update($sql, array(
				':apiKey'	=> $appId,
				':userID'	=> $USER['id']
			));
		}
		
		if($USER['urlaubs_modus'] == 1)
		{
			$this->assign(array(
				'vacationUntil'			=> _date($LNG['php_tdformat'], $USER['urlaubs_until'], $USER['timezone']),
				'delete'				=> $USER['db_deaktjava'],
				'canVacationDisbaled'	=> $USER['urlaubs_until'] < TIMESTAMP,
			));
			
			$this->display('page.settings.vacation.tpl');
		}
		else
		{
			
			$sql = "SELECT apiKey FROM %%USERS%% WHERE id = :userID;";
			$apiKey	= database::get()->selectSingle($sql, array(
				':userID'	=> $USER['id']
			));
			
			$this->assign(array(
				'Selectors'			=> array(
					'timezones' => get_timezone_selector(), 
					'Sort' => array(
						0 => $LNG['op_sort_normal'], 
						1 => $LNG['op_sort_koords'],
						2 => $LNG['op_sort_abc']), 
					'SortUpDown' => array(
						0 => $LNG['op_sort_up'], 
						1 => $LNG['op_sort_down']
					), 
					'displayads' => array(
						0 => "No", 
						1 => "Yes"
					), 
					'planetOption' => array(
						0 => $LNG['gather_opt_1'], 
						1 => $LNG['gather_opt_2'],
						2 => $LNG['gather_opt_3']
					), 
					'Skins' => Theme::getAvalibleSkins(), 
					'lang' => $LNG->getAllowedLangs(false)
					),
				'apiKey'			=> $apiKey['apiKey'],	
				'adminProtection'	=> $USER['authattack'],	
				'userAuthlevel'		=> $USER['authlevel'],
				'changeNickTime'	=> ($USER['uctime'] + USERNAME_CHANGETIME) - TIMESTAMP,
				'username'			=> $USER['username'],
				'email'				=> $USER['email'],
				'permaEmail'		=> $USER['email_2'], 
				'userLang'			=> $USER['lang'],
				'theme'				=> substr($USER['dpath'], 13, -1),
				'planetSort'		=> $USER['planet_sort'],
				'planetOrder'		=> $USER['planet_sort_order'],
				'displayads'		=> $USER['displayads'],
				'adblockerSet'		=> $USER['adblocker'],
				'eurospending'		=> $USER['eur_spend'],
				'spycount'			=> $USER['spio_anz'],
				'fleetActions'		=> $USER['settings_fleetactions'],
				'timezone'			=> $USER['timezone'],
				'deleteAcs'			=> $USER['db_deaktjava'], 
				'protectionTimer'	=> $USER['protectionTimer'] > TIMESTAMP ? 1 : 0,
				'protectionTimer2'	=> $USER['protectionTimer'] - TIMESTAMP,
				'queueMessages'		=> $USER['hof'],
				'auctionMessage'	=> $USER['auctionMessage'],
				'recordHidden'		=> $USER['recordshidden'],
				'showAllyFleet'		=> $USER['showAllyFleet'],
				'spyMessagesMode'	=> $USER['spyMessagesMode'],
				'galaxySpy' 		=> $USER['settings_esp'], 
				'op_ajax' 			=> $USER['op_ajax'],
				'settings_gift' 	=> $USER['settings_gift'],
				'avatarssd' 		=> $USER['avatar'],
				'settings_spy' 		=> $USER['settings_spy'],
				'msgperpage' 		=> $USER['msgperpage'],
				'sirenas' 			=> $USER['sirena'],
				'galaxyBuddyList' 	=> $USER['settings_bud'],
				'galaxyMissle' 		=> $USER['settings_mis'],
				'galaxyMessage' 	=> $USER['settings_wri'],
				'blockPM' 			=> $USER['settings_blockPM'],
				'multibuild' 		=> $USER['multibuild'],
				'userid'		 	=> $USER['id'],
				'fleetdesign'		=> $USER['fleetdesign'],
				'gatherOptionsType'	=> array(1 => $LNG['fleetta_typ_1'], 2 => $LNG['fleetta_typ_2'], 3 => $LNG['fleetta_typ_3'], 4 => $LNG['fleetta_typ_4']),
				'userChoice'		=> explode(',', $USER['gatherOptionsType']),
				'mainmenu'		 	=> $USER['mainmenu'],
				'gatheroptions'		=> $USER['gatheroptions'],
				'ref_active'		=> Config::get()->ref_active,
				'cooldowner'		=> $USER['protectionTimer'] < TIMESTAMP - 7 * 24 * 3600 ? 0 : 1,
				'allowCancel'		=> $USER['protectionTimer'] - 4 * 3600 < TIMESTAMP && $USER['protectionTimer'] > TIMESTAMP ? 1 : 0,
			));
			
			$this->display('page.settings.default.tpl');
		}
	}
	
	function cancelProtection()
	{
		global $USER, $PLANET, $LNG;
		
		if($USER['protectionTimer'] > TIMESTAMP && $USER['protectionTimer'] - 8*3600 < TIMESTAMP){
			$sql = "UPDATE %%USERS%% SET protectionTimer = :protectionTimer WHERE `id` = :userID;";
			database::get()->update($sql, array(
				':protectionTimer'	=> TIMESTAMP,
				':userID'			=> $USER['id']
			));
			$this->sendJSON(array('ok' => true));
		}
		$this->sendJSON(array('ok' => false));
	}
	
	private function CheckVMode()
	{
		global $USER, $PLANET;

		if(!empty($USER['b_tech']) || !empty($PLANET['b_building']) || !empty($PLANET['b_hangar']))
			return false;

		$db = Database::get();

		$sql = "SELECT COUNT(*) as state FROM %%FLEETS%% WHERE `fleet_owner` = :userID;";
		$fleets = $db->selectSingle($sql, array(
			':userID'	=> $USER['id']
		), 'state');

		if($fleets != 0)
			return false;

		$sql = "SELECT * FROM %%PLANETS%% WHERE id_owner = :userID AND id != :planetID AND destruyed = 0;";
		$query = $db->select($sql, array(
			':userID'	=> $USER['id'],
			':planetID'	=> $PLANET['id']
		));

		foreach($query as $CPLANET)
		{
			list($USER, $CPLANET)	= $this->ecoObj->CalcResource($USER, $CPLANET, true);
		
			if(!empty($CPLANET['b_building']) || !empty($CPLANET['b_hangar']))
				return false;
			
			unset($CPLANET);
		}

		return true;
	}
	
	private function CheckProtectionMode()
	{
		global $USER, $PLANET;

		$db = Database::get();

		$sql = "SELECT COUNT(*) as state FROM %%FLEETS%% WHERE `fleet_owner` = :userID AND fleet_mission NOT IN (3,4,7,8,11,16,17,18,25,26);";
		$fleets = $db->selectSingle($sql, array(
			':userID'	=> $USER['id']
		), 'state');

		if($fleets != 0)
			return false;

		return true;
	}
	
	public function send()
	{
		global $USER;
		if($USER['urlaubs_modus'] == 1) {
			$this->sendVacation();
		} else {
			$this->sendDefault();
		}
	}
	
	private function sendVacation() 
	{
		global $USER, $LNG, $PLANET;
		
		$delete		= HTTP::_GP('delete', 0);
		$vacation	= HTTP::_GP('vacation', 0);
		
		$db = Database::get();
		
		if($vacation == 1 && $USER['urlaubs_until'] <= TIMESTAMP) {
			
			$sql = "SELECT nextTime FROM %%CRONJOBS%% WHERE cronjobID = 2;";
			$Cronjob = $db->selectSingle($sql, array());
			
			
			$sql = "UPDATE %%USERS%% SET urlaubs_modus = '0', urlaubs_until = '0', urlaubs_next_allowed = :timestamp WHERE id = :userID;";
			$db->update($sql, array(
				':timestamp'			=> TIMESTAMP + 24*3600,
				':userID'				=> $USER['id']
			));

			$sql = "UPDATE %%PLANETS%% SET
						last_update = :timestamp,
						urlaubs_allowprod = :urlaubs_allowprod,
						energy_used = '0',
						energy = '0',
						metal_mine_porcent = '0',
						crystal_mine_porcent = '0',
						deuterium_sintetizer_porcent = '0',
						solar_plant_porcent = '0',
						fusion_plant_porcent = '0',
						solar_satelit_porcent = '0'
						WHERE id_owner = :userID;";
			$db->update($sql, array(
				':userID'		=> $USER['id'],
				':timestamp'	=> TIMESTAMP,
				':urlaubs_allowprod'	=> TIMESTAMP+5
			));
			$PLANET['last_update'] = TIMESTAMP; 
			
			require 'includes/classes/class.statbuilder.php';
			$stat	= new Statbuilder();
			$stat->MakeStats();
			
			$this->printMessage($LNG['op_options_changed'], true, array('game.php?page=resources', 2));
		}
		
		if($delete == 1) {
			$sql	= "UPDATE %%USERS%% SET db_deaktjava = :timestamp WHERE id = :userID;";
			$db->update($sql, array(
				':userID'		=> $USER['id'],
				':timestamp'	=> TIMESTAMP
			));
		} else {
			$sql	= "UPDATE %%USERS%% SET db_deaktjava = 0 WHERE id = :userID;";
			$db->update($sql, array(
				':userID'	=> $USER['id'],
			));
		}
		
		$this->printMessage($LNG['op_options_changed'], true, array('game.php?page=settings', 2));
	}
	
	private function sendDefault()
	{
		global $USER, $LNG, $THEME;
		
		//$adminprotection	= HTTP::_GP('adminprotection', 0);
		
		$username			= HTTP::_GP('username', $USER['username'], UTF8_SUPPORT);
		$password			= HTTP::_GP('password', '');
		
		$newpassword		= HTTP::_GP('newpassword', '');
		$newpassword2		= HTTP::_GP('newpassword2', '');
		
		//$email				= HTTP::_GP('email', $USER['email']);
		
		$timezone			= HTTP::_GP('timezone', '');	
		$language			= HTTP::_GP('language', '');	
		
		$planetSort			= HTTP::_GP('planetSort', 0);	
		$planetOrder		= HTTP::_GP('planetOrder', 0);
		$gatheroptions		= HTTP::_GP('gatherOptions', 0);
				
		//$theme				= HTTP::_GP('theme', $THEME->getThemeName());	
	
		$queueMessages		= HTTP::_GP('queueMessages', 0);	
		$auctionMessage		= HTTP::_GP('auctionMessage', 0);	
		$recordHidden		= HTTP::_GP('recordHidden', 0);	
		$displayads			= HTTP::_GP('displayads', 0);	
		$showAllyFleet		= HTTP::_GP('showAllyFleet', 0);	
		//$spyMessagesMode	= HTTP::_GP('spyMessagesMode', 0);

		$op_ajax			= HTTP::_GP('op_ajax', 0);	
		$settings_gift		= HTTP::_GP('settings_gift', 0);	
		$settings_spy		= HTTP::_GP('settings_spy', 0);	
		$sirena				= HTTP::_GP('sirena', 0);	
		$msgperpage			= HTTP::_GP('msgperpage', 0);	
		$multibuild			= HTTP::_GP('multibuild', 0);	
		$msgperpageOK		= array(10,20,30,40,50);
		$multibuildOK		= array(0,1,2);
		
		if(!in_array($msgperpage, $msgperpageOK))
			$msgperpage = 10;
		if(!in_array($multibuild, $multibuildOK))
			$multibuild = 0;
		
		$spycount			= HTTP::_GP('spycount', 1.0);	
		$fleetactions		= HTTP::_GP('fleetactions', 5);	
		
		$galaxySpy			= HTTP::_GP('galaxySpy', 0);	
		$galaxyMessage		= HTTP::_GP('galaxyMessage', 0);	
		$galaxyBuddyList	= HTTP::_GP('galaxyBuddyList', 0);	
		$galaxyMissle		= HTTP::_GP('galaxyMissle', 0);
		//$blockPM			= HTTP::_GP('blockPM', 0);
		
		$vacation			= HTTP::_GP('vacation', 0);	
		$delete				= HTTP::_GP('delete', 0);
		$protectionTimer	= HTTP::_GP('protectionTimer', 0);
		$fleetdesign		= HTTP::_GP('fleetdesign', $USER['fleetdesign']);
		$mainmenu			= HTTP::_GP('mainmenu', $USER['mainmenu']);
		$gatheroptions		= HTTP::_GP('gatherOptions', $USER['gatheroptions']);
		$gatherOptionsType	= implode(',', HTTP::_GP('gatherOptionsType', array()));
		if(!is_numeric(str_replace(',', '', $gatherOptionsType)) && !empty($gatherOptionsType)){
			$gatherOptionsType = "";
		}
			
		// Vertify
		
		define('TARGET', 'media/files/'); // Repertoire cible
		define('MAX_SIZE', 500000); // Taille max en octets du fichier
		define('WIDTH_MAX', 800); // Largeur max de l'image en pixels
		define('HEIGHT_MAX', 800); // Hauteur max de l'image en pixels
		// Tableaux de donnees
		$tabExt = array('jpg','png','jpeg', 'gif'); // Extensions autorisees

		$infosImg = array();
		// Variables
		$extension = '';
		$message = '';
		$nomImage = '';
		$Message = '';
		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			if( !empty($_FILES['fichier']['name']) )
			{
				$fichier = basename($_FILES['fichier']['name']);
				$extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
				if(in_array(strtolower($extension),$tabExt))
				{
					$infosImg = getimagesize($_FILES['fichier']['tmp_name']);
					if($infosImg[2] >= 1 && $infosImg[2] <= 14)
					{
						if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE))
						{
							if(isset($_FILES['fichier']['error'])&& UPLOAD_ERR_OK === $_FILES['fichier']['error'])
							{
								$nomImage = md5(uniqid()) .'.'. $extension;
								if(move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET.$nomImage))
								{
									
									$sql = "UPDATE %%USERS%% SET avatar = :avatar WHERE id = :userID;";
									database::get()->update($sql, array(
										':avatar'	=> $nomImage,
										':userID'	=> $USER['id']
									));
									//$this->printMessage("<span class='vert'>".$LNG['NOUVEAUTE_176']."</span>", true, array('game.php?page=settings', 2));
								}
								else
								{
									//$this->printMessage("<span class='rouge'>".$LNG['NOUVEAUTE_177']."</span>", true, array('game.php?page=settings', 2));
								}
							}
							else
							{
								//$this->printMessage("<span class='rouge'>".$LNG['NOUVEAUTE_178']."</span>", true, array('game.php?page=settings', 2));
							}
						}
						else
						{
							//$this->printMessage("<span class='rouge'>".$LNG['NOUVEAUTE_179']."</span>", true, array('game.php?page=settings', 2));
						}
					}
					else
					{
						//$this->printMessage("<span class='rouge'>".$LNG['NOUVEAUTE_180']."</span>", true, array('game.php?page=settings', 2));
					}
				}
				else
				{
					//$this->printMessage("<span class='rouge'>".$LNG['NOUVEAUTE_181']."</span>", true, array('game.php?page=settings', 2));
				}
			}
			else
			{
				//$this->printMessage("<span class='rouge'>".$LNG['NOUVEAUTE_182']."</span>", true, array('game.php?page=settings', 2));
			}
		}
		
		$sql = "SELECT * FROM %%USERS%% WHERE id = :userID;";
		$Details = database::get()->selectSingle($sql, array(
			':userID'	=> $USER['id']
		));
		
		
		//$adminprotection	= ($adminprotection == 1 && $USER['authlevel'] != AUTH_USR) ? $USER['authlevel'] : 0;
		
		$spycount			= min(max(round($spycount), 1), 4294967295);
		$fleetactions		= min(max($fleetactions, 1), 99);
		
		$language			= array_key_exists($language, $LNG->getAllowedLangs(false)) ? $language : $LNG->getLanguage();		
		//$theme				= array_key_exists($theme, Theme::getAvalibleSkins()) ? $theme : $THEME->getThemeName();
		
		$db = Database::get();
		
		/* if($USER['eur_spend'] >= 10){
			$sql = "UPDATE %%USERS%% SET displayads = :displayads WHERE id = :userID;";
			$db->update($sql, array(
				':displayads'	=> $displayads,
				':userID'		=> $USER['id']
			));
		} */
		
		if (!empty($username) && $USER['username'] != $username)
		{
			if (!PlayerUtil::isNameValid($username))
			{
				$this->printMessage($LNG['op_user_name_no_alphanumeric'], true, array('game.php?page=settings', 2));
			}
			elseif($USER['uctime'] >= TIMESTAMP - USERNAME_CHANGETIME)
			{
				$this->printMessage($LNG['op_change_name_pro_week'], true, array('game.php?page=settings', 2));
			}
			elseif(strlen($username) < 3 || strlen($username) > 15){
				$this->printMessage($LNG['checker_4'], true, array('game.php?page=settings', 2));
			}
			else
			{
				$sql = "SELECT
					(SELECT COUNT(*) FROM %%USERS%% WHERE universe = :universe AND username = :username) +
					(SELECT COUNT(*) FROM %%USERS_VALID%% WHERE universe = :universe AND username = :username)
				AS count";
				$Count = $db->selectSingle($sql, array(
					':universe'	=> Universe::current(),
					':username'	=> $username
				), 'count');

				if (!empty($Count)) {
					$this->printMessage(sprintf($LNG['op_change_name_exist'], $username), true, array('game.php?page=settings', 2));
				} else {
					$sql = "UPDATE %%USERS%% SET username = :username, uctime = :timestamp WHERE id = :userID;";
					$db->update($sql, array(
						':username'	=> $username,
						':userID'	=> $USER['id'],
						':timestamp'=> TIMESTAMP
					));

					Session::load()->delete();
				}
			} 
		} 
		
		 if (!empty($newpassword) && PlayerUtil::cryptPassword($password) == $USER["password"] && $newpassword == $newpassword2)
		{
			$newpass 	 = PlayerUtil::cryptPassword($newpassword);
			$sql = "UPDATE %%USERS%% SET password = :newpass WHERE id = :userID;";
			$db->update($sql, array(
				':newpass'	=> $newpass,
				':userID'	=> $USER['id']
			));
			Session::load()->delete();
		} 

		/* if (!empty($email) && $email != $USER['email'])
		{
			if(PlayerUtil::cryptPassword($password) != $USER['password'])
			{
				$this->printMessage($LNG['op_need_pass_mail'], array(array(
					'label'	=> $LNG['sys_back'],
					'url'	=> 'game.php?page=settings'
				)));
			}
			elseif(!ValidateAddress($email))
			{
				$this->printMessage($LNG['op_not_vaild_mail'], array(array(
					'label'	=> $LNG['sys_back'],
					'url'	=> 'game.php?page=settings'
				)));
			}
			else
			{
				$sql = "SELECT
							(SELECT COUNT(*) FROM %%USERS%% WHERE id != :userID AND universe = :universe AND (email = :email OR email_2 = :email)) +
							(SELECT COUNT(*) FROM %%USERS_VALID%% WHERE universe = :universe AND email = :email)
						as count";
				$Count = $db->selectSingle($sql, array(
					':universe'	=> Universe::current(),
					':userID'	=> $USER['id'],
					':email'	=> $email
				), 'count');

				if (!empty($Count)) {
					$this->printMessage(sprintf($LNG['op_change_mail_exist'], $email), array(array(
						'label'	=> $LNG['sys_back'],
						'url'	=> 'game.php?page=settings'
					)));
				} else {
					$sql	= "UPDATE %%USERS%% SET email = :email, setmail = :time WHERE id = :userID;";
					$db->update($sql, array(
						':email'	=> $email,
						':time'		=> (TIMESTAMP + 604800),
						':userID'	=> $USER['id']
					));
				}
			}
		}		 */
			
		
		if ($vacation == 1)
		{
			if(!$this->CheckVMode())
			{
				$this->printMessage($LNG['op_cant_activate_vacation_mode'], true, array('game.php?page=settings', 2));
			}
			elseif($USER['urlaubs_next_allowed'] > TIMESTAMP){
				$this->printMessage('You have to wait 24h before you can enter again in vacation mode.', true, array('game.php?page=settings', 2));
			}
			else
			{
				$sql = "UPDATE %%USERS%% SET urlaubs_modus = '1', urlaubs_until = :time WHERE id = :userID";
				$db->update($sql, array(
					':userID'	=> $USER['id'],
					':time'		=> (TIMESTAMP + Config::get()->vmode_min_time),
				));

				$sql = "UPDATE %%PLANETS%% SET energy_used = '0', energy = '0', metal_mine_porcent = '0', crystal_mine_porcent = '0', deuterium_sintetizer_porcent = '0', solar_plant_porcent = '0', fusion_plant_porcent = '0', solar_satelit_porcent = '0', metal_perhour = '0', crystal_perhour = '0', deuterium_perhour = '0' WHERE id_owner = :userID;";
				$db->update($sql, array(
					':userID'	=> $USER['id'],
				));
			}
		}

		if($delete == 1) {
			$sql	= "UPDATE %%USERS%% SET db_deaktjava = :timestamp WHERE id = :userID;";
			$db->update($sql, array(
				':userID'	=> $USER['id'],
				':timestamp'	=> TIMESTAMP
			));
		} else {
			$sql	= "UPDATE %%USERS%% SET db_deaktjava = 0 WHERE id = :userID;";
			$db->update($sql, array(
				':userID'	=> $USER['id'],
			));
		}
	
		if($protectionTimer == 1 && $USER['protectionTimer'] < TIMESTAMP - (7 * 24 * 3600)) {
			if(!$this->CheckProtectionMode()){
				$this->printMessage('You cannot activate the protection mode because you have fleets flying.', true, array('game.php?page=settings', 2));
			}else{
				$sql	= "UPDATE %%USERS%% SET protectionTimer = :protectionTimer WHERE id = :userID;";
				$db->update($sql, array(
					':userID'		=> $USER['id'],
					':protectionTimer'	=> TIMESTAMP + 12 * 3600
				));
			}
		}
		
		$sql =  "UPDATE %%USERS%% SET
		timezone				= :timezone,
		planet_sort				= :planetSort,
		planet_sort_order		= :planetOrder,
		spio_anz				= :spyCount,
		settings_fleetactions	= :fleetActions,
		settings_esp			= :galaxySpy,
		settings_wri			= :galaxyMessage,
		settings_bud			= :galaxyBuddyList,
		settings_mis			= :galaxyMissle,
		hof						= :queueMessages,
		auctionMessage			= :auctionMessage,
		recordshidden			= :recordHidden,
		showAllyFleet			= :showAllyFleet,
		op_ajax					= :op_ajax,
		settings_gift			= :settings_gift,
		settings_spy			= :settings_spy,
		lang					= :language,
		sirena					= :sirena,
		multibuild				= :multibuild,
		msgperpage				= :msgperpage,
		fleetdesign				= :fleetdesign,
		mainmenu				= :mainmenu,
		gatheroptions			= :gatheroptions,
		gatherOptionsType		= :gatherOptionsType
		WHERE id = :userID;";
		$db->update($sql, array(
			':timezone'			=> $timezone,
			':planetSort'		=> $planetSort,
			':planetOrder'		=> $planetOrder,
			':gatheroptions'	=> $gatheroptions,
			':spyCount'			=> $spycount,
			':fleetActions'		=> $fleetactions,
			':galaxySpy'		=> $galaxySpy,
			':galaxyMessage'	=> $galaxyMessage,
			':galaxyBuddyList'	=> $galaxyBuddyList,
			':galaxyMissle'		=> $galaxyMissle,
			':queueMessages'	=> $queueMessages,
			':auctionMessage'	=> $auctionMessage,
			':recordHidden'		=> $recordHidden,
			':showAllyFleet'	=> $showAllyFleet,
			':op_ajax'			=> $op_ajax,
			':settings_gift'	=> $settings_gift,
			':settings_spy'		=> $settings_spy,
			':language'			=> $language,
			':sirena'			=> $sirena,
			':multibuild'		=> $multibuild,
			':msgperpage'		=> $msgperpage,
			':fleetdesign'		=> $fleetdesign,
			':mainmenu'			=> $mainmenu,
			':gatheroptions'	=> $gatheroptions,
			':gatherOptionsType'=> $gatherOptionsType,
			':userID'			=> $USER['id']
		));

		$this->printMessage($LNG['op_options_changed'], true, array('game.php?page=settings', 2));
	}
}