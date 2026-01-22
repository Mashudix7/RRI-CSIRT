-- Add status column to users table
ALTER TABLE `users` ADD COLUMN `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active';

-- Update existing users to have active status just in case (though default handles new ones)
UPDATE `users` SET `status` = 'active' WHERE `status` IS NULL;
