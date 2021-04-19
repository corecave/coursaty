-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2021 at 04:27 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.2.34-18+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courses`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `rating` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `hours` int(11) NOT NULL DEFAULT '0',
  `level` enum('beginner','immediate','high') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'beginner',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2021_04_15_104109_create_courses_table', 2),
(10, '2021_04_15_104128_create_categories_table', 2),
(11, '2032_04_15_104636_create_foreign_keys', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','normal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nady Shalaby', 'admin@gmail.com', 'admin', NULL, '$2y$10$AcjJhhyuY46Ev83zs.4.G.PuqBZm0b7VhvsmNbo2dpmulr0QjRXJW', '2a5AYR4Um3A2cR7FeBxHV6cNyyw73Jgkuf8BHxTAaMi96bYgDkm6Oelry04X', '2021-04-15 10:22:35', '2021-04-17 10:49:37'),
(5, 'Miss Hailie Murray MD', 'towne.axel@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7c0An2vURw', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(6, 'Mark Luettgen', 'mlynch@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ljpG87CU02', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(7, 'Brandi Hane', 'marlee50@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FWY2r07BE3', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(8, 'Noelia Lind', 'gilbert84@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zioNHmtNtv', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(9, 'Kieran Huels I', 'grady.armani@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'oNacxIR1da', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(10, 'Meda Bernier', 'dagmar34@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ngY1RzHtFp', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(11, 'Chelsey Funk', 'lavern.brakus@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'LRklutZUtz', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(12, 'Florence Kulas', 'rolfson.rickie@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qoq50bU3ql', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(13, 'Damien Mayert', 'kaia.durgan@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'iH9yeCO7Sq', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(14, 'Tanner Blanda', 'susan76@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gEde4Gv849', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(15, 'Stefan Haley', 'blaise.klocko@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ITmaems18T', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(16, 'Prof. Casper Harris', 'winston24@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BQv4nVBDz9', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(17, 'Ardella Sporer', 'wdach@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'acamLrLUpt', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(18, 'Aglae Okuneva', 'orobel@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pgA2mLan5g', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(19, 'Miss Lysanne Torp', 'boyer.daren@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XPyavlHAn1', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(20, 'Daija Morissette', 'frami.melody@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'uUVDoiugq3', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(21, 'Gunner Osinski', 'ebeahan@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Z6EGrAVziG', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(22, 'Rowena Moen', 'emerald.fadel@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'NOz1T6tq38', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(23, 'Jon Spinka', 'susie00@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pW1b8KiFri', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(24, 'Otis Vandervort', 'oconnell.estrella@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dd2C2cU2CZ', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(25, 'Mrs. Lysanne Marquardt', 'aaron75@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6W7u1IAQa2', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(26, 'Adelbert Kulas', 'janiya30@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'lggeU4407n', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(27, 'Maiya Thompson', 'cydney.prosacco@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Xn16lfP742', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(28, 'Ignacio Schmeler III', 'bradtke.georgiana@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'C9wZYM16ch', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(29, 'Fidel West', 'zbosco@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'YUaYH8TDHI', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(30, 'Donna Waters', 'kathlyn.robel@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qiD0rRO9NL', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(31, 'Shanny Luettgen', 'jermaine.zieme@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'H6T3mBrzXw', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(32, 'Gwendolyn Treutel', 'zackery82@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ntzGAOlilR', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(33, 'Patrick Stroman', 'lfahey@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ORPOA2Du4V', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(34, 'Nicholaus Schmeler Sr.', 'velda.abshire@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2cME26e0Zb', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(35, 'Brody Zulauf DVM', 'tbrekke@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1OWvOrvRxT', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(36, 'Zoe Marvin', 'cruickshank.ahmad@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'i3NJgEBePq', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(37, 'Omer Gorczany', 'brakus.terrell@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'k3NI25omNd', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(38, 'Jason Kulas', 'vjohnson@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7cNOhaz6Cn', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(39, 'Mr. Sidney Kassulke', 'lang.norris@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pHkvAAFH9N', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(40, 'Milo Torp', 'patience.labadie@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8H5SEpZNWI', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(41, 'Ms. Clarabelle Lind', 'berniece.sipes@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'MjavlF5UsQ', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(42, 'Myles Pfeffer', 'lchamplin@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IDy2CpK0VG', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(43, 'Alexandro Hermann', 'amalia.kilback@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hfhURoQEtz', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(44, 'Donald Carter', 'milan.bartell@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fKbWgpngcS', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(45, 'Kenya Beer', 'myrna.boehm@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '42uheKzyyg', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(46, 'Branson Murazik DVM', 'kilback.delphine@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Y0PVxKkOoX', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(47, 'Asa Ward', 'gaylord.maribel@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dZSbcKVRZo', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(48, 'Mrs. Arlie Collier V', 'blanche.ernser@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tQ57yVOVBZ', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(49, 'Audreanne Keeling', 'wintheiser.lafayette@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FfqixVjSeo', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(50, 'Kelton McClure', 'hwuckert@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'RIVKInHReG', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(51, 'Mrs. Eudora Schroeder', 'ruth.koss@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FBX0O2dIAF', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(52, 'Miss Elyssa Zieme', 'ora.reilly@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DyVt4d1I8J', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(53, 'Harmon Macejkovic', 'braun.jonathon@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'RiFnQ7ezut', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(54, 'Samir Christiansen', 'normal@gmail.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'GYWqjmfkvZn9Ejkafpm7hGsLiVHZ8fpI9xAIMXYXqvHaGTQ1kPdibjRyht8L', '2021-04-17 06:06:52', '2021-04-17 10:45:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_category_id_foreign` (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
