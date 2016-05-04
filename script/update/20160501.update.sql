CREATE TABLE IF NOT EXISTS `core_member_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `member_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mac` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ipv6` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`token`),
  UNIQUE KEY `log_id` (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

DROP TABLE member_log