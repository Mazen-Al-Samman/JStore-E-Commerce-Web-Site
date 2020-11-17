-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 أغسطس 2020 الساعة 23:25
-- إصدار الخادم: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jordan_store`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_img` text NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `last_login` varchar(25) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_img`, `admin_email`, `admin_pass`, `last_login`, `user_agent`, `job_title`) VALUES
(21, 'Mazen Alsmman', 'smile.png', 'mazen@gmail.com', '123456 ', '23/08/2020 10:19:37 pm', 'Chrome', 'Programmer'),
(22, 'Abed Ghandour', 'shy.png', 'abed@gmail.com', '123456', '23/07/2020 01:58:59 pm', 'Chrome', 'Web Developer');

-- --------------------------------------------------------

--
-- بنية الجدول `api`
--

CREATE TABLE `api` (
  `id` int(10) NOT NULL,
  `api_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `api`
--

INSERT INTO `api` (`id`, `api_key`) VALUES
(1, '123456abcdefgclvcvlvddd'),
(2, '9999bbbggtyuytereewsx');

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_img` text NOT NULL,
  `category_desc` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_img`, `category_desc`) VALUES
(6, 'Watches', 'watch2.jpg', 'Omax , Curren , Rolex , ...'),
(11, 'Clothes', 'clothes.jpg', 'Online store for watches and accessories . '),
(12, 'Accessories ', 'Airpods.jpg', 'Accessories for men and women ');

-- --------------------------------------------------------

--
-- بنية الجدول `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_pass` varchar(255) NOT NULL,
  `customer_image` text NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `customer_phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_pass`, `customer_image`, `customer_address`, `street_name`, `customer_phone`) VALUES
(30, 'Abed Ghandour', 'abed@gmail.com', '123456 ', 'smile.png', 'Amman', 'Jabal Al Hussain', '0788888888'),
(31, 'Mhd Mazen Al Samman', 'mazen@gmail.com', '123456', 'mazen.jpg', 'Amman', 'Amman', '0786119086');

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `order_state` varchar(255) NOT NULL,
  `order_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `order_state`, `order_key`) VALUES
(17, 30, '19-08-2020', 'APPROVED', '9CrMoCBGYO'),
(18, 30, '19-08-2020', 'APPROVED', 'plDM2Vrfd0'),
(19, 30, '20-08-2020', 'APPROVED', 'pv83x1gRCv'),
(20, 30, '23-08-2020', 'PENDING', 'udlxZtiWFe');

-- --------------------------------------------------------

--
-- بنية الجدول `order_details`
--

CREATE TABLE `order_details` (
  `detail_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `order_item` varchar(255) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `order_details`
--

INSERT INTO `order_details` (`detail_id`, `order_id`, `order_item`, `quantity`) VALUES
(5, 17, '12', 100),
(6, 18, '12', 15),
(7, 19, '12', 3),
(8, 20, '11', 10),
(9, 20, '14', 3);

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,0) NOT NULL,
  `product_sale` int(3) NOT NULL,
  `product_img` text NOT NULL,
  `provider_id` int(10) NOT NULL,
  `product_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_sale`, `product_img`, `provider_id`, `product_desc`) VALUES
(9, 'Omax Watch', '150', 20, 'product1.jpg', 46, 'WaterProof watch with alot of colors .'),
(10, 'STYLO Watch', '50', 0, 'product2.jpg', 48, 'Water proof watch .'),
(11, 'T5 Watch', '1000', 25, 'product4.jpg', 50, 'Water proof watch .'),
(12, 'Black T-Shirt ', '2000', 95, 't-shirt.png', 49, 'Black T-Shirt for men .'),
(13, 'AirPods Pro', '250', 2, 'Airpods2.jpg', 47, 'AirPods with coverage .'),
(14, 'Arabic Printed T-Shirt', '10', 1, 't-shirt3.jpg', 51, 'T-Shirt  With Arabic Sentences .'),
(15, 'Curren Watch', '15', 20, 'pro-8-220x294.jpg', 46, 'WaterProof watch with alot of colors .'),
(16, 'GEMSTAR ', '10', 1, 'pro-1-220x294.jpg', 48, 'WaterProof watch with alot of colors .'),
(17, 'Blue Watch', '25', 5, 'product3.jpg', 46, 'WaterProof watch with alot of colors .'),
(18, 'Yellow Address', '50', 10, 'yellow.jpg', 49, 'Yellow Address for women .'),
(19, 'Summer Clothes', '10', 1, 'clo.jpeg', 51, 'Summer clothes with all sizes .'),
(20, 'Accessories for men .', '25', 2, 'accessories.jpg', 47, 'Accessories with a beautiful colors , Buy now .');

