-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 27 2014 г., 21:57
-- Версия сервера: 5.5.35
-- Версия PHP: 5.4.6-1ubuntu1.5

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
-- Структура таблицы `field`
--

CREATE TABLE IF NOT EXISTS `field` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `prev_plant_id` bigint(20) DEFAULT NULL,
  `width` bigint(20) DEFAULT NULL,
  `length` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `prev_plant_id_idx` (`prev_plant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `field`
--

INSERT INTO `field` (`id`, `name`, `prev_plant_id`, `width`, `length`) VALUES
(4, 'Поле 1', 6, 0, 0),
(5, 'Поле 2', 10, 0, 0),
(6, 'Поле 3', 7, 0, 0);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `field`
--
ALTER TABLE `field`
  ADD CONSTRAINT `field_prev_plant_id_plant_id` FOREIGN KEY (`prev_plant_id`) REFERENCES `plant` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
