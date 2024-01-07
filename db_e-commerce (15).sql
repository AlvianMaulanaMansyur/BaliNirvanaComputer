-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 07, 2024 at 08:49 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password_admin` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password_admin`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_customer`, `create_time`) VALUES
(220, 3, '2023-12-21 11:47:29'),
(232, 6, '2023-12-22 15:07:19'),
(233, 6, '2023-12-22 15:09:23'),
(244, 7, '2023-12-25 11:35:10'),
(252, 1, '2023-12-30 01:43:45'),
(253, 8, '2023-12-30 11:51:44'),
(269, 8, '2024-01-07 07:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `nama_category` varchar(15) NOT NULL,
  `foto_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `nama_category`, `foto_category`) VALUES
(1, 'Laptop', 'assets/foto/259.jpeg'),
(2, 'Aksesoris', 'assets/foto/huawei1.jpg'),
(3, 'Printer', 'assets/foto/328.jpeg'),
(4, 'Tinta', 'assets/foto/tinta.jpeg'),
(5, 'Networking', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_customer` varchar(256) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `username`, `password_customer`, `nama_customer`, `email`, `telepon`) VALUES
(1, 'user', 'user', 'user4', 'user@gmail.com', '088888'),
(3, 'halo', 'halo', 'halo', 'halo@gmail.com', '088888'),
(4, 'abi', 'abi', 'abi', 'abi@gmail.com', '0888'),
(5, 'beo', 'beo', 'beo', 'beo@gmail.com', '89000191'),
(6, 'kitasangatsenang', 'kitasangatsenang1', 'kita', 'kita@gmail.com', '98761443'),
(7, 'customer', '12345678', 'customer', 'customer@gmail.com', 'customerr'),
(8, 'suastika', '12345678', 'I Wayan Suastika Putra', 'putrasuastika78@gmail.com', '085829042478');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `qty_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail_pesanan`, `id_produk`, `id_pesanan`, `qty_produk`) VALUES
(135, 45, 108, 1),
(136, 43, 108, 1),
(137, 41, 109, 1),
(138, 41, 110, 1),
(139, 41, 111, 1),
(140, 46, 112, 1),
(141, 40, 113, 1),
(142, 41, 113, 1),
(143, 45, 113, 1),
(144, 47, 114, 1),
(145, 40, 115, 1),
(146, 41, 116, 112),
(147, 47, 116, 1),
(148, 40, 117, 11),
(149, 41, 117, 10),
(150, 44, 117, 1),
(151, 46, 118, 1),
(152, 40, 119, 11),
(153, 44, 119, 1),
(154, 41, 120, 1),
(155, 41, 122, 1),
(156, 44, 123, 999),
(157, 43, 124, 2),
(158, 44, 124, 1),
(159, 41, 125, 1),
(160, 44, 125, 21),
(161, 41, 126, 1),
(162, 45, 127, 10),
(163, 43, 128, 1),
(164, 45, 129, 1),
(165, 48, 130, 1),
(166, 45, 131, 1),
(167, 48, 132, 1),
(168, 40, 133, 3),
(169, 41, 133, 1),
(170, 43, 133, 1),
(171, 44, 133, 2),
(172, 45, 133, 8),
(173, 45, 134, 1),
(174, 49, 135, 4);

-- --------------------------------------------------------

--
-- Table structure for table `foto_produk`
--

CREATE TABLE `foto_produk` (
  `id_foto` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `url_foto` varchar(255) DEFAULT NULL,
  `urutan_foto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto_produk`
--

INSERT INTO `foto_produk` (`id_foto`, `id_produk`, `url_foto`, `urutan_foto`) VALUES
(32, 40, 'assets/foto/162.jpeg', 1),
(33, 41, 'assets/foto/printer4.png', 1),
(34, 42, 'assets/foto/241.jpeg', 1),
(36, 44, 'assets/foto/printer5.png', 1),
(37, 45, 'assets/foto/asus123.png', 1),
(38, 46, 'assets/foto/bank1.jpg', 1),
(39, 47, 'assets/foto/huawei25.jpg', 1),
(58, 44, 'assets/foto/254.jpeg', 2),
(65, 49, 'assets/foto/huawei25.jpg\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `kecamatan` varchar(20) NOT NULL,
  `id_kota_kab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `kecamatan`, `id_kota_kab`) VALUES
