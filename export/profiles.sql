-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2024 at 09:36 AM
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
  `birth_date` varchar(50) DEFAULT NULL,
  `contactnumber` varchar(20) DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `youth_classification` varchar(50) DEFAULT NULL,
  `age_group` varchar(50) DEFAULT NULL,
  `work_status` varchar(50) DEFAULT NULL,
  `educational_background` varchar(50) DEFAULT NULL,
  `register_sk_voter` varchar(50) DEFAULT NULL,
  `voted_last_election` varchar(3) NOT NULL,
  `attended_kk` varchar(3) NOT NULL,
  `times_attended_kk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `purok`, `sex`, `age`, `email`, `birth_date`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `register_sk_voter`, `voted_last_election`, `attended_kk`, `times_attended_kk`) VALUES
(4, 'rod', 'tang', 'pogs', 'QWE', 'CAR', 'MT prov', 'baguio', 'camp7 ', 'purok 3', 'Male', 24, 'zxc@gmail.com', '2000-05-12', '124124124212', 'Single', 'Out of School Youth', 'Core Youth', 'Unemployed', 'College Graduate', 'Not Registered', '', '', NULL),
(5, 'Pasio', 'Djay', 'M', 'PDM', 'na', 'na', 'na', 'na', 'na', 'Male', 21, 'asd@gmail.com', '2000-05-12', '0912308', 'Single', 'Person with Disability (PWD)', 'Core Youth', 'Unemployed', 'Master Level', 'Registered', '', '', NULL),
(7, 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'Male', 17, '214124@gmail', '2000-02-29', '124142', 'Widowed', 'Person with Disability (PWD)', 'Core Youth', 'Self-Employed', 'Master Graduate', 'Registered', '', '', NULL),
(8, 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'Male', 21, '124124@gmail', '2000-05-01', '51251245', 'Divorced', 'Working Youth', 'Young adult', 'Self-Employed', 'Master Graduate', 'Not Registered', '', '', NULL),
(9, 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'Male', 21, '125125@gma', '2000-05-01', '1235125125', 'Widowed', 'Person with Disability (PWD)', 'Young adult', 'Currently looking for job', 'Master Level', 'Registered', '', '', NULL),
(12, 'Gatarin', 'Rhoeder', 'Waking', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', 'Camp7', 'Male', 20, 'gtr@ph', '2004-05-09', '52151251', 'Single', 'In School Youth', 'Core Youth', 'Unemployed', 'College Level', 'Not Registered', 'No', 'No', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
