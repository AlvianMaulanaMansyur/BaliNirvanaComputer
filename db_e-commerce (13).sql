-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2023 at 02:47 PM
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
(212, 1, '2023-12-20 07:56:41'),
(213, 1, '2023-12-20 09:06:25'),
(214, 1, '2023-12-20 12:53:12'),
(215, 1, '2023-12-20 13:16:33');

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
(1, 'Laptop', 'assets/foto/asus1.png'),
(2, 'Aksesoris', 'assets/foto/huawei1.jpg'),
(3, 'Printer', 'assets/foto/printer.png'),
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
(1, 'user', 'user', 'user', 'user@gmail.com', '088888'),
(3, 'halo', 'halo', 'halo', 'halo@gmail.com', '088888'),
(4, 'abi', 'abi', 'abi', 'abi@gmail.com', '0888'),
(5, 'beo', 'beo', 'beo', 'beo@gmail.com', '89000191');

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
(35, 43, 'assets/foto/327.jpeg', 1),
(36, 44, 'assets/foto/249.jpeg', 1),
(37, 45, 'assets/foto/asus123.png', 1),
(38, 46, 'assets/foto/bank1.jpg', 1),
(39, 47, 'assets/foto/huawei25.jpg', 1),
(40, 48, 'assets/foto/164.jpeg', 1),
(41, 49, 'assets/foto/251.jpeg', 1);

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
(3, 'Tabanan', 2);

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
(4, 5, 'Jln. Pegunungan', 'dekat warung be guling', '87890', 3);

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
(102, 1, 'Jln. Mawar, Kuta Selatan, Badung, 80362', 'halao', 0, '2023-12-16 05:14:12'),
(103, 1, 'Jln. Mawar, Kuta Selatan, Badung, 80362', 'halao', 1, '2023-12-16 13:55:31'),
(104, 1, 'Jln. Mawar, Tabanan, Tabanan, 80362', 'halao', 0, '2023-12-16 14:05:44'),
(105, 1, 'Jln. Mawar, Tabanan, Tabanan, 80362', 'halao', 0, '2023-12-19 01:41:39'),
(106, 1, 'Jln. Mawar, Tabanan, Tabanan, 80362', 'halao', 0, '2023-12-20 04:54:53'),
(107, 1, 'Jln. Mawar, Tabanan, Tabanan, 80362', '', 0, '2023-12-20 05:23:18');

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
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_category`, `id_admin`, `nama_produk`, `stok_produk`, `harga_produk`, `diskon`, `deskripsi_produk`, `create_time`, `slug`) VALUES
(40, 3, 1, '12334', 12, 98998896, NULL, 'uiuiui', '2023-12-20 00:56:32', '12334'),
(41, 2, 1, 'Wii', 123, 123456792, NULL, '12345', '2023-12-20 02:05:59', 'wii'),
(42, 2, 1, 'Pepsodent', 12, 123456792, NULL, 'asdasf', '2023-12-20 02:07:49', 'pepsodent-3'),
(43, 1, 1, 'aaa', 1, 123456792, NULL, '1', '2023-12-20 02:14:15', 'aaa'),
(44, 2, 1, 'Pepsodent', 1234, 1000000000, NULL, '12324', '2023-12-20 02:23:53', 'pepsodent-4'),
(45, 1, 1, 'Pepsodent', 12, 1000000000, NULL, '1212', '2023-12-20 02:24:32', 'pepsodent'),
(46, 1, 1, 'Pepsodent', 1, 1, NULL, '1', '2023-12-20 02:25:13', 'pepsodent-1'),
(47, 3, 1, 'Pepsodent', 123, 1000000000, NULL, '123', '2023-12-20 02:26:55', 'pepsodent-5'),
(48, 3, 1, 'Pepsodent', 123, 999999999, NULL, '1234', '2023-12-20 02:28:13', 'pepsodent-6'),
(49, 1, 1, 'Pepsodent', 12345, 2147483647, NULL, '1234', '2023-12-20 02:40:53', 'pepsodent-2');

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
(40, 212, 1, '0'),
(41, 213, 2, '0'),
(43, 215, 1, '1'),
(45, 214, 2, '1');

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
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kota_kab`
--
ALTER TABLE `kota_kab`
  MODIFY `id_kota_kab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id_personal_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
  ADD CONSTRAINT `fk_produk_has_cart_produk1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
