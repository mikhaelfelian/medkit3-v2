-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_medkit3v2.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.migrations: ~11 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(13, '2024-01-03-000001', 'App\\Database\\Migrations\\CreatePengaturanTable', 'default', 'App', 1736405633, 1),
	(14, '2024-01-03-000002', 'App\\Database\\Migrations\\CreatePengaturanThemeTable', 'default', 'App', 1736405633, 1),
	(15, '20181211100537', 'IonAuth\\Database\\Migrations\\Migration_Install_ion_auth', 'default', 'IonAuth', 1736405637, 2),
	(16, '2024-01-04-000001', 'App\\Database\\Migrations\\CreateMSatuanTable', 'default', 'App', 1736440299, 3),
	(17, '2024_01_10_000004', 'App\\Database\\Migrations\\CreateTblMKategori', 'default', 'App', 1736502611, 4),
	(18, '2024_01_10_000005', 'App\\Database\\Migrations\\CreateTblMMerk', 'default', 'App', 1736511229, 5),
	(19, '2024_01_10_000006', 'App\\Database\\Migrations\\CreateTblMItem', 'default', 'App', 1736518788, 6),
	(20, '2024_01_10_000007', 'App\\Database\\Migrations\\CreateTblMGudang', 'default', 'App', 1736519880, 7),
	(21, '2024_01_10_000008', 'App\\Database\\Migrations\\CreateTblMItemStok', 'default', 'App', 1736520310, 8),
	(22, '2024_01_10_000009', 'App\\Database\\Migrations\\Migration_Create_tbl_m_item_ref', 'default', 'App', 1736526666, 9),
	(23, '2024_01_12_000001', 'App\\Database\\Migrations\\CreateTblMPoli', 'default', 'App', 1736761838, 10),
	(24, '2024_01_13_000001', 'App\\Database\\Migrations\\CreateTblMPenjamin', 'default', 'App', 1736764479, 11),
	(25, '2024_01_13_000002', 'App\\Database\\Migrations\\Migration_2024_01_13_000002_create_tbl_m_gelar', 'default', 'App', 1736771549, 12);

-- Dumping structure for table db_medkit3v2.tbl_ion_groups
DROP TABLE IF EXISTS `tbl_ion_groups`;
CREATE TABLE IF NOT EXISTS `tbl_ion_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_ion_groups: ~18 rows (approximately)
DELETE FROM `tbl_ion_groups`;
INSERT INTO `tbl_ion_groups` (`id`, `name`, `description`) VALUES
	(1, 'root', 'Root - Highest Level Access'),
	(2, 'superadmin', 'Super Administrator'),
	(3, 'manager', 'Manager'),
	(4, 'supervisor', 'Supervisor'),
	(5, 'admin_staff', 'Admin Staff'),
	(6, 'admin_gudang', 'Admin Gudang'),
	(7, 'dokter', 'Dokter'),
	(8, 'perawat_rj', 'Perawat Rawat Jalan'),
	(9, 'perawat_ri', 'Perawat Rawat Inap'),
	(10, 'farmasi_user', 'Farmasi User'),
	(11, 'farmasi_spv', 'Farmasi SPV'),
	(12, 'radiografer_spv', 'Radiografer SPV'),
	(13, 'radiografer_user', 'Radiografer User'),
	(14, 'analis_spv', 'Analis SPV'),
	(15, 'analis_user', 'Analis User'),
	(16, 'kasir', 'Kasir'),
	(17, 'pasien', 'Pasien'),
	(18, 'non_entry', 'Non Entry');

-- Dumping structure for table db_medkit3v2.tbl_ion_login_attempts
DROP TABLE IF EXISTS `tbl_ion_login_attempts`;
CREATE TABLE IF NOT EXISTS `tbl_ion_login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_ion_login_attempts: ~0 rows (approximately)
DELETE FROM `tbl_ion_login_attempts`;

-- Dumping structure for table db_medkit3v2.tbl_ion_users
DROP TABLE IF EXISTS `tbl_ion_users`;
CREATE TABLE IF NOT EXISTS `tbl_ion_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `activation_selector` (`activation_selector`),
  UNIQUE KEY `forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_ion_users: ~18 rows (approximately)
