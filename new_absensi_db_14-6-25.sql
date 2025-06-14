-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 10:43 AM
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
-- Database: `new_absensi_db`
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

--
-- Dumping data for table `dat_absensi`
--

INSERT INTO `dat_absensi` (`id_absensi`, `nim`, `id_perkuliahan`, `status_kehadiran`, `keterangan`) VALUES
(1, '24612001', 3, 'Y', 'Cuti'),
(2, '24612002', 3, 'T', ''),
(3, '24612003', 3, 'Y', NULL),
(4, '24612004', 3, 'Y', NULL),
(5, '24612005', 3, 'Y', NULL),
(6, '24612006', 3, 'Y', NULL),
(7, '24612007', 3, 'Y', NULL),
(8, '24612008', 3, 'Y', NULL),
(9, '24612009', 3, 'Y', NULL),
(10, '24612010', 3, 'Y', NULL),
(11, '24612011', 3, 'Y', NULL),
(12, '24612012', 3, 'Y', NULL),
(13, '24612001', 4, 'Y', NULL),
(14, '24612002', 4, 'Y', NULL),
(15, '24612003', 4, 'Y', NULL),
(16, '24612004', 4, 'Y', NULL),
(17, '24612005', 4, 'Y', NULL),
(18, '24612006', 4, 'Y', NULL),
(19, '24612007', 4, 'Y', NULL),
(20, '24612008', 4, 'Y', NULL),
(21, '24612009', 4, 'Y', NULL),
(22, '24612010', 4, 'Y', NULL),
(23, '24612011', 4, 'Y', NULL),
(24, '24612012', 4, 'Y', NULL);

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
('33553232325', 'Rohman Hadi Al Haq.,M.Kom ', NULL, 'Rohman@gmail.com'),
('35231411121114', 'Andi Mulyanti S.,S.Kom.,M.MT', NULL, 'andimulyanti@gmail.com'),
('3523232323211111', 'Andik Setiawan S.Kom., M.Kom', NULL, 'andik@gmail.com');

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
('01', 'Saintek'),
('02', 'Ilmu Kesehatan');

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
('24612001', 'Ahmad Dafin Eka Subastian', '2024-A', 2, NULL, '12'),
('24612002', 'Priyo Sulistyo Budi (K)', '2024-A', 2, NULL, '12'),
('24612003', 'Fyppo Alfa Wijaya', '2024-A', 2, NULL, '12'),
('24612004', 'Futiha Nur Sa\'adah', '2024-A', 2, NULL, '12'),
('24612005', 'Pindy Ayu Damayanti', '2024-A', 2, NULL, '12'),
('24612006', 'Sofi Alfitriana ', '2024-A', 2, NULL, '12'),
('24612007', 'M.Iqbal Nur Wafa', '2024-A', 2, NULL, '12'),
('24612008', 'Novika Hawa Al-Hurin', '2024-A', 2, NULL, '12'),
('24612009', 'Padmahayu Paramarta Pambayun', '2024-A', 2, NULL, '12'),
('24612010', 'Ragil Kurniawan ', '2024-A', 2, NULL, '12'),
('24612011', 'Yulia Devi Ernawati', '2024-A', 2, NULL, '12'),
('24612012', 'Miftakhul Jannah', '2024-A', 2, NULL, '12');

-- --------------------------------------------------------

--
-- Table structure for table `dat_matkul`
--

