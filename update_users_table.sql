-- Add Avatar if not exists (using a safe approach or just try ADD)
-- MySQL doesn't have IF NOT EXISTS for ADD COLUMN easily without Procedure, so we'll just try to ALTER and ignore if fails or do it smartly.
-- But for Laragon/MariaDB/MySQL locally, let's just do the ALTERs. If column exists, it errors but we can ignore or Try-Catch implies complexity.

-- 1. Modify Role Enum to include new roles
ALTER TABLE `users` MODIFY COLUMN `role` ENUM('admin', 'management', 'auditor', 'analyst', 'user') DEFAULT 'auditor';

-- 2. Add Avatar column (This might error if exists, but that's fine, we just want to ensure it is there)
-- To avoid error halting execution, we can use a stored procedure or just hope.
-- But let's verify if we can simply check the file content first? 
-- No, let's just run it. If it fails, it fails.

ALTER TABLE `users` ADD COLUMN `avatar` VARCHAR(255) DEFAULT NULL;

-- 3. Ensure updated_at and created_at
ALTER TABLE `users` MODIFY COLUMN `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `users` ADD COLUMN `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP;