DELETE FROM `tbl_ion_users`;
INSERT INTO `tbl_ion_users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
	(1, '127.0.0.1', 'root', '$2y$10$gQoEoZYp8Rz2iK9m.c1nZOQ3mJy53.Bb89WoV4m9/RxUTRVpY2FGW', 'root@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1736849384, 1, 'Root', 'Admin', 'ADMIN', '0'),
	(2, '127.0.0.1', 'superadmin', '$2y$10$gQoEoZYp8Rz2iK9m.c1nZOQ3mJy53.Bb89WoV4m9/RxUTRVpY2FGW', 'superadmin@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Super', 'Admin', 'ADMIN', '0'),
	(3, '127.0.0.1', 'manager', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'manager@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Manager', 'User', 'ADMIN', '0'),
	(4, '127.0.0.1', 'supervisor', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'supervisor@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Supervisor', 'User', 'ADMIN', '0'),
	(5, '127.0.0.1', 'admin.staff', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'admin.staff@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'Staff', 'ADMIN', '0'),
	(6, '127.0.0.1', 'admin.gudang', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'admin.gudang@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'Gudang', 'ADMIN', '0'),
	(7, '127.0.0.1', 'dokter', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'dokter@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Dokter', 'User', 'ADMIN', '0'),
	(8, '127.0.0.1', 'perawat.rj', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'perawat.rj@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Perawat', 'RJ', 'ADMIN', '0'),
	(9, '127.0.0.1', 'perawat.ri', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'perawat.ri@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Perawat', 'RI', 'ADMIN', '0'),
	(10, '127.0.0.1', 'farmasi.user', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'farmasi.user@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Farmasi', 'User', 'ADMIN', '0'),
	(11, '127.0.0.1', 'farmasi.spv', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'farmasi.spv@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Farmasi', 'SPV', 'ADMIN', '0'),
	(12, '127.0.0.1', 'radiografer_spv', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'radiografer.spv@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Radiografer', 'SPV', 'ADMIN', '0'),
	(13, '127.0.0.1', 'radiografer_user', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'radiografer.user@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Radiografer', 'User', 'ADMIN', '0'),
	(14, '127.0.0.1', 'analis_spv', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'analis.spv@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Analis', 'SPV', 'ADMIN', '0'),
	(15, '127.0.0.1', 'analis_user', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'analis.user@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Analis', 'User', 'ADMIN', '0'),
	(16, '127.0.0.1', 'kasir', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'kasir@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Kasir', 'User', 'ADMIN', '0'),
	(17, '127.0.0.1', 'pasien', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'pasien@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Pasien', 'User', 'ADMIN', '0'),
	(18, '127.0.0.1', 'non.entry', '$2y$10$YpTvAzjvC5BEr1tdFOg3wOoZPgk90zfHHOoNOsG7f.J8qWWHVnkZe', 'non.entry@app.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Non', 'Entry', 'ADMIN', '0');

-- Dumping structure for table db_medkit3v2.tbl_ion_users_groups
DROP TABLE IF EXISTS `tbl_ion_users_groups`;
CREATE TABLE IF NOT EXISTS `tbl_ion_users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `access` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_ion_users_groups_user_id_foreign` (`user_id`),
  KEY `tbl_ion_users_groups_group_id_foreign` (`group_id`),
  CONSTRAINT `tbl_ion_users_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `tbl_ion_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tbl_ion_users_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_ion_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_ion_users_groups: ~18 rows (approximately)
DELETE FROM `tbl_ion_users_groups`;
INSERT INTO `tbl_ion_users_groups` (`id`, `user_id`, `group_id`, `access`) VALUES
	(1, 1, 1, NULL),
	(2, 2, 2, NULL),
	(3, 3, 3, NULL),
	(4, 4, 4, NULL),
	(5, 5, 5, NULL),
	(6, 6, 6, NULL),
	(7, 7, 7, NULL),
	(8, 8, 8, NULL),
	(9, 9, 9, NULL),
	(10, 10, 10, NULL),
	(11, 11, 11, NULL),
	(12, 12, 12, NULL),
	(13, 13, 13, NULL),
	(14, 14, 14, NULL),
	(15, 15, 15, NULL),
	(16, 16, 16, NULL),
	(17, 17, 17, NULL),
	(18, 18, 18, NULL);

-- Dumping structure for table db_medkit3v2.tbl_m_gelar
DROP TABLE IF EXISTS `tbl_m_gelar`;
CREATE TABLE IF NOT EXISTS `tbl_m_gelar` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `gelar` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_m_gelar: ~4 rows (approximately)
DELETE FROM `tbl_m_gelar`;
INSERT INTO `tbl_m_gelar` (`id`, `created_at`, `updated_at`, `gelar`, `keterangan`) VALUES
	(2, '2025-01-13 12:53:08', '2025-01-13 12:53:08', 'AN.', 'Anak'),
	(3, '2025-01-13 12:53:22', '2025-01-13 12:53:22', 'NN.', 'Nona'),
	(4, '2025-01-13 12:53:34', '2025-01-13 12:53:34', 'NY.', 'Nyonya'),
	(5, '2025-01-13 12:53:44', '2025-01-13 12:53:44', 'TN.', 'Tuan');

-- Dumping structure for table db_medkit3v2.tbl_m_gudang
DROP TABLE IF EXISTS `tbl_m_gudang`;
CREATE TABLE IF NOT EXISTS `tbl_m_gudang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `kode` varchar(160) DEFAULT NULL,
  `gudang` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL COMMENT '1 = aktif\\r\\n0 = Non Aktif',
  `status_gd` enum('0','1') DEFAULT '0' COMMENT '1 = Gudang Utama\\r\\n0 = Bukan Gudang Utama',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_m_gudang: ~2 rows (approximately)
