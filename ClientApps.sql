-- MariaDB dump 10.19  Distrib 10.6.4-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: ClientApps
-- ------------------------------------------------------
-- Server version	10.6.4-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chart_x`
--

DROP TABLE IF EXISTS `chart_x`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chart_x` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chart_x`
--

LOCK TABLES `chart_x` WRITE;
/*!40000 ALTER TABLE `chart_x` DISABLE KEYS */;
INSERT INTO `chart_x` VALUES (1,36.2),(2,36.35),(3,36.28),(4,NULL),(5,36.4),(6,36.39),(7,36.4),(8,36.27),(9,36.4),(10,36.33),(11,36.7),(12,36.71),(13,-1),(14,36.61),(15,36.62),(16,36.78),(17,-1),(18,36.78),(19,36.79),(20,36.7),(21,37),(22,-1),(23,36.7),(24,36.61),(25,36.63),(26,36.7),(27,-1),(28,-1);
/*!40000 ALTER TABLE `chart_x` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chart_y`
--

DROP TABLE IF EXISTS `chart_y`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chart_y` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chart_y`
--

LOCK TABLES `chart_y` WRITE;
/*!40000 ALTER TABLE `chart_y` DISABLE KEYS */;
INSERT INTO `chart_y` VALUES (1,36.2),(2,36.4),(3,36.6),(4,36.8),(5,37),(6,37.2);
/*!40000 ALTER TABLE `chart_y` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-20 22:58:14
