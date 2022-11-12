-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2022 at 11:06 PM
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

--
-- Dumping data for table `assist`
--

INSERT INTO `assist` (`AssistId`, `PlayerId`, `Amount`) VALUES
(1, 100, 9),
(2, 153, 6),
(3, 10, 5),
(4, 68, 5),
(5, 154, 5),
(6, 1, 0),
(7, 2, 1),
(8, 8, 1),
(9, 16, 1),
(10, 24, 0),
(11, 43, 1),
(12, 45, 0),
(13, 64, 0),
(14, 65, 0),
(15, 74, 0),
(16, 79, 0),
(17, 83, 0),
(18, 87, 0),
(19, 90, 0),
(20, 107, 1),
(21, 108, 1),
(22, 114, 2),
(23, 116, 0),
(24, 117, 3),
(25, 125, 0),
(26, 128, 0),
(27, 139, 0);

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

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`CardId`, `PlayerId`, `Total`, `CardType`) VALUES
(1, 108, 5, 'yellow'),
(2, 72, 1, 'red');

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

--
-- Dumping data for table `fixture`
--

INSERT INTO `fixture` (`FixtureId`, `TeamId`, `Weather_Cond`, `Date`) VALUES
(1, 13, 'Cloudy', '2022-11-12'),
(2, 12, 'Sunny', '2022-11-12'),
(3, 16, 'Sunny', '2022-11-12'),
(4, 19, 'Sunny', '2022-11-12'),
(5, 18, 'Sunny', '2022-11-12'),
(6, 3, 'Cloudy', '2022-11-12'),
(7, 15, 'Thunder Storm', '2022-11-12'),
(8, 20, 'Cloudy', '2022-11-12'),
(9, 9, 'Cloudy', '2022-11-13'),
(10, 4, 'Rain', '2022-12-26'),
(11, 7, 'Rain', '2022-12-26'),
(12, 8, 'Cloudy', '2022-12-26'),
(13, 17, 'Rain', '2022-12-26'),
(14, 10, 'Cloudy', '2022-12-26'),
(15, 2, 'Cloudy', '2022-12-26'),
(16, 1, 'Cloudy', '2022-12-26'),
(17, 6, 'Cloudy', '2022-12-27'),
(18, 14, 'Cloudy', '2022-12-27'),
(19, 11, 'Rain', '2022-12-28'),
(20, 19, 'Cloudy', '2022-12-30'),
(21, 12, 'Cloudy', '2022-12-30'),
(22, 20, 'Sunny', '2022-12-31'),
(23, 9, 'Cloudy', '2022-12-31'),
(24, 13, 'Cloudy', '2022-12-31'),
(25, 15, 'Cloudy', '2022-12-31'),
(26, 3, 'Cloudy', '2022-12-31'),
(27, 18, 'Rain', '2023-01-01'),
(28, 16, 'Cloudy', '2023-01-01'),
(29, 4, 'Cloudy', '2023-01-02'),
(30, 10, 'Cloudy', '2023-01-03'),
(31, 8, 'Cloudy', '2023-01-03'),
(32, 1, 'Cloudy', '2023-01-03'),
(33, 14, 'Cloudy', '2023-01-03'),
(34, 17, 'Cloudy', '2023-01-04'),
(35, 11, 'Cloudy', '2023-01-04'),
(36, 2, 'Cloudy', '2023-01-04'),
(37, 7, 'Cloudy', '2023-01-04'),
(38, 6, 'Rain', '2023-01-05'),
(39, 2, 'Sunny', '2023-01-14'),
(40, 4, 'Sunny', '2023-01-14'),
(41, 6, 'Cloudy', '2023-01-14'),
(42, 8, 'Sunny', '2023-01-14'),
(43, 14, 'Sunny', '2023-01-14'),
(45, 15, 'Cloudy', '2023-01-14'),
(46, 16, 'Cloudy', '2023-01-14'),
(47, 18, 'Cloudy', '2023-01-14'),
(48, 20, 'Cloudy', '2023-01-14'),
(49, 1, 'Cloudy', '2023-01-21'),
(50, 3, 'Cloudy', '2023-01-21'),
(51, 7, 'Cloudy', '2023-01-21'),
(52, 9, 'Cloudy', '2023-01-21'),
(53, 19, 'Cloudy', '2023-01-21'),
(54, 10, 'Rain', '2023-01-21'),
(55, 12, 'Rain', '2023-01-21'),
(56, 13, 'Rain', '2023-01-21'),
(57, 17, 'Cloudy', '2023-01-21'),
(58, 11, 'Rain', '2023-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

CREATE TABLE `goal` (
  `GoalId` int(11) NOT NULL,
  `PlayerId` int(11) NOT NULL,
  `Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goal`
--

INSERT INTO `goal` (`GoalId`, `PlayerId`, `Amount`) VALUES
(1, 102, 18),
(2, 138, 11),
(3, 74, 9),
(4, 115, 8),
(5, 39, 8),
(6, 81, 7),
(7, 44, 7),
(8, 95, 6),
(9, 8, 0),
(10, 43, 1),
(11, 128, 0),
(12, 68, 1),
(13, 107, 1),
(14, 90, 0),
(15, 116, 2),
(16, 87, 0),
(17, 153, 4),
(18, 117, 1),
(19, 24, 0),
(20, 16, 0),
(21, 11, 0),
(22, 1, 0),
(23, 2, 0),
(24, 45, 0),
(25, 64, 0),
(26, 79, 0),
(27, 83, 0),
(28, 108, 2),
(29, 114, 3),
(30, 125, 0),
(31, 139, 0),
(32, 12, 0),
(33, 14, 0),
(34, 18, 1),
(35, 21, 3),
(36, 25, 0),
(37, 32, 2),
(38, 33, 3),
(39, 34, 0),
(40, 35, 0),
(41, 37, 1),
(42, 66, 1),
(43, 75, 0),
(44, 96, 0),
(45, 97, 0),
(46, 104, 0),
(47, 109, 1),
(48, 113, 0),
(49, 118, 0),
(50, 133, 0),
(51, 134, 0),
(52, 141, 0),
(53, 149, 2),
(54, 150, 0);

-- --------------------------------------------------------

--
-- Table structure for table `league`
--

CREATE TABLE `league` (
  `LeagueId` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Country` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `league`
--

INSERT INTO `league` (`LeagueId`, `Name`, `Country`) VALUES
(1, 'Premier League', 'England'),
(2, 'La Liga', 'Spain');

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

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`ManagerId`, `Name`, `Age`, `contract`, `TrophyCabinet`, `NumExp`, `TeamId`) VALUES
(1, 'Mikel Arteta', 40, 2025, 7, 4, 1),
(2, 'Unai Emery', 51, 2025, 11, 22, 2),
(3, 'Gary O\'Neil', 39, 2023, 0, 1, 3),
(4, 'Thomas Frank', 49, 2025, 0, 2, 4),
(5, 'Robert De Zerbi', 43, 2026, 2, 9, 5),
(6, 'Graham Potter', 47, 2027, 1, 15, 6),
(7, 'Patrick Vieira', 46, 2024, 0, 10, 7),
(8, 'Frank Lampard', 44, 2024, 0, 4, 8),
(9, 'Marco Silva', 45, 2024, 4, 10, 9),
(10, 'Jesse Marsch', 48, 2025, 5, 13, 10),
(11, 'Brendan Rodgers', 49, 2025, 9, 23, 11),
(12, 'Jürgen Klopp', 55, 2026, 14, 20, 12),
(13, 'Pep Guardiola', 51, 2023, 34, 15, 13),
(14, 'Erik ten Hag', 52, 2025, 7, 20, 14),
(17, 'Ralph Hasenhüttl', 55, 2024, 1, 17, 17),
(18, 'Antonio Conte', 53, 2023, 8, 17, 18),
(19, 'David Moyes', 59, 2024, 1, 25, 19),
(20, 'Steve Davis', 54, 2023, 0, 19, 20);

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `ParticipationId` int(11) NOT NULL,
  `LeagueId` int(11) NOT NULL,
  `TeamId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`ParticipationId`, `LeagueId`, `TeamId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20);

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
(1, 'Aaron Ramsdale', 24, 'Goalkeeper', 1, 3, 195, 79, 'Healthy', 'Adidas', 28),
(2, 'Ben White', 24, 'Defense', 1, 6, 182, 73, 'Healthy', 'Adidas', 40),
(3, 'Rob Holding', 27, 'Defense', 1, 2, 183, 74, 'Healthy', 'Nike', 8),
(4, 'Gabriel Magalhaes', 24, 'Defense', 1, 3, 190, 78, 'Healthy', 'Adidas', 27),
(5, 'Kerian Tierney', 25, 'Defense', 1, 6, 178, 69, 'Healthy', 'Adidas', 33),
(6, 'Fabio Vieira', 22, 'Midfield', 1, 2, 170, 66, 'Healthy', 'Nike', 11),
(7, 'Mohamed Elneny', 30, 'Midfield', 1, 3, 180, 77, 'Healthy', 'Adidas', 10),
(8, 'Albert Lokonga', 23, 'Midfield', 1, 3, 183, 78, 'Healthy', 'Adidas', 17),
(9, 'Reiss Nelson', 22, 'Forward', 1, 1, 175, 68, 'Healthy', 'Adidas', 8),
(10, 'Gabriel Jesus', 25, 'Forward', 1, 14, 177, 72, 'Healthy', 'Adidas', 83),
(11, 'Edward Nketiah', 23, 'Forward', 1, 2, 175, 72, 'Healthy', 'Nike', 20),
(12, 'Emiliano Martinez', 30, 'Goalkeeper', 2, 3, 193, 84, 'Healthy', 'Adidas', 28),
(13, 'Matty Cash', 25, 'Defense', 2, 3, 185, 76, 'Healthy', 'Umbro', 24),
(14, 'Ezri Konsa', 25, 'Defense', 2, 1, 183, 77, 'Healthy', 'Adidas', 24),
(15, 'Tyrone Mings', 29, 'Defense', 2, 4, 195, 77, 'Healthy', 'Nike', 28),
(16, 'Ashley Young', 37, 'Defense', 2, 3, 175, 65, 'Healthy', 'Nike', 1),
(17, 'Jacob Ramsey', 21, 'Midfield', 2, 1, 180, 73, 'Healthy', 'Adidas', 31),
(18, 'Douglas Luiz', 24, 'Midfield', 2, 2, 178, 66, 'Healthy', 'Nike', 39),
(19, 'John McGinn', 28, 'Midfield', 2, 1, 178, 69, 'Healthy', 'Nike', 33),
(20, 'Leon Bailey', 25, 'Forward', 2, 3, 181, 69, 'Healthy', 'Nike', 28),
(21, 'Danny Ings', 30, 'Forward', 2, 6, 178, 73, 'Healthy', 'Nike', 18),
(22, 'Ollie Watkins', 26, 'Forward', 2, 4, 180, 69, 'Healthy', 'Under Armour', 35),
(23, 'Neto', 33, 'Goalkeeper', 3, 1, 193, 83, 'Healthy', 'Puma', 3),
(24, 'Adam Smith', 31, 'Defense', 3, 2, 174, 78, 'Healthy', 'Nike', 2),
(25, 'Chris Mepham', 24, 'Defense', 3, 2, 191, 77, 'Healthy', 'Adidas', 7),
(26, 'Marcos Senesi', 25, 'Defense', 3, 1, 184, 78, 'Healthy', 'Nike', 19),
(27, 'Marcus Tavernier', 23, 'Midfield', 3, 1, 176, 68, 'Healthy', 'Nike', 17),
(28, 'Lewis Cook', 25, 'Midfield', 3, 2, 175, 69, 'Healthy', 'Adidas', 11),
(29, 'Jefferson Lerma', 28, 'Midfield', 3, 3, 179, 69, 'Healthy', 'Nike', 17),
(30, 'Philip Billing', 26, 'Midfield', 3, 2, 192, 79, 'Healthy', 'Nike', 20),
(31, 'Ryan Christie', 27, 'Midfield', 3, 1, 178, 72, 'Healthy', 'Adidas', 10),
(32, 'Emiliano Marcondes', 27, 'Midfield', 3, 1, 183, 74, 'Healthy', 'Nike', 2),
(33, 'Dominic Solanke', 25, 'Forward', 3, 3, 187, 74, 'Healthy', 'Adidas', 20),
(34, 'David Raya', 27, 'Goalkeeper', 4, 1, 186, 81, 'Healthy', 'Adidas', 24),
(35, 'Ethan Pinnock', 29, 'Defense', 4, 1, 188, 78, 'Healthy', 'Adidas', 13),
(36, 'Kristoffer Ajer', 24, 'Defense', 4, 1, 196, 83, 'Healthy', 'Nike', 18),
(37, 'Christian Norgaard', 28, 'Midfield', 4, 1, 185, 69, 'Healthy', 'TBD', 15),
(38, 'Frank Onyeka', 24, 'Midfield', 4, 1, 183, 74, 'Healthy', 'Nike', 10),
(39, 'Ivan Toney', 26, 'Forward', 4, 1, 179, 64, 'Healthy', 'Nike', 50),
(40, 'Yoane Wissa', 26, 'Forward', 4, 1, 180, 72, 'Healthy', 'Adidas', 17),
(41, 'Robert Sanchez', 24, 'Goalkeeper', 5, 1, 197, 87, 'Healthy', 'Nike', 35),
(42, 'Lewis Dunk', 30, 'Defense', 5, 4, 192, 87, 'Healthy', 'Adidas', 20),
(43, 'Adam Lallana', 34, 'Midfield', 5, 4, 173, 67, 'Healthy', 'Puma', 2),
(44, 'Leandro Trossard', 27, 'Forward', 5, 27, 172, 60, 'Healthy', 'Adidas', 33),
(45, 'Adam Webster', 27, 'Defense', 5, 3, 192, 79, 'Healthy', 'Adidas', 24),
(46, 'Moises Caicedo', 20, 'Midfield', 5, 1, 178, 74, 'Healthy', 'Nike', 42),
(47, 'Solly March', 27, 'Forward', 5, 2, 180, 72, 'Healthy', 'Adidas', 13),
(48, 'Kepa Arrizabalaga', 27, 'Goalkeeper', 6, 27, 189, 87, 'Healthy', 'Adidas', 17),
(49, 'Kalidou Koulibaly', 31, 'Defense', 6, 16, 195, 88, 'Healthy', 'Puma', 39),
(50, 'N\'Golo Kante', 31, 'Midfield', 6, 15, 169, 68, 'Healthy', 'Adidas', 33),
(51, 'Reece James', 22, 'Defence', 6, 13, 172, 63, 'Healthy', 'Nike', 77),
(52, 'Raheem Sterling', 27, 'Midfield', 6, 18, 170, 69, 'Healthy', 'New Balance', 77),
(53, 'Kai Havertz', 28, 'Forward', 6, 8, 186, 77, 'Healthy', 'Nike', 77),
(54, 'Mason Mount', 23, 'Forward', 6, 4, 175, 63, 'Healthy', 'Nike', 83),
(55, 'Vicente Guaita', 35, 'Goalkeeper', 7, 4, 191, 79, 'Healthy', 'Adidas', 2),
(56, 'Joel Ward', 33, 'Defense', 7, 2, 188, 82, 'Healthy', 'Nike', 2),
(57, 'Joachim Anderson', 26, 'Defense', 7, 4, 190, 74, 'Healthy', 'Nike', 32),
(58, 'Will Hughes', 27, 'Midfield', 7, 3, 185, 73, 'Healthy', 'Adidas', 5),
(59, 'James McArthur', 34, 'Midfield', 7, 3, 178, 67, 'Healthy', 'Nike', 1),
(60, 'Wilfred Zaha', 29, 'Forward', 7, 7, 180, 66, 'Healthy', 'Nike', 32),
(61, 'Odsonne Edouard', 24, 'Forward', 7, 5, 187, 83, 'Healthy', 'Nike', 17),
(62, 'Jordan Pickford', 28, 'Goalkeeper', 8, 5, 185, 77, 'Healthy', 'Nike', 28),
(63, 'Yerry Mina', 28, 'Defense', 8, 6, 195, 74, 'Healthy', 'Adidas', 18),
(64, 'Ben Godfrey', 24, 'Defense', 8, 4, 183, 78, 'Healthy', 'Nike', 18),
(65, ' Abdoulaye Doucouré', 29, 'Midfield', 8, 4, 180, 59, 'Healthy', 'Adidas', 12),
(66, 'Demarai Gray', 26, 'Midfield', 8, 2, 178, 66, 'Healthy', 'Adidas', 20),
(67, 'Moise Kean', 22, 'Forward', 8, 3, 182, 77, 'Healthy', 'Adidas', 24),
(68, 'Alex Iwobi', 26, 'Forward', 8, 3, 180, 74, 'Healthy', 'Nike', 25),
(69, 'George Wickens', 20, 'Goalkeeper', 9, 1, 185, 73, 'Healthy', 'Nike', 1),
(70, 'Layvin Kurzawa', 30, 'Defense', 9, 5, 182, 74, 'Healthy', 'Nike', 5),
(71, 'Kenny Tete', 27, 'Defense', 9, 3, 180, 69, 'Healthy', 'Adidas', 7),
(72, 'Nathaniel Chalobah', 27, 'Midfield', 9, 3, 185, 79, 'Healthy', 'Nike', 3),
(73, 'Tom Cairney', 31, 'Midfield', 9, 2, 183, 72, 'Healthy', 'Nike', 2),
(74, 'Aleksandar Mitrovic', 28, 'Forward', 9, 3, 189, 83, 'Healthy', 'TBD', 28),
(75, 'Daniel James', 24, 'Forward', 9, 3, 179, 78, 'Healthy', 'Nike', 16),
(76, 'Illan Meslier', 22, 'Goalkeeper', 11, 1, 193, 73, 'Healthy', 'Adidas', 22),
(77, 'Robin Koch', 26, 'Defense', 11, 4, 192, 82, 'Healthy', 'Adidas', 18),
(78, 'Junior Firpo', 26, 'Defense', 11, 2, 184, 78, 'Healthy', 'Nike', 12),
(79, 'Adam Forshaw', 31, 'Midfield', 11, 1, 185, 71, 'Healthy', 'Nike', 2),
(80, 'Mateusz Klich', 32, 'Midfield', 11, 1, 183, 68, 'Healthy', 'Nike', 2),
(81, 'Rodrigo Machado', 31, 'Forward', 11, 3, 180, 73, 'Healthy', 'Nike', 9),
(82, 'Patrick Bamford', 29, 'Forward', 11, 2, 188, 71, 'Healthy', 'Nike', 12),
(83, 'Alex Smithies', 32, 'Goalkeeper', 10, 2, 185, 83, 'Healthy', 'Nike', 1),
(84, 'Jonny Evans', 34, 'Defense', 10, 4, 188, 77, 'Healthy', 'Nike', 3),
(85, 'Ricardo Pereira', 29, 'Defense', 10, 4, 175, 69, 'Healthy', 'Nike', 12),
(86, 'James Maddison', 25, 'Midfield', 10, 6, 175, 72, 'Healthy', 'Puma', 55),
(87, 'Boubakary Soumaré', 23, 'Midfield', 10, 5, 188, 82, 'Healthy', 'Nike', 25),
(88, 'Jamie Vardy', 35, 'Forward', 10, 7, 178, 76, 'Healthy', 'Nike', 4),
(89, 'Patson Daka', 24, 'Forward', 10, 3, 180, 71, 'Healthy', 'Nike', 20),
(90, 'Alisson', 30, 'Goalkeeper', 12, 8, 193, 91, 'Healthy', 'Nike', 50),
(91, 'Virgil Van Dijk', 31, 'Defense', 12, 11, 193, 87, 'Healthy', 'Nike', 50),
(92, 'Trent Alexander-Arnold', 24, 'Defense', 12, 9, 175, 68, 'Healthy', 'Under Armour', 70),
(93, 'Thiago Alcántara', 31, 'Midfield', 12, 10, 172, 59, 'Healthy', 'Tommy Hilfigher', 18),
(94, 'Fabinho', 29, 'Midfield', 12, 9, 188, 78, 'Healthy', 'Nike', 55),
(95, 'Mohamed Salah', 30, 'Forward', 12, 18, 175, 71, 'Healthy', 'Adidas', 80),
(96, 'Diogo Jota', 25, 'Forward', 12, 9, 178, 69, 'Healthy', 'Adidas', 55),
(97, 'Ederson', 29, 'Goalkeeper', 13, 3, 188, 88, 'Healthy', 'Puma', 45),
(98, 'John Stones', 28, 'Defense', 13, 13, 188, 69, 'Healthy', 'Nike', 30),
(99, 'Manuel Akanji', 27, 'Defense', 13, 9, 187, 84, 'Healthy', 'Nike', 30),
(100, 'Kevin De Bruyne', 31, 'Midfield', 13, 20, 181, 69, 'Healthy', 'Nike', 80),
(101, 'Jack Grealish', 27, 'Midfield', 13, 16, 175, 68, 'Healthy', 'Gucci', 70),
(102, 'Erling Haaland', 22, 'Forward', 13, 20, 191, 87, 'Healthy', 'Nike', 170),
(103, 'Julian Álvarez', 22, 'Forward', 13, 3, 173, 69, 'Healthy', 'Adidas', 32),
(104, 'David De Gea', 31, 'Goalkeeper', 14, 20, 192, 76, 'Healthy', 'Adidas', 15),
(105, 'Raphael Varane', 29, 'Defense', 14, 18, 194, 83, 'healthy', 'Puma', 40),
(106, 'Harry Maguire', 29, 'Defense', 14, 10, 188, 78, 'Healthy', 'Puma', 30),
(107, 'Casemiro', 30, 'Midfield', 14, 16, 184, 79, 'Healthy', 'Nike', 50),
(108, 'Bruno Fernandes', 28, 'Midfield', 14, 12, 173, 64, 'Healthy', 'Nike', 75),
(109, 'Cristiano Ronaldo', 37, 'Forward', 14, 27, 187, 83, 'Healthy', 'Nike', 20),
(110, 'Jadon Sancho', 22, 'Forward', 14, 18, 180, 73, 'Healthy', 'Nike', 60),
(111, 'Karl Darlow', 32, 'Goalkeeper', 15, 1, 190, 88, 'Healthy', 'Puma', 2),
(112, 'Kieran Trippier', 32, 'Defense', 15, 8, 173, 71, 'Healthy', 'Adidas', 13),
(113, 'Fabian Schar', 30, 'Defense', 15, 2, 188, 84, 'Healthy', 'Puma', 10),
(114, 'Bruno Guimarães', 24, 'Midfield', 15, 6, 182, 74, 'Healthy', 'Adidas', 60),
(115, 'Miguel Almiron', 28, 'Midfield', 15, 2, 174, 70, 'Healthy', 'Nike', 20),
(116, 'Alexander Isak', 23, 'Forward', 15, 6, 184, 83, 'Healthy', 'Adidas', 50),
(117, 'Allan Saint-Maximin', 25, 'Forward', 15, 2, 173, 67, 'Healthy', 'Puma', 40),
(118, 'Dean Henderson', 25, 'Goalkeeper', 16, 5, 188, 85, 'Healthy', 'Nike', 22),
(119, 'Renan Lodi', 24, 'Defense', 16, 3, 173, 68, 'Healthy', 'Nike', 20),
(120, 'Steve Cook', 31, 'Defense', 16, 2, 185, 82, 'Healthy', 'Nike', 3),
(121, 'Jesse Lingard', 29, 'Midfield', 16, 10, 175, 62, 'Healthy', 'Nike', 14),
(122, 'Harry Arter', 32, 'Midfield', 16, 1, 176, 70, 'Healthy', 'Nike', 1),
(123, 'Lyle Taylor', 32, 'Forward', 16, 1, 188, 79, 'Healthy', 'Nike', 1),
(124, 'Sam Surridge', 24, 'Forward', 16, 1, 188, 79, 'Healthy', 'Nike', 4),
(125, 'Alex McCarthy', 32, 'Goalkeeper', 17, 3, 193, 79, 'Healthy', 'Adidas', 2),
(126, 'Romain Perraud', 25, 'Defense', 17, 2, 173, 68, 'Healthy', 'Nike', 2),
(127, 'Mohammed Salisu', 23, 'Defense', 17, 1, 191, 82, 'Healthy', 'Nike', 18),
(128, 'Ainsley Maitland-Niles ', 25, 'Midfield', 17, 3, 180, 67, 'Healthy', 'Nike', 8),
(129, 'Stuart Armstrong', 30, 'Midfield', 17, 3, 183, 68, 'Healthy', 'Nike', 6),
(130, 'Theo Walcott', 33, 'Forward', 17, 4, 176, 69, 'Healthy', 'Adidas', 2),
(131, 'Mohamed Elyounoussi', 28, 'Forward', 17, 3, 178, 69, 'Healthy', 'Nike', 12),
(132, 'Hugo Lloris', 35, 'Goalkeeper', 18, 5, 188, 78, 'Healthy', 'Nike', 7),
(133, 'Cristian Romero', 24, 'Defense', 18, 9, 185, 82, 'Healthy', 'Nike', 55),
(134, 'Clément Lenglet', 27, 'Defense', 18, 6, 186, 81, 'Healthy', 'Nike', 12),
(135, 'Ivan Perisic', 33, 'Midfield', 18, 9, 187, 78, 'Healthy', 'Nike', 10),
(136, 'Pierre-Emile Hojbjerg', 27, 'Midfield', 18, 5, 185, 81, 'Healthy', 'Adidas', 45),
(137, 'Heung-Min Son', 30, 'Forward', 18, 10, 183, 76, 'Healthy', 'Calvin Klein', 70),
(138, 'Harry Kane', 29, 'Forward', 18, 10, 188, 73, 'Healthy', 'Nike', 90),
(139, 'Alphonse Areola', 29, 'Goalkeeper', 19, 6, 192, 87, 'Healthy', 'Adidas', 8),
(140, 'Kurt Zouma', 28, 'Defense', 19, 6, 190, 92, 'Healthy', 'Adidas', 32),
(141, 'Emerson Palmieri', 28, 'Defense', 19, 5, 176, 63, 'Healthy', 'Adidas', 12),
(142, 'Lucas Paquetá', 25, 'Midfield', 19, 8, 180, 72, 'Healthy', 'Nike', 45),
(143, 'Michail Antonio', 32, 'Midfield', 19, 4, 180, 82, 'Healthy', 'Adidas', 9),
(144, 'Jarrod Bowen', 25, 'Forward', 19, 5, 178, 69, 'Healthy', 'Adidas', 42),
(145, 'Gianluca Scamacca', 23, 'Forward', 19, 5, 195, 86, 'Healthy', 'Nike', 30),
(146, 'José Sá', 29, 'Goalkeeper', 20, 1, 192, 86, 'Healthy', 'Adidas', 18),
(147, 'Nelson Semedo', 28, 'Defense', 20, 4, 177, 64, 'Healthy', 'Nike', 18),
(148, 'Jonny Castro', 28, 'Defense', 20, 2, 175, 69, 'Healthy', 'Adidas', 17),
(149, 'Daniel Podence', 27, 'Forward', 20, 3, 165, 58, 'Healthy', 'Nike', 20),
(150, 'Diego Costa', 34, 'Forward', 20, 3, 188, 81, 'Healthy', 'Adidas', 4),
(151, 'Joao Moutinho', 36, 'Midfield', 20, 5, 171, 60, 'Healthy', 'Adidas', 2),
(152, 'Matheus Nunes', 24, 'Midfield', 20, 4, 183, 78, 'Healthy', 'Adidas', 45),
(153, 'Bukayo Saka', 21, 'Attacker', 1, 3, 180, 65, 'Healthy', 'New Balance', 65),
(154, 'Bernando Silva', 28, 'Attacker', 13, 18, 170, 64, 'Healthy', 'Adidas', 70);

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
  `ManagerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`TeamId`, `Name`, `TotalTrophies`, `FoundedDate`, `Country`, `Value`, `position`, `ManagerId`) VALUES
(1, 'Arsenal FC', 47, '1886-12-01', 'England', 2888, 1, 0),
(2, 'Aston Villa FC', 24, '1975-03-01', 'England', 198, 2, 0),
(3, 'Bournemouth AFC', 2, '1899-01-01', 'England', 150, 3, 0),
(4, 'Brentford FC', 3, '1889-01-01', 'England', 50, 4, 0),
(5, 'Brighton & Hove Albion FC', 5, '1901-06-24', 'England', 300, 5, 0),
(6, 'Chelsea FC', 36, '1905-03-15', 'England', 3000, 6, 0),
(7, 'Crystal Palace FC', 3, '1861-01-01', 'England', 300, 7, 0),
(8, 'Everton FC', 20, '1878-01-01', 'England', 940, 8, 0),
(9, 'Fulham FC', 5, '1879-01-01', 'England', 230, 9, 0),
(10, 'Leicester City FC', 15, '1884-01-01', 'England', 670, 10, 0),
(11, 'Leeds United FC', 13, '1919-10-17', 'England', 690, 11, 0),
(12, 'Liverpool FC', 70, '1892-06-03', 'England', 2666, 12, 0),
(13, 'Manchester City FC', 36, '1880-01-01', 'England', 4000, 13, 0),
(14, 'Manchester United', 78, '1878-01-01', 'England', 2150, 14, 0),
(15, 'Newcastle United FC', 15, '1892-12-09', 'England', 500, 15, 0),
(16, 'Nottingham Forest FC', 15, '1865-01-01', 'England', 120, 16, 0),
(17, 'Southampton FC', 3, '1865-01-01', 'England', 200, 17, 0),
(18, 'Tottenham Hotspur FC', 26, '1885-09-05', 'England', 849, 18, 0),
(19, 'West Ham United FC', 7, '1895-01-01', 'England', 900, 19, 0),
(20, 'Wolverhampton Wanderers', 20, '1877-01-01', 'England', 450, 20, 0),
(100, 'Test', 88, '1901-07-24', 'France', 3000, 50, 1);

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
  ADD PRIMARY KEY (`LeagueId`);

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
  ADD KEY `Team_Manager_FK` (`ManagerId`);

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
