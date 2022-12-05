-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Des 2022 pada 02.53
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengadilan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_access`
--

CREATE TABLE `saw_access` (
  `id_access` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_access`
--

INSERT INTO `saw_access` (`id_access`, `name`) VALUES
(1, 'Administrator'),
(2, 'Penilai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_alternatives`
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
-- Dumping data untuk tabel `saw_alternatives`
--

INSERT INTO `saw_alternatives` (`id_alternative`, `id_event`, `name`, `jabatan`, `photo`, `status`) VALUES
(12, 1, 'Tom Hiddleson', 'Admin Umum', 'tom.jpg', '1'),
(11, 1, 'Cris Evans', 'Keamanan', 'cris.jpg', '1'),
(10, 1, 'Elizabeth Olsen', 'Admin Keuangan', 'eli.jpg', '1'),
(9, 1, 'Tom Holland', 'Sipir', 'holand.jpeg', '1'),
(17, 1, 'Bagus adi ', 'Kepala', 'IMG_20221108_125114_945.jpg', '1'),
(18, 2, 'Tom Hiddleson', 'Admin Umum', 'tom.jpg', '1'),
(19, 2, 'Cris Evans', 'Keamanan', 'cris.jpg', '1'),
(20, 2, 'Elizabeth Olsen', 'Admin Keuangan', 'eli.jpg', '1'),
(21, 2, 'Tom Holland', 'Sipir', 'holand.jpeg', '1'),
(22, 2, 'Bagus adi ', 'Kepala', 'IMG_20221108_125114_945.jpg', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_criterias`
--

CREATE TABLE `saw_criterias` (
  `id_criteria` int(10) UNSIGNED NOT NULL,
  `id_event` int(11) NOT NULL,
  `criteria` varchar(100) NOT NULL,
  `alias` varchar(5) NOT NULL,
  `weight` int(11) NOT NULL,
  `attribute` set('benefit','cost') DEFAULT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_criterias`
--

INSERT INTO `saw_criterias` (`id_criteria`, `id_event`, `criteria`, `alias`, `weight`, `attribute`, `status`) VALUES
(9, 1, 'PROFESIONAL : PEGAWAI MEMAHAMI PERATURAN & PER UU YANG BERLAKU', 'C1', 10, 'benefit', '1'),
(10, 1, 'PROFESIONAL : PEGAWAI MENYELESAIKAN TUGAS POKOK DAN FUNGSI SESUAI SOP', 'C2', 15, 'benefit', '1'),
(11, 1, 'PROFESIONAL : PEGAWAI MEMAHAMI TUGAS POKOK & FUNGSI BERKUALITAS & SESUAI DENGAN KAIDAH HUKUM', 'C3', 15, 'benefit', '1'),
(12, 1, 'KEDISIPLINAN : JAM MASUK & PULANG KANTOR TEPAT WAKTU / JARANG TERLAMBAT DATANG DAN CEPAT PULANG', 'C4', 15, 'benefit', '1'),
(13, 1, 'KEDISIPLINAN : PERFORMANCE YANG BAIK DAN SOPAN', 'C5', 15, 'benefit', '1'),
(14, 1, 'KEDISIPLINAN : PENYELESAIAN TUGAS KEDINASAN TEPAT WAKTU', 'C6', 15, 'benefit', '1'),
(15, 1, 'KEDISIPLINAN : ETIKA DAN SOPAN DANTUN DALAM PERGAULAN', 'C7', 15, 'benefit', '1'),
(19, 2, 'Dapat berkomunikasi dengan baik.', 'C1', 20, 'benefit', '1'),
(20, 2, 'Dapat memotivasi diri sendiri dan orang lain.', 'C2', 20, 'benefit', '1'),
(21, 2, 'Pekerja keras.', 'C3', 30, 'benefit', '1'),
(22, 2, 'Mampu bekerjasama dalam tim.', 'C4', 10, 'benefit', '1'),
(23, 2, 'Memiliki nilai-nilai kepemimpinan.', 'C5', 10, 'benefit', '1'),
(24, 2, 'Usia dibawah 30 tahun', 'C6', 10, 'cost', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_evaluations`
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
-- Dumping data untuk tabel `saw_evaluations`
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
(29, 1, 12, 9, 3, 3),
(30, 1, 12, 10, 3, 3),
(31, 1, 12, 11, 3, 1),
(32, 1, 12, 12, 3, 2),
(33, 1, 12, 13, 3, 4),
(34, 1, 12, 14, 3, 2),
(35, 1, 12, 15, 3, 1),
(36, 1, 11, 9, 3, 2),
(37, 1, 11, 10, 3, 2),
(38, 1, 11, 11, 3, 2),
(39, 1, 11, 12, 3, 3),
(40, 1, 11, 13, 3, 2),
(41, 1, 11, 14, 3, 3),
(42, 1, 11, 15, 3, 2),
(43, 1, 10, 9, 3, 2),
(44, 1, 10, 10, 3, 2),
(45, 1, 10, 11, 3, 1),
(46, 1, 10, 12, 3, 2),
(47, 1, 10, 13, 3, 1),
(48, 1, 10, 14, 3, 3),
(49, 1, 10, 15, 3, 2),
(50, 1, 9, 9, 3, 4),
(51, 1, 9, 10, 3, 3),
(52, 1, 9, 11, 3, 2),
(53, 1, 9, 12, 3, 4),
(54, 1, 9, 13, 3, 3),
(55, 1, 9, 14, 3, 2),
(56, 1, 9, 15, 3, 2),
(57, 1, 17, 9, 2, 3),
(58, 1, 17, 10, 2, 3),
(59, 1, 17, 11, 2, 3),
(60, 1, 17, 12, 2, 4),
(61, 1, 17, 13, 2, 4),
(62, 1, 17, 14, 2, 2),
(63, 1, 17, 15, 2, 3),
(64, 1, 17, 9, 3, 1),
(65, 1, 17, 10, 3, 3),
(66, 1, 17, 11, 3, 2),
(67, 1, 17, 12, 3, 1),
(68, 1, 17, 13, 3, 2),
(69, 1, 17, 14, 3, 2),
(70, 1, 17, 15, 3, 1),
(124, 2, 21, 24, 2, 5),
(123, 2, 21, 23, 2, 1),
(122, 2, 21, 22, 2, 1),
(121, 2, 21, 21, 2, 1),
(120, 2, 21, 20, 2, 1),
(119, 2, 21, 19, 2, 1),
(118, 2, 20, 24, 2, 2),
(117, 2, 20, 23, 2, 1),
(116, 2, 20, 22, 2, 4),
(115, 2, 20, 21, 2, 4),
(114, 2, 20, 20, 2, 3),
(113, 2, 20, 19, 2, 3),
(112, 2, 19, 24, 2, 2),
(111, 2, 19, 23, 2, 2),
(110, 2, 19, 22, 2, 3),
(109, 2, 19, 21, 2, 3),
(108, 2, 19, 20, 2, 4),
(107, 2, 19, 19, 2, 4),
(106, 2, 18, 24, 2, 1),
(105, 2, 18, 23, 2, 2),
(104, 2, 18, 22, 2, 5),
(103, 2, 18, 21, 2, 5),
(102, 2, 18, 20, 2, 5),
(101, 2, 18, 19, 2, 5),
(125, 2, 18, 19, 3, 5),
(126, 2, 18, 20, 3, 5),
(127, 2, 18, 21, 3, 5),
(128, 2, 18, 22, 3, 5),
(129, 2, 18, 23, 3, 5),
(130, 2, 18, 24, 3, 1),
(131, 2, 19, 19, 3, 4),
(132, 2, 19, 20, 3, 4),
(133, 2, 19, 21, 3, 4),
(134, 2, 19, 22, 3, 4),
(135, 2, 19, 23, 3, 4),
(136, 2, 19, 24, 3, 2),
(137, 2, 20, 19, 3, 3),
(138, 2, 20, 20, 3, 3),
(139, 2, 20, 21, 3, 3),
(140, 2, 20, 22, 3, 3),
(141, 2, 20, 23, 3, 3),
(142, 2, 20, 24, 3, 3),
(143, 2, 21, 19, 3, 2),
(144, 2, 21, 20, 3, 2),
(145, 2, 21, 21, 3, 2),
(146, 2, 21, 22, 3, 2),
(147, 2, 21, 23, 3, 2),
(148, 2, 21, 24, 3, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_event`
--

CREATE TABLE `saw_event` (
  `id_event` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_event`
--

INSERT INTO `saw_event` (`id_event`, `title`, `status`) VALUES
(1, 'Pegawai Terbaik Tahun 2021', '2'),
(2, 'Pegawai Terbaik Tahun 2022', '1'),
(3, 'Pegawai Tahun 2023', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_score`
--

CREATE TABLE `saw_score` (
  `id_score` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_score`
--

INSERT INTO `saw_score` (`id_score`, `min`, `max`) VALUES
(1, 1, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_users`
--

CREATE TABLE `saw_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `id_access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_users`
--

INSERT INTO `saw_users` (`id_user`, `username`, `password`, `fullname`, `id_access`) VALUES
(1, 'admin', '1cbb8e6c6ae3f9e5d25381f7a59c54f9', 'Administrator', 1),
(2, 'yanto', 'e10adc3949ba59abbe56e057f20f883e', 'Yanto Ibrahim', 2),
(3, 'bagus', 'e10adc3949ba59abbe56e057f20f883e', 'Bagus Adi Wijaya', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `saw_access`
--
ALTER TABLE `saw_access`
  ADD PRIMARY KEY (`id_access`);

--
-- Indeks untuk tabel `saw_alternatives`
--
ALTER TABLE `saw_alternatives`
  ADD PRIMARY KEY (`id_alternative`),
  ADD KEY `id_event` (`id_event`);

--
-- Indeks untuk tabel `saw_criterias`
--
ALTER TABLE `saw_criterias`
  ADD PRIMARY KEY (`id_criteria`),
  ADD KEY `id_event` (`id_event`);

--
-- Indeks untuk tabel `saw_evaluations`
--
ALTER TABLE `saw_evaluations`
  ADD PRIMARY KEY (`id_evaluations`),
  ADD KEY `id_criteria` (`id_criteria`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_alternative` (`id_alternative`),
  ADD KEY `id_event` (`id_event`);

--
-- Indeks untuk tabel `saw_event`
--
ALTER TABLE `saw_event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indeks untuk tabel `saw_score`
--
ALTER TABLE `saw_score`
  ADD PRIMARY KEY (`id_score`);

--
-- Indeks untuk tabel `saw_users`
--
ALTER TABLE `saw_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_access` (`id_access`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `saw_access`
--
ALTER TABLE `saw_access`
  MODIFY `id_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `saw_alternatives`
--
ALTER TABLE `saw_alternatives`
  MODIFY `id_alternative` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `saw_criterias`
--
ALTER TABLE `saw_criterias`
  MODIFY `id_criteria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `saw_evaluations`
--
ALTER TABLE `saw_evaluations`
  MODIFY `id_evaluations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT untuk tabel `saw_event`
--
ALTER TABLE `saw_event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `saw_score`
--
ALTER TABLE `saw_score`
  MODIFY `id_score` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `saw_users`
--
ALTER TABLE `saw_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
