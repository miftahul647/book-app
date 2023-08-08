-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 11:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--
CREATE TABLE `book` (
  `id_book` int(11) NOT NULL,
  `nama_buku` varchar(100) NOT NULL DEFAULT '0',
  `nama_observer` varchar(100) NOT NULL DEFAULT '0',
  `satuan_pendidikan` varchar(200) NOT NULL DEFAULT '0',
  `lokasi` varchar(200) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL,
  `narasumber` varchar(100) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id_book`, `nama_buku`, `nama_observer`, `satuan_pendidikan`, `lokasi`, `tanggal`, `narasumber`, `created_at`, `updated_at`) VALUES
(1, 'Ekosistem 1', 'Ridwan Indira', 'SMA 1', 'Jakarta Pusat', '2023-07-27', 'Pak Nam D', '2023-07-30 14:07:55', '2023-07-30 13:09:15'),
(5, 'Ekosistem 4', 'Firdaus SH', 'SD Negeri', 'Jakarta Selatan', '2023-07-28', 'Andir', '2023-07-30 13:07:38', '2023-07-30 14:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `bukti`
--

CREATE TABLE `bukti` (
  `id_bukti` int(11) NOT NULL,
  `file` varchar(100) NOT NULL DEFAULT '0',
  `id_pertanyaan` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_monev`
--

CREATE TABLE `hasil_monev` (
  `id_hasil` int(11) NOT NULL,
  `checked` tinyint(4) NOT NULL DEFAULT 0,
  `label` varchar(100) DEFAULT NULL,
  `jawaban` text DEFAULT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_monev`
--

CREATE TABLE `pertanyaan_monev` (
  `id_pertanyaan` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT '0',
  `id_variabel` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `variabel`
--

CREATE TABLE `variabel` (
  `id_variabel` int(11) NOT NULL,
  `nama_variabel` varchar(100) NOT NULL DEFAULT '',
  `id_book` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `bukti`
--
ALTER TABLE `bukti`
  ADD PRIMARY KEY (`id_bukti`);

--
-- Indexes for table `hasil_monev`
--
ALTER TABLE `hasil_monev`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `pertanyaan_monev`
--
ALTER TABLE `pertanyaan_monev`
  ADD PRIMARY KEY (`id_pertanyaan`);

--
-- Indexes for table `variabel`
--
ALTER TABLE `variabel`
  ADD PRIMARY KEY (`id_variabel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bukti`
--
ALTER TABLE `bukti`
  MODIFY `id_bukti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hasil_monev`
--
ALTER TABLE `hasil_monev`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pertanyaan_monev`
--
ALTER TABLE `pertanyaan_monev`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `variabel`
--
ALTER TABLE `variabel`
  MODIFY `id_variabel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
