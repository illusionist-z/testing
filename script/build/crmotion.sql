-- phpMyAdmin SQL Dump
-- version 4.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014 年 6 月 16 日 23:48
-- サーバのバージョン： 5.6.19
-- PHP Version: 5.5.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phalcon`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `core_user`
--

CREATE TABLE IF NOT EXISTS `core_user` (
  `id` varchar(36) NOT NULL DEFAULT '' COMMENT 'uuid',
  `login_name` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `kana` varchar(128) DEFAULT NULL,
  `dept_code` varchar(32) DEFAULT NULL,
  `dept_name` varchar(64) DEFAULT NULL,
  `telphone` varchar(16) DEFAULT NULL,
  `cellular_phone` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `extension_number` varchar(16) DEFAULT NULL,
  `memo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `lang` varchar(3) NOT NULL DEFAULT 'ja',
  `email01` varchar(256) DEFAULT NULL,
  `email02` varchar(256) DEFAULT NULL,
  `insert_dt` datetime DEFAULT NULL,
  `insert_uuid` varchar(36) DEFAULT NULL,
  `update_dt` datetime DEFAULT NULL,
  `update_uuid` varchar(36) DEFAULT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `rank_code` tinyint(4) DEFAULT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `core_user`
--
ALTER TABLE `core_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `member_login_name` (`login_name`), ADD UNIQUE KEY `uuid` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
