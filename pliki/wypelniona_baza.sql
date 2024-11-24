-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 24, 2024 at 02:22 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komunikator`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `friendships`
--

CREATE TABLE `friendships` (
  `id` int(11) NOT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`id`, `user1_id`, `user2_id`, `status`, `created_at`) VALUES
(1, 8, 9, 'accepted', '2024-11-18 20:11:39'),
(2, 10, 8, 'accepted', '2024-11-21 22:45:48'),
(15, 8, 11, 'accepted', '2024-11-22 23:50:53'),
(16, 12, 8, 'accepted', '2024-11-23 17:25:48'),
(17, 13, 8, 'accepted', '2024-11-24 12:18:51'),
(18, 12, 10, 'accepted', '2024-11-24 13:19:09');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_content` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message_content`, `sent_at`) VALUES
(1, 8, 9, 'pierwsza wiadomość', '2024-11-18 20:13:36'),
(2, 8, 9, 'siema', '2024-11-18 20:39:08'),
(3, 9, 8, 'elo', '2024-11-18 20:39:31'),
(4, 9, 8, 'yooo', '2024-11-18 22:34:39'),
(6, 8, 9, 'cze', '2024-11-21 21:11:59'),
(7, 8, 9, 'cze', '2024-11-21 21:13:09'),
(8, 8, 9, 'siema', '2024-11-21 21:13:15'),
(9, 8, 9, 'siema', '2024-11-21 21:13:17'),
(10, 8, 9, 'siema', '2024-11-21 21:13:22'),
(11, 8, 9, 'yooo', '2024-11-21 21:13:25'),
(12, 8, 9, 'yo', '2024-11-22 18:53:19'),
(13, 8, 9, 'x', '2024-11-22 22:01:40'),
(14, 8, 9, 'x', '2024-11-22 22:03:07'),
(15, 8, 9, 'x', '2024-11-22 22:03:31'),
(16, 8, 9, 'x', '2024-11-22 22:04:28'),
(17, 8, 9, 'x', '2024-11-22 22:06:07'),
(18, 8, 9, 'x', '2024-11-22 22:07:42'),
(19, 8, 9, 'x', '2024-11-22 22:08:17'),
(20, 8, 9, 'x', '2024-11-22 22:08:34'),
(21, 8, 9, 'x', '2024-11-22 22:08:47'),
(22, 8, 9, 'x', '2024-11-22 22:09:24'),
(23, 8, 9, 'x', '2024-11-22 22:09:57'),
(24, 8, 9, 'x', '2024-11-22 22:10:05'),
(25, 8, 9, 'x', '2024-11-22 22:10:30'),
(26, 8, 9, 'x', '2024-11-22 22:10:42'),
(27, 8, 9, 'x', '2024-11-22 22:11:09'),
(28, 8, 9, 'yo', '2024-11-22 22:53:21'),
(29, 8, 9, 'yo', '2024-11-22 22:53:26'),
(30, 8, 9, 'yo', '2024-11-22 22:54:41'),
(31, 8, 9, 'yo', '2024-11-22 22:54:43'),
(32, 8, 9, 'yo', '2024-11-22 22:54:52'),
(33, 8, 9, 'yo', '2024-11-22 22:55:30'),
(34, 8, 9, 'yo', '2024-11-22 22:56:37'),
(35, 8, 9, 'yo', '2024-11-22 22:56:38'),
(36, 8, 9, 'yo', '2024-11-22 22:56:49'),
(37, 8, 9, 'yo', '2024-11-22 22:56:52'),
(38, 8, 9, 'xd', '2024-11-22 23:12:52'),
(39, 8, 9, 'xd', '2024-11-22 23:12:56'),
(40, 11, 8, 'yo', '2024-11-22 23:35:18'),
(41, 8, 11, 'ale z cb sigma', '2024-11-22 23:51:06'),
(42, 8, 11, 'asd', '2024-11-22 23:51:16'),
(43, 8, 11, 'yo', '2024-11-23 00:21:51'),
(44, 8, 11, 'yo', '2024-11-23 00:22:01'),
(45, 11, 8, 'cze', '2024-11-23 00:34:34'),
(46, 11, 8, 'yo', '2024-11-23 00:35:53'),
(47, 11, 8, 'cze', '2024-11-23 00:41:39'),
(48, 8, 11, 'ema', '2024-11-23 00:48:09'),
(49, 11, 8, 'cze', '2024-11-23 00:48:18'),
(50, 8, 11, 'witaj', '2024-11-23 00:48:25'),
(51, 8, 11, 'hhhbjhbjhbhjb', '2024-11-23 00:54:52'),
(52, 11, 8, 'poijkpiojpjpoij', '2024-11-23 00:54:59'),
(53, 11, 8, 'cze', '2024-11-23 00:58:16'),
(54, 8, 11, 'ghj', '2024-11-23 00:58:52'),
(55, 8, 11, 'ghj', '2024-11-23 00:58:54'),
(56, 8, 11, 'sdf', '2024-11-23 00:58:59'),
(57, 8, 11, 'bomboclat', '2024-11-23 00:59:06'),
(58, 11, 8, 'czew', '2024-11-23 00:59:10'),
(59, 11, 8, 'zs', '2024-11-23 00:59:14'),
(60, 11, 8, 'sdf', '2024-11-23 00:59:16'),
(61, 11, 8, 'wer', '2024-11-23 00:59:25'),
(62, 8, 11, 'dfg', '2024-11-23 00:59:28'),
(63, 11, 8, 'asd', '2024-11-23 00:59:49'),
(64, 11, 8, 'dsdsdsd', '2024-11-23 00:59:52'),
(65, 12, 8, 'asd', '2024-11-23 17:29:59'),
(66, 13, 8, 'siema', '2024-11-24 12:20:43'),
(67, 13, 8, 'asd', '2024-11-24 12:22:16'),
(68, 13, 8, 'sdf', '2024-11-24 12:22:19'),
(69, 8, 13, 'dfg', '2024-11-24 12:22:22'),
(70, 8, 13, 'xdfsae', '2024-11-24 12:22:24'),
(71, 10, 12, 'siema', '2024-11-24 13:19:19'),
(72, 10, 12, 'yo', '2024-11-24 13:19:27');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `message_status`
--

CREATE TABLE `message_status` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message_status`
--

