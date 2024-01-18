
DROP TABLE IF EXISTS `games`;

CREATE TABLE `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


LOCK TABLES `games` WRITE;

UNLOCK TABLES;


DROP TABLE IF EXISTS `moves`;

CREATE TABLE `moves` (
  `id` int NOT NULL AUTO_INCREMENT,
  `game_id` int NOT NULL,
  `type` char(4) NOT NULL,
  `move_from` varchar(11) DEFAULT NULL,
  `move_to` varchar(11) DEFAULT NULL,
  `previous_id` int DEFAULT NULL,
  `state` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


LOCK TABLES `moves` WRITE;

UNLOCK TABLES;
