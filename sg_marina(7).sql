-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 24 2014 г., 18:51
-- Версия сервера: 5.5.35
-- Версия PHP: 5.4.6-1ubuntu1.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `sg_marina`
--

-- --------------------------------------------------------

--
-- Структура таблицы `fertilizer`
--

CREATE TABLE IF NOT EXISTS `fertilizer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` float(18,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `fertilizer`
--

INSERT INTO `fertilizer` (`id`, `name`, `price`) VALUES
(1, 'азотні', 0.00),
(2, 'фосфатні', 0.00);

-- --------------------------------------------------------

--
-- Структура таблицы `field`
--

CREATE TABLE IF NOT EXISTS `field` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `prev_plant_id` bigint(20) DEFAULT NULL,
  `width` bigint(20) NOT NULL,
  `length` bigint(20) NOT NULL,
  `ground_type_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `prev_plant_id_idx` (`prev_plant_id`),
  KEY `ground_type_id_idx` (`ground_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `field`
--

INSERT INTO `field` (`id`, `name`, `prev_plant_id`, `width`, `length`, `ground_type_id`) VALUES
(1, 'Леськи 1', 2, 500, 2000, 1),
(2, 'Леськи 2', 5, 700, 150, 1),
(3, 'Червона Слобода 2', 2, 520, 400, 2),
(5, 'Геронімівка', 1, 400, 720, 1),
(6, 'Червона Слобода 1', 1, 640, 520, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `ground_type`
--

CREATE TABLE IF NOT EXISTS `ground_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `ground_type`
--

INSERT INTO `ground_type` (`id`, `name`) VALUES
(2, 'Дерново-підзолистий'),
(1, 'Чорнозем');

-- --------------------------------------------------------

--
-- Структура таблицы `heaven`
--

CREATE TABLE IF NOT EXISTS `heaven` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `heaven`
--

INSERT INTO `heaven` (`id`, `name`) VALUES
(4, 'Карпати'),
(2, 'Лісостеп'),
(5, 'Південний берег Криму'),
(1, 'Полісся'),
(3, 'Степ');

-- --------------------------------------------------------

--
-- Структура таблицы `plant`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `plant`
--

INSERT INTO `plant` (`id`, `name`, `seed_price`, `price`, `fertilizer_mass`, `seeding_rate`, `growing_rate`, `fuel`, `man_hours`, `fertilizer_id`) VALUES
(1, 'Пшениця', 0, 0.40, 200, 200, 1200, 25, 15, 1),
(2, 'Соняшник', 0, 0.55, 200, 200, 1200, 25, 15, 1),
(3, 'Картопля', 0, 0.30, 200, 200, 1200, 25, 15, 1),
(4, 'Буряк', 0, 0.45, 200, 200, 1200, 25, 15, 1),
(5, 'Соя', 0, 0.45, 200, 200, 1200, 25, 15, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `plant_relation`
--

CREATE TABLE IF NOT EXISTS `plant_relation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `value` bigint(20) NOT NULL,
  `prev_plant_id` bigint(20) DEFAULT NULL,
  `next_plant_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prev_plant_id_idx` (`prev_plant_id`),
  KEY `next_plant_id_idx` (`next_plant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `plant_relation`
--

INSERT INTO `plant_relation` (`id`, `value`, `prev_plant_id`, `next_plant_id`) VALUES
(1, 3, 1, 2),
(2, 7, 2, 1),
(3, 5, 1, 3),
(4, 6, 1, 4),
(5, 1, 2, 5),
(6, 9, 5, 3),
(7, 7, 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `plant__ground`
--

CREATE TABLE IF NOT EXISTS `plant__ground` (
  `plant_id` bigint(20) NOT NULL DEFAULT '0',
  `ground_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`plant_id`,`ground_id`),
  KEY `plant__ground_ground_id_ground_type_id` (`ground_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `plant__ground`
--

INSERT INTO `plant__ground` (`plant_id`, `ground_id`) VALUES
(1, 1),
(3, 1),
(2, 2),
(3, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `plant__heaven`
--

CREATE TABLE IF NOT EXISTS `plant__heaven` (
  `plant_id` bigint(20) NOT NULL DEFAULT '0',
  `heaven_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`plant_id`,`heaven_id`),
  KEY `plant__heaven_heaven_id_heaven_id` (`heaven_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `plant__heaven`
--

INSERT INTO `plant__heaven` (`plant_id`, `heaven_id`) VALUES
(2, 1),
(1, 2),
(4, 2),
(1, 3),
(2, 3),
(3, 3),
(3, 4),
(4, 4),
(5, 4),
(1, 5),
(2, 5),
(3, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'password', '111'),
(2, 'adminemail', 'mrriddick7@gmail.com');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `field`
--
ALTER TABLE `field`
  ADD CONSTRAINT `field_ground_type_id_ground_type_id` FOREIGN KEY (`ground_type_id`) REFERENCES `ground_type` (`id`),
  ADD CONSTRAINT `field_prev_plant_id_plant_id` FOREIGN KEY (`prev_plant_id`) REFERENCES `plant` (`id`);

--
-- Ограничения внешнего ключа таблицы `plant`
--
ALTER TABLE `plant`
  ADD CONSTRAINT `plant_fertilizer_id_fertilizer_id` FOREIGN KEY (`fertilizer_id`) REFERENCES `fertilizer` (`id`);

--
-- Ограничения внешнего ключа таблицы `plant_relation`
--
ALTER TABLE `plant_relation`
  ADD CONSTRAINT `plant_relation_next_plant_id_plant_id` FOREIGN KEY (`next_plant_id`) REFERENCES `plant` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plant_relation_prev_plant_id_plant_id` FOREIGN KEY (`prev_plant_id`) REFERENCES `plant` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `plant__ground`
--
ALTER TABLE `plant__ground`
  ADD CONSTRAINT `plant__ground_ground_id_ground_type_id` FOREIGN KEY (`ground_id`) REFERENCES `ground_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plant__ground_plant_id_plant_id` FOREIGN KEY (`plant_id`) REFERENCES `plant` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `plant__heaven`
--
ALTER TABLE `plant__heaven`
  ADD CONSTRAINT `plant__heaven_heaven_id_heaven_id` FOREIGN KEY (`heaven_id`) REFERENCES `heaven` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plant__heaven_plant_id_plant_id` FOREIGN KEY (`plant_id`) REFERENCES `plant` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
