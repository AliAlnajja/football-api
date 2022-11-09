-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2022 at 02:31 AM
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
  `Name` varchar(40) NOT NULL,
  `Country` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `league`
--

INSERT INTO `league` (`LeagueId`, `Name`, `Country`) VALUES
(1, 'Premier League', 'England');

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
(33, 'Dominic Solanke', 25, 'Forward', 3, 3, 187, 74, 'Healthy', '', 20),
(34, 'David Raya', 27, 'Goalkeeper', 4, 1, 186, 81, 'Healthy', '', 24),
(35, 'Ethan Pinnock', 29, 'Defense', 4, 1, 188, 78, 'Healthy', '', 13),
(36, 'Kristoffer Ajer', 24, 'Defense', 4, 1, 196, 83, 'Healthy', '', 18),
(37, 'Christian Norgaard', 28, 'Midfield', 4, 1, 185, 69, 'Healthy', '', 15),
(38, 'Frank Onyeka', 24, 'Midfield', 4, 1, 183, 74, 'Healthy', '', 10),
(39, 'Ivan Toney', 26, 'Forward', 4, 1, 179, 64, 'Healthy', '', 50),
(40, 'Yoane Wissa', 26, 'Forward', 4, 1, 180, 72, 'Healthy', '', 17),
(41, 'Robert Sanchez', 24, 'Goalkeeper', 5, 1, 197, 87, 'Healthy', '', 35),
(42, 'Lewis Dunk', 30, 'Defense', 5, 4, 192, 87, 'Healthy', '', 20),
(43, 'Adam Lallana', 34, 'Midfield', 5, 4, 173, 67, 'Healthy', '', 2),
(44, 'Leandro Trossard', 27, 'Forward', 5, 27, 172, 60, 'Healthy', '', 33),
(45, 'Adam Webster', 27, 'Defense', 5, 3, 192, 79, 'Healthy', '', 24),
(46, 'Moises Caicedo', 20, 'Midfield', 5, 1, 178, 74, 'Healthy', '', 42),
(47, 'Solly March', 27, 'Forward', 5, 2, 180, 72, 'Healthy', '', 13),
(48, 'Kepa Arrizabalaga', 27, 'Goalkeeper', 6, 27, 189, 87, 'Healthy', '', 17),
(49, 'Kalidou Koulibaly', 31, 'Defense', 6, 16, 195, 88, 'Healthy', '', 39),
(50, 'N\'Golo Kante', 31, 'Midfield', 6, 15, 169, 68, 'Healthy', 'Adidas', 33),
(51, 'Reece James', 22, 'Defence', 6, 13, 172, 63, 'Healthy', '', 77),
(52, 'Raheem Sterling', 27, 'Midfield', 6, 18, 170, 69, 'Healthy', 'New Balance', 77),
(53, 'Kai Havertz', 28, 'Forward', 6, 8, 186, 77, 'Healthy', '', 77),
(54, 'Mason Mount', 23, 'Forward', 6, 4, 175, 63, 'Healthy', '', 83),
(55, 'Vicente Guaita', 35, 'Goalkeeper', 7, 4, 191, 79, 'Healthy', '', 2),
(56, 'Joel Ward', 33, 'Defense', 7, 2, 188, 82, 'Healthy', '', 2),
(57, 'Joachim Anderson', 26, 'Defense', 7, 4, 190, 74, 'Healthy', '', 32),
(58, 'Will Hughes', 27, 'Midfield', 7, 3, 185, 73, 'Healthy', '', 5),
(59, 'James McArthur', 34, 'Midfield', 7, 3, 178, 67, 'Healthy', '', 1),
(60, 'Wilfred Zaha', 29, 'Forward', 7, 7, 180, 66, 'Healthy', '', 32),
(61, 'Odsonne Edouard', 24, 'Forward', 7, 5, 187, 83, 'Healthy', '', 17),
(62, 'Jordan Pickford', 28, 'Goalkeeper', 8, 5, 185, 77, 'Healthy', 'Puma', 28),
(63, 'Yerry Mina', 28, 'Defense', 8, 6, 195, 74, 'Healthy', '', 18),
(64, 'Ben Godfrey', 24, 'Defense', 8, 4, 183, 78, 'Healthy', '', 18),
(65, ' Abdoulaye Doucouré', 29, 'Midfield', 8, 4, 180, 59, 'Healthy', '', 12),
(66, 'Demarai Gray', 26, 'Midfield', 8, 2, 178, 66, 'Healthy', '', 20),
(67, 'Moise Kean', 22, 'Forward', 8, 3, 182, 77, 'Healthy', '', 24),
(68, 'Alex Iwobi', 26, 'Forward', 8, 3, 180, 74, 'Healthy', '', 25),
(69, 'George Wickens', 20, 'Goalkeeper', 9, 1, 185, 73, 'Healthy', '', 1),
(70, 'Layvin Kurzawa', 30, 'Defense', 9, 5, 182, 74, 'Healthy', '', 5),
(71, 'Kenny Tete', 27, 'Defense', 9, 3, 180, 69, 'Healthy', '', 7),
(72, 'Nathaniel Chalobah', 27, 'Midfield', 9, 3, 185, 79, 'Healthy', '', 3),
(73, 'Tom Cairney', 31, 'Midfield', 9, 2, 183, 72, 'Healthy', '', 2),
(74, 'Aleksandar Mitrovic', 28, 'Forward', 9, 3, 189, 83, 'Healthy', '', 28),
(75, 'Daniel James', 24, 'Forward', 9, 3, 179, 78, 'Healthy', '', 16),
(76, 'Illan Meslier', 22, 'Goalkeeper', 11, 1, 193, 73, 'Healthy', '', 22),
(77, 'Robin Koch', 26, 'Defense', 11, 4, 192, 82, 'Healthy', '', 18),
(78, 'Junior Firpo', 26, 'Defense', 11, 2, 184, 78, 'Healthy', '', 12),
(79, 'Adam Forshaw', 31, 'Midfield', 11, 1, 185, 71, 'Healthy', '', 2),
(80, 'Mateusz Klich', 32, 'Midfield', 11, 1, 183, 68, 'Healthy', '', 2),
(81, 'Rodrigo Machado', 31, 'Forward', 11, 3, 180, 73, 'Healthy', '', 9),
(82, 'Patrick Bamford', 29, 'Forward', 11, 2, 188, 71, 'Healthy', '', 12),
(83, 'Alex Smithies', 32, 'Goalkeeper', 10, 2, 185, 83, 'Healthy', '', 1),
(84, 'Jonny Evans', 34, 'Defense', 10, 4, 188, 77, 'Healthy', '', 3),
(85, 'Ricardo Pereira', 29, 'Defense', 10, 4, 175, 69, 'Healthy', '', 12),
(86, 'James Maddison', 25, 'Midfield', 10, 6, 175, 72, 'Healthy', '', 55),
(87, 'Boubakary Soumaré', 23, 'Midfield', 10, 5, 188, 82, 'Healthy', '', 25),
(88, 'Jamie Vardy', 35, 'Forward', 10, 7, 178, 76, 'Healthy', 'Nike', 4),
(89, 'Patson Daka', 24, 'Forward', 10, 3, 180, 71, 'Healthy', '', 20),
(90, 'Alisson', 30, 'Goalkeeper', 12, 8, 193, 91, 'Healthy', '', 50),
(91, 'Virgil Van Dijk', 31, 'Defense', 12, 11, 193, 87, 'Healthy', 'Nike', 50),
(92, 'Trent Alexander-Arnold', 24, 'Defense', 12, 9, 175, 68, 'Healthy', 'Under Armour', 70),
(93, 'Thiago Alcántara', 31, 'Midfield', 12, 10, 172, 59, 'Healthy', 'Tommy Hilfigher', 18),
(94, 'Fabinho', 29, 'Midfield', 12, 9, 188, 78, 'Healthy', '', 55),
(95, 'Mohamed Salah', 30, 'Forward', 12, 18, 175, 71, 'Healthy', 'Adidas', 80),
(96, 'Diogo Jota', 25, 'Forward', 12, 9, 178, 69, 'Healthy', '', 55),
(97, 'Ederson', 29, 'Goalkeeper', 13, 3, 188, 88, 'Healthy', '', 45),
(98, 'John Stones', 28, 'Defense', 13, 13, 188, 69, 'Healthy', '', 30),
(99, 'Manuel Akanji', 27, 'Defense', 13, 9, 187, 84, 'Healthy', '', 30),
(100, 'Kevin De Bruyne', 31, 'Midfield', 13, 20, 181, 69, 'Healthy', 'Nike', 80),
(101, 'Jack Grealish', 27, 'Midfield', 13, 16, 175, 68, 'Healthy', 'Gucci', 70),
(102, 'Erling Haaland', 22, 'Forward', 13, 20, 191, 87, 'Healthy', '', 170),
(103, 'Julian Álvarez', 22, 'Forward', 13, 3, 173, 69, 'Healthy', '', 32),
(104, 'David De Gea', 31, 'Goalkeeper', 14, 20, 192, 76, 'Healthy', 'Adidas', 15),
(105, 'Raphael Varane', 29, 'Defense', 14, 18, 194, 83, 'healthy', 'Puma', 40),
(106, 'Harry Maguire', 29, 'Defense', 14, 10, 188, 78, 'Healthy', 'Puma', 30),
(107, 'Casemiro', 30, 'Midfield', 14, 16, 184, 79, 'Healthy', '', 50),
(108, 'Bruno Fernandes', 28, 'Midfield', 14, 12, 173, 64, 'Healthy', '', 75),
(109, 'Cristiano Ronaldo', 37, 'Forward', 14, 27, 187, 83, 'Healthy', 'Nike', 20),
(110, 'Jadon Sancho', 22, 'Forward', 14, 18, 180, 73, 'Healthy', 'Nike', 60),
(111, 'Karl Darlow', 32, 'Goalkeeper', 15, 1, 190, 88, 'Healthy', '', 2),
(112, 'Kieran Trippier', 32, 'Defense', 15, 8, 173, 71, 'Healthy', '', 13),
(113, 'Fabian Schar', 30, 'Defense', 15, 2, 188, 84, 'Healthy', '', 10),
(114, 'Bruno Guimarães', 24, 'Midfield', 15, 6, 182, 74, 'Healthy', '', 60),
(115, 'Miguel Almiron', 28, 'Midfield', 15, 2, 174, 70, 'Healthy', '', 20),
(116, 'Alexander Isak', 23, 'Forward', 15, 6, 184, 83, 'Healthy', '', 50),
(117, 'Allan Saint-Maximin', 25, 'Forward', 15, 2, 173, 67, 'Healthy', '', 40),
(118, 'Dean Henderson', 25, 'Goalkeeper', 16, 5, 188, 85, 'Healthy', '', 22),
(119, 'Renan Lodi', 24, 'Defense', 16, 3, 173, 68, 'Healthy', '', 20),
(120, 'Steve Cook', 31, 'Defense', 16, 2, 185, 82, 'Healthy', '', 3),
(121, 'Jesse Lingard', 29, 'Midfield', 16, 10, 175, 62, 'Healthy', '', 14),
(122, 'Harry Arter', 32, 'Midfield', 16, 1, 176, 70, 'Healthy', '', 1),
(123, 'Lyle Taylor', 32, 'Forward', 16, 1, 188, 79, 'Healthy', '', 1),
(124, 'Sam Surridge', 24, 'Forward', 16, 1, 188, 79, 'Healthy', '', 4),
(125, 'Alex McCarthy', 32, 'Goalkeeper', 17, 3, 193, 79, 'Healthy', '', 2),
(126, 'Romain Perraud', 25, 'Defense', 17, 2, 173, 68, 'Healthy', '', 2),
(127, 'Mohammed Salisu', 23, 'Defense', 17, 1, 191, 82, 'Healthy', '', 18),
(128, 'Ainsley Maitland-Niles ', 25, 'Midfield', 17, 3, 180, 67, 'Healthy', '', 8),
(129, 'Stuart Armstrong', 30, 'Midfield', 17, 3, 183, 68, 'Healthy', '', 6),
(130, 'Theo Walcott', 33, 'Forward', 17, 4, 176, 69, 'Healthy', '', 2),
(131, 'Mohamed Elyounoussi', 28, 'Forward', 17, 3, 178, 69, 'Healthy', '', 12),
(132, 'Hugo Lloris', 35, 'Goalkeeper', 18, 5, 188, 78, 'Healthy', '', 7),
(133, 'Cristian Romero', 24, 'Defense', 18, 9, 185, 82, 'Healthy', '', 55),
(134, 'Clément Lenglet', 27, 'Defense', 18, 6, 186, 81, 'Healthy', '', 12),
(135, 'Ivan Perisic', 33, 'Midfield', 18, 9, 187, 78, 'Healthy', '', 10),
(136, 'Pierre-Emile Hojbjerg', 27, 'Midfield', 18, 5, 185, 81, 'Healthy', '', 45),
(137, 'Heung-Min Son', 30, 'Forward', 18, 10, 183, 76, 'Healthy', 'Calvin Klein', 70),
(138, 'Harry Kane', 29, 'Forward', 18, 10, 188, 73, 'Healthy', 'Nike', 90),
(139, 'Alphonse Areola', 29, 'Goalkeeper', 19, 6, 192, 87, 'Healthy', '', 8),
(140, 'Kurt Zouma', 28, 'Defense', 19, 6, 190, 92, 'Healthy', 'Adidas', 32),
(141, 'Emerson Palmieri', 28, 'Defense', 19, 5, 176, 63, 'Healthy', '', 12),
(142, 'Lucas Paquetá', 25, 'Midfield', 19, 8, 180, 72, 'Healthy', '', 45),
(143, 'Michail Antonio', 32, 'Midfield', 19, 4, 180, 82, 'Healthy', 'Adidas', 9),
(144, 'Jarrod Bowen', 25, 'Forward', 19, 5, 178, 69, 'Healthy', '', 42),
(145, 'Gianluca Scamacca', 23, 'Forward', 19, 5, 195, 86, 'Healthy', '', 30),
(146, 'José Sá', 29, 'Goalkeeper', 20, 1, 192, 86, 'Healthy', '', 18),
(147, 'Nelson Semedo', 28, 'Defense', 20, 4, 177, 64, 'Healthy', '', 18),
(148, 'Jonny Castro', 28, 'Defense', 20, 2, 175, 69, 'Healthy', '', 17),
(149, 'Daniel Podence', 27, 'Forward', 20, 3, 165, 58, 'Healthy', '', 20),
(150, 'Diego Costa', 34, 'Forward', 20, 3, 188, 81, 'Healthy', '', 4),
(151, 'Joao Moutinho', 36, 'Midfield', 20, 5, 171, 60, 'Healthy', '', 2),
(152, 'Matheus Nunes', 24, 'Midfield', 20, 4, 183, 78, 'Healthy', '', 45);

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
