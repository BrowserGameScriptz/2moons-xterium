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

require_once 'includes/pages/game/ShowPhalanxPage.class.php';

class GalaxyRows
{
	private $Galaxy;
	private $System;
	private $galaxyData;
	private $galaxyRow;
	
	const PLANET_DESTROYED = false;
	
	function __construct() {
		
	}
	
	public function setGalaxy($Galaxy) {
		$this->Galaxy	= $Galaxy;
		return $this;
	}
	
	public function setSystem($System) {
		$this->System	= $System;
		return $this;
	}
	
	public function getGalaxyData()
	{
		global $USER;

        $sql	= 'SELECT SQL_BIG_RESULT DISTINCT
		p.galaxy, p.system, p.planet, p.id, p.id_owner, p.gal6mod, p.gal6owner, p.isAlliancePlanet, p.planet_type, p.expiredTime, p.gal6type, p.name, p.image, p.last_update, p.diameter, p.temp_min, p.destruyed, p.der_metal, p.der_crystal, p.id_luna, 
		u.id as userid, u.ally_id, u.username, u.customNick, u.onlinetime, u.nextPossibleAttack, u.urlaubs_modus, u.protectionTimer, u.bana, u.banaday, u.outlaw, u.honour_points,
		m.id as m_id, m.diameter as m_diameter, m.name as m_name, m.temp_min as m_temp_min, m.last_update as m_last_update,
		s.total_points, s.defs_points, s.fleet_points, s.total_rank, s.honor_rank, 
		a.id as allyid, a.ally_tag, a.ally_web, a.ally_members, a.ally_name, a.ally_fraction_id, a.ally_fraction_level,
		allys.total_rank as ally_rank,
		COUNT(buddy.id) as buddy,
		d.level as diploLevel
		FROM %%PLANETS%% p
		LEFT JOIN %%USERS%% u ON p.id_owner = u.id
		LEFT JOIN %%PLANETS%% m ON m.id = p.id_luna
		LEFT JOIN %%STATPOINTS%% s ON s.id_owner = u.id AND s.stat_type = :statTypeUser
		LEFT JOIN %%ALLIANCE%% a ON a.id = u.ally_id
		LEFT JOIN %%DIPLO%% as d ON (d.owner_1 = :allianceId AND d.owner_2 = a.id) OR (d.owner_1 = a.id AND d.owner_2 = :allianceId) AND d.accept = :accept
		LEFT JOIN %%STATPOINTS%% allys ON allys.stat_type = :statTypeAlliance AND allys.id_owner = a.id
		LEFT JOIN %%BUDDY%% buddy ON (buddy.sender = :userId AND buddy.owner = u.id AND buddy.buddyType = :buddyType) OR (buddy.sender = u.id AND buddy.owner = :userId AND buddy.buddyType = :buddyType)
		WHERE p.universe = :universe AND p.galaxy = :galaxy AND p.system = :system AND p.planet_type = :planetTypePlanet
		GROUP BY p.id;';

		$galaxyResult	= Database::get()->select($sql, array(
			':statTypeUser' 	=> 1,
			':statTypeAlliance' => 2,
			':allianceId'		=> $USER['ally_id'],
			':userId'			=> $USER['id'],
			':universe'			=> Universe::current(),
			':galaxy'			=> $this->Galaxy,
			':system'			=> $this->System,
			':planetTypePlanet'	=> 1,
			':accept'			=> 1,
			':buddyType'			=> 1,
	  	));

		foreach ($galaxyResult as $galaxyRow)
		{
        	$this->galaxyRow = $galaxyRow;

			if ($this->galaxyRow['destruyed'] != 0)
			{
                $this->galaxyData[$this->galaxyRow['planet']]	= self::PLANET_DESTROYED;
				continue;
			}
			
			$this->galaxyData[$this->galaxyRow['planet']]	= array();
			
			$this->isOwnPlanet();
			$this->setLastActivity();
			
			$this->getAllowedMissions();
			
			$this->getPlayerData();
			$this->getPlanetData();
			$this->getAllianceData();
			$this->getDebrisData();
			$this->getMoonData();
			$this->getActionButtons();
		}
		
		return $this->galaxyData;
	}
	
