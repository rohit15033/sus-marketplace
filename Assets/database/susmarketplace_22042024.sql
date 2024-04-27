-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 22, 2024 at 08:16 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `susmarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `user_id` varchar(36) NOT NULL,
  `product_id` varchar(36) NOT NULL,
  `quantity` int NOT NULL,
  `order_number` int NOT NULL,
  PRIMARY KEY (`user_id`,`product_id`),
  KEY `order_number` (`order_number`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `product_id`, `quantity`, `order_number`) VALUES
('66260298d176d', '66198ba2d8ca8', 2, 760589);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `number` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`number`, `date`) VALUES
(170449, '2024-04-11'),
(194272, '2024-04-12'),
(382117, '2024-04-16'),
(387677, '2024-04-16'),
(388088, '2024-04-20'),
(470769, '2024-04-16'),
(480394, '2024-04-12'),
(579351, '2024-04-12'),
(607510, '2024-04-12'),
(654710, '2024-04-12'),
(760589, '2024-04-22'),
(925525, '2024-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `order_number` int NOT NULL,
  `product_id` varchar(36) NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `product_subtotal` int NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`order_number`,`product_id`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_number`, `product_id`, `quantity`, `price`, `product_subtotal`, `user_id`, `order_status`) VALUES
(170449, '66183d675e715', 2, 20, 40, '66183190999b9', 'Processing'),
(170449, '66183d7f02557', 1, 20, 20, '66183190999b9', 'Ready for Pickup'),
(194272, '66183d675e715', 2, 20, 40, '6619045a5c82c', 'Ready for Pickup'),
(382117, '66183d675e715', 2, 20, 40, '66183190999b9', 'Waiting for confirmation'),
(382117, '66198ba2d8ca8', 2, 20, 40, '66183190999b9', 'Waiting for confirmation'),
(387677, '66183d675e715', 3, 20, 60, '6619045a5c82c', 'Processing'),
(388088, '66183d675e715', 3, 30, 90, '66183190999b9', 'Waiting for confirmation'),
(388088, '66198ba2d8ca8', 2, 30, 60, '66183190999b9', 'Waiting for confirmation'),
(480394, '66183d7f02557', 2, 20, 40, '6619045a5c82c', 'Waiting for confirmation'),
(579351, '66183d7f02557', 2, 20, 40, '66183190999b9', 'Ready for Pickup'),
(607510, '66183d7f02557', 2, 20, 40, '6619045a5c82c', 'Processing'),
(654710, '66198ba2d8ca8', 4, 20, 80, '6619045a5c82c', 'Waiting for confirmation'),
(925525, '66183d675e715', 2, 20, 40, '66183190999b9', 'Waiting for confirmation');

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_details_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `order_details_view`;
CREATE TABLE IF NOT EXISTS `order_details_view` (
`category` varchar(50)
,`description` text
,`image_path` varchar(255)
,`order_date` date
,`order_number` int
,`order_status` varchar(50)
,`price` int
,`product_id` varchar(36)
,`product_name` varchar(255)
,`product_subtotal` int
,`quantity` int
,`seller_id` varchar(36)
,`seller_name` varchar(255)
,`user_email` varchar(255)
,`user_id` varchar(36)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `order_view`;
CREATE TABLE IF NOT EXISTS `order_view` (
`date` date
,`order_number` int
,`price` int
,`product_name` varchar(255)
,`product_subtotal` int
,`quantity` int
);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` varchar(36) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` text,
  `quantity` int DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `category`, `description`, `quantity`, `image_path`) VALUES
