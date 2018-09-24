-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2018 at 02:54 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocked`
--

CREATE TABLE `blocked` (
  `id` int(11) NOT NULL,
  `user_id_one` int(11) NOT NULL,
  `user_id_two` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blocked`
--

INSERT INTO `blocked` (`id`, `user_id_one`, `user_id_two`) VALUES
(6, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `followed`
--

CREATE TABLE `followed` (
  `id` int(255) NOT NULL,
  `user_id_one` int(255) NOT NULL,
  `user_id_two` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followed`
--

INSERT INTO `followed` (`id`, `user_id_one`, `user_id_two`) VALUES
(54, 1, 3),
(55, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id_one` int(11) NOT NULL,
  `user_id_two` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_email`, `user_id`, `post`, `created_at`) VALUES
(1, 'saisai@gmail.com', 1, 'á€±á€•á€«á€„á€¹á€¸á€žá€„á€¹\r\ná€»á€™á€€á€¹á‚á€½á€´á€á€¹', '2018-09-23 11:02:20'),
(2, 'saisai@gmail.com', 1, 'á€±á€•á€«á€„á€¹á€¸á€žá€„á€¹\r\ná€»á€™á€€á€¹á‚á€½á€´á€á€¹', '2018-09-23 11:02:54'),
(3, 'saisai@gmail.com', 1, 'Let it go', '2018-09-23 11:03:05'),
(4, 'saisai@gmail.com', 1, 'dd', '2018-09-23 11:03:36'),
(5, 'saisai@gmail.com', 1, 'á€á€¬á€±á€•á€«\r\n', '2018-09-23 11:09:19'),
(6, 'saisai@gmail.com', 1, 'á€á€¬á€±á€•á€«\r\n', '2018-09-23 11:09:39'),
(7, 'saisai@gmail.com', 1, 'what', '2018-09-23 11:09:51'),
(8, 'saisai@gmail.com', 1, 'á€±á€™á€¬á€„á€¹á€±á€™á€¬á€„á€¹á€±á€žá€¬á€„á€¹á€¸', '2018-09-23 11:12:01'),
(9, 'saisai@gmail.com', 1, 'á€±á€™á€¬á€„á€¹á€±á€™á€¬á€„á€¹á€±á€žá€¬á€„á€¹á€¸', '2018-09-23 11:13:42'),
(10, 'saisai@gmail.com', 1, 'á€±á€¡á€¸á€á€„á€¹', '2018-09-23 11:13:53'),
(11, 'koko@gmail.com', 2, 'Hello what are you doing now?', '2018-09-23 11:20:14'),
(12, 'saisai@gmail.com', 1, 'á€±á€™á€¬á€„á€¹á€±á€™á€¬á€„á€¹á€±á€žá€¬á€„á€¹á€¸', '2018-09-23 13:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `online` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `online`) VALUES
(1, 'á€…á€­á€¯á€„á€¹á€¸á€…á€¯á€­á€„á€¹á€¸', 'saisai@gmail.com', '$2y$10$D/u66f.pznX2agForZuPZeqWsUAc7dqIGF8uf/xhDj4.nHHRY6pW.', 1),
(2, 'á€€á€­á€¯á€€á€­á€¯á€±á€™á€¬á€„á€¹', 'koko@gmail.com', '$2y$10$jsiG25Ui0JlCfsOOG5PoX.Mr6x7tEG86yoiD56WsvJ1goq0EMAl4C', 0),
(3, 'á€±á€¡á€¬á€„á€¹á€±á€¡á€¬á€„á€¹', 'aung@gmail.com', '$2y$10$aoUpsyEG6Uoe5cArb1iLwOVvQX9hQG/bNxcbYb7sVfVorRChU6PTu', 0),
(4, 'á€±á€€á€¬á€„á€¹á€¸á€€á€„á€¹á€±á€™', 'kaung@gmail.com', '$2y$10$I/aWVF520sEi831Dj6eqD.1aY6JIzYN8rY7PfRb40WFHkzNKqE8qK', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocked`
--
ALTER TABLE `blocked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followed`
--
ALTER TABLE `followed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `blocked`
--
ALTER TABLE `blocked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `followed`
--
ALTER TABLE `followed`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
