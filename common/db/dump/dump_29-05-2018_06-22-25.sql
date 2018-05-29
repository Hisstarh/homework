-- MySQL dump 10.13  Distrib 5.7.20, for Win64 (x86_64)
--
-- Host: localhost    Database: yii2advanced
-- ------------------------------------------------------
-- Server version	5.7.20-log

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
-- Table structure for table `my_articles`
--

DROP TABLE IF EXISTS `my_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sell_price` decimal(10,0) NOT NULL,
  `purchase_price` decimal(10,0) NOT NULL,
  `margin` decimal(10,0) DEFAULT NULL,
  `mark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `drive` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `left` tinyint(1) DEFAULT '0',
  `front` tinyint(1) DEFAULT '0',
  `top` tinyint(1) DEFAULT '0',
  `code_manufacturer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `optics` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delevery_id` int(11) NOT NULL DEFAULT '1',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `sit_id` int(11) NOT NULL DEFAULT '1',
  `update_user` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `right` tinyint(1) DEFAULT '0',
  `rear` tinyint(1) DEFAULT '0',
  `bottom` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `FK_articles_sit` (`sit_id`),
  KEY `FK_articles_user` (`update_user`),
  KEY `my_articles_my_delevery_id_fk` (`delevery_id`),
  CONSTRAINT `my_articles_my_delevery_id_fk` FOREIGN KEY (`delevery_id`) REFERENCES `my_delevery` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_articles`
--

/*!40000 ALTER TABLE `my_articles` DISABLE KEYS */;
INSERT INTO `my_articles` VALUES (1,'запчасть 1',1234567,'1212',3,4,1,'1','1','1','1','1',1,1,0,'1','1',1,10,1,16,1,1,0,0,0);
/*!40000 ALTER TABLE `my_articles` ENABLE KEYS */;

--
-- Table structure for table `my_delevery`
--

DROP TABLE IF EXISTS `my_delevery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_delevery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delevery` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `delevery_date` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `sit_id` int(11) NOT NULL DEFAULT '1',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `delevery` (`delevery`),
  KEY `FK_delevery_sit` (`sit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_delevery`
--

/*!40000 ALTER TABLE `my_delevery` DISABLE KEYS */;
INSERT INTO `my_delevery` VALUES (1,'2','admin',23123,'test',1,10,1,1);
/*!40000 ALTER TABLE `my_delevery` ENABLE KEYS */;

--
-- Table structure for table `my_migration`
--

DROP TABLE IF EXISTS `my_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_migration`
--

/*!40000 ALTER TABLE `my_migration` DISABLE KEYS */;
INSERT INTO `my_migration` VALUES ('m000000_000000_base',1526354593),('m130524_201442_init',1526354598),('m130524_201445_create_base',1526354599);
/*!40000 ALTER TABLE `my_migration` ENABLE KEYS */;

--
-- Table structure for table `my_priceform`
--

DROP TABLE IF EXISTS `my_priceform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_priceform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seller` smallint(6) DEFAULT NULL,
  `owner` smallint(6) DEFAULT NULL,
  `fond` smallint(6) DEFAULT NULL,
  `programmer` smallint(6) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_priceform`
--

/*!40000 ALTER TABLE `my_priceform` DISABLE KEYS */;
INSERT INTO `my_priceform` VALUES (1,'ФОНД',0,0,100,0,1,1),(2,'основная\r\n',20,20,50,10,2,2),(3,'Владелец',100,0,0,0,3,3);
/*!40000 ALTER TABLE `my_priceform` ENABLE KEYS */;

--
-- Table structure for table `my_role`
--

DROP TABLE IF EXISTS `my_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_role`
--

/*!40000 ALTER TABLE `my_role` DISABLE KEYS */;
INSERT INTO `my_role` VALUES (1,'Admin_global\r\n'),(2,'Admin'),(3,'Owner_global'),(4,'Owner_sit'),(5,'Saller'),(6,'User');
/*!40000 ALTER TABLE `my_role` ENABLE KEYS */;

--
-- Table structure for table `my_sit`
--

DROP TABLE IF EXISTS `my_sit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_sit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `margin_on_sit` smallint(6) DEFAULT NULL,
  `priceform_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sit_priceform` (`priceform_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_sit`
--

/*!40000 ALTER TABLE `my_sit` DISABLE KEYS */;
INSERT INTO `my_sit` VALUES (1,'Общий','0','СИТ',NULL,2,1,1);
/*!40000 ALTER TABLE `my_sit` ENABLE KEYS */;

--
-- Table structure for table `my_user`
--

DROP TABLE IF EXISTS `my_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sit_id` int(11) NOT NULL DEFAULT '1',
  `role_id` int(11) NOT NULL DEFAULT '1',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `FK_user_role` (`role_id`),
  KEY `FK_user_sit` (`sit_id`),
  CONSTRAINT `my_user_my_sit_id_fk` FOREIGN KEY (`sit_id`) REFERENCES `my_sit` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_user`
--

/*!40000 ALTER TABLE `my_user` DISABLE KEYS */;
INSERT INTO `my_user` VALUES (15,'user','DkwOFEahJ0MYRU9V5HJb3OaHaFeq7wcj','$2y$13$cW./fZ1YvY6OvxbjF8F.pepbpOPGJO0pKa6OwCL/0n7YAfeCT8FnC',NULL,'user@gmail.com',1,6,10,1526438950,1526438950),(16,'admin','B7zneOTEtcjvwyPwn82tK40ReBDGYbZv','$2y$13$1uAUg74aLl73pdPLj/rK2u6CfNGJ4ORwBbS4QIcFxRTjo2jT313xG',NULL,'hisstarh@gmail.com',1,1,10,1526439204,1526439204);
/*!40000 ALTER TABLE `my_user` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-29 10:22:25
