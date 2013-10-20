-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 20 2013 г., 10:30
-- Версия сервера: 5.5.33-log
-- Версия PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `progschool`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id_article`, `id_user`, `title`, `content`) VALUES
(1, 1, 'Статья 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, eaque, quia pariatur nobis rem laudantium nemo optio autem dolores vel mollitia perspiciatis ad iure repudiandae a voluptas voluptatibus in eos.'),
(2, 2, 'Статья 4', 'Контент 4'),
(4, 2, 'Статья 51', 'Контент 51'),
(5, 0, 'fsdfs112', 'fsfsfs'),
(8, 0, '3437777', '434311'),
(9, 0, 'Просто новая статья', 'Ни о чём'),
(10, 0, 'выа111', 'sdfsd');

-- --------------------------------------------------------

--
-- Структура таблицы `articles_notes`
--

CREATE TABLE IF NOT EXISTS `articles_notes` (
  `id_article` int(11) NOT NULL,
  `id_note` int(11) NOT NULL,
  UNIQUE KEY `id_article` (`id_article`,`id_note`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `id_article` int(11) NOT NULL,
  PRIMARY KEY (`id_comment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id_comment`, `name`, `comment`, `id_article`) VALUES
(1, 'max', 'Что-то прокомментировал', 4),
(2, 'max2', 'Круто!', 4),
(3, 'new max', 'Коммент №1', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id_note` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_note`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `notes`
--

INSERT INTO `notes` (`id_note`, `name`) VALUES
(1, 'Футбол'),
(2, 'Политика');

-- --------------------------------------------------------

--
-- Структура таблицы `privs`
--

CREATE TABLE IF NOT EXISTS `privs` (
  `id_priv` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id_priv`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `privs`
--

INSERT INTO `privs` (`id_priv`, `name`, `description`) VALUES
(1, 'USE_SECRET_FUNCTIONS', 'Привилегия для примера');

-- --------------------------------------------------------

--
-- Структура таблицы `privs2roles`
--

CREATE TABLE IF NOT EXISTS `privs2roles` (
  `id_priv` int(5) NOT NULL,
  `id_role` int(5) NOT NULL,
  PRIMARY KEY (`id_priv`,`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `privs2roles`
--

INSERT INTO `privs2roles` (`id_priv`, `id_role`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id_role`, `name`, `description`) VALUES
(1, 'test', 'Роль для примера');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_last` datetime NOT NULL,
  PRIMARY KEY (`id_session`),
  UNIQUE KEY `sid` (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id_session`, `id_user`, `sid`, `time_start`, `time_last`) VALUES
(1, 1, 'lXp1youoYW', '2013-06-14 21:04:03', '2013-06-14 21:33:31'),
(2, 1, 'eBGxC65ERr', '2013-06-14 21:34:42', '2013-06-14 21:40:02'),
(3, 1, 'J7u2B9rWw9', '2013-07-23 18:40:43', '2013-07-23 18:40:43'),
(4, 1, '23Jm0J7Kuk', '2013-07-23 18:54:56', '2013-07-23 18:54:56'),
(5, 1, 'lCGDLPIxQn', '2013-08-20 21:26:39', '2013-08-20 21:38:05'),
(6, 1, 'igXjZ8ET7j', '2013-08-20 21:44:58', '2013-08-20 21:44:58');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `login` varchar(256) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_role` int(5) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `login_9` (`login`),
  KEY `login_2` (`login`),
  KEY `login_3` (`login`),
  KEY `login_4` (`login`),
  KEY `login_5` (`login`),
  KEY `login_6` (`login`),
  KEY `login_7` (`login`),
  KEY `login_8` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `id_role`, `name`) VALUES
(1, 'test@test.ru', '202cb962ac59075b964b07152d234b70', 1, 'test');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