	protected function setLastActivity()
	{
		global $LNG;
		
		$lastActivity	= floor((TIMESTAMP - max($this->galaxyRow['last_update'], $this->galaxyRow['m_last_update'])) / 60);
		
		if ($lastActivity < 15) {
			$this->galaxyData[$this->galaxyRow['planet']]['lastActivity']	= $LNG['gl_activity'];
		} elseif($lastActivity < 60) {
			$this->galaxyData[$this->galaxyRow['planet']]['lastActivity']	= sprintf($LNG['gl_activity_inactive'], $lastActivity);
		} else {
			$this->galaxyData[$this->galaxyRow['planet']]['lastActivity']	= '';
		}
	}
	
	protected function isOwnPlanet()
	{
		global $USER;
		
		$this->galaxyData[$this->galaxyRow['planet']]['ownPlanet']	= $this->galaxyRow['id_owner'] == $USER['id'];
	}
	
	protected function getAllowedMissions()
	{
		global $PLANET, $resource, $USER;
		
		$UsedPlanet				= (!empty($this->galaxyRow['id_owner'])) ? true : false;
		$sql = "SELECT onlinetime FROM %%USERS%% WHERE id = :id;";
		$kickUserAllianceId = database::get()->selectSingle($sql, array(
			':id'	=> $this->galaxyRow['id_owner']
		), 'onlinetime');

		$this->galaxyData[$this->galaxyRow['planet']]['missions']	= array(
			1	=> !$this->galaxyData[$this->galaxyRow['planet']]['ownPlanet'] && $UsedPlanet && $PLANET['last_relocate'] < TIMESTAMP - 15*60 && isModuleAvailable(MODULE_MISSION_ATTACK) && $PLANET['gal6mod'] == 0 || !$this->galaxyData[$this->galaxyRow['planet']]['ownPlanet'] && $UsedPlanet && $PLANET['last_relocate'] < TIMESTAMP - 15*60 && $kickUserAllianceId < TIMESTAMP - 7 * 24 * 3600 && $USER['nextPossibleAttack'] < TIMESTAMP && $PLANET['gal6mod'] == 0,
			3	=> isModuleAvailable(MODULE_MISSION_TRANSPORT) && $UsedPlanet && $PLANET['gal6mod'] == 0 && $this->galaxyRow['gal6mod'] == 0 && $kickUserAllianceId > TIMESTAMP - 7 * 24 * 3600 && $PLANET['isAlliancePlanet'] == 0 && $this->galaxyRow['isAlliancePlanet'] == 0 || $this->galaxyRow['gal6mod'] == 1 && $this->galaxyRow['id_owner'] == $USER['id'] || $this->galaxyData[$this->galaxyRow['planet']]['ownPlanet'] && $PLANET['gal6mod'] == 1 && $PLANET['isAlliancePlanet'] == 0 && $this->galaxyRow['isAlliancePlanet'] == 0,
			4	=> $this->galaxyData[$this->galaxyRow['planet']]['ownPlanet'] && $UsedPlanet && isModuleAvailable(MODULE_MISSION_STATION) && $this->galaxyRow['gal6mod'] == 0 && $PLANET['isAlliancePlanet'] == 0 && $this->galaxyRow['isAlliancePlanet'] == 0, 
			5	=> !$this->galaxyData[$this->galaxyRow['planet']]['ownPlanet'] && $UsedPlanet && isModuleAvailable(MODULE_MISSION_HOLD) && $PLANET['gal6mod'] == 0 && $this->galaxyRow['gal6mod'] == 0 || isModuleAvailable(MODULE_MISSION_HOLD) && $this->galaxyRow['gal6mod'] == 1 && $this->galaxyRow['id_owner'] == $USER['id'] && $PLANET['gal6mod'] == 0 || isModuleAvailable(MODULE_MISSION_HOLD) && $this->galaxyRow['gal6mod'] == 0 && $this->galaxyRow['id_owner'] == $USER['id'] && $PLANET['gal6mod'] == 0 && $PLANET['isAlliancePlanet'] == 0 && $this->galaxyRow['isAlliancePlanet'] == 1,
			6	=> !$this->galaxyData[$this->galaxyRow['planet']]['ownPlanet'] && $UsedPlanet && isModuleAvailable(MODULE_MISSION_SPY) && $PLANET['gal6mod'] == 0 || !$this->galaxyData[$this->galaxyRow['planet']]['ownPlanet'] && $this->galaxyRow['gal6mod'] == 1 && $this->galaxyRow['id_owner'] != $USER['id'] && isModuleAvailable(MODULE_MISSION_SPY) || !$this->galaxyData[$this->galaxyRow['planet']]['ownPlanet'] && $UsedPlanet && $kickUserAllianceId < TIMESTAMP - 7 * 24 * 3600 && $PLANET['gal6mod'] == 0,
			8	=> isModuleAvailable(MODULE_MISSION_RECYCLE) && $PLANET['gal6mod'] == 0,
			9	=> !$this->galaxyData[$this->galaxyRow['planet']]['ownPlanet'] && $UsedPlanet && $PLANET[$resource[214]] > 0 && $USER['rpg_destructeur'] == 1 && isModuleAvailable(MODULE_MISSION_DESTROY) && $PLANET['last_relocate'] < TIMESTAMP - 15*60 && $USER['nextPossibleAttack'] < TIMESTAMP && $PLANET['gal6mod'] == 0,
			10	=> !$this->galaxyData[$this->galaxyRow['planet']]['ownPlanet'] && $UsedPlanet && $PLANET[$resource[503]] > 0 && isModuleAvailable(MODULE_MISSION_ATTACK) && isModuleAvailable(MODULE_MISSILEATTACK) && $this->inMissileRange() && $PLANET['last_relocate'] < TIMESTAMP - 15*60 && $USER['nextPossibleAttack'] < TIMESTAMP && $PLANET['gal6mod'] == 0,
			11	=> $this->galaxyRow['id_owner'] == $USER['id'] && $UsedPlanet && isModuleAvailable(MODULE_MISSION_DARKMATTER) && $PLANET['dm_ship'] > 0 && $PLANET['gal6mod'] == 0,
			16	=> $this->galaxyRow['id_owner'] == NULL && !$UsedPlanet && $this->galaxyRow['gal6mod'] == 0,
			25	=> $this->galaxyRow['gal6mod'] == 1 && $PLANET['gal6mod'] == 0 && $this->galaxyRow['id_owner'] != $USER['id'],
		);
	}

