-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: flight_reservation
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `airplanes`
--

DROP TABLE IF EXISTS `airplanes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `airplanes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `num_of_seats` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airplanes`
--

LOCK TABLES `airplanes` WRITE;
/*!40000 ALTER TABLE `airplanes` DISABLE KEYS */;
INSERT INTO `airplanes` VALUES (1,350),(2,250),(3,200),(4,300),(5,400),(6,480),(7,100),(8,150),(9,260);
/*!40000 ALTER TABLE `airplanes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `airports`
--

DROP TABLE IF EXISTS `airports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `airports` (
  `airport_code` varchar(45) NOT NULL,
  `airport_name` varchar(45) NOT NULL,
  `city_id` int unsigned NOT NULL,
  PRIMARY KEY (`airport_code`),
  UNIQUE KEY `airport_code_UNIQUE` (`airport_code`),
  KEY `city_id_idx` (`city_id`),
  CONSTRAINT `city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airports`
--

LOCK TABLES `airports` WRITE;
/*!40000 ALTER TABLE `airports` DISABLE KEYS */;
INSERT INTO `airports` VALUES ('BEG','Belgrade Nikola Tesla Airport',4),('HND','Tokyo International Airport',6),('MEX','Aeropuerto Internacional Benito Juarez',8),('OMO','Mostar International Airport',2),('SJJ','Sarajevo International Airport',1),('SMA','Sanski Most Airport',3),('ZAG','Franjo Tuđman Airport Zagreb',5);
/*!40000 ALTER TABLE `airports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `baggage`
--

DROP TABLE IF EXISTS `baggage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `baggage` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `weight` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `baggage`
--

LOCK TABLES `baggage` WRITE;
/*!40000 ALTER TABLE `baggage` DISABLE KEYS */;
INSERT INTO `baggage` VALUES (1,5,'Small bag',0),(2,10,'Big Luggage',6),(3,15,'Mix',10);
/*!40000 ALTER TABLE `baggage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booked_tickets`
--

DROP TABLE IF EXISTS `booked_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booked_tickets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `booking_date` date NOT NULL,
  `user_id` int unsigned NOT NULL,
  `flight_id` int unsigned NOT NULL,
  `ticket_price` double NOT NULL,
  `seat_row` varchar(45) NOT NULL,
  `seat_column` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_code_UNIQUE` (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `flight_id_idx` (`flight_id`),
  CONSTRAINT `flight_id_fk` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booked_tickets`
--

