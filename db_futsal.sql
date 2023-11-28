-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 10:52 AM
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
(5, 'admin2', 'admin', 'jay ayangku', '081222', 'admin2@admin'),
(10, 'mustika jaya', 'admin', 'mustika ratu', '098907', 'admin3@admin');

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `idbayar` int(11) NOT NULL,
  `idsewa` int(11) NOT NULL,
  `bukti` text NOT NULL,
  `tgl_upload` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `konfirmasi` varchar(50) NOT NULL DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bayar`
--

INSERT INTO `bayar` (`idbayar`, `idsewa`, `bukti`, `tgl_upload`, `konfirmasi`) VALUES
(78, 163, '655d634418e21.jpg', '2023-11-22 02:16:24', 'Terkonfirmasi'),
(80, 165, '655d658a1e0ae.jpg', '2023-11-22 02:25:59', 'Terkonfirmasi'),
(83, 170, '655d66161d89d.jpg', '2023-11-22 02:25:35', 'Terkonfirmasi'),
(84, 169, '655d66269d85d.jpg', '2023-11-22 02:25:40', 'Terkonfirmasi'),
(85, 173, '655d677cd64f8.jpg', '2023-11-22 02:37:20', 'Terkonfirmasi'),
(86, 174, '655d68adda1b9.jpg', '2023-11-22 02:37:08', 'Terkonfirmasi'),
(88, 176, '655d6a4921420.jpg', '2023-11-24 04:17:46', 'Terkonfirmasi'),
(89, 177, '656045f5aac18.jpg', '2023-11-24 06:43:01', 'Sudah Bayar'),
(91, 187, '6560bb436b584.jpg', '2023-11-24 15:03:31', 'Sudah Bayar'),
(92, 188, '6560bb4fde347.jpg', '2023-11-24 15:03:43', 'Sudah Bayar'),
(93, 189, '6560bbe7307da.jpg', '2023-11-24 15:06:15', 'Sudah Bayar'),
(95, 193, '6562c5cf8ac53.jpg', '2023-11-26 05:02:23', 'Terkonfirmasi'),
(96, 194, '6562cf443a250.jpg', '2023-11-26 05:02:16', 'Terkonfirmasi'),
(97, 197, '6564250556409.jpg', '2023-11-28 09:51:20', 'Terkonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `idlap` int(11) NOT NULL,
  `nm` varchar(35) NOT NULL,
  `ket` text NOT NULL,
  `harga` varchar(255) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`idlap`, `nm`, `ket`, `harga`, `foto`) VALUES
(23, 'Lapangan biasa ', 'ini lapangan biasa ke-1', '100000', '6565b768cb2b9.jpg'),
(24, 'Lapangan biasa ', 'ini lapangan biasa ke-2', '100000', '6565b77752fd7.jpg'),
(25, 'Lapangan biasa', 'ini lapangan biasa ke-3', '100000', '6565b7864d2a1.jpg'),
(26, 'Lapangan biasa ', 'Ini Lapangan biasa ke-4', '100000', '6565b79789a26.jpg'),
(27, 'lapangan biasa ', 'ini lapangan biasa ke-5', '100000', '6565b7a443322.jpg'),
(29, 'Lapangan biasa ', 'ini lapangan biasa ke-6', '100000', '6565b7b12aee8.jpg'),
(32, 'Lapangan rumput', 'ini lapangan rumput', '120000', '6565b7c1e3456.png');

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
(10, '2023-11-15', 'jaring', '1000'),
(12, '2023-11-21', 'bola', '2000'),
(14, '2023-11-22', 'bola', '2000'),
(16, '2023-11-30', 'manusia', '10000'),
(17, '2023-11-24', 'ihya', '10'),
(19, '2023-11-28', 'bima', '500000');

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `idsewa` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idlap` int(11) NOT NULL,
  `tgl_pesan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lama` int(11) NOT NULL,
  `jmulai` datetime NOT NULL,
  `jhabis` datetime NOT NULL,
  `harga` varchar(255) NOT NULL,
  `tot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`idsewa`, `iduser`, `idlap`, `tgl_pesan`, `lama`, `jmulai`, `jhabis`, `harga`, `tot`) VALUES
(163, 102, 25, '2023-11-22 02:10:33', 2, '2023-11-22 09:10:00', '2023-11-22 11:10:00', '50000', '50000'),
(165, 102, 23, '2023-11-22 02:19:09', 1, '2023-01-22 09:18:00', '2023-01-22 10:18:00', '30000', '30000'),
(169, 101, 29, '2023-11-22 02:22:52', 1, '2023-11-22 09:22:00', '2023-11-22 10:22:00', '1500000', '1500000'),
(170, 101, 26, '2023-11-22 02:23:06', 3, '2023-11-22 09:23:00', '2023-11-22 12:23:00', '40000', '40000'),
(173, 101, 27, '2023-11-22 02:28:56', 5, '2023-11-22 09:28:00', '2023-11-22 14:28:00', '150000', '150000'),
(174, 102, 26, '2023-11-22 02:34:06', 3, '2023-11-30 09:33:00', '2023-11-30 12:33:00', '40000', '40000'),
(176, 100, 24, '2023-11-22 02:40:31', 2, '2024-01-22 09:40:00', '2024-01-22 11:40:00', '10000', '10000'),
(177, 100, 32, '2023-11-24 06:42:50', 2, '2023-11-24 13:42:00', '2023-11-24 15:42:00', '100000', '100000'),
(187, 100, 25, '2023-11-24 15:00:15', 5, '2023-11-24 22:00:00', '2023-11-25 03:00:00', '50000', '250000'),
(188, 100, 32, '2023-11-24 15:00:52', 3, '2023-11-24 22:00:00', '2023-11-25 01:00:00', '100000', '300000'),
(189, 105, 23, '2023-11-24 15:06:03', 4, '2023-11-24 22:05:00', '2023-11-25 02:05:00', '100000', '400000'),
(193, 106, 32, '2023-11-26 04:12:48', 3, '2023-11-26 11:12:00', '2023-11-26 14:12:00', '100000', '300000'),
(194, 106, 27, '2023-11-26 04:53:10', 2, '2023-11-26 11:53:00', '2023-11-26 13:53:00', '100000', '200000'),
(197, 106, 25, '2023-12-01 05:11:23', 5, '2023-12-30 12:11:00', '2023-12-30 17:11:00', '50000', '250000');

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
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `hp`, `jenis_kelamin`, `nama_lengkap`, `alamat`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(98, 'risky12@gmail.com', '123', '08972423', 'Laki-laki', 'Bayu', 'Bekasi', NULL, NULL),
(100, 'gantenggaluh805@gmail.com', '$2y$10$N34Ro1ZlBYu5/yw4Pn5uPeRFC', '081222', 'Laki-laki', 'izat', 'Bogor', '3cf47c23778b7c61641eded08fc8ab8fe8ecf0a33c066f846af96db983253e3c', '2023-11-14 08:18:49'),
(101, 'user2@user', '123', '081251678', 'Perempuan', 'fian cantikk', 'bahahaha', NULL, NULL),
(102, 'user3@user', '123', '08977677', 'Perempuan', 'agung mandiri', 'jepang', NULL, NULL),
(107, 'user12@user', '123', '0897687', 'Laki-Laki', 'ihya ppk', 'purbalingga', NULL, NULL),
(105, 'user11@user', '123', '098765', 'Laki-Laki', 'mustika jaya abadi', 'tanjung hitam', NULL, NULL),
(106, 'user4@user', '123', '0987889', 'Perempuan', 'elesse ', 'vietnam ', NULL, NULL);

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
  ADD PRIMARY KEY (`idsewa`),
  ADD KEY `iduser` (`iduser`,`idlap`),
  ADD KEY `sewa_ibfk_1` (`idlap`);

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
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bayar`
--
ALTER TABLE `bayar`
  MODIFY `idbayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `idlap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `idpengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `idsewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bayar`
--
ALTER TABLE `bayar`
  ADD CONSTRAINT `bayar_ibfk_1` FOREIGN KEY (`idsewa`) REFERENCES `sewa` (`idsewa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sewa`
--
ALTER TABLE `sewa`
  ADD CONSTRAINT `sewa_ibfk_1` FOREIGN KEY (`idlap`) REFERENCES `lapangan` (`idlap`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
