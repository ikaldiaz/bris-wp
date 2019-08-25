-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Mar 2016 pada 09.34
-- Versi Server: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spk_wp`
--
CREATE DATABASE IF NOT EXISTS `spk_wp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `spk_wp`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_alternatif`
--

CREATE TABLE IF NOT EXISTS `wp_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(255) NOT NULL,
  `vektor_s` double NOT NULL,
  `vektor_v` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_bobot`
--

CREATE TABLE IF NOT EXISTS `wp_bobot` (
  `id_kriteria` int(11) NOT NULL,
  `nilai_bobot` double NOT NULL,
  `hasil_bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_kriteria`
--

CREATE TABLE IF NOT EXISTS `wp_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `tipe_kriteria` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_nilai`
--

CREATE TABLE IF NOT EXISTS `wp_nilai` (
  `id_nilai` int(6) NOT NULL,
  `ket_nilai` varchar(45) NOT NULL,
  `jum_nilai` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_pengguna`
--

CREATE TABLE IF NOT EXISTS `wp_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wp_pengguna`
--

INSERT INTO `wp_pengguna` (`id_pengguna`, `nama_lengkap`, `username`, `password`) VALUES
(1, 'T Ghazali', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'Code Berkas', 'user', 'ee11cbb19052e40b07aac0ca060c23ee');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_rangking`
--

CREATE TABLE IF NOT EXISTS `wp_rangking` (
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
  ADD PRIMARY KEY (`id_alternatif`,`id_kriteria`), ADD KEY `id_kriteria` (`id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_alternatif`
--
ALTER TABLE `wp_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `wp_kriteria`
--
ALTER TABLE `wp_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `wp_nilai`
--
ALTER TABLE `wp_nilai`
  MODIFY `id_nilai` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `wp_pengguna`
--
ALTER TABLE `wp_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `wp_bobot`
--
ALTER TABLE `wp_bobot`
ADD CONSTRAINT `wp_bobot_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `wp_kriteria` (`id_kriteria`);

--
-- Ketidakleluasaan untuk tabel `wp_rangking`
--
ALTER TABLE `wp_rangking`
ADD CONSTRAINT `rangking_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `wp_alternatif` (`id_alternatif`),
ADD CONSTRAINT `rangking_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `wp_kriteria` (`id_kriteria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
