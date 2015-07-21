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

INSERT INTO `core_member` (`member_id`, `member_login_name`, `member_password`, `member_first_name`, `member_family_name`, `full_name`, `member_first_name_kana`, `member_family_name_kana`, `member_sort_name`, `member_dept_code`, `member_dept_name`, `member_tel`, `member_mobile_tel`, `member_fax`, `member_ext`, `member_memo`, `member_mail`, `member_mail_2`, `job_title`, `timezone`, `lang`, `member_address`, `member_profile`, `rank_code`, `member_is_change`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `delete_flag`) VALUES
('9af6af14-6e01-11e4-b676-82c4524d8ace', 'test02', '889ab7d027b385e292587ff9cb6d92d5a14aefa7', 'User02', 'Test', 'Test User02', 'ユーザ２', 'テスト', 'テスト ユーザ２', '100000001', '部署テスト', '', '', '', '', 'memo', 'test02@example.com', '', 'Manager', 'Asia/Rangoon', 'ja', '', '', 0, NULL, 'admin', '2014-11-17 11:29:50', 'admin', '2014-11-17 13:53:24', 0),
('admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 'Administrator', 'Administrator ', '', 'Administrator', 'Administrator ', 'admin', 'wheel', '', '', '', '', '管理者', 'sample@test.com', '', '', '', 'en', '', '', 1, NULL, '1', '2014-09-22 11:41:47', 'admin', '2015-05-18 10:45:27', 0),
('', 'test', '098f6bcd4621d373cade4e832627b4f6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, '022111', NULL, NULL, NULL, 'test@test.com', NULL, 'test', '', NULL, 'yangon', '', 0, NULL, NULL, NULL, NULL, NULL, 0),
('', 'suzinkyaw', 'ed053a4e0d6d6e4c839ad1f13dc9fd25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GNEXT', NULL, '0912444`', NULL, NULL, NULL, 'gnext.suzin@gmail.com', NULL, 'programmer', '', NULL, 'yangon,burma', '', 0, NULL, NULL, NULL, NULL, NULL, 0),
('', 'q', '7694f4a66316e53c8cdd9d9954bd611d', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'q', NULL, 'q', NULL, NULL, NULL, 'q@mail.com', NULL, 'q', '', NULL, 'q', '', 0, NULL, NULL, NULL, NULL, NULL, 0),
('', 'q', '7694f4a66316e53c8cdd9d9954bd611d', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'q', NULL, 'q', NULL, NULL, NULL, 'q@mail.com', NULL, 'q', '', NULL, 'q', '', 0, NULL, NULL, NULL, NULL, NULL, 0),
('', 'q', '7694f4a66316e53c8cdd9d9954bd611d', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'q', NULL, 'q', NULL, NULL, NULL, 'q@mail.com', NULL, 'q', '', NULL, 'q', '', 0, NULL, NULL, NULL, NULL, NULL, 0),
('', 'q', '7694f4a66316e53c8cdd9d9954bd611d', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'q', NULL, 'q', NULL, NULL, NULL, 'q@mail.com', NULL, 'q', '', NULL, 'Q', '', 0, NULL, NULL, NULL, NULL, NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
