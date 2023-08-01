-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2023 at 12:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farhan`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `feedback_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `feedback_text`, `created_at`) VALUES
(1, 1, 'good system ', '2023-07-07 04:01:49'),
(4, 1, 'perfect system for finding car parking near us', '2023-07-07 11:59:54'),
(5, 1, 'perfect system', '2023-07-07 12:09:37'),
(6, 3, 'Amazing work of art', '2023-07-08 13:55:14'),
(7, 3, 'wonderring how to do it', '2023-07-08 14:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `parking_spots`
--

CREATE TABLE `parking_spots` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `latitude` varchar(70) DEFAULT NULL,
  `longitude` varchar(70) DEFAULT NULL,
  `register_id` int(11) DEFAULT NULL,
  `price_per_hour` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking_spots`
--

INSERT INTO `parking_spots` (`id`, `name`, `latitude`, `longitude`, `register_id`, `price_per_hour`) VALUES
(3, 'All Saints Parking Lot', '-1.2877710306754948\r\n', '36.81344070351264', NULL, '200.00'),
(4, 'Holy Family Minor Basillica Car Park', '-1.2860848987638342', '36.820868530129815', NULL, '150.00'),
(5, 'Central Car Park', '-1.2854764676023587 ', '36.817756737326015', NULL, '210.00'),
(6, 'UoN PARKING LOT', '-1.2797523124404235', '36.815088192913976', NULL, '180.00'),
(7, 'Intercontinental Car Park', '-1.2873660428941698', '36.819270656560285', NULL, '240.00'),
(8, 'Greenspan Mall parking Lot', '-1.289111045702133', '36.901649192994284', NULL, '0.00'),
(10, 'Greenspan Mall parking Lot', '-1.289111045702133', '36.901649192994284', NULL, '120.00'),
(11, 'Kahawa Parking lot', '-1.1744275523245942', '36.91463569829801', NULL, '30.00');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `firstname`, `lastname`, `fullname`, `email`, `gender`, `password`, `confirmpassword`) VALUES
(1, 'farhan', 'abdi', 'farhan abdi', 'farhanabdi@gmail.com', 'Male', '123456', '123456'),
(3, 'moha', 'adan', 'moha adan', 'adanmoha@gmail.com', 'Male', '1234567', '1234567'),
(9, 'deq', 'hassan', 'deq hassan', 'deqhassan@gmail.com', 'Male', '123456', '123456');

--
-- Triggers `register`
--
DELIMITER $$
CREATE TRIGGER `fullname_trigger` BEFORE INSERT ON `register` FOR EACH ROW BEGIN
    SET NEW.fullname = CONCAT(NEW.firstname, ' ', NEW.lastname);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `parking_spots`
--
ALTER TABLE `parking_spots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_register_id` (`register_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `parking_spots`
--
ALTER TABLE `parking_spots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register` (`id`);

--
-- Constraints for table `parking_spots`
--
ALTER TABLE `parking_spots`
  ADD CONSTRAINT `fk_register_id` FOREIGN KEY (`register_id`) REFERENCES `register` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
