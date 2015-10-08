-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2015 at 08:53 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

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
-- Table structure for table `attendances`
--

CREATE TABLE IF NOT EXISTS `attendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `att_date` date NOT NULL,
  `checkin_time` datetime NOT NULL,
  `checkout_time` datetime DEFAULT NULL,
  `overtime` double NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `location` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `noti_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `module_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'attendances',
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `member_id`, `att_date`, `checkin_time`, `checkout_time`, `overtime`, `notes`, `lat`, `lng`, `location`, `noti_id`, `module_name`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(2, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-10-02', '2015-10-02 09:34:53', NULL, 0, '', 16.8660694, 96.19513200000002, '-', '', 'attendances', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(6, 'admin', '2015-10-05', '2015-10-05 03:09:11', NULL, 0, 'coz of job', 16.8660694, 96.19513200000002, '-', '', 'attendances', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(11, 'admin', '2015-10-02', '2015-10-02 03:09:11', NULL, 0, '', 16.8660694, 96.19513200000002, '-', '', 'attendances', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(12, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-10-05', '2015-10-05 04:14:09', NULL, 0, 'coz of bus', 16.8660694, 96.19513200000002, '-', '', 'attendances', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(19, 'admin', '2015-10-06', '2015-09-06 01:53:04', NULL, 0, 'because of rain', 16.8566886, 96.12228689999999, '-', '26179', 'attendances', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(20, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-10-06', '2015-09-06 02:01:48', NULL, 0, 'because of rain', 16.8566886, 96.12228689999999, '-', '20310', 'attendances', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
