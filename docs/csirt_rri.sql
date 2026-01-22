CREATE DATABASE IF NOT EXISTS `csirt_rri`;
USE `csirt_rri`;

-- 1. Users Table
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'analyst', 'user') DEFAULT 'user',
    `full_name` VARCHAR(100),
    `phone` VARCHAR(20),
    `is_active` BOOLEAN DEFAULT TRUE,
    `last_login` DATETIME,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. Incidents Table
CREATE TABLE `incidents` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `category` VARCHAR(50) NOT NULL,
    `severity` ENUM('critical', 'high', 'medium', 'low') NOT NULL,
    `status` ENUM('reported', 'validated', 'in_progress', 'mitigated', 'recovered', 'closed') DEFAULT 'reported',
    `affected_systems` TEXT,
    `initial_assessment` TEXT,
    `reporter_id` INT,
    `assignee_id` INT,
    `detection_time` DATETIME,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`reporter_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`assignee_id`) REFERENCES `users`(`id`)
);

-- 3. Incident Notes (Detail/Activities)
CREATE TABLE `incident_notes` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `incident_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `note` TEXT NOT NULL,
    `type` ENUM('comment', 'activity', 'system') DEFAULT 'comment',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`incident_id`) REFERENCES `incidents`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

-- 4. Incident Attachments
CREATE TABLE `incident_attachments` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `incident_id` INT NOT NULL,
    `filename` VARCHAR(255) NOT NULL,
    `file_path` VARCHAR(255) NOT NULL,
    `file_type` VARCHAR(50),
    `file_size` INT,
    `uploaded_by` INT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`incident_id`) REFERENCES `incidents`(`id`) ON DELETE CASCADE
);

-- 5. Articles Table
CREATE TABLE `articles` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `content` LONGTEXT NOT NULL,
    `excerpt` TEXT,
    `thumbnail` VARCHAR(255),
    `author_id` INT,
    `status` ENUM('draft', 'published') DEFAULT 'draft',
    `views` INT DEFAULT 0,
    `published_at` DATETIME,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`author_id`) REFERENCES `users`(`id`)
);

-- 6. IP Addresses Table (Infrastructure)
CREATE TABLE `ip_addresses` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL, -- IPv4 or IPv6
    `type` ENUM('local', 'private', 'vpn') NOT NULL,
    `region` VARCHAR(100),
    `description` TEXT,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `usage_status` ENUM('in_use', 'available') DEFAULT 'available',
    `app_name` VARCHAR(100), -- If in_use, what app is using it
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 7. Team Members Table (Public Landing Page)
CREATE TABLE `teams` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `position` VARCHAR(100) NOT NULL,
    `photo` VARCHAR(255),
    `email` VARCHAR(100),
    `phone` VARCHAR(20),
    `level` ENUM('leader', 'manager', 'staff') NOT NULL,
    `display_order` INT DEFAULT 0,
    `is_active` BOOLEAN DEFAULT TRUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 8. Audit Logs
CREATE TABLE `audit_logs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `action` VARCHAR(50) NOT NULL, -- e.g., 'login', 'create_incident', 'delete_user'
    `module` VARCHAR(50) NOT NULL, -- e.g., 'auth', 'incidents', 'users'
    `details` TEXT, -- JSON or text description
    `ip_address` VARCHAR(45),
    `user_agent` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

-- Initial Data Seeding
INSERT INTO `users` (`username`, `email`, `password`, `role`, `full_name`) VALUES 
('admin', 'admin@rri.co.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'Administrator'),
('analyst', 'analyst@rri.co.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'analyst', 'Security Analyst');
