-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2017 at 06:29 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `profit` ()  NO SQL
SELECT 0.10*SUM(payment.py_cost) as profit from payment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sales` ()  NO SQL
SELECT SUM(payment.py_cost) as sales from payment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `totalsal` ()  NO SQL
select sum(a_salary) as sal from agent$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `a_id` int(11) NOT NULL,
  `a_name` varchar(20) NOT NULL,
  `a_salary` int(11) NOT NULL,
  `a_phone` bigint(10) NOT NULL,
  `b_id` int(11) NOT NULL,
  `a_address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`a_id`, `a_name`, `a_salary`, `a_phone`, `b_id`, `a_address`) VALUES
(3, 'manjunath', 20000, 9965232322, 20, 'yelahanka'),
(4, 'gowda', 35000, 8453815649, 21, 'malleshwaram'),
(5, 'shreyas', 30000, 9035626589, 25, 'hebbal'),
(6, 'akshay', 28000, 9036532564, 23, 'jayanagar'),
(7, 'john', 32500, 8747789993, 24, 'jpnagar'),
(8, 'vinod', 32500, 8747789993, 24, 'jpnagar');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(20) NOT NULL,
  `b_phone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`b_id`, `b_name`, `b_phone`) VALUES
(20, 'yelahanka', 9591212690),
(21, 'malleshwaram', 9966523322),
(23, 'jayanagar', 9125364785),
(24, 'jpnagar', 7795706399),
(25, 'hebbal', 7795705566);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(20) NOT NULL,
  `c_address` varchar(20) NOT NULL,
  `c_phone` bigint(10) NOT NULL,
  `c_type` varchar(20) NOT NULL,
  `status` varchar(11) DEFAULT NULL,
  `a_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `c_address`, `c_phone`, `c_type`, `status`, `a_id`) VALUES
(2, 'shreyas', 'sadashivnagar', 9481901082, 'buyer', NULL, 4),
(3, 'rahul', 'yelahanka', 9590854666, 'buyer', NULL, 3),
(4, 'akshay', 'yelahanka', 8556452123, 'seller', NULL, 3),
(5, 'rakesh', 'sahakar nagar', 9884512626, 'buyer', NULL, 7),
(6, 'smith', 'jp nagar', 9019717998, 'seller', NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `py_id` int(11) NOT NULL,
  `py_cost` int(10) NOT NULL,
  `p_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `p_mode` varchar(6) NOT NULL,
  `c_no` bigint(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`py_id`, `py_cost`, `p_id`, `c_id`, `a_id`, `p_mode`, `c_no`) VALUES
(1, 2750000, 2, 2, 6, '', 0),
(2, 3850000, 3, 5, 5, '', 0),
(3, 4400000, 4, 3, 3, '', 0),
(4, 135, 21, 16, 5, 'debit', 1234567896541235),
(5, 0, 0, 0, 0, 'debit', 1234432112344321);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `p_id` int(11) NOT NULL,
  `p_length` int(10) NOT NULL,
  `p_width` int(10) NOT NULL,
  `p_cost` int(10) NOT NULL,
  `p_type` varchar(20) NOT NULL,
  `p_location` varchar(20) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`p_id`, `p_length`, `p_width`, `p_cost`, `p_type`, `p_location`, `c_id`) VALUES
(1, 20, 30, 100000, 'vacant', 'jpnagar', 2),
(2, 40, 60, 100000, 'residential', 'yelahanka', 3),
(3, 35, 45, 100000, 'commercial', 'jayanagar', 4),
(4, 30, 40, 100000, 'vacant', 'yelahanka', 5),
(5, 40, 50, 100000, 'commercial', 'jpnagar', 6);

--
-- Triggers `property`
--
DELIMITER $$
CREATE TRIGGER `max` BEFORE INSERT ON `property` FOR EACH ROW BEGIN
if(new.p_cost>100000000) THEN
SIGNAL SQLSTATE'02000' SET MESSAGE_TEXT='To Sell Property Greater Than 1 Crore Please  Visit Our Main Office For Physical Verifivation Of Documents';
END if;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `b_id` (`b_id`),
  ADD KEY `a_branch` (`a_address`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `c_phone` (`c_phone`),
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`py_id`),
  ADD UNIQUE KEY `p_id_2` (`p_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `a_id` (`a_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`p_id`) USING BTREE,
  ADD KEY `c_id` (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `py_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `b_id` FOREIGN KEY (`b_id`) REFERENCES `branch` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `c_id` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
