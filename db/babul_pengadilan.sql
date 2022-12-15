-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Des 2022 pada 02.06
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
-- Database: `babul_pengadilan`
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
(2, 'Penilai'),
(3, 'Pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_alternatives`
--

CREATE TABLE `saw_alternatives` (
  `id_alternative` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(1, 1, 'bertanggungjawab', 'C1', 30, 'benefit', '1'),
(2, 1, 'presensi', 'C2', 20, 'benefit', '1'),
(3, 1, 'Kedisiplinan', 'C3', 40, 'benefit', '1'),
(4, 1, 'Ketrampilan', 'C4', 10, 'benefit', '1');

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
(1, 1, 1, 1, 9, 5),
(2, 1, 1, 2, 9, 4),
(3, 1, 1, 3, 9, 3),
(4, 1, 1, 4, 9, 3),
(5, 1, 2, 1, 9, 3),
(6, 1, 2, 2, 9, 3),
(7, 1, 2, 3, 9, 3),
(8, 1, 2, 4, 9, 3),
(9, 1, 1, 1, 10, 2),
(10, 1, 1, 2, 10, 2),
(11, 1, 1, 3, 10, 2),
(12, 1, 1, 4, 10, 2),
(13, 1, 2, 1, 10, 4),
(14, 1, 2, 2, 10, 3),
(15, 1, 2, 3, 10, 2),
(16, 1, 2, 4, 10, 3);

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
(1, 'Pegawai Teladan Tahun 2022', '0000-00-00', '2'),
(2, 'Pegawai Teladan 2023', '0000-00-00', '1'),
(3, 'Pegawai Teladan 2024', '0000-00-00', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_login`
--

CREATE TABLE `saw_login` (
  `id_login` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_access` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_login`
--

INSERT INTO `saw_login` (`id_login`, `id_event`, `id_user`, `id_access`, `username`, `password`) VALUES
(1, 0, 1, 1, 'admin', '1cbb8e6c6ae3f9e5d25381f7a59c54f9'),
(2, 2, 10, 2, 'iqbal', '202cb962ac59075b964b07152d234b70');

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
(1, 1, 9, 1, 1),
(2, 1, 9, 2, 0.83),
(3, 1, 10, 1, 0.75),
(4, 1, 10, 2, 1);

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
(4, 4, 'Baik'),
(5, 5, 'Sangat Baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_users`
--

CREATE TABLE `saw_users` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(14) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` enum('off','on') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_users`
--

INSERT INTO `saw_users` (`id_user`, `fullname`, `tempat_lahir`, `tgl_lahir`, `alamat`, `telp`, `jenis_kelamin`, `jabatan`, `foto`, `status`) VALUES
(1, 'Administrator', 'Pekalongan', '1987-12-12', 'Pekalongan', '058988451258', 'Laki-Laki', 'Administrator', 'avatar5.png', 'on'),
(10, 'Muhammad Iqbal', 'Pekalongan', '1992-02-02', 'Pekalongan', '058988451258', 'Laki-Laki', 'Kepala Bidang', '123.png', 'on'),
(11, 'Bagus Adi Wijaya', 'Pekalongan', '1991-06-16', 'Pekalongan', '058988451258', 'Laki-Laki', 'Kepala Bidang', 'Screenshot_20221114-214454_Photos.jpg', 'on'),
(12, 'Musa Hamdun', 'Pekalongan', '2022-12-07', 'pekalongan barat', '85944521561', 'Laki-Laki', 'Kepala cabang', 'avatar511.png', 'on');

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
  ADD KEY `id_event` (`id_event`),
  ADD KEY `id_user` (`id_user`);

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
-- Indeks untuk tabel `saw_login`
--
ALTER TABLE `saw_login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `id_event` (`id_event`),
  ADD KEY `id_user` (`id_user`);

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
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `saw_access`
--
ALTER TABLE `saw_access`
  MODIFY `id_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `saw_alternatives`
--
ALTER TABLE `saw_alternatives`
  MODIFY `id_alternative` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `saw_criterias`
--
ALTER TABLE `saw_criterias`
  MODIFY `id_criteria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `saw_evaluations`
--
ALTER TABLE `saw_evaluations`
  MODIFY `id_evaluations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `saw_event`
--
ALTER TABLE `saw_event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `saw_login`
--
ALTER TABLE `saw_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `saw_result`
--
ALTER TABLE `saw_result`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `saw_score`
--
ALTER TABLE `saw_score`
  MODIFY `id_score` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `saw_users`
--
ALTER TABLE `saw_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
