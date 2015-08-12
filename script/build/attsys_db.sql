-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2015 at 10:46 AM
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
-- Table structure for table `absent`
--

CREATE TABLE IF NOT EXISTS `absent` (
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL,
  `delete_flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `absent`
--

INSERT INTO `absent` (`member_id`, `date`, `delete_flag`) VALUES
('anesis', '2015-08-04', 1),
('Doe', '2015-08-04', 1),
('test02', '2015-08-04', 1),
('test03', '2015-08-04', 1),
('delete', '2015-08-04', 1),
('suzin', '2015-08-04', 1),
('admintest', '2015-08-04', 1),
('member8', '2015-08-04', 1),
('test001', '2015-08-04', 1),
('test004', '2015-08-04', 1),
('test01', '2015-08-04', 1),
('david', '2015-08-04', 1),
('anesis', '2015-08-04', 1),
('Doe', '2015-08-04', 1),
('test02', '2015-08-04', 1),
('test03', '2015-08-04', 1),
('delete', '2015-08-04', 1),
('suzin', '2015-08-04', 1),
('admintest', '2015-08-04', 1),
('member8', '2015-08-04', 1),
('test001', '2015-08-04', 1),
('test004', '2015-08-04', 1),
('test01', '2015-08-04', 1),
('david', '2015-08-04', 1),
('anesis', '2015-08-04', 1),
('Doe', '2015-08-04', 1),
('test02', '2015-08-04', 1),
('test03', '2015-08-04', 1),
('delete', '2015-08-04', 1),
('suzin', '2015-08-04', 1),
('admintest', '2015-08-04', 1),
('member8', '2015-08-04', 1),
('test001', '2015-08-04', 1),
('test004', '2015-08-04', 1),
('test01', '2015-08-04', 1),
('david', '2015-08-04', 1),
('anesis', '2015-08-05', 1),
('Doe', '2015-08-05', 1),
('test02', '2015-08-05', 1),
('test03', '2015-08-05', 1),
('delete', '2015-08-05', 1),
('admin', '2015-08-05', 1),
('suzin', '2015-08-05', 1),
('admintest', '2015-08-05', 1),
('member8', '2015-08-05', 1),
('test001', '2015-08-05', 1),
('test004', '2015-08-05', 1),
('test01', '2015-08-05', 1),
('david', '2015-08-05', 1),
('anesis', '2015-08-05', 1),
('Doe', '2015-08-05', 1),
('test02', '2015-08-05', 1),
('test03', '2015-08-05', 1),
('delete', '2015-08-05', 1),
('admin', '2015-08-05', 1),
('suzin', '2015-08-05', 1),
('admintest', '2015-08-05', 1),
('member8', '2015-08-05', 1),
('test001', '2015-08-05', 1),
('test004', '2015-08-05', 1),
('test01', '2015-08-05', 1),
('david', '2015-08-05', 1),
('anesis', '2015-08-05', 1),
('Doe', '2015-08-05', 1),
('test02', '2015-08-05', 1),
('test03', '2015-08-05', 1),
('delete', '2015-08-05', 1),
('admin', '2015-08-05', 1),
('suzin', '2015-08-05', 1),
('admintest', '2015-08-05', 1),
('member8', '2015-08-05', 1),
('test001', '2015-08-05', 1),
('test004', '2015-08-05', 1),
('test01', '2015-08-05', 1),
('david', '2015-08-05', 1),
('anesis', '2015-08-05', 1),
('Doe', '2015-08-05', 1),
('test02', '2015-08-05', 1),
('test03', '2015-08-05', 1),
('delete', '2015-08-05', 1),
('admin', '2015-08-05', 1),
('suzin', '2015-08-05', 1),
('admintest', '2015-08-05', 1),
('member8', '2015-08-05', 1),
('test001', '2015-08-05', 1),
('test004', '2015-08-05', 1),
('test01', '2015-08-05', 1),
('david', '2015-08-05', 1),
('anesis', '2015-08-05', 1),
('Doe', '2015-08-05', 1),
('test02', '2015-08-05', 1),
('test03', '2015-08-05', 1),
('delete', '2015-08-05', 1),
('admin', '2015-08-05', 1),
('suzin', '2015-08-05', 1),
('admintest', '2015-08-05', 1),
('member8', '2015-08-05', 1),
('test001', '2015-08-05', 1),
('test004', '2015-08-05', 1),
('test01', '2015-08-05', 1),
('david', '2015-08-05', 1),
('anesis', '2015-08-05', 1),
('Doe', '2015-08-05', 1),
('test02', '2015-08-05', 1),
('test03', '2015-08-05', 1),
('delete', '2015-08-05', 1),
('admin', '2015-08-05', 1),
('suzin', '2015-08-05', 1),
('admintest', '2015-08-05', 1),
('member8', '2015-08-05', 1),
('test001', '2015-08-05', 1),
('test004', '2015-08-05', 1),
('test01', '2015-08-05', 1),
('david', '2015-08-05', 1),
('anesis', '2015-08-05', 1),
('Doe', '2015-08-05', 1),
('test02', '2015-08-05', 1),
('test03', '2015-08-05', 1),
('delete', '2015-08-05', 1),
('admin', '2015-08-05', 1),
('suzin', '2015-08-05', 1),
('admintest', '2015-08-05', 1),
('member8', '2015-08-05', 1),
('test001', '2015-08-05', 1),
('test004', '2015-08-05', 1),
('test01', '2015-08-05', 1),
('david', '2015-08-05', 1),
('anesis', '2015-08-05', 1),
('Doe', '2015-08-05', 1),
('test02', '2015-08-05', 1),
('test03', '2015-08-05', 1),
('delete', '2015-08-05', 1),
('admin', '2015-08-05', 1),
('suzin', '2015-08-05', 1),
('admintest', '2015-08-05', 1),
('member8', '2015-08-05', 1),
('test001', '2015-08-05', 1),
('test004', '2015-08-05', 1),
('test01', '2015-08-05', 1),
('david', '2015-08-05', 1),
('anesis', '2015-08-05', 1),
('Doe', '2015-08-05', 1),
('test02', '2015-08-05', 1),
('test03', '2015-08-05', 1),
('delete', '2015-08-05', 1),
('admin', '2015-08-05', 1),
('suzin', '2015-08-05', 1),
('admintest', '2015-08-05', 1),
('member8', '2015-08-05', 1),
('test001', '2015-08-05', 1),
('test004', '2015-08-05', 1),
('test01', '2015-08-05', 1),
('david', '2015-08-05', 1),
('anesis', '2015-08-07', 1),
('Doe', '2015-08-07', 1),
('test02', '2015-08-07', 1),
('test03', '2015-08-07', 1),
('delete', '2015-08-07', 1),
('admin', '2015-08-07', 1),
('suzin', '2015-08-07', 1),
('admintest', '2015-08-07', 1),
('member8', '2015-08-07', 1),
('test001', '2015-08-07', 1),
('test004', '2015-08-07', 1),
('test01', '2015-08-07', 1),
('david', '2015-08-07', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1),
('anesis', '2015-08-10', 1),
('Doe', '2015-08-10', 1),
('test02', '2015-08-10', 1),
('test03', '2015-08-10', 1),
('delete', '2015-08-10', 1),
('admin', '2015-08-10', 1),
('suzin', '2015-08-10', 1),
('admintest', '2015-08-10', 1),
('member8', '2015-08-10', 1),
('test001', '2015-08-10', 1),
('test004', '2015-08-10', 1),
('test01', '2015-08-10', 1),
('david', '2015-08-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE IF NOT EXISTS `allowances` (
  `allowance_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `allowance_name` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `allowance_amount` double NOT NULL,
  `creator_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`allowance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `allowances`
--

INSERT INTO `allowances` (`allowance_id`, `allowance_name`, `allowance_amount`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('4a53fcdc-3d17-11e5-b0fa-00ff56603869', 'service year allowance', 5000, '', '2015-08-07 00:00:00', '', '0000-00-00 00:00:00', 0),
('4a54bc11-3d17-11e5-b0fa-00ff56603869', 'customer site allowance', 10000, '', '2015-08-07 00:00:00', '', '0000-00-00 00:00:00', 0);

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
  `overtime` double NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `location` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `creator_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `member_id`, `att_date`, `checkin_time`, `checkout_time`, `overtime`, `notes`, `lat`, `lng`, `location`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(3, '517789a4-94fc-11e4-8cf4-3b7ec45c8174', '2015-07-15', '2015-07-15 07:00:00', '2015-07-15 17:00:00', 1.12, '', 0, 0, '', '', '2015-06-10 17:45:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(12, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-17', '2015-06-17 14:24:08', '2015-06-17 14:55:57', 0, '', 0, 0, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(13, 'efe235c2-9672-11e4-a3e5-b3f3ac838c32', '2015-05-13', '2015-05-13 14:33:12', '2015-05-13 14:48:11', 0, '', 0, 0, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(14, 'test004', '2015-06-17', '2015-06-17 15:11:03', '0000-00-00 00:00:00', 0, '', 0, 0, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(15, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-18', '2015-06-18 09:17:54', '2015-06-18 14:06:00', 0, '', 0, 0, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(16, 'a752879a-6e2b-11e4-b676-82c4524d8ace', '2015-06-19', '2015-06-19 09:00:42', '0000-00-00 00:00:00', 0, '', 0, 0, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(17, 'c422a154-c0f9-11e4-a6dd-7a12eb6538e9', '2015-06-22', '2015-06-22 09:06:49', '2015-06-22 19:20:26', 0, '', 0, 0, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(18, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-23', '2015-06-23 08:18:47', '2015-06-23 15:04:20', 0, '', 0, 0, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(19, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-24', '2015-06-24 10:01:32', '0000-00-00 00:00:00', 0, '', 0, 0, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(20, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-25', '2015-06-25 07:56:05', '0000-00-00 00:00:00', 0, '', 0, 0, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(21, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-26', '2015-06-26 08:06:25', '0000-00-00 00:00:00', 0, '', 0, 0, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(23, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-07-14', '2015-07-13 09:57:22', '0000-00-00 00:00:00', 0, '', 16.8039198, 96.1403067, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(24, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-07-15', '2015-07-15 01:45:58', '0000-00-00 00:00:00', 0, '', 16.803911499999998, 96.1403684, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(25, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-07-16', '2015-07-16 01:29:06', '2015-07-16 09:52:44', 0, '', 16.803882299999998, 96.1403256, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(26, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-07-17', '2015-07-17 01:41:34', '0000-00-00 00:00:00', 0, '', 16.8039151, 96.1402902, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(28, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-07-20', '2015-07-20 06:36:40', '0000-00-00 00:00:00', 0, '', 16.8039073, 96.1403378, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(29, 'admin', '2015-07-22', '2015-07-22 05:06:29', '0000-00-00 00:00:00', 0, '', 16.803862499999997, 96.14032999999999, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(30, 'admin', '2015-07-24', '2015-07-24 01:54:55', '0000-00-00 00:00:00', 0, '', 16.8039186, 96.1403474, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(31, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-07-24', '2015-07-24 02:15:54', '0000-00-00 00:00:00', 0, '', 16.803911499999998, 96.14034679999999, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(32, 'admin', '2015-08-04', '2015-08-04 01:45:06', '0000-00-00 00:00:00', 0, '', 16.803844299999998, 96.1402554, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(33, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-08-04', '2015-08-04 01:57:38', '0000-00-00 00:00:00', 0, '', 16.780832999999998, 96.149722, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(34, 'a341f7e8-6e4a-11e4-b676-82c4524d8ace', '2015-08-04', '2015-08-04 02:17:52', '0000-00-00 00:00:00', 0, '', 16.780832999999998, 96.149722, '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(35, 'c8169087-3fd2-11e5-9c70-9c4fb7a929cf', '2015-08-11', '2015-08-11 02:46:06', '0000-00-00 00:00:00', 0, '', 16.8037974, 96.14018449999999, 'Myanmar (Burma)', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0);

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
  `creator_id` varchar(36) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `member_id`, `title`, `startdate`, `enddate`, `allDay`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(2, '', 'test', '2015-07-29T09:00:00', '2015-07-29T09:00:00', 'true', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(3, '', 'test', '2015-07-29', '2015-07-30', 'true', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_action_log`
--

CREATE TABLE IF NOT EXISTS `core_action_log` (
  `action_log_id` bigint(20) unsigned NOT NULL COMMENT 'ID',
  `module` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL COMMENT '処理実行モジュール',
  `controller` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Controller',
  `action` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL COMMENT '実行処理名',
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'メンバーID',
  `action_log_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT 'アクセス日時',
  `action_log_url` text NOT NULL COMMENT '利用URL',
  `client_ipv4` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL COMMENT 'clientIPv4',
  `client_ipv6` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL COMMENT 'clientIPv6'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `core_dept`
--

CREATE TABLE IF NOT EXISTS `core_dept` (
  `dept_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dept_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '略名',
  `parent_dept_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `dept_level` tinyint(11) unsigned DEFAULT NULL,
  `dept_order` int(11) unsigned DEFAULT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_dept`
--

INSERT INTO `core_dept` (`dept_code`, `dept_name`, `abbreviation`, `parent_dept_code`, `dept_level`, `dept_order`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('100000001', '部署テスト', 'テスト', '', 1, NULL, '1', '2014-10-20 15:01:00', NULL, NULL, 0),
('1212', '部所部署', '部署', '100000001', 2, NULL, 'admin', '2015-01-06 22:50:34', NULL, NULL, 0),
('20202', '部署', NULL, 'ad0404', 5, NULL, '1', '2014-10-20 15:51:48', NULL, NULL, 0),
('33333', 'detp22', 'detp22', '', 1, NULL, '1', '2014-09-22 10:35:08', NULL, NULL, 1),
('ad03', 'テスト', 'ﾃｽﾄ', 'admin2', 3, NULL, '1', '2014-10-14 17:57:27', NULL, NULL, 0),
('ad0404', 'テストです。', NULL, 'ad03', 4, NULL, '1', '2014-10-20 15:31:42', NULL, NULL, 0),
('admin', '管理者用', '管理者用', '', 1, 1, '1', '2014-04-22 13:31:15', '1', '2014-04-22 13:31:37', 0),
('admin2', '管理者用2階層', '管理者用2階層', 'admin', 2, NULL, '1', '2014-04-22 13:31:52', NULL, NULL, 0),
('dept-admin', '取引先', '取引先', '', 1, NULL, '1', '2013-06-27 11:10:38', NULL, NULL, 0),
('TEST001', 'test002', '', '', 1, NULL, 'admin', '2015-01-08 13:10:37', 'admin', '2015-01-09 12:58:26', 0),
('test003', 'test003', '', '', 1, NULL, 'admin', '2015-01-09 12:58:42', NULL, NULL, 0),
('100000001', '部署テスト', 'テスト', '', 1, NULL, '1', '2014-10-20 15:01:00', NULL, NULL, 0),
('1212', '部所部署', '部署', '100000001', 2, NULL, 'admin', '2015-01-06 22:50:34', NULL, NULL, 0),
('20202', '部署', NULL, 'ad0404', 5, NULL, '1', '2014-10-20 15:51:48', NULL, NULL, 0),
('33333', 'detp22', 'detp22', '', 1, NULL, '1', '2014-09-22 10:35:08', NULL, NULL, 1),
('ad03', 'テスト', 'ﾃｽﾄ', 'admin2', 3, NULL, '1', '2014-10-14 17:57:27', NULL, NULL, 0),
('ad0404', 'テストです。', NULL, 'ad03', 4, NULL, '1', '2014-10-20 15:31:42', NULL, NULL, 0),
('admin', '管理者用', '管理者用', '', 1, 1, '1', '2014-04-22 13:31:15', '1', '2014-04-22 13:31:37', 0),
('admin2', '管理者用2階層', '管理者用2階層', 'admin', 2, NULL, '1', '2014-04-22 13:31:52', NULL, NULL, 0),
('dept-admin', '取引先', '取引先', '', 1, NULL, '1', '2013-06-27 11:10:38', NULL, NULL, 0),
('TEST001', 'test002', '', '', 1, NULL, 'admin', '2015-01-08 13:10:37', 'admin', '2015-01-09 12:58:26', 0),
('test003', 'test003', '', '', 1, NULL, 'admin', '2015-01-09 12:58:42', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_exports`
--

CREATE TABLE IF NOT EXISTS `core_exports` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `file_type` varchar(12) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `module_name` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `table_name` varchar(122) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `export_fields` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `shared_flag` tinyint(2) NOT NULL DEFAULT '0',
  `add_date_flag` tinyint(4) NOT NULL DEFAULT '0',
  `shared_dept_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `core_images`
--

CREATE TABLE IF NOT EXISTS `core_images` (
  `uuid` varchar(36) NOT NULL,
  `mime_type` varchar(254) DEFAULT NULL COMMENT 'Mime type',
  `extension` varchar(10) DEFAULT NULL COMMENT '拡張子',
  `rel_table` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `rel_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'relational code',
  `category_id` varchar(20) DEFAULT NULL,
  `delete_flag_files` tinyint(4) NOT NULL DEFAULT '0',
  `creator_id` varchar(36) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL COMMENT 'created date',
  `updater_id` varchar(36) DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL COMMENT 'updated date',
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Delete flag'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_images`
--

INSERT INTO `core_images` (`uuid`, `mime_type`, `extension`, `rel_table`, `rel_code`, `category_id`, `delete_flag_files`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('0372f14c-c67c-11e4-9e5e-647210f9b28f', 'image/jpeg', 'jpg', 'naotter_carte_branch', 'ef806748-c679-11e4-9e5e-647210f9b28f', NULL, 2, 'admin', '2015-03-10 01:47:46', NULL, '2015-03-09 23:39:10', 1),
('037911b0-bb66-11e4-8028-16598075c78a', NULL, 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:12:34', NULL, NULL, 0),
('20a7b16a-bc06-11e4-8028-16598075c78a', 'image/png', 'png', 'naotter_carte_branch', 'eba83b06-bc05-11e4-8028-16598075c78a', NULL, 2, 'admin', '2015-02-24 18:18:43', NULL, '2015-02-24 18:47:51', 1),
('246eb122-c67e-11e4-9e5e-647210f9b28f', 'image/jpeg', 'jpg', 'naotter_carte_branch', 'fbfaaff6-c679-11e4-9e5e-647210f9b28f', NULL, 2, 'admin', '2015-03-10 02:03:00', NULL, '2015-03-09 23:38:58', 1),
('2c61cab8-bb66-11e4-8028-16598075c78a', 'image/jpeg', 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:13:43', NULL, NULL, 0),
('3e7e1974-bbb9-11e4-8028-16598075c78a', 'image/jpeg', 'jpg', 'naotter_carte_branch', '8fa05ff4-b8dc-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-24 09:08:22', NULL, NULL, 0),
('44f736de-bb6c-11e4-8028-16598075c78a', 'image/jpeg', 'jpg', 'naotter_carte_branch', '8fa05ff4-b8dc-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:57:21', NULL, NULL, 0),
('56ad4c3a-bb65-11e4-8028-16598075c78a', NULL, 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:07:44', NULL, NULL, 0),
('5b5341fe-bb65-11e4-8028-16598075c78a', NULL, 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:07:52', NULL, NULL, 0),
('6d700f5c-bc0a-11e4-8028-16598075c78a', 'image/png', 'png', 'naotter_carte_branch', 'eba83b06-bc05-11e4-8028-16598075c78a', NULL, 2, 'admin', '2015-02-24 18:49:30', NULL, '2015-02-24 18:49:34', 1),
('a66716ac-bb65-11e4-8028-16598075c78a', NULL, 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:09:58', NULL, NULL, 0),
('dad4f466-c3a5-11e4-9e5e-647210f9b28f', 'image/jpeg', 'jpg', 'naotter_carte_branch', '0c6ab60c-b035-11e4-96c4-63e65a0e37e9', NULL, 0, 'admin', '2015-03-06 11:09:43', NULL, NULL, 0),
('e9e77f2a-bb65-11e4-8028-16598075c78a', NULL, 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:11:51', NULL, NULL, 0),
('e9f4ec5a-bb65-11e4-8028-16598075c78a', NULL, 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:11:52', NULL, NULL, 0),
('f2f892c4-bb6b-11e4-8028-16598075c78a', 'image/jpeg', 'jpg', 'naotter_carte_branch', '8fa05ff4-b8dc-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:55:04', NULL, NULL, 0),
('fdbd2234-bc05-11e4-8028-16598075c78a', 'image/jpeg', 'jpg', 'naotter_carte_branch', 'eba83b06-bc05-11e4-8028-16598075c78a', NULL, 2, 'admin', '2015-02-24 18:17:44', NULL, '2015-02-24 18:48:40', 1),
('fdcfd46a-bc05-11e4-8028-16598075c78a', 'image/png', 'png', 'naotter_carte_branch', 'eba83b06-bc05-11e4-8028-16598075c78a', NULL, 2, 'admin', '2015-02-24 18:17:45', NULL, '2015-02-24 18:46:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `core_lock_record`
--

CREATE TABLE IF NOT EXISTS `core_lock_record` (
  `relation_table` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT '対象テーブル名',
  `relation_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'リレーキー',
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'member id',
  `member_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'member name',
  `expired_time` datetime NOT NULL COMMENT 'ロック開放時間',
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_lock_record`
--

INSERT INTO `core_lock_record` (`relation_table`, `relation_id`, `member_id`, `member_name`, `expired_time`, `creator_id`, `created_dt`) VALUES
('core_member', '1258ee26-754d-11e4-b4fc-a91e9baf9c00', 'admin', 'Administrator ', '2015-03-06 23:29:04', 'admin', '2015-03-06 22:59:04'),
('core_member', '944cdc54-73cb-11e4-9e06-93eff5fd146b', 'admin', 'Administrator ', '2015-03-06 10:41:35', 'admin', '2015-03-06 10:11:35'),
('core_member', 'a341f7e8-6e4a-11e4-b676-82c4524d8ace', 'admin', 'Administrator ', '2015-03-03 02:02:06', 'admin', '2015-03-03 01:32:06'),
('core_member', 'c422a154-c0f9-11e4-a6dd-7a12eb6538e9', 'admin', 'Administrator ', '2015-03-05 21:39:48', 'admin', '2015-03-05 21:09:48'),
('core_member', 'd6c1f45a-6ffe-11e4-bf19-78638984f957', 'admin', 'Administrator ', '2014-12-27 22:06:39', 'admin', '2014-12-27 21:36:39'),
('core_member', 'efe235c2-9672-11e4-a3e5-b3f3ac838c32', 'admin', 'Administrator ', '2015-01-07 23:11:59', 'admin', '2015-01-07 22:41:59'),
('customer_main', 'm1', 'admin', 'Administrator ', '2015-03-03 10:50:32', 'admin', '2015-03-03 10:20:32'),
('naotter_carte', '305160a2-b062-11e4-9f7b-a3b0879658f6', 'admin', 'Administrator ', '2015-02-09 23:17:33', 'admin', '2015-02-09 22:47:33'),
('naotter_carte', '32', 'admin', 'Administrator ', '2014-12-29 22:53:11', 'admin', '2014-12-29 22:23:11'),
('naotter_carte', '382ca54e-b895-11e4-8b55-1d823584f74b', 'admin', 'Administrator ', '2015-02-24 00:13:08', 'admin', '2015-02-23 23:43:08'),
('naotter_carte', '3864a57c-8dc3-11e4-a651-b2b268f284bf', 'admin', 'Administrator ', '2014-12-27 21:54:08', 'admin', '2014-12-27 21:24:08'),
('naotter_carte', '39', 'admin', 'Administrator ', '2015-03-03 11:36:05', 'admin', '2015-03-03 11:06:05'),
('naotter_carte', '3d205368-8dc3-11e4-a651-b2b268f284bf', 'admin', 'Administrator ', '2014-12-29 22:53:37', 'admin', '2014-12-29 22:23:37'),
('naotter_carte', '54', 'admin', 'Administrator ', '2015-03-05 14:47:10', 'admin', '2015-03-05 14:17:10'),
('naotter_carte', '602e55ca-9b89-11e4-aae1-cf6bad2099a0', 'admin', 'Administrator ', '2015-01-14 10:35:51', 'admin', '2015-01-14 10:05:51'),
('naotter_carte', '63', 'admin', 'Administrator ', '2015-03-05 17:43:57', 'admin', '2015-03-05 17:13:57'),
('naotter_carte', '64', 'admin', 'Administrator ', '2015-04-23 06:52:41', 'admin', '2015-04-23 06:22:41'),
('naotter_carte', '64fadd3c-b027-11e4-96c4-63e65a0e37e9', 'admin', 'Administrator ', '2015-02-09 16:16:56', 'admin', '2015-02-09 15:46:56'),
('naotter_carte', '68', 'admin', 'Administrator ', '2015-04-01 12:52:17', 'admin', '2015-04-01 12:22:17'),
('naotter_carte', '77', 'admin', 'Administrator ', '2015-04-23 09:07:13', 'admin', '2015-04-23 08:37:13'),
('naotter_carte', '79', 'admin', 'Administrator ', '2015-05-04 05:29:36', 'admin', '2015-05-04 04:59:36'),
('naotter_carte', '8fa05ff4-b8dc-11e4-8b55-1d823584f74b', 'admin', 'Administrator ', '2015-02-24 00:19:23', 'admin', '2015-02-23 23:49:23'),
('naotter_carte', 'ef951048-8dc2-11e4-a651-b2b268f284bf', 'admin', 'Administrator ', '2015-01-14 17:55:30', 'admin', '2015-01-14 17:25:30'),
('schedule', '44303412-c779-11e4-9e5e-647210f9b28f', 'admin', 'Administrator ', '2015-03-11 09:10:10', 'admin', '2015-03-11 08:40:10'),
('schedule', 'd351008a-c77a-11e4-9e5e-647210f9b28f', 'admin', 'Administrator ', '2015-03-11 09:07:13', 'admin', '2015-03-11 08:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `core_member`
--

CREATE TABLE IF NOT EXISTS `core_member` (
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'uuid',
  `member_login_name` varchar(256) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_password` varchar(128) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_first_name` varchar(64) DEFAULT NULL,
  `member_family_name` varchar(63) DEFAULT NULL,
  `full_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Combine first_name and family_name',
  `member_first_name_kana` varchar(64) DEFAULT NULL,
  `member_family_name_kana` varchar(63) DEFAULT NULL,
  `member_dept_code` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_dept_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_tel` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_mobile_tel` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_mail` varchar(256) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_mail_2` varchar(256) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `position` varchar(64) DEFAULT NULL,
  `lang` varchar(2) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_address` varchar(75) NOT NULL,
  `member_profile` varchar(70) NOT NULL,
  `rank_code` tinyint(3) unsigned DEFAULT '0',
  `member_is_change` tinyint(1) DEFAULT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_member`
--

INSERT INTO `core_member` (`member_id`, `member_login_name`, `member_password`, `member_first_name`, `member_family_name`, `full_name`, `member_first_name_kana`, `member_family_name_kana`, `member_dept_code`, `member_dept_name`, `member_tel`, `member_mobile_tel`, `member_mail`, `member_mail_2`, `position`, `lang`, `member_address`, `member_profile`, `rank_code`, `member_is_change`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `delete_flag`) VALUES
('517789a4-94fc-11e4-8cf4-3b7ec45c8174', 'anesis', '51a5f96e61c5a109b6d4a3d2fec0e77717934ddb', 'テスト', 'アネシス', 'アネシス テスト', 'テスト', 'アネシス', '100000001', '部署テスト', '', '', '', '', '', 'ja', '', '', 0, NULL, 'admin', '2015-01-06 02:00:14', NULL, NULL, 0),
('902a67ac-b752-11e4-8b55-1d823584f74b', 'Doe', NULL, '', '', '', '', '', '', '部署を選択してください', '', '', '', '', '', 'ja', '', '', 0, NULL, 'admin', '2015-02-18 18:43:16', 'admin', '2015-02-27 21:06:50', 1),
('9af6af14-6e01-11e4-b676-82c4524d8ace', 'test02', '889ab7d027b385e292587ff9cb6d92d5a14aefa7', 'User02', 'Test', 'Test User02', 'ユーザ２', 'テスト', '100000001', '部署テスト', '', '', 'test02@example.com', '', 'Manager', 'ja', '', '', 0, NULL, 'admin', '2014-11-17 11:29:50', 'admin', '2014-11-17 13:53:24', 0),
('a341f7e8-6e4a-11e4-b676-82c4524d8ace', 'test03', '', 'User03', 'Test', 'Test User03', 'ユーザ３', 'テスト', 'ad03', 'ﾃｽﾄ', '', '', 'test03@example.com', 'test03@example.com', '', 'ja', '', '', 0, NULL, 'admin', '2014-11-17 20:12:37', 'admin', '2014-11-20 23:19:49', 0),
('a752879a-6e2b-11e4-b676-82c4524d8ace', 'delete', '9485989ff514b5106b7738850fd73c23e8c1e3f7', 'User', 'Deleted', 'Deleted User', 'User', 'Deleted', '100000001', '部署テスト', '', '', '', '', '', 'ja', '', '', 0, NULL, 'admin', '2014-11-17 16:30:49', 'admin', '2014-11-17 16:33:35', 1),
('admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 'Administrator', 'Administrator ', '', 'Administrator', 'admin', 'wheel', '', '', 'sample@test.com', '', '', 'en', '', '', 1, NULL, '1', '2014-09-22 11:41:47', 'admin', '2015-05-18 10:45:27', 0),
('c422a154-c0f9-11e4-a6dd-7a12eb6538e9', 'suzin', '92f8e9dbb80a6cb1632080f0bc2ce4fef5b6', '優一', 'Test', 'Test 優一', '', '', 'dept-admin', '取引先', '', '', '', '', '', 'ja', '', '', 0, NULL, 'admin', '2015-03-03 01:32:49', NULL, NULL, 0),
('d6c1f45a-6ffe-11e4-bf19-78638984f957', 'admintest', 'ecda1ddb64ac9e6f442a196910fa3dc0b8eb1929', 'test', 'Admin', 'Admin test', 'Test', 'Admin', 'admin2', '管理者用2階層', '', '', '', '', '', 'ja', '', '', 0, NULL, 'admin', '2014-11-20 00:15:04', NULL, NULL, 0),
('efe235c2-9672-11e4-a3e5-b3f3ac838c32', 'member8', 'a53c3cc10ecae67ff1a3532a50f8f4136f64e78a', '8', 'member8', 'member8 8', '8', '8', NULL, '', '', '', '', '', '', 'ja', '', '', 0, NULL, 'admin', '2015-01-07 22:41:52', 'admin', '2015-01-07 22:45:24', 0),
('test001', 'test001', '62cbf61fbce67eeb64a226a50e1cb41fc80fc6fd', '太郎', 'テスト', 'テスト 太郎', 'ﾀﾛｳ', 'ﾃｽﾄ', '1212', '部所部署', '', '', '', '', '', 'ja', '', '', 0, NULL, 'admin', '2015-03-06 17:11:41', NULL, NULL, 0),
('test004', 'test004', 'fdc4b9cb887f6f0d888e2ee1558ad917e8ee12ea', '003', 'テスト', 'テスト 003', '004', 'テスト', '100000001', '部署テスト', '', '', '', '', '', 'ja', '', '', 0, NULL, 'admin', '2015-03-05 22:03:41', NULL, NULL, 0),
('test01', 'test01', 'c25a79c57906ba7027b36d380230db92bbc0fd64', 'User01', 'Test', 'Test User01', 'user', 'test', 'dept-admin', '取引先', '', '', 'test@example.com', '', '', 'en', '', '', 0, NULL, '1', '2014-09-17 18:01:55', 'admin', '2014-11-16 23:43:43', 0),
('0acc120c-3a4c-11e5-b951-00ff56603869', 'david', 'aa743a0aaec8f7d7a1f01442503957f4d7a2d634', NULL, NULL, NULL, NULL, NULL, NULL, 'web', NULL, '122333', 'david@gmail.com', NULL, 'developer', NULL, 'ygn', 'facebook.ico', 0, NULL, NULL, NULL, NULL, NULL, 0),
('25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', 'suyamin', '03a5fbce9f1480a607198d9e2d95718527c4ebcf', NULL, NULL, NULL, NULL, NULL, NULL, 'web', NULL, '23424', 'suyamin@gmail.com', NULL, 'developer', NULL, 'ygn', '', 0, NULL, NULL, NULL, NULL, NULL, 0),
('c8169087-3fd2-11e5-9c70-9c4fb7a929cf', 'Aung', 'ed991b466915e44d4c80e97a9f1be676b64a31f7', NULL, NULL, NULL, NULL, NULL, NULL, 'asfa', NULL, '220424', 'aung@gmail.com', NULL, 'afdfaf', NULL, 'ygn', '', 0, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_member_tax_deduce`
--

CREATE TABLE IF NOT EXISTS `core_member_tax_deduce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deduce_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `creator_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `core_member_tax_deduce`
--

INSERT INTO `core_member_tax_deduce` (`id`, `deduce_id`, `member_id`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(3, 'stay_father', '9af6af14-6e01-11e4-b676-82c4524d8ace', '', '2015-07-26 00:00:00', '', '0000-00-00 00:00:00', 0),
(4, 'stay_mother', '9af6af14-6e01-11e4-b676-82c4524d8ace', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(5, 'life_insurance', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(6, 'emp_ssc', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(8, 'stay_father', 'efe235c2-9672-11e4-a3e5-b3f3ac838c32', '', '2015-08-01 00:00:00', '', '0000-00-00 00:00:00', 0),
(9, 'stay_mother', 'efe235c2-9672-11e4-a3e5-b3f3ac838c32', '', '2015-08-01 00:00:00', '', '0000-00-00 00:00:00', 0),
(10, 'stay_father', 'a752879a-6e2b-11e4-b676-82c4524d8ace', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(11, 'stay_mother', 'a752879a-6e2b-11e4-b676-82c4524d8ace', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(12, 'stay_mother', 'a341f7e8-6e4a-11e4-b676-82c4524d8ace', '', '2015-08-01 00:00:00', '', '0000-00-00 00:00:00', 0),
(13, 'stay_father', '0acc120c-3a4c-11e5-b951-00ff56603869', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(14, 'stay_mother', '0acc120c-3a4c-11e5-b951-00ff56603869', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(15, '1', '', '', '2015-08-07 15:33:23', '', '0000-00-00 00:00:00', 0),
(16, '1', '', '', '2015-08-07 15:34:24', '', '0000-00-00 00:00:00', 0),
(18, 'stay_mother', 'c422a154-c0f9-11e4-a6dd-7a12eb6538e9', '', '2015-08-07 22:26:17', '', '0000-00-00 00:00:00', 0),
(19, 'stay_father', '517789a4-94fc-11e4-8cf4-3b7ec45c8174', '', '2015-08-07 22:36:35', '', '0000-00-00 00:00:00', 0),
(24, 'stay_father', 'a341f7e8-6e4a-11e4-b676-82c4524d8ace', '', '2015-08-11 08:18:43', '', '0000-00-00 00:00:00', 0),
(25, 'stay_mother', 'a341f7e8-6e4a-11e4-b676-82c4524d8ace', '', '2015-08-11 08:18:43', '', '0000-00-00 00:00:00', 0),
(26, 'stay_mother', 'c8169087-3fd2-11e5-9c70-9c4fb7a929cf', '', '2015-08-11 09:19:42', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_module`
--

CREATE TABLE IF NOT EXISTS `core_module` (
  `module_id` varchar(36) NOT NULL,
  `module_category_id` tinyint(1) unsigned DEFAULT NULL,
  `module_name_ja` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_name_en` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `module_version` int(10) unsigned DEFAULT NULL,
  `module_dt_updt` datetime DEFAULT NULL,
  `module_detail` text,
  `module_order` int(10) unsigned DEFAULT NULL,
  `deleted_flag` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_module`
--

INSERT INTO `core_module` (`module_id`, `module_category_id`, `module_name_ja`, `module_name_en`, `module_version`, `module_dt_updt`, `module_detail`, `module_order`, `deleted_flag`) VALUES
('admin', 1, 'admin', 'dashboard', NULL, NULL, NULL, 0, 0),
('attendance', 2, 'attendance', 'attendance', NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_permission`
--

CREATE TABLE IF NOT EXISTS `core_permission` (
  `permission_code` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `module_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `permission_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission_note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `permission_created_time` datetime DEFAULT NULL,
  `permission_updated_time` datetime DEFAULT NULL,
  `permission_is_deleted` tinyint(1) DEFAULT '0',
  `permission_creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `permission_updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_permission`
--

INSERT INTO `core_permission` (`permission_code`, `module_id`, `permission_name`, `permission_note`, `permission_created_time`, `permission_updated_time`, `permission_is_deleted`, `permission_creator_id`, `permission_updater_id`) VALUES
('admin_dashboard', 'admin', 'Dashboard', 'dashboard', NULL, NULL, 0, NULL, NULL),
('show_admin_attlist', 'attendance', 'Attendance List', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_user', 'user', 'Manage User', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_leave', 'leave', 'Leave days', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_calendar', 'calendar', 'Calendar', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Salary', NULL, NULL, NULL, 0, NULL, NULL),
('user_dashboard', 'checkinout', 'Dashboard', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_attlist', 'attendance', 'Attendance List', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_leave', 'leave', 'Leave days', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_attlist', 'attendance', 'Today List', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_attlist', 'attendance', 'Monthly List', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_user', 'user', 'Add User', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_user', 'user', 'User List', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_leave', 'leave', 'Leave List', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_leave', 'leave', 'Apply Leave', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Add Salary', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Salary List', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Monthly Salary List', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_calendar', 'calendar', 'Calendar', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_leave', 'leave', 'Leave List', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_leave', 'leave', 'Apply Leave', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Salary Setting', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Allowance', NULL, '2015-08-06 00:00:00', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_permission_group`
--

CREATE TABLE IF NOT EXISTS `core_permission_group` (
  `permission_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `permission_group_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `permission_group_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `order_num` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_permission_group`
--

INSERT INTO `core_permission_group` (`permission_code`, `permission_group_code`, `permission_group_name`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`, `order_num`) VALUES
('admin_dashboard', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('show_admin_attlist', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('show_admin_user', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('show_admin_leave', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('show_admin_calendar', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('show_salary', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('user_dashboard', 'USER', 'user', NULL, NULL, NULL, NULL, 0, 0),
('show_user_attlist', 'USER', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('show_user_leave', 'USER', 'user', NULL, NULL, NULL, NULL, 0, 0),
('show_user_calendar', 'USER', 'user', NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_permission_rel_dept`
--

CREATE TABLE IF NOT EXISTS `core_permission_rel_dept` (
  `rel_dept_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `rel_permission_group_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `core_permission_rel_member`
--

CREATE TABLE IF NOT EXISTS `core_permission_rel_member` (
  `rel_member_id` varchar(36) NOT NULL DEFAULT '0',
  `permission_member_group_member_name` varchar(100) DEFAULT NULL,
  `rel_permission_group_code` varchar(36) NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_dt` datetime NOT NULL,
  `permission_member_group_is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_permission_rel_member`
--

INSERT INTO `core_permission_rel_member` (`rel_member_id`, `permission_member_group_member_name`, `rel_permission_group_code`, `creator_id`, `created_dt`, `permission_member_group_is_deleted`) VALUES
('admin', 'administrator', 'ADMIN', '', '0000-00-00 00:00:00', 0),
('9af6af14-6e01-11e4-b676-82c4524d8ace', 'user', 'USER', '', '0000-00-00 00:00:00', 0),
('0acc120c-3a4c-11e5-b951-00ff56603869', 'user', 'USER', '', '0000-00-00 00:00:00', 0),
('25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', 'user', 'USER', '', '0000-00-00 00:00:00', 0),
('c8169087-3fd2-11e5-9c70-9c4fb7a929cf', 'user', 'USER', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_session`
--

CREATE TABLE IF NOT EXISTS `core_session` (
  `id` char(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `modified` int(11) DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `member_id`, `start_date`, `end_date`, `date`, `leave_days`, `leave_category`, `leave_description`, `leave_status`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(1, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-06-29 00:00:00', '2015-06-30 00:00:00', '2015-06-22 00:00:00', 2, 'sick', 'wan to take 2 days leave', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(2, '517789a4-94fc-11e4-8cf4-3b7ec45c8174', '2015-06-29 00:00:00', '2015-06-30 00:00:00', '2015-06-22 00:00:00', 2, 'vacation', '', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(3, 'admin', '2015-07-29 00:00:00', '2015-07-30 00:00:00', '2015-07-20 00:00:00', 1, 'Because of ill', 'ggg', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(4, 'admin', '2015-07-29 00:00:00', '2015-07-30 00:00:00', '2015-07-20 00:00:00', 1, 'Because of ill', 'ggg', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_detail`
--

CREATE TABLE IF NOT EXISTS `salary_detail` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `basic_salary` double NOT NULL,
  `travel_fee` double NOT NULL,
  `overtime` double NOT NULL,
  `ssc_comp` double NOT NULL,
  `ssc_emp` double NOT NULL,
  `absent_dedution` double NOT NULL,
  `income_tax` double NOT NULL,
  `pay_date` datetime NOT NULL,
  `creator_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salary_detail`
--

INSERT INTO `salary_detail` (`id`, `member_id`, `basic_salary`, `travel_fee`, `overtime`, `ssc_comp`, `ssc_emp`, `absent_dedution`, `income_tax`, `pay_date`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('7e028dae-4043-11e5-9d3e-bcee7bc172f2', 'a341f7e8-6e4a-11e4-b676-82c4524d8ace', 400000, 10000, 0, 9000, 6000, 0, 0, '2015-08-11 22:40:32', '', '2015-08-11 22:40:32', '', '0000-00-00 00:00:00', 0),
('7e0c564e-4043-11e5-9d3e-bcee7bc172f2', 'c8169087-3fd2-11e5-9c70-9c4fb7a929cf', 500000, 20000, 0, 9000, 6000, 0, 533, '2015-08-11 22:40:32', '', '2015-08-11 22:40:32', '', '0000-00-00 00:00:00', 0),
('7e105f05-4043-11e5-9d3e-bcee7bc172f2', '517789a4-94fc-11e4-8cf4-3b7ec45c8174', 600000, 30000, 13440, 9000, 6000, 0, 10200, '2015-08-11 22:40:32', '', '2015-08-11 22:40:32', '', '0000-00-00 00:00:00', 0),
('83031eb1-3f31-11e5-9208-4d4984bc2170', '517789a4-94fc-11e4-8cf4-3b7ec45c8174', 500000, 0, 0, 9000, 6000, 0, 7200, '2015-04-30 00:00:00', '', '2015-04-30 00:00:00', '', '0000-00-00 00:00:00', 0),
('96346efa-3f31-11e5-9208-4d4984bc2170', '517789a4-94fc-11e4-8cf4-3b7ec45c8174', 500000, 0, 0, 9000, 6000, 0, 7200, '2015-05-29 00:00:00', '', '2015-05-29 00:00:00', '', '0000-00-00 00:00:00', 0),
('aa9707e4-3f31-11e5-9208-4d4984bc2170', '517789a4-94fc-11e4-8cf4-3b7ec45c8174', 500000, 0, 0, 9000, 6000, 0, 7200, '2015-06-30 00:00:00', '', '2015-06-30 00:00:00', '', '0000-00-00 00:00:00', 0),
('e0d1aea2-3ff7-11e5-9c70-9c4fb7a929cf', 'a341f7e8-6e4a-11e4-b676-82c4524d8ace', 300000, 10000, 0, 9000, 6000, 0, 0, '2015-07-31 13:39:16', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
('f243fc56-3fdd-11e5-9c70-9c4fb7a929cf', '517789a4-94fc-11e4-8cf4-3b7ec45c8174', 600000, 30000, 13440, 9000, 6000, 0, 10200, '2015-07-31 10:33:38', '', '2015-07-31 00:00:00', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_master`
--

CREATE TABLE IF NOT EXISTS `salary_master` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'UUID',
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `position` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `basic_salary` double NOT NULL,
  `travel_fee` double NOT NULL,
  `over_time` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `ssc_emp` int(11) NOT NULL DEFAULT '2',
  `ssc_comp` int(11) NOT NULL DEFAULT '3',
  `allowance_id` int(11) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salary_master`
--

INSERT INTO `salary_master` (`id`, `member_id`, `position`, `basic_salary`, `travel_fee`, `over_time`, `ssc_emp`, `ssc_comp`, `allowance_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('18f3dc9c-3fcb-11e5-9c70-9c4fb7a929cf', 'a341f7e8-6e4a-11e4-b676-82c4524d8ace', 'Junior developer', 400000, 10000, '1', 2, 3, 0, '2015-07-01 00:00:00', '', '2015-08-11 00:00:00', 0),
('9e0c2a02-3fd3-11e5-9c70-9c4fb7a929cf', 'c8169087-3fd2-11e5-9c70-9c4fb7a929cf', 'Senior developer', 500000, 20000, '2', 2, 3, 0, '2015-08-03 00:00:00', '', '0000-00-00 00:00:00', 0),
('a81634f8-3d1e-11e5-b0fa-00ff56603869', '517789a4-94fc-11e4-8cf4-3b7ec45c8174', 'Leader', 600000, 30000, '2', 2, 3, 0, '2015-04-01 00:00:00', '', '2015-07-31 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_master_allowance`
--

CREATE TABLE IF NOT EXISTS `salary_master_allowance` (
  `allowance_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salary_master_allowance`
--

INSERT INTO `salary_master_allowance` (`allowance_id`, `member_id`) VALUES
('4a53fcdc-3d17-11e5-b0fa-00ff56603869', '517789a4-94fc-11e4-8cf4-3b7ec45c8174'),
('4a54bc11-3d17-11e5-b0fa-00ff56603869', '517789a4-94fc-11e4-8cf4-3b7ec45c8174'),
('4a53fcdc-3d17-11e5-b0fa-00ff56603869', 'c422a154-c0f9-11e4-a6dd-7a12eb6538e9'),
('4a54bc11-3d17-11e5-b0fa-00ff56603869', 'c422a154-c0f9-11e4-a6dd-7a12eb6538e9');

-- --------------------------------------------------------

--
-- Table structure for table `taxs`
--

CREATE TABLE IF NOT EXISTS `taxs` (
  `id` int(36) NOT NULL AUTO_INCREMENT,
  `taxs_from` double NOT NULL,
  `taxs_to` double NOT NULL,
  `taxs_rate` int(11) NOT NULL,
  `taxs_diff` double NOT NULL,
  `ssc_emp` int(11) NOT NULL,
  `ssc_comp` int(11) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `taxs`
--

INSERT INTO `taxs` (`id`, `taxs_from`, `taxs_to`, `taxs_rate`, `taxs_diff`, `ssc_emp`, `ssc_comp`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(1, 1, 2000000, 0, 0, 2, 3, '2015-07-28 00:00:00', '', '0000-00-00 00:00:00', 0),
(2, 2000001, 5000000, 5, 3000000, 2, 3, '2015-07-28 00:00:00', '', '0000-00-00 00:00:00', 0),
(3, 5000001, 10000000, 10, 5000000, 2, 3, '2015-07-28 00:00:00', '', '0000-00-00 00:00:00', 0),
(4, 10000001, 20000000, 15, 10000000, 2, 3, '2015-07-28 00:00:00', '', '0000-00-00 00:00:00', 0),
(5, 20000001, 30000000, 20, 10000000, 2, 3, '2015-07-28 00:00:00', '', '0000-00-00 00:00:00', 0),
(6, 30000001, 0, 25, 0, 2, 3, '2015-07-28 00:00:00', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `taxs_deduction`
--

CREATE TABLE IF NOT EXISTS `taxs_deduction` (
  `deduce_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `deduce_name` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `creator_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taxs_deduction`
--

INSERT INTO `taxs_deduction` (`deduce_id`, `deduce_name`, `amount`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('spouse', 'spouse', 1000000, '', '2015-07-25 00:00:00', '', '0000-00-00 00:00:00', 0),
('children', 'children', 500000, '', '2015-07-25 00:00:00', '', '0000-00-00 00:00:00', 0),
('stay_father', 'stay_with_father', 1000000, '', '2015-07-25 00:00:00', '', '0000-00-00 00:00:00', 0),
('stay_mother', 'stay_wiith_mother', 1000000, '', '2015-07-25 00:00:00', '', '0000-00-00 00:00:00', 0),
('life_insurance', 'life_insurance', 0, '', '2015-07-25 00:00:00', '', '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
