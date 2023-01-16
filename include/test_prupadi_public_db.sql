-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2023 at 07:58 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_prupadi_public_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `username`) VALUES
(1, 'glory_alhaja'),
(2, 'nofisat_glory'),
(3, 'esther_emma'),
(4, 'tumininu'),
(5, 'gbens'),
(6, 'quawiy'),
(7, 'mum_aliya'),
(8, 'mum_emma'),
(9, 'ayo_cr7'),
(10, 'mum_daniel');

-- --------------------------------------------------------

--
-- Table structure for table `debt_vault`
--

CREATE TABLE `debt_vault` (
  `debt_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `debt_amount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `debt_vault`
--

INSERT INTO `debt_vault` (`debt_id`, `customer_id`, `debt_amount`) VALUES
(1, 9, '2000'),
(2, 8, '22250');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(10, 'test_user', '0f5dc7555dd7f20a212c1600e1f3d261');

-- --------------------------------------------------------

--
-- Table structure for table `vault`
--

CREATE TABLE `vault` (
  `vault_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `principal_amount` decimal(10,0) NOT NULL,
  `count_no` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vault`
--

INSERT INTO `vault` (`vault_id`, `customer_id`, `principal_amount`, `count_no`) VALUES
(1, 1, '200', '300.50'),
(3, 3, '200', '22.50'),
(4, 4, '200', '11.00'),
(7, 7, '1200', '62.00'),
(8, 7, '1000', '25.00'),
(9, 7, '1000', '33.00'),
(10, 7, '1000', '50.00'),
(12, 2, '200', '31.00'),
(13, 10, '500', '10.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `debt_vault`
--
ALTER TABLE `debt_vault`
  ADD PRIMARY KEY (`debt_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vault`
--
ALTER TABLE `vault`
  ADD PRIMARY KEY (`vault_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `debt_vault`
--
ALTER TABLE `debt_vault`
  MODIFY `debt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vault`
--
ALTER TABLE `vault`
  MODIFY `vault_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `debt_vault`
--
ALTER TABLE `debt_vault`
  ADD CONSTRAINT `debt_vault_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `vault`
--
ALTER TABLE `vault`
  ADD CONSTRAINT `vault_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