INSERT INTO `message_status` (`id`, `message_id`, `user_id`, `status`) VALUES
(1, 1, 9, 'read'),
(2, 2, 9, 'unread'),
(3, 3, 8, 'read'),
(4, 4, 8, 'read'),
(5, 7, 9, 'unread'),
(6, 8, 9, 'unread'),
(7, 9, 9, 'unread'),
(8, 10, 9, 'unread'),
(9, 11, 9, 'unread'),
(10, 12, 9, 'unread'),
(11, 13, 9, 'unread'),
(12, 14, 9, 'unread'),
(13, 15, 9, 'unread'),
(14, 16, 9, 'unread'),
(15, 17, 9, 'unread'),
(16, 18, 9, 'unread'),
(17, 19, 9, 'unread'),
(18, 20, 9, 'unread'),
(19, 21, 9, 'unread'),
(20, 22, 9, 'unread'),
(21, 23, 9, 'unread'),
(22, 24, 9, 'unread'),
(23, 25, 9, 'unread'),
(24, 26, 9, 'unread'),
(25, 27, 9, 'unread'),
(26, 28, 9, 'unread'),
(27, 29, 9, 'unread'),
(28, 30, 9, 'unread'),
(29, 31, 9, 'unread'),
(30, 32, 9, 'unread'),
(31, 33, 9, 'unread'),
(32, 34, 9, 'unread'),
(33, 35, 9, 'unread'),
(34, 36, 9, 'unread'),
(35, 37, 9, 'unread'),
(36, 38, 9, 'unread'),
(37, 39, 9, 'unread'),
(38, 40, 8, 'read'),
(39, 41, 11, 'read'),
(40, 42, 11, 'read'),
(41, 43, 11, 'read'),
(42, 44, 11, 'read'),
(43, 45, 8, 'read'),
(44, 46, 8, 'read'),
(45, 47, 8, 'read'),
(46, 48, 11, 'read'),
(47, 49, 8, 'read'),
(48, 50, 11, 'read'),
(49, 51, 11, 'read'),
(50, 52, 8, 'read'),
(51, 53, 8, 'read'),
(52, 54, 11, 'read'),
(53, 55, 11, 'read'),
(54, 56, 11, 'read'),
(55, 57, 11, 'read'),
(56, 58, 8, 'read'),
(57, 59, 8, 'read'),
(58, 60, 8, 'read'),
(59, 61, 8, 'read'),
(60, 62, 11, 'read'),
(61, 63, 8, 'read'),
(62, 64, 8, 'read'),
(63, 65, 8, 'read'),
(64, 66, 8, 'read'),
(65, 67, 8, 'read'),
(66, 68, 8, 'read'),
(67, 69, 13, 'read'),
(68, 70, 13, 'read'),
(69, 71, 12, 'read'),
(70, 72, 12, 'read');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(8, 'lolowyo', 'asd@asd.pl', '$2y$10$WTJsifz0pI.iytACafacZu0w192LoU.lsLJGljKbTeztGffV3ZdNy', '2024-11-01 22:59:11'),
(9, 'asdasd', 'asdw@asdw.pl', '$2y$10$3n8MpYTfAIWrqbdIpSxnYuuGmfslawhgfdK5c4wPaZYn2ZE1Ir4gC', '2024-11-01 22:59:55'),
(10, 'sigma', 'sigma@sigma.com', '$2y$10$B6jsQiVb87Z4M/vK9o7BZ.xfgbvA/DLQNtGf6mhH5ewN9CFxB4JQu', '2024-11-21 22:04:02'),
(11, 'xd', 'xd@xd.com', '$2y$10$MD3tN/ztImEcbqZQhc16SOw7TvCmyTQdM3zG/L/KD2hzhrITkky9S', '2024-11-22 19:15:39'),
(12, 'asd', 'asd@asd.com', '$2y$10$.ovqe5UJNaWyP/MrOVCM5.cTluS5afnEy/27Ux8ArvF48NTusQ8Me', '2024-11-23 17:25:39'),
(13, 'cos', 'cos@cos.com', '$2y$10$nfVou6RtY4b.so/.60itHeFP.i2pYGlkXbnsKFEg/15fK.st2z41u', '2024-11-24 12:18:47');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user1_id` (`user1_id`,`user2_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indeksy dla tabeli `message_status`
--
ALTER TABLE `message_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `message_status`
--
ALTER TABLE `message_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friendships`
--
ALTER TABLE `friendships`
  ADD CONSTRAINT `friendships_ibfk_1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friendships_ibfk_2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `message_status`
--
ALTER TABLE `message_status`
  ADD CONSTRAINT `message_status_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_status_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
