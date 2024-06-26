-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 01:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `role` enum('Admin','Superadmin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `password`, `role`) VALUES
(1, 'Admin1', '$2y$10$uX3itTjQdztfLR.vyZUF7OFS/NndmW2tFlqPAoqXA1Td0RnraJNxC', 'Admin'),
(2, 'Admin1', '$2y$10$J9wllBKjXmpSEKeJULzJN.1NDle46AGltAz6bW2p6spJAcP9onYFm', 'Admin'),
(3, 'Superadmin', '$2y$10$g8ISDBgdrrOaj2tjbVrjJuou7ccyWy/lAMYBDdp4xtvUng8yoHMae', 'Superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `data_pelaporan_kendaraan`
--

CREATE TABLE `data_pelaporan_kendaraan` (
  `iddata_pelaporan_kendaraan` int(11) NOT NULL,
  `mobil_id` int(11) DEFAULT NULL,
  `laporan_keadaan_kendaraan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notelp` varchar(16) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `nama`, `alamat`, `notelp`, `created_at`, `updated_at`) VALUES
(17, 'Samsul muarif', 'Jl. serayu, Madiun no.9', '081225476548', NULL, NULL),
(21, 'aripin', 'jl.monginsidi', '082554667537', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `nopol` varchar(12) NOT NULL,
  `jenisKendaraan` varchar(50) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`nopol`, `jenisKendaraan`, `tahun`) VALUES
('AE745BA', 'Avanza', 2014),
('AE876BA', 'Hiace', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `idlokasi` int(11) NOT NULL,
  `mobil_id` varchar(12) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`idlokasi`, `mobil_id`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(97, 'AE745BA', -7.640123, 111.544101, '2024-03-25 13:32:09', '2024-03-25 13:32:09'),
(98, 'AE745BA', -7.639963, 111.54416, '2024-03-25 13:33:10', '2024-03-25 13:33:10'),
(99, 'AE745BA', -7.639834, 111.544075, '2024-03-25 13:34:43', '2024-03-25 13:34:43'),
(100, 'AE745BA', -7.639967, 111.544236, '2024-03-25 13:35:45', '2024-03-25 13:35:45'),
(101, 'AE745BA', -7.640018, 111.544264, '2024-03-25 13:36:46', '2024-03-25 13:36:46'),
(102, 'AE745BA', -7.639963, 111.544215, '2024-03-25 13:37:48', '2024-03-25 13:37:48'),
(103, 'AE745BA', -7.639959, 111.544212, '2024-03-25 13:38:49', '2024-03-25 13:38:49'),
(104, 'AE745BA', -7.639933, 111.544149, '2024-03-25 13:39:50', '2024-03-25 13:39:50'),
(105, 'AE745BA', -7.640048, 111.544288, '2024-03-25 13:40:51', '2024-03-25 13:40:51'),
(106, 'AE745BA', -7.640021, 111.544264, '2024-03-25 13:41:52', '2024-03-25 13:41:52'),
(107, 'AE745BA', -7.640042, 111.544286, '2024-03-25 13:42:53', '2024-03-25 13:42:53'),
(108, 'AE745BA', -7.639967, 111.544212, '2024-03-25 13:43:54', '2024-03-25 13:43:54'),
(109, 'AE745BA', -7.640001, 111.544223, '2024-03-25 13:44:54', '2024-03-25 13:44:54'),
(110, 'AE745BA', -7.640006, 111.54412, '2024-03-25 13:45:56', '2024-03-25 13:45:56'),
(111, 'AE745BA', -7.639723, 111.543986, '2024-03-25 13:46:57', '2024-03-25 13:46:57'),
(112, 'AE745BA', -7.638758, 111.540641, '2024-03-25 13:47:57', '2024-03-25 13:47:57'),
(113, 'AE745BA', -7.637483, 111.539804, '2024-03-25 13:48:59', '2024-03-25 13:48:59'),
(114, 'AE745BA', -7.637366, 111.539052, '2024-03-25 13:49:59', '2024-03-25 13:49:59'),
(115, 'AE745BA', -7.634804, 111.541075, '2024-03-25 13:51:01', '2024-03-25 13:51:01'),
(116, 'AE745BA', -7.63576, 111.542604, '2024-03-25 13:52:02', '2024-03-25 13:52:02'),
(117, 'AE745BA', -7.637472, 111.54258, '2024-03-25 13:53:02', '2024-03-25 13:53:02'),
(118, 'AE745BA', -7.638631, 111.543233, '2024-03-25 13:54:03', '2024-03-25 13:54:03'),
(119, 'AE745BA', -7.640533, 111.543593, '2024-03-25 13:55:05', '2024-03-25 13:55:05'),
(120, 'AE745BA', -7.639903, 111.544065, '2024-03-25 13:56:06', '2024-03-25 13:56:06'),
(121, 'AE745BA', -7.639953, 111.544187, '2024-03-25 13:57:07', '2024-03-25 13:57:07'),
(122, 'AE745BA', -7.639796, 111.544479, '2024-03-25 13:58:08', '2024-03-25 13:58:08'),
(123, 'AE745BA', -7.639974, 111.544235, '2024-03-25 13:59:09', '2024-03-25 13:59:09'),
(124, 'AE745BA', -7.639998, 111.544014, '2024-03-25 14:38:00', '2024-03-25 14:38:00'),
(125, 'AE745BA', -7.639884, 111.544217, '2024-03-28 00:17:59', '2024-03-28 00:17:59'),
(126, 'AE745BA', -7.640411, 111.544482, '2024-03-28 00:19:24', '2024-03-28 00:19:24'),
(127, 'AE745BA', -7.640225, 111.54442, '2024-03-28 00:20:00', '2024-03-28 00:20:00'),
(128, 'AE745BA', -7.639922, 111.544185, '2024-03-28 00:30:40', '2024-03-28 00:30:40'),
(129, 'AE745BA', -7.639906, 111.544229, '2024-03-28 00:33:33', '2024-03-28 00:33:33'),
(130, 'AE745BA', -7.639643, 111.544211, '2024-03-28 00:34:33', '2024-03-28 00:34:33'),
(131, 'AE745BA', -7.639845, 111.544004, '2024-03-28 00:35:34', '2024-03-28 00:35:34'),
(132, 'AE745BA', -7.639774, 111.544069, '2024-03-28 00:36:36', '2024-03-28 00:36:36'),
(133, 'AE745BA', -7.639911, 111.54418, '2024-03-28 00:37:37', '2024-03-28 00:37:37'),
(134, 'AE745BA', -7.63989, 111.544099, '2024-03-28 00:38:38', '2024-03-28 00:38:38'),
(135, 'AE745BA', -7.639931, 111.544077, '2024-03-28 00:39:38', '2024-03-28 00:39:38'),
(136, 'AE745BA', -7.64172, 111.542746, '2024-03-28 00:40:40', '2024-03-28 00:40:40'),
(137, 'AE745BA', -7.642293, 111.540663, '2024-03-28 00:41:41', '2024-03-28 00:41:41'),
(138, 'AE745BA', -7.641252, 111.536947, '2024-03-28 00:42:41', '2024-03-28 00:42:41'),
(139, 'AE745BA', -7.642227, 111.536264, '2024-03-28 00:43:42', '2024-03-28 00:43:42'),
(140, 'AE745BA', -7.64706, 111.534226, '2024-03-28 00:44:44', '2024-03-28 00:44:44'),
(141, 'AE745BA', -7.649394, 111.531626, '2024-03-28 00:45:45', '2024-03-28 00:45:45'),
(142, 'AE745BA', -7.648156, 111.527656, '2024-03-28 00:46:46', '2024-03-28 00:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_14_200300_add_timestamps_to_data_driver', 2),
(6, '2024_01_14_204503_add_alamat_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `mobil_id` varchar(12) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `tujuan_id` int(11) DEFAULT NULL,
  `penugasan` varchar(50) DEFAULT NULL,
  `etol` varchar(45) DEFAULT NULL,
  `bbm` varchar(45) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tujuan`
--

CREATE TABLE `tujuan` (
  `id` int(11) NOT NULL,
  `awal` varchar(45) DEFAULT NULL,
  `akhir` varchar(45) DEFAULT NULL,
  `tambahan` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(12) UNSIGNED NOT NULL,
  `nama` varchar(45) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pelaporan_kendaraan`
--
ALTER TABLE `data_pelaporan_kendaraan`
  ADD PRIMARY KEY (`iddata_pelaporan_kendaraan`),
  ADD KEY `mobil_idx` (`mobil_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`nopol`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`idlokasi`),
  ADD KEY `mobil` (`mobil_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobil_idx` (`mobil_id`),
  ADD KEY `lokasi_idx` (`lokasi_id`),
  ADD KEY `driver_idx` (`driver_id`),
  ADD KEY `admin_idx` (`admin_id`),
  ADD KEY `tujuan_idx` (`tujuan_id`);

--
-- Indexes for table `tujuan`
--
ALTER TABLE `tujuan`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_pelaporan_kendaraan`
--
ALTER TABLE `data_pelaporan_kendaraan`
  MODIFY `iddata_pelaporan_kendaraan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `idlokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD CONSTRAINT `mobil` FOREIGN KEY (`mobil_id`) REFERENCES `kendaraan` (`nopol`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `driver` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `lokasi` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`idlokasi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mobil_id` FOREIGN KEY (`mobil_id`) REFERENCES `kendaraan` (`nopol`),
  ADD CONSTRAINT `tujuan` FOREIGN KEY (`tujuan_id`) REFERENCES `tujuan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
