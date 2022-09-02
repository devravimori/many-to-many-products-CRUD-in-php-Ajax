-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table manytomany_products_crud_db.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table manytomany_products_crud_db.category: ~5 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`) VALUES
	(55, 'food'),
	(82, 'music'),
	(83, 'book'),
	(142, 'Fashion'),
	(144, 'Cooking');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table manytomany_products_crud_db.cp
CREATE TABLE IF NOT EXISTS `cp` (
  `cid` int NOT NULL,
  `pid` int NOT NULL,
  KEY `ci` (`cid`),
  KEY `pid` (`pid`),
  CONSTRAINT `ci` FOREIGN KEY (`cid`) REFERENCES `category` (`id`),
  CONSTRAINT `pid` FOREIGN KEY (`pid`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table manytomany_products_crud_db.cp: ~14 rows (approximately)
/*!40000 ALTER TABLE `cp` DISABLE KEYS */;
INSERT INTO `cp` (`cid`, `pid`) VALUES
	(144, 456),
	(55, 456),
	(83, 438),
	(82, 438),
	(55, 438),
	(142, 455),
	(83, 455),
	(83, 433),
	(55, 433),
	(142, 340),
	(82, 340),
	(144, 457),
	(142, 457),
	(55, 457);
/*!40000 ALTER TABLE `cp` ENABLE KEYS */;

-- Dumping structure for table manytomany_products_crud_db.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=458 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table manytomany_products_crud_db.products: ~6 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
	(340, 'Sport Bike', 150000, 'image/541338218.jfif'),
	(433, 'Car', 425000, 'image/1750717767.JPG'),
	(438, 'Novel', 120, 'image/693650645.jpg'),
	(455, 'Diwali Diya', 50, 'image/1072306311.jpg'),
	(456, 'JellyFish', 500, 'image/813541781.jpg'),
	(457, 'Electric Stove', 1121, 'image/1641784476.jpg');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
