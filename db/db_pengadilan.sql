-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Feb 2023 pada 23.04
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
(2, 'Penilai'),
(3, 'Kandidat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_alternatives`
--

CREATE TABLE `saw_alternatives` (
  `id_alternative` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ket` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_alternatives`
--

INSERT INTO `saw_alternatives` (`id_alternative`, `id_event`, `id_user`, `ket`) VALUES
(1, 1, 37, 'jujur'),
(2, 1, 31, 'disiplin'),
(3, 2, 30, 'asd'),
(4, 2, 32, 'dfdf'),
(5, 2, 52, 'asdasd'),
(6, 3, 32, 'wer'),
(7, 3, 46, 'qw'),
(8, 3, 33, 'rtyu'),
(9, 4, 31, 'q'),
(10, 4, 39, ''),
(11, 4, 49, '');

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
(1, 1, 'Performance yang baik dan sopan', 'C1', 20, 'benefit', '1'),
(2, 1, 'Pegawai memahami peraturan dan UU yang berlaku', 'C2', 30, 'benefit', '1'),
(3, 1, 'Jam masuk dan jam pulang kantor tepat waktu', 'C3', 30, 'benefit', '1'),
(4, 1, 'Pegawai menyelesaikan tugas pokok dan fungsi sesuai sop', 'C4', 20, 'benefit', '1'),
(5, 2, 'Performance yang baik dan sopan', 'C1', 20, 'benefit', '1'),
(6, 2, 'Pegawai memahami peraturan dan UU yang berlaku', 'C2', 30, 'benefit', '1'),
(7, 2, 'Jam masuk dan jam pulang kantor tepat waktu', 'C3', 30, 'benefit', '1'),
(8, 2, 'Pegawai menyelesaikan tugas pokok dan fungsi sesuai sop', 'C4', 20, 'benefit', '1'),
(9, 3, 'Performance yang baik dan sopan', 'C1', 20, 'benefit', '1'),
(10, 3, 'Pegawai memahami peraturan dan UU yang berlaku', 'C2', 30, 'benefit', '1'),
(11, 3, 'Jam masuk dan jam pulang kantor tepat waktu', 'C3', 30, 'benefit', '1'),
(12, 3, 'Pegawai menyelesaikan tugas pokok dan fungsi sesuai sop', 'C4', 20, 'benefit', '1'),
(13, 4, 'Performance yang baik dan sopan', 'C1', 20, 'benefit', '1'),
(14, 4, 'Pegawai memahami peraturan dan UU yang berlaku', 'C2', 30, 'benefit', '1'),
(15, 4, 'Jam masuk dan jam pulang kantor tepat waktu', 'C3', 30, 'benefit', '1'),
(16, 4, 'Pegawai menyelesaikan tugas pokok dan fungsi sesuai sop', 'C4', 20, 'benefit', '1');

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
(1, 1, 1, 1, 25, 4),
(2, 1, 1, 2, 25, 4),
(3, 1, 1, 3, 25, 2),
(4, 1, 1, 4, 25, 5),
(5, 1, 2, 1, 25, 2),
(6, 1, 2, 2, 25, 1),
(7, 1, 2, 3, 25, 4),
(8, 1, 2, 4, 25, 5),
(9, 1, 1, 1, 26, 5),
(10, 1, 1, 2, 26, 5),
(11, 1, 1, 3, 26, 5),
(12, 1, 1, 4, 26, 5),
(13, 1, 2, 1, 26, 1),
(14, 1, 2, 2, 26, 1),
(15, 1, 2, 3, 26, 1),
(16, 1, 2, 4, 26, 1),
(17, 2, 3, 5, 25, 2),
(18, 2, 3, 6, 25, 1),
(19, 2, 3, 7, 25, 5),
(20, 2, 3, 8, 25, 5),
(21, 2, 4, 5, 25, 3),
(22, 2, 4, 6, 25, 4),
(23, 2, 4, 7, 25, 3),
(24, 2, 4, 8, 25, 1),
(25, 2, 5, 5, 25, 5),
(26, 2, 5, 6, 25, 5),
(27, 2, 5, 7, 25, 4),
(28, 2, 5, 8, 25, 4),
(29, 2, 3, 5, 26, 1),
(30, 2, 3, 6, 26, 1),
(31, 2, 3, 7, 26, 1),
(32, 2, 3, 8, 26, 1),
(33, 2, 4, 5, 26, 2),
(34, 2, 4, 6, 26, 2),
(35, 2, 4, 7, 26, 2),
(36, 2, 4, 8, 26, 5),
(37, 2, 5, 5, 26, 2),
(38, 2, 5, 6, 26, 3),
(39, 2, 5, 7, 26, 4),
(40, 2, 5, 8, 26, 5),
(41, 3, 6, 9, 25, 3),
(42, 3, 6, 10, 25, 3),
(43, 3, 6, 11, 25, 3),
(44, 3, 6, 12, 25, 2),
(45, 3, 7, 9, 25, 2),
(46, 3, 7, 10, 25, 4),
(47, 3, 7, 11, 25, 4),
(48, 3, 7, 12, 25, 2),
(49, 3, 8, 9, 25, 1),
(50, 3, 8, 10, 25, 1),
(51, 3, 8, 11, 25, 1),
(52, 3, 8, 12, 25, 1),
(53, 3, 6, 9, 26, 3),
(54, 3, 6, 10, 26, 3),
(55, 3, 6, 11, 26, 3),
(56, 3, 6, 12, 26, 2),
(57, 3, 7, 9, 26, 1),
(58, 3, 7, 10, 26, 1),
(59, 3, 7, 11, 26, 1),
(60, 3, 7, 12, 26, 1),
(61, 3, 8, 9, 26, 2),
(62, 3, 8, 10, 26, 4),
(63, 3, 8, 11, 26, 2),
(64, 3, 8, 12, 26, 4),
(65, 3, 6, 9, 28, 3),
(66, 3, 6, 10, 28, 2),
(67, 3, 6, 11, 28, 4),
(68, 3, 6, 12, 28, 2),
(69, 3, 7, 9, 28, 2),
(70, 3, 7, 10, 28, 2),
(71, 3, 7, 11, 28, 4),
(72, 3, 7, 12, 28, 4),
(73, 3, 8, 9, 28, 2),
(74, 3, 8, 10, 28, 3),
(75, 3, 8, 11, 28, 4),
(76, 3, 8, 12, 28, 3),
(77, 4, 9, 13, 28, 4),
(78, 4, 9, 14, 28, 4),
(79, 4, 9, 15, 28, 4),
(80, 4, 9, 16, 28, 4),
(81, 4, 10, 13, 28, 4),
(82, 4, 10, 14, 28, 4),
(83, 4, 10, 15, 28, 3),
(84, 4, 10, 16, 28, 4),
(85, 4, 11, 13, 28, 4),
(86, 4, 11, 14, 28, 4),
(87, 4, 11, 15, 28, 4),
(88, 4, 11, 16, 28, 4),
(89, 4, 9, 13, 29, 4),
(90, 4, 9, 14, 29, 4),
(91, 4, 9, 15, 29, 4),
(92, 4, 9, 16, 29, 4),
(93, 4, 10, 13, 29, 4),
(94, 4, 10, 14, 29, 4),
(95, 4, 10, 15, 29, 4),
(96, 4, 10, 16, 29, 4),
(97, 4, 11, 13, 29, 4),
(98, 4, 11, 14, 29, 4),
(99, 4, 11, 15, 29, 4),
(100, 4, 11, 16, 29, 4);

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
(1, 'Pegawai teladan 2021', '0000-00-00', '2'),
(2, 'Pegawai teladan 2023', '0000-00-00', '2'),
(3, 'Pegawai Teladan 2024', '0000-00-00', '2'),
(4, 'Pegawai Teladan 2025', '0000-00-00', '1');

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
(1, 0, 1, 1, 'admin', 'YWRtaW4yMTM='),
(44, 1, 25, 2, 'penilai125', 'cGVuaWxhaTEyNQ=='),
(45, 1, 26, 2, 'penilai126', 'cGVuaWxhaTEyNg=='),
(46, 2, 25, 2, 'penilai225', 'cGVuaWxhaTIyNQ=='),
(47, 2, 26, 2, 'penilai226', 'cGVuaWxhaTIyNg=='),
(48, 3, 25, 2, 'penilai325', 'cGVuaWxhaTMyNQ=='),
(49, 3, 26, 2, 'penilai326', 'cGVuaWxhaTMyNg=='),
(50, 3, 28, 2, 'penilai328', 'cGVuaWxhaTMyOA=='),
(51, 4, 28, 2, 'penilai428', 'cGVuaWxhaTQyOA=='),
(52, 4, 29, 2, 'penilai429', 'cGVuaWxhaTQyOQ==');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_position`
--

CREATE TABLE `saw_position` (
  `id_position` int(11) NOT NULL,
  `id_access` int(11) NOT NULL,
  `position_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_position`
--

INSERT INTO `saw_position` (`id_position`, `id_access`, `position_name`) VALUES
(1, 1, 'Administrator'),
(2, 2, 'Ketua Pengadilan Negeri Batang'),
(3, 2, 'Wakil Ketua Pengadilan Negeri '),
(4, 2, 'Hakim'),
(6, 3, 'Panitera Muda Perdata'),
(7, 3, 'Panitera Muda Hukum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_result`
--

CREATE TABLE `saw_result` (
  `id_result` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_alternative` int(11) NOT NULL,
  `score` float NOT NULL,
  `status` enum('0','1') NOT NULL,
  `top` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_result`
--

INSERT INTO `saw_result` (`id_result`, `id_event`, `id_user`, `id_alternative`, `score`, `status`, `top`) VALUES
(1, 1, 26, 1, 1, '1', 1),
(2, 1, 26, 2, 0.2, '1', 0),
(3, 1, 25, 1, 0.85, '1', 1),
(4, 1, 25, 2, 0.675, '1', 0),
(5, 2, 25, 3, 0.64, '1', 0),
(6, 2, 25, 4, 0.58, '1', 0),
(7, 2, 25, 5, 0.9, '1', 1),
(8, 2, 26, 3, 0.315, '1', 0),
(9, 2, 26, 4, 0.75, '1', 0),
(10, 2, 26, 5, 1, '1', 1),
(11, 3, 25, 6, 0.85, '1', 1),
(12, 3, 25, 7, 0.933333, '1', 0),
(13, 3, 25, 8, 0.316667, '1', 0),
(14, 3, 26, 6, 0.825, '1', 1),
(15, 3, 26, 7, 0.291667, '1', 0),
(16, 3, 26, 8, 0.833333, '1', 0),
(17, 3, 28, 6, 0.8, '1', 1),
(18, 3, 28, 7, 0.833333, '1', 0),
(19, 3, 28, 8, 0.883333, '1', 0),
(20, 4, 28, 9, 1, '0', 1),
(21, 4, 28, 10, 0.925, '0', 0),
(22, 4, 28, 11, 1, '0', 0),
(23, 4, 29, 9, 1, '0', 1),
(24, 4, 29, 10, 1, '0', 0),
(25, 4, 29, 11, 1, '0', 0);

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
(1, 1, 'Sangat tidak baik'),
(2, 2, 'tidak baik'),
(3, 3, 'cukup'),
(4, 4, 'baik'),
(5, 5, 'sangat baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saw_users`
--

CREATE TABLE `saw_users` (
  `id_user` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(14) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `id_position` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` enum('off','on') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saw_users`
--

INSERT INTO `saw_users` (`id_user`, `nip`, `fullname`, `tempat_lahir`, `tgl_lahir`, `alamat`, `telp`, `jenis_kelamin`, `id_position`, `foto`, `status`) VALUES
(1, '199004132014061001', 'Administrator', 'Pekalongan', '1987-12-12', 'Pekalongan', '058988451258', 'Laki-laki', 1, 'avatar5.png', 'on'),
(25, '199004132014061001', 'HARYUNING RESPANTI.SH.,MH', 'Cirebon', '1969-12-06', 'Cirebon', '31262462', 'Perempuan', 2, 'profil16.png', 'on'),
(26, '199004132014061001', 'MEILIA CHRISTINA MULYANINGRUM, SH', 'Semarang', '1979-05-27', 'semarang', '247347', 'Perempuan', 3, 'profil23.png', 'on'),
(27, '199004132014061001', 'HARRY SURYAWAN, SH.,M.Kn', 'Sragen', '1980-01-14', 'Sragen', '235353521', 'Laki-laki', 4, 'profil33.png', 'on'),
(28, '199004132014061001', 'NURACHMAT SH', 'Palu', '1980-06-12', 'solo', '25325343', 'Laki-laki', 4, 'profil42.jpg', 'on'),
(29, '199004132014061001', 'Dr. DIRGHA ZAKI AZIZUL, SH.,MH', 'Kebumen', '1984-12-18', 'kebumen', '3476373', 'Laki-laki', 4, 'profil53.png', 'on'),
(30, '199004132014061001', 'KRISTIANA RATNA SARI DEWI, SH', 'semarang', '1988-10-12', 'semarang', '15125124', 'Perempuan', 6, 'profil64.jpg', 'on'),
(31, '199004132014061001', 'KOKOH MUKAEDI, SH.', 'batang', '1965-12-06', 'batang', '1251241', 'Laki-laki', 6, 'profil73.jpg', 'on'),
(32, '199004132014061001', 'SUTRISNO, SH.', 'Pekalongan', '0972-12-01', 'pekalongan', '426264', 'Laki-laki', 6, 'profil85.png', 'on'),
(33, '199004132014061001', 'BENEDICTUS HARIE KUSHENDRATNO, S.E., S.H.', 'batang', '1975-12-05', 'batang', '235235', 'Laki-laki', 6, 'profil93.png', 'on'),
(34, '199004132014061001', 'SUNARNO, A.Md., S.H.', 'batang', '1980-12-04', 'batang', '136246', 'Laki-laki', 6, 'profil101.png', 'on'),
(35, '199004132014061001', 'SUHASTUTI, SH.', 'batang', '1963-04-07', 'batang', '25331', 'Laki-laki', 6, 'profil115.png', 'on'),
(36, '199004132014061001', 'SARYADI', 'pemalang', '1969-02-03', 'pemalang', '24623', 'Laki-laki', 6, 'profil17.png', 'on'),
(37, '199004132014061001', 'ADITYA PRADANA, A.Md.', 'cilacap', '1992-03-05', 'cilacap', '5262321', 'Laki-laki', 6, 'profil24.png', 'on'),
(38, '199004132014061001', 'PARJITO, SH.', 'pekalongan', '1972-12-05', 'pekalongan', '326247', 'Laki-laki', 6, 'profil34.png', 'on'),
(39, '199004132014061001', 'THIO HAIKAL ANUGERAH, S.H.', 'Purwakarta', '1997-10-06', 'purwakarta', '4267224', 'Laki-laki', 7, 'profil43.jpg', 'on'),
(40, '199004132014061001', 'SUKASNO', 'pekalongan', '1963-04-25', 'pekalongan', '535321', 'Laki-laki', 7, 'profil44.jpg', 'on'),
(41, '199004132014061001', 'REKSONOTO', 'batang', '1963-01-16', 'batang', '321341', 'Laki-laki', 7, 'profil54.png', 'on'),
(42, '199004132014061001', 'FARID MAJEDI', 'pekalongan', '1964-03-28', 'pekalongan', '321513513', 'Laki-laki', 7, 'profil74.jpg', 'on'),
(43, '199004132014061001', 'GATOT PURNOMO, SH', 'batang', '1964-04-11', 'pekalongan', '12351241', 'Laki-laki', 7, 'profil86.png', 'on'),
(44, '199004132014061001', 'NOR KHAERONAH, S.H.', 'batang', '1963-12-06', 'batang', '23513513', 'Laki-laki', 7, 'profil87.png', 'on'),
(45, '199004132014061001', 'SUBAGYO, SH', 'pemalang', '1969-04-06', 'pemalang', '235321513', 'Laki-laki', 7, 'profil94.png', 'on'),
(46, '199004132014061001', 'NIANA TRI JULIANINGSIH, S.H.', 'batang', '1991-07-05', 'batang', '23513513', 'Perempuan', 7, 'profil102.png', 'on'),
(47, '199004132014061001', 'SARIMBI', 'batang', '1965-12-31', 'batang', '13236135', 'Laki-laki', 7, 'profil116.png', 'on'),
(48, '199004132014061001', 'YUNIHAR ARDHI NUGROHO, S.T.', 'Purworejo', '1980-06-29', 'purworejo', '235321531', 'Laki-laki', 7, 'profil18.png', 'on'),
(49, '199004132014061001', 'TAUFIQ', 'semarang', '1968-05-04', 'semarang', '32531251', 'Laki-laki', 7, 'profil35.png', 'on'),
(50, '199004132014061001', 'SUGIHARTO', 'batang', '1966-06-26', 'batang', '253734141', 'Laki-laki', 7, 'profil55.png', 'on'),
(51, '199004132014061001', 'TOHANI', 'batang', '1967-01-12', 'batang', '375372532', 'Laki-laki', 7, 'profil65.jpg', 'on'),
(52, '199004132014061001', 'ERNI MARWANTI', 'batang', '1965-02-28', 'batang', '136246', 'Perempuan', 7, 'profil75.jpg', 'on'),
(53, '199004132014061001', 'LUKLU MARWAH RACHMAWATI, S.Ak', 'yogyakarta', '1993-06-22', 'yogyakarta', '2364235', 'Perempuan', 7, 'profil76.jpg', 'on'),
(54, '199004132014061001', 'A`ISATUL MARWAH, S.E.', 'batang', '1981-12-03', 'batang', '1236246', 'Perempuan', 7, 'profil95.png', 'on'),
(55, '199004132014061001', 'ENDANG SUSILOWATI', 'batang', '1967-12-05', 'batang', '26323', 'Perempuan', 7, 'profil96.png', 'on'),
(57, '199004132014061001', 'A\'INUN FADHILAH, A.md', 'BATANG', '1991-12-06', 'BATANG', '347264', 'Perempuan', 7, 'profil117.png', 'on'),
(58, '199004132014061001', 'LEVRIANA SARASWATI, SE', 'batang', '1990-12-07', 'batang', '872425', 'Perempuan', 7, 'profil36.png', 'on');

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
-- Indeks untuk tabel `saw_position`
--
ALTER TABLE `saw_position`
  ADD PRIMARY KEY (`id_position`);

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
  MODIFY `id_alternative` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `saw_criterias`
--
ALTER TABLE `saw_criterias`
  MODIFY `id_criteria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `saw_evaluations`
--
ALTER TABLE `saw_evaluations`
  MODIFY `id_evaluations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `saw_event`
--
ALTER TABLE `saw_event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `saw_login`
--
ALTER TABLE `saw_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `saw_position`
--
ALTER TABLE `saw_position`
  MODIFY `id_position` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `saw_result`
--
ALTER TABLE `saw_result`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `saw_score`
--
ALTER TABLE `saw_score`
  MODIFY `id_score` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `saw_users`
--
ALTER TABLE `saw_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
