-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 09, 2016 at 11:18 AM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `attsys_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `absent`
--

CREATE TABLE IF NOT EXISTS `absent` (
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `absent`
--

INSERT INTO `absent` (`member_id`, `date`, `deleted_flag`) VALUES
('admin', '2015-09-28', 0),
('admin', '2015-09-29', 0),
('admin', '2015-10-11', 0),
('admin', '2015-10-12', 0),
('admin', '2015-11-11', 0),
('admin', '2015-11-12', 0),
('admin', '2015-12-11', 0),
('admin', '2015-12-12', 0),
('admin', '2016-01-01', 0),
('admin', '2016-01-04', 0),
('admin', '2016-02-08', 0),
('admin', '2016-02-09', 0),
('admin', '2016-03-01', 0),
('admin', '2016-03-02', 0),
('admin', '2016-04-01', 0),
('admin', '2016-04-04', 0),
('admin', '2016-05-30', 0),
('admin', '2016-05-31', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2015-11-30', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2015-12-24', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2015-12-28', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2015-12-28', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-01-01', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-01-05', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-02-10', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-02-11', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-03-24', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-03-25', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-04-01', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-04-04', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-05-30', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-05-31', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-06-02', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-06-03', 0),
('admin', '2015-08-19', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2015-08-28', 0),
('admin', '2015-12-17', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2015-12-17', 0),
('admin', '2015-12-01', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2015-12-01', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2015-12-23', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2015-12-23', 0),
('admin', '2016-02-10', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-02-10', 0),
('8654870a-9cb8-11e5-b242-4c3488333b45', '2015-12-24', 1),
('3a4a70e1-a463-11e5-bae2-4c3488333b45', '2015-12-30', 1),
('7468ef74-9efb-11e5-b637-4c3488333b45', '2015-12-30', 1),
('8654870a-9cb8-11e5-b242-4c3488333b45', '2016-01-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE IF NOT EXISTS `allowances` (
  `allowance_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `allowance_name` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `allowance_amount` double NOT NULL,
  `creator_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`allowance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `allowances`
--

