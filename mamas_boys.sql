-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2023 at 07:17 PM
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
-- Database: `mamas_boys`
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
  `description` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `image_id`) VALUES
(0, 'Kota', 0, NULL),
(1, 'Chips', 0, NULL),
(2, 'Extras', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cart_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `category_id`) VALUES
(3, 'Porche', 22, 'Bread, Atchar, Polony, Chips & Vienna', 0),
(4, 'Porche', 22, 'Bread, Atchar, Polony, Chips & Vienna', 0),
(5, 'Mahindra', 23, 'Bread, Atchar, Polony, Chips & Cheese', 0),
(6, 'Mustang', 27, 'Bread, Atchar, Polony, Chips & Eggs', 0),
(7, 'Rolce Royce', 30, 'Bread, Atchar, Polony, Chips & Russian', 0),
(8, 'Mini Cooper', 35, 'Bread, Atchar, Polony, Chips, Russian & Vienna', 0),
(9, 'Polo', 40, 'Bread, Atchar, Polony, Chips, Russian, Vienna & Cheese', 0),
(10, 'Bently', 50, 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese & Burger', 0),
(11, 'Staria', 60, 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger & Egg', 0),
(12, 'Lambogini', 70, 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger, Egg & Fish Finger', 0),
(13, 'Toyota', 80, 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger, Egg, Fish Finger & Bacon', 0),
(14, 'Small', 40, '', 1),
(15, 'Medium', 55, '', 1),
(16, 'Large', 70, '', 1),
(17, 'Egg', 12, '', 2),
(18, 'Russian', 15, '', 2),
(19, 'Vienna', 10, '', 2),
(20, 'Cheese', 10, '', 2),
(21, 'Burger', 15, '', 2),
(22, 'Fish Finger', 12, '', 2),
(23, 'Bacon', 13, '', 2),
(24, 'Polony', 5, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shop_order`
--

CREATE TABLE `shop_order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
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
(1, NULL, 'neo', 'neo@email.com', 12345, 106, '[{\"id\":5,\"quantity\":1},{\"id\":19,\"quantity\":2},{\"id\":10,\"quantity\":1}]', '', 'cash', 0, '2023-11-07 19:17:34', '2023-11-07 17:17:34', NULL),
(2, NULL, 'tom', 'tom@email.com', 1234567890, 106, '[{\"id\":5,\"quantity\":1},{\"id\":19,\"quantity\":2},{\"id\":10,\"quantity\":1}]', '', 'cash', 0, '2023-11-07 19:19:33', '2023-11-07 17:19:33', NULL),
(3, NULL, 'tom', 'tom@email.com', 1234567890, 106, '[{\"id\":5,\"quantity\":1},{\"id\":19,\"quantity\":2},{\"id\":10,\"quantity\":1}]', '', 'cash', 0, '2023-11-07 19:22:29', '2023-11-07 17:22:29', NULL),
(4, NULL, 'junior', 'jj@email.com', 671234567, 106, '[{\"id\":5,\"quantity\":1},{\"id\":19,\"quantity\":2},{\"id\":10,\"quantity\":1}]', '', 'cash', 0, '2023-11-07 19:52:00', '2023-11-07 17:52:00', NULL),
(5, NULL, 'glad', 'glad@email.com', 671234567, 133, '[{\"id\":19,\"quantity\":1},{\"id\":5,\"quantity\":1},{\"id\":10,\"quantity\":2}]', '', 'cash', 0, '2023-11-08 08:25:14', '2023-11-08 06:25:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_fk_productid` (`product_id`),
  ADD KEY `images_fk_categoryid` (`category_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_fk_categoryid` (`category_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `shop_order`
--
ALTER TABLE `shop_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card_payment_details`
--
ALTER TABLE `card_payment_details`
  ADD CONSTRAINT `card_payment_details_fk_customerid` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_fk_customerid` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_fk_imageid` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_fk_cardPaymentDetailsId` FOREIGN KEY (`card_id`) REFERENCES `card_payment_details` (`id`),
  ADD CONSTRAINT `customer_fk_cartid` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_fk_categoryid` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `images_fk_productid` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_fk_categoryid` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `shop_order`
--
ALTER TABLE `shop_order`
  ADD CONSTRAINT `shop_order_fk_customerid` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `shop_order_fk_staffid` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
