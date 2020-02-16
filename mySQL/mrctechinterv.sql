-- --------------------------------------------------------
-- 主機:                           127.0.0.1
-- 伺服器版本:                        8.0.17 - MySQL Community Server - GPL
-- 伺服器作業系統:                      Win64
-- HeidiSQL 版本:                  10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 傾印  資料表 mrctechinterv.mrctech 結構
CREATE TABLE IF NOT EXISTS `mrctech` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Account` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Updatetime` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Account` (`Account`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='奇迹科技_面試作業';

-- 正在傾印表格  mrctechinterv.mrctech 的資料：~5 rows (近似值)
/*!40000 ALTER TABLE `mrctech` DISABLE KEYS */;
INSERT INTO `mrctech` (`Id`, `Account`, `Password`, `Updatetime`) VALUES
	(40, 'member1', '123', '2020-02-16 22:47:25'),
	(41, 'member2', '123', '2020-02-16 22:48:03');
/*!40000 ALTER TABLE `mrctech` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