DELETE FROM `tbl_m_gudang`;
INSERT INTO `tbl_m_gudang` (`id`, `created_at`, `updated_at`, `kode`, `gudang`, `keterangan`, `status`, `status_gd`) VALUES
	(1, '2025-01-10 14:39:25', '2025-01-14 09:38:20', 'GDG-001', 'Gudang Utama', 'TES', '1', '1'),
	(2, '2025-01-10 14:39:38', '2025-01-14 09:38:36', 'GDG-002', 'Gudang Atass', '-', '1', '0');

-- Dumping structure for table db_medkit3v2.tbl_m_item
DROP TABLE IF EXISTS `tbl_m_item`;
CREATE TABLE IF NOT EXISTS `tbl_m_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_satuan` int(11) DEFAULT 0,
  `id_kategori` int(11) DEFAULT 0,
  `id_kategori_lab` int(11) DEFAULT 0,
  `id_kategori_gol` int(11) DEFAULT 0,
  `id_lokasi` int(11) DEFAULT 0,
  `id_merk` int(11) DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `kode` varchar(65) DEFAULT NULL COMMENT 'Kode Item',
  `barcode` varchar(65) DEFAULT NULL,
  `item` varchar(160) DEFAULT NULL COMMENT 'Nama Item',
  `item_alias` text DEFAULT NULL COMMENT 'Nama Alias Obat',
  `item_kand` text DEFAULT NULL COMMENT 'Nama Kandungan Obat',
  `jml` float DEFAULT NULL COMMENT 'Jumlah Stok',
  `jml_limit` float DEFAULT 0 COMMENT 'Jumlah Limit untuk warning',
  `jml_min` float DEFAULT 0 COMMENT 'Jumlah Minimum',
  `harga_beli` decimal(10,2) DEFAULT NULL,
  `harga_jual` decimal(10,2) DEFAULT NULL,
  `remun_tipe` enum('0','1','2') DEFAULT '0',
  `remun_perc` decimal(10,2) DEFAULT 0.00,
  `remun_nom` decimal(10,2) DEFAULT 0.00,
  `apres_tipe` enum('0','1','2') DEFAULT '0',
  `apres_perc` decimal(10,2) DEFAULT 0.00,
  `apres_nom` decimal(10,2) unsigned DEFAULT 0.00,
  `status` enum('0','1') DEFAULT '0' COMMENT 'Status item aktif / tidak',
  `status_stok` enum('0','1') DEFAULT '0' COMMENT 'Status Stok, mengurangi stok / tidak',
  `status_racikan` enum('0','1') DEFAULT '0' COMMENT 'Status Obat Racikan',
  `status_hps` enum('0','1') DEFAULT '0' COMMENT 'Status Item terhapus (soft deleted)',
  `status_item` int(11) DEFAULT 0 COMMENT '1=obat;2=tindakan;3=lab;4=radiologi;5=bhp;',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_m_item: ~8 rows (approximately)
