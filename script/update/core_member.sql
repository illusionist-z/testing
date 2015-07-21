-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2015 at 04:29 AM
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
  `member_sort_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_dept_code` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_dept_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_tel` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_mobile_tel` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_fax` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_ext` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_memo` text,
  `member_mail` varchar(256) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_mail_2` varchar(256) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `job_title` varchar(64) DEFAULT NULL,
  `timezone` varchar(36) NOT NULL,
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


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
