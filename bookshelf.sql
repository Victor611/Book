-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 26 2016 г., 12:53
-- Версия сервера: 5.7.15-0ubuntu0.16.04.1
-- Версия PHP: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bookshelf`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(255) UNSIGNED NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `pubyear` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `avatar`, `title`, `author`, `description`, `pubyear`, `genre_id`, `type`, `created_at`, `updated_at`) VALUES
(111, 'default.jpg', 'Мобильная реклама и аналитика для начинающих', 'Appsflyer.com', 'Основы маркетинга и продвижения', 2016, 4, 'Электронная', '2016-10-25 13:39:19', '2016-10-25 13:39:19'),
(112, 'default.jpg', 'Клиенты на всю жизнь', 'Сьюэлл К. Браун П.', 'Книга будет полезна как тем, кто только начинает свой бизнес, так и тем, кто ищет пути его дальнейшего расширения.', 2009, 5, 'Электронная', '2016-10-25 14:10:43', '2016-10-25 14:10:43'),
(113, 'default.jpg', 'Обнимите своих клиентов. Практика выдающегося обслуживания', 'Митчелл Д.', 'организация торговли,бизнес-процессы,привлечение клиентов,увеличение объема продаж,История бизнеса,маркетинговая деятельность,маркетинговые стратегии,бизнес-издания<', 2013, 5, 'Электронная', '2016-10-25 14:12:23', '2016-10-25 14:12:23'),
(114, 'default.jpg', 'Хватит думать! Действуй!', 'Энтони Р.', 'нет', 2016, 6, 'Электронная', '2016-10-25 14:16:19', '2016-10-25 14:16:19'),
(115, 'default.jpg', 'Главное внимание главным', 'Меррилл Р.', 'Эта книга о том как организовать свое время чтобы все успеть', 2011, 6, 'Электронная', '2016-10-25 14:18:16', '2016-10-25 14:18:29'),
(116, 'default.jpg', 'Разработка маркетинговой стратегии', 'Программа обучения маркетингу', 'стратегия маркетинга на предприятии', 2015, 7, 'Электронная', '2016-10-25 14:21:31', '2016-10-25 14:21:31'),
(117, 'default.jpg', 'Конкурентная стратегия. Методика анализа отраслей и конкурентов', 'Портер Е. Майкл', 'в книге предствлен анализ конкурентной структуры отрасли', 2005, 7, 'Электронная', '2016-10-25 14:24:00', '2016-10-25 14:24:00'),
(118, 'default.jpg', 'Маркетинговые войны', 'Траут Д.', 'Вы держите в руках один из самых гениальных в мире учебников по маркетингу. Легкая, информативная, необычайно практичная книга. Едва ли не с первого дня выхода в свет (в 1986 г.) она стала настольным пособием для сотен тысяч профессионалов во всем мире.', 1986, 7, 'Электронная', '2016-10-25 14:25:28', '2016-10-25 14:25:28'),
(119, 'default.jpg', 'Жесткий менеджмент', 'Кеннеди Д.', 'Заставьте людей работать на результат', 2014, 8, 'Электронная', '2016-10-25 14:28:21', '2016-10-25 14:28:21'),
(120, 'default.jpg', 'Курс стратегический менеджмент', 'васильев С.В.', 'Работа с практическими ситуациями', 2006, 8, 'Электронная', '2016-10-25 14:30:36', '2016-10-25 14:30:36'),
(121, 'default.jpg', 'О рекламе', 'Олигви Д.', 'В своей книге Огилви делится опытом создания рекламы, формулирует правила работы в рекламном бизнесе. В книге более 150 цветных и черно-белых иллюстраций с примерами рекламы, созданной при участии мэтра.', 2011, 1, 'Электронная', '2016-10-25 14:45:58', '2016-10-25 14:45:58');

-- --------------------------------------------------------

--
-- Структура таблицы `coments`
--

CREATE TABLE `coments` (
  `id` int(255) UNSIGNED NOT NULL,
  `coment` text COLLATE utf8_unicode_ci NOT NULL,
  `book_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `deps`
--