DELETE FROM `tbl_m_item`;
INSERT INTO `tbl_m_item` (`id`, `id_satuan`, `id_kategori`, `id_kategori_lab`, `id_kategori_gol`, `id_lokasi`, `id_merk`, `id_user`, `created_at`, `updated_at`, `deleted_at`, `kode`, `barcode`, `item`, `item_alias`, `item_kand`, `jml`, `jml_limit`, `jml_min`, `harga_beli`, `harga_jual`, `remun_tipe`, `remun_perc`, `remun_nom`, `apres_tipe`, `apres_perc`, `apres_nom`, `status`, `status_stok`, `status_racikan`, `status_hps`, `status_item`) VALUES
	(1, 1, 7, 0, 0, 0, 1, 1, '2025-01-13 15:24:17', '2025-01-13 08:24:17', NULL, 'OBT25014900001', NULL, 'ALOCLAIR PLUS GEL', '', 'ALOCLAIR PLUS GEL', 0, 0, 0, 94350.00, 115500.00, '0', 0.00, 0.00, '0', 0.00, 0.00, '1', '1', '0', '0', 1),
	(2, 1, 7, 0, 0, 0, 1, 1, '2025-01-13 15:25:14', '2025-01-13 08:25:14', NULL, 'OBT25015600002', NULL, 'AMBROXOL 30MG TAB', 'EPEXOL,MUCOPECT,MUCERA, MUCOS', 'ambroxol 30mg tab', 0, 0, 0, 153.00, 1000.00, '0', 0.00, 0.00, '0', 0.00, 0.00, '1', '1', '0', '0', 1),
	(3, 1, 7, 0, 0, 0, 1, 1, '2025-01-13 15:26:25', '2025-01-13 08:26:25', NULL, 'OBT25019400003', NULL, 'ALKOHOL 70% 100ML', '', 'alkohol 70% 100ml', 0, 0, 0, 4500.00, 10500.00, '0', 0.00, 0.00, '0', 0.00, 0.00, '1', '1', '0', '0', 1),
	(4, 1, 7, 0, 0, 0, 1, 1, '2025-01-13 15:27:26', '2025-01-13 08:27:26', NULL, 'OBT25014000004', NULL, 'ACYCLOVIR 400MG', 'ACYCLOVIR,LICOVIR,ACIFAR,AZOVIR,CLINOVIR,MATOVIR', 'acyclovir 400mg', 0, 0, 0, 940.00, 2000.00, '0', 0.00, 0.00, '0', 0.00, 0.00, '1', '1', '0', '0', 1),
	(5, 0, 9, 0, 0, 0, 0, 1, '2025-01-13 15:29:43', '2025-01-13 08:29:43', NULL, 'TND25015100001', NULL, 'ADMINISTRASI PASIEN*', NULL, '', NULL, 0, 0, NULL, 35000.00, '', 0.00, 0.00, '', 0.00, 0.00, '1', '0', '0', '0', 2),
	(6, 0, 9, 0, 0, 0, 0, 1, '2025-01-13 15:30:26', '2025-01-13 08:30:26', NULL, 'TND25012200002', NULL, 'ADMINISTRASI PASIEN Inh MC', NULL, '', NULL, 0, 0, NULL, 6000.00, '', 0.00, 0.00, '', 0.00, 0.00, '1', '0', '0', '0', 2),
	(7, 0, 9, 0, 0, 0, 0, 1, '2025-01-13 15:48:50', '2025-01-13 08:48:50', NULL, 'TND25015900002', NULL, 'EKG', NULL, '', NULL, 0, 0, NULL, 59000.00, '', 0.00, 0.00, '', 0.00, 0.00, '1', '0', '0', '0', 2),
	(11, 1, 12, 0, 0, 0, 1, 1, '2025-01-13 15:57:58', '2025-01-13 08:58:36', NULL, 'LAB25011800001', NULL, 'ANTI CHLAMYDIA IGG', NULL, '', NULL, 0, 0, 111.00, 1375000.00, '', 0.00, 0.00, '', 0.00, 0.00, '1', NULL, '0', '0', 3);

