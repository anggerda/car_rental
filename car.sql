-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 17, 2020 at 04:07 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_car`
--

CREATE TABLE `m_car` (
  `car_id` int(11) NOT NULL,
  `car_name` varchar(200) NOT NULL,
  `car_built` int(11) NOT NULL,
  `charge` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_car`
--

INSERT INTO `m_car` (`car_id`, `car_name`, `car_built`, `charge`) VALUES
(1, 'Toyota Agya', 2015, 50000),
(2, 'Honda Brio', 2007, 10000),
(4, 'Mercedes Benz c200', 2019, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `t_car_detail`
--

CREATE TABLE `t_car_detail` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `days` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_car_detail`
--

INSERT INTO `t_car_detail` (`detail_id`, `order_id`, `car_id`, `startdate`, `enddate`, `days`, `amount`) VALUES
(28, 15, 2, '2020-03-17', '2020-03-19', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_car_order`
--

CREATE TABLE `t_car_order` (
  `order_id` int(11) NOT NULL,
  `discount1` varchar(50) NOT NULL,
  `discount2` varchar(50) NOT NULL,
  `discount3` varchar(50) NOT NULL,
  `subtotal` float NOT NULL,
  `total` float NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_car_order`
--

INSERT INTO `t_car_order` (`order_id`, `discount1`, `discount2`, `discount3`, `subtotal`, `total`, `order_date`) VALUES
(15, '1500', '0', '1995', 30000, 26505, '2020-03-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_car`
--
ALTER TABLE `m_car`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `t_car_detail`
--
ALTER TABLE `t_car_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `t_car_order`
--
ALTER TABLE `t_car_order`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_car`
--
ALTER TABLE `m_car`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_car_detail`
--
ALTER TABLE `t_car_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `t_car_order`
--
ALTER TABLE `t_car_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
