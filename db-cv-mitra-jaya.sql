-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 16, 2023 at 08:51 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-cv-mitra-jaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_produk`
--

CREATE TABLE `detail_produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_produk`
--

INSERT INTO `detail_produk` (`id`, `produk_id`, `desc`, `price`, `note`, `created_at`, `updated_at`) VALUES
(5, 1, 'Banner Bahan Biasa', 10000, 'permeter', '2023-01-08 07:32:49', '2023-01-08 07:32:49'),
(6, 1, 'Banner Bahan Korea', 15000, 'permeter', '2023-01-08 07:33:12', '2023-01-08 07:33:12'),
(7, 2, 'Kalender', 5000, 'Kalender Dinding', '2023-01-08 07:39:41', '2023-01-08 07:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` bigint(20) UNSIGNED NOT NULL,
  `produk_id_detail` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `file_desain` text COLLATE utf8mb4_unicode_ci,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `username`, `nama`, `level`, `password`, `status`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'Halland', 1, '$2y$10$oo41Q0aH0SKPvWkzJ.2Anu5IhAsgqHRI/X.wn4RxLBKE3JxDxrbri', 1, 'assets/karyawan/o1PuEqGr04oiHidB2MxTdozFLtcxiwHcqNKPlyWR.png', '2022-12-11 18:13:09', '2022-12-29 19:24:39'),
