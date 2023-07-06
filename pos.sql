-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2017 at 07:44 
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `pos_beli`
--

CREATE TABLE `pos_beli` (
  `id_beli` int(11) NOT NULL,
  `no_trans` char(15) NOT NULL,
  `supplier` char(50) NOT NULL,
  `nama_barang` char(50) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `ket` char(50) NOT NULL,
  `total` int(11) NOT NULL,
  `uploader` char(50) NOT NULL,
  `time_upload` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_beli`
--

INSERT INTO `pos_beli` (`id_beli`, `no_trans`, `supplier`, `nama_barang`, `kd_barang`, `harga_beli`, `harga_jual`, `qty`, `ket`, `total`, `uploader`, `time_upload`) VALUES
(1, 'B-170604-0001', 'PT MAJU MUNDUR', 'Windows 10 Pro', 'WIN10', 900000, 1100000, 10, 'unit', 9000000, 'superadmin', '2017-06-04'),
(2, 'B-170604-0002', 'PT MAJU MUNDUR', 'Windows 7 PRO', 'WIN7', 700000, 850000, 5, 'unit', 3500000, 'superadmin', '2017-06-04');

--
-- Triggers `pos_beli`
--
DELIMITER $$
CREATE TRIGGER `beli_barang` AFTER INSERT ON `pos_beli` FOR EACH ROW BEGIN
INSERT INTO pos_stok SET
kd_barang = NEW.kd_barang, qty=New.qty
ON DUPLICATE KEY UPDATE qty=qty+New.qty;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pos_jual`
--

CREATE TABLE `pos_jual` (
  `id_jual` int(11) NOT NULL,
  `no_trans` char(15) NOT NULL,
  `pembeli` char(50) NOT NULL,
  `kd_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_jual` int(5) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `ket` char(50) NOT NULL,
  `uploader` char(50) NOT NULL,
  `time_upload` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_jual`
--

INSERT INTO `pos_jual` (`id_jual`, `no_trans`, `pembeli`, `kd_barang`, `nama_barang`, `harga_jual`, `qty`, `total`, `ket`, `uploader`, `time_upload`) VALUES
(1, 'J-170604-0001', 'Joni', 'WIN10', 'WIN10', 1100000, 2, 2200000, 'unit', 'superadmin', '2017-06-04'),
(2, 'J-170604-0002', 'Bambang', 'WIN10', 'WIN10', 1100000, 1, 1100000, 'unit', 'superadmin', '2017-06-04'),
(3, 'J-170604-0002', 'Bambang', 'WIN7', 'WIN7', 850000, 2, 1700000, 'unit', 'superadmin', '2017-06-04');

--
-- Triggers `pos_jual`
--
DELIMITER $$
CREATE TRIGGER `jual_barang` AFTER INSERT ON `pos_jual` FOR EACH ROW BEGIN
UPDATE pos_stok
SET qty = qty - NEW.qty
WHERE
kd_barang = NEW.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pos_pengaturan`
--

CREATE TABLE `pos_pengaturan` (
  `id` int(11) NOT NULL,
  `nama` char(50) NOT NULL,
  `slug` char(20) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_pengaturan`
--

INSERT INTO `pos_pengaturan` (`id`, `nama`, `slug`, `isi`) VALUES
(1, 'Nama Perusahaan', 'nama_perusahaan', 'PT SEJAHTERA SENTOSA'),
(2, 'Alamat', 'alamat', 'Jl. Merdeka Jaya Sejahtera Indonesia, No. xxx');

-- --------------------------------------------------------

--
-- Table structure for table `pos_stok`
--

CREATE TABLE `pos_stok` (
  `kd_barang` varchar(5) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_stok`
--

INSERT INTO `pos_stok` (`kd_barang`, `qty`) VALUES
('WIN10', 7),
('WIN7', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pos_user`
--

CREATE TABLE `pos_user` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` char(20) NOT NULL,
  `usertype` int(11) NOT NULL,
  `time_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_user`
--

INSERT INTO `pos_user` (`id_user`, `nama_user`, `username`, `password`, `email`, `usertype`, `time_upload`) VALUES
(1, 'Superadmin', 'super', '$2a$12$c/ALR264.FA8mNHEsUW9wOd8x07gSKVQtzKBQ8vyZ/mEwqX6iiSlq', 'superadmin@gmail.com', 1, '2017-05-28'),
(2, 'Administrator', 'admin', '$2a$12$qrXUBMdI2mnGHavDC38ckePhGctKX7wCg2sXwblXyptBrgrNvGNp6', 'admin@gmail.com', 2, '2017-05-28'),
(3, 'Aris', 'aris', '$2a$12$gQw5kwuc49BMD8S7lSvdmep/hKc7ZUPrQJhdDGJLTSwyLeTUKLb1a', 'aris@gmail.com', 2, '2017-05-30'),
(4, 'Sira', 'sira', '$2a$12$aFCRKA25Tpu/xRNwGrCayuo3FvAKzsiq3gJLBvzPDpZkDxt4i.pu2', 'sira@gmail.com', 2, '2017-06-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pos_beli`
--
ALTER TABLE `pos_beli`
  ADD PRIMARY KEY (`id_beli`);

--
-- Indexes for table `pos_jual`
--
ALTER TABLE `pos_jual`
  ADD PRIMARY KEY (`id_jual`);

--
-- Indexes for table `pos_pengaturan`
--
ALTER TABLE `pos_pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_stok`
--
ALTER TABLE `pos_stok`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `pos_user`
--
ALTER TABLE `pos_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pos_beli`
--
ALTER TABLE `pos_beli`
  MODIFY `id_beli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pos_jual`
--
ALTER TABLE `pos_jual`
  MODIFY `id_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pos_pengaturan`
--
ALTER TABLE `pos_pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pos_user`
--
ALTER TABLE `pos_user`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