-- Dumping structure for table db_medkit3v2.tbl_m_item_ref
DROP TABLE IF EXISTS `tbl_m_item_ref`;
CREATE TABLE IF NOT EXISTS `tbl_m_item_ref` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_item` int(11) unsigned DEFAULT 0,
  `id_item_ref` int(11) DEFAULT 0,
  `id_satuan` int(11) DEFAULT 0,
  `id_user` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `item` varchar(160) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT 0.00,
  `jml` decimal(10,2) DEFAULT 0.00,
  `jml_satuan` int(11) DEFAULT 0,
  `subtotal` decimal(10,2) DEFAULT 0.00,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_item` (`id_item`),
  KEY `id_item_ref` (`id_item_ref`),
  KEY `id_satuan` (`id_satuan`),
  CONSTRAINT `fk_item_ref_item` FOREIGN KEY (`id_item`) REFERENCES `tbl_m_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_m_item_ref: ~0 rows (approximately)
DELETE FROM `tbl_m_item_ref`;

-- Dumping structure for table db_medkit3v2.tbl_m_item_stok
DROP TABLE IF EXISTS `tbl_m_item_stok`;
CREATE TABLE IF NOT EXISTS `tbl_m_item_stok` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_item` int(11) unsigned NOT NULL,
  `id_satuan` int(11) unsigned DEFAULT NULL,
  `id_gudang` int(11) unsigned DEFAULT 1,
  `id_user` int(11) unsigned DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `jml` float DEFAULT 0,
  `status` enum('0','1','2') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tbl_m_item_stok_id_item_foreign` (`id_item`),
  KEY `tbl_m_item_stok_id_gudang_foreign` (`id_gudang`),
  CONSTRAINT `tbl_m_item_stok_id_gudang_foreign` FOREIGN KEY (`id_gudang`) REFERENCES `tbl_m_gudang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_m_item_stok_id_item_foreign` FOREIGN KEY (`id_item`) REFERENCES `tbl_m_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_m_item_stok: ~10 rows (approximately)
DELETE FROM `tbl_m_item_stok`;
INSERT INTO `tbl_m_item_stok` (`id`, `id_item`, `id_satuan`, `id_gudang`, `id_user`, `created_at`, `updated_at`, `jml`, `status`) VALUES
	(1, 1, 1, 1, 1, '2025-01-13 08:24:17', '2025-01-13 15:24:17', 0, '1'),
	(2, 1, 1, 2, 1, '2025-01-13 08:24:17', '2025-01-13 15:24:17', 0, '1'),
	(3, 2, 1, 1, 1, '2025-01-13 08:25:14', '2025-01-13 15:25:14', 0, '1'),
	(4, 2, 1, 2, 1, '2025-01-13 08:25:14', '2025-01-13 15:25:14', 0, '1'),
	(5, 3, 1, 1, 1, '2025-01-13 08:26:25', '2025-01-13 15:26:25', 0, '1'),
	(6, 3, 1, 2, 1, '2025-01-13 08:26:25', '2025-01-13 15:26:25', 0, '1'),
	(7, 4, 1, 1, 1, '2025-01-13 08:27:26', '2025-01-13 15:27:26', 0, '1'),
	(8, 4, 1, 2, 1, '2025-01-13 08:27:26', '2025-01-13 15:27:26', 0, '1'),
	(9, 11, 1, 1, 1, '2025-01-13 08:57:58', '2025-01-13 15:57:58', 0, '1'),
	(10, 11, 1, 2, 1, '2025-01-13 08:57:58', '2025-01-13 15:57:58', 0, '1');