	protected function inMissileRange()
	{
		global $USER, $PLANET, $resource;
		
		if ($this->galaxyRow['galaxy'] != $PLANET['galaxy'])
			return false;
		
		$Range		= FleetFunctions::GetMissileRange($USER[$resource[117]]);
		$systemMin	= $PLANET['system'] - $Range;
		$systemMax	= $PLANET['system'] + $Range;
		
		return $this->galaxyRow['system'] >= $systemMin && $this->galaxyRow['system'] <= $systemMax;
	}
	
	protected function getActionButtons()
	{
		global $USER;
       $UsedPlanet				= (!empty($this->galaxyRow['id_owner'])) ? true : false;
        if($this->galaxyData[$this->galaxyRow['planet']]['ownPlanet']) {
            $this->galaxyData[$this->galaxyRow['planet']]['action'] = false;
        } else {
			$sql	= "SELECT user.*, stat.total_points, stat.defs_points, stat.fleet_points FROM %%USERS%% as user LEFT JOIN %%STATPOINTS%% as stat ON stat.id_owner = user.id WHERE user.id = :userId AND stat.stat_type = 1;";
			$USERDATAFIX	= database::get()->selectSingle($sql, array(
				':userId'	=> $USER['id']
			));
			$IsNoobProtec		= CheckNoobProtec($USERDATAFIX, $this->galaxyRow, $this->galaxyRow);
			$outlaw 			= 0;
			if ($IsNoobProtec['StrongPlayer'] && $this->galaxyRow['id_owner'] != 9999 && $this->galaxyRow['isAlliancePlanet'] == 0)
				$outlaw	 	= 1;  
			
			$sql	= 'SELECT * FROM %%SAVEDGAL%% WHERE userId = :userId AND galaxy = :galaxy AND system = :system AND planet = :planet;';
			$isExistent	= database::get()->selectSingle($sql, array(
				':userId'	=> $USER['id'],
				':galaxy'	=> $this->galaxyRow['galaxy'],
				':system'	=> $this->galaxyRow['system'],
				':planet'	=> $this->galaxyRow['planet'],
			));
			$showShover = "";
			if(!empty($isExistent))
				$showShover = " shover";
			
            $this->galaxyData[$this->galaxyRow['planet']]['action'] = array(
                'esp'		=> ($USER['settings_esp'] == 1  && $UsedPlanet && $this->galaxyData[$this->galaxyRow['planet']]['missions'][6] && $this->galaxyRow['urlaubs_modus'] == 0) || ($USER['settings_esp'] == 1  && $this->galaxyRow['gal6mod'] == 1 && $this->galaxyData[$this->galaxyRow['planet']]['missions'][6]),
                'message'	=> $USER['settings_wri'] == 1  && $UsedPlanet && isModuleAvailable(MODULE_MESSAGES),
                'buddy'		=> $USER['settings_bud'] == 1  && $UsedPlanet && isModuleAvailable(MODULE_BUDDYLIST) && $this->galaxyRow['buddy'] == 0,
                'missle'	=> $USER['settings_mis'] == 1  && $UsedPlanet && $this->galaxyData[$this->galaxyRow['planet']]['missions'][10] && $this->galaxyRow['urlaubs_modus'] == 0,
                'outlaw'	=> $outlaw,
                'savecoords'=> $UsedPlanet && $this->galaxyRow['userid'] != $USER['id'] && $this->galaxyRow['gal6mod'] == 0,
                'isExistent'=> $UsedPlanet && $this->galaxyRow['userid'] != $USER['id'] && $this->galaxyRow['gal6mod'] == 0,
                'showShover'=> $showShover,
            );
        }
	}

