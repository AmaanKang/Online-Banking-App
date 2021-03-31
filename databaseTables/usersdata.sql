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
-- Table structure for table `usersdata`
--

CREATE TABLE `usersdata` (
  `accountNumber` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `firstContact` varchar(10) NOT NULL,
  `secondContact` varchar(10) NOT NULL,
  `emailAddress` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `chequingBalance` decimal(10,2) NOT NULL,
  `savingsBalance` decimal(10,2) NOT NULL,
  `creditBalance` decimal(10,2) NOT NULL
) ENGINE=InnoDB;

--
-- Dumping data for table `usersdata`
--

INSERT INTO `usersdata` (`accountNumber`, `firstName`, `lastName`, `firstContact`, `secondContact`, `emailAddress`, `address`, `chequingBalance`, `savingsBalance`, `creditBalance`) VALUES
(135791113, 'Amandeep', 'Kaur', '9052345671', '9052314357', 'amankaur200@gmail.com', '224 Moorland Cres, Ancaster, ON L9K1S6', '8900.00', '9800.72', '500.00'),
(238904567, 'Mary', 'Mikeil', '9053040556', '9053040701', 'marymik@student.com', '298 Southcote Rd, Ancaster, ON L9K1S6', '4834.43', '14908.56', '1002.67'),
(266843212, 'Tegvir', 'Singh', '2894892345', '2891456789', 'tegvirkang@gmail.com', '245 Larkspur Cres, Ancaster, ON L9K1S6', '4366.86', '10356.00', '858.00'),
(298453128, 'Jacob', 'Malik', '7056423450', '7052390871', 'Jacob.Malik@gmail.com', '589  Dry Pine Bay Rd, Copper Cliff, ON, P0M 1N0', '3467.89', '6588.20', '1245.67'),
(786123672, 'Mosh', 'Richard', '9053040790', '9053040351', 'mister.richard@outlook.com', '61 Thoroughbred Blvd, Ancaster, ON L9K1S6', '175701.99', '220106.34', '-22050.01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usersdata`
--
ALTER TABLE `usersdata`
  ADD PRIMARY KEY (`accountNumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
