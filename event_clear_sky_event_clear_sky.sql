-- MySQL dump 10.13  Distrib 5.7.39, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: event_clear_sky
-- ------------------------------------------------------
-- Server version	5.7.39-0ubuntu0.18.04.2

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
-- Table structure for table `event_clear_sky`
--

DROP TABLE IF EXISTS `event_clear_sky`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_clear_sky` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) DEFAULT NULL,
  `email` char(200) DEFAULT NULL,
  `town` varchar(45) NOT NULL,
  `comment` char(200) DEFAULT NULL,
  `date_time` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_clear_sky`
--

LOCK TABLES `event_clear_sky` WRITE;
/*!40000 ALTER TABLE `event_clear_sky` DISABLE KEYS */;
INSERT INTO `event_clear_sky` VALUES (1,'ss','tester@gmail.com','Tallinn','aaaa','2022-08-16 20:00'),(2,'ss','tester@gmail.com','Tallinn','aaaa','2022-08-14 20:00'),(3,'ss','tester@gmail.com','Tallinn','aaaa','2022-08-14 20:00'),(4,'ss','tester@gmail.com','Tallinn','aaaa','2022-08-14 20:00'),(5,'ss','tester@gmail.com','Tallinn','aaaa','2022-08-14 20:00'),(6,'ss','tester@gmail.com','Tallinn','aaaa','2022-08-16 20:00'),(7,'ss','tester@gmail.com','Tallinn','aaaa','2022-08-14 20:00'),(8,'ss','tester@gmail.com','Tallinn','aaaa','2022-08-14 20:00'),(9,'ss','tester@gmail.com','Tallinn','aaaa','2022-08-10 20:00'),(10,'ss','tester@gmail.com','Tallinn','aaaa','2022-08-10 20:00'),(11,'ss','tester@gmail.com','Tallinn','aaaa','2022-08-10 20:00'),(12,'ss','tester@gmail.com','Tallinn','aaaa','2022-08-10 20:00'),(13,'','','','','');
/*!40000 ALTER TABLE `event_clear_sky` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-16  8:12:35
