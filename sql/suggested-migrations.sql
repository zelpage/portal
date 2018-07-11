ALTER TABLE `kalendar_typy`
CHANGE COLUMN `typ` `typ` ENUM('trakce', 'zelakce', 'modvys', 'konf', 'veletrh', 'kongres', 'status', 'jizdne', 'zobraz', 'modsubj') NOT NULL COLLATE utf8_czech_ci AFTER `id`
;

ALTER TABLE `reg_zeme`
CHANGE COLUMN `jmeno` `jmeno` VARCHAR (50) NOT NULL COLLATE utf8_czech_ci AFTER `id`,
;
