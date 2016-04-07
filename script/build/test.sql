-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2016 at 10:44 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gnext_db`
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
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `attendances`
--

CREATE TABLE IF NOT EXISTS `attendances` (
`id` int(11) NOT NULL,
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
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1399 ;


--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
`id` int(11) NOT NULL,
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
  `deleted_flag` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE IF NOT EXISTS `company_info` (
  `id` int(11) NOT NULL DEFAULT '1',
  `company_name` varchar(36) NOT NULL,
  `company_logo` varchar(20) NOT NULL,
  `company_address` varchar(60) NOT NULL,
  `company_phno` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`id`, `company_name`, `company_logo`, `company_address`, `company_phno`) VALUES
(1, 'G NEXT Co.,Ltd', 'cop2.jpg', '(7+1)A - Parami Condo,Ma Yan Gone TownShip,Yangon,Myanmar.', '01522997');

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

-- --------------------------------------------------------

--
-- Table structure for table `core_member`
--

CREATE TABLE IF NOT EXISTS `core_member` (
  `member_id` varchar(500) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'uuid',
  `ssn_no` varchar(36) NOT NULL,
`user_rule_member_id` int(50) NOT NULL,
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
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `core_member`
--

INSERT INTO `core_member` (`member_id`, `ssn_no`, `user_rule_member_id`, `member_login_name`, `member_password`, `full_name`, `member_dept_name`, `member_mobile_tel`, `member_mail`, `position`, `user_rule`, `lang`, `member_address`, `member_profile`, `rank_code`, `member_is_change`, `working_start_dt`, `working_year_by_year`, `rs_status`, `timeflag`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('admin', '', 1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'Manage', '1234567', 'sample@test.comFF', 'Adminstrator', 0, 'en', 'yangon ', '9259.jpg', 1, NULL, '2015-02-02', '2016-02-02', '', '2016-02-17 02:08:00', '1', '2014-09-22 11:41:47', 'admin', '2015-05-18 10:45:27', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `core_notification`
--

CREATE TABLE IF NOT EXISTS `core_notification` (
`id` int(11) NOT NULL,
  `noti_creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `creator_name` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `module_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `noti_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `noti_status` tinyint(4) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;



-- --------------------------------------------------------

--
-- Table structure for table `core_notification_rel_member`
--

