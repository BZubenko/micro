-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 25 2015 г., 02:33
-- Версия сервера: 5.6.21
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `site`
--
CREATE DATABASE IF NOT EXISTS `site` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `site`;

-- --------------------------------------------------------

--
-- Структура таблицы `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
`album_id` int(10) NOT NULL,
  `album_name` varchar(20) DEFAULT NULL,
  `album_type` int(1) DEFAULT NULL,
  `album_cover` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
`comment_id` int(15) NOT NULL,
  `comments_to` int(20) DEFAULT NULL,
  `to_type` int(1) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `comment_date` varchar(10) DEFAULT NULL,
  `comment_time` varchar(5) DEFAULT NULL,
  `comment_text` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `media_objects`
--

DROP TABLE IF EXISTS `media_objects`;
CREATE TABLE IF NOT EXISTS `media_objects` (
`object_id` int(20) NOT NULL,
  `object_type` int(1) DEFAULT NULL,
  `object_name` varchar(10) DEFAULT NULL,
  `object_descr` text,
  `album_id` int(15) DEFAULT NULL,
  `object_cover` int(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `poster`
--

DROP TABLE IF EXISTS `poster`;
CREATE TABLE IF NOT EXISTS `poster` (
`poster_id` int(20) NOT NULL,
  `poster_name` varchar(20) DEFAULT NULL,
  `poster_descr` text,
  `poster_date` varchar(10) DEFAULT NULL,
  `poster_time` varchar(5) DEFAULT NULL,
  `poster_photo` int(10) DEFAULT NULL,
  `poster_video` int(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
`review_id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `review_date` varchar(10) DEFAULT NULL,
  `review_time` varchar(5) DEFAULT NULL,
  `review_text` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(10) NOT NULL,
  `user_name` varchar(15) DEFAULT NULL,
  `user_login` varchar(20) DEFAULT NULL,
  `user_pass` varchar(25) DEFAULT NULL,
  `user_email` varchar(25) DEFAULT NULL,
  `user_phone` int(15) DEFAULT NULL,
  `user_role` varchar(10) DEFAULT NULL,
  `user_addr` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_login`, `user_pass`, `user_email`, `user_phone`, `user_role`, `user_addr`) VALUES
(1, 'admin', 'root', 'root', '', 0, 'admin', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `albums`
--
ALTER TABLE `albums`
 ADD PRIMARY KEY (`album_id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`comment_id`);

--
-- Индексы таблицы `media_objects`
--
ALTER TABLE `media_objects`
 ADD PRIMARY KEY (`object_id`);

--
-- Индексы таблицы `poster`
--
ALTER TABLE `poster`
 ADD PRIMARY KEY (`poster_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
 ADD PRIMARY KEY (`review_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `albums`
--
ALTER TABLE `albums`
MODIFY `album_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
MODIFY `comment_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `media_objects`
--
ALTER TABLE `media_objects`
MODIFY `object_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `poster`
--
ALTER TABLE `poster`
MODIFY `poster_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