CREATE TABLE `dat_matkul` (
  `kd_matkul` varchar(10) NOT NULL,
  `nm_matkul` varchar(160) NOT NULL,
  `jml_sks` int(11) DEFAULT NULL,
  `teori` int(11) DEFAULT NULL,
  `praktek` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dat_matkul`
--

INSERT INTO `dat_matkul` (`kd_matkul`, `nm_matkul`, `jml_sks`, `teori`, `praktek`) VALUES
('RPL0112', 'Pancasila & PAK', 3, 3, 0),
('RPL1822', 'Matematika Komputasi', 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dat_perkuliahan`
--

CREATE TABLE `dat_perkuliahan` (
  `id_perkuliahan` int(11) NOT NULL,
  `id_sebaran_matkul` int(11) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `pertemuan_ke` int(11) DEFAULT NULL,
  `materi` varchar(200) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `batas_absen` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dat_perkuliahan`
--

INSERT INTO `dat_perkuliahan` (`id_perkuliahan`, `id_sebaran_matkul`, `kelas`, `pertemuan_ke`, `materi`, `tanggal`, `tanggal_selesai`, `jam`, `batas_absen`) VALUES
(3, 2, '2024-A', NULL, NULL, '2025-04-19', NULL, '13:59:00', '2025-04-25 14:30:00'),
(4, 2, '2024-A', NULL, NULL, '2025-04-03', NULL, '09:30:00', '2025-04-03 09:39:00'),
(5, 2, '2024-B', NULL, NULL, '2024-12-31', NULL, '08:00:00', '2024-12-31 00:15:00'),
(6, 1, '2024-B', NULL, NULL, '2025-04-14', NULL, '13:31:00', '2025-04-14 13:35:00');

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
('11', 'Rekayasa Perangkat Lunak', '01'),
('12', 'Bisnis Digital', '01');

-- --------------------------------------------------------

--
-- Table structure for table `dat_sebaran_matkul`
--

CREATE TABLE `dat_sebaran_matkul` (
  `id_sebaran_matkul` int(11) NOT NULL,
  `kd_prodi` char(2) NOT NULL,
  `kd_matkul` varchar(10) NOT NULL,
  `id_dosen` varchar(16) NOT NULL,
  `semester` int(11) DEFAULT NULL,
  `thn_akademik` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dat_sebaran_matkul`
--

INSERT INTO `dat_sebaran_matkul` (`id_sebaran_matkul`, `kd_prodi`, `kd_matkul`, `id_dosen`, `semester`, `thn_akademik`) VALUES
(1, '11', 'RPL1822', '33553232325', 2, '2024/2025'),
(2, '11', 'RPL1822', '3523232323211111', 2, '2024/2025');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `otoritas`
--

CREATE TABLE `otoritas` (
  `kd_otoritas` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_otoritas` varchar(100) NOT NULL,
  `deskripsi` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otoritas`
--

INSERT INTO `otoritas` (`kd_otoritas`, `nm_otoritas`, `deskripsi`) VALUES
('1', 'admin', ''),
('2', 'dosen', '');

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
-- Table structure for table `qrabsen`
--

CREATE TABLE `qrabsen` (
  `id` int(11) NOT NULL,
  `id_perkuliahan` int(11) NOT NULL,
  `link_absen` varchar(50) NOT NULL,
  `kata_kunci` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qrabsen`
--

INSERT INTO `qrabsen` (`id`, `id_perkuliahan`, `link_absen`, `kata_kunci`) VALUES
(1, 3, 'f317d1c63848ae31bf43a14ee0125f96', NULL),
(2, 4, '471ab9319c6d6e0b29a5521f755969c2', NULL),
(3, 5, 'e5f055ed4440d88ab4ae1d6ae8cffce6', NULL),
(4, 6, 'a6431f580a6345109feaf81e472c4358', NULL);

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
('0X8ItkzQ08K4BIDOeiJqLtJXaNGxhI4Ix84smRwe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGxLdG9abHF4cDZSV1ZLSlk2bDJPU01xTHlTY1FjM3FwaTNwT1VkayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1749888541),
('7Smw6NQxiqlA9MnQC4hLWYNdcqRqBhtW2LDgRh6E', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTkZXRE5jbmtGa1RzVGY0eDAxTG8yd3NsdHhFNzQ1RUxaeTZGSkoxQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1749888526),
('dAdZQtiCkH8T67NbWLBX8wkNfA3BHGRUV0r5OrG2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVp5b2E5ZGhXNFBCSzZQTlhTYXdtUWJLUTBIQ3pzdjB3R1ROREtkUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1749888542),
('t7ey3boEI2NOkunMJpHtCCnc24ZavUmLcyXh6S7K', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV3RxdXA1Z2tiVWtCMjJCRVFpRklYS2N0NFFhRDVuWnJvbHJnUVlPVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1749888540),
('VPtbxzz1VYy8qxqpPvzCy54uowYoJYkdmywbgg4G', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia1VnSzVIQWJmMkdBRFJBenQ5cFZFd2t2ZTFwb0pWYmJ3V0lNSHluQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXRhLXBlcmt1bGlhaGFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1749890633),
('wakXsJIkLgR348iSceA5fnJgqwQzcOdeyGPSxsHt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNk9GTkRuVDI5U3hzSDNSeHZET1NuSWJEdDJwQTZVZFQ2UU5YcFUxayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1749888537),
('ZrODPsErXeJxtJdr1MTCcFLEqWAVv7EljqS32wxF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTZiVjdwOUpPZzBzdDZyTzhpMjBDQ3dBNDl0ck1kdVJTMmlCTlJvaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1749888538);

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
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$slO1mvYi0ogZAV7DhzC0kuCScDqCdGz2vqyNC6SJMh5axSG/T9i.e', '1', NULL, '2025-03-23 20:19:24', '2025-04-16 22:57:57'),
(2, 'Andik Setiawan', 'andik@gmail.com', NULL, '$2y$12$PRKVXQQ1D5CbYpCz2ECPk.b18eiL0dlLD0qDINspyDjxg3YtD44g.', '2', NULL, NULL, NULL);

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
  ADD KEY `id_sebaran_matkul` (`id_sebaran_matkul`);

--
-- Indexes for table `dat_prodi`
--
ALTER TABLE `dat_prodi`
  ADD PRIMARY KEY (`kd_prodi`),
  ADD KEY `kd_fakultas` (`kd_fakultas`);

--
-- Indexes for table `dat_sebaran_matkul`
--
ALTER TABLE `dat_sebaran_matkul`
  ADD PRIMARY KEY (`id_sebaran_matkul`),
  ADD KEY `kd_prodi` (`kd_prodi`),
  ADD KEY `kd_matkul` (`kd_matkul`),
  ADD KEY `id_dosen` (`id_dosen`);

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
-- Indexes for table `qrabsen`
--
ALTER TABLE `qrabsen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perkuliahan` (`id_perkuliahan`);

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
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `dat_perkuliahan`
--
ALTER TABLE `dat_perkuliahan`
  MODIFY `id_perkuliahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dat_sebaran_matkul`
--
ALTER TABLE `dat_sebaran_matkul`
  MODIFY `id_sebaran_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `qrabsen`
--
ALTER TABLE `qrabsen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `dat_perkuliahan_ibfk_1` FOREIGN KEY (`id_sebaran_matkul`) REFERENCES `dat_sebaran_matkul` (`id_sebaran_matkul`);

--
-- Constraints for table `dat_prodi`
--
ALTER TABLE `dat_prodi`
  ADD CONSTRAINT `dat_prodi_ibfk_1` FOREIGN KEY (`kd_fakultas`) REFERENCES `dat_fakultas` (`kd_fakultas`);

--
-- Constraints for table `dat_sebaran_matkul`
--
ALTER TABLE `dat_sebaran_matkul`
  ADD CONSTRAINT `dat_sebaran_matkul_ibfk_1` FOREIGN KEY (`kd_prodi`) REFERENCES `dat_prodi` (`kd_prodi`),
  ADD CONSTRAINT `dat_sebaran_matkul_ibfk_2` FOREIGN KEY (`kd_matkul`) REFERENCES `dat_matkul` (`kd_matkul`),
  ADD CONSTRAINT `dat_sebaran_matkul_ibfk_3` FOREIGN KEY (`id_dosen`) REFERENCES `dat_dosen` (`id_dosen`);

--
-- Constraints for table `qrabsen`
--
ALTER TABLE `qrabsen`
  ADD CONSTRAINT `qrabsen_ibfk_1` FOREIGN KEY (`id_perkuliahan`) REFERENCES `dat_perkuliahan` (`id_perkuliahan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
