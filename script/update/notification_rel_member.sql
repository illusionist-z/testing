-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2015 at 09:49 AM
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
-- Table structure for table `notification_rel_member`
--

CREATE TABLE IF NOT EXISTS `notification_rel_member` (
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `noti_id` varchar(36) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `module_name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_rel_member`
--

INSERT INTO `notification_rel_member` (`member_id`, `noti_id`, `status`, `module_name`) VALUES
('d505a292-52bf-11e5-a4d7-d5bc2fb4fac9', '31226', 1, 'calendar'),
('18cb0f40-5b57-11e5-bd91-779ba46200d9', '31226', 1, 'calendar'),
('fc8fabd8-5dae-11e5-acdc-39cf648779c9', '31226', 2, 'calendar'),
('9af6af14-6e01-11e4-b676-82c4524d8ace', '26086', 2, 'calendar'),
('d505a292-52bf-11e5-a4d7-d5bc2fb4fac9', '26086', 1, 'calendar'),
('18cb0f40-5b57-11e5-bd91-779ba46200d9', '26086', 1, 'calendar'),
('fc8fabd8-5dae-11e5-acdc-39cf648779c9', '26086', 2, 'calendar');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
