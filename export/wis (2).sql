-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 02:23 PM
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
  `password` varchar(255) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `role` enum('superadmin','admin','user') NOT NULL DEFAULT 'user',
  `code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `FirstName`, `LastName`, `role`, `code`) VALUES
(14, 'SAdmin@ph', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Rhoeder', 'Gatarin', 'superadmin', NULL),
(20, 'adminS@ph', '$2y$10$Q/AorUi1jMY4rHF4FRjFnuxibriwAlASkJ9S2NH3pys7liQWZF2vS', 'RhoederFS', 'Gatarin', 'superadmin', NULL),
(21, 'v1admin@ph', '$2y$10$KjLTEBip26lDN2x/R01IUOwSeo9/fth4BhwxDNnBfYXC0zKXRzEP2', 'Djay', 'Pasio', 'admin', NULL),
(24, 'alapang@ph', '$2y$10$EDhZbWSld.16eQZTfJX9LeFSckpntjIPpy0V/BLVOwQs4T3DfAm7i', 'user', 'ph', 'user', '3'),
(26, 'alno@ph', '$2y$10$l/7t/kpedsLV4yla7e.Ciu.sy/XRQlZkJrWWQKWEEfmqFAPtUz0qy', 'user', 'ph', 'user', '4'),
(27, 'ambiong@ph', '$2y$10$S2PLSyzkWRYG1BHbmROzj.MwUdbErEubj8s5TER./mvvBQM2.Kyny', 'user', 'ph', 'user', '5'),
(28, 'bahong@ph', '$2y$10$7hhVwvsX6MJkG7tfN4QOeOzb.odKHuuUr8lBZQ/kV/X98Wn97UvZa', 'user', 'ph', 'user', '6'),
(29, 'balili@ph', '$2y$10$r4.6jrZfsB34cuwIQJcLoe8LwQJa5uDKNGx9SbAz0qr4kyfB0zs.S', 'user', 'ph', 'user', '7'),
(30, 'beckel@ph', '$2y$10$LvA23Imj/F2zxf1ELvRIdOwq17NjBpS9K5zDhsY4d8cod4LudPVCe', 'user6', 'ph', 'user', '8'),
(31, 'betag@ph', '$2y$10$/7ucuWn1weGDCi5UZITu3uttIR1t45iKxoyMYeEzot0onvWpbha9K', 'user7', 'ph', 'user', '9'),
(32, 'bineng@ph', '$2y$10$gyTdmh5FhYIOUkPhLJEfBesmS4qvKjHN8UcY5.OfbYsYjRVwqTX4u', 'user8', 'ph', 'user', '10'),
(33, 'cruz@ph', '$2y$10$VfRjubG9x6dcT9WmxYjX5uZjIbB7wvLm1EZIsGK9mSpWQHOr/x3cK', 'Rhoder', 'Gats', 'admin', '11'),
(34, 'lubas@ph', '$2y$10$MZN/vwJrjdORMT7BtQqIce68Qc67dWhrdltrI9QuhFU/4nOIfuYvC', 'a1', 'a1', 'user', '12'),
(35, 'pico@ph', '$2y$10$FFuS4L5vOF.UiUo/J.Z32OOL/x0lS.bvBujXzJM/or3a3HF2oA6k6', 'a2', 'a2', 'user', '13'),
(36, 'poblacion@ph', '$2y$10$wZuQQwjOUPnn9v37tha3luxifPZtTlN4ACkq9COJZMd.KohcI7SEm', 'a3', 'a3', 'user', '14'),
(37, 'puguis@ph', '$2y$10$Ka0LEb1HmLFz8m0YLwKb9uYyAgQJa/VHby2hURwjBV4dE970B/j1C', 'a4', 'a4', 'user', '15'),
(38, 'shilan@ph', '$2y$10$GslEiF36xsNDlTrgbA/HYe9G.KNuMi7b4RhXU1wbD.u9SfNLi81vu', 'a5', 'a5', 'user', '16'),
(39, 'tawang@ph', '$2y$10$WmtTwK3sII8nJCLNV2N.D.ZamIQKwYl/7cmusMILhd81c9n3cQBdm', 'a6', 'a6', 'user', '17'),
(40, 'wangal@ph', '$2y$10$mpd8ZsfrAG0IHjUu72XQAe6hCcTlaNQg7bwehpSSanjbtwqsxbpGq', 'b1', 'b1', 'user', '18');

-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

CREATE TABLE `barangay` (
  `ID` int(11) NOT NULL,
  `Brngy` varchar(50) NOT NULL,
  `Code` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`ID`, `Brngy`, `Code`) VALUES
(1, 'Alapang', '3'),
(2, 'Alno', '4'),
(3, 'Ambiong', '5'),
(4, 'Bahong', '6'),
(5, 'Balili', '7'),
(6, 'Beckel', '8'),
(7, 'Betag', '9'),
(8, 'Bineng', '10'),
(9, 'Cruz', '11'),
(10, 'Lubas', '12'),
(11, 'Pico', '13'),
(12, 'Poblacion', '14'),
(13, 'Puguis', '15'),
(14, 'Shilan', '16'),
(15, 'Tawang', '17'),
(16, 'Wangal', '18');

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
(153, 'Johnson', 'Alejandro', 'Charlotte', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '8', 'Female', 34, 'christopher72@anderson.com', '1', '2', '1990', '9993381872', 'Married', 'SK Official', 'Young Adult', 'Unemployed', 'Elementary', '', 'Yes', '', 0, '05/27/24');

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
  `sitio` varchar(50) DEFAULT NULL,
  `purok` varchar(100) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `youth_with_needs` text DEFAULT NULL,
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
  `national_voter` varchar(50) DEFAULT NULL,
  `attended_kk` varchar(3) NOT NULL,
  `times_attended_kk` int(11) DEFAULT NULL,
  `no_why` varchar(100) DEFAULT NULL,
  `date_created` varchar(50) NOT NULL,
  `barangay_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `sitio`, `purok`, `sex`, `age`, `youth_with_needs`, `email`, `birth_month`, `birth_day`, `birth_year`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `register_sk_voter`, `voted_last_election`, `national_voter`, `attended_kk`, `times_attended_kk`, `no_why`, `date_created`, `barangay_code`) VALUES
