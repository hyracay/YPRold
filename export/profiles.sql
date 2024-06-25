-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 11:36 AM
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
-- Database: `wis`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `mname` varchar(100) DEFAULT NULL,
  `suffix` varchar(20) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `purok` varchar(100) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `contactnumber` varchar(20) DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `youth_classification` varchar(50) DEFAULT NULL,
  `age_group` varchar(50) DEFAULT NULL,
  `work_status` varchar(50) DEFAULT NULL,
  `educational_backround` varchar(50) DEFAULT NULL,
  `register_sk_voter` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `purok`, `sex`, `age`, `email`, `birth_date`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_backround`, `register_sk_voter`) VALUES
(1, 'Boquiren', 'Dale Matthew', 'Ramirez', 'hatdog', 'CAR', 'Benguet', 'La Trinidad', 'Wangal', '2601', 'Male', 20, 'dalematthewramirez@gmail.com', '0000-00-00', '09995288075', 'Single', 'InYouthSchool', 'core', 'unemployed', 'collegelevel', 'nov'),
(2, 'Boquiren', 'Dale Matthew', 'Ramirez', 'hatdog', 'CAR', 'Benguet', 'La Trinidad', 'Wangal', '2601', 'Male', 20, 'dalematthewramirez@gmail.com', '0000-00-00', '09995288075', 'Single', 'InYouthSchool', 'core', 'unemployed', 'collegelevel', 'nov'),
(3, 'b', 'Dale Matthew', 'Ramirez', 'hatdog', '', 'Benguet', 'La Trinidad', 'Wangal', '2601', 'Male', 20, 'dalematthewramirez@gmail.com', '2004-03-30', '09995288075', 'Single', 'InYouthSchool', 'core', 'unemployed', 'collegelevel', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
