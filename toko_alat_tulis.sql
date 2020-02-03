-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2016 at 01:57 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toko_alat_tulis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_app`
--

CREATE TABLE IF NOT EXISTS `tb_app` (
`id` int(11) NOT NULL,
  `app_param` varchar(50) NOT NULL,
  `app_value` varchar(500) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_app`
--

INSERT INTO `tb_app` (`id`, `app_param`, `app_value`) VALUES
(1, 'company_name', 'Toko Alat Tulis Sentosa'),
(2, 'company_address', 'Jalan Raya Depok No.56, Depok, Jawa Barat');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_transaksi`
--

CREATE TABLE IF NOT EXISTS `tb_detail_transaksi` (
`id` int(11) NOT NULL,
  `no_faktur` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id`, `no_faktur`, `id_produk`, `quantity`, `subtotal`) VALUES
(11, 1, 6, 1, 2500),
(12, 2, 8, 20, 60000),
(13, 22, 18, 13, 75000),
(14, 3, 6, 1, 2500);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE IF NOT EXISTS `tb_produk` (
`id_produk` int(11) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga`) VALUES
(6, 'ACC-001', 'Gelang Karet', 2500),
(7, 'ACC-002', 'Batu Satam Toboali', 100000),
(8, 'ACC-003', 'Sticker Motor PG-AA', 3000),
(9, 'ACC-004', 'Gantungan Kunci ', 5000),
(11, 'ACC-006', 'Korek Api Cricket', 7000),
(12, 'ACC-007', 'Solasi Berwarna', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok`
--

CREATE TABLE IF NOT EXISTS `tb_stok` (
`id_stok` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tb_stok`
--

INSERT INTO `tb_stok` (`id_stok`, `id_produk`, `jumlah_stok`) VALUES
(1, 6, 93),
(2, 7, 9),
(3, 8, 8),
(4, 9, 49),
(6, 11, 20),
(7, 12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi` (
`no_faktur` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bayar` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`no_faktur`, `tanggal`, `bayar`, `total`) VALUES
(1, '2016-07-31', 5000, 2500),
(2, '2016-07-31', 70000, 60000),
(3, '2016-07-31', 5000, 2500),
(4, '2016-09-31', 15000, 1200);;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
`id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', 'YWRtaW4=');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_app`
--
ALTER TABLE `tb_app`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
 ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tb_stok`
--
ALTER TABLE `tb_stok`
 ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
 ADD PRIMARY KEY (`no_faktur`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_app`
--
ALTER TABLE `tb_app`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tb_stok`
--
ALTER TABLE `tb_stok`
MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
MODIFY `no_faktur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
