-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 01:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mamasboy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `card_payment_details`
--

CREATE TABLE `card_payment_details` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `account_number` int(11) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `provideer` varchar(255) NOT NULL,
  `expiry_date` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cart_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `image_id`) VALUES
(0, 'Kota', '0', NULL),
(1, 'Chips', '0', NULL),
(2, 'Extras', '0', NULL),
(11, 'new category', 'Some Description', 19),
(12, 'new category', 'Some Description', NULL),
(13, 'neo', 'dfghjkl', 22),
(14, 'neo', 'dfghjkl', NULL),
(15, 'neo', 'dfghjkl', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verified` int(1) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `surname`, `address`, `email`, `phone`, `password`, `created_at`, `verified`, `cart_id`, `card_id`) VALUES
(1, 'junior', NULL, '515 this address is wherer it goes down', 'neo@email.com', '01239634865', 'cf0b854f5a17fdad773d462438d4d7328722b817d40a74ecb8d9ad79f98aa251', '2023-11-17 09:32:08', 1, NULL, NULL),
(2, 'junior', NULL, '515 this address is wherer it goes down', 'neo@email.com', '01239634865', 'cf0b854f5a17fdad773d462438d4d7328722b817d40a74ecb8d9ad79f98aa251', '2023-11-17 09:32:02', 1, NULL, NULL),
(11, 'neo', 'tom', '123 address street', 'neocamtom@gmail.com', '0123456789', '326f882a02d0192e91bf321100cfef69080779d69b56742eb4e53371cce79b12', '2023-11-17 18:13:29', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_staff_activation`
--

CREATE TABLE `customer_staff_activation` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `counter` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_staff_activation`
--

INSERT INTO `customer_staff_activation` (`id`, `email`, `selector`, `token`, `counter`) VALUES
(25, 'books@email.com', '61dad5a79632678d', '$2y$10$r70paUSkFfsow5T4DFohZ.cD3jipCGjlaMozYKWl5/xi0YnLmpAw.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `location`, `product_id`, `category_id`) VALUES
(19, 'eggs.jpg', '../assets/images/category/eggs.jpg', NULL, 11),
(20, 'eggs.jpg', '../assets/images/category/eggs.jpg', NULL, 11),
(22, 'Khosa.jpg', '../assets/images/category/Khosa.jpg', NULL, 13),
(23, 'Khosa.jpg', '../assets/images/category/Khosa.jpg', NULL, 13),
(24, 'Khosa.jpg', '../assets/images/category/Khosa.jpg', NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` varchar(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `surname`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'junior', 'akakak', 'neo@email.com', '01239634865', 'hfhfhkhfkhsf', '2023-11-10 11:30:19'),
(2, 'Phillip Choshi', 'Choshi', 'spchoshi@gmail.com', '0724041157', 'Do you have ', '2023-11-10 14:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` varchar(255) NOT NULL,
  `stock_limit` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `stock_limit`, `category_id`, `image_id`) VALUES
(4, 'Porche', 22, 'Bread, Atchar, Polony, Chips & Vienna', 0, 0, NULL),
(5, 'Mahindra', 23, 'Bread, Atchar, Polony, Chips & Cheese', 0, 0, NULL),
(6, 'Mustang', 27, 'Bread, Atchar, Polony, Chips & Eggs', 0, 0, NULL),
(7, 'Rolce Royce', 30, 'Bread, Atchar, Polony, Chips & Russian', 0, 0, NULL),
(8, 'Mini Cooper', 35, 'Bread, Atchar, Polony, Chips, Russian & Vienna', 0, 0, NULL),
(9, 'Polo', 40, 'Bread, Atchar, Polony, Chips, Russian, Vienna & Cheese', 0, 0, NULL),
(10, 'Bently', 50, 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese & Burger', 0, 0, NULL),
(11, 'Staria', 60, 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger & Egg', 0, 0, NULL),
(12, 'Lambogini', 70, 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger, Egg & Fish Finger', 0, 0, NULL),
(13, 'Toyota', 80, 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger, Egg, Fish Finger & Bacon', 0, 0, NULL),
(14, 'Small', 40, '', 0, 1, NULL),
(15, 'Medium', 55, '', 0, 1, NULL),
(16, 'Large', 70, '', 0, 1, NULL),
(17, 'Egg', 12, '', 0, 2, NULL),
(18, 'Russian', 15, '', 0, 2, NULL),
(19, 'Vienna', 10, '', 0, 2, NULL),
(20, 'Cheese', 10, '', 0, 2, NULL),
(21, 'Burger', 15, '', 0, 2, NULL),
(22, 'Fish Finger', 12, '', 0, 2, NULL),
(23, 'Bacon', 13, '', 0, 2, NULL),
(24, 'Polony', 5, '', 0, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pwd_reset`
--

CREATE TABLE `pwd_reset` (
  `reset_id` int(11) NOT NULL,
  `pwd_email` varchar(255) NOT NULL,
  `pwd_selector` text NOT NULL,
  `pwd_token` longtext NOT NULL,
  `pwd_counter` int(1) NOT NULL DEFAULT 0,
  `pwd_expiry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pwd_reset`
--

INSERT INTO `pwd_reset` (`reset_id`, `pwd_email`, `pwd_selector`, `pwd_token`, `pwd_counter`, `pwd_expiry`) VALUES
(5, 'books@email.com', '2a8e85501480463d', '$2y$10$OnIvR.mbyjl4PlNiRs5wVe6UR3DR/3Skc8FuP5Swaqg/CbTJLPEk6', 0, '1700025618');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `email`, `review`, `rating`, `created_at`) VALUES
(1, 'neo', 'books@email.com', 'this is my review', 2, '2023-11-17 07:59:06'),
(2, 'neo', 'books@email.com', 'this is my review', 2, '2023-11-17 07:59:50');

-- --------------------------------------------------------

--
-- Table structure for table `shop_order`
--

CREATE TABLE `shop_order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `order_total` decimal(10,0) NOT NULL,
  `order_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_order`
--

INSERT INTO `shop_order` (`id`, `customer_id`, `name`, `email`, `phone`, `order_total`, `order_items`, `order_status`, `payment_method`, `paid`, `created_at`, `updated_at`, `staff_id`) VALUES
(1, NULL, 'neo', 'neo@email.com', '12345', 106, '[{\"id\":5,\"quantity\":1},{\"id\":19,\"quantity\":2},{\"id\":10,\"quantity\":1}]', '', 'cash', 0, '2023-11-07 19:17:34', '2023-11-07 17:17:34', NULL),
(2, NULL, 'tom', 'tom@email.com', '1234567890', 106, '[{\"id\":5,\"quantity\":1},{\"id\":19,\"quantity\":2},{\"id\":10,\"quantity\":1}]', '', 'cash', 0, '2023-11-07 19:19:33', '2023-11-07 17:19:33', NULL),
(3, NULL, 'tom', 'tom@email.com', '1234567890', 106, '[{\"id\":5,\"quantity\":1},{\"id\":19,\"quantity\":2},{\"id\":10,\"quantity\":1}]', 'Completed', 'cash', 0, '2023-11-07 19:22:29', '2023-11-10 13:36:35', NULL),
(4, NULL, 'junior', 'jj@email.com', '671234567', 106, '[{\"id\":5,\"quantity\":1},{\"id\":19,\"quantity\":2},{\"id\":10,\"quantity\":1}]', '', 'cash', 0, '2023-11-07 19:52:00', '2023-11-07 17:52:00', NULL),
(5, NULL, 'glad', 'glad@email.com', '671234567', 133, '[{\"id\":19,\"quantity\":1},{\"id\":5,\"quantity\":1},{\"id\":10,\"quantity\":2}]', '', 'cash', 0, '2023-11-08 08:25:14', '2023-11-08 06:25:14', NULL),
(9, NULL, 'tom', 'tom@email.com', '01234567896', 288, '[{\"id\":5,\"quantity\":4},{\"id\":4,\"quantity\":3},{\"id\":7,\"quantity\":1},{\"id\":10,\"quantity\":1},{\"id\":8,\"quantity\":1},{\"id\":18,\"quantity\":1}]', 'NotStarted', 'card', 0, '2023-11-14 00:02:31', '2023-11-13 22:02:31', NULL),
(10, NULL, 'neo', 'tom@email.com', '01234567896', 96, '[{\"id\":4,\"quantity\":3},{\"id\":7,\"quantity\":1}]', 'NotStarted', 'cash', 0, '2023-11-14 00:49:14', '2023-11-13 22:49:14', NULL),
(11, NULL, 'tom', 'neo@email.com', '01234567896', 81, '[{\"id\":5,\"quantity\":2},{\"id\":8,\"quantity\":1}]', 'NotStarted', 'card', 0, '2023-11-14 00:58:09', '2023-11-13 22:58:09', NULL),
(12, NULL, 'tom', 'neo@email.com', '01234567896', 46, '[{\"id\":5,\"quantity\":2}]', 'NotStarted', 'card', 0, '2023-11-14 01:03:59', '2023-11-13 23:03:59', NULL),
(13, NULL, 'tom', 'neo@email.com', '01234567896', 46, '[{\"id\":5,\"quantity\":2}]', 'NotStarted', 'card', 0, '2023-11-14 01:06:28', '2023-11-13 23:06:28', NULL),
(14, NULL, 'tom', 'neo@email.com', '01234567896', 46, '[{\"id\":5,\"quantity\":2}]', 'NotStarted', 'card', 0, '2023-11-14 01:08:16', '2023-11-13 23:08:16', NULL),
(15, NULL, 'tom', 'neo@email.com', '01234567896', 90, '[{\"id\":9,\"quantity\":1},{\"id\":10,\"quantity\":1}]', 'Started', 'cash', 0, '2023-11-14 01:17:03', '2023-11-13 23:24:40', NULL),
(16, NULL, 'jeje', 'cameron@gmail.com', '0123456789', 72, '[{\"id\":3,\"quantity\":1},{\"id\":5,\"quantity\":1},{\"id\":6,\"quantity\":1}]', 'NotStarted', 'card', 0, '2023-11-14 16:15:31', '2023-11-14 14:15:31', NULL),
(18, NULL, 'jeje', 'cameron@gmail.com', '0123456789', 72, '[{\"id\":3,\"quantity\":1},{\"id\":5,\"quantity\":1},{\"id\":6,\"quantity\":1}]', 'Started', 'cash', 0, '2023-11-14 16:19:52', '2023-11-14 14:24:55', NULL),
(21, NULL, 'neo', 'neocamtom@gmail.com', '0672837571', 27, '[{\"id\":6,\"quantity\":1}]', 'NotStarted', 'cash', 0, '2023-11-15 09:08:34', '2023-11-15 07:08:34', NULL),
(22, NULL, 'neo', 'neocamtom@gmail.com', '0672837571', 27, '[{\"id\":6,\"quantity\":1}]', 'NotStarted', 'cash', 0, '2023-11-15 09:10:13', '2023-11-15 07:10:13', NULL),
(23, NULL, 'tom', 'neocamtom@gmail.com', '7896541230', 27, '[{\"id\":6,\"quantity\":1}]', 'Completed', 'card', 0, '2023-11-15 09:14:45', '2023-11-17 20:42:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verified` int(1) NOT NULL DEFAULT 1,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `surname`, `email`, `phone`, `password`, `created_at`, `verified`, `type`) VALUES
(9, 'Techie Geeks', 'TG', 'techie.geeks@email.com', '012789541', '94c46f1e99a3c7cab332e3498b766c52f155d7ec120e48b3e2666f4b9f924f66', '2023-11-14 14:49:29', 1, 'admin'),
(10, 'Bongani', 'Libisi', 'bongani.libisi@email.com', '0123456789', 'cf2ee54de8b2ddd62ded84cd774a42300544a241bd386ebdd93cafa431b9fab9', '2023-11-14 14:51:18', 1, 'kitchen'),
(44, 'neo', 'tom', 'neocamtom@gmail.com', '0761234567', '6c8b9f20e598f611bb74fe87d404458633775cf0fd87092b98f45f23d730e21d', '2023-11-17 08:21:17', 1, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_payment_details`
--
ALTER TABLE `card_payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_payment_details_fk_customerid` (`customer_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_fk_customerid` (`customer_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_fk_imageid` (`image_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_fk_cartid` (`cart_id`),
  ADD KEY `customer_fk_cardPaymentDetailsId` (`card_id`);

--
-- Indexes for table `customer_staff_activation`
--
ALTER TABLE `customer_staff_activation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_fk_productid` (`product_id`),
  ADD KEY `images_fk_categoryid` (`category_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_fk_categoryid` (`category_id`),
  ADD KEY `product_fk_imageId` (`image_id`);

--
-- Indexes for table `pwd_reset`
--
ALTER TABLE `pwd_reset`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_order`
--
ALTER TABLE `shop_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_order_fk_customerid` (`customer_id`),
  ADD KEY `shop_order_fk_staffid` (`staff_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_payment_details`
--
ALTER TABLE `card_payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer_staff_activation`
--
ALTER TABLE `customer_staff_activation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `pwd_reset`
--
ALTER TABLE `pwd_reset`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shop_order`
--
ALTER TABLE `shop_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card_payment_details`
--
ALTER TABLE `card_payment_details`
  ADD CONSTRAINT `card_payment_details_fk_customerid` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_fk_customerid` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_fk_imageid` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_fk_cardPaymentDetailsId` FOREIGN KEY (`card_id`) REFERENCES `card_payment_details` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `customer_fk_cartid` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_fk_categoryid` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `images_fk_productid` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_order`
--
ALTER TABLE `shop_order`
  ADD CONSTRAINT `shop_order_fk_customerid` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shop_order_fk_staffid` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