LOCK TABLES `booked_tickets` WRITE;
/*!40000 ALTER TABLE `booked_tickets` DISABLE KEYS */;
INSERT INTO `booked_tickets` VALUES (1,'2023-10-12',23,1,69.69,'1','A'),(6,'2023-07-13',24,1,150.95,'',''),(7,'2023-07-13',24,1,150.95,'',''),(8,'2023-07-13',24,1,150.95,'',''),(9,'2023-10-12',23,1,69.69,'1','A'),(10,'2023-07-13',24,1,150.95,'',''),(11,'2023-07-13',24,1,150.95,'',''),(12,'2023-07-13',24,1,150.95,'',''),(13,'2023-07-13',24,5,856.741,'2','D'),(14,'2023-07-13',24,5,856.741,'2','D'),(15,'2023-07-13',24,5,856.741,'2','D'),(16,'2023-07-13',24,5,856.741,'2','D'),(17,'2023-07-13',25,4,159.471,'1','E');
/*!40000 ALTER TABLE `booked_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(45) NOT NULL,
  `zipcode` varchar(45) NOT NULL,
  `country_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `zipcode_UNIQUE` (`zipcode`),
  KEY `country_id_idx` (`country_id`),
  CONSTRAINT `country_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Sarajevo','71000',1),(2,'Mostar','88000',1),(3,'Sanski Most','79260',1),(4,'Belgrade','11000',2),(5,'Zagreb','10000',3),(6,'Tokyo','100004',4),(7,'Abuja','900211',5),(8,'Mexico City','01000',6),(9,'Brasilia','72700',7);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `country_name` varchar(45) DEFAULT NULL,
  `continent` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Bosnia','EU'),(2,'Serbia','EU'),(3,'Croatia','EU'),(4,'Japan','Asia'),(5,'Nigeria','Africa'),(6,'Mexico','North America'),(7,'Brazil','South America');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `discounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `discount_name` varchar(45) NOT NULL,
  `amount` double unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` VALUES (1,'Student',0.3),(2,'Senior',0.3),(3,'Employee',0.5);
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fares`
--

DROP TABLE IF EXISTS `fares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fares` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fares`
--

LOCK TABLES `fares` WRITE;
/*!40000 ALTER TABLE `fares` DISABLE KEYS */;
INSERT INTO `fares` VALUES (1,'Economy class'),(2,'Business class'),(3,'First class');
/*!40000 ALTER TABLE `fares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flights` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `route_id` int unsigned NOT NULL,
  `airplane_id` int unsigned NOT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_date` date NOT NULL,
  `arrival_time` time NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `plane_id_idx` (`airplane_id`),
  CONSTRAINT `plane_id` FOREIGN KEY (`airplane_id`) REFERENCES `airplanes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flights`
--

LOCK TABLES `flights` WRITE;
/*!40000 ALTER TABLE `flights` DISABLE KEYS */;
INSERT INTO `flights` VALUES (1,1,1,'2023-09-20','10:00:00','2023-09-21','21:00:00',150.95),(2,5,2,'2023-09-20','12:00:00','2023-09-21','23:00:00',450.95),(3,6,3,'2023-09-20','13:00:00','2023-09-22','00:00:00',328),(4,7,4,'2023-09-20','14:00:00','2023-09-22','01:00:00',159.47),(5,8,5,'2023-09-20','15:00:00','2023-09-22','02:00:00',856.74),(6,2,1,'2023-09-20','15:00:00','2023-09-20','16:00:00',354.87);
/*!40000 ALTER TABLE `flights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passengers`
--

DROP TABLE IF EXISTS `passengers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `passengers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `title` enum('male','female') DEFAULT NULL,
  `test` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passengers`
--

LOCK TABLES `passengers` WRITE;
/*!40000 ALTER TABLE `passengers` DISABLE KEYS */;
INSERT INTO `passengers` VALUES (1,'John','Doe','1990-05-15','US123456','A1234567','male',NULL),(2,'Jane','Smith','1985-09-20','UK987654','B9876543','female',NULL),(3,'Michael','Johnson','1978-12-10','CA246813','C2468135','male',NULL),(4,'Emily','Davis','1995-07-01','AU567890','D5678901','female',NULL),(5,'lejlic','le','0000-00-00','45445','45450','male',NULL),(6,'Emir','Kugic','0111-11-11','1111121','21231321','male',NULL),(7,'Emir','Kugic','0111-02-13','123131','3213213','male',NULL),(8,'Emir','Kugic','1111-11-11','21313123','132131','male',NULL),(9,'Emir','Kugic','1111-11-11','11111111','111111111','male',NULL),(10,'Emir','Kugic','0111-11-11','44236514','65465465','male',NULL),(11,'Emir','Kugic','0111-11-20','6564654','54645','male',NULL),(12,'Arnela','Ombasa','0001-11-11','5543264','654564','male',NULL),(13,'kjlk','kljjjlkj','0111-01-11','1121321','32132132','male',NULL),(14,'arnel','nkjl','0111-11-11','21231321','2313231','male','n234kj23h4');
/*!40000 ALTER TABLE `passengers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `routes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `departure_airport` varchar(45) NOT NULL,
  `destination_airport` varchar(45) NOT NULL,
  `distance` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `departure_airport_idx` (`departure_airport`),
  KEY `destination_airport_idx` (`destination_airport`),
  CONSTRAINT `departure_airport` FOREIGN KEY (`departure_airport`) REFERENCES `airports` (`airport_code`),
  CONSTRAINT `destination_airport` FOREIGN KEY (`destination_airport`) REFERENCES `airports` (`airport_code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routes`
--

LOCK TABLES `routes` WRITE;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` VALUES (1,'SJJ','MEX',10),(2,'SJJ','ZAG',400),(3,'SJJ','SMA',250),(4,'SJJ','BEG',300),(5,'SJJ','MEX',10),(6,'SJJ','MEX',10),(7,'SJJ','MEX',10),(8,'SJJ','MEX',10);
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seat_prices`
--

DROP TABLE IF EXISTS `seat_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seat_prices` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `seat_id` int unsigned NOT NULL,
  `flight_id` int unsigned NOT NULL,
  `amount` double unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `seat_id_idx` (`seat_id`),
  KEY `flight_id_idx` (`flight_id`),
  CONSTRAINT `flight_id` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`),
  CONSTRAINT `seat_id` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seat_prices`
--

LOCK TABLES `seat_prices` WRITE;
/*!40000 ALTER TABLE `seat_prices` DISABLE KEYS */;
INSERT INTO `seat_prices` VALUES (19,1,1,250),(20,2,2,269),(21,3,3,170),(22,4,4,350),(23,5,5,380),(24,6,6,420),(25,7,1,850),(26,8,2,999),(27,9,3,1026),(28,1,2,179);
/*!40000 ALTER TABLE `seat_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seats`
--

DROP TABLE IF EXISTS `seats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seats` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `row` varchar(45) NOT NULL,
  `column` varchar(45) NOT NULL,
  `status` tinyint NOT NULL,
  `fare_id` int unsigned NOT NULL,
  `airplane_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fare_id_idx` (`fare_id`),
  KEY `airplane_id_idx` (`airplane_id`),
  CONSTRAINT `airplane_id` FOREIGN KEY (`airplane_id`) REFERENCES `airplanes` (`id`),
  CONSTRAINT `fare_id` FOREIGN KEY (`fare_id`) REFERENCES `fares` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seats`
--

LOCK TABLES `seats` WRITE;
/*!40000 ALTER TABLE `seats` DISABLE KEYS */;
INSERT INTO `seats` VALUES (1,'1','A',1,1,1),(2,'1','B',1,1,1),(3,'1','C',0,1,1),(4,'1','D',1,1,1),(5,'1','E',1,1,1),(6,'1','F',1,1,1),(7,'2','A',0,1,1),(8,'2','B',0,1,1),(9,'2','C',0,1,1),(10,'2','D',1,1,1),(11,'2','E',0,1,1),(12,'2','F',0,1,1),(13,'3','A',0,1,1),(14,'3','B',0,1,1),(15,'3','C',0,1,1),(16,'3','D',0,1,1),(17,'3','E',0,1,1),(18,'3','F',0,1,1),(19,'4','A',0,1,1),(20,'4','B',0,1,1),(21,'4','C',0,1,1),(22,'4','D',0,1,1),(23,'4','E',0,1,1),(24,'4','F',1,1,1),(25,'5','A',0,1,1),(26,'5','B',0,1,1),(27,'5','C',0,1,1),(28,'5','D',0,1,1),(29,'5','E',0,1,1),(30,'5','F',0,1,1),(31,'6','A',0,1,1),(32,'6','B',0,1,1),(33,'6','C',1,1,1),(34,'6','D',0,1,1),(35,'6','E',0,1,1),(36,'6','F',0,1,1),(37,'7','A',0,1,1),(38,'7','B',0,1,1),(39,'7','C',0,1,1),(40,'7','D',0,1,1),(41,'7','E',0,1,1),(42,'7','F',0,1,1),(43,'8','A',0,1,1),(44,'8','B',0,1,1),(45,'8','C',0,1,1),(46,'8','D',0,1,1),(47,'8','E',0,1,1),(48,'8','F',0,1,1),(49,'9','A',0,1,1),(50,'9','B',0,1,1),(51,'9','C',0,1,1),(52,'9','D',0,1,1),(53,'9','E',0,1,1),(54,'9','F',0,1,1),(55,'10','A',0,1,1),(56,'10','B',0,1,1),(57,'10','C',0,1,1),(58,'10','D',0,1,1),(59,'10','E',0,1,1),(60,'10','F',0,1,1);
/*!40000 ALTER TABLE `seats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'update','kugic','emirk@gmail.com','newpassword'),(2,'idk','idk','idk@gmail.com','123'),(3,'two','user','mail@gmail.com','789'),(4,'test','test','test@gmail.com','emir'),(5,'test2','test2','test2@gmail.com','emir'),(6,'Lejla','Muratovic','lejla@gmail.com','lejlapw'),(8,'Test23','Muratovic','lejl23a@gmail.com','test23'),(9,'random','Muratovic','random@gmail.com','test23'),(10,'emir','testinsdlkfjsdlf','random123@gmail.com','test23'),(11,'Emir','Kugic','emirkugic@stu.ibu.edu.ba','emir123'),(13,'lkjlk','ljkk','k@gmail.com','k'),(14,'o','o','o@gmail.com','o'),(15,'o','o','p@gmail.com','o'),(16,'Lejla','Muratovic','lejlic@gmail.com','lejla'),(17,'m','m','m@gmail.com','m'),(18,'Emir','Kugic','emir2@gmail.com','emir'),(19,'lejla','muratovic','lejlamuratovic@gmail.com','12345678@'),(20,'1','9','1@gmail.com','12345678@'),(21,'3','3','3@gmail.com','3'),(22,'Emir','Kugic','test1@gmail.com','tesz12345@'),(23,'Emir','Kugic','emirkugic@gmail.com','12345678@'),(24,'Emir','Kugic','5@gmail.com','210b48b542659fb951a80a15c5997513'),(25,'Emir','Kugic','emirlejla@gmail.com','6dfcabca6460e98d705777b3edd502a1'),(26,'lejlaemir@gmail.com','lejlaemir@','lejlaemir@gmail.com','392f3ffd805bc2308939996553fab65e');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-13 21:40:08
