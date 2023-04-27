-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 10, 2023 at 09:42 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time_stamp` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `action` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `results` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `impact` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `username`, `time_stamp`, `action`, `results`, `data`, `impact`, `ip_address`) VALUES
(123, 'root', '2023-03-14 19:28:00', 'update_ticket', 'success', NULL, 'DJV5081679', '::1'),
(124, 'root', '2023-03-14 19:31:00', 'update_ticket', 'success', NULL, 'DJV5081679', '::1'),
(125, 'root', '2023-03-14 19:33:00', 'update_ticket', 'success', NULL, 'DJV5081679', '::1'),
(126, 'root', '2023-03-14 19:34:00', 'update_ticket', 'success', NULL, 'DJV5081679', '::1'),
(127, 'root', '2023-03-14 19:35:00', 'update_ticket', 'success', NULL, 'DJV5081679', '::1'),
(128, 'root', '2023-03-14 19:43:00', 'update_ticket', 'success', NULL, 'DJV5081679', '::1'),
(129, 'root', '2023-03-14 19:46:00', 'update_ticket', 'success', NULL, 'DJV5081679', '::1'),
(130, 'root', '2023-03-14 19:47:00', 'update_ticket', 'success', NULL, 'DJV5081679', '::1'),
(131, 'root', '2023-03-14 19:53:32', 'login', 'succes', NULL, 'root', '::1'),
(132, 'root', '2023-03-14 20:00:33', 'login', 'succes', NULL, 'root', '::1'),
(133, 'root', '2023-03-15 06:06:15', 'login', 'succes', NULL, 'root', '::1'),
(134, 'root', '2023-03-16 03:18:08', 'login', 'succes', NULL, 'root', '::1'),
(135, 'root', '2023-03-16 13:32:04', 'login', 'succes', NULL, 'root', '::1'),
(136, 'root', '2023-03-16 15:15:16', 'login', 'succes', NULL, 'root', '::1'),
(137, 'root', '2023-03-16 15:15:22', 'login', 'succes', NULL, 'root', '::1'),
(138, 'root', '2023-03-16 15:15:28', 'login', 'succes', NULL, 'root', '::1'),
(139, 'root', '2023-03-16 16:37:00', 'add_ticket', 'success', NULL, 'DJV5798947', '::1'),
(140, 'root', '2023-03-16 16:58:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(141, 'root', '2023-03-16 16:58:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(142, 'root', '2023-03-16 17:00:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(143, 'root', '2023-03-16 17:00:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(144, 'root', '2023-03-16 17:01:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(145, 'root', '2023-03-16 17:01:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(146, 'root', '2023-03-16 17:03:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(147, 'root', '2023-03-16 17:10:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(148, 'root', '2023-03-16 17:11:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(149, 'root', '2023-03-16 17:11:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(150, 'root', '2023-03-16 17:11:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(151, 'root', '2023-03-16 17:12:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(152, 'root', '2023-03-16 17:19:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(153, 'root', '2023-03-16 17:23:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(154, 'root', '2023-03-17 07:01:38', 'add_customer', 'success', NULL, 'A0087647093L', '::1'),
(155, 'root', '2023-03-17 07:06:23', 'edit_customer', 'success', NULL, 'P06746757A', '::1'),
(156, 'root', '2023-03-17 07:14:34', 'add_customer', 'success', NULL, 'A0087587D', '::1'),
(157, 'root', '2023-03-17 09:01:54', 'edit_Device', 'success', NULL, 'KRAMAX2342RTK', '::1'),
(158, 'root', '2023-03-17 09:03:00', 'update_ticket', 'success', NULL, 'DJV5798947', '::1'),
(159, 'root', '2023-03-17 09:06:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(160, 'root', '2023-03-17 09:06:00', 'update_ticket', 'success', NULL, 'DJV6884215', '::1'),
(161, 'root', '2023-03-17 09:20:00', 'edit_Device', 'success', NULL, '', '::1'),
(162, 'root', '2023-03-17 09:30:55', 'edit_Device', 'success', NULL, '', '::1'),
(163, 'root', '2023-03-17 09:31:46', 'edit_Device', 'success', NULL, '', '::1'),
(164, 'root', '2023-03-17 09:32:02', 'edit_Device', 'success', NULL, '', '::1'),
(165, 'root', '2023-03-17 09:32:39', 'edit_Device', 'success', NULL, '', '::1'),
(166, 'root', '2023-03-17 09:37:00', 'edit_Device', 'success', NULL, 'DJV8711849', '::1'),
(167, 'root', '2023-03-20 05:01:46', 'login', 'succes', NULL, 'root', '::1'),
(168, 'root', '2023-03-20 05:04:22', 'edit_Device', 'success', NULL, 'KRAMAX2342RTK', '::1'),
(169, 'root', '2023-03-20 06:31:31', 'login', 'succes', NULL, 'root', '::1'),
(170, 'root', '2023-03-21 08:19:00', 'add_ticket', 'success', NULL, 'DJV1', '::1'),
(171, 'root', '2023-03-21 08:22:00', 'add_ticket', 'success', NULL, 'DJV1', '::1'),
(172, 'root', '2023-03-21 08:26:00', 'add_ticket', 'success', NULL, 'DJV1', '::1'),
(173, 'root', '2023-03-21 08:27:00', 'add_ticket', 'success', NULL, 'DJV1', '::1'),
(174, 'root', '2023-03-21 08:28:00', 'add_ticket', 'success', NULL, 'DJV1', '::1'),
(175, 'root', '2023-03-21 08:30:00', 'add_ticket', 'success', NULL, 'DJV100001', '::1'),
(176, 'root', '2023-03-21 09:09:00', 'add_ticket', 'success', NULL, 'DJV100002', '::1'),
(177, 'root', '2023-03-21 09:09:00', 'update_ticket', 'success', NULL, 'DJV100002', '::1'),
(178, 'root', '2023-03-21 09:12:52', 'edit_Device', 'success', NULL, 'DJV100002', '::1'),
(179, 'root', '2023-03-21 09:43:37', 'edit_Device', 'success', NULL, 'DJV100002', '::1'),
(180, 'root', '2023-03-22 04:28:49', 'login', 'succes', NULL, 'root', '::1'),
(181, 'root', '2023-03-23 07:53:40', 'login', 'succes', NULL, 'root', '::1'),
(182, 'root', '2023-03-23 08:38:00', 'add_ticket', 'success', NULL, 'DJV100003', '::1'),
(183, 'root', '2023-03-23 08:47:00', 'update_ticket', 'success', NULL, 'DJV100003', '::1'),
(184, 'root', '2023-03-23 08:50:53', 'add_customer', 'success', NULL, 'A008787747093L', '::1'),
(185, 'root', '2023-03-24 15:34:22', 'login', 'succes', NULL, 'root', '::1'),
(186, 'root', '2023-03-24 15:36:45', 'edit_Device', 'success', NULL, 'KRAMAX2342RTK', '::1'),
(187, 'root', '2023-03-25 10:17:54', 'login', 'succes', NULL, 'root', '::1'),
(188, 'root', '2023-03-26 21:32:10', 'login', 'succes', NULL, 'root', '::1'),
(189, 'root', '2023-03-27 10:22:39', 'login', 'succes', NULL, 'root', '::1'),
(190, 'root', '2023-03-28 05:36:46', 'login', 'succes', NULL, 'root', '::1'),
(191, 'root', '2023-03-30 10:47:57', 'login', 'succes', NULL, 'root', '::1'),
(192, 'root', '2023-04-03 09:31:06', 'login', 'succes', NULL, 'root', '::1'),
(193, 'root', '2023-04-03 09:45:40', 'login', 'succes', NULL, 'root', '::1'),
(194, 'root', '2023-04-03 09:45:51', 'login', 'succes', NULL, 'root', '::1'),
(195, 'root', '2023-04-03 09:47:45', 'login', 'succes', NULL, 'root', '::1'),
(196, 'root', '2023-04-03 09:54:40', 'login', 'succes', NULL, 'root', '::1'),
(197, 'root', '2023-04-03 10:09:57', 'login', 'succes', NULL, 'root', '::1'),
(198, 'root', '2023-04-04 07:11:25', 'login', 'succes', NULL, 'root', '::1'),
(199, 'root', '2023-04-05 07:34:47', 'login', 'succes', NULL, 'root', '::1'),
(200, 'root', '2023-04-05 07:47:00', 'add_ticket', 'success', NULL, 'DJV100007', '::1'),
(201, 'root', '2023-04-05 08:09:33', 'add_customer', 'success', NULL, 'P0098567H', '::1'),
(202, 'root', '2023-04-05 08:13:07', 'add_customer', 'success', NULL, 'P0098567H', '::1'),
(203, 'root', '2023-04-05 12:19:00', 'add_ticket', 'success', NULL, 'DJV101JB', '::1'),
(204, 'root', '2023-04-05 12:51:00', 'add_ticket', 'success', NULL, 'DJV102JB', '::1'),
(205, 'root', '2023-04-05 13:07:00', 'add_ticket', 'success', NULL, 'DJV104JB', '::1'),
(206, 'root', '2023-04-06 05:54:31', 'login', 'succes', NULL, 'root', '::1'),
(207, 'root', '2023-04-06 15:10:47', 'login', 'succes', NULL, 'root', '::1'),
(208, 'root', '2023-04-06 15:20:19', 'login', 'succes', NULL, 'root', '::1'),
(209, 'root', '2023-04-07 06:18:54', 'login', 'succes', NULL, 'root', '::1'),
(210, 'root', '2023-04-07 06:19:20', 'login', 'failed', NULL, 'root', '::1'),
(211, 'root', '2023-04-08 06:26:41', 'login', 'failed', NULL, 'root', '::1'),
(212, 'root', '2023-04-08 07:28:36', 'login', 'succes', NULL, 'root', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `childincident`
--

CREATE TABLE `childincident` (
  `id` int(11) NOT NULL,
  `tiketNo` varchar(12) NOT NULL,
  `pin` varchar(40) NOT NULL,
  `massage` longtext NOT NULL,
  `comment` longtext NOT NULL,
  `date_c` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` varchar(20) NOT NULL,
  `createdBy` varchar(20) NOT NULL,
  `origin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `childincident`
--

INSERT INTO `childincident` (`id`, `tiketNo`, `pin`, `massage`, `comment`, `date_c`, `category`, `createdBy`, `origin`) VALUES
(1, 'KSR2614465', 'A006987244N', 'wertyuiopoiuytrty', '', '2022-07-15 12:35:01', 'request', 'root', 'kra'),
(2, '', 'n/a', 'hi', 'n/a', '2022-07-16 05:09:16', 'complain', 'root', 'customer'),
(3, 'KT8115651', '', 'who are you', 'n/a', '2022-07-18 09:44:29', 'complain', 'root', 'customer'),
(4, 'KT8115651', '', 'hi', '', '2022-07-18 09:45:12', 'complain', 'root', 'kra'),
(5, 'KT8115651', '', 'hi', '', '2022-07-18 09:45:40', 'complain', 'root', 'kra'),
(6, 'KT8115651', '', 'next', '', '2022-07-18 09:58:11', 'complain', 'root', 'kra'),
(7, 'KT8115651', '', 'next', '', '2022-07-18 10:02:24', 'complain', 'root', 'kra'),
(8, 'KT8115651', '', 'Let us know who you are', '', '2022-07-18 10:41:37', 'complain', 'root', 'kra'),
(9, 'KT8115651', '', 'ghdjfkg', 'n/a', '2022-07-18 11:06:20', 'complain', 'root', 'customer'),
(10, '', '', 'sasa', 'n/a', '2022-07-18 11:11:54', 'complain', 'root', 'customer'),
(11, 'KSR8634547', 'P213425654M', 'yrurururu', '', '2022-07-18 11:23:06', 'enquiry', 'root', 'kra'),
(12, 'KT3306299', '', 'dfghjkl', '', '2022-07-26 14:09:54', 'enquiry', 'root', 'kra');

-- --------------------------------------------------------

--
-- Table structure for table `county`
--

CREATE TABLE `county` (
  `id` int(16) NOT NULL,
  `countyName` varchar(20) NOT NULL,
  `comment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `county`
