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

function ShowSearchPage()
{
	global $LNG, $USER;
	
	if ($_GET['delete'] == 'user') {
        PlayerUtil::deletePlayer((int) $_GET['user']);
        message($LNG['se_delete_succes_p'], '?page=search&search=users&minimize=on', 2);
	} elseif ($_GET['delete'] == 'planet'){
		PlayerUtil::deletePlanet((int) $_GET['planet']);
        message($LNG['se_delete_succes_p'], '?page=search&search=planet&minimize=on', 2);
    }
	
	$SearchFile		= HTTP::_GP('search', '');
	$SearchFor		= HTTP::_GP('search_in', '');
	$SearchMethod	= HTTP::_GP('fuki', '');
	$SearchKey		= HTTP::_GP('key_user', '', UTF8_SUPPORT);
	$Page 			= HTTP::_GP('side', 0);
	$Order			= HTTP::_GP('key_order', '');
	$OrderBY		= HTTP::_GP('key_acc', '');
	$limit			= HTTP::_GP('limit', 25);

	$Selector	= array(
		'list'	=> array(
			'users'		=> $LNG['se_users'],	
			'planet'	=> $LNG['se_planets'],
			'moon'		=> $LNG['se_moons'],
			'alliance'	=> $LNG['se_allys'],
			'vacation'	=> $LNG['se_vacations'],
			'banned'	=> $LNG['se_suspended'],
			'admin'		=> $LNG['se_authlevels'],
			'inactives'	=> $LNG['se_inactives'],
			'online'	=> $LNG['online_users'],
			'p_connect'	=> $LNG['se_planets_act'],
		),
		'search'	=> array(
			'name'	=> $LNG['se_input_name'],
			'id'	=> $LNG['input_id'],
		),
		'filter'	=> array(
			'normal'	=> $LNG['se_type_all'],
			'exacto'	=> $LNG['se_type_exact'],
			'last'		=> $LNG['se_type_last'],
			'first'		=> $LNG['se_type_first'],
		),
		'order'	=> array(
			'ASC'	=> $LNG['se_input_asc'],
			'DESC'	=> $LNG['se_input_desc'],
		),
		'limit'	=> array(
			'1'		=> '1',
			'5'		=> '5',
			'10'	=> '10',
			'15'	=> '15',
			'20'	=> '20',
			'25'	=> '25',
			'50'	=> '50',
			'100'	=> '100',
			'200'	=> '200',
			'500'	=> '500',	
		)
	);
	$template	= new template();

	
	
	
	if (HTTP::_GP('minimize', '') == 'on')
	{
		$Minimize			= "&amp;minimize=on";
		$template->assign_vars(array(	
			'minimize'	=> 'checked = "checked"',
			'diisplaay'	=> 'style="display:none;"',
		));
	}
	
	switch($SearchMethod)
	{
		case 'exacto':
			$SpecifyWhere	= "= '".$GLOBALS['DATABASE']->sql_escape($SearchKey)."'";
		break;
		case 'last':
			$SpecifyWhere	= "LIKE '".$GLOBALS['DATABASE']->sql_escape($SearchKey, true)."%'";
		break;
		case 'first':
			$SpecifyWhere	= "LIKE '%".$GLOBALS['DATABASE']->sql_escape($SearchKey, true)."'";
		break;
		default:
			$SpecifyWhere	= "LIKE '%".$GLOBALS['DATABASE']->sql_escape($SearchKey, true)."%'";
		break;
	};

	if (!empty($SearchFile))
	{
		$ArrayUsers		= array("users", "vacation", "admin", "inactives", "online");
		$ArrayPlanets	= array("planet", "moon", "p_connect");
		$ArrayBanned	= array("banned");
		$ArrayAlliance	= array("alliance");

		if (in_array($SearchFile, $ArrayUsers))
		{
			$Table			= "users";
			$NameLang		= $LNG['se_search_users'];
			$SpecifyItems	= "id,username,email_2,onlinetime,register_time,user_lastip,authlevel,bana,urlaubs_modus";
			$SName			= $LNG['se_input_userss'];
			$SpecialSpecify	= "";
			if ($SearchFile == "vacation"){
				$SpecialSpecify	= "AND urlaubs_modus = '1'";
				$SName			= $LNG['se_input_vacatii'];}
				
			if ($SearchFile == "online"){
				$SpecialSpecify	= "AND onlinetime >= '".(TIMESTAMP - 15 * 60)."'";
				$SName			= $LNG['se_input_connect'];}
				
			if ($SearchFile == "inactives"){
				$SpecialSpecify	= "AND onlinetime < '".(TIMESTAMP - 60 * 60 * 24 * 7)."'";
				$SName			= $LNG['se_input_inact'];}
				
			if ($SearchFile == "admin"){
				$SpecialSpecify	= "AND authlevel <= '".$USER['authlevel']."' AND authlevel > '0'";
				$SName			= $LNG['se_input_admm'];}
				
				
			$SpecialSpecify	.= " AND universe = '".Universe::getEmulated()."'";
			
			(($SearchFor == "name") ? $WhereItem = "WHERE username" : $WhereItem = "WHERE id");
			$ArrayOSec		= array("id", "username", "email_2", "onlinetime", "register_time", "user_lastip", "authlevel", "bana", "urlaubs_modus");
			$Array0SecCount	= count($ArrayOSec);

			for ($OrderNum = 0; $OrderNum < $Array0SecCount; $OrderNum++)
				$OrderBYParse[$ArrayOSec[$OrderNum]]	= $LNG['se_search_users'][$OrderNum];
		}
		
		
		elseif (in_array($SearchFile, $ArrayPlanets))
		{
			$Table			= "planets p";
			$TableUsers		= "2";
			$NameLang		= $LNG['se_search_planets'];
			$SpecifyItems	= "p.id,p.name,CONCAT(u.username, ' (ID:&nbsp;', p.id_owner, ')'),p.last_update,p.galaxy,p.system,p.planet,p.id_luna";
			
			if ($SearchFile == "planet") {
				$SpecialSpecify	= "AND planet_type = '1'";
				$SName			= $LNG['se_input_planett'];
			} elseif ($SearchFile == "moon") {
				$SpecialSpecify	= "AND planet_type = '3'";
				$SName			= $LNG['se_input_moonn'];
			} elseif ($SearchFile == "p_connect") {
				$SpecialSpecify	= "AND last_update >= ".(TIMESTAMP - 60 * 60)."";
				$SName			= $LNG['se_input_act_pla'];
			}
			
			$SpecialSpecify	.= " AND p.universe = ".Universe::getEmulated();
			$WhereItem = "LEFT JOIN ".USERS." u ON u.id = p.id_owner ";
			if($SearchFor == "name") {
				$WhereItem .= "WHERE p.name";
			} else {
				$WhereItem .= "WHERE p.id";
			}
			
			$ArrayOSec		= array("id", "name", "id_owner", "id_luna", "last_update", "galaxy", "system", "planet");
			$Array0SecCount	= count($ArrayOSec);
			
			for ($OrderNum = 0; $OrderNum < $Array0SecCount; $OrderNum++)
				$OrderBYParse[$ArrayOSec[$OrderNum]]	= $LNG['se_search_planets'][$OrderNum];
		}
		
		
		elseif (in_array($SearchFile, $ArrayBanned))
		{
			$Table			= "banned";
			$NameLang		= $LNG['se_search_banned'];
			$SpecifyItems	= "id,who,time,longer,theme,author";
			$SName			= $LNG['se_input_susss'];
			$SpecialSpecify	= " AND universe = '".Universe::getEmulated()."'";
			
			(($SearchFor == "name") ? $WhereItem = "WHERE who" : $WhereItem = "WHERE id");
			
			
			$ArrayOSec		= array("id", "who", "time", "longer", "theme", "author");
			$Array0SecCount	= count($ArrayOSec);
			
			for ($OrderNum = 0; $OrderNum < $Array0SecCount; $OrderNum++)
				$OrderBYParse[$ArrayOSec[$OrderNum]]	= $LNG['se_search_banned'][$OrderNum];
		}
		
		
		elseif (in_array($SearchFile, $ArrayAlliance))
		{
			$Table			= "alliance";
			$NameLang		= $LNG['se_search_alliance'];
			$SpecifyItems	= "id,ally_name,ally_tag,ally_owner,ally_register_time,ally_members";
			$SName			= $LNG['se_input_allyy'];
			$SpecialSpecify	= " AND ally_universe = '".Universe::getEmulated()."'";
			
			(($SearchFor == "name") ? $WhereItem = "WHERE ally_name" : $WhereItem = "WHERE id");
			
			
			$ArrayOSec		= array("id", "ally_name", "ally_tag", "ally_owner", "ally_register_time", "ally_members");
			$Array0SecCount	= count($ArrayOSec);
			
			for ($OrderNum = 0; $OrderNum < $Array0SecCount; $OrderNum++)
				$OrderBYParse[$ArrayOSec[$OrderNum]]	= $LNG['se_search_alliance'][$OrderNum];
		}
				
		$RESULT	= MyCrazyLittleSearch($SpecifyItems, $WhereItem, $SpecifyWhere, $SpecialSpecify, $Order, $OrderBY, $limit, $Table, $Page, $NameLang, $ArrayOSec, $Minimize, $SName, $SearchFile);
	}
	
	$template->assign_vars(array(	
		'Selector'				=> $Selector,
		'limit'					=> $limit,
		'search'				=> $SearchKey,
		'SearchFile'			=> $SearchFile,
		'SearchFor'				=> $SearchFor,
		'SearchMethod'			=> $SearchMethod,
		'Order'					=> $Order,
		'OrderBY'				=> $OrderBY,
		'OrderBYParse'			=> $OrderBYParse,
		'se_search'				=> $LNG['se_search'],
		'se_limit'				=> $LNG['se_limit'],
		'se_asc_desc'			=> $LNG['se_asc_desc'],
		'se_filter_title'		=> $LNG['se_filter_title'],
		'se_search_in'			=> $LNG['se_search_in'],
		'se_type_typee'			=> $LNG['se_type_typee'],
		'se_intro'				=> $LNG['se_intro'],
		'se_search_title'		=> $LNG['se_search_title'],
		'se_contrac'			=> $LNG['se_contrac'],
		'se_search_order'		=> $LNG['se_search_order'],
		'ac_minimize_maximize'	=> $LNG['ac_minimize_maximize'],
		'LIST'					=> $RESULT['LIST'],
	));
	
	$template->show('SearchPage.tpl');
}

