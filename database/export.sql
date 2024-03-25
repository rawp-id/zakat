-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for zakat
DROP DATABASE IF EXISTS `zakat`;
CREATE DATABASE IF NOT EXISTS `zakat` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `zakat`;

-- Dumping structure for table zakat.masjid
DROP TABLE IF EXISTS `masjid`;
CREATE TABLE IF NOT EXISTS `masjid` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_ms` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_ms` (`kode_ms`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table zakat.masjid: ~1 rows (approximately)
DELETE FROM `masjid`;
INSERT INTO `masjid` (`id`, `kode_ms`, `nama`) VALUES
	(1, 'dm', 'Darul Muttaqin');

-- Dumping structure for table zakat.role
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table zakat.role: ~0 rows (approximately)
DELETE FROM `role`;

-- Dumping structure for table zakat.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verifikasi` datetime NOT NULL DEFAULT (0),
  `role` int DEFAULT NULL,
  `kode_ms` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_user_role` (`role`),
  KEY `FK_user_masjid` (`kode_ms`),
  CONSTRAINT `FK_user_masjid` FOREIGN KEY (`kode_ms`) REFERENCES `masjid` (`kode_ms`),
  CONSTRAINT `FK_user_role` FOREIGN KEY (`role`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table zakat.user: ~0 rows (approximately)
DELETE FROM `user`;

-- Dumping structure for table zakat.zakat
DROP TABLE IF EXISTS `zakat`;
CREATE TABLE IF NOT EXISTS `zakat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL DEFAULT '',
  `jumlah` int NOT NULL,
  `alamat` text NOT NULL,
  `rincian` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `kode_ms` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_zakat_masjid` (`kode_ms`),
  CONSTRAINT `FK_zakat_masjid` FOREIGN KEY (`kode_ms`) REFERENCES `masjid` (`kode_ms`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table zakat.zakat: ~1 rows (approximately)
DELETE FROM `zakat`;
INSERT INTO `zakat` (`id`, `nama`, `jumlah`, `alamat`, `rincian`, `keterangan`, `kode_ms`) VALUES
	(1, 'test', 1, 'test', NULL, NULL, 'dm');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
