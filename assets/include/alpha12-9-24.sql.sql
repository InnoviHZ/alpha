-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2024 at 01:28 PM
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
  `picture` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `reg_by` varchar(255) NOT NULL,
  `lga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_PDAdmin`
--

INSERT INTO `_PDAdmin` (`id`, `tstamp`, `name`, `email`, `password`, `type`, `picture`, `phone`, `address`, `reg_by`, `lga`) VALUES
(4, '2024-08-12 15:38:18', 'Olivia Gentry', 'cizuxypew@mailinator.com', '$2y$10$JehLww8KCNetuxvOtuCWjOElTjjfyXmiEwJu3DahsSfrPzQvSky6G', 'Admin', '66ba236a765d4.jpg', '+1 (918) 295-1932', 'Non ut ut quo illo v', 'SUPER DEV', 'Bogoro'),
(5, '2024-08-12 15:38:12', 'Whilemina Hurst', 'curemiwato@mailinator.com', '$2y$10$AQh/vqnqdxx5qhamaAsotODppJyLO7qiL6HY2El3TaZE.VfC/BZ32', 'Manager', '66ba24482d896.png', '+1 (391) 444-5189', 'Molestiae odio quis ', 'SUPER DEV', 'Bauchi'),
(6, '2024-08-12 15:38:00', 'Dale Reed', 'riceran@mailinator.com', '$2y$10$M4S98hYYHIfJZa3JjTQTa.3OSjU4/vIyCCPNS.UYJo97CWyw/fFbW', 'Admin', '66ba2b0a9d7c7.png', '+1 (724) 725-9626', 'Voluptatem laboriosa', 'SUPER DEV', 'Bogoro'),
(7, '2024-08-12 15:37:24', 'Kalia Lopez', 'suqebor@mailinator.com', '$2y$10$jrvOVKRrEHDX6.nvTPOzrehRL9KGO17DJMrRyeRraZ18Ufa9WxB.q', 'Manager', '66ba2c346f69e.jpg', '+1 (289) 634-5518', 'Autem illum delenit', 'SUPER DEV', 'Bogoro'),
(8, '2024-08-12 15:38:46', 'Isabelle Pennington', 'vuhake@mailinator.com', '$2y$10$kHNUhkXCx81MpaVWpWCBFup9leNFAsUO5jWdgGtHn683R4A2GFxaK', 'Manager', '66ba2c863c17a.jpg', '+1 (216) 671-6736', 'Vero eu cillum volup', 'SUPER DEV', 'Bauchi'),
(9, '2024-08-12 15:39:01', 'Hilary Smith', 'pirewok@mailinator.com', '$2y$10$ik5hSM88t6yN/mb1RUM3ROCWUHsG.kwB10waIQcemwKvXHoDmUNrO', 'Manager', '66ba2c956e026.jpg', '+1 (257) 314-8112', 'Fugiat adipisci vel', 'SUPER DEV', 'Bauchi'),
(10, '2024-08-12 15:40:42', 'Iliana Kelley', 'cafit@mailinator.com', '$2y$10$9F.2FjWI9s9g6y5rXOvTQul.489J8vxnUrHaa0ECjX.OuMHlCaV46', 'Admin', '66ba2cfa926f1.png', '+1 (129) 795-3036', 'Dignissimos repellen', 'SUPER DEV', 'Bogoro'),
(11, '2024-08-26 08:43:47', 'Suki Richard', 'zuwubaxef@mailinator.com', '$2y$10$P.LcTQ19Ue0uhl9WM29uYOkdEOFLXmKO4B2iCdkF.n08xsgTcgvvq', 'Super', '66ba30b316541.jpg', '+1 (471) 113-3229', 'Sapiente enim itaque', 'SUPER DEV', 'Bogoro'),
(12, '2024-08-26 08:48:06', 'tanko yau MANAGER', 'tanko@yau.com', '$2y$10$iF2Rl44uqsncxkBYI4AHMexcdz9AseERYSlsXjeQdvdYg0XY0iNE6', 'Manager', '01.jpg', '123456789', 'gdsyfdjdjdsd', 'Suki Richard', 'Alkaleri'),
(13, '2024-08-26 08:48:10', 'ADMIN DEV', 'admin@you.com', '$2y$10$x3wcovS..mnr5eYwnXEQdeKZ03tmAhc0zvGHVAKRvSf1JZAXe9nu.', 'Admin', '01.jpg', '123456789', 'Bauchi state', 'Suki Richard', 'Bauchi'),
(14, '2024-08-26 08:48:14', 'SUPER DEV', 'super@you.com', '$2y$10$Jc3gFVKVSnO/Z0G6tOwjlOV2OMer55zUx6MDH5.kfoq44CtgeVytC', 'Super', '01.jpg', '123456789', 'Bauchi state', 'Suki Richard', 'Bogoro');

