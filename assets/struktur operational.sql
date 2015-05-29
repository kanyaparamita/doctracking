CREATE TABLE IF NOT EXISTS `srv_<nama_service>` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;