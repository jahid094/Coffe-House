-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2019 at 07:04 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffe_house`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Adminid` int(11) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Adminid`, `adminEmail`, `adminPass`) VALUES
(1, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `sId`, `productId`, `productName`, `price`, `quantity`, `image`) VALUES
(9, 'b6b6pfgkpamnfq61ll6bg83nhb', 6, 'test product', 21000.00, 3, 'uploads/b5826040f5.jpg'),
(10, 'b6b6pfgkpamnfq61ll6bg83nhb', 5, 'Lorem Ipsum is simply', 620.87, 1, 'uploads/6c442542b5.jpg'),
(11, 'hug1fslboqae6h4hi1usiqsdiv', 6, 'test product', 7000.00, 1, 'uploads/b5826040f5.jpg'),
(17, '490pkeke6itv8jm3fsf5h2fefu', 5, 'Lorem Ipsum is simply', 620.87, 1, 'uploads/6c442542b5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `gender` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `firstname`, `lastname`, `address`, `phone`, `email`, `pass`, `gender`) VALUES
(1, 'Customer ', 'two', 'Jatrabari', '01521431231', 'one@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male'),
(2, 'Samsul ', 'Islam', 'Jatrabari road , 420', '01521431231', 'samsulratul98@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male'),
(3, 'a', 'b', 'jatrabari', '01521419537', 'a@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male'),
(4, 'Md Jahidul', 'Islam', 'niketon', '01521419537', 'jahid.aust39@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackId`, `customerId`, `name`, `email`, `phone`, `address`, `subject`, `body`) VALUES
(2, 2, 'Samsul  Islam Chowdhury', 'samsulratul98@gmail.com', '01521431231', 'Jatrabari road , 420', 'design', 'worst design ever'),
(3, 2, 'Samsul  Islam', 'samsulratul98@gmail.com', '01521431231', 'Jatrabari road , 420', 'review', 'I think you have created an interactive website , but you need to concentrate more in responsive design. Thank you !');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productName`, `body`, `price`, `image`) VALUES
(3, 'Mocchachino', ' Mocchachino is an franko coffe.  It\'s mixed up with many flavor', 300.00, 'uploads/88f83ca789.jpg'),
(4, 'Chocolate Coffee.', ' It is an Chocolate flavorful coffe ', 900.00, 'uploads/b1c7ce6808.jpg'),
(5, 'Cappuccino-Cremoso-Con-il-bimby.', ' Cappuccino-Cremoso-Con-il-bimby is turkis coffe.', 620.00, 'uploads/6c442542b5.jpg'),
(6, 'Cappuccino', 'This is an american coffe', 200.00, 'uploads/b5826040f5.jpg'),
(7, 'CafÃ© Latte.', 'CafÃ© Latte is an american Coffe', 420.00, 'uploads/8b7261ba82.jpg'),
(8, 'nespresso-CAPPUCCINO-BANANA Coffe.', 'nespresso-CAPPUCCINO-BANANA Coffe is an different flavored coffee . it is an British coffee .', 520.00, 'uploads/ff0a190a62.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `cmrId`, `productId`, `productName`, `quantity`, `price`, `image`, `date`, `status`) VALUES
(3, 2, 6, 'test product', 2, 14000.00, 'uploads/b5826040f5.jpg', '2019-10-13 07:38:25', 2),
(4, 2, 5, 'Lorem Ipsum is simply', 3, 1860.00, 'uploads/6c442542b5.jpg', '2019-10-13 07:42:38', 2),
(5, 2, 5, 'Lorem Ipsum is simply', 1, 620.00, 'uploads/6c442542b5.jpg', '2019-10-13 08:45:01', 0),
(6, 2, 8, 'nespresso-CAPPUCCINO-BANANA Coffe.', 2, 1040.00, 'uploads/ff0a190a62.jpg', '2019-10-13 09:35:29', 2),
(7, 2, 8, 'nespresso-CAPPUCCINO-BANANA Coffe.', 2, 1040.00, 'uploads/ff0a190a62.jpg', '2019-10-13 09:45:48', 2),
(8, 3, 8, 'nespresso-CAPPUCCINO-BANANA Coffe.', 2, 1040.00, 'uploads/ff0a190a62.jpg', '2019-10-13 10:22:39', 1),
(9, 3, 7, 'CafÃ© Latte.', 1, 420.00, 'uploads/8b7261ba82.jpg', '2019-10-13 10:22:39', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Adminid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
