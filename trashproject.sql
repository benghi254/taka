-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2020 at 02:41 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trashproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `_idAdmin` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `idPart` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`_idAdmin`, `firstname`, `lastname`, `username`, `password`, `role`, `idPart`, `date_created`) VALUES
(24, 'prior', 'super', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 0, '2020-12-20 13:30:56');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `AddressId` int(11) NOT NULL,
  `County` varchar(100) DEFAULT NULL,
  `Constituency` varchar(100) DEFAULT NULL,
  `Ward` varchar(100) DEFAULT NULL,
  `Details` text DEFAULT NULL,
  `Holder` varchar(255) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `address_geo_coordinates`
--

CREATE TABLE `address_geo_coordinates` (
  `geoId` int(11) NOT NULL,
  `addressId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `fullAddress` text DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `county` varchar(100) DEFAULT NULL,
  `constituency` varchar(100) DEFAULT NULL,
  `ward` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `geocoded_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `PhoneNumber` varchar(45) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `userId` int(11) NOT NULL,
  `TransactionDate` date DEFAULT NULL,
  `ResultCode` int(11) DEFAULT NULL,
  `ResultDesc` varchar(255) DEFAULT NULL,
  `MpesaCode` varchar(45) DEFAULT NULL,
  `MerchantRequestID` varchar(255) DEFAULT NULL,
  `CheckoutRequestID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Mobile` varchar(45) DEFAULT NULL,
  `Password` text DEFAULT NULL,
  `Verified` varchar(45) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `_idCom` int(11) NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `idTrash` varchar(45) DEFAULT NULL,
  `comment` varchar(45) DEFAULT NULL,
  `dateComment` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `historic`
--

CREATE TABLE `historic` (
  `_idHisto` int(11) NOT NULL,
  `idTrash` varchar(45) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `weight` varchar(45) DEFAULT NULL,
  `dateFull` datetime DEFAULT NULL,
  `idUser` varchar(45) DEFAULT NULL,
  `dateEmpty` varchar(45) DEFAULT NULL,
  `dateHisto` datetime DEFAULT current_timestamp(),
  `lastUpdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `_idPart` int(11) NOT NULL,
  `namePart` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

CREATE TABLE `trash` (
  `_idTrash` int(11) NOT NULL,
  `longi` varchar(45) DEFAULT NULL,
  `lat` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `area` varchar(50) NOT NULL,
  `idTrash` varchar(45) DEFAULT NULL,
  `dateTrash` datetime DEFAULT current_timestamp(),
  `typeTrash` varchar(255) DEFAULT NULL,
  `Weight` varchar(45) DEFAULT NULL,
  `collectDay` varchar(45) DEFAULT NULL,
  `Ward` varchar(50) DEFAULT NULL,
  `Details` text DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `issueDate` datetime DEFAULT NULL,
  `Done` varchar(10) DEFAULT 'False'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `_idUser` int(11) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `idWorker` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `area` varchar(45) NOT NULL,
  `idPart` varchar(45) DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`AddressId`);

--
-- Indexes for table `address_geo_coordinates`
--
ALTER TABLE `address_geo_coordinates`
  ADD PRIMARY KEY (`geoId`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`_idAdmin`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`_idCom`);

--
-- Indexes for table `historic`
--
ALTER TABLE `historic`
  ADD PRIMARY KEY (`_idHisto`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`_idPart`);

--
-- Indexes for table `trash`
--
ALTER TABLE `trash`
  ADD PRIMARY KEY (`_idTrash`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`_idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `AddressId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `address_geo_coordinates`
--
ALTER TABLE `address_geo_coordinates`
  MODIFY `geoId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `_idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `historic`
--
ALTER TABLE `historic`
  MODIFY `_idHisto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `_idPart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trash`
--
ALTER TABLE `trash`
  MODIFY `_idTrash` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `_idUser` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
