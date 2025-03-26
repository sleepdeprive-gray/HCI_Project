-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2025 at 04:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bk_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('book.room@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` enum('Science','Novel','Mystery','Narrative','Fiction','History','Fantasy') DEFAULT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `front_cover` varchar(255) DEFAULT NULL,
  `back_cover` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `downloads` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `editor_id`, `title`, `author`, `genre`, `description`, `file_path`, `front_cover`, `back_cover`, `upload_date`, `status`, `downloads`) VALUES
(1, 7, 'Les Estremondes', 'Ravena Guron', 'Novel', 'The Escapers Books is a digital platform centered around the Alien Investors series, offering fans immersive reading experience. It features personalized book recommendations, interactive content, and secrueaccess uisng face recognition, voice commands, and fingerprint autentication.\r\n\r\nThe platform allowss users to explore the Alien invstors universe, track their reading progress and enggae with other fans in discussions. Specialized platform dedicated to the Alien Investors series, providing readers with a seamless, interactive experience. With advanced features like face recognition, voice commands, and fingerprint access, users can securely dive into the world of AlienInvestors, follow storylines, and connect with a community of fellow fans.', '', '', '', '2025-03-26 14:06:46', 'Approved', 10),
(2, 7, 'Sample Book', 'Ivan Duran', 'Science', 'Sample Description Sample Description Sample Description Sample Description Sample Description Sample Description Sample Description Sample Description Sample Description Sample Description Sample Description Sample Description Sample Description Sample Description ', '', NULL, '', '2025-03-26 15:04:10', 'Pending', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_type` enum('Editor','Member') DEFAULT 'Member',
  `email` varchar(150) NOT NULL,
  `password` varchar(300) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Man','Woman','Gay','Bisexual','Others','Lesbian') DEFAULT NULL,
  `location` varchar(50) NOT NULL,
  `security_question` varchar(200) DEFAULT NULL,
  `sq_answer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `email`, `password`, `first_name`, `last_name`, `birthdate`, `gender`, `location`, `security_question`, `sq_answer`) VALUES
(1, 'Editor', 'gray@example.com', '$2y$10$JfUXihWdhrU3Yi47QK4WlOLTRFyUfNx01rtOhoEgkAuGKguL5xfiu', 'Gray', 'White', '2015-01-05', 'Man', 'Metro Manila', '', ''),
(7, 'Editor', 'sample@email.com', '$2y$10$fQPKjSaD/VcIr8Te0FF9.ezP8Vv.ZBNViMBiOWmw95fsRSrLZUYK2', 'Ivan', 'Duran', '2004-06-13', 'Woman', 'Northern Luzon', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `editor_id` (`editor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`editor_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
