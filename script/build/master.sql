-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2015 at 10:42 AM
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
-- Table structure for table `allowances`
--

CREATE TABLE IF NOT EXISTS `allowances` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `full attendance bonus` double NOT NULL,
  `overtime` double NOT NULL,
  `responsibility allowance` double NOT NULL,
  `service year allowance` double NOT NULL,
  `customer site allowance` double NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE IF NOT EXISTS `attendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `att_date` date NOT NULL,
  `checkin_time` datetime NOT NULL,
  `checkout_time` datetime NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `member_id`, `att_date`, `checkin_time`, `checkout_time`, `notes`, `lat`, `lng`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(2, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-05-14', '2015-05-14 08:00:00', '2015-05-14 17:00:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, '517789a4-94fc-11e4-8cf4-3b7ec45c8174', '2015-05-05', '2015-05-05 07:00:00', '2015-05-05 17:00:00', '', 0, 0, '2015-06-10 17:45:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, '944cdc54-73cb-11e4-9e06-93eff5fd146b', '2014-12-03', '2014-12-03 08:00:00', '2014-12-03 18:00:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, '6', '2015-05-27', '2015-06-11 08:00:00', '2015-06-11 17:11:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, '2', '2015-05-26', '2015-06-11 08:16:00', '2015-06-11 17:00:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, '4', '2015-04-08', '2015-06-09 07:00:00', '2015-06-09 17:00:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, '5', '2014-10-07', '2015-06-10 08:00:00', '2015-06-10 18:00:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(9, '5', '2015-06-01', '2015-06-09 08:00:00', '2015-06-09 17:00:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(12, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-17', '2015-06-17 14:24:08', '2015-06-17 14:55:57', '', 0, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(13, 'test01', '2015-05-13', '2015-05-13 14:33:12', '2015-05-13 14:48:11', '', 0, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(14, 'test004', '2015-06-17', '2015-06-17 15:11:03', '0000-00-00 00:00:00', '', 0, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(15, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-18', '2015-06-18 09:17:54', '2015-06-18 14:06:00', '', 0, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(16, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-19', '2015-06-19 09:00:42', '0000-00-00 00:00:00', '', 0, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(17, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-22', '2015-06-22 09:06:49', '2015-06-22 19:20:26', '', 0, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(18, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-23', '2015-06-23 08:18:47', '2015-06-23 15:04:20', '', 0, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(19, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-24', '2015-06-24 10:01:32', '0000-00-00 00:00:00', '', 0, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(20, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-25', '2015-06-25 07:56:05', '0000-00-00 00:00:00', '', 0, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(21, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-26', '2015-06-26 08:06:25', '0000-00-00 00:00:00', '', 0, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `startdate` varchar(48) NOT NULL,
  `enddate` varchar(48) NOT NULL,
  `allDay` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------


--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `date` datetime NOT NULL,
  `leave_days` int(11) NOT NULL,
  `leave_category` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `leave_description` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `leave_status` tinyint(3) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `member_id`, `start_date`, `end_date`, `date`, `leave_days`, `leave_category`, `leave_description`, `leave_status`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(1, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-29 00:00:00', '2015-06-30 00:00:00', '2015-06-22 00:00:00', 2, 'sick', 'wan to take 2 days leave', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(2, '517789a4-94fc-11e4-8cf4-3b7ec45c8174', '2015-06-29 00:00:00', '2015-06-30 00:00:00', '2015-06-22 00:00:00', 2, 'vacation', '', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_detail`
--

CREATE TABLE IF NOT EXISTS `salary_detail` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `basic_salary` double NOT NULL,
  `travel _fee` double NOT NULL,
  `overtime` double NOT NULL,
  `ssc_comp` double NOT NULL,
  `ssc_emp` double NOT NULL,
  `absent dedution` double NOT NULL,
  `income_tax` double NOT NULL,
  `pay date` datetime NOT NULL,
  `creator_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_master`
--

CREATE TABLE IF NOT EXISTS `salary_master` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `basic_salary` double NOT NULL,
  `travel _fee` double NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxs`
--

CREATE TABLE IF NOT EXISTS `taxs` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `absent deduction` double NOT NULL,
  `ssc` double NOT NULL,
  `income tax` int(11) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
