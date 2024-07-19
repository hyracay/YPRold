-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 07:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(24, 'alapang@ph', '$2y$10$MTEzp8xjslWSUcMiKVmUFu547cEgsNzpAR6rBUjNPp1tNEBAPfxgq', 'user', 'ph', 'user', '3'),
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
  `house_number` varchar(3) DEFAULT NULL,
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
  `voted_last_election` varchar(3) DEFAULT NULL,
  `national_voter` varchar(50) DEFAULT NULL,
  `attended_kk` varchar(3) DEFAULT NULL,
  `times_attended_kk` int(11) DEFAULT NULL,
  `no_why` varchar(100) DEFAULT NULL,
  `date_created` varchar(50) DEFAULT NULL,
  `barangay_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delete_profile`
--

INSERT INTO `delete_profile` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `sitio`, `purok`, `house_number`, `sex`, `age`, `youth_with_needs`, `email`, `birth_month`, `birth_day`, `birth_year`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `register_sk_voter`, `voted_last_election`, `national_voter`, `attended_kk`, `times_attended_kk`, `no_why`, `date_created`, `barangay_code`) VALUES
(63, 'Jacobs', 'Kyle', 'Connor', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '29', 'Female', 21, '0', 'ebradley@hotmail.com', '5', '7', '2003', '101-595-1566x267', 'Married', 'Working Youth', 'Core Youth', 'Self-Employed', 'High School Graduate', 'Not Registered', 'No', '', 'Yes', 1, '0', '3/29/2024', '5'),
(64, 'hat', 'dog', 'hah', 'ahhh', 'CAR', 'Benguet', 'La Trinidad', 'Wangal', '111', '2', '222', 'Male', 25, '11', 'paciodrix@gmail.com', '3', '16', '1999', '095905', 'Single', 'Out of School Youth', '', 'Employed', 'High School Graduate', 'Registered', 'Yes', 'Yes', 'Yes', 0, '', '', '18'),
(65, 'Moore', 'Willie', 'William', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '31', 'Male', 30, '0', 'jeremyhenry@thompson-paul.com', '8', '2', '1994', '001-848-456-0386x550', 'Single', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'Master Graduate', 'Registered', 'No', '', 'No', 0, '0', '5/3/2024', '18');

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

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `title`, `description`, `start_date`, `end_date`, `url`) VALUES
(3, 'hyra', 'hyra', '2024-07-18 23:44:00', '2024-07-19 23:44:00', NULL);

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
  `house_number` varchar(3) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `youth_with_needs` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birth_month` varchar(20) DEFAULT NULL,
  `birth_day` varchar(20) DEFAULT NULL,
  `birth_year` varchar(20) DEFAULT NULL,
  `contactnumber` varchar(20) DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `youth_classification` varchar(50) DEFAULT NULL,
  `age_group` varchar(50) DEFAULT NULL,
  `work_status` varchar(50) DEFAULT NULL,
  `educational_background` varchar(50) DEFAULT NULL,
  `register_sk_voter` varchar(50) DEFAULT NULL,
  `voted_last_election` varchar(3) DEFAULT NULL,
  `national_voter` varchar(50) DEFAULT NULL,
  `attended_kk` varchar(3) DEFAULT NULL,
  `times_attended_kk` int(11) DEFAULT NULL,
  `no_why` varchar(100) DEFAULT NULL,
  `date_created` varchar(50) DEFAULT NULL,
  `barangay_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `sitio`, `purok`, `house_number`, `sex`, `age`, `youth_with_needs`, `email`, `birth_month`, `birth_day`, `birth_year`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `register_sk_voter`, `voted_last_election`, `national_voter`, `attended_kk`, `times_attended_kk`, `no_why`, `date_created`, `barangay_code`) VALUES
