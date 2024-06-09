-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 09, 2024 at 05:02 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `x-oop`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id` int NOT NULL,
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'Tranh treo tường'),
(4, 'Bàn ghế'),
(5, 'Kệ sách'),
(6, 'Thảm trải sàn'),
(7, 'Đèn trang trí'),
(8, 'Gương'),
(9, 'Đồng hồ'),
(10, 'Bình hoa');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `shiping_name` varchar(255) DEFAULT NULL,
  `shiping_email` varchar(255) DEFAULT NULL,
  `shiping_phone` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `status_delivery` enum('0','1','2','3','4','5') NOT NULL DEFAULT '0',
  `status_payment` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `upload_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price_regular` int NOT NULL,
  `price_sale` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `img_thumbnail` varchar(255) DEFAULT NULL,
  `overview` varchar(255) DEFAULT NULL,
  `price_sale` int DEFAULT NULL,
  `price_regular` int NOT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `img_thumbnail`, `overview`, `price_sale`, `price_regular`, `content`, `created_at`, `updated_at`, `views`) VALUES
(16, 3, 'Tranh treo tường phong cảnh', 'landscape.jpg', 'Tranh treo tường phong cảnh thiên nhiên', NULL, 500000, 'Tranh treo tường phong cảnh với chất liệu cao cấp, tái tạo lại vẻ đẹp tự nhiên', '2024-06-09 07:58:17', '2024-06-09 07:58:17', 0),
(17, 4, 'Bàn làm việc gỗ tự nhiên', 'wooden_desk.jpg', 'Bàn làm việc gỗ tự nhiên sang trọng', NULL, 2500000, 'Bàn làm việc gỗ tự nhiên với thiết kế đẹp mắt, chất lượng cao', '2024-06-09 07:58:17', '2024-06-09 07:58:17', 0),
(18, 5, 'Kệ sách gỗ', 'wooden_shelf.jpg', 'Kệ sách gỗ đa năng', NULL, 800000, 'Kệ sách gỗ với thiết kế đa năng, tiện lợi cho việc sắp xếp sách báo', '2024-06-09 07:58:17', '2024-06-09 07:58:17', 0),
(19, 6, 'Thảm trang trí phòng', 'carpet.jpg', 'Thảm trang trí phòng mềm mại', NULL, 600000, 'Thảm trang trí phòng với chất liệu mềm mại, tạo điểm nhấn cho không gian', '2024-06-09 07:58:17', '2024-06-09 07:58:17', 0),
(20, 7, 'Đèn trang trí phòng trần', 'ceiling_light.jpg', 'Đèn trang trí phòng trần hiện đại', NULL, 1200000, 'Đèn trang trí phòng trần với thiết kế hiện đại, phù hợp cho mọi không gian', '2024-06-09 07:58:17', '2024-06-09 07:58:17', 0),
(21, 8, 'Gương trang trí', 'decorative_mirror.jpg', 'Gương trang trí kiểu dáng hiện đại', NULL, 900000, 'Gương trang trí với khung viền tinh tế, mang lại vẻ đẹp sang trọng cho căn phòng', '2024-06-09 07:58:17', '2024-06-09 07:58:17', 0),
(22, 9, 'Đồng hồ treo tường nghệ thuật', 'wall_clock.jpg', 'Đồng hồ treo tường nghệ thuật độc đáo', NULL, 750000, 'Đồng hồ treo tường với thiết kế nghệ thuật, tạo điểm nhấn cho không gian sống', '2024-06-09 07:58:17', '2024-06-09 07:58:17', 0),
(23, 10, 'Bình hoa gốm sứ', 'ceramic_vase.jpg', 'Bình hoa gốm sứ đẹp mắt', NULL, 450000, 'Bình hoa gốm sứ với thiết kế đẹp mắt, phù hợp cho mọi không gian', '2024-06-09 07:58:17', '2024-06-09 07:58:17', 0),
(24, 3, 'Tranh treo tường hoa', 'flowers.jpg', 'Tranh treo tường hoa phong cách hiện đại', NULL, 450000, 'Tranh treo tường hoa với hình ảnh hoa rực rỡ, phong cách tươi mới', '2024-06-09 07:58:17', '2024-06-09 07:58:17', 0),
(25, 3, 'Tranh treo tường trừu tượng', 'abstract.jpg', 'Tranh treo tường trừu tượng sáng tạo', NULL, 550000, 'Tranh treo tường trừu tượng với những hình ảnh độc đáo, phù hợp với không gian hiện đại', '2024-06-09 07:58:17', '2024-06-09 07:58:17', 0),
(26, 4, 'Bàn trà gỗ', 'wooden_tea_table.jpg', 'Bàn trà gỗ nhỏ gọn', NULL, 1500000, 'Bàn trà gỗ với thiết kế nhỏ gọn, phù hợp cho phòng khách', '2024-06-09 07:58:17', '2024-06-09 07:58:17', 0),
(27, 7, 'Đèn bàn làm việc', 'desk_lamp.jpg', 'Đèn bàn làm việc hiện đại', NULL, 700000, 'Đèn bàn làm việc với thiết kế hiện đại, ánh sáng dịu nhẹ', '2024-06-09 07:58:17', '2024-06-09 07:58:17', 0),
(28, 3, 'Tranh treo tường động vật', 'animal_painting.jpg', 'Tranh treo tường động vật sinh động', NULL, 500000, 'Tranh treo tường động vật với hình ảnh sống động và chân thực', '2024-06-09 08:02:50', '2024-06-09 08:02:50', 0),
(29, 4, 'Ghế sofa hiện đại', 'modern_sofa.jpg', 'Ghế sofa hiện đại thoải mái', NULL, 3000000, 'Ghế sofa hiện đại với thiết kế thoải mái, phù hợp cho phòng khách', '2024-06-09 08:02:50', '2024-06-09 08:02:50', 0),
(30, 5, 'Kệ sách treo tường', 'wall_shelf.jpg', 'Kệ sách treo tường tiện lợi', NULL, 400000, 'Kệ sách treo tường với thiết kế tiện lợi, tiết kiệm không gian', '2024-06-09 08:02:50', '2024-06-09 08:02:50', 0),
(31, 6, 'Thảm lông xù', 'shaggy_rug.jpg', 'Thảm lông xù êm ái', NULL, 700000, 'Thảm lông xù với chất liệu êm ái, tạo cảm giác thoải mái cho người sử dụng', '2024-06-09 08:02:50', '2024-06-09 08:02:50', 0),
(32, 7, 'Đèn ngủ', 'bedside_lamp.jpg', 'Đèn ngủ phong cách cổ điển', NULL, 600000, 'Đèn ngủ với thiết kế cổ điển, tạo không gian ấm cúng', '2024-06-09 08:02:50', '2024-06-09 08:02:50', 0),
(33, 8, 'Gương toàn thân', 'full_length_mirror.jpg', 'Gương toàn thân đẹp mắt', NULL, 1200000, 'Gương toàn thân với khung viền đẹp mắt, phù hợp cho phòng ngủ', '2024-06-09 08:02:50', '2024-06-09 08:02:50', 0),
(34, 9, 'Đồng hồ để bàn', 'desk_clock.jpg', 'Đồng hồ để bàn sang trọng', NULL, 450000, 'Đồng hồ để bàn với thiết kế sang trọng, phù hợp cho bàn làm việc', '2024-06-09 08:02:50', '2024-06-09 08:02:50', 0),
(35, 10, 'Bình hoa thủy tinh', 'glass_vase.jpg', 'Bình hoa thủy tinh tinh tế', NULL, 500000, 'Bình hoa thủy tinh với thiết kế tinh tế, phù hợp cho mọi không gian', '2024-06-09 08:02:50', '2024-06-09 08:02:50', 0),
(36, 3, 'Tranh treo tường cảnh biển', 'seascape.jpg', 'Tranh treo tường cảnh biển tuyệt đẹp', NULL, 550000, 'Tranh treo tường cảnh biển với hình ảnh sống động, tạo cảm giác thoáng đãng', '2024-06-09 08:02:50', '2024-06-09 08:02:50', 0),
(37, 4, 'Bàn trang điểm', 'dressing_table.jpg', 'Bàn trang điểm tiện nghi', NULL, 2500000, 'Bàn trang điểm với thiết kế tiện nghi, phù hợp cho phòng ngủ', '2024-06-09 08:02:50', '2024-06-09 08:02:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('admin','member') NOT NULL DEFAULT 'member',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `password`, `type`, `created_at`, `updated_at`) VALUES
(119, 'Nguyen Anh Kim 3', 'assets/uploads/avatar.jpg', 'Member3@poly.edu.vn', '$2y$10$t59Mozk85dIAfhwXfHUAp.IC4dQ9SnauR9DRfj7TEaVvzegjviLNG', 'member', '2024-06-05 18:30:33', '2024-06-05 18:30:33'),
(120, 'Nguyen Anh Kim 4', 'assets/uploads/avatar.jpg', 'admin@poly.edu.vn', '$2y$10$qOxSF9ex5301iwe9urxMNe.6zOBNLLNNRlOCSHDmLX64JfW/vVhdy', 'admin', '2024-06-05 18:30:33', '2024-06-05 18:30:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_id` (`cart_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_users` (`user_id`),
  ADD KEY `fk_comments_products` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
