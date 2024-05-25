-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table baitaploncnm.account
CREATE TABLE IF NOT EXISTS `account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ten` varchar(250) COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `password` varchar(250) COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `phanquyen` int NOT NULL DEFAULT '1',
  `sdt` varchar(250) COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(250) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Dumping data for table baitaploncnm.account: ~0 rows (approximately)
INSERT INTO `account` (`id`, `ten`, `password`, `phanquyen`, `sdt`, `email`) VALUES
	(1, 'Thien', '4de93544234adffbb681ed60ffcfb941', 2, '0366799876', 'thien2002@gmail.com'),
	(2, 'admin', '4de93544234adffbb681ed60ffcfb941', 1, '0123456789', 'admin@gmail.com'),
	(3, 'khachHang', 'b9bc4dd06b7d2d49cb9fb3d8d9fba6c1', 1, '0366799879', 'thien@gmail.com');

-- Dumping structure for table baitaploncnm.uploadfile
CREATE TABLE IF NOT EXISTS `uploadfile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_account` int NOT NULL,
  `tenfile` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `loaifile` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `uploadtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `filepath` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `sizeofFile` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__account` (`id_account`),
  CONSTRAINT `FK__account` FOREIGN KEY (`id_account`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Dumping data for table baitaploncnm.uploadfile: ~19 rows (approximately)
INSERT INTO `uploadfile` (`id`, `id_account`, `tenfile`, `loaifile`, `uploadtime`, `filepath`, `sizeofFile`) VALUES
	(13, 3, 'cDieuBietOn', 'php', '2024-05-24 20:40:02', 'upload/3_khachHang', 2020),
	(14, 2, 'mMucTieuThang', 'php', '2024-05-24 23:46:49', 'upload/2_admin', 2284);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
