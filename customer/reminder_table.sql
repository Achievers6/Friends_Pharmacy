-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 18, 2016 at 02:45 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

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
-- Table structure for table `reminder_table`
--

CREATE TABLE `reminder_table` (
  `reminder_id` int(11) NOT NULL,
  `NIC` int(11) NOT NULL,
  `medicine_name` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder_table`
--

INSERT INTO `reminder_table` (`reminder_id`, `NIC`, `medicine_name`, `duration`, `start_date`, `end_date`) VALUES
(1, 1, 234, 7, '2016-09-14', '2016-09-10'),
(2, 1, 234, 7, '2016-09-14', '2016-09-10'),
(3, 0, 0, 0, '0000-00-00', '0000-00-00'),
(4, 0, 0, 0, '0000-00-00', '0000-00-00'),
(5, 0, 0, 0, '0000-00-00', '0000-00-00'),
(6, 937545265, 0, 7, '2016-09-14', '2016-09-15'),
(7, 528555565, 0, 0, '0000-00-00', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reminder_table`
--
ALTER TABLE `reminder_table`
  ADD PRIMARY KEY (`reminder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reminder_table`
--
ALTER TABLE `reminder_table`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
