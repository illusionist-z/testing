ALTER TABLE `attendances` CHANGE `checkin_time` `checkin_time` DATETIME NULL;

ALTER TABLE `attendances` CHANGE `noti_id` `noti_id` VARCHAR(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL;