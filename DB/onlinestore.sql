-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2022 at 11:15 AM
-- Server version: 10.3.35-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marciusb_onlinestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukti_pembayaran`
--

CREATE TABLE `bukti_pembayaran` (
  `id` int(11) NOT NULL,
  `kode_jual` varchar(30) NOT NULL,
  `nominal` decimal(16,2) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `norek` varchar(30) NOT NULL,
  `bukti_transfer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `kode_customer` varchar(20) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `kota` text NOT NULL,
  `provinsi` text NOT NULL,
  `kecamatan` text NOT NULL,
  `kelurahan` text NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `kode_customer`, `customer_name`, `email`, `kota`, `provinsi`, `kecamatan`, `kelurahan`, `alamat`, `no_telp`, `id_user`) VALUES
(4, 'CS0002', 'Asa', 'asafebri@gmail.com', 'Kota Semarang', 'Jawa Tengah', 'Candisari', 'Tegalsari', 'Jl. Sriwijaya', '2222', 1),
(5, 'CS0005', 'Nindia Saputri', 'nidisap@gmail.com', 'Kota Semarang', 'Jawa Tengah', 'Semarang Selatan', 'Pleburan', 'Jl. Kertanegara Selatan no. 32', '0982726382', 7),
(6, 'CS0006', 'Brian Marcius', 'brianmarcius27@gmail.com', 'Kota Semarang', 'Jawa Tengah', 'Candisari', 'Tegalsari', 'Jl. Genuk Karanglo RT 02 RW 02 No. 11', '089667610554', 8),
(10, 'CS0007', 'test123', 'test@mail.com', 'Kabupaten Aceh Singkil', 'Aceh', 'Singkil', 'Kota Simboling', 'test', '000', 10),
(11, 'CS0011', 'user', 'user@gmail.com', 'Kota Semarang', 'Jawa Tengah', 'Tembalang', 'Jangli', 'Jl. Raya 11', '0', 11),
(12, 'CS0012', 'Ray purba', 'raypurna@gmail.com', 'Kota Yogyakarta', 'Di Yogyakarta', 'Jetis', 'Cokrodiningratan', 'Jl. Jalan', '08888989', 12);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `kode_jual` varchar(20) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_header`
--

CREATE TABLE `penjualan_header` (
  `id` int(11) NOT NULL,
  `kode_jual` varchar(20) NOT NULL,
  `kode_customer` varchar(20) NOT NULL,
  `total` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `grand_total` decimal(15,0) NOT NULL,
  `metode_bayar` varchar(10) NOT NULL,
  `status_pembayaran` int(11) NOT NULL DEFAULT 0,
  `tanggal_jual` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pengiriman` varchar(30) NOT NULL,
  `status_pengiriman` int(11) NOT NULL DEFAULT 0,
  `tgl_pengiriman` timestamp NULL DEFAULT NULL,
  `status_penerimaan` int(11) NOT NULL DEFAULT 0,
  `tgl_penerimaan` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `size` text NOT NULL,
  `img` text DEFAULT NULL,
  `price` decimal(15,0) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `size`, `img`, `price`, `satuan`) VALUES
(1, 'Deformed Bar', 'Round / deformed bar also commonly known as Steel Reinforcing bars are produced by pouring molten steel into casters and then running it through a series of stands in the mill, which shape the steel into reinforcing bars. The cross hatchings, called \"deformations,\" help transfer the load between concrete and steel.\r\n\r\n', '-', 'steel-bar-deformed.jpeg', '75000', 'm'),
(2, 'Wiremesh', 'Salah satu bahan bangunan dan konstruksi yang bisa mempengaruhi ketahanan dari sebuah bangunan adalah besi wiremesh. Wiremesh adalah sebuah rangkaian besi yang tampak seperti lembaran kawat yang sengaja dibuat seolah saling berpotongan antara satu dengan yang lainnya.', '-', 'wiremesh.jpeg', '75000', 'm'),
(3, 'Steel Plate', 'Steel plate', '-', 'steelplate.jpeg', '90000', 'm2'),
(21, 'Steel Plate 1', 'Steel plate 1', '-', 'steelplate.jpeg', '90000', 'm2'),
(22, 'Steel Plate 2', 'Steel plate 2', '-', 'steelplate.jpeg', '90000', 'm2'),
(23, 'Steel Plate 3', 'Steel plate 3', '-', 'steelplate.jpeg', '90000', 'm2'),
(32, 'Test3', 'test', '1', 'js.jpg', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `level` int(11) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `level`, `password`) VALUES
(1, 'Asa Febri', 'Asa', 'asafebri@gmail.com', 2, 'MTIzNDU2Nzg='),
(7, 'Nindia Saputri', 'Nindi', 'nidisap@gmail.com', 2, 'MTIzMTIzMTIz'),
(8, 'Admin', 'admin', 'admin@mail.com', 1, 'MTIzMTIzMTIz'),
(10, 'test123', 'test', 'test@mail.com', 2, 'MDAw'),
(11, 'Asa', 'user', 'user@gmail.com', 2, 'MTIzMTIzMTIz'),
(12, 'Ray purba', 'Ray', 'raypurna@gmail.com', 2, 'dGVzdA==');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan_header`
--
ALTER TABLE `penjualan_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `penjualan_header`
--
ALTER TABLE `penjualan_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
