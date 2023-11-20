-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 08:15 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_futsal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_user` int(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_user`, `username`, `password`, `nama`, `phone`, `email`) VALUES
(1, 'admin@admin', 'admin', 'Admin', '08902932', 'admin@admin'),
(5, 'admin2', 'admin', 'jay', '081222', 'admin2@admin'),
(6, 'izat', 'admin', 'izazut', '0812223', 'admin3@admin'),
(8, 'admin3', 'admin', 'heri', '083333', 'admin4@admin'),
(9, 'jafar', 'admin', 'jafar shodiq', '122345678', 'admin5@admin');

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `idbayar` int(11) NOT NULL,
  `idsewa` int(11) NOT NULL,
  `bukti` text NOT NULL,
  `tgl_upload` date NOT NULL DEFAULT current_timestamp(),
  `konfirmasi` varchar(50) NOT NULL DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bayar`
--

INSERT INTO `bayar` (`idbayar`, `idsewa`, `bukti`, `tgl_upload`, `konfirmasi`) VALUES
(55, 123, '64522a4de1d9a.png', '2023-05-03', 'Terkonfirmasi'),
(57, 124, '6522208360b76.jpg', '2023-10-08', 'Terkonfirmasi'),
(61, 134, '652ca4784df6e.jpg', '2023-10-16', 'Sudah Bayar'),
(62, 135, '652dd2d99d32b.jpg', '2023-10-17', 'Sudah Bayar'),
(63, 136, '652dd2f0247fe.jpg', '2023-10-17', 'Sudah Bayar'),
(64, 138, '6530a6544c662.jpg', '2023-10-19', 'Terkonfirmasi'),
(65, 149, '6540aeba7d28a.png', '2023-10-31', 'Sudah Bayar'),
(66, 150, '6541f5035644f.png', '2023-11-01', 'Sudah Bayar'),
(67, 151, '6543603c7e5d8.png', '2023-11-02', 'Sudah Bayar'),
(68, 152, '654cd72461444.jpg', '2023-11-09', 'Sudah Bayar'),
(69, 146, '654d8f747eddc.jpg', '2023-11-10', 'Sudah Bayar'),
(70, 154, '654d91aae9f1e.jpg', '2023-11-10', 'Sudah Bayar'),
(71, 155, '654d96cfce75a.jpg', '2023-11-10', 'Sudah Bayar'),
(72, 143, '65532383de899.jpg', '2023-11-14', 'Sudah Bayar'),
(73, 145, '655323add04af.jpg', '2023-11-14', 'Sudah Bayar'),
(74, 156, '655b033f14356.jpg', '2023-11-20', 'Sudah Bayar'),
(75, 158, '655b054692c46.jpg', '2023-11-20', 'Sudah Bayar');

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `idlap` int(11) NOT NULL,
  `nm` varchar(35) NOT NULL,
  `ket` text NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`idlap`, `nm`, `ket`, `harga`, `foto`) VALUES
(23, 'Lapangan rumput 1', 'ini lapangan Dewa', 30000, 'footbal.jpg'),
(24, 'Lapangan rumput 2', 'Ini Lapangan Emas', 10000, 'badmintoon.jpg'),
(25, 'Lapangan rumput 3', 'Ini Lapangan Silver', 50000, 'basket.jpg'),
(26, 'Golf', 'Ini Lapangan Golf4', 40000, 'futsal.jpg'),
(27, 'lapangan polije', 'ini lapangan rumput', 150000, '652dd388017b1.png'),
(29, 'Lapangan keramik', 'ini lapangan keramik', 1500000, '6541cb3c956dd.png');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `idpengeluaran` int(11) NOT NULL,
  `tanggalpengeluaran` date NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`idpengeluaran`, `tanggalpengeluaran`, `keterangan`, `jumlah`) VALUES
(8, '2023-11-16', 'jaring', '1000'),
(9, '2023-11-16', 'jaring', '1000'),
(10, '2023-11-15', 'jaring', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `idsewa` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idlap` int(11) NOT NULL,
  `tgl_pesan` date NOT NULL DEFAULT current_timestamp(),
  `lama` int(11) NOT NULL,
  `jmulai` datetime NOT NULL,
  `jhabis` datetime NOT NULL,
  `harga` int(11) NOT NULL,
  `tot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`idsewa`, `iduser`, `idlap`, `tgl_pesan`, `lama`, `jmulai`, `jhabis`, `harga`, `tot`) VALUES
(123, 98, 23, '2023-05-03', 2, '2023-05-03 16:23:00', '2023-05-03 18:23:00', 30000, 60000),
(124, 98, 23, '2023-09-04', 2, '2023-09-04 09:00:00', '2023-09-04 11:00:00', 30000, 60000),
(138, 98, 24, '2023-10-19', 10, '2023-10-19 10:44:00', '2023-10-19 20:44:00', 10000, 100000),
(143, 98, 24, '2023-10-19', 1, '0000-00-00 00:00:00', '1970-01-01 02:00:00', 10000, 10000),
(144, 98, 24, '2023-10-21', 1, '2023-10-20 00:00:00', '2023-10-20 01:00:00', 10000, 10000),
(145, 98, 24, '2023-10-21', 1, '2023-10-21 00:00:00', '2023-10-21 01:00:00', 10000, 10000),
(146, 98, 24, '2023-10-21', 5, '2023-10-21 00:00:00', '2023-10-21 05:00:00', 10000, 10000),
(150, 98, 29, '2023-11-01', 1, '2023-11-01 13:49:00', '2023-11-01 14:49:00', 1500000, 1500000),
(151, 98, 23, '2023-11-02', 1, '2023-11-02 15:38:00', '2023-11-02 16:38:00', 30000, 30000),
(155, 98, 27, '2023-11-10', 1, '2023-11-10 09:34:00', '2023-11-10 10:34:00', 150000, 150000),
(156, 100, 23, '2023-11-14', 1, '2023-11-14 13:43:00', '2023-11-14 14:43:00', 30000, 30000),
(157, 100, 23, '2023-11-16', 2, '2023-11-16 13:44:00', '2023-11-16 15:44:00', 30000, 30000),
(158, 102, 29, '2023-11-20', 2, '2023-11-20 14:05:00', '2023-11-20 16:05:00', 1500000, 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `nama_lengkap` varchar(60) NOT NULL,
  `alamat` text NOT NULL,
  `foto` text NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `hp`, `jenis_kelamin`, `nama_lengkap`, `alamat`, `foto`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(98, 'risky12@gmail.com', '123', '08972423', 'Laki-laki', 'Bayu', 'Bekasi', '652dd31a0b8b1.jpg', NULL, NULL),
(100, 'gantenggaluh805@gmail.com', '$2y$10$N34Ro1ZlBYu5/yw4Pn5uPeRFC', '081222', 'Laki-laki', 'izat', 'Bogor', '653b204adb147.png', '3cf47c23778b7c61641eded08fc8ab8fe8ecf0a33c066f846af96db983253e3c', '2023-11-14 08:18:49'),
(101, 'user2@user', '123', '081222', 'Perempuan', 'fian', 'Bogor', '654f07b988ca0.jpg', NULL, NULL),
(102, 'user3@user', '123', '08977677', 'Perempuan', 'agung mandiri', 'jepang', '655b055b995ed.jpg', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`idbayar`),
  ADD KEY `idsewa` (`idsewa`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`idlap`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`idpengeluaran`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`idsewa`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bayar`
--
ALTER TABLE `bayar`
  MODIFY `idbayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `idlap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `idpengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `idsewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
