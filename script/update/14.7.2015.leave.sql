-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2015 at 04:38 AM
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
  `total_leavedays` int(11) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `member_id`, `start_date`, `end_date`, `date`, `leave_days`, `leave_category`, `leave_description`, `leave_status`, `total_leavedays`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(15, 'admin', '2015-08-29 00:00:00', '2015-08-31 00:00:00', '2015-08-11 00:00:00', 2, 'Because of ill', 'kk', 1, 19, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(17, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-09-02 00:00:00', '2015-09-04 00:00:00', '2015-08-11 10:39:37', 9, 'Because of ill', 'fa', 1, 22, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(18, 'b33866bf-3fd2-11e5-a594-d4b923801c09', '2015-08-29 00:00:00', '2015-08-30 00:00:00', '2015-08-11 10:43:50', 1, 'Because of ill', 'd', 1, 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(19, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-09-17 00:00:00', '2015-09-26 00:00:00', '2015-08-11 10:45:39', 9, 'Because of ill', 'faf', 1, 22, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(20, 'e46d297c-3fd2-11e5-a594-d4b923801c09', '2015-08-29 00:00:00', '2015-08-30 00:00:00', '2015-08-11 10:48:43', 1, 'Because of ill', 'HH', 1, 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(21, 'admin', '2015-08-22 00:00:00', '2015-08-23 00:00:00', '2015-08-14 04:10:30', 1, 'Because of ill', 'f', 1, 19, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(22, 'admin', '2015-08-25 00:00:00', '2015-08-29 00:00:00', '2015-08-14 04:54:11', 4, 'Because of ill', 'á€·á€·', 1, 19, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(23, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-09-07 00:00:00', '2015-09-11 00:00:00', '2015-08-14 05:48:18', 4, 'On Vacation', 'chaungtar', 1, 22, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0),
(24, 'admin', '2015-08-24 00:00:00', '2015-08-27 00:00:00', '2015-08-14 06:00:22', 3, 'On Vacation', 'bkk', 1, 19, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
