-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2015 at 11:26 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE IF NOT EXISTS `allowances` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `full attendance bonus` double NOT NULL,
  `overtime` double NOT NULL,
  `responsibility allowance` double NOT NULL,
  `service year allowance` double NOT NULL,
  `customer site allowance` double NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE IF NOT EXISTS `attendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `att_date` date NOT NULL,
  `checkin_time` datetime NOT NULL,
  `checkout_time` datetime NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `att_date`, `checkin_time`, `checkout_time`, `notes`, `lat`, `lng`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
(1, 2, '2015-05-25', '2008-00-00 00:00:00', '2017-00-00 00:00:00', '', 0, 0, '2015-05-27 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(2, 3, '2015-05-27', '2015-06-11 08:00:00', '2015-06-11 17:00:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 4, '2015-05-27', '0000-00-00 00:00:00', '2015-06-10 08:15:00', '', 0, 0, '2015-06-10 17:45:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 5, '2015-05-27', '2015-06-10 08:00:00', '2015-06-10 18:00:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, 6, '2015-05-27', '2015-06-11 08:00:00', '2015-06-11 17:11:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, 2, '2015-05-26', '2015-06-11 08:16:00', '2015-06-11 17:00:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, 4, '2015-04-08', '2015-06-09 07:00:00', '2015-06-09 17:00:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, 5, '2014-10-07', '2015-06-10 08:00:00', '2015-06-10 18:00:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(9, 5, '2015-06-01', '2015-06-09 08:00:00', '2015-06-09 17:00:00', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

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

--
-- Dumping data for table `core_exports`
--

INSERT INTO `core_exports` (`id`, `title`, `file_name`, `file_type`, `module_name`, `table_name`, `export_fields`, `shared_flag`, `add_date_flag`, `shared_dept_code`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('1ca73292-cbe8-11e4-b8b1-6a2579ee427e', 'タイトル', 'ファイル名', 'csv', NULL, 'naotter_carte', 'carte_code,customer_code,owner_name', 0, 0, NULL, 'admin', '2015-03-16 00:00:00', 'admin', '2015-03-16 00:00:00', 0),
('325b1bce-cbf9-11e4-b8b1-6a2579ee427e', 'タイトル', 'ファイル名', 'csv', 'bill', 'bill', 'bill_no,rel_customer_code', 0, 0, NULL, 'admin', '2015-03-16 00:00:00', 'admin', '2015-03-16 00:00:00', 0),
('460daa18-cbf6-11e4-b8b1-6a2579ee427e', 'タイトル', 'ファイル名', 'csv', 'bill', 'bill', 'bill_no,rel_customer_code,request_to_name', 0, 0, NULL, 'admin', '2015-03-16 00:00:00', 'admin', '2015-03-16 00:00:00', 0),
('1ca73292-cbe8-11e4-b8b1-6a2579ee427e', 'タイトル', 'ファイル名', 'csv', NULL, 'naotter_carte', 'carte_code,customer_code,owner_name', 0, 0, NULL, 'admin', '2015-03-16 00:00:00', 'admin', '2015-03-16 00:00:00', 0),
('325b1bce-cbf9-11e4-b8b1-6a2579ee427e', 'タイトル', 'ファイル名', 'csv', 'bill', 'bill', 'bill_no,rel_customer_code', 0, 0, NULL, 'admin', '2015-03-16 00:00:00', 'admin', '2015-03-16 00:00:00', 0),
('460daa18-cbf6-11e4-b8b1-6a2579ee427e', 'タイトル', 'ファイル名', 'csv', 'bill', 'bill', 'bill_no,rel_customer_code,request_to_name', 0, 0, NULL, 'admin', '2015-03-16 00:00:00', 'admin', '2015-03-16 00:00:00', 0);

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
('0372f14c-c67c-11e4-9e5e-647210f9b28f', 'image/jpeg', 'jpg', 'naotter_carte_branch', 'ef806748-c679-11e4-9e5e-647210f9b28f', NULL, 2, 'admin', '2015-03-10 01:47:46', NULL, '2015-03-09 23:39:10', 1),
('037911b0-bb66-11e4-8028-16598075c78a', NULL, 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:12:34', NULL, NULL, 0),
('20a7b16a-bc06-11e4-8028-16598075c78a', 'image/png', 'png', 'naotter_carte_branch', 'eba83b06-bc05-11e4-8028-16598075c78a', NULL, 2, 'admin', '2015-02-24 18:18:43', NULL, '2015-02-24 18:47:51', 1),
('246eb122-c67e-11e4-9e5e-647210f9b28f', 'image/jpeg', 'jpg', 'naotter_carte_branch', 'fbfaaff6-c679-11e4-9e5e-647210f9b28f', NULL, 2, 'admin', '2015-03-10 02:03:00', NULL, '2015-03-09 23:38:58', 1),
('2c61cab8-bb66-11e4-8028-16598075c78a', 'image/jpeg', 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:13:43', NULL, NULL, 0),
('3e7e1974-bbb9-11e4-8028-16598075c78a', 'image/jpeg', 'jpg', 'naotter_carte_branch', '8fa05ff4-b8dc-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-24 09:08:22', NULL, NULL, 0),
('44f736de-bb6c-11e4-8028-16598075c78a', 'image/jpeg', 'jpg', 'naotter_carte_branch', '8fa05ff4-b8dc-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:57:21', NULL, NULL, 0),
('56ad4c3a-bb65-11e4-8028-16598075c78a', NULL, 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:07:44', NULL, NULL, 0),
('5b5341fe-bb65-11e4-8028-16598075c78a', NULL, 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:07:52', NULL, NULL, 0),
('6d700f5c-bc0a-11e4-8028-16598075c78a', 'image/png', 'png', 'naotter_carte_branch', 'eba83b06-bc05-11e4-8028-16598075c78a', NULL, 2, 'admin', '2015-02-24 18:49:30', NULL, '2015-02-24 18:49:34', 1),
('a66716ac-bb65-11e4-8028-16598075c78a', NULL, 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:09:58', NULL, NULL, 0),
('dad4f466-c3a5-11e4-9e5e-647210f9b28f', 'image/jpeg', 'jpg', 'naotter_carte_branch', '0c6ab60c-b035-11e4-96c4-63e65a0e37e9', NULL, 0, 'admin', '2015-03-06 11:09:43', NULL, NULL, 0),
('e9e77f2a-bb65-11e4-8028-16598075c78a', NULL, 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:11:51', NULL, NULL, 0),
('e9f4ec5a-bb65-11e4-8028-16598075c78a', NULL, 'jpg', 'naotter_carte_branch', '382ca54e-b895-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:11:52', NULL, NULL, 0),
('f2f892c4-bb6b-11e4-8028-16598075c78a', 'image/jpeg', 'jpg', 'naotter_carte_branch', '8fa05ff4-b8dc-11e4-8b55-1d823584f74b', NULL, 0, 'admin', '2015-02-23 23:55:04', NULL, NULL, 0),
('fdbd2234-bc05-11e4-8028-16598075c78a', 'image/jpeg', 'jpg', 'naotter_carte_branch', 'eba83b06-bc05-11e4-8028-16598075c78a', NULL, 2, 'admin', '2015-02-24 18:17:44', NULL, '2015-02-24 18:48:40', 1),
('fdcfd46a-bc05-11e4-8028-16598075c78a', 'image/png', 'png', 'naotter_carte_branch', 'eba83b06-bc05-11e4-8028-16598075c78a', NULL, 2, 'admin', '2015-02-24 18:17:45', NULL, '2015-02-24 18:46:59', 1);

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
('core_member', '1258ee26-754d-11e4-b4fc-a91e9baf9c00', 'admin', 'Administrator ', '2015-03-06 23:29:04', 'admin', '2015-03-06 22:59:04'),
('core_member', '944cdc54-73cb-11e4-9e06-93eff5fd146b', 'admin', 'Administrator ', '2015-03-06 10:41:35', 'admin', '2015-03-06 10:11:35'),
('core_member', 'a341f7e8-6e4a-11e4-b676-82c4524d8ace', 'admin', 'Administrator ', '2015-03-03 02:02:06', 'admin', '2015-03-03 01:32:06'),
('core_member', 'c422a154-c0f9-11e4-a6dd-7a12eb6538e9', 'admin', 'Administrator ', '2015-03-05 21:39:48', 'admin', '2015-03-05 21:09:48'),
('core_member', 'd6c1f45a-6ffe-11e4-bf19-78638984f957', 'admin', 'Administrator ', '2014-12-27 22:06:39', 'admin', '2014-12-27 21:36:39'),
('core_member', 'efe235c2-9672-11e4-a3e5-b3f3ac838c32', 'admin', 'Administrator ', '2015-01-07 23:11:59', 'admin', '2015-01-07 22:41:59'),
('customer_main', 'm1', 'admin', 'Administrator ', '2015-03-03 10:50:32', 'admin', '2015-03-03 10:20:32'),
('naotter_carte', '305160a2-b062-11e4-9f7b-a3b0879658f6', 'admin', 'Administrator ', '2015-02-09 23:17:33', 'admin', '2015-02-09 22:47:33'),
('naotter_carte', '32', 'admin', 'Administrator ', '2014-12-29 22:53:11', 'admin', '2014-12-29 22:23:11'),
('naotter_carte', '382ca54e-b895-11e4-8b55-1d823584f74b', 'admin', 'Administrator ', '2015-02-24 00:13:08', 'admin', '2015-02-23 23:43:08'),
('naotter_carte', '3864a57c-8dc3-11e4-a651-b2b268f284bf', 'admin', 'Administrator ', '2014-12-27 21:54:08', 'admin', '2014-12-27 21:24:08'),
('naotter_carte', '39', 'admin', 'Administrator ', '2015-03-03 11:36:05', 'admin', '2015-03-03 11:06:05'),
('naotter_carte', '3d205368-8dc3-11e4-a651-b2b268f284bf', 'admin', 'Administrator ', '2014-12-29 22:53:37', 'admin', '2014-12-29 22:23:37'),
('naotter_carte', '54', 'admin', 'Administrator ', '2015-03-05 14:47:10', 'admin', '2015-03-05 14:17:10'),
('naotter_carte', '602e55ca-9b89-11e4-aae1-cf6bad2099a0', 'admin', 'Administrator ', '2015-01-14 10:35:51', 'admin', '2015-01-14 10:05:51'),
('naotter_carte', '63', 'admin', 'Administrator ', '2015-03-05 17:43:57', 'admin', '2015-03-05 17:13:57'),
('naotter_carte', '64', 'admin', 'Administrator ', '2015-04-23 06:52:41', 'admin', '2015-04-23 06:22:41'),
('naotter_carte', '64fadd3c-b027-11e4-96c4-63e65a0e37e9', 'admin', 'Administrator ', '2015-02-09 16:16:56', 'admin', '2015-02-09 15:46:56'),
('naotter_carte', '68', 'admin', 'Administrator ', '2015-04-01 12:52:17', 'admin', '2015-04-01 12:22:17'),
('naotter_carte', '77', 'admin', 'Administrator ', '2015-04-23 09:07:13', 'admin', '2015-04-23 08:37:13'),
('naotter_carte', '79', 'admin', 'Administrator ', '2015-05-04 05:29:36', 'admin', '2015-05-04 04:59:36'),
('naotter_carte', '8fa05ff4-b8dc-11e4-8b55-1d823584f74b', 'admin', 'Administrator ', '2015-02-24 00:19:23', 'admin', '2015-02-23 23:49:23'),
('naotter_carte', 'ef951048-8dc2-11e4-a651-b2b268f284bf', 'admin', 'Administrator ', '2015-01-14 17:55:30', 'admin', '2015-01-14 17:25:30'),
('schedule', '44303412-c779-11e4-9e5e-647210f9b28f', 'admin', 'Administrator ', '2015-03-11 09:10:10', 'admin', '2015-03-11 08:40:10'),
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
('1258ee26-754d-11e4-b4fc-a91e9baf9c00', 'admin2', '315f166c5aca63a157f7d41007675cb44a948b33', '管理者', 'システム', 'システム 管理者', 'かんりしゃ', 'システム', 'システム かんりしゃ', 'admin', '管理者用', '', '', '', '', '', '', '', '', 'ja', 0, NULL, 'admin', '2014-11-26 18:17:40', 'admin', '2015-03-06 22:58:07', 0),
('517789a4-94fc-11e4-8cf4-3b7ec45c8174', 'anesis', '51a5f96e61c5a109b6d4a3d2fec0e77717934ddb', 'テスト', 'アネシス', 'アネシス テスト', 'テスト', 'アネシス', 'アネシス テスト', '100000001', '部署テスト', '', '', '', '', '', '', '', '', 'ja', 0, NULL, 'admin', '2015-01-06 02:00:14', NULL, NULL, 0),
('902a67ac-b752-11e4-8b55-1d823584f74b', '', NULL, '', '', '', '', '', '', '', '部署を選択してください', '', '', '', '', '', '', '', '', 'ja', 0, NULL, 'admin', '2015-02-18 18:43:16', 'admin', '2015-02-27 21:06:50', 1),
('944cdc54-73cb-11e4-9e06-93eff5fd146b', 'guest01', 'c6166207eb766e2910af4b52456bc77765933b8f', '01', 'Guest', 'Guest 01', '01', 'Guest', 'Guest 01', '20202', '部署', '', '', '', '', '', '', '', '', 'ja', 0, NULL, 'admin', '2014-11-24 20:18:13', 'admin', '2014-11-24 20:19:42', 0),
('9af6af14-6e01-11e4-b676-82c4524d8ace', 'test02', '889ab7d027b385e292587ff9cb6d92d5a14aefa7', 'User02', 'Test', 'Test User02', 'ユーザ２', 'テスト', 'テスト ユーザ２', '100000001', '部署テスト', '', '', '', '', 'memo', 'test02@example.com', '', 'Manager', 'ja', 0, NULL, 'admin', '2014-11-17 11:29:50', 'admin', '2014-11-17 13:53:24', 0),
('a341f7e8-6e4a-11e4-b676-82c4524d8ace', 'test03', '', 'User03', 'Test', 'Test User03', 'ユーザ３', 'テスト', 'テスト ユーザ３', 'ad03', 'ﾃｽﾄ', '', '', '', '', '', 'test03@example.com', 'test03@example.com', '', 'ja', 0, NULL, 'admin', '2014-11-17 20:12:37', 'admin', '2014-11-20 23:19:49', 0),
('a752879a-6e2b-11e4-b676-82c4524d8ace', 'delete', '9485989ff514b5106b7738850fd73c23e8c1e3f7', 'User', 'Deleted', 'Deleted User', 'User', 'Deleted', 'Deleted User', '100000001', '部署テスト', '', '', '', '', 'ユーザ', '', '', '', 'ja', 0, NULL, 'admin', '2014-11-17 16:30:49', 'admin', '2014-11-17 16:33:35', 1),
('admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 'Administrator', 'Administrator ', '', 'Administrator', 'Administrator ', 'admin', 'wheel', '', '', '', '', '管理者', 'sample@test.com', '', '', 'en', 1, NULL, '1', '2014-09-22 11:41:47', 'admin', '2015-05-18 10:45:27', 0),
('c422a154-c0f9-11e4-a6dd-7a12eb6538e9', 'suzin', '92f8e9dbb80a6cb1632080f0bc2ce4fef5b6', '優一', 'Test', 'Test 優一', '', '', '', 'dept-admin', '取引先', '', '', '', '', 'test test', '', '', '', 'ja', 0, NULL, 'admin', '2015-03-03 01:32:49', NULL, NULL, 0),
('d6c1f45a-6ffe-11e4-bf19-78638984f957', 'admintest', 'ecda1ddb64ac9e6f442a196910fa3dc0b8eb1929', 'test', 'Admin', 'Admin test', 'Test', 'Admin', 'Admin Test', 'admin2', '管理者用2階層', '', '', '', '', '', '', '', '', 'ja', 0, NULL, 'admin', '2014-11-20 00:15:04', NULL, NULL, 0),
('efe235c2-9672-11e4-a3e5-b3f3ac838c32', 'member8', 'a53c3cc10ecae67ff1a3532a50f8f4136f64e78a', '8', 'member8', 'member8 8', '8', '8', '8 8', NULL, '', '', '', '', '', 'member8', '', '', '', 'ja', 0, NULL, 'admin', '2015-01-07 22:41:52', 'admin', '2015-01-07 22:45:24', 0),
('test001', 'test001', '62cbf61fbce67eeb64a226a50e1cb41fc80fc6fd', '太郎', 'テスト', 'テスト 太郎', 'ﾀﾛｳ', 'ﾃｽﾄ', 'ﾃｽﾄ ﾀﾛｳ', '1212', '部所部署', '', '', '', '', '', '', '', '', 'ja', 0, NULL, 'admin', '2015-03-06 17:11:41', NULL, NULL, 0),
('test004', 'test004', 'fdc4b9cb887f6f0d888e2ee1558ad917e8ee12ea', '003', 'テスト', 'テスト 003', '004', 'テスト', 'テスト 004', '100000001', '部署テスト', '', '', '', '', '', '', '', '', 'ja', 0, NULL, 'admin', '2015-03-05 22:03:41', NULL, NULL, 0),
('test01', 'test01', 'c25a79c57906ba7027b36d380230db92bbc0fd64', 'User01', 'Test', 'Test User01', 'user', 'test', 'test user', 'dept-admin', '取引先', '', '', '', '', '', 'test@example.com', '', '', 'en', 0, NULL, '1', '2014-09-17 18:01:55', 'admin', '2014-11-16 23:43:43', 0);

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
('accountreport', 1, '経理レポート', 'accountreport', NULL, NULL, NULL, 4, 0),
('adminmaintain', 9, '管理', 'Administrator System', 1, '2013-06-25 13:27:38', '管理', 11, 0),
('assign', 1, 'アサイン', 'Assign', 1, NULL, 'アサインする', 12, 0),
('bill', 1, '請求書', 'bill', NULL, NULL, NULL, 5, 0),
('customer', 1, '顧客', 'Customer', 1, NULL, NULL, 2, 0),
('disbursement', 1, '支払', 'disbursement', NULL, NULL, NULL, 3, 0),
('estimate', 1, '見積', 'Estimate', 1, '2014-11-21 00:00:00', '見積もり', 14, 0),
('mail', 1, 'メール受信', 'Mail', 1, '2014-04-18 11:55:07', 'メール受信', 9, 0),
('master', 9, 'マスタメンテ', 'Master', 1, '2014-04-16 13:15:58', 'マスタメンテ', 13, 0),
('member', 1, 'メンバー', 'Members', 1, '2012-02-16 17:17:39', 'メンバー', 10, 0),
('naotter', 1, '修理検索', 'naotter', NULL, NULL, NULL, 6, 0),
('naottersetting', 1, '設定', 'naottersetting', NULL, NULL, NULL, 8, 0),
('outsoucer', 1, '外注先', 'outsoucer', NULL, NULL, NULL, 7, 0),
('receiving', 1, '入金', 'receiving', 1, NULL, NULL, 15, 0),
('reception', 1, '顧客受付', 'Reception', 1, NULL, '顧客受付機能', 1, 0);

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
('add_folder', 'mail', 'フォルダ追加', 'メールのフォルダを追加します。', NULL, NULL, 0, NULL, NULL),
('add_member', 'member', 'メンバーの追加', NULL, NULL, NULL, 0, NULL, NULL),
('auth_account', 'estimate', '経理権限', NULL, NULL, NULL, 0, NULL, NULL),
('auth_admin', 'estimate', '管理者権限', NULL, NULL, NULL, 0, NULL, NULL),
('auth_sales', 'estimate', '営業権限', NULL, NULL, NULL, 0, NULL, NULL),
('change_password', 'member', 'パスワードの変更', NULL, NULL, NULL, 0, NULL, NULL),
('delete_mail', 'mail', 'メール削除', 'メール削除権限。 メール削除ボタンを表示し、メールを削除することが出来ます。', NULL, NULL, 0, NULL, NULL),
('del_member', 'member', 'メンバーの削除', NULL, NULL, NULL, 0, NULL, NULL),
('edit_member', 'member', 'メンバーの編集', NULL, NULL, NULL, 0, NULL, NULL),
('edit_team', 'member', 'チームの編集', NULL, NULL, NULL, 0, NULL, NULL),
('empty_trash_mail', 'mail', 'ゴミ箱を空にする。', 'ゴミ箱を空にして、実データも削除します。 サーバから該当のデータを削除し、添付ファイルも削除します。', NULL, NULL, 0, NULL, NULL),
('move_mail', 'mail', 'メールを移動する。', 'メールのフォルダ移動を実行します。', NULL, NULL, 0, NULL, NULL),
('request_mail', 'mail', 'メール依頼', 'メール依頼ボタンをアクティブにします。 この機能は、他の搭載されているモジュールによりアクティブにならない場合が有ります。', NULL, NULL, 0, NULL, NULL),
('setting_dept', 'member', '部署の設定', NULL, NULL, NULL, 0, NULL, NULL),
('setting_mail', 'mail', 'メール設定', 'メールの設定を行います。 アカウントの設定や、フィルタの設定はこちらから行います。', NULL, NULL, 0, NULL, NULL),
('view_menu', 'accountreport', 'enable_accountreport_module', NULL, NULL, NULL, 0, NULL, NULL),
('view_menu', 'adminmaintain', '※モジュール閲覧', '', NULL, NULL, 0, NULL, NULL),
('view_menu', 'assign', '※アサインモジュール閲覧', '', NULL, NULL, 0, NULL, NULL),
('view_menu', 'bill', 'enable_bill_module', NULL, NULL, NULL, 0, NULL, NULL),
('view_menu', 'disbursement', 'enable_disbursement_module', NULL, NULL, NULL, 0, NULL, NULL),
('view_menu', 'estimate', '見積メニューの表示', NULL, NULL, NULL, 0, NULL, NULL),
('view_menu', 'mail', 'メール受信', NULL, NULL, NULL, 0, NULL, NULL),
('view_menu', 'master', '※モジュール閲覧', '', NULL, NULL, 0, NULL, NULL),
('view_menu', 'member', '※メンバーモジュールの閲覧', NULL, NULL, NULL, 0, NULL, NULL),
('view_menu', 'naotter', 'enable naotter module', NULL, NULL, NULL, 0, NULL, NULL),
('view_menu', 'naottersetting', 'enable_naottersetting_module', NULL, NULL, NULL, 0, NULL, NULL),
('view_menu', 'outsoucer', 'enable outsoucer module', NULL, NULL, NULL, 0, NULL, NULL),
('view_menu', 'receiving', 'enable_receiving_module', NULL, NULL, NULL, 0, NULL, NULL),
('view_menu', 'reception', '顧客受付タブの閲覧', NULL, NULL, NULL, 0, NULL, NULL),
('view_menu', 'workprocess', '業務処理タブの閲覧', '業務処理モジュールを見えるようにする。', NULL, NULL, 0, NULL, NULL),
('view_module_customer', 'customer', '顧客モジュールの閲覧', '顧客モジュールを閲覧可能にする。', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `core_permission_group`
--

CREATE TABLE IF NOT EXISTS `core_permission_group` (
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

INSERT INTO `core_permission_group` (`permission_group_code`, `permission_group_name`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`, `order_num`) VALUES
('20140917203226', '99.Guest', '1', '2014-09-17 18:02:26', 'admin', '2015-02-09 22:12:38', 0, 0),
('a783736a-c35c-11e4-9e5e-647210f9b28f', '20.経理', 'admin', '2015-03-06 02:25:44', 'admin', '2015-03-10 02:19:33', 0, 0),
('ADMIN', '00.Administrators', '999', '2013-08-19 00:55:49', 'admin', '2015-05-18 10:21:35', 0, 0),
('f34421a0-632b-11e4-b1a6-464eb39ae9c0', '10.一般ユーザ', 'admin', '2014-11-03 16:35:14', 'admin', '2015-03-03 23:48:23', 0, 0),
('20140917203226', '99.Guest', '1', '2014-09-17 18:02:26', 'admin', '2015-02-09 22:12:38', 0, 0),
('a783736a-c35c-11e4-9e5e-647210f9b28f', '20.経理', 'admin', '2015-03-06 02:25:44', 'admin', '2015-03-10 02:19:33', 0, 0),
('ADMIN', '00.Administrators', '999', '2013-08-19 00:55:49', 'admin', '2015-05-18 10:21:35', 0, 0),
('f34421a0-632b-11e4-b1a6-464eb39ae9c0', '10.一般ユーザ', 'admin', '2014-11-03 16:35:14', 'admin', '2015-03-03 23:48:23', 0, 0);

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

