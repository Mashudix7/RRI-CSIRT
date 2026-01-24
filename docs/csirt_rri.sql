-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2026 at 04:31 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csirt_rri`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int UNSIGNED NOT NULL,
  `key` varchar(64) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `key`, `client_name`, `is_active`, `created_at`) VALUES
(1, 'CSIRT-LIVE-KEY-12345', 'Default SIEM Connector', 1, '2026-01-22 05:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT 'Informasi',
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `excerpt` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `author_id` int DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'draft',
  `views` int DEFAULT '0',
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `category`, `slug`, `content`, `excerpt`, `thumbnail`, `author_id`, `status`, `views`, `published_at`, `created_at`, `updated_at`) VALUES
(10, 'qqqqqqqq', 'Berita', 'qqqqqqqq', 'qqqqqqqqqqqqqqqqq', 'qqqqqqqqqqqqqqqqq', 'assets/uploads/572899538_17875011393434796_3416572539650883626_n5.jpg', 3, 'published', 0, '2026-01-24 10:29:26', '2026-01-24 03:13:55', '2026-01-24 03:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `request_method` varchar(10) DEFAULT NULL,
  `request_uri` varchar(255) DEFAULT NULL,
  `module` varchar(50) NOT NULL,
  `details` text,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `response_code` int DEFAULT NULL,
  `execution_time` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `request_method`, `request_uri`, `module`, `details`, `ip_address`, `user_agent`, `response_code`, `execution_time`, `created_at`) VALUES
(1, 3, 'update_article', NULL, NULL, 'article', 'Updated article ID: 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 02:29:13'),
(2, 3, 'delete_article', NULL, NULL, 'article', 'Deleted article: Bahlul', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 02:30:26'),
(3, 3, 'create_article', NULL, NULL, 'article', 'Created article: Pak Pulici', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 02:33:20'),
(4, 3, 'update_article', NULL, NULL, 'audit', 'Updated article ID: 5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 03:04:53'),
(5, 3, 'update_team', NULL, NULL, 'team', 'Updated team member ID: 18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 03:07:17'),
(6, 3, 'update_network', NULL, NULL, 'network', 'Updated network ID: 1', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 03:23:19'),
(7, 3, 'create_team', NULL, NULL, 'team', 'Added team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 03:44:34'),
(8, 3, 'create_team', NULL, NULL, 'team', 'Added team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 03:44:54'),
(9, 3, 'create_team', NULL, NULL, 'team', 'Added team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 03:45:09'),
(10, 3, 'create_team', NULL, NULL, 'team', 'Added team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 03:45:17'),
(11, 3, 'create_team', NULL, NULL, 'team', 'Added team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 03:45:28'),
(12, 3, 'create_team', NULL, NULL, 'team', 'Added team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 03:45:40'),
(13, 3, 'create_team', NULL, NULL, 'team', 'Added team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 03:45:52'),
(14, 3, 'create_team', NULL, NULL, 'team', 'Added team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 03:46:05'),
(15, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 04:19:27'),
(16, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 04:43:52'),
(18, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 06:15:18'),
(19, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 06:16:29'),
(20, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 06:44:55'),
(21, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 12:45:24'),
(22, 3, 'update_article', NULL, NULL, 'article', 'Updated article ID: 5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 13:03:11'),
(23, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 13:41:53'),
(24, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 13:42:57'),
(25, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 15:25:32'),
(26, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 17:23:35'),
(27, 3, 'update_ip', NULL, NULL, 'ip', 'Updated IP: 218.33.123.128 (active)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 17:26:47'),
(28, 3, 'update_ip', NULL, NULL, 'ip', 'Updated IP: 218.33.123.128 (inactive)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 17:27:00'),
(29, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 17:33:37'),
(30, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 17:56:30'),
(31, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 17:56:56'),
(32, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 17:57:49'),
(33, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 17:57:53'),
(34, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 17:57:57'),
(35, 3, 'create_article', NULL, NULL, 'article', 'Created article: Pak pulici maem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 17:59:01'),
(36, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 17:59:42'),
(37, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:01:29'),
(38, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:01:45'),
(39, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:03:09'),
(40, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:03:16'),
(41, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:03:21'),
(42, 3, 'update_article', NULL, NULL, 'article', 'Updated article ID: 6', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:03:32'),
(43, 3, 'delete_article', NULL, NULL, 'article', 'Deleted article: Pak pulici', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:03:35'),
(44, 3, 'delete_article', NULL, NULL, 'article', 'Deleted article: Pak Pulicii', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:03:38'),
(45, 3, 'update_user', NULL, NULL, 'user', 'Updated user ID: 3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:04:44'),
(46, 3, 'update_user', NULL, NULL, 'user', 'Updated user ID: 3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:04:48'),
(47, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:04:54'),
(48, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:19:04'),
(49, 3, 'create_article', NULL, NULL, 'article', 'Created article: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:19:40'),
(50, 3, 'update_article', NULL, NULL, 'article', 'Updated article ID: 7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:22:23'),
(51, 3, 'delete_article', NULL, NULL, 'article', 'Deleted article: Test Laporan Article 1769192776', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:40:35'),
(52, 3, 'update_team', NULL, NULL, 'team', 'Updated team member ID: 23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:46:54'),
(53, 3, 'update_article', NULL, NULL, 'article', 'Updated article ID: 7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:48:02'),
(54, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:53:55'),
(55, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:54:01'),
(56, 3, 'create_article', NULL, NULL, 'article', 'Created article: Test', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:54:34'),
(57, 3, 'delete_team', NULL, NULL, 'team', 'Deleted team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:54:40'),
(58, 3, 'create_team', NULL, NULL, 'team', 'Added team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:55:10'),
(59, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:55:33'),
(60, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 18:56:43'),
(61, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 19:08:38'),
(62, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 19:08:44'),
(63, 3, 'delete_article', NULL, NULL, 'article', 'Deleted article: Tes', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 19:08:48'),
(64, 3, 'update_article', NULL, NULL, 'article', 'Updated article ID: 9', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 19:08:55'),
(65, 3, 'delete_team', NULL, NULL, 'team', 'Deleted team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 19:09:00'),
(66, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 19:11:55'),
(67, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 19:12:36'),
(68, 3, 'update_article', NULL, NULL, 'article', 'Updated article ID: 9', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 19:13:03'),
(69, 3, 'delete_article', NULL, NULL, 'article', 'Deleted article: Cekcscs', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 19:13:06'),
(70, 3, 'update_team', NULL, NULL, 'team', 'Updated team member ID: 23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 19:13:12'),
(71, 3, 'update_user', NULL, NULL, 'user', 'Updated user ID: 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-23 19:14:04'),
(73, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 02:58:50'),
(74, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:11:58'),
(75, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:13:41'),
(76, 3, 'create_article', NULL, NULL, 'article', 'Created article: qqqqqqqqqqqqqqqq', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:13:55'),
(77, 3, 'update_article', NULL, NULL, 'article', 'Updated article ID: 10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:19:32'),
(78, 3, 'update_article', NULL, NULL, 'article', 'Updated article ID: 10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:19:47'),
(79, 3, 'delete_team', NULL, NULL, 'team', 'Deleted team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:24:42'),
(80, 3, 'delete_team', NULL, NULL, 'team', 'Deleted team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:24:45'),
(81, 3, 'delete_team', NULL, NULL, 'team', 'Deleted team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:24:47'),
(82, 3, 'delete_team', NULL, NULL, 'team', 'Deleted team member: Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:24:53'),
(83, 3, 'update_article', NULL, NULL, 'article', 'Updated article ID: 10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:29:26'),
(84, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:34:38'),
(85, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:34:46'),
(86, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:34:51'),
(87, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:35:04'),
(88, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:39:42'),
(89, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:40:01'),
(90, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:40:06'),
(91, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:40:27'),
(92, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:41:27'),
(93, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:41:35'),
(94, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:42:35'),
(95, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:42:42'),
(96, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:42:42'),
(97, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:46:47'),
(98, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:46:51'),
(99, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:48:55'),
(100, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:49:00'),
(101, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:54:03'),
(102, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 03:54:12'),
(103, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:02:32'),
(104, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:02:38'),
(105, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:05:40'),
(106, 5, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:05:52'),
(107, 5, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:06:35'),
(109, 5, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:06:50'),
(110, 5, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:08:12'),
(111, 4, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:08:23'),
(112, 4, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:17:26'),
(113, 3, 'login', NULL, NULL, 'system', 'User logged in successfully', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:17:32'),
(114, 3, 'update_network', NULL, NULL, 'network', 'Updated network ID: 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:26:14'),
(115, 3, 'update_network', NULL, NULL, 'network', 'Updated network ID: 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:26:29'),
(116, 3, 'update_user', NULL, NULL, 'user', 'Updated user ID: 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:31:17'),
(117, 3, 'logout', NULL, NULL, 'system', 'User logged out', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', NULL, NULL, '2026-01-24 04:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('f0rsvi98toknjd22c9khk6b1b83rhnqj', '::1', 1769188600, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393138383539353b),
('h6bbgrq19o0911rnu299a9oos2u6t2kn', '::1', 1769058071, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393035383037313b),
('ktrkj6tgpmk8lnk2nr4tcori8mf8ahkt', '::1', 1769058070, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393035383037303b),
('m4pu8lq2hvo5v7dr9b5kmp482p5e0tpc', '::1', 1769058679, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393035383436333b),
('pibmtel5jg4l1op7lhc7fqcmvusj68iq', '::1', 1769188930, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393138383932343b),
('prho8rfrqk0aeur8ke5chp7chgo1vr62', '::1', 1769195666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393139353535363b757365725f69647c733a313a2233223b757365726e616d657c733a373a224d617368756469223b726f6c657c733a353a2261646d696e223b726f6c655f6e616d657c733a353a2241646d696e223b6c6f676765645f696e7c623a313b6c6f67696e5f74696d657c693a313736393139353535363b6c6173745f61637469766974797c693a313736393139353535363b6c6f67696e5f69707c733a333a223a3a31223b6176617461727c733a32313a226176617461725f313736393131303038312e6a7067223b),
('tfe90an6247h51j6vqpal6vk41t7jmgj', '::1', 1769226162, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393232363136323b757365725f69647c733a313a2233223b757365726e616d657c733a373a224d617368756469223b726f6c657c733a353a2261646d696e223b726f6c655f6e616d657c733a353a2241646d696e223b6c6f676765645f696e7c623a313b6c6f67696e5f74696d657c693a313736393232363136323b6c6173745f61637469766974797c693a313736393232363136323b6c6f67696e5f69707c733a333a223a3a31223b6176617461727c733a32313a226176617461725f313736393131303038312e6a7067223b746f6173745f737563636573737c733a33393a224c6f67696e20626572686173696c212053656c616d617420646174616e672c204d617368756469223b5f5f63695f766172737c613a313a7b733a31333a22746f6173745f73756363657373223b733a333a226e6577223b7d),
('thcmjt58636dt5oo2dbqab57oo3l85qs', '::1', 1769058462, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393035383436323b),
('uhrarkmaa489bj1dgg1o7pdei35ckr5d', '::1', 1769229086, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393232393038353b),
('umqdf1halq1dvej8sevlu9bip4865oec', '::1', 1769058070, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393035383037303b);

-- --------------------------------------------------------

--
-- Table structure for table `evidence`
--

CREATE TABLE `evidence` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `case_ref_no` varchar(100) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `file_size` int UNSIGNED NOT NULL,
  `file_hash` varchar(64) NOT NULL,
  `uploaded_by` int NOT NULL,
  `notes` text,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `severity` enum('critical','high','medium','low') NOT NULL,
  `status` enum('reported','validated','in_progress','mitigated','recovered','closed') DEFAULT 'reported',
  `affected_systems` text,
  `initial_assessment` text,
  `reporter_id` int DEFAULT NULL,
  `assignee_id` int DEFAULT NULL,
  `detection_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incident_attachments`
--

CREATE TABLE `incident_attachments` (
  `id` int NOT NULL,
  `incident_id` int NOT NULL,
  `filename` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_size` int DEFAULT NULL,
  `uploaded_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incident_notes`
