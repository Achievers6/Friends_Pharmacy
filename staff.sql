-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2017 at 01:47 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `friends_pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `member_id` int(10) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `nic` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `occupation` varchar(15) NOT NULL,
  `start_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`member_id`, `first_name`, `last_name`, `gender`, `birthday`, `nic`, `address`, `contact_number`, `email`, `password`, `occupation`, `start_date`) VALUES
(2, 'ruwan', 'de silva', 'male', '2016-09-07', '123456789V', 'as\'jgdjfk', '9087654323', 'ruwan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'assistant', '2016-09-01'),
(27, 'Saman', 'De Silva', 'male', '2016-01-12', '956510056V', 'ksjie ,mi if, fwoef, ofeo', '0778974927', 'saman@gmail.com', '202cb962ac59075b964b07152d234b70', 'assistant', '2017-01-19'),
(28, 'Sandunika', 'Dissanayake', 'female', '2016-09-08', '454545454V', '"Jayani", Ella Road\r\nKurundugahahethepma', '0775656562', 'sandunikahansinie@gmail.com', '202cb962ac59075b964b07152d234b70', 'assistant', '2017-01-26'),
(31, 'Tharindu', 'Perera', 'male', '2017-01-15', '898956562V', 'No: 23\r\nMain Street', '0778565652', 'tharindu@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'pharmacist', '2017-01-02'),
(30, 'Nipuni', 'Silva', 'female', '2017-01-15', '986598653V', 'No: 23\r\nMain Street', '0112565623', 'nipuni@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'cashier', '2017-01-10'),
(35, 'Kithma', 'Perera', 'female', '2017-01-15', '969696565V', 'dfbv', '0178522582', 'kitty@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'cashier', '2017-01-02'),
(34, 'Darshi', 'Dias', 'male', '2017-01-15', '903232326V', 'No: 23\r\nMain Street', '0125232562', 'darshi@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'cashier', '2017-01-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `member_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
