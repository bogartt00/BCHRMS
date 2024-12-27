-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2024 at 04:22 AM
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
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `record_type` varchar(50) NOT NULL,
  `record_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_examinations`
--

CREATE TABLE `laboratory_examinations` (
  `examination_id` int(11) NOT NULL,
  `symptoms` text NOT NULL,
  `diagnosis` text NOT NULL,
  `prescription` text DEFAULT NULL,
  `cbc` varchar(255) DEFAULT NULL,
  `urinalysis` varchar(255) DEFAULT NULL,
  `fecalysis` varchar(255) DEFAULT NULL,
  `chest_xray` varchar(255) DEFAULT NULL,
  `hepa_b_antigen` varchar(255) DEFAULT NULL,
  `hepa_b_antibody` varchar(255) DEFAULT NULL,
  `occult_blood` varchar(255) DEFAULT NULL,
  `psa` varchar(255) DEFAULT NULL,
  `mammo` varchar(255) DEFAULT NULL,
  `pap_test` varchar(255) DEFAULT NULL,
  `fbs` varchar(255) DEFAULT NULL,
  `creatinine` varchar(255) DEFAULT NULL,
  `uric_acid` varchar(255) DEFAULT NULL,
  `non_fasting_cholesterol` varchar(255) DEFAULT NULL,
  `ecg` varchar(255) DEFAULT NULL,
  `record_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `physical_examinations`
--

CREATE TABLE `physical_examinations` (
  `examination_id` int(11) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `blood_pressure` varchar(10) NOT NULL,
  `pulse_rate` int(11) NOT NULL,
  `temperature` decimal(4,2) NOT NULL,
  `skin` text NOT NULL,
  `head` text NOT NULL,
  `eyes_visual_acuity` text NOT NULL,
  `ears_hearing_test` text NOT NULL,
  `nose` text NOT NULL,
  `throat` text NOT NULL,
  `mouth_tongue` text NOT NULL,
  `teeth_gums` text NOT NULL,
  `neck` text NOT NULL,
  `chest_lungs` text NOT NULL,
  `breasts` text DEFAULT NULL,
  `heart` text NOT NULL,
  `abdomen` text NOT NULL,
  `testicular_exam` text DEFAULT NULL,
  `rectal_exam` text DEFAULT NULL,
  `extremities` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(6, 'Jane', 'Javier', 'Information Technology', 23, 'Female', '2024-10-04 23:00:33'),
(7, 'Barbie Camille', 'Yap', 'Nursing', 23, 'Female', NULL),
(8, 'Ayumi Kharel', 'Lamigo', 'Medical Technology', 19, 'Female', NULL),
(9, 'Raine', 'Arellano', 'Pharmacy', 23, 'Female', NULL),
(10, 'Christian Lloyd', 'Poblador', 'Business Administration', 24, 'Male', NULL),
(11, 'Jean', 'Urboda', 'Education', 21, 'Female', NULL),
(12, 'Bryan', 'Alcala', 'Psychology', 21, 'Male', NULL),
(13, 'Barbie Abegail Kate', 'Wade', 'Theology', 20, 'Female', NULL);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `laboratory_examinations`
--
ALTER TABLE `laboratory_examinations`
  ADD PRIMARY KEY (`examination_id`);

--
-- Indexes for table `physical_examinations`
--
ALTER TABLE `physical_examinations`
  ADD PRIMARY KEY (`examination_id`);

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
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `examinations`
--
ALTER TABLE `examinations`
  ADD CONSTRAINT `examinations_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `laboratory_examinations`
--
ALTER TABLE `laboratory_examinations`
  ADD CONSTRAINT `laboratory_examinations_ibfk_1` FOREIGN KEY (`examination_id`) REFERENCES `examinations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `physical_examinations`
--
ALTER TABLE `physical_examinations`
  ADD CONSTRAINT `physical_examinations_ibfk_1` FOREIGN KEY (`examination_id`) REFERENCES `examinations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
