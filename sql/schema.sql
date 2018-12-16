CREATE TABLE `groups` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COLLATE utf8_czech_ci COMMENT 'Group name',
  `comment` text NOT NULL COLLATE utf8_czech_ci COMMENT 'Group description',
  `id_forum` mediumint(8) unsigned NULL DEFAULT 0 COMMENT 'id na diskusním fóru ŽelPage',
  `slack` varchar(255) NULL DEFAULT NULL COLLATE utf8_czech_ci COMMENT 'Slack webhook',
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='uživatelské skupiny';

CREATE TABLE `group_layers` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_group` int(2) NOT NULL DEFAULT 0,
  `nadpis` varchar(100) NOT NULL COLLATE utf8_czech_ci,
  `uroven` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_group` (`id_group`,`uroven`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

CREATE TABLE `kalendar_spolky` (
	`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
	`jmeno` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'název',
	`brand` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
	`adresa` text COLLATE utf8_czech_ci,
	`description` varchar(250) COLLATE utf8_czech_ci DEFAULT NULL,
	`postOfficeBoxNumber` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
	`streetAddress` varchar(250) COLLATE utf8_czech_ci DEFAULT NULL,
	`postalCode` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
	`addressLocality` varchar(250) COLLATE utf8_czech_ci DEFAULT NULL,
	`addressCountry` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
	`telefon` varchar(44) COLLATE utf8_czech_ci DEFAULT NULL,
	`fax` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
	`email` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
	`www` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
	`FB` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL COMMENT 'odkaz na stránku nebo skupinu',
	`dopravce` varchar(6) COLLATE utf8_czech_ci DEFAULT NULL,
	`taxId` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
	`foundingDate` date DEFAULT NULL COMMENT 'den založení',
	`dissolutionDate` date DEFAULT NULL COMMENT 'den zrušení',
	`typ` smallint(5) NOT NULL DEFAULT '0',
	`seo_url` varchar(250) COLLATE utf8_czech_ci DEFAULT NULL,
	`active` tinyint(1) NOT NULL DEFAULT '1',
	`modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	KEY `seo_url` (`seo_url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

CREATE TABLE `kalendar_typy` (
	`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
	`typ` enum('trakce','zelakce','modvys','konf','veletrh','kongres','status','jizdne','zobraz','modsubj') COLLATE utf8_czech_ci DEFAULT NULL,
	`typ_id` smallint(5) unsigned NOT NULL,
	`obrazek` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
	`obr_w` smallint(5) unsigned DEFAULT NULL,
	`obr_h` smallint(5) unsigned DEFAULT NULL,
	`p_lang` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
	`p_short` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
	`p_long` text COLLATE utf8_czech_ci,
	PRIMARY KEY (`id`),
	KEY `typ` (`typ`,`typ_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='kategorie pro kalendář nostalgie';

CREATE TABLE `kalendar_vozidla` (
	`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
	`jmeno` varchar(40) COLLATE utf8_czech_ci DEFAULT NULL,
	`typ` smallint(5) DEFAULT NULL,
	`seo_url` varchar(40) COLLATE utf8_czech_ci DEFAULT NULL,
	`link_atlas` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
	`link_galerie` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
	`active` tinyint(1) DEFAULT '1',
	`modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	`uiccode` varchar(9) COLLATE utf8_czech_ci DEFAULT NULL,
	`zeme` tinyint(2) DEFAULT '54',
	`cat` enum('r','v','u','w','s') COLLATE utf8_czech_ci DEFAULT 'v',
	PRIMARY KEY (`id`),
	KEY `seo_url` (`seo_url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

CREATE TABLE `reg_zeme` (
	`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
	`jmeno` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
	`seo_url` varchar(250) COLLATE utf8_czech_ci DEFAULT NULL,
	`zkratka` varchar(3) COLLATE utf8_czech_ci DEFAULT NULL,
	`uiccode` smallint(5) unsigned DEFAULT NULL,
	`en_name` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
	`de_name` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
	`fr_name` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
	`orig_name` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
	`part` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
	PRIMARY KEY (`id`),
	KEY `regz_seo_url` (`seo_url`),
	KEY `uiccode` (`uiccode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Seznam zemí pro odkazy a akce';

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(25) COLLATE utf8_czech_ci DEFAULT NULL,
  `pass` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
  `is_migrated_from_md5` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Password hash migrated from MD5 to BCrypt',
  `jmeno` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `zkratka` varchar(5) COLLATE utf8_czech_ci DEFAULT NULL,
  `nick` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `mobil` varchar(13) COLLATE utf8_czech_ci DEFAULT NULL,
  `web` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `icq` int(11) DEFAULT NULL,
  `oautorovi` text COLLATE utf8_czech_ci,
  `zobraz` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `prava` enum('1','2','3','4','5') COLLATE utf8_czech_ci DEFAULT NULL,
  `stav` enum('a','n','y_n') COLLATE utf8_czech_ci DEFAULT NULL,
  `last` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `notifikace` enum('y','n') COLLATE utf8_czech_ci DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `aol` varchar(15) COLLATE utf8_czech_ci DEFAULT NULL,
  `msn` varchar(15) COLLATE utf8_czech_ci DEFAULT NULL,
  `ym` varchar(15) COLLATE utf8_czech_ci DEFAULT NULL,
  `show_email` enum('y','n') COLLATE utf8_czech_ci DEFAULT NULL,
  `show_mobil` enum('y','n') COLLATE utf8_czech_ci DEFAULT NULL,
  `pocet_fotek` int(4) NOT NULL DEFAULT '0',
  `pocet_koment` int(5) NOT NULL DEFAULT '0',
  `rocnik` int(4) NOT NULL DEFAULT '0',
  `body` int(6) NOT NULL DEFAULT '0',
  `vip` int(2) NOT NULL DEFAULT '0',
  `id_forum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `show_name` enum('y','n') COLLATE utf8_czech_ci DEFAULT NULL,
  `datum_reg` datetime DEFAULT NULL,
  `flags` smallint(5) unsigned DEFAULT '0',
  `twitter_user` varchar(150) COLLATE utf8_czech_ci DEFAULT NULL,
  `twitter_notify_mail` varchar(150) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zobraz` (`zobraz`),
  KEY `login` (`login`,`pass`),
  KEY `email` (`email`),
  KEY `stav` (`stav`,`zobraz`),
  KEY `pocet_fotek` (`pocet_fotek`,`zobraz`),
  KEY `id` (`id`,`zobraz`,`email`,`show_email`),
  KEY `id_forum_stav_email` (`id_forum`,`stav`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Registrovaní uživatelé';

