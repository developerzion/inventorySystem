-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2020 at 10:48 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin_post` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `fullname`, `username`, `password`, `admin_post`) VALUES
(1, 'John Doe', 'admin', 'd9dd90e5530487e895c89ba222946268074937c7', 'head_admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(11) NOT NULL,
  `categories` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `categories`) VALUES
(1, 'Bags'),
(2, 'Shoes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `prod_Name` longtext NOT NULL,
  `prod_Cat` varchar(200) NOT NULL,
  `priZe` int(100) NOT NULL,
  `Qty` int(100) NOT NULL,
  `shelVe` longtext NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `prod_Name`, `prod_Cat`, `priZe`, `Qty`, `shelVe`, `datetime`) VALUES
(1, 'Backpack', 'Bags', 7000, 6, '2', '2020-10-29 23:53:40'),
(2, 'Crossbag', 'Bags', 4500, 6, '3', '2020-10-29 23:52:39'),
(3, 'Heels', 'Shoes', 12000, 5, '8', '2020-10-29 23:55:08'),
(4, 'Gladiator sandal', 'Shoes', 11000, 6, '6', '2020-10-29 23:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `id` int(11) NOT NULL,
  `prod_Name` varchar(20) NOT NULL,
  `priZe` int(20) NOT NULL,
  `Qty` int(20) NOT NULL,
  `total` int(20) NOT NULL,
  `receiptNo` int(20) NOT NULL,
  `cashier` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`id`, `prod_Name`, `priZe`, `Qty`, `total`, `receiptNo`, `cashier`, `datetime`) VALUES
(1, 'Backpack', 7000, 4, 28000, 254299074, 'John Doe', '2020-10-29 23:53:40'),
(2, 'Gladiator sandal', 11000, 3, 33000, 254299074, 'John Doe', '2020-10-29 23:53:40'),
(3, 'Heels', 12000, 10, 120000, 1523006909, 'Mike Williams', '2020-10-29 23:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site_details`
--

CREATE TABLE `tbl_site_details` (
  `id` int(11) NOT NULL,
  `sitename` varchar(200) NOT NULL,
  `site_address` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_site_details`
--

INSERT INTO `tbl_site_details` (`id`, `sitename`, `site_address`) VALUES
(1, 'Devparse', 'Devparse Store<br> 12345 Main St. CA, Nigeria <br> XXXXXXXXX');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `id` int(11) NOT NULL,
  `rand` varchar(20) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `pos` varchar(200) NOT NULL,
  `lastlogged` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`id`, `rand`, `fullname`, `username`, `password`, `pos`, `lastlogged`) VALUES
(1, '419284311', 'Mike Williams', 'mikky', 'd9dd90e5530487e895c89ba222946268074937c7', 'Cashier', '2020-10-29 23:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_totalproduct`
--

CREATE TABLE `tbl_totalproduct` (
  `id` int(11) NOT NULL,
  `productname` varchar(200) NOT NULL,
  `productcat` varchar(200) NOT NULL,
  `prize` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `shelve` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_totalproduct`
--

INSERT INTO `tbl_totalproduct` (`id`, `productname`, `productcat`, `prize`, `qty`, `shelve`, `datetime`) VALUES
(1, 'Backpack', 'Bags', '7000', '10', '2', '2020-10-29 23:52:20'),
(2, 'Crossbag', 'Bags', '4500', '6', '3', '2020-10-29 23:52:39'),
(3, 'Heels', 'Shoes', '12000', '15', '8', '2020-10-29 23:52:57'),
(4, 'Gladiator sandal', 'Shoes', '11000', '9', '6', '2020-10-29 23:53:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_site_details`
--
ALTER TABLE `tbl_site_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_totalproduct`
--
ALTER TABLE `tbl_totalproduct`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_site_details`
--
ALTER TABLE `tbl_site_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_totalproduct`
--
ALTER TABLE `tbl_totalproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
