-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 08, 2024 at 05:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alpha`
--

-- --------------------------------------------------------

--
-- Table structure for table `_PDAdmin`
--

CREATE TABLE `_PDAdmin` (
  `id` int(11) NOT NULL,
  `tstamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_PDAdmin`
--

INSERT INTO `_PDAdmin` (`id`, `tstamp`, `name`, `email`, `password`, `type`, `picture`) VALUES
(1, '2024-08-07 16:16:23', 'tanko yau', 'tanko@yau.com', '654321', 'MANAGER', '01.jpg'),
(2, '2024-08-05 14:48:32', 'SB DEV', 'sbdev@sb.com', '987654321', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `_PDUsers`
--

CREATE TABLE `_PDUsers` (
  `id` int(11) NOT NULL,
  `tstamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `full_name` varchar(255) NOT NULL,
  `yod` varchar(255) NOT NULL,
  `full_name_b` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `lga` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `op_number` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `benefit_type` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `reg_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_PDUsers`
--

INSERT INTO `_PDUsers` (`id`, `tstamp`, `full_name`, `yod`, `full_name_b`, `dob`, `gender`, `lga`, `ward`, `address`, `op_number`, `phone`, `email`, `id_number`, `benefit_type`, `photo`, `reg_by`) VALUES
(1, '2024-08-08 11:15:49', 'Jaafar Muhammad', '2024-08-03', 'Jaafar Muhammad', '2024-08-01', 'male', 'Katagum', 'Azare', 'Tatari ali quarters azare', '5', '07069402052', 'jarferhharoun1@gmail.com', '01', 'education', 'channels4_profile.jpg', 'Admin'),
(2, '2024-08-08 11:15:52', 'Tanko musa', '2024-05-10', 'sani musa', '2023-01-05', 'male', 'Itas/Gadau', 'Birni', 'unguwar gabar', '4', '09087980898', 'sanimusa@gmail.com', '02', 'housing', 'UDIO THUMBNAl-1.png', 'Admin'),
(3, '2024-08-08 11:15:54', 'ibrahim adamu', '2023-07-08', 'walid ibrahim', '2022-10-11', 'male', 'Bogoro', 'Boi', 'layin bala', '7', '09134546575', 'walidibrahim5@gmail.com', '03', 'education', 'UDIO THUMBNAl-1.png', 'Admin'),
(4, '2024-08-08 11:15:56', 'bala ahmed', '2021-02-01', 'khadija bala ahmed', '2020-05-08', 'female', 'Dambam', 'Dambam', 'layin yaya malam', '3', '0806757685', 'khadijabalaahem@gmail.com', '04', 'medical', 'UDIO THUMBNAl-1.png', 'Admin'),
(5, '2024-08-08 11:20:47', 'Jaafar Muhammad', '2024-08-03', 'Jaafar Muhammad', '2024-08-01', 'male', 'Katagum', 'Katagum', '30 Azare-katagum road Bauchi State\r\n30 Azare-katagum road Bauchi State', '5', '07069402052', 'jaafar.developer@gmail.com', '04', 'financial', 'channels4_profile.jpg', 'tanko yau'),
(6, '2024-08-08 11:23:33', 'Cameron Riggs', '1991-08-11', 'Clare Mcintosh', '2011-07-20', 'male', 'Gamawa', 'Gamawa', 'Unde molestiae asper', '539', '+1 (415) 557-3851', 'faxeti@mailinator.com', '87', 'financial', 'channels4_profile.jpg', 'tanko yau'),
(7, '2024-08-08 11:24:36', 'Lydia Bean', '1998-02-09', 'Luke Norris', '2014-12-30', 'female', 'Darazo', 'Kankara', 'Accusamus laudantium', '98', '+1 (167) 408-8623', 'somuh@mailinator.com', '604', 'housing', 'channels4_profile.jpg', 'tanko yau'),
(8, '2024-08-08 11:24:45', 'Ariana Hernandez', '1986-04-09', 'Ivory Cross', '1981-12-27', 'female', 'Tafawa Balewa', 'Kazali', 'Aut molestiae expedi', '472', '+1 (852) 819-7624', 'wavob@mailinator.com', '979', 'education', 'channels4_profile.jpg', 'tanko yau'),
(9, '2024-08-08 11:24:52', 'Lenore Hardin', '2012-07-15', 'Abbot Odom', '2016-01-29', 'male', 'Dass', 'Dass', 'Est eius architecto ', '185', '+1 (843) 652-8646', 'sisafuro@mailinator.com', '536', 'education', 'channels4_profile.jpg', 'tanko yau'),
(10, '2024-08-08 11:25:05', 'Asher Reyes', '1980-05-01', 'Xyla Castillo', '2000-11-24', 'female', 'Darazo', 'Birni', 'Nulla laboriosam op', '250', '+1 (437) 697-4616', 'ceqon@mailinator.com', '472', 'education', 'channels4_profile.jpg', 'tanko yau'),
(11, '2024-08-08 11:25:41', 'Blake Estrada', '1978-02-28', 'Ivor Turner', '1980-09-10', 'male', 'Katagum', 'Azare', 'Velit amet in eiusm', '797', '+1 (967) 675-1846', 'rulovaxo@mailinator.com', '330', 'medical', 'channels4_profile.jpg', 'tanko yau'),
(12, '2024-08-08 12:12:17', 'Moses Gallegos', '1974-06-21', 'Ira Mayer', '2002-03-05', 'female', 'Bauchi', 'Danlami', 'Et eum mollit aliqui', '140', '+1 (672) 241-5447', 'lyreketax@mailinator.com', '399', 'financial', 'channels4_profile.jpg', 'tanko yau');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `_PDAdmin`
--
ALTER TABLE `_PDAdmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_PDUsers`
--
ALTER TABLE `_PDUsers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `_PDAdmin`
--
ALTER TABLE `_PDAdmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `_PDUsers`
--
ALTER TABLE `_PDUsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