	protected function getPlayerData()
	{
		global $USER, $LNG;
		
		
		$db 	= Database::get();
		$sql =  "SELECT * FROM %%BUDDY%% WHERE (sender = :userID AND owner = :targetID AND buddyType = 1 AND isAccepted = 1) OR (sender = :targetID AND owner = :userID AND buddyType = 1 AND isAccepted = 1);";
		$isFriend = $db->select($sql, array(
			':userID'			=> $USER['id'],
			':targetID'			=> $this->galaxyRow['userid']
		));
					
		$sqld =  "SELECT * FROM %%BUDDY%% WHERE sender = :userID AND owner = :targetID AND buddyType = :buddyType;";
		$isEnnemie = $db->select($sqld, array(
			':userID'			=> $USER['id'],
			':targetID'			=> $this->galaxyRow['userid'],
			':buddyType'			=> 2
		));
					
		$sql =  "SELECT total_rank FROM %%STATPOINTS%% ORDER BY total_rank DESC LIMIT 1;";
		$Lowestrank = $db->selectSingle($sql, array(
			':cronId'			=> 1
		), 'total_rank');
		
		$HonourStatus = "none";
		if($this->galaxyRow['honour_points'] >= 150000 && $this->galaxyRow['honor_rank'] <= 10){
			$HonourStatus = "rank_starlord3";
		}elseif($this->galaxyRow['honour_points'] >= 25000 && $this->galaxyRow['honor_rank'] <= 100){
			$HonourStatus = "rank_starlord2";
		}elseif($this->galaxyRow['honour_points'] >= 5000 && $this->galaxyRow['honor_rank'] <= 250){
			$HonourStatus = "rank_starlord1";
		}elseif($this->galaxyRow['honour_points'] <= -150000 && ($Lowestrank - 10) <= $this->galaxyRow['honor_rank']){
			$HonourStatus = "rank_bandit1";
		}elseif($this->galaxyRow['honour_points'] <= -25000 && ($Lowestrank - 100) <= $this->galaxyRow['honor_rank']){
			$HonourStatus = "rank_bandit2";
		}elseif($this->galaxyRow['honour_points'] <= -5000 && ($Lowestrank - 250) <= $this->galaxyRow['honor_rank']){
			$HonourStatus = "rank_bandit3";
		}
		$sql	= "SELECT user.*, stat.total_points, stat.defs_points, stat.fleet_points FROM %%USERS%% as user LEFT JOIN %%STATPOINTS%% as stat ON stat.id_owner = user.id WHERE user.id = :userId AND stat.stat_type = 1;";
		$USERDATAFIX	= database::get()->selectSingle($sql, array(
			':userId'	=> $USER['id']
		));
		$fightIsHonorableAttacker = fightIsHonorableAttacker($USERDATAFIX, $this->galaxyRow);
		
		
		
		
		$IsNoobProtec		= CheckNoobProtec($USERDATAFIX, $this->galaxyRow, $this->galaxyRow);
		$Class		 		= array();
		$Classd		 		= array();

		if ($this->galaxyRow['protectionTimer'] >= TIMESTAMP)
		{
			$Classd		 	= array('rose');
		}
		elseif ($this->galaxyRow['banaday'] > TIMESTAMP && $this->galaxyRow['bana'] == 1 && $this->galaxyRow['urlaubs_modus'] == 1)
		{
			$Classd		 	= array('banni_serveur', 'violet');
		}
		elseif ($this->galaxyRow['banaday'] > TIMESTAMP && $this->galaxyRow['bana'] == 1)
		{
			$Classd		 	= array('banni_serveur');
		}
		elseif ($this->galaxyRow['urlaubs_modus'] == 1)
		{
			$Classd		 	= array('violet');
		}
		elseif ($this->galaxyRow['onlinetime'] < TIMESTAMP - INACTIVE_LONG)
		{
			$Classd		 	= array( 'longinactive');
		}
		elseif ($this->galaxyRow['onlinetime'] < TIMESTAMP - INACTIVE)
		{
			$Classd		 	= array('inactive');
		}
		elseif(count($isEnnemie) > 0)
		{
			$Classd		 	= array('rouge');
		} 
		elseif(count($isFriend) > 0)
		{
			$Classd		 	= array('jaune');
		}
		elseif ($this->galaxyRow['outlaw'] > TIMESTAMP)
		{
			$Classd		 	= array('outlaw');
		}
		elseif ($IsNoobProtec['NoobPlayer'] && $this->galaxyRow['id_owner'] != 9999)
		{
			$Classd		 	= array('vert');
		}
		elseif ($IsNoobProtec['StrongPlayer'] && $this->galaxyRow['id_owner'] != 9999)
		{
			$Classd	 	= array('rouge');
		}
		elseif($fightIsHonorableAttacker == 1 && $this->galaxyRow['id_owner'] != $USER['id'])
		{
			$Classd		 	= array('fuchsia');
		}
		elseif($fightIsHonorableAttacker < 1 && $this->galaxyRow['id_owner'] != $USER['id'])
		{
			$Classd		 	= array('white');
		}
		
		if ($this->galaxyRow['banaday'] > TIMESTAMP && $this->galaxyRow['bana'] == 1 && $this->galaxyRow['urlaubs_modus'] == 1)
		{
			$Class		 	= array('vacation', 'banned');
		}
		elseif ($this->galaxyRow['banaday'] > TIMESTAMP && $this->galaxyRow['bana'] == 1)
		{
			$Class		 	= array('banned');
		}
		elseif ($this->galaxyRow['urlaubs_modus'] == 1)
		{
			$Class		 	= array('vacation');
		}
		elseif ($this->galaxyRow['onlinetime'] < TIMESTAMP - INACTIVE_LONG)
		{
			$Class		 	= array('inactive', 'longinactive');
		}
		elseif ($this->galaxyRow['onlinetime'] < TIMESTAMP - INACTIVE)
		{
			$Class		 	= array('inactive');
		}
		elseif ($IsNoobProtec['NoobPlayer'])
		{
			$Class		 	= array('noob');
		}
		elseif ($IsNoobProtec['StrongPlayer'])
		{
			$Class		 	= array('strong');
		}
		$selectedUsername = empty($this->galaxyRow['customNick']) ? htmlspecialchars($this->galaxyRow['username'], ENT_QUOTES, "UTF-8") : htmlspecialchars($this->galaxyRow['customNick'], ENT_QUOTES, "UTF-8");
		
		$string = $this->galaxyRow['gal6type'] + 100;
        $this->galaxyData[$this->galaxyRow['planet']]['user']	= array(
			'id'			=> $this->galaxyRow['userid'],
			'username'		=> $selectedUsername,
			'rank'			=> $this->galaxyRow['total_rank'],
			'points'		=> pretty_number($this->galaxyRow['total_points']),
			'playerrank'	=> isModuleAvailable(25)?sprintf($LNG['gl_in_the_rank'], $selectedUsername, $this->galaxyRow['total_rank']):$selectedUsername,
			'class'			=> $Class,
			'classd'			=> $Classd,
			'isBuddy'		=> $this->galaxyRow['buddy'] == 0,
			'HonourStatus'		=> $HonourStatus,
			'isgal6mod'		=> $this->galaxyRow['gal6mod'],
			'gal6owner'		=> $this->galaxyRow['gal6owner'],
			'gal6type'		=> $this->galaxyRow['gal6type'],
			'gal6lvl'		=> max(1,floor($string / 100)),
			'gal6desc'		=> $this->galaxyRow['gal6mod'] == 1 ? $LNG['galaxy6mod'][$this->galaxyRow['gal6type']] : "",
			'gal6desc1'		=> $this->galaxyRow['gal6mod'] == 1 ? sprintf($LNG['galaxy6modT'], pretty_time($this->galaxyRow['expiredTime'] - TIMESTAMP)) : "",
		);
	}
	
	
	protected function getAllianceData()
	{
		global $USER, $LNG;
		if(empty($this->galaxyRow['allyid'])) {
			$this->galaxyData[$this->galaxyRow['planet']]['alliance']	= false;
		} else {
			$Class	= array();
			switch($this->galaxyRow['diploLevel'])
			{
				case 1:
					$Class	= array('white');
				break;
				case 2:
					$Class	= array('green');
				break;
				case 3:
					$Class	= array('grey_yellow');
				break;
				case 4:
					$Class	= array('brown');
				break;
				case 5:
					$Class	= array('red');
				break;
				case 6:
					$Class	= array('green');
				break;
			}
			
			if($USER['ally_id'] == $this->galaxyRow['ally_id'])
			{
				$Class	= array('blue');
			}
			
			$this->galaxyData[$this->galaxyRow['planet']]['alliance']	= array(
				'id'		=> $this->galaxyRow['allyid'],
				'name'		=> htmlspecialchars($this->galaxyRow['ally_name'], ENT_QUOTES, "UTF-8"),
				'member'	=> sprintf(($this->galaxyRow['ally_members'] == 1) ? $LNG['gl_member_add'] : $LNG['gl_member'], $this->galaxyRow['ally_members']),
				'web'		=> $this->galaxyRow['ally_web'],
				'tag'		=> $this->galaxyRow['ally_tag'],
				'rank'		=> $this->galaxyRow['ally_rank'],
				'ally_fraction_id'		=> $this->galaxyRow['ally_fraction_id'],
				'ally_fraction_level'	=> $this->galaxyRow['ally_fraction_level'],
				'class'		=> $Class,
			);
		}
	}

