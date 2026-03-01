-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2026 at 07:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_pengaduan_siswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'admin',
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `role`, `foto`) VALUES
(1, 'admin', 'admin', 'admin', '1772044418_owi.png'),
(2, 'ganung', '$2y$10$FfrcZ8kY1cBZaHQ9fFpH.uO5zV8imXHQabO/10nkLdFEw7H7LyFKK', 'petugas', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `kode_customer` varchar(15) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `kode_customer`, `nama`, `username`, `password`, `email`, `no_hp`, `telp`) VALUES
(1, 'C0001', 'ila', 'ila', '$2y$10$TROX7JKGocu6lIOoPxparO5HoscU3kwbcgEVf2uJ13OeGhlddfLN2', 'test@gmail.com', NULL, '0878864277200'),
(2, 'C0002', 'jojo', 'jojo', '$2y$10$s9TXSmyHCRKnwUrkNuQVWOY8UNLKMRCZfwwBspjPiMfSNEQ7a1BXO', 'jojo@gmail.com', NULL, '098976765454');

-- --------------------------------------------------------

--
-- Table structure for table `history_aspirasi`
--

CREATE TABLE `history_aspirasi` (
  `id_history` int(11) NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id_kontak`, `nama`, `email`, `no_hp`, `pesan`, `tanggal`) VALUES
(1, 'ganung', 'test@gmail.com', '', 'saya test 123', '2026-02-23 18:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `tanggal_kejadian` date DEFAULT NULL,
  `kode_pengaduan` varchar(15) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `isi_laporan` text DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `status` enum('pending','proses','selesai') DEFAULT 'pending',
  `klasifikasi` varchar(100) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `instansi` varchar(255) DEFAULT NULL,
  `anonim` enum('ya','tidak') DEFAULT 'tidak',
  `lampiran` varchar(255) DEFAULT NULL,
  `tgl_pengaduan` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD UNIQUE KEY `kode_customer` (`kode_customer`);

--
-- Indexes for table `history_aspirasi`
--
ALTER TABLE `history_aspirasi`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `id_pengaduan` (`id_pengaduan`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history_aspirasi`
--
ALTER TABLE `history_aspirasi`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history_aspirasi`
--
ALTER TABLE `history_aspirasi`
  ADD CONSTRAINT `history_aspirasi_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
