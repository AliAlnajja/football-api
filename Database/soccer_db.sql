-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 01:10 AM
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

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`PlayerId`, `Name`, `Age`, `position`, `TeamId`, `Wages`, `Height`, `Weight`, `P_Condition`, `BrandAssoc`, `Value`) VALUES
(1, 'Aaron Ramsdale', 24, 'Goalkeeper', 1, 3, 195, 79, 'Healthy', '', 28),
(2, 'Ben White', 24, 'Defense', 1, 6, 182, 73, 'Healthy', '', 40),
(3, 'Rob Holding', 27, 'Defense', 1, 2, 183, 74, 'Healthy', '', 8),
(4, 'Gabriel Magalhaes', 24, 'Defense', 1, 3, 190, 78, 'Healthy', '', 27),
(5, 'Kerian Tierney', 25, 'Defense', 1, 6, 178, 69, 'Healthy', '', 33),
(6, 'Fabio Vieira', 22, 'Midfield', 1, 2, 170, 66, 'Healthy', '', 11),
(7, 'Mohamed Elneny', 30, 'Midfield', 1, 3, 180, 77, 'Healthy', '', 10),
(8, 'Albert Lokonga', 23, 'Midfield', 1, 3, 183, 78, 'Healthy', '', 17),
(9, 'Reiss Nelson', 22, 'Forward', 1, 1, 175, 68, 'Healthy', '', 8),
(10, 'Gabriel Jesus', 25, 'Forward', 1, 14, 177, 72, 'Healthy', 'Adidas', 83),
(11, 'Edward Nketiah', 23, 'Forward', 1, 2, 175, 72, 'Healthy', '', 20),
(12, 'Emiliano Martinez', 30, 'Goalkeeper', 2, 3, 193, 84, 'Healthy', '', 28),
(13, 'Matty Cash', 25, 'Defense', 2, 3, 185, 76, 'Healthy', '', 24),
(14, 'Ezri Konsa', 25, 'Defense', 2, 1, 183, 77, 'Healthy', '', 24),
(15, 'Tyrone Mings', 29, 'Defense', 2, 4, 195, 77, 'Healthy', '', 28),
(16, 'Ashley Young', 37, 'Defense', 2, 3, 175, 65, 'Healthy', '', 1),
(17, 'Jacob Ramsey', 21, 'Midfield', 2, 1, 180, 73, 'Healthy', '', 31),
(18, 'Douglas Luiz', 24, 'Midfield', 2, 2, 178, 66, 'Healthy', '', 39),
(19, 'John McGinn', 28, 'Midfield', 2, 1, 178, 69, 'Healthy', '', 33),
(20, 'Leon Bailey', 25, 'Forward', 2, 3, 181, 69, 'Healthy', '', 28),
(21, 'Danny Ings', 30, 'Forward', 2, 6, 178, 73, 'Healthy', '', 18),
(22, 'Ollie Watkins', 26, 'Forward', 2, 4, 180, 69, 'Healthy', '', 35),
(23, 'Neto', 33, 'Goalkeeper', 3, 1, 193, 83, 'Healthy', '', 3),
(24, 'Adam Smith', 31, 'Defense', 3, 2, 174, 78, 'Healthy', '', 2),
(25, 'Chris Mepham', 24, 'Defense', 3, 2, 191, 77, 'Healthy', '', 7),
(26, 'Marcos Senesi', 25, 'Defense', 3, 1, 184, 78, 'Healthy', '', 19),
(27, 'Marcus Tavernier', 23, 'Midfield', 3, 1, 176, 68, 'Healthy', '', 17),
(28, 'Lewis Cook', 25, 'Midfield', 3, 2, 175, 69, 'Healthy', '', 11),
(29, 'Jefferson Lerma', 28, 'Midfield', 3, 3, 179, 69, 'Healthy', '', 17),
(30, 'Philip Billing', 26, 'Midfield', 3, 2, 192, 79, 'Healthy', '', 20),
(31, 'Ryan Christie', 27, 'Midfield', 3, 1, 178, 72, 'Healthy', '', 10),
(32, 'Emiliano Marcondes', 27, 'Midfield', 3, 1, 183, 74, 'Healthy', '', 2),
(33, 'Dominic Solanke', 25, 'Forward', 3, 3, 187, 74, 'Healthy', '', 20);

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

--
-- Dumping data for table `stadium`
--

