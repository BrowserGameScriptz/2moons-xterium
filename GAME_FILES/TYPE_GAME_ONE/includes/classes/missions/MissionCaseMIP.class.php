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

class MissionCaseMIP extends MissionFunctions implements Mission
{
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{
		global $resource, $reslist;

		$db	= Database::get();

		$sqlFields	= array();
		$elementIDs	= array_merge($reslist['defense'], $reslist['missile']);

		foreach($elementIDs as $elementID)
		{
			$sqlFields[]	= '%%PLANETS%%.`'.$resource[$elementID].'`';
		}
			
		$sql = 'SELECT lang, shield_tech, dm_defensive_level, dm_defensive, rpg_amiral, combat_exp_level, academy_p_b_3_1301, academy_p_b_3_1302,academy_p_b_3_1307,
		%%PLANETS%%.id, name, id_owner, '.implode(', ', $sqlFields).'
		FROM %%PLANETS%%
		INNER JOIN %%USERS%% ON id_owner = %%USERS%%.id
		WHERE %%PLANETS%%.id = :planetId;';

		$targetData	= $db->selectSingle($sql, array(
			':planetId'	=> $this->_fleet['fleet_end_id']
		));
		
		if($this->_fleet['fleet_end_type'] == 3)
		{
			$sql	= 'SELECT '.$resource[502].' FROM %%PLANETS%% WHERE id_luna = :moonId;';
			$targetData[$resource[502]]	= $db->selectSingle($sql, array(
				':moonId'	=> $this->_fleet['fleet_end_id']
			), $resource[502]);
		}

		$sql		= 'SELECT lang, military_tech, dm_attack, dm_attack_level, rpg_amiral, combat_exp_level, academy_p_b_1_1101, academy_p_b_1_1102 FROM %%USERS%% WHERE id = :userId;';
		$senderData	= $db->selectSingle($sql, array(
			':userId'	=> $this->_fleet['fleet_owner']
		));

		$gouvernor_attack = 0;
		if($senderData['dm_attack'] > TIMESTAMP){
		$gouvernor_attack = GubPriceAPSTRACT(701, $senderData['dm_attack_level'], 'dm_attack');
		}

		$gouvernor_shield = 0;
		if($targetData['dm_defensive'] > TIMESTAMP){
		$gouvernor_shield = GubPriceAPSTRACT(702, $targetData['dm_defensive_level'], 'dm_defensive');
		}
		
		$getGalaxySevenAccount = getGalaxySevenAccount($senderData);
		$getGalaxySevenAttack  = $getGalaxySevenAccount['attack'];
		$getGalaxySevenArmor   = $getGalaxySevenAccount['armor'];
		$getGalaxySevenShield  = $getGalaxySevenAccount['shield'];
		
		$sql	= 'SELECT total_alliance_power FROM %%ALLIANCE%% WHERE id = :allyId;';
		$ExistAlliance = database::get()->selectSingle($sql, array(
			':allyId'	=> $senderData['ally_id']
		));
					
		$BonusAlliance = 0;
		if(!empty($ExistAlliance))
			$BonusAlliance = $ExistAlliance['total_alliance_power']/2;
				
		$attTech = $senderData['military_tech'] * 75 + $gouvernor_attack + $senderData['rpg_amiral'] + $senderData['combat_exp_level'] + $senderData['academy_p_b_1_1101'] + (2*$senderData['academy_p_b_1_1102']) - $senderData['academy_p_b_3_1302'] + $getGalaxySevenAttack + $BonusAlliance;
		
		$getGalaxySevenAccount = getGalaxySevenAccount($targetData);
		$getGalaxySevenAttack  = $getGalaxySevenAccount['attack'];
		$getGalaxySevenArmor   = $getGalaxySevenAccount['armor'];
		$getGalaxySevenShield  = $getGalaxySevenAccount['shield'];
		
		$sql	= 'SELECT total_alliance_power FROM %%ALLIANCE%% WHERE id = :allyId;';
		$ExistAlliance = database::get()->selectSingle($sql, array(
			':allyId'	=> $targetData['ally_id']
		));
					
		$BonusAlliance = 0;
		if(!empty($ExistAlliance))
			$BonusAlliance = $ExistAlliance['total_alliance_power']/2;
		
		$shieldTech = $targetData['shield_tech'] * 60 + $gouvernor_shield + $targetData['rpg_amiral'] + $targetData['combat_exp_level'] + $targetData['academy_p_b_3_1301'] + (2*$targetData['academy_p_b_3_1302']) - $targetData['academy_p_b_1_1102'] + $getGalaxySevenArmor + $BonusAlliance;

		if(!in_array($this->_fleet['fleet_target_obj'], array_merge($reslist['defense'], $reslist['missile'])) || $this->_fleet['fleet_target_obj'] == 502 || $this->_fleet['fleet_target_obj'] == 0)
		{
			$primaryTarget	= 401;
		}
		else
		{
			$primaryTarget	= $this->_fleet['fleet_target_obj'];
		}

        $targetDefensive    = array();

		foreach($elementIDs as $elementID)	
		{
			$targetDefensive[$elementID]	= $targetData[$resource[$elementID]];
		}
		
		unset($targetDefensive[502]);

		
		$LNG = new Language($targetData['lang']);
		$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME' , 'FLEET', 'TECH'));	
		
		$LNGS = new Language($senderData['lang']);
		$LNGS->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME' , 'FLEET', 'TECH'));	
		
		$this->_fleet['fleet_amount']	-= $this->_fleet['fleet_amount'] / 100 * academyBonus(1307, $targetData);
		
		if ($targetData[$resource[502]] >= $this->_fleet['fleet_amount'])
		{
			$LNG = new Language($targetData['lang']);
			$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME' , 'FLEET', 'TECH'));	
		
			$LNGS = new Language($senderData['lang']);
			$LNGS->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME' , 'FLEET', 'TECH'));	
			
			$message 	= $LNG['sys_irak_no_att'];
			$message1 	= $LNGS['sys_irak_no_att'];
			$where 		= $this->_fleet['fleet_end_type'] == 3 ? 'id_luna' : 'id';
			
			$sql		= 'UPDATE %%PLANETS%% SET '.$resource[502].' = '.$resource[502].' - :amount WHERE '.$where.' = :planetId;';

			$db->update($sql, array(
				':amount'	=> $this->_fleet['fleet_amount'],
				':planetId'	=> $targetData['id']
			));
		}
		else
		{
			if ($targetData[$resource[502]] > 0)
			{
				$where 	= $this->_fleet['fleet_end_type'] == 3 ? 'id_luna' : 'id';
				$sql	= 'UPDATE %%PLANETS%% SET '.$resource[502].' = :amount WHERE '.$where.' = :planetId;';

				$db->update($sql, array(
					':amount'	=> 0,
					':planetId'	=> $targetData['id']
				));
			}
			
			$targetDefensive = array_filter($targetDefensive);
			
			if(!empty($targetDefensive))
			{
				require_once 'includes/classes/missions/functions/calculateMIPAttack.php';
				$result   	= calculateMIPAttack($shieldTech, $attTech,
					$this->_fleet['fleet_amount'], $targetDefensive, $primaryTarget, $targetData[$resource[502]]);

				$result		= array_filter($result);
				
				$LNG = new Language($targetData['lang']);
				$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME' , 'FLEET', 'TECH'));	
		
				$LNGS = new Language($senderData['lang']);
				$LNGS->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME' , 'FLEET', 'TECH'));	
				$message	= sprintf($LNG['sys_irak_def'], $targetData[$resource[502]]).'<br><br>';
				$message1	= sprintf($LNGS['sys_irak_def'], $targetData[$resource[502]]).'<br><br>';
				
				ksort($result, SORT_NUMERIC);
				
				foreach ($result as $Element => $destroy)
				{
					$LNG = new Language($targetData['lang']);
					$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME' , 'FLEET', 'TECH'));	
		
					$LNGS = new Language($senderData['lang']);
					$LNGS->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME' , 'FLEET', 'TECH'));	
					$message .= sprintf('%s (- %d)<br>', $LNG['tech'][$Element], $destroy);
					$message1 .= sprintf('%s (- %d)<br>', $LNGS['tech'][$Element], $destroy);

					$sql	= 'UPDATE %%PLANETS%% SET '.$resource[$Element].' = '.$resource[$Element].' - :amount WHERE id = :planetId;';
					$db->update($sql, array(
						':planetId' => $targetData['id'],
						':amount'	=> $destroy
					));
				}
			}
			else
			{
				$LNG = new Language($targetData['lang']);
				$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME' , 'FLEET', 'TECH'));	
		
				$LNGS = new Language($senderData['lang']);
				$LNGS->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME' , 'FLEET', 'TECH'));	
				$message = $LNG['sys_irak_no_def'];
				$message1 = $LNGS['sys_irak_no_def'];
			}
		}

		$sql		= 'SELECT name FROM %%PLANETS%% WHERE id = :planetId;';
		$planetName	= Database::get()->selectSingle($sql, array(
			':planetId'	=> $this->_fleet['fleet_start_id'],
		), 'name');
		
		$LNG = new Language($targetData['lang']);
		$LNG->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME' , 'FLEET', 'TECH'));	
		
		$LNGS = new Language($senderData['lang']);
		$LNGS->includeData(array('L18N', 'BANNER', 'CUSTOM', 'INGAME' , 'FLEET', 'TECH'));	
			
		$ownerLink			= $planetName." ".GetStartAddressLink($this->_fleet);
		$targetLink 		= $targetData['name']." ".GetTargetAddressLink($this->_fleet);
		$message			= sprintf($LNG['sys_irak_mess'], $this->_fleet['fleet_amount'], $ownerLink, $targetLink).$message;
		$message1			= sprintf($LNGS['sys_irak_mess'], $this->_fleet['fleet_amount'], $ownerLink, $targetLink).$message1;

		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNGS['sys_mess_tower'], 3,
			$LNGS['sys_irak_subject'], $message1, $this->_fleet['fleet_start_time'], NULL, 1, $this->_fleet['fleet_universe']);
			
		PlayerUtil::sendMessage($this->_fleet['fleet_target_owner'], 0, $LNG['sys_mess_tower'], 3,
			$LNG['sys_irak_subject'], $message, $this->_fleet['fleet_start_time'], NULL, 1, $this->_fleet['fleet_universe']);

		$this->KillFleet();
	}
	
	function EndStayEvent()
	{
		return;
	}
	
	function ReturnEvent()
	{
		return;
	}
}
