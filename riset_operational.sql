-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 17 Mei 2015 pada 08.36
-- Versi Server: 5.5.32
-- Versi PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `riset_operational`
--
CREATE DATABASE IF NOT EXISTS `riset_operational` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `riset_operational`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `address` text,
  `ktp` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `organization_id` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `nama`, `email`, `phone`, `address`, `ktp`, `password`, `organization_id`) VALUES
(1, 'Addin Gama Bertaqwaa', 'punyagama@gmail.com', '087864517536', 'Sumbawa Besar', '5204082109900004', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(2, 'Ade Agus', 'tester@gmail.com', '087864517539', 'payakumbuh', '123456789', '$2y$10$6u0z6TIPIXJGMiq8rBDX/O3xK8SxJOWvlwQ5bRXBUC9HNI4s75OKO', 1),
(3, 'Syachrir Eka Putra', 'syachrir@gmail.com', '1', 'Payakumbuh', '1', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(4, 'Rachmi Hidayati', 'rachmi@gmail.com', '2', 'Payakumbuh', '2', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(5, 'Mayzar Annas', 'mayzar@gmail.com', '087864527958', 'Payakumbuh', '3', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(6, 'Sahdan Azhari', 'sahdan@gmail.com', '087864527958', 'Payakumbuh', '4', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(7, 'Putu Regi Pratama', 'regi@gmail.com', '087864527958', 'Payakumbuh', '5', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(8, 'Pratama Rinad', 'tama@gmail.com', '087864527958', 'Payakumbuh', '6', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(9, 'Rama DS', 'rama@gmail.com', '087864527958', 'Payakumbuh', '7', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(10, 'Khurniawan Eko', 'eko@gmail.com', '087864527958', 'Payakumbuh', '8', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(11, 'Ahmad Zafrullah', 'zaf@gmail.com', '087864527958', 'Payakumbuh', '9', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(12, 'Arief Taufiqurrahman', 'arief@gmail.com', '087864527958', 'Payakumbuh', '10', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(13, 'Susi Susanti', 'susi@gmail.com', '087864527958', 'Payakumbuh', '11', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(14, 'Bayu Wibisana', 'bayu@gmail.com', '087864527958', 'Payakumbuh', '12', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(15, 'Sari Ismi', 'sari@gmail.com', '087864527958', 'Payakumbuh', '13', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(16, 'Arif', 'arif@gmail.com', '087864527958', 'Payakumbuh', '14', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(17, 'Arga Fausta', 'arga@gmail.com', '087864527958', 'Payakumbuh', '15', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(18, 'Ahmad', 'ashahab28@gmail.com', '087883403928', 'Jl. Cisitu Indah No.144', '13512033', '$2y$10$SaEJ9g6swo4nu/FPTENKS.YHjZzdnNFoZNT5AsNXWBT7d96qsBEN6', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `image_metadata`
--

CREATE TABLE IF NOT EXISTS `image_metadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `srv_general`
--

CREATE TABLE IF NOT EXISTS `srv_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `token` varchar(45) NOT NULL DEFAULT '0',
  `status` int(1) DEFAULT NULL COMMENT 'status service execution',
  `comment` text,
  `customer_id` int(11) NOT NULL,
  `hasil_pembahasan` text,
  `hasil_survey` tinytext,
  `surat_izin` tinyint(4) DEFAULT NULL,
  `retribusi` int(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data untuk tabel `srv_general`
--

INSERT INTO `srv_general` (`id`, `service_id`, `token`, `status`, `comment`, `customer_id`, `hasil_pembahasan`, `hasil_survey`, `surat_izin`, `retribusi`, `created_at`, `updated_at`) VALUES
(1, 4, '45930782', 0, NULL, 3, NULL, NULL, NULL, 0, '2014-12-03 00:01:41', '2014-12-03 00:01:41'),
(2, 5, '79254013', 0, NULL, 3, NULL, NULL, NULL, 0, '2014-12-03 00:02:08', '2014-12-03 00:02:08'),
(3, 6, '91374286', 0, NULL, 3, NULL, NULL, NULL, 0, '2014-12-03 00:03:00', '2014-12-03 00:03:00'),
(4, 4, '83201549', 0, NULL, 4, NULL, NULL, NULL, 0, '2014-12-03 00:07:15', '2014-12-03 00:07:15'),
(5, 5, '32540897', 0, NULL, 4, NULL, NULL, NULL, 0, '2014-12-03 00:07:39', '2014-12-03 00:07:39'),
(6, 5, '36214975', 0, NULL, 4, NULL, NULL, NULL, 0, '2014-12-03 00:07:50', '2014-12-03 00:07:50'),
(7, 6, '48912637', 0, NULL, 4, NULL, NULL, NULL, 0, '2014-12-03 00:08:35', '2014-12-03 00:08:35'),
(8, 6, '41703269', 0, NULL, 6, NULL, NULL, NULL, 0, '2014-12-03 00:24:42', '2014-12-03 00:24:42'),
(9, 6, '08463217', 0, NULL, 7, NULL, NULL, NULL, 0, '2014-12-03 00:28:40', '2014-12-03 00:28:40'),
(10, 6, '07459326', 0, NULL, 8, NULL, NULL, NULL, 0, '2014-12-03 00:30:42', '2014-12-03 00:30:42'),
(11, 6, '34752186', 0, NULL, 9, NULL, NULL, NULL, 0, '2014-12-03 00:37:42', '2014-12-03 00:37:42'),
(12, 5, '76350982', 0, NULL, 9, NULL, NULL, NULL, 0, '2014-12-03 00:38:20', '2014-12-03 00:38:20'),
(13, 6, '85306927', 0, NULL, 10, NULL, NULL, NULL, 0, '2014-12-03 00:41:07', '2014-12-03 00:41:07'),
(14, 5, '89732614', 0, NULL, 10, NULL, NULL, NULL, 0, '2014-12-03 00:42:09', '2014-12-03 00:42:09'),
(15, 5, '86240951', 0, NULL, 10, NULL, NULL, NULL, 0, '2014-12-03 00:43:19', '2014-12-03 00:43:19'),
(16, 6, '94072365', 0, NULL, 11, NULL, NULL, NULL, 0, '2014-12-03 00:46:47', '2014-12-03 00:46:47'),
(17, 5, '84701269', 0, NULL, 11, NULL, NULL, NULL, 0, '2014-12-03 00:47:03', '2014-12-03 00:47:03'),
(18, 6, '15782493', 0, NULL, 12, NULL, NULL, NULL, 0, '2014-12-03 00:49:37', '2014-12-03 00:49:37'),
(19, 4, '68304759', 0, NULL, 12, NULL, NULL, NULL, 0, '2014-12-03 01:02:20', '2014-12-03 01:02:20'),
(20, 6, '38715460', 0, NULL, 13, NULL, NULL, NULL, 0, '2014-12-03 01:06:34', '2014-12-03 01:06:34'),
(21, 6, '52368490', 0, NULL, 14, NULL, NULL, NULL, 0, '2014-12-03 01:18:57', '2014-12-03 01:18:57'),
(22, 6, '53496072', 0, NULL, 15, NULL, NULL, NULL, 0, '2014-12-03 01:22:14', '2014-12-03 01:22:14'),
(23, 4, '46897250', 0, NULL, 16, NULL, NULL, NULL, 0, '2014-12-03 02:01:24', '2014-12-03 02:01:24'),
(24, 5, '23678159', 0, NULL, 16, NULL, NULL, NULL, 0, '2014-12-03 02:01:43', '2014-12-03 02:01:43'),
(25, 6, '58173926', 0, NULL, 16, NULL, NULL, NULL, 0, '2014-12-03 02:02:16', '2014-12-03 02:02:16'),
(26, 4, '36109457', 0, NULL, 17, NULL, NULL, NULL, 0, '2014-12-03 02:13:15', '2014-12-03 02:13:15'),
(27, 5, '82719365', 0, NULL, 17, NULL, NULL, NULL, 0, '2014-12-03 02:13:30', '2014-12-03 02:13:30'),
(28, 6, '93821405', 0, NULL, 17, NULL, NULL, NULL, 0, '2014-12-03 02:14:07', '2014-12-03 02:14:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `srv_pendirian_bangunan`
--

CREATE TABLE IF NOT EXISTS `srv_pendirian_bangunan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `token` varchar(45) NOT NULL DEFAULT '0',
  `status` int(1) DEFAULT NULL COMMENT 'status service execution',
  `comment` text,
  `customer_id` int(11) NOT NULL,
  `retribusi` int(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `hasil_survey` varchar(255) DEFAULT NULL,
  `status_keaslian_doc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `srv_praktek_dokter_umum`
--

CREATE TABLE IF NOT EXISTS `srv_praktek_dokter_umum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `token` varchar(45) NOT NULL DEFAULT '0',
  `status` int(1) DEFAULT NULL COMMENT 'status service execution',
  `comment` text,
  `customer_id` int(11) NOT NULL,
  `retribusi` int(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `hasil_pembahasan` text,
  `hasil_survey` tinytext,
  `surat_izin` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data untuk tabel `srv_praktek_dokter_umum`
--

INSERT INTO `srv_praktek_dokter_umum` (`id`, `service_id`, `token`, `status`, `comment`, `customer_id`, `retribusi`, `created_at`, `updated_at`, `hasil_pembahasan`, `hasil_survey`, `surat_izin`) VALUES
(1, 2, '14372056', 0, NULL, 1, 0, '2014-11-30 05:11:26', '2014-11-30 05:11:26', NULL, NULL, NULL),
(2, 2, '52174368', 0, NULL, 3, 0, '2014-12-03 00:01:22', '2014-12-03 00:01:22', NULL, NULL, NULL),
(3, 2, '80517936', 0, NULL, 4, 0, '2014-12-03 00:06:57', '2014-12-03 00:06:57', NULL, NULL, NULL),
(4, 2, '02736841', 0, NULL, 5, 0, '2014-12-03 00:21:13', '2014-12-03 00:21:13', NULL, NULL, NULL),
(5, 2, '24750391', 0, NULL, 6, 0, '2014-12-03 00:22:10', '2014-12-03 00:22:10', NULL, NULL, NULL),
(6, 2, '87140952', 0, NULL, 7, 0, '2014-12-03 00:26:53', '2014-12-03 00:26:53', NULL, NULL, NULL),
(7, 2, '27546098', 0, NULL, 8, 0, '2014-12-03 00:29:47', '2014-12-03 00:29:47', NULL, NULL, NULL),
(8, 2, '57216409', 0, NULL, 9, 0, '2014-12-03 00:33:47', '2014-12-03 00:33:47', NULL, NULL, NULL),
(9, 2, '59870432', 0, NULL, 10, 0, '2014-12-03 00:40:21', '2014-12-03 00:40:21', NULL, NULL, NULL),
(10, 2, '89061245', 0, NULL, 11, 0, '2014-12-03 00:45:38', '2014-12-03 00:45:38', NULL, NULL, NULL),
(11, 2, '81927504', 0, NULL, 12, 0, '2014-12-03 00:48:52', '2014-12-03 00:48:52', NULL, NULL, NULL),
(12, 2, '98716024', 0, NULL, 13, 0, '2014-12-03 01:05:35', '2014-12-03 01:05:35', NULL, NULL, NULL),
(13, 2, '08675132', 0, NULL, 14, 0, '2014-12-03 01:17:49', '2014-12-03 01:17:49', NULL, NULL, NULL),
(14, 2, '61598432', 0, NULL, 15, 0, '2014-12-03 01:21:31', '2014-12-03 01:21:31', NULL, NULL, NULL),
(15, 2, '39645721', 0, NULL, 16, 0, '2014-12-03 01:29:19', '2014-12-03 01:29:19', NULL, NULL, NULL),
(16, 2, '74518930', 0, NULL, 17, 0, '2014-12-03 02:12:47', '2014-12-03 02:12:47', NULL, NULL, NULL),
(17, 2, '24063578', 0, NULL, 18, 0, '2015-04-13 08:05:58', '2015-04-13 08:05:58', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `srv_warnet`
--

CREATE TABLE IF NOT EXISTS `srv_warnet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `token` varchar(45) NOT NULL DEFAULT '0',
  `status` int(1) DEFAULT NULL COMMENT 'status service execution',
  `comment` text,
  `customer_id` int(11) NOT NULL,
  `retribusi` int(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status_keaslian_doc` varchar(255) DEFAULT NULL,
  `hasil_survey` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `srv_warnet`
--

INSERT INTO `srv_warnet` (`id`, `service_id`, `token`, `status`, `comment`, `customer_id`, `retribusi`, `created_at`, `updated_at`, `status_keaslian_doc`, `hasil_survey`) VALUES
(8, 9, '05963124', 1, '', 1, 0, '2014-11-12 04:25:51', '2014-11-12 04:39:12', 'Asli', '05963124-BPSO-Hasil_Survey.pdf'),
(9, 9, '68350914', 0, NULL, 2, 0, '2014-11-14 00:05:23', '2014-11-14 00:05:23', NULL, NULL),
(10, 9, '72180495', 0, NULL, 1, 0, '2014-11-24 09:30:17', '2014-11-24 09:30:17', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
