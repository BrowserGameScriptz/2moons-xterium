-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 28 nov. 2018 à 20:45
-- Version du serveur :  5.7.24-0ubuntu0.16.04.1
-- Version de PHP :  7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `admin_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Structure de la table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Structure de la table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Structure de la table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Structure de la table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Déchargement des données de la table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('admin_space', '[{\"db\":\"admin_xter_space\",\"table\":\"uni1_config\"},{\"db\":\"admin_xter_space\",\"table\":\"uni1_planets\"},{\"db\":\"admin_xter_space\",\"table\":\"uni1_users\"},{\"db\":\"admin_xter_space\",\"table\":\"uni1_chat\"},{\"db\":\"admin_xter_space\",\"table\":\"uni1_chat_rooms\"},{\"db\":\"admin_xter_space\",\"table\":\"uni1_auctions_used\"},{\"db\":\"admin_xter_space\",\"table\":\"uni1_alliance\"},{\"db\":\"admin_xter_space\",\"table\":\"uni1_records\"},{\"db\":\"admin_xter_space\",\"table\":\"uni1_messages\"},{\"db\":\"admin_xter_space\",\"table\":\"uni1_fleet_event\"}]'),
('enderson', '[{\"db\":\"enderson_world3\",\"table\":\"uni1_users\"},{\"db\":\"enderson_world3\",\"table\":\"uni1_planets\"},{\"db\":\"enderson_world3\",\"table\":\"uni1_config\"},{\"db\":\"enderson_world3\",\"table\":\"uni1_academy_skills\"},{\"db\":\"enderson_world3\",\"table\":\"uni1_alliance_fractions\"},{\"db\":\"enderson_world3\",\"table\":\"uni1_alliance\"},{\"db\":\"enderson_world2\",\"table\":\"uni1_users\"},{\"db\":\"enderson_world2\",\"table\":\"uni1_planets\"},{\"db\":\"enderson_world2\",\"table\":\"uni1_config\"},{\"db\":\"enderson_world2\",\"table\":\"uni1_ticket_answer\"}]');

-- --------------------------------------------------------

--
-- Structure de la table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Structure de la table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Déchargement des données de la table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('admin_space', 'admin_xter_space', 'emails', '{\"sorted_col\":\"`email` ASC\"}', '2016-04-06 21:30:44'),
('admin_space', 'admin_xter_space', 'uni1_alliance', '{\"sorted_col\":\"`id` ASC\"}', '2016-04-18 14:26:05'),
('admin_space', 'admin_xter_space', 'uni1_antimatter_use', '{\"sorted_col\":\"`uni1_antimatter_use`.`userID` ASC\"}', '2016-03-07 03:52:59'),
('admin_space', 'admin_xter_space', 'uni1_auctions_used', '{\"sorted_col\":\"`uni1_auctions_used`.`elementID` ASC\"}', '2016-04-18 21:27:30'),
('admin_space', 'admin_xter_space', 'uni1_freecode', '{\"sorted_col\":\"`uni1_freecode`.`codeID` ASC\"}', '2016-03-26 20:02:28'),
('admin_space', 'admin_xter_space', 'uni1_ip_multimod', '{\"sorted_col\":\"`suspectId` ASC\"}', '2016-04-06 18:10:59'),
('admin_space', 'admin_xter_space', 'uni1_log_fleets', '{\"sorted_col\":\"`fleet_start_time` ASC\"}', '2016-04-05 18:36:21'),
('admin_space', 'admin_xter_space', 'uni1_messages', '{\"sorted_col\":\"`message_time` ASC\"}', '2016-04-18 13:11:47'),
('admin_space', 'admin_xter_space', 'uni1_planet_auction_items', '{\"sorted_col\":\"`uni1_planet_auction_items`.`upgradePrice` DESC\"}', '2016-03-07 04:33:16'),
('admin_space', 'admin_xter_space', 'uni1_planet_auction_upg', '{\"sorted_col\":\"`uni1_planet_auction_upg`.`upgradePrice` DESC\"}', '2016-03-07 04:33:22'),
('admin_space', 'admin_xter_space', 'uni1_planets', '{\"sorted_col\":\"`deuterium` DESC\"}', '2016-04-12 16:36:36'),
('admin_space', 'admin_xter_space', 'uni1_raports', '{\"sorted_col\":\"`uni1_raports`.`time` ASC\"}', '2016-02-01 14:06:30'),
('admin_space', 'admin_xter_space', 'uni1_records', '{\"sorted_col\":\"`uni1_records`.`elementID` ASC\"}', '2016-04-18 13:40:19'),
('admin_space', 'admin_xter_space', 'uni1_storages_logs', '{\"sorted_col\":\"`uni1_storages_logs`.`userID` ASC\"}', '2016-03-04 00:36:59'),
('admin_space', 'admin_xter_space', 'uni1_ticket_answer', '{\"sorted_col\":\"`uni1_ticket_answer`.`answerID` ASC\"}', '2016-03-25 20:41:35'),
('admin_space', 'admin_xter_space', 'uni1_transport_player', '{\"sorted_col\":\"`receiverID` ASC\"}', '2016-03-11 16:21:59'),
('admin_space', 'admin_xter_space', 'uni1_users', '{\"sorted_col\":\"`antimatter` DESC\"}', '2016-04-21 12:51:09'),
('admin_space', 'admin_xter_space', 'uni1_vars', '{\"sorted_col\":\"`elementID` ASC\"}', '2016-04-04 01:16:42'),
('enderson', 'enderson_database', 'uni1_ip_multimod', '{\"sorted_col\":\"`uni1_ip_multimod`.`proxies` ASC\"}', '2017-05-31 21:52:40'),
('enderson', 'enderson_database', 'uni1_users', '{\"sorted_col\":\"`uni1_users`.`deviceId`  DESC\"}', '2017-05-20 15:20:42'),
('enderson', 'enderson_woa', 'uni1_vars', '{\"sorted_col\":\"`elementID` ASC\"}', '2017-06-27 18:22:29'),
('enderson', 'enderson_world2', 'uni1_auctions_active', '{\"sorted_col\":\"`uni1_auctions_active`.`startTime` ASC\"}', '2017-06-01 19:13:04'),
('enderson', 'enderson_world2', 'uni1_galaxy7_account', '{\"sorted_col\":\"`uni1_galaxy7_account`.`specialId` ASC\"}', '2017-06-14 21:43:22'),
('enderson', 'enderson_world2', 'uni1_galaxy7_planet', '{\"sorted_col\":\"`specialId` ASC\"}', '2017-06-16 23:11:03'),
('enderson', 'enderson_world2', 'uni1_log_fleets', '{\"sorted_col\":\"`uni1_log_fleets`.`start_time` ASC\"}', '2017-05-31 21:13:17'),
('enderson', 'enderson_world2', 'uni1_messages', '{\"sorted_col\":\"`uni1_messages`.`message_time`  ASC\"}', '2017-06-15 23:49:23'),
('enderson', 'enderson_world2', 'uni1_planets', '{\"sorted_col\":\"`gal6type`  DESC\"}', '2017-06-17 13:17:47'),
('enderson', 'enderson_world2', 'uni1_purchase_logs', '{\"sorted_col\":\"`payupdate` ASC\"}', '2017-06-17 15:21:53'),
('enderson', 'enderson_world2', 'uni1_raports', '{\"sorted_col\":\"`uni1_raports`.`time` ASC\"}', '2017-05-31 21:03:44'),
('enderson', 'enderson_world2', 'uni1_users', '{\"sorted_col\":\"`uni1_users`.`id` ASC\"}', '2017-06-25 11:17:24'),
('enderson', 'enderson_world2', 'uni1_vars', '{\"sorted_col\":\"`elementID` ASC\"}', '2017-07-06 10:36:53');

-- --------------------------------------------------------

--
-- Structure de la table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Déchargement des données de la table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('admin_space', '2016-02-27 18:33:06', '{\"collation_connection\":\"utf8mb4_unicode_ci\",\"lang\":\"fr\"}'),
('enderson', '2017-08-05 06:16:28', '{\"lang\":\"it\",\"collation_connection\":\"utf8mb4_unicode_ci\"}');

-- --------------------------------------------------------

--
-- Structure de la table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Structure de la table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

-- --------------------------------------------------------

--
-- Structure de la table `uni1_academy_skills`
--

CREATE TABLE `uni1_academy_skills` (
  `skill_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ab1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ab2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `icost` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `factor` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uni1_academy_skills`
--

INSERT INTO `uni1_academy_skills` (`skill_id`, `ab1`, `ab2`, `icost`, `factor`) VALUES
(1101, 1, 0, 1, 1.2),
(1102, 2, 1, 2, 1.25),
(1103, 1, 0, 4, 1.3),
(1104, 1, 0, 10, 1.5),
(1105, 3, 0, 3, 1.25),
(1106, 1, 0, 3, 1.3),
(1107, 2, 0, 3, 1.3),
(1108, 2, 0, 7, 1.55),
(1109, 1, 0, 9, 1.3),
(1110, 8, 0, 7, 1.5),
(1111, 1, 0, 1, 1.5),
(1112, 2, 2, 3, 1.2),
(1113, 1, 0, 16, 1.6),
(1201, 5, 0, 1, 1.25),
(1202, 2, 0, 2, 1.25),
(1203, 2, 0, 4, 1.3),
(1204, 5, 0, 3, 1.25),
(1205, 1, 0, 30, 1.3),
(1206, 1, 0, 500, 2),
(1207, 5, 0, 2, 1.25),
(1208, 25, 0, 50, 2),
(1209, 3, 0, 2, 1.3),
(1210, 3, 0, 10, 1.3),
(1301, 1, 0, 1, 1.2),
(1302, 2, 1, 2, 1.25),
(1303, 1, 0, 4, 1.3),
(1304, 1, 0, 8, 1.45),
(1305, 1, 0, 3, 1.3),
(1306, 1, 0, 3, 1.3),
(1307, 2, 0, 1, 1.35),
(1308, 2, 0, 10, 1.55),
(1309, 250, 0, 500, 2.3),
(1310, 1, 0, 10, 1.5),
(1311, 3, 0, 4, 1.2),
(1312, 1, 0, 3, 1.35),
(1313, 1, 0, 3, 1.4),
(1314, 1, 0, 3, 1.5);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_achats_log`
--