(1, 'Williams', 'James', 'Carla', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', 'a', '1', '17', 'Male', 18, '0', 'john80@hotmail.com', '1', '10', '2006', '+1-124-538-3865x5254', 'Divorced', 'Working Youth', 'Core Youth', 'Self-Employed', 'Doctorate Level', 'Not Registered', 'No', '', 'No', 0, '0', '2/9/2024', '3'),
(2, 'Jones', 'Margaret', 'Robert', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '17', 'Male', 28, '0', 'victoria82@brown.com', '12', '14', '1996', '(156)428-4910x043', 'Divorced', 'In School Youth', 'Young Adult', 'Currently looking for job', 'Vocational Graduate', 'Registered', 'Yes', '', 'No', 0, '0', '3/13/2024', '4'),
(4, 'Henderson', 'Johnathan', 'Charlene', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '4', 'Male', 23, '0', 'rebeccabernard@ramirez.com', '4', '3', '2001', '396-800-7727x9648', 'Single', 'Working Youth', 'Core Youth', 'Employed', 'Vocational Graduate', 'Not Registered', 'No', '', 'No', 0, '0', '6/14/2024', '6'),
(5, 'Perez', 'Ricardo', 'Michael', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '62', 'Male', 21, '0', 'higginseugene@bautista-jones.net', '12', '20', '2003', '(234)602-5521x659', 'Single', 'Person With Disability (PWD)', 'Core Youth', 'Unemployed', 'Elementary Graduate', 'Registered', 'No', '', 'Yes', 2, '0', '1/11/2024', '3'),
(6, 'Holder', 'Eric', 'Joanna', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '98', 'Male', 22, '0', 'vterry@jones.com', '1', '24', '2002', '001-504-632-5612x996', 'Single', 'Person With Disability (PWD)', 'Core Youth', 'Student', 'College Graduate', 'Registered', 'No', '', 'Yes', 5, '0', '2/27/2024', '4'),
(8, 'Jones', 'Brandon', 'Sarah', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '46', 'Female', 28, '0', 'williampatton@chavez.com', '11', '9', '1996', '987.173.6228', 'Married', 'Person With Disability (PWD)', 'Young Adult', 'Student', 'Master Graduate', 'Registered', 'Yes', '', 'Yes', 4, '0', '3/5/2024', '6'),
(9, 'Maynard', 'Erica', 'Joshua', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '57', 'Male', 16, '0', 'kathleen87@hotmail.com', '2', '5', '2008', '973.553.4509x39552', 'Single', 'Person With Disability (PWD)', 'Child Youth', 'Student', 'Elementary Graduate', 'Registered', 'Yes', '', 'No', 0, '0', '1/19/2024', '7'),
(10, 'Scott', 'Bonnie', 'Shannon', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '34', 'Female', 25, '0', 'hward@york-martin.org', '4', '28', '1999', '5345590189', 'Single', 'Working Youth', 'Young Adult', 'Currently looking for job', 'Vocational Graduate', 'Not Registered', 'Yes', '', 'Yes', 4, '0', '3/11/2024', '7'),
(11, 'Long', 'Martin', 'Mark', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '57', 'Female', 19, '0', 'sheliamccullough@king.biz', '10', '13', '2005', '-4759', 'Divorced', 'Out Of School Youth', 'Core Youth', 'Unemployed', 'College Graduate', 'Not Registered', 'No', '', 'Yes', 3, '0', '2/3/2024', '8'),
(12, 'Lam', 'Tonya', 'Michelle', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '7', '98', 'Female', 28, '0', 'brandon38@yahoo.com', '1', '26', '1996', '179-115-9857x40867', 'Married', 'Person With Disability (PWD)', 'Young Adult', 'Unemployed', 'College Graduate', 'Registered', 'Yes', '', 'No', 0, '0', '3/2/2024', '9'),
(13, 'Martinez', 'Blake', 'Deborah', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '78', 'Male', 20, '0', 'christine91@gardner.com', '4', '14', '2004', '001-817-755-9015x375', 'Married', 'Working Youth', 'Core Youth', 'Unemployed', 'High School Level', 'Registered', 'Yes', '', 'Yes', 4, '0', '3/7/2024', '3'),
(14, 'Martinez', 'Peggy', 'Bradley', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '14', 'Male', 15, '0', 'griffinthomas@carter-gibson.com', '6', '25', '2009', '001-927-602-7872x840', 'Divorced', 'Out Of School Youth', 'Child Youth', 'Employed', 'College Graduate', 'Not Registered', 'Yes', '', 'Yes', 2, '0', '2/19/2024', '4'),
(16, 'Cunningham', 'Taylor', 'Timothy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '9', 'Female', 27, '0', 'xgeorge@webb-smith.com', '10', '15', '1997', '731-430-1687', 'Widowed', 'Working Youth', 'Young Adult', 'Unemployed', 'High School Graduate', 'Registered', 'No', '', 'Yes', 4, '0', '1/4/2024', '6'),
(17, 'Anderson', 'Michael', 'Tina', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '70', 'Female', 25, '0', 'wnguyen@hotmail.com', '6', '16', '1999', '+1-845-094-9996x0250', 'Widowed', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'Master Graduate', 'Registered', 'No', '', 'No', 0, '0', '7/8/2024', '7'),
(18, 'Diaz', 'Bradley', 'Raymond', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '96', 'Male', 24, '0', 'freemanryan@johnson.com', '5', '20', '2000', '(710)866-6768x340', 'Divorced', 'Working Youth', 'Core Youth', 'Employed', 'Master Level', 'Registered', 'Yes', '', 'Yes', 3, '0', '2/27/2024', '8'),
(19, 'Blevins', 'Jamie', 'Samantha', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '93', 'Female', 23, '0', 'heatherlane@yahoo.com', '9', '12', '2001', '3490453794', 'Widowed', 'Out Of School Youth', 'Core Youth', 'Unemployed', 'High School Level', 'Not Registered', 'Yes', '', 'Yes', 4, '0', '5/3/2024', '9'),
(20, 'Murillo', 'Mary', 'Jennifer', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '37', 'Male', 24, '0', 'xhorton@hotmail.com', '7', '6', '2000', '582.634.8896x7999', 'Widowed', 'In School Youth', 'Core Youth', 'Self-Employed', 'College Graduate', 'Registered', 'Yes', '', 'Yes', 4, '0', '3/21/2024', '10'),
(21, 'Medina', 'Lawrence', 'Danielle', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '22', 'Female', 29, '0', 'jasongutierrez@trevino.com', '2', '12', '1995', '157-565-8649x90361', 'Single', 'Person With Disability (PWD)', 'Young Adult', 'Unemployed', 'Master Graduate', 'Registered', 'Yes', '', 'No', 0, '0', '1/26/2024', '11'),
(22, 'Hart', 'Valerie', 'Matthew', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '14', 'Female', 18, '0', 'bryanmorgan@wilson-richardson.com', '8', '31', '2006', '610.092.0950x7554', 'Married', 'Out Of School Youth', 'Core Youth', 'Student', 'Elementary Level', 'Registered', 'No', '', 'No', 0, '0', '3/21/2024', '12'),
(23, 'Wright', 'Laura', 'Brianna', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '7', '70', 'Male', 24, '0', 'bjohnson@yahoo.com', '5', '20', '2000', '(441)425-6698x97435', 'Married', 'Out Of School Youth', 'Core Youth', 'Student', 'High School Level', 'Registered', 'No', '', 'No', 0, '0', '1/23/2024', '14'),
(24, 'Meyer', 'Keith', 'Michael', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '90', 'Male', 28, '0', 'kevinspencer@hotmail.com', '3', '20', '1996', '(972)179-2085x949', 'Widowed', 'In School Youth', 'Young Adult', 'Student', 'High School Level', 'Not Registered', 'Yes', '', 'Yes', 5, '0', '2/28/2024', '13'),
(25, 'Kelly', 'Linda', 'Vanessa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '11', 'Female', 24, '0', 'floresrenee@acosta.org', '11', '25', '2000', '001-097-730-2044x834', 'Single', 'In School Youth', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', '', 'Yes', 1, '0', '1/16/2024', '15'),
(26, 'Diaz', 'Beth', 'Michael', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '79', 'Female', 28, '0', 'pamelathornton@shaw.com', '1', '12', '1996', '001-252-283-9786x962', 'Widowed', 'Out Of School Youth', 'Young Adult', 'Student', 'High School Graduate', 'Registered', 'Yes', '', 'No', 0, '0', '5/14/2024', '16'),
(27, 'Sullivan', 'Toni', 'Jay', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '36', 'Male', 23, '0', 'davidpayne@dixon-reyes.info', '2', '18', '2001', '911.166.1790', 'Married', 'In School Youth', 'Core Youth', 'Student', 'Elementary Graduate', 'Not Registered', 'No', '', 'Yes', 1, '0', '2/21/2024', '17'),
(28, 'Ponce', 'Sara', 'Sarah', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '61', 'Male', 15, '0', 'nnicholson@hawkins.com', '1', '10', '2009', '596-749-8710', 'Widowed', 'Person With Disability (PWD)', 'Child Youth', 'Currently looking for job', 'College Graduate', 'Not Registered', 'Yes', '', 'No', 0, '0', '5/24/2024', '18'),
(30, 'Jones', 'Andrew', 'James', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '81', 'Female', 25, '0', 'foxbruce@gmail.com', '3', '27', '1999', '225.656.5708', 'Single', 'Person With Disability (PWD)', 'Young Adult', 'Employed', 'Master Level', 'Not Registered', 'Yes', '', 'Yes', 3, '0', '1/4/2024', '6'),
(31, 'Ramirez', 'Patricia', 'Brandon', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '45', 'Male', 30, '0', 'tracy74@gmail.com', '1', '2', '1994', '997.652.6140x893', 'Divorced', 'In School Youth', 'Young Adult', 'Unemployed', 'Elementary Level', 'Not Registered', 'No', '', 'No', 0, '0', '1/31/2024', '7'),
(32, 'Evans', 'Brandy', 'Lindsey', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '31', 'Male', 22, '0', 'zpaul@gmail.com', '9', '22', '2002', '925.563.8156', 'Married', 'Person With Disability (PWD)', 'Core Youth', 'Currently looking for job', 'Master Level', 'Registered', 'No', '', 'Yes', 3, '0', '6/12/2024', '8'),
(33, 'Higgins', 'Jason', 'Curtis', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '49', 'Male', 28, '0', 'nmendoza@schneider.info', '10', '12', '1996', '+1-685-948-5839x5006', 'Divorced', 'Out Of School Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', '', 'Yes', 4, '0', '4/25/2024', '9'),
(34, 'Smith', 'Julia', 'Jessica', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '72', 'Male', 15, '0', 'ryananderson@hotmail.com', '6', '11', '2009', '2587170106', 'Married', 'Working Youth', 'Child Youth', 'Unemployed', 'Elementary Graduate', 'Registered', 'No', '', 'Yes', 5, '0', '1/1/2024', '7'),
(35, 'Hernandez', 'Maria', 'Kelly', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '67', 'Female', 18, '0', 'ellenwilliams@yahoo.com', '3', '20', '2006', '789-601-6091', 'Divorced', 'In School Youth', 'Core Youth', 'Currently looking for job', 'High School Graduate', 'Not Registered', 'No', '', 'Yes', 3, '0', '3/5/2024', '6'),
(37, 'Hunt', 'Claudia', 'Michael', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '8', 'Female', 23, '0', 'ashley83@hotmail.com', '5', '8', '2001', '001-614-148-8905', 'Single', 'Working Youth', 'Core Youth', 'Unemployed', 'High School Level', 'Not Registered', 'Yes', '', 'Yes', 4, '0', '3/27/2024', '4'),
(38, 'Smith', 'Amy', 'William', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '8', 'Male', 25, '0', 'peter03@schmidt.com', '11', '28', '1999', '888-100-1822', 'Single', 'Working Youth', 'Young Adult', 'Employed', 'College Level', 'Registered', 'No', '', 'Yes', 2, '0', '1/22/2024', '3'),
(39, 'Murphy', 'Tina', 'Keith', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '61', 'Female', 16, '0', 'norrisnancy@gmail.com', '1', '8', '2008', '001-905-802-4467x149', 'Widowed', 'Person With Disability (PWD)', 'Child Youth', 'Self-Employed', 'College Graduate', 'Registered', 'Yes', '', 'Yes', 4, '0', '5/18/2024', '4'),
(41, 'Mendoza', 'Tracy', 'Glenn', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '99', 'Female', 21, '0', 'marygeorge@yahoo.com', '5', '30', '2003', '-6764', 'Single', 'Working Youth', 'Core Youth', 'Student', 'Elementary Level', 'Registered', 'Yes', '', 'No', 0, '0', '3/4/2024', '6'),
(42, 'Green', 'Katie', 'Gary', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '62', 'Female', 29, '0', 'ryanlarsen@hotmail.com', '11', '2', '1995', '8967372437', 'Married', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'College Graduate', 'Registered', 'No', '', 'Yes', 4, '0', '1/19/2024', '8'),
(44, 'Ashley', 'Stephanie', 'Jeremy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '45', 'Male', 30, '0', 'slee@yahoo.com', '6', '19', '1994', '-5901', 'Married', 'Out Of School Youth', 'Young Adult', 'Unemployed', 'Doctorate Level', 'Registered', 'Yes', '', 'No', 0, '0', '3/14/2024', '8'),
(45, 'Beck', 'Chad', 'Jeremy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '62', 'Female', 22, '0', 'cgoodman@yahoo.com', '9', '3', '2002', '+1-169-444-4817x1516', 'Single', 'In School Youth', 'Core Youth', 'Unemployed', 'Vocational Graduate', 'Registered', 'No', '', 'No', 0, '0', '4/20/2024', '7'),
(46, 'Garcia', 'Megan', 'Richard', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '14', 'Female', 19, '0', 'toniduncan@james.com', '7', '20', '2005', '+1-936-886-9980x4738', 'Single', 'Working Youth', 'Core Youth', 'Self-Employed', 'Master Graduate', 'Registered', 'Yes', '', 'Yes', 2, '0', '5/29/2024', '6'),
(48, 'Porter', 'Donna', 'Eric', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '26', 'Female', 18, '0', 'angelalambert@yahoo.com', '9', '21', '2006', '061-036-1295x8853', 'Widowed', 'Working Youth', 'Core Youth', 'Currently looking for job', 'Doctorate Level', 'Not Registered', 'Yes', '', 'Yes', 4, '0', '4/10/2024', '4'),
(49, 'Briggs', 'Richard', 'Lisa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '81', 'Male', 27, '0', 'gshelton@williams.org', '1', '31', '1997', '6575159976', 'Married', 'Person With Disability (PWD)', 'Young Adult', 'Unemployed', 'Master Graduate', 'Not Registered', 'Yes', '', 'No', 0, '0', '6/10/2024', '3'),
(50, 'Young', 'Sierra', 'Wyatt', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '40', 'Male', 17, '0', 'dray@hotmail.com', '7', '13', '2007', '(579)962-5007x7872', 'Married', 'Out Of School Youth', 'Child Youth', 'Student', 'High School Level', 'Registered', 'No', '', 'No', 0, '0', '2/13/2024', '10'),
(51, 'Estrada', 'Jacqueline', 'Theresa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '7', 'Female', 26, '0', 'hugheslauren@mejia.com', '9', '14', '1998', '+1-216-252-9218x800', 'Widowed', 'Working Youth', 'Young Adult', 'Currently looking for job', 'Master Graduate', 'Not Registered', 'Yes', '', 'Yes', 4, '0', '6/20/2024', '11'),
(52, 'Henderson', 'Kathleen', 'Ellen', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '40', 'Female', 19, '0', 'twarren@gmail.com', '12', '27', '2005', '132.225.5391', 'Widowed', 'In School Youth', 'Core Youth', 'Currently looking for job', 'Vocational Graduate', 'Not Registered', 'Yes', '', 'No', 0, '0', '3/6/2024', '12'),
(53, 'Sherman', 'Rebecca', 'Oscar', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '95', 'Male', 22, '0', 'wsmith@fry.info', '3', '14', '2002', '-7763', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', '', 'Yes', 2, '0', '1/1/2024', '13'),
(54, 'Perez', 'Heather', 'Amanda', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '6', 'Female', 23, '0', 'etaylor@sparks.com', '6', '26', '2001', '-4929', 'Divorced', 'In School Youth', 'Core Youth', 'Self-Employed', 'College Level', 'Not Registered', 'Yes', '', 'Yes', 3, '0', '7/8/2024', '14'),
(55, 'Adams', 'Debbie', 'Antonio', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '63', 'Male', 19, '0', 'joseph42@holland.net', '10', '21', '2005', '-7698', 'Married', 'Person With Disability (PWD)', 'Core Youth', 'Student', 'Vocational Graduate', 'Registered', 'Yes', '', 'Yes', 3, '0', '4/28/2024', '15'),
(56, 'Cooper', 'William', 'Julia', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '36', 'Male', 26, '0', 'brett60@yahoo.com', '1', '5', '1998', '577-327-3351', 'Single', 'Out Of School Youth', 'Young Adult', 'Employed', 'College Level', 'Not Registered', 'No', '', 'No', 0, '0', '4/28/2024', '16'),
(57, 'Coleman', 'Ruth', 'Jennifer', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '12', 'Female', 29, '0', 'jessica20@rodriguez-lee.com', '3', '21', '1995', '001-422-810-1867x032', 'Married', 'Working Youth', 'Young Adult', 'Self-Employed', 'College Level', 'Not Registered', 'No', '', 'Yes', 5, '0', '3/18/2024', '17'),
(58, 'Knox', 'Kimberly', 'Dylan', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '44', 'Female', 25, '0', 'samuel14@gmail.com', '2', '27', '1999', '001-002-201-8965', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'High School Level', 'Registered', 'Yes', '', 'No', 0, '0', '4/9/2024', '16'),
(59, 'Arnold', 'Michael', 'Jacqueline', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '40', 'Male', 19, '0', 'jessica77@marshall.org', '8', '18', '2005', '(189)604-3912x5460', 'Single', 'Working Youth', 'Core Youth', 'Self-Employed', 'Master Graduate', 'Not Registered', 'No', '', 'No', 0, '0', '5/2/2024', '15'),
(60, 'Flores', 'Natasha', 'Nathaniel', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '82', 'Female', 28, '0', 'allen55@grant.com', '2', '23', '1996', '001-544-939-7623x101', 'Widowed', 'Person With Disability (PWD)', 'Young Adult', 'Unemployed', 'High School Graduate', 'Registered', 'No', '', 'Yes', 4, '0', '2/7/2024', '14'),
(61, 'Carroll', 'Gabriella', 'Luis', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '41', 'Female', 22, '0', 'keith00@walker-vasquez.com', '11', '26', '2002', '9068773997', 'Widowed', 'Working Youth', 'Core Youth', 'Unemployed', 'College Level', 'Not Registered', 'No', '', 'No', 0, '0', '1/18/2024', '18'),
(62, 'Wise', 'Craig', 'Yvonne', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '55', 'Female', 16, '0', 'dale32@hotmail.com', '9', '6', '2008', '150.431.1434x4035', 'Divorced', 'Out Of School Youth', 'Child Youth', 'Employed', 'Master Graduate', 'Not Registered', 'No', '', 'No', 0, '0', '4/5/2024', '18'),
(63, 'Evans', 'Luis', 'Brad', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '43', 'Female', 22, '0', 'kyoung@gmail.com', '12', '27', '2002', '001-675-337-7965', 'Widowed', 'Working Youth', 'Core Youth', 'Unemployed', 'Doctorate Level', 'Registered', 'No', '', 'Yes', 5, '0', '6/11/2024', '18'),
(64, 'Rose', 'Krista', 'James', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '83', 'Male', 20, '0', 'tmorse@daniels-williams.com', '2', '8', '2004', '584-592-6835x8808', 'Widowed', 'Person With Disability (PWD)', 'Core Youth', 'Unemployed', 'Master Graduate', 'Not Registered', 'No', '', 'Yes', 2, '0', '7/5/2024', '17'),
(65, 'Castro', 'William', 'Samuel', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '19', 'Male', 16, '0', 'rochasusan@hotmail.com', '8', '20', '2008', '573-235-6306x758', 'Married', 'In School Youth', 'Child Youth', 'Unemployed', 'Doctorate Level', 'Registered', 'Yes', '', 'Yes', 2, '0', '3/12/2024', '16'),
(66, 'Love', 'Melissa', 'Paul', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '33', 'Male', 28, '0', 'zbray@yahoo.com', '10', '1', '1996', '-2228', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Currently looking for job', 'College Level', 'Registered', 'Yes', '', 'No', 0, '0', '4/20/2024', '15'),
(67, 'Ross', 'Nicholas', 'Steven', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '40', 'Male', 26, '0', 'vjohnson@sellers.com', '10', '31', '1998', '794-701-6076', 'Married', 'Out Of School Youth', 'Young Adult', 'Employed', 'Elementary Level', 'Registered', 'No', '', 'Yes', 4, '0', '3/7/2024', '14'),
(68, 'Johnson', 'Joyce', 'Jamie', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '77', 'Female', 23, '0', 'williamsstephanie@cortez.com', '6', '15', '2001', '688-708-4427', 'Widowed', 'In School Youth', 'Core Youth', 'Employed', 'High School Level', 'Not Registered', 'Yes', '', 'No', 0, '0', '1/28/2024', '13'),
(69, 'Heath', 'Ryan', 'Michelle', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '28', 'Male', 27, '0', 'warellano@hotmail.com', '4', '9', '1997', '001-585-360-8261x033', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'College Graduate', 'Not Registered', 'No', '', 'Yes', 3, '0', '2/8/2024', '12'),
(70, 'King', 'Michelle', 'Sarah', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '52', 'Male', 28, '0', 'anna39@hotmail.com', '3', '15', '1996', '7406195691', 'Widowed', 'In School Youth', 'Young Adult', 'Employed', 'Elementary Graduate', 'Not Registered', 'Yes', '', 'No', 0, '0', '1/16/2024', '12'),
(71, 'Sweeney', 'Mark', 'Kelly', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '60', 'Female', 23, '0', 'xhayes@yahoo.com', '1', '13', '2001', '415.882.1459', 'Widowed', 'Person With Disability (PWD)', 'Core Youth', 'Unemployed', 'High School Graduate', 'Not Registered', 'Yes', '', 'Yes', 5, '0', '2/9/2024', '11'),
(79, 'Melendez', 'Katherine', 'Gregory', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '57', 'Female', 29, '0', 'ricardo13@gmail.com', '4', '22', '1995', '811-598-2327', 'Widowed', 'Working Youth', 'Young Adult', 'Student', 'High School Graduate', 'Not Registered', 'Yes', '', 'Yes', 3, '0', '1/13/2024', '3'),
(143, 'Montoya', 'Brian', 'Sean', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '30', 'Female', 25, '0', 'jordan10@gmail.com', '9', '22', '1999', '(790)250-8254x726', 'Single', 'In School Youth', 'Young Adult', 'Currently looking for job', 'Vocational Graduate', 'Not Registered', 'Yes', '', 'No', 0, '0', '5/6/2024', '15'),
(144, 'Thompson', 'Monica', 'Autumn', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '13', 'Female', 17, '0', 'ginadavis@gmail.com', '2', '6', '2007', '-11080', 'Widowed', 'Working Youth', 'Child Youth', 'Self-Employed', 'Vocational Graduate', 'Not Registered', 'Yes', '', 'Yes', 3, '0', '5/26/2024', '16'),
(145, 'Martinez', 'Ronald', 'William', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '7', '', 'Male', 20, '', 'johnbrown@gmail.com', '11', '13', '2004', '778.066.0439x50263', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Registered', 'No', '', 'Yes', 3, '', '2/6/2024', ''),
(146, 'Myers', 'Melissa', 'Daniel', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '85', 'Male', 29, '0', 'ribarra@hotmail.com', '4', '24', '1995', '+1-367-196-0117x9726', 'Widowed', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'Doctorate Level', 'Registered', 'No', '', 'No', 0, '0', '4/19/2024', '7'),
(154, 'Kennedy', 'April', 'Priscilla', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '7', '', 'Female', 21, '', 'cardenasaaron@gmail.com', '1', '28', '2003', '914.439.2469x2991', 'Divorced', 'Person With Disability (PWD)', 'Core Youth', 'Self-Employed', 'Master Level', 'Not Registered', 'No', '', 'No', 0, '', '1/25/2024', ''),
(171, 'Gates', 'Laura', 'Scott', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '43', 'Male', 18, '0', 'wjones@murphy-davis.net', '11', '28', '2006', '(862)742-3789', 'Single', 'In School Youth', 'Core Youth', 'Currently looking for job', 'Elementary Level', 'Not Registered', 'No', '', 'No', 0, '0', '1/30/2024', '5'),
(172, 'Woodward', 'William', 'James', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', 'n/a', '8', '39', 'Male', 20, '0', 'mariafoster@acosta.net', '6', '12', '2004', '001-873-704-9011x863', 'Widowed', 'Working Youth', 'Core Youth', 'Employed', 'College Graduate', 'Registered', 'No', 'Yes', 'No', 0, '0', '6/29/2024', '5'),
(173, 'Leonard', 'John', 'Juan', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', 'n/a', '3', '3', 'Male', 21, '0', 'edwinconner@gmail.com', '2', '24', '2003', '(745)667-7755x342', 'Divorced', 'Out of School Youth', 'Core Youth', 'Employed', 'Elementary Graduate', 'Not Registered', 'Yes', 'Yes', 'Yes', 5, '0', '4/15/2024', '5'),
(174, 'Hart', 'Samuel', 'Elizabeth', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '34', 'Female', 25, '0', 'larsonkelly@wolf.com', '4', '14', '1999', '832.434.7911x08551', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'Doctorate Level', 'Not Registered', 'No', '', 'No', 0, '0', '1/11/2024', '5'),
(175, 'Baker', 'Scott', 'Christopher', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '50', 'Female', 18, '0', 'joneill@byrd.info', '10', '6', '2006', '(236)792-9138', 'Married', 'In School Youth', 'Core Youth', 'Student', 'High School Level', 'Not Registered', 'No', '', 'Yes', 3, '0', '1/3/2024', '5'),
(176, 'daw', 'daw', 'daw', 'da', 'CAR', 'Benguet', 'La Trinidad', '', 'awd', 'awd', 'awd', 'Female', 24, '', 'dwad@fe', '\r\n                  ', '\r\n                  ', '2000', '123', 'Single', 'In School Youth', '', 'Student', 'Elementary Level', 'Not Registered', 'No', 'No', 'No', 0, '', NULL, '5'),
(177, 'a', 'a', 'a', 'a', 'CAR', 'Benguet', 'La Trinidad', '', 'a', 'a', 'a', 'Female', 24, '', 'a@a', '\r\n                  ', '\r\n                  ', '2000', '123', 'Single', 'In School Youth', '', 'Student', 'Elementary Level', 'Not Registered', 'No', 'No', 'No', 0, '', NULL, '5'),
(178, 'x', 'x', 'x', 'x', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', 'x', 'x', 'x', 'Female', 24, '`x`', 'x@x', '\r\n                  ', '\r\n                  ', '2000', 'x', 'Widowed', 'Out Of School Youth', '', 'Unemployed', 'High School Graduate', 'Registered', 'Yes', 'Yes', 'Yes', 0, '', NULL, '5'),
(179, 'Ahihi', 'Ahihi', 'Ahihi', 'Ahihi', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', 'kalbo', '123123', '123', 'Female', 24, '', 'asd@asdzxc', '\r\n                  ', '\r\n                  ', '2000', '123123123', 'Single', 'In School Youth', '', 'Unemployed', 'Elementary Level', 'Not Registered', 'No', 'No', 'No', 0, '', NULL, '5'),
(180, 'asdasdasdas', 'asdasdasdas', 'asdasdasdas', '', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', 'asdasdasdas', 'asdasdasdas', 'asd', 'Female', 24, 'asdasdasdas', 'asdasdasdas@asdasdasdas', '3', '19', '2000', '123123', 'Single', 'In Youth School', '', 'Employed', 'Doctorate Level', 'Registered', 'Yes', 'Yes', 'Yes', 1, '', NULL, '5'),
(181, 'hehe', 'hehe', 'hehe', 'hehe', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', 'hehe', 'hehe', 'heh', 'Female', 24, 'hehe', 'hehe@hehe', '1', '18', '2000', '123123', 'Divorced', 'Out Of School Youth', '', 'Currently looking for job', 'High School Level', 'Not Registered', 'No', 'No', 'No', 0, '', NULL, '5'),
(182, 'vvvv', 'vvvv', 'vvvv', 'vvvv', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', 'vvvv', 'vvvv', 'vvv', 'Male', 24, '', 'vvvv@vvvv', '1', '17', '2000', '1231', 'Divorced', 'Working Youth', '', 'Employed', 'Master Graduate', 'Not Registered', 'No', 'No', 'No', 0, '', NULL, '5'),
(183, 'mmmmm', 'mmmmm', 'mmmmm', 'mmmmm', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', 'mmmmm', 'mmmmm', 'mmm', 'Female', 0, 'mmmmm', 'mmmmm@mmmmm', '2', '18', '2000', '123123123', 'Widowed', 'Out Of School Youth', '', 'Currently looking for job', 'Elementary Level', 'Not Registered', 'No', 'No', 'No', 0, '', NULL, '5'),
(185, 'name', 'last', 'asdas', 'a', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', 'n/a', '6', '564', 'Male', 24, '6565', '56446@uyfgh', '6', '18', '2000', '9+585', 'Married', 'Out of School Youth', '', 'Employed', 'High School Graduate', 'Registered', 'Yes', 'Yes', 'Yes', 0, '', NULL, '5'),
(186, 'kojm', 'uijk', 'uyg', 'hyj', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', 'uh', 'hjb', 'uy', 'Male', 24, '6565', '56446@uyfgh', '3', '18', '2000', '65165456165', 'Married', 'Out of School Youth', '', 'Unemployed', 'Elementary Graduate', 'Registered', 'Yes', 'Yes', 'Yes', 0, '', NULL, '5'),
(187, 'sadasd', 'asdasdasd', 'dasasdasdas', 'asdfafdads', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', '21312312', '21312312', '312', 'Male', 24, '21312312412', 'asdasd@agagas', '3', '17', '2000', '213123214124124', 'Married', 'Out of School Youth', '', 'Unemployed', 'High School Level', 'Registered', 'Yes', 'Yes', 'Yes', 0, '', NULL, '5'),
(188, 'hexxx', 'efwgwg', 'fqfefe', 'jee', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', '21312312', '21312312', '312', 'Female', 24, '21312312412', 'asdasd@agagas', '1', '5', '2000', '213123214124124', 'Single', 'In School Youth', '', 'Student', 'Elementary Graduate', 'Registered', 'Yes', 'Yes', 'Yes', 0, '', NULL, '5'),
(189, 'hexxxr3qq3', 'efwgwgf3w', 'fqfefefwqf', 'jeeqr3', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', '21312312', '21312312', '312', 'Female', 0, '21312312412', 'asdasd@agagas', 'month', 'day', '2000', '213123214124124', 'Divorced', 'Person With Disability (PWD)', '', 'Student', 'College Level', 'Registered', 'Yes', 'Yes', 'Yes', 33, '', NULL, '5'),
(190, 'fwwqwfwfwfw', 'efwgwgf3w', 'fqfefefwqf', 'jeeqr3wfffwf', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', '21312312', '21312312', '312', 'Female', 0, '21312312412', 'asdasd@agagas', 'month', 'day', '2000', '213123214124124', 'Divorced', 'Working Youth', '', 'Self-Employed', 'Doctorate Level', 'Registered', 'Yes', 'No', 'No', 33, '', NULL, '5'),
(191, 'fwwqwfwfwfw', 'efwgwgf3w', 'fqfefefwqf', 'jeeqr3wfffwf', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', '21312312', '21312312', '312', 'Female', 0, '21312312412', 'asdasd@agagas', 'month', 'day', '2000', '213123214124124', 'Divorced', 'Out Of School Youth', '', 'Unemployed', 'Elementary Level', 'Registered', 'Yes', 'No', 'Yes', 33, '', NULL, '5'),
(192, 'asdatwe4tggwew', 'asdasdasd', 'asdas', 'jeeqr3wfffwf', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', '21312312', '21312312', '312', 'Male', 0, '21312312412', 'asdasd@agagas', 'month', 'day', '2000', '213123214124124', 'Divorced', 'In School Youth', '', 'Self-Employed', 'College Level', 'Registered', 'Yes', 'No', 'Yes', 33, '', NULL, '5'),
(194, 'gatarin', 'rhoed', 'qwe', 'asdfafdads', 'CAR', 'Benguet', 'La Trinidad', 'Ambiong', 'asd', '123123', '123', 'Male', 24, 'awan', 'awan@awan', '3', '19', '2000', '41512512', 'Divorced', 'Working Youth', 'Core Youth', 'Employed', 'High School Level', 'Registered', 'Yes', 'Yes', 'No', 0, '', '', '5');

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
  `house_number` varchar(10) DEFAULT NULL,
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
  `voted_last_election` varchar(3) DEFAULT NULL,
  `national_voter` varchar(100) DEFAULT NULL,
  `attended_kk` varchar(3) DEFAULT NULL,
  `times_attended_kk` int(11) DEFAULT NULL,
  `no_why` varchar(100) DEFAULT NULL,
  `date_created` varchar(50) DEFAULT NULL,
  `barangay_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles_archive`
--

INSERT INTO `profiles_archive` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `sitio`, `purok`, `house_number`, `sex`, `age`, `youth_with_needs`, `email`, `birth_month`, `birth_day`, `birth_year`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `register_sk_voter`, `voted_last_election`, `national_voter`, `attended_kk`, `times_attended_kk`, `no_why`, `date_created`, `barangay_code`) VALUES
(124, 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', NULL, 'asd', NULL, 'Male', 35, NULL, 'z@z', '3', '18', '1989', '123', 'Married', 'In Youth School', '', 'Unemployed', 'Elementary Graduate', 'No', 'No', NULL, 'No', 0, NULL, '', NULL),
(125, 'Johnson', 'Alejandro', 'Charlotte', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', NULL, '8', NULL, 'Female', 34, NULL, 'christopher72@anderson.com', '1', '2', '1990', '9993381872', 'Married', 'SK Official', 'Young Adult', 'Unemployed', 'Elementary', '', 'Yes', NULL, '', 0, NULL, '05/27/24', NULL);

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
  `house_number` varchar(3) NOT NULL,
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

INSERT INTO `profiles_backup` (`id`, `lname`, `fname`, `mname`, `suffix`, `region`, `province`, `municipality`, `barangay`, `sitio`, `purok`, `house_number`, `sex`, `age`, `youth_with_needs`, `email`, `birth_month`, `birth_day`, `birth_year`, `contactnumber`, `civil_status`, `youth_classification`, `age_group`, `work_status`, `educational_background`, `register_sk_voter`, `voted_last_election`, `national_voter`, `attended_kk`, `times_attended_kk`, `no_why`, `date_created`, `barangay_code`) VALUES
(1, 'Williams', 'James', 'Carla', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', 'a', '1', '17', 'Male', 18, '0', 'john80@hotmail.com', '1', '10', '2006', '+1-124-538-3865x5254', 'Divorced', 'Working Youth', 'Core Youth', 'Self-Employed', 'Doctorate Level', 'Not Registered', 'No', 0, 'No', 0, '0', '2/9/2024', '3'),
(2, 'Jones', 'Margaret', 'Robert', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '17', 'Male', 28, '0', 'victoria82@brown.com', '12', '14', '1996', '(156)428-4910x043', 'Divorced', 'In School Youth', 'Young Adult', 'Currently looking for job', 'Vocational Graduate', 'Registered', 'Yes', 0, 'No', 0, '0', '3/13/2024', '4'),
(3, 'Kim', 'Katie', 'Yolanda', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '7', '12', 'Male', 25, '0', 'mooreleslie@schmitt-jimenez.biz', '9', '24', '1999', '423-227-9171x50653', 'Single', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'High School Level', 'Registered', 'Yes', 0, 'No', 0, '0', '4/19/2024', '5'),
(4, 'Henderson', 'Johnathan', 'Charlene', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '4', 'Male', 23, '0', 'rebeccabernard@ramirez.com', '4', '3', '2001', '396-800-7727x9648', 'Single', 'Working Youth', 'Core Youth', 'Employed', 'Vocational Graduate', 'Not Registered', 'No', 0, 'No', 0, '0', '6/14/2024', '6'),
(5, 'Perez', 'Ricardo', 'Michael', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '62', 'Male', 21, '0', 'higginseugene@bautista-jones.net', '12', '20', '2003', '(234)602-5521x659', 'Single', 'Person With Disability (PWD)', 'Core Youth', 'Unemployed', 'Elementary Graduate', 'Registered', 'No', 0, 'Yes', 2, '0', '1/11/2024', '3'),
(6, 'Holder', 'Eric', 'Joanna', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '98', 'Male', 22, '0', 'vterry@jones.com', '1', '24', '2002', '001-504-632-5612x996', 'Single', 'Person With Disability (PWD)', 'Core Youth', 'Student', 'College Graduate', 'Registered', 'No', 0, 'Yes', 5, '0', '2/27/2024', '4'),
(7, 'Marshall', 'Gary', 'Martin', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '49', 'Female', 19, '0', 'carpenterjoseph@yahoo.com', '10', '18', '2005', '233.586.8603', 'Single', 'Person With Disability (PWD)', 'Core Youth', 'Employed', 'College Graduate', 'Registered', 'No', 0, 'Yes', 2, '0', '2/17/2024', '5'),
(8, 'Jones', 'Brandon', 'Sarah', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '46', 'Female', 28, '0', 'williampatton@chavez.com', '11', '9', '1996', '987.173.6228', 'Married', 'Person With Disability (PWD)', 'Young Adult', 'Student', 'Master Graduate', 'Registered', 'Yes', 0, 'Yes', 4, '0', '3/5/2024', '6'),
(9, 'Maynard', 'Erica', 'Joshua', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '57', 'Male', 16, '0', 'kathleen87@hotmail.com', '2', '5', '2008', '973.553.4509x39552', 'Single', 'Person With Disability (PWD)', 'Child Youth', 'Student', 'Elementary Graduate', 'Registered', 'Yes', 0, 'No', 0, '0', '1/19/2024', '7'),
(10, 'Scott', 'Bonnie', 'Shannon', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '34', 'Female', 25, '0', 'hward@york-martin.org', '4', '28', '1999', '5345590189', 'Single', 'Working Youth', 'Young Adult', 'Currently looking for job', 'Vocational Graduate', 'Not Registered', 'Yes', 0, 'Yes', 4, '0', '3/11/2024', '7'),
(11, 'Long', 'Martin', 'Mark', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '57', 'Female', 19, '0', 'sheliamccullough@king.biz', '10', '13', '2005', '-4759', 'Divorced', 'Out Of School Youth', 'Core Youth', 'Unemployed', 'College Graduate', 'Not Registered', 'No', 0, 'Yes', 3, '0', '2/3/2024', '8'),
(12, 'Lam', 'Tonya', 'Michelle', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '7', '98', 'Female', 28, '0', 'brandon38@yahoo.com', '1', '26', '1996', '179-115-9857x40867', 'Married', 'Person With Disability (PWD)', 'Young Adult', 'Unemployed', 'College Graduate', 'Registered', 'Yes', 0, 'No', 0, '0', '3/2/2024', '9'),
(13, 'Martinez', 'Blake', 'Deborah', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '78', 'Male', 20, '0', 'christine91@gardner.com', '4', '14', '2004', '001-817-755-9015x375', 'Married', 'Working Youth', 'Core Youth', 'Unemployed', 'High School Level', 'Registered', 'Yes', 0, 'Yes', 4, '0', '3/7/2024', '3'),
(14, 'Martinez', 'Peggy', 'Bradley', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '14', 'Male', 15, '0', 'griffinthomas@carter-gibson.com', '6', '25', '2009', '001-927-602-7872x840', 'Divorced', 'Out Of School Youth', 'Child Youth', 'Employed', 'College Graduate', 'Not Registered', 'Yes', 0, 'Yes', 2, '0', '2/19/2024', '4'),
(15, 'Little', 'Erin', 'Tonya', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '8', 'Male', 22, '0', 'ronaldtrevino@hill.com', '11', '5', '2002', '001-539-497-6149x106', 'Divorced', 'In School Youth', 'Core Youth', 'Self-Employed', 'College Graduate', 'Registered', 'Yes', 0, 'Yes', 5, '0', '6/8/2024', '5'),
(16, 'Cunningham', 'Taylor', 'Timothy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '9', 'Female', 27, '0', 'xgeorge@webb-smith.com', '10', '15', '1997', '731-430-1687', 'Widowed', 'Working Youth', 'Young Adult', 'Unemployed', 'High School Graduate', 'Registered', 'No', 0, 'Yes', 4, '0', '1/4/2024', '6'),
(17, 'Anderson', 'Michael', 'Tina', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '70', 'Female', 25, '0', 'wnguyen@hotmail.com', '6', '16', '1999', '+1-845-094-9996x0250', 'Widowed', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'Master Graduate', 'Registered', 'No', 0, 'No', 0, '0', '7/8/2024', '7'),
(18, 'Diaz', 'Bradley', 'Raymond', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '96', 'Male', 24, '0', 'freemanryan@johnson.com', '5', '20', '2000', '(710)866-6768x340', 'Divorced', 'Working Youth', 'Core Youth', 'Employed', 'Master Level', 'Registered', 'Yes', 0, 'Yes', 3, '0', '2/27/2024', '8'),
(19, 'Blevins', 'Jamie', 'Samantha', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '93', 'Female', 23, '0', 'heatherlane@yahoo.com', '9', '12', '2001', '3490453794', 'Widowed', 'Out Of School Youth', 'Core Youth', 'Unemployed', 'High School Level', 'Not Registered', 'Yes', 0, 'Yes', 4, '0', '5/3/2024', '9'),
(20, 'Murillo', 'Mary', 'Jennifer', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '37', 'Male', 24, '0', 'xhorton@hotmail.com', '7', '6', '2000', '582.634.8896x7999', 'Widowed', 'In School Youth', 'Core Youth', 'Self-Employed', 'College Graduate', 'Registered', 'Yes', 0, 'Yes', 4, '0', '3/21/2024', '10'),
(21, 'Medina', 'Lawrence', 'Danielle', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '22', 'Female', 29, '0', 'jasongutierrez@trevino.com', '2', '12', '1995', '157-565-8649x90361', 'Single', 'Person With Disability (PWD)', 'Young Adult', 'Unemployed', 'Master Graduate', 'Registered', 'Yes', 0, 'No', 0, '0', '1/26/2024', '11'),
(22, 'Hart', 'Valerie', 'Matthew', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '14', 'Female', 18, '0', 'bryanmorgan@wilson-richardson.com', '8', '31', '2006', '610.092.0950x7554', 'Married', 'Out Of School Youth', 'Core Youth', 'Student', 'Elementary Level', 'Registered', 'No', 0, 'No', 0, '0', '3/21/2024', '12'),
(23, 'Wright', 'Laura', 'Brianna', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '7', '70', 'Male', 24, '0', 'bjohnson@yahoo.com', '5', '20', '2000', '(441)425-6698x97435', 'Married', 'Out Of School Youth', 'Core Youth', 'Student', 'High School Level', 'Registered', 'No', 0, 'No', 0, '0', '1/23/2024', '14'),
(24, 'Meyer', 'Keith', 'Michael', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '90', 'Male', 28, '0', 'kevinspencer@hotmail.com', '3', '20', '1996', '(972)179-2085x949', 'Widowed', 'In School Youth', 'Young Adult', 'Student', 'High School Level', 'Not Registered', 'Yes', 0, 'Yes', 5, '0', '2/28/2024', '13'),
(25, 'Kelly', 'Linda', 'Vanessa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '11', 'Female', 24, '0', 'floresrenee@acosta.org', '11', '25', '2000', '001-097-730-2044x834', 'Single', 'In School Youth', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 0, 'Yes', 1, '0', '1/16/2024', '15'),
(26, 'Diaz', 'Beth', 'Michael', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '79', 'Female', 28, '0', 'pamelathornton@shaw.com', '1', '12', '1996', '001-252-283-9786x962', 'Widowed', 'Out Of School Youth', 'Young Adult', 'Student', 'High School Graduate', 'Registered', 'Yes', 0, 'No', 0, '0', '5/14/2024', '16'),
(27, 'Sullivan', 'Toni', 'Jay', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '36', 'Male', 23, '0', 'davidpayne@dixon-reyes.info', '2', '18', '2001', '911.166.1790', 'Married', 'In School Youth', 'Core Youth', 'Student', 'Elementary Graduate', 'Not Registered', 'No', 0, 'Yes', 1, '0', '2/21/2024', '17'),
(28, 'Ponce', 'Sara', 'Sarah', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '61', 'Male', 15, '0', 'nnicholson@hawkins.com', '1', '10', '2009', '596-749-8710', 'Widowed', 'Person With Disability (PWD)', 'Child Youth', 'Currently looking for job', 'College Graduate', 'Not Registered', 'Yes', 0, 'No', 0, '0', '5/24/2024', '18'),
(29, 'Stout', 'Sarah', 'Kristy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '78', 'Male', 25, '0', 'morandarlene@hotmail.com', '6', '19', '1999', '001-470-538-3778x352', 'Single', 'In School Youth', 'Young Adult', 'Student', 'Master Graduate', 'Not Registered', 'No', 0, 'Yes', 4, '0', '1/20/2024', '5'),
(30, 'Jones', 'Andrew', 'James', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '81', 'Female', 25, '0', 'foxbruce@gmail.com', '3', '27', '1999', '225.656.5708', 'Single', 'Person With Disability (PWD)', 'Young Adult', 'Employed', 'Master Level', 'Not Registered', 'Yes', 0, 'Yes', 3, '0', '1/4/2024', '6'),
(31, 'Ramirez', 'Patricia', 'Brandon', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '45', 'Male', 30, '0', 'tracy74@gmail.com', '1', '2', '1994', '997.652.6140x893', 'Divorced', 'In School Youth', 'Young Adult', 'Unemployed', 'Elementary Level', 'Not Registered', 'No', 0, 'No', 0, '0', '1/31/2024', '7'),
(32, 'Evans', 'Brandy', 'Lindsey', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '31', 'Male', 22, '0', 'zpaul@gmail.com', '9', '22', '2002', '925.563.8156', 'Married', 'Person With Disability (PWD)', 'Core Youth', 'Currently looking for job', 'Master Level', 'Registered', 'No', 0, 'Yes', 3, '0', '6/12/2024', '8'),
(33, 'Higgins', 'Jason', 'Curtis', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '49', 'Male', 28, '0', 'nmendoza@schneider.info', '10', '12', '1996', '+1-685-948-5839x5006', 'Divorced', 'Out Of School Youth', 'Young Adult', 'Self-Employed', 'Vocational Graduate', 'Registered', 'Yes', 0, 'Yes', 4, '0', '4/25/2024', '9'),
(34, 'Smith', 'Julia', 'Jessica', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '72', 'Male', 15, '0', 'ryananderson@hotmail.com', '6', '11', '2009', '2587170106', 'Married', 'Working Youth', 'Child Youth', 'Unemployed', 'Elementary Graduate', 'Registered', 'No', 0, 'Yes', 5, '0', '1/1/2024', '7'),
(35, 'Hernandez', 'Maria', 'Kelly', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '67', 'Female', 18, '0', 'ellenwilliams@yahoo.com', '3', '20', '2006', '789-601-6091', 'Divorced', 'In School Youth', 'Core Youth', 'Currently looking for job', 'High School Graduate', 'Not Registered', 'No', 0, 'Yes', 3, '0', '3/5/2024', '6'),
(36, 'Frank', 'Edward', 'Karen', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '96', 'Female', 16, '0', 'schmidtmelissa@rogers-riggs.com', '7', '6', '2008', '748.461.0796x530', 'Married', 'Person With Disability (PWD)', 'Child Youth', 'Self-Employed', 'High School Level', 'Registered', 'No', 0, 'Yes', 2, '0', '1/9/2024', '5'),
(37, 'Hunt', 'Claudia', 'Michael', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '8', 'Female', 23, '0', 'ashley83@hotmail.com', '5', '8', '2001', '001-614-148-8905', 'Single', 'Working Youth', 'Core Youth', 'Unemployed', 'High School Level', 'Not Registered', 'Yes', 0, 'Yes', 4, '0', '3/27/2024', '4'),
(38, 'Smith', 'Amy', 'William', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '8', 'Male', 25, '0', 'peter03@schmidt.com', '11', '28', '1999', '888-100-1822', 'Single', 'Working Youth', 'Young Adult', 'Employed', 'College Level', 'Registered', 'No', 0, 'Yes', 2, '0', '1/22/2024', '3'),
(39, 'Murphy', 'Tina', 'Keith', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '61', 'Female', 16, '0', 'norrisnancy@gmail.com', '1', '8', '2008', '001-905-802-4467x149', 'Widowed', 'Person With Disability (PWD)', 'Child Youth', 'Self-Employed', 'College Graduate', 'Registered', 'Yes', 0, 'Yes', 4, '0', '5/18/2024', '4'),
(40, 'Taylor', 'Mark', 'Angelica', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '64', 'Male', 30, '0', 'abrooks@hotmail.com', '11', '12', '1994', '(903)449-3825x659', 'Married', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'Elementary Level', 'Not Registered', 'Yes', 0, 'No', 0, '0', '5/7/2024', '5'),
(41, 'Mendoza', 'Tracy', 'Glenn', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '99', 'Female', 21, '0', 'marygeorge@yahoo.com', '5', '30', '2003', '-6764', 'Single', 'Working Youth', 'Core Youth', 'Student', 'Elementary Level', 'Registered', 'Yes', 0, 'No', 0, '0', '3/4/2024', '6'),
(42, 'Green', 'Katie', 'Gary', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '62', 'Female', 29, '0', 'ryanlarsen@hotmail.com', '11', '2', '1995', '8967372437', 'Married', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'College Graduate', 'Registered', 'No', 0, 'Yes', 4, '0', '1/19/2024', '8'),
(43, 'Brown', 'Michelle', 'Chelsea', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '47', 'Female', 23, '0', 'moorelori@marshall-gomez.com', '6', '4', '2001', '001-550-911-4974x815', 'Married', 'In School Youth', 'Core Youth', 'Employed', 'Elementary Graduate', 'Not Registered', 'Yes', 0, 'No', 0, '0', '4/16/2024', '9'),
(44, 'Ashley', 'Stephanie', 'Jeremy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '45', 'Male', 30, '0', 'slee@yahoo.com', '6', '19', '1994', '-5901', 'Married', 'Out Of School Youth', 'Young Adult', 'Unemployed', 'Doctorate Level', 'Registered', 'Yes', 0, 'No', 0, '0', '3/14/2024', '8'),
(45, 'Beck', 'Chad', 'Jeremy', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '62', 'Female', 22, '0', 'cgoodman@yahoo.com', '9', '3', '2002', '+1-169-444-4817x1516', 'Single', 'In School Youth', 'Core Youth', 'Unemployed', 'Vocational Graduate', 'Registered', 'No', 0, 'No', 0, '0', '4/20/2024', '7'),
(46, 'Garcia', 'Megan', 'Richard', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '14', 'Female', 19, '0', 'toniduncan@james.com', '7', '20', '2005', '+1-936-886-9980x4738', 'Single', 'Working Youth', 'Core Youth', 'Self-Employed', 'Master Graduate', 'Registered', 'Yes', 0, 'Yes', 2, '0', '5/29/2024', '6'),
(47, 'Schroeder', 'Jeff', 'Kevin', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '2', 'Female', 22, '0', 'chad47@yahoo.com', '8', '14', '2002', '131-528-7720x35977', 'Single', 'Person With Disability (PWD)', 'Core Youth', 'Currently looking for job', 'Elementary Graduate', 'Not Registered', 'No', 0, 'Yes', 1, '0', '3/15/2024', '5'),
(48, 'Porter', 'Donna', 'Eric', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '26', 'Female', 18, '0', 'angelalambert@yahoo.com', '9', '21', '2006', '061-036-1295x8853', 'Widowed', 'Working Youth', 'Core Youth', 'Currently looking for job', 'Doctorate Level', 'Not Registered', 'Yes', 0, 'Yes', 4, '0', '4/10/2024', '4'),
(49, 'Briggs', 'Richard', 'Lisa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '81', 'Male', 27, '0', 'gshelton@williams.org', '1', '31', '1997', '6575159976', 'Married', 'Person With Disability (PWD)', 'Young Adult', 'Unemployed', 'Master Graduate', 'Not Registered', 'Yes', 0, 'No', 0, '0', '6/10/2024', '3'),
(50, 'Young', 'Sierra', 'Wyatt', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '40', 'Male', 17, '0', 'dray@hotmail.com', '7', '13', '2007', '(579)962-5007x7872', 'Married', 'Out Of School Youth', 'Child Youth', 'Student', 'High School Level', 'Registered', 'No', 0, 'No', 0, '0', '2/13/2024', '10'),
(51, 'Estrada', 'Jacqueline', 'Theresa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '7', 'Female', 26, '0', 'hugheslauren@mejia.com', '9', '14', '1998', '+1-216-252-9218x800', 'Widowed', 'Working Youth', 'Young Adult', 'Currently looking for job', 'Master Graduate', 'Not Registered', 'Yes', 0, 'Yes', 4, '0', '6/20/2024', '11'),
(52, 'Henderson', 'Kathleen', 'Ellen', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '40', 'Female', 19, '0', 'twarren@gmail.com', '12', '27', '2005', '132.225.5391', 'Widowed', 'In School Youth', 'Core Youth', 'Currently looking for job', 'Vocational Graduate', 'Not Registered', 'Yes', 0, 'No', 0, '0', '3/6/2024', '12'),
(53, 'Sherman', 'Rebecca', 'Oscar', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '95', 'Male', 22, '0', 'wsmith@fry.info', '3', '14', '2002', '-7763', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'College Level', 'Registered', 'Yes', 0, 'Yes', 2, '0', '1/1/2024', '13'),
(54, 'Perez', 'Heather', 'Amanda', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '6', 'Female', 23, '0', 'etaylor@sparks.com', '6', '26', '2001', '-4929', 'Divorced', 'In School Youth', 'Core Youth', 'Self-Employed', 'College Level', 'Not Registered', 'Yes', 0, 'Yes', 3, '0', '7/8/2024', '14'),
(55, 'Adams', 'Debbie', 'Antonio', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '63', 'Male', 19, '0', 'joseph42@holland.net', '10', '21', '2005', '-7698', 'Married', 'Person With Disability (PWD)', 'Core Youth', 'Student', 'Vocational Graduate', 'Registered', 'Yes', 0, 'Yes', 3, '0', '4/28/2024', '15'),
(56, 'Cooper', 'William', 'Julia', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '36', 'Male', 26, '0', 'brett60@yahoo.com', '1', '5', '1998', '577-327-3351', 'Single', 'Out Of School Youth', 'Young Adult', 'Employed', 'College Level', 'Not Registered', 'No', 0, 'No', 0, '0', '4/28/2024', '16'),
(57, 'Coleman', 'Ruth', 'Jennifer', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '12', 'Female', 29, '0', 'jessica20@rodriguez-lee.com', '3', '21', '1995', '001-422-810-1867x032', 'Married', 'Working Youth', 'Young Adult', 'Self-Employed', 'College Level', 'Not Registered', 'No', 0, 'Yes', 5, '0', '3/18/2024', '17'),
(58, 'Knox', 'Kimberly', 'Dylan', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '44', 'Female', 25, '0', 'samuel14@gmail.com', '2', '27', '1999', '001-002-201-8965', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'High School Level', 'Registered', 'Yes', 0, 'No', 0, '0', '4/9/2024', '16'),
(59, 'Arnold', 'Michael', 'Jacqueline', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '40', 'Male', 19, '0', 'jessica77@marshall.org', '8', '18', '2005', '(189)604-3912x5460', 'Single', 'Working Youth', 'Core Youth', 'Self-Employed', 'Master Graduate', 'Not Registered', 'No', 0, 'No', 0, '0', '5/2/2024', '15'),
(60, 'Flores', 'Natasha', 'Nathaniel', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '82', 'Female', 28, '0', 'allen55@grant.com', '2', '23', '1996', '001-544-939-7623x101', 'Widowed', 'Person With Disability (PWD)', 'Young Adult', 'Unemployed', 'High School Graduate', 'Registered', 'No', 0, 'Yes', 4, '0', '2/7/2024', '14'),
(61, 'Carroll', 'Gabriella', 'Luis', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '41', 'Female', 22, '0', 'keith00@walker-vasquez.com', '11', '26', '2002', '9068773997', 'Widowed', 'Working Youth', 'Core Youth', 'Unemployed', 'College Level', 'Not Registered', 'No', 0, 'No', 0, '0', '1/18/2024', '18'),
(62, 'Wise', 'Craig', 'Yvonne', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '55', 'Female', 16, '0', 'dale32@hotmail.com', '9', '6', '2008', '150.431.1434x4035', 'Divorced', 'Out Of School Youth', 'Child Youth', 'Employed', 'Master Graduate', 'Not Registered', 'No', 0, 'No', 0, '0', '4/5/2024', '18'),
(63, 'Evans', 'Luis', 'Brad', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '43', 'Female', 22, '0', 'kyoung@gmail.com', '12', '27', '2002', '001-675-337-7965', 'Widowed', 'Working Youth', 'Core Youth', 'Unemployed', 'Doctorate Level', 'Registered', 'No', 0, 'Yes', 5, '0', '6/11/2024', '18'),
(64, 'Rose', 'Krista', 'James', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '83', 'Male', 20, '0', 'tmorse@daniels-williams.com', '2', '8', '2004', '584-592-6835x8808', 'Widowed', 'Person With Disability (PWD)', 'Core Youth', 'Unemployed', 'Master Graduate', 'Not Registered', 'No', 0, 'Yes', 2, '0', '7/5/2024', '17'),
(65, 'Castro', 'William', 'Samuel', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '19', 'Male', 16, '0', 'rochasusan@hotmail.com', '8', '20', '2008', '573-235-6306x758', 'Married', 'In School Youth', 'Child Youth', 'Unemployed', 'Doctorate Level', 'Registered', 'Yes', 0, 'Yes', 2, '0', '3/12/2024', '16'),
(66, 'Love', 'Melissa', 'Paul', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '33', 'Male', 28, '0', 'zbray@yahoo.com', '10', '1', '1996', '-2228', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Currently looking for job', 'College Level', 'Registered', 'Yes', 0, 'No', 0, '0', '4/20/2024', '15'),
(67, 'Ross', 'Nicholas', 'Steven', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '40', 'Male', 26, '0', 'vjohnson@sellers.com', '10', '31', '1998', '794-701-6076', 'Married', 'Out Of School Youth', 'Young Adult', 'Employed', 'Elementary Level', 'Registered', 'No', 0, 'Yes', 4, '0', '3/7/2024', '14'),
(68, 'Johnson', 'Joyce', 'Jamie', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '77', 'Female', 23, '0', 'williamsstephanie@cortez.com', '6', '15', '2001', '688-708-4427', 'Widowed', 'In School Youth', 'Core Youth', 'Employed', 'High School Level', 'Not Registered', 'Yes', 0, 'No', 0, '0', '1/28/2024', '13'),
(69, 'Heath', 'Ryan', 'Michelle', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '28', 'Male', 27, '0', 'warellano@hotmail.com', '4', '9', '1997', '001-585-360-8261x033', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'College Graduate', 'Not Registered', 'No', 0, 'Yes', 3, '0', '2/8/2024', '12'),
(70, 'King', 'Michelle', 'Sarah', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '52', 'Male', 28, '0', 'anna39@hotmail.com', '3', '15', '1996', '7406195691', 'Widowed', 'In School Youth', 'Young Adult', 'Employed', 'Elementary Graduate', 'Not Registered', 'Yes', 0, 'No', 0, '0', '1/16/2024', '12'),
(71, 'Sweeney', 'Mark', 'Kelly', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '60', 'Female', 23, '0', 'xhayes@yahoo.com', '1', '13', '2001', '415.882.1459', 'Widowed', 'Person With Disability (PWD)', 'Core Youth', 'Unemployed', 'High School Graduate', 'Not Registered', 'Yes', 0, 'Yes', 5, '0', '2/9/2024', '11'),
(72, 'Baker', 'Scott', 'Christopher', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '50', 'Female', 18, '0', 'joneill@byrd.info', '10', '6', '2006', '(236)792-9138', 'Married', 'In School Youth', 'Core Youth', 'Student', 'High School Level', 'Not Registered', 'No', 0, 'Yes', 3, '0', '1/3/2024', '5'),
(73, 'Leonard', 'John', 'Juan', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '3', 'Male', 21, '0', 'edwinconner@gmail.com', '2', '24', '2003', '(745)667-7755x342', 'Divorced', 'Person With Disability (PWD)', 'Core Youth', 'Student', 'Elementary Graduate', 'Not Registered', 'Yes', 0, 'Yes', 5, '0', '4/15/2024', '5'),
(74, 'Woodward', 'William', 'James', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '39', 'Male', 20, '0', 'mariafoster@acosta.net', '6', '12', '2004', '001-873-704-9011x863', 'Widowed', 'Working Youth', 'Core Youth', 'Employed', 'College Graduate', 'Registered', 'No', 0, 'No', 0, '0', '6/29/2024', '5'),
(75, 'Gates', 'Laura', 'Scott', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '43', 'Male', 18, '0', 'wjones@murphy-davis.net', '11', '28', '2006', '(862)742-3789', 'Single', 'In School Youth', 'Core Youth', 'Currently looking for job', 'Elementary Level', 'Not Registered', 'No', 0, 'No', 0, '0', '1/30/2024', '5'),
(76, 'Jacobs', 'Kyle', 'Connor', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '29', 'Female', 21, '0', 'ebradley@hotmail.com', '5', '7', '2003', '101-595-1566x267', 'Married', 'Working Youth', 'Core Youth', 'Self-Employed', 'High School Graduate', 'Not Registered', 'No', 0, 'Yes', 1, '0', '3/29/2024', '5'),
(77, 'Hart', 'Samuel', 'Elizabeth', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '34', 'Female', 25, '0', 'larsonkelly@wolf.com', '4', '14', '1999', '832.434.7911x08551', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'Doctorate Level', 'Not Registered', 'No', 0, 'No', 0, '0', '1/11/2024', '5'),
(78, 'Jones', 'Timothy', 'Daniel', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '78', 'Male', 29, '0', 'paulluna@hancock-henderson.org', '1', '24', '1995', '394.792.3880', 'Divorced', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'High School Level', 'Registered', 'No', 0, 'No', 0, '0', '6/15/2024', '5'),
(79, 'Melendez', 'Katherine', 'Gregory', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '9', '57', 'Female', 29, '0', 'ricardo13@gmail.com', '4', '22', '1995', '811-598-2327', 'Widowed', 'Working Youth', 'Young Adult', 'Student', 'High School Graduate', 'Not Registered', 'Yes', 0, 'Yes', 3, '0', '1/13/2024', '3'),
(80, 'Wood', 'Christina', 'Andrew', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '66', 'Male', 26, '0', 'christopherperez@white.com', '3', '11', '1998', '491-621-9327', 'Widowed', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'College Graduate', 'Not Registered', 'Yes', 0, 'Yes', 3, '0', '2/15/2024', '5'),
(81, 'Moore', 'Willie', 'William', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '31', 'Male', 30, '0', 'jeremyhenry@thompson-paul.com', '8', '2', '1994', '001-848-456-0386x550', 'Single', 'Out Of School Youth', 'Young Adult', 'Currently looking for job', 'Master Graduate', 'Registered', 'No', 0, 'No', 0, '0', '5/3/2024', '18'),
(82, 'Myers', 'Melissa', 'Daniel', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '85', 'Male', 29, '0', 'ribarra@hotmail.com', '4', '24', '1995', '+1-367-196-0117x9726', 'Widowed', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'Doctorate Level', 'Registered', 'No', 0, 'No', 0, '0', '4/19/2024', '7'),
(83, 'Thompson', 'Monica', 'Autumn', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '13', 'Female', 17, '0', 'ginadavis@gmail.com', '2', '6', '2007', '-11080', 'Widowed', 'Working Youth', 'Child Youth', 'Self-Employed', 'Vocational Graduate', 'Not Registered', 'Yes', 0, 'Yes', 3, '0', '5/26/2024', '16'),
(84, 'Montoya', 'Brian', 'Sean', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '30', 'Female', 25, '0', 'jordan10@gmail.com', '9', '22', '1999', '(790)250-8254x726', 'Single', 'In School Youth', 'Young Adult', 'Currently looking for job', 'Vocational Graduate', 'Not Registered', 'Yes', 0, 'No', 0, '0', '5/6/2024', '15'),
(85, 'Cruz', 'Alicia', 'Carl', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '54', 'Female', 28, '0', 'arobinson@neal.com', '9', '5', '1996', '789.000.0142', 'Single', 'Working Youth', 'Young Adult', 'Self-Employed', 'Master Graduate', 'Not Registered', 'No', 0, 'Yes', 3, '0', '5/28/2024', '13'),
(86, 'Turner', 'Elizabeth', 'Lisa', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '2', '99', 'Female', 27, '0', 'ystone@yahoo.com', '8', '27', '1997', '9102675261', 'Widowed', 'Person With Disability (PWD)', 'Young Adult', 'Self-Employed', 'College Level', 'Registered', 'No', 0, 'Yes', 1, '0', '5/16/2024', '4'),
(87, 'Brock', 'Denise', 'Kristin', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '91', 'Male', 23, '0', 'grossjason@brown.com', '5', '13', '2001', '573.687.4641', 'Widowed', 'Working Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Not Registered', 'No', 0, 'No', 0, '0', '4/10/2024', '4'),
(88, 'Carlson', 'Jennifer', 'Laura', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '5', '11', 'Female', 20, '0', 'karenellis@hayes.com', '5', '27', '2004', '+1-692-640-2387x027', 'Divorced', 'Working Youth', 'Core Youth', 'Student', 'College Graduate', 'Registered', 'No', 0, 'Yes', 1, '0', '4/25/2024', '4'),
(89, 'King', 'Sean', 'Jennifer', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '22', 'Female', 23, '0', 'ann49@marshall-jensen.info', '1', '17', '2001', '001-894-455-2146x490', 'Married', 'Person With Disability (PWD)', 'Core Youth', 'Unemployed', 'Elementary Graduate', 'Registered', 'Yes', 0, 'No', 0, '0', '2/24/2024', '4'),
(90, 'Kennedy', 'April', 'Priscilla', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '7', '15', 'Female', 21, '0', 'cardenasaaron@gmail.com', '1', '28', '2003', '914.439.2469x2991', 'Divorced', 'Person With Disability (PWD)', 'Core Youth', 'Self-Employed', 'Master Level', 'Not Registered', 'No', 0, 'No', 0, '0', '1/25/2024', '5'),
(91, 'Sherman', 'Danny', 'Jamie', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '67', 'Male', 26, '0', 'fmann@molina.biz', '5', '7', '1998', '791-684-7596', 'Divorced', 'Out Of School Youth', 'Young Adult', 'Self-Employed', 'Doctorate Level', 'Not Registered', 'Yes', 0, 'Yes', 1, '0', '4/22/2024', '5'),
(92, 'Pennington', 'Barbara', 'Jennifer', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '4', '58', 'Female', 25, '0', 'millerjesse@yahoo.com', '9', '24', '1999', '(711)523-0265x09655', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'College Graduate', 'Registered', 'Yes', 0, 'Yes', 3, '0', '4/25/2024', '5'),
(93, 'Vazquez', 'Nicholas', 'Glen', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '58', 'Male', 17, '0', 'susanharris@hotmail.com', '8', '23', '2007', '9180104237', 'Married', 'Out Of School Youth', 'Child Youth', 'Unemployed', 'Master Level', 'Not Registered', 'No', 0, 'Yes', 1, '0', '6/30/2024', '6'),
(94, 'Rodriguez', 'Thomas', 'Taylor', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '3', '53', 'Male', 24, '0', 'michealnunez@martin-diaz.biz', '6', '30', '2000', '(711)818-6535', 'Divorced', 'In School Youth', 'Core Youth', 'Unemployed', 'Elementary Level', 'Not Registered', 'No', 0, 'No', 0, '0', '3/25/2024', '6'),
(95, 'Johnson', 'Alejandro', 'Charlotte', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '8', '12', 'Female', 30, '0', 'christopher72@anderson.com', '1', '2', '1994', '001-357-617-1677x661', 'Married', 'Working Youth', 'Young Adult', 'Unemployed', 'Master Level', 'Not Registered', 'Yes', 0, 'No', 0, '0', '5/27/2024', '6'),
(96, 'Krause', 'Rachel', 'Madison', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '6', '2', 'Male', 26, '0', 'sosaalexa@bridges.biz', '9', '15', '1998', '+1-253-498-1232x890', 'Married', 'Working Youth', 'Young Adult', 'Student', 'College Level', 'Registered', 'No', 0, 'No', 0, '0', '5/2/2024', '7'),
(97, 'Harris', 'Ashley', 'Melanie', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '98', 'Male', 29, '0', 'gmcfarland@mills.com', '1', '18', '1995', '001-707-131-2042', 'Divorced', 'Working Youth', 'Young Adult', 'Self-Employed', 'Master Graduate', 'Not Registered', 'Yes', 0, 'No', 0, '0', '1/28/2024', '7'),
(98, 'Snyder', 'Katherine', 'Tara', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '1', '5', 'Female', 23, '0', 'zchen@yahoo.com', '5', '9', '2001', '626-886-4072', 'Single', 'In School Youth', 'Core Youth', 'Employed', 'Vocational Graduate', 'Not Registered', 'Yes', 0, 'Yes', 3, '0', '3/10/2024', '7'),
(99, 'Martinez', 'Ronald', 'William', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '7', '24', 'Male', 20, '0', 'johnbrown@gmail.com', '11', '13', '2004', '778.066.0439x50263', 'Married', 'Out Of School Youth', 'Core Youth', 'Employed', 'Elementary Level', 'Registered', 'No', 0, 'Yes', 3, '0', '2/6/2024', '8'),
(100, 'Mitchell', 'Melissa', 'Sheila', '', 'CAR', 'BEN', 'La Trinidad', 'Tawang', '', '10', '83', 'Male', 21, '0', 'chase05@hotmail.com', '8', '10', '2003', '001-040-681-1958x882', 'Divorced', 'Out Of School Youth', 'Core Youth', 'Self-Employed', 'Elementary Level', 'Registered', 'Yes', 0, 'No', 0, '0', '2/25/2024', '9');

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
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `delete_profile`
--
ALTER TABLE `delete_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `profiles_archive`
--
ALTER TABLE `profiles_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `profiles_backup`
--
ALTER TABLE `profiles_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
