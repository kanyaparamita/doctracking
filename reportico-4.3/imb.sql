-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2015 at 11:49 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imb`
--

-- --------------------------------------------------------

--
-- Table structure for table `kepala_dinas`
--

CREATE TABLE IF NOT EXISTS `kepala_dinas` (
  `NIP` varchar(50) NOT NULL,
  `nama_kpd` text NOT NULL,
  `kota_kpd` varchar(25) NOT NULL,
  PRIMARY KEY (`NIP`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kepala_dinas`
--

INSERT INTO `kepala_dinas` (`NIP`, `nama_kpd`, `kota_kpd`) VALUES
('1953020319', 'Drs. Yahya Samudra', 'manado');

-- --------------------------------------------------------

--
-- Table structure for table `pengaju`
--

CREATE TABLE IF NOT EXISTS `pengaju` (
  `no_ktp` int(25) NOT NULL,
  `nama` text NOT NULL,
  `lahir_tempat` varchar(25) NOT NULL,
  `lahir_tanggal` date NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`no_ktp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaju`
--

INSERT INTO `pengaju` (`no_ktp`, `nama`, `lahir_tempat`, `lahir_tanggal`, `pekerjaan`, `alamat`) VALUES
(2147483558, 'Ahmad Shahab', 'Bandung', '1995-11-28', 'Mahasiswa', 'Jalan Cisitu Indah no 14 Bandung'),
(2147483641, 'Kanya Paramita', 'Bandung', '1994-05-28', 'Mahasiswa', 'Jalan Tilil no 1 Bandung 40133');

-- --------------------------------------------------------

--
-- Table structure for table `surat_manado`
--

CREATE TABLE IF NOT EXISTS `surat_manado` (
  `no_surat` varchar(25) NOT NULL,
  `nama_pemohon` text NOT NULL,
  `alamat_pemohon` text NOT NULL,
  `nama_perusahaan` text NOT NULL,
  `alamat_perusahaan` text NOT NULL,
  `tanggal_berlaku` varchar(25) NOT NULL,
  `tanggal_surat` varchar(25) NOT NULL,
  PRIMARY KEY (`no_surat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_manado`
--

INSERT INTO `surat_manado` (`no_surat`, `nama_pemohon`, `alamat_pemohon`, `nama_perusahaan`, `alamat_perusahaan`, `tanggal_berlaku`, `tanggal_surat`) VALUES
('3/DP/001/XI/2011', 'Dinda Wahyu', 'Jl. Bunaken no 1 Manado 20355', 'PT. Selamat', 'Jl. Martadinata no 95 Manado 20223', '06 November 2012', '07 November 2011');

-- --------------------------------------------------------

--
-- Table structure for table `tipe`
--

CREATE TABLE IF NOT EXISTS `tipe` (
  `id` int(25) NOT NULL,
  `tipe` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
