-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2016 at 10:09 AM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

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
  `member_id` varchar(500) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'uuid',
  `user_rule_member_id` int(50) NOT NULL AUTO_INCREMENT,
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
  `timeflag` datetime DEFAULT NULL,
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_rule_member_id`),
  UNIQUE KEY `user_rule_member_id` (`user_rule_member_id`),
  KEY `member_login_name` (`member_login_name`),
  KEY `user_rule_member_id_2` (`user_rule_member_id`),
  KEY `user_rule_member_id_3` (`user_rule_member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `core_member`
--

INSERT INTO `core_member` (`member_id`, `user_rule_member_id`, `member_login_name`, `member_password`, `full_name`, `member_dept_name`, `member_mobile_tel`, `member_mail`, `position`, `user_rule`, `lang`, `member_address`, `member_profile`, `rank_code`, `member_is_change`, `working_start_dt`, `working_year_by_year`, `rs_status`, `timeflag`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`) VALUES
('admin', 1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'wheel', '1234567', 'sample@test.comFF', 'Adminstrator', 0, 'en', 'yangon ', '', 1, NULL, '2015-02-02', '2016-02-02', '', '2016-03-10 11:52:25', '1', '2014-09-22 11:41:47', 'admin', '2015-05-18 10:45:27', 0),
('25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', 2, 'suyamin', '03a5fbce9f1480a607198d9e2d95718527c4ebcf', 'suyamin ', 'web', '23424', 'suyamin@gmail.com', 'developer', 4, NULL, 'ygn', '', 0, NULL, '0000-00-00', NULL, '', '2016-01-21 13:06:03', NULL, NULL, NULL, NULL, 1),
('e6166942-6f6a-11e5-8d57-845d45458be8', 3, 'zinmon', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'zin mon', 'web', '22', 'zinmonthet88@gmail.com', 'developer', 0, NULL, 'ygn', '36983.jpg', 0, NULL, '2015-02-02', NULL, '', '2016-01-21 13:06:03', 'admin', '2015-02-02 22:51:02', NULL, '0000-00-00 00:00:00', 0),
('9496c284-91b5-11e5-ba6c-b3c9d3c668b5', 4, 'kyaw', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'kyaw', 'web', '133399', 'zinmonthet88@gmail.com', 'senior developer', NULL, NULL, 'aa', '71570.', 0, NULL, '2015-11-02', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2015-11-23 14:11:17', NULL, '0000-00-00 00:00:00', 1),
('2cc32dba-91c8-11e5-ba6c-b3c9d3c668b5', 5, 'mon', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mon', 'web', '133399', 'zinmonthet88@gmail.com', 'senior developer', NULL, 'en', 'adfsaf', '77683.', 0, NULL, '2015-11-02', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2015-11-23 16:24:23', NULL, '0000-00-00 00:00:00', 0),
('c53f9fb6-91f4-11e5-8213-2f3ca2776dbb', 6, 'khin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'khin', 'engineering', '133399', 'khin@gmail.com', 'senior developer', NULL, 'en', 'ggg', '11947.', 0, NULL, '2015-11-02', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2015-11-23 21:43:37', NULL, '0000-00-00 00:00:00', 0),
('10b3910c-94aa-11e5-973c-293aa9a2310d', 7, 'malkhin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'malkhin', 'web', '133399', 'zinmonthet88@gmail.com', 'senior developer', 4, 'en', 'afdaf', '57864.jpg', 0, NULL, '2015-11-02', NULL, NULL, '2016-01-25 14:56:19', 'admin', '2015-11-27 08:26:25', NULL, '0000-00-00 00:00:00', 0),
('2fb953a8-989b-11e5-8643-3fc008e66a60', 8, 'mayzin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mayzin', 'web', '133399', 'zinmonthet88@gmail.com', 'akf', 2, 'en', 'afad', '99573.', 0, NULL, '2015-12-01', NULL, NULL, '2016-01-21 13:36:06', 'admin', '2015-12-02 08:49:59', NULL, '0000-00-00 00:00:00', 1),
('500a5b26-98a4-11e5-8643-3fc008e66a60', 9, 'mone', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mone', 'web', '133399', 'zinmonthet88@gmail.com', 'senior developer', 2, 'en', 'adfafd', '12942.jpg', 0, NULL, '2015-12-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2015-12-02 09:55:18', NULL, '0000-00-00 00:00:00', 0),
('1455f388-91b5-11e5-ba6c-b3c9d3c668b5', 10, 'mm', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mm', 'gh', '133399', 'zinmonthet88@gmail.com', 'akf', 4, 'en', 'adfasf', '87636.jpg', 0, NULL, '2015-12-01', '2016-12-01', NULL, '2016-01-21 13:06:03', 'admin', '2015-12-02 16:14:26', NULL, '0000-00-00 00:00:00', 1),
('e6b33a22-98de-11e5-8643-3fc008e66a60', 11, 'Ko Ko', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Ko Ko', 'web', '3583409', 'aaa@gmail.com', 'senior developer', 4, 'en', 'Yangon', '86433.', 0, NULL, '2015-10-05', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2015-12-02 16:54:42', NULL, '0000-00-00 00:00:00', 0),
('1fe99868-9a42-11e5-9896-c672e8365401', 12, 'mimi', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mi mi', 'web', '133399', 'gnext.suzin@gmail.com', 'senior developer', 4, 'en', 'ygn', '21927.jpg', 0, NULL, '2015-12-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2015-12-04 11:17:29', NULL, '0000-00-00 00:00:00', 1),
('1e1d4874-9c89-11e5-8202-00bebb6ffa97', 14, 'testing', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'htoo', 'web', '133399', 'gnext.suzin@gmail.com', 'senior developer', 4, 'en', 'ygn', '22832.jpg', 0, NULL, '2015-12-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2015-12-07 08:50:43', NULL, '0000-00-00 00:00:00', 0),
('9e251b6e-a9ef-11e5-93db-d11a0cee87d7', 15, 'aung', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'aung', 'web', '222222', 'aung@gmail.com', 'developer', 3, 'en', 'ygn', '50297.jpg', 0, NULL, '2015-12-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2015-12-24 10:07:12', NULL, '0000-00-00 00:00:00', 0),
('337a1d2a-b42e-11e5-9869-f6341df67a83', 16, 'Auser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'auser', 'design', '1233', 'auser@gmail.com', 'designer', 4, 'en', 'ygn', '89497.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 11:00:22', NULL, '0000-00-00 00:00:00', 0),
('5ee60fb4-b42e-11e5-9869-f6341df67a83', 17, 'Buser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'buser', 'web', '32424', 'buser@gmail.com', 'developer', 4, 'en', 'mdy', '82250.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 11:01:35', NULL, '0000-00-00 00:00:00', 0),
('87a1c1dc-b42e-11e5-9869-f6341df67a83', 18, 'Cuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'cuser', 'engineering', '234204', 'buser@gmail.com', 'engineer', 4, 'en', 'ygn', '58728.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 11:02:44', NULL, '0000-00-00 00:00:00', 1),
('aa103320-b42e-11e5-9869-f6341df67a83', 19, 'Duser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'duser', 'web', '324241', 'duser@gmail.com', 'developer', 4, 'en', 'mdy', '80699.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 11:03:41', NULL, '0000-00-00 00:00:00', 0),
('cdcb3fe4-b42e-11e5-9869-f6341df67a83', 20, 'Euser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'euser', 'engineering', '1234', 'euser@gmail.com', 'engineer', 4, 'en', 'mdy', '80500.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 11:04:41', NULL, '0000-00-00 00:00:00', 1),
('ed13b5de-b42e-11e5-9869-f6341df67a83', 21, 'Fuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'fuser', 'web', '29302', 'fuser@gmail.com', 'developer', 4, 'en', 'mdy', '5917.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 11:05:34', NULL, '0000-00-00 00:00:00', 1),
('7fde072c-b44b-11e5-9869-f6341df67a83', 22, 'Guser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Guser', 'Gnext', '22213141', 'Guser@gmail.com', 'developer', 4, 'en', 'yangon', '40092.png', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:30:06', NULL, '0000-00-00 00:00:00', 0),
('b5b5b6b0-b44b-11e5-9869-f6341df67a83', 23, 'Huser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Huser', 'Hostin', '2974194701', 'Huser@gmail.com', 'Hh', 4, 'en', 'Seoul', '30384.jpg', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:31:36', NULL, '0000-00-00 00:00:00', 0),
('826df79e-b44c-11e5-9869-f6341df67a83', 24, 'Iuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Iuser', 'Itest', '98529525', 'Iuser@gmail.com', 'testor', 4, 'en', '', '38759.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:37:20', NULL, '0000-00-00 00:00:00', 0),
('dbaaae60-b44c-11e5-9869-f6341df67a83', 25, 'Juser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Juser', 'Just', '57252525', 'Juser@gmail.com', 'Juser', 4, 'en', 'ygn', '84601.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:39:50', NULL, '0000-00-00 00:00:00', 0),
('f0a2ac14-b44c-11e5-9869-f6341df67a83', 26, 'Kuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Kuser', 'Kuser', '341947104', 'Kuser@gmail.com', 'Kuser', 4, 'en', 'yangon', '70374.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:40:25', NULL, '0000-00-00 00:00:00', 0),
('fe64c10c-b44c-11e5-9869-f6341df67a83', 27, 'Luser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Luser', 'L', '03277473', 'Luser@gmail.com', 'Luser', 4, 'en', 'ygn\r\n\r\n', '6690.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:40:48', NULL, '0000-00-00 00:00:00', 0),
('105c2486-b44d-11e5-9869-f6341df67a83', 28, 'Muser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Muser', 'testing', '4975', 'Muser@gmail.com', 'Muser', 4, 'en', 'ygn', '96992.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:41:18', NULL, '0000-00-00 00:00:00', 0),
('23916afc-b44d-11e5-9869-f6341df67a83', 29, 'Nuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Nuser', 'web', '7104701741', 'Nuser@gmail.com', 'developer', 1, 'en', 'tokyo', '49298.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:41:50', NULL, '0000-00-00 00:00:00', 0),
('30be54ce-b44d-11e5-9869-f6341df67a83', 30, 'Ouser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Ousr', 'web', '4701401747', 'Ouser@gmail.com', 'testor', 4, 'en', 'japan', '71856.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:42:12', NULL, '0000-00-00 00:00:00', 0),
('581b0f9e-b44d-11e5-9869-f6341df67a83', 31, 'Puser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Puser', 'web', '307144714791', 'Puser@gmail.com', 'developer', 4, 'en', 'ygn', '15586.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:43:18', NULL, '0000-00-00 00:00:00', 0),
('6d846aba-b44d-11e5-9869-f6341df67a83', 32, 'Quser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Quser', 'web', '3741479174', 'Quser@gmail.com', 'developer', 4, 'en', 'Ygn', '67771.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:43:54', NULL, '0000-00-00 00:00:00', 0),
('81b05058-b44d-11e5-9869-f6341df67a83', 33, 'Ruser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Ruser', 'web', '73017014', 'Ruser@gmail.com', 'developer', 4, 'en', 'myanmar', '19448.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:44:28', NULL, '0000-00-00 00:00:00', 0),
('9112ec86-b44d-11e5-9869-f6341df67a83', 34, 'Suser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Suser', 'web', '383410801', 'Suser@gmail.com', 'developer', 4, 'en', 'ygn\r\n\r\nasdf', '36325.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:44:54', NULL, '0000-00-00 00:00:00', 0),
('fdd352a2-b44d-11e5-9869-f6341df67a83', 35, 'Tuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Tuser', 'web', '797252525', 'Tuser@gmail.com', 'developer', 4, 'en', 'yangon', '18455.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:47:56', NULL, '0000-00-00 00:00:00', 0),
('1cae830e-b44e-11e5-9869-f6341df67a83', 36, 'Uuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'User', 'web', '3807101502', 'User@gmail.com', 'developer', 4, 'en', 'myanmar', '65063.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:48:48', NULL, '0000-00-00 00:00:00', 0),
('2e5f063c-b44e-11e5-9869-f6341df67a83', 37, 'Vuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Vuser', 'web', '3710704714', 'Vuser@gmail.com', 'testor', 4, 'en', 'Yangon', '63067.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:49:18', NULL, '0000-00-00 00:00:00', 0),
('427e8520-b44e-11e5-9869-f6341df67a83', 38, 'Wuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Wuser', 'web', '73701740174', 'Wuserrr@gmail.com', 'testor', 4, 'en', 'ygn', '21093.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:49:52', NULL, '0000-00-00 00:00:00', 0),
('56600a50-b44e-11e5-9869-f6341df67a83', 39, 'Xuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Xuser', 'web', '707407402', 'Xuser@gmail.com', 'testor', 1, 'en', 'myanmar', '36345.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:50:25', NULL, '0000-00-00 00:00:00', 0),
('65065ea6-b44e-11e5-9869-f6341df67a83', 40, 'Yuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Yuser', 'web', '8404274502', 'Yuser@gmail.com', 'developer', 4, 'en', 'ygn\r\n\r\n', '80022.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:50:50', NULL, '0000-00-00 00:00:00', 0),
('966c79ee-b44e-11e5-9869-f6341df67a83', 41, 'Zuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Zuser', 'web', '125725702', 'Zuser@gmail.com', 'developer', 4, 'en', 'ygn', '55318.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:52:12', NULL, '0000-00-00 00:00:00', 0),
('efaec50c-b44e-11e5-9869-f6341df67a83', 42, 'AA', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'AA', 'web', '710471047414', 'AA@gmail.com', 'developere', 4, 'en', 'ygn', '40583.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:54:42', NULL, '0000-00-00 00:00:00', 0),
('0f03332a-b44f-11e5-9869-f6341df67a83', 43, 'BB', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'BB', 'web', '12244142', 'BB@gmail.com', 'developer', 1, 'en', 'ygn', '29380.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 14:55:35', NULL, '0000-00-00 00:00:00', 0),
('a05b3880-b450-11e5-9869-f6341df67a83', 44, 'CC', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'CC', 'CC', '70252525', 'Cc@c.com', 'developer', 4, 'en', 'ygn', '99054.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:06:48', NULL, '0000-00-00 00:00:00', 0),
('b9b24896-b450-11e5-9869-f6341df67a83', 45, 'DD', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'DD', 'web', '4047025', 'DD@d.com', 'develooper', 4, 'en', 'ygn', '85660.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:07:31', NULL, '0000-00-00 00:00:00', 0),
('c90c41ac-b450-11e5-9869-f6341df67a83', 46, 'EE', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123', 'web', '74017470274', 'EE@e.com', 'weber', 4, 'en', 'ygn', '15758.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:07:56', NULL, '0000-00-00 00:00:00', 0),
('d6ef7870-b450-11e5-9869-f6341df67a83', 47, 'FF', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'FF', 'web', '37474', 'FF@f.com', 'testor', 4, 'en', 'ygn', '96629.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:08:20', NULL, '0000-00-00 00:00:00', 0),
('e578083a-b450-11e5-9869-f6341df67a83', 48, 'GG', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'GG', 'GG', '704417401', 'G@g.com', 'GG', 4, 'en', 'YGN', '34875.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:08:44', NULL, '0000-00-00 00:00:00', 0),
('fa18ef7a-b450-11e5-9869-f6341df67a83', 49, 'HH', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'HH', 'HH', '7794794', 'HH@H.com', 'HH', 4, 'en', 'ygn', '13759.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:09:19', NULL, '0000-00-00 00:00:00', 0),
('061e9824-b451-11e5-9869-f6341df67a83', 50, 'II', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'II', 'II', '4730472', 'II@i.com', 'II', 4, 'en', 'ygn', '89548.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:09:39', NULL, '0000-00-00 00:00:00', 0),
('15376020-b451-11e5-9869-f6341df67a83', 51, 'JJ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'JJ', 'web', '4344535', 'JJ@jl.ccom', 'weber', 4, 'en', 'ygn', '51084.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:10:04', NULL, '0000-00-00 00:00:00', 0),
('5d7d4d18-b451-11e5-9869-f6341df67a83', 52, 'KK', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'kk', 'ss', '242', 'kk@gmail.com', 'senior developer', 4, 'en', 'gg', '25827.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:12:05', NULL, '0000-00-00 00:00:00', 0),
('93ead7b2-b451-11e5-9869-f6341df67a83', 53, 'LL', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'LL', 'web', '133399', 'aaa@gmail.com', 'senior developer', 4, 'en', 'a', '47713.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:13:37', NULL, '0000-00-00 00:00:00', 0),
('b1ebc4ce-b451-11e5-9869-f6341df67a83', 54, 'NN', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'NN', 'web', '133399', 'gnext.suzin@gmail.com', 'senior developer', 4, 'en', 'tt', '66333.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:14:27', NULL, '0000-00-00 00:00:00', 0),
('c174fc1c-b451-11e5-9869-f6341df67a83', 55, 'OO', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'OO', 'engineering', '123913', 'zinmonthet88@gmail.com', 'senior developer', 4, 'en', 'g', '86721.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:14:53', NULL, '0000-00-00 00:00:00', 0),
('d0126b92-b451-11e5-9869-f6341df67a83', 56, 'PP', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'PP', 'engineering', '133399', 'kar.yann.lay@gmail.com', 'senior developer', 4, 'en', 'adfa', '92330.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:15:18', NULL, '0000-00-00 00:00:00', 1),
('dfdfe87e-b451-11e5-9869-f6341df67a83', 57, 'QQ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'QQ', 'web', '133399', 'gnext.suzin@gmail.com', 'senior developer', 4, 'en', 'gafad\r\n\r\n', '88362.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:15:44', NULL, '0000-00-00 00:00:00', 0),
('eba9a370-b451-11e5-9869-f6341df67a83', 58, 'RR', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'RR', 'web', '123913', 'zinmonthet88@gmail.com', 'senior developer', 4, 'en', 'afa', '7737.', 0, NULL, '2016-01-01', '2018-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:16:04', NULL, '0000-00-00 00:00:00', 0),
('f72281e0-b451-11e5-9869-f6341df67a83', 59, 'SS', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'SS', 'engineering', '123913', 'gnext.suzin@gmail.com', 'senior developer', 4, 'en', 'afadsf', '86754.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:16:23', NULL, '0000-00-00 00:00:00', 1),
('042bded6-b452-11e5-9869-f6341df67a83', 60, 'TT', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TT', 'web', '133399', 'kar.yann.lay@gmail.com', 'senior developer', 4, 'en', 'afaf', '13895.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:16:45', NULL, '0000-00-00 00:00:00', 0),
('0fc9a476-b452-11e5-9869-f6341df67a83', 61, 'UU', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'UU', 'web', '133399', 'kar.yann.lay@gmail.com', 'senior developer', 4, 'en', 'afefs', '67569.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:17:04', NULL, '0000-00-00 00:00:00', 0),
('1f59189a-b452-11e5-9869-f6341df67a83', 62, 'VV', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'VV', 'web', '133399', 'chan@gmail.com', 'senior developer', 4, 'en', 'aff', '17378.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:17:31', NULL, '0000-00-00 00:00:00', 0),
('c70cf156-b452-11e5-9869-f6341df67a83', 63, 'ww', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ww', 'WEB', '73072052', 'WW@gmail.com', 'DEVELOPER', 4, 'en', 'yangon', '64846.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:22:12', NULL, '0000-00-00 00:00:00', 0),
('e12e1f7e-b452-11e5-9869-f6341df67a83', 64, 'XX', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'XX', 'web', '470750275', 'xx@gmail.com', 'developer', 4, 'en', 'yangon', '26078.', 0, NULL, '2016-01-01', '2019-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:22:56', NULL, '0000-00-00 00:00:00', 0),
('f44bca0c-b452-11e5-9869-f6341df67a83', 65, 'YY', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'YY', 'web', '7074174014', 'YY@y.com', 'developer', 4, 'en', 'sddad', '24901.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:23:28', NULL, '0000-00-00 00:00:00', 0),
('01afa768-b453-11e5-9869-f6341df67a83', 66, 'ZZ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ZZ', 'web', '7307104701', 'zz@z.com', 'developer', 4, 'en', 'ygn', '43141.', 0, NULL, '2016-01-01', '2017-01-01', NULL, '2016-01-21 13:06:03', 'admin', '2016-01-06 15:23:50', NULL, '0000-00-00 00:00:00', 0),
('e1d64996-b4f3-11e5-a438-463b57030a29', 67, 'gnext', 'c1dbb35856011d51c4d532c2b1b851dfb0d9eaa7', 'gnext', 'web', '133399', 'gnext.suzin@gmail.com', 'senior developer', 4, 'en', 'aaa', '2446.', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-21 13:06:03', 'admin', '2016-01-07 10:35:26', NULL, '0000-00-00 00:00:00', 0),
('1a35d7df-c404-11e5-befc-34689590deea', 68, 'phalcon', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'phalcon', 'phalcon', '12345677', 'phalcon@mail.com', 'testor', 4, 'en', 'yangon', '53488.jpg', 0, NULL, '2016-01-01', NULL, NULL, '2016-01-26 14:39:20', 'admin', '2016-01-26 09:09:20', NULL, '0000-00-00 00:00:00', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