(27, 'amsd', 'asd', 'asd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '123', 'Male', 27, NULL, 'asd@asd', '2', '18', '1997', '123123', 'Married', 'In Youth School', 'Young Adult', 'Employed', 'High School Level', 'Not Registered', 'No', NULL, 'No', 0, NULL, '07/10/24', '18'),
(28, 'Pacio ', 'Dee Jay', 'Toribio', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '23', 'Male', 20, NULL, 'asd@asd', '5', '9', '2004', '1231', 'Single', 'Out Of School Youth', 'Core Youth', 'Currently looking for job', 'College Level', 'Registered', 'No', NULL, 'No', 0, NULL, '07/10/24', '18'),
(30, 'amsd', 'asd', 'asd', NULL, 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '123', 'Male', NULL, NULL, 'asd@asd', '2', '18', '1993', '123123', 'Married', 'In Youth School', 'Young Adult', 'Employed', 'High School Level', 'Not Registered', 'No', NULL, 'No', 0, NULL, '', '5'),
(154, 'Ramirez', 'Patricia', 'Brandon', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', 'Male', 24, 'asd', 'tracy74@gmail.com', '1', '2', '2000', '997', 'Divorced', 'SK Official', 'Core Youth', 'Unemployed', 'Elementary', NULL, '', 'No', '', 0, '', '01/31/24', '5'),
(161, 'Taylor', 'Swift', 'Angelica', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', 'Male', 18, NULL, 'abrooks@hotmail.com', '11', '12', '2005', '0', 'Married', 'SK Official', 'Core Youth', 'Employed', 'Elementary', NULL, 'Yes', NULL, '', 0, NULL, '05/07/2024', '5'),
(162, 'Moore', 'Willie', 'William', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '10', 'Male', 30, NULL, 'hatdog@gmail.com', '8', '2', '1994', '001-848-456-0386x550', 'Single', 'In Youth School', 'Young Adult', 'Currently looking for job', 'Master Graduate', 'Registered', 'No', NULL, 'No', 0, NULL, '05/03/2024', NULL),
(163, 'Ashley', 'Stephanie', 'Jeremy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '5', 'Male', 25, NULL, 'slee@yahoo.com', '6', '19', '1999', '-5901', 'Married', 'In Youth School', 'Young Adult', 'Unemployed', 'Doctorate Level', 'Registered', 'Yes', NULL, 'No', 0, NULL, '03/14/24', NULL),
(164, 'x', 'x', 'x', '123', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', 'Female', 24, 'asd', 'asda@asdha', '2', '27', '2000', '123123', 'Married', 'SK Official', 'Core Youth', 'Employed', 'Elementary', NULL, 'Yes', 'Yes', 'Yes', 1, 'd', '', NULL),
(166, 'Williams', 'James', 'Carla', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 18, NULL, 'john80@hotmail.com', '1', '10', '2006', '+1-124-538-3865x5254', 'Divorced', 'Working Youth', 'Core Youth', 'Self-Employed', 'Doctorate Level', 'Not Registered', 'No', NULL, 'No', 0, NULL, '02/09/2024', NULL),
(167, 'Jones', 'Margaret', 'Robert', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '3', 'Male', 28, NULL, 'victoria82@brown.com', '12', '14', '1996', '(156)428-4910x043', 'Divorced', 'In School Youth', 'Young Adult', 'Currently looking for job', 'Vocational Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '03/13/24', NULL),
(168, 'Kim', 'Katie', 'Yolanda', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '7', 'Male', 25, NULL, 'mooreleslie@schmitt-jimenez.biz', '9', '24', '1999', '423-227-9171x50653', 'Single', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'High School Level', 'Registered', 'Yes', NULL, 'No', 0, NULL, '04/19/24', NULL),
(169, 'Henderson', 'Johnathan', 'Charlene', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '3', 'Male', 23, NULL, 'rebeccabernard@ramirez.com', '4', '3', '2001', '396-800-7727x9648', 'Single', 'Working Youth', 'Core Youth', 'Employed', 'Vocational Graduate', 'Not Registered', 'No', NULL, 'No', 0, NULL, '06/14/24', NULL),
(170, 'Perez', 'Ricardo', 'Michael', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '9', 'Male', 21, NULL, 'higginseugene@bautista-jones.net', '12', '20', '2003', '(234)602-5521x659', 'Single', 'Person With Disability (PWD)', 'Core Youth', 'Unemployed', 'Elementary Graduate', 'Registered', 'No', NULL, 'Yes', 2, NULL, '01/11/2024', NULL),
(171, 'Holder', 'Eric', 'Joanna', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '9', 'Male', 22, NULL, 'vterry@jones.com', '1', '24', '2002', '001-504-632-5612x996', 'Single', 'Person With Disability (PWD)', 'Core Youth', 'Student', 'College Graduate', 'Registered', 'No', NULL, 'Yes', 5, NULL, '02/27/24', NULL),
(172, 'Marshall', 'Gary', 'Martin', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Female', 19, NULL, 'carpenterjoseph@yahoo.com', '10', '18', '2005', '233.586.8603', 'Single', 'Person With Disability (PWD)', 'Core Youth', 'Employed', 'College Graduate', 'Registered', 'No', NULL, 'Yes', 2, NULL, '02/17/24', NULL),
(173, 'Jones', 'Brandon', 'Sarah', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Female', 28, NULL, 'williampatton@chavez.com', '11', '9', '1996', '987.173.6228', 'Married', 'Person With Disability (PWD)', 'Young Adult', 'Student', 'Master Graduate', 'Registered', 'Yes', NULL, 'Yes', 4, NULL, '03/05/2024', NULL),
(174, 'Maynard', 'Erica', 'Joshua', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '9', 'Male', 16, NULL, 'kathleen87@hotmail.com', '2', '5', '2008', '973.553.4509x39552', 'Single', 'Person With Disability (PWD)', 'Child Youth', 'Student', 'Elementary Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '01/19/24', NULL),
(175, 'Scott', 'Bonnie', 'Shannon', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Female', 25, NULL, 'hward@york-martin.org', '4', '28', '1999', '5345590189', 'Single', 'Working Youth', 'Young Adult', 'Currently looking for job', 'Vocational Graduate', 'Not Registered', 'Yes', NULL, 'Yes', 4, NULL, '03/11/2024', NULL),
(176, 'Long', 'Martin', 'Mark', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '4', 'Female', 19, NULL, 'sheliamccullough@king.biz', '10', '13', '2005', '-4759', 'Divorced', 'Out Of School Youth', 'Core Youth', 'Unemployed', 'College Graduate', 'Not Registered', 'No', NULL, 'Yes', 3, NULL, '02/03/2024', NULL),
(177, 'Lam', 'Tonya', 'Michelle', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '7', 'Female', 28, NULL, 'brandon38@yahoo.com', '1', '26', '1996', '179-115-9857x40867', 'Married', 'Person With Disability (PWD)', 'Young Adult', 'Unemployed', 'College Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '03/02/2024', NULL),
(178, 'Martinez', 'Blake', 'Deborah', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '5', 'Male', 20, NULL, 'christine91@gardner.com', '4', '14', '2004', '001-817-755-9015x375', 'Married', 'Working Youth', 'Core Youth', 'Unemployed', 'High School Level', 'Registered', 'Yes', NULL, 'Yes', 4, NULL, '03/07/2024', NULL),
(179, 'Martinez', 'Peggy', 'Bradley', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '3', 'Male', 15, NULL, 'griffinthomas@carter-gibson.com', '6', '25', '2009', '001-927-602-7872x840', 'Divorced', 'Out Of School Youth', 'Child Youth', 'Employed', 'College Graduate', 'Not Registered', 'Yes', NULL, 'Yes', 2, NULL, '02/19/24', NULL),
(180, 'Little', 'Erin', 'Tonya', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '3', 'Male', 22, NULL, 'ronaldtrevino@hill.com', '11', '5', '2002', '001-539-497-6149x106', 'Divorced', 'In School Youth', 'Core Youth', 'Self-Employed', 'College Graduate', 'Registered', 'Yes', NULL, 'Yes', 5, NULL, '06/08/2024', NULL),
(181, 'Cunningham', 'Taylor', 'Timothy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '2', 'Female', 27, NULL, 'xgeorge@webb-smith.com', '10', '15', '1997', '731-430-1687', 'Widowed', 'Working Youth', 'Young Adult', 'Unemployed', 'High School Graduate', 'Registered', 'No', NULL, 'Yes', 4, NULL, '01/04/2024', NULL),
(182, 'Anderson', 'Michael', 'Tina', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '2', 'Female', 25, NULL, 'wnguyen@hotmail.com', '6', '16', '1999', '+1-845-094-9996x0250', 'Widowed', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'Master Graduate', 'Registered', 'No', NULL, 'No', 0, NULL, '07/08/2024', NULL),
(183, 'Diaz', 'Bradley', 'Raymond', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 24, NULL, 'freemanryan@johnson.com', '5', '20', '2000', '(710)866-6768x340', 'Divorced', 'Working Youth', 'Core Youth', 'Employed', 'Master Level', 'Registered', 'Yes', NULL, 'Yes', 3, NULL, '02/27/24', NULL),
(184, 'Blevins', 'Jamie', 'Samantha', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '10', 'Female', 23, NULL, 'heatherlane@yahoo.com', '9', '12', '2001', '3490453794', 'Widowed', 'Out Of School Youth', 'Core Youth', 'Unemployed', 'High School Level', 'Not Registered', 'Yes', NULL, 'Yes', 4, NULL, '05/03/2024', NULL),
(185, 'Murillo', 'Mary', 'Jennifer', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 24, NULL, 'xhorton@hotmail.com', '7', '6', '2000', '582.634.8896x7999', 'Widowed', 'In School Youth', 'Core Youth', 'Self-Employed', 'College Graduate', 'Registered', 'Yes', NULL, 'Yes', 4, NULL, '03/21/24', NULL),
(186, 'Medina', 'Lawrence', 'Danielle', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Female', 29, NULL, 'jasongutierrez@trevino.com', '2', '12', '1995', '157-565-8649x90361', 'Single', 'Person With Disability (PWD)', 'Young Adult', 'Unemployed', 'Master Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '01/26/24', NULL),
(187, 'Hart', 'Valerie', 'Matthew', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '4', 'Female', 18, NULL, 'bryanmorgan@wilson-richardson.com', '8', '31', '2006', '610.092.0950x7554', 'Married', 'Out Of School Youth', 'Core Youth', 'Student', 'Elementary Level', 'Registered', 'No', NULL, 'No', 0, NULL, '03/21/24', NULL),
(188, 'Wright', 'Laura', 'Brianna', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '7', 'Male', 24, NULL, 'bjohnson@yahoo.com', '5', '20', '2000', '(441)425-6698x97435', 'Married', 'Out Of School Youth', 'Core Youth', 'Student', 'High School Level', 'Registered', 'No', NULL, 'No', 0, NULL, '01/23/24', NULL),
(189, 'Meyer', 'Keith', 'Michael', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Male', 28, NULL, 'kevinspencer@hotmail.com', '3', '20', '1996', '(972)179-2085x949', 'Widowed', 'In School Youth', 'Young Adult', 'Student', 'High School Level', 'Not Registered', 'Yes', NULL, 'Yes', 5, NULL, '02/28/24', NULL),
(190, 'Kelly', 'Linda', 'Vanessa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Female', 24, NULL, 'floresrenee@acosta.org', '11', '25', '2000', '001-097-730-2044x834', 'Single', 'In School Youth', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', NULL, 'Yes', 1, NULL, '01/16/24', NULL),
(191, 'Diaz', 'Beth', 'Michael', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '10', 'Female', 28, NULL, 'pamelathornton@shaw.com', '1', '12', '1996', '001-252-283-9786x962', 'Widowed', 'Out Of School Youth', 'Young Adult', 'Student', 'High School Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '05/14/24', NULL),
(192, 'Sullivan', 'Toni', 'Jay', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '9', 'Male', 23, NULL, 'davidpayne@dixon-reyes.info', '2', '18', '2001', '911.166.1790', 'Married', 'In School Youth', 'Core Youth', 'Student', 'Elementary Graduate', 'Not Registered', 'No', NULL, 'Yes', 1, NULL, '02/21/24', NULL),
(193, 'Ponce', 'Sara', 'Sarah', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '2', 'Male', 15, NULL, 'nnicholson@hawkins.com', '1', '10', '2009', '596-749-8710', 'Widowed', 'Person With Disability (PWD)', 'Child Youth', 'Currently looking for job', 'College Graduate', 'Not Registered', 'Yes', NULL, 'No', 0, NULL, '05/24/24', NULL),
(194, 'Stout', 'Sarah', 'Kristy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Male', 25, NULL, 'morandarlene@hotmail.com', '6', '19', '1999', '001-470-538-3778x352', 'Single', 'In School Youth', 'Young Adult', 'Student', 'Master Graduate', 'Not Registered', 'No', NULL, 'Yes', 4, NULL, '01/20/24', NULL),
(195, 'Jones', 'Andrew', 'James', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '5', 'Female', 25, NULL, 'foxbruce@gmail.com', '3', '27', '1999', '225.656.5708', 'Single', 'Person With Disability (PWD)', 'Young Adult', 'Employed', 'Master Level', 'Not Registered', 'Yes', NULL, 'Yes', 3, NULL, '01/04/2024', NULL),
(196, 'Ramirez', 'Patricia', 'Brandon', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Male', 30, NULL, 'tracy74@gmail.com', '1', '2', '1994', '997.652.6140x893', 'Divorced', 'In School Youth', 'Young Adult', 'Unemployed', 'Elementary Level', 'Not Registered', 'No', NULL, 'No', 0, NULL, '01/31/24', NULL),
(197, 'Evans', 'Brandy', 'Lindsey', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '10', 'Male', 22, NULL, 'zpaul@gmail.com', '9', '22', '2002', '925.563.8156', 'Married', 'Person With Disability (PWD)', 'Core Youth', 'Currently looking for job', 'Master Level', 'Registered', 'No', NULL, 'Yes', 3, NULL, '06/12/2024', NULL),
(198, 'Higgins', 'Jason', 'Curtis', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '3', 'Male', 28, NULL, 'nmendoza@schneider.info', '10', '12', '1996', '+1-685-948-5839x5006', 'Divorced', 'Out Of School Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', NULL, 'Yes', 4, NULL, '04/25/24', NULL),
(199, 'Smith', 'Julia', 'Jessica', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Male', 15, NULL, 'ryananderson@hotmail.com', '6', '11', '2009', '2587170106', 'Married', 'Working Youth', 'Child Youth', 'Unemployed', 'Elementary Graduate', 'Registered', 'No', NULL, 'Yes', 5, NULL, '01/01/2024', NULL),
(200, 'Hernandez', 'Maria', 'Kelly', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '4', 'Female', 18, NULL, 'ellenwilliams@yahoo.com', '3', '20', '2006', '789-601-6091', 'Divorced', 'In School Youth', 'Core Youth', 'Currently looking for job', 'High School Graduate', 'Not Registered', 'No', NULL, 'Yes', 3, NULL, '03/05/2024', NULL),
(201, 'Frank', 'Edward', 'Karen', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Female', 16, NULL, 'schmidtmelissa@rogers-riggs.com', '7', '6', '2008', '748.461.0796x530', 'Married', 'Person With Disability (PWD)', 'Child Youth', 'Self-Employed', 'High School Level', 'Registered', 'No', NULL, 'Yes', 2, NULL, '01/09/2024', NULL),
(202, 'Hunt', 'Claudia', 'Michael', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '10', 'Female', 23, NULL, 'ashley83@hotmail.com', '5', '8', '2001', '001-614-148-8905', 'Single', 'Working Youth', 'Core Youth', 'Unemployed', 'High School Level', 'Not Registered', 'Yes', NULL, 'Yes', 4, NULL, '03/27/24', NULL),
(203, 'Smith', 'Amy', 'William', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Male', 25, NULL, 'peter03@schmidt.com', '11', '28', '1999', '888-100-1822', 'Single', 'Working Youth', 'Young Adult', 'Employed', 'College Level', 'Registered', 'No', NULL, 'Yes', 2, NULL, '01/22/24', NULL),
(204, 'Murphy', 'Tina', 'Keith', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '2', 'Female', 16, NULL, 'norrisnancy@gmail.com', '1', '8', '2008', '001-905-802-4467x149', 'Widowed', 'Person With Disability (PWD)', 'Child Youth', 'Self-Employed', 'College Graduate', 'Registered', 'Yes', NULL, 'Yes', 4, NULL, '05/18/24', NULL),
(205, 'Taylor', 'Mark', 'Angelica', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '5', 'Male', 30, NULL, 'abrooks@hotmail.com', '11', '12', '1994', '(903)449-3825x659', 'Married', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'Elementary Level', 'Not Registered', 'Yes', NULL, 'No', 0, NULL, '05/07/2024', NULL),
(206, 'Mendoza', 'Tracy', 'Glenn', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '10', 'Female', 21, NULL, 'marygeorge@yahoo.com', '5', '30', '2003', '-6764', 'Single', 'Working Youth', 'Core Youth', 'Student', 'Elementary Level', 'Registered', 'Yes', NULL, 'No', 0, NULL, '03/04/2024', NULL),
(207, 'Green', 'Katie', 'Gary', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '4', 'Female', 29, NULL, 'ryanlarsen@hotmail.com', '11', '2', '1995', '8967372437', 'Married', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'College Graduate', 'Registered', 'No', NULL, 'Yes', 4, NULL, '01/19/24', NULL),
(208, 'Brown', 'Michelle', 'Chelsea', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '4', 'Female', 23, NULL, 'moorelori@marshall-gomez.com', '6', '4', '2001', '001-550-911-4974x815', 'Married', 'In School Youth', 'Core Youth', 'Employed', 'Elementary Graduate', 'Not Registered', 'Yes', NULL, 'No', 0, NULL, '04/16/24', NULL),
(209, 'Ashley', 'Stephanie', 'Jeremy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '5', 'Male', 30, NULL, 'slee@yahoo.com', '6', '19', '1994', '-5901', 'Married', 'Out Of School Youth', 'Young Adult', 'Unemployed', 'Doctorate Level', 'Registered', 'Yes', NULL, 'No', 0, NULL, '03/14/24', NULL),
(210, 'Beck', 'Chad', 'Jeremy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '10', 'Female', 22, NULL, 'cgoodman@yahoo.com', '9', '3', '2002', '+1-169-444-4817x1516', 'Single', 'In School Youth', 'Core Youth', 'Unemployed', 'Vocational Graduate', 'Registered', 'No', NULL, 'No', 0, NULL, '04/20/24', NULL),
(211, 'Garcia', 'Megan', 'Richard', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '2', 'Female', 19, NULL, 'toniduncan@james.com', '7', '20', '2005', '+1-936-886-9980x4738', 'Single', 'Working Youth', 'Core Youth', 'Self-Employed', 'Master Graduate', 'Registered', 'Yes', NULL, 'Yes', 2, NULL, '05/29/24', NULL),
(212, 'Schroeder', 'Jeff', 'Kevin', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '3', 'Female', 22, NULL, 'chad47@yahoo.com', '8', '14', '2002', '131-528-7720x35977', 'Single', 'Person With Disability (PWD)', 'Core Youth', 'Currently looking for job', 'Elementary Graduate', 'Not Registered', 'No', NULL, 'Yes', 1, NULL, '03/15/24', NULL),
(213, 'Porter', 'Donna', 'Eric', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Female', 18, NULL, 'angelalambert@yahoo.com', '9', '21', '2006', '061-036-1295x8853', 'Widowed', 'Working Youth', 'Core Youth', 'Currently looking for job', 'Doctorate Level', 'Not Registered', 'Yes', NULL, 'Yes', 4, NULL, '04/10/2024', NULL),
(214, 'Briggs', 'Richard', 'Lisa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, 'gshelton@williams.org', '1', '31', '1997', '6575159976', 'Married', 'Person With Disability (PWD)', 'Young Adult', 'Unemployed', 'Master Graduate', 'Not Registered', 'Yes', NULL, 'No', 0, NULL, '06/10/2024', NULL),
(215, 'Young', 'Sierra', 'Wyatt', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 17, NULL, 'dray@hotmail.com', '7', '13', '2007', '(579)962-5007x7872', 'Married', 'Out Of School Youth', 'Child Youth', 'Student', 'High School Level', 'Registered', 'No', NULL, 'No', 0, NULL, '02/13/24', NULL),
(216, 'Estrada', 'Jacqueline', 'Theresa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '5', 'Female', 26, NULL, 'hugheslauren@mejia.com', '9', '14', '1998', '+1-216-252-9218x800', 'Widowed', 'Working Youth', 'Young Adult', 'Currently looking for job', 'Master Graduate', 'Not Registered', 'Yes', NULL, 'Yes', 4, NULL, '06/20/24', NULL),
(217, 'Henderson', 'Kathleen', 'Ellen', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '5', 'Female', 19, NULL, 'twarren@gmail.com', '12', '27', '2005', '132.225.5391', 'Widowed', 'In School Youth', 'Core Youth', 'Currently looking for job', 'Vocational Graduate', 'Not Registered', 'Yes', NULL, 'No', 0, NULL, '03/06/2024', NULL),
(218, 'Sherman', 'Rebecca', 'Oscar', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '3', 'Male', 22, NULL, 'wsmith@fry.info', '3', '14', '2002', '-7763', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', NULL, 'Yes', 2, NULL, '01/01/2024', NULL),
(219, 'Perez', 'Heather', 'Amanda', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '3', 'Female', 23, NULL, 'etaylor@sparks.com', '6', '26', '2001', '-4929', 'Divorced', 'In School Youth', 'Core Youth', 'Self-Employed', 'College Level', 'Not Registered', 'Yes', NULL, 'Yes', 3, NULL, '07/08/2024', NULL),
(220, 'Adams', 'Debbie', 'Antonio', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '10', 'Male', 19, NULL, 'joseph42@holland.net', '10', '21', '2005', '-7698', 'Married', 'Person With Disability (PWD)', 'Core Youth', 'Student', 'Vocational Graduate', 'Registered', 'Yes', NULL, 'Yes', 3, NULL, '04/28/24', NULL),
(221, 'Cooper', 'William', 'Julia', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Male', 26, NULL, 'brett60@yahoo.com', '1', '5', '1998', '577-327-3351', 'Single', 'Out Of School Youth', 'Young Adult', 'Employed', 'College Level', 'Not Registered', 'No', NULL, 'No', 0, NULL, '04/28/24', NULL),
(222, 'Coleman', 'Ruth', 'Jennifer', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '2', 'Female', 29, NULL, 'jessica20@rodriguez-lee.com', '3', '21', '1995', '001-422-810-1867x032', 'Married', 'Working Youth', 'Young Adult', 'Self-Employed', 'College Level', 'Not Registered', 'No', NULL, 'Yes', 5, NULL, '03/18/24', NULL),
(223, 'Knox', 'Kimberly', 'Dylan', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '9', 'Female', 25, NULL, 'samuel14@gmail.com', '2', '27', '1999', '001-002-201-8965', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'High School Level', 'Registered', 'Yes', NULL, 'No', 0, NULL, '04/09/2024', NULL),
(224, 'Arnold', 'Michael', 'Jacqueline', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Male', 19, NULL, 'jessica77@marshall.org', '8', '18', '2005', '(189)604-3912x5460', 'Single', 'Working Youth', 'Core Youth', 'Self-Employed', 'Master Graduate', 'Not Registered', 'No', NULL, 'No', 0, NULL, '05/02/2024', NULL),
(225, 'Flores', 'Natasha', 'Nathaniel', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '9', 'Female', 28, NULL, 'allen55@grant.com', '2', '23', '1996', '001-544-939-7623x101', 'Widowed', 'Person With Disability (PWD)', 'Young Adult', 'Unemployed', 'High School Graduate', 'Registered', 'No', NULL, 'Yes', 4, NULL, '02/07/2024', NULL),
(226, 'Carroll', 'Gabriella', 'Luis', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '9', 'Female', 22, NULL, 'keith00@walker-vasquez.com', '11', '26', '2002', '9068773997', 'Widowed', 'Working Youth', 'Core Youth', 'Unemployed', 'College Level', 'Not Registered', 'No', NULL, 'No', 0, NULL, '01/18/24', NULL),
(227, 'Wise', 'Craig', 'Yvonne', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Female', 16, NULL, 'dale32@hotmail.com', '9', '6', '2008', '150.431.1434x4035', 'Divorced', 'Out Of School Youth', 'Child Youth', 'Employed', 'Master Graduate', 'Not Registered', 'No', NULL, 'No', 0, NULL, '04/05/2024', NULL),
(228, 'Evans', 'Luis', 'Brad', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '4', 'Female', 22, NULL, 'kyoung@gmail.com', '12', '27', '2002', '001-675-337-7965', 'Widowed', 'Working Youth', 'Core Youth', 'Unemployed', 'Doctorate Level', 'Registered', 'No', NULL, 'Yes', 5, NULL, '06/11/2024', NULL),
(229, 'Rose', 'Krista', 'James', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Male', 20, NULL, 'tmorse@daniels-williams.com', '2', '8', '2004', '584-592-6835x8808', 'Widowed', 'Person With Disability (PWD)', 'Core Youth', 'Unemployed', 'Master Graduate', 'Not Registered', 'No', NULL, 'Yes', 2, NULL, '07/05/2024', NULL),
(230, 'Castro', 'William', 'Samuel', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 16, NULL, 'rochasusan@hotmail.com', '8', '20', '2008', '573-235-6306x758', 'Married', 'In School Youth', 'Child Youth', 'Unemployed', 'Doctorate Level', 'Registered', 'Yes', NULL, 'Yes', 2, NULL, '03/12/2024', NULL),
(231, 'Love', 'Melissa', 'Paul', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Male', 28, NULL, 'zbray@yahoo.com', '10', '1', '1996', '-2228', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Currently looking for job', 'College Level', 'Registered', 'Yes', NULL, 'No', 0, NULL, '04/20/24', NULL),
(232, 'Ross', 'Nicholas', 'Steven', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Male', 26, NULL, 'vjohnson@sellers.com', '10', '31', '1998', '794-701-6076', 'Married', 'Out Of School Youth', 'Young Adult', 'Employed', 'Elementary Level', 'Registered', 'No', NULL, 'Yes', 4, NULL, '03/07/2024', NULL),
(233, 'Johnson', 'Joyce', 'Jamie', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '3', 'Female', 23, NULL, 'williamsstephanie@cortez.com', '6', '15', '2001', '688-708-4427', 'Widowed', 'In School Youth', 'Core Youth', 'Employed', 'High School Level', 'Not Registered', 'Yes', NULL, 'No', 0, NULL, '01/28/24', NULL),
(234, 'Heath', 'Ryan', 'Michelle', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '9', 'Male', 27, NULL, 'warellano@hotmail.com', '4', '9', '1997', '001-585-360-8261x033', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'College Graduate', 'Not Registered', 'No', NULL, 'Yes', 3, NULL, '02/08/2024', NULL),
(235, 'King', 'Michelle', 'Sarah', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '4', 'Male', 28, NULL, 'anna39@hotmail.com', '3', '15', '1996', '7406195691', 'Widowed', 'In School Youth', 'Young Adult', 'Employed', 'Elementary Graduate', 'Not Registered', 'Yes', NULL, 'No', 0, NULL, '01/16/24', NULL),
(236, 'Sweeney', 'Mark', 'Kelly', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '5', 'Female', 23, NULL, 'xhayes@yahoo.com', '1', '13', '2001', '415.882.1459', 'Widowed', 'Person With Disability (PWD)', 'Core Youth', 'Unemployed', 'High School Graduate', 'Not Registered', 'Yes', NULL, 'Yes', 5, NULL, '02/09/2024', NULL),
(237, 'Baker', 'Scott', 'Christopher', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Female', 18, NULL, 'joneill@byrd.info', '10', '6', '2006', '(236)792-9138', 'Married', 'In School Youth', 'Core Youth', 'Student', 'High School Level', 'Not Registered', 'No', NULL, 'Yes', 3, NULL, '01/03/2024', NULL),
(238, 'Leonard', 'John', 'Juan', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '3', 'Male', 21, NULL, 'edwinconner@gmail.com', '2', '24', '2003', '(745)667-7755x342', 'Divorced', 'Person With Disability (PWD)', 'Core Youth', 'Student', 'Elementary Graduate', 'Not Registered', 'Yes', NULL, 'Yes', 5, NULL, '04/15/24', NULL),
(239, 'Woodward', 'William', 'James', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Male', 20, NULL, 'mariafoster@acosta.net', '6', '12', '2004', '001-873-704-9011x863', 'Widowed', 'Working Youth', 'Core Youth', 'Employed', 'College Graduate', 'Registered', 'No', NULL, 'No', 0, NULL, '06/29/24', NULL),
(240, 'Gates', 'Laura', 'Scott', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '3', 'Male', 18, NULL, 'wjones@murphy-davis.net', '11', '28', '2006', '(862)742-3789', 'Single', 'In School Youth', 'Core Youth', 'Currently looking for job', 'Elementary Level', 'Not Registered', 'No', NULL, 'No', 0, NULL, '01/30/24', NULL),
(241, 'Jacobs', 'Kyle', 'Connor', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Female', 21, NULL, 'ebradley@hotmail.com', '5', '7', '2003', '101-595-1566x267', 'Married', 'Working Youth', 'Core Youth', 'Self-Employed', 'High School Graduate', 'Not Registered', 'No', NULL, 'Yes', 1, NULL, '03/29/24', NULL),
(242, 'Hart', 'Samuel', 'Elizabeth', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '5', 'Female', 25, NULL, 'larsonkelly@wolf.com', '4', '14', '1999', '832.434.7911x08551', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'Doctorate Level', 'Not Registered', 'No', NULL, 'No', 0, NULL, '01/11/2024', NULL),
(243, 'Jones', 'Timothy', 'Daniel', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '2', 'Male', 29, NULL, 'paulluna@hancock-henderson.org', '1', '24', '1995', '394.792.3880', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'High School Level', 'Registered', 'No', NULL, 'No', 0, NULL, '06/15/24', NULL),
(244, 'Melendez', 'Katherine', 'Gregory', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '9', 'Female', 29, NULL, 'ricardo13@gmail.com', '4', '22', '1995', '811-598-2327', 'Widowed', 'Working Youth', 'Young Adult', 'Student', 'High School Graduate', 'Not Registered', 'Yes', NULL, 'Yes', 3, NULL, '01/13/24', NULL),
(245, 'Wood', 'Christina', 'Andrew', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Male', 26, NULL, 'christopherperez@white.com', '3', '11', '1998', '491-621-9327', 'Widowed', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'College Graduate', 'Not Registered', 'Yes', NULL, 'Yes', 3, NULL, '02/15/24', NULL),
(246, 'Moore', 'Willie', 'William', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '10', 'Male', 30, NULL, 'jeremyhenry@thompson-paul.com', '8', '2', '1994', '001-848-456-0386x550', 'Single', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'Master Graduate', 'Registered', 'No', NULL, 'No', 0, NULL, '05/03/2024', NULL),
(247, 'Myers', 'Melissa', 'Daniel', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 29, NULL, 'ribarra@hotmail.com', '4', '24', '1995', '+1-367-196-0117x9726', 'Widowed', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'Doctorate Level', 'Registered', 'No', NULL, 'No', 0, NULL, '04/19/24', NULL),
(248, 'Thompson', 'Monica', 'Autumn', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '10', 'Female', 17, NULL, 'ginadavis@gmail.com', '2', '6', '2007', '-11080', 'Widowed', 'Working Youth', 'Child Youth', 'Self-Employed', 'Vocational Graduate', 'Not Registered', 'Yes', NULL, 'Yes', 3, NULL, '05/26/24', NULL),
(249, 'Montoya', 'Brian', 'Sean', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Female', 25, NULL, 'jordan10@gmail.com', '9', '22', '1999', '(790)250-8254x726', 'Single', 'In School Youth', 'Young Adult', 'Currently looking for job', 'Vocational Graduate', 'Not Registered', 'Yes', NULL, 'No', 0, NULL, '05/06/2024', NULL),
(250, 'Cruz', 'Alicia', 'Carl', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Female', 28, NULL, 'arobinson@neal.com', '9', '5', '1996', '789.000.0142', 'Single', 'Working Youth', 'Young Adult', 'Self-Employed', 'Master Graduate', 'Not Registered', 'No', NULL, 'Yes', 3, NULL, '05/28/24', NULL),
(251, 'Turner', 'Elizabeth', 'Lisa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '2', 'Female', 27, NULL, 'ystone@yahoo.com', '8', '27', '1997', '9102675261', 'Widowed', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'College Level', 'Registered', 'No', NULL, 'Yes', 1, NULL, '05/16/24', NULL),
(252, 'Brock', 'Denise', 'Kristin', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Male', 23, NULL, 'grossjason@brown.com', '5', '13', '2001', '573.687.4641', 'Widowed', 'Working Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', NULL, 'No', 0, NULL, '04/10/2024', NULL),
(253, 'Carlson', 'Jennifer', 'Laura', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '5', 'Female', 20, NULL, 'karenellis@hayes.com', '5', '27', '2004', '+1-692-640-2387x027', 'Divorced', 'Working Youth', 'Core Youth', 'Student', 'College Graduate', 'Registered', 'No', NULL, 'Yes', 1, NULL, '04/25/24', NULL),
(254, 'King', 'Sean', 'Jennifer', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '10', 'Female', 23, NULL, 'ann49@marshall-jensen.info', '1', '17', '2001', '001-894-455-2146x490', 'Married', 'Person With Disability (PWD)', 'Core Youth', 'Unemployed', 'Elementary Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '02/24/24', NULL),
(255, 'Kennedy', 'April', 'Priscilla', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '7', 'Female', 21, NULL, 'cardenasaaron@gmail.com', '1', '28', '2003', '914.439.2469x2991', 'Divorced', 'Person With Disability (PWD)', 'Core Youth', 'Self-Employed', 'Master Level', 'Not Registered', 'No', NULL, 'No', 0, NULL, '01/25/24', NULL),
(256, 'Sherman', 'Danny', 'Jamie', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Male', 26, NULL, 'fmann@molina.biz', '5', '7', '1998', '791-684-7596', 'Divorced', 'Out Of School Youth', 'Young Adult', 'Self-Employed', 'Doctorate Level', 'Not Registered', 'Yes', NULL, 'Yes', 1, NULL, '04/22/24', NULL),
(257, 'Pennington', 'Barbara', 'Jennifer', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '4', 'Female', 25, NULL, 'millerjesse@yahoo.com', '9', '24', '1999', '(711)523-0265x09655', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'College Graduate', 'Registered', 'Yes', NULL, 'Yes', 3, NULL, '04/25/24', NULL),
(258, 'Vazquez', 'Nicholas', 'Glen', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Male', 17, NULL, 'susanharris@hotmail.com', '8', '23', '2007', '9180104237', 'Married', 'Out Of School Youth', 'Child Youth', 'Unemployed', 'Master Level', 'Not Registered', 'No', NULL, 'Yes', 1, NULL, '06/30/24', NULL),
(259, 'Rodriguez', 'Thomas', 'Taylor', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '3', 'Male', 24, NULL, 'michealnunez@martin-diaz.biz', '6', '30', '2000', '(711)818-6535', 'Divorced', 'In School Youth', 'Core Youth', 'Unemployed', 'Elementary Level', 'Not Registered', 'No', NULL, 'No', 0, NULL, '03/25/24', NULL),
(260, 'Johnson', 'Alejandro', 'Charlotte', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', 'Female', 30, NULL, 'christopher72@anderson.com', '1', '2', '1994', '001-357-617-1677x661', 'Married', 'Working Youth', 'Young Adult', 'Unemployed', 'Master Level', 'Not Registered', 'Yes', NULL, 'No', 0, NULL, '05/27/24', NULL),
(261, 'Krause', 'Rachel', 'Madison', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '6', 'Male', 26, NULL, 'sosaalexa@bridges.biz', '9', '15', '1998', '+1-253-498-1232x890', 'Married', 'Working Youth', 'Young Adult', 'Student', 'College Level', 'Registered', 'No', NULL, 'No', 0, NULL, '05/02/2024', NULL),
(262, 'Harris', 'Ashley', 'Melanie', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 29, NULL, 'gmcfarland@mills.com', '1', '18', '1995', '001-707-131-2042', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'Master Graduate', 'Not Registered', 'Yes', NULL, 'No', 0, NULL, '01/28/24', NULL),
(263, 'Snyder', 'Katherine', 'Tara', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Female', 23, NULL, 'zchen@yahoo.com', '5', '9', '2001', '626-886-4072', 'Single', 'In School Youth', 'Core Youth', 'Employed', 'Vocational Graduate', 'Not Registered', 'Yes', NULL, 'Yes', 3, NULL, '03/10/2024', NULL),
(264, 'Martinez', 'Ronald', 'William', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '7', 'Male', 20, NULL, 'johnbrown@gmail.com', '11', '13', '2004', '778.066.0439x50263', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Registered', 'No', NULL, 'Yes', 3, NULL, '02/06/2024', NULL),
(266, 'ad', 'asdg', 'asdhu', 'asd', 'asdg', 'asdg', 'asdg', 'asdg', 'asdg', 'asdg', 'Female', 24, 'asdg', 'asdg@asdg', '2', '3', '2000', '123123', 'Married', 'Out Of School Youth', '', 'Unemployed', 'Vocational Graduate', 'No', 'No', 'No', 'No', 0, '', '', ''),
(267, 'bonjing', 'bonjing', 'bonjing', 'bonjing', 'bonjing', 'bonjing', 'bonjing', 'bonjing', 'bonjing', 'bonjing', 'Male', 23, 'bonjing', 'bonjing@bonjing', '8', '13', '2000', '123313', 'Single', 'Out Of School Youth', '', 'Employed', 'High School Graduate', 'No', 'No', 'No', 'No', 0, '', '', ''),
(268, 'jhb', 'ugu', 'yuggyu', 'ftf', 'gfd', 'fgh', 'gfc', 'dfgvhbj', 'ghv', 'fghj', 'Female', 23, 'vjh', 'tdf@dfg', '10', '18', '2000', '23423', 'Divorced', 'Working Youth', '', 'Student', 'High School Level', 'No', 'No', 'No', 'No', 0, '', '', '1'),
(269, '1', '2', '3', '', 'CAR', 'Benguet', 'La Trinidad', 'Balili', '123', '33', 'Male', 24, '', '123@123', '1', '17', '2000', '123', 'Single', 'In School Youth', '', 'Student', 'Elementary Level', 'No', 'No', 'No', 'No', 123, '', '', ''),
(270, '3', '2', '1', '', '3', '2', '2', '1', '3', '1', 'Female', 24, '', '123@123', '1', '21', '2000', '213213', 'Single', 'In School Youth', '', 'Student', 'Elementary Level', 'Yes', 'Yes', 'No', 'Yes', 0, '', '', ''),
(271, 'a', 'a', 'a', '', 'a', 'a', 'a', 'a', 'a', 'a', 'Male', 19, '', 'a@12', '1', '5', '2005', '123213', 'Single', 'In School Youth', '', 'Student', 'Elementary Level', 'No', 'No', 'Yes', 'No', 0, '', '', '');

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
  `sitio` varchar(50) DEFAULT NULL,
  `purok` varchar(100) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `youth_with_needs` varchar(100) DEFAULT NULL,
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
  `national_voter` varchar(100) DEFAULT NULL,
  `attended_kk` varchar(3) NOT NULL,
  `times_attended_kk` int(11) DEFAULT NULL,
  `no_why` varchar(100) DEFAULT NULL,
  `date_created` varchar(50) NOT NULL,
  `barangay_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles_archive`
--

INSERT INTO `profiles_archive` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `sitio`, `purok`, `sex`, `age`, `youth_with_needs`, `email`, `birth_month`, `birth_day`, `birth_year`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `register_sk_voter`, `voted_last_election`, `national_voter`, `attended_kk`, `times_attended_kk`, `no_why`, `date_created`, `barangay_code`) VALUES
(165, 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'Male', 35, 'z', 'z@z', '3', '18', '1989', '123', 'Married', 'In Youth School', '', 'Unemployed', 'Elementary Graduate', 'No', 'No', 'No', 'No', 0, '', '', NULL),
(265, 'Mitchell', 'Melissa', 'Sheila', '', 'CAR', 'BEN', 'La Trinidad', 'asdasdasd', 'sd', '10', 'Male', 43, 'asd', 'chase05@hotmail.com', '8', '10', '1980', '001-040-681-1958x882', 'Divorced', 'In Youth School', 'Core Youth', 'Self-Employed', 'Elementary Level', 'Registered', 'Yes', 'No', 'No', 0, '', '02/25/24', NULL);

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
  `sitio` varchar(50) DEFAULT NULL,
  `purok` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `youth_with_needs` varchar(100) DEFAULT NULL,
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
  `national_voter` int(50) DEFAULT NULL,
  `attended_kk` varchar(3) NOT NULL,
  `times_attended_kk` int(11) NOT NULL,
  `no_why` varchar(100) DEFAULT NULL,
  `date_created` varchar(50) NOT NULL,
  `barangay_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles_backup`
--

INSERT INTO `profiles_backup` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `sitio`, `purok`, `sex`, `age`, `youth_with_needs`, `email`, `birth_month`, `birth_day`, `birth_year`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `register_sk_voter`, `voted_last_election`, `national_voter`, `attended_kk`, `times_attended_kk`, `no_why`, `date_created`, `barangay_code`) VALUES
(6, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '2', 'Male', 24, NULL, 'asd@aesdf', '5', '18', '2000', '1231', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'College Level', 'No', 'No', NULL, 'No', 0, NULL, '07/10/24', NULL),
(7, 'sample', 'sample', 'sample', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '123', 'Male', 24, NULL, 'sad@asda', '2', '16', '2000', '123', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'No', 'No', NULL, 'No', 0, NULL, '07/10/24', NULL),
(8, 'amsd', 'asd', 'asd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '123', 'Male', 34, NULL, 'asd@asd', '2', '18', '1990', '123123', 'Married', 'Out Of School Youth', '', 'Employed', 'High School Level', 'No', 'No', NULL, 'No', 0, NULL, '07/10/24', NULL),
(9, 'Pacio ', 'Dee Jay', 'Toribio', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '23', 'Male', 20, NULL, 'asd@asd', '5', '9', '2004', '1231', 'Single', 'Out Of School Youth', 'Core Youth', 'Currently looking for job', 'College Level', 'Yes', 'No', NULL, 'No', 0, NULL, '07/10/24', NULL),
(10, 'hasjkdfhkj', 'shdjk', 'asdh', 'asdhjk', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '2', 'Female', 24, NULL, 'asda@asdha', '2', '27', '2000', '123123', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', NULL, 'Yes', 1, NULL, '07/10/24', NULL),
(11, 'dale ', 'matthew', 'boquiren', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 31, NULL, 'asd@asd', '2', '2', '1993', '12333', 'Single', 'In School Youth', 'Young Adult', 'Student', 'Elementary Level', 'Registered', 'Yes', NULL, 'Yes', 1, NULL, '07/10/24', NULL),
(12, 'Boquiren', 'Dale Matthew', 'Ramirez', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 31, NULL, 'asd@123', '1', '2', '1993', '1233331', 'Married', 'In School Youth', 'Young Adult', 'Student', 'College Level', 'Registered', 'Yes', NULL, 'Yes', 1, NULL, '07/10/24', NULL),
(13, 'Boquiren', 'Dale Matthew', 'Ramirez', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 31, NULL, 'asd@123', '2', '2', '1993', '123123123', 'Married', 'In School Youth', '', 'Student', 'High School Level', 'Registered', 'Yes', NULL, 'No', 0, NULL, '07/10/24', NULL),
(14, 'Boquiren', 'Dale Matthew', 'Ramirez', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 31, NULL, 'asd@123', '2', '2', '1993', '123123123', 'Married', 'In School Youth', '', 'Student', 'High School Level', 'Registered', 'Yes', NULL, 'No', 0, NULL, '07/10/24', NULL),
(15, 'Cayambas', 'Hyra', 'S', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '2', 'Female', 31, NULL, 'das@321', '2', '3', '1993', '1233444', 'Single', 'In School Youth', 'Core Youth', 'Employed', 'Elementary Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '07/10/24', NULL),
(16, 'Cayambas', 'Hyra', 'S', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Female', 31, NULL, 'ads@321', '2', '3', '1993', '213124', 'Married', 'In School Youth', 'Core Youth', 'Student', 'College Level', 'Registered', 'Yes', NULL, 'No', 0, NULL, '07/10/24', NULL),
(17, 'asd', 'asdasda', 'asdasd', 'sdasda', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 31, NULL, 'asda@asdasd', '3', '8', '1993', '12312312', 'Married', 'Out Of School Youth', 'Child Youth', 'Student', 'High School Level', 'Registered', 'Yes', NULL, 'No', 0, NULL, '07/10/24', NULL),
(18, 'dsada', 'asdasda', 'sdasdasd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 31, NULL, 'asdada@aaa', '3', '3', '1993', '12315125', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'College Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '07/10/24', NULL),
(19, '123123', '1231', '123123', '2312312', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, '123@55', '3', '5', '1997', '222', 'Married', 'Out Of School Youth', 'Young Adult', 'Unemployed', 'High School Graduate', 'Registered', 'Yes', NULL, 'Yes', 0, NULL, '07/10/24', NULL),
(20, '123123', '1231', '123123', '2312312', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, '123@55', '3', '5', '1997', '222', 'Married', 'Out Of School Youth', 'Young Adult', 'Unemployed', 'High School Graduate', 'Registered', 'Yes', NULL, 'Yes', 0, NULL, '07/10/24', NULL),
(21, '123123', '1231', '123123', '2312312', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, '123@55', '3', '5', '1997', '222', 'Married', 'Out Of School Youth', 'Young Adult', 'Unemployed', 'High School Graduate', 'Registered', 'Yes', NULL, 'Yes', 0, NULL, '07/10/24', NULL),
(22, 'asdasda', 'fasfas', 'fasfa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, 'asdasd@hhh', '6', '6', '1997', '123123', 'Single', 'Out Of School Youth', 'Young Adult', 'Employed', 'High School Graduate', 'Registered', 'Yes', NULL, 'Yes', 2, NULL, '07/10/24', NULL),
(23, 'asdasda', 'fasfas', 'fasfa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, 'asdasd@hhh', '6', '6', '1997', '123123', 'Single', 'Out Of School Youth', 'Young Adult', 'Employed', 'High School Graduate', 'Registered', 'Yes', NULL, 'Yes', 2, NULL, '07/10/24', NULL),
(24, 'asdasda', 'fasfas', 'fasfa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, 'asdasd@hhh', '6', '6', '1997', '123123', 'Single', 'Out Of School Youth', 'Young Adult', 'Employed', 'High School Graduate', 'Registered', 'Yes', NULL, 'Yes', 2, NULL, '07/10/24', NULL),
(25, 'asdasda', 'fasfas', 'fasfa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, 'asdasd@hhh', '6', '6', '1997', '123123', 'Single', 'Out Of School Youth', 'Young Adult', 'Employed', 'High School Graduate', 'Registered', 'Yes', NULL, 'Yes', 2, NULL, '07/10/24', NULL),
(26, 'asdasd', 'asdasd', 'asdasd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, 'sdla@galsg', '7', '8', '1997', '12312', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '07/10/24', NULL),
(27, 'asdasd', 'asdasd', 'asdasd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, 'sdla@galsg', '7', '8', '1997', '12312', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '07/10/24', NULL),
(28, 'asdasd', 'asdasd', 'asdasd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, 'sdla@galsg', '7', '8', '1997', '12312', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '07/10/24', NULL),
(29, 'asdasd', 'asdasd', 'asdasd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, 'sdla@galsg', '7', '8', '1997', '12312', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '07/10/24', NULL),
(30, 'asdasd', 'asdasd', 'asdasd', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '1', 'Male', 27, NULL, 'sdla@galsg', '7', '8', '1997', '12312', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', NULL, 'No', 0, NULL, '07/10/24', NULL);

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
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
  ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `delete_profile`
--
ALTER TABLE `delete_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `profiles_archive`
--
ALTER TABLE `profiles_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

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
