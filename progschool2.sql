-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 31 2013 г., 00:04
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

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
(11, 0, 'По новой теме11', 'Ураа!!'),
(12, 0, 'опа работает222', 'sfsfs');

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
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `privs`
--

INSERT INTO `privs` (`id_priv`, `name`, `description`) VALUES
(1, 'USE_SECRET_FUNCTIONS', 'Привилегия для примера'),
(2, 'VIEW_ADMINKA', 'Право захода в админ панель');

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
(1, 1),
(2, 2),
(2, 3),
(2, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id_role`, `name`, `description`) VALUES
(1, 'test', 'Роль для примера'),
(2, 'Администратор', 'Имеет все привелегии'),
(3, 'Модератор', 'Может редактировать удалять все записи, но не может чего-то другого, чего пока ещё нет на сайте, но что может админ'),
(4, 'Автор', 'Может редактировать только свои статьи'),
(5, 'Пользователь', 'Зарегистрированный пользователь круче незарегистрированного');

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
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id_session`, `id_user`, `sid`, `time_start`, `time_last`) VALUES
(1, 1, 'lXp1youoYW', '2013-06-14 21:04:03', '2013-06-14 21:33:31'),
(2, 1, 'eBGxC65ERr', '2013-06-14 21:34:42', '2013-06-14 21:40:02'),
(3, 1, 'J7u2B9rWw9', '2013-07-23 18:40:43', '2013-07-23 18:40:43'),
(4, 1, '23Jm0J7Kuk', '2013-07-23 18:54:56', '2013-07-23 18:54:56'),
(5, 1, 'lCGDLPIxQn', '2013-08-20 21:26:39', '2013-08-20 21:38:05'),
(6, 1, 'igXjZ8ET7j', '2013-08-20 21:44:58', '2013-08-20 21:44:58'),
(7, 2, 'm9lygM8bz1', '2013-10-20 15:54:41', '2013-10-20 15:54:41'),
(8, 2, 'kopuSlrZpr', '2013-10-20 15:55:23', '2013-10-20 15:55:23'),
(9, 2, 'nTYGwSWfeA', '2013-10-20 16:39:01', '2013-10-20 16:42:30'),
(10, 2, 'Q0L7aSvlmp', '2013-10-20 16:42:54', '2013-10-20 16:43:54'),
(11, 2, 'ZvTg2pTw3j', '2013-10-20 16:44:02', '2013-10-20 16:45:17'),
(12, 4, 'qWAxShXaaQ', '2013-10-20 16:46:58', '2013-10-20 16:47:00'),
(13, 2, 'DqgtUcwELz', '2013-10-20 16:47:10', '2013-10-20 22:03:05'),
(14, 4, 'k13zWPZYdG', '2013-10-20 22:03:16', '2013-10-20 22:03:27'),
(15, 2, 'r6EJCpCdWN', '2013-10-20 22:03:40', '2013-10-20 22:03:43'),
(16, 2, 'XmvdgPKIIO', '2013-10-20 22:05:41', '2013-10-20 22:09:56'),
(17, 2, '8cOvKDPEvl', '2013-10-20 22:13:02', '2013-10-20 22:23:23'),
(18, 4, 'AoNFDGo2R6', '2013-10-20 22:23:41', '2013-10-20 22:23:45'),
(19, 2, '27XdP2sa53', '2013-10-20 22:23:59', '2013-10-20 22:23:59'),
(20, 4, '2TxSI1Ukvg', '2013-10-27 20:20:59', '2013-10-27 20:20:59'),
(21, 2, 'BruTLPnUQv', '2013-10-27 20:21:27', '2013-10-27 20:21:27'),
(22, 4, 'r7cobCeaWp', '2013-10-27 20:23:36', '2013-10-27 20:24:54'),
(23, 2, 'CAu90ypsKW', '2013-10-27 20:24:59', '2013-10-27 20:27:12'),
(24, 4, 'nmblxzDfNH', '2013-10-27 20:33:16', '2013-10-27 21:45:43'),
(25, 4, 'lk8rMIUeNm', '2013-10-28 21:34:47', '2013-10-28 21:35:56'),
(26, 4, 'bpxY2wunSR', '2013-10-29 20:19:02', '2013-10-29 21:05:42'),
(27, 2, 'k4FwRG6Shn', '2013-10-29 20:36:22', '2013-10-29 20:36:22'),
(28, 2, 'bl9ijPY1gs', '2013-10-29 21:05:48', '2013-10-29 21:07:41'),
(29, 4, 'ztD6WsSBkn', '2013-10-29 21:07:48', '2013-10-29 21:07:57');

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
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `id_role`, `name`) VALUES
(1, 'test@test.ru', '202cb962ac59075b964b07152d234b70', 1, 'test'),
(2, 'egor', '02ec22d13335352da91c1e6123f9b330', 5, NULL),
(4, 'admin', '8cdb75d605b2579a9b62ce62022eecab', 2, NULL),
(5, 'moder', '02ec22d13335352da91c1e6123f9b330', 3, NULL),
(6, 'author', '02ec22d13335352da91c1e6123f9b330', 4, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
