-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: filkomcare_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultations`
--

DROP TABLE IF EXISTS `consultations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `report_id` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `consultations_report_id_unique` (`report_id`),
  KEY `consultations_user_id_foreign` (`user_id`),
  CONSTRAINT `consultations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultations`
--

LOCK TABLES `consultations` WRITE;
/*!40000 ALTER TABLE `consultations` DISABLE KEYS */;
INSERT INTO `consultations` VALUES (1,8,'RPT-260528-E3VH','Masalah skripsi','Dosen pembimbing yang menyulitkan','2026-05-29','09:30 WIB','Telepon Konseling','Menunggu','2026-05-27 17:04:01','2026-05-27 17:04:01'),(2,8,'RPT-260528-XIZU','Akademik','Stress project','2026-05-28','09:30 WIB','Chat Konseling','Menunggu','2026-05-27 17:15:04','2026-05-27 17:15:04'),(3,8,'RPT-260528-UPHJ','Akademik','Stress project','2026-06-01','10:00 WIB','Telepon Konseling','Menunggu','2026-05-27 17:22:29','2026-05-27 17:22:29'),(4,8,'RPT-260528-S7ZV','Akademik','Stress project','2026-06-03','09:00 WIB','Konselor Sebaya','Menunggu','2026-05-27 17:33:23','2026-05-27 17:33:23');
/*!40000 ALTER TABLE `consultations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_verification_codes`
--

DROP TABLE IF EXISTS `email_verification_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_verification_codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `code` varchar(6) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_verification_codes_user_id_foreign` (`user_id`),
  CONSTRAINT `email_verification_codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_verification_codes`
--

LOCK TABLES `email_verification_codes` WRITE;
/*!40000 ALTER TABLE `email_verification_codes` DISABLE KEYS */;
INSERT INTO `email_verification_codes` VALUES (2,2,'287725','2026-05-27 08:25:00','2026-05-27 08:15:00'),(3,3,'471724','2026-05-27 08:36:08','2026-05-27 08:26:08'),(4,4,'861406','2026-05-27 08:37:59','2026-05-27 08:27:59');
/*!40000 ALTER TABLE `email_verification_codes` ENABLE KEYS */;
UNLOCK TABLES;

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
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

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
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

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
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_05_27_064233_create_email_verification_codes_table',2),(5,'2026_05_27_065038_make_nim_nullable_in_users_table',3),(6,'2026_05_27_073319_add_email_verified_at_to_users_table',4),(7,'2026_05_27_092336_create_consultations_table',5),(8,'2026_05_27_100654_add_profile_fields_to_users_table',6),(9,'2026_05_27_113300_create_notifications_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` enum('reminder','info','alert') NOT NULL DEFAULT 'reminder',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,8,'Konsultasi anda diverifikasi','RPT-260528-E3VH sedang diproses admin','reminder',1,'2026-05-27 17:04:01','2026-05-27 17:14:10'),(2,8,'Konsultasi anda diverifikasi','RPT-260528-XIZU sedang diproses admin','reminder',1,'2026-05-27 17:15:04','2026-05-27 17:23:10'),(3,8,'Konsultasi anda diverifikasi','RPT-260528-UPHJ sedang diproses admin','reminder',1,'2026-05-27 17:22:29','2026-05-27 17:23:10'),(4,8,'Konsultasi anda diverifikasi','RPT-260528-S7ZV sedang diproses admin','reminder',1,'2026-05-27 17:33:23','2026-05-27 18:07:56');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

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
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `sessions` VALUES ('19OOXIHBYavZ343B7qwTZhXGhCbFvnb0jS4uu1Im',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiazRSV25oQXlOaVE3OTRsM3FpbmdZYjJaYm55Y2RxWjZ3RWI2WlF3OSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779866459),('2Bih2MEf8onzPakyeYp59WUSjem55w3toCA9eKa0',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTWlrclRBR3dIVFFXSWluc3dzNEUxR2VDTjRRYTZKOXhOZ2xIdXVYayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865458),('2CAeY7yoPwP2F99nWnSFiVEyg6M6eCOPWHwlM0i0',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicDhEamk0VEVMRmRlWVNRc3JiM0Fzd0FMR3NlNlYzZVRhTTJMbGZvUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvcmVnaXN0ZXIiO3M6NToicm91dGUiO3M6ODoicmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865116),('34Ps7QiiDQEHiEulKjUKGpV1gPEyPcTku27ZKx7G',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibnVjNWpXNlZLdUlUZEc3YnRta3dsU1BMRU0xbVRvdWNocHRMZWhkTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865116),('3eSYiN2Q4MuDR2EBaAMbp8pMvihKiy8EGvVpYEYr',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWndJcGozSzdCUks3RVRjRTVSamI1d3k0YnhURklya1FUQXJybTZKNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864406),('4AIL98pRGWAO2BEN5eFzPPMrXnUC3IAR4koUDhlY',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTByYkYzM01jcThEaTd4Zm5ZeDNGYkRYQVhLY3JEcUdDNW9Ib1BGWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864175),('6FGJz0fzwQ3rRept9TTsHf7htaEK44WfNlWe6GOJ',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnlPSjZEbXlFeFU2cjRFMjlHdGo1MkhPSGhVMnRSSG16Z3FuTW8xYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865462),('6ZTCzfHpa2Ev7WStS8nCocEGRVwC5oE0r6aqHM8o',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjdWZ3N3ZUNOZHlUQ0dKRlJ5bExRUUdXQU5qbmRnRFI4d2JvNWRvTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864677),('79qwFdG2gBt9F9A0OjdOvl1f7gTCLpZU4kAxpSMa',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoienJhcEU2N3g1aWFOUzhDV1hpblYzQnBYMnFHbVVXNm9ZWXhicHFOMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865116),('7xzxJaWGNV3HZvbl6QCoC6w2lgIVlNvh5ybVzvx1',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUlJ4OG9aNVZRNjR4MU5EVUUwS1VUYWZOaDFTdUdrTUtBSHpweDFtSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvcmVnaXN0ZXIiO3M6NToicm91dGUiO3M6ODoicmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864828),('8oSGGedZqVGUWqe4YnoCwO53rqklv8ZFlxZPaDqN',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3ltRVV1M3NHY3k1RGRxRzRGTUR4eWkyN01QZTJjZXcyVzFKTThuUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NzoibGFuZGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865546),('8R2IBIbuC7sBEsXeZ8CPOZZUj4sEiYifk7gMr5Zf',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1E0WkU1bmt3WlZ0eXRRUExOUU11NEQybFY3S2w3Y3owTmhCWXI3SiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864766),('AFTHz8YsOKk9jOCETdn6dWnK3WYMBIqdcrp5oX4h',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkcyM2tvZFR0OXJGd2FYeUdncE9mYmlHZWllMmliQ1hlbzNKMGNEMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864405),('cIQlaWXNF4C6l9zyqfiosKfXj0pQG1wCekiSJ3hg',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTREWlhsT2laRjkzbHZOYmpZWTFVNU1JakdmN0ZEQjd2Q3BjWjRmTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864212),('CUh3WXrIeVTJMn9nwFENljpcU4gXmDsNFpNWPpho',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicGIwYkk3ckJ5RW90SmVlYTRjVzg0SFlqMk5IaFVoVXllUWIwd01wUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvcmVnaXN0ZXIiO3M6NToicm91dGUiO3M6ODoicmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865126),('dNqc4eWPSg9a4nTnDfWCuf5d0BXYuooOzbNureLK',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNElCYXNJR2xUVThBMDdsdnA2ZFZOWFhHN2ttN3RZNjR2R3FVeEFyOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NzoibGFuZGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779866072),('edcumqbNiat65ozrzLyYaJFUBn9vGl9m6bKtXO0B',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicjVzZ1NyOWN1d3NKaHhtUGRpWVRyWVBKb0xPQlhwTTZHWjk2SmtueSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779863764),('fdN0r7yZO1Tkw61CTwg7PZNOUo5sOOVfPGVZWezE',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoid1lqMGF4d0wwZzZwTndFeHF0dTd1NlE5cURoaWtFYXRCWlIxSWJuQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NzoibGFuZGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779866388),('G1K1J9hDZUCglQl0CG8xcFCZJItYFmy5qQfnqT5c',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTHlySzE0WThhcmhwSXVpZTFPZmoyamVKQzJpZ0pveFVic0pDYURSRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864261),('GBjSpcVfOYZzDoiced1fawbkmv9GyEyYB7JXkNel',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmZVbzJLbVJVUU9JWXVLbk9QNEJrQlhBRGRnM2ViOEJ3OFFDdHIwRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865795),('GfMfYAhfuHa4cG4b283pP29VnP0Lrlwl6egdlLSi',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0xRcjNhQWN6THRxWGdxamxMUExLbHVTbzBwSnNBMVBwNmNreUdsWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865800),('GP3P2Xyrq0IUqS76bA6uqDXvozUmF2Rr75PZ7MIT',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidm9Zd0NwMzVUNFdjbmFPazlYU1o2ZkdPVHRzT3J4emxEQnVvaW1TWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865116),('hRRcY638uR3JeIBzHy4DSDw4qzNe41ylCNNcprJ1',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicndSUkNjZG1zbHdubU10WWgyUmJNOFlvSGlFRjFhUEZESVpLZVFsdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864342),('I23xiJF6x4gPqUvVVmNHbCCEefX3GSnR68gjtvNq',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidTU5dUVlQjM3RkdXd0ducjQ1aW1KTFFJSG8zTEp0QnVqc1BCT0IxeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvcmVnaXN0ZXIiO3M6NToicm91dGUiO3M6ODoicmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779866078),('IHyHGtHNboWwZW5n5zNyTWfAmVfabe6Wz4ACZaKM',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoib3NpcDZqNzByVEprYzhuUzZ6THhJQ1FjQmVnRWwxUHlzTkFMNXcxWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvcmVnaXN0ZXIiO3M6NToicm91dGUiO3M6ODoicmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865455),('ilqWkkv3SxXqLMIoe002x1MaKCwDwFKpH7llK8lf',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1cwQmtjZEFSUWNVV0dqR3MyWTdWSmZLdUNRMUhrY0dtckVxdDhpNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865116),('IQv3nlmWgQmdJI2yDct42uZs5NfI1WzFN0oa63Eq',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0h5SjBVUlZtZjlpaXNQZ0dEcVhxOWlWV2lMSzdQMXljSlBGUHVBSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NzoibGFuZGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865985),('JD70nerhPQxsLqEHpWlugLsL81KMCg4VzYMlREZi',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRE83cENkdW8zQzVYd3l1dTJxT2V6WlFPcU52WThGcUVGUTlnc1VkWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NzoibGFuZGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865146),('JhCXk9gfiTMp7IOWOCrVp9O28zwJrCvZPftlshop',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoid2pWb3lZcTJmQ3pyMTNWazlVckJLMWVkYnQ0YXhvdGJJRXhDN05lbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865116),('KNKjyd3yuDQGD9LF5owe1elX1nmscmxtKA9VqcPV',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNEZFa0E1UWQxSmJEamR5N0swdFMwaTBEck5neDFhYTZ4OVhLYW4wUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864342),('LmDOoAz33L9xNJko0Qk1yrdAr3ROGsq5ontlihuF',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicG44NU53V2wwNlVURndKVlRHRnhzbFFJV3ZWMXdoclQ5bjA1N2R4eiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865116),('LX2MUZuispkLKbMqVWzWVpKNfDlmh9CF2fgWFW3z',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFVqOXEzcUdLbmQxdzJkV0dRV1pqdjFBMk9NMHN0NDhHYTFFVzR1cSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865116),('MH8K9n3K5IWJKSSpgX5Emfg6j1D2igx6C7lE5BFg',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGF2SnprZE1ZdXJyczQ2RjYyS1pERkRCY00yQmRxcE1BSWxyNEk5eCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NzoibGFuZGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865784),('Mt2HPKaI4rCqzipNcbsBHPuMhZsezCSRs25HPQYz',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYzJJU1p6YTU3Y0IxaWR4amtmMnJnUkEzS0xyR3lwQUZEak5XNDhkbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865985),('N7TODDcNf0U23arqKbfdDHm3v6vh3ZiJGLf2x8O4',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidTlReUNLbnNzQU5EVTVnTzlxT1FrR0NteXlPU0RlangyMWIwUjhTSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779863788),('nGtbuDHmxdhMnUglDlcy1ylNV2iwv0vDR39hQ41h',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWdneUUwTHN2Qk1LQmVGUmJDOTRNTmUzc3lkbWxxcTEyNEdpcXVNSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NzoibGFuZGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865315),('NpjPMiuY4XmAXgbzizS9FP6wlAir9u7B8VR6FXai',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoib3JlRFBsQ0FzbjBBTUZkN0w0ZVdhcDl6Tkk1ZlNSeDF4OENmRmtIMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864212),('Nvym6dbiYQsvk3U79r5tJcE9QZCcCfmdpIJD7Lkg',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVRDckxhd1R4UnRaQmxRWkk2Yno3VDdwOFcwM2JPRkxvOVJNZXhadyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NzoibGFuZGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779866455),('oNiJb95O5kefaHWpa9I4iDhYrjVQxYF8KAYHDi4z',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQW44UHV4WGQ4RXpEd01OWThxR3h1eDFGN2NYSUUzeWtCajZtOTkwaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864245),('oUGelxTRTSGOvgn6aTps9k0eJs6W4dY4uonBj5Rc',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFdGNzZHVVBibzh6RGpUbHJMUTJxUkFIWU92TEs2Tjgya0d4djdMdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvcmVnaXN0ZXIiO3M6NToicm91dGUiO3M6ODoicmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865460),('ROSjM1XPB8UbWHlk5Fl1qRuajhMUG56f7IBpEfSp',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZm9KdXV5VEpwWXhmanpRQmhUWFZzWk02bk81STl6VXM3dWtweW1yaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvcmVnaXN0ZXIiO3M6NToicm91dGUiO3M6ODoicmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865554),('rZnlwrOC5nxy4JiHbWQCgE9yVQu4qBnsFcusz28L',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmNCOXRyd0RyRmQydUVMcklkZUloN1FzcUNtejRBUnlTTTFpRjBScCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865552),('s784FnwR2caWQPSry5da5yUc9n7FjGmqd9NMQrQ8',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoicmt0V0h0aGVtZEVGZ0xaTzJ4THFWTlNKbVV3ZVZYVE0wYVJHc25VVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1779866093),('SJRwDlPxfxihQAi2FtIT1kKPbsv4HPr26FSBhNRs',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkhVSVZOTlZjekxYZlo2TkdxWWNUYWdrdDczRFpjVWEwdW5URzliMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NzoibGFuZGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865141),('Srb36VS9v9Cntqrl7uNK8DMU4B76tiMYutKdOy4b',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnE0V2d1YTIyU2FMNUlBVk93VTNVR0JQWWQ5ZFV3cm9md2hudXRFVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NzoibGFuZGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865799),('sSUHXtvaZ0dB3iMeWxj6JycqrbQAciPw8SuNVu5F',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWc1aXh6OUFRYnl1dWZoZm5RakVHQUg4VVpFRDRCZGxuczk5NWdoNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779820509),('T5bkv5yZsgvmmKLATC0H9DgxkQ40vN8lYIcKtg4m',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoibHFMWlZhSFlyRG5qVDh1YnZxYUpWZ3MzaHY0OFVGSWtHelpCZUY0UyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779820509),('T8WooYkvVZznmstsXpfN1kuX8KIbUxiay8J28Zru',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoibVViTGNHdUlsZ0lwUHllTVFhbHdmekVEQ05NaHIyZ3d3a085MFc1aiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1779866067),('tasQee8h4NexR74V2HNwa5ZOez8p7rDpZ9k1e8dq',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFphQzFhcFZiUW9WVU9XYzFkVDc3VFQ3VUtOT2VWaEZyZUJaQmpYbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvcmVnaXN0ZXIiO3M6NToicm91dGUiO3M6ODoicmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865463),('tgv6QBn0NCZW009cRw9zPIMxYEGucuVrjTfxwnXx',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaElxd1V1eXlLZW1oS0NxRG5Ea3g1UFVEbTFtdnpmdUR2VzZMQm1zRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779863692),('tgz6uFrTtXGTrDIEYdCbMFyAFefFkjHYYcetn6ZB',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0JmNGpKZ2JzWU5GY2NJYkRpMHJTblNPNnBaSkxLZ0lFcVRGWXZUdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NzoibGFuZGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865985),('UYQOj6vMeM9ZIhIjgOpHgP5Is8AFb1ftdh0pctd1',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoib1ZKMWE0QlhGSUxJZzdWaVkzMVBKS1VUV0EyVzVHR2NyV1BxNDBrMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864677),('votwfbVkl0KCUumiN9DQcHeTmpHR2jvUaCRNpPKD',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGczVTFLaGlZWDZaQVYzQ092RlQ0ZVJ3WnRmM1VoZ2ZjQ0Z0Q1l6aiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779866076),('vUsQ1Yn1HqWiiaObV76ptsYugzbbwlaEGgZq4Try',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSE5GaXJ0YzZGc2NwVVFPNG1iYzZJQWxqVUh3M0p0OXNOVHhCd0Z5dSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779862915),('wFOcfkHHWssSNSP2MmPUhPtwS3gmgEpFOxsrAb05',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibnF4TUlVOGc0TWxLcW15N0xwS2V1ZTdDbElpY3VackI0djN6blU3TiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864260),('wfVxNXXODoSmh0csyxbMxjzwg9WsAunwyVn1B77B',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSnpaYWU5RW5VcmN5UHZyNXRpaVlER21PS2Y4RHhhdEdxQldETWFLaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864766),('WR7dcAKxIXCW4vMHhYFcX2YYW3eRDQwkSEaVS9o4',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlVFaWNhM2JvRllqZmFNcGxPdmhXTUR0cGlQOG1xZU9reDhoV2FzTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779863757),('WvrYbhZkB5vW2rhxjGFEsSmhIcouyLHzuHtkkUBz',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicU9oNUN3WHcwVG5HSENRWjNSeENUSk1iektyeDBtWGxXUVp3aDMyYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865322),('XL8vF9tSmGD5b3HYqK0KXxXUjP8M8FH0ZpDzMlHp',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoid2tLMWhrTnhCSTJnRXRkY2JiczhWZzIwc0ptMEVKNHg4Tk80Z2RPSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864244),('XQ2zWAtJncd8fZMLr8BjcACGrTkBBWhhq2lW95P0',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.105.0 Chrome/138.0.7204.251 Electron/37.6.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWtQTmtqaGUybkRSMkhJNEcxWll6cjFhampTOUdFbWJVSVNpd09PcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779863638),('YZvXTPbEEFBV3SxAN3ZErIrg6yAKGnrKMqiEDJ3u',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzl5QVg4elFDZzBwQ2VRZjZqYU1wc25teDhEWTBsYWNFT2VZd1VwdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMiO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779864175),('Z0uxJESmaWCN9l10txs7znHIRjoPh8uKXGZCBvnJ',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoieXRTV05BUmpiRk8wYkZQUEpGMXNDNUlEYmt0T1Jta0hlV3RCRU5pdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvcmVnaXN0ZXIiO3M6NToicm91dGUiO3M6ODoicmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1779865145),('ZT66XMiD6CzYnw1D9X2ChaMU6Z3ivAQYYNzjW7DP',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) AntigravityIDE/1.107.0 Chrome/142.0.7444.175 Electron/39.2.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoieXBveW1mVFd3S0JadXVJelV5MEt3djQzb0ZnVURXQlJrR1RsS3NyQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvZmlsa29tY2FyZS9wdWJsaWMvbG9naW4iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779865116);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nim` varchar(18) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_nim_unique` (`nim`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,NULL,'Ossameliaz10','ossameliaz10@student.ub.ac.id',NULL,NULL,NULL,'$2y$12$WgsltwGJMOglyIaAr3.q0OccgQFKoOomvsLegR5QXxpvlL872C65K',NULL,'2026-05-27 08:15:00','2026-05-27 08:15:00'),(3,NULL,'Syifaaul10','syifaaul10@student.ub.ac.id',NULL,NULL,NULL,'$2y$12$gOMuRvZQC79N.srrcik9pOUFDq1OpdXeWXe7VhOpVAv3tenF1FK0G',NULL,'2026-05-27 08:26:08','2026-05-27 08:26:08'),(4,NULL,'Shelfinakhayla_','shelfinakhayla_@student.ub.ac.id',NULL,NULL,NULL,'$2y$12$LrrV9BqqAKsxnVfdc1kfBO5fIEUXQCq8llAJujqrJWNrC.dmB1aN2',NULL,'2026-05-27 08:27:59','2026-05-27 08:27:59'),(8,'245150600111022','Ossameliaz','ossameliaz@student.ub.ac.id','081219382038','Pendidikan Teknologi Informasi','2026-05-27 17:01:44','$2y$12$NqGX9cDwlokWcaCw.tRCCOJxbSZD5l7GQMQRrXfQxaYHkAf8a6goW','DIARFeGFfdSlXVq15Wey376lhx7mrg5LKeFHHiPPNgoDBW4GvQHgpttQt0eT','2026-05-27 16:59:01','2026-05-27 17:02:41');
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

-- Dump completed on 2026-05-28  9:56:05
