-- MySQL dump 10.13  Distrib 5.6.19, for osx10.9 (x86_64)
--
-- Host: localhost    Database: crm_phalcon
-- ------------------------------------------------------
-- Server version	5.6.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth_failed_logins`
--

DROP TABLE IF EXISTS `auth_failed_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_failed_logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_uuid` varchar(36) DEFAULT NULL,
  `ip_address` char(15) NOT NULL,
  `attempted` int(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usersId` (`user_uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_failed_logins`
--

LOCK TABLES `auth_failed_logins` WRITE;
/*!40000 ALTER TABLE `auth_failed_logins` DISABLE KEYS */;
INSERT INTO `auth_failed_logins` VALUES (1,'admin','127.0.0.1',1403186652),(2,'0','127.0.0.1',1403223764),(3,'admin','127.0.0.1',1403226405),(4,'0','127.0.0.1',1403229040),(5,'admin','127.0.0.1',1403229098),(6,'admin','127.0.0.1',1403230678),(7,'admin2','127.0.0.1',1403232551),(8,'admin2','127.0.0.1',1403232642),(9,'admin2','127.0.0.1',1403233566),(10,'admin','127.0.0.1',1403235526),(11,'0','127.0.0.1',1403264811),(12,'admin','127.0.0.1',1403267931),(13,'0','127.0.0.1',1403333224),(14,'0','127.0.0.1',1403333226),(15,'0','127.0.0.1',1403333259),(16,'0','127.0.0.1',1403335840),(17,'0','127.0.0.1',1403335842),(18,'0','127.0.0.1',1403335846),(19,'0','127.0.0.1',1403335850),(20,'0','127.0.0.1',1403335854),(21,'0','127.0.0.1',1403335858),(22,'0','127.0.0.1',1403335862),(23,'0','127.0.0.1',1403335866),(24,'0','127.0.0.1',1403335870),(25,'0','127.0.0.1',1403335874),(26,'0','127.0.0.1',1403335879),(27,'0','127.0.0.1',1403335883),(28,'0','127.0.0.1',1403335887),(29,'0','127.0.0.1',1403335891),(30,'0','127.0.0.1',1403335895),(31,'0','127.0.0.1',1403335899),(32,'0','127.0.0.1',1403335903),(33,'0','127.0.0.1',1403335907),(34,'0','127.0.0.1',1403335911),(35,'0','127.0.0.1',1403335915),(36,'0','127.0.0.1',1403335919),(37,'0','127.0.0.1',1403335923),(38,'0','127.0.0.1',1403335927),(39,'0','127.0.0.1',1403335931),(40,'0','127.0.0.1',1403335935),(41,'0','127.0.0.1',1403335939),(42,'0','127.0.0.1',1403335943),(43,'0','127.0.0.1',1403335947),(44,'0','127.0.0.1',1403335951),(45,'0','127.0.0.1',1403335955),(46,'0','127.0.0.1',1403335959),(47,'0','127.0.0.1',1403335963),(48,'0','127.0.0.1',1403335967),(49,'0','127.0.0.1',1403335971),(50,'0','127.0.0.1',1403335975),(51,'0','127.0.0.1',1403335979),(52,'0','127.0.0.1',1403335983),(53,'0','127.0.0.1',1403335987),(54,'0','127.0.0.1',1403335991),(55,'0','127.0.0.1',1403335995),(56,'0','127.0.0.1',1403335999),(57,'0','127.0.0.1',1403336003),(58,'0','127.0.0.1',1403336007),(59,'0','127.0.0.1',1403339206),(60,'admin','127.0.0.1',1403339708),(61,'0','127.0.0.1',1403339735),(62,'0','127.0.0.1',1403340757),(63,'0','127.0.0.1',1403340770),(64,'0','127.0.0.1',1403340785),(65,'0','127.0.0.1',1403340789),(66,'admin','127.0.0.1',1403341033),(67,'0','127.0.0.1',1403343319),(68,'0','127.0.0.1',1403343329),(69,'0','127.0.0.1',1403343346),(70,'0','127.0.0.1',1403343354),(71,'admin','127.0.0.1',1403343363),(72,'admin','127.0.0.1',1403344802),(73,'admin','127.0.0.1',1403351577),(74,'admin','127.0.0.1',1403351602),(75,'admin','127.0.0.1',1403351655),(76,'admin','127.0.0.1',1403351795),(77,'admin','127.0.0.1',1403351829),(78,'admin','127.0.0.1',1403351871),(79,'admin','127.0.0.1',1403352101),(80,'admin','127.0.0.1',1403352257),(81,'admin','127.0.0.1',1403352291),(82,'admin','127.0.0.1',1403352333),(83,'admin','127.0.0.1',1403353135),(84,'0','127.0.0.1',1403353175),(85,'0','127.0.0.1',1403353374),(86,'0','127.0.0.1',1403353382),(87,'admin','127.0.0.1',1403353480),(88,'0','127.0.0.1',1403357541),(89,'0','127.0.0.1',1403357560),(90,'0','127.0.0.1',1403357564),(91,'admin','127.0.0.1',1403358811),(92,'admin','127.0.0.1',1403360362),(93,'admin','127.0.0.1',1404208216);
/*!40000 ALTER TABLE `auth_failed_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_apps`
--

DROP TABLE IF EXISTS `core_apps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_apps` (
  `code` varchar(32) NOT NULL,
  `category` tinyint(1) DEFAULT NULL,
  `version` varchar(16) DEFAULT NULL,
  `module_dt_updt` datetime DEFAULT NULL,
  `module_t_detail` text,
  `module_t_type` text,
  `module_i_order` int(10) DEFAULT NULL,
  `module_i_del_flg` int(1) DEFAULT '0',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_apps`
--

LOCK TABLES `core_apps` WRITE;
/*!40000 ALTER TABLE `core_apps` DISABLE KEYS */;
INSERT INTO `core_apps` VALUES ('master',2,'1','2013-06-25 13:27:38','管理（メンテ）','core',2,0),('user',1,'1','2012-02-16 17:17:39','ユーザー','core',2,0);
/*!40000 ALTER TABLE `core_apps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_lock_record`
--

DROP TABLE IF EXISTS `core_lock_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_lock_record` (
  `uuid` varchar(64) NOT NULL COMMENT 'UUID',
  `user_id` varchar(36) NOT NULL COMMENT 'member id',
  `user_name` varchar(64) NOT NULL,
  `expire_dt` datetime NOT NULL COMMENT 'ロック開始時間',
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_lock_record`
--

LOCK TABLES `core_lock_record` WRITE;
/*!40000 ALTER TABLE `core_lock_record` DISABLE KEYS */;
INSERT INTO `core_lock_record` VALUES ('27a62102-f566-11e3-a3c9-42f40021a5dz','Administrator','Administrator','2014-09-03 23:21:39'),('65b46fac-fba7-11e3-a3c9-42f40021a5db','Administrator','Administrator','2014-09-05 14:19:25'),('Administrator','Administrator','Administrator','2014-09-05 12:10:51'),('e6592806-fa02-11e3-a3c9-42f40021a5db','Administrator','Administrator','2014-09-05 14:19:30');
/*!40000 ALTER TABLE `core_lock_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dept`
--

DROP TABLE IF EXISTS `dept`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dept` (
  `dept_code` varchar(36) NOT NULL DEFAULT '',
  `dept_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `abbreviated_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '略称',
  `parent_dept_code` varchar(36) DEFAULT NULL,
  `level` tinyint(3) unsigned DEFAULT NULL,
  `dept_order` int(11) unsigned DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `delete_flag` tinyint(1) DEFAULT '0',
  `creator_id` varchar(36) DEFAULT NULL,
  `creator_name` varchar(64) DEFAULT NULL,
  `updater_id` varchar(36) DEFAULT NULL,
  `updater_name` varchar(64) DEFAULT NULL,
  `dept_type` tinyint(4) DEFAULT NULL COMMENT '1: deptrn2: teamrn3: group',
  PRIMARY KEY (`dept_code`),
  KEY `idx_dept_code` (`dept_code`),
  KEY `idx_dept_parent_dept_code` (`parent_dept_code`),
  KEY `idx_dept_level` (`level`),
  KEY `idx_dept_is_deleted` (`delete_flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dept`
--

LOCK TABLES `dept` WRITE;
/*!40000 ALTER TABLE `dept` DISABLE KEYS */;
INSERT INTO `dept` VALUES ('GUEST','Guest','Guest',NULL,1,999999998,'2013-06-27 13:40:38',NULL,0,'admin','Administrator',NULL,NULL,1),('NON_DEPT','部署未設定','部署未設定',NULL,1,999999999,NULL,NULL,0,'admin','Administrator',NULL,NULL,NULL);
/*!40000 ALTER TABLE `dept` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `permission_code` varchar(32) NOT NULL,
  `module_name` varchar(32) NOT NULL DEFAULT '',
  `name` varchar(64) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`permission_code`,`module_name`),
  KEY `idx_permission_code` (`permission_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES ('add_member','user','ユーザの追加',NULL),('change_password','user','パスワードの変更',NULL),('del_member','user','ユーザの削除',NULL),('edit_member','user','ユーザの編集',NULL),('edit_team','user','チームの編集',NULL),('setting_dept','user','部署の設定',NULL),('show_menu','adminmaintain','メンテモジュール表示',''),('show_menu','user','ユーザアプリ表示',NULL);
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_group`
--

DROP TABLE IF EXISTS `permission_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_group` (
  `group_code` varchar(36) NOT NULL DEFAULT '',
  `name` varchar(32) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `creator_id` varchar(36) NOT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `updater_id` varchar(36) DEFAULT NULL,
  `delete_flag` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`group_code`),
  KEY `idx_permission_group_is_deleted` (`delete_flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_group`
--

LOCK TABLES `permission_group` WRITE;
/*!40000 ALTER TABLE `permission_group` DISABLE KEYS */;
INSERT INTO `permission_group` VALUES ('ADMIN','Administrator','2013-08-19 12:25:49','999','2013-09-11 09:42:23','1',0);
/*!40000 ALTER TABLE `permission_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_rel_group`
--

DROP TABLE IF EXISTS `permission_rel_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_rel_group` (
  `uuid` varchar(36) NOT NULL DEFAULT '0',
  `permission_code` varchar(32) DEFAULT NULL,
  `permission_group_code` varchar(36) NOT NULL,
  `permission_module` varchar(32) DEFAULT NULL,
  `permission_group_link_order` int(8) DEFAULT NULL,
  PRIMARY KEY (`uuid`,`permission_group_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_rel_group`
--

LOCK TABLES `permission_rel_group` WRITE;
/*!40000 ALTER TABLE `permission_rel_group` DISABLE KEYS */;
INSERT INTO `permission_rel_group` VALUES ('1','show_menu','ADMIN','user',1),('2','show_menu','ADMIN','adminmaintain',2),('3','edit_team','ADMIN','user',2),('4','add_member','ADMIN','user',3),('5','edit_member','ADMIN','user',4),('6','del_member','ADMIN','user',5),('7','change_password','ADMIN','user',6),('8','setting_dept','ADMIN','user',7);
/*!40000 ALTER TABLE `permission_rel_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pjman_request`
--

DROP TABLE IF EXISTS `pjman_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pjman_request` (
  `uuid` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `company_code` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `project_code` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `request_date` date NOT NULL,
  `propounder` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '提起者',
  `request` text COLLATE utf8_unicode_ci COMMENT '要望内容',
  `note` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '備考',
  `request_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '要望の種類',
  `priority` tinyint(1) unsigned NOT NULL COMMENT '優先度',
  `plan_man_hour` decimal(4,3) DEFAULT NULL COMMENT '人費(予定)',
  `category` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'カテゴリ',
  `status` char(3) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ステータス',
  `plan_date` date DEFAULT NULL COMMENT '対応予定日',
  `fixed_date` date DEFAULT NULL COMMENT '対応完了日',
  `todo_uuid` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `ct_cd` varchar(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '作成者コード',
  `ct_dt` datetime NOT NULL COMMENT '作成日時',
  `up_cd` varchar(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '作成者コード',
  `up_dt` datetime NOT NULL COMMENT '更新日時',
  `del_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '削除フラグ',
  PRIMARY KEY (`uuid`),
  KEY `company_code` (`company_code`,`project_code`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pjman_request`
--

LOCK TABLES `pjman_request` WRITE;
/*!40000 ALTER TABLE `pjman_request` DISABLE KEYS */;
INSERT INTO `pjman_request` VALUES ('1b3690a4-34d7-11e4-95fd-2b4aefd045e9','PanaEs','4','2014-06-19',NULL,'ステータスを一度に変更したい',NULL,'',4,NULL,'業務処理','',NULL,NULL,'','','2014-09-05 00:00:00','','2014-09-05 00:00:00',0);
/*!40000 ALTER TABLE `pjman_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` varchar(36) NOT NULL DEFAULT '' COMMENT 'uuid',
  `account` varchar(255) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `kana` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_string` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'ソート対象',
  `dept_code` varchar(32) DEFAULT NULL,
  `dept_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telphone` varchar(16) DEFAULT NULL,
  `cellular_phone` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `extension_number` varchar(16) DEFAULT NULL,
  `memo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `lang` varchar(3) NOT NULL DEFAULT 'ja',
  `email01` varchar(256) DEFAULT NULL,
  `email02` varchar(256) DEFAULT NULL,
  `search` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_dt` datetime DEFAULT NULL,
  `creator_id` varchar(36) DEFAULT NULL,
  `update_dt` datetime DEFAULT NULL,
  `update_id` varchar(36) DEFAULT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `rank_code` tinyint(4) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_login_name` (`account`),
  UNIQUE KEY `uuid` (`id`),
  KEY `order_string` (`order_string`),
  FULLTEXT KEY `search` (`search`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('0397a2e0-f9da-11e3-a3c9-42f40021a5db','test02','','削除ユーザ','テスト','テスト','NON_DEPT','部署未設定',NULL,NULL,NULL,NULL,NULL,'ja',NULL,NULL,'','2014-06-22 00:00:00',NULL,'2014-06-22 00:00:00','16:05:36',1,NULL,NULL),('27a62102-f566-11e3-a3c9-42f40021a5dz','admin2','$2y$10$yP4FQaWURMFlSFTJdTI2VuMK1vxoyD1.3V9GdKz50U2RvIh99LvWS','Administrator2','アドミニストレーター','アドミニストレーター','NON_DEPT','部署未設定',NULL,NULL,NULL,NULL,'管理者\r\nadministrator\r\n','ja',NULL,NULL,'','2014-06-16 00:00:00',NULL,NULL,NULL,0,NULL,NULL),('2c4c06a4-f9da-11e3-a3c9-42f40021a5db','test03','','テスト ユーザ','テスト','テスト','NON_DEPT','部署未設定',NULL,NULL,NULL,NULL,NULL,'ja',NULL,NULL,'',NULL,NULL,NULL,NULL,0,NULL,NULL),('65b46fac-fba7-11e3-a3c9-42f40021a5db','english_user01','$2y$10$yP4FQaWURMFlSFTJdTI2VuMK1vxoyD1.3V9GdKz50U2RvIh99LvWS','English User','','EnglishUser','NON_DEPT','部署未設定',NULL,NULL,NULL,NULL,'管理者\r\nadministrator\r\n','en',NULL,NULL,'','2014-06-16 00:00:00',NULL,NULL,NULL,0,NULL,NULL),('8b8d9fe8-f9e3-11e3-a3c9-42f40021a5db','test04','','1ヶ月前削除ユーザ','テスト','テスト','NON_DEPT','部署未設定',NULL,NULL,NULL,NULL,NULL,'ja',NULL,NULL,'','2014-06-22 00:00:00',NULL,'2014-06-22 00:00:00','16:05:36',1,NULL,NULL),('Administrator','admin','$2y$10$yP4FQaWURMFlSFTJdTI2VuMK1vxoyD1.3V9GdKz50U2RvIh99LvWS','Administrator','アドミニストレーター','Administrator','NON_DEPT','部署未設定',NULL,NULL,NULL,NULL,'管理者\r\nadministrator\r\n','ja',NULL,NULL,'','2014-06-16 00:00:00',NULL,NULL,NULL,0,NULL,NULL),('e3e49c38-fae1-11e3-a3c9-42f40021a5db','test010','','高杉晋作',NULL,'タカスギシンサク','NON_DEPT','部署未設定','0300000000',NULL,NULL,NULL,NULL,'ja','test@gnext.co.jp',NULL,'',NULL,NULL,NULL,NULL,0,NULL,NULL),('e65114fa-0271-11e4-a788-3c9c5e01e98f','guest_user01','','ゲストユーザ 01','ゲストユーザ','ゲストユーザ','GUEST','ゲスト',NULL,NULL,NULL,NULL,NULL,'ja',NULL,NULL,'',NULL,NULL,NULL,NULL,0,NULL,NULL),('e6592806-fa02-11e3-a3c9-42f40021a5db','test009','','坂本竜太','サカモトリョウタ','サカモトリョウタ','NON_DEPT','部署未設定','0300000000',NULL,NULL,NULL,NULL,'ja','test@gnext.co.jp',NULL,'',NULL,NULL,NULL,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_rel_permission_group`
--

DROP TABLE IF EXISTS `users_rel_permission_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_rel_permission_group` (
  `user_id` varchar(36) NOT NULL,
  `group_code` varchar(36) NOT NULL,
  PRIMARY KEY (`user_id`,`group_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_rel_permission_group`
--

LOCK TABLES `users_rel_permission_group` WRITE;
/*!40000 ALTER TABLE `users_rel_permission_group` DISABLE KEYS */;
INSERT INTO `users_rel_permission_group` VALUES ('Administrator','ADMIN');
/*!40000 ALTER TABLE `users_rel_permission_group` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-05 18:46:36
