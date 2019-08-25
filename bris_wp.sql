-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2019 at 11:48 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bris_wp`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_alternatif`
--

CREATE TABLE `wp_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(255) NOT NULL,
  `vektor_s` double NOT NULL,
  `vektor_v` double NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_alternatif`
--

INSERT INTO `wp_alternatif` (`id_alternatif`, `nama_alternatif`, `vektor_s`, `vektor_v`, `id_nasabah`, `tgl`) VALUES
(1, 'Aaaa-1', 0, 0, 1, '2019-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `wp_bobot`
--

CREATE TABLE `wp_bobot` (
  `id_kriteria` int(11) NOT NULL,
  `nilai_bobot` double NOT NULL,
  `hasil_bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_bobot`
--

INSERT INTO `wp_bobot` (`id_kriteria`, `nilai_bobot`, `hasil_bobot`) VALUES
(1, 3, 0.16666666666667),
(2, 4, 0.22222222222222),
(3, 4, 0.22222222222222),
(4, 3, 0.16666666666667),
(5, 4, 0.22222222222222);

-- --------------------------------------------------------

--
-- Table structure for table `wp_kriteria`
--

CREATE TABLE `wp_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `tipe_kriteria` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_kriteria`
--

INSERT INTO `wp_kriteria` (`id_kriteria`, `nama_kriteria`, `tipe_kriteria`) VALUES
(1, 'Capital (C1)', 'benefit'),
(2, 'Collateral-Agunan (C2)', 'benefit'),
(3, 'Capacity-Pendapatan (C3)', 'benefit'),
(4, 'Condition-Kondisi (C4)', 'benefit'),
(5, 'Character-Karakter (C5)', 'benefit');

-- --------------------------------------------------------

--
-- Table structure for table `wp_nasabah`
--

CREATE TABLE `wp_nasabah` (
  `id_nasabah` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_nasabah`
--

INSERT INTO `wp_nasabah` (`id_nasabah`, `nama`, `phone`, `alamat`) VALUES
(1, 'LISFANAH', '085123456789', 'Wergu');

-- --------------------------------------------------------

--
-- Table structure for table `wp_nilai`
--

CREATE TABLE `wp_nilai` (
  `id_nilai` int(6) NOT NULL,
  `ket_nilai` varchar(45) NOT NULL,
  `jum_nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_nilai`
--

INSERT INTO `wp_nilai` (`id_nilai`, `ket_nilai`, `jum_nilai`) VALUES
(1, 'Sangat Tidak Penting', 1),
(2, 'Tidak Penting', 2),
(3, 'Penting', 3),
(4, 'Cukup Penting', 4),
(5, 'Sangat Penting', 5);

-- --------------------------------------------------------

--
-- Table structure for table `wp_pengguna`
--

CREATE TABLE `wp_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_pengguna`
--

INSERT INTO `wp_pengguna` (`id_pengguna`, `nama_lengkap`, `username`, `password`) VALUES
(1, 'Ii Safitri', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'Code Berkas', 'user', 'ee11cbb19052e40b07aac0ca060c23ee');

-- --------------------------------------------------------

--
-- Table structure for table `wp_rangking`
--

CREATE TABLE `wp_rangking` (
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_rangking` double NOT NULL,
  `nilai_normalisasi` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_alternatif`
--
ALTER TABLE `wp_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `wp_bobot`
--
ALTER TABLE `wp_bobot`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `wp_kriteria`
--
ALTER TABLE `wp_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `wp_nasabah`
--
ALTER TABLE `wp_nasabah`
  ADD PRIMARY KEY (`id_nasabah`);

--
-- Indexes for table `wp_nilai`
--
ALTER TABLE `wp_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `wp_pengguna`
--
ALTER TABLE `wp_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `wp_rangking`
--
ALTER TABLE `wp_rangking`
  ADD PRIMARY KEY (`id_alternatif`,`id_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_alternatif`
--
ALTER TABLE `wp_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_kriteria`
--
ALTER TABLE `wp_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wp_nasabah`
--
ALTER TABLE `wp_nasabah`
  MODIFY `id_nasabah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_nilai`
--
ALTER TABLE `wp_nilai`
  MODIFY `id_nilai` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wp_pengguna`
--
ALTER TABLE `wp_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wp_bobot`
--
ALTER TABLE `wp_bobot`
  ADD CONSTRAINT `wp_bobot_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `wp_kriteria` (`id_kriteria`);

--
-- Constraints for table `wp_rangking`
--
ALTER TABLE `wp_rangking`
  ADD CONSTRAINT `rangking_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `wp_alternatif` (`id_alternatif`),
  ADD CONSTRAINT `rangking_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `wp_kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
