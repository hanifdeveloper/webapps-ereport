-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: dbweb_ereport
-- ------------------------------------------------------
-- Server version	5.7.32

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
-- Table structure for table `tb_cek_kebakaran`
--

DROP TABLE IF EXISTS `tb_cek_kebakaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cek_kebakaran` (
  `id_cek_kebakaran` varchar(25) NOT NULL DEFAULT '',
  `satker_id` varchar(5) NOT NULL DEFAULT '',
  `hal_menonjol` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id_cek_kebakaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cek_kebakaran`
--

LOCK TABLES `tb_cek_kebakaran` WRITE;
/*!40000 ALTER TABLE `tb_cek_kebakaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_cek_kebakaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_cek_tahanan`
--

DROP TABLE IF EXISTS `tb_cek_tahanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cek_tahanan` (
  `id_cek_tahanan` varchar(25) NOT NULL DEFAULT '',
  `satker_id` varchar(5) NOT NULL DEFAULT '',
  `jumlah_tahanan` int(11) NOT NULL,
  `surat_aktif` int(11) NOT NULL,
  `surat_expired` int(11) NOT NULL,
  `kamar_mandi` varchar(255) NOT NULL DEFAULT '',
  `dinding_tembok` varchar(255) NOT NULL DEFAULT '',
  `jeruji` varchar(255) NOT NULL DEFAULT '',
  `material_platfon` varchar(255) NOT NULL DEFAULT '',
  `jendela_ventilasi` varchar(255) NOT NULL DEFAULT '',
  `cctv` varchar(255) NOT NULL DEFAULT '',
  `barang_temuan` varchar(255) NOT NULL DEFAULT '',
  `hal_menonjol` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id_cek_tahanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cek_tahanan`
--

LOCK TABLES `tb_cek_tahanan` WRITE;
/*!40000 ALTER TABLE `tb_cek_tahanan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_cek_tahanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_document_upload`
--

DROP TABLE IF EXISTS `tb_document_upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_document_upload` (
  `id_document_upload` varchar(25) NOT NULL DEFAULT '',
  `cek_id` varchar(25) NOT NULL DEFAULT '',
  `category_document` varchar(5) NOT NULL DEFAULT '',
  `text_caption` varchar(255) NOT NULL DEFAULT '',
  `file_upload` varchar(255) NOT NULL DEFAULT '',
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id_document_upload`),
  KEY `category_id` (`cek_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_document_upload`
--

LOCK TABLES `tb_document_upload` WRITE;
/*!40000 ALTER TABLE `tb_document_upload` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_document_upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_satker`
--

DROP TABLE IF EXISTS `tb_satker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_satker` (
  `id_satker` varchar(5) NOT NULL DEFAULT '',
  `group_satker` varchar(5) NOT NULL DEFAULT '',
  `nama_satker` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_satker`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_satker`
--

LOCK TABLES `tb_satker` WRITE;
/*!40000 ALTER TABLE `tb_satker` DISABLE KEYS */;
INSERT INTO `tb_satker` VALUES ('2L8J1','','Polresta Landak','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('54TYD','','Polresta Pontianak Kota','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('7QXVP','','Polresta Singkawang','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('H9XOF','54TYD','Polsek Pontianak Barat','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('N8K8V','2L8J1','Polsek Sebangki','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('Q15SC','7QXVP','Polsek Singkawang Barat','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('SLGDB','7QXVP','Polsek Singkawang Tengah','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('T0IL7','7QXVP','Polsek Singkawang Barat','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('UFZHT','54TYD','Polsek Pontianak Selatan','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('WRMUH','2L8J1','Polsek Ngabang','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09');
/*!40000 ALTER TABLE `tb_satker` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-09  2:18:55
