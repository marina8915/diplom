-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 01 2014 г., 20:07
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `fertilizer`
--

INSERT INTO `fertilizer` (`id`, `name`, `price`) VALUES
(1, 'Сульфат амонію', 1.35),
(2, 'Органічне добрива', 5.80),
(3, 'Вапняково-аміачна селітра', 1.58),
(4, 'Аміачна селітра', 2.17),
(5, 'Карбамід', 2.25);

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
  `heaven_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `prev_plant_id_idx` (`prev_plant_id`),
  KEY `ground_type_id_idx` (`ground_type_id`),
  KEY `heaven_id_idx` (`heaven_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `field`
--

INSERT INTO `field` (`id`, `name`, `prev_plant_id`, `width`, `length`, `ground_type_id`, `heaven_id`) VALUES
(1, 'Леськи 1', 6, 500, 700, 1, 2),
(2, 'Леськи 2', 5, 700, 150, 1, 2),
(3, 'Червона Слобода 2', 7, 520, 400, 2, 2),
(5, 'Геронімівка', 4, 400, 720, 1, 2),
(6, 'Червона Слобода 1', 1, 640, 520, 2, 2),
(7, 'Поле 5', 3, 700, 500, 1, 5),
(8, 'Геронімівка 2', 9, 500, 600, 2, 1),
(9, 'Леськи 3', 16, 600, 400, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `ground_type`
--

CREATE TABLE IF NOT EXISTS `ground_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `plant`
--

INSERT INTO `plant` (`id`, `name`, `seed_price`, `price`, `fertilizer_mass`, `seeding_rate`, `growing_rate`, `fuel`, `man_hours`, `fertilizer_id`) VALUES
(1, 'Озима пшениця', 15, 3.40, 2000, 250, 6630, 58, 30, 2),
(2, 'Соняшник', 38, 4.28, 100, 5, 1710, 55, 37, 4),
(3, 'Картопля', 13, 2.10, 485, 2400, 18100, 51, 22, 3),
(4, 'Цукровий буряк', 38, 0.53, 2300, 6, 38100, 57, 28, 2),
(5, 'Соя', 7, 3.09, 450, 150, 1730, 61, 23, 3),
(6, 'Горох', 6, 4.25, 225, 230, 1760, 51, 28, 4),
(7, 'Гречка', 8, 3.50, 480, 95, 1010, 65, 19, 3),
(8, 'Конюшина', 23, 1.30, 387, 15, 3500, 54, 17, 1),
(9, 'Кукурудза', 18, 1.88, 550, 18, 4400, 58, 29, 3),
(10, 'Льон-довгунець', 15, 4.96, 220, 150, 800, 54, 22, 5),
(11, 'Люцерна', 45, 1.20, 280, 12, 5400, 52, 21, 1),
(12, 'Овес', 4, 1.65, 480, 185, 2240, 62, 25, 3),
(13, 'Озиме жито', 5, 3.50, 165, 180, 2390, 50, 26, 4),
(14, 'Озимий ріпак', 28, 4.20, 580, 3, 1760, 66, 34, 3),
(15, 'Озимий ячмінь', 3, 3.00, 300, 195, 2050, 58, 27, 4),
(16, 'Просо', 4, 2.21, 455, 22, 1700, 57, 28, 1),
(17, 'Рис', 25, 3.80, 2100, 250, 6750, 66, 38, 2),
(18, 'Яра пшениця', 7, 3.00, 170, 195, 2880, 62, 19, 4),
(19, 'Ярий ріпак', 15, 3.30, 150, 5, 1580, 64, 24, 4),
(20, 'Ярий ячмінь', 6, 3.70, 200, 190, 2240, 58, 25, 5),
(21, 'Чистий пар', 0, 0.00, 200, 0, 0, 20, 20, 2);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=201 ;

--
-- Дамп данных таблицы `plant_relation`
--

INSERT INTO `plant_relation` (`id`, `value`, `prev_plant_id`, `next_plant_id`) VALUES
(55, 6, 14, 1),
(57, 4, 9, 1),
(54, 8, 5, 1),
(53, 8, 6, 1),
(52, 10, 11, 1),
(58, 4, 4, 1),
(56, 4, 3, 1),
(51, 10, 8, 1),
(50, 1, 19, 2),
(49, 1, 14, 2),
(48, 1, 6, 2),
(47, 1, 5, 2),
(46, 1, 11, 2),
(45, 1, 4, 2),
(44, 6, 20, 2),
(43, 6, 18, 2),
(42, 10, 15, 2),
(41, 8, 13, 2),
(40, 10, 1, 2),
(39, 6, 9, 2),
(38, 8, 3, 2),
(37, 10, 2, 21),
(36, 1, 2, 18),
(35, 1, 2, 16),
(60, 3, 12, 1),
(34, 1, 2, 15),
(33, 1, 2, 13),
(32, 1, 2, 1),
(31, 1, 2, 2),
(59, 4, 7, 1),
(61, 6, 21, 1),
(62, 8, 10, 1),
(63, 9, 5, 3),
(64, 9, 6, 3),
(65, 9, 1, 3),
(66, 10, 13, 3),
(67, 9, 15, 3),
(68, 7, 8, 3),
(69, 7, 11, 3),
(70, 6, 9, 3),
(71, 9, 10, 3),
(77, 10, 1, 4),
(73, 10, 3, 13),
(74, 9, 3, 15),
(75, 8, 3, 18),
(76, 9, 3, 20),
(78, 1, 4, 4),
(79, 8, 4, 18),
(80, 8, 4, 20),
(81, 9, 4, 5),
(82, 9, 4, 6),
(83, 9, 1, 5),
(84, 9, 13, 5),
(85, 8, 15, 5),
(86, 10, 18, 5),
(87, 10, 20, 5),
(88, 6, 3, 5),
(89, 6, 9, 5),
(90, 6, 4, 5),
(91, 1, 2, 5),
(92, 1, 6, 5),
(93, 7, 1, 6),
(94, 9, 13, 6),
(95, 8, 13, 6),
(96, 8, 15, 6),
(97, 8, 18, 6),
(98, 8, 20, 6),
(99, 6, 4, 6),
(100, 6, 3, 6),
(101, 6, 9, 6),
(102, 6, 10, 6),
(103, 1, 6, 6),
(104, 8, 1, 7),
(105, 9, 13, 7),
(106, 9, 15, 7),
(107, 9, 5, 7),
(108, 10, 6, 7),
(109, 8, 4, 7),
(110, 8, 3, 7),
(111, 8, 9, 7),
(112, 9, 10, 7),
(113, 8, 1, 9),
(114, 8, 5, 9),
(115, 9, 6, 9),
(116, 9, 7, 9),
(117, 10, 3, 9),
(118, 8, 10, 9),
(119, 6, 9, 9),
(120, 4, 4, 9),
(121, 4, 2, 9),
(122, 8, 18, 10),
(123, 8, 20, 10),
(124, 6, 3, 10),
(125, 6, 9, 10),
(126, 6, 4, 10),
(127, 6, 5, 10),
(128, 6, 6, 10),
(129, 1, 10, 10),
(130, 8, 1, 12),
(131, 9, 13, 12),
(132, 10, 15, 12),
(133, 7, 9, 12),
(134, 7, 3, 12),
(135, 9, 6, 12),
(136, 9, 10, 12),
(137, 1, 4, 12),
(138, 10, 3, 13),
(139, 9, 10, 13),
(140, 6, 9, 13),
(141, 7, 1, 13),
(142, 5, 13, 13),
(143, 8, 15, 13),
(144, 6, 6, 13),
(145, 10, 3, 14),
(146, 9, 6, 14),
(147, 6, 1, 14),
(148, 6, 13, 14),
(149, 6, 15, 14),
(150, 1, 18, 14),
(151, 7, 20, 14),
(152, 1, 12, 15),
(153, 1, 4, 14),
(154, 10, 5, 15),
(155, 9, 6, 15),
(156, 9, 3, 15),
(157, 6, 9, 15),
(158, 5, 1, 15),
(159, 5, 18, 15),
(160, 4, 12, 15),
(161, 1, 13, 15),
(162, 9, 1, 16),
(163, 10, 13, 16),
(164, 1, 15, 16),
(165, 8, 5, 16),
(166, 10, 6, 16),
(167, 8, 3, 16),
(168, 8, 4, 16),
(169, 1, 2, 16),
(170, 1, 9, 16),
(171, 10, 11, 17),
(172, 10, 8, 17),
(173, 8, 4, 17),
(174, 8, 5, 17),
(175, 8, 6, 17),
(176, 7, 14, 17),
(177, 7, 19, 17),
(178, 8, 5, 18),
(179, 10, 6, 18),
(180, 8, 9, 18),
(181, 6, 14, 18),
(182, 6, 19, 18),
(183, 5, 10, 18),
(184, 4, 7, 18),
(185, 4, 12, 18),
(186, 9, 5, 19),
(187, 9, 6, 19),
(188, 10, 3, 19),
(189, 8, 9, 19),
(190, 1, 19, 19),
(191, 10, 9, 20),
(192, 8, 12, 20),
(193, 1, 1, 20),
(194, 7, 18, 20),
(195, 8, 5, 20),
(196, 6, 6, 20),
(197, 9, 4, 20),
(198, 5, 3, 20),
(199, 1, 13, 20),
(200, 1, 15, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `plant__ground`
--

CREATE TABLE IF NOT EXISTS `plant__ground` (
  `plant_id` bigint(20) NOT NULL DEFAULT '0',
  `ground_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`plant_id`,`ground_id`),
  KEY `plant__ground_ground_id_ground_type_id` (`ground_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `plant__ground`
--

INSERT INTO `plant__ground` (`plant_id`, `ground_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 1),
(3, 2),
(6, 1),
(7, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `plant__heaven`
--

CREATE TABLE IF NOT EXISTS `plant__heaven` (
  `plant_id` bigint(20) NOT NULL DEFAULT '0',
  `heaven_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`plant_id`,`heaven_id`),
  KEY `plant__heaven_heaven_id_heaven_id` (`heaven_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `plant__heaven`
--

INSERT INTO `plant__heaven` (`plant_id`, `heaven_id`) VALUES
(1, 2),
(1, 3),
(1, 5),
(2, 1),
(2, 3),
(2, 5),
(3, 3),
(3, 4),
(3, 5),
(4, 2),
(4, 4),
(5, 4),
(6, 1),
(6, 2),
(6, 4),
(6, 5),
(7, 2),
(7, 4),
(7, 5),
(8, 2),
(8, 4),
(8, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'password', '111'),
(2, 'adminemail', 'mrriddick7@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
