-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2015 at 12:20 PM
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
-- Table structure for table `leave_categories`
--

CREATE TABLE IF NOT EXISTS `leave_categories` (
  `leavetype_id` varchar(36) NOT NULL COMMENT 'uuid',
  `leavetype_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_categories`
--

INSERT INTO `leave_categories` (`leavetype_id`, `leavetype_name`) VALUES
('a58f10f9-4499-11e5-a5ce-19cbaf0a2497', 'On Vacation'),
('da75129c-4499-11e5-a5ce-19cbaf0a2497', 'Because Of ill'),
('88278d72-4561-11e5-959c-97f2fa0c4d5d', 'Others');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
