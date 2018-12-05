-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 05 2018 г., 21:35
-- Версия сервера: 10.1.25-MariaDB
-- Версия PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `faq`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` smallint(6) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `super` tinyint(1) NOT NULL DEFAULT '0',
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `login`, `pass`, `status`, `super`, `date_reg`) VALUES
(1, 'admin', 'admin', 1, 1, '2018-11-21 21:22:28'),
(2, 'mg1', '0000', 0, 0, '2018-11-21 21:22:28');

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `id` smallint(6) NOT NULL,
  `admin_id` smallint(6) NOT NULL,
  `content` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `admin_id`, `content`, `date_added`) VALUES
(1, 1, 'aaaaaaaaaaaaaaaaaaaaaaaaans', '2018-12-04 20:48:41'),
(2, 1, 'aaaaaaaaaaaaaaaaaaaaaaaaans', '2018-12-04 21:06:10');

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` smallint(6) NOT NULL,
  `name` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`, `email`, `date_added`) VALUES
(3, 'ден', 'mg84@bk.ru', '2018-11-26 20:55:56'),
(4, 'mg1', 'mg6625@gmail.com', '2018-11-27 16:22:48');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` smallint(6) NOT NULL,
  `title` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'JavaScript'),
(4, 'PHP'),
(7, 'Webpack');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` smallint(6) NOT NULL,
  `title` tinytext,
  `author_id` smallint(6) DEFAULT NULL,
  `category_id` smallint(6) NOT NULL,
  `content` text NOT NULL,
  `answer_id` smallint(6) DEFAULT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `title`, `author_id`, `category_id`, `content`, `answer_id`, `is_show`, `date_added`) VALUES
(12, 'PHP', 3, 1, 'nknknknknknkn', NULL, 0, '2018-12-03 20:43:28'),
(13, 'alert-danger', 3, 4, 'gliulublui66456464646', 1, 0, '2018-12-04 20:48:41'),
(14, 'alert-danger', 3, 1, '5464d654w6qwqwdq6wdqwd', 2, 0, '2018-12-04 21:06:10');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
