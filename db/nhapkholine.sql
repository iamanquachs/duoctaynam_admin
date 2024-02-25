-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table tpspharma.nhapkholine
CREATE TABLE IF NOT EXISTS `nhapkholine` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `lastmodify` datetime NOT NULL,
  `msdv` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mskho` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `soct` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sohd` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ngaygs` date NOT NULL,
  `ngayhd` date NOT NULL,
  `mshh` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tenhh` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `msquydoi` char(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dvt` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `solo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `handung` date DEFAULT NULL,
  `ngaysx` date NOT NULL,
  `sodangky` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gianhapchuack` double NOT NULL DEFAULT 0,
  `chietkhau` double NOT NULL DEFAULT 0,
  `tienchietkhau` double NOT NULL DEFAULT 0,
  `gianhapchuathue` double NOT NULL DEFAULT 0,
  `thuesuat` double NOT NULL DEFAULT 0,
  `tienthue` double NOT NULL DEFAULT 0,
  `gianhapcothue` double NOT NULL DEFAULT 0,
  `soluong` int(10) NOT NULL,
  `thanhtiencothue` double NOT NULL DEFAULT 0,
  `ptgiaban` double NOT NULL DEFAULT 0,
  `giaban` double NOT NULL DEFAULT 0,
  `loaiphieu` char(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '1: Nhập từ nhà cung cấp; 2: Khách trả; 3: Nhập tồn',
  `tam` int(2) NOT NULL,
  PRIMARY KEY (`rowid`) USING BTREE,
  KEY `index_nhapkholine` (`soct`,`msdv`,`ngayhd`,`tam`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table tpspharma.nhapkholine: ~2 rows (approximately)
INSERT INTO `nhapkholine` (`rowid`, `lastmodify`, `msdv`, `mskho`, `soct`, `sohd`, `ngaygs`, `ngayhd`, `mshh`, `tenhh`, `msquydoi`, `dvt`, `solo`, `handung`, `ngaysx`, `sodangky`, `gianhapchuack`, `chietkhau`, `tienchietkhau`, `gianhapchuathue`, `thuesuat`, `tienthue`, `gianhapcothue`, `soluong`, `thanhtiencothue`, `ptgiaban`, `giaban`, `loaiphieu`, `tam`) VALUES
	(30, '2023-06-06 12:41:30', '1', '', 'ID662023916963298', '', '2023-06-06', '2050-02-20', 'ID1608221657120006', 'Paralmax', '', 'Hộp', '123', '2034-11-11', '0000-00-00', '', 10000, 0, 0, 10000, 0, 0, 10000, 1, 10000, 0, 10000, '', 1),
	(31, '2023-06-06 13:32:09', '1', '', 'ID66202313897509', '', '0000-00-00', '0000-00-00', 'ID1608221657120010', 'Betaserc', '', 'Hộp', '123', '2023-02-22', '0000-00-00', '', 10000, 0, 0, 10000, 0, 0, 10000, 1, 10000, 0, 10000, '', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
