-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 22, 2024 at 03:56 PM
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
(1, '2024-08-11 17:18:28', 'tanko yau MANAGER', 'tanko@yau.com', '654321', 'Manager', '01.jpg', '123456789', 'gdsyfdjdjdsd', 'ADMIN DEV', 'Katagum'),
(2, '2024-08-12 11:04:52', 'ADMIN DEV', 'admin@you.com', '654321', 'Admin', '01.jpg', '123456789', 'gdsyfdjdjdsd', ' DEV', 'Katagum'),
(3, '2024-08-12 11:04:55', 'SUPER DEV', 'super@you.com', '654321', 'Super', '01.jpg', '123456789', 'gdsyfdjdjdsd', 'ADMIN', 'Katagum'),
(4, '2024-08-12 15:38:18', 'Olivia Gentry', 'cizuxypew@mailinator.com', '$2y$10$JehLww8KCNetuxvOtuCWjOElTjjfyXmiEwJu3DahsSfrPzQvSky6G', 'Admin', '66ba236a765d4.jpg', '+1 (918) 295-1932', 'Non ut ut quo illo v', 'SUPER DEV', 'Bogoro'),
(5, '2024-08-12 15:38:12', 'Whilemina Hurst', 'curemiwato@mailinator.com', '$2y$10$AQh/vqnqdxx5qhamaAsotODppJyLO7qiL6HY2El3TaZE.VfC/BZ32', 'Manager', '66ba24482d896.png', '+1 (391) 444-5189', 'Molestiae odio quis ', 'SUPER DEV', 'Bauchi'),
(6, '2024-08-12 15:38:00', 'Dale Reed', 'riceran@mailinator.com', '$2y$10$M4S98hYYHIfJZa3JjTQTa.3OSjU4/vIyCCPNS.UYJo97CWyw/fFbW', 'Admin', '66ba2b0a9d7c7.png', '+1 (724) 725-9626', 'Voluptatem laboriosa', 'SUPER DEV', 'Bogoro'),
(7, '2024-08-12 15:37:24', 'Kalia Lopez', 'suqebor@mailinator.com', '$2y$10$jrvOVKRrEHDX6.nvTPOzrehRL9KGO17DJMrRyeRraZ18Ufa9WxB.q', 'Manager', '66ba2c346f69e.jpg', '+1 (289) 634-5518', 'Autem illum delenit', 'SUPER DEV', 'Bogoro'),
(8, '2024-08-12 15:38:46', 'Isabelle Pennington', 'vuhake@mailinator.com', '$2y$10$kHNUhkXCx81MpaVWpWCBFup9leNFAsUO5jWdgGtHn683R4A2GFxaK', 'Manager', '66ba2c863c17a.jpg', '+1 (216) 671-6736', 'Vero eu cillum volup', 'SUPER DEV', 'Bauchi'),
(9, '2024-08-12 15:39:01', 'Hilary Smith', 'pirewok@mailinator.com', '$2y$10$ik5hSM88t6yN/mb1RUM3ROCWUHsG.kwB10waIQcemwKvXHoDmUNrO', 'Manager', '66ba2c956e026.jpg', '+1 (257) 314-8112', 'Fugiat adipisci vel', 'SUPER DEV', 'Bauchi'),
(10, '2024-08-12 15:40:42', 'Iliana Kelley', 'cafit@mailinator.com', '$2y$10$9F.2FjWI9s9g6y5rXOvTQul.489J8vxnUrHaa0ECjX.OuMHlCaV46', 'Admin', '66ba2cfa926f1.png', '+1 (129) 795-3036', 'Dignissimos repellen', 'SUPER DEV', 'Bogoro'),
(11, '2024-08-12 15:56:35', 'Suki Richard', 'zuwubaxef@mailinator.com', '$2y$10$P.LcTQ19Ue0uhl9WM29uYOkdEOFLXmKO4B2iCdkF.n08xsgTcgvvq', 'Manager', '66ba30b316541.jpg', '+1 (471) 113-3229', 'Sapiente enim itaque', 'SUPER DEV', 'Bogoro');

