-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 06:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tintuc`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Technology'),
(2, 'Health'),
(3, 'Education'),
(4, 'Entertainment'),
(5, 'Sports'),
(6, 'Business'),
(7, 'Lifestyle'),
(8, 'Travel'),
(9, 'Science'),
(10, 'Politics');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `created_at`, `category_id`) VALUES
(2, 'Healthy Living Tips', 'Top 10 tips for a healthier life...', '2.jpg', NULL, 2),
(3, 'Education in 21st Century', 'How education has evolved...', '3.jpg', NULL, 3),
(4, 'Top Movies of 2024', 'Here are the top movies to watch...', '4.jpg', NULL, 4),
(5, 'Football Championship', 'Highlights from the championship...', '5.jpg', NULL, 5),
(6, 'Stock Market Today', 'An overview of today’s market...', '6.jpg', NULL, 6),
(7, 'Minimalist Lifestyle', 'How to live with less...', '7.jpg', NULL, 7),
(8, 'Top Destinations', 'Places to visit this year...', '8.jpg', NULL, 8),
(9, 'Space Exploration', 'Updates on Mars missions...', '1.jpg', NULL, 9),
(10, 'Election News', 'The latest updates on the election...', '2.jpg', NULL, 10),
(12, 'Nutrition Facts', 'Understanding what you eat...', '1.jpg', NULL, 2),
(13, 'Online Learning', 'Best platforms for online courses...', '2.jpg', NULL, 3),
(14, 'Music Awards 2024', 'Winners and highlights...', '3.jpg', NULL, 4),
(15, 'Olympics Highlights', 'Top moments from the Olympics...', '4.jpg', NULL, 5),
(16, 'Startup Stories', 'Successful startups of the year...', '5.jpg', NULL, 6),
(17, 'Mindfulness Practices', 'How to reduce stress daily...', '6.jpg', NULL, 7),
(18, 'Adventures in Asia', 'Traveling through Asia...', '7.jpg', NULL, 8),
(19, 'Quantum Computing', 'The future of quantum tech...', '8.jpg', NULL, 9),
(20, 'Debate Night', '', '1.jpg', NULL, 10),
(21, 'Blockchain Explained', 'Understanding cryptocurrency...', '2.jpg', NULL, 1),
(22, 'Mental Health', 'Recognizing the signs...', '3.jpg', NULL, 2),
(23, 'Classroom Technology', 'Gadgets in the modern classroom...', '4.jpg', NULL, 3),
(24, 'Celebrity News', 'Breaking news in entertainment...', '5.jpg', NULL, 4),
(25, 'Tennis Open', 'A recap of the grand slam...', '7.jpg', NULL, 5),
(26, 'Real Estate Market', 'Current trends in real estate...', '1.jpg', NULL, 6),
(27, 'Fitness Routines', 'Best exercises for a fit body...', '2.jpg', NULL, 7),
(28, 'European Escapades', 'Traveling across Europe...', '3.jpg', NULL, 8),
(29, 'Climate Change', 'How it impacts our planet...', '4.jpg', NULL, 9),
(30, 'Government Policies', 'Updates on new policies...', '5.jpg', NULL, 10),
(31, 'toàn ngu', 'toàn ngu', 'uploads/8.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 1),
(2, 'user1', 'password1', 0),
(3, 'user2', 'password2', 0),
(4, 'user3', 'password3', 0),
(5, 'user4', 'password4', 0),
(6, 'user5', 'password5', 0),
(7, 'user6', 'password6', 0),
(8, 'user7', 'password7', 0),
(9, 'user8', 'password8', 0),
(10, 'user9', 'password9', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
