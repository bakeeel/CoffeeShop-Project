-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2022 at 11:19 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coffee_strength`
--

CREATE TABLE `tbl_coffee_strength` (
  `Id` int(11) NOT NULL,
  `Strength` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_coffee_strength`
--

INSERT INTO `tbl_coffee_strength` (`Id`, `Strength`) VALUES
(1, 'Light Roast'),
(2, 'Dark Roast');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `ID` int(11) NOT NULL,
  `FName` text NOT NULL,
  `LName` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `Salt` text NOT NULL,
  `Role_Id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Description` text NOT NULL,
  `Cost_Price` decimal(15,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Sell_Price` decimal(15,2) NOT NULL,
  `Coffee_Strength_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`ID`, `Name`, `Description`, `Cost_Price`, `Quantity`, `Sell_Price`, `Coffee_Strength_Id`) VALUES
(1, 'Bella Donovan', 'Raspberry, chocolate, molasses', '80.00', 196, '100.00', 1),
(2, 'Giant Steps', 'Cocoa, toasted marshmallow, graham cracker', '80.00', 41, '100.00', 1),
(3, 'Three Africas', 'Golden raisin, winey blueberry, lemon zest', '80.00', 48, '100.00', 1),
(4, 'Beta Blend', 'Candied orange, milk chocolate, white peach', '80.00', 50, '100.00', 1),
(5, 'New Orleans Iced Kit', 'Sweet, chicory-laden perfection in a glass', '80.00', 50, '100.00', 1),
(6, 'Uganda Sipi Falls', 'Toasted marshmallow, butterscotch, peppercorn', '80.00', 50, '100.00', 1),
(7, 'Pichincha Finca Meridiano', 'Raisin, allspice, chocolate syrup', '80.00', 50, '100.00', 1),
(8, 'Honduras Santa Elena', 'Peach, guava, dulce de leche', '80.00', 50, '100.00', 1),
(9, 'Ecuador Pichincha', 'Huckleberry, guava, white tea', '80.00', 50, '100.00', 2),
(10, 'Kiambu Handege', 'Raisin, allspice, chocolate syrup', '80.00', 50, '100.00', 2),
(11, 'Lourdes de Naranjo', 'Huckleberry, guava, white tea', '80.00', 50, '100.00', 2),
(12, 'Opascope Espresso', 'Toasted marshmallow, butterscotch, peppercorn', '80.00', 50, '100.00', 2),
(13, 'Ethiopia Gera Abana Estate', 'Raisin, allspice, chocolate syrup', '80.00', 50, '100.00', 2),
(14, 'Santa Elena', 'Caramel, orange sherbet, cardamom', '80.00', 50, '100.00', 2),
(15, 'Doris Alicia Benitez', 'Salted butterscotch, kumquat, cherry', '80.00', 50, '100.00', 2),
(16, 'Hayes Valley Espresso', 'SBaking chocolate, orange zest, brown sugar', '80.00', 50, '100.00', 2),
(17, 'Costa Rica Lourdes', 'Caramel, orange sherbet, cardamom', '60.00', 25, '80.00', 1),
(18, 'Guatemala El Injerto', 'Peach, guava, dulce de leche', '125.00', 14, '120.00', 2),
(19, 'Brazil Caconde Serra do ', 'Guava, vanilla, cocoa', '60.00', 54, '100.00', 2),
(20, 'Honduras Santa Elena Doris ', 'Bergamot, rhubarb, allspice', '150.00', 33, '99.00', 1),
(21, 'Myanmar Shan State Shwe ', 'Date, cherry brandy, pineapple', '75.00', 324, '125.00', 2),
(22, 'Night Light Decaf', 'CrÃ¨me brÃ»lÃ©e, vanilla, key lime', '99.00', 34, '75.00', 1),
(23, 'Spring Blend', 'Honey, toffee, chamomile', '50.00', 31, '120.00', 2),
(24, 'El Salvador Aida Batlle ', 'Raisin, allspice, chocolate syrup', '80.00', 15, '60.00', 1),
(25, '17ft Ceiling Espresso', 'Caramel, almond, dried cherry', '200.00', 8, '240.00', 1),
(26, 'Hayes Valley Espresso', 'Baking chocolate, orange zest, brown sugar', '160.00', 24, '60.00', 1),
(27, 'Opascope Espresso', 'Juicy, vibrant, clean', '120.00', 5, '140.00', 2),
(28, 'Timor Leste Letefoho Eratoi', 'Salted butterscotch, kumquat, cherry', '99.00', 56, '125.00', 1),
(29, 'Kenya Kirinyaga Kii', 'Vanilla, pomegranate, lemon zest', '80.00', 25, '100.00', 2),
(30, 'Brazil Campo das Vertentes ', 'Dark chocolate, candied walnut, vanilla', '40.00', 45, '130.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Date_Order_Placed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_item`
--

CREATE TABLE `tbl_order_item` (
  `Item_ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Item_Quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `Id` int(11) NOT NULL,
  `Role` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`Id`, `Role`) VALUES
(1, 'Customer'),
(2, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_coffee_strength`
--
ALTER TABLE `tbl_coffee_strength`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Role` (`Role_Id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Coffee_Strength` (`Coffee_Strength_Id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Customer_ID` (`Customer_ID`);

--
-- Indexes for table `tbl_order_item`
--
ALTER TABLE `tbl_order_item`
  ADD PRIMARY KEY (`Item_ID`,`Order_ID`),
  ADD KEY `FK_Order_ID` (`Order_ID`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_coffee_strength`
--
ALTER TABLE `tbl_coffee_strength`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD CONSTRAINT `FK_Role` FOREIGN KEY (`Role_Id`) REFERENCES `tbl_role` (`Id`);

--
-- Constraints for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD CONSTRAINT `FK_Coffee_Strength` FOREIGN KEY (`Coffee_Strength_Id`) REFERENCES `tbl_coffee_strength` (`Id`);

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `FK_Customer_ID` FOREIGN KEY (`Customer_ID`) REFERENCES `tbl_customer` (`ID`);

--
-- Constraints for table `tbl_order_item`
--
ALTER TABLE `tbl_order_item`
  ADD CONSTRAINT `FK_Item_ID` FOREIGN KEY (`Item_ID`) REFERENCES `tbl_item` (`ID`),
  ADD CONSTRAINT `FK_Order_ID` FOREIGN KEY (`Order_ID`) REFERENCES `tbl_order` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
