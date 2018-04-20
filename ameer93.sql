-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2018 at 11:59 AM
-- Server version: 10.1.26-MariaDB-1
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ameer93`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'Food'),
(2, 'Drink');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `balance` double NOT NULL DEFAULT '100'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `full_name`, `username`, `email`, `password`, `address`, `phone`, `balance`) VALUES
(1, 'Ameer Abdulaziz', 'ameer93', 'ameer@ameer.com', 'a97734667044e4294a1a1e43ca88f3bf', 'Cairo, Egypt', '01113264340', 0.25),
(4, 'Mostafa Zayan', 'zoz', 'zoz@gmail.com', 'a97734667044e4294a1a1e43ca88f3bf', 'el waha', '', 0),
(5, 'Akram Ahmed', 'akram90', 'akram@akram.com', 'f259d72df1274adc14b18dac10e9e80c', 'nasr city', '0123456789', 60),
(6, 'Akram Ahmed', 'akram90', 'akram@akram.com', 'f259d72df1274adc14b18dac10e9e80c', 'nasr city', '0123456789', 100),
(7, 'Akram Ahmed', 'akram90', 'akram@akram.com', 'f259d72df1274adc14b18dac10e9e80c', 'nasr city', '0123456789', 100),
(8, 'Amal Maher', 'amal64', 'amal@amal64', '05312d20de851f261115d3eb26b660bf', '', '', 55.95),
(16, 'Gregory Rodriguez', 'gregory', 'gregoryrodriguez1974@gmail.com', 'f3e251db903592cb46dfcf464eab9958', 'venezuela', '584120000000', 75.65),
(15, 'Hesham Atif', 'hhh', 'hhh@hhh.com', 'a97734667044e4294a1a1e43ca88f3bf', '', '', 3.7),
(17, 'Gregory Rodriguez', 'gregory', 'gregoryrodriguez1974@gmail.com', 'f3e251db903592cb46dfcf464eab9958', 'venezuela', '584120000000', 89.65),
(18, 'Daniel', 'daniel', 'daniel@gmail.com', '9c6426dcac159892023cfb75b4ec0d6c', 'venezuela', '584260000000', 96.4),
(19, 'Saul Montero', 'SAUL', 'saulalfonzo98@hotmail.com', '03f3a5d503854e0efd776ed4e6ac7a03', 'venezuela', '584120000000', 75.9),
(20, 'Hannah', 'Hannah', 'hannahm@hotmail.com', '3e618abb7666687a16afd34477a22871', 'venezuela', '584160000000', 81.9),
(21, 'Laura', 'laura', 'laura@hotmail.com', 'bdce0bccc0db5ec2292463ac02256fa0', 'venezuela', '582430000000', 82.95),
(22, 'Tendo', 'tendo2', 'tendo@gmail.com', 'b1e0cbd97c67c56c8baf9b95efbdf886', 'adsdfs', 'dasdsa', 92.65),
(23, 'Tendo', 'pius', 'pius@gmail.com', 'b1e0cbd97c67c56c8baf9b95efbdf886', 'rwrwrwe', 'rwrwrwe', 97.7),
(24, 'Ahmed Helmy', 'helmy', 'helmy@helmy.com', '513ee35113c3aa2db35f19d86e474164', 'Egypt', '', 68),
(25, 'Tania Jimenez', 'Tania', 'taniajimenez@gmail.com', '4713d632211f30b0455963b6ecd21c4d', 'venezuela', '+584149443695', 79.35),
(26, 'Froilan', 'froilan', 'froilanl@hotmail.com', '26602c9a28d6e859990070d8a75f0386', 'venezuela', '584140000000', 85.35),
(27, 'Abc', 'abc', 'abc@abc.com', '8249fd5d1fbe33e5f32bc6408476e867', 'abc', '123', 92.7);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_title` varchar(255) NOT NULL,
  `prod_description` text NOT NULL,
  `prod_image` varchar(255) NOT NULL,
  `prod_price` double NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_title`, `prod_description`, `prod_image`, `prod_price`, `cat_id`) VALUES
(1, 'Apple', 'This is a delicious apple.', 'apple.jpg', 0.3, 1),
(2, 'Beer', 'This is a delicious apple.', 'beer.jpg', 2, 2),
(3, 'Water', 'This is a delicious water.', 'water.jpg', 1, 2),
(4, 'Cheese', 'This is a delicious cheese.', 'cheese.jpg', 3.75, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_ratings`
--

CREATE TABLE `products_ratings` (
  `rate_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_ratings`
--

INSERT INTO `products_ratings` (`rate_id`, `rating`, `prod_id`, `cust_id`) VALUES
(78, 2, 2, 24),
(77, 5, 3, 24),
(76, 1, 2, 23),
(75, 5, 1, 23),
(74, 5, 4, 22),
(88, 1, 1, 27),
(87, 5, 2, 27),
(86, 5, 2, 26),
(85, 1, 1, 26),
(84, 5, 4, 26),
(83, 5, 3, 26),
(82, 1, 4, 25),
(81, 1, 3, 25),
(80, 5, 2, 25),
(79, 5, 1, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `prod_cat_fk` (`cat_id`);

--
-- Indexes for table `products_ratings`
--
ALTER TABLE `products_ratings`
  ADD PRIMARY KEY (`rate_id`),
  ADD KEY `rate_prod_fk` (`prod_id`),
  ADD KEY `rate_cust_fk` (`cust_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products_ratings`
--
ALTER TABLE `products_ratings`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