INSERT INTO `allowances` (`allowance_id`, `allowance_name`, `allowance_amount`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('4a53fcdc-3d17-11e5-b0fa-00ff56603869', 'service year allowance', 25000, '', '2015-08-07 00:00:00', '', '0000-00-00 00:00:00', 0),
('4a54bc11-3d17-11e5-b0fa-00ff56603869', 'customer site allowance', 25000, '', '2015-08-07 00:00:00', '', '0000-00-00 00:00:00', 0),
('4ddb9efa-5646-11e5-b9ce-ebe9cc45f2ef', 'full attendance', 20000, 'admin', '2015-09-01 00:00:00', NULL, NULL, 0),
('995a94bf-422e-11e5-8238-31068db1cef7', 'Allowance A', 10000, '', '2015-08-14 04:46:01', '', '0000-00-00 00:00:00', 0),
('ed66a9f8-9f12-11e5-b637-4c3488333b45', 'medical allowance', 15000, NULL, '2015-12-10 08:52:14', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE IF NOT EXISTS `attendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `att_date` date NOT NULL,
  `checkin_time` datetime NOT NULL,
  `checkout_time` datetime DEFAULT NULL,
  `overtime` double DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `location` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noti_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `module_name` varchar(36) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'attendances',
  `creator_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=254 ;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `member_id`, `att_date`, `checkin_time`, `checkout_time`, `overtime`, `notes`, `lat`, `lng`, `location`, `noti_id`, `status`, `module_name`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(1, 'e1d64996-b4f3-11e5-a438-463b57030a29', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(2, '01afa768-b453-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(3, 'f44bca0c-b452-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(4, 'e12e1f7e-b452-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(5, 'c70cf156-b452-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(6, '1f59189a-b452-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(7, '0fc9a476-b452-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(8, '042bded6-b452-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(9, 'f72281e0-b451-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(10, 'eba9a370-b451-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(11, 'dfdfe87e-b451-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(12, 'd0126b92-b451-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(13, 'c174fc1c-b451-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(14, 'b1ebc4ce-b451-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(15, '93ead7b2-b451-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(16, '5d7d4d18-b451-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(17, '15376020-b451-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(18, '061e9824-b451-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(19, 'fa18ef7a-b450-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(20, 'e578083a-b450-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(21, 'd6ef7870-b450-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(22, 'c90c41ac-b450-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(23, 'b9b24896-b450-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(24, 'a05b3880-b450-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(25, '0f03332a-b44f-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(26, 'efaec50c-b44e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(27, '966c79ee-b44e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(28, '65065ea6-b44e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(29, '56600a50-b44e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(30, '427e8520-b44e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(31, '2e5f063c-b44e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(32, '1cae830e-b44e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(33, 'fdd352a2-b44d-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(34, '9112ec86-b44d-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(35, '81b05058-b44d-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(36, '6d846aba-b44d-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(37, '581b0f9e-b44d-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(38, '30be54ce-b44d-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(39, '23916afc-b44d-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(40, '105c2486-b44d-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(41, 'fe64c10c-b44c-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(42, 'f0a2ac14-b44c-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(43, 'dbaaae60-b44c-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(44, '826df79e-b44c-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(45, 'b5b5b6b0-b44b-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(46, '7fde072c-b44b-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(47, 'ed13b5de-b42e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(48, 'cdcb3fe4-b42e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(49, 'aa103320-b42e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(50, '87a1c1dc-b42e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(51, '5ee60fb4-b42e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(52, '337a1d2a-b42e-11e5-9869-f6341df67a83', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(53, '9e251b6e-a9ef-11e5-93db-d11a0cee87d7', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(54, '1e1d4874-9c89-11e5-8202-00bebb6ffa97', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(55, 'e6b33a22-98de-11e5-8643-3fc008e66a60', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(56, '500a5b26-98a4-11e5-8643-3fc008e66a60', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(57, '10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(58, 'c53f9fb6-91f4-11e5-8213-2f3ca2776dbb', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(59, '2cc32dba-91c8-11e5-ba6c-b3c9d3c668b5', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(60, 'e6166942-6f6a-11e5-8d57-845d45458be8', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(61, 'admin', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(62, '25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', '2016-01-19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(63, 'admin', '2016-01-20', '2016-01-20 02:12:49', NULL, NULL, 'a', NULL, NULL, '', '23251', 0, 'attendances', NULL, NULL, NULL, NULL, 0),
(64, '10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-01-20', '2016-01-20 03:27:36', NULL, NULL, 'traffic jam', NULL, NULL, '-', '19833', 0, 'attendances', NULL, NULL, NULL, NULL, 0),
(65, 'e1d64996-b4f3-11e5-a438-463b57030a29', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(66, '01afa768-b453-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(67, 'f44bca0c-b452-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(68, 'e12e1f7e-b452-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(69, 'c70cf156-b452-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(70, '1f59189a-b452-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(71, '0fc9a476-b452-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(72, '042bded6-b452-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(73, 'f72281e0-b451-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(74, 'eba9a370-b451-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(75, 'dfdfe87e-b451-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(76, 'd0126b92-b451-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(77, 'c174fc1c-b451-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(78, 'b1ebc4ce-b451-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(79, '93ead7b2-b451-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(80, '5d7d4d18-b451-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(81, '15376020-b451-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(82, '061e9824-b451-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(83, 'fa18ef7a-b450-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(84, 'e578083a-b450-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(85, 'd6ef7870-b450-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(86, 'c90c41ac-b450-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(87, 'b9b24896-b450-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(88, 'a05b3880-b450-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(89, '0f03332a-b44f-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(90, 'efaec50c-b44e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(91, '966c79ee-b44e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(92, '65065ea6-b44e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(93, '56600a50-b44e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(94, '427e8520-b44e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(95, '2e5f063c-b44e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(96, '1cae830e-b44e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(97, 'fdd352a2-b44d-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(98, '9112ec86-b44d-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(99, '81b05058-b44d-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(100, '6d846aba-b44d-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(101, '581b0f9e-b44d-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(102, '30be54ce-b44d-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(103, '23916afc-b44d-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(104, '105c2486-b44d-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(105, 'fe64c10c-b44c-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(106, 'f0a2ac14-b44c-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(107, 'dbaaae60-b44c-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(108, '826df79e-b44c-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(109, 'b5b5b6b0-b44b-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(110, '7fde072c-b44b-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(111, 'ed13b5de-b42e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(112, 'cdcb3fe4-b42e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(113, 'aa103320-b42e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(114, '87a1c1dc-b42e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(115, '5ee60fb4-b42e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(116, '337a1d2a-b42e-11e5-9869-f6341df67a83', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(117, '9e251b6e-a9ef-11e5-93db-d11a0cee87d7', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(118, '1e1d4874-9c89-11e5-8202-00bebb6ffa97', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(119, 'e6b33a22-98de-11e5-8643-3fc008e66a60', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(120, '500a5b26-98a4-11e5-8643-3fc008e66a60', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(121, 'c53f9fb6-91f4-11e5-8213-2f3ca2776dbb', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(122, '2cc32dba-91c8-11e5-ba6c-b3c9d3c668b5', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(123, 'e6166942-6f6a-11e5-8d57-845d45458be8', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(124, '25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', '2016-01-20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(125, 'admin', '2016-01-21', '2016-01-21 01:38:34', NULL, NULL, 'test', NULL, NULL, 'Myanmar', '25779', 0, 'attendances', NULL, NULL, NULL, NULL, 0),
(126, 'e1d64996-b4f3-11e5-a438-463b57030a29', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(127, '01afa768-b453-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(128, 'f44bca0c-b452-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(129, 'e12e1f7e-b452-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(130, 'c70cf156-b452-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(131, '1f59189a-b452-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(132, '0fc9a476-b452-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(133, '042bded6-b452-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(134, 'f72281e0-b451-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(135, 'eba9a370-b451-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(136, 'dfdfe87e-b451-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(137, 'd0126b92-b451-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(138, 'c174fc1c-b451-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(139, 'b1ebc4ce-b451-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(140, '93ead7b2-b451-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(141, '5d7d4d18-b451-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(142, '15376020-b451-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(143, '061e9824-b451-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(144, 'fa18ef7a-b450-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(145, 'e578083a-b450-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(146, 'd6ef7870-b450-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(147, 'c90c41ac-b450-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(148, 'b9b24896-b450-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(149, 'a05b3880-b450-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(150, '0f03332a-b44f-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(151, 'efaec50c-b44e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(152, '966c79ee-b44e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(153, '65065ea6-b44e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(154, '56600a50-b44e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(155, '427e8520-b44e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(156, '2e5f063c-b44e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(157, '1cae830e-b44e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(158, 'fdd352a2-b44d-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(159, '9112ec86-b44d-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(160, '81b05058-b44d-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(161, '6d846aba-b44d-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(162, '581b0f9e-b44d-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(163, '30be54ce-b44d-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(164, '23916afc-b44d-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(165, '105c2486-b44d-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(166, 'fe64c10c-b44c-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(167, 'f0a2ac14-b44c-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(168, 'dbaaae60-b44c-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(169, '826df79e-b44c-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(170, 'b5b5b6b0-b44b-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(171, '7fde072c-b44b-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(172, 'ed13b5de-b42e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(173, 'cdcb3fe4-b42e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(174, 'aa103320-b42e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(175, '87a1c1dc-b42e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(176, '5ee60fb4-b42e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(177, '337a1d2a-b42e-11e5-9869-f6341df67a83', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(178, '9e251b6e-a9ef-11e5-93db-d11a0cee87d7', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(179, '1e1d4874-9c89-11e5-8202-00bebb6ffa97', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(180, 'e6b33a22-98de-11e5-8643-3fc008e66a60', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(181, '500a5b26-98a4-11e5-8643-3fc008e66a60', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(182, '10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(183, 'c53f9fb6-91f4-11e5-8213-2f3ca2776dbb', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(184, '2cc32dba-91c8-11e5-ba6c-b3c9d3c668b5', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(185, 'e6166942-6f6a-11e5-8d57-845d45458be8', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(186, '25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', '2016-01-21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(187, 'admin', '2016-01-22', '2016-01-22 02:30:00', NULL, NULL, 'sss', NULL, NULL, '-', '2111', 0, 'attendances', NULL, NULL, NULL, NULL, 0),
(188, '10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-01-26', '2016-01-25 18:30:00', NULL, NULL, '', NULL, NULL, 'Myanmar', '9294', 0, 'attendances', NULL, NULL, NULL, NULL, 0),
(190, 'admin', '2016-01-26', '2016-01-25 18:30:01', '2016-01-26 09:36:21', 7.11, '', NULL, NULL, '-', '9534', 0, 'attendances', NULL, NULL, NULL, NULL, 0),
(191, '1a35d7df-c404-11e5-befc-34689590deea', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(192, 'e1d64996-b4f3-11e5-a438-463b57030a29', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(193, '01afa768-b453-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(194, 'f44bca0c-b452-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(195, 'e12e1f7e-b452-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(196, 'c70cf156-b452-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(197, '1f59189a-b452-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(198, '0fc9a476-b452-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(199, '042bded6-b452-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(200, 'f72281e0-b451-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(201, 'eba9a370-b451-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(202, 'dfdfe87e-b451-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(203, 'd0126b92-b451-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(204, 'c174fc1c-b451-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(205, 'b1ebc4ce-b451-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(206, '93ead7b2-b451-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(207, '5d7d4d18-b451-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(208, '15376020-b451-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(209, '061e9824-b451-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(210, 'fa18ef7a-b450-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(211, 'e578083a-b450-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(212, 'd6ef7870-b450-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(213, 'c90c41ac-b450-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(214, 'b9b24896-b450-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(215, 'a05b3880-b450-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(216, '0f03332a-b44f-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(217, 'efaec50c-b44e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(218, '966c79ee-b44e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(219, '65065ea6-b44e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(220, '56600a50-b44e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(221, '427e8520-b44e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(222, '2e5f063c-b44e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(223, '1cae830e-b44e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(224, 'fdd352a2-b44d-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(225, '9112ec86-b44d-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(226, '81b05058-b44d-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(227, '6d846aba-b44d-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(228, '581b0f9e-b44d-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(229, '30be54ce-b44d-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(230, '23916afc-b44d-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(231, '105c2486-b44d-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(232, 'fe64c10c-b44c-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(233, 'f0a2ac14-b44c-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(234, 'dbaaae60-b44c-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(235, '826df79e-b44c-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(236, 'b5b5b6b0-b44b-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(237, '7fde072c-b44b-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(238, 'ed13b5de-b42e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(239, 'cdcb3fe4-b42e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(240, 'aa103320-b42e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(241, '87a1c1dc-b42e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(242, '5ee60fb4-b42e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(243, '337a1d2a-b42e-11e5-9869-f6341df67a83', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(244, '9e251b6e-a9ef-11e5-93db-d11a0cee87d7', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(245, '1e1d4874-9c89-11e5-8202-00bebb6ffa97', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(246, 'e6b33a22-98de-11e5-8643-3fc008e66a60', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(247, '500a5b26-98a4-11e5-8643-3fc008e66a60', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(248, '10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(249, 'c53f9fb6-91f4-11e5-8213-2f3ca2776dbb', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(250, '2cc32dba-91c8-11e5-ba6c-b3c9d3c668b5', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(251, 'e6166942-6f6a-11e5-8d57-845d45458be8', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0),
(252, 'admin', '2016-01-27', '2016-01-27 03:04:27', NULL, NULL, 'benkyou', NULL, NULL, '', '25478', 0, 'attendances', NULL, NULL, NULL, NULL, 0),
(253, '25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', '2016-01-27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 2, 'attendances', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  `allDay` varchar(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `noti_id` varchar(36) NOT NULL,
  `module_name` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'calendar',
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `member_name`, `member_id`, `title`, `startdate`, `enddate`, `allDay`, `noti_id`, `module_name`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(2, 'Admin test', '', 'dd', '2015-10-16 00:00:00', '2015-10-16 00:00:00', 'true', '1585388791', 'calendar', NULL, NULL, NULL, NULL, 0),
(4, 'Admin test', 'd6c1f45a-6ffe-11e4-bf19-78638984f957', 'ddd', '2015-10-06 00:00:00', '2015-10-07 00:00:00', 'true', '1854985496', 'calendar', NULL, NULL, NULL, NULL, 0),
(5, 'test02', '9af6af14-6e01-11e4-b676-82c4524d8ace', 'ggggg', '2015-09-29 00:00:00', '2015-09-30 00:00:00', 'true', '1600579780', 'calendar', NULL, NULL, NULL, NULL, 0),
(6, 'test02', '9af6af14-6e01-11e4-b676-82c4524d8ace', 'hhh', '2015-09-29 00:00:00', '2015-09-30 00:00:00', 'true', '1581607760', 'calendar', NULL, NULL, NULL, NULL, 0),
(7, 'test02', 'undefined', 'testing', '2015-11-10 00:00:00', '2015-11-11 00:00:00', 'true', '203295855', 'calendar', NULL, NULL, NULL, NULL, 0),
(9, 'test', '', 'ttt', '2015-11-23 00:00:00', '2015-11-24 00:00:00', 'true', '1048502512', 'calendar', NULL, NULL, NULL, NULL, 0),
(10, 'test02', '', 'ggg', '2015-11-23 00:00:00', '2015-11-24 00:00:00', 'true', '283493249', 'calendar', NULL, NULL, NULL, NULL, 0),
(12, 'test', '9af6af14-6e01-11e4-b676-82c4524d8ace', 'sdd', '2015-12-07 00:00:00', '2015-12-08 00:00:00', 'true', '21083', 'calendar', 'admin', '2015-12-02 14:26:40', NULL, NULL, 0),
(13, 'data', '', 'test', '2015-12-15 00:00:00', '2015-12-16 00:00:00', 'true', '31480', 'calendar', 'admin', '2015-12-02 14:27:14', NULL, NULL, 0),
(20, 'suyamin ', 'admin', 'sdd', '2016-01-12 00:00:00', '2016-01-13 00:00:00', 'true', '13878', 'calendar', 'admin', '2015-12-02 14:39:00', NULL, NULL, 0),
(21, 'a', 'e20fed11-9722-11e5-a6cf-4cbb58fbbeea', 'admin"test"', '2015-12-15 00:00:00', '2015-12-16 00:00:00', 'true', '29123', 'calendar', 'admin', '2015-12-02 14:40:48', NULL, NULL, 0),
(22, 'suyamin ', 'admin', 'admin''test''', '2015-12-08 00:00:00', '2015-12-09 00:00:00', 'true', '14647', 'calendar', 'admin', '2015-12-02 14:41:29', NULL, NULL, 0),
(23, 's', '013c8dcf-9898-11e5-90f1-4cbb58fbbeea', 'admin,ljh', '2015-12-09 00:00:00', '2015-12-10 00:00:00', 'true', '24103', 'calendar', 'admin', '2015-12-02 14:42:49', NULL, NULL, 0),
(24, 'malkhin', 'admin', 'ChristMas War Tee', '2015-12-22 00:00:00', '2015-12-23 00:00:00', 'true', '30478', 'calendar', 'admin', '2015-12-10 13:38:51', NULL, NULL, 0),
(25, 'SawZinMT', 'admin', ':D', '2015-12-14 00:00:00', '2015-12-17 00:00:00', 'true', '2841', 'calendar', 'admin', '2015-12-24 11:15:50', NULL, NULL, 0),
(26, 'test02', '8654870a-9cb8-11e5-b242-4c3488333b45', 'ff', '2015-12-29 00:00:00', '2015-12-30 00:00:00', 'true', '12697', 'calendar', '3a4a70e1-a463-11e5-bae2-4c3488333b45', '2015-12-29 09:05:00', NULL, NULL, 0),
(27, 'suzin', 'c53f9fb6-91f4-11e5-8213-2f3ca2776dbb', 'sdd', '2015-12-30 00:00:00', '2015-12-31 00:00:00', 'true', '17553', 'calendar', '3a4a70e1-a463-11e5-bae2-4c3488333b45', '2015-12-29 09:08:11', NULL, NULL, 0),
(28, 'admin', 'admin', '44', '2016-01-06 00:00:00', '2016-01-06 00:00:00', 'true', '17424', 'calendar', 'admin', '2016-01-25 09:50:20', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE IF NOT EXISTS `company_info` (
  `company_name` varchar(36) NOT NULL,
  `company_logo` varchar(20) NOT NULL,
  `company_address` varchar(60) NOT NULL,
  `company_phno` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`company_name`, `company_logo`, `company_address`, `company_phno`) VALUES
('G NEXT Co.,Ltd', '65040.jpg', '(7+1)A,Parami Condo,Ma Yan Gone TownShip', '01522997');

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
  `member_id` varchar(500) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'uuid',
  `user_rule_member_id` int(50) NOT NULL AUTO_INCREMENT,
  `member_login_name` varchar(256) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_password` varchar(128) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `full_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Combine first_name and family_name',
  `member_dept_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_mobile_tel` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_mail` varchar(256) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `position` varchar(64) DEFAULT NULL,
  `user_rule` int(50) DEFAULT NULL,
  `lang` varchar(2) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'en',
  `member_address` varchar(75) DEFAULT NULL,
  `member_profile` varchar(70) DEFAULT NULL,
  `rank_code` tinyint(3) unsigned DEFAULT '0',
  `member_is_change` tinyint(1) DEFAULT NULL,
  `working_start_dt` date NOT NULL,
  `working_year_by_year` date DEFAULT NULL,
  `rs_status` varchar(20) DEFAULT NULL,
  `timeflag` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_rule_member_id`),
  UNIQUE KEY `user_rule_member_id` (`user_rule_member_id`),
  KEY `member_login_name` (`member_login_name`),
  KEY `user_rule_member_id_2` (`user_rule_member_id`),
  KEY `user_rule_member_id_3` (`user_rule_member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `core_member`
--

INSERT INTO `core_member` (`member_id`, `user_rule_member_id`, `member_login_name`, `member_password`, `full_name`, `member_dept_name`, `member_mobile_tel`, `member_mail`, `position`, `user_rule`, `lang`, `member_address`, `member_profile`, `rank_code`, `member_is_change`, `working_start_dt`, `working_year_by_year`, `rs_status`, `timeflag`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('admin', 1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'wheel', '1234567', 'sample@test.comFF', 'Adminstrator', 0, 'en', 'yangon ', '', 1, NULL, '2015-02-02', NULL, '', '2016-01-24 07:28:52', '1', '2014-09-22 11:41:47', 'admin', '2015-05-18 10:45:27', 0),
('25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', 2, 'suyamin', '03a5fbce9f1480a607198d9e2d95718527c4ebcf', 'suyamin ', 'web', '23424', 'suyamin@gmail.com', 'developer', 4, NULL, 'ygn', '', 0, NULL, '0000-00-00', NULL, '', '2016-01-21 06:36:03', NULL, NULL, NULL, NULL, 0),
('e6166942-6f6a-11e5-8d57-845d45458be8', 3, 'zinmon', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'zin mon', 'web', '22', 'zinmonthet88@gmail.com', 'developer', 0, NULL, 'ygn', '36983.jpg', 0, NULL, '2015-02-02', NULL, '', '2016-01-21 06:36:03', 'admin', '2015-02-02 22:51:02', NULL, '0000-00-00 00:00:00', 0),
('9496c284-91b5-11e5-ba6c-b3c9d3c668b5', 4, 'kyaw', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'kyaw', 'web', '133399', 'zinmonthet88@gmail.com', 'senior developer', NULL, NULL, 'aa', '71570.', 0, NULL, '2015-11-02', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2015-11-23 14:11:17', NULL, '0000-00-00 00:00:00', 1),
('2cc32dba-91c8-11e5-ba6c-b3c9d3c668b5', 5, 'mon', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mon', 'web', '133399', 'zinmonthet88@gmail.com', 'senior developer', NULL, 'en', 'adfsaf', '77683.', 0, NULL, '2015-11-02', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2015-11-23 16:24:23', NULL, '0000-00-00 00:00:00', 0),
('c53f9fb6-91f4-11e5-8213-2f3ca2776dbb', 6, 'khin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'khin', 'engineering', '133399', 'khin@gmail.com', 'senior developer', NULL, 'en', 'ggg', '11947.', 0, NULL, '2015-11-02', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2015-11-23 21:43:37', NULL, '0000-00-00 00:00:00', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', 7, 'malkhin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'malkhin', 'web', '133399', 'zinmonthet88@gmail.com', 'senior developer', 4, 'en', 'afdaf', '57864.jpg', 0, NULL, '2015-11-02', NULL, NULL, '2016-01-25 08:26:19', 'admin', '2015-11-27 08:26:25', NULL, '0000-00-00 00:00:00', 0),
('2fb953a8-989b-11e5-8643-3fc008e66a60', 8, 'mayzin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mayzin', 'web', '133399', 'zinmonthet88@gmail.com', 'akf', 2, 'en', 'afad', '99573.', 0, NULL, '2015-12-01', NULL, NULL, '2016-01-21 07:06:06', 'admin', '2015-12-02 08:49:59', NULL, '0000-00-00 00:00:00', 1),
('500a5b26-98a4-11e5-8643-3fc008e66a60', 9, 'mone', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mone', 'web', '133399', 'zinmonthet88@gmail.com', 'senior developer', 2, 'en', 'adfafd', '12942.jpg', 0, NULL, '2015-12-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2015-12-02 09:55:18', NULL, '0000-00-00 00:00:00', 0),
('1455f388-91b5-11e5-ba6c-b3c9d3c668b5', 10, 'mm', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mm', 'gh', '133399', 'zinmonthet88@gmail.com', 'akf', 4, 'en', 'adfasf', '87636.jpg', 0, NULL, '2015-12-01', '2016-12-01', NULL, '2016-01-21 06:36:03', 'admin', '2015-12-02 16:14:26', NULL, '0000-00-00 00:00:00', 1),
('e6b33a22-98de-11e5-8643-3fc008e66a60', 11, 'Ko Ko', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Ko Ko', 'web', '3583409', 'aaa@gmail.com', 'senior developer', 4, 'en', 'Yangon', '86433.', 0, NULL, '2015-10-05', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2015-12-02 16:54:42', NULL, '0000-00-00 00:00:00', 0),
('1fe99868-9a42-11e5-9896-c672e8365401', 12, 'mimi', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mi mi', 'web', '133399', 'gnext.suzin@gmail.com', 'senior developer', 4, 'en', 'ygn', '21927.jpg', 0, NULL, '2015-12-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2015-12-04 11:17:29', NULL, '0000-00-00 00:00:00', 1),
('1e1d4874-9c89-11e5-8202-00bebb6ffa97', 14, 'testing', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'htoo', 'web', '133399', 'gnext.suzin@gmail.com', 'senior developer', 4, 'en', 'ygn', '22832.jpg', 0, NULL, '2015-12-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2015-12-07 08:50:43', NULL, '0000-00-00 00:00:00', 0),
('9e251b6e-a9ef-11e5-93db-d11a0cee87d7', 15, 'aung', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'aung', 'web', '222222', 'aung@gmail.com', 'developer', 3, 'en', 'ygn', '50297.jpg', 0, NULL, '2015-12-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2015-12-24 10:07:12', NULL, '0000-00-00 00:00:00', 0),
('337a1d2a-b42e-11e5-9869-f6341df67a83', 16, 'Auser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'auser', 'design', '1233', 'auser@gmail.com', 'designer', 4, 'en', 'ygn', '89497.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 11:00:22', NULL, '0000-00-00 00:00:00', 0),
('5ee60fb4-b42e-11e5-9869-f6341df67a83', 17, 'Buser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'buser', 'web', '32424', 'buser@gmail.com', 'developer', 4, 'en', 'mdy', '82250.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 11:01:35', NULL, '0000-00-00 00:00:00', 0),
('87a1c1dc-b42e-11e5-9869-f6341df67a83', 18, 'Cuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'cuser', 'engineering', '234204', 'buser@gmail.com', 'engineer', 4, 'en', 'ygn', '58728.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 11:02:44', NULL, '0000-00-00 00:00:00', 0),
('aa103320-b42e-11e5-9869-f6341df67a83', 19, 'Duser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'duser', 'web', '324241', 'duser@gmail.com', 'developer', 4, 'en', 'mdy', '80699.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 11:03:41', NULL, '0000-00-00 00:00:00', 0),
('cdcb3fe4-b42e-11e5-9869-f6341df67a83', 20, 'Euser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'euser', 'engineering', '1234', 'euser@gmail.com', 'engineer', 4, 'en', 'mdy', '80500.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 11:04:41', NULL, '0000-00-00 00:00:00', 0),
('ed13b5de-b42e-11e5-9869-f6341df67a83', 21, 'Fuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'fuser', 'web', '29302', 'fuser@gmail.com', 'developer', 4, 'en', 'mdy', '5917.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 11:05:34', NULL, '0000-00-00 00:00:00', 0),
('7fde072c-b44b-11e5-9869-f6341df67a83', 22, 'Guser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Guser', 'Gnext', '22213141', 'Guser@gmail.com', 'developer', 4, 'en', 'yangon', '40092.png', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:30:06', NULL, '0000-00-00 00:00:00', 0),
('b5b5b6b0-b44b-11e5-9869-f6341df67a83', 23, 'Huser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Huser', 'Hostin', '2974194701', 'Huser@gmail.com', 'Hh', 4, 'en', 'Seoul', '30384.jpg', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:31:36', NULL, '0000-00-00 00:00:00', 0),
('826df79e-b44c-11e5-9869-f6341df67a83', 24, 'Iuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Iuser', 'Itest', '98529525', 'Iuser@gmail.com', 'testor', 4, 'en', '', '38759.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:37:20', NULL, '0000-00-00 00:00:00', 0),
('dbaaae60-b44c-11e5-9869-f6341df67a83', 25, 'Juser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Juser', 'Just', '57252525', 'Juser@gmail.com', 'Juser', 4, 'en', 'ygn', '84601.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:39:50', NULL, '0000-00-00 00:00:00', 0),
('f0a2ac14-b44c-11e5-9869-f6341df67a83', 26, 'Kuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Kuser', 'Kuser', '341947104', 'Kuser@gmail.com', 'Kuser', 4, 'en', 'yangon', '70374.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:40:25', NULL, '0000-00-00 00:00:00', 0),
('fe64c10c-b44c-11e5-9869-f6341df67a83', 27, 'Luser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Luser', 'L', '03277473', 'Luser@gmail.com', 'Luser', 4, 'en', 'ygn\r\n\r\n', '6690.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:40:48', NULL, '0000-00-00 00:00:00', 0),
('105c2486-b44d-11e5-9869-f6341df67a83', 28, 'Muser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Muser', 'testing', '4975', 'Muser@gmail.com', 'Muser', 4, 'en', 'ygn', '96992.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:41:18', NULL, '0000-00-00 00:00:00', 0),
('23916afc-b44d-11e5-9869-f6341df67a83', 29, 'Nuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Nuser', 'web', '7104701741', 'Nuser@gmail.com', 'developer', 1, 'en', 'tokyo', '49298.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:41:50', NULL, '0000-00-00 00:00:00', 0),
('30be54ce-b44d-11e5-9869-f6341df67a83', 30, 'Ouser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Ousr', 'web', '4701401747', 'Ouser@gmail.com', 'testor', 4, 'en', 'japan', '71856.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:42:12', NULL, '0000-00-00 00:00:00', 0),
('581b0f9e-b44d-11e5-9869-f6341df67a83', 31, 'Puser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Puser', 'web', '307144714791', 'Puser@gmail.com', 'developer', 4, 'en', 'ygn', '15586.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:43:18', NULL, '0000-00-00 00:00:00', 0),
('6d846aba-b44d-11e5-9869-f6341df67a83', 32, 'Quser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Quser', 'web', '3741479174', 'Quser@gmail.com', 'developer', 4, 'en', 'Ygn', '67771.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:43:54', NULL, '0000-00-00 00:00:00', 0),
('81b05058-b44d-11e5-9869-f6341df67a83', 33, 'Ruser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Ruser', 'web', '73017014', 'Ruser@gmail.com', 'developer', 4, 'en', 'myanmar', '19448.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:44:28', NULL, '0000-00-00 00:00:00', 0),
('9112ec86-b44d-11e5-9869-f6341df67a83', 34, 'Suser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Suser', 'web', '383410801', 'Suser@gmail.com', 'developer', 4, 'en', 'ygn\r\n\r\n', '36325.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:44:54', NULL, '0000-00-00 00:00:00', 0),
('fdd352a2-b44d-11e5-9869-f6341df67a83', 35, 'Tuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Tuser', 'web', '797252525', 'Tuser@gmail.com', 'developer', 4, 'en', 'yangon', '18455.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:47:56', NULL, '0000-00-00 00:00:00', 0),
('1cae830e-b44e-11e5-9869-f6341df67a83', 36, 'Uuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'User', 'web', '3807101502', 'User@gmail.com', 'developer', 4, 'en', 'myanmar', '65063.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:48:48', NULL, '0000-00-00 00:00:00', 0),
('2e5f063c-b44e-11e5-9869-f6341df67a83', 37, 'Vuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Vuser', 'web', '3710704714', 'Vuser@gmail.com', 'testor', 4, 'en', 'Yangon', '63067.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:49:18', NULL, '0000-00-00 00:00:00', 0),
('427e8520-b44e-11e5-9869-f6341df67a83', 38, 'Wuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Wuser', 'web', '73701740174', 'Wuserrr@gmail.com', 'testor', 4, 'en', 'ygn', '21093.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:49:52', NULL, '0000-00-00 00:00:00', 0),
('56600a50-b44e-11e5-9869-f6341df67a83', 39, 'Xuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Xuser', 'web', '707407402', 'Xuser@gmail.com', 'testor', 1, 'en', 'myanmar', '36345.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:50:25', NULL, '0000-00-00 00:00:00', 0),
('65065ea6-b44e-11e5-9869-f6341df67a83', 40, 'Yuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Yuser', 'web', '8404274502', 'Yuser@gmail.com', 'developer', 4, 'en', 'ygn\r\n\r\n', '80022.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:50:50', NULL, '0000-00-00 00:00:00', 0),
('966c79ee-b44e-11e5-9869-f6341df67a83', 41, 'Zuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Zuser', 'web', '125725702', 'Zuser@gmail.com', 'developer', 4, 'en', 'ygn', '55318.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:52:12', NULL, '0000-00-00 00:00:00', 0),
('efaec50c-b44e-11e5-9869-f6341df67a83', 42, 'AA', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'AA', 'web', '710471047414', 'AA@gmail.com', 'developere', 4, 'en', 'ygn', '40583.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:54:42', NULL, '0000-00-00 00:00:00', 0),
('0f03332a-b44f-11e5-9869-f6341df67a83', 43, 'BB', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'BB', 'web', '12244142', 'BB@gmail.com', 'developer', 1, 'en', 'ygn', '29380.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 14:55:35', NULL, '0000-00-00 00:00:00', 0),
('a05b3880-b450-11e5-9869-f6341df67a83', 44, 'CC', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'CC', 'CC', '70252525', 'Cc@c.com', 'developer', 4, 'en', 'ygn', '99054.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:06:48', NULL, '0000-00-00 00:00:00', 0),
('b9b24896-b450-11e5-9869-f6341df67a83', 45, 'DD', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'DD', 'web', '4047025', 'DD@d.com', 'develooper', 4, 'en', 'ygn', '85660.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:07:31', NULL, '0000-00-00 00:00:00', 0),
('c90c41ac-b450-11e5-9869-f6341df67a83', 46, 'EE', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123', 'web', '74017470274', 'EE@e.com', 'weber', 4, 'en', 'ygn', '15758.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:07:56', NULL, '0000-00-00 00:00:00', 0),
('d6ef7870-b450-11e5-9869-f6341df67a83', 47, 'FF', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'FF', 'web', '37474', 'FF@f.com', 'testor', 4, 'en', 'ygn', '96629.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:08:20', NULL, '0000-00-00 00:00:00', 0),
('e578083a-b450-11e5-9869-f6341df67a83', 48, 'GG', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'GG', 'GG', '704417401', 'G@g.com', 'GG', 4, 'en', 'YGN', '34875.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:08:44', NULL, '0000-00-00 00:00:00', 0),
('fa18ef7a-b450-11e5-9869-f6341df67a83', 49, 'HH', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'HH', 'HH', '7794794', 'HH@H.com', 'HH', 4, 'en', 'ygn', '13759.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:09:19', NULL, '0000-00-00 00:00:00', 0),
('061e9824-b451-11e5-9869-f6341df67a83', 50, 'II', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'II', 'II', '4730472', 'II@i.com', 'II', 4, 'en', 'ygn', '89548.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:09:39', NULL, '0000-00-00 00:00:00', 0),
('15376020-b451-11e5-9869-f6341df67a83', 51, 'JJ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'JJ', 'web', '4344535', 'JJ@jl.ccom', 'weber', 4, 'en', 'ygn', '51084.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:10:04', NULL, '0000-00-00 00:00:00', 0),
('5d7d4d18-b451-11e5-9869-f6341df67a83', 52, 'KK', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'kk', 'ss', '242', 'kk@gmail.com', 'senior developer', 4, 'en', 'gg', '25827.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:12:05', NULL, '0000-00-00 00:00:00', 0),
('93ead7b2-b451-11e5-9869-f6341df67a83', 53, 'LL', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'LL', 'web', '133399', 'aaa@gmail.com', 'senior developer', 4, 'en', 'a', '47713.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:13:37', NULL, '0000-00-00 00:00:00', 0),
('b1ebc4ce-b451-11e5-9869-f6341df67a83', 54, 'NN', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'NN', 'web', '133399', 'gnext.suzin@gmail.com', 'senior developer', 4, 'en', 'tt', '66333.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:14:27', NULL, '0000-00-00 00:00:00', 0),
('c174fc1c-b451-11e5-9869-f6341df67a83', 55, 'OO', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'OO', 'engineering', '123913', 'zinmonthet88@gmail.com', 'senior developer', 4, 'en', 'g', '86721.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:14:53', NULL, '0000-00-00 00:00:00', 0),
('d0126b92-b451-11e5-9869-f6341df67a83', 56, 'PP', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'PP', 'engineering', '133399', 'kar.yann.lay@gmail.com', 'senior developer', 4, 'en', 'adfa', '92330.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:15:18', NULL, '0000-00-00 00:00:00', 0),
('dfdfe87e-b451-11e5-9869-f6341df67a83', 57, 'QQ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'QQ', 'web', '133399', 'gnext.suzin@gmail.com', 'senior developer', 4, 'en', 'gafad\r\n\r\n', '88362.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:15:44', NULL, '0000-00-00 00:00:00', 0),
('eba9a370-b451-11e5-9869-f6341df67a83', 58, 'RR', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'RR', 'web', '123913', 'zinmonthet88@gmail.com', 'senior developer', 4, 'en', 'afa', '7737.', 0, NULL, '2016-01-01', '2018-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:16:04', NULL, '0000-00-00 00:00:00', 0),
('f72281e0-b451-11e5-9869-f6341df67a83', 59, 'SS', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'SS', 'engineering', '123913', 'gnext.suzin@gmail.com', 'senior developer', 4, 'en', 'afadsf', '86754.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:16:23', NULL, '0000-00-00 00:00:00', 0),
('042bded6-b452-11e5-9869-f6341df67a83', 60, 'TT', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TT', 'web', '133399', 'kar.yann.lay@gmail.com', 'senior developer', 4, 'en', 'afaf', '13895.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:16:45', NULL, '0000-00-00 00:00:00', 0),
('0fc9a476-b452-11e5-9869-f6341df67a83', 61, 'UU', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'UU', 'web', '133399', 'kar.yann.lay@gmail.com', 'senior developer', 4, 'en', 'afefs', '67569.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:17:04', NULL, '0000-00-00 00:00:00', 0),
('1f59189a-b452-11e5-9869-f6341df67a83', 62, 'VV', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'VV', 'web', '133399', 'chan@gmail.com', 'senior developer', 4, 'en', 'aff', '17378.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:17:31', NULL, '0000-00-00 00:00:00', 0),
('c70cf156-b452-11e5-9869-f6341df67a83', 63, 'ww', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ww', 'WEB', '73072052', 'WW@gmail.com', 'DEVELOPER', 4, 'en', 'yangon', '64846.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:22:12', NULL, '0000-00-00 00:00:00', 0),
('e12e1f7e-b452-11e5-9869-f6341df67a83', 64, 'XX', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'XX', 'web', '470750275', 'xx@gmail.com', 'developer', 4, 'en', 'yangon', '26078.', 0, NULL, '2016-01-01', '2019-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:22:56', NULL, '0000-00-00 00:00:00', 0),
('f44bca0c-b452-11e5-9869-f6341df67a83', 65, 'YY', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'YY', 'web', '7074174014', 'YY@y.com', 'developer', 4, 'en', 'sddad', '24901.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:23:28', NULL, '0000-00-00 00:00:00', 0),
('01afa768-b453-11e5-9869-f6341df67a83', 66, 'ZZ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ZZ', 'web', '7307104701', 'zz@z.com', 'developer', 4, 'en', 'ygn', '43141.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 06:36:03', 'admin', '2016-01-06 15:23:50', NULL, '0000-00-00 00:00:00', 0),
('e1d64996-b4f3-11e5-a438-463b57030a29', 67, 'gnext', 'c1dbb35856011d51c4d532c2b1b851dfb0d9eaa7', 'gnext', 'web', '133399', 'gnext.suzin@gmail.com', 'senior developer', 4, 'en', 'aaa', '2446.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 06:36:03', 'admin', '2016-01-07 10:35:26', NULL, '0000-00-00 00:00:00', 0),
('1a35d7df-c404-11e5-befc-34689590deea', 68, 'phalcon', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'phalcon', 'phalcon', '12345677', 'phalcon@mail.com', 'testor', 4, 'en', 'yangon', '53488.jpg', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-26 08:09:20', 'admin', '2016-01-26 09:09:20', NULL, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_member_log`
--

CREATE TABLE IF NOT EXISTS `core_member_log` (
  `token` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `member_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mac` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Table structure for table `core_notification`
--

CREATE TABLE IF NOT EXISTS `core_notification` (
  `noti_creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `creator_name` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `module_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `noti_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `noti_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`noti_creator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `core_permission`
--

CREATE TABLE IF NOT EXISTS `core_permission` (
  `id` int(200) NOT NULL,
  `permission_code` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `module_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `permission_name_en` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission_name_ja` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `permission_name_my` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `permission_note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `permission_created_time` datetime DEFAULT NULL,
  `permission_updated_time` datetime DEFAULT NULL,
  `permission_is_deleted` tinyint(1) DEFAULT '0',
  `permission_creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `permission_updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_permission`
--

INSERT INTO `core_permission` (`id`, `permission_code`, `module_id`, `permission_name_en`, `permission_name_ja`, `permission_name_my`, `permission_note`, `permission_created_time`, `permission_updated_time`, `permission_is_deleted`, `permission_creator_id`, `permission_updater_id`) VALUES
(1, 'admin_dashboard', 'admin', 'Dashboard', 'ホーム', 'ပင္မစာမ်က္ႏွာ', 'dashboard', NULL, NULL, 0, NULL, NULL),
(2, 'show_admin_attlist', 'attendance', 'Attendance List', '参加者リスト', 'တက္ေရာက္စာရင္း', NULL, NULL, NULL, 0, NULL, NULL),
(3, 'show_admin_manage', 'user', 'Manage User', '管理ユーザー', 'စီမံခန္႕ခြဲ', NULL, NULL, NULL, 0, NULL, NULL),
(4, 'show_admin_leave', 'leave', 'Leave days', '休み', 'ခြင့္ရက္', NULL, NULL, NULL, 0, NULL, NULL),
(5, 'show_admin_calendar', 'calendar', 'Calendar', 'カレンダー', 'ၿပကၡဒိန္', NULL, NULL, NULL, 0, NULL, NULL),
(6, 'show_salary', 'salary', 'Salary', '給料', 'လစာ', NULL, NULL, NULL, 0, NULL, NULL),
(7, 'user_dashboard', 'checkinout', 'Dashboard', 'ホーム', 'ပင္မစာမ်က္ႏွာ', NULL, NULL, NULL, 0, NULL, NULL),
(8, 'show_user_attlist', 'attendance', 'Attendance List', '参加者リスト', 'တက္ေရာက္စာရင္း', NULL, NULL, NULL, 0, NULL, NULL),
(9, 'show_user_leave', 'leave', 'Leave days', '休み', 'ခြင့္ရက္', NULL, NULL, NULL, 0, NULL, NULL),
(10, 'show_admin_attlist', 'attendance', 'Today List', '出勤リスト（本日）', 'ယေန႕စာရင္း', NULL, NULL, NULL, 0, NULL, NULL),
(11, 'show_admin_attlist', 'attendance', 'Monthly List', '出勤リスト（月次）', 'လစဥ္စာရင္း', NULL, NULL, NULL, 0, NULL, NULL),
(12, 'show_admin_leave', 'leave', 'Leave List', '休暇リスト', 'ခြင္႔စာရင္း', NULL, NULL, NULL, 0, NULL, NULL),
(13, 'show_admin_leave', 'leave', 'Apply Leave', '休暇申請', 'ခြင္႔တင္ရန္', NULL, NULL, NULL, 0, NULL, NULL),
(14, 'show_salary', 'salary', 'Add Salary', '給料新規入力', 'လစာစာရင္းသြင္းရန္', NULL, NULL, NULL, 0, NULL, NULL),
(15, 'show_salary', 'salary', 'Salary List', '給料一覧', 'လစာစာရင္း', NULL, NULL, NULL, 0, NULL, NULL),
(16, 'show_salary', 'salary', 'Monthly Salary', '支払った給料リスト', 'လအလိုုက္လစာစာရင္း', NULL, NULL, NULL, 0, NULL, NULL),
(17, 'show_user_calendar', 'calendar', 'Calendar', 'カレンダー', 'ၿပကၡဒိန္', NULL, NULL, NULL, 0, NULL, NULL),
(18, 'show_user_leave', 'leave', 'Leave List', '休暇リスト', 'ခြင္႔စာရင္း', NULL, NULL, NULL, 0, NULL, NULL),
(19, 'show_user_leave', 'leave', 'Apply Leave', '休暇申請', 'ခြင္႔တင္ရန္', NULL, NULL, NULL, 0, NULL, NULL),
(20, 'show_salary', 'salary', 'Salary Setting', '給料設定', 'လစာsetting', NULL, NULL, NULL, 0, NULL, NULL),
(21, 'show_salary', 'salary', 'Allowance', '手当', 'အက်ဳိးခံစားခြင္႔', NULL, '2015-08-06 00:00:00', NULL, 0, NULL, NULL),
(22, 'show_admin_leave', 'leave', 'Leave Setting', '休暇設定', 'ခြင္႔setting', NULL, NULL, NULL, 0, NULL, NULL),
(23, 'show_admin_document', 'document', 'Document', 'ドキュメント', 'စာရြက္စာတမ္း', NULL, NULL, NULL, 0, NULL, NULL),
(24, 'show_admin_document', 'document', 'Letterhead', 'レターヘッド', 'Letterhead', NULL, NULL, NULL, 0, NULL, NULL),
(25, 'show_admin_document', 'document', 'SSB Document', 'SSB 用紙', 'SSB အခြန္', NULL, NULL, NULL, 0, NULL, NULL),
(26, 'show_admin_document', 'document', 'Tax document', '税金用紙', '၀င္ေငြခြန္', NULL, NULL, NULL, 0, NULL, NULL),
(27, 'show_admin_setting', 'setting', 'admin', '', '', NULL, NULL, NULL, 0, NULL, NULL),
(28, 'show_admin_notification', 'notification', 'notification', 'notification', 'notification', NULL, NULL, NULL, 0, NULL, NULL),
(29, 'show_user_notification', 'notification', 'notification', 'notification', 'notification', NULL, NULL, NULL, 0, NULL, NULL),
(30, 'show_user_setting', 'setting', 'setting', '', '', '', NULL, NULL, 0, NULL, NULL),
(31, 'show_admin_attlist', 'attendance', 'Attendance Chart', 'Attendance Chart', 'Attendance Chart', NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_permission_group`
--

CREATE TABLE IF NOT EXISTS `core_permission_group` (
  `idpage` int(50) NOT NULL AUTO_INCREMENT,
  `page_rule_group` int(50) NOT NULL,
  `permission_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `permission_group_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `permission_group_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` timestamp NULL DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `order_num` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idpage`),
  UNIQUE KEY `idpage` (`idpage`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `core_permission_group`
--

INSERT INTO `core_permission_group` (`idpage`, `page_rule_group`, `permission_code`, `permission_group_code`, `permission_group_name`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`, `order_num`) VALUES
(1, 1, 'admin_dashboard', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
(2, 1, 'show_admin_attlist', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
(3, 1, 'show_admin_manage', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
(4, 1, 'show_admin_leave', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
(5, 1, 'show_admin_calendar', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
(6, 1, 'show_salary', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
(7, 4, 'usersetting', 'USER', 'user', NULL, NULL, NULL, NULL, 0, 0),
(8, 4, 'show_user_attlist', 'USER', 'user', NULL, NULL, NULL, NULL, 0, 0),
(9, 4, 'show_user_leave', 'USER', 'user', NULL, NULL, NULL, NULL, 0, 0),
(10, 4, 'show_user_calendar', 'USER', 'user', NULL, NULL, NULL, NULL, 0, 0),
(11, 1, 'show_admin_document', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
(13, 2, 'show_admin_attlist', 'MANGER', 'manger', NULL, NULL, NULL, NULL, 0, 0),
(15, 2, 'show_user_calendar', 'MANGER', 'manger', NULL, NULL, NULL, NULL, 0, 0),
(20, 1, 'show_admin_setting', 'ADMIN', 'admin', NULL, NULL, NULL, NULL, 0, 0),
(25, 4, 'user_dashboard', 'USER', 'user', 'admin', '2015-12-06 20:02:14', NULL, NULL, 0, 0),
(26, 1, 'show_admin_notification', 'ADMIN', 'admin', 'admin', '2015-12-06 20:10:22', NULL, NULL, 0, 0),
(27, 4, 'show_user_notification', 'USER', 'user', 'admin', '2015-12-06 20:10:37', NULL, NULL, 0, 0),
(29, 1, 'show_admin_setting', 'ADMIN', 'admin', 'admin', '2015-12-16 17:20:29', NULL, NULL, 0, 0),
(30, 4, 'show_user_setting', 'USER', 'user', NULL, NULL, NULL, NULL, 0, 0),
(33, 3, 'user_dashboard', 'ADMIN', 'admin', 'admin', '2015-12-22 21:48:15', NULL, NULL, 0, 0),
(34, 3, 'show_salary', 'ACCOUNT', 'account', 'admin', '2015-12-22 21:51:33', NULL, NULL, 0, 0),
(35, 11, 'admin_dashboard', 'TEST', 'test', 'admin', '2015-12-23 04:12:24', NULL, NULL, 0, 0),
(36, 11, 'show_user_notification', 'TEST', 'test', 'admin', '2015-12-24 02:07:58', NULL, NULL, 0, 0),
(38, 11, 'show_user_attlist', 'TEST', 'test', 'admin', '2015-12-24 02:20:21', NULL, NULL, 0, 0),
(39, 2, 'user_dashboard', 'MANGER', 'manger', 'admin', '2015-12-24 02:48:34', NULL, NULL, 0, 0),
(40, 4, 'show_user_leave', 'USER', 'user', 'admin', '2016-01-15 04:01:09', NULL, NULL, 0, 0),
(41, 1, 'faf', 'ADMIN', 'admin', 'admin', '2016-01-20 02:19:11', NULL, NULL, 0, 0),
(42, 14, 'user_dashboard', 'ss', 'ss', 'admin', '2016-01-20 04:01:11', NULL, NULL, 0, 0),
(43, 1, 'show_admin_document', 'ADMIN', 'admin', 'admin', '2016-01-24 02:12:12', NULL, NULL, 0, 0),
(44, 1, 'show_admin_calendar', 'ADMIN', 'admin', 'admin', '2016-01-24 02:12:22', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_permission_group_id`
--

CREATE TABLE IF NOT EXISTS `core_permission_group_id` (
  `group_id` int(50) NOT NULL AUTO_INCREMENT,
  `name_of_group` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `core_permission_group_id`
--

INSERT INTO `core_permission_group_id` (`group_id`, `name_of_group`) VALUES
(1, 'ADMIN'),
(2, 'MANGER'),
(3, 'ACCOUNT'),
(4, 'USER'),
(11, 'TEST');

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
  `rel_member_id` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `permission_group_id_user` int(50) DEFAULT NULL,
  `permission_member_group_member_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rel_permission_group_code` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `permission_member_group_is_deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`rel_member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_permission_rel_member`
--

INSERT INTO `core_permission_rel_member` (`rel_member_id`, `permission_group_id_user`, `permission_member_group_member_name`, `rel_permission_group_code`, `creator_id`, `created_dt`, `permission_member_group_is_deleted`) VALUES
('013c8dcf-9898-11e5-90f1-4cbb58fbbeea', 4, 'user', 'USER', 'admin', '2015-12-02 08:27:12', 1),
('05b278ac-b44b-11e5-9084-34689590deea', 4, NULL, 'USER', '68452cce-b448-11e5-9084-34689590deea', '2016-01-06 14:26:41', 0),
('0958db06-b42f-11e5-9084-34689590deea', 4, NULL, 'USER', 'admin', '2016-01-06 11:06:21', 0),
('0a9dadea-b448-11e5-9084-34689590deea', 1, NULL, 'ADMIN', 'admin', '2016-01-06 14:05:21', 0),
('0acc120c-3a4c-11e5-b951-00ff56603869', 4, 'user', 'USER', '', '0000-00-00 00:00:00', 0),
('0ee9ad48-585a-11e5-bb7b-499f44747c10', 4, 'user', 'USER', 'admin', '2015-09-11 14:22:32', 0),
('0f17ff78-9cc1-11e5-b242-4c3488333b45', 3, NULL, 'ACCOUNT', 'admin', '2015-12-07 15:31:10', 1),
('10253c75-9c90-11e5-a429-4cbb58fbbeea', 3, NULL, 'ACCOUNT', 'admin', '2015-12-07 09:40:26', 1),
('10b3910c-94aa-11e5-973c-293aa9a2310d', 4, 'user', 'USER', 'admin', '2015-11-27 08:26:25', 0),
('14547dc2-4684-11e5-899e-110f17471ec2', 4, 'user', 'USER', 'admin', '2015-08-19 22:08:42', 0),
('155b666a-b44b-11e5-9084-34689590deea', 4, NULL, 'USER', '68452cce-b448-11e5-9084-34689590deea', '2016-01-06 14:27:07', 0),
('1a35d7df-c404-11e5-befc-34689590deea', 4, NULL, 'USER', 'admin', '2016-01-26 14:39:20', 0),
('1ca7868d-89c6-11e5-b3e3-4cbb58fbbeea', 4, 'user', 'USER', 'admin', '2015-11-13 11:49:28', 0),
('1f257873-b42f-11e5-9084-34689590deea', 4, NULL, 'USER', 'admin', '2016-01-06 11:06:58', 0),
('208c3939-b448-11e5-9084-34689590deea', 4, NULL, 'USER', 'admin', '2016-01-06 14:05:58', 0),
('23723880-4684-11e5-899e-110f17471ec2', 4, 'user', 'USER', 'admin', '2015-08-19 22:08:42', 0),
('25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', 2, 'manger', 'MANGER', '', '0000-00-00 00:00:00', 1),
('2cc32dba-91c8-11e5-ba6c-b3c9d3c668b5', 11, 'test', 'TEST', 'admin', '2015-11-23 16:24:23', 0),
('36318e6a-585b-11e5-bb7b-499f44747c10', 4, 'user', 'USER', 'admin', '2015-09-11 14:30:47', 0),
('3a4a70e1-a463-11e5-bae2-4c3488333b45', 4, 'user', 'USER', 'admin', '2015-12-17 08:39:39', 0),
('3fc8f4e0-9c90-11e5-a429-4cbb58fbbeea', 4, NULL, 'USER', 'admin', '2015-12-07 09:41:46', 1),
('52a3cf03-890c-11e5-bff7-10c37b68104d', 4, 'user', 'USER', 'admin', '2015-11-12 13:39:32', 0),
('55f4516c-4684-11e5-899e-110f17471ec2', 4, 'user', 'USER', 'admin', '2015-08-19 22:08:42', 0),
('5f1a8d7a-4688-11e5-899e-110f17471ec2', 4, 'user', 'USER', 'admin', '2015-08-19 22:08:42', 0),
('67d3f828-5896-11e5-8102-5bec8d015ccc', 4, 'user', 'USER', 'admin', '2015-09-11 21:34:31', 1),
('68452cce-b448-11e5-9084-34689590deea', 1, NULL, 'ADMIN', 'admin', '2016-01-06 14:07:58', 0),
('69745650-585a-11e5-bb7b-499f44747c10', 4, 'user', 'USER', 'admin', '2015-09-11 14:25:04', 0),
('740a6d70-6b3a-11e5-9557-10c37b68104d', 4, 'user', 'USER', '', '0000-00-00 00:00:00', 0),
('7468ef74-9efb-11e5-b637-4c3488333b45', 4, 'user', 'USER', 'admin', '2015-12-10 11:34:13', 1),
('81fae1ee-5869-11e5-bb7b-499f44747c10', 4, 'user', 'USER', 'admin', '2015-09-11 16:13:08', 1),
('86070d78-4746-11e5-b07c-0c61c1a7010d', 4, 'user', 'USER', 'admin', '2015-08-20 20:49:52', 0),
('8654870a-9cb8-11e5-b242-4c3488333b45', 11, NULL, 'TEST', 'admin', '2015-12-07 14:30:04', 0),
('8927bfb4-46f3-11e5-bc6a-8ffb3e439523', 1, 'adminstrator', 'ADMIN', 'admin', '2015-08-20 10:55:49', 0),
('89f4e322-b430-11e5-9084-34689590deea', 4, NULL, 'USER', 'admin', '2016-01-06 11:17:07', 0),
('8bcb6af4-4c66-11e5-a461-c8480f73140a', 4, 'user', 'USER', 'admin', '2015-08-27 09:21:42', 0),
('900ee691-9c91-11e5-a429-4cbb58fbbeea', 3, 'account', 'ACCOUNT', 'admin', '2015-12-07 09:51:10', 1),
('9496c284-91b5-11e5-ba6c-b3c9d3c668b5', 11, 'test', 'TEST', 'admin', '2015-11-23 14:11:17', 1),
('a10f33f2-b430-11e5-9084-34689590deea', 4, NULL, 'USER', 'admin', '2016-01-06 11:17:45', 0),
('admin', 1, 'admin', 'ADMIN', '', '0000-00-00 00:00:00', 0),
('b05f14fa-4309-11e5-8feb-6dc698a57457', 4, 'user', 'USER', '', '0000-00-00 00:00:00', 0),
('c0a1ce96-4688-11e5-899e-110f17471ec2', 1, 'adminstrator', 'ADMIN', 'admin', '2015-08-19 22:26:48', 0),
('c53f9fb6-91f4-11e5-8213-2f3ca2776dbb', 3, 'account', 'ACCOUNT', 'admin', '2015-11-23 21:43:37', 1),
('c8169087-3fd2-11e5-9c70-9c4fb7a929cf', 4, 'user', 'USER', '', '0000-00-00 00:00:00', 0),
('c8c6d25b-b42f-11e5-9084-34689590deea', 4, NULL, 'USER', 'admin', '2016-01-06 11:11:43', 0),
('d509ecbc-5702-11e5-bc7f-a0c0df1ffb8e', 4, 'user', 'USER', 'admin', '2015-09-09 21:25:38', 0),
('d9012786-4686-11e5-899e-110f17471ec2', 4, 'user', 'USER', 'admin', '2015-08-19 22:08:42', 0),
('db86bdce-4684-11e5-899e-110f17471ec2', 4, 'user', 'USER', 'admin', '2015-08-19 22:08:42', 0),
('df046d39-ba7d-11e5-8e16-34689590deea', 4, NULL, 'USER', 'admin', '2016-01-14 11:45:48', 0),
('e20fed11-9722-11e5-a6cf-4cbb58fbbeea', 3, 'account', 'ACCOUNT', 'admin', '2015-11-30 11:56:16', 1),
('e6166942-6f6a-11e5-8d57-845d45458be8', 3, 'account', 'ACCOUNT', 'admin', '2015-10-10 22:51:02', 1),
('e64f5a12-468a-11e5-899e-110f17471ec2', 1, 'adminstrator', 'ADMIN', 'admin', '2015-08-19 22:26:48', 0),
('ebb9131c-b42f-11e5-9084-34689590deea', 4, NULL, 'USER', 'admin', '2016-01-06 11:12:41', 0),
('ec831c84-b431-11e5-9084-34689590deea', 4, NULL, 'USER', 'admin', '2016-01-06 11:27:01', 0),
('eef2ddda-52d6-11e5-a3b6-f90d537a689b', 4, 'user', 'USER', 'admin', '2015-09-04 14:01:19', 0),
('f94db930-4683-11e5-899e-110f17471ec2', 4, 'user', 'USER', 'admin', '2015-08-19 22:08:42', 0),
('f97bb608-5869-11e5-bb7b-499f44747c10', 4, 'user', 'USER', 'admin', '2015-09-11 16:16:28', 0),
('f9841542-5859-11e5-bb7b-499f44747c10', 4, 'user', 'USER', 'admin', '2015-09-11 14:22:32', 1);

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
-- Table structure for table `forgot_password`
--

CREATE TABLE IF NOT EXISTS `forgot_password` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `check_mail` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `curdate` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `forgot_password`
--

INSERT INTO `forgot_password` (`ID`, `check_mail`, `token`, `curdate`) VALUES
(1, ' khinsandahtun1991@gmail.com ', ' 495668d9edddcaf ', '2015-12-10'),
(2, ' khinsandahtun1991@gmail.com ', ' 685668dda3be3b9 ', '2015-12-10'),
(3, ' khinsandahtun1991@gmail.com ', ' 2b5668de4141887 ', '2015-12-10'),
(4, ' suzin@gmail.com ', ' 935668dea1906c4 ', '2015-12-10'),
(5, ' suzin@gmail.com ', ' de5668e8e1ca5f1 ', '2015-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `for_get_user`
--

CREATE TABLE IF NOT EXISTS `for_get_user` (
  `token` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tstamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`token`)
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
  `leave_days` double NOT NULL,
  `leave_category` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `leave_description` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `leave_status` tinyint(1) NOT NULL,
  `total_leavedays` double NOT NULL,
  `noti_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `module_name` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'leaves',
  `noti_seen` int(11) DEFAULT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `member_id`, `start_date`, `end_date`, `date`, `leave_days`, `leave_category`, `leave_description`, `leave_status`, `total_leavedays`, `noti_id`, `module_name`, `noti_seen`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(1, '10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-02-10 00:00:00', '2016-02-11 00:00:00', '2016-01-26 05:32:08', 2, 'Family Case', 'a', 1, 4.5, '16576', 'leaves', NULL, NULL, '2016-01-26 11:02:08', NULL, NULL, 0),
(2, '10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-02-12 12:00:00', '2016-02-13 12:00:00', '2016-01-26 05:38:18', 1, 'Family Case', 'ss', 1, 4.5, '14177', 'leaves', NULL, NULL, '2016-01-26 11:08:18', NULL, NULL, 0),
(3, '10b3910c-94aa-11e5-973c-293aa9a2310d', '2016-02-26 12:00:00', '2016-02-27 00:00:00', '2016-01-26 05:40:11', 1.5, 'Family Case', 'd', 1, 4.5, '21126', 'leaves', NULL, NULL, '2016-01-26 11:10:11', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `leaves_setting`
--

CREATE TABLE IF NOT EXISTS `leaves_setting` (
  `max_leavedays` tinyint(4) NOT NULL,
  `fine_amount` int(11) NOT NULL DEFAULT '0' COMMENT 'percentage on basic salary'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves_setting`
--

INSERT INTO `leaves_setting` (`max_leavedays`, `fine_amount`) VALUES
(10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `leave_categories`
--

CREATE TABLE IF NOT EXISTS `leave_categories` (
  `leavetype_id` varchar(36) NOT NULL COMMENT 'uuid',
  `leavetype_name` varchar(60) NOT NULL,
  `created_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_categories`
--

INSERT INTO `leave_categories` (`leavetype_id`, `leavetype_name`, `created_dt`) VALUES
('a58f10f9-4499-11e5-a5ce-19cbaf0a2497', 'On Vacation', '0000-00-00 00:00:00'),
('da75129c-4499-11e5-a5ce-19cbaf0a2497', 'Because Of ill', '0000-00-00 00:00:00'),
('88278d72-4561-11e5-959c-97f2fa0c4d5d', 'Others', '0000-00-00 00:00:00'),
('95eb0765-9d54-11e5-9bf6-4c3488333b45', 'Family Case', '2015-12-08 09:07:12');

-- --------------------------------------------------------

--
-- Table structure for table `member_event_permission`
--

CREATE TABLE IF NOT EXISTS `member_event_permission` (
  `member_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `permit_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `delete_flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member_event_permission`
--

INSERT INTO `member_event_permission` (`member_name`, `permit_name`, `delete_flag`) VALUES
('admin', 'test02', 1),
('admin', 'chan', 1),
('admin', 'mon', 1),
('admin', 'suyamin ', 1),
('admin', 'malkhin', 0),
('admin', 'suzin', 1),
('admin', 'SawZinMT', 0),
('3a4a70e1-a463-11e5-bae2-4c3488', 'admin', 0),
('3a4a70e1-a463-11e5-bae2-4c3488', 'admin', 0),
('admin', 'MayZin', 0),
('3a4a70e1-a463-11e5-bae2-4c3488', 'suzin', 0),
('3a4a70e1-a463-11e5-bae2-4c3488', 'SawZinMT', 0),
('3a4a70e1-a463-11e5-bae2-4c3488', 'suzin', 0),
('3a4a70e1-a463-11e5-bae2-4c3488', 'suzin', 0),
('3a4a70e1-a463-11e5-bae2-4c3488', 'admin', 0),
('3a4a70e1-a463-11e5-bae2-4c3488', 'suzin', 0),
('3a4a70e1-a463-11e5-bae2-4c3488', 'suzin', 0),
('3a4a70e1-a463-11e5-bae2-4c3488', 'test02', 0),
('3a4a70e1-a463-11e5-bae2-4c3488', 'suzin', 0),
('3a4a70e1-a463-11e5-bae2-4c3488333b45', 'suzin', 0),
('admin', 'Guser', 0),
('admin', 'Tuser', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_detail`
--

CREATE TABLE IF NOT EXISTS `salary_detail` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `basic_salary` double DEFAULT NULL,
  `basic_salary_annual` double NOT NULL,
  `travel_fee` double DEFAULT NULL,
  `overtime` double DEFAULT NULL,
  `allowance_amount` double DEFAULT NULL,
  `special_allowance` double DEFAULT NULL,
  `ssc_comp` double DEFAULT NULL,
  `ssc_emp` double DEFAULT NULL,
  `absent_dedution` double DEFAULT NULL,
  `income_tax` double DEFAULT NULL,
  `total_annual_income` double NOT NULL,
  `basic_examption` double NOT NULL,
  `pay_date` datetime DEFAULT NULL,
  `resign_date` date DEFAULT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salary_detail`
--

INSERT INTO `salary_detail` (`id`, `member_id`, `basic_salary`, `basic_salary_annual`, `travel_fee`, `overtime`, `allowance_amount`, `special_allowance`, `ssc_comp`, `ssc_emp`, `absent_dedution`, `income_tax`, `total_annual_income`, `basic_examption`, `pay_date`, `resign_date`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('0159da24-c4b6-11e5-b62c-34689590deea', 'cdcb3fe4-b42e-11e5-9869-f6341df67a83', 12132222, 36396666, 129292, 0, 25000, NULL, 9000, 6000, 0, 1927289, 5781866.56, 7294333.2, '2016-01-01 00:00:00', NULL, 'admin', '2016-01-27 11:52:49', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_master`
--

CREATE TABLE IF NOT EXISTS `salary_master` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `basic_salary` double NOT NULL,
  `travel_fee_perday` double NOT NULL,
  `travel_fee_permonth` double NOT NULL,
  `over_time` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `ssc_emp` int(11) NOT NULL,
  `ssc_comp` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `salary_start_date` date DEFAULT NULL,
  `salary_end_date` date NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salary_master`
--

INSERT INTO `salary_master` (`id`, `member_id`, `basic_salary`, `travel_fee_perday`, `travel_fee_permonth`, `over_time`, `ssc_emp`, `ssc_comp`, `status`, `salary_start_date`, `salary_end_date`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('56a08a447443a', 'cdcb3fe4-b42e-11e5-9869-f6341df67a83', 12132222, 32323, 0, '23232', 2, 3, 0, '2016-01-30', '2017-03-31', 'admin', '2016-01-21 08:35:32', '3', '2016-01-22 09:54:33', 0);

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
('4a54bc11-3d17-11e5-b0fa-00ff56603869', '10b3910c-94aa-11e5-973c-293aa9a2310d'),
('4a53fcdc-3d17-11e5-b0fa-00ff56603869', '8654870a-9cb8-11e5-b242-4c3488333b45'),
('4a53fcdc-3d17-11e5-b0fa-00ff56603869', 'admin'),
('4a54bc11-3d17-11e5-b0fa-00ff56603869', 'admin'),
('4a53fcdc-3d17-11e5-b0fa-00ff56603869', 'cdcb3fe4-b42e-11e5-9869-f6341df67a83');

-- --------------------------------------------------------

--
-- Table structure for table `salary_member_tax_deduce`
--

CREATE TABLE IF NOT EXISTS `salary_member_tax_deduce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deduce_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `no_of_children` int(12) DEFAULT NULL,
  `creator_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=138 ;

--
-- Dumping data for table `salary_member_tax_deduce`
--

INSERT INTO `salary_member_tax_deduce` (`id`, `deduce_id`, `member_id`, `no_of_children`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(73, 'stay_father', '10b3910c-94aa-11e5-973c-293aa9a2310d', NULL, 'admin', '2015-12-24 11:44:23', NULL, NULL, 0),
(74, 'stay_mother', '10b3910c-94aa-11e5-973c-293aa9a2310d', NULL, 'admin', '2015-12-24 11:44:23', NULL, NULL, 0),
(75, 'stay_father', '7468ef74-9efb-11e5-b637-4c3488333b45', NULL, 'admin', '2015-12-24 11:49:17', '0', '0000-00-00 00:00:00', 0),
(76, 'stay_mother', '7468ef74-9efb-11e5-b637-4c3488333b45', NULL, 'admin', '2015-12-24 11:49:17', '0', '0000-00-00 00:00:00', 0),
(79, 'spouse', '8654870a-9cb8-11e5-b242-4c3488333b45', NULL, 'admin', '2016-01-14 08:30:52', NULL, NULL, 0),
(121, 'spouse', 'admin', NULL, 'admin', '2016-01-18 16:17:38', NULL, NULL, 0),
(122, 'children', 'admin', 1, 'admin', '2016-01-18 16:17:38', NULL, NULL, 0),
(123, 'stay_mother', 'admin', NULL, 'admin', '2016-01-18 16:17:38', NULL, NULL, 0),
(130, 'spouse', '01afa768-b453-11e5-9869-f6341df67a83', NULL, 'admin', '2016-01-20 15:53:18', NULL, NULL, 0),
(131, 'stay_father', '01afa768-b453-11e5-9869-f6341df67a83', NULL, 'admin', '2016-01-20 15:53:18', NULL, NULL, 0),
(137, 'spouse', 'cdcb3fe4-b42e-11e5-9869-f6341df67a83', NULL, 'admin', '2016-01-22 09:54:33', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_taxs`
--

CREATE TABLE IF NOT EXISTS `salary_taxs` (
  `id` int(36) NOT NULL AUTO_INCREMENT,
  `taxs_from` double NOT NULL,
  `taxs_to` double NOT NULL,
  `taxs_rate` int(11) NOT NULL,
  `taxs_diff` double NOT NULL,
  `ssc_emp` int(11) NOT NULL,
  `ssc_comp` int(11) NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `salary_taxs`
--

INSERT INTO `salary_taxs` (`id`, `taxs_from`, `taxs_to`, `taxs_rate`, `taxs_diff`, `ssc_emp`, `ssc_comp`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(1, 1, 2000000, 0, 2000000, 2, 3, NULL, '2015-07-28 00:00:00', '', '0000-00-00 00:00:00', 0),
(2, 2000001, 5000000, 5, 3000000, 2, 3, NULL, '2015-07-28 00:00:00', '', '0000-00-00 00:00:00', 0),
(3, 5000001, 10000000, 10, 5000000, 2, 3, NULL, '2015-07-28 00:00:00', '', '0000-00-00 00:00:00', 0),
(4, 10000001, 20000000, 15, 10000000, 2, 3, NULL, '2015-07-28 00:00:00', '', '0000-00-00 00:00:00', 0),
(5, 20000001, 30000000, 20, 10000000, 2, 3, NULL, '2015-07-28 00:00:00', '', '0000-00-00 00:00:00', 0),
(6, 30000001, 0, 25, 0, 2, 3, NULL, '2015-07-28 00:00:00', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_taxs_deduction`
--

CREATE TABLE IF NOT EXISTS `salary_taxs_deduction` (
  `deduce_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `deduce_name` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salary_taxs_deduction`
--

INSERT INTO `salary_taxs_deduction` (`deduce_id`, `deduce_name`, `amount`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('spouse', 'spouse', 1000000, '', '2015-07-25 00:00:00', '', '0000-00-00 00:00:00', 0),
('children', 'children', 500000, '', '2015-07-25 00:00:00', '', '0000-00-00 00:00:00', 0),
('stay_father', 'stay_with_father', 1000000, '', '2015-07-25 00:00:00', '', '0000-00-00 00:00:00', 0),
('stay_mother', 'stay_wiith_mother', 1000000, '', '2015-07-25 00:00:00', '', '0000-00-00 00:00:00', 0),
('life_insurance', 'life_insurance', 150000, '', '2015-07-25 00:00:00', '', '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
