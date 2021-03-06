-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 26, 2021 at 03:59 PM
-- Server version: 10.3.31-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yalago_new_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 5),
(1, 8),
(1, 16),
(1, 26),
(1, 49),
(2, 1),
(2, 5),
(2, 8),
(2, 16),
(2, 26),
(2, 49),
(3, 1),
(3, 5),
(3, 8),
(3, 26),
(3, 36),
(3, 37),
(3, 49),
(5, 1),
(5, 5),
(5, 8),
(5, 16),
(5, 26),
(5, 31),
(5, 32),
(5, 34),
(5, 36),
(5, 37),
(5, 38),
(5, 40),
(5, 41),
(5, 49),
(6, 1),
(6, 5),
(6, 8),
(6, 14),
(6, 16),
(6, 31),
(6, 32),
(6, 34),
(6, 36),
(6, 37),
(6, 38),
(6, 40),
(6, 41),
(6, 49),
(7, 1),
(7, 5),
(7, 8),
(7, 14),
(7, 16),
(7, 31),
(7, 34),
(7, 36),
(7, 37),
(7, 38),
(7, 40),
(7, 41),
(7, 49),
(8, 1),
(8, 5),
(8, 8),
(8, 14),
(8, 16),
(8, 31),
(8, 34),
(8, 36),
(8, 37),
(8, 38),
(8, 40),
(8, 41),
(8, 49),
(9, 1),
(9, 5),
(9, 8),
(9, 14),
(9, 16),
(9, 26),
(9, 31),
(9, 34),
(9, 36),
(9, 37),
(9, 38),
(9, 40),
(9, 41),
(9, 49),
(10, 1),
(10, 5),
(10, 8),
(10, 14),
(10, 16),
(10, 26),
(10, 31),
(10, 34),
(10, 36),
(10, 37),
(10, 38),
(10, 40),
(10, 41),
(10, 49),
(11, 1),
(11, 5),
(11, 8),
(11, 14),
(11, 16),
(11, 31),
(11, 34),
(11, 36),
(11, 37),
(11, 38),
(11, 40),
(11, 41),
(11, 49),
(12, 1),
(12, 5),
(12, 8),
(12, 14),
(12, 16),
(12, 26),
(12, 31),
(12, 34),
(12, 36),
(12, 37),
(12, 38),
(12, 40),
(12, 41),
(12, 49),
(13, 1),
(13, 5),
(13, 8),
(13, 14),
(13, 16),
(13, 17),
(13, 26),
(13, 29),
(13, 31),
(13, 34),
(13, 36),
(13, 37),
(13, 38),
(13, 40),
(13, 41),
(13, 49),
(14, 1),
(14, 5),
(14, 8),
(14, 14),
(14, 16),
(14, 17),
(14, 26),
(14, 29),
(14, 31),
(14, 34),
(14, 36),
(14, 37),
(14, 38),
(14, 40),
(14, 41),
(14, 49),
(15, 1),
(15, 14),
(15, 41),
(16, 1),
(16, 14),
(16, 41),
(17, 1),
(17, 5),
(17, 14),
(17, 36),
(17, 38),
(18, 1),
(18, 5),
(18, 14),
(18, 36),
(18, 38),
(19, 1),
(19, 5),
(19, 14),
(19, 36),
(19, 37),
(20, 1),
(20, 5),
(20, 14),
(20, 36),
(20, 37),
(21, 1),
(21, 5),
(21, 14),
(21, 16),
(21, 31),
(21, 34),
(21, 36),
(21, 37),
(21, 38),
(21, 40),
(21, 41),
(22, 1),
(22, 5),
(22, 14),
(22, 16),
(22, 26),
(22, 31),
(22, 34),
(22, 36),
(22, 37),
(22, 38),
(22, 40),
(22, 41),
(22, 49),
(23, 1),
(23, 5),
(23, 14),
(23, 16),
(23, 26),
(23, 31),
(23, 34),
(23, 36),
(23, 37),
(23, 38),
(23, 40),
(23, 41),
(23, 49),
(24, 1),
(24, 5),
(24, 14),
(24, 16),
(24, 26),
(24, 27),
(24, 31),
(24, 34),
(24, 36),
(24, 37),
(24, 38),
(24, 40),
(24, 41),
(24, 49),
(24, 51),
(24, 52),
(25, 1),
(25, 5),
(25, 14),
(25, 16),
(25, 26),
(25, 27),
(25, 31),
(25, 34),
(25, 36),
(25, 37),
(25, 38),
(25, 40),
(25, 41),
(25, 49),
(25, 51),
(25, 52),
(26, 1),
(26, 5),
(26, 14),
(26, 16),
(26, 26),
(26, 27),
(26, 31),
(26, 34),
(26, 36),
(26, 37),
(26, 38),
(26, 40),
(26, 41),
(26, 49),
(26, 51),
(26, 52),
(27, 1),
(27, 5),
(27, 14),
(27, 16),
(27, 26),
(27, 27),
(27, 31),
(27, 34),
(27, 36),
(27, 37),
(27, 38),
(27, 40),
(27, 41),
(27, 49),
(27, 51),
(27, 52),
(28, 1),
(28, 5),
(28, 14),
(28, 16),
(28, 26),
(28, 31),
(28, 34),
(28, 36),
(28, 37),
(28, 38),
(28, 40),
(28, 41),
(28, 49),
(29, 1),
(29, 3),
(29, 5),
(29, 14),
(29, 16),
(29, 26),
(29, 31),
(29, 34),
(29, 36),
(29, 37),
(29, 38),
(29, 41),
(29, 48),
(29, 49),
(30, 1),
(30, 5),
(30, 14),
(30, 16),
(30, 26),
(30, 49),
(31, 1),
(31, 5),
(31, 16),
(31, 26),
(31, 36),
(31, 37),
(31, 49),
(32, 1),
(32, 5),
(32, 16),
(32, 26),
(32, 49),
(33, 1),
(33, 5),
(33, 16),
(33, 36),
(33, 40),
(33, 49),
(34, 1),
(34, 5),
(34, 16),
(34, 36),
(34, 40),
(34, 49),
(36, 1),
(36, 5),
(36, 14),
(36, 16),
(36, 26),
(36, 31),
(36, 34),
(36, 36),
(36, 37),
(36, 38),
(36, 40),
(36, 41),
(36, 49),
(37, 1),
(37, 5),
(37, 14),
(37, 16),
(37, 31),
(37, 34),
(37, 36),
(37, 37),
(37, 38),
(37, 40),
(37, 41),
(38, 1),
(38, 5),
(38, 14),
(38, 16),
(38, 31),
(38, 34),
(38, 36),
(38, 37),
(38, 38),
(38, 40),
(38, 41),
(39, 1),
(39, 5),
(39, 14),
(39, 16),
(39, 31),
(39, 34),
(39, 36),
(39, 37),
(39, 38),
(39, 40),
(39, 41),
(40, 1),
(40, 5),
(40, 14),
(40, 16),
(40, 31),
(40, 34),
(40, 36),
(40, 37),
(40, 38),
(40, 40),
(40, 41),
(41, 1),
(41, 5),
(41, 14),
(41, 16),
(41, 31),
(41, 34),
(41, 36),
(41, 37),
(41, 38),
(41, 40),
(41, 41),
(42, 1),
(42, 5),
(42, 14),
(42, 16),
(42, 31),
(42, 34),
(42, 36),
(42, 37),
(42, 38),
(42, 40),
(42, 41),
(43, 1),
(43, 5),
(43, 14),
(43, 16),
(43, 26),
(43, 31),
(43, 34),
(43, 36),
(43, 37),
(43, 38),
(43, 40),
(43, 41),
(44, 1),
(44, 5),
(44, 14),
(44, 16),
(44, 31),
(44, 34),
(44, 36),
(44, 37),
(44, 38),
(44, 40),
(44, 41),
(45, 1),
(45, 5),
(45, 14),
(45, 16),
(45, 31),
(45, 34),
(45, 36),
(45, 37),
(45, 38),
(45, 40),
(45, 41),
(46, 1),
(46, 5),
(46, 14),
(46, 16),
(46, 31),
(46, 34),
(46, 36),
(46, 37),
(46, 38),
(46, 40),
(46, 41),
(47, 1),
(47, 5),
(47, 14),
(47, 16),
(47, 31),
(47, 34),
(47, 37),
(47, 38),
(47, 40),
(47, 41),
(60, 1),
(60, 5),
(60, 14),
(60, 16),
(60, 31),
(60, 34),
(60, 36),
(60, 37),
(60, 38),
(60, 40),
(60, 41),
(61, 1),
(61, 5),
(61, 14),
(61, 16),
(61, 31),
(61, 34),
(61, 36),
(61, 37),
(61, 38),
(61, 40),
(61, 41),
(62, 1),
(62, 5),
(62, 16),
(62, 26),
(62, 31),
(62, 34),
(62, 36),
(62, 37),
(62, 38),
(62, 40),
(62, 41),
(63, 1),
(63, 5),
(63, 16),
(63, 26),
(63, 31),
(63, 34),
(63, 36),
(63, 37),
(63, 38),
(63, 40),
(63, 41),
(64, 1),
(64, 5),
(64, 16),
(64, 26),
(64, 31),
(64, 34),
(64, 36),
(64, 37),
(64, 38),
(64, 40),
(64, 41),
(65, 1),
(65, 5),
(65, 16),
(65, 26),
(65, 31),
(65, 34),
(65, 36),
(65, 37),
(65, 38),
(65, 40),
(65, 41),
(66, 1),
(66, 5),
(66, 16),
(66, 26),
(66, 34),
(66, 36),
(66, 37),
(66, 40),
(66, 41),
(67, 1),
(67, 5),
(67, 16),
(67, 26),
(67, 34),
(67, 36),
(67, 37),
(67, 40),
(67, 41),
(68, 1),
(68, 5),
(68, 16),
(68, 26),
(68, 34),
(68, 36),
(68, 37),
(68, 40),
(68, 41),
(69, 1),
(69, 5),
(69, 16),
(69, 26),
(69, 34),
(69, 36),
(69, 37),
(69, 40),
(69, 41),
(70, 1),
(70, 5),
(70, 16),
(70, 26),
(70, 34),
(70, 36),
(70, 37),
(70, 40),
(70, 41),
(71, 1),
(71, 5),
(71, 16),
(71, 26),
(71, 34),
(71, 36),
(71, 37),
(71, 40),
(71, 41),
(72, 1),
(72, 5),
(72, 16),
(72, 34),
(72, 37),
(72, 40),
(72, 41),
(73, 1),
(73, 3),
(73, 5),
(73, 16),
(73, 39),
(73, 43),
(73, 45),
(74, 1),
(74, 3),
(74, 5),
(74, 16),
(74, 46),
(75, 1),
(75, 5),
(75, 46),
(76, 1),
(76, 5),
(76, 16),
(77, 1),
(77, 5),
(77, 16),
(78, 1),
(78, 5),
(78, 16),
(79, 1),
(79, 5),
(79, 16),
(80, 1),
(80, 5),
(81, 1),
(81, 5),
(81, 16),
(82, 1),
(82, 5),
(82, 16),
(83, 1),
(83, 5),
(83, 16),
(84, 1),
(84, 5),
(84, 16),
(85, 1),
(85, 5),
(85, 16),
(86, 1),
(86, 5),
(86, 16),
(87, 1),
(87, 5),
(87, 16),
(88, 1),
(88, 5),
(88, 16),
(89, 1),
(89, 5),
(89, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
