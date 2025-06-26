-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2025 at 08:10 AM
-- Server version: 10.6.22-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.4.8

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
(24, '24612012', 4, 'Y', NULL),
(25, '24612001', 7, 'Y', ''),
(26, '24612002', 7, 'T', NULL),
(27, '24612003', 7, 'T', NULL),
(28, '24612004', 7, 'T', NULL),
(29, '24612005', 7, 'T', NULL),
(30, '24612006', 7, 'T', NULL),
(31, '24612007', 7, 'T', NULL),
(32, '24612008', 7, 'T', NULL),
(33, '24612009', 7, 'T', NULL),
(34, '24612010', 7, 'T', NULL),
(35, '24612011', 7, 'T', NULL),
(36, '24612012', 7, 'T', NULL);

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
('RPL1822', 'Matematika Komputasi', 3, 2, 1);

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
  `jam_selesai` time DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `batas_absen` datetime DEFAULT NULL,
  `is_teori` tinyint(1) DEFAULT 0,
  `is_praktik` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dat_perkuliahan`
--

INSERT INTO `dat_perkuliahan` (`id_perkuliahan`, `id_sebaran_matkul`, `kelas`, `pertemuan_ke`, `materi`, `tanggal`, `jam_selesai`, `jam`, `batas_absen`, `is_teori`, `is_praktik`) VALUES
(3, 2, '2024-A', 1, 'Pengenalan', '2025-04-19', '00:00:00', '13:59:00', '2025-04-25 14:30:00', 1, 0),
(4, 2, '2024-A', 2, 'Presentasi', '2025-04-03', '00:00:00', '09:30:00', '2025-04-03 09:39:00', 0, 0),
(5, 2, '2024-B', NULL, NULL, '2024-12-31', NULL, '08:00:00', '2024-12-31 00:15:00', 0, 0),
(6, 1, '2024-A', 1, 'Presentasi Tugas Akhir', '2025-04-14', '00:00:00', '13:31:00', '2025-06-24 13:35:00', 1, 0),
(7, 2, '2024-A', NULL, 'Teori Dasar', '2025-06-20', NULL, '13:01:00', '2025-06-24 13:39:00', 1, 0);

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
(2, '11', 'RPL1822', '3523232323211111', 2, '2024/2025'),
(3, '12', 'RPL0112', '35231411121114', 3, '2024/2025');

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
(4, 6, 'a6431f580a6345109feaf81e472c4358', NULL),
(5, 7, '73a982cf1218a6b05ee8fc03f1b1f053', NULL);

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
('1NFZEMLRZAsIXKq51nUl0fov0F9GbYL3CgIRTeYv', 1, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZFlybWhRWHExU3FUZDVvc0tGWkMxdFpvODBOYlAyNWg0YVBlNlV4NCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjczOiJodHRwOi8vaGFuZC10cnVzdHMtYWx0ZXJuYXRpdmVzLXJlZm9ybS50cnljbG91ZGZsYXJlLmNvbS9kYXRhLXBlcmt1bGlhaGFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1750744275),
('1tEmGJlNllfe7DHeTkUXY7m3PrTTyrHEIRE3fI6D', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYTJNVGJVZUU2VEMwU2ZlcDNLYnpic1FIbTl6N3F2ZFZSNVlwVVBiTyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjczOiJodHRwOi8vaGFuZC10cnVzdHMtYWx0ZXJuYXRpdmVzLXJlZm9ybS50cnljbG91ZGZsYXJlLmNvbS9kYXRhLXBlcmt1bGlhaGFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1750745128),
('BM0Ofc2U1PxEVA94aFIv1wRZ863gWDLyRQtyB9aQ', NULL, '127.0.0.1', 'WhatsApp/2.23.20.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVkJLbFBkc05YaXdIbHE3VURLa2F4NGUxN0FCTXJ5d0FhMnNwZWhJTiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo3MzoiaHR0cDovL2hhbmQtdHJ1c3RzLWFsdGVybmF0aXZlcy1yZWZvcm0udHJ5Y2xvdWRmbGFyZS5jb20vZGF0YS1wZXJrdWxpYWhhbiI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjczOiJodHRwOi8vaGFuZC10cnVzdHMtYWx0ZXJuYXRpdmVzLXJlZm9ybS50cnljbG91ZGZsYXJlLmNvbS9kYXRhLXBlcmt1bGlhaGFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750744011),
('CzrH9nC3rKyf0WTdBWp5kx6KvdM43GfpTls64ddy', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ01GWmVmdEtWOFZlRFVYd0U1ZHQwMHFiZm9Wdk5UaFFBZnh1eThYdSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo3MzoiaHR0cDovL3JvYmVydC1oci1jb2xsZWN0aW5nLW5lZ290aWF0aW9ucy50cnljbG91ZGZsYXJlLmNvbS9kYXRhLW1haGFzaXN3YSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjY0OiJodHRwOi8vcm9iZXJ0LWhyLWNvbGxlY3RpbmctbmVnb3RpYXRpb25zLnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750743059),
('F0riohLZX27d80DwXJaXZNXrRmKRQ8gVTg094Oet', NULL, '127.0.0.1', 'WhatsApp/2.23.20.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZFZyT1puZWtnTm9aYmFiUkQwUFEyQ241NktJVGphUmZ2dHNKUUcyOCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo3MToiaHR0cDovL2hhbmQtdHJ1c3RzLWFsdGVybmF0aXZlcy1yZWZvcm0udHJ5Y2xvdWRmbGFyZS5jb20vZGF0YS1tYWhhc2lzd2EiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo3MToiaHR0cDovL2hhbmQtdHJ1c3RzLWFsdGVybmF0aXZlcy1yZWZvcm0udHJ5Y2xvdWRmbGFyZS5jb20vZGF0YS1tYWhhc2lzd2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1750744005),
('fHOrzUMLmRrpJRmhoIsXO5DepyhepYmcpgiHwO4o', NULL, '127.0.0.1', 'WhatsApp/2.23.20.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSG9CUlBGeWVJUHlINUJ4ZkhMTjRCeTFmOE91elU5UFNuRW5adVl3UyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo3NDoiaHR0cDovL2hhbmQtdHJ1c3RzLWFsdGVybmF0aXZlcy1yZWZvcm0udHJ5Y2xvdWRmbGFyZS5jb20vY2VrbGlzdC1hYnNlbnNpLTciO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo3NDoiaHR0cDovL2hhbmQtdHJ1c3RzLWFsdGVybmF0aXZlcy1yZWZvcm0udHJ5Y2xvdWRmbGFyZS5jb20vY2VrbGlzdC1hYnNlbnNpLTciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1750743996),
('Go0KpgscAIOvsS9E2aKDwZYZg1s7UEwCS0OhIFpU', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZWZ0RXlrVVhUMWVMaHJ5Y3RtNXZjUVJMeU1wcG82NkE4M2JmWGNoQyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjcyOiJodHRwOi8vYmxhbmstYW55d2F5LW1lcmNoYW50cy1mYWN0b3JzLnRyeWNsb3VkZmxhcmUuY29tL2RhdGEtcGVya3VsaWFoYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1750746120),
('HIOF7j3hkETTSmkYdAuX7vr3CS9AUZAUzdHdzAbf', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibDNCZjZaeXJoNnV1dXNITHBlSlpVUEkyRGRXNzNDcjZ1Yk5INlEzUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly9maWVsZHMtam9zaC1ndWlkZXMtc3BlYy50cnljbG91ZGZsYXJlLmNvbS9kYXRhLXBlcmt1bGlhaGFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1750742722),
('iw54QpPxhGJXkybCDrPEtRStVKa2bhmUtngmjbHX', NULL, '127.0.0.1', 'WhatsApp/2.23.20.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnFuMmNwbFVvQ1ZQZnh0b1U4c3B5aUxtWGw1ZEMyODUyWXpSRjVXQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly9maWVsZHMtam9zaC1ndWlkZXMtc3BlYy50cnljbG91ZGZsYXJlLmNvbS9kYXRhLWFic2Vuc2ktNiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750742266),
('JC05Ufr2h4fq6yTjKjgFbBwGzJiDLdhM1Ov4ZsWc', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia3RuV3dOS1Nic2p3Z1FmSzg3RmhrUkJ5RVFOeHVCVGlORlJmSm5lUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly9wZXRlci1zY29vcC1taW5pbmctYmVpbmdzLnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750743107),
('JmvKQk9dRjxYQgEli9zWVkHua3OxFjp8tVUjfUqZ', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmlQVGU1ekNlenVtSjBwNzFkZnFFNWFkYjhyUURwRTdEaE1KTzlWWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjE6Imh0dHA6Ly9ibGFuay1hbnl3YXktbWVyY2hhbnRzLWZhY3RvcnMudHJ5Y2xvdWRmbGFyZS5jb20vbG9naW4iO319', 1750755564),
('k99RX4My6gjVvMh9J95pOhiyiFPvbiToirB8r6di', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/28.0 Chrome/130.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUhVaWdXWUhjUU12TVFtR1V2Z245cGJPYjRkbXIzeFBWbGtTMThrRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly9maWVsZHMtam9zaC1ndWlkZXMtc3BlYy50cnljbG91ZGZsYXJlLmNvbS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750742609),
('LMw7Klu7KyQJFjSHVUUfdJ0Vl9RBuKruUCL6aZvI', NULL, '127.0.0.1', 'WhatsApp/2.23.20.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkM5dWdJWDNOWEJZV1ZYVW52RmpaQUZGNEw1MnpqaWxINXhNbGVTcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjI6Imh0dHA6Ly9oYW5kLXRydXN0cy1hbHRlcm5hdGl2ZXMtcmVmb3JtLnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750744005),
('mP5WBUSOWNq0tegsh2nWPCsquSsnQljt3MD91gnE', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUUlORDNKQ2VsM1N4TjhPOWNkQ3pGeXhnSXlEdUJrakJKZUVDaUN0RiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjY3OiJodHRwOi8vaGFuZC10cnVzdHMtYWx0ZXJuYXRpdmVzLXJlZm9ybS50cnljbG91ZGZsYXJlLmNvbS9kYXRhLWRvc2VuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1750745868),
('oriPMQpOkcNixlk0dnB5N4Im9IZXdDXdBNqo9C3d', NULL, '127.0.0.1', 'WhatsApp/2.23.20.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSHZ4c0N0RmVGQXZxZHFtWG1PdnFrYlNtdzBOZlZTT1RBYjk1SEMxaCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NToiaHR0cDovL2ZpZWxkcy1qb3NoLWd1aWRlcy1zcGVjLnRyeWNsb3VkZmxhcmUuY29tL2RhdGEtcGVya3VsaWFoYW4iO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1NDoiaHR0cDovL2ZpZWxkcy1qb3NoLWd1aWRlcy1zcGVjLnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750741887),
('Q2b73ZIIOChJiTRjMqOQRbVo0rB2cgWDNIH9yNdw', NULL, '127.0.0.1', 'WhatsApp/2.23.20.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUl4TmRCYzg1SnVrdTF6cnRBSHNYWDdBWWdFTG5OWXJWdGd3YUkxciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjI6Imh0dHA6Ly9oYW5kLXRydXN0cy1hbHRlcm5hdGl2ZXMtcmVmb3JtLnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750744011),
('qAIqhtDiweJdjbBuz7MJdHGVGHwhmaYOee8xmJ1a', 1, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMTRYN1dQVzRiWDJHSlptVDViOGZ6NlV6M2N4a29wR3p3U3drUVZPcCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjY1OiJodHRwOi8vZmllbGRzLWpvc2gtZ3VpZGVzLXNwZWMudHJ5Y2xvdWRmbGFyZS5jb20vZGF0YS1wZXJrdWxpYWhhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1750742553),
('RfYrIoJAZ1W9H0G2sVGIU07Qbh0hSHNM12rjip8q', NULL, '127.0.0.1', 'WhatsApp/2.23.20.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidksyZE1HR1FKbjJoRFcwZzJ1V2RzTzVvZnh0OXBpMUoyZUZ3dm1RQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjI6Imh0dHA6Ly9oYW5kLXRydXN0cy1hbHRlcm5hdGl2ZXMtcmVmb3JtLnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750743996),
('tQtYAvUWZx5aVVseK92rEn1eZn0nWJZuQlK7pPa4', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMTNyUERGZW1wRUNSTVp3VWlyS3hZQXE1UDhmNFF1M1pHZGp0Rm9YNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjA6Imh0dHA6Ly9pZGVudGlmeS1oZWF2aWx5LWRlc2lyZS1tb3Zlcy50cnljbG91ZGZsYXJlLmNvbS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750743340),
('uu6t3OroiOF4qKVKCAiLpql32BxG8HMbphPwMC6Y', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/28.0 Chrome/130.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0hQcDk0bVlCdEJ4MHljQWt6SjZhOXRNa3RtazN4dlBrNXNOZXU1cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzE6Imh0dHA6Ly9oYW5kLXRydXN0cy1hbHRlcm5hdGl2ZXMtcmVmb3JtLnRyeWNsb3VkZmxhcmUuY29tL2RhdGEtYWJzZW5zaS03Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750743975),
('WvnloPyyeBGkngsSWkpnAUJwP9sggA0Du5QY3Bol', NULL, '127.0.0.1', 'WhatsApp/2.23.20.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZVN5ZjdlNWN1dVpmaEdTVWJSdlBDRXN0cjJ0bm5RVEoyNHZLZGVkVyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NToiaHR0cDovL2ZpZWxkcy1qb3NoLWd1aWRlcy1zcGVjLnRyeWNsb3VkZmxhcmUuY29tL2RhdGEtcGVya3VsaWFoYW4iO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2NToiaHR0cDovL2ZpZWxkcy1qb3NoLWd1aWRlcy1zcGVjLnRyeWNsb3VkZmxhcmUuY29tL2RhdGEtcGVya3VsaWFoYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1750741887),
('yOxfBwHwzYZC77o9FKgMMHBNJUE4zRAcqe0fI6xT', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUw0eXRMTTF4STRYNm5kcWhqNjBJaExvcVo1VllDSkJpSEM5bU9ZWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly9maWVsZHMtam9zaC1ndWlkZXMtc3BlYy50cnljbG91ZGZsYXJlLmNvbS9kYXRhLWFic2Vuc2ktNiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750742313);

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
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `dat_perkuliahan`
--
ALTER TABLE `dat_perkuliahan`
  MODIFY `id_perkuliahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dat_sebaran_matkul`
--
ALTER TABLE `dat_sebaran_matkul`
  MODIFY `id_sebaran_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
