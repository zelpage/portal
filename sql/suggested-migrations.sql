ALTER TABLE `kalendar_typy`
CHANGE COLUMN `typ` `typ` ENUM('trakce', 'zelakce', 'modvys', 'konf', 'veletrh', 'kongres', 'status', 'jizdne', 'zobraz', 'modsubj') NOT NULL COLLATE utf8_czech_ci
;