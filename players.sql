-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2023 at 12:32 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipl`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `jersey_no` int NOT NULL,
  `isPlayingXi` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0' COMMENT '0:not in playing XI,\r\n1:selected in playing XI',
  `score` int DEFAULT '0',
  `isDeleted` char(1) NOT NULL DEFAULT '0' COMMENT '0:Not deleted,\r\n1: Deleted',
  `addedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `type`, `jersey_no`, `isPlayingXi`, `score`, `isDeleted`, `addedDate`) VALUES
(1, 'Virat Kohli', 'Batsman', 18, '1', 100, '0', '2023-05-26 16:03:49'),
(2, 'Devdatta padikkal', 'Batsman', 5, '1', 34, '0', '2023-05-26 16:03:49'),
(3, 'Yjuwendra chahal', 'Bowler', 45, '1', 4, '0', '2023-05-26 16:03:49'),
(4, 'sahil kalia', 'Batsman', 56, '0', 9, '1', '2023-05-26 16:03:49'),
(9, 'shane watson', 'Batsman', 86, '0', 34, '0', '2023-05-26 16:03:49'),
(10, 'Dinesh kartik', 'All rounder', 44, '0', 23, '0', '2023-05-26 16:03:49'),
(16, 'Mohammad siraj', 'Bowler', 22, '1', 88, '0', '2023-05-26 16:21:14'),
(17, 'New player', 'Batsman', 45, '1', 12, '0', '2023-05-26 16:44:40'),
(19, 'Ajeet', 'Batsman', 3, '1', 80, '0', '2023-05-26 17:56:09'),
(28, 'Laxman tharu', 'Batsman', 5, '0', 9, '0', '2023-05-26 18:40:44'),
(29, 'Harsal patel', 'All rounder', 56, '1', 1, '0', '2023-05-27 19:57:16'),
(30, 'new test 1', 'Batsman', 56, '0', 0, '1', '2023-05-27 19:57:30'),
(31, 'New', 'Batsman', 4, '1', 0, '0', '2023-05-27 20:56:16');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
