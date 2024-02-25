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

-- Dumping structure for table tpspharma.nhapkhoheader
CREATE TABLE IF NOT EXISTS `nhapkhoheader` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `lastmodify` datetime NOT NULL,
  `msdv` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `msdn` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `soct` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sohd` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ngaygs` date NOT NULL,
  `ngayhd` date NOT NULL,
  `chietkhau` double NOT NULL DEFAULT 0,
  `tienchietkhau` double NOT NULL DEFAULT 0,
  `tongcongvat` double NOT NULL DEFAULT 0,
  `loaiphieu` char(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '1: Nhập từ nhà cung cấp; 2: Khách trả; 3: Nhập tồn',
  `msncc` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tenncc` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `dathanhtoan` double NOT NULL DEFAULT 0,
  `sophieuchi` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `nganquy` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`rowid`,`soct`) USING BTREE,
  KEY `index_nhapkhoheader` (`msdv`,`ngaygs`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table tpspharma.nhapkhoheader: ~3 rows (approximately)
INSERT INTO `nhapkhoheader` (`rowid`, `lastmodify`, `msdv`, `msdn`, `soct`, `sohd`, `ngaygs`, `ngayhd`, `chietkhau`, `tienchietkhau`, `tongcongvat`, `loaiphieu`, `msncc`, `tenncc`, `dathanhtoan`, `sophieuchi`, `nganquy`) VALUES
	(31, '2023-06-06 12:41:02', '1', '0907678234', 'ID662023916963298', '123', '2023-06-06', '2050-02-20', 0, 0, 10000, '1', 'DHG', 'Dược Hậu Giang', 0, '', ''),
	(33, '2023-06-06 13:30:05', '1', '0907678234', 'ID66202313897509', '', '0000-00-00', '0000-00-00', 0, 0, 0, '', '', '', 0, '', ''),
	(39, '2023-06-06 16:34:36', '1', '0907678234', 'ID662023375810264', '', '0000-00-00', '0000-00-00', 0, 0, 0, '', '', '', 0, '', '');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
