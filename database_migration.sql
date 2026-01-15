-- Migration file for orders and address_geo_coordinates tables
-- Run this SQL script to create the necessary tables

-- --------------------------------------------------------
-- Table structure for table `orders`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `receiptNumber` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `transactionDate` datetime DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`orderId`),
  KEY `idx_userId` (`userId`),
  KEY `idx_receiptNumber` (`receiptNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Table structure for table `address_geo_coordinates`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `address_geo_coordinates` (
  `geoId` int(11) NOT NULL AUTO_INCREMENT,
  `addressId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `fullAddress` text DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `county` varchar(100) DEFAULT NULL,
  `constituency` varchar(100) DEFAULT NULL,
  `ward` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `geocoded_at` datetime DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`geoId`),
  KEY `idx_addressId` (`addressId`),
  KEY `idx_userId` (`userId`),
  KEY `idx_coordinates` (`latitude`, `longitude`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

