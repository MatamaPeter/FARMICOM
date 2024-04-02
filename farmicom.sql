-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 08:05 PM
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
-- Database: `farmicom`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL DEFAULT 1,
  `subtotal` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `username`, `name`, `price`, `quantity`, `subtotal`, `image`) VALUES
(21, 'rrr@gmail.com', 'ghj', 200, 1, 200, '0'),
(22, 'k@K.com', 'ghj', 200, 5, 200, '0'),
(24, 'k@K.com', 'tomatoes', 150, 1, 150, '0'),
(27, 'peter24matama@gmail.com', 'ghj', 200, 1, 200, '0'),
(30, 'admin@farmicom.com', 'Cabbage', 20, 1, 20, 'uploads/product-pics/shop_product_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(250) NOT NULL,
  `Category` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `Category`) VALUES
(1, 'Vegetables'),
(2, 'Fruits'),
(3, 'Dairy Products');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` int(25) NOT NULL,
  `Photo` varchar(250) NOT NULL,
  `Member_number` varchar(25) NOT NULL,
  `National_id` int(10) NOT NULL,
  `Firstname` varchar(25) NOT NULL,
  `Lastname` varchar(25) NOT NULL,
  `Phone` int(25) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Usertype` varchar(25) NOT NULL DEFAULT 'farmer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `Photo`, `Member_number`, `National_id`, `Firstname`, `Lastname`, `Phone`, `Email`, `Address`, `Password`, `Usertype`) VALUES
(18, 'uploads/farmers-pics/testimonial-1-img-3.png', 'MEM-1711894421', 123456, 'PETER', 'MATAMA', 793517987, 'peter24matama@gmail.com', '100 Nairobi', '$2y$10$xy5BDzcYjgyDuCsIgmzi6ODZH/3QskZQOc3P7SlZISpY2wt7y3AoO', 'Farmer');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(250) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Phone` int(10) NOT NULL,
  `Subject` varchar(25) NOT NULL,
  `Message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `Name`, `Email`, `Phone`, `Subject`, `Message`) VALUES
(7, 'PETER', 'peter24matama@gmail.com', 793517987, 'Orders', 'Connect with us effortlessly, getting in touch with us is simple and quick. Reach out through our contact form, email, or social media â€“ we value your input and look forward to hearing from you');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(250) NOT NULL,
  `Order_id` varchar(250) NOT NULL,
  `User_email` varchar(250) NOT NULL,
  `country` text NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL,
  `building` varchar(100) NOT NULL,
  `town` varchar(50) NOT NULL,
  `orderDate` date NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `payment_method` varchar(25) NOT NULL,
  `payment_status` text NOT NULL,
  `order_status` text NOT NULL,
  `product` varchar(25) NOT NULL,
  `total` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `Order_id`, `User_email`, `country`, `firstname`, `lastname`, `address`, `building`, `town`, `orderDate`, `payment_id`, `payment_method`, `payment_status`, `order_status`, `product`, `total`) VALUES
(41, '', 'admin@farmicom.com', 'Kenya', 'PETER', 'MATAMA', '100 Nairobi', 'ssssss', 'sdddsd', '2024-03-31', 'PAYPAL-6609280f80b26', 'PayPal', 'complete', 'processing', 'Cabbage', 20),
(42, '', 'admin@farmicom.com', 'Kenya', 'PETER', 'MATAMA', '100 Nairobi', 'ssssss', 'sdddsd', '2024-03-31', 'PAYPAL-660928afd7d4a', 'PayPal', 'complete', 'processing', 'Cabbage', 20),
(43, '', 'admin@farmicom.com', 'Kenya', 'PETER', 'MATAMA', '100 Nairobi', 'ssssss', 'sdddsd', '2024-03-31', 'PAYPAL-66092978af589', 'PayPal', 'complete', 'processing', 'Cabbage', 20),
(44, '', 'Customer001@farmicom.com', 'Kenya', 'PETER', 'MATAMA', '100 Nairobi', 'mnm', 'sdddsd', '2024-03-31', 'MPESA-66099a64ccbae', 'Mpesa', 'Pending', 'processing', 'Cabbage', 20);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(25) NOT NULL,
  `Product_name` varchar(25) NOT NULL,
  `Product_category` varchar(25) NOT NULL,
  `Price` int(25) NOT NULL,
  `Product_img` varchar(250) NOT NULL,
  `Buying_price` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `Product_name`, `Product_category`, `Price`, `Product_img`, `Buying_price`) VALUES
(2, 'Cabbage', 'Vegetables', 20, 'uploads/product-pics/shop_product_2.jpg', 15),
(4, 'Oranges', 'Fruits', 20, 'uploads/product-pics/cart_product_img-2.jpg', 15);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(250) NOT NULL,
  `Email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `Email`) VALUES
(1, 'peter24matama@gmail.com'),
(2, 'ADMIN@FARMICOM.COM');

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `Invoice_no` varchar(250) NOT NULL,
  `Farmer_no` varchar(250) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Product` varchar(250) NOT NULL,
  `Quantity` int(250) NOT NULL,
  `Price` int(250) NOT NULL,
  `Total` int(250) NOT NULL,
  `Bill_status` varchar(250) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`Invoice_no`, `Farmer_no`, `Name`, `Product`, `Quantity`, `Price`, `Total`, `Bill_status`, `Date`) VALUES
('INV-1711907821', 'MEM-1711894421', 'PETER MATAMA', 'Oranges', 555, 20, 11100, 'cleared', '2024-03-31'),
('INV-1711907862', 'MEM-1711894421', 'PETER MATAMA', 'Cabbage', 100, 20, 2000, 'cleared', '2024-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Userid` int(25) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Phone` int(10) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Usertype` varchar(25) NOT NULL DEFAULT 'User',
  `token` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Userid`, `Username`, `Email`, `Phone`, `Password`, `Usertype`, `token`) VALUES
(12, 'Customer001', 'Customer001@farmicom.com', 712345678, '$2y$10$SVkTqD1iPfCXTJLO3tG3Iufdk/9lcN2YPaF.Df9T44wmze3X3UHbS', 'User', ''),
(13, 'Admin001', 'admin@farmicom.com', 712345678, '$2y$10$HOKVES1KyTJnTsKCeT9Yf.lqEegD4rk5xlWRkEPRwgs0M45ZU1Lju', 'Admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`Invoice_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Userid` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
