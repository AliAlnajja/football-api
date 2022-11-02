-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2022 at 06:15 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soccer_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assist`
--

CREATE TABLE `assist` (
  `AssistId` int(11) NOT NULL,
  `PlayerId` int(11) NOT NULL,
  `Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `CardId` int(11) NOT NULL,
  `PlayerId` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `CardType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fixture`
--

CREATE TABLE `fixture` (
  `FixtureId` int(11) NOT NULL,
  `TeamId` int(11) NOT NULL,
  `Weather_Cond` varchar(20) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

CREATE TABLE `goal` (
  `GoalId` int(11) NOT NULL,
  `PlayerId` int(11) NOT NULL,
  `Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `league`
--

CREATE TABLE `league` (
  `LeagueId` int(11) NOT NULL,
  `TeamId` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Country` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `ManagerId` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL,
  `contract` int(11) NOT NULL,
  `TrophyCabinet` int(11) NOT NULL,
  `NumExp` int(11) NOT NULL,
  `TeamId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `PlayerId` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `TeamId` int(11) NOT NULL,
  `Wages` int(11) NOT NULL,
  `Height` int(11) NOT NULL,
  `Weight` int(11) NOT NULL,
  `P_Condition` varchar(20) NOT NULL,
  `BrandAssoc` varchar(40) NOT NULL,
  `Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stadium`
--

CREATE TABLE `stadium` (
  `StadiumId` int(11) NOT NULL,
  `TeamId` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Value` int(11) NOT NULL,
  `FoundedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `TeamId` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `TotalTrophies` int(11) NOT NULL,
  `FoundedDate` date NOT NULL,
  `Country` varchar(30) NOT NULL,
  `Value` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `ManagerId` int(11) NOT NULL,
  `PlayerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assist`
--
ALTER TABLE `assist`
  ADD PRIMARY KEY (`AssistId`),
  ADD KEY `Assist_Player_FK` (`PlayerId`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`CardId`),
  ADD KEY `Card_Player_FK` (`PlayerId`);

--
-- Indexes for table `fixture`
--
ALTER TABLE `fixture`
  ADD PRIMARY KEY (`FixtureId`),
  ADD KEY `Fixture_Team_FK` (`TeamId`);

--
-- Indexes for table `goal`
--
ALTER TABLE `goal`
  ADD PRIMARY KEY (`GoalId`),
  ADD KEY `Goal_Player_FK` (`PlayerId`);

--
-- Indexes for table `league`
--
ALTER TABLE `league`
  ADD PRIMARY KEY (`LeagueId`),
  ADD KEY `League_Team_FK` (`TeamId`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`ManagerId`),
  ADD KEY `Manager_Team_FK` (`TeamId`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`PlayerId`),
  ADD KEY `Player_Team_FK` (`TeamId`);

--
-- Indexes for table `stadium`
--
ALTER TABLE `stadium`
  ADD PRIMARY KEY (`StadiumId`),
  ADD KEY `Stadium_Team_FK` (`TeamId`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`TeamId`),
  ADD KEY `Team_Manager_FK` (`ManagerId`),
  ADD KEY `Team_Player_FK` (`PlayerId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assist`
--
ALTER TABLE `assist`
  ADD CONSTRAINT `Assist_Player_FK` FOREIGN KEY (`PlayerId`) REFERENCES `player` (`PlayerId`);

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `Card_Player_FK` FOREIGN KEY (`PlayerId`) REFERENCES `player` (`PlayerId`);

--
-- Constraints for table `fixture`
--
ALTER TABLE `fixture`
  ADD CONSTRAINT `Fixture_Team_FK` FOREIGN KEY (`TeamId`) REFERENCES `teams` (`TeamId`);

--
-- Constraints for table `goal`
--
ALTER TABLE `goal`
  ADD CONSTRAINT `Goal_Player_FK` FOREIGN KEY (`PlayerId`) REFERENCES `player` (`PlayerId`);

--
-- Constraints for table `league`
--
ALTER TABLE `league`
  ADD CONSTRAINT `League_Team_FK` FOREIGN KEY (`TeamId`) REFERENCES `teams` (`TeamId`);

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `Manager_Team_FK` FOREIGN KEY (`TeamId`) REFERENCES `teams` (`TeamId`);

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `Player_Team_FK` FOREIGN KEY (`TeamId`) REFERENCES `teams` (`TeamId`);

--
-- Constraints for table `stadium`
--
ALTER TABLE `stadium`
  ADD CONSTRAINT `Stadium_Team_FK` FOREIGN KEY (`TeamId`) REFERENCES `teams` (`TeamId`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `Team_Manager_FK` FOREIGN KEY (`ManagerId`) REFERENCES `manager` (`ManagerId`),
  ADD CONSTRAINT `Team_Player_FK` FOREIGN KEY (`PlayerId`) REFERENCES `player` (`PlayerId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
