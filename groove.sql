-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2021 at 05:22 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `groove`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `Id` int(11) NOT NULL,
  `Title` varchar(40) NOT NULL,
  `Cover` varchar(10) NOT NULL,
  `ReleaseDate` date NOT NULL,
  `Genre` varchar(40) NOT NULL,
  `Track_Id` int(11) NOT NULL,
  `Artist_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Photo` varchar(10) NOT NULL,
  `Description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`Id`, `User_Id`, `Name`, `Photo`, `Description`) VALUES
(1, 1, 'Gamz', '', 'adsd');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `Id` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Localisation` varchar(40) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Artist_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `live`
--

CREATE TABLE `live` (
  `Id` int(11) NOT NULL,
  `Title` varchar(40) NOT NULL,
  `Poster` varchar(10) NOT NULL,
  `Location` varchar(40) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Artist_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `Id` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Url` varchar(255) NOT NULL,
  `User_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `Id` int(11) NOT NULL,
  `Title` varchar(40) NOT NULL,
  `Url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Firstname` varchar(40) NOT NULL,
  `Lastname` varchar(40) NOT NULL,
  `Nickname` varchar(40) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Country` varchar(40) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Created_At` datetime DEFAULT current_timestamp(),
  `Admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Firstname`, `Lastname`, `Nickname`, `Email`, `Country`, `Password`, `Created_At`, `Admin`) VALUES
(1, 'Pedro', 'Gamela', 'Gamz', 'pgamela@hotmail.com', '', '$2y$10$Jy7c6swSIZ.xYOLFVkKn5u6WTIvcNc9C3FAa2eSi6Y/aqkWwaLv8y', '2021-04-28 23:02:01', 1),
(2, 'john', 'smith', 'Smith', 'johnsmith@gmail.com', '', '$2y$10$TnkSuBkYF.DOYaYoDZQ5muiEti0.7ivYmMX5Xb4A1I0bg6rnkhcNS', '2021-04-28 23:07:53', 0),
(3, 'admin', '1', 'admin', 'admin@gmail.com', '', '$2y$10$nENj5EOQd6/0uhOXX5rqEeAg5jW0z1cTJcUS2CYxk5HkMDYB0sGa2', '2021-04-29 10:07:21', 2),
(4, 'test1', 'test', 'test', 'test@gmail.com', '', '$2y$10$qdosVh9xdj6JB/KIv9UpquCH8ewyl0Xzon7IrAU0BJRfE7CxHwEW.', '2021-04-29 13:51:25', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Track_Id` (`Track_Id`,`Artist_Id`),
  ADD KEY `Artist_Id` (`Artist_Id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Artist_Id` (`Artist_Id`);

--
-- Indexes for table `live`
--
ALTER TABLE `live`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Artist_Id` (`Artist_Id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Nickname` (`Nickname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live`
--
ALTER TABLE `live`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`Artist_Id`) REFERENCES `artist` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `album_ibfk_2` FOREIGN KEY (`Track_Id`) REFERENCES `track` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `artist`
--
ALTER TABLE `artist`
  ADD CONSTRAINT `artist_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`Artist_Id`) REFERENCES `artist` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `live`
--
ALTER TABLE `live`
  ADD CONSTRAINT `live_ibfk_1` FOREIGN KEY (`Artist_Id`) REFERENCES `artist` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `social`
--
ALTER TABLE `social`
  ADD CONSTRAINT `social_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `artist` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
