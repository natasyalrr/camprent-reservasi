-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: camprent_db
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
-- Current Database: `camprent_db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `camprent_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `camprent_db`;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(220) NOT NULL,
  `content` longtext NOT NULL,
  `excerpt` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `author_id` bigint(20) unsigned DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `fk_articles_author` (`author_id`),
  CONSTRAINT `fk_articles_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Tips Memilih Tenda untuk Pemula','tips-memilih-tenda-untuk-pemula','Sesuaikan kapasitas tenda dengan jumlah pengguna. Periksa ketahanan hujan, berat bawaan, kelengkapan pasak, dan lokasi pendirian tenda.','Cara mencocokkan kapasitas, berat, dan ketahanan air tenda.',NULL,1,'published','2026-11-17 11:58:44','2026-11-17 11:58:44','2026-11-17 11:58:44'),(2,'Checklist Alat Camping Sebelum Berangkat','checklist-alat-camping','Periksa tenda, sleeping bag, lampu, peralatan masak, pakaian hangat, P3K, air minum, dan perangkat komunikasi. Pastikan kondisi setiap alat layak digunakan.','Perlengkapan dasar yang perlu dicek sebelum perjalanan.',NULL,1,'published','2026-11-17 11:58:44','2026-11-17 11:58:44','2026-11-17 11:58:44'),(3,'Panduan Camping Ringan dan Minimalis','panduan-camping-minimalis','Rencanakan kebutuhan sesuai cuaca, durasi dan jumlah peserta. Pilih alat multifungsi dan utamakan keselamatan, navigasi, serta pengelolaan sampah.','Strategi membawa alat seperlunya tanpa mengabaikan keselamatan.',NULL,1,'published','2026-11-17 11:58:44','2026-11-17 11:58:44','2026-11-17 11:58:44');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `entity_type` varchar(100) NOT NULL,
  `entity_id` varchar(80) DEFAULT NULL,
  `old_values` longtext DEFAULT NULL,
  `new_values` longtext DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_audit_logs_user` (`user_id`),
  CONSTRAINT `fk_audit_logs_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `basecamps`
--

DROP TABLE IF EXISTS `basecamps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `basecamps` (
  `id` varchar(32) NOT NULL,
  `city` varchar(80) NOT NULL,
  `branch_name` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `opening_hours` varchar(80) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `basecamps`
--

LOCK TABLES `basecamps` WRITE;
/*!40000 ALTER TABLE `basecamps` DISABLE KEYS */;
INSERT INTO `basecamps` VALUES ('bandung','Bandung','Basecamp Dago Pakar','Jl. Ir. H. Juanda No. 214, Coblong, Bandung','06.00 – 22.00 WIB','+62 811-2244-8890',1),('lombok','Lombok','Basecamp Sembalun Lawang','Jl. Wisata Gunung Rinjani KM 2, Sembalun','05.30 – 21.00 WITA','+62 819-1740-5501',1),('malang','Malang','Basecamp Tumpang','Jl. Raya Tumpang No. 48, Kab. Malang','05.00 – 21.30 WIB','+62 813-3391-7720',1),('yogyakarta','Yogyakarta','Basecamp Sleman Utara','Jl. Kaliurang KM 9.5, Ngaglik, Sleman','06.00 – 22.00 WIB','+62 812-2780-4410',1);
/*!40000 ALTER TABLE `basecamps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_items`
--

DROP TABLE IF EXISTS `booking_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `equipment_id` varchar(80) DEFAULT NULL,
  `package_id` varchar(80) DEFAULT NULL,
  `item_name` varchar(180) NOT NULL,
  `quantity` int(10) unsigned NOT NULL DEFAULT 1,
  `daily_rate` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_booking_items_booking` (`booking_id`),
  KEY `fk_booking_items_equipment` (`equipment_id`),
  KEY `fk_booking_items_package` (`package_id`),
  CONSTRAINT `fk_booking_items_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_booking_items_equipment` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`),
  CONSTRAINT `fk_booking_items_package` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`),
  CONSTRAINT `chk_booking_item_type` CHECK (`equipment_id` is not null and `package_id` is null or `equipment_id` is null and `package_id` is not null)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_items`
--

LOCK TABLES `booking_items` WRITE;
/*!40000 ALTER TABLE `booking_items` DISABLE KEYS */;
INSERT INTO `booking_items` VALUES (1,1,'tent-borneo-2p',NULL,'Tenda Dome Borneo 2P Alloy',1,45000.00,135000.00),(2,1,'sb-jayawijaya-down',NULL,'Sleeping Bag Mummy Jayawijaya 0°C',2,28000.00,168000.00),(3,2,NULL,'bundle-prau-pemula','Paket Santai Prau & Papandayan',1,98000.00,294000.00),(4,3,NULL,'bundle-rinjani-duo','Paket Rinjani Duo 3H2M',1,145000.00,580000.00),(5,3,'poles-carbon-cork',NULL,'Trekking Pole Karbon Gagang Gabus (Sepasang)',2,22000.00,176000.00),(6,4,'lantern-headlamp-kit',NULL,'Paket Penerangan Lentera & Headlamp 500Lm',2,20000.00,120000.00);
/*!40000 ALTER TABLE `booking_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_code` varchar(32) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `basecamp_id` varchar(32) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `renter_name` varchar(120) NOT NULL,
  `renter_email` varchar(190) NOT NULL,
  `renter_phone` varchar(30) NOT NULL,
  `destination_mountain` varchar(180) DEFAULT NULL,
  `total_days` int(10) unsigned NOT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `booking_status` enum('pending','confirmed','rented','rejected','cancelled','completed') NOT NULL DEFAULT 'pending',
  `payment_status` enum('unpaid','pending','paid','refunded') NOT NULL DEFAULT 'unpaid',
  `notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_code` (`booking_code`),
  KEY `fk_bookings_user` (`user_id`),
  KEY `fk_bookings_basecamp` (`basecamp_id`),
  CONSTRAINT `fk_bookings_basecamp` FOREIGN KEY (`basecamp_id`) REFERENCES `basecamps` (`id`),
  CONSTRAINT `fk_bookings_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `chk_booking_dates` CHECK (`end_date` >= `start_date`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,'CR-2611-0841',4,'yogyakarta','2026-11-15','2026-11-17','Raka Mahendra','legacy-booking-1@example.invalid','0812-8840-1129','Gunung Merbabu via Selo',3,303000.00,303000.00,'rented','paid','KTP Asli dititipkan di Basecamp Sleman Utara. Alat lengkap sudah dicek bersama penyewa pukul 07.15 WIB.','2026-11-14 19:20:00','2026-11-17 12:02:25'),(2,'CR-2611-0845',5,'bandung','2026-11-20','2026-11-22','Nadia Kusuma','legacy-booking-2@example.invalid','0856-9102-3341','Gunung Papandayan',3,294000.00,294000.00,'pending','pending','Menunggu pelunasan sebelum H-1 pengambilan.','2026-11-16 04:40:00','2026-11-17 12:02:25'),(3,'CR-2611-0838',6,'lombok','2026-11-21','2026-11-24','Dimas Prasetyo','legacy-booking-3@example.invalid','0813-4410-9802','Gunung Rinjani via Sembalun',4,756000.00,756000.00,'confirmed','paid','Pembayaran lunas via QRIS. Siap diambil 21 Nov pukul 06.00 WITA. Sudah disiapkan di rak B-04 Sembalun.','2026-11-15 14:05:00','2026-11-17 12:02:25'),(4,'CR-2611-0819',7,'malang','2026-11-10','2026-11-12','Siti Rahmawati','legacy-booking-4@example.invalid','0821-7712-0045','Gunung Bromo & Penanjakan',3,120000.00,120000.00,'completed','paid','Alat kembali lengkap dan KTP sudah dikembalikan. Lulus inspeksi pengembalian tanpa kerusakan.','2026-11-09 11:12:00','2026-11-17 12:02:25');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cancellations`
--

DROP TABLE IF EXISTS `cancellations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cancellations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `refund_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `refund_status` enum('not_required','pending','processed') NOT NULL DEFAULT 'not_required',
  `refund_notes` text DEFAULT NULL,
  `reviewed_by` bigint(20) unsigned DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_cancellations_booking` (`booking_id`),
  KEY `fk_cancellations_staff` (`reviewed_by`),
  CONSTRAINT `fk_cancellations_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  CONSTRAINT `fk_cancellations_staff` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cancellations`
--

LOCK TABLES `cancellations` WRITE;
/*!40000 ALTER TABLE `cancellations` DISABLE KEYS */;
/*!40000 ALTER TABLE `cancellations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Tenda & Shelter',1),(2,'Carrier & Tas',1),(3,'Tidur & Termal',1),(4,'Masak & Dapur',1),(5,'Navigasi & Safety',1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `damage_reports`
--

DROP TABLE IF EXISTS `damage_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `damage_reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `return_id` bigint(20) unsigned NOT NULL,
  `equipment_id` varchar(80) NOT NULL,
  `damage_type` enum('damaged','missing') NOT NULL,
  `quantity` int(10) unsigned NOT NULL DEFAULT 1,
  `description` text NOT NULL,
  `replacement_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `compensation_status` enum('pending','paid','waived') NOT NULL DEFAULT 'pending',
  `reported_by` bigint(20) unsigned DEFAULT NULL,
  `resolved_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_damage_return` (`return_id`),
  KEY `fk_damage_equipment` (`equipment_id`),
  KEY `fk_damage_staff` (`reported_by`),
  CONSTRAINT `fk_damage_equipment` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`),
  CONSTRAINT `fk_damage_return` FOREIGN KEY (`return_id`) REFERENCES `returns` (`id`),
  CONSTRAINT `fk_damage_staff` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `damage_reports`
--

LOCK TABLES `damage_reports` WRITE;
/*!40000 ALTER TABLE `damage_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `damage_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deposit_records`
--

DROP TABLE IF EXISTS `deposit_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposit_records` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `deposit_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `deduction_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `refund_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `deposit_status` enum('pending','received','partially_refunded','refunded','forfeited') NOT NULL DEFAULT 'pending',
  `received_at` datetime DEFAULT NULL,
  `refunded_at` datetime DEFAULT NULL,
  `processed_by` bigint(20) unsigned DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_deposit_booking` (`booking_id`),
  KEY `fk_deposit_staff` (`processed_by`),
  CONSTRAINT `fk_deposit_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  CONSTRAINT `fk_deposit_staff` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposit_records`
--

LOCK TABLES `deposit_records` WRITE;
/*!40000 ALTER TABLE `deposit_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `deposit_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment` (
  `id` varchar(80) NOT NULL,
  `sku` varchar(32) NOT NULL,
  `name` varchar(180) NOT NULL,
  `category_id` smallint(5) unsigned NOT NULL,
  `brand` varchar(120) NOT NULL,
  `daily_rate` decimal(12,2) NOT NULL,
  `weight_kg` decimal(8,3) DEFAULT NULL,
  `capacity_label` varchar(120) DEFAULT NULL,
  `weather_rating` varchar(180) DEFAULT NULL,
  `dimensions` varchar(220) DEFAULT NULL,
  `material` varchar(250) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `sku` (`sku`),
  KEY `fk_equipment_category` (`category_id`),
  CONSTRAINT `fk_equipment_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment`
--

LOCK TABLES `equipment` WRITE;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
INSERT INTO `equipment` VALUES ('carrier-kerinci-60','CRR-004','Carrier Kerinci 60L Expedition',2,'Merapi Craft',35000.00,1.650,'60 Liter','Cordura 420D + Raincover','72 × 34 × 26 cm','Nylon Cordura Ripstop & Back-System Aluminium Stay','assets/images/gear_carrier_backpack_1794834252855.jpg','Tas gunung kapasitas 60L dengan torso adjustable untuk postur pendaki Nusantara. Bantalan pinggang ergonomis memindahkan hingga 70% beban dari bahu saat tanjakan panjang.',1,'2026-11-17 11:48:58','2026-11-17 11:48:58'),('lantern-headlamp-kit','NVG-007','Paket Penerangan Lentera & Headlamp 500Lm',5,'Surya Rimba',20000.00,0.420,'IPX6 Tahan Hujan','USB-C Rechargeable · 48 Jam','Lentera 16 cm + Headlamp Compact','Kuningan Anodized, ABS Tahan Bentur & Strap Reflektif','assets/images/gear_lantern_headlamp_1794834254045.jpg','Kombinasi lentera hangat untuk suasana tenda dan headlamp sorot 500 lumens untuk summit attack dini hari. Seluruh unit diserahkan dalam kondisi baterai penuh 100%.',1,'2026-11-17 11:48:58','2026-11-17 11:48:58'),('poles-carbon-cork','NVG-011','Trekking Pole Karbon Gagang Gabus (Sepasang)',5,'Nusantara Alpine',22000.00,0.390,'Tinggi 65–135 cm','Tungsten Tip + Mud Basket','Terlipat 62 cm · Rentang 135 cm','3K Carbon Fiber Shaft & Natural Cork Grip','assets/images/gear_trekking_poles_1794834254611.jpg','Mengurangi beban lutut hingga 25% saat turunan curam berbatu dan berpasir seperti jalur Plawangan Sembalun atau Tanjakan Cinta Semeru.',1,'2026-11-17 11:48:58','2026-11-17 11:48:58'),('sb-jayawijaya-down','TDR-002','Sleeping Bag Mummy Jayawijaya 0°C',3,'Archipelago Down',28000.00,0.950,'Suhu 0°C – 10°C','Hydrophobic Duck Down 650FP','215 × 80 cm (Packed 24 × 15 cm)','20D Ripstop Nylon Shell + Dacron/Down Hybrid Fill','assets/images/gear_sleeping_bag_1794834252646.jpg','Kantung tidur model mummy untuk suhu puncak Rinjani, Semeru, dan Prau. Dicuci dan disanitasi ozon setelah setiap pengembalian demi kenyamanan tidur di alam terbuka.',1,'2026-11-17 11:48:58','2026-11-17 11:48:58'),('stove-titanium-set','MSK-003','Kompor Titanium & Nesting Cookset',4,'Kaldera Gear',25000.00,0.580,'2–3 Pendaki','Wind-Resistant 3200W','Panci 1.0L + 0.7L + Mug 350ml','Titanium Burner + Hard-Anodized Aluminium','assets/images/gear_stove_cookset_1794834253945.jpg','Set dapur pendakian ringkas berdaya api tinggi namun hemat gas kaleng ulir. Seluruh komponen panci dan kompor masuk rapi ke dalam satu kantong jaring anti-gores.',1,'2026-11-17 11:48:58','2026-11-17 11:48:58'),('tent-borneo-2p','TND-001','Tenda Dome Borneo 2P Alloy',1,'Nusantara Alpine',45000.00,2.100,'2 Orang','PU 3000mm · Double Layer','210 × 140 × 110 cm','210T Ripstop Polyester + Frame 7001 Alloy','assets/images/gear_tent_dome_1794834252489.jpg','Tenda dome dua lapis berkonstruksi frame alloy yang kokoh menghadapi angin punggungan gunung tropis. Dilengkapi teras ganda untuk menyimpan carrier dan sepatu agar bagian dalam tetap kering.',1,'2026-11-17 11:48:58','2026-11-17 11:48:58');
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment_checklists`
--

DROP TABLE IF EXISTS `equipment_checklists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment_checklists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `equipment_id` varchar(80) NOT NULL,
  `item_text` varchar(255) NOT NULL,
  `sort_order` smallint(5) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_checklist_equipment` (`equipment_id`),
  CONSTRAINT `fk_checklist_equipment` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment_checklists`
--

LOCK TABLES `equipment_checklists` WRITE;
/*!40000 ALTER TABLE `equipment_checklists` DISABLE KEYS */;
INSERT INTO `equipment_checklists` VALUES (1,'tent-borneo-2p','1× Inner tent breathable mesh',1),(2,'tent-borneo-2p','1× Outer flysheet seam-sealed',2),(3,'tent-borneo-2p','2× Set frame aluminium alloy 8.5mm',3),(4,'tent-borneo-2p','12× Pasak V-shape alloy + 4 guyline reflektif',4),(5,'tent-borneo-2p','1× Footprint alas pelindung',5),(6,'carrier-kerinci-60','1× Tas Carrier Kerinci 60L',1),(7,'carrier-kerinci-60','1× Integrated waterproof raincover',2),(8,'carrier-kerinci-60','2× Aluminium internal stay terpasang',3),(9,'carrier-kerinci-60','1× Peluit darurat pada chest strap',4),(10,'sb-jayawijaya-down','1× Sleeping bag model mummy',1),(11,'sb-jayawijaya-down','1× Compression sack 4-strap',2),(12,'sb-jayawijaya-down','1× Inner liner katun higienis tersegel',3),(13,'stove-titanium-set','1× Kompor lipat windproof + pemantik piezo',1),(14,'stove-titanium-set','1× Panci besar 1.0L & wajan tutup 0.7L',2),(15,'stove-titanium-set','1× Mug aluminium lipat 350ml',3),(16,'stove-titanium-set','1× Spons pembersih & kantong jaring',4),(17,'lantern-headlamp-kit','1× Lentera kemah warm-dimmable USB-C',1),(18,'lantern-headlamp-kit','1× Headlamp 500 Lumens mode red-light SOS',2),(19,'lantern-headlamp-kit','1× Kabel pengisian USB-C braided',3),(20,'lantern-headlamp-kit','1× Kotak penyimpanan EVA keras',4),(21,'poles-carbon-cork','2× Tongkat trekking karbon kiri & kanan',1),(22,'poles-carbon-cork','2× Karet pelindung ujung (rubber tip)',2),(23,'poles-carbon-cork','2× Mud basket untuk jalur berlumpur',3);
/*!40000 ALTER TABLE `equipment_checklists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment_inspections`
--

DROP TABLE IF EXISTS `equipment_inspections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment_inspections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `equipment_id` varchar(80) NOT NULL,
  `basecamp_id` varchar(32) DEFAULT NULL,
  `condition_status` enum('Prima','Perlu Cuci','Servis Ringan','Rusak') NOT NULL,
  `inspected_on` date NOT NULL,
  `note` text DEFAULT NULL,
  `inspector_user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_inspection_equipment` (`equipment_id`),
  KEY `fk_inspection_basecamp` (`basecamp_id`),
  KEY `fk_inspection_user` (`inspector_user_id`),
  CONSTRAINT `fk_inspection_basecamp` FOREIGN KEY (`basecamp_id`) REFERENCES `basecamps` (`id`),
  CONSTRAINT `fk_inspection_equipment` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`),
  CONSTRAINT `fk_inspection_user` FOREIGN KEY (`inspector_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment_inspections`
--

LOCK TABLES `equipment_inspections` WRITE;
/*!40000 ALTER TABLE `equipment_inspections` DISABLE KEYS */;
INSERT INTO `equipment_inspections` VALUES (1,'tent-borneo-2p',NULL,'Prima','2026-11-14','Seam tape baru diperbarui, seluruh resleting YKK lancar, kain kering higienis.',NULL,'2026-11-17 11:53:15'),(2,'carrier-kerinci-60',NULL,'Prima','2026-11-15','Busa back-system sudah dicuci uap antibakteri, buckle acetal utuh.',NULL,'2026-11-17 11:53:15'),(3,'sb-jayawijaya-down',NULL,'Prima','2026-11-15','Baru kembali dari sanitasi ozon & pengeringan udara dingin, loft masih penuh.',NULL,'2026-11-17 11:53:15'),(4,'stove-titanium-set',NULL,'Perlu Cuci','2026-11-13','Spuyer api bersih dan biru; 2 unit cadangan sedang dalam proses bilas akhir.',NULL,'2026-11-17 11:53:15'),(5,'lantern-headlamp-kit',NULL,'Prima','2026-11-16','Seluruh baterai diuji kapasitas >95%, seal karet USB-C rapat.',NULL,'2026-11-17 11:53:15'),(6,'poles-carbon-cork',NULL,'Servis Ringan','2026-11-12','Flip-lock dikalibrasi ulang agar tidak selip saat menopang beban penuh.',NULL,'2026-11-17 11:53:15');
/*!40000 ALTER TABLE `equipment_inspections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment_stocks`
--

DROP TABLE IF EXISTS `equipment_stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment_stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `equipment_id` varchar(80) NOT NULL,
  `basecamp_id` varchar(32) NOT NULL,
  `total_units` int(10) unsigned NOT NULL DEFAULT 0,
  `unavailable_units` int(10) unsigned NOT NULL DEFAULT 0,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_equipment_basecamp` (`equipment_id`,`basecamp_id`),
  KEY `fk_stock_basecamp` (`basecamp_id`),
  CONSTRAINT `fk_stock_basecamp` FOREIGN KEY (`basecamp_id`) REFERENCES `basecamps` (`id`),
  CONSTRAINT `fk_stock_equipment` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment_stocks`
--

LOCK TABLES `equipment_stocks` WRITE;
/*!40000 ALTER TABLE `equipment_stocks` DISABLE KEYS */;
INSERT INTO `equipment_stocks` VALUES (1,'tent-borneo-2p','bandung',8,0,'2026-11-17 11:51:54'),(2,'tent-borneo-2p','yogyakarta',6,0,'2026-11-17 11:51:54'),(3,'tent-borneo-2p','malang',10,0,'2026-11-17 11:51:54'),(4,'tent-borneo-2p','lombok',7,0,'2026-11-17 11:51:54'),(5,'carrier-kerinci-60','bandung',11,0,'2026-11-17 11:51:54'),(6,'carrier-kerinci-60','yogyakarta',9,0,'2026-11-17 11:51:54'),(7,'carrier-kerinci-60','malang',14,0,'2026-11-17 11:51:54'),(8,'carrier-kerinci-60','lombok',8,0,'2026-11-17 11:51:54'),(9,'sb-jayawijaya-down','bandung',14,0,'2026-11-17 11:51:54'),(10,'sb-jayawijaya-down','yogyakarta',12,0,'2026-11-17 11:51:54'),(11,'sb-jayawijaya-down','malang',16,0,'2026-11-17 11:51:54'),(12,'sb-jayawijaya-down','lombok',10,0,'2026-11-17 11:51:54'),(13,'stove-titanium-set','bandung',9,0,'2026-11-17 11:51:54'),(14,'stove-titanium-set','yogyakarta',8,0,'2026-11-17 11:51:54'),(15,'stove-titanium-set','malang',11,0,'2026-11-17 11:51:54'),(16,'stove-titanium-set','lombok',6,0,'2026-11-17 11:51:54'),(17,'lantern-headlamp-kit','bandung',12,0,'2026-11-17 11:51:54'),(18,'lantern-headlamp-kit','yogyakarta',10,0,'2026-11-17 11:51:54'),(19,'lantern-headlamp-kit','malang',15,0,'2026-11-17 11:51:54'),(20,'lantern-headlamp-kit','lombok',9,0,'2026-11-17 11:51:54'),(21,'poles-carbon-cork','bandung',7,0,'2026-11-17 11:51:54'),(22,'poles-carbon-cork','yogyakarta',8,0,'2026-11-17 11:51:54'),(23,'poles-carbon-cork','malang',12,0,'2026-11-17 11:51:54'),(24,'poles-carbon-cork','lombok',5,0,'2026-11-17 11:51:54');
/*!40000 ALTER TABLE `equipment_stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_items`
--

DROP TABLE IF EXISTS `package_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` varchar(80) NOT NULL,
  `equipment_id` varchar(80) NOT NULL,
  `quantity` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_package_equipment` (`package_id`,`equipment_id`),
  KEY `fk_package_items_equipment` (`equipment_id`),
  CONSTRAINT `fk_package_items_equipment` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`),
  CONSTRAINT `fk_package_items_package` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_items`
--

LOCK TABLES `package_items` WRITE;
/*!40000 ALTER TABLE `package_items` DISABLE KEYS */;
INSERT INTO `package_items` VALUES (1,'bundle-rinjani-duo','tent-borneo-2p',1),(2,'bundle-rinjani-duo','carrier-kerinci-60',2),(3,'bundle-rinjani-duo','sb-jayawijaya-down',2),(4,'bundle-rinjani-duo','stove-titanium-set',1),(5,'bundle-rinjani-duo','lantern-headlamp-kit',1),(6,'bundle-prau-pemula','tent-borneo-2p',1),(7,'bundle-prau-pemula','sb-jayawijaya-down',2),(8,'bundle-prau-pemula','stove-titanium-set',1),(9,'bundle-prau-pemula','lantern-headlamp-kit',1),(10,'bundle-solo-ultralight','carrier-kerinci-60',1),(11,'bundle-solo-ultralight','sb-jayawijaya-down',1),(12,'bundle-solo-ultralight','stove-titanium-set',1),(13,'bundle-solo-ultralight','lantern-headlamp-kit',1),(14,'bundle-solo-ultralight','poles-carbon-cork',1);
/*!40000 ALTER TABLE `package_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` varchar(80) NOT NULL,
  `name` varchar(180) NOT NULL,
  `mountain_target` varchar(255) DEFAULT NULL,
  `duration_label` varchar(100) DEFAULT NULL,
  `capacity_label` varchar(100) DEFAULT NULL,
  `daily_rate` decimal(12,2) NOT NULL,
  `normal_daily_rate` decimal(12,2) NOT NULL,
  `total_weight_kg` decimal(8,3) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES ('bundle-prau-pemula','Paket Santai Prau & Papandayan','Gunung Prau · Papandayan · Andong','Rekomendasi 2 Hari 1 Malam','Untuk 2 Pendaki',98000.00,118000.00,4.900,'Dirancang untuk pendakian akhir pekan yang ringan dan nyaman. Sudah termasuk tenda dome 2 orang, dua sleeping bag hangat, kompor nesting, dan lentera tenda.','assets/images/gear_tent_dome_1794834252489.jpg',1),('bundle-rinjani-duo','Paket Rinjani Duo 3H2M','Gunung Rinjani · Semeru · Kerinci','Rekomendasi 3–4 Hari','Untuk 2 Pendaki',145000.00,175000.00,7.100,'Paket ekspedisi gunung tinggi lengkap untuk berdua. Menggabungkan tenda tahan badai, dua sleeping bag hangat 0°C, carrier 60L, kompor titanium, dan penerangan.','assets/images/hero_rinjani_camp_1794834252057.jpg',1),('bundle-solo-ultralight','Paket Solo Summit Tracker','Merbabu · Sindoro · Sumbing','Rekomendasi 2–3 Hari','Untuk 1 Pendaki',88000.00,105000.00,3.400,'Set lengkap pendaki solo yang mengutamakan efisiensi bobot: carrier 60L ergonomis, sleeping bag 0°C, set kompor titanium, headlamp 500Lm, dan trekking pole karbon.','assets/images/gear_carrier_backpack_1794834252855.jpg',1);
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `payment_code` varchar(50) NOT NULL,
  `payment_method` enum('bank_transfer','e_wallet','cash','dummy') NOT NULL DEFAULT 'dummy',
  `amount` decimal(12,2) NOT NULL,
  `payment_status` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `payment_proof` varchar(255) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `payment_code` (`payment_code`),
  KEY `fk_payments_booking` (`booking_id`),
  CONSTRAINT `fk_payments_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pickup_records`
--

DROP TABLE IF EXISTS `pickup_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pickup_records` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `pickup_code` varchar(50) NOT NULL,
  `picked_up_at` datetime DEFAULT NULL,
  `verified_by` bigint(20) unsigned DEFAULT NULL,
  `pickup_status` enum('pending','verified','handed_over') NOT NULL DEFAULT 'pending',
  `checklist_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_id` (`booking_id`),
  UNIQUE KEY `pickup_code` (`pickup_code`),
  KEY `fk_pickup_staff` (`verified_by`),
  CONSTRAINT `fk_pickup_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  CONSTRAINT `fk_pickup_staff` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_records`
--

LOCK TABLES `pickup_records` WRITE;
/*!40000 ALTER TABLE `pickup_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `pickup_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return_items`
--

DROP TABLE IF EXISTS `return_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `return_id` bigint(20) unsigned NOT NULL,
  `equipment_id` varchar(80) NOT NULL,
  `quantity_returned` int(10) unsigned NOT NULL DEFAULT 1,
  `quantity_damaged` int(10) unsigned NOT NULL DEFAULT 0,
  `quantity_missing` int(10) unsigned NOT NULL DEFAULT 0,
  `condition_status` enum('Prima','Perlu Cuci','Servis Ringan','Rusak','Hilang') NOT NULL DEFAULT 'Prima',
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_return_items_return` (`return_id`),
  KEY `fk_return_items_equipment` (`equipment_id`),
  CONSTRAINT `fk_return_items_equipment` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`),
  CONSTRAINT `fk_return_items_return` FOREIGN KEY (`return_id`) REFERENCES `returns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return_items`
--

LOCK TABLES `return_items` WRITE;
/*!40000 ALTER TABLE `return_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `return_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `returns`
--

DROP TABLE IF EXISTS `returns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `returns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) unsigned NOT NULL,
  `returned_at` datetime NOT NULL,
  `received_by` bigint(20) unsigned DEFAULT NULL,
  `return_status` enum('complete','damaged','missing','partial') NOT NULL DEFAULT 'complete',
  `notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_id` (`booking_id`),
  KEY `fk_returns_staff` (`received_by`),
  CONSTRAINT `fk_returns_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  CONSTRAINT `fk_returns_staff` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `returns`
--

LOCK TABLES `returns` WRITE;
/*!40000 ALTER TABLE `returns` DISABLE KEYS */;
/*!40000 ALTER TABLE `returns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(120) NOT NULL,
  `email` varchar(190) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('user','staff','admin') NOT NULL DEFAULT 'user',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator Demo','admin@demo.test',NULL,'$2y$12$pFQI3K5j1iAYCZH8KWaNrerXSLhsNYnCujnV8c.HyRtKnqEaUo8Iy','admin',1,'2026-11-17 11:56:56','2026-11-17 11:56:56'),(2,'Staff Demo','staff@demo.test',NULL,'$2y$12$9MjKfSuebkrE7jp7xrKT1.JERPVwMSRmfqd.Fl50kZsaJ18Q/AyD.','staff',1,'2026-11-17 11:56:56','2026-11-17 11:56:56'),(3,'User Demo','user@demo.test',NULL,'$2y$12$XxM42bJZTe6Hq42mg/qmsObVQBaE5V0OfyjkOnZ2gGp6CqgTgyL0i','user',1,'2026-11-17 11:56:56','2026-11-17 11:56:56'),(4,'Raka Mahendra','legacy-booking-1@example.invalid','0812-8840-1129','$2y$12$.EGegzWZPxH5Dkza9MEQoOUDTaqvGTe/M0ZRIF2xVUgJ647LGr4q2','user',0,'2026-11-17 12:00:13','2026-11-17 12:00:13'),(5,'Nadia Kusuma','legacy-booking-2@example.invalid','0856-9102-3341','$2y$12$fbFOvMXsGdSragH/bys4DeEC752riMZg5hLt.Hp3d0L.wr5Sgjevu','user',0,'2026-11-17 12:00:13','2026-11-17 12:00:13'),(6,'Dimas Prasetyo','legacy-booking-3@example.invalid','0813-4410-9802','$2y$12$fu3Oo1zbjokT6VPgL9mRz.z0c1z4faJpZ93FVd4YxRbM/ad.SVfqW','user',0,'2026-11-17 12:00:13','2026-11-17 12:00:13'),(7,'Siti Rahmawati','legacy-booking-4@example.invalid','0821-7712-0045','$2y$12$mHtKoQNy47OKWGBlJ3yNi.LT/nN2IQ1ub1KSMne1wtQmM95XKTOLK','user',0,'2026-11-17 12:00:13','2026-11-17 12:00:13');
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

-- Dump completed on 2026-11-17 17:31:39
