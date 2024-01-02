-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 11:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(1, 155.00, 'on_hold', 1, 1270256373, 'zayed', 'gizzaa', '2024-01-01 14:19:02'),
(3, 310.00, 'on_hold', 1, 120121489, 'elmohandseen', 'cairo', '2024-01-01 14:57:29'),
(4, 310.00, 'on_hold', 1, 120121489, 'elmohandseen', 'cairo', '2024-01-01 14:58:23'),
(5, 155.00, 'on_hold', 1, 1270256373, 'zayed', 'gizzzzzzzaaaaa', '2024-01-01 14:59:31'),
(6, 155.00, 'on_hold', 1, 1270256373, 'zayed', 'gizzzzzzzaaaaa', '2024-01-01 15:02:01'),
(7, 310.00, 'on_hold', 1, 1270256373, 'Tanta', 'gizaa', '2024-01-01 18:04:39'),
(8, 620.00, 'on_hold', 1, 1270256373, 'zayed', 'zayedddd', '2024-01-01 21:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 7, '1', 'IR sensor', 'irsensor.jpg', 155.00, 2, 1, '2024-01-01 18:04:39'),
(2, 8, '1', 'IR sensor', 'irsensor.jpg', 155.00, 4, 1, '2024-01-01 21:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_price`) VALUES
(1, 'IR sensor', 'Sensors', 'This Sensor is used in analysing the Movement detection. We provide the best quality sensors at the most affordable price ranges to our clients.', 'irsensor.jpg', 155.00),
(2, 'Sharp IR Sensor', 'Sensors', 'This Sensor is used in analysing the Movement detection. We provide the best quality sensors at the most affordable price ranges to our clients.', 'sharp ir sensor.jpg', 155.00),
(8, 'Arduino Shield ', 'LCD Modules | Key Pads', 'This DFRobot LCD Keypad Shield (male pin connector) for Arduino comprises a 16×2 blue LCD display and 6 momentary pushbuttons, from left to right, SELECT, LEFT, UP, DOWN, RIGHT and RESET. The shield can be directly plugged onto an Arduino UNO board, makin', 'ar_sh_lcd_key_1.jpg', 140.00),
(9, 'LMT LCD Power Supply Cable – TOPWAY', 'LCD Modules | Key Pads', 'Special power cable for TOPWAY LCD series LMT', 'lmt_power_cable.jpg', 75.00),
(10, 'CO2 Sensor Analog Signal', 'sensors', 'Carbon dioxide sensor (CO2 sensor) for monitoring air quality. The carbon dioxide transmitter (CO2 sensor) response is rapid and sensitive with infrared verification technology for CO2 concentration measurement. This carbon dioxide sensor with reliable ND', 'sen_co2_pr3002.jpg', 3500.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Admin', 'admin@electron.com', '25d55ad283aa400af464c76d713c07ad'),
(3, 'Lujain Ezzat', 'lujainezzat@gmail.com', '25d55ad283aa400af464c76d713c07ad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint_user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
