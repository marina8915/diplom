SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `fertilizer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `fertilizer` (`id`, `name`) VALUES
(3, 'азотні'),
(4, 'фосфатні');

CREATE TABLE IF NOT EXISTS `field` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `prev_plant_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `prev_plant_id_idx` (`prev_plant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

INSERT INTO `field` (`id`, `name`, `prev_plant_id`) VALUES
(4, 'Поле 1', 6),
(5, 'Поле 2', 10),
(6, 'Поле 3', 7);

CREATE TABLE IF NOT EXISTS `ground_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `ground_type` (`id`, `name`) VALUES
(4, 'Дерново-підзолистий'),
(3, 'Чорнозем');

CREATE TABLE IF NOT EXISTS `plant` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `seed_price` bigint(20) NOT NULL,
  `price` float(18,2) NOT NULL,
  `fertilizer_mass` bigint(20) NOT NULL,
  `seeding_rate` bigint(20) NOT NULL,
  `growing_rate` bigint(20) NOT NULL,
  `fuel` bigint(20) NOT NULL,
  `man_hours` bigint(20) NOT NULL,
  `fertilizer_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `fertilizer_id_idx` (`fertilizer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

INSERT INTO `plant` (`id`, `name`, `seed_price`, `price`, `fertilizer_mass`, `seeding_rate`, `growing_rate`, `fuel`, `man_hours`, `fertilizer_id`) VALUES
(6, 'Пшениця', 0, 0.40, 200, 200, 1200, 25, 15, 3),
(7, 'Соняшник', 0, 0.55, 200, 200, 1200, 25, 15, 3),
(8, 'Картопля', 0, 0.30, 200, 200, 1200, 25, 15, 3),
(9, 'Буряк', 0, 0.45, 200, 200, 1200, 25, 15, 3),
(10, 'Соя', 0, 0.45, 200, 200, 1200, 25, 15, 3);

CREATE TABLE IF NOT EXISTS `plant_relation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `value` bigint(20) NOT NULL,
  `prev_plant_id` bigint(20) DEFAULT NULL,
  `next_plant_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prev_plant_id_idx` (`prev_plant_id`),
  KEY `next_plant_id_idx` (`next_plant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

INSERT INTO `plant_relation` (`id`, `value`, `prev_plant_id`, `next_plant_id`) VALUES
(8, 3, 6, 7),
(9, 7, 7, 6),
(10, 5, 6, 8),
(11, 6, 6, 9),
(12, 1, 7, 10),
(13, 9, 10, 8),
(14, 7, 10, 6);

CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(3, 'password', '111'),
(4, 'adminemail', 'mrriddick7@gmail.com');


ALTER TABLE `field`
  ADD CONSTRAINT `field_prev_plant_id_plant_id` FOREIGN KEY (`prev_plant_id`) REFERENCES `plant` (`id`);

ALTER TABLE `plant`
  ADD CONSTRAINT `plant_fertilizer_id_fertilizer_id` FOREIGN KEY (`fertilizer_id`) REFERENCES `fertilizer` (`id`);

ALTER TABLE `plant_relation`
  ADD CONSTRAINT `plant_relation_next_plant_id_plant_id` FOREIGN KEY (`next_plant_id`) REFERENCES `plant` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plant_relation_prev_plant_id_plant_id` FOREIGN KEY (`prev_plant_id`) REFERENCES `plant` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;