function MyCrazyLittleSearch($SpecifyItems, $WhereItem, $SpecifyWhere, $SpecialSpecify, $Order, $OrderBY, $Limit, $Table, $Page, $NameLang, $ArrayOSec, $Minimize, $SName, $SearchFile)
{
	global $USER, $LNG;
	
	$parse	= $LNG;
	
	if (!$Page) 
	{ 
		$INI = 0; 
    	$Page = 1; 
	}
	else
		$INI = ($Page - 1) * $Limit;
		
	$ArrayEx	= explode(",", str_replace("CONCAT(u.username, ' (ID:&nbsp;', p.id_owner, ')')", '', $SpecifyItems));

	if (!$Order || !in_array($Order, $ArrayOSec))
		$Order	= $ArrayEx[0];
		
	$CountArray	= count($ArrayEx);
	
	
	$QuerySearch	 = "SELECT ".$SpecifyItems." FROM ".DB_PREFIX.$Table." ";
	$QuerySearch	.= $WhereItem." ";
	$QuerySearch	.= $SpecifyWhere." ".$SpecialSpecify." ";
	$QuerySearch	.= "ORDER BY ".$Order." ".$OrderBY;
	$FinalQuery		= $GLOBALS['DATABASE']->query($QuerySearch);
	
	$QueryCSearch	 = "SELECT COUNT(".$ArrayEx[0].") AS total FROM ".DB_PREFIX.$Table." ";
	$QueryCSearch	.= $WhereItem." ";
	$QueryCSearch	.= $SpecifyWhere." ".$SpecialSpecify." ";
	$CountQuery		= $GLOBALS['DATABASE']->getFirstRow($QueryCSearch);
	
	if ($CountQuery['total'] > 0)
	{
		$NumberOfPages = ceil($CountQuery['total'] / $Limit);
	
		$UrlForPage	= "?page=search
						&search=".$SearchFile."
						&search_in=".$_GET['search_in']."
						&fuki=".$_GET['fuki']."
						&key_user=".$_GET['key_user']."
						&key_order=".$_GET['key_order']."
						&key_acc=".$_GET['key_acc']."
						&limit=".$Limit;
						 
		$Search['LIST']	 = "";
		
	
	
		while ($WhileResult	= $GLOBALS['DATABASE']->fetch_num($FinalQuery))
		{
			
			if ($Table == "users")
			{
				
				//$SpecifyItems	= "id,username,email_2,onlinetime,register_time,user_lastip,authlevel,bana,urlaubs_modus";
				$Search['LIST'] .= "<tr>
									<td>".$WhileResult['id']."</td>
									<td>".$WhileResult['username']."</td>
									<td>".$WhileResult['email_2']."</td>
									<td>".$WhileResult['onlinetime']."</td>
									<td>".$WhileResult['register_time']."</td>
									<td>".$WhileResult['user_lastip']."</td>
									<td>".$WhileResult['authlevel']."</td>
									<td><span class=\"label label-success\">Not banned</span></td>
									<td><span class=\"label label-success\">Not in vacation</span></td>
									<td class=\"text-center\">
										<ul class=\"icons-list\">
											<li class=\"dropdown\">
												<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
													<i class=\"icon-menu9\"></i>
												</a>

												<ul class=\"dropdown-menu dropdown-menu-right\">
													<li><a href=\"#\"><i class=\"icon-pencil5\"></i> Edit Account</a></li>
													<li><a href=\"#\"><i class=\"glyphicon glyphicon-remove\"></i> Delete Account</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>";
			}
		
			if ($Table == "planets p"){
			
				if (allowedTo('ShowQuickEditorPage'))
					$Search['LIST']	.= "<td><a href=\"javascript:openEdit('".$WhileResult[0]."', 'planet');\" border=\"0\"><img src=\"./styles/resource/images/admin/GO.png\" title=".$LNG['se_search_edit']."></a></td>";
					
				if ($USER['authlevel'] == AUTH_ADM)
					$Search['LIST']	.= '<td><a href="?page=search&amp;delete=planet&amp;planet='.$WhileResult[0].'" border="0" onclick="return confirm(\''.$LNG['se_confirm_planet'].' '.$WhileResult[1].'\');"><img src="./styles/resource/images/alliance/CLOSE.png" width="16" height="16" title='.$LNG['button_delete'].'></a></td>';
			}
			
			//$Search['LIST']	.= "</tr>";
		}
		
	
	
		$GLOBALS['DATABASE']->free_result($FinalQuery);
		
		return $Search;
	}
	else
	{
		$Result['LIST']	 = "<br><table border='0px' style='background:url(images/Adm/blank.gif);' width='90%'>";
		$Result['LIST']	.= "<tr><td style='color:#00CC33;border: 2px red solid;' height='25px'><font color=red>".$LNG['se_no_data']."</font></td></tr>";
		$Result['LIST']	.= "</table>";
		return $Result;
	}
}