-- --------------------------------------------------------

--
-- بنية الجدول `product_image`
--

CREATE TABLE `product_image` (
  `img_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `image` text NOT NULL,
  `ismain` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `product_image`
--

INSERT INTO `product_image` (`img_id`, `product_id`, `image`, `ismain`) VALUES
(16, 4, 'sad.png', 0),
(17, 4, 'shy.png', 0),
(18, 4, 'smile.png', 0),
(23, 7, 'angry.png', 0),
(24, 7, 'sad.png', 0),
(25, 7, 'shy.png', 0),
(26, 7, 'smile.png', 0),
(39, 9, '1product50x59.jpg', 0),
(40, 9, '2product50x59.jpg', 0),
(41, 9, '4product50x59.jpg', 0),
(42, 9, '5product50x59.jpg', 0),
(43, 9, 'pro-1-220x294.jpg', 0),
(44, 9, 'pro-2-220x294.jpg', 0),
(45, 9, 'pro-4-220x294.jpg', 0),
(46, 9, 'pro-5-220x294.jpg', 0),
(47, 9, 'pro-7-220x294.jpg', 0),
(48, 9, 'pro-8-220x294.jpg', 0),
(49, 9, 'product2.jpg', 0),
(50, 9, 'product3.jpg', 0),
(54, 10, '1product50x59.jpg', 0),
(55, 10, '2product50x59.jpg', 0),
(56, 10, '3product50x59.jpg', 0),
(57, 10, '4product50x59.jpg', 0),
(58, 10, '5product50x59.jpg', 0),
(59, 10, '7product50x59.jpg', 0),
(60, 10, 'pro-1-220x294.jpg', 0),
(61, 10, 'pro-2-220x294.jpg', 0),
(62, 10, 'pro-3-220x294.jpg', 0),
(63, 10, 'pro-4-220x294.jpg', 0),
(64, 10, 'pro-5-220x294.jpg', 0),
(65, 10, 'pro-6-220x294.jpg', 0);

-- --------------------------------------------------------

--
-- بنية الجدول `providers`
--

CREATE TABLE `providers` (
  `provider_id` int(10) NOT NULL,
  `provider_name` varchar(255) NOT NULL,
  `provider_email` varchar(255) NOT NULL,
  `provider_pass` varchar(255) NOT NULL,
  `provider_desc` varchar(255) NOT NULL,
  `provider_img` text NOT NULL,
  `provider_location` text NOT NULL,
  `provider_cat` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `providers`
--

INSERT INTO `providers` (`provider_id`, `provider_name`, `provider_email`, `provider_pass`, `provider_desc`, `provider_img`, `provider_location`, `provider_cat`) VALUES
(46, 'Look A Like', 'look@gmail.com', 'Look123456       ', 'Online Store for watches , Shop Now', 'brand7.png', 'Amman - Jordan', 6),
(47, 'Accessories VIP', 'vip@vip.com', '123456', 'Online store for Accessories .', 'brand2.png', 'Amman - Jordan', 12),
(48, 'Watch House', 'house@gmail.com', '123456   ', 'Online store for watches .', 'brand3.png', 'Mafraq - Jordan', 6),
(49, 'Zara', 'zara@gmail.com', '123456 ', 'Clothes for men and women , Shop now ', 'brand4.png', 'Amman - Jordan', 11),
(50, 'Best Accessories', 'Best@gmail.com', '123456 ', 'Online store for watches , headphones and accessories .. Shop Now .', 'brand8.png', 'Amman - Jordan', 6),
(51, 'Trove Store', 'trove@gmail.com', '123456', 'Online Store for clothes, Mags , and phone covers .', 'brand9.png', 'Amman - Jordan', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_key` (`api_key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_key` (`order_key`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`provider_id`),
  ADD UNIQUE KEY `provider_email` (`provider_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `img_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `provider_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
