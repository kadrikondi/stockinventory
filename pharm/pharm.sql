-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2020 at 04:08 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharm`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `date_added`) VALUES
(1, 'Tablets', '2020-02-10 19:46:56'),
(2, 'Syrup', '2020-02-10 19:46:56'),
(3, 'Surgical', '2020-02-10 19:46:56'),
(4, 'Infusion', '2020-02-10 19:46:56'),
(5, 'Antiseptic', '2020-02-10 19:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `location`) VALUES
(1, 'Salifu', '08106931087', 'Opposete Federal University Lokoja'),
(2, 'Sediq', '08106931087', 'Opposite Federal University, Lokoja'),
(4, 'Kafayat', '08106931087', 'Opposete Federal University Lokoja'),
(5, 'Imran', '08106931087', 'Opposete Federal University Lokoja'),
(6, 'khaleed', '08106931087', 'Opposete Federal University Lokoja'),
(7, 'kondi', '08038863055', 'lagos'),
(8, 'scglobal', '08038863055', 'lagos ');

-- --------------------------------------------------------

--
-- Table structure for table `expiry_table`
--

CREATE TABLE `expiry_table` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expiry_table`
--

INSERT INTO `expiry_table` (`id`, `product_id`, `quantity`, `expiry_date`) VALUES
(10, 11, 20, '2020-10-16');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `served_by_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `customer_id`, `served_by_id`, `product_id`, `quantity`, `date`) VALUES
(1, 1, 2, 3, 4, '2020-02-18 20:04:34'),
(2, 1, 8, 9, 4, '2020-03-01 11:59:49'),
(3, 1, 8, 8, 11, '2020-03-01 11:59:49'),
(4, 1, 8, 5, 3, '2020-03-01 11:59:49'),
(5, 1, 8, 4, 3, '2020-03-01 11:59:49'),
(6, 1, 8, 3, 2, '2020-03-01 11:59:49'),
(7, 5, 8, 7, 4, '2020-03-01 12:01:26'),
(8, 5, 8, 6, 3, '2020-03-01 12:01:26'),
(9, 5, 8, 5, 5, '2020-03-01 12:01:26'),
(10, 5, 8, 4, 4, '2020-03-01 12:01:26'),
(11, 6, 1, 5, 6, '2020-03-01 12:12:03'),
(12, 6, 1, 4, 4, '2020-03-01 12:12:03'),
(13, 6, 1, 7, 6, '2020-03-01 12:12:03'),
(14, 1, 1, 7, 2, '2020-03-01 12:13:06'),
(15, 1, 1, 6, 3, '2020-03-01 12:13:06'),
(16, 1, 1, 5, 3, '2020-03-01 12:13:06'),
(17, 1, 1, 4, 5, '2020-03-01 12:13:06'),
(18, 1, 1, 3, 5, '2020-03-01 12:13:06'),
(19, 4, 1, 6, 4, '2020-03-01 12:17:10'),
(20, 4, 1, 5, 1, '2020-03-01 12:17:10'),
(21, 4, 1, 4, 2, '2020-03-01 12:17:10'),
(22, 4, 1, 3, 2, '2020-03-01 12:17:10'),
(23, 1, 1, 7, 3, '2020-03-01 12:18:44'),
(24, 1, 1, 6, 2, '2020-03-01 12:18:44'),
(25, 1, 1, 5, 3, '2020-03-01 12:18:44'),
(26, 1, 1, 6, 2, '2020-03-01 12:21:30'),
(27, 1, 1, 5, 1, '2020-03-01 12:21:30'),
(28, 1, 1, 4, 3, '2020-03-01 12:21:30'),
(29, 1, 1, 3, 4, '2020-03-01 12:21:30'),
(30, 1, 1, 8, 1, '2020-03-01 12:22:06'),
(31, 1, 1, 9, 3, '2020-03-01 12:22:06'),
(32, 1, 1, 6, 4, '2020-03-01 12:22:06'),
(33, 2, 1, 4, 1, '2020-03-01 12:27:20'),
(34, 2, 1, 3, 3, '2020-03-01 12:27:20'),
(35, 1, 1, 4, 2, '2020-03-01 14:43:03'),
(36, 1, 1, 3, 2, '2020-03-01 14:43:03'),
(37, 1, 1, 4, 2, '2020-03-01 14:44:45'),
(38, 1, 1, 3, 2, '2020-03-01 14:44:45'),
(39, 4, 8, 5, 1, '2020-03-01 23:05:39'),
(40, 4, 8, 4, 1, '2020-03-01 23:05:39'),
(41, 4, 8, 3, 1, '2020-03-01 23:05:40'),
(42, 1, 8, 3, 1, '2020-03-01 23:07:37'),
(43, 1, 8, 7, 1, '2020-03-01 23:07:37'),
(44, 1, 8, 6, 1, '2020-03-01 23:07:38'),
(45, 1, 8, 5, 1, '2020-03-01 23:07:38'),
(46, 7, 8, 9, 1, '2020-03-01 23:11:47'),
(47, 1, 8, 7, 1, '2020-03-03 14:01:24'),
(48, 1, 8, 6, 1, '2020-03-03 14:01:24'),
(49, 1, 8, 5, 1, '2020-03-03 14:01:24'),
(50, 1, 8, 4, 1, '2020-03-03 14:01:24'),
(51, 1, 8, 3, 1, '2020-03-03 14:01:24'),
(52, 1, 8, 5, 1, '2020-03-03 14:10:34'),
(53, 1, 8, 3, 1, '2020-03-03 14:10:34'),
(54, 1, 8, 9, 1, '2020-03-03 14:14:21'),
(55, 1, 8, 9, 1, '2020-03-03 16:42:30'),
(56, 7, 8, 10, 2, '2020-03-04 11:39:55'),
(57, 1, 8, 10, 1, '2020-03-05 08:17:21'),
(58, 1, 8, 9, 1, '2020-05-07 13:12:26'),
(59, 1, 8, 3, 1, '2020-05-07 13:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `staff_id`, `phone`, `address`, `email`, `username`, `password`, `date`) VALUES
(1, 'pharm/Mayokun', '0902348576', 'This is the fucking address', 'phynormynal@gmail.com', 'mayokun', 'password', '2020-02-18 20:40:40'),
(2, 'pharm/Mayokunn', '0902348576', 'Another fucking Address', 'phynormynal@gmail.com', 'mayokunn', 'password', '2020-02-18 20:41:15'),
(5, 'pharm/scglobal', '2348038863055', 'kaba okene road', 'abdulkadri42@gmail.com', 'Scglobal', 'secret', '2020-02-29 12:17:47'),
(6, 'pharm/eshelves', '08038863055', 'plot 3 opposite igbo hall cementary road lokoja', 'abdulkadri42@gmail.com', 'eshelves', 'password', '2020-02-29 12:26:55'),
(7, 'pharm/yidrispl', '+2348038863055', 'kaba okene road', 'abdulkadri42@gmail.com', 'yidrispl', 'secret', '2020-02-29 12:27:45'),
(8, 'Pharm/admin', '09031855132', 'WHat the ... is going on', 'phynormynal@gmail.com', 'admin', 'secret', '2020-03-01 10:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(20) NOT NULL,
  `quantity_in` int(11) NOT NULL,
  `quantity_out` int(11) NOT NULL,
  `quantity_damaged` int(11) NOT NULL,
  `quantity_remaining` int(11) NOT NULL,
  `cost_price` varchar(11) NOT NULL,
  `selling_price` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

<<<<<<< HEAD
INSERT INTO `products` (`id`, `name`, `description`, `category`, `quantity_in`, `quantity_out`, `quantity_damaged`, `quantity_remaining`, `cost_price`, `selling_price`) VALUES
(3, 'Tetracycline', 'Used in curing all forms of HIV/AIDs. Blah, blah, blah', 'Syrup', -290, 8, 4, -298, '400', '500'),
(4, 'bayo', 'This is probably the same thing that I need to do all over again isn\'t it?', 'Tablets', 4, 0, 0, 0, '100', '300'),
(5, 'bayoo', 'all of my friends', 'Surgical', 306, 0, 0, 2, '100', '1000'),
(6, 'Tetraspirin', 'This is the last description', 'Infusion', 3, 0, 0, 1, '300', '500'),
(7, 'Ampicilin', 'This is a short description', 'Tablets', 6, 0, 0, 4, '600', '800'),
(8, 'Pennicilin', 'For rubbing wounds', 'Antiseptic', 7, 0, 0, 7, '1200', '1500'),
(9, 'Pentamine', 'For Homeo Statis', 'Tablets', 14, 0, 0, 10, '1200', '1500'),
(10, 'parmdfffd', 'fgdsdsf', 'Tablets', 17, 0, 0, 14, '600', '800'),
(11, 'Tetrapycyclin', '', 'Syrup', 170, 0, 0, 170, '500', ''),
(12, 'Tetrapycyclin', '', 'Syrup', 150, 0, 0, 150, '500', ''),
(13, 'Tetrapycycline', '', 'Tablets', 3, 0, 0, 3, '400', '500'),
(14, 'Tetrapycycline', '', 'Tablets', 3, 0, 0, 3, '400', '500'),
(15, 'Tetrapycycline', '', 'Tablets', 3, 0, 0, 3, '400', '500'),
(16, 'crutchet', '', 'Infusion', 11, 0, 0, 11, '100', '200'),
(17, 'crutchet', '', 'Infusion', 11, 0, 0, 11, '100', '200');
=======
INSERT INTO `products` (`id`, `name`, `description`, `category`, `quantity_in`, `quantity_out`, `quantity_damaged`, `quantity_remaining`, `cost_price`, `selling_price`, `NAFDAC`, `expiry_date`) VALUES
(3, 'Tetracycline', 'Used in curing all forms of HIV/AIDs. Blah, blah, blah', 'Syrup', 10, 8, 4, 2, '400', '500', 'PAOWIEUR', NULL),
(4, 'bayo', 'This is probably the same thing that I need to do all over again isn\'t it?', 'Tablets', 4, 0, 0, 0, '100', '300', 'oweirty', NULL),
(5, 'bayoo', 'all of my friends', 'Surgical', 6, 0, 0, 2, '100', '1000', '890293JD', NULL),
(6, 'Tetraspirin', 'This is the last description', 'Infusion', 3, 0, 0, 1, '300', '500', 'QWEROIU', NULL),
(7, 'Ampicilin', 'This is a short description', 'Tablets', 6, 0, 0, 4, '600', '800', 'AOSDFIJ8', NULL),
(8, 'Pennicilin', 'For rubbing wounds', 'Antiseptic', 7, 0, 0, 7, '1200', '1500', 'WOEIRJQ', NULL),
(9, 'Pentamine', 'For Homeo Statis', 'Tablets', 14, 0, 0, 10, '1200', '1500', 'PAOSLEK78', NULL),
(10, 'parmdfffd', 'fgdsdsf', 'Tablets', 17, 0, 0, 14, '600', '800', 'AHD765B', NULL);

-- --------------------------------------------------------
--
-- Table structure for table `products_expiry`
--
-- --------------------------------------------------------
>>>>>>> 8b49044e509101e1ca53104a03d91a2ab44f44a3

-- --------------------------------------------------------

--
-- Table structure for table `products_expiry`
--

CREATE TABLE `products_expiry` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `setdate` datetime NOT NULL DEFAULT current_timestamp(),
  `expirydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
