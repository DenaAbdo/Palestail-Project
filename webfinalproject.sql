-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 02, 2024 at 11:48 PM
-- Server version: 8.0.36
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web1192172_FinalProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id` int NOT NULL,
  `cartID` int NOT NULL,
  `productsListID` int NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`id`, `cartID`, `productsListID`, `userId`) VALUES
(1, 0, 0, 0),
(2, 0, 0, 0),
(3, 0, 0, 0),
(4, 0, 0, 49),
(5, 0, 0, 50);

-- --------------------------------------------------------

--
-- Table structure for table `creditcard`
--

CREATE TABLE `creditcard` (
  `creditCardNumber` int NOT NULL,
  `creditCardName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bankIssued` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `expirationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creditcard`
--

INSERT INTO `creditcard` (`creditCardNumber`, `creditCardName`, `bankIssued`, `expirationDate`) VALUES
(2024, '2024-02-06', '2024-02-06', '2024-02-06'),
(12569, 'paypal', 'test', '2024-02-27'),
(112212, 'test', 'test', '2024-03-05'),
(159753, 'test', 'test', '2024-03-05'),
(444444, 'test', 'test', '2024-03-05'),
(456789, 'test', 'test', '2024-03-04'),
(789654, 'test', 'test', '2024-03-05'),
(1111112, 'test', 'test', '2024-03-05'),
(1258799, 'test', 'test', '2024-03-05'),
(9999998, 'test', 'test', '2024-03-05'),
(22221111, 'test', 'test', '2024-03-05'),
(23994858, 'test', 'test', '2024-03-06'),
(66659988, 'test', 'test', '2024-03-05'),
(2147483647, 'test', 'test', '2024-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `order-details`
--

CREATE TABLE `order-details` (
  `order-detail-id` int NOT NULL,
  `order-id` int NOT NULL,
  `product-id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderproducts`
--

CREATE TABLE `orderproducts` (
  `id` int NOT NULL,
  `userID` int NOT NULL,
  `productID` int NOT NULL,
  `orderID` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order-id` int NOT NULL,
  `user-id` int NOT NULL,
  `order-date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Shipped','WaitProcessing') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int NOT NULL,
  `productName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `briefDescription` text COLLATE utf8mb4_general_ci NOT NULL,
  `productCategory` enum('normal','on sale','new arrival','featured','high demand') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'normal',
  `productPrice` decimal(10,0) NOT NULL,
  `productSize` int NOT NULL,
  `quantity` int NOT NULL,
  `imageName` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productName`, `briefDescription`, `productCategory`, `productPrice`, `productSize`, `quantity`, `imageName`) VALUES
(21, 'test', 'asdfghjk', 'normal', 77, 9, 5, 'a714acbfd192e8156112e347a66e9361.jpg'),
(22, 'test', 'asdfghjk', 'normal', 77, 9, 5, 'a714acbfd192e8156112e347a66e9361.jpg'),
(23, 'test', 'asdfghjk', '', 5, 4, 444, 'a714acbfd192e8156112e347a66e9361.jpg'),
(24, 'test', 'asdfghjk', '', 5, 4, 444, 'a714acbfd192e8156112e347a66e9361.jpg'),
(25, 'test', 'asdfghjk', '', 5, 4, 444, 'a714acbfd192e8156112e347a66e9361.jpg'),
(26, 'test', 'asdfghjk', '', 5, 4, 444, 'a714acbfd192e8156112e347a66e9361.jpg'),
(27, 'test', 'asdfghjk', '', 5, 4, 444, 'a714acbfd192e8156112e347a66e9361.jpg'),
(28, 'test', 'asdfghjk', '', 5, 4, 444, 'a714acbfd192e8156112e347a66e9361.jpg'),
(29, 'test', 'asdfghjk', 'normal', 445, 12, 12, 'imgimg1.jpg'),
(30, 'test', 'asdfghjk', 'normal', 445, 12, 12, 'img30img1.jpg'),
(31, 'test', 'asdfghjk', 'normal', 445, 12, 12, 'img31img1.jpg'),
(32, 'test', 'asdfghjk', 'normal', 445, 12, 12, 'img32img1.jpg'),
(33, 'test', 'asdfghjk', 'normal', 87, 12, 12, 'img33img1.jpg'),
(34, 'test', 'asdfghjk', 'normal', 87, 12, 12, 'img34img1.jpg'),
(35, 'test', 'asdfghjk', 'normal', 87, 12, 12, 'img35img1.jpg'),
(36, 'test', 'asdfghjk', 'normal', 87, 12, 12, 'img36img1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `productslist`
--

CREATE TABLE `productslist` (
  `id` int NOT NULL,
  `basketID` int NOT NULL,
  `productID` int NOT NULL,
  `productPrice` int NOT NULL,
  `productQuantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productslist`
--

INSERT INTO `productslist` (`id`, `basketID`, `productID`, `productPrice`, `productQuantity`) VALUES
(4, 0, 24, 5, 0),
(5, 0, 24, 5, 0),
(6, 4, 20, 77, 0),
(7, 4, 20, 77, 0),
(8, 4, 20, 77, 0),
(9, 4, 20, 77, 0),
(10, 4, 20, 77, 0),
(11, 4, 20, 77, 0),
(19, 4, 27, 5, 0),
(22, 4, 27, 5, 0),
(23, 4, 27, 5, 0),
(25, 4, 7, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `IDNumber` int NOT NULL,
  `emailAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int NOT NULL,
  `creditCardID` int NOT NULL,
  `userName` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userType` enum('Customer','Employee') COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPassword` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `userAddress`, `birthday`, `IDNumber`, `emailAddress`, `telephone`, `creditCardID`, `userName`, `userType`, `userPassword`) VALUES
(1, 'Employee1', 'Palestine', '2024-01-01', 123123123, 'test@employee.com', 599887766, 555555, 'Employee1', 'Employee', '123654789'),
(49, 'test2', 'palestine', '2024-01-31', 777778, 'test@test.com', 1231231234, 444444, 'newTest', 'Customer', '123456789'),
(50, 'test2', 'palestine', '2024-01-31', 11111222, 'test@test.com', 4444, 456789, 'customer3', 'Customer', '123456788');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`creditCardNumber`);

--
-- Indexes for table `order-details`
--
ALTER TABLE `order-details`
  ADD PRIMARY KEY (`order-detail-id`),
  ADD KEY `order-id` (`order-id`),
  ADD KEY `product-id` (`product-id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order-id`),
  ADD KEY `user-id` (`user-id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `productslist`
--
ALTER TABLE `productslist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order-details`
--
ALTER TABLE `order-details`
  MODIFY `order-detail-id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order-id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `productslist`
--
ALTER TABLE `productslist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order-details`
--
ALTER TABLE `order-details`
  ADD CONSTRAINT `order-details_ibfk_1` FOREIGN KEY (`order-id`) REFERENCES `orders` (`order-id`),
  ADD CONSTRAINT `order-details_ibfk_2` FOREIGN KEY (`product-id`) REFERENCES `product` (`productId`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user-id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
