-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2015 at 08:03 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
  `db_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `db_psw` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `host` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_limit` int(11) NOT NULL,
  `deleted_flag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_tbl`
--

INSERT INTO `company_tbl` (`company_id`, `company_name`, `db_name`, `user_name`, `db_psw`, `host`, `user_limit`, `deleted_flag`) VALUES
('cop1', 'gnext', 'attsys_db', 'root', 'root', 'localhost', 200, 0);

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