	protected function getDebrisData()
	{
		$total		= $this->galaxyRow['der_metal'] + $this->galaxyRow['der_crystal'];
		if($total == 0) {
			$this->galaxyData[$this->galaxyRow['planet']]['debris']	= false;
		} else {
			$this->galaxyData[$this->galaxyRow['planet']]['debris']	= array(
				'metal'			=> $this->galaxyRow['der_metal'],
				'crystal'		=> $this->galaxyRow['der_crystal'],
			);
		}
	}

	protected function getMoonData()
	{		
		if(!isset($this->galaxyRow['m_id'])) {
			$this->galaxyData[$this->galaxyRow['planet']]['moon']	= false;
		} else {
			$this->galaxyData[$this->galaxyRow['planet']]['moon']	= array(
				'id'		=> $this->galaxyRow['m_id'],
				'name'		=> htmlspecialchars($this->galaxyRow['m_name'], ENT_QUOTES, "UTF-8"),
				'temp_min'	=> $this->galaxyRow['m_temp_min'], 
				'diameter'	=> $this->galaxyRow['m_diameter'],
			);
		}
	}

	protected function getPlanetData()
	{
		$this->galaxyData[$this->galaxyRow['planet']]['planet']	= array(
			'id'				=> $this->galaxyRow['id'],
			'isAlliancePlanet'	=> $this->galaxyRow['isAlliancePlanet'],
			'system'			=> $this->galaxyRow['system'],
			'planet'			=> $this->galaxyRow['planet'],
			'name'				=> strlen($this->galaxyRow['name'] > 12) ? htmlspecialchars($this->galaxyRow['name'], ENT_QUOTES, "UTF-8") : substr(htmlspecialchars($this->galaxyRow['name'], ENT_QUOTES, "UTF-8"), 0, 12),
			'image'				=> $this->galaxyRow['image'],
			'phalanx'			=> isModuleAvailable(MODULE_PHALANX) && ShowPhalanxPage::allowPhalanx($this->galaxyRow['galaxy'], $this->galaxyRow['system']),
		);
	}
}