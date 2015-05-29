-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 04, 2014 at 09:17 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `riset_doctrack`
--
CREATE DATABASE `riset_doctrack` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `riset_doctrack`;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_roles`
--

CREATE TABLE IF NOT EXISTS `assigned_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ar_user_id_idx` (`user_id`),
  KEY `fk_ar_role_id_idx` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `assigned_roles`
--

INSERT INTO `assigned_roles` (`id`, `user_id`, `role_id`) VALUES
(12, 12, 8),
(13, 13, 15),
(14, 14, 14),
(15, 15, 11),
(16, 16, 10),
(17, 17, 9),
(18, 18, 9),
(19, 19, 13),
(20, 20, 17),
(21, 21, 19),
(22, 22, 19),
(23, 23, 19),
(24, 24, 20),
(25, 25, 22),
(26, 26, 21),
(27, 27, 18);

-- --------------------------------------------------------

--
-- Table structure for table `base_process`
--

CREATE TABLE IF NOT EXISTS `base_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `pre_con_bp` varchar(30) DEFAULT NULL COMMENT 'bp yang sebagai syarat untuk proses ini.\\nberupa angka yang dipisahkan dengan ;\\ntanpa spasi\\n\\n2;34;2;',
  `next_bp_id` varchar(30) DEFAULT NULL COMMENT 'base proses selanjutnya',
  `unit_id` int(11) NOT NULL COMMENT 'Unit yang bertanggung jawab untuk proses ini',
  `roles` varchar(45) NOT NULL COMMENT 'Role yang dapat mengeksekusi proses ini. Berupa text yang dipisahkan dengan ; tanpa spasi\\n\\ntimanalis;surveyor;',
  `generate_form_pembayaran` int(1) DEFAULT '0' COMMENT 'Apakah base proses ini melakukan generate form pembayaran\\n',
  `generate_form_perizinan` int(1) DEFAULT '0' COMMENT 'Apakah base proses ini melakukan generate form perizinan\\n',
  `is_start` int(1) DEFAULT '0' COMMENT 'base proses pertama atau bukan.\\n1 : ya\\n0 : tidak',
  `is_checkpoint` int(1) DEFAULT '0' COMMENT 'Ini sebagai kondisi pemunculan tombol reject',
  `is_finish` int(1) DEFAULT '0' COMMENT '0 : tidak\\n1 : ya',
  `is_display` int(1) DEFAULT '1' COMMENT 'Apakah ditampilkan dalam tracking atau tidak',
  `display_text` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT 'No Name',
  `description` text,
  PRIMARY KEY (`id`),
  KEY `fk_service_id_idx` (`service_id`),
  KEY `fk_unit_i_idx` (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tahapan untuk sebuah service\n' AUTO_INCREMENT=50 ;

--
-- Dumping data for table `base_process`
--

INSERT INTO `base_process` (`id`, `service_id`, `pre_con_bp`, `next_bp_id`, `unit_id`, `roles`, `generate_form_pembayaran`, `generate_form_perizinan`, `is_start`, `is_checkpoint`, `is_finish`, `is_display`, `display_text`, `name`, `description`) VALUES
(2, 2, '', '3', 33, '9', NULL, NULL, 1, 1, NULL, 1, 'Penerimaan Berkas di Front Office', 'Penerimaan Berkas', 'Pemeriksaan Kelengkapan Berkas di Loket Pendaftaran'),
(3, 2, '2', '3', 33, '10', NULL, NULL, NULL, 1, NULL, 1, 'Pemeriksaan Berkas', 'Pemeriksaan Berkas', 'Memeriksa berkas permohonan Izin Operasional Kesehatan    , jika tidak setuju dikembalikan kepada Petugas Front Office untuk diperbaiki, jika setuju di paraf dan diserahkan kepada Kabid Pelayanan Terpadu'),
(4, 2, '3', '5', 25, '11', NULL, NULL, NULL, NULL, NULL, NULL, 'Penerimaan Berkas oleh Kabid', 'Follow Up Pengajuan', 'Menerima berkas permohonan Izin Operasional Kesehatan     dan memerintahkan Kasubbid Pengkajian dan Pengaduan untuk mempersiapkan bahan dan memerintahkan pelaksanaan rapat tim teknis dan survey lokasi'),
(5, 2, '4', '6', 32, '12', NULL, NULL, NULL, NULL, NULL, NULL, 'Pembagian Tugas Validasi', 'Pembagian Tugas Validasi', 'Mempersiapkan bahan rapat tim teknis dan survey lokasi'),
(6, 2, '5', '7', 34, '22', NULL, NULL, NULL, 1, NULL, 1, 'Pembahasan dan Survey Lokasi', 'Pembahasan dan Survey Lokasi', 'Melaksanakan rapat, survey lokasi, membahas dan mengkaji permohonan Izin Operasional Kesehatan    , jika tidak setuju maka ijin ditolak diserahkan kepada Kasubbid Pengkajian dan Pengaduan untuk selanjutnya diserahkan kepada Petugas Front Office untuk dikembalikan kepada pemohon, jika setuju diserahkan kepada Kasubbid Perizinan dan Non Perizinan'),
(7, 2, '6', '8', 33, '13', NULL, 1, NULL, NULL, NULL, 1, 'Pencetakan Surat Izin', 'Pencetakan Surat Izin', 'Mencetak Izin Operasional Kesehatan  dan diserahkan kepada Kasubbid Perizinan dan Non Perizinan'),
(8, 2, '7', '9', 33, '10', NULL, NULL, NULL, 1, NULL, NULL, 'Pemeriksaan Surat Izin', 'Pemeriksaan Surat Izin', 'Memeriksa Izin Operasional Kesehatan  yang telah di cetak, jika tidak setuju dikembalikan kepada Petugas Back Office untuk diperbaiki, jika setuju di paraf dan diserahkan kepada Kabid Pelayanan Terpadu'),
(9, 2, '10', '8', 25, '11', NULL, NULL, NULL, 1, NULL, NULL, 'Paraf Surat Izin 1', 'Paraf Surat Izin 1', 'Memeriksa berkas Izin Operasional Kesehatan , jika tidak setuju dikembalikan kepada Kasubbid Perizinan dan Non Perizinan untuk diperbaiki, jika setuju diparaf dan diserahkan kepada Sekretaris BPMD-PTSP'),
(10, 2, '9', '11', 18, '14', NULL, NULL, NULL, 1, NULL, NULL, 'Paraf Surat Izin 2', 'Paraf Surat Izin 2', 'Memeriksa berkas Izin Operasional Kesehatan    , jika tidak setuju dikembalikan kepada Kabid Pelayanan Terpadu untuk diperbaiki, jika setuju diparaf dan diserahkan kepada Kepala BPMD-PTSP'),
(11, 2, '10', '12', 17, '15', NULL, NULL, NULL, NULL, NULL, 1, 'Penandatanganan Surat Izin', 'Penandatanganan Surat Izin', 'Memeriksa berkas Izin Operasional Kesehatan, jika tidak setuju dikembalikan kepada Sekretaris BPMD-PTSP untuk diperbaiki, jika setuju ditandatangani dan diserahkan kepada Petugas Administrasi Umum'),
(12, 2, '13', '11', 33, '16', NULL, NULL, NULL, NULL, NULL, NULL, 'Pengarsipan', 'Pengarsipan', 'Mencatat dalam buku agenda, menstempel,  menggandakan, mengarsipkan dan diserahkan kepada Petugas Loket Penyerahan Izin'),
(13, 2, '12', '', 33, '17', NULL, NULL, NULL, NULL, 1, 1, 'Pengambilan Surat Izin', 'Pengambilan Berkas', 'Mencatat dalam buku agenda dan diserahkan kepada pemohon'),
(14, 4, '', '15', 33, '9', NULL, NULL, 1, 1, NULL, 1, 'Penerimaan Berkas di Front Office', 'Penerimaan Berkas', 'Pemeriksaan Kelengkapan Berkas di Loket Pendaftaran'),
(15, 4, '14', '16', 33, '10', NULL, NULL, NULL, 1, NULL, 1, 'Pemeriksaan Berkas', 'Pemeriksaan Berkas', 'Memeriksa berkas permohonan Izin Operasional Kesehatan    , jika tidak setuju dikembalikan kepada Petugas Front Office untuk diperbaiki, jika setuju di paraf dan diserahkan kepada Kabid Pelayanan Terpadu'),
(16, 4, '15', '17', 25, '11', NULL, NULL, NULL, NULL, NULL, NULL, 'Penerimaan Berkas oleh Kabid', 'Follow Up Pengajuan', 'Menerima berkas permohonan Izin Operasional Kesehatan     dan memerintahkan Kasubbid Pengkajian dan Pengaduan untuk mempersiapkan bahan dan memerintahkan pelaksanaan rapat tim teknis dan survey lokasi'),
(17, 4, '16', '18', 32, '12', NULL, NULL, NULL, NULL, NULL, NULL, 'Pembagian Tugas Validasi', 'Pembagian Tugas Validasi', 'Mempersiapkan bahan rapat tim teknis dan survey lokasi'),
(18, 4, '17', '19', 34, '22', NULL, NULL, NULL, 1, NULL, 1, 'Pembahasan dan Survey Lokasi', 'Pembahasan dan Survey Lokasi', 'Melaksanakan rapat, survey lokasi, membahas dan mengkaji permohonan Izin Operasional Kesehatan    , jika tidak setuju maka ijin ditolak diserahkan kepada Kasubbid Pengkajian dan Pengaduan untuk selanjutnya diserahkan kepada Petugas Front Office untuk dikembalikan kepada pemohon, jika setuju diserahkan kepada Kasubbid Perizinan dan Non Perizinan'),
(19, 4, '18', '20', 33, '13', NULL, 1, NULL, NULL, NULL, 1, 'Pencetakan Surat Izin', 'Pencetakan Surat Izin', 'Mencetak Izin Operasional Kesehatan  dan diserahkan kepada Kasubbid Perizinan dan Non Perizinan'),
(20, 4, '19', '21', 33, '10', NULL, NULL, NULL, 1, NULL, NULL, 'Pemeriksaan Surat Izin', 'Pemeriksaan Surat Izin', 'Memeriksa Izin Operasional Kesehatan  yang telah di cetak, jika tidak setuju dikembalikan kepada Petugas Back Office untuk diperbaiki, jika setuju di paraf dan diserahkan kepada Kabid Pelayanan Terpadu'),
(21, 4, '20', '22', 25, '11', NULL, NULL, NULL, 1, NULL, NULL, 'Paraf Surat Izin 1', 'Paraf Surat Izin 1', 'Memeriksa berkas Izin Operasional Kesehatan , jika tidak setuju dikembalikan kepada Kasubbid Perizinan dan Non Perizinan untuk diperbaiki, jika setuju diparaf dan diserahkan kepada Sekretaris BPMD-PTSP'),
(22, 4, '21', '23', 18, '14', NULL, NULL, NULL, 1, NULL, NULL, 'Paraf Surat Izin 2', 'Paraf Surat Izin 2', 'Memeriksa berkas Izin Operasional Kesehatan    , jika tidak setuju dikembalikan kepada Kabid Pelayanan Terpadu untuk diperbaiki, jika setuju diparaf dan diserahkan kepada Kepala BPMD-PTSP'),
(23, 4, '22', '24', 17, '15', NULL, NULL, NULL, NULL, NULL, 1, 'Penandatanganan Surat Izin', 'Penandatanganan Surat Izin', 'Memeriksa berkas Izin Operasional Kesehatan, jika tidak setuju dikembalikan kepada Sekretaris BPMD-PTSP untuk diperbaiki, jika setuju ditandatangani dan diserahkan kepada Petugas Administrasi Umum'),
(24, 4, '23', '25', 33, '16', NULL, NULL, NULL, NULL, NULL, NULL, 'Pengarsipan', 'Pengarsipan', 'Mencatat dalam buku agenda, menstempel,  menggandakan, mengarsipkan dan diserahkan kepada Petugas Loket Penyerahan Izin'),
(25, 4, '24', '', 33, '17', NULL, NULL, NULL, NULL, 1, 1, 'Pengambilan Surat Izin', 'Pengambilan Berkas', 'Mencatat dalam buku agenda dan diserahkan kepada pemohon'),
(26, 5, '', '27', 33, '9', NULL, NULL, 1, 1, NULL, 1, 'Penerimaan Berkas di Front Office', 'Penerimaan Berkas', 'Pemeriksaan Kelengkapan Berkas di Loket Pendaftaran'),
(27, 5, '26', '28', 33, '10', NULL, NULL, NULL, 1, NULL, 1, 'Pemeriksaan Berkas', 'Pemeriksaan Berkas', 'Memeriksa berkas permohonan Izin Operasional Kesehatan    , jika tidak setuju dikembalikan kepada Petugas Front Office untuk diperbaiki, jika setuju di paraf dan diserahkan kepada Kabid Pelayanan Terpadu'),
(28, 5, '27', '29', 25, '11', NULL, NULL, NULL, NULL, NULL, NULL, 'Penerimaan Berkas oleh Kabid', 'Follow Up Pengajuan', 'Menerima berkas permohonan Izin Operasional Kesehatan     dan memerintahkan Kasubbid Pengkajian dan Pengaduan untuk mempersiapkan bahan dan memerintahkan pelaksanaan rapat tim teknis dan survey lokasi'),
(29, 5, '28', '30', 32, '12', NULL, NULL, NULL, NULL, NULL, NULL, 'Pembagian Tugas Validasi', 'Pembagian Tugas Validasi', 'Mempersiapkan bahan rapat tim teknis dan survey lokasi'),
(30, 5, '29', '31', 34, '19', NULL, NULL, NULL, 1, NULL, 1, 'Pembahasan dan Survey Lokasi', 'Pembahasan dan Survey Lokasi', 'Melaksanakan rapat, survey lokasi, membahas dan mengkaji permohonan Izin Operasional Kesehatan    , jika tidak setuju maka ijin ditolak diserahkan kepada Kasubbid Pengkajian dan Pengaduan untuk selanjutnya diserahkan kepada Petugas Front Office untuk dikembalikan kepada pemohon, jika setuju diserahkan kepada Kasubbid Perizinan dan Non Perizinan'),
(31, 5, '30', '32', 33, '13', NULL, 1, NULL, NULL, NULL, 1, 'Pencetakan Surat Izin', 'Pencetakan Surat Izin', 'Mencetak Izin Operasional Kesehatan  dan diserahkan kepada Kasubbid Perizinan dan Non Perizinan'),
(32, 5, '31', '33', 33, '10', NULL, NULL, NULL, 1, NULL, NULL, 'Pemeriksaan Surat Izin', 'Pemeriksaan Surat Izin', 'Memeriksa Izin Operasional Kesehatan  yang telah di cetak, jika tidak setuju dikembalikan kepada Petugas Back Office untuk diperbaiki, jika setuju di paraf dan diserahkan kepada Kabid Pelayanan Terpadu'),
(33, 5, '32', '34', 25, '11', NULL, NULL, NULL, 1, NULL, NULL, 'Paraf Surat Izin 1', 'Paraf Surat Izin 1', 'Memeriksa berkas Izin Operasional Kesehatan , jika tidak setuju dikembalikan kepada Kasubbid Perizinan dan Non Perizinan untuk diperbaiki, jika setuju diparaf dan diserahkan kepada Sekretaris BPMD-PTSP'),
(34, 5, '33', '35', 18, '14', NULL, NULL, NULL, 1, NULL, NULL, 'Paraf Surat Izin 2', 'Paraf Surat Izin 2', 'Memeriksa berkas Izin Operasional Kesehatan    , jika tidak setuju dikembalikan kepada Kabid Pelayanan Terpadu untuk diperbaiki, jika setuju diparaf dan diserahkan kepada Kepala BPMD-PTSP'),
(35, 5, '34', '36', 17, '15', NULL, NULL, NULL, NULL, NULL, 1, 'Penandatanganan Surat Izin', 'Penandatanganan Surat Izin', 'Memeriksa berkas Izin Operasional Kesehatan, jika tidak setuju dikembalikan kepada Sekretaris BPMD-PTSP untuk diperbaiki, jika setuju ditandatangani dan diserahkan kepada Petugas Administrasi Umum'),
(36, 5, '35', '37', 33, '16', NULL, NULL, NULL, NULL, NULL, NULL, 'Pengarsipan', 'Pengarsipan', 'Mencatat dalam buku agenda, menstempel,  menggandakan, mengarsipkan dan diserahkan kepada Petugas Loket Penyerahan Izin'),
(37, 5, '36', '', 33, '17', NULL, NULL, NULL, NULL, 1, 1, 'Pengambilan Surat Izin', 'Pengambilan Berkas', 'Mencatat dalam buku agenda dan diserahkan kepada pemohon'),
(38, 6, '', '39', 33, '9', NULL, NULL, 1, 1, NULL, 1, 'Penerimaan Berkas di Front Office', 'Penerimaan Berkas', 'Pemeriksaan Kelengkapan Berkas di Loket Pendaftaran'),
(39, 6, '38', '40', 33, '10', NULL, NULL, NULL, 1, NULL, 1, 'Pemeriksaan Berkas', 'Pemeriksaan Berkas', 'Memeriksa berkas permohonan Izin Operasional Kesehatan    , jika tidak setuju dikembalikan kepada Petugas Front Office untuk diperbaiki, jika setuju di paraf dan diserahkan kepada Kabid Pelayanan Terpadu'),
(40, 6, '39', '41', 25, '11', NULL, NULL, NULL, NULL, NULL, NULL, 'Penerimaan Berkas oleh Kabid', 'Follow Up Pengajuan', 'Menerima berkas permohonan Izin Operasional Kesehatan     dan memerintahkan Kasubbid Pengkajian dan Pengaduan untuk mempersiapkan bahan dan memerintahkan pelaksanaan rapat tim teknis dan survey lokasi'),
(41, 6, '40', '42', 32, '12', NULL, NULL, NULL, NULL, NULL, NULL, 'Pembagian Tugas Validasi', 'Pembagian Tugas Validasi', 'Mempersiapkan bahan rapat tim teknis dan survey lokasi'),
(42, 6, '41', '43', 34, '22', NULL, NULL, NULL, 1, NULL, 1, 'Pembahasan dan Survey Lokasi', 'Pembahasan dan Survey Lokasi', 'Melaksanakan rapat, survey lokasi, membahas dan mengkaji permohonan Izin Operasional Kesehatan    , jika tidak setuju maka ijin ditolak diserahkan kepada Kasubbid Pengkajian dan Pengaduan untuk selanjutnya diserahkan kepada Petugas Front Office untuk dikembalikan kepada pemohon, jika setuju diserahkan kepada Kasubbid Perizinan dan Non Perizinan'),
(43, 6, '42', '44', 33, '13', NULL, 1, NULL, NULL, NULL, 1, 'Pencetakan Surat Izin', 'Pencetakan Surat Izin', 'Mencetak Izin Operasional Kesehatan  dan diserahkan kepada Kasubbid Perizinan dan Non Perizinan'),
(44, 6, '43', '45', 33, '10', NULL, NULL, NULL, 1, NULL, NULL, 'Pemeriksaan Surat Izin', 'Pemeriksaan Surat Izin', 'Memeriksa Izin Operasional Kesehatan  yang telah di cetak, jika tidak setuju dikembalikan kepada Petugas Back Office untuk diperbaiki, jika setuju di paraf dan diserahkan kepada Kabid Pelayanan Terpadu'),
(45, 6, '44', '46', 25, '11', NULL, NULL, NULL, 1, NULL, NULL, 'Paraf Surat Izin 1', 'Paraf Surat Izin 1', 'Memeriksa berkas Izin Operasional Kesehatan , jika tidak setuju dikembalikan kepada Kasubbid Perizinan dan Non Perizinan untuk diperbaiki, jika setuju diparaf dan diserahkan kepada Sekretaris BPMD-PTSP'),
(46, 6, '45', '47', 18, '14', NULL, NULL, NULL, 1, NULL, NULL, 'Paraf Surat Izin 2', 'Paraf Surat Izin 2', 'Memeriksa berkas Izin Operasional Kesehatan    , jika tidak setuju dikembalikan kepada Kabid Pelayanan Terpadu untuk diperbaiki, jika setuju diparaf dan diserahkan kepada Kepala BPMD-PTSP'),
(47, 6, '46', '48', 17, '15', NULL, NULL, NULL, NULL, NULL, 1, 'Penandatanganan Surat Izin', 'Penandatanganan Surat Izin', 'Memeriksa berkas Izin Operasional Kesehatan, jika tidak setuju dikembalikan kepada Sekretaris BPMD-PTSP untuk diperbaiki, jika setuju ditandatangani dan diserahkan kepada Petugas Administrasi Umum'),
(48, 6, '47', '49', 33, '16', NULL, NULL, NULL, NULL, NULL, NULL, 'Pengarsipan', 'Pengarsipan', 'Mencatat dalam buku agenda, menstempel,  menggandakan, mengarsipkan dan diserahkan kepada Petugas Loket Penyerahan Izin'),
(49, 6, '48', '', 33, '17', NULL, NULL, NULL, NULL, 1, 1, 'Pengambilan Surat Izin', 'Pengambilan Berkas', 'Mencatat dalam buku agenda dan diserahkan kepada pemohon');

-- --------------------------------------------------------

--
-- Table structure for table `base_process_output`
--

CREATE TABLE IF NOT EXISTS `base_process_output` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bp_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type_input` int(1) NOT NULL DEFAULT '1' COMMENT 'Ini jenis tipe field yang akan di generate. Terdapat 3 jenis\\n- file : untuk upload file\\n- input : untuk input berupa ketikan\\n- text : sekedar text, (informasi tertentu berupa tulisan) . Secara default, name akan menjadi isi dari informasi tersebut\\n\\nfile yang bisa di upload berupa pdf/jpeg',
  `type_output` int(1) NOT NULL DEFAULT '1',
  `is_required` int(1) NOT NULL DEFAULT '1',
  `field` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bpo_ti_id_idx` (`type_input`),
  KEY `fk_bpo_bp_id_idx` (`bp_id`),
  KEY `fk_bpo_to_id_idx` (`type_output`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Option hasil yang diharapkan dari base proses' AUTO_INCREMENT=14 ;

--
-- Dumping data for table `base_process_output`
--

INSERT INTO `base_process_output` (`id`, `bp_id`, `name`, `type_input`, `type_output`, `is_required`, `field`) VALUES
(1, 6, 'Hasil Pembahasan', 2, 3, 1, 'hasil_pembahasan'),
(2, 6, 'Hasil Survey', 1, 1, 1, 'hasil_survey'),
(3, 12, 'Surat Izin', 1, 1, 1, 'surat_izin'),
(4, 18, 'Hasil Pembahasan', 2, 3, 1, 'hasil_pembahasan'),
(5, 18, 'Hasil Survey', 1, 1, 1, 'hasil_survey'),
(6, 24, 'Surat Izin', 1, 1, 1, 'surat_izin'),
(7, 30, 'Hasil Pembahasan', 2, 3, 1, 'hasil_pembahasan'),
(8, 30, 'Hasil Survey', 1, 1, 1, 'hasil_survey'),
(9, 36, 'Surat Izin', 1, 1, 1, 'surat_izin'),
(10, 42, 'Hasil Pembahasan', 2, 3, 1, 'hasil_pembahasan'),
(11, 42, 'Hasil Survey', 1, 1, 1, 'hasil_survey'),
(12, 48, 'Surat Izin', 1, 1, 1, 'surat_izin'),
(13, 49, 'Retribusi (RP)', 2, 3, 0, 'retribusi');

-- --------------------------------------------------------

--
-- Table structure for table `base_process_state`
--

CREATE TABLE IF NOT EXISTS `base_process_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bp_id` int(11) DEFAULT NULL,
  `se_id` int(11) NOT NULL COMMENT 'service execution id',
  `service_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 : waiting\\n1 : inprogress\\n2 : finish',
  `started_by` int(11) DEFAULT NULL,
  `started_time` datetime NOT NULL,
  `finished_by` int(11) DEFAULT NULL,
  `finished_time` datetime NOT NULL,
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `fk_bp_id_idx` (`bp_id`),
  KEY `fk_service_id_idx` (`service_id`),
  KEY `fk_started_by_idx` (`started_by`),
  KEY `fk_finished_by_idx` (`finished_by`),
  KEY `fk_se_id_idx` (`se_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='status eksekusi dari  base proses' AUTO_INCREMENT=104 ;

--
-- Dumping data for table `base_process_state`
--

INSERT INTO `base_process_state` (`id`, `bp_id`, `se_id`, `service_id`, `status`, `started_by`, `started_time`, `finished_by`, `finished_time`, `comment`) VALUES
(1, 2, 1, 2, 2, 17, '2014-11-30 05:11:17', 17, '2014-11-30 05:11:12', NULL),
(2, 2, 2, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(3, 3, 1, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(4, 2, 3, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(5, 14, 4, 4, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(6, 26, 5, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(7, 38, 6, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(8, 2, 7, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(9, 14, 8, 4, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(10, 26, 9, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(11, 26, 10, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(12, 38, 11, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(13, 2, 12, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(14, 2, 13, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(15, 38, 14, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(16, 2, 15, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(17, 38, 16, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(18, 2, 17, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(19, 38, 18, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(20, 2, 19, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(21, 38, 20, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(22, 26, 21, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(23, 2, 22, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(24, 38, 23, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(25, 26, 24, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(26, 26, 25, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(27, 2, 26, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(28, 38, 27, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(29, 26, 28, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(30, 2, 29, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(31, 38, 30, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(32, 14, 31, 4, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(33, 2, 32, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(34, 38, 33, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(35, 2, 34, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(36, 38, 35, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(37, 2, 36, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(38, 38, 37, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(39, 2, 38, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(40, 14, 39, 4, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(41, 26, 40, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(42, 38, 41, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(43, 2, 42, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(44, 14, 43, 4, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(45, 26, 44, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(46, 38, 45, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(47, 2, 46, 2, 2, 17, '2014-11-30 05:11:17', 17, '2014-11-30 05:11:12', NULL),
(48, 2, 47, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(49, 3, 46, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(50, 2, 48, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(51, 14, 49, 4, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(52, 26, 50, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(53, 38, 51, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(54, 2, 52, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(55, 14, 53, 4, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(56, 26, 54, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(57, 26, 55, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(58, 38, 56, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(59, 2, 57, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(60, 2, 58, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(61, 38, 59, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(62, 2, 60, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(63, 38, 61, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(64, 2, 62, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(65, 38, 63, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(66, 2, 64, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(67, 38, 65, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(68, 26, 66, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(69, 2, 67, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(70, 38, 68, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(71, 26, 69, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(72, 26, 70, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(73, 2, 71, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(74, 38, 72, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(75, 26, 73, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(76, 2, 74, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(77, 38, 75, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(78, 14, 76, 4, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(79, 2, 77, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(80, 38, 78, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(81, 2, 79, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(82, 38, 80, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(83, 2, 81, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(84, 38, 82, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(85, 2, 83, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(86, 14, 84, 4, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(87, 26, 85, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(88, 38, 86, 6, 3, 12, '2014-12-04 08:12:23', 12, '2014-12-04 08:12:23', 'test'),
(89, 2, 87, 2, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(90, 14, 88, 4, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(91, 26, 89, 5, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(92, 38, 90, 6, 0, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL),
(93, 39, 86, 6, 3, 12, '2014-12-04 08:12:38', 12, '2014-12-04 08:12:38', 'super user'),
(94, 40, 86, 6, 3, 12, '2014-12-04 08:12:53', 12, '2014-12-04 08:12:53', 'super user'),
(95, 41, 86, 6, 3, 12, '2014-12-04 08:12:03', 12, '2014-12-04 08:12:03', 'super user'),
(96, 42, 86, 6, 3, 12, '2014-12-04 08:12:15', 12, '2014-12-04 08:12:15', 'super user'),
(97, 43, 86, 6, 3, 12, '2014-12-04 08:12:43', 12, '2014-12-04 08:12:43', 'super user'),
(98, 44, 86, 6, 3, 12, '2014-12-04 08:12:54', 12, '2014-12-04 08:12:54', 'super user'),
(99, 45, 86, 6, 3, 12, '2014-12-04 08:12:03', 12, '2014-12-04 08:12:03', 'super user'),
(100, 46, 86, 6, 3, 12, '2014-12-04 08:12:15', 12, '2014-12-04 08:12:15', 'super user'),
(101, 47, 86, 6, 3, 12, '2014-12-04 08:12:25', 12, '2014-12-04 08:12:25', 'super user'),
(102, 48, 86, 6, 3, 12, '2014-12-04 08:12:35', 12, '2014-12-04 08:12:35', 'super user'),
(103, 49, 86, 6, 3, 12, '2014-12-04 08:12:18', 12, '2014-12-04 08:12:18', 'super user');

-- --------------------------------------------------------

--
-- Table structure for table `base_process_state_output`
--

CREATE TABLE IF NOT EXISTS `base_process_state_output` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `se_id` int(11) DEFAULT NULL,
  `bps_id` int(11) DEFAULT NULL,
  `bpo_id` int(11) DEFAULT NULL,
  `data` text,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bpso_bps_id_idx` (`bps_id`),
  KEY `fk_bpso_se_id_idx` (`se_id`),
  KEY `fk_bpso_bpo_id_idx` (`bpo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='data yang dihasilkan dari base proses, requirement outputnya berdasarkan dari base_process_output' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT 'Nama lengkap organisasi yang menggunakan',
  `nick` varchar(45) DEFAULT 'Org' COMMENT 'Singkatan untuk nama',
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `nick`, `email`, `phone`, `website`, `address`) VALUES
(1, 'Badan Penanaman Modal Daerah dan Pelayanan Terpadu Satu Pintu', 'BPM-PTSP', 'bpmdptsp_payakumbuh@yahoo.co.id', '(0752)94474', 'www.kppt-kotapayakumbuh.org', 'Jl. Jambu Kompl.Pasar Ibuh Kota Payakumbuh');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pr_role_id` (`role_id`),
  KEY `fk_pr_permission_id_idx` (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(83, 8, 9),
(84, 8, 10),
(85, 8, 11),
(86, 8, 12),
(87, 8, 13),
(88, 8, 14),
(89, 9, 15),
(90, 8, 15),
(91, 12, 15),
(92, 8, 16),
(93, 8, 17),
(94, 8, 18),
(95, 8, 20),
(96, 8, 21),
(97, 8, 22),
(110, 9, 8),
(111, 10, 8),
(112, 11, 8),
(113, 3, 8),
(114, 4, 8),
(115, 2, 8),
(116, 1, 8),
(117, 12, 8),
(118, 7, 8),
(119, 5, 8),
(120, 6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `display_name` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'manage_user', 'Master Data - Users', NULL, NULL),
(2, 'manage_unit', 'Master Data - Units', NULL, NULL),
(3, 'manage_position', 'Master Data - Positions', NULL, NULL),
(4, 'manage_role', 'Master Data - Roles', NULL, NULL),
(5, 'manage_requirement', 'Tracking Data - Requirements', NULL, NULL),
(6, 'manage_service', 'Tracking Data - Services', NULL, NULL),
(7, 'manage_file', 'Tracking Data - Manage Files', NULL, NULL),
(8, 'dashboard_process', 'Dashboard - Proses', NULL, NULL),
(9, 'dashboard_admin', 'Dashboard - Admin', NULL, NULL),
(10, 'dashboard_superuser', 'Dashboard - Super User', NULL, NULL),
(11, 'manage_setting', 'Manage - Setting', NULL, NULL),
(12, 'manage_chart', 'Tracking Data - Chart', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `fk_position_organization_id_idx` (`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `organization_id`, `name`, `description`) VALUES
(1, 1, 'Kepala', 'Kepala'),
(2, 1, 'Sekretaris', 'Sekretaris Kepala'),
(3, 1, 'Kabid', 'Kepala Bidang'),
(4, 1, 'Kasubbag', 'Kepala Sub Bagian'),
(5, 1, 'Anggota', 'Anggota yang levelnya berada di dalam naungan sebuah unit');

-- --------------------------------------------------------

--
-- Table structure for table `requirement_storages`
--

CREATE TABLE IF NOT EXISTS `requirement_storages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requirement_id` int(11) DEFAULT NULL COMMENT 'storage untuk requirement yang mana',
  `se_id` int(11) NOT NULL,
  `data` text,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_requirement_id_idx` (`requirement_id`),
  KEY `fk_rs_se_id_idx` (`se_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabel penyimpanan data upload dari pemohon, list data yang dibutuhkan berdasarkan tabel service_requirements' AUTO_INCREMENT=144 ;

--
-- Dumping data for table `requirement_storages`
--

INSERT INTO `requirement_storages` (`id`, `requirement_id`, `se_id`, `data`, `updated_at`, `created_at`) VALUES
(1, 2, 1, '14372056-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-11-30 05:11:25', '2014-11-30 05:11:25'),
(2, 3, 1, '14372056-Requirement-Ijazah.pdf', '2014-11-30 05:11:26', '2014-11-30 05:11:26'),
(3, 4, 1, '14372056-Requirement-Surat_Rekomendasi.pdf', '2014-11-30 05:11:26', '2014-11-30 05:11:26'),
(4, 5, 1, '14372056-Requirement-Surat_Rekomendasi.pdf', '2014-11-30 05:11:26', '2014-11-30 05:11:26'),
(5, 2, 3, '52174368-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 00:01:21', '2014-12-03 00:01:21'),
(6, 3, 3, '52174368-Requirement-Ijazah.pdf', '2014-12-03 00:01:22', '2014-12-03 00:01:22'),
(7, 4, 3, '52174368-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:01:22', '2014-12-03 00:01:22'),
(8, 5, 3, '52174368-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:01:22', '2014-12-03 00:01:22'),
(9, 6, 6, '91374286-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 00:02:57', '2014-12-03 00:02:57'),
(10, 7, 6, '91374286-Requirement-Surat_surat_tanah.pdf', '2014-12-03 00:02:58', '2014-12-03 00:02:58'),
(11, 8, 6, '91374286-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 00:02:59', '2014-12-03 00:02:59'),
(12, 9, 6, '91374286-Requirement-Dokumen_AMDAL.pdf', '2014-12-03 00:02:59', '2014-12-03 00:02:59'),
(13, 10, 6, '91374286-Requirement-Dokumen_UKL_UPL.pdf', '2014-12-03 00:02:59', '2014-12-03 00:02:59'),
(14, 11, 6, '91374286-Requirement-KTP.jpg', '2014-12-03 00:02:59', '2014-12-03 00:02:59'),
(15, 12, 6, '91374286-Requirement-KTP.jpg', '2014-12-03 00:03:00', '2014-12-03 00:03:00'),
(16, 2, 7, '80517936-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 00:06:55', '2014-12-03 00:06:55'),
(17, 3, 7, '80517936-Requirement-Ijazah.pdf', '2014-12-03 00:06:56', '2014-12-03 00:06:56'),
(18, 4, 7, '80517936-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:06:56', '2014-12-03 00:06:56'),
(19, 5, 7, '80517936-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:06:57', '2014-12-03 00:06:57'),
(20, 6, 11, '48912637-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 00:08:34', '2014-12-03 00:08:34'),
(21, 7, 11, '48912637-Requirement-Surat_surat_tanah.pdf', '2014-12-03 00:08:34', '2014-12-03 00:08:34'),
(22, 8, 11, '48912637-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 00:08:34', '2014-12-03 00:08:34'),
(23, 9, 11, '48912637-Requirement-Dokumen_AMDAL.pdf', '2014-12-03 00:08:34', '2014-12-03 00:08:34'),
(24, 10, 11, '48912637-Requirement-Dokumen_UKL_UPL.pdf', '2014-12-03 00:08:35', '2014-12-03 00:08:35'),
(25, 11, 11, '48912637-Requirement-KTP.jpg', '2014-12-03 00:08:35', '2014-12-03 00:08:35'),
(26, 12, 11, '48912637-Requirement-KTP.jpg', '2014-12-03 00:08:35', '2014-12-03 00:08:35'),
(27, 2, 12, '02736841-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 00:21:12', '2014-12-03 00:21:12'),
(28, 3, 12, '02736841-Requirement-Ijazah.pdf', '2014-12-03 00:21:12', '2014-12-03 00:21:12'),
(29, 4, 12, '02736841-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:21:12', '2014-12-03 00:21:12'),
(30, 5, 12, '02736841-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:21:12', '2014-12-03 00:21:12'),
(31, 2, 13, '24750391-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 00:22:10', '2014-12-03 00:22:10'),
(32, 3, 13, '24750391-Requirement-Ijazah.pdf', '2014-12-03 00:22:10', '2014-12-03 00:22:10'),
(33, 4, 13, '24750391-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:22:10', '2014-12-03 00:22:10'),
(34, 5, 13, '24750391-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:22:10', '2014-12-03 00:22:10'),
(35, 6, 14, '41703269-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 00:24:41', '2014-12-03 00:24:41'),
(36, 7, 14, '41703269-Requirement-Surat_surat_tanah.pdf', '2014-12-03 00:24:41', '2014-12-03 00:24:41'),
(37, 8, 14, '41703269-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 00:24:41', '2014-12-03 00:24:41'),
(38, 11, 14, '41703269-Requirement-KTP.jpg', '2014-12-03 00:24:42', '2014-12-03 00:24:42'),
(39, 12, 14, '41703269-Requirement-KTP.jpg', '2014-12-03 00:24:42', '2014-12-03 00:24:42'),
(40, 2, 15, '87140952-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 00:26:53', '2014-12-03 00:26:53'),
(41, 3, 15, '87140952-Requirement-Ijazah.pdf', '2014-12-03 00:26:53', '2014-12-03 00:26:53'),
(42, 4, 15, '87140952-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:26:53', '2014-12-03 00:26:53'),
(43, 5, 15, '87140952-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:26:53', '2014-12-03 00:26:53'),
(44, 6, 16, '08463217-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 00:28:37', '2014-12-03 00:28:37'),
(45, 7, 16, '08463217-Requirement-Surat_surat_tanah.pdf', '2014-12-03 00:28:37', '2014-12-03 00:28:37'),
(46, 8, 16, '08463217-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 00:28:38', '2014-12-03 00:28:38'),
(47, 9, 16, '08463217-Requirement-Dokumen_AMDAL.pdf', '2014-12-03 00:28:38', '2014-12-03 00:28:38'),
(48, 10, 16, '08463217-Requirement-Dokumen_UKL_UPL.pdf', '2014-12-03 00:28:39', '2014-12-03 00:28:39'),
(49, 11, 16, '08463217-Requirement-KTP.jpg', '2014-12-03 00:28:39', '2014-12-03 00:28:39'),
(50, 12, 16, '08463217-Requirement-KTP.jpg', '2014-12-03 00:28:39', '2014-12-03 00:28:39'),
(51, 2, 17, '27546098-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 00:29:46', '2014-12-03 00:29:46'),
(52, 3, 17, '27546098-Requirement-Ijazah.pdf', '2014-12-03 00:29:46', '2014-12-03 00:29:46'),
(53, 4, 17, '27546098-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:29:47', '2014-12-03 00:29:47'),
(54, 5, 17, '27546098-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:29:47', '2014-12-03 00:29:47'),
(55, 6, 18, '07459326-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 00:30:41', '2014-12-03 00:30:41'),
(56, 7, 18, '07459326-Requirement-Surat_surat_tanah.pdf', '2014-12-03 00:30:41', '2014-12-03 00:30:41'),
(57, 8, 18, '07459326-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 00:30:41', '2014-12-03 00:30:41'),
(58, 11, 18, '07459326-Requirement-KTP.jpg', '2014-12-03 00:30:41', '2014-12-03 00:30:41'),
(59, 12, 18, '07459326-Requirement-KTP.jpg', '2014-12-03 00:30:42', '2014-12-03 00:30:42'),
(60, 2, 19, '57216409-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 00:33:47', '2014-12-03 00:33:47'),
(61, 3, 19, '57216409-Requirement-Ijazah.pdf', '2014-12-03 00:33:47', '2014-12-03 00:33:47'),
(62, 4, 19, '57216409-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:33:47', '2014-12-03 00:33:47'),
(63, 5, 19, '57216409-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:33:47', '2014-12-03 00:33:47'),
(64, 6, 20, '34752186-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 00:37:40', '2014-12-03 00:37:40'),
(65, 7, 20, '34752186-Requirement-Surat_surat_tanah.pdf', '2014-12-03 00:37:40', '2014-12-03 00:37:40'),
(66, 8, 20, '34752186-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 00:37:41', '2014-12-03 00:37:41'),
(67, 11, 20, '34752186-Requirement-KTP.jpg', '2014-12-03 00:37:41', '2014-12-03 00:37:41'),
(68, 12, 20, '34752186-Requirement-KTP.jpg', '2014-12-03 00:37:42', '2014-12-03 00:37:42'),
(69, 2, 22, '59870432-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 00:40:19', '2014-12-03 00:40:19'),
(70, 3, 22, '59870432-Requirement-Ijazah.pdf', '2014-12-03 00:40:20', '2014-12-03 00:40:20'),
(71, 4, 22, '59870432-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:40:20', '2014-12-03 00:40:20'),
(72, 5, 22, '59870432-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:40:20', '2014-12-03 00:40:20'),
(73, 6, 23, '85306927-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 00:41:06', '2014-12-03 00:41:06'),
(74, 7, 23, '85306927-Requirement-Surat_surat_tanah.pdf', '2014-12-03 00:41:07', '2014-12-03 00:41:07'),
(75, 8, 23, '85306927-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 00:41:07', '2014-12-03 00:41:07'),
(76, 9, 23, '85306927-Requirement-Dokumen_AMDAL.pdf', '2014-12-03 00:41:07', '2014-12-03 00:41:07'),
(77, 11, 23, '85306927-Requirement-KTP.jpg', '2014-12-03 00:41:07', '2014-12-03 00:41:07'),
(78, 12, 23, '85306927-Requirement-KTP.jpg', '2014-12-03 00:41:07', '2014-12-03 00:41:07'),
(79, 2, 26, '89061245-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 00:45:36', '2014-12-03 00:45:36'),
(80, 3, 26, '89061245-Requirement-Ijazah.pdf', '2014-12-03 00:45:37', '2014-12-03 00:45:37'),
(81, 4, 26, '89061245-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:45:38', '2014-12-03 00:45:38'),
(82, 5, 26, '89061245-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:45:38', '2014-12-03 00:45:38'),
(83, 6, 27, '94072365-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 00:46:47', '2014-12-03 00:46:47'),
(84, 7, 27, '94072365-Requirement-Surat_surat_tanah.pdf', '2014-12-03 00:46:47', '2014-12-03 00:46:47'),
(85, 8, 27, '94072365-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 00:46:47', '2014-12-03 00:46:47'),
(86, 11, 27, '94072365-Requirement-KTP.jpg', '2014-12-03 00:46:47', '2014-12-03 00:46:47'),
(87, 12, 27, '94072365-Requirement-KTP.jpg', '2014-12-03 00:46:47', '2014-12-03 00:46:47'),
(88, 2, 29, '81927504-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 00:48:50', '2014-12-03 00:48:50'),
(89, 3, 29, '81927504-Requirement-Ijazah.pdf', '2014-12-03 00:48:51', '2014-12-03 00:48:51'),
(90, 4, 29, '81927504-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:48:51', '2014-12-03 00:48:51'),
(91, 5, 29, '81927504-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 00:48:51', '2014-12-03 00:48:51'),
(92, 6, 30, '15782493-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 00:49:36', '2014-12-03 00:49:36'),
(93, 7, 30, '15782493-Requirement-Surat_surat_tanah.pdf', '2014-12-03 00:49:36', '2014-12-03 00:49:36'),
(94, 8, 30, '15782493-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 00:49:36', '2014-12-03 00:49:36'),
(95, 11, 30, '15782493-Requirement-KTP.jpg', '2014-12-03 00:49:36', '2014-12-03 00:49:36'),
(96, 12, 30, '15782493-Requirement-KTP.jpg', '2014-12-03 00:49:36', '2014-12-03 00:49:36'),
(97, 2, 32, '98716024-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 01:05:35', '2014-12-03 01:05:35'),
(98, 3, 32, '98716024-Requirement-Ijazah.pdf', '2014-12-03 01:05:35', '2014-12-03 01:05:35'),
(99, 4, 32, '98716024-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 01:05:35', '2014-12-03 01:05:35'),
(100, 5, 32, '98716024-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 01:05:35', '2014-12-03 01:05:35'),
(101, 6, 33, '38715460-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 01:06:32', '2014-12-03 01:06:32'),
(102, 7, 33, '38715460-Requirement-Surat_surat_tanah.pdf', '2014-12-03 01:06:32', '2014-12-03 01:06:32'),
(103, 8, 33, '38715460-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 01:06:33', '2014-12-03 01:06:33'),
(104, 11, 33, '38715460-Requirement-KTP.jpg', '2014-12-03 01:06:33', '2014-12-03 01:06:33'),
(105, 12, 33, '38715460-Requirement-KTP.jpg', '2014-12-03 01:06:34', '2014-12-03 01:06:34'),
(106, 2, 34, '08675132-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 01:17:48', '2014-12-03 01:17:48'),
(107, 3, 34, '08675132-Requirement-Ijazah.pdf', '2014-12-03 01:17:48', '2014-12-03 01:17:48'),
(108, 4, 34, '08675132-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 01:17:48', '2014-12-03 01:17:48'),
(109, 5, 34, '08675132-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 01:17:49', '2014-12-03 01:17:49'),
(110, 6, 35, '52368490-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 01:18:56', '2014-12-03 01:18:56'),
(111, 7, 35, '52368490-Requirement-Surat_surat_tanah.pdf', '2014-12-03 01:18:56', '2014-12-03 01:18:56'),
(112, 8, 35, '52368490-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 01:18:56', '2014-12-03 01:18:56'),
(113, 11, 35, '52368490-Requirement-KTP.jpg', '2014-12-03 01:18:57', '2014-12-03 01:18:57'),
(114, 12, 35, '52368490-Requirement-KTP.jpg', '2014-12-03 01:18:57', '2014-12-03 01:18:57'),
(115, 2, 36, '61598432-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 01:21:31', '2014-12-03 01:21:31'),
(116, 3, 36, '61598432-Requirement-Ijazah.pdf', '2014-12-03 01:21:31', '2014-12-03 01:21:31'),
(117, 4, 36, '61598432-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 01:21:31', '2014-12-03 01:21:31'),
(118, 5, 36, '61598432-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 01:21:31', '2014-12-03 01:21:31'),
(119, 6, 37, '53496072-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 01:22:13', '2014-12-03 01:22:13'),
(120, 7, 37, '53496072-Requirement-Surat_surat_tanah.pdf', '2014-12-03 01:22:14', '2014-12-03 01:22:14'),
(121, 8, 37, '53496072-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 01:22:14', '2014-12-03 01:22:14'),
(122, 11, 37, '53496072-Requirement-KTP.jpg', '2014-12-03 01:22:14', '2014-12-03 01:22:14'),
(123, 12, 37, '53496072-Requirement-KTP.jpg', '2014-12-03 01:22:14', '2014-12-03 01:22:14'),
(124, 2, 38, '39645721-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 01:29:18', '2014-12-03 01:29:18'),
(125, 3, 38, '39645721-Requirement-Ijazah.pdf', '2014-12-03 01:29:18', '2014-12-03 01:29:18'),
(126, 4, 38, '39645721-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 01:29:18', '2014-12-03 01:29:18'),
(127, 5, 38, '39645721-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 01:29:18', '2014-12-03 01:29:18'),
(128, 6, 41, '58173926-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 02:02:15', '2014-12-03 02:02:15'),
(129, 7, 41, '58173926-Requirement-Surat_surat_tanah.pdf', '2014-12-03 02:02:15', '2014-12-03 02:02:15'),
(130, 8, 41, '58173926-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 02:02:15', '2014-12-03 02:02:15'),
(131, 11, 41, '58173926-Requirement-KTP.jpg', '2014-12-03 02:02:15', '2014-12-03 02:02:15'),
(132, 12, 41, '58173926-Requirement-KTP.jpg', '2014-12-03 02:02:15', '2014-12-03 02:02:15'),
(133, 2, 42, '74518930-Requirement-Surat_Tanda_Registrasi__STR_.pdf', '2014-12-03 02:12:45', '2014-12-03 02:12:45'),
(134, 3, 42, '74518930-Requirement-Ijazah.pdf', '2014-12-03 02:12:46', '2014-12-03 02:12:46'),
(135, 4, 42, '74518930-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 02:12:46', '2014-12-03 02:12:46'),
(136, 5, 42, '74518930-Requirement-Surat_Rekomendasi.pdf', '2014-12-03 02:12:47', '2014-12-03 02:12:47'),
(137, 6, 45, '93821405-Requirement-Advice_Planning___KRK.pdf', '2014-12-03 02:14:06', '2014-12-03 02:14:06'),
(138, 7, 45, '93821405-Requirement-Surat_surat_tanah.pdf', '2014-12-03 02:14:06', '2014-12-03 02:14:06'),
(139, 8, 45, '93821405-Requirement-Dokumen_Rencana_Teknis.zip', '2014-12-03 02:14:06', '2014-12-03 02:14:06'),
(140, 9, 45, '93821405-Requirement-Dokumen_AMDAL.pdf', '2014-12-03 02:14:06', '2014-12-03 02:14:06'),
(141, 10, 45, '93821405-Requirement-Dokumen_UKL_UPL.pdf', '2014-12-03 02:14:06', '2014-12-03 02:14:06'),
(142, 11, 45, '93821405-Requirement-KTP.jpg', '2014-12-03 02:14:06', '2014-12-03 02:14:06'),
(143, 12, 45, '93821405-Requirement-KTP.jpg', '2014-12-03 02:14:07', '2014-12-03 02:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE IF NOT EXISTS `requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `value`) VALUES
(1, 'KTP'),
(2, 'Foto Pengaju'),
(3, 'Scan SITU/Ho'),
(4, 'Daftar isian fasilitas usaha'),
(6, 'Kartu Keluarga'),
(7, 'Scan Akta Pendirian'),
(8, 'Scan NPWP'),
(9, 'Neraca'),
(10, 'SK Menkumham/Menkop'),
(11, 'Data Akta'),
(12, 'Advice Planning / KRK'),
(13, 'Surat-surat tanah'),
(14, 'Dokumen Rencana Teknis'),
(15, 'Dokumen AMDAL'),
(16, 'Dokumen UKL/UPL'),
(17, 'Bukti Lunas PBB'),
(18, 'Lainnya'),
(19, 'Surat Tanda Registrasi (STR)'),
(20, 'Ijazah'),
(21, 'Surat Rekomendasi'),
(22, 'Materai Rp. 6.000,-');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` tinytext,
  `organization_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `organization_id` (`organization_id`),
  KEY `fk_organization_id_idx` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `organization_id`) VALUES
(8, 'Super User', NULL, NULL),
(9, 'Front Office', NULL, NULL),
(10, 'Kasubbid Pelayanan Perizinan dan Non Perizinan', NULL, NULL),
(11, 'Kabid Pelayanan Terpadu', NULL, NULL),
(12, 'Kasubbid Pengkajian dan Pengaduan', NULL, NULL),
(13, 'Back Office', NULL, NULL),
(14, 'Sekretaris BPMD-PTSP', NULL, NULL),
(15, 'Kepala BPMD-PTSP', NULL, NULL),
(16, 'Administrasi Umum', NULL, NULL),
(17, 'Bendahara', NULL, NULL),
(18, 'Tim Teknis (DTRK)', NULL, NULL),
(19, 'Tim Teknis', NULL, NULL),
(20, 'Tim Teknis (Dinas Perindag)', NULL, NULL),
(21, 'Tim Teknis (Dinas Pariwisata)', NULL, NULL),
(22, 'Tim Teknis (Dinas Kesehatan)', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_execution`
--

CREATE TABLE IF NOT EXISTS `service_execution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL COMMENT 'di generate untuk pembeda tiap request perizinan',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 : belum\\n1 : sudah selesai\\n2 : force reject',
  `description` text COMMENT 'Deskripsi kondisi selesai',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token_UNIQUE` (`token`),
  KEY `fk_service_id_idx` (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='setiap row mewakilkan 1 pemohon dengan token yang unique' AUTO_INCREMENT=91 ;

--
-- Dumping data for table `service_execution`
--

INSERT INTO `service_execution` (`id`, `service_id`, `token`, `status`, `description`, `updated_at`, `created_at`, `customer_id`) VALUES
(1, 2, '14372056', 0, '', '2014-11-30 05:11:25', '2014-11-30 05:11:25', 1),
(2, 2, '57291038', 0, '', '2014-11-30 05:32:17', '2014-11-30 05:32:17', 1),
(3, 2, '52174368', 0, '', '2014-12-03 00:01:20', '2014-12-01 00:01:20', 3),
(4, 4, '45930782', 0, '', '2014-12-03 00:01:41', '2014-11-03 00:01:41', 3),
(5, 5, '79254013', 0, '', '2014-12-03 00:02:07', '2014-11-04 00:02:07', 3),
(6, 6, '91374286', 0, '', '2014-12-03 00:02:52', '2014-12-02 00:02:52', 3),
(7, 2, '80517936', 0, '', '2014-12-03 00:06:54', '2014-11-06 00:06:54', 4),
(8, 4, '83201549', 0, '', '2014-12-03 00:07:14', '2014-11-07 00:07:14', 4),
(9, 5, '32540897', 0, '', '2014-12-03 00:07:39', '2014-12-04 00:07:39', 4),
(10, 5, '36214975', 0, '', '2014-12-03 00:07:50', '2014-11-09 00:07:50', 4),
(11, 6, '48912637', 0, '', '2014-12-03 00:08:33', '2014-11-11 00:08:33', 4),
(12, 2, '02736841', 0, '', '2014-12-03 00:21:11', '2014-11-29 00:21:11', 5),
(13, 2, '24750391', 0, '', '2014-12-03 00:22:09', '2014-12-04 00:22:09', 6),
(14, 6, '41703269', 0, '', '2014-12-03 00:24:40', '2014-11-29 00:24:40', 6),
(15, 2, '87140952', 0, '', '2014-12-03 00:26:51', '2014-11-14 00:26:51', 7),
(16, 6, '08463217', 0, '', '2014-12-03 00:28:36', '2014-11-17 00:28:36', 7),
(17, 2, '27546098', 0, '', '2014-12-03 00:29:45', '2014-11-18 00:29:45', 8),
(18, 6, '07459326', 0, '', '2014-12-03 00:30:40', '2014-11-29 00:30:40', 8),
(19, 2, '57216409', 0, '', '2014-12-03 00:33:46', '2014-11-19 00:33:46', 9),
(20, 6, '34752186', 0, '', '2014-12-03 00:37:38', '2014-11-23 00:37:38', 9),
(21, 5, '76350982', 0, '', '2014-12-03 00:38:20', '2014-12-05 00:38:20', 9),
(22, 2, '59870432', 0, '', '2014-12-03 00:40:18', '2014-11-25 00:40:18', 10),
(23, 6, '85306927', 0, '', '2014-12-03 00:41:06', '2014-11-26 00:41:06', 10),
(24, 5, '89732614', 0, '', '2014-12-03 00:42:08', '2014-12-05 00:42:08', 10),
(25, 5, '86240951', 0, '', '2014-12-03 00:43:19', '2014-11-27 00:43:19', 10),
(26, 2, '89061245', 0, '', '2014-12-03 00:45:35', '2014-12-02 00:45:35', 11),
(27, 6, '94072365', 0, '', '2014-12-03 00:46:45', '2014-12-02 00:46:45', 11),
(28, 5, '84701269', 0, '', '2014-12-03 00:47:02', '2014-12-06 00:47:02', 11),
(29, 2, '81927504', 0, '', '2014-12-03 00:48:49', '2014-12-03 00:48:49', 12),
(30, 6, '15782493', 0, '', '2014-12-03 00:49:35', '2014-12-03 00:49:35', 12),
(31, 4, '68304759', 0, '', '2014-12-03 01:02:19', '2014-12-06 01:02:19', 12),
(32, 2, '98716024', 0, '', '2014-12-03 01:05:34', '2014-12-03 01:05:34', 13),
(33, 6, '38715460', 0, '', '2014-12-03 01:06:31', '2014-12-03 01:06:31', 13),
(34, 2, '08675132', 0, '', '2014-12-03 01:17:47', '2014-12-05 01:17:47', 14),
(35, 6, '52368490', 0, '', '2014-12-03 01:18:56', '2014-12-06 01:18:56', 14),
(36, 2, '61598432', 0, '', '2014-12-03 01:21:30', '2014-12-03 01:21:30', 15),
(37, 6, '53496072', 0, '', '2014-12-03 01:22:13', '2014-12-03 01:22:13', 15),
(38, 2, '39645721', 0, '', '2014-12-03 01:29:17', '2014-11-27 01:29:17', 16),
(39, 4, '46897250', 0, '', '2014-12-03 02:01:23', '2014-12-03 02:01:23', 16),
(40, 5, '23678159', 0, '', '2014-12-03 02:01:42', '2014-12-03 02:01:42', 16),
(41, 6, '58173926', 0, '', '2014-12-03 02:02:14', '2014-10-22 02:02:14', 16),
(42, 2, '74518930', 0, '', '2014-12-03 02:12:44', '2014-12-01 02:12:44', 17),
(43, 4, '36109457', 0, '', '2014-12-03 02:13:14', '2014-11-21 02:13:14', 17),
(44, 5, '82719365', 0, '', '2014-12-03 02:13:30', '2014-11-01 02:13:30', 17),
(45, 6, '93821405', 0, '', '2014-12-03 02:14:05', '2014-12-03 02:14:05', 17),
(46, 2, '00000001', 0, '', '2014-11-30 05:11:25', '2014-11-30 05:11:25', 1),
(47, 2, '00000002', 0, '', '2014-11-30 05:32:17', '2014-11-30 05:32:17', 1),
(48, 2, '00000003', 0, '', '2014-12-03 00:01:20', '2014-12-01 00:01:20', 3),
(49, 4, '00000004', 0, '', '2014-12-03 00:01:41', '2014-11-02 00:01:41', 3),
(50, 5, '00000005', 0, '', '2014-12-03 00:02:07', '2014-11-03 00:02:07', 3),
(51, 6, '00000006', 0, '', '2014-12-03 00:02:52', '2014-12-02 00:02:52', 3),
(52, 2, '00000007', 0, '', '2014-12-03 00:06:54', '2014-11-05 00:06:54', 4),
(53, 4, '00000008', 0, '', '2014-12-03 00:07:14', '2014-11-06 00:07:14', 4),
(54, 5, '00000009', 0, '', '2014-12-03 00:07:39', '2014-12-04 00:07:39', 4),
(55, 5, '00000010', 0, '', '2014-12-03 00:07:50', '2014-11-08 00:07:50', 4),
(56, 6, '00000011', 0, '', '2014-12-03 00:08:33', '2014-11-10 00:08:33', 4),
(57, 2, '00000012', 0, '', '2014-12-03 00:21:11', '2014-11-29 00:21:11', 5),
(58, 2, '00000013', 0, '', '2014-12-03 00:22:09', '2014-11-12 00:22:09', 6),
(59, 6, '00000014', 0, '', '2014-12-03 00:24:40', '2014-11-29 00:24:40', 6),
(60, 2, '00000015', 0, '', '2014-12-03 00:26:51', '2014-11-13 00:26:51', 7),
(61, 6, '00000016', 0, '', '2014-12-03 00:28:36', '2014-11-16 00:28:36', 7),
(62, 2, '00000017', 0, '', '2014-12-03 00:29:45', '2014-11-17 00:29:45', 8),
(63, 6, '00000018', 0, '', '2014-12-03 00:30:40', '2014-11-29 00:30:40', 8),
(64, 2, '00000019', 0, '', '2014-12-03 00:33:46', '2014-12-04 00:33:46', 9),
(65, 6, '00000020', 0, '', '2014-12-03 00:37:38', '2014-11-20 00:37:38', 9),
(66, 5, '00000021', 0, '', '2014-12-03 00:38:20', '2014-11-23 00:38:20', 9),
(67, 2, '00000022', 0, '', '2014-12-03 00:40:18', '2014-11-25 00:40:18', 10),
(68, 6, '00000023', 0, '', '2014-12-03 00:41:06', '2014-11-25 00:41:06', 10),
(69, 5, '00000024', 0, '', '2014-12-03 00:42:08', '2014-12-01 00:42:08', 10),
(70, 5, '00000025', 0, '', '2014-12-03 00:43:19', '2014-11-27 00:43:19', 10),
(71, 2, '00000026', 0, '', '2014-12-03 00:45:35', '2014-12-01 00:45:35', 11),
(72, 6, '00000027', 0, '', '2014-12-03 00:46:45', '2014-12-01 00:46:45', 11),
(73, 5, '00000028', 0, '', '2014-12-03 00:47:02', '2014-12-06 00:47:02', 11),
(74, 2, '00000029', 0, '', '2014-12-03 00:48:49', '2014-12-03 00:48:49', 12),
(75, 6, '00000030', 0, '', '2014-12-03 00:49:35', '2014-12-03 00:49:35', 12),
(76, 4, '00000031', 0, '', '2014-12-03 01:02:19', '2014-12-06 01:02:19', 12),
(77, 2, '00000032', 0, '', '2014-12-03 01:05:34', '2014-12-03 01:05:34', 13),
(78, 6, '00000033', 0, '', '2014-12-03 01:06:31', '2014-12-03 01:06:31', 13),
(79, 2, '00000034', 0, '', '2014-12-03 01:17:47', '2014-12-05 01:17:47', 14),
(80, 6, '00000035', 0, '', '2014-12-03 01:18:56', '2014-12-06 01:18:56', 14),
(81, 2, '00000036', 0, '', '2014-12-03 01:21:30', '2014-12-03 01:21:30', 15),
(82, 6, '00000037', 0, '', '2014-12-03 01:22:13', '2014-12-03 01:22:13', 15),
(83, 2, '00000038', 0, '', '2014-12-03 01:29:17', '2014-11-27 01:29:17', 16),
(84, 4, '00000039', 0, '', '2014-12-03 02:01:23', '2014-12-03 02:01:23', 16),
(85, 5, '00000040', 0, '', '2014-12-03 02:01:42', '2014-12-03 02:01:42', 16),
(86, 6, '00000041', 3, 'super user', '2014-12-04 08:48:46', '2014-10-22 02:02:14', 16),
(87, 2, '00000042', 0, '', '2014-12-03 02:12:44', '2014-12-01 02:12:44', 17),
(88, 4, '00000043', 0, '', '2014-12-03 02:13:14', '2014-11-21 02:13:14', 17),
(89, 5, '00000044', 0, '', '2014-12-03 02:13:30', '2014-12-03 02:13:30', 17),
(90, 6, '00000045', 0, '', '2014-12-03 02:14:05', '2014-12-03 02:14:05', 17);

-- --------------------------------------------------------

--
-- Table structure for table `service_requirements`
--

CREATE TABLE IF NOT EXISTS `service_requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `requirement_id` int(11) NOT NULL COMMENT 'Nama requirement yang akan di tampilkan sebagai list requirement.\\nJelas dan well formatted',
  `description` text COMMENT 'untuk requirement yg masih memiliki cabang',
  `is_required` int(1) DEFAULT '0' COMMENT 'Apakah harus di lengkapi atau tidak',
  `type_input` int(1) NOT NULL DEFAULT '1' COMMENT 'Ini jenis tipe field yang akan di generate. Terdapat 3 jenis\\n- file : untuk upload file\\n- input : untuk input berupa ketikan\\n- text : sekedar text, (informasi tertentu berupa tulisan) . Secara default, name akan menjadi isi dari informasi tersebut\\n\\nfile yang bisa di upload berupa pdf/jpeg',
  `type_output` int(1) NOT NULL DEFAULT '1',
  `field` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_service_id_idx` (`service_id`),
  KEY `fk_sr_to_id_idx` (`type_input`),
  KEY `fk_sr_to_id_idx1` (`type_output`),
  KEY `fk_sr_requirement_id_idx` (`requirement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='list requirement untuk sebuah service\n' AUTO_INCREMENT=13 ;

--
-- Dumping data for table `service_requirements`
--

INSERT INTO `service_requirements` (`id`, `service_id`, `requirement_id`, `description`, `is_required`, `type_input`, `type_output`, `field`) VALUES
(2, 2, 19, 'Dokumen Asli\r\n', 1, 1, 1, ''),
(3, 2, 20, '(Hardcopy) Fotocopy Ijazah Dokter', 1, 1, 1, ''),
(4, 2, 21, 'Surat Rekomendasi dari Organisasi', 1, 1, 1, ''),
(5, 2, 22, '(Hardcopy) 1 Lembar Materai Rp. 6.000,-', 0, 3, 3, ''),
(6, 6, 12, 'Untuk hardcopy, lampirkan Advice Planning/KRK dengan memperlihatkan aslinya', 1, 1, 1, ''),
(7, 6, 13, 'Surat-surat tanah berupa salah satu dari :</br>\r\na. Copy sertifikat</br>\r\n  - Surat kuasa bagi pemohon bukan nama dalam sertifikat</br>\r\n  - Surat kesepakatan untuk nama dalam sertifikat lebih dari satu</br>\r\nb. Copy akta</br>\r\nc. Surat Pernyataan Kepala Waris (untuk tanah milik kaum)</br>\r\nd. Surat Keterangan (untuk tanah yang belum terdaftar)', 1, 1, 1, ''),
(8, 6, 14, 'Dokumen Rencana Teknis yang sudah mendapat pengesahan dari Dinas Tata Ruang sebagai berikut:</br></br>\r\na. Gambar rencana bangunan yang terdiri dari tanah, tampak 2 arah, potongan dua arah, site plan, sket lokasi (untuk bangunan rumah tinggal tunggal dan rumah tinggal deret satu lantai)</br></br>\r\nb. Untuk bangunan berlantai diatas II persyaratan a (penulanhan pondasi, sloof, kolom, balok, khusus bangunan diatas III lantai ditambah perhitungan struktur)</br></br>\r\nc.  Untuk bangunan besar dan bangunan umum persyaratan a dan b ditambah dengan gambar rencana mekanikal, elektrikal, plumbing dan hidrat.</br></br>\r\nd. Untuk bangunan besar dan bangunan umum persyaratan a, b dan c ditambah dengan gambar rencana fasilitas dan aksesbilitas termasuk untuk orang cacat dan orang yang memiliki keterbatasan.</br></br>\r\n e. Gambar dokumen rencana teknis</br>\r\n        - Dibuat dengan program aplikasi Autocad atau program lain sejenis</br>\r\n        - Berupa Print Out Komputer</br>\r\n        - Seluruh Gambar rangkap 3</br>\r\n        - Gambar teknis dengan skala, ukuran dan keterangan lengkap</br>\r\n        - Dilengkapi dengan kolom nama dan ditandatangani oleh perencana</br>\r\n        - Khusus untuk bangunan dua lantai atau lebih gambar ditandatangani oleh konstruktur sarjana teknik  sipil selaku penanggung jawab struktur', 1, 1, 4, ''),
(9, 6, 15, 'Untuk bangunan yang dapat menimbulkan dampak penting terhadap lingkungan sesuai dengan ketentuan perundang-undangan.', 0, 1, 1, ''),
(10, 6, 16, 'Untuk bangunan yang dapat menimbulkan dampak penting terhadap lingkungan sesuai dengan ketentuan perundang-undangan.', 0, 1, 1, ''),
(11, 6, 1, 'Kartu Tanda Penduduk yang masih berlaku', 1, 1, 2, ''),
(12, 6, 18, 'Map Tulang Kertas:</br>\r\n&nbsp;&nbsp;- Warna merah untuk rumah tinggal</br>\r\n&nbsp;&nbsp;- Warna kuning untuk bangunan usaha</br>\r\n&nbsp;&nbsp;- Warna biru untuk bangunan pendidikan sosial dan perkantoran', 0, 3, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL COMMENT 'Nama servis',
  `category` int(11) NOT NULL DEFAULT '1' COMMENT 'Kategori service, seperti pelayanan atau yg lain',
  `estimated_days` int(11) DEFAULT NULL COMMENT 'waktu yg dibutuhkan 1 service',
  `organization_id` int(11) NOT NULL DEFAULT '1',
  `form_perizinan` text COMMENT 'Format form perizinan yang akan digunakan untuk menggenerate file perizinan\\n',
  `form_pembayaran` text COMMENT 'Form pembayaran yang akan digunakan untuk generate form pembayaran',
  `is_active` int(1) DEFAULT '1',
  `database` varchar(100) NOT NULL,
  `tabel` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_organization_id_idx` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `category`, `estimated_days`, `organization_id`, `form_perizinan`, `form_pembayaran`, `is_active`, `database`, `tabel`) VALUES
(2, 'Izin Praktek Dokter Umum', 1, 14, 1, NULL, NULL, 1, 'riset_operational', 'srv_praktek_dokter_umum'),
(4, 'Izin Gangguan (Hinder Ordonantie/HO)', 1, 14, 1, NULL, NULL, 1, 'riset_operational', 'srv_general'),
(5, 'Izin Tempat Usaha - Izin Baru', 1, 10, 1, NULL, NULL, 1, 'riset_operational', 'srv_general'),
(6, 'Izin Mendirikan Bangunan (IMB) - Izin Baru', 1, 14, 1, NULL, NULL, 1, 'riset_operational', 'srv_general');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `title_color` varchar(20) NOT NULL,
  `header_image` varchar(100) DEFAULT NULL,
  `background_image` varchar(100) DEFAULT NULL,
  `organization_id` int(2) DEFAULT NULL,
  `is_active` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_setting_organization_id_idx` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `title`, `title_color`, `header_image`, `background_image`, `organization_id`, `is_active`) VALUES
(1, '1_logo.png', 'Badan Penanaman Modal Daerah dan Pelayanan Terpadu Satu Pintu', '#ffffff', '1_header_image.png', '1_background_image.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `type_input`
--

CREATE TABLE IF NOT EXISTS `type_input` (
  `id` int(2) NOT NULL,
  `name` varchar(45) DEFAULT NULL COMMENT 'Ini jenis tipe field yang akan di generate. Terdapat 3 jenis\\n- file : untuk upload file\\n- input : untuk input berupa ketikan\\n- text : sekedar text, (informasi tertentu berupa tulisan) . Secara default, name akan menjadi isi dari informasi tersebut\\n\\nfile yang bisa di upload berupa pdf/jpeg',
  `value` varchar(20) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='jenis input yang dibutuhkan untuk generate form';

--
-- Dumping data for table `type_input`
--

INSERT INTO `type_input` (`id`, `name`, `value`, `description`) VALUES
(1, 'File', 'file', 'Berupa input file untuk upload, hanya jpeg/pdf'),
(2, 'Text', 'input', 'Berupa input text'),
(3, 'Static Text', 'text', 'Static text berupa kalimat, tidak ada interaksi');

-- --------------------------------------------------------

--
-- Table structure for table `type_output`
--

CREATE TABLE IF NOT EXISTS `type_output` (
  `id` int(2) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `value` varchar(45) DEFAULT NULL COMMENT 'Tipe yang akan digunakan untuk membuka file tersebut. Digunakan sebagai atribut Content-type pada header.\\n\\nYang tersedia\\nimage/jpeg\\napplication/pdf\\ntext/plain\\n',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tipe output yang dibutuhkan untuk melihat data yang telah di input';

--
-- Dumping data for table `type_output`
--

INSERT INTO `type_output` (`id`, `name`, `value`, `description`) VALUES
(1, 'PDF', 'application/pdf', NULL),
(2, 'Image', 'image/jpeg', NULL),
(3, 'Text', 'text/plain', NULL),
(4, 'Zip', 'application/zip', 'unknown file type');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT 'No Name',
  `description` text,
  `organization_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_organization_id_idx` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `description`, `organization_id`) VALUES
(17, 'Kepala BPMD-PTSP', '', 1),
(18, 'Sekretaris BPMD-PTSP', '', 1),
(19, 'Sub Bagian Keuangan', '', 1),
(20, 'Sub Bagian Umum dan Perlengkapan', '', 1),
(21, 'Sub Bagian Kepegawaian', '', 1),
(22, 'Bidang Kendali Program', '', 1),
(23, 'Bidang Promosi Informasi & Pengawasan Permodalan', '', 1),
(24, 'Bidang Penanaman Modal dan Kerjasama', '', 1),
(25, 'Bidang Pelayanan Terpadu', '', 1),
(26, 'Sub Bidang Evaluasi & Pelaporan', '', 1),
(27, 'Sub Bidang Perencanaan & Pelaporan', '', 1),
(28, 'Sub Bidang Pengawasan Permodalan', '', 1),
(29, 'Sub Bidang Promosi & Informasi', '', 1),
(30, 'Sub Bidang Penanaman Modal', '', 1),
(31, 'Sub Bidang Kerjasama', '', 1),
(32, 'Sub Bidang Pengkajian & Pengaduan', '', 1),
(33, 'Sub Bidang Pelayanan Perizinan & Non Perizinan', '', 1),
(34, 'External Unit', 'Unit untuk user dari dinas luar seperti dinas pariwisata dll.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE IF NOT EXISTS `user_logs` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `browser` text,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ul_user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(45) NOT NULL DEFAULT 'No Name',
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `unit_id` int(11) NOT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL COMMENT 'log login terakhir',
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_unit_id_idx` (`unit_id`),
  KEY `fk_organization_id_idx` (`organization_id`),
  KEY `fk_users_position_id_idx` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `phone`, `position_id`, `unit_id`, `organization_id`, `last_login`, `remember_token`) VALUES
(12, 'super', '$2y$10$51KgZFr3woDSGqRh4BcnQObtxJeqq/wllI4XeRQAAhno5D3BB9iqe', 'Super User', 'punyagama@gmail.com', '', 1, 34, 1, NULL, 'GJOnFrU9z5K0dK06MB6v2RX72xqL6WEzy2gbTbJyU0qZ6MyiuzD957WAbiRC'),
(13, 'marta', '$2y$10$lwdeD8B2uIuWRpMjXjAEuOGpP.Rbka8W70tnbWxvbXi7VNAGHSFwS', 'Marta Minanda, ST., MT', 'marta@bpmdptsp.go.id', '', 1, 17, 1, NULL, NULL),
(14, 'sovita', '$2y$10$AwJz6qAWSn2hi27NXFoBh.zPPOVqx3rg.W40nT.R8nWEQ6db.DQgO', 'Hj. Sovita Yenuris, SH', 'sovita@bpmdptsp.go.id', '', 2, 18, 1, NULL, NULL),
(15, 'fitra', '$2y$10$zJsyAfuD6L4GRR9pLBTEPeW7V8Bx2qzhGnzr1CTER4EWTYlfaFX9C', 'Fitra Harianto, ST', 'fitra@bpmdptsp.go.id', '', 1, 25, 1, NULL, NULL),
(16, 'riza', '$2y$10$7jDZTFrTxwZ6WdezHzK/NOXTOH1HGRzhfaB7ypQcKJkriPgLAxd.6', 'Riza Andriani, SIP', 'riza@bpmdptsp.go.id', '', 1, 33, 1, NULL, NULL),
(17, 'cici', '$2y$10$SojG6swuOjudGZA2Mworj.OaCfqZ9U78BMkER5a8xgFQodB/XCN3a', 'Cici Elita, A.Md', 'cici@gmail.com', '', 5, 33, 1, NULL, 'IsRqbl5x539kuiPJI4oBFDWWVuSaa11HVvJUXEIE9BO1Me8AuuPflrY1migk'),
(18, 'yesi', '$2y$10$asc861eNjEJAtI9P8ipKk.W.Qp3uinPfV3PpnSb1LBDNLlwz2MwSS', 'Yesi Mursida, A.Md', 'yesi@gmail.com', '', 5, 33, 1, NULL, NULL),
(19, 'zulyendri', '$2y$10$hzCSaB12GPap97w.er8pk.8Dj7ywrDDFCqYO0ftghS9bPC9lPqh4m', 'Zulyendri', 'zulyendri@gmail.com', '', 5, 33, 1, NULL, NULL),
(20, 'hendrison', '$2y$10$1jp9xKKmSPVwhmXFanFI4uqK/3tBbxE/NnusfLIsJORarajUJYN.C', 'Hendrison, SE', 'hendrison@gmail.com', '', 5, 33, 1, NULL, NULL),
(21, 'robby', '$2y$10$qDX3abdbZoKedNuIfPI/beA9gFAXvht1FRQuuMvW3CqoYKljrIXHS', 'Robby Hafanos, M.CIO', 'robby@gmail.com', '', 5, 33, 1, NULL, NULL),
(22, 'yusmaridon', '$2y$10$cJi.mShLo0Q9VkTsTaNvd.CcKaJrEnf8NjLAq1h/9R1K/VHBadzDa', 'Yusmaridon', 'yusmaridon@gmail.com', '', 5, 32, 1, NULL, NULL),
(23, 'roswita', '$2y$10$kiFxE4fVf1XN0x/aKm9/zetZ4N/4Sz5e331.zs0KSzxfegis30LiG', 'Roswita', 'roswita@gmail.com', '', 5, 33, 1, NULL, NULL),
(24, 'perindag', '$2y$10$syAU8jNM2Jm3FpYqNtW43.ePkgRgSD56gHQEZVk5JvhKJI5YZWDQ6', 'Tim Teknis Dinas Perindag', 'perindag@gmail.com', '', 1, 34, 1, NULL, NULL),
(25, 'kesehatan', '$2y$10$vykq3F3y/gOoJHjsfmpyhOECU0wXLI6qfgQ0vjxtrnGOy7HcZcORa', 'Tim Teknis Dinas Kesehatan', 'kesehatan@gmail.com', '', 1, 34, 1, NULL, NULL),
(26, 'pariwisata', '$2y$10$o3XJ7aoPVOAr2M3mMeOKBesZ1DwJzx7yIV8pCdyzRMvyq2.OHVer6', 'Tim Teknis Dinas Pariwisata', 'pariwisata@gmail.com', '', 1, 34, 1, NULL, NULL),
(27, 'dtrk', '$2y$10$glmICRdPwka6VakaR6W9Mef0yjz8De8MuBemZEP2As9xB/qoZloYa', 'Tim Teknis (DTRK)', 'dtrk@gmail.com', '', 1, 34, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bps`
--
CREATE TABLE IF NOT EXISTS `v_bps` (
`id` int(11)
,`bp_id` int(11)
,`se_id` int(11)
,`service_id` int(11)
,`status` int(1)
,`started_by` int(11)
,`started_time` datetime
,`finished_by` int(11)
,`finished_time` datetime
,`comment` text
,`name` varchar(100)
);
-- --------------------------------------------------------

--
-- Table structure for table `xor_status`
--

CREATE TABLE IF NOT EXISTS `xor_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `se_id` int(11) NOT NULL,
  `value` varchar(45) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_xor_se_id_idx` (`se_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure for view `v_bps`
--
DROP TABLE IF EXISTS `v_bps`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bps` AS select `a`.`id` AS `id`,`a`.`bp_id` AS `bp_id`,`a`.`se_id` AS `se_id`,`a`.`service_id` AS `service_id`,`a`.`status` AS `status`,`a`.`started_by` AS `started_by`,`a`.`started_time` AS `started_time`,`a`.`finished_by` AS `finished_by`,`a`.`finished_time` AS `finished_time`,`a`.`comment` AS `comment`,`b`.`name` AS `name` from (`base_process_state` `a` left join `base_process` `b` on((`a`.`bp_id` = `b`.`id`))) order by `a`.`se_id`,`a`.`id`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD CONSTRAINT `fk_ar_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ar_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `base_process`
--
ALTER TABLE `base_process`
  ADD CONSTRAINT `fk_bp_service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bp_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `base_process_output`
--
ALTER TABLE `base_process_output`
  ADD CONSTRAINT `fk_bpo_bp_id` FOREIGN KEY (`bp_id`) REFERENCES `base_process` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bpo_ti_id` FOREIGN KEY (`type_input`) REFERENCES `type_input` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bpo_to_id` FOREIGN KEY (`type_output`) REFERENCES `type_output` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `base_process_state`
--
ALTER TABLE `base_process_state`
  ADD CONSTRAINT `fk_bps_bp_id` FOREIGN KEY (`bp_id`) REFERENCES `base_process` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bps_finished_by` FOREIGN KEY (`finished_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bps_service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bps_se_id` FOREIGN KEY (`se_id`) REFERENCES `service_execution` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bps_started_by` FOREIGN KEY (`started_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `base_process_state_output`
--
ALTER TABLE `base_process_state_output`
  ADD CONSTRAINT `fk_bpso_bpo_id` FOREIGN KEY (`bpo_id`) REFERENCES `base_process_output` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bpso_bps_id` FOREIGN KEY (`bps_id`) REFERENCES `base_process_state` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bpso_se_id` FOREIGN KEY (`se_id`) REFERENCES `service_execution` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `fk_pr_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pr_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `fk_position_organization_id` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requirement_storages`
--
ALTER TABLE `requirement_storages`
  ADD CONSTRAINT `fk_rs_requirement_id` FOREIGN KEY (`requirement_id`) REFERENCES `service_requirements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rs_se_id` FOREIGN KEY (`se_id`) REFERENCES `service_execution` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `fk_roles_organization_id` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_execution`
--
ALTER TABLE `service_execution`
  ADD CONSTRAINT `fk_se_service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_requirements`
--
ALTER TABLE `service_requirements`
  ADD CONSTRAINT `fk_sr_requirement_id` FOREIGN KEY (`requirement_id`) REFERENCES `requirements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sr_service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sr_ti_id` FOREIGN KEY (`type_input`) REFERENCES `type_input` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sr_to_id` FOREIGN KEY (`type_output`) REFERENCES `type_output` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_service_organization_id` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `fk_setting_organization_id` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `fk_units_organization_id` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `fk_ul_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_organization_id` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_position_id` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `xor_status`
--
ALTER TABLE `xor_status`
  ADD CONSTRAINT `fk_xor_se_id` FOREIGN KEY (`se_id`) REFERENCES `service_execution` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
