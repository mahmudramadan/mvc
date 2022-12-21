-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2021 at 05:01 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `check24`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `active` int(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `active`, `name`, `created_at`) VALUES
(1, 1, 'Mahmoud Ramadan', '2021-12-22 14:50:19'),
(2, 1, 'Felix', '2021-12-22 14:50:19'),
(3, 1, 'Ali Mahmoud', '2021-12-22 14:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `comment` varchar(555) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `publish_by` int(11) NOT NULL,
  `publish_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `active` tinyint(1) NOT NULL,
  `author` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `active`, `author`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'News Title 1', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visua', 1, 'Mahmoud Ramadan', '2021-12-22 10:52:06', 1, '2021-12-22 10:52:06', 1),
(2, 'News Title 2\r\n', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visuaLorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visua', 1, 'Mahmoud Ramadan', '2021-12-22 10:52:06', 1, '2021-12-22 10:52:06', 1),
(6, 'efrtyui', 'egrdhtfjyguhkj.l;./', 1, 'Mahmoud Ramadan', '2021-12-22 15:43:24', 0, '2021-12-22 15:43:24', 0),
(7, 'ewfrgthygmjhk', 'rgdhtfgyjhjk.l,./', 1, 'Mahmoud Ramadan', '2021-12-22 15:49:46', 0, '2021-12-22 15:49:46', 0),
(8, 'erdtfgyhj,k', 'rtyukhijokl;\'\r\n', 1, 'Mahmoud Ramadan', '2021-12-22 15:55:07', 0, '2021-12-22 15:55:07', 0),
(9, 'qwerthyuki', 'ertyukijkl', 1, 'Mahmoud Ramadan', '2021-12-22 15:55:47', 0, '2021-12-22 15:55:47', 0),
(10, 'qwerthyuki', 'ertyukijkl', 1, 'Mahmoud Ramadan', '2021-12-22 15:55:50', 0, '2021-12-22 15:55:50', 0),
(11, 'fergthyjuh', 'erytfkuhj.kl', 1, 'Mahmoud Ramadan', '2021-12-22 15:56:13', 0, '2021-12-22 15:56:13', 0),
(12, 'qwertyuhjk', 'eyrtykulij.kl', 1, 'Mahmoud Ramadan', '2021-12-22 15:56:35', 0, '2021-12-22 15:56:35', 0),
(13, 'wertjyukijk', 'ertykulijk/l', 1, 'Mahmoud Ramadan', '2021-12-22 15:56:44', 0, '2021-12-22 15:56:44', 0),
(14, 'صبثلقافغتلعتنم', 'ثقيفابغلنعاهتنظمكط', 1, 'Mahmoud Ramadan', '2021-12-22 15:58:31', 0, '2021-12-22 15:58:31', 0),
(15, 'فبلات', 'صثقفغلنعاهتنم', 1, 'Mahmoud Ramadan', '2021-12-22 15:58:44', 0, '2021-12-22 15:58:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(555) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `active`, `created_at`) VALUES
(1, 'mahmoud ramadan', 'admin@admin.com', '$2y$10$ZGVE0aFG8ecoO/PSYJRHgOeMs46Hq.mFzJiNHWUTJhEr/FqwlZ72G', 1, '2021-12-22 10:04:41'),
(2, 'ahmedramadan', '', '', 0, '2021-12-22 10:04:41'),
(3, 'ahmedramadan', '', '', 0, '2021-12-22 10:04:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
