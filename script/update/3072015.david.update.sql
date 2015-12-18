--
-- Table structure for table `absent`
--

CREATE TABLE IF NOT EXISTS `absent` (
  `member_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL,
  `delete_flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
