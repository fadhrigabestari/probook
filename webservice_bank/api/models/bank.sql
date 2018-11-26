-- MySQL dump 10.16  Distrib 10.1.31-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: bankk
-- ------------------------------------------------------
-- Server version	10.1.31-MariaDB

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
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `idCustomer` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cardNumber` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `picture` varchar(64) DEFAULT '04a924e79f3653cc41556d71550a07fb.png',
  PRIMARY KEY (`idCustomer`),
  UNIQUE KEY `cardNumber` (`cardNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'Ms. Delores Powlowski',16824,223083977,'04a924e79f3653cc41556d71550a07fb.png'),(2,'Dr. Alexandrea Hettinger III',17436,913382373,'04a924e79f3653cc41556d71550a07fb.png'),(3,'Mrs. Marion Stoltenberg',18917,992018109,'04a924e79f3653cc41556d71550a07fb.png'),(4,'Liliana Konopelski',17082,934238151,'04a924e79f3653cc41556d71550a07fb.png'),(5,'Prof. Gino Kertzmann',15482,597843089,'04a924e79f3653cc41556d71550a07fb.png'),(6,'Ricky Upton',13685,250407692,'04a924e79f3653cc41556d71550a07fb.png'),(7,'Jewel Mueller DDS',15883,444429160,'04a924e79f3653cc41556d71550a07fb.png'),(8,'Tavares Rice',16787,487290226,'04a924e79f3653cc41556d71550a07fb.png'),(9,'Amir Tremblay',15035,653766941,'04a924e79f3653cc41556d71550a07fb.png'),(10,'Kurt Stanton',19106,943594810,'04a924e79f3653cc41556d71550a07fb.png'),(11,'Solon McKenzie',18119,309945476,'04a924e79f3653cc41556d71550a07fb.png'),(12,'Prof. Skylar Kirlin',19109,364353522,'04a924e79f3653cc41556d71550a07fb.png'),(13,'Gia Abbott DDS',12196,201774512,'04a924e79f3653cc41556d71550a07fb.png'),(14,'Jermain Shanahan',11665,853769757,'04a924e79f3653cc41556d71550a07fb.png'),(15,'Gina Bartoletti',14652,526865729,'04a924e79f3653cc41556d71550a07fb.png'),(16,'Melvin Gaylord',18959,736533925,'04a924e79f3653cc41556d71550a07fb.png'),(17,'Madelyn Trantow DVM',19029,139798566,'04a924e79f3653cc41556d71550a07fb.png'),(18,'Dr. Ron Reilly MD',10341,862832430,'04a924e79f3653cc41556d71550a07fb.png'),(19,'Lelia Trantow',11199,49167215,'04a924e79f3653cc41556d71550a07fb.png'),(20,'Clinton Hickle',16131,880572013,'04a924e79f3653cc41556d71550a07fb.png'),(21,'Kathlyn Bauch',16144,754240041,'04a924e79f3653cc41556d71550a07fb.png'),(22,'Dr. Moses Reinger V',14297,38831941,'04a924e79f3653cc41556d71550a07fb.png'),(23,'Jody Gaylord IV',18981,108411495,'04a924e79f3653cc41556d71550a07fb.png'),(24,'Mr. Noe Goyette I',17916,898378728,'04a924e79f3653cc41556d71550a07fb.png'),(25,'Prof. Chesley Grant',13348,767188248,'04a924e79f3653cc41556d71550a07fb.png'),(26,'Hillard Walker I',10332,275918137,'04a924e79f3653cc41556d71550a07fb.png'),(27,'Margaret Cummings',13773,779728788,'04a924e79f3653cc41556d71550a07fb.png'),(28,'Adrianna Stoltenberg',19389,861668450,'04a924e79f3653cc41556d71550a07fb.png'),(29,'Stevie Deckow',15342,221720664,'04a924e79f3653cc41556d71550a07fb.png'),(30,'Providenci Brakus',12350,678314416,'04a924e79f3653cc41556d71550a07fb.png'),(31,'Mrs. Hattie Lang PhD',11364,150818265,'04a924e79f3653cc41556d71550a07fb.png'),(32,'Trevor Pagac III',12576,717176246,'04a924e79f3653cc41556d71550a07fb.png'),(33,'Bernie Anderson',11123,423196969,'04a924e79f3653cc41556d71550a07fb.png'),(34,'Hershel Stanton',19259,316009145,'04a924e79f3653cc41556d71550a07fb.png'),(35,'Trystan Shanahan',15957,72837901,'04a924e79f3653cc41556d71550a07fb.png'),(36,'Alivia Littel',14918,667399439,'04a924e79f3653cc41556d71550a07fb.png'),(37,'Darian Tromp',13014,543436133,'04a924e79f3653cc41556d71550a07fb.png'),(38,'Dr. Cydney Mosciski III',19667,675078711,'04a924e79f3653cc41556d71550a07fb.png'),(39,'Horacio Leuschke',15323,506110158,'04a924e79f3653cc41556d71550a07fb.png'),(40,'Turner Ondricka',14169,74562780,'04a924e79f3653cc41556d71550a07fb.png'),(41,'Dr. Arnulfo Baumbach II',15976,599551897,'04a924e79f3653cc41556d71550a07fb.png'),(42,'Princess Pfannerstill',12762,273376663,'04a924e79f3653cc41556d71550a07fb.png'),(43,'Dr. Noble Buckridge DVM',18417,170545723,'04a924e79f3653cc41556d71550a07fb.png'),(44,'Dakota Toy',11751,548231603,'04a924e79f3653cc41556d71550a07fb.png'),(45,'Susana Cartwright PhD',15437,680337098,'04a924e79f3653cc41556d71550a07fb.png'),(46,'Deron Kutch',18193,375380398,'04a924e79f3653cc41556d71550a07fb.png'),(47,'Elaina Schaefer',16477,482262862,'04a924e79f3653cc41556d71550a07fb.png'),(48,'Amiya Kemmer',15464,981086752,'04a924e79f3653cc41556d71550a07fb.png'),(49,'Twila Connelly',11438,696587959,'04a924e79f3653cc41556d71550a07fb.png'),(50,'Flavio Tremblay Sr.',18044,175539533,'04a924e79f3653cc41556d71550a07fb.png'),(51,'Lindsay Streich III',13139,845222013,'04a924e79f3653cc41556d71550a07fb.png'),(52,'Cielo Kertzmann',14876,72289440,'04a924e79f3653cc41556d71550a07fb.png'),(53,'Peter Gerlach',13487,3131491,'04a924e79f3653cc41556d71550a07fb.png'),(54,'Mrs. Octavia Wisoky Jr.',14986,693950667,'04a924e79f3653cc41556d71550a07fb.png'),(55,'Demetris Labadie',14430,485675925,'04a924e79f3653cc41556d71550a07fb.png'),(56,'Arno Runolfsdottir',14069,942103713,'04a924e79f3653cc41556d71550a07fb.png'),(57,'Jettie Farrell',12738,407241537,'04a924e79f3653cc41556d71550a07fb.png'),(58,'Lorine Steuber I',13247,665093728,'04a924e79f3653cc41556d71550a07fb.png'),(59,'Annalise Kuphal',17039,673016157,'04a924e79f3653cc41556d71550a07fb.png'),(60,'April Hermiston',13807,460163245,'04a924e79f3653cc41556d71550a07fb.png'),(61,'Susie Adams',13181,60586895,'04a924e79f3653cc41556d71550a07fb.png'),(62,'Jayme Johnston',14891,526022655,'04a924e79f3653cc41556d71550a07fb.png'),(63,'Joanny Schamberger',12048,529653249,'04a924e79f3653cc41556d71550a07fb.png'),(64,'Duane Dietrich',17870,939692889,'04a924e79f3653cc41556d71550a07fb.png'),(65,'Tremayne Kuhn',13184,605286183,'04a924e79f3653cc41556d71550a07fb.png'),(66,'Mrs. Dasia Kling',11965,137286346,'04a924e79f3653cc41556d71550a07fb.png'),(67,'Yoshiko Gutkowski MD',10308,915103059,'04a924e79f3653cc41556d71550a07fb.png'),(68,'Jeffry Crona',15445,943022440,'04a924e79f3653cc41556d71550a07fb.png'),(69,'Prof. Elmira Dare',16366,286629711,'04a924e79f3653cc41556d71550a07fb.png'),(70,'Celestino Price',14005,411024610,'04a924e79f3653cc41556d71550a07fb.png'),(71,'Lewis Veum DVM',12235,957557569,'04a924e79f3653cc41556d71550a07fb.png'),(72,'Emmalee Turcotte',18989,404172751,'04a924e79f3653cc41556d71550a07fb.png'),(73,'Amiya Hand',10322,761139409,'04a924e79f3653cc41556d71550a07fb.png'),(74,'Kaycee Wolf II',10849,778595373,'04a924e79f3653cc41556d71550a07fb.png'),(75,'Dawn Leffler',19112,396940442,'04a924e79f3653cc41556d71550a07fb.png'),(76,'Giovani Weissnat',15877,193714517,'04a924e79f3653cc41556d71550a07fb.png'),(77,'Chaz Harvey',13775,755234065,'04a924e79f3653cc41556d71550a07fb.png'),(78,'Trycia Luettgen',12615,113085438,'04a924e79f3653cc41556d71550a07fb.png'),(79,'Rod Bosco',13224,558034468,'04a924e79f3653cc41556d71550a07fb.png'),(80,'Miss Margaret Brown II',10270,795613961,'04a924e79f3653cc41556d71550a07fb.png'),(81,'Edward Lubowitz',18422,977967339,'04a924e79f3653cc41556d71550a07fb.png'),(82,'Prof. Dedric Collier MD',13343,418902830,'04a924e79f3653cc41556d71550a07fb.png'),(83,'Samantha McLaughlin',10288,69110209,'04a924e79f3653cc41556d71550a07fb.png'),(84,'Arjun Bergstrom',15557,519832849,'04a924e79f3653cc41556d71550a07fb.png'),(85,'Prof. Harold Buckridge I',18553,623759178,'04a924e79f3653cc41556d71550a07fb.png'),(86,'Rosalind Stehr',13055,771683329,'04a924e79f3653cc41556d71550a07fb.png'),(87,'Keely Stamm',14884,697389569,'04a924e79f3653cc41556d71550a07fb.png'),(88,'Arvilla Mayert',15589,228058121,'04a924e79f3653cc41556d71550a07fb.png'),(89,'Dr. Giovanny Erdman DDS',14837,62130969,'04a924e79f3653cc41556d71550a07fb.png'),(90,'Prof. Ines Miller',15465,717618090,'04a924e79f3653cc41556d71550a07fb.png'),(91,'Madelynn Maggio',19564,105100716,'04a924e79f3653cc41556d71550a07fb.png'),(92,'Suzanne Doyle DVM',15176,739548777,'04a924e79f3653cc41556d71550a07fb.png'),(93,'Dr. Lewis Jerde I',18042,868006700,'04a924e79f3653cc41556d71550a07fb.png'),(94,'Santina Lang',12258,434119110,'04a924e79f3653cc41556d71550a07fb.png'),(95,'German Harris',14410,727571207,'04a924e79f3653cc41556d71550a07fb.png'),(96,'Bobby Parisian',17296,174661832,'04a924e79f3653cc41556d71550a07fb.png'),(97,'Rickey Fahey DVM',14581,930667755,'04a924e79f3653cc41556d71550a07fb.png'),(98,'William Denesik PhD',11868,302993850,'04a924e79f3653cc41556d71550a07fb.png'),(99,'Mr. Rupert Hoppe',18393,735467729,'04a924e79f3653cc41556d71550a07fb.png'),(100,'Judd White',13497,76855230,'04a924e79f3653cc41556d71550a07fb.png');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `idTransaction` int(11) NOT NULL AUTO_INCREMENT,
  `senderCardNumber` int(11) NOT NULL,
  `receiverCardNumber` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `transactionDate` date NOT NULL,
  PRIMARY KEY (`idTransaction`),
  KEY `senderCardNumber` (`senderCardNumber`),
  KEY `receiverCardNumber` (`receiverCardNumber`),
  CONSTRAINT `Transactions_ibfk_1` FOREIGN KEY (`senderCardNumber`) REFERENCES `customer` (`cardNumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Transactions_ibfk_2` FOREIGN KEY (`receiverCardNumber`) REFERENCES `customer` (`cardNumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,13497,14410,50000,'0000-00-00'),(2,18393,14837,250000,'2018-01-01'),(3,10270,15176,50000,'2018-11-12');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-26 22:51:09
