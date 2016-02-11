-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2016 at 11:02 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

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
-- Table structure for table `core_forgot_password`
--

CREATE TABLE IF NOT EXISTS `core_forgot_password` (
`ID` int(11) NOT NULL,
  `check_mail` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `curdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `core_forgot_password`
--

INSERT INTO `core_forgot_password` (`ID`, `check_mail`, `token`, `curdate`) VALUES
(1, 'sawzinmintun@gmail.com', '9f56b96d878bf18', '2016-02-09 04:39:35'),
(2, 'sawzinmintun@gmail.com', 'd256b98cee50bb6', '2016-02-09 06:53:34'),
(3, 'sawzinmintun@gmail.com', '1856b98f4222122', '2016-02-09 07:03:30'),
(4, 'sawzinmintun@gmail.com', '4356b990942cbff', '2016-02-09 07:09:08'),
(5, 'sawzinmintun@gmail.com', 'eb56b990e699db5', '2016-02-09 07:10:30'),
(6, 'sawzinmintun@gmail.com', '8456b993cfe39e0', '2016-02-09 07:22:55'),
(7, 'sawzinmintun@gmail.com', '9e56b9949e223f5', '2016-02-09 07:26:22'),
(8, 'sawzinmintun@gmail.com', '4356b9b0c1413d5', '2016-02-09 09:26:25'),
(9, 'sawzinmintun@gmail.com', 'c256b9b3c62bb86', '2016-02-09 09:39:18'),
(10, 'sawzinmintun@gmail.com', '9256b9b52fcd670', '2016-02-09 09:45:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `core_forgot_password`
--
ALTER TABLE `core_forgot_password`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `core_forgot_password`
--
ALTER TABLE `core_forgot_password`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
