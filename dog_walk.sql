-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 28, 2023 at 04:42 PM
-- Server version: 8.0.34-0ubuntu0.20.04.1
-- PHP Version: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `szimur`
--

-- --------------------------------------------------------

--
-- Table structure for table `dogs`
--

CREATE TABLE `dogs` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `breed` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dogs`
--

INSERT INTO `dogs` (`id`, `user_id`, `breed`, `name`, `comment`) VALUES
(11, 1, 'asd', 'asd', 'asd'),
(12, 1, 'teszt', 'teszt', 'teszt'),
(13, 3, 'Husky', 'Valami', 'kkkkkk'),
(14, 3, 'aaa', 'aaa', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `create_datetime` datetime NOT NULL,
  `adminlevel` int DEFAULT NULL,
  `banned` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `rating` int DEFAULT NULL,
  `rates` int DEFAULT '0',
  `walked_dogs` int DEFAULT '0',
  `wants_to_be_walker` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `create_datetime`, `adminlevel`, `banned`, `description`, `rating`, `rates`, `walked_dogs`, `wants_to_be_walker`) VALUES
(1, 'Erik', 'pecsierik02@gmail.com', '2ac13174447d86f2918c7dcd1895e7a6', '2023-06-07 21:17:31', 2, 0, 'teszt', 4, 4, 4, 0),
(2, 'Erik2', 'pecsierik01@gmail.com', '2ac13174447d86f2918c7dcd1895e7a6', '2023-08-25 16:02:38', 1, 0, 'új leírás teszt', 5, 2, 1, 0),
(3, 'Teszt', 'valami@gmail.com', '2ac13174447d86f2918c7dcd1895e7a6', '2023-08-25 16:53:50', 0, 0, 'teszt', NULL, 0, 0, 0),
(5, 'VTS', 'vts@gmail.com', 'ce2403ca5fc076f684e0b2db7619856c', '2023-08-28 11:07:00', NULL, NULL, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `walks`
--

CREATE TABLE `walks` (
  `id` int NOT NULL,
  `dog_id` int NOT NULL,
  `user_id` int NOT NULL,
  `walker_id` int DEFAULT NULL,
  `day` datetime NOT NULL,
  `message` text COLLATE utf8mb4_general_ci,
  `status` enum('pending','accepted') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `response` text COLLATE utf8mb4_general_ci,
  `rated` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `walks`
--

INSERT INTO `walks` (`id`, `dog_id`, `user_id`, `walker_id`, `day`, `message`, `status`, `created_at`, `accepted_at`, `response`, `rated`) VALUES
(19, 14, 3, 1, '2023-08-29 17:20:00', 'Szeretnem ha valaki elvinne a kutyam', 'pending', '2023-08-28 11:08:49', '2023-08-28 11:10:06', 'Ott leszek', 1),
(20, 13, 3, 2, '2023-08-29 17:50:00', 'aaaaaaa', 'pending', '2023-08-28 11:16:15', '2023-08-28 11:16:26', 'aaaa', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dogs`
--
ALTER TABLE `dogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `walks`
--
ALTER TABLE `walks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dog_id` (`dog_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `walker_id` (`walker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dogs`
--
ALTER TABLE `dogs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `walks`
--
ALTER TABLE `walks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `walks`
--
ALTER TABLE `walks`
  ADD CONSTRAINT `walks_ibfk_1` FOREIGN KEY (`dog_id`) REFERENCES `dogs` (`id`),
  ADD CONSTRAINT `walks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `walks_ibfk_3` FOREIGN KEY (`walker_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