(1, 'Kuta Selatan', 1),
(2, 'Kuta', 1),
(3, 'Tabanan', 2),
(4, 'tus', 2),
(8, 'Kuta Selata', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kota_kab`
--

CREATE TABLE `kota_kab` (
  `id_kota_kab` int(11) NOT NULL,
  `kota` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kota_kab`
--

INSERT INTO `kota_kab` (`id_kota_kab`, `kota`) VALUES
(1, 'Badung'),
(2, 'Tabanan'),
(3, 'Buleleng'),
(4, 'Karangasem'),
(5, 'Gianyar'),
(6, 'Jembrana'),
(7, 'Kota Denpasar'),
(8, 'Klungkung'),
(9, 'Bangli');

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `id_personal_info` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `detail_alamat` text DEFAULT NULL,
  `kodepos` char(5) NOT NULL,
  `id_kecamatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`id_personal_info`, `id_customer`, `alamat`, `detail_alamat`, `kodepos`, `id_kecamatan`) VALUES
(1, 1, 'Jln. Mawar', '', '80362', 3),
(2, 4, 'Jln. Mawar', NULL, '88888', 1),
(3, 3, 'Jln. Halo', '', '89012', 3),
(4, 5, 'Jln. Pegunungan', 'dekat warung be guling', '87890', 3),
(5, 6, 'Jln. Mawar', 'halo', '12345', 1),
(6, 7, 'Jln. Mawar', '', '12345', 1),
(9, 8, 'Jln. Jimbaran Hijau Kelod', 'dekat warung be guling', '12345', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `alamat_pengiriman` varchar(255) NOT NULL,
  `detail_alamat_pengiriman` text DEFAULT NULL,
  `status_pesanan` tinyint(4) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_customer`, `alamat_pengiriman`, `detail_alamat_pengiriman`, `status_pesanan`, `create_time`) VALUES
