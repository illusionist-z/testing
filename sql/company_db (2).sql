-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2016 at 04:57 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `company_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_tbl`
--

CREATE TABLE IF NOT EXISTS `company_tbl` (
  `company_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `phone_no` int(11) NOT NULL,
  `db_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `db_psw` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `host` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_limit` int(11) NOT NULL,
  `starting_date` date NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_tbl`
--

INSERT INTO `company_tbl` (`company_id`, `company_name`, `email`, `phone_no`, `db_name`, `user_name`, `db_psw`, `host`, `user_limit`, `starting_date`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('686', 'fafj', 'e@e.com', 50485025, 'jjfaf', 'fafwe', 'faff', 'fafa', 909, '2016-01-01', '', '2016-01-15 06:08:23', '', '0000-00-00 00:00:00', 0),
('aff', 'faf', 'a@a.com', 80908, 'fafaf', 'fafa', 'asffaf', '', 8800, '2016-01-01', '', '2016-01-15 06:06:59', '', '0000-00-00 00:00:00', 1),
('com', 'coamf', 'e@e.com', 98491, 'com', 'foafj', 'jfaojf', '', 4000, '2016-01-01', '', '2016-01-15 06:01:07', '', '0000-00-00 00:00:00', 1),
('com4', 'Bcommm', 'com4@mail.comaaa', 22222, 'db', 'root', 'root', 'localhost', 500, '2016-01-22', '', '2016-01-08 05:32:01', '', '2016-01-11 10:18:08', 0),
('com5', 'com5', 'a@a.com', 444414, 'ww', 'aa', 'admin', 'wrea', 500, '2016-01-04', '', '2016-01-08 07:42:47', '', '2016-01-13 04:01:25', 0),
('com6', '6com', 'com6@mail.com', 1234567, '6comdb', 'root', 'root', 'localhost', 300, '2016-01-29', '', '2016-01-11 08:56:14', '', '2016-01-11 10:07:12', 0),
('comp3', 'Acompany', 'comp3@mail.com', 2147483647, 'b_db', 'root', '', 'localhost', 200, '2016-01-01', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 1),
('cop1', 'gnext', 'cop1@mail.com', 887867, 'attsys_db', 'root', '', 'localhost', 200, '2015-11-03', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
('cop2', 'Acompany', 'cop2@mail.com', 4686800, 'a_db', 'root', '', 'localhost', 1000, '2015-08-05', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
('ee', 'ee', 'e@e.com', 480804, 'ee', 'ee', 'ee', '', 444, '2016-01-02', '', '2016-01-15 06:05:51', '', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `core_module`
--

CREATE TABLE IF NOT EXISTS `core_module` (
  `module_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `module_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `core_module`
--

INSERT INTO `core_module` (`module_name`, `module_id`) VALUES
('Dashboard', 'dashboard'),
('Attendance List', 'attlist'),
(' Manage User', 'manageuser'),
('Leave Days', 'leave'),
('Calendar', 'calendar'),
('Salary', 'salary'),
('Document', 'document'),
('Setting', 'setting');

-- --------------------------------------------------------

--
-- Table structure for table `enable_module`
--

CREATE TABLE IF NOT EXISTS `enable_module` (
  `company_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `module_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE IF NOT EXISTS `user_tbl` (
  `user_id` varchar(36) CHARACTER SET utf8 NOT NULL,
  `login_name` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(120) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `login_name`, `password`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('1', 'gnext', 'c1dbb35856011d51c4d532c2b1b851dfb0d9eaa7', NULL, '2016-01-07 00:00:00', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_tbl`
--
ALTER TABLE `company_tbl`
 ADD UNIQUE KEY `company_id` (`company_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
