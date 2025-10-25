-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2025 at 11:03 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diskominfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `position_id` bigint UNSIGNED NOT NULL,
  `motivation` text COLLATE utf8mb4_unicode_ci,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('submitted','under_review','interview','accepted','rejected','active','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `position_id`, `motivation`, `duration`, `whatsapp_number`, `active_email`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '5 bulan', '082925388998', 'student1@example.com', 'under_review', '2025-10-18 21:57:18', '2025-10-19 02:20:46'),
(2, 2, 4, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '6 bulan', '085990399552', 'student1@example.com', 'accepted', '2025-10-18 21:57:18', '2025-10-19 02:41:37'),
(3, 2, 10, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '5 bulan', '088337992153', 'student1@example.com', 'under_review', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(4, 3, 1, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '3 bulan', '089150350000', 'student2@example.com', 'rejected', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(5, 3, 7, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '4 bulan', '087931202807', 'student2@example.com', 'submitted', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(6, 4, 1, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '3 bulan', '083936878907', 'student3@example.com', 'completed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(7, 4, 3, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '6 bulan', '086897246431', 'student3@example.com', 'rejected', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(8, 4, 8, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '1 bulan', '086194751433', 'student3@example.com', 'rejected', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(9, 5, 3, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '2 bulan', '082993446597', 'student4@example.com', 'under_review', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(10, 6, 1, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '5 bulan', '087316217629', 'student5@example.com', 'completed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(11, 6, 2, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '4 bulan', '083509679591', 'student5@example.com', 'interview', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(12, 6, 6, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '4 bulan', '086627583871', 'student5@example.com', 'rejected', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(13, 7, 5, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '4 bulan', '084321668082', 'student6@example.com', 'submitted', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(14, 7, 6, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '4 bulan', '086631923778', 'student6@example.com', 'interview', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(15, 8, 3, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '4 bulan', '081317854519', 'student7@example.com', 'under_review', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(16, 8, 6, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '4 bulan', '087066245215', 'student7@example.com', 'accepted', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(17, 8, 7, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '1 bulan', '089888444458', 'student7@example.com', 'rejected', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(18, 9, 3, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '6 bulan', '085632400589', 'student8@example.com', 'completed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(19, 9, 5, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '1 bulan', '081152840396', 'student8@example.com', 'under_review', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(20, 9, 10, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '6 bulan', '089777703416', 'student8@example.com', 'completed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(21, 10, 1, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '4 bulan', '086380041304', 'student9@example.com', 'submitted', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(22, 11, 4, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '4 bulan', '085106664944', 'student10@example.com', 'accepted', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(23, 11, 9, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '6 bulan', '084682982836', 'student10@example.com', 'accepted', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(24, 12, 3, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '5 bulan', '089052679726', 'student11@example.com', 'submitted', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(25, 13, 2, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '3 bulan', '081897735142', 'student12@example.com', 'submitted', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(26, 14, 6, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '3 bulan', '089289643586', 'student13@example.com', 'accepted', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(27, 15, 1, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '5 bulan', '088563226031', 'student14@example.com', 'rejected', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(28, 15, 3, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '2 bulan', '084475902521', 'student14@example.com', 'interview', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(29, 15, 6, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '2 bulan', '086670614336', 'student14@example.com', 'accepted', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(30, 16, 1, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '1 bulan', '081765814251', 'student15@example.com', 'submitted', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(31, 16, 7, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '6 bulan', '087676832016', 'student15@example.com', 'interview', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(32, 16, 9, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '2 bulan', '085878237618', 'student15@example.com', 'rejected', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(33, 17, 4, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '3 bulan', '086421174208', 'student16@example.com', 'submitted', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(34, 17, 8, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '2 bulan', '081236019658', 'student16@example.com', 'under_review', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(35, 17, 10, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '3 bulan', '086720178693', 'student16@example.com', 'rejected', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(36, 18, 5, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '6 bulan', '086982273664', 'student17@example.com', 'rejected', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(37, 19, 7, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '2 bulan', '083746259889', 'student18@example.com', 'completed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(38, 19, 8, 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.', '5 bulan', '082640428396', 'student18@example.com', 'under_review', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(39, 20, 1, 'Saya ingin menambah pengalaman di bidang IT support dan belajar lingkungan kerja nyata.', '3 bulan', '081234567890', 'rafi.aditya@example.com', 'active', '2025-10-18 22:09:27', '2025-10-18 22:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `user_id`, `file_path`, `issued_date`, `created_at`, `updated_at`) VALUES
(1, 4, 'uploads/certificates/4/sertifikat_magang.pdf', '2025-10-16', '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(2, 6, 'uploads/certificates/6/sertifikat_magang.pdf', '2025-10-11', '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(3, 9, 'uploads/certificates/9/sertifikat_magang.pdf', '2025-10-10', '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(4, 9, 'uploads/certificates/9/sertifikat_magang.pdf', '2025-10-04', '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(5, 19, 'uploads/certificates/19/sertifikat_magang.pdf', '2025-10-13', '2025-10-18 21:57:19', '2025-10-18 21:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint UNSIGNED NOT NULL,
  `application_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `application_id`, `type`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, 'CV', 'uploads/documents/2/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(2, 1, 'Surat Pengantar', 'uploads/documents/2/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(3, 2, 'CV', 'uploads/documents/2/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(4, 2, 'Surat Pengantar', 'uploads/documents/2/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(5, 3, 'CV', 'uploads/documents/2/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(6, 3, 'Surat Pengantar', 'uploads/documents/2/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(7, 3, 'Transkrip Nilai', 'uploads/documents/2/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(8, 4, 'CV', 'uploads/documents/3/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(9, 4, 'Surat Pengantar', 'uploads/documents/3/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(10, 4, 'Transkrip Nilai', 'uploads/documents/3/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(11, 5, 'CV', 'uploads/documents/3/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(12, 5, 'Surat Pengantar', 'uploads/documents/3/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(13, 6, 'CV', 'uploads/documents/4/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(14, 6, 'Surat Pengantar', 'uploads/documents/4/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(15, 6, 'Transkrip Nilai', 'uploads/documents/4/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(16, 7, 'CV', 'uploads/documents/4/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(17, 7, 'Surat Pengantar', 'uploads/documents/4/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(18, 8, 'CV', 'uploads/documents/4/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(19, 8, 'Surat Pengantar', 'uploads/documents/4/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(20, 9, 'CV', 'uploads/documents/5/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(21, 9, 'Surat Pengantar', 'uploads/documents/5/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(22, 10, 'CV', 'uploads/documents/6/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(23, 10, 'Surat Pengantar', 'uploads/documents/6/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(24, 11, 'CV', 'uploads/documents/6/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(25, 11, 'Surat Pengantar', 'uploads/documents/6/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(26, 12, 'CV', 'uploads/documents/6/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(27, 12, 'Surat Pengantar', 'uploads/documents/6/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(28, 13, 'CV', 'uploads/documents/7/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(29, 13, 'Surat Pengantar', 'uploads/documents/7/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(30, 14, 'CV', 'uploads/documents/7/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(31, 14, 'Surat Pengantar', 'uploads/documents/7/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(32, 15, 'CV', 'uploads/documents/8/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(33, 15, 'Surat Pengantar', 'uploads/documents/8/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(34, 16, 'CV', 'uploads/documents/8/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(35, 16, 'Surat Pengantar', 'uploads/documents/8/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(36, 16, 'Transkrip Nilai', 'uploads/documents/8/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(37, 17, 'CV', 'uploads/documents/8/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(38, 17, 'Surat Pengantar', 'uploads/documents/8/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(39, 18, 'CV', 'uploads/documents/9/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(40, 18, 'Surat Pengantar', 'uploads/documents/9/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(41, 19, 'CV', 'uploads/documents/9/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(42, 19, 'Surat Pengantar', 'uploads/documents/9/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(43, 20, 'CV', 'uploads/documents/9/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(44, 20, 'Surat Pengantar', 'uploads/documents/9/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(45, 20, 'Transkrip Nilai', 'uploads/documents/9/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(46, 21, 'CV', 'uploads/documents/10/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(47, 21, 'Surat Pengantar', 'uploads/documents/10/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(48, 21, 'Transkrip Nilai', 'uploads/documents/10/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(49, 22, 'CV', 'uploads/documents/11/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(50, 22, 'Surat Pengantar', 'uploads/documents/11/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(51, 23, 'CV', 'uploads/documents/11/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(52, 23, 'Surat Pengantar', 'uploads/documents/11/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(53, 23, 'Transkrip Nilai', 'uploads/documents/11/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(54, 24, 'CV', 'uploads/documents/12/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(55, 24, 'Surat Pengantar', 'uploads/documents/12/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(56, 25, 'CV', 'uploads/documents/13/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(57, 25, 'Surat Pengantar', 'uploads/documents/13/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(58, 26, 'CV', 'uploads/documents/14/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(59, 26, 'Surat Pengantar', 'uploads/documents/14/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(60, 26, 'Transkrip Nilai', 'uploads/documents/14/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(61, 27, 'CV', 'uploads/documents/15/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(62, 27, 'Surat Pengantar', 'uploads/documents/15/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(63, 27, 'Transkrip Nilai', 'uploads/documents/15/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(64, 28, 'CV', 'uploads/documents/15/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(65, 28, 'Surat Pengantar', 'uploads/documents/15/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(66, 28, 'Transkrip Nilai', 'uploads/documents/15/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(67, 29, 'CV', 'uploads/documents/15/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(68, 29, 'Surat Pengantar', 'uploads/documents/15/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(69, 30, 'CV', 'uploads/documents/16/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(70, 30, 'Surat Pengantar', 'uploads/documents/16/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(71, 31, 'CV', 'uploads/documents/16/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(72, 31, 'Surat Pengantar', 'uploads/documents/16/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(73, 32, 'CV', 'uploads/documents/16/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(74, 32, 'Surat Pengantar', 'uploads/documents/16/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(75, 32, 'Transkrip Nilai', 'uploads/documents/16/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(76, 33, 'CV', 'uploads/documents/17/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(77, 33, 'Surat Pengantar', 'uploads/documents/17/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(78, 34, 'CV', 'uploads/documents/17/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(79, 34, 'Surat Pengantar', 'uploads/documents/17/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(80, 35, 'CV', 'uploads/documents/17/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(81, 35, 'Surat Pengantar', 'uploads/documents/17/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(82, 35, 'Transkrip Nilai', 'uploads/documents/17/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(83, 36, 'CV', 'uploads/documents/18/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(84, 36, 'Surat Pengantar', 'uploads/documents/18/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(85, 37, 'CV', 'uploads/documents/19/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(86, 37, 'Surat Pengantar', 'uploads/documents/19/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(87, 37, 'Transkrip Nilai', 'uploads/documents/19/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(88, 38, 'CV', 'uploads/documents/19/cv.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(89, 38, 'Surat Pengantar', 'uploads/documents/19/surat_pengantar.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(90, 38, 'Transkrip Nilai', 'uploads/documents/19/transkrip_nilai.pdf', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(91, 39, 'CV', 'uploads/documents/20/cv.pdf', '2025-10-18 22:09:27', '2025-10-18 22:09:27'),
(92, 39, 'Surat Pengantar', 'uploads/documents/20/surat_pengantar.pdf', '2025-10-18 22:09:27', '2025-10-18 22:09:27'),
(93, 39, 'Transkrip Nilai', 'uploads/documents/20/transkrip_nilai.pdf', '2025-10-18 22:09:27', '2025-10-18 22:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `discipline` int DEFAULT NULL COMMENT 'Kedisiplinan',
  `teamwork` int DEFAULT NULL COMMENT 'Kerja sama tim',
  `communication` int DEFAULT NULL COMMENT 'Kemampuan komunikasi',
  `skill` int DEFAULT NULL COMMENT 'Kompetensi keahlian',
  `responsibility` int DEFAULT NULL COMMENT 'Tanggung jawab',
  `notes` text COLLATE utf8mb4_unicode_ci COMMENT 'Catatan tambahan dari pembimbing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`id`, `user_id`, `discipline`, `teamwork`, `communication`, `skill`, `responsibility`, `notes`, `created_at`, `updated_at`) VALUES
(1, 4, 78, 94, 87, 96, 98, 'Memiliki potensi besar dalam bidang yang digeluti.', '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(2, 6, 85, 100, 97, 89, 79, 'Perlu meningkatkan kemampuan komunikasi profesional.', '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(3, 9, 100, 85, 79, 98, 98, 'Memiliki potensi besar dalam bidang yang digeluti.', '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(4, 9, 99, 84, 80, 84, 81, 'Mampu bekerja sama dengan baik dalam tim.', '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(5, 19, 82, 77, 91, 95, 89, 'Kinerja sangat memuaskan selama masa magang.', '2025-10-18 21:57:19', '2025-10-18 21:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `final_reports`
--

CREATE TABLE `final_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `final_reports`
--

INSERT INTO `final_reports` (`id`, `user_id`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 4, 'uploads/final_reports/4/laporan_akhir.pdf', '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(2, 6, 'uploads/final_reports/6/laporan_akhir.pdf', '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(3, 9, 'uploads/final_reports/9/laporan_akhir.pdf', '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(4, 9, 'uploads/final_reports/9/laporan_akhir.pdf', '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(5, 19, 'uploads/final_reports/19/laporan_akhir.pdf', '2025-10-18 21:57:19', '2025-10-18 21:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `interviews`
--

CREATE TABLE `interviews` (
  `id` bigint UNSIGNED NOT NULL,
  `application_id` bigint UNSIGNED NOT NULL,
  `scheduled_at` datetime DEFAULT NULL,
  `status` enum('scheduled','done','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'scheduled',
  `result` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interviews`
--

INSERT INTO `interviews` (`id`, `application_id`, `scheduled_at`, `status`, `result`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-10-21 12:00:00', 'scheduled', NULL, '2025-10-18 21:57:18', '2025-10-19 02:18:13'),
(2, 11, '2025-10-09 08:30:00', 'done', 'Wawancara berjalan lancar, kandidat menunjukkan motivasi yang baik.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(3, 14, '2025-10-14 12:00:00', 'done', 'Wawancara berjalan lancar, kandidat menunjukkan motivasi yang baik.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(4, 16, '2025-10-08 09:00:00', 'done', 'Kandidat masih perlu meningkatkan kemampuan komunikasi.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(5, 22, '2025-10-16 14:30:00', 'done', 'Wawancara berjalan lancar, kandidat menunjukkan motivasi yang baik.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(6, 23, '2025-10-23 08:30:00', 'scheduled', NULL, '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(7, 26, '2025-10-06 12:30:00', 'done', 'Kandidat masih perlu meningkatkan kemampuan komunikasi.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(8, 28, '2025-10-14 15:30:00', 'done', 'Wawancara berjalan lancar, kandidat menunjukkan motivasi yang baik.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(9, 29, '2025-10-20 14:00:00', 'scheduled', NULL, '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(10, 31, '2025-10-24 14:00:00', 'scheduled', NULL, '2025-10-18 21:57:18', '2025-10-18 21:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `user_id`, `date`, `activity`, `description`, `created_at`, `updated_at`) VALUES
(1, 4, '2025-09-22', 'Melaksanakan tugas yang diberikan mentor', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(2, 4, '2025-09-23', 'Membuat dokumentasi kegiatan harian', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(3, 4, '2025-09-24', 'Menginput data sistem', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(4, 4, '2025-09-25', 'Melaksanakan tugas yang diberikan mentor', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(5, 4, '2025-09-26', 'Membuat dokumentasi kegiatan harian', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(6, 4, '2025-09-27', 'Membuat laporan harian', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(7, 4, '2025-09-28', 'Melaksanakan tugas yang diberikan mentor', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(8, 4, '2025-09-29', 'Mempelajari alur kerja aplikasi internal', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(9, 4, '2025-09-30', 'Mengikuti rapat koordinasi divisi', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(10, 4, '2025-10-01', 'Melaksanakan tugas yang diberikan mentor', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(11, 6, '2025-10-07', 'Membuat laporan harian', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(12, 6, '2025-10-08', 'Mempelajari alur kerja aplikasi internal', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(13, 6, '2025-10-09', 'Membantu tim desain membuat poster kegiatan', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(14, 6, '2025-10-10', 'Membantu tim desain membuat poster kegiatan', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(15, 6, '2025-10-11', 'Mengikuti rapat koordinasi divisi', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(16, 6, '2025-10-12', 'Membuat dokumentasi kegiatan harian', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(17, 6, '2025-10-13', 'Melaksanakan tugas yang diberikan mentor', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(18, 6, '2025-10-14', 'Membuat dokumentasi kegiatan harian', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(19, 9, '2025-09-28', 'Menginput data sistem', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(20, 9, '2025-09-29', 'Melaksanakan tugas yang diberikan mentor', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(21, 9, '2025-09-30', 'Mempelajari alur kerja aplikasi internal', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(22, 9, '2025-10-01', 'Membantu tim desain membuat poster kegiatan', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(23, 9, '2025-10-02', 'Membuat dokumentasi kegiatan harian', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(24, 9, '2025-09-20', 'Membuat dokumentasi kegiatan harian', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(25, 9, '2025-09-21', 'Mengikuti rapat koordinasi divisi', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(26, 9, '2025-09-22', 'Membuat dokumentasi kegiatan harian', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(27, 9, '2025-09-23', 'Melaksanakan tugas yang diberikan mentor', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(28, 9, '2025-09-24', 'Melakukan riset sederhana untuk proyek', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(29, 9, '2025-09-25', 'Mengikuti rapat koordinasi divisi', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(30, 9, '2025-09-26', 'Melaksanakan tugas yang diberikan mentor', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(31, 9, '2025-09-27', 'Melaksanakan tugas yang diberikan mentor', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(32, 9, '2025-09-28', 'Melaksanakan tugas yang diberikan mentor', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(33, 9, '2025-09-29', 'Melakukan riset sederhana untuk proyek', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(34, 19, '2025-10-04', 'Melaksanakan tugas yang diberikan mentor', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(35, 19, '2025-10-05', 'Melaksanakan tugas yang diberikan mentor', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(36, 19, '2025-10-06', 'Melakukan riset sederhana untuk proyek', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(37, 19, '2025-10-07', 'Mengikuti rapat koordinasi divisi', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(38, 19, '2025-10-08', 'Mengikuti rapat koordinasi divisi', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(39, 19, '2025-10-09', 'Membantu tim desain membuat poster kegiatan', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(40, 19, '2025-10-10', 'Membuat dokumentasi kegiatan harian', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(41, 19, '2025-10-11', 'Mempelajari alur kerja aplikasi internal', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(42, 19, '2025-10-12', 'Membuat laporan harian', 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(43, 20, '2025-10-12', 'Membuat laporan harian kegiatan jaringan', 'Kegiatan berjalan lancar dan menambah pengalaman praktis.', '2025-10-18 22:09:27', '2025-10-18 22:09:27'),
(44, 20, '2025-10-13', 'Membantu tim memperbaiki koneksi internet kantor', 'Kegiatan berjalan lancar dan menambah pengalaman praktis.', '2025-10-18 22:09:27', '2025-10-18 22:09:27'),
(45, 20, '2025-10-14', 'Melakukan instalasi ulang sistem operasi', 'Kegiatan berjalan lancar dan menambah pengalaman praktis.', '2025-10-18 22:09:27', '2025-10-18 22:09:27'),
(46, 20, '2025-10-15', 'Mendokumentasikan peralatan IT yang digunakan', 'Kegiatan berjalan lancar dan menambah pengalaman praktis.', '2025-10-18 22:09:27', '2025-10-18 22:09:27'),
(47, 20, '2025-10-16', 'Mengikuti rapat koordinasi tim IT', 'Kegiatan berjalan lancar dan menambah pengalaman praktis.', '2025-10-18 22:09:27', '2025-10-18 22:09:27'),
(48, 20, '2025-10-17', 'Membuat panduan troubleshooting dasar', 'Kegiatan berjalan lancar dan menambah pengalaman praktis.', '2025-10-18 22:09:27', '2025-10-18 22:09:27'),
(49, 20, '2025-10-18', 'Membantu backup data ke server lokal', 'Kegiatan berjalan lancar dan menambah pengalaman praktis.', '2025-10-18 22:09:27', '2025-10-18 22:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_13_091824_create_positions_table', 1),
(5, '2025_10_13_091838_create_applications_table', 1),
(6, '2025_10_13_091853_create_documents_table', 1),
(7, '2025_10_13_091902_create_selections_table', 1),
(8, '2025_10_13_091911_create_interviews_table', 1),
(9, '2025_10_13_091918_create_journals_table', 1),
(10, '2025_10_13_091925_create_evaluations_table', 1),
(11, '2025_10_13_091935_create_certificates_table', 1),
(12, '2025_10_13_091943_create_final_reports_table', 1),
(13, '2025_10_13_091955_create_notifications_table', 1),
(14, '2025_10_13_092143_add_fields_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `read`, `created_at`, `updated_at`) VALUES
(1, 2, 'Lamaran magang Anda telah diterima dan sedang diproses.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(2, 2, 'Selamat! Anda diterima untuk mengikuti program magang.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(3, 2, 'Lamaran magang Anda sedang dalam tahap review oleh tim HR.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(4, 3, 'Status lamaran Anda telah diperbarui.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(5, 3, 'Lamaran magang Anda telah diterima dan sedang diproses.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(6, 4, 'Selamat! Anda telah menyelesaikan program magang.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(7, 4, 'Status lamaran Anda telah diperbarui.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(8, 4, 'Status lamaran Anda telah diperbarui.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(9, 5, 'Lamaran magang Anda sedang dalam tahap review oleh tim HR.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(10, 6, 'Selamat! Anda telah menyelesaikan program magang.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(11, 6, 'Anda dijadwalkan untuk wawancara. Silakan cek jadwal di dashboard Anda.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(12, 6, 'Status lamaran Anda telah diperbarui.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(13, 7, 'Lamaran magang Anda telah diterima dan sedang diproses.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(14, 7, 'Anda dijadwalkan untuk wawancara. Silakan cek jadwal di dashboard Anda.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(15, 8, 'Lamaran magang Anda sedang dalam tahap review oleh tim HR.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(16, 8, 'Selamat! Anda diterima untuk mengikuti program magang.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(17, 8, 'Status lamaran Anda telah diperbarui.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(18, 9, 'Selamat! Anda telah menyelesaikan program magang.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(19, 9, 'Lamaran magang Anda sedang dalam tahap review oleh tim HR.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(20, 9, 'Selamat! Anda telah menyelesaikan program magang.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(21, 10, 'Lamaran magang Anda telah diterima dan sedang diproses.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(22, 11, 'Selamat! Anda diterima untuk mengikuti program magang.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(23, 11, 'Selamat! Anda diterima untuk mengikuti program magang.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(24, 12, 'Lamaran magang Anda telah diterima dan sedang diproses.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(25, 13, 'Lamaran magang Anda telah diterima dan sedang diproses.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(26, 14, 'Selamat! Anda diterima untuk mengikuti program magang.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(27, 15, 'Status lamaran Anda telah diperbarui.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(28, 15, 'Anda dijadwalkan untuk wawancara. Silakan cek jadwal di dashboard Anda.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(29, 15, 'Selamat! Anda diterima untuk mengikuti program magang.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(30, 16, 'Lamaran magang Anda telah diterima dan sedang diproses.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(31, 16, 'Anda dijadwalkan untuk wawancara. Silakan cek jadwal di dashboard Anda.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(32, 16, 'Status lamaran Anda telah diperbarui.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(33, 17, 'Lamaran magang Anda telah diterima dan sedang diproses.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(34, 17, 'Lamaran magang Anda sedang dalam tahap review oleh tim HR.', 1, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(35, 17, 'Status lamaran Anda telah diperbarui.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(36, 18, 'Status lamaran Anda telah diperbarui.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(37, 19, 'Selamat! Anda telah menyelesaikan program magang.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(38, 19, 'Lamaran magang Anda sedang dalam tahap review oleh tim HR.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(39, 2, 'Anda memiliki jadwal wawancara pada 21 Oct 2025 12:00', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(40, 11, 'Anda memiliki jadwal wawancara pada 23 Oct 2025 08:30', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(41, 15, 'Anda memiliki jadwal wawancara pada 20 Oct 2025 14:00', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(42, 16, 'Anda memiliki jadwal wawancara pada 24 Oct 2025 14:00', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(43, 4, 'Sertifikat magang Anda telah diterbitkan dan dapat diunduh melalui dashboard.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(44, 6, 'Sertifikat magang Anda telah diterbitkan dan dapat diunduh melalui dashboard.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(45, 9, 'Sertifikat magang Anda telah diterbitkan dan dapat diunduh melalui dashboard.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(46, 9, 'Sertifikat magang Anda telah diterbitkan dan dapat diunduh melalui dashboard.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(47, 19, 'Sertifikat magang Anda telah diterbitkan dan dapat diunduh melalui dashboard.', 0, '2025-10-18 21:57:19', '2025-10-18 21:57:19'),
(48, 20, 'Selamat! Anda resmi memulai program magang.', 0, '2025-10-18 22:09:27', '2025-10-18 22:09:27'),
(49, 20, 'Jangan lupa isi jurnal harian Anda setiap hari.', 0, '2025-10-18 22:09:27', '2025-10-18 22:09:27'),
(50, 20, 'Periksa dashboard untuk update kegiatan magang.', 0, '2025-10-18 22:09:27', '2025-10-18 22:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `quota` int NOT NULL DEFAULT '1',
  `deadline` date DEFAULT NULL,
  `status` enum('open','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `title`, `department`, `description`, `requirements`, `quota`, `deadline`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Staf Desain Grafis', 'Humas & Publikasi', 'Membantu membuat desain grafis untuk keperluan publikasi Diskominfo.', 'Menguasai CorelDraw atau Adobe Illustrator.', 2, '2025-11-08', 'open', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(2, 'Staf Web Developer', 'Teknologi Informasi', 'Bertugas mengembangkan dan memelihara website internal.', 'Menguasai HTML, CSS, dan Laravel.', 3, '2025-11-18', 'open', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(3, 'Staf Administrasi', 'Sekretariat', 'Membantu kegiatan administrasi dan dokumentasi surat-menyurat.', 'Teliti, mampu mengoperasikan Microsoft Office.', 2, '2025-10-29', 'open', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(4, 'Staf Jurnalistik', 'Humas & Publikasi', 'Menulis berita kegiatan Diskominfo dan membuat konten untuk media sosial.', 'Mampu menulis dan memahami dasar jurnalistik.', 2, '2025-11-13', 'open', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(5, 'Staf IT Support', 'Teknologi Informasi', 'Membantu troubleshooting jaringan dan peralatan komputer.', 'Memahami dasar jaringan dan perakitan komputer.', 2, '2025-11-03', 'open', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(6, 'Staf Dokumentasi Kegiatan', 'Humas & Publikasi', 'Mengambil foto dan video kegiatan Diskominfo serta mengelolanya.', 'Menguasai kamera DSLR dan software editing dasar.', 2, '2025-10-31', 'open', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(7, 'Staf Data dan Statistik', 'Bidang Statistik', 'Membantu pengumpulan dan pengolahan data daerah.', 'Menguasai Excel dan analisis data dasar.', 2, '2025-11-06', 'open', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(8, 'Staf Keamanan Informasi', 'Bidang Keamanan Data', 'Membantu monitoring sistem keamanan dan backup data.', 'Mengetahui dasar keamanan jaringan dan sistem.', 1, '2025-11-08', 'open', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(9, 'Staf Layanan Publik', 'Bidang Informasi Publik', 'Melayani masyarakat dalam permohonan informasi publik.', 'Komunikatif dan memahami UU KIP.', 1, '2025-11-10', 'open', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(10, 'Staf Sosial Media', 'Humas & Publikasi', 'Mengelola akun media sosial resmi Diskominfo.', 'Kreatif dan mampu membuat caption yang menarik.', 2, '2025-11-02', 'open', '2025-10-18 21:57:18', '2025-10-18 21:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `selections`
--

CREATE TABLE `selections` (
  `id` bigint UNSIGNED NOT NULL,
  `application_id` bigint UNSIGNED NOT NULL,
  `score` int DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `result` enum('pending','passed','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `selections`
--

INSERT INTO `selections` (`id`, `application_id`, `score`, `remarks`, `result`, `created_at`, `updated_at`) VALUES
(1, 2, 90, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(2, 3, 79, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(3, 4, 88, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(4, 6, 90, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(5, 7, 75, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(6, 8, 100, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(7, 9, 67, 'Belum memenuhi standar seleksi administrasi.', 'failed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(8, 10, 82, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(9, 11, 85, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(10, 12, 74, 'Belum memenuhi standar seleksi administrasi.', 'failed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(11, 14, 62, 'Belum memenuhi standar seleksi administrasi.', 'failed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(12, 15, 100, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(13, 16, 86, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(14, 17, 97, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(15, 18, 98, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(16, 19, 65, 'Belum memenuhi standar seleksi administrasi.', 'failed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(17, 20, 61, 'Belum memenuhi standar seleksi administrasi.', 'failed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(18, 22, 93, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(19, 23, 62, 'Belum memenuhi standar seleksi administrasi.', 'failed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(20, 26, 64, 'Belum memenuhi standar seleksi administrasi.', 'failed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(21, 27, 84, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(22, 28, 67, 'Belum memenuhi standar seleksi administrasi.', 'failed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(23, 29, 80, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(24, 31, 100, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(25, 32, 75, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(26, 34, 91, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(27, 35, 95, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(28, 36, 62, 'Belum memenuhi standar seleksi administrasi.', 'failed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(29, 37, 80, 'Lolos tahap seleksi administrasi.', 'passed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(30, 38, 62, 'Belum memenuhi standar seleksi administrasi.', 'failed', '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(31, 1, 90, 'ok', 'passed', '2025-10-19 02:10:42', '2025-10-19 02:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('OASfoOhXIsD0jowEBMpHqgHRjAhQcYnzI85TMHsf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWE5nYU02VWNmQThFRTk4bWJtNmxySVk1SHdHSXYxVFM2OGF1YzlLciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1760872853);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('student','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `school_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `major` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education_level` enum('SMK','Universitas') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `school_name`, `major`, `education_level`, `phone`, `address`, `profile_photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator Sistem', 'admin@example.com', NULL, '$2y$12$z85S.uBaprr5lNdKX3oSquQsYS.D2rJ1Q31mwowZYSc2RXDhha/KK', 'admin', NULL, NULL, NULL, '081234567890', 'Diskominfo Kabupaten Contoh', NULL, NULL, '2025-10-18 21:57:15', '2025-10-18 21:57:15'),
(2, 'Cager Rajasa', 'student1@example.com', NULL, '$2y$12$w5fCXwrWzIYjogZuxAY4FOUPa4PcESDGwxwIo/0j1/CB5dp7J/Dce', 'student', 'Universitas Diponegoro', 'Sistem Informasi', 'SMK', '081879086846', 'Ds. Kalimantan No. 13, Tual 88495, Bali', NULL, NULL, '2025-10-18 21:57:15', '2025-10-18 21:57:15'),
(3, 'Jayadi Halim S.H.', 'student2@example.com', NULL, '$2y$12$68ieOWt9yUKdMotylntEluHfr3ZTmqhyKGKrQDMN0ZIcaU9olpI.K', 'student', 'Universitas Brawijaya', 'Manajemen', 'SMK', '086461488983', 'Gg. Camar No. 390, Pangkal Pinang 19360, Sumut', NULL, NULL, '2025-10-18 21:57:15', '2025-10-18 21:57:15'),
(4, 'Cayadi Emas Jailani', 'student3@example.com', NULL, '$2y$12$9UenV.JbGC4H2JSZEL7oKe09llKlFyfA1hx9YmjmuCVZPkdkgJYwW', 'student', 'SMK Negeri 2 Jakarta', 'Akuntansi', 'Universitas', '086280739910', 'Jr. Suryo No. 243, Tangerang 13264, Lampung', NULL, NULL, '2025-10-18 21:57:15', '2025-10-18 21:57:15'),
(5, 'Kamila Kayla Halimah', 'student4@example.com', NULL, '$2y$12$rjVpO3CsvQmvPmgoI4RiSe9lsKGVDH1XxKvAVtQ8VLt7CNLG27CXa', 'student', 'Universitas Diponegoro', 'Teknik Informatika', 'SMK', '081241230643', 'Jln. Banda No. 484, Bandar Lampung 78190, Jateng', NULL, NULL, '2025-10-18 21:57:16', '2025-10-18 21:57:16'),
(6, 'Hesti Aryani S.Gz', 'student5@example.com', NULL, '$2y$12$Hrit9dA0WeQF0v1cdwjZqO7JXxo9A00fbi9QlnL0pJCM70..DerH6', 'student', 'SMK Telkom Malang', 'Teknik Informatika', 'Universitas', '087829305516', 'Psr. Kalimalang No. 906, Tidore Kepulauan 39312, Gorontalo', NULL, NULL, '2025-10-18 21:57:16', '2025-10-18 21:57:16'),
(7, 'Legawa Dadi Najmudin', 'student6@example.com', NULL, '$2y$12$8z9J0kfweKYa56Mfy7n4nek8BFHIeStqKsI.nPuvi/sVWvznEJaWy', 'student', 'SMK Negeri 2 Jakarta', 'Akuntansi', 'SMK', '081703119604', 'Ki. Yogyakarta No. 103, Tanjungbalai 28157, Sumsel', NULL, NULL, '2025-10-18 21:57:16', '2025-10-18 21:57:16'),
(8, 'Jumari Firmansyah', 'student7@example.com', NULL, '$2y$12$0ynzQVUPvZuckpGLcl1NtO5wW/7Wmz9UWETC4o/q.827mPQ7y.GLq', 'student', 'Universitas Diponegoro', 'Teknik Informatika', 'Universitas', '082981529856', 'Jr. Radio No. 238, Subulussalam 47763, Bali', NULL, NULL, '2025-10-18 21:57:16', '2025-10-18 21:57:16'),
(9, 'Darman Saadat Narpati', 'student8@example.com', NULL, '$2y$12$FQtmByvZg9LHYwTKKEyu1eCB9aUbxpQxUwq6fr0xNCnaQhR9CzKFu', 'student', 'SMK Negeri 1 Bandung', 'Akuntansi', 'SMK', '082639997023', 'Gg. Barasak No. 825, Palembang 75639, Sulbar', NULL, NULL, '2025-10-18 21:57:16', '2025-10-18 21:57:16'),
(10, 'Caturangga Saragih', 'student9@example.com', NULL, '$2y$12$8qqX4mgZXdHGGVRvJgjcZuvBiJ3EaJuaZVGkVW7i3Dj3zP2o2Tyzi', 'student', 'SMK Negeri 2 Jakarta', 'Desain Grafis', 'Universitas', '086059606191', 'Ki. Casablanca No. 953, Administrasi Jakarta Utara 15709, Sulbar', NULL, NULL, '2025-10-18 21:57:16', '2025-10-18 21:57:16'),
(11, 'Salimah Melani', 'student10@example.com', NULL, '$2y$12$n1c6LD7uW4JT6enQMCfM4O.mcZBJY.W5BJbenSWQj0QnCExPxV4V2', 'student', 'SMK Negeri 2 Jakarta', 'Sistem Informasi', 'Universitas', '089888928264', 'Jln. Gremet No. 247, Batu 79762, Gorontalo', NULL, NULL, '2025-10-18 21:57:17', '2025-10-18 21:57:17'),
(12, 'Halima Melani M.Kom.', 'student11@example.com', NULL, '$2y$12$KBDt7hJp4NCuMJjAB8QsbuzeclTmU8ApUpCK03NjiQ4oaVWQfmXq.', 'student', 'SMK Telkom Malang', 'Akuntansi', 'Universitas', '082505675409', 'Ds. Basoka No. 962, Gorontalo 53018, Jatim', NULL, NULL, '2025-10-18 21:57:17', '2025-10-18 21:57:17'),
(13, 'Yuni Ifa Suartini', 'student12@example.com', NULL, '$2y$12$3rHP5Ra/R7qyC9afERbDaOpEf7LQI0Dn3c9bsqS91bjXIkhwTvvaO', 'student', 'SMK Negeri 2 Jakarta', 'Sistem Informasi', 'Universitas', '089155606104', 'Gg. Bambon No. 786, Mojokerto 67966, Sumut', NULL, NULL, '2025-10-18 21:57:17', '2025-10-18 21:57:17'),
(14, 'Icha Hilda Pratiwi', 'student13@example.com', NULL, '$2y$12$CqLUqr.ctIpgsZHoqtpOoukHnmIysXOdC5vErh.JqvCzYw2Wm0V3u', 'student', 'SMK Telkom Malang', 'Manajemen', 'Universitas', '087059081933', 'Gg. B.Agam 1 No. 136, Bima 48940, Sulsel', NULL, NULL, '2025-10-18 21:57:17', '2025-10-18 21:57:17'),
(15, 'Muhammad Narpati', 'student14@example.com', NULL, '$2y$12$slZaGCTX6I/yuE0yDCvd2eQuVWxZ9ewZxfpQejj02bNRUA8eANwYu', 'student', 'Universitas Diponegoro', 'Teknik Informatika', 'Universitas', '082777668173', 'Dk. Sugiono No. 404, Bau-Bau 90376, DIY', NULL, NULL, '2025-10-18 21:57:17', '2025-10-18 21:57:17'),
(16, 'Hamima Kamaria Hastuti M.Pd', 'student15@example.com', NULL, '$2y$12$5SIU8xhyQCIdb5/Bivxlmu8myRm1zEP6fO.21NbXDzCFI0gQ/iZS2', 'student', 'Universitas Diponegoro', 'Sistem Informasi', 'SMK', '083793487744', 'Gg. Cemara No. 4, Administrasi Jakarta Utara 23515, Sulsel', NULL, NULL, '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(17, 'Jasmin Puspasari', 'student16@example.com', NULL, '$2y$12$H4NzNYiQDW1B6jJ0nOJ3E.iWAhGS72.YEmwIh2TfgB97XLgoysH/q', 'student', 'Universitas Brawijaya', 'Teknik Informatika', 'SMK', '083940155631', 'Ds. Karel S. Tubun No. 277, Semarang 38415, Kaltara', NULL, NULL, '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(18, 'Indah Ani Hartati', 'student17@example.com', NULL, '$2y$12$ExHSeo3.7h.2wQmXDTKTzuxf1Sg7caxr.2sy8HZC7Wg8H2NG1y7qK', 'student', 'Universitas Diponegoro', 'Manajemen', 'SMK', '086303021559', 'Jln. Suniaraja No. 253, Balikpapan 26268, Kalbar', NULL, NULL, '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(19, 'Koko Kuswoyo', 'student18@example.com', NULL, '$2y$12$vfd2RiuOUn0q.sK0Et8usuSKYnaW/pyRLcHXH00qdtDhSxgtQIRBu', 'student', 'SMK Negeri 2 Jakarta', 'Akuntansi', 'SMK', '083280105750', 'Gg. Cut Nyak Dien No. 479, Palu 64756, Kaltara', NULL, NULL, '2025-10-18 21:57:18', '2025-10-18 21:57:18'),
(20, 'Rafi Aditya', 'rafi.aditya@example.com', NULL, '$2y$12$Pwh4n2p7eweww5ieHYqS0ucn2qoB0I2kqbssoDrOlzt3gRtYgmxa6', 'student', 'SMK Negeri 5 Bandung', 'Teknik Komputer dan Jaringan', 'SMK', '081234567890', 'Jl. Sukamaju No. 23, Bandung', 'uploads/profiles/rafi.jpg', NULL, '2025-10-18 22:09:27', '2025-10-18 22:09:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_user_id_foreign` (`user_id`),
  ADD KEY `applications_position_id_foreign` (`position_id`);

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
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_application_id_foreign` (`application_id`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluations_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `final_reports`
--
ALTER TABLE `final_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `final_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `interviews`
--
ALTER TABLE `interviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interviews_application_id_foreign` (`application_id`);

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
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journals_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selections`
--
ALTER TABLE `selections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `selections_application_id_foreign` (`application_id`);

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
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_reports`
--
ALTER TABLE `final_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `interviews`
--
ALTER TABLE `interviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `selections`
--
ALTER TABLE `selections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `final_reports`
--
ALTER TABLE `final_reports`
  ADD CONSTRAINT `final_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interviews`
--
ALTER TABLE `interviews`
  ADD CONSTRAINT `interviews_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `journals`
--
ALTER TABLE `journals`
  ADD CONSTRAINT `journals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `selections`
--
ALTER TABLE `selections`
  ADD CONSTRAINT `selections_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