(108, 1, 'Jln. Mawar, Tabanan, Tabanan, 80362', '', 1, '2023-12-21 10:39:40'),
(109, 3, 'Jln. Halo, Tabanan, Tabanan, 89012', '', 1, '2023-12-21 10:58:04'),
(110, 3, 'Jln. Halo, Tabanan, Tabanan, 89012', '', 1, '2023-12-21 11:44:52'),
(111, 6, 'Jln. Mawar, Kuta Selatan, Badung, 12345', 'halo', 1, '2023-12-21 12:25:53'),
(112, 6, 'Jln. Mawar, Kuta Selatan, Badung, 12345', 'halo', 1, '2023-12-21 12:29:11'),
(113, 6, 'Jln. Mawar, Kuta Selatan, Badung, 12345', 'halo', 1, '2023-12-22 10:38:26'),
(114, 6, 'Jln. Mawar, Kuta Selatan, Badung, 12345', 'halo', 2, '2023-12-22 12:38:36'),
(115, 6, 'Jln. Mawar, Kuta Selatan, Badung, 12345', 'halo', 2, '2023-12-22 13:11:30'),
(116, 6, 'Jln. Mawar, Kuta Selatan, Badung, 12345', 'halo', 1, '2023-12-22 13:48:23'),
(117, 1, 'Jln. Mawar, Tabanan, Tabanan, 80362', '', 0, '2023-12-24 02:55:15'),
(118, 7, 'Jln. Mawar, Tabanan, Tabanan, 12345', '', 0, '2023-12-25 06:40:34'),
(119, 7, 'Jln. Mawar, , , ', '', 0, '2023-12-25 09:08:12'),
(120, 7, 'Jln. Mawar, , , ', '', 0, '2023-12-25 09:08:45'),
(121, 7, 'Jln. Mawar, Tabanan, Tabanan, 12345', '', 0, '2023-12-25 09:13:38'),
(122, 7, 'Jln. Mawar, Tabanan, Tabanan, 12345', '', 0, '2023-12-25 09:13:58'),
(123, 7, 'Jln. Mawar, Tabanan, Tabanan, 12345', '', 0, '2023-12-25 09:54:15'),
(124, 7, 'Jln. Mawar, Kuta Selatan, Badung, 12345', '', 0, '2023-12-25 11:33:27'),
(125, 1, 'Jln. Mawar, Tabanan, Tabanan, 80362', '', 0, '2023-12-26 04:00:06'),
(126, 1, 'Jln. Mawar, Tabanan, Tabanan, 80362', '', 0, '2023-12-26 09:15:20'),
(127, 1, 'Jln. Mawar, Tabanan, Tabanan, 80362', '', 0, '2023-12-26 10:29:26'),
(128, 8, 'Jln. Jimbaran Hijau Kelod, , , ', 'disamping mcd', 1, '2023-12-26 12:25:05'),
(129, 8, 'Jln. Jimbaran Hijau Kelod, , , ', 'dekat warung be guling', 2, '2023-12-26 12:37:43'),
(130, 8, 'Jln. Jimbaran Hijau Kelod, Kuta Selatan, Badung, 12345', 'dekat warung be guling', 0, '2023-12-26 12:42:07'),
(131, 8, 'Jln. Jimbaran Hijau Kelod, Tabanan, Tabanan, 12345', 'dekat warung be guling', 0, '2023-12-26 12:43:55'),
(132, 8, 'Jln. Jimbaran Hijau Kelod, Tabanan, Tabanan, 12345', 'dekat warung be guling', 1, '2023-12-27 03:52:18'),
(133, 8, 'Jln. Jimbaran Hijau Kelod, Tabanan, Tabanan, 12345', 'dekat warung be guling', 0, '2023-12-31 16:22:38'),
(134, 8, 'Jln. Jimbaran Hijau Kelod, Tabanan, Tabanan, 12345', 'dekat warung be guling', 1, '2024-01-02 01:27:59'),
(135, 8, 'Jln. Jimbaran Hijau Kelod, Tabanan, Tabanan, 12345', 'dekat warung be guling', 0, '2024-01-06 23:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_produk` varchar(45) NOT NULL,
  `stok_produk` int(11) DEFAULT NULL,
  `harga_produk` int(11) NOT NULL,
  `diskon` float DEFAULT NULL,
  `deskripsi_produk` longtext DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT current_timestamp(),
  `slug` varchar(100) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_category`, `id_admin`, `nama_produk`, `stok_produk`, `harga_produk`, `diskon`, `deskripsi_produk`, `create_time`, `slug`, `deleted`) VALUES
(40, 3, 1, '12334', 11, 98998896, NULL, 'uiuiui', '2023-12-20 00:56:32', '', 1),
(41, 2, 1, 'Wii', 7, 123456792, NULL, '12345', '2023-12-20 02:05:59', '', 1),
(42, 2, 1, 'Pepsodent', 12, 123456792, NULL, 'asdasf', '2023-12-20 02:07:49', 'pepsodent-3', 0),
(43, 1, 1, 'aaa', 1, 2147483640, NULL, 'ASUS ROG Zephyrus - Performa Tinggi dalam Desain Elegan\r\n\r\nSpesifikasi Utama:\r\n\r\nProsesor: Intel® Ice Lake-U i5-1035G7\r\nLayar: 14\'\' 16:10 FHD 1920*1200 IPS\r\nGPU: Intel Integrated Graphics\r\nRAM: 8GB DDR4 SODIMM (Upgradeable)\r\nPenyimpanan: 256GB M.2 2280 Sata/PCIe4.0 (Upgradeable)\r\nKamera: Ya\r\nWIFI: 802.11 b/g/n/ac/ax\r\nBluetooth: Ya\r\nSpeaker: 2x Box Speakers 4Ω 2W\r\nBaterai: Polymer 6600 mAh, 50.16Wh\r\nUkuran: 311.6217.816.8mm\r\nSistem Operasi: Windows 11 Original Gratis\r\nPort:\r\n\r\n1x USB Type C 3.2 Gen1 (PD/DP/Charger/Data)\r\n1x USB Type C PD only\r\n2x USB 3.2 Gen1 & 1x USB 2.0\r\n1x Standard HDMI 1.4\r\n1x Jack Earphone 3.5mm\r\nFitur ASUS ROG Zephyrus:\r\n\r\nLaptop ASUS ROG Zephyrus menawarkan performa tinggi dengan prosesor Intel® Ice Lake-U i5-1035G7, ideal untuk tugas-tugas berat seperti programming, gaming, dan content creation.\r\n\r\nLayar 14 inci dengan rasio 16:10 dan resolusi FHD 1920*1200 memberikan pengalaman visual yang memukau dan mendetail.\r\n\r\nDesain yang elegan dengan warna Grey yang siap tersedia dan Gold untuk Pre-Order.\r\n\r\nPenyimpanan 256GB M.2 2280 Sata/PCIe4.0 yang dapat di-upgrade memberikan fleksibilitas dalam penyimpanan data.\r\n\r\nKoneksi yang cepat dengan WIFI 802.11 b/g/n/ac/ax dan Bluetooth.\r\n\r\nSistem operasi Windows 11 Original gratis untuk pengalaman pengguna yang mulus.\r\n\r\nDesain yang Praktis dan Ringan:\r\n\r\nLaptop ini dapat dibuka hingga 165°, memudahkan presentasi dan kolaborasi.\r\n\r\nDengan berat hanya 1.2 Kg, laptop ini sangat portabel dan nyaman untuk dibawa ke mana saja.\r\n\r\nMaterial metal dengan ketebalan hanya 16.8mm memberikan kesan elegan dan kokoh.\r\n\r\nKelengkapan Unit:\r\n\r\nBox/Dus Laptop\r\nUnit Laptop\r\nCharger\r\nKartu Garansi\r\nManual Book', '2023-12-20 02:14:15', '', 1),
(44, 2, 1, 'Printer Scan Copy Wifi HP 580 Ink Tank', 1234, 2175000, NULL, '12324', '2023-12-20 02:23:53', 'printer-scan-copy-wifi-hp-580-ink-tank', 0),
(45, 1, 1, 'Pepsodent', 9, 1000000000, NULL, '1212', '2023-12-20 02:24:32', '', 1),
(46, 1, 1, 'Pepsodent', 0, 1, NULL, '1', '2023-12-20 02:25:13', '', 1),
(47, 3, 1, 'Pepsodent', 122, 1000000000, NULL, '123', '2023-12-20 02:26:55', 'pepsodent-5', 0),
(48, 3, 1, 'Pepsodent', 0, 999999999, NULL, '1234', '2023-12-20 02:28:13', '', 1),
(49, 1, 1, 'Pepsodent', 12345, 2147483647, NULL, '1234', '2023-12-20 02:40:53', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk_has_cart`
--

CREATE TABLE `produk_has_cart` (
  `id_produk` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `qty_produk` int(11) NOT NULL,
  `is_check` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_has_cart`
--

INSERT INTO `produk_has_cart` (`id_produk`, `id_cart`, `qty_produk`, `is_check`) VALUES
(40, 233, 7, '1'),
(41, 232, 4, '1'),
(44, 269, 4, '1'),
(45, 244, 10, '1'),
(45, 252, 10, '1'),
(47, 220, 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `fk_cart_customer1_idx` (`id_customer`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `fk_pesanan_produk1_idx` (`id_produk`),
  ADD KEY `fk_detail_pesanan_pesanan1_idx` (`id_pesanan`);

--
-- Indexes for table `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`),
  ADD KEY `fk_kecamatan_kota1_idx` (`id_kota_kab`);

--
-- Indexes for table `kota_kab`
--
ALTER TABLE `kota_kab`
  ADD PRIMARY KEY (`id_kota_kab`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`id_personal_info`),
  ADD KEY `fk_personal_info_customer1_idx` (`id_customer`),
  ADD KEY `fk_personal_info_kecamatan1_idx` (`id_kecamatan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `fk_pesanan_customer1_idx` (`id_customer`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `fk_Produk_Category1_idx` (`id_category`),
  ADD KEY `fk_Produk_admin1_idx` (`id_admin`);

--
-- Indexes for table `produk_has_cart`
--
ALTER TABLE `produk_has_cart`
  ADD PRIMARY KEY (`id_produk`,`id_cart`),
  ADD KEY `fk_produk_has_cart_cart1_idx` (`id_cart`),
  ADD KEY `fk_produk_has_cart_produk1_idx` (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kota_kab`
--
ALTER TABLE `kota_kab`
  MODIFY `id_kota_kab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id_personal_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_customer1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `fk_detail_pesanan_pesanan1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pesanan_produk10` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD CONSTRAINT `foto_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `fk_kecamatan_kota1` FOREIGN KEY (`id_kota_kab`) REFERENCES `kota_kab` (`id_kota_kab`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD CONSTRAINT `fk_personal_info_customer1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personal_info_kecamatan1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_pesanan_customer1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_Produk_Category1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Produk_admin1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `produk_has_cart`
--
ALTER TABLE `produk_has_cart`
  ADD CONSTRAINT `fk_produk_has_cart_cart1` FOREIGN KEY (`id_cart`) REFERENCES `cart` (`id_cart`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produk_has_cart_produk1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