--

INSERT INTO `county` (`id`, `countyName`, `comment`) VALUES
(1, 'Mombasa', ''),
(2, 'Kwale', ''),
(3, 'Kilifi', ''),
(4, 'Tana River', ''),
(5, 'Lamu', ''),
(6, 'Taita/Taveta', ''),
(7, 'Garissa', ''),
(8, 'Wajir', ''),
(9, 'Mandera', ''),
(10, 'Marsabit', ''),
(11, 'Isiolo', ''),
(12, 'Meru', ''),
(13, 'Tharaka-Nithi', ''),
(14, 'Embu', ''),
(15, 'Kitui', ''),
(16, 'Machakos', ''),
(17, 'Makueni', ''),
(18, 'Nyandarua', ''),
(19, 'Nyeri', ''),
(20, 'Kirinyaga', ''),
(21, 'Muranga', ''),
(22, 'Kiambu', ''),
(23, 'Turkana', ''),
(24, 'West Pokot', ''),
(25, 'Samburu', ''),
(26, 'Trans Nzoia', ''),
(27, 'Uasin Gishu', ''),
(28, 'Elgeyo/Marakwet', ''),
(29, 'Nandi', ''),
(30, 'Baringo', ''),
(31, 'Laikipia', ''),
(32, 'Nakuru', ''),
(33, 'Narok', ''),
(34, 'Kajiado', ''),
(35, 'Kericho', ''),
(36, 'Bomet', ''),
(37, 'Kakamega', ''),
(38, 'Vihiga', ''),
(39, 'Bungoma', ''),
(40, 'Busia', ''),
(41, 'Siaya', ''),
(42, 'Kisumu', ''),
(43, 'Homa Bay', ''),
(44, 'Migori', ''),
(45, 'Kisii', ''),
(46, 'Nyamira', ''),
(47, 'Nairobi City', '');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `dateCreated` datetime(6) DEFAULT NULL,
  `idNumber` varchar(40) DEFAULT NULL,
  `pin` varchar(20) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `cusName` varchar(30) DEFAULT NULL,
  `businessName` varchar(30) DEFAULT NULL,
  `businessAddress` varchar(30) DEFAULT NULL,
  `county` varchar(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `createdBy` varchar(16) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `dateCreated`, `idNumber`, `pin`, `phoneNumber`, `cusName`, `businessName`, `businessAddress`, `county`, `email`, `createdBy`, `status`) VALUES
