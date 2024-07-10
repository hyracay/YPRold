-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2024 at 08:22 PM
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
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `role` enum('admin','employee') NOT NULL DEFAULT 'employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `FirstName`, `LastName`, `role`) VALUES
(12, 'administrator@ph', '12e6d7a3698aa5679898da6a447a4afc', 'Admin', 'PH', 'admin'),
(13, 'user1@ph', 'ee11cbb19052e40b07aac0ca060c23ee', 'user1', 'Ph', 'employee'),
(14, 'adminv2@ph', '3d0ea76141ee0facc4d19e3de51b5777', 'admin', 'v2', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `delete_profile`
--

CREATE TABLE `delete_profile` (
  `id` int(11) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `suffix` varchar(20) NOT NULL,
  `region` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `purok` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birth_month` varchar(20) NOT NULL,
  `birth_day` varchar(20) NOT NULL,
  `birth_year` varchar(20) NOT NULL,
  `contactnumber` varchar(20) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `youth_classification` varchar(100) NOT NULL,
  `age_group` varchar(50) NOT NULL,
  `work_status` varchar(50) NOT NULL,
  `educational_background` varchar(50) NOT NULL,
  `register_sk_voter` varchar(50) NOT NULL,
  `voted_last_election` varchar(3) NOT NULL,
  `attended_kk` varchar(3) NOT NULL,
  `times_attended_kk` int(11) NOT NULL,
  `date_created` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delete_profile`
--

INSERT INTO `delete_profile` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `purok`, `sex`, `age`, `email`, `birth_month`, `birth_day`, `birth_year`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `register_sk_voter`, `voted_last_election`, `attended_kk`, `times_attended_kk`, `date_created`) VALUES
(8, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(9, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 0, 'sad@asda', '2', '16', '1993', '123', 'Married', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, ''),
(10, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(11, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 0, 'sad@asda', '2', '16', '1993', '123', 'Married', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, ''),
(12, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(13, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 0, 'sad@asda', '2', '16', '1993', '123', 'Married', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, ''),
(14, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(15, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(16, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(17, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(18, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(19, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(20, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(21, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 0, 'sad@asda', '2', '16', '1993', '123', 'Married', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, ''),
(22, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(23, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 0, 'sad@asda', '2', '16', '1993', '123', 'Married', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, ''),
(24, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(25, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 0, 'sad@asda', '2', '16', '1993', '123', 'Married', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, ''),
(26, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(27, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(28, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(29, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 0, 'sad@asda', '2', '16', '1993', '123', 'Married', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, ''),
(30, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(31, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 0, 'sad@asda', '2', '16', '1993', '123', 'Married', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, ''),
(32, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(33, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 0, 'sad@asda', '2', '16', '1993', '123', 'Married', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, ''),
(34, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(35, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 0, 'sad@asda', '2', '16', '1993', '123', 'Married', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, ''),
(36, 'hasjkdfhkj', 'shdjk', 'asdh', '', '', '', '', '', '', '', 0, 'asda@asdha', '2', '27', '1993', '', '', '', '', '', '', '', '', '', 0, ''),
(37, 'sample', 'sample', 'sample', '', '', '', '', '', '', '', 0, 'sad@asda', '2', '16', '1993', '', '', '', '', '', '', '', '', '', 0, ''),
(38, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 0, 'asda@asdha', '2', '27', '1993', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, ''),
(39, 'sample', 'sample', 'sample', '', '', '', '', '', '', '', 0, 'sad@asda', '2', '16', '1993', '', '', '', '', '', '', '', '', '', 0, ''),
(40, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 0, 'sad@asda', '2', '16', '1993', '123', 'Married', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(50) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `birth_month` varchar(20) DEFAULT NULL,
  `birth_day` varchar(20) DEFAULT NULL,
  `birth_year` varchar(20) DEFAULT NULL,
  `contactnumber` varchar(20) DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `youth_classification` varchar(100) DEFAULT NULL,
  `age_group` varchar(50) DEFAULT NULL,
  `work_status` varchar(50) DEFAULT NULL,
  `educational_background` varchar(50) DEFAULT NULL,
  `register_sk_voter` varchar(50) DEFAULT NULL,
  `voted_last_election` varchar(3) NOT NULL,
  `attended_kk` varchar(3) NOT NULL,
  `times_attended_kk` int(11) DEFAULT NULL,
  `date_created` varchar(50) NOT NULL,
  `barangay_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `purok`, `sex`, `age`, `email`, `birth_month`, `birth_day`, `birth_year`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `register_sk_voter`, `voted_last_election`, `attended_kk`, `times_attended_kk`, `date_created`, `barangay_code`) VALUES
(27, 'amsd', 'asd', 'asd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 27, 'asd@asd', '2', '18', '1997', '123123', 'Married', 'In Youth School', 'Young Adult', 'Employed', 'High School Level', 'Not Registered', 'No', 'No', 0, '07/10/24', ''),
(28, 'Pacio ', 'Dee Jay', 'Toribio', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '23', 'Male', 20, 'asd@asd', '5', '9', '2004', '1231', 'Single', 'Out Of School Youth', 'Core Youth', 'Currently looking for job', 'College Level', 'Registered', 'No', 'No', 0, '07/10/24', ''),
(30, 'amsd', 'asd', 'asd', NULL, 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', NULL, 'asd@asd', '2', '18', '1993', '123123', 'Married', 'In Youth School', 'Young Adult', 'Employed', 'High School Level', 'Not Registered', 'No', 'No', 0, '', NULL),
(49, 'hasjkdfhkj', 'shdjk', 'asdh', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 24, 'asda@asdha', '2', '27', '2000', '123123', 'Married', 'In Youth School', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, '', NULL),
(93, 'Ashley', 'Stephanie', 'Jeremy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '5', 'Male', 25, 'slee@yahoo.com', '6', '19', '1999', '-5901', 'Married', 'In Youth School', 'Young Adult', 'Unemployed', 'Doctorate Level', 'Registered', 'Yes', 'No', 0, '03/14/24', NULL),
(130, 'Moore', 'Willie', 'William', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '10', 'Male', 30, 'hatdog@gmail.com', '8', '2', '1994', '001-848-456-0386x550', 'Single', 'In Youth School', 'Young Adult', 'Currently looking for job', 'Master Graduate', 'Registered', 'No', 'No', 0, '05/03/2024', NULL),
(150, 'Taylor', 'Swift', 'Angelica', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '5', 'Male', 30, 'abrooks@hotmail.com', '11', '12', '1994', '(903)449-3825x659', 'Married', 'Out of School Youth', 'Young Adult', 'Currently looking for job', 'Elementary Level', 'Not Registered', 'Yes', 'No', 0, '05/07/2024', NULL),
(151, 'Johnson', 'Alejandro', 'Charlotte', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '8', 'Female', 29, 'christopher72@anderson.com', '1', '2', '1995', '001-357-617-1677x661', 'Married', 'Working Youth', 'Young Adult', 'Unemployed', 'Master Level', 'Not Registered', 'Yes', 'No', 0, '05/27/24', NULL),
(152, 'Ramirez', 'Patricia', 'Brandon', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '8', 'Male', 30, 'tracy74@gmail.com', '1', '2', '1994', '997.652.6140x893', 'Divorced', 'In School Youth', 'Young Adult', 'Unemployed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, '01/31/24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profiles_archive`
--

CREATE TABLE `profiles_archive` (
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
  `birth_month` varchar(20) DEFAULT NULL,
  `birth_day` varchar(20) DEFAULT NULL,
  `birth_year` varchar(20) DEFAULT NULL,
  `contactnumber` varchar(20) DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `youth_classification` varchar(100) DEFAULT NULL,
  `age_group` varchar(50) DEFAULT NULL,
  `work_status` varchar(50) DEFAULT NULL,
  `educational_background` varchar(50) DEFAULT NULL,
  `register_sk_voter` varchar(50) DEFAULT NULL,
  `voted_last_election` varchar(3) NOT NULL,
  `attended_kk` varchar(3) NOT NULL,
  `times_attended_kk` int(11) DEFAULT NULL,
  `date_created` varchar(50) NOT NULL,
  `barangay_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles_archive`
--

INSERT INTO `profiles_archive` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `purok`, `sex`, `age`, `email`, `birth_month`, `birth_day`, `birth_year`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `register_sk_voter`, `voted_last_election`, `attended_kk`, `times_attended_kk`, `date_created`, `barangay_code`) VALUES
(48, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 31, 'sad@asda', '2', '16', '1993', '123', 'Married', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 'No', 0, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profiles_backup`
--

CREATE TABLE `profiles_backup` (
  `id` int(11) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `suffix` varchar(20) NOT NULL,
  `region` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `purok` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birth_month` varchar(50) NOT NULL,
  `birth_day` varchar(50) NOT NULL,
  `birth_year` varchar(50) NOT NULL,
  `contactnumber` varchar(20) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `youth_classification` varchar(50) NOT NULL,
  `age_group` varchar(50) NOT NULL,
  `work_status` varchar(50) NOT NULL,
  `educational_background` varchar(50) NOT NULL,
  `register_sk_voter` varchar(50) NOT NULL,
  `voted_last_election` varchar(3) NOT NULL,
  `attended_kk` varchar(3) NOT NULL,
  `times_attended_kk` int(11) NOT NULL,
  `date_created` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles_backup`
--

INSERT INTO `profiles_backup` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `purok`, `sex`, `age`, `email`, `birth_month`, `birth_day`, `birth_year`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `register_sk_voter`, `voted_last_election`, `attended_kk`, `times_attended_kk`, `date_created`) VALUES
(6, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Male', 24, 'asd@aesdf', '5', '18', '2000', '1231', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'College Level', 'No', 'No', 'No', 0, '07/10/24'),
(7, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 24, 'sad@asda', '2', '16', '2000', '123', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'No', 'No', 'No', 0, '07/10/24'),
(8, 'amsd', 'asd', 'asd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '123', 'Male', 34, 'asd@asd', '2', '18', '1990', '123123', 'Married', 'Out Of School Youth', '', 'Employed', 'High School Level', 'No', 'No', 'No', 0, '07/10/24'),
(9, 'Pacio ', 'Dee Jay', 'Toribio', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '23', 'Male', 20, 'asd@asd', '5', '9', '2004', '1231', 'Single', 'Out Of School Youth', 'Core Youth', 'Currently looking for job', 'College Level', 'Yes', 'No', 'No', 0, '07/10/24'),
(10, 'hasjkdfhkj', 'shdjk', 'asdh', 'asdhjk', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 24, 'asda@asdha', '2', '27', '2000', '123123', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 'Yes', 1, '07/10/24'),
(11, 'dale ', 'matthew', 'boquiren', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 31, 'asd@asd', '2', '2', '1993', '12333', 'Single', 'In School Youth', 'Young Adult', 'Student', 'Elementary Level', 'Registered', 'Yes', 'Yes', 1, '07/10/24'),
(12, 'Boquiren', 'Dale Matthew', 'Ramirez', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 31, 'asd@123', '1', '2', '1993', '1233331', 'Married', 'In School Youth', 'Young Adult', 'Student', 'College Level', 'Registered', 'Yes', 'Yes', 1, '07/10/24'),
(13, 'Boquiren', 'Dale Matthew', 'Ramirez', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 31, 'asd@123', '2', '2', '1993', '123123123', 'Married', 'In School Youth', '', 'Student', 'High School Level', 'Registered', 'Yes', 'No', 0, '07/10/24'),
(14, 'Boquiren', 'Dale Matthew', 'Ramirez', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 31, 'asd@123', '2', '2', '1993', '123123123', 'Married', 'In School Youth', '', 'Student', 'High School Level', 'Registered', 'Yes', 'No', 0, '07/10/24'),
(15, 'Cayambas', 'Hyra', 'S', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '2', 'Female', 31, 'das@321', '2', '3', '1993', '1233444', 'Single', 'In School Youth', 'Core Youth', 'Employed', 'Elementary Graduate', 'Registered', 'Yes', 'No', 0, '07/10/24'),
(16, 'Cayambas', 'Hyra', 'S', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Female', 31, 'ads@321', '2', '3', '1993', '213124', 'Married', 'In School Youth', 'Core Youth', 'Student', 'College Level', 'Registered', 'Yes', 'No', 0, '07/10/24'),
(17, 'asd', 'asdasda', 'asdasd', 'sdasda', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 31, 'asda@asdasd', '3', '8', '1993', '12312312', 'Married', 'Out Of School Youth', 'Child Youth', 'Student', 'High School Level', 'Registered', 'Yes', 'No', 0, '07/10/24'),
(18, 'dsada', 'asdasda', 'sdasdasd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 31, 'asdada@aaa', '3', '3', '1993', '12315125', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'College Graduate', 'Registered', 'Yes', 'No', 0, '07/10/24'),
(19, '123123', '1231', '123123', '2312312', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 27, '123@55', '3', '5', '1997', '222', 'Married', 'Out Of School Youth', 'Young Adult', 'Unemployed', 'High School Graduate', 'Registered', 'Yes', 'Yes', 0, '07/10/24'),
(20, '123123', '1231', '123123', '2312312', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 27, '123@55', '3', '5', '1997', '222', 'Married', 'Out Of School Youth', 'Young Adult', 'Unemployed', 'High School Graduate', 'Registered', 'Yes', 'Yes', 0, '07/10/24'),
(21, '123123', '1231', '123123', '2312312', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 27, '123@55', '3', '5', '1997', '222', 'Married', 'Out Of School Youth', 'Young Adult', 'Unemployed', 'High School Graduate', 'Registered', 'Yes', 'Yes', 0, '07/10/24'),
(22, 'asdasda', 'fasfas', 'fasfa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 27, 'asdasd@hhh', '6', '6', '1997', '123123', 'Single', 'Out Of School Youth', 'Young Adult', 'Employed', 'High School Graduate', 'Registered', 'Yes', 'Yes', 2, '07/10/24'),
(23, 'asdasda', 'fasfas', 'fasfa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 27, 'asdasd@hhh', '6', '6', '1997', '123123', 'Single', 'Out Of School Youth', 'Young Adult', 'Employed', 'High School Graduate', 'Registered', 'Yes', 'Yes', 2, '07/10/24'),
(24, 'asdasda', 'fasfas', 'fasfa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 27, 'asdasd@hhh', '6', '6', '1997', '123123', 'Single', 'Out Of School Youth', 'Young Adult', 'Employed', 'High School Graduate', 'Registered', 'Yes', 'Yes', 2, '07/10/24'),
(25, 'asdasda', 'fasfas', 'fasfa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 27, 'asdasd@hhh', '6', '6', '1997', '123123', 'Single', 'Out Of School Youth', 'Young Adult', 'Employed', 'High School Graduate', 'Registered', 'Yes', 'Yes', 2, '07/10/24'),
(26, 'asdasd', 'asdasd', 'asdasd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 27, 'sdla@galsg', '7', '8', '1997', '12312', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', 'No', 0, '07/10/24'),
(27, 'asdasd', 'asdasd', 'asdasd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 27, 'sdla@galsg', '7', '8', '1997', '12312', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', 'No', 0, '07/10/24'),
(28, 'asdasd', 'asdasd', 'asdasd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 27, 'sdla@galsg', '7', '8', '1997', '12312', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', 'No', 0, '07/10/24'),
(29, 'asdasd', 'asdasd', 'asdasd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 27, 'sdla@galsg', '7', '8', '1997', '12312', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', 'No', 0, '07/10/24'),
(30, 'asdasd', 'asdasd', 'asdasd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '1', 'Male', 27, 'sdla@galsg', '7', '8', '1997', '12312', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', 'No', 0, '07/10/24');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delete_profile`
--
ALTER TABLE `delete_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles_archive`
--
ALTER TABLE `profiles_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles_backup`
--
ALTER TABLE `profiles_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delete_profile`
--
ALTER TABLE `delete_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `profiles_archive`
--
ALTER TABLE `profiles_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `profiles_backup`
--
ALTER TABLE `profiles_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