CREATE TABLE `uni1_achats_log` (
  `achatID` int(11) NOT NULL,
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `userID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `message` text CHARACTER SET utf8,
  `total_cred` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_adminpanel_logs`
--

CREATE TABLE `uni1_adminpanel_logs` (
  `logId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED DEFAULT '0',
  `userName` text,
  `data` text,
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `logMode` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_admin_logins`
--

CREATE TABLE `uni1_admin_logins` (
  `adminLog` int(11) NOT NULL,
  `username` text,
  `userip` text,
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_aks`
--

CREATE TABLE `uni1_aks` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `target` int(11) UNSIGNED NOT NULL,
  `ankunft` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_alliance`
--

CREATE TABLE `uni1_alliance` (
  `id` int(11) UNSIGNED NOT NULL,
  `ally_name` varchar(50) DEFAULT '',
  `ally_tag` varchar(20) DEFAULT '',
  `ally_owner` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ally_register_time` int(11) NOT NULL DEFAULT '0',
  `ally_description` text,
  `ally_web` varchar(255) DEFAULT '',
  `ally_text` longtext,
  `ally_image` varchar(255) DEFAULT '',
  `ally_request` varchar(1000) DEFAULT NULL,
  `ally_request_notallow` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ally_request_min_points` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `ally_owner_range` varchar(32) DEFAULT '',
  `ally_members` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ally_stats` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `ally_diplo` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `ally_universe` tinyint(3) UNSIGNED NOT NULL,
  `ally_max_members` int(5) UNSIGNED NOT NULL DEFAULT '20',
  `ally_events` varchar(55) NOT NULL DEFAULT '',
  `alliance_storage_metal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `alliance_storage_crystal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `alliance_storage_deuterium` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `alliance_storage_stardust` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `total_alliance_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_alliance_production` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_alliance_speed` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_alliance_power` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_alliance_buildings` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_alliance_research` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_alliance_conv_fleet` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_alliance_conv_def` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ally_fraction_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ally_fraction_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `allianceEvent` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_alliance_fractions`
--

CREATE TABLE `uni1_alliance_fractions` (
  `ally_fraction_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ally_fraction_armement` float(5,2) NOT NULL DEFAULT '0.00',
  `ally_fraction_in_armement` float NOT NULL DEFAULT '0',
  `ally_fraction_in_armor` float NOT NULL DEFAULT '0',
  `ally_fraction_in_shields` float NOT NULL DEFAULT '0',
  `ally_fraction_fleet_speed` float NOT NULL DEFAULT '0',
  `ally_fraction_thief_resource` float NOT NULL DEFAULT '0',
  `ally_fraction_combat_exp_pla` float NOT NULL DEFAULT '0',
  `ally_fraction_teleporter` float NOT NULL DEFAULT '0',
  `ally_fraction_def_debris` float NOT NULL DEFAULT '0',
  `ally_fraction_defense_restore` float NOT NULL DEFAULT '0',
  `ally_fraction_armor` float NOT NULL DEFAULT '0',
  `ally_fraction_shields` float NOT NULL DEFAULT '0',
  `ally_fraction_fleet_capa` float NOT NULL DEFAULT '0',
  `ally_fraction_fuel` float NOT NULL DEFAULT '0',
  `ally_fraction_upgrade_acti` float NOT NULL DEFAULT '0',
  `ally_fraction_combat_exp_expe` float NOT NULL DEFAULT '0',
  `ally_fraction_ally_point` float NOT NULL DEFAULT '0',
  `ally_fraction_resource_prod` float NOT NULL DEFAULT '0',
  `ally_fraction_energy_prod` float NOT NULL DEFAULT '0',
  `ally_fraction_upgrade_find` float NOT NULL DEFAULT '0',
  `ally_fraction_resource_after_fight` float NOT NULL DEFAULT '0',
  `ally_fraction_peace_exp` float NOT NULL DEFAULT '0',
  `ally_fraction_expe_speed` float NOT NULL DEFAULT '0',
  `ally_fraction_fleet_price` float(5,2) NOT NULL DEFAULT '0.00',
  `ally_fraction_research_price` float(5,2) NOT NULL DEFAULT '0.00',
  `ally_fraction_defe_price` float(5,2) NOT NULL DEFAULT '0.00',
  `ally_fraction_build_price` float(5,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `uni1_alliance_fractions`
--

INSERT INTO `uni1_alliance_fractions` (`ally_fraction_id`, `ally_fraction_armement`, `ally_fraction_in_armement`, `ally_fraction_in_armor`, `ally_fraction_in_shields`, `ally_fraction_fleet_speed`, `ally_fraction_thief_resource`, `ally_fraction_combat_exp_pla`, `ally_fraction_teleporter`, `ally_fraction_def_debris`, `ally_fraction_defense_restore`, `ally_fraction_armor`, `ally_fraction_shields`, `ally_fraction_fleet_capa`, `ally_fraction_fuel`, `ally_fraction_upgrade_acti`, `ally_fraction_combat_exp_expe`, `ally_fraction_ally_point`, `ally_fraction_resource_prod`, `ally_fraction_energy_prod`, `ally_fraction_upgrade_find`, `ally_fraction_resource_after_fight`, `ally_fraction_peace_exp`, `ally_fraction_expe_speed`, `ally_fraction_fleet_price`, `ally_fraction_research_price`, `ally_fraction_defe_price`, `ally_fraction_build_price`) VALUES
(1, 0.00, 2, 0, 0, 2, 0.6, 2, 5, 0, 0, 0, 0, 2, -0.8, 0, 0, 0, 0, 0, 0, 0, 0, 0, -0.20, 0.00, 0.00, 0.00),
(2, 0.50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.5, 0.5, 0, 0, 0.08, 2, 4, 0, 0, 0, 0, 0, 2, 0.00, -0.50, 0.00, 0.00),
(3, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 2, 0, 0.6, 3, 0, 0.00, 0.00, -0.30, -0.10);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_alliance_ranks`
--

CREATE TABLE `uni1_alliance_ranks` (
  `rankID` int(11) NOT NULL,
  `rankName` varchar(32) NOT NULL,
  `allianceID` int(10) UNSIGNED NOT NULL,
  `MEMBERLIST` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ONLINESTATE` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `TRANSFER` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `SEEAPPLY` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `MANAGEAPPLY` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ROUNDMAIL` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ADMIN` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `KICK` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `DIPLOMATIC` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `RANKS` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `MANAGEUSERS` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `EVENTS` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `BANK` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `BANKISSUE` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `PLANETS` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_alliance_request`
--

CREATE TABLE `uni1_alliance_request` (
  `applyID` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `allianceID` int(10) UNSIGNED NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_amtracker`
--

CREATE TABLE `uni1_amtracker` (
  `trackId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tmpAntimatter` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `newAntimatter` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `trackDifference` bigint(20) NOT NULL DEFAULT '0',
  `trackTime` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_antimatter_use`
--

CREATE TABLE `uni1_antimatter_use` (
  `useID` int(11) UNSIGNED NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `direction` varchar(60) NOT NULL DEFAULT '',
  `am_used` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_api_blocked`
--

CREATE TABLE `uni1_api_blocked` (
  `blockId` int(11) UNSIGNED NOT NULL,
  `keyBlocked` varchar(255) DEFAULT NULL,
  `blockUntil` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_api_calls`
--

CREATE TABLE `uni1_api_calls` (
  `callId` int(11) UNSIGNED NOT NULL,
  `apiKey` varchar(32) DEFAULT NULL,
  `callIp` varchar(255) DEFAULT NULL,
  `callHostname` varchar(255) DEFAULT NULL,
  `callTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `keyBlocked` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ipBlocked` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_auctions_active`
--

CREATE TABLE `uni1_auctions_active` (
  `auctionId` int(11) UNSIGNED NOT NULL,
  `itemId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `startTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `endTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `actualBid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `amountBid` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `highestBidder` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `bidCount` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `giftSend` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `isChanged` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `cronjobEnd` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `auctionPage` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `timesIncreased` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_auctions_active_log`
--

CREATE TABLE `uni1_auctions_active_log` (
  `auctionid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `metal_bid` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `crystal_bid` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `deuterium_bid` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `total_bid` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `auctionPage` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `timestamp` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_auctions_used`
--

CREATE TABLE `uni1_auctions_used` (
  `useID` int(11) UNSIGNED NOT NULL,
  `playerID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `timestamp` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `beginTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `endTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `itemID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `elementID` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_auto_expedition`
--

CREATE TABLE `uni1_auto_expedition` (
  `autoId` int(11) UNSIGNED NOT NULL,
  `userId` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `planetId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `templateType` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `isActive` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `waveCount` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `waveSpeed` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `waveHours` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `waveArray` text,
  `lastSend` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_banned`
--

CREATE TABLE `uni1_banned` (
  `id` int(11) UNSIGNED NOT NULL,
  `who` varchar(64) NOT NULL DEFAULT '',
  `theme` varchar(500) NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `longer` int(11) NOT NULL DEFAULT '0',
  `author` varchar(64) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `universe` tinyint(3) UNSIGNED NOT NULL,
  `isChat` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_blacklist`
--

CREATE TABLE `uni1_blacklist` (
  `blackId` int(11) UNSIGNED NOT NULL,
  `blackText` varchar(255) DEFAULT NULL,
  `blackTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `blackBy` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_blocklist`
--

CREATE TABLE `uni1_blocklist` (
  `blockID` int(11) UNSIGNED NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `blockedID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `reason` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_buddy`
--

CREATE TABLE `uni1_buddy` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `owner` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `universe` tinyint(3) UNSIGNED NOT NULL,
  `buddyType` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `isAccepted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_buddy_request`
--

CREATE TABLE `uni1_buddy_request` (
  `id` int(11) UNSIGNED NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_bunker_log`
--

CREATE TABLE `uni1_bunker_log` (
  `logID` int(11) NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `message` text CHARACTER SET utf8,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_chat`
--

CREATE TABLE `uni1_chat` (
  `messageid` bigint(20) UNSIGNED NOT NULL,
  `user` text COMMENT 'Chat message user name',
  `iduser` int(11) NOT NULL DEFAULT '0',
  `message` text,
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `ally_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_chat_online`
--

CREATE TABLE `uni1_chat_online` (
  `id` int(11) NOT NULL,
  `username` text CHARACTER SET utf8 NOT NULL,
  `last_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_chat_online_ally`
--

CREATE TABLE `uni1_chat_online_ally` (
  `id` int(11) NOT NULL,
  `username` text CHARACTER SET utf8 NOT NULL,
  `last_time` int(11) NOT NULL,
  `ally_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_chat_rooms`
--

CREATE TABLE `uni1_chat_rooms` (
  `id` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `name_owner` varchar(30) CHARACTER SET utf8 NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(60) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_chat_rooms_messages`
--

CREATE TABLE `uni1_chat_rooms_messages` (
  `messageid` bigint(20) UNSIGNED NOT NULL,
  `user` text CHARACTER SET utf8 COMMENT 'Chat message user name',
  `iduser` int(11) NOT NULL DEFAULT '0',
  `message` text CHARACTER SET utf8,
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `room_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_chat_rooms_online`
--

CREATE TABLE `uni1_chat_rooms_online` (
  `id` int(11) NOT NULL,
  `username` text CHARACTER SET utf8 NOT NULL,
  `last_time` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_comments`
--

CREATE TABLE `uni1_comments` (
  `id` int(8) NOT NULL,
  `Userid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `rid` varchar(128) NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `likeCount` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `likeinfo` text,
  `replyToComment` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `flagAmount` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `flagInfo` text,
  `isApprouved` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_config`
--

CREATE TABLE `uni1_config` (
  `uni` int(11) NOT NULL,
  `VERSION` varchar(8) NOT NULL,
  `sql_revision` int(11) NOT NULL DEFAULT '0',
  `users_amount` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `game_speed` bigint(20) UNSIGNED NOT NULL DEFAULT '2500',
  `fleet_speed` bigint(20) UNSIGNED NOT NULL DEFAULT '2500',
  `resource_multiplier` smallint(5) UNSIGNED NOT NULL DEFAULT '1',
  `halt_speed` smallint(5) UNSIGNED NOT NULL DEFAULT '1',
  `Fleet_Cdr` tinyint(3) UNSIGNED NOT NULL DEFAULT '30',
  `Defs_Cdr` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `initial_fields` smallint(5) UNSIGNED NOT NULL DEFAULT '163',
  `uni_name` varchar(30) NOT NULL,
  `game_name` varchar(30) NOT NULL,
  `game_disable` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `close_reason` text NOT NULL,
  `metal_basic_income` int(11) NOT NULL DEFAULT '20',
  `crystal_basic_income` int(11) NOT NULL DEFAULT '10',
  `deuterium_basic_income` int(11) NOT NULL DEFAULT '0',
  `darkmatter_basic_income` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `energy_basic_income` int(11) NOT NULL DEFAULT '0',
  `LastSettedGalaxyPos` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `LastSettedSystemPos` smallint(5) UNSIGNED NOT NULL DEFAULT '1',
  `LastSettedPlanetPos` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `noobprotection` int(11) NOT NULL DEFAULT '0',
  `noobprotectiontime` bigint(20) NOT NULL DEFAULT '5000',
  `noobprotectionmulti` int(11) NOT NULL DEFAULT '5',
  `forum_url` varchar(128) NOT NULL DEFAULT 'http://2moons.cc',
  `adm_attack` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `debug` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `lang` varchar(2) NOT NULL DEFAULT '',
  `stat` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `stat_level` tinyint(3) UNSIGNED NOT NULL DEFAULT '2',
  `stat_last_update` int(11) NOT NULL DEFAULT '0',
  `stat_settings` int(11) UNSIGNED NOT NULL DEFAULT '1000',
  `stat_update_time` tinyint(3) UNSIGNED NOT NULL DEFAULT '25',
  `stat_last_db_update` int(11) NOT NULL DEFAULT '0',
  `stats_fly_lock` int(11) NOT NULL DEFAULT '0',
  `cron_lock` int(11) NOT NULL DEFAULT '0',
  `ts_modon` tinyint(1) NOT NULL DEFAULT '0',
  `ts_server` varchar(64) NOT NULL DEFAULT '',
  `ts_tcpport` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `ts_udpport` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `ts_timeout` tinyint(1) NOT NULL DEFAULT '1',
  `ts_version` tinyint(1) NOT NULL DEFAULT '2',
  `ts_cron_last` int(11) NOT NULL DEFAULT '0',
  `ts_cron_interval` smallint(5) NOT NULL DEFAULT '5',
  `ts_login` varchar(32) NOT NULL DEFAULT '',
  `ts_password` varchar(32) NOT NULL DEFAULT '',
  `reg_closed` tinyint(1) NOT NULL DEFAULT '0',
  `OverviewNewsFrame` tinyint(1) NOT NULL DEFAULT '1',
  `OverviewNewsText` text NOT NULL,
  `capaktiv` tinyint(1) NOT NULL DEFAULT '0',
  `cappublic` varchar(42) NOT NULL DEFAULT '',
  `capprivate` varchar(42) NOT NULL DEFAULT '',
  `min_build_time` tinyint(2) NOT NULL DEFAULT '1',
  `mail_active` tinyint(1) NOT NULL DEFAULT '0',
  `mail_use` tinyint(1) NOT NULL DEFAULT '0',
  `smtp_host` varchar(64) NOT NULL DEFAULT '',
  `smtp_port` smallint(5) NOT NULL DEFAULT '0',
  `smtp_user` varchar(64) NOT NULL DEFAULT '',
  `smtp_pass` varchar(32) NOT NULL DEFAULT '',
  `smtp_ssl` enum('','ssl','tls') NOT NULL DEFAULT '',
  `smtp_sendmail` varchar(64) NOT NULL DEFAULT '',
  `smail_path` varchar(30) NOT NULL DEFAULT '/usr/sbin/sendmail',
  `user_valid` tinyint(1) NOT NULL DEFAULT '0',
  `fb_on` tinyint(1) NOT NULL DEFAULT '0',
  `fb_apikey` varchar(42) NOT NULL DEFAULT '',
  `fb_skey` varchar(42) NOT NULL DEFAULT '',
  `ga_active` varchar(42) NOT NULL DEFAULT '0',
  `ga_key` varchar(42) NOT NULL DEFAULT '',
  `moduls` varchar(100) NOT NULL DEFAULT '',
  `trade_allowed_ships` varchar(255) NOT NULL DEFAULT '202,401',
  `trade_charge` varchar(5) NOT NULL DEFAULT '30',
  `chat_closed` tinyint(1) NOT NULL DEFAULT '0',
  `chat_allowchan` tinyint(1) NOT NULL DEFAULT '1',
  `chat_allowmes` tinyint(1) NOT NULL DEFAULT '1',
  `chat_allowdelmes` tinyint(1) NOT NULL DEFAULT '1',
  `chat_logmessage` tinyint(1) NOT NULL DEFAULT '1',
  `chat_nickchange` tinyint(1) NOT NULL DEFAULT '1',
  `chat_botname` varchar(15) NOT NULL DEFAULT '2Moons',
  `chat_channelname` varchar(15) NOT NULL DEFAULT '2Moons',
  `chat_socket_active` tinyint(1) NOT NULL DEFAULT '0',
  `chat_socket_host` varchar(64) NOT NULL DEFAULT '',
  `chat_socket_ip` varchar(40) NOT NULL DEFAULT '',
  `chat_socket_port` smallint(5) NOT NULL DEFAULT '0',
  `chat_socket_chatid` tinyint(1) NOT NULL DEFAULT '1',
  `max_galaxy` tinyint(3) UNSIGNED NOT NULL DEFAULT '9',
  `max_system` smallint(5) UNSIGNED NOT NULL DEFAULT '400',
  `max_planets` tinyint(3) UNSIGNED NOT NULL DEFAULT '15',
  `planet_factor` float(2,1) NOT NULL DEFAULT '1.0',
  `max_elements_build` tinyint(3) UNSIGNED NOT NULL DEFAULT '5',
  `max_elements_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '2',
  `max_elements_ships` tinyint(3) UNSIGNED NOT NULL DEFAULT '10',
  `min_player_planets` tinyint(3) UNSIGNED NOT NULL DEFAULT '9',
  `planets_tech` tinyint(4) NOT NULL DEFAULT '11',
  `planets_officier` tinyint(4) NOT NULL DEFAULT '5',
  `planets_per_tech` float(2,1) NOT NULL DEFAULT '0.5',
  `max_fleet_per_build` bigint(20) UNSIGNED NOT NULL DEFAULT '1000000',
  `deuterium_cost_galaxy` int(11) UNSIGNED NOT NULL DEFAULT '10',
  `max_dm_missions` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `max_overflow` float(2,1) NOT NULL DEFAULT '1.0',
  `moon_factor` float(2,1) NOT NULL DEFAULT '1.0',
  `moon_chance` tinyint(3) UNSIGNED NOT NULL DEFAULT '20',
  `darkmatter_cost_trader` int(11) UNSIGNED NOT NULL DEFAULT '750',
  `factor_university` tinyint(3) UNSIGNED NOT NULL DEFAULT '8',
  `max_fleets_per_acs` tinyint(3) UNSIGNED NOT NULL DEFAULT '16',
  `debris_moon` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `vmode_min_time` int(11) NOT NULL DEFAULT '259200',
  `gate_wait_time` int(11) NOT NULL DEFAULT '3600',
  `metal_start` int(11) UNSIGNED NOT NULL DEFAULT '500',
  `crystal_start` int(11) UNSIGNED NOT NULL DEFAULT '500',
  `deuterium_start` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `darkmatter_start` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `antimatter_start` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ttf_file` varchar(128) NOT NULL DEFAULT 'styles/resource/fonts/DroidSansMono.ttf',
  `ref_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ref_bonus` int(11) UNSIGNED NOT NULL DEFAULT '1000',
  `ref_bonus1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ref_minpoints` bigint(20) UNSIGNED NOT NULL DEFAULT '2000',
  `ref_max_referals` tinyint(1) UNSIGNED NOT NULL DEFAULT '5',
  `del_oldstuff` tinyint(3) UNSIGNED NOT NULL DEFAULT '3',
  `del_user_manually` tinyint(3) UNSIGNED NOT NULL DEFAULT '7',
  `del_user_automatic` tinyint(3) UNSIGNED NOT NULL DEFAULT '30',
  `del_user_sendmail` tinyint(3) UNSIGNED NOT NULL DEFAULT '21',
  `sendmail_inactive` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `silo_factor` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `timezone` varchar(32) NOT NULL DEFAULT 'Europe/London',
  `dst` enum('0','1','2') NOT NULL DEFAULT '2',
  `energySpeed` smallint(6) NOT NULL DEFAULT '1',
  `disclamerAddress` text NOT NULL,
  `disclamerPhone` text NOT NULL,
  `disclamerMail` text NOT NULL,
  `disclamerNotice` text NOT NULL,
  `alliance_create_min_points` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `donation_bonus` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `special_donation_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `special_donation_amount` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `special_donation_percent` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `special_donation_up` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `x_donation_inter` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `x_donation_xsolla` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `red_button` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `new_year_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `cosmonaute_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `halloween_event` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `special_donation_academy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `special_donation_premium` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `special_donation_stardust` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `asteroid_event` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `asteroid_metal` bigint(20) UNSIGNED NOT NULL DEFAULT '20000000000',
  `asteroid_crystal` bigint(20) UNSIGNED NOT NULL DEFAULT '15000000000',
  `asteroid_deuterium` bigint(20) UNSIGNED NOT NULL DEFAULT '7500000000',
  `asteroidRound` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `referal_event` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `question_event` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `social_event` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `support_auto` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `timeRewardFrom` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `timeRewardTo` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `timeReward` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `peacefullExp` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `combatExp` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `auctioneer_next` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auctioneer_closure` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `lottery_time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `lottery_min` int(11) UNSIGNED NOT NULL DEFAULT '15',
  `lottery_prize` int(11) UNSIGNED NOT NULL DEFAULT '1000000',
  `lottery_time_am` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `lottery_min_am` int(11) UNSIGNED NOT NULL DEFAULT '20',
  `lottery_prize_am` int(11) UNSIGNED NOT NULL DEFAULT '25000',
  `primebuild` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `collider_promo` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `alloEvent` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ap_don` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auctionExpe` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `darkmatter_reduc` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `cronInstant` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `cronInstantStep` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `cronBot` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `domain` varchar(32) NOT NULL DEFAULT 'space',
  `endCompetition` int(11) UNSIGNED NOT NULL DEFAULT '1473274800',
  `admin_name` text NOT NULL,
  `admin_email` text NOT NULL,
  `site_logo` text NOT NULL,
  `site_favicon` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_descrip` text NOT NULL,
  `openingDate` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `totalRevenue` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `CampaingStart` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `CampaingEnd` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `expe_chance_res` float(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `expe_chance_dark` float(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `expe_chance_fleets` float(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `expe_chance_hostile` float(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `expe_chance_hole` float(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `expe_chance_change` float(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `expe_chance_converter` float(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `expe_chance_arsenal` float(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `expe_fleet_arsenal` bigint(20) UNSIGNED NOT NULL DEFAULT '75000',
  `expe_minPoint_fleet` bigint(20) UNSIGNED NOT NULL DEFAULT '10',
  `happyHourEvent` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `happyHourTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `happyHourBonus` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `proxyConfig` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `proxyAlert` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `proxyBlock` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `xteriumAllyId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `xteriumPoints` double(50,0) UNSIGNED NOT NULL DEFAULT '50000000',
  `tourneyEnd` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `suprimoEvent` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `firstDonationEvent` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `dmRefundEvent` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenalUpdate` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `allianceDevelopBOnus` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `voucherCount` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `expeDmBonus` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `expeFleetBonus` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auctionerItems` tinyint(3) UNSIGNED NOT NULL DEFAULT '3',
  `arsenalHostil` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `domain_name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uni1_config`
--

INSERT INTO `uni1_config` (`uni`, `VERSION`, `sql_revision`, `users_amount`, `game_speed`, `fleet_speed`, `resource_multiplier`, `halt_speed`, `Fleet_Cdr`, `Defs_Cdr`, `initial_fields`, `uni_name`, `game_name`, `game_disable`, `close_reason`, `metal_basic_income`, `crystal_basic_income`, `deuterium_basic_income`, `darkmatter_basic_income`, `energy_basic_income`, `LastSettedGalaxyPos`, `LastSettedSystemPos`, `LastSettedPlanetPos`, `noobprotection`, `noobprotectiontime`, `noobprotectionmulti`, `forum_url`, `adm_attack`, `debug`, `lang`, `stat`, `stat_level`, `stat_last_update`, `stat_settings`, `stat_update_time`, `stat_last_db_update`, `stats_fly_lock`, `cron_lock`, `ts_modon`, `ts_server`, `ts_tcpport`, `ts_udpport`, `ts_timeout`, `ts_version`, `ts_cron_last`, `ts_cron_interval`, `ts_login`, `ts_password`, `reg_closed`, `OverviewNewsFrame`, `OverviewNewsText`, `capaktiv`, `cappublic`, `capprivate`, `min_build_time`, `mail_active`, `mail_use`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `smtp_ssl`, `smtp_sendmail`, `smail_path`, `user_valid`, `fb_on`, `fb_apikey`, `fb_skey`, `ga_active`, `ga_key`, `moduls`, `trade_allowed_ships`, `trade_charge`, `chat_closed`, `chat_allowchan`, `chat_allowmes`, `chat_allowdelmes`, `chat_logmessage`, `chat_nickchange`, `chat_botname`, `chat_channelname`, `chat_socket_active`, `chat_socket_host`, `chat_socket_ip`, `chat_socket_port`, `chat_socket_chatid`, `max_galaxy`, `max_system`, `max_planets`, `planet_factor`, `max_elements_build`, `max_elements_tech`, `max_elements_ships`, `min_player_planets`, `planets_tech`, `planets_officier`, `planets_per_tech`, `max_fleet_per_build`, `deuterium_cost_galaxy`, `max_dm_missions`, `max_overflow`, `moon_factor`, `moon_chance`, `darkmatter_cost_trader`, `factor_university`, `max_fleets_per_acs`, `debris_moon`, `vmode_min_time`, `gate_wait_time`, `metal_start`, `crystal_start`, `deuterium_start`, `darkmatter_start`, `antimatter_start`, `ttf_file`, `ref_active`, `ref_bonus`, `ref_bonus1`, `ref_minpoints`, `ref_max_referals`, `del_oldstuff`, `del_user_manually`, `del_user_automatic`, `del_user_sendmail`, `sendmail_inactive`, `silo_factor`, `timezone`, `dst`, `energySpeed`, `disclamerAddress`, `disclamerPhone`, `disclamerMail`, `disclamerNotice`, `alliance_create_min_points`, `donation_bonus`, `special_donation_status`, `special_donation_amount`, `special_donation_percent`, `special_donation_up`, `x_donation_inter`, `x_donation_xsolla`, `red_button`, `new_year_status`, `cosmonaute_status`, `halloween_event`, `special_donation_academy`, `special_donation_premium`, `special_donation_stardust`, `asteroid_event`, `asteroid_metal`, `asteroid_crystal`, `asteroid_deuterium`, `asteroidRound`, `referal_event`, `question_event`, `social_event`, `support_auto`, `timeRewardFrom`, `timeRewardTo`, `timeReward`, `peacefullExp`, `combatExp`, `auctioneer_next`, `auctioneer_closure`, `lottery_time`, `lottery_min`, `lottery_prize`, `lottery_time_am`, `lottery_min_am`, `lottery_prize_am`, `primebuild`, `collider_promo`, `alloEvent`, `ap_don`, `auctionExpe`, `darkmatter_reduc`, `cronInstant`, `cronInstantStep`, `cronBot`, `domain`, `endCompetition`, `admin_name`, `admin_email`, `site_logo`, `site_favicon`, `meta_title`, `meta_descrip`, `openingDate`, `totalRevenue`, `CampaingStart`, `CampaingEnd`, `expe_chance_res`, `expe_chance_dark`, `expe_chance_fleets`, `expe_chance_hostile`, `expe_chance_hole`, `expe_chance_change`, `expe_chance_converter`, `expe_chance_arsenal`, `expe_fleet_arsenal`, `expe_minPoint_fleet`, `happyHourEvent`, `happyHourTime`, `happyHourBonus`, `proxyConfig`, `proxyAlert`, `proxyBlock`, `xteriumAllyId`, `xteriumPoints`, `tourneyEnd`, `suprimoEvent`, `firstDonationEvent`, `dmRefundEvent`, `arsenalUpdate`, `allianceDevelopBOnus`, `voucherCount`, `expeDmBonus`, `expeFleetBonus`, `auctionerItems`, `arsenalHostil`, `domain_name`) VALUES
(1, '1.7.git', 0, 565, 25000000, 30000, 8000, 5, 50, 0, 325, 'WOG2', 'War Of Galaxyz', 1, 'We are switching to a more powerfull server !', 0, 0, 0, 0, 0, 4, 63, 3, 1, 1000000000000000, 5, 'http://forum.warofgalaxyz.com', 1, 0, 'en', 2, 2, 1532119621, 1000000, 25, 0, 0, 0, 0, '', 0, 0, 1, 2, 0, 5, '', '', 1, 1, 'Dear players,\n\nMost of the source code of the game has been modified to release in the coming months a native android application.\nAll acounts have been credited with 5.000.000 antimatter.\nA new login portal will be displayed in the night.\nAll accounts still in vacation mode on the 30/07/2018 will be deleted.\n\nA new contest with prize pool will start soon. #StayTuned', 0, '', '', 0, 1, 0, 'mail.warofgalaxyz.com', 465, 'info@warofgalaxyz.com', 'aOqj$29HG3ipangk', '', 'info@warofgalaxyz.com', '/usr/sbin/sendmail', 1, 0, '', '', '0', '', '1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;0;1;1;1;1', '202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422', '40', 0, 1, 1, 0, 1, 1, '2Moons', '2Moons', 0, '', '', 0, 1, 7, 200, 20, 1.0, 5, 1, 10, 9, 15, 0, 0.5, 50000000, 0, 4, 1.0, 1.0, 20, 250, 16, 16, 0, 86400, 3600, 5000000, 5000000, 5000000, 50000, 0, 'styles/resource/fonts/DroidSansMono.ttf', 1, 500000000, 50000, 500000000, 5, 3, 7, 30, 21, 0, 1, 'Europe/Brussels', '0', 1, '', '', '', '', 2500000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1532071501, 1000000000000, 500000000000, 0, 0, 1518722701, 1518952809, 1518631203, 1, 1525280400, 1525284000, 0, 0, 0, 1532117161, 1, 1455812276, 20, 50000, 1532189044, 20, 15000, 0, 0, 0, 0, 0, 0, 1530919802, 9, 1472484302, 'com', 1473274800, 'Thisishowwedoit', 'support@warofgalaxyz.com', '', '', '', '', 0, 0, 0, 1501797600, 100.00, 100.00, 100.00, 100.00, 5.00, 100.00, 100.00, 100.00, 75000, 10, 9, 1524906001, 2, 1, 0, 0, 1, 10000000000, 1532231101, 1531929001, 0, 1509836340, 1000, 0, 0, 0, 0, 3, 0, 'my_game_url.com');

-- --------------------------------------------------------

--
-- Structure de la table `uni1_cronjobs`
--

CREATE TABLE `uni1_cronjobs` (
  `cronjobID` int(11) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `min` varchar(120) NOT NULL,
  `hours` varchar(64) NOT NULL,
  `dom` varchar(64) NOT NULL,
  `month` varchar(32) NOT NULL,
  `dow` varchar(32) NOT NULL,
  `class` varchar(32) NOT NULL,
  `nextTime` int(11) DEFAULT NULL,
  `lock` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uni1_cronjobs`
--

INSERT INTO `uni1_cronjobs` (`cronjobID`, `name`, `isActive`, `min`, `hours`, `dom`, `month`, `dow`, `class`, `nextTime`, `lock`) VALUES
(1, 'referral', 1, '5,35', '*', '*', '*', '*', 'ReferralCronjob', 1532120700, NULL),
(2, 'statistic', 1, '*/15', '*', '*', '*', '*', 'StatisticCronjob', 1532120400, NULL),
(9, 'Instant Build Reset', 0, '10,12,14,16,18,20,22,24,26,28', '1', '*', '*', '*', 'InstantCronjob', 1531437000, '264764fc1bcd757cbb27bd7f72ad3821'),
(10, 'Asteroid Event', 1, '45', '21', '1,3,5,7,9,11,13,15,17,19,21,23,25,27,28,29,31', '*', '*', 'AsteroidCronjob', 1532202300, NULL),
(14, 'Auctioneer Restart', 1, '1', '*', '*', '*', '*', 'AuctioneerCronjob', 1532120460, NULL),
(15, 'Stats History', 1, '58', '2', '*', '*', '*', 'StatHistoryCronjob', 1531616280, '7061e98e9726235668e67e3adb5636d9'),
(18, 'Market Help', 0, '34', '4', '*', '*', '2,6', 'marketItemsCronjob', 1531535640, NULL),
(19, 'SendData', 1, '*/5', '*', '*', '*', '*', 'OnlinecountCronjob', 1532120400, NULL),
(21, 'Premium Notifications', 1, '48', '*', '*', '*', '*', 'notificationPremiumCronjob', 1532123280, NULL),
(22, 'Asteroid Event 2', 1, '20', '9', '2,4,6,8,10,12,14,16,18,20,22,24,26,28,30', '*', '*', 'AsteroidCronjob', 1532244000, NULL),
(23, 'Happy Hour', 0, '0', '12', '*', '*', '*', 'happyHourCronjob', 1531476000, NULL),
(24, 'Dm Refund', 0, '35', '19', '*', '*', '*', 'DmrefundCronjob', 1531416900, NULL),
(25, 'GalaxyCheck', 1, '10,40', '*', '*', '*', '*', 'GalaxySevenCheckCronjob', 1532121000, NULL),
(26, 'GalaxyAdd', 1, '12,42', '*', '*', '*', '*', 'GalaxySevenCronjob', 1532121120, NULL),
(27, 'Planet Sales', 1, '*/30', '*', '*', '*', '*', 'planetSalesCronjob', 1532120400, NULL),
(28, 'Tournaments', 1, '45', '5', '*', '*', '*', 'TournamentCronjob', 1532144700, NULL),
(29, 'SuprimusEvent', 1, '45', '17', '3,8,13,18,23,28', '*', '*', 'suprimoCronjob', 1532360700, NULL),
(30, 'Auto Expo Module', 1, '*/2', '*', '*', '*', '*', 'AutoExpoCronjob', 1532120400, NULL),
(31, 'Adsense News', 0, '50', '17', '*', '*', '*', 'AdsenseCronjob', 1531497000, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_cronjobs_log`
--

CREATE TABLE `uni1_cronjobs_log` (
  `cronjobId` int(11) UNSIGNED NOT NULL,
  `executionTime` datetime NOT NULL,
  `lockToken` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_darkmatter_logs`
--

CREATE TABLE `uni1_darkmatter_logs` (
  `darkId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `darkAmount` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `timestamp` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_diplo`
--

CREATE TABLE `uni1_diplo` (
  `id` int(11) UNSIGNED NOT NULL,
  `owner_1` int(11) UNSIGNED NOT NULL,
  `owner_2` int(11) UNSIGNED NOT NULL,
  `level` tinyint(1) UNSIGNED NOT NULL,
  `accept` tinyint(1) UNSIGNED NOT NULL,
  `accept_text` varchar(255) NOT NULL,
  `universe` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_easyresourceadd`
--

CREATE TABLE `uni1_easyresourceadd` (
  `addId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `metal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `crystal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `deuterium` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `ticketId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `claimed` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `addedBy` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_emails`
--

CREATE TABLE `uni1_emails` (
  `email` varchar(500) NOT NULL,
  `username` text NOT NULL,
  `language` varchar(32) NOT NULL,
  `isSend` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `loggedSince` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_fleetdealer_log`
--

CREATE TABLE `uni1_fleetdealer_log` (
  `sellID` int(11) UNSIGNED NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fleetID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `planetID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fleetAmount` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_fleets`
--

CREATE TABLE `uni1_fleets` (
  `fleet_id` bigint(11) UNSIGNED NOT NULL,
  `fleet_owner` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_mission` tinyint(3) UNSIGNED NOT NULL DEFAULT '3',
  `fleet_amount` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_array` text,
  `fleet_universe` tinyint(3) UNSIGNED NOT NULL,
  `fleet_start_time` int(11) NOT NULL DEFAULT '0',
  `fleet_start_id` int(11) UNSIGNED NOT NULL,
  `fleet_start_galaxy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_start_system` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_start_planet` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_start_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `fleet_end_time` int(11) NOT NULL DEFAULT '0',
  `fleet_end_stay` int(11) NOT NULL DEFAULT '0',
  `fleet_end_id` int(11) UNSIGNED NOT NULL,
  `fleet_end_galaxy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_end_system` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_end_planet` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_end_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `fleet_target_obj` smallint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_resource_metal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_resource_crystal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_resource_deuterium` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_resource_darkmatter` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_target_owner` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_group` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_mess` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `start_time` int(11) DEFAULT NULL,
  `fleet_busy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `hasCanceled` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ally_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `sirena` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `sector` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `isdisplayedtable` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_fleetstats`
--

CREATE TABLE `uni1_fleetstats` (
  `universe` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `attack` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `attackAcs` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `defendAcs` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `expedition` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `transport` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `deployement` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `spy` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `colonisation` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `recycle` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `destroy` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `missile` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `expeditionDm` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `asteroids` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `hostile` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `capture` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `surpriseme` double(50,0) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `uni1_fleetstats`
--

INSERT INTO `uni1_fleetstats` (`universe`, `attack`, `attackAcs`, `defendAcs`, `expedition`, `transport`, `deployement`, `spy`, `colonisation`, `recycle`, `destroy`, `missile`, `expeditionDm`, `asteroids`, `hostile`, `capture`, `surpriseme`) VALUES
(1, 21080, 5, 998, 921816, 152665, 106329, 92599, 6020, 9388, 346, 110, 1039, 24472, 1126842, 2876, 1829);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_fleet_event`
--

CREATE TABLE `uni1_fleet_event` (
  `fleetID` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `lock` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_fleet_groups`
--

CREATE TABLE `uni1_fleet_groups` (
  `groupId` int(11) NOT NULL,
  `groupName` varchar(255) NOT NULL DEFAULT '',
  `ownerId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fleetData` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_freecode`
--

CREATE TABLE `uni1_freecode` (
  `codeID` int(11) NOT NULL,
  `alloCode` varchar(32) NOT NULL,
  `usedTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `usedBy` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_galaxy7_account`
--

CREATE TABLE `uni1_galaxy7_account` (
  `specialId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fleetComsumption` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `flyTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `conveyorLevel` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `stealEnnemie` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `armor` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `attack` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `shield` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `findUpgrade` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `simExpe` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `bonusExpe` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `findStellar` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `resourceProd` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `colliderProd` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `stealingOwn` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `uni1_galaxy7_account`
--

INSERT INTO `uni1_galaxy7_account` (`specialId`, `fleetComsumption`, `flyTime`, `conveyorLevel`, `stealEnnemie`, `armor`, `attack`, `shield`, `findUpgrade`, `simExpe`, `bonusExpe`, `findStellar`, `resourceProd`, `colliderProd`, `stealingOwn`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 25, 0, 0, 0, 0),
(2, 3, 3, 40, 2, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 15, 3),
(4, 0, 0, 25, 0, 0, 0, 0, 0, 0, 0, 0, 35, 25, 0),
(5, 3, 3, 0, 0, 0, 0, 0, 0, 1, 30, 0, 0, 0, 0),
(6, 0, 4, 0, 0, 5, 5, 5, 0, 0, 0, 1, 0, 0, 0),
(7, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(101, 0, 0, 0, 0, 0, 0, 0, 1, 1, 25, 0, 0, 0, 0),
(102, 3, 3, 40, 2, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0),
(103, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 15, 3),
(104, 0, 0, 25, 0, 0, 0, 0, 0, 0, 0, 0, 35, 25, 0),
(105, 3, 3, 0, 0, 0, 0, 0, 0, 1, 30, 0, 0, 0, 0),
(106, 0, 4, 0, 0, 5, 5, 5, 0, 0, 0, 1, 0, 0, 0),
(107, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(108, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(109, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(201, 0, 0, 0, 0, 0, 0, 0, 1, 1, 25, 0, 0, 0, 0),
(202, 3, 3, 40, 2, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0),
(203, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 15, 3),
(204, 0, 0, 25, 0, 0, 0, 0, 0, 0, 0, 0, 35, 25, 0),
(205, 3, 3, 0, 0, 0, 0, 0, 0, 1, 30, 0, 0, 0, 0),
(206, 0, 4, 0, 0, 5, 5, 5, 0, 0, 0, 1, 0, 0, 0),
(207, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(208, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(209, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(301, 0, 0, 0, 0, 0, 0, 0, 1, 1, 25, 0, 0, 0, 0),
(302, 3, 3, 40, 2, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0),
(303, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 15, 3),
(304, 0, 0, 25, 0, 0, 0, 0, 0, 0, 0, 0, 35, 25, 0),
(305, 3, 3, 0, 0, 0, 0, 0, 0, 1, 30, 0, 0, 0, 0),
(306, 0, 4, 0, 0, 5, 5, 5, 0, 0, 0, 1, 0, 0, 0),
(307, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(308, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(309, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(401, 0, 0, 0, 0, 0, 0, 0, 1, 1, 25, 0, 0, 0, 0),
(402, 3, 3, 40, 2, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0),
(403, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 15, 3),
(404, 0, 0, 25, 0, 0, 0, 0, 0, 0, 0, 0, 35, 25, 0),
(405, 3, 3, 0, 0, 0, 0, 0, 0, 1, 30, 0, 0, 0, 0),
(406, 0, 4, 0, 0, 5, 5, 5, 0, 0, 0, 1, 0, 0, 0),
(407, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(408, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(409, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(501, 0, 0, 0, 0, 0, 0, 0, 1, 1, 25, 0, 0, 0, 0),
(502, 3, 3, 40, 2, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0),
(503, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 15, 3),
(504, 0, 0, 25, 0, 0, 0, 0, 0, 0, 0, 0, 35, 25, 0),
(505, 3, 3, 0, 0, 0, 0, 0, 0, 1, 30, 0, 0, 0, 0),
(506, 0, 4, 0, 0, 5, 5, 5, 0, 0, 0, 1, 0, 0, 0),
(507, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(508, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(509, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(601, 0, 0, 0, 0, 0, 0, 0, 1, 1, 25, 0, 0, 0, 0),
(602, 3, 3, 40, 2, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0),
(603, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 15, 3),
(604, 0, 0, 25, 0, 0, 0, 0, 0, 0, 0, 0, 35, 25, 0),
(605, 3, 3, 0, 0, 0, 0, 0, 0, 1, 30, 0, 0, 0, 0),
(606, 0, 4, 0, 0, 5, 5, 5, 0, 0, 0, 1, 0, 0, 0),
(607, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(608, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(609, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(701, 0, 0, 0, 0, 0, 0, 0, 1, 1, 25, 0, 0, 0, 0),
(702, 3, 3, 40, 2, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0),
(703, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 15, 3),
(704, 0, 0, 25, 0, 0, 0, 0, 0, 0, 0, 0, 35, 25, 0),
(705, 3, 3, 0, 0, 0, 0, 0, 0, 1, 30, 0, 0, 0, 0),
(706, 0, 4, 0, 0, 5, 5, 5, 0, 0, 0, 1, 0, 0, 0),
(707, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(708, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(709, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(801, 0, 0, 0, 0, 0, 0, 0, 1, 1, 25, 0, 0, 0, 0),
(802, 3, 3, 40, 2, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0),
(803, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 15, 3),
(804, 0, 0, 25, 0, 0, 0, 0, 0, 0, 0, 0, 35, 25, 0),
(805, 3, 3, 0, 0, 0, 0, 0, 0, 1, 30, 0, 0, 0, 0),
(806, 0, 4, 0, 0, 5, 5, 5, 0, 0, 0, 1, 0, 0, 0),
(807, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(808, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(809, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(901, 0, 0, 0, 0, 0, 0, 0, 1, 1, 25, 0, 0, 0, 0),
(902, 3, 3, 40, 2, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0),
(903, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 15, 3),
(904, 0, 0, 25, 0, 0, 0, 0, 0, 0, 0, 0, 35, 25, 0),
(905, 3, 3, 0, 0, 0, 0, 0, 0, 1, 30, 0, 0, 0, 0),
(906, 0, 4, 0, 0, 5, 5, 5, 0, 0, 0, 1, 0, 0, 0),
(907, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(908, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0),
(909, 0, 0, 0, 0, 25, 25, 25, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_galaxy7_planet`
--

CREATE TABLE `uni1_galaxy7_planet` (
  `specialId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `conveyorBonus` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `darkmatterProd` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `buildM7` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `buildM19` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `buildM32` int(11) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `uni1_galaxy7_planet`
--

INSERT INTO `uni1_galaxy7_planet` (`specialId`, `conveyorBonus`, `darkmatterProd`, `buildM7`, `buildM19`, `buildM32`) VALUES
(1, 10, 100000, 0, 0, 0),
(2, 25, 300000, 0, 0, 0),
(3, 20, 300000, 0, 0, 0),
(4, 30, 2000, 0, 0, 0),
(5, 15, 150000, 0, 0, 0),
(6, 10, 100000, 0, 0, 0),
(7, 5, 0, 1, 0, 0),
(8, 4, 0, 0, 1, 0),
(9, 3, 0, 0, 0, 0),
(101, 10, 100000, 0, 0, 0),
(102, 25, 300000, 0, 0, 0),
(103, 20, 300000, 0, 0, 0),
(104, 30, 200000, 0, 0, 0),
(105, 15, 150000, 0, 0, 0),
(106, 10, 100000, 0, 0, 0),
(107, 5, 0, 1, 0, 0),
(108, 4, 0, 0, 1, 0),
(109, 3, 0, 0, 0, 1),
(201, 10, 100000, 0, 0, 0),
(202, 25, 300000, 0, 0, 0),
(203, 20, 300000, 0, 0, 0),
(204, 30, 200000, 0, 0, 0),
(205, 15, 150000, 0, 0, 0),
(206, 10, 100000, 0, 0, 0),
(207, 5, 0, 1, 0, 0),
(208, 4, 0, 0, 1, 0),
(209, 3, 0, 0, 0, 1),
(301, 10, 100000, 0, 0, 0),
(302, 25, 300000, 0, 0, 0),
(303, 20, 300000, 0, 0, 0),
(304, 30, 200000, 0, 0, 0),
(305, 15, 150000, 0, 0, 0),
(306, 10, 100000, 0, 0, 0),
(307, 5, 0, 1, 0, 0),
(308, 4, 0, 0, 1, 0),
(309, 3, 0, 0, 0, 1),
(401, 10, 100000, 0, 0, 0),
(402, 25, 300000, 0, 0, 0),
(403, 20, 300000, 0, 0, 0),
(404, 30, 200000, 0, 0, 0),
(405, 15, 150000, 0, 0, 0),
(406, 10, 100000, 0, 0, 0),
(407, 5, 0, 1, 0, 0),
(408, 4, 0, 0, 1, 0),
(409, 3, 0, 0, 0, 1),
(501, 10, 100000, 0, 0, 0),
(502, 25, 300000, 0, 0, 0),
(503, 20, 300000, 0, 0, 0),
(504, 30, 200000, 0, 0, 0),
(505, 15, 150000, 0, 0, 0),
(506, 10, 100000, 0, 0, 0),
(507, 5, 0, 1, 0, 0),
(508, 4, 0, 0, 1, 0),
(509, 3, 0, 0, 0, 1),
(601, 10, 100000, 0, 0, 0),
(602, 25, 300000, 0, 0, 0),
(603, 20, 300000, 0, 0, 0),
(604, 30, 200000, 0, 0, 0),
(605, 15, 150000, 0, 0, 0),
(606, 10, 100000, 0, 0, 0),
(607, 5, 0, 1, 0, 0),
(608, 4, 0, 0, 1, 0),
(609, 3, 0, 0, 0, 1),
(701, 10, 100000, 0, 0, 0),
(702, 25, 300000, 0, 0, 0),
(703, 20, 300000, 0, 0, 0),
(704, 30, 200000, 0, 0, 0),
(705, 15, 150000, 0, 0, 0),
(706, 10, 100000, 0, 0, 0),
(707, 5, 0, 1, 0, 0),
(708, 4, 0, 0, 1, 0),
(709, 3, 0, 0, 0, 1),
(801, 10, 100000, 0, 0, 0),
(802, 25, 300000, 0, 0, 0),
(803, 20, 300000, 0, 0, 0),
(804, 30, 200000, 0, 0, 0),
(805, 15, 150000, 0, 0, 0),
(806, 10, 100000, 0, 0, 0),
(807, 5, 0, 1, 0, 0),
(808, 4, 0, 0, 1, 0),
(809, 3, 0, 0, 0, 1),
(901, 10, 100000, 0, 0, 0),
(902, 25, 300000, 0, 0, 0),
(903, 20, 300000, 0, 0, 0),
(904, 30, 200000, 0, 0, 0),
(905, 15, 150000, 0, 0, 0),
(906, 10, 100000, 0, 0, 0),
(907, 5, 0, 1, 0, 0),
(908, 4, 0, 0, 1, 0),
(909, 3, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_gouvernors`
--

CREATE TABLE `uni1_gouvernors` (
  `gouvernorId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorName` text NOT NULL,
  `gouvernorMaxLevel` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorPriceAP` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorPriceAPone` float UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorPriceDM` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorPriceDMOne` float UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorBonusName` text NOT NULL,
  `gouvernorDefault` float UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorBonuslevel` float UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorDivider` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorFactor` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorBonusNameTwo` text NOT NULL,
  `gouvernorDefaultTwo` float UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorBonuslevelTwo` float UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorDividerTwo` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gouvernorFactorTwo` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uni1_gouvernors`
--

INSERT INTO `uni1_gouvernors` (`gouvernorId`, `gouvernorName`, `gouvernorMaxLevel`, `gouvernorPriceAP`, `gouvernorPriceAPone`, `gouvernorPriceDM`, `gouvernorPriceDMOne`, `gouvernorBonusName`, `gouvernorDefault`, `gouvernorBonuslevel`, `gouvernorDivider`, `gouvernorFactor`, `gouvernorBonusNameTwo`, `gouvernorDefaultTwo`, `gouvernorBonuslevelTwo`, `gouvernorDividerTwo`, `gouvernorFactorTwo`) VALUES
(701, 'dm_attack', 65, 50, 1.07, 40000, 1.1, 'Attack', 0.1, 0.01, 1, 100, '', 0, 0, 0, 0),
(702, 'dm_defensive', 65, 50, 1.075, 40000, 1.1, 'Defensive', 0.1, 0.01, 1, 100, 'Shield', 0.1, 0.01, 1, 100),
(703, 'dm_buildtime', 50, 20, 1.1, 7500, 1.08, 'BuildTimeFall', 0.1, 0.01, 1, 100, 'GueueBuild', 0, 1, 25, 1),
(704, 'dm_resource', 250, 100, 1.01, 30000, 1.022, 'Resource', 0.1, 0.01, 1, 100, 'ResourceGeneral', 0, 1, 25, 1),
(705, 'dm_energie', 100, 50, 1.022, 10000, 1.055, 'Energy', 0.1, 0.01, 1, 100, 'EnergyGeneral', 0, 1, 25, 1),
(706, 'dm_researchtime', 40, 100, 1.12, 25000, 1.14, 'ResearchTimeFall', 0.1, 0.01, 1, 100, 'GueueTech', 0, 1, 20, 1),
(707, 'dm_fleettime', 40, 100, 1.13, 50000, 1.15, 'FlyTime', 0.1, 0.01, 1, 100, '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_ip_multimod`
--

CREATE TABLE `uni1_ip_multimod` (
  `suspectId` int(11) NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `nickname` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(60) NOT NULL DEFAULT '',
  `ipadress` varchar(40) NOT NULL DEFAULT '',
  `opsystem` varchar(500) CHARACTER SET utf16 NOT NULL DEFAULT '',
  `isp` varchar(500) NOT NULL DEFAULT '',
  `proxies` varchar(500) NOT NULL DEFAULT '',
  `isValid` text,
  `timestamp` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_log`
--

CREATE TABLE `uni1_log` (
  `id` int(11) UNSIGNED NOT NULL,
  `mode` tinyint(3) UNSIGNED NOT NULL,
  `admin` int(11) UNSIGNED NOT NULL,
  `target` int(11) NOT NULL,
  `time` int(11) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `universe` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_log_fleets`
--

CREATE TABLE `uni1_log_fleets` (
  `fleet_id` bigint(11) UNSIGNED NOT NULL,
  `fleet_owner` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_mission` tinyint(3) UNSIGNED NOT NULL DEFAULT '3',
  `fleet_amount` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_array` text,
  `fleet_universe` tinyint(3) UNSIGNED NOT NULL,
  `fleet_start_time` int(11) NOT NULL DEFAULT '0',
  `fleet_start_id` int(11) UNSIGNED NOT NULL,
  `fleet_start_galaxy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_start_system` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_start_planet` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_start_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `fleet_end_time` int(11) NOT NULL DEFAULT '0',
  `fleet_end_stay` int(11) NOT NULL DEFAULT '0',
  `fleet_end_id` int(11) UNSIGNED NOT NULL,
  `fleet_end_galaxy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_end_system` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_end_planet` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_end_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `fleet_target_obj` smallint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_resource_metal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_resource_crystal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_resource_deuterium` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_resource_darkmatter` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_target_owner` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_group` varchar(15) NOT NULL DEFAULT '0',
  `fleet_mess` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `start_time` int(11) DEFAULT NULL,
  `fleet_busy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_state` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ally_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `sector` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `expeEvent` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_loteria`
--

CREATE TABLE `uni1_loteria` (
  `ID` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tickets` int(5) NOT NULL,
  `uni` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_loteriaam`
--

CREATE TABLE `uni1_loteriaam` (
  `ID` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `tickets` int(5) NOT NULL,
  `uni` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_loteriaam_log`
--

CREATE TABLE `uni1_loteriaam_log` (
  `username` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `prize` int(11) NOT NULL,
  `uni` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_loteria_log`
--

CREATE TABLE `uni1_loteria_log` (
  `username` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `prize` int(11) NOT NULL,
  `uni` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_memory_usage`
--

CREATE TABLE `uni1_memory_usage` (
  `memoryLog` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `queryString` varchar(1000) DEFAULT NULL,
  `memoryUsed` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_mercenary`
--

CREATE TABLE `uni1_mercenary` (
  `mercenaryId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_messages`
--

CREATE TABLE `uni1_messages` (
  `message_id` bigint(20) UNSIGNED NOT NULL,
  `message_owner` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `message_sender` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `message_time` int(11) NOT NULL DEFAULT '0',
  `message_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `message_from` varchar(128) DEFAULT NULL,
  `message_subject` varchar(255) DEFAULT NULL,
  `message_text` text,
  `message_unread` tinyint(4) NOT NULL DEFAULT '1',
  `message_universe` tinyint(3) UNSIGNED NOT NULL,
  `message_deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `probe_array` text,
  `circularPriority` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `messageTranslated` text,
  `oldType` int(11) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_multi`
--

CREATE TABLE `uni1_multi` (
  `multiID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_notes`
--

CREATE TABLE `uni1_notes` (
  `id` int(11) NOT NULL,
  `owner` int(11) UNSIGNED DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `priority` tinyint(1) UNSIGNED DEFAULT '1',
  `title` varchar(32) DEFAULT NULL,
  `text` text,
  `universe` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_notifications`
--

CREATE TABLE `uni1_notifications` (
  `notifId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `timestamp` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `noText` varchar(255) CHARACTER SET utf8 NOT NULL,
  `noImage` varchar(255) DEFAULT '/media/files/avatar_defaut.jpg',
  `isDisplayed` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `isType` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_paysafecards_initiated`
--

CREATE TABLE `uni1_paysafecards_initiated` (
  `logId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `pinPrice` float(15,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `pinCredits` float(15,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `realDonator` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `a1` varchar(500) DEFAULT NULL,
  `mtid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_planetimage`
--

CREATE TABLE `uni1_planetimage` (
  `imageId` varchar(255) NOT NULL DEFAULT '',
  `bonus_metal` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `bonus_crystal` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `bonus_deuterium` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `bonus_energy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `bonus_research` tinyint(3) NOT NULL DEFAULT '0',
  `bonus_conveyors` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uni1_planetimage`
--

INSERT INTO `uni1_planetimage` (`imageId`, `bonus_metal`, `bonus_crystal`, `bonus_deuterium`, `bonus_energy`, `bonus_research`, `bonus_conveyors`) VALUES
('dschjungelplanet01', 2, 0, 3, 0, -3, 0),
('dschjungelplanet02', 2, 0, 3, 0, -3, 0),
('dschjungelplanet03', 2, 0, 3, 0, -3, 0),
('dschjungelplanet04', 2, 0, 3, 0, -3, 0),
('dschjungelplanet05', 2, 0, 3, 0, -3, 0),
('dschjungelplanet06', 2, 0, 3, 0, -3, 0),
('dschjungelplanet07', 2, 0, 3, 0, -3, 0),
('dschjungelplanet08', 2, 0, 3, 0, -3, 0),
('dschjungelplanet09', 2, 0, 3, 0, -3, 0),
('dschjungelplanet10', 2, 0, 3, 0, -3, 0),
('eisplanet01', 2, 4, 2, 1, 0, 0),
('eisplanet02', 2, 4, 2, 1, 0, 0),
('eisplanet03', 2, 4, 2, 1, 0, 0),
('eisplanet04', 2, 4, 2, 1, 0, 0),
('eisplanet05', 2, 4, 2, 1, 0, 0),
('eisplanet06', 2, 4, 2, 1, 0, 0),
('eisplanet07', 2, 4, 2, 1, 0, 0),
('eisplanet08', 2, 4, 2, 1, 0, 0),
('eisplanet09', 2, 4, 2, 1, 0, 0),
('eisplanet10', 2, 4, 2, 1, 0, 0),
('gasplanet01', 4, 2, 2, 0, 0, 0),
('gasplanet02', 4, 2, 2, 0, 0, 0),
('gasplanet03', 4, 2, 2, 0, 0, 0),
('gasplanet04', 4, 2, 2, 0, 0, 0),
('gasplanet05', 4, 2, 2, 0, 0, 0),
('gasplanet06', 4, 2, 2, 0, 0, 0),
('gasplanet07', 4, 2, 2, 0, 0, 0),
('gasplanet08', 4, 2, 2, 0, 0, 0),
('normaltempplanet01', 0, 0, 0, 3, -3, 3),
('normaltempplanet02', 0, 0, 0, 3, -3, 3),
('normaltempplanet03', 0, 0, 0, 3, -3, 3),
('normaltempplanet04', 0, 0, 0, 3, -3, 3),
('normaltempplanet05', 0, 0, 0, 3, -3, 3),
('normaltempplanet06', 0, 0, 0, 3, -3, 3),
('normaltempplanet07', 0, 0, 0, 3, -3, 3),
('trockenplanet01', 2, 2, 0, 4, 0, 0),
('trockenplanet02', 2, 2, 0, 4, 0, 0),
('trockenplanet03', 2, 2, 0, 4, 0, 0),
('trockenplanet04', 2, 2, 0, 4, 0, 0),
('trockenplanet05', 2, 2, 0, 4, 0, 0),
('trockenplanet06', 2, 2, 0, 4, 0, 0),
('trockenplanet07', 2, 2, 0, 4, 0, 0),
('trockenplanet08', 2, 2, 0, 4, 0, 0),
('trockenplanet09', 2, 2, 0, 4, 0, 0),
('trockenplanet10', 2, 2, 0, 4, 0, 0),
('wasserplanet01', 0, 0, 5, 0, -2, 1),
('wasserplanet02', 0, 0, 5, 0, -2, 1),
('wasserplanet03', 0, 0, 5, 0, -2, 1),
('wasserplanet04', 0, 0, 5, 0, -2, 1),
('wasserplanet05', 0, 0, 5, 0, -2, 1),
('wasserplanet06', 0, 0, 5, 0, -2, 1),
('wasserplanet07', 0, 0, 5, 0, -2, 1),
('wasserplanet08', 0, 0, 5, 0, -2, 1),
('wasserplanet09', 0, 0, 5, 0, -2, 1),
('wuestenplanet01', 0, 0, 0, 3, -1, 4),
('wuestenplanet02', 0, 0, 0, 3, -1, 4),
('wuestenplanet03', 0, 0, 0, 3, -1, 4),
('wuestenplanet04', 0, 0, 0, 3, -1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_planets`
--

CREATE TABLE `uni1_planets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) DEFAULT 'Hauptplanet',
  `id_owner` int(11) UNSIGNED DEFAULT NULL,
  `universe` tinyint(3) UNSIGNED NOT NULL,
  `galaxy` tinyint(3) NOT NULL DEFAULT '0',
  `system` smallint(5) NOT NULL DEFAULT '0',
  `planet` tinyint(3) NOT NULL DEFAULT '0',
  `last_update` int(11) DEFAULT NULL,
  `planet_type` enum('1','3') NOT NULL DEFAULT '1',
  `destruyed` int(11) NOT NULL DEFAULT '0',
  `b_building` int(11) NOT NULL DEFAULT '0',
  `b_building_id` mediumtext,
  `b_hangar` int(11) NOT NULL DEFAULT '0',
  `b_hangar_id` mediumtext,
  `b_hangar_plus` int(11) NOT NULL DEFAULT '0',
  `b_defense` int(11) NOT NULL DEFAULT '0',
  `b_defense_id` mediumtext,
  `b_defense_plus` int(11) NOT NULL DEFAULT '0',
  `image` varchar(32) NOT NULL DEFAULT 'normaltempplanet01',
  `imageChange` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `diameter` int(11) UNSIGNED NOT NULL DEFAULT '12800',
  `field_current` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `field_max` smallint(5) UNSIGNED NOT NULL DEFAULT '163',
  `temp_min` int(3) NOT NULL DEFAULT '-17',
  `temp_max` int(3) NOT NULL DEFAULT '23',
  `eco_hash` varchar(32) NOT NULL DEFAULT '',
  `metal` decimal(65,6) UNSIGNED NOT NULL DEFAULT '0.000000',
  `metal_perhour` double(50,6) NOT NULL DEFAULT '0.000000',
  `metal_max` double(50,0) UNSIGNED DEFAULT '100000',
  `crystal` decimal(65,6) UNSIGNED NOT NULL DEFAULT '0.000000',
  `crystal_perhour` double(50,6) NOT NULL DEFAULT '0.000000',
  `crystal_max` double(50,0) UNSIGNED DEFAULT '100000',
  `deuterium` decimal(65,6) UNSIGNED NOT NULL DEFAULT '0.000000',
  `deuterium_perhour` double(50,6) NOT NULL DEFAULT '0.000000',
  `deuterium_max` double(50,0) UNSIGNED DEFAULT '100000',
  `darkmatter_perhour` double(50,6) NOT NULL DEFAULT '0.000000',
  `energy_used` double(50,0) NOT NULL DEFAULT '0',
  `energy` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `metal_mine` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `crystal_mine` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `deuterium_sintetizer` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `solar_plant` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fusion_plant` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `robot_factory` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `nano_factory` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `hangar` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `metal_store` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `crystal_store` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `deuterium_store` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `laboratory` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `terraformer` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `university` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ally_deposit` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `silo` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `mondbasis` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `phalanx` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `sprungtor` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `light_conveyor` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `medium_conveyor` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `heavy_conveyor` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `collider` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `xterium_dock` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `small_ship_cargo` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `big_ship_cargo` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `light_hunter` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `heavy_hunter` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `crusher` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `battle_ship` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `colonizer` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `recycler` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `spy_sonde` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `bomber_ship` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `solar_satelit` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `destructor` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `dearth_star` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `battleship` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `lune_noir` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `ev_transporter` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `star_crasher` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `giga_recykler` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `dm_ship` double(50,0) NOT NULL DEFAULT '0',
  `saver` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `m7` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `m19` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `galleon` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `destroyer` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `m32` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `frigate` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `black_wanderer` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `flying_death` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `bs_oneil` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `orbital_station` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `misil_launcher` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `small_laser` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `big_laser` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `gauss_canyon` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `ionic_canyon` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `buster_canyon` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `small_protection_shield` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `planet_protector` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `big_protection_shield` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `graviton_canyon` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `interceptor_misil` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `interplanetary_misil` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `megador_slim` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `hydrogen_cannon` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `iron_megador` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `dora_cannon` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `photon_cannon` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `lepton_gun` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `proton_gun` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `grand_megador` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `particle_emitter` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `canyon` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `quantum_cannon` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `metal_mine_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `crystal_mine_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `deuterium_sintetizer_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `solar_plant_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `fusion_plant_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `solar_satelit_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `collider_porcent` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '10',
  `last_jump_time` int(11) NOT NULL DEFAULT '0',
  `der_metal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `der_crystal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `id_luna` int(11) NOT NULL DEFAULT '0',
  `last_relocate` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `solar_satelit_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `small_ship_cargo_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `big_ship_cargo_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `light_hunter_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `heavy_hunter_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `m7_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `misil_launcher_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `small_laser_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `big_laser_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `megador_slim_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `recycler_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `crusher_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `battle_ship_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ev_transporter_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `battleship_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `destructor_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `bomber_ship_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `m19_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `giga_recykler_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ionic_canyon_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gauss_canyon_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `buster_canyon_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `hydrogen_cannon_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `iron_megador_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dora_cannon_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `galleon_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `destroyer_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dearth_star_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `lune_noir_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `photon_cannon_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `lepton_gun_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `frigate_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `star_crasher_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `bs_oneil_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `flying_death_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `black_wanderer_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `graviton_canyon_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `proton_gun_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `particle_emitter_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `canyon_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `quantum_cannon_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `m32_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `interceptor_misil_conv` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `interplanetary_misil_conv` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `grand_megador_conv` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_1_timer` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_2_timer` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_3_timer` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_4_timer` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_5_timer` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_6_timer` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_7_timer` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_8_timer` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_9_timer` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `kolvo` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gal6mod` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gal6type` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gal6owner` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `expiredTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `plaPosition` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `urlaubs_allowprod` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `isAlliancePlanet` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `planetarium` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `touchmodule` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `researchcenter` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_planet_auction`
--

CREATE TABLE `uni1_planet_auction` (
  `auctionID` int(11) NOT NULL,
  `planetID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `price` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `buyerID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `selledID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `max_fields` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `hasMoon` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `collider` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `points_b_p` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `points_d_p` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `points_b_l` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `points_d_l` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `points_b` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `points_d` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `universe` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_planet_auction_items`
--

CREATE TABLE `uni1_planet_auction_items` (
  `itemID` int(11) UNSIGNED NOT NULL,
  `upgradeName` varchar(255) NOT NULL,
  `upgradeCount` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `upgradePrice` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `upgradeTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `upgradeOwner` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `upgradeUni` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_planet_auction_offers`
--

CREATE TABLE `uni1_planet_auction_offers` (
  `offerId` int(11) UNSIGNED NOT NULL,
  `playerId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `lotId` int(111) UNSIGNED NOT NULL DEFAULT '0',
  `bidPrice` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `bidTime` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_planet_auction_upg`
--

CREATE TABLE `uni1_planet_auction_upg` (
  `upgradeID` int(11) NOT NULL,
  `upgradeName` varchar(255) NOT NULL,
  `upgradeCount` int(11) NOT NULL DEFAULT '0',
  `upgradePrice` int(11) NOT NULL DEFAULT '0',
  `upgradeTime` int(11) NOT NULL DEFAULT '0',
  `upgradeOwner` int(11) NOT NULL DEFAULT '0',
  `upgradeUni` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_premium_calc`
--

CREATE TABLE `uni1_premium_calc` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `cost` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `factor` float UNSIGNED NOT NULL DEFAULT '0',
  `factorone` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `rangevalue` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `rangevalueone` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `promotion` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uni1_premium_calc`
--

INSERT INTO `uni1_premium_calc` (`id`, `name`, `cost`, `factor`, `factorone`, `rangevalue`, `rangevalueone`, `promotion`) VALUES
(1, 'prem_res', 10, 1.07, 90, 0, 100000, 0),
(2, 'prem_storage', 1, 1.05, 4, 0, 1000, 0),
(3, 'prem_s_build', 25, 1.5, 40, 0, 100, 0),
(4, 'prem_o_build', 100, 1.3, 1, 0, 100, 0),
(5, 'prem_button', 525, 1.45, 1, 2, 10, 0),
(6, 'prem_speed_button', 30, 1.35, 10, 0, 100, 0),
(7, 'prem_expedition', 30, 1.02, 4, 0, 500, 0),
(8, 'prem_count_expiditeon', 500, 1.35, 1, 0, 100, 0),
(9, 'prem_speed_expiditeon', 50, 1.03, 8, 0, 1000, 0),
(10, 'prem_moon_dextruct', 8500, 2, 2, 2, 10, 0),
(11, 'prem_leveling', 45, 1.1, 25, 0, 100, 0),
(12, 'prem_batle_leveling', 50, 1.08, 25, 0, 100, 0),
(13, 'prem_bank_ally', 500, 1.5, 1, 2, 5, 0),
(14, 'prem_conveyors_l', 35, 1.029, 10, 0, 1000, 0),
(15, 'prem_conveyors_s', 45, 1.032, 10, 0, 1000, 0),
(16, 'prem_conveyors_t', 55, 1.033, 10, 0, 1000, 0),
(17, 'prem_prod_from_colly', 110, 1.13, 15, 0, 1000, 0),
(18, 'prem_moon_creat', 100, 1.04, 2, 0, 100, 0),
(19, 'prem_fuel_consumption', 55, 1.12, 3, 0, 1000, 0),
(20, 'prem_prime_units', 2005, 1, 10, 1, 1, 0),
(22, 'prem_transate_player', 1200, 1, 10, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_purchase_logs`
--

CREATE TABLE `uni1_purchase_logs` (
  `payID` int(11) NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `pinCode` text,
  `pinPrice` float(15,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `pinCredits` float(15,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `pinType` varchar(255) DEFAULT NULL,
  `pinAprouved` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `paystatus` varchar(255) DEFAULT NULL,
  `payupdate` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `payimage` text,
  `realDonator` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_raports`
--

CREATE TABLE `uni1_raports` (
  `rid` varchar(32) NOT NULL,
  `raport` mediumtext NOT NULL,
  `time` int(11) NOT NULL,
  `attacker` varchar(255) NOT NULL DEFAULT '',
  `defender` varchar(255) NOT NULL DEFAULT '',
  `simulate` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_records`
--

CREATE TABLE `uni1_records` (
  `userID` int(10) UNSIGNED NOT NULL,
  `elementID` smallint(5) UNSIGNED NOT NULL,
  `level` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_resource_logs`
--

CREATE TABLE `uni1_resource_logs` (
  `resourceId` bigint(20) UNSIGNED NOT NULL,
  `metalStart` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `crystalStart` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `deuteriumStart` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `metalDrop` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `crystalDrop` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `deuteriumDrop` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `metalEnd` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `crystalEnd` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `deuteriumEnd` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `metalCheck` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `crystalCheck` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `deuteriumCheck` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `playerId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `playerDrop` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `planetStart` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `planetEnd` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `missionEnd` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dropTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dropCheck` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `isTrue` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `autoAdd` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `addMetalCheck` double(255,0) UNSIGNED NOT NULL DEFAULT '0',
  `addCrystalCheck` double(255,0) UNSIGNED NOT NULL DEFAULT '0',
  `addDeuteriumCheck` double(255,0) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_saved_galaxy`
--

CREATE TABLE `uni1_saved_galaxy` (
  `savedId` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `galaxy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `system` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `planet` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_session`
--

CREATE TABLE `uni1_session` (
  `sessionID` varchar(32) NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `userIP` varchar(40) NOT NULL,
  `lastonline` int(11) NOT NULL
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_shortcuts`
--

CREATE TABLE `uni1_shortcuts` (
  `shortcutID` int(10) UNSIGNED NOT NULL,
  `ownerID` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `galaxy` tinyint(3) UNSIGNED NOT NULL,
  `system` smallint(5) UNSIGNED NOT NULL,
  `planet` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_stathistory`
--

CREATE TABLE `uni1_stathistory` (
  `id_owner` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `universe` tinyint(4) NOT NULL,
  `history_build_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_tech_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_fleet_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_defs_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_ach_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_vote_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_total_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_build_pointsO` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_tech_pointsO` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_fleet_pointsO` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_defs_pointsO` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_ach_pointsO` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_vote_pointsO` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_total_pointsO` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_honor_points` double(50,0) NOT NULL DEFAULT '0',
  `history_honor_pointsO` double(50,0) NOT NULL DEFAULT '0',
  `history_wapeonry_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `history_wapeonry_pointsO` double(50,0) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_statpoints`
--

CREATE TABLE `uni1_statpoints` (
  `id_owner` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `id_ally` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `stat_type` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `universe` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `tech_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tech_old_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tech_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `tech_count` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `build_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `build_old_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `build_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `build_count` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `defs_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `defs_old_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `defs_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `defs_count` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_old_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `fleet_count` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `honor_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `honor_old_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `honor_points` double(50,0) NOT NULL DEFAULT '0',
  `honor_count` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `wapeonry_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `wapeonry_old_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `wapeonry_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `wapeonry_count` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `ach_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ach_old_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ach_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `ach_count` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `vote_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `vote_old_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `vote_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `vote_count` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `total_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_old_rank` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_points` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `total_count` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_storages_logs`
--

CREATE TABLE `uni1_storages_logs` (
  `storageID` int(11) NOT NULL,
  `allyID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  `planetid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `metal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `crystal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `deuterium` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `type` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `isdeleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_storages_logs_star`
--

CREATE TABLE `uni1_storages_logs_star` (
  `storageID` int(11) UNSIGNED NOT NULL,
  `allyID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `userID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `planetid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `type` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_storage_personal`
--

CREATE TABLE `uni1_storage_personal` (
  `userId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `metal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `crystal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `deuterium` double(50,0) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_suprimus`
--

CREATE TABLE `uni1_suprimus` (
  `surpimoId` int(11) UNSIGNED NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `galaxy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `system` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `createdTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gift_item_light` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gift_item_medium` tinyint(3) UNSIGNED DEFAULT '0',
  `gift_item_heavy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gift_arsenal_light` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gift_arsenal_medium` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gift_arsenal_heavy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gift_darkmatter` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gift_academy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gift_resource_metal` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gift_resource_crystal` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gift_resource_deuterium` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_suprimus_logs`
--

CREATE TABLE `uni1_suprimus_logs` (
  `suprimusLog` int(11) UNSIGNED NOT NULL,
  `playerId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `galaxy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `system` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `checkTime` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_ticket`
--

CREATE TABLE `uni1_ticket` (
  `ticketID` int(10) UNSIGNED NOT NULL,
  `universe` tinyint(3) UNSIGNED NOT NULL,
  `ownerID` int(10) UNSIGNED NOT NULL,
  `categoryID` tinyint(1) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(10) UNSIGNED NOT NULL,
  `rated` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `stars` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `adminanswered` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_ticket_answer`
--

CREATE TABLE `uni1_ticket_answer` (
  `answerID` int(10) UNSIGNED NOT NULL,
  `ownerID` int(10) UNSIGNED NOT NULL,
  `ownerName` varchar(32) NOT NULL,
  `ticketID` int(10) UNSIGNED NOT NULL,
  `time` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_ticket_category`
--

CREATE TABLE `uni1_ticket_category` (
  `categoryID` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uni1_ticket_category`
--

INSERT INTO `uni1_ticket_category` (`categoryID`, `name`) VALUES
(1, 'Questions about the game'),
(2, 'Error (bug)'),
(3, 'Tech. Problems'),
(4, 'Violation of the rules'),
(5, 'Complaint');

-- --------------------------------------------------------

--
-- Structure de la table `uni1_timebonus_log`
--

CREATE TABLE `uni1_timebonus_log` (
  `logID` int(11) UNSIGNED NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `TIMESTAMP` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_topkb`
--

CREATE TABLE `uni1_topkb` (
  `rid` varchar(32) NOT NULL,
  `units` double(50,0) UNSIGNED NOT NULL,
  `result` varchar(1) NOT NULL,
  `time` int(11) NOT NULL,
  `universe` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_tourney`
--

CREATE TABLE `uni1_tourney` (
  `tourneyId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tourneyName` varchar(50) NOT NULL,
  `priceOne` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `priceTwo` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `priceThree` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tourneyEvent` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `uni1_tourney`
--

INSERT INTO `uni1_tourney` (`tourneyId`, `tourneyName`, `priceOne`, `priceTwo`, `priceThree`, `tourneyEvent`) VALUES
(1, 'Alpha', 5000, 3000, 2000, 5),
(2, 'Beta', 5000, 3000, 2000, 3),
(3, 'Gamma', 5000, 3000, 2000, 1),
(4, 'Delta', 5000, 3000, 2000, 2),
(5, 'Epsilon', 5000, 3000, 2000, 4);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_tourney_logs`
--

CREATE TABLE `uni1_tourney_logs` (
  `logId` int(11) UNSIGNED NOT NULL,
  `tourneyUnits` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `playerId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `joinTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tourneyJoin` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_tourney_participante`
--

CREATE TABLE `uni1_tourney_participante` (
  `joinId` int(11) UNSIGNED NOT NULL,
  `tourneyUnits` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `playerId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `joinTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tourneyJoin` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_tracking_mod`
--

CREATE TABLE `uni1_tracking_mod` (
  `trackId` bigint(20) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED DEFAULT NULL,
  `userName` text CHARACTER SET utf8,
  `pageVisited` text CHARACTER SET utf8,
  `data` text CHARACTER SET utf8,
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `trackMode` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_transport_player`
--

CREATE TABLE `uni1_transport_player` (
  `transportID` int(11) UNSIGNED NOT NULL,
  `senderID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `receiverID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `push` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `strongest` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `resource_metal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `resource_crystal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `resource_deuterium` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `legal` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `reviewed` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_users`
--

CREATE TABLE `uni1_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `customNick` varchar(55) DEFAULT NULL,
  `customNickChange` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `password` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `email_2` varchar(64) NOT NULL DEFAULT '',
  `lang` varchar(2) NOT NULL DEFAULT 'de',
  `authattack` tinyint(1) NOT NULL DEFAULT '0',
  `authlevel` tinyint(1) NOT NULL DEFAULT '0',
  `chat_oper` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gm` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `chat_silence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `chatwhitelist` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `chat_room` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `rights` text,
  `user_color` varchar(55) CHARACTER SET latin1 DEFAULT NULL,
  `user_messagged` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `id_planet` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `universe` tinyint(3) UNSIGNED NOT NULL,
  `galaxy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `system` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `planet` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `darkmatter` double(50,0) NOT NULL DEFAULT '0',
  `antimatter` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `antimatter_bought` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `antimatterTmp` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `stardust` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `stellar_ore` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `votepoint` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `vote_sys_1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `vote_sys_2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `vote_sys_3` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `vote_sys_4` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `vote_sys_5` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `rpgGift` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `sawfb` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `sawminially` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `user_lastip` varchar(40) NOT NULL DEFAULT '',
  `ip_at_reg` varchar(40) NOT NULL DEFAULT '',
  `register_time` int(11) NOT NULL DEFAULT '0',
  `onlinetime` int(11) NOT NULL DEFAULT '0',
  `dpath` varchar(20) NOT NULL DEFAULT 'gow',
  `timezone` varchar(32) NOT NULL DEFAULT 'Europe/London',
  `planet_sort` tinyint(1) NOT NULL DEFAULT '0',
  `planet_sort_order` tinyint(1) NOT NULL DEFAULT '0',
  `spio_anz` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `settings_fleetactions` tinyint(2) UNSIGNED NOT NULL DEFAULT '3',
  `settings_esp` tinyint(1) NOT NULL DEFAULT '1',
  `settings_wri` tinyint(1) NOT NULL DEFAULT '1',
  `settings_bud` tinyint(1) NOT NULL DEFAULT '1',
  `settings_mis` tinyint(1) NOT NULL DEFAULT '1',
  `settings_blockPM` tinyint(1) NOT NULL DEFAULT '0',
  `op_ajax` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `settings_gift` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `settings_spy` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `sirena` tinyint(2) UNSIGNED NOT NULL DEFAULT '10',
  `urlaubs_modus` tinyint(1) NOT NULL DEFAULT '0',
  `urlaubs_until` int(11) NOT NULL DEFAULT '0',
  `urlaubs_next_allowed` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `db_deaktjava` int(11) NOT NULL DEFAULT '0',
  `insta_dm_navy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `insta_dm_defense` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `b_tech_planet` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `b_tech` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `b_tech_id` smallint(2) UNSIGNED NOT NULL DEFAULT '0',
  `b_tech_queue` mediumtext,
  `spy_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `computer_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `military_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `defence_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `shield_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `energy_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `hyperspace_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `combustion_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `impulse_motor_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `hyperspace_motor_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `laser_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ionic_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `buster_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `intergalactic_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `expedition_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `metal_proc_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `crystal_proc_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `deuterium_proc_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `graviton_tech` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `brotherhood` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `ally_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ally_register_time` int(11) NOT NULL DEFAULT '0',
  `ally_rank_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `rpg_geologue` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `rpg_amiral` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_ingenieur` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_technocrate` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_espion` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_constructeur` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_scientifique` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_commandant` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_stockeur` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_defenseur` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_destructeur` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_general` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_bunker` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_raideur` tinyint(2) NOT NULL DEFAULT '0',
  `rpg_empereur` tinyint(22) NOT NULL DEFAULT '0',
  `bana` tinyint(1) NOT NULL DEFAULT '0',
  `banaday` int(11) NOT NULL DEFAULT '0',
  `hof` tinyint(1) NOT NULL DEFAULT '1',
  `auctionMessage` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `spyMessagesMode` tinyint(1) NOT NULL DEFAULT '1',
  `wons` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `loos` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `draws` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `kbmetal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `kbcrystal` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `lostunits` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `desunits` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `uctime` int(11) NOT NULL DEFAULT '0',
  `setmail` int(11) NOT NULL DEFAULT '0',
  `dm_attack` int(11) NOT NULL DEFAULT '0',
  `dm_attack_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dm_defensive` int(11) NOT NULL DEFAULT '0',
  `dm_defensive_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dm_buildtime` int(11) NOT NULL DEFAULT '0',
  `dm_buildtime_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dm_researchtime` int(11) NOT NULL DEFAULT '0',
  `dm_researchtime_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dm_resource` int(11) NOT NULL DEFAULT '0',
  `dm_resource_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dm_energie` int(11) NOT NULL DEFAULT '0',
  `dm_energie_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `dm_fleettime` int(11) NOT NULL DEFAULT '0',
  `dm_fleettime_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ref_id` int(11) NOT NULL DEFAULT '0',
  `ref_bonus` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `inactive_mail` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `isChat` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `bonus_timer` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_reset` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1101` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1102` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1103` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1104` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1105` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1106` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1107` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1108` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1109` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1110` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1111` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1112` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_1_1113` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_2_1201` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_2_1202` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_2_1203` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_2_1204` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_2_1205` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_2_1206` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_2_1207` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_2_1208` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_2_1209` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_2_1210` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1301` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1302` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1303` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1304` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1305` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1306` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1307` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1308` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1309` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1310` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1311` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1312` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1313` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `academy_p_b_3_1314` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `kolvo` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tutorial` tinyint(3) NOT NULL DEFAULT '-1',
  `recordshidden` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `loyality_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `eur_spend` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_res` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_res_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_storage` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_storage_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_s_build` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_s_build_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_o_build` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_o_build_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_button` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_button_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_speed_button` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_speed_button_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_expedition` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_expedition_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_count_expiditeon` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_count_expiditeon_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_speed_expiditeon` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_speed_expiditeon_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_moon_dextruct` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_moon_dextruct_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_leveling` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_leveling_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_batle_leveling` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_batle_leveling_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_bank_ally` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_bank_ally_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_conveyors_l` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_conveyors_l_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_conveyors_s` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_conveyors_s_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_conveyors_t` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_conveyors_t_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_prod_from_colly` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_prod_from_colly_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_moon_creat` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_moon_creat_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_fuel_consumption` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_fuel_consumption_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_prime_units` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_prime_units_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_transate_player` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `prem_transate_player_days` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `alliance_storage_deposit` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `alliance_storage_widraw` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `playercard_firstname` varchar(55) DEFAULT NULL,
  `playercard_age` varchar(55) DEFAULT NULL,
  `playercard_country` varchar(55) DEFAULT NULL,
  `playercard_playstyle` varchar(55) DEFAULT NULL,
  `playercard_city` varchar(55) DEFAULT NULL,
  `playercard_skype` varchar(55) DEFAULT NULL,
  `combat_exp_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `combat_exp_current` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `combat_exp_max` bigint(20) UNSIGNED NOT NULL DEFAULT '10700',
  `combat_exp_deut` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `combat_exp_expedition` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `combat_exp_bonus` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `combat_exp_collider` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `combat_exp_upgrade` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `peacefull_exp_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `peacefull_exp_current` float UNSIGNED NOT NULL DEFAULT '0',
  `peacefull_exp_max` int(11) UNSIGNED NOT NULL DEFAULT '3600',
  `peacefull_exp_slots` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `peacefull_exp_mission` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `peacefull_exp_moonshot` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `peacefull_exp_light` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `peacefull_exp_medium` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `peacefull_exp_heavy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `peacefull_last_update` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `newyear_gift_1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `newyear_gift_2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `newyear_gift_3` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `newyear_gift_4` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `cosmo_gift_1` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `cosmo_gift_2` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `cosmo_gift_3` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `halloween_gift_1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `halloween_gift_2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `halloween_gift_3` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_laser` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_laser_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_laser_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_ion` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_ion_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_ion_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_plasma` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_plasma_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_plasma_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_gravity` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_gravity_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_gravity_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_dlight` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_dlight_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_dlight_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_dmedium` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_dmedium_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_dmedium_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_dheavy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_dheavy_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_dheavy_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_slight` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_slight_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_slight_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_smedium` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_smedium_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_smedium_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_sheavy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_sheavy_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_sheavy_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_combustion` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_combustion_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_combustion_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_impulse` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_impulse_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_impulse_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_hyperspace` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_hyperspace_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_hyperspace_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_res901` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_res901_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_res901_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_res902` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_res902_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_res902_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_res903` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_res903_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_res903_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_conveyor1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_conveyor1_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_conveyor1_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_conveyor2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_conveyor2_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_conveyor2_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `arsenal_conveyor3` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_conveyor3_level` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `arsenal_conveyor3_chance` float UNSIGNED NOT NULL DEFAULT '100',
  `achievement_point` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_point_used` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_common_1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_common_1_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_common_2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_common_2_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_1_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_1_succes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_2_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_2_succes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_3` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_3_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_3_succes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_4` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_4_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_4_succes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_5` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_5_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_5_succes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_6` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_6_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_6_succes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_7` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_7_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_7_succes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_8` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_8_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_daily_8_succes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_1_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_2_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_3` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_3_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_4` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_4_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_5` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_5_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_6` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_6_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_7` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_7_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_8` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_8_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_9` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_9_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_10` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_build_10_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_1_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_2_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_3` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_3_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_4` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_4_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_5` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_5_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_6` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_6_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_7` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_7_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_8` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_8_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_9` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_9_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_10` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_tech_10_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_1_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_1_success` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_2_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_2_success` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_3` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_3_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_3_success` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_4` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_4_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_4_success` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_5` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_5_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_5_success` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_6` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_6_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_6_success` decimal(65,0) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_7` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_7_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_7_success` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_8` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_8_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_varia_8_success` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_1_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_2_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_3` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_3_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_4` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_4_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_5` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_5_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_6` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_6_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_7` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `achievement_fleet_7_points` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_3` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_4` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_5` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_6` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_7` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_8` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_9` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_10` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_11` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_12` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_13` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_14` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_15` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_16` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_17` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_18` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_19` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_20` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `auction_item_21` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `moonReward` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `lastAlly` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `lastAllyTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `isCaptcha` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `isCaptchaCode` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `isCaptchaClick` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `isNuberOne` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `isNuberTwo` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `isNuberThree` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `isUserRequest` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `isUserOk` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `isUserTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `encodage` varchar(32) NOT NULL DEFAULT '',
  `honour_points` double(50,0) NOT NULL DEFAULT '0',
  `outlaw` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `usertext` text,
  `asteroid_mine_tech` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar_defaut.jpg',
  `msgperpage` tinyint(3) UNSIGNED NOT NULL DEFAULT '10',
  `totalreferee` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `apiKey` varchar(32) DEFAULT NULL,
  `xteriumallydialog` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gatheroptions` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `deviceId` varchar(500) DEFAULT NULL,
  `nextPossibleAttack` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `showAllyFleet` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `antimatterMarket` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `multibuild` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `expeEventPoints` double(50,0) UNSIGNED NOT NULL DEFAULT '0',
  `protectionTimer` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `fleetdesign` tinyint(3) UNSIGNED NOT NULL DEFAULT '2',
  `gatherOptionsType` varchar(55) NOT NULL DEFAULT '',
  `mainmenu` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `lastarseactivation` int(11) NOT NULL DEFAULT '1516393427',
  `expoxday` int(11) NOT NULL DEFAULT '0',
  `displayads` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `adblocker` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `adblockerTime` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_users_to_acs`
--

CREATE TABLE `uni1_users_to_acs` (
  `userID` int(10) UNSIGNED NOT NULL,
  `acsID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_users_to_extauth`
--

CREATE TABLE `uni1_users_to_extauth` (
  `id` int(11) NOT NULL,
  `account` varchar(64) NOT NULL,
  `mode` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_users_to_topkb`
--

CREATE TABLE `uni1_users_to_topkb` (
  `rid` varchar(32) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `allyId` varchar(32) DEFAULT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_users_valid`
--

CREATE TABLE `uni1_users_valid` (
  `validationID` int(11) UNSIGNED NOT NULL,
  `userName` varchar(64) NOT NULL,
  `validationKey` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(64) NOT NULL,
  `date` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `language` varchar(3) NOT NULL,
  `universe` tinyint(3) UNSIGNED NOT NULL,
  `referralID` int(11) DEFAULT NULL,
  `externalAuthUID` varchar(128) DEFAULT NULL,
  `externalAuthMethod` varchar(32) DEFAULT NULL,
  `encodage` varchar(500) DEFAULT NULL,
  `deviceId` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_vars`
--

CREATE TABLE `uni1_vars` (
  `elementID` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `class` int(11) NOT NULL,
  `onPlanetType` set('1','3') NOT NULL,
  `onePerPlanet` tinyint(4) NOT NULL,
  `factor` float(4,2) NOT NULL,
  `maxLevel` int(11) DEFAULT NULL,
  `cost901` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `cost902` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `cost903` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `cost911` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `cost921` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `cost921special` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `cost922` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `costAP` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `consumption1` int(11) UNSIGNED DEFAULT NULL,
  `consumption2` int(11) UNSIGNED DEFAULT NULL,
  `speedTech` int(11) UNSIGNED DEFAULT NULL,
  `speed1` int(11) UNSIGNED DEFAULT NULL,
  `speed2` int(11) UNSIGNED DEFAULT NULL,
  `speed2Tech` int(10) UNSIGNED DEFAULT NULL,
  `speed2onLevel` int(10) UNSIGNED DEFAULT NULL,
  `speed3Tech` int(10) UNSIGNED DEFAULT NULL,
  `speed3onLevel` int(10) UNSIGNED DEFAULT NULL,
  `capacity` int(11) UNSIGNED DEFAULT NULL,
  `attack` int(10) UNSIGNED DEFAULT NULL,
  `defend` int(10) UNSIGNED DEFAULT NULL,
  `timeBonus` int(11) UNSIGNED DEFAULT NULL,
  `bonusAttack` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusDefensive` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusShield` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusBuildTime` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusResearchTime` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusShipTime` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusDefensiveTime` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusResource` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusEnergy` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusResourceStorage` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusShipStorage` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusFlyTime` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusFleetSlots` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusPlanets` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusSpyPower` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusExpedition` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusGateCoolTime` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusMoreFound` float(4,2) NOT NULL DEFAULT '0.00',
  `bonusAttackUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusDefensiveUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusShieldUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusBuildTimeUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusResearchTimeUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusShipTimeUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusDefensiveTimeUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusResourceUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusEnergyUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusResourceStorageUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusShipStorageUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusFlyTimeUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusFleetSlotsUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusPlanetsUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusSpyPowerUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusExpeditionUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusGateCoolTimeUnit` smallint(1) NOT NULL DEFAULT '0',
  `bonusMoreFoundUnit` smallint(1) NOT NULL DEFAULT '0',
  `speedFleetFactor` float(4,2) DEFAULT NULL,
  `production901` varchar(2000) DEFAULT NULL,
  `production902` varchar(2000) DEFAULT NULL,
  `production903` varchar(2000) DEFAULT NULL,
  `production911` varchar(1000) DEFAULT NULL,
  `production921` varchar(1000) DEFAULT NULL,
  `storage901` varchar(255) DEFAULT NULL,
  `storage902` varchar(255) DEFAULT NULL,
  `storage903` varchar(255) DEFAULT NULL,
  `arsenal_bonus` float UNSIGNED NOT NULL DEFAULT '0',
  `fleetPointExpe` float UNSIGNED NOT NULL DEFAULT '0',
  `type_gun` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `wapeon_gun` varchar(255) DEFAULT NULL,
  `alliance901` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `alliance902` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `alliance903` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `alliance911` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uni1_vars`
--

INSERT INTO `uni1_vars` (`elementID`, `name`, `class`, `onPlanetType`, `onePerPlanet`, `factor`, `maxLevel`, `cost901`, `cost902`, `cost903`, `cost911`, `cost921`, `cost921special`, `cost922`, `costAP`, `consumption1`, `consumption2`, `speedTech`, `speed1`, `speed2`, `speed2Tech`, `speed2onLevel`, `speed3Tech`, `speed3onLevel`, `capacity`, `attack`, `defend`, `timeBonus`, `bonusAttack`, `bonusDefensive`, `bonusShield`, `bonusBuildTime`, `bonusResearchTime`, `bonusShipTime`, `bonusDefensiveTime`, `bonusResource`, `bonusEnergy`, `bonusResourceStorage`, `bonusShipStorage`, `bonusFlyTime`, `bonusFleetSlots`, `bonusPlanets`, `bonusSpyPower`, `bonusExpedition`, `bonusGateCoolTime`, `bonusMoreFound`, `bonusAttackUnit`, `bonusDefensiveUnit`, `bonusShieldUnit`, `bonusBuildTimeUnit`, `bonusResearchTimeUnit`, `bonusShipTimeUnit`, `bonusDefensiveTimeUnit`, `bonusResourceUnit`, `bonusEnergyUnit`, `bonusResourceStorageUnit`, `bonusShipStorageUnit`, `bonusFlyTimeUnit`, `bonusFleetSlotsUnit`, `bonusPlanetsUnit`, `bonusSpyPowerUnit`, `bonusExpeditionUnit`, `bonusGateCoolTimeUnit`, `bonusMoreFoundUnit`, `speedFleetFactor`, `production901`, `production902`, `production903`, `production911`, `production921`, `storage901`, `storage902`, `storage903`, `arsenal_bonus`, `fleetPointExpe`, `type_gun`, `wapeon_gun`, `alliance901`, `alliance902`, `alliance903`, `alliance911`) VALUES
(1, 'metal_mine', 0, '1', 0, 1.50, 255, 60, 15, 0, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '(750 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) + ((750 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $planetStrucMetal) + ((750 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $premium_resource) + ((750 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $userPeaceExp) + ((750 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $academy_p_b_2_1201) + ((750 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $gouvernor_resource) + ((750 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $arsenal_1_eco) + ((750 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $geologuebon) + ((750 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $hashallyprod) + ((750 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $getGalaxySevenProduct) + ((750 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $ally_fraction_resorc_prod)', NULL, NULL, '-(10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)', NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(2, 'crystal_mine', 0, '1', 0, 1.50, 255, 48, 24, 0, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '(500 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) + ((500 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $planetStrucCrystal) + ((500 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $premium_resource) + ((500 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $userPeaceExp) + ((500 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $academy_p_b_2_1201) + ((500 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $gouvernor_resource) + ((500 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $arsenal_2_eco) + ((500 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $geologuebon) + ((500 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $hashallyprod) + ((500 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $getGalaxySevenProduct) + ((500 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $ally_fraction_resorc_prod)', NULL, '-(10 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor);', NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(3, 'deuterium_sintetizer', 0, '1', 0, 1.50, 255, 225, 75, 0, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, '(250 * $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor)) + ((250 * $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor)) / 100 * $planetStrucDeuterium) + ((250 * $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor)) / 100 * $premium_resource) + ((250 * $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor)) / 100 * $userPeaceExp) + ((250 * $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor)) / 100 * $academy_p_b_2_1201) + ((250 * $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor)) / 100 * $gouvernor_resource) + ((250 * $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor)) / 100 * $arsenal_3_eco) + ((250 * $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor)) / 100 * $geologuebon) + ((250 * $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor)) / 100 * $hashallyprod) + ((250 * $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor)) / 100 * $getGalaxySevenProduct) + ((250 * $BuildLevel * pow((1.1), $BuildLevel) * (-0.002 * $BuildTemp + 1.28) * (0.1 * $BuildLevelFactor)) / 100 * $ally_fraction_resorc_prod)', '- (30 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor)', NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(4, 'solar_plant', 0, '1', 0, 1.50, 255, 75, 30, 0, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '(20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) + ((20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $planetStrucEnergy) + ((20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $premium_resource) + ((20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $userPeaceExp) + ((20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $academy_p_b_2_1202) + ((20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $gouvernor_energy) + ((20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $engineerbon) + ((20 * $BuildLevel * pow((1.1), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $ally_fraction_energy_prod)', NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(6, 'university', 0, '1', 0, 2.00, 255, 100000000, 50000000, 25000000, 0, 0, 45000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(7, 'xterium_dock', 0, '1', 0, 2.00, 255, 200, 0, 50, 50, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(12, 'fusion_plant', 0, '1', 0, 2.00, 255, 900, 360, 180, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, '- (10 * $BuildLevel * pow(1.1,$BuildLevel) * (0.1 * $BuildLevelFactor))', '(30 * $BuildLevel * pow((1.05 + $BuildEnergy * 0.01), $BuildLevel)) * (0.1 * $BuildLevelFactor) + ((30 * $BuildLevel * pow((1.05 + $BuildEnergy * 0.01), $BuildLevel)) * (0.1 * $BuildLevelFactor) / 100 * $academy_p_b_2_1209)', NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(14, 'robot_factory', 0, '1,3', 0, 2.00, 255, 400, 120, 200, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 200000, 60000, 100000, 0),
(15, 'nano_factory', 0, '1,3', 0, 2.00, 255, 1000000, 500000, 100000, 0, 0, 360, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 500000000, 250000000, 50000000, 0),
(21, 'hangar', 0, '1,3', 0, 2.00, 255, 400, 200, 100, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 200000, 100000, 50000, 0),
(22, 'metal_store', 0, '1', 0, 2.00, 255, 2000, 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'floor(62.5 * pow(1.8331954764, $BuildLevel)) * 5000 + (floor(62.5 * pow(1.8331954764, $BuildLevel)) * 5000 / 100 * $premium_storage) + (floor(62.5 * pow(1.8331954764, $BuildLevel)) * 5000 / 100 * $academy_p_b_2_1204)', NULL, NULL, 0, 0, 0, '0', 1000000, 0, 0, 0),
(23, 'crystal_store', 0, '1', 0, 2.00, 255, 2000, 1000, 0, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'floor(62.5 * pow(1.8331954764, $BuildLevel)) * 5000 + (floor(62.5 * pow(1.8331954764, $BuildLevel)) * 5000 / 100 * $premium_storage) + (floor(62.5 * pow(1.8331954764, $BuildLevel)) * 5000 / 100 * $academy_p_b_2_1204)', NULL, 0, 0, 0, '0', 1000000, 500000, 0, 0),
(24, 'deuterium_store', 0, '1', 0, 2.00, 255, 2000, 2000, 0, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'floor(62.5 * pow(1.8331954764, $BuildLevel)) * 5000 + (floor(62.5 * pow(1.8331954764, $BuildLevel)) * 5000 / 100 * $premium_storage) + (floor(62.5 * pow(1.8331954764, $BuildLevel)) * 5000 / 100 * $academy_p_b_2_1204)', 0, 0, 0, '0', 1000000, 1000000, 0, 0),
(31, 'laboratory', 0, '1', 0, 2.00, 255, 200, 400, 200, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(33, 'terraformer', 0, '1', 0, 2.00, 255, 0, 50000, 100000, 1000, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 25000000, 50000000, 500000),
(34, 'ally_deposit', 0, '1,3', 0, 2.00, 255, 20000, 40000, 0, 0, 0, 15, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 10000000, 20000000, 0, 0),
(41, 'mondbasis', 0, '3', 0, 2.00, 255, 20000, 40000, 20000, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(42, 'phalanx', 0, '3', 0, 2.00, 255, 20000, 40000, 20000, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(43, 'sprungtor', 0, '3', 0, 2.00, 255, 2000000, 4000000, 2000000, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(44, 'silo', 0, '1', 0, 2.00, 255, 20000, 20000, 1000, 0, 0, 10, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 10000000, 10000000, 500000, 0),
(50, 'planetarium', 0, '1', 0, 3.00, 255, 260000000, 267500000, 185000000, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 260000000000, 267500000000, 185000000000, 0),
(51, 'touchmodule', 0, '1', 0, 3.00, 255, 35000000, 22500000, 8500000, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 35000000000, 22500000000, 85000000000, 0),
(52, 'researchcenter', 0, '1', 0, 3.00, 255, 25000000, 62500000, 15000000, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 25000000000, 62500000000, 15000000000, 0),
(69, 'collider', 0, '3', 0, 2.00, 255, 0, 0, 0, 0, 0, 0, 850, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '(2.5 * $BuildLevel * pow((1.1), $BuildLevel)) + ((2.5 * $BuildLevel * pow((1.1), $BuildLevel)) / 100 * $premium_collider) + ((2.5 * $BuildLevel * pow((1.1), $BuildLevel)) / 100 * $getGalaxySevenCollide)', NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(71, 'light_conveyor', 0, '1,3', 0, 2.00, 255, 1500000, 500000, 200000, 0, 0, 495, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 750000000, 250000000, 100000000, 0),
(72, 'medium_conveyor', 0, '1,3', 0, 2.00, 255, 3500000, 1500000, 600000, 0, 0, 1335, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 1750000000, 750000000, 300000000, 0),
(73, 'heavy_conveyor', 0, '1,3', 0, 2.00, 255, 7500000, 3500000, 1500000, 0, 0, 3075, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 3750000000, 1750000000, 750000000, 0),
(106, 'spy_tech', 100, '1,3', 0, 2.00, 255, 200, 1000, 200, 0, 0, 3, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(108, 'computer_tech', 100, '1,3', 0, 2.00, 255, 0, 400, 600, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(109, 'military_tech', 100, '1,3', 0, 2.00, 255, 800, 200, 0, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(110, 'defence_tech', 100, '1,3', 0, 2.00, 255, 200, 600, 0, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(111, 'shield_tech', 100, '1,3', 0, 2.00, 255, 1000, 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(113, 'energy_tech', 100, '1,3', 0, 2.00, 255, 0, 800, 400, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(114, 'hyperspace_tech', 100, '1,3', 0, 2.00, 255, 0, 4000, 2000, 0, 0, 4, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(115, 'combustion_tech', 100, '1,3', 0, 2.00, 255, 400, 0, 600, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(117, 'impulse_motor_tech', 100, '1,3', 0, 2.00, 255, 2000, 4000, 600, 0, 0, 4, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(118, 'hyperspace_motor_tech', 100, '1,3', 0, 2.00, 255, 10000, 20000, 6000, 0, 0, 19, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(120, 'laser_tech', 100, '1,3', 0, 2.00, 255, 200, 100, 0, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(121, 'ionic_tech', 100, '1,3', 0, 2.00, 255, 1000, 300, 100, 0, 0, 3, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(122, 'buster_tech', 100, '1,3', 0, 2.00, 255, 2000, 4000, 1000, 0, 0, 4, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(123, 'intergalactic_tech', 100, '1,3', 0, 2.00, 255, 240000, 400000, 160000, 0, 0, 420, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(124, 'expedition_tech', 100, '1,3', 0, 1.75, 255, 4000, 8000, 4000, 0, 0, 9, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(125, 'brotherhood', 100, '1,3', 0, 2.00, 255, 1000, 1750, 0, 0, 75, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(131, 'metal_proc_tech', 100, '1,3', 0, 2.00, 255, 750, 500, 250, 0, 0, 3, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(132, 'crystal_proc_tech', 100, '1,3', 0, 2.00, 255, 1000, 750, 500, 0, 0, 3, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(133, 'deuterium_proc_tech', 100, '1,3', 0, 2.00, 255, 1250, 1000, 750, 0, 0, 3, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(150, 'asteroid_mine_tech', 100, '1,3', 0, 2.00, 255, 2000, 1750, 500, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 0, 0, 0, 0),
(199, 'graviton_tech', 100, '1,3', 0, 3.00, 60, 0, 0, 0, 300000, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(202, 'small_ship_cargo', 200, '1,3', 0, 1.00, NULL, 2000, 2000, 0, 0, 0, 1, 0, 0, 10, 20, 4, 6500, 10000, NULL, NULL, NULL, NULL, 5000, 0, 20, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.004, 1, '0', 0, 0, 0, 0),
(203, 'big_ship_cargo', 200, '1,3', 0, 1.00, NULL, 6000, 6000, 0, 0, 0, 1, 0, 0, 50, 50, 1, 7500, 7500, NULL, NULL, NULL, NULL, 25000, 0, 50, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.012, 1, '0', 0, 0, 0, 0),
(204, 'light_hunter', 200, '1,3', 0, 1.00, NULL, 3000, 1000, 0, 0, 0, 1, 0, 0, 20, 20, 1, 12500, 12500, NULL, NULL, NULL, NULL, 50, 30, 20, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.004, 1, '0', 0, 0, 0, 0),
(205, 'heavy_hunter', 200, '1,3', 0, 1.00, NULL, 6000, 4000, 0, 0, 0, 1, 0, 0, 75, 75, 2, 10000, 15000, NULL, NULL, NULL, NULL, 100, 70, 80, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.011, 1, '0', 0, 0, 0, 0),
(206, 'crusher', 200, '1,3', 0, 1.00, NULL, 15000, 9500, 2000, 0, 0, 2, 0, 0, 300, 300, 2, 15000, 15000, NULL, NULL, NULL, NULL, 800, 400, 200, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.0265, 2, '121:400', 0, 0, 0, 0),
(207, 'battle_ship', 200, '1,3', 0, 1.00, NULL, 41000, 17000, 0, 0, 0, 2, 0, 0, 250, 250, 3, 10000, 10000, NULL, NULL, NULL, NULL, 1500, 600, 350, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.058, 2, '120:600', 0, 0, 0, 0),
(208, 'colonizer', 200, '1,3', 0, 1.00, NULL, 10000, 20000, 10000, 0, 0, 3, 0, 0, 1000, 1000, 2, 2500, 2500, NULL, NULL, NULL, NULL, 7500, 0, 100, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.04, 0, '0', 0, 0, 0, 0),
(209, 'recycler', 200, '1,3', 0, 1.00, NULL, 10000, 6000, 2000, 0, 0, 1, 0, 0, 300, 300, 1, 2000, 2000, NULL, NULL, NULL, NULL, 20000, 0, 10, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.018, 2, '0', 0, 0, 0, 0),
(210, 'spy_sonde', 200, '1,3', 0, 1.00, NULL, 0, 1000, 0, 0, 0, 1, 0, 0, 1, 1, 1, 100000000, 100000000, NULL, NULL, NULL, NULL, 15, 0, 0, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.001, 0, '0', 0, 0, 0, 0),
(211, 'bomber_ship', 200, '1,3', 0, 1.00, NULL, 70000, 45000, 5000, 0, 0, 5, 0, 0, 1000, 1000, 3, 5500, 5500, NULL, NULL, NULL, NULL, 500, 1750, 700, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.12, 2, '122:1750', 0, 0, 0, 0),
(212, 'solar_satelit', 200, '1,3', 0, 1.00, NULL, 0, 2000, 500, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '((($BuildTemp + 177.5) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) + (((($BuildTemp + 177.5) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $academy_p_b_2_1210) + (((($BuildTemp + 177.5) / 6) * (0.1 * $BuildLevelFactor) * $BuildLevel) / 100 * $gouvernor_energy)', NULL, NULL, NULL, NULL, 0, 0.0025, 1, '0', 0, 0, 0, 0),
(213, 'destructor', 200, '1,3', 0, 1.00, NULL, 60000, 50000, 15000, 0, 0, 6, 0, 0, 1000, 1000, 3, 6500, 6500, NULL, NULL, NULL, NULL, 2000, 1500, 1100, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.125, 2, '120:1500;122:500', 0, 0, 0, 0),
(214, 'dearth_star', 200, '1,3', 0, 1.00, NULL, 6000000, 3500000, 1000000, 0, 0, 425, 0, 0, 1, 1, 3, 10, 10, NULL, NULL, NULL, NULL, 1000000, 150000, 50000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 10.5, 3, '199:150000', 0, 0, 0, 0),
(215, 'battleship', 200, '1,3', 0, 1.00, NULL, 50000, 40000, 10000, 0, 0, 5, 0, 0, 250, 250, 3, 10000, 10000, NULL, NULL, NULL, NULL, 750, 1450, 800, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.1, 2, '120:1450', 0, 0, 0, 0),
(216, 'lune_noir', 200, '1,3', 0, 1.00, NULL, 8000000, 4000000, 500000, 0, 0, 450, 0, 0, 1750, 1750, 3, 5500, 5500, NULL, NULL, NULL, NULL, 15000000, 200000, 90000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 12.5, 3, '120:30000;199:170000', 0, 0, 0, 0),
(217, 'ev_transporter', 200, '1,3', 0, 1.00, NULL, 35000, 20000, 1500, 0, 0, 3, 0, 0, 90, 90, 3, 7000, 7000, NULL, NULL, NULL, NULL, 400000000, 50, 120, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.0565, 2, '0', 0, 0, 0, 0),
(218, 'star_crasher', 200, '1,3', 0, 1.00, NULL, 275000000, 130000000, 60000000, 0, 0, 19375, 0, 0, 45000, 45000, 3, 5000, 5000, NULL, NULL, NULL, NULL, 50000000, 10000000, 4000000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 500, 3, '120:1350000;199:7650000', 0, 0, 0, 0),
(219, 'giga_recykler', 200, '1,3', 0, 1.00, NULL, 1000000, 600000, 200000, 0, 0, 75, 0, 0, 300, 300, 3, 7500, 7500, NULL, NULL, NULL, NULL, 200000000, 0, 1000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1.8, 2, '0', 0, 0, 0, 0),
(220, 'dm_ship', 200, '1,3', 0, 1.00, NULL, 6000000, 7000000, 3000000, 0, 0, 0, 0, 0, 100000, 100000, 3, 100, 100, NULL, NULL, NULL, NULL, 6000000, 5, 50000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 16, 0, '0', 0, 0, 0, 0),
(221, 'bs_oneil', 200, '1,3', 0, 1.00, NULL, 300000000, 220000000, 60000000, 0, 0, 24500, 0, 0, 65000, 65000, 3, 5000, 5000, NULL, NULL, NULL, NULL, 1000000, 6000000, 2500000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 580, 3, '122:1800000;199:4200000', 0, 0, 0, 0),
(222, 'flying_death', 200, '1,3', 0, 1.00, NULL, 220000000, 110000000, 30000000, 0, 0, 14000, 0, 0, 25000, 25000, 3, 5000, 5000, NULL, NULL, NULL, NULL, 5000000, 4700000, 2000000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 360, 3, '120:705000;122:175000;199:2820000', 0, 0, 0, 0),
(223, 'saver', 200, '1,3', 0, 1.00, NULL, 2500000, 2500000, 625000, 0, 50, 255, 0, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 1, NULL, 100, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 5.625, 0, '0', 0, 0, 0, 0),
(224, 'm19', 200, '1,3', 0, 1.00, NULL, 75000, 65000, 10000, 0, 0, 0, 0, 0, 300, 300, 3, 7000, 7000, NULL, NULL, NULL, NULL, 10000, 4000, 1300, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.15, 2, '120:600;121:3400', 0, 0, 0, 0),
(225, 'galleon', 200, '1,3', 0, 1.00, NULL, 900000, 700000, 200000, 0, 0, 78, 0, 0, 1250, 1250, 3, 6000, 6000, NULL, NULL, NULL, NULL, 500000, 35000, 15000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1.8, 3, '120:17500;121:17500', 0, 0, 0, 0),
(226, 'destroyer', 200, '1,3', 0, 1.00, NULL, 3000000, 2000000, 200000, 0, 0, 195, 0, 0, 1450, 1450, 3, 5500, 5500, NULL, NULL, NULL, NULL, 1000000, 90000, 40000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 5.2, 3, '120:27000;121:63000', 0, 0, 0, 0),
(227, 'frigate', 200, '1,3', 0, 1.00, NULL, 30000000, 10000000, 2000000, 0, 0, 1450, 0, 0, 6000, 6000, 3, 5000, 5000, NULL, NULL, NULL, NULL, 1500000, 700000, 300000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 42, 3, '120:175000;121:280000;199:245000', 0, 0, 0, 0),
(228, 'black_wanderer', 200, '1,3', 0, 1.00, NULL, 80000000, 40000000, 7000000, 0, 0, 4700, 0, 0, 10000, 10000, 3, 5000, 5000, NULL, NULL, NULL, NULL, 2000000, 2200000, 950000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 127, 3, '120:330000;121:660000;122:440000;199:770000', 0, 0, 0, 0),
(229, 'm7', 200, '1,3', 0, 1.00, NULL, 5000, 5000, 500, 0, 0, 0, 0, 0, 40, 40, 2, 12500, 12500, NULL, NULL, NULL, NULL, 100, 90, 80, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.0105, 1, '120:90', 0, 0, 0, 0),
(230, 'm32', 200, '1,3', 0, 1.00, NULL, 21000000, 5000000, 1750000, 0, 0, 0, 0, 0, 5500, 5500, 3, 5000, 5000, NULL, NULL, NULL, NULL, 2500000, 475000, 200000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 27.75, 3, '120:71250;122:142500;199:261250', 0, 0, 0, 0),
(401, 'misil_launcher', 400, '1,3', 0, 1.00, NULL, 2000, 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 80, 400, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '0', 0, 0, 0, 0),
(402, 'small_laser', 400, '1,3', 0, 1.00, NULL, 1500, 500, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 100, 500, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '120:100', 0, 0, 0, 0),
(403, 'big_laser', 400, '1,3', 0, 1.00, NULL, 6000, 2000, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 400, 2000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '120:400', 0, 0, 0, 0),
(404, 'gauss_canyon', 400, '1,3', 0, 1.00, NULL, 20000, 15000, 2000, 0, 0, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2800, 4000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 2, '0', 0, 0, 0, 0),
(405, 'ionic_canyon', 400, '1,3', 0, 1.00, NULL, 2000, 6000, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 200, 5000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 2, '121:200', 0, 0, 0, 0),
(406, 'buster_canyon', 400, '1,3', 0, 1.00, NULL, 50000, 50000, 30000, 0, 0, 7, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 13000, 16000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 2, '122:13000', 0, 0, 0, 0),
(407, 'small_protection_shield', 400, '1,3', 0, 1.00, NULL, 1000000, 1000000, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 2000000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(408, 'big_protection_shield', 400, '1,3', 0, 1.00, NULL, 5000000, 5000000, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 10000000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(409, 'planet_protector', 400, '1,3', 0, 1.00, NULL, 500000000, 500000000, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 500000000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(410, 'graviton_canyon', 400, '1,3', 0, 1.00, NULL, 15000000, 15000000, 0, 0, 0, 1125, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1000000, 1600000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 3, '199:1000000', 0, 0, 0, 0),
(411, 'orbital_station', 400, '1,3', 0, 1.00, NULL, 5000000000, 2000000000, 500000000, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1000000000, 2000000000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '120:150000000;121:150000000;122:250000000;199:450000000', 0, 0, 0, 0),
(412, 'lepton_gun', 400, '1,3', 0, 1.00, NULL, 10000000, 5000000, 1500000, 0, 0, 650, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 700000, 1000000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 3, '120:350000;199:350000', 0, 0, 0, 0),
(413, 'proton_gun', 400, '1,3', 0, 1.00, NULL, 25000000, 18000000, 3000000, 0, 0, 1825, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000000, 2000000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 3, '122:500000;199:1500000', 0, 0, 0, 0),
(414, 'canyon', 400, '1,3', 0, 1.00, NULL, 80000000, 60000000, 20000000, 0, 0, 7000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6000000, 10000000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 3, '121:4500000;199:1500000', 0, 0, 0, 0),
(415, 'quantum_cannon', 400, '1,3', 0, 1.00, NULL, 280000000, 150000000, 40000000, 0, 0, 18500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14000000, 30000000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 3, '121:1400000;122:4200000;199:8400000', 0, 0, 0, 0),
(416, 'hydrogen_cannon', 400, '1,3', 0, 1.00, NULL, 200000, 150000, 50000, 0, 0, 18, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28000, 45000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 2, '120:8400;121:19600', 0, 0, 0, 0),
(417, 'dora_cannon', 400, '1,3', 0, 1.00, NULL, 350000, 150000, 75000, 0, 0, 24, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38000, 45000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 2, '121:19000;122:19000', 0, 0, 0, 0),
(418, 'photon_cannon', 400, '1,3', 0, 1.00, NULL, 2500000, 1250000, 350000, 0, 0, 160, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 190000, 200000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 3, '121:28500;122:47500;199:114000', 0, 0, 0, 0),
(419, 'particle_emitter', 400, '1,3', 0, 1.00, NULL, 45000000, 30000000, 8500000, 0, 0, 3475, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3500000, 5000000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 3, '121:700000;122:700000;199:2100000', 0, 0, 0, 0),
(420, 'megador_slim', 400, '1,3', 0, 1.00, NULL, 3500, 2500, 2500, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 850, 4000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '120:425;121:425', 0, 0, 0, 0),
(421, 'iron_megador', 400, '1,3', 0, 1.00, NULL, 110000, 210000, 60000, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40000, 55000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 2, '120:18000;121:18000;122:4000', 0, 0, 0, 0),
(422, 'grand_megador', 400, '1,3', 0, 1.00, NULL, 8750000, 11000000, 6000000, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1750000, 2150000, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 3, '120:700000;121:700000;122:350000', 0, 0, 0, 0),
(502, 'interceptor_misil', 500, '1,3', 0, 1.00, NULL, 8000, 0, 2000, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '0', 0, 0, 0, 0),
(503, 'interplanetary_misil', 500, '1,3', 0, 1.00, NULL, 12500, 2500, 10000, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 12000, 1, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 2, '0', 0, 0, 0, 0),
(601, 'rpg_geologue', 600, '1,3', 0, 1.15, 30, 0, 0, 0, 0, 1000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(602, 'rpg_amiral', 600, '1,3', 0, 1.20, 20, 0, 0, 0, 0, 1000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.01, 0.01, 0.01, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0);
INSERT INTO `uni1_vars` (`elementID`, `name`, `class`, `onPlanetType`, `onePerPlanet`, `factor`, `maxLevel`, `cost901`, `cost902`, `cost903`, `cost911`, `cost921`, `cost921special`, `cost922`, `costAP`, `consumption1`, `consumption2`, `speedTech`, `speed1`, `speed2`, `speed2Tech`, `speed2onLevel`, `speed3Tech`, `speed3onLevel`, `capacity`, `attack`, `defend`, `timeBonus`, `bonusAttack`, `bonusDefensive`, `bonusShield`, `bonusBuildTime`, `bonusResearchTime`, `bonusShipTime`, `bonusDefensiveTime`, `bonusResource`, `bonusEnergy`, `bonusResourceStorage`, `bonusShipStorage`, `bonusFlyTime`, `bonusFleetSlots`, `bonusPlanets`, `bonusSpyPower`, `bonusExpedition`, `bonusGateCoolTime`, `bonusMoreFound`, `bonusAttackUnit`, `bonusDefensiveUnit`, `bonusShieldUnit`, `bonusBuildTimeUnit`, `bonusResearchTimeUnit`, `bonusShipTimeUnit`, `bonusDefensiveTimeUnit`, `bonusResourceUnit`, `bonusEnergyUnit`, `bonusResourceStorageUnit`, `bonusShipStorageUnit`, `bonusFlyTimeUnit`, `bonusFleetSlotsUnit`, `bonusPlanetsUnit`, `bonusSpyPowerUnit`, `bonusExpeditionUnit`, `bonusGateCoolTimeUnit`, `bonusMoreFoundUnit`, `speedFleetFactor`, `production901`, `production902`, `production903`, `production911`, `production921`, `storage901`, `storage902`, `storage903`, `arsenal_bonus`, `fleetPointExpe`, `type_gun`, `wapeon_gun`, `alliance901`, `alliance902`, `alliance903`, `alliance911`) VALUES
(603, 'rpg_ingenieur', 600, '1,3', 0, 1.50, 10, 0, 0, 0, 0, 1500, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.05, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(604, 'rpg_technocrate', 600, '1,3', 0, 1.50, 20, 0, 0, 0, 0, 1500, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(605, 'rpg_constructeur', 600, '1,3', 0, 2.00, 3, 0, 0, 0, 0, 3000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, -0.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(606, 'rpg_scientifique', 600, '1,3', 0, 2.00, 3, 0, 0, 0, 0, 3000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, -0.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(607, 'rpg_stockeur', 600, '1,3', 0, 2.00, 2, 0, 0, 0, 0, 5000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.25, 0.25, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(608, 'rpg_defenseur', 600, '1,3', 0, 2.00, 4, 0, 0, 0, 0, 5000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(609, 'rpg_bunker', 600, '1,3', 0, 1.00, 1, 0, 0, 0, 0, 10000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(610, 'rpg_espion', 600, '1,3', 0, 2.00, 2, 0, 0, 0, 0, 5000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 1.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(611, 'rpg_commandant', 600, '1,3', 0, 2.00, 3, 0, 0, 0, 0, 3000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(612, 'rpg_destructeur', 600, '1,3', 0, 1.00, 1, 0, 0, 0, 0, 15000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(613, 'rpg_general', 600, '1,3', 0, 2.00, 3, 0, 0, 0, 0, 3000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, -0.05, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(614, 'rpg_raideur', 600, '1,3', 0, 1.00, 1, 0, 0, 0, 0, 10000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(615, 'rpg_empereur', 600, '1,3', 0, 1.00, 1, 0, 0, 0, 0, 10000, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(701, 'dm_attack', 700, '1,3', 0, 1.00, 65, 0, 0, 0, 0, 40000, 0, 0, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86400, 0.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(702, 'dm_defensive', 700, '1,3', 0, 1.00, 65, 0, 0, 0, 0, 40000, 0, 0, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86400, 0.00, 0.10, 0.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(703, 'dm_buildtime', 700, '1,3', 0, 1.00, 50, 0, 0, 0, 0, 7500, 0, 0, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86400, 0.00, 0.00, 0.00, -0.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(704, 'dm_resource', 700, '1,3', 0, 1.00, 250, 0, 0, 0, 0, 30000, 0, 0, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86400, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(705, 'dm_energie', 700, '1,3', 0, 1.00, 100, 0, 0, 0, 0, 10000, 0, 0, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86400, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(706, 'dm_researchtime', 700, '1,3', 0, 1.00, 40, 0, 0, 0, 0, 25000, 0, 0, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86400, 0.00, 0.00, 0.00, 0.00, -0.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(707, 'dm_fleettime', 700, '1,3', 0, 1.00, 40, 0, 0, 0, 0, 50000, 0, 0, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86400, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, -0.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', 0, 0, 0, 0),
(801, 'arsenal_laser', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.35, 0, 0, '0', 0, 0, 0, 0),
(802, 'arsenal_ion', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.35, 0, 0, '0', 0, 0, 0, 0),
(803, 'arsenal_plasma', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.35, 0, 0, '0', 0, 0, 0, 0),
(804, 'arsenal_gravity', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.35, 0, 0, '0', 0, 0, 0, 0),
(805, 'arsenal_dlight', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.4, 0, 0, '0', 0, 0, 0, 0),
(806, 'arsenal_dmedium', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.3, 0, 0, '0', 0, 0, 0, 0),
(807, 'arsenal_dheavy', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.2, 0, 0, '0', 0, 0, 0, 0),
(808, 'arsenal_slight', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.4, 0, 0, '0', 0, 0, 0, 0),
(809, 'arsenal_smedium', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.3, 0, 0, '0', 0, 0, 0, 0),
(810, 'arsenal_sheavy', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.2, 0, 0, '0', 0, 0, 0, 0),
(811, 'arsenal_combustion', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.4, 0, 0, '0', 0, 0, 0, 0),
(812, 'arsenal_impulse', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.4, 0, 0, '0', 0, 0, 0, 0),
(813, 'arsenal_hyperspace', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.4, 0, 0, '0', 0, 0, 0, 0),
(814, 'arsenal_res901', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.75, 0, 0, '0', 0, 0, 0, 0),
(815, 'arsenal_res902', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.6, 0, 0, '0', 0, 0, 0, 0),
(816, 'arsenal_res903', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.45, 0, 0, '0', 0, 0, 0, 0),
(817, 'arsenal_conveyor1', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.3, 0, 0, '0', 0, 0, 0, 0),
(818, 'arsenal_conveyor2', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.3, 0, 0, '0', 0, 0, 0, 0),
(819, 'arsenal_conveyor3', 800, '1,3', 0, 1.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.3, 0, 0, '0', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_vars_rapidfire`
--

CREATE TABLE `uni1_vars_rapidfire` (
  `elementID` int(11) NOT NULL,
  `rapidfireID` int(11) NOT NULL,
  `shoots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uni1_vars_rapidfire`
--

INSERT INTO `uni1_vars_rapidfire` (`elementID`, `rapidfireID`, `shoots`) VALUES
(230, 203, 400),
(221, 202, 10000),
(229, 203, 3),
(218, 202, 5000),
(228, 203, 1000),
(225, 212, 175),
(215, 202, 40),
(227, 203, 400),
(229, 212, 5),
(216, 204, 240),
(216, 206, 25),
(225, 203, 50),
(228, 212, 5000),
(224, 203, 30),
(224, 212, 50),
(204, 214, 3),
(215, 203, 15),
(222, 203, 2500),
(222, 212, 15500),
(221, 203, 2500),
(221, 212, 30000),
(211, 417, 20),
(211, 416, 25),
(211, 406, 50),
(211, 405, 70),
(221, 215, 825),
(218, 212, 22500),
(218, 215, 620),
(221, 213, 825),
(216, 203, 150),
(216, 212, 450),
(225, 215, 15),
(222, 215, 425),
(213, 203, 25),
(213, 209, 5),
(215, 204, 4),
(216, 205, 80),
(215, 206, 4),
(216, 207, 20),
(211, 404, 60),
(216, 215, 10),
(218, 213, 620),
(410, 214, 10),
(228, 214, 45),
(222, 214, 125),
(221, 214, 250),
(218, 214, 190),
(206, 202, 7),
(224, 215, 2),
(215, 205, 4),
(213, 206, 2),
(215, 207, 2),
(411, 202, 35000),
(215, 212, 50),
(230, 202, 400),
(213, 212, 50),
(205, 202, 3),
(207, 203, 7),
(213, 204, 2),
(213, 205, 2),
(207, 206, 2),
(213, 207, 3),
(218, 203, 2500),
(207, 209, 3),
(211, 403, 70),
(216, 213, 10),
(216, 214, 4),
(228, 216, 22),
(222, 216, 65),
(221, 216, 115),
(418, 216, 90),
(228, 202, 1000),
(207, 212, 25),
(227, 202, 400),
(206, 212, 10),
(204, 202, 2),
(206, 203, 3),
(207, 204, 2),
(207, 205, 2),
(206, 206, 2),
(411, 203, 27500),
(206, 209, 2),
(211, 402, 80),
(215, 213, 2),
(213, 215, 4),
(218, 401, 400),
(218, 402, 200),
(218, 403, 100),
(218, 404, 50),
(218, 405, 100),
(225, 202, 85),
(205, 212, 5),
(224, 202, 40),
(222, 202, 4500),
(204, 218, 2),
(204, 221, 2),
(204, 222, 2),
(204, 226, 2),
(204, 227, 2),
(204, 228, 2),
(204, 230, 2),
(218, 204, 4000),
(221, 204, 4000),
(222, 204, 3750),
(224, 204, 3),
(225, 204, 7),
(227, 204, 600),
(229, 204, 2),
(230, 204, 565),
(401, 204, 2),
(402, 204, 5),
(403, 204, 8),
(411, 204, 35000),
(420, 204, 3),
(205, 214, 3),
(205, 216, 2),
(205, 218, 3),
(205, 221, 3),
(205, 222, 3),
(205, 225, 2),
(205, 226, 2),
(205, 227, 2),
(205, 228, 3),
(205, 230, 3),
(218, 205, 1500),
(221, 205, 1500),
(222, 205, 1350),
(224, 205, 3),
(225, 205, 7),
(227, 205, 215),
(228, 205, 550),
(230, 205, 220),
(403, 205, 4),
(411, 205, 27500),
(420, 205, 2),
(229, 214, 4),
(229, 216, 2),
(229, 218, 4),
(229, 221, 4),
(229, 212, 4),
(229, 225, 2),
(229, 226, 3),
(229, 227, 4),
(229, 228, 4),
(229, 230, 3),
(229, 222, 4),
(213, 229, 2),
(215, 229, 3),
(216, 229, 75),
(218, 229, 2000),
(221, 229, 2500),
(222, 229, 1600),
(224, 229, 3),
(225, 229, 5),
(227, 229, 250),
(228, 229, 545),
(230, 229, 300),
(403, 229, 3),
(411, 229, 25000),
(420, 229, 2),
(215, 209, 3),
(216, 209, 85),
(218, 209, 1800),
(221, 209, 2250),
(222, 209, 1450),
(224, 209, 10),
(225, 209, 35),
(227, 209, 255),
(228, 209, 550),
(206, 207, 2),
(206, 215, 2),
(218, 206, 650),
(221, 206, 650),
(222, 206, 450),
(224, 206, 2),
(225, 206, 25),
(227, 206, 70),
(228, 206, 190),
(230, 206, 60),
(404, 206, 3),
(405, 206, 2),
(406, 206, 5),
(411, 206, 10000),
(416, 206, 2),
(421, 206, 2),
(422, 206, 2),
(218, 207, 500),
(221, 207, 500),
(222, 207, 350),
(225, 207, 10),
(227, 207, 55),
(228, 207, 170),
(230, 207, 55),
(404, 207, 2),
(405, 207, 2),
(406, 207, 3),
(411, 207, 7500),
(416, 207, 2),
(421, 207, 2),
(422, 207, 2),
(230, 215, 25),
(228, 215, 135),
(227, 215, 40),
(215, 219, 6),
(207, 213, 2),
(211, 401, 100),
(421, 217, 7),
(411, 217, 5000),
(230, 217, 90),
(228, 217, 370),
(227, 217, 115),
(225, 217, 35),
(224, 217, 5),
(222, 217, 1100),
(221, 217, 1920),
(218, 217, 1520),
(216, 217, 35),
(215, 217, 3),
(213, 217, 2),
(406, 215, 2),
(411, 215, 4000),
(412, 215, 15),
(415, 215, 27),
(416, 215, 3),
(417, 215, 7),
(422, 215, 3),
(213, 202, 40),
(213, 224, 2),
(213, 219, 5),
(222, 213, 425),
(224, 213, 2),
(225, 213, 10),
(227, 213, 40),
(228, 213, 135),
(230, 213, 25),
(411, 213, 4000),
(412, 213, 15),
(415, 213, 30),
(416, 213, 4),
(417, 213, 6),
(422, 213, 3),
(211, 420, 30),
(211, 421, 5),
(211, 422, 3),
(213, 211, 2),
(215, 211, 2),
(216, 211, 7),
(218, 211, 350),
(221, 211, 450),
(222, 211, 240),
(224, 211, 3),
(225, 211, 5),
(226, 211, 6),
(227, 211, 25),
(228, 211, 80),
(230, 211, 20),
(406, 211, 2),
(416, 211, 5),
(417, 211, 10),
(421, 211, 10),
(422, 211, 5),
(216, 224, 7),
(218, 224, 280),
(221, 224, 350),
(222, 224, 225),
(225, 224, 11),
(227, 224, 25),
(228, 224, 70),
(230, 224, 15),
(411, 224, 3500),
(415, 224, 20),
(416, 224, 2),
(417, 224, 3),
(422, 224, 3),
(216, 219, 15),
(218, 219, 650),
(221, 219, 825),
(222, 219, 470),
(225, 219, 30),
(228, 219, 160),
(225, 226, 4),
(216, 225, 5),
(218, 225, 200),
(221, 225, 260),
(222, 225, 135),
(227, 225, 5),
(228, 225, 45),
(230, 225, 5),
(411, 225, 2500),
(418, 225, 5),
(226, 410, 25),
(226, 412, 30),
(226, 413, 20),
(226, 414, 10),
(226, 418, 40),
(226, 419, 15),
(226, 421, 3),
(226, 422, 7),
(216, 226, 2),
(218, 226, 80),
(221, 226, 105),
(222, 226, 60),
(227, 226, 5),
(228, 226, 9),
(410, 226, 5),
(411, 226, 500),
(412, 226, 3),
(413, 226, 5),
(215, 226, 25),
(215, 226, 35),
(418, 226, 3),
(419, 226, 15),
(421, 226, 2),
(422, 226, 7),
(411, 214, 1000),
(412, 214, 5),
(413, 214, 12),
(414, 214, 8),
(415, 214, 20),
(418, 214, 2),
(419, 214, 8),
(230, 216, 6),
(410, 216, 8),
(411, 216, 1000),
(412, 216, 5),
(213, 216, 10),
(214, 216, 8),
(415, 216, 20),
(418, 216, 2),
(419, 216, 8),
(230, 227, 2),
(218, 230, 30),
(221, 230, 55),
(222, 230, 15),
(227, 230, 2),
(228, 230, 2),
(211, 211, 2),
(410, 230, 5),
(411, 230, 250),
(414, 230, 6),
(218, 227, 25),
(221, 227, 55),
(222, 227, 15),
(228, 227, 2),
(410, 227, 5),
(411, 227, 250),
(413, 227, 4),
(414, 227, 6),
(419, 227, 3),
(228, 204, 1550),
(218, 228, 20),
(221, 228, 30),
(222, 228, 5),
(411, 228, 150),
(414, 228, 4),
(415, 228, 8),
(419, 228, 2),
(222, 218, 2),
(222, 221, 2),
(222, 415, 2),
(218, 222, 2),
(221, 222, 5),
(411, 222, 100),
(414, 222, 5),
(415, 222, 5),
(218, 216, 90),
(218, 221, 2),
(218, 222, 2),
(218, 228, 20),
(218, 415, 5),
(221, 218, 5),
(411, 218, 90),
(414, 218, 5),
(415, 218, 5),
(221, 415, 3),
(207, 207, 2),
(415, 221, 2),
(411, 209, 10000),
(411, 221, 80);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_vars_requriements`
--

CREATE TABLE `uni1_vars_requriements` (
  `elementID` int(11) NOT NULL,
  `requireID` int(11) NOT NULL,
  `requireLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uni1_vars_requriements`
--

INSERT INTO `uni1_vars_requriements` (`elementID`, `requireID`, `requireLevel`) VALUES
(6, 14, 20),
(6, 31, 22),
(6, 15, 4),
(6, 108, 12),
(6, 123, 3),
(12, 3, 5),
(12, 113, 3),
(15, 14, 10),
(15, 108, 10),
(21, 14, 2),
(33, 15, 1),
(33, 113, 12),
(42, 41, 1),
(43, 41, 1),
(43, 114, 7),
(44, 21, 1),
(106, 31, 3),
(108, 31, 1),
(109, 31, 4),
(110, 113, 3),
(110, 31, 6),
(111, 31, 2),
(113, 31, 1),
(114, 113, 5),
(114, 110, 5),
(114, 31, 7),
(115, 113, 1),
(115, 31, 1),
(117, 113, 1),
(117, 31, 2),
(118, 114, 3),
(118, 31, 7),
(120, 31, 1),
(120, 113, 2),
(121, 31, 4),
(121, 120, 5),
(121, 113, 4),
(122, 31, 5),
(122, 113, 8),
(122, 120, 10),
(122, 121, 5),
(123, 31, 10),
(123, 108, 8),
(123, 114, 8),
(124, 106, 3),
(124, 117, 3),
(124, 31, 3),
(131, 31, 8),
(131, 113, 5),
(132, 31, 8),
(132, 113, 5),
(133, 31, 8),
(133, 113, 5),
(199, 31, 12),
(202, 21, 2),
(202, 115, 2),
(203, 21, 4),
(203, 115, 6),
(204, 21, 1),
(204, 115, 1),
(205, 21, 3),
(205, 111, 2),
(205, 117, 2),
(206, 21, 5),
(206, 117, 4),
(206, 121, 2),
(207, 21, 7),
(207, 118, 4),
(208, 21, 4),
(208, 117, 3),
(209, 21, 4),
(209, 115, 6),
(209, 110, 2),
(210, 21, 3),
(210, 115, 3),
(210, 106, 2),
(211, 117, 6),
(211, 21, 8),
(211, 122, 5),
(212, 21, 1),
(213, 21, 9),
(213, 118, 6),
(213, 114, 5),
(214, 21, 12),
(214, 118, 7),
(214, 114, 6),
(214, 199, 1),
(215, 114, 5),
(215, 120, 12),
(215, 118, 5),
(215, 21, 8),
(227, 21, 16),
(216, 21, 15),
(216, 109, 14),
(216, 110, 14),
(216, 111, 15),
(216, 114, 10),
(216, 120, 20),
(216, 199, 3),
(217, 111, 10),
(217, 21, 14),
(217, 114, 10),
(217, 110, 14),
(217, 117, 15),
(218, 21, 18),
(218, 109, 20),
(218, 110, 20),
(218, 111, 20),
(218, 114, 15),
(218, 118, 20),
(218, 120, 25),
(218, 199, 8),
(219, 21, 15),
(219, 109, 15),
(219, 110, 15),
(219, 111, 15),
(219, 118, 8),
(220, 21, 9),
(220, 114, 5),
(220, 118, 6),
(401, 21, 1),
(420, 120, 2),
(402, 21, 2),
(402, 120, 3),
(420, 121, 2),
(403, 21, 4),
(403, 120, 6),
(404, 21, 6),
(404, 113, 6),
(404, 109, 3),
(404, 110, 1),
(405, 21, 4),
(405, 121, 4),
(406, 21, 8),
(406, 122, 7),
(407, 110, 2),
(407, 21, 1),
(408, 110, 6),
(408, 21, 6),
(409, 609, 1),
(410, 199, 7),
(410, 21, 18),
(410, 109, 20),
(411, 615, 1),
(411, 21, 20),
(411, 113, 20),
(411, 111, 25),
(411, 108, 15),
(411, 122, 20),
(411, 110, 22),
(411, 199, 10),
(502, 44, 2),
(502, 21, 1),
(503, 44, 4),
(503, 21, 1),
(503, 117, 1),
(603, 601, 5),
(604, 602, 5),
(605, 601, 10),
(605, 603, 2),
(606, 601, 10),
(606, 603, 2),
(607, 605, 1),
(608, 606, 1),
(609, 601, 20),
(609, 603, 10),
(609, 605, 3),
(609, 606, 3),
(609, 607, 2),
(609, 608, 2),
(610, 602, 10),
(610, 604, 5),
(611, 602, 10),
(611, 604, 5),
(612, 610, 1),
(613, 611, 1),
(614, 602, 20),
(614, 604, 10),
(614, 610, 2),
(614, 611, 2),
(614, 612, 1),
(614, 613, 3),
(615, 614, 1),
(615, 609, 1),
(71, 15, 5),
(71, 21, 10),
(72, 15, 8),
(72, 21, 14),
(73, 15, 10),
(73, 21, 18),
(125, 34, 1),
(125, 31, 3),
(229, 21, 3),
(229, 120, 3),
(229, 117, 3),
(229, 111, 2),
(224, 21, 12),
(224, 118, 7),
(224, 114, 6),
(224, 120, 12),
(224, 121, 8),
(223, 21, 1),
(225, 120, 14),
(225, 21, 11),
(225, 121, 14),
(225, 109, 12),
(225, 110, 12),
(225, 111, 12),
(225, 118, 6),
(226, 21, 14),
(226, 120, 12),
(226, 121, 17),
(226, 109, 14),
(226, 110, 13),
(226, 111, 13),
(226, 118, 10),
(230, 118, 13),
(230, 111, 16),
(230, 110, 16),
(230, 109, 17),
(230, 199, 6),
(230, 122, 18),
(230, 120, 16),
(230, 21, 16),
(227, 120, 17),
(227, 121, 19),
(227, 199, 5),
(227, 109, 16),
(227, 110, 16),
(227, 111, 17),
(227, 118, 14),
(228, 21, 18),
(228, 121, 20),
(228, 122, 20),
(228, 199, 7),
(228, 109, 17),
(228, 110, 18),
(228, 111, 18),
(228, 118, 16),
(222, 21, 17),
(222, 109, 18),
(222, 110, 18),
(222, 111, 18),
(222, 118, 20),
(222, 120, 23),
(222, 199, 8),
(222, 122, 18),
(221, 21, 20),
(221, 109, 22),
(221, 110, 22),
(221, 111, 22),
(221, 118, 22),
(221, 199, 9),
(221, 122, 20),
(221, 614, 1),
(420, 21, 3),
(420, 110, 2),
(416, 21, 7),
(416, 120, 5),
(416, 121, 7),
(421, 121, 5),
(421, 120, 5),
(421, 122, 5),
(421, 21, 9),
(421, 110, 7),
(417, 21, 9),
(417, 121, 8),
(417, 122, 11),
(418, 21, 17),
(418, 109, 18),
(418, 110, 17),
(418, 111, 18),
(418, 121, 14),
(418, 122, 14),
(418, 199, 4),
(412, 122, 17),
(412, 120, 24),
(412, 113, 20),
(412, 109, 20),
(412, 21, 18),
(413, 199, 8),
(413, 110, 21),
(413, 122, 20),
(413, 111, 22),
(413, 113, 18),
(413, 21, 18),
(422, 121, 17),
(422, 120, 17),
(422, 122, 15),
(422, 21, 20),
(422, 110, 11),
(419, 21, 20),
(419, 109, 20),
(419, 110, 19),
(419, 111, 19),
(419, 121, 17),
(419, 122, 19),
(419, 199, 7),
(414, 21, 20),
(414, 109, 23),
(414, 110, 21),
(414, 121, 24),
(414, 199, 6),
(415, 21, 22),
(415, 15, 17),
(415, 109, 23),
(415, 110, 23),
(415, 111, 23),
(415, 121, 18),
(415, 122, 23),
(415, 199, 9),
(409, 21, 15),
(1102, 1101, 3),
(1104, 1101, 5),
(1105, 1101, 5),
(1103, 1102, 7),
(1106, 1104, 3),
(1107, 1105, 0),
(1107, 1105, 5),
(1108, 1103, 5),
(1109, 1103, 7),
(1110, 1103, 7),
(1112, 1107, 10),
(1111, 1108, 5),
(1113, 1109, 5),
(1202, 1201, 3),
(1209, 1202, 10),
(1210, 1202, 10),
(1203, 1202, 7),
(1204, 1202, 7),
(1208, 1202, 15),
(1205, 1203, 12),
(1207, 1204, 5),
(1206, 1205, 3),
(1312, 1301, 15),
(1304, 1301, 8),
(1310, 1301, 8),
(1302, 1301, 10),
(1313, 1312, 5),
(1305, 1304, 8),
(1306, 1304, 8),
(1303, 1302, 4),
(1314, 1313, 3),
(1307, 1305, 3),
(1309, 1306, 20),
(1308, 1303, 7),
(1311, 1303, 5),
(7, 21, 16),
(7, 15, 7),
(7, 113, 15),
(150, 31, 15),
(150, 131, 18),
(150, 132, 18),
(150, 133, 18),
(150, 108, 22),
(150, 110, 19),
(150, 111, 20),
(409, 173, 3);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_votesystem`
--

CREATE TABLE `uni1_votesystem` (
  `id` bigint(20) NOT NULL,
  `link` text NOT NULL,
  `prize` int(11) NOT NULL,
  `image` text NOT NULL,
  `time` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `universe` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uni1_votesystem`
--

INSERT INTO `uni1_votesystem` (`id`, `link`, `prize`, `image`, `time`, `universe`) VALUES
(1, 'http://gametoor.com/in/2639', 1, 'https://wog2.warofgalaxyz.com/styles/resource/images/vote.jpg', 12, 1),
(2, 'https://private-server.ws/index.php?a=in&u=WarOfGalaxyz2', 1, 'https://private-server.ws/button.php?u=WarOfGalaxyz2&buttontype=static', 12, 1),
(4, 'https://topg.org/ogame-private-servers/in-490209', 1, 'https://topg.org/topg2.gif', 12, 1);

-- --------------------------------------------------------

--
-- Structure de la table `uni1_votesystem_log`
--

CREATE TABLE `uni1_votesystem_log` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `vote_system_id` bigint(20) NOT NULL DEFAULT '0',
  `user_ip` varchar(255) CHARACTER SET latin1 NOT NULL,
  `isSucces` tinyint(11) UNSIGNED NOT NULL DEFAULT '0',
  `universe` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_voucher_codes`
--

CREATE TABLE `uni1_voucher_codes` (
  `voucherId` int(11) UNSIGNED NOT NULL,
  `foundBy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `voucherCode` varchar(255) DEFAULT NULL,
  `usedBy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `usedTime` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_wrecks`
--

CREATE TABLE `uni1_wrecks` (
  `wreckID` int(11) UNSIGNED NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `planetID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `wreck_array` text CHARACTER SET utf8,
  `startTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `expiredTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `inBuild` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `startBuildTime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `lastUpdate` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `isFinished` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `deleted` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `lastRepaired` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `possibleDeletion` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Index pour la table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Index pour la table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Index pour la table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Index pour la table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Index pour la table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Index pour la table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Index pour la table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Index pour la table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Index pour la table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Index pour la table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Index pour la table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Index pour la table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- Index pour la table `uni1_academy_skills`
--
ALTER TABLE `uni1_academy_skills`
  ADD UNIQUE KEY `skill_id` (`skill_id`);

--
-- Index pour la table `uni1_achats_log`
--
ALTER TABLE `uni1_achats_log`
  ADD PRIMARY KEY (`achatID`);

--
-- Index pour la table `uni1_adminpanel_logs`
--
ALTER TABLE `uni1_adminpanel_logs`
  ADD PRIMARY KEY (`logId`);

--
-- Index pour la table `uni1_admin_logins`
--
ALTER TABLE `uni1_admin_logins`
  ADD PRIMARY KEY (`adminLog`);

--
-- Index pour la table `uni1_aks`
--
ALTER TABLE `uni1_aks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `uni1_alliance`
--
ALTER TABLE `uni1_alliance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ally_tag` (`ally_tag`),
  ADD KEY `ally_name` (`ally_name`),
  ADD KEY `ally_universe` (`ally_universe`);

--
-- Index pour la table `uni1_alliance_fractions`
--
ALTER TABLE `uni1_alliance_fractions`
  ADD UNIQUE KEY `ally_fraction_id` (`ally_fraction_id`);

--
-- Index pour la table `uni1_alliance_ranks`
--
ALTER TABLE `uni1_alliance_ranks`
  ADD PRIMARY KEY (`rankID`),
  ADD KEY `allianceID` (`allianceID`,`rankID`);

--
-- Index pour la table `uni1_alliance_request`
--
ALTER TABLE `uni1_alliance_request`
  ADD PRIMARY KEY (`applyID`),
  ADD KEY `allianceID` (`allianceID`,`userID`);

--
-- Index pour la table `uni1_amtracker`
--
ALTER TABLE `uni1_amtracker`
  ADD PRIMARY KEY (`trackId`);

--
-- Index pour la table `uni1_antimatter_use`
--
ALTER TABLE `uni1_antimatter_use`
  ADD PRIMARY KEY (`useID`);

--
-- Index pour la table `uni1_api_blocked`
--
ALTER TABLE `uni1_api_blocked`
  ADD PRIMARY KEY (`blockId`);

--
-- Index pour la table `uni1_api_calls`
--
ALTER TABLE `uni1_api_calls`
  ADD UNIQUE KEY `callId` (`callId`);

--
-- Index pour la table `uni1_auctions_active`
--
ALTER TABLE `uni1_auctions_active`
  ADD PRIMARY KEY (`auctionId`);

--
-- Index pour la table `uni1_auctions_active_log`
--
ALTER TABLE `uni1_auctions_active_log`
  ADD PRIMARY KEY (`userId`);

--
-- Index pour la table `uni1_auctions_used`
--
ALTER TABLE `uni1_auctions_used`
  ADD PRIMARY KEY (`useID`);

--
-- Index pour la table `uni1_auto_expedition`
--
ALTER TABLE `uni1_auto_expedition`
  ADD UNIQUE KEY `autoId` (`autoId`);

--
-- Index pour la table `uni1_banned`
--
ALTER TABLE `uni1_banned`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `ID` (`id`),
  ADD KEY `universe` (`universe`);

--
-- Index pour la table `uni1_blacklist`
--
ALTER TABLE `uni1_blacklist`
  ADD UNIQUE KEY `blackId` (`blackId`);

--
-- Index pour la table `uni1_blocklist`
--
ALTER TABLE `uni1_blocklist`
  ADD PRIMARY KEY (`blockID`);

--
-- Index pour la table `uni1_buddy`
--
ALTER TABLE `uni1_buddy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `universe` (`universe`),
  ADD KEY `sender` (`sender`,`owner`);

--
-- Index pour la table `uni1_buddy_request`
--
ALTER TABLE `uni1_buddy_request`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `uni1_bunker_log`
--
ALTER TABLE `uni1_bunker_log`
  ADD PRIMARY KEY (`logID`);

--
-- Index pour la table `uni1_chat`
--
ALTER TABLE `uni1_chat`
  ADD PRIMARY KEY (`messageid`),
  ADD KEY `i_ally_idmess` (`ally_id`,`messageid`);

--
-- Index pour la table `uni1_chat_online`
--
ALTER TABLE `uni1_chat_online`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `uni1_chat_online_ally`
--
ALTER TABLE `uni1_chat_online_ally`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `uni1_chat_rooms`
--
ALTER TABLE `uni1_chat_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `uni1_chat_rooms_messages`
--
ALTER TABLE `uni1_chat_rooms_messages`
  ADD PRIMARY KEY (`messageid`);

--
-- Index pour la table `uni1_chat_rooms_online`
--
ALTER TABLE `uni1_chat_rooms_online`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `uni1_comments`
--
ALTER TABLE `uni1_comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `uni1_config`
--
ALTER TABLE `uni1_config`
  ADD PRIMARY KEY (`uni`);

--
-- Index pour la table `uni1_cronjobs`
--
ALTER TABLE `uni1_cronjobs`
  ADD UNIQUE KEY `cronjobID` (`cronjobID`),
  ADD KEY `isActive` (`isActive`,`nextTime`,`lock`,`cronjobID`);

--
-- Index pour la table `uni1_cronjobs_log`
--
ALTER TABLE `uni1_cronjobs_log`
  ADD KEY `cronjobId` (`cronjobId`,`executionTime`);

--
-- Index pour la table `uni1_darkmatter_logs`
--
ALTER TABLE `uni1_darkmatter_logs`
  ADD PRIMARY KEY (`darkId`);

--
-- Index pour la table `uni1_diplo`
--
ALTER TABLE `uni1_diplo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `universe` (`universe`),
  ADD KEY `owner_1` (`owner_1`,`owner_2`,`accept`);

--
-- Index pour la table `uni1_easyresourceadd`
--
ALTER TABLE `uni1_easyresourceadd`
  ADD UNIQUE KEY `addId` (`addId`);

--
-- Index pour la table `uni1_emails`
--
ALTER TABLE `uni1_emails`
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `uni1_fleetdealer_log`
--
ALTER TABLE `uni1_fleetdealer_log`
  ADD PRIMARY KEY (`sellID`);

--
-- Index pour la table `uni1_fleets`
--
ALTER TABLE `uni1_fleets`
  ADD PRIMARY KEY (`fleet_id`),
  ADD KEY `fleet_target_owner` (`fleet_target_owner`,`fleet_mission`),
  ADD KEY `fleet_owner` (`fleet_owner`,`fleet_mission`),
  ADD KEY `fleet_group` (`fleet_group`);

--
-- Index pour la table `uni1_fleetstats`
--
ALTER TABLE `uni1_fleetstats`
  ADD UNIQUE KEY `universe` (`universe`);

--
-- Index pour la table `uni1_fleet_event`
--
ALTER TABLE `uni1_fleet_event`
  ADD PRIMARY KEY (`fleetID`),
  ADD KEY `lock` (`lock`,`time`);

--
-- Index pour la table `uni1_fleet_groups`
--
ALTER TABLE `uni1_fleet_groups`
  ADD PRIMARY KEY (`groupId`);

--
-- Index pour la table `uni1_freecode`
--
ALTER TABLE `uni1_freecode`
  ADD PRIMARY KEY (`codeID`);

--
-- Index pour la table `uni1_galaxy7_account`
--
ALTER TABLE `uni1_galaxy7_account`
  ADD UNIQUE KEY `specialId` (`specialId`);

--
-- Index pour la table `uni1_galaxy7_planet`
--
ALTER TABLE `uni1_galaxy7_planet`
  ADD UNIQUE KEY `specialId` (`specialId`);

--
-- Index pour la table `uni1_gouvernors`
--
ALTER TABLE `uni1_gouvernors`
  ADD UNIQUE KEY `gouvernorId` (`gouvernorId`);

--
-- Index pour la table `uni1_ip_multimod`
--
ALTER TABLE `uni1_ip_multimod`
  ADD UNIQUE KEY `suspectId` (`suspectId`);

--
-- Index pour la table `uni1_log`
--
ALTER TABLE `uni1_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mode` (`mode`);

--
-- Index pour la table `uni1_log_fleets`
--
ALTER TABLE `uni1_log_fleets`
  ADD PRIMARY KEY (`fleet_id`),
  ADD KEY `BashRule` (`fleet_owner`,`fleet_end_id`,`fleet_start_time`,`fleet_mission`,`fleet_state`);

--
-- Index pour la table `uni1_loteria`
--
ALTER TABLE `uni1_loteria`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Index pour la table `uni1_loteriaam`
--
ALTER TABLE `uni1_loteriaam`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Index pour la table `uni1_memory_usage`
--
ALTER TABLE `uni1_memory_usage`
  ADD PRIMARY KEY (`memoryLog`);

--
-- Index pour la table `uni1_mercenary`
--
ALTER TABLE `uni1_mercenary`
  ADD PRIMARY KEY (`mercenaryId`);

--
-- Index pour la table `uni1_messages`
--
ALTER TABLE `uni1_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `message_sender` (`message_sender`),
  ADD KEY `message_owner` (`message_owner`,`message_type`,`message_unread`);

--
-- Index pour la table `uni1_multi`
--
ALTER TABLE `uni1_multi`
  ADD PRIMARY KEY (`multiID`),
  ADD KEY `userID` (`userID`);

--
-- Index pour la table `uni1_notes`
--
ALTER TABLE `uni1_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `universe` (`universe`),
  ADD KEY `owner` (`owner`,`time`,`priority`);

--
-- Index pour la table `uni1_notifications`
--
ALTER TABLE `uni1_notifications`
  ADD PRIMARY KEY (`notifId`);

--
-- Index pour la table `uni1_paysafecards_initiated`
--
ALTER TABLE `uni1_paysafecards_initiated`
  ADD PRIMARY KEY (`logId`);

--
-- Index pour la table `uni1_planetimage`
--
ALTER TABLE `uni1_planetimage`
  ADD UNIQUE KEY `imageId` (`imageId`);

--
-- Index pour la table `uni1_planets`
--
ALTER TABLE `uni1_planets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_luna` (`id_luna`),
  ADD KEY `id_owner` (`id_owner`),
  ADD KEY `destruyed` (`destruyed`),
  ADD KEY `universe` (`universe`,`galaxy`,`system`,`planet`,`planet_type`);

--
-- Index pour la table `uni1_planet_auction`
--
ALTER TABLE `uni1_planet_auction`
  ADD PRIMARY KEY (`auctionID`);

--
-- Index pour la table `uni1_planet_auction_items`
--
ALTER TABLE `uni1_planet_auction_items`
  ADD PRIMARY KEY (`itemID`);

--
-- Index pour la table `uni1_planet_auction_offers`
--
ALTER TABLE `uni1_planet_auction_offers`
  ADD PRIMARY KEY (`offerId`);

--
-- Index pour la table `uni1_planet_auction_upg`
--
ALTER TABLE `uni1_planet_auction_upg`
  ADD PRIMARY KEY (`upgradeID`);

--
-- Index pour la table `uni1_premium_calc`
--
ALTER TABLE `uni1_premium_calc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `uni1_purchase_logs`
--
ALTER TABLE `uni1_purchase_logs`
  ADD PRIMARY KEY (`payID`);

--
-- Index pour la table `uni1_raports`
--
ALTER TABLE `uni1_raports`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `time` (`time`);

--
-- Index pour la table `uni1_resource_logs`
--
ALTER TABLE `uni1_resource_logs`
  ADD PRIMARY KEY (`resourceId`),
  ADD UNIQUE KEY `resourceId` (`resourceId`);

--
-- Index pour la table `uni1_saved_galaxy`
--
ALTER TABLE `uni1_saved_galaxy`
  ADD PRIMARY KEY (`savedId`);

--
-- Index pour la table `uni1_session`
--
ALTER TABLE `uni1_session`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD KEY `sessionID` (`sessionID`);

--
-- Index pour la table `uni1_shortcuts`
--
ALTER TABLE `uni1_shortcuts`
  ADD PRIMARY KEY (`shortcutID`),
  ADD KEY `ownerID` (`ownerID`);

--
-- Index pour la table `uni1_statpoints`
--
ALTER TABLE `uni1_statpoints`
  ADD KEY `id_owner` (`id_owner`),
  ADD KEY `universe` (`universe`),
  ADD KEY `stat_type` (`stat_type`);

--
-- Index pour la table `uni1_storages_logs`
--
ALTER TABLE `uni1_storages_logs`
  ADD PRIMARY KEY (`storageID`);

--
-- Index pour la table `uni1_storages_logs_star`
--
ALTER TABLE `uni1_storages_logs_star`
  ADD PRIMARY KEY (`storageID`);

--
-- Index pour la table `uni1_storage_personal`
--
ALTER TABLE `uni1_storage_personal`
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Index pour la table `uni1_suprimus`
--
ALTER TABLE `uni1_suprimus`
  ADD PRIMARY KEY (`surpimoId`);

--
-- Index pour la table `uni1_suprimus_logs`
--
ALTER TABLE `uni1_suprimus_logs`
  ADD UNIQUE KEY `suprimusLog` (`suprimusLog`);

--
-- Index pour la table `uni1_ticket`
--
ALTER TABLE `uni1_ticket`
  ADD PRIMARY KEY (`ticketID`),
  ADD KEY `ownerID` (`ownerID`),
  ADD KEY `universe` (`universe`,`status`);

--
-- Index pour la table `uni1_ticket_answer`
--
ALTER TABLE `uni1_ticket_answer`
  ADD PRIMARY KEY (`answerID`);

--
-- Index pour la table `uni1_ticket_category`
--
ALTER TABLE `uni1_ticket_category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Index pour la table `uni1_timebonus_log`
--
ALTER TABLE `uni1_timebonus_log`
  ADD PRIMARY KEY (`logID`);

--
-- Index pour la table `uni1_topkb`
--
ALTER TABLE `uni1_topkb`
  ADD UNIQUE KEY `rid` (`rid`),
  ADD KEY `time` (`universe`,`rid`,`time`);

--
-- Index pour la table `uni1_tourney`
--
ALTER TABLE `uni1_tourney`
  ADD PRIMARY KEY (`tourneyId`);

--
-- Index pour la table `uni1_tourney_logs`
--
ALTER TABLE `uni1_tourney_logs`
  ADD PRIMARY KEY (`logId`);

--
-- Index pour la table `uni1_tourney_participante`
--
ALTER TABLE `uni1_tourney_participante`
  ADD PRIMARY KEY (`joinId`);

--
-- Index pour la table `uni1_tracking_mod`
--
ALTER TABLE `uni1_tracking_mod`
  ADD PRIMARY KEY (`trackId`);

--
-- Index pour la table `uni1_transport_player`
--
ALTER TABLE `uni1_transport_player`
  ADD PRIMARY KEY (`transportID`);

--
-- Index pour la table `uni1_users`
--
ALTER TABLE `uni1_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authlevel` (`authlevel`),
  ADD KEY `ref_bonus` (`ref_bonus`),
  ADD KEY `universe` (`universe`,`username`,`password`,`onlinetime`,`authlevel`),
  ADD KEY `ally_id` (`ally_id`);

--
-- Index pour la table `uni1_users_to_acs`
--
ALTER TABLE `uni1_users_to_acs`
  ADD KEY `userID` (`userID`),
  ADD KEY `acsID` (`acsID`);

--
-- Index pour la table `uni1_users_to_extauth`
--
ALTER TABLE `uni1_users_to_extauth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `account` (`account`,`mode`);

--
-- Index pour la table `uni1_users_to_topkb`
--
ALTER TABLE `uni1_users_to_topkb`
  ADD KEY `rid` (`rid`,`role`);

--
-- Index pour la table `uni1_users_valid`
--
ALTER TABLE `uni1_users_valid`
  ADD PRIMARY KEY (`validationID`,`validationKey`);

--
-- Index pour la table `uni1_vars`
--
ALTER TABLE `uni1_vars`
  ADD PRIMARY KEY (`elementID`),
  ADD KEY `class` (`class`);

--
-- Index pour la table `uni1_vars_rapidfire`
--
ALTER TABLE `uni1_vars_rapidfire`
  ADD KEY `elementID` (`elementID`),
  ADD KEY `rapidfireID` (`rapidfireID`);

--
-- Index pour la table `uni1_vars_requriements`
--
ALTER TABLE `uni1_vars_requriements`
  ADD KEY `elementID` (`elementID`),
  ADD KEY `requireID` (`requireID`);

--
-- Index pour la table `uni1_votesystem`
--
ALTER TABLE `uni1_votesystem`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `uni1_voucher_codes`
--
ALTER TABLE `uni1_voucher_codes`
  ADD PRIMARY KEY (`voucherId`);

--
-- Index pour la table `uni1_wrecks`
--
ALTER TABLE `uni1_wrecks`
  ADD PRIMARY KEY (`wreckID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_achats_log`
--
ALTER TABLE `uni1_achats_log`
  MODIFY `achatID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_adminpanel_logs`
--
ALTER TABLE `uni1_adminpanel_logs`
  MODIFY `logId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_admin_logins`
--
ALTER TABLE `uni1_admin_logins`
  MODIFY `adminLog` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_aks`
--
ALTER TABLE `uni1_aks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `uni1_alliance`
--
ALTER TABLE `uni1_alliance`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_alliance_ranks`
--
ALTER TABLE `uni1_alliance_ranks`
  MODIFY `rankID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_alliance_request`
--
ALTER TABLE `uni1_alliance_request`
  MODIFY `applyID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT pour la table `uni1_amtracker`
--
ALTER TABLE `uni1_amtracker`
  MODIFY `trackId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_antimatter_use`
--
ALTER TABLE `uni1_antimatter_use`
  MODIFY `useID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_api_blocked`
--
ALTER TABLE `uni1_api_blocked`
  MODIFY `blockId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_api_calls`
--
ALTER TABLE `uni1_api_calls`
  MODIFY `callId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_auctions_active`
--
ALTER TABLE `uni1_auctions_active`
  MODIFY `auctionId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_auctions_used`
--
ALTER TABLE `uni1_auctions_used`
  MODIFY `useID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_auto_expedition`
--
ALTER TABLE `uni1_auto_expedition`
  MODIFY `autoId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_banned`
--
ALTER TABLE `uni1_banned`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_blacklist`
--
ALTER TABLE `uni1_blacklist`
  MODIFY `blackId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_blocklist`
--
ALTER TABLE `uni1_blocklist`
  MODIFY `blockID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_buddy`
--
ALTER TABLE `uni1_buddy`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_bunker_log`
--
ALTER TABLE `uni1_bunker_log`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_chat`
--
ALTER TABLE `uni1_chat`
  MODIFY `messageid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_chat_rooms`
--
ALTER TABLE `uni1_chat_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_chat_rooms_messages`
--
ALTER TABLE `uni1_chat_rooms_messages`
  MODIFY `messageid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_comments`
--
ALTER TABLE `uni1_comments`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_config`
--
ALTER TABLE `uni1_config`
  MODIFY `uni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `uni1_cronjobs`
--
ALTER TABLE `uni1_cronjobs`
  MODIFY `cronjobID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `uni1_darkmatter_logs`
--
ALTER TABLE `uni1_darkmatter_logs`
  MODIFY `darkId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_diplo`
--
ALTER TABLE `uni1_diplo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_easyresourceadd`
--
ALTER TABLE `uni1_easyresourceadd`
  MODIFY `addId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_fleetdealer_log`
--
ALTER TABLE `uni1_fleetdealer_log`
  MODIFY `sellID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_fleets`
--
ALTER TABLE `uni1_fleets`
  MODIFY `fleet_id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_fleet_groups`
--
ALTER TABLE `uni1_fleet_groups`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_freecode`
--
ALTER TABLE `uni1_freecode`
  MODIFY `codeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_ip_multimod`
--
ALTER TABLE `uni1_ip_multimod`
  MODIFY `suspectId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_log`
--
ALTER TABLE `uni1_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_memory_usage`
--
ALTER TABLE `uni1_memory_usage`
  MODIFY `memoryLog` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_mercenary`
--
ALTER TABLE `uni1_mercenary`
  MODIFY `mercenaryId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_messages`
--
ALTER TABLE `uni1_messages`
  MODIFY `message_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_multi`
--
ALTER TABLE `uni1_multi`
  MODIFY `multiID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_notes`
--
ALTER TABLE `uni1_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_notifications`
--
ALTER TABLE `uni1_notifications`
  MODIFY `notifId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_paysafecards_initiated`
--
ALTER TABLE `uni1_paysafecards_initiated`
  MODIFY `logId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_planets`
--
ALTER TABLE `uni1_planets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_planet_auction`
--
ALTER TABLE `uni1_planet_auction`
  MODIFY `auctionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `uni1_planet_auction_items`
--
ALTER TABLE `uni1_planet_auction_items`
  MODIFY `itemID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_planet_auction_offers`
--
ALTER TABLE `uni1_planet_auction_offers`
  MODIFY `offerId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `uni1_planet_auction_upg`
--
ALTER TABLE `uni1_planet_auction_upg`
  MODIFY `upgradeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_premium_calc`
--
ALTER TABLE `uni1_premium_calc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `uni1_purchase_logs`
--
ALTER TABLE `uni1_purchase_logs`
  MODIFY `payID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_resource_logs`
--
ALTER TABLE `uni1_resource_logs`
  MODIFY `resourceId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_saved_galaxy`
--
ALTER TABLE `uni1_saved_galaxy`
  MODIFY `savedId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_shortcuts`
--
ALTER TABLE `uni1_shortcuts`
  MODIFY `shortcutID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_storages_logs`
--
ALTER TABLE `uni1_storages_logs`
  MODIFY `storageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_storages_logs_star`
--
ALTER TABLE `uni1_storages_logs_star`
  MODIFY `storageID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_suprimus`
--
ALTER TABLE `uni1_suprimus`
  MODIFY `surpimoId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_suprimus_logs`
--
ALTER TABLE `uni1_suprimus_logs`
  MODIFY `suprimusLog` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_ticket`
--
ALTER TABLE `uni1_ticket`
  MODIFY `ticketID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_ticket_answer`
--
ALTER TABLE `uni1_ticket_answer`
  MODIFY `answerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_ticket_category`
--
ALTER TABLE `uni1_ticket_category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `uni1_timebonus_log`
--
ALTER TABLE `uni1_timebonus_log`
  MODIFY `logID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_tourney_logs`
--
ALTER TABLE `uni1_tourney_logs`
  MODIFY `logId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_tourney_participante`
--
ALTER TABLE `uni1_tourney_participante`
  MODIFY `joinId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_tracking_mod`
--
ALTER TABLE `uni1_tracking_mod`
  MODIFY `trackId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_transport_player`
--
ALTER TABLE `uni1_transport_player`
  MODIFY `transportID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_votesystem`
--
ALTER TABLE `uni1_votesystem`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `uni1_voucher_codes`
--
ALTER TABLE `uni1_voucher_codes`
  MODIFY `voucherId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_wrecks`
--
ALTER TABLE `uni1_wrecks`
  MODIFY `wreckID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