INSERT INTO `stadium` (`StadiumId`, `TeamId`, `Name`, `Capacity`, `City`, `Value`, `FoundedDate`) VALUES
(1, 5, 'Amex Stadium', 30750, 'Brighton', 130, '2011-01-01'),
(2, 12, 'Anfield', 54074, 'Liverpool', 330, '1884-09-28'),
(3, 4, 'Gtech Community Stadium', 17250, 'Bretford', 50, '2020-09-01'),
(4, 11, 'Elland Road', 37890, 'Leeds', 120, '1897-01-01'),
(5, 1, 'Emirates Stadium', 60704, 'London', 600, '2006-07-22'),
(6, 13, 'Etihad Stadium', 55097, 'Manchester', 500, '2003-08-23'),
(7, 8, 'Goodison Park', 40157, 'Liverpool', 290, '1892-08-24'),
(8, 10, 'King Power Stadium', 32500, 'Leicester', 300, '2002-07-23'),
(9, 19, 'London Stadium', 66000, 'London', 800, '2012-05-05'),
(10, 20, 'Molineux Stadium', 31700, 'Wolverhampton', 200, '1889-01-01'),
(11, 14, 'Old Trafford', 74140, 'Manchester', 350, '1909-02-19'),
(12, 17, 'Saint Mary\'s', 32689, 'Southampton', 130, '2001-08-01'),
(13, 7, 'Selhurst Park', 26255, 'London', 160, '1924-01-01'),
(14, 15, 'St James Park', 52409, 'Newcastle', 300, '1880-01-01'),
(15, 6, 'Stamford Bridge', 42000, 'London', 390, '1877-04-28'),
(16, 18, 'Tottenham Hotspur Stadium', 62850, 'London', 1000, '2019-04-03'),
(17, 2, 'Villa Park', 43000, 'Birmingham', 350, '1897-01-01'),
(18, 3, 'Vitality Stadium', 12000, 'Bournemouth ', 80, '1910-01-01'),
(19, 5, 'American Express Community Stadium', 32000, 'Brighton', 100, '2011-08-01'),
(20, 9, 'Craven Cottage', 26000, 'London', 250, '1896-10-10');

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
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`TeamId`, `Name`, `TotalTrophies`, `FoundedDate`, `Country`, `Value`, `position`, `ManagerId`, `PlayerId`) VALUES
(1, 'Arsenal FC', 47, '1886-12-01', 'England', 2888, 1, 0, 0),
(2, 'Aston Villa FC', 24, '1975-03-01', 'England', 198, 2, 0, 0),
(3, 'Bournemouth AFC', 2, '1899-01-01', 'England', 150, 3, 0, 0),
(4, 'Brentford FC', 3, '1889-01-01', 'England', 50, 4, 0, 0),
(5, 'Brighton & Hove Albion FC', 5, '1901-06-24', 'England', 300, 5, 0, 0),
(6, 'Chelsea FC', 36, '1905-03-15', 'England', 3000, 6, 0, 0),
(7, 'Crystal Palace FC', 3, '1861-01-01', 'England', 300, 7, 0, 0),
(8, 'Everton FC', 20, '1878-01-01', 'England', 940, 8, 0, 0),
(9, 'Fulham FC', 5, '1879-01-01', 'England', 230, 9, 0, 0),
(10, 'Leicester City FC', 15, '1884-01-01', 'England', 670, 10, 0, 0),
(11, 'Leeds United FC', 13, '1919-10-17', 'England', 690, 11, 0, 0),
(12, 'Liverpool FC', 70, '1892-06-03', 'England', 2666, 12, 0, 0),
(13, 'Manchester City FC', 36, '1880-01-01', 'England', 4000, 13, 0, 0),
(14, 'Manchester United', 78, '1878-01-01', 'England', 2150, 14, 0, 0),
(15, 'Newcastle United FC', 15, '1892-12-09', 'England', 500, 15, 0, 0),
(16, 'Nottingham Forest FC', 15, '1865-01-01', 'England', 120, 16, 0, 0),
(17, 'Southampton FC', 3, '1865-01-01', 'England', 200, 17, 0, 0),
(18, 'Tottenham Hotspur FC', 26, '1885-09-05', 'England', 849, 18, 0, 0),
(19, 'West Ham United FC', 7, '1895-01-01', 'England', 900, 19, 0, 0),
(20, 'Wolverhampton Wanderers', 20, '1877-01-01', 'England', 450, 20, 0, 0);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
