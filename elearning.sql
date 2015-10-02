-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 23, 2012 at 08:33 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `elearning`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `file`
-- 

CREATE TABLE `file` (
  `id_file` int(10) NOT NULL auto_increment,
  `nama_file` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `tgl_upload` date NOT NULL,
  PRIMARY KEY  (`id_file`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

-- 
-- Dumping data for table `file`
-- 

INSERT INTO `file` VALUES (39, '808_juned_KOPOUTL.TIF', 'image/tiff', 'juned', '2012-05-23');
INSERT INTO `file` VALUES (40, '478_juned_KOPTI.TIF', 'image/tiff', 'juned', '2012-05-23');
INSERT INTO `file` VALUES (43, '871_jujun_KOPOUTL.TIF', 'image/tiff', 'jujun', '2012-05-23');
INSERT INTO `file` VALUES (42, '832_jujun_MTQ.TIF', 'image/tiff', 'jujun', '2012-05-23');

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hak_akses` varchar(10) NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` VALUES ('oktian', '58b1216b06850385d9a4eadbedc806c4', 'Oktian Teguh', 'admin');
INSERT INTO `user` VALUES ('darul', '58b1216b06850385d9a4eadbedc806c4', 'Darul Alam', 'siswa');
INSERT INTO `user` VALUES ('jujun', 'c56d0e9a7ccec67b4ea131655038d604', 'Jujun Juhaeli, S.Pd', 'guru');
INSERT INTO `user` VALUES ('juned', 'c56d0e9a7ccec67b4ea131655038d604', 'Junaedi Salim, S.Pd', 'guru');
INSERT INTO `user` VALUES ('oki', '58b1216b06850385d9a4eadbedc806c4', 'Oktian', 'admin');
INSERT INTO `user` VALUES ('oktian89', '58b1216b06850385d9a4eadbedc806c4', 'Oktian', 'siswa');
