-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Вер 26 2023 р., 18:16
-- Версія сервера: 5.7.33
-- Версія PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `simpleauth`
--

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_bd` date NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_register` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `gender`, `date_bd`, `password`, `date_register`) VALUES
(2, 'test', 'ggg@hhh.jjj', 'Мужской', '1995-05-07', '$2y$10$eJ5hYdHZB2kR11sN1qYN1uEF0ZtK9dRn1kpKee04yZ4goqyhwHhj.', '2023-09-26 16:06:13'),
(3, 'test2', 'test2@g.com', 'Женский', '2023-09-13', '$2y$10$Xmet9Iy71iap.3F3SYl3w.wh26JonCLWWRikYUQRdh7e7AzQYLadu', '2023-09-26 18:05:06'),
(5, 'test3', 'test@ggg.jjjj', 'Мужской', '2011-02-09', '$2y$10$3sGT8weoihuv7Hh1mppAc.4LDjNt1R5I0yScVNuQqhWf9nv/zH/7q', '2023-09-26 18:15:18');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