<<<<<<< HEAD
=======

--
-- Dumping data for table `products_expiry`
--
>>>>>>> 8b49044e509101e1ca53104a03d91a2ab44f44a3

INSERT INTO `products_expiry` (`id`, `name`, `quantity`, `setdate`, `expirydate`) VALUES
(6, 'Ampicilin', 3, '2020-03-03 00:01:06', '2020-03-03 00:00:00'),
(9, 'panadol', 8, '2020-03-03 14:18:10', '2020-03-08 00:00:00'),
(11, 'panadolyunnre', 11, '2020-03-04 11:41:43', '2020-03-10 00:00:00'),
(13, 'kondicon', 8, '2020-03-04 13:39:45', '2020-04-01 00:00:00'),
(14, 'kondixylinc', 3, '2020-03-04 13:40:28', '2020-04-01 00:00:00'),
(15, 'phynyxin', 23, '2020-03-04 13:41:10', '2020-06-08 00:00:00');

--
-- Table structure for table `products_expiry`
--

CREATE TABLE `products_expiry` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `setdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expirydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_expiry`
--
--
-- Dumping data for table `products_expiry`
--

INSERT INTO `products_expiry` (`id`, `name`, `quantity`, `setdate`, `expirydate`) VALUES
(6, 'Ampicilin', 3, '2020-03-03 00:01:06', '2020-03-03 00:00:00'),
(9, 'panadol', 8, '2020-03-03 14:18:10', '2020-03-08 00:00:00'),
(13, 'kondicon', 8, '2020-03-04 13:39:45', '2020-04-01 00:00:00'),
<<<<<<< HEAD
(14, 'kondixylinc', 3, '2020-03-04 13:40:28', '2020-04-01 00:00:00');
=======
(14, 'kondixylinc', 3, '2020-03-04 13:40:28', '2020-04-01 00:00:00'),
(15, 'phynyxin', 23, '2020-03-04 13:41:10', '2020-06-08 00:00:00');
>>>>>>> 8b49044e509101e1ca53104a03d91a2ab44f44a3

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expiry_table`
--
ALTER TABLE `expiry_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_expiry`
--
ALTER TABLE `products_expiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_expiry`
--
ALTER TABLE `products_expiry`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

<<<<<<< HEAD
--
-- AUTO_INCREMENT for table `expiry_table`
--
ALTER TABLE `expiry_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

=======
>>>>>>> 8b49044e509101e1ca53104a03d91a2ab44f44a3
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
<<<<<<< HEAD
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

=======
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


--
-- AUTO_INCREMENT for table `products_expiry`
--
ALTER TABLE `products_expiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

>>>>>>> 8b49044e509101e1ca53104a03d91a2ab44f44a3
--
-- AUTO_INCREMENT for table `products_expiry`
--
ALTER TABLE `products_expiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
