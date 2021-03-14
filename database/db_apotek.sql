-- MariaDB dump 10.17  Distrib 10.5.5-MariaDB, for osx10.15 (x86_64)
--
-- Host: localhost    Database: db_apotek
-- ------------------------------------------------------
-- Server version	10.5.5-MariaDB

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
-- Table structure for table `kategori_obat`
--

DROP TABLE IF EXISTS `kategori_obat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori_obat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_obat`
--

LOCK TABLES `kategori_obat` WRITE;
/*!40000 ALTER TABLE `kategori_obat` DISABLE KEYS */;
INSERT INTO `kategori_obat` VALUES (1,'Tablet'),(2,'Sirup');
/*!40000 ALTER TABLE `kategori_obat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obat`
--

DROP TABLE IF EXISTS `obat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `obat_FK` (`id_kategori`),
  CONSTRAINT `obat_FK` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_obat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obat`
--

LOCK TABLES `obat` WRITE;
/*!40000 ALTER TABLE `obat` DISABLE KEYS */;
INSERT INTO `obat` VALUES (1,'ALLUPURINOL 100 MG',1,1000,'Strip'),(2,'ALLUPURINOL 200 MG',1,2000,'Strip'),(3,'ALPRAZOLAM 0,5 MG',1,1500,'Strip'),(4,'ALPRAZOLAM 1 MG',1,1500,'Strip'),(5,'ANTALGIN TAB 500MG',1,2000,'Strip'),(6,'PARACETAMOL 500 MG',1,5000,'Strip'),(7,'PARACETAMOL 600 MG',1,6000,'Strip'),(8,'BISOLVON Sirup 100 ML',2,40000,'Botol');
/*!40000 ALTER TABLE `obat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_in`
--

DROP TABLE IF EXISTS `order_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `id_supplier` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_in_FK` (`id_supplier`),
  CONSTRAINT `order_in_FK` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_in`
--

LOCK TABLES `order_in` WRITE;
/*!40000 ALTER TABLE `order_in` DISABLE KEYS */;
INSERT INTO `order_in` VALUES (1,'2021-03-14',1),(2,NULL,1),(3,'2021-03-14',1),(4,'2021-03-14',1),(5,'2021-03-14',1),(6,'2021-03-14',1),(7,'2021-03-14',1),(8,'2021-03-14',1),(9,'2021-03-14',1),(10,'2021-03-14',1);
/*!40000 ALTER TABLE `order_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_in_det`
--

DROP TABLE IF EXISTS `order_in_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_in_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_obat` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `id_order_in` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_in_det_FK_1` (`id_obat`),
  KEY `order_in_det_FK` (`id_order_in`),
  CONSTRAINT `order_in_det_FK` FOREIGN KEY (`id_order_in`) REFERENCES `order_in` (`id`),
  CONSTRAINT `order_in_det_FK_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_in_det`
--

LOCK TABLES `order_in_det` WRITE;
/*!40000 ALTER TABLE `order_in_det` DISABLE KEYS */;
INSERT INTO `order_in_det` VALUES (1,1,100,1),(2,2,100,1),(3,3,50,1),(4,4,70,1),(5,5,70,1),(6,1,1000,4),(7,1,1000,5),(8,1,1000,6),(9,1,1000,7),(10,1,1000,8),(11,1,1000,9),(12,1,1000,10);
/*!40000 ALTER TABLE `order_in_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_out`
--

DROP TABLE IF EXISTS `order_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(100) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `delivery_status` int(1) DEFAULT NULL,
  `delivery_cost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_out`
--

LOCK TABLES `order_out` WRITE;
/*!40000 ALTER TABLE `order_out` DISABLE KEYS */;
INSERT INTO `order_out` VALUES (1,'rian',1,'bandung',NULL,NULL,NULL),(2,'rian',1,'bandung',NULL,NULL,NULL),(3,'rian',1,'bandung',NULL,NULL,NULL),(4,'rian',1,'bandung',NULL,NULL,NULL),(5,'rian',1,'bandung',NULL,1,10000),(6,'rian',1,'bandung','2021-03-14 19:11:53',1,10000);
/*!40000 ALTER TABLE `order_out` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_out_det`
--

DROP TABLE IF EXISTS `order_out_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_out_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order_out` int(11) DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_out_det_FK` (`id_order_out`),
  KEY `order_out_det_FK_1` (`id_obat`),
  CONSTRAINT `order_out_det_FK` FOREIGN KEY (`id_order_out`) REFERENCES `order_out` (`id`),
  CONSTRAINT `order_out_det_FK_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_out_det`
--

LOCK TABLES `order_out_det` WRITE;
/*!40000 ALTER TABLE `order_out_det` DISABLE KEYS */;
INSERT INTO `order_out_det` VALUES (1,2,1,5),(2,3,1,5),(3,3,2,10),(4,4,1,5),(5,4,2,10),(6,5,1,50),(7,5,2,10),(8,6,1,50),(9,6,2,10);
/*!40000 ALTER TABLE `order_out_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'PT. Indofarma','Bandung','08112233445');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `v_stock`
--

DROP TABLE IF EXISTS `v_stock`;
/*!50001 DROP VIEW IF EXISTS `v_stock`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_stock` (
  `id_obat` tinyint NOT NULL,
  `qty_in` tinyint NOT NULL,
  `qty_out` tinyint NOT NULL,
  `stock` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `v_stock`
--

/*!50001 DROP TABLE IF EXISTS `v_stock`*/;
/*!50001 DROP VIEW IF EXISTS `v_stock`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_stock` AS select `o`.`id` AS `id_obat`,ifnull(`oin`.`qty_in`,0) AS `qty_in`,ifnull(`oot`.`qty_out`,0) AS `qty_out`,ifnull(`oin`.`qty_in`,0) - ifnull(`oot`.`qty_out`,0) AS `stock` from ((`db_apotek`.`obat` `o` left join (select `oid`.`id_obat` AS `id_obat`,sum(`oid`.`qty`) AS `qty_in` from `db_apotek`.`order_in_det` `oid` group by `oid`.`id_obat`) `oin` on(`oin`.`id_obat` = `o`.`id`)) left join (select `ood`.`id_obat` AS `id_obat`,sum(`ood`.`qty`) AS `qty_out` from `db_apotek`.`order_out_det` `ood` group by `ood`.`id_obat`) `oot` on(`oot`.`id_obat` = `o`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-15  2:29:33
