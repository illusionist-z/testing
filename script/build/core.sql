-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2015 at 10:42 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `attsys_db`
--
CREATE DATABASE IF NOT EXISTS `attsys_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `attsys_db`;


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

--
-- Dumping data for table `core_dept`
--

INSERT INTO `core_dept` (`dept_code`, `dept_name`, `abbreviation`, `parent_dept_code`, `dept_level`, `dept_order`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('100000001', '部署テスト', 'テスト', '', 1, NULL, '1', '2014-10-20 15:01:00', NULL, NULL, 0),
('1212', '部所部署', '部署', '100000001', 2, NULL, 'admin', '2015-01-06 22:50:34', NULL, NULL, 0),
('20202', '部署', NULL, 'ad0404', 5, NULL, '1', '2014-10-20 15:51:48', NULL, NULL, 0),
('33333', 'detp22', 'detp22', '', 1, NULL, '1', '2014-09-22 10:35:08', NULL, NULL, 1),
('ad03', 'テスト', 'ﾃｽﾄ', 'admin2', 3, NULL, '1', '2014-10-14 17:57:27', NULL, NULL, 0),
('ad0404', 'テストです。', NULL, 'ad03', 4, NULL, '1', '2014-10-20 15:31:42', NULL, NULL, 0),
('admin', '管理者用', '管理者用', '', 1, 1, '1', '2014-04-22 13:31:15', '1', '2014-04-22 13:31:37', 0),
('admin2', '管理者用2階層', '管理者用2階層', 'admin', 2, NULL, '1', '2014-04-22 13:31:52', NULL, NULL, 0),
('dept-admin', '取引先', '取引先', '', 1, NULL, '1', '2013-06-27 11:10:38', NULL, NULL, 0),
('TEST001', 'test002', '', '', 1, NULL, 'admin', '2015-01-08 13:10:37', 'admin', '2015-01-09 12:58:26', 0),
('test003', 'test003', '', '', 1, NULL, 'admin', '2015-01-09 12:58:42', NULL, NULL, 0),
('100000001', '部署テスト', 'テスト', '', 1, NULL, '1', '2014-10-20 15:01:00', NULL, NULL, 0),
('1212', '部所部署', '部署', '100000001', 2, NULL, 'admin', '2015-01-06 22:50:34', NULL, NULL, 0),
('20202', '部署', NULL, 'ad0404', 5, NULL, '1', '2014-10-20 15:51:48', NULL, NULL, 0),
('33333', 'detp22', 'detp22', '', 1, NULL, '1', '2014-09-22 10:35:08', NULL, NULL, 1),
('ad03', 'テスト', 'ﾃｽﾄ', 'admin2', 3, NULL, '1', '2014-10-14 17:57:27', NULL, NULL, 0),
('ad0404', 'テストです。', NULL, 'ad03', 4, NULL, '1', '2014-10-20 15:31:42', NULL, NULL, 0),
('admin', '管理者用', '管理者用', '', 1, 1, '1', '2014-04-22 13:31:15', '1', '2014-04-22 13:31:37', 0),
('admin2', '管理者用2階層', '管理者用2階層', 'admin', 2, NULL, '1', '2014-04-22 13:31:52', NULL, NULL, 0),
('dept-admin', '取引先', '取引先', '', 1, NULL, '1', '2013-06-27 11:10:38', NULL, NULL, 0),
('TEST001', 'test002', '', '', 1, NULL, 'admin', '2015-01-08 13:10:37', 'admin', '2015-01-09 12:58:26', 0),
('test003', 'test003', '', '', 1, NULL, 'admin', '2015-01-09 12:58:42', NULL, NULL, 0);

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

--
-- Dumping data for table `core_images`
--

INSERT INTO `core_images` (`uuid`, `mime_type`, `extension`, `rel_table`, `rel_code`, `category_id`, `delete_flag_files`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('0372f14c-c67c-11e4-9e5e-647210f9b28f', 'image/jpeg', 'jpg', 'naotter_carte_branch', 'ef806748-c679-11e4-9e5e-647210f9b28f', NULL, 2, 'admin', '2015-03-10 01:47:46', NULL, '2015-03-09 23:39:10', 1);

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

--
-- Dumping data for table `core_lock_record`
--

INSERT INTO `core_lock_record` (`relation_table`, `relation_id`, `member_id`, `member_name`, `expired_time`, `creator_id`, `created_dt`) VALUES
('schedule', 'd351008a-c77a-11e4-9e5e-647210f9b28f', 'admin', 'Administrator ', '2015-03-11 09:07:13', 'admin', '2015-03-11 08:37:13');

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
  `lang` varchar(2) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
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

INSERT INTO `core_member` (`member_id`, `member_login_name`, `member_password`, `member_first_name`, `member_family_name`, `full_name`, `member_first_name_kana`, `member_family_name_kana`, `member_sort_name`, `member_dept_code`, `member_dept_name`, `member_tel`, `member_mobile_tel`, `member_fax`, `member_ext`, `member_memo`, `member_mail`, `member_mail_2`, `job_title`, `lang`, `rank_code`, `member_is_change`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `delete_flag`) VALUES
('9af6af14-6e01-11e4-b676-82c4524d8ace', 'test02', '889ab7d027b385e292587ff9cb6d92d5a14aefa7', 'User02', 'Test', 'Test User02', 'ユーザ２', 'テスト', 'テスト ユーザ２', '100000001', '部署テスト', '', '', '', '', 'memo', 'test02@example.com', '', 'Manager', 'ja', 0, NULL, 'admin', '2014-11-17 11:29:50', 'admin', '2014-11-17 13:53:24', 0),
('admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 'Administrator', 'Administrator ', '', 'Administrator', 'Administrator ', 'admin', 'wheel', '', '', '', '', '管理者', 'sample@test.com', '', '', 'en', 1, NULL, '1', '2014-09-22 11:41:47', 'admin', '2015-05-18 10:45:27', 0),


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

--
-- Dumping data for table `core_module`
--

INSERT INTO `core_module` (`module_id`, `module_category_id`, `module_name_ja`, `module_name_en`, `module_version`, `module_dt_updt`, `module_detail`, `module_order`, `deleted_flag`) VALUES
('admin', 1, 'admin', 'dashboard', NULL, NULL, NULL, 0, 0),
('attendance', 2, 'attendance', 'attendance', NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `core_permission`
--

CREATE TABLE IF NOT EXISTS `core_permission` (
  `permission_code` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `module_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `permission_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
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

INSERT INTO `core_permission` (`permission_code`, `module_id`, `permission_name`, `permission_note`, `permission_created_time`, `permission_updated_time`, `permission_is_deleted`, `permission_creator_id`, `permission_updater_id`) VALUES
('admin_dashboard', 'admin', 'Dashboard', 'dashboard', NULL, NULL, 0, NULL, NULL),
('show_admin_attlist', 'attendance', 'Attendance List', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_user', 'user', 'Manage User', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_leave', 'leave', 'Leave days', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_calendar', 'calendar', 'Calendar', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Salary', NULL, NULL, NULL, 0, NULL, NULL),
('user_dashboard', 'checkinout', 'Dashboard', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_attlist', 'attendance', 'Attendance List', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_leave', 'leave', 'Leave days', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_attlist', 'attendance', 'Today List', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_attlist', 'attendance', 'Monthly List', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_user', 'user', 'Add User', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_user', 'user', 'User List', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_leave', 'leave', 'Leave List', NULL, NULL, NULL, 0, NULL, NULL),
('show_admin_leave', 'leave', 'Apply Leave', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Add Salary', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Salary List', NULL, NULL, NULL, 0, NULL, NULL),
('show_salary', 'salary', 'Monthly Salary List', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_calendar', 'calendar', 'Calendar', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_leave', 'leave', 'Leave List', NULL, NULL, NULL, 0, NULL, NULL),
('show_user_leave', 'leave', 'Apply Leave', NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_permission_group`
--

