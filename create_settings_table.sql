-- Settings Table
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL PRIMARY KEY,
  `value` text DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Default Settings
INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'app_name', 'CSIRT RRI'),
(2, 'admin_email', 'csirt@rri.co.id'),
(3, 'timezone', 'Asia/Jakarta'),
(4, 'notification_incident', '1'),
(5, 'notification_critical', '1'),
(6, 'daily_report', '0'),
(7, 'session_timeout', '120'),
(8, 'max_login_attempts', '5'),
(9, 'two_factor_auth', '0')
ON DUPLICATE KEY UPDATE `value`=VALUES(`value`);
