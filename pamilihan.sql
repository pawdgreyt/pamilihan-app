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


-- Dumping database structure for pamilihan
CREATE DATABASE IF NOT EXISTS `pamilihan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pamilihan`;

-- Dumping structure for table pamilihan.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pamilihan.cart: ~2 rows (approximately)

-- Dumping structure for table pamilihan.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `product_description` varchar(1000) NOT NULL DEFAULT '0',
  `product_brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `product_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `product_qty` int DEFAULT NULL,
  `product_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_status` varchar(255) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pamilihan.products: ~12 rows (approximately)
INSERT INTO `products` (`id`, `product_name`, `product_description`, `product_brand`, `product_price`, `product_qty`, `product_category`, `product_image`, `product_status`, `date_added`) VALUES
	(22, 'LG 50 inch', 'Latest TV of the Year! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'LG', '18000', 15, '1', 'lghdtv+.jpg', 'Active', '2023-07-26 21:57:01'),
	(24, 'Poker Jacket', 'Poker Life! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Life of Poker', '599', 56, '4', 'PokerJacket.jpg', 'Active', '2023-07-26 21:58:40'),
	(25, 'Black Tshirt', 'Blacker than Black! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Uniqlo', '499', 245, '4', 'shirt.png', 'Active', '2023-07-26 21:59:21'),
	(26, 'Black Cap', 'Black Caps Matter! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Boss Aparel', '1250', 23, '4', 'istockphoto-472015847-170667a.jpg', 'Phase Out', '2023-07-26 22:00:21'),
	(27, 'Black Hoodie', 'Hoodie Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Boss Aparel', '689', 47, '4', 'hoodie.jpg', 'Active', '2023-07-26 22:01:33'),
	(28, 'Black Panther', 'YIBAMBE! YIBAMBE! YIBAMBE! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Wakanda', '99999', 3, '2', 'black_panther.png', 'Active', '2023-07-26 22:02:26'),
	(30, 'Nami', 'Nawi-swan! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Bandai', '12500', 4, '2', 'nami.jpg', 'Active', '2023-07-26 22:04:46'),
	(31, 'Rog Ally', 'Asus Rog Ally Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Asus', '45000', 5, '2', 'asus.jpg', 'Active', '2023-07-26 22:30:27'),
	(32, 'MSI GF63', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'MSI', '45000', 7, '2', 'msi.jpg', 'Active', '2023-07-26 22:30:50'),
	(33, 'Baby Products 1', 'Baby Products Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Random', '7800', 5, '5', 'babyproducts.jpg', 'Active', '2023-07-26 22:31:57'),
	(34, 'Baby Products 2', 'Baby Products Package #2 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Random', '5600', 52, '5', 'babyproducts2.jpg', 'Active', '2023-07-26 22:32:21'),
	(46, 'GeForce RTX 4090', 'The NVIDIA® GeForce RTX™ 4090 is the ultimate GeForce GPU. It brings an enormous leap in performance, efficiency, and AI-powered graphics.', 'NVIDIA', '115995', 100, '2', '4090.jpg', 'Active', '2023-07-28 01:08:01');

-- Dumping structure for table pamilihan.product_categories
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(50) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pamilihan.product_categories: ~4 rows (approximately)
INSERT INTO `product_categories` (`id`, `category`, `date_added`) VALUES
	(1, 'Appliances', '2023-07-26 07:56:15'),
	(2, 'Gadgets', '2023-07-26 07:56:23'),
	(4, 'Clothes', '2023-07-26 01:32:22'),
	(5, 'Baby Products', '2023-07-26 01:33:09');

-- Dumping structure for table pamilihan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pamilihan.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `role`, `status`) VALUES
	(1, 'Admin', 'admin@email.com', 'admin', '1a1dc91c907325c69271ddf0c944bc72', 'admin', 'Active'),
	(5, 'Paolo Climaco', 'paoloclimaco01@gmail.com', 'paolo', '1a1dc91c907325c69271ddf0c944bc72', 'customer', 'Active'),
	(6, 'Staff1', 'staff@email.com', 'staff', '5f4dcc3b5aa765d61d8327deb882cf99', 'staff', 'Active');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
