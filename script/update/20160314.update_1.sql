ALTER TABLE `core_member` CHANGE `member_profile` `member_profile` MEDIUMBLOB NULL DEFAULT NULL;

CREATE TABLE IF NOT EXISTS `core_member_profile` (
  `member_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `member_profile` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
