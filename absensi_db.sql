-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 12:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dat_absensi`
--

CREATE TABLE `dat_absensi` (
  `id_absensi` int(11) NOT NULL,
  `nim` char(16) NOT NULL,
  `id_perkuliahan` int(11) NOT NULL,
  `status_kehadiran` char(1) NOT NULL,
  `keterangan` varchar(160) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dat_dosen`
--

CREATE TABLE `dat_dosen` (
  `id_dosen` varchar(16) NOT NULL,
  `nm_dosen` varchar(160) NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dat_dosen`
--

INSERT INTO `dat_dosen` (`id_dosen`, `nm_dosen`, `no_telp`, `email`) VALUES
('3523141115552222', 'Andy Mulianti, M.Kom', '082225555226', 'andi@gmail.com'),
('3523232352', 'Dosen', '0822252225', 'dosen@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `dat_fakultas`
--

CREATE TABLE `dat_fakultas` (
  `kd_fakultas` char(2) NOT NULL,
  `nm_fakultas` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dat_fakultas`
--

INSERT INTO `dat_fakultas` (`kd_fakultas`, `nm_fakultas`) VALUES
('1', 'Ilmu Kesehatan'),
('2', 'Saintek');

-- --------------------------------------------------------

--
-- Table structure for table `dat_mahasiswa`
--

CREATE TABLE `dat_mahasiswa` (
  `nim` char(16) NOT NULL,
  `nm_mahasiswa` varchar(160) NOT NULL,
  `kelas` char(6) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `kd_prodi` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dat_mahasiswa`
--

INSERT INTO `dat_mahasiswa` (`nim`, `nm_mahasiswa`, `kelas`, `semester`, `no_telp`, `kd_prodi`) VALUES
('14200220001', 'Bambang Paripurno', '2020-B', 5, NULL, '11'),
('14200220002', 'Alkhalifi Kusuma', '2023-A', 2, NULL, '11'),
('14200220003', 'Hoshi Paripurno', '2020-A', 5, NULL, '11');

-- --------------------------------------------------------

--
-- Table structure for table `dat_matkul`
--

CREATE TABLE `dat_matkul` (
  `kd_matkul` char(2) NOT NULL,
  `nm_matkul` varchar(160) NOT NULL,
  `jml_sks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dat_matkul`
--

INSERT INTO `dat_matkul` (`kd_matkul`, `nm_matkul`, `jml_sks`) VALUES
('11', 'Pemrograman', 3),
('12', 'Managemen Proyek', 3),
('13', 'Basis Data', 4),
('14', 'Jaringan Komputer', 3);

-- --------------------------------------------------------

--
-- Table structure for table `dat_perkuliahan`
--

CREATE TABLE `dat_perkuliahan` (
  `id_perkuliahan` int(11) NOT NULL,
  `kd_matkul` char(2) NOT NULL,
  `id_dosen` varchar(16) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `expired` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dat_perkuliahan`
--

INSERT INTO `dat_perkuliahan` (`id_perkuliahan`, `kd_matkul`, `id_dosen`, `tanggal`, `jam`, `expired`) VALUES
(1, '11', '3523232352', '2025-03-24', '10:45:00', '2025-03-24 11:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `dat_prodi`
--

CREATE TABLE `dat_prodi` (
  `kd_prodi` char(2) NOT NULL,
  `nm_prodi` varchar(160) NOT NULL,
  `kd_fakultas` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dat_prodi`
--

INSERT INTO `dat_prodi` (`kd_prodi`, `nm_prodi`, `kd_fakultas`) VALUES
('01', '(D3) Kebidanan', '1'),
('02', '(S1) Keperawatan & Profesi NERS', '1'),
('11', 'Teknik Informatika', '2'),
('12', 'Desain Komunikasi', '2');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '0001_01_01_000000_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `otoritas`
--

CREATE TABLE `otoritas` (
  `kd_otoritas` char(2) NOT NULL,
  `nm_otoritas` varchar(100) NOT NULL,
  `deskripsi` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pP7U3aOmObCHiPJ31F14u3dIcnx1RQqucoU43hgv', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUk4zRlg0QnpMTWw4cGNkTFBadVpzYmhWOXVzeVNsUGs0dTMxMkNTSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6NzoibWVzc2FnZSI7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXRhLWRvc2VuIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1742773559);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nm_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `kd_otoritas` char(2) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nm_user`, `email`, `email_verified_at`, `password`, `kd_otoritas`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$YEHqlzzlQ0J3Cxdp.TPe6ug3qHAwIFsUjCQc/2HesSiG9aIW37Hri', '2', NULL, '2025-03-19 23:26:52', '2025-03-19 23:26:52'),
(2, 'dosen', 'dosen@gmail.com', NULL, '$2y$12$j1G9WHXdznnLCfkIMKJHveWgQpA2jyF22WTEZ1vXw5dPGQrqANcEy', '2', NULL, '2025-03-23 14:54:43', '2025-03-23 14:54:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `dat_absensi`
--
ALTER TABLE `dat_absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_perkuliahan` (`id_perkuliahan`);

--
-- Indexes for table `dat_dosen`
--
ALTER TABLE `dat_dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `dat_fakultas`
--
ALTER TABLE `dat_fakultas`
  ADD PRIMARY KEY (`kd_fakultas`);

--
-- Indexes for table `dat_mahasiswa`
--
ALTER TABLE `dat_mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `kd_prodi` (`kd_prodi`);

--
-- Indexes for table `dat_matkul`
--
ALTER TABLE `dat_matkul`
  ADD PRIMARY KEY (`kd_matkul`);

--
-- Indexes for table `dat_perkuliahan`
--
ALTER TABLE `dat_perkuliahan`
  ADD PRIMARY KEY (`id_perkuliahan`),
  ADD KEY `kd_matkul` (`kd_matkul`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indexes for table `dat_prodi`
--
ALTER TABLE `dat_prodi`
  ADD PRIMARY KEY (`kd_prodi`),
  ADD KEY `kd_fakultas` (`kd_fakultas`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otoritas`
--
ALTER TABLE `otoritas`
  ADD PRIMARY KEY (`kd_otoritas`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dat_absensi`
--
ALTER TABLE `dat_absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dat_perkuliahan`
--
ALTER TABLE `dat_perkuliahan`
  MODIFY `id_perkuliahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dat_absensi`
--
ALTER TABLE `dat_absensi`
  ADD CONSTRAINT `dat_absensi_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `dat_mahasiswa` (`nim`),
  ADD CONSTRAINT `dat_absensi_ibfk_2` FOREIGN KEY (`id_perkuliahan`) REFERENCES `dat_perkuliahan` (`id_perkuliahan`);

--
-- Constraints for table `dat_mahasiswa`
--
ALTER TABLE `dat_mahasiswa`
  ADD CONSTRAINT `dat_mahasiswa_ibfk_1` FOREIGN KEY (`kd_prodi`) REFERENCES `dat_prodi` (`kd_prodi`);

--
-- Constraints for table `dat_perkuliahan`
--
ALTER TABLE `dat_perkuliahan`
  ADD CONSTRAINT `dat_perkuliahan_ibfk_1` FOREIGN KEY (`kd_matkul`) REFERENCES `dat_matkul` (`kd_matkul`),
  ADD CONSTRAINT `dat_perkuliahan_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dat_dosen` (`id_dosen`);

--
-- Constraints for table `dat_prodi`
--
ALTER TABLE `dat_prodi`
  ADD CONSTRAINT `dat_prodi_ibfk_1` FOREIGN KEY (`kd_fakultas`) REFERENCES `dat_fakultas` (`kd_fakultas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
