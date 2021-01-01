-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2021 at 02:12 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact_store_oop`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_contactoop`
--

CREATE TABLE `master_contactoop` (
  `contact_id` int(10) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `contact_email` varchar(50) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_contactoop`
--

INSERT INTO `master_contactoop` (`contact_id`, `contact_name`, `contact_number`, `contact_email`, `user_id`, `reg_date`) VALUES
(8, 'md santu sarker', '01766464051', 'santu@gmail.com', 15, '2021-01-01 06:01:30'),
(9, 'khadiza islam', '01755804842', 'khadiza@gmail.com', 15, '2021-01-01 05:56:54'),
(11, 'khadiza binta maznu', '01755804842', 'khadiza@gmail.com', 16, '2021-01-01 08:52:23'),
(12, 'md santu sarker', '01766464051', 'mdsantusarker@gmail.com', 16, '2021-01-01 10:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `master_useroop`
--

CREATE TABLE `master_useroop` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_number` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_useroop`
--

INSERT INTO `master_useroop` (`user_id`, `user_name`, `user_number`, `user_email`, `user_password`, `user_gender`, `reg_date`) VALUES
(14, 'khadiza islam', '01755804842', 'khadiza@gmail.com', '$2y$10$dHkGq8lGpR1x0Q7S23YNqeFUQNcYB3J47BTw39Bhh2yV2lBKbO42O', 'female', '2020-12-31 17:19:08'),
(15, 'pheonix', '2223', 'pheonix@gmail.com', '$2y$10$fuCaFpAmeVJq2ElLwZGdoeF5uLIO5cGPD/F0yQdlkNFi1J7LKtpgK', 'male', '2021-01-01 05:27:24'),
(16, 'Md Santu Sarker', '01766464051', 'mdsantusarker@gmail.com', '$2y$10$0Eic7bVOMy./FAD45w6M2.583SOPKK2cJb04J/dRDwxrsl4B57mAW', 'male', '2021-01-01 08:51:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_contactoop`
--
ALTER TABLE `master_contactoop`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `master_useroop`
--
ALTER TABLE `master_useroop`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_number` (`user_number`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_contactoop`
--
ALTER TABLE `master_contactoop`
  MODIFY `contact_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `master_useroop`
--
ALTER TABLE `master_useroop`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_contactoop`
--
ALTER TABLE `master_contactoop`
  ADD CONSTRAINT `master_contactoop_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `master_useroop` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