CREATE TABLE IF NOT EXISTS `core_permission_group` (
  `permission_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `permission_group_code` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `permission_group_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `order_num` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_permission_group`
--

INSERT INTO `core_permission_group` (`permission_code`, `permission_group_code`, `permission_group_name`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`, `order_num`) VALUES
('admin_dashboard', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('show_admin_attlist', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('show_admin_user', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('show_admin_leave', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('show_admin_calendar', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('show_salary', 'ADMIN', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('user_dashboard', 'USER', 'user', NULL, NULL, NULL, NULL, 0, 0),
('show_user_attlist', 'USER', 'administrator', NULL, NULL, NULL, NULL, 0, 0),
('show_user_leave', 'USER', 'user', NULL, NULL, NULL, NULL, 0, 0),
('show_user_calendar', 'USER', 'user', NULL, NULL, NULL, NULL, 0, 0);

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
  `rel_member_id` varchar(36) NOT NULL DEFAULT '0',
  `permission_member_group_member_name` varchar(100) DEFAULT NULL,
  `rel_permission_group_code` varchar(36) NOT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_dt` datetime NOT NULL,
  `permission_member_group_is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core_permission_rel_member`
--

INSERT INTO `core_permission_rel_member` (`rel_member_id`, `permission_member_group_member_name`, `rel_permission_group_code`, `creator_id`, `created_dt`, `permission_member_group_is_deleted`) VALUES
('admin', 'administrator', 'ADMIN', '', '0000-00-00 00:00:00', 0),
('9af6af14-6e01-11e4-b676-82c4524d8ace', 'user', 'USER', '', '0000-00-00 00:00:00', 0);

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