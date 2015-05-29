
INSERT INTO `base_process` (`id`, `service_id`, `pre_con_bp`, `next_bp_id`, `unit_id`, `roles`, `generate_form_pembayaran`, `generate_form_perizinan`, `is_start`, `is_checkpoint`, `is_finish`, `is_display`, `display_text`, `name`, `description`) VALUES
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


INSERT INTO `base_process_output` (`id`, `bp_id`, `name`, `type_input`, `type_output`, `is_required`, `field`) VALUES
(null, 42, 'Hasil Pembahasan', 2, 3, 1, 'hasil_pembahasan'),
(null, 42, 'Hasil Survey', 1, 1, 1, 'hasil_survey'),
(null, 48, 'Surat Izin', 1, 1, 1, 'surat_izin'),
(null, 49, 'Retribusi (RP)', 2, 3, 0, 'surat_izin');


INSERT INTO `service_requirements` (`id`, `service_id`, `requirement_id`, `description`, `is_required`, `type_input`, `type_output`, `field`) VALUES
(6, 6, 12, 'Untuk hardcopy, lampirkan Advice Planning/KRK dengan memperlihatkan aslinya', 1, 1, 1, ''),
(7, 6, 13, 'Surat-surat tanah berupa salah satu dari :</br>\r\na. Copy sertifikat</br>\r\n  - Surat kuasa bagi pemohon bukan nama dalam sertifikat</br>\r\n  - Surat kesepakatan untuk nama dalam sertifikat lebih dari satu</br>\r\nb. Copy akta</br>\r\nc. Surat Pernyataan Kepala Waris (untuk tanah milik kaum)</br>\r\nd. Surat Keterangan (untuk tanah yang belum terdaftar)', 1, 1, 1, ''),
(8, 6, 14, 'Dokumen Rencana Teknis yang sudah mendapat pengesahan dari Dinas Tata Ruang sebagai berikut:</br></br>\r\na. Gambar rencana bangunan yang terdiri dari tanah, tampak 2 arah, potongan dua arah, site plan, sket lokasi (untuk bangunan rumah tinggal tunggal dan rumah tinggal deret satu lantai)</br></br>\r\nb. Untuk bangunan berlantai diatas II persyaratan a (penulanhan pondasi, sloof, kolom, balok, khusus bangunan diatas III lantai ditambah perhitungan struktur)</br></br>\r\nc.  Untuk bangunan besar dan bangunan umum persyaratan a dan b ditambah dengan gambar rencana mekanikal, elektrikal, plumbing dan hidrat.</br></br>\r\nd. Untuk bangunan besar dan bangunan umum persyaratan a, b dan c ditambah dengan gambar rencana fasilitas dan aksesbilitas termasuk untuk orang cacat dan orang yang memiliki keterbatasan.</br></br>\r\n e. Gambar dokumen rencana teknis</br>\r\n        - Dibuat dengan program aplikasi Autocad atau program lain sejenis</br>\r\n        - Berupa Print Out Komputer</br>\r\n        - Seluruh Gambar rangkap 3</br>\r\n        - Gambar teknis dengan skala, ukuran dan keterangan lengkap</br>\r\n        - Dilengkapi dengan kolom nama dan ditandatangani oleh perencana</br>\r\n        - Khusus untuk bangunan dua lantai atau lebih gambar ditandatangani oleh konstruktur sarjana teknik  sipil selaku penanggung jawab struktur', 1, 1, 4, ''),
(9, 6, 15, 'Untuk bangunan yang dapat menimbulkan dampak penting terhadap lingkungan sesuai dengan ketentuan perundang-undangan.', 0, 1, 1, ''),
(10, 6, 16, 'Untuk bangunan yang dapat menimbulkan dampak penting terhadap lingkungan sesuai dengan ketentuan perundang-undangan.', 0, 1, 1, ''),
(11, 6, 1, 'Kartu Tanda Penduduk yang masih berlaku', 1, 1, 2, ''),
(12, 6, 18, 'Map Tulang Kertas:</br>\r\n&nbsp;&nbsp;- Warna merah untuk rumah tinggal</br>\r\n&nbsp;&nbsp;- Warna kuning untuk bangunan usaha</br>\r\n&nbsp;&nbsp;- Warna biru untuk bangunan pendidikan sosial dan perkantoran', 0, 3, 3, '');


INSERT INTO `customers` (`id`, `nama`, `email`, `phone`, `address`, `ktp`, `password`, `organization_id`) VALUES
(null, 'Syachrir Eka Putra', 'syachrir@gmail.com', '087864527958', 'Payakumbuh', '1', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Rachmi Hidayati', 'rachmi@gmail.com', '087864527958', 'Payakumbuh', '2', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Mayzar Annas', 'mayzar@gmail.com', '087864527958', 'Payakumbuh', '3', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Sahdan Azhari', 'sahdan@gmail.com', '087864527958', 'Payakumbuh', '4', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Putu Regi Pratama', 'regi@gmail.com', '087864527958', 'Payakumbuh', '5', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Pratama Rinad', 'tama@gmail.com', '087864527958', 'Payakumbuh', '6', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Rama DS', 'rama@gmail.com', '087864527958', 'Payakumbuh', '7', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Khurniawan Eko', 'eko@gmail.com', '087864527958', 'Payakumbuh', '8', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Ahmad Zafrullah', 'zaf@gmail.com', '087864527958', 'Payakumbuh', '9', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Arief Taufiqurrahman', 'arief@gmail.com', '087864527958', 'Payakumbuh', '10', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Susi Susanti', 'susi@gmail.com', '087864527958', 'Payakumbuh', '11', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Bayu Wibisana', 'bayu@gmail.com', '087864527958', 'Payakumbuh', '12', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Sari Ismi', 'sari@gmail.com', '087864527958', 'Payakumbuh', '13', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Arif', 'arif@gmail.com', '087864527958', 'Payakumbuh', '14', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1),
(null, 'Arga Fausta', 'arga@gmail.com', '087864527958', 'Payakumbuh', '15', '$2y$10$TU0iFRQTWbODV.btfSOq6.Cz7w0gZzmLTOFUZhlfXxb4vnqfpp7Wi', 1);