--
-- Dumping data for table `core_permission_rel_dept`
--

INSERT INTO `core_permission_rel_dept` (`rel_dept_code`, `rel_permission_group_code`, `creator_id`, `created_dt`) VALUES
('ad03', '20140917203226', '', '0000-00-00 00:00:00');

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
('1258ee26-754d-11e4-b4fc-a91e9baf9c00', 'システム 管理者', 'ADMIN', 'admin', '2014-11-26 18:19:30', 0),
('517789a4-94fc-11e4-8cf4-3b7ec45c8174', 'アネシス テスト', 'f34421a0-632b-11e4-b1a6-464eb39ae9c0', 'admin', '2015-01-06 02:03:23', 0),
('944cdc54-73cb-11e4-9e06-93eff5fd146b', 'Guest 01', '20140917203226', 'admin', '2015-02-06 17:15:42', 0),
('9af6af14-6e01-11e4-b676-82c4524d8ace', 'Test User02', '20140917203226', 'admin', '2014-11-21 22:40:17', 0),
('a341f7e8-6e4a-11e4-b676-82c4524d8ace', 'Test User03', '20140917203226', 'admin', '2015-02-06 17:15:42', 0),
('admin', 'システム管理者', 'ADMIN', '', '0000-00-00 00:00:00', 0);

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