-- --------------------------------------------------------

--
-- Table structure for table `_PDBen`
--

CREATE TABLE `_PDBen` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `under` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `tstamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_PDBen`
--

INSERT INTO `_PDBen` (`id`, `full_name`, `age`, `under`, `gender`, `photo`, `tstamp`) VALUES
(1, 'Claudia Jefferson', 'Non tempor qui saepe', 'Fugit eveniet quos', 'Female', '66c35f20ed945.png', '2024-08-19 15:05:04'),
(2, 'Walker Gross', 'Duis est dignissimos', 'Laborum Est omnis ', 'Male', '66c35feae84ee.png', '2024-08-19 15:08:26'),
(3, 'Kermit Armstrong', '12', '1', 'Male', '66c360f927fe8.png', '2024-08-19 15:12:57'),
(4, 'Felicia Potts', 'Quas mollit tempor r', '1', 'Female', '66c361f0c65bc.png', '2024-08-19 15:17:04'),
(5, 'Jaden Harrell', 'Vel consequatur quia', '1', 'Female', '66c362cbc0b4f.png', '2024-08-19 15:20:43'),
(6, 'Darrel Brown', 'Incididunt tempore ', '1', 'Male', '66c3680e63b39.png', '2024-08-19 15:43:10'),
(7, 'Lila Roman', 'Et ipsam ut aute sap', '1', 'Male', '66c3684b53a18.png', '2024-08-19 15:44:11'),
(8, 'Ivy Holder', 'Est quaerat amet of', '4', 'Female', '66c3687b9b247.png', '2024-08-19 15:44:59'),
(9, 'Marny Lynn', 'Qui ut quia est ist', '4', 'Male', '66c369260b242.png', '2024-08-19 15:47:50'),
(10, 'Rafael Brock', 'Non saepe aliquam op', '4', 'Male', '66c3699554dd4.png', '2024-08-19 15:49:41');

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
(1, '2024-08-11 16:02:30', 'SUDUWA UPDATED', '2024-08-03', 'Jaafar Muhammad', '2024-08-01', 'Male', 'Katagum', 'Azare', 'CHARA CHARA AZARE', '5', '07069402052', 'jarferhharoun1@gmail.com', '01', 'education', 'channels4_profile.jpg', 'Admin'),
(2, '2024-08-08 11:15:52', 'Tanko musa', '2024-05-10', 'sani musa', '2023-01-05', 'male', 'Itas/Gadau', 'Birni', 'unguwar gabar', '4', '09087980898', 'sanimusa@gmail.com', '02', 'housing', 'UDIO THUMBNAl-1.png', 'Admin'),
(3, '2024-08-08 11:15:54', 'ibrahim adamu', '2023-07-08', 'walid ibrahim', '2022-10-11', 'male', 'Bogoro', 'Boi', 'layin bala', '7', '09134546575', 'walidibrahim5@gmail.com', '03', 'education', 'UDIO THUMBNAl-1.png', 'Admin'),
(4, '2024-08-11 16:01:10', 'SANI UPDATED', '2021-02-01', 'khadija bala ahmed', '2020-05-08', 'Male', 'Dambam', 'Dambam', 'layin yaya malam', '3', '0806757685', 'khadijabalaahem@gmail.com', '04', 'medical', 'UDIO THUMBNAl-1.png', 'Admin'),
(5, '2024-08-08 11:20:47', 'Jaafar Muhammad', '2024-08-03', 'Jaafar Muhammad', '2024-08-01', 'male', 'Katagum', 'Katagum', '30 Azare-katagum road Bauchi State\r\n30 Azare-katagum road Bauchi State', '5', '07069402052', 'jaafar.developer@gmail.com', '04', 'financial', 'channels4_profile.jpg', 'tanko yau'),
(6, '2024-08-08 11:23:33', 'Cameron Riggs', '1991-08-11', 'Clare Mcintosh', '2011-07-20', 'male', 'Gamawa', 'Gamawa', 'Unde molestiae asper', '539', '+1 (415) 557-3851', 'faxeti@mailinator.com', '87', 'financial', 'channels4_profile.jpg', 'tanko yau'),
(7, '2024-08-08 11:24:36', 'Lydia Bean', '1998-02-09', 'Luke Norris', '2014-12-30', 'female', 'Darazo', 'Kankara', 'Accusamus laudantium', '98', '+1 (167) 408-8623', 'somuh@mailinator.com', '604', 'housing', 'channels4_profile.jpg', 'tanko yau'),
(8, '2024-08-08 11:24:45', 'Ariana Hernandez', '1986-04-09', 'Ivory Cross', '1981-12-27', 'female', 'Tafawa Balewa', 'Kazali', 'Aut molestiae expedi', '472', '+1 (852) 819-7624', 'wavob@mailinator.com', '979', 'education', 'channels4_profile.jpg', 'tanko yau'),
(10, '2024-08-08 11:25:05', 'Asher Reyes', '1980-05-01', 'Xyla Castillo', '2000-11-24', 'female', 'Darazo', 'Birni', 'Nulla laboriosam op', '250', '+1 (437) 697-4616', 'ceqon@mailinator.com', '472', 'education', 'channels4_profile.jpg', 'tanko yau'),
(11, '2024-08-08 11:25:41', 'Blake Estrada', '1978-02-28', 'Ivor Turner', '1980-09-10', 'male', 'Katagum', 'Azare', 'Velit amet in eiusm', '797', '+1 (967) 675-1846', 'rulovaxo@mailinator.com', '330', 'medical', 'channels4_profile.jpg', 'tanko yau'),
(12, '2024-08-08 12:12:17', 'Moses Gallegos', '1974-06-21', 'Ira Mayer', '2002-03-05', 'female', 'Bauchi', 'Danlami', 'Et eum mollit aliqui', '140', '+1 (672) 241-5447', 'lyreketax@mailinator.com', '399', 'financial', 'channels4_profile.jpg', 'tanko yau'),
(13, '2024-08-12 12:27:51', 'Jermaine Webster', '1997-12-07', 'Ila Haney', '2009-03-24', 'male', 'Zaki', 'Sabon Gari', 'Voluptate ratione et', '278', '+1 (551) 929-4328', 'calirifano@mailinator.com', '35', 'financial', 'IMG_20240810_121531_878.jpg', 'SUPER DEV'),
(14, '2024-08-12 12:44:45', 'Ursa Blair', '2022-08-05', 'Brenda Velasquez', '2022-01-08', 'female', 'Toro', 'Makoda', 'Labore cum porro quo', '271', '+1 (747) 269-6558', 'vudulypi@mailinator.com', '940', 'housing', 'instruction.png', 'SUPER DEV'),
(15, '2024-08-12 12:44:57', 'Ursa Blair', '2022-08-05', 'Brenda Velasquez', '2022-01-08', 'female', 'Toro', 'Makoda', 'Labore cum porro quo', '271', '+1 (747) 269-6558', 'vudulypi@mailinator.com', '940', 'housing', 'instruction.png', 'SUPER DEV'),
(16, '2024-08-12 12:47:05', 'Octavius Fitzpatrick', '1978-09-16', 'Xyla Cannon', '1998-11-25', 'male', 'Katagum', 'Azare', 'Facere sed ut soluta', '691', '+1 (848) 269-6428', 'najy@mailinator.com', '121', 'medical', 'PXL_20240613_173016359.MP.jpg', 'SUPER DEV'),
(17, '2024-08-12 12:47:14', 'Octavius Fitzpatrick', '1978-09-16', 'Xyla Cannon', '1998-11-25', 'male', 'Katagum', 'Azare', 'Facere sed ut soluta', '691', '+1 (848) 269-6428', 'najy@mailinator.com', '121', 'medical', 'PXL_20240613_173016359.MP.jpg', 'SUPER DEV');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `_PDAdmin`
--
ALTER TABLE `_PDAdmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_PDBen`
--
ALTER TABLE `_PDBen`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `_PDBen`
--
ALTER TABLE `_PDBen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `_PDUsers`
--
ALTER TABLE `_PDUsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
