-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: core_ci
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `core_company`
--

DROP TABLE IF EXISTS `core_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_company` (
  `company_id` int NOT NULL AUTO_INCREMENT,
  `company_user_id` int DEFAULT NULL,
  `company_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `company_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `company_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `company_phone_number` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `company_logo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `company_city` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `company_state` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `company_country` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `company_bussiness_field` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `company_registration_number` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `company_npwp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`company_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_company`
--

LOCK TABLES `core_company` WRITE;
/*!40000 ALTER TABLE `core_company` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_configuration`
--

DROP TABLE IF EXISTS `core_configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_configuration` (
  `configuration_id` int NOT NULL AUTO_INCREMENT,
  `configuration_type` varchar(100) NOT NULL,
  `configuration_value_is_json` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 : false, 1 : true',
  `configuration_value` text NOT NULL,
  `configuration_administrator_id` int NOT NULL,
  PRIMARY KEY (`configuration_id`) USING BTREE,
  UNIQUE KEY `configuration_type_UNIQUE` (`configuration_type`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_configuration`
--

LOCK TABLES `core_configuration` WRITE;
/*!40000 ALTER TABLE `core_configuration` DISABLE KEYS */;
INSERT INTO `core_configuration` VALUES (1,'site','1','{\"name\":\"CRM\",\"title\":\"CRM\",\"description\":\"\",\"footer\":\"Powered By developer digital system\",\"theme\":{\"admin\":\"default\",\"member\":\"default\"}}',1),(2,'themes','1','{\"admin\":\"able\",\"login\":\"able\",\"member\":\"able\",\"public\":\"default\"}',1);
/*!40000 ALTER TABLE `core_configuration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_menu`
--

DROP TABLE IF EXISTS `core_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_menu` (
  `menu_id` int NOT NULL AUTO_INCREMENT,
  `menu_parent_menu_id` int DEFAULT '0',
  `menu_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu_slug` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `menu_url` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `menu_description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `menu_image` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `menu_class` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `menu_action` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `menu_sort` int DEFAULT NULL,
  `menu_is_active` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_menu`
--

LOCK TABLES `core_menu` WRITE;
/*!40000 ALTER TABLE `core_menu` DISABLE KEYS */;
INSERT INTO `core_menu` VALUES (1,0,'Navigasi','navigasi','#','',NULL,'fa fa-th-list','[\"show\"]',1,'1'),(2,1,'Menu Action','menu-action','admin/menu_action/show','',NULL,'fa fa-tasks','[\"show\",\"add\",\"update\",\"delete\",\"activate\",\"deactivate\"]',1,'1'),(3,1,'Menu','menu','admin/menu/show','','','fa fa-list-alt','[\\\"show\\\",\\\"add\\\",\\\"update\\\",\\\"delete\\\",\\\"activate\\\",\\\"deactivate\\\"]',2,'1');
/*!40000 ALTER TABLE `core_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_menu_action`
--

DROP TABLE IF EXISTS `core_menu_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_menu_action` (
  `menu_action_id` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_action_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `menu_action_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `menu_action_description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `menu_action_icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `menu_action_color` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`menu_action_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='data referensi penamaan action hak akses action menu';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_menu_action`
--

LOCK TABLES `core_menu_action` WRITE;
/*!40000 ALTER TABLE `core_menu_action` DISABLE KEYS */;
INSERT INTO `core_menu_action` VALUES (1,'add','Add','Menambah Modul','fa fa-plus','#6aef20'),(2,'update','Edit',NULL,'fa fa-edit','#ffba57'),(3,'delete','Delete',NULL,NULL,NULL),(4,'export','Export',NULL,NULL,NULL),(5,'activate','Activate',NULL,NULL,NULL),(6,'deactivate','Deactivate',NULL,NULL,NULL),(7,'import','Import',NULL,NULL,NULL),(8,'download','Download',NULL,NULL,NULL),(9,'update-password','Update Password','',NULL,NULL),(10,'approve','Approve','Approve',NULL,NULL),(11,'reject','Reject',NULL,NULL,NULL),(12,'cancel','Cancel',NULL,NULL,NULL),(13,'closed','Close',NULL,NULL,NULL),(14,'receive','Receipt',NULL,NULL,NULL),(15,'show','Show Data',NULL,NULL,NULL),(16,'print','Print',NULL,NULL,NULL),(17,'review','Review',NULL,NULL,NULL),(18,'reset-password','Reset Password','',NULL,NULL),(19,'verification','Verification',NULL,'fas fa-marker','#ffba57'),(20,'publish','Publish','','fas fa-marker','#ffba57'),(21,'transfer','Transfer','',NULL,NULL);
/*!40000 ALTER TABLE `core_menu_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_user_account`
--

DROP TABLE IF EXISTS `core_user_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_user_account` (
  `user_account_id` int NOT NULL AUTO_INCREMENT,
  `user_account_is_company` enum('0','1') DEFAULT '0',
  `user_account_email` varchar(50) NOT NULL,
  `user_account_password` text NOT NULL,
  `user_account_phone` bigint NOT NULL,
  `user_account_username` varchar(100) DEFAULT NULL,
  `user_account_last_login` datetime DEFAULT NULL,
  `user_account_create_by` int DEFAULT NULL,
  `user_account_create_on` datetime DEFAULT NULL,
  `user_account_token` text,
  `user_account_is_verified` enum('0','1') DEFAULT NULL,
  `user_account_status` tinyint(1) NOT NULL DEFAULT '1',
  `user_account_is_active` enum('0','1') NOT NULL DEFAULT '1',
  `user_account_last_login_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`user_account_id`) USING BTREE,
  UNIQUE KEY `user_account_email` (`user_account_email`) USING BTREE,
  UNIQUE KEY `user_account_phone` (`user_account_phone`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_user_account`
--

LOCK TABLES `core_user_account` WRITE;
/*!40000 ALTER TABLE `core_user_account` DISABLE KEYS */;
INSERT INTO `core_user_account` VALUES (84,'0','files.yadi@gmail.com','$2y$10$RMCXoZaIujIme0xkg4p2hekDOGHexPhnWYMmBUu3XsbhMRargiqSO',628500000121,'admin',NULL,NULL,'2020-10-29 16:58:56',NULL,NULL,1,'1','2020-11-01 17:55:32');
/*!40000 ALTER TABLE `core_user_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_user_group`
--

DROP TABLE IF EXISTS `core_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_user_group` (
  `user_group_id` int NOT NULL AUTO_INCREMENT,
  `user_group_name` varchar(30) NOT NULL,
  `user_group_title` varchar(30) NOT NULL,
  `user_group_description` text,
  `user_group_is_active` enum('0','1') NOT NULL,
  PRIMARY KEY (`user_group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_user_group`
--

LOCK TABLES `core_user_group` WRITE;
/*!40000 ALTER TABLE `core_user_group` DISABLE KEYS */;
INSERT INTO `core_user_group` VALUES (1,'super-admin','Super Admin','Super Admin','1'),(2,'admin','Admin','Admin','1');
/*!40000 ALTER TABLE `core_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_user_group_role`
--

DROP TABLE IF EXISTS `core_user_group_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_user_group_role` (
  `user_group_role_id` int NOT NULL AUTO_INCREMENT,
  `user_group_role_user_group_id` int NOT NULL,
  `user_group_role_menu_id` int NOT NULL,
  `user_group_role_menu_action` text,
  PRIMARY KEY (`user_group_role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_user_group_role`
--

LOCK TABLES `core_user_group_role` WRITE;
/*!40000 ALTER TABLE `core_user_group_role` DISABLE KEYS */;
INSERT INTO `core_user_group_role` VALUES (1,1,2,'[\"show\",\"add\",\"update\",\"delete\",\"activate\",\"deactivate\"]'),(2,1,3,'[\\\"show\\\",\\\"add\\\",\\\"update\\\",\\\"delete\\\",\\\"activate\\\",\\\"deactivate\\\"]');
/*!40000 ALTER TABLE `core_user_group_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_user_profile`
--

DROP TABLE IF EXISTS `core_user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_user_profile` (
  `user_profile_id` int NOT NULL,
  `user_profile_nik` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_profile_first_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_profile_last_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_profile_born_date` datetime DEFAULT NULL,
  `user_profile_born_place` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_profile_sex` enum('Pria','Wanita') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_profile_address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_profile_image` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `user_profile_country` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_profile_state` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_profile_city` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_profile_npwp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_profile_postal_code` int DEFAULT NULL,
  PRIMARY KEY (`user_profile_nik`,`user_profile_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_user_profile`
--

LOCK TABLES `core_user_profile` WRITE;
/*!40000 ALTER TABLE `core_user_profile` DISABLE KEYS */;
INSERT INTO `core_user_profile` VALUES (84,'1111',NULL,NULL,NULL,NULL,NULL,'jogja',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `core_user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_user_role`
--

DROP TABLE IF EXISTS `core_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_user_role` (
  `user_role_id` int NOT NULL AUTO_INCREMENT,
  `user_role_user_id` int DEFAULT NULL,
  `user_role_user_group_id` int DEFAULT NULL,
  PRIMARY KEY (`user_role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_user_role`
--

LOCK TABLES `core_user_role` WRITE;
/*!40000 ALTER TABLE `core_user_role` DISABLE KEYS */;
INSERT INTO `core_user_role` VALUES (87,84,1);
/*!40000 ALTER TABLE `core_user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_user_status_log`
--

DROP TABLE IF EXISTS `core_user_status_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_user_status_log` (
  `user_status_log_id` int NOT NULL AUTO_INCREMENT,
  `user_status_log_user_id` int unsigned NOT NULL,
  `user_status_log_status` tinyint(1) NOT NULL,
  `user_status_log_datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_status_log_processing_user_id` int unsigned DEFAULT NULL,
  `user_status_log_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_status_log_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=239 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_user_status_log`
--

LOCK TABLES `core_user_status_log` WRITE;
/*!40000 ALTER TABLE `core_user_status_log` DISABLE KEYS */;
INSERT INTO `core_user_status_log` VALUES (238,84,0,'2020-10-29 16:58:56',NULL,'Register akun');
/*!40000 ALTER TABLE `core_user_status_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_user_login_log`
--

DROP TABLE IF EXISTS `sys_user_login_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sys_user_login_log` (
  `user_login_log_id` int NOT NULL AUTO_INCREMENT,
  `user_login_log_user_id` int DEFAULT NULL,
  `user_login_log_last_ip` varchar(15) DEFAULT NULL,
  `user_login_log_last_datetime` datetime DEFAULT NULL,
  `user_login_log_otp` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`user_login_log_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_user_login_log`
--

LOCK TABLES `sys_user_login_log` WRITE;
/*!40000 ALTER TABLE `sys_user_login_log` DISABLE KEYS */;
INSERT INTO `sys_user_login_log` VALUES (1,84,'127.0.0.1','2020-10-31 01:06:49',NULL),(2,84,'127.0.0.1','2020-10-31 01:13:54',NULL),(3,84,'127.0.0.1','2020-10-31 01:19:51',NULL),(4,84,'127.0.0.1','2020-10-31 02:39:24',NULL),(5,84,'127.0.0.1','2020-10-31 03:00:24',NULL),(6,84,'127.0.0.1','2020-10-31 03:01:43',NULL),(7,84,'127.0.0.1','2020-10-31 03:20:32',NULL),(8,84,'127.0.0.1','2020-10-31 04:10:30',NULL),(9,84,'127.0.0.1','2020-10-31 04:28:52',NULL),(10,84,'127.0.0.1','2020-10-31 04:34:55',NULL),(11,84,'127.0.0.1','2020-10-31 04:41:50',NULL),(12,84,'127.0.0.1','2020-10-31 04:43:06',NULL),(13,84,'127.0.0.1','2020-10-31 04:44:17',NULL),(14,84,'127.0.0.1','2020-10-31 05:01:40',NULL),(15,84,'127.0.0.1','2020-10-31 05:20:22',NULL),(16,84,'127.0.0.1','2020-10-31 05:30:17',NULL),(17,84,'127.0.0.1','2020-10-31 17:32:42',NULL),(18,84,'127.0.0.1','2020-10-31 18:15:39',NULL),(19,84,'127.0.0.1','2020-10-31 18:26:28',NULL),(20,84,'127.0.0.1','2020-10-31 21:31:29',NULL),(21,84,'127.0.0.1','2020-11-01 17:55:32',NULL);
/*!40000 ALTER TABLE `sys_user_login_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tes`
--

DROP TABLE IF EXISTS `tes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tes` (
  `tes_id` int unsigned NOT NULL AUTO_INCREMENT,
  `tes_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tes_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`tes_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tes`
--

LOCK TABLES `tes` WRITE;
/*!40000 ALTER TABLE `tes` DISABLE KEYS */;
INSERT INTO `tes` VALUES (1,'anas','satu'),(2,'agung','dua'),(3,'aji','tiga');
/*!40000 ALTER TABLE `tes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-01 21:31:35
