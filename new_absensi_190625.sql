/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.0-MariaDB, for Android (aarch64)
--
-- Host: localhost    Database: new_absensi_db
-- ------------------------------------------------------
-- Server version	11.8.0-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dat_absensi`
--

DROP TABLE IF EXISTS `dat_absensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dat_absensi` (
  `id_absensi` int(11) NOT NULL AUTO_INCREMENT,
  `nim` char(16) NOT NULL,
  `id_perkuliahan` int(11) NOT NULL,
  `status_kehadiran` char(1) NOT NULL,
  `keterangan` varchar(160) DEFAULT NULL,
  PRIMARY KEY (`id_absensi`),
  KEY `nim` (`nim`),
  KEY `id_perkuliahan` (`id_perkuliahan`),
  CONSTRAINT `dat_absensi_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `dat_mahasiswa` (`nim`),
  CONSTRAINT `dat_absensi_ibfk_2` FOREIGN KEY (`id_perkuliahan`) REFERENCES `dat_perkuliahan` (`id_perkuliahan`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dat_absensi`
--

LOCK TABLES `dat_absensi` WRITE;
/*!40000 ALTER TABLE `dat_absensi` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dat_absensi` VALUES
(1,'24612001',3,'Y','Cuti'),
(2,'24612002',3,'T',''),
(3,'24612003',3,'Y',NULL),
(4,'24612004',3,'Y',NULL),
(5,'24612005',3,'Y',NULL),
(6,'24612006',3,'Y',NULL),
(7,'24612007',3,'Y',NULL),
(8,'24612008',3,'Y',NULL),
(9,'24612009',3,'Y',NULL),
(10,'24612010',3,'Y',NULL),
(11,'24612011',3,'Y',NULL),
(12,'24612012',3,'Y',NULL),
(13,'24612001',4,'Y',NULL),
(14,'24612002',4,'Y',NULL),
(15,'24612003',4,'Y',NULL),
(16,'24612004',4,'Y',NULL),
(17,'24612005',4,'Y',NULL),
(18,'24612006',4,'Y',NULL),
(19,'24612007',4,'Y',NULL),
(20,'24612008',4,'Y',NULL),
(21,'24612009',4,'Y',NULL),
(22,'24612010',4,'Y',NULL),
(23,'24612011',4,'Y',NULL),
(24,'24612012',4,'Y',NULL);
/*!40000 ALTER TABLE `dat_absensi` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dat_dosen`
--

DROP TABLE IF EXISTS `dat_dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dat_dosen` (
  `id_dosen` varchar(16) NOT NULL,
  `nm_dosen` varchar(160) NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(160) NOT NULL,
  PRIMARY KEY (`id_dosen`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dat_dosen`
--

LOCK TABLES `dat_dosen` WRITE;
/*!40000 ALTER TABLE `dat_dosen` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dat_dosen` VALUES
('33553232325','Rohman Hadi Al Haq.,M.Kom ',NULL,'Rohman@gmail.com'),
('35231411121114','Andi Mulyanti S.,S.Kom.,M.MT',NULL,'andimulyanti@gmail.com'),
('3523232323211111','Andik Setiawan S.Kom., M.Kom',NULL,'andik@gmail.com');
/*!40000 ALTER TABLE `dat_dosen` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dat_fakultas`
--

DROP TABLE IF EXISTS `dat_fakultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dat_fakultas` (
  `kd_fakultas` char(2) NOT NULL,
  `nm_fakultas` varchar(160) NOT NULL,
  PRIMARY KEY (`kd_fakultas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dat_fakultas`
--

LOCK TABLES `dat_fakultas` WRITE;
/*!40000 ALTER TABLE `dat_fakultas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dat_fakultas` VALUES
('01','Saintek'),
('02','Ilmu Kesehatan');
/*!40000 ALTER TABLE `dat_fakultas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dat_mahasiswa`
--

DROP TABLE IF EXISTS `dat_mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dat_mahasiswa` (
  `nim` char(16) NOT NULL,
  `nm_mahasiswa` varchar(160) NOT NULL,
  `kelas` char(6) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `kd_prodi` char(2) NOT NULL,
  PRIMARY KEY (`nim`),
  KEY `kd_prodi` (`kd_prodi`),
  CONSTRAINT `dat_mahasiswa_ibfk_1` FOREIGN KEY (`kd_prodi`) REFERENCES `dat_prodi` (`kd_prodi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dat_mahasiswa`
--

LOCK TABLES `dat_mahasiswa` WRITE;
/*!40000 ALTER TABLE `dat_mahasiswa` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dat_mahasiswa` VALUES
('24612001','Ahmad Dafin Eka Subastian','2024-A',2,NULL,'12'),
('24612002','Priyo Sulistyo Budi (K)','2024-A',2,NULL,'12'),
('24612003','Fyppo Alfa Wijaya','2024-A',2,NULL,'12'),
('24612004','Futiha Nur Sa\'adah','2024-A',2,NULL,'12'),
('24612005','Pindy Ayu Damayanti','2024-A',2,NULL,'12'),
('24612006','Sofi Alfitriana ','2024-A',2,NULL,'12'),
('24612007','M.Iqbal Nur Wafa','2024-A',2,NULL,'12'),
('24612008','Novika Hawa Al-Hurin','2024-A',2,NULL,'12'),
('24612009','Padmahayu Paramarta Pambayun','2024-A',2,NULL,'12'),
('24612010','Ragil Kurniawan ','2024-A',2,NULL,'12'),
('24612011','Yulia Devi Ernawati','2024-A',2,NULL,'12'),
('24612012','Miftakhul Jannah','2024-A',2,NULL,'12');
/*!40000 ALTER TABLE `dat_mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dat_matkul`
--

DROP TABLE IF EXISTS `dat_matkul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dat_matkul` (
  `kd_matkul` varchar(10) NOT NULL,
  `nm_matkul` varchar(160) NOT NULL,
  `jml_sks` int(11) DEFAULT NULL,
  `teori` int(11) DEFAULT NULL,
  `praktek` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_matkul`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dat_matkul`
--

LOCK TABLES `dat_matkul` WRITE;
/*!40000 ALTER TABLE `dat_matkul` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dat_matkul` VALUES
('RPL0112','Pancasila & PAK',3,3,0),
('RPL1822','Matematika Komputasi',3,2,1);
/*!40000 ALTER TABLE `dat_matkul` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dat_perkuliahan`
--

DROP TABLE IF EXISTS `dat_perkuliahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dat_perkuliahan` (
  `id_perkuliahan` int(11) NOT NULL AUTO_INCREMENT,
  `id_sebaran_matkul` int(11) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `pertemuan_ke` int(11) DEFAULT NULL,
  `materi` varchar(200) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `batas_absen` datetime DEFAULT NULL,
  `is_teori` tinyint(1) DEFAULT 0,
  `is_praktik` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_perkuliahan`),
  KEY `id_sebaran_matkul` (`id_sebaran_matkul`),
  CONSTRAINT `dat_perkuliahan_ibfk_1` FOREIGN KEY (`id_sebaran_matkul`) REFERENCES `dat_sebaran_matkul` (`id_sebaran_matkul`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dat_perkuliahan`
--

LOCK TABLES `dat_perkuliahan` WRITE;
/*!40000 ALTER TABLE `dat_perkuliahan` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dat_perkuliahan` VALUES
(3,2,'2024-A',1,'Pengenalan','2025-04-19','2025-06-15','13:59:00','2025-04-25 14:30:00',0,0),
(4,2,'2024-A',2,'Presentasi','2025-04-03','2025-06-15','09:30:00','2025-04-03 09:39:00',0,0),
(5,2,'2024-B',NULL,NULL,'2024-12-31',NULL,'08:00:00','2024-12-31 00:15:00',0,0),
(6,1,'2024-B',1,'Presentasi Tugas Akhir','2025-04-14','2025-06-14','13:31:00','2025-04-14 13:35:00',0,0);
/*!40000 ALTER TABLE `dat_perkuliahan` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dat_prodi`
--

DROP TABLE IF EXISTS `dat_prodi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dat_prodi` (
  `kd_prodi` char(2) NOT NULL,
  `nm_prodi` varchar(160) NOT NULL,
  `kd_fakultas` char(2) NOT NULL,
  PRIMARY KEY (`kd_prodi`),
  KEY `kd_fakultas` (`kd_fakultas`),
  CONSTRAINT `dat_prodi_ibfk_1` FOREIGN KEY (`kd_fakultas`) REFERENCES `dat_fakultas` (`kd_fakultas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dat_prodi`
--

LOCK TABLES `dat_prodi` WRITE;
/*!40000 ALTER TABLE `dat_prodi` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dat_prodi` VALUES
('11','Rekayasa Perangkat Lunak','01'),
('12','Bisnis Digital','01');
/*!40000 ALTER TABLE `dat_prodi` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dat_sebaran_matkul`
--

DROP TABLE IF EXISTS `dat_sebaran_matkul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dat_sebaran_matkul` (
  `id_sebaran_matkul` int(11) NOT NULL AUTO_INCREMENT,
  `kd_prodi` char(2) NOT NULL,
  `kd_matkul` varchar(10) NOT NULL,
  `id_dosen` varchar(16) NOT NULL,
  `semester` int(11) DEFAULT NULL,
  `thn_akademik` varchar(10) NOT NULL,
  PRIMARY KEY (`id_sebaran_matkul`),
  KEY `kd_prodi` (`kd_prodi`),
  KEY `kd_matkul` (`kd_matkul`),
  KEY `id_dosen` (`id_dosen`),
  CONSTRAINT `dat_sebaran_matkul_ibfk_1` FOREIGN KEY (`kd_prodi`) REFERENCES `dat_prodi` (`kd_prodi`),
  CONSTRAINT `dat_sebaran_matkul_ibfk_2` FOREIGN KEY (`kd_matkul`) REFERENCES `dat_matkul` (`kd_matkul`),
  CONSTRAINT `dat_sebaran_matkul_ibfk_3` FOREIGN KEY (`id_dosen`) REFERENCES `dat_dosen` (`id_dosen`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dat_sebaran_matkul`
--

LOCK TABLES `dat_sebaran_matkul` WRITE;
/*!40000 ALTER TABLE `dat_sebaran_matkul` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dat_sebaran_matkul` VALUES
(1,'11','RPL1822','33553232325',2,'2024/2025'),
(2,'11','RPL1822','3523232323211111',2,'2024/2025');
/*!40000 ALTER TABLE `dat_sebaran_matkul` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `otoritas`
--

DROP TABLE IF EXISTS `otoritas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otoritas` (
  `kd_otoritas` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_otoritas` varchar(100) NOT NULL,
  `deskripsi` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`kd_otoritas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otoritas`
--

LOCK TABLES `otoritas` WRITE;
/*!40000 ALTER TABLE `otoritas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `otoritas` VALUES
('1','admin',''),
('2','dosen','');
/*!40000 ALTER TABLE `otoritas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `qrabsen`
--

DROP TABLE IF EXISTS `qrabsen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qrabsen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_perkuliahan` int(11) NOT NULL,
  `link_absen` varchar(50) NOT NULL,
  `kata_kunci` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_perkuliahan` (`id_perkuliahan`),
  CONSTRAINT `qrabsen_ibfk_1` FOREIGN KEY (`id_perkuliahan`) REFERENCES `dat_perkuliahan` (`id_perkuliahan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qrabsen`
--

LOCK TABLES `qrabsen` WRITE;
/*!40000 ALTER TABLE `qrabsen` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `qrabsen` VALUES
(1,3,'f317d1c63848ae31bf43a14ee0125f96',NULL),
(2,4,'471ab9319c6d6e0b29a5521f755969c2',NULL),
(3,5,'e5f055ed4440d88ab4ae1d6ae8cffce6',NULL),
(4,6,'a6431f580a6345109feaf81e472c4358',NULL);
/*!40000 ALTER TABLE `qrabsen` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `sessions` VALUES
('O90Kzd0moiADC4osWqtW99s944J32WBYLGMmcHwZ',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoidFA2aXVqd0hXZHRoQXdhUzZVYUE4VGdCSmxzeGJUWHBGQXJveml0ayI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvZGF0YS1wZXJrdWxpYWhhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1750232815);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nm_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `kd_otoritas` char(2) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `users` VALUES
(1,'admin','admin@gmail.com',NULL,'$2y$12$slO1mvYi0ogZAV7DhzC0kuCScDqCdGz2vqyNC6SJMh5axSG/T9i.e','1',NULL,'2025-03-23 20:19:24','2025-04-16 22:57:57'),
(2,'Andik Setiawan','andik@gmail.com',NULL,'$2y$12$PRKVXQQ1D5CbYpCz2ECPk.b18eiL0dlLD0qDINspyDjxg3YtD44g.','2',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-06-19 14:39:58
