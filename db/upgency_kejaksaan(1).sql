-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 29, 2022 at 02:48 PM
-- Server version: 10.2.44-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upgency_kejaksaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `saw_access`
--

CREATE TABLE `saw_access` (
  `id_access` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saw_access`
--

INSERT INTO `saw_access` (`id_access`, `name`) VALUES
(1, 'Administrator'),
(2, 'Penilai');

-- --------------------------------------------------------

--
-- Table structure for table `saw_alternatives`
--

CREATE TABLE `saw_alternatives` (
  `id_alternative` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saw_alternatives`
--

INSERT INTO `saw_alternatives` (`id_alternative`, `id_event`, `name`, `jabatan`, `photo`, `status`) VALUES
(12, 1, 'Tom Hiddleson', 'Admin Umum', 'tom.jpg', '1'),
(11, 1, 'Cris Evans', 'Keamanan', 'cris.jpg', '1'),
(10, 1, 'Elizabeth Olsen', 'Admin Keuangan', 'eli.jpg', '1'),
(9, 1, 'Tom Holland', 'Sipir', 'holand.jpeg', '1'),
(17, 0, 'Bagus adi ', 'Kepala', 'IMG_20221108_125114_945.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `saw_criterias`
--

CREATE TABLE `saw_criterias` (
  `id_criteria` int(10) UNSIGNED NOT NULL,
  `id_event` int(11) NOT NULL,
  `criteria` varchar(100) NOT NULL,
  `alias` varchar(5) NOT NULL,
  `weight` float NOT NULL,
  `attribute` set('benefit','cost') DEFAULT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saw_criterias`
--

INSERT INTO `saw_criterias` (`id_criteria`, `id_event`, `criteria`, `alias`, `weight`, `attribute`, `status`) VALUES
(9, 1, 'PROFESIONAL : PEGAWAI MEMAHAMI PERATURAN & PER UU YANG BERLAKU', 'C1', 0.1, 'benefit', '1'),
(10, 1, 'PROFESIONAL : PEGAWAI MENYELESAIKAN TUGAS POKOK DAN FUNGSI SESUAI SOP', 'C2', 0.15, 'benefit', '1'),
(11, 1, 'PROFESIONAL : PEGAWAI MEMAHAMI TUGAS POKOK & FUNGSI BERKUALITAS & SESUAI DENGAN KAIDAH HUKUM', 'C3', 0.15, 'benefit', '1'),
(12, 1, 'KEDISIPLINAN : JAM MASUK & PULANG KANTOR TEPAT WAKTU / JARANG TERLAMBAT DATANG DAN CEPAT PULANG', 'C4', 0.15, 'benefit', '1'),
(13, 1, 'KEDISIPLINAN : PERFORMANCE YANG BAIK DAN SOPAN', 'C5', 0.15, 'benefit', '1'),
(14, 1, 'KEDISIPLINAN : PENYELESAIAN TUGAS KEDINASAN TEPAT WAKTU', 'C6', 0.15, 'benefit', '1'),
(15, 1, 'KEDISIPLINAN : ETIKA DAN SOPAN DANTUN DALAM PERGAULAN', 'C7', 0.15, 'benefit', '1'),
(16, 1, 'Usia', '', 0.15, 'benefit', '0');

-- --------------------------------------------------------

--
-- Table structure for table `saw_evaluations`
--

CREATE TABLE `saw_evaluations` (
  `id_evaluations` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_alternative` int(11) NOT NULL,
  `id_criteria` int(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `value` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saw_evaluations`
--

INSERT INTO `saw_evaluations` (`id_evaluations`, `id_event`, `id_alternative`, `id_criteria`, `id_user`, `value`) VALUES
(1, 1, 11, 9, 2, 3),
(2, 1, 11, 10, 2, 3),
(3, 1, 11, 11, 2, 4),
(4, 1, 11, 12, 2, 4),
(5, 1, 11, 13, 2, 3),
(6, 1, 11, 14, 2, 2),
(7, 1, 11, 15, 2, 3),
(8, 1, 12, 9, 2, 3),
(9, 1, 12, 10, 2, 3),
(10, 1, 12, 11, 2, 4),
(11, 1, 12, 12, 2, 4),
(12, 1, 12, 13, 2, 4),
(13, 1, 12, 14, 2, 3),
(14, 1, 12, 15, 2, 2),
(15, 1, 10, 9, 2, 4),
(16, 1, 10, 10, 2, 3),
(17, 1, 10, 11, 2, 3),
(18, 1, 10, 12, 2, 2),
(19, 1, 10, 13, 2, 3),
(20, 1, 10, 14, 2, 3),
(21, 1, 10, 15, 2, 4),
(22, 1, 9, 9, 2, 3),
(23, 1, 9, 10, 2, 4),
(24, 1, 9, 11, 2, 4),
(25, 1, 9, 12, 2, 3),
(26, 1, 9, 13, 2, 4),
(27, 1, 9, 14, 2, 3),
(28, 1, 9, 15, 2, 3),
(29, 0, 12, 9, 3, 3),
(30, 0, 12, 10, 3, 3),
(31, 0, 12, 11, 3, 1),
(32, 0, 12, 12, 3, 2),
(33, 0, 12, 13, 3, 4),
(34, 0, 12, 14, 3, 2),
(35, 0, 12, 15, 3, 1),
(36, 0, 11, 9, 3, 2),
(37, 0, 11, 10, 3, 2),
(38, 0, 11, 11, 3, 2),
(39, 0, 11, 12, 3, 3),
(40, 0, 11, 13, 3, 2),
(41, 0, 11, 14, 3, 3),
(42, 0, 11, 15, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `saw_event`
--

CREATE TABLE `saw_event` (
  `id_event` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saw_event`
--

INSERT INTO `saw_event` (`id_event`, `title`, `status`) VALUES
(1, 'Pegawai Terbaik Tahun 2022', '1');

-- --------------------------------------------------------

--
-- Table structure for table `saw_users`
--

CREATE TABLE `saw_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `id_access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saw_users`
--

INSERT INTO `saw_users` (`id_user`, `username`, `password`, `fullname`, `id_access`) VALUES
(1, 'admin', '1cbb8e6c6ae3f9e5d25381f7a59c54f9', 'Administrator', 1),
(2, 'yanto', 'e10adc3949ba59abbe56e057f20f883e', 'Yanto Ibrahim', 2),
(3, 'bagus', 'e10adc3949ba59abbe56e057f20f883e', 'Bagus Adi Wijaya', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saw_access`
--
ALTER TABLE `saw_access`
  ADD PRIMARY KEY (`id_access`);

--
-- Indexes for table `saw_alternatives`
--
ALTER TABLE `saw_alternatives`
  ADD PRIMARY KEY (`id_alternative`),
  ADD KEY `id_event` (`id_event`);

--
-- Indexes for table `saw_criterias`
--
ALTER TABLE `saw_criterias`
  ADD PRIMARY KEY (`id_criteria`),
  ADD KEY `id_event` (`id_event`);

--
-- Indexes for table `saw_evaluations`
--
ALTER TABLE `saw_evaluations`
  ADD PRIMARY KEY (`id_evaluations`),
  ADD KEY `id_criteria` (`id_criteria`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_alternative` (`id_alternative`),
  ADD KEY `id_event` (`id_event`);

--
-- Indexes for table `saw_event`
--
ALTER TABLE `saw_event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `saw_users`
--
ALTER TABLE `saw_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_access` (`id_access`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saw_access`
--
ALTER TABLE `saw_access`
  MODIFY `id_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `saw_alternatives`
--
ALTER TABLE `saw_alternatives`
  MODIFY `id_alternative` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `saw_criterias`
--
ALTER TABLE `saw_criterias`
  MODIFY `id_criteria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `saw_evaluations`
--
ALTER TABLE `saw_evaluations`
  MODIFY `id_evaluations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `saw_event`
--
ALTER TABLE `saw_event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saw_users`
--
ALTER TABLE `saw_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
