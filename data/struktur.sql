/*
SQLyog Community Edition- MySQL GUI v6.56
MySQL - 5.0.51a-3ubuntu5.8 : Database - pdam_seed
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

USE `pdam_seed`;

/*Table structure for table `system_parameter` */

DROP TABLE IF EXISTS `system_parameter`;

CREATE TABLE `system_parameter` (
  `sys_param` varchar(50) default NULL,
  `sys_value` varchar(100) default NULL,
  `sys_value1` varchar(1000) default NULL,
  `sys_value2` varchar(100) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tm_aplikasi_billing` */

DROP TABLE IF EXISTS `tm_aplikasi_billing`;

CREATE TABLE `tm_aplikasi_billing` (
  `appl_kode` char(6) collate utf8_bin NOT NULL,
  `ga_kode` char(6) collate utf8_bin default NULL,
  `appl_seq` tinyint(3) unsigned default NULL,
  `appl_file` varchar(50) collate utf8_bin default NULL,
  `appl_proc` varchar(100) collate utf8_bin default NULL,
  `appl_nama` varchar(50) collate utf8_bin default NULL,
  `appl_deskripsi` tinyint(4) default NULL,
  `appl_sts` tinyint(4) default NULL,
  `appl_ref` tinyint(4) default NULL,
  PRIMARY KEY  (`appl_kode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tm_claim` */

DROP TABLE IF EXISTS `tm_claim`;

CREATE TABLE `tm_claim` (
  `pel_no` varchar(10) NOT NULL default '',
  `rek_nomor` varchar(20) NOT NULL,
  `cl_tgl` datetime NOT NULL,
  `cl_stanlalu_awal` double default NULL,
  `cl_stankini_awal` double default NULL,
  `cl_stanlalu_akhir` double default NULL,
  `cl_stankini_akhir` double default NULL,
  `cl_uangair_akhir` double default NULL,
  `gol_kode` varchar(6) default NULL,
  `cl_rek_no_baru` varchar(20) default NULL,
  `cl_sts` varchar(2) default NULL,
  `sts` tinyint(4) default NULL,
  `kar_id` varchar(20) default NULL,
  PRIMARY KEY  (`pel_no`,`rek_nomor`,`cl_tgl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tm_drd_awal` */

DROP TABLE IF EXISTS `tm_drd_awal`;

CREATE TABLE `tm_drd_awal` (
  `pel_no` varchar(10) NOT NULL,
  `rek_nomor` varchar(20) NOT NULL,
  `rek_tgl` datetime default NULL,
  `rek_bln` varchar(2) default NULL,
  `rek_thn` varchar(4) default NULL,
  `rek_dkd` varchar(3) default NULL,
  `rek_stanlalu` double default NULL,
  `rek_stankini` double default NULL,
  `rek_uangair` double default NULL,
  `rek_adm` double default NULL,
  `rek_meter` double default NULL,
  `rek_denda` double default NULL,
  `rek_materai` double default NULL,
  `rek_angsuran` double default NULL,
  `rek_total` double default NULL,
  `rek_gol` varchar(2) default NULL,
  `rek_loket` varchar(1) default NULL,
  `rek_trek` varchar(7) default NULL,
  `rek_pindah` varchar(1) default NULL,
  `kar_id` varchar(20) default NULL,
  PRIMARY KEY  (`pel_no`,`rek_nomor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tm_ganti_meter` */

DROP TABLE IF EXISTS `tm_ganti_meter`;

CREATE TABLE `tm_ganti_meter` (
  `pel_no` varchar(10) NOT NULL default '',
  `ba_no` varchar(50) default NULL,
  `pel_nowm` varchar(10) NOT NULL,
  `pel_nowm_baru` varchar(10) default NULL,
  `um_kode` varchar(1) NOT NULL,
  `mer_kode` varchar(2) NOT NULL,
  `kar_id` varchar(20) NOT NULL,
  `dkd_kd` varchar(10) NOT NULL,
  `gm_tgl_psg` datetime default NULL,
  `dkd_no` varchar(3) default NULL,
  `gm_tgl` datetime NOT NULL,
  `gm_stdlama` double default NULL,
  `gm_stdbaru` double default NULL,
  `gm_seril` varchar(12) default NULL,
  `gm_serib` varchar(12) default NULL,
  `gm_sts` int(1) default NULL,
  PRIMARY KEY  (`pel_no`,`pel_nowm`,`um_kode`,`mer_kode`,`kar_id`,`dkd_kd`,`gm_tgl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tm_karyawan` */

DROP TABLE IF EXISTS `tm_karyawan`;

CREATE TABLE `tm_karyawan` (
  `kar_id` varchar(20) NOT NULL,
  `grup_id` varchar(10) default NULL,
  `kar_pass` varchar(50) default NULL,
  `kar_nip` varchar(10) default NULL,
  `kar_nik` varchar(50) default NULL,
  `kar_nama` varchar(50) default NULL,
  `kar_jabatan` varchar(30) default NULL,
  `kar_pangkat` varchar(20) default NULL,
  `kar_email` varchar(50) default NULL,
  `kar_note` varchar(30) default NULL,
  `kar_sts` varchar(1) default NULL,
  `kp_kode` varchar(10) default NULL,
  PRIMARY KEY  (`kar_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tm_kode_tarif` */

DROP TABLE IF EXISTS `tm_kode_tarif`;

CREATE TABLE `tm_kode_tarif` (
  `tar_kode` tinyint(3) unsigned default '0',
  `gol_kode` varchar(2) character set utf8 collate utf8_bin NOT NULL,
  `tar_tgl` date default '0000-00-00',
  `tar_bln_mulai` mediumint(9) default '0',
  `tar_bln_akhir` mediumint(9) NOT NULL default '0',
  `tar_1` int(10) unsigned default '0',
  `tar_2` int(10) unsigned default '0',
  `tar_3` int(10) unsigned default '0',
  `tar_4` int(10) unsigned default '0',
  `tar_5` int(10) unsigned default '0',
  `tar_6` int(10) unsigned default '0',
  `tar_7` int(10) unsigned default '0',
  `tar_8` int(10) unsigned default '0',
  `tar_sd1` int(10) unsigned default '0',
  `tar_sd2` int(10) unsigned default '0',
  `tar_sd3` int(10) unsigned default '0',
  `tar_sd4` int(10) unsigned default '0',
  `tar_sd5` int(10) unsigned default '0',
  `tar_sd6` int(10) unsigned default '0',
  `tar_sd7` int(10) unsigned default '0',
  `tar_ukembali` tinyint(3) unsigned default '0',
  `tar_biaya_sb` tinyint(3) unsigned default '0',
  `tar_turun` tinyint(3) unsigned default '0',
  `tar_naik` tinyint(3) unsigned default '0',
  `tar_denda1` int(10) unsigned default '0',
  `tar_denda2` tinyint(3) unsigned default '0',
  `tar_ukembali2` tinyint(3) unsigned default '0',
  `tar_bts_denda` tinyint(3) unsigned default '0',
  `tar_denda3` tinyint(3) unsigned default '0',
  `tar_adm` int(10) unsigned default '0',
  `tar_model` tinyint(3) unsigned default '0',
  PRIMARY KEY  (`gol_kode`,`tar_bln_akhir`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tm_meter` */

DROP TABLE IF EXISTS `tm_meter`;

CREATE TABLE `tm_meter` (
  `pel_no` char(6) NOT NULL,
  `pel_nowm` varchar(10) default NULL,
  `um_kode` varchar(1) default '1',
  `mer_kode` varchar(2) default NULL,
  `kar_id` varchar(20) default NULL,
  `dkd_kd` int(5) default NULL,
  `dkd_no` varchar(3) default NULL,
  `met_tgl` date default NULL,
  `met_disi` varchar(8) default NULL,
  `met_stdlama` double default NULL,
  `met_stdbaru` double default NULL,
  `met_seril` varchar(12) default NULL,
  `met_serib` varchar(12) default NULL,
  `met_sts` int(2) default NULL,
  `met_kabnorm` varchar(1) default NULL,
  `b01` double default NULL,
  `b02` double default NULL,
  `b03` double default NULL,
  `b04` double default NULL,
  `b05` double default NULL,
  `b06` double default NULL,
  `b07` double default NULL,
  `b08` double default NULL,
  `b09` double default NULL,
  `b10` double default NULL,
  `b11` double default NULL,
  `b12` double default NULL,
  `b13` double default NULL,
  `b14` double default NULL,
  `b15` double default NULL,
  `b16` double default NULL,
  PRIMARY KEY  (`pel_no`),
  UNIQUE KEY `info` (`pel_no`,`dkd_kd`,`met_sts`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1;

/*Table structure for table `tm_pelanggan` */

DROP TABLE IF EXISTS `tm_pelanggan`;

CREATE TABLE `tm_pelanggan` (
  `pel_no` char(6) NOT NULL,
  `pel_nowm` varchar(10) default NULL,
  `pel_nosl` varchar(10) default NULL,
  `kp_kode` varchar(10) default NULL,
  `pel_nama` varchar(30) default NULL,
  `pel_alamat` varchar(50) default NULL,
  `pel_kel` varchar(20) default NULL,
  `pel_kec` varchar(20) default NULL,
  `pel_kota` varchar(20) default NULL,
  `pel_telp` varchar(20) default NULL,
  `pel_hp` varchar(20) default NULL,
  `pel_tglpsg` date default NULL,
  `pel_tglaktif` date default NULL,
  `gol_kode` varchar(6) default NULL,
  `pel_tipewm` varchar(1) default NULL,
  `pel_kode` varchar(1) default NULL,
  `pel_pipa` varchar(1) default NULL,
  `pel_drop` varchar(1) default NULL,
  `pel_sts_byr` varchar(2) default NULL,
  `pel_sts_wm` varchar(2) default NULL,
  `tglstart` varchar(8) default NULL,
  `ukuran` varchar(1) default NULL,
  `subgol` varchar(1) default NULL,
  `cash` varchar(1) default NULL,
  `loket` varchar(1) default NULL,
  `uang` double default NULL,
  `cr_angs` double default NULL,
  `ang_ke` double default NULL,
  `muka` double default NULL,
  `tunggak` double default NULL,
  `piutang` double default NULL,
  `lurah` varchar(2) default NULL,
  `transfer` varchar(1) default NULL,
  `kabnorm` varchar(1) default NULL,
  `tungangs` double default NULL,
  `merk` varchar(2) default NULL,
  `tps` varchar(1) default NULL,
  `cicil` varchar(1) default NULL,
  `no_sl` varchar(12) default NULL,
  `no_cab` varchar(10) default NULL,
  `rl` bit(1) NOT NULL default '\0',
  `rlrupiah` double default NULL,
  `rlrek` varchar(10) default NULL,
  `tar_kode` varchar(12) default NULL,
  PRIMARY KEY  (`pel_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tm_reduksi` */

DROP TABLE IF EXISTS `tm_reduksi`;

CREATE TABLE `tm_reduksi` (
  `pel_no` varchar(10) NOT NULL default '',
  `rek_nomor` varchar(20) NOT NULL default '0',
  `rd_tgl` datetime NOT NULL,
  `rd_stanlalu` double default NULL,
  `rd_stankini` double default NULL,
  `rd_uangair_awal` double default NULL,
  `rd_nilai` double default NULL,
  `rd_uangair_akhir` double default NULL,
  `rd_rek_no_baru` double default NULL,
  `gol_kode` varchar(6) default NULL,
  `rd_sts` varchar(2) default NULL,
  `sts` tinyint(4) default NULL,
  `kar_id` varchar(20) default NULL,
  PRIMARY KEY  (`pel_no`,`rek_nomor`,`rd_tgl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tm_rekening` */

DROP TABLE IF EXISTS `tm_rekening`;

CREATE TABLE `tm_rekening` (
  `pel_no` char(6) default NULL,
  `rek_nomor` bigint(15) NOT NULL,
  `rek_tgl` datetime default NULL,
  `rek_bln` int(2) default NULL,
  `rek_thn` int(4) default NULL,
  `rek_dkd` varchar(3) default NULL,
  `rek_stanlalu` double default NULL,
  `rek_stankini` double default NULL,
  `rek_uangair` double default '0',
  `rek_adm` double default '0',
  `rek_meter` double default '0',
  `rek_denda` double default '0',
  `rek_materai` double default '0',
  `rek_angsuran` double default '0',
  `rek_total` double default '0',
  `rek_gol` varchar(6) default NULL,
  `rek_loket` varchar(1) default NULL,
  `rek_trek` varchar(7) default NULL,
  `rek_pindah` varchar(1) default NULL,
  `rek_sts` int(1) default NULL,
  `rek_byr_sts` int(1) default NULL,
  `kar_id` varchar(20) default NULL,
  `tar_kode` varchar(12) default NULL,
  PRIMARY KEY  (`rek_nomor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tm_stand_meter` */

DROP TABLE IF EXISTS `tm_stand_meter`;

CREATE TABLE `tm_stand_meter` (
  `pel_no` varchar(10) NOT NULL,
  `sm_tgl` datetime NOT NULL,
  `sm_tgl_baca` date default NULL,
  `sm_bln` int(2) default NULL,
  `sm_thn` int(4) default NULL,
  `pel_nowm` varchar(10) default NULL,
  `kar_id` varchar(20) default NULL,
  `kwm_kd` varchar(10) default '0',
  `kl_kd` varchar(10) default '0',
  `sm_lalu` double default NULL,
  `sm_kini` double default NULL,
  `sm_ket` varchar(100) default NULL,
  `sm_sts` varchar(1) default NULL,
  PRIMARY KEY  (`pel_no`,`sm_tgl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tr_dkd` */

DROP TABLE IF EXISTS `tr_dkd`;

CREATE TABLE `tr_dkd` (
  `kp_kode` varchar(10) default NULL,
  `dkd_kd` int(5) NOT NULL,
  `dkd_no` varchar(4) default NULL,
  `dkd_nama` varchar(25) default NULL,
  `dkd_jalan` varchar(25) default NULL,
  `dkd_rayon` varchar(4) default NULL,
  `dkd_loket` varchar(2) default NULL,
  `dkd_pembaca` varchar(25) default NULL,
  `dkd_tcatat` varchar(2) default NULL,
  PRIMARY KEY  (`dkd_kd`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tr_gol` */

DROP TABLE IF EXISTS `tr_gol`;

CREATE TABLE `tr_gol` (
  `gol_kode` varchar(18) default NULL,
  `gol_ket` varchar(60) default NULL,
  `gol_sts` double default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tr_klaim` */

DROP TABLE IF EXISTS `tr_klaim`;

CREATE TABLE `tr_klaim` (
  `kl_kode` varchar(4) NOT NULL,
  `kl_ket` varchar(50) default NULL,
  PRIMARY KEY  (`kl_kode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tr_kondisi_lingkungan` */

DROP TABLE IF EXISTS `tr_kondisi_lingkungan`;

CREATE TABLE `tr_kondisi_lingkungan` (
  `kl_kd` varchar(10) NOT NULL,
  `kl_ket` varchar(50) default NULL,
  PRIMARY KEY  (`kl_kd`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tr_kondisi_ps` */

DROP TABLE IF EXISTS `tr_kondisi_ps`;

CREATE TABLE `tr_kondisi_ps` (
  `kps_kode` int(2) NOT NULL,
  `kps_ket` varchar(50) default NULL,
  PRIMARY KEY  (`kps_kode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tr_kondisi_wm` */

DROP TABLE IF EXISTS `tr_kondisi_wm`;

CREATE TABLE `tr_kondisi_wm` (
  `kwm_kd` varchar(10) NOT NULL,
  `kwm_ket` varchar(50) default NULL,
  PRIMARY KEY  (`kwm_kd`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tr_merk` */

DROP TABLE IF EXISTS `tr_merk`;

CREATE TABLE `tr_merk` (
  `mer_kode` varchar(2) NOT NULL,
  `mer_ket` varchar(50) default NULL,
  PRIMARY KEY  (`mer_kode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `tr_ukuranmeter` */

DROP TABLE IF EXISTS `tr_ukuranmeter`;

CREATE TABLE `tr_ukuranmeter` (
  `um_kode` varchar(1) NOT NULL,
  `um_ukuran` varchar(3) default NULL,
  `um_biaya` double default NULL,
  `um_digit` int(11) default '6',
  PRIMARY KEY  (`um_kode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;