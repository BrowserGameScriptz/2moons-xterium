-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 28 nov. 2018 à 18:16
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
-- Structure de la table `emails`
--

CREATE TABLE `emails` (
  `email` varchar(500) NOT NULL,
  `username` text NOT NULL,
  `language` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
('enderson', '[{\"db\":\"enderson_database\",\"table\":\"uni1_users\"},{\"db\":\"enderson_world2\",\"table\":\"uni1_users\"},{\"db\":\"enderson_world2\",\"table\":\"uni1_banned\"}]');

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
('admin_space', '2016-02-27 18:33:06', '{\"collation_connection\":\"utf8mb4_unicode_ci\",\"lang\":\"fr\"}');

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
-- Structure de la table `uni1_changelogs`
--

CREATE TABLE `uni1_changelogs` (
  `revId` int(11) UNSIGNED NOT NULL,
  `userName` varchar(128) CHARACTER SET utf8 NOT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `text` text CHARACTER SET utf8 NOT NULL,
  `universe` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_config`
--

CREATE TABLE `uni1_config` (
  `uni` int(11) NOT NULL,
  `VERSION` varchar(8) NOT NULL,
  `sql_revision` int(11) NOT NULL DEFAULT '0',
  `users_amount` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `uni_name` varchar(30) NOT NULL,
  `game_name` varchar(30) NOT NULL,
  `game_disable` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `close_reason` text NOT NULL,
  `forum_url` varchar(128) NOT NULL DEFAULT 'http://2moons.cc',
  `adm_attack` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `debug` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `lang` varchar(2) NOT NULL DEFAULT '',
  `reg_closed` tinyint(1) NOT NULL DEFAULT '0',
  `OverviewNewsFrame` tinyint(1) NOT NULL DEFAULT '1',
  `OverviewNewsText` text NOT NULL,
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
  `moduls` varchar(100) NOT NULL DEFAULT '',
  `ttf_file` varchar(128) NOT NULL DEFAULT 'styles/resource/fonts/DroidSansMono.ttf',
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
  `darkmatter_reduc` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `cronInstant` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `cronInstantStep` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `cronBot` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `usersOnline` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `usersOnline2` int(11) UNSIGNED NOT NULL DEFAULT '0',
<<<<<<< HEAD
  `domain_name` text NOT NULL,
=======
  `domain_name` varchar(255) NOT NULL DEFAULT ''
>>>>>>> 6e673989124fd327980808a5bf6e8755fd310967
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uni1_config`
--

<<<<<<< HEAD
INSERT INTO `uni1_config` (`uni`, `VERSION`, `sql_revision`, `users_amount`, `uni_name`, `game_name`, `game_disable`, `close_reason`, `forum_url`, `adm_attack`, `debug`, `lang`, `reg_closed`, `OverviewNewsFrame`, `OverviewNewsText`, `mail_active`, `mail_use`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `smtp_ssl`, `smtp_sendmail`, `smail_path`, `user_valid`, `moduls`, `ttf_file`, `del_oldstuff`, `del_user_manually`, `del_user_automatic`, `del_user_sendmail`, `sendmail_inactive`, `silo_factor`, `timezone`, `dst`, `energySpeed`, `disclamerAddress`, `disclamerPhone`, `disclamerMail`, `disclamerNotice`, `darkmatter_reduc`, `cronInstant`, `cronInstantStep`, `cronBot`, `usersOnline`, `usersOnline2`, `domain_name`) VALUES
(1, '1.7.git', 0, 2887, '#WOG', 'War Of Galaxyz', 1, '', 'https://forum.warofgalaxyz.com', 1, 0, 'en', 0, 1, 'We are activly looking for membres being able to translate corectly some parts of the game in their language (deutsche, spanish, turkish, polish, portugues (currently closed))\r\n<font color=\"green\">We are looking for beta testers speaking english and one of the other ingame languages, contact me via skype @ xterium.support </font>', 1, 0, 'mail.warofgalaxyz.com', 465, 'info@warofgalaxyz.com', 'aOqj$29HG3ipangk', '', 'info@warofgalaxyz.com', '/usr/sbin/sendmail', 0, '1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1', 'styles/resource/fonts/DroidSansMono.ttf', 3, 7, 30, 21, 1, 1, 'Europe/Brussels', '0', 1, '', '', '', '', 0, 1466465402, 1, 1466544301, 11, 12, 'my_domain_url.com');
=======
INSERT INTO `uni1_config` (`uni`, `VERSION`, `sql_revision`, `users_amount`, `uni_name`, `game_name`, `game_disable`, `close_reason`, `forum_url`, `adm_attack`, `debug`, `lang`, `reg_closed`, `OverviewNewsFrame`, `OverviewNewsText`, `mail_active`, `mail_use`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `smtp_ssl`, `smtp_sendmail`, `smail_path`, `user_valid`, `moduls`, `ttf_file`, `del_oldstuff`, `del_user_manually`, `del_user_automatic`, `del_user_sendmail`, `sendmail_inactive`, `silo_factor`, `timezone`, `dst`, `energySpeed`, `disclamerAddress`, `disclamerPhone`, `disclamerMail`, `disclamerNotice`, `darkmatter_reduc`, `cronInstant`, `cronInstantStep`, `cronBot`, `usersOnline`, `usersOnline2`) VALUES
(1, '1.7.git', 0, 2887, '#WOG', 'War Of Galaxyz', 1, '', 'https://forum.warofgalaxyz.com', 1, 0, 'en', 0, 1, 'We are activly looking for membres being able to translate corectly some parts of the game in their language (deutsche, spanish, turkish, polish, portugues (currently closed))\r\n<font color=\"green\">We are looking for beta testers speaking english and one of the other ingame languages, contact me via skype @ xterium.support </font>', 1, 0, 'mail.warofgalaxyz.com', 465, 'info@warofgalaxyz.com', 'aOqj$29HG3ipangk', '', 'info@warofgalaxyz.com', '/usr/sbin/sendmail', 0, '1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1;1', 'styles/resource/fonts/DroidSansMono.ttf', 3, 7, 30, 21, 1, 1, 'Europe/Brussels', '0', 1, '', '', '', '', 0, 1466465402, 1, 1466544301, 11, 12, 'my_game_url.com');
>>>>>>> 6e673989124fd327980808a5bf6e8755fd310967

-- --------------------------------------------------------

--
-- Structure de la table `uni1_fakeemails`
--

CREATE TABLE `uni1_fakeemails` (
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `resolution` varchar(40) NOT NULL DEFAULT '',
  `opsystem` varchar(500) CHARACTER SET utf16 NOT NULL DEFAULT '',
  `isp` varchar(500) DEFAULT NULL,
  `proxies` varchar(500) DEFAULT NULL,
  `cookies` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_lostpassword`
--

CREATE TABLE `uni1_lostpassword` (
  `userID` int(10) UNSIGNED NOT NULL,
  `key` varchar(32) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL,
  `hasChanged` tinyint(1) NOT NULL DEFAULT '0',
  `fromIP` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_media_post`
--

CREATE TABLE `uni1_media_post` (
  `mediaId` int(11) UNSIGNED NOT NULL,
  `mediaTitle` varchar(255) DEFAULT NULL,
  `mediaLocation` varchar(255) DEFAULT NULL,
  `mediaDescription` varchar(255) DEFAULT NULL,
  `mediaLocation2` varchar(255) DEFAULT NULL,
  `imageBlock` varchar(255) DEFAULT NULL,
  `mediaType` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uni1_news`
--

CREATE TABLE `uni1_news` (
  `id` int(11) UNSIGNED NOT NULL,
  `user` varchar(64) NOT NULL,
  `date` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `top_news` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Structure de la table `uni1_users`
--

CREATE TABLE `uni1_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `email_2` varchar(64) NOT NULL DEFAULT '',
  `lang` varchar(2) NOT NULL DEFAULT 'de',
  `authattack` tinyint(1) NOT NULL DEFAULT '0',
  `authlevel` tinyint(1) NOT NULL DEFAULT '0',
  `chat_oper` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `gm` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `id_planet` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `universe` tinyint(3) UNSIGNED NOT NULL,
  `galaxy` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `system` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `planet` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `encodage` varchar(32) NOT NULL DEFAULT '',
  `onlinetime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `user_lastip` varchar(40) NOT NULL DEFAULT '',
  `ip_at_reg` varchar(40) NOT NULL DEFAULT '',
  `register_time` int(11) NOT NULL DEFAULT '0',
  `dpath` varchar(20) NOT NULL DEFAULT 'gow',
  `timezone` varchar(32) NOT NULL DEFAULT 'Europe/London',
  `uctime` int(11) NOT NULL DEFAULT '0',
  `ref_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ref_bonus` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `setmail` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `isActivared` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `isMailSend` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `validationKey` varchar(32) DEFAULT NULL,
  `mailListed` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fbToken` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `deviceId` varchar(500) DEFAULT NULL,
  `accessBeta` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `isMailVerified` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `validationMailAdress` varchar(55) DEFAULT NULL,
  `isVerifySend` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `facebookToken` varchar(1000) DEFAULT NULL,
  `facebookId` double(50,0) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `externalAuthMethod` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `emails`
--
ALTER TABLE `emails`
  ADD UNIQUE KEY `email` (`email`);

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
-- Index pour la table `uni1_config`
--
ALTER TABLE `uni1_config`
  ADD PRIMARY KEY (`uni`);

--
-- Index pour la table `uni1_fakeemails`
--
ALTER TABLE `uni1_fakeemails`
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `uni1_ip_multimod`
--
ALTER TABLE `uni1_ip_multimod`
  ADD UNIQUE KEY `suspectId` (`suspectId`);

--
-- Index pour la table `uni1_session`
--
ALTER TABLE `uni1_session`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD KEY `sessionID` (`sessionID`);

--
-- Index pour la table `uni1_users`
--
ALTER TABLE `uni1_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authlevel` (`authlevel`),
  ADD KEY `universe` (`universe`,`username`,`password`,`authlevel`);

--
-- Index pour la table `uni1_users_valid`
--
ALTER TABLE `uni1_users_valid`
  ADD PRIMARY KEY (`validationID`,`validationKey`);

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
-- AUTO_INCREMENT pour la table `uni1_config`
--
ALTER TABLE `uni1_config`
  MODIFY `uni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `uni1_ip_multimod`
--
ALTER TABLE `uni1_ip_multimod`
  MODIFY `suspectId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_users`
--
ALTER TABLE `uni1_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `uni1_users_valid`
--
ALTER TABLE `uni1_users_valid`
  MODIFY `validationID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
