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

-- Dumping structure for table tpspharma.yeucauhanghoa
CREATE TABLE IF NOT EXISTS `yeucauhanghoa` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `lastmodify` datetime NOT NULL,
  `msdv` varchar(20) NOT NULL DEFAULT '',
  `msdn` varchar(20) NOT NULL DEFAULT '',
  `url` text NOT NULL COMMENT 'nếu có url thì đã tìm được sản phẩm ngược lại là rỗng',
  `url_lastmodify` datetime NOT NULL,
  `tenhh` varchar(250) NOT NULL DEFAULT '',
  `tenhc` varchar(250) NOT NULL DEFAULT '',
  `hamluong` varchar(250) NOT NULL DEFAULT '',
  `nhasx` varchar(250) NOT NULL DEFAULT '',
  `ghichu` text NOT NULL,
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table tpspharma.yeucauhanghoa: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
