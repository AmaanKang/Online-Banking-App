-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 05:16 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
;

--
-- Database: `bankingApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankusers`
--

CREATE TABLE `bankusers` (
  `userID` varchar(20) NOT NULL,
  `userPassword` varchar(200) NOT NULL,
  `accountNumber` int(11) NOT NULL
) ENGINE=InnoDB;

--
-- Dumping data for table `bankusers`
--

INSERT INTO `bankusers` (`userID`, `userPassword`, `accountNumber`) VALUES
('RichMarkson', '$2y$10$rkW7IUg0LEm8G2ykC/v1AOXaYtTZAMmdScC6lxHs.uh7z8pnzz0lK', 786123672);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bankusers`
--
ALTER TABLE `bankusers`
  ADD PRIMARY KEY (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