(1, '2023-03-14 07:24:28.000000', '30673304', 'P006757484A', '0715745434', 'Clinton  Misango', 'Misango', 'Misango', 'Embu', 'cmurilla@gmail.com', '', 0),
(2, '2023-03-14 07:24:28.000000', '34535637', 'P008746646A', '0710387413', 'Johnson Sakaja', 'Mikeri', 'Makori', 'Tharaka-Nithi', 'JohnsonMikeri@gmail.com', '', 0),
(3, '2023-03-14 07:24:28.000000', '30673305', 'P06746757A', '0715745434', 'Cyrus Simako', 'Simako', 'Atwoli', 'Marsabit', 'syrusSimako@outlook.com', '', 0),
(4, '2023-03-14 07:24:28.000000', '6657647', 'P00787363A', '0787766474', 'Mercy Kipchoge', 'Mekips Technologies', 'Kericho Town next to total Pet', 'Kericho', 'francis@kra.go.ke', '', 0),
(7, '2023-03-14 07:24:28.000000', '29018489', 'A009435635V', '254707167103', 'Benson Kamau', 'RiftTech Solution', 'Makadara, Hamza', 'Nyeri', 'bensnjo@gmail.com', 'root ', 0),
(12, '2023-04-05 11:13:07.000000', '37456656', 'P0098567H', '254741217554', 'Kelvin Gitau', 'Presidential Digitalent Progra', 'Makadara, Hamza', 'Marsabit', 'kevogitau@gmail.com', 'root ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`) VALUES
(7, 'Sales & Marketing', 'Sales and Marketing', '2023-03-17 12:51:46'),
(8, 'Finance ', 'Finance', '2023-03-17 12:54:46'),
(9, 'ICT', 'ict', '2023-03-17 12:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `dateCreated` datetime(6) NOT NULL,
  `customerName` varchar(60) NOT NULL,
  `pin` varchar(11) NOT NULL,
  `serialNumber` varchar(16) NOT NULL,
  `deviceKey` varchar(16) NOT NULL,
  `cusID` int(10) NOT NULL,
  `status` varchar(11) NOT NULL,
  `userID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `dateCreated`, `customerName`, `pin`, `serialNumber`, `deviceKey`, `cusID`, `status`, `userID`) VALUES
(9, '2023-03-16 18:56:12.000000', 'Benson Kama', 'A009435635V', 'KRAMAX2342RTK', 'VLHP3419074WBAWP', 7, 'ACTIVE', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `djv_nums`
--

CREATE TABLE `djv_nums` (
  `id` int(11) NOT NULL,
  `ticketNumber` int(11) NOT NULL,
  `jobcardNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `djv_nums`
--

INSERT INTO `djv_nums` (`id`, `ticketNumber`, `jobcardNumber`) VALUES
(1, 100009, 104);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `address` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `reference`, `status`) VALUES
(1, 'Staff', 'staff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `insidence`
--

CREATE TABLE `insidence` (
  `id` int(11) NOT NULL,
  `dateCreated` datetime(6) NOT NULL,
  `ticketNumber` varchar(20) NOT NULL,
  `cusName` varchar(15) DEFAULT NULL,
  `mobileNumber` varchar(20) DEFAULT NULL,
  `businessName` varchar(50) DEFAULT NULL,
  `serialNumber` longtext DEFAULT NULL,
  `source` varchar(29) DEFAULT NULL,
  `dStatus` varchar(10) NOT NULL DEFAULT current_timestamp(),
  `priority` varchar(20) DEFAULT NULL,
  `complain` longtext DEFAULT NULL,
  `createdBy` varchar(50) NOT NULL DEFAULT 'Active',
  `status` varchar(16) NOT NULL,
  `AssignedTo` varchar(20) NOT NULL,
  `resolvedAt` datetime(6) DEFAULT NULL,
  `resolvedby` varchar(20) NOT NULL,
  `ticketComment` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insidence`
--

INSERT INTO `insidence` (`id`, `dateCreated`, `ticketNumber`, `cusName`, `mobileNumber`, `businessName`, `serialNumber`, `source`, `dStatus`, `priority`, `complain`, `createdBy`, `status`, `AssignedTo`, `resolvedAt`, `resolvedby`, `ticketComment`) VALUES
(39, '2023-03-21 12:09:00.000000', 'DJV100002', 'Jamala kamala ', '254707167103', 'Shikweke', 'KRAMAX667342RTK', 'WALK IN', 'BOOKED IN', 'MEDIUM', 'hdggdhdhdh', 'root', 'CLOSED', 'Clinton Murilla', '2023-03-21 12:43:37.000000', 'root', 'gshdgshg'),
(40, '2023-03-23 11:38:00.000000', 'DJV100003', 'James Kagwi', '25476635535', 'Jaki investient', 'KRAMAX4532RTK', 'WALK IN', 'BOOKED IN', 'HIGH', 'device not submitting to KRA', 'root', 'OPEN', 'Caroline', NULL, '', 'qw'),
(41, '2023-03-29 11:03:00.000000', 'DJV100006', 'Benson Kamau', '254707167103', 'RiftTech Solution', 'KRAMAX2342RTK', 'APPLICATION', 'NOT BOOKED', 'HIGH', 'testing', 'Benson Kamau', 'OPEN', '', NULL, '', ''),
(42, '2023-04-05 10:47:00.000000', 'DJV100007', 'Benson Kamau', '254707167103', 'RiftTech Solution', 'KRAMAX2342RTK', 'TELEPHONE', 'BOOKED IN', 'MEDIUM', 'test', 'root', 'OPEN', 'Clinton Murilla', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jobcards`
--

CREATE TABLE `jobcards` (
  `id` int(11) NOT NULL,
  `dateCreated` datetime(6) NOT NULL,
  `jbcrdNum` varchar(11) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `phoneNumber` bigint(11) NOT NULL,
  `serialNumber` varchar(11) NOT NULL,
  `email` varchar(11) NOT NULL,
  `devicename` varchar(11) NOT NULL,
  `charger` int(1) NOT NULL,
  `qty` int(11) NOT NULL,
  `model` varchar(20) NOT NULL,
  `fault` varchar(2000) NOT NULL,
  `work` varchar(2000) NOT NULL,
  `techn` varchar(20) NOT NULL,
  `createdBy` varchar(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobcards`
--

INSERT INTO `jobcards` (`id`, `dateCreated`, `jbcrdNum`, `customer`, `phoneNumber`, `serialNumber`, `email`, `devicename`, `charger`, `qty`, `model`, `fault`, `work`, `techn`, `createdBy`, `status`) VALUES
(3, '2023-04-05 16:07:00.000000', 'DJV104JB', 'Benson Njoroge', 254707167103, 'KRAMAX2342R', 'bensnjo@gma', 'CRV5X', 0, 1, '2003rd', 'test', 'test', 'Benson Kamau', 'root', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mailtable`
--

CREATE TABLE `mailtable` (
  `id` int(11) NOT NULL,
  `msgno` varchar(20) NOT NULL,
  `m_date` varchar(50) NOT NULL,
  `subject` longtext NOT NULL,
  `toAdress` varchar(100) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `fromAdress` varchar(100) NOT NULL,
  `udate` varchar(50) NOT NULL,
  `massage` longtext NOT NULL,
  `attachmentID` longtext NOT NULL,
  `host` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mailtable`
--

INSERT INTO `mailtable` (`id`, `msgno`, `m_date`, `subject`, `toAdress`, `s_name`, `fromAdress`, `udate`, `massage`, `attachmentID`, `host`) VALUES
(3, '   1', 'Sat, 23 Jul 2022 13:37:00 +0300', 'first test', 'kesracare@kra.go.ke', 'Carol Muthoni', 'carolmthn@gmail.com', '1658572620', 'first test\nThis is the first test email\r\n', 'na', 'na'),
(4, '   2', 'Tue, 26 Jul 2022 16:24:45 +0300', 'Test', 'kesracare@kra.go.ke', '', 'Francis.Mwambia@kra.go.ke', '1658841885', 'Test\nThis is the first test email\r\n', 'na', 'na'),
(5, '   3', 'Tue, 26 Jul 2022 16:33:35 +0300', 'Test', 'kesracare@kra.go.ke', 'France Mwambia', 'fm3260@gmail.com', '1658842415', 'Test\nTest\r\n\r\n-- \r\n\r\n\r\n* Francis Mwambia*\r\n', 'na', 'na'),
(6, '   4', 'Tue, 26 Jul 2022 16:30:02 +0300', 'Test', 'kesracare@kra.go.ke', '', 'Francis.Mwambia@kra.go.ke', '1658842202', 'Test\nTest\r\n\r\n-- \r\n\r\n\r\n* Francis Mwambia*\r\n', 'na', 'na'),
(7, '   5', 'Tue, 26 Jul 2022 16:36:25 +0300', 'Re: Test', 'kesracare@kra.go.ke', '', 'Francis.Mwambia@kra.go.ke', '1658842585', 'Re: Test\nTest\r\n\r\n-- \r\n\r\n\r\n* Francis Mwambia*\r\n', 'na', 'na'),
(8, '   6', 'Tue, 26 Jul 2022 17:28:46 +0300', 'Teeeest', 'kesracare@kra.go.ke', 'France Mwambia', 'fm3260@gmail.com', '1658845726', 'Teeeest\nFinal\r\n-- \r\n\r\n\r\n* Francis Mwambia*\r\n', 'na', 'na');

-- --------------------------------------------------------

--
-- Table structure for table `mail_attachment`
--

CREATE TABLE `mail_attachment` (
  `id` int(11) NOT NULL,
  `msgNo` int(10) NOT NULL,
  `url` text NOT NULL,
  `ticketNo` varchar(20) DEFAULT NULL,
  `aName` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mail_attachment`
--

INSERT INTO `mail_attachment` (`id`, `msgNo`, `url`, `ticketNo`, `aName`) VALUES
(9, 41, '/crm/attachment/  41-logo2.jpeg', 'KT3797178', 'amafefe'),
(10, 42, '/crm/attachment/  42-CUCM_Headsets_for_ContactCenter_WP.pdf', 'KT3797178', 'amafefe2'),
(11, 42, '/Applications/XAMPP/xamppfiles/htdocs/crm/attachment/  42-CUCM_Headsets_for_ContactCenter_WP.pdf', 'KT2614569', 'amafee3'),
(12, 2, '/crm/attachment/   2-ecblank.gif', 'KSR8618645', 'ecblank.gif'),
(13, 4, '/crm/attachment/   4-ecblank.gif', 'KSR1575911', 'ecblank.gif'),
(14, 5, '/crm/attachment/   5-ecblank.gif', 'KSR5382747', 'ecblank.gif'),
(15, 5, '/crm/attachment/   5-graycol.gif', 'KSR5382747', 'graycol.gif');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date_c` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `code`, `username`, `date_c`) VALUES
(1, '49281', '11090', '2022-01-27 13:09:06'),
(2, '63260', '11090', '2022-01-27 13:11:15'),
(3, '20505', '13723', '2022-06-13 21:36:02'),
(4, '85770', '13723', '2022-06-13 21:39:05'),
(5, '83234', '13985', '2022-08-18 12:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(11) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`id`, `customer`, `phoneNumber`, `message`, `type`) VALUES
(1, '', '254741217554', 'Dear ,Thank you for believing in us. We appreciate you joining us. We aspire to serve you best. Thank you', 'New_Customer'),
(2, 'Kelvin Gitau', '254741217554', 'Dear Kelvin Gitau,Thank you for believing in us. We appreciate you joining us. We aspire to serve you best. Thank you', 'New_Customer'),
(3, 'Benson Kamau', '254707167103', 'Dear Benson Kamau, a Job Card with Number. DJV101JB has been created. We will keep you updated on the progres of the job card. Thank you', 'JobCard'),
(4, 'Benson Kamau', '254707167103', 'Dear Benson Kamau, a Job Card with Number. DJV102JB has been created. We will keep you updated on the progres of the job card. Thank you', 'JobCard'),
(5, 'Benson Njoroge Kamau', '254707167103', 'Dear Benson Njoroge Kamau, a Job Card with number. DJV104JB has been created. We will keep you updated on the progres of the job card. Thank you', 'JobCard');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `teamName` varchar(30) NOT NULL,
  `discription` mediumtext NOT NULL,
  `date_c` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `teamName`, `discription`, `date_c`) VALUES
(7, 'Etims Team', 'Etims', NULL),
(8, 'Field Team', 'Field Team', NULL),
(9, 'Technical Support', 'ts', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams_assignment`
--

CREATE TABLE `teams_assignment` (
  `id` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `team` varchar(20) NOT NULL,
  `date_c` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `full_names` varchar(100) NOT NULL,
  `mobile_phone` varchar(20) NOT NULL,
  `email_addr` varchar(100) NOT NULL,
  `roles` varchar(50) DEFAULT NULL,
  `department` varchar(40) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'NEW',
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(20) NOT NULL,
  `grade` int(3) NOT NULL,
  `team` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_names`, `mobile_phone`, `email_addr`, `roles`, `department`, `status`, `date_created`, `created_by`, `grade`, `team`) VALUES
(10, 'root', 'c6285f69b6765a5cdd3b09556d84c5be', 'Admin', '0710387413', 'caroline.wangari@kra.go.ke', 'admin', 'ICT', 'Active', NULL, '', 5, 'ICT'),
(15, '13985', '42fe00f5257d8a559818715a6e60874b', 'Caroline', '087646466464', 'carolmthn@gmail.com', 'user', 'admin', 'New', '2022-07-15 13:06:48', 'Admin', 4, 'finance'),
(16, '13722', '9b4aa818294a818d2f27cf9657b1f0e1', 'Clinton Murilla', '0715745434', 'cmurilla@gmail.com', 'Admin', 'exams', 'Active', '2022-08-18 12:23:31', 'Admin', 3, 'dtd'),
(17, '123344', '836109a2109737ce4a52e32dc59e4320', 'Benson Kamau', '254707167103', 'bensnjo@gmail.com', 'user', 'Sales & Marketing', 'Active', '2023-03-17 12:30:54', 'Admin', 3, 'Etims Team'),
(18, 'DJV0027', '46ddee41dd19aaa3a6df0bc93e317ad8', 'Benson Kamau', '254707167103', 'bensnjok@gmail.com', 'user', 'ICT', 'New', '2023-03-17 16:28:05', 'admin', 3, 'Etims Team');

-- --------------------------------------------------------

--
-- Table structure for table `vars`
--

CREATE TABLE `vars` (
  `id` int(11) NOT NULL,
  `varNames` varchar(38) DEFAULT NULL,
  `krapin` varchar(11) DEFAULT NULL,
  `location` varchar(8) DEFAULT NULL,
  `phoneNumber` varchar(13) DEFAULT NULL,
  `accountRep` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vars`
--

INSERT INTO `vars` (`id`, `varNames`, `krapin`, `location`, `phoneNumber`, `accountRep`) VALUES
(2, 'SPIDEX SYSTEMS LTD', 'P051890082L', 'NAIROBI', '0715082817', 'IVY'),
(3, 'DEEJOH TRADING COMPANY', 'P051231688C', 'NAIROBI', '0722899646', 'IVY'),
(4, 'DELTIC SOLUTIONS LTD', 'P051906029L', 'NAIROBI', '0720342554', 'IVY'),
(5, 'RENOTECH SYSTEMS', 'P051950248H', 'NAIROBI', '0721555001', 'IVY'),
(6, 'WAYLINCS TECHNOLOGIES', 'A006311686R', 'NAIROBI', '0721107590', 'IVY'),
(7, 'KANJICOM ENTERPRISE', 'A005073545L', 'ELDORET', '0720689935', 'IVY'),
(8, 'TIMCAGE ENTERPRISES', 'P051370570Y', 'MOMBASA', '0721436766', 'IVY'),
(9, 'OFFICE PLUS LTD', 'P051417833G', 'MOMBASA', '0725732483', 'IVY'),
(10, 'HAMITECH BUSINESS SOLUTIONS', 'A004867121Z', 'MOMBASA', '0717509044', 'IVY'),
(11, 'ANCHOR DOCUMENTS', 'A003074843M', 'MOMBASA', '0721289450', 'IVY'),
(12, 'DRAFTSOFT TECHNOLOGIES', 'P051444129Y', 'MOMBASA', '0721338127', 'IVY'),
(13, 'TOWI LIMITED', 'P05212576E', 'MOMBASA', '0725824760', 'IVY'),
(14, 'SONIQUE TECH ENTERPRISES', 'A008160625D', 'mombasa', '0727523986', 'IVY'),
(15, 'DEOMAR CONSULTING LTD', 'P051905081P', 'LODWAR', '0726130784', 'ivy'),
(16, 'KENTOO COMPUTERS COMPANY LIMITED', 'P051429830I', 'ELDORET', '0721816797', 'ivy'),
(17, 'MOZAT TECHNOLOGIES', 'P051726127I', 'NAIROBI', '0720413708', 'ivy'),
(18, 'LUM ELECTRONICS LTD', 'P051707406G', 'MOMBASA', '0725103680', 'ivy'),
(19, 'CIT TECHNO LTD', 'P051987923Y', 'MOMBASA', '0713113020', 'ivy'),
(20, 'DATALYNCS SYSTEMS [E.A] LIMITED', 'P051511628U', 'NAIROBI', '0720945368', 'IVY'),
(21, 'FAREX TECHNOLOGIES LTD', 'P051766230I', 'NAIROBI', '0724636510', 'IVY'),
(22, 'BOCART HOLDINGS LIMITED', 'P051715361L', '', '0722883703', 'IVY'),
(23, 'HYTECH TECHNOLOGIES SERVICES', 'P051677113E', 'MOMBASA', '0726 526668', 'IVY'),
(24, 'TYNE TECH ENTERPRISES LIMITED', 'P052001860M', 'MOMBASA', '0723 453062', 'IVY'),
(25, 'CRITICAL PATH BUSINESS SOLUTION', 'A001122810Z', 'MOMBASA', '0727477097', 'IVY'),
(26, 'HANNES TRADING COMPANY LTD', 'P052047164E', 'NAIROBI', '0712076720', 'IVY'),
(27, 'WAYMAN SERVICES', 'P052111614V', 'NAIROBI', '0722164169', 'IVY'),
(28, 'AUTHENTIC BUSINESS SOLUTIONS LTD', 'P051456942K', 'NAIROBI', '0705555052', 'IVY'),
(29, 'POINT OF GRACE INVESTMENTS LIMITED', 'P051549786F', 'NAIROBI', '0713 631932', 'IVY'),
(30, 'VIC& RAY SOLUTIONS', 'A003206952T', 'KAJIADO', '0725018838', 'IVY'),
(31, 'NJOKA MUKAMI & COMPANY', 'A006069303N', 'KIAMBU', '0727817858', 'MAXI'),
(32, 'CRISTORE SYSTEMS SOLUTIONS LTD', 'P051790661K', 'NAIROBI', '0704832040', 'MAXI'),
(33, 'MNC CONSULTING GROUP', 'P051633432Z', 'NAIROBI', '0720502505', 'MAXI'),
(34, 'PRIMESOFT SOLUTIONS', 'P051331309K', 'NAKURU', '0722824466', 'MAXI'),
(35, 'AGOG DIGITAL NAKURU', 'A001780051N', 'NAKURU', '0720943632', 'MAXI'),
(36, 'MZULIA INTERNATIONAL LTD', 'PO51958082B', 'NAIROBI', '0721892384', 'MAXI'),
(37, 'LABELLS TECHNOLOGIES LTD', 'P051419478V', 'NAIROBI', '0720490620', 'MAXI'),
(38, 'PURE TECHNOLOGY SOLUTIONS', 'A004460271M', 'ELDORET', '0724569788', 'MAXI'),
(39, 'ALCOA BUSINESS SOLUTIONS', 'P051188438H', 'NAIROBI', '0720853459', 'MAXI'),
(40, 'THE CONSULTING GROUP LTD', 'P051389874A', 'NAIROBI', '0722707204', 'MAXI'),
(41, 'VITALIF SOLUTIONS LTD', 'P052091066T', 'NAIROBI', '0702122146', 'MAXI'),
(42, 'RICCO TECH EAST AFRICA LTD', 'P051558973B', 'NAIROBI', '0721857334', 'MAXI'),
(43, 'PATEL BUSINESS & CONSULTANTS LTD', 'P051661003M', 'NAIROBI', '0720740596', 'MAXI'),
(44, 'STERGIPET ENTERPRISES', 'P051597931R', 'NAIROBI', '0725 859034', 'MAXI'),
(45, 'MAXINAD SOLUTIONS', 'P051777989N', 'NAIROBI', '0721517084', 'MAXI'),
(46, 'LANTRONICS SOLUTION AFRICA LTD', 'P051621365B', 'NAIROBI', '0720412833', 'MAXI'),
(47, 'BITITEC SYSTEMS & SUPPLIERS LIMITED', 'P051183153T', '', '0702424949', 'MAXI'),
(48, 'SCOTECH SOLUTIONS LTD', 'P052100167M', 'NAIROBI', '0715047518', 'MAXI'),
(49, 'QUAD SYSTEMS', 'P051147061Y', 'NAIROBI', '0720932377', 'MAXI'),
(50, 'FGEE COMPUTERS LTD', 'P051447824I', 'NAIROBI', '0728154156', 'MAXI'),
(51, 'FOCUS OFFICE & BUS AUTOMATION', 'A002549771L', 'NAIROBI', '0725964632', 'MAXI'),
(52, 'HORIZONSHUB TECHNOLOGIES', 'P051929803R', 'NAIROBI', '0721249579', 'MAXI'),
(53, 'JARINA INVESTMENTS', 'A003478114P', 'NAIROBI', '0723821914', 'MAXI'),
(54, 'CHILLTON SOLUTIONS LTD', 'P051586945V', 'NAIROBI', '0728038777', 'MAXI'),
(55, 'SWIFTTAX LIMITED', 'P052109117R', 'NAIROBI', '0792681781', 'MAXI'),
(56, 'EAGLELINCS ENTERPRISES LTD', 'P051647345Z', 'NAIROBI', '0722917963', 'MAXI'),
(57, 'NJETS GENEERAL SUPPLIES', 'A009111698R', 'NAIROBI', '0714759941', 'MAXI'),
(58, 'JENNERICK NETWORKS LTD', 'P051662687T', 'NAIROBI', '0721277713', 'MAXI'),
(59, 'ZING TECHNOLOGIES LTD', 'P052126001H', 'RUIRU', '0713003419', 'MAXI'),
(60, 'VINCE SOLUTIONS & INVESTMENTS LTD', 'P051710912R', 'KISUMU', '0720385044', 'MAXI'),
(61, 'STERGIPET QUALITY PRODUCTS LIMITED', 'P051791692Q', 'NAIROBI', '0711116664', 'MAXI'),
(62, 'AGENTBIZ INVESTMENT LTD', 'P052077586R', 'NAIROBI', '0743 339929.', 'MAXI'),
(63, 'FISCAL DEVICES & ANALYTICS', 'P051874557V', 'NAIROBI', '0716499233', 'MWANGI'),
(64, 'SARJAN SERVICES', 'P051217460D', 'NAIROBI', '0722864708', 'MWANGI'),
(65, 'FISCOM SOLUTIONS LTD', 'P051994710H', 'NAIROBI', '0732889988', 'MWANGI'),
(66, 'SMART FISCAL SOLUTIONS LTD', 'P051638130G', 'NAIROBI', '0724264006', 'MWANGI'),
(67, 'BOOKER COMMUNICATIONS LTD', 'P052028876P', 'NAIROBI', '0722731990', 'MWANGI'),
(68, 'DAMITECH IT SOLUTIONS LTD', 'P051238105V', 'NAIROBI', '0723292723', 'MWANGI'),
(69, 'FORTUNE INFORMATION SYSTEMS', 'P051991544J', 'NAIROBI', '0701356298', 'MWANGI'),
(70, 'BOOSTER BUSINESS SOLUTIONS', 'P051755936S', 'NAIROBI', '0723098452', 'MWANGI'),
(71, 'SOFTBYTE TECHNOLOGIES LTD', 'P051765993E', 'NAIROBI', '0721574027', 'MWANGI'),
(72, 'FAREX SAHARA TECHNOLOGIES LTD', 'P051602051V', '', '0713185561', 'MWANGI'),
(73, 'VINIS TECHNOLOGIES', 'A003891237T', 'NAIROBI', '0724293830', 'MWANGI'),
(74, 'JOPAMA TECH SOLUTIONS LIMITED', 'P051852883U', 'NAIROBI', '0780753557', 'MWANGI'),
(75, 'ECOX TECHNOLOGIES', 'P051999624B', 'NAIROBI', '0704255109', 'MWANGI'),
(76, 'FIXPOS TECHNOLOGIES LTD', 'P052072685F', 'NAIROBI', '0701880136', 'MWANGI'),
(77, 'PLANVA SYSTEMS', 'P051977246X', 'NAIROBI', '0714983588', 'MWANGI'),
(78, 'WISEPOWER FISCAL SOLUTIONS LTD', 'P051913958U', 'NAKURU', '0723323620', 'MWANGI'),
(79, 'NAKURU COMPUTER RESOURCES', 'P051147228X', 'NAKURU', '736800656', 'MWANGI'),
(80, 'PHTORRENTS TECHNOLOGIES LTD', 'P051654804D', 'NAIROBI', '0720499767', 'MWANGI'),
(81, 'SCOTTECH LIMITED', 'P051447635J', 'NAIROBI', '0723833187', 'MWANGI'),
(82, 'AJURIFO INVESTMENTS LIMITED', 'P051837426P', 'NAIROBI', '0710725121', 'MWANGI'),
(83, 'RYCATECH SOLUTIONS', 'P052027766K', 'NAIROBI', '0780203956', 'MWANGI'),
(84, 'TECHPUT SOLUTIONS LIMITED', 'P052103888E', 'NAIROBI', '0715380655', 'MWANGI'),
(85, 'JTECH ENTERPRISES LTD', 'P052118622V', 'NAIROBI', '0721491797', 'MWANGI'),
(86, 'DUKATECH STORES LIMITED', 'P051709171S', 'NAIROBI', '0718566612', 'MWANGI'),
(87, 'HORIZON TECHNOLOGY', 'A003042856M', 'ISIOLO', '0723956718', 'MWANGI'),
(88, 'CHANDLER SYSTEMS AND SOLUTIONS LIMITED', 'P051667238Q', 'NAIROBI', '0720542581', 'MWANGI'),
(89, 'HOOK SOLUTIONS LIMITED', 'P051908247', 'NAIROBI', '0725584658', 'MWANGI'),
(90, 'EASYLINK TECHNOLOGY LTD', 'P052135224P', 'ELDORET', '0720862587', 'MWANGI'),
(91, 'BRIGHT TECHNOLOGIES', 'P051190800G', 'NAIROBI', '0715380655', 'MWANGI'),
(92, 'MAFRAQ ENTERPRISES', 'P051518301Z', 'NAIROBI', '0733543716', 'MWANGI'),
(93, 'FALCON HIGHTECH LTD', 'P052120225', 'NAIROBI', '0727697664', 'MWANGI'),
(94, 'PECKERWOODS LIMITED', 'P051189603A', 'NAIROBI', '0723 716141', 'MWANGI'),
(95, 'TAITANICOM SYSTEMS ENTERPRISES LIMITED', 'P051856401G', 'NAIROBI', '0720035553', 'MWANGI'),
(96, 'BRESAM GENERAL SUPPLIERS', 'A001186542M', 'NAIROBI', '0722 465 342', 'MWANGI'),
(99, 'UNITOP PRODUCTS LIMITED', 'P051385202U', 'THIKA', '0722333066', ''),
(101, 'MECONNECT GROUP LIMITED', 'P051574197T', 'THIKA', '0721341395', 'CAROL'),
(102, 'ORIENT EXPRESS SERVICES LIMITED', 'P051115044Z', 'NAIROBI', '0793040854', ''),
(103, 'SMARTPOS TECHNICS LIMITED', 'P052080933R', '', '', ''),
(105, 'MATRIX TELEMATICS LIMITED', 'P051391409R', 'NAIROBI', '0727 985 649', ''),
(106, 'HENIMO SOLUTIONS LIMITED', 'P051855031G', 'MOMBASA', '0724 483036', 'IVY'),
(107, 'SMART WORKS TRADING COMPANY LIMITED', 'P051347104V', 'NAIROBI', '0771197749', ''),
(108, 'CARL & KYLE SOLUTIONS LTD', 'P051836405I', 'NAIROBI', '0727341653', ''),
(109, 'DEJAVU COMMUNICATIONS LTD', 'P052028979T', 'NAIROBI', '0791618593', ''),
(110, 'RIKKO IDEAL TECHNOLOGIES LTD', 'P051874598E', 'NAIROBI', '0714933225', ''),
(111, 'PLANNETTECH INVESTORS LIMITED', 'P051671666K', 'NAIROBI', '0722 172 143 ', ''),
(112, 'FOCUS OFFICE & BUSINESS AUTOMATION', 'A002549771L', 'NYERI', '0725964632', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `childincident`
--
ALTER TABLE `childincident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `county`
--
ALTER TABLE `county`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cusID` (`cusID`);

--
-- Indexes for table `djv_nums`
--
ALTER TABLE `djv_nums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insidence`
--
ALTER TABLE `insidence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobcards`
--
ALTER TABLE `jobcards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailtable`
--
ALTER TABLE `mailtable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_attachment`
--
ALTER TABLE `mail_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams_assignment`
--
ALTER TABLE `teams_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vars`
--
ALTER TABLE `vars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `childincident`
--
ALTER TABLE `childincident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `county`
--
ALTER TABLE `county`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `djv_nums`
--
ALTER TABLE `djv_nums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `insidence`
--
ALTER TABLE `insidence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `jobcards`
--
ALTER TABLE `jobcards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mailtable`
--
ALTER TABLE `mailtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mail_attachment`
--
ALTER TABLE `mail_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teams_assignment`
--
ALTER TABLE `teams_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `vars`
--
ALTER TABLE `vars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_ibfk_1` FOREIGN KEY (`cusID`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