--

CREATE TABLE `incident_notes` (
  `id` int NOT NULL,
  `incident_id` int NOT NULL,
  `user_id` int NOT NULL,
  `note` text NOT NULL,
  `type` enum('comment','activity','system') DEFAULT 'comment',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ip_addresses`
--

CREATE TABLE `ip_addresses` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `type` enum('public','private','local','vpn','gateway') NOT NULL DEFAULT 'public',
  `region` varchar(100) DEFAULT NULL,
  `description` text,
  `status` enum('active','inactive') DEFAULT 'active',
  `usage_status` enum('in_use','available') DEFAULT 'available',
  `app_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `network_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ip_addresses`
--

INSERT INTO `ip_addresses` (`id`, `name`, `ip_address`, `type`, `region`, `description`, `status`, `usage_status`, `app_name`, `created_at`, `updated_at`, `network_id`) VALUES
(1, '', '218.33.123.1', 'gateway', NULL, 'Gateway1', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 12:17:11', 1),
(2, '', '218.33.123.2', 'public', NULL, 'Internet DNS Server Lokal1', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 12:17:17', 1),
(3, '', '218.33.123.3', 'public', NULL, 'Internet Aplikasi NextCloud', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(4, '', '218.33.123.4', 'public', NULL, 'Aplikasi AudioLibrary', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(5, '', '218.33.123.5', 'public', NULL, 'Internet PPID RRI', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(6, '', '218.33.123.6', 'public', NULL, 'Aplikasi Simpatik (PT. Novarya)', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(7, '', '218.33.123.7', 'public', NULL, 'Aplikasi Drive Cloud', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(8, '', '218.33.123.8', 'public', NULL, 'WAF-Jakarta', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(9, '', '218.33.123.9', 'public', NULL, 'Pro 1 Streaming', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(10, '', '218.33.123.10', 'public', NULL, 'Pro 2 Streaming', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(11, '', '218.33.123.11', 'public', NULL, 'Pro 4 Streaming', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(12, '', '218.33.123.12', 'public', NULL, 'Streaming Sentral', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(13, '', '218.33.123.13', 'public', NULL, 'Aplikasi Logger NEW', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(14, '', '218.33.123.14', 'public', NULL, 'GL Audio Streaming', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(15, '', '218.33.123.15', 'public', NULL, 'SIP Server Lama', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(16, '', '218.33.123.16', 'public', NULL, 'Zabbix All NMS', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(17, '', '218.33.123.17', 'public', NULL, 'Aplikasi Meeting TMB', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(18, '', '218.33.123.18', 'public', NULL, 'Aplikasi Video GL', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(19, '', '218.33.123.19', 'public', NULL, 'Omada Controller', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(20, '', '218.33.123.20', 'public', NULL, 'Aplikasi Sisporja NEW', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(21, '', '218.33.123.21', 'public', NULL, 'Unify Controller Pusat', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(22, '', '218.33.123.22', 'public', NULL, 'DC JKT Cloud Proxmox VE', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(23, '', '218.33.123.23', 'public', NULL, 'Aplikasi DAP & MEDIA', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(24, '', '218.33.123.24', 'public', NULL, 'Intranet JKT', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(25, '', '218.33.123.25', 'public', NULL, 'Aplikasi Supporting Server', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(26, '', '218.33.123.26', 'public', NULL, 'IP PUBLIK NEW PRO 1', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(27, '', '218.33.123.27', 'public', NULL, 'IP PUBLIK NEW PRO 2', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(28, '', '218.33.123.28', 'public', NULL, 'IP PUBLIK NEW PRO 4', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(29, '', '218.33.123.29', 'public', NULL, 'Global Media Academy', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(30, '', '218.33.123.30', 'public', NULL, 'Aplikasi Presensi Mobile API Node JS', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(31, '', '218.33.123.31', 'public', NULL, 'Aplikasi PNBP NEW', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(32, '', '218.33.123.32', 'public', NULL, 'Aplikasi PNet Lab', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(33, '', '218.33.123.33', 'public', NULL, 'IoT Siaga', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(34, '', '218.33.123.34', 'public', NULL, 'IP Extend Portal Berita RRI', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(35, '', '218.33.123.35', 'public', NULL, 'IP Private-Streaming Video', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(36, '', '218.33.123.36', 'public', NULL, 'Aplikasi Mail Corporate (rri.co.id)', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(37, '', '218.33.123.37', 'public', NULL, 'Aplikasi Mail Gateway Corporate (rri.co.id)', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(38, '', '218.33.123.38', 'public', NULL, 'Aplikasi E-Learning MBC', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(39, '', '218.33.123.39', 'public', NULL, 'Aplikasi WAZUH SOC', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(40, '', '218.33.123.40', 'public', NULL, 'DevOps', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(41, '', '218.33.123.41', 'public', NULL, 'RRI Digital 1', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(42, '', '218.33.123.42', 'public', NULL, 'RRI Digital 2', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(43, '', '218.33.123.43', 'public', NULL, 'RRI Digital 3', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(44, '', '218.33.123.44', 'public', NULL, 'S3 RRI Digital', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(45, '', '218.33.123.45', 'public', NULL, 'NextCloud Collabora', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(46, '', '218.33.123.46', 'public', NULL, 'Docker Swarm', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(47, '', '218.33.123.47', 'public', NULL, 'My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(48, '', '218.33.123.48', 'public', NULL, 'LB My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(49, '', '218.33.123.49', 'public', NULL, 'MinIO My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(50, '', '218.33.123.50', 'public', NULL, 'JDIH Nginx', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(51, '', '218.33.123.51', 'public', NULL, 'Codec Backup', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(52, '', '218.33.123.52', 'public', NULL, 'H3C', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(53, '', '218.33.123.53', 'public', NULL, 'Aplikasi DIAS', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(54, '', '218.33.123.54', 'public', NULL, 'IP Router Firewall DC Jakarta', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(55, '', '218.33.123.56', 'public', NULL, 'TrueNas', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(56, '', '218.33.123.57', 'public', NULL, 'internet Gedung Sebelah (sebelumnya digunakan LPU)', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(57, '', '218.33.123.58', 'public', NULL, 'CMS Portal', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(58, '', '218.33.123.59', 'public', NULL, 'Front Portal', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(59, '', '218.33.123.60', 'public', NULL, 'Server API Portal', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 1),
(60, '', '218.33.123.65', 'gateway', NULL, 'Gateway', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 2),
(61, '', '218.33.123.66', 'public', NULL, 'IP Router 1', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 2),
(62, '', '218.33.123.67', 'public', NULL, 'IP Router 2', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 2),
(63, '', '218.33.123.68', 'public', NULL, 'IP Server', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 2),
(64, '', '218.33.123.69', 'public', NULL, 'IP API Portal', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 2),
(65, '', '218.33.123.70', 'public', NULL, 'IP CMS Portal', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 2),
(66, '', '218.33.123.71', 'public', NULL, 'IP Frontend Portal', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 2),
(67, '', '218.33.123.72', 'public', NULL, 'IP Pro 1 Streaming', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 2),
(68, '', '218.33.123.73', 'public', NULL, 'IP Pro 2 Streaming', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 2),
(69, '', '218.33.123.74', 'public', NULL, 'IP Pro 4 Streaming', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 2),
(70, '', '218.33.123.75', 'public', NULL, 'IP WAF DC PDN Serpong', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 2),
(71, '', '218.33.123.76', 'public', NULL, 'IP S3 Portal', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 2),
(72, '', '218.33.123.129', 'gateway', NULL, 'Gateway', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 3),
(73, '', '218.33.123.130', 'public', NULL, 'IP Firewall Kantor Pusat', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 3),
(74, '', '218.33.123.131', 'public', NULL, 'IP Router Kantor Pusat', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 3),
(75, '', '218.33.123.193', 'gateway', NULL, 'Gateway', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(76, '', '218.33.123.194', 'public', NULL, 'Internet Semua Perangkat DC MBC', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(77, '', '218.33.123.195', 'public', NULL, 'Aplikasi Manajemen IP', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(78, '', '218.33.123.196', 'public', NULL, 'Aplikasi Pusdatin NEW', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(79, '', '218.33.123.197', 'public', NULL, 'Aplikasi JDIH NEW', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(80, '', '218.33.123.198', 'public', NULL, 'IP Internet Server Aplikasi E-Learning MBC', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(81, '', '218.33.123.199', 'public', NULL, 'IP Internet Server Docker MBC', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(82, '', '218.33.123.200', 'public', NULL, 'T-Track Pemancar', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(83, '', '218.33.123.201', 'public', NULL, 'IP Publik Email Corporate RRI (rri.go.id)', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(84, '', '218.33.123.202', 'public', NULL, 'Aplikasi DRM Proxy', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(85, '', '218.33.123.203', 'public', NULL, 'Aplikasi WAF MBC', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(86, '', '218.33.123.204', 'public', NULL, 'Aplikasi Jenkins Git Docker', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(87, '', '218.33.123.205', 'public', NULL, 'IP Router Core Operasional', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(88, '', '218.33.123.206', 'public', NULL, 'IP Publik-Streaming Video', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(89, '', '218.33.123.207', 'public', NULL, 'IP Aplikasi Logger NEW', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(90, '', '218.33.123.208', 'public', NULL, 'IP Aplikasi Simpatik (PT. Novarya)', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(91, '', '218.33.123.209', 'public', NULL, 'IP My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(92, '', '218.33.123.210', 'public', NULL, 'IP LB My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(93, '', '218.33.123.211', 'public', NULL, 'IP MinIO My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(94, '', '218.33.123.212', 'public', NULL, 'IP Aplikasi Presensi Mobile API Node JS', 'active', 'available', NULL, '2026-01-22 16:00:06', '2026-01-22 16:00:06', 6),
(95, '', '218.33.123.1', 'gateway', NULL, 'Gateway', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(96, '', '218.33.123.2', 'public', NULL, 'Internet DNS Server Lokal', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(97, '', '218.33.123.3', 'public', NULL, 'Internet Aplikasi NextCloud', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(98, '', '218.33.123.4', 'public', NULL, 'Aplikasi AudioLibrary', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(99, '', '218.33.123.5', 'public', NULL, 'Internet PPID RRI', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(100, '', '218.33.123.6', 'public', NULL, 'Aplikasi Simpatik (PT. Novarya)', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(101, '', '218.33.123.7', 'public', NULL, 'Aplikasi Drive Cloud', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(102, '', '218.33.123.8', 'public', NULL, 'WAF-Jakarta', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(103, '', '218.33.123.9', 'public', NULL, 'Pro 1 Streaming', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(104, '', '218.33.123.10', 'public', NULL, 'Pro 2 Streaming', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(105, '', '218.33.123.11', 'public', NULL, 'Pro 4 Streaming', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(106, '', '218.33.123.12', 'public', NULL, 'Streaming Sentral', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(107, '', '218.33.123.13', 'public', NULL, 'Aplikasi Logger NEW', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(108, '', '218.33.123.14', 'public', NULL, 'GL Audio Streaming', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(109, '', '218.33.123.15', 'public', NULL, 'SIP Server Lama', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(110, '', '218.33.123.16', 'public', NULL, 'Zabbix All NMS', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(111, '', '218.33.123.17', 'public', NULL, 'Aplikasi Meeting TMB', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(112, '', '218.33.123.18', 'public', NULL, 'Aplikasi Video GL', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(113, '', '218.33.123.19', 'public', NULL, 'Omada Controller', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(114, '', '218.33.123.20', 'public', NULL, 'Aplikasi Sisporja NEW', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(115, '', '218.33.123.21', 'public', NULL, 'Unify Controller Pusat', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(116, '', '218.33.123.22', 'public', NULL, 'DC JKT Cloud Proxmox VE', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(117, '', '218.33.123.23', 'public', NULL, 'Aplikasi DAP & MEDIA', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(118, '', '218.33.123.24', 'public', NULL, 'Intranet JKT', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(119, '', '218.33.123.25', 'public', NULL, 'Aplikasi Supporting Server', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(120, '', '218.33.123.26', 'public', NULL, 'IP PUBLIK NEW PRO 1', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(121, '', '218.33.123.27', 'public', NULL, 'IP PUBLIK NEW PRO 2', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(122, '', '218.33.123.28', 'public', NULL, 'IP PUBLIK NEW PRO 4', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(123, '', '218.33.123.29', 'public', NULL, 'Global Media Academy', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(124, '', '218.33.123.30', 'public', NULL, 'Aplikasi Presensi Mobile API Node JS', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(125, '', '218.33.123.31', 'public', NULL, 'Aplikasi PNBP NEW', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(126, '', '218.33.123.32', 'public', NULL, 'Aplikasi PNet Lab', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(127, '', '218.33.123.33', 'public', NULL, 'IoT Siaga', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(128, '', '218.33.123.34', 'public', NULL, 'IP Extend Portal Berita RRI', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(129, '', '218.33.123.35', 'public', NULL, 'IP Private-Streaming Video', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(130, '', '218.33.123.36', 'public', NULL, 'Aplikasi Mail Corporate (rri.co.id)', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(131, '', '218.33.123.37', 'public', NULL, 'Aplikasi Mail Gateway Corporate (rri.co.id)', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(132, '', '218.33.123.38', 'public', NULL, 'Aplikasi E-Learning MBC', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(133, '', '218.33.123.39', 'public', NULL, 'Aplikasi WAZUH SOC', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(134, '', '218.33.123.40', 'public', NULL, 'DevOps', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(135, '', '218.33.123.41', 'public', NULL, 'RRI Digital 1', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(136, '', '218.33.123.42', 'public', NULL, 'RRI Digital 2', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(137, '', '218.33.123.43', 'public', NULL, 'RRI Digital 3', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(138, '', '218.33.123.44', 'public', NULL, 'S3 RRI Digital', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(139, '', '218.33.123.45', 'public', NULL, 'NextCloud Collabora', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(140, '', '218.33.123.46', 'public', NULL, 'Docker Swarm', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(141, '', '218.33.123.47', 'public', NULL, 'My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(142, '', '218.33.123.48', 'public', NULL, 'LB My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(143, '', '218.33.123.49', 'public', NULL, 'MinIO My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(144, '', '218.33.123.50', 'public', NULL, 'JDIH Nginx', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(145, '', '218.33.123.51', 'public', NULL, 'Codec Backup', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(146, '', '218.33.123.52', 'public', NULL, 'H3C', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(147, '', '218.33.123.53', 'public', NULL, 'Aplikasi DIAS', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(148, '', '218.33.123.54', 'public', NULL, 'IP Router Firewall DC Jakarta', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(149, '', '218.33.123.56', 'public', NULL, 'TrueNas', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(150, '', '218.33.123.57', 'public', NULL, 'internet Gedung Sebelah (sebelumnya digunakan LPU)', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(151, '', '218.33.123.58', 'public', NULL, 'CMS Portal', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(152, '', '218.33.123.59', 'public', NULL, 'Front Portal', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(153, '', '218.33.123.60', 'public', NULL, 'Server API Portal', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 1),
(154, '', '218.33.123.65', 'gateway', NULL, 'Gateway', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 2),
(155, '', '218.33.123.66', 'public', NULL, 'IP Router 1', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 2),
(156, '', '218.33.123.67', 'public', NULL, 'IP Router 2', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 2),
(157, '', '218.33.123.68', 'public', NULL, 'IP Server', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 2),
(158, '', '218.33.123.69', 'public', NULL, 'IP API Portal', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 2),
(159, '', '218.33.123.70', 'public', NULL, 'IP CMS Portal', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 2),
(160, '', '218.33.123.71', 'public', NULL, 'IP Frontend Portal', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 2),
(161, '', '218.33.123.72', 'public', NULL, 'IP Pro 1 Streaming', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 2),
(162, '', '218.33.123.73', 'public', NULL, 'IP Pro 2 Streaming', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 2),
(163, '', '218.33.123.74', 'public', NULL, 'IP Pro 4 Streaming', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 2),
(164, '', '218.33.123.75', 'public', NULL, 'IP WAF DC PDN Serpong', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 2),
(165, '', '218.33.123.76', 'public', NULL, 'IP S3 Portal', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 2),
(166, '', '218.33.123.129', 'gateway', NULL, 'Gateway', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 3),
(167, '', '218.33.123.130', 'public', NULL, 'IP Firewall Kantor Pusat', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 3),
(168, '', '218.33.123.131', 'public', NULL, 'IP Router Kantor Pusat', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 3),
(169, '', '218.33.123.193', 'gateway', NULL, 'Gateway', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(170, '', '218.33.123.194', 'public', NULL, 'Internet Semua Perangkat DC MBC', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(171, '', '218.33.123.195', 'public', NULL, 'Aplikasi Manajemen IP', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(172, '', '218.33.123.196', 'public', NULL, 'Aplikasi Pusdatin NEW', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(173, '', '218.33.123.197', 'public', NULL, 'Aplikasi JDIH NEW', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(174, '', '218.33.123.198', 'public', NULL, 'IP Internet Server Aplikasi E-Learning MBC', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(175, '', '218.33.123.199', 'public', NULL, 'IP Internet Server Docker MBC', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(176, '', '218.33.123.200', 'public', NULL, 'T-Track Pemancar', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(177, '', '218.33.123.201', 'public', NULL, 'IP Publik Email Corporate RRI (rri.go.id)', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(178, '', '218.33.123.202', 'public', NULL, 'Aplikasi DRM Proxy', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(179, '', '218.33.123.203', 'public', NULL, 'Aplikasi WAF MBC', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(180, '', '218.33.123.204', 'public', NULL, 'Aplikasi Jenkins Git Docker', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(181, '', '218.33.123.205', 'public', NULL, 'IP Router Core Operasional', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(182, '', '218.33.123.206', 'public', NULL, 'IP Publik-Streaming Video', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(183, '', '218.33.123.207', 'public', NULL, 'IP Aplikasi Logger NEW', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(184, '', '218.33.123.208', 'public', NULL, 'IP Aplikasi Simpatik (PT. Novarya)', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(185, '', '218.33.123.209', 'public', NULL, 'IP My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(186, '', '218.33.123.210', 'public', NULL, 'IP LB My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(187, '', '218.33.123.211', 'public', NULL, 'IP MinIO My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(188, '', '218.33.123.212', 'public', NULL, 'IP Aplikasi Presensi Mobile API Node JS', 'active', 'available', NULL, '2026-01-22 16:02:08', '2026-01-22 16:02:08', 6),
(189, '', '218.33.123.1', 'gateway', NULL, 'Gateway', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(190, '', '218.33.123.2', 'public', NULL, 'Internet DNS Server Lokal', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(191, '', '218.33.123.3', 'public', NULL, 'Internet Aplikasi NextCloud', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(192, '', '218.33.123.4', 'public', NULL, 'Aplikasi AudioLibrary', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(193, '', '218.33.123.5', 'public', NULL, 'Internet PPID RRI', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(194, '', '218.33.123.6', 'public', NULL, 'Aplikasi Simpatik (PT. Novarya)', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(195, '', '218.33.123.7', 'public', NULL, 'Aplikasi Drive Cloud', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(196, '', '218.33.123.8', 'public', NULL, 'WAF-Jakarta', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(197, '', '218.33.123.9', 'public', NULL, 'Pro 1 Streaming', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(198, '', '218.33.123.10', 'public', NULL, 'Pro 2 Streaming', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(199, '', '218.33.123.11', 'public', NULL, 'Pro 4 Streaming', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(200, '', '218.33.123.12', 'public', NULL, 'Streaming Sentral', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(201, '', '218.33.123.13', 'public', NULL, 'Aplikasi Logger NEW', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(202, '', '218.33.123.14', 'public', NULL, 'GL Audio Streaming', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(203, '', '218.33.123.15', 'public', NULL, 'SIP Server Lama', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(204, '', '218.33.123.16', 'public', NULL, 'Zabbix All NMS', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(205, '', '218.33.123.17', 'public', NULL, 'Aplikasi Meeting TMB', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(206, '', '218.33.123.18', 'public', NULL, 'Aplikasi Video GL', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(207, '', '218.33.123.19', 'public', NULL, 'Omada Controller', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(208, '', '218.33.123.20', 'public', NULL, 'Aplikasi Sisporja NEW', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(209, '', '218.33.123.21', 'public', NULL, 'Unify Controller Pusat', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(210, '', '218.33.123.22', 'public', NULL, 'DC JKT Cloud Proxmox VE', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(211, '', '218.33.123.23', 'public', NULL, 'Aplikasi DAP & MEDIA', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(212, '', '218.33.123.24', 'public', NULL, 'Intranet JKT', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(213, '', '218.33.123.25', 'public', NULL, 'Aplikasi Supporting Server', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(214, '', '218.33.123.26', 'public', NULL, 'IP PUBLIK NEW PRO 1', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(215, '', '218.33.123.27', 'public', NULL, 'IP PUBLIK NEW PRO 2', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(216, '', '218.33.123.28', 'public', NULL, 'IP PUBLIK NEW PRO 4', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(217, '', '218.33.123.29', 'public', NULL, 'Global Media Academy', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(218, '', '218.33.123.30', 'public', NULL, 'Aplikasi Presensi Mobile API Node JS', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(219, '', '218.33.123.31', 'public', NULL, 'Aplikasi PNBP NEW', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(220, '', '218.33.123.32', 'public', NULL, 'Aplikasi PNet Lab', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(221, '', '218.33.123.33', 'public', NULL, 'IoT Siaga', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(222, '', '218.33.123.34', 'public', NULL, 'IP Extend Portal Berita RRI', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(223, '', '218.33.123.35', 'public', NULL, 'IP Private-Streaming Video', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(224, '', '218.33.123.36', 'public', NULL, 'Aplikasi Mail Corporate (rri.co.id)', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(225, '', '218.33.123.37', 'public', NULL, 'Aplikasi Mail Gateway Corporate (rri.co.id)', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(226, '', '218.33.123.38', 'public', NULL, 'Aplikasi E-Learning MBC', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(227, '', '218.33.123.39', 'public', NULL, 'Aplikasi WAZUH SOC', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(228, '', '218.33.123.40', 'public', NULL, 'DevOps', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(229, '', '218.33.123.41', 'public', NULL, 'RRI Digital 1', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(230, '', '218.33.123.42', 'public', NULL, 'RRI Digital 2', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(231, '', '218.33.123.43', 'public', NULL, 'RRI Digital 3', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(232, '', '218.33.123.44', 'public', NULL, 'S3 RRI Digital', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(233, '', '218.33.123.45', 'public', NULL, 'NextCloud Collabora', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(234, '', '218.33.123.46', 'public', NULL, 'Docker Swarm', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(235, '', '218.33.123.47', 'public', NULL, 'My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(236, '', '218.33.123.48', 'public', NULL, 'LB My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(237, '', '218.33.123.49', 'public', NULL, 'MinIO My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(238, '', '218.33.123.50', 'public', NULL, 'JDIH Nginx', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(239, '', '218.33.123.51', 'public', NULL, 'Codec Backup', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(240, '', '218.33.123.52', 'public', NULL, 'H3C', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(241, '', '218.33.123.53', 'public', NULL, 'Aplikasi DIAS', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(242, '', '218.33.123.54', 'public', NULL, 'IP Router Firewall DC Jakarta', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(243, '', '218.33.123.56', 'public', NULL, 'TrueNas', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(244, '', '218.33.123.57', 'public', NULL, 'internet Gedung Sebelah (sebelumnya digunakan LPU)', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(245, '', '218.33.123.58', 'public', NULL, 'CMS Portal', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(246, '', '218.33.123.59', 'public', NULL, 'Front Portal', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(247, '', '218.33.123.60', 'public', NULL, 'Server API Portal', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 1),
(248, '', '218.33.123.65', 'gateway', NULL, 'Gateway', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 2),
(249, '', '218.33.123.66', 'public', NULL, 'IP Router 1', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 2),
(250, '', '218.33.123.67', 'public', NULL, 'IP Router 2', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 2),
(251, '', '218.33.123.68', 'public', NULL, 'IP Server', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 2),
(252, '', '218.33.123.69', 'public', NULL, 'IP API Portal', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 2),
(253, '', '218.33.123.70', 'public', NULL, 'IP CMS Portal', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 2),
(254, '', '218.33.123.71', 'public', NULL, 'IP Frontend Portal', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 2),
(255, '', '218.33.123.72', 'public', NULL, 'IP Pro 1 Streaming', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 2),
(256, '', '218.33.123.73', 'public', NULL, 'IP Pro 2 Streaming', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 2),
(257, '', '218.33.123.74', 'public', NULL, 'IP Pro 4 Streaming', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 2),
(258, '', '218.33.123.75', 'public', NULL, 'IP WAF DC PDN Serpong', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 2),
(259, '', '218.33.123.76', 'public', NULL, 'IP S3 Portal', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 2),
(260, '', '218.33.123.129', 'gateway', NULL, 'Gateway', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 3),
(261, '', '218.33.123.130', 'public', NULL, 'IP Firewall Kantor Pusat', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 3),
(262, '', '218.33.123.131', 'public', NULL, 'IP Router Kantor Pusat', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 3),
(263, '', '218.33.123.193', 'gateway', NULL, 'Gateway', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(264, '', '218.33.123.194', 'public', NULL, 'Internet Semua Perangkat DC MBC', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(265, '', '218.33.123.195', 'public', NULL, 'Aplikasi Manajemen IP', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(266, '', '218.33.123.196', 'public', NULL, 'Aplikasi Pusdatin NEW', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(267, '', '218.33.123.197', 'public', NULL, 'Aplikasi JDIH NEW', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(268, '', '218.33.123.198', 'public', NULL, 'IP Internet Server Aplikasi E-Learning MBC', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(269, '', '218.33.123.199', 'public', NULL, 'IP Internet Server Docker MBC', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(270, '', '218.33.123.200', 'public', NULL, 'T-Track Pemancar', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(271, '', '218.33.123.201', 'public', NULL, 'IP Publik Email Corporate RRI (rri.go.id)', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(272, '', '218.33.123.202', 'public', NULL, 'Aplikasi DRM Proxy', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(273, '', '218.33.123.203', 'public', NULL, 'Aplikasi WAF MBC', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(274, '', '218.33.123.204', 'public', NULL, 'Aplikasi Jenkins Git Docker', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(275, '', '218.33.123.205', 'public', NULL, 'IP Router Core Operasional', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(276, '', '218.33.123.206', 'public', NULL, 'IP Publik-Streaming Video', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(277, '', '218.33.123.207', 'public', NULL, 'IP Aplikasi Logger NEW', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(278, '', '218.33.123.208', 'public', NULL, 'IP Aplikasi Simpatik (PT. Novarya)', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(279, '', '218.33.123.209', 'public', NULL, 'IP My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(280, '', '218.33.123.210', 'public', NULL, 'IP LB My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(281, '', '218.33.123.211', 'public', NULL, 'IP MinIO My-Presensi Terbaru (PT. TKM)', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(282, '', '218.33.123.212', 'public', NULL, 'IP Aplikasi Presensi Mobile API Node JS', 'active', 'available', NULL, '2026-01-22 16:02:09', '2026-01-22 16:02:09', 6),
(283, '', '218.33.123.0', 'public', NULL, '', 'inactive', 'available', NULL, '2026-01-22 12:17:05', '2026-01-22 18:24:46', 1),
(284, '', '218.33.123.128', 'public', NULL, '', 'inactive', 'available', NULL, '2026-01-23 17:26:47', '2026-01-23 17:27:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `knowledge_base`
--

CREATE TABLE `knowledge_base` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'General',
  `is_public` tinyint(1) NOT NULL DEFAULT '1',
  `views` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text,
  `attempt_time` datetime NOT NULL,
  `success` tinyint(1) NOT NULL DEFAULT '0',
  `failure_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `username`, `ip_address`, `user_agent`, `attempt_time`, `success`, `failure_reason`) VALUES
(1, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-23 18:23:35', 1, ''),
(2, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-23 18:56:30', 1, ''),
(3, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-23 18:57:49', 1, ''),
(4, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-23 18:57:57', 1, ''),
(5, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-23 19:01:29', 1, ''),
(6, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-23 19:03:09', 1, ''),
(7, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-23 19:03:21', 1, ''),
(8, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-23 19:19:04', 1, ''),
(9, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-23 19:54:01', 1, ''),
(10, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-23 19:56:43', 1, ''),
(11, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-23 20:08:44', 1, ''),
(12, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-23 20:12:36', 1, ''),
(13, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 03:58:42', 0, 'Invalid credentials'),
(14, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 03:58:50', 1, ''),
(15, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 04:13:41', 1, ''),
(16, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 04:34:46', 1, ''),
(17, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 04:35:04', 1, ''),
(18, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 04:40:01', 1, ''),
(19, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 04:40:27', 1, ''),
(20, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 04:41:35', 1, ''),
(21, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 04:42:42', 1, ''),
(22, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 04:42:42', 1, ''),
(23, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 04:46:51', 1, ''),
(24, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 04:49:00', 1, ''),
(25, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 04:54:12', 1, ''),
(26, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 05:02:38', 1, ''),
(27, 'Nur', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 05:05:52', 1, ''),
(28, 'Nur', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 05:06:40', 0, 'Invalid credentials'),
(29, 'Nur', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 05:06:50', 1, ''),
(30, 'Fahri', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 05:08:23', 1, ''),
(31, 'Mashudi', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-24 05:17:32', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `networks`
--

CREATE TABLE `networks` (
  `id` int NOT NULL,
  `slug` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cidr` varchar(45) NOT NULL,
  `range_start` varchar(45) NOT NULL,
  `range_end` varchar(45) NOT NULL,
  `subnet_mask` varchar(45) DEFAULT NULL,
  `description` text,
  `is_reserve` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `networks`
--

INSERT INTO `networks` (`id`, `slug`, `name`, `cidr`, `range_start`, `range_end`, `subnet_mask`, `description`, `is_reserve`, `created_at`, `updated_at`) VALUES
(1, 'jakarta', 'Data Center JKT', '218.33.123.0/26', '218.33.123.0', '218.33.123.63', '255.255.255.192', 'Core Network', 0, '2026-01-22 16:00:06', '2026-01-23 03:23:18'),
(2, 'serpong', 'DC PDN Serpong', '218.33.123.64/26', '218.33.123.64', '218.33.123.127', '255.255.255.192', 'Disaster Recovery (DRC)', 0, '2026-01-22 16:00:06', '2026-01-22 16:00:06'),
(3, 'pusat', 'DC Kantor Pusat', '218.33.123.128/27', '218.33.123.128', '218.33.123.159', '255.255.255.224', 'Headquarters', 0, '2026-01-22 16:00:06', '2026-01-22 16:00:06'),
(4, 'reserve1', 'Network Cadangan 1', '218.33.123.160/28', '218.33.123.160', '218.33.123.175', '255.255.255.240', 'Dapat digunakan untuk: IP Transit', 1, '2026-01-22 16:00:06', '2026-01-24 04:26:29'),
(5, 'reserve2', 'Network Cadangan 2', '218.33.123.176/28', '218.33.123.176', '218.33.123.191', '255.255.255.240', 'Future DC / Event / Kebutuhan Dadakan', 1, '2026-01-22 16:00:06', '2026-01-22 16:00:06'),
(6, 'depok', 'DC Depok', '218.33.123.192/26', '218.33.123.192', '218.33.123.255', '255.255.255.192', 'Data Center', 0, '2026-01-22 16:00:06', '2026-01-22 16:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text,
  `setting_group` varchar(50) DEFAULT 'general',
  `input_type` varchar(50) DEFAULT 'text',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `setting_group`, `input_type`, `updated_at`) VALUES
(1, 'site_title', 'CSIRT RRI', 'general', 'text', '2026-01-23 08:41:36'),
(2, 'site_description', 'Computer Security Incident Response Team LPP RRI', 'general', 'textarea', '2026-01-23 08:41:36'),
(3, 'contact_email', 'csirt@rri.go.id', 'general', 'email', '2026-01-23 08:41:36'),
(4, 'contact_phone', '+62 21 12345678', 'general', 'text', '2026-01-23 08:41:36'),
(5, 'footer_text', '&copy; 2026 RRI CSIRT. All rights reserved.', 'general', 'text', '2026-01-23 08:41:36'),
(6, 'enable_waf_stats', '1', 'security', 'toggle', '2026-01-23 08:41:36'),
(7, 'waf_api_url', 'https://trial-waf.rri.go.id/api/commercial/record/export', 'security', 'text', '2026-01-23 08:41:36'),
(8, 'waf_api_token', '', 'security', 'password', '2026-01-23 08:41:36'),
(9, 'max_login_attempts', '5', 'security', 'number', '2026-01-23 08:41:36'),
(10, 'maintenance_mode', '0', 'security', 'toggle', '2026-01-23 08:41:36'),
(11, 'social_facebook', '#', 'social', 'text', '2026-01-23 08:41:36'),
(12, 'social_twitter', '#', 'social', 'text', '2026-01-23 08:41:36'),
(13, 'social_instagram', '#', 'social', 'text', '2026-01-23 08:41:36'),
(14, 'waf_api_username', 'admin', 'api', 'text', '2026-01-23 13:44:55'),
(15, 'waf_api_password', '', 'api', 'password', '2026-01-23 13:44:55'),
(16, 'session_timeout', '7200', 'security', 'number', '2026-01-23 23:55:37'),
(17, 'login_lockout_duration', '900', 'security', 'number', '2026-01-23 23:55:37'),
(18, 'enable_2fa', '0', 'security', 'toggle', '2026-01-23 23:55:37'),
(19, 'password_min_length', '8', 'security', 'number', '2026-01-23 23:55:37'),
(20, 'password_require_uppercase', '1', 'security', 'toggle', '2026-01-23 23:55:37'),
(21, 'password_require_number', '1', 'security', 'toggle', '2026-01-23 23:55:37'),
(22, 'password_require_special', '1', 'security', 'toggle', '2026-01-23 23:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `division` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('leader','member') NOT NULL DEFAULT 'member',
  `display_order` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `position`, `division`, `photo`, `email`, `phone`, `role`, `display_order`, `is_active`, `created_at`) VALUES
(21, 'Mashudi', 'Direktur Utama', 'Tim Teknologi Media Baru', '541399459_17955360609005469_3276091029063881069_n7.jpg', NULL, NULL, 'leader', 0, 1, '2026-01-23 03:44:34'),
(22, 'Mashudi', 'Direktur Utama', 'Tim IT', '541399459_17955360609005469_3276091029063881069_n8.jpg', NULL, NULL, 'leader', 0, 1, '2026-01-23 03:44:54'),
(26, 'Mashudi', 'Anak Magang', 'Tim IT', NULL, NULL, NULL, 'member', 0, 1, '2026-01-23 03:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','management','auditor','analyst','user') DEFAULT 'auditor',
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `failed_login_attempts` int DEFAULT '0',
  `account_locked_until` datetime DEFAULT NULL,
  `login_ip` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `avatar` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `full_name`, `phone`, `is_active`, `last_login`, `last_activity`, `failed_login_attempts`, `account_locked_until`, `login_ip`, `created_at`, `updated_at`, `avatar`, `status`) VALUES
(3, 'Mashudi', 'masssshudiiii@gmail.com', '$2y$10$K4imEYKACSx3J5SoB.9ffektXd0MMJXpQJzgKfsK.HsE8kSFDIY6S', 'admin', NULL, NULL, 1, '2026-01-24 11:31:22', '2026-01-24 11:31:22', 0, NULL, '::1', '2026-01-22 20:28:01', '2026-01-24 04:31:22', 'avatar_1769110081.jpg', 'active'),
(4, 'Fahri', 'fahri@gmail.com', '$2y$10$J/WitlNyub/WtSHZVas0s.BzcY0OomhuISMzuTTegfoeAtBKPvSh6', 'admin', NULL, NULL, 1, '2026-01-24 11:17:21', '2026-01-24 11:17:21', 0, NULL, '::1', '2026-01-22 20:31:51', '2026-01-24 04:31:17', 'avatar_1769110311.jpg', 'active'),
(5, 'Nur', 'nur@gmail.com', '$2y$10$yh1gPBrUipgIarz7ToUA3OoMUXWFN.9mGgEHIITKwD0iVpsj74GLG', 'auditor', NULL, NULL, 1, '2026-01-24 11:08:08', '2026-01-24 11:08:08', 0, NULL, '::1', '2026-01-22 20:32:15', '2026-01-24 04:08:08', 'avatar_1769110335.jpg', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_status_published` (`status`,`published_at`),
  ADD KEY `idx_category` (`category`),
  ADD KEY `idx_author` (`author_id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_created_user` (`created_at`,`user_id`),
  ADD KEY `idx_action` (`action`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timestamp` (`timestamp`),
  ADD KEY `idx_timestamp` (`timestamp`);

--
-- Indexes for table `evidence`
--
ALTER TABLE `evidence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reporter_id` (`reporter_id`),
  ADD KEY `assignee_id` (`assignee_id`);

--
-- Indexes for table `incident_attachments`
--
ALTER TABLE `incident_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incident_id` (`incident_id`);

--
-- Indexes for table `incident_notes`
--
ALTER TABLE `incident_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incident_id` (`incident_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ip_addresses`
--
ALTER TABLE `ip_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ip_network` (`network_id`);

--
-- Indexes for table `knowledge_base`
--
ALTER TABLE `knowledge_base`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_username_time` (`username`,`attempt_time`),
  ADD KEY `idx_ip_time` (`ip_address`,`attempt_time`),
  ADD KEY `idx_attempt_time` (`attempt_time`);

--
-- Indexes for table `networks`
--
ALTER TABLE `networks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_division_active` (`division`,`is_active`),
  ADD KEY `idx_display_order` (`display_order`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `evidence`
--
ALTER TABLE `evidence`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incident_attachments`
--
ALTER TABLE `incident_attachments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incident_notes`
--
ALTER TABLE `incident_notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ip_addresses`
--
ALTER TABLE `ip_addresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `knowledge_base`
--
ALTER TABLE `knowledge_base`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `networks`
--
ALTER TABLE `networks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `incidents_ibfk_2` FOREIGN KEY (`assignee_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `incident_attachments`
--
ALTER TABLE `incident_attachments`
  ADD CONSTRAINT `incident_attachments_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `incident_notes`
--
ALTER TABLE `incident_notes`
  ADD CONSTRAINT `incident_notes_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `incident_notes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ip_addresses`
--
ALTER TABLE `ip_addresses`
  ADD CONSTRAINT `fk_ip_network` FOREIGN KEY (`network_id`) REFERENCES `networks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
