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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pamilihan.cart: ~3 rows (approximately)
INSERT INTO `cart` (`id`, `user_id`, `product_id`, `qty`, `price`, `name`, `image`) VALUES
	(28, 8, 48, '3', '7850', 'Air Jordan 1 Low OG', 'air2.png'),
	(29, 8, 46, '1', '115995', 'GeForce RTX 4090', '4090.jpg'),
	(30, 8, 31, '1', '45000', 'Rog Ally', 'asus.jpg');

-- Dumping structure for table pamilihan.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `grand_total` float(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Active | 0=Inactive',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pamilihan.orders: ~0 rows (approximately)

-- Dumping structure for table pamilihan.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `sub_total` float(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table pamilihan.order_items: ~0 rows (approximately)

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pamilihan.products: ~14 rows (approximately)
INSERT INTO `products` (`id`, `product_name`, `product_description`, `product_brand`, `product_price`, `product_qty`, `product_category`, `product_image`, `product_status`, `date_added`) VALUES
	(22, 'LG 50 inch', 'Latest TV of the Year! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'LG', '18000', 15, '1', 'lghdtv+.jpg', 'Active', '2023-07-26 21:57:01'),
	(24, 'Poker Jacket', 'Poker Life! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Life of Poker', '599', 56, '4', 'PokerJacket.jpg', 'Active', '2023-07-26 21:58:40'),
	(25, 'Black Tshirt', 'Blacker than Black! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Uniqlo', '499', 245, '4', 'shirt.png', 'Active', '2023-07-26 21:59:21'),
	(26, 'Black Cap', 'Black Caps Matter! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Boss Aparel', '1250', 23, '4', 'istockphoto-472015847-170667a.jpg', 'Phase Out', '2023-07-26 22:00:21'),
	(27, 'Black Hoodie', 'Hoodie Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Boss Aparel', '689', 47, '4', 'hoodie.jpg', 'Active', '2023-07-26 22:01:33'),
	(28, 'Black Panther', 'YIBAMBE! YIBAMBE! YIBAMBE! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Wakanda', '99999', 3, '2', 'black_panther.png', 'Active', '2023-07-26 22:02:26'),
	(30, 'Nami', 'Nawi-swan! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Bandai', '12500', 4, '6', 'nami.jpg', 'Active', '2023-07-26 22:04:46'),
	(31, 'Rog Ally', 'Asus Rog Ally Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Asus', '45000', 5, '2', 'asus.jpg', 'Active', '2023-07-26 22:30:27'),
	(32, 'MSI GF63', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'MSI', '45000', 7, '2', 'msi.jpg', 'Active', '2023-07-26 22:30:50'),
	(33, 'Baby Products 1', 'Baby Products Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Random', '7800', 5, '5', 'babyproducts.jpg', 'Active', '2023-07-26 22:31:57'),
	(34, 'Baby Products 2', 'Baby Products Package #2 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel rutrum elit. Cras diam dui, hendrerit vitae lectus in, hendrerit molestie urna. Ut et elit efficitur, imperdiet nibh vitae, feugiat urna. Proin eget sapien id enim vestibulum tristique. Aenean nec facilisis justo, ut interdum lorem. Donec dignissim in erat id malesuada. Donec ac purus commodo, venenatis nulla nec, auctor quam. Nunc faucibus nunc nulla, vel accumsan dolor tempus at.', 'Random', '5600', 52, '5', 'babyproducts2.jpg', 'Active', '2023-07-26 22:32:21'),
	(46, 'GeForce RTX 4090', 'The NVIDIA® GeForce RTX™ 4090 is the ultimate GeForce GPU. It brings an enormous leap in performance, efficiency, and AI-powered graphics.', 'NVIDIA', '115995', 100, '2', '4090.jpg', 'Active', '2023-07-28 01:08:01'),
	(47, 'Air Jordan 1 Low', 'The Air Jordan 1 Low remakes the classic sneaker with new colours and textures. Premium materials and accents give fresh expression to an all-time favourite.', 'Nike', '6250', 14, '7', 'air1.png', 'Active', '2023-08-01 00:00:21'),
	(48, 'Air Jordan 1 Low OG', 'The Air Jordan 1 Low OG remakes the classic sneaker with new colours and textures. Premium materials and accents give fresh expression to an all-time favourite.', 'Nike', '7850', 5, '7', 'air2.png', 'Active', '2023-08-01 00:00:59');

-- Dumping structure for table pamilihan.product_categories
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(50) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pamilihan.product_categories: ~6 rows (approximately)
INSERT INTO `product_categories` (`id`, `category`, `date_added`) VALUES
	(1, 'Appliances', '2023-07-26 07:56:15'),
	(2, 'Gadgets', '2023-07-26 07:56:23'),
	(4, 'Clothes', '2023-07-26 01:32:22'),
	(5, 'Baby Products', '2023-07-26 01:33:09'),
	(6, 'Toy', '2023-07-31 23:38:55'),
	(7, 'Shoes', '2023-07-31 23:59:46');

-- Dumping structure for table pamilihan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pamilihan.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `username`, `password`, `role`, `status`) VALUES
	(1, 'Admin', 'admin@email.com', '123', 'Pasig City', 'admin', '1a1dc91c907325c69271ddf0c944bc72', 'admin', 'Active'),
	(6, 'Staff1', 'staff@email.com', '123', 'Pasig City', 'staff', '5f4dcc3b5aa765d61d8327deb882cf99', 'staff', 'Active'),
	(7, 'Staff2', 'staff2@email.com', '123', 'Pasig City', 'staff2', '5f4dcc3b5aa765d61d8327deb882cf99', 'staff', 'Active'),
	(8, 'Paolo Climaco', 'paoloclimaco01@gmail.com', '09380526639', 'Paso De Blas, Valenzuela City', 'paolo', '1a1dc91c907325c69271ddf0c944bc72', 'customer', 'Active');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
