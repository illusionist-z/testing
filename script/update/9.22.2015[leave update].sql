-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2015 at 09:50 AM
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
  `noti_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `module_name` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'leaves',
  `creator_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `member_id`, `start_date`, `end_date`, `date`, `leave_days`, `leave_category`, `leave_description`, `leave_status`, `total_leavedays`, `noti_id`, `module_name`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(1, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-09-26 00:00:00', '2015-09-27 00:00:00', '2015-09-18 04:47:13', 1, 'Because Of ill', 'kkk', 1, 4, '13358', 'leaves', '', '2015-09-18 09:17:13', '', '0000-00-00 00:00:00', 0),
(2, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-09-29 00:00:00', '2015-09-30 00:00:00', '2015-09-18 05:04:37', 1, 'Because Of ill', 'aa', 1, 4, '11516', 'leaves', '', '2015-09-18 09:34:37', '', '0000-00-00 00:00:00', 0),
(5, 'fc8fabd8-5dae-11e5-acdc-39cf648779c9', '2015-09-29 00:00:00', '2015-09-30 00:00:00', '2015-09-18 05:19:20', 1, 'Because Of ill', 'aaa', 1, 1, '4842', 'leaves', '', '2015-09-18 09:49:20', '', '0000-00-00 00:00:00', 0),
(7, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-09-29 00:00:00', '2015-09-30 00:00:00', '2015-09-18 05:36:05', 1, 'Because Of ill', 'aa', 1, 4, '2523', 'leaves', '', '2015-09-18 10:06:05', '', '0000-00-00 00:00:00', 0),
(8, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-09-28 00:00:00', '2015-09-29 00:00:00', '2015-09-21 04:17:10', 1, 'Because Of ill', 'kkk', 1, 4, '9993', 'leaves', '', '2015-09-21 08:47:10', '', '0000-00-00 00:00:00', 0),
(12, 'admin', '2015-09-29 00:00:00', '2015-09-30 00:00:00', '2015-09-21 07:10:43', 1, 'Because Of ill', 'aa', 1, 3, '11582', 'leaves', '', '2015-09-21 11:40:43', '', '0000-00-00 00:00:00', 0),
(13, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-09-29 00:00:00', '2015-09-30 00:00:00', '2015-09-21 09:25:14', 1, 'Because Of ill', 'aa', 0, 4, '26292', 'leaves', '', '2015-09-21 13:55:14', '', '0000-00-00 00:00:00', 0),
(14, '9af6af14-6e01-11e4-b676-82c4524d8ace', '2015-09-30 00:00:00', '2015-09-30 00:00:00', '2015-09-21 09:53:29', 0, 'Because Of ill', 'kkk', 1, 4, '5031', 'leaves', '', '2015-09-21 14:23:29', '', '0000-00-00 00:00:00', 0),
(15, 'admin', '2015-09-30 00:00:00', '2015-10-02 00:00:00', '2015-09-22 09:45:17', 2, 'Because Of ill', 'aa', 1, 3, '15953', 'leaves', '', '2015-09-22 14:15:17', '', '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
