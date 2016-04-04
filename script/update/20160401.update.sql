ALTER TABLE `core_module` ADD `id` VARCHAR(36) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL FIRST;

UPDATE core_module SET id=uuid();

ALTER TABLE `core_module` ADD `created_dt` DATETIME NOT NULL AFTER `module_id`;