CREATE TABLE `deps` (
  `id` int(255) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `deps`
--

INSERT INTO `deps` (`id`, `parent_id`, `name`) VALUES
(4, 0, 'R&D'),
(6, 0, 'Marketing'),
(7, 0, 'Fin'),
(8, 0, 'Admin'),
(9, 0, 'Implementation');

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Реклама'),
(2, 'Компьютер Сайнс'),
(3, 'Стратегия'),
(4, 'Аналитика'),
(5, 'Клайн сервис'),
(6, 'Личностный рост'),
(7, 'Маркетинг'),
(8, 'Менеджмент'),
(9, 'Продажи'),
(10, 'Другое');

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE `links` (
  `id` int(255) UNSIGNED NOT NULL,
  `book_id` int(11) NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `format` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `links`
--

INSERT INTO `links` (`id`, `book_id`, `url`, `format`) VALUES
(1, 50, 'http:\\\\www', 'doc'),
(2, 50, 'http:\\\\www.google.com', 'mobi'),
(3, 111, 'https://drive.google.com/open?id=0Bx9ssw8KrtI3clBCVEhfdk9YSTg', 'pdf'),
(4, 112, 'https://drive.google.com/open?id=0Bx9ssw8KrtI3U2RTbklybGdYT1U', 'fb2'),
(5, 113, 'https://drive.google.com/open?id=0Bx9ssw8KrtI3RWV5SklsWk5kWWM', 'fb2'),
(6, 114, 'https://drive.google.com/open?id=0Bx9ssw8KrtI3Y19RWEtyc0dnNmM', 'doc'),
(7, 115, 'https://drive.google.com/open?id=0Bx9ssw8KrtI3RUVPZDY4bXlnSDQ', 'rtf'),
(8, 116, 'https://drive.google.com/open?id=0Bx9ssw8KrtI3ZHhvU1F6S2FJd1E', 'pdf'),
(9, 117, 'https://drive.google.com/open?id=0Bx9ssw8KrtI3d3R1cnF0SkEtejg', 'pdf'),
(10, 118, 'https://drive.google.com/open?id=0Bx9ssw8KrtI3MEtqQVlOYkc1MEk', 'fb2'),
(11, 119, 'https://drive.google.com/open?id=0Bx9ssw8KrtI3U2d6SjVDeVBRNU0', 'rtf'),
(12, 120, 'https://drive.google.com/open?id=0Bx9ssw8KrtI3Slp0THhzWjNYUmc', 'doc'),
(13, 121, 'https://drive.google.com/open?id=0Bx9ssw8KrtI3TWU5MFFNVjBHUG8', 'fb2');

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE `logs` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `obj_type` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `obj_id`, `obj_type`, `ip`, `time`, `action`) VALUES
(123, 6, 110, 1, '192.168.1.182', '0000-00-00 00:00:00', 'update'),
(124, 6, 110, 1, '192.168.1.182', '2016-10-25 12:17:48', 'update'),
(125, 6, 21, 2, '192.168.1.182', '2016-10-25 12:29:56', 'update'),
(126, 6, 21, 2, '192.168.1.182', '2016-10-25 12:29:59', 'update'),
(127, 6, 21, 2, '192.168.1.182', '2016-10-25 12:30:02', 'update'),
(128, 6, 21, 2, '192.168.1.182', '2016-10-25 12:30:07', 'update'),
(129, 6, 21, 2, '192.168.1.182', '2016-10-25 12:30:15', 'update'),
(130, 6, 21, 2, '192.168.1.182', '2016-10-25 12:30:18', 'update'),
(131, 6, 21, 2, '192.168.1.182', '2016-10-25 12:30:22', 'update'),
(132, 6, 21, 2, '192.168.1.182', '2016-10-25 12:30:26', 'update'),
(133, 6, 21, 2, '192.168.1.182', '2016-10-25 12:30:31', 'update'),
(134, 6, 21, 2, '192.168.1.182', '2016-10-25 12:30:35', 'update'),
(135, 6, 21, 2, '192.168.1.182', '2016-10-25 12:30:42', 'update'),
(136, 6, 21, 2, '192.168.1.182', '2016-10-25 12:30:46', 'update'),
(137, 6, 21, 2, '192.168.1.182', '2016-10-25 12:30:50', 'update'),
(138, 6, 5, 2, '192.168.1.182', '2016-10-25 13:05:38', 'update'),
(139, 6, 6, 2, '192.168.1.182', '2016-10-25 13:05:55', 'update'),
(140, 6, 22, 2, '192.168.1.182', '2016-10-25 13:08:23', 'create'),
(141, 6, 23, 2, '192.168.1.182', '2016-10-25 13:09:15', 'create'),
(142, 6, 24, 2, '192.168.1.182', '2016-10-25 13:10:02', 'create'),
(143, 6, 25, 2, '192.168.1.182', '2016-10-25 13:10:49', 'create'),
(144, 6, 25, 2, '192.168.1.182', '2016-10-25 13:10:56', 'update'),
(145, 6, 6, 2, '192.168.1.182', '2016-10-25 13:20:35', 'update'),
(146, 6, 26, 2, '192.168.1.182', '2016-10-25 13:22:26', 'create'),
(147, 6, 27, 2, '192.168.1.182', '2016-10-25 13:23:15', 'create'),
(148, 6, 21, 2, '192.168.1.182', '2016-10-25 13:25:40', 'delete'),
(149, 6, 20, 2, '192.168.1.182', '2016-10-25 13:25:48', 'delete'),
(150, 6, 111, 1, '192.168.1.182', '2016-10-25 13:39:19', 'create'),
(151, 6, 28, 2, '192.168.1.182', '2016-10-25 13:48:32', 'create'),
(152, 6, 29, 2, '192.168.1.182', '2016-10-25 13:49:19', 'create'),
(153, 6, 30, 2, '192.168.1.182', '2016-10-25 13:49:59', 'create'),
(154, 6, 31, 2, '192.168.1.182', '2016-10-25 13:50:51', 'create'),
(155, 6, 32, 2, '192.168.1.182', '2016-10-25 13:52:18', 'create'),
(156, 6, 5, 2, '192.168.1.182', '2016-10-25 13:52:26', 'update'),
(157, 6, 33, 2, '192.168.1.182', '2016-10-25 13:54:55', 'create'),
(158, 6, 34, 2, '192.168.1.182', '2016-10-25 13:57:16', 'create'),
(159, 6, 35, 2, '192.168.1.182', '2016-10-25 13:57:56', 'create'),
(160, 6, 36, 2, '192.168.1.182', '2016-10-25 13:58:53', 'create'),
(161, 6, 36, 2, '192.168.1.182', '2016-10-25 13:59:02', 'update'),
(162, 6, 37, 2, '192.168.1.182', '2016-10-25 14:00:04', 'create'),
(163, 6, 38, 2, '192.168.1.182', '2016-10-25 14:01:29', 'create'),
(164, 6, 39, 2, '192.168.1.182', '2016-10-25 14:02:15', 'create'),
(165, 6, 40, 2, '192.168.1.182', '2016-10-25 14:03:16', 'create'),
(166, 6, 41, 2, '192.168.1.182', '2016-10-25 14:04:13', 'create'),
(167, 6, 42, 2, '192.168.1.182', '2016-10-25 14:05:01', 'create'),
(168, 6, 43, 2, '192.168.1.182', '2016-10-25 14:06:03', 'create'),
(169, 6, 112, 1, '192.168.1.182', '2016-10-25 14:10:43', 'create'),
(170, 6, 113, 1, '192.168.1.182', '2016-10-25 14:12:23', 'create'),
(171, 6, 114, 1, '192.168.1.182', '2016-10-25 14:16:19', 'create'),
(172, 6, 115, 1, '192.168.1.182', '2016-10-25 14:18:16', 'create'),
(173, 6, 115, 1, '192.168.1.182', '2016-10-25 14:18:22', 'update'),
(174, 6, 115, 1, '192.168.1.182', '2016-10-25 14:18:29', 'update'),
(175, 6, 116, 1, '192.168.1.182', '2016-10-25 14:21:31', 'create'),
(176, 6, 117, 1, '192.168.1.182', '2016-10-25 14:24:00', 'create'),
(177, 6, 118, 1, '192.168.1.182', '2016-10-25 14:25:28', 'create'),
(178, 6, 119, 1, '192.168.1.182', '2016-10-25 14:28:21', 'create'),
(179, 6, 120, 1, '192.168.1.182', '2016-10-25 14:30:36', 'create'),
(180, 6, 121, 1, '192.168.1.182', '2016-10-25 14:45:58', 'create');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_09_30_064027_create_tasks_table', 1),
('2016_10_03_144748_create_books_table', 2),
('2016_10_03_153701_create_genres_table', 2),
('2016_10_11_153359_create_deps_table', 3),
('2016_10_12_104316_create_recomends_table', 4),
('2016_10_12_121531_create_links_table', 5),
('2016_10_13_155244_create_logs_table', 6),
('2016_10_13_162203_create_logs_table', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('del@del.del', 'a26f03a6ab8b417cb186cb956a5a6c307ee003be7c1cce8fac4e3330c773fcb9', '2016-10-16 08:59:11'),
('moder@mail.ru', 'dd00593614ac04892daf4a0bf2eb1fa33fbc990d330f76d12c18506aaf0c1efe', '2016-10-19 08:55:03'),
('admin@mail.ru', '074b70f3927226bc09ac24fb52dcc123ab2c164ba4cdc52e1afd4c3fa31a4dd7', '2016-10-24 08:42:20'),
('sorokin.victor.v@gmail.com', 'ced882a7eb8d5e05771fd936c874962eab18a8509ece20bc77d363ebecfe14ff', '2016-10-25 08:28:32');

-- --------------------------------------------------------

--
-- Структура таблицы `ratings`
--

CREATE TABLE `ratings` (
  `id` int(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `status` int(10) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `book_id`, `status`, `rating`, `created_at`, `updated_at`) VALUES
(16, 6, 39, 3, 4, '2016-10-11 06:21:20', '2016-10-13 07:26:05'),
(17, 6, 49, 2, 3, '2016-10-12 05:01:51', '2016-10-19 12:07:25'),
(19, 6, 47, 3, 3, '2016-10-13 15:28:12', '2016-10-25 12:43:15'),
(20, 6, 48, 3, 5, '2016-10-19 12:07:20', '2016-10-20 10:44:22'),
(21, 6, 53, 2, 3, '2016-10-19 12:07:39', '2016-10-19 12:07:39'),
(23, 5, 47, 1, NULL, '2016-10-25 08:15:46', '2016-10-25 08:15:46'),
(26, 6, 111, 3, NULL, '2016-10-25 15:12:58', '2016-10-25 15:13:02');

-- --------------------------------------------------------

--
-- Структура таблицы `recomends`
--

CREATE TABLE `recomends` (
  `rec_id` int(10) UNSIGNED NOT NULL,
  `dep_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `recomends`
--

INSERT INTO `recomends` (`rec_id`, `dep_id`, `book_id`, `status`) VALUES
(8, 4, 48, 1),
(30, 4, 47, 1),
(31, 5, 47, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'moderator'),
(3, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) NOT NULL,
  `dep_id` int(10) NOT NULL,
  `active` int(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `dep_id`, `active`) VALUES
(5, 'Михалко Владимир', 'admin@mail.ru', 'default.jpg', '$2y$10$BWBn6fMJTVM8NJE/4u/eMuao.buSKFjUatGqtVwsWpayywrJrLxGW', '4g4EIqXXbkNPMKyZx21ztLnGMEGhmcDVcMV26Vxpg8mus5aax3jq5XRM2DJd', '2016-09-30 08:32:59', '2016-10-25 13:52:26', 1, 6, 1),
(6, 'Смовженко Марина', 'moder@mail.ru', '1475837246.jpg', '$2y$10$pY5e2Q8dqGbTIk7.0JQ9uenI7hAgNQ1ohiOKTpDoseaDe5mLpjPVG', 'UCqo6CATmfwjD8GwlT7LsIIyqWDMtHvMbDhjxwBjufr4fwPkeyHcffsso08k', '2016-09-30 08:33:28', '2016-10-25 13:26:03', 2, 8, 1),
(22, 'Ковальчук Иван', 'ivan@mail.ru', 'default.jpg', '$2y$10$owziP6ZVGLK02qscOgAvjOqEy5vPV5BIYDvqnQXijw5uQl0RWTqS6', NULL, '2016-10-25 13:08:23', '2016-10-25 13:08:23', 3, 4, 1),
(23, 'Белотелов Олег', 'oleg@mail.ru', 'default.jpg', '$2y$10$QeKyd2tQAWOLtkew4BjyzeKsny4SMj6Pyao5fZdvZ9VxKmIb8syRe', NULL, '2016-10-25 13:09:15', '2016-10-25 13:09:15', 3, 4, 1),
(24, 'Пономаренко Руслан', 'Ruslan@mail.ru', 'default.jpg', '$2y$10$ILNZQhQwXsyH19lqUhaUOeENUIzZYSknFRYDGnn9Gik7J9n.uKvcC', NULL, '2016-10-25 13:10:02', '2016-10-25 13:10:02', 3, 4, 1),
(25, 'Черненко Кирилл', 'kirill@mail.ru', 'default.jpg', '$2y$10$2OJ1E6czUTulpo.mLBRKl.0QFRZOVtaWcBou0DGDt/49C86U5poSS', '4YBAOgWHz3YrnsPYcZOmmvLTXz4hQ5f36R7O1NoZWWtLHHhD67KxUkbtfj8r', '2016-10-25 13:10:49', '2016-10-25 13:26:21', 3, 4, 1),
(26, 'Немченко Виктория', 'Vika@mail.ru', 'default.jpg', '$2y$10$bBAB6qeVZUAdHNkELmMPpukZsmXQGOi7l4PxX6NICMewhqKJPCVvi', NULL, '2016-10-25 13:22:26', '2016-10-25 13:22:26', 3, 7, 1),
(27, 'Ивашкевич Инна', 'Inna@mail.ru', 'default.jpg', '$2y$10$77GPPZq2dhalJ93wP9Te2u24vH5xudQiM9SlRdV4xHlmSmaqhDeoq', NULL, '2016-10-25 13:23:15', '2016-10-25 13:23:15', 3, 7, 1),
(28, 'Миргородченко Дмитрий', 'dmitriy@mail.ru', 'default.jpg', '$2y$10$rF91ZPeTgG5praMrMaxmzO.VZCePR0J6BJzOdsikW3qtuCDvLuF2a', NULL, '2016-10-25 13:48:32', '2016-10-25 13:48:32', 3, 4, 1),
(29, 'Бакалов Богдан', 'bogdan@mail.ru', 'default.jpg', '$2y$10$BJx11TrJdhOL/Oi..JxnT.oc1ElcHz6Ue.S8jLts2UP31TwMiD7OG', NULL, '2016-10-25 13:49:19', '2016-10-25 13:49:19', 3, 4, 1),
(30, 'Гаврилко Евгений', 'evgeniy@mail.ru', 'default.jpg', '$2y$10$8Pn3zpMPvJ3/oysqSBYBY.sB4qE6P3qjycko2szcIJ44T2aMVFJ.u', NULL, '2016-10-25 13:49:59', '2016-10-25 13:49:59', 3, 4, 1),
(31, 'Тимко Елена', 'elena@mail.ru', 'default.jpg', '$2y$10$c0DBtYcFfz1k4gn5o0NUge2tLpqPHYO7W1HAPDk/EZQMGNifwHQZO', NULL, '2016-10-25 13:50:51', '2016-10-25 13:50:51', 3, 7, 1),
(32, 'Пучко Кирилл', 'Pkirill@mail.ru', 'default.jpg', '$2y$10$qjrQQtPDBoN98leMwVz.WeLn/LYr42i8cUs8QktU3A8ccva4g2hBa', NULL, '2016-10-25 13:52:18', '2016-10-25 13:52:18', 3, 6, 1),
(33, 'Таланова Наталья', 'natalia@mail.ru', 'default.jpg', '$2y$10$lUqXjwTODvBKj7icYEs5mOdK0PRA.JkxhBeHy2KdcTTSMjIhZPAX2', NULL, '2016-10-25 13:54:55', '2016-10-25 13:54:55', 3, 6, 1),
(34, 'Панасюк Дмитрий', 'pdmitriy@mail.ru', 'default.jpg', '$2y$10$fmlEaXyV.4HmIHGkW5GPNe/2xp8.5qqur8lURbZ5HjiHN0tWpZGey', NULL, '2016-10-25 13:57:16', '2016-10-25 13:57:16', 3, 6, 1),
(35, 'Собакевич Алексей', 'aleksey@mail.ru', 'default.jpg', '$2y$10$74kQNPRd5FIM3/hgkeMEw.5XBRjn2drIlgj79SUyn/AcJVdUBq2nO', NULL, '2016-10-25 13:57:56', '2016-10-25 13:57:56', 3, 6, 1),
(36, 'Лавренчук Марина', 'marina@mail.ru', 'default.jpg', '$2y$10$ZNxms3hu.x1TfpygYbBdu.MKeDChuyr7gU1pxJfydZVxjk0Kvm042', NULL, '2016-10-25 13:58:53', '2016-10-25 13:59:02', 3, 6, 1),
(37, 'Игнатенко Антон', 'anton@mail.ru', 'default.jpg', '$2y$10$RduN4ElxrSo85JzNCaktMOJCZV7qOxF1zkhLrO93F0GpC/8xo0VvG', NULL, '2016-10-25 14:00:04', '2016-10-25 14:00:04', 3, 6, 1),
(38, 'Немченко Алена', 'alena@mail.ru', 'default.jpg', '$2y$10$vQ9BQKapkV5HbUACB6PlYeyi816bpKTnnrkfOfn.YUXBGRdCVOIYi', NULL, '2016-10-25 14:01:29', '2016-10-25 14:01:29', 3, 8, 1),
(39, 'Доценко Сергей', 'sergey@mail.ru', 'default.jpg', '$2y$10$RCNqxn3ZjJQTpLmnkUey0ODc9dkPBQe8yITFowFUNzppwerwqoa76', NULL, '2016-10-25 14:02:15', '2016-10-25 14:02:15', 3, 8, 1),
(40, 'Глушак Алксандр', 'aleksandr@mail.ru', 'default.jpg', '$2y$10$Jj2cJ.fKnRJeQLBqxuSOn.k95OWplxeuBLgHJJJ2XAs0lDDKTaGXC', NULL, '2016-10-25 14:03:16', '2016-10-25 14:03:16', 3, 9, 1),
(41, 'Милевский Дмитрий', 'mdmitriy@mail.ru', 'default.jpg', '$2y$10$9mnmG/dA/TVR0HLUXs1RbeSyOxaHkbBFkvCAwpbFl3JtQa539amFm', NULL, '2016-10-25 14:04:13', '2016-10-25 14:04:13', 3, 9, 1),
(42, 'Подурян Алексей', 'paleksey@mail.ru', 'default.jpg', '$2y$10$VYtx9g0iabwf1wpuf5Wx.uDGPPxQHT12LJsZSrLIKJY2D/IH3IE.6', NULL, '2016-10-25 14:05:01', '2016-10-25 14:05:01', 3, 9, 1),
(43, 'Сальникова Светлана', 'svetlana@mail.ru', 'default.jpg', '$2y$10$uHa/nR.kG/yDW.NK7JCVtuDciDOso5Nh7M25.Mj80ogBeDpuaKYmC', NULL, '2016-10-25 14:06:03', '2016-10-25 14:06:03', 3, 9, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `coments`
--
ALTER TABLE `coments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `deps`
--
ALTER TABLE `deps`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_obj_id_obj_type_index` (`obj_id`,`obj_type`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Индексы таблицы `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `recomends`
--
ALTER TABLE `recomends`
  ADD PRIMARY KEY (`rec_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT для таблицы `coments`
--
ALTER TABLE `coments`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `deps`
--
ALTER TABLE `deps`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `links`
--
ALTER TABLE `links`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT для таблицы `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `recomends`
--
ALTER TABLE `recomends`
  MODIFY `rec_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
