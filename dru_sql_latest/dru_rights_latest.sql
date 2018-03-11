-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2018 at 08:37 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sims`
--

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE `rights` (
  `rights_id` int(8) NOT NULL,
  `rights_code` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rights`
--

INSERT INTO `rights` (`rights_id`, `rights_code`) VALUES
(1, 'ALL'),
(2, 'ADD_STUDENT'),
(3, 'EDIT_STUDENT'),
(4, 'DELETE_STUDENT'),
(5, 'VIEW_STUDENT'),
(6, 'ADD_GRADE'),
(7, 'EDIT_GRADE'),
(8, 'DELETE_GRADE'),
(9, 'VIEW_GRADE'),
(10, 'ADD_SUBJECT'),
(11, 'EDIT_SUBJECT'),
(12, 'DELETE_SUBJECT'),
(13, 'VIEW_SUBJECT'),
(14, 'ADD_TEACHER'),
(15, 'EDIT_TEACHER'),
(16, 'DELETE_TEACHER'),
(17, 'VIEW_TEACHER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`rights_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rights`
--
ALTER TABLE `rights`
  MODIFY `rights_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
