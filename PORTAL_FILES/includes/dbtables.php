<?php
//souraya karaoui
/**
 *  2Moons
 *  Copyright (C) 2011 Jan Kröpke
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
 * @copyright 2009 Lucky
 * @copyright 2011 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.5 (2011-07-31)
 * @info $Id$
 * @link http://2moons.cc/
 */

	
define('DB_NAME'			, $database['databasename']);
define('DB_PREFIX'			, $database['tableprefix']);

// Data Tabells
$dbTableNames	= array(
	'ACADEMY'				=> DB_PREFIX.'academy_skills',
	'AKS'				=> DB_PREFIX.'aks',
	'ALLIANCE'			=> DB_PREFIX.'alliance',
	'ALLIANCEFRACTIONS'	=> DB_PREFIX.'alliance_fractions',
	'ALLIANCE_RANK'		=> DB_PREFIX.'alliance_ranks',
	'ALLIANCE_REQUEST'	=> DB_PREFIX.'alliance_request',
	'ATMUSE'			=> DB_PREFIX.'antimatter_use',
	'AUCTIONACTIVE'		=> DB_PREFIX.'auctions_active',
	'AUCTIONLOG'		=> DB_PREFIX.'auctions_active_log',
	'AUCTIONPLAYER'		=> DB_PREFIX.'auctions_used',
	'BANNED'			=> DB_PREFIX.'banned',
	'BLOCKLIST'			=> DB_PREFIX.'blocklist',
	'BUDDY'				=> DB_PREFIX.'buddy',
	'BUDDY_REQUEST'		=> DB_PREFIX.'buddy_request',
	'CHAT'				=> DB_PREFIX.'chat',
	'CHAT_ON'			=> DB_PREFIX.'chat_online',
	'CHAT_ON_ALLY'		=> DB_PREFIX.'chat_online_ally',
	'CHAT_ON_ROOMS'		=> DB_PREFIX.'chat_rooms_online',
	'CHAT_ROOMS'		=> DB_PREFIX.'chat_rooms',
	'CHAT_ROOMS_MSG'	=> DB_PREFIX.'chat_rooms_messages',
	'CONFIG'			=> DB_PREFIX.'config',
	'CRONJOBS'			=> DB_PREFIX.'cronjobs',
	'CRONJOBS_LOG'		=> DB_PREFIX.'cronjobs_log',
	'DIPLO'				=> DB_PREFIX.'diplo',
	'FAKEMAILS'			=> DB_PREFIX.'fakeemails',
	'FLEETS'			=> DB_PREFIX.'fleets',
	'FLEETS_EVENT'		=> DB_PREFIX.'fleet_event',
	'FLEETS_GROUP'		=> DB_PREFIX.'fleet_groups',
	'FREEALLOPASS'		=> DB_PREFIX.'freecode',
	'GOUVERNORS'		=> DB_PREFIX.'gouvernors',
	'IPLOG'				=> DB_PREFIX.'ip_multimod',
	'LOG'				=> DB_PREFIX.'log',
	'LOG_FLEETS'		=> DB_PREFIX.'log_fleets',
	'LOSTPASSWORD'		=> DB_PREFIX.'lostpassword',
	'LOTTERIA'			=> DB_PREFIX.'loteria',
	'LOTTERIALOG'		=> DB_PREFIX.'loteria_log',
	'LOTTERIAAM'		=> DB_PREFIX.'loteriaam',
	'LOTTERIALOGAM'		=> DB_PREFIX.'loteriaam_log',
	'NEWS'				=> DB_PREFIX.'news',
	'NOTES'				=> DB_PREFIX.'notes',
	'MESSAGES'			=> DB_PREFIX.'messages',
	'MULTI'				=> DB_PREFIX.'multi',
	'PLANETS'			=> DB_PREFIX.'planets',
	'PLANETAUCTION'		=> DB_PREFIX.'planet_auction',
	'PLANETUPGRADE'		=> DB_PREFIX.'planet_auction_upg',
	'PLANETITEMS'		=> DB_PREFIX.'planet_auction_items',
	'PREMIUMCALC'		=> DB_PREFIX.'premium_calc ',
	'PLANETIMG'			=> DB_PREFIX.'planetimage ',
	'RW'				=> DB_PREFIX.'raports',
	'RECORDS'			=> DB_PREFIX.'records',
	'SESSION'			=> DB_PREFIX.'session',
	'SHORTCUTS'			=> DB_PREFIX.'shortcuts',
	'STATPOINTS'		=> DB_PREFIX.'statpoints',
	'STATHISTORY'		=> DB_PREFIX.'stathistory',
	'STORAGELOGS'		=> DB_PREFIX.'storages_logs',
	'TICKETS'			=> DB_PREFIX.'ticket',
	'TICKETS_ANSWER'	=> DB_PREFIX.'ticket_answer',
	'TICKETS_CATEGORY'	=> DB_PREFIX.'ticket_category',
	'TIMEBONUS'			=> DB_PREFIX.'timebonus_log',
	'TOPKB'				=> DB_PREFIX.'topkb',
	'TOPKB_USERS'		=> DB_PREFIX.'users_to_topkb',
	'TRANSPORTLOGS'		=> DB_PREFIX.'transport_player',
	'USERS'				=> DB_PREFIX.'users',
	'USETTING'			=> DB_PREFIX.'users_settings',
	'USERS_ACS'			=> DB_PREFIX.'users_to_acs',
	'USERS_AUTH'		=> DB_PREFIX.'users_to_extauth',
	'USERS_VALID'	 	=> DB_PREFIX.'users_valid',
	'VARS'	 			=> DB_PREFIX.'vars',
	'VARS_RAPIDFIRE'	=> DB_PREFIX.'vars_rapidfire',
	'VARS_REQUIRE'	 	=> DB_PREFIX.'vars_requriements',
	'VOTE'		 	=> DB_PREFIX.'votesystem',
	'VOTE_LOG'		 	=> DB_PREFIX.'votesystem_log',
);
// MOD-TABLES