(3, 'pimpinan1', 'Ria Irawan Yuni', 3, '$2y$10$UZovCszI2RP2eAzNuCTN2ugbka4dT9XMONepuX46ojQQEAACXLks6', 1, 'assets/karyawan/5SgolJS6n3GzTu5uOJ8Qt0Ypl5X8zbCRoSZDNLOO.png', '2022-12-13 19:53:01', '2023-01-08 07:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `slug`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Banner', 'banner', 'assets/kategori/gjpDbd4zWa8p42Kkd1sTKZ9X6fF2WCXvsi2yAK3h.png', 1, '2022-12-11 20:02:52', '2023-01-08 06:22:29'),
(3, 'Desain Kalender', 'desain-kalender', 'assets/kategori/X1SdjNSJhMLfikHX0s7UCqXC9d5M3XNfXrq748OR.png', 1, '2022-12-12 04:47:28', '2022-12-29 19:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id_detail` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci,
  `file_desain` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_akun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `an` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id`, `nama_pembayaran`, `no_akun`, `an`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gopay', '80888008088', 'CV Mitra Jaya', 'assets/metode-pembayaran/frPo2OMEqVgjl02hcFOa9iSN9SZphxJNatoThZeH.png', 1, '2022-12-12 17:00:04', '2022-12-12 17:35:10'),
(2, 'BCA', '898982912', 'CV Mitra Jaya', 'assets/metode-pembayaran/pEJRuBhWpzOp0D4XBwKo7Jl6bWufvhiwFooHPFxJ.png', 1, '2022-12-29 19:55:29', '2022-12-29 19:57:24'),
(3, 'Cash', 'Cash', 'Cash', 'assets/metode-pembayaran/3jGu2lXvzZC1QN17ojOINKnz2RQaqUsMIWSY0gH2.png', 1, '2022-12-30 06:47:22', '2022-12-30 06:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_12_12_010110_create_karyawans_table', 2),
(5, '2022_12_12_023850_create_kategoris_table', 3),
(6, '2022_12_12_102406_create_produks_table', 4),
(7, '2022_12_12_220738_create_tentangs_table', 5),
(8, '2022_12_12_232159_create_metode_pembayarans_table', 6),
(9, '2022_12_12_233050_add_icon_to_metode_pembayaran_table', 7),
(10, '2022_12_14_025500_create_transaksis_table', 8),
(11, '2022_12_15_015646_create_keranjangs_table', 9),
(12, '2022_12_18_014231_create_detail_transaksis_table', 10),
(13, '2022_12_19_025214_add_bukti_to_transaksi_table', 11),
(14, '2022_12_30_134956_add_metode_pembayaran_to_transaksi_table', 12),
(15, '2022_12_30_135125_add_paid_to_users_table', 12),
(16, '2023_01_06_102613_create_detail_produks_table', 13),
(17, '2023_01_08_143907_add_price_jasa_to_tentang_table', 14),
(18, '2023_01_09_135239_drop_produk_id_from_keranjang_table', 15),
(19, '2023_01_09_135519_drop_produk_id_from_keranjang2_table', 16),
(20, '2023_01_09_145240_drop_produk_id_produk_id_detail_transaksi_table', 17),
(21, '2023_01_09_205515_add_ket_to_keranjang_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_pengerjaan` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama`, `slug`, `harga`, `deskripsi`, `waktu_pengerjaan`, `status`, `foto`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cetak Banner', 'cetak-banner', 0, '<p>Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit. Nam auctor magna nulla, quis sollicitudin urna luctus rhoncus. Morbi facilisis, neque non ornare cursus, ligula turpis laoreet nibh, quis lobortis tortor libero sit amet ligula. Curabitur auctor ipsum nec eleifend convallis. Nullam neque dui, ornare luctus est eget, maximus sodales lacus. Cras a aliquet arcu, id posuere purus. Suspendisse vestibulum arcu laoreet lorem feugiat sagittis. Sed sodales quam diam, ac faucibus magna aliquam eleifend. Phasellus eget sapien eget lorem sollicitudin congue.</strong></p>', 1, 1, 'assets/produk/Ft7uM46THiRfxcliUVNIiCNw4hpz1leyfC1mwSv8.jpg', '2022-12-12 04:38:22', '2023-01-08 07:28:28'),
(2, 3, 'Kalender', 'kalender', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla rhoncus pharetra libero, vel convallis est fringilla non. Ut suscipit vulputate fringilla. In hac habitasse platea dictumst. Nulla pulvinar augue mauris. Maecenas luctus elit in augue tincidunt, id convallis ipsum consequat. Mauris gravida sodales ante sed convallis. Suspendisse et lacus sed leo dignissim vestibulum. Etiam consectetur, magna et sollicitudin blandit, nibh nibh cursus nulla, et mollis purus nibh at risus.</p>', 1, 1, 'assets/produk/2mogceWgCmiwrtU9tN4tPnaYeu6j4ALYS4kUBnr3.jpg', '2022-12-14 19:38:39', '2023-01-08 07:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `tentang`
--

CREATE TABLE `tentang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ig` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hero` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_desain` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tentang`
--

INSERT INTO `tentang` (`id`, `wa`, `alamat`, `email`, `ig`, `fb`, `hero`, `price_desain`, `created_at`, `updated_at`) VALUES
(1, '62895410594324', 'Jl. drs. Warsito no. 24 teluk betung utara, kupang kota, Bandar Lampung', 'mitrajaya_printing@yahoo.co.id', 'https://www.instagram.com/cvmitrajaya/?hl=id', 'https://www.facebook.com/cvmitrajaya/?hl=id', 'assets/tentang/WwDhbvtA85CAAKT9EbRJbBb1CBgpz3aD8noDrQ5R.jpg', 15000, '2022-12-12 15:55:12', '2023-01-08 07:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL DEFAULT '0',
  `kembalian` int(11) NOT NULL DEFAULT '0',
  `bukti_pembayaran` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0',
  `metode_pembayaran_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pelanggan',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `nama`, `no_telp`, `password`, `email_verified_at`, `alamat`, `foto`, `level`, `status`, `created_at`, `updated_at`) VALUES
(2, 'josep.karim1999@gmail.com', 'Ed Sheeran', '089012891288', '$2y$10$E3jWY609L3S1NBP4hh4lbuVASDMfZJJiEDdUwGuxrOL2rXCNSDHJ.', '2022-12-29 21:22:59', NULL, NULL, 'Pelanggan', 1, '2022-12-29 21:19:00', '2022-12-30 19:13:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_produk`
--
ALTER TABLE `detail_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_produk_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_transaksi_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `detail_transaksi_produk_id_detail_foreign` (`produk_id_detail`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `karyawan_username_unique` (`username`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keranjang_user_id_foreign` (`user_id`),
  ADD KEY `keranjang_produk_id_detail_foreign` (`produk_id_detail`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `tentang`
--
ALTER TABLE `tentang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_user_id_foreign` (`user_id`),
  ADD KEY `transaksi_karyawan_id_foreign` (`karyawan_id`),
  ADD KEY `transaksi_metode_pembayaran_id_foreign` (`metode_pembayaran_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`),
  ADD UNIQUE KEY `user_no_telp_unique` (`no_telp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_produk`
--
ALTER TABLE `detail_produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tentang`
--
ALTER TABLE `tentang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_produk`
--
ALTER TABLE `detail_produk`
  ADD CONSTRAINT `detail_produk_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_produk_id_detail_foreign` FOREIGN KEY (`produk_id_detail`) REFERENCES `detail_produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_produk_id_detail_foreign` FOREIGN KEY (`produk_id_detail`) REFERENCES `detail_produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_metode_pembayaran_id_foreign` FOREIGN KEY (`metode_pembayaran_id`) REFERENCES `metode_pembayaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
