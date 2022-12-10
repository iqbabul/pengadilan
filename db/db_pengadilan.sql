-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2022 pada 08.40
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
(1, 1, 'Muhammad Iqbal', 'Komisaris', 'WhatsApp_Image_2021-07-18_at_14_54_561.jpeg', '1'),
(2, 1, 'Babul', 'Wakil Dirut', 'DSC00624-removebg-preview11.png', '1'),
(3, 1, 'Nurul Huda', 'Engineer', '75085f47da89e3d3410ea6348015d7c7.jpg', '1'),
(4, 2, 'Muhammad Iqbal', 'Komisaris', 'WhatsApp_Image_2021-07-18_at_14_54_561.jpeg', '1'),
(5, 2, 'Babul', 'Wakil Dirut', 'DSC00624-removebg-preview11.png', '1'),
(6, 2, 'Nurul Huda', 'Engineer', '75085f47da89e3d3410ea6348015d7c7.jpg', '1');

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
(1, 1, 'PROFESIONAL : PEGAWAI MEMAHAMI PERATURAN & PER UU YANG BERLAKU', 'C1', 10, 'benefit', '1'),
(2, 1, 'PROFESIONAL : PEGAWAI MENYELESAIKAN TUGAS POKOK DAN FUNGSI SESUAI SOP', 'C2', 15, 'benefit', '1'),
(3, 1, 'PROFESIONAL : PEGAWAI MEMAHAMI TUGAS POKOK & FUNGSI BERKUALITAS & SESUAI DENGAN KAIDAH HUKUM', 'C3', 15, 'benefit', '1'),
(4, 1, 'KEDISIPLINAN : JAM MASUK & PULANG KANTOR TEPAT WAKTU / JARANG TERLAMBAT DATANG DAN CEPAT PULANG', 'C4', 15, 'benefit', '1'),
(5, 1, 'KEDISIPLINAN : PERFORMANCE YANG BAIK DAN SOPAN', 'C5', 15, 'benefit', '1'),
(6, 1, 'KEDISIPLINAN : PENYELESAIAN TUGAS KEDINASAN TEPAT WAKTU', 'C6', 15, 'benefit', '1'),
(7, 1, 'KEDISIPLINAN : ETIKA DAN SOPAN DANTUN DALAM PERGAULAN', 'C7', 15, 'benefit', '1'),
(8, 2, 'PROFESIONAL : PEGAWAI MEMAHAMI PERATURAN & PER UU YANG BERLAKU', 'C1', 10, 'benefit', '1'),
(9, 2, 'PROFESIONAL : PEGAWAI MENYELESAIKAN TUGAS POKOK DAN FUNGSI SESUAI SOP', 'C2', 15, 'benefit', '1'),
(10, 2, 'PROFESIONAL : PEGAWAI MEMAHAMI TUGAS POKOK & FUNGSI BERKUALITAS & SESUAI DENGAN KAIDAH HUKUM', 'C3', 15, 'benefit', '1'),
(11, 2, 'KEDISIPLINAN : JAM MASUK & PULANG KANTOR TEPAT WAKTU / JARANG TERLAMBAT DATANG DAN CEPAT PULANG', 'C4', 15, 'benefit', '1'),
(12, 2, 'KEDISIPLINAN : PERFORMANCE YANG BAIK DAN SOPAN', 'C5', 15, 'benefit', '1'),
(13, 2, 'KEDISIPLINAN : PENYELESAIAN TUGAS KEDINASAN TEPAT WAKTU', 'C6', 15, 'benefit', '1'),
(14, 2, 'KEDISIPLINAN : ETIKA DAN SOPAN DANTUN DALAM PERGAULAN', 'C7', 15, 'benefit', '1');

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
(1, 1, 1, 1, 6, 4),
(2, 1, 1, 2, 6, 4),
(3, 1, 1, 3, 6, 4),
(4, 1, 1, 4, 6, 4),
(5, 1, 1, 5, 6, 2),
(6, 1, 1, 6, 6, 3),
(7, 1, 1, 7, 6, 4),
(8, 1, 2, 1, 6, 3),
(9, 1, 2, 2, 6, 4),
(10, 1, 2, 3, 6, 2),
(11, 1, 2, 4, 6, 1),
(12, 1, 2, 5, 6, 3),
(13, 1, 2, 6, 6, 3),
(14, 1, 2, 7, 6, 3),
(15, 1, 3, 1, 6, 3),
(16, 1, 3, 2, 6, 3),
(17, 1, 3, 3, 6, 3),
(18, 1, 3, 4, 6, 2),
(19, 1, 3, 5, 6, 4),
(20, 1, 3, 6, 6, 2),
(21, 1, 3, 7, 6, 3),
(22, 2, 4, 8, 6, 3),
(23, 2, 4, 9, 6, 2),
(24, 2, 4, 10, 6, 1),
(25, 2, 4, 11, 6, 3),
(26, 2, 4, 12, 6, 2),
(27, 2, 4, 13, 6, 1),
(28, 2, 4, 14, 6, 2),
(29, 2, 5, 8, 6, 3),
(30, 2, 5, 9, 6, 3),
(31, 2, 5, 10, 6, 2),
(32, 2, 5, 11, 6, 2),
(33, 2, 5, 12, 6, 3),
(34, 2, 5, 13, 6, 2),
(35, 2, 5, 14, 6, 3),
(36, 2, 6, 8, 6, 3),
(37, 2, 6, 9, 6, 3),
(38, 2, 6, 10, 6, 3),
(39, 2, 6, 11, 6, 3),
(40, 2, 6, 12, 6, 4),
(41, 2, 6, 13, 6, 2),
(42, 2, 6, 14, 6, 3),
(43, 2, 4, 8, 7, 3),
(44, 2, 4, 9, 7, 3),
(45, 2, 4, 10, 7, 3),
(46, 2, 4, 11, 7, 3),
(47, 2, 4, 12, 7, 3),
(48, 2, 4, 13, 7, 3),
(49, 2, 4, 14, 7, 3),
(50, 2, 5, 8, 7, 3),
(51, 2, 5, 9, 7, 4),
(52, 2, 5, 10, 7, 3),
(53, 2, 5, 11, 7, 3),
(54, 2, 5, 12, 7, 3),
(55, 2, 5, 13, 7, 3),
(56, 2, 5, 14, 7, 4),
(57, 2, 6, 8, 7, 3),
(58, 2, 6, 9, 7, 2),
(59, 2, 6, 10, 7, 3),
(60, 2, 6, 11, 7, 3),
(61, 2, 6, 12, 7, 2),
(62, 2, 6, 13, 7, 2),
(63, 2, 6, 14, 7, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_event`
--

CREATE TABLE `saw_event` (
  `id_event` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_event`
--

INSERT INTO `saw_event` (`id_event`, `title`, `tgl`, `status`) VALUES
(1, 'Pegawai Terbaik Tahun 2021', '0000-00-00', '2'),
(2, 'Pegawai Terbaik Tahun 2022', '0000-00-00', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_result`
--

CREATE TABLE `saw_result` (
  `id_result` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_alternative` int(11) NOT NULL,
  `score` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_result`
--

INSERT INTO `saw_result` (`id_result`, `id_event`, `id_user`, `id_alternative`, `score`) VALUES
(1, 1, 6, 1, 0.925),
(2, 1, 6, 2, 0.7125),
(3, 1, 6, 3, 0.7375),
(4, 2, 6, 4, 0.65),
(5, 2, 6, 5, 0.8625),
(6, 2, 6, 6, 1),
(7, 2, 7, 4, 0.925),
(8, 2, 7, 5, 1),
(9, 2, 7, 6, 0.825);

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_score`
--

CREATE TABLE `saw_score` (
  `id_score` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `ket` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_score`
--

INSERT INTO `saw_score` (`id_score`, `score`, `ket`) VALUES
(1, 1, 'Sangat Rendah'),
(2, 2, 'Rendah'),
(3, 3, 'Cukup'),
(4, 4, 'Tinggi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_users`
--

CREATE TABLE `saw_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `id_access` int(11) NOT NULL,
  `status` enum('off','on') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_users`
--

INSERT INTO `saw_users` (`id_user`, `username`, `password`, `fullname`, `foto`, `id_access`, `status`) VALUES
(1, 'admin', '1cbb8e6c6ae3f9e5d25381f7a59c54f9', 'Administrator', 'avatar5.png', 1, 'on'),
(6, 'babul', '202cb962ac59075b964b07152d234b70', 'babul', 'avatar52.png', 2, 'off'),
(7, 'yanto', '202cb962ac59075b964b07152d234b70', 'Yanto Basna', '75085f47da89e3d3410ea6348015d7c7.jpg', 2, 'off');

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
-- Indeks untuk tabel `saw_result`
--
ALTER TABLE `saw_result`
  ADD PRIMARY KEY (`id_result`);

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
  MODIFY `id_alternative` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `saw_criterias`
--
ALTER TABLE `saw_criterias`
  MODIFY `id_criteria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `saw_evaluations`
--
ALTER TABLE `saw_evaluations`
  MODIFY `id_evaluations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `saw_event`
--
ALTER TABLE `saw_event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `saw_result`
--
ALTER TABLE `saw_result`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `saw_score`
--
ALTER TABLE `saw_score`
  MODIFY `id_score` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `saw_users`
--
ALTER TABLE `saw_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
