-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2025 at 01:22 PM
-- Server version: 10.11.14-MariaDB-cll-lve
-- PHP Version: 8.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vfhrzqpb_simmagang`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `motivation` text DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `active_email` varchar(255) DEFAULT NULL,
  `status` enum('submitted','under_review','interview','accepted','rejected','active','completed') NOT NULL DEFAULT 'submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `position_id`, `motivation`, `duration`, `whatsapp_number`, `active_email`, `status`, `created_at`, `updated_at`) VALUES
(1, 16, 8, 'Saya ingin magang disini', '3 Months', '081378945612', 'student14@example.com', 'under_review', '2025-11-02 22:25:12', '2025-11-02 22:28:18'),
(2, 15, 7, 'Saya ingin menambah pengalaman dengan magang disini', '12 Months', '081245671234', 'student13@example.com', 'interview', '2025-11-02 22:29:22', '2025-11-02 22:30:01'),
(3, 14, 2, 'Menambah Pengalaman sekaligus Ilmu', '12 Months', '081399887766', 'student12@example.com', 'accepted', '2025-11-02 22:31:40', '2025-11-02 22:33:47'),
(4, 13, 9, 'Saya sangat tertarik untuk magang disini sebagai Finance', '12 Months', '081234567812', 'student11@example.com', 'active', '2025-11-02 22:37:41', '2025-11-02 22:38:53'),
(5, 12, 3, 'saya memiliki pengalaman di bidang ini dan ingin menambah pengalaman kerja lebih agar dapat berkontribusi di diskominfo', '12 Months', '081398765412', 'student10@example.com', 'active', '2025-11-02 22:40:45', '2025-11-02 22:41:55'),
(6, 11, 12, 'Menambah Ilmu dan pengalaman', '12 Months', '081287654321', 'student9@example.com', 'active', '2025-11-02 22:44:49', '2025-11-02 22:45:31'),
(7, 10, 4, 'Saya ingin mendalami dan mendapatkan kesempatan kerja', '6 Months', '081278934561', 'student8@example.com', 'completed', '2025-11-02 22:49:05', '2025-11-02 22:51:29'),
(8, 9, 5, 'ingin magang', '1 Month', '081278945612', 'student7@example.com', 'rejected', '2025-11-02 23:00:25', '2025-11-02 23:01:08'),
(9, 8, 11, 'pengen jadi manager', '3 Months', '081345671234', 'student6@example.com', 'rejected', '2025-11-02 23:02:31', '2025-11-02 23:03:40'),
(10, 7, 7, 'mau magang', '1 Month', '081365432187', 'student5@example.com', 'rejected', '2025-11-02 23:05:05', '2025-11-02 23:09:02'),
(11, 7, 2, 'Saya ingin mengembangkan ilmu Backedn saya di pemagangan ini', '12 Months', '081365432187', 'student5@example.com', 'submitted', '2025-11-02 23:09:38', '2025-11-02 23:09:38');

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
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `user_id`, `file_path`, `issued_date`, `created_at`, `updated_at`) VALUES
(1, 11, 'certificates/certificate_rahmat_fauzi_1762148851.pdf', '2025-11-03', '2025-11-02 22:47:31', '2025-11-02 22:47:31'),
(2, 10, 'certificates/certificate_clara_wijayanti_1762149084.pdf', '2025-11-03', '2025-11-02 22:51:24', '2025-11-02 22:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `application_id`, `type`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, 'cv', 'documents/1762147512_69083cb82b947_cv.pdf', '2025-11-02 22:25:12', '2025-11-02 22:25:12'),
(2, 1, 'recommendation', 'documents/1762147512_69083cb82d4dc_recommendation.pdf', '2025-11-02 22:25:12', '2025-11-02 22:25:12'),
(3, 1, 'portfolio', 'documents/1762147512_69083cb82e706_portfolio.pdf', '2025-11-02 22:25:12', '2025-11-02 22:25:12'),
(4, 2, 'cv', 'documents/1762147762_69083db2a15bb_cv.pdf', '2025-11-02 22:29:22', '2025-11-02 22:29:22'),
(5, 2, 'recommendation', 'documents/1762147762_69083db2a2ba2_recommendation.pdf', '2025-11-02 22:29:22', '2025-11-02 22:29:22'),
(6, 3, 'cv', 'documents/1762147900_69083e3cacada_cv.pdf', '2025-11-02 22:31:40', '2025-11-02 22:31:40'),
(7, 3, 'recommendation', 'documents/1762147900_69083e3cae192_recommendation.pdf', '2025-11-02 22:31:40', '2025-11-02 22:31:40'),
(8, 4, 'cv', 'documents/1762148261_69083fa575664_cv.pdf', '2025-11-02 22:37:41', '2025-11-02 22:37:41'),
(9, 4, 'recommendation', 'documents/1762148261_69083fa5769b4_recommendation.pdf', '2025-11-02 22:37:41', '2025-11-02 22:37:41'),
(10, 5, 'cv', 'documents/1762148445_6908405d819bc_cv.pdf', '2025-11-02 22:40:45', '2025-11-02 22:40:45'),
(11, 5, 'recommendation', 'documents/1762148445_6908405d82c00_recommendation.pdf', '2025-11-02 22:40:45', '2025-11-02 22:40:45'),
(12, 6, 'cv', 'documents/1762148689_69084151a7a6c_cv.pdf', '2025-11-02 22:44:49', '2025-11-02 22:44:49'),
(13, 6, 'recommendation', 'documents/1762148689_69084151a8cd4_recommendation.pdf', '2025-11-02 22:44:49', '2025-11-02 22:44:49'),
(14, 7, 'cv', 'documents/1762148945_6908425170d6d_cv.pdf', '2025-11-02 22:49:05', '2025-11-02 22:49:05'),
(15, 7, 'recommendation', 'documents/1762148945_6908425172403_recommendation.pdf', '2025-11-02 22:49:05', '2025-11-02 22:49:05'),
(16, 8, 'cv', 'documents/1762149625_690844f97a657_cv.pdf', '2025-11-02 23:00:25', '2025-11-02 23:00:25'),
(17, 8, 'recommendation', 'documents/1762149625_690844f97bc5b_recommendation.pdf', '2025-11-02 23:00:25', '2025-11-02 23:00:25'),
(18, 9, 'cv', 'documents/1762149751_6908457733526_cv.pdf', '2025-11-02 23:02:31', '2025-11-02 23:02:31'),
(19, 9, 'recommendation', 'documents/1762149751_69084577348a5_recommendation.pdf', '2025-11-02 23:02:31', '2025-11-02 23:02:31'),
(20, 10, 'cv', 'documents/1762149905_690846117c448_cv.pdf', '2025-11-02 23:05:05', '2025-11-02 23:05:05'),
(21, 10, 'recommendation', 'documents/1762149905_690846117d7bf_recommendation.pdf', '2025-11-02 23:05:05', '2025-11-02 23:05:05'),
(22, 11, 'cv', 'documents/1762150178_69084722b8bce_cv.pdf', '2025-11-02 23:09:38', '2025-11-02 23:09:38'),
(23, 11, 'recommendation', 'documents/1762150178_69084722b9d84_recommendation.pdf', '2025-11-02 23:09:38', '2025-11-02 23:09:38');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `discipline` int(11) DEFAULT NULL COMMENT 'Kedisiplinan',
  `teamwork` int(11) DEFAULT NULL COMMENT 'Kerja sama tim',
  `communication` int(11) DEFAULT NULL COMMENT 'Kemampuan komunikasi',
  `skill` int(11) DEFAULT NULL COMMENT 'Kompetensi keahlian',
  `responsibility` int(11) DEFAULT NULL COMMENT 'Tanggung jawab',
  `notes` text DEFAULT NULL COMMENT 'Catatan tambahan dari pembimbing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`id`, `user_id`, `discipline`, `teamwork`, `communication`, `skill`, `responsibility`, `notes`, `created_at`, `updated_at`) VALUES
(1, 11, 98, 98, 95, 97, 98, 'Sangat Baik', '2025-11-02 22:47:09', '2025-11-02 22:47:09'),
(2, 10, 94, 95, 95, 89, 95, 'Sangat Membantu', '2025-11-02 22:51:13', '2025-11-02 22:51:13');

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
-- Table structure for table `final_reports`
--

CREATE TABLE `final_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `final_reports`
--

