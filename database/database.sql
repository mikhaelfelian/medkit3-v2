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
	(1, '127.0.0.1', 'root', '$2y$10$gQoEoZYp8Rz2iK9m.c1nZOQ3mJy53.Bb89WoV4m9/RxUTRVpY2FGW', 'root@app.com', NULL, NULL, NULL, NULL, NULL, '679750bea6ab621893af705acda687c1bc140bed', '$2y$10$1FH33CGxXCjk7gT8.jBHS.zN/J6qjQbwYRsukpmX1HeI9UokX4Z9G', 1268889823, 1736681586, 1, 'Root', 'Admin', 'ADMIN', '0'),
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

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