-- Dumping structure for table db_medkit3v2.tbl_m_kategori
DROP TABLE IF EXISTS `tbl_m_kategori`;
CREATE TABLE IF NOT EXISTS `tbl_m_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_m_kategori: ~21 rows (approximately)
DELETE FROM `tbl_m_kategori`;
INSERT INTO `tbl_m_kategori` (`id`, `created_at`, `updated_at`, `kode`, `kategori`, `keterangan`, `status`) VALUES
	(2, '2019-08-16 07:47:22', NULL, 'KTG-001', 'Bahan Habis Pakai', NULL, '1'),
	(3, '2022-07-21 20:43:16', NULL, 'KTG-002', 'Jasa', NULL, '1'),
	(4, '2022-08-20 10:49:40', NULL, 'KTG-003', 'Asuhan Keperawatan', NULL, '1'),
	(5, '2022-09-06 21:35:20', NULL, 'KTG-004', 'Tindakan Perawatan', NULL, '1'),
	(6, '2022-09-06 21:35:31', NULL, 'KTG-005', 'Tindakan Radiologi', NULL, '1'),
	(7, '2022-09-16 11:38:48', NULL, 'KTG-006', 'Obat', NULL, '1'),
	(8, '2022-09-16 11:39:12', NULL, 'KTG-007', 'Produk Consumable', NULL, '1'),
	(9, '2022-11-29 15:18:12', NULL, 'KTG-008', 'Tindakan Umum', NULL, '1'),
	(10, '2022-11-29 15:18:12', NULL, 'KTG-009', 'Kamar', NULL, '1'),
	(11, '2022-11-29 15:18:12', NULL, 'KTG-010', 'Bahan Radiologi', NULL, '1'),
	(12, '2022-11-29 15:18:12', NULL, 'KTG-011', 'Laboratorium', NULL, '1'),
	(13, '2022-11-29 15:18:12', NULL, 'KTG-012', 'Jasa Dokter', NULL, '1'),
	(14, '2022-11-29 15:18:12', NULL, 'KTG-013', 'Bahan Tindakan Gigi', NULL, '1'),
	(15, '2022-11-29 15:18:12', NULL, 'KTG-014', 'Radiologi', NULL, '1'),
	(16, '2022-11-29 15:18:12', NULL, 'KTG-015', 'Lain-lain', NULL, '1'),
	(17, '2022-11-29 15:18:12', NULL, 'KTG-016', 'Bahan Laborat', NULL, '1'),
	(18, '2022-11-29 15:18:12', NULL, 'KTG-017', 'Tindakan Gigi', NULL, '1'),
	(19, '2022-11-29 15:18:12', NULL, 'KTG-018', 'Visite', NULL, '1'),
	(20, '2022-12-10 09:03:26', NULL, 'KTG-019', 'Tindakan Kecantikan', NULL, '1'),
	(21, '2023-08-08 11:21:40', NULL, 'KTG-020', 'Bahan Tindakan Kecantikan', NULL, '1');

-- Dumping structure for table db_medkit3v2.tbl_m_merk
DROP TABLE IF EXISTS `tbl_m_merk`;
CREATE TABLE IF NOT EXISTS `tbl_m_merk` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `kode` varchar(160) DEFAULT NULL,
  `merk` varchar(160) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_m_merk: ~2 rows (approximately)
DELETE FROM `tbl_m_merk`;
INSERT INTO `tbl_m_merk` (`id`, `created_at`, `updated_at`, `kode`, `merk`, `keterangan`, `status`) VALUES
	(1, '2025-01-10 12:17:01', '2025-01-11 14:15:20', 'MRK-001', 'DEFAULT', '-', '1');

-- Dumping structure for table db_medkit3v2.tbl_m_penjamin
DROP TABLE IF EXISTS `tbl_m_penjamin`;
CREATE TABLE IF NOT EXISTS `tbl_m_penjamin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `kode` varchar(160) DEFAULT NULL,
  `penjamin` varchar(160) DEFAULT NULL,
  `persen` decimal(10,2) DEFAULT 0.00,
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_m_penjamin: ~4 rows (approximately)
DELETE FROM `tbl_m_penjamin`;
INSERT INTO `tbl_m_penjamin` (`id`, `created_at`, `updated_at`, `kode`, `penjamin`, `persen`, `status`) VALUES
	(1, '2023-07-04 21:57:40', '2025-01-13 17:35:56', 'PJM250101', 'UMUM', 0.00, '1'),
	(2, '2023-07-04 21:58:14', '2025-01-13 12:33:10', 'PJM250102', 'ASURANSI', 1.10, '1'),
	(3, '2023-07-04 21:58:47', '2025-01-14 09:37:35', 'PJM250103', 'BPJS Kesehatan', 0.00, '1');

-- Dumping structure for table db_medkit3v2.tbl_m_poli
DROP TABLE IF EXISTS `tbl_m_poli`;
CREATE TABLE IF NOT EXISTS `tbl_m_poli` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `kode` varchar(64) DEFAULT NULL,
  `poli` varchar(64) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `post_location` varchar(100) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_m_poli: ~23 rows (approximately)
