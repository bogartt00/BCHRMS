-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2024 at 04:32 PM
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
-- Database: `bchrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `health_records`
--

CREATE TABLE `health_records` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `record_type` varchar(50) NOT NULL,
  `record_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_records`
--

INSERT INTO `health_records` (`id`, `student_id`, `record_type`, `record_date`) VALUES
(1, 3, 'Medical Examination', '2024-09-15'),
(2, 2, 'Dental Examination', '2024-09-04'),
(3, 1, 'Dental Examination', '2024-09-12'),
(4, 5, 'Medical Examination', '2024-09-08'),
(5, 1, 'Medical Examination', '2024-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `department`, `age`, `gender`, `deleted_at`) VALUES
(1, 'Malaya Chesedh', 'Morales', 'Information Technology', 21, 'Male', NULL),
(2, 'Kyle Angelou', 'Lamigo', 'Information Technology', 21, 'Male', NULL),
(3, 'Leah ', 'Arguelles', 'Information Technology', 21, 'Female', NULL),
(4, 'Beigemar Jielove', 'Pasa', 'Information Technology', 21, 'Female', NULL),
(5, 'Feane Nethanel', 'Sibal', 'Information Technology', 21, 'Female', NULL),
(6, 'Jane', 'Javier', 'Information Technology', 23, 'Female', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_health_records_view`
-- (See below for the actual view)
--
CREATE TABLE `student_health_records_view` (
`student_id` int(11)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`record_type` varchar(50)
,`record_date` date
,`record_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$ps.D9uD1aEcj1SUPiKy.DuczY5wPoOGCzw0D/Ar9PcwelHezBsY8e');

-- --------------------------------------------------------

--
-- Structure for view `student_health_records_view`
--
DROP TABLE IF EXISTS `student_health_records_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_health_records_view`  AS SELECT `s`.`id` AS `student_id`, `s`.`first_name` AS `first_name`, `s`.`last_name` AS `last_name`, `hr`.`record_type` AS `record_type`, `hr`.`record_date` AS `record_date`, `hr`.`id` AS `record_id` FROM (`students` `s` left join `health_records` `hr` on(`s`.`id` = `hr`.`student_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `health_records`
--
ALTER TABLE `health_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
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
-- AUTO_INCREMENT for table `health_records`
--
ALTER TABLE `health_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `health_records`
--
ALTER TABLE `health_records`
  ADD CONSTRAINT `health_records_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
