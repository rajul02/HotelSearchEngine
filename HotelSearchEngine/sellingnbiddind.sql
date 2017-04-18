-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2016 at 12:37 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sellingnbiddind`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidding_table`
--

CREATE TABLE `bidding_table` (
  `bid_ID` int(11) NOT NULL,
  `seller_ID` int(11) NOT NULL,
  `bidder_ID` int(11) NOT NULL,
  `item_ID` int(11) NOT NULL,
  `bid_value` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `price` int(50) DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `permission` tinyint(1) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_ID`, `user_ID`, `category`, `price`, `quantity`, `permission`, `date`) VALUES
(4, 0, 'comp', 12, 2, 0, '2016-10-01'),
(6, 9, 'comp', 12, 2, 0, '2016-10-01'),
(7, 9, 'comp', 12, 2, 0, '2016-10-01'),
(8, 9, 'computer', 20, 2, 0, '2016-10-01'),
(9, 9, 'jdjnekjnk', 45, 565, 0, '2016-10-03'),
(10, 9, 'bbiui', 4, 45, 0, '2016-10-03'),
(11, 9, 'jkjkjkn', 8798, 8899, 0, '2016-10-03'),
(12, 9, 'jjbjbk', 90809, 9890, 0, '2016-10-03'),
(13, 9, 'jdssnjn', 88999, 9090, 0, '2016-10-03'),
(14, 9, 'kjbjkb', 889, 8989, 0, '2016-10-03'),
(15, 9, 'jjdjkshj', 9898, 88, 0, '2016-10-03'),
(16, 9, 'jnkjn', 8980, 8908, 0, '2016-10-03'),
(17, 9, 'jbjkb', 898, 99809, 0, '2016-10-03'),
(18, 9, 'jkkbkjb', 879798, 778, 0, '2016-10-03'),
(19, 9, 'jkbjk', 98, 980, 0, '2016-10-03'),
(20, 9, 'knk', 989, 9809, 0, '2016-10-03'),
(21, 9, 'hjhj', 900, 90, 0, '2016-10-03'),
(22, 9, 'kjnkj', 900808, 988, 0, '2016-10-03'),
(23, 9, 'jbjb', 9, 9090, 0, '2016-10-03'),
(24, 9, 'hhbh', 98787, 987, 0, '2016-10-03'),
(25, 9, 'bjk', 9809, 90809, 0, '2016-10-03'),
(26, 9, 'Computer And Laptops', 150, 3, 0, '2016-10-05'),
(27, 9, 'Birds', 350, 3, 0, '2016-10-05'),
(28, 9, 'Electronics', 10, 100, 0, '2016-10-05'),
(29, 9, 'Robots', 2500, 60, 0, '2016-10-05'),
(30, 9, 'Wallpaper', 100, 1, 0, '2016-10-05'),
(31, 10, 'Electronics', 250, 36, 0, '2016-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `item_detail`
--

CREATE TABLE `item_detail` (
  `item_detail_ID` int(11) NOT NULL,
  `item_ID` int(11) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `item_title` varchar(50) NOT NULL,
  `item_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_detail`
--

INSERT INTO `item_detail` (`item_detail_ID`, `item_ID`, `item_desc`, `item_title`, `item_image`) VALUES
(1, 25, 'bjkbkb', 'jfjbjbjb', 'jfjbjbjb'),
(2, 26, 'Its to connect laptop with usbasp.', 'UsbAsp', 'UsbAsp'),
(3, 27, 'They are cute and adorable', 'Parrot', 'Parrot'),
(4, 28, 'Light Dependent Register', 'LDR', 'LDR'),
(5, 29, 'Robot to follow Line.', 'Line Follower Bot', 'Line Follower Bot'),
(6, 30, 'Nothing Much', 'Blue Circuit Abstract Design', 'Blue Circuit Abstract Design'),
(7, 31, 'Its Sensor to follow lines.', 'Line Sensor', 'Line Sensor');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_ID`, `username`, `password`, `contact`, `email`, `date`) VALUES
(1, 'rajul', 'rajul', '9712356792', 'rajulsnahar@gmail.com', '2016-09-28'),
(6, 'pradyumna', 'Þg-à!XÅËE˜ó—#ÅP«$¡¨Ð‘ëOÄé21D¦Ž', '8449387687', 'prad@gmail.com', '2016-09-28'),
(7, 'u14co001', '{Ì¼·rAdãí8sŠP4b7p†ùŸ7u(,¼A¢', '1231231234', 'asd@h.com', '2016-09-28'),
(8, 'mohit', 'mohit', '8456985698', 'mks@gmail.com', '2016-09-30'),
(9, 'mks123', 'ab93f5e5cb6e1e08174e05bc4c2ed597', '9874563210', 'asdfg@gmail.com', '2016-09-30'),
(10, 'mohit', 'e10adc3949ba59abbe56e057f20f883e', '8214569874', 'mohit@gmail.com', '2016-10-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidding_table`
--
ALTER TABLE `bidding_table`
  ADD PRIMARY KEY (`bid_ID`),
  ADD KEY `seller_ID` (`seller_ID`),
  ADD KEY `item_ID` (`item_ID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_ID`);

--
-- Indexes for table `item_detail`
--
ALTER TABLE `item_detail`
  ADD PRIMARY KEY (`item_detail_ID`),
  ADD KEY `item_ID` (`item_ID`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidding_table`
--
ALTER TABLE `bidding_table`
  MODIFY `bid_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `item_detail`
--
ALTER TABLE `item_detail`
  MODIFY `item_detail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidding_table`
--
ALTER TABLE `bidding_table`
  ADD CONSTRAINT `bidding_table_ibfk_1` FOREIGN KEY (`seller_ID`) REFERENCES `user_details` (`user_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `bidding_table_ibfk_2` FOREIGN KEY (`item_ID`) REFERENCES `item` (`item_ID`) ON DELETE CASCADE;

--
-- Constraints for table `item_detail`
--
ALTER TABLE `item_detail`
  ADD CONSTRAINT `item_detail_ibfk_1` FOREIGN KEY (`item_ID`) REFERENCES `item` (`item_ID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
