DELETE FROM `core_permission` WHERE `module_id`='calendar'
ALTER TABLE `core_member` CHANGE `member_id` `member_id` VARCHAR(36) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'uuid';

update`core_member` set `bank_acc`='99930709801257101' WHERE `member_mail`='ninimyint@gmail.com'