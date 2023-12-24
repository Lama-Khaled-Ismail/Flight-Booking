-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 24, 2023 at 09:57 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Bio` text NOT NULL,
  `Address` text NOT NULL,
  `Location` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` int(11) NOT NULL,
  `Logo` blob NOT NULL,
  `Account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`ID`, `Name`, `Bio`, `Address`, `Location`, `username`, `password`, `email`, `tel`, `Logo`, `Account`) VALUES
(1, 'root1', '', '', '', '', 'menna2003', 'ff', 0, '', 0),
(5, 'company', '', '', '', '', '123456', 'mennaahmed.ma54@gmail.com', 111111111, '', 0),
(6, 'company', '', '', '', '', '11111', 'mennaahmed.ma54@gmail.com', 111111111, '', 0),
(7, 'company', '', '', '', '', '12334', 'mennaahmed.ma54@gmail.com', 111111111, '', 0),
(8, 'company2', '', 'gh', 'hhb', '', '12345', 'mennaahmed.ma54@gmail.com', 111111111, '', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `companyflight`
--

CREATE TABLE `companyflight` (
  `company_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Completed` tinyint(1) NOT NULL DEFAULT '0',
  `RegPassangers` int(11) NOT NULL,
  `PendPassangers` int(11) NOT NULL,
  `fees` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itinerary`
--

CREATE TABLE `itinerary` (
  `ID` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tel` int(11) NOT NULL,
  `photo` tinyblob NOT NULL,
  `passport` blob NOT NULL,
  `Account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`ID`, `Name`, `email`, `password`, `tel`, `photo`, `passport`, `Account`) VALUES
(1, 'root', 'ff', 'menna2003', 0, '', '', 0),
(2, 'passenger', 'passenger@email', 'menna2003', 124783, '', '', 0),
(5, 'pass', 'mennaahmed.ma54@gmail.com', '1223', 111111111, '', '', 0),
(7, 'passnger', 'mennaahmed.ma54@gmail.com', '122', 111111111, '', '', 0),
(9, 'passnger2', 'mennaahmed.ma54@gmail.com', '122', 111111111, '', '', 0),
(10, 'passnger3', 'mennaahmed.ma54@gmail.com', '122', 111111111, '', '', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `passengerflight`
--

CREATE TABLE `passengerflight` (
  `flight_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `companyflight`
--
ALTER TABLE `companyflight`
  ADD KEY `company_id` (`company_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `itinerary`
--
ALTER TABLE `itinerary`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `passengerflight`
--
ALTER TABLE `passengerflight`
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `passenger_id` (`passenger_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itinerary`
--
ALTER TABLE `itinerary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `companyflight`
--
ALTER TABLE `companyflight`
  ADD CONSTRAINT `companyflight_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `companyflight_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `itinerary`
--
ALTER TABLE `itinerary`
  ADD CONSTRAINT `itinerary_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `passengerflight`
--
ALTER TABLE `passengerflight`
  ADD CONSTRAINT `passengerflight_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `passengerflight_ibfk_2` FOREIGN KEY (`passenger_id`) REFERENCES `passenger` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
