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
  `hal_menonjol_1` text NOT NULL,
  `kamar_mandi` varchar(255) NOT NULL DEFAULT '',
  `dinding_tembok` varchar(255) NOT NULL DEFAULT '',
  `kondisi_jeruji` varchar(255) NOT NULL DEFAULT '',
  `material_plafon` varchar(255) NOT NULL DEFAULT '',
  `jendela_ventilasi` varchar(255) NOT NULL DEFAULT '',
  `barang_temuan` varchar(255) NOT NULL DEFAULT '',
  `hal_menonjol_2` text NOT NULL,
  `kondisi_penerangan` varchar(255) NOT NULL DEFAULT '',
  `kondisi_cctv` varchar(255) NOT NULL DEFAULT '',
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
-- Table structure for table `tb_cek_tahanan_backup`
--

DROP TABLE IF EXISTS `tb_cek_tahanan_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cek_tahanan_backup` (
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
-- Dumping data for table `tb_cek_tahanan_backup`
--

LOCK TABLES `tb_cek_tahanan_backup` WRITE;
/*!40000 ALTER TABLE `tb_cek_tahanan_backup` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_cek_tahanan_backup` ENABLE KEYS */;
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
  `nourut` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_satker`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_satker`
--

LOCK TABLES `tb_satker` WRITE;
/*!40000 ALTER TABLE `tb_satker` DISABLE KEYS */;
INSERT INTO `tb_satker` VALUES ('1YS8C','','Polres Mempawah',1,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('2L8J1','','Polres Landak',2,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('54TYD','','Polresta Pontianak Kota',3,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('7QXVP','','Polres Singkawang',4,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('H9XOF','54TYD','Pontianak Barat',5,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('HOYJ4','7QXVP','Singkawang Tengah',6,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('JOU9V','','Polres Melawi',7,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('MOAVG','','Polres Ketapang',8,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('N8K8V','2L8J1','Polsek Sebangki',9,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('PJYXD','','Polres Sintang',10,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('Q15SC','7QXVP','Polsek Singkawang Barat',11,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('SLGDB','7QXVP','Polsek Singkawang Tengah',12,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('T0IL7','7QXVP','Polsek Singkawang Barat',13,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('UFZHT','54TYD','Polsek Pontianak Selatan',14,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('WAUBN','','Polres Ketapang',15,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('WRMUH','2L8J1','Polsek Ngabang',16,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09'),('X9CXM','','Polres Kayong Utara',17,'cHZSdFMrMEREN1laZXowaFZ1MVVvQT09');
/*!40000 ALTER TABLE `tb_satker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_user` (
  `id_user` varchar(10) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `group_user` varchar(5) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user`
--

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` VALUES ('3PY0Y8VXGI','singkawang','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09','7QXVP'),('7O0JZFU1LH','admin','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09',''),('J0NVB2IKI2','pontianak','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09','54TYD'),('TQM4PZ2OXV','Polres Landak','cHZSdFMrMEREN1laZXowaFZ1MVVvQT09','2L8J1');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-02 10:42:27
