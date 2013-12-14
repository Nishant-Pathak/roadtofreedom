-- MySQL dump 10.13  Distrib 5.5.27, for Win32 (x86)
--
-- Host: localhost    Database: roadtofreedom
-- ------------------------------------------------------
-- Server version	5.5.27

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
-- Table structure for table `article_upvoted`
--

DROP TABLE IF EXISTS `article_upvoted`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_upvoted` (
  `id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `upvoted` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_upvoted`
--

LOCK TABLES `article_upvoted` WRITE;
/*!40000 ALTER TABLE `article_upvoted` DISABLE KEYS */;
INSERT INTO `article_upvoted` VALUES (2,8,'NO'),(2,1,'NO'),(2,7,'YES'),(2,5,'YES');
/*!40000 ALTER TABLE `article_upvoted` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) DEFAULT NULL,
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_name` varchar(50) DEFAULT NULL,
  `article_path` varchar(50) DEFAULT NULL,
  `upvotes` int(11) DEFAULT NULL,
  `date_uploaded` date DEFAULT NULL,
  `image_path` varchar(50) DEFAULT NULL,
  `article_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (5,1,'The Chadar Experience','chadar_experience.docx',0,'2013-12-05','type1.gif','temple'),(5,3,'Germany and the Eurozone','germany_eurozone2.docx',0,'2013-12-05','type3.gif','temple'),(5,4,'Why did Greece Flounder','greece_flounder.docx',0,'2013-12-05','type4.gif','temple'),(5,5,'Syria-The lesson next door','syria.docx',1,'2013-12-05','type5.gif','temple'),(5,6,'Financius Crypto Currency','financius_crypto_currency.docx',0,'2013-12-08','type5.gif','temple'),(5,7,'Tanishq','Tanishq.docx',1,'2013-12-08','type5.gif','temple'),(5,8,'Holiday Season and the post','holiday.docx',0,'2013-12-09','type5.gif','temple');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` char(128) DEFAULT NULL,
  `salt` char(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'ankur','ajb98.itbhu@gmail.com','85302b5c8f16d558ed11529ae49a1fb27775e187cbdab3e3e1d207cb916c6a4d4bcd040b6b5ab9445f7c6015013e88dc6f1c50df2ccc96b8b1c7b7403246b3d3','3c9abe9fdd7c1ae49007bb38ea480100dec3a4529687b26462d0b38ae472a81c68f80a63e5df71a191548fcc53276bc3371ccd1c0f4a344f579d9e7522979387'),(2,'Guest','rtfguest@gmail.com','304fc46c0d111692a35b75267c35e87097c0e4bd74c92ae71955903f0dbb201794d325be47b8772eac2c215aa88e56457787b05f0b05d9a8ca036af4ac6f3afc','239b8627472882e3420a0532866dedbc8b59f5efc8bd022f5ae75d01b42e9c07eb5b9e68b5c365528285aa98e39321b8cfce6ab72fd8238f719f2dac81b2667f'),(3,'sadf','sdf','9434660c4564ea27520061834f12f4f4e9aeaed00d9e2820939c495fa2ec139a325ee807f02ec5426610dcb0f938ecbefb46fb86d9a60ba02843fbfec45ab682','f17c7015fcfbccb21bc86f1038e80640af5a6e4110395ece0c0226a1e7699d761131e7a85c399fbd085d5f1c28f2a3eb6b84cb3b4eb08027771e800f55234a91'),(4,NULL,NULL,'2ea8812bcf80084a01ba47c8c1269f6361a1598ed8b24589e92f474a652bce784fabdba65607f33a8d8c53498e3530f4ed620a254a039fb58c5845e36ba41e92','59f58543905136c0da228fead9ab00df76dafa10dbb8e0abf8f3464b9bb0cfd54a22d5be5a64fc389ec25c4b24ce546952a638f1a32cb966df2f1de2da976823'),(5,'Sid','sid@gmail.com','106dc9f762e4ad819f15402e52849c6fa75d7a18e4902557549cbd13d71950598bc8a099a1343eda933a72425e3d2395d4a2d9208ca94d1676e79d4ea2f656ac','8293713c93ab2fea1d8e502ae7e1c67b021f933146ef1e4df6069ca0ba35be630521a5f4856c7e4a1c120deddf0070077ecb269dfe6a1467c7b28648dddcd0f0'),(6,'pandey','abc','0aeb9e0770e7e08a60e0d101b9fb57d1593e75ff7ce86b8b9f678bc99fba85877adff5049dfddc2ee0ac88929ec3e157a2c9d3dbd950edb4c185774afd149ffd','c88b5bdbd51a953ea6e2342fab88a90c8dd94e05e119f3d0b60a009000af12d94850d3300172341fa3a330e7003e568a70a80afbe381d5be48f8d0afc2323d95');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-12-13  2:44:37
