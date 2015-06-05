-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2015 at 10:43 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `attsys_db`
--
CREATE DATABASE IF NOT EXISTS `attsys_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `attsys_db`;

-- --------------------------------------------------------

--
-- Table structure for table `allowance_tbl`
--

CREATE TABLE IF NOT EXISTS `allowance_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `allownace_one` int(11) NOT NULL,
  `allownace_two` int(11) NOT NULL,
  `allownace_three` int(11) NOT NULL,
  `allownace_four` int(11) NOT NULL,
  `allownace_five` int(11) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` datetime NOT NULL,
  `updated_dt` datetime NOT NULL,
  `delete_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE IF NOT EXISTS `attendance_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `checkin_time` datetime NOT NULL,
  `checkout_time` datetime NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` datetime NOT NULL,
  `updated_dt` datetime NOT NULL,
  `delete_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_tbl`
--

CREATE TABLE IF NOT EXISTS `leave_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `leave days` int(11) NOT NULL,
  `leave_category` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `leave_status` tinyint(3) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` datetime NOT NULL,
  `updated_dt` datetime NOT NULL,
  `delete_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member_tbl`
--

CREATE TABLE IF NOT EXISTS `member_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_name` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_role` smallint(2) NOT NULL DEFAULT '0',
  `created_dt` datetime NOT NULL,
  `updater_id` datetime NOT NULL,
  `updated_dt` datetime NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salary_tbl`
--

CREATE TABLE IF NOT EXISTS `salary_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `travel _fee` int(11) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` datetime NOT NULL,
  `updated_dt` datetime NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tax_tbl`
--

CREATE TABLE IF NOT EXISTS `tax_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tax_one` int(11) NOT NULL,
  `tax_two` int(11) NOT NULL,
  `tax_three` int(11) NOT NULL,
  `tax_four` int(11) NOT NULL,
  `tax_five` int(11) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` datetime NOT NULL,
  `updated_dt` datetime NOT NULL,
  `delete_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