--
-- Dumping data for table `core_session`
--

INSERT INTO `core_session` (`id`, `modified`, `lifetime`, `data`) VALUES
('02ieimvkg1ll97iah8f235vjc0', 1433231575, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}'),
('2bq2aof7rp3qa2nmqhni2d3hh5', 1432630212, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}'),
('41eq13lifitnd9o7drpoamqiv7', 1431927144, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}estimate_index|a:1:{s:15:"searchCondition";a:17:{s:18:"rel_cust_code_from";s:0:"";s:16:"rel_cust_code_to";s:0:"";s:18:"request_to_cd_from";s:0:"";s:16:"request_to_cd_to";s:0:"";s:15:"voucher_no_from";s:0:"";s:15:"estimate_status";s:1:"0";s:23:"appropriation_date_from";s:10:"2014/11/18";s:21:"appropriation_date_to";s:10:"2015/05/18";s:11:"cutoff_date";s:0:"";s:25:"sales_accounted_date_from";s:10:"2014/11/18";s:23:"sales_accounted_date_to";s:10:"2015/05/18";s:10:"total_from";s:0:"";s:8:"total_to";s:0:"";s:16:"search_item_name";s:0:"";s:18:"search_item_remark";s:0:"";s:19:"search_site_address";s:0:"";s:16:"means_of_payment";s:1:"1";}}Zend_search|a:1:{s:6:"result";a:0:{}}bill_monthly|a:1:{s:8:"storedID";a:2:{i:0;s:2:"28";i:1;s:2:"29";}}'),
('7b1f77qkfqro7etsp9tptb68j5', 1432529879, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}bill_monthly|a:1:{s:8:"storedID";a:1:{i:0;i:-1;}}'),
('91nj79r3154knfpp5fqq4hqv45', 1433127440, 86400, ''),
('acumlgtk835s9rmu1k754dsgl5', 1432204216, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}Zend_search|a:1:{s:11:"resoucer_id";s:0:"";}'),
('cn6n0t23prpcuam3sbcav23l92', 1433127440, 86400, ''),
('eruq5djqt2q67nkgmgp6ttgee2', 1432000830, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}'),
('je3lcja1mefd639ri5p2b80dh7', 1433127455, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}'),
('kusb6fslti942r5f7mhi6vgng5', 1432701618, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}'),
('m31c8nsdfbeoic2aajfem946u2', 1432116111, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}Zend_search|a:1:{s:11:"resoucer_id";s:2:"10";}'),
('oa9ul6hs5637ug32l92pf3t720', 1432267682, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}Zend_search|a:1:{s:11:"resoucer_id";s:0:"";}'),
('s5l1uigmkba06ob5j1qacm8t94', 1432287015, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}'),
('uravpkbqvc61tagvr3suera5f0', 1432031487, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}Zend_search|a:1:{s:11:"resoucer_id";s:1:"3";}'),
('v0h4am24cbpv9tgbqbetmugpu6', 1432269070, 86400, ''),
('v1tet7tavf61lstaea9h2buuc3', 1432632819, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}'),
('v6eegiqb3naspb2rds0nlkbmd2', 1432269175, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}Zend_search|a:1:{s:11:"resoucer_id";s:0:"";}'),
('lfjq9kim049d9d2bcgh6ebfdm4', 1433238196, 86400, 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":27:{s:9:"member_id";s:5:"admin";s:17:"member_login_name";s:5:"admin";s:15:"member_password";s:40:"d033e22ae348aeb5660fc2140aec35850c4da997";s:17:"member_first_name";s:0:"";s:18:"member_family_name";s:13:"Administrator";s:9:"full_name";s:14:"Administrator ";s:22:"member_first_name_kana";s:0:"";s:23:"member_family_name_kana";s:13:"Administrator";s:16:"member_sort_name";s:14:"Administrator ";s:16:"member_dept_code";s:5:"admin";s:16:"member_dept_name";s:5:"wheel";s:10:"member_tel";s:0:"";s:17:"member_mobile_tel";s:0:"";s:10:"member_fax";s:0:"";s:10:"member_ext";s:0:"";s:11:"member_memo";s:9:"管理者";s:11:"member_mail";s:15:"sample@test.com";s:13:"member_mail_2";s:0:"";s:9:"job_title";s:0:"";s:4:"lang";s:2:"en";s:9:"rank_code";i:0;s:16:"member_is_change";N;s:10:"creator_id";s:1:"1";s:10:"created_dt";s:19:"2014-09-22 11:41:47";s:10:"updater_id";s:5:"admin";s:10:"updated_dt";s:19:"2015-05-18 10:45:27";s:11:"delete_flag";i:0;}}Permission|a:2:{s:17:"_memberPermission";a:15:{s:6:"member";a:7:{s:10:"add_member";s:10:"add_member";s:15:"change_password";s:15:"change_password";s:10:"del_member";s:10:"del_member";s:11:"edit_member";s:11:"edit_member";s:9:"edit_team";s:9:"edit_team";s:12:"setting_dept";s:12:"setting_dept";s:9:"view_menu";s:9:"view_menu";}s:8:"estimate";a:4:{s:12:"auth_account";s:12:"auth_account";s:10:"auth_admin";s:10:"auth_admin";s:10:"auth_sales";s:10:"auth_sales";s:9:"view_menu";s:9:"view_menu";}s:13:"accountreport";a:1:{s:9:"view_menu";s:9:"view_menu";}s:13:"adminmaintain";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"assign";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"bill";a:1:{s:9:"view_menu";s:9:"view_menu";}s:12:"disbursement";a:1:{s:9:"view_menu";s:9:"view_menu";}s:4:"mail";a:1:{s:9:"view_menu";s:9:"view_menu";}s:6:"master";a:1:{s:9:"view_menu";s:9:"view_menu";}s:7:"naotter";a:1:{s:9:"view_menu";s:9:"view_menu";}s:14:"naottersetting";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"outsoucer";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"receiving";a:1:{s:9:"view_menu";s:9:"view_menu";}s:9:"reception";a:1:{s:9:"view_menu";s:9:"view_menu";}s:8:"customer";a:1:{s:20:"view_module_customer";s:20:"view_module_customer";}}s:13:"_isSessionKey";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `leave days` int(11) NOT NULL,
  `leave_category` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `leave_description` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `leave_status` tinyint(3) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salary_detail`
--

CREATE TABLE IF NOT EXISTS `salary_detail` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `basic_salary` double NOT NULL,
  `travel _fee` double NOT NULL,
  `overtime` double NOT NULL,
  `ssc_comp` double NOT NULL,
  `ssc_emp` double NOT NULL,
  `absent dedution` double NOT NULL,
  `income_tax` double NOT NULL,
  `pay date` datetime NOT NULL,
  `creator_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_master`
--

CREATE TABLE IF NOT EXISTS `salary_master` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `basic_salary` double NOT NULL,
  `travel _fee` double NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxs`
--

CREATE TABLE IF NOT EXISTS `taxs` (
  `id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `absent deduction` double NOT NULL,
  `ssc` double NOT NULL,
  `income tax` int(11) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updater_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `updated_dt` datetime NOT NULL,
  `deleted_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
