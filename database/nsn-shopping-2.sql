-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2021 at 10:18 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nsn-shopping-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `product` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `product`) VALUES
(35, 'Kids', 1),
(34, 'Women', 14),
(33, 'Men', 21),
(44, 'Fruits', 2);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `rate` int(255) NOT NULL,
  `comment` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `customer_id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`customer_id`, `firstname`, `lastname`, `username`, `email`, `password`) VALUES
(1, 'Samin', 'Yasar', 'saminyasar', 'yasarsamin57@gmail.com', 'c2FtaW55YXNhcg=='),
(2, 'Nabil', 'Mahmud', 'nabilmahmud', 'mahmudnabil710@gmail.com', 'bmFiaWxtYWhtdWQ=');

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `id` int(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `subtotal` int(255) NOT NULL,
  `vat` int(255) NOT NULL,
  `grand_total` int(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`id`, `product_id`, `name`, `price`, `quantity`, `author`, `firstname`, `lastname`, `country`, `street_address`, `city`, `postcode`, `phone`, `email`, `payment_method`, `subtotal`, `vat`, `grand_total`, `date`) VALUES
(1, '39', 'Men Grey Jogger', '$120', '1', 'saminyasar', 'Samin', 'Yasar', 'Bangladesh', 'Demra,Dhaka', 'Dhaka', '1362', '01818082605', 'yasarsamin57@gmail.com', 'cash', 120, 10, 130, '07 Jan 2021'),
(2, '77,40', 'Medium Orange,Men Blue Polo Shirt', '$95,$65', '1,1', 'saminyasar', 'Samin', 'Yasar', 'Bangladesh', 'Demra,Dhaka', 'Dhaka', '1362', '01818082605', 'yasarsamin57@gmail.com', 'cash', 160, 20, 180, '09 Jan 2021,09 Jan 2021');

-- --------------------------------------------------------

--
-- Table structure for table `pending_comment`
--

CREATE TABLE `pending_comment` (
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `rate` int(255) NOT NULL,
  `comment` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`id`, `name`, `price`, `description`, `category`, `date`, `author`, `img`) VALUES
(34, 'Orange Sneaker', '90', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Orange Sneaker.jpg'),
(35, 'Adidas White Sneaker', '85', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Adidas White Sneaker.jpg'),
(36, 'Ladies White Hoody', '165', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies White Hoody.jpg'),
(37, 'Red Printed T-Shirt', '55', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Red Printed T-Shirt.jpg'),
(38, 'Black Sneaker', '95', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Black Sneaker.jpg'),
(39, 'Men Grey Jogger', '120', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Grey Jogger.jpg'),
(40, 'Men Blue Polo Shirt', '65', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Blue Polo Shirt.jpg'),
(41, 'Men White Shoe', '200', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men White Shoe.jpg'),
(42, 'Men Black Puma T-Shirt', '45', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Black Puma T-Shirt.jpg'),
(43, '3 X Soccer', '90', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', '3 X Soccer.jpg'),
(44, 'Fossil Black Watch', '345', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Fossil Black Watch.jpg'),
(45, 'Men Black Watch', '230', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Black Watch.jpg'),
(46, 'Men Black Shoe', '165', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Black Shoe.jpg'),
(47, 'Men Grey Sneaker', '120', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Grey Sneaker.jpg'),
(48, 'Men Black Jogger', '85', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Black Jogger.jpg'),
(49, 'Ladies Aqua T-Shirt', '125', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies Aqua T-Shirt.jpg'),
(50, 'Half Shirt', '45', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Half Shirt.jpg'),
(52, 'Ladies Scart', '130', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies Scart.jpg'),
(53, 'Ladies Full Sleeve Shirt ', '135', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies Full Sleeve Shirt .jpg'),
(54, 'Ladies Pink Bag', '445', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies Pink Bag.jpg'),
(55, 'Ladies Jacket', '500', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies Jacket.jpg'),
(58, 'Men Leather Jacket', '580', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Leather Jacket.jpg'),
(59, 'Ladies Maroon Sneaker', '445', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies Maroon Sneaker.jpg'),
(60, 'Ladies Olive Color Bag', '345', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies Olive Color Bag.jpg'),
(61, 'Ladies Orange Sweater', '440', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies Orange Sweater.jpg'),
(63, 'Men Jeans Pant', '345', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Jeans Pant.jpg'),
(64, 'Men Belt', '340', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Belt.jpg'),
(65, 'Ladies Pink Sandal', '230', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies Pink Sandal.jpg'),
(66, 'Ladies Pink T-Shirt', '130', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies Pink T-Shirt.jpg'),
(67, 'Ladies Olive Hand Bag', '560', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies Olive Hand Bag.jpg'),
(68, 'Smart Watch', '560', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '35', '07 Jan 2021', 'Admin', 'Smart Watch.png'),
(69, 'Men Black Sun Glass', '130', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Black Sun Glass.jpg'),
(70, 'Men Grey Jacket', '450', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Grey Jacket.jpg'),
(71, 'Ladies Pant', '240', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '34', '07 Jan 2021', 'Admin', 'Ladies Pant.jpg'),
(72, 'Men Money Bag', '430', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'Men Money Bag.jpg'),
(73, 'White Shoe', '450', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet, eius. Ab blanditiis maxime incidunt commodi. Magni praesentium, autem in blanditiis, a maiores omnis delectus, est libero expedita rem nam. Nulla.', '33', '07 Jan 2021', 'Admin', 'White Shoe.jpg'),
(76, 'Fresh Orange', '80', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita at quia rem libero fugit quas quasi quis nesciunt facere repudiandae, reprehenderit, praesentium deleniti deserunt ex est, perspiciatis cumque nihil explicabo.', '44', '09 Jan 2021', 'Admin', 'Fresh Orange.jpg'),
(77, 'Medium Orange', '95', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita at quia rem libero fugit quas quasi quis nesciunt facere repudiandae, reprehenderit, praesentium deleniti deserunt ex est, perspiciatis cumque nihil explicabo.', '44', '09 Jan 2021', 'Admin', 'Medium Orange.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `role`) VALUES
(40, 'Nabil', 'Mahmud', 'nabilmahmud', 'mahmudnabil710@gmail.com', 'MTIzNDU=', 0),
(32, 'Samin', 'Yasar', 'saminyasar', 'yasarsamin57@gmail.com', 'MTIzNDU=', 1),
(42, 'Nizam', 'Uddin', 'nizamuddin', 'uddin_nizam71@gmail.com', 'MTIzNDU=', 0);

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
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_comment`
--
ALTER TABLE `pending_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `customer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pending_comment`
--
ALTER TABLE `pending_comment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
