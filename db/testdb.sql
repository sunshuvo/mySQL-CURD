-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 12:22 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `test_subtable`
--

CREATE TABLE `test_subtable` (
  `id` int(3) NOT NULL,
  `menu_id` int(2) NOT NULL,
  `visibility` tinyint(1) NOT NULL,
  `position` int(2) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `submenu_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_subtable`
--

INSERT INTO `test_subtable` (`id`, `menu_id`, `visibility`, `position`, `content`, `submenu_name`) VALUES
(1, 1, 1, 1, 'Mission od US', 'Mission'),
(2, 1, 1, 1, 'Our Vision', 'Vision'),
(3, 2, 1, 1, 'Location', 'Find US'),
(4, 2, 1, 2, 'Email form', 'Mail US'),
(5, 3, 1, 1, 'Hardware List', 'Hardware'),
(6, 3, 1, 2, 'Software List', 'Software'),
(7, 4, 1, 1, 'Our available support', 'Support'),
(8, 4, 1, 2, 'We have various solution', 'Solution'),
(9, 5, 1, 1, 'Check our local partner', 'Local Partners'),
(10, 5, 1, 2, 'Check our foreign partner', 'Foreign Partner');

-- --------------------------------------------------------

--
-- Table structure for table `test_table`
--

CREATE TABLE `test_table` (
  `id` int(4) NOT NULL,
  `menu_name` varchar(25) NOT NULL,
  `position` int(2) DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_table`
--

INSERT INTO `test_table` (`id`, `menu_name`, `position`, `visibility`) VALUES
(1, 'About Us', 1, 1),
(2, 'Contact Us', 5, 1),
(3, 'Product', 2, 1),
(4, 'Services', 3, 1),
(5, 'Partners', 4, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `test_subtable`
--
ALTER TABLE `test_subtable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `test_table`
--
ALTER TABLE `test_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `test_subtable`
--
ALTER TABLE `test_subtable`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `test_table`
--
ALTER TABLE `test_table`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
