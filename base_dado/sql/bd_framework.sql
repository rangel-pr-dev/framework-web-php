-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: bd_framework_2
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `tb_item`
--

DROP TABLE IF EXISTS `tb_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_item_tipo` varchar(45) NOT NULL,
  `qualidade` int NOT NULL,
  `id_relacionamento` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_item`
--

LOCK TABLES `tb_item` WRITE;
/*!40000 ALTER TABLE `tb_item` DISABLE KEYS */;
INSERT INTO `tb_item` VALUES (1,'1',1,'1','Item 1'),(2,'1',2,'1','Item 2'),(3,'1',3,'1','Item 3'),(4,'1',4,'1','Item 4'),(5,'1',5,'1','Item 5'),(6,'1',1,'1','Item 6'),(7,'1',2,'1','Item 7'),(8,'1',3,'1','Item 8'),(9,'1',4,'1','Item 9'),(10,'1',5,'1','Item 10'),(11,'1',1,'1','Item 11'),(12,'1',2,'1','Item 12'),(13,'1',3,'1','Item 13'),(14,'1',4,'1','Item 14'),(15,'1',5,'1','Item 15'),(16,'1',1,'1','Item 16'),(17,'1',2,'1','Item 17'),(18,'1',3,'1','Item 18'),(19,'1',4,'1','Item 19'),(20,'1',5,'1','Item 20'),(21,'2',1,'2','Item 21'),(22,'2',2,'2','Item 22'),(23,'2',3,'2','Item 23'),(24,'2',4,'2','Item 24'),(25,'2',5,'2','Item 25'),(26,'2',1,'2','Item 26'),(27,'2',2,'2','Item 27'),(28,'2',3,'2','Item 28'),(29,'2',4,'2','Item 29'),(30,'2',5,'2','Item 30'),(31,'2',1,'2','Item 31'),(32,'2',2,'2','Item 32'),(33,'2',3,'2','Item 33'),(34,'2',4,'2','Item 34'),(35,'2',5,'2','Item 35'),(36,'2',1,'2','Item 36'),(37,'2',2,'2','Item 37'),(38,'2',3,'2','Item 38'),(39,'2',4,'2','Item 39'),(40,'2',5,'2','Item 40'),(41,'3',1,'3','Item 41'),(42,'3',2,'3','Item 42'),(43,'3',3,'3','Item 43'),(44,'3',4,'3','Item 44'),(45,'3',5,'3','Item 45'),(46,'3',1,'3','Item 46'),(47,'3',2,'3','Item 47'),(48,'3',3,'3','Item 48'),(49,'3',4,'3','Item 49'),(50,'3',5,'3','Item 50'),(51,'3',1,'3','Item 51'),(52,'3',2,'3','Item 52'),(53,'3',3,'3','Item 53'),(54,'3',4,'3','Item 54'),(55,'3',5,'3','Item 55'),(56,'3',1,'3','Item 56'),(57,'3',2,'3','Item 57'),(58,'3',3,'3','Item 58'),(59,'3',4,'3','Item 59'),(60,'3',5,'3','Item 60'),(61,'4',1,'4','Item 61'),(62,'4',2,'4','Item 62'),(63,'4',3,'4','Item 63'),(64,'4',4,'4','Item 64'),(65,'4',5,'4','Item 65'),(66,'4',1,'4','Item 66'),(67,'4',2,'4','Item 67'),(68,'4',3,'4','Item 68'),(69,'4',4,'4','Item 69'),(70,'4',5,'4','Item 70'),(71,'4',1,'4','Item 71'),(72,'4',2,'4','Item 72'),(73,'4',3,'4','Item 73'),(74,'4',4,'4','Item 74'),(75,'4',5,'4','Item 75'),(76,'4',1,'4','Item 76'),(77,'4',2,'4','Item 77'),(78,'4',3,'4','Item 78'),(79,'4',4,'4','Item 79'),(80,'4',5,'4','Item 80'),(81,'5',1,'5','Item 81'),(82,'5',2,'5','Item 82'),(83,'5',3,'5','Item 83'),(84,'5',4,'5','Item 84'),(85,'5',5,'5','Item 85'),(86,'5',1,'5','Item 86'),(87,'5',2,'5','Item 87'),(88,'5',3,'5','Item 88'),(89,'5',4,'5','Item 89'),(90,'5',5,'5','Item 90'),(91,'5',1,'5','Item 91'),(92,'5',2,'5','Item 92'),(93,'5',3,'5','Item 93'),(94,'5',4,'5','Item 94'),(95,'5',5,'5','Item 95'),(96,'5',1,'5','Item 96'),(97,'5',2,'5','Item 97'),(98,'5',3,'5','Item 98'),(99,'5',4,'5','Item 99'),(100,'5',5,'5','Item 100');
/*!40000 ALTER TABLE `tb_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_item_tipo`
--

DROP TABLE IF EXISTS `tb_item_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_item_tipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ordem` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ordem_UNIQUE` (`ordem`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_item_tipo`
--

LOCK TABLES `tb_item_tipo` WRITE;
/*!40000 ALTER TABLE `tb_item_tipo` DISABLE KEYS */;
INSERT INTO `tb_item_tipo` VALUES (1,'1','Tipo 1'),(2,'2','Tipo 2'),(3,'3','Tipo 3'),(4,'4','Tipo 4'),(5,'5','Tipo 5');
/*!40000 ALTER TABLE `tb_item_tipo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-15 21:26:44
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: bd_framework_1
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `tb_item`
--

DROP TABLE IF EXISTS `tb_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_item_tipo` varchar(45) NOT NULL,
  `qualidade` int NOT NULL,
  `id_relacionamento` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_item`
--

LOCK TABLES `tb_item` WRITE;
/*!40000 ALTER TABLE `tb_item` DISABLE KEYS */;
INSERT INTO `tb_item` VALUES (1,'1',1,'1','Item 1'),(2,'1',2,'1','Item 2'),(3,'1',3,'1','Item 3'),(4,'1',4,'1','Item 4'),(5,'1',5,'1','Item 5'),(6,'1',1,'1','Item 6'),(7,'1',2,'1','Item 7'),(8,'1',3,'1','Item 8'),(9,'1',4,'1','Item 9'),(10,'1',5,'1','Item 10'),(11,'1',1,'1','Item 11'),(12,'1',2,'1','Item 12'),(13,'1',3,'1','Item 13'),(14,'1',4,'1','Item 14'),(15,'1',5,'1','Item 15'),(16,'1',1,'1','Item 16'),(17,'1',2,'1','Item 17'),(18,'1',3,'1','Item 18'),(19,'1',4,'1','Item 19'),(20,'1',5,'1','Item 20'),(21,'2',1,'2','Item 21'),(22,'2',2,'2','Item 22'),(23,'2',3,'2','Item 23'),(24,'2',4,'2','Item 24'),(25,'2',5,'2','Item 25'),(26,'2',1,'2','Item 26'),(27,'2',2,'2','Item 27'),(28,'2',3,'2','Item 28'),(29,'2',4,'2','Item 29'),(30,'2',5,'2','Item 30'),(31,'2',1,'2','Item 31'),(32,'2',2,'2','Item 32'),(33,'2',3,'2','Item 33'),(34,'2',4,'2','Item 34'),(35,'2',5,'2','Item 35'),(36,'2',1,'2','Item 36'),(37,'2',2,'2','Item 37'),(38,'2',3,'2','Item 38'),(39,'2',4,'2','Item 39'),(40,'2',5,'2','Item 40'),(41,'3',1,'3','Item 41'),(42,'3',2,'3','Item 42'),(43,'3',3,'3','Item 43'),(44,'3',4,'3','Item 44'),(45,'3',5,'3','Item 45'),(46,'3',1,'3','Item 46'),(47,'3',2,'3','Item 47'),(48,'3',3,'3','Item 48'),(49,'3',4,'3','Item 49'),(50,'3',5,'3','Item 50'),(51,'3',1,'3','Item 51'),(52,'3',2,'3','Item 52'),(53,'3',3,'3','Item 53'),(54,'3',4,'3','Item 54'),(55,'3',5,'3','Item 55'),(56,'3',1,'3','Item 56'),(57,'3',2,'3','Item 57'),(58,'3',3,'3','Item 58'),(59,'3',4,'3','Item 59'),(60,'3',5,'3','Item 60'),(61,'4',1,'4','Item 61'),(62,'4',2,'4','Item 62'),(63,'4',3,'4','Item 63'),(64,'4',4,'4','Item 64'),(65,'4',5,'4','Item 65'),(66,'4',1,'4','Item 66'),(67,'4',2,'4','Item 67'),(68,'4',3,'4','Item 68'),(69,'4',4,'4','Item 69'),(70,'4',5,'4','Item 70'),(71,'4',1,'4','Item 71'),(72,'4',2,'4','Item 72'),(73,'4',3,'4','Item 73'),(74,'4',4,'4','Item 74'),(75,'4',5,'4','Item 75'),(76,'4',1,'4','Item 76'),(77,'4',2,'4','Item 77'),(78,'4',3,'4','Item 78'),(79,'4',4,'4','Item 79'),(80,'4',5,'4','Item 80'),(81,'5',1,'5','Item 81'),(82,'5',2,'5','Item 82'),(83,'5',3,'5','Item 83'),(84,'5',4,'5','Item 84'),(85,'5',5,'5','Item 85'),(86,'5',1,'5','Item 86'),(87,'5',2,'5','Item 87'),(88,'5',3,'5','Item 88'),(89,'5',4,'5','Item 89'),(90,'5',5,'5','Item 90'),(91,'5',1,'5','Item 91'),(92,'5',2,'5','Item 92'),(93,'5',3,'5','Item 93'),(94,'5',4,'5','Item 94'),(95,'5',5,'5','Item 95'),(96,'5',1,'5','Item 96'),(97,'5',2,'5','Item 97'),(98,'5',3,'5','Item 98'),(99,'5',4,'5','Item 99'),(100,'5',5,'5','Item 100');
/*!40000 ALTER TABLE `tb_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_item_tipo`
--

DROP TABLE IF EXISTS `tb_item_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_item_tipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ordem` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ordem_UNIQUE` (`ordem`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_item_tipo`
--

LOCK TABLES `tb_item_tipo` WRITE;
/*!40000 ALTER TABLE `tb_item_tipo` DISABLE KEYS */;
INSERT INTO `tb_item_tipo` VALUES (1,'1','Tipo 1'),(2,'2','Tipo 2'),(3,'3','Tipo 3'),(4,'4','Tipo 4'),(5,'5','Tipo 5');
/*!40000 ALTER TABLE `tb_item_tipo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-15 21:26:44