CREATE TABLE IF NOT EXISTS `core_notification_rel_member` (
  `creator_name` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `noti_id` varchar(36) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `module_name` varchar(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `permission_name_jp` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `permission_name_mm` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `core_permission` (`id`, `permission_code`, `module_id`, `permission_name_en`, `permission_name_jp`, `permission_name_mm`, `permission_note`, `permission_created_time`, `permission_updated_time`, `permission_is_deleted`, `permission_creator_id`, `permission_updater_id`) VALUES
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
`idpage` int(50) NOT NULL,
  `page_rule_group` int(50) NOT NULL,
  `permission_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `permission_group_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `permission_group_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` timestamp NULL DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `order_num` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

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
(44, 1, 'show_admin_calendar', 'ADMIN', 'admin', 'admin', '2016-01-24 02:12:22', NULL, NULL, 0, 0),
(45, 5, 'admin_dashboard', 'MANAGER', 'manager', 'admin', '2016-02-07 21:39:02', NULL, NULL, 0, 0),
(46, 5, 'show_admin_attlist', 'MANAGER', 'manager', 'admin', '2016-02-07 21:40:17', NULL, NULL, 0, 0),
(47, 5, 'show_admin_leave', 'MANAGER', 'manager', 'admin', '2016-02-07 21:40:31', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_permission_group_id`
--

CREATE TABLE IF NOT EXISTS `core_permission_group_id` (
`group_id` int(50) NOT NULL,
  `name_of_group` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `core_permission_group_id`
--

INSERT INTO `core_permission_group_id` (`group_id`, `name_of_group`) VALUES
(1, 'ADMIN'),
(4, 'USER'),
(5, 'MANAGER');

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
  `permission_member_group_is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_permission_rel_member`
--

INSERT INTO `core_permission_rel_member` (`rel_member_id`, `permission_group_id_user`, `permission_member_group_member_name`, `rel_permission_group_code`, `creator_id`, `created_dt`, `permission_member_group_is_deleted`) VALUES
('admin', 1, 'admin', 'ADMIN', '', '0000-00-00 00:00:00', 0);

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
`ID` int(11) NOT NULL,
  `check_mail` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `curdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `for_get_user`
--

CREATE TABLE IF NOT EXISTS `for_get_user` (
  `token` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tstamp` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
`id` int(11) NOT NULL,
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
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;


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
(16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `leave_categories`
--

CREATE TABLE IF NOT EXISTS `leave_categories` (
  `leavetype_id` varchar(36) NOT NULL COMMENT 'uuid',
  `leavetype_name` varchar(60) NOT NULL,
  `created_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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


-- --------------------------------------------------------

--
-- Table structure for table `member_log`
--

CREATE TABLE IF NOT EXISTS `member_log` (
  `token` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `member_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mac` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
  `print_id` int(11) NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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


-- --------------------------------------------------------

--
-- Table structure for table `salary_member_tax_deduce`
--

CREATE TABLE IF NOT EXISTS `salary_member_tax_deduce` (
`id` int(11) NOT NULL,
  `deduce_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `no_of_children` int(12) DEFAULT NULL,
  `creator_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=114 ;


-- --------------------------------------------------------

--
-- Table structure for table `salary_taxs`
--

CREATE TABLE IF NOT EXISTS `salary_taxs` (
`id` int(36) NOT NULL,
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
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0'
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowances`
--
ALTER TABLE `allowances`
 ADD PRIMARY KEY (`allowance_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `company_info`
--
ALTER TABLE `company_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core_member`
--
ALTER TABLE `core_member`
 ADD PRIMARY KEY (`user_rule_member_id`), ADD UNIQUE KEY `user_rule_member_id` (`user_rule_member_id`), ADD KEY `member_login_name` (`member_login_name`), ADD KEY `user_rule_member_id_2` (`user_rule_member_id`), ADD KEY `user_rule_member_id_3` (`user_rule_member_id`);

--
-- Indexes for table `core_notification`
--
ALTER TABLE `core_notification`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core_permission`
--
ALTER TABLE `core_permission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core_permission_group`
--
ALTER TABLE `core_permission_group`
 ADD PRIMARY KEY (`idpage`), ADD UNIQUE KEY `idpage` (`idpage`);

--
-- Indexes for table `core_permission_group_id`
--
ALTER TABLE `core_permission_group_id`
 ADD PRIMARY KEY (`group_id`), ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `core_permission_rel_member`
--
ALTER TABLE `core_permission_rel_member`
 ADD PRIMARY KEY (`rel_member_id`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `for_get_user`
--
ALTER TABLE `for_get_user`
 ADD PRIMARY KEY (`token`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_detail`
--
ALTER TABLE `salary_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_member_tax_deduce`
--
ALTER TABLE `salary_member_tax_deduce`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_taxs`
--
ALTER TABLE `salary_taxs`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1399;
--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `core_member`
--
ALTER TABLE `core_member`
MODIFY `user_rule_member_id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `core_notification`
--
ALTER TABLE `core_notification`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `core_permission_group`
--
ALTER TABLE `core_permission_group`
MODIFY `idpage` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `core_permission_group_id`
--
ALTER TABLE `core_permission_group_id`
MODIFY `group_id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `salary_member_tax_deduce`
--
ALTER TABLE `salary_member_tax_deduce`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `salary_taxs`
--
ALTER TABLE `salary_taxs`
MODIFY `id` int(36) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
ALTER TABLE `core_member` ADD `bank_acc` VARCHAR(36) NOT NULL AFTER `ssn_no`;