DELETE FROM `tbl_m_poli`;
INSERT INTO `tbl_m_poli` (`id`, `created_at`, `updated_at`, `kode`, `poli`, `keterangan`, `post_location`, `status`) VALUES
	(1, '2019-08-14 09:55:31', '2022-09-08 10:00:20', 'PL2512001', 'POLI UMUM', '-', 'e8d008ac-a3e8-4d45-af9f-d8050f76ffe8', '1'),
	(2, '2022-08-20 11:10:01', NULL, 'PL2512002', 'POLI MATA', '-', NULL, '1'),
	(3, '2022-09-08 09:58:28', '2025-01-13 10:30:43', 'PL2512003', 'RRI Drive Thru', '-', '', '0'),
	(4, '2022-04-19 13:48:41', NULL, 'PL2512004', 'POLI IGD', NULL, NULL, '1'),
	(5, '2022-04-19 13:48:45', NULL, 'PL2512005', 'POLI ANAK', NULL, '63b582b6-ef6c-4309-a942-7c9f18deab24', '1'),
	(6, '2022-04-19 13:48:46', NULL, 'PL2512006', 'POLI OBGYN', NULL, '46dbd957-2f6f-44c1-ba38-cd2520026ff7', '1'),
	(7, '2022-04-19 13:48:48', NULL, 'PL2512007', 'POLI RADIOLOGI', NULL, NULL, '1'),
	(8, '2022-04-19 13:48:50', NULL, 'PL2512008', 'POLI THT', NULL, 'd6e82a1f-b695-4432-8896-4efc107a5fea', '1'),
	(9, '2022-04-19 13:49:44', NULL, 'PL2512009', 'POLI DALAM', NULL, 'c8f822af-3e66-4816-871e-4ddd4d16067a', '1'),
	(10, '2022-04-19 13:53:11', NULL, 'PL2512010', 'POLI GIGI', NULL, 'e35e2f07-d4ff-4ab3-991f-93695d227269', '1'),
	(11, '2022-04-19 13:53:12', NULL, 'PL2512011', 'POLI KULIT', NULL, NULL, '1'),
	(12, '2022-04-19 13:53:14', NULL, 'PL2512012', 'POLI JIWA', NULL, 'e14aa4b7-966c-41e0-9d41-e24149af4fe6', '1'),
	(13, '2022-04-19 13:53:15', NULL, 'PL2512013', 'LABORATORIUM', NULL, NULL, '1'),
	(14, '2022-12-24 09:31:17', '2022-12-24 09:31:19', 'PL2512014', 'POLI KECANTIKAN', NULL, '8b0f3915-aeb2-4673-89b9-cd6de880727d', '1'),
	(15, '2022-12-27 19:39:19', NULL, 'PL2512015', 'POLI BEDAH', NULL, NULL, '1'),
	(16, '2023-06-01 16:50:55', NULL, 'PL2512016', 'POLI PT YASA', NULL, NULL, '1'),
	(17, '2023-06-01 16:51:04', NULL, 'PL2512017', 'PENDAFTARAN', NULL, NULL, '0'),
	(18, '2023-10-16 14:12:06', NULL, 'PL2512018', 'POLI PT TECHPACK', NULL, NULL, '0'),
	(19, '2024-04-17 14:11:44', NULL, 'PL2512019', 'MCU', NULL, NULL, '0'),
	(20, '2024-07-06 18:50:37', '2024-07-06 18:51:08', 'PL2512020', 'POLI NEUROLOGI', '', NULL, '1'),
	(21, '2024-08-28 14:27:36', '2024-08-28 14:29:16', 'PL2512021', 'POLI MIKROBIOLOGI', '-', NULL, '1'),
	(22, '2024-12-19 14:30:58', '2024-12-19 14:37:33', 'PL2512022', 'POLI KHITAN', '-', NULL, '1');

-- Dumping structure for table db_medkit3v2.tbl_m_satuan
DROP TABLE IF EXISTS `tbl_m_satuan`;
CREATE TABLE IF NOT EXISTS `tbl_m_satuan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `satuanKecil` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `satuanBesar` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `status` enum('1','0') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_m_satuan: ~4 rows (approximately)
DELETE FROM `tbl_m_satuan`;
INSERT INTO `tbl_m_satuan` (`id`, `created_at`, `updated_at`, `satuanKecil`, `satuanBesar`, `jml`, `status`) VALUES
	(1, '2024-12-30 10:45:21', '2025-01-10 14:03:58', 'PCS', 'PCS', 1, '1'),
	(2, '2025-01-05 23:37:14', '2025-01-05 23:37:14', 'PCS', 'BOX', 10, '1'),
	(3, '2025-01-05 23:37:28', '2025-01-06 08:37:21', 'PCS', 'DOS', 15, '1'),
	(4, '2025-01-13 15:47:59', '2025-01-13 15:47:59', 'LOT', 'LOT', 1, '1');

-- Dumping structure for table db_medkit3v2.tbl_pengaturan
DROP TABLE IF EXISTS `tbl_pengaturan`;
CREATE TABLE IF NOT EXISTS `tbl_pengaturan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `judul` varchar(100) DEFAULT NULL,
  `judul_app` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `theme` varchar(50) DEFAULT NULL,
  `pagination_limit` int(11) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logo_header` varchar(255) DEFAULT NULL,
  `apt_apa` varchar(255) DEFAULT NULL,
  `apt_sipa` varchar(255) DEFAULT NULL,
  `ppn` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_pengaturan: ~0 rows (approximately)
DELETE FROM `tbl_pengaturan`;
INSERT INTO `tbl_pengaturan` (`id`, `updated_at`, `judul`, `judul_app`, `alamat`, `deskripsi`, `kota`, `url`, `theme`, `pagination_limit`, `favicon`, `logo`, `logo_header`, `apt_apa`, `apt_sipa`, `ppn`) VALUES
	(1, '2025-01-09 09:19:37', 'MEDKIT 3', 'MEDKIT 3', 'Jl. Example No. 123', 'Sistem Informasi Apotek', 'Jakarta', 'http://localhost/medkit3-v2', 'admin-lte-3', 10, 'public/file/app/favicon_1735061928.ico', 'public/file/app/logo_677141b70e672.png', 'public/file/app/logo_header_6778115b329a2.png', 'APA123456', 'SIPA123456', 11);

-- Dumping structure for table db_medkit3v2.tbl_pengaturan_theme
DROP TABLE IF EXISTS `tbl_pengaturan_theme`;
CREATE TABLE IF NOT EXISTS `tbl_pengaturan_theme` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_pengaturan` int(11) unsigned DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `path` varchar(160) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_pengaturan` (`id_pengaturan`),
  CONSTRAINT `FK_pengaturan_theme` FOREIGN KEY (`id_pengaturan`) REFERENCES `tbl_pengaturan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_medkit3v2.tbl_pengaturan_theme: ~0 rows (approximately)
