-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2023 at 06:24 AM
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

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail_pesanan`, `id_produk`, `id_pesanan`, `qty_produk`) VALUES
(127, 32, 102, 5),
(128, 32, 103, 1),
(129, 32, 104, 1),
(130, 32, 105, 2),
(131, 34, 105, 1),
(132, 35, 105, 1),
(133, 33, 106, 3),
(134, 33, 107, 1);

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
(22, 32, 'assets/foto/155.jpeg', 1),
(23, 32, 'assets/foto/235.jpeg', 2),
(24, 33, 'assets/foto/240.jpeg', 1),
(25, 34, 'assets/foto/asus122.png', 1),
(26, 35, 'assets/foto/huawei24.jpg', 1),
(27, 36, 'assets/foto/jj2.jpg', 1);

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
  `harga_produk` float NOT NULL,
  `diskon` float DEFAULT NULL,
  `deskripsi_produk` longtext DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_category`, `id_admin`, `nama_produk`, `stok_produk`, `harga_produk`, `diskon`, `deskripsi_produk`, `create_time`) VALUES
(32, 1, 1, 'Pepsodent', 2, 2000000, NULL, 'ASUS ROG Zephyrus G14 adalah laptop gaming yang dirancang untuk memberikan performa yang luar biasa dan portabilitas yang unggul. Laptop ini ditenagai oleh prosesor AMD Ryzen 9 6900HS dan kartu grafis NVIDIA GeForce RTX 3070Ti, yang mampu menjalankan game-game terbaru dengan lancar dan grafis yang memukau.\r\n\r\nLaptop ini juga memiliki layar 14 inci dengan resolusi QHD (2560 x 1440) dan refresh rate 165Hz, yang memberikan pengalaman bermain game yang mulus dan responsif. Selain itu, laptop ini juga dilengkapi dengan keyboard mekanis RGB yang memberikan pengalaman mengetik yang nyaman dan presisi.\r\n\r\nASUS ROG Zephyrus G14 juga memiliki desain yang ramping dan ringan, dengan ketebalan hanya 17,9 mm dan berat 1,6 kg. Laptop ini juga dilengkapi dengan baterai berkapasitas 76WHr yang mampu bertahan hingga 10 jam penggunaan.\r\n\r\nBerikut adalah spesifikasi lengkap ASUS ROG Zephyrus G14:\r\n\r\nProsesor: AMD Ryzen 9 6900HS\r\nKartu grafis: NVIDIA GeForce RTX 3070Ti\r\nLayar: 14 inci QHD (2560 x 1440) IPS-Type, 165Hz, Pantone Validated\r\nRAM: 16GB DDR5\r\nPenyimpanan: 1TB PCIe SSD\r\nKeyboard: Keyboard mekanis RGB\r\nBaterai: 76WHr\r\nKelebihan ASUS ROG Zephyrus G14:\r\n\r\nPerforma yang luar biasa untuk bermain game\r\nLayar yang tajam dan responsif\r\nKeyboard mekanis yang nyaman\r\nDesain yang ramping dan ringan\r\nDaya tahan baterai yang lama\r\nKekurangan ASUS ROG Zephyrus G14:\r\n\r\nHarga yang relatif mahal\r\nSuara kipas yang cukup bising saat digunakan dalam performa tinggi\r\nASUS ROG Zephyrus G14 adalah laptop gaming yang ideal untuk para gamer yang menginginkan performa yang luar biasa dan portabilitas yang unggul. Laptop ini cocok untuk digunakan bermain game terbaru, membuat konten, atau sekadar bekerja di mana saja.', '2023-12-14 21:48:23'),
(33, 1, 1, 'Asus', 3, 200000000, NULL, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum inventore odio tenetur harum ad voluptatum architecto sunt eos debitis optio. Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore perspiciatis velit nihil eos vitae, autem laboriosam sunt officia? Delectus nemo facilis dignissimos incidunt nesciunt tempore itaque laborum aliquid iste voluptatem repudiandae fugit soluta, tenetur, nam beatae deserunt. Doloribus ipsa id delectus corrupti a labore officia explicabo expedita reprehenderit natus tenetur in odit, harum alias quasi, magnam rem ad veritatis recusandae laborum! Amet obcaecati fuga vitae voluptate, cupiditate reprehenderit accusantium, sed saepe id libero ipsum? Perferendis iusto sequi fuga temporibus praesentium, necessitatibus quae architecto laudantium iure vel culpa quia deleniti? Cum neque voluptate nisi libero delectus voluptatum consequuntur quisquam, harum quo voluptas enim beatae possimus repellat tempore molestias. Modi voluptatum nesciunt illum alias optio unde quo perferendis et, explicabo quidem? Dolor dolorum aut accusamus nemo similique provident corrupti nisi voluptas distinctio accusantium. Rerum odit ipsam nam, beatae dignissimos vero enim facere ut, nulla culpa corrupti? Beatae dolorum minima laudantium, laborum voluptatem deserunt voluptatum consectetur dolorem ut laboriosam nobis, blanditiis error esse quibusdam similique odio. Aperiam blanditiis cupiditate nam voluptas, natus tenetur voluptatem ex! Aperiam sunt fugiat consequatur nesciunt quaerat voluptatum harum rerum quasi tempore ex, non culpa facere maiores dicta ea maxime suscipit obcaecati repudiandae! Minus quisquam vitae veritatis nihil aspernatur at impedit, magni perspiciatis eveniet fugit? Et impedit est accusantium minus animi iste nisi. Consequatur minima ipsam aliquam, nesciunt alias illum maxime reprehenderit blanditiis a quam dolorem distinctio, laborum maiores minus ullam? Excepturi earum suscipit eveniet aperiam architecto ut? Corporis nobis excepturi asperiores expedita commodi facilis nam debitis ex, error quidem, a ipsum rem odio sunt placeat temporibus obcaecati, id dignissimos officiis perspiciatis esse impedit doloribus. Voluptatibus perspiciatis facere sed! Neque vitae voluptatibus recusandae totam, amet iure necessitatibus sed ullam sequi autem excepturi itaque ducimus, nam temporibus ipsum, quisquam id inventore cumque explicabo magni quibusdam aspernatur eum minus. Quibusdam, voluptatum.\r\n', '2023-12-16 19:16:02'),
(34, 2, 1, 'Pepsodent', 1, 123234, NULL, 'halo', '2023-12-17 17:59:49'),
(35, 2, 1, 'Wii', 123, 1230000, NULL, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Distinctio dolore culpa, cum eligendi alias perspiciatis quasi debitis est nisi quisquam maiores dicta maxime optio eius veniam error quam animi, odit ducimus accusantium, tempore molestiae accusamus aliquid. Deserunt quisquam sunt nisi velit sapiente, maiores est dolores! Neque accusamus dolore, quisquam esse amet accusantium a iste dicta veritatis odio. Tenetur ad ipsa illo cum nihil, numquam odio ipsam possimus iusto porro sequi voluptatem minus necessitatibus, inventore omnis obcaecati earum quae hic aperiam? Dolor, perferendis aliquid voluptates, enim autem adipisci sunt modi ea sapiente repellendus assumenda molestias exercitationem temporibus eligendi ducimus quidem molestiae consectetur culpa officia, neque sed tempore aliquam quam. Id fuga modi dignissimos facilis repellat labore debitis mollitia rem corporis nobis!', '2023-12-18 17:37:21'),
(36, 1, 1, 'Pepsodent', 12, 1343, NULL, 'adfhdfhdf\r\n\r\nadfhad\r\nhadf\r\nadf', '2023-12-19 20:42:48');

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
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

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
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
