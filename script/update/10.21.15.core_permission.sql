-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2015 at 03:48 AM
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
-- Table structure for table `core_permission`
--

CREATE TABLE IF NOT EXISTS `core_permission` (
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
  `permission_updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_permission`
--

INSERT INTO `core_permission` (`permission_code`, `module_id`, `permission_name_en`, `permission_name_ja`, `permission_name_my`, `permission_note`, `permission_created_time`, `permission_updated_time`, `permission_is_deleted`, `permission_creator_id`, `permission_updater_id`) VALUES
('admin_dashboard', 'admin', 'Dashboard', 'ホーム', 'ပင္မစာမ်က္ႏွာ', 'dashboard', NULL, NULL, 0, NULL, NULL),
('show_admin_attlist', 'attendance', 'Attendance List', '参加者リスト', 'တက္ေရာက္စာရင္း', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_user', 'user', 'Manage User', '管理ユーザー', 'စီမံခန္႕ခြဲ', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_leave', 'leave', 'Leave days', '休み', 'ခြင့္ရက္', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_calendar', 'calendar', 'Calendar', 'カレンダー', 'ၿပကၡဒိန္', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Salary', '俸給', 'လစာ', NULL, NULL, NULL, 0, NULL, NULL),
('user_dashboard', 'checkinout', 'Dashboard', 'ホーム', 'ပင္မစာမ်က္ႏွာ', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_attlist', 'attendance', 'Attendance List', '参加者リスト', 'တက္ေရာက္စာရင္း', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_leave', 'leave', 'Leave days', '休み', 'ခြင့္ရက္', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_attlist', 'attendance', 'Today List', '今日 List', 'ယေန႕စာရင္း', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_attlist', 'attendance', 'Monthly List', '毎月List', 'လစဥ္စာရင္း', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_user', 'user', 'User List', '', '', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_leave', 'leave', 'Leave List', '', '', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_leave', 'leave', 'Apply Leave', '', '', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Add Salary', '', '', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Salary List', '', '', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Monthly Salary List', '', '', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_calendar', 'calendar', 'Calendar', 'カレンダー', 'ၿပကၡဒိန္', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_leave', 'leave', 'Leave List', '', '', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_leave', 'leave', 'Apply Leave', '', '', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Salary Setting', '', '', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Allowance', '', '', NULL, '2015-08-06 00:00:00', NULL, 0, NULL, NULL),
('show_admin_leave', 'leave', 'Leave Setting', '', '', NULL, NULL, NULL, 0, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
