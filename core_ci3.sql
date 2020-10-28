CREATE DATABASE  IF NOT EXISTS `core_ci` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `core_ci`;
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

-- Dump completed on 2020-10-28 19:40:41