DELETE FROM `tbl_pengaturan_theme`;
INSERT INTO `tbl_pengaturan_theme` (`id`, `id_pengaturan`, `nama`, `path`, `status`) VALUES
	(1, 1, 'AdminLTE 3', 'admin-lte-3', 1);

-- Dumping structure for table db_medkit3v2.tbl_sessions
DROP TABLE IF EXISTS `tbl_sessions`;
CREATE TABLE IF NOT EXISTS `tbl_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table db_medkit3v2.tbl_sessions: ~5 rows (approximately)
DELETE FROM `tbl_sessions`;
INSERT INTO `tbl_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
	('simedis-sess:nq6koqmh0clqn1mtb8436abiagmirl82', '::1', '2025-01-13 16:15:52', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363738343732353b73696d656469735f746f6b656e7c733a33323a226630373836396539343735663465386632386435653531313461306636613964223b5f63695f70726576696f75735f75726c7c733a34363a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f6d61737465722f6c61622f656469742f3131223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373336373436373135223b6c6173745f636865636b7c693a313733363736303135353b),
	('simedis-sess:g98vbfpm7i05sok5jee240u4u16pcmqm', '::1', '2025-01-14 09:37:14', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363834373433343b73696d656469735f746f6b656e7c733a33323a223466633932373130306130643833396665396132636136383936613866353930223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f617574682f6c6f67696e223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373336373630313535223b6c6173745f636865636b7c693a313733363834373433343b),
	('simedis-sess:2398a935e9gbc4ndpcl0pl3nn7ml0jro', '::1', '2025-01-14 10:09:36', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363834393337353b73696d656469735f746f6b656e7c733a33323a226164393038643432316265633733633035633731353461363436666434316338223b5f63695f70726576696f75735f75726c7c733a34303a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f6d61737465722f67656c6172223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373336373630313535223b6c6173745f636865636b7c693a313733363834373433343b),
	('simedis-sess:b0jfogaue4vc13d66lta94l8fnkambas', '::1', '2025-01-14 10:09:44', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363834393338343b73696d656469735f746f6b656e7c733a33323a223635333732393935383562333539346431383935623566343130363165363063223b5f63695f70726576696f75735f75726c7c733a33383a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f617574682f6c6f67696e223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373336383437343334223b6c6173745f636865636b7c693a313733363834393338343b),
	('simedis-sess:285tn76fckcaigp01a23tabgirkdplcl', '::1', '2025-01-14 10:22:49', _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363835303033333b73696d656469735f746f6b656e7c733a33323a223635333732393935383562333539346431383935623566343130363165363063223b5f63695f70726576696f75735f75726c7c733a34363a22687474703a2f2f6c6f63616c686f73742f6d65646b6974332d76322f6d61737465722f6c61622f656469742f3131223b6964656e746974797c733a343a22726f6f74223b757365726e616d657c733a343a22726f6f74223b656d61696c7c733a31323a22726f6f74406170702e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231373336383437343334223b6c6173745f636865636b7c693a313733363834393338343b);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
