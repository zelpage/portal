ALTER TABLE `users` 
CHANGE `pass` `pass` VARCHAR(255) COLLATE 'utf8_czech_ci' NULL AFTER `login`,
ADD COLUMN `is_migrated_from_md5` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Password hash migrated from MD5 to BCrypt' AFTER `pass`
;