-- --------------------------------------------------------

--
-- Table structure for table `_PDCollection_points`
--

CREATE TABLE `_PDCollection_points` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `lga` varchar(100) NOT NULL,
  `ward` varchar(100) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_PDCollection_points`
--

INSERT INTO `_PDCollection_points` (`id`, `name`, `address`, `state`, `lga`, `ward`, `capacity`, `created_at`, `updated_at`) VALUES
(1, 'test1', 'Tatari ali quarters azare', 'Bauchi', 'Katagum', 'Katagum,Azare', 50, '2024-09-20 16:36:54', '2024-09-20 16:36:54'),
(2, 'test2', '30 Azare-katagum road Bauchi State', 'Bauchi', 'Ganjuwa', 'Ganjuwa,Birni,Ganjuwa,Kankara', 70, '2024-09-20 16:39:24', '2024-09-20 16:39:24'),
(3, 'Jaafar Muhammad', 'Tatari ali quarters azare', 'Bauchi', 'Bauchi', 'Birshi,Dan\'iya,Danlami,Dawaki', 23, '2024-09-21 09:29:02', '2024-09-21 09:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `_PDOutlet`
--

CREATE TABLE `_PDOutlet` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `under` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `tstamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_PDOutlet`
--

INSERT INTO `_PDOutlet` (`id`, `full_name`, `age`, `under`, `gender`, `photo`, `tstamp`) VALUES
(1, 'Claudia Jefferson', 'Non tempor qui saepe', 'Fugit eveniet quos', 'Female', '66c35f20ed945.png', '2024-08-19 15:05:04'),
(2, 'Walker Gross', 'Duis est dignissimos', 'Laborum Est omnis ', 'Male', '66c35feae84ee.png', '2024-08-19 15:08:26'),
(5, 'Jaden Harrell', 'Vel consequatur quia', '1', 'Female', '66c362cbc0b4f.png', '2024-08-19 15:20:43'),
(6, 'Darrel Brown', 'Incididunt tempore ', '1', 'Male', '66c3680e63b39.png', '2024-08-19 15:43:10'),
(7, 'Lila Roman', 'Et ipsam ut aute sap', '1', 'Male', '66c3684b53a18.png', '2024-08-19 15:44:11'),
(8, 'Ivy Holder', 'Est quaerat amet of', '4', 'Female', '66c3687b9b247.png', '2024-08-19 15:44:59'),
(9, 'Marny Lynn', 'Qui ut quia est ist', '4', 'Male', '66c369260b242.png', '2024-08-19 15:47:50'),
(10, 'Rafael Brock', 'Non saepe aliquam op', '4', 'Male', '66c3699554dd4.png', '2024-08-19 15:49:41'),
(11, 'Inga Hale', 'Ea in enim incididun', '11', 'Male', 'Inga Hale.png', '2024-08-23 19:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `_PDSysSettings`
--

CREATE TABLE `_PDSysSettings` (
  `collection_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_PDSysSettings`
--

INSERT INTO `_PDSysSettings` (`collection_date`) VALUES
('2024-09-05');

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
  `state` varchar(255) NOT NULL,
  `lga` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `op_number` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `benefit_type` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `reg_by` varchar(255) NOT NULL,
  `collection_point_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `_PDAdmin`
--
ALTER TABLE `_PDAdmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_PDCollection_points`
--
ALTER TABLE `_PDCollection_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_PDOutlet`
--
ALTER TABLE `_PDOutlet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_PDUsers`
--
ALTER TABLE `_PDUsers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_point_id` (`collection_point_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `_PDAdmin`
--
ALTER TABLE `_PDAdmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `_PDCollection_points`
--
ALTER TABLE `_PDCollection_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `_PDOutlet`
--
ALTER TABLE `_PDOutlet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `_PDUsers`
--
ALTER TABLE `_PDUsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `_PDUsers`
--
ALTER TABLE `_PDUsers`
  ADD CONSTRAINT `_PDUsers_ibfk_1` FOREIGN KEY (`collection_point_id`) REFERENCES `_PDCollection_points` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
