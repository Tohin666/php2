-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.20 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table myShopDB.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sum` float DEFAULT NULL,
  KEY `cart_users_id_fk` (`user_id`),
  KEY `cart_products_id_fk` (`product_id`),
  CONSTRAINT `cart_products_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `cart_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table myShopDB.cart: ~0 rows (approximately)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping structure for table myShopDB.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table myShopDB.categories: ~4 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`) VALUES
	(1, 'Пластиковые автоматические печати'),
	(2, 'Металлические автоматические печати'),
	(3, 'Пластиковые автоматические штампы');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table myShopDB.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `fio` varchar(128) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `sum` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_users_id_fk` (`user_id`),
  CONSTRAINT `orders_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Dumping data for table myShopDB.orders: ~2 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `user_id`, `fio`, `address`, `phone`, `status`, `sum`) VALUES
	(30, 1, 'Админ Админович Админов', 'Москва, Кремль', '555-55-55', 'выдан', 7598),
	(31, 2, 'Юзер Юзерович', 'Санкт-Петербург, ул.Невская', '777-77-77', 'новый', 4129);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table myShopDB.order_list
CREATE TABLE IF NOT EXISTS `order_list` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `sum` float DEFAULT NULL,
  KEY `order_list_orders_id_fk` (`order_id`),
  CONSTRAINT `order_list_orders_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table myShopDB.order_list: ~5 rows (approximately)
/*!40000 ALTER TABLE `order_list` DISABLE KEYS */;
INSERT INTO `order_list` (`order_id`, `product_id`, `quantity`, `sum`) VALUES
	(30, 2, 4, 3136),
	(30, 3, 2, 1758),
	(30, 5, 4, 2704),
	(31, 1, 4, 2392),
	(31, 4, 1, 1737);
/*!40000 ALTER TABLE `order_list` ENABLE KEYS */;

-- Dumping structure for table myShopDB.photos
CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `url_big` varchar(2083) DEFAULT NULL,
  `url_small` varchar(2083) DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table myShopDB.photos: ~5 rows (approximately)
/*!40000 ALTER TABLE `photos` DISABLE KEYS */;
INSERT INTO `photos` (`id`, `name`, `size`, `url_big`, `url_small`, `view_count`) VALUES
	(6, 'PR_4642_P4_H_red_standard.jpg', 590225, 'img/big/PR_4642_P4_H_red_standard.jpg', 'img/small/PR_4642_P4_H_red_standard_small.jpg', 0),
	(7, 'PR_4913_P4_H_green.jpg', 36621, 'img/big/PR_4913_P4_H_green.jpg', 'img/small/PR_4913_P4_H_green_small.jpg', 1),
	(8, 'PR_4927_black_standard.jpg', 663368, 'img/big/PR_4927_black_standard.jpg', 'img/small/PR_4927_black_standard_small.jpg', 0),
	(9, 'PR_5215_Eco.jpg', 392886, 'img/big/PR_5215_Eco.jpg', 'img/small/PR_5215_Eco_small.jpg', 1),
	(10, 'PR_46025_blue_open_closed.jpg', 43110, 'img/big/PR_46025_blue_open_closed.jpg', 'img/small/PR_46025_blue_open_closed_small.jpg', 0);
/*!40000 ALTER TABLE `photos` ENABLE KEYS */;

-- Dumping structure for table myShopDB.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_categories_id_fk` (`category_id`),
  CONSTRAINT `products_categories_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table myShopDB.products: ~5 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `description`, `price`, `photo`, `category_id`) VALUES
	(1, 'Trodat 4642', 'Печать автоматическая Trodat 4642 с крышкой Д=40-42мм пластик. Новая оснастка от австрийской фирмы Trodat - лидера мирового штемпельного рынка. Новая печать сочетает в себе все преимущества появившихся раньше штампов, которые уже давно полюбили пользователи. На сегодняшний день аналогов на российском да и мировом рынке штемпельной продукции просто не существует.', 598.00, 'PR_4642_P4_H_red_standard.jpg', 1),
	(2, 'Trodat 4913', 'Штамп автоматический Trodat 4913 58х22мм пластик', 784.00, 'PR_4913_P4_H_green.jpg', 3),
	(3, 'Trodat 4927', 'Штамп автоматический Trodat 4927 60х40мм пластик', 879.00, 'PR_4927_black_standard.jpg', 3),
	(4, 'Trodat 5215', 'Печать автоматическая Trodat 5215 Д=45мм металл', 1737.00, 'PR_5215_Eco.jpg', 2),
	(5, 'Trodat 46025', 'Печать автоматическая Trodat 46025 с крышкой Д=25мм пластик', 676.00, 'PR_46025_blue_open_closed.jpg', 1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table myShopDB.testimonials
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `testimonial` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table myShopDB.testimonials: ~5 rows (approximately)
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` (`id`, `name`, `testimonial`) VALUES
	(1, 'Tohin', 'Это мой первый отзыв'),
	(6, 'User', 'А это мой второй отзыв.'),
	(7, 'Вася', 'Офисный компьютер не просто работает, можно сказать "летает". Если где то и есть тормоза то все упирается в жесткий диск а не процессор. '),
	(8, 'aleks28rus', 'Не дорогой, цена более чем оптимальная, хватает для офиса, с типовым набором приложений.'),
	(9, 'Петя', 'выдающегося ждать не стоит, а на домашнем компе, c linux opensuse никаких тормозов. инет, фильмы, музыка, закачка на телефон, фотки с фото-аппарата, офис, с этим справляется на ура, и не греется\r\n');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;

-- Dumping structure for table myShopDB.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table myShopDB.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `login`, `password`) VALUES
	(1, 'Админ', 'admin', 'admin'),
	(2, 'Юзверь', 'user', 'qwerty'),
	(5, 'Антон', 'tohin', 'tohin'),
	(8, 'Гость', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
