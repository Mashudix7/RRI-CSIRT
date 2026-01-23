-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 23, 2026 at 01:35 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `details` text,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
('h6bbgrq19o0911rnu299a9oos2u6t2kn', '::1', 1769058071, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393035383037313b),
('ktrkj6tgpmk8lnk2nr4tcori8mf8ahkt', '::1', 1769058070, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393035383037303b),
('m4pu8lq2hvo5v7dr9b5kmp482p5e0tpc', '::1', 1769058679, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393035383436333b),
('thcmjt58636dt5oo2dbqab57oo3l85qs', '::1', 1769058462, 0x5f5f63695f6c6173745f726567656e65726174657c693a313736393035383436323b),
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
(283, '', '218.33.123.0', 'public', NULL, '', 'inactive', 'available', NULL, '2026-01-22 12:17:05', '2026-01-22 18:24:46', 1);

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
(1, 'jakarta', 'Data Center Jakarta', '218.33.123.0/26', '218.33.123.0', '218.33.123.63', '255.255.255.192', 'Core Network', 0, '2026-01-22 16:00:06', '2026-01-22 16:00:06'),
(2, 'serpong', 'DC PDN Serpong', '218.33.123.64/26', '218.33.123.64', '218.33.123.127', '255.255.255.192', 'Disaster Recovery (DRC)', 0, '2026-01-22 16:00:06', '2026-01-22 16:00:06'),
(3, 'pusat', 'DC Kantor Pusat', '218.33.123.128/27', '218.33.123.128', '218.33.123.159', '255.255.255.224', 'Headquarters', 0, '2026-01-22 16:00:06', '2026-01-22 16:00:06'),
(4, 'reserve1', 'Network Cadangan 1', '218.33.123.160/28', '218.33.123.160', '218.33.123.175', '255.255.255.240', 'Dapat digunakan untuk: IP Transit', 1, '2026-01-22 16:00:06', '2026-01-22 16:00:06'),
(5, 'reserve2', 'Network Cadangan 2', '218.33.123.176/28', '218.33.123.176', '218.33.123.191', '255.255.255.240', 'Future DC / Event / Kebutuhan Dadakan', 1, '2026-01-22 16:00:06', '2026-01-22 16:00:06'),
(6, 'depok', 'DC Depok', '218.33.123.192/26', '218.33.123.192', '218.33.123.255', '255.255.255.192', 'Data Center', 0, '2026-01-22 16:00:06', '2026-01-22 16:00:06');

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
(1, 'Mashudi', 'Direktur Utama', 'Tim IT', 'assets/uploads/teams/e20b1d884809d15970f7cc645f4cd326.jpg', 'masssshudiiii@gmail.com', '089199189927', 'leader', 0, 1, '2026-01-21 09:37:19'),
(2, 'Fahri', 'Direktur Utama', 'Tim Teknologi Media Baru', 'assets/uploads/teams/70d538dd2344d483a83232f30831443b.png', NULL, '089199189927', 'member', 0, 1, '2026-01-21 10:01:41'),
(6, 'Mashudi', 'Anak Magang', 'Tim Teknologi Media Baru', 'assets/uploads/teams/87ed1ef4d5733a016236e00efb4abf3c.jpg', 'mashudi@cloudify.com', NULL, 'member', 0, 1, '2026-01-21 10:29:47'),
(18, 'Mashudi', 'Direktur Utama', 'media_baru', '541399459_17955360609005469_3276091029063881069_n3.jpg', NULL, NULL, 'leader', 0, 1, '2026-01-22 19:28:59'),
(19, 'Farly', 'Anak Magang', 'media_baru', '541399459_17955360609005469_3276091029063881069_n4.jpg', NULL, NULL, 'member', 0, 1, '2026-01-22 19:29:19'),
(20, 'Fahri', 'Direktur Utama', 'it', '572899538_17875011393434796_3416572539650883626_n.jpg', NULL, NULL, 'leader', 0, 1, '2026-01-22 19:30:49');

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
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `avatar` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `full_name`, `phone`, `is_active`, `last_login`, `created_at`, `updated_at`, `avatar`, `status`) VALUES
(3, 'Mashudi', 'masssshudiiii@gmail.com', '$2y$10$K4imEYKACSx3J5SoB.9ffektXd0MMJXpQJzgKfsK.HsE8kSFDIY6S', 'admin', NULL, NULL, 1, '2026-01-23 02:30:11', '2026-01-22 20:28:01', '2026-01-23 01:30:11', 'avatar_1769110081.jpg', 'active'),
(4, 'Fahri', 'fahri@gmail.com', '$2y$10$J/WitlNyub/WtSHZVas0s.BzcY0OomhuISMzuTTegfoeAtBKPvSh6', 'management', NULL, NULL, 1, NULL, '2026-01-22 20:31:51', '2026-01-22 19:31:51', 'avatar_1769110311.jpg', 'active'),
(5, 'Nur', 'nur@gmail.com', '$2y$10$yh1gPBrUipgIarz7ToUA3OoMUXWFN.9mGgEHIITKwD0iVpsj74GLG', 'auditor', NULL, NULL, 1, '2026-01-23 02:29:48', '2026-01-22 20:32:15', '2026-01-23 01:29:48', 'avatar_1769110335.jpg', 'active');

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
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timestamp` (`timestamp`);

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
-- Indexes for table `networks`
--
ALTER TABLE `networks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT for table `knowledge_base`
--
ALTER TABLE `knowledge_base`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `networks`
--
ALTER TABLE `networks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