INSERT INTO `final_reports` (`id`, `user_id`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 12, 'final_reports/1762148611_690841033668c.pdf', '2025-11-02 22:43:31', '2025-11-02 22:43:31'),
(2, 11, 'final_reports/1762148789_690841b550c10.pdf', '2025-11-02 22:46:29', '2025-11-02 22:46:29'),
(3, 10, 'final_reports/1762149042_690842b230265.pdf', '2025-11-02 22:50:42', '2025-11-02 22:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `interviews`
--

CREATE TABLE `interviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `scheduled_at` datetime DEFAULT NULL,
  `status` enum('scheduled','done','canceled') NOT NULL DEFAULT 'scheduled',
  `result` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interviews`
--

INSERT INTO `interviews` (`id`, `application_id`, `scheduled_at`, `status`, `result`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-11-28 12:29:00', 'scheduled', NULL, '2025-11-02 22:30:02', '2025-11-02 22:30:02'),
(2, 3, '2025-11-03 12:32:00', 'done', 'Sangat Baik', '2025-11-02 22:32:34', '2025-11-02 22:33:06'),
(3, 4, '2025-11-03 12:38:00', 'done', 'Sangat bagus', '2025-11-02 22:38:28', '2025-11-02 22:38:36'),
(4, 5, '2025-11-01 12:41:00', 'done', 'sangat kompeten', '2025-11-02 22:41:42', '2025-11-02 22:41:42'),
(5, 6, '2025-10-31 12:45:00', 'done', 'Kompeten', '2025-11-02 22:45:25', '2025-11-02 22:45:25'),
(6, 7, '2025-10-31 12:49:00', 'done', 'Keren', '2025-11-02 22:49:39', '2025-11-02 22:49:39'),
(7, 9, '2025-11-03 13:03:00', 'canceled', 'Tidak menghadiri jadwal wawancara', '2025-11-02 23:03:30', '2025-11-02 23:03:30');

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
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `activity` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `user_id`, `date`, `activity`, `description`, `created_at`, `updated_at`) VALUES
(1, 12, '2025-11-03', 'Membuat Tampilan UI Dashboard Admin', 'Membuat Tampilan UI Dashboard Admin', '2025-11-02 22:43:00', '2025-11-02 22:43:00'),
(2, 12, '2025-11-03', 'Membuat Tampilan UI Dashboard Public', 'Membuat Tampilan UI Dashboard Public', '2025-11-02 22:43:13', '2025-11-02 22:43:13'),
(3, 11, '2025-11-03', 'Membuat Company Profile Video', 'Membuat Company Profile video', '2025-11-02 22:45:59', '2025-11-02 22:45:59'),
(4, 11, '2025-11-03', 'Membuat Company Feed Social Media', 'Membuat Company Feed Social Media', '2025-11-02 22:46:12', '2025-11-02 22:46:12'),
(5, 10, '2025-11-03', 'Membuat Rancangan Promosi', 'Membuat Rancangan Promosi', '2025-11-02 22:50:17', '2025-11-02 22:50:17'),
(6, 10, '2025-11-03', 'Membuat Feed Social Media', 'Membuat Feed Social Media', '2025-11-02 22:50:33', '2025-11-02 22:50:33');

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `requirements` text DEFAULT NULL,
  `quota` int(11) NOT NULL DEFAULT 1,
  `deadline` date DEFAULT NULL,
  `status` enum('open','closed') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `title`, `department`, `description`, `requirements`, `quota`, `deadline`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Frontend Developer Intern', 'Technology', 'Membantu tim pengembangan dalam membangun antarmuka web menggunakan React dan Tailwind. Berkolaborasi dengan UI/UX Designer untuk implementasi desain.', 'Menguasai dasar HTML, CSS, JavaScript, dan framework frontend seperti React atau Vue. Memiliki minat di bidang UI/UX.', 3, '2025-12-15', 'open', '2025-11-02 22:10:52', '2025-11-02 22:10:52'),
(2, 'Backend Developer Intern', 'Technology', 'Bertanggung jawab dalam mengembangkan dan memelihara API backend menggunakan Laravel. Membantu dalam integrasi sistem dengan database MySQL.', 'Menguasai PHP dan Laravel. Memahami konsep REST API dan database relational.', 2, '2025-12-10', 'open', '2025-11-02 22:10:52', '2025-11-02 22:10:52'),
(3, 'UI/UX Designer Intern', 'Design', 'Berpartisipasi dalam riset pengguna, membuat wireframe, dan prototipe desain untuk aplikasi web dan mobile.', 'Menguasai Figma atau Adobe XD. Memahami dasar-dasar user experience design dan visual hierarchy.', 2, '2025-12-20', 'open', '2025-11-02 22:10:52', '2025-11-02 22:10:52'),
(4, 'Digital Marketing Intern', 'Marketing', 'Membantu pelaksanaan kampanye digital melalui media sosial, SEO, dan email marketing. Melakukan analisis performa kampanye.', 'Aktif di media sosial, memahami dasar copywriting dan Google Analytics. Kreatif dan komunikatif.', 3, '2025-12-25', 'open', '2025-11-02 22:10:52', '2025-11-02 22:10:52'),
(5, 'Content Writer Intern', 'Marketing', 'Membuat artikel dan konten untuk website dan media sosial perusahaan. Fokus pada konten edukatif dan branding.', 'Pandai menulis, memiliki kemampuan riset yang baik, dan memahami SEO dasar.', 2, '2025-12-18', 'open', '2025-11-02 22:10:52', '2025-11-02 22:10:52'),
(6, 'Graphic Designer Intern', 'Design', 'Membantu tim marketing dan produk dalam pembuatan materi grafis seperti poster, banner, dan konten media sosial.', 'Menguasai Adobe Photoshop/Illustrator/CorelDRAW. Kreatif dan memiliki portofolio desain.', 2, '2025-12-12', 'open', '2025-11-02 22:10:52', '2025-11-02 22:10:52'),
(7, 'Data Analyst Intern', 'Business Intelligence', 'Mengumpulkan, membersihkan, dan menganalisis data operasional perusahaan untuk membantu pengambilan keputusan.', 'Menguasai Excel/Google Sheets dan dasar SQL. Memahami analisis data dan visualisasi (Power BI/Tableau nilai plus).', 2, '2025-12-30', 'open', '2025-11-02 22:10:52', '2025-11-02 22:10:52'),
(8, 'HR Intern', 'Human Resources', 'Mendukung kegiatan rekrutmen, administrasi karyawan, dan pengelolaan data kehadiran.', 'Mahasiswa Psikologi, Manajemen, atau sejenisnya. Teliti dan komunikatif.', 2, '2025-12-05', 'open', '2025-11-02 22:10:52', '2025-11-02 22:10:52'),
(9, 'Finance Intern', 'Finance', 'Membantu proses pencatatan transaksi keuangan dan penyusunan laporan bulanan.', 'Mahasiswa Akuntansi/Manajemen Keuangan. Menguasai Excel dan dasar akuntansi.', 1, '2025-12-22', 'open', '2025-11-02 22:10:52', '2025-11-02 22:10:52'),
(10, 'Customer Service Intern', 'Operations', 'Berinteraksi dengan pelanggan, menangani pertanyaan, dan memastikan kepuasan pengguna.', 'Komunikatif, sabar, dan memiliki kemampuan interpersonal yang baik.', 3, '2025-12-28', 'open', '2025-11-02 22:10:52', '2025-11-02 22:10:52'),
(11, 'Project Management Intern', 'Operations', 'Mendukung manajer proyek dalam koordinasi tim, pembuatan laporan progres, dan dokumentasi proyek.', 'Memiliki kemampuan organisasi dan komunikasi yang baik. Mahir menggunakan Google Workspace.', 1, '2025-12-17', 'open', '2025-11-02 22:10:52', '2025-11-02 22:10:52'),
(12, 'Video Editor Intern', 'Creative', 'Membuat dan mengedit video promosi, dokumentasi kegiatan, serta konten media sosial.', 'Menguasai Adobe Premiere Pro/CapCut. Kreatif dan memahami storytelling visual.', 2, '2025-12-27', 'open', '2025-11-02 22:10:52', '2025-11-02 22:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `selections`
--

CREATE TABLE `selections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `result` enum('pending','passed','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `selections`
--

INSERT INTO `selections` (`id`, `application_id`, `score`, `remarks`, `result`, `created_at`, `updated_at`) VALUES
(1, 1, 87, 'Baik', 'passed', '2025-11-02 22:28:18', '2025-11-02 22:28:18'),
(2, 2, 95, 'SANGAT BAIK', 'passed', '2025-11-02 22:29:44', '2025-11-02 22:30:02'),
(3, 3, 97, 'Sangat Baik', 'passed', '2025-11-02 22:32:18', '2025-11-02 22:33:47'),
(4, 4, 98, 'Sangat Bagus', 'passed', '2025-11-02 22:38:05', '2025-11-02 22:38:28'),
(5, 5, 98, 'Sangat kompeten', 'passed', '2025-11-02 22:41:16', '2025-11-02 22:41:42'),
(6, 6, 96, 'Kompeten', 'passed', '2025-11-02 22:45:12', '2025-11-02 22:45:25'),
(7, 7, 99, 'Keren', 'passed', '2025-11-02 22:49:26', '2025-11-02 22:49:39'),
(8, 8, 67, 'Tidak kompeten', 'failed', '2025-11-02 23:00:43', '2025-11-02 23:01:08'),
(9, 9, 70, 'kurang kompeten, namun masih melihat personal', 'passed', '2025-11-02 23:02:58', '2025-11-02 23:03:30'),
(10, 10, 70, 'motivasi tidak niat', 'pending', '2025-11-02 23:05:31', '2025-11-02 23:09:02');

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
('gNqQ8vF63H8GaFdzphuRsrEuoeHWYi7JydQAAJ4K', 1, '182.253.243.80', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibFg2QkhiNFRGcEpmSEtHMjE1UXNKYkZ4d1NYc2tuYnIzVEhud09MViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vc2ltbWFnYW5nLndlYi5pZC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1762150364),
('GoxwLa3vBO83em0Hhi8c91qN3RYWDiKd787kuCxv', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQkdpMmJNQmNaU01PM09OYUxLMXhoQmdnc1lWaTJOQ2gza1ZIQVZjUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdHVkZW50L2Rhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE2O30=', 1762146717),
('OHnHfbECdaf5hSU0G5ZbbW7cm49K1deXewFr8Kv1', 14, '182.253.243.80', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRFZnejRrWHA2ekNncnRMVnBGSlBOQWlrYlB2bnJPbkppT0JRaktodCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjE6e2k6MDtzOjc6InN1Y2Nlc3MiO319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vc2ltbWFnYW5nLndlYi5pZC9sb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE0O3M6Nzoic3VjY2VzcyI7czozOToiTG9naW4gYmVyaGFzaWwhIFNlbGFtYXQgZGF0YW5nIGtlbWJhbGkuIjt9', 1762148202),
('q0XGTomAhB5kylKsR4jAP0f7aBT5qW6mxV1KpznT', NULL, '182.2.7.113', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjV6RU9HSnpoeFZxZ1RaRzU2clFmT3RMenRtZ0NpVENYSGdqd0h5VyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vc2ltbWFnYW5nLndlYi5pZC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1762150744),
('Wc6q9K5KlMLaj0hJbp06BSLCIxx7gl3SvPaIqdz4', 7, '182.253.243.80', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic1VkVTFDaDA5U2tJR2hrMjlSRVh0bzZYTXFwN1o0N1h6RzFYdmJTQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vc2ltbWFnYW5nLndlYi5pZC9zdHVkZW50L2FwcGxpY2F0aW9ucyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7fQ==', 1762150433);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','admin') NOT NULL DEFAULT 'student',
  `school_name` varchar(255) DEFAULT NULL,
  `major` varchar(255) DEFAULT NULL,
  `education_level` enum('SMK','Universitas') DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `school_name`, `major`, `education_level`, `phone`, `address`, `profile_photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Andi Pratama', 'admin@example.com', '2025-11-02 22:10:49', '$2y$12$ACoB.JxZbgZvhFRCIo49h.nm1P9GNeOh3gRVdbPz02jpwoAQJq2z.', 'admin', NULL, NULL, NULL, '081234567890', 'Jakarta Selatan, DKI Jakarta', 'profiles/andi.jpg', 'S3fIFhyloXHQZCnFyW64wG4pAt7EqNDVecz0QB72VyFdZj8GyP7auBX7j8qf', '2025-11-02 22:10:49', '2025-11-02 22:10:49'),
(2, 'Rina Kartika', 'admin1@example.com', '2025-11-02 22:10:49', '$2y$12$F9l4REZxddX4iUmCNqnEi.8KAF3RcDVpB7mSpDBIQc2Qun53hvAj6', 'admin', NULL, NULL, NULL, '081298765432', 'Bandung, Jawa Barat', 'profiles/rina.jpg', 'tzTNHgGki5', '2025-11-02 22:10:49', '2025-11-02 22:10:49'),
(3, 'Budi Santoso', 'student1@example.com', '2025-11-02 22:10:49', '$2y$12$ROtNWKh2LWoTb8iK.piBFOjK6ZQXbAPJKYW/rlkW6MF9pEuqhW0RW', 'student', 'SMK Negeri 1 Jakarta', 'Teknik Komputer dan Jaringan', 'SMK', '081345678901', 'Jakarta Timur, DKI Jakarta', 'profiles/budi.jpg', 'O7ywFyjggwsqK3f5wVC0UdCjv609k7xzihTQ1v4m00qPuRgW0H7TO7G4p7zp', '2025-11-02 22:10:49', '2025-11-02 22:10:49'),
(4, 'Siti Aisyah', 'student2@example.com', '2025-11-02 22:10:49', '$2y$12$VzqyWoBOO2HetMIp0xi9fOp9Rd1LNGpUSmhz./GwJxsUtf/B5Ynri', 'student', 'Universitas Indonesia', 'Psikologi', 'Universitas', '081312345678', 'Depok, Jawa Barat', 'profiles/siti.jpg', 'UMDAVuccb4', '2025-11-02 22:10:49', '2025-11-02 22:10:49'),
(5, 'Rizky Hidayat', 'student3@example.com', '2025-11-02 22:10:50', '$2y$12$sEgNKstfd4BQbAUXZVNCKO7t/OmcBoXMD8HqxcxY.aKYcY8JZl/XW', 'student', 'SMK Telkom Malang', 'Rekayasa Perangkat Lunak', 'SMK', '081276543210', 'Malang, Jawa Timur', 'profiles/rizky.jpg', 'nHg2Ukfv8z', '2025-11-02 22:10:50', '2025-11-02 22:10:50'),
(6, 'Dewi Lestari', 'student4@example.com', '2025-11-02 22:10:50', '$2y$12$zJeGWVN8gfEGBVyNcN32Gu4lH3CS2FI6mjsivgtquUyWGuEd/WIiW', 'student', 'Universitas Gadjah Mada', 'Akuntansi', 'Universitas', '081223456789', 'Yogyakarta', 'profiles/dewi.jpg', 'iko3OfDXJN', '2025-11-02 22:10:50', '2025-11-02 22:10:50'),
(7, 'Agus Saputra', 'student5@example.com', '2025-11-02 22:10:50', '$2y$12$F4j7cvpSGG7uVK/1Vl4MRu1yHbuO8PGetlCSB62NLqk5wpZTkicWe', 'student', 'SMK Negeri 2 Surabaya', 'Teknik Elektronika Industri', 'SMK', '081365432187', 'Surabaya, Jawa Timur', 'profiles/agus.jpg', 'EEwEjut1eABROJH4NoxvVanSNMdHs35G506D5VXWTj9kOqFZ5ONbWcGCY9J7', '2025-11-02 22:10:50', '2025-11-02 22:10:50'),
(8, 'Maya Sari', 'student6@example.com', '2025-11-02 22:10:50', '$2y$12$7Z.zxLE1qv9/bIXTEdJfFu1qTKZnJ0OZgO3NTq6puS0IwnAPOoNn2', 'student', 'Universitas Airlangga', 'Kedokteran', 'Universitas', '081345671234', 'Surabaya, Jawa Timur', 'profiles/maya.jpg', 'P7gn8RZDFy6DAELVUgS35vxBSqsQqTUVze87PiCGE6lKjyJgMasTbPw2vUaT', '2025-11-02 22:10:50', '2025-11-02 22:10:50'),
(9, 'Hendra Wijaya', 'student7@example.com', '2025-11-02 22:10:50', '$2y$12$R5mJWTZqD02jgWLJxAHMG.XLEZLrD0PZAA8Vvw/hgz.W09IquWEWW', 'student', 'SMK Negeri 5 Bandung', 'Teknik Otomotif', 'SMK', '081278945612', 'Bandung, Jawa Barat', 'profiles/hendra.jpg', 'LF1latqWSExgZs1aQ7OklquLNNzjceqe9eCUgSsqEfV64ixlGFb5IbkvGU86', '2025-11-02 22:10:50', '2025-11-02 22:10:50'),
(10, 'Clara Wijayanti', 'student8@example.com', '2025-11-02 22:10:51', '$2y$12$54a1mXJXUUq8EmKqqf9iXOUpNM4C1Hbb8sUkp3pEsC9Go5iINuKR2', 'student', 'Universitas Brawijaya', 'Teknik Informatika', 'Universitas', '081278934561', 'Malang, Jawa Timur', 'profiles/clara.jpg', 'YZvezasdWNuZcPdDi5efnuFvfHW6P4qNbsnlqiw1kNCuWiQ0lhnxwj2cJHsJ', '2025-11-02 22:10:51', '2025-11-02 22:10:51'),
(11, 'Rahmat Fauzi', 'student9@example.com', '2025-11-02 22:10:51', '$2y$12$VrL8dBDOLzFsRvodXc9ba.iisQq7ptRNhOPVmgMHdhVlSg1WP.gFe', 'student', 'SMK Negeri 3 Medan', 'Teknik Kendaraan Ringan', 'SMK', '081287654321', 'Medan, Sumatera Utara', 'profiles/rahmat.jpg', 'Ab85NT8O4BqzmEUBcLqL2vCF4tWdJlSMaGGdbg1MNvrPj0BuE2L7N0Vs4jYo', '2025-11-02 22:10:51', '2025-11-02 22:10:51'),
(12, 'Nina Aprilia', 'student10@example.com', '2025-11-02 22:10:51', '$2y$12$8DyNsRNnDKaCDWY9u6uuveBCz/XhynRXvfQ0gZzWX8oNP2yAHhFay', 'student', 'Universitas Padjadjaran', 'Ilmu Komunikasi', 'Universitas', '081398765412', 'Sumedang, Jawa Barat', 'profiles/nina.jpg', 'k90DUKit4FHj1aJInBNQq2bwVxrDPpXeBAwr8uwo2xeaB7lYPcQ3pRwdJwDA', '2025-11-02 22:10:51', '2025-11-02 22:10:51'),
(13, 'Doni Prakoso', 'student11@example.com', '2025-11-02 22:10:51', '$2y$12$gQ2Wp9DECU4r6oPdYg.cJ.9s1jZxC7TsQArIQFi/9zfeBpJTJpB82', 'student', 'SMK Negeri 4 Yogyakarta', 'Multimedia', 'SMK', '081234567812', 'Yogyakarta', 'profiles/doni.jpg', 'Xwk0NcY5R1KWggGAfo69vC751KbuedcooCXpyHm25Cil79aPnD8D3BUoxS3F', '2025-11-02 22:10:51', '2025-11-02 22:10:51'),
(14, 'Lina Marlina', 'student12@example.com', '2025-11-02 22:10:51', '$2y$12$9sRwSuuuh4FUg2jRt1/tn.NTxi0G1nVtF63KeacCINMHjZeQMFSAW', 'student', 'Universitas Sebelas Maret', 'Sastra Inggris', 'Universitas', '081399887766', 'Solo, Jawa Tengah', 'profiles/lina.jpg', '1MQsG2y7Om2eg4o6E0AcpSmnFRPnxm6fUrhJmU1uMG30QgwbP3cUD29l9nXi', '2025-11-02 22:10:51', '2025-11-02 22:10:51'),
(15, 'Taufik Rahman', 'student13@example.com', '2025-11-02 22:10:52', '$2y$12$ZJUZtZFIWaqlMQwO/C9FR.NJZ045hX7KWDTj/du65xYH2IZNnd5lm', 'student', 'SMK Negeri 6 Semarang', 'Desain Komunikasi Visual', 'SMK', '081245671234', 'Semarang, Jawa Tengah', 'profiles/taufik.jpg', 'R9cUldr31Ixix63HyZxtsPKC9LkkkpvlbHwt8DNsuya94cspkxvOTt29XI7X', '2025-11-02 22:10:52', '2025-11-02 22:10:52'),
(16, 'Putri Anggraini', 'student14@example.com', '2025-11-02 22:10:52', '$2y$12$VB9.5Wm4s6ANnI97dB/RG.tNaJmM1wYG9IWRT39Zxt/TUnIO1xaka', 'student', 'Universitas Diponegoro', 'Hukum', 'Universitas', '081378945612', 'Semarang, Jawa Tengah', 'profiles/putri.jpg', 'ZvVXJ7XGuMCOqkOROpN0amO5SpD8R1E4vrMnDwRktXqO9czQApddkegFiDjE', '2025-11-02 22:10:52', '2025-11-02 22:10:52');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_reports`
--
ALTER TABLE `final_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `interviews`
--
ALTER TABLE `interviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `selections`
--
ALTER TABLE `selections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
