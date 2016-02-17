-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2016 at 09:06 AM
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
  `creator_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_flag` tinyint(1) NOT NULL DEFAULT '0',
  `print_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salary_detail`
--

INSERT INTO `salary_detail` (`id`, `member_id`, `basic_salary`, `basic_salary_annual`, `travel_fee`, `overtime`, `allowance_amount`, `special_allowance`, `ssc_comp`, `ssc_emp`, `absent_dedution`, `income_tax`, `total_annual_income`, `basic_examption`, `pay_date`, `resign_date`, `creator_id`, `created_dt`, `updater_id`, `updated_dt`, `deleted_flag`, `print_id`) VALUES
('052dadcc-9694-11e5-afdd-cbdbeb0557a4', 'admin', 500000, 4000000, 10000, 0, 13000, NULL, 9000, 6000, 0, 1340, 11800, 821000, '2015-10-30 00:00:00', NULL, 'admin', '2015-11-29 18:53:39', NULL, NULL, 0, 0),
('052ddcf2-9694-11e5-afdd-cbdbeb0557a4', '1455f388-91b5-11e5-ba6c-b3c9d3c668b5', 600000, 4800000, 15000, 0, 25000, NULL, 6000, 4000, 0, 5950, 47600, 1000000, '2015-10-30 00:00:00', NULL, 'admin', '2015-11-29 18:53:39', NULL, NULL, 0, 0),
('052df962-9694-11e5-afdd-cbdbeb0557a4', '25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', 450000, 3600000, 20000, 0, 20000, NULL, 9000, 6000, 0, 0, 0, 752000, '2015-10-30 00:00:00', NULL, 'admin', '2015-11-29 18:53:39', NULL, NULL, 0, 0),
('0cc259ae-9692-11e5-afdd-cbdbeb0557a4', 'admin', 500000, 4000000, 10000, 15000, 0, NULL, 9000, 6000, 0, 1475, 11800, 821000, '2015-09-30 00:00:00', NULL, 'admin', '2015-11-29 18:39:32', NULL, NULL, 0, 0),
('0cc2a882-9692-11e5-afdd-cbdbeb0557a4', '1455f388-91b5-11e5-ba6c-b3c9d3c668b5', 600000, 4800000, 15000, 0, 25000, NULL, 6000, 4000, 0, 5950, 47600, 1000000, '2015-09-30 00:00:00', NULL, 'admin', '2015-11-29 18:39:32', NULL, NULL, 0, 0),
('0cc2bd9a-9692-11e5-afdd-cbdbeb0557a4', '25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', 450000, 3600000, 20000, 0, 20000, NULL, 9000, 6000, 0, 0, 0, 752000, '2015-09-30 00:00:00', NULL, 'admin', '2015-11-29 18:39:32', NULL, NULL, 0, 1),
('17b0a64a-9205-11e5-8213-2f3ca2776dbb', 'admin', 500000, 4000000, 10000, 0, 0, NULL, 9000, 6000, 0, 1950, 15600, 840000, '2015-08-31 00:00:00', NULL, 'admin', '2015-11-23 23:40:27', NULL, NULL, 0, 0),
('17b0b8d8-9205-11e5-8213-2f3ca2776dbb', '1455f388-91b5-11e5-ba6c-b3c9d3c668b5', 600000, 4800000, 15000, 0, 25000, NULL, 6000, 4000, 0, 5950, 47600, 1000000, '2015-08-31 00:00:00', NULL, 'admin', '2015-11-23 23:40:27', NULL, NULL, 0, 0),
('17b0c684-9205-11e5-8213-2f3ca2776dbb', '25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', 450000, 3600000, 20000, 0, 20000, NULL, 9000, 6000, 0, 0, 0, 752000, '2015-08-31 00:00:00', NULL, 'admin', '2015-11-23 23:40:27', NULL, NULL, 0, 0),
('c5425964-b908-11e5-b73a-52bec395a166', '01afa768-b453-11e5-9869-f6341df67a83', 300000, 900000, 20000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 183000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c542a28e-b908-11e5-b73a-52bec395a166', '042bded6-b452-11e5-9869-f6341df67a83', 300000, 900000, 20000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 183000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c542b468-b908-11e5-b73a-52bec395a166', '061e9824-b451-11e5-9869-f6341df67a83', 300000, 900000, 30000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 183000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 1),
('c542ca16-b908-11e5-b73a-52bec395a166', '0f03332a-b44f-11e5-9869-f6341df67a83', 650000, 1950000, 20000, 0, 0, 0, 9000, 6000, 0, 0, 0, 408000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 1),
('c542d736-b908-11e5-b73a-52bec395a166', '0fc9a476-b452-11e5-9869-f6341df67a83', 300000, 900000, 10000, 0, 25000, NULL, 9000, 6000, 0, 0, 0, 195000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 1),
('c542f48c-b908-11e5-b73a-52bec395a166', '15376020-b451-11e5-9869-f6341df67a83', 300000, 900000, 10000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 183000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 1),
('c54303be-b908-11e5-b73a-52bec395a166', '1f59189a-b452-11e5-9869-f6341df67a83', 300000, 900000, 15000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 183000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 1),
('c543111a-b908-11e5-b73a-52bec395a166', '25d2588f-3fd2-11e5-9c70-9c4fb7a929cf', 450000, 1350000, 20000, 0, 20000, NULL, 9000, 6000, 0, 0, 0, 282000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 1),
('c5431e58-b908-11e5-b73a-52bec395a166', '5d7d4d18-b451-11e5-9869-f6341df67a83', 300000, 900000, 15000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 183000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 1),
('c5432bf0-b908-11e5-b73a-52bec395a166', '93ead7b2-b451-11e5-9869-f6341df67a83', 300000, 900000, 15000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 183000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 1),
('c54338f2-b908-11e5-b73a-52bec395a166', 'a05b3880-b450-11e5-9869-f6341df67a83', 2000000, 6000000, 20000, 0, 20000, NULL, 9000, 6000, 0, 30500, 91500, 1212000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c543461c-b908-11e5-b73a-52bec395a166', 'admin', 500000, 1500000, 30000, 1400, 10000, NULL, 9000, 6000, 0, 0, 0, 306840, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c5435364-b908-11e5-b73a-52bec395a166', 'b1ebc4ce-b451-11e5-9869-f6341df67a83', 300000, 900000, 10000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 183000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c5436070-b908-11e5-b73a-52bec395a166', 'b9b24896-b450-11e5-9869-f6341df67a83', 650000, 1950000, 20000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 393000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c5436db8-b908-11e5-b73a-52bec395a166', 'c174fc1c-b451-11e5-9869-f6341df67a83', 50000, 150000, 222, 0, 5000, NULL, 1500, 1000, 0, 0, 0, 33000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c5437a9c-b908-11e5-b73a-52bec395a166', 'c70cf156-b452-11e5-9869-f6341df67a83', 300000, 900000, 15000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 183000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c543955e-b908-11e5-b73a-52bec395a166', 'd0126b92-b451-11e5-9869-f6341df67a83', 6000000, 18000000, 40000, 0, 25000, NULL, 9000, 6000, 0, 288767, 866300, 3615000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c543a274-b908-11e5-b73a-52bec395a166', 'dfdfe87e-b451-11e5-9869-f6341df67a83', 2000000, 6000000, 20000, 0, 5000, NULL, 9000, 6000, 0, 29900, 89700, 1203000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c543b020-b908-11e5-b73a-52bec395a166', 'e12e1f7e-b452-11e5-9869-f6341df67a83', 300000, 900000, 20000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 183000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c543bd04-b908-11e5-b73a-52bec395a166', 'e578083a-b450-11e5-9869-f6341df67a83', 650000, 1950000, 15000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 393000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c543ca4c-b908-11e5-b73a-52bec395a166', 'eba9a370-b451-11e5-9869-f6341df67a83', 650000, 1950000, 10000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 393000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c543d74e-b908-11e5-b73a-52bec395a166', 'efaec50c-b44e-11e5-9869-f6341df67a83', 300000, 900000, 30000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 183000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c543e428-b908-11e5-b73a-52bec395a166', 'f44bca0c-b452-11e5-9869-f6341df67a83', 300000, 900000, 20000, 0, 5000, NULL, 9000, 6000, 0, 0, 0, 183000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c543f0f8-b908-11e5-b73a-52bec395a166', 'f72281e0-b451-11e5-9869-f6341df67a83', 300000, 900000, 20000, 0, 25000, NULL, 9000, 6000, 0, 0, 0, 195000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0),
('c543fe18-b908-11e5-b73a-52bec395a166', 'fa18ef7a-b450-11e5-9869-f6341df67a83', 200000, 600000, 15000, 0, 5000, NULL, 6000, 4000, 0, 0, 0, 123000, '2016-01-29 00:00:00', NULL, 'admin', '2016-01-12 15:15:02', NULL, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `salary_detail`
--
ALTER TABLE `salary_detail`
 ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