('66183d675e715', 'Kenjie', 30.00, 'electronics', 'desc3', 20, '../../productImages/Screenshot 2023-09-12 230054.png'),
('66183d7f02557', 'Abhi', 0.00, 'tools', 'Yo', 15, '../../productImages/Screenshot 2023-09-05 153603.png'),
('66198ba2d8ca8', 'Kenjie', 30.00, 'electronics', 'desc3', 20, '../../productImages/Screenshot 2023-09-12 230054.png'),
('6626046709ec3', '', 0.00, 'electronics', '', 0, '../../productImages/PP Bryan.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_seller_junction`
--

DROP TABLE IF EXISTS `product_seller_junction`;
CREATE TABLE IF NOT EXISTS `product_seller_junction` (
  `product_id` varchar(36) NOT NULL,
  `seller_id` varchar(36) NOT NULL,
  PRIMARY KEY (`product_id`,`seller_id`),
  KEY `fk_product_seller_junction_seller_id` (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_seller_junction`
--

INSERT INTO `product_seller_junction` (`product_id`, `seller_id`) VALUES
('66183d675e715', '66183d4ce1d2f'),
('66183d7f02557', '66183d4ce1d2f'),
('66198ba2d8ca8', '66198b8d73d36'),
('6626046709ec3', '6626043b19eed');

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_seller_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `product_seller_view`;
CREATE TABLE IF NOT EXISTS `product_seller_view` (
`category` varchar(50)
,`description` text
,`image_path` varchar(255)
,`price` decimal(12,2)
,`product_id` varchar(36)
,`product_name` varchar(255)
,`quantity` int
,`seller_id` varchar(36)
,`store_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
CREATE TABLE IF NOT EXISTS `sellers` (
  `id` varchar(36) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `store_name`, `password`) VALUES
('66183d4ce1d2f', 'testseller1', '$2y$10$O5oWbqZGFzgYXEn71GN7kOwfHkYPu14MSZVYp0tWgCpqksRZm7j56'),
('66198b8d73d36', 'testseller2', '$2y$10$7aIkxnQERVYMveYt5FmH6.LEORmOXPUmCehIbsyDr9Qud.Z/p7H8a'),
('6626043b19eed', 'rohitseller', '$2y$10$9asmnbGiA1qLyyPwEXYkIeNF3XAq0DGlBFEnHrkolxxjcMDWEn5qC');

-- --------------------------------------------------------

--
-- Table structure for table `sellersecurityquestions`
--

DROP TABLE IF EXISTS `sellersecurityquestions`;
CREATE TABLE IF NOT EXISTS `sellersecurityquestions` (
  `seller_id` varchar(36) NOT NULL,
  `question_1` varchar(255) NOT NULL,
  `answer_1` varchar(255) NOT NULL,
  `question_2` varchar(255) NOT NULL,
  `answer_2` varchar(255) NOT NULL,
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sellersecurityquestions`
--

INSERT INTO `sellersecurityquestions` (`seller_id`, `question_1`, `answer_1`, `question_2`, `answer_2`) VALUES
('66183d4ce1d2f', 'pet_name', 'pet1', 'grandmother_name', 'grandma1'),
('66198b8d73d36', 'pet_name', 'pet2', 'grandmother_name', 'grandma2'),
('6626043b19eed', 'pet_name', 'pet', 'grandmother_name', 'grandma');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(36) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
('66183190999b9', 'test1@gmail.com', '$2y$10$qt8zgyE0xjtIZERHKTiub.2dpnhVPgT3XwzPqcMMft1sXnGgQ4Aki'),
('6619045a5c82c', 'test2@gmail.com', '$2y$10$P9WIZmveRPKszCrgF6f8/OSNoU1nUh6l0WjtJGEDixjMmrO3QXWNi'),
('66260298d176d', 'rohit15033@gmail.com', '$2y$10$Wwd4BzZEurSfjE7HPf5CuOPajAkbG9VyxEpq3TL7J6GssO3.2C9KS');

-- --------------------------------------------------------

--
-- Table structure for table `usersecurityquestions`
--

DROP TABLE IF EXISTS `usersecurityquestions`;
CREATE TABLE IF NOT EXISTS `usersecurityquestions` (
  `user_id` varchar(36) NOT NULL,
  `question_1` varchar(255) NOT NULL,
  `answer_1` varchar(255) NOT NULL,
  `question_2` varchar(255) NOT NULL,
  `answer_2` varchar(255) NOT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usersecurityquestions`
--

INSERT INTO `usersecurityquestions` (`user_id`, `question_1`, `answer_1`, `question_2`, `answer_2`) VALUES
('66183190999b9', 'maiden_name', 'mom1', 'favorite_color', 'color1'),
('6619045a5c82c', 'maiden_name', 'mom2', 'favorite_color', 'color2'),
('66260298d176d', 'maiden_name', 'mom1', 'favorite_color', 'color1');

-- --------------------------------------------------------

--
-- Table structure for table `user_seller_junction`
--

DROP TABLE IF EXISTS `user_seller_junction`;
CREATE TABLE IF NOT EXISTS `user_seller_junction` (
  `user_id` varchar(36) NOT NULL,
  `seller_id` varchar(36) NOT NULL,
  PRIMARY KEY (`user_id`,`seller_id`),
  KEY `fk_user_seller_junction_seller_id` (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_seller_junction`
--

INSERT INTO `user_seller_junction` (`user_id`, `seller_id`) VALUES
('66183190999b9', '661831aac6a2b'),
('66183190999b9', '661832ab118eb'),
('66183190999b9', '66183c94670b7'),
('66183190999b9', '66183d4ce1d2f'),
('6619045a5c82c', '66198b8d73d36'),
('66260298d176d', '6626043b19eed');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_seller_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `user_seller_view`;
CREATE TABLE IF NOT EXISTS `user_seller_view` (
`seller_id` varchar(36)
,`seller_store_name` varchar(255)
,`user_email` varchar(255)
,`user_id` varchar(36)
);

-- --------------------------------------------------------

--
-- Structure for view `order_details_view`
--
DROP TABLE IF EXISTS `order_details_view`;

DROP VIEW IF EXISTS `order_details_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_details_view`  AS SELECT `o`.`number` AS `order_number`, `o`.`date` AS `order_date`, `od`.`product_id` AS `product_id`, `p`.`product_name` AS `product_name`, `od`.`price` AS `price`, `p`.`category` AS `category`, `p`.`description` AS `description`, `od`.`quantity` AS `quantity`, `p`.`image_path` AS `image_path`, `od`.`product_subtotal` AS `product_subtotal`, `od`.`order_status` AS `order_status`, `od`.`user_id` AS `user_id`, `u`.`email` AS `user_email`, `s`.`id` AS `seller_id`, `s`.`store_name` AS `seller_name` FROM (((((`orders` `o` join `order_details` `od` on((`o`.`number` = `od`.`order_number`))) join `products` `p` on((`od`.`product_id` = `p`.`id`))) join `users` `u` on((`od`.`user_id` = `u`.`id`))) join `product_seller_junction` `psj` on((`p`.`id` = `psj`.`product_id`))) join `sellers` `s` on((`psj`.`seller_id` = `s`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `order_view`
--
DROP TABLE IF EXISTS `order_view`;

DROP VIEW IF EXISTS `order_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_view`  AS SELECT `od`.`order_number` AS `order_number`, `p`.`product_name` AS `product_name`, `od`.`quantity` AS `quantity`, `od`.`price` AS `price`, `od`.`product_subtotal` AS `product_subtotal`, `o`.`date` AS `date` FROM ((`order_details` `od` join `products` `p` on((`od`.`product_id` = `p`.`id`))) join `orders` `o` on((`od`.`order_number` = `o`.`number`))) ;

-- --------------------------------------------------------

--
-- Structure for view `product_seller_view`
--
DROP TABLE IF EXISTS `product_seller_view`;

DROP VIEW IF EXISTS `product_seller_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_seller_view`  AS SELECT `p`.`id` AS `product_id`, `p`.`product_name` AS `product_name`, `p`.`price` AS `price`, `p`.`category` AS `category`, `p`.`description` AS `description`, `p`.`quantity` AS `quantity`, `p`.`image_path` AS `image_path`, `s`.`id` AS `seller_id`, `s`.`store_name` AS `store_name` FROM ((`products` `p` join `product_seller_junction` `psj` on((`p`.`id` = `psj`.`product_id`))) join `sellers` `s` on((`psj`.`seller_id` = `s`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_seller_view`
--
DROP TABLE IF EXISTS `user_seller_view`;

DROP VIEW IF EXISTS `user_seller_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_seller_view`  AS SELECT `u`.`id` AS `user_id`, `u`.`email` AS `user_email`, `s`.`id` AS `seller_id`, `s`.`store_name` AS `seller_store_name` FROM ((`users` `u` join `user_seller_junction` `usj` on((`u`.`id` = `usj`.`user_id`))) join `sellers` `s` on((`usj`.`seller_id` = `s`.`id`))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`order_number`) REFERENCES `orders` (`number`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id`) REFERENCES `product_seller_junction` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_seller_junction`
--
ALTER TABLE `product_seller_junction`
  ADD CONSTRAINT `fk_product_seller_junction_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `sellers_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user_seller_junction` (`seller_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sellersecurityquestions`
--
ALTER TABLE `sellersecurityquestions`
  ADD CONSTRAINT `sellersecurityquestions_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usersecurityquestions`
--
ALTER TABLE `usersecurityquestions`
  ADD CONSTRAINT `usersecurityquestions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_seller_junction`
--
ALTER TABLE `user_seller_junction`
  ADD CONSTRAINT `fk_user_seller_